-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2025 a las 13:48:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `c`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `Nombre` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Comentario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Interes` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nacionalidad` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`Nombre`, `Apellido`, `Email`, `Fecha`, `Comentario`, `Interes`, `Nacionalidad`) VALUES
('Juana', 'huytr', 'la@hotmail.com', '2006-05-13', 'hilh', 'matematica', 'Argentina'),
('Juana', 'huytr', 'la@hotmail.com', '2006-05-13', 'huigctd', 'matematica', 'Argentina'),
('Juana', 'huytr', 'la@hotmail.com', '2025-10-08', 'prueba', 'matematica', 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `turno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `nivel`, `turno`) VALUES
(1, '1°A', 'Primario', 'Mañana'),
(2, '2°B', 'Primario', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `legajo` int(11) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `nombre`, `legajo`, `especialidad`, `email`) VALUES
(1, 'María López', 0, 'Matemática', 'maria@colegio.edu.ar'),
(2, 'Carlos Pérez', 0, 'Historia', 'carlos@colegio.edu.ar'),
(0, 'Carlos', 5, 'mate', 'la@hotmail.com'),
(0, 'Roberto', 0, 'Musica', 'la@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nota` decimal(4,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id`, `alumno_id`, `materia`, `nota`, `fecha`) VALUES
(1, 1, 'Matemática', 8.50, '2025-09-01'),
(2, 1, 'Historia', 7.00, '2025-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha_inscripcion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuposTotales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador'),
(3, 'Lector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asistencia`
--

CREATE TABLE `tbl_asistencia` (
  `id` int(11) NOT NULL,
  `presente` tinyint(4) NOT NULL,
  `ausente` tinyint(4) NOT NULL,
  `asistencia_fecha` date NOT NULL,
  `estudiante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla Asistencia';

--
-- Volcado de datos para la tabla `tbl_asistencia`
--

INSERT INTO `tbl_asistencia` (`id`, `presente`, `ausente`, `asistencia_fecha`, `estudiante_id`) VALUES
(60, 1, 0, '2025-12-13', 14),
(61, 1, 0, '2025-12-13', 16),
(62, 1, 0, '2025-12-13', 17),
(63, 1, 0, '2025-12-13', 18),
(64, 1, 0, '2025-12-13', 19),
(65, 1, 0, '2025-12-13', 20),
(67, 1, 0, '2025-12-12', 14),
(68, 0, 1, '2025-12-12', 16),
(69, 1, 0, '2025-12-12', 17),
(70, 0, 1, '2025-12-12', 18),
(71, 1, 0, '2025-12-12', 19),
(72, 1, 0, '2025-12-12', 20),
(73, 1, 0, '2025-12-12', 21),
(74, 1, 0, '2025-12-12', 22),
(75, 1, 0, '2025-12-12', 23),
(76, 1, 0, '2025-12-12', 24),
(77, 1, 0, '2025-12-12', 25),
(78, 1, 0, '2025-12-12', 26),
(79, 1, 0, '2025-12-12', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiante`
--

CREATE TABLE `tbl_estudiante` (
  `id` int(11) NOT NULL,
  `nombres` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fecha_estudiante` date NOT NULL,
  `clase` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tabla Estudiante';

--
-- Volcado de datos para la tabla `tbl_estudiante`
--

INSERT INTO `tbl_estudiante` (`id`, `nombres`, `fecha_estudiante`, `clase`, `id_materia`) VALUES
(14, 'Carla Garcia', '2005-08-16', 'HTML', 0),
(16, 'Carla Garcia', '2005-06-13', 'PHP', 0),
(17, 'Carla Garcia', '2005-06-13', 'PHP', 0),
(18, 'Mario', '2021-12-06', 'musica', 0),
(19, 'Mario', '2025-12-04', 'musica', 0),
(20, 'Sergio', '2005-12-03', 'musica', 12),
(21, 'WALTER', '1984-12-01', 'LITERATURA', 2),
(22, 'Carla Garcia', '2005-12-12', 'PHP', 11),
(23, 'Carla Garcia', '2005-12-12', 'PHP', 14),
(24, 'Carla Garcia', '2005-12-12', 'economia', 14),
(25, 'Carla Garcia', '2000-12-12', 'economia', 11),
(26, 'Marta', '2000-02-11', 'PHP', 9),
(27, 'Marta', '2000-02-11', 'PHP', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiante_materia`
--

CREATE TABLE `tbl_estudiante_materia` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estudiante_materia`
--

INSERT INTO `tbl_estudiante_materia` (`id`, `estudiante_id`, `materia_id`) VALUES
(1, 16, 4),
(2, 17, 8),
(3, 18, 12),
(4, 19, 12),
(5, 20, 12),
(6, 21, 2),
(7, 22, 11),
(8, 23, 14),
(9, 24, 14),
(10, 25, 11),
(12, 26, 9),
(14, 27, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_materia`
--

CREATE TABLE `tbl_materia` (
  `id` int(11) NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `cuposTotales` int(11) NOT NULL DEFAULT 0,
  `inscriptos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_materia`
--

INSERT INTO `tbl_materia` (`id`, `nombre_materia`, `descripcion`, `cuposTotales`, `inscriptos`) VALUES
(1, 'Matemática', 'Cálculo, álgebra y geometría', 30, 0),
(2, 'Lengua y Literatura', 'Análisis de textos y gramática', 25, 1),
(3, 'Historia Argentina', 'Desde la colonia hasta la actualidad', 20, 0),
(4, 'Geografía', 'Estudio del espacio y sociedades', 28, 0),
(5, 'Biología', 'Ciencias de la vida y organismos', 35, 0),
(6, 'Física', 'Leyes del movimiento y energía', 30, 0),
(7, 'Química', 'Transformaciones de la materia', 30, 0),
(8, 'Inglés', 'Lengua extranjera y comunicación', 25, 1),
(9, 'Informática', 'Tecnologías digitales y programación', 30, 2),
(10, 'Educación Física', 'Actividad corporal y salud', 40, 0),
(11, 'Arte', 'Expresión visual y creatividad', 20, 3),
(12, 'Música', 'Lenguaje sonoro y práctica musical', 20, 3),
(13, 'Ética y Ciudadanía', 'Valores, derechos y convivencia', 22, 0),
(14, 'Economía', 'Sistemas económicos y finanzas', 25, 4),
(15, 'Literatura Universal', 'Obras clásicas y modernas del mundo', 18, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `id_rol`) VALUES
(4, 'lector', '$2y$10$Qa7O4QP0qScQ.cXJga2tfeT7pYLSEjqIIo8dC0hnf/JoJpdXnsBxS', 3),
(5, 'consultor', '$2y$10$VLb0th8bg9VO1ABHy.6woe8rsrYjBKREWtstylCN5tSIkTQE3lowG', 4),
(0, 'admin', '$2y$10$0GPHopFXqBcTGtikKZXthuAlFPMdxKe5yCcxT/DSse.35AteSTHGe', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`estudiante_id`);

--
-- Indices de la tabla `tbl_estudiante`
--
ALTER TABLE `tbl_estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_estudiante_materia`
--
ALTER TABLE `tbl_estudiante_materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indices de la tabla `tbl_materia`
--
ALTER TABLE `tbl_materia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `tbl_estudiante`
--
ALTER TABLE `tbl_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_estudiante_materia`
--
ALTER TABLE `tbl_estudiante_materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_materia`
--
ALTER TABLE `tbl_materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `tbl_asistencia`
--
ALTER TABLE `tbl_asistencia`
  ADD CONSTRAINT `tbl_asistencia_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `tbl_estudiante` (`id`);

--
-- Filtros para la tabla `tbl_estudiante_materia`
--
ALTER TABLE `tbl_estudiante_materia`
  ADD CONSTRAINT `tbl_estudiante_materia_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `tbl_estudiante` (`id`),
  ADD CONSTRAINT `tbl_estudiante_materia_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `tbl_materia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
