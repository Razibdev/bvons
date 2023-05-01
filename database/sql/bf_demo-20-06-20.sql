-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 09:13 AM
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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `body`, `media`, `created_at`, `updated_at`) VALUES
(1, 6, 12, 'Consectetur et illo repellendus tenetur. Aut eum ipsum nisi suscipit iste nemo molestiae. Iure pariatur reprehenderit dignissimos unde impedit fuga. Repudiandae qui alias soluta.', '[95,129,230]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(2, 8, 13, 'Accusamus ipsam et explicabo enim. Deleniti qui laborum et molestiae cupiditate. Quas aspernatur et molestias sunt est.', '[69,238,227]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(3, 2, 12, 'Velit aut aliquam omnis quam quia debitis atque. Ipsa nemo sint perspiciatis facilis quia molestiae itaque. Impedit saepe quis minus ad ipsum atque enim. Quia a rerum eligendi fugiat sit.', '[224,180,99]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(4, 10, 14, 'Eos ea aliquam omnis doloribus. Atque excepturi id esse alias rerum. Ullam qui aut exercitationem ut. Mollitia praesentium maiores et.', '[77,127,246]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(5, 11, 6, 'Exercitationem possimus quam eligendi distinctio est consequatur. Id aut quo molestiae iste. Consequatur dolorum ut quidem beatae laboriosam. Animi eos nihil adipisci a.', '[152,193,122]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(6, 15, 3, 'Culpa doloribus itaque consequuntur non quam. Assumenda nostrum dolor libero recusandae ut dolor voluptatem. Consequuntur et autem eaque saepe aut.', '[150,151,227]', '2020-06-23 01:13:07', '2020-06-23 01:13:07'),
(7, 11, 11, 'Iste laudantium mollitia non qui et ut a. Sint totam et voluptatem consectetur ratione odio omnis. Corporis cupiditate rerum qui quos ut non nulla.', '[35,92,33]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(8, 8, 12, 'Non reiciendis qui consectetur et fugit eius. Vero vitae molestias rerum recusandae mollitia molestias est. Autem et ex quasi exercitationem aut.', '[84,195,117]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(9, 4, 3, 'Reiciendis ut voluptatum ratione voluptatem exercitationem. Quibusdam dolorem qui ipsam cupiditate excepturi enim. Est voluptatibus voluptas aut. Deleniti sed temporibus dolore dignissimos dolores.', '[71,167,116]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(10, 9, 11, 'Nesciunt ratione id quibusdam atque qui in. Et et provident rerum enim qui vel pariatur.', '[177,25,188]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(11, 14, 11, 'Minima non nihil id aut sed itaque aut. Autem adipisci omnis aliquam. Nemo ullam ea et quos quia eum. Quod odio optio aut id.', '[128,102,16]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(12, 1, 14, 'Similique doloribus necessitatibus quia nobis qui. Cupiditate optio ex necessitatibus sunt et et quidem. Officiis rerum quo blanditiis sint maiores suscipit eveniet. Autem maiores voluptates minus praesentium eos hic.', '[18,181,38]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(13, 4, 2, 'Autem rem perferendis minima at perspiciatis nesciunt. Ut cumque aut quia eum.', '[140,175,28]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(14, 4, 14, 'Eveniet nihil quia repellat. Ex voluptatem sint dolorem amet. Voluptas consequuntur et provident porro doloribus. Et harum nulla voluptatem laudantium nihil.', '[216,76,117]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(15, 10, 13, 'Voluptatem dolorum nisi dicta eos in. Enim sunt saepe velit quasi amet corrupti. Numquam animi ut quo sapiente sit et.', '[170,22,176]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(16, 10, 10, 'Aut optio et veniam ducimus amet. Nobis doloremque veritatis voluptatem non rerum consequuntur in. Aut odio quia quaerat earum et sit. Qui maxime id doloremque et consectetur molestiae voluptate sed.', '[167,206,103]', '2020-06-23 01:13:08', '2020-06-23 01:13:08'),
(17, 15, 7, 'Repudiandae enim ut aliquam inventore odit quae fuga. Ut sunt nobis totam quia provident. Assumenda minima voluptas accusantium aliquam deleniti quasi.', '[58,229,45]', '2020-06-23 01:13:09', '2020-06-23 01:13:09'),
(18, 2, 14, 'Consequatur est dolorem dolor ducimus. Atque totam ut illo. Et ut deleniti ullam iure adipisci. Sit est soluta eum qui reiciendis nam maiores. Molestiae ut praesentium aut quidem.', '[135,222,162]', '2020-06-23 01:13:09', '2020-06-23 01:13:09'),
(19, 11, 9, 'Labore illo enim rerum molestiae ab doloribus voluptatibus. Sit autem qui et vel. Cumque consequatur sint quod. Voluptate sequi ullam deleniti magni.', '[27,94,5]', '2020-06-23 01:13:09', '2020-06-23 01:13:09'),
(20, 14, 4, 'Porro qui ex aut et. Vitae est nulla reiciendis. Voluptatem fugit adipisci animi. Tempora repellendus inventore animi.', '[72,55,75]', '2020-06-23 01:13:09', '2020-06-23 01:13:09');

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
(8, '2020_06_17_074402_create_comments_table', 1);

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

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `media`, `created_at`, `updated_at`) VALUES
(1, 1, 'Qui quibusdam fugit vel inventore aliquid corrupti. Corrupti maiores eos est velit dicta rerum. Aut aut sed non accusantium nam culpa. Sint culpa in dolor doloremque non modi est.', '[227,245,118]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(2, 1, 'Neque dolor veniam placeat qui. Cumque dolor expedita voluptatem quia tenetur. Deserunt aut velit non. Illum fugit ut eaque temporibus libero quasi.', '[15,31,214]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(3, 1, 'Nemo tempore et sequi aliquid voluptas enim asperiores. Voluptatibus eius doloribus commodi rerum. Veritatis sit repellendus beatae ut.', '[68,20,161]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(4, 1, 'Veritatis aut consequatur aut porro. Animi impedit tenetur eum. Voluptas suscipit sit quisquam aut velit autem. Ullam similique eaque aspernatur sit corporis asperiores.', '[207,240,32]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(5, 1, 'Fugit rem dolor nisi ad necessitatibus et ut. Perspiciatis et inventore tempora consequatur voluptatem. Fugiat sunt illo eius eligendi mollitia expedita et. Tempora sit voluptatem voluptatem rerum.', '[187,153,239]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(6, 1, 'Ipsam ipsa sequi qui et harum ipsa consequatur eaque. Totam doloremque quia sit magnam esse. Non architecto temporibus porro rerum accusantium. Rem ipsam molestiae animi voluptas non aliquam iste.', '[162,82,151]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(7, 1, 'Amet quidem at dolor facere. Voluptatem et ut architecto reprehenderit fugit quos quam corrupti. Consequuntur sunt reiciendis sunt aut laboriosam eos saepe eos. Explicabo vel dolorem repellendus autem vel aut.', '[205,78,98]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(8, 1, 'Voluptas saepe velit dolore ad sed vitae. Non libero alias eum quae et consequatur.', '[86,158,186]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(9, 1, 'Rerum repudiandae quis perspiciatis ipsum. Rem consequatur dolorem cum fugiat sed voluptatem illum sapiente. Ut aut dolor repellat.', '[67,89,96]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(10, 1, 'Eveniet similique nam veritatis. Et qui dolorum necessitatibus est qui. Dicta nesciunt eaque officia et aspernatur dicta.', '[138,131,199]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(11, 1, 'Accusantium omnis voluptas numquam inventore praesentium voluptas placeat. Sed ut ut quia eos minima exercitationem aut aliquam. Qui dolores dolor molestias dolorem dolores ut. Omnis iste beatae voluptatibus.', '[143,165,160]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(12, 1, 'Ut nihil ex aut rerum enim accusamus. Blanditiis culpa eius assumenda reiciendis voluptatem. Perspiciatis totam velit et quaerat cumque voluptas accusantium. Qui quaerat necessitatibus autem laboriosam.', '[151,13,226]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(13, 1, 'Ex explicabo mollitia nulla dolore sunt maiores commodi. Minus repellendus et minus dolore. Dolores nostrum placeat assumenda ea itaque sit. Beatae molestiae doloremque illum odio optio omnis repellat.', '[24,49,214]', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(14, 1, 'Quas iusto in labore magnam ea rerum fugit. Et nulla quas rerum et facilis. Eaque vero illum facilis voluptates nihil perspiciatis eligendi sit. Quia rerum est et et.', '[220,71,135]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(15, 1, 'Aut sint autem et officiis autem. Perferendis in amet aspernatur aut. Quam saepe quo a quidem occaecati. Odit aut earum rerum veniam.', '[56,83,111]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(16, 1, 'Et laudantium inventore similique laboriosam ea aut voluptatem. Ullam voluptatibus eaque hic voluptatem architecto autem aut saepe. A voluptatum tempora autem nihil placeat. Eum ratione quia tempora facere accusantium cupiditate magni.', '[9,16,112]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(17, 1, 'Inventore eos molestiae quod quibusdam et. Blanditiis itaque tempore eum. Quisquam enim eaque quibusdam voluptas eum quae dolore ullam. Aut id ratione tempore velit quia corporis.', '[106,154,234]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(18, 1, 'Odio libero ex omnis aut sit culpa. Rerum voluptas voluptatem accusantium asperiores incidunt eligendi. Ducimus reiciendis esse dolorum dolor. Illo qui aut consequuntur velit quia velit veritatis. Et eius adipisci eligendi ut id recusandae.', '[109,88,15]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(19, 1, 'Facere in non molestiae quis sequi numquam deleniti facilis. Sed optio quis et voluptates labore. Dolores eos quis distinctio perferendis dignissimos sit modi. Aut optio exercitationem autem illo quo.', '[191,82,15]', '2020-06-23 01:13:06', '2020-06-23 01:13:06'),
(20, 1, 'Quae molestiae dignissimos est quisquam soluta sit sint. Dignissimos accusamus assumenda ipsa et harum placeat. Mollitia sed ad ut alias totam voluptatem sit.', '[104,192,250]', '2020-06-23 01:13:06', '2020-06-23 01:13:06');

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
  `balance` double NOT NULL DEFAULT 0,
  `referred_by` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
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

INSERT INTO `users` (`id`, `phone`, `uuid`, `fuuid`, `verified`, `name`, `gender`, `profile_pic`, `cover_pic`, `balance`, `referred_by`, `referral_id`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '+3203762168042', 'd2eb0125-3dbe-478a-be70-5f1dd9b7a089', 'a3354c3d-24a0-439f-b025-5b4d10f9b32a', 0, 'Miss Dasia Goodwin', NULL, NULL, NULL, 0, NULL, '2020623d4V', 'normal', 'aditya.purdy@example.org', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2Z6EAgrtoU', '2020-06-23 01:13:03', '2020-06-23 01:13:03'),
(2, '+8247743731112', 'a0204418-e9f4-4d2a-9b56-b50d324d5808', 'f6227e5f-5f05-4e87-97c7-fb7dfb2abda1', 0, 'Carlee Mertz DVM', NULL, NULL, NULL, 0, NULL, '2020623HAI', 'normal', 'angel62@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BRaPviqWZB', '2020-06-23 01:13:03', '2020-06-23 01:13:03'),
(3, '+5645470446919', 'b7c4b6e4-c6e7-4f43-b309-8721cc1e299d', '33f1f94b-dc2c-4f43-817c-76df558bad9e', 0, 'Prof. Oscar Tremblay DDS', NULL, NULL, NULL, 0, NULL, '2020623MHy', 'normal', 'oberbrunner.teresa@example.com', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '24xdHpuV6a', '2020-06-23 01:13:03', '2020-06-23 01:13:03'),
(4, '+8570645179925', '230feab6-cb8e-41f4-b1a3-f83984075dc4', '28efa319-f888-4afc-9cba-084f6cb78b4c', 0, 'Stan Heathcote', NULL, NULL, NULL, 0, NULL, '2020623h7p', 'normal', 'cartwright.grayce@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AAMmWyofVG', '2020-06-23 01:13:03', '2020-06-23 01:13:03'),
(5, '+2674437164790', '2c82ccf0-4170-446b-895e-8fcf5a8b9d1a', '5718157d-360c-4979-ae4f-38b5b0e22fad', 0, 'Madalyn Hackett DDS', NULL, NULL, NULL, 0, NULL, '2020623SHC', 'normal', 'katrine46@example.com', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ggFWfuSFHN', '2020-06-23 01:13:03', '2020-06-23 01:13:03'),
(6, '+2925878073713', 'fc8df200-5d74-4b08-8d70-875075a58fcd', '40532130-3e06-4798-8328-e5273aba0c07', 0, 'Kailee Connelly', NULL, NULL, NULL, 0, NULL, '2020623eHs', 'normal', 'hkerluke@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UxMF7S0AK3', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(7, '+2926633190944', '23529882-c92b-4007-8370-d4edd474ce44', '0cf9c5ac-279d-458c-916d-8d9d667003aa', 0, 'Prof. Kay Boyer Jr.', NULL, NULL, NULL, 0, NULL, '2020623uWc', 'normal', 'sidney75@example.org', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D9ZlFfVDCP', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(8, '+7777026590274', '84643dea-5e6b-428e-8e43-bfa4dae283c6', '9ea9544c-e577-4daa-8595-d0b59cb07e21', 0, 'Miss Audrey Rath II', NULL, NULL, NULL, 0, NULL, '2020623T29', 'normal', 'miller.stephen@example.org', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kl96gwzFkM', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(9, '+5596469827867', 'b9d6ae8d-d81d-4d72-b6dc-3e15c78becdf', 'e0448d5d-ad21-47c1-999f-cc10949ebf77', 0, 'Loma Baumbach', NULL, NULL, NULL, 0, NULL, '2020623Mhp', 'normal', 'jevon.rau@example.org', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LU0bdIki2B', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(10, '+9487317139601', '7a15ef0e-eb33-4555-a5df-2dc53bafe5af', '3132a4eb-981e-4dd0-9d76-c672de124c5a', 0, 'Mrs. Gertrude Zemlak', NULL, NULL, NULL, 0, NULL, '2020623VmG', 'normal', 'elmer.lockman@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1EVMKaTaHB', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(11, '+3647084712084', '82cc49fc-d813-4826-93ad-5696511f8545', 'b53b4f2b-95f6-4d61-8b2f-7947fd009668', 0, 'Dr. Toby Breitenberg', NULL, NULL, NULL, 0, NULL, '2020623kpA', 'normal', 'chelsea.hane@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0oK2uXsQ1L', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(12, '+2550771845743', '455eb37e-3b7b-4b40-8d82-b2caa1177766', '8eeaf157-19fc-462b-8913-6fc95828c2d4', 0, 'Joany Johns', NULL, NULL, NULL, 0, NULL, '2020623m3L', 'normal', 'wyatt22@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xh3ONAlXGH', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(13, '+1037686800318', '4e007eb9-9845-42cc-bfb4-db69933e8dda', '9360d11b-1704-4bab-948c-ae88a82922f6', 0, 'Rocky Jerde', NULL, NULL, NULL, 0, NULL, '2020623c8B', 'normal', 'gennaro.herzog@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1nQPpQRUoa', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(14, '+3161515893234', '36e14351-3b11-4dd4-b092-e3aa2705b68f', '95150eca-96b4-4f14-a457-9327314a75e6', 0, 'Verla Ward', NULL, NULL, NULL, 0, NULL, '2020623Kts', 'normal', 'hkuhn@example.com', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CNhlsFlqhG', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(15, '+5215387070305', 'fbda86c3-b778-4c0e-afbd-d5dcf6c7a1c9', '777650eb-877d-4f3c-9511-16074a829a71', 0, 'Dr. Rick Jaskolski DDS', NULL, NULL, NULL, 0, NULL, '2020623zMB', 'normal', 'antonina.wehner@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F50t3rUsuO', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(16, '+1933035713008', 'd7348de8-72a1-4aab-a93a-96a6cfbd6e1b', '02b7fa66-ee21-4ed9-ade3-9bff4dee9ed2', 0, 'Vladimir Schultz', NULL, NULL, NULL, 0, NULL, '2020623c2d', 'normal', 'adrienne10@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wCZsoR9thc', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(17, '+9341299297406', '0a3ab47e-f016-4bcf-afa4-d63f25dd7c74', '49c8fc89-c7c5-44a4-a0a1-1f806df6c619', 0, 'Valerie Watsica', NULL, NULL, NULL, 0, NULL, '2020623uv8', 'normal', 'dbogan@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jVliMlkrME', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(18, '+9841514101877', '07b14c83-da9e-49fb-bf79-1063fe6f4e69', '88b1378f-4d48-4661-beaf-8734a876e997', 0, 'Don Moen MD', NULL, NULL, NULL, 0, NULL, '20206239va', 'normal', 'elna.williamson@example.org', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pKnKOLktev', '2020-06-23 01:13:04', '2020-06-23 01:13:04'),
(19, '+5286703196822', 'f7881ffa-5ddb-47eb-9eea-1a8f70b2ec6b', '91e23e42-1485-4eb1-b263-09b3f62e9ec9', 0, 'Julianne Beatty Jr.', NULL, NULL, NULL, 0, NULL, '2020623EbE', 'normal', 'kassulke.lavonne@example.com', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YKoP6GDfn9', '2020-06-23 01:13:05', '2020-06-23 01:13:05'),
(20, '+7429441539513', '18e11a9f-c3ec-4249-bdd1-d3d71dd3544a', '2792b821-3c8f-4503-a3c4-142d5efc748c', 0, 'Mellie Bins', NULL, NULL, NULL, 0, NULL, '2020623ipy', 'normal', 'misael.zboncak@example.net', '2020-06-23 01:13:03', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6RrPom30pC', '2020-06-23 01:13:05', '2020-06-23 01:13:05');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
