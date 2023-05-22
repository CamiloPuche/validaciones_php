-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2023 a las 08:49:47
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `user`, `password`, `rol`) VALUES
(1, 'camilo', '1234', 'Administrador'),
(2, 'ernesto', '12345', 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `edad`, `sexo`, `direccion`) VALUES
(1, 'Camilo Puche', 24, 'Masculino', 'Tv 18 #9A-87'),
(3, 'Maria Claudia', 24, 'Femenino', 'Tv 18 #9A-87'),
(4, 'Juan Perez', 30, 'Masculino', 'Canta claro'),
(7, 'Elizabeth Gonzalez', 44, 'Femenino', 'Edmundo Lopez'),
(12, 'Camilo Avila', 21, 'Masculino', 'Edmundo Lopez'),
(13, 'Sandra Lopez', 45, 'Masculino', 'Juan XXIII');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario_neto`
--

CREATE TABLE `salario_neto` (
  `id` int(11) NOT NULL,
  `nhoras` int(11) NOT NULL,
  `vhoras` int(11) NOT NULL,
  `salario_basico` float NOT NULL,
  `subsidio` float NOT NULL,
  `retencion` float NOT NULL,
  `seguro_social` float NOT NULL,
  `hextras` float NOT NULL,
  `salario_neto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `salario_neto`
--

INSERT INTO `salario_neto` (`id`, `nhoras`, `vhoras`, `salario_basico`, `subsidio`, `retencion`, `seguro_social`, `hextras`, `salario_neto`) VALUES
(1, 50, 600000, 30000000, 0, 3900000, 1200000, 2400000, 27300000),
(3, 40, 24000, 960000, 96000, 0, 38400, 0, 1017600),
(4, 65, 7999, 519935, 51993.5, 0, 20797.4, 271966, 823097);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salario_neto`
--
ALTER TABLE `salario_neto`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `salario_neto`
--
ALTER TABLE `salario_neto`
  ADD CONSTRAINT `salario_neto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
