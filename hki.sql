-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 03:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hki`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2014_10_12_134109_create_users_table', 1),
(3, '2014_10_12_134110_create_role_table', 1),
(4, '2014_10_12_134111_create_users_detail_table', 1),
(5, '2014_10_12_134112_create_purchasing_table', 1),
(6, '2014_10_12_134113_create_surat_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_07_01_153555_create_surat_supplier_table', 1),
(10, '2023_07_08_035118_create_purchasing_detail_table', 1),
(11, '2023_07_12_150333_create_stocks_table', 2),
(12, '2023_07_15_150025_create_productions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

CREATE TABLE `productions` (
  `id` bigint UNSIGNED NOT NULL,
  `line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productions`
--

INSERT INTO `productions` (`id`, `line`, `shift`, `nilai`, `tanggal`) VALUES
(1, 'AXEL', 'I', 70, '2023-07-17'),
(2, 'AXEL', 'II', 70, '2023-07-17'),
(3, 'AXEL', 'III', 70, '2023-07-17'),
(4, 'C/MBER', 'I', 70, '2023-07-17'),
(5, 'C/MBER', 'II', 70, '2023-07-17'),
(6, 'C/MBER', 'III', 70, '2023-07-17'),
(7, 'YH4', 'I', 70, '2023-07-17'),
(8, 'YH4', 'II', 70, '2023-07-17'),
(9, 'YH4', 'III', 70, '2023-07-17'),
(10, 'Y4L', 'I', 70, '2023-07-17'),
(11, 'Y4L', 'II', 70, '2023-07-17'),
(12, 'Y4L', 'III', 70, '2023-07-17'),
(13, 'LH CVT', 'I', 70, '2023-07-17'),
(14, 'LH CVT', 'II', 70, '2023-07-17'),
(15, 'LH CVT', 'III', 70, '2023-07-17'),
(16, 'LH RH CVT', 'I', 70, '2023-07-17'),
(17, 'LH RH CVT', 'II', 70, '2023-07-17'),
(18, 'LH RH CVT', 'III', 70, '2023-07-17'),
(19, 'ROD', 'I', 70, '2023-07-17'),
(20, 'ROD', 'II', 70, '2023-07-17'),
(21, 'ROD', 'III', 70, '2023-07-17'),
(22, 'TM BODY', 'I', 70, '2023-07-17'),
(23, 'TM BODY', 'II', 70, '2023-07-17'),
(24, 'TM BODY', 'III', 70, '2023-07-17'),
(25, 'AMT  LVUV', 'I', 70, '2023-07-17'),
(26, 'AMT  LVUV', 'II', 70, '2023-07-17'),
(27, 'AMT  LVUV', 'III', 70, '2023-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id_po` bigint UNSIGNED NOT NULL,
  `po_number` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tujuan_po` int DEFAULT NULL,
  `default_supplier_id` bigint UNSIGNED DEFAULT NULL,
  `class` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_destination` int DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id_po`, `po_number`, `id_tujuan_po`, `default_supplier_id`, `class`, `issue_date`, `currency_code`, `id_destination`, `delivery_time`, `status`) VALUES
(98, 'hki202001', 3, 3, 'SUPPLIER', '17/7/2023 - 09.43.54', 'IDR', 2, '2023-07-18 00:00:00', 'Finish'),
(99, 'hki202301', 2, 1, 'SUBCON', '17/7/2023 - 09.48.27', 'IDR', 1, '2023-07-18 00:00:00', 'Finish'),
(100, 'hki220011', 3, 3, 'SUPPLIER', '17/7/2023 - 10.24.23', 'IDR', 2, '2023-07-19 00:00:00', 'Finish'),
(101, 'hki331011', 2, 1, 'SUBCON', '17/7/2023 - 10.37.01', 'IDR', 1, '2023-07-20 00:00:00', 'Finish'),
(106, '307', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(107, '309', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(111, NULL, NULL, NULL, 'SUPPLIER', NULL, NULL, NULL, '2023-04-05 00:00:00', 'Unsend'),
(112, '90', 3, 3, 'SUPPLIER', '19/7/2023 - 22.16.06', 'IDR', 2, '2023-04-05 00:00:00', 'On Progress'),
(113, '700', 2, 2, 'SUBCON', '19/7/2023 - 22.31.02', 'IDR', 1, '2023-04-05 00:00:00', 'On Progress');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing_details`
--

CREATE TABLE `purchasing_details` (
  `id` bigint UNSIGNED NOT NULL,
  `id_po` bigint UNSIGNED NOT NULL,
  `part_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int NOT NULL,
  `order_qty` int NOT NULL,
  `unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `composition` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint NOT NULL,
  `order_number` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasing_details`
--

INSERT INTO `purchasing_details` (`id`, `id_po`, `part_no`, `part_name`, `unit_price`, `order_qty`, `unit`, `composition`, `amount`, `order_number`) VALUES
(30, 98, 't1.4X298.5HX84B', 'JSH440WN-P', 25946, 2000, 'KG', '0.138', 7161096, 'PUU010203'),
(31, 99, '45825-73R00', 'REINF,SPNSN', 3712, 100, 'pcs', '1', 371200, 'puu221133'),
(32, 100, 't1.4X298.5HX84B', 'JSH440WN-P', 25946, 2000, 'kg', '0.138', 7161096, 'puu020311'),
(33, 101, '45825-73R00', 'REINF,SPNSN', 3712, 100, 'pcs', '1', 371200, 'puu113322'),
(34, 106, 'MR307103', 'PIN', 3824, 2000, 'PC', NULL, 7648000, 'PU00140422'),
(35, 107, 'MR307105', 'PIN', 3824, 2000, 'PC', NULL, 7608000, 'PU00140423'),
(36, 108, 'MR307103', 'PIN', 3824, 2000, 'PC', NULL, 7648000, 'PU00140422'),
(37, 108, 'MR307105', 'PIN', 3824, 2000, 'PC', NULL, 7608000, 'PU00140423'),
(38, 109, 'MR307103', 'PIN', 3824, 2000, 'PC', NULL, 7648000, 'PU00140422'),
(39, 109, 'MR307105', 'PIN', 3824, 2000, 'PC', NULL, 7608000, 'PU00140423'),
(40, 110, 'MR307103', 'PIN', 3824, 2000, 'PC', NULL, 7648000, 'PU00140422'),
(41, 110, 'MR307105', 'PIN', 3824, 2000, 'PC', NULL, 7608000, 'PU00140423'),
(42, 111, 'MR307103', 'PIN', 3824, 2000, 'PC', NULL, 7648000, 'PU00140422'),
(43, 111, 'MR307105', 'PIN', 3824, 2000, 'PC', NULL, 7608000, 'PU00140423'),
(44, 112, 'MR307103', 'PIN', 3824, 2000, 'PC', '9000', 68832000000, 'PU00140422'),
(45, 112, 'MR307105', 'PIN', 3824, 2000, 'PC', '78', 596544000, 'PU00140423'),
(46, 113, 'MR307103', 'PIN', 3824, 2000, 'PC', '90', 688320000, 'PU00140422'),
(47, 113, 'MR307105', 'PIN', 3824, 2000, 'PC', '90', 688320000, 'PU00140423');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin HKI'),
(2, 'Admin Subcon'),
(3, 'Admin Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id_sisa` bigint UNSIGNED NOT NULL,
  `id_po` bigint UNSIGNED NOT NULL,
  `qty_sub` int DEFAULT NULL,
  `qty_sup` int DEFAULT NULL,
  `comp_sub` float DEFAULT NULL,
  `comp_sup` float DEFAULT NULL,
  `total` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id_sisa`, `id_po`, `qty_sub`, `qty_sup`, `comp_sub`, `comp_sup`, `total`) VALUES
(12, 98, 100, 2000, 1, 0.138, 176),
(13, 100, NULL, 2000, NULL, 0.138, 276);

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `no_surat` bigint UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `po_number` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`no_surat`, `tanggal`, `po_number`, `pengirim`, `penerima`, `status`) VALUES
(1, '2023-07-18 00:00:00', 'hki202001', 'JFE SHOJI STEEL INDONESIA', 'MIYUKI INDONESIA', 'Finish'),
(2, '2023-07-19 00:00:00', 'hki202301', 'MIYUKI INDONESIA', 'admin HKI', 'Finish'),
(3, '2023-07-19 00:00:00', 'hki220011', 'JFE SHOJI STEEL INDONESIA', 'MIYUKI INDONESIA', 'Finish'),
(4, '2023-07-20 00:00:00', 'hki331011', 'MIYUKI INDONESIA', 'admin HKI', 'Finish');

-- --------------------------------------------------------

--
-- Table structure for table `surat_details`
--

CREATE TABLE `surat_details` (
  `no_surat` bigint UNSIGNED NOT NULL,
  `part_no` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_details`
--

INSERT INTO `surat_details` (`no_surat`, `part_no`, `part_name`, `qty`, `unit`) VALUES
(1, 't1.4X298.5HX84B', 'JSH440WN-P', '2000', 'KG'),
(2, '45825-73R00', 'REINF,SPNSN', '100', 'pcs'),
(3, 't1.4X298.5HX84B', 'JSH440WN-P', '2000', 'kg'),
(4, '45825-73R00', 'REINF,SPNSN', '100', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `role_id`, `password`, `created_at`) VALUES
(1, 'hki', 'admin HKI', '1', '$2a$12$NP61H8qRLkmw5aqNaa2OfuEntASvkqCXD9NfE3l8kPeqj6ndDNIni', NULL),
(2, 'miyuki', 'MIYUKI INDONESIA', '2', '$2y$10$uTjUoQ9zjpQMckrzaOvO6.uvHXSQjA3XJZbRCTJNPB6bUVMg4gatW', '17-07-2023'),
(3, 'JFE', 'JFE SHOJI STEEL INDONESIA', '3', '$2y$10$DKZW8nBhoMHdfOPsK2WrZOcNzFdp3swgCc4v251d1irI0cyX1LU/q', '17-07-2023');

-- --------------------------------------------------------

--
-- Table structure for table `users_detail`
--

CREATE TABLE `users_detail` (
  `id_detail` bigint UNSIGNED NOT NULL,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_perusahaan` int NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_detail`
--

INSERT INTO `users_detail` (`id_detail`, `id_user`, `id_perusahaan`, `class`, `email`, `telepon`, `fax`, `alamat`, `user_date`) VALUES
(1, '1', 1, 'HKI', 'admin@hki.co.id', '087778896543', '123456654321', 'Karawang', NULL),
(4, '2', 30030, 'SUBCON', 'MIYUKIINDONESIA@gmail.com', '02189119670', '02189119670', 'KAWASAN INDUSTRI KIIC KARAWANG JL MALIGI VII LOT.Q-1B, Jawa Barat 41361', '17-07-2023'),
(5, '3', 50010, 'SUPPLIER', 'jfe@gmail.com', '0218980903', '0218980903', 'Kawasan Industri MM 2100 Blok B-4/2, Jalan Kalimantan 1, Cibitung, Gandamekar, Bekasi, Kabupaten Bekasi, Jawa Barat 17530', '17-07-2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id_po`);

--
-- Indexes for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchasing_details_id_po_foreign` (`id_po`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_sisa`),
  ADD KEY `stocks_id_po_foreign` (`id_po`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`no_surat`);

--
-- Indexes for table `surat_details`
--
ALTER TABLE `surat_details`
  ADD KEY `surat_details_no_surat_index` (`no_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id_po` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_sisa` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `no_surat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id_detail` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD CONSTRAINT `purchasing_details_id_po_foreign` FOREIGN KEY (`id_po`) REFERENCES `purchasing` (`id_po`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_id_po_foreign` FOREIGN KEY (`id_po`) REFERENCES `purchasing` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_details`
--
ALTER TABLE `surat_details`
  ADD CONSTRAINT `surat_details_no_surat_foreign` FOREIGN KEY (`no_surat`) REFERENCES `surat` (`no_surat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
