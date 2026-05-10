-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2026 a las 04:25:18
-- Versión del servidor: 10.11.14-MariaDB-0+deb12u2
-- Versión de PHP: 8.2.30

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
  `id_chat` int(11) NOT NULL,
  `Id_sala` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `Contenido` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participa`
--

CREATE TABLE `Participa` (
  `id_participacion` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `Id_sala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Ubicacion` varchar(100) NOT NULL,
  `Fecha` datetime NOT NULL,
  `nickname` varchar(100) NOT NULL COMMENT 'nick del creador',
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Sala`
--

INSERT INTO `Sala` (`Id_sala`, `Titulo`, `Descripcion`, `Modalidad`, `Ubicacion`, `Fecha`, `nickname`, `Estado`) VALUES
(1, 'ALGO', 'PRUEBA1', 'virtual', 'MI PC', '2026-05-12 12:30:00', '1', 'EN_PREPARACION'),
(2, 'ALGO2', 'PRUEBA2', 'virtual', 'MI PC2', '2026-05-15 12:30:00', '1', 'EN_PREPARACION'),
(3, 'ALGO3', 'PRUEBA3', 'virtual', 'MI PC3', '2026-05-16 12:30:00', '1', 'EN_PREPARACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `nickname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`nickname`, `password`, `Link`) VALUES
('1', '$2y$10$gMjNyg3ij9aVR3kLowOhd.6nbMabes5d0Hze75DQXtS2PyDVsv6vO', NULL);

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
  ADD KEY `id_User` (`nickname`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Sala`
--
ALTER TABLE `Sala`
  MODIFY `Id_sala` int(11) NOT NULL AUTO_INCREMENT COMMENT 'No se setea, es Auto Increment!', AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `Sala_ibfk_1` FOREIGN KEY (`nickname`) REFERENCES `Usuario` (`nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
