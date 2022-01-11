-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Dez-2021 às 20:53
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id11078974_fastpizza`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` char(2) NOT NULL,
  `tel` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `endereco`, `bairro`, `cidade`, `uf`, `tel`) VALUES
(1, 'Matheus', 'teste@teste.com', '2108868300f46bfefd711fc76471a49a', 'Rua Tal Tal', 'Esse Aqui', 'Rio de Janeiro', 'RJ', '2121212121'),
(2, 'Guilherme', 'guilherme@teste.com', '2108868300f46bfefd711fc76471a49a', '', 'dahkdgsgddaksg 67', 'dsajda', 'Du', '21986634562'),
(3, 'José', 'jose@teste.com', '2108868300f46bfefd711fc76471a49a', 'Rua do José nº1981', 'Centro', 'São José', 'RJ', '2221212121');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `nome_completo` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `cargo` tinyint(1) DEFAULT NULL,
  `atividade` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_venda`
--

DROP TABLE IF EXISTS `item_venda`;
CREATE TABLE IF NOT EXISTS `item_venda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_venda` int NOT NULL,
  `id_produto` int DEFAULT NULL,
  `valor` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_venda` (`id_venda`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `item_venda`
--

INSERT INTO `item_venda` (`id`, `id_venda`, `id_produto`, `valor`) VALUES
(1, 1, 5, '30.00'),
(2, 2, 2, '27.00'),
(3, 2, 3, '5.00'),
(4, 3, 2, '27.00'),
(5, 3, 1, '26.00'),
(6, 4, 2, '27.00'),
(7, 4, 5, '30.00'),
(8, 4, 3, '5.00'),
(9, 5, 12, '7.00'),
(10, 5, 1, '26.00'),
(11, 5, 4, '27.00');

--
-- Acionadores `item_venda`
--
DROP TRIGGER IF EXISTS `delete_item_venda`;
DELIMITER $$
CREATE TRIGGER `delete_item_venda` AFTER DELETE ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = old.id_venda) WHERE vendas.id = old.id_venda
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_item_venda`;
DELIMITER $$
CREATE TRIGGER `insert_item_venda` AFTER INSERT ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = new.id_venda) WHERE vendas.id = new.id_venda
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_item_venda`;
DELIMITER $$
CREATE TRIGGER `update_item_venda` AFTER UPDATE ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = old.id_venda) WHERE vendas.id = old.id_venda
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `preco_unit` decimal(6,2) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `tipo` int DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco_unit`, `descr`, `tipo`, `imagem`) VALUES
(1, 'Calabresa', '26.00', 'Queijo, calabresa, cebola e azeitona.', 1, '../img/produtos/calabresa.jpg'),
(2, 'Bacon', '27.00', 'Mussarela, bacon, milho e cebola. ', 1, '../img/produtos/bacon.jpg'),
(3, 'Coca-Cola (Lata)', '5.00', 'Contém 350ml', 2, 'https://decisaoentrega.fbitsstatic.net/img/p/refrigerante-coca-cola-lata-350ml-260249/427115-2.jpg?w=420&h=420&v=no-change'),
(4, 'Atum', '27.00', 'Mussarela, atum, azeitona, cebola, orégano', 1, '../img/produtos/atum.jpg'),
(5, 'Camarão', '30.00', 'Mussarela, catupiry, camarão e orégano ', 1, '../img/produtos/camarao.jpg'),
(6, 'Banana', '26.00', 'Banana, Canela, Leite Condensado', 1, '../img/produtos/banana.jpg'),
(7, 'Cinco Queijos', '27.00', 'Molho especial, Mussarela, Prato, Provolone, Queijo Branco, Parmesão, Orégano', 1, '../img/produtos/5queijos.jpg'),
(8, 'Frango com Catupiry', '27.00', 'Molho especial, Mussarela, Catupiry, Frango', 1, '../img/produtos/frango.jpg'),
(9, 'Portuguesa', '28.00', 'Molho Especial, Presunto, Queijo, Cebola, Azeitona, Ovo, Bacalhau', 1, '../img/produtos/portuguesa.jpg\r\n'),
(10, 'Suco de Abacaxi', '5.00', 'Suco feito com abacaxi e hortelã', 2, 'https://cdn.pixabay.com/photo/2017/07/26/06/14/pineapple-2540622_960_720.jpg'),
(11, 'Suco de Maracujá', '5.00', 'Suco feito com Maracujá', 2, 'https://cdn.pixabay.com/photo/2018/04/05/15/38/liquid-3293133_960_720.jpg'),
(12, 'Coca-Cola (Garrafa)', '7.00', 'Contém 2L', 2, 'https://araujo.vteximg.com.br/arquivos/ids/3712944-1000-1000/07894900011753.jpg?v=635869965272970000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `data_venda` datetime DEFAULT CURRENT_TIMESTAMP,
  `valor_total` decimal(6,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_cliente`, `data_venda`, `valor_total`, `status`) VALUES
(1, 1, '2021-12-03 01:01:37', '30.00', 2),
(2, 1, '2021-12-03 15:06:06', '32.00', 0),
(3, 2, '2021-12-03 15:21:21', '53.00', 0),
(4, 3, '2021-12-18 23:39:07', '62.00', 0),
(5, 3, '2021-12-18 23:49:28', '60.00', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `item_venda`
--
ALTER TABLE `item_venda`
  ADD CONSTRAINT `item_venda_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`),
  ADD CONSTRAINT `item_venda_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
