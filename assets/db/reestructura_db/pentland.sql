SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rol` (`id_rol`, `name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'seller');

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `cel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` longtext DEFAULT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cel` (`cel`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD KEY `FK_rol1` (`rol`);

ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  ADD CONSTRAINT `FK_rol1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;