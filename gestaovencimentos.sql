-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Ago-2023 às 00:56
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestaovencimentos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `id_dep` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`id_dep`, `nome`) VALUES
(3, 'CONTABILIDADEE'),
(4, 'TI'),
(5, 'FINANCEIRO'),
(6, 'COMPRAS'),
(8, 'FAXINA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processamento_salarios`
--

CREATE TABLE `processamento_salarios` (
  `id` int(11) NOT NULL,
  `salario_bruto` decimal(10,2) NOT NULL,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dias_trabalhados` int(11) NOT NULL,
  `desconto_seguranca_social` decimal(10,2) NOT NULL,
  `desconto_irs` decimal(10,2) NOT NULL,
  `alimentacao` decimal(10,2) NOT NULL,
  `salario_liquido` decimal(10,2) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `processamento_salarios`
--

INSERT INTO `processamento_salarios` (`id`, `salario_bruto`, `ano`, `mes`, `dias_trabalhados`, `desconto_seguranca_social`, `desconto_irs`, `alimentacao`, `salario_liquido`, `utilizador_id`, `departamento_id`) VALUES
(12, '2000.00', 2023, 1, 22, '220.00', '320.00', '115.50', '1575.50', 22, 6),
(15, '1500.00', 2023, 3, 23, '165.00', '195.00', '120.75', '1260.75', 23, 3),
(16, '2300.00', 2023, 3, 23, '253.00', '368.00', '120.75', '1799.75', 24, 6),
(17, '1500.00', 2022, 1, 21, '165.00', '195.00', '110.25', '1250.25', 24, 6),
(18, '1500.00', 2021, 7, 22, '165.00', '195.00', '115.50', '1255.50', 24, 6),
(19, '1599.00', 2021, 6, 22, '175.89', '207.87', '115.50', '1330.74', 24, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `nif` varchar(9) NOT NULL,
  `iban` varchar(34) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `cp` varchar(8) NOT NULL,
  `funcao` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'ativo',
  `tipouser` varchar(50) NOT NULL DEFAULT 'user',
  `departamento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `data_nasc`, `nif`, `iban`, `tel`, `email`, `morada`, `localidade`, `cp`, `funcao`, `estado`, `tipouser`, `departamento_id`) VALUES
(22, 'Nicolas Caixeiro', '2019-06-12', '098765432', 'PT23456780987654', '987655333', 'emailnicolas@teste.com', 'Rua nicolas ', 'Nicolal', '0912736', 'comprador', 'ativo', 'user', 6),
(23, 'Juliana', '2001-06-18', '019283874', 'PT50 47834338428792238', '098765456', 'juliana_rh@hotmail.com', 'Rua almir gonçales, 14', 'Setubal', '1290-345', 'Oficial', 'ativo', 'user', 3),
(24, 'Eliseu', '2000-02-24', '298339473', 'PT5048938384394398934', '87654437346', 'eliseu@hotmail.com', 'Rua Caindo de Boca', 'Palmela', '1908-234', 'Engenheiro de Software', 'ativo', 'user', 6),
(25, 'Esther', '1997-05-11', '299222748', 'PTAJSAISAJSIA9382329', '932296760', 'esthercandido21@gmail.com', 'Rua do Parque, 6', 'Palmela', '2950026', 'Developer', 'ativo', 'admin', 4),
(26, 'Hugo Farinha', '1990-05-19', '299123456', 'PT389238297454343765325326', '986756476', 'hugofarinha@gmail.com', 'Rua teste, 190', 'Setubal', '2445-323', 'Developer', 'ativo', 'admin', 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_dep`);

--
-- Índices para tabela `processamento_salarios`
--
ALTER TABLE `processamento_salarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilizador_id` (`utilizador_id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD KEY `fk_departamento` (`departamento_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `processamento_salarios`
--
ALTER TABLE `processamento_salarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `processamento_salarios`
--
ALTER TABLE `processamento_salarios`
  ADD CONSTRAINT `processamento_salarios_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `processamento_salarios_ibfk_2` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_dep`);

--
-- Limitadores para a tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id_dep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
