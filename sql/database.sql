SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorias` (`idCategoria`, `nome`) VALUES
(1, 'Variantes do Loki'),
(2, 'Dispositivos da AVT'),
(3, 'Artefatos Temporais');

CREATE TABLE `produtos` (
  `idProdutos` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `idCategorias` int(11) NOT NULL,
  `idRaridades` int(11) NOT NULL,
  `idUniversos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `produtos` (`idProdutos`, `nome`, `preco`, `imagem`, `idCategorias`, `idRaridades`, `idUniversos`) VALUES
(1, 'Loki Clássico', 100000.00, '1750807977_classic_loki.avif', 1, 3, 2),
(2, 'Kid Loki', 50000.00, '1750805435_kid_loki.jpg', 1, 2, 2),
(3, 'Alligator Loki', 500000.00, '1750805631_Alligator_Loki_listens.webp', 1, 4, 2),
(4, 'Sylvie', 1000000.00, '1750805686_sylvie_loki.webp', 1, 5, 2),
(5, 'Loki Presidente', 1000000.00, '1750808065_president_loki.webp', 1, 5, 2),
(6, 'TemPad', 10000.00, '1750806307_tempad.webp', 2, 1, 1),
(7, 'Bastão de Redefinição Temporal', 50000.00, '1750807017_bastao_avt.webp', 2, 2, 1),
(8, 'Granada de Redefinição Temporal', 100000.00, '1750807344_granada_avt.webp', 2, 3, 1),
(9, 'Linha do Tempo Sagrada', 500000.00, '1750808414_linhaTempo_loki.png', 2, 2, 2),
(10, 'Colete de Campo da AVT', 10000.00, '1750806950_colete_avt.jpg', 2, 1, 1),
(11, 'Pedra do Tempo (Fragmento)', 500000.00, '1750807647_tempo_loki.avif', 3, 4, 3),
(12, 'Cetro Original de Loki', 500000.00, '1750436681_cetro_loki.jpg', 3, 4, 3),
(13, 'Coroa do Loki Prime', 1000000.00, '1750807762_coroa_loki.avif', 3, 5, 2),
(14, 'Runas do Engano Antigo', 100000.00, '1750807440_runa_loki.png', 3, 3, 3),
(15, 'Orbe de Fluxo Temporal', 100000.00, '1750807545_orbe_loki.jpeg', 3, 3, 2);

CREATE TABLE `raridades` (
  `idRaridades` int(11) NOT NULL,
  `nivel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `raridades` (`idRaridades`, `nivel`) VALUES
(1, 'Comum'),
(2, 'Incomum'),
(3, 'Raro'),
(4, 'Lendário'),
(5, 'Único');

CREATE TABLE `universos` (
  `idUniversos` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `universos` (`idUniversos`, `nome`) VALUES
(1, 'AVT'),
(2, 'Linha do Tempo Ramificada'),
(3, 'Terra-616');

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('User','Admin') NOT NULL DEFAULT 'User',
  `cep` varchar(9) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`idUser`, `nome`, `email`, `cpf`, `senha`, `tipo`, `cep`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(4, 'João Vitor', 'joao@gmail.com', '45612350255', '$2y$10$Ka6zlup2vtTxl4iHSqBICuoD03cDaX7CvZEwK5WSHEGHTwy7d.uc2', 'Admin', '13041445', 'Rua da Abolição', 'Ponte Preta', 'Campinas', 'SP');

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProdutos`),
  ADD KEY `idCategorias` (`idCategorias`),
  ADD KEY `idRaridades` (`idRaridades`),
  ADD KEY `idUniversos` (`idUniversos`);

ALTER TABLE `raridades`
  ADD PRIMARY KEY (`idRaridades`);

ALTER TABLE `universos`
  ADD PRIMARY KEY (`idUniversos`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `produtos`
  MODIFY `idProdutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `raridades`
  MODIFY `idRaridades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `universos`
  MODIFY `idUniversos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idCategorias`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`idRaridades`) REFERENCES `raridades` (`idRaridades`),
  ADD CONSTRAINT `produtos_ibfk_3` FOREIGN KEY (`idUniversos`) REFERENCES `universos` (`idUniversos`);
COMMIT;