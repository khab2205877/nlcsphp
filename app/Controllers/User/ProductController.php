<?php

namespace App\Controllers\User;

use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        try {
            $productId = $id;
            if ($productId <= 0) {
                throw new \InvalidArgumentException("ID sản phẩm không hợp lệ");
            }

            $productModel = new Product(PDO());
            $product = $productModel->find($productId);

            if (!$product || $product->id === -1) {
                $this->sendNotFound();
                return;
            }
            $discountedPrice = $product->price * (1 - $product->discount_percent / 100);
            $brandName = $product->getBrandName();
            $productImages = $product->getImages();
            $productSizes = $product->getSizes();

            $this->sendPage('pages/product', [
                'product' => $product,
                'discountedPrice' => $discountedPrice,
                'brandName' => $brandName,
                'productImages' => $productImages,
                'productSizes' => $productSizes
            ]);
        } catch (\PDOException $e) {
            error_log("Lỗi database: " . $e->getMessage());
        } catch (\Exception $e) {
            error_log("Lỗi hệ thống: " . $e->getMessage());
            $this->sendNotFound();
        }
    }
}
