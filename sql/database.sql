SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produtos` (
  `idProdutos` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `idCategorias` int(11) NOT NULL,
  `idRaridades` int(11) NOT NULL,
  `idUniversos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `raridades` (
  `idRaridades` int(11) NOT NULL,
  `nivel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `universos` (
  `idUniversos` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('User','Admin') NOT NULL DEFAULT 'User',
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `user` (`idUser`, `nome`, `email`, `cpf`, `senha`, `tipo`, `cep`, `logradouro`, `bairro`, `cidade`, `estado`) VALUES
(1, 'Admin', 'admin@loki.com', '', '102030', 'Admin', '', '', '', '', '');

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
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produtos`
  MODIFY `idProdutos` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `raridades`
  MODIFY `idRaridades` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `universos`
  MODIFY `idUniversos` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idCategorias`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`idRaridades`) REFERENCES `raridades` (`idRaridades`),
  ADD CONSTRAINT `produtos_ibfk_3` FOREIGN KEY (`idUniversos`) REFERENCES `universos` (`idUniversos`);
COMMIT;

