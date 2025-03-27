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
    $imagePath = $this->handleImageUpload();
    $brand = new Brand(PDO());
    $errors = $brand->validate($data);

    if (empty($errors)) {
      $brand->name = $data['name'];
      $brand->image = $imagePath;
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
    $imagePath = $this->handleImageUpload($brand->image);
    $errors = $brand->validate($data);

    if (empty($errors)) {
      $brand->name = $data['name'];
      $brand->image = $imagePath;
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

    if ($brand->image) {
      $imagePath = __DIR__ . '/../../../public/' . ltrim($brand->image, '/');
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
    }

    $brand->delete();
    $_SESSION['success_Mess'] = 'Thương hiệu đã được xóa thành công.';
    redirect('/admin/brands');
  }

  private function handleImageUpload(?string $existingImage = null): ?string
  {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      if ($existingImage) {
        $existingImagePath = __DIR__ . '/../../../public/' . ltrim($existingImage, '/');
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }

      $uploadDir = __DIR__ . '/../../../public/uploads/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $fileName = time() . '_' . basename($_FILES['image']['name']);
      $destination = $uploadDir . $fileName;

      if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        return '/uploads/' . $fileName;
      }
    }

    return $existingImage;
  }
}
