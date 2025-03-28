<?php

namespace App\Models;

use PDO;

class Product
{
    private PDO $db;

    public int $id = -1;
    public string $name;
    public int $brand_id;
    public float $price;
    public ?string $image = null;
    public int $discount_percent;
    public string $description;
    public string $material;
    public string $origin;
    public string $created_at;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
    public function all(): array
    {
        $products = [];

        $statement = $this->db->query("SELECT * FROM products");
        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDbRow($row);
            $products[] = $product;
        }
        return $products;
    }

    public function save(array $images = [], array $sizes = []): bool
    {
        try {
            // Bắt đầu giao dịch
            $this->db->beginTransaction();

            if ($this->id >= 0) {
                // Cập nhật sản phẩm nếu đã tồn tại
                $statement = $this->db->prepare(
                    'UPDATE products SET name = :name, brand_id = :brand_id, price = :price, image = :image, discount_percent = :discount_percent, description = :description, material = :material, origin = :origin WHERE id = :id'
                );
                $result = $statement->execute([
                    'name' => $this->name,
                    'brand_id' => $this->brand_id,
                    'price' => $this->price,
                    'image' => $this->image,
                    'discount_percent' => $this->discount_percent,
                    'description' => $this->description,
                    'material' => $this->material,
                    'origin' => $this->origin,
                    'id' => $this->id
                ]);

                // Xóa dữ liệu cũ trong bảng `product_images` và `product_sizes`
                $this->db->prepare('DELETE FROM product_images WHERE product_id = :product_id')->execute(['product_id' => $this->id]);
                $this->db->prepare('DELETE FROM product_sizes WHERE product_id = :product_id')->execute(['product_id' => $this->id]);
            } else {
                // Thêm sản phẩm mới
                $statement = $this->db->prepare(
                    'INSERT INTO products (name, brand_id, price, image, discount_percent, description, material, origin, created_at) VALUES (:name, :brand_id, :price, :image, :discount_percent, :description, :material, :origin, NOW())'
                );
                $result = $statement->execute([
                    'name' => $this->name,
                    'brand_id' => $this->brand_id,
                    'price' => $this->price,
                    'image' => $this->image,
                    'discount_percent' => $this->discount_percent,
                    'description' => $this->description,
                    'material' => $this->material,
                    'origin' => $this->origin
                ]);

                if ($result) {
                    $this->id = $this->db->lastInsertId();
                }
            }

            // Thêm hình ảnh vào bảng `product_images`
            if (!empty($images)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO product_images (product_id, image_path, created_at) VALUES (:product_id, :image_path, NOW())'
                );
                foreach ($images as $image) {
                    $stmt->execute([
                        'product_id' => $this->id,
                        'image_path' => $image
                    ]);
                }
            }

            // Thêm kích thước vào bảng `product_sizes`
            if (!empty($sizes)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO product_sizes (product_id, size, created_at) VALUES (:product_id, :size, NOW())'
                );
                foreach ($sizes as $size) {
                    $stmt->execute([
                        'product_id' => $this->id,
                        'size' => $size
                    ]);
                }
            }

            // Xác nhận giao dịch
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            // Hủy giao dịch nếu có lỗi
            $this->db->rollBack();
            throw $e;
        }
    }

    public function delete(): bool
    {
        $statement = $this->db->prepare('DELETE FROM products WHERE id = :id');
        return $statement->execute(['id' => $this->id]);
    }

    public function fill(array $data): Product
    {
        $this->name = $data['name'] ?? '';
        $this->brand_id = $data['brand_id'] ?? 0;
        $this->price = $data['price'] ?? 0;
        $this->image = $data['image'] ?? null;
        $this->discount_percent = $data['discount_percent'] ?? 0;
        $this->description = $data['description'] ?? '';
        $this->material = $data['material'] ?? '';
        $this->origin = $data['origin'] ?? '';

        return $this;
    }

    public function find(int $id): ?Product
    {
        $statement = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $statement->execute(['id' => $id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $product = new Product($this->db);
            $product->fillFromDbRow($row);
            return $product;
        }
        return null;
    }

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Tên sản phẩm không được để trống.';
        }
        if (empty($data['brand_id'])) {
            $errors['brand_id'] = 'Thương hiệu không được để trống.';
        }
        if (!is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = 'Giá không hợp lệ.';
        }
        if ($data['discount_percent'] < 0 || $data['discount_percent'] > 100) {
            $errors['discount_percent'] = 'Phần trăm giảm giá phải từ 0 đến 100.';
        }
        return $errors;
    }

    private function fillFromDbRow(array $row): Product
    {
        $this->id = $row['id'] ?? -1;
        $this->name = $row['name'] ?? '';
        $this->brand_id = $row['brand_id'] ?? 0;
        $this->price = $row['price'] ?? 0;
        $this->image = $row['image'] ?? null;
        $this->discount_percent = $row['discount_percent'] ?? 0;
        $this->description = $row['description'] ?? '';
        $this->material = $row['material'] ?? '';
        $this->origin = $row['origin'] ?? '';
        $this->created_at = $row['created_at'] ?? '';

        return $this;
    }
}
