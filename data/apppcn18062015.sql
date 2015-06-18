-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2015 a las 18:14:44
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `apppcn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`id`, `descripcion`, `create_time`, `update_time`, `user_id`) VALUES
(2, 'Mantened la calma y permaneced todos juntos!', '2015-06-18 15:39:29', '0000-00-00 00:00:00', 4),
(3, 'Mantened la calma y permaneced todos juntos!', '2015-06-18 15:47:26', '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `name`, `web`, `create_time`, `update_time`) VALUES
(1, 'Telefónica S.A.', 'http://www.telefonica.com/', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1433755380),
('m150608_091847_init_user', 1433755394);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ubicacion_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id`, `subject`, `ubicacion_id`, `create_time`, `update_time`, `user_id`) VALUES
(15, 'Se quema el edificio!!!', 4, '2015-06-17 16:46:24', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE IF NOT EXISTS `operacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'site-about', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'rol', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'operacion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE IF NOT EXISTS `proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'default', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'Usuario', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Superusuario', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Notificador', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Directivo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Personal crítico', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_operacion`
--

CREATE TABLE IF NOT EXISTS `rol_operacion` (
  `rol_id` int(11) NOT NULL,
  `operacion_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`operacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol_operacion`
--

INSERT INTO `rol_operacion` (`rol_id`, `operacion_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE IF NOT EXISTS `ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL,
  `update_time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'Edificio Oeste 1', '2015-05-26 11:19:47', '0000-00-00 00:00:00'),
(2, 'Edificio Oeste 2', '2015-05-26 11:19:59', '0000-00-00 00:00:00'),
(3, 'Edificio Oeste 3', '2015-05-26 11:20:17', '0000-00-00 00:00:00'),
(4, 'Edificio Oeste 4', '2015-05-26 11:20:28', '0000-00-00 00:00:00'),
(5, 'Edificio Norte 1', '2015-05-26 11:19:47', '0000-00-00 00:00:00'),
(6, 'Edificio Norte 2', '2015-05-26 11:19:59', '0000-00-00 00:00:00'),
(7, 'Edificio Norte 3', '2015-05-26 11:20:17', '0000-00-00 00:00:00'),
(8, 'Edificio Norte 4', '2015-05-26 11:20:28', '0000-00-00 00:00:00'),
(9, 'Edificio Sur 1', '2015-05-26 11:19:47', '0000-00-00 00:00:00'),
(10, 'Edificio Sur 2', '2015-05-26 11:19:59', '0000-00-00 00:00:00'),
(11, 'Edificio Sur 3', '2015-05-26 11:20:17', '0000-00-00 00:00:00'),
(12, 'Edificio Sur 4', '2015-05-26 11:20:28', '0000-00-00 00:00:00'),
(13, 'Edificio Este 1', '2015-05-26 11:19:47', '0000-00-00 00:00:00'),
(14, 'Edificio Este 2', '2015-05-26 11:19:59', '0000-00-00 00:00:00'),
(15, 'Edificio Este 3', '2015-05-26 11:20:17', '0000-00-00 00:00:00'),
(16, 'Edificio Este 4', '2015-05-26 11:20:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `rol_id` smallint(6) NOT NULL,
  `proceso_id` smallint(6) NOT NULL,
  `empresa_id` smallint(6) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `rol_id`, `proceso_id`, `empresa_id`, `name`, `surname`, `phone`, `mobile`) VALUES
(1, 'admin', 'LOjndIcFYAQZEhfwnMoPvnle-gK9B82t', '$2y$13$3awPXMlUfU/QPwndskr0V.c3CA5jOqKsuhmegKWVzgxbfFQ9/HO8y', NULL, 'vicente.montanomena@telefonica.com', 10, '2015-06-10 09:00:00', '0000-00-00 00:00:00', 2, 1, 1, 'Admin', 'Admin', NULL, '610000000'),
(2, 'demo', '_A0iTtsfIcoRrsVudoVVcVs7EYm3LI6C', '$2y$13$gxWKZi6AokGYoh/ebkDtuuGIZ.5WGHdKwPqlHvCHMZwB7e5FDCaE.', NULL, 'demo@email.com', 10, '2015-06-10 09:26:11', '0000-00-00 00:00:00', 1, 1, 1, 'Demo', 'TIS', NULL, '610000000'),
(3, 'notificador1', '5Hcl87pVCqmXqsS4R3_0gnAENCpHQgfQ', '$2y$13$z3oUA4DiCBbiwVJCiBsPs.KOi8liVbMomS0bpnh29xzqF1PMzQnma', '', 'notificador1@email.com', 10, '2015-06-10 09:35:37', '2015-06-15 16:14:50', 4, 1, 1, 'Notificador1', 'TIS', NULL, '610000000'),
(4, 'directivoA', 'nrM0wdVnDuOu_nhclRBeIwp2e1LHTCwu', '$2y$13$loDQTxKmcN7PCXhtxnXvzu4Ds.bE/6XPXxrMRvP.ZMkg3JlfCjie6', '', 'directivoA@email.com', 10, '2015-06-17 15:51:48', '2015-06-17 16:07:33', 5, 1, 1, 'Directivo', 'TIS', '610000000', '610000000'),
(5, 'directivoB', 'JQETfRoV0Mbv1JQRwazMLODJbDdvcAdV', '$2y$13$3ogfYD6a1zhYUokN7kLCVey.DgqG0mF/Ph1nBhOizdzRNb79m1BPC', NULL, 'directivo.b@email.com', 10, '2015-06-17 16:08:21', '0000-00-00 00:00:00', 5, 1, 1, 'Directivo B', 'TIS', '', '610000000'),
(6, 'pca', 'Xu-ZwxsheZhlgMV3OmaDS_K2fzC84M2n', '$2y$13$DvbmtAuthTCB00gKVnGR6u5abE.F5st.GJFvvpuTAn3DjBGovZCxG', '', 'pcA@email.com', 10, '2015-06-18 10:53:18', '2015-06-18 10:55:35', 6, 1, 1, 'Personal Crítico A', 'TIS', '610000000', '610000000'),
(7, 'pcB', '009gNrkr--I2-j5UWIFCnpvo_I4zfqeG', '$2y$13$zS/cmfFedyzSN2wSwBi0xusqmNmtej7Zre5jUq38AoB6PQY7Slj16', '', 'pcB@email.com', 10, '2015-06-18 10:54:19', '2015-06-18 10:55:45', 6, 1, 1, 'Personal Crítico B', 'TIS', '610000000', '610000000'),
(8, 'pcC', 'fFuyT3mEv17phybuxgXU2I1881zmHR1b', '$2y$13$PWHRWpcPB.6NXRdaGhtxb.L2TDgGeJ5h7dkjaI3YfD9TV/pJWhjRi', '', 'pcC@email.com', 10, '2015-06-18 14:06:34', '2015-06-18 14:07:00', 6, 1, 1, 'Personal Crítico C', 'TIS', '610000000', '610000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_accion`
--

CREATE TABLE IF NOT EXISTS `user_accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `accion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user_accion`
--

INSERT INTO `user_accion` (`id`, `to_user_id`, `accion_id`) VALUES
(1, 6, 2),
(2, 8, 2),
(3, 6, 3),
(4, 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_notificacion`
--

CREATE TABLE IF NOT EXISTS `user_notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `notificacion_id` int(11) NOT NULL,
  `dispatched` tinyint(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `user_notificacion`
--

INSERT INTO `user_notificacion` (`id`, `to_user_id`, `notificacion_id`, `dispatched`, `code`) VALUES
(3, 4, 15, 0, 'e8191bffaf9ff521ddd1ffcf68a375d9'),
(4, 5, 15, 0, 'faa9d52f4e790fd2e084e0e0d1fb1464');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
