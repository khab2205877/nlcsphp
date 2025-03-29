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
        $this->sendPage('pages/index', [
            'brands' => $brands
        ]);
    }
}
