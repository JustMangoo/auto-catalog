-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 07, 2024 at 09:08 PM
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
-- Database: `auto-katalogs2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto`
--

CREATE TABLE `auto` (
  `auto_id` bigint(20) UNSIGNED NOT NULL,
  `autonr` varchar(20) NOT NULL,
  `autogads` year(4) NOT NULL,
  `marka_id` bigint(20) UNSIGNED NOT NULL,
  `motors_id` bigint(20) UNSIGNED NOT NULL,
  `motoratilpums` decimal(4,0) NOT NULL,
  `pilnamasa` decimal(4,0) NOT NULL,
  `pasmasa` decimal(4,0) NOT NULL,
  `piedzina_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auto`
--

INSERT INTO `auto` (`auto_id`, `autonr`, `autogads`, `marka_id`, `motors_id`, `motoratilpums`, `pilnamasa`, `pasmasa`, `piedzina_id`, `created_at`, `updated_at`) VALUES
(1, 'AA2012', '2004', 1, 1, 2100, 2000, 1800, 1, NULL, NULL),
(6, 'BZ12', '1987', 1, 1, 3500, 2001, 1800, 1, '2024-02-04 19:41:34', '2024-02-04 19:42:41'),
(7, 'BZ122', '1987', 2, 2, 2300, 1500, 1400, 2, '2024-02-04 22:30:04', '2024-02-04 23:02:44'),
(10, 'YAASS', '2020', 2, 2, 1400, 3322, 2233, 2, '2024-02-05 09:32:19', '2024-02-05 09:32:19'),
(12, 'CE4124', '2020', 4, 2, 1400, 4100, 4000, 3, '2024-02-05 09:56:52', '2024-02-05 09:56:52'),
(13, 'NE4342', '2020', 4, 3, 1600, 3500, 3200, 3, '2024-02-05 09:57:25', '2024-02-05 09:57:25'),
(14, 'NE2211', '1987', 5, 2, 2100, 3000, 1500, 4, '2024-02-05 10:05:25', '2024-02-05 10:05:25'),
(15, 'AC3322', '2020', 3, 3, 3500, 2500, 2400, 2, '2024-02-05 10:07:09', '2024-02-05 10:07:09'),
(16, 'SUSURS', '2010', 5, 2, 2020, 999, 800, 4, '2024-02-05 10:12:05', '2024-02-05 11:40:52'),
(17, 'LVT123', '2010', 3, 3, 1800, 3400, 3300, 3, '2024-02-05 10:13:24', '2024-02-05 10:13:24'),
(18, 'RTU3223', '1987', 2, 4, 1400, 2000, 1900, 3, '2024-02-05 10:14:06', '2024-02-05 10:14:06'),
(19, 'LV1122', '2016', 5, 4, 2000, 3300, 3200, 3, '2024-02-05 10:14:49', '2024-02-05 10:14:49'),
(21, 'KRISTOVSKI', '2024', 3, 2, 6000, 3000, 2800, 2, '2024-02-05 11:08:30', '2024-02-05 11:09:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`auto_id`),
  ADD KEY `auto_marka_id_foreign` (`marka_id`),
  ADD KEY `auto_motors_id_foreign` (`motors_id`),
  ADD KEY `auto_piedzina_id_foreign` (`piedzina_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto`
--
ALTER TABLE `auto`
  MODIFY `auto_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_marka_id_foreign` FOREIGN KEY (`marka_id`) REFERENCES `marka` (`marka_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auto_motors_id_foreign` FOREIGN KEY (`motors_id`) REFERENCES `motors` (`motors_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auto_piedzina_id_foreign` FOREIGN KEY (`piedzina_id`) REFERENCES `piedzina` (`piedzina_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
