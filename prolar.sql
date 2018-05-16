-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2017 at 06:13 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1-log
-- PHP Version: 5.6.31

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
-- Table structure for table `avaliacoes_clientes`
--

CREATE TABLE IF NOT EXISTS `avaliacoes_clientes` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `comentario` text,
  `criado_em` datetime DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_solicitacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avaliacoes_clientes_imagens`
--

CREATE TABLE IF NOT EXISTS `avaliacoes_clientes_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_avaliacao_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avaliacoes_fornecedores`
--

CREATE TABLE IF NOT EXISTS `avaliacoes_fornecedores` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `comentario` text,
  `criado_em` datetime DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_solicitacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `avaliacoes_fornecedores_imagens`
--

CREATE TABLE IF NOT EXISTS `avaliacoes_fornecedores_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_avaliacao_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=351 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `thumbnail_principal`, `meta_keywords`, `meta_descricao`, `slug`, `codigo`, `nome`) VALUES
(196, '', '', '', '', '050.000.000', 'RAMOS DE FORNECEDORES EM GERAL'),
(197, '', '', '', '', '050.001.000', 'RAMOS DE FORNECEDORES EM GERAL'),
(198, '', '', '', '', '050.001.001', 'ABASTECIMENTO DE AGUA'),
(199, '', '', '', '', '050.001.002', 'ALARMES'),
(200, '', '', '', '', '050.001.003', 'ANALISE E TRATAMENTO DE AGUA'),
(201, '', '', '', '', '050.001.004', 'ANTENAS'),
(202, '', '', '', '', '050.001.005', 'DECORAÇÕES (TAPETES E PERSIANAS)'),
(203, '', '', '', '', '050.001.006', 'CALÇADAS '),
(204, '', '', '', '', '050.001.007', 'CERCAS ELETRÔNICAS'),
(205, '', '', '', '', '050.001.008', 'CIRCUITO FECHADO DE TV'),
(206, '', '', '', '', '050.001.009', 'COMÉRCIO DE PEDRAS'),
(207, '', '', '', '', '050.001.010', 'MÁRMORES E GRANITOS'),
(208, '', '', '', '', '050.001.011', 'CONSTRUTORAS'),
(209, '', '', '', '', '050.001.012', 'CONTAINERS'),
(210, '', '', '', '', '050.001.013', 'CORRETORES'),
(211, '', '', '', '', '050.001.014', 'DESENTUPIDORAS'),
(212, '', '', '', '', '050.001.015', 'DESRATIZAÇÃO E DESINSETIZAÇÃO'),
(213, '', '', '', '', '050.001.016', 'DETRITUS'),
(214, '', '', '', '', '050.001.017', 'ELABORAÇÃO DE PREVENÇÃO PPCI'),
(215, '', '', '', '', '050.001.018', 'ELETRICISTAS'),
(216, '', '', '', '', '050.001.019', 'EMERGÊNCIA MÉDICA'),
(217, '', '', '', '', '050.001.020', 'ELEVADORES'),
(218, '', '', '', '', '050.001.021', 'EMPRESAS DE TELECOMUNICAÇÃO'),
(219, '', '', '', '', '050.001.022', 'ENCANADORES'),
(220, '', '', '', '', '050.001.023', 'ENGENHARIA CIVIL'),
(221, '', '', '', '', '050.001.024', 'ENGENHARIA ELÉTRICA'),
(222, '', '', '', '', '050.001.025', 'PEDREIROS'),
(223, '', '', '', '', '050.001.026', 'ESTOFADOS'),
(224, '', '', '', '', '050.001.027', 'ESTRUTURAS METÁLICAS'),
(225, '', '', '', '', '050.001.028', 'EXTINTORES'),
(226, '', '', '', '', '050.001.029', 'FECHADURAS E CHAVES'),
(227, '', '', '', '', '050.001.030', 'FERRAGENS'),
(228, '', '', '', '', '050.001.031', 'FONECEDORES DE GÁS A GRANEL'),
(229, '', '', '', '', '050.001.032', 'FORNECEDORES DE GÁS P 45'),
(230, '', '', '', '', '050.001.033', 'FORNECEDORES DE LENHA'),
(231, '', '', '', '', '050.001.034', 'FORNECEDORES DE ÓLEO DIESEL'),
(232, '', '', '', '', '050.001.035', 'PRODUTOS DE LIMPEZA '),
(233, '', '', '', '', '050.001.036', ' TINTAS'),
(234, '', '', '', '', '050.001.037', 'FUNILARIAS'),
(235, '', '', '', '', '050.001.038', 'GRANILHAS'),
(236, '', '', '', '', '050.001.039', 'MATERIAL ELÉTRICO'),
(237, '', '', '', '', '050.001.040', 'IMPERMEABILIZAÇÃO'),
(238, '', '', '', '', '050.001.041', 'PARA-RAIOS E HIDRANTES'),
(239, '', '', '', '', '050.001.042', 'LIMPEZA'),
(240, '', '', '', '', '050.001.043', 'LIMPEZA DE FACHADAS'),
(241, '', '', '', '', '050.001.044', 'LIMPEZA DE CAIXAS DE ÁGUA'),
(242, '', '', '', '', '050.001.045', 'LIMPEZA DE CAIXAS DE GORDURA'),
(243, '', '', '', '', '050.001.046', 'MADEIREIRAS'),
(244, '', '', '', '', '050.001.047', 'MANUTENÇÃO DE BOMBAS'),
(245, '', '', '', '', '050.001.048', 'MANUTENÇÃO DE GERADORES'),
(246, '', '', '', '', '050.001.049', 'MANUTENÇÃO DE INTERFONES'),
(247, '', '', '', '', '050.001.050', 'MANUTENÇÃO DE PORTÕES ELETRÔNICOS'),
(248, '', '', '', '', '050.001.051', 'MANUTENÇÃO DE SISTEMAS TELEFÔNICOS'),
(249, '', '', '', '', '050.001.052', 'MANUTENÇÃO DE TRANSFORMADORES'),
(250, '', '', '', '', '050.001.053', 'MAQUINAS E EQUIPAMENTOS PARA JARDINS'),
(251, '', '', '', '', '050.001.054', 'MARCENARIAS'),
(252, '', '', '', '', '050.001.055', 'MATERIAIS DE CONSTRUÇÃO'),
(253, '', '', '', '', '050.001.056', 'MATERIAIS HIDROSANITÁRIOS'),
(254, '', '', '', '', '050.001.057', 'MONITORAMENTO REMOTO'),
(255, '', '', '', '', '050.001.058', 'MÓVEIS'),
(256, '', '', '', '', '050.001.059', 'PERSIANAS'),
(257, '', '', '', '', '050.001.060', 'PINTURAS'),
(258, '', '', '', '', '050.001.061', 'PISCINAS E CHAFARISES'),
(259, '', '', '', '', '050.001.062', 'PLACAS E LETREIROS'),
(260, '', '', '', '', '050.001.063', 'PLANOS DE SAÚDE'),
(261, '', '', '', '', '050.001.064', 'PLANTAS, INSUMOS E HERBICIDAS'),
(262, '', '', '', '', '050.001.065', 'RECARGA E RETESTE DE EXTINTORES'),
(263, '', '', '', '', '050.001.066', 'REFRIGERAÇÃO'),
(264, '', '', '', '', '050.001.067', 'REMOÇÃO DE ENTULHOS'),
(265, '', '', '', '', '050.001.068', 'SACOS DE LIXO'),
(266, '', '', '', '', '050.001.069', 'SERRALHERIAS'),
(267, '', '', '', '', '050.001.070', 'SERVIÇOS DE CONFECÇÕES'),
(268, '', '', '', '', '050.001.071', 'SERVIÇOS E PEÇAS DE AR CONDICIONADO'),
(269, '', '', '', '', '050.001.072', 'SERVIÇOS E PEÇAS DE CALDEIRAS'),
(270, '', '', '', '', '050.001.073', 'JARDINAGEM / PAISAGISMO'),
(271, '', '', '', '', '050.001.074', 'SERVIÇOS EM POLICARBONATO'),
(272, '', '', '', '', '050.001.075', 'TAPETES PERSONALIZADOS'),
(273, '', '', '', '', '050.001.076', 'TELAS'),
(274, '', '', '', '', '050.001.077', 'REFORMA E CONSERTO EM TELHADOS'),
(275, '', '', '', '', '050.001.078', 'TOALHEIROS'),
(276, '', '', '', '', '050.001.079', 'TOLDOS'),
(277, '', '', '', '', '050.001.080', 'TV POR ASSINATURA'),
(278, '', '', '', '', '050.001.081', 'VIDRACEIROS'),
(279, '', '', '', '', '050.001.082', 'VIDROS TEMPERADOS'),
(280, '', '', '', '', '050.001.083', 'VIGILÂNCIA '),
(281, '', '', '', '', '050.001.084', 'LIMPEZA CARPETES, TAPETES E ESTOFADOS'),
(282, '', '', '', '', '050.001.085', 'MANUTENÇÃO GERAL - FAZ TUDO'),
(283, '', '', '', '', '050.001.086', 'SEGUROS'),
(284, '', '', '', '', '050.001.087', 'LIMPEZA DE FOSSAS'),
(285, '', '', '', '', '050.001.088', 'DEDETIZAÇÃO'),
(286, '', '', '', '', '050.001.089', 'GÁS'),
(287, '', '', '', '', '050.001.090', 'DRENAGEM DE ALAGAMENTOS'),
(288, '', '', '', '', '050.001.091', 'LAVAGEM DE GARAGENS'),
(289, '', '', '', '', '050.001.092', 'MONTAGEM E DESMONTAGEM DE MÓVEIS'),
(290, '', '', '', '', '050.001.093', 'PARA-RAIOS E HIDRANTES'),
(291, '', '', '', '', '050.001.094', 'CABEAMENTO DE REDE PARA COMPUTADOR'),
(292, '', '', '', '', '050.001.095', 'FECH. DE SACADAS'),
(293, '', '', '', '', '050.001.096', 'PUBLICIDADE E PROPAGANDA'),
(294, '', '', '', '', '050.001.097', 'ADVOGADO'),
(295, '', '', '', '', '050.001.098', 'CARPINTARIA'),
(296, '', '', '', '', '050.001.099', 'INFILTRAÇÕES'),
(297, '', '', '', '', '050.001.100', 'MUDANÇAS E TRANSPORTES'),
(298, '', '', '', '', '050.001.101', 'FABRICAÇÃO DE MAQUINAS E EQUIPAMENTOS'),
(299, '', '', '', '', '050.001.102', 'MANUTENÇÃO INDUSTRIAL EM MECÂNICA, PNEUMATICA E HIDRAULICA'),
(300, '', '', '', '', '050.001.103', 'SISTEMAS SPDA'),
(301, '', '', '', '', '050.001.104', 'CONSULTORIA'),
(302, '', '', '', '', '050.001.105', 'REDES HIDRAULICAS DE INCENDIO'),
(303, '', '', '', '', '050.001.106', 'ARQUITETOS'),
(304, '', '', '', '', '050.001.107', 'GESSO'),
(305, '', '', '', '', '050.001.108', 'AZULEJOS'),
(306, '', '', '', '', '050.001.109', 'BOX DE BANHEIRO'),
(307, '', '', '', '', '050.001.110', 'CONSULTORIA EM SEGURANÇA'),
(308, '', '', '', '', '050.001.111', 'TREINAMENTO DO RT14 - PREVENÇÃO E COMBATE A INCÊNDIO'),
(309, '', '', '', '', '050.001.112', 'GELOSIAS / PERSIANAS'),
(310, '', '', '', '', '050.001.113', 'PERSIANAS - VERTICAIS E HORIZONTAIS (TECIDO-ALUMINIO)'),
(311, '', '', '', '', '050.001.114', 'VIDRAÇARIA'),
(312, '', '', '', '', '050.001.115', 'ESPELHOS'),
(313, '', '', '', '', '050.001.116', 'ABERTURAS EM ALUMINIO E PVC'),
(314, '', '', '', '', '050.001.117', 'PISOS '),
(315, '', '', '', '', '050.001.118', 'FORNECEDORES EM GERAL'),
(316, '', '', '', '', '050.001.119', 'TRANSPORTE EXECUTIVO'),
(317, '', '', '', '', '050.001.120', 'CONFECÇÃO MASCULINA E FEMININA'),
(318, '', '', '', '', '050.001.121', 'LOJA CESTA DE CAFÉ DA MANHÃ, PRESENTES E BAZAR'),
(319, '', '', '', '', '050.001.122', 'PORTARIA '),
(320, '', '', '', '', '050.001.123', 'MATERIAL EXPEDIENTE'),
(321, '', '', '', '', '050.001.124', 'EQUIPAMENTOS, UTENSILIOS E UTILIDADES DOMESTICAS'),
(322, '', '', '', '', '050.001.125', 'CONSERTINA'),
(323, '', '', '', '', '050.001.126', 'ELEVADORES DE BOX DE GARAGEM'),
(324, '', '', '', '', '050.001.127', 'INSTALAÇÃO REDE DE GAS'),
(325, '', '', '', '', '050.001.128', 'ECONOMIA DE ENERGIA ELÉTRICA'),
(326, '', '', '', '', '050.001.129', 'PORTA SANFONADA'),
(327, '', '', '', '', '050.001.130', 'ZELADORIA'),
(328, '', '', '', '', '050.001.131', 'EQUIPAMENTOS PARA LIMPEZA'),
(329, '', '', '', '', '050.001.132', 'TRATAMENTO E LIMPEZA DE PISOS'),
(330, '', '', '', '', '050.001.133', 'CORTE DE GRAMA'),
(331, '', '', '', '', '050.001.134', 'CAÇA VAZAMENTO'),
(332, '', '', '', '', '050.001.135', 'DIARISTA'),
(333, '', '', '', '', '050.001.136', 'PASSADEIRA'),
(334, '', '', '', '', '050.001.137', 'CUIDADOR DE IDOSOS'),
(335, '', '', '', '', '050.001.138', 'BABA BABYSITTER'),
(336, '', '', '', '', '050.001.139', 'COZINHEIRA'),
(337, '', '', '', '', '050.001.140', 'PET SITTER'),
(338, '', '', '', '', '050.001.141', 'MOTORISTA'),
(339, '', '', '', '', '050.001.142', 'DOG WALKER'),
(340, '', '', '', '', '050.001.143', 'BOM VIZINHO'),
(341, '', '', '', '', '050.001.144', 'LAUDOS TECNICOS '),
(342, '', '', '', '', '050.001.145', 'LAVANDERIA'),
(343, '', '', '', '', '050.001.146', 'INSTALAÇÃO DE SISTEMA DE CAMERAS'),
(344, '', '', '', '', '050.001.147', 'INFORMATICA'),
(345, '', '', '', '', '050.001.148', 'SEGURANÇA ELETRONICA '),
(346, '', '', '', '', '050.001.149', 'POS OBRA'),
(347, '', '', '', '', '050.001.150', 'SERVICOS TEMPORARIOS'),
(348, '', '', '', '', '050.001.151', 'REGULARIZAÇÃO DE IMÓVEIS'),
(350, NULL, NULL, NULL, '', '34234', 'teste jones2');

-- --------------------------------------------------------

--
-- Table structure for table `categorias_imagens`
--

CREATE TABLE IF NOT EXISTS `categorias_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cidades`
--

CREATE TABLE IF NOT EXISTS `cidades` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT '23'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `cidades_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_cidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `avaliacao` decimal(8,2) NOT NULL DEFAULT '5.00',
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `udid` varchar(255) DEFAULT NULL,
  `id_facebook` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `editado_em` datetime DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `thumbnail_principal`, `avaliacao`, `meta_keywords`, `meta_descricao`, `slug`, `nome`, `udid`, `id_facebook`, `email`, `telefone`, `data_nascimento`, `endereco`, `estado`, `cidade`, `numero`, `complemento`, `latitude`, `longitude`, `cep`, `criado_em`, `editado_em`, `bairro`) VALUES
(1, '', '5.00', NULL, NULL, '', 'Cliente Teste', '', '', 'teste2@duostudio.com.br', '(54)2342-3542', '0000-00-00', 'Rua Ernesto Alves', '', '5565', '24', '', '', '', '95020-360', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, NULL, '5.00', NULL, NULL, '', 'Ricardo Farias', '', NULL, 'ricardo@duostudio.com.br', '54999999999', NULL, 'Rua tal', NULL, '1', '1234', NULL, '-29.1570871', '-51.1781996', '95020360', NULL, NULL, NULL),
(3, NULL, '5.00', NULL, NULL, '', 'Ricardo Farias2', '', NULL, NULL, '54999999999', NULL, 'Rua tal', NULL, '1', '1234', NULL, '-29.1570871', '-51.1781996', '95020360', NULL, NULL, NULL),
(4, NULL, '5.00', NULL, NULL, '', 'wesley', NULL, NULL, 'wesley@duo.com.br', '54992013799', NULL, 'ruateste', NULL, '1', '21312', NULL, NULL, NULL, '1111313122', NULL, NULL, NULL),
(5, NULL, '5.00', NULL, NULL, '', 'wesley', NULL, NULL, 'wesley@duo.com.br', '54992013799', NULL, 'ruateste', NULL, '1', '21312', NULL, NULL, NULL, '1111313122', NULL, NULL, NULL),
(6, NULL, '5.00', NULL, NULL, '', 'wesley', NULL, NULL, 'wesley@duo.com.br', '54992013799', NULL, 'ruateste', NULL, '1', '21312', NULL, NULL, NULL, '1111313122', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clientes_imagens`
--

CREATE TABLE IF NOT EXISTS `clientes_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(75) DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `pais` int(7) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

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
-- Table structure for table `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(11) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `avaliacao` decimal(8,2) NOT NULL DEFAULT '5.00',
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `cnpj` varchar(255) DEFAULT NULL,
  `udid` varchar(255) DEFAULT NULL,
  `segunda` int(1) NOT NULL DEFAULT '0',
  `terca` int(1) NOT NULL DEFAULT '0',
  `quarta` int(1) NOT NULL DEFAULT '0',
  `quinta` int(1) NOT NULL DEFAULT '0',
  `sexta` int(1) NOT NULL DEFAULT '0',
  `sabado` int(1) NOT NULL DEFAULT '0',
  `domingo` int(1) NOT NULL DEFAULT '0',
  `dia_todo` int(1) NOT NULL DEFAULT '0',
  `hora_inicio_manha` time NOT NULL,
  `hora_final_manha` time NOT NULL,
  `hora_inicio_tarde` time NOT NULL,
  `hora_final_tarde` time NOT NULL,
  `hora_inicio_noite` time NOT NULL,
  `hora_final_noite` time NOT NULL,
  `horario_comercial` int(1) NOT NULL DEFAULT '0',
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `cidade` int(11) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `criado_em` varchar(255) DEFAULT NULL,
  `editado_em` varchar(255) DEFAULT NULL,
  `descricao` text,
  `bairro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `ativo`, `avaliacao`, `thumbnail_principal`, `meta_keywords`, `meta_descricao`, `slug`, `nome`, `nome_fantasia`, `senha`, `email`, `telefone`, `cnpj`, `udid`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dia_todo`, `hora_inicio_manha`, `hora_final_manha`, `hora_inicio_tarde`, `hora_final_tarde`, `hora_inicio_noite`, `hora_final_noite`, `horario_comercial`, `endereco`, `numero`, `complemento`, `cidade`, `estado`, `cep`, `latitude`, `longitude`, `criado_em`, `editado_em`, `descricao`, `bairro`) VALUES
(6, 1, '5.00', '', '', '', '', 'ELETRICA ANDREAZZA LTDA', 'ANGELO ANDREAZZA', '', 'angeloandreazza@gmail.com', '(54)3283-1104', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(7, 1, '5.00', '', '', '', '', 'JUAREZ ANTONIO DALL AGNOL', 'PINTURAS DALLAS', '', 'dallas@dallasdecoracoes.com.br', '(54)99973-2522', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(8, 1, '5.00', '', '', '', '', 'POLITO COM TINTAS PINT E REPRES LTDA', 'POLITO PINTURAS', '', 'politopinturas@gmail.com', '(54)99971-2298', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(9, 1, '5.00', '', '', '', '', 'DESENTUPIDORA LIDER LTDA', 'DESENTUPIDORA LIDER ', '', 'raquelb@desentupidoralider-rs.com.br', '(54)3028-2919', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(10, 1, '5.00', '', '', '', '', 'ADRIANO DOMINGOS ZAMPIERI', 'ADZ', '', 'adz.instalacoes@gmail.com', '(54)99971-2452', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(11, 1, '5.00', '', '', '', '', 'FORMOLO MAT P/CONSTR LTDA-CIMENTO ', 'FORMOLO', '', 'financeiro@formolomateriais.com.br', '(54)3212-2222', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(12, 1, '5.00', '', '', '', '', 'SIMOQUIMICA PROD QUIMICOS LTDA', 'SIMOQUIMICA', '', 'vendas2@simoquimica.com.br', '(54)3733-9000', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(13, 1, '5.00', '', '', '', '', 'MAGNANI E CIA LTDA.', 'MAGNANI MAT. ELETRICOS', '', 'financeiro@magnani.com.br', '(54)4009-5255', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(14, 1, '5.00', '', '', '', '', 'METADADOS ASSESSORIA E SISTEMAS LTDA. ', 'METADADOS', '', 'metadados@metadados.com.br', '(54)3026-9900', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(15, 1, '5.00', '', '', '', '', 'VENETO TELEALARME LTDA.', 'VENETO', '', 'fernando@sveneto.com.br', '(54)3223-2559', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(16, 1, '5.00', '', '', '', '', 'CIPNET SERV DE INTERNET LTDA', 'CIPNET', '', 'sac@cipnet.com.br', '(54)3028-2025', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(17, 1, '5.00', '', '', '', '', 'PROTESUL VIGILANCIA CAXIENSE LTDA.', 'PROTESUL', '', ' everton@protesul.com.br;protesul@protesul.com.br', '(54)3228-3133', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(18, 1, '5.00', '', '', '', '', 'COM TATO COM DE PROD DE LIMP LTDA - PROD QUIM. E EQUIP.', 'COM TATO LTDA', '', 'financeiro2@comtato.etc.br', '(54)3224-1151', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(19, 1, '5.00', '', '', '', '', 'ROCK COMERCIO DE TINTAS LTDA. ', 'ROCK COMERCIO DE TINTAS LTDA. ', '', 'rocktintas@rocktintas.com.br', '(54)3222-6766', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(20, 1, '5.00', '', '', '', '', 'SOLUTION PROVIDER LTDA.', 'INTELTEC', '', 'producao@inteltec.com.br', '(54)3028-2175', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(21, 1, '5.00', '', '', '', '', 'HOFFMANN MAT DE CONSTR LTDA. ', 'HOFFMANN MAT DE CONSTR', '', 'beto@hoffmannrs.com.br ', '(54)3535-3535', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(22, 1, '5.00', '', '', '', '', 'BETTONI COMERCIO DE TINTAS LTDA. ', 'BETTONI', '', 'bettonitintas@terra.com.br', '(54)3221-5327', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(23, 1, '5.00', '', '', '', '', 'SERRANA COMERCIO DE TINTAS LTDA. ', 'SERRANA', '', 'leandro@serranatintas.com.br', '(54)3223-7322', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(24, 1, '5.00', '', '', '', '', 'CELETRO CAXIAS MAT ELETRICOS LTDA. ', 'CELETRO', '', 'celetro@celetrocaxias.com.br', '(54)3228-3004', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(25, 1, '5.00', '', '', '', '', 'EMERSON REIS FREDO', 'CHAVES CENTENARIO 99382032053', '', 'centenario@terra.com.br', '(54)3223-2992', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(26, 1, '5.00', '', '', '', '', 'J M MARCON E CIA LTDA.', 'ELETRO MARCON', '', 'jmmarcon@terra.com.br', '(54)3222-3966', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(27, 1, '5.00', '', '', '', '', 'MENTES ENG E CONSTR LTDA.', '', '', 'mentes.eng@uol.com.br', '(54)3224-1597', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(28, 1, '5.00', '', '', '', '', 'COMERCIAL DE TINTAS NORDESTE LTDA.', 'TINTAS NORDESTE LTDA', '', 'deise@nordestetintas.com.br', '(54)4009-2955', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(29, 1, '5.00', '', '', '', '', 'FERRAGENS BIONDO LTDA.', 'FERRAGENS BIONDO ', '', 'ferragensbiondo@terra.com.br', '(54)3221-5118', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(30, 1, '5.00', '', '', '', '', 'VANDERLEIA RIGOTTO ALVES', 'VANDEL ', '', 'vandialvez@hotmail.com', '(54)3224-1744', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(31, 1, '5.00', '', '', '', '', 'COLLEONY PROD SIST HIGIENIZ LTDA.', '', '', 'dayane@colleony.com.br', '(54)3225-7007', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(32, 1, '5.00', '', '', '', '', 'COMABE LTDA', '', '', 'comabe@comabe.com.br', '(54)2108-2300', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(33, 1, '5.00', '', '', '', '', 'CEMIN MATERIAIS ELETRICOS LTDA.', 'CEMIN', '', 'doctorpower.mat.eletrico@hotmail.com', '(54)3228-3455', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(34, 1, '5.00', '', '', '', '', 'VANDEL LIMPEZA CAIXAS D''AGUA LTDA.', '', '', 'vandialvez@hotmail.com', '(54)3224-1744', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(35, 1, '5.00', '', '', '', '', 'QUATTRUM CORRET SEG LTDA', '', '', 'quattrum@pro.via-rs.com.br', '(54)3222-1925', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(36, 1, '5.00', '', '', '', '', 'TELECALCAGNOTTO EQUIP TELEF LTDA-MATERIAIS', 'TELECALCAGNOTTO', '', 'telecal@telecalcagnotto.com.br', '(54)3228-1900', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(37, 1, '5.00', '', '', '', '', 'DALSAT TELECOMUNICAÇÕES LTDA.', 'DALSAT TELECOMUNICAÇÕES LTDA.', '', 'carlos@dalsat.com.br', '(54)3227-4300', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(38, 1, '5.00', '', '', '', '', 'VIACONNECT SOLUÇÕES  INFORMAT LTDA', 'CDSA ', '', 'diretoria@viaconnect.com.br', '(54)3212-6074', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(39, 1, '5.00', '', '', '', '', 'ANDREIA CANTON DE FREITAS  ', 'SUPRITEC', '', 'supritech@supritech.inf.br', '(54)3028-3036', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(40, 1, '5.00', '', '', '', '', 'CONTEL CONTROLE ELETRONICO LTDA.', 'CONTEL', '', 'douglas.silva@contel.ind.br', '(54)3224-2433', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(41, 1, '5.00', '', '', '', '', 'JANAIR DELIR KATZ', 'CAIO CHAVES', '', 'janairgremista@hotmail.com', '(54)3027-2039', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(42, 1, '5.00', '', '', '', '', 'SUSTENTARE CORRETORA DE SEGUROS LTDA', 'SUSTENTARE SEGUROS', '', 'caxias4@sustentareseguros.com.br', '(54)3025-4567', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(43, 1, '5.00', '', '', '', '', 'SERRAQUIMICA PROD QUIMICOS LTDA.', '', '', 'serraquimicavendas@serraquimica.com.br', '(54)3213-5988', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(44, 1, '5.00', '', '', '', '', 'VENETO TRANSPORTES LTDA.', '', '', '', '(54)3224-2977', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(45, 1, '5.00', '', '', '', '', 'STV SEGUR E TRANSP VALORES LTDA.', 'STV SEGUR E TRANSP VALORES', '', 'lissandra.mota@stv.com.br', '(51)3358-1400', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(46, 1, '5.00', '', '', '', '', 'SAMUEL COMERCIO DE TINTAS LTDA. ', 'NORDESTE TINTAS', '', 'samuel@nordestetintas.com.br', '(54)4009-2955', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(47, 1, '5.00', '', '', '', '', 'MAXICRON MAQU ELETRONICAS LTDA. ', 'MAXICRON ', '', 'maxicron.instal@gmail.com', '(54)99979-5662', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(48, 1, '5.00', '', '', '', '', 'XAVIER COM EQUIP P/ALIMENTAÇÃO LTDA. ', 'XAVIER EQUIP. P/ ALIMENTAÇÃO', '', 'xavier@xavierequipamentos.com.br', '(54)3228-1200', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(49, 1, '5.00', '', '', '', '', 'BIPI EXTINTORES LTDA', '', '', 'comercial.bipi@hotmail.com', '(54)3212-2343', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(50, 1, '5.00', '', '', '', '', 'MAELI IND E COM DE SISTEMAS DE AR LTDA. ', '', '', 'maeli@maeliar.com.br', '(54)3228-4481', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(51, 1, '5.00', '', '', '', '', 'PRESSIER RS INFORMATICA LTDA.', 'PRESSIER', '', 'pressier@pressier.com.br', '(54)3028-4775', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(52, 1, '5.00', '', '', '', '', 'SOLUCIONE SERV PREDIAIS LTDA.', 'SOLUCIONE', '', 'comercial@solucione.com.br', '(54)3028-4060', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(53, 1, '5.00', '', '', '', '', 'RECOLHERE TRANSPORTES LTDA ', '', '', 'recolhere@gmaill.com', '(54)3219-3430', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(54, 1, '5.00', '', '', '', '', 'BUFFON MOVEIS E DECORAÇÕES LTDA', 'BUFFON MOVEIS E DECORAÇÕES LTDA', '', 'buffonmoveis@hotmail.com', '(54)3211-1077', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(55, 1, '5.00', '', '', '', '', 'ED COMERCIO DE PRODUTOS DE LIMPEZA LTDA', 'E D COM PROD LIMPEZA LTDA', '', 'vendas@toplimprs.com.br', '(54)3028-5223', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(56, 1, '5.00', '', '', '', '', 'CAXIAS MOTORES ELETR LTDA', 'CAXIAS MOTORES ELETR LTDA', '', 'caxiasmotores@yahoo.com.br', '(54)3223-5025', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(57, 1, '5.00', '', '', '', '', 'PC CARGAS E TRANSPORTES LTDA', 'TRANSPAPÃO', '', 'papaoentulhos@gmail.com', '(54)3222-2221', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(58, 1, '5.00', '', '', '', '', 'SPV DESENTUPIDORA LTDA', 'RODOSUL DESENTUPIDORA', '', 'julian.vendas@outloock.com', '(54)3025-4217', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(59, 1, '5.00', '', '', '', '', 'CALAN COM DE MÁQUINAS', 'CALAN COM DE MÁQUINAS', '', 'calanmaquinas@terra.com.br', '(54)3212-2356', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(60, 1, '5.00', '', '', '', '', 'DALLAS  DECORAÇÕES PREDIAIS LTDA', 'PINTURAS DALLAS', '', 'dallas@dallasdecoracoes.com.br', '(54)3222-5097', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(61, 1, '5.00', '', '', '', '', 'DOMINIO SISTEMAS LTDA', 'DOMINIO SISTEMAS LTDA', '', '', '(48)3461-1000', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(62, 1, '5.00', '', '', '', '', 'JCC ANTENAS LTDA', 'JCC ANTENAS LTDA', '', 'jcantenas2009@hotmail.com', '(54)3224-4587', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(63, 1, '5.00', '', '', '', '', 'MARCXAND CORRETORA DE SEGUROS LTDA', 'MARCXAND ', '', 'alexandre@marcxand.com.br', '(51)3028-8224', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(64, 1, '5.00', '', '', '', '', 'DOMINGOS ZAMPIERI', 'DOMINGOS ZAMPIERI', '', '', '(54)99979-5177', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(65, 1, '5.00', '', '', '', '', 'FERRAGENS BIONDO LTDA - CHAVES', 'FERRAGENS BIONDO LTDA - CHAVES', '', 'ferragensbiondo@terra.com.br', '(54)3221-5118', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(66, 1, '5.00', '', '', '', '', 'COM TATO COM DE PROD LIMP LTDA - DESCART', 'COM TATO LTDA', '', 'financeiro2@comtato.etc.br', '(54)3290-2000', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(67, 1, '5.00', '', '', '', '', 'INETSOFT INFORMATICA LTDA', 'INETSOFT INFORMATICA LTDA', '', '', '(51)3338-7316', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(68, 1, '5.00', '', '', '', '', 'TELECALCAGNOTTO EQUIP TELEF LTDA - SERVIÇOS', 'TELECALCAGNOTTO', '', 'telecal@telecalcagnotto.com.br', '(54)3228-1900', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(69, 1, '5.00', '', '', '', '', 'FORMOLO MAT CONSTR LTDA -DIVERSOS', 'FORMOLO', '', 'vendas@formolomateriais.com.br', '(54)3212-2222', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(70, 1, '5.00', '', '', '', '', 'AMEC EMPREITEIRA DE SERVIÇOS LTDA - MARCOS', 'AMEC SERVIÇOS', '', 'amec.empreiteira@hotmail.com', '(54)3222-7840', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(71, 1, '5.00', '', '', '', '', 'TRANSRESIND TRANSP RES IND LTDA', 'TRANSRESIND TRANSP RES IND LTDA', '', 'marcio@transresind.com.br', '(54)3025-2888', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(72, 1, '5.00', '', '', '', '', 'MARCOS J H GUEBERTO', 'AMEC', '', 'amec.empreiteira@hotmail.com', '(54)99977-7833', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(73, 1, '5.00', '', '', '', '', 'MIGRA SERVICE SOL LIMP LTDA', 'MIGRA SERVICE SOL LIMP LTDA', '', 'comercial02@migraservice.com.br', '(54)3029-2024', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(74, 1, '5.00', '', '', '', '', 'EDUARDO CRUZ', 'CHAVES CAXIAS', '', 'chaves.caxias@hotmail.com', '(54)99979-1491', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(75, 1, '5.00', '', '', '', '', 'PREVENFIRE SIST COMB INC LTDA', 'PREVENFIRE SIST COMB INC LTDA', '', 'prevenfire@prevenfireextintores.com', '(54)3212-2860', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(76, 1, '5.00', '', '', '', '', 'PREVENFIRE SIST COMBATE INC LTDA', 'PREVENFIRE SIST COMBATE INC LTDA', '', '', '(54)3212-2860', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(77, 1, '5.00', '', '', '', '', 'EXTRATO ORG CONTAB LTDA', 'EXTRATO ORG CONTAB LTDA', '', 'ilton@extrato.srv.br', '(54)3222-2566', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(78, 1, '5.00', '', '', '', '', 'MATTER HIGIENIZAÇÃO LTDA-ME', 'MATTER HIGIENIZAÇÃO LTDA', '', 'matter_@hotmail.com', '(54)3028-8647', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(79, 1, '5.00', '', '', '', '', 'CASSOL MONIT ALARMES LTDA', 'TOP SEGUR', '', 'comercial@topsegur.net, kelen@topsegur.net', '(54)99155-6517', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(80, 1, '5.00', '', '', '', '', '4FIX INSIDE EXPERIENCE LTDA', '4 FIX', '', '', '(54)3021-6114', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(81, 1, '5.00', '', '', '', '', 'GALIOTO MÍDIA  DIGITAL LTDA', 'GALIOTO MÍDIA  DIGITAL LTDA', '', '', '(54)3225-1109', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(82, 1, '5.00', '', '', '', '', 'NORDESTE TINTAS LTDA', 'NORDESTE TINTAS LTDA', '', 'fabiana@nordestetintas.com.br', '(54)4009-2955', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(83, 1, '5.00', '', '', '', '', 'TEL BUSINESS SERV TELEF LTDA', 'GRAHAM BELL', '', 'miguel@grambell.net', '(54)3224-6000', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(84, 1, '5.00', '', '', '', '', 'VOLNEI MASOTTI ME', 'VOLNEI MASOTTI', '', 'volneimasotti@yahoo.com.br', '(54)98111-8164', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(85, 1, '5.00', '', '', '', '', 'IPLAN -  ASSESSORIA E CONSULTORIA LTDA', 'IPLAN - INSTITUTO DE PLANEJAMENTO E ASSESSORIA DE ORGANIZAÇÕES LTDA', '', 'candidoluis@iplancaxias.com.br', '(54)3027-4260', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(86, 1, '5.00', '', '', '', '', 'DARVAN DESIGN', 'DARVAN DESIGN', '', 'darvan@terra.com.br', '(54)99979-5765', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(87, 1, '5.00', '', '', '', '', 'LUCIANO AGUSTINI 812034540-15', 'JARDINS 4 ESTAÇÕES', '', 'jardins4estacoes@gmail.com', '(54)3229-5804', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(88, 1, '5.00', '', '', '', '', 'COLLEONY PRODUTOS E SISTEMAS PARA HIGIENIZAÇÃO LTDA', 'COLLEONY', '', 'vendas5@colleony.com.br', '(54)3225-7007', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(89, 1, '5.00', '', '', '', '', 'ED COMERCIO DE PRODUTOS DE LIMPEZA LTDA', 'TOP LIMP', '', 'atendimento@toplimprs.com.br', '(54)3028-5223', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(90, 1, '5.00', '', '', '', '', 'ECOLIDER SISTEMA AMBIENTAL LTDA', 'ECOLIDER SISTEMA AMBIENTAL LTDA', '', 'raquelb@desentupidoralider-rs.com.br', '(54)3028-7161', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(91, 1, '5.00', '', '', '', '', 'J PAESE LIMP CONSERV LTDA', 'J PAESE LIMP CONSERV LTDA', '', '', '(54)3027-5702', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(92, 1, '5.00', '', '', '', '', 'JUCIMAR CEZÁRIO DIAS', 'JC INSTALAÇÕES ', '', 'jucimardias@outlook.com', '(54)99680-2913', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(93, 1, '5.00', '', '', '', '', 'GPS MANUTENÇÃO DE MAQUINAS INDUSTRIAIS LTDA', 'GPS MAQUINAS', '', 'gps@gpsmaquinas.ind.br', '(54)3229-5794', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(94, 1, '5.00', '', '', '', '', 'CAP. JULIANO AMARAL', 'CONSULTORIA EM SEGURANÇA', '', 'julianoandre@brigadamilitar.rs.gov.br', '(54)99183-9198', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(95, 1, '5.00', '', '', '', '', 'ANDRESA SOMENSI', 'ASB TREINAMENTOS', '', 'comercial.bipi@hotmail.com', '(54)99162-2687', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(96, 1, '5.00', '', '', '', '', 'LHC INFORMAT LTDA', 'SANDRO HUNTER', '', 'huntercx@gmail.com', '(54)99923-6511', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(97, 1, '5.00', '', '', '', '', 'JOÃO ALBERTO COSTA', 'JOÃO ALBERTO COSTA', '', '', '(54)99973-7075', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(98, 1, '5.00', '', '', '', '', 'MAURICIO ANDRÉ ROSA ROXO', 'TOP LINE', '', 'pacoroxo@terra.com.br', '(54)99908-2569', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(99, 1, '5.00', '', '', '', '', 'EZEQUIEL O TAVARES - PRESTO', 'PRESTO', '', '', '(54)3041-1433', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(100, 1, '5.00', '', '', '', '', 'ALDECIR MENDES ORLANDO', 'WIBRATTO EQUIPAMENTOS SEGURANÇA LTDA', '', 'wibratto@yahoo.com.br', '(54)99971-3681', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(101, 1, '5.00', '', '', '', '', 'R A COM SIST ELETRÔNICOS LTDA', 'TOP SEGUR', '', 'comercial@topsegur.net', '(54)3025-1747', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(102, 1, '5.00', '', '', '', '', 'JOÃO RICARDO DA SILVA MELO', 'JOÃO RICARDO DA SILVA MELO', '', 'melojrs@terra.com.br', '(54)99976-4527', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(103, 1, '5.00', '', '', '', '', 'CHAVES CAXIAS', 'EDUARDO CRUZ', '', '', '(54)3225-3663', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(104, 1, '5.00', '', '', '', '', 'CTTE SEGURANÇA PRIVADA LTDA', 'CTTE SEGURANÇA  PRIVADA LTDA', '', 'volpatto@ctteseg.com.br', '(51)3073-5900', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(105, 1, '5.00', '', '', '', '', 'LISANDRO  FELIX GAZZOLLA', 'LISANDRO  FELIX GAZZOLLA', '', '', '(54)99163-4857', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(106, 1, '5.00', '', '', '', '', 'PAULO HENRIQUE DOS SANTOS', 'PAULO HENRIQUE DOS SANTOS', '', 'morsegoconstrusoes@gmail.com', '(54)99969-3257', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(107, 1, '5.00', '', '', '', '', 'CILON MOTTA SILVA', 'SECURITY PRIME SEG PATRIM', '', 'cilon.prime@hotmail.com', '(54)99913-8604', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(108, 1, '5.00', '', '', '', '', 'LIDERGLASS IND COM VIDROS EIRELI ME', 'VIDRO LÍDER', '', 'vidrolider@vidrolider.com.br', '(54)3223-7600', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(109, 1, '5.00', '', '', '', '', 'M1 ENGENHARIA LTDA - EPP', 'M1 ENGENHARIA ', '', 'm1@m1engenharia.com.br', '(54)3536-3086', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(110, 1, '5.00', '', '', '', '', 'RODRIGO GADINI ', 'GADINI INSTALAÇÕES ELÉTRICAS', '', 'rodrigo.gadini@hotmail.com', '(54)99197-6767', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(111, 1, '5.00', '', '', '', '', 'ENERGIE-SERV E EFICIENCIA ENERGETICA LTDA - EPP', 'ENERGIE', '', 'energiesrv@gmail.com', '(54)99124-3664', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(112, 1, '5.00', '', '', '', '', 'VALDEREZ ANTÔNIO TRUBIAN PINTO', 'DECOR', '', '', '(54)99191-0033', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(113, 1, '5.00', '', '', '', '', 'J. PAESE LIMPEZA E CONSERVAÇÃO LTDA ME', 'SERVICE SERVIÇOS ESPECIAIS', '', 'contato@limpezaeconservacaocaxias.com.br', '(54)98403-6341', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(114, 1, '5.00', '', '', '', '', 'PAULO EDUARDO SIGNORE SALVADOR', 'CHAVES CRUZEIRO', '', 'chavescruzeiro@gmail.com', '(54)3212-9562', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(115, 1, '5.00', '', '', '', '', 'PROTEFORT EMPRESA DE VIGILANCIA E SEGURANÇA LTDA', 'PROTEFORT VIGILANCIA', '', 'jorge_lunkes@protefort.com.br', '(54)3215-4261', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(116, 1, '5.00', '', '', '', '', 'LFG INSTALAÇÕES HIDRAUL LTDA-ME', 'LFG INSTALAÇÕES HIDRAULICAS LTDA-ME', '', 'lfg@lfghidraulica.com.br', '(54)3214-3015', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(117, 1, '5.00', '', '', '', '', 'PAULO R B ROXO', 'TOP LINE', '', 'pacoroxo@terra.com.br', '(54)3419-4028', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(118, 1, '5.00', '', '', '', '', 'MS CAVALHEIRO PINTURAS LTDA', 'MS CAVALHEIRO PINTURAS LTDA', '', 'pinturascavalheiro@yahoo.com.br', '(54)99123-1627', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(119, 1, '5.00', '', '', '', '', 'JOVENSIL DALPOZZO', 'BARUK AUTOMATIZAÇÃO DE PORTAS E PORTÕES', '', 'baruk.portoes@bol.com.br', '(54)98423-1281', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(120, 1, '5.00', '', '', '', '', 'DLHT SERV E MANUT PRED LTDA', 'PRA QUE MARIDO', '', 'artcaxias.com@gmail.com', '(54)3534-7539', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(121, 1, '5.00', '', '', '', '', 'CRISTALL GESTÃO DE SERVIÇOS LTDA - EPP', 'CRISTALL GESTÃO DE SERVIÇOS LTDA - EPP', '', 'comercial@cristall.com.br', '(54)3014-0949', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(122, 1, '5.00', '', '', '', '', 'CHEF LIMP S. M. DE LIMPAR LTDA', 'CHEF LIMP S.M. DE LIMPAR', '', 'cheflimp@gmail.com', '(54)99140-5534', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(123, 1, '5.00', '', '', '', '', 'AJ IMPERMEABILIZAÇÃO LTDA', 'AJ IMPERMEABILIZAÇÃO LTDA', '', 'ajimpermeabilizacoes@gmail.com', '(54)3238-1009', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(124, 1, '5.00', '', '', '', '', 'MARTA ADRIANA PAESE - ME', 'MASTER - CLEAN LIMP E CONSERVAÇÃO', '', 'contato@masterclean.net.br', '(54)3021-5007', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(125, 1, '5.00', '', '', '', '', 'MAXICRON MÁQUINAS ELETRÔNICAS LTDA', 'MAXICRON ', '', 'maxicron.instal@gmail.com', '(54)99979-5662', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(126, 1, '5.00', '', '', '', '', 'VALMOR JAIR GIGOWSKI', 'CAMINHO DAS PEDRAS', '', 'jardinagemcaminhodaspedras@hotmail.com', '(54)3227-6893', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(127, 1, '5.00', '', '', '', '', 'NOVO CONCEITO SERV DE LIMP LTDA ME', 'NOVO CONCEITO SERV DE LIMP LTDA ME', '', 'novoconceitosrv@bol.com.br', '(54)99177-0971', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(128, 1, '5.00', '', '', '', '', 'C3 EQUIPAMENTOS PARA CONSTRUÇÃO CIVIL LTDA', 'C3 EQUIPAMENTOS / MAIS GARAGEM ', '', 'gerenciacomercial@c3equipamentos.com.br', '(54)3211-8715', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(129, 1, '5.00', '', '', '', '', 'VIRCEU GONÇALVES DA ROSA', 'MASTER CLEAN', '', 'masterclean20@gmail.com', '(54)98414-4589', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(130, 1, '5.00', '', '', '', '', 'MM PINTURAS LDTA - ME', 'M & M PINTURAS ', '', 'claudemirmempinturas@yahoo.com.br', '(54)98442-0135', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(131, 1, '5.00', '', '', '', '', 'RODRIGO L CALCAGNOTTO', 'RODRIGO LUIZ CALCAGNOTTO', '', 'rodrigocalcagnotto@gmail.com', '(54)99117-3130', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(132, 1, '5.00', '', '', '', '', 'JGV SERVIÇOS DE LIMPEZA E CUIDADOS', 'MARIA BRASILEIRA - UNIDADE CAXIAS DO SUL ', '', 'caxias.jardimamerica@mariabrasileira.com.br', '(54)3533-5102', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(133, 1, '5.00', '', '', '', '', 'BELLUNO ASSESSORIA LTDA - ME', 'BELLUNO ENGENHARIA E ASSESSORIA LTDA - ME', '', 'marcelo@belluno.eng.br', '(54)3538-0806', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(134, 1, '5.00', '', '', '', '', 'STV SEGURANÇA E TRANSPORTE DE VALORES LTDA', 'STV SEGURANÇA', '', 'rossano.marchiori@stv.com.br', '(54)3022-2802', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(135, 1, '5.00', '', '', '', '', 'HIGH INDUSTRIAL LTDA', 'HIGH INDUSTRIAL LTDA', '', 'juliano@highindustrial.com.br', '(54)3028-5636', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(136, 1, '5.00', '', '', '', '', 'LUCAS C RODRIGUES', 'BELAR SERVIÇOS', '', 'belarservicos@gmail.com', '(54)99126-3638', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(137, 1, '5.00', '', '', '', '', 'FRANCISNEI REDEL DA MOTTA', 'IMPLEVIDROS', '', 'vendas@implevidros.com.br', '(54)99670-1515', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(138, 1, '5.00', '', '', '', '', 'AZURRA METALURGICA LTDA', 'AZURRA METALURGICA LTDA', '', 'elmo@malbanet.com.br', '(54)3067-3658', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(139, 1, '5.00', '', '', '', '', 'MDS SERVIÇOS', 'MAURO M SOUZA', '', 'mdsservicos1@gmail.com', '(54)99979-8959', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(140, 1, '5.00', '', '', '', '', 'S. SCHEIN E CIA LDTA', 'LAVANDERIA LAV E LEV', '', 'messaschein@lavlev.com.br', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(141, 1, '5.00', '', '', '', '', 'BRIDI MANUTENÇÃO PLANEJADA LTDA', 'BRIDI MANUTENÇÃO PLANEJADA LTDA', '', 'rodrigo@bridiconstrucoes.com.br,  diego@bridiconstrucoes.com.br', '(54)99196-0409', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(142, 1, '5.00', '', '', '', '', 'ROBERTA FANTON', 'ROBERTA FANTON', '', 'roberta@robertafanton.com.br', '(54)3538-1231', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(143, 1, '5.00', '', '', '', '', 'GBTEK TECNOLOGIA LTDA', 'GBTEK ', '', 'comercial@gbtek.com.br', '(54)99987-5621', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(144, 1, '5.00', '', '', '', '', 'JORGE HENRIQUE DE SOUZA', 'JORGE HENRIQUE DE SOUZA', '', 'jorgesouza345@yhahoo.com', '(54)99117-2090', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(145, 1, '5.00', '', '', '', '', 'GABRIELA GOMES DE QUADRO ME', 'SOARES MONTAGENS E MANUTENÇÕES INDUSTRIAL', '', 'soaresmetalica@gmail.com', '(54)98445-7961', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(146, 1, '5.00', '', '', '', '', 'DASUL VIDROS LTDA', 'DASUL VIDROS ', '', 'dasulvidros@gmail.com', '(54)3221-0343', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(147, 1, '5.00', '', '', '', '', 'UMANA BRASIL ASS. E  CONSULTORIA DE RH LTDA', 'UMANA BRASIL ', '', 'jocelito.silva@umanabrasil.com', '(54)98109-0005', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(148, 1, '5.00', '', '', '', '', 'LGA SOL EM REGULAR DE EDIFICAÇÕES LTDA', 'LGA SOLUÇÕES ', '', 'lgaengenharia@lgaengenharia.com.br', '(54)98153-8608', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(149, 1, '5.00', '', '', '', '', 'FERNANDO M ROSSINI', 'IA SERVICE', '', 'fernando.rossini@iaservice.eng.br', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(150, 1, '5.00', '', '', '', '', 'PROSEGUR SISTEMAS DE SEGURANÇA LTDA', 'PROSEGUR SISTEMAS DE SEGURANÇA LTDA', '', 'ana.dorneles@prosegur.com', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(151, 1, '5.00', '', '', '', '', 'PROSEGUR BRASIL S/A ', 'PROSEGUR BRASIL S/A ', '', 'ana.dorneles@prosegur.com', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', ''),
(152, 1, '2.90', '', '', '', '', 'GILBERTO ZAMIN', 'PER LIMPARE', '', 'perlimpare@gmail.com', '(54)99947-8316', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '', '', 0, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fornecedores_categorias`
--

CREATE TABLE IF NOT EXISTS `fornecedores_categorias` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL DEFAULT '0',
  `id_categoria` int(11) NOT NULL DEFAULT '0',
  `reparo_emergencial` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fornecedores_categorias`
--

INSERT INTO `fornecedores_categorias` (`id`, `id_fornecedor`, `id_categoria`, `reparo_emergencial`, `criado_em`) VALUES
(236, 152, 196, 0, '2017-09-29 17:43:15'),
(237, 152, 198, 0, '2017-09-29 17:43:15'),
(238, 152, 197, 0, '2017-09-29 17:43:15'),
(239, 152, 199, 0, '2017-09-29 17:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `fornecedores_imagens`
--

CREATE TABLE IF NOT EXISTS `fornecedores_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_fornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mensagens`
--

CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` int(11) NOT NULL,
  `mensagem` text,
  `id_solicitacao` int(11) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `enviado_por` int(1) NOT NULL DEFAULT '0' COMMENT '0 = cliente, 1 = fornecedor',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
(8, 'asdfaasfd2', 1, 1, 1, 1, '2017-09-28 20:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `sis_activations`
--

CREATE TABLE IF NOT EXISTS `sis_activations` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `sis_basic_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `basic_meta_keywords` text,
  `basic_meta_descricao` text
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sis_basic_info`
--

INSERT INTO `sis_basic_info` (`id`, `title`, `basic_meta_keywords`, `basic_meta_descricao`) VALUES
(1, 'Projeto Laravel', 'projeto,laravel', 'Lorem ipsum dolor sit amet consectetur adisciping elit.');

-- --------------------------------------------------------

--
-- Table structure for table `sis_campo_modulo`
--

CREATE TABLE IF NOT EXISTS `sis_campo_modulo` (
  `id` int(11) unsigned NOT NULL,
  `label` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `valor_padrao` text COLLATE utf8_unicode_ci,
  `tipo_campo` enum('I','T','D','DT','N','S','SI','INT','TIME','SC') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'I',
  `id_modulo` int(11) NOT NULL,
  `listagem` tinyint(1) DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_campo_modulo`
--

INSERT INTO `sis_campo_modulo` (`id`, `label`, `nome`, `valor_padrao`, `tipo_campo`, `id_modulo`, `listagem`, `required`, `ordem`) VALUES
(18, 'estado', 'estado', '', 'I', 5, 0, 0, 0),
(19, 'sigla', 'sigla', '', 'I', 5, 0, 0, 0),
(39, 'Nome', 'nome', '', 'I', 10, 1, 1, 0),
(40, 'Udid', 'udid', '', 'I', 10, 0, 0, 0),
(41, 'Id_facebook', 'id_facebook', '', 'I', 10, 0, 0, 0),
(42, 'E-mail', 'email', '', 'I', 10, 1, 1, 0),
(43, 'Telefone', 'telefone', '', 'I', 10, 1, 1, 0),
(44, 'Data Nascimento', 'data_nascimento', '', 'D', 10, 0, 0, 0),
(45, 'Endereço', 'endereco', '', 'I', 10, 0, 1, 2),
(46, 'Estado', 'estado', '', 'I', 10, 0, 0, 3),
(47, 'Cidade', 'cidade', '', 'SI', 10, 0, 1, 4),
(48, 'Número', 'numero', '', 'I', 10, 0, 1, 5),
(49, 'Complemento', 'complemento', '', 'I', 10, 0, 0, 6),
(50, 'Latitude', 'latitude', '', 'I', 10, 0, 0, 0),
(51, 'Longitude', 'longitude', '', 'I', 10, 0, 0, 0),
(52, 'CEP', 'cep', '', 'I', 10, 0, 1, 1),
(53, 'Criado_em', 'criado_em', '', 'DT', 10, 0, 0, 0),
(54, 'Editado_em', 'editado_em', '', 'DT', 10, 0, 0, 0),
(55, 'Nome/Razão Social', 'nome', '', 'I', 11, 1, 1, 0),
(56, 'Nome Fantasia', 'nome_fantasia', '', 'I', 11, 0, 0, 1),
(57, 'Senha', 'senha', '', 'I', 11, 0, 0, 11),
(58, 'E-mail', 'email', '', 'I', 11, 1, 1, 3),
(59, 'Telefone', 'telefone', '', 'I', 11, 1, 1, 4),
(60, 'CNPJ', 'cnpj', '', 'I', 11, 1, 1, 2),
(61, 'Udid', 'udid', '', 'I', 11, 0, 0, 0),
(62, 'Endereço', 'endereco', '', 'I', 11, 0, 1, 6),
(63, 'Número', 'numero', '', 'I', 11, 0, 1, 7),
(64, 'Complemento', 'complemento', '', 'I', 11, 0, 0, 8),
(65, 'Cidade', 'cidade', '', 'SC', 11, 0, 0, 9),
(66, 'Estado', 'estado', '', 'I', 11, 0, 0, 10),
(67, 'CEP', 'cep', '', 'I', 11, 0, 1, 5),
(68, 'Latitude', 'latitude', '', 'I', 11, 0, 0, 0),
(69, 'Longitude', 'longitude', '', 'I', 11, 0, 0, 0),
(70, 'Criado_em', 'criado_em', '', 'I', 11, 0, 0, 0),
(71, 'Editado_em', 'editado_em', '', 'I', 11, 0, 0, 0),
(72, 'Descrição', 'descricao', '', 'T', 11, 0, 0, 4),
(73, 'Bairro', 'bairro', '', 'I', 10, 0, 1, 3),
(74, 'Bairro', 'bairro', '', 'I', 11, 0, 1, 8),
(75, 'Nome', 'nome', '', 'I', 12, 1, 1, 1),
(76, 'Código', 'codigo', '', 'I', 12, 1, 1, 0),
(78, 'Título', 'titulo', '', 'I', 15, 1, 1, 0),
(79, 'Descrição', 'descricao', '', 'T', 15, 0, 0, 0),
(80, 'Endereço', 'endereco', '', 'T', 15, 0, 0, 0),
(81, 'Aceito', 'aceito', '', 'INT', 15, 0, 0, 0),
(82, 'Data/Hora realização', 'data_realizacao', '', 'DT', 15, 0, 0, 0),
(83, 'Finalizado', 'finalizado', '', 'INT', 15, 0, 0, 0),
(84, 'Reparo emergencial', 'reparo_emergencial', '', 'INT', 15, 0, 0, 0),
(85, 'Valor', 'valor', '', 'I', 15, 0, 0, 0),
(86, 'Valor Chamada', 'valor_chamada', '', 'I', 15, 0, 0, 0),
(87, 'Data Criação', 'criado_em', '', 'DT', 15, 1, 0, 0),
(88, 'Editado em', 'editado_em', '', 'DT', 15, 0, 0, 0),
(90, 'Avaliação', 'avaliacao', '', 'INT', 17, 1, 0, 0),
(91, 'Comentário', 'comentario', '', 'T', 17, 1, 0, 0),
(92, 'Criado em', 'criado_em', '', 'DT', 17, 1, 0, 0),
(96, 'Avaliação', 'avaliacao', '', 'INT', 19, 1, 0, 0),
(97, 'Comentário', 'comentario', '', 'T', 19, 1, 0, 0),
(98, 'Criado em', 'criado_em', '', 'DT', 19, 1, 0, 0),
(99, 'Cidade', 'cidade', '', 'I', 20, 1, 1, 0),
(100, 'Ativo', 'ativo', '', 'S', 11, 0, 0, 9),
(101, 'Avaliação', 'avaliacao', '', 'INT', 10, 1, 0, 0),
(102, 'Avaliação', 'avaliacao', '', 'INT', 11, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sis_fk_modulo`
--

CREATE TABLE IF NOT EXISTS `sis_fk_modulo` (
  `id` int(11) unsigned NOT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `id_modulo_relacionado` int(11) DEFAULT NULL,
  `id_campo_modulo_relacionado` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `listagem` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sis_fk_modulo`
--

INSERT INTO `sis_fk_modulo` (`id`, `id_modulo`, `id_modulo_relacionado`, `id_campo_modulo_relacionado`, `nome`, `label`, `ordem`, `listagem`) VALUES
(7, 15, 10, 39, 'id_cliente', 'Cliente', 0, 1),
(8, 15, 11, 55, 'id_fornecedor', 'Fornecedor', 0, 1),
(12, 15, 12, 75, 'id_categoria', 'Categoria', 0, 1),
(13, 17, 11, 55, 'id_fornecedor', 'Fornecedor', 0, 1),
(14, 17, 10, 39, 'id_cliente', 'Cliente', 0, 1),
(17, 19, 11, 55, 'id_fornecedor', 'Fornecedor', 0, 1),
(18, 19, 10, 39, 'id_cliente', 'Cliente', 0, 1),
(19, 20, 5, 19, 'estado', 'Estado', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sis_migrations`
--

CREATE TABLE IF NOT EXISTS `sis_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sis_modulos`
--

CREATE TABLE IF NOT EXISTS `sis_modulos` (
  `id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_modulos`
--

INSERT INTO `sis_modulos` (`id`, `label`, `icone`, `ordem`, `menu`, `nome`, `id_tipo_modulo`, `rota`, `item_modulo`, `items_modulo`, `imagem`, `galeria`, `nome_tabela`) VALUES
(5, 'Estados', 'fa-circle-o', 0, 0, 'Estados', 3, 'estados', 'estado', 'estados', 0, 0, 'estados'),
(10, 'Clientes', 'ion-person-stalker', 0, 1, 'Clientes', 1, 'clientes', 'cliente', 'clientes', 1, 0, 'clientes'),
(11, 'Fornecedores', 'ion-hammer', 0, 1, 'Fornecedores', 1, 'fornecedores', 'fornecedor', 'fornecedor', 1, 0, 'fornecedores'),
(12, 'Categorias', 'fa-circle-o', 0, 1, 'Categorias', 1, 'categorias', 'categoria', 'categorias', 0, 0, 'categorias'),
(15, 'Solicitações', 'ion-android-notifications', 0, 1, 'Solicitacoes', 1, 'solicitacoes', 'solicitacao', 'solicitacoes', 1, 0, 'solicitacoes'),
(17, 'Avaliações', 'ion-ios-star', 1, 1, 'AvaliacoesFornecedores', 1, 'avaliacoes-fornecedores', 'avaliacao_fornecedor', 'avaliacoes_fornecedores', 0, 0, 'avaliacoes_fornecedores'),
(19, 'Avaliações Clientes', 'fa-circle-o', 0, 0, 'AvaliacoesClientes', 1, 'avaliacoes-clientes', 'avaliacao_cliente', 'avaliações_clientes', 0, 0, 'avaliacoes_clientes'),
(20, 'Cadastro de Cidades', 'ion-ios-location', 1, 1, 'Cidades', 1, 'cidades', 'cidade', 'cidades', 0, 0, 'cidades');

-- --------------------------------------------------------

--
-- Table structure for table `sis_password_resets`
--

CREATE TABLE IF NOT EXISTS `sis_password_resets` (
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

CREATE TABLE IF NOT EXISTS `sis_permissions` (
  `id` int(11) unsigned NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sis_persistences`
--

CREATE TABLE IF NOT EXISTS `sis_persistences` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=420 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(413, 9, 'G655rQYX12efXukgOcIlrPdhKOzstiRi', NULL, NULL),
(415, 9, 'mqIazoCJNZ8Pt0l5hDjtv6xtQ4twEZVD', NULL, NULL),
(416, 1, 'AIolzCnsa6mT3vd26YtNZiRtPbB1oHmQ', NULL, NULL),
(417, 9, 'NwxtB7dkqZbQfQMZcKITMcK5ybiyZ8JP', NULL, NULL),
(418, 9, 'sXHC3XSx5Y1nRCsmBDv6bpN5wHOPGSmb', NULL, NULL),
(419, 9, 'QcChlNKOelAzfKeXAjfdyYVghZy6og0p', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sis_reminders`
--

CREATE TABLE IF NOT EXISTS `sis_reminders` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
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

CREATE TABLE IF NOT EXISTS `sis_roles` (
  `id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_roles`
--

INSERT INTO `sis_roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admins', 'Administradores', '{"batata.view":true,"batata.create":true,"batata.update":true,"batata.delete":true,"clientes.view":true,"clientes.create":true,"clientes.update":true,"clientes.delete":true,"consultas.view":true,"consultas.create":true,"consultas.update":true,"consultas.delete":true,"estados.view":true,"estados.create":true,"estados.update":true,"estados.delete":true,"cidades.view":true,"cidades.create":true,"cidades.update":true,"cidades.delete":true,"tipos.view":true,"tipos.create":true,"tipos.update":true,"tipos.delete":true,"noticias.view":true,"noticias.create":true,"noticias.update":true,"noticias.delete":true,"fornecedores.view":true,"fornecedores.create":true,"fornecedores.update":true,"fornecedores.delete":true,"categorias.view":true,"categorias.create":true,"categorias.update":true,"categorias.delete":true,"solicitacoes.view":true,"solicitacoes.create":true,"solicitacoes.update":true,"solicitacoes.delete":true,"avaliacoes_fornecedores.view":true,"avaliacoes_fornecedores.create":true,"avaliacoes_fornecedores.update":true,"avaliacoes_fornecedores.delete":true,"avaliacoes_clientes.view":true,"avaliacoes_clientes.create":true,"avaliacoes_clientes.update":true,"avaliacoes_clientes.delete":true}', '2017-07-20 18:32:20', '2017-07-20 18:32:20'),
(3, 'usuarios', 'Usuários', '{"clientes.view":true,"clientes.create":true,"clientes.update":true,"clientes.delete":true,"fornecedores.view":true,"fornecedores.create":true,"fornecedores.update":true,"fornecedores.delete":true,"categorias.view":true,"categorias.create":true,"categorias.update":true,"categorias.delete":true,"solicitacoes.view":true,"solicitacoes.create":true,"solicitacoes.update":true,"solicitacoes.delete":true,"avaliacoes_fornecedores.view":true,"avaliacoes_fornecedores.create":true,"avaliacoes_fornecedores.update":true,"avaliacoes_fornecedores.delete":true,"avaliacoes_clientes.view":true,"avaliacoes_clientes.create":true,"avaliacoes_clientes.update":true,"avaliacoes_clientes.delete":true,"cidades.view":true,"cidades.create":true,"cidades.update":true,"cidades.delete":true}', '2017-07-20 20:29:49', '2017-07-20 20:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `sis_role_users`
--

CREATE TABLE IF NOT EXISTS `sis_role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_role_users`
--

INSERT INTO `sis_role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-08-31 22:26:41', '2017-08-31 22:26:41'),
(2, 3, '2017-08-08 20:37:43', '2017-08-08 20:37:43'),
(3, 2, '2017-07-20 21:36:06', '2017-07-20 21:36:06'),
(3, 3, '2017-07-24 21:23:09', '2017-07-24 21:23:09'),
(5, 3, '2017-08-21 23:08:20', '2017-08-21 23:08:20'),
(6, 3, '2017-08-22 16:56:30', '2017-08-22 16:56:30'),
(7, 3, '2017-08-08 20:49:12', '2017-08-08 20:49:12'),
(8, 3, '2017-08-22 21:22:57', '2017-08-22 21:22:57'),
(9, 3, '2017-09-29 22:03:59', '2017-09-29 22:03:59'),
(18, 3, '2017-07-20 23:52:53', '2017-07-20 23:52:53'),
(19, 1, '2017-07-21 00:00:00', '2017-07-21 00:00:00'),
(20, 1, '2017-07-21 00:00:21', '2017-07-21 00:00:21'),
(28, 3, '2017-07-21 16:06:48', '2017-07-21 16:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `sis_throttle`
--

CREATE TABLE IF NOT EXISTS `sis_throttle` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(129, NULL, 'ip', '189.127.16.97', NULL, NULL),
(130, 1, 'user', NULL, NULL, NULL),
(131, NULL, 'global', NULL, NULL, NULL),
(132, NULL, 'ip', '189.127.16.97', NULL, NULL),
(133, 9, 'user', NULL, NULL, NULL),
(134, NULL, 'global', NULL, NULL, NULL),
(135, NULL, 'ip', '177.132.206.136', NULL, NULL),
(136, 9, 'user', NULL, NULL, NULL),
(137, NULL, 'global', NULL, NULL, NULL),
(138, NULL, 'ip', '177.132.206.136', NULL, NULL),
(139, 9, 'user', NULL, NULL, NULL),
(140, NULL, 'global', NULL, NULL, NULL),
(141, NULL, 'ip', '189.127.16.97', NULL, NULL),
(142, 9, 'user', NULL, NULL, NULL),
(143, NULL, 'global', NULL, NULL, NULL),
(144, NULL, 'ip', '189.127.16.97', NULL, NULL),
(145, 9, 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sis_tipos_modulo`
--

CREATE TABLE IF NOT EXISTS `sis_tipos_modulo` (
  `id` int(11) unsigned NOT NULL,
  `nome` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `controller_admin` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_admin_index` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_admin_form` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rotas` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE IF NOT EXISTS `sis_users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sis_users`
--

INSERT INTO `sis_users` (`id`, `email`, `cnpj`, `password`, `permissions`, `responsavel`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`, `receber_notificacoes`, `thumbnail_principal`, `id_condomino`, `id_criador`, `udid`, `latitude`, `longitude`, `telefone`, `telefone2`, `celular`, `descricao`, `endereco`, `estado`, `cidade`, `cep`, `numero`, `complemento`, `bairro`, `hora_inicio_manha`, `hora_fim_manha`, `hora_inicio_tarde`, `hora_fim_tarde`, `hora_inicio_noite`, `hora_fim_noite`) VALUES
(1, 'ricardo@duostudio.com.br', '00.000.000/0000-00', '$2y$10$vGH4bEBTQVbQgo4Rcbd0NuoNQKE35uSA.Nhg0lWpAqUDo2UWBYtg6', NULL, 'ricardo', '2017-10-02 15:25:43', 'Ricardo Farias', 'Tronca', '2017-02-21 05:00:34', '2017-10-02 12:25:43', 0, 'thumb_1504207575-logo.jpg', NULL, NULL, NULL, '-15.753151', '-47.880227200000036', '(54)9999-9999', '', '', '', 'Rua Ernesto Alves', 23, 3945, '95020-360', '123456', '', 'Lurdes', '12:00:00', '00:00:00', '00:00:00', '00:00:00', '15:30:00', '17:00:00'),
(9, 'prolar@prolar.com.br', '11.111.111/1111-11', '$2y$10$R0VvpXaRVLG9sVChwXb90ejzeP2EktiTlvh/jO0FHTq0PjxmGLRKm', NULL, 'Prolar', '2017-10-03 21:03:16', 'Prolar', NULL, '2017-09-29 17:49:08', '2017-10-03 18:03:16', 0, '', NULL, NULL, NULL, '-29.1675192', '-51.16811640000003', '', '', '', '', 'Avenida Júlio de Castilhos', 23, 1, '95010-003', '657', '', 'Lurdes', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `solicitacoes`
--

CREATE TABLE IF NOT EXISTS `solicitacoes` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_descricao` text,
  `slug` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` text,
  `endereco` text,
  `aceito` int(11) DEFAULT '2',
  `data_realizacao` timestamp NULL DEFAULT NULL,
  `finalizado` int(11) DEFAULT '2',
  `reparo_emergencial` int(11) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `valor_chamada` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_cliente` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `thumbnail_principal`, `meta_keywords`, `meta_descricao`, `slug`, `titulo`, `descricao`, `endereco`, `aceito`, `data_realizacao`, `finalizado`, `reparo_emergencial`, `valor`, `valor_chamada`, `criado_em`, `editado_em`, `id_cliente`, `id_fornecedor`, `id_categoria`) VALUES
(9, NULL, NULL, NULL, '', 'Reparo teste', 'sd;lsdf;lsdfl;dfk;lskfl;k; l k;la', 'Rua tal, 123', 2, '2017-09-25 14:51:15', 2, 0, NULL, NULL, '2017-09-25 14:51:15', '2017-09-29 14:38:06', 1, NULL, 280),
(10, NULL, NULL, NULL, '', 'Reparo teste', 'sd;lsdf;lsdfl;dfk;lskfl;k; l k;la', 'Rua tal, 123', 2, '2017-09-25 14:51:18', 2, 0, NULL, NULL, '2017-09-25 14:51:18', '2017-09-29 14:38:06', 1, NULL, 280),
(11, '""', NULL, NULL, '', 'Reparo teste', 'sd;lsdf;lsdfl;dfk;lskfl;k; l k;la', 'Rua tal, 123', 2, '2017-09-26 17:00:10', 2, 1, NULL, NULL, '2017-09-26 17:00:10', '2017-09-29 14:38:06', 1, NULL, 280),
(12, '""', NULL, NULL, '', 'Reparo teste', 'sd;lsdf;lsdfl;dfk;lskfl;k; l k;la', 'Rua tal, 123', 2, '2017-09-26 18:00:29', 2, 1, NULL, NULL, '2017-09-26 18:00:29', '2017-09-29 14:38:06', 1, NULL, 280),
(13, '""', NULL, NULL, '', 'Reparo teste', 'sd;lsdf;lsdfl;dfk;lskfl;k; l k;la', 'Rua tal, 123', 2, '2017-09-26 18:00:57', 2, 1, NULL, NULL, '2017-09-26 18:00:57', '2017-09-29 14:38:06', 1, NULL, 280),
(14, '""', NULL, NULL, '', 'Reparo teste', NULL, 'Rua tal, 123', 2, '2017-09-26 18:33:58', 2, 1, NULL, NULL, '2017-09-26 18:33:58', '2017-09-29 14:38:06', 1, NULL, 280);

-- --------------------------------------------------------

--
-- Table structure for table `solicitacoes_fornecedores`
--

CREATE TABLE IF NOT EXISTS `solicitacoes_fornecedores` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL DEFAULT '0',
  `id_solicitacao` int(11) NOT NULL DEFAULT '0',
  `valor` decimal(10,0) NOT NULL DEFAULT '0',
  `valor_chamada` decimal(10,0) NOT NULL DEFAULT '0',
  `aceito` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `solicitacoes_imagens`
--

CREATE TABLE IF NOT EXISTS `solicitacoes_imagens` (
  `id` int(11) NOT NULL,
  `thumbnail_principal` varchar(255) DEFAULT NULL,
  `id_solicitacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacoes_clientes`
--
ALTER TABLE `avaliacoes_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `avaliacoes_clientes_imagens`
--
ALTER TABLE `avaliacoes_clientes_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avaliacoes_fornecedores`
--
ALTER TABLE `avaliacoes_fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `avaliacoes_fornecedores_imagens`
--
ALTER TABLE `avaliacoes_fornecedores_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias_imagens`
--
ALTER TABLE `categorias_imagens`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes_imagens`
--
ALTER TABLE `clientes_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Estado_pais` (`pais`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedores_categorias`
--
ALTER TABLE `fornecedores_categorias`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_fornecedor` (`id_fornecedor`) USING BTREE;

--
-- Indexes for table `fornecedores_imagens`
--
ALTER TABLE `fornecedores_imagens`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes` (`id_cliente`),
  ADD KEY `fornecedores` (`id_fornecedor`),
  ADD KEY `categoria` (`id_categoria`) USING BTREE;

--
-- Indexes for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitacao` (`id_solicitacao`) USING BTREE,
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Indexes for table `solicitacoes_imagens`
--
ALTER TABLE `solicitacoes_imagens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacoes_clientes`
--
ALTER TABLE `avaliacoes_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `avaliacoes_clientes_imagens`
--
ALTER TABLE `avaliacoes_clientes_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `avaliacoes_fornecedores`
--
ALTER TABLE `avaliacoes_fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `avaliacoes_fornecedores_imagens`
--
ALTER TABLE `avaliacoes_fornecedores_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=351;
--
-- AUTO_INCREMENT for table `categorias_imagens`
--
ALTER TABLE `categorias_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cidades_imagens`
--
ALTER TABLE `cidades_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clientes_imagens`
--
ALTER TABLE `clientes_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `fornecedores_categorias`
--
ALTER TABLE `fornecedores_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT for table `fornecedores_imagens`
--
ALTER TABLE `fornecedores_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sis_activations`
--
ALTER TABLE `sis_activations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sis_basic_info`
--
ALTER TABLE `sis_basic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sis_campo_modulo`
--
ALTER TABLE `sis_campo_modulo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `sis_fk_modulo`
--
ALTER TABLE `sis_fk_modulo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `sis_modulos`
--
ALTER TABLE `sis_modulos`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sis_permissions`
--
ALTER TABLE `sis_permissions`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sis_persistences`
--
ALTER TABLE `sis_persistences`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=420;
--
-- AUTO_INCREMENT for table `sis_reminders`
--
ALTER TABLE `sis_reminders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sis_roles`
--
ALTER TABLE `sis_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sis_throttle`
--
ALTER TABLE `sis_throttle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `sis_tipos_modulo`
--
ALTER TABLE `sis_tipos_modulo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sis_users`
--
ALTER TABLE `sis_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `solicitacoes_imagens`
--
ALTER TABLE `solicitacoes_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacoes_clientes`
--
ALTER TABLE `avaliacoes_clientes`
  ADD CONSTRAINT `avaliacoes_clientes_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avaliacoes_clientes_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `avaliacoes_fornecedores`
--
ALTER TABLE `avaliacoes_fornecedores`
  ADD CONSTRAINT `avaliacoes_fornecedores_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avaliacoes_fornecedores_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitacoes_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `solicitacoes_fornecedores`
--
ALTER TABLE `solicitacoes_fornecedores`
  ADD CONSTRAINT `fk_solic_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_solic_forn` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
