-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Out-2023 às 06:02
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `novoestilo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `Cod_Cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `datenasc` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`Cod_Cliente`, `nome`, `cpf`, `datenasc`, `email`, `senha`, `tel`, `cep`, `nivel`) VALUES
(38, 'Gabriel', '228.597.847-21', '2005-12-05', 'gabrielmrolim2012@outlook.com', '1234', '(22)22222-222', '22222-222', 'cliente'),
(39, 'Gabriel', '228.597.847-21', '2005-12-04', 'adm@gmail.com', '1234', '(22)22222-222', '22222-222', 'funcionario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itenspedido`
--

CREATE TABLE `itenspedido` (
  `Cod_Produto` int(11) NOT NULL,
  `Num_Pedido` int(11) NOT NULL,
  `Qtd_Produto` int(11) NOT NULL,
  `Valor_Item` double NOT NULL,
  `id_itenspedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itenspedido`
--

INSERT INTO `itenspedido` (`Cod_Produto`, `Num_Pedido`, `Qtd_Produto`, `Valor_Item`, `id_itenspedido`) VALUES
(3, 25, 2, 34.99, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `Num_Pedido` int(11) NOT NULL,
  `Data_Pedido` date NOT NULL,
  `Hora_Pedido` time NOT NULL,
  `FPgto_Pedido` varchar(255) NOT NULL,
  `Cod_Cliente` int(11) NOT NULL,
  `Cod_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`Num_Pedido`, `Data_Pedido`, `Hora_Pedido`, `FPgto_Pedido`, `Cod_Cliente`, `Cod_Status`) VALUES
(25, '2023-10-03', '05:21:58', 'boleto', 38, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `Cod_Produto` int(11) NOT NULL,
  `Nome_Produto` varchar(255) NOT NULL,
  `Preco_Produto` double NOT NULL,
  `Foto_Produto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`Cod_Produto`, `Nome_Produto`, `Preco_Produto`, `Foto_Produto`) VALUES
(1, 'ROUPA1', 29.99, '../img/products/1.jpg'),
(2, 'ROUPA2', 39.99, '../img/products/2.jpg'),
(3, 'ROUPA3', 34.99, '../img/products/3.jpg'),
(4, 'ROUPA4', 29.99, '../img/products/4.jpg'),
(5, 'ROUPA5', 29.99, '../img/products/5.jpg'),
(6, 'ROUPA6', 39.99, '../img/products/6.jpg'),
(7, 'ROUPA7', 34.99, '../img/products/7.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `Cod_Status` int(11) NOT NULL,
  `Descr_Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`Cod_Status`, `Descr_Status`) VALUES
(1, 'aguardando'),
(2, 'entregue');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`Cod_Cliente`);

--
-- Índices para tabela `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD PRIMARY KEY (`id_itenspedido`),
  ADD KEY `numpedido` (`Num_Pedido`),
  ADD KEY `codProduto` (`Cod_Produto`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`Num_Pedido`),
  ADD KEY `Codigo_Cliente` (`Cod_Cliente`) USING BTREE,
  ADD KEY `Cod_Status` (`Cod_Status`) USING BTREE;

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`Cod_Produto`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Cod_Status`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `Cod_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `itenspedido`
--
ALTER TABLE `itenspedido`
  MODIFY `id_itenspedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `Num_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `Cod_Produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `Cod_Status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD CONSTRAINT `itenspedido_ibfk_1` FOREIGN KEY (`Cod_Produto`) REFERENCES `produto` (`Cod_Produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itenspedido_ibfk_2` FOREIGN KEY (`Num_Pedido`) REFERENCES `pedidos` (`Num_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Cod_Status`) REFERENCES `status` (`Cod_Status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`Cod_Cliente`) REFERENCES `cadastro` (`Cod_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
