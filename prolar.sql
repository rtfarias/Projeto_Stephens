-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2018 at 02:17 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prolar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cidades`
--

INSERT INTO `cidades` (`id`, `thumbnail_principal`, `meta_keywords`, `meta_descricao`, `slug`, `cidade`, `estado`) VALUES
(1, NULL, NULL, NULL, '', 'Caxias do Sul', 23),
(2, NULL, NULL, NULL, '', 'Bento Gonçalves', 23);

-- --------------------------------------------------------

--
-- Table structure for table `cidades_imagens`
--

CREATE TABLE `cidades_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_cidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(75) DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `pais` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `estado`, `sigla`, `pais`) VALUES
(1, 'Acre', 'AC', 1),
(2, 'Alagoas', 'AL', 1),
(3, 'Amazonas', 'AM', 1),
(4, 'Amapá', 'AP', 1),
(5, 'Bahia', 'BA', 1),
(6, 'Ceará', 'CE', 1),
(7, 'Distrito Federal', 'DF', 1),
(8, 'Espírito Santo', 'ES', 1),
(9, 'Goiás', 'GO', 1),
(10, 'Maranhão', 'MA', 1),
(11, 'Minas Gerais', 'MG', 1),
(12, 'Mato Grosso do Sul', 'MS', 1),
(13, 'Mato Grosso', 'MT', 1),
(14, 'Pará', 'PA', 1),
(15, 'Paraíba', 'PB', 1),
(16, 'Pernambuco', 'PE', 1),
(17, 'Piauí', 'PI', 1),
(18, 'Paraná', 'PR', 1),
(19, 'Rio de Janeiro', 'RJ', 1),
(20, 'Rio Grande do Norte', 'RN', 1),
(21, 'Rondônia', 'RO', 1),
(22, 'Roraima', 'RR', 1),
(23, 'Rio Grande do Sul', 'RS', 1),
(24, 'Santa Catarina', 'SC', 1),
(25, 'Sergipe', 'SE', 1),
(26, 'São Paulo', 'SP', 1),
(27, 'Tocantins', 'TO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fornecedores_categorias`
--

CREATE TABLE `fornecedores_categorias` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL DEFAULT '0',
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `reparo_emergencial` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fornecedores_categorias`
--

INSERT INTO `fornecedores_categorias` (`id`, `id_fornecedor`, `id_categoria`, `reparo_emergencial`, `criado_em`) VALUES
(236, 152, 196, 0, '2017-09-29 17:43:15'),
(237, 152, 198, 0, '2017-09-29 17:43:15'),
(238, 152, 197, 0, '2017-09-29 17:43:15'),
(239, 152, 199, 1, '2017-09-29 17:43:15'),
(240, 1, 196, 0, '2017-10-21 13:07:47'),
(241, 1, 197, 0, '2017-10-21 13:07:47'),
(242, 1, 198, 0, '2017-10-21 13:07:47'),
(243, 1, 199, 0, '2017-10-21 13:07:47'),
(244, 1, 200, 0, '2017-10-21 13:07:47'),
(245, 1, 201, 0, '2017-10-21 13:07:47'),
(246, 1, 202, 0, '2017-10-21 13:07:47'),
(247, 1, 203, 0, '2017-10-21 13:07:47'),
(248, 1, 204, 0, '2017-10-21 13:07:47'),
(249, 1, 205, 0, '2017-10-21 13:07:47'),
(250, 1, 206, 0, '2017-10-21 13:07:47'),
(251, 1, 207, 0, '2017-10-21 13:07:47'),
(252, 8, 199, 1, '2017-10-21 13:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `mensagem` text,
  `id_solicitacao` int(11) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `enviado_por` int(1) NOT NULL DEFAULT '0' COMMENT '0 = cliente, 1 = fornecedor',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mensagens`
--

INSERT INTO `mensagens` (`id`, `mensagem`, `id_solicitacao`, `id_cliente`, `id_fornecedor`, `enviado_por`, `criado_em`) VALUES
(1, 'askldjf ksj lksaj flksaj flaskj flksajf laskj flaskj laskj ', 1, 1, 1, 0, '2017-09-28 12:53:13'),
(2, NULL, 14, 1, 2, 0, '2017-09-28 12:53:13'),
(3, NULL, 14, 1, 1, 0, '2017-09-28 12:53:13'),
(4, NULL, 14, 1, 1, 1, '2017-09-28 12:53:13'),
(5, 'asdfaasfd', 1, 1, 1, 1, '2017-09-28 19:30:02'),
(6, 'asdfaasfd2', 1, 1, 1, 1, '2017-09-28 20:08:03'),
(7, 'asdfaasfd2', 1, 1, 1, 1, '2017-09-28 20:09:02'),
(8, 'asdfaasfd2', 1, 1, 1, 1, '2017-09-28 20:10:02'),
(9, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 26, 1, 1, 0, '2017-10-21 13:21:57'),
(10, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 27, 1, 1, 0, '2017-10-21 13:22:24'),
(11, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 28, 1, 1, 0, '2017-10-21 13:23:55'),
(12, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 29, 1, 1, 0, '2017-10-21 13:24:31'),
(13, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 30, 1, 1, 0, '2017-10-21 13:24:53'),
(14, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 31, 1, 1, 0, '2017-10-21 13:45:55'),
(15, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 32, 1, 1, 0, '2017-10-21 13:47:04'),
(16, 'mansndkaslnflksdfl  ds laskd ds dffgdfgfdgs ', 33, 1, 8, 0, '2017-10-21 13:57:28'),
(17, '', 0, 1, 1, 0, '2017-10-21 15:21:17'),
(18, '', 0, 1, 1, 0, '2017-10-21 15:22:21'),
(19, '', 0, 1, 1, 0, '2017-10-21 15:22:30'),
(20, '', 0, 1, 1, 0, '2017-10-21 15:23:35'),
(21, '', 0, 1, 1, 0, '2017-10-21 15:24:51'),
(22, '', 0, 1, 1, 0, '2017-10-21 15:27:54'),
(23, '', 0, 1, 1, 0, '2017-10-21 15:28:37'),
(24, '', 34, 1, 1, 0, '2017-10-21 15:31:41'),
(25, '', 35, 1, 1, 0, '2017-10-21 16:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `sis_activations`
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
-- Dumping data for table `sis_activations`
--

INSERT INTO `sis_activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'JzZ3iUHJMdRCOFpF22eUQBRtdNyiafzS', 1, '2017-02-21 05:00:34', '2017-02-21 05:00:34', '2017-02-21 05:00:34'),
(2, 3, 'EOerHGgtu7f5KPxZEgC9GMEqEe1XxzL4', 1, '2017-07-20 21:36:06', '2017-07-20 18:36:06', '2017-07-20 18:36:06'),
(3, 18, 'L7JIE3shD42UFm5x5DAaqPn8vVXaOOzP', 1, '2017-07-20 23:52:53', '2017-07-20 20:52:53', '2017-07-20 20:52:53'),
(4, 19, 'eGD1TfeQ483a96BKOtT2mTaUtjdSmZ4G', 1, '2017-07-21 00:00:00', '2017-07-20 21:00:00', '2017-07-20 21:00:00'),
(5, 20, 'dNunJ2d74xQAwo7UJYZfP13CYC3jaaNM', 1, '2017-07-21 00:00:21', '2017-07-20 21:00:21', '2017-07-20 21:00:21'),
(6, 28, 'PIogDj5c65rXg6VeMLmBaayjo8loNH5T', 1, '2017-07-21 16:06:48', '2017-07-21 13:06:48', '2017-07-21 13:06:48'),
(7, 2, 'DNNqNTL8TTyQBnrUbofBd3aRlt6ue0Zm', 1, '2017-07-24 21:12:40', '2017-07-24 18:12:40', '2017-07-24 18:12:40'),
(8, 3, 'V37BxIGjUvJM8bQOC03OPNnVpdqUvhHk', 1, '2017-07-24 21:23:09', '2017-07-24 18:23:09', '2017-07-24 18:23:09'),
(9, 5, 'Ud2OTH8cv7h71EYPh7QplXXL9JAOcuG1', 1, '2017-07-24 21:30:01', '2017-07-24 18:30:01', '2017-07-24 18:30:01'),
(10, 6, 'yMGgLuLuQ2CRYtV5jnWZDU8aEMKpMQgA', 1, '2017-07-26 00:32:15', '2017-07-25 21:32:15', '2017-07-25 21:32:15'),
(11, 7, 'BNKjjdd7DdtzxZwJGh9tKbBj5XmIuWKB', 1, '2017-07-27 17:45:54', '2017-07-27 14:45:54', '2017-07-27 14:45:54'),
(12, 8, 'gl1jPxTYWS2wNW1b6Wyg8Fx9HyUN4OeB', 1, '2017-08-22 21:22:57', '2017-08-22 18:22:57', '2017-08-22 18:22:57'),
(13, 8, 'snuhLqGnumJI7r5wpIsk3GMB8w4Cehu2', 1, '2017-08-29 17:45:26', '2017-08-29 14:45:26', '2017-08-29 14:45:26'),
(14, 9, 'LVVbEO6XCBQlSsgzz4ZklOCplyznfEz9', 1, '2017-09-29 20:49:08', '2017-09-29 17:49:08', '2017-09-29 17:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `sis_basic_info`
--

CREATE TABLE `sis_basic_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `basic_meta_keywords` text,
  `basic_meta_descricao` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sis_basic_info`
--

INSERT INTO `sis_basic_info` (`id`, `title`, `basic_meta_keywords`, `basic_meta_descricao`) VALUES
(1, 'Projeto Laravel', 'projeto,laravel', 'Lorem ipsum dolor sit amet consectetur adisciping elit.');

-- --------------------------------------------------------

--
-- Table structure for table `sis_campo_modulo`
--

CREATE TABLE `sis_campo_modulo` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `valor_padrao` text COLLATE utf8_unicode_ci,
  `tipo_campo` enum('I','T','D','DT','N','S','SI','INT','TIME','SC') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'I',
  `id_modulo` int(11) NOT NULL,
  `listagem` tinyint(1) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_campo_modulo`
--

INSERT INTO `sis_campo_modulo` (`id`, `label`, `nome`, `valor_padrao`, `tipo_campo`, `id_modulo`, `listagem`, `required`, `ordem`) VALUES
(18, 'estado', 'estado', '', 'I', 5, 0, 0, 0),
(19, 'sigla', 'sigla', '', 'I', 5, 0, 0, 0),
(99, 'Cidade', 'cidade', '', 'I', 20, 1, 1, 0),
(116, 'Nome', 'nome', '', 'I', 24, 1, 1, 0),
(117, 'Telefone', 'telefone', '', 'I', 24, 1, 1, 0),
(118, 'CEP', 'cep', '', 'I', 24, 1, 1, 0),
(119, 'Endereço', 'endereco', '', 'I', 24, 1, 1, 0),
(120, 'País', 'pais', '', 'I', 24, 1, 1, 0),
(121, 'Estado', 'estado', '', 'I', 24, 1, 1, 0),
(122, 'Cidade', 'cidade', '', 'I', 24, 1, 1, 0),
(123, 'CPF', 'cpf', '', 'I', 24, 1, 1, 0),
(124, 'E-mail', 'email', '', 'I', 24, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sis_fk_modulo`
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

--
-- Dumping data for table `sis_fk_modulo`
--

INSERT INTO `sis_fk_modulo` (`id`, `id_modulo`, `id_modulo_relacionado`, `id_campo_modulo_relacionado`, `nome`, `label`, `ordem`, `listagem`) VALUES
(19, 20, 5, 19, 'estado', 'Estado', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sis_migrations`
--

CREATE TABLE `sis_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sis_modulos`
--

CREATE TABLE `sis_modulos` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordem` int(11) NOT NULL DEFAULT '0',
  `menu` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_tipo_modulo` int(11) NOT NULL,
  `rota` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `item_modulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `items_modulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `imagem` tinyint(1) DEFAULT NULL,
  `galeria` tinyint(1) DEFAULT NULL,
  `nome_tabela` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_modulos`
--

INSERT INTO `sis_modulos` (`id`, `label`, `icone`, `ordem`, `menu`, `nome`, `id_tipo_modulo`, `rota`, `item_modulo`, `items_modulo`, `imagem`, `galeria`, `nome_tabela`) VALUES
(5, 'Estados', 'fa-circle-o', 0, 0, 'Estados', 3, 'estados', 'estado', 'estados', 0, 0, 'estados'),
(20, 'Cadastro de Cidades', 'ion-ios-location', 1, 0, 'Cidades', 1, 'cidades', 'cidade', 'cidades', 0, 0, 'cidades'),
(24, 'Usuários', 'fa-circle-o', 0, 1, 'Usuarios', 1, 'usuarios', 'usuario', 'usuarios', 1, 0, 'usuarios');

-- --------------------------------------------------------

--
-- Table structure for table `sis_password_resets`
--

CREATE TABLE `sis_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_password_resets`
--

INSERT INTO `sis_password_resets` (`email`, `token`, `created_at`) VALUES
('ricardo@duostudio.com.br', '90ef608815c0452c4e041acb3ea1e64735458ff42b79537b383d7293f15b7733', '2017-08-23 17:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `sis_permissions`
--

CREATE TABLE `sis_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sis_persistences`
--

CREATE TABLE `sis_persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_persistences`
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
(304, 1, 'g4ACjymOOcQRN7a10SOvO0oSYzz6wZHT', NULL, NULL),
(306, 1, 'EaiQXLztfEObgehV7pxhkYxcowMpRCcU', NULL, NULL),
(311, 1, 'qfUForD7UPePrQto5sKaOplcZ1Th5G2z', NULL, NULL),
(312, 1, '78bbIiNRVb3LjrF4FHkQ6m22Lq1o7NQ1', NULL, NULL),
(313, 1, 'ZHABCGXZcEuFsIhCyotBMaQb6bD5vWe2', NULL, NULL),
(314, 1, 'qnZweOfb12E4Um7Chp5PluAFIqvEjsGo', NULL, NULL),
(315, 1, 'vkAFecBmxcQKz2uWrRdL9ONX9B3CktLc', NULL, NULL),
(317, 7, 'VigIHzKPNXvgxT54wcIKIAbVas66op0Y', NULL, NULL),
(318, 1, 'Bf8Rq5lluhq3SxCw5RGKvWQwwrUMCocQ', NULL, NULL),
(319, 1, 'F9T1MGhRMokuz79Cql3qNyi3JLOllyHM', NULL, NULL),
(320, 1, 'SZTl4PCkc5RPZJz7Tx6D78WYoLByXzs7', NULL, NULL),
(321, 1, '0OVjE2diMVORk3MVw1gKb8UeQGuDvzgZ', NULL, NULL),
(323, 2, '2drsYZzymzDYrPY6WBlne20Y74sF915V', NULL, NULL),
(325, 2, 'VXdembmBTUi2U7rOl2ls5j4PVAmBQLo0', NULL, NULL),
(326, 2, '4wcF5jJilwIk9i5kuS5hLUi5ce0qizVc', NULL, NULL),
(328, 2, 'ES9xPce7iJgcMDhRODkerkHm6sy01j5K', NULL, NULL),
(329, 2, 'x1VWt5Kb0iEMmiBIW651EqOEEfbmFjnC', NULL, NULL),
(330, 2, 'CRuiDaRVJD69YezZGcX3Vg3tdUOMMR2P', NULL, NULL),
(331, 2, 'miarcm2CcRduXQC1Ovl5kfBZlYQdjnZW', NULL, NULL),
(337, 1, 'eUrwPELuAgYJAozgeccLIJ7yXW6D1mkS', NULL, NULL),
(338, 1, 'g3KfhgJIseymsOog2VfzPMd1mLQ2EaWe', NULL, NULL),
(339, 1, 'CxnNpei8XM3m43OZgUJ9ad6PHxvuyv5s', NULL, NULL),
(344, 2, 'PFGSEn21Lh6yWj1obxOF2Ktd0NE8EerA', NULL, NULL),
(349, 2, '6n27VF2TpjtMNLcziwXcVGQNrcfIWiw4', NULL, NULL),
(350, 2, 'fEowxFq0Y5s5aLgLIdcyxwRnE5rsoCP7', NULL, NULL),
(351, 1, 'SLXithOsqsG3AesecDwIenQCSPbBbcSJ', NULL, NULL),
(362, 2, 'Jd6YE1nh4zfpZV7eiL3GuXw5KKiQXJuC', NULL, NULL),
(363, 2, 'OIac6m0AIXy0Ponpk3Y0rxUwzvRcWB76', NULL, NULL),
(366, 2, 'NZHeLj9Bb86vQy3M2FJJjQ8poMwTWmfA', NULL, NULL),
(367, 1, 'uO0RAtmGC4MOBuEFNhlvcMoBBqcU48JJ', NULL, NULL),
(368, 1, 'FAMatnu5brhc7NpW8IjuKETXfuApsXQe', NULL, NULL),
(369, 1, 'Go0pRsPpfTi0T0w3bFoP8I8NBsMC0XMm', NULL, NULL),
(372, 2, 's05j6mJLSrvhGpLXhcnODUDquSE0q3mI', NULL, NULL),
(374, 1, 'LjoLg3byzoVhSg5Ya71bkDTttzogTHkk', NULL, NULL),
(375, 2, '2evydFlz90uGFQzOAPwuDwHkK0f96XuJ', NULL, NULL),
(376, 1, '2OCoUMhOYdIPsSGnXgdUsHIEb2vwoY0t', NULL, NULL),
(378, 1, 'Hdog3kzXJWM7cKFyN0NKLb06ozjIXxzn', NULL, NULL),
(382, 1, 'eEiVSiYZMPAToQenjwXYp0ViUBDHebV2', NULL, NULL),
(384, 1, 'Wro1D5yD302bPm6kOoFxohAxXG06hSeP', NULL, NULL),
(385, 1, 'uoC841mnLH5PhQaDgBDTJoMuR5vOFyJF', NULL, NULL),
(386, 1, 'fuGQgtqDVLd57masGHry4Z8IVgEMKsTp', NULL, NULL),
(388, 1, 'K4sthm5SsZmZC8lMkjLgMafF5wXIEZkK', NULL, NULL),
(389, 1, 'cNffnTcoi3xHdHn2QlkrBbOSLKOgHDUp', NULL, NULL),
(390, 1, 'PHk8lafM70jDqVVEC3YU1fiTgUiyOFHF', NULL, NULL),
(391, 1, 'lCWNdfDN1AxteMpX5VAVj6s6XNTy9IIe', NULL, NULL),
(392, 1, 'tdFzy4lMxJvLNoJODGDOsHDWYq3LwzPe', NULL, NULL),
(393, 1, 'PrTUerIAf6CBXSb4a0bKt8WTH5BU2nbT', NULL, NULL),
(394, 1, 'NR8jqyT543qPeBEizUFt9XTstomf023O', NULL, NULL),
(395, 1, 'fq9VZXhEBkLmZWkLGLRvas4KJb27QvZ6', NULL, NULL),
(396, 1, 'jRH4gtA59CnVQTpRXb0zBC9AlnFy7bHq', NULL, NULL),
(397, 1, 'O3osnH2jhDnMAQbHILWnOvrqAVG2o2qt', NULL, NULL),
(398, 1, 'tkQa0TizA99Tg49hDSQT5l6s1wZa9Gyj', NULL, NULL),
(399, 1, 'VfdNIxPgmySXLI6bQe0ijJZ5Bd7TImWx', NULL, NULL),
(400, 1, 'O6Xk9QoVwkYZIG4FqJ6sZtkyPdDnNCUH', NULL, NULL),
(401, 1, 'IhoFYzHv68T7Av6USJpF2zKxTOXjGxEm', NULL, NULL),
(402, 1, 'JSk9M6j6PCZesN46fA7YqFuZ9mBytcG5', NULL, NULL),
(403, 1, 'orium972QQVUrewz79MQV3WaXpUXvEgO', NULL, NULL),
(404, 1, 'cdYOcZKG0F4rtyaQit5K5klIiIp7DY37', NULL, NULL),
(405, 1, 'MuOm6EbuKiwzOiN7YUUU6A5mmGj1DZqq', NULL, NULL),
(406, 1, 'NuEI1nTMFtuZnp8jKyrlaFGyKJ46wYRr', NULL, NULL),
(407, 1, 'g6fM8OAsO7LM6PcDjy7YkauAesLFDdKe', NULL, NULL),
(408, 1, 'pGtlvR2Y32SwXXxKTRMa7Mc7swPy1SJW', NULL, NULL),
(409, 1, 'YXZEWiDdVBAl2PKm91NOOcF8aTtqotsW', NULL, NULL),
(411, 9, 'UDS1ISbghyC8QsDVvqy1PRDTURjO10lZ', NULL, NULL),
(413, 1, 'TBYNAzs7EjZ3scpmkqHycgFjPkGwtSfz', NULL, NULL),
(415, 1, 'WYNhizmptfGNA58EymxIiOCDd0uPD2n8', NULL, NULL),
(416, 1, 'lJDoFB8bVDwa5wncyLki7dKE1jBnLiaz', NULL, NULL),
(422, 1, 'sZX9Slrm51kRK8y8L1MGmOZsZgIoyzzF', NULL, NULL),
(423, 1, 'ZC3W5OqUyKhBNI6dLnI6fndsZ7kxbLig', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sis_reminders`
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
-- Table structure for table `sis_roles`
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
-- Dumping data for table `sis_roles`
--

INSERT INTO `sis_roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admins', 'Administradores', '{\"batata.view\":true,\"batata.create\":true,\"batata.update\":true,\"batata.delete\":true,\"clientes.view\":true,\"clientes.create\":true,\"clientes.update\":true,\"clientes.delete\":true,\"consultas.view\":true,\"consultas.create\":true,\"consultas.update\":true,\"consultas.delete\":true,\"estados.view\":true,\"estados.create\":true,\"estados.update\":true,\"estados.delete\":true,\"cidades.view\":true,\"cidades.create\":true,\"cidades.update\":true,\"cidades.delete\":true,\"tipos.view\":true,\"tipos.create\":true,\"tipos.update\":true,\"tipos.delete\":true,\"noticias.view\":true,\"noticias.create\":true,\"noticias.update\":true,\"noticias.delete\":true,\"fornecedores.view\":true,\"fornecedores.create\":true,\"fornecedores.update\":true,\"fornecedores.delete\":true,\"categorias.view\":true,\"categorias.create\":true,\"categorias.update\":true,\"categorias.delete\":true,\"solicitacoes.view\":true,\"solicitacoes.create\":true,\"solicitacoes.update\":true,\"solicitacoes.delete\":true,\"avaliacoes_fornecedores.view\":true,\"avaliacoes_fornecedores.create\":true,\"avaliacoes_fornecedores.update\":true,\"avaliacoes_fornecedores.delete\":true,\"avaliacoes_clientes.view\":true,\"avaliacoes_clientes.create\":true,\"avaliacoes_clientes.update\":true,\"avaliacoes_clientes.delete\":true,\"teste.view\":true,\"teste.create\":true,\"teste.update\":true,\"teste.delete\":true,\"usuarios.view\":true,\"usuarios.create\":true,\"usuarios.update\":true,\"usuarios.delete\":true}', '2017-07-20 18:32:20', '2017-07-20 18:32:20'),
(3, 'usuarios', 'Usuários', '{\"clientes.view\":true,\"clientes.create\":true,\"clientes.update\":true,\"clientes.delete\":true,\"fornecedores.view\":true,\"fornecedores.create\":true,\"fornecedores.update\":true,\"fornecedores.delete\":true,\"categorias.view\":true,\"categorias.create\":true,\"categorias.update\":true,\"categorias.delete\":true,\"solicitacoes.view\":true,\"solicitacoes.create\":true,\"solicitacoes.update\":true,\"solicitacoes.delete\":true,\"avaliacoes_fornecedores.view\":true,\"avaliacoes_fornecedores.create\":true,\"avaliacoes_fornecedores.update\":true,\"avaliacoes_fornecedores.delete\":true,\"avaliacoes_clientes.view\":true,\"avaliacoes_clientes.create\":true,\"avaliacoes_clientes.update\":true,\"avaliacoes_clientes.delete\":true,\"cidades.view\":true,\"cidades.create\":true,\"cidades.update\":true,\"cidades.delete\":true}', '2017-07-20 20:29:49', '2017-07-20 20:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `sis_role_users`
--

CREATE TABLE `sis_role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_role_users`
--

INSERT INTO `sis_role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-05-17 00:15:00', '2018-05-17 00:15:00'),
(2, 3, '2017-08-08 20:37:43', '2017-08-08 20:37:43'),
(3, 2, '2017-07-20 21:36:06', '2017-07-20 21:36:06'),
(3, 3, '2017-07-24 21:23:09', '2017-07-24 21:23:09'),
(5, 3, '2017-08-21 23:08:20', '2017-08-21 23:08:20'),
(6, 3, '2017-08-22 16:56:30', '2017-08-22 16:56:30'),
(7, 3, '2017-08-08 20:49:12', '2017-08-08 20:49:12'),
(8, 3, '2017-08-22 21:22:57', '2017-08-22 21:22:57'),
(9, 3, '2017-09-29 20:49:08', '2017-09-29 20:49:08'),
(18, 3, '2017-07-20 23:52:53', '2017-07-20 23:52:53'),
(19, 1, '2017-07-21 00:00:00', '2017-07-21 00:00:00'),
(20, 1, '2017-07-21 00:00:21', '2017-07-21 00:00:21'),
(28, 3, '2017-07-21 16:06:48', '2017-07-21 16:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `sis_throttle`
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
-- Dumping data for table `sis_throttle`
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
(91, 1, 'user', NULL, NULL, NULL),
(92, NULL, 'global', NULL, NULL, NULL),
(93, NULL, 'ip', '::1', NULL, NULL),
(94, 1, 'user', NULL, NULL, NULL),
(95, NULL, 'global', NULL, NULL, NULL),
(96, NULL, 'ip', '::1', NULL, NULL),
(97, 1, 'user', NULL, NULL, NULL),
(98, NULL, 'global', NULL, NULL, NULL),
(99, NULL, 'ip', '127.0.0.1', NULL, NULL),
(100, 1, 'user', NULL, NULL, NULL),
(101, NULL, 'global', NULL, NULL, NULL),
(102, NULL, 'ip', '127.0.0.1', NULL, NULL),
(103, 1, 'user', NULL, NULL, NULL),
(104, NULL, 'global', NULL, NULL, NULL),
(105, NULL, 'ip', '127.0.0.1', NULL, NULL),
(106, 2, 'user', NULL, NULL, NULL),
(107, NULL, 'global', NULL, NULL, NULL),
(108, NULL, 'ip', '127.0.0.1', NULL, NULL),
(109, 2, 'user', NULL, NULL, NULL),
(110, NULL, 'global', NULL, NULL, NULL),
(111, NULL, 'ip', '127.0.0.1', NULL, NULL),
(112, 2, 'user', NULL, NULL, NULL),
(113, NULL, 'global', NULL, NULL, NULL),
(114, NULL, 'ip', '127.0.0.1', NULL, NULL),
(115, 1, 'user', NULL, NULL, NULL),
(116, NULL, 'global', NULL, NULL, NULL),
(117, NULL, 'ip', '127.0.0.1', NULL, NULL),
(118, 2, 'user', NULL, NULL, NULL),
(119, NULL, 'global', NULL, NULL, NULL),
(120, NULL, 'ip', '127.0.0.1', NULL, NULL),
(121, 2, 'user', NULL, NULL, NULL),
(122, NULL, 'global', NULL, NULL, NULL),
(123, NULL, 'ip', '127.0.0.1', NULL, NULL),
(124, 2, 'user', NULL, NULL, NULL),
(125, NULL, 'global', NULL, NULL, NULL),
(126, NULL, 'ip', '127.0.0.1', NULL, NULL),
(127, 1, 'user', NULL, NULL, NULL),
(128, NULL, 'global', NULL, NULL, NULL),
(129, NULL, 'ip', '::1', NULL, NULL),
(130, 1, 'user', NULL, NULL, NULL),
(131, NULL, 'global', NULL, NULL, NULL),
(132, NULL, 'ip', '::1', NULL, NULL),
(133, 1, 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sis_tipos_modulo`
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
-- Dumping data for table `sis_tipos_modulo`
--

INSERT INTO `sis_tipos_modulo` (`id`, `nome`, `controller_admin`, `model`, `view_admin_index`, `view_admin_form`, `rotas`) VALUES
(1, 'Complexo', 'controller_admin_com_detalhe.php', 'model_com_detalhe.php', 'view_admin_index_com_detalhe.php', 'view_admin_form_com_detalhe.php', 'rotas_com_detalhe.php'),
(2, 'Simples', 'controller_admin_sem_detalhe.php', 'model_sem_detalhe.php', 'view_admin_index_sem_detalhe.php', '', 'rotas_sem_detalhe.php'),
(3, 'Relacional', NULL, 'model_relacional.php', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sis_users`
--

CREATE TABLE `sis_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `responsavel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receber_notificacoes` tinyint(1) NOT NULL DEFAULT '0',
  `thumbnail_principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_condomino` int(11) DEFAULT NULL,
  `id_criador` int(11) DEFAULT NULL,
  `udid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `endereco` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `cidade` int(11) NOT NULL DEFAULT '0',
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora_inicio_manha` time NOT NULL DEFAULT '00:00:00',
  `hora_fim_manha` time NOT NULL DEFAULT '00:00:00',
  `hora_inicio_tarde` time NOT NULL DEFAULT '00:00:00',
  `hora_fim_tarde` time NOT NULL DEFAULT '00:00:00',
  `hora_inicio_noite` time NOT NULL DEFAULT '00:00:00',
  `hora_fim_noite` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_users`
--

INSERT INTO `sis_users` (`id`, `email`, `cnpj`, `password`, `permissions`, `responsavel`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `receber_notificacoes`, `thumbnail_principal`, `id_condomino`, `id_criador`, `udid`, `latitude`, `longitude`, `telefone`, `telefone2`, `celular`, `descricao`, `endereco`, `estado`, `cidade`, `cep`, `numero`, `complemento`, `bairro`, `hora_inicio_manha`, `hora_fim_manha`, `hora_inicio_tarde`, `hora_fim_tarde`, `hora_inicio_noite`, `hora_fim_noite`) VALUES
(1, 'admin@admin.com.br', '00.000.000/0000-00', '$2y$10$E3joI62VBhjAaC9xSM6FoOwIOOrGNk1S6cuhdMo/jQp4zERWaTMYG', NULL, 'admin', '2018-05-17 03:01:19', 'admin', '', '2017-02-21 05:00:34', '2018-05-17 00:01:19', 0, 'thumb_1526505279-Stephen.png', NULL, NULL, NULL, '-15.753151', '-47.880227200000036', '(54)9999-9999', '', '', '', 'Rua Ernesto Alves', 23, 1, '95020-360', '123456', '', 'Lurdes', '12:00:00', '00:00:00', '00:00:00', '00:00:00', '15:30:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `solicitacoes_fornecedores`
--

CREATE TABLE `solicitacoes_fornecedores` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL DEFAULT '0',
  `id_solicitacao` int(11) NOT NULL DEFAULT '0',
  `valor` decimal(10,0) NOT NULL DEFAULT '0',
  `valor_chamada` decimal(10,0) NOT NULL DEFAULT '0',
  `aceito` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solicitacoes_fornecedores`
--

INSERT INTO `solicitacoes_fornecedores` (`id`, `id_fornecedor`, `id_cliente`, `id_solicitacao`, `valor`, `valor_chamada`, `aceito`) VALUES
(1, 1, 1, 1, '0', '0', 2),
(2, 1, 1, 5, '0', '0', 2),
(3, 1, 1, 6, '0', '0', 2),
(4, 1, 1, 9, '0', '0', 2),
(5, 1, 1, 10, '0', '0', 2),
(6, 1, 1, 0, '0', '0', 2),
(7, 1, 1, 0, '0', '0', 2),
(8, 3, 1, 0, '0', '0', 2),
(9, 2, 1, 0, '0', '0', 2),
(10, 1, 1, 0, '0', '0', 2),
(11, 1, 1, 0, '0', '0', 2),
(12, 1, 1, 0, '0', '0', 2),
(13, 1, 1, 0, '0', '0', 2),
(14, 2, 1, 0, '0', '0', 2),
(15, 1, 1, 0, '0', '0', 2),
(16, 1, 1, 0, '0', '0', 2),
(17, 3, 1, 0, '0', '0', 2),
(18, 3, 1, 0, '0', '0', 2),
(19, 2, 1, 11, '0', '0', 2),
(20, 3, 1, 12, '0', '0', 2),
(21, 1, 1, 13, '0', '0', 2),
(22, 2, 1, 14, '0', '0', 2),
(23, 1, 1, 14, '0', '0', 2),
(24, 1, 1, 26, '0', '0', 2),
(25, 1, 1, 27, '0', '0', 2),
(26, 1, 1, 28, '0', '0', 2),
(27, 1, 1, 29, '0', '0', 2),
(28, 1, 1, 30, '0', '0', 2),
(29, 1, 1, 31, '0', '0', 2),
(30, 1, 1, 32, '0', '0', 2),
(31, 8, 1, 33, '0', '0', 2),
(32, 1, 1, 0, '0', '0', 2),
(33, 1, 1, 0, '0', '0', 2),
(34, 1, 1, 0, '0', '0', 2),
(35, 1, 1, 0, '0', '0', 2),
(36, 1, 1, 0, '0', '0', 2),
(37, 1, 1, 0, '0', '0', 2),
(38, 1, 1, 0, '0', '0', 2),
(39, 1, 1, 0, '0', '0', 2),
(40, 1, 1, 34, '0', '0', 2),
(41, 1, 1, 35, '0', '0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_imagens`
--

CREATE TABLE `usuarios_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado` (`estado`);

--
-- Indexes for table `cidades_imagens`
--
ALTER TABLE `cidades_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Estado_pais` (`pais`);

--
-- Indexes for table `fornecedores_categorias`
--
ALTER TABLE `fornecedores_categorias`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_fornecedor` (`id_fornecedor`) USING BTREE;

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sis_activations`
--
ALTER TABLE `sis_activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_basic_info`
--
ALTER TABLE `sis_basic_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_campo_modulo`
--
ALTER TABLE `sis_campo_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_fk_modulo`
--
ALTER TABLE `sis_fk_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_modulos`
--
ALTER TABLE `sis_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_password_resets`
--
ALTER TABLE `sis_password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `sis_permissions`
--
ALTER TABLE `sis_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_persistences`
--
ALTER TABLE `sis_persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `sis_reminders`
--
ALTER TABLE `sis_reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_roles`
--
ALTER TABLE `sis_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `sis_role_users`
--
ALTER TABLE `sis_role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `sis_throttle`
--
ALTER TABLE `sis_throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `sis_tipos_modulo`
--
ALTER TABLE `sis_tipos_modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sis_users`
--
ALTER TABLE `sis_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_condomino` (`id_condomino`),
  ADD KEY `estado` (`estado`);

--
-- Indexes for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitacao` (`id_solicitacao`) USING BTREE,
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios_imagens`
--
ALTER TABLE `usuarios_imagens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cidades_imagens`
--
ALTER TABLE `cidades_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `fornecedores_categorias`
--
ALTER TABLE `fornecedores_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sis_activations`
--
ALTER TABLE `sis_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sis_basic_info`
--
ALTER TABLE `sis_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sis_campo_modulo`
--
ALTER TABLE `sis_campo_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `sis_fk_modulo`
--
ALTER TABLE `sis_fk_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sis_modulos`
--
ALTER TABLE `sis_modulos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `sis_permissions`
--
ALTER TABLE `sis_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sis_persistences`
--
ALTER TABLE `sis_persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;
--
-- AUTO_INCREMENT for table `sis_reminders`
--
ALTER TABLE `sis_reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sis_roles`
--
ALTER TABLE `sis_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sis_throttle`
--
ALTER TABLE `sis_throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `sis_tipos_modulo`
--
ALTER TABLE `sis_tipos_modulo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sis_users`
--
ALTER TABLE `sis_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios_imagens`
--
ALTER TABLE `usuarios_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`id`);

--
-- Constraints for table `fornecedores_categorias`
--
ALTER TABLE `fornecedores_categorias`
  ADD CONSTRAINT `fk_id_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`);

--
-- Constraints for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  ADD CONSTRAINT `fk_solic_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_solic_forn` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
