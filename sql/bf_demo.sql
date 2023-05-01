-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 12:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bf.demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'faysal', 'f@gmail.com', '$2y$12$QhYgM2NbwX/zlXyQziSjtubmDZOKNB4oJaenKqGyBLtvMTDyQL2zO', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_default_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bco_delivery_men`
--

CREATE TABLE `bco_delivery_men` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `own_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivery/sample.jpg',
  `nid_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivery/sample.jpg',
  `parent_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivery/sample.jpg',
  `electric_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'delivery/sample.jpg',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bco_delivery_men`
--

INSERT INTO `bco_delivery_men` (`id`, `user_id`, `current_address`, `permanent_address`, `own_photo`, `nid_photo`, `parent_photo`, `electric_photo`, `status`, `active`, `created_at`, `updated_at`) VALUES
(5, 4, 'uttara dhgaka', 'adasdasd', 'bcourier/delivery/1604902895.jpeg', 'bcourier/delivery/1604902895.jpeg', 'bcourier/delivery/1604902895.jpeg', 'bcourier/delivery/1604902895.jpeg', 'active', 'active', '2020-11-09 00:21:35', '2020-11-09 00:22:00'),
(6, 6, 'gulsan', 'badda', 'delivery/sample.jpg', 'delivery/sample.jpg', 'delivery/sample.jpg', 'delivery/sample.jpg', 'active', 'active', NULL, '2020-11-11 05:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `bco_orders`
--

CREATE TABLE `bco_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_serial` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `sender_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick_point` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick_area` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_point` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_area` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_secret_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge` double DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `seen_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `order_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bcoOrder/sample.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bco_orders`
--

INSERT INTO `bco_orders` (`id`, `user_id`, `order_serial`, `product_type`, `product_name`, `receiver_name`, `receiver_phone`, `weight`, `sender_phone`, `pick_point`, `pick_area`, `delivery_point`, `delivery_area`, `delivery_secret_code`, `delivery_charge`, `description`, `status`, `seen_status`, `order_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'bVon1201108', 'drinks', 'SevenUp', 'Kajol', '0120424', 20, '012452', 'chourasta', 'chourasta,gazipur', 'dhanmondi', 'dhanmondi,dhaka', '134ac83', 500, NULL, 'cancel', '1', 'bcourier/order/1604822385.jpeg', '2020-11-08 01:59:45', '2020-11-11 05:19:15'),
(2, 4, 'bVon2201108', 'Food', 'Burger', 'Moga', '01899547788', 5, '01833548800', 'Uttara sector 5,road 6/a,house 48. dhaka', 'uttara', 'mirpur dohs , road 32,house 915. Dhaka 1230', 'mirpur', '21c2f63', 140, NULL, 'cancel', '1', 'bcourier/order/1604823416.jpeg', '2020-11-08 02:16:56', '2020-11-11 05:19:51'),
(3, 4, 'bVon3201109', 'Material', 'my order', 'foysal', '0123562356', 4, '01565656565', 'gulshan ,nikaton, road 1230, Dhaka', 'gulshan', 'narayangang, fotulla, Dhaka', 'narayangang', '37b5aa5', 120, NULL, 'picked', '1', 'bcourier/order/1604899030.jpeg', '2020-11-08 23:17:10', '2020-11-10 23:57:12'),
(4, 4, 'bVon4201109', 'Heavy Weight', 'qweqw', 'asdasdasd', '434234324324', 3, '13243431431', 'adfadfasdas', 'bbbbbbbbb', 'asdasdasdas', 'aaaaaaaaa', '421c07f', 100, NULL, 'cancel', '1', 'bcourier/order/1604900345.jpeg', '2020-11-08 23:39:05', '2020-11-11 05:21:12'),
(5, 4, 'bVon5201109', 'Low Weight', 'qqqqq', 'rrrrrrrrrr', '243423432432', 8, '42343432423432', 'qqqqqqq', 'qqqqqqq', 'fsdfsdfsdfsdfsd', 'tttttttttt', '59247f8', 190, NULL, 'cancel', '1', 'bcourier/order/1604900526.jpeg', '2020-11-08 23:42:06', '2020-11-11 05:15:57'),
(6, 4, 'bVon6201111', 'Liquid', 'aaaa', 'ssssss', '22222222222', 2, '11111111111111', 'aaaa', 'aaaa', 'ssssssss', 'ssssssss', '668764f', 80, NULL, 'picked', '1', 'bcourier/order/1605071210.jpeg', '2020-11-10 23:06:50', '2020-11-10 23:22:37'),
(7, 4, 'bVon7201111', 'Low Weight', 'wwww', 'wwwww', '3333333333333', 3, '22222222222222', 'wwww', 'wwww', 'wwwwwwww', 'wwwwwwwwww', '739214c', 100, NULL, 'picked', '1', 'bcourier/order/1605073298.jpeg', '2020-11-10 23:41:38', '2020-11-10 23:57:38'),
(8, 4, 'bVon8201111', 'Low Weight', 'wwww', 'wwwww', '3333333333333', 3, '22222222222222', 'wwww', 'wwww', 'wwwwwwww', 'wwwwwwwwww', '839214c', 100, NULL, 'picked', '1', 'bcourier/order/1605073298.jpeg', '2020-11-10 23:41:38', '2020-11-10 23:57:43'),
(9, 4, 'bVon9201111', 'Food', 'dasdasd', 'fdsfdsf', '32423423', 8, '324234234', 'sdfsdf', 'sdfdsf', 'dfsdsfsdf', 'sdfsdf', '9c87432', 190, NULL, 'cancel', '1', 'bcourier/order/1605073420.jpeg', '2020-11-10 23:43:40', '2020-11-11 05:21:41'),
(10, 4, 'bVon10201111', 'Heavy Weight', 'asdasdasasd', 'sdfsdfsd43', '534534435435', 6, '342432432', 'sdfsdfsdf', 'fsdf', 'xcfdvfdvfd', 'gfdvdfgvdfv', '10f47a8f', 160, NULL, 'cancel', '1', 'bcourier/order/1605074331.jpeg', '2020-11-10 23:58:51', '2020-11-11 03:38:01'),
(11, 4, 'bVon11201111', 'Heavy Weight', 'dfsdfsdfsd', 'gdfgfdgdfdf', '43543534534', 9, '34534534534', 'fsdfsdfsdf', 'fgdfgdf', 'gfbffdg', 'dfgdfgdfgdf', '11bf4425', 200, NULL, 'confirm', '1', 'bcourier/order/1605074386.jpeg', '2020-11-10 23:59:46', '2020-11-11 00:19:10'),
(12, 4, 'bVon12201111', 'Material', 'acsdasdasd', 'fdgdfgdfgdfg', '43534534534', 6, '34534534', 'gvdfgvfdgdf', 'gdfgdfg', 'dfgdfgdfgdfd', 'gdfgdfg', '124f5473', 160, NULL, 'confirm', '1', 'bcourier/order/1605075193.jpeg', '2020-11-11 00:13:13', '2020-11-11 00:17:16'),
(13, 4, 'bVon13201111', 'Liquid', 'jfjhfjh', 'jgvjhvmh', '6545313213213', 5, '132151354354', 'kjghjghjkjbjk', 'Uttara', 'hgfchgvjnhvmhn', 'ghfcngvnbvmhn', '135e2917', 140, NULL, 'cancel', '1', 'bcourier/order/1605078486.jpeg', '2020-11-11 01:08:06', '2020-11-11 03:41:47'),
(14, 4, 'bVon14201111', 'Liquid', 'asdasdasd', 'fsdfsdf43', '34543543', 4, '345435435345', 'dfdsvsdfdss', 'fsdfsd', 'fdsgfdgdfgfd', 'fgdfg', '1484bacf', 120, NULL, 'cancel', '1', 'bcourier/order/1605078725.jpeg', '2020-11-11 01:12:05', '2020-11-11 03:40:21'),
(15, 4, 'bVon15201111', 'Heavy Weight', 'asdasda', 'asdasdasdas5345', '34534534543', 7, '23432423432sd', 'fsdfsdfsd', 'Uttara', 'sdfsdfsf', 'sdfdfsdfsdfs', '159563bf', 180, NULL, 'cancel', '1', 'bcourier/order/1605078912.jpeg', '2020-11-11 01:15:12', '2020-11-11 03:43:06'),
(16, 4, 'bVon16201111', 'Heavy Weight', 'afdsdfsdfd', 'gdfgdfgdfgd', '436546546', 3, '456546546', 'fgvbhf', 'Uttara', 'vchgfhfh', 'fghfgh', '160fccd3', 100, NULL, 'cancel', '1', 'bcourier/order/1605079680.jpeg', '2020-11-11 01:28:00', '2020-11-11 03:49:30'),
(17, 4, 'bVon17201111', 'Heavy Weight', 'adfsdafsd', 'dfgfdgdfgdf', '45654654654', 9, '34653646', 'gfhgfhfgh', 'Uttara', 'fghgfhgfhgf', 'hdgfh', '178defe9', 200, NULL, 'cancel', '1', 'bcourier/order/1605079802.jpeg', '2020-11-11 01:30:02', '2020-11-11 03:51:25'),
(18, 4, 'bVon18201111', 'Material', 'sdgfdgdfg', 'dfgdfgdf', '436546546', 5, 'dfgdfgdfgdf', 'ddfgdfgdfgdf', 'Uttara', 'fdgdfgdfd', 'fgdfgdf', '185da918', 140, NULL, 'cancel', '1', 'bcourier/order/1605079881.jpeg', '2020-11-11 01:31:21', '2020-11-11 04:28:39'),
(19, 4, 'bVon19201111', 'Material', 'sdgfdgdfg', 'dfgdfgdf', '436546546', 5, 'dfgdfgdfgdf', 'ddfgdfgdfgdf', 'Uttara', 'fdgdfgdfd', 'fgdfgdf', '1989bc12', 140, NULL, 'cancel', '1', 'bcourier/order/1605079892.jpeg', '2020-11-11 01:31:32', '2020-11-11 04:34:22'),
(20, 4, 'bVon20201111', 'Material', 'sdgfdgdfg', 'dfgdfgdf', '436546546', 5, 'dfgdfgdfgdf', 'ddfgdfgdfgdf', 'Uttara', 'fdgdfgdfd', 'fgdfgdf', '20a4b758', 140, NULL, 'cancel', '1', 'bcourier/order/1605079902.jpeg', '2020-11-11 01:31:42', '2020-11-11 04:35:11'),
(21, 4, 'bVon21201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '210c57e7', 100, NULL, 'cancel', '1', 'bcourier/order/1605080023.jpeg', '2020-11-11 01:33:43', '2020-11-11 04:54:31'),
(22, 4, 'bVon22201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '22efe349', 100, NULL, 'cancel', '1', 'bcourier/order/1605080062.jpeg', '2020-11-11 01:34:22', '2020-11-11 04:53:31'),
(23, 4, 'bVon23201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '2312e343', 100, NULL, 'cancel', '1', 'bcourier/order/1605080141.jpeg', '2020-11-11 01:35:41', '2020-11-11 05:19:17'),
(24, 4, 'bVon24201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '24d842d2', 100, NULL, 'cancel', '1', 'bcourier/order/1605080154.jpeg', '2020-11-11 01:35:54', '2020-11-11 05:33:43'),
(25, 4, 'bVon25201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '250cfbfb', 100, NULL, 'cancel', '1', 'bcourier/order/1605080190.jpeg', '2020-11-11 01:36:30', '2020-11-11 05:40:25'),
(26, 4, 'bVon26201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '261294a1', 100, NULL, 'pending', '1', 'bcourier/order/1605080203.jpeg', '2020-11-11 01:36:43', '2020-11-11 01:36:43'),
(27, 4, 'bVon27201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '27ff9456', 100, NULL, 'pending', '1', 'bcourier/order/1605080227.jpeg', '2020-11-11 01:37:07', '2020-11-11 01:37:07'),
(28, 4, 'bVon28201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '282a5dc7', 100, NULL, 'pending', '1', 'bcourier/order/1605080252.jpeg', '2020-11-11 01:37:32', '2020-11-11 01:37:32'),
(29, 4, 'bVon29201111', 'Material', 'fasdasdasd', 'sdfsdfsdf', '345345', 3, '345345345', 'sdfsdfsd', 'sdfUttara', 'dsgfdsgdf', 'sdgfsdfsd', '29d6fd1a', 100, NULL, 'pending', '1', 'bcourier/order/1605080316.jpeg', '2020-11-11 01:38:36', '2020-11-11 01:38:36'),
(30, 4, 'bVon30201111', 'Heavy Weight', 'fsdf', 'dfgdfgdf', '54645645', 3, '345345345', 'regfdgdfgdf', 'Uttara', 'fghfghfgf', 'hfghfg', '30256575', 100, NULL, 'pending', '1', 'bcourier/order/1605080374.jpeg', '2020-11-11 01:39:34', '2020-11-11 01:39:34'),
(31, 4, 'bVon31201111', 'Material', 'dfgdfgfd', 'dfgdfgdfg', '45654654', 7, 'dfgdfgdfg', 'gdfgdf', 'Uttara', 'fghfhfgh', 'fghfghfghfg', '31553cb5', 180, NULL, 'pending', '1', 'bcourier/order/1605080425.jpeg', '2020-11-11 01:40:25', '2020-11-11 01:40:25'),
(32, 4, 'bVon32201111', 'Heavy Weight', 'dsfsdfsdf', 'fgsdsdfsdf34534', '534534534534', 9, 'sdf34534543', 'dfgdfgdfg', 'Uttara', 'dfgdfgdfg', 'dfgdgdfgdf', '32e00a4b', 200, NULL, 'pending', '1', 'bcourier/order/1605080531.jpeg', '2020-11-11 01:42:11', '2020-11-11 01:42:12'),
(33, 4, 'bVon33201111', 'Material', 'sdasdas', 'fdsfsdf', '534534', 4, '345345', 'dfgsdfs', 'Uttara', 'dfgfdg', 'sdfsdf', '334103dc', 120, NULL, 'pending', '1', 'bcourier/order/1605080605.jpeg', '2020-11-11 01:43:25', '2020-11-11 01:43:25'),
(34, 4, 'bVon34201111', 'Material', 'sdasdas', 'fdsfsdf', '534534', 4, '345345', 'dfgsdfs', 'Uttara', 'dfgfdg', 'sdfsdf', '341714bc', 120, NULL, 'pending', '1', 'bcourier/order/1605080617.jpeg', '2020-11-11 01:43:37', '2020-11-11 01:43:37'),
(35, 4, 'bVon35201111', 'Material', 'sdasdas', 'fdsfsdf', '534534', 4, '345345', 'dfgsdfs', 'Uttara', 'dfgfdg', 'sdfsdf', '3517129c', 120, NULL, 'waiting', '1', 'bcourier/order/1605080656.jpeg', '2020-11-11 01:44:16', '2020-11-11 05:22:03'),
(36, 4, 'bVon36201111', 'Cloth', 'dfsdf', 'sdfsds34', '34534', 4, 'dfsd', 'sdf', 'Uttara', 'dfgdfg', 'dfg', '3681e51f', 120, NULL, 'pending', '1', 'bcourier/order/1605080692.jpeg', '2020-11-11 01:44:52', '2020-11-11 01:44:52'),
(37, 4, 'bVon37201111', 'Heavy Weight', 'fsdfsdf', 'gdfgfdg3', '534543534534', 6, '3453534', 'fdgdfgdf', 'Uttara', 'dgdfgdfgdf', 'fgdfgdfgdf', '37268ee8', 160, NULL, 'pending', '1', 'bcourier/order/1605080778.jpeg', '2020-11-11 01:46:18', '2020-11-11 01:46:18'),
(38, 4, 'bVon38201111', 'Cloth', 'dasa', 'fsdfsdfsdf', '32423423', 5, 'dasdasdddddd', 'sdasdasdasdasdas', 'Uttara', 'sdfsdfsd', 'dfsdf', '38e9d442', 140, NULL, 'pending', '1', 'bcourier/order/1605080835.jpeg', '2020-11-11 01:47:15', '2020-11-11 01:47:15'),
(39, 4, 'bVon39201111', 'Liquid', 'asdasd', 'sdfsdf', 'wer32423423', 4, 'asdasdasd', 'werwefcsdc', 'Uttara', 'csfsdfs', 'fsdfsdfsdf', '396f5910', 120, NULL, 'pending', '1', 'bcourier/order/1605080902.jpeg', '2020-11-11 01:48:22', '2020-11-11 01:48:22'),
(40, 4, 'bVon40201111', 'Liquid', 'asdasd', 'sdfsdf', 'wer32423423', 4, 'asdasdasd', 'werwefcsdc', 'Uttara', 'csfsdfs', 'fsdfsdfsdf', '40abf54b', 120, NULL, 'pending', '1', 'bcourier/order/1605080929.jpeg', '2020-11-11 01:48:49', '2020-11-11 01:48:49'),
(41, 4, 'bVon41201111', 'Material', 'asdasdasd', 'sdfsdf3', '2423423', 7, '234234234', 'sdfsdfsdf', 'Uttara', 'sfsdfsdfs', 'fsdfsdfsdfsd', '41b8c10a', 180, NULL, 'pending', '1', 'bcourier/order/1605080982.jpeg', '2020-11-11 01:49:42', '2020-11-11 01:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `bco_pick_orders`
--

CREATE TABLE `bco_pick_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deliveryboy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `charge` double DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bco_pick_orders`
--

INSERT INTO `bco_pick_orders` (`id`, `user_id`, `deliveryboy_id`, `order_id`, `charge`, `delivery_status`, `created_at`, `updated_at`) VALUES
(11, 1, 5, 1, 500, 'cancel', '2020-11-10 23:16:58', '2020-11-11 05:19:15'),
(12, 4, 5, 2, 140, 'cancel', '2020-11-10 23:18:51', '2020-11-11 05:19:51'),
(13, 4, 5, 6, 80, 'picked', '2020-11-10 23:22:00', '2020-11-10 23:22:37'),
(14, 4, 5, 5, 190, 'picked', '2020-11-10 23:23:53', '2020-11-10 23:24:22'),
(15, 4, 5, 3, 120, 'picked', '2020-11-10 23:25:27', '2020-11-10 23:57:12'),
(16, 4, 5, 4, 100, 'cancel', '2020-11-10 23:27:26', '2020-11-11 05:21:12'),
(17, 4, 5, 7, 100, 'picked', '2020-11-10 23:44:25', '2020-11-10 23:57:38'),
(18, 4, 5, 8, 100, 'picked', '2020-11-10 23:48:02', '2020-11-10 23:57:43'),
(19, 4, 5, 9, 190, 'cancel', '2020-11-10 23:52:21', '2020-11-11 05:21:41'),
(20, 4, 5, 11, 200, 'confirm', '2020-11-11 00:01:38', '2020-11-11 00:19:10'),
(21, 4, 5, 10, 160, 'waiting', '2020-11-11 00:07:20', '2020-11-11 00:07:20'),
(22, 4, 5, 12, 160, 'confirm', '2020-11-11 00:13:30', '2020-11-11 00:17:16'),
(23, 4, 5, 35, 120, 'waiting', '2020-11-11 05:22:03', '2020-11-11 05:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `cash_back_transactions`
--

CREATE TABLE `cash_back_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_addresses`
--

CREATE TABLE `eco_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_brands`
--

CREATE TABLE `eco_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'brand/sampleimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_categories`
--

CREATE TABLE `eco_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category/sampleimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_media`
--

CREATE TABLE `eco_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_orders`
--

CREATE TABLE `eco_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_amount` int(11) NOT NULL,
  `order_serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 1,
  `payment_status` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `seen_status` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_order_details`
--

CREATE TABLE `eco_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seller_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_payments`
--

CREATE TABLE `eco_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_products`
--

CREATE TABLE `eco_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_promote` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `product_permision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `product_discount` int(11) NOT NULL DEFAULT 0,
  `product_visibility` int(11) NOT NULL DEFAULT 0,
  `product_quantity` int(11) NOT NULL,
  `premium_price` double(8,2) NOT NULL,
  `user_price` double(8,2) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thum_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product/sample.jpg',
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_shops`
--

CREATE TABLE `eco_shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'shop/sampleimage.jpg',
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_sizes`
--

CREATE TABLE `eco_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `all_size` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategories_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_sliders`
--

CREATE TABLE `eco_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sliders_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sliders_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sliders_status` tinyint(4) NOT NULL DEFAULT 1,
  `sliders_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'slider/sampleimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_slider_details`
--

CREATE TABLE `eco_slider_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_sub_categories`
--

CREATE TABLE `eco_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategories_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subcategory/sampleimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_vendors`
--

CREATE TABLE `eco_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending/accepted/denied/blocked/',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendship_groups`
--

CREATE TABLE `friendship_groups` (
  `friendship_id` int(10) UNSIGNED NOT NULL,
  `friend_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hot_products`
--

CREATE TABLE `hot_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'follow' COMMENT 'follow/like/subscribe/favorite/upvote/downvote',
  `relation_value` int(11) DEFAULT NULL,
  `relation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_14_000000_create_acquaintances_friendship_table', 1),
(4, '2018_06_14_000000_create_acquaintances_friendships_groups_table', 1),
(5, '2018_06_14_000000_create_acquaintances_interactions_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2020_06_17_071606_create_posts_table', 1),
(8, '2020_06_17_074402_create_comments_table', 1),
(9, '2020_06_24_162652_create_products_table', 1),
(10, '2020_07_01_111615_add_columns_to_users_table_one', 1),
(11, '2020_07_02_135633_create_admins_table', 1),
(12, '2020_07_03_101056_create_user_verification_details_table', 1),
(13, '2020_07_03_102923_create_user_verifications_table', 1),
(14, '2020_07_12_071412_create_admin_settings_table', 1),
(15, '2020_07_13_081236_create_transactions_table', 1),
(16, '2020_08_09_054728_create_withdrawals_table', 1),
(17, '2020_08_09_054812_create_payment_methods_table', 1),
(18, '2020_08_09_060017_create_eco_vendors_table', 1),
(19, '2020_08_10_073847_create_eco_categories_table', 1),
(20, '2020_08_10_081740_create_eco_sub_categories_table', 1),
(21, '2020_08_10_081741_create_eco_shops_table', 1),
(22, '2020_08_10_102821_create_eco_products_table', 1),
(23, '2020_08_10_112325_add_email_column_to_user_verification_details', 1),
(24, '2020_08_13_052752_remove_balance_column_from_users_table', 1),
(25, '2020_08_16_092051_create_eco_addresses_table', 1),
(26, '2020_08_19_053015_create_eco_sliders_table', 1),
(27, '2020_08_20_041638_create_eco_orders_table', 1),
(28, '2020_08_20_042441_create_eco_order_details_table', 1),
(29, '2020_09_01_064355_create_product_images_table', 1),
(30, '2020_09_03_114901_create_eco_payments_table', 1),
(31, '2020_09_05_070807_add_column_verifided_date_in_varification_table', 1),
(32, '2020_09_07_060109_create_cash_back_transactions_table', 1),
(33, '2020_09_07_082626_create_eco_sizes_table', 1),
(34, '2020_09_07_083402_create_eco_media_table', 1),
(35, '2020_09_12_060646_eco_order_details_table', 1),
(36, '2020_09_14_073757_eco_products_one', 1),
(37, '2020_09_21_045532_create_eco_slider_details_table', 1),
(38, '2020_09_27_064953_create_hot_products_table', 1),
(39, '2020_09_30_062119_add_brands_to_products_table', 1),
(40, '2020_09_30_072643_create_eco_brands_table', 1),
(41, '2020_10_04_065747_add_priority_to_eco_shops_table', 1),
(43, '2020_10_15_043653_create_bco_delivery_men_table', 1),
(46, '2020_10_10_110515_create_bco_orders_table', 2),
(47, '2020_10_17_104020_create_bco_pick_orders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`media`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product/sampleimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_pic` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hometown` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lives_in` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `referred_by` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GU',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `uuid`, `fuuid`, `verified`, `name`, `gender`, `profile_pic`, `cover_pic`, `hometown`, `lives_in`, `religion`, `birthday`, `occupation`, `nick_name`, `device_id`, `balance`, `referred_by`, `referral_id`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123', '45', 'hkyhk', 1, 'tohin', 'male', 'user/download.png', 'kmygk', 'cumilla', 'dhaka', 'islam', '1994-10-24', 'student', 'f', '', 0, NULL, NULL, 'GU', 't@gmail.com', NULL, '$2y$12$QhYgM2NbwX/zlXyQziSjtubmDZOKNB4oJaenKqGyBLtvMTDyQL2zO', NULL, NULL, NULL),
(4, '123456', '212', 'ugkjyugk', 1, 'tohin', 'male', 'user/download.png', 'ujljlj', 'cumilla', 'dhaka', 'islam', '1994-10-24', 'student', 'uiol', '', 0, NULL, NULL, 'uiol', 'i0ki@gmail.com', NULL, '$2y$12$QhYgM2NbwX/zlXyQziSjtubmDZOKNB4oJaenKqGyBLtvMTDyQL2zO', NULL, NULL, NULL),
(5, '6767', '788', 'u7u7', 1, 'yosuf', 'male', 'user/download.png', 'fnh', 'Homna', 'Sanarpar', 'islam', '1994-10-24', 'student', 'himul', '888696', 87867, 'j6y78', '76i6i', 'hjky', 'lop@gmail.com', NULL, '$2y$12$QhYgM2NbwX/zlXyQziSjtubmDZOKNB4oJaenKqGyBLtvMTDyQL2zO', NULL, NULL, NULL),
(6, '33333', '91245', 'jk4jj', 1, 'Rahim', 'male', 'user/download.png', 'fnh', 'Khulna', 'Narayganj', 'islam', '1994-10-24', 'student', 'Rahi', '4442222', 200, '0414', '76i6i', 'hjky', 'rahim@gmail.com', NULL, '$2y$12$QhYgM2NbwX/zlXyQziSjtubmDZOKNB4oJaenKqGyBLtvMTDyQL2zO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `verified_date` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rejected` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_verification_details`
--

CREATE TABLE `user_verification_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_num` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_method_id` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_settings_setting_name_unique` (`setting_name`);

--
-- Indexes for table `bco_delivery_men`
--
ALTER TABLE `bco_delivery_men`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bco_delivery_men_user_id_foreign` (`user_id`);

--
-- Indexes for table `bco_orders`
--
ALTER TABLE `bco_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bco_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `bco_pick_orders`
--
ALTER TABLE `bco_pick_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bco_pick_orders_user_id_foreign` (`user_id`),
  ADD KEY `bco_pick_orders_deliveryboy_id_foreign` (`deliveryboy_id`),
  ADD KEY `bco_pick_orders_order_id_foreign` (`order_id`);

--
-- Indexes for table `cash_back_transactions`
--
ALTER TABLE `cash_back_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eco_addresses`
--
ALTER TABLE `eco_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `eco_brands`
--
ALTER TABLE `eco_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eco_categories`
--
ALTER TABLE `eco_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eco_media`
--
ALTER TABLE `eco_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_media_product_id_foreign` (`product_id`);

--
-- Indexes for table `eco_orders`
--
ALTER TABLE `eco_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_orders_user_id_foreign` (`user_id`),
  ADD KEY `eco_orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `eco_order_details`
--
ALTER TABLE `eco_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_order_details_product_id_foreign` (`product_id`),
  ADD KEY `eco_order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `eco_payments`
--
ALTER TABLE `eco_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `eco_products`
--
ALTER TABLE `eco_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `eco_products_shop_id_foreign` (`shop_id`),
  ADD KEY `eco_products_category_id_foreign` (`category_id`),
  ADD KEY `eco_products_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `eco_shops`
--
ALTER TABLE `eco_shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_shops_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `eco_sizes`
--
ALTER TABLE `eco_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_sizes_subcategories_id_foreign` (`subcategories_id`);

--
-- Indexes for table `eco_sliders`
--
ALTER TABLE `eco_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eco_slider_details`
--
ALTER TABLE `eco_slider_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eco_slider_details_slider_id_foreign` (`slider_id`);

--
-- Indexes for table `eco_sub_categories`
--
ALTER TABLE `eco_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eco_sub_categories_sub_category_name_unique` (`sub_category_name`),
  ADD KEY `eco_sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `eco_vendors`
--
ALTER TABLE `eco_vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eco_vendors_email_unique` (`email`) USING HASH;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friendships_sender_type_sender_id_index` (`sender_type`,`sender_id`),
  ADD KEY `friendships_recipient_type_recipient_id_index` (`recipient_type`,`recipient_id`);

--
-- Indexes for table `friendship_groups`
--
ALTER TABLE `friendship_groups`
  ADD UNIQUE KEY `unique` (`friendship_id`,`friend_id`,`friend_type`,`group_id`),
  ADD KEY `friendship_groups_friend_type_friend_id_index` (`friend_type`,`friend_id`);

--
-- Indexes for table `hot_products`
--
ALTER TABLE `hot_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hot_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD KEY `interactions_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  ADD KEY `interactions_user_id_index` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_phone_index` (`phone`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_fuuid_unique` (`fuuid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_referral_id_index` (`referral_id`(768));

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verification_details`
--
ALTER TABLE `user_verification_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bco_delivery_men`
--
ALTER TABLE `bco_delivery_men`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bco_orders`
--
ALTER TABLE `bco_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `bco_pick_orders`
--
ALTER TABLE `bco_pick_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cash_back_transactions`
--
ALTER TABLE `cash_back_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_addresses`
--
ALTER TABLE `eco_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_brands`
--
ALTER TABLE `eco_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_categories`
--
ALTER TABLE `eco_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_media`
--
ALTER TABLE `eco_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_orders`
--
ALTER TABLE `eco_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_order_details`
--
ALTER TABLE `eco_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_payments`
--
ALTER TABLE `eco_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_products`
--
ALTER TABLE `eco_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_shops`
--
ALTER TABLE `eco_shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_sizes`
--
ALTER TABLE `eco_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_sliders`
--
ALTER TABLE `eco_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_slider_details`
--
ALTER TABLE `eco_slider_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_sub_categories`
--
ALTER TABLE `eco_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eco_vendors`
--
ALTER TABLE `eco_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hot_products`
--
ALTER TABLE `hot_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_verification_details`
--
ALTER TABLE `user_verification_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bco_delivery_men`
--
ALTER TABLE `bco_delivery_men`
  ADD CONSTRAINT `bco_delivery_men_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bco_orders`
--
ALTER TABLE `bco_orders`
  ADD CONSTRAINT `bco_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bco_pick_orders`
--
ALTER TABLE `bco_pick_orders`
  ADD CONSTRAINT `bco_pick_orders_deliveryboy_id_foreign` FOREIGN KEY (`deliveryboy_id`) REFERENCES `bco_delivery_men` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bco_pick_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `bco_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bco_pick_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_addresses`
--
ALTER TABLE `eco_addresses`
  ADD CONSTRAINT `eco_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_media`
--
ALTER TABLE `eco_media`
  ADD CONSTRAINT `eco_media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `eco_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_orders`
--
ALTER TABLE `eco_orders`
  ADD CONSTRAINT `eco_orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `eco_addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eco_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_order_details`
--
ALTER TABLE `eco_order_details`
  ADD CONSTRAINT `eco_order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `eco_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eco_order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `eco_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_payments`
--
ALTER TABLE `eco_payments`
  ADD CONSTRAINT `eco_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `eco_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_products`
--
ALTER TABLE `eco_products`
  ADD CONSTRAINT `eco_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `eco_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eco_products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `eco_shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eco_products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `eco_sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eco_products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `eco_vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_shops`
--
ALTER TABLE `eco_shops`
  ADD CONSTRAINT `eco_shops_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `eco_vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_sizes`
--
ALTER TABLE `eco_sizes`
  ADD CONSTRAINT `eco_sizes_subcategories_id_foreign` FOREIGN KEY (`subcategories_id`) REFERENCES `eco_sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_slider_details`
--
ALTER TABLE `eco_slider_details`
  ADD CONSTRAINT `eco_slider_details_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `eco_sliders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eco_sub_categories`
--
ALTER TABLE `eco_sub_categories`
  ADD CONSTRAINT `eco_sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `eco_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friendship_groups`
--
ALTER TABLE `friendship_groups`
  ADD CONSTRAINT `friendship_groups_friendship_id_foreign` FOREIGN KEY (`friendship_id`) REFERENCES `friendships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hot_products`
--
ALTER TABLE `hot_products`
  ADD CONSTRAINT `hot_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `eco_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `eco_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
