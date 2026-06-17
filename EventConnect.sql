-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2026 a las 08:28:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `EventConnect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Chat`
--

CREATE TABLE `Chat` (
  `id_chat` int(11) NOT NULL COMMENT 'es auto increment',
  `Id_sala` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `Contenido` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Chat`
--

INSERT INTO `Chat` (`id_chat`, `Id_sala`, `nickname`, `Contenido`, `fecha`) VALUES
(1, 4, '1', 'hola', '2026-06-10 23:28:54'),
(2, 4, '1', 'que bien', '2026-06-10 23:29:04'),
(3, 4, '1', 'ayuda', '2026-06-10 23:29:18'),
(4, 4, '1', 'ok', '2026-06-10 23:37:02'),
(5, 4, '2', 'Que dices?', '2026-06-10 23:37:24'),
(6, 4, '2', 'Bién', '2026-06-10 23:37:31'),
(7, 4, '2', 'No pueden con el AWP', '2026-06-10 23:37:46'),
(8, 1, '11', 'lol', '2026-06-15 02:52:34'),
(9, 1, '11', 'xd', '2026-06-15 02:52:38'),
(10, 5, '11', 'gij', '2026-06-16 15:49:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participa`
--

CREATE TABLE `Participa` (
  `id_participacion` int(11) NOT NULL COMMENT 'Es auto increment',
  `nickname` varchar(100) NOT NULL,
  `Id_sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Participa`
--

INSERT INTO `Participa` (`id_participacion`, `nickname`, `Id_sala`) VALUES
(1, '2', 4),
(2, '2', 1),
(3, '2', 7),
(4, '1', 6),
(5, '11', 1),
(6, '11', 6),
(7, '11', 5),
(8, '3', 1),
(9, 'a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ranking`
--

CREATE TABLE `Ranking` (
  `id_Rank` int(11) NOT NULL,
  `nicknameEvaluador` varchar(100) NOT NULL,
  `nicknameEvaluado` varchar(100) NOT NULL,
  `Id_sala` int(11) NOT NULL,
  `Puntaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sala`
--

CREATE TABLE `Sala` (
  `Id_sala` int(11) NOT NULL COMMENT 'No se setea, es Auto Increment!',
  `Titulo` varchar(100) NOT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Modalidad` varchar(20) NOT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `nicknameCreador` varchar(100) NOT NULL COMMENT 'nick del creador',
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Sala`
--

INSERT INTO `Sala` (`Id_sala`, `Titulo`, `Descripcion`, `Modalidad`, `Ubicacion`, `Fecha`, `nicknameCreador`, `Estado`) VALUES
(1, 'ALGO', 'PRUEBA1', 'virtual', 'MI PC', '2026-05-12 12:30:00', '1', 'EN_PREPARACION'),
(2, 'ALGO2', 'PRUEBA2', 'virtual', 'MI PC2', '2026-05-15 12:30:00', '1', 'EN_PREPARACION'),
(3, 'ALGO3', 'PRUEBA3', 'virtual', 'MI PC3', '2026-05-16 12:30:00', '1', 'FINALIZADA'),
(4, 'Counter Strike 1.6 ', 'Jueguito clasico', 'Virtual', NULL, '2026-05-15 12:22:00', '1', 'EN_PREPARACION'),
(5, 'GTA VI', 'Gameboy advance only', 'En Persona', 'Casa de stiguar', '2026-05-27 05:06:00', '1', 'EN_PREPARACION'),
(6, 'lol', '12', 'En Persona', '123', '2026-05-31 12:22:00', 'Matero', 'EN_PREPARACION'),
(7, 'CS Source', 'old', 'Virtual', NULL, '2152-12-12 12:04:00', '1', 'EN_PREPARACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `nickname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `Link` varchar(100) DEFAULT NULL,
  `verifiedUser` tinyint(1) NOT NULL DEFAULT 0,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `Token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`nickname`, `password`, `email`, `edad`, `Link`, `verifiedUser`, `nombre`, `apellido`, `Token`) VALUES
('1', '$2y$10$gMjNyg3ij9aVR3kLowOhd.6nbMabes5d0Hze75DQXtS2PyDVsv6vO', '', 0, NULL, 0, '', '', NULL),
('11', '$2y$10$qNAIZwXouYbkJ8K1h8Tjg.y7FroGQ0wde8b8C8cAVn96fJz0SfkUO', '111@gm.com', 11, 'Discord: http://localhost/phpmyadmin/index.php?route=/sql&db=EventConnect&table=Usuario&pos=0', 1, '11', '11', NULL),
('2', '$2y$10$s5VguCmON72v2dtI.wTqtuPiN/j6NMenYp.58/dj8rSPc3aWDYyzW', '2@gmail.com', 12, 'Sin descripcion', 0, '2', '2', NULL),
('3', '$2y$10$3DdJT39vy5q1G7QijKpX7.gwn0GKOv73IDs8rNFVELYIZJDbtbqOO', '3@gm.com', 3, 'Sin descripcion', 1, '3', '3', NULL),
('4', '$2y$10$DRuWvc5dUFS0VYgtnIG48uKoOSzLarF44tV8CuRUjrZkU8Ut6d8ia', '4@gmia.com', 4, 'Sin descripcion', 1, '4', '4', NULL),
('a', '$2y$10$lazMZYXbRrxTBhiIhg3..eeQyNivUQc3pCJ9rlR0THxiLETZMYGa6', 'a@gm.com', 1, 'Sin descripcion', 1, 'a', 'a', NULL),
('Matero', '$2y$10$me7CYsI4Ef47vTggMJz8uu.R5tTfaxndUMobu3AJhwnhzGw5HMa9C', '', 0, NULL, 0, '', '', NULL),
('sa', '$2y$10$5WUgI07KUtfB36TbWAjmL.QCLivkZzsMuwIhzlIEm2D6AcDuaRJy.', 'sa@1.com', 123, 'Sin descripcion', 0, 'sant', 'sa', NULL),
('santiage', '$2y$10$0XOS7.VTORjIu5rVe1T7JOmCim6DcKgi6G7JFLasFpE0DRXc/W3X6', 'ga@pabo.com', 14, 'Sin descripcion', 0, 'Chileno', 'Sanguinetti', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Chat`
--
ALTER TABLE `Chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `Id_sala` (`Id_sala`),
  ADD KEY `nickname` (`nickname`);

--
-- Indices de la tabla `Participa`
--
ALTER TABLE `Participa`
  ADD PRIMARY KEY (`id_participacion`),
  ADD KEY `nickname` (`nickname`),
  ADD KEY `Id_sala` (`Id_sala`);

--
-- Indices de la tabla `Ranking`
--
ALTER TABLE `Ranking`
  ADD PRIMARY KEY (`id_Rank`),
  ADD KEY `Id_sala` (`Id_sala`),
  ADD KEY `nicknameEvaluado` (`nicknameEvaluado`),
  ADD KEY `nicknameEvaluador` (`nicknameEvaluador`);

--
-- Indices de la tabla `Sala`
--
ALTER TABLE `Sala`
  ADD PRIMARY KEY (`Id_sala`),
  ADD KEY `id_User` (`nicknameCreador`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Chat`
--
ALTER TABLE `Chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'es auto increment', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Participa`
--
ALTER TABLE `Participa`
  MODIFY `id_participacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es auto increment', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Sala`
--
ALTER TABLE `Sala`
  MODIFY `Id_sala` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No se setea, es Auto Increment!', AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Chat`
--
ALTER TABLE `Chat`
  ADD CONSTRAINT `Chat_ibfk_1` FOREIGN KEY (`Id_sala`) REFERENCES `Sala` (`Id_sala`),
  ADD CONSTRAINT `Chat_ibfk_2` FOREIGN KEY (`nickname`) REFERENCES `Usuario` (`nickname`);

--
-- Filtros para la tabla `Participa`
--
ALTER TABLE `Participa`
  ADD CONSTRAINT `Participa_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `Usuario` (`nickname`),
  ADD CONSTRAINT `Participa_ibfk_2` FOREIGN KEY (`Id_sala`) REFERENCES `Sala` (`Id_sala`);

--
-- Filtros para la tabla `Ranking`
--
ALTER TABLE `Ranking`
  ADD CONSTRAINT `Ranking_ibfk_1` FOREIGN KEY (`Id_sala`) REFERENCES `Sala` (`Id_sala`),
  ADD CONSTRAINT `Ranking_ibfk_2` FOREIGN KEY (`nicknameEvaluado`) REFERENCES `Usuario` (`nickname`),
  ADD CONSTRAINT `Ranking_ibfk_3` FOREIGN KEY (`nicknameEvaluador`) REFERENCES `Usuario` (`nickname`);

--
-- Filtros para la tabla `Sala`
--
ALTER TABLE `Sala`
  ADD CONSTRAINT `Sala_ibfk_1` FOREIGN KEY (`nicknameCreador`) REFERENCES `Usuario` (`nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
