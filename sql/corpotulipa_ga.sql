-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2021 a las 03:24:40
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `corpotulipa_ga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_publicos`
--

CREATE TABLE `bienes_publicos` (
  `id_bien` int(11) NOT NULL,
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `organismo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `denoOrga` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `denoDepa` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `dependencia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `denoUsu` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_bien` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `catastro` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha_incorporacion` date DEFAULT NULL,
  `incorporado_por` int(11) DEFAULT NULL,
  `responsable` int(11) DEFAULT NULL,
  `existencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bienes_publicos`
--

INSERT INTO `bienes_publicos` (`id_bien`, `codigo`, `tipo`, `organismo`, `denoOrga`, `departamento_id`, `denoDepa`, `dependencia`, `denoUsu`, `nombre_bien`, `descripcion`, `catastro`, `valor`, `fecha_incorporacion`, `incorporado_por`, `responsable`, `existencia`) VALUES
(1, 'OAF-21-1', 'Inmueble', 'Probando', 'Aja', 1, 'Pues', 'CLICK', 'SUPUTA', 'mueble 2', '', 99, 9, NULL, 20, NULL, 0),
(2, 'OAF-21-2', 'Mueble', 'Probando2', 'Aja2', 1, 'Pues2', 'CLICK2', 'SUPUTA', 'Mueble 2', 'KMKMKM', 0, 0, NULL, 20, 20, 0),
(3, 'ORH-21-3', 'Inmueble', 'KAM', 'KAM', 1, 'KAM', 'KLA', 'AAA', 'KAMSA', 'APALA', 90, 12, NULL, 20, 20, 0),
(4, 'OAF-21-4', 'Mueble', 'Probando', 'Aja', 1, 'Pues', 'CLICK', 'SUPUTA', 'CARAJO', 'OSTIA', 0, 90, NULL, 20, 38, 0),
(5, 'OAF-21-5', 'Mueble', 'Cantidad', 'Cantidad', 1, 'Cantidad', 'Cantidad', 'Cantidad', 'Javier v', 'ss', 0, 90, '2021-12-12', 20, 37, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `idcc` int(11) NOT NULL,
  `fondo_actual` decimal(13,2) NOT NULL,
  `fondo_maximo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`idcc`, `fondo_actual`, `fondo_maximo`) VALUES
(1, '55.04', 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` int(11) NOT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `cargo`, `rango`) VALUES
(1, 'ACT', 1),
(4, 'Gerente', 2),
(5, 'Jodedor', 2),
(6, 'Ardido', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `departamento_id` int(11) NOT NULL,
  `departamento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `siglas` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`departamento_id`, `departamento`, `siglas`) VALUES
(1, 'OFICINA', 'OAF'),
(2, 'RECURSOS', 'ORH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_cc`
--

CREATE TABLE `facturas_cc` (
  `id_factura_cc` int(11) NOT NULL,
  `id_sol_cc` int(11) NOT NULL,
  `factura` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `facturas_cc`
--

INSERT INTO `facturas_cc` (`id_factura_cc`, `id_sol_cc`, `factura`) VALUES
(1, 1, 'frontend/img/facturas_cc/sol1n1.png'),
(2, 3, 'frontend/img/facturas_cc/sol3n1.png'),
(3, 3, 'frontend/img/facturas_cc/sol3n2.jpg'),
(4, 3, 'frontend/img/facturas_cc/sol3n3.png'),
(5, 4, 'frontend/img/facturas_cc/sol4n1.png'),
(6, 5, 'frontend/img/facturas_cc/sol5n1.png'),
(7, 6, 'frontend/img/facturas_cc/sol6n1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incorporacion_bien`
--

CREATE TABLE `incorporacion_bien` (
  `id_incorporacion_bien` int(11) NOT NULL,
  `id_bien` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_incorporaciones` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `incorporacion_bien`
--

INSERT INTO `incorporacion_bien` (`id_incorporacion_bien`, `id_bien`, `cantidad`, `fecha_incorporaciones`) VALUES
(1, 5, 30, '2021-12-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_noti` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `link` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_noti`, `id_usuario`, `texto`, `fecha`, `leido`, `link`) VALUES
(142, 20, 'Se ha iniciado el tramite de un bien público: KAMSA, por favor indique su confirmación', '2021-12-12', 0, 'movimiento_bienes/46'),
(143, 20, 'Se ha iniciado el tramite de un bien público: KAMSA, por favor indique su confirmación', '2021-12-12', 0, 'movimiento_bienes/46'),
(144, 20, 'Se ha iniciado el tramite de un bien público: KAMSA, por favor indique su confirmación', '2021-12-12', 0, 'movimiento_bienes/46'),
(158, 20, 'ASSS', '2020-10-12', 0, 'sss'),
(160, 20, 'javier gerardo ha solicitado un prestamo del bien público a su responsabilidad: mueble 2.', '2021-12-12', 0, 'revisar_prestamo_bien/62'),
(161, 20, 'javier gerardo ha solicitado un prestamo del bien público a su responsabilidad: mueble 2.', '2021-12-12', 0, 'revisar_prestamo_bien/63'),
(162, 20, 'javier gerardo ha reportado la solicitud de un prestamo del bien público: mueble 2. Por favor indique si esta procederá.', '2021-12-12', 0, 'revisar_prestamo_bien/64'),
(163, 20, 'javier gerardo ha reportado la solicitud de un prestamo del bien público: mueble 2. Por favor indique si esta procederá.', '2021-12-12', 0, 'revisar_prestamo_bien/65'),
(164, 20, 'javier gerardo ha reportado la solicitud de un prestamo del bien público: Mueble 2. Por favor indique si esta procederá.', '2021-12-12', 0, 'revisar_prestamo_bien/66'),
(165, 20, 'javier gerardo ha reportado la solicitud de un prestamo del bien público: Mueble 2. Por favor indique si esta procederá.', '2021-12-12', 0, 'revisar_prestamo_bien/67'),
(166, 20, 'javier gerardo ha reportado la solicitud de un prestamo del bien público: Mueble 2. Por favor indique si esta procederá.', '2021-12-12', 0, 'revisar_prestamo_bien/68'),
(167, 20, 'Has sido encargado de revisar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(168, 20, 'Has sido encargado de verificar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(169, 38, 'Has sido encargado de validar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(170, 20, 'Has sido encargado de revisar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(171, 20, 'Has sido encargado de verificar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(172, 38, 'Has sido encargado de validar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(173, 20, 'Has sido encargado de revisar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(174, 20, 'Has sido encargado de verificar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(175, 37, 'Has sido encargado de validar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien'),
(176, 20, 'Has sido encargado de revisar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien/4'),
(177, 20, 'Has sido encargado de verificar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien/4'),
(178, 37, 'Has sido encargado de validar la incorporación de un bien público, ve a la sección correspondiente.', '2021-12-12', 0, 'verificar_bien/4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_prestamo`
--

CREATE TABLE `observaciones_prestamo` (
  `id_observacion_prestamo` int(11) NOT NULL,
  `id_prestamo_bien` int(11) DEFAULT NULL,
  `texto` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `observaciones_prestamo`
--

INSERT INTO `observaciones_prestamo` (`id_observacion_prestamo`, `id_prestamo_bien`, `texto`) VALUES
(1, 7, 'ALAVERGA SHI'),
(2, 7, 'PAPA'),
(3, 7, 'JODASU'),
(4, 7, 'JABANES'),
(5, 7, 'QEU'),
(6, 7, 'PAPS'),
(7, 7, 'PAPS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'frontend/img/profile/none.jpg',
  `email_validado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_nacimiento` date NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_usuario`, `nombre`, `apellido`, `genero`, `img`, `email_validado`, `fecha_nacimiento`, `cargo_id`, `departamento_id`) VALUES
(20, 'javier', 'gerardo', 'Masculino', 'frontend/img/profile/javileon.jpg', 0, '2000-10-28', 1, 2),
(37, 'Maria jesús', 'Cumare Trompiz', 'Femenino', 'frontend/img/profile/maria.jpg', 0, '1999-10-06', 4, 1),
(38, 'Milimar', 'Cumare Trompiz', 'Femenino', 'frontend/img/profile/none.jpg', 0, '1999-11-26', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permiso_id` int(11) NOT NULL,
  `accion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`permiso_id`, `accion`, `cargo_id`) VALUES
(13, 'Editar_UT_Caja_Chica', 1),
(16, 'Editar_UT_Caja_Chica', 6),
(21, 'Editar_UT_Caja_Chica', 4),
(22, 'Aceptar_Sol_CC', 1),
(25, 'Recepcion_Repo_CC', 1),
(26, 'Coordinacion_Repo_CC', 1),
(27, 'Analisis_Repo_CC', 1),
(28, 'Contador_Repo_CC', 1),
(30, 'Gerencia_Repo_CC', 1),
(31, 'Incorporacion_Muebles', 1),
(32, 'Generar_Nota', 1),
(33, 'Prestar_Bien_Publico', 1),
(34, 'Editar_UT_Caja_Chica', 1),
(35, 'Movimiento_Bienes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_juridica`
--

CREATE TABLE `persona_juridica` (
  `id_presona_juridica` int(11) NOT NULL,
  `id_prestamo_bien` int(11) NOT NULL,
  `razon_social` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_fiscal` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_fijo` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `persona_responsable` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_contacto` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `persona_juridica`
--

INSERT INTO `persona_juridica` (`id_presona_juridica`, `id_prestamo_bien`, `razon_social`, `rif`, `direccion_fiscal`, `telefono_fijo`, `persona_responsable`, `telefono_contacto`) VALUES
(3, 46, 'Razon', 'Rif', 'Direccion', 'fijo', 'nombre', 'contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_bien`
--

CREATE TABLE `prestamo_bien` (
  `id_prestamo_bien` int(11) NOT NULL,
  `id_bien` int(11) DEFAULT NULL COMMENT '\r\n',
  `solicitante` int(11) DEFAULT NULL,
  `fecha_prestamo` date NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `rechazado` tinyint(1) NOT NULL DEFAULT 0,
  `tramitado` tinyint(1) NOT NULL DEFAULT 0,
  `duracion` int(11) NOT NULL,
  `motivo` varchar(2000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `prestamo_bien`
--

INSERT INTO `prestamo_bien` (`id_prestamo_bien`, `id_bien`, `solicitante`, `fecha_prestamo`, `aprobado`, `rechazado`, `tramitado`, `duracion`, `motivo`) VALUES
(7, 3, 20, '2021-12-09', 1, 0, 1, 3, 'JODA'),
(46, 3, 20, '2021-12-11', 1, 0, 1, 40, 'PUTA MADRE'),
(47, 1, 20, '2021-12-12', 0, 0, 0, 120, 'EXTERNO JODA'),
(48, 1, 20, '2021-12-12', 0, 0, 0, 1111, 'qqqqq'),
(49, 1, 20, '2021-12-12', 0, 0, 0, 2, 'AS232'),
(50, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(51, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(52, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(53, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(54, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(55, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(56, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(57, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(58, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(59, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(60, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(61, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(62, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(63, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(64, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(65, 1, 20, '2021-12-12', 0, 0, 0, 29, 'AS232'),
(66, 2, 20, '2021-12-12', 0, 0, 0, 90, 'AQUI AS'),
(67, 2, 20, '2021-12-12', 0, 0, 0, 90, 'AQUI AS'),
(68, 2, 20, '2021-12-12', 0, 0, 0, 90, 'AQUI AS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_solicitud_cc`
--

CREATE TABLE `relacion_solicitud_cc` (
  `id_solicitud_repo_cc` int(11) NOT NULL,
  `id_sol_cc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `relacion_solicitud_cc`
--

INSERT INTO `relacion_solicitud_cc` (`id_solicitud_repo_cc`, `id_sol_cc`) VALUES
(1, 1),
(2, 3),
(2, 4),
(3, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password`
--

CREATE TABLE `reset_password` (
  `id_reset_password` int(11) NOT NULL,
  `user_reset` int(11) NOT NULL,
  `token` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_reset` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cc`
--

CREATE TABLE `solicitud_cc` (
  `id_sol_cc` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `bs` decimal(13,2) NOT NULL,
  `ut_pedido` decimal(13,2) NOT NULL,
  `motivo` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `efectuado` tinyint(1) NOT NULL DEFAULT 0,
  `validado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_cc`
--

INSERT INTO `solicitud_cc` (`id_sol_cc`, `id_usuario`, `fecha`, `bs`, `ut_pedido`, `motivo`, `aprobado`, `efectuado`, `validado`) VALUES
(1, 20, '2021-11-20', '20000.00', '22.22', 'Javier', 1, 1, 1),
(3, 20, '2021-11-21', '220.00', '0.24', 'eee', 1, 1, 1),
(4, 20, '2021-11-21', '4540.00', '5.04', 'QQQQ', 1, 1, 1),
(5, 20, '2021-11-22', '4010.00', '4.46', 'LLALALA', 1, 1, 1),
(6, 20, '2021-12-07', '800.00', '0.89', 'Nueva laptop', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_repo_cc`
--

CREATE TABLE `solicitud_repo_cc` (
  `id_solicitud_repo_cc` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fondo_momento` decimal(13,2) NOT NULL,
  `custodio` tinyint(1) NOT NULL DEFAULT 0,
  `cuentadante` tinyint(1) NOT NULL DEFAULT 0,
  `coordinador` tinyint(1) NOT NULL DEFAULT 0,
  `analista` tinyint(1) NOT NULL DEFAULT 0,
  `contador` tinyint(1) NOT NULL DEFAULT 0,
  `gerente` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_repo_cc`
--

INSERT INTO `solicitud_repo_cc` (`id_solicitud_repo_cc`, `fecha`, `fondo_momento`, `custodio`, `cuentadante`, `coordinador`, `analista`, `contador`, `gerente`) VALUES
(1, '2021-11-20', '65.67', 1, 1, 0, 0, 0, 0),
(2, '2021-11-21', '60.39', 1, 1, 0, 0, 0, 0),
(3, '2021-12-06', '55.04', 1, 1, 1, 1, 1, 1),
(4, '2021-12-09', '55.04', 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite_bienes`
--

CREATE TABLE `tramite_bienes` (
  `id_tramite_bien` int(11) NOT NULL,
  `id_prestamo_bien` int(11) DEFAULT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `concepto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `analista` tinyint(1) NOT NULL DEFAULT 1,
  `coordinador` tinyint(1) NOT NULL DEFAULT 0,
  `entregado` tinyint(1) NOT NULL DEFAULT 0,
  `recibido` int(11) NOT NULL DEFAULT 0,
  `analista2` tinyint(1) NOT NULL DEFAULT 0,
  `coordinador2` tinyint(1) NOT NULL DEFAULT 0,
  `entregado2` tinyint(1) NOT NULL DEFAULT 0,
  `recibido2` tinyint(1) NOT NULL DEFAULT 0,
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL,
  `user3` int(11) DEFAULT NULL,
  `user4` int(11) DEFAULT NULL,
  `fecha_tramite` date NOT NULL,
  `fecha_fin_tramite` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tramite_bienes`
--

INSERT INTO `tramite_bienes` (`id_tramite_bien`, `id_prestamo_bien`, `tipo`, `activo`, `concepto`, `analista`, `coordinador`, `entregado`, `recibido`, `analista2`, `coordinador2`, `entregado2`, `recibido2`, `user1`, `user2`, `user3`, `user4`, `fecha_tramite`, `fecha_fin_tramite`) VALUES
(2, 7, 'Interno', 1, 'Traslado', 1, 1, 1, 1, 1, 1, 1, 1, 20, 37, 37, 20, '2021-12-09', '2021-12-11'),
(5, 46, 'Externo', 1, 'Reparacion', 1, 0, 0, 0, 0, 0, 0, 0, 20, 20, 20, 20, '2021-12-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `permisos` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `email`, `status`, `permisos`) VALUES
(20, 'javileon', '$2y$12$yNvjs9xp6IBM40BPrMMWueflOttUhyBO49lJhm8ajarSIu1BJrpAq', 'javicentego@gmail.com', 'active', 'super'),
(37, 'maria', '$2y$12$/FajvxQKj6q5xfkbfrRIIOf3KluvmyFftQlUzHFPi145nMc8puVcm', 'cocolisosleon@gmail.com', 'active', 'basic'),
(38, 'mili03', '$2y$12$ICddcLMr5VqreSht8avNpuhEpmfkK4PEnMvpFKVRmYJbQOw0O5bXi', 'maryleon@gmail.com', 'active', 'basic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ut`
--

CREATE TABLE `ut` (
  `utid` int(11) NOT NULL,
  `ut` int(11) NOT NULL DEFAULT 0,
  `cambio_ut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ut`
--

INSERT INTO `ut` (`utid`, `ut`, `cambio_ut`) VALUES
(1, 900, 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificacion_bienes`
--

CREATE TABLE `verificacion_bienes` (
  `x` int(11) NOT NULL,
  `id_bien` int(11) DEFAULT NULL,
  `revisado` tinyint(1) NOT NULL DEFAULT 0,
  `verificado` tinyint(1) NOT NULL DEFAULT 0,
  `validado` tinyint(1) NOT NULL DEFAULT 0,
  `user1` int(11) DEFAULT NULL,
  `user2` int(11) DEFAULT NULL COMMENT '\r\n',
  `user3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `verificacion_bienes`
--

INSERT INTO `verificacion_bienes` (`x`, `id_bien`, `revisado`, `verificado`, `validado`, `user1`, `user2`, `user3`) VALUES
(1, 1, 1, 1, 0, 20, 37, 38),
(2, 2, 0, 0, 0, NULL, NULL, NULL),
(3, 3, 0, 0, 0, NULL, NULL, NULL),
(4, 4, 0, 0, 0, 20, 20, 37),
(5, 5, 1, 1, 0, 20, 20, 37);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bienes_publicos`
--
ALTER TABLE `bienes_publicos`
  ADD PRIMARY KEY (`id_bien`),
  ADD KEY `departamento_id` (`departamento_id`),
  ADD KEY `incorporado_por` (`incorporado_por`),
  ADD KEY `responsable` (`responsable`);

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`idcc`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`departamento_id`);

--
-- Indices de la tabla `facturas_cc`
--
ALTER TABLE `facturas_cc`
  ADD PRIMARY KEY (`id_factura_cc`),
  ADD KEY `id_sol_cc` (`id_sol_cc`);

--
-- Indices de la tabla `incorporacion_bien`
--
ALTER TABLE `incorporacion_bien`
  ADD PRIMARY KEY (`id_incorporacion_bien`),
  ADD KEY `id_bien` (`id_bien`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_noti`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `observaciones_prestamo`
--
ALTER TABLE `observaciones_prestamo`
  ADD PRIMARY KEY (`id_observacion_prestamo`),
  ADD KEY `id_prestamo_bien` (`id_prestamo_bien`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `cargo_id` (`cargo_id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permiso_id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- Indices de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD PRIMARY KEY (`id_presona_juridica`),
  ADD KEY `id_prestamo_bien` (`id_prestamo_bien`);

--
-- Indices de la tabla `prestamo_bien`
--
ALTER TABLE `prestamo_bien`
  ADD PRIMARY KEY (`id_prestamo_bien`),
  ADD KEY `id_bien` (`id_bien`),
  ADD KEY `solicitante` (`solicitante`);

--
-- Indices de la tabla `relacion_solicitud_cc`
--
ALTER TABLE `relacion_solicitud_cc`
  ADD KEY `id_solicitud_repo_cc` (`id_solicitud_repo_cc`,`id_sol_cc`),
  ADD KEY `id_sol_cc` (`id_sol_cc`);

--
-- Indices de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id_reset_password`),
  ADD KEY `user_reset` (`user_reset`);

--
-- Indices de la tabla `solicitud_cc`
--
ALTER TABLE `solicitud_cc`
  ADD PRIMARY KEY (`id_sol_cc`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `solicitud_repo_cc`
--
ALTER TABLE `solicitud_repo_cc`
  ADD PRIMARY KEY (`id_solicitud_repo_cc`);

--
-- Indices de la tabla `tramite_bienes`
--
ALTER TABLE `tramite_bienes`
  ADD PRIMARY KEY (`id_tramite_bien`),
  ADD KEY `id_prestamo_bien` (`id_prestamo_bien`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`),
  ADD KEY `user3` (`user3`),
  ADD KEY `user4` (`user4`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ut`
--
ALTER TABLE `ut`
  ADD PRIMARY KEY (`utid`);

--
-- Indices de la tabla `verificacion_bienes`
--
ALTER TABLE `verificacion_bienes`
  ADD PRIMARY KEY (`x`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`),
  ADD KEY `user3` (`user3`),
  ADD KEY `id_bien` (`id_bien`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bienes_publicos`
--
ALTER TABLE `bienes_publicos`
  MODIFY `id_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `idcc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `departamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturas_cc`
--
ALTER TABLE `facturas_cc`
  MODIFY `id_factura_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `incorporacion_bien`
--
ALTER TABLE `incorporacion_bien`
  MODIFY `id_incorporacion_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_noti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `observaciones_prestamo`
--
ALTER TABLE `observaciones_prestamo`
  MODIFY `id_observacion_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permiso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  MODIFY `id_presona_juridica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamo_bien`
--
ALTER TABLE `prestamo_bien`
  MODIFY `id_prestamo_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id_reset_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `solicitud_cc`
--
ALTER TABLE `solicitud_cc`
  MODIFY `id_sol_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitud_repo_cc`
--
ALTER TABLE `solicitud_repo_cc`
  MODIFY `id_solicitud_repo_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tramite_bienes`
--
ALTER TABLE `tramite_bienes`
  MODIFY `id_tramite_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `verificacion_bienes`
--
ALTER TABLE `verificacion_bienes`
  MODIFY `x` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bienes_publicos`
--
ALTER TABLE `bienes_publicos`
  ADD CONSTRAINT `bienes_publicos_ibfk_1` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`departamento_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `bienes_publicos_ibfk_2` FOREIGN KEY (`incorporado_por`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `bienes_publicos_ibfk_3` FOREIGN KEY (`responsable`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `facturas_cc`
--
ALTER TABLE `facturas_cc`
  ADD CONSTRAINT `facturas_cc_ibfk_1` FOREIGN KEY (`id_sol_cc`) REFERENCES `solicitud_cc` (`id_sol_cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incorporacion_bien`
--
ALTER TABLE `incorporacion_bien`
  ADD CONSTRAINT `incorporacion_bien_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes_publicos` (`id_bien`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observaciones_prestamo`
--
ALTER TABLE `observaciones_prestamo`
  ADD CONSTRAINT `observaciones_prestamo_ibfk_1` FOREIGN KEY (`id_prestamo_bien`) REFERENCES `prestamo_bien` (`id_prestamo_bien`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`departamento_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `perfil_ibfk_3` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  ADD CONSTRAINT `persona_juridica_ibfk_1` FOREIGN KEY (`id_prestamo_bien`) REFERENCES `prestamo_bien` (`id_prestamo_bien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo_bien`
--
ALTER TABLE `prestamo_bien`
  ADD CONSTRAINT `prestamo_bien_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes_publicos` (`id_bien`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `prestamo_bien_ibfk_2` FOREIGN KEY (`solicitante`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `relacion_solicitud_cc`
--
ALTER TABLE `relacion_solicitud_cc`
  ADD CONSTRAINT `relacion_solicitud_cc_ibfk_1` FOREIGN KEY (`id_sol_cc`) REFERENCES `solicitud_cc` (`id_sol_cc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relacion_solicitud_cc_ibfk_2` FOREIGN KEY (`id_solicitud_repo_cc`) REFERENCES `solicitud_repo_cc` (`id_solicitud_repo_cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `reset_password_ibfk_1` FOREIGN KEY (`user_reset`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_cc`
--
ALTER TABLE `solicitud_cc`
  ADD CONSTRAINT `solicitud_cc_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tramite_bienes`
--
ALTER TABLE `tramite_bienes`
  ADD CONSTRAINT `tramite_bienes_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `tramite_bienes_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `tramite_bienes_ibfk_3` FOREIGN KEY (`user3`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `tramite_bienes_ibfk_4` FOREIGN KEY (`user4`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `tramite_bienes_ibfk_5` FOREIGN KEY (`id_prestamo_bien`) REFERENCES `prestamo_bien` (`id_prestamo_bien`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `verificacion_bienes`
--
ALTER TABLE `verificacion_bienes`
  ADD CONSTRAINT `verificacion_bienes_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `verificacion_bienes_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `verificacion_bienes_ibfk_3` FOREIGN KEY (`user3`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `verificacion_bienes_ibfk_4` FOREIGN KEY (`id_bien`) REFERENCES `bienes_publicos` (`id_bien`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
