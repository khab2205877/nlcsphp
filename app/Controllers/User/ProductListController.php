<?php

namespace App\Controllers\User;

use App\Models\Brand;
use App\Models\Product;

class ProductListController extends Controller
{
    public function productlist()
    {
        $brandModel = new Brand(PDO());
        $brands = $brandModel->all();
        $productModel = new Product(PDO());
        $products = $productModel->all();
        $sizes = $productModel->getAllSizes();
        $this->sendPage('pages/productlist', [
            'brands' => $brands,
            'products' => $products,
            'sizes' => $sizes
        ]);
    }

    public function search()
    {
        $search = $_GET['search'] ?? '';
        $search = trim($search);
        $price_range = $_GET['price_range'] ?? '';
        $size = $_GET['size'] ?? '';

        $stmt = PDO()->query("SELECT * FROM brands");
        $brands = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($search) && empty($price_range) && empty($size)) {
            $productModel = new Product(PDO());
            $products = $productModel->all();
            $this->sendPage('pages/productlist', [
                'products' => $products,
                'brands' => $brands,
                'search' => $search
            ]);
            return;
        }

        $productModel = new Product(PDO());
        $products = $productModel->search($search, $price_range, $size);

        if (empty($products)) {
            $this->sendPage('pages/productlist', [
                'products' => [],
                'brands' => $brands,
                'search' => $search,
                'error' => 'Không tìm thấy sản phẩm phù hợp.'
            ]);
            return;
        }

        $this->sendPage('pages/productlist', [
            'products' => $products,
            'brands' => $brands,
            'search' => $search,
            'error' => null
        ]);
    }
}
