DROP TABLE IF EXISTS `z_teste_import`;

CREATE TABLE `z_teste_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teste` varchar(255) DEFAULT NULL,
  `id_teste` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
