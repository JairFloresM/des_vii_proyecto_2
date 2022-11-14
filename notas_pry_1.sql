-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2022 a las 13:30:51
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `notas_pry_1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_crear_nota` (IN `titulo` VARCHAR(255), IN `fecha` DATE, IN `hora` TIME, IN `ubicacion` VARCHAR(255), IN `correo` VARCHAR(255), IN `repetir` TINYINT, IN `tiempo_repetir` TIME, IN `actividad` TINYINT)   BEGIN
    INSERT INTO notas VALUES (null, titulo, fecha, hora, ubicacion, correo, repetir, tiempo_repetir, actividad);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_nota` (IN `param_id` INT)   BEGIN
    DELETE FROM notas   
        WHERE id = param_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_actividades` ()   BEGIN
	SELECT * FROM actividades;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_nota` ()   BEGIN
    select n.id, n.titulo, n.fecha, n.hora, n.ubicacion, n.correo, n.repetir, 
            n.tiempo_repetir_hora, a.descripcion from notas n 
        INNER JOIN actividades a ON a.id = n.id_actividad;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` smallint(5) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `descripcion`) VALUES
(1, 'Deporte'),
(2, 'Trabajo'),
(3, 'Colegio'),
(4, 'Supermercado'),
(5, 'Entretenimiento'),
(6, 'Entretenimiento 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL DEFAULT '',
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `repetir` smallint(1) NOT NULL,
  `tiempo_repetir_hora` time NOT NULL,
  `id_actividad` smallint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `titulo`, `fecha`, `hora`, `ubicacion`, `correo`, `repetir`, `tiempo_repetir_hora`, `id_actividad`) VALUES
(1, 'Titulo test', '2022-10-10', '15:28:26', 'vacamonte', 'correo@correo.com', 1, '00:00:00', 3),
(2, 'Mejor nota', '2022-10-04', '00:29:59', 'tecal', 'corero@correo.com', 1, '00:29:59', 2),
(4, 'Inicia Clases', '2022-10-10', '07:07:00', 'vacamonte', 'correo@correo.com', 1, '00:30:00', 3),
(6, 'Mejor nota', '2022-10-10', '07:07:00', 'Tecal', 'correo@correo.com', 1, '00:30:00', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
