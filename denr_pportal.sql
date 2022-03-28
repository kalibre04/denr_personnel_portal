-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table denr_pportal.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denr_pportal.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denr_pportal.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.office
CREATE TABLE IF NOT EXISTS `office` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `officename` varchar(50) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `officetype` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table denr_pportal.office: ~24 rows (approximately)
/*!40000 ALTER TABLE `office` DISABLE KEYS */;
REPLACE INTO `office` (`id`, `officename`, `province_id`, `officetype`, `location`) VALUES
	(1, 'PENRO Davao Oriental', 5, 'PENRO', 'Dahican, Mati'),
	(2, 'PENRO Davao del Norte', 1, 'PENRO', 'Tagum'),
	(3, 'PENRO Davao de Oro', 4, 'PENRO', 'Nabunturan'),
	(4, 'PENRO Davao del Sur', 3, 'PENRO', 'Digos'),
	(5, 'PENRO Davao Occidental', 2, 'PENRO', 'Malita'),
	(6, 'CENRO Mati', 5, 'CENRO', 'Mati'),
	(7, 'CENRO Lupon', 5, 'CENRO', 'Lupon'),
	(8, 'CENRO Manay', 5, 'CENRO', 'Manay'),
	(9, 'CENRO Baganga', 5, 'CENRO', 'Baganga'),
	(10, 'CENRO New Corella', 1, 'CENRO', 'New Corella'),
	(11, 'CENRO Panabo', 1, 'CENRO', 'Panabo'),
	(12, 'CENRO Maco', 4, 'CENRO', 'Maco'),
	(13, 'CENRO Monkayo', 4, 'CENRO', 'Monkayo'),
	(14, 'CENRO Davao', 3, 'CENRO', 'Davao'),
	(15, 'CENRO Digos', 3, 'CENRO', 'Digos'),
	(16, 'CENRO Malalag', 3, 'CENRO', 'Malalag'),
	(17, 'Conservation and Development Division', 6, 'ARED TS', 'Regional Office'),
	(18, 'Licences Patents and Deeds Division', 6, 'ARED TS', 'Regional Office'),
	(19, 'Surveys and Mapping Division', 6, 'ARED TS', 'Regional Office'),
	(20, 'Enforcement Division', 6, 'ARED TS', 'Regional Office'),
	(21, 'Finance Division', 6, 'ARED MS', 'Regional Office'),
	(22, 'Planning and Management Division', 6, 'ARED MS', 'Regional Office'),
	(23, 'Legal Division', 6, 'ARED MS', 'Regional Office'),
	(24, 'Admin Division', 6, 'ARED MS', 'Regional Office');
/*!40000 ALTER TABLE `office` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denr_pportal.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denr_pportal.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.personnels
CREATE TABLE IF NOT EXISTS `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table denr_pportal.personnels: ~0 rows (approximately)
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.plantilla
CREATE TABLE IF NOT EXISTS `plantilla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plantilla_position` varchar(50) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `salary_grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table denr_pportal.plantilla: ~0 rows (approximately)
/*!40000 ALTER TABLE `plantilla` DISABLE KEYS */;
/*!40000 ALTER TABLE `plantilla` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincename` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table denr_pportal.province: ~6 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
REPLACE INTO `province` (`id`, `provincename`) VALUES
	(1, 'Davao del Norte'),
	(2, 'Davao Occidental'),
	(3, 'Davao del Sur'),
	(4, 'Davao de Oro'),
	(5, 'Davao Oriental'),
	(6, 'Davao City');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;

-- Dumping structure for table denr_pportal.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denr_pportal.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Albert', 'bandio.al@gmail.com', NULL, '$2y$10$Eho6o/WnS/odS5apSH5aPO3PmI1PQ/BDz3bA9sfuvJAqzlJ2nOiPe', NULL, '2022-03-28 07:19:03', '2022-03-28 07:19:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
