-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2019 a las 21:01:22
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_gestion_calidad`
--
CREATE DATABASE IF NOT EXISTS `sistema_gestion_calidad` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `sistema_gestion_calidad`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `primKey` int(11) NOT NULL,
  `IDComentario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDDocumento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDUsuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Comentario` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `FechaComentario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`primKey`, `IDComentario`, `IDDocumento`, `IDUsuario`, `Comentario`, `FechaComentario`) VALUES
(8, '4C07AA57-92C0-3239-F004-4FAFA5B09492', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'esta es una prueba del comentario 1', '2019-03-04'),
(9, '0639B1AD-F7CD-160C-5340-5229BC5A8F83', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'Este es un nuevo comentario', '2019-03-05'),
(10, 'B2747ED8-4774-D097-84D1-159952BC6EBB', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'Estos son varios comentarios para testear', '2019-03-05'),
(11, '4783482C-1FAF-E372-6BA6-21C19B49263A', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'Holiwis', '2019-03-05'),
(12, 'B85398A5-4C11-6ADE-D0D5-AB184C309669', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'com1', '2019-03-05'),
(13, '2B3FCD0E-E8CE-03BF-E903-B415265ECBB4', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'com2', '2019-03-05'),
(14, 'C7ED12BF-DEBA-908B-DD32-FBDE7CD7731B', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'com 3', '2019-03-05'),
(15, '28C6BB81-1F1A-7A1F-EE05-C19611D11595', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '', '2019-03-05'),
(16, 'D6C4F16C-35B4-4753-369B-D144F93E8EC1', '6A518C12-F71D-4C35-06D9-E5C92BCA29B5', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'Este es su primer comentario', '2019-03-05'),
(17, '6F0FC193-5ECC-F86E-1C3F-B41141650BFA', '1d524cfa-3cf3-11e9-b4b6-484d7ed7cadg', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'Este es un comentario que quiero dejar que sea multilinea con mucho texto.\r\n\r\nAsi que hare otra linea para eso y.\r\n\r\nYAASPX', '2019-03-07'),
(18, '808E5F1A-BA07-3217-49C1-FAB265997BA1', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'coment', '2019-03-14'),
(19, '13B8F588-0D1C-0542-4F99-5E8AEECE81BD', 'B67641ED-A3E2-BFBD-B852-1368701799DD', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'asdf', '2019-03-14'),
(20, '3CFA917C-A001-92A3-3D20-3DCAA316B76D', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'comentario', '2019-03-19'),
(21, '1B25844C-9924-3318-E363-A8C421828D6C', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'fas', '2019-03-19'),
(22, '7689C10F-7FF7-BA89-63B3-278012A63385', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'sfa', '2019-03-19'),
(23, '46293822-1EE2-55B4-F74D-8C1E41A713CD', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'sfa', '2019-03-19'),
(24, 'DAE4F365-4E35-2411-61CF-738E2D11EC9D', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'dfs', '2019-03-19'),
(25, '3F058609-D10D-A9E2-732E-50B342ACD2B0', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'fdsf', '2019-03-19'),
(26, '264D6541-AC02-1F0A-A8FC-C7AE8887FC5C', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'sdfs', '2019-03-19'),
(27, '684460C8-3B78-2112-BD66-0A61945C10B2', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'sdfs', '2019-03-19'),
(28, '7C12926B-1908-F60C-2F9D-11A6FCD36AEB', 'CB79A55E-9E5D-A3CD-0A7B-50D5794F6B33', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'comentario', '2019-03-19'),
(29, '78FCA0D2-2C7E-BA83-AAF2-5FF4FE733178', 'CB79A55E-9E5D-A3CD-0A7B-50D5794F6B33', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'comentario', '2019-03-19'),
(30, '30A7C02C-C912-F2D6-2B67-ECD9A391E9E6', 'CB79A55E-9E5D-A3CD-0A7B-50D5794F6B33', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'comentario', '2019-03-20'),
(31, '2A79AF8E-C9AE-A24C-E45F-FAC72C3661DC', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(32, 'B078E461-8BE6-CE49-7A76-99A56AB15E2E', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(33, 'B41C4A61-AF23-47F0-EFE6-9A7D947EADD4', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(34, 'AAB8F527-601C-4440-3D1E-3B97753E9CA8', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(35, 'D5DAA3DC-C3E0-5521-B438-BD284AEFB36A', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(36, 'A17E11C4-6A33-4559-5534-7EF1A6B5ABD1', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu comment', '2019-03-20'),
(37, 'F4D7C88F-4A91-8046-C2C1-A19D434D01EE', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'last niu comment', '2019-03-20'),
(38, 'A82FCBC7-4556-1BCC-0561-0238E465685B', 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'comentario', '2019-03-20'),
(39, 'CCE68D40-5425-1A9C-D0BE-BFF56723025C', '334BD574-8AB5-851A-D556-2B34FB19CF20', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'Dragones verdes', '2019-03-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `primKey` int(11) NOT NULL,
  `IDDepartamento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `NombreDepartamento` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`primKey`, `IDDepartamento`, `NombreDepartamento`) VALUES
(1, '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', 'Tecnologia'),
(3, 'd41ee3b9-466c-11e9-b914-484d7ed7cadd', 'Direccion general'),
(4, 'd41ee7c2-466c-11e9-b914-484d7ed7cadd', 'Gestion de calidad'),
(5, 'd41ee846-466c-11e9-b914-484d7ed7cadd', 'Planificacion y desarrollo'),
(6, 'd41ee896-466c-11e9-b914-484d7ed7cadd', 'Farmacias del pueblo'),
(7, 'd41ee8fc-466c-11e9-b914-484d7ed7cadd', 'Control de calidad'),
(8, 'd41ee939-466c-11e9-b914-484d7ed7cadd', 'Tramites y servicios'),
(9, 'd41ee98d-466c-11e9-b914-484d7ed7cadd', 'Departamento administrativo'),
(10, 'd41ee9fa-466c-11e9-b914-484d7ed7cadd', 'Gestion humana'),
(11, 'd41eea3a-466c-11e9-b914-484d7ed7cadd', 'Departamento financiero'),
(12, 'd41eea77-466c-11e9-b914-484d7ed7cadd', 'Consultoria juridica'),
(13, 'd41eeac4-466c-11e9-b914-484d7ed7cadd', 'Compras'),
(14, 'd41eeb01-466c-11e9-b914-484d7ed7cadd', 'Licitaciones'),
(15, 'd422db36-466c-11e9-b914-484d7ed7cadd', 'Prevencion de la Salud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `primKey` int(11) NOT NULL,
  `IDDocumento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDDepartamento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `ElaboradoPor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `RevisadoPor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `AprobadoPor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `VistoPor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `NombreDocumento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Disponibilidad` tinyint(1) NOT NULL,
  `CodigoDocumento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FechaEmision` date NOT NULL,
  `NumeroRevision` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `FechaRevision` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`primKey`, `IDDocumento`, `IDDepartamento`, `ElaboradoPor`, `RevisadoPor`, `AprobadoPor`, `VistoPor`, `NombreDocumento`, `Disponibilidad`, `CodigoDocumento`, `FechaEmision`, `NumeroRevision`, `FechaRevision`) VALUES
(61, '18BE5219-4D7B-31E4-19F9-7AAEE94CF75B', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'tecnologia', 1, '123', '2019-03-14', '1.0', '2019-03-14 11:28:38'),
(62, '04C02622-24DA-10FB-54E6-B7385297517A', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 2', 1, '123', '2019-03-14', '1.02', '2019-03-14 11:29:08'),
(63, '64D6E7E7-F08A-2D6E-782F-D5DC5A14C414', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 3', 1, '123', '2019-03-14', '1.2', '2019-03-14 11:29:43'),
(64, '081B0389-7AF0-DDC3-CDA2-73C139B1D079', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 3', 1, '123', '2019-03-14', '1.2', '2019-03-14 11:30:41'),
(65, 'D67029C2-390E-38C5-0D13-1784B99E191A', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 4', 1, '123', '2019-03-14', '22', '2019-03-14 11:30:59'),
(66, '3554A2D2-719F-CBEC-C1AC-3A108D1D6B3D', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 5', 1, '123', '2019-03-14', '33', '2019-03-14 11:31:35'),
(67, '0C4C1042-1FF0-6202-D618-BBE2E82BC981', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 3', 1, '123', '2019-03-14', '444', '2019-03-14 11:32:43'),
(68, '93F6E4EA-4A04-081B-72B7-D5DB23C16ED6', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'prueba 5', 1, '123', '2019-03-14', '3242', '2019-03-14 11:34:54'),
(69, 'D7A7256C-6BF0-7404-BE7C-8DE6C8A8ABFB', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'sfasfas', 1, '123', '2019-03-14', '1.0.0', '2019-03-14 11:35:54'),
(70, 'B67641ED-A3E2-BFBD-B852-1368701799DD', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'Introduccion a la tecnologia', 1, '123', '2019-03-14', '1.0.2', '2019-03-14 11:37:26'),
(71, 'CB79A55E-9E5D-A3CD-0A7B-50D5794F6B33', 'd41eea3a-466c-11e9-b914-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '', '', '', 'gestiones de procesos', 1, '50125', '2019-03-14', '1.01', '2019-03-14 16:11:09'),
(72, 'A22DC343-C594-EF19-25CA-311D5CA5FB63', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '2C6EEF08-D1ED-57C1-6259-2CCC0BF5464B', '2C6EEF08-D1ED-57C1-6259-2CCC0BF5464B', 'hero', 1, '1212500', '2019-03-19', '1.0.0', '2019-03-19 11:16:12'),
(73, '1D9A55E7-3219-2306-5CEE-55E653457F52', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'C8BC585E-7F88-96F2-DF28-782097966632', 'hero v3', 0, '1212500', '2019-03-19', '50', '2019-03-20 10:44:33'),
(75, '334BD574-8AB5-851A-D556-2B34FB19CF20', 'd41ee7c2-466c-11e9-b914-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'B3157DB9-DCF6-FC1A-056B-EFC88189D9FB', '2C6EEF08-D1ED-57C1-6259-2CCC0BF5464B', 'B3157DB9-DCF6-FC1A-056B-EFC88189D9FB', '111111111', 1, 'fasf', '2019-03-20', '21', '2019-03-20 11:17:30'),
(76, 'B76953E8-C829-80C0-6618-49002C486893', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'niu name', 1, '1111', '2019-03-20', '22222', '2019-03-20 11:41:07'),
(77, '9DD00870-57C2-8790-B7EE-3B595CC4498A', '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'hero 4', 0, '1212500', '2019-03-19', 'sfs', '2019-03-23 11:34:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `primKey` int(11) NOT NULL,
  `IDNotificacion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoDocumento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDUsuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Leido` tinyint(1) NOT NULL,
  `TipoNotificacion` int(11) NOT NULL,
  `Notificacion` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `FechaNotificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`primKey`, `IDNotificacion`, `CodigoDocumento`, `IDUsuario`, `Leido`, `TipoNotificacion`, `Notificacion`, `FechaNotificacion`) VALUES
(20, '2BCC7671-4BF9-41D8-3C43-34BA8AD2EDA6', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 1, 'El documento con codigo: 123 a sido actualizado.', '2019-03-14'),
(21, 'E3900EF8-D283-1273-08D0-16D90A5C2106', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 1, 'El documento con codigo: 123 a sido actualizado.', '2019-03-14'),
(22, '3B4A6CCB-D83D-E187-420A-75520836AC5E', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 1, 'El documento con codigo: 123 a sido actualizado.', '2019-03-14'),
(23, '02BDC0C6-EDC6-789A-AB1C-008A4CA071A8', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 1, 'El documento con codigo: 123 a sido actualizado.', '2019-03-14'),
(24, '2C066312-E766-CBC1-BDC5-07C3AC881E8B', '', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(25, 'DF745217-C60E-8A69-C124-3DE6D4E5F80F', '', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20'),
(26, 'E023D09F-84FE-B55F-D56C-BCC92BAB5094', '', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(27, 'D86F425A-3975-E256-FA15-2C65289BF341', '', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(28, '5D3896A3-D092-F39F-01C6-83C4DA6EBD8B', '', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20'),
(29, '36D76757-B7C4-C7DC-C469-4983AD04C502', '', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(30, '77BA4444-7708-DE3D-8BC7-D5649FC4243E', '', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(31, 'E842B5D1-A8DE-5BF7-F4A6-FF5ABCCAC152', '', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20'),
(32, 'C20950D6-7362-6D48-32C0-2C09B3591F10', '', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(33, '28779C74-0CB6-4266-CE4D-F21736D4AED4', '', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(34, 'E232E37E-BEA9-947C-BC7E-DB6276B92547', '', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20'),
(35, 'EEEE41B5-E7DF-B82E-5F1A-CEEBBA3AEB04', '', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(36, '6BB70018-1676-32EA-00A4-DE273A275C41', '', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 0, 2, '', '2019-03-20'),
(37, 'CDAE062A-418E-4D19-B4A0-B528EAB7759D', '', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20'),
(38, '90785CEE-7A11-097F-2109-34445EFD6C49', '1212500', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(39, '2275E593-36D4-0BF0-A9D5-85E03507F826', '1212500', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(40, '3F03005C-0C26-FC95-4DF6-7BF387C91BD8', '1212500', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 1, 2, '', '2019-03-20'),
(41, '4099F988-FAF5-B27B-7121-A9989A621335', '1212500', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(42, 'E2C3A6B3-788D-9CEC-4CCD-24C78B2B3B4F', '1212500', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(43, 'E220942F-10C5-27B4-7E81-36328E9D95AC', '1212500', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 1, 2, '', '2019-03-20'),
(44, '18DA291A-0702-6096-0015-A96E651F63B2', '1212500', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(45, 'AE4C49FF-B8D0-5089-9A23-A2E9956A5B61', '1212500', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(46, 'BB6CB6CA-2D8D-8F96-CC36-E51BE9D01A8C', '1212500', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 1, 2, '', '2019-03-20'),
(47, '35CF783B-750D-EB87-3656-829D9A397E40', 'fasf', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 1, 2, '', '2019-03-20'),
(48, 'F7B97B94-BD56-FDEA-D253-763A94C4910D', 'fasf', '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 0, 2, '', '2019-03-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `primKey` int(11) NOT NULL,
  `IDSeguidor` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoDocumento` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDUsuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seguidores`
--

INSERT INTO `seguidores` (`primKey`, `IDSeguidor`, `CodigoDocumento`, `IDUsuario`) VALUES
(8, 'B1BAF513-6400-1072-7C64-C1A752B6D8EE', '123', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd'),
(9, 'D4303081-89E2-71B0-7363-4DE0450A9E74', 'fasf', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd'),
(10, '6BD3666F-67A6-014C-955E-4CBAB12D0D4C', '1212500', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `primKey` int(11) NOT NULL,
  `IDSolicitud` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDDocumento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDUsuarioSubida` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `IDUsuarioAdmin` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `FechaSolicitud` datetime NOT NULL,
  `EstadoSolicitud` int(11) NOT NULL,
  `ComentarioSolicitud` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`primKey`, `IDSolicitud`, `IDDocumento`, `IDUsuarioSubida`, `IDUsuarioAdmin`, `FechaSolicitud`, `EstadoSolicitud`, `ComentarioSolicitud`, `FechaActualizacion`) VALUES
(2, '9294D1E0-E3BF-5AB6-90BC-97404F0643E2', 'B76953E8-C829-80C0-6618-49002C486893', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '2019-03-20 11:41:07', 3, 'NICE', '2019-03-23 11:31:21'),
(4, '2E1DCEB8-41FE-2669-172B-E22285CF7290', '9DD00870-57C2-8790-B7EE-3B595CC4498A', '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', '2019-03-23 11:34:27', 0, 'fd', '2019-03-27 14:49:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `primKey` int(11) NOT NULL,
  `IDUsuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `NombreUsuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Contrasena` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `NivelUsuario` int(11) NOT NULL,
  `IDDepartamento` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` date NOT NULL,
  `Estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`primKey`, `IDUsuario`, `NombreUsuario`, `Contrasena`, `NivelUsuario`, `IDDepartamento`, `Nombres`, `Apellidos`, `FechaNacimiento`, `Email`, `Telefono`, `FechaCreacion`, `Estado`) VALUES
(1, '3e881c18-3cea-11e9-b4b6-484d7ed7cadd', 'jurena', 'fcea920f7412b5da7be0cf42b8c93759', 3, '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', 'Jose enrique', 'urena sosa', '1994-04-12', 'jose.urena.caltec@gmail.com', '8095945639', '0000-00-00', '1'),
(3, '3e8bf390-3cea-11e9-b4b6-484d7ed7cadd', 'MBussi', 'e10adc3949ba59abbe56e057f20f883e', 2, '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', 'Mariela', 'Bussi', '1996-07-26', 'mariela.bussi@gmail.com', '8095945639', '0000-00-00', '1'),
(4, '6798C7AA-AF88-42C1-BD67-7E2545DEF941', 'jurena2', 'e10adc3949ba59abbe56e057f20f883e', 3, 'd41ee98d-466c-11e9-b914-484d7ed7cadd', 'juan', 'alberto', '2019-03-15', 'j.enriqueurena@gmai.com', '8095945631', '2019-03-07', '0'),
(5, '2C6EEF08-D1ED-57C1-6259-2CCC0BF5464B', 'prueba', 'fcea920f7412b5da7be0cf42b8c93759', 1, '6f2c2ef8-3cf2-11e9-b4b6-484d7ed7cadd', '31', '5213', '0000-00-00', 's@s.not', '', '2019-03-13', '1'),
(6, 'C8BC585E-7F88-96F2-DF28-782097966632', 'jurena3', 'e10adc3949ba59abbe56e057f20f883e', 1, 'd41ee9fa-466c-11e9-b914-484d7ed7cadd', 'Jose Enrique', 'prueba', '0000-00-00', 's@s.not', '', '2019-03-14', '1'),
(7, 'B3157DB9-DCF6-FC1A-056B-EFC88189D9FB', 'jurena5', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'd41ee896-466c-11e9-b914-484d7ed7cadd', 'Jose Enrique', 'prueba', '0000-00-00', 'j.enriqueurena@gmai.com', '', '2019-03-14', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDComentario` (`IDComentario`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDDepartamento` (`IDDepartamento`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDArchivo` (`IDDocumento`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDNotificacion` (`IDNotificacion`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDSeguidor` (`IDSeguidor`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDSolicitud` (`IDSolicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`primKey`),
  ADD UNIQUE KEY `IDUsuario` (`IDUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `primKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
