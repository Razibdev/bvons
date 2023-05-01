-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 05:37 PM
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
(1, 'Admin', 'admin@admin.com', '$2y$10$iBJPEA.nQh/LGb9u6.RqW.fjsfavyPyrWFRWjR3mCKuVTwEeV2RKy', NULL, NULL, '2020-07-02 09:43:23', '2020-07-02 09:43:23');

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
(1, 38, 29, 'Sunt aut harum et molestiae odit. Voluptatem debitis sunt vel at et libero magni. Quae quia asperiores placeat amet dolore.', '[166,17,105]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(2, 26, 22, 'Vel sunt facilis minus excepturi reprehenderit. Non est dolores voluptas beatae qui consequatur neque. Voluptatum ut officiis velit ut ex optio consectetur.', '[27,0,223]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(3, 1, 6, 'Et aliquam laboriosam molestias ipsam autem consequatur maxime. Ex sit doloribus occaecati quo beatae. Quia quisquam iste quo. Eos et itaque atque tempore laborum velit.', '[17,10,251]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(4, 36, 1, 'Sit aspernatur quis similique inventore omnis. Similique ut maxime sit recusandae laborum sunt tempora. Maxime perferendis unde et aut corporis placeat numquam. Similique mollitia neque nobis sunt cupiditate ducimus hic. Quis cupiditate est reprehenderit magni impedit est repellat.', '[49,162,193]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(5, 12, 22, 'Iure consequatur ratione quia voluptatem qui temporibus. Unde inventore velit et accusamus. Adipisci et possimus eos quo quasi. Asperiores modi unde quo in reiciendis a magnam occaecati.', '[181,98,81]', '2020-06-24 02:00:21', '2020-06-24 02:00:21'),
(6, 29, 14, 'Voluptate recusandae reiciendis exercitationem incidunt ad recusandae odio. Quas dolor incidunt sint aliquid expedita ad. Ea eaque qui sed consequatur. Enim ad et quos ut facere distinctio.', '[41,121,178]', '2020-06-24 02:00:21', '2020-06-24 02:00:21'),
(7, 38, 9, 'Molestias occaecati pariatur aperiam blanditiis ut natus. Delectus consequuntur deleniti est eum. Quisquam dolor consectetur magni omnis ipsum non.', '[72,85,254]', '2020-06-24 02:00:21', '2020-06-24 02:00:21'),
(8, 21, 4, 'Et cupiditate iste sed voluptates temporibus officiis. Et quaerat id porro eum non dolores. Maiores non quis quos aliquid. Explicabo aspernatur ab ipsa sint animi earum.', '[183,144,140]', '2020-06-24 02:00:21', '2020-06-24 02:00:21'),
(9, 26, 30, 'Perspiciatis alias explicabo eum ut nostrum cum. Eos consequuntur itaque quas. Velit suscipit laborum natus qui animi ut amet. Cum consectetur aut odio minima nihil harum. Molestiae laborum non vitae labore quos dolore.', '[125,18,221]', '2020-06-24 02:00:21', '2020-06-24 02:00:21'),
(10, 14, 13, 'Facilis error dolorem rerum excepturi magni quas voluptatem. Veniam necessitatibus nulla non rem. Unde ut ducimus illum occaecati ullam. Voluptas nostrum blanditiis magnam itaque.', '[175,202,218]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(11, 37, 13, 'Vero quis eius ea aliquid. Perferendis quo assumenda qui at animi necessitatibus voluptas. Est quis voluptas quibusdam architecto.', '[194,223,229]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(12, 50, 30, 'Asperiores minima nobis ipsam ea. Assumenda quam ex corporis sunt. Perspiciatis pariatur eveniet adipisci consequuntur in.', '[106,115,188]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(13, 11, 15, 'Delectus qui nihil quasi hic delectus. Odio nesciunt placeat hic quis qui. Cum vero sed ea provident.', '[87,50,217]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(14, 24, 14, 'Quis quisquam et eligendi voluptatibus omnis aut et quo. Assumenda cupiditate ut eum omnis. Fuga quasi dolorem fuga sequi.', '[92,228,212]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(15, 39, 24, 'Esse eaque optio ut consectetur ipsum. Veritatis est voluptatem voluptatum dolore quo. Adipisci et ex ut maiores quae dolore.', '[131,223,193]', '2020-06-24 02:00:22', '2020-06-24 02:00:22'),
(16, 11, 21, 'Similique voluptatem odio culpa voluptates. Magni necessitatibus facere sunt aperiam numquam repudiandae ut. Facere illo quia consectetur dignissimos.', '[227,121,203]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(17, 21, 9, 'Quo suscipit ipsam quia aspernatur hic officia adipisci. Vitae placeat perferendis vel architecto velit voluptas. Cupiditate numquam sunt repellat aut aliquid enim soluta. Nobis maxime sit est at non alias. Animi eligendi quo facere est sunt.', '[25,10,79]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(18, 10, 9, 'Omnis quia voluptatem aspernatur et. Ipsam quia incidunt unde. Aspernatur et eum voluptates et. Reprehenderit rerum magnam sunt eligendi sit et ut architecto. Eligendi officia quidem aliquam omnis cupiditate cupiditate expedita.', '[221,51,157]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(19, 5, 7, 'Blanditiis corrupti et quo labore. Velit quibusdam suscipit ullam nulla doloribus impedit et. Ratione aperiam nisi perspiciatis qui et.', '[205,47,55]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(20, 24, 4, 'Quia id illo quos nulla. Omnis exercitationem iusto nemo doloremque beatae atque. Harum voluptatem et quas dolorum et velit.', '[137,4,50]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(21, 44, 4, 'In est eum velit dolore soluta dolor rem est. Quis molestiae harum recusandae sapiente est recusandae. Ut provident ut ut laboriosam et aut error. Laudantium porro rerum aperiam.', '[186,107,214]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(22, 13, 22, 'Laborum iusto id quae quos ullam itaque. Temporibus eos culpa ab officia corporis velit nobis et. Et reprehenderit accusamus sit. Autem ut velit inventore modi est.', '[224,77,222]', '2020-06-24 02:00:23', '2020-06-24 02:00:23'),
(23, 41, 26, 'Beatae rerum voluptas alias sequi sapiente. Accusantium esse totam in illum voluptatem iusto. A omnis magnam culpa.', '[106,52,82]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(24, 4, 17, 'Dolore molestias minima quisquam voluptate doloribus. Autem in veritatis nisi libero veniam. Asperiores occaecati ipsa rem.', '[9,110,30]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(25, 47, 14, 'Enim aut cumque voluptas voluptatum eligendi. Sed aspernatur repellat officiis.', '[193,47,95]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(26, 24, 16, 'Necessitatibus molestiae dolor hic et nihil. Est dolorum minus aut enim. Quisquam modi fugiat aut qui doloribus et enim.', '[156,6,133]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(27, 44, 29, 'Quis veritatis rerum aut necessitatibus quasi quo quos. Esse quis deleniti sint quo. Earum molestiae consectetur aut reprehenderit dolor excepturi enim magnam. Earum quia quia occaecati ipsa optio aut.', '[36,96,76]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(28, 23, 11, 'Aliquam voluptatem vitae quia repellat qui repellendus. Reprehenderit ipsa rerum reiciendis cum ut vitae dolor. Quisquam nisi voluptas fuga expedita qui veritatis.', '[135,117,237]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(29, 16, 28, 'Vero consequuntur et ullam praesentium unde. Ducimus minus molestiae autem dolorem. Et aliquam est ex reiciendis architecto.', '[38,166,108]', '2020-06-24 02:00:24', '2020-06-24 02:00:24'),
(30, 36, 27, 'Suscipit consequuntur nulla rerum iste. Corrupti qui accusamus architecto officia et. Sit aliquam ullam sunt ex. Earum dolorem facere accusamus ut.', '[105,100,220]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(31, 17, 22, 'Enim deserunt distinctio repellendus sint. Consectetur maiores aut et nesciunt praesentium incidunt. Itaque inventore sunt tempore et vel.', '[158,112,47]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(32, 11, 13, 'Maiores et aut quae. Dolor et fugiat non nesciunt. Dicta ratione tempore eos quis. Suscipit excepturi enim neque.', '[105,238,33]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(33, 40, 11, 'Blanditiis dolorem alias rerum quasi qui est. Non dolorum facilis quis ut omnis tenetur. Ex iste magnam quod enim. Laboriosam tempore laborum et ex ut ut.', '[60,134,34]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(34, 44, 12, 'Quis quam pariatur ipsa libero. Esse perferendis fugit aut tempore voluptatem. Aliquam ea amet dolorem aut. Similique fugiat aut quia reprehenderit excepturi ut impedit adipisci.', '[53,141,245]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(35, 30, 14, 'Quia possimus et labore nemo aperiam neque ut. Aut harum molestiae officia pariatur quo eos. Voluptatum error repellendus aut ullam expedita officiis reprehenderit.', '[172,84,188]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(36, 9, 1, 'Voluptate earum non mollitia qui quo perferendis. Voluptas fugiat aliquid est. Distinctio rerum error debitis aut qui itaque. At similique eos voluptate eos nobis beatae sunt fuga. Consequatur explicabo ex nulla est numquam.', '[100,168,137]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(37, 29, 1, 'Reiciendis fugiat nulla repellat quis voluptates. Id saepe ducimus ipsam omnis sed nam nesciunt. Non officia eligendi veritatis adipisci iusto blanditiis nam.', '[84,32,35]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(38, 26, 18, 'Pariatur autem sit quia qui. Quae fugit asperiores repudiandae quaerat quam aut. Qui enim nisi quidem fuga excepturi iusto molestiae.', '[82,145,154]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(39, 38, 4, 'Hic autem voluptatem eos aspernatur cum et fugiat. Sint a est cum qui sequi error ab aut. Delectus atque sit unde quos consequuntur. Vel mollitia soluta delectus expedita sint voluptatem.', '[82,32,30]', '2020-06-24 02:00:25', '2020-06-24 02:00:25'),
(40, 23, 25, 'Pariatur deserunt adipisci ut repellendus. Hic optio deleniti dolorum voluptas ea animi. Voluptatem nihil doloremque incidunt quos dignissimos.', '[64,173,238]', '2020-06-24 02:00:26', '2020-06-24 02:00:26'),
(41, 49, 25, 'Illo officiis magnam vitae omnis vel cupiditate dolorum nostrum. Sint a consequatur occaecati velit id ipsa harum. Dolore asperiores officia dolorum nihil.', '[37,207,51]', '2020-06-24 02:00:26', '2020-06-24 02:00:26'),
(42, 27, 18, 'Natus eum explicabo placeat et dolore commodi. Eum eveniet perspiciatis veniam et. Deleniti repellat reprehenderit similique dicta. Recusandae quae modi voluptatum aut.', '[176,164,175]', '2020-06-24 02:00:26', '2020-06-24 02:00:26'),
(43, 15, 7, 'Aspernatur hic iusto et hic rerum. Aut voluptatem eum nam quod nisi eos. Deserunt ut cum ut aut et aut. Eos soluta non earum.', '[143,91,111]', '2020-06-24 02:00:26', '2020-06-24 02:00:26'),
(44, 25, 10, 'Dicta recusandae eos incidunt. Esse aut cupiditate ea. Explicabo cumque illum dolores soluta aperiam natus. Repudiandae necessitatibus sit qui sit aut illo.', '[64,151,98]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(45, 16, 4, 'Vero perferendis ut distinctio sunt. Sed vitae repellat ad quis quia ea. Perspiciatis consequatur quia itaque ut quia saepe. Corporis et et nihil ut sit dolor recusandae.', '[155,83,251]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(46, 43, 12, 'Quasi ut esse et explicabo id autem ut. Accusamus eos harum vitae quia voluptatem. Similique suscipit dolorum consequuntur ratione. Nobis excepturi quo voluptatem accusamus suscipit molestiae similique. Aut nulla et error alias animi.', '[30,1,187]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(47, 11, 9, 'Quia dolorem fugiat vel blanditiis deleniti nulla omnis. Qui quis placeat est cumque id et praesentium. Autem ipsa cumque consequatur molestias odio ut explicabo. Quo doloribus fugiat voluptatibus.', '[58,100,25]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(48, 28, 30, 'Illum optio consequatur reiciendis ipsa doloremque reprehenderit. Et qui consequatur magni ipsum. Eaque recusandae enim sunt qui sed est.', '[78,159,194]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(49, 49, 14, 'Explicabo maxime possimus nostrum velit impedit laudantium sed dolores. Voluptate earum exercitationem veniam et aut. Labore a itaque in nulla id voluptas repellendus. Corporis dolor deleniti nisi ducimus sint.', '[65,189,53]', '2020-06-24 02:00:27', '2020-06-24 02:00:27'),
(50, 37, 26, 'Architecto recusandae et aperiam temporibus facilis quis. Adipisci officiis qui natus id asperiores accusamus. Incidunt et laudantium dolores similique.', '[251,5,162]', '2020-06-24 02:00:27', '2020-06-24 02:00:27');

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

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`user_id`, `subject_type`, `subject_id`, `relation`, `relation_value`, `relation_type`, `created_at`) VALUES
(100, 'App\\User', 1, 'follow', NULL, NULL, '2020-06-24 02:16:21'),
(100, 'App\\User', 2, 'follow', NULL, NULL, '2020-06-24 02:16:21'),
(100, 'App\\User', 3, 'follow', NULL, NULL, '2020-06-24 02:16:21'),
(100, 'App\\User', 4, 'follow', NULL, NULL, '2020-06-24 02:16:21'),
(100, 'App\\User', 5, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 6, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 7, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 8, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 9, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 10, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 11, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 12, 'follow', NULL, NULL, '2020-06-24 02:16:22'),
(100, 'App\\User', 13, 'follow', NULL, NULL, '2020-06-24 02:16:23'),
(100, 'App\\User', 14, 'follow', NULL, NULL, '2020-06-24 02:16:23'),
(100, 'App\\User', 15, 'follow', NULL, NULL, '2020-06-24 02:16:23'),
(100, 'App\\User', 16, 'follow', NULL, NULL, '2020-06-24 02:16:23'),
(100, 'App\\User', 17, 'follow', NULL, NULL, '2020-06-24 02:16:24'),
(100, 'App\\User', 18, 'follow', NULL, NULL, '2020-06-24 02:16:24'),
(100, 'App\\User', 19, 'follow', NULL, NULL, '2020-06-24 02:16:24'),
(100, 'App\\User', 20, 'follow', NULL, NULL, '2020-06-24 02:16:24'),
(99, 'App\\User', 50, 'follow', NULL, NULL, '2020-06-24 23:54:04'),
(1, 'App\\Model\\Post\\Post', 1, 'like', NULL, NULL, '2020-07-01 23:13:48'),
(2, 'App\\Model\\Post\\Post', 1, 'like', NULL, NULL, '2020-07-01 23:16:18');

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
(10, '2020_06_24_162652_create_products_table', 2),
(14, '2020_07_01_111615_add_columns_to_users_table_one', 3),
(15, '2020_07_02_135633_create_admins_table', 4),
(16, '2020_07_03_101056_create_user_verification_details_table', 5),
(17, '2020_07_03_102923_create_user_verifications_table', 5);

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
(1, 2, 'Eos porro est assumenda voluptatibus voluptatem. Debitis minus eveniet ex perferendis. Accusamus aut necessitatibus quia magnam vel expedita.', '[168,53,52]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(2, 13, 'Placeat provident nam expedita cum tempora repellendus quis reprehenderit. Aut voluptate temporibus quas. Et maiores animi vitae fuga. Cumque odio impedit ratione. Doloribus quis velit sint est accusantium.', '[87,91,160]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(3, 12, 'Quae et eum autem cupiditate aperiam. Et et commodi libero perspiciatis in libero voluptatem. Autem ex quo ut blanditiis.', '[215,135,154]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(4, 3, 'Dolore culpa est mollitia. Quis quisquam blanditiis quis voluptas culpa voluptas dolores. Facilis necessitatibus corporis odio sint aut iusto saepe. Delectus accusamus excepturi maxime odit vitae quaerat quis.', '[144,164,98]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(5, 14, 'Quae qui veniam corporis rerum nihil ea. Et modi iusto sint animi beatae eaque tempora. Quis ut saepe porro ex et.', '[31,133,172]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(6, 2, 'In quam officiis velit dignissimos deleniti dolores dolores. Officia nostrum quia quidem voluptas dolor consectetur. Accusamus ab repellendus vel quae ut dolor quod.', '[49,118,69]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(7, 6, 'Sed officiis reiciendis dignissimos temporibus. Molestias eos consequatur sequi adipisci quibusdam similique eum quam. Qui et expedita dolorem voluptates doloribus cupiditate sequi. Consequatur voluptates ipsa fugit placeat ipsa error vel vel.', '[14,8,55]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(8, 18, 'Et omnis odit expedita sed quis non esse. Et repudiandae nesciunt eum sint ut. Officia reiciendis enim ea voluptatem. Quia perferendis vel quas.', '[24,212,232]', '2020-06-24 02:00:15', '2020-06-24 02:00:15'),
(9, 9, 'Magnam eveniet iure quis inventore voluptas tenetur labore sed. Deleniti enim rerum et saepe mollitia occaecati occaecati. Nemo aperiam doloremque in necessitatibus et aliquam. Accusantium tenetur blanditiis dignissimos.', '[83,250,108]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(10, 10, 'Nobis eligendi amet eius quia labore eligendi. Modi aut iusto ducimus commodi placeat. Quibusdam consectetur ad magnam qui quo fugit. Dignissimos aliquam ut distinctio rerum.', '[221,158,89]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(11, 20, 'Aut tempora reiciendis ab maxime neque ut. Adipisci dignissimos aut recusandae et molestias at. Cum ea quia nostrum reiciendis. Commodi et nesciunt pariatur deleniti.', '[6,146,156]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(12, 13, 'Et ad sed facilis maxime consequatur voluptas beatae. Non esse eligendi temporibus. Magnam nulla consequatur sed quasi. Voluptate voluptas ratione magni blanditiis numquam et. Voluptatem repellat sit tenetur aut.', '[196,96,234]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(13, 20, 'Iusto tempore voluptas dolorum distinctio ut qui qui. Repudiandae recusandae omnis ab quos eum voluptatem. Ut eos dicta occaecati occaecati aperiam perspiciatis sint.', '[77,66,180]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(14, 9, 'Tempora optio dolorem odit voluptas. Iste corporis rerum non veniam ut asperiores illum. Ut totam amet non nostrum nobis quisquam.', '[255,227,149]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(15, 2, 'Voluptatem blanditiis minima consequatur odio libero voluptas ipsa culpa. Ipsum ut eligendi nisi id exercitationem. Consequatur atque odio quidem.', '[104,69,69]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(16, 18, 'Culpa deleniti nostrum ullam consequatur nam molestiae rerum. Adipisci laboriosam architecto dolor. Autem ut voluptatem ut veritatis enim perferendis.', '[209,30,143]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(17, 10, 'Provident possimus aut praesentium vel. Consequuntur tempora facilis autem ex omnis sint. Aut est eligendi saepe officiis ullam ea. Doloremque vitae nesciunt sed rem tenetur. Atque et maxime corporis.', '[36,148,71]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(18, 2, 'Sunt sapiente velit modi consequuntur aliquam. Qui repellat quibusdam illo aspernatur assumenda et quibusdam. Dolores voluptatem dolores voluptatem beatae totam doloremque neque. Autem et reprehenderit dolor magni vel aut velit.', '[71,8,181]', '2020-06-24 02:00:16', '2020-06-24 02:00:16'),
(19, 15, 'Soluta tempore nobis tempora minus sit neque. Voluptatem illum consequatur voluptas aut laudantium sed. In nam molestias cum est ea quod officiis. Magni amet odio earum.', '[248,91,246]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(20, 9, 'Quis saepe minima unde dicta aut. Consequuntur sed incidunt enim qui nobis nemo aut. Hic mollitia quas hic reiciendis.', '[187,41,162]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(21, 17, 'Quas iure ipsam consequuntur cupiditate fuga rerum autem. Qui itaque accusantium molestias ea ut.', '[67,208,242]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(22, 8, 'Odio molestiae reprehenderit repudiandae facere aut aut. Consequuntur vel non maxime eius illum. Placeat non at saepe commodi et esse.', '[77,91,179]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(23, 9, 'Quod tenetur repellat quam sint necessitatibus. Quo reiciendis nihil ipsa facilis. Quam dolor et voluptas perspiciatis ut dignissimos. Magni mollitia amet facere voluptatem similique aspernatur. Deleniti saepe rerum cupiditate nulla dolores.', '[159,242,43]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(24, 7, 'Omnis vel deserunt quia. Distinctio et voluptatem molestiae qui praesentium beatae illum. Odit voluptas quisquam alias labore explicabo.', '[83,248,11]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(25, 11, 'Mollitia repellat esse numquam sunt cum numquam itaque velit. Quasi recusandae cum natus. Ut consequuntur explicabo laborum.', '[208,149,42]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(26, 8, 'Nostrum aut sint molestias qui deserunt. Corporis in suscipit minima distinctio voluptatem natus. Facere magnam sint magni omnis. Velit non adipisci error sint.', '[35,80,187]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(27, 12, 'Quasi et aut quia et aliquid asperiores ad. Nisi quas maxime asperiores vitae corporis cum alias.', '[28,100,209]', '2020-06-24 02:00:17', '2020-06-24 02:00:17'),
(28, 19, 'Consequatur soluta natus velit architecto iusto. Facilis molestiae est cupiditate voluptatem. Architecto et mollitia ad. Laboriosam corrupti voluptatum provident labore quia pariatur.', '[65,121,62]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(29, 3, 'Similique pariatur praesentium aut qui ut. Nulla debitis consequuntur id iusto laboriosam. Est est accusantium non et et quia possimus aut.', '[242,153,253]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(30, 6, 'Architecto vero delectus voluptatem. Fugiat sed beatae cumque quasi consectetur id quo libero. Ex laboriosam minima occaecati dicta amet.', '[28,16,4]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(31, 11, 'Maiores sit libero possimus eum quia. Vitae nemo beatae sit deleniti est earum culpa. Provident excepturi ut autem laboriosam dolores ut. Voluptas qui blanditiis aspernatur nam officia magnam.', '[192,189,55]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(32, 1, 'Ut autem eum unde animi nemo. Fugiat vero aperiam quam blanditiis recusandae qui error. Nemo illum deserunt sit ad explicabo magnam id. Ratione est eveniet dolor ratione. Perferendis ipsam dolor quaerat quibusdam et sed.', '[239,229,166]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(33, 19, 'Ut non dignissimos magnam similique impedit quam a et. Magni et sint dicta dignissimos quas iusto. Consequatur aut et architecto ipsam dolores asperiores nihil et.', '[101,104,146]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(34, 7, 'Esse voluptatem aspernatur sint voluptatum non reprehenderit. Aut et a distinctio officia qui voluptas expedita. Est vero saepe qui laboriosam omnis blanditiis.', '[118,57,39]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(35, 2, 'Quam voluptas corporis qui aliquam. Quae iure et et molestiae aspernatur beatae. Laudantium est ipsa sed nisi est laboriosam. Ea quod minima dolore nobis ea et eligendi praesentium.', '[248,49,195]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(36, 11, 'Autem aspernatur ducimus rerum nam soluta suscipit. Ullam quos est suscipit officia. Architecto iure sed molestiae praesentium eum. Veritatis dolorem et aut eligendi eos.', '[133,132,201]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(37, 11, 'Aut nisi neque nemo dicta illo. Ducimus et iste adipisci est saepe qui. Ea iure sed consequatur inventore. Eum iusto sunt et id dolores similique laboriosam sint. Amet at nostrum odio qui.', '[4,168,149]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(38, 7, 'Officiis minus sint sed debitis illum eum eos. Autem minus consequatur odio repudiandae. Facilis dignissimos debitis quia voluptatum ratione facilis distinctio. Ipsum deserunt dignissimos qui sint molestias recusandae saepe.', '[255,32,59]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(39, 3, 'Praesentium est perferendis omnis non. Omnis ipsam ab quidem et consectetur enim hic quo. Necessitatibus quo porro aliquid. Sed sed dolores nihil et.', '[229,52,243]', '2020-06-24 02:00:18', '2020-06-24 02:00:18'),
(40, 3, 'Nemo culpa ab blanditiis occaecati. Omnis sunt voluptas quidem sed. Provident qui et praesentium odio molestiae minima repellat libero. Quod consequatur dolor quia dolore non incidunt rem.', '[146,7,88]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(41, 17, 'Fugiat enim qui consequatur quae ipsa delectus cumque. Nam dolore mollitia qui blanditiis ex in. Eum reprehenderit nesciunt rerum id fugiat voluptatem.', '[63,177,19]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(42, 12, 'Aut aut distinctio exercitationem dolorum corrupti harum porro. Debitis quia nihil impedit.', '[125,122,7]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(43, 19, 'Et fugiat et dolorum eos. Nobis quaerat ut quos porro consequatur ipsum quia. Cupiditate dolorem veniam optio odio fugit voluptas omnis. Excepturi corporis deserunt illo et eos.', '[210,66,245]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(44, 17, 'Asperiores aut aut hic repellat. Ut repellendus magni excepturi soluta voluptas sed atque. Optio nesciunt qui ipsa explicabo qui rerum adipisci. Doloribus sint sed tempora consequatur et qui totam. Atque molestiae beatae dolor dolores et.', '[50,57,188]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(45, 15, 'Et est eius eos nostrum eos ut quas. Nisi qui soluta ipsam molestias error illum.', '[92,149,83]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(46, 8, 'Ut amet sit dolor dolorem officia qui qui. Illo et nam nisi architecto error culpa. Soluta ab doloremque autem doloribus exercitationem eligendi quia reprehenderit. Tenetur quaerat quis voluptatem.', '[190,205,180]', '2020-06-24 02:00:19', '2020-06-24 02:00:19'),
(47, 2, 'Laboriosam dolore libero cum aut. Voluptas nemo non ipsum qui.', '[254,111,130]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(48, 7, 'Architecto placeat et vel. Consequatur quo eius excepturi et vel magni. Voluptatem tempora impedit adipisci magnam ut ipsum. Consequatur eius consequatur voluptas eveniet.', '[234,76,138]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(49, 18, 'Eum labore aspernatur tempore vitae maxime quisquam. Deserunt voluptatem iusto dolor odit a. Quisquam laborum magni nam.', '[170,154,149]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(50, 3, 'Non aut sint quae excepturi. Debitis quo aliquid sed asperiores.', '[0,33,13]', '2020-06-24 02:00:20', '2020-06-24 02:00:20'),
(51, 19, 'Inventore autem dolorem vel vitae quod et enim rerum. Sed sed asperiores consequuntur fugiat labore quidem quae. Quam ex possimus repellendus atque ea unde.', '[30,46,218]', '2020-06-24 02:07:16', '2020-06-24 02:07:16'),
(52, 20, 'Maxime fugiat rem quaerat a animi eveniet incidunt. Non minus non sit voluptates. Corrupti nostrum maxime deserunt nulla ipsam maiores quod. Eligendi placeat ipsa eligendi quibusdam eos.', '[28,172,93]', '2020-06-24 02:07:16', '2020-06-24 02:07:16'),
(53, 12, 'Et expedita dignissimos vel eaque soluta autem. Mollitia ipsum aperiam autem enim accusamus molestiae vitae officia.', '[38,197,197]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(54, 20, 'Eius quis qui natus voluptate autem animi ut perferendis. Nisi voluptatem ut reprehenderit aspernatur. Nisi rem quaerat culpa vel quia voluptatum.', '[94,147,147]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(55, 1, 'Perferendis fuga hic aliquam. Ipsum laudantium voluptatem corporis rem aperiam. Eligendi error rerum ea qui sed pariatur labore eum. Ipsum provident ipsum tempora in quis ut nulla fugiat. Molestiae nulla minima voluptatem et laboriosam.', '[223,141,211]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(56, 19, 'Pariatur accusantium repellendus atque occaecati officiis libero. Hic temporibus et placeat. Eveniet qui esse ducimus molestiae commodi. Autem modi molestiae nisi nam aliquid.', '[164,214,207]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(57, 16, 'Repellat voluptate est maxime molestiae in porro. Voluptatum voluptatum error distinctio totam laudantium aliquam. Illo qui veritatis sed eveniet ut.', '[209,71,117]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(58, 10, 'Atque eaque doloribus optio eum a unde laborum. Voluptatum quidem eum sunt enim dignissimos. Et quia asperiores quae explicabo esse ut. Quibusdam et qui aliquam aut.', '[67,116,73]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(59, 13, 'Totam temporibus porro asperiores architecto ipsa rerum iste. Perferendis earum rerum laboriosam numquam. Et et laborum tempora provident libero in.', '[135,2,91]', '2020-06-24 02:07:17', '2020-06-24 02:07:17'),
(60, 9, 'Non ut aut nulla rerum consequatur. Laudantium dolorum porro et minima nihil. Nesciunt ut sed quis. Neque aut nisi repudiandae animi ipsam et.', '[227,197,202]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(61, 6, 'Nesciunt consequatur est molestias et voluptatem eos. Nam et et necessitatibus et omnis doloremque. Earum enim deserunt eos sint in a. Non asperiores iure dolore aliquam.', '[227,139,61]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(62, 7, 'Nisi ut tempore quo et facilis beatae. Et occaecati qui dolore consectetur. Porro saepe magnam cupiditate fugiat exercitationem ipsam aut voluptas. Ad aut ut totam porro.', '[118,121,168]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(63, 7, 'Sunt qui porro voluptas consequatur. Id placeat possimus et. Ex quae voluptatem maiores. Pariatur ut ea velit tenetur id sit officia.', '[247,223,109]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(64, 18, 'Quia ea laborum soluta non ad et reiciendis. Eos laboriosam ratione rerum fuga. Modi minima dolorem dolores blanditiis sed. Ut deleniti quisquam aspernatur maxime. Temporibus dolorem natus voluptas et.', '[209,120,180]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(65, 12, 'Ut officia laboriosam et est nostrum dolorem perspiciatis. Ut consequuntur aut aut et sapiente. Voluptatem sed et reprehenderit magnam laudantium. Accusamus consequuntur labore aut sit dolores rerum.', '[117,54,212]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(66, 2, 'Est aspernatur ut temporibus impedit. Neque voluptate odio quas excepturi.', '[13,61,165]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(67, 9, 'Voluptatibus et consequatur quos occaecati ut. Nisi vel pariatur et non architecto. Dolorem repudiandae sit placeat est ducimus error.', '[191,163,196]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(68, 4, 'Unde id dolorem est earum repellat itaque aut. Consequatur distinctio ut et. Ratione occaecati hic accusantium consequuntur.', '[76,47,38]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(69, 15, 'Illo dolorum recusandae vel qui. Dolorem iste harum amet. Consequatur deserunt ut in odio occaecati consequatur natus. Id consequatur aspernatur esse dolor dolorum sint.', '[185,192,26]', '2020-06-24 02:07:18', '2020-06-24 02:07:18'),
(70, 15, 'Explicabo veniam labore eaque temporibus consequuntur atque. Laboriosam praesentium a eos vitae quia expedita totam. Blanditiis nobis voluptas autem est ut voluptate. Odio et occaecati fuga temporibus pariatur. Dolorem inventore molestias ut quod laboriosam laudantium aut.', '[226,184,115]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(71, 13, 'Qui quae nihil nobis deleniti. Veritatis ea voluptatum consectetur quas ducimus commodi cumque. Voluptas modi ipsum rerum commodi consequuntur doloribus officia.', '[172,55,16]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(72, 13, 'Doloribus fuga quas in voluptas quis fugiat ut. Reprehenderit nam ab mollitia omnis ipsum asperiores sed. Blanditiis possimus tempore excepturi accusantium excepturi assumenda et est. Omnis unde dolores aut adipisci aliquid saepe sunt.', '[42,131,194]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(73, 8, 'Voluptatem ex tempore sunt vero explicabo. Tempore laboriosam et amet et reiciendis aspernatur accusamus. Laudantium fuga id labore ad. Facere hic dicta vero.', '[94,70,230]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(74, 1, 'Fugit quaerat assumenda voluptas commodi rerum qui. Aut velit aut occaecati corporis maiores. Delectus sit iure praesentium aut ullam in. Et eligendi reprehenderit voluptas sit natus deserunt vero.', '[97,254,115]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(75, 4, 'Molestias natus quos cum soluta at sint. Odio dolor molestiae et autem. Quos tempora sunt non iure et ad consectetur. Earum et distinctio non deserunt.', '[41,23,169]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(76, 15, 'Voluptatem veniam sint magni enim quis nihil repellat. Consequuntur dolores neque et aut. Et et et in excepturi rerum consequatur atque. Incidunt sed sed quo rerum et.', '[120,92,119]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(77, 17, 'Ex quod architecto occaecati rerum. In reiciendis tenetur eum. Nihil quia tempora ratione nesciunt nisi voluptatem sit.', '[12,93,244]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(78, 15, 'Ea aliquid et suscipit ut exercitationem. In est voluptatem nesciunt rerum ipsam sit sit cum. Autem nostrum vel ducimus rem et. Dicta reprehenderit saepe sunt. Veritatis voluptatem nesciunt libero id adipisci.', '[61,229,171]', '2020-06-24 02:07:19', '2020-06-24 02:07:19'),
(79, 6, 'Non doloribus consequuntur voluptatibus deleniti. Ex ratione eaque omnis illum soluta sint. Dolor architecto occaecati ut rerum natus. Aut voluptatem doloremque doloribus vero.', '[117,148,242]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(80, 1, 'Molestiae non est molestias odio explicabo. Consequatur ea et voluptate et aut facilis. Voluptatem voluptatem qui voluptates rerum qui porro. Quasi accusamus labore commodi laborum dolorem sit.', '[197,253,114]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(81, 7, 'Saepe occaecati rerum rem non possimus. Sed maxime deserunt aut. Consequuntur facere ex et ipsum expedita eveniet sit expedita.', '[244,203,133]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(82, 12, 'In accusantium ut sunt sint a tempora nam aut. Nulla omnis velit nostrum vero earum. Quos eveniet praesentium aperiam maxime aut facilis excepturi vitae. Reprehenderit qui labore reprehenderit sint magni dolore quam.', '[7,170,115]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(83, 4, 'Voluptas iste non porro quia minima. Delectus ut minus impedit a voluptatibus rerum. Sit aut ea et delectus vitae provident cupiditate repellat. Molestiae corporis dolorum aspernatur et.', '[3,133,181]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(84, 15, 'Dolores dolor reprehenderit distinctio vitae nisi ipsa sequi. Numquam error quia natus odio ea. Est praesentium hic vero enim.', '[219,28,28]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(85, 12, 'At omnis a saepe aut similique sequi veritatis. Ea aut explicabo est ratione. Rerum sint dolor sit numquam sunt. Velit aut nisi dolorem ut quis.', '[13,240,106]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(86, 14, 'Aliquam unde enim sunt omnis voluptatibus est quis. Et sit sit error inventore. Modi sit delectus enim accusantium excepturi ipsa. Provident eligendi dolor quasi ipsum autem et omnis.', '[70,75,90]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(87, 5, 'Provident aut repudiandae eum expedita sed. Consequatur aut ut corrupti cumque. Corporis voluptatem magni temporibus est. Ipsum dolor animi molestias non distinctio quaerat. Minima tempora odio tenetur minima.', '[246,82,108]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(88, 11, 'Asperiores excepturi iure repellendus sunt consequatur velit. Nostrum voluptas non quasi beatae. Molestiae in dolor ut veritatis quisquam.', '[175,252,48]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(89, 6, 'Eaque in blanditiis quo blanditiis. Amet velit omnis quos non labore quia. Quaerat velit aperiam quibusdam aut soluta. Magni assumenda nemo voluptatum atque. Iste doloribus quisquam sunt neque placeat.', '[148,70,146]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(90, 20, 'Sed animi ipsum cupiditate velit sed. Optio molestias ipsa sed qui maxime. Sed a quia itaque inventore velit et eaque quia. Ea natus voluptatem non qui accusantium doloremque quia. Aut voluptatem esse temporibus.', '[215,111,44]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(91, 19, 'Impedit unde tempora id nisi eos sint. Suscipit optio animi nam aut sit. Placeat qui sunt recusandae recusandae beatae officia autem.', '[246,194,74]', '2020-06-24 02:07:20', '2020-06-24 02:07:20'),
(92, 13, 'Natus repellat ullam et nulla eum commodi ab rerum. Sed laudantium fugit id cumque.', '[231,81,162]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(93, 2, 'Asperiores odio sunt rerum. Et inventore et ipsa repellendus corrupti nostrum. Itaque quo sed est doloribus iure voluptatem non.', '[139,147,109]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(94, 6, 'Labore cum maiores id et neque ratione. Ut nisi quis eos aspernatur nihil. Sit odit reiciendis saepe rem. Ducimus et voluptatum at.', '[217,73,249]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(95, 2, 'Esse aut et porro fugit suscipit. Earum sed sequi est facilis nesciunt dolorem. Incidunt quo tenetur consectetur harum ullam aut. Temporibus et est quis ipsa aliquam aut quis. Quia id itaque quia numquam nulla.', '[123,175,118]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(96, 8, 'Dolore illum dolores ab nemo rerum voluptas. Veritatis voluptatibus dolor beatae vitae voluptatem vel. Illo dolorem perferendis et veniam deleniti aut eos et. Et animi totam id voluptatem.', '[16,147,175]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(97, 6, 'Quis quaerat non ipsa ut id quo nihil. Dolorem labore et ea necessitatibus facere qui. Commodi sit sapiente atque quos. Quia voluptatem eum optio eos cumque ad.', '[119,41,72]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(98, 15, 'Eveniet sed debitis laboriosam in. Qui maxime harum ea vero occaecati at. Tempore quo consectetur occaecati consequatur recusandae magnam eos corrupti. Laudantium dicta qui eligendi.', '[59,106,236]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(99, 8, 'Laudantium eius animi commodi molestiae voluptatem. Officia accusamus reiciendis unde. Recusandae ut eligendi voluptates eum ex et placeat quisquam.', '[238,2,151]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(100, 12, 'Animi maiores cupiditate nemo. Nobis asperiores exercitationem ratione. Perspiciatis odit dignissimos voluptatem. Inventore dolor quo repudiandae minus.', '[182,139,145]', '2020-06-24 02:07:21', '2020-06-24 02:07:21'),
(101, 17, 'this is some text', '[172,55,16]', '2020-06-24 17:13:40', '2020-06-24 17:13:40');

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

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Enormous Steel Bottle', 'Itaque accusantium nihil necessitatibus nobis. Quos illum deleniti fugiat dicta occaecati accusamus aut. Nesciunt mollitia exercitationem molestias vitae ipsum unde rerum ipsa. Minus accusantium quo aliquam molestiae voluptas expedita qui.', 6955, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(2, 'Incredible Plastic Chair', 'Nemo maiores quidem eum omnis recusandae. Nam maxime dolor voluptate. Blanditiis nisi veritatis esse asperiores in magnam. Occaecati quo accusantium ut asperiores.', 2267, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(3, 'Rustic Concrete Keyboard', 'Est assumenda dolores amet hic nihil. Dolor reprehenderit reprehenderit est dignissimos fugit. Consequatur facilis voluptas minus consequatur rerum error.', 4376, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(4, 'Fantastic Copper Computer', 'Architecto ex molestias qui voluptatibus vel qui unde. Consequatur voluptatem omnis rerum est minus tenetur magnam.', 1998, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(5, 'Fantastic Marble Shirt', 'Sint corrupti deleniti eos non ut. Et eligendi ut eum nisi magnam et. Magnam expedita sequi consequatur culpa facilis minus. Minima tenetur est consectetur repudiandae nobis. Aut dolorem cupiditate animi quia velit voluptatem.', 7904, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(6, 'Lightweight Iron Hat', 'Voluptatem voluptate temporibus eveniet natus. Rerum modi unde fugiat ullam numquam. Cupiditate id ut sed dolore explicabo.', 711, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(7, 'Rustic Linen Hat', 'Omnis nisi et cum aperiam. Soluta non quidem soluta maxime omnis ut consectetur. Nulla et quia quis eaque incidunt. Quidem consequatur libero minima praesentium voluptatem maxime.', 8987, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(8, 'Durable Copper Keyboard', 'Dolorem enim nostrum quibusdam neque qui non veritatis. Aut distinctio error voluptate molestias ex distinctio odit. Necessitatibus sint tempore quam est eaque quidem ut.', 8852, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(9, 'Aerodynamic Aluminum Lamp', 'Omnis facere quas sit expedita natus quam eum. Id inventore molestias vitae ut sed omnis quos dicta. Qui ipsum voluptatem libero ut. Aut tenetur maiores quisquam nisi mollitia numquam.', 1750, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(10, 'Rustic Aluminum Watch', 'Voluptas doloribus quia et maxime cumque. Ea voluptatibus veniam corporis itaque facilis corrupti. Quo et reprehenderit doloribus porro voluptas dolorum amet.', 3884, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(11, 'Synergistic Steel Keyboard', 'Soluta dicta qui reprehenderit. Ratione ratione ut hic atque et qui. Modi asperiores voluptates dignissimos culpa quis.', 3299, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(12, 'Practical Marble Pants', 'Voluptatum iure explicabo nobis sed enim sequi. Id id distinctio non nesciunt et inventore et. Velit quis aperiam illo aliquam deserunt omnis ut. Eligendi pariatur ut enim qui laudantium.', 7596, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(13, 'Enormous Marble Gloves', 'Iusto minus optio perspiciatis enim voluptatem placeat quo. Quibusdam ullam repudiandae aut sint sunt perspiciatis doloremque nisi. Id eveniet nemo rem voluptates. Sapiente esse fuga ipsa ipsum quis. Deserunt ipsam accusamus vel soluta qui asperiores maxime.', 6354, 'product', '2020-06-24 23:46:04', '2020-06-24 23:46:04'),
(14, 'Sleek Iron Bench', 'Excepturi quidem sit qui incidunt et aspernatur in. Error quisquam minima ea. Corporis minima aut rem minima. Velit doloribus officia recusandae ipsum deleniti quam.', 9274, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(15, 'Lightweight Linen Hat', 'Ducimus neque in inventore aut. Consequatur et mollitia ad dolores rem aut. Reiciendis sequi nulla non qui reprehenderit quisquam fugiat.', 1006, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(16, 'Aerodynamic Plastic Clock', 'Ducimus non dolore eaque ipsam accusantium perferendis qui. Aut consequuntur dignissimos illo ullam dolores quos. Qui molestiae quidem quis qui beatae. Fugiat ut voluptatem repellendus dolore enim ut.', 6489, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(17, 'Lightweight Steel Table', 'Fugit temporibus architecto unde. Temporibus optio commodi delectus illum voluptatem recusandae. Quaerat nesciunt inventore quisquam ipsum eum ex maxime.', 6119, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(18, 'Lightweight Granite Keyboard', 'Debitis culpa id adipisci asperiores saepe dolor cupiditate. Maiores libero iure omnis optio. Similique et quia quia voluptas nesciunt recusandae. Fugiat aut ipsam ad.', 2600, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(19, 'Gorgeous Leather Clock', 'Ea rerum ut omnis ipsam vero pariatur numquam. Debitis aperiam quod temporibus est vero. Molestiae dolores odio ut sunt fugit aliquid.', 1979, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05'),
(20, 'Lightweight Wooden Watch', 'Cumque dolor totam id ut eligendi nihil dolor dicta. Excepturi corrupti dignissimos quia voluptate. Impedit pariatur voluptatum sunt. Eligendi voluptas quas facere cumque. Ea quis labore quibusdam et voluptates porro facere.', 7545, 'product', '2020-06-24 23:46:05', '2020-06-24 23:46:05');

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

INSERT INTO `users` (`id`, `phone`, `uuid`, `fuuid`, `verified`, `name`, `gender`, `profile_pic`, `cover_pic`, `hometown`, `lives_in`, `religion`, `birthday`, `occupation`, `nick_name`, `balance`, `referred_by`, `referral_id`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '9009264640891', '5bc1be7f-56bc-45f1-8a92-03c495be9ecd', 'af0d71a5-96ee-4ab9-b5c0-26fb13ff15c0', 0, 'Prof. Kaci Ortiz III', NULL, NULL, NULL, NULL, NULL, NULL, '1994-06-10', NULL, 'new nickname', 0, NULL, '2020624xgk', 'normal', 'mertz.ervin@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YJWjCv1DWM', '2020-06-24 02:00:05', '2020-07-01 06:07:17'),
(2, '01677309766', 'ee1799e6-10b9-475e-b76f-f09a3cc14e0d', 'ce5aabf7-7719-4b78-b59a-e559479a1289', 0, 'Kathlyn Hilpert Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624uuz', 'normal', 'dach.isabella@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fussp8GaUqm2j4sOXEie755S7UMOWdAiPpDQhbyJMJZvCGHfjnen3rBQ2na4', '2020-06-24 02:00:05', '2020-06-24 02:00:05'),
(3, '9002407532152', '3066957d-2e02-4b69-9888-8a4caec5b39c', 'b93aa286-4dae-471c-84c4-029d9de1a24e', 0, 'Miss Carolanne Macejkovic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624ndh', 'normal', 'aliya97@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Slrje17obo', '2020-06-24 02:00:05', '2020-06-24 02:00:05'),
(4, '2166825210485', '37ac88bf-040c-4bac-9a64-a451a8cd68ce', '440ab612-56ac-44d7-b305-f120f1790dd6', 0, 'Dr. Earline Hoeger II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624EBc', 'normal', 'liam.trantow@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BfGslAR8CW', '2020-06-24 02:00:05', '2020-06-24 02:00:05'),
(5, '5392730497057', 'a9778fff-1af9-4eb6-9059-4e5514b0bab6', '3953e303-af02-473a-acec-7cf8b6df78bc', 0, 'Mr. Wendell Koepp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624u4M', 'normal', 'bergnaum.theresia@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AVb2tkq8Ej', '2020-06-24 02:00:05', '2020-06-24 02:00:05'),
(6, '9537697757410', '98ce47b1-9174-4d66-8312-f971f7ed5050', '5bd1d750-fd6c-4dc6-9dfd-d27e4c3f2686', 0, 'Kaylee Ullrich', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624guQ', 'normal', 'haley68@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lELg9XY4cB', '2020-06-24 02:00:05', '2020-06-24 02:00:05'),
(7, '7727403172789', '5bdf3999-f7fb-4960-84d6-84e1307cad6d', '6cecbbdc-728e-4b46-8cc2-002ab6be13fd', 0, 'Miss Maymie Rolfson Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624FI5', 'normal', 'shyanne.becker@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wuZASr3kSv', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(8, '7923903672036', '93f421f7-0a0c-40e7-bdd7-2823e9b76b1c', 'c80ea59b-f1d3-4946-aa74-9cc65327721d', 0, 'Kaleigh Bergstrom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624amt', 'normal', 'lynch.darlene@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'heDCERzEta', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(9, '7778955563455', 'e35dfd98-4dd4-4f6d-9667-3097f7eb0181', '825cb307-d615-4923-93bb-ed35a6a921df', 0, 'Wiley Abernathy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241RL', 'normal', 'stephanie74@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F6AdPVi4KE', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(10, '+2543377937552', 'e6675dde-4a2f-4880-aaa0-c9db2018df80', '9bf56485-bb6e-4f61-a5bc-68818dd55dcb', 0, 'Trenton Shields', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624RpL', 'normal', 'iharris@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3SHiYlFFnG', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(11, '+1458889761425', '3620782b-595a-4c4a-82af-6c750133e9c6', '2be87c35-2cd8-490c-a817-877668952d50', 0, 'Richard Kovacek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Kwn', 'normal', 'elangosh@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6XyU1Z4ziw', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(12, '+3967611463920', '8ec459e9-0692-452d-bf36-2bad7666bbf5', 'b0c9e3e0-5bbc-4de9-a210-b0b002b2be60', 0, 'Ola Purdy DDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244BP', 'normal', 'greenholt.abraham@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'f7HMNeTvUT', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(13, '+3041064373740', 'f300cf68-643d-484e-993e-8b646241caa4', 'aa35962e-bb02-42dc-81a0-40304f1080f0', 0, 'Zack Mraz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624K53', 'normal', 'ashlynn.gibson@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XxKl25AWO1', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(14, '+3171050695942', 'c3b14c64-cdca-4fa4-8b87-fdba64740ac8', '503aa880-a8ee-45f2-9580-9cee90479128', 0, 'Rahul Bechtelar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241kM', 'normal', 'vgulgowski@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ODEDgstXhB', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(15, '+7277548844099', '5a6e86cc-67b3-4d3d-b343-152869bac12b', '7096d665-3a11-4950-a4b3-e57fc832eae5', 0, 'Dr. Colin Hickle', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624qnU', 'normal', 'pouros.elise@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'JydhiAcTJh', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(16, '+6906080288905', 'aefe3c93-ab52-426b-9200-a87e19dc097b', '49dd5a77-0e44-4ea6-b98b-feb204458b1d', 0, 'Tate Gorczany', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624lYY', 'normal', 'effie79@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rN7I1u5XxE', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(17, '+9071664269870', '54f2b00e-c32a-421a-959a-57e07e511f42', '46a1975c-d553-4b1a-b158-8062caeb7c03', 0, 'Lenna Blick DVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624I6L', 'normal', 'maureen15@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BYuflCBC46', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(18, '+2343139777333', '0018ec1c-6a68-469c-ba1f-17e7561bd196', 'e534bba8-c3eb-40b6-b4ca-b6cc206c1eac', 0, 'Linda Frami III', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624seS', 'normal', 'jessica.vandervort@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rBAONg0rAg', '2020-06-24 02:00:06', '2020-06-24 02:00:06'),
(19, '+1369727796690', '37250728-7b2c-40df-bd6c-b10822c88e5d', 'f1025093-90fb-4d88-b740-c04422578e5d', 0, 'Dr. Freddie Gerhold MD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624YnS', 'normal', 'verona03@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '83ox7WJzC6', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(20, '+7709517820119', 'd290add3-3e1c-40b9-8c14-b4a791fb1925', '9f627ef1-a734-4e8a-bed5-94d01a390a68', 0, 'Prof. Margarita Gaylord I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Y4y', 'normal', 'qkshlerin@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8FX4Phb2Ma', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(21, '+9257933600809', 'e54d96c7-2ab4-434e-9b1f-5d2a8d468946', '11e3f63f-b543-497c-bce2-a9f5d39046a8', 0, 'Mr. Taylor Becker II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624gND', 'normal', 'jones.jaeden@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rlztvmns2G', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(22, '+1014237673199', 'c3452b4d-e6aa-4a1e-a1d0-bc56d87018e4', '635b2549-2942-4e72-aa0f-567e2e21d771', 0, 'Flo Lockman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244zZ', 'normal', 'west.filiberto@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2sDO8gRTdB', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(23, '+7453071242431', '97a095c3-f935-4d74-8f58-119511b2e5c2', '2d9f81ae-3dde-4724-b0f9-f59072db9aae', 0, 'Ms. Aurelia Hammes Jr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624kKF', 'normal', 'fromaguera@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MQC3UsZ9br', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(24, '+1117344696133', '142fee40-df53-4e44-8fdd-1430421ced65', '2ef0dff5-3974-45a1-a01f-f2263be447bf', 0, 'Miss Angie O\'Reilly V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624nC4', 'normal', 'josiah10@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YuqcgWwbTG', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(25, '+2732856112085', 'f7f48bfe-4bbb-4204-8684-94957f07e240', 'd41013fc-cb35-4cff-a5a2-6c6563bab525', 0, 'Tavares Morissette III', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624wJU', 'normal', 'eswift@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 's6qfWOKbtT', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(26, '+2951817580774', '9f2707bc-afbe-4001-a1ae-f62fa539091a', '4aaec5fb-73c7-4394-ba4f-8b2258e82869', 0, 'Dr. Rickey Padberg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241Nc', 'normal', 'schuppe.aglae@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1kx1Q897iO', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(27, '+8438432073643', '9655a2dc-807e-4987-8ae6-015576edee18', 'd74d1ca2-359b-4036-900c-4f8923197604', 0, 'Darlene Wisozk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624QtJ', 'normal', 'mueller.aniyah@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'W3O4930HG7', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(28, '+2532783544758', '9298c916-4115-4572-b8ee-2b211ededf58', '1e7d9c5c-6f7a-47e2-812a-2998f410598d', 0, 'Rodolfo Frami DVM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206240Wp', 'normal', 'camylle36@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gRdwXKJiND', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(29, '+9046860645035', 'fc46f4c7-2a7c-4a1f-819e-08ce26e06e4e', '55f56d09-4d04-4256-a1bf-5ecbf98ee1fc', 0, 'Alta Steuber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Q3H', 'normal', 'yolanda.fay@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZQsYoYLlE1', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(30, '+1131353519005', '7fcd1f05-1fc3-4756-9941-57e93dd084ee', '64af0922-1d79-4f4c-8dab-37e468d86fcb', 0, 'Mr. Richmond Schulist III', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624rml', 'normal', 'hmills@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'eiXW4NWIOp', '2020-06-24 02:00:07', '2020-06-24 02:00:07'),
(31, '+8897123223097', 'bb23b952-95e9-4c32-a92a-828f7ce0c4e1', '9a7d4a5b-8a11-4d61-acc7-5afc4eab0dfe', 0, 'Julia Corkery I', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624dW6', 'normal', 'elwyn06@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UJ4TOr8Tq6', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(32, '+3978330991584', 'd294936b-832d-436f-b010-94b9084e380a', 'd6051074-8aa8-49fa-9d07-55a73032bf38', 0, 'Anibal Mills', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624x0W', 'normal', 'qblick@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PNpL3FSCCx', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(33, '+1543109826882', 'de2fb3dd-7b44-4470-b671-41ad4de7fcdc', '13d642d6-566d-46f8-b2d5-feba0fbc0b91', 0, 'Erling Aufderhar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624hGV', 'normal', 'bette45@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vny0jGIGyD', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(34, '+1959140326433', 'af9bc484-4cea-41dc-beb5-c7a0e092892f', '477ccd39-f3a1-4e9c-b172-f12b42baebd7', 0, 'Nickolas Brekke IV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624xXl', 'normal', 'fay.irwin@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rLmy2egFI6', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(35, '+2646049162790', '1e4f0e9b-87a3-4f49-8921-a5e054298438', 'bdce42be-cd7d-492e-a68c-1cc2a2cc7958', 0, 'Linda Pacocha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624TXr', 'normal', 'haag.shaniya@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'o6UcAH75BV', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(36, '+9862697789611', '7a3e07d9-2361-4ab8-94a9-747487003f04', '6cd2610d-90be-447f-8285-53c7e9562467', 0, 'Zola Bogisich', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624JBn', 'normal', 'pdooley@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ji9iOt3tdK', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(37, '+2174109626097', '106b3014-2b1d-4b47-af57-25b9cc3508cb', '6daf2fe6-b816-419b-9df9-d7f5cc460de8', 0, 'Rahul Satterfield', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624GKy', 'normal', 'koelpin.rosamond@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QOJiXP1uao', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(38, '+1346730633607', '3e2e2250-237f-4eaa-b18e-2a4d8c209f23', '13ab55f0-2a18-4b58-940c-48c3ef6dd5d9', 0, 'Antonina Kuvalis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624z83', 'normal', 'jarvis10@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SA0Ju07CBH', '2020-06-24 02:00:08', '2020-06-24 02:00:08'),
(39, '+9194797393196', 'fb371b20-6cca-4ae4-8192-7d6e76023ba3', 'b27fd663-e89c-4aba-a7a7-4683b65ff466', 0, 'Prof. Akeem Toy Jr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206240Ua', 'normal', 'sfritsch@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lojQmYSqLO', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(40, '+7436838053796', '2274f0b7-0cca-413e-913c-b6e81a557a06', '3be9a3e9-29d3-4182-9701-bb8810bd99af', 0, 'Jaylon Cremin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624YjI', 'normal', 'shaylee.cole@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M7x1cFdIFz', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(41, '+5886863369154', 'cb795cd5-812e-4c82-9352-821e73000738', 'e1276ab7-36fd-4ad1-878e-5ab9d1ddf1a8', 0, 'Prof. Riley Wolff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244KU', 'normal', 'dawn14@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 't3LpjA0hes', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(42, '+3373263563723', '5ea15d46-f57e-4ab5-b168-80182bee5032', 'f93cf1ea-90af-46de-90c9-f551fdefaff0', 0, 'Raul Pagac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624MGK', 'normal', 'weber.olin@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aLk3tB0JS6', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(43, '+8524044771910', '80371655-9754-4d37-973d-644bdf76bb28', '30714797-99ac-47c8-bc6d-e5ed71168ab5', 0, 'Dr. Casimir Feest', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624n38', 'normal', 'noelia45@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '70EziqKkmC', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(44, '+9108425748660', 'df0cb8db-703f-45e5-b8ca-1a8dba8d2ab3', '670ed229-ef30-4096-9ac9-cc6490f4535d', 0, 'Prof. Aurelio Kub II', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244ie', 'normal', 'armani.kulas@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xetf2iDIUo', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(45, '+6492260910308', '2593d7ab-b6db-4bc4-a7ea-a8be18bf6b12', 'c85c2bce-89fc-4744-8183-b2397505f389', 0, 'Nicholaus Hahn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206242Qg', 'normal', 'gracie95@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ElGGF7KNt7', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(46, '+2309886411768', '06b194d8-ecc2-4585-952d-8d81302e3e61', 'a30b9f8c-a435-4b97-9094-22b5134b5314', 0, 'Sunny Kautzer Jr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244b9', 'normal', 'iolson@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jyp7gHN2Bu', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(47, '+9802465551196', '50259d18-c360-4ae2-86af-50d63ee2e57a', 'a2bd7341-11f7-4079-8a0f-04d01f8f26bd', 0, 'Cameron Monahan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Rya', 'normal', 'ahmad.bogisich@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lxuV8jJOTF', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(48, '+7211342723502', 'c58bc74f-028b-4b44-9103-93c6e0624531', '00a4e5d6-78c7-473b-9c69-3ffecf9a4bb0', 0, 'Hazel Little', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206246QO', 'normal', 'rferry@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6cxwQgW7aZ', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(49, '+6585100047133', 'bb861543-30b2-45ee-835e-5180b8c5c3f3', '78820b41-b077-49cc-b723-b6ee700dafe8', 0, 'Suzanne Rice', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624bZu', 'normal', 'emard.shanon@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rEULqlD5vd', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(50, '+3468885939020', '11b5dbc8-bfa0-4773-a23e-0d3f0149a1b5', '90ccd2ca-380a-4ffe-b031-51840e8edd6e', 0, 'Mrs. Lauretta Bashirian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624y10', 'normal', 'baumbach.robyn@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'x0L0vkcUVN', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(51, '+8868746966161', '102bf36c-48a6-4a50-a6a5-70414b7df03f', 'a6d04971-70c8-4647-b425-76cc905caa69', 0, 'Neva Mraz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206248G6', 'normal', 'stracke.osvaldo@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zi9XMRlLLx', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(52, '+3874041673966', '464ef466-25e5-4d14-b1c0-eafae8fbbbc4', '5b322016-4dd1-4e8c-931e-10ec7c5bd960', 0, 'Brannon Johnston', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624mIp', 'normal', 'gregory06@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2dzF0YMUwh', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(53, '+5596091905713', '6b1499ff-15cb-44a8-aff8-37cf7a725704', '851d559f-791a-4548-a6ee-00c0489f2b55', 0, 'Edison Gleason', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Fb5', 'normal', 'shaniya07@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QoggRYZdZW', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(54, '+6290559001562', '0f56abed-8755-40f6-837d-865276459bf0', '3278875e-8fa8-4112-bab8-27a07e8a29e1', 0, 'Dr. Nicolas White', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624FBV', 'normal', 'orval64@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rT3SEdh0GQ', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(55, '+9981436900732', 'f722e846-c043-49aa-ab97-eb8668911305', 'f44a5e52-0e0c-4c14-bc59-bc74624ffc52', 0, 'Zoie Boehm IV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624tiV', 'normal', 'addison.fritsch@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Xsm6mZRAMO', '2020-06-24 02:00:09', '2020-06-24 02:00:09'),
(56, '+4720291582800', 'c790bad4-9254-43ec-b6f1-22b2fa6f7f1d', '62ec7165-b638-4e95-816a-28cbb0f37fcc', 0, 'Dr. Xavier Hill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241Or', 'normal', 'dwaelchi@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wcsDGc24Td', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(57, '+2864140945575', 'bdc489f3-cabf-4c5a-be49-b7f3e76c259c', 'a371313c-cf73-458f-a6ef-d34ad958db07', 0, 'Jacquelyn Maggio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206244Fq', 'normal', 'isabel05@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZuShvO0pKG', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(58, '+8149884443805', 'cb9c4d7f-21fa-48a1-b27e-ff7963c9bacb', 'd94485ee-f351-4b3b-9179-4416812122ce', 0, 'Dr. Reuben Franecki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624XaY', 'normal', 'emmerich.roxane@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zuwFTmcwr2', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(59, '+4582367546533', 'bd73690c-cc42-402c-91fd-cad1d0d4055d', 'eb2a0498-2899-4958-a987-bf56dee022e4', 0, 'Dr. Ewell Steuber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624TA2', 'normal', 'king.wayne@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kGducuz0d2', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(60, '+9610830639367', '77a2cf5d-1a89-4c93-a68d-0d4d06d61f8a', '1499d3df-21ad-4fbc-9f52-04507b43f794', 0, 'Alessandra Huels', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624LW1', 'normal', 'nettie.schmidt@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'h7BJQql0Q2', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(61, '+9442208041293', 'c68a3569-8492-4774-98d2-87770220e01b', 'c05f8c02-d1c8-4dc7-a74c-c79240a7d080', 0, 'Kristian Schiller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624N6Z', 'normal', 'antonio86@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '54a8K2hQ6h', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(62, '+8134662081267', '6f3709fa-dfe7-4288-93f5-58def9ecd82d', 'ed74f180-eb4b-40d2-9874-2603443a22a7', 0, 'Miss Georgiana Bruen PhD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624C39', 'normal', 'lrice@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0L8Yz8GrB6', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(63, '+5813293313163', '93ca20d5-5668-40dd-8ee9-74b39404ac92', '874906dd-6180-479d-bf60-970306c30ad7', 0, 'Dr. Myriam Blanda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624IbC', 'normal', 'magnus.blick@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DReUQDSYvp', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(64, '+4776539994639', '980f8255-9819-49f5-a8ff-77ce69e8b8c3', 'da439f79-b493-4f9e-8751-ad4d00ef447b', 0, 'Ressie Baumbach', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624IKg', 'normal', 'chanelle06@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hhqZA9HDz8', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(65, '+9040768627736', 'b12c9b17-551c-4bc9-80b5-ae5271616ed3', 'a919002b-866c-44c7-a409-28eeb654f5b3', 0, 'Garnett Heaney', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624SXn', 'normal', 'dedrick79@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xS5qklpt47', '2020-06-24 02:00:10', '2020-06-24 02:00:10'),
(66, '+3730569462459', '90f516d9-ce83-4c1f-8768-9970af7033fd', 'dccdb6af-667d-4468-9cd9-61aaf09259ad', 0, 'Marlene Pagac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206247CE', 'normal', 'lelah06@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7LMuBBdets', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(67, '+2121532337486', '5f209879-0869-43f3-97da-0813941bbd9f', 'd8a56d89-8b33-4a89-a6ce-88e9083987d8', 0, 'Prof. Ofelia Rau', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624eZv', 'normal', 'anastacio29@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '98Ut2FVjMC', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(68, '+3673247873130', '81b5ec3f-25a3-4289-8fed-38218b0dbdc5', 'c6d3a588-07b6-4c1e-a9ec-8d1f506a2051', 0, 'Otho Sauer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624OgJ', 'normal', 'lsatterfield@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YSFpGyTFs0', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(69, '+6687672133202', 'fe19c3c9-bc2c-47fb-a7b4-0e1eab434162', '7f59fe01-00bd-45dd-a97b-520197149b02', 0, 'Genevieve Ernser', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624EYp', 'normal', 'greenfelder.janae@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'KSfyNobTra', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(70, '+6507735373612', '4baac404-0423-4fae-be3c-afb25e430182', '2ae71a4c-7ea2-4150-a729-d0371defe6d2', 0, 'Fannie Mills Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Az5', 'normal', 'kling.giovani@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HnaV1JKr9L', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(71, '+6631453991065', '7835fcd9-ce3d-4226-afd2-1457671dd3eb', 'cbbc7c29-c1b1-4f88-98a1-6440099fba91', 0, 'Prof. Michale Murray', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624n3D', 'normal', 'thurman.walsh@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MI1WupodTR', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(72, '+1097044671234', '8640a053-725c-4611-ae81-7b7f22799c34', 'dc77ce21-b75e-4a6a-a4ca-1040bc16eb7c', 0, 'Kenyatta Pagac', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624cOO', 'normal', 'mitchell.isabel@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WG2hzY8NbT', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(73, '+6761393880798', '1040c5ce-1311-4713-b2f1-96ebc19f1e4c', '32ca6547-5a33-4cd3-9634-020aa06b353d', 0, 'Leonard Pfannerstill', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241Pk', 'normal', 'murray.zander@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'TKDIPalBT5', '2020-06-24 02:00:11', '2020-06-24 02:00:11'),
(74, '+4187772052007', '29c07475-37a0-4ebd-9504-5fae1d252ed6', '24adf8fc-b68c-4f28-90c6-08fc50699b92', 0, 'Miss Hassie Mann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624otq', 'normal', 'shanahan.lonzo@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XlOyX5NZMs', '2020-06-24 02:00:12', '2020-06-24 02:00:12'),
(75, '+9032460911241', '12804622-9714-460a-8a9a-844559ab2892', '062befbc-d39d-46aa-923f-7e0a2426fb91', 0, 'Bette Lakin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624dev', 'normal', 'mfunk@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'boD6ahW7DK', '2020-06-24 02:00:12', '2020-06-24 02:00:12'),
(76, '+5128302785520', '2cf21d49-86f7-4875-8bcb-bdfc475c74bd', 'e90666ec-a8f4-4abd-a2df-918b079b3ab5', 0, 'Dr. Skylar Bogan Jr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206247Gp', 'normal', 'ryan.lilliana@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iyOfAxzXMi', '2020-06-24 02:00:12', '2020-06-24 02:00:12'),
(77, '+8401507603898', 'dc3b5922-c92e-4ad2-b473-2f285d31ece0', '70928def-1a4f-4e1f-8641-7cf2e7c4e8c2', 0, 'Daphne Murphy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624n3Q', 'normal', 'ttoy@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4Uzcu5g7oV', '2020-06-24 02:00:12', '2020-06-24 02:00:12'),
(78, '+5794474793270', 'dd13c6ca-2a59-4b1d-a871-10f29f457945', 'a97f0468-5a4f-45a6-bb9b-309a0cf1be04', 0, 'Prof. Kaitlyn Bruen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624bQM', 'normal', 'maci69@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'U5CV9gd7DI', '2020-06-24 02:00:12', '2020-06-24 02:00:12'),
(79, '+6148693199463', 'a59d6494-337d-4e50-8cda-f6b7e1695c3f', '93da0b63-c502-484c-9e04-81ddeb222ad9', 0, 'Felipa Steuber', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624SiR', 'normal', 'athiel@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'H8Gksf7XFo', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(80, '+4068524651166', '6bbcf52a-cf2e-44a1-920e-e100356d1daf', '7c345e8d-6450-4038-8b53-60da5a6beead', 0, 'Bria O\'Reilly', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624lM3', 'normal', 'gottlieb.genesis@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v0uvE9e0ZB', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(81, '+2628222099023', 'd94f30e7-f7ab-4748-845a-06328338a810', '98c8139a-167a-4690-b72f-e033e2c079ee', 0, 'Katrine Kuvalis', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624YUA', 'normal', 'ischinner@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MELGyz19Cp', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(82, '+5031560988744', '27fafbf1-14c5-41c5-8b8e-05ec0c49fd19', '89056de9-47b6-4726-9ea1-4e5e8c5b0027', 0, 'Annabell Dickinson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '20206241Yw', 'normal', 'leffler.marisa@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EcWqp3lLiF', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(83, '+8358498422564', 'f63313ab-9616-4a97-a195-baea021067dd', 'd850bbad-b12a-4d5d-9fa8-1a1f377a3d30', 0, 'Richie Fadel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624ZdB', 'normal', 'elody.adams@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'N7o8lSgtHb', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(84, '+4716253905543', 'aeeb7180-f55e-48f3-b4c9-6cf394db4d4f', '23588e84-2a63-42cc-a066-51e67b129c7c', 0, 'Laron Hermann', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624nTg', 'normal', 'dell.schmeler@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2ZQeBVhu3X', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(85, '+5172923940878', 'bf837285-a788-4b14-8fdc-9b19baca06a1', '16e8e0c5-1670-4e17-aed1-5b3fefae8065', 0, 'Hazel Bogan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624urw', 'normal', 'cschulist@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Pq1aJAecaN', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(86, '+2866599833810', '2059e3bc-ffc2-44ff-a4cf-bf470d537cf7', 'b34d04e8-496c-4007-aa48-764e55d5fa80', 0, 'Prof. Betty Leuschke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624F90', 'normal', 'upton.vince@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dJtNEV7hf4', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(87, '+9537048178195', 'fef182ef-d779-4593-b6ea-a92223d2389e', 'f0ef791f-26e3-4c6a-9d58-b43e9ec1c51d', 0, 'Brock Willms', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624PET', 'normal', 'cokuneva@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xOfn2xo3c3', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(88, '+8146721086490', '5a321bfd-9d21-488c-8d12-3f8f1f6c4842', 'ba138945-2f52-46f6-8afa-918f0bb25825', 0, 'Gerda Kulas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624MxL', 'normal', 'wuckert.yolanda@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '84eH6q2DxN', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(89, '+3197178465838', '1ce68e79-2fde-433c-a176-4f848139a504', '39bd0e83-2997-4637-952f-36211bedcfc6', 0, 'Waino Schaefer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624LAU', 'normal', 'veronica.carter@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oWrRhQgdvI', '2020-06-24 02:00:13', '2020-06-24 02:00:13'),
(90, '+9342145105535', '08a5954d-be62-4719-a5ae-58cf4960a27f', 'af29ef5e-3c83-4540-bd05-2bec62cb0f5a', 0, 'Bruce Huels', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624YUo', 'normal', 'winnifred.veum@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'AVH1VlIqrb', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(91, '+8688903599878', 'f9d8734b-202c-4310-9ae3-22bb48a6a6ee', 'e7d95b38-97ef-4f13-ae23-5c713c3e7b5f', 0, 'Adell Goyette PhD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624wO9', 'normal', 'nedra.toy@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g0PyhgIFfr', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(92, '+5087860566691', 'f3b70d7c-1003-4ceb-b6d0-5a0d01b62590', 'f210349a-4657-45ef-aa06-f2626f39f9e0', 0, 'Emilio Keeling', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624fQo', 'normal', 'satterfield.kale@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jistDPEkrS', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(93, '+4061539283698', '6e1bc512-514d-4f71-97b8-5b279a556368', '71f53b5d-2a28-4fe6-85e7-8f4c3e8d932b', 0, 'Bernadette Larkin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624csq', 'normal', 'aroob@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'VnGDVHbq0E', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(94, '+4534682717161', '4ff3c886-5938-4193-9ef1-358bfc2a867d', 'ded6833b-b712-4b37-a666-3bbdd9fdf748', 0, 'Clementine Kunze', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Q4l', 'normal', 'vilma.gerhold@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '85Eszj6jY4', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(95, '+5753295865231', '3a83f962-ba20-446a-8e63-3165936beb3d', '5a9436e9-68db-46ad-a092-891de709543e', 0, 'Kelvin Kunde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624fZk', 'normal', 'abshire.tito@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'QZKJnyG4Zl', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(96, '+8933254678730', '1d44b640-bd0b-4bcb-aced-bee893ba1b4a', '048d35a3-7f87-47cd-b58b-22a51bbe6d87', 0, 'Dr. Marco Rath', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624hq4', 'normal', 'toy.emmerich@example.org', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tY01v3t4dK', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(97, '+1488107779835', '2e194358-0c03-4ff8-b7fd-67da1f64c3e5', '088c8537-0d3a-4fef-b018-4dfa369a1155', 0, 'Arlo Murphy Sr.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624HJu', 'normal', 'oabshire@example.com', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fEOU0s6Z6Z', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(98, '+7745646498008', '01ebf0e9-1805-4664-adf5-fab1f945dff6', '2829dd23-937a-496f-a78c-7fed04d36282', 0, 'Bryana Macejkovic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624rf1', 'normal', 'tessie41@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'k2v1VGdza4', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(99, '+8399041229680', '9cb6b362-a1ae-4fe8-8919-7c566badcc2e', 'd1a5cbef-d6ba-4a79-8961-ed0998b8ee72', 0, 'Marlin Gerhold V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624Bws', 'normal', 'waelchi.lafayette@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uxvFiuxgpA', '2020-06-24 02:00:14', '2020-06-24 02:00:14'),
(100, '+1430980610392', 'ef8176ed-d0c8-44a2-98d2-d825efee8e22', '20fc719d-1d39-49ae-938f-f524c2a69547', 0, 'Esta Langworth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020624PSz', 'normal', 'sreilly@example.net', '2020-06-24 02:00:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 's25mXEG8EX', '2020-06-24 02:00:14', '2020-06-24 02:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rejected` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verifications`
--

INSERT INTO `user_verifications` (`id`, `user_id`, `status`, `payment_method`, `transaction_id`, `rejected`, `created_at`, `updated_at`) VALUES
(1, 1, 'pending', 'bkash', 'change transaction id', 0, '2020-07-03 05:04:52', '2020-07-03 05:05:30'),
(2, 2, 'pending', 'bkash | rocket', '45F43FFU6', 0, '2020-07-03 08:05:49', '2020-07-03 08:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_verification_details`
--

CREATE TABLE `user_verification_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll` int(11) NOT NULL,
  `reg_num` int(11) NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verification_details`
--

INSERT INTO `user_verification_details` (`id`, `user_id`, `education`, `roll`, `reg_num`, `group`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'SSC', 12522, 54545, 'Commerce', 2010, '2020-07-03 05:16:23', '2020-07-03 05:17:24'),
(2, 2, 'SSC', 3132134, 64564555, 'science', 2010, '2020-07-03 08:54:18', '2020-07-03 08:55:02'),
(3, 2, 'HSC', 78999999, 64564555, 'science | commerce | arts', 2010, '2020-07-03 08:55:21', '2020-07-03 09:05:03');

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_verification_details`
--
ALTER TABLE `user_verification_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
