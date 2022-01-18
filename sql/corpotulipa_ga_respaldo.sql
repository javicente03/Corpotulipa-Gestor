-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2022 a las 03:32:29
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
-- Base de datos: `corpotulipa_ga_respaldo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adiestramiento`
--

CREATE TABLE `adiestramiento` (
  `id_adiestramiento` int(11) NOT NULL,
  `solicitante` int(11) DEFAULT NULL,
  `fecha_solicitud` date NOT NULL,
  `denominacion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `metodo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `meta_asociada` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `area_conocimiento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_adiestramiento` date DEFAULT NULL,
  `institucion` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `lugar_evento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `duracion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `costo_unitario` int(11) NOT NULL,
  `telefono` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `disponibilidad_presupuestaria` tinyint(1) NOT NULL,
  `partida` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `recomendaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `observaciones` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_publicos`
--

CREATE TABLE `bienes_publicos` (
  `id_bien` int(11) NOT NULL,
  `catalogo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `valor` decimal(11,2) NOT NULL,
  `fecha_incorporacion` date DEFAULT NULL,
  `incorporado_por` int(11) DEFAULT NULL,
  `responsable` int(11) DEFAULT NULL,
  `existente` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `idcc` int(11) NOT NULL,
  `fondo_actual` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` int(11) NOT NULL,
  `cargo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rango` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `departamento_id` int(11) NOT NULL,
  `departamento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `siglas` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sede` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_cc`
--

CREATE TABLE `facturas_cc` (
  `id_factura_cc` int(11) NOT NULL,
  `id_sol_cc` int(11) NOT NULL,
  `factura` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `induccion`
--

CREATE TABLE `induccion` (
  `id_induccion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_induccion` date NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  `cuadernillo` tinyint(1) NOT NULL DEFAULT 0,
  `descripcion` tinyint(1) NOT NULL DEFAULT 0,
  `politica` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_respuesta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `solicitante` int(11) DEFAULT NULL,
  `respuesta` int(11) DEFAULT NULL,
  `motivo` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inventario` date NOT NULL,
  `fecha_fin_inventario` date DEFAULT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `rechazado` tinyint(1) NOT NULL DEFAULT 0,
  `razon_rechazo` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_data`
--

CREATE TABLE `inventario_data` (
  `id_inventario_data` int(11) NOT NULL,
  `id_inventario_departamento` int(11) DEFAULT NULL,
  `id_bien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_departamento`
--

CREATE TABLE `inventario_departamento` (
  `id_inventario_departamento` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `gerente` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `fecha_inventario_dep` date NOT NULL,
  `valor_total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `pdf_inventario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_noti` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `link` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_prestamo`
--

CREATE TABLE `observaciones_prestamo` (
  `id_observacion_prestamo` int(11) NOT NULL,
  `id_prestamo_bien` int(11) DEFAULT NULL,
  `texto` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante_adiestramiento`
--

CREATE TABLE `participante_adiestramiento` (
  `id_participante_adiestramiento` int(11) NOT NULL,
  `participante` int(11) DEFAULT NULL,
  `nivel_actual` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nivel_requerido` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_adiestramiento` int(11) DEFAULT NULL,
  `pregunta1` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta2` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta3` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta4` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta5` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta6` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `pregunta7` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `conocimientos_adquiridos` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `recomendaciones` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'frontend/img/profile/none.jpg',
  `email_validado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_nacimiento` date NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permiso_id` int(11) NOT NULL,
  `accion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_solicitud_cc`
--

CREATE TABLE `relacion_solicitud_cc` (
  `id_solicitud_repo_cc` int(11) NOT NULL,
  `id_sol_cc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_bien`
--

CREATE TABLE `reporte_bien` (
  `id_reporte_bien` int(11) NOT NULL,
  `id_bien` int(11) DEFAULT NULL,
  `motivo_reporte` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_reporte` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `reporte_tramitado` tinyint(1) NOT NULL DEFAULT 0,
  `desincorporado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_desincorporacion` date DEFAULT NULL,
  `img1` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_permiso`
--

CREATE TABLE `solicitud_permiso` (
  `id_solicitud_permiso` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `motivo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `responsable` int(11) DEFAULT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_respuesta` date DEFAULT NULL,
  `remunerado` tinyint(1) NOT NULL DEFAULT 0,
  `observacion` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `permisos` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'basic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ut`
--

CREATE TABLE `ut` (
  `utid` int(11) NOT NULL,
  `ut` int(11) NOT NULL DEFAULT 0,
  `cambio_ut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adiestramiento`
--
ALTER TABLE `adiestramiento`
  ADD PRIMARY KEY (`id_adiestramiento`),
  ADD KEY `solicitante` (`solicitante`);

--
-- Indices de la tabla `bienes_publicos`
--
ALTER TABLE `bienes_publicos`
  ADD PRIMARY KEY (`id_bien`),
  ADD KEY `departamento_id` (`departamento_id`),
  ADD KEY `incorporado_por` (`incorporado_por`),
  ADD KEY `responsable` (`responsable`);
ALTER TABLE `bienes_publicos` ADD FULLTEXT KEY `nombre_bien` (`nombre_bien`);
ALTER TABLE `bienes_publicos` ADD FULLTEXT KEY `descripcion` (`descripcion`);

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
ALTER TABLE `departamento` ADD FULLTEXT KEY `siglas` (`siglas`);

--
-- Indices de la tabla `facturas_cc`
--
ALTER TABLE `facturas_cc`
  ADD PRIMARY KEY (`id_factura_cc`),
  ADD KEY `id_sol_cc` (`id_sol_cc`);

--
-- Indices de la tabla `induccion`
--
ALTER TABLE `induccion`
  ADD PRIMARY KEY (`id_induccion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `responsable` (`responsable`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `solicitante` (`solicitante`),
  ADD KEY `incorporado_por` (`respuesta`);

--
-- Indices de la tabla `inventario_data`
--
ALTER TABLE `inventario_data`
  ADD PRIMARY KEY (`id_inventario_data`),
  ADD KEY `id_inventario_departamento` (`id_inventario_departamento`),
  ADD KEY `id_bien` (`id_bien`);

--
-- Indices de la tabla `inventario_departamento`
--
ALTER TABLE `inventario_departamento`
  ADD PRIMARY KEY (`id_inventario_departamento`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `gerente` (`gerente`),
  ADD KEY `departamento_id` (`departamento_id`);

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
  ADD KEY `id_prestamo_bien` (`id_prestamo_bien`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `participante_adiestramiento`
--
ALTER TABLE `participante_adiestramiento`
  ADD PRIMARY KEY (`id_participante_adiestramiento`),
  ADD KEY `id_adiestramiento` (`id_adiestramiento`),
  ADD KEY `participante` (`participante`);

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
-- Indices de la tabla `reporte_bien`
--
ALTER TABLE `reporte_bien`
  ADD PRIMARY KEY (`id_reporte_bien`),
  ADD KEY `id_bien` (`id_bien`);

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
-- Indices de la tabla `solicitud_permiso`
--
ALTER TABLE `solicitud_permiso`
  ADD PRIMARY KEY (`id_solicitud_permiso`),
  ADD KEY `responsable` (`responsable`),
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
-- AUTO_INCREMENT de la tabla `adiestramiento`
--
ALTER TABLE `adiestramiento`
  MODIFY `id_adiestramiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bienes_publicos`
--
ALTER TABLE `bienes_publicos`
  MODIFY `id_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `idcc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `departamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `facturas_cc`
--
ALTER TABLE `facturas_cc`
  MODIFY `id_factura_cc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `induccion`
--
ALTER TABLE `induccion`
  MODIFY `id_induccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inventario_data`
--
ALTER TABLE `inventario_data`
  MODIFY `id_inventario_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_departamento`
--
ALTER TABLE `inventario_departamento`
  MODIFY `id_inventario_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_noti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observaciones_prestamo`
--
ALTER TABLE `observaciones_prestamo`
  MODIFY `id_observacion_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participante_adiestramiento`
--
ALTER TABLE `participante_adiestramiento`
  MODIFY `id_participante_adiestramiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permiso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona_juridica`
--
ALTER TABLE `persona_juridica`
  MODIFY `id_presona_juridica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo_bien`
--
ALTER TABLE `prestamo_bien`
  MODIFY `id_prestamo_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `reporte_bien`
--
ALTER TABLE `reporte_bien`
  MODIFY `id_reporte_bien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id_reset_password` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_cc`
--
ALTER TABLE `solicitud_cc`
  MODIFY `id_sol_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitud_permiso`
--
ALTER TABLE `solicitud_permiso`
  MODIFY `id_solicitud_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_repo_cc`
--
ALTER TABLE `solicitud_repo_cc`
  MODIFY `id_solicitud_repo_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tramite_bienes`
--
ALTER TABLE `tramite_bienes`
  MODIFY `id_tramite_bien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `verificacion_bienes`
--
ALTER TABLE `verificacion_bienes`
  MODIFY `x` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adiestramiento`
--
ALTER TABLE `adiestramiento`
  ADD CONSTRAINT `adiestramiento_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
-- Filtros para la tabla `induccion`
--
ALTER TABLE `induccion`
  ADD CONSTRAINT `induccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `induccion_ibfk_2` FOREIGN KEY (`responsable`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`solicitante`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`respuesta`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `inventario_data`
--
ALTER TABLE `inventario_data`
  ADD CONSTRAINT `inventario_data_ibfk_1` FOREIGN KEY (`id_inventario_departamento`) REFERENCES `inventario_departamento` (`id_inventario_departamento`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `inventario_data_ibfk_2` FOREIGN KEY (`id_bien`) REFERENCES `bienes_publicos` (`id_bien`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `inventario_departamento`
--
ALTER TABLE `inventario_departamento`
  ADD CONSTRAINT `inventario_departamento_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `inventario_departamento_ibfk_2` FOREIGN KEY (`gerente`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `inventario_departamento_ibfk_3` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`departamento_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observaciones_prestamo`
--
ALTER TABLE `observaciones_prestamo`
  ADD CONSTRAINT `observaciones_prestamo_ibfk_1` FOREIGN KEY (`id_prestamo_bien`) REFERENCES `prestamo_bien` (`id_prestamo_bien`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `observaciones_prestamo_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `participante_adiestramiento`
--
ALTER TABLE `participante_adiestramiento`
  ADD CONSTRAINT `participante_adiestramiento_ibfk_1` FOREIGN KEY (`participante`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `participante_adiestramiento_ibfk_2` FOREIGN KEY (`id_adiestramiento`) REFERENCES `adiestramiento` (`id_adiestramiento`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `reporte_bien`
--
ALTER TABLE `reporte_bien`
  ADD CONSTRAINT `reporte_bien_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes_publicos` (`id_bien`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `solicitud_permiso`
--
ALTER TABLE `solicitud_permiso`
  ADD CONSTRAINT `solicitud_permiso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `solicitud_permiso_ibfk_2` FOREIGN KEY (`responsable`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
