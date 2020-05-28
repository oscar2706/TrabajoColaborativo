-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-05-2020 a las 09:22:54
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `matricula` int(9) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`matricula`, `nombre`, `correo`, `password`) VALUES
(20158868, 'Nallely Zamora', 'nallelyzamora@alumno.buap.com', 'password'),
(20159969, 'Karen Reyes', 'karenreyes@alumno.buap.com', 'password'),
(20165671, 'Pedro Páramo', 'pedroparamo@alumno.buap.com', 'password'),
(20168548, 'Cristobal Mora', 'cristobalmora@alumno.buap.com', 'password'),
(201300098, 'Ernesto Villegas', 'ernestovillegas@alumno.buap.com', 'password'),
(201313123, 'Yanahi Villegas', 'yanahivillegas@alumno.buap.com', 'password'),
(201347869, 'arnulfo gutierrez', 'arnulfogutierrez@alumno.buap.com', 'password'),
(201377892, 'Victor Montiel', 'victormontiel@alumno.buap.com', 'password'),
(201414324, 'Teresa Morgan', 'teresamorgan@alumno.buap.com', 'password'),
(201414675, 'Samantha Hernandez', 'samantahernandez@alumno.buap.com', 'password'),
(201476581, 'reynaldo mijares', 'reynaldomijares@alumno.buap.com', 'password'),
(201488885, 'Luis Dominguez', 'luisdominguez@alumno.buap.com', 'password'),
(201525487, 'Rubén Varela', 'rubenvarela@buap.com', 'pass'),
(201558581, 'Martha Robles', 'martharobles@alumno.buap.com', 'password'),
(201564611, 'Erika Robledo', 'erikarobledo@alumno.buap.com', 'password'),
(201565432, 'Marcial Flores', 'marcialflores@alumno.buap.com', 'password'),
(201569541, 'Carlos Gomez', 'carlozgomez@alumno.buap.com', 'password'),
(201585812, 'Ismael Juarez', 'ismaeljuarez@alumno.buap.com', 'password'),
(201586819, 'Marisol Reyes', 'marisolreyes@alumno.buap.com', 'password'),
(201588776, 'Jorge Cuervo', 'jorgecuervo@alumno.buap.com', 'password'),
(201591087, 'Diana Morales', 'dianamorales@alumno.buap.com', 'password'),
(201611223, 'Erika Cebada', 'erikacebada@alumno.buap.com', 'password'),
(201616000, 'Estefanía Aguayo', 'estefaniaaguayo@alumno.buap.com', 'password'),
(201671084, 'Juan Escutia', 'juanescutia@alumno.buap.com', 'password'),
(201671581, 'Cristal Arandano', 'cristalarandano@alumno.buap.com', 'password'),
(201677003, 'Nayeli Leyva', 'nayelileyva@alumno.buap.com', 'password'),
(201677651, 'Rubi Tehuitzil', 'rubitehuitzil@alumno.buap.com', 'password'),
(201687765, 'Pamela Rios', 'pamelarios@alumno.buap.com', 'password'),
(201688769, 'Armando Reyes', 'armandoreyes@alumno.buap.com', 'password'),
(201699116, 'Yaneth Salas', 'yanethsalas@alumno.buap.com', 'password'),
(201757006, 'Georgina Avilez', 'georginaavilez@alumno.buap.com', 'password'),
(201765718, 'Juan Perez', 'juanperez@alumno.buap.com', 'password'),
(201768564, 'Samuel Enid', 'samuelenid@alumno.buap.com', 'password'),
(201777899, 'Patricia Silva', 'patriciasilva@alumno.buap.com', 'password'),
(201787987, 'Karla Cholula', 'karlacholula@alumno.buap.com', 'password'),
(201822344, 'Yareli Alvarez', 'yarelialvarez@alumno.buap.com', 'password'),
(201857641, 'Fernanda Almanza', 'fernandaalmanza@alumno.buap.com', 'password'),
(201875646, 'Sixto Dominguez', 'sixtodiminguez@alumno.buap.com', 'password'),
(201891819, 'Fernando Zarate', 'fernandozarate@alumno.buap.com', 'password'),
(201895909, 'Miguel Chavez', 'miguelchavez@alumno.buap.com', 'password'),
(201909096, 'Fernanda Raigada', 'fernandaraigada@alumno.buap.com', 'password'),
(201985571, 'Fátima Rosario', 'fatimarosario@alumno.buap.com', 'password'),
(205784657, 'Patricia Alcantara', 'patriciaalcantara@alumno.buap.com', 'password'),
(2012789191, 'María Alvarez', 'mariaalvarez@alumno.buap.com', 'password'),
(2017678955, 'Janeth Rubio', 'janethrubio@alumno.buap.com', 'password');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `year` int(4) NOT NULL,
  `idPeriodo` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL,
  `idEstadoCurso` int(11) NOT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `fk_Curso_Profesor_idx` (`idProfesor`),
  KEY `fk_Curso_Periodo1_idx` (`idPeriodo`),
  KEY `fk_Curso_EstadoCurso1_idx` (`idEstadoCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `nombre`, `year`, `idPeriodo`, `idProfesor`, `idEstadoCurso`) VALUES
(6969, 'Inteligencia de Negocios', 2020, 2, 5, 1),
(12345, 'Programación Orientada a Objetos II', 2020, 1, 1, 1),
(12346, 'Procesamiento Digital de Img', 2020, 1, 1, 1),
(51412, 'Intro a la Programación', 2019, 2, 5, 2),
(55511, 'Adm de Redes', 2019, 3, 5, 2),
(59959, 'Logística', 2019, 2, 4, 2),
(72612, 'Intro a las Matemáticas', 2019, 3, 4, 2),
(85783, 'Inteligencia Artificial', 2020, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_alumno`
--

DROP TABLE IF EXISTS `curso_alumno`;
CREATE TABLE IF NOT EXISTS `curso_alumno` (
  `idCurso` int(6) NOT NULL,
  `matricula` int(9) NOT NULL,
  KEY `fk_Curso_has_Alumno_Alumno1_idx` (`matricula`),
  KEY `fk_Curso_has_Alumno_Curso1_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso_alumno`
--

INSERT INTO `curso_alumno` (`idCurso`, `matricula`) VALUES
(55511, 201688769),
(55511, 201347869),
(55511, 201569541),
(55511, 201569541),
(55511, 201688769),
(55511, 201671084),
(55511, 205784657),
(55511, 201313123),
(55511, 201671581),
(55511, 20168548),
(55511, 20168548),
(55511, 201591087),
(55511, 201611223),
(55511, 201564611),
(55511, 201300098),
(55511, 201616000),
(55511, 201857641),
(55511, 201909096),
(55511, 201891819),
(55511, 201985571),
(55511, 201757006),
(55511, 201585812),
(55511, 2017678955),
(55511, 201671084),
(55511, 201588776),
(85783, 201688769),
(85783, 201585812),
(85783, 2012789191),
(85783, 201558581),
(85783, 201687765),
(85783, 20168548),
(85783, 201300098),
(85783, 201588776),
(85783, 2017678955),
(85783, 201757006),
(85783, 201671084),
(85783, 201909096),
(85783, 201414324),
(85783, 201895909),
(85783, 201777899),
(85783, 201347869),
(85783, 201300098),
(85783, 201564611),
(85783, 201909096),
(85783, 201586819),
(85783, 2017678955),
(6969, 2017678955),
(6969, 2012789191),
(6969, 205784657),
(6969, 201985571),
(6969, 201909096),
(6969, 201895909),
(6969, 201875646),
(6969, 201857641),
(6969, 201822344),
(6969, 201787987),
(6969, 201777899),
(6969, 201768564),
(6969, 201671581),
(6969, 201765718),
(6969, 201699116),
(6969, 201687765),
(6969, 20158868),
(6969, 201677003),
(6969, 201558581),
(6969, 201565432),
(6969, 201488885),
(6969, 201476581),
(6969, 201414675),
(6969, 201414324),
(6969, 201347869),
(6969, 201569541),
(6969, 201591087),
(72612, 201611223),
(72612, 201857641),
(72612, 201757006),
(72612, 201985571),
(72612, 2017678955),
(72612, 20159969),
(72612, 201564611),
(72612, 20168548),
(72612, 201985571),
(72612, 201757006),
(72612, 201558581),
(72612, 2017678955),
(72612, 201822344),
(72612, 20158868),
(72612, 201895909),
(72612, 2012789191),
(72612, 201787987),
(72612, 201476581),
(72612, 201677651),
(72612, 201525487),
(72612, 201414675),
(72612, 201765718),
(72612, 201300098),
(72612, 20165671),
(72612, 201777899),
(72612, 201671581),
(72612, 201875646),
(72612, 201611223),
(72612, 201591087),
(72612, 201300098),
(72612, 201857641),
(72612, 201565432),
(72612, 201757006),
(72612, 201300098),
(72612, 201757006),
(59959, 201688769),
(59959, 201347869),
(59959, 201569541),
(59959, 201671581),
(59959, 20168548),
(59959, 20158868),
(59959, 201677003),
(59959, 201564611),
(59959, 201300098),
(59959, 201616000),
(12346, 201857641),
(12346, 201909096),
(12346, 201891819),
(12346, 201985571),
(12346, 201757006),
(12346, 201585812),
(12346, 201671084),
(12346, 201765718),
(12346, 20159969);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

DROP TABLE IF EXISTS `equipo`;
CREATE TABLE IF NOT EXISTS `equipo` (
  `idEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `idCurso` int(6) NOT NULL,
  PRIMARY KEY (`idEquipo`),
  KEY `fk_Equipo_Curso1_idx` (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idEquipo`, `nombre`, `idCurso`) VALUES
(1, 'equipo 1 admRedes', 55511),
(2, 'equipo 2 admRedes', 55511),
(3, 'equipo 3 admRedes', 55511),
(4, 'equipo 1 IA', 85783),
(5, 'equipo 2 IA', 85783),
(6, 'eq 1 IN', 6969),
(7, 'eq 2 IN', 6969),
(8, 'eq 3 IN', 6969),
(9, 'e1 IMat', 72612),
(10, 'e2 IMat', 72612),
(11, 'team 1 Log', 59959),
(12, 'team 2 Log', 59959),
(13, 'e1 PDI', 12346),
(14, 'e2 PDI', 12346),
(15, 'poo2 1', 12345),
(16, 'poo2 2', 12345),
(17, 'poo2 3', 12345);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_integrante`
--

DROP TABLE IF EXISTS `equipo_integrante`;
CREATE TABLE IF NOT EXISTS `equipo_integrante` (
  `idEquipo` int(11) NOT NULL,
  `matricula` int(9) NOT NULL,
  KEY `fk_Equipo_has_Alumno_Alumno1_idx` (`matricula`),
  KEY `fk_Equipo_has_Alumno_Equipo1_idx` (`idEquipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo_integrante`
--

INSERT INTO `equipo_integrante` (`idEquipo`, `matricula`) VALUES
(9, 201611223),
(9, 201857641),
(9, 201757006),
(10, 201985571),
(10, 2017678955),
(13, 201857641),
(13, 201909096),
(13, 201891819),
(14, 201985571),
(14, 201757006),
(6, 2017678955),
(6, 201671084),
(6, 2012789191),
(7, 205784657),
(7, 201985571),
(7, 201909096),
(8, 201895909),
(8, 20158868),
(8, 201677003),
(4, 201688769),
(4, 201585812),
(4, 2012789191),
(5, 201558581),
(5, 201687765);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocurso`
--

DROP TABLE IF EXISTS `estadocurso`;
CREATE TABLE IF NOT EXISTS `estadocurso` (
  `idEstadoCurso` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idEstadoCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadocurso`
--

INSERT INTO `estadocurso` (`idEstadoCurso`, `estado`) VALUES
(1, 'Activo'),
(2, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipo` int(11) NOT NULL,
  `matricula` int(9) NOT NULL,
  `matricula_evaluador` int(9) NOT NULL,
  PRIMARY KEY (`idEvaluacion`),
  KEY `fk_Evaluacion_Alumno1_idx` (`matricula`),
  KEY `fk_Evaluacion_Equipo1_idx` (`idEquipo`),
  KEY `fk_Evaluacion_Alumno2_idx` (`matricula_evaluador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilitar_evaluacion`
--

DROP TABLE IF EXISTS `habilitar_evaluacion`;
CREATE TABLE IF NOT EXISTS `habilitar_evaluacion` (
  `en_evaluacion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `idPeriodo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idPeriodo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`idPeriodo`, `nombre`) VALUES
(1, 'Primavera'),
(2, 'Verano'),
(3, 'Otoño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `idProfesor` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`idProfesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `correo`, `password`) VALUES
(1, 'judithperez@buap.com', 'pass'),
(2, 'josuelucero@buap.com', 'pass'),
(3, 'hildacastillozacatelco@buap.mx', 'pass'),
(4, 'albertoroman@buap.com', 'pass'),
(5, 'alfonsoesparza@buap.com', 'pass');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

DROP TABLE IF EXISTS `rubro`;
CREATE TABLE IF NOT EXISTS `rubro` (
  `idRubro` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `calificacion` int(11) NOT NULL,
  PRIMARY KEY (`idRubro`),
  KEY `fk_Rubro_Evaluacion1_idx` (`idEvaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_Curso_EstadoCurso1` FOREIGN KEY (`idEstadoCurso`) REFERENCES `estadocurso` (`idEstadoCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_Periodo1` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`idPeriodo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_Profesor` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD CONSTRAINT `fk_Curso_has_Alumno_Alumno1` FOREIGN KEY (`matricula`) REFERENCES `alumno` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Curso_has_Alumno_Curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_Equipo_Curso1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo_integrante`
--
ALTER TABLE `equipo_integrante`
  ADD CONSTRAINT `fk_Equipo_has_Alumno_Alumno1` FOREIGN KEY (`matricula`) REFERENCES `alumno` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Equipo_has_Alumno_Equipo1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_Evaluacion_Alumno1` FOREIGN KEY (`matricula`) REFERENCES `alumno` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evaluacion_Alumno2` FOREIGN KEY (`matricula_evaluador`) REFERENCES `alumno` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evaluacion_Equipo1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rubro`
--
ALTER TABLE `rubro`
  ADD CONSTRAINT `fk_Rubro_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
