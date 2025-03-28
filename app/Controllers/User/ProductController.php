<?php

namespace App\Controllers\User;

class ProductController extends Controller
{
    public function products()
    {
        $this->sendPage('pages/product');
    }
}