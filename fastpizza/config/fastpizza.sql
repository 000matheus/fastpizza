-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Dez-2019 às 02:16
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11078974_fastpizza`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` char(2) NOT NULL,
  `tel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_venda`
--

CREATE TABLE `item_venda` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `valor` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Acionadores `item_venda`
--
DELIMITER $$
CREATE TRIGGER `delete_item_venda` AFTER DELETE ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = old.id_venda) WHERE vendas.id = old.id_venda
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_item_venda` AFTER INSERT ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = new.id_venda) WHERE vendas.id = new.id_venda
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_item_venda` AFTER UPDATE ON `item_venda` FOR EACH ROW UPDATE vendas SET valor_total = (SELECT SUM(valor) FROM item_venda WHERE item_venda.id_venda = old.id_venda) WHERE vendas.id = old.id_venda
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `preco_unit` decimal(6,2) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_venda` datetime DEFAULT CURRENT_TIMESTAMP,
  `valor_total` decimal(6,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `item_venda`
--
ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venda` (`id_venda`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_venda`
--
ALTER TABLE `item_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
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
