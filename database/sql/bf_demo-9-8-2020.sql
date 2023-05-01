-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 07:08 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

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
(1, 'Admin', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, '2020-08-08 12:24:45', '2020-08-08 12:24:45');

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

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `setting_name`, `setting_default_value`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'User Registration Bonus', '10,5,1', NULL, NULL, NULL),
(2, 'User Subscription Bonus', '50,20,10,5,5', NULL, NULL, NULL);

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
(15, '2020_07_13_081236_create_transactions_table', 1);

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
(101, '+8279486356525', 'f7dd5a20-2bed-4455-a5e1-56a0530c5762', 'c67b5113-0210-4f1d-b864-32634c59b31b', 0, 'Mr. Elliot Lind MD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8mFXnt', 0, NULL, NULL, 'normal', 'ron.leuschke@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'f2ke0hUSWV', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(102, '+8012648288412', 'ae6a4372-0a78-4b38-94cd-92698a71c740', '55a24954-444e-4970-a434-8d42be48ffeb', 0, 'Jeramy Durgan II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4YNuGl', 0, NULL, NULL, 'normal', 'wveum@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yQ5romtNnb', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(103, '+3916295600894', 'ba607268-7c81-4dbb-afa2-6431a5680561', 'f282c5bf-f8b0-46d5-85e6-290608a8bcbd', 0, 'Tony Nienow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gOEyn8', 0, NULL, NULL, 'normal', 'aurelia56@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4iAR1fEWWo', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(104, '+2905838501733', 'ec6cbba2-2752-4ed2-8ec7-2f49480459fb', '9430a4e2-98e0-4434-88a7-e00f2afe13ca', 0, 'Stacey Gottlieb DDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NgUvXu', 0, NULL, NULL, 'normal', 'savanna.walker@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'E3ohqGxRvA', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(105, '+7445829747398', '6acac8ec-35f5-4fca-9d27-934d15ccc87b', '5ce47a03-e0e2-40f6-bb13-b7b0e643f0ad', 0, 'Mr. Ansley Hoeger', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'icpeW7', 0, NULL, NULL, 'normal', 'oheathcote@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DO370raYmn', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(106, '+7572814079478', '7bda4585-6998-45a7-9fd1-f2e2f52f49ed', 'ea1a65d8-07b0-4d47-8056-431bbcf3642a', 0, 'Heloise Crist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pnwu8c', 0, NULL, NULL, 'normal', 'alysson85@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aBBkn7mtD0', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(107, '+4516372031031', '5b4fa6e0-94d9-4dc8-830c-712ab4f3ceb2', 'caf53f73-9898-45e7-84be-9593ee6adb20', 0, 'Prof. Irving Lockman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdkWx1', 0, NULL, NULL, 'normal', 'frida.morissette@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'JlA2YgVTAz', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(108, '+5066131115967', '4bb5b749-3fd1-4082-a2ac-458cd50366de', 'ad5f1033-8e3e-4760-ac9c-a2051efd45bd', 0, 'Miss Michaela Cartwright I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MeJ9vC', 0, NULL, NULL, 'normal', 'medhurst.dee@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GVQ5y3XM0y', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(109, '+6702274412269', 'e4558fa1-86d1-4ac0-8e3f-a368c11eb898', '26ab1f11-b4e0-4064-89ea-aa374c8fdf5e', 0, 'Mr. Seth Hackett V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wIUhIE', 0, NULL, NULL, 'normal', 'srobel@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'W6PzRz5qv0', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(110, '+4571549746286', 'a31b0daa-0ede-4040-8ecc-d6cddf3d1a57', '36aeb9b0-f0a9-4e67-8678-89597a3a5f34', 0, 'Wellington Heller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8zXntu', 0, NULL, NULL, 'normal', 'amparo00@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yNjy0IYVV0', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(111, '+8037520341782', 'cd015695-991e-4574-9114-196caf27d141', '28a934ec-8601-4b2b-a874-2592022dff63', 0, 'Winnifred Lynch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'T2HoEW', 0, NULL, NULL, 'normal', 'yosinski@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VD1kloAdcc', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(112, '+2688253871753', 'ca0b8e93-1dc6-497a-97dd-857d6847c595', '3567b548-3a9e-40a7-b3e3-0bc85dacd084', 0, 'Ella Luettgen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5F8po3', 0, NULL, NULL, 'normal', 'reilly.karl@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '66YFFEwknp', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(113, '+9183295526293', 'a534945b-b8b7-4a0d-a2eb-c5a58534ef0d', 'e018cb03-c3b0-4168-aaed-cdccde873f17', 0, 'Johann Ullrich', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0ng1Q6', 0, NULL, NULL, 'normal', 'vreilly@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oJl48OSXHc', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(114, '+1097984915079', '141f2b32-f055-414b-94f5-563c75d1c8a7', '98d46d6b-24e5-4e42-b113-af468717bc5b', 0, 'Berenice Ullrich', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'esGbZI', 0, NULL, NULL, 'normal', 'rosamond.mayert@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vpt2Fl6Ocd', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(115, '+4266740210568', '12883319-c729-4c03-9a0d-bc5c7d45a0dc', '70b46158-4080-427a-8c10-d1fca069e383', 0, 'Dr. Kristy Schumm DVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WiwVYk', 0, NULL, NULL, 'normal', 'fstark@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ILwcC0pVIu', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(116, '+6266296077658', '9a70b4c3-2485-4a58-89cd-7b693a048130', '07ce23df-88a0-499f-a619-3ee016394457', 0, 'Wallace Quigley', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'H7eGat', 0, NULL, NULL, 'normal', 'ukeeling@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vdN7338ZYQ', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(117, '+3923353381746', 'd95f2213-1f74-4294-8f13-9d17decc6d22', 'faa62ff6-033d-4a1c-a1dd-f132c828ba91', 0, 'Michel Haley IV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bRUA6G', 0, NULL, NULL, 'normal', 'vgutkowski@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6fF7IJ71o5', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(118, '+1908389870327', '0d9a12b9-6c8f-40c6-acd5-3b05058e06bd', 'c90b91a0-1423-4068-bf96-9c442e8768ff', 0, 'Dr. Candelario Schaden Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1rYrY7', 0, NULL, NULL, 'normal', 'torphy.jarod@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5p3xAlGOGK', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(119, '+3735766670898', 'ee6ab52e-ecb7-4fc5-9046-1d78a65e7bb3', 'de6d3f92-9112-408c-8d3e-c6429f2d3bd2', 0, 'Damian Mosciski', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Zj1WhF', 0, NULL, NULL, 'normal', 'liam67@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fQoERLpcO5', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(120, '+3576640059491', 'd02aa373-eed0-4804-bdbf-2e971b4851e4', '1682325b-1bca-4e7b-9476-7368c44d7d0f', 0, 'Brennon Greenfelder', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'm3EExe', 0, NULL, NULL, 'normal', 'dorthy57@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DCyFZSCk2I', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(121, '+3939871235948', '2ce62963-d0c3-4890-808a-237f20e38117', 'e115f15e-0d1e-4536-9ea1-d20390322f3e', 0, 'Mertie Friesen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P0mCbm', 0, NULL, NULL, 'normal', 'pbode@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mKuAh2WvPD', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(122, '+5944080916459', '2faefd1e-c934-402d-85dd-6c13f4b2cbe1', '700023ee-a090-4c18-9160-712358271559', 0, 'Karine Hauck', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TenwZg', 0, NULL, NULL, 'normal', 'elwin.yundt@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'j7kHx9yOiK', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(123, '+9439218587039', '6c8a8c00-540c-4ca6-87e5-520876ce0195', '095a63ca-1125-486b-b72f-946d92338333', 0, 'Bonita Lakin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TKVWbm', 0, NULL, NULL, 'normal', 'astark@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gDCH6iw2gS', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(124, '+7511116306457', 'e624661b-c5d1-46fb-ab0b-4fdddc550352', '6e7b9e8b-b133-4485-94ea-e07da8499db1', 0, 'Rosina Windler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DXz3D8', 0, NULL, NULL, 'normal', 'sammie09@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BUm8pyxSGo', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(125, '+5990221293936', 'a8cfcde8-b04b-4591-86e8-0c56461db8a3', 'df3e5ef7-0dc2-46ca-86ee-98d51cb16a16', 0, 'Sidney Nikolaus Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7SYHT8', 0, NULL, NULL, 'normal', 'veda.okuneva@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'n11A4QXyak', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(126, '+6501369127988', 'cc378afd-4b63-4f71-8032-59de5d47629a', 'a2e95f70-a525-4888-9126-e2e4d7255c07', 0, 'Aidan Rogahn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KH9iYy', 0, NULL, NULL, 'normal', 'etrantow@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'O9H9OtWYoH', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(127, '+1850989086728', 'acfb1f12-82f3-4fb2-803a-9745c8b3e10a', '79e995d2-d487-4bac-983d-38e4481d97b2', 0, 'Magdalen Schmeler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wER3bf', 0, NULL, NULL, 'normal', 'annabel.marvin@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nhcFEKL7kv', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(128, '+8487293952981', 'f23f1064-fd45-4e6f-9684-1ddd6cee7c7e', 'b2aece96-378a-44db-8c52-7e57b3eea81d', 0, 'Tyreek Tillman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TUKxa0', 0, NULL, NULL, 'normal', 'brooklyn46@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yDsqs0WNUL', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(129, '+2468000113076', '9c1c4f4b-2e6b-455a-ba8c-a7bec1fe8840', 'f08c0783-46fc-4fe8-acce-8b1e8771af30', 0, 'Karine Kerluke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5p3B1w', 0, NULL, NULL, 'normal', 'bartoletti.cristian@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KLABXlnl9q', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(130, '+5554716305480', '39304038-b795-43f2-89d6-d0f2a3396d06', '7c33f9f1-8bed-4d34-9562-8c0b32fba3be', 0, 'Rickey Abernathy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'j9b7A8', 0, NULL, NULL, 'normal', 'myrl41@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'd8Hq9VaIi1', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(131, '+9080196799188', '4580a950-5d7c-42fc-8f23-6fda95d87af2', 'd2701bc0-440d-425d-824d-a55316d7d4e3', 0, 'Kaela Hansen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hEoD81', 0, NULL, NULL, 'normal', 'zpollich@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6VELpU5sig', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(132, '+9744295471101', 'fed0d436-130a-4f39-9580-aafd5836ec8f', 'f6309bb9-2643-423e-b860-b8dc6d4518c1', 0, 'Dr. Maria Vandervort', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ez9sbi', 0, NULL, NULL, 'normal', 'ledner.arvilla@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XCrFgXImxf', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(133, '+9136747986655', 'bfee241d-e0a1-4219-a9e1-584a41596948', 'b1a0f22a-c2f7-423e-af98-5983d4c8c0c0', 0, 'Miss Carolina Howell Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8wPSKr', 0, NULL, NULL, 'normal', 'etowne@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qnbOP2YY3O', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(134, '+2966140113877', '4cef3862-6aec-49d7-a048-42db7f8c0078', 'ea90d7b0-b541-42bd-9f23-e224c39a6ea4', 0, 'Prof. Beverly Ward DDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44Eayz', 0, NULL, NULL, 'normal', 'maud.cremin@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'joPgQ4qvuj', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(135, '+2842248870150', '7af24c14-7431-4916-8e4b-e2a794bfd6ff', '1e692f7b-3312-4adc-b789-044ecda5118b', 0, 'Ilene Keeling', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2yRx8r', 0, NULL, NULL, 'normal', 'rick49@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nOCb7qS3od', '2020-08-08 04:23:55', '2020-08-08 04:23:55'),
(136, '+2436313623580', 'e0f35430-8356-40bc-afe6-8380947414e7', '5c5cf60a-0b54-4b51-8ded-057bb46fdcf4', 0, 'Prof. Josiah Cruickshank', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GPZXPW', 0, NULL, NULL, 'normal', 'carroll.mosciski@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D9qBNkxqac', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(137, '+2650122188539', 'a42e643a-2f45-4223-8b7b-578474b50d5c', '2ae818ca-1af3-4025-9d1d-99ead1656364', 0, 'Pauline Marvin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fLRpTS', 0, NULL, NULL, 'normal', 'lfay@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hmXg8xnGyC', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(138, '+7511303146602', '568abb23-c712-4346-bb16-5b465a699384', 'fe5c5b4f-011d-4fe2-9870-224376254a22', 0, 'Violette Zieme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mcCB4X', 0, NULL, NULL, 'normal', 'hschumm@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pKwsNZO9F0', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(139, '+5070706172510', '2e78ed58-da05-427f-9f9b-9c5e7d285ea6', 'ce2af40e-aa49-4c5e-8f50-af431c47be66', 0, 'Miss Halie Renner DVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HLz7l3', 0, NULL, NULL, 'normal', 'nhessel@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a7VcRvYy8P', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(140, '+4315743921825', '76f10e10-f977-48a6-8e23-11c690f6f786', '17204b6b-d8cb-4af7-a826-5bfe4bd97cb6', 0, 'Cayla Wuckert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RBpb3H', 0, NULL, NULL, 'normal', 'seffertz@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fm1G6R6lFG', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(141, '+5022793460031', '8351f8de-9cd0-450a-9799-1faa1bfd5f12', '081e40c5-fb89-443a-807f-1482fbca42cb', 0, 'Trace Abshire', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'WIPsLP', 0, NULL, NULL, 'normal', 'devin05@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KZ3p8sMlTF', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(142, '+2017388466607', '8520a875-925d-4893-b500-22959b6ee74a', '1c7d99d7-2a0c-4bd3-a33d-c52e9e1fc0da', 0, 'Jarod White', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rBR41w', 0, NULL, NULL, 'normal', 'hpfeffer@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xKaygT83gv', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(143, '+4219306875540', '74407fc4-8903-48e8-9ac9-54df11d59995', 'c4a93a2b-1c44-47a7-9a1e-46300f2dfc1d', 0, 'Darrell Schaden', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PwcnUp', 0, NULL, NULL, 'normal', 'murphy.jabari@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WmbDf8NJI0', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(144, '+5523289041204', '84911337-3b0e-4e22-b463-2bd5e66c3c7d', '1d0a6969-40fc-4f8d-ba63-bd3015b462ff', 0, 'Lew Kohler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'j1K2YU', 0, NULL, NULL, 'normal', 'znitzsche@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XilavZkqU9', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(145, '+9594736601488', 'ae0ee6be-e589-4cdf-b3ca-0896fe90cca9', '2592a7f3-abc4-4d55-9359-e2725c903466', 0, 'Astrid Veum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'f3v6q2', 0, NULL, NULL, 'normal', 'clinton.goyette@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OgaIjcyQOq', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(146, '+3485701897250', '76532455-1fa9-444b-8df9-ba493a051211', '64a9cd69-5462-46bf-a145-aaf506e7d15f', 0, 'Wilton Franecki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QOTufH', 0, NULL, NULL, 'normal', 'roma56@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tHhznrOKxP', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(147, '+9745013391041', 'de453684-b58e-46b9-9ea9-fa866e1eaec8', '0087dc82-a2d7-48cb-a6dc-dae18da6a352', 0, 'Houston Boehm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'W8hig1', 0, NULL, NULL, 'normal', 'lupe60@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1wP27sx7MY', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(148, '+9331181938940', 'bde9a290-833d-45b4-8673-6dd7996e6fed', '27a6ea5d-6a2d-4adc-b70e-b8dbed2fe138', 0, 'Mrs. Amy Zemlak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dzs6Ui', 0, NULL, NULL, 'normal', 'zola.stracke@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'l02oDlACYU', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(149, '+3244727356445', '97f67c47-2759-443f-813b-3ec79e16889c', 'f93fe369-b55c-4be2-afdc-8bd822a8f8fb', 0, 'Marian Weimann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tqn4hv', 0, NULL, NULL, 'normal', 'lind.darrell@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eGHw3oHasp', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(150, '+3684156763335', '737b8642-d897-4f92-87a7-2b32e5821aa3', 'a5e73f41-9ddd-4554-bb7e-b0414a0b8380', 0, 'Andre Kuhlman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nUhBu7', 0, NULL, NULL, 'normal', 'jaren.hammes@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kfMyxOZbuC', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(151, '+6498067327348', '67792c5d-28a0-4384-9f21-5e8e11cb830f', 'd3819f57-360c-4c7d-b964-f1a0e1279335', 0, 'Ms. Adele Toy Jr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wK60u6', 0, NULL, NULL, 'normal', 'agrant@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'blW6OnGNvR', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(152, '+4641059181975', '94b676db-d127-4564-a3a8-b3f91dc1f5f7', '14f67ea1-c520-4ab5-8552-173e1c92bb53', 0, 'Mrs. Ofelia Zieme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yXkU3k', 0, NULL, NULL, 'normal', 'lizzie.damore@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8owihiYd6y', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(153, '+1286892468598', '76333711-cf16-4adc-bb73-0a25a40f3192', 'fdbedf7c-ac9a-481b-8c27-8d8901fa8ec2', 0, 'Casimir Shanahan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ht9H5F', 0, NULL, NULL, 'normal', 'hills.gabriella@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gx10gv2X8L', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(154, '+1708913462109', '22637d92-6ec5-4619-939d-d584d057a361', '4da811e9-c491-4d58-a203-dc2ed692efac', 0, 'Mr. Luigi Yost', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lx1KLl', 0, NULL, NULL, 'normal', 'loyal06@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v7z5hv8j9Y', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(155, '+4561163480673', 'e6e63e6e-20ce-494d-b99c-f073bb41a97c', '670a6b83-5f4e-4e2d-aa1c-d9aa46c999b6', 0, 'Isaac Mitchell', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'k9n6on', 0, NULL, NULL, 'normal', 'emmitt.walter@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Zc4WZ5nel0', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(156, '+9539336840456', '3ab9036a-04bb-4537-9406-4647eebfd5bf', '67f7b212-327e-406c-93f4-bf52a2518de6', 0, 'Reynold Hyatt V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'of23ZB', 0, NULL, NULL, 'normal', 'christophe87@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YWHcWIOC2s', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(157, '+3905628944506', '719941f8-7248-4c4c-8d42-314a188f1776', 'f2a74961-e62e-4ede-a8ed-a15d5dab3e38', 0, 'Elijah Vandervort', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LukheF', 0, NULL, NULL, 'normal', 'ilene.kassulke@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'G6oldfpcsY', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(158, '+5462783052669', '4d31250b-9d2c-4dbb-84e1-7813f8e8f3c6', '7b45c2d8-cd8a-47e6-b096-99c23dd13621', 0, 'Nora Franecki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uksW29', 0, NULL, NULL, 'normal', 'anya.price@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7poqrLaIvH', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(159, '+1322811686967', 'f7d067ba-2480-4fcd-86c2-843e59399985', '1d1925a1-3975-4b8e-820a-026af6255a5b', 0, 'Wilburn Weimann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ogfm5w', 0, NULL, NULL, 'normal', 'susanna32@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9rw7KoCS0g', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(160, '+7103604309456', 'a661ad50-629d-4b40-9280-a21c2997a8c5', 'f42e1ef2-3d45-4a83-85f9-cc3a83025407', 0, 'Ernestine Brekke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kphIzt', 0, NULL, NULL, 'normal', 'jazmyn.kilback@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'P5vfo4rxI1', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(161, '+6088758801008', '37c28a13-24cd-4371-9f8e-5e56a460fa63', 'ef463346-308a-4bd6-8f69-df6f9c2daab3', 0, 'Kylie Abbott V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9bs6fs', 0, NULL, NULL, 'normal', 'kris.jarvis@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'T6EHPKoVVQ', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(162, '+7601194127154', '96ca35f2-5a77-4d54-ab3a-bbebfc5f7259', '299318cc-5fcd-44f3-abf9-0a8dd3b1c017', 0, 'Leila Renner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'r2i1TL', 0, NULL, NULL, 'normal', 'wisoky.katheryn@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LQdw5gJ5hK', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(163, '+6503227446088', '865a3ee9-17ab-4d65-b7f2-6cd6f2708a0a', 'b44466f5-0a19-49a3-8e9e-3e779683436d', 0, 'Dr. Hellen Moore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6kbRL4', 0, NULL, NULL, 'normal', 'clint33@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8RB1p0zAUf', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(164, '+7189146730461', 'b705d30a-883b-4b01-9311-9d99d4030037', '68aa46c0-c43a-4859-a1ff-26e608668de1', 0, 'Shana Langworth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6jTDpx', 0, NULL, NULL, 'normal', 'rschiller@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8SdO2tWQ29', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(165, '+9500473073259', '41df640e-912d-40fb-a3a1-d75ad390cc0d', '75dd52e8-0af4-4024-8f11-3befe7c02d85', 0, 'Yvette Block', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SFY4u1', 0, NULL, NULL, 'normal', 'elyse.schuster@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VJZLIbHAnG', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(166, '+3947081899449', '45ad4830-5f2d-417d-aaf4-72978746d4e9', 'b10490ef-eb29-4dc5-8e9a-b4bc0b271caa', 0, 'Nikki Leffler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aY8sJ1', 0, NULL, NULL, 'normal', 'mankunding@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dNeZJXSnN5', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(167, '+2878178320672', '73c7238c-8d6d-46aa-b8ae-3dba864034cf', 'a8fee2f3-e54d-4151-8b99-768e974da028', 0, 'Juliet Lemke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NBkTaK', 0, NULL, NULL, 'normal', 'luis04@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3GkR4JdZSI', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(168, '+6139949107855', '052ae7f9-deb3-467e-bd4d-143189aadcc7', '16931253-3385-45af-9fdc-709e64ae0d6c', 0, 'Jude Pfeffer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DdGFiH', 0, NULL, NULL, 'normal', 'maudie.stanton@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SjulTrc4gY', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(169, '+1790578637409', '2a150b64-a4df-4d36-8249-8f59b256abda', 'e79bd843-d72a-42d1-9487-d4891dfddcdf', 0, 'Prof. Violet Durgan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'VWMuOl', 0, NULL, NULL, 'normal', 'ibins@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '376BktSz5m', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(170, '+7203296384658', 'f6174b84-56f3-45e6-9e6b-9ea4cc604dcf', 'fb26be12-2e8d-4bc6-ace1-78014f605448', 0, 'Dr. Clark Willms', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SFntpu', 0, NULL, NULL, 'normal', 'conroy.sebastian@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lC5umuU51F', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(171, '+9981176865953', 'ce16ce8d-10a5-4e20-a1e8-da197459332a', '3253a97c-988d-491d-a9f8-d57f235cb71e', 0, 'Mr. Owen Herzog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YTuy9a', 0, NULL, NULL, 'normal', 'edythe.schaden@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qPSRzuq23J', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(172, '+4154152422853', '3943f8c9-b184-45f2-a25c-bc950b73a31e', '6d88c4ca-04f7-48b2-bd25-9c4019194ac7', 0, 'Fidel Von', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GYHwct', 0, NULL, NULL, 'normal', 'fbartell@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lArlJipIZT', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(173, '+2271700977100', '24df6ea4-305a-4daa-968d-b831991e6c7b', '8b8cc542-544a-41df-a2d2-1d1023dfb9a3', 0, 'Mrs. Alvena Graham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'k0OesB', 0, NULL, NULL, 'normal', 'jasen17@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NNnL2yFZNT', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(174, '+2112316762655', 'f30cf345-5d08-49e5-8f59-d251d448d019', '9712816e-c3d1-47c3-b22f-708c02e908a5', 0, 'Aidan Doyle', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UJfblS', 0, NULL, NULL, 'normal', 'liam.connelly@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IK2rtZN2ny', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(175, '+1534351089951', 'ff1d792a-05ab-4789-88d7-ad04cecccf92', '855f124f-a0c8-4112-8b7b-d2fca78e155d', 0, 'Ted Raynor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Wg5zpX', 0, NULL, NULL, 'normal', 'mina.parker@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tCd6IH8ttG', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(176, '+2960212513075', '7b4c2fdd-9428-4f59-8030-3dd826135175', '8cbbf0d9-321f-4db2-a103-652d7fb666f3', 0, 'Mr. Melany Cummerata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ptpgQY', 0, NULL, NULL, 'normal', 'ines.eichmann@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6mJS5hqmD5', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(177, '+6811582238053', '2967a105-0b5d-4de1-ad2c-9dbbb7ca03b3', 'f6300073-bd8c-4859-be11-308f259621d7', 0, 'Myrtie Ebert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vGwyHd', 0, NULL, NULL, 'normal', 'nreinger@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AGKz1ZPgaK', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(178, '+9857286857976', '479ef7a8-337d-49e2-a755-677aacc06168', 'cd822b17-f0e0-4bdd-a925-e2079be0f132', 0, 'Era Runolfsdottir', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '783alo', 0, NULL, NULL, 'normal', 'vrau@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KSjtzSJshl', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(179, '+8306981158336', '11bb2a4c-1c9f-4a77-861c-de9181394531', 'f9ebaa2a-4f73-49da-964b-57e00d914977', 0, 'Rylan Larkin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XknKB5', 0, NULL, NULL, 'normal', 'baron61@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GXIf1TL0WR', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(180, '+8104271151679', 'a24e4f7a-0817-4638-97c4-e59eedd75b8e', 'bc971f68-1317-428e-84c3-3b92fb24c874', 0, 'Kiarra Durgan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ofjPyY', 0, NULL, NULL, 'normal', 'johnston.sylvia@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2RQUnzVZVU', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(181, '+6881022485735', '1a596838-3a6d-4dca-a9d3-0a8aba6a972f', 'b95f1c41-573b-4291-a551-1474ca3fb1b9', 0, 'Mr. Theodore Fritsch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OhFU1l', 0, NULL, NULL, 'normal', 'lemke.alan@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UcFh6LJPaM', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(182, '+7751732544002', '4a34aa71-3666-43d8-97a8-196edd5bd53c', '206a3920-61b1-4769-a17a-b61ac5c27356', 0, 'Madie Prohaska', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PMeHWp', 0, NULL, NULL, 'normal', 'garnett27@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fZz5kc7hYw', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(183, '+2354254494850', 'c4af0309-51f2-4a2f-9d20-5fab2eac7848', '3c4bd79f-0f5f-479c-b114-0975304877c4', 0, 'Prof. Einar Bauch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LD3MZX', 0, NULL, NULL, 'normal', 'alejandrin61@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UTgxRS7cRM', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(184, '+2492653913472', '397cb9f1-056e-4d07-8426-176a3ccd1da4', 'b2561d1c-b0ca-4eab-ab64-1421a6e5cfe6', 0, 'Karine O\'Connell', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kVgsrU', 0, NULL, NULL, 'normal', 'pskiles@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BNerH4vpnt', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(185, '+5225639171417', '5c2af99d-3949-48a3-b3b9-14c3495648e1', 'e82c49d9-ed6f-4fb8-b3ec-da1ad9b677ca', 0, 'Cornelius Wiza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dT22it', 0, NULL, NULL, 'normal', 'bradly.kassulke@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v5qX04WCmp', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(186, '+3345770889808', '45026731-9b90-4c97-bb14-02404734364f', '324c205a-9d6f-4d0a-bf31-66adfb69ac07', 0, 'Clay Beatty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mk15tO', 0, NULL, NULL, 'normal', 'nspinka@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QCyLU2H5bt', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(187, '+4021079338503', '3fa37357-f298-4094-8c94-b5c31a84e8f6', '179ed7de-07f8-4363-ac1b-d40a43e7ddfd', 0, 'Georgianna Volkman V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C8ZOvX', 0, NULL, NULL, 'normal', 'brielle.johns@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mJaUwb1Nya', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(188, '+8714508858609', 'c9970147-bc87-4230-95b4-25f05036e849', 'aacf00f7-2c1e-4448-95b1-6c5f3599baa9', 0, 'Kieran Bruen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JsQ3cd', 0, NULL, NULL, 'normal', 'carter.christine@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XS9WZ69CCI', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(189, '+8249661844235', 'f573bf0a-b787-4556-bc5c-3b3dd7d79e76', 'af914a6a-41f5-45e7-8b89-271223024d0a', 0, 'Eula Reinger', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nVOSz8', 0, NULL, NULL, 'normal', 'darrell74@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lKKAyWlmFY', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(190, '+1827978387133', '5d733873-1409-4f86-8a7b-e9b28f557eee', 'b957924e-7c49-4053-8fea-efe0c466e473', 0, 'Norval Goldner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eDqWrh', 0, NULL, NULL, 'normal', 'aking@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D9hQ7encQa', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(191, '+2197222623165', '8ce6dbfa-6c61-4ae2-b8f9-9f76615c5c4b', 'c0ac9f5c-849b-4100-9afc-167ce4ee80b9', 0, 'Rashad Keebler', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N9nP3I', 0, NULL, NULL, 'normal', 'alayna.runolfsdottir@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vUoXTFgQ92', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(192, '+2504245668944', '1585d783-cdc1-40f2-bf7b-63199ed8e2b6', '2bc81a24-04f2-4d45-9c81-9d527c3d18a9', 0, 'Ernesto Jacobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sUmHhu', 0, NULL, NULL, 'normal', 'glegros@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AM9wPU4CgL', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(193, '+6072910829879', '7625dc66-8508-4bb4-916f-2b72286e2609', 'c0e3f95d-6ad8-4c53-8fa3-32013dc7e270', 0, 'Archibald Torp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tutjDX', 0, NULL, NULL, 'normal', 'powlowski.freeda@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pTDxAmBv9S', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(194, '+6067162132240', '463171b9-5292-475f-bd41-5f1f19e00832', '68173f35-368c-4856-ba6e-0d75bf4b5cc9', 0, 'Nelson Stanton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'D5dKT7', 0, NULL, NULL, 'normal', 'efunk@example.com', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qgCIVxJnOL', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(195, '+8703106708441', '5fca4e3b-93ab-4baa-8cbe-fb5df54c732c', 'bf417560-c47f-4674-b939-437922506030', 0, 'Isaiah Morar IV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'r2CNja', 0, NULL, NULL, 'normal', 'rhahn@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TFulpfZe4b', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(196, '+6843787244493', '1b76f885-da8c-4f33-a4ee-6ad6eaba7085', '7ee779d3-4afa-46e9-9809-079e201f6bca', 0, 'Ms. Carolina Rowe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'swrPoR', 0, NULL, NULL, 'normal', 'greenfelder.johnathan@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9WDTK1xFgy', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(197, '+7900986691520', '912a2d87-7448-4366-99a8-883743f88366', '53a1b011-da47-4877-ad06-acf6fecc0482', 0, 'Kadin McCullough', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Q35yDl', 0, NULL, NULL, 'normal', 'herzog.alessia@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PaLIaAiTB4', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(198, '+9620671738290', '13d3af02-b78a-4869-a817-24f082c34431', 'c6037166-54c9-47e9-966d-43ef22582d45', 0, 'Gardner Lemke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8YkUN8', 0, NULL, NULL, 'normal', 'oscar.bartell@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8P5LhH8fyQ', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(199, '+4309554400390', 'cc1c9e25-2f3a-4ab5-a80a-2adfb558d9bf', '38140f1c-cc85-4ac4-b0f7-eb30df919c00', 0, 'Jordane Muller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A4lqzf', 0, NULL, NULL, 'normal', 'adele.collins@example.net', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gbfsFo9K5f', '2020-08-08 04:23:56', '2020-08-08 04:23:56'),
(200, '+6064014430517', '3a59d8d7-9908-48fe-9d13-6c7e9ecaf2b6', '9cfaa557-438a-420c-85e7-09f192513b27', 0, 'Kamryn Kiehn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P1Z8QH', 0, NULL, NULL, 'normal', 'gmcclure@example.org', '2020-08-08 04:23:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'n43WGbQNMU', '2020-08-08 04:23:56', '2020-08-08 04:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
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
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_num` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `friendship_groups`
--
ALTER TABLE `friendship_groups`
  ADD CONSTRAINT `friendship_groups_friendship_id_foreign` FOREIGN KEY (`friendship_id`) REFERENCES `friendships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
