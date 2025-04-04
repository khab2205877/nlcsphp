<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../bootstrap.php';

define('APPNAME', 'NK Store');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$router = new \Bramus\Router\Router();

$router->before('GET|POST', '/admin.*', function () {
    if (!AUTHGUARD()->isAdmin()) {
        $_SESSION['error_Mess'] = 'Bạn không có quyền truy cập!';
        redirect('/home');
        exit;
    }
});

// Auth routes
$router->post('/logout', '\App\Controllers\Auth\LoginController@destroy');
$router->get('/register', '\App\Controllers\Auth\RegisterController@create');
$router->post('/register', '\\App\Controllers\Auth\RegisterController@store');
$router->get('/login', '\App\Controllers\Auth\LoginController@create');
$router->post('/login', '\App\Controllers\Auth\LoginController@store');

// home routes
$router->get('/', '\App\Controllers\User\HomeController@index');
$router->get('/home', '\App\Controllers\User\HomeController@index');



// product routes
$router->get('/products/(\d+)', '\App\Controllers\User\ProductController@index');

// productlist routes
$router->get('/product-list', '\App\Controllers\User\ProductListController@productlist');
$router->get('/search', '\App\Controller\User\ProductListController@search');
$router->set404('\App\Controllers\User\Controller@sendNotFound');

// admin routes
$router->get('/admin', '\App\Controllers\Admin\ProductController@index');
$router->get('/admin/user', '\App\Controllers\Admin\AdminController@users');
// admin product routes
$router->get('/admin/products', '\App\Controllers\Admin\ProductController@products');
$router->get('/admin/products/create', '\App\Controllers\Admin\ProductController@create');
$router->post('/admin/products/store', '\App\Controllers\Admin\ProductController@store');
$router->get('/admin/products/edit/(\d+)', '\App\Controllers\Admin\ProductController@edit');
$router->post('/admin/products/update/(\d+)', '\App\Controllers\Admin\ProductController@update');
$router->post('/admin/products/delete/(\d+)', '\App\Controllers\Admin\ProductController@destroy');

// Admin brand routes
$router->get('/admin/brands', '\App\Controllers\Admin\BrandController@index');
$router->get('/admin/brands/create', '\App\Controllers\Admin\BrandController@create');
$router->post('/admin/brands/store', '\App\Controllers\Admin\BrandController@store');
$router->get('/admin/brands/edit/(\d+)', '\App\Controllers\Admin\BrandController@edit');
$router->post('/admin/brands/update/(\d+)', '\App\Controllers\Admin\BrandController@update');
$router->post('/admin/brands/delete/(\d+)', '\App\Controllers\Admin\BrandController@destroy');

$router->run();
