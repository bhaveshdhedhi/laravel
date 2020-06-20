-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 11:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `friend_id` int(10) UNSIGNED NOT NULL,
  `status` enum('sent','accepted','blocked') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `status`) VALUES
(1, 1, 10, 'accepted'),
(2, 1, 9, 'blocked'),
(3, 1, 8, 'sent'),
(4, 10, 9, 'blocked'),
(5, 7, 1, 'sent'),
(6, 1, 3, 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE `hobbies` (
  `hobby_id` int(10) UNSIGNED NOT NULL,
  `hobby_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`hobby_id`, `hobby_name`) VALUES
(1, 'Reading'),
(2, 'Drawing'),
(3, 'Cooking'),
(4, 'Writing'),
(5, 'Dancing');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_17_043909_create_hobbies_table', 2),
(5, '2020_06_17_044903_create_users_hobbies_table', 2),
(6, '2020_06_19_123546_create_friends_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bhavesh Dhedhi', 'bhaveshnpatel007@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', 'KM3THfkjn6JYaBjIQCuXrhzTS8YJhOQzfWvswFT62Joj1HV5t21kK1T49IyM', '2020-06-16 23:57:42', '2020-06-16 23:57:42'),
(2, 'Shilpa Gosara', 'shilpa@gmail.com', 'female', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 01:15:50', '2020-06-17 01:15:50'),
(3, 'Vishruti Dhedhi', 'vishruti@gmail.com', 'female', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 01:17:26', '2020-06-17 01:17:26'),
(4, 'Jayesh Patel', 'jayesh@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 01:23:18', '2020-06-17 01:23:18'),
(5, 'Granth Bhagiya', 'granth@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 01:24:30', '2020-06-17 01:24:30'),
(6, 'Nikhil Ujariya', 'nikhil@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 01:25:21', '2020-06-17 01:25:21'),
(7, 'Raj Mehta', 'raj@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 06:51:12', '2020-06-17 06:51:12'),
(8, 'Rakesh Johi', 'rakesh@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 06:58:32', '2020-06-17 06:58:32'),
(9, 'Jitendra Paneliya', 'jitendrap@gmail.com', 'male', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-17 07:01:45', '2020-06-17 07:01:45'),
(10, 'Ranjan Bhagiya', 'ranjan@gmail.com', 'female', NULL, '$2y$10$l9hPrkQFdi8ZAcj.D1NM4OpwIU/PeNseFlzfJcLGfvpCqlLt3TaB.', NULL, '2020-06-19 00:55:57', '2020-06-19 00:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `users_hobbies`
--

CREATE TABLE `users_hobbies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `hobby_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_hobbies`
--

INSERT INTO `users_hobbies` (`id`, `user_id`, `hobby_id`) VALUES
(1, 7, 1),
(2, 7, 2),
(3, 8, 1),
(4, 8, 2),
(5, 9, 1),
(6, 9, 2),
(7, 9, 3),
(8, 9, 4),
(9, 9, 5),
(10, 10, 5),
(11, 1, 3),
(12, 2, 5),
(13, 4, 3),
(14, 6, 2),
(15, 5, 2),
(16, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_friend_id_index` (`friend_id`),
  ADD KEY `friends_user_id_index` (`user_id`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`hobby_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_hobbies`
--
ALTER TABLE `users_hobbies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_hobbies_user_id_foreign` (`user_id`),
  ADD KEY `users_hobbies_hobby_id_foreign` (`hobby_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `hobby_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_hobbies`
--
ALTER TABLE `users_hobbies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_hobbies`
--
ALTER TABLE `users_hobbies`
  ADD CONSTRAINT `users_hobbies_hobby_id_foreign` FOREIGN KEY (`hobby_id`) REFERENCES `hobbies` (`hobby_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_hobbies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
