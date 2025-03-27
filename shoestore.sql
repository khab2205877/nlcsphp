
-- Bảng users: Lưu tài khoản đăng nhập
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'customer') DEFAULT 'customer',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Bảng brands: Quản lý thương hiệu giày
CREATE TABLE `brands` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) UNIQUE NOT NULL,
    `image` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn hình ảnh thương hiệu',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Bảng products: Lưu thông tin sản phẩm
CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL COMMENT 'Tên sản phẩm',
    `brand_id` INT NOT NULL COMMENT 'Mã thương hiệu',
    `price` DECIMAL(10,2) NOT NULL COMMENT 'Giá sản phẩm',
    `image` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn hình ảnh',
    `discount_percent` TINYINT(3) UNSIGNED DEFAULT 0 COMMENT 'Phần trăm giảm giá',
    `description` TEXT COMMENT 'Mô tả sản phẩm',
    `material` VARCHAR(255) DEFAULT NULL COMMENT 'Chất liệu',
    `origin` VARCHAR(255) DEFAULT NULL COMMENT 'Xuất xứ',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (`brand_id`),
    FOREIGN KEY (`brand_id`) REFERENCES `brands`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Bảng product_images: Lưu ảnh phụ của sản phẩm
CREATE TABLE `product_images` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL COMMENT 'Mã sản phẩm',
    `image_path` VARCHAR(255) NOT NULL COMMENT 'Đường dẫn ảnh phụ',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (`product_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `product_sizes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL COMMENT 'Mã sản phẩm',
    `size` FLOAT(3,1) NOT NULL COMMENT 'Kích thước giày',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
