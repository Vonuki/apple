-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 25 2021 г., 03:33
-- Версия сервера: 5.7.23-0ubuntu0.16.04.1
-- Версия PHP: 7.2.11-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `apple`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Apple`
--

CREATE TABLE `Apple` (
  `idApple` int(11) NOT NULL COMMENT 'ID Apple',
  `Color` varchar(20) NOT NULL COMMENT 'Color',
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create Date',
  `FallDate` timestamp NULL DEFAULT NULL COMMENT 'Fall Date',
  `State` int(11) NOT NULL COMMENT 'State of apple',
  `Eaten` int(11) NOT NULL COMMENT 'Percent of eaten'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Apple`
--

INSERT INTO `Apple` (`idApple`, `Color`, `CreateDate`, `FallDate`, `State`, `Eaten`) VALUES
(39, '#c46d8b', '2010-06-10 07:04:44', '2020-10-08 03:10:53', 2, 0),
(42, '#9b3670', '2011-03-26 13:36:49', '2020-10-08 03:22:51', 2, 15),
(52, '#4a202e', '2012-11-10 23:03:16', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1601998633),
('m130524_201442_init', 1601998646),
('m190124_110200_add_verification_token_column_to_user_table', 1601998646);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'demo', 'i55Mkfw9B4VSysAjtDynTVyAV9_JTZW8', '$2y$13$oSuIzujfj.qwW3cTN2SiWuElUaae97AzW8P1kS7H3owNAP2hXRShO', NULL, 'vonuki@gmail.com', 10, 1601998914, 1601999924, 'lTlKGQtc_GmhUo7ui7dxPZupLOg5Nmy3_1601998914');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Apple`
--
ALTER TABLE `Apple`
  ADD PRIMARY KEY (`idApple`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Apple`
--
ALTER TABLE `Apple`
  MODIFY `idApple` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Apple', AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
