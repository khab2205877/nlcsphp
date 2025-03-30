<?php

namespace App\Controllers\User;

use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $brandModel = new Brand(PDO());
        $brands = $brandModel->all();

        $productModel = new Product(PDO());
        $productsByBrand = [];

        foreach ($brands as $brand) {
            $productsByBrand[$brand['id']] = $productModel->findByBrand($brand['id']);
        }

        $this->sendPage('pages/index', [
            'brands' => $brands,
            'productsByBrand' => $productsByBrand,
        ]);
    }

    
}
