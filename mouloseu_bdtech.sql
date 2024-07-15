-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2024 at 12:55 PM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mouloseu_bdtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_no` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `initial_balance` double DEFAULT NULL,
  `total_balance` double NOT NULL,
  `note` text DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_no`, `name`, `initial_balance`, `total_balance`, `note`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '11111', 'Sales Account', 1000, 1000, 'first account', 1, 1, '2018-12-18 02:58:02', '2022-05-18 08:47:02'),
(3, '21211', 'Sa', NULL, 0, NULL, 0, 1, '2018-12-18 02:58:56', '2022-04-06 03:18:22'),
(4, '454363', 'Acton Rivers', 50000, 50000, 'Ut dolor enim cumque', 0, 1, '2022-04-06 03:15:50', '2022-05-18 08:47:02'),
(5, '2535', 'jk', NULL, 0, NULL, NULL, 1, '2022-04-10 00:00:25', '2022-04-10 00:00:25'),
(6, '1510201503494002', 'Brac Bank', 140000, 140000, 'Last Balance', NULL, 1, '2022-05-18 08:43:20', '2022-05-18 08:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `total_qty` double NOT NULL,
  `item` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin` varchar(191) NOT NULL,
  `checkout` varchar(191) NOT NULL,
  `status` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billers`
--

CREATE TABLE `billers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `company_name` varchar(191) NOT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phone_number` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `state` varchar(191) DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sanlion', NULL, 1, '2022-05-17 13:25:54', '2022-05-17 13:25:54'),
(2, 'Nietz Inverter', NULL, 1, '2022-05-17 13:43:54', '2022-05-17 13:43:54'),
(3, 'Allen-Bradley plc', NULL, 1, '2022-05-17 15:09:42', '2022-05-17 15:09:42'),
(4, 'Omron Monitor', NULL, 1, '2022-05-17 15:18:24', '2022-05-17 15:18:24'),
(5, 'Power Supply', NULL, 1, '2022-05-17 15:21:50', '2022-05-17 15:21:50'),
(6, 'Siemens Inverter', NULL, 1, '2022-05-18 09:18:20', '2022-05-18 09:18:20'),
(7, 'Noya', NULL, 1, '2022-05-18 13:13:22', '2022-05-18 13:13:22'),
(8, 'Emarson', NULL, 1, '2022-05-18 13:50:19', '2022-05-18 13:50:19'),
(9, 'Key chang Printing Machine', NULL, 1, '2022-05-18 14:10:53', '2022-05-18 14:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_in_hand` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Compressore Spare Parts', NULL, NULL, 1, '2022-05-17 13:27:22', '2022-05-17 13:27:22'),
(2, 'Nietz Inverter', NULL, NULL, 1, '2022-05-17 13:44:39', '2022-05-17 13:44:39'),
(3, 'PLC', NULL, NULL, 1, '2022-05-17 15:10:30', '2022-05-17 15:10:30'),
(4, 'Monitor', NULL, NULL, 1, '2022-05-17 15:18:48', '2022-05-17 15:18:48'),
(5, 'Power Supply', NULL, NULL, 1, '2022-05-17 15:22:11', '2022-05-17 15:22:11'),
(6, 'Inverter', NULL, NULL, 1, '2022-05-18 09:18:47', '2022-05-18 09:18:47'),
(7, 'washing', NULL, NULL, 1, '2022-05-18 13:13:52', '2022-05-18 13:13:52'),
(8, 'Printing', NULL, NULL, 1, '2022-05-18 14:11:54', '2022-05-18 14:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `topic` varchar(191) NOT NULL,
  `details` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `amount` double NOT NULL,
  `minimum_amount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `exchange_rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'Bangladeshi Taka', 'BDT', 1, '2020-11-01 00:22:58', '2021-03-29 02:34:40'),
(2, 'Euro', 'Euro', 0.85, '2020-11-01 01:29:12', '2020-11-10 23:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority_id` int(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `interest_id` int(11) DEFAULT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) NOT NULL,
  `factory_address` varchar(191) DEFAULT NULL,
  `head_office_address` varchar(191) DEFAULT NULL,
  `contract_person` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contract_person`)),
  `contract_phone` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contract_phone`)),
  `vat_no` varchar(191) DEFAULT NULL,
  `deposit` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `first_comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_group_id`, `priority_id`, `user_id`, `interest_id`, `company_name`, `designation`, `email`, `phone_number`, `factory_address`, `head_office_address`, `contract_person`, `contract_phone`, `vat_no`, `deposit`, `expense`, `image`, `is_active`, `first_comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'Cupid Washing LTD', NULL, NULL, '0981-3046', 'Kazibari Road,Tongi', 'Tongi', '[\"Mr. X\"]', '[\"01615430144\"]', '0', NULL, NULL, NULL, 1, NULL, '2022-05-17 13:39:19', '2022-05-24 11:30:22'),
(2, 2, 1, NULL, NULL, 'Mega Washing & Dyeing Ltd', NULL, NULL, '01615430144', 'Taltoli,Hotapara,Mirjapur,Gazipur', 'Taltoli,Hotapara,Mirjapur,Gazipur', '[\"Mr. X\"]', '[\"01615430144\"]', NULL, NULL, NULL, NULL, 1, NULL, '2022-05-17 13:51:34', '2022-05-17 13:51:34'),
(3, 4, 1, NULL, NULL, 'Alema Textile Mills Ltd', NULL, 'bdtechsolution121@gmail.com', '01885995487', 'Joydebpur,Gazipur', 'Uttara,Dhaka', '[\"Tania\"]', '[\"01885995458\"]', '000460458-0401', NULL, NULL, NULL, 1, 'Our first priority customer', '2022-05-18 08:59:59', '2022-05-18 08:59:59'),
(5, 1, 1, NULL, NULL, 'test1', NULL, 'test1@gmail.com', '01674837384', 'hgfghfgh', 'sgdfhthyrt', '[null]', '[null]', NULL, NULL, NULL, NULL, 0, NULL, '2022-05-18 10:26:08', '2022-05-18 14:43:48'),
(6, 1, 1, NULL, NULL, 'test2', NULL, 'test2@gmail.com', '01748374833', 'efewfer', 'eewgrer', '[null]', '[null]', NULL, NULL, NULL, NULL, 0, 'dsfgtrh', '2022-05-18 10:27:01', '2022-05-18 14:43:48'),
(7, 5, 1, NULL, NULL, 'Fair Apparels Ltd', NULL, 'bdtechsolution121@gmail.com', '01885995458', 'gazipur', 'Uttara', '[\"Jewel\"]', '[\"01615430144\"]', '000460458-0401', NULL, NULL, NULL, 0, NULL, '2022-05-18 12:26:24', '2022-05-18 14:43:48'),
(8, 1, 1, NULL, NULL, 'testing', NULL, 'bdtechsolution121@gmail.com', '01725839983', 'gazipur', 'Uttara', '[null]', '[null]', '000460458-0401', NULL, NULL, NULL, 0, NULL, '2022-05-18 12:55:38', '2022-05-18 14:43:48'),
(9, 5, 1, NULL, NULL, 'testing', NULL, 'testing@gmail.com', '01720380840', 'Gazipur', 'Uttara', '[\"tanvir\"]', '[\"01885995456\"]', '000460458-0103', NULL, NULL, NULL, 0, NULL, '2022-05-18 12:58:02', '2022-05-18 14:43:48'),
(10, 5, 1, NULL, NULL, 'testing', NULL, 'testing@gmail.com', '01720380840', 'Gazipur', 'Uttara', '[\"tanvir\"]', '[\"01885995456\"]', '000460458-0103', NULL, NULL, NULL, 0, NULL, '2022-05-18 12:58:05', '2022-05-18 12:58:57'),
(11, 5, 1, NULL, NULL, 'testing', NULL, 'testing@gmail.com', '01720380840', 'Gazipur', 'Uttara', '[\"tanvir\"]', '[\"01885995456\"]', '000460458-0103', NULL, NULL, NULL, 0, NULL, '2022-05-18 12:58:06', '2022-05-18 12:58:45'),
(12, 6, 1, NULL, NULL, 'Kimbali Fashion Ltd', NULL, 'kimbalifashion@gmail.com', '01963001413', 'Gazipur', 'Uttara', '[\"Dino\"]', '[\"01885995452\"]', '000460458-0401', NULL, NULL, NULL, 0, 'ok', '2022-05-18 13:02:38', '2022-05-18 14:43:48'),
(13, 3, 1, NULL, NULL, 'test', NULL, 'asdaf@gmail.com', '01910030277', 'asfdsfadf', 'agafgadfgad', '[null]', '[null]', NULL, NULL, NULL, NULL, 0, NULL, '2022-05-19 15:35:10', '2022-05-22 09:12:13'),
(14, 6, 1, NULL, NULL, 'test1', 'Quis consequatur', 'jifyqehe@mailinator.com', '+1 (228) 268-2295', 'Et eos tempore qua', 'Assumenda harum moll', '[\"Dolores eveniet eu\"]', '[\"+1 (193) 471-2143\"]', 'Cupiditate sed adipi', NULL, NULL, NULL, 1, 'Quibusdam itaque aut', '2022-05-24 11:23:15', '2022-05-24 11:24:51'),
(15, 1, 1, NULL, NULL, 'NORBAN COMTEX LTD', 'SR. MANAGER (MAINTENANCE & UTILITY)', 'nazmul.maintenance@norbangroup.com', '02-9666707635', 'HOLDING #181, BLOCK #A , TETUIBARI , SARABO, KASHIMPUR , GAZIPUR-1346,.', 'HOUSE #8/B , ROAD #1, GULSHAN -1, DHAKA', '[\"MD. NAZMUL ISLAM\"]', '[\"01755-511729\"]', 'N/A', NULL, NULL, NULL, 1, NULL, '2022-05-26 09:47:34', '2022-05-26 09:47:34'),
(16, 1, 1, NULL, NULL, 'NORBAN COMTEX LTD', 'AGM (MAINTENANCE & UTYLITY)', 'monrul.maintenace@norbangroup.com', 'N/A', 'HOLDING @181, BLOCK #A , TETUIBARI , SARABO, KASHIMPUR , GAZIPUR-1346', 'HOUSE # 1/B , ROAD #1 , GULSHAN-1 , DHAKA-1212', '[\"MD. MONIRUL ISLAM\"]', '[\"01755-511723\"]', 'N/A', NULL, NULL, NULL, 1, NULL, '2022-05-26 09:56:55', '2022-05-26 09:56:55'),
(17, 7, 1, NULL, NULL, 'Lewis and Mclean Associates', 'Perspiciatis dolor', 'koxirifa@mailinator.com', '+1 (557) 531-2354', 'Quis reprehenderit', 'Numquam sit facilis', '[\"Perferendis facilis\",\"Quis aute ducimus h\"]', '[\"+1 (623) 486-1699\",\"+1 (357) 732-7755\"]', 'Exercitationem velit', NULL, NULL, NULL, 1, 'Enim enim sunt velit', '2022-06-06 07:52:20', '2022-06-06 07:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `percentage` varchar(191) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `percentage`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Compressore Spare Parts', '0', 1, '2022-05-17 13:35:38', '2022-05-17 13:35:38'),
(2, 'Nietz Inverter Nz-2400', '0', 1, '2022-05-17 13:48:41', '2022-05-17 13:48:41'),
(3, 'Power Supply', '0', 1, '2022-05-18 08:35:47', '2022-05-18 08:35:47'),
(4, 'Inverter', '0', 1, '2022-05-18 08:45:46', '2022-05-18 08:45:46'),
(5, 'Servo Drive', '0', 1, '2022-05-18 10:02:18', '2022-05-18 10:02:18'),
(6, 'dyeing', '0', 1, '2022-05-18 13:00:11', '2022-05-18 13:00:11'),
(7, 'Compressor', '0', 1, '2022-05-28 08:56:18', '2022-05-28 08:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `customer_priorities`
--

CREATE TABLE `customer_priorities` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `priority` varchar(191) NOT NULL,
  `note` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_priorities`
--

INSERT INTO `customer_priorities` (`id`, `priority`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'priority 1', NULL, 1, '2022-05-17 13:34:45', '2022-05-17 13:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `delivered_by` varchar(191) DEFAULT NULL,
  `recieved_by` varchar(191) DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2022-05-24 11:54:19', '2022-05-24 11:54:19'),
(2, 'Sales or Marketing', 1, '2022-05-24 11:54:58', '2022-05-24 11:54:58'),
(3, 'Service', 1, '2022-05-24 11:55:28', '2022-05-24 11:55:28'),
(4, 'test', 0, '2022-05-28 09:16:26', '2022-05-28 09:17:06'),
(5, 'test1', 1, '2022-05-28 00:17:49', '2022-05-28 00:17:49'),
(6, 'test2', 1, '2022-05-28 00:19:59', '2022-05-28 00:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd', NULL, NULL),
(2, 1, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd', NULL, NULL),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd', NULL, NULL),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', NULL, NULL, 'www.rangamati.gov.bd', NULL, NULL),
(5, 1, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd', NULL, NULL),
(6, 1, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd', NULL, NULL),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd', NULL, NULL),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd', NULL, NULL),
(9, 1, 'Coxsbazar', 'কক্সবাজার', NULL, NULL, 'www.coxsbazar.gov.bd', NULL, NULL),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd', NULL, NULL),
(11, 1, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd', NULL, NULL),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd', NULL, NULL),
(13, 2, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd', NULL, NULL),
(14, 2, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd', NULL, NULL),
(15, 2, 'Rajshahi', 'রাজশাহী', NULL, NULL, 'www.rajshahi.gov.bd', NULL, NULL),
(16, 2, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd', NULL, NULL),
(17, 2, 'Joypurhat', 'জয়পুরহাট', NULL, NULL, 'www.joypurhat.gov.bd', NULL, NULL),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd', NULL, NULL),
(19, 2, 'Naogaon', 'নওগাঁ', NULL, NULL, 'www.naogaon.gov.bd', NULL, NULL),
(20, 3, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd', NULL, NULL),
(21, 3, 'Satkhira', 'সাতক্ষীরা', NULL, NULL, 'www.satkhira.gov.bd', NULL, NULL),
(22, 3, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd', NULL, NULL),
(23, 3, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd', NULL, NULL),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd', NULL, NULL),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd', NULL, NULL),
(26, 3, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd', NULL, NULL),
(27, 3, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd', NULL, NULL),
(28, 3, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd', NULL, NULL),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd', NULL, NULL),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL, 'www.jhalakathi.gov.bd', NULL, NULL),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd', NULL, NULL),
(32, 4, 'Pirojpur', 'পিরোজপুর', NULL, NULL, 'www.pirojpur.gov.bd', NULL, NULL),
(33, 4, 'Barisal', 'বরিশাল', NULL, NULL, 'www.barisal.gov.bd', NULL, NULL),
(34, 4, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd', NULL, NULL),
(35, 4, 'Barguna', 'বরগুনা', NULL, NULL, 'www.barguna.gov.bd', NULL, NULL),
(36, 5, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd', NULL, NULL),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd', NULL, NULL),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd', NULL, NULL),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd', NULL, NULL),
(40, 6, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd', NULL, NULL),
(41, 6, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd', NULL, NULL),
(42, 6, 'Shariatpur', 'শরীয়তপুর', NULL, NULL, 'www.shariatpur.gov.bd', NULL, NULL),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd', NULL, NULL),
(44, 6, 'Tangail', 'টাঙ্গাইল', NULL, NULL, 'www.tangail.gov.bd', NULL, NULL),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd', NULL, NULL),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL, 'www.manikganj.gov.bd', NULL, NULL),
(47, 6, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd', NULL, NULL),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL, 'www.munshiganj.gov.bd', NULL, NULL),
(49, 6, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd', NULL, NULL),
(50, 6, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd', NULL, NULL),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd', NULL, NULL),
(52, 6, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd', NULL, NULL),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd', NULL, NULL),
(54, 7, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd', NULL, NULL),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL, 'www.lalmonirhat.gov.bd', NULL, NULL),
(56, 7, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd', NULL, NULL),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd', NULL, NULL),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd', NULL, NULL),
(59, 7, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd', NULL, NULL),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd', NULL, NULL),
(61, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd', NULL, NULL),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', NULL, NULL, 'www.mymensingh.gov.bd', NULL, NULL),
(63, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd', NULL, NULL),
(64, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', 'www.chittagongdiv.gov.bd', NULL, NULL),
(2, 'Rajshahi', 'রাজশাহী', 'www.rajshahidiv.gov.bd', NULL, NULL),
(3, 'Khulna', 'খুলনা', 'www.khulnadiv.gov.bd', NULL, NULL),
(4, 'Barisal', 'বরিশাল', 'www.barisaldiv.gov.bd', NULL, NULL),
(5, 'Sylhet', 'সিলেট', 'www.sylhetdiv.gov.bd', NULL, NULL),
(6, 'Dhaka', 'ঢাকা', 'www.dhakadiv.gov.bd', NULL, NULL),
(7, 'Rangpur', 'রংপুর', 'www.rangpurdiv.gov.bd', NULL, NULL),
(8, 'Mymensingh', 'ময়মনসিংহ', 'www.mymensinghdiv.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `division_branch` varchar(191) DEFAULT NULL,
  `department_id` int(10) DEFAULT NULL,
  `employee_code` varchar(191) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `father_name` varchar(191) DEFAULT NULL,
  `mother_name` varchar(191) DEFAULT NULL,
  `national_id` varchar(191) DEFAULT NULL,
  `marital_status` varchar(191) DEFAULT NULL,
  `religion` varchar(191) DEFAULT NULL,
  `blood_group` varchar(191) DEFAULT NULL,
  `nationality` varchar(191) DEFAULT NULL,
  `present_address` varchar(191) DEFAULT NULL,
  `present_city` varchar(191) DEFAULT NULL,
  `present_district` varchar(191) DEFAULT NULL,
  `permanent_address` varchar(191) DEFAULT NULL,
  `permanent_city` varchar(191) DEFAULT NULL,
  `permanent_district` varchar(191) DEFAULT NULL,
  `present_ad_division` int(11) DEFAULT NULL,
  `present_ad_district` int(11) DEFAULT NULL,
  `present_ad_thana` int(11) DEFAULT NULL,
  `permanent_ad_division` int(11) DEFAULT NULL,
  `permanent_ad_district` int(11) DEFAULT NULL,
  `permanent_ad_thana` int(11) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `office_phone_number` int(20) DEFAULT NULL,
  `relationship` varchar(191) DEFAULT NULL,
  `relative_name` varchar(191) DEFAULT NULL,
  `relative_phone_number` varchar(191) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `grade` varchar(191) DEFAULT NULL,
  `qualification` varchar(191) DEFAULT NULL,
  `type_of_employee` varchar(191) DEFAULT NULL,
  `overtime_count` varchar(191) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `shift` varchar(191) DEFAULT NULL,
  `present_salary` varchar(191) DEFAULT NULL,
  `attendance_required` varchar(191) DEFAULT NULL,
  `work_starting_time` time DEFAULT NULL,
  `work_ending_time` time DEFAULT NULL,
  `late_count` time DEFAULT NULL,
  `early_count` time DEFAULT NULL,
  `logout_required` varchar(191) DEFAULT NULL,
  `half_day_absent` varchar(191) DEFAULT NULL,
  `weekly_holiday` varchar(191) DEFAULT NULL,
  `total_leave` varchar(191) DEFAULT NULL,
  `created_by` int(50) DEFAULT NULL,
  `updated_by` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `employee_name`, `image`, `document`, `is_active`, `company_name`, `division_branch`, `department_id`, `employee_code`, `date_of_birth`, `gender`, `father_name`, `mother_name`, `national_id`, `marital_status`, `religion`, `blood_group`, `nationality`, `present_address`, `present_city`, `present_district`, `permanent_address`, `permanent_city`, `permanent_district`, `present_ad_division`, `present_ad_district`, `present_ad_thana`, `permanent_ad_division`, `permanent_ad_district`, `permanent_ad_thana`, `email`, `phone_number`, `office_phone_number`, `relationship`, `relative_name`, `relative_phone_number`, `joining_date`, `position`, `grade`, `qualification`, `type_of_employee`, `overtime_count`, `effective_date`, `shift`, `present_salary`, `attendance_required`, `work_starting_time`, `work_ending_time`, `late_count`, `early_count`, `logout_required`, `half_day_absent`, `weekly_holiday`, `total_leave`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 92, 'Md. khabirul islam', NULL, NULL, 1, 'BD Tech Solution', 'uttara', 1, '00001', '1982-11-21', 'male', 'Mohammad Salah Uddin Khan', 'Mrs. Khaleda Khan', '19822911087646219', 'married', 'islam', 'o+', 'Bangladeshi', 'House-52(A3) Alaul Avenue, Sector-6, Uttara, Dhaka', 'Dhaka North', 'Dhaka', 'Vill & Post.: Fakir Haty, P.S.: Bhanga, Dist.: Faridpur', 'Dhaka South', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, 'kishepon69@gmail.com', '01670263447', 1915430144, 'wife', 'Mrs. Sanjida Afrin', NULL, '2011-03-01', 'sr', 'Manager', 'post_raduation', 'permanent', 'no', '2022-05-26', 'Day', NULL, 'yes', '09:30:00', '18:00:00', '09:31:00', '09:15:00', 'yes', 'no', 'Friday', '30', NULL, NULL, '2022-05-26 08:32:48', '2022-05-26 08:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(191) NOT NULL,
  `site_logo` varchar(191) DEFAULT NULL,
  `currency` varchar(191) NOT NULL,
  `staff_access` varchar(191) NOT NULL,
  `date_format` varchar(191) NOT NULL,
  `developed_by` varchar(191) NOT NULL,
  `invoice_format` varchar(191) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `theme` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_position` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_logo`, `currency`, `staff_access`, `date_format`, `developed_by`, `invoice_format`, `state`, `theme`, `created_at`, `updated_at`, `currency_position`) VALUES
(1, 'BD Tech Solution', 'logo.jpeg', '1', 'all', 'd-m-Y', 'Wardan Tech', 'standard', 1, 'default.css', '2018-07-06 06:13:11', '2022-05-10 14:51:27', 'prefix');

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_no` varchar(191) NOT NULL,
  `amount` double NOT NULL,
  `expense` double NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gift_card_recharges`
--

CREATE TABLE `gift_card_recharges` (
  `id` int(10) UNSIGNED NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `note` text DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_settings`
--

CREATE TABLE `hrm_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `checkin` varchar(191) NOT NULL,
  `checkout` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_settings`
--

INSERT INTO `hrm_settings` (`id`, `checkin`, `checkout`, `created_at`, `updated_at`) VALUES
(1, '9:30am', '6:15pm', '2019-01-02 02:20:08', '2022-05-21 14:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic` varchar(191) NOT NULL,
  `details` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'en', '2018-07-07 22:59:17', '2019-12-24 17:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_17_060412_create_categories_table', 1),
(4, '2018_02_20_035727_create_brands_table', 1),
(5, '2018_02_25_100635_create_suppliers_table', 1),
(6, '2018_02_27_101619_create_warehouse_table', 1),
(7, '2018_03_03_040448_create_units_table', 1),
(8, '2018_03_04_041317_create_taxes_table', 1),
(9, '2018_03_10_061915_create_customer_groups_table', 1),
(10, '2018_03_10_090534_create_customers_table', 1),
(11, '2018_03_11_095547_create_billers_table', 1),
(12, '2018_04_05_054401_create_products_table', 1),
(13, '2018_04_06_133606_create_purchases_table', 1),
(14, '2018_04_06_154600_create_product_purchases_table', 1),
(15, '2018_04_06_154915_create_product_warhouse_table', 1),
(16, '2018_04_10_085927_create_sales_table', 1),
(17, '2018_04_10_090133_create_product_sales_table', 1),
(18, '2018_04_10_090254_create_payments_table', 1),
(19, '2018_04_10_090341_create_payment_with_cheque_table', 1),
(20, '2018_04_10_090509_create_payment_with_credit_card_table', 1),
(21, '2018_04_13_121436_create_quotation_table', 1),
(22, '2018_04_13_122324_create_product_quotation_table', 1),
(23, '2018_04_14_121802_create_transfers_table', 1),
(24, '2018_04_14_121913_create_product_transfer_table', 1),
(25, '2018_05_13_082847_add_payment_id_and_change_sale_id_to_payments_table', 2),
(26, '2018_05_13_090906_change_customer_id_to_payment_with_credit_card_table', 3),
(27, '2018_05_20_054532_create_adjustments_table', 4),
(28, '2018_05_20_054859_create_product_adjustments_table', 4),
(29, '2018_05_21_163419_create_returns_table', 5),
(30, '2018_05_21_163443_create_product_returns_table', 5),
(31, '2018_06_02_050905_create_roles_table', 6),
(32, '2018_06_02_073430_add_columns_to_users_table', 7),
(33, '2018_06_03_053738_create_permission_tables', 8),
(36, '2018_06_21_063736_create_pos_setting_table', 9),
(37, '2018_06_21_094155_add_user_id_to_sales_table', 10),
(38, '2018_06_21_101529_add_user_id_to_purchases_table', 11),
(39, '2018_06_21_103512_add_user_id_to_transfers_table', 12),
(40, '2018_06_23_061058_add_user_id_to_quotations_table', 13),
(41, '2018_06_23_082427_add_is_deleted_to_users_table', 14),
(42, '2018_06_25_043308_change_email_to_users_table', 15),
(43, '2018_07_06_115449_create_general_settings_table', 16),
(44, '2018_07_08_043944_create_languages_table', 17),
(45, '2018_07_11_102144_add_user_id_to_returns_table', 18),
(46, '2018_07_11_102334_add_user_id_to_payments_table', 18),
(47, '2018_07_22_130541_add_digital_to_products_table', 19),
(49, '2018_07_24_154250_create_deliveries_table', 20),
(50, '2018_08_16_053336_create_expense_categories_table', 21),
(51, '2018_08_17_115415_create_expenses_table', 22),
(55, '2018_08_18_050418_create_gift_cards_table', 23),
(56, '2018_08_19_063119_create_payment_with_gift_card_table', 24),
(57, '2018_08_25_042333_create_gift_card_recharges_table', 25),
(58, '2018_08_25_101354_add_deposit_expense_to_customers_table', 26),
(59, '2018_08_26_043801_create_deposits_table', 27),
(60, '2018_09_02_044042_add_keybord_active_to_pos_setting_table', 28),
(61, '2018_09_09_092713_create_payment_with_paypal_table', 29),
(62, '2018_09_10_051254_add_currency_to_general_settings_table', 30),
(63, '2018_10_22_084118_add_biller_and_store_id_to_users_table', 31),
(65, '2018_10_26_034927_create_coupons_table', 32),
(66, '2018_10_27_090857_add_coupon_to_sales_table', 33),
(67, '2018_11_07_070155_add_currency_position_to_general_settings_table', 34),
(68, '2018_11_19_094650_add_combo_to_products_table', 35),
(69, '2018_12_09_043712_create_accounts_table', 36),
(70, '2018_12_17_112253_add_is_default_to_accounts_table', 37),
(71, '2018_12_19_103941_add_account_id_to_payments_table', 38),
(72, '2018_12_20_065900_add_account_id_to_expenses_table', 39),
(73, '2018_12_20_082753_add_account_id_to_returns_table', 40),
(74, '2018_12_26_064330_create_return_purchases_table', 41),
(75, '2018_12_26_144210_create_purchase_product_return_table', 42),
(76, '2018_12_26_144708_create_purchase_product_return_table', 43),
(77, '2018_12_27_110018_create_departments_table', 44),
(78, '2018_12_30_054844_create_employees_table', 45),
(79, '2018_12_31_125210_create_payrolls_table', 46),
(80, '2018_12_31_150446_add_department_id_to_employees_table', 47),
(81, '2019_01_01_062708_add_user_id_to_expenses_table', 48),
(82, '2019_01_02_075644_create_hrm_settings_table', 49),
(83, '2019_01_02_090334_create_attendances_table', 50),
(84, '2019_01_27_160956_add_three_columns_to_general_settings_table', 51),
(85, '2019_02_15_183303_create_stock_counts_table', 52),
(86, '2019_02_17_101604_add_is_adjusted_to_stock_counts_table', 53),
(87, '2019_04_13_101707_add_tax_no_to_customers_table', 54),
(89, '2019_10_14_111455_create_holidays_table', 55),
(90, '2019_11_13_145619_add_is_variant_to_products_table', 56),
(91, '2019_11_13_150206_create_product_variants_table', 57),
(92, '2019_11_13_153828_create_variants_table', 57),
(93, '2019_11_25_134041_add_qty_to_product_variants_table', 58),
(94, '2019_11_25_134922_add_variant_id_to_product_purchases_table', 58),
(95, '2019_11_25_145341_add_variant_id_to_product_warehouse_table', 58),
(96, '2019_11_29_182201_add_variant_id_to_product_sales_table', 59),
(97, '2019_12_04_121311_add_variant_id_to_product_quotation_table', 60),
(98, '2019_12_05_123802_add_variant_id_to_product_transfer_table', 61),
(100, '2019_12_08_114954_add_variant_id_to_product_returns_table', 62),
(101, '2019_12_08_203146_add_variant_id_to_purchase_product_return_table', 63),
(102, '2020_02_28_103340_create_money_transfers_table', 64),
(103, '2020_07_01_193151_add_image_to_categories_table', 65),
(105, '2020_09_26_130426_add_user_id_to_deliveries_table', 66),
(107, '2020_10_11_125457_create_cash_registers_table', 67),
(108, '2020_10_13_155019_add_cash_register_id_to_sales_table', 68),
(109, '2020_10_13_172624_add_cash_register_id_to_returns_table', 69),
(110, '2020_10_17_212338_add_cash_register_id_to_payments_table', 70),
(111, '2020_10_18_124200_add_cash_register_id_to_expenses_table', 71),
(112, '2020_10_21_121632_add_developed_by_to_general_settings_table', 72),
(113, '2019_08_19_000000_create_failed_jobs_table', 73),
(114, '2020_10_30_135557_create_notifications_table', 73),
(115, '2020_11_01_044954_create_currencies_table', 74),
(116, '2020_11_01_140736_add_price_to_product_warehouse_table', 75),
(117, '2020_11_02_050633_add_is_diff_price_to_products_table', 76),
(118, '2020_11_09_055222_add_user_id_to_customers_table', 77),
(119, '2020_11_17_054806_add_invoice_format_to_general_settings_table', 78),
(120, '2021_04_08_055910_create_comments_table', 79),
(122, '2021_04_08_041550_create_reminders_table', 80),
(123, '2021_04_11_050114_create_interests_table', 81),
(124, '2021_04_12_045317_add_interest_id_to_customers', 82),
(125, '2021_04_15_062027_create_service_categories_table', 83),
(129, '2021_04_17_045728_create_services_table', 84),
(130, '2021_04_20_062333_create_service_sales_table', 84),
(131, '2021_04_20_110957_create_service_sale_details_table', 85),
(132, '2021_04_20_153944_create_service_payments_table', 86),
(133, '2021_04_20_232453_create_service_payment_with_cheques_table', 87),
(135, '2021_04_22_101044_create_service_deliveries_table', 88),
(136, '2021_06_01_070900_add_paid_to_sales_table', 89),
(137, '2021_06_05_091934_add_paid_to_service_payments_table', 89);

-- --------------------------------------------------------

--
-- Table structure for table `money_transfers`
--

CREATE TABLE `money_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `purpose` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_reference` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `change` double NOT NULL,
  `paying_method` varchar(191) NOT NULL,
  `payment_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_cheque`
--

CREATE TABLE `payment_with_cheque` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `cheque_no` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_credit_card`
--

CREATE TABLE `payment_with_credit_card` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_stripe_id` varchar(191) DEFAULT NULL,
  `charge_id` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_gift_card`
--

CREATE TABLE `payment_with_gift_card` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_with_paypal`
--

CREATE TABLE `payment_with_paypal` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `transaction_id` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `paying_method` varchar(191) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'products-edit', 'web', '2018-06-03 01:00:09', '2018-06-03 01:00:09'),
(5, 'products-delete', 'web', '2018-06-03 22:54:22', '2018-06-03 22:54:22'),
(6, 'products-add', 'web', '2018-06-04 00:34:14', '2018-06-04 00:34:14'),
(7, 'products-index', 'web', '2018-06-04 03:34:27', '2018-06-04 03:34:27'),
(8, 'purchases-index', 'web', '2018-06-04 08:03:19', '2018-06-04 08:03:19'),
(9, 'purchases-add', 'web', '2018-06-04 08:12:25', '2018-06-04 08:12:25'),
(10, 'purchases-edit', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(11, 'purchases-delete', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(12, 'sales-index', 'web', '2018-06-04 10:49:08', '2018-06-04 10:49:08'),
(13, 'sales-add', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(14, 'sales-edit', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(15, 'sales-delete', 'web', '2018-06-04 10:49:53', '2018-06-04 10:49:53'),
(16, 'quotes-index', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(17, 'quotes-add', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(18, 'quotes-edit', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(19, 'quotes-delete', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(20, 'transfers-index', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(21, 'transfers-add', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(22, 'transfers-edit', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(23, 'transfers-delete', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(24, 'returns-index', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(25, 'returns-add', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(26, 'returns-edit', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(27, 'returns-delete', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(28, 'customers-index', 'web', '2018-06-04 23:15:54', '2018-06-04 23:15:54'),
(29, 'customers-add', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(30, 'customers-edit', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(31, 'customers-delete', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(32, 'suppliers-index', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(33, 'suppliers-add', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(34, 'suppliers-edit', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(35, 'suppliers-delete', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(36, 'product-report', 'web', '2018-06-24 23:05:33', '2018-06-24 23:05:33'),
(37, 'purchase-report', 'web', '2018-06-24 23:24:56', '2018-06-24 23:24:56'),
(38, 'sale-report', 'web', '2018-06-24 23:33:13', '2018-06-24 23:33:13'),
(39, 'customer-report', 'web', '2018-06-24 23:36:51', '2018-06-24 23:36:51'),
(40, 'due-report', 'web', '2018-06-24 23:39:52', '2018-06-24 23:39:52'),
(41, 'users-index', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(42, 'users-add', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(43, 'users-edit', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(44, 'users-delete', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(45, 'profit-loss', 'web', '2018-07-14 21:50:05', '2018-07-14 21:50:05'),
(46, 'best-seller', 'web', '2018-07-14 22:01:38', '2018-07-14 22:01:38'),
(47, 'daily-sale', 'web', '2018-07-14 22:24:21', '2018-07-14 22:24:21'),
(48, 'monthly-sale', 'web', '2018-07-14 22:30:41', '2018-07-14 22:30:41'),
(49, 'daily-purchase', 'web', '2018-07-14 22:36:46', '2018-07-14 22:36:46'),
(50, 'monthly-purchase', 'web', '2018-07-14 22:48:17', '2018-07-14 22:48:17'),
(51, 'payment-report', 'web', '2018-07-14 23:10:41', '2018-07-14 23:10:41'),
(52, 'warehouse-stock-report', 'web', '2018-07-14 23:16:55', '2018-07-14 23:16:55'),
(53, 'product-qty-alert', 'web', '2018-07-14 23:33:21', '2018-07-14 23:33:21'),
(54, 'supplier-report', 'web', '2018-07-30 03:00:01', '2018-07-30 03:00:01'),
(55, 'expenses-index', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(56, 'expenses-add', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(57, 'expenses-edit', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(58, 'expenses-delete', 'web', '2018-09-05 01:07:11', '2018-09-05 01:07:11'),
(59, 'general_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(60, 'mail_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(61, 'pos_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(62, 'hrm_setting', 'web', '2019-01-02 10:30:23', '2019-01-02 10:30:23'),
(63, 'purchase-return-index', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(64, 'purchase-return-add', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(65, 'purchase-return-edit', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(66, 'purchase-return-delete', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(67, 'account-index', 'web', '2019-01-02 22:06:13', '2019-01-02 22:06:13'),
(68, 'balance-sheet', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(69, 'account-statement', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(70, 'department', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(71, 'attendance', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(72, 'payroll', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(73, 'employees-index', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(74, 'employees-add', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(75, 'employees-edit', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(76, 'employees-delete', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(77, 'user-report', 'web', '2019-01-16 06:48:18', '2019-01-16 06:48:18'),
(78, 'stock_count', 'web', '2019-02-17 10:32:01', '2019-02-17 10:32:01'),
(79, 'adjustment', 'web', '2019-02-17 10:32:02', '2019-02-17 10:32:02'),
(80, 'sms_setting', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(81, 'create_sms', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(82, 'print_barcode', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(83, 'empty_database', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(84, 'customer_group', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(85, 'unit', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(86, 'tax', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(87, 'gift_card', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(88, 'coupon', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(89, 'holiday', 'web', '2019-10-19 08:57:15', '2019-10-19 08:57:15'),
(90, 'warehouse-report', 'web', '2019-10-22 06:00:23', '2019-10-22 06:00:23'),
(91, 'warehouse', 'web', '2020-02-26 06:47:32', '2020-02-26 06:47:32'),
(92, 'brand', 'web', '2020-02-26 06:59:59', '2020-02-26 06:59:59'),
(93, 'billers-index', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(94, 'billers-add', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(95, 'billers-edit', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(96, 'billers-delete', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(97, 'money-transfer', 'web', '2020-03-02 05:41:48', '2020-03-02 05:41:48'),
(98, 'category', 'web', '2020-07-13 12:13:16', '2020-07-13 12:13:16'),
(99, 'delivery', 'web', '2020-07-13 12:13:16', '2020-07-13 12:13:16'),
(100, 'send_notification', 'web', '2020-10-31 06:21:31', '2020-10-31 06:21:31'),
(101, 'today_sale', 'web', '2020-10-31 06:57:04', '2020-10-31 06:57:04'),
(102, 'today_profit', 'web', '2020-10-31 06:57:04', '2020-10-31 06:57:04'),
(103, 'currency', 'web', '2020-11-09 00:23:11', '2020-11-09 00:23:11'),
(104, 'backup_database', 'web', '2020-11-15 00:16:55', '2020-11-15 00:16:55'),
(105, 'reminder-index', 'web', '2021-04-08 12:09:54', '2021-04-08 12:09:54'),
(106, 'reminder-edit', 'web', '2021-04-09 18:20:21', '2021-04-09 18:20:21'),
(107, 'reminder-delete', 'web', '2021-04-09 18:20:21', '2021-04-09 18:20:21'),
(108, 'reminder-add', 'web', '2021-04-09 18:28:58', '2021-04-09 18:28:58'),
(109, 'reminder-alert', 'web', '2021-04-10 05:37:42', '2021-04-10 05:37:42'),
(110, 'interest', 'web', '2021-04-11 03:58:41', '2021-04-11 03:58:41'),
(111, 'service_category', 'web', '2021-04-24 03:13:48', '2021-04-24 03:13:48'),
(112, 'service_delivery', 'web', '2021-04-24 03:18:12', '2021-04-24 03:18:12'),
(113, 'services-index', 'web', '2021-04-24 03:48:06', '2021-04-24 03:48:06'),
(114, 'services-add', 'web', '2021-04-24 03:51:30', '2021-04-24 03:51:30'),
(115, 'services-edit', 'web', '2021-04-24 03:55:18', '2021-04-24 03:55:18'),
(116, 'services-delete', 'web', '2021-04-24 03:55:18', '2021-04-24 03:55:18'),
(117, 'service-sales-index', 'web', '2021-04-24 04:07:46', '2021-04-24 04:07:46'),
(118, 'service-sales-add', 'web', '2021-04-24 04:07:46', '2021-04-24 04:07:46'),
(119, 'service-sales-edit', 'web', '2021-04-24 04:07:46', '2021-04-24 04:07:46'),
(120, 'service-sales-delete', 'web', '2021-04-24 04:07:46', '2021-04-24 04:07:46'),
(121, 'print_qrcode', 'web', '2021-04-24 05:44:11', '2021-04-24 05:44:11'),
(122, 'comments-index', 'web', '2021-04-28 22:30:56', '2021-04-28 22:30:56'),
(123, 'comments-add', 'web', '2021-04-28 22:30:57', '2021-04-28 22:30:57'),
(124, 'comments-edit', 'web', '2021-04-28 22:30:57', '2021-04-28 22:30:57'),
(125, 'comments-delete', 'web', '2021-04-28 22:30:57', '2021-04-28 22:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `pos_setting`
--

CREATE TABLE `pos_setting` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `product_number` int(11) NOT NULL,
  `keybord_active` tinyint(1) NOT NULL,
  `stripe_public_key` varchar(191) DEFAULT NULL,
  `stripe_secret_key` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pos_setting`
--

INSERT INTO `pos_setting` (`id`, `customer_id`, `warehouse_id`, `biller_id`, `product_number`, `keybord_active`, `stripe_public_key`, `stripe_secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 984, 1, 'pk_test_ITN7KOYiIsHSCQ0UMRcgaYUB', 'Est ea esse perfere', '2018-09-02 03:17:04', '2022-05-10 15:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `barcode_symbology` varchar(191) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `cost` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `qty` double DEFAULT NULL,
  `alert_quantity` double DEFAULT NULL,
  `promotion` tinyint(4) DEFAULT NULL,
  `promotion_price` varchar(191) DEFAULT NULL,
  `starting_date` varchar(200) DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_method` int(11) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `is_variant` tinyint(1) DEFAULT NULL,
  `is_diffPrice` tinyint(1) DEFAULT NULL,
  `warranty` varchar(191) DEFAULT NULL,
  `product_item_code` int(30) DEFAULT NULL,
  `product_list` varchar(191) DEFAULT NULL,
  `qty_list` varchar(191) DEFAULT NULL,
  `price_list` varchar(191) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `type`, `barcode_symbology`, `brand_id`, `category_id`, `unit_id`, `purchase_unit_id`, `sale_unit_id`, `cost`, `price`, `qty`, `alert_quantity`, `promotion`, `promotion_price`, `starting_date`, `last_date`, `tax_id`, `tax_method`, `image`, `file`, `is_variant`, `is_diffPrice`, `warranty`, `product_item_code`, `product_list`, `qty_list`, `price_list`, `product_details`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Inverter', '13863762', 'standard', 'C128', 2, 2, 1, 1, 1, '1000', '10000', -2, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '1 year', 35842320, NULL, NULL, NULL, '<p>value=@ @</p>', 0, '2022-05-17 15:05:45', '2022-05-18 14:37:54'),
(2, 'PLC', '18925324', 'standard', 'C128', 3, 3, 1, 1, 1, '500', '5000', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '0', 99270933, NULL, NULL, NULL, '', 0, '2022-05-17 15:11:18', '2022-05-18 14:40:27'),
(3, 'Monitor', '50609384', 'standard', 'C128', 4, 4, 1, 1, 1, '500', '25000', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '0', 3682941, NULL, NULL, NULL, '<p>value=@ @</p>', 0, '2022-05-17 15:19:37', '2022-05-18 14:40:04'),
(4, 'Power Supply', '05354326', 'standard', 'C128', 5, 5, 1, 1, 1, '500', '2500', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, 'N/A', 53069457, NULL, NULL, NULL, '<p>value=@ value=@ @ @</p>', 0, '2022-05-17 15:23:18', '2022-05-18 14:37:17'),
(5, 'Siemens Inverter 5.5 KW,440V,M/D: 22567', '08954289', 'standard', 'C128', 6, 6, 1, 1, 1, '500', '3500', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '1 year', 26059093, NULL, NULL, NULL, '', 0, '2022-05-18 09:19:20', '2022-05-18 14:36:40'),
(6, 'Inverter,Model.NZ2400,Power-11Kw,440V', '19140560', 'standard', 'C128', 2, 6, 1, 1, 1, '2500', '28000', 0, 10, NULL, NULL, NULL, NULL, NULL, 2, 'zummXD2dvAtI.png', NULL, NULL, NULL, '1 Year', 92497536, NULL, NULL, NULL, '', 0, '2022-05-18 13:09:50', '2022-05-18 14:38:59'),
(7, 'Washing Machine', '26097784', 'standard', 'C128', 7, 7, 1, 1, 1, '72', '208', 0, 10, NULL, NULL, NULL, NULL, NULL, 2, 'zummXD2dvAtI.png', NULL, NULL, NULL, '1 Year', 87320419, NULL, NULL, NULL, '', 0, '2022-05-18 13:14:56', '2022-05-18 14:08:12'),
(8, 'wasahing', '60122150', 'standard', 'C128', 7, 7, 1, 1, 1, '14', '20', -1, 2, NULL, NULL, NULL, NULL, NULL, 2, 'zummXD2dvAtI.png', NULL, NULL, NULL, '1 Year', 42257823, NULL, NULL, NULL, '', 0, '2022-05-18 13:18:56', '2022-05-18 14:32:06'),
(9, 'machine', '55813839', 'standard', 'C128', 7, 7, 1, 1, 1, '500', '5000', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '12 month', 33096227, NULL, NULL, NULL, '<p>value=@ @</p>', 0, '2022-05-18 13:40:13', '2022-05-18 14:39:41'),
(10, 'inverter,Model-125', '53419706', 'standard', 'C128', 8, 6, 1, 1, 1, '500', '5000', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '1 Year', 11683249, NULL, NULL, NULL, '', 0, '2022-05-18 13:53:11', '2022-05-18 14:38:45'),
(11, 'fgbhgsfh', '07457012', 'standard', 'C128', 8, 6, 1, 1, 1, '5', '5', 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '1 Year', 80686713, NULL, NULL, NULL, '', 0, '2022-05-18 13:59:51', '2022-05-18 14:35:04'),
(12, 'Flat Belt Printing Machine', '71001263', 'standard', 'C128', 9, 8, 1, 1, 1, '1250', '12500', -1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, 0, '5 Year', 69241317, NULL, NULL, NULL, '', 0, '2022-05-18 14:12:29', '2022-05-18 14:41:06'),
(13, 'Inverter', '60758628', 'standard', 'C128', 6, 6, 1, 1, 1, '500', '10000', 4, 2, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, '1 year', 9075698, NULL, NULL, NULL, '', 1, '2022-05-19 08:32:12', '2022-06-23 14:27:29'),
(14, 'Power Supply', '98737659', 'standard', 'C128', 5, 5, 1, 1, 1, '500', '3500', 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 'zummXD2dvAtI.png', NULL, NULL, NULL, '1 year', 49297036, NULL, NULL, NULL, 'skskjsdkdsjjsjdjljd', 1, '2022-05-19 08:46:22', '2022-06-23 14:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_adjustments`
--

CREATE TABLE `product_adjustments` (
  `id` int(10) UNSIGNED NOT NULL,
  `adjustment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `action` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchases`
--

CREATE TABLE `product_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `recieved` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_purchases`
--

INSERT INTO `product_purchases` (`id`, `purchase_id`, `product_id`, `variant_id`, `qty`, `recieved`, `purchase_unit_id`, `net_unit_cost`, `discount`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(5, 4, 13, NULL, 5, 5, 1, 500, 0, 0, 0, 2500, '2022-06-23 14:15:31', '2022-06-23 14:15:31'),
(6, 5, 14, NULL, 1, 1, 1, 500, 0, 0, 0, 500, '2022-06-23 14:24:01', '2022-06-23 14:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_quotation`
--

CREATE TABLE `product_quotation` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_returns`
--

CREATE TABLE `product_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`id`, `sale_id`, `product_id`, `variant_id`, `qty`, `sale_unit_id`, `net_unit_price`, `discount`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 3, 8, NULL, 1, 1, 20, 0, 0, 0, 20, '2022-05-18 13:44:49', '2022-05-18 13:44:49'),
(2, 4, 1, NULL, 2, 1, 10000, 0, 0, 0, 20000, '2022-05-18 13:45:41', '2022-05-18 13:45:41'),
(3, 5, 12, NULL, 1, 1, 12500, 0, 0, 0, 12500, '2022-05-18 14:23:11', '2022-05-18 14:23:11'),
(4, 6, 13, NULL, 1, 1, 10000, 0, 0, 0, 10000, '2022-06-23 14:27:30', '2022-06-23 14:27:30'),
(5, 6, 14, NULL, 1, 1, 3500, 0, 0, 0, 3500, '2022-06-23 14:27:30', '2022-06-23 14:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_transfer`
--

CREATE TABLE `product_transfer` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `item_code` varchar(191) NOT NULL,
  `additional_price` double DEFAULT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse`
--

CREATE TABLE `product_warehouse` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehouse`
--

INSERT INTO `product_warehouse` (`id`, `product_id`, `variant_id`, `warehouse_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, '8', NULL, 1, -1, NULL, '2022-05-18 13:42:35', '2022-05-18 14:07:17'),
(2, '1', NULL, 1, -2, NULL, '2022-05-18 13:44:30', '2022-05-18 14:07:07'),
(3, '12', NULL, 1, -1, NULL, '2022-05-18 14:19:02', '2022-05-18 14:41:06'),
(4, '13', NULL, 1, 4, NULL, '2022-06-23 14:15:31', '2022-06-23 14:27:30'),
(5, '14', NULL, 1, 0, NULL, '2022-06-23 14:24:01', '2022-06-23 14:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `paid_amount` double NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `reference_no`, `user_id`, `warehouse_id`, `supplier_id`, `item`, `total_qty`, `total_discount`, `total_tax`, `total_cost`, `order_tax_rate`, `order_tax`, `order_discount`, `shipping_cost`, `grand_total`, `paid_amount`, `status`, `payment_status`, `document`, `note`, `created_at`, `updated_at`) VALUES
(4, 'pr-20220623-081531', 1, 1, 1, 1, 5, 0, 0, 2500, 0, 0, NULL, NULL, 2500, 0, 1, 1, NULL, NULL, '2022-06-23 14:15:31', '2022-06-23 14:15:31'),
(5, 'pr-20220623-082401', 1, 1, 1, 1, 1, 0, 0, 500, 0, 0, NULL, NULL, 500, 0, 1, 1, NULL, NULL, '2022-06-23 14:24:01', '2022-06-23 14:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product_return`
--

CREATE TABLE `purchase_product_return` (
  `id` int(10) UNSIGNED NOT NULL,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_no` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `quotation_status` int(11) NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `topic` varchar(191) NOT NULL,
  `note` varchar(191) DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `return_note` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_purchases`
--

CREATE TABLE `return_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `return_note` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `guard_name` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin can access all data...', 'web', 1, '2018-06-01 23:46:44', '2018-06-02 23:13:05'),
(2, 'Owner', 'Owner of shop...', 'web', 1, '2018-10-22 02:38:13', '2018-10-22 02:38:13'),
(4, 'staff', 'staff has specific acess...', 'web', 1, '2018-06-02 00:05:27', '2018-06-02 00:05:27'),
(5, 'Customer', NULL, 'web', 1, '2020-11-05 06:43:16', '2020-11-15 00:24:15'),
(6, 'helper', NULL, 'web', 0, '2021-07-31 04:53:41', '2021-07-31 04:53:55'),
(7, 'Marketing (Hena)', NULL, 'web', 1, '2022-05-17 12:19:32', '2022-05-17 12:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 4),
(7, 1),
(7, 2),
(7, 4),
(8, 1),
(8, 2),
(8, 4),
(9, 1),
(9, 2),
(9, 4),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 4),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(20, 4),
(21, 1),
(21, 2),
(21, 4),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(24, 4),
(25, 1),
(25, 2),
(25, 4),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(28, 4),
(29, 1),
(29, 2),
(29, 4),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(55, 4),
(56, 1),
(56, 2),
(56, 4),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(63, 4),
(64, 1),
(64, 2),
(64, 4),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(71, 4),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(75, 1),
(75, 2),
(76, 1),
(76, 2),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(79, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(85, 1),
(85, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(95, 1),
(95, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `service_quotation_id` int(11) DEFAULT NULL,
  `service_item` longtext DEFAULT NULL,
  `carried_by` varchar(191) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `grand_total` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `discount_method` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `commission_rate` double DEFAULT NULL,
  `commission_amount` double DEFAULT NULL,
  `sale_status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `sale_note` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `reference_no`, `user_id`, `cash_register_id`, `customer_id`, `biller_id`, `warehouse_id`, `service_quotation_id`, `service_item`, `carried_by`, `item`, `total_qty`, `total_discount`, `total_tax`, `total_price`, `grand_total`, `order_tax_rate`, `order_tax`, `order_discount`, `discount_method`, `coupon_id`, `coupon_discount`, `shipping_cost`, `commission_rate`, `commission_amount`, `sale_status`, `payment_status`, `document`, `paid_amount`, `sale_note`, `staff_note`, `created_at`, `updated_at`) VALUES
(1, 'sr-20220517-122147', 1, NULL, 1, NULL, 1, 2, 'BZh91AY&SYP¹\0Éß@\0Pø/-Ü¿ïÿú@õØÑ°\r!$IhÅ#\riµ\0õ\r4Úja&¢\"OIé\0P\0Ó@\0\0\0\0\0\0£jb=A =@\Zh\0\0\0©	rpo!³«]XOÅ?:4¿M­¨;Ìl52)&\'_ÒÌLb²T,\Z$H¤²\ZG=\0ú(D`j%\0ÃAA	®¥@A\nh`dª¢ ²0aÈ	»J¤1R¡÷ß/3ºÝÎÌÙ­å´U\'$ºTÂVM;ªä¨\'û	qü\n¼ò`@Âà`Y%ÞÀk ()MÞlÛFÚ$Ùqi[(Ã0å\n@P¤¦r¦vs¾ÉIÍ­CÄ9÷Íù1Î\ZØTÙ(~ö&\"sñ)áA©¤ïn\\â¿V`Ùø>^~0¼\'Ãó¦xjjï1ixHàëG=¥:Ôæ-1É)1[&¬O¼ÈÉo¾ÕdíË/`Ý×:`TJ­¤FÛòÖH÷ÎÛ®&EË¸µ.\rJ±,¹2¿/.NK!nm:a!A×PâjÉ·)êëÉ=éMbEA+*÷ãî$Î};µÕAº;}9AF×ÊÕ\\5]ÕUº×f%Ãõ¸£P.9\r½+jï íyõ-ÓøïÄá´ª¾pÐ!ÛM4R·\"meã)³4MÖ°UÜ¶õíá<ÞñOETDE«CwÎíT\roÝJA¶û¢ªªÕO°x@&hM+¼ð!!¤a¯voi³Ý²ÓýSq2mÏúêy8iû9ÎQIÁ\Zÿ¹\"(HF(LÜ', NULL, 1, 1, 0, 0, 1000, 1000, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 1, 2, NULL, NULL, NULL, NULL, '2022-05-17 16:21:47', '2022-05-17 16:21:47'),
(2, 'sr-20220518-083027', 1, NULL, 7, NULL, 1, 5, 'BZh91AY&SY±)ËK\0Ëß@\0Pø//Ü¿ïÿú@ü¦spww	$&S&&ÓÔ4$oJÔ\r\Z<¦ÁA$J44\0\0\0\04	5B§©¦@Ð\r\r\0@	M4Ð6 \0!Q!j(yg¦rh«;ØZ±ùBêxÑº*FFÌ¥æc\rÌ,\\/¸½ËÍLFòã1z_àDÒõÀÊ£`RLè¨iH\0ÒÃb `Æ0Px±eF@d$AP¡LDKHXeÂr!îZ/Ab}z^Z(y6Ê¨5ÙjY;¬*®JCÄ?«¿ de0\nªVi0Ùºµ@PR)!°]z½	/E ÃUª»0Â25ÌÉhj°ºNG¸¯^ÓÓ{(Î7¦¾ÓÐdâ|Jj,cEò¤YV¤ù·Ng­\n`ÓäpéÏ¯¶¨°?SÑnâI©°Ì.:óàÊn0%¹<+gÄOf-!Ã³æð^9©Y#M×jté¡¯ F\rájÿFº¢:³%ùk¬~*êµ²C1UiùzÇ8¯iéP°±s{×uÚidÛæ¾nNªz%:\nÙ2ªóbLý¯¶Éêø\'¶]9½Q[¯Ê°ëg6³ÃãqRX¢4Ù7VEÑcA.Þ+\n~Ü}¯!WgéïÉ¥i_MU)3IIËUez+§·dêòì¥\"\"(¨,Û@¡ µmêã×©³Uf©F\ZDõSqNfvw(¦Õ2e/ì&ÃXÏ+â5Ï+7<Í24w{8Gª¨ÖÃ0°aÿrE8P±)ËK', NULL, 1, 1, 0, 0, 5000, 6200, 0, 0, 0, NULL, NULL, NULL, 1200, 0, 0, 1, 2, NULL, NULL, NULL, NULL, '2022-05-18 12:30:27', '2022-05-18 12:30:27'),
(3, 'sr-20220518-094449', 1, NULL, 3, NULL, 1, NULL, NULL, NULL, 1, 1, 0, 0, 20, 20, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 1, 2, NULL, NULL, NULL, NULL, '2022-05-18 13:44:49', '2022-05-18 13:44:49'),
(4, 'sr-20220518-094541', 1, NULL, 1, NULL, 1, NULL, NULL, 'adsfds', 1, 2, 0, 0, 20000, 20000, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, '2022-05-18 13:45:41', '2022-05-18 13:45:41'),
(5, 'sr-20220518-102311', 1, NULL, 2, NULL, 1, NULL, NULL, 'kjkhh', 1, 1, 0, 0, 12500, 11875, 0, 0, 5, NULL, NULL, NULL, 5, 5, 625, 1, 2, NULL, NULL, NULL, NULL, '2022-05-18 14:23:11', '2022-05-18 14:23:11'),
(6, 'sr-20220623-082729', 1, NULL, 3, NULL, 1, NULL, NULL, NULL, 2, 2, 0, 0, 13500, 13500, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, '2022-06-23 14:27:29', '2022-06-23 14:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_method` int(11) DEFAULT NULL,
  `price` varchar(191) NOT NULL,
  `details` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `code`, `category_id`, `tax_id`, `tax_method`, `price`, `details`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'Compressore Spare Parts', 'S-21220788', 4, NULL, 1, '3000', 'gfggf', 1, '2022-05-19 12:42:06', '2022-05-19 12:42:06'),
(7, 'Siemens Inverter-7.5KW', 'S-02938119', 1, NULL, 1, '29', 'Service Ok', 1, '2022-05-19 12:42:23', '2022-05-19 12:42:23'),
(8, 'Power Supply', 'S-07580039', 2, NULL, 1, '2500', 'uhujjlk', 1, '2022-05-19 12:43:00', '2022-05-19 12:43:00'),
(9, 'Power Supply', 'S-74096375', 2, NULL, 1, '5000', 'BJHBKKJB', 1, '2022-05-19 14:44:18', '2022-05-19 14:44:18'),
(10, 'Monitor', 'S-73216915', 3, NULL, 1, '25000', 'GJHJ', 1, '2022-05-19 15:14:46', '2022-05-19 15:14:46'),
(11, 'test service', 'S-56403213', 5, 1, 1, '99', 'asfafadf', 1, '2022-05-19 15:32:08', '2022-05-19 15:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `services_quotations`
--

CREATE TABLE `services_quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_quotations_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `qty` double DEFAULT NULL,
  `net_unit_price` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `tax_rate` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_quotations`
--

INSERT INTO `services_quotations` (`id`, `service_quotations_id`, `service_id`, `qty`, `net_unit_price`, `discount`, `tax_rate`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(3, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Inverter', NULL, 1, '2022-05-17 16:19:02', '2022-05-17 16:19:02'),
(2, 'Power Supply', NULL, 1, '2022-05-18 10:16:06', '2022-05-18 10:16:06'),
(3, 'Monitor', NULL, 1, '2022-05-18 12:27:35', '2022-05-18 12:27:35'),
(4, 'Compressore Spare Parts', NULL, 1, '2022-05-19 12:41:42', '2022-05-19 12:41:42'),
(5, 'test category', NULL, 1, '2022-05-19 15:30:17', '2022-05-19 15:30:17'),
(6, 'AC', 1, 1, '2023-09-29 00:39:29', '2023-09-29 00:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `service_deliveries`
--

CREATE TABLE `service_deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(191) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `delivered_by` varchar(191) DEFAULT NULL,
  `recieved_by` varchar(191) DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_payments`
--

CREATE TABLE `service_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `payment_reference` varchar(191) NOT NULL,
  `amount` double NOT NULL,
  `change` double NOT NULL,
  `paying_method` varchar(191) NOT NULL,
  `payment_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_payment_with_cheques`
--

CREATE TABLE `service_payment_with_cheques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` int(11) NOT NULL,
  `cheque_no` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_quotations`
--

CREATE TABLE `service_quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_status` int(11) DEFAULT NULL,
  `quotation_no` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `delivary_date` date DEFAULT NULL,
  `warranty` varchar(191) DEFAULT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `total_qty` double DEFAULT NULL,
  `total_discount` double DEFAULT NULL,
  `total_vat` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `quotation_status` int(11) DEFAULT NULL,
  `document` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `bareer_name` varchar(191) DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `p_sl` double DEFAULT NULL,
  `purpose` varchar(191) DEFAULT NULL,
  `bd_sl` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_quotations`
--

INSERT INTO `service_quotations` (`id`, `sale_status`, `quotation_no`, `date`, `delivary_date`, `warranty`, `reference_no`, `user_id`, `supplier_id`, `customer_id`, `warehouse_id`, `item`, `total_qty`, `total_discount`, `total_vat`, `total_price`, `order_tax_rate`, `order_tax`, `order_discount`, `grand_total`, `quotation_status`, `document`, `note`, `bareer_name`, `designation`, `description`, `p_sl`, `purpose`, `bd_sl`, `created_at`, `updated_at`) VALUES
(4, NULL, 20220002, '2022-05-18', NULL, 'N/A', 'qr-20220518-051332', 1, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 'gfgfghhfg', 'Mr. X', 'Messanger', 'N/A', 12344546546, 'Repair', 5012, '2022-05-18 09:13:32', '2022-05-18 09:13:32'),
(5, 1, 20220003, '2022-05-18', NULL, '0', 'qr-20220518-082902', 1, NULL, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 'sdfhgdyg', 'Arif', 'messenger', 'Monitor', 56456464, 'Repair', 54564654, '2022-05-18 12:29:02', '2022-05-18 12:30:27'),
(6, NULL, 20220004, '2022-05-19', '2022-05-25', 'Iusto eius consequun', 'qr-20220519-052142', 1, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Saepe rerum eaque pe', 'Gretchen Finley', 'Vero voluptatem lab', 'Id magni rem ut nece', 89, 'Molestias expedita q', 72, '2022-05-19 09:21:42', '2022-05-19 10:20:03'),
(10, NULL, 20220004, '2022-05-19', '2022-05-26', 'N/A', 'qr-20220519-111524', 1, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 'YUIIOOP', 'MR. KAJAL', 'Messanger', 'N/A', 88888, 'Repair', 7011, '2022-05-19 15:15:24', '2022-05-19 15:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `service_sales`
--

CREATE TABLE `service_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `grand_total` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `sale_status` varchar(191) NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `paid_amount` double DEFAULT NULL,
  `sale_note` text DEFAULT NULL,
  `staff_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_sale_details`
--

CREATE TABLE `service_sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `discount` double DEFAULT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_counts`
--

CREATE TABLE `stock_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` varchar(191) DEFAULT NULL,
  `brand_id` varchar(191) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `initial_file` varchar(191) DEFAULT NULL,
  `final_file` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_adjusted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `company_name` varchar(191) NOT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phone_number` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `state` varchar(191) DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `image`, `company_name`, `vat_number`, `email`, `phone_number`, `address`, `city`, `state`, `postal_code`, `country`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Shibu', NULL, 'Shibu Light House', '000460458-0111', 'Shibu@gmail.com', '0177700025', 'Nobabpur,Dhaka', 'Dhaka', 'Dhaka', '1230', 'Bangladesh', 1, '2022-05-18 13:07:19', '2022-05-18 13:07:19'),
(2, 'Shafiq', NULL, 'Jewel Jewel', '0000-525-653', 'jewel@gmail.com', '01715430144', 'Uttara', 'Dhaka', 'Dhaka', '1230', 'Bangladesh', 1, '2022-05-18 13:54:40', '2022-05-18 13:54:40'),
(3, 'rony', NULL, 'Key Chang Machine Rony', 'No VAT', 'Keychang@gmail.com', '01885995456', 'Dhaka', 'Dhaka', 'Dhaka', '1230', 'Bangladesh', 1, '2022-05-18 14:14:38', '2022-05-18 14:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `rate` double NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `rate`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test@tax10', 10, 1, '2022-05-19 09:20:17', '2022-05-19 09:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `district_id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd', NULL, NULL),
(2, 1, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd', NULL, NULL),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd', NULL, NULL),
(4, 1, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd', NULL, NULL),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd', NULL, NULL),
(6, 1, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd', NULL, NULL),
(7, 1, 'Homna', 'হোমনা', 'homna.comilla.gov.bd', NULL, NULL),
(8, 1, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd', NULL, NULL),
(9, 1, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd', NULL, NULL),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd', NULL, NULL),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd', NULL, NULL),
(12, 1, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd', NULL, NULL),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd', NULL, NULL),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd', NULL, NULL),
(15, 1, 'Titas', 'তিতাস', 'titas.comilla.gov.bd', NULL, NULL),
(16, 1, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd', NULL, NULL),
(17, 1, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd', NULL, NULL),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd', NULL, NULL),
(19, 2, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd', NULL, NULL),
(20, 2, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd', NULL, NULL),
(21, 2, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd', NULL, NULL),
(22, 2, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd', NULL, NULL),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd', NULL, NULL),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd', NULL, NULL),
(25, 3, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd', NULL, NULL),
(26, 3, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd', NULL, NULL),
(27, 3, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd', NULL, NULL),
(28, 3, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd', NULL, NULL),
(29, 3, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd', NULL, NULL),
(30, 3, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd', NULL, NULL),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd', NULL, NULL),
(32, 3, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    ', NULL, NULL),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd', NULL, NULL),
(34, 4, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd', NULL, NULL),
(35, 4, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd', NULL, NULL),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd', NULL, NULL),
(37, 4, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd', NULL, NULL),
(38, 4, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd', NULL, NULL),
(39, 4, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd', NULL, NULL),
(40, 4, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd', NULL, NULL),
(41, 4, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd', NULL, NULL),
(42, 4, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd', NULL, NULL),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd', NULL, NULL),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd', NULL, NULL),
(45, 5, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd', NULL, NULL),
(46, 5, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd', NULL, NULL),
(47, 5, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd', NULL, NULL),
(48, 5, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd', NULL, NULL),
(49, 5, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd', NULL, NULL),
(50, 5, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd', NULL, NULL),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd', NULL, NULL),
(52, 6, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd', NULL, NULL),
(53, 6, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd', NULL, NULL),
(54, 6, 'Shahrasti', 'শাহরাস্তি	', 'shahrasti.chandpur.gov.bd', NULL, NULL),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd', NULL, NULL),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd', NULL, NULL),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd', NULL, NULL),
(58, 6, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd', NULL, NULL),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd', NULL, NULL),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd', NULL, NULL),
(61, 7, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd', NULL, NULL),
(62, 7, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd', NULL, NULL),
(63, 7, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd', NULL, NULL),
(64, 7, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd', NULL, NULL),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd', NULL, NULL),
(66, 8, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd', NULL, NULL),
(67, 8, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd', NULL, NULL),
(68, 8, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd', NULL, NULL),
(69, 8, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd', NULL, NULL),
(70, 8, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd', NULL, NULL),
(71, 8, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd', NULL, NULL),
(72, 8, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd', NULL, NULL),
(73, 8, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd', NULL, NULL),
(74, 8, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd', NULL, NULL),
(75, 8, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd', NULL, NULL),
(76, 8, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd', NULL, NULL),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd', NULL, NULL),
(78, 8, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd', NULL, NULL),
(79, 8, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd', NULL, NULL),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd', NULL, NULL),
(81, 9, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd', NULL, NULL),
(82, 9, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd', NULL, NULL),
(83, 9, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd', NULL, NULL),
(84, 9, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd', NULL, NULL),
(85, 9, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd', NULL, NULL),
(86, 9, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd', NULL, NULL),
(87, 9, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd', NULL, NULL),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd', NULL, NULL),
(89, 10, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd', NULL, NULL),
(90, 10, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd', NULL, NULL),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd', NULL, NULL),
(92, 10, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd', NULL, NULL),
(93, 10, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd', NULL, NULL),
(94, 10, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd', NULL, NULL),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd', NULL, NULL),
(96, 10, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd', NULL, NULL),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd', NULL, NULL),
(98, 11, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd', NULL, NULL),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd', NULL, NULL),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd', NULL, NULL),
(101, 11, 'Lama', 'লামা', 'lama.bandarban.gov.bd', NULL, NULL),
(102, 11, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd', NULL, NULL),
(103, 11, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd', NULL, NULL),
(104, 12, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd', NULL, NULL),
(105, 12, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd', NULL, NULL),
(106, 12, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd', NULL, NULL),
(107, 12, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd', NULL, NULL),
(108, 12, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd', NULL, NULL),
(109, 12, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd', NULL, NULL),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd', NULL, NULL),
(111, 12, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd', NULL, NULL),
(112, 12, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd', NULL, NULL),
(113, 13, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd', NULL, NULL),
(114, 13, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd', NULL, NULL),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd', NULL, NULL),
(116, 13, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd', NULL, NULL),
(117, 13, 'Bera', 'বেড়া', 'bera.pabna.gov.bd', NULL, NULL),
(118, 13, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd', NULL, NULL),
(119, 13, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd', NULL, NULL),
(120, 13, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd', NULL, NULL),
(121, 13, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd', NULL, NULL),
(122, 14, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd', NULL, NULL),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd', NULL, NULL),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd', NULL, NULL),
(125, 14, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd', NULL, NULL),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd', NULL, NULL),
(127, 14, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd', NULL, NULL),
(128, 14, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd', NULL, NULL),
(129, 14, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd', NULL, NULL),
(130, 14, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd', NULL, NULL),
(131, 14, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd', NULL, NULL),
(132, 14, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd', NULL, NULL),
(133, 14, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd', NULL, NULL),
(134, 15, 'Paba', 'পবা', 'paba.rajshahi.gov.bd', NULL, NULL),
(135, 15, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd', NULL, NULL),
(136, 15, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd', NULL, NULL),
(137, 15, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd', NULL, NULL),
(138, 15, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd', NULL, NULL),
(139, 15, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd', NULL, NULL),
(140, 15, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd', NULL, NULL),
(141, 15, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd', NULL, NULL),
(142, 15, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd', NULL, NULL),
(143, 16, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd', NULL, NULL),
(144, 16, 'Singra', 'সিংড়া', 'singra.natore.gov.bd', NULL, NULL),
(145, 16, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd', NULL, NULL),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd', NULL, NULL),
(147, 16, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd', NULL, NULL),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd', NULL, NULL),
(149, 16, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd', NULL, NULL),
(150, 17, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd', NULL, NULL),
(151, 17, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd', NULL, NULL),
(152, 17, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd', NULL, NULL),
(153, 17, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd', NULL, NULL),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd', NULL, NULL),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd', NULL, NULL),
(156, 18, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd', NULL, NULL),
(157, 18, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd', NULL, NULL),
(158, 18, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd', NULL, NULL),
(159, 18, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd', NULL, NULL),
(160, 19, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd', NULL, NULL),
(161, 19, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd', NULL, NULL),
(162, 19, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd', NULL, NULL),
(163, 19, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd', NULL, NULL),
(164, 19, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd', NULL, NULL),
(165, 19, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd', NULL, NULL),
(166, 19, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd', NULL, NULL),
(167, 19, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd', NULL, NULL),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd', NULL, NULL),
(169, 19, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd', NULL, NULL),
(170, 19, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd', NULL, NULL),
(171, 20, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd', NULL, NULL),
(172, 20, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd', NULL, NULL),
(173, 20, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd', NULL, NULL),
(174, 20, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd', NULL, NULL),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd', NULL, NULL),
(176, 20, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd', NULL, NULL),
(177, 20, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd', NULL, NULL),
(178, 20, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd', NULL, NULL),
(179, 21, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd', NULL, NULL),
(180, 21, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd', NULL, NULL),
(181, 21, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd', NULL, NULL),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd', NULL, NULL),
(183, 21, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd', NULL, NULL),
(184, 21, 'Tala', 'তালা', 'tala.satkhira.gov.bd', NULL, NULL),
(185, 21, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd', NULL, NULL),
(186, 22, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd', NULL, NULL),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd', NULL, NULL),
(188, 22, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd', NULL, NULL),
(189, 23, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd', NULL, NULL),
(190, 23, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd', NULL, NULL),
(191, 23, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd', NULL, NULL),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd', NULL, NULL),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd', NULL, NULL),
(194, 24, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd', NULL, NULL),
(195, 24, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd', NULL, NULL),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd', NULL, NULL),
(197, 25, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd', NULL, NULL),
(198, 25, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd', NULL, NULL),
(199, 25, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd', NULL, NULL),
(200, 25, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd', NULL, NULL),
(201, 25, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd', NULL, NULL),
(202, 26, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd', NULL, NULL),
(203, 26, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd', NULL, NULL),
(204, 26, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd', NULL, NULL),
(205, 26, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd', NULL, NULL),
(206, 27, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd', NULL, NULL),
(207, 27, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd', NULL, NULL),
(208, 27, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd', NULL, NULL),
(209, 27, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd', NULL, NULL),
(210, 27, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd', NULL, NULL),
(211, 27, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd', NULL, NULL),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd', NULL, NULL),
(213, 27, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd', NULL, NULL),
(214, 27, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd', NULL, NULL),
(215, 28, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd', NULL, NULL),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd', NULL, NULL),
(217, 28, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd', NULL, NULL),
(218, 28, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd', NULL, NULL),
(219, 28, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd', NULL, NULL),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd', NULL, NULL),
(221, 28, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd', NULL, NULL),
(222, 28, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd', NULL, NULL),
(223, 28, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd', NULL, NULL),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd', NULL, NULL),
(225, 29, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd', NULL, NULL),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd', NULL, NULL),
(227, 29, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd', NULL, NULL),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd', NULL, NULL),
(229, 29, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd', NULL, NULL),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd', NULL, NULL),
(231, 30, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd', NULL, NULL),
(232, 30, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd', NULL, NULL),
(233, 30, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd', NULL, NULL),
(234, 31, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd', NULL, NULL),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd', NULL, NULL),
(236, 31, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd', NULL, NULL),
(237, 31, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd', NULL, NULL),
(238, 31, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd', NULL, NULL),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd', NULL, NULL),
(240, 31, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd', NULL, NULL),
(241, 31, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd', NULL, NULL),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd', NULL, NULL),
(243, 32, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd', NULL, NULL),
(244, 32, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd', NULL, NULL),
(245, 32, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd', NULL, NULL),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd', NULL, NULL),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd', NULL, NULL),
(248, 32, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd', NULL, NULL),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd', NULL, NULL),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd', NULL, NULL),
(251, 33, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd', NULL, NULL),
(252, 33, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd', NULL, NULL),
(253, 33, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd', NULL, NULL),
(254, 33, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd', NULL, NULL),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd', NULL, NULL),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd', NULL, NULL),
(257, 33, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd', NULL, NULL),
(258, 33, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd', NULL, NULL),
(259, 34, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd', NULL, NULL),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd', NULL, NULL),
(261, 34, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd', NULL, NULL),
(262, 34, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd', NULL, NULL),
(263, 34, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd', NULL, NULL),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd', NULL, NULL),
(265, 34, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd', NULL, NULL),
(266, 35, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd', NULL, NULL),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd', NULL, NULL),
(268, 35, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd', NULL, NULL),
(269, 35, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd', NULL, NULL),
(270, 35, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd', NULL, NULL),
(271, 35, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd', NULL, NULL),
(272, 36, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd', NULL, NULL),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd', NULL, NULL),
(274, 36, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd', NULL, NULL),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd', NULL, NULL),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd', NULL, NULL),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd', NULL, NULL),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd', NULL, NULL),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd', NULL, NULL),
(280, 36, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd', NULL, NULL),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd', NULL, NULL),
(282, 36, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd', NULL, NULL),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd', NULL, NULL),
(284, 36, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd', NULL, NULL),
(285, 37, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd', NULL, NULL),
(286, 37, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd', NULL, NULL),
(287, 37, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd', NULL, NULL),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd', NULL, NULL),
(289, 37, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd', NULL, NULL),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd', NULL, NULL),
(291, 37, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd', NULL, NULL),
(292, 38, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd', NULL, NULL),
(293, 38, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd', NULL, NULL),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd', NULL, NULL),
(295, 38, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd', NULL, NULL),
(296, 38, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd', NULL, NULL),
(297, 38, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd', NULL, NULL),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd', NULL, NULL),
(299, 38, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd', NULL, NULL),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd', NULL, NULL),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd', NULL, NULL),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd', NULL, NULL),
(303, 39, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd', NULL, NULL),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd', NULL, NULL),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd', NULL, NULL),
(306, 39, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd', NULL, NULL),
(307, 39, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd', NULL, NULL),
(308, 39, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd', NULL, NULL),
(309, 39, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd', NULL, NULL),
(310, 39, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd', NULL, NULL),
(311, 40, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd', NULL, NULL),
(312, 40, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd', NULL, NULL),
(313, 40, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd', NULL, NULL),
(314, 40, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd', NULL, NULL),
(315, 40, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd', NULL, NULL),
(316, 40, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd', NULL, NULL),
(317, 41, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd', NULL, NULL),
(318, 41, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd', NULL, NULL),
(319, 41, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd', NULL, NULL),
(320, 41, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd', NULL, NULL),
(321, 41, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd', NULL, NULL),
(322, 42, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd', NULL, NULL),
(323, 42, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd', NULL, NULL),
(324, 42, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd', NULL, NULL),
(325, 42, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd', NULL, NULL),
(326, 42, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd', NULL, NULL),
(327, 42, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd', NULL, NULL),
(328, 43, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd', NULL, NULL),
(329, 43, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd', NULL, NULL),
(330, 43, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd', NULL, NULL),
(331, 43, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd', NULL, NULL),
(332, 43, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd', NULL, NULL),
(333, 44, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd', NULL, NULL),
(334, 44, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd', NULL, NULL),
(335, 44, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd', NULL, NULL),
(336, 44, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd', NULL, NULL),
(337, 44, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd', NULL, NULL),
(338, 44, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd', NULL, NULL),
(339, 44, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd', NULL, NULL),
(340, 44, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd', NULL, NULL),
(341, 44, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd', NULL, NULL),
(342, 44, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd', NULL, NULL),
(343, 44, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd', NULL, NULL),
(344, 44, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd', NULL, NULL),
(345, 45, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd', NULL, NULL),
(346, 45, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd', NULL, NULL),
(347, 45, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd', NULL, NULL),
(348, 45, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd', NULL, NULL),
(349, 45, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd', NULL, NULL),
(350, 45, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd', NULL, NULL),
(351, 45, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd', NULL, NULL),
(352, 45, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd', NULL, NULL),
(353, 45, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd', NULL, NULL),
(354, 45, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd', NULL, NULL),
(355, 45, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd', NULL, NULL),
(356, 45, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd', NULL, NULL),
(357, 45, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd', NULL, NULL),
(358, 46, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd', NULL, NULL),
(359, 46, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd', NULL, NULL),
(360, 46, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd', NULL, NULL),
(361, 46, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd', NULL, NULL),
(362, 46, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd', NULL, NULL),
(363, 46, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd', NULL, NULL),
(364, 46, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd', NULL, NULL),
(365, 47, 'Savar', 'সাভার', 'savar.dhaka.gov.bd', NULL, NULL),
(366, 47, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd', NULL, NULL),
(367, 47, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd', NULL, NULL),
(368, 47, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd', NULL, NULL),
(369, 47, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd', NULL, NULL),
(370, 47, 'Adabor', 'আদাবর', '', NULL, NULL),
(371, 47, 'Badda', 'বাড্ডা', '', NULL, NULL),
(372, 47, 'Banani', 'বনানী', '', NULL, NULL),
(373, 47, 'Bangshal', 'বংশাল', '', NULL, NULL),
(374, 47, 'Bimanbandar', 'বিমানবন্দর', '', NULL, NULL),
(375, 47, 'Bsahantek', 'বসহানটেক', '', NULL, NULL),
(376, 47, 'Cantonment', 'ক্যান্টনমেন্ট', '', NULL, NULL),
(377, 47, 'Chalkbazar', 'চকবাজার', '', NULL, NULL),
(378, 47, 'Dakhin Khan', 'দখিন খান', '', NULL, NULL),
(379, 47, 'Darus-Salam', 'দারুস-সালাম', '', NULL, NULL),
(380, 47, 'Demra', 'ডেমরা', '', NULL, NULL),
(381, 47, 'Dhanmondi', 'ধানমন্ডি', '', NULL, NULL),
(382, 47, 'Gandaria', 'গেন্ডারিয়া', '', NULL, NULL),
(384, 47, 'Gulshan', 'গুলশান', '', NULL, NULL),
(385, 47, 'Hazaribag', 'হাজারীবাগ', '', NULL, NULL),
(386, 47, 'Jattrabari', 'যাত্রাবাড়ী', '', NULL, NULL),
(387, 47, 'Kafrul', 'কাফরুল', '', NULL, NULL),
(388, 47, 'Kalabagan', 'কলাবাগান', '', NULL, NULL),
(389, 47, 'Kamrangirchar', 'কামরাঙ্গীরচর', '', NULL, NULL),
(390, 47, 'Khilgaon', 'খিলগাঁও', '', NULL, NULL),
(391, 47, 'Khilkhet', 'খিলক্ষেত', '', NULL, NULL),
(392, 47, 'Kodomtali', 'কদোমতলী', '', NULL, NULL),
(393, 47, 'Kotwali', 'কোতোয়ালি', '', NULL, NULL),
(394, 47, 'Lalbagh', 'লালবাগ', '', NULL, NULL),
(395, 47, 'Mirpur Model', 'মিরপুর মডেল', '', NULL, NULL),
(396, 47, 'Mohammadpur', 'মোহাম্মদপুর', '', NULL, NULL),
(397, 47, 'Motijheel', 'মতিঝিল', '', NULL, NULL),
(398, 47, 'Mugda', 'মুগদা', '', NULL, NULL),
(399, 47, 'New Market', 'নিউমার্কেট', '', NULL, NULL),
(400, 47, 'Pallabi', 'পল্লবী', '', NULL, NULL),
(401, 47, 'Paltan', 'পল্টন', '', NULL, NULL),
(402, 47, 'Ramna Model', 'রমনা মডেল', '', NULL, NULL),
(403, 47, 'Rampura', 'রামপুরা', '', NULL, NULL),
(404, 47, 'Rupnagar', 'রূপনগর', '', NULL, NULL),
(405, 47, 'Sabujbag', 'সবুজবাগ', '', NULL, NULL),
(406, 47, 'Shah Ali', 'শাহ আলী', '', NULL, NULL),
(407, 47, 'Shahbag', 'শাহবাগ', '', NULL, NULL),
(408, 47, 'Shahjahanpur', 'শাহজাহানপুর', '', NULL, NULL),
(409, 47, 'Sutrapur', 'সূত্রাপুর', '', NULL, NULL),
(410, 47, 'Shyampur', 'শ্যামপুর', '', NULL, NULL),
(411, 47, 'Sher-e-Bangla Nagar', 'শেরেবাংলা নগর', '', NULL, NULL),
(412, 47, 'Tejgaon Industrial Police', 'তেজগাঁও শিল্প পুলিশ', '', NULL, NULL),
(413, 47, 'Tejgaon', 'তেজগাঁও', '', NULL, NULL),
(414, 47, 'Turag', 'তুরাগ', '', NULL, NULL),
(415, 47, 'Uttara East', 'উত্তরা পূর্ব', '', NULL, NULL),
(416, 47, 'Uttara West', 'উত্তরা পশ্চিম', '', NULL, NULL),
(417, 47, 'Uttar Khan', 'উত্তর খান', '', NULL, NULL),
(418, 47, 'Vatara', 'ভাটারা', '', NULL, NULL),
(419, 47, 'Wari', 'ওয়ারী', '', NULL, NULL),
(420, 48, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd', NULL, NULL),
(421, 48, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd', NULL, NULL),
(422, 48, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd', NULL, NULL),
(423, 48, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd', NULL, NULL),
(424, 48, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd', NULL, NULL),
(425, 48, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd', NULL, NULL),
(426, 49, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd', NULL, NULL),
(427, 49, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd', NULL, NULL),
(428, 49, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd', NULL, NULL),
(429, 49, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd', NULL, NULL),
(430, 49, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd', NULL, NULL),
(431, 50, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd', NULL, NULL),
(432, 50, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd', NULL, NULL),
(433, 50, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd', NULL, NULL),
(434, 50, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd', NULL, NULL),
(435, 51, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd', NULL, NULL),
(436, 51, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd', NULL, NULL),
(437, 51, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd', NULL, NULL),
(438, 51, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd', NULL, NULL),
(439, 51, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd', NULL, NULL),
(440, 52, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd', NULL, NULL),
(441, 52, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd', NULL, NULL),
(442, 52, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd', NULL, NULL),
(443, 52, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd', NULL, NULL),
(444, 52, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd', NULL, NULL),
(445, 52, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd', NULL, NULL),
(446, 52, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd', NULL, NULL),
(447, 52, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd', NULL, NULL),
(448, 52, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd', NULL, NULL),
(449, 53, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd', NULL, NULL),
(450, 53, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd', NULL, NULL),
(451, 53, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd', NULL, NULL),
(452, 53, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd', NULL, NULL),
(453, 53, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd', NULL, NULL),
(454, 54, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd', NULL, NULL),
(455, 54, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd', NULL, NULL),
(456, 54, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd', NULL, NULL),
(457, 54, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd', NULL, NULL),
(458, 54, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd', NULL, NULL),
(459, 54, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd', NULL, NULL),
(460, 54, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd', NULL, NULL),
(461, 54, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd', NULL, NULL),
(462, 54, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd', NULL, NULL),
(463, 54, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd', NULL, NULL),
(464, 54, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd', NULL, NULL),
(465, 54, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd', NULL, NULL),
(466, 54, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd', NULL, NULL),
(467, 55, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd', NULL, NULL),
(468, 55, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd', NULL, NULL),
(469, 55, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd', NULL, NULL),
(470, 55, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd', NULL, NULL),
(471, 55, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd', NULL, NULL),
(472, 56, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd', NULL, NULL),
(473, 56, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd', NULL, NULL),
(474, 56, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd', NULL, NULL),
(475, 56, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd', NULL, NULL),
(476, 56, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd', NULL, NULL),
(477, 56, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd', NULL, NULL),
(478, 57, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd', NULL, NULL),
(479, 57, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd', NULL, NULL),
(480, 57, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd', NULL, NULL),
(481, 57, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd', NULL, NULL),
(482, 57, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd', NULL, NULL),
(483, 57, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd', NULL, NULL),
(484, 57, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd', NULL, NULL),
(485, 58, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd', NULL, NULL),
(486, 58, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd', NULL, NULL),
(487, 58, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd', NULL, NULL),
(488, 58, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd', NULL, NULL),
(489, 58, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd', NULL, NULL),
(490, 59, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd', NULL, NULL),
(491, 59, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd', NULL, NULL),
(492, 59, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd', NULL, NULL),
(493, 59, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd', NULL, NULL),
(494, 59, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd', NULL, NULL),
(495, 59, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd', NULL, NULL),
(496, 59, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd', NULL, NULL),
(497, 59, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd', NULL, NULL),
(498, 60, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd', NULL, NULL),
(499, 60, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd', NULL, NULL),
(500, 60, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd', NULL, NULL),
(501, 60, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd', NULL, NULL),
(502, 60, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd', NULL, NULL),
(503, 60, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd', NULL, NULL),
(504, 60, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd', NULL, NULL),
(505, 60, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd', NULL, NULL),
(506, 60, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd', NULL, NULL),
(507, 61, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd', NULL, NULL),
(508, 61, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd', NULL, NULL),
(509, 61, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd', NULL, NULL),
(510, 61, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd', NULL, NULL),
(511, 61, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd', NULL, NULL),
(512, 62, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd', NULL, NULL),
(513, 62, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd', NULL, NULL),
(514, 62, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd', NULL, NULL),
(515, 62, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd', NULL, NULL),
(516, 62, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd', NULL, NULL),
(517, 62, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd', NULL, NULL),
(518, 62, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd', NULL, NULL),
(519, 62, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd', NULL, NULL),
(520, 62, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd', NULL, NULL),
(521, 62, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd', NULL, NULL),
(522, 62, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd', NULL, NULL),
(523, 62, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd', NULL, NULL),
(524, 62, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd', NULL, NULL),
(525, 63, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd', NULL, NULL),
(526, 63, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd', NULL, NULL),
(527, 63, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd', NULL, NULL),
(528, 63, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd', NULL, NULL),
(529, 63, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd', NULL, NULL),
(530, 63, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd', NULL, NULL),
(531, 63, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd', NULL, NULL),
(532, 64, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd', NULL, NULL),
(533, 64, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd', NULL, NULL),
(534, 64, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd', NULL, NULL),
(535, 64, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd', NULL, NULL),
(536, 64, 'Madan', 'মদন', 'madan.netrokona.gov.bd', NULL, NULL),
(537, 64, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd', NULL, NULL),
(538, 64, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd', NULL, NULL),
(539, 64, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd', NULL, NULL),
(540, 64, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd', NULL, NULL),
(541, 64, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `from_warehouse_id` int(11) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_code` varchar(191) NOT NULL,
  `unit_name` varchar(191) DEFAULT NULL,
  `base_unit` int(11) DEFAULT NULL,
  `operator` varchar(191) DEFAULT NULL,
  `operation_value` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `base_unit`, `operator`, `operation_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '001', 'PC', NULL, '*', 1, 1, '2022-05-17 14:54:04', '2022-05-17 15:02:44'),
(2, '121', 'lTR', NULL, '*', 1, 1, '2022-05-17 15:25:44', '2022-05-17 15:25:44'),
(3, '122', 'Drum', NULL, '*', 1, 1, '2022-05-17 15:26:15', '2022-05-17 15:26:35'),
(4, '123', 'yard', NULL, '*', 1, 1, '2022-05-17 16:04:33', '2022-05-17 16:04:33'),
(5, '124', 'job', NULL, '*', 1, 1, '2022-05-17 16:05:02', '2022-05-17 16:05:02'),
(6, '125', 'Set', NULL, '*', 1, 1, '2022-05-17 16:06:27', '2022-05-17 16:06:27'),
(7, '126', 'Roll', NULL, '*', 1, 1, '2022-05-17 16:06:42', '2022-05-17 16:06:42'),
(8, '127', 'Kg', NULL, '*', 1, 1, '2022-05-17 16:07:00', '2022-05-17 16:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `phone`, `company_name`, `role_id`, `biller_id`, `warehouse_id`, `priority_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2a$12$4KQImPl8wJYFjhs4AC4ki.UGQeNS9.hIQsZgFxX/4.OY35.rLRZqK', 'qf23XyIqYGNYkq8BnjrdL2D7Bj9DgnRVTxWnoltKXVvMKjo8ghKLSA5gUzFQ', '12112', 'lioncoders', 1, NULL, NULL, 0, 1, 0, '2018-06-02 03:24:15', '2022-05-10 14:33:56'),
(3, 'dhiman da', 'dhiman@gmail.com', '$2y$10$Fef6vu5E67nm11hX7V5a2u1ThNCQ6n9DRCvRF9TD7stk.Pmt2R6O.', '5ehQM6JIfiQfROgTbB5let0Z93vjLHS7rd9QD5RPNgOxli3xdo7fykU7vtTt', '212', 'lioncoders', 1, NULL, NULL, 0, 0, 1, '2018-06-13 22:00:31', '2020-11-05 07:06:51'),
(6, 'test', 'test@gmail.com', '$2y$10$TDAeHcVqHyCmurki0wjLZeIl1SngKX3WLOhyTiCoZG3souQfqv.LS', 'KpW1gYYlOFacumklO2IcRfSsbC3KcWUZzOI37gqoqM388Xie6KdhaOHIFEYm', '1234', '212312', 4, NULL, NULL, 0, 0, 1, '2018-06-23 03:05:33', '2018-06-23 03:13:45'),
(8, 'test', 'test@yahoo.com', '$2y$10$hlMigidZV0j2/IPkgE/xsOSb8WM2IRlsMv.1hg1NM7kfyd6bGX3hC', NULL, '31231', NULL, 4, NULL, NULL, 0, 0, 1, '2018-06-24 22:35:49', '2018-07-02 01:07:39'),
(9, 'staff', 'anda@gmail.com', '$2y$10$kxDbnynB6mB1e1w3pmtbSOlSxy/WwbLPY5TJpMi0Opao5ezfuQjQm', 'EItpBtAb1E3SxIjMsY3gwOHPe9dERXFcp2BVmfJzpdxXiYdPHJfbBLNG2sjc', '3123', 'staff', 4, 5, 1, 0, 1, 0, '2018-07-02 01:08:08', '2022-04-06 22:01:27'),
(10, 'abul', 'abul@alpha.com', '$2y$10$5zgB2OOMyNBNVAd.QOQIju5a9fhNnTqPx5H6s4oFlXhNiF6kXEsPq', 'x7HlttI5bM0vSKViqATaowHFJkLS3PHwfvl7iJdFl5Z1SsyUgWCVbLSgAoi0', '1234', 'anda', 1, NULL, NULL, 0, 0, 0, '2018-09-07 23:44:48', '2018-09-07 23:44:48'),
(11, 'teststaff', 'a@a.com', '$2y$10$5KNBIIhZzvvZEQEhkHaZGu.Q8bbQNfqYvYgL5N55B8Pb4P5P/b/Li', 'DkHDEcCA0QLfsKPkUK0ckL0CPM6dPiJytNa0k952gyTbeAyMthW3vi7IRitp', '111', 'aa', 4, 5, 1, 0, 0, 1, '2018-10-22 02:47:56', '2018-10-23 02:10:56'),
(12, 'john', 'john@gmail.com', '$2y$10$P/pN2J/uyTYNzQy2kRqWwuSv7P2f6GE/ykBwtHdda7yci3XsfOKWe', 'O0f1WJBVjT5eKYl3Js5l1ixMMtoU6kqrH7hbHDx9I1UCcD9CmiSmCBzHbQZg', '10001', NULL, 4, 2, 2, 0, 0, 1, '2018-12-30 00:48:37', '2019-03-06 04:59:49'),
(13, 'jjj', 'test@test.com', '$2y$10$/Qx3gHWYWUhlF1aPfzXaCeZA7fRzfSEyCIOnk/dcC4ejO8PsoaalG', NULL, '1213', NULL, 1, NULL, NULL, 0, 0, 1, '2019-01-03 00:08:31', '2019-03-03 04:02:29'),
(19, 'shakalaka', 'shakalaka@gmail.com', '$2y$10$ketLWT0Ib/JXpo00eJlxoeSw.7leS8V1CUGInfbyOWT4F5.Xuo7S2', NULL, '1212', 'Digital image', 5, NULL, NULL, 0, 1, 0, '2020-11-09 00:07:16', '2020-11-09 00:07:16'),
(21, 'modon', 'modon@gmail.com', '$2y$10$7VpoeGMkP8QCvL5zLwFW..6MYJ5MRumDLDoX.TTQtClS561rpFHY.', NULL, '2222', 'modon company', 5, NULL, NULL, 0, 1, 0, '2020-11-13 07:12:08', '2020-11-13 07:12:08'),
(22, 'Dhiman', 'dhiman@gmail.com', '$2y$10$3mPygsC6wwnDtw/Sg85IpuExtUhgaHx52Lwp7Rz0.FNfuFdfKVpRq', NULL, '+8801111111101', 'lioncoders', 5, NULL, NULL, 0, 1, 0, '2020-11-15 06:14:58', '2022-04-06 22:02:33'),
(27, 'jubayer0009', 'jubayer0009@gmail.com', '$2y$10$75TwG1pQbMgeGR0n3lMDu./E4oIdUNZpD5iQa4tvjijBcgPfFZTVG', NULL, '01792156494', NULL, 4, 1, 1, 0, 1, 0, '2021-03-29 16:23:49', '2021-03-29 16:23:49'),
(28, 'shamim009', 'minhdf@gmail.com', '$2y$10$FqNva9zt3sjj5OvWEkQ0guJa4FNfPrOS96KUx7Y59.1isIB66GIEq', NULL, '01513725664', 'company', 1, NULL, NULL, 0, 0, 1, '2021-08-04 02:19:09', '2021-08-04 02:19:25'),
(29, 'Venus Rose', 'walulywym@mailinator.com', '$2y$10$oFASmzZrfLmSoBSgRNtK1u7RShHzKEZPEPbb9lX8nctvAp9EV80hW', NULL, '+1 (767) 177-2769', 'Woodard and Willis Associates', 5, NULL, NULL, 0, 1, 0, '2022-02-09 04:53:08', '2022-02-09 04:53:08'),
(30, 'Haviva Mason', 'doriqoreri@mailinator.com', '$2y$10$OikxvREuLJNvqLYjInBWG.NakdxCRECmAcenkrj7ApKZhPxG4oHpK', NULL, '+1 (969) 799-6249', 'Medina and Tate Co', 5, NULL, NULL, 0, 1, 0, '2022-02-09 05:26:33', '2022-02-09 05:26:33'),
(31, 'hvjvjv', 'patitoby@mailinator.com', '$2y$10$P/iWyNrPuo3fkhFvT7z/9.bKAyzPg5XglCAPrzobg0qrgObI/eu6S', NULL, '+1 (562) 605-7249', 'Estrada and Sandoval Inc', 5, NULL, NULL, 0, 0, 1, '2022-02-09 05:31:27', '2022-04-06 22:04:49'),
(32, 'Nadine Guthrie', 'noseref@mailinator.com', '$2y$10$kZxQRCscrjhyYBVq1nTuMOntbepPYiqFju8cApGsuT.FgdrR4rxVO', NULL, '+1 (962) 334-5325', 'Pruitt and Clayton Associates', 5, NULL, NULL, 0, 1, 0, '2022-02-09 06:31:46', '2022-02-09 06:31:46'),
(33, 'Kellie Wallace', 'kizi@mailinator.com', '$2y$10$AfPilxqA8hiEF6PR1qUi4uZT98nwVhmveDvP/PpxSnjepemq6kbR2', NULL, '+1 (599) 671-6757', 'Hewitt and Chan Plc', 5, NULL, NULL, 0, 1, 0, '2022-02-09 06:40:56', '2022-02-09 06:40:56'),
(34, 'Vera Shannon', 'qemocad@mailinator.com', '$2y$10$qNmn98gLNk9r/nM0ssN5xOmGaqogGpnHepfdwWhkpfV/J9Rz/BaUC', NULL, '+1 (466) 788-3071', 'Peterson and Hodges Co', 5, NULL, NULL, 0, 1, 0, '2022-02-09 06:55:55', '2022-02-09 06:55:55'),
(35, 'Emery Yang', 'zijovar@mailinator.com', '$2y$10$KPFCIIGpqCSSibm4vs4uvOruMXvI.xnirPKvpDvRher5QmYFeAH6e', NULL, '+1 (324) 782-9884', 'Edwards Benjamin Trading', 5, NULL, NULL, 0, 1, 0, '2022-02-09 22:58:45', '2022-02-09 22:58:45'),
(36, 'hjhjhh', 'bicabux@mailinator.com', '$2y$10$QdgG1MvMtihAOmTq5oHWMO0Cq.62klq8Z/K6Xz.LN93ibUskgh1wS', NULL, '+1 (285) 256-1061', 'Reynolds and Phillips Inc', 5, NULL, NULL, 0, 1, 0, '2022-02-09 23:00:06', '2022-02-09 23:00:06'),
(37, 'Macaulay Mack', 'miwova@mailinator.com', '$2y$10$KgURjVwDg8Gj7993.RaBQu7AvLDruDxQb5PwJl10rqy6gVPWWaihy', NULL, '+1 (896) 742-1171', 'Compton Shepard LLC', 5, NULL, NULL, 0, 1, 0, '2022-02-09 23:44:25', '2022-02-09 23:44:25'),
(38, 'Lawrence Hutchinson', 'hafeqyc@mailinator.com', '$2y$10$Rto5LpFbpix8AjlcRa6iPezsLuQn6YwB8.xIo7YG.uLC8ni7Nkt/u', NULL, '+1 (601) 627-8388', 'Alvarez Rollins Trading', 5, NULL, NULL, 0, 1, 0, '2022-02-09 23:45:24', '2022-02-09 23:45:24'),
(39, 'qwrwe', 'pusiwovuku@mailinator.com', '$2y$10$DHnuii8geXVKuGj0B6f9VOuaoOFImKdUCJn7lmKY40TSW0zgYo8i.', NULL, '+1 (302) 826-2932', 'Sloan and Bonner Traders', 5, NULL, NULL, 0, 1, 0, '2022-02-10 00:38:16', '2022-02-10 00:38:16'),
(40, 'Reece Whitehead', 'cymyxom@mailinator.com', '$2y$10$Q3BzqFXysf2eXxrU9gaCP.3DC3H/zyZuiLkT0zJOfLLiIvBkKlSyu', NULL, '+1 (261) 174-8823', 'Madden and Daniel Associates', 5, NULL, NULL, 0, 1, 0, '2022-02-10 00:40:10', '2022-02-10 00:40:10'),
(41, 'Cassady Porter', 'favyxywyv@mailinator.com', '$2y$10$gg7iJVDaZmBVyQITF9G48.v4YLN2ODHIJHFj/oRdi2QmEcbGfcHRi', NULL, '+1 (643) 435-1998', 'Harding and Paul LLC', 5, NULL, NULL, 0, 1, 0, '2022-02-10 00:43:05', '2022-02-10 00:43:05'),
(42, 'Doris Mcintosh', 'vezez@mailinator.com', '$2y$10$De9cGV52Qzx2i7GIEp2brOUiqQyJ04zerTumztQTloH4WqUsGq63i', NULL, '+1 (938) 738-2201', 'Rodgers and Daniels LLC', 5, NULL, NULL, 0, 1, 0, '2022-02-10 01:35:37', '2022-02-10 01:35:37'),
(43, 'Kato Owen', 'kafyxujop@mailinator.com', '$2y$10$4hN/nKJ9JIxLiY8Vs7rfkeHQvBbQjrGOc1vjdw/2rSEc4GXbnHd6S', NULL, '+1 (627) 969-2164', 'Lyons and Young Co', 5, NULL, NULL, 0, 1, 0, '2022-02-10 02:23:37', '2022-02-10 02:23:37'),
(44, 'qwte', 'jasuqoxy@mailinator.com', '$2y$10$JLctTZeH/nt.PeVwZqNVCeNPCVr8oX0tM2Rko9lSqFlYrJlLino9S', NULL, '+1 (897) 886-8982', 'Jensen Andrews Traders', 5, NULL, NULL, 0, 1, 0, '2022-02-10 02:34:42', '2022-02-10 02:34:42'),
(45, 'Wilma Sampson', 'qyco@mailinator.com', '$2y$10$i9u6GMLZr1iaPQ/y0J1l9e7jW7DkPLYr74PyxLGRir8ViCcziNf7.', NULL, '315', 'wtl', 4, 5, 2, 0, 1, 0, '2022-02-12 05:11:04', '2022-02-12 05:11:04'),
(46, 'Stewart David', 'pomarovy@mailinator.com', '$2y$10$qcYQyOnN46HiPzMHoA2JweKHxk98LIp6yfLGsd2sb9aK3htcENZke', NULL, '334', 'wtl', 5, 5, 1, 0, 1, 0, '2022-02-12 05:31:52', '2022-02-12 05:31:52'),
(47, 'Chava Moody', 'linygymaby@mailinator.com', '$2y$10$5SvCsRw5ypza6BPeTrUc0uNMmK/P8TCL1F6axYTWUCvbo8SV/DIje', NULL, '+1 (335) 688-8585', 'Hoover Welch Associates', 5, NULL, NULL, 0, 1, 0, '2022-02-22 06:00:02', '2022-02-22 06:00:02'),
(48, 'ggggg', 'qumizynuj@mailinator.com', '$2y$10$8r9ysSnidKcnvqpEGC83KekDDNrAIMxdMvJYu364XzFQxCiOksUay', NULL, '+1 (381) 647-8859', 'Chen Wise Trading', 5, NULL, NULL, 0, 1, 0, '2022-02-22 06:00:45', '2022-02-22 06:00:45'),
(49, 'Davis Miles', 'rakexur@mailinator.com', '$2y$10$A3y5rM3IYh8Bqq9R4s6YhuttAilz4SdyrisVNW5Cw5FwZGLtftz3y', NULL, '628', 'wtl', 5, 2, 2, 0, 1, 0, '2022-02-22 06:07:29', '2022-02-22 06:07:29'),
(50, 'rohim', 'jyripadani@mailinator.com', '$2y$10$XtcgI4Cp9BYThgRxowl1Z.IDLqMHNT3L5JCrZd4ZKhvLXZWKig/Wi', NULL, '+1 (411) 935-5118', 'dddd', 5, NULL, NULL, 0, 1, 0, '2022-02-24 04:31:22', '2022-02-24 04:31:22'),
(51, 'Neil Solis', 'sileguly@mailinator.com', '$2y$10$/ay0uXsiks6jF73TKcZFSOiOFwg.glwfPOz.nflX74LlRtqiLAakW', NULL, '+1 (435) 649-9301', 'Dillard Dawson Inc', 5, NULL, NULL, 0, 1, 0, '2022-02-24 05:19:12', '2022-02-24 05:19:12'),
(52, 'Melvin Mayer', 'tasyzusiqi@mailinator.com', '$2y$10$f0kbGXQfoRI636ysrpXny.YYrKB.hFmPqgl2twEnZt2cyOXwEWkji', NULL, '85', 'wts', 5, NULL, NULL, 0, 1, 0, '2022-02-25 15:30:35', '2022-02-25 15:30:35'),
(53, 'Berk Cash', 'pibegy@mailinator.com', '$2y$10$pik6MnVdo4der90XWqltQub5z3Ke4M2WR.7hqZst/Z/UdErdmARfO', NULL, '788', 'wts', 5, NULL, NULL, 0, 1, 0, '2022-02-26 13:36:50', '2022-02-26 13:36:50'),
(54, 'Savannah Hall', 'vahopyq@mailinator.com', '$2y$10$XW6ivYRZ9i5ISMIUnrTucucQzFdyOCS9JO41rLt2XuVzzXK5Oxp5m', NULL, '583', 'wtl', 5, NULL, NULL, 0, 1, 0, '2022-02-26 13:46:34', '2022-02-26 13:46:34'),
(55, 'MacKensie Baker', 'kudyc@mailinator.com', '$2y$10$O5.qZwpk/hMq6mkem9/zd.pckNOnIdYEHHOFIllWW3LF.qZc4BTce', NULL, '246', 'wts', 5, NULL, NULL, 0, 1, 0, '2022-02-26 14:07:31', '2022-02-26 14:07:31'),
(56, 'Xanthus Salas', 'waxaquwid@mailinator.com', '$2y$10$8v8N8JL.5Qx0Fg.LCx6Fvejn8.DLJNnpEtox1.W9/blGRQjvI9/n6', NULL, '684', 'wtl', 5, NULL, NULL, 0, 1, 0, '2022-02-26 14:31:17', '2022-02-26 14:31:17'),
(57, 'Eden Davidson', 'dazykapy@mailinator.com', '$2y$10$M/1eaDgl4IzVVwRGNsIlVOOpZid0gVMSoSWTq4ni2.CEMfbM2eTXa', NULL, '912', 'wtl', 5, NULL, NULL, 0, 1, 0, '2022-02-26 14:34:16', '2022-02-26 14:34:16'),
(58, 'Clinton Dejesus', 'kixunebi@mailinator.com', '$2y$10$kikOs7h36PPSftP/XWgCMu/HI/VSTuA2dvzhnsLEKEeLWR1KDhP9u', NULL, '+1 (812) 126-1578', 'Jarvis Bernard Trading', 5, NULL, NULL, 0, 0, 1, '2022-03-05 23:05:11', '2022-04-06 23:49:23'),
(59, 'Kimberley Calderon', 'ryhyq@mailinator.com', '$2y$10$MHcZoJFE8b5V/UBA75OiB.ly7Ib/OrW7cJO9oXAZopAh/bpeqHrFy', NULL, '801', 'wtl', 5, NULL, NULL, 0, 1, 1, '2022-03-07 00:38:38', '2022-04-06 23:23:54'),
(60, 'Julie Kerr', 'zubygacus@mailinator.com', '$2y$10$HtJUcsYnhz6bu9KreKkBGuz107qaTRAOhnui84kpIxuAdreVVwlH2', NULL, '+1 (445) 283-9913', 'Joseph and Lucas LLC', 5, NULL, NULL, 0, 1, 0, '2022-03-27 17:33:45', '2022-03-27 17:33:45'),
(61, 'Shana Oconnor', 'kicydef@mailinator.com', '$2y$10$cqnvon4yid.bwDVbHaYBr.KrFpQrOGbcb9mkzoCorcg2QgB1Z3qkm', NULL, '+1 (303) 345-8246', 'Atkinson and Deleon Traders', 4, NULL, 1, 0, 0, 1, '2022-04-06 22:20:50', '2022-04-06 22:23:42'),
(62, 'Wang Frye', 'lihocidev@mailinator.com', '$2y$10$gYL5sXsFFYijyFnIwSqNG.lcYIZPhsvm/bmAHIet4JRIR1u024VRO', NULL, '+1 (552) 623-6636', 'Wade Rodgers LLC', 4, NULL, 7, 0, 0, 0, '2022-04-06 22:24:15', '2022-04-06 22:24:15'),
(63, 'Cassidy Simon', 'hukocid@mailinator.com', '$2y$10$Fa38cr/BhSB7oag/21Eb3.pd3QAHOwaV8mXPsVfh.WsiO5I5oWHM.', NULL, '+1 (329) 818-2663', 'Hodge Odonnell Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:20:06', '2022-04-11 23:20:06'),
(64, 'Britanney Bruce', 'bojeqe@mailinator.com', '$2y$10$U5DJyjQowvBE.Vp7ZCsrIu1k47jB2rHuxZGk4.kT.KREJ7WDnEMVi', NULL, '+1 (422) 534-9701', 'Clark and Byrd LLC', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:28:08', '2022-04-11 23:28:08'),
(65, 'Bertha Espinoza', 'cucadidexy@mailinator.com', '$2y$10$oTG/5yA59vJwPOdT9xcwDONVgi6WvXA0qv86nuzBMfe75FQ0qtsxe', NULL, '+1 (717) 618-3644', 'Carter and Savage Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:29:47', '2022-04-11 23:29:47'),
(66, 'Raja Brooks', 'nuvadaf@mailinator.com', '$2y$10$gTb9ZSgu75RYPJDupdkpku4FgqpPGuDtny04qZ9Ffo1/Zva25SVt2', NULL, '+1 (382) 337-4223', 'Albert and Hamilton Co', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:32:09', '2022-04-11 23:32:09'),
(67, 'Dylan Miranda', 'nevanyci@mailinator.com', '$2y$10$uAwiEeAqb7LybrHoPjc0LeZfWmsZZfiWexlEFqPm9GBxDnf64ngka', NULL, '+1 (747) 681-4893', 'Mitchell Bell Plc', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:38:29', '2022-04-11 23:38:29'),
(68, 'Madaline Forbes', 'guwozir@mailinator.com', '$2y$10$Op1UjOE8ewbHaWB5Ax34z.uiYhKIeJwqAjxPrMNRfUmyDyx7jnRRa', NULL, '+1 (631) 126-4436', 'Le and Berry Traders', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:39:52', '2022-04-11 23:39:52'),
(69, 'Serena Dominguez', 'fozafaxem@mailinator.com', '$2y$10$6/FCqSjGo3OhzK6.rwKpyOKKV2Ef5AvF8VGfs7wvMF65juT4gV3Oa', NULL, '+1 (466) 845-8684', 'Cantrell Velasquez Plc', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:40:33', '2022-04-11 23:40:33'),
(70, 'Yvonne Garrison', 'rajico@mailinator.com', '$2y$10$kplfe1BTOax9fMhSTHHupOUOs7lHYVoloqozf6qxP8oS7R3By1Bua', NULL, '+1 (356) 847-2201', 'Drake Fitzpatrick LLC', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:45:09', '2022-04-11 23:45:09'),
(71, 'Lance Tillman', 'byholali@mailinator.com', '$2y$10$xxdTMJkTFLPIKUYzkRHxnO2htgN9mQUtV7Zx7IKDeulhBlnqjlIuW', NULL, '+1 (112) 529-8487', 'Clayton and Evans Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-11 23:53:49', '2022-04-11 23:53:49'),
(72, 'Cora Leblanc', 'vixyjococy@mailinator.com', '$2y$10$4vaewaHNjpp2B7KZsMYZouAg3.41auiQMcVyjpGIiGdakxKSLNniy', NULL, '+1 (134) 969-1011', 'Bryan and Odonnell Co', 5, NULL, NULL, 0, 1, 0, '2022-04-12 03:05:29', '2022-04-12 03:05:29'),
(73, 'Hyacinth Ferrell', 'zizifam@mailinator.com', '$2y$10$0EO.jsGQASHIkCuKCXuJOe3cwzMry44KMCZ2KZMe8SU8Ws4lCQ/Wq', NULL, '+1 (619) 524-2461', 'Christian and Wiggins Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-12 22:15:39', '2022-04-12 22:15:39'),
(74, 'Serina Gallegos', 'dybutezady@mailinator.com', '$2y$10$stbhRKf2PXY/3waSJzXgr.MHr3EIOw1CVBR2sWtp4JaZ7u7mdMwyy', NULL, '+1 (954) 979-5407', 'Duncan and Carey Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-12 23:53:13', '2022-04-12 23:53:13'),
(75, 'Jerome Vaughan', 'tugef@mailinator.com', '$2y$10$nzZAejRQWGjBXjnpbwDQjOIXJ1zVpc514nTPLhL4jkGizG3GO.Lt.', NULL, '+1 (669) 454-9194', 'Dean Burton Associates', 5, NULL, NULL, 0, 1, 0, '2022-04-16 03:57:29', '2022-04-16 03:57:29'),
(76, 'Uriah Burke', 'paxaqeb@mailinator.com', '$2y$10$/95Wm/DhrzSL.70hxxCaIuq6TcNB1IQbeADW9Ppgz1ZmfrhA4CLNy', NULL, '+1 (518) 129-4985', 'Lee Tyler Trading', 5, NULL, NULL, 0, 1, 0, '2022-04-18 00:08:53', '2022-04-18 00:08:53'),
(77, 'Felicia Spence', 'kokedin@mailinator.com', '$2y$10$fde/2psSUMBJtaXDXUdyxu5K3F8LdtsnQdWiWkJzV0uiYuczKjJbK', NULL, '+1 (384) 117-3921', 'Buck and Holder Inc', 5, NULL, NULL, 0, 1, 0, '2022-04-18 00:09:13', '2022-04-18 00:09:13'),
(78, 'Lunea Contreras', 'mocitiw@mailinator.com', '$2y$10$WmQ1H5.WYfigmOpCwZ9F8ubQcy.B4Q629aKr/kv8WZgfty0pCZ70y', NULL, '+1 (603) 614-6519', 'Howard Adams Associates', 5, NULL, 2, 0, 0, 0, '2022-04-18 00:34:12', '2022-04-18 00:34:12'),
(79, 'Zelenia Casey', 'vuzegyc@mailinator.com', '$2y$10$WZ9bCY5k.kzKiqZHwSXPuOlRowApjg57OkwQrYgvUwa/WZl7tZYZe', NULL, '+1 (105) 793-3958', 'Castillo Hopper Co', 5, NULL, NULL, 0, 0, 0, '2022-04-19 03:59:02', '2022-04-19 03:59:02'),
(80, 'Deirdre Turner', 'wesolapa@mailinator.com', '$2y$10$.6pa3x.Yp/2KI.Sf41PQqOEPpjORINCwrnoVU66eK8gBIcCQfybEa', NULL, '+1 (703) 936-4365', 'Fitzgerald Weaver Trading', 5, NULL, 1, 0, 1, 0, '2022-04-19 04:03:17', '2022-04-19 04:03:17'),
(81, 'Eden Buchanan', 'nidicalyl@mailinator.com', '$2y$10$ttOpmdpFYDkQ3vwWce.QDOg0PZWDFE/VBLMF9ig7QveL7cU.bn2cy', NULL, '+1 (151) 436-4259', 'Whitaker and Massey LLC', 5, NULL, NULL, 7, 1, 0, '2022-04-19 04:08:05', '2022-04-19 04:08:05'),
(82, 'Zena Cortez', 'kyhidu@mailinator.com', '$2y$10$IiiawawM1G/gdBQItGhUK.3ofufG8a9hIGsCRtpUobmrWR7dpEW/W', NULL, '+1 (139) 578-5606', 'Becker Luna Plc', 5, NULL, NULL, 14, 0, 0, '2022-04-26 01:59:27', '2022-04-26 01:59:27'),
(83, 'Jade Hickman', 'lytefypawa@mailinator.com', '$2y$10$g8qVlCFsxPUkIQJJ.BNqWeiZSjmmNW57QAQRn65RI3PUHXW47cvhq', NULL, '+1 (475) 386-9592', 'English Woodard Co', 5, NULL, NULL, 1, 1, 0, '2022-05-10 09:44:42', '2022-05-10 09:44:42'),
(84, 'Chantale Gillespie', 'pigonavaw@mailinator.com', '$2y$10$I5vvNk14GiRpT9P3G79BZ.zjsFon7ytx4jSoJORQKsqh6eTtlKFga', NULL, '+1 (986) 593-7343', 'Cameron and Baird Associates', 5, NULL, NULL, 1, 1, 0, '2022-05-10 09:45:45', '2022-05-10 09:45:45'),
(85, 'Leslie Sosa', 'cahepogiry@mailinator.com', '$2y$10$KZI0AGZylMmIMaq26lvxl.xcjD5AJQTc2TLr6S1WANNqnWTAeqIvi', NULL, '955', 'wtl', 5, NULL, NULL, NULL, 1, 0, '2022-05-10 13:33:24', '2022-05-10 13:33:24'),
(86, 'Logan Stanton', 'dhkewfhe@gmail.com', '$2y$10$x4GFmS/uQvOW7l/LiF7cj.3EucKP72DLqntSsMv49GzS0u05v946a', NULL, '269', 'wts', 5, NULL, NULL, NULL, 1, 0, '2022-05-10 13:36:22', '2022-05-10 13:36:22'),
(87, 'Lillian Moss', 'moulin@gmail.com', '$2y$10$fYpQ2Fs9nF3bQlHOLboo5OWkJgjR4P.mrlatxi67PW7XDEFvwjFDW', NULL, '01618599988', 'wtl', 5, NULL, NULL, NULL, 1, 0, '2022-05-10 13:47:26', '2022-05-10 13:47:26'),
(88, 'dsjfdskjf', 'rogim@gmail.com', '$2y$10$anWB0KebkYfN1d5ZsLJ7uunDNmC1zojf9J3efHAMejd4.O7Yb4MT2', NULL, '01758473845', 'Kodeeo', 1, NULL, NULL, NULL, 1, 0, '2022-05-10 13:49:21', '2022-05-10 13:49:21'),
(89, 'Rigel Mosley', 'rigel@gmail.com', '$2y$10$Uydh0P3QpVnJg2lsV1zvTelvhmXIuPhMTceyum6JhKiFij2asNACq', NULL, '+1 (567) 406-8892', 'Patterson Cruz Associates', 2, NULL, NULL, NULL, 1, 0, '2022-05-10 13:50:58', '2022-05-10 13:50:58'),
(90, 'Bree Stark', 'bree@gmail.com', '$2y$10$XilgtOD4ODKbAIK3WjIIU.DVx8DGJYXMZIFDFwocQThYL/dULu3Au', NULL, '+1 (489) 771-3762', 'Moore Miller Plc', 4, NULL, 1, 3, 0, 0, '2022-05-10 13:52:26', '2022-05-10 13:52:26'),
(91, 'Aline Schroeder', 'aline@gmail.com', '$2y$10$elCpcTQHohbTkWel6ZVIxeVUUvpKxilvwyQVIE55S3g6HS/SEBECe', NULL, '+1 (617) 488-3059', 'Kodeeo', 5, NULL, NULL, 3, 1, 0, '2022-05-10 13:53:56', '2022-05-10 13:53:56'),
(92, 'shepon', 'kishepon69@gmail.com', '$2y$10$ZpQ1vHVbcP5vClfLfy1EVOH8SFvrQDXNCZ6auVMm5Ye4bQ27O7jei', NULL, '01670263447', 'BD Tech Solution', 5, NULL, NULL, NULL, 1, 0, '2022-05-26 08:32:48', '2022-05-26 08:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` text NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `phone`, `email`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Warehouse 1', '01615430144', 'bdtechsolution121@gmail.com', 'Uttara', 1, '2022-05-17 16:09:23', '2022-05-17 16:09:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billers`
--
ALTER TABLE `billers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_priorities`
--
ALTER TABLE `customer_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_card_recharges`
--
ALTER TABLE `gift_card_recharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_transfers`
--
ALTER TABLE `money_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_cheque`
--
ALTER TABLE `payment_with_cheque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_credit_card`
--
ALTER TABLE `payment_with_credit_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_gift_card`
--
ALTER TABLE `payment_with_gift_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_with_paypal`
--
ALTER TABLE `payment_with_paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_setting`
--
ALTER TABLE `pos_setting`
  ADD UNIQUE KEY `pos_setting_id_unique` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchases`
--
ALTER TABLE `product_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_quotation`
--
ALTER TABLE `product_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_returns`
--
ALTER TABLE `product_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transfer`
--
ALTER TABLE `product_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_product_return`
--
ALTER TABLE `purchase_product_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_purchases`
--
ALTER TABLE `return_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_quotations`
--
ALTER TABLE `services_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_deliveries`
--
ALTER TABLE `service_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_payments`
--
ALTER TABLE `service_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_payment_with_cheques`
--
ALTER TABLE `service_payment_with_cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_quotations`
--
ALTER TABLE `service_quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_sales`
--
ALTER TABLE `service_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_sale_details`
--
ALTER TABLE `service_sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_counts`
--
ALTER TABLE `stock_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billers`
--
ALTER TABLE `billers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_priorities`
--
ALTER TABLE `customer_priorities`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gift_card_recharges`
--
ALTER TABLE `gift_card_recharges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `money_transfers`
--
ALTER TABLE `money_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_cheque`
--
ALTER TABLE `payment_with_cheque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_credit_card`
--
ALTER TABLE `payment_with_credit_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_gift_card`
--
ALTER TABLE `payment_with_gift_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_with_paypal`
--
ALTER TABLE `payment_with_paypal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_purchases`
--
ALTER TABLE `product_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_quotation`
--
ALTER TABLE `product_quotation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_returns`
--
ALTER TABLE `product_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_transfer`
--
ALTER TABLE `product_transfer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_product_return`
--
ALTER TABLE `purchase_product_return`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_purchases`
--
ALTER TABLE `return_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services_quotations`
--
ALTER TABLE `services_quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_deliveries`
--
ALTER TABLE `service_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_payments`
--
ALTER TABLE `service_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_payment_with_cheques`
--
ALTER TABLE `service_payment_with_cheques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_quotations`
--
ALTER TABLE `service_quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_sales`
--
ALTER TABLE `service_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_sale_details`
--
ALTER TABLE `service_sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_counts`
--
ALTER TABLE `stock_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
