-- Eliminar la base de datos si ya existe y luego crearla nuevamente
DROP DATABASE IF EXISTS `seller`;
CREATE DATABASE `seller`;
USE `seller`;

-- Crear la tabla 'rol' con la estructura adecuada
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en la tabla 'rol'
INSERT INTO `rol` (`name`) VALUES
('Super-Admin'),
('Admin'),
('Seller'),
('User');

-- Crear la tabla 'user' con la estructura adecuada
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` longtext COLLATE utf8mb4_general_ci,
  `rol` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cel` (`cel`),
  UNIQUE KEY `id_number` (`id_number`),
  CONSTRAINT `FK_rol1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar datos en la tabla 'user'
INSERT INTO `user` (`name`, `lastname`, `id_number`, `cel`, `email`, `pass`, `rol`) VALUES
('jose', 'bohorquez', '1119217998', '3178773186', 'bd@gmail.com', 'eadf70239a5141cd8429dfd035bce39f1794613b', 3);

-- Crear la tabla 'offers' con la estructura adecuada
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `term` int DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Crear la tabla 'products' con la estructura adecuada
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `technical_description` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image` (`image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Asegurar que el AUTO_INCREMENT de 'rol' y 'user' continúe correctamente
ALTER TABLE `rol` AUTO_INCREMENT = 11;
ALTER TABLE `user` AUTO_INCREMENT = 6;

-- Confirmar transacciones
COMMIT;
