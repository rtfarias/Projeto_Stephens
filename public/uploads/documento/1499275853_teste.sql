SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `jefferson`;

CREATE TABLE `jefferson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pessoa`;

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `produto`;

CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` TEXT DEFAULT NULL,
  `preco` DECIMAL(15,2) DEFAULT NULL,
  `id_pessoa` INT(11),
  PRIMARY KEY (`id`),
  CONSTRAINT ProdutoPessoa FOREIGN KEY (id_pessoa)
  REFERENCES pessoa(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET foreign_key_checks = 1;
