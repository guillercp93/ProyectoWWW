-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2014 a las 19:42:36
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyectowww`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `idCita` int(2) NOT NULL AUTO_INCREMENT,
  `idPaciente` int(20) NOT NULL,
  `idEspecialidad` int(2) NOT NULL,
  `cedMedico` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idCita`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idPaciente`, `idEspecialidad`, `cedMedico`, `fecha`, `hora`, `estado`) VALUES
(18, 1234567890, 1, 14880686, '2014-12-10', '09:00:00', 'cancelada'),
(19, 36251469, 2, 1234567890, '2014-12-12', '10:03:00', 'atendida'),
(20, 12457823, 3, 63552414, '2014-12-26', '15:30:00', 'atendida'),
(21, 36257485, 1, 14880686, '2014-12-23', '14:00:00', 'perdida'),
(22, 98453216, 2, 1234567890, '2014-12-06', '14:00:00', 'cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE IF NOT EXISTS `especialidad` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `nombre`) VALUES
(1, 'ginecólogo'),
(2, 'general'),
(3, 'Cardiologo'),
(5, 'Traumatólogo'),
(6, 'Terapeuta'),
(7, 'adasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `cedula` int(10) NOT NULL,
  `idEspecialidad` int(2) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`cedula`, `idEspecialidad`, `horaInicio`, `horaFinal`) VALUES
(14880686, 1, '08:00:00', '15:00:00'),
(63552414, 3, '08:00:00', '19:00:00'),
(1234567890, 2, '09:09:00', '21:09:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cedula` int(10) NOT NULL,
  `idPerfil` int(2) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `contrasenia` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `idPerfil`, `nombre`, `apellido`, `fechaNacimiento`, `direccion`, `email`, `contrasenia`) VALUES
(123, 0, 'Guillermo', 'Castillo', '1993-05-29', 'cll 10 # 3-19', 'guillercp93@gmail.co', 'guicaspat'),
(14880686, 1, 'Arnul', 'Castillo', '1960-06-19', 'cll 10 nÂ° 3-19', 'gcastillo@gmail.com', 'relatos'),
(38863268, 2, 'Blanca ', 'Patiño', '1963-08-31', 'cll 10 n° 3-19', 'poemma@hotmail.com', 'dejemesi'),
(63552414, 1, 'Alberto', 'Restrepo', '1976-09-30', 'crr 15 # 16-21', 'albert1976@gmail.com', 'alberto123'),
(1234567890, 1, 'Pilar', 'Gutierrez', '1986-01-09', 'cll 4 # 5-18', 'pili@hotmail.com', 'pilar123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
