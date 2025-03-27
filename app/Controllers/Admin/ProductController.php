<?php
namespace App\Controllers\Admin;
use App\Models\Product;

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
}