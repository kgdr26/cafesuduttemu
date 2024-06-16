/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.11.8-MariaDB : Database - db_cafesuduttemu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cafesuduttemu` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `db_cafesuduttemu`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);

/*Table structure for table `mst_category` */

DROP TABLE IF EXISTS `mst_category`;

CREATE TABLE `mst_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_category` */

insert  into `mst_category`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'Foods',1,1,'2024-06-11 09:49:26'),
(2,'Drink',1,1,'2024-06-11 14:32:06');

/*Table structure for table `mst_role` */

DROP TABLE IF EXISTS `mst_role`;

CREATE TABLE `mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_role` */

insert  into `mst_role`(`id`,`name`,`is_active`,`update_by`,`last_update`) values 
(1,'SUPERADMIN',1,1,'2024-06-11 07:41:16'),
(2,'KASIR',1,1,'2024-06-11 07:41:22'),
(3,'KOKI',1,1,'2024-06-11 07:41:25'),
(4,'CUSTOMER',1,1,'2024-06-11 07:41:37');

/*Table structure for table `mst_status_order` */

DROP TABLE IF EXISTS `mst_status_order`;

CREATE TABLE `mst_status_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_status_order` */

/*Table structure for table `mst_table` */

DROP TABLE IF EXISTS `mst_table`;

CREATE TABLE `mst_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `mst_table` */

insert  into `mst_table`(`id`,`kode`,`name`,`qr_code`,`status`,`is_active`,`update_by`,`last_update`) values 
(1,'01','Meja 01','01.svg',1,1,1,'2024-06-16 19:28:26'),
(2,'02','Meja 02','02.svg',1,1,1,'2024-06-16 15:12:44'),
(3,'03','Meja 03','03.svg',1,1,1,'2024-06-16 18:46:38'),
(4,'04','Meja 04','04.svg',0,1,1,'2024-06-13 11:49:58');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('1F3wlP1pwzmzFcVqZvWEmgoqCUvioQ7mDq52auiF',4,'127.0.0.1','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36 Edg/126.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGZ4bG1NN3E3RGlOTTJWVWVYM2kwQ2pzY3N4NHllOFZhWDNORGFRNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vY2FmZXN1ZHV0dGVtdS5rZ2RyL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=',1718525702),
('Dtc8qMSEOq8MwVPX5gpkv8sR267zPu6sPpRBGTVp',1,'127.0.0.1','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36 Edg/126.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZW15THZZcEpNNHBGQUV3Vm5BWkhua2duaG5LcGVzaUlXNkVEZ0hEQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vY2FmZXN1ZHV0dGVtdS5rZ2RyL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1718525846),
('H54s7zWtFVQ7LRnpeVoSv46nyKCfXrAWipKe91Wh',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSklIVnNLWjlIUjZJQmJncVhKUGh3YXV3bWJsNldJTEw3cGpraGlEMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vY2FmZXN1ZHV0dGVtdS5rZ2RyL3RhYmxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1718541141),
('kk4BwH2n9k2JgZS91rAqwHwpTDkDA0vpJi64pNZo',NULL,'192.168.175.254','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUswdE90RTF5Y1FvRXdaQ080UTV5MkxOOUUwcTlBMjFJVWZYWlQ1RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vMTkyLjE2OC4xNzUuNS9jYWZlc3VkdXR0ZW11L3B1YmxpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1718541130),
('NmfoO53cOCt8z1yvzTcVuAANvpj1A6NrA5z9Jjjh',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidzdEcEZLRWpGQ0lEeGZsT0NLcVk4anNuNWlVYUJhS1JnaXh6dHhYRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vY2FmZXN1ZHV0dGVtdS5rZ2RyL2xpc3RwZXNhbmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9',1718532187),
('s5m93GX68cFb1R5cQEiutJmWecY6HdtIx3gmMjMe',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3FGNkJybXpHc2k3TlI4OEVKMUcyMk9xc2JZTGZNY0s2a2ZWemtPZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vY2FmZXN1ZHV0dGVtdS5rZ2RyL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1718540387);

/*Table structure for table `trx_ordering` */

DROP TABLE IF EXISTS `trx_ordering`;

CREATE TABLE `trx_ordering` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_table` int(11) DEFAULT NULL,
  `perangkat` varchar(255) DEFAULT NULL,
  `orderan` text DEFAULT NULL,
  `date_order` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `trx_ordering` */

insert  into `trx_ordering`(`id`,`id_table`,`perangkat`,`orderan`,`date_order`,`status`,`is_active`,`last_update`) values 
(1,1,'a29d37af6855101265bb762e76bf7544d7ebc800b098250194f787099c7cab74','[{\"id_product\": \"1\",\"qty\": \"6\",\"price\": \"9000\",\"dine_in\": \"4\",\"take_away\": \"2\",\"total\": \"54000\",\"status\": \"2\"},{\"id_product\": \"2\",\"qty\": \"3\",\"price\": \"8000\",\"dine_in\": \"2\",\"take_away\": \"1\",\"total\": \"24000\",\"status\": \"2\"},{\"id_product\": \"3\",\"qty\": \"6\",\"price\": \"30000\",\"dine_in\": \"4\",\"take_away\": \"2\",\"total\": \"180000\",\"status\": \"2\"}]','2024-06-16 09:42:49',4,0,'2024-06-16 18:13:20'),
(2,2,'fb192dd67295c0f618ca090421d177207ed0f48aad7f15c630edc37be5b1ed72','[{\"id_product\": \"1\",\"qty\": \"4\",\"price\": \"9000\",\"dine_in\": \"2\",\"take_away\": \"2\",\"total\": \"36000\",\"status\": \"1\"},{\"id_product\": \"2\",\"qty\": \"4\",\"price\": \"8000\",\"dine_in\": \"2\",\"take_away\": \"2\",\"total\": \"32000\",\"status\": \"1\"},{\"id_product\": \"3\",\"qty\": \"4\",\"price\": \"30000\",\"dine_in\": \"2\",\"take_away\": \"2\",\"total\": \"120000\",\"status\": \"1\"}]','2024-06-16 15:12:44',2,1,'2024-06-16 17:02:24'),
(3,3,'a29d37af6855101265bb762e76bf7544d7ebc800b098250194f787099c7cab74','[]','2024-06-16 18:46:38',4,0,'2024-06-16 18:52:07'),
(4,3,'5ac11c5f7caa6b5ed16dad42d32a7b2640c244cd8ff11f3b04e0e9b5c9995884','[]','2024-06-16 19:28:14',1,0,'2024-06-16 19:29:39'),
(5,1,'5ac11c5f7caa6b5ed16dad42d32a7b2640c244cd8ff11f3b04e0e9b5c9995884','[]','2024-06-16 19:28:26',1,0,'2024-06-16 19:29:43'),
(6,1,'5ac11c5f7caa6b5ed16dad42d32a7b2640c244cd8ff11f3b04e0e9b5c9995884','[]','2024-06-16 19:30:03',1,0,'2024-06-16 19:30:51'),
(7,1,'5ac11c5f7caa6b5ed16dad42d32a7b2640c244cd8ff11f3b04e0e9b5c9995884','[]','2024-06-16 19:31:07',1,0,'2024-06-16 19:31:47'),
(8,1,'5ac11c5f7caa6b5ed16dad42d32a7b2640c244cd8ff11f3b04e0e9b5c9995884','[]','2024-06-16 19:32:05',1,1,'2024-06-16 19:32:05');

/*Table structure for table `trx_product` */

DROP TABLE IF EXISTS `trx_product`;

CREATE TABLE `trx_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trx_product` */

insert  into `trx_product`(`id`,`name`,`category_id`,`price`,`qty`,`foto`,`is_active`,`update_by`,`last_update`) values 
(1,'Nasi Goreng',1,9000,70,'8925.png',1,1,'2024-06-16 15:12:53'),
(2,'Mie Goreng',1,8000,0,'84687.png',2,1,'2024-06-16 15:14:57'),
(3,'Ayam Kecap',1,30000,60,'39946.png',1,1,'2024-06-16 15:13:08');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`username`,`password`,`pass`,`role_id`,`foto`,`no_tlp`,`remember_token`,`is_active`,`update_by`,`last_update`,`created_at`,`updated_at`) values 
(1,'Admin','test@example.com','2024-06-13 06:39:29','adm','$2y$12$2tlfuDsoO/1egzSy/uBwLeARLgeNo3wGa.6BrdNyNqrXftltouI/W','1',1,'default.jpg','098876','xlnNLuR0HM',1,1,'2024-06-13 06:39:29','2024-06-13 06:39:29','2024-06-13 06:39:29'),
(2,'Kasir','tes@name.com','2024-06-11 09:20:59','kasir','$2y$12$ApuBh4AqxN9G9xkbUL3HJusUbUV3dzBtJN6dsd8h9mLzscYkDvl5q','1',2,'default.jpg','08997654',NULL,1,1,'2024-06-11 09:20:59','2024-06-11 09:20:59','2024-06-11 09:20:59'),
(4,'Koki','te1s@name.com','2024-06-11 09:21:13','koki','$2y$12$yoUl4dvxTZe78XgIXyqpuek0.Y7riJG7EUAHr1BCB7yTA7fps/fHm','1',3,'default.jpg','0988765432',NULL,1,1,'2024-06-11 09:21:13','2024-06-11 09:21:13','2024-06-11 09:21:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
