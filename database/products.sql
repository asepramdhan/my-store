-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2024 at 02:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `image`, `name`, `slug`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 21, 'images/products/KSF92TKYmK72bUDGeea8nf6TfiA4qpmvfnx6QXjS.jpg', 'Tenda anak model castile', 'tenda-anak-model-castile-WVLRA', '<p>Tenda anak model castile</p>', 98000, 40, '2024-05-15 04:49:01', '2024-05-15 04:49:01'),
(2, 21, 'images/products/qGDdiimr0gv5JWATYJOvM4AY4KfsaMkW8b8Vzhrl.jpg', 'Tenda anak model mobil mobilan terbaru 2024', 'tenda-anak-model-mobil-mobilan-terbaru-2024-qeepq', '<p>Tenda anak model mobil mobilan terbaru</p>', 120000, 12, '2024-05-15 05:22:38', '2024-05-15 05:22:38'),
(3, 21, 'images/products/YqfaivS0S0CkZT2Nwzi8ovcynrM4l4FaFySSEmuD.jpg', 'Tenda anak model castile warna biru', 'tenda-anak-model-castile-warna-biru-3G699', '<p>Tenda anak model castile warna biru</p>', 98000, 20, '2024-05-15 05:23:16', '2024-05-15 05:24:43'),
(4, 8, 'images/products/CBsath8gjdIwCgyCKHKl6MCY3W2aUanlOQjKhZpg.jpg', 'Kaos polos dewasa 4 pcs', 'kaos-polos-dewasa-4-pcs-zoxwe', '<p>Kaos polos untuk dewas 4 pcs</p>', 72000, 40, '2024-05-15 05:24:18', '2024-05-15 05:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
