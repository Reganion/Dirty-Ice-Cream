-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 06:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icecreambookingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `profile_pic`) VALUES
(1, 'admin_user', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '67ea2422ba026.png');

-- --------------------------------------------------------

--
-- Table structure for table `advance_payments`
--

CREATE TABLE `advance_payments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Received') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advance_payments`
--

INSERT INTO `advance_payments` (`id`, `customer_id`, `amount`, `image_path`, `status`, `created_at`) VALUES
(12, 40, 1400.00, 'advanceproof/QOz70GNZBrM3Fp5XcL4b2iAXQbTYdaFDLUHBPDjC.jpg', 'Received', '2025-04-19 03:01:06'),
(14, 41, 1400.00, 'advanceproof/WQsLEPIKz5LrkDYEGRqI1Y6j6L771ar4KiqkKSSB.jpg', 'Received', '2025-04-19 03:10:14'),
(19, 58, 1400.00, 'advanceproof/ENOoPc1fK6z8jMhFk31ojYbc3kHX4CJXJtjno4zU.jpg', 'Received', '2025-05-05 02:36:25'),
(35, 72, 1400.00, 'advanceproof/J6lD8mpjeNrLGdcxHCHns4pYT6zc7AHlU5MqKQe1.jpg', 'Received', '2025-05-15 02:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `flavor` varchar(100) NOT NULL,
  `size_of_gallon` varchar(50) NOT NULL,
  `price_total` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('scheduled','on the way','completed','cancelled') DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `firstname`, `lastname`, `contact_no`, `location`, `booking_date`, `delivery_time`, `flavor`, `size_of_gallon`, `price_total`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(17, 40, 'Ilene', 'Antiniero', '09082653010', 'Pajac LLC', '2025-04-21', '21:50:00', 'Ube', '3.5gl', 1600.00, 'Gcash', 'completed', '2025-04-18 17:50:27', '2025-04-26 18:57:49'),
(18, 41, 'Charles', 'Diongson', '09082653010', 'Pajac LLC', '2025-04-22', '23:09:00', 'Mango Cheese', '3.5gl', 1700.00, 'Gcash', 'completed', '2025-04-18 19:09:42', '2025-05-03 17:21:25'),
(21, 41, 'Charles', 'Diongson', '09082653010', 'Pajac LLC', '2025-04-19', '11:20:00', 'Mango Cheese', '3.5gl', 1700.00, 'Gcash', 'completed', '2025-04-18 19:20:13', '2025-04-18 19:20:31'),
(29, 41, 'Kyle', 'Reganion', '09750044135', 'Pajac LLC', '2025-05-08', '12:00:00', 'Mango Cheese', '3.5gl', 1700.00, 'Cash on Delivery', 'completed', '2025-05-03 17:26:08', '2025-05-03 17:30:11'),
(30, 41, 'Kyle', 'Reganion', '09750044135', 'Pajac LLC', '2025-05-06', '12:00:00', 'Mango', '4gl', 1700.00, 'Cash on Delivery', 'cancelled', '2025-05-03 17:45:26', '2025-05-03 18:00:09'),
(33, 54, 'Irene', 'Antiniero', '09750044135', 'Pajac LLC', '2025-05-06', '12:00:00', 'Mango', '3.5gl', 1500.00, 'Cash on Delivery', 'cancelled', '2025-05-03 18:46:01', '2025-05-10 20:53:37'),
(35, 58, 'Wen', 'Bacalla', '09082653010', 'Marigondon LLC', '2025-05-05', '12:00:00', 'Mango Cheese', '3.5gl', 1700.00, 'Cash on Delivery', 'completed', '2025-05-04 18:32:35', '2025-05-04 18:34:37'),
(42, 72, 'Kyle', 'Reganion', '09082653010', 'Pajac Lapu-lapu City', '2025-05-17', '12:00:00', 'Mango Cheese', '3.5gl', 1700.00, 'Cash on Delivery', 'on the way', '2025-05-14 17:52:51', '2025-05-14 19:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL DEFAULT 'Male',
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `gender`, `phone`, `created_at`, `updated_at`, `otp_code`, `otp_expires_at`) VALUES
(40, 'shesh', 'ilene@gmail.com', '$2y$12$6v2PYvOBbaBMY30gEaO4cuHjLF5oe5ilIbjnD.iTvImgMkkOirDZW', 'Ilene', 'Antiniero', 'Female', '09082653010', '2025-04-16 19:05:47', '2025-04-21 06:03:31', NULL, NULL),
(41, 'nigga', 'mizaki159357@gmail.com', '$2y$12$87ePfbJgwn9LXaIxwXy0T.UraR0Tn9GikX6rlYYXD9.MIQ8LPbl1W', 'Charles', 'Diongson', 'Male', '09750044135', '2025-04-18 19:08:35', '2025-04-18 19:08:35', NULL, NULL),
(54, 'anen', 'antinieroirene@gmail.com', '$2y$12$Y5LyJ4McS/G/cr/2Ov8tTON/rR9qK7BRcyLgMPD8Q/vhtf0QHFGca', 'Irene', 'Antiniero', 'Female', '09082653010', '2025-05-01 07:36:01', '2025-05-03 18:45:20', NULL, NULL),
(55, 'dusty', 'johnlloydabellanosa0@gmail.com', '$2y$12$F321rGqcyq2F6nOLikmRreXAaWV9SnhZW8c0f4wiFiyuwgIiLEcMW', 'John', 'SIndicato', 'Male', '09333925123', '2025-05-01 08:18:33', '2025-05-01 08:18:33', '480542', '2025-05-01 08:23:33'),
(58, 'wenny', 'wellinabacalla20@gmail.com', '$2y$12$5R4wmM6pHMY9hg1tNgFPGOFFA3TnJ4zfRxq9MfIn6UvF7xVaJihuS', 'Wen', 'Bacalla', 'Female', '09082653010', '2025-05-04 18:30:40', '2025-05-04 18:31:23', NULL, NULL),
(66, 'kylereganion', 'kylereganion187@gmail.com', '$2y$12$Drj2lRSQBnl/CcEbt07DcOM49LoKfr./6cC028smFWn8TnmVXPVeu', 'Kyle', 'Reganion', 'Male', '09750044135', '2025-05-14 16:46:51', '2025-05-14 16:47:16', NULL, NULL),
(72, 'kylereganzz', 'kylereganzz@gmail.com', '$2y$12$sbhEteWl4S81xjAFufcQ..lRec7.oCvXl913s1swZm94BAwV7Xs36', 'Kyle', 'Reganion', 'Male', '09088652154', '2025-05-14 17:36:54', '2025-05-14 17:39:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `flavor_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `media_type` enum('image','video','none') DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `customer_id`, `rating`, `comments`, `flavor_name`, `created_at`, `image_path`, `video_path`, `media_type`) VALUES
(25, 40, 5, 'I also liked how it wasn’t too sweet; it had the perfect balance that made it feel like a premium dessert. I enjoyed it chilled after dinner and even shared it with my family — everyone loved it, especially the kids!', 'Mango Cheese', '2025-05-02 12:41:38', NULL, NULL, 'none'),
(26, 54, 4, 'Fresh and naturally sweet! Tastes just like real ripe mangoes.', 'Mango', '2025-05-04 02:47:02', NULL, NULL, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `gallons`
--

CREATE TABLE `gallons` (
  `id` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `addon_price` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallons`
--

INSERT INTO `gallons` (`id`, `size`, `stock`, `addon_price`, `created_at`, `updated_at`) VALUES
(4, '4gl', 10, 200.00, '2025-04-14 17:24:10', '2025-04-14 17:29:25'),
(5, '4.5gl', 10, 300.00, '2025-04-14 17:24:49', '2025-04-14 17:29:40'),
(6, '5gl', 10, 500.00, '2025-04-14 17:29:55', '2025-04-14 17:29:55'),
(9, '3.5gl', 8, 0.00, '2025-05-10 21:33:08', '2025-05-10 21:33:15'),
(17, '5.5gl', 10, 700.00, '2025-05-14 19:58:40', '2025-05-14 20:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `gcash_accounts`
--

CREATE TABLE `gcash_accounts` (
  `id` int(11) NOT NULL,
  `gcash_number` varchar(20) NOT NULL,
  `gcash_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gcash_accounts`
--

INSERT INTO `gcash_accounts` (`id`, `gcash_number`, `gcash_name`, `created_at`) VALUES
(1, '09771173806', 'MA****A R.', '2025-04-17 04:56:49'),
(2, '09750044135', 'RE*E R.', '2025-04-17 05:05:35'),
(3, '09325018811', 'JE***O R.', '2025-04-19 03:06:24'),
(5, '09702117640', 'K*LE R.', '2025-05-04 02:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_type` enum('ingredient','flavor') DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `item_type`, `quantity`, `unit`, `image_url`, `last_updated`) VALUES
(13, 'Cookies and Creamy', 'flavor', 5000, 'gram', '8tAvGIHo5BeCTXy1V4oD4U2l4c6b1b1G9u1kGIgc.png', '2025-04-09 10:18:31'),
(14, 'Mango', 'flavor', 5000, 'gram', 'EWAJRIi26Bs24GmUlLZE70gdzkT484smEWJdT6vG.png', '2025-04-09 10:18:51'),
(15, 'Vanilla', 'flavor', 5000, 'gram', 'oDsOWpE2iCtVudEufG3Dg2fTvsw8i0sHceU1cl4E.png', '2025-04-09 10:19:07'),
(25, 'Brown Sugar', 'ingredient', 4000, 'gram', 'eydoe7NYkg6librskxOXwg6AX1EdSGgvsPzMBZ5K.jpg', '2025-04-09 10:40:20'),
(27, 'White Sugar', 'ingredient', 2000, 'gram', 'JmRqNoXYnhiyvVtD4SAxe51yFVumjFXhW8lJ9Qua.jpg', '2025-04-14 15:19:21'),
(30, 'Cassava', 'ingredient', 4250, 'gram', 'wRksXpAQu52v5xnYwrlu8kqqVmIS2NhiB7el76rv.jpg', '2025-05-04 03:07:25'),
(32, 'Skim Milk', 'ingredient', 4250, 'gram', 'UkLFLk2jYqkviPltLUVVysa9aO1L5bmshalI82gy.jpg', '2025-05-04 04:05:17'),
(34, 'Avocado', 'flavor', 4000, 'gram', 'Jk2lLRVlt767VHn5wQL97U1UW1XuhlbjJ3h5tT3w.png', '2025-05-11 05:22:53'),
(35, 'Ube', 'flavor', 5000, 'gram', 'jWRTTqiWqKkB8ZmzDmX8pWF1Rqt3505VGvTrztZY.png', '2025-05-11 05:27:09'),
(46, 'Chocolate', 'flavor', 5000, 'gram', 'PdyMuAMjiLJPnmQ4LKRCH5LKINGOmR2zk4l61JSC.png', '2025-05-15 03:32:36'),
(47, 'Chocolate', 'flavor', 5000, 'gram', NULL, '2025-05-15 03:33:43'),
(48, 'Chocolate', 'flavor', 5000, 'gram', NULL, '2025-05-15 03:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `flavor_name` varchar(255) NOT NULL,
  `flavor_type` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `flavor_name`, `flavor_type`, `price`, `image_path`, `special`, `created_at`, `updated_at`) VALUES
(3, 'Mango', 'Mango', 1600.00, 'flavors/NOobZEmUyOAJ91Pe63Tn9xiwCh9lQnxMhIpL0Ndw.jpg', 0, '2025-04-14 08:22:43', '2025-05-14 19:54:59'),
(4, 'Mango Cheese', 'Mango', 1700.00, 'flavors/AyNTwL8DXqzdY5RNbiBJN4N5sExgtXU99UtOHEZa.jpg', 1, '2025-04-14 08:26:13', '2025-04-16 03:05:50'),
(5, 'Cookies Cream', 'Vanilla', 1700.00, 'flavors/EBnvRAFTHdIogXYpfIEM9C1VpC62060lCej7539t.jpg', 1, '2025-04-14 08:27:33', '2025-04-20 21:48:33'),
(6, 'Vanilla', 'Vanilla', 1500.00, 'flavors/SuFPBwzat3WdwP4qNzl5cBjPZ3ieHFhtJSdimw1V.jpg', 0, '2025-04-14 15:43:27', '2025-04-14 16:43:49'),
(7, 'Avocado', 'Avocado', 1500.00, 'flavors/YE3Srwdi5DnIzfxNkVl316BQM3LZFmI6yQABzIST.jpg', 0, '2025-04-14 15:44:00', '2025-04-14 16:43:56'),
(8, 'Chocolate', 'Chocolate', 1500.00, 'flavors/kmprIa2MWhiy75MmUtLt4GMBzAX28nAdhr2iWkOQ.jpg', 0, '2025-04-14 15:44:19', '2025-04-14 16:44:02'),
(9, 'Rockyroad', 'Chocolate', 1700.00, 'flavors/C6JcAGjDLwLgNrTQmeEuD1e8l749Di5RAdJRnELx.jpg', 1, '2025-04-14 15:47:30', '2025-04-14 16:44:09'),
(10, 'Chocomellow', 'Chocolate', 1600.00, 'flavors/eFzqyYb5ELk49rQDfzndIuCVNLmI2jwp3zaa4Xxl.jpg', 1, '2025-04-14 15:48:17', '2025-04-14 16:44:16'),
(11, 'Fruit Salad', 'Vanilla', 1700.00, 'flavors/aRhBEQ25A4Lr1ClGlHC6oxF6mQMpt7hAJsxFLJSH.jpg', 1, '2025-04-14 15:48:37', '2025-04-14 16:44:22'),
(12, 'Mango Graham', 'Mango', 1600.00, 'flavors/Y5BH4EYAapmDjyFEnApXx28kTMcG7lTdz5YaD5YW.jpg', 1, '2025-04-14 15:50:10', '2025-04-14 16:44:28'),
(14, 'Ube Cheese', 'Ube', 1600.00, 'flavors/uZP6XYF5iZB6doFQhCNjouz0qsOpgOoB8Ng5Vs1g.jpg', 1, '2025-04-14 16:41:44', '2025-04-14 16:41:59'),
(17, 'Ube', 'Ube', 1600.00, 'flavors/Z6khu0E6x6JWALS7BfyYmjvvOmW5nvxOmJzsCU2U.jpg', 0, '2025-05-10 21:32:41', '2025-05-10 21:32:49'),
(21, 'Ube', 'Ube', 1500.00, '', 0, '2025-05-14 02:17:52', '2025-05-14 02:19:29'),
(22, 'Mango Graham', 'Mango', 1500.00, '', 1, '2025-05-14 19:49:40', '2025-05-14 19:49:40'),
(23, 'Mango Graham', 'Mango', 1500.00, '', 1, '2025-05-14 19:51:08', '2025-05-14 19:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('admin','customer') NOT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_type` enum('admin','customer') NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `sender_type`, `sender_name`, `receiver_id`, `receiver_type`, `message`, `sent_at`) VALUES
(6, 40, 'customer', 'Ilene Antiniero', 1, 'admin', 'hey', '2025-04-17 03:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2avCqja2kTvsCiWzqkz1iWjmJXI1zndIN0Z0FnqF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZUZEcWp3a2ZQNW5sVjVrSkx4WG1RTmpheHlnREpuZVhGcEtKalFybCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747279490),
('2tZUiNRs0AlKx7gzotH8gO4y3GBnUuFRmPeeJDFr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYXZGUE1WMHhSdG9qQ25WVG1xaFNKcWdMTTlVSE0xU1RsWGtnenM1WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747280980),
('3futUsh77tw5fE3YMaYZUi2CjmY67RdOITpvSQBj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiMk14THg3UmVsejZZWkxUYUdmZnpaeEJHcUU2Z2QxQjZycjAweE9DYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWxsb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747281632),
('4fGo9kBuLbP4IOn5aMCCaGf1XPeYGidTxJ8rnl3k', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiSU53NnNNSW16RXI4R0x5MWpLc0R5REtyYmNPZjlyQ29VczN2NGlYbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbnZlbnRvcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747280454),
('6OTxnrCr3e2x9fOOdbuTR3UrgnChXDPfvK63nKyA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNTJRaXZUbWhRZlpOdmpIdXFUVU1MUHB3ejM3R3ZaN0lqcVBzaE5JUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWxsb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747281694),
('7joZ1zJ5fdsseEWJJaSHToUzuaXnpvQZiAPkblfu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6ImFyODVjcVNZSHR0dDJobU9kQzZQRUpTWkFvQ2ZGYUNqbkVOWlV5elAiO30=', 1747278019),
('8QeHhJSB7HeYmKmfzd5fT6XHfBXYUH1qS28iRxTV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoid3NtZmI2bFVVcG5yM2ZKZnR4SVc2TlpmUnJ2alBpd2hGNjhybEp4YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747279408),
('AHILMgP7Eu5N1E1FANMG8HwaBbPFOWS2Slzk3HhF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidTQ4aEx6NHNJck9JZGF2akhwbUJyaU5saVpWdFRMMGJsMWw4S3NtMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747281840),
('Al9aFyRf1uHvprkn0F2lqLGJzx6MB27ddxsunSYp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXBmU1lhV2hBYllKVTZJTkZMZ1hrbWllSHdJVmsycXhrTlhJcEdCYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747277375),
('aqBtwulOpkOlmDriAF6JkyHP84GTN9LKGEINvmrx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYldYY3R2ZnpMa0pIcnlwZUpNd3BOMVRaRUhnZFNNWnRqSXdUQUEwRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747274398),
('bWWV6OjXAtUlPLoZR8OD3Sx7bLH4oOnCgaHfQeES', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibDN5UVExSm9kZ0prdzRJelA3Wm1sd1VmaExyRUs0cG12ekxsTUNYMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747281069),
('CvDUj3i4l93sjr1JsuCGqCml0xlMu9OkNQLZoYGZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNVMwdlJJUVljanM4MjByUjk0c2JPeDkxVWNCUWlBbUhCQWt2S2xhRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbnZlbnRvcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747280104),
('DWPpswWjuy0Yw6aPzaXsLRifjjFck5ULxTTih1Nf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiRThaWVlsZ3BSYUk5NTZhTnd3WkFJTDQ5OW15RVVRYjdGZFNiS1hKSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747279083),
('E33foj9ri2WZ9JzNuwJahSXCPy1MJNqkcsbQlgDG', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVBBUzRVRzlENWRiSHYxS0Eyb0VXTHF0dHBWeWlkcEo5cUcxOGZhSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747273975),
('F19vkdEZZ9PBAdZcULoWSMewNkl44RLA8kmg2Ynd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoicmZxdG1NS1RxUURWSmNHQ3JNRjhxRTEyQmtjazB0bHdTUk80Z0UyWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747278373),
('flLhFzvLui4ZS2DxqXdD3xvKTnKcEFaDLEXk2aaA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmIzeTc2NFVwR0NsM2ExSngwemRkTnp6MkRxNVBVdlE4WElRS0hsUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9hZHZhbmNlcGF5bWV0LyU3QmJvb2tpbmdfaWQlN0QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747276911),
('FQOiMl13geftaS72fjTWZqkbuQfwwpua1WfefkmH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiV1ZDM2RvQXhmZDdpRzJkQmdUN3pEUEZVNnh0ZGtIdExtcndHQUxGRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbnZlbnRvcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747280304),
('g4xwFLGgFMZLXHNJDt84hKVFnZGIp3MlKKVtu5BL', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNFpoMVVaeldyV2l4OXFOanN2T1BPMkdPMFJBbTFLMmlTRTZpUzJESiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9mZWVkYmFjayI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjcyO30=', 1747274538),
('gNiD1g7Ih2lUvIA4kymEEyiH1F4tEgWeDVMsn3Gj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYUlWVFI5azVrWW02ZEhZSnkyN0dmcXg5aXBUWmQwQ01Wd1hHMzEzMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWxsb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747281520),
('i3JFfqV5LEfkeabagvOiu0s5Mkk6silaXN4hukdV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXFPbFhlcXBzMmVLclIzajAzbkJ2ZklkdjRSU1pvY1FjVmJwbGNnZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747278687),
('JzPCGyBg3eaZsA15kJsHZVTHVDO5wN7LzbsfGgWT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiU05iTlFQZjl2RHJOOEk2YnVYSm43d0N3M1JRWHI1OVNIMXRGTjRSbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747281299),
('KH4H2Psh0UFdyEEI8AdwqqHC3mblw7ci1mZm6xTp', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTnRySlcwa3N6UEtWb1hBVGZNMjFqMmZQV0trNUNKeVlNdkY0MVJrRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3Mjt9', 1747273352),
('KJ1r53qT3EauEslqMJ0aYRGqa5ZbKA7DyZfldadm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWwzY2hCYzEyeTY4VHpaV0tuWVBEZE5EM2pFTW5oT09mdkxadXg0RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747277123),
('Ku1sHl8LsqMyXya6IVjSOh3uvGTjMjeS7PjOZRM7', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV2xZeXpQS3pIT2N0d1pDaVJzcUJTV3R3VW1FRTU1WWVBY3RzcnB6QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9ib29rIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747273528),
('mcWoPuz0FDTQKCEmqH088xnM0pNaY497UOFgyoVm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienRseWpwcVlNWUdhempTUWEwZ0JXbDBMaVZqS2Z6M01sU2VMMHppeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747277456),
('mPD80DbXf0CyBqZydZ7ukyaxAq5u3QMmZQFAljoB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNGZVcWRYUGYxTHJYcXJsNFBvUmc1S25RaHhOemlGa1IyNUZNYXprQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbnZlbnRvcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747280023),
('ms8t5X4G6aL0llE3TA6efTrWyJUVLyq46Xrn5w8w', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUkZzanhRN0FnR0d5Ylc2WEZmdnp3RzRNUjdlSlJaTVFWak1YdHR0bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747274093),
('MtzWweFRIRgQxOr4shl8l3KYqT2RIwYmcdokDdkl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkp6a21ZOUNiZ0NjY2UxelhTZzJtbFpmbXllNWFwSllnclNzMDNISCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9mZWVkYmFjayI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747274568),
('nCnkUpXqVMobGyOws6O8MTLtaKzTv20VIRWiLlNF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTEEyZ3AxSGNYOE9VMlhpVFFXU3N0MTMwem8xNW5sNklCaXMzblRjdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWxsb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjI6ImlkIjtpOjE7czo4OiJ1c2VybmFtZSI7czoxMDoiYWRtaW5fdXNlciI7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjtzOjExOiJwcm9maWxlX3BpYyI7czoxNzoiNjdlYTI0MjJiYTAyNi5wbmciO30=', 1747281456),
('nrIrMQrC5wzmMd4PY29A9a8DqO5l4dl0PJKXtNuQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoic0VsbnFjaE9taDd4c2ZnQzJ4Y0Z1UmdMMFE2Yk5YVmZEbzVVTDdBOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747278781),
('nWSj3xn9pAUlTkPXDufbrmoY49sT59pbC36SlgSg', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmF4TDl3S2szZXl6SUlkWFdzbUxyRU9wNndLb21GdUp5OWxJVldaQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3Mjt9', 1747274788),
('OAUeQTSXstGXP9jvR88YfBsZA6aG1P9N6bsqxy3M', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IktiNUR4VlJLanUwVG9TQlpiQ1lySnBTbVptWElBVjNQbmhRRnRZMk4iO30=', 1747277967),
('odZXA30NSTslHQOcg95YJBemlwFlxXHnwsj5r2dn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTE5REhGUWtmdldnSlJtTEZUaTV3eHhOcFNhNnh2S3hTaDh0TlBwUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747276881),
('oZNp1UVdrvSx4WTajK3bgRBP5eVp0naR891CJwJy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoia1hvZnFLYjBITVJUdzFnajlYbjdMRUpMekp2bmxTZUQ3TU00djM1NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747281216),
('ozOgIOLcBosiy9WhloLvxTOxNYyotNiRHNwLgIEG', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTWZIVjRpN3F5RkVwM1A4SUZpdExyc0ZZdDN2M0ExMUFHOE9BT29iMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747277295),
('p5WsW8NJE5o1JqlVNxDoaAYRYr6ZY2Lf3LNkSEMC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajJrOUdyR2FOMkdwWlRaelZLOHl1MlFUdHg1YXdLWjJYQUtnak5mUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747274504),
('pe2PJiKbfQ8ibUVzQQoF1NBX2AJAHNEkKLdAVdwF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IndNWUZMTk1OZ21scFA4dko5ZWN4eUhEZ0k2VFJ4dmNVenlIaDNTUGsiO30=', 1747279675),
('PhKzUtK3SxHPzpOWvYqPmuOxka4t7EZKgPuMJt7E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3owcGVTcEpxNnoxY1RNSFFXQ1RsQ2VRdG5oTjJNaVZxak1WYjJLZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747276762),
('pNnt2PAbLzQbxGxDmp395stFqEXT7SDCLBIEcUm0', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclYwWDNxZzE3cTJNRUZrMGE4ZTBzV3l3eXZlODNkd3VzMTJxVG9rNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9ib29rIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747273565),
('S4anyaZn1jjv7Bi95IGbGBzN8Kw1Xy7Yu0myRCES', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ik9qRTMzenZ5ZGdwRTdiRDc5RTZId3FYR2IzUUhQV2VGOVJKeUNNc0QiO30=', 1747279730),
('SQsdO82OMF9RzBBQqXXn1MDsmL8hqXsyyZNpvynZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE54NDc4S2I1RHExeGt4emYwcExRU3J2eklhUmJpaEJndHRIalNkZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747277895),
('SZ0DKEsStzKEVVq4CL3FeJPQOsPmdeoL6WAo6UAb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoib2JGQVlZaTFpMzdaTExuejVVcXEzQXdZakZmUGIzUzRzQkxVTjUyUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747278646),
('tdu9XalawUE5qA0jXCfIuzTehpcyYkbbvy81ZQow', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2JtWUg5VFdrVWtHQ2duVGUzc1J6aVZ6Z3c0a3FyYWlqb01VRkxOUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747274024),
('uzHQl61oyX5okOaalgg561NchIHWl1OjAHxFHEZf', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTmRTVHNvemE1YmhHaFZ1R3RzckF2V1dERTZXVVo5eVZQSFo5U1c3QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci90cmFja29yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6Nzoic3VjY2VzcyI7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7czo3OiJzdWNjZXNzIjtzOjM2OiJCb29raW5nIHN0YXR1cyB1cGRhdGVkIHN1Y2Nlc3NmdWxseSEiO30=', 1747277213),
('V0k5Il2CmCXxKVDX9Qk7Cc3RrNmq6ufdJnN9Lok7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjJwRDZpSktLeWVYdWU3aUpWWURWOGdBUHJRclJIWUNmb3FwaDBlYlkiO30=', 1747278545),
('v8nL90bNAo87voLo5KoZaaTTC4THly5cu07Yk3nb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNFBnd0Z5d2swb0NyOW1VOGZWbEplWkNpZjBmaWVMcUhjelpOUmRTVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MjoiaWQiO2k6MTtzOjg6InVzZXJuYW1lIjtzOjEwOiJhZG1pbl91c2VyIjtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO3M6MTE6InByb2ZpbGVfcGljIjtzOjE3OiI2N2VhMjQyMmJhMDI2LnBuZyI7fQ==', 1747281777),
('XhuPtP8UKp1thYjuHzIgkMIYn6Vx4C09DxXB8QiD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InNMQ0oxdXJFRVJPZG9HaVNUQXh1R0RrVWM5SWI5V1JJN0hudlJjMDMiO30=', 1747278282),
('xKjoiCTd18nxPaGPNibV9P0196h4caGaUKLXCrCl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTZ1YVBrVkIwTEJPVXJ2VG9EdUQ2Zm5CZlAxT1BKY2pCRlNmTWdLWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747274436),
('y5hRFCbx3jR50RAD821rENXzXHz09BYoqUi44uiK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTFyZDRMNEJ2Ynp3Nm9CTzl5NlBKUm9LZ0k2OVEzWjZLUW85VE9IayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747276798),
('Yg7xjcdYM78VhZp1LFLLg9EA99GxnJRym6SeBemp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNll2UFZmMGhLbGVnTnZ1NmVLUkVrUUQ3U2xJbWxSWHU4c3ZvR05PRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747278560),
('zpi18Dop8WQ20clveYVYmCcSebuc2M14qiMzJoZl', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieDU0Zmd0SWNvQ216MGJ2eXJQYVJsYnJMSlNwWXI3dU9mdDBHQUhpeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3Mjt9', 1747273328),
('zPT8F6b7HBbQOC6VozowsBgJFP8XePL82tgAkTR8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiREdtRFlYQUtUM0tXSUlRMm9PN2RwWGF2a3lhWEJwcHpTSWpqNmJlciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoyOiJpZCI7aToxO3M6ODoidXNlcm5hbWUiO3M6MTA6ImFkbWluX3VzZXIiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czoxMToicHJvZmlsZV9waWMiO3M6MTc6IjY3ZWEyNDIyYmEwMjYucG5nIjt9', 1747278922),
('ZuqJOzHX9TkOlQN4vqqm7k5ne1TcaGPHzSrKmsf0', 72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFdRWnJPbkRjOUhyN0thUTRLMVU0UnFjc003V1ByTE53NFA4ZkpRYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdXN0b21lci9ib29rIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzI7fQ==', 1747273640);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `gallons`
--
ALTER TABLE `gallons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcash_accounts`
--
ALTER TABLE `gcash_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sender_customer` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advance_payments`
--
ALTER TABLE `advance_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `gallons`
--
ALTER TABLE `gallons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gcash_accounts`
--
ALTER TABLE `gcash_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_sender_customer` FOREIGN KEY (`sender_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
