-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2024 at 03:28 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Kesehatan', 'kesehatan-R34uw', '2024-05-12 20:58:47', '2024-05-13 18:19:37'),
(6, 'Aksesoris Fashion', 'aksesoris-fashion-wUhVw', '2024-05-12 22:08:36', '2024-05-13 18:20:01'),
(7, 'Elektronik (Kelistrikan)', 'elektronik-kelistrikan-6gxhk', '2024-05-12 22:08:44', '2024-05-13 18:20:22'),
(8, 'Pakaian Pria', 'pakaian-pria-cvbSo', '2024-05-12 22:09:07', '2024-05-13 18:20:46'),
(9, 'Sepatu Pria', 'sepatu-pria-wXpn9', '2024-05-13 18:14:37', '2024-05-13 18:21:03'),
(10, 'Handphone & Aksesoris', 'handphone-aksesoris-mOCNu', '2024-05-13 18:15:00', '2024-05-13 18:21:19'),
(11, 'Fashion Muslim', 'fashion-muslim-DyNHA', '2024-05-13 18:15:51', '2024-05-13 18:21:36'),
(12, 'Koper & Tas Travel', 'koper-tas-travel-ethpr', '2024-05-13 18:21:51', '2024-05-13 18:21:51'),
(13, 'Tas Wanita', 'tas-wanita-z0de3', '2024-05-13 18:22:04', '2024-05-13 18:22:04'),
(14, 'Pakaian Wanita', 'pakaian-wanita-VaEOx', '2024-05-13 18:22:15', '2024-05-13 18:22:15'),
(15, 'Sepatu Wanita', 'sepatu-wanita-HF0cX', '2024-05-13 18:22:27', '2024-05-13 18:22:27'),
(16, 'Tas Pria', 'tas-pria-Omi3W', '2024-05-13 18:22:38', '2024-05-13 18:22:38'),
(17, 'Jam Tangan', 'jam-tangan-zXplH', '2024-05-13 18:22:50', '2024-05-13 18:22:50'),
(18, 'Audio', 'audio-Pf12w', '2024-05-13 18:22:58', '2024-05-13 18:22:58'),
(19, 'Makanan & Minuman', 'makanan-minuman-IsgsJ', '2024-05-13 18:23:10', '2024-05-13 18:23:10'),
(20, 'Perawatan & Kecantikan', 'perawatan-kecantikan-N8O9L', '2024-05-13 18:23:22', '2024-05-13 18:23:22'),
(21, 'Ibu & Bayi', 'ibu-bayi-Q4auE', '2024-05-13 18:23:40', '2024-05-13 18:23:40'),
(22, 'Fashion Bayi & Anak', 'fashion-bayi-anak-rFvSz', '2024-05-13 18:23:49', '2024-05-13 18:23:49'),
(23, 'Kamera & Drone', 'kamera-drone-6sJbj', '2024-05-13 18:24:03', '2024-05-13 18:24:03'),
(24, 'Perlengkapan Rumah', 'perlengkapan-rumah-jKP5h', '2024-05-13 18:24:15', '2024-05-13 18:24:15'),
(25, 'Olahraga & Outdoor', 'olahraga-outdoor-Gmucd', '2024-05-13 18:24:31', '2024-05-13 18:24:31'),
(26, 'Buku & Alat Tulis', 'buku-alat-tulis-eH8nj', '2024-05-13 18:24:43', '2024-05-13 18:24:43'),
(27, 'Hobi & Koleksi', 'hobi-koleksi-iUwYE', '2024-05-13 18:24:53', '2024-05-13 18:24:53'),
(28, 'Mobil', 'mobil-rDnfC', '2024-05-13 18:25:02', '2024-05-13 18:25:02'),
(29, 'Sepeda Motor', 'sepeda-motor-vlm2x', '2024-05-13 18:25:15', '2024-05-13 18:25:15'),
(30, 'Tiket, Voucher, & Layanan', 'tiket-voucher-layanan-1y5rf', '2024-05-13 18:25:26', '2024-05-13 18:25:26'),
(31, 'Buku & Majalah', 'buku-majalah-ZIwAV', '2024-05-13 18:25:41', '2024-05-13 18:25:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
