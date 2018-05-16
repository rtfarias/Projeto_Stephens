-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Lug 20, 2017 alle 20:45
-- Versione del server: 5.6.28
-- Versione PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instituto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_activations`
--

CREATE TABLE `sis_activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_activations`
--

INSERT INTO `sis_activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'JzZ3iUHJMdRCOFpF22eUQBRtdNyiafzS', 1, '2017-02-21 05:00:34', '2017-02-21 05:00:34', '2017-02-21 05:00:34'),
(2, 3, 'EOerHGgtu7f5KPxZEgC9GMEqEe1XxzL4', 1, '2017-07-20 21:36:06', '2017-07-20 18:36:06', '2017-07-20 18:36:06');

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_basic_info`
--

CREATE TABLE `sis_basic_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `basic_meta_keywords` text,
  `basic_meta_descricao` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sis_basic_info`
--

INSERT INTO `sis_basic_info` (`id`, `title`, `basic_meta_keywords`, `basic_meta_descricao`) VALUES
(1, 'Projeto Laravel', 'projeto,laravel', 'Lorem ipsum dolor sit amet consectetur adisciping elit.');

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_campo_modulo`
--

CREATE TABLE `sis_campo_modulo` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `valor_padrao` text COLLATE utf8_unicode_ci,
  `tipo_campo` enum('I','T','D','DT','N','S','SI','INT','TIME') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'I',
  `id_modulo` int(11) NOT NULL,
  `listagem` tinyint(1) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_fk_modulo`
--

CREATE TABLE `sis_fk_modulo` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `id_modulo_relacionado` int(11) DEFAULT NULL,
  `id_campo_modulo_relacionado` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `listagem` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_migrations`
--

CREATE TABLE `sis_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_modulos`
--

CREATE TABLE `sis_modulos` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_tipo_modulo` int(11) NOT NULL,
  `rota` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `item_modulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `items_modulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `imagem` tinyint(1) DEFAULT NULL,
  `galeria` tinyint(1) DEFAULT NULL,
  `nome_tabela` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_permissions`
--

CREATE TABLE `sis_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_persistences`
--

CREATE TABLE `sis_persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_persistences`
--

INSERT INTO `sis_persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, 'q54Va9selMzze8vEuXxgwg5WVvHdDeXL', '2017-02-21 06:03:58', '2017-02-21 06:03:58'),
(9, 1, 'L14uTfQYx2ktykSwcvNiJ7drbg9oyqzD', '2017-02-21 07:27:42', '2017-02-21 07:27:42'),
(10, 1, 'wFAwNUh6Gt6KtqNJj2i1PE1uBMagia3B', '2017-02-21 07:28:04', '2017-02-21 07:28:04'),
(11, 1, 'yaeqmHF2kGJ3I1Wv8ApE8rufxw0sBpEE', '2017-02-21 07:28:12', '2017-02-21 07:28:12'),
(12, 1, 'GPQzr4oe7zhW6eAQw8eNkT0YjdIvZLyP', '2017-02-21 07:28:20', '2017-02-21 07:28:20'),
(14, 1, 'urJPq0mqtqh2j5WxnvWQSDa1J3gjWFTF', '2017-02-21 07:29:00', '2017-02-21 07:29:00'),
(16, 1, 'fI5YC40RlWXJgiT0qviPi8Yq4kJw5dBg', '2017-02-21 07:31:59', '2017-02-21 07:31:59'),
(18, 1, 'fEpM5GmLmGqxfhW1joTxW6n7kdkt7VD2', '2017-02-21 07:34:28', '2017-02-21 07:34:28'),
(19, 1, 'J99qAqtRGUlKOnGUC2hwI3d7tvX5Xzd8', '2017-02-21 07:34:46', '2017-02-21 07:34:46'),
(20, 1, 'nWiMSrCXykRUBiSV2QqaJbGsxUsYmh2f', '2017-02-21 07:35:53', '2017-02-21 07:35:53'),
(21, 1, 'Sk3HcEqDjxY4CV6Obz0RTsXkpbMlbWF8', '2017-02-21 07:36:10', '2017-02-21 07:36:10'),
(22, 1, 'gTQnYvyNlhjMWk4EwmeE8eZsEFOTGUI5', '2017-02-21 07:36:19', '2017-02-21 07:36:19'),
(23, 1, 'GvIl9vIJCHxA8FFSgMYfNakF5bL4i4eY', '2017-02-21 07:36:42', '2017-02-21 07:36:42'),
(24, 1, 'XPPaDbJllIrbDByZPztxvcsUAwfk9KtK', '2017-02-21 07:36:57', '2017-02-21 07:36:57'),
(26, 1, 'gWHrbkum9V9B6CXBxKLO4UZOAiCUXnuT', '2017-02-21 07:39:46', '2017-02-21 07:39:46'),
(27, 1, 'OLe5pR9l7sLnPhvh08aOFsmlid54UQN8', '2017-02-21 07:40:00', '2017-02-21 07:40:00'),
(28, 1, 'Jz6uKXPTJFC0pl3TCChX3SoOoAF01zLB', '2017-02-21 07:40:51', '2017-02-21 07:40:51'),
(29, 1, 'vC2pMRgOga58rpqdh2J7NioKfMFfgo2d', '2017-02-21 17:34:14', '2017-02-21 17:34:14'),
(30, 1, 'Aj0jzJ1vn3vjfMblqBDP6AeyhCNUWPJr', '2017-02-22 22:28:09', '2017-02-22 22:28:09'),
(31, 1, 'bxlfBc2q6foGwymUenRB86gc7ABjI3e7', '2017-03-13 02:53:28', '2017-03-13 02:53:28'),
(32, 1, 'GNx5bZQHlwIUEScMgGIJwZYSkJabWJ29', '2017-03-13 02:54:07', '2017-03-13 02:54:07'),
(33, 1, 'RGdDrXsINmR82C5eL0qT1KMRnzAGaBsc', '2017-03-13 02:56:15', '2017-03-13 02:56:15'),
(34, 1, 'MTOVghglaZGoBVT1CDgPc69vwNpNdhBk', '2017-03-13 02:56:39', '2017-03-13 02:56:39'),
(36, 1, 'ucN5i16JDUMVySwTy2BDLL7yHA5HlXVt', '2017-03-13 02:59:07', '2017-03-13 02:59:07'),
(37, 1, 'ecvBbzcM453pl9pZaLfmfJU9uFMJmrPe', '2017-03-14 15:24:32', '2017-03-14 15:24:32'),
(38, 1, 'U6vISTTfrOpmRA6rUGvRt4gmfL0XdmMz', '2017-03-14 23:39:58', '2017-03-14 23:39:58'),
(39, 1, 'mYSPu6jZe3eWfFjgYGZGnnmhzVDnScQL', '2017-03-15 16:58:07', '2017-03-15 16:58:07'),
(40, 1, 'SmuvKHIGRtnlQFL9DLz2peaNXlB1uUCY', '2017-03-15 19:52:55', '2017-03-15 19:52:55'),
(41, 1, 'vVFOCcB6Qz0HVsRJ4HrtYBZJ3V0wDDvX', '2017-03-15 21:30:07', '2017-03-15 21:30:07'),
(42, 1, '1S4npWbTJdFyfrV0vID8RTIz07vxAnm3', '2017-03-16 15:22:43', '2017-03-16 15:22:43'),
(43, 1, 'vcWf0c8dBdw8NsB7kfruLB0ZLFIcdEiv', '2017-03-16 21:26:55', '2017-03-16 21:26:55'),
(44, 1, 'j3TQkU26gLxKgP1tjb6TXzwB2yctQolK', '2017-03-17 15:34:47', '2017-03-17 15:34:47'),
(45, 1, 'qWH9MQ6MkNNXjaXUKLkVALY9ZiaWczyy', '2017-03-20 07:50:20', '2017-03-20 07:50:20'),
(46, 1, 'oM5Fkd2z5mAQzaJEywiXusvAU2Q23nXS', '2017-03-20 17:31:00', '2017-03-20 17:31:00'),
(47, 1, 'kVXlbaoIzEAI4b53WUKg2QxRHOQ6uF6l', NULL, NULL),
(48, 1, 'lHrTLp18gO2Tszxo323PDT9UDOpdrzUN', NULL, NULL),
(56, 1, 'wLeLoQDj1ptbOciTaXCJq1lnrSRIPnFF', NULL, NULL),
(57, 1, 'I2MoCLtdgxL3WuV9WnJelhG4h4iKcDdk', NULL, NULL),
(58, 1, 'fCHlk6IKHzx4xjY9q0ydmXjHf5gUwhQi', NULL, NULL),
(59, 1, 'glaKpm2wOkRwLGO3gDvpu7Na1J24qkR7', NULL, NULL),
(60, 1, 'owzhFUNFTW0W2xNsMjZtHOh2AfqfPx1S', NULL, NULL),
(61, 1, 'xlUfdOiigglR5ImGKUQX2rd6tVxEICc9', NULL, NULL),
(62, 1, 'b7pZQfHssvvm7AgXCkpaoUb8Ka7qET9Z', NULL, NULL),
(63, 1, 'xb8YIuJQzhJ0mpdoKSjXPG2GR2pKYKW1', NULL, NULL),
(73, 1, 'q6ls4wIaGWWDfcPPwBKN6S2mhhzvawVw', NULL, NULL),
(75, 1, 'jCHVWcVNPMpMJjdxX544hTMutH03qEVP', NULL, NULL),
(77, 1, 'NHv8GfKjEoUPYW1EDJXeqVbQGPbIyoHw', NULL, NULL),
(78, 1, 'QiRl0XJZLUJnfY9uRH9aNeWDDCHALdgT', NULL, NULL),
(80, 1, 'wJgaNt02Wo5KX3TJ1jEEzZoKsg1VuXX9', NULL, NULL),
(81, 1, 'pPmO5qvY3eVJuzuithJJb6g3rGr5ci46', NULL, NULL),
(82, 1, 'R6EBl85EBoV5IbpJnYqB1EAa7pxpijUC', NULL, NULL),
(83, 1, 'pLsGNyJcEbMh3pf7lHjCO958NSGfTgPO', NULL, NULL),
(84, 1, 'A9T3CATsygiL9JVjvEHWAsBox80R34pG', NULL, NULL),
(85, 1, 'IJ7tzU4wZFg6tzdObmbQZjWWuCVKBJiD', NULL, NULL),
(93, 28, 'SFCt0GRUdF5lXh6lxoXJrMniRFGmerbJ', NULL, NULL),
(94, 1, 'JUMUmsG246sCDIc0R31uttNyjOiA2YWw', NULL, NULL),
(95, 1, 'GeRzBU6XByg0ltYrMEQDW78ZodOjzpEv', NULL, NULL),
(96, 1, 'v4J9sTriiNWS0rGzF9x8x1emW2MQTdJ8', NULL, NULL),
(97, 1, 'UvSCxhRPlUFTQDE9tQRBjJO1Yq7KUGFR', NULL, NULL),
(98, 1, 'h7LiuXKVL2VqQwlpqcng1cFtGVK4CYzE', NULL, NULL),
(99, 1, '3FnzRWV76a6xVMXhtQj3XZXsavFRinpT', NULL, NULL),
(100, 1, '7uaGx8xYKo2QEvuypE3S49oQ7ECmF2Vv', NULL, NULL),
(101, 1, 'YhFT1rQTkrGdOCBe6eVQc9P53v7WHnYu', NULL, NULL),
(102, 1, 'jf82b1ehmxTf7gFnRsSFUQ9zJzCRSQij', NULL, NULL),
(103, 1, 'zDtas6AxfNwwiOvdreP16jQleHORYSaY', NULL, NULL),
(104, 1, 'yZFWQ0mabKoj0YxF5zs7CcXW1yMw9LEG', NULL, NULL),
(105, 1, 'OYHJd8JbkiyZaJAE8T8j0iQYDHpL0Vb9', NULL, NULL),
(106, 1, 'oth27sHaVM8VjcqglLy2IevEy8AV3yPi', NULL, NULL),
(107, 1, 'yjF5xUPmb44NY5vZnTE8T1HKhkM18460', NULL, NULL),
(108, 1, 'oOkBi82jE6WB0M8RS4SuqubQSl0cGhg2', NULL, NULL),
(110, 1, 'koE7BHmFAkn7yDgHZhULJ83HmxFKMEd6', NULL, NULL),
(111, 1, '6SiFEp9mWiEo4MbueE9cH3wZ4tljnpfo', NULL, NULL),
(112, 1, 'ehT4iOAVCFwALb5ShUMrPM2Qbs9AFi5J', NULL, NULL),
(113, 1, 'I6k8SjEQ7wFyfifkiTZnKxd9q7qrw363', NULL, NULL),
(118, 24, 'EuhemWnc9rIgQCl8Ssl9ax5ot8XIdn0Q', NULL, NULL),
(123, 1, 'jL0bFzKszPBl3dd7xJSnX6k2y46Wb3j6', NULL, NULL),
(124, 1, 'vnaj6i8dUwLzaFMbUSidd2dxZUHQnora', NULL, NULL),
(125, 1, 'bgyTXrzmHFtT9djwEMCDJx8XwLf1INMP', NULL, NULL),
(126, 1, 'PBlmfsa24m4kI8ZPPXkioQTAEzRhODJa', NULL, NULL),
(127, 30, 'NeIs4retbbi5IhtcW1PYuIoO1CxeOeOw', NULL, NULL),
(128, 30, 'ZevkdlIRBIV82ka63y07YvtoIuG4PrXr', NULL, NULL),
(129, 30, 'TDhfSg0K1BHRUMRKjNe7fpz0iGF5Prqv', NULL, NULL),
(130, 30, '9u7HVxYK1nUOzEwI94sty1dSa8qWNUjd', NULL, NULL),
(131, 30, 'fu3uxRNLg1ChsNNcN2uKv2qDQDmxoiB2', NULL, NULL),
(132, 30, 'phxqL3aHH57OeIaAAqCUZItlydQqCyLu', NULL, NULL),
(133, 30, 'Ggmguhy1B070G9LS9obNBvAXHwZxvXzc', NULL, NULL),
(134, 30, 'XqkfK9shqmhrkTIuBZEyauaHGgfCtALO', NULL, NULL),
(135, 1, 'Jhb18yvUr9BgyIGHUiijsDjVcOaJ4IA9', NULL, NULL),
(136, 1, '5uUlG95O2AhVBuzLOIuke5T45U7BkQAx', NULL, NULL),
(137, 26, 'eEqoJ9ntUUg8SrUOemZY6Px7zBCij1fU', NULL, NULL),
(138, 26, '4dUciNnb9oZq3Gffw0E7nGNEWNgKNEcA', NULL, NULL),
(139, 26, 'D6QZFYccMr41GahiGmjedyxlnf7QE0op', NULL, NULL),
(140, 1, 'JpZXb2ub1UgqXJHSfVyl5LSiDxhiFYox', NULL, NULL),
(141, 1, 'uImwdnqWPjGTCxzuFJF1rt04ssTFhJKj', NULL, NULL),
(142, 1, 'Lq88hY5BKvihbSXv9PQvqGvjrpN6hW1d', NULL, NULL),
(143, 1, '66eEPSZN4Q1H7spgNCVKXzlS9uw5GpBX', NULL, NULL),
(144, 1, '493eFOsUR7EpJHeMAksMxA5ZfLaxboYZ', NULL, NULL),
(145, 1, 'cxjcbqOezUK2inrqN820Tf54o5jPFKH4', NULL, NULL),
(147, 1, 'mLnL4TfIIlHaOSHOJOAnAEKJZFWpwExl', NULL, NULL),
(149, 1, 'ubtQqLr3nd7TI8IFoS0kgC6wy0if0CnZ', NULL, NULL),
(150, 1, 'TDWIZhMApXvCrO0Dz1BbLr07gF8JkFk8', NULL, NULL),
(151, 1, 'pQfJvN70mfurVmE7TB6ubIdfJlqpfFIr', NULL, NULL),
(152, 1, 'j81ewsZSpQbbzr9sq6snzlZe0ytEEK9A', NULL, NULL),
(153, 1, 'kwMCHt8aBzLPLbsZg9eioKY7ZcqZQ31Q', NULL, NULL),
(154, 1, 'jUyJwZeAhahvGiLumrdp3onNvR7O4s74', NULL, NULL),
(155, 1, 'ikcJwzBNgchrJVjJTCeioCJqs9TXd0nu', NULL, NULL),
(156, 1, 'YfBYxyjitVFQBOQg0uTzcqMls7V0rZDp', NULL, NULL),
(160, 26, 'FF7CYAP5Y9509CCTiUi8b8QnBGGsfR7Y', NULL, NULL),
(162, 26, '9iZoXj4Q7kK6eo5R35VKit4nIgwUNfim', NULL, NULL),
(163, 1, 'G35O7RTmv5KvcrSQEMUsNjcvQhXpznjZ', NULL, NULL),
(181, 1, 'Tc6Ms4Yvg4gzmbnA8GVpHk2rgJzH7s1s', NULL, NULL),
(188, 28, '7PtxwR1tRwOaomdkp5dpZ8GNBJpAhGRQ', NULL, NULL),
(189, 1, 'B8x5AfrPvvIq6iPxR1K78CnAn0SHYSg5', NULL, NULL),
(190, 26, '1v0WIswcEWRu5R1wICFGmCQRPPauAPlO', NULL, NULL),
(191, 1, 'SqKOwuHSigANyvK9Apk4xdJwGBTvITJx', NULL, NULL),
(192, 1, 'DXQ9bgwgPMTeoYki1HiW5IBre1hwUIy8', NULL, NULL),
(193, 28, 'X78WwiFWGq7H4n1ZHJKAD2Yi4TZetctm', NULL, NULL),
(194, 1, 'tK0KmfEpqg3CKDI6t0TEuzlkWTwNikSG', NULL, NULL),
(195, 1, 'AjRHJSNPWCDokKPBEN4dn1dga0pH41lx', NULL, NULL),
(197, 28, 'QlmShCVW8H7bf6Cr4kiy6ah9XhzCsq6R', NULL, NULL),
(198, 1, 'X2uzjMbmINsUjC0f4vEqSAClH7SAe2J2', NULL, NULL),
(207, 26, 'h04ZbXQv6YRlbclfBqQovqqViO2SCnWo', NULL, NULL),
(213, 28, 'JaAaAO9YeItO4P12i3SeBmTXOfW7ocwF', NULL, NULL),
(214, 26, 'SV19Bcy3g0CdAa79VCRm69GwaAcwORS9', NULL, NULL),
(221, 28, 'FAwAYkVIolkHsbgZUWB1os6d0Y7O4PlJ', NULL, NULL),
(236, 26, 'rL4ZjFNQDfJDTOKimz3PS2CSEKWOzvC4', NULL, NULL),
(237, 29, 'SkYnZtfJxuGaWJiIucRfdT370NHtNBai', NULL, NULL),
(238, 1, 'vgMow5cWZ1Nm1hNZtQVhvqN5Twa6zIgs', NULL, NULL),
(240, 26, 'UqFdGFhDxHPExnmzVfYrcRInE5mKxbFO', NULL, NULL),
(241, 1, 'eFUlSOSv8CgKgg8o7lyD6OCRKkf1AFXg', NULL, NULL),
(242, 1, 'aQue931rxH3Ba4hjYFlNK8yUpQ7RAE2b', NULL, NULL),
(243, 1, 'yCNHI5w6pasw1caSHo8OCMSXQg0kTNew', NULL, NULL),
(244, 1, 'fzadtgnVTBZs9NKZKd39IWtYckytVpSG', NULL, NULL),
(247, 28, 'GIDiaU3XnhQPdCRSsVmm60BacJJZmwda', NULL, NULL),
(251, 26, '0xNUsKx2kiawzKQDbl00QgDUpsgiXqsu', NULL, NULL),
(252, 1, 'XG8Gijqp1Z3qjUFe3xNq6ksfQGpPA9Ko', NULL, NULL),
(253, 1, '51L3A7erJZms1z4wUZzUYnGMhaJCAVlh', NULL, NULL),
(254, 1, 'cQBAZLtwnJio4bg46scLNiLWqtXsWabF', NULL, NULL),
(255, 1, 'nudNpbE42wUunRKiErsTcwDK4ZqeCfVQ', NULL, NULL),
(256, 1, 'ybfrjkZC2KwX8LznMcngrem3KMHbnGAE', NULL, NULL),
(265, 29, 'AeyXQwxLspfTdKJwNc7FweB0XitctaJ0', NULL, NULL),
(267, 29, '6CLK10IurZw3myQP6iKrklUxVBwug8Wu', NULL, NULL),
(269, 26, 'GwvjlrtpzbuDri4Afr7bgKMZ8RjZMe3f', NULL, NULL),
(272, 26, 'MlKzxU2jwVdIYaQEOqVdC5ul8jNlLWKv', NULL, NULL),
(273, 26, 'XvqDjsk8oI61FqtdA2FjpVl6LE2GQNAj', NULL, NULL),
(275, 26, '4oKQQW1sj7Zs9FKvYotzM0g6zsXDwoIi', NULL, NULL),
(276, 1, 'd1JT5TXMyHC66GvCXOBoDTkwzIrqckEu', NULL, NULL),
(277, 1, 'clLqhW8NwwGwU0YWv5xq4mp9ZpPSvVHg', NULL, NULL),
(278, 1, 'eaaMyYDCeKq9PenXNAdd0YB0jnOUsglx', NULL, NULL),
(279, 1, 'hZic7uORZJuvfIesh9UL2E8A66AMu5ea', NULL, NULL),
(281, 529, 'hGuRwii6oEQH0Eq9IbdQD0SUIcXQTNqj', NULL, NULL),
(283, 593, 'bSyJLvaQotrQxygeCI5VKVdDFnAFEFPe', NULL, NULL),
(285, 657, 'wSV24tw6HTzwuj80XBWznI7VIk7NpaUJ', NULL, NULL),
(286, 1, 'GfHkv5JYjS8PDM5XVZJN3BiGqeotuYpa', NULL, NULL),
(292, 26, 'aN5YbYKHYMmnFVgjhbyNeW4z89in4S1N', NULL, NULL),
(293, 1, 'yiP5MjoX8Mspwvng9XliOvfHPEhuAnU4', NULL, NULL),
(299, 26, 'QJIOR6eOb774mw98zm1fXFsTDb3B2OtY', NULL, NULL),
(300, 1, 'pcf2tqq4rV3Das1Hlhd31xCiNO3rNArj', NULL, NULL),
(301, 1, 'HxlW0gN45PLoHRXGznPi33L50LJNqsgh', NULL, NULL),
(303, 3, 'HZX97LjILklbaoRt4NP1ighp5fX1L4nd', NULL, NULL),
(304, 1, 'g4ACjymOOcQRN7a10SOvO0oSYzz6wZHT', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_reminders`
--

CREATE TABLE `sis_reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_roles`
--

CREATE TABLE `sis_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_roles`
--

INSERT INTO `sis_roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admins', 'Administradores', '', '2017-07-20 18:32:20', '2017-07-20 18:32:20');

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_role_users`
--

CREATE TABLE `sis_role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_role_users`
--

INSERT INTO `sis_role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-06-28 03:02:40', '2017-06-28 03:02:40'),
(3, 2, '2017-07-20 21:36:06', '2017-07-20 21:36:06');

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_throttle`
--

CREATE TABLE `sis_throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_throttle`
--

INSERT INTO `sis_throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2017-02-20 22:42:35', '2017-02-20 22:42:35'),
(2, NULL, 'ip', '::1', '2017-02-20 22:42:35', '2017-02-20 22:42:35'),
(3, NULL, 'global', NULL, '2017-02-20 22:43:02', '2017-02-20 22:43:02'),
(4, NULL, 'ip', '::1', '2017-02-20 22:43:02', '2017-02-20 22:43:02'),
(5, NULL, 'global', NULL, '2017-02-20 22:44:29', '2017-02-20 22:44:29'),
(6, NULL, 'ip', '::1', '2017-02-20 22:44:29', '2017-02-20 22:44:29'),
(7, NULL, 'global', NULL, '2017-02-20 22:44:29', '2017-02-20 22:44:29'),
(8, NULL, 'ip', '::1', '2017-02-20 22:44:29', '2017-02-20 22:44:29'),
(9, NULL, 'global', NULL, '2017-02-20 22:44:41', '2017-02-20 22:44:41'),
(10, NULL, 'ip', '::1', '2017-02-20 22:44:41', '2017-02-20 22:44:41'),
(11, NULL, 'global', NULL, '2017-02-20 22:44:57', '2017-02-20 22:44:57'),
(12, NULL, 'ip', '::1', '2017-02-20 22:44:57', '2017-02-20 22:44:57'),
(13, NULL, 'global', NULL, '2017-02-21 00:17:11', '2017-02-21 00:17:11'),
(14, NULL, 'ip', '::1', '2017-02-21 00:17:11', '2017-02-21 00:17:11'),
(15, NULL, 'global', NULL, '2017-02-21 04:07:15', '2017-02-21 04:07:15'),
(16, NULL, 'ip', '::1', '2017-02-21 04:07:15', '2017-02-21 04:07:15'),
(17, 2, 'user', NULL, '2017-02-21 04:07:15', '2017-02-21 04:07:15'),
(18, NULL, 'global', NULL, '2017-02-21 04:08:38', '2017-02-21 04:08:38'),
(19, NULL, 'ip', '::1', '2017-02-21 04:08:38', '2017-02-21 04:08:38'),
(20, 2, 'user', NULL, '2017-02-21 04:08:38', '2017-02-21 04:08:38'),
(21, NULL, 'global', NULL, '2017-02-21 04:10:41', '2017-02-21 04:10:41'),
(22, NULL, 'ip', '::1', '2017-02-21 04:10:41', '2017-02-21 04:10:41'),
(23, 2, 'user', NULL, '2017-02-21 04:10:41', '2017-02-21 04:10:41'),
(24, NULL, 'global', NULL, '2017-02-21 04:52:18', '2017-02-21 04:52:18'),
(25, NULL, 'ip', '::1', '2017-02-21 04:52:18', '2017-02-21 04:52:18'),
(26, NULL, 'global', NULL, '2017-02-21 06:02:11', '2017-02-21 06:02:11'),
(27, NULL, 'ip', '::1', '2017-02-21 06:02:11', '2017-02-21 06:02:11'),
(28, NULL, 'global', NULL, '2017-02-21 06:02:47', '2017-02-21 06:02:47'),
(29, NULL, 'ip', '::1', '2017-02-21 06:02:47', '2017-02-21 06:02:47'),
(30, NULL, 'global', NULL, '2017-03-13 02:51:35', '2017-03-13 02:51:35'),
(31, NULL, 'ip', '::1', '2017-03-13 02:51:35', '2017-03-13 02:51:35'),
(32, NULL, 'global', NULL, '2017-03-13 02:51:46', '2017-03-13 02:51:46'),
(33, NULL, 'ip', '::1', '2017-03-13 02:51:46', '2017-03-13 02:51:46'),
(34, NULL, 'global', NULL, '2017-03-13 02:51:57', '2017-03-13 02:51:57'),
(35, NULL, 'ip', '::1', '2017-03-13 02:51:57', '2017-03-13 02:51:57'),
(36, NULL, 'global', NULL, '2017-03-13 02:52:11', '2017-03-13 02:52:11'),
(37, NULL, 'ip', '::1', '2017-03-13 02:52:11', '2017-03-13 02:52:11'),
(38, NULL, 'global', NULL, '2017-03-14 15:24:14', '2017-03-14 15:24:14'),
(39, NULL, 'ip', '::1', '2017-03-14 15:24:14', '2017-03-14 15:24:14'),
(40, NULL, 'global', NULL, '2017-03-14 15:24:21', '2017-03-14 15:24:21'),
(41, NULL, 'ip', '::1', '2017-03-14 15:24:21', '2017-03-14 15:24:21'),
(42, NULL, 'global', NULL, '2017-03-14 23:39:54', '2017-03-14 23:39:54'),
(43, NULL, 'ip', '::1', '2017-03-14 23:39:54', '2017-03-14 23:39:54'),
(44, NULL, 'global', NULL, NULL, NULL),
(45, NULL, 'ip', '::1', NULL, NULL),
(46, 3, 'user', NULL, NULL, NULL),
(47, NULL, 'global', NULL, NULL, NULL),
(48, NULL, 'ip', '::1', NULL, NULL),
(49, 3, 'user', NULL, NULL, NULL),
(50, NULL, 'global', NULL, NULL, NULL),
(51, NULL, 'ip', '::1', NULL, NULL),
(52, 3, 'user', NULL, NULL, NULL),
(53, NULL, 'global', NULL, NULL, NULL),
(54, NULL, 'ip', '::1', NULL, NULL),
(55, NULL, 'global', NULL, NULL, NULL),
(56, NULL, 'ip', '::1', NULL, NULL),
(57, NULL, 'global', NULL, NULL, NULL),
(58, NULL, 'ip', '::1', NULL, NULL),
(59, NULL, 'global', NULL, NULL, NULL),
(60, NULL, 'ip', '::1', NULL, NULL),
(61, NULL, 'global', NULL, NULL, NULL),
(62, NULL, 'ip', '127.0.0.1', NULL, NULL),
(63, NULL, 'global', NULL, NULL, NULL),
(64, NULL, 'ip', '127.0.0.1', NULL, NULL),
(65, NULL, 'global', NULL, NULL, NULL),
(66, NULL, 'ip', '127.0.0.1', NULL, NULL),
(67, NULL, 'global', NULL, NULL, NULL),
(68, NULL, 'ip', '127.0.0.1', NULL, NULL),
(69, NULL, 'global', NULL, NULL, NULL),
(70, NULL, 'ip', '127.0.0.1', NULL, NULL),
(71, NULL, 'global', NULL, NULL, NULL),
(72, NULL, 'ip', '127.0.0.1', NULL, NULL),
(73, NULL, 'global', NULL, NULL, NULL),
(74, NULL, 'ip', '127.0.0.1', NULL, NULL),
(75, NULL, 'global', NULL, NULL, NULL),
(76, NULL, 'ip', '127.0.0.1', NULL, NULL),
(77, NULL, 'global', NULL, NULL, NULL),
(78, NULL, 'ip', '127.0.0.1', NULL, NULL),
(79, NULL, 'global', NULL, NULL, NULL),
(80, NULL, 'ip', '127.0.0.1', NULL, NULL),
(81, NULL, 'global', NULL, NULL, NULL),
(82, NULL, 'ip', '127.0.0.1', NULL, NULL),
(83, NULL, 'global', NULL, NULL, NULL),
(84, NULL, 'ip', '127.0.0.1', NULL, NULL),
(85, 26, 'user', NULL, NULL, NULL),
(86, NULL, 'global', NULL, NULL, NULL),
(87, NULL, 'ip', '127.0.0.1', NULL, NULL),
(88, 34, 'user', NULL, NULL, NULL),
(89, NULL, 'global', NULL, NULL, NULL),
(90, NULL, 'ip', '::1', NULL, NULL),
(91, 1, 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_tipos_modulo`
--

CREATE TABLE `sis_tipos_modulo` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `controller_admin` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_admin_index` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_admin_form` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rotas` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_tipos_modulo`
--

INSERT INTO `sis_tipos_modulo` (`id`, `nome`, `controller_admin`, `model`, `view_admin_index`, `view_admin_form`, `rotas`) VALUES
(1, 'Complexo', 'controller_admin_com_detalhe.php', 'model_com_detalhe.php', 'view_admin_index_com_detalhe.php', 'view_admin_form_com_detalhe.php', 'rotas_com_detalhe.php'),
(2, 'Simples', 'controller_admin_sem_detalhe.php', 'model_sem_detalhe.php', 'view_admin_index_sem_detalhe.php', '', 'rotas_sem_detalhe.php'),
(3, 'Relacional', NULL, 'model_relacional.php', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `sis_users`
--

CREATE TABLE `sis_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receber_notificacoes` tinyint(1) NOT NULL DEFAULT '0',
  `thumbnail_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_condomino` int(11) DEFAULT NULL,
  `id_criador` int(11) DEFAULT NULL,
  `udid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `sis_users`
--

INSERT INTO `sis_users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `receber_notificacoes`, `thumbnail_principal`, `id_condomino`, `id_criador`, `udid`) VALUES
(1, 'ricardo@duostudio.com.br', '$2y$10$VgZS1ekY.VDD7sPkQK92PerIoQfhcfxkKL8HcitH41c2Y/5luvZxS', NULL, '2017-07-20 21:44:27', 'Murilo', 'Tronca', '2017-02-21 05:00:34', '2017-03-20 17:31:00', 0, 'thumb_1498608152-user2-160x160.jpg', NULL, NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `sis_activations`
--
ALTER TABLE `sis_activations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_basic_info`
--
ALTER TABLE `sis_basic_info`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_campo_modulo`
--
ALTER TABLE `sis_campo_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_fk_modulo`
--
ALTER TABLE `sis_fk_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_modulos`
--
ALTER TABLE `sis_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_permissions`
--
ALTER TABLE `sis_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_persistences`
--
ALTER TABLE `sis_persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indici per le tabelle `sis_reminders`
--
ALTER TABLE `sis_reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_roles`
--
ALTER TABLE `sis_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indici per le tabelle `sis_role_users`
--
ALTER TABLE `sis_role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indici per le tabelle `sis_throttle`
--
ALTER TABLE `sis_throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indici per le tabelle `sis_tipos_modulo`
--
ALTER TABLE `sis_tipos_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sis_users`
--
ALTER TABLE `sis_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_condomino` (`id_condomino`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `sis_activations`
--
ALTER TABLE `sis_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `sis_basic_info`
--
ALTER TABLE `sis_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `sis_campo_modulo`
--
ALTER TABLE `sis_campo_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `sis_fk_modulo`
--
ALTER TABLE `sis_fk_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `sis_modulos`
--
ALTER TABLE `sis_modulos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `sis_permissions`
--
ALTER TABLE `sis_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `sis_persistences`
--
ALTER TABLE `sis_persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT per la tabella `sis_reminders`
--
ALTER TABLE `sis_reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `sis_roles`
--
ALTER TABLE `sis_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `sis_throttle`
--
ALTER TABLE `sis_throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT per la tabella `sis_tipos_modulo`
--
ALTER TABLE `sis_tipos_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `sis_users`
--
ALTER TABLE `sis_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `sis_users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
