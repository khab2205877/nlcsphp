<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\Models\Brand;
use PDO;

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
            $sizes = $_POST['sizes'] ?? [];
            $sizes = array_filter($sizes, function ($size) {
                return $size >= 0;
            });
            $images = $this->handleFileUploads($_FILES['images'] ?? []);
            $newProduct->fill($data)->save($images, $sizes);

            $_SESSION['success_Mess'] = 'Bạn đã thêm sản phẩm thành công';
            redirect('/admin/products');
        }

        $this->saveFormValues($_POST);
        redirect('/admin/products/create', ['errors' => $model_errors]);
    }

    public function edit($productId)
    {
        $productModel = new Product(PDO());
        $product = $productModel->find($productId);
        if (!$product) {
            $this->sendNotFound();
        }
        $brandModel = new Brand(PDO());
        $brands = $brandModel->all();

        $productImages = $product->getImages();

        $productSizes = $product->getSizes();

        $from_values = $this->getSavedFormValues();
        $data = [
            'errors' => session_get_once('errors'),
            'old' => $from_values,
            'data' => (!empty($from_values)) ? array_merge($from_values, ['id' => $product->id]) : (array) $product,
            'brands' => $brands,
            'product_images' => $productImages,
            'product_sizes' => $productSizes
        ];

        $this->sendPage('page/edit_product', $data);
    }

    public function update($productId)
    {
        $productModel = new Product(PDO());
        $product = $productModel->find($productId);
        if (!$product) {
            $this->sendNotFound();
        }

        $data = $this->filterProductData($_POST);
        $model_errors = $product->validate($data);
        if (empty($model_errors)) {
            $sizes = $_POST['sizes'] ?? null;
            $sizes = array_filter($sizes, function ($size) {
                return $size >= 0;
            });
            if (empty($sizes)) {
                $sizes = $product->getSizes();
            }
            $images = $this->handleFileUploads($_FILES['images'] ?? []);
            $product->fill($data)->save($images, $sizes);

            $_SESSION['success_Mess'] = 'Bạn đã cập nhật sản phẩm thành công';
            redirect('/admin/products');
        }

        $this->saveFormValues($_POST);
        redirect('admin/products/edit/' . $productId, ['errors' => $model_errors]);
    }

    public function destroy($productId)
    {
        $productModel = new Product(PDO());
        $product = $productModel->find($productId);

        if (!$product) {
            $this->sendNotFound();
        }

        if (!empty($product->image)) {
            $imagePath = __DIR__ . '/../../../public/' . ltrim($product->image, '/');
            if (file_exists($imagePath) && is_writable($imagePath)) {
                unlink($imagePath);
            }
        }

        $pdo = PDO();
        $stmt = $pdo->prepare('SELECT image_path FROM product_images WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $images = $stmt->fetchAll();

        foreach ($images as $image) {
            if (!empty($image['image_path'])) {
                $imagePath = __DIR__ . '/../../../public/' . ltrim($image['image_path'], '/');
                if (file_exists($imagePath) && is_writable($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

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
    protected function handleFileUploads(array $files): array
    {
        $uploadedPaths = [];
        $uploadDir = __DIR__ . '/../../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($files['name'] as $key => $fileName) {
            if ($files['error'][$key] === UPLOAD_ERR_OK) {
                $uniqueFileName = time() . '_' . basename($fileName);
                $destination = $uploadDir . $uniqueFileName;

                if (move_uploaded_file($files['tmp_name'][$key], $destination)) {
                    $uploadedPaths[] = '/uploads/' . $uniqueFileName;
                }
            }
        }

        return $uploadedPaths;
    }
}
