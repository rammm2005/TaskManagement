-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2024 at 11:04 AM
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
-- Database: `absen_sistem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `phone` bigint(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`, `phone`, `location`, `about_me`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@softui.com', '$2y$10$gdlgURtHbjvu64479eVJS.uq25bJEGpnNDCy3SQkzJ9PvvBvPq1pG', 'admin', NULL, NULL, NULL, NULL, '2024-07-15 01:53:05', '2024-07-15 01:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `date`, `check_in_time`, `check_out_time`, `created_at`, `updated_at`) VALUES
(1, 4, '2024-07-15', '14:10:25', '14:10:27', '2024-07-15 07:10:25', '2024-07-15 07:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

CREATE TABLE `daily_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `tasks_completed` text NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_reports`
--

INSERT INTO `daily_reports` (`id`, `user_id`, `date`, `tasks_completed`, `feedback`, `created_at`, `updated_at`) VALUES
(1, 3, '2024-07-16', 'Sudah memberikan task bermanfaat kepada anak magang aman 😄😄', 'Nope tidak ada semua aman heheeh. 🚀', '2024-07-15 02:58:26', '2024-07-15 02:58:54'),
(3, 4, '2024-07-16', 'Done Saya Tugas nua', 'Itu Perbaiki dan buat task nya sesuai jadwal', '2024-07-15 06:04:21', '2024-07-15 07:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2024-07-15 01:53:04', NULL, 'Software Engineer'),
(2, '2024-07-15 01:53:04', NULL, 'UI/UX Designer');

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
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'magang',
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `name`, `password`, `role`, `email`, `phone_number`, `address`, `status`, `supervisor_id`, `created_at`, `updated_at`) VALUES
(1, 'Dayu Magang', '$2y$10$gPf0.9hDY6sCl729e0zMPOtc7VF/Mbt4CmX7uxe/YToQ6vlOSmv/S', 'magang', 'dayu@gmail.com', '08732983283822', 'Jalan Tubuh no 4', 'active', 1, '2024-07-15 01:53:05', '2024-07-15 01:53:05');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_07_03_100422_create_departement_table', 1),
(5, '2024_07_03_110019_create_suvervisor_table', 1),
(6, '2024_07_03_125255_create_interns_table', 1),
(7, '2024_07_04_000000_create_users_table', 1),
(8, '2024_07_04_121501_create_daily_reports_table', 1),
(9, '2024_07_04_140545_create_task_table', 1),
(10, '2024_07_04_154357_create_attendance_table', 1),
(11, '2024_07_12_005700_admin_table', 1),
(12, '2024_07_13_071758_create_site_settings_table', 1),
(13, '2024_07_16_035017_create_montly_reports_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_reports`
--

CREATE TABLE `monthly_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month_year` date NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_reports`
--

INSERT INTO `monthly_reports` (`id`, `user_id`, `month_year`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-07-17', 'Untuk memberikan panduan mengenai konten yang perlu dimasukkan ke dalam input content, Anda bisa menambahkan placeholder atau instruksi di dalam form. Misalnya, Anda bisa menyarankan pengguna untuk memasukkan ringkasan kegiatan bulanan, pencapaian, masalah yang dihadapi, dan rencana untuk bulan berikutnya.\r\n\r\nBerikut adalah contoh form yang lebih lengkap dengan instruksi tambahan untuk input content:\r\n\r\nTapi keseluruhan aman 🚀😄🔥', '2024-07-16 01:39:32', '2024-07-16 01:39:32');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` text DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_description`, `instagram`, `twitter`, `facebook`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'Task System', 'The project is a Laravel-based application that manages system settings, user roles, backups, and database operations. It includes features such as:\r\n\r\nSystem Settings Management: Allows administrators to configure general system settings through a web interface.\r\n\r\nUser Roles: Supports multiple user roles such as admin, supervisor, and intern, each with specific permissions and access levels.\r\n\r\nBackup and Restore: Provides functionality to create backups of the database and restore them when needed, ensuring data integrity and security.\r\n\r\nDatabase Operations: Includes CRUD (Create, Read, Update, Delete) operations for entities like departments, tasks, daily reports, and user management.\r\n\r\nInterface Design: Uses Bootstrap or similar frameworks for responsive and user-friendly interface design.\r\n\r\nAdditional Features: Integration with third-party services like social media (e.g., Instagram, Twitter) for enhanced user engagement and system functionality.', 'https://www.instagram.com/callmerammz/', 'https://www.twitter.com/callmerammz/', 'https://www.facebook.com/callmerammz/', 'https://www.linkedin.com/in/rama-dita-486a6b249/', '2024-07-15 01:53:04', '2024-07-16 01:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'supervisors',
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `name`, `password`, `email`, `phone_number`, `role`, `status`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'supervisors', '$2y$10$mDIrAtxEcQYMiZKQfnNTU.h0zKH5twxbd.8KXb00RM7oBDO6tEvdK', 'supervisors@softui.com', '0878329372823', 'supervisors', 'active', 1, '2024-07-15 01:53:05', '2024-07-15 01:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_description` text NOT NULL,
  `duedate` timestamp NOT NULL DEFAULT current_timestamp(),
  `reminder` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `created_at`, `updated_at`, `user_id`, `supervisor_id`, `task_description`, `duedate`, `reminder`, `completed`) VALUES
(1, 'Buat Web Server Pake Linux', '2024-07-15 01:57:25', '2024-07-15 08:11:51', 4, 3, 'Task \"Buat Web Server\" merupakan sebuah tugas yang umumnya ditugaskan kepada seseorang atau tim untuk mengatur, mengkonfigurasi, dan menjalankan server web yang dapat digunakan untuk menyediakan layanan web. Berikut ini adalah beberapa poin yang biasanya tercakup dalam tugas ini:\r\n\r\nInstalasi dan Konfigurasi Server Web:\r\n\r\nPemilihan Server: Memilih jenis server web yang sesuai dengan kebutuhan, seperti Apache HTTP Server, Nginx, atau Microsoft IIS.\r\nInstalasi: Menginstal perangkat lunak server web pada sistem operasi server yang dipilih.\r\nKonfigurasi Awal: Menyesuaikan konfigurasi server untuk memenuhi kebutuhan spesifik, seperti menentukan direktori root, pengaturan keamanan, dan manajemen koneksi.\r\nPengaturan Lingkungan Pengembangan:\r\n\r\nPengaturan PHP, MySQL (atau Database Lainnya): Mengintegrasikan server web dengan lingkungan pengembangan yang mendukung bahasa pemrograman server-side seperti PHP, serta database seperti MySQL atau PostgreSQL.\r\nPengaturan Virtual Hosts: Membuat konfigurasi virtual host untuk mendukung hosting beberapa situs web dalam satu server fisik.\r\nKeamanan Server:\r\n\r\nKonfigurasi Firewall: Memastikan firewall konfigurasi untuk melindungi server dari akses yang tidak sah.\r\nPembaruan Keamanan: Memastikan bahwa server dan perangkat lunak terkini dengan memperbarui dan mengelola patch keamanan yang diperlukan.', '2024-07-23 15:22:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` enum('magang','admin','supervisor') NOT NULL DEFAULT 'magang',
  `status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `about_me` varchar(255) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `location`, `department_id`, `role`, `status`, `about_me`, `supervisor_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$2FoFc1yjiizn3LIogGccVeJ0QUNi1a.KP40ygWEOSF7eTyskEMTaa', NULL, NULL, NULL, 'admin', 'active', NULL, NULL, NULL, '2024-07-15 01:53:04', '2024-07-15 01:53:04'),
(2, 'Supervisor User', 'supervisor@example.com', '$2y$10$BGC5q1MwK31TPMKTm1nVwuTWf71ux8ArySw70BnBSvnKlXloZFI46', NULL, NULL, 2, 'supervisor', 'active', NULL, NULL, NULL, '2024-07-15 01:53:04', '2024-07-15 01:53:04'),
(3, 'Daysu', 'day@gmail.com', '$2y$10$.OKzUw4Ubuvw71z3t6SxAOPWNrUyuTtFkqm3NcbWxDWZfSQQqw3vO', NULL, NULL, 2, 'supervisor', 'active', NULL, NULL, NULL, '2024-07-15 01:53:04', '2024-07-15 01:53:04'),
(4, 'Magang User', 'magang@example.com', '$2y$10$.8KowHi44ILRMqhkbSvGSeG9J71LYNOobdmjVeyaGvsZa0XrrmFkC', 827329328382392, 'Bali Indonesia', 2, 'magang', 'active', 'Saya Adalah Mahasiswa teknologi Informasi 😍😃🚀', 3, NULL, '2024-07-15 01:53:04', '2024-07-15 08:25:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_user_id_foreign` (`user_id`);

--
-- Indexes for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `interns_email_unique` (`email`),
  ADD KEY `interns_supervisor_id_foreign` (`supervisor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_reports`
--
ALTER TABLE `monthly_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthly_reports_user_id_foreign` (`user_id`);

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
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supervisors_email_unique` (`email`),
  ADD KEY `supervisors_department_id_foreign` (`department_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`),
  ADD KEY `tasks_supervisor_id_foreign` (`supervisor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_supervisor_id_foreign` (`supervisor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_reports`
--
ALTER TABLE `daily_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `monthly_reports`
--
ALTER TABLE `monthly_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD CONSTRAINT `daily_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `interns_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monthly_reports`
--
ALTER TABLE `monthly_reports`
  ADD CONSTRAINT `monthly_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
