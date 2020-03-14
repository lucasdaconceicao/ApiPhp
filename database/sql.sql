
-- Copiando estrutura do banco de dados para testphpcidadao
CREATE DATABASE IF NOT EXISTS `testphpcidadao` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `testphpcidadao`;

-- Copiando estrutura para tabela testphpcidadao.cidadao
CREATE TABLE IF NOT EXISTS `cidadao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

