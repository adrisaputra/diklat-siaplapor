-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table db_diklat_siap_lapor.agendas
CREATE TABLE IF NOT EXISTS `agendas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_of_entry` date DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `letter_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `on_process` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.agendas: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` (`id`, `date_of_entry`, `letter_date`, `letter_number`, `letter_from`, `about`, `on_process`, `created_at`, `updated_at`) VALUES
	(1, '2022-08-31', '2022-08-31', '999', 'aaa', 'sss', 'bbb', '2022-08-29 20:34:29', '2022-08-29 20:37:15');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.harmonizations
CREATE TABLE IF NOT EXISTS `harmonizations` (
  `id` bigint(20) unsigned NOT NULL,
  `office_id` bigint(20) unsigned NOT NULL,
  `upload_fix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `taker_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taker_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taker_date` date DEFAULT NULL,
  `status` enum('perbaikan','belum lengkap','perbaiki kembali','kirim ke opd','ambil berkas fisik','kirim ke admin','setor berkas fisik','verifikasi data','selesai') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depositor_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depositor_date` date DEFAULT NULL,
  `initials1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initials2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_harmonizations_offices` (`office_id`),
  CONSTRAINT `FK_harmonizations_offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_harmonizations_proposals` FOREIGN KEY (`id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.harmonizations: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `harmonizations` DISABLE KEYS */;
INSERT INTO `harmonizations` (`id`, `office_id`, `upload_fix`, `upload_date`, `taker_name`, `taker_phone`, `taker_date`, `status`, `depositor_name`, `depositor_date`, `initials1`, `initials2`, `created_at`, `updated_at`) VALUES
	(2, 1, '1663372129.xlsx', '2022-09-16', 'xxx', '39393', NULL, 'perbaikan', 'ssssasasa', NULL, NULL, NULL, '2022-09-16 23:21:45', '2022-09-17 09:17:33'),
	(3, 1, '1663458817.xlsx', '2022-09-17', 'dirly', '089908990899', '2022-09-16', 'selesai', 'Aisyah', '2022-09-18', NULL, NULL, '2022-09-17 09:20:11', '2022-09-17 23:57:38');
/*!40000 ALTER TABLE `harmonizations` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.migrations: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(6, '2021_06_27_012758_create_sessions_table', 2),
	(7, '2022_08_27_014227_create_offices_table', 3),
	(8, '2022_08_27_091712_create_proposals_table', 4),
	(9, '2022_08_28_100033_create_agendas_table', 5),
	(10, '2022_09_13_111545_create_harmonizations_table', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.offices: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'BADAN KEPEGAWAIAN DAERAH', '2022-08-27 01:53:51', '2022-08-27 08:34:26'),
	(2, 'BADAN KESATUAN BANGSA DAN POLITIK', '2022-08-27 08:34:35', '2022-08-27 08:34:35'),
	(3, 'BADAN PENANGGULANGAN BENCANA DAERAH', '2022-08-27 08:34:57', '2022-08-27 08:34:57'),
	(4, 'BADAN PENDAPATAN DAERAH', '2022-08-27 08:35:05', '2022-08-27 08:35:05'),
	(5, 'BADAN PENELITIAN DAN PENGEMBANGAN', '2022-08-27 08:35:13', '2022-08-27 08:35:13');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.proposals
CREATE TABLE IF NOT EXISTS `proposals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `office_id` bigint(20) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `type` enum('Draft SK','Pergub','Perda','MOU','NPHD','Nota Kesepahaman','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `cover_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status1` enum('Lengkap','Tidak Lengkap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_staff` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status2` enum('Lengkap','Tidak Lengkap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_memo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status3` enum('Lengkap','Tidak Lengkap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_concept` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status4` enum('Lengkap','Tidak Lengkap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draft` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status5` enum('Lengkap','Tidak Lengkap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Masuk','Perbaiki','Proses','Selesai') COLLATE utf8mb4_unicode_ci DEFAULT 'Masuk',
  `date_disposition1` date DEFAULT NULL,
  `date_disposition2` date DEFAULT NULL,
  `date_disposition3` date DEFAULT NULL,
  `date_disposition4` date DEFAULT NULL,
  `date_disposition5` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proposals_offices` (`office_id`),
  CONSTRAINT `FK_proposals_offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.proposals: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `proposals` DISABLE KEYS */;
INSERT INTO `proposals` (`id`, `office_id`, `date`, `type`, `about`, `cover_letter`, `status1`, `desc1`, `review_staff`, `status2`, `desc2`, `official_memo`, `status3`, `desc3`, `approval_concept`, `status4`, `desc4`, `draft`, `status5`, `desc5`, `status`, `date_disposition1`, `date_disposition2`, `date_disposition3`, `date_disposition4`, `date_disposition5`, `created_at`, `updated_at`) VALUES
	(2, 1, '2022-09-17', 'Draft SK', 'usulan draft SK', '1663370505.pdf', 'Lengkap', NULL, '1663370505.pdf', 'Lengkap', NULL, '1663370505.pdf', 'Lengkap', NULL, '1663370505.pdf', 'Lengkap', NULL, '1663370505.xlsx', 'Lengkap', NULL, 'Selesai', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-16 23:21:45', '2022-09-16 23:25:48'),
	(3, 1, '2022-09-17', 'Perda', 'Pengurusan perda', '1663407903.pdf', 'Lengkap', NULL, '1663406411.pdf', 'Lengkap', NULL, '1663406411.pdf', 'Lengkap', NULL, '1663406411.pdf', 'Lengkap', NULL, '1663407574.xlsx', 'Lengkap', NULL, 'Selesai', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-17', '2022-09-17 09:20:11', '2022-09-17 09:48:28');
/*!40000 ALTER TABLE `proposals` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.sessions: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('9ewFE8xECN1k0jEJQb6NoSHumctl28KZPrYt74Kw', 8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNllHTjNTeVN1TnBqMzFYQzY4YkNUeGZXaFNNc2trOWFZbnNFUllZeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvZGlrbGF0LXNpYXBsYXBvci9oYXJtb25pemF0aW9ucyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCR3RHNLWDhjcWtCcUVicEVLZnJydFNPSDBDNWxXdzFReS4xb252NGlYN1FmMUM1b1Fyd1RwLiI7fQ==', 1663459526),
	('robN4pBWTkEt7EasxfjFAm231hm5rLgsOXShTXYm', 6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibHpQY2VPUUVnRUlyZEdlM2pNaHV0OW9vYmlJMXVaanJRdVg3STdhbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3QvZGlrbGF0LXNpYXBsYXBvci9oYXJtb25pemF0aW9uX29wZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCR1bEdwMnQ2SlBpWDhtTG0wVURnaWZlTFpuY1k2dDYwTlVtd1pFeFNzWndYOG84WXpSZFFKYSI7fQ==', 1663459679),
	('tnAN073D7CSDbyhOKUMqOsV7XWb2pjAoDekIByEz', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSW1PTXU1MVJWV1BxSHM5Z1U2c3N4cGZXR3JGTDF4VnNLZXlzdXBiWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvZGlrbGF0LXNpYXBsYXBvci9oYXJtb25pemF0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRuam1oU1dJRWN5MVE0L0Y1Y2JOT3N1bHZlMTF4M01sUHJEYU1rTjdYWDVZa1NVVDloSUhvNiI7fQ==', 1663459685);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- membuang struktur untuk table db_diklat_siap_lapor.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `office_id` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_diklat_siap_lapor.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `foto`, `group`, `office_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'administrator@gmail.com', NULL, '$2y$10$njmhSWIEcy1Q4/F5cbNOsulve11x3MlPrDaMkN7XX5YkSUT9hIHo6', NULL, NULL, NULL, '1661807999.jpg', 1, NULL, 0, '2021-06-27 10:19:17', '2022-08-29 21:19:59'),
	(6, 'admin_bkd', 'admin_bkd@gmail.com', NULL, '$2y$10$ulGp2t6JPiX8mLm0UDgifeLZncY6t60NUmwZExSsZwX8o8YzRdQJa', NULL, NULL, NULL, NULL, 3, 1, 0, '2022-08-27 08:43:50', '2022-08-27 08:43:50'),
	(7, 'admin_bpd', 'admin_bpd@gmail.com', NULL, '$2y$10$FSpJrVT0tuEo.rqS42MQUO/WA1gpWKJI4a5AkRGKsG5qNqI3LMRBK', NULL, NULL, NULL, NULL, 3, 4, 0, '2022-08-29 20:47:28', '2022-08-29 20:47:28'),
	(8, 'pimpinan', 'pimpinan@gmail.com', NULL, '$2y$10$wDsKX8cqkBqEbpEKfrrtSOH0C5lWw1Qy.1onv4iX7Qf1C5oQrwTp.', NULL, NULL, NULL, NULL, 2, NULL, 0, '2022-09-17 12:55:04', '2022-09-17 12:55:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
