-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2024 a las 06:36:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutritrack3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `ci_paciente` varchar(10) NOT NULL,
  `actividad` varchar(120) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `ci_paciente`, `actividad`, `descripcion`, `fecha`) VALUES
(41, '2200576532', 'Caminata', 'Realiza una caminata vigorosa durante 30-45 minutos por la mañana. Esta actividad es ideal para despertar tu cuerpo, mejorar la circulación sanguínea y proporcionar un impulso de energía para comenzar el día.\r\n\r\nEntrenamiento de intervalos de alta intensidad (HIIT):\r\nDescripción: Realiza una serie de ejercicios de alta intensidad, como sprints, saltos de cuerda, burpees y sentadillas, alternando con períodos cortos de descanso. El HIIT es eficaz para quemar calorías, mejorar la resistencia cardiovascular y aumentar el metabolismo.', '2024-02-08'),
(42, '2200576532', 'Yoga relajante', 'Practica una sesión de yoga suave y relajante, centrada en estiramientos, respiración profunda y relajación. El yoga ayuda a reducir el estrés, mejorar la flexibilidad y promover el bienestar mental y emocional.\r\n\r\nEntrenamiento de fuerza con pesas:\r\nDescripción: Realiza ejercicios de fuerza con pesas, como levantamiento de pesas, flexiones, dominadas y prensas de hombros. El entrenamiento de fuerza ayuda a aumentar la masa muscular, mejorar la densidad ósea y fortalecer el cuerpo en general.\r\n', '2024-02-01'),
(43, '2200576532', 'Clase de baile aeróbico', 'Descripción: Únete a una clase de baile aeróbico que combine movimientos de baile con ejercicios cardiovasculares. Esta actividad es divertida, estimulante y efectiva para mejorar la coordinación, quemar calorías y fortalecer el corazón.', '2024-01-24'),
(44, '0601826035', 'Caminata', 'correr 1kn', '2024-02-08');

--
-- Disparadores `actividad`
--
DELIMITER $$
CREATE TRIGGER `before_insert_actividad_c_num_a` BEFORE INSERT ON `actividad` FOR EACH ROW BEGIN
    DECLARE num_actividades INTEGER;

    -- Verificar si el paciente ya tiene una actividad en la misma fecha
    SELECT COUNT(*) INTO num_actividades
    FROM actividad
    WHERE ci_paciente = NEW.ci_paciente AND DATE(fecha) = DATE(NEW.fecha);

    -- Si el paciente ya tiene una actividad en la misma fecha, cancelar la inserción
    IF num_actividades > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede programar otra actividad para el mismo paciente en la misma fecha.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `ci_paciente` varchar(10) DEFAULT NULL,
  `ci_nutriologa` varchar(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  `horas_disponibles` varchar(255) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `ci_paciente`, `ci_nutriologa`, `fecha`, `horas_disponibles`, `estado`) VALUES
(199, '2200576532', '0603240334', '2024-02-08', '10:00:00 - 11:00:00', 'Reservado'),
(200, '2200576532', '0603240334', '2024-02-09', '08:00:00 - 09:00:00', 'Reservado'),
(201, '0601826035', '0603240334', '2024-02-08', '08:00:00 - 09:00:00', 'Asistido'),
(202, '0601826035', '0603240334', '2024-02-09', '12:00:00 - 13:00:00', 'Reservado');

--
-- Disparadores `cita`
--
DELIMITER $$
CREATE TRIGGER `before_insert_cita` BEFORE INSERT ON `cita` FOR EACH ROW BEGIN
    DECLARE fecha_existente DATE;
    DECLARE hora_existente VARCHAR(255);

    -- Extraer la fecha y las horas_disponibles del nuevo registro
    SET fecha_existente = NEW.fecha;
    SET hora_existente = NEW.horas_disponibles;

    -- Verificar si ya existe una cita con la misma fecha y horas_disponibles
    IF EXISTS (
        SELECT 1
        FROM cita
        WHERE fecha = fecha_existente
        AND horas_disponibles = hora_existente
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una cita con el horario seleccionado, por favor seleccione otro horario.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_cita_controlarnum_citas_porP` BEFORE INSERT ON `cita` FOR EACH ROW BEGIN
    DECLARE num_citas INTEGER;

    -- Verificar si el paciente ya tiene una cita en la misma fecha
    SELECT COUNT(*) INTO num_citas
    FROM cita
    WHERE ci_paciente = NEW.ci_paciente AND DATE(fecha) = DATE(NEW.fecha);

    -- Si el paciente ya tiene una cita en la misma fecha, cancelar la inserción
    IF num_citas > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No puede agendar dos citas para el mismo día';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_cita` BEFORE UPDATE ON `cita` FOR EACH ROW BEGIN
    DECLARE fecha_existente DATE;
    DECLARE hora_existente VARCHAR(255);

    -- Extraer la fecha y las horas_disponibles del registro actualizado
    SET fecha_existente = NEW.fecha;
    SET hora_existente = NEW.horas_disponibles;

    -- Verificar si ya existe una cita con la misma fecha y horas_disponibles
    IF EXISTS (
        SELECT 1
        FROM cita
        WHERE fecha = fecha_existente
        AND horas_disponibles = hora_existente
        AND id_cita <> NEW.id_cita  -- Excluir el registro actualizado de la comparación
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una cita con el mismo horario, seleccione otro horario';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE `comida` (
  `id_comida` int(11) NOT NULL,
  `comida` varchar(30) DEFAULT NULL,
  `id_tipo_comida` int(11) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `cantidad_proteina` smallint(6) DEFAULT NULL CHECK (`cantidad_proteina` > 0),
  `cantidad_carbohidratos` smallint(6) DEFAULT NULL CHECK (`cantidad_carbohidratos` > 0),
  `cantidad_grasas_saludables` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`id_comida`, `comida`, `id_tipo_comida`, `descripcion`, `cantidad_proteina`, `cantidad_carbohidratos`, `cantidad_grasas_saludables`) VALUES
(10, 'Avena con frutas frescas', 1, 'Prepara avena cocida y añade trozos de frutas frescas como plátanos, fresas y arándanos. Puedes endulzar con miel o agregar un toque de canela para más sabor.', 5, 4, 10),
(11, 'Tortilla de espinacas y queso', 1, 'Haz una tortilla con espinacas frescas y queso rallado. Añade un poco de sal y pimienta al gusto. Sirve con una rebanada de pan integral.', 12, 11, 11),
(12, 'Ensalada César con pollo ', 2, 'Mezcla lechuga romana, trozos de pollo a la parrilla, crutones y aderezo César. Puedes agregar parmesano rallado por encima.', 5, 12, 3),
(13, 'Sándwich de pavo y aguacate', 2, 'Rellena pan integral con rebanadas de pavo, aguacate, tomate y hojas de lechuga. Acompaña con palitos de zanahoria y hummus.', 111, 122, 112),
(14, 'Salmón al horno con espárragos', 3, 'Hornea filetes de salmón con espárragos y patatas cortadas en trozos. Aliña con aceite de oliva, limón, ajo picado y hierbas frescas.', 12, 111, 12),
(16, 'Pechuga de pollo rellena de es', 3, 'Rellena pechugas de pollo con espinacas frescas y queso mozzarella. Hornea hasta que el pollo esté cocido y el queso se haya derretido', 112, 111, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `ci_nutriologa` varchar(10) NOT NULL,
  `hora_inicio_manana` time DEFAULT NULL,
  `hora_fin_manana` time DEFAULT NULL,
  `hora_inicio_tarde` time DEFAULT NULL,
  `hora_fin_tarde` time DEFAULT NULL,
  `dias_semana` varchar(250) DEFAULT NULL,
  `duracion_cita` time DEFAULT NULL,
  `horas_laborales` time DEFAULT NULL,
  `dias_Feriados` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `ci_nutriologa`, `hora_inicio_manana`, `hora_fin_manana`, `hora_inicio_tarde`, `hora_fin_tarde`, `dias_semana`, `duracion_cita`, `horas_laborales`, `dias_Feriados`) VALUES
(6, '0603240334', '08:00:00', '13:00:00', '15:00:00', '18:00:00', 'Lunes,Martes,Miércoles,Jueves,Viernes', '01:00:00', '08:00:00', '2024-02-12, 2024-02-13, 2024-03-12, 2024-03-10, 2024-03-22, 2024-03-21');

--
-- Disparadores `configuracion`
--
DELIMITER $$
CREATE TRIGGER `before_insert_configuracion` BEFORE INSERT ON `configuracion` FOR EACH ROW BEGIN
    SET NEW.horas_laborales = TIMEDIFF(NEW.hora_fin_manana, NEW.hora_inicio_manana) + TIMEDIFF(NEW.hora_fin_tarde, NEW.hora_inicio_tarde);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_configuracion` BEFORE UPDATE ON `configuracion` FOR EACH ROW BEGIN
    SET NEW.horas_laborales = TIMEDIFF(NEW.hora_fin_manana, NEW.hora_inicio_manana) + TIMEDIFF(NEW.hora_fin_tarde, NEW.hora_inicio_tarde);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `controloar_configuracion` BEFORE INSERT ON `configuracion` FOR EACH ROW BEGIN
    DECLARE num_registros INT;

    -- Contar el número de registros existentes
    SELECT COUNT(*) INTO num_registros FROM configuracion;

    -- Si ya hay un registro, lanzar una excepción
    IF num_registros > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe un registro en la tabla configuracion';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validar_horas` BEFORE UPDATE ON `configuracion` FOR EACH ROW BEGIN
    IF NEW.hora_fin_manana < NEW.hora_inicio_manana THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: La hora_fin_manana no puede ser menor que la hora_inicio_manana.';
    END IF;

    IF NEW.hora_inicio_tarde < NEW.hora_fin_manana THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: La hora_inicio_tarde no puede ser menor que la hora_fin_manana.';
    END IF;

    IF NEW.hora_fin_tarde < NEW.hora_inicio_tarde THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: La hora_fin_tarde no puede ser menor que la hora_inicio_tarde.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comida`
--

CREATE TABLE `detalle_comida` (
  `id_comida` int(11) NOT NULL,
  `id_plan_nutricional` int(11) NOT NULL,
  `dia` varchar(30) NOT NULL CHECK (ucase(`dia`) in ('LUNES','MARTES','MIÉRCOLES','JUEVES','VIERNES','SÁBADO','DOMINGO'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_comida`
--

INSERT INTO `detalle_comida` (`id_comida`, `id_plan_nutricional`, `dia`) VALUES
(10, 14, 'DOMINGO'),
(10, 14, 'JUEVES'),
(10, 14, 'LUNES'),
(10, 14, 'MARTES'),
(10, 14, 'MIÉRCOLES'),
(10, 14, 'SÁBADO'),
(10, 14, 'VIERNES'),
(13, 14, 'DOMINGO'),
(13, 14, 'JUEVES'),
(13, 14, 'LUNES'),
(13, 14, 'MARTES'),
(13, 14, 'MIÉRCOLES'),
(13, 14, 'SÁBADO'),
(13, 14, 'VIERNES'),
(14, 14, 'DOMINGO'),
(14, 14, 'JUEVES'),
(14, 14, 'LUNES'),
(14, 14, 'MARTES'),
(14, 14, 'MIÉRCOLES'),
(14, 14, 'SÁBADO'),
(14, 14, 'VIERNES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico`
--

CREATE TABLE `historial_clinico` (
  `id_historial_clinico` int(11) NOT NULL,
  `ci_paciente` varchar(10) NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `porcentajeGrasa` decimal(5,2) DEFAULT NULL,
  `talla` int(11) DEFAULT NULL,
  `ocupacion` varchar(255) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `neuro` enum('si','no','noSabe') DEFAULT NULL,
  `hemoglobina` enum('si','no','noSabe') DEFAULT NULL,
  `gastro` enum('si','no','noSabe') DEFAULT NULL,
  `respiratorias` enum('si','no','noSabe') DEFAULT NULL,
  `cronicas` enum('si','no','noSabe') DEFAULT NULL,
  `endocrinos` enum('si','no','noSabe') DEFAULT NULL,
  `cirugias` enum('si','no','noSabe') DEFAULT NULL,
  `alergias` enum('si','no','noSabe') DEFAULT NULL,
  `hipertension` enum('si','no','noSabe') DEFAULT NULL,
  `motivoConsulta` varchar(255) DEFAULT NULL,
  `discapacidad` enum('si','no') DEFAULT NULL,
  `tipoDiscapacidad` varchar(255) DEFAULT NULL,
  `entrenamiento` enum('si','no') DEFAULT NULL,
  `tiempoEntrenamiento` varchar(10) DEFAULT NULL,
  `alcohol` enum('si','no') DEFAULT NULL,
  `cafe` enum('si','no') DEFAULT NULL,
  `medicamentosHabituales` enum('si','no') DEFAULT NULL,
  `observacionesSalud` text DEFAULT NULL,
  `observacionesGenerales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_clinico`
--

INSERT INTO `historial_clinico` (`id_historial_clinico`, `ci_paciente`, `fecha_creacion`, `fechaNacimiento`, `peso`, `porcentajeGrasa`, `talla`, `ocupacion`, `celular`, `direccion`, `neuro`, `hemoglobina`, `gastro`, `respiratorias`, `cronicas`, `endocrinos`, `cirugias`, `alergias`, `hipertension`, `motivoConsulta`, `discapacidad`, `tipoDiscapacidad`, `entrenamiento`, `tiempoEntrenamiento`, `alcohol`, `cafe`, `medicamentosHabituales`, `observacionesSalud`, `observacionesGenerales`) VALUES
(19, '2200576532', '2024-02-08', '0000-00-00', 0.00, 0.00, 0, 'Profesor', '0980044910', 'Pinar', 'no', 'no', 'no', 'noSabe', 'noSabe', 'no', 'no', 'no', 'no', 'perdida_peso', 'no', 'ninguna', 'no', '30-40', 'no', 'no', 'no', 'Vitaminas', 'ninguna'),
(21, '0605731298', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '0605753375', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '1400166078', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '0601826035', '2024-02-08', '0000-00-00', 0.00, 0.00, 0, 'Profesor', '0980044910', 'Pinar', 'si', 'no', 'no', 'no', 'noSabe', 'no', 'no', 'noSabe', 'noSabe', 'perdida_peso', 'no', 'ninguna', 'si', '20-25', 'no', 'no', 'no', 'Vitaminas', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medidas`
--

CREATE TABLE `historial_medidas` (
  `id_historial_medidas` int(11) NOT NULL,
  `id_historial_clinico` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL CHECK (`peso` > 0 and `peso` < 10000),
  `estatura` int(11) DEFAULT NULL CHECK (`estatura` > 0 and `estatura` < 250),
  `presion_arterial_sistolica` int(11) DEFAULT NULL CHECK (`presion_arterial_sistolica` > 0 and `presion_arterial_sistolica` < 300),
  `presion_arterial_diastolica` int(11) DEFAULT NULL CHECK (`presion_arterial_diastolica` > 0 and `presion_arterial_diastolica` < 200),
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_medidas`
--

INSERT INTO `historial_medidas` (`id_historial_medidas`, `id_historial_clinico`, `peso`, `estatura`, `presion_arterial_sistolica`, `presion_arterial_diastolica`, `fecha`) VALUES
(41, 19, 56, 167, 111, 111, '2024-02-08'),
(42, 19, 65, 170, 111, 111, '2024-02-01'),
(43, 19, 60, 170, 111, 111, '2024-01-28'),
(44, 19, 62, 170, 120, 111, '2024-01-24');

--
-- Disparadores `historial_medidas`
--
DELIMITER $$
CREATE TRIGGER `before_insert_historial_medidas` BEFORE INSERT ON `historial_medidas` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1
        FROM historial_medidas
        WHERE id_historial_clinico = NEW.id_historial_clinico
        AND fecha = NEW.fecha
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede insertar. El id_historial_clinico ya tiene una entrada para esta fecha.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_suscripcion`
--

CREATE TABLE `historial_suscripcion` (
  `id_suscripcion` int(11) NOT NULL,
  `ci_paciente` varchar(10) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL CHECK (ucase(`estado`) in ('SUSCRITO','SIN SUSCRIPCIÓN')),
  `suscripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_suscripcion`
--

INSERT INTO `historial_suscripcion` (`id_suscripcion`, `ci_paciente`, `fecha_inicio`, `fecha_fin`, `estado`, `suscripcion`) VALUES
(1, '0605731298', NULL, NULL, 'SIN SUSCRIPCIÓN', 'POR DEFECTO'),
(1, '0605753375', NULL, NULL, 'SIN SUSCRIPCIÓN', 'POR DEFECTO'),
(1, '1400166078', NULL, NULL, 'SIN SUSCRIPCIÓN', 'POR DEFECTO'),
(11, '0601826035', '2024-02-09', '2024-03-10', 'SUSCRITO', 'MENSUAL'),
(11, '2200576532', '2024-02-08', '2024-03-09', 'SUSCRITO', 'MENSUAL');

--
-- Disparadores `historial_suscripcion`
--
DELIMITER $$
CREATE TRIGGER `before_insert_historial_suscripcion` BEFORE INSERT ON `historial_suscripcion` FOR EACH ROW BEGIN
    DECLARE v_suscripcion_nombre VARCHAR(255);

    -- Obtener el nombre de la suscripcion correspondiente
    SELECT suscripcion INTO v_suscripcion_nombre
    FROM suscripcion
    WHERE id_suscripcion = NEW.id_suscripcion;

    -- Actualizar el campo suscripcion en la fila que se va a insertar en la tabla historial_suscripcion
    SET NEW.suscripcion = v_suscripcion_nombre;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_historial_suscripcion` BEFORE UPDATE ON `historial_suscripcion` FOR EACH ROW BEGIN
    DECLARE v_suscripcion_nombre VARCHAR(255);

    -- Obtener el nombre de la suscripcion correspondiente
    SELECT suscripcion INTO v_suscripcion_nombre
    FROM suscripcion
    WHERE id_suscripcion = NEW.id_suscripcion;

    -- Actualizar el campo suscripcion en la fila que se va a actualizar en la tabla historial_suscripcion
    SET NEW.suscripcion = v_suscripcion_nombre;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `copiar_paciente` BEFORE INSERT ON `historial_suscripcion` FOR EACH ROW BEGIN
    DECLARE user_role varchar(255);

    -- Obtener el rol del usuario que está realizando la inserción
    SELECT rol INTO user_role FROM rol WHERE id_rol = (SELECT id_rol FROM usuario WHERE ci_usuario = NEW.ci_paciente);

    -- Verificar el rol antes de insertar en paciente
    IF user_role != 'PACIENTE' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Solo los usuarios con rol "PACIENTE" pueden ser insertados en la tabla paciente';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos_inicio`
--

CREATE TABLE `intentos_inicio` (
  `id_intentos` int(1) NOT NULL,
  `intentos` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intentos_inicio`
--

INSERT INTO `intentos_inicio` (`id_intentos`, `intentos`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutriologa`
--

CREATE TABLE `nutriologa` (
  `ci_nutriologa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nutriologa`
--

INSERT INTO `nutriologa` (`ci_nutriologa`) VALUES
('0603240334');

--
-- Disparadores `nutriologa`
--
DELIMITER $$
CREATE TRIGGER `before_insert_nutriologa` BEFORE INSERT ON `nutriologa` FOR EACH ROW BEGIN
    DECLARE user_role varchar(255);

    -- Obtener el rol del usuario que está realizando la inserción
    SELECT rol INTO user_role FROM rol WHERE id_rol = (SELECT id_rol FROM usuario WHERE ci_usuario = NEW.ci_nutriologa);

    -- Verificar el rol antes de insertar en nutriologa
    IF user_role != 'NUTRIOLOGA' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Solo los usuarios con rol "NUTRIOLOGA" pueden ser insertados en la tabla nutriologa';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `ci_paciente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`ci_paciente`) VALUES
('0601826035'),
('0605731298'),
('0605753375'),
('1400166078'),
('2200576532');

--
-- Disparadores `paciente`
--
DELIMITER $$
CREATE TRIGGER `before_insert_paciente` BEFORE INSERT ON `paciente` FOR EACH ROW BEGIN
    DECLARE user_role varchar(255);

    -- Obtener el rol del usuario que está realizando la inserción
    SELECT rol INTO user_role FROM rol WHERE id_rol = (SELECT id_rol FROM usuario WHERE ci_usuario = NEW.ci_paciente);

    -- Verificar el rol antes de insertar en paciente
    IF user_role != 'PACIENTE' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Solo los usuarios con rol "PACIENTE" pueden ser insertados en la tabla paciente';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_nutricional`
--

CREATE TABLE `plan_nutricional` (
  `id_plan_nutricional` int(11) NOT NULL,
  `ci_nutriologa` varchar(10) DEFAULT NULL,
  `ci_paciente` varchar(10) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `duracion_dias` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_nutricional`
--

INSERT INTO `plan_nutricional` (`id_plan_nutricional`, `ci_nutriologa`, `ci_paciente`, `fecha_inicio`, `fecha_fin`, `duracion_dias`) VALUES
(14, '0603240334', '2200576532', '2024-02-08', '2024-02-14', 7);

--
-- Disparadores `plan_nutricional`
--
DELIMITER $$
CREATE TRIGGER `before_insert_plan_nutricional` BEFORE INSERT ON `plan_nutricional` FOR EACH ROW BEGIN
    DECLARE plan_count INT;

    -- Verificar si ya existe un plan nutricional para el paciente en el intervalo
    SELECT COUNT(*)
    INTO plan_count
    FROM plan_nutricional
    WHERE ci_paciente = NEW.ci_paciente
    AND (NEW.fecha_inicio BETWEEN fecha_inicio AND fecha_fin OR NEW.fecha_fin BETWEEN fecha_inicio AND fecha_fin);

    -- Si hay al menos un plan existente, emitir un mensaje y abortar la inserción
    IF plan_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe un plan nutricional para el paciente en el intervalo de tiempo especificado';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(10) NOT NULL CHECK (ucase(`rol`) in ('PACIENTE','NUTRIOLOGA')),
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `descripcion`) VALUES
(1, 'Paciente', 'Rol para usuarios que son pacientes'),
(2, 'Nutriologa', 'Rol para usuarios que son nutriólogas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id_suscripcion` int(11) NOT NULL,
  `duracion_dias` int(11) DEFAULT NULL CHECK (`duracion_dias` >= 0),
  `suscripcion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suscripcion`
--

INSERT INTO `suscripcion` (`id_suscripcion`, `duracion_dias`, `suscripcion`) VALUES
(1, 0, 'POR DEFECTO'),
(11, 30, 'MENSUAL'),
(12, 90, 'TRIMESTRAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comida`
--

CREATE TABLE `tipo_comida` (
  `id_tipo_comida` int(11) NOT NULL,
  `tipo_comida` varchar(15) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_comida`
--

INSERT INTO `tipo_comida` (`id_tipo_comida`, `tipo_comida`, `descripcion`) VALUES
(1, 'Desayuno', 'Primera comida del día'),
(2, 'Almuerzo', 'Comida principal del día'),
(3, 'Cena', 'Última comida del día');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ci_usuario` varchar(10) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `edad` smallint(6) DEFAULT NULL CHECK (`edad` > 0 and `edad` < 130),
  `correo` varchar(60) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `sexo` varchar(9) NOT NULL CHECK (ucase(`sexo`) in ('FEMENINO','MASCULINO','OTRO')),
  `foto` varchar(255) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  `intentos` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ci_usuario`, `id_rol`, `nombres`, `apellidos`, `edad`, `correo`, `clave`, `sexo`, `foto`, `hash`, `activo`, `intentos`) VALUES
('0601826035', 1, 'FRANCISCO', 'PEREZ', 23, 'luisisraelopez25@gmail.com', 'lp+Wnw==', 'MASCULINO', '1707415579_9439685.jpg', '9908279ebbf1f9b250ba689db6a0222b', 1, 3),
('0603240334', 2, 'LISSE ALEJANDRA', 'LOMAS ROMERO', 26, 'nutritrack02@gmail.com', 'lp+Wnw==', 'FEMENINO', '1709710291_sin_titulo.png', 'e44fea3bec53bcea3b7513ccef5857ac', 1, 3),
('0605731298', 1, 'FERNANDA DEYANEIRA', 'MORENO OVIEDO', 23, 'ferdeya00@gmail.com', 'lp+Wnw==', 'FEMENINO', '1707382020_27470359_7309667.jpg', '2bcab9d935d219641434683dd9d18a03', 1, 3),
('0605753375', 1, 'ERIKA', 'OCAÑA', 23, 'evillavicencio651@gmail.com', 'lp+Wnw==', 'FEMENINO', '1707382132_9434650.jpg', '63923f49e5241343aa7acb6a06a751e7', 1, 3),
('1400166078', 1, 'ANA', 'MORENO', 19, 'fernandamorenosmj@gmail.com', 'lp+Wnw==', 'FEMENINO', '1707407901_9434650.jpg', '158f3069a435b314a80bdcb024f8e422', 1, 3),
('2200576532', 1, 'LUIS ISRAEL', 'LOPEZ PINARGOTE', 23, 'luisisrael.500@gmail.com', 'lp+Wnw==', 'MASCULINO', '1708574165_foto.jpg', '9778d5d219c5080b9a6a17bef029331c', 1, 3);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `before_insert_usuario` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
    DECLARE cedula_valida BOOLEAN;

    -- Validar la cédula antes de insertar
    SET cedula_valida = (
        NEW.ci_usuario REGEXP '^[0-9]{10}$' AND
        CAST(SUBSTRING(NEW.ci_usuario, 1, 2) AS SIGNED) BETWEEN 0 AND 24 AND
        CAST(SUBSTRING(NEW.ci_usuario, 3, 1) AS SIGNED) BETWEEN 0 AND 5
    );

    -- Si la cédula no es válida, lanzar un error
    IF NOT cedula_valida THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La cédula no es válida.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertar_en_historial_clinico` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    -- Verificar si el nuevo usuario tiene el id_rol igual a 1
    IF NEW.id_rol = 1 THEN
        INSERT INTO historial_clinico (
            ci_paciente,
            fecha_creacion,
            fechaNacimiento,
            peso,
            porcentajeGrasa,
            talla,
            ocupacion,
            celular,
            direccion,
            neuro,
            hemoglobina,
            gastro,
            respiratorias,
            cronicas,
            endocrinos,
            cirugias,
            alergias,
            hipertension,
            motivoConsulta,
            discapacidad,
            tipoDiscapacidad,
            entrenamiento,
            tiempoEntrenamiento,
            alcohol,
            cafe,
            medicamentosHabituales,
            observacionesSalud,
            observacionesGenerales
        ) VALUES (
            NEW.ci_usuario,
            null, -- Puedes ajustar este valor según sea necesario
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertar_en_historial_suscripcion` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    -- Verificar si el nuevo usuario tiene el id_rol igual a 1
    IF NEW.id_rol = 1 THEN
        INSERT INTO historial_suscripcion (id_suscripcion,ci_paciente, fecha_inicio, fecha_fin, estado, suscripcion)
        VALUES (1,NEW.ci_usuario, null, null, 'SIN SUSCRIPCIÓN', 'DEFECTO');
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_insertar_usuario` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    DECLARE tipo_rol VARCHAR(10);
    
    -- Obtener el tipo de rol del nuevo usuario
    SELECT rol INTO tipo_rol FROM rol WHERE id_rol = NEW.id_rol;
    
    -- Insertar en la tabla correspondiente según el rol
    IF tipo_rol = 'PACIENTE' THEN
        INSERT INTO paciente (ci_paciente) VALUES (NEW.ci_usuario);
    ELSEIF tipo_rol = 'NUTRIOLOGA' THEN
        INSERT INTO nutriologa (ci_nutriologa) VALUES (NEW.ci_usuario); -- Reemplaza 10 con el valor apropiado
    END IF;
    
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `FK_ACTIVIDAD_PACIENTE` (`ci_paciente`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `FK_CITA_PACIENTE` (`ci_paciente`),
  ADD KEY `FK_CITA_NUTRIOLOGA` (`ci_nutriologa`);

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`id_comida`),
  ADD KEY `FK_TIPO_COMIDA_COMIDA` (`id_tipo_comida`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`),
  ADD KEY `FK_CONFIGURACION_NUTRIOLOGA` (`ci_nutriologa`);

--
-- Indices de la tabla `detalle_comida`
--
ALTER TABLE `detalle_comida`
  ADD PRIMARY KEY (`id_comida`,`id_plan_nutricional`,`dia`),
  ADD KEY `FK_DETALLE_COMIDA_PLAN_NUTRICIONAL` (`id_plan_nutricional`);

--
-- Indices de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD PRIMARY KEY (`id_historial_clinico`),
  ADD UNIQUE KEY `ci_paciente` (`ci_paciente`);

--
-- Indices de la tabla `historial_medidas`
--
ALTER TABLE `historial_medidas`
  ADD PRIMARY KEY (`id_historial_medidas`),
  ADD KEY `FK_HISTORIAL_MEDIDAS_HISTORIAL_CLINICO` (`id_historial_clinico`);

--
-- Indices de la tabla `historial_suscripcion`
--
ALTER TABLE `historial_suscripcion`
  ADD PRIMARY KEY (`id_suscripcion`,`ci_paciente`),
  ADD KEY `FK_HISTORIAL_SUSCRIPCION_PACIENTE` (`ci_paciente`);

--
-- Indices de la tabla `nutriologa`
--
ALTER TABLE `nutriologa`
  ADD PRIMARY KEY (`ci_nutriologa`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ci_paciente`);

--
-- Indices de la tabla `plan_nutricional`
--
ALTER TABLE `plan_nutricional`
  ADD PRIMARY KEY (`id_plan_nutricional`),
  ADD KEY `FK_PLAN_NUTRICIONAL_NUTRIOLOGA` (`ci_nutriologa`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id_suscripcion`);

--
-- Indices de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  ADD PRIMARY KEY (`id_tipo_comida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ci_usuario`),
  ADD KEY `FK_USUARIO_ROL` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT de la tabla `comida`
--
ALTER TABLE `comida`
  MODIFY `id_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  MODIFY `id_historial_clinico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `historial_medidas`
--
ALTER TABLE `historial_medidas`
  MODIFY `id_historial_medidas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `plan_nutricional`
--
ALTER TABLE `plan_nutricional`
  MODIFY `id_plan_nutricional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  MODIFY `id_tipo_comida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `FK_ACTIVIDAD_PACIENTE` FOREIGN KEY (`ci_paciente`) REFERENCES `paciente` (`ci_paciente`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `FK_CITA_NUTRIOLOGA` FOREIGN KEY (`ci_nutriologa`) REFERENCES `nutriologa` (`ci_nutriologa`),
  ADD CONSTRAINT `FK_CITA_PACIENTE` FOREIGN KEY (`ci_paciente`) REFERENCES `paciente` (`ci_paciente`);

--
-- Filtros para la tabla `comida`
--
ALTER TABLE `comida`
  ADD CONSTRAINT `FK_TIPO_COMIDA_COMIDA` FOREIGN KEY (`id_tipo_comida`) REFERENCES `tipo_comida` (`id_tipo_comida`);

--
-- Filtros para la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD CONSTRAINT `FK_CONFIGURACION_NUTRIOLOGA` FOREIGN KEY (`ci_nutriologa`) REFERENCES `nutriologa` (`ci_nutriologa`);

--
-- Filtros para la tabla `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD CONSTRAINT `FK_HISTORIAL_CLINICO_PACIENTE` FOREIGN KEY (`ci_paciente`) REFERENCES `paciente` (`ci_paciente`);

--
-- Filtros para la tabla `historial_medidas`
--
ALTER TABLE `historial_medidas`
  ADD CONSTRAINT `FK_HISTORIAL_MEDIDAS_HISTORIAL_CLINICO` FOREIGN KEY (`id_historial_clinico`) REFERENCES `historial_clinico` (`id_historial_clinico`);

--
-- Filtros para la tabla `historial_suscripcion`
--
ALTER TABLE `historial_suscripcion`
  ADD CONSTRAINT `FK_HISTORIAL_SUSCRIPCION_PACIENTE` FOREIGN KEY (`ci_paciente`) REFERENCES `paciente` (`ci_paciente`),
  ADD CONSTRAINT `FK_HISTORIAL_SUSCRIPCION_SUSCRIPCION` FOREIGN KEY (`id_suscripcion`) REFERENCES `suscripcion` (`id_suscripcion`);

--
-- Filtros para la tabla `nutriologa`
--
ALTER TABLE `nutriologa`
  ADD CONSTRAINT `FK_NUTRIOLOGA_USUARIO` FOREIGN KEY (`ci_nutriologa`) REFERENCES `usuario` (`ci_usuario`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `FK_CI_PACIENTE_USUARIO` FOREIGN KEY (`ci_paciente`) REFERENCES `usuario` (`ci_usuario`);

--
-- Filtros para la tabla `plan_nutricional`
--
ALTER TABLE `plan_nutricional`
  ADD CONSTRAINT `FK_PLAN_NUTRICIONAL_NUTRIOLOGA` FOREIGN KEY (`ci_nutriologa`) REFERENCES `nutriologa` (`ci_nutriologa`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUARIO_ROL` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
