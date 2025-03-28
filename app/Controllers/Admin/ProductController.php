<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->sendPage('page/index');
    }
    public function products()
    {
        $productModel = new Product(PDO());
        $products = $productModel->all();
        $this->sendPage('page/product', [
            'products' => $products
        ]);
    }
    public function create()
    {
        $brandModel = new Brand(PDO());
        $brands = $brandModel->all();
        $this->sendPage('page/create_product', [
            'brands' => $brands
        ]);
    }

    public function store()
    {
        $data = $this->filterProductData($_POST);
        $newProduct = new Product(PDO());
        $model_errors = $newProduct->validate($data);

        if (empty($model_errors)) {
            $newProduct->fill($data)->save();
            $productId = $newProduct->id;
            if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                $this->handleMultipleImages($productId, $_FILES['images']);
            }

            $_SESSION['success_Mess'] = 'Bạn đã thêm sản phẩm thành công';
            redirect('/admin/products');
        }

        $this->saveFormValues($_POST);
        redirect('/admin/create', ['errors' => $model_errors]);
    }

    public function destroy($productId)
    {
        $productModel = new Product(PDO());
        $product = $productModel->find($productId);

        if (!$product) {
            $this->sendNotFound();
        }
        $imagePath = __DIR__ . '/../../../public' . ltrim($product->image, '/');
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $pdo = PDO();
        $stmt = $pdo->prepare('SELECT image_path FROM product_images WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $images = $stmt->fetchAll();

        foreach ($images as $image) {
            $imagePath = __DIR__ . '/../../../public' . ltrim($image['image_path'], '/');
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $stmt = $pdo->prepare('DELETE FROM product_images WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);

        $product->delete();
        $_SESSION['success_Mess'] = 'Bạn đã xóa sản phẩm thành công';
        redirect('/admin/products');
    }

    protected function filterProductData(array $data)
    {
        $imagePath = $data['existing_image'] ?? '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../../public/uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $imagePath = '/uploads/' . $fileName;

            $destination = $uploadDir . $fileName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $imagePath = '';
            }
        }

        return [
            'name' => $data['name'] ?? '',
            'brand_id' => $data['brand_id'] ?? '',
            'price' => $data['price'] ?? '',
            'discount_percent' => $data['discount_percent'] ?? 0,
            'image' => $imagePath ?: ($data['image'] ?? ''),
            'origin' => $data['origin'] ?? '',
            'material' => $data['material'] ?? '',
            'description' => $data['description'] ?? '',
        ];
    }
    protected function handleMultipleImages($productId, $images)
    {
        $uploadDir = __DIR__ . '/../../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($images['name'] as $key => $imageName) {
            if ($images['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = time() . '_' . basename($imageName);
                $imagePath = '/uploads/' . $fileName;

                $destination = $uploadDir . $fileName;

                if (move_uploaded_file($images['tmp_name'][$key], $destination)) {
                    $pdo = PDO();
                    $stmt = $pdo->prepare('INSERT INTO product_images (product_id, image_path) VALUES (:product_id, :image_path)');
                    $stmt->execute([
                        'product_id' => $productId,
                        'image_path' => $imagePath
                    ]);
                }
            }
        }
    }
}
