CREATE TABLE `clients` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `code` int(11) NOT NULL,
 `type` tinyint(4) NOT NULL DEFAULT 1,
 `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
 `responsible_name` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `responsible_mobile` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `follow_up_name` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `follow_up_mobile` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `how_know_us` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `national_id` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `government_id` int(10) unsigned  DEFAULT NULL,
 `area` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `address` varchar(191) COLLATE utf8mb4_unicode_ci  DEFAULT NULL,
 `is_archived` tinyint(4) NOT NULL DEFAULT 0,
 `created_by` int(10) unsigned NOT NULL,
 `updated_by` int(10) unsigned NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 UNIQUE KEY `clients_code_unique` (`code`),
 UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `user_client` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(10) unsigned NOT NULL,
 `client_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
