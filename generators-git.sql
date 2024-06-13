-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Чрв 11 2024 р., 17:54
-- Версія сервера: 10.5.25-MariaDB
-- Версія PHP: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `generators-git`
--

-- --------------------------------------------------------

--
-- Структура таблиці `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `gensets`
--

CREATE TABLE `gensets` (
  `genId` int(11) NOT NULL,
  `genTypeId` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `fuelTankId` int(11) DEFAULT NULL,
  `genState` tinyint(4) DEFAULT NULL,
  `genLitres` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `genset__fueltanks`
--

CREATE TABLE `genset__fueltanks` (
  `id` int(11) NOT NULL,
  `fueltank_name` varchar(255) DEFAULT NULL,
  `fueltank_litres` smallint(3) UNSIGNED DEFAULT NULL,
  `fueltank_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `genset__fueltanks`
--

INSERT INTO `genset__fueltanks` (`id`, `fueltank_name`, `fueltank_litres`, `fueltank_description`) VALUES
(1, '100 Літрів', 100, NULL),
(2, '150 Літрів', 150, NULL),
(3, '180 Літрів', 180, NULL),
(4, '200 Літрів', 200, NULL),
(34, '250 Літрів', 250, NULL),
(35, '300 Літрів', 300, NULL),
(61, '350 Літрів', 350, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `genset__refuels`
--

CREATE TABLE `genset__refuels` (
  `id` int(11) NOT NULL,
  `genId` int(11) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `litres` decimal(10,2) UNSIGNED DEFAULT NULL,
  `litresBefore` decimal(10,2) UNSIGNED DEFAULT NULL,
  `litresAfter` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `genset__runs`
--

CREATE TABLE `genset__runs` (
  `id` int(11) NOT NULL,
  `genId` int(11) NOT NULL,
  `startDate` int(11) DEFAULT NULL,
  `stopDate` int(11) DEFAULT NULL,
  `runType` enum('Тест','Аварія') DEFAULT NULL,
  `runResult` enum('Запустився','Не запустився') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `genset__services`
--

CREATE TABLE `genset__services` (
  `id` int(11) NOT NULL,
  `genId` int(11) DEFAULT NULL,
  `serviceDate` int(11) DEFAULT NULL,
  `serviceWorks` varchar(300) DEFAULT NULL,
  `serviceDesc` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `genset__servicetypes`
--

CREATE TABLE `genset__servicetypes` (
  `id` int(11) NOT NULL,
  `servicetype_name` varchar(255) DEFAULT NULL,
  `servicetype_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `genset__servicetypes`
--

INSERT INTO `genset__servicetypes` (`id`, `servicetype_name`, `servicetype_description`) VALUES
(1, 'Заміна масла', ''),
(2, 'Заміна паливного фільтра', ''),
(3, 'Заміна масляного фільтра', ''),
(4, 'Продувка повітряного фільтра', ''),
(5, 'Ремонт паливного насова', ''),
(6, 'Ремонт радіатора', ''),
(7, 'Ремонт регулятора паливного насоса', '');

-- --------------------------------------------------------

--
-- Структура таблиці `genset__types`
--

CREATE TABLE `genset__types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_description` text DEFAULT NULL,
  `litresPerHour` decimal(10,2) NOT NULL,
  `phase` tinyint(255) NOT NULL DEFAULT 1,
  `powerKva` decimal(10,2) UNSIGNED NOT NULL,
  `powerKw` decimal(10,2) UNSIGNED NOT NULL,
  `serviceParameters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп даних таблиці `genset__types`
--

INSERT INTO `genset__types` (`id`, `type_name`, `type_description`, `litresPerHour`, `phase`, `powerKva`, `powerKw`, `serviceParameters`) VALUES
(19, 'OYK-35', 'Turkiye', 20.00, 3, 35.00, 27.50, ''),
(20, 'VSD-20TAJR', 'China', 10.00, 1, 20.00, 16.00, ''),
(21, 'P110-3', 'United Kingdom', 20.00, 3, 110.00, 88.00, ''),
(22, 'VYX-125TAJR', 'China', 10.00, 3, 125.00, 100.00, ''),
(23, 'VYX-187,5TAJR', 'China', 20.00, 3, 187.50, 150.00, ''),
(39, 'DE-170RS ZN', '', 35.00, 3, 170.00, 136.00, ''),
(40, 'OYK-66', 'Turkiye', 20.00, 3, 66.00, 60.00, '');

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Індекси таблиці `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Індекси таблиці `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Індекси таблиці `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `gensets`
--
ALTER TABLE `gensets`
  ADD PRIMARY KEY (`genId`);

--
-- Індекси таблиці `genset__fueltanks`
--
ALTER TABLE `genset__fueltanks`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `genset__refuels`
--
ALTER TABLE `genset__refuels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Genid` (`genId`);

--
-- Індекси таблиці `genset__runs`
--
ALTER TABLE `genset__runs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Genid` (`genId`);

--
-- Індекси таблиці `genset__services`
--
ALTER TABLE `genset__services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Genid` (`genId`);

--
-- Індекси таблиці `genset__servicetypes`
--
ALTER TABLE `genset__servicetypes`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `genset__types`
--
ALTER TABLE `genset__types`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `gensets`
--
ALTER TABLE `gensets`
  MODIFY `genId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблиці `genset__fueltanks`
--
ALTER TABLE `genset__fueltanks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблиці `genset__refuels`
--
ALTER TABLE `genset__refuels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `genset__runs`
--
ALTER TABLE `genset__runs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `genset__services`
--
ALTER TABLE `genset__services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `genset__servicetypes`
--
ALTER TABLE `genset__servicetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблиці `genset__types`
--
ALTER TABLE `genset__types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `genset__refuels`
--
ALTER TABLE `genset__refuels`
  ADD CONSTRAINT `genset__refuels_ibfk_1` FOREIGN KEY (`genId`) REFERENCES `gensets` (`genId`);

--
-- Обмеження зовнішнього ключа таблиці `genset__runs`
--
ALTER TABLE `genset__runs`
  ADD CONSTRAINT `genset__runs_ibfk_1` FOREIGN KEY (`genId`) REFERENCES `gensets` (`genId`);

--
-- Обмеження зовнішнього ключа таблиці `genset__services`
--
ALTER TABLE `genset__services`
  ADD CONSTRAINT `genset__services_ibfk_1` FOREIGN KEY (`genId`) REFERENCES `gensets` (`genId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
