-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para moneygrowpro
CREATE DATABASE IF NOT EXISTS `moneygrowpro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `moneygrowpro`;

-- Volcando estructura para tabla moneygrowpro.accions
CREATE TABLE IF NOT EXISTS `accions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referenciaPago` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `idUsuarioFk` int(11) NOT NULL,
  `idFaseFk` int(11) NOT NULL,
  `estatus` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT 'solicitando',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.accions: ~1 rows (aproximadamente)
DELETE FROM `accions`;
/*!40000 ALTER TABLE `accions` DISABLE KEYS */;
INSERT INTO `accions` (`id`, `referenciaPago`, `idUsuarioFk`, `idFaseFk`, `estatus`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'abc123', 3, 0, 'rechazado', NULL, '2020-04-18 02:14:30', '2020-04-18 03:07:17');
/*!40000 ALTER TABLE `accions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.countries: ~194 rows (aproximadamente)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Afganistán', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(2, 'Albania', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(3, 'Alemania', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(4, 'Andorra', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(5, 'Angola', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(6, 'Antigua y Barbuda', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(7, 'Arabia Saudita', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(8, 'Argelia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(9, 'Argentina', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(10, 'Armenia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(11, 'Australia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(12, 'Austria', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(13, 'Azerbaiyán', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(14, 'Bahamas', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(15, 'Bangladés', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(16, 'Barbados', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(17, 'Baréin', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(18, 'Bélgica', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(19, 'Belice', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(20, 'Benín', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(21, 'Bielorrusia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(22, 'Birmania/Myanmar', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(23, 'Bolivia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(24, 'Bosnia y Herzegovina', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(25, 'Botsuana', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(26, 'Brasil', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(27, 'Brunéi', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(28, 'Bulgaria', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(29, 'Burkina Faso', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(30, 'Burundi', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(31, 'Bután', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(32, 'Cabo Verde', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(33, 'Camboya', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(34, 'Camerún', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(35, 'Canadá', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(36, 'Catar', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(37, 'Chad', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(38, 'Chile', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(39, 'China', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(40, 'Chipre', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(41, 'Ciudad del Vaticano', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(42, 'Colombia', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(43, 'Comoras', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(44, 'Corea del Norte', NULL, '2020-04-17 23:38:34', '2020-04-17 23:38:34'),
	(45, 'Corea del Sur', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(46, 'Costa de Marfil', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(47, 'Costa Rica', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(48, 'Croacia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(49, 'Cuba', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(50, 'Dinamarca', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(51, 'Dominica', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(52, 'Ecuador', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(53, 'Egipto', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(54, 'El Salvador', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(55, 'Emiratos Árabes Unidos', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(56, 'Eritrea', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(57, 'Eslovaquia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(58, 'Eslovenia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(59, 'España', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(60, 'Estados Unidos', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(61, 'Estonia', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(62, 'Etiopía', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(63, 'Filipinas', NULL, '2020-04-17 23:38:35', '2020-04-17 23:38:35'),
	(64, 'Finlandia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(65, 'Fiyi', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(66, 'Francia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(67, 'Gabón', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(68, 'Gambia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(69, 'Georgia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(70, 'Ghana', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(71, 'Granada', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(72, 'Grecia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(73, 'Guatemala', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(74, 'Guyana', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(75, 'Guinea', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(76, 'Guinea ecuatorial', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(77, 'Guinea-Bisáu', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(78, 'Haití', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(79, 'Honduras', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(80, 'Hungría', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(81, 'India', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(82, 'Indonesia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(83, 'Irak', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(84, 'Irán', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(85, 'Irlanda', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(86, 'Islandia', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(87, 'Islas Marshall', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(88, 'Islas Salomón', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(89, 'Israel', NULL, '2020-04-17 23:38:36', '2020-04-17 23:38:36'),
	(90, 'Italia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(91, 'Jamaica', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(92, 'Japón', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(93, 'Jordania', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(94, 'Kazajistán', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(95, 'Kenia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(96, 'Kirguistán', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(97, 'Kiribati', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(98, 'Kuwait', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(99, 'Laos', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(100, 'Lesoto', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(101, 'Letonia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(102, 'Líbano', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(103, 'Liberia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(104, 'Libia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(105, 'Liechtenstein', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(106, 'Lituania', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(107, 'Luxemburgo', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(108, 'Macedonia del Norte', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(109, 'Madagascar', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(110, 'Malasia', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(111, 'Malaui', NULL, '2020-04-17 23:38:37', '2020-04-17 23:38:37'),
	(112, 'Maldivas', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(113, 'Malí', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(114, 'Malta', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(115, 'Marruecos', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(116, 'Mauricio', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(117, 'Mauritania', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(118, 'México', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(119, 'Micronesia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(120, 'Moldavia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(121, 'Mónaco', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(122, 'Mongolia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(123, 'Montenegro', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(124, 'Mozambique', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(125, 'Namibia', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(126, 'Nauru', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(127, 'Nepal', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(128, 'Nicaragua', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(129, 'Níger', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(130, 'Nigeria', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(131, 'Noruega', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(132, 'Nueva Zelanda', NULL, '2020-04-17 23:38:38', '2020-04-17 23:38:38'),
	(133, 'Omán', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(134, 'Países Bajos', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(135, 'Pakistán', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(136, 'Palaos', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(137, 'Panamá', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(138, 'Papúa Nueva Guinea', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(139, 'Paraguay', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(140, 'Perú', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(141, 'Polonia', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(142, 'Portugal', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(143, 'Reino Unido', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(144, 'República Centroafricana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(145, 'República Checa', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(146, 'República del Congo', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(147, 'República Democrática del Congo', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(148, 'República Dominicana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(149, 'República Sudafricana', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(150, 'Ruanda', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(151, 'Rumanía', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(152, 'Rusia', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(153, 'Samoa', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(154, 'San Cristóbal y Nieves', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(155, 'San Marino', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(156, 'San Vicente y las Granadinas', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(157, 'Santa Lucía', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(158, 'Santo Tomé y Príncipe', NULL, '2020-04-17 23:38:39', '2020-04-17 23:38:39'),
	(159, 'Senegal', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(160, 'Serbia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(161, 'Seychelles', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(162, 'Sierra Leona', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(163, 'Singapur', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(164, 'Siria', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(165, 'Somalia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(166, 'Sri Lanka', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(167, 'Suazilandia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(168, 'Sudán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(169, 'Sudán del Sur', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(170, 'Suecia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(171, 'Suiza', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(172, 'Surinam', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(173, 'Tailandia', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(174, 'Tanzania', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(175, 'Tayikistán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(176, 'Timor Oriental', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(177, 'Togo', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(178, 'Tonga', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(179, 'Trinidad y Tobago', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(180, 'Túnez', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(181, 'Turkmenistán', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(182, 'Turquía', NULL, '2020-04-17 23:38:40', '2020-04-17 23:38:40'),
	(183, 'Tuvalu', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(184, 'Ucrania', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(185, 'Uganda', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(186, 'Uruguay', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(187, 'Uzbekistán', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(188, 'Vanuatu', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(189, 'Venezuela', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(190, 'Vietnam', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(191, 'Yemen', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(192, 'Yibuti', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(193, 'Zambia', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(194, 'Zimbabue', NULL, '2020-04-17 23:38:41', '2020-04-17 23:38:41');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.fases
CREATE TABLE IF NOT EXISTS `fases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.fases: ~6 rows (aproximadamente)
DELETE FROM `fases`;
/*!40000 ALTER TABLE `fases` DISABLE KEYS */;
INSERT INTO `fases` (`id`, `nombre`) VALUES
	(1, 'bono arranque'),
	(2, 'bono impulsor'),
	(3, 'bono constructor'),
	(4, 'bono productor'),
	(5, 'bono emprendedor'),
	(6, 'bono capitalizacion'),
	(7, 'fundador 6k');
/*!40000 ALTER TABLE `fases` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.files: ~0 rows (aproximadamente)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.historico_retiro
CREATE TABLE IF NOT EXISTS `historico_retiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFk` int(11) NOT NULL,
  `referencia` text,
  `monto_retiro` double(8,2) NOT NULL,
  `plataforma` text NOT NULL,
  `estatus` varchar(191) NOT NULL DEFAULT 'proceso',
  `fecha` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.historico_retiro: ~0 rows (aproximadamente)
DELETE FROM `historico_retiro`;
/*!40000 ALTER TABLE `historico_retiro` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_retiro` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.migrations: ~15 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(6, '2016_06_01_000004_create_oauth_clients_table', 1),
	(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(8, '2019_05_06_182611_create_statuses_table', 1),
	(9, '2019_09_01_183948_create_payment_methods_table', 1),
	(10, '2019_09_30_150950_create_permission_tables', 1),
	(11, '2019_10_01_134421_create_notifications_table', 1),
	(12, '2019_10_01_135029_create_notification_user_table', 1),
	(13, '2019_10_01_193837_create_countries_table', 1),
	(14, '2019_10_09_163104_create_files_table', 1),
	(15, '2019_10_09_180657_create_relation_file_table', 1),
	(16, '2020_04_18_004136_create_accions_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.model_has_permissions: ~0 rows (aproximadamente)
DELETE FROM `model_has_permissions`;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.model_has_roles: ~2 rows (aproximadamente)
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(1, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.notifications: ~0 rows (aproximadamente)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.notification_user
CREATE TABLE IF NOT EXISTS `notification_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_notification_id_foreign` (`notification_id`),
  KEY `notification_user_user_id_foreign` (`user_id`),
  CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.notification_user: ~0 rows (aproximadamente)
DELETE FROM `notification_user`;
/*!40000 ALTER TABLE `notification_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_user` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_access_tokens: ~9 rows (aproximadamente)
DELETE FROM `oauth_access_tokens`;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('02ececa4b589111cf7bfaefa37a22797b505ed01be8b75e9cb75a5a266870e8668a8a0bc2315646b', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:37:48', '2020-04-18 00:37:48', '2021-04-18 00:37:48'),
	('27c759edb348e0564be415c4a6b590cd10d4cab664dbf8ce2f9bce4daa793d5ddc19ca7c77af0571', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 03:10:46', '2020-04-18 03:10:46', '2021-04-18 03:10:46'),
	('2a6d51336be1985530d654aab88361ad8ddb05c0c52523fad820112330d083f728b056df29b2eda5', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-20 14:41:29', '2020-04-20 14:41:29', '2021-04-20 14:41:29'),
	('4832d553d14c674df48cf31ba5073850ca96b14b4fd2cdcde652b3fbb7b8415f4a02fa12f11e8859', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-20 14:33:38', '2020-04-20 14:33:38', '2021-04-20 14:33:38'),
	('4aeae8857198e33cc4014fa1d27945e69fc3e2dbddb261e0a720a0f15211b6aa381a240cf0a6a2e9', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:35:28', '2020-04-18 00:35:28', '2021-04-18 00:35:28'),
	('4cf88aff32965d96d5cb2cc6a4ec7e6fb60b19fa82acd86da8c703a96ba97ccb77226c9d1da69829', 2, 1, 'Personal Access Token', '[]', 0, '2020-04-17 23:40:16', '2020-04-17 23:40:16', '2021-04-17 23:40:16'),
	('4d28117353e9ddec769c9c1646fb592eb39e5918ec7006d929c10731a9e598318db8b45c9ca58b09', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-17 23:41:41', '2020-04-17 23:41:41', '2021-04-17 23:41:41'),
	('5b36820c9783aa165dcb4fe32055b83c24089c24bb899cfabe173205448ddd21caa3cc9958ef788f', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 05:56:49', '2020-04-18 05:56:49', '2021-04-18 05:56:49'),
	('9b4e81fbe6b35ed4fe1fc7967301f24c8bf91eeabac9133b3d0b97a73e16a1ba481ab2caa13b0c99', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:35:51', '2020-04-18 00:35:51', '2021-04-18 00:35:51'),
	('bdb84b11ccc9ea1c676d402ffc75782a6d53374c0c470b0aa6adad247c16cd87e2905a99af51ea62', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 05:24:07', '2020-04-18 05:24:07', '2021-04-18 05:24:07'),
	('c85a9bfb7fdb09072684e92aab762024648c0d209068b61d4f648eb2855edcbee1d9089b32ea8d70', 4, 1, 'Personal Access Token', '[]', 0, '2020-08-26 21:55:46', '2020-08-26 21:55:46', '2021-08-26 21:55:46'),
	('d1571b403c8f04307684061d28f4c8fa74a6a731cb9c82e81c5647932545ef0118c39a70d8db81d1', 3, 1, 'Personal Access Token', '[]', 0, '2020-08-26 20:15:16', '2020-08-26 20:15:16', '2021-08-26 20:15:16'),
	('daa5b2e584e3500260ac902f6d0d2f2d98e4f638e6de28cfc768bdcb3605a33fcb8b31f63405aec9', 5, 1, 'Personal Access Token', '[]', 0, '2020-08-26 22:09:35', '2020-08-26 22:09:35', '2021-08-26 22:09:35'),
	('e0e6290cf3e3e5bced1a4271263a1b4ba8b9d7d25496a6ba6efce8eab9afb87974a5249579617a63', 3, 1, 'Personal Access Token', '[]', 0, '2020-04-18 00:36:04', '2020-04-18 00:36:04', '2021-04-18 00:36:04');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_auth_codes: ~0 rows (aproximadamente)
DELETE FROM `oauth_auth_codes`;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_clients: ~2 rows (aproximadamente)
DELETE FROM `oauth_clients`;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'o9F4E8XEn24VtE2xqRnQt8MEzUebRxALt8Ode2Xu', 'http://localhost', 1, 0, 0, '2020-04-17 23:38:58', '2020-04-17 23:38:58'),
	(2, NULL, 'Laravel Password Grant Client', 'V3cJnPHmPZUqO6SSLFywu9E400ZazSzeNwvHRH2C', 'http://localhost', 0, 1, 0, '2020-04-17 23:38:58', '2020-04-17 23:38:58');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_personal_access_clients: ~0 rows (aproximadamente)
DELETE FROM `oauth_personal_access_clients`;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-04-17 23:38:58', '2020-04-17 23:38:58');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.oauth_refresh_tokens: ~0 rows (aproximadamente)
DELETE FROM `oauth_refresh_tokens`;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.payment_methods: ~5 rows (aproximadamente)
DELETE FROM `payment_methods`;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Efectivo', NULL, '2020-04-17 23:38:32', '2020-04-17 23:38:32'),
	(2, 'Tarjeta de débito', NULL, '2020-04-17 23:38:32', '2020-04-17 23:38:32'),
	(3, 'Tarjeta de crédito', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(4, 'Cheque', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(5, 'Transferencia', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.permissions: ~44 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'user-list', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(2, 'user-store', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(3, 'user-update', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(4, 'user-destroy', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(5, 'office-list', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(6, 'office-store', 'web', '2020-04-17 23:38:41', '2020-04-17 23:38:41'),
	(7, 'office-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(8, 'office-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(9, 'passenger-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(10, 'passenger-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(11, 'passenger-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(12, 'passenger-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(13, 'collaborator-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(14, 'collaborator-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(15, 'collaborator-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(16, 'collaborator-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(17, 'vacation-record-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(18, 'vacation-record-store', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(19, 'vacation-record-update', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(20, 'vacation-record-destroy', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(21, 'task-list', 'web', '2020-04-17 23:38:42', '2020-04-17 23:38:42'),
	(22, 'task-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(23, 'task-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(24, 'task-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(25, 'payment-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(26, 'payment-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(27, 'payment-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(28, 'payment-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(29, 'service-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(30, 'service-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(31, 'service-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(32, 'service-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(33, 'prospect-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(34, 'prospect-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(35, 'prospect-update', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(36, 'prospect-destroy', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(37, 'client-list', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(38, 'client-store', 'web', '2020-04-17 23:38:43', '2020-04-17 23:38:43'),
	(39, 'client-update', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(40, 'client-destroy', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(41, 'propoal-list', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(42, 'propoal-store', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(43, 'propoal-update', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(44, 'propoal-destroy', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.referido
CREATE TABLE IF NOT EXISTS `referido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAccionFk` int(11) DEFAULT '0',
  `idUserReferidoFk` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.referido: ~0 rows (aproximadamente)
DELETE FROM `referido`;
/*!40000 ALTER TABLE `referido` DISABLE KEYS */;
/*!40000 ALTER TABLE `referido` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.relation_file
CREATE TABLE IF NOT EXISTS `relation_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rel_id` int(10) unsigned NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `table_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_file_file_id_foreign` (`file_id`),
  CONSTRAINT `relation_file_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.relation_file: ~0 rows (aproximadamente)
DELETE FROM `relation_file`;
/*!40000 ALTER TABLE `relation_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `relation_file` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.roles: ~0 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2020-04-17 23:38:44', '2020-04-17 23:38:44'),
	(2, 'Cliente', 'web', NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.role_has_permissions: ~44 rows (aproximadamente)
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.saldo
CREATE TABLE IF NOT EXISTS `saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUserFk` int(11) DEFAULT NULL,
  `saldoDisponible` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla moneygrowpro.saldo: ~0 rows (aproximadamente)
DELETE FROM `saldo`;
/*!40000 ALTER TABLE `saldo` DISABLE KEYS */;
/*!40000 ALTER TABLE `saldo` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.statuses: ~2 rows (aproximadamente)
DELETE FROM `statuses`;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`id`, `type`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'general', 'Activo', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33'),
	(2, 'general', 'Inactivo', NULL, '2020-04-17 23:38:33', '2020-04-17 23:38:33');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Volcando estructura para tabla moneygrowpro.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_documento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idReferido` int(11) DEFAULT NULL,
  `premiun` int(11) NOT NULL DEFAULT '0',
  `posicion` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla moneygrowpro.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `avatar`, `email_verified_at`, `password`, `n_documento`, `link`, `idReferido`, `premiun`, `posicion`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '1092edgar@gmail.com', 'Edgar', 'Gomez', NULL, NULL, '$2y$10$KMZuA5rjWIhjU62P4Tj8c.wOQWhNsykmqWSShJYv5AwdlkuSxFQX6', NULL, 'culo', 3, 1, 1, NULL, '2020-04-17 23:38:48', '2020-04-17 23:38:48', NULL),
	(3, 'hectormarrero91@gmail.com', 'jhonathan', 'rodriguez', NULL, NULL, '$2y$10$vMoJ8YKi8XStSha/8ObD2eijeTwvzf85BVw8MUuierdRfp9kEWnru', '6666', 'fN3eLuj7no', 1, 0, 1, NULL, '2020-04-17 23:41:37', '2020-04-18 03:06:50', NULL),
	(4, 'menphisj@gmail.com', 'jhonathan', 'rodriguez', NULL, NULL, '$2y$10$FDiHFl.8BKuEItB096pIr.9jEYrFd8osUWM3b.7gctDPPvnRi0mE2', '20114851', 'anxBmYkbCn', NULL, 0, 1, NULL, '2020-08-26 21:55:35', '2020-08-26 21:55:35', NULL),
	(5, 'tanito232@gmail.com', 'tanito', 'tancho', NULL, NULL, '$2y$10$Qhp1.kL4XJhOCBDiBwZS4OgxmZzLAQW0YBwZMWvlda/BrerqXENh2', '3455', 'D0vS1sYwvV', NULL, 0, 1, NULL, '2020-08-26 22:09:18', '2020-08-26 22:09:18', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
