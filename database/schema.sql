CREATE DATABASE IF NOT EXISTS `web_alat_kebersihan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `web_alat_kebersihan`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `icon` VARCHAR(50) DEFAULT 'sparkles'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_desc` TEXT NULL,
  `description` TEXT NULL,
  `price_retail` INT DEFAULT 0,
  `price_wholesale` INT DEFAULT 0,
  `min_wholesale_qty` INT DEFAULT 12,
  `material` VARCHAR(255) NULL,
  `length_size` VARCHAR(255) NULL,
  `durability` VARCHAR(255) NULL,
  `stock_status` VARCHAR(50) DEFAULT 'Ready Stock',
  `image` VARCHAR(255) NULL,
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `company_name` VARCHAR(150) NULL,
  `email` VARCHAR(100) NULL,
  `phone` VARCHAR(50) NOT NULL,
  `type` VARCHAR(100) DEFAULT 'Pertanyaan Umum',
  `message` TEXT NOT NULL,
  `status` VARCHAR(20) DEFAULT 'unread',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `role` VARCHAR(50) DEFAULT 'admin',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`) VALUES
(1, 'Aneka Sapu', 'aneka-sapu', 'Sapu ijuk, rayung, nilon, lidi, dan sapu industri.', 'brush'),
(2, 'Aneka Pel Lantai', 'aneka-pel-lantai', 'Pel katun daya serap tinggi, microfiber, dan spin mop.', 'sparkles');

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Pabrik', 'superadmin');