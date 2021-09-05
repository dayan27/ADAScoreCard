-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 08:40 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ada_balanced_score_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `adas`
--

CREATE TABLE `adas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mission` text COLLATE utf8_unicode_ci NOT NULL,
  `vision` text COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adas`
--

INSERT INTO `adas` (`id`, `mission`, `vision`, `about`, `created_at`, `updated_at`) VALUES
(1, 'To support the development endeavors of the people of Amhara Region in the areas of basic health, basic education, basic skill training and other related development activities, through community participation by mobilizing resources from members, supporters, donors and other income generating sources.', 'To see a society that can curb social development challenges on its own by year 2025.', 'Amhara Development Association (ADA) is an indigenous not-for-profit organization established in May 1992. ADA emerged as a local Non Governmental Organization to contribute to the economic and social progress of the people of the Amhara National Region. The head office is located at Bahir Dar, the capital city of the Amhara National Regional State. ADA has zonal offices in the bigger seven zones of the Amhara Region, branch offices in all woredas (woreda is a local language equivalent to District) and in other regions of the Federal Democratic Republic of Ethiopia. Branch offices at woreda level are managed and respective activities are carried out voluntary by members. It also has overseas offices in few countries of Africa, Europe, America and Asia managed by volunteers. The legal status of ADA has been registered with the Federal Democratic Republic of Ethiopia Charities and Societies Agency as Ethiopian Residence Association (registration number 1421) with the mandate to implement development activities in the Amhara National Region.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `behaviors`
--

CREATE TABLE `behaviors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `maximum_score_point` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `behaviors`
--

INSERT INTO `behaviors` (`id`, `title`, `weight`, `maximum_score_point`, `created_at`, `updated_at`) VALUES
(1, 'the abilities to learn new things fast', 3, NULL, NULL, NULL),
(2, 'creativity', 4, NULL, NULL, NULL),
(3, 'panctuality', 2, NULL, NULL, NULL),
(4, 'hshaksf dfjhs jasadj', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `behavior_user`
--

CREATE TABLE `behavior_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `behavior_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `department_card_id` bigint(20) UNSIGNED NOT NULL,
  `result_scale` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `behavior_user`
--

INSERT INTO `behavior_user` (`id`, `user_id`, `behavior_id`, `term_id`, `department_card_id`, `result_scale`, `result`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 132, 1, 4, 12, NULL, NULL),
(2, 4, 2, 132, 1, 4, 16, NULL, NULL),
(4, 1, 2, 132, 1, 4, 12, NULL, NULL),
(5, 1, 2, 132, 1, 4, 16, NULL, NULL),
(7, 4, 3, 132, 2, 4, 12, NULL, NULL),
(8, 1, 2, 132, 2, 4, 16, NULL, NULL),
(10, 1, 1, 132, 2, 4, 12, NULL, NULL),
(11, 4, 4, 132, 2, 4, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `phone_no`, `email`, `role`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'finance', '567890', 'yy@gmail.com', 'others', NULL, '2021-09-02 09:28:19', '2021-09-02 09:28:19'),
(2, 'Human Resource', '567890', 'yy@gmail.com', 'HR', 5, '2021-09-02 09:28:42', '2021-09-03 13:22:03'),
(3, 'HR', '155820', 'hr@gmail.com', 'HR', NULL, '2021-09-02 11:09:40', '2021-09-02 11:09:40'),
(15, 'CS', '155820', 'alexo@gmail.com', 'other', NULL, '2021-09-03 10:36:13', '2021-09-03 10:36:13'),
(17, 'IT', '155820', 'eyilachewlema@gmail.com', 'other', NULL, '2021-09-03 10:40:42', '2021-09-03 13:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `department_cards`
--

CREATE TABLE `department_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `number_of_term` int(11) NOT NULL,
  `make_visible` tinyint(1) NOT NULL DEFAULT '0',
  `score_card_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department_cards`
--

INSERT INTO `department_cards` (`id`, `year`, `from`, `to`, `number_of_term`, `make_visible`, `score_card_id`, `created_at`, `updated_at`) VALUES
(1, '2013', '2013-06-25', '2014-06-11', 3, 0, 3, '2021-09-02 22:32:14', '2021-09-02 22:32:14'),
(2, '2023', '2023-01-03', '2024-01-01', 2, 0, 3, '2021-09-03 14:37:04', '2021-09-03 14:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `department_plans`
--

CREATE TABLE `department_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_weight` int(11) NOT NULL,
  `time_weight` int(11) NOT NULL,
  `quality_weight` int(11) NOT NULL,
  `to` date NOT NULL,
  `from` date NOT NULL,
  `budget` double NOT NULL,
  `goal` double NOT NULL,
  `perspective_id` bigint(20) UNSIGNED NOT NULL,
  `yearly_plan_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `department_card_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department_plans`
--

INSERT INTO `department_plans` (`id`, `activity`, `quantity_weight`, `time_weight`, `quality_weight`, `to`, `from`, `budget`, `goal`, `perspective_id`, `yearly_plan_id`, `department_id`, `department_card_id`, `created_at`, `updated_at`) VALUES
(1, 'department plan 333', 3, 3, 3, '2017-09-09', '2016-09-09', 1000, 20, 1, 1, 2, 1, '2021-09-03 09:52:45', '2021-09-03 09:52:45'),
(2, 'department plan 23233', 3, 3, 3, '2017-09-09', '2016-09-09', 1000, 20, 1, 1, 2, 1, '2021-09-03 10:23:52', '2021-09-03 10:23:52'),
(3, 'department plan 90', 3, 3, 3, '2017-09-09', '2016-09-09', 1000, 20, 1, 1, 2, 1, '2021-09-03 10:26:38', '2021-09-03 10:26:38'),
(4, 'building houses for orphans', 3, 3, 2, '2023-01-01', '2022-01-01', 4555, 90, 3, 2, 1, 1, '2021-09-03 13:26:29', '2021-09-03 13:26:29'),
(5, 'supporting rural farmers', 5, 5, 2, '2023-01-02', '2022-01-01', 23232, 90, 3, 2, 1, 1, '2021-09-03 15:49:39', '2021-09-03 15:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `department_strategic_plan`
--

CREATE TABLE `department_strategic_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `strategic_plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department_strategic_plan`
--

INSERT INTO `department_strategic_plan` (`id`, `department_id`, `strategic_plan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 1, 2, NULL, NULL),
(4, 2, 2, NULL, NULL),
(5, 1, 3, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 1, 4, NULL, NULL),
(9, 1, 5, NULL, NULL),
(10, 3, 5, NULL, NULL),
(11, 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_08_17_102814_create_score_cards_table', 1),
(6, '2021_08_17_103340_create_perspectives_table', 1),
(7, '2021_08_17_103341_create_strategic_plans_table', 1),
(8, '2021_08_19_142245_create_year_cards_table', 1),
(9, '2021_08_19_142852_create_yearly_plans_table', 1),
(11, '2021_08_19_143445_create_department_strategic_plans_table', 1),
(13, '2021_08_23_075633_create_terms_table', 1),
(14, '2021_08_23_080042_create_department_plans_table', 1),
(15, '2021_08_23_080212_create_term_activities_table', 1),
(16, '2021_08_23_080250_create_term_sub_activities_table', 1),
(17, '2021_08_23_080420_create_user_activities_table', 1),
(18, '2021_08_23_080606_create_user_sub_activities_table', 1),
(19, '2021_08_23_080711_create_behaviors_table', 1),
(20, '2021_08_23_080816_create_behaviors_user_results_table', 1),
(21, '2021_08_23_080856_create_term_efficiencies_table', 1),
(22, '2021_08_23_080951_create_yearly_efficiencies_table', 1),
(23, '2021_08_25_212505_create_adas_table', 1),
(24, '2021_08_19_143401_create_departments_table', 2),
(26, '2014_10_12_000000_create_users_table', 3),
(27, '2021_08_23_075632_create_department_cards_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(121, 'App\\Models\\User', 4, 'auth_token', '88351a7ec4f0682d6cae5184a0f617b539715ab440ea044b107f5c839414f3ad', '[\"*\"]', '2021-09-03 15:49:48', '2021-09-03 13:07:08', '2021-09-03 15:49:48'),
(157, 'App\\Models\\User', 5, 'auth_token', '2132bcf9157d0d1a9f24d6f0c038984d0a2ceff15ccfe9c532d180103224492a', '[\"*\"]', '2021-09-03 20:59:58', '2021-09-03 20:58:39', '2021-09-03 20:59:58'),
(167, 'App\\Models\\User', 5, 'auth_token', '541092d1d103b2cee6a2e652190c878240cf757168d90787d7a7969f5b06afee', '[\"*\"]', '2021-09-05 18:35:03', '2021-09-04 08:49:42', '2021-09-05 18:35:03'),
(175, 'App\\Models\\User', 4, 'auth_token', '3e0ca4a7eda2fb329ba72ecf8315711dce15507995e6eed17cec1ac38e1868ea', '[\"*\"]', '2021-09-04 11:32:57', '2021-09-04 11:25:27', '2021-09-04 11:32:57'),
(177, 'App\\Models\\User', 5, 'auth_token', 'cfeca21cf75cc7e25cfff034a5b92f493f3740491ce3c0e1b654af3645ea40b7', '[\"*\"]', '2021-09-04 12:13:22', '2021-09-04 12:13:19', '2021-09-04 12:13:22'),
(178, 'App\\Models\\User', 5, 'auth_token', 'a5e3061296a8d0d7c3e72c125fbe1e0c5b0eb3db312357ea7ceea6e7e439e18c', '[\"*\"]', '2021-09-04 16:59:50', '2021-09-04 12:13:35', '2021-09-04 16:59:50'),
(180, 'App\\Models\\User', 4, 'auth_token', 'a38f480afa264cc3c361b8add12434281ecd6e2c3997029334b72761e05bb3cd', '[\"*\"]', '2021-09-04 23:30:19', '2021-09-04 17:18:07', '2021-09-04 23:30:19'),
(184, 'App\\Models\\User', 4, 'auth_token', 'ed76d3143fcca2952ca20e1bad80d84c60be329be83cadc3ad2f251f5900dbac', '[\"*\"]', '2021-09-05 10:19:58', '2021-09-05 00:35:55', '2021-09-05 10:19:58'),
(185, 'App\\Models\\User', 4, 'auth_token', '7bac22926c7481e852f4c70ba50b49089e9de3c36dbdf8a99c2ddf3e2aa92642', '[\"*\"]', '2021-09-05 10:21:53', '2021-09-05 10:07:51', '2021-09-05 10:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `perspectives`
--

CREATE TABLE `perspectives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perspectives`
--

INSERT INTO `perspectives` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ፋይናንስ', 'no f', '2021-09-02 15:56:53', '2021-09-02 19:48:42'),
(2, 'ደንበኛ', 'no', '2021-09-02 15:57:12', '2021-09-02 19:49:09'),
(3, 'የውስጥ አሰራር', 'no', '2021-09-02 15:57:33', '2021-09-02 15:58:03'),
(4, 'መማርና እድገት', 'no', '2021-09-02 15:59:12', '2021-09-02 15:59:12'),
(5, 'improvement', 'how the organization adap new thing and educate', '2021-09-04 13:51:49', '2021-09-04 13:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `score_cards`
--

CREATE TABLE `score_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` date NOT NULL,
  `from` date NOT NULL,
  `make_visible` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `score_cards`
--

INSERT INTO `score_cards` (`id`, `name`, `description`, `to`, `from`, `make_visible`, `created_at`, `updated_at`) VALUES
(3, 'የ አልማ ከ 2014 እስከ 2019 ስትራቴጅክ እቅድ', 'የ አልማ ከ 2014 እስከ 2019 ስትራቴጅክ እቅድ', '2018-12-01', '2014-01-01', 1, '2021-09-02 10:23:27', '2021-09-03 12:52:14'),
(4, 'ADA score card2', 'scor card of ADA from 2015-2018', '2015-09-09', '2018-09-09', 1, '2021-09-03 09:59:54', '2021-09-03 11:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `strategic_plans`
--

CREATE TABLE `strategic_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` date NOT NULL,
  `from` date NOT NULL,
  `phase` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score_card_id` bigint(20) UNSIGNED NOT NULL,
  `perspective_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `strategic_plans`
--

INSERT INTO `strategic_plans` (`id`, `action`, `to`, `from`, `phase`, `score_card_id`, `perspective_id`, `created_at`, `updated_at`) VALUES
(1, 'To widen and strengthen income generating through project proposal', '2021-09-01', '2021-09-07', 'መጀመሪያ', 3, 1, '2021-09-02 16:01:49', '2021-09-02 16:01:49'),
(2, 'To work towards improving the skill training capacity of the association', '2021-09-01', '2021-09-07', 'መጀመሪያ', 3, 2, '2021-09-02 16:02:31', '2021-09-02 16:02:31'),
(3, 'To strengthen the public relation and communication duties', '2021-09-01', '2021-09-07', 'መጀመሪያ', 3, 3, '2021-09-02 16:03:03', '2021-09-02 16:03:03'),
(4, 'To foster the knowledge and attitude of the employee.', '2021-09-07', '2021-09-01', 'መጀመሪያ', 3, 2, '2021-09-02 16:03:35', '2021-09-03 20:01:59'),
(5, 'To boost the budget administration of the association', '2014-09-09', '2018-09-09', 'phase 1', 3, 3, '2021-09-02 18:16:12', '2021-09-02 18:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term_no` int(11) NOT NULL,
  `to` date NOT NULL,
  `from` date NOT NULL,
  `make_visible` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `department_card_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `term_no`, `to`, `from`, `make_visible`, `comment`, `department_id`, `department_card_id`, `created_at`, `updated_at`) VALUES
(1, '1', 1, '2021-10-01', '2021-09-01', 0, NULL, 1, 8, '2021-09-02 16:35:43', '2021-09-02 16:35:43'),
(2, '2', 2, '2021-11-01', '2021-10-01', 0, NULL, 1, 8, '2021-09-02 16:35:45', '2021-09-02 16:35:45'),
(3, '3', 3, '2021-12-01', '2021-11-01', 0, NULL, 1, 8, '2021-09-02 16:35:45', '2021-09-02 16:35:45'),
(4, '4', 4, '2022-01-01', '2021-12-01', 0, NULL, 1, 8, '2021-09-02 16:35:46', '2021-09-02 16:35:46'),
(5, '1', 1, '2021-10-24', '2021-10-02', 0, NULL, 1, 9, '2021-09-02 16:36:51', '2021-09-02 16:36:51'),
(6, '2', 2, '2021-11-16', '2021-10-24', 0, NULL, 1, 9, '2021-09-02 16:36:51', '2021-09-02 16:36:51'),
(7, '3', 3, '2021-12-09', '2021-11-16', 0, NULL, 1, 9, '2021-09-02 16:36:51', '2021-09-02 16:36:51'),
(8, '4', 4, '2022-01-01', '2021-12-09', 0, NULL, 1, 9, '2021-09-02 16:36:51', '2021-09-02 16:36:51'),
(9, '1', 1, '2022-04-03', '2022-01-02', 0, NULL, 1, 10, '2021-09-02 16:36:53', '2021-09-02 16:36:53'),
(10, '2', 2, '2022-07-03', '2022-04-03', 0, NULL, 1, 10, '2021-09-02 16:36:53', '2021-09-02 16:36:53'),
(11, '3', 3, '2022-10-02', '2022-07-03', 0, NULL, 1, 10, '2021-09-02 16:36:53', '2021-09-02 16:36:53'),
(12, '4', 4, '2023-01-01', '2022-10-02', 0, NULL, 1, 10, '2021-09-02 16:36:54', '2021-09-02 16:36:54'),
(13, '1', 1, '2021-10-24', '2021-10-02', 0, NULL, 1, 12, '2021-09-02 16:45:26', '2021-09-02 16:45:26'),
(14, '2', 2, '2021-11-16', '2021-10-24', 0, NULL, 1, 12, '2021-09-02 16:45:27', '2021-09-02 16:45:27'),
(15, '3', 3, '2021-12-09', '2021-11-16', 0, NULL, 1, 12, '2021-09-02 16:45:27', '2021-09-02 16:45:27'),
(16, '4', 4, '2022-01-01', '2021-12-09', 0, NULL, 1, 12, '2021-09-02 16:45:27', '2021-09-02 16:45:27'),
(17, '1', 1, '2021-10-09', '2021-09-01', 0, NULL, 1, 13, '2021-09-02 16:47:09', '2021-09-02 16:47:09'),
(18, '2', 2, '2021-11-17', '2021-10-09', 0, NULL, 1, 13, '2021-09-02 16:47:09', '2021-09-02 16:47:09'),
(19, '3', 3, '2021-12-26', '2021-11-17', 0, NULL, 1, 13, '2021-09-02 16:47:09', '2021-09-02 16:47:09'),
(20, '1', 1, '2021-09-30', '2021-09-01', 0, NULL, 1, 17, '2021-09-02 17:14:14', '2021-09-02 17:14:14'),
(21, '2', 2, '2021-10-29', '2021-09-30', 0, NULL, 1, 17, '2021-09-02 17:14:14', '2021-09-02 17:14:14'),
(22, '3', 3, '2021-11-27', '2021-10-29', 0, NULL, 1, 17, '2021-09-02 17:14:15', '2021-09-02 17:14:15'),
(23, '4', 4, '2021-12-26', '2021-11-27', 0, NULL, 1, 17, '2021-09-02 17:14:15', '2021-09-02 17:14:15'),
(24, '1', 1, '2021-09-30', '2021-09-01', 0, NULL, 1, 18, '2021-09-02 17:14:28', '2021-09-02 17:14:28'),
(25, '2', 2, '2021-10-29', '2021-09-30', 0, NULL, 1, 18, '2021-09-02 17:14:28', '2021-09-02 17:14:28'),
(26, '3', 3, '2021-11-27', '2021-10-29', 0, NULL, 1, 18, '2021-09-02 17:14:28', '2021-09-02 17:14:28'),
(27, '4', 4, '2021-12-26', '2021-11-27', 0, NULL, 1, 18, '2021-09-02 17:14:28', '2021-09-02 17:14:28'),
(28, '1', 1, '2021-10-11', '2021-09-01', 0, NULL, 1, 19, '2021-09-02 17:15:28', '2021-09-02 17:15:28'),
(29, '2', 2, '2021-11-21', '2021-10-11', 0, NULL, 1, 19, '2021-09-02 17:15:29', '2021-09-02 17:15:29'),
(30, '3', 3, '2022-01-01', '2021-11-21', 0, NULL, 1, 19, '2021-09-02 17:15:29', '2021-09-02 17:15:29'),
(31, '1', 1, '2021-10-11', '2021-09-01', 0, NULL, 1, 1, '2021-09-02 17:16:34', '2021-09-02 17:16:34'),
(32, '2', 2, '2021-11-21', '2021-10-11', 0, NULL, 1, 1, '2021-09-02 17:16:34', '2021-09-02 17:16:34'),
(33, '3', 3, '2022-01-01', '2021-11-21', 0, NULL, 1, 1, '2021-09-02 17:16:35', '2021-09-02 17:16:35'),
(34, '1', 1, '2021-10-11', '2021-09-01', 0, NULL, 1, 2, '2021-09-02 17:16:36', '2021-09-02 17:16:36'),
(35, '2', 2, '2021-11-21', '2021-10-11', 0, NULL, 1, 2, '2021-09-02 17:16:37', '2021-09-02 17:16:37'),
(36, '3', 3, '2022-01-01', '2021-11-21', 0, NULL, 1, 2, '2021-09-02 17:16:37', '2021-09-02 17:16:37'),
(37, '1', 1, '2021-10-11', '2021-09-01', 0, NULL, 1, 22, '2021-09-02 17:17:08', '2021-09-02 17:17:08'),
(38, '2', 2, '2021-11-21', '2021-10-11', 0, NULL, 1, 22, '2021-09-02 17:17:08', '2021-09-02 17:17:08'),
(39, '3', 3, '2022-01-01', '2021-11-21', 0, NULL, 1, 22, '2021-09-02 17:17:08', '2021-09-02 17:17:08'),
(40, '1', 1, '2022-04-02', '2022-01-01', 0, NULL, 1, 23, '2021-09-02 17:22:41', '2021-09-02 17:22:41'),
(41, '2', 2, '2022-07-03', '2022-04-02', 0, NULL, 1, 23, '2021-09-02 17:22:43', '2021-09-02 17:22:43'),
(42, '3', 3, '2022-10-02', '2022-07-03', 0, NULL, 1, 23, '2021-09-02 17:22:47', '2021-09-02 17:22:47'),
(43, '4', 4, '2023-01-02', '2022-10-02', 0, NULL, 1, 23, '2021-09-02 17:23:01', '2021-09-02 17:23:01'),
(44, '1', 1, '2019-06-05', '2019-01-02', 0, NULL, 1, 24, '2021-09-02 17:28:13', '2021-09-02 17:28:13'),
(45, '2', 2, '2019-11-07', '2019-06-05', 0, NULL, 1, 24, '2021-09-02 17:28:13', '2021-09-02 17:28:13'),
(46, '3', 3, '2020-04-10', '2019-11-07', 0, NULL, 1, 24, '2021-09-02 17:28:13', '2021-09-02 17:28:13'),
(47, '1', 1, '2021-09-28', '2021-09-09', 0, NULL, 1, 25, '2021-09-02 17:32:20', '2021-09-02 17:32:20'),
(48, '2', 2, '2021-10-17', '2021-09-28', 0, NULL, 1, 25, '2021-09-02 17:32:20', '2021-09-02 17:32:20'),
(49, '3', 3, '2021-11-05', '2021-10-17', 0, NULL, 1, 25, '2021-09-02 17:32:20', '2021-09-02 17:32:20'),
(50, '4', 4, '2021-11-25', '2021-11-05', 0, NULL, 1, 25, '2021-09-02 17:32:21', '2021-09-02 17:32:21'),
(51, '1', 1, '2022-04-03', '2022-01-02', 0, NULL, 1, 26, '2021-09-02 17:47:08', '2021-09-02 17:47:08'),
(52, '2', 2, '2022-07-03', '2022-04-03', 0, NULL, 1, 26, '2021-09-02 17:47:08', '2021-09-02 17:47:08'),
(53, '3', 3, '2022-10-02', '2022-07-03', 0, NULL, 1, 26, '2021-09-02 17:47:08', '2021-09-02 17:47:08'),
(54, '4', 4, '2023-01-02', '2022-10-02', 0, NULL, 1, 26, '2021-09-02 17:47:08', '2021-09-02 17:47:08'),
(55, '1', 1, '2022-04-02', '2022-01-01', 0, NULL, 1, 27, '2021-09-02 18:31:19', '2021-09-02 18:31:19'),
(56, '2', 2, '2022-07-02', '2022-04-02', 0, NULL, 1, 27, '2021-09-02 18:31:19', '2021-09-02 18:31:19'),
(57, '3', 3, '2022-10-01', '2022-07-02', 0, NULL, 1, 27, '2021-09-02 18:31:20', '2021-09-02 18:31:20'),
(58, '4', 4, '2023-01-01', '2022-10-01', 0, NULL, 1, 27, '2021-09-02 18:31:20', '2021-09-02 18:31:20'),
(59, '1', 1, '2021-09-05', '2021-09-02', 0, NULL, 1, 28, '2021-09-02 18:34:40', '2021-09-02 18:34:40'),
(60, '2', 2, '2021-09-08', '2021-09-05', 0, NULL, 1, 28, '2021-09-02 18:34:40', '2021-09-02 18:34:40'),
(61, '3', 3, '2021-09-11', '2021-09-08', 0, NULL, 1, 28, '2021-09-02 18:34:40', '2021-09-02 18:34:40'),
(62, '4', 4, '2021-09-14', '2021-09-11', 0, NULL, 1, 28, '2021-09-02 18:34:40', '2021-09-02 18:34:40'),
(63, '1', 1, '2023-05-22', '2023-01-16', 0, NULL, 1, 29, '2021-09-02 18:37:34', '2021-09-02 18:37:34'),
(64, '2', 2, '2023-09-25', '2023-05-22', 0, NULL, 1, 29, '2021-09-02 18:37:34', '2021-09-02 18:37:34'),
(65, '3', 3, '2024-01-29', '2023-09-25', 0, NULL, 1, 29, '2021-09-02 18:37:34', '2021-09-02 18:37:34'),
(66, '4', 4, '2024-06-04', '2024-01-29', 0, NULL, 1, 29, '2021-09-02 18:37:35', '2021-09-02 18:37:35'),
(83, '1', 1, '2022-04-02', '2021-09-01', 0, NULL, 1, 6, '2021-09-02 21:18:37', '2021-09-02 21:18:37'),
(84, '2', 2, '2022-11-01', '2022-04-02', 0, NULL, 1, 6, '2021-09-02 21:18:37', '2021-09-02 21:18:37'),
(85, '1', 1, '2022-04-02', '2021-09-01', 0, NULL, 1, 7, '2021-09-02 21:19:44', '2021-09-02 21:19:44'),
(86, '2', 2, '2022-11-01', '2022-04-02', 0, NULL, 1, 7, '2021-09-02 21:19:44', '2021-09-02 21:19:44'),
(87, '1', 1, '2025-07-04', '2025-01-01', 0, NULL, 1, 8, '2021-09-02 21:21:23', '2021-09-02 21:21:23'),
(88, '2', 2, '2026-01-05', '2025-07-04', 0, NULL, 1, 8, '2021-09-02 21:21:23', '2021-09-02 21:21:23'),
(89, '1', 1, '2021-09-08', '2021-09-01', 0, NULL, 1, 9, '2021-09-02 21:21:32', '2021-09-02 21:21:32'),
(90, '2', 2, '2021-09-15', '2021-09-08', 0, NULL, 1, 9, '2021-09-02 21:21:32', '2021-09-02 21:21:32'),
(91, '1', 1, '2021-09-10', '2021-09-06', 0, NULL, 1, 10, '2021-09-02 21:25:00', '2021-09-02 21:25:00'),
(92, '2', 2, '2021-09-14', '2021-09-10', 0, NULL, 1, 10, '2021-09-02 21:25:00', '2021-09-02 21:25:00'),
(93, '3', 3, '2021-09-18', '2021-09-14', 0, NULL, 1, 10, '2021-09-02 21:25:03', '2021-09-02 21:25:03'),
(94, '4', 4, '2021-09-22', '2021-09-18', 0, NULL, 1, 10, '2021-09-02 21:25:05', '2021-09-02 21:25:05'),
(95, '1', 1, '2021-09-15', '2021-09-15', 0, NULL, 1, 11, '2021-09-02 21:29:32', '2021-09-02 21:29:32'),
(96, '2', 2, '2021-09-15', '2021-09-15', 0, NULL, 1, 11, '2021-09-02 21:29:32', '2021-09-02 21:29:32'),
(97, '3', 3, '2021-09-15', '2021-09-15', 0, NULL, 1, 11, '2021-09-02 21:29:32', '2021-09-02 21:29:32'),
(98, '4', 4, '2021-09-15', '2021-09-15', 0, NULL, 1, 11, '2021-09-02 21:29:32', '2021-09-02 21:29:32'),
(99, '1', 1, '2025-05-05', '2025-01-05', 0, NULL, 1, 12, '2021-09-02 21:31:38', '2021-09-02 21:31:38'),
(100, '2', 2, '2025-09-03', '2025-05-05', 0, NULL, 1, 12, '2021-09-02 21:31:38', '2021-09-02 21:31:38'),
(101, '3', 3, '2026-01-02', '2025-09-03', 0, NULL, 1, 12, '2021-09-02 21:31:38', '2021-09-02 21:31:38'),
(102, '1', 1, '2023-09-30', '2024-06-03', 0, NULL, 1, 13, '2021-09-02 21:34:19', '2021-09-02 21:34:19'),
(103, '2', 2, '2023-01-27', '2023-09-30', 0, NULL, 1, 13, '2021-09-02 21:34:19', '2021-09-02 21:34:19'),
(104, '3', 3, '2022-05-26', '2023-01-27', 0, NULL, 1, 13, '2021-09-02 21:34:19', '2021-09-02 21:34:19'),
(105, '4', 4, '2021-09-22', '2022-05-26', 0, NULL, 1, 13, '2021-09-02 21:34:20', '2021-09-02 21:34:20'),
(106, '1', 1, '2021-09-15', '2021-09-15', 0, NULL, 1, 14, '2021-09-02 21:39:12', '2021-09-02 21:39:12'),
(107, '2', 2, '2021-09-15', '2021-09-15', 0, NULL, 1, 14, '2021-09-02 21:39:12', '2021-09-02 21:39:12'),
(108, '3', 3, '2021-09-15', '2021-09-15', 0, NULL, 1, 14, '2021-09-02 21:39:12', '2021-09-02 21:39:12'),
(109, '4', 4, '2021-09-16', '2021-09-15', 0, NULL, 1, 14, '2021-09-02 21:39:12', '2021-09-02 21:39:12'),
(110, '1', 1, '2022-02-07', '2021-09-12', 0, NULL, 1, 15, '2021-09-02 21:50:28', '2021-09-02 21:50:28'),
(111, '2', 2, '2022-07-05', '2022-02-07', 0, NULL, 1, 15, '2021-09-02 21:50:28', '2021-09-02 21:50:28'),
(112, '3', 3, '2022-12-01', '2022-07-05', 0, NULL, 1, 15, '2021-09-02 21:50:28', '2021-09-02 21:50:28'),
(113, '1', 1, '2022-03-22', '2021-09-16', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(114, '2', 2, '2022-09-26', '2022-03-22', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(115, '3', 3, '2023-04-01', '2022-09-26', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(116, '4', 4, '2023-10-06', '2023-04-01', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(117, '5', 5, '2024-04-10', '2023-10-06', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(118, '6', 6, '2024-10-15', '2024-04-10', 0, NULL, 1, 16, '2021-09-02 21:51:31', '2021-09-02 21:51:31'),
(119, '1', 1, '2022-03-22', '2021-09-16', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(120, '2', 2, '2022-09-26', '2022-03-22', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(121, '3', 3, '2023-04-01', '2022-09-26', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(122, '4', 4, '2023-10-06', '2023-04-01', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(123, '5', 5, '2024-04-10', '2023-10-06', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(124, '6', 6, '2024-10-15', '2024-04-10', 0, NULL, 1, 17, '2021-09-02 21:55:32', '2021-09-02 21:55:32'),
(125, '1', 1, '2023-04-02', '2023-01-01', 0, NULL, 1, 18, '2021-09-02 22:14:43', '2021-09-02 22:14:43'),
(126, '2', 2, '2023-07-02', '2023-04-02', 0, NULL, 1, 18, '2021-09-02 22:14:43', '2021-09-02 22:14:43'),
(127, '3', 3, '2023-10-01', '2023-07-02', 0, NULL, 1, 18, '2021-09-02 22:14:43', '2021-09-02 22:14:43'),
(128, '4', 4, '2024-01-01', '2023-10-01', 0, NULL, 1, 18, '2021-09-02 22:14:43', '2021-09-02 22:14:43'),
(129, '1', 1, '2024-05-02', '2024-01-01', 0, NULL, 1, 19, '2021-09-02 22:17:10', '2021-09-02 22:17:10'),
(130, '2', 2, '2024-09-01', '2024-05-02', 0, NULL, 1, 19, '2021-09-02 22:17:10', '2021-09-02 22:17:10'),
(131, '3', 3, '2025-01-01', '2024-09-01', 0, NULL, 1, 19, '2021-09-02 22:17:11', '2021-09-02 22:17:11'),
(132, '1', 1, '2013-10-20', '2013-06-25', 0, NULL, 1, 1, '2021-09-02 22:32:15', '2021-09-02 22:32:15'),
(133, '2', 2, '2014-02-14', '2013-10-20', 0, NULL, 1, 1, '2021-09-02 22:32:15', '2021-09-02 22:32:15'),
(134, '3', 3, '2014-06-11', '2014-02-14', 0, NULL, 1, 1, '2021-09-02 22:32:15', '2021-09-02 22:32:15'),
(135, '1', 1, '2023-07-03', '2023-01-03', 0, NULL, 1, 2, '2021-09-03 14:37:04', '2021-09-03 14:37:04'),
(136, '2', 2, '2024-01-01', '2023-07-03', 0, NULL, 1, 2, '2021-09-03 14:37:04', '2021-09-03 14:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `term_activities`
--

CREATE TABLE `term_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `department_plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `term_activities`
--

INSERT INTO `term_activities` (`id`, `term_id`, `department_plan_id`, `created_at`, `updated_at`) VALUES
(1, 31, 1, '2021-09-03 20:36:25', '2021-09-03 20:36:25'),
(2, 31, 1, '2021-09-03 20:37:06', '2021-09-03 20:37:06'),
(3, 31, 3, '2021-09-03 20:37:19', '2021-09-03 20:37:19'),
(4, 32, 4, '2021-09-04 06:15:02', '2021-09-04 06:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `term_efficiencies`
--

CREATE TABLE `term_efficiencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_behavior_result` double NOT NULL,
  `total_term_activity_result` double NOT NULL,
  `result` double NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_sub_activities`
--

CREATE TABLE `term_sub_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `measurment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `term_activity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `term_sub_activities`
--

INSERT INTO `term_sub_activities` (`id`, `title`, `level`, `measurment`, `added_by`, `term_activity_id`, `created_at`, `updated_at`) VALUES
(1, 'To foster the knowledge and attitude of the employee.', 'enough', 'quantity', 'yibeltal', 1, '2021-09-03 20:36:25', '2021-09-03 20:36:25'),
(2, 'building  hospitals', 'high', 'quality', 'yibeltal', 2, '2021-09-03 20:36:47', '2021-09-05 12:55:39'),
(3, 'building  hospitals and toilets', 'enough', 'quality', 'yibeltal', 2, '2021-09-03 20:37:06', '2021-09-03 20:37:06'),
(4, 'building  hospitals and toilets', 'enough', 'Time', 'yibeltal', 3, '2021-09-03 20:37:19', '2021-09-04 06:14:18'),
(5, 'To foster the knowledge and attitude of the employee.', 'enough', 'Time', 'yibeltal', 4, '2021-09-04 06:15:02', '2021-09-04 06:15:02'),
(6, 'To foster the knowledge and attitude of the employee.', 'enough', 'quality', 'yibeltal', 2, '2021-09-04 06:15:35', '2021-09-04 06:15:35'),
(7, 'To foster the knowledge and attitude of the employee.', 'enough', 'quality', 'yibeltal', 3, '2021-09-04 06:16:15', '2021-09-04 06:16:15'),
(8, 'To foster the knowledge and attitude of the employee.', 'enough', 'Quantity', 'yibeltal', 1, '2021-09-04 06:31:21', '2021-09-04 06:31:21'),
(9, 'To foster the knowledge and attitude of the employee.', 'enough', 'Time', 'yibeltal', 3, '2021-09-04 06:31:29', '2021-09-04 06:31:29'),
(10, 'To foster the knowledge and attitude of the employee.', 'enough', 'quality', 'yibeltal', 1, '2021-09-04 06:31:34', '2021-09-04 06:31:34'),
(11, 'To foster the knowledge and attitude of the employee.', 'enough', 'Time', 'yibeltal', 1, '2021-09-04 06:34:14', '2021-09-04 06:34:14'),
(12, 'To foster the knowledge and attitude of the employee.1', 'enough', 'quality', 'yibeltal', 1, '2021-09-04 06:34:48', '2021-09-04 06:34:48'),
(13, 'To foster the knowledge and attitude of the employee.', 'high', 'Time', 'yibeltal', 1, '2021-09-04 11:21:15', '2021-09-04 11:21:15'),
(14, 'To foster the knowledge and attitude of the employee.', 'excellent', 'Time', 'yibeltal', 1, '2021-09-04 11:21:27', '2021-09-04 11:21:27'),
(15, 'To foster the knowledge and attitude of the employee.', 'excellent', 'Quantity', 'yibeltal', 1, '2021-09-04 11:21:41', '2021-09-04 11:21:41'),
(16, 'building  hospitals', 'high', 'Quality', 'yibeltal', 1, '2021-09-04 11:23:11', '2021-09-04 11:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proffesion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `draft_visiblity` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `role`, `proffesion`, `comment`, `phone_no`, `gender`, `email`, `email_verified_at`, `password`, `draft_visiblity`, `is_active`, `department_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Getaye', 'Biaznlgn', 'manager', 'front coder', 'nothing', '090909', 'male', 'sin@gmail.com1', NULL, '$2y$10$qRfTDN/mYStpzduOss6hsO3GIPLwK7p.wJrv5x9bjAf2oZF665rEK', 0, 1, 1, NULL, '2021-09-02 09:31:45', '2021-09-02 09:31:45'),
(4, 'Eyilachew', 'Lema', 'employee', 'front coder', NULL, '090909', 'male', 'eyu@gmail.com', NULL, '$2y$10$qbabLHtAnCv9jX2SY734.OPQQXoYd5K8ueShQSiIdFzvtBDffwS9q', 0, 1, 2, NULL, '2021-09-02 09:36:25', '2021-09-04 23:34:07'),
(5, 'Eyilachew', 'Lema', 'department head', 'front coder', NULL, '090909', 'male', 'sin@gmail.com', NULL, '$2y$10$ouxF9sPJ3I2wi2gi8ObxreoBWZMLrcSg6.66QuL3NlikI1W6DCS6C', 0, 1, 2, NULL, '2021-09-02 19:50:20', '2021-09-02 19:50:20'),
(6, 'alemu', 'lem', 'employee', 'IT assistant', NULL, '155820', 'on', 'aa@gmail.com', NULL, '$2y$10$eDDNa7mIe4XlrR3o1X6G.enRyaj7dI41v5eDcOjN2QL1zccOs15qC', 0, 1, 1, NULL, '2021-09-03 13:59:01', '2021-09-03 13:59:01'),
(7, 'Dayan', 'Yenesew', 'manager', 'Software developer', NULL, '0986689512', 'on', 'dayan@gmail.com', NULL, '$2y$10$qVAeRX1U4taFiBEKOVYiiuXT7Ur1FUyJdfdC/0QaO72ussBTqX0UG', 0, 1, 2, NULL, '2021-09-03 18:07:06', '2021-09-03 18:07:06'),
(10, 'John', 'tezzera', 'head', 'mentainance', NULL, '567877', 'on', 'dede@gmail.comom', NULL, '$2y$10$0VqKsIEaemz/Re1ujlo4cOwAL6UQ/IDw1wkjKXrfIYm0EmsFb0REW', 0, 1, 15, NULL, '2021-09-03 18:23:08', '2021-09-03 18:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `result` double NOT NULL DEFAULT '0',
  `time_result` double NOT NULL DEFAULT '0',
  `quality_result` double NOT NULL DEFAULT '0',
  `quantity_result` double NOT NULL DEFAULT '0',
  `department_plan_id` bigint(20) UNSIGNED NOT NULL,
  `term_activity_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `result`, `time_result`, `quality_result`, `quantity_result`, `department_plan_id`, `term_activity_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 24, 6, 9, 9, 1, 1, 4, '2021-09-04 07:12:07', '2021-09-05 00:26:36'),
(2, 24, 6, 9, 9, 2, 2, 4, '2021-09-04 07:12:07', '2021-09-05 00:23:18'),
(3, 20, 0, 10, 10, 3, 3, 4, '2021-09-04 07:12:08', '2021-09-05 00:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_activities`
--

CREATE TABLE `user_sub_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isAccepeted` tinyint(1) NOT NULL DEFAULT '0',
  `term_sub_activity_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_activity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_sub_activities`
--

INSERT INTO `user_sub_activities` (`id`, `isAccepeted`, `term_sub_activity_id`, `user_id`, `user_activity_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, 1, '2021-09-04 07:12:07', '2021-09-05 12:55:39'),
(2, 0, 7, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(3, 0, 1, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(4, 0, 8, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(5, 0, 6, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(6, 0, 9, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(7, 0, 10, 4, 1, '2021-09-04 07:12:07', '2021-09-04 07:12:07'),
(8, 0, 3, 4, 2, '2021-09-04 07:12:08', '2021-09-04 07:12:08'),
(9, 0, 1, 4, 3, '2021-09-04 07:12:08', '2021-09-04 07:12:08'),
(10, 0, 1, 4, 1, '2021-09-04 08:40:19', '2021-09-04 08:40:19'),
(11, 0, 8, 4, 1, '2021-09-04 08:40:19', '2021-09-04 08:40:19'),
(12, 0, 4, 4, 3, '2021-09-04 08:40:19', '2021-09-04 08:40:19'),
(13, 0, 3, 4, 2, '2021-09-04 08:40:19', '2021-09-04 08:40:19'),
(14, 0, 7, 4, 1, '2021-09-04 09:59:35', '2021-09-04 09:59:35'),
(15, 0, 7, 4, 1, '2021-09-04 09:59:35', '2021-09-04 09:59:35'),
(16, 0, 1, 4, 1, '2021-09-04 09:59:35', '2021-09-04 09:59:35'),
(17, 0, 8, 4, 1, '2021-09-04 09:59:35', '2021-09-04 09:59:35'),
(18, 0, 6, 4, 1, '2021-09-04 09:59:36', '2021-09-04 09:59:36'),
(19, 0, 9, 4, 1, '2021-09-04 09:59:36', '2021-09-04 09:59:36'),
(20, 0, 10, 4, 1, '2021-09-04 09:59:36', '2021-09-04 09:59:36'),
(21, 0, 3, 4, 2, '2021-09-04 09:59:36', '2021-09-04 09:59:36'),
(22, 0, 4, 4, 3, '2021-09-04 09:59:36', '2021-09-04 09:59:36'),
(23, 0, 10, 4, 2, '2021-09-04 11:26:10', '2021-09-04 11:26:10'),
(24, 0, 12, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(25, 0, 16, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(26, 0, 1, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(27, 0, 8, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(28, 0, 15, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(29, 0, 11, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(30, 0, 13, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(31, 0, 14, 4, 2, '2021-09-04 11:26:11', '2021-09-04 11:26:11'),
(32, 0, 1, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(33, 0, 8, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(34, 0, 15, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(35, 0, 13, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(36, 0, 14, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(37, 0, 16, 4, 1, '2021-09-04 11:26:41', '2021-09-04 11:26:41'),
(38, 0, 16, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(39, 0, 12, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(40, 0, 1, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(41, 0, 15, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(42, 0, 8, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(43, 0, 13, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(44, 0, 11, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(45, 0, 14, 4, 1, '2021-09-04 11:28:48', '2021-09-04 11:28:48'),
(46, 0, 10, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14'),
(47, 0, 16, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14'),
(48, 0, 1, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14'),
(49, 0, 15, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14'),
(50, 0, 13, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14'),
(51, 0, 14, 4, 1, '2021-09-04 20:34:14', '2021-09-04 20:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_efficiencies`
--

CREATE TABLE `yearly_efficiencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `result` double NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yearly_plans`
--

CREATE TABLE `yearly_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `budget` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `make_visible` tinyint(1) NOT NULL DEFAULT '0',
  `to` date NOT NULL,
  `from` date NOT NULL,
  `strategic_plan_id` bigint(20) UNSIGNED NOT NULL,
  `year_card_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `yearly_plans`
--

INSERT INTO `yearly_plans` (`id`, `action`, `budget`, `make_visible`, `to`, `from`, `strategic_plan_id`, `year_card_id`, `created_at`, `updated_at`) VALUES
(1, 'To foster the knowledge and attitude of the employee.', '20000', 0, '2014-12-01', '2013-01-01', 1, 1, '2021-09-02 16:06:06', '2021-09-02 16:06:06'),
(2, 'To foster sport development', '20000', 0, '2014-12-01', '2013-01-01', 3, 1, '2021-09-02 16:06:44', '2021-09-02 16:06:44'),
(3, 'To improve data processing', '20000', 0, '2014-12-01', '2013-01-01', 3, 1, '2021-09-02 16:07:07', '2021-09-02 16:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `year_cards`
--

CREATE TABLE `year_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `score_card_id` bigint(20) UNSIGNED NOT NULL,
  `make_visible` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `year_cards`
--

INSERT INTO `year_cards` (`id`, `year`, `score_card_id`, `make_visible`, `created_at`, `updated_at`) VALUES
(1, 2013, 3, 1, '2021-09-02 16:04:36', '2021-09-03 20:05:17'),
(3, 2021, 3, 0, '2021-09-02 22:02:07', '2021-09-02 22:02:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adas`
--
ALTER TABLE `adas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `behaviors`
--
ALTER TABLE `behaviors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `behavior_user`
--
ALTER TABLE `behavior_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `behavior_user_user_id_foreign` (`user_id`),
  ADD KEY `behavior_user_behavior_id_foreign` (`behavior_id`),
  ADD KEY `behavior_user_term_id_foreign` (`term_id`),
  ADD KEY `behavior_user_department_card_foreign` (`department_card_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_user_id_foreign` (`user_id`);

--
-- Indexes for table `department_cards`
--
ALTER TABLE `department_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_cards_score_card_id_foreign` (`score_card_id`);

--
-- Indexes for table `department_plans`
--
ALTER TABLE `department_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_plans_perspective_id_foreign` (`perspective_id`),
  ADD KEY `department_plans_yearly_plan_id_foreign` (`yearly_plan_id`),
  ADD KEY `department_plans_department_id_foreign` (`department_id`),
  ADD KEY `department_plans_department_card_id_foreign` (`department_card_id`);

--
-- Indexes for table `department_strategic_plan`
--
ALTER TABLE `department_strategic_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_strategic_plan_department_id_foreign` (`department_id`),
  ADD KEY `department_strategic_plan_strategic_plan_id_foreign` (`strategic_plan_id`);

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
-- Indexes for table `perspectives`
--
ALTER TABLE `perspectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score_cards`
--
ALTER TABLE `score_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategic_plans`
--
ALTER TABLE `strategic_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `strategic_plans_score_card_id_foreign` (`score_card_id`),
  ADD KEY `strategic_plans_perspective_id_foreign` (`perspective_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terms_department_id_foreign` (`department_id`),
  ADD KEY `terms_department_card_id_foreign` (`department_card_id`);

--
-- Indexes for table `term_activities`
--
ALTER TABLE `term_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_activities_term_id_foreign` (`term_id`),
  ADD KEY `term_activities_department_plan_id_foreign` (`department_plan_id`);

--
-- Indexes for table `term_efficiencies`
--
ALTER TABLE `term_efficiencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_efficiencies_user_id_foreign` (`user_id`);

--
-- Indexes for table `term_sub_activities`
--
ALTER TABLE `term_sub_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_sub_activities_term_activity_id_foreign` (`term_activity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_department_plan_id_foreign` (`department_plan_id`),
  ADD KEY `user_activities_term_activity_id_foreign` (`term_activity_id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_sub_activities`
--
ALTER TABLE `user_sub_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sub_activities_term_sub_activity_id_foreign` (`term_sub_activity_id`),
  ADD KEY `user_sub_activities_user_id_foreign` (`user_id`),
  ADD KEY `user_sub_activities_user_activity_id_foreign` (`user_activity_id`);

--
-- Indexes for table `yearly_efficiencies`
--
ALTER TABLE `yearly_efficiencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yearly_efficiencies_user_id_foreign` (`user_id`);

--
-- Indexes for table `yearly_plans`
--
ALTER TABLE `yearly_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yearly_plans_strategic_plan_id_foreign` (`strategic_plan_id`),
  ADD KEY `yearly_plans_year_card_id_foreign` (`year_card_id`);

--
-- Indexes for table `year_cards`
--
ALTER TABLE `year_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_cards_score_card_id_foreign` (`score_card_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adas`
--
ALTER TABLE `adas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `behaviors`
--
ALTER TABLE `behaviors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `behavior_user`
--
ALTER TABLE `behavior_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `department_cards`
--
ALTER TABLE `department_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_plans`
--
ALTER TABLE `department_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department_strategic_plan`
--
ALTER TABLE `department_strategic_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `perspectives`
--
ALTER TABLE `perspectives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `score_cards`
--
ALTER TABLE `score_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `strategic_plans`
--
ALTER TABLE `strategic_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `term_activities`
--
ALTER TABLE `term_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `term_efficiencies`
--
ALTER TABLE `term_efficiencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_sub_activities`
--
ALTER TABLE `term_sub_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_activities`
--
ALTER TABLE `user_sub_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `yearly_efficiencies`
--
ALTER TABLE `yearly_efficiencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yearly_plans`
--
ALTER TABLE `yearly_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `year_cards`
--
ALTER TABLE `year_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `behavior_user`
--
ALTER TABLE `behavior_user`
  ADD CONSTRAINT `behavior_user_behavior_id_foreign` FOREIGN KEY (`behavior_id`) REFERENCES `behaviors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behavior_user_department_card_foreign` FOREIGN KEY (`department_card_id`) REFERENCES `department_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behavior_user_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behavior_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_cards`
--
ALTER TABLE `department_cards`
  ADD CONSTRAINT `department_cards_score_card_id_foreign` FOREIGN KEY (`score_card_id`) REFERENCES `score_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_plans`
--
ALTER TABLE `department_plans`
  ADD CONSTRAINT `department_plans_department_card_id_foreign` FOREIGN KEY (`department_card_id`) REFERENCES `department_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_plans_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_plans_perspective_id_foreign` FOREIGN KEY (`perspective_id`) REFERENCES `perspectives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_plans_yearly_plan_id_foreign` FOREIGN KEY (`yearly_plan_id`) REFERENCES `yearly_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_strategic_plan`
--
ALTER TABLE `department_strategic_plan`
  ADD CONSTRAINT `department_strategic_plan_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `department_strategic_plan_strategic_plan_id_foreign` FOREIGN KEY (`strategic_plan_id`) REFERENCES `strategic_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `strategic_plans`
--
ALTER TABLE `strategic_plans`
  ADD CONSTRAINT `strategic_plans_perspective_id_foreign` FOREIGN KEY (`perspective_id`) REFERENCES `perspectives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `strategic_plans_score_card_id_foreign` FOREIGN KEY (`score_card_id`) REFERENCES `score_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `terms_department_card_id_foreign` FOREIGN KEY (`department_card_id`) REFERENCES `department_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `terms_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `term_activities`
--
ALTER TABLE `term_activities`
  ADD CONSTRAINT `term_activities_department_plan_id_foreign` FOREIGN KEY (`department_plan_id`) REFERENCES `department_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `term_activities_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `term_efficiencies`
--
ALTER TABLE `term_efficiencies`
  ADD CONSTRAINT `term_efficiencies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `term_sub_activities`
--
ALTER TABLE `term_sub_activities`
  ADD CONSTRAINT `term_sub_activities_term_activity_id_foreign` FOREIGN KEY (`term_activity_id`) REFERENCES `term_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_department_plan_id_foreign` FOREIGN KEY (`department_plan_id`) REFERENCES `department_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_activities_term_activity_id_foreign` FOREIGN KEY (`term_activity_id`) REFERENCES `term_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_activities`
--
ALTER TABLE `user_sub_activities`
  ADD CONSTRAINT `user_sub_activities_term_sub_activity_id_foreign` FOREIGN KEY (`term_sub_activity_id`) REFERENCES `term_sub_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_activities_user_activity_id_foreign` FOREIGN KEY (`user_activity_id`) REFERENCES `user_activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yearly_efficiencies`
--
ALTER TABLE `yearly_efficiencies`
  ADD CONSTRAINT `yearly_efficiencies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yearly_plans`
--
ALTER TABLE `yearly_plans`
  ADD CONSTRAINT `yearly_plans_strategic_plan_id_foreign` FOREIGN KEY (`strategic_plan_id`) REFERENCES `strategic_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yearly_plans_year_card_id_foreign` FOREIGN KEY (`year_card_id`) REFERENCES `year_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `year_cards`
--
ALTER TABLE `year_cards`
  ADD CONSTRAINT `year_cards_score_card_id_foreign` FOREIGN KEY (`score_card_id`) REFERENCES `score_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
