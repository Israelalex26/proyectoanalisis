-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2023 a las 17:39:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aguinaldo`
--

CREATE TABLE `aguinaldo` (
  `id_aguinaldo` int(11) NOT NULL,
  `fk_id_planilla` int(11) DEFAULT NULL,
  `fecha_cargo` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anticiposalario`
--

CREATE TABLE `anticiposalario` (
  `id_anticiposalario` int(11) NOT NULL,
  `fecha` varchar(14) DEFAULT NULL,
  `monto` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `hora_entrad` varchar(25) DEFAULT NULL,
  `hora_salida` varchar(25) DEFAULT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bono14`
--

CREATE TABLE `bono14` (
  `id_bono14` int(11) NOT NULL,
  `fk_id_planilla` int(11) DEFAULT NULL,
  `fecha_cargo` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE `comision` (
  `id_comision` int(11) NOT NULL,
  `rango` varchar(30) DEFAULT NULL,
  `porcentaje_comision` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compratiendasolidarista`
--

CREATE TABLE `compratiendasolidarista` (
  `id_compratiendasolidarista` int(11) NOT NULL,
  `fk_id_proudcto` int(11) DEFAULT NULL,
  `fecha` varchar(14) DEFAULT NULL,
  `cantidad_compra` int(11) DEFAULT NULL,
  `monto_compra` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `correo_electronico` varchar(40) DEFAULT NULL,
  `numero_telefono` varchar(20) DEFAULT NULL,
  `conyuge` varchar(100) DEFAULT NULL,
  `jornada` varchar(20) DEFAULT NULL,
  `activo` varchar(15) DEFAULT NULL,
  `expediente_empleado` varchar(100) DEFAULT NULL,
  `foto_empleado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id_expediente` int(11) NOT NULL,
  `archivo_pdf` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historailsalario`
--

CREATE TABLE `historailsalario` (
  `id_historailsalario` int(11) NOT NULL,
  `salario_anterior` float DEFAULT NULL,
  `salario_nuevo` float DEFAULT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horaextra`
--

CREATE TABLE `horaextra` (
  `id_horaextra` int(11) NOT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL,
  `fecha` varchar(14) DEFAULT NULL,
  `hora_extra` varchar(14) DEFAULT NULL,
  `monto` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidacionlaboral`
--

CREATE TABLE `liquidacionlaboral` (
  `id_liquidacionlaboral` int(11) NOT NULL,
  `fecha_terminacion_trabajo` varchar(14) DEFAULT NULL,
  `monto_liquidacion` float DEFAULT NULL,
  `motivo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla`
--

CREATE TABLE `planilla` (
  `id_planilla` int(11) NOT NULL,
  `fehca_de_cierre` varchar(13) DEFAULT NULL,
  `observaciones` varchar(60) DEFAULT NULL,
  `total_de_empleado` int(11) DEFAULT NULL,
  `totales_finales` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `recibos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliza`
--

CREATE TABLE `poliza` (
  `id_poliza` int(11) NOT NULL,
  `costos` float DEFAULT NULL,
  `fk_id_tipopoliza` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

CREATE TABLE `salario` (
  `id_salario` int(11) NOT NULL,
  `monto_base` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopoliza`
--

CREATE TABLE `tipopoliza` (
  `id_tipopoliza` int(11) NOT NULL,
  `descripcion` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `correo_electronico` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `rol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `correo_electronico`, `contrasena`, `nombre_usuario`, `rol`) VALUES
(1, 'eacunap@miumg.edu.gt', 'Holaque@#2', 'elian acuña perez', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fk_id_comision` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `fecha_de_venta` varchar(14) DEFAULT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD PRIMARY KEY (`id_aguinaldo`),
  ADD KEY `fk_aguinaldo_planilla` (`fk_id_planilla`);

--
-- Indices de la tabla `anticiposalario`
--
ALTER TABLE `anticiposalario`
  ADD PRIMARY KEY (`id_anticiposalario`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `bono14`
--
ALTER TABLE `bono14`
  ADD PRIMARY KEY (`id_bono14`),
  ADD KEY `fk_bono14_planilla` (`fk_id_planilla`);

--
-- Indices de la tabla `comision`
--
ALTER TABLE `comision`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `compratiendasolidarista`
--
ALTER TABLE `compratiendasolidarista`
  ADD PRIMARY KEY (`id_compratiendasolidarista`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id_expediente`);

--
-- Indices de la tabla `historailsalario`
--
ALTER TABLE `historailsalario`
  ADD PRIMARY KEY (`id_historailsalario`);

--
-- Indices de la tabla `horaextra`
--
ALTER TABLE `horaextra`
  ADD PRIMARY KEY (`id_horaextra`);

--
-- Indices de la tabla `liquidacionlaboral`
--
ALTER TABLE `liquidacionlaboral`
  ADD PRIMARY KEY (`id_liquidacionlaboral`);

--
-- Indices de la tabla `planilla`
--
ALTER TABLE `planilla`
  ADD PRIMARY KEY (`id_planilla`);

--
-- Indices de la tabla `poliza`
--
ALTER TABLE `poliza`
  ADD PRIMARY KEY (`id_poliza`),
  ADD KEY `fk_poliza_tipopoliza` (`fk_id_tipopoliza`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`id_salario`);

--
-- Indices de la tabla `tipopoliza`
--
ALTER TABLE `tipopoliza`
  ADD PRIMARY KEY (`id_tipopoliza`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fk_ventas_comision` (`fk_id_comision`),
  ADD KEY `fk_ventas_empleado` (`fk_id_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD CONSTRAINT `fk_aguinaldo_planilla` FOREIGN KEY (`fk_id_planilla`) REFERENCES `planilla` (`id_planilla`);

--
-- Filtros para la tabla `bono14`
--
ALTER TABLE `bono14`
  ADD CONSTRAINT `fk_bono14_planilla` FOREIGN KEY (`fk_id_planilla`) REFERENCES `planilla` (`id_planilla`);

--
-- Filtros para la tabla `poliza`
--
ALTER TABLE `poliza`
  ADD CONSTRAINT `fk_poliza_tipopoliza` FOREIGN KEY (`fk_id_tipopoliza`) REFERENCES `tipopoliza` (`id_tipopoliza`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_comision` FOREIGN KEY (`fk_id_comision`) REFERENCES `comision` (`id_comision`),
  ADD CONSTRAINT `fk_ventas_empleado` FOREIGN KEY (`fk_id_empleado`) REFERENCES `empleado` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
