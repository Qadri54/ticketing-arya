-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 19, 2026 at 05:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_mitra`
--

-- --------------------------------------------------------

-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quota` int(11) NOT NULL,
  `event_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `youtube_link`, `image`, `category`, `location`, `price`, `quota`, `event_date`, `created_at`, `updated_at`) VALUES
(1, 'Sumut Heritage Run 2026', 'Acara lari maraton menyusuri bangunan bersejarah di Sumatera Utara. Dapatkan medali dan jersey eksklusif!', NULL, 'event-posters/0ZkxLT1Z5edOTifWDSvXdJXfPeVluTJ2NChKiGCR.png', 'Sport Event', 'Medan', 150000.00, 493, '2026-08-15 06:00:00', '2026-05-13 06:26:42', '2026-06-16 23:21:41'),
(2, 'Medan Padel Fest', 'Turnamen Padel amatir dan profesional. Jangan lewatkan keseruannya bersama komunitas!', NULL, 'event-posters/QbyB1haBKR6gpXIGcOtqoRlKc0hNng1kkzc07iBq.jpg', 'Sport Event & Tournament', 'Medan', 250000.00, 197, '2026-09-10 08:00:00', '2026-05-13 06:26:42', '2026-06-16 23:25:10'),
(4, 'ULANG TAHUN ALYA', 'ACARA MEWAH MANTAP MANTUL', 'https://youtu.be/SpQ8-xiDYWI?si=Xl_c8yAJiJjwUSqx', 'event-posters/uiAJ5mdRfzZ2vrdd4l9DGa38nL0RUZZ4b1ejWVHD.jpg', 'EXHIBITION', 'HOTEL J MARIIT', 200000.00, 20, '2026-07-11 20:07:00', '2026-06-17 01:03:26', '2026-06-17 01:03:26');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_05_13_131347_create_events_table', 1),
(6, '2026_05_13_131356_create_transactions_table', 1),
(7, '2026_05_13_131404_create_tickets_table', 1),
(8, '2026_05_21_073446_create_revenues_table', 2),
(9, '2026_05_25_045747_add_status_to_transactions_table', 3),
(10, '2026_05_26_032000_add_is_checked_in_to_transactions_table', 3),
(11, '2026_05_26_034255_create_sponsorships_table', 4),
(12, '2026_06_02_104939_add_role_to_users_table', 5),
(13, '2026_06_04_032547_add_image_to_events_table', 6),
(14, '2026_06_04_033315_add_location_to_events_table', 7),
(15, '2026_06_04_034035_add_image_to_sponsorships_table', 8),
(16, '2026_06_17_073622_add_youtube_link_to_events_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`id`, `order_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 'TRX-EMMG4JUDQO', 150000, 'Pendapatan dari event: Sumut Heritage Run 2026', '2026-06-16 23:22:38', '2026-06-16 23:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `benefits` text NOT NULL,
  `quota` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `event_id`, `name`, `price`, `benefits`, `quota`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Platinum Paket', 9999999, 'Logo di panggung dan brand disebut di MC', 5, 'sponsors/gcFSC2JjlBCU49tDGjbMM1i38v33exhy7lmBcXwB.jpg', '2026-05-25 20:56:14', '2026-06-03 21:22:16'),
(2, 1, 'Platinum Paket', 2000000, 'logo di panggung', 9, 'sponsors/LYn5JVGwJ5sXCpR06RtvCKtFy07tNWBObHC4EJGd.png', '2026-06-03 21:20:03', '2026-06-03 21:20:03'),
(3, 2, 'Gold', 4000000, 'panggung bagus luar biasa', 10, 'sponsors/GDDcAcSY714xYLmlWJ4rixV77PRL0vclNf4jwqA1.jpg', '2026-06-03 21:22:54', '2026-06-03 21:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `is_scanned` tinyint(1) NOT NULL DEFAULT 0,
  `scanned_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `transaction_id`, `ticket_code`, `is_scanned`, `scanned_at`, `created_at`, `updated_at`) VALUES
(1, 13, 'TRX-XV9SC5FULF-PAXA', 0, NULL, '2026-06-04 21:22:11', '2026-06-04 21:22:11'),
(2, 16, 'TRX-98KNDQEZ8D-SF18', 0, NULL, '2026-06-05 20:15:04', '2026-06-05 20:15:04'),
(3, 17, 'TRX-EMMG4JUDQO-IRDE', 0, NULL, '2026-06-16 23:22:38', '2026-06-16 23:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `is_checked_in` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `event_id`, `order_id`, `quantity`, `total_amount`, `payment_status`, `is_checked_in`, `created_at`, `updated_at`, `status`) VALUES
(8, 1, 1, 'TRX-XMLX9DHQD5', 1, 150000.00, 'pending', 0, '2026-05-24 22:23:24', '2026-05-24 22:23:24', 'pending'),
(9, 1, 2, 'TRX-BJRYESSTIW', 1, 250000.00, 'paid', 0, '2026-05-24 22:31:51', '2026-05-24 22:42:38', 'pending'),
(10, 1, 1, 'TRX-PB0TEK1AIL', 1, 150000.00, 'pending', 0, '2026-05-24 22:44:09', '2026-05-24 22:44:09', 'pending'),
(11, 3, 1, 'TRX-E46DX2X33H', 1, 150000.00, 'paid', 0, '2026-06-03 21:26:33', '2026-06-03 21:26:33', 'pending'),
(12, 3, 2, 'TRX-CQUQ3033ZW', 1, 250000.00, 'paid', 0, '2026-06-03 21:52:17', '2026-06-03 21:52:17', 'pending'),
(13, 1, 1, 'TRX-XV9SC5FULF', 1, 150000.00, 'paid', 0, '2026-06-04 20:39:24', '2026-06-04 20:39:24', 'pending'),
(14, 1, 1, 'TRX-K3TUAH1BYZ', 1, 150000.00, 'paid', 0, '2026-06-04 21:28:10', '2026-06-04 21:28:10', 'pending'),
(15, 1, 2, 'TRX-ICJXD16P41', 1, 250000.00, 'pending', 0, '2026-06-04 21:41:06', '2026-06-04 21:41:06', 'pending'),
(16, 5, 1, 'TRX-98KNDQEZ8D', 1, 150000.00, 'paid', 0, '2026-06-05 20:13:47', '2026-06-05 20:15:04', 'pending'),
(17, 5, 1, 'TRX-EMMG4JUDQO', 1, 150000.00, 'paid', 0, '2026-06-16 23:21:41', '2026-06-16 23:22:38', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','eo','panitia','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alya', 'newwestthoseeyes@gmail.com', 'user', NULL, '$2y$10$ABiY5c3zz0DNK1ZjsjB47uVqPk1eTCgJCsKIOZQXkOJZlQajR0xh2', NULL, '2026-05-13 06:36:46', '2026-05-13 06:36:46'),
(2, 'Rachel', 'rachelsagita@gmail.com', 'user', NULL, '$2y$10$AevK2sB3VdRSATJ.80CWR.6HPcmm/22mN5sgDzMPZc/kIi.uAFTl2', NULL, '2026-05-16 23:13:14', '2026-05-16 23:13:14'),
(3, 'mariska', 'mariskasiagian7@gmail.com', 'user', NULL, '$2y$10$0ae1mrySjZ8YS0z.zcHN/OA02NixH.mzFtJ1dMhkVINgK84Zw577C', NULL, '2026-06-02 04:04:59', '2026-06-02 04:04:59'),
(4, 'arya', 'growaryacommunication@gmail.com', 'admin', NULL, '$2y$10$FDT3.oAuejCgmYS5xDKppuF7.4TSvkEtilgAucG53TQEWyHKS3IVm', NULL, '2026-06-02 04:06:27', '2026-06-02 04:06:27'),
(5, 'Rachel', 'rachelsagita98@gmail.com', 'user', NULL, '$2y$10$6qJQS3KV/qnMizEa./1xk.eeVotIqiNb1qKwOXmJg.iEnjcV5ZMXO', NULL, '2026-06-05 20:13:37', '2026-06-05 20:13:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `revenues_order_id_unique` (`order_id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsorships_event_id_foreign` (`event_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_code_unique` (`ticket_code`),
  ADD KEY `tickets_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_order_id_unique` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsorships_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
