<?php

namespace App\Controllers\Admin;

use App\Models\Brand;

class BrandController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $brandModel = new Brand(PDO());
    $brands = $brandModel->all();

    $this->sendPage('page/brands', [
      'brands' => $brands
    ]);
  }

  public function create()
  {
    $this->sendPage('page/create_brand', [
      'errors' => session_get_once('errors'),
      'old' => $this->getSavedFormValues()
    ]);
  }

  public function store()
  {
    $data = $_POST;
    $brand = new Brand(PDO());
    $errors = $brand->validate($data);

    if (empty($errors)) {
      $brand->name = $data['name'];
      $brand->save();
      $_SESSION['success_Mess'] = 'Thương hiệu đã được thêm thành công.';
      redirect('/admin/brands');
    }

    $this->saveFormValues($data);
    redirect('/admin/brands/create', ['errors' => $errors]);
  }

  public function edit($brandId)
  {
    $brandModel = new Brand(PDO());
    $brand = $brandModel->find($brandId);

    if (!$brand) {
      $this->sendNotFound();
    }

    $form_values = $this->getSavedFormValues();
    $data = [
      'errors' => session_get_once('errors'),
      'old' => $form_values,
      'data' => (!empty($form_values)) ? array_merge($form_values, ['id' => $brand->id]) : (array) $brand
    ];

    $this->sendPage('page/edit_brand', $data);
  }

  public function update($brandId)
  {
    $brandModel = new Brand(PDO());
    $brand = $brandModel->find($brandId);

    if (!$brand) {
      $this->sendNotFound();
    }

    $data = $_POST;
    $errors = $brand->validate($data);

    if (empty($errors)) {
      $brand->name = $data['name'];
      $brand->save();
      $_SESSION['success_Mess'] = 'Thương hiệu đã được cập nhật thành công.';
      redirect('/admin/brands');
    }

    $this->saveFormValues($data);
    redirect('/admin/brands/edit/' . $brandId, ['errors' => $errors]);
  }

  public function destroy($brandId)
  {
    $brandModel = new Brand(PDO());
    $brand = $brandModel->find($brandId);

    if (!$brand) {
      $this->sendNotFound();
    }

    $brand->delete();
    $_SESSION['success_Mess'] = 'Thương hiệu đã được xóa thành công.';
    redirect('/admin/brands');
  }
}
