-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-05-2023 a las 22:52:57
-- Versión del servidor: 5.7.42-0ubuntu0.18.04.1
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mborper_sprint4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes-clase`
--

CREATE TABLE `clientes-clase` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  `mensaje` varchar(255) NOT NULL,
  `zip` int(8) NOT NULL,
  `estado-venta` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes-clase`
--

INSERT INTO `clientes-clase` (`id`, `nombre`, `apellidos`, `email`, `usuario`, `mensaje`, `zip`, `estado-venta`) VALUES
(1, 'Ana', 'Martin Pizarro', 'ana@email.com', NULL, '', 46730, 1),
(3, 'Charles', 'Perez', 'charles@email.com', 16, '', 46723, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huertos`
--

CREATE TABLE `huertos` (
  `id-huerto` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `id-usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id-medida` int(11) NOT NULL,
  `id-sensor` int(11) NOT NULL,
  `valor-medida` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'comercial'),
(3, 'usuario'),
(4, 'tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `id-sensor` int(11) NOT NULL,
  `tipo-sensor` int(11) NOT NULL,
  `huerto` int(11) NOT NULL,
  `limite-min` int(11) NOT NULL,
  `limite-max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos-de-sensores`
--

CREATE TABLE `tipos-de-sensores` (
  `id-tipoDeSensor` int(5) NOT NULL,
  `nombreTipoSensor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos-de-sensores`
--

INSERT INTO `tipos-de-sensores` (`id-tipoDeSensor`, `nombreTipoSensor`) VALUES
(1, 'humedad'),
(2, 'salinidad'),
(3, 'temperatur'),
(4, 'luminosida'),
(5, 'ph');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos-tecnico`
--

CREATE TABLE `trabajos-tecnico` (
  `id-trabajo` int(11) NOT NULL,
  `id-tecnico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajos-tecnico`
--

INSERT INTO `trabajos-tecnico` (`id-trabajo`, `id-tecnico`) VALUES
(3, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasenya` varchar(20) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasenya`, `rol`) VALUES
(16, 'charles', '1234', 3),
(17, 'admin', '1234', 1),
(18, 'tecnico', '1234', 4),
(19, 'comercial', '1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes-clase`
--
ALTER TABLE `clientes-clase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_usuarios` (`usuario`);

--
-- Indices de la tabla `huertos`
--
ALTER TABLE `huertos`
  ADD PRIMARY KEY (`id-huerto`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id-medida`),
  ADD KEY `fk-sensorDeOrigen` (`id-sensor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`id-sensor`),
  ADD KEY `fk-huertoPrincipal` (`huerto`),
  ADD KEY `fk-limiteMIN` (`limite-min`),
  ADD KEY `fk-limiteMAXX` (`limite-max`),
  ADD KEY `fk-tipoDeSensor` (`tipo-sensor`);

--
-- Indices de la tabla `tipos-de-sensores`
--
ALTER TABLE `tipos-de-sensores`
  ADD PRIMARY KEY (`id-tipoDeSensor`);

--
-- Indices de la tabla `trabajos-tecnico`
--
ALTER TABLE `trabajos-tecnico`
  ADD PRIMARY KEY (`id-trabajo`),
  ADD KEY `fk-tec-encargado` (`id-tecnico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ik_usuario_rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes-clase`
--
ALTER TABLE `clientes-clase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `huertos`
--
ALTER TABLE `huertos`
  MODIFY `id-huerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id-medida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `id-sensor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajos-tecnico`
--
ALTER TABLE `trabajos-tecnico`
  MODIFY `id-trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes-clase`
--
ALTER TABLE `clientes-clase`
  ADD CONSTRAINT `fk_clientes_usuarios` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `huertos`
--
ALTER TABLE `huertos`
  ADD CONSTRAINT `fk-huerto-usuario` FOREIGN KEY (`id-huerto`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD CONSTRAINT `fk-sensorDeOrigen` FOREIGN KEY (`id-sensor`) REFERENCES `sensores` (`id-sensor`);

--
-- Filtros para la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD CONSTRAINT `fk-huertoPrincipal` FOREIGN KEY (`huerto`) REFERENCES `huertos` (`id-huerto`),
  ADD CONSTRAINT `fk-limiteMAXX` FOREIGN KEY (`limite-max`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk-limiteMIN` FOREIGN KEY (`limite-min`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk-tipoDeSensor` FOREIGN KEY (`tipo-sensor`) REFERENCES `tipos-de-sensores` (`id-tipoDeSensor`);

--
-- Filtros para la tabla `trabajos-tecnico`
--
ALTER TABLE `trabajos-tecnico`
  ADD CONSTRAINT `fk-datos-encargo` FOREIGN KEY (`id-trabajo`) REFERENCES `clientes-clase` (`id`),
  ADD CONSTRAINT `fk-tec-encargado` FOREIGN KEY (`id-tecnico`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `ik_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
