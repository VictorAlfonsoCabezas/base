-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2026 a las 19:04:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sigcrmprod`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `affiliation`
--

CREATE TABLE `affiliation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_affiliation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `percentage` tinyint(1) NOT NULL DEFAULT 0,
  `percentage_coverage` decimal(8,2) DEFAULT NULL,
  `code_intel` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_detail`
--

CREATE TABLE `api_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `api_detail`
--

INSERT INTO `api_detail` (`id`, `company_id`, `api_header_id`, `date_created`, `description`, `column_name`, `alias`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-05-12', NULL, 'name', NULL, 1, '2022-05-12 15:39:48', '2022-05-12 15:39:48'),
(2, 1, 2, '2022-05-12', NULL, 'latitud', NULL, 1, '2022-05-12 20:15:24', '2022-05-12 20:15:24'),
(3, 1, 2, '2022-05-12', NULL, 'longitud', NULL, 1, '2022-05-12 20:15:28', '2022-05-12 20:15:28'),
(4, 1, 3, '2022-05-13', NULL, 'text', NULL, 1, '2022-05-13 15:11:05', '2022-05-13 15:11:05'),
(5, 1, 4, '2022-05-16', NULL, 'id', NULL, 1, '2022-05-16 16:58:49', '2022-05-16 16:58:49'),
(6, 1, 4, '2022-05-16', NULL, 'name', NULL, 1, '2022-05-16 16:58:53', '2022-05-16 16:58:53'),
(7, 1, 5, '2022-05-17', NULL, 'correo', NULL, 1, '2022-05-17 12:00:52', '2022-05-17 12:00:52'),
(8, 1, 6, '2022-05-17', NULL, 'birth_date', NULL, 1, '2022-05-17 12:01:13', '2022-05-17 12:01:13'),
(13, 18, 9, '2022-05-19', NULL, 'ID_SEDE', 'sede', 1, '2022-05-19 10:29:16', '2022-05-19 10:29:16'),
(14, 18, 9, '2022-05-19', NULL, 'NOMBRE', NULL, 1, '2022-05-19 10:29:20', '2022-05-19 10:29:20'),
(15, 18, 10, '2022-05-20', NULL, 'id', 'cargo', 1, '2022-05-20 08:34:05', '2022-05-20 08:34:05'),
(16, 18, 10, '2022-05-20', NULL, 'text', NULL, 1, '2022-05-20 08:34:11', '2022-05-20 08:34:11'),
(17, 18, 11, '2022-05-20', NULL, 'id', 'trabajador', 1, '2022-05-20 09:22:41', '2022-05-20 09:22:41'),
(18, 18, 11, '2022-05-20', NULL, 'text', NULL, 1, '2022-05-20 09:22:45', '2022-05-20 09:22:45'),
(19, 18, 12, '2022-05-20', NULL, 'id', 'horario', 1, '2022-05-20 09:32:38', '2022-05-20 09:32:38'),
(20, 18, 12, '2022-05-20', NULL, 'text', NULL, 1, '2022-05-20 09:32:41', '2022-05-20 09:32:41'),
(22, 18, 13, '2022-05-20', NULL, 'id', 'servicio', 1, '2022-05-20 11:30:15', '2022-05-20 11:30:15'),
(23, 18, 13, '2022-05-20', NULL, 'text', NULL, 1, '2022-05-20 11:30:19', '2022-05-20 11:30:19'),
(24, 18, 14, '2022-09-06', NULL, 'factura_ruc', NULL, 1, '2022-09-06 11:22:01', '2022-09-06 11:22:01'),
(25, 18, 16, '2022-09-06', NULL, 'factura_apellidos', NULL, 1, '2022-09-06 11:23:55', '2022-09-06 11:23:55'),
(26, 18, 17, '2022-09-06', NULL, 'factura_email', NULL, 1, '2022-09-06 11:24:09', '2022-09-06 11:24:09'),
(27, 18, 18, '2022-09-06', NULL, 'factura_direccion', NULL, 1, '2022-09-06 11:24:18', '2022-09-06 11:24:18'),
(28, 18, 19, '2022-09-06', NULL, 'factura_nacimiento', NULL, 1, '2022-09-06 11:24:29', '2022-09-06 11:24:29'),
(29, 18, 20, '2022-09-06', NULL, 'factura_celular', NULL, 1, '2022-09-06 11:33:06', '2022-09-06 11:33:06'),
(30, 18, 15, '2022-09-06', NULL, 'factura_nombres', NULL, 1, '2022-09-06 11:59:47', '2022-09-06 11:59:47'),
(37, 18, 25, '2022-09-20', NULL, 'ID_TRABAJADOR', 'trabajador', 1, '2022-09-20 11:57:57', '2022-09-20 11:57:57'),
(39, 18, 25, '2022-09-20', NULL, 'NOMBRES', NULL, 1, '2022-09-20 11:58:11', '2022-09-20 11:58:11'),
(40, 18, 25, '2022-09-20', NULL, 'APELLIDOS', NULL, 1, '2022-09-20 11:58:13', '2022-09-20 11:58:13'),
(43, 1, 26, '2022-09-28', NULL, 'id', 'address', 1, '2022-09-28 14:45:59', '2022-09-28 14:45:59'),
(44, 1, 26, '2022-09-28', NULL, 'text', 'address', 1, '2022-09-28 14:46:02', '2022-09-28 14:46:02'),
(50, 18, 27, '2022-09-29', NULL, 'id', 'orden', 1, '2022-09-29 14:23:35', '2022-09-29 14:23:35'),
(51, 18, 27, '2022-09-29', NULL, 'text', NULL, 1, '2022-09-29 14:23:39', '2022-09-29 14:23:39'),
(52, 18, 28, '2022-09-29', NULL, 'id', 'link_orden', 1, '2022-09-29 14:24:24', '2022-09-29 14:24:24'),
(53, 18, 28, '2022-09-29', NULL, 'text', NULL, 1, '2022-09-29 14:24:28', '2022-09-29 14:24:28'),
(60, 1, 29, '2022-09-30', NULL, 'id', 'city_id', 1, '2022-09-30 08:08:44', '2022-09-30 08:08:44'),
(61, 1, 29, '2022-09-30', NULL, 'name', NULL, 1, '2022-09-30 08:08:49', '2022-09-30 08:08:49'),
(64, 1, 30, '2022-09-30', NULL, 'id', 'sede_id', 1, '2022-09-30 09:59:20', '2022-09-30 09:59:20'),
(65, 1, 30, '2022-09-30', NULL, 'name', NULL, 1, '2022-09-30 09:59:25', '2022-09-30 09:59:25'),
(70, 18, 32, '2022-10-05', NULL, 'ID_AFILIACION', 'afiliacion', 1, '2022-10-05 18:00:38', '2022-10-05 18:00:38'),
(71, 18, 32, '2022-10-05', NULL, 'NOMBRE', NULL, 1, '2022-10-05 18:00:42', '2022-10-05 18:00:42'),
(73, 18, 31, '2022-10-05', NULL, 'ID_TIPO_AFILIACION', 'ID_TIPO_AFILIACION', 1, '2022-10-05 18:05:19', '2022-10-05 18:05:19'),
(74, 18, 31, '2022-10-05', NULL, 'NOMBRE', 'ID_TIPO_AFILIACION', 1, '2022-10-05 18:05:22', '2022-10-05 18:05:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_header`
--

CREATE TABLE `api_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_api` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 CRM\r\n2 SIGCENTER',
  `tipo_consulta` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_table` tinyint(1) NOT NULL DEFAULT 1,
  `instancia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `api_header`
--

INSERT INTO `api_header` (`id`, `company_id`, `type_api`, `tipo_consulta`, `date_created`, `description`, `table_name`, `api_link`, `need_table`, `instancia`, `token`, `method`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ACTUALIZACION', '2022-05-12', 'Almacenar nombre del Cliente', 'customer', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-12 15:38:47', '2022-05-12 15:38:47'),
(2, 1, 1, 'INSERCION', '2022-05-12', 'CREAR NUEVA DIRECCION EN CLIENTE', 'customer_address', 'https://sigcrm.pro/api/showApiMasterRefreshLocation', 1, NULL, NULL, 'POST', 1, '2022-05-12 20:14:30', '2022-05-12 20:14:30'),
(3, 1, 1, 'ACTUALIZACION', '2022-05-13', 'Actualizar Texto de Ubicacion', 'customer_address', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-13 15:10:21', '2022-05-13 15:10:21'),
(4, 1, 1, 'CONSULTA', '2022-05-16', 'Mostrar todos los Paises', 'country', 'https://sigcrm.pro/api/showApiMaster', 1, NULL, NULL, 'POST', 1, '2022-05-16 16:58:12', '2022-05-16 16:58:12'),
(5, 1, 1, 'ACTUALIZACION', '2022-05-17', 'Guardar Correo Electrónico', 'customer', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:49:03', '2022-05-17 11:49:03'),
(6, 1, 1, 'ACTUALIZACION', '2022-05-17', 'Guardar Fecha de Nacimiento', 'customer', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(9, 18, 2, 'CONSULTA', '2022-05-19', 'MOSTRAR SEDES DE UCIMEDIC', 'sede', '/restful/api-sigcrm/show-api-master-sigcenter', 1, NULL, NULL, 'POST', 1, '2022-05-19 09:36:28', '2022-05-19 09:36:28'),
(10, 18, 2, 'CONSULTA', '2022-05-19', 'MOSTRAR ESPECIALIDADES SEGUN SEDE SELECCIONADA', NULL, '/restful/api-sigcrm/show-especialidad', 0, NULL, NULL, 'POST', 1, '2022-05-19 10:03:20', '2022-05-19 10:03:20'),
(11, 18, 2, 'CONSULTA', '2022-05-20', 'MOSTRAR MEDICOS SEGUN ESPECIALIADES Y SEDES', NULL, '/restful/api-sigcrm/show-doctor', 0, NULL, NULL, 'POST', 1, '2022-05-20 09:22:14', '2022-05-20 09:22:14'),
(12, 18, 2, 'CONSULTA', '2022-05-20', 'MOSTRAR HORARIOS SEGUN MEDICOS, SEGUN ESPECIALIADAD Y SEGUN SEDE', NULL, '/restful/api-sigcrm/show-doctor-schedule', 0, NULL, NULL, 'POST', 1, '2022-05-20 09:32:08', '2022-05-20 09:32:08'),
(13, 18, 2, 'CONSULTA', '2022-05-20', 'PRECIOS DE PROCEDIMIENTO', NULL, '/restful/api-sigcrm/show-service', 0, NULL, NULL, 'POST', 1, '2022-05-20 11:27:54', '2022-05-20 11:27:54'),
(14, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Indentificacion', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(15, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Nombres', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(16, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Apellidos', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(17, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Correo', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(18, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Direccion', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(19, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Fecha Nacimiento', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(20, 18, 1, 'ACTUALIZACION', '2022-05-17', 'Factura Celular', 'chat_bot_header', 'https://sigcrm.pro/api/showApiMasterRefresh', 1, NULL, NULL, 'POST', 1, '2022-05-17 11:50:11', '2022-05-17 11:50:11'),
(25, 18, 2, 'CONSULTA', '2022-09-20', 'test mostrar trabajadores', 'trabajador', '/restful/api-sigcrm/show-api-master-sigcenter', 1, NULL, NULL, 'POST', 1, '2022-09-20 11:57:46', '2022-09-20 11:57:46'),
(26, 1, 1, 'CONSULTA', '2022-09-27', 'Listar ubicaciones del cliente (NEW)', 'customer_address', 'https://sigcrm.pro/api/showApiMaster', 1, NULL, NULL, 'POST', 1, '2022-09-27 18:42:14', '2022-09-27 18:43:22'),
(27, 18, 2, 'CONSULTA', '2022-09-29', 'Listar Ordenes  apartir de la cedula', NULL, '/restful/api-sigcrm/bucar-ordenes-paciente', 0, NULL, NULL, 'POST', 1, '2022-09-29 14:17:03', '2022-09-29 14:17:49'),
(28, 18, 2, 'CONSULTA', '2022-09-29', 'Descargar orden Seleccionada', NULL, '/restful/api-sigcrm/obtener-pdf', 0, NULL, NULL, 'POST', 1, '2022-09-29 14:19:47', '2022-09-29 14:19:47'),
(29, 1, 1, 'CONSULTA', '2022-09-30', 'Listar ciudades disponibles (NEW)', 'city', 'https://sigcrm.pro/api/showApiMaster', 1, NULL, NULL, 'POST', 1, '2022-09-30 07:58:28', '2022-09-30 07:58:53'),
(30, 1, 1, 'CONSULTA', '2022-09-30', 'Listra sede solamente de la CIUDAD seleccionada (NEW)', 'sede', 'https://sigcrm.pro/api/showApiMaster', 1, NULL, NULL, 'POST', 1, '2022-09-30 08:07:48', '2022-09-30 08:08:01'),
(31, 18, 2, 'CONSULTA', '2022-10-05', 'Mostrar Tipo de Afiliación (NEW)', 'tipo_afiliacion', '/restful/api-sigcrm/show-api-master-sigcenter', 1, NULL, NULL, 'POST', 1, '2022-09-30 19:30:35', '2022-10-05 17:54:52'),
(32, 18, 2, 'CONSULTA', '2022-10-05', 'Mostrar Afiliacion (New)', 'afiliacion', '/restful/api-sigcrm/show-api-master-sigcenter', 1, NULL, NULL, 'POST', 1, '2022-10-05 17:57:41', '2022-10-05 17:57:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_intention`
--

CREATE TABLE `api_intention` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bot_intention_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_parameters`
--

CREATE TABLE `api_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_value` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `api_parameters`
--

INSERT INTO `api_parameters` (`id`, `company_id`, `api_header_id`, `date_created`, `description`, `type`, `name`, `default_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-05-12', NULL, NULL, 'id', NULL, 1, '2022-05-12 15:39:50', '2022-05-12 15:39:50'),
(2, 1, 2, '2022-05-12', NULL, NULL, 'customer_id', NULL, 1, '2022-05-12 20:15:33', '2022-05-12 20:15:33'),
(3, 1, 3, '2022-05-13', NULL, NULL, 'id', NULL, 1, '2022-05-13 15:11:13', '2022-05-13 15:11:13'),
(6, 1, 5, '2022-05-17', NULL, NULL, 'id', NULL, 1, '2022-05-17 12:01:04', '2022-05-17 12:01:04'),
(7, 1, 6, '2022-05-17', NULL, NULL, 'id', NULL, 1, '2022-05-17 12:01:14', '2022-05-17 12:01:14'),
(8, 18, 10, '2022-05-20', NULL, NULL, 'sede', NULL, 1, '2022-05-20 08:21:29', '2022-05-20 08:21:29'),
(9, 18, 11, '2022-05-20', NULL, NULL, 'sede', NULL, 1, '2022-05-20 09:22:53', '2022-05-20 09:22:53'),
(10, 18, 11, '2022-05-20', NULL, NULL, 'cargo', NULL, 1, '2022-05-20 09:22:57', '2022-05-20 09:22:57'),
(11, 18, 12, '2022-05-20', NULL, NULL, 'sede', NULL, 1, '2022-05-20 09:32:54', '2022-05-20 09:32:54'),
(12, 18, 12, '2022-05-20', NULL, NULL, 'trabajador', NULL, 1, '2022-05-20 09:33:05', '2022-05-20 09:33:05'),
(13, 18, 12, '2022-05-20', NULL, NULL, 'fecha', NULL, 1, '2022-05-20 09:33:31', '2022-05-20 09:33:31'),
(14, 18, 13, '2022-05-20', NULL, NULL, 'trabajador', NULL, 1, '2022-05-20 11:30:26', '2022-05-20 11:30:26'),
(15, 18, 14, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:21:48', '2022-09-06 11:21:48'),
(16, 18, 16, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:23:49', '2022-09-06 11:23:49'),
(17, 18, 17, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:24:10', '2022-09-06 11:24:10'),
(18, 18, 18, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:24:19', '2022-09-06 11:24:19'),
(19, 18, 19, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:24:30', '2022-09-06 11:24:30'),
(20, 18, 20, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:33:07', '2022-09-06 11:33:07'),
(21, 18, 15, '2022-09-06', NULL, NULL, 'id', NULL, 1, '2022-09-06 11:59:48', '2022-09-06 11:59:48'),
(22, 1, 26, '2022-09-27', NULL, NULL, 'customer_id', NULL, 1, '2022-09-27 18:43:36', '2022-09-27 18:43:36'),
(23, 18, 27, '2022-09-29', NULL, NULL, 'ruc', NULL, 1, '2022-09-29 14:18:52', '2022-09-29 14:18:52'),
(24, 18, 28, '2022-09-29', NULL, NULL, 'orden', NULL, 1, '2022-09-29 14:20:16', '2022-09-29 14:20:16'),
(26, 1, 30, '2022-09-30', NULL, NULL, 'city_id', NULL, 1, '2022-09-30 08:08:29', '2022-09-30 08:08:29'),
(28, 18, 32, '2022-10-05', NULL, NULL, 'ID_TIPO_AFILIACION', NULL, 1, '2022-10-05 18:05:35', '2022-10-05 18:05:35'),
(29, 18, 13, '2022-10-05', NULL, NULL, 'afiliacion', NULL, 1, '2022-10-05 23:31:56', '2022-10-05 23:31:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atention_detail`
--

CREATE TABLE `atention_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atention_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `procedures_id` bigint(20) UNSIGNED DEFAULT NULL,
  `procedures_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_procedures_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atention_header`
--

CREATE TABLE `atention_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departament_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `date_opening` date DEFAULT NULL,
  `date_atention` datetime DEFAULT NULL,
  `date_atention_end` datetime DEFAULT NULL,
  `oda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generation_area_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generation_area_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generation_area_externa` tinyint(1) NOT NULL DEFAULT 0,
  `date_order` datetime DEFAULT NULL,
  `reservador_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservador_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_atention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_send` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INTELHO',
  `sincronizado` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atention_medicine`
--

CREATE TABLE `atention_medicine` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atention_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `medicine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `medicine_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `dosis` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status_dispatched` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservado_1` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservado_2` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_conection`
--

CREATE TABLE `bot_conection` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_conection`
--

INSERT INTO `bot_conection` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Conexión Ciudad, Esp', 'Ya se tiene previamente: ciudad, especialidad, sede', 1, NULL, NULL),
(2, 'Conexión Descargar R', 'Se redirige para listar y descargar pdf', 1, NULL, NULL),
(3, 'Conexión Agen. Expre', 'Se redirige a Agendamiento Express', 1, '2022-09-30 08:21:21', '2022-09-30 08:21:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_customer_response`
--

CREATE TABLE `bot_customer_response` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_bot_header_id` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `table_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campo_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json_response` varchar(2500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index_response` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_opcion` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_customer` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_customer_response`
--

INSERT INTO `bot_customer_response` (`id`, `chat_bot_header_id`, `api_header_id`, `date_created`, `table_name`, `campo_name`, `json_response`, `index_response`, `response_opcion`, `response_customer`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, '2022-10-12', 'customer', 'ruc', NULL, NULL, NULL, '1717151201', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(2, '1', NULL, '2022-10-12', 'customer', 'id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(3, '1', NULL, '2022-10-12', 'customer', 'customer_id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(4, '1', NULL, '2022-10-12', 'company', 'id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(5, '1', NULL, '2022-10-12', 'company', 'company_id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(6, '1', NULL, '2022-10-12', 'chat_bot_header', 'id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(7, '1', 26, '2022-10-12', 'customer_address', 'address', '[{\"id\":8,\"text\":\"La Planada n76 y oE17a\"},{\"id\":9,\"text\":\"Carcelen Alto frente a las canchas\\r\\n\"},{\"id\":11,\"text\":\"ubicasion temporal\"}]', '1', 'La Planada n76 y oE1', '8', 1, '2022-10-12 21:16:10', '2022-10-12 21:16:13'),
(8, '2', NULL, '2022-10-12', 'sede', 'sede', NULL, NULL, NULL, '1', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(9, '2', NULL, '2022-10-12', 'customer', 'ruc', NULL, NULL, NULL, '1717151201', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(10, '2', NULL, '2022-10-12', 'customer', 'id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(11, '2', NULL, '2022-10-12', 'customer', 'customer_id', NULL, NULL, NULL, '1', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(12, '2', NULL, '2022-10-12', 'company', 'id', NULL, NULL, NULL, '18', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(13, '2', NULL, '2022-10-12', 'company', 'company_id', NULL, NULL, NULL, '18', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(14, '2', NULL, '2022-10-12', 'chat_bot_header', 'id', NULL, NULL, NULL, '2', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(15, '2', 10, '2022-10-12', NULL, 'cargo', '[{\"id\":\"GENERAL\",\"text\":\"GENERAL\"},{\"id\":\"PEDIATRIA\",\"text\":\"PEDIATRIA\"},{\"id\":\"PSICOLOGIA\",\"text\":\"PSICOLOGIA\"}]', '2', 'PEDIATRIA', 'PEDIATRIA', 1, '2022-10-12 21:16:17', '2022-10-12 21:16:22'),
(16, '2', 11, '2022-10-12', NULL, 'trabajador', '[{\"id\":\"19\",\"text\":\"LIZETH ALEXANDRA GUERRA CISNEROS\"}]', '1', 'LIZETH ALEXANDRA GUE', '19', 1, '2022-10-12 21:16:22', '2022-10-12 21:16:26'),
(17, '2', NULL, '2022-10-12', NULL, 'fecha_agenda', NULL, '2022-10-12', NULL, '2022-10-12', 1, '2022-10-12 21:16:33', '2022-10-12 21:16:33'),
(18, '2', 12, '2022-10-12', NULL, 'horario', '{\"15\":{\"id\":15,\"text\":\"22:00:00 - 23:00:00\"}}', '1', '22:00:00 - 23:00:00', '15', 1, '2022-10-12 21:16:33', '2022-10-12 21:16:43'),
(19, '2', 31, '2022-10-12', 'tipo_afiliacion', 'ID_TIPO_AFILIACION', '[{\"ID_TIPO_AFILIACION\":\"1\",\"NOMBRE\":\"PUBLICO\"},{\"ID_TIPO_AFILIACION\":\"2\",\"NOMBRE\":\"PRIVADO\"}]', '2', 'PRIVADO', '2', 1, '2022-10-12 21:16:43', '2022-10-12 21:16:56'),
(20, '2', 32, '2022-10-12', 'afiliacion', 'afiliacion', '[{\"ID_AFILIACION\":\"3\",\"NOMBRE\":\"ECUASANITAS\"},{\"ID_AFILIACION\":\"4\",\"NOMBRE\":\"CONFIAMED\"},{\"ID_AFILIACION\":\"5\",\"NOMBRE\":\"CRUZ BLANCA\"},{\"ID_AFILIACION\":\"7\",\"NOMBRE\":\"FUNDACI\\u00d3N\"},{\"ID_AFILIACION\":\"8\",\"NOMBRE\":\"GRATUIDAD\"},{\"ID_AFILIACION\":\"9\",\"NOMBRE\":\"HUMANA\"},{\"ID_AFILIACION\":\"10\",\"NOMBRE\":\"PANAMERICAN LIFE\"},{\"ID_AFILIACION\":\"11\",\"NOMBRE\":\"PARTICULAR\"},{\"ID_AFILIACION\":\"12\",\"NOMBRE\":\"SALUD\"},{\"ID_AFILIACION\":\"13\",\"NOMBRE\":\"TECNISEGUROS\"}]', '6', 'HUMANA', '9', 1, '2022-10-12 21:16:56', '2022-10-12 21:17:08'),
(21, '2', 13, '2022-10-12', NULL, 'servicio', '[{\"id\":\"254\",\"text\":\"2.9\",\"nombre\":\"CONSULTA PEDIATRIA\"}]', '1', '2.9', '254', 1, '2022-10-12 21:17:08', '2022-10-12 21:17:19'),
(22, '3', NULL, '2022-10-21', 'customer', 'ruc', NULL, NULL, NULL, NULL, 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(23, '3', NULL, '2022-10-21', 'customer', 'id', NULL, NULL, NULL, '15', 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(24, '3', NULL, '2022-10-21', 'customer', 'customer_id', NULL, NULL, NULL, '15', 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(25, '3', NULL, '2022-10-21', 'company', 'id', NULL, NULL, NULL, '1', 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(26, '3', NULL, '2022-10-21', 'company', 'company_id', NULL, NULL, NULL, '1', 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(27, '3', NULL, '2022-10-21', 'chat_bot_header', 'id', NULL, NULL, NULL, '3', 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(28, '4', NULL, '2022-10-21', 'customer', 'ruc', NULL, NULL, NULL, NULL, 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(29, '4', NULL, '2022-10-21', 'customer', 'id', NULL, NULL, NULL, '15', 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(30, '4', NULL, '2022-10-21', 'customer', 'customer_id', NULL, NULL, NULL, '15', 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(31, '4', NULL, '2022-10-21', 'company', 'id', NULL, NULL, NULL, '1', 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(32, '4', NULL, '2022-10-21', 'company', 'company_id', NULL, NULL, NULL, '1', 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(33, '4', NULL, '2022-10-21', 'chat_bot_header', 'id', NULL, NULL, NULL, '4', 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(34, '5', NULL, '2022-10-21', 'customer', 'ruc', NULL, NULL, NULL, NULL, 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(35, '5', NULL, '2022-10-21', 'customer', 'id', NULL, NULL, NULL, '15', 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(36, '5', NULL, '2022-10-21', 'customer', 'customer_id', NULL, NULL, NULL, '15', 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(37, '5', NULL, '2022-10-21', 'company', 'id', NULL, NULL, NULL, '1', 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(38, '5', NULL, '2022-10-21', 'company', 'company_id', NULL, NULL, NULL, '1', 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(39, '5', NULL, '2022-10-21', 'chat_bot_header', 'id', NULL, NULL, NULL, '5', 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_detail`
--

CREATE TABLE `bot_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intention_id` int(11) DEFAULT NULL,
  `option` tinyint(1) NOT NULL DEFAULT 0,
  `api` tinyint(1) NOT NULL DEFAULT 0,
  `api_response` tinyint(1) NOT NULL DEFAULT 0,
  `personalized_response` tinyint(1) NOT NULL DEFAULT 0,
  `refresh` tinyint(1) NOT NULL DEFAULT 0,
  `location` tinyint(1) NOT NULL DEFAULT 0,
  `location_description` tinyint(1) DEFAULT 0,
  `guardado` tinyint(1) NOT NULL DEFAULT 0,
  `guardar_api` tinyint(1) NOT NULL DEFAULT 0,
  `smart_link_pay` tinyint(1) NOT NULL DEFAULT 0,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `first_message` tinyint(1) NOT NULL DEFAULT 0,
  `last_message` tinyint(1) NOT NULL DEFAULT 0,
  `close_chat` tinyint(1) NOT NULL DEFAULT 0,
  `main_branch` tinyint(1) NOT NULL DEFAULT 1,
  `send_inmediately` tinyint(1) NOT NULL DEFAULT 0,
  `home` int(11) NOT NULL DEFAULT 0,
  `back` int(11) DEFAULT 0,
  `home_principal` int(11) DEFAULT 0,
  `agent_start` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_agenda` tinyint(1) NOT NULL DEFAULT 0,
  `pago_kushki` tinyint(1) NOT NULL DEFAULT 0,
  `pay` tinyint(1) NOT NULL DEFAULT 0,
  `order` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_file` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extention` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_detail`
--

INSERT INTO `bot_detail` (`id`, `company_id`, `date_created`, `bot_header_id`, `description`, `intention_id`, `option`, `api`, `api_response`, `personalized_response`, `refresh`, `location`, `location_description`, `guardado`, `guardar_api`, `smart_link_pay`, `disabled`, `first_message`, `last_message`, `close_chat`, `main_branch`, `send_inmediately`, `home`, `back`, `home_principal`, `agent_start`, `fecha_agenda`, `pago_kushki`, `pay`, `order`, `path_file`, `name_file`, `file_extention`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-17', 1, '¡Hola! ¡Bienvenido(a)! Soy el Asistente Virtual de SIGCRM 🤖\n\nEstoy aquí para responder tus *preguntas* y poder *agendar* una cita con el especialista que necesites que esté mas próximo a tu ubicación.\n\nAntes de empezar, por favor indique su número de *IDENTIFIACION* 🪪', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', '/uploads/bots/1/1/', '1664320094.jpg', 'jpg', 1, '2022-05-17 10:03:51', '2022-09-27 18:08:14'),
(2, 1, '2022-05-17', 1, 'Antes de empezar, por favor indique sus *Nombres* y *Apellidos* 👤', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-05-17 10:43:29', '2022-05-17 11:56:35'),
(3, 1, '2022-05-17', 1, 'Ok, te pediré que ingreses a continuación tu correo electrónico. 📧', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-05-17 11:42:48', '2022-05-17 11:56:48'),
(4, 1, '2022-05-17', 1, 'Perfecto! ahora ingresa tu fecha de Nacimiento 🎂\n\n_En el siguiente Formato_ *(AAAA-MM-DD)*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4', NULL, NULL, NULL, 1, '2022-05-17 11:51:35', '2022-09-27 18:00:53'),
(5, 1, '2022-05-17', 1, '¡Perfecto! Es momento de compartir tu ubicación: 🌎', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '5', '/uploads/bots/1/1/', '1664319716.png', 'png', 1, '2022-05-17 12:02:14', '2022-09-27 18:01:56'),
(6, 1, '2022-05-17', 1, 'Ingresa un nombre para esta *ubicación*\n\n👁️ _Recuerda! que es el nombre con el que_ *tu* _vas a identificar esta ubicación_  Ej: *(CASA DE MIS PADRES)*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '6', NULL, NULL, NULL, 1, '2022-05-17 12:03:36', '2022-05-17 12:09:57'),
(7, 1, '2022-05-17', 1, '👋🏻 [CRM]customer.name[/CRM] un gusto saber de ti ☺', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '7', NULL, NULL, NULL, 1, '2022-05-17 12:09:57', '2022-09-27 15:35:57'),
(8, 1, '2022-05-17', 1, '¿Qué quieres hacer?', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, '8', NULL, NULL, NULL, 1, '2022-05-17 12:17:14', '2022-09-28 08:45:39'),
(9, 1, '2022-05-17', 1, 'A continuacion te vamos a mostrar la información del centro _mas cercano_ a tí\n\n_presiona_ *OK* para continuar', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '9', NULL, NULL, NULL, 1, '2022-05-17 12:36:45', '2022-05-18 20:13:44'),
(10, 1, '2022-05-17', 1, 'Tus datos Personales:', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-05-17 12:36:50', '2022-05-18 10:32:37'),
(14, 1, '2022-05-18', 1, 'Adios! has salido sin realizar ninguna opcion 👏👏👏👏👏', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-05-18 10:32:37', '2022-09-28 08:34:42'),
(26, 18, '2022-05-19', 4, '🏢Lista de las Especialidades disponibles:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, '1', '/uploads/bots/18/4/', '1664555393.jpg', 'jpg', 1, '2022-05-19 09:40:59', '2022-09-30 17:49:20'),
(27, 18, '2022-05-20', 4, '👨🏻⚕️👩🏻⚕️Lista de médicos:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '2', '/uploads/bots/18/4/', '1664555496.jpg', 'jpg', 1, '2022-05-20 08:37:48', '2022-09-30 11:32:26'),
(28, 18, '2022-05-20', 4, '*Horarios* Disponibles segun _MEDICO ESPECIALIDAD SEDE_', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '3', '/uploads/bots/18/4/', '1664319499.jpg', 'jpg', 1, '2022-05-20 09:21:06', '2022-09-27 17:58:19'),
(29, 18, '2022-05-20', 4, 'El precio de este procedimiento:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, '4', '/uploads/bots/18/4/', '1664555690.png', 'png', 1, '2022-05-20 09:40:13', '2022-09-30 17:49:40'),
(30, 18, '2022-05-20', 4, 'A continuación: \n- Te compartiremos un link único de pago. 🤳🏻\n- Realiza el Pago con la Tarjeta de tu preferencia. 💳\n\n👇🏻 *Una vez finalizado ingresa el numero de TICKET.*', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, '5', '/uploads/bots/18/4/', '1664319747.jpg', 'jpg', 1, '2022-05-20 11:31:17', '2022-09-30 17:49:48'),
(31, 18, '2022-05-20', 4, 'La Información ingresada es correcta ✅✅\n\nPresiona OK para continuar\n\nClick en el siguiente link para descargar tu FACTURA 🖨️', 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '6', '/uploads/bots/18/4/', '1664555769.png', 'png', 1, '2022-05-20 12:29:40', '2022-09-30 11:36:09'),
(32, 2, '2022-06-07', 5, '', NULL, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', NULL, NULL, NULL, 1, '2022-06-07 20:03:10', '2022-06-07 20:03:54'),
(38, 18, '2022-09-06', 4, 'Ingresa la fecha en la que quieres agendar:\n*HOY*  Para buscar horarios dispobles el dia de hoy, ó\nAAAA-MM-DD ó la fecha en este formato Ej: 2022-12-25', 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, '7', NULL, NULL, NULL, 1, '2022-09-06 10:53:22', '2022-09-30 17:53:16'),
(39, 18, '2022-09-06', 4, 'La Facturación a los mismos del paciente:', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '8', NULL, NULL, NULL, 1, '2022-09-06 10:57:10', '2022-09-15 16:08:38'),
(40, 18, '2022-09-06', 4, 'Ingresa *número de Cédula*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '9', NULL, NULL, NULL, 1, '2022-09-06 11:28:28', '2022-09-06 11:30:53'),
(41, 18, '2022-09-06', 4, 'Ingresa *Nombres*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:28:46', '2022-09-06 11:31:17'),
(42, 18, '2022-09-06', 4, 'Ingresa *Apellidos*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:29:00', '2022-09-06 11:31:37'),
(43, 18, '2022-09-06', 4, 'Ingresa *Correo electrónico*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:29:16', '2022-09-06 11:32:03'),
(44, 18, '2022-09-06', 4, 'Ingresa un *Número Celular*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:29:34', '2022-09-30 11:38:37'),
(45, 18, '2022-09-06', 4, 'Ingresa una *Dirección*', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:29:47', '2022-09-30 11:38:49'),
(46, 18, '2022-09-06', 4, 'Ingresa tu *Fecha de Nacimiento*', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-06 11:29:59', '2022-09-30 11:38:58'),
(47, 18, '2022-09-06', 4, 'Lista de Tipos de Afiliaciones:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', '/uploads/bots/18/4/', '1665013126.jpg', 'jpg', 1, '2022-09-06 12:05:21', '2022-10-05 18:39:59'),
(122, 1, '2022-09-28', 1, '🏠 Necesitamos saber donde estas, selecciona una opición:', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-28 08:34:42', '2022-09-28 08:40:47'),
(123, 1, '2022-09-28', 1, 'Lista de ubicaciones:\n_En el caso de no tener direcciones regresar y agregar una nueva_', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-28 08:40:47', '2022-09-28 08:43:17'),
(131, 18, '2022-09-29', 7, 'Aqui podrás descargar tus resultados, que ya esten *finalizados*\n🔬Selecciona la orden a Descargar:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', NULL, NULL, NULL, 1, '2022-09-29 23:41:37', '2022-09-30 12:42:42'),
(132, 18, '2022-09-30', 7, '📂 Orden Seleccionada:\n(_Presiona_ *ok* _para continuar_)', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-09-30 00:07:31', '2022-09-30 08:46:10'),
(134, 1, '2022-09-30', 6, '¡Hola! ¡Bienvenido(a)! Soy el Asistente Virtual de SIGCRM 🤖 Estoy aquí para responder tus *preguntas* y poder *agendar* una cita con el especialista que necesites que esté mas próximo a tu ubicación. Antes de empezar, por favor indique su número de *IDENTIFIACION* 🪪', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', '/uploads/bots/1/6/', '1664541154.jpg', 'jpg', 1, '2022-09-30 07:31:57', '2022-09-30 07:34:26'),
(135, 1, '2022-09-30', 6, 'Antes de empezar, por favor indique sus *Nombres* y *Apellidos* 👤', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-09-30 07:34:26', '2022-09-30 07:35:08'),
(136, 1, '2022-09-30', 6, 'Ok, te pediré que ingreses a continuación tu correo electrónico. 📧', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-09-30 07:34:28', '2022-09-30 07:35:15'),
(137, 1, '2022-09-30', 6, 'Perfecto! ahora ingresa tu fecha de Nacimiento 🎂 _En el siguiente Formato_ *(AAAA-MM-DD)*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4', NULL, NULL, NULL, 1, '2022-09-30 07:34:31', '2022-09-30 07:38:06'),
(138, 1, '2022-09-30', 6, '👋🏻 [CRM]customer.name[/CRM] espero que te encuentres muy bien 😊', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '5', NULL, NULL, NULL, 1, '2022-09-30 07:38:06', '2022-09-30 17:41:37'),
(139, 1, '2022-09-30', 6, '💡Que quieres hacer ?', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, '6', NULL, NULL, NULL, 1, '2022-09-30 07:41:02', '2022-09-30 17:59:06'),
(142, 1, '2022-09-30', 6, '¡Perfecto! Es momento de compartir tu ubicación: 🌎', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '7', NULL, NULL, NULL, 1, '2022-09-30 07:53:03', '2022-09-30 08:33:53'),
(143, 1, '2022-09-30', 6, 'Ingresa un nombre para esta *ubicación* 👁 _Recuerda! que es el nombre con el que_ *tu* _vas a identificar esta ubicación_ Ej: *(CASA DE MIS PADRES)*', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '8', NULL, NULL, NULL, 1, '2022-09-30 07:53:54', '2022-09-30 08:35:07'),
(144, 1, '2022-09-30', 6, '🏙Lista de ciudades:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, '9', NULL, NULL, NULL, 1, '2022-09-30 07:56:28', '2022-09-30 17:39:54'),
(145, 1, '2022-09-30', 6, 'Listar de sede en la ciudad:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 08:09:07', '2022-09-30 17:39:16'),
(146, 1, '2022-09-30', 6, 'Al continuar con esta conversación, declara que está de acuerdo con nuestra Política de Privacidad:\n\n\nhttps://www.sigcrm.pro/politicas-privacidad \n\n\nDigita *ok* para continuar.', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 08:10:35', '2022-09-30 17:40:29'),
(147, 1, '2022-09-30', 6, '🏚Ubicaciones:', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 08:11:12', '2022-09-30 17:38:05'),
(148, 18, '2022-09-30', 7, '😊 Gracias, si necesitas más información sobre NOSOTROS, ¡estoy aquí! Escríbeme un \"hola\" y te contestaré de nuevo. ¡Un abrazo!', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-09-30 08:17:47', '2022-09-30 18:17:01'),
(149, 18, '2022-09-30', 8, '⏩AGENDAMIENTO EXPRESS\n🏢Lista de las Especialidades disponibles:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', NULL, NULL, NULL, 1, '2022-09-30 08:19:03', '2022-09-30 12:23:26'),
(150, 18, '2022-09-30', 8, '👨🏻⚕️👩🏻⚕️Lista de médicos:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-09-30 08:19:22', '2022-09-30 12:27:37'),
(154, 1, '2022-09-30', 6, 'Tus ubicaciones:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 10:26:49', '2022-09-30 10:35:20'),
(155, 1, '2022-09-30', 6, '😊 Gracias, si necesitas más información sobre NOSOTROS, ¡estoy aquí! Escríbeme un \"hola\" y te contestaré de nuevo. ¡Un abrazo!', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 10:27:30', '2022-09-30 17:28:30'),
(159, 18, '2022-09-30', 8, '*Horarios* Disponibles', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-09-30 12:24:08', '2022-09-30 12:28:45'),
(160, 18, '2022-09-30', 8, 'Lista de precios', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4', NULL, NULL, NULL, 1, '2022-09-30 12:24:35', '2022-09-30 12:29:31'),
(161, 18, '2022-09-30', 8, 'A continuación: - Te compartiremos un link único de pago. 🤳🏻 - Realiza el Pago con la Tarjeta de tu preferencia. 💳 👇🏻 *Una vez finalizado ingresa el numero de TICKET.*', 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '5', NULL, NULL, NULL, 1, '2022-09-30 12:25:46', '2022-09-30 12:31:02'),
(162, 18, '2022-09-30', 8, 'La Información ingresada es correcta ✅✅ Presiona OK para continuar Click en el siguiente link para descargar tu FACTURA 🖨', 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '6', '/uploads/bots/18/8/', '1664559119.png', 'png', 1, '2022-09-30 12:26:28', '2022-09-30 12:32:10'),
(163, 18, '2022-09-30', 8, 'Transacción *Exitosa* ☝🏻 Se agendó correctamente, es un placer servirte', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '7', NULL, NULL, NULL, 1, '2022-09-30 12:27:02', '2022-09-30 12:32:33'),
(167, 1, '2022-09-30', 10, 'lista lista', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, '1', '/uploads/bots/1/10/', '1664585150.mp3', 'mp3', 1, '2022-09-30 14:20:44', '2022-09-30 19:45:50'),
(168, 1, '2022-09-30', 10, 'hola 22', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-09-30 14:20:46', '2022-09-30 15:03:19'),
(169, 1, '2022-09-30', 10, 'hola 3', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-09-30 14:20:46', '2022-09-30 15:02:12'),
(170, 1, '2022-09-30', 10, 'hola 4', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4', NULL, NULL, NULL, 1, '2022-09-30 14:52:48', '2022-09-30 14:57:57'),
(171, 1, '2022-09-30', 6, '🤖Sigcrm es un chatbot,  el cual te permite realizar agendamientos, recibir informavion y automatizar procesos con el fin de realizar acciones más rápidas.', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '10', '/uploads/bots/1/6/', '1664577872.jpg', 'jpg', 1, '2022-09-30 17:28:30', '2022-09-30 17:44:32'),
(172, 1, '2022-09-30', 6, 'Fin chat', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-09-30 17:33:10', '2022-09-30 17:33:19'),
(173, 18, '2022-09-30', 9, 'Listar Tipos de Afiliación 🐹', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', NULL, NULL, NULL, 1, '2022-09-30 19:30:41', '2022-10-05 17:55:59'),
(174, 18, '2022-09-30', 9, 'Lista de Afiliaciones segun tipo: 🐶', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-09-30 19:31:11', '2022-10-05 17:58:32'),
(175, 18, '2022-10-05', 9, 'Adios..🐱', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-10-05 17:57:47', '2022-10-05 17:58:00'),
(176, 18, '2022-10-05', 4, 'Lista de Afiliaciones:', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-10-05 18:37:52', '2022-10-05 18:41:09'),
(177, 18, '2022-10-05', 4, 'Transacción *Exitosa* ☝🏻 Se agendó correctamente, es un placer servirte', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, '10', NULL, NULL, NULL, 1, '2022-10-05 18:37:53', '2022-10-05 18:38:26'),
(178, 1, '2022-10-21', 11, '1', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', NULL, NULL, NULL, 1, '2022-10-21 15:27:29', '2022-10-21 15:27:35'),
(179, 1, '2022-10-21', 11, '2', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', NULL, NULL, NULL, 1, '2022-10-21 15:27:30', '2022-10-21 15:27:38'),
(180, 1, '2022-10-21', 11, '3', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '3', NULL, NULL, NULL, 1, '2022-10-21 15:27:31', '2022-10-21 15:27:44'),
(181, 1, '2022-10-21', 11, '4', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '4', NULL, NULL, NULL, 1, '2022-10-21 15:27:44', '2022-10-21 15:27:50'),
(182, 1, '2022-10-21', 11, '5', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '5', NULL, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:27:53'),
(183, 1, '2022-10-21', 11, '6', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '6', NULL, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:27:57'),
(184, 1, '2022-10-21', 11, '7', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '7', NULL, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:28:01'),
(185, 1, '2022-10-21', 11, '8', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '8', NULL, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:28:04'),
(186, 1, '2022-10-21', 11, '9', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '9', NULL, NULL, NULL, 1, '2022-10-21 15:27:46', '2022-10-21 15:28:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_header`
--

CREATE TABLE `bot_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_texto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_texto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calcular_sede_proxima` tinyint(1) NOT NULL DEFAULT 0,
  `bot_conection_id` int(11) DEFAULT NULL,
  `user_created_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_header`
--

INSERT INTO `bot_header` (`id`, `company_id`, `date_created`, `name`, `description`, `start_code`, `home_codigo`, `home_texto`, `back_codigo`, `back_texto`, `calcular_sede_proxima`, `bot_conection_id`, `user_created_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-17', 'BOT INICIAL BETA', 'CON ESTE BOT DE LA EMPRESA PRINCIPAL VAMOS A TOMAR INFORMACION DEL PACIENTE PARA REUBICAR AL CENTRO MEDICO MAS CERCANO.', NULL, '#', '*#* para regresar al _Menu Principal_', 'volver', '*volver* para regresar.', 0, NULL, 1, 0, '2022-05-17 10:03:22', '2022-09-30 07:31:16'),
(3, 2, '2022-05-18', 'HOLA HESB', 'HOLA HESB', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2022-05-18 16:44:23', '2022-05-18 16:44:23'),
(4, 18, '2022-05-19', 'BIENVENIDO A INTELHO', 'BOT POR DEFECTO A INICIAR', NULL, '#', 'Presiona *#* para volver al menu principal', 'volver', 'Presiona *volver* para volver', 0, NULL, 1, 1, '2022-05-19 09:40:54', '2022-10-05 18:42:28'),
(5, 2, '2022-06-07', 'COBRANZA AAA', 'ESTO ES PARA COBRAR A LOS CLIENTES VIP', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2022-06-07 20:03:02', '2022-06-07 20:03:02'),
(6, 1, '2022-06-09', 'BOT INICIAL NUEVO', 'NUEVO BOT DE INICIO', NULL, '#', '#️⃣ Presiona *#* ir al menu principal.', 'volver', '🔙 Escribe *volver* para regresar', 0, NULL, 1, 0, '2022-06-09 12:24:19', '2022-10-21 15:26:59'),
(7, 18, '2022-06-15', 'DESCARGAR RESULTADOS', 'CORREGIR VISUALIZAR CLIENTE', NULL, NULL, NULL, NULL, NULL, 0, 2, 1, 1, '2022-06-15 12:58:45', '2022-10-05 18:42:28'),
(8, 18, '2022-09-30', 'AGENDAMIENTO EXPRESS', 'ESTE AGENDAMIENTO YA TENEMOS REGISTRADA LA SEDE, CIUDAD', NULL, '#', '#️⃣ Presiona *#* ir al menu principal.', 'volver', '🔙 Escribe *volver* para regresar', 0, 3, 1, 1, '2022-09-30 08:14:35', '2022-10-05 18:42:29'),
(9, 18, '2022-09-30', 'PARA PRUEBAS', 'PARA PRUEBAS', NULL, '#', 'Presiona *#* para volver', 'volver', 'Presiona *volver* para volver', 0, NULL, 1, 0, '2022-09-30 08:20:06', '2022-10-05 18:42:29'),
(10, 1, '2022-09-30', 'TEST CIUDADEDS SEDES', 'TES PARABISCAR SEDES POR CIUDADES', NULL, 'men', '*men* Menu', 'vol', '*vol* para regresar', 0, NULL, 1, 0, '2022-09-30 09:17:14', '2022-10-21 15:27:12'),
(11, 1, '2022-10-21', 'TEST PARA AGENTES', 'TEST PARA AGENTES', NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2022-10-21 15:27:24', '2022-10-21 15:27:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_historial`
--

CREATE TABLE `bot_historial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bot_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_header_response` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_detail_id` int(11) DEFAULT NULL,
  `api_parameters_id` int(11) DEFAULT NULL,
  `opcion` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_message` tinyint(1) NOT NULL DEFAULT 1,
  `main_detail` tinyint(1) NOT NULL DEFAULT 1,
  `main_answer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bot_conection_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_historial`
--

INSERT INTO `bot_historial` (`id`, `company_id`, `date_created`, `bot_header_id`, `bot_detail_id`, `api_header_id`, `api_header_code`, `api_header_response`, `api_detail_id`, `api_parameters_id`, `opcion`, `description`, `last_message`, `main_detail`, `main_answer_id`, `bot_conection_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(66, 1, '2022-05-17', 1, 1, NULL, '200', NULL, NULL, NULL, NULL, 'EXISTE EL PACIENTE EN NUSTRA BASE', 1, 1, 7, NULL, NULL, 1, '2022-05-17 12:25:46', '2022-09-07 16:39:27'),
(68, 1, '2022-05-17', 1, 1, NULL, '400', NULL, NULL, NULL, NULL, 'Crear Paciente', 1, 1, 2, NULL, NULL, 1, '2022-05-17 12:25:47', '2022-05-17 15:09:16'),
(71, 1, '2022-05-17', 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 3, NULL, NULL, 1, '2022-05-17 12:30:38', '2022-05-17 12:30:38'),
(72, 1, '2022-05-17', 1, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 4, NULL, NULL, 1, '2022-05-17 12:31:00', '2022-05-17 12:31:00'),
(73, 1, '2022-05-17', 1, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 5, NULL, NULL, 1, '2022-05-17 12:31:17', '2022-05-17 12:31:17'),
(76, 1, '2022-05-17', 1, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 6, NULL, NULL, 1, '2022-05-17 12:32:25', '2022-05-17 12:32:25'),
(93, 1, '2022-05-17', 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, 'Hola, [CRM]customer.name[/CRM] un gusto saber de ti ☺️\n\n_escribe_ *OK* para continuar con las *OPCIONES*', 1, 1, 8, NULL, NULL, 1, '2022-05-17 15:11:57', '2022-05-17 15:11:57'),
(94, 1, '2022-05-17', 1, 8, NULL, NULL, NULL, NULL, NULL, '1', '🔖 Agendar una *CITA*', 1, 1, 122, NULL, 1, 1, '2022-05-17 15:12:17', '2022-09-28 08:39:59'),
(95, 1, '2022-05-17', 1, 8, NULL, NULL, NULL, NULL, NULL, '2', '👨🏻‍💻 Ver mis datos Personales.', 1, 1, 10, NULL, 2, 1, '2022-05-17 15:12:18', '2022-05-17 15:14:59'),
(100, 1, '2022-05-17', 1, 8, NULL, NULL, NULL, NULL, NULL, '3', '🚪 SALIR', 1, 1, 14, NULL, 3, 1, '2022-05-17 15:16:08', '2022-05-18 20:15:30'),
(109, 1, '2022-05-18', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 14, NULL, NULL, 1, '2022-05-18 12:33:45', '2022-05-18 12:33:45'),
(110, 1, '2022-05-18', 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 14, NULL, NULL, 1, '2022-05-18 12:36:02', '2022-05-18 12:36:02'),
(123, 1, '2022-05-18', 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, '*Nombres:* [CRM]customer.name[/CRM]\n*Correo:* [CRM]customer.correo[/CRM]\n*Fecha de Nacimiento:* [CRM]customer.birth_date[/CRM]\n*Celular:* [CRM]customer.celular_1[/CRM]\n\n_PARA VOLVER PRESIONA_ *OK*\n\nPresiona *OK* para  volver a las _opciones_', 1, 1, 8, NULL, NULL, 1, '2022-05-18 20:14:53', '2022-05-18 20:14:53'),
(124, 1, '2022-05-18', 1, 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 9, NULL, NULL, 1, '2022-05-18 20:21:49', '2022-05-18 20:21:49'),
(130, 18, '2022-05-20', 4, 26, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 27, NULL, NULL, 1, '2022-05-20 08:38:05', '2022-05-20 08:38:05'),
(134, 18, '2022-05-20', 4, 28, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 47, NULL, NULL, 1, '2022-05-20 09:40:56', '2022-10-05 18:41:44'),
(139, 18, '2022-05-20', 4, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 31, NULL, NULL, 1, '2022-05-20 12:30:36', '2022-05-20 12:30:36'),
(149, 18, '2022-09-06', 4, 27, 11, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 38, NULL, NULL, 1, '2022-09-06 10:54:21', '2022-09-06 10:54:21'),
(158, 18, '2022-09-06', 4, 40, 14, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 41, NULL, NULL, 1, '2022-09-06 11:31:09', '2022-09-06 11:31:09'),
(159, 18, '2022-09-06', 4, 41, 15, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 42, NULL, NULL, 1, '2022-09-06 11:31:27', '2022-09-06 11:31:27'),
(160, 18, '2022-09-06', 4, 42, 16, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 43, NULL, NULL, 1, '2022-09-06 11:31:48', '2022-09-06 11:31:48'),
(161, 18, '2022-09-06', 4, 43, 17, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 44, NULL, NULL, 1, '2022-09-06 11:32:17', '2022-09-06 11:32:17'),
(162, 18, '2022-09-06', 4, 44, 20, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 45, NULL, NULL, 1, '2022-09-06 11:33:31', '2022-09-06 11:33:31'),
(163, 18, '2022-09-06', 4, 45, 18, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 46, NULL, NULL, 1, '2022-09-06 11:33:50', '2022-09-06 11:33:50'),
(165, 18, '2022-09-06', 4, 46, 19, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 30, NULL, NULL, 1, '2022-09-06 11:34:23', '2022-09-06 11:34:23'),
(166, 18, '2022-09-06', 4, 29, 13, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 39, NULL, NULL, 1, '2022-09-06 11:56:45', '2022-09-06 11:56:45'),
(169, 18, '2022-09-06', 4, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 177, NULL, NULL, 1, '2022-09-06 12:12:58', '2022-10-05 18:39:42'),
(201, 18, '2022-05-20', 4, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 28, NULL, NULL, 1, '2022-05-20 08:38:05', '2022-09-15 16:06:04'),
(202, 18, '2022-09-15', 4, 39, NULL, NULL, NULL, NULL, NULL, '1', 'SI', 1, 1, 30, NULL, 1, 1, '2022-09-15 16:08:40', '2022-09-15 16:09:24'),
(203, 18, '2022-09-15', 4, 39, NULL, NULL, NULL, NULL, NULL, '2', 'NO', 1, 1, 40, NULL, 2, 1, '2022-09-15 16:08:46', '2022-09-15 16:09:35'),
(280, 1, '2022-09-28', 1, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 122, NULL, NULL, 1, '2022-09-28 08:34:42', '2022-09-28 08:34:42'),
(281, 1, '2022-09-28', 1, 122, NULL, NULL, '', NULL, NULL, '1', 'Listar tus direcciones guardadas', 1, 1, 123, NULL, 1, 1, '2022-09-28 08:38:50', '2022-09-28 08:43:10'),
(282, 1, '2022-09-28', 1, 122, NULL, NULL, NULL, NULL, NULL, '2', 'Agregar una nueva dirección', 1, 1, 5, NULL, 2, 1, '2022-09-28 08:39:21', '2022-09-28 08:40:27'),
(284, 1, '2022-09-28', 1, 123, 26, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 9, NULL, NULL, 1, '2022-09-28 08:42:54', '2022-09-28 08:46:17'),
(299, 1, '2022-09-30', 6, 134, NULL, '200', '', NULL, NULL, '', 'PACIENTE UA EN BASE O CREADO DESDE LA API', 1, 1, 138, NULL, NULL, 1, '2022-09-30 07:32:53', '2022-09-30 07:39:33'),
(300, 1, '2022-09-30', 6, 134, NULL, '400', NULL, NULL, NULL, NULL, 'CREAR PACIENTE', 1, 1, 135, NULL, NULL, 1, '2022-09-30 07:33:26', '2022-09-30 07:39:44'),
(305, 1, '2022-09-30', 6, 135, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 136, NULL, NULL, 1, '2022-09-30 07:36:33', '2022-09-30 07:39:55'),
(306, 1, '2022-09-30', 6, 136, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 137, NULL, NULL, 1, '2022-09-30 07:36:47', '2022-09-30 07:37:11'),
(309, 1, '2022-09-30', 6, 137, 6, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 138, NULL, NULL, 1, '2022-09-30 07:37:23', '2022-09-30 07:40:08'),
(310, 1, '2022-09-30', 6, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 139, NULL, NULL, 1, '2022-09-30 07:41:02', '2022-09-30 07:41:02'),
(311, 1, '2022-09-30', 6, 139, NULL, NULL, '', NULL, NULL, '1', '⌚ Agendamiento', 1, 1, 147, NULL, 1, 1, '2022-09-30 07:42:26', '2022-09-30 11:43:44'),
(312, 1, '2022-09-30', 6, 139, NULL, NULL, NULL, NULL, NULL, '2', '⌚ Agendamiento Express', 1, 1, 142, '3', 2, 1, '2022-09-30 07:42:46', '2022-09-30 11:43:28'),
(313, 1, '2022-09-30', 6, 139, NULL, NULL, NULL, NULL, NULL, '3', '🏙️ Agendamiento por Ciudad', 1, 1, 144, NULL, 3, 1, '2022-09-30 07:43:01', '2022-09-30 11:42:56'),
(314, 1, '2022-09-30', 6, 139, NULL, NULL, NULL, NULL, NULL, '4', '🗄️ Descargar resultados', 1, 1, 147, '2', 4, 1, '2022-09-30 07:43:21', '2022-09-30 10:32:15'),
(315, 1, '2022-09-30', 6, 139, NULL, NULL, NULL, NULL, NULL, '5', '🚪 Salir sin ninguna acción', 1, 1, 155, NULL, 5, 1, '2022-09-30 07:45:48', '2022-09-30 10:29:02'),
(320, 1, '2022-09-30', 6, 144, 29, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 145, NULL, NULL, 1, '2022-09-30 07:59:31', '2022-09-30 08:10:08'),
(322, 1, '2022-09-30', 6, 145, 30, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 146, NULL, NULL, 1, '2022-09-30 08:10:24', '2022-09-30 08:10:59'),
(323, 1, '2022-09-30', 6, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 147, NULL, NULL, 1, '2022-09-30 08:11:12', '2022-09-30 08:11:12'),
(325, 18, '2022-09-30', 7, 131, 27, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 132, NULL, NULL, 1, '2022-09-30 08:16:04', '2022-09-30 08:17:46'),
(331, 1, '2022-09-30', 6, 142, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 143, NULL, NULL, 1, '2022-09-30 08:34:10', '2022-09-30 08:34:37'),
(335, 1, '2022-09-30', 6, 143, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 146, NULL, NULL, 1, '2022-09-30 08:35:26', '2022-09-30 08:35:37'),
(337, 18, '2022-09-30', 7, 132, 28, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 148, NULL, NULL, 1, '2022-09-30 08:46:17', '2022-09-30 18:01:09'),
(345, 1, '2022-09-30', 6, 147, NULL, NULL, '', NULL, NULL, '1', 'Listar ubicaciones', 1, 1, 154, NULL, 1, 1, '2022-09-30 10:30:40', '2022-09-30 10:34:04'),
(346, 1, '2022-09-30', 6, 147, NULL, NULL, NULL, NULL, NULL, '2', 'Agregar ubicación', 1, 1, 142, NULL, 2, 1, '2022-09-30 10:30:57', '2022-09-30 10:32:38'),
(348, 1, '2022-09-30', 6, 154, 26, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 146, NULL, NULL, 1, '2022-09-30 10:33:11', '2022-09-30 10:33:27'),
(355, 18, '2022-09-30', 8, 149, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 150, NULL, NULL, 1, '2022-09-30 12:23:39', '2022-09-30 12:24:00'),
(362, 18, '2022-09-30', 8, 150, 11, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 159, NULL, NULL, 1, '2022-09-30 12:27:47', '2022-09-30 12:27:58'),
(365, 18, '2022-09-30', 8, 159, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 160, NULL, NULL, 1, '2022-09-30 12:29:00', '2022-09-30 12:29:13'),
(369, 18, '2022-09-30', 8, 160, 13, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 161, NULL, NULL, 1, '2022-09-30 12:29:59', '2022-09-30 12:30:35'),
(370, 18, '2022-09-30', 8, 161, NULL, NULL, '', NULL, NULL, '', '', 1, 1, 162, NULL, NULL, 1, '2022-09-30 12:31:02', '2022-09-30 12:31:23'),
(371, 18, '2022-09-30', 8, 162, NULL, NULL, '', NULL, NULL, '', '', 1, 1, 163, NULL, NULL, 1, '2022-09-30 12:32:10', '2022-09-30 12:32:24'),
(376, 1, '2022-09-30', 10, 168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 169, NULL, NULL, 1, '2022-09-30 14:20:46', '2022-09-30 14:20:46'),
(377, 1, '2022-09-30', 10, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 170, NULL, NULL, 1, '2022-09-30 14:52:48', '2022-09-30 14:52:48'),
(381, 1, '2022-09-30', 10, 167, 29, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 168, NULL, NULL, 1, '2022-09-30 15:00:15', '2022-09-30 15:00:21'),
(382, 1, '2022-09-30', 6, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 171, NULL, NULL, 1, '2022-09-30 17:28:30', '2022-09-30 17:28:30'),
(383, 1, '2022-09-30', 6, 139, NULL, NULL, NULL, NULL, NULL, '6', '👷🏻‍♀️ Informacionde nosotros', 1, 1, 171, NULL, 6, 1, '2022-09-30 17:31:33', '2022-09-30 17:32:52'),
(384, 1, '2022-09-30', 6, 171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 139, NULL, NULL, 1, '2022-09-30 17:33:10', '2022-09-30 17:34:20'),
(388, 18, '2022-10-05', 9, 173, 31, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 174, NULL, NULL, 1, '2022-10-05 17:56:11', '2022-10-05 17:56:16'),
(391, 18, '2022-10-05', 9, 174, 32, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 175, NULL, NULL, 1, '2022-10-05 17:58:52', '2022-10-05 18:26:28'),
(394, 18, '2022-10-05', 4, 47, 31, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 176, NULL, NULL, 1, '2022-10-05 18:40:08', '2022-10-05 18:40:48'),
(396, 18, '2022-10-05', 4, 176, 32, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 29, NULL, NULL, 1, '2022-10-05 18:41:14', '2022-10-05 18:42:16'),
(397, 1, '2022-10-21', 11, 178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 179, NULL, NULL, 1, '2022-10-21 15:27:30', '2022-10-21 15:27:30'),
(398, 1, '2022-10-21', 11, 179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 180, NULL, NULL, 1, '2022-10-21 15:27:31', '2022-10-21 15:27:31'),
(399, 1, '2022-10-21', 11, 180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 181, NULL, NULL, 1, '2022-10-21 15:27:44', '2022-10-21 15:27:44'),
(400, 1, '2022-10-21', 11, 181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 182, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:27:45'),
(401, 1, '2022-10-21', 11, 182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 183, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:27:45'),
(402, 1, '2022-10-21', 11, 183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 184, NULL, NULL, 1, '2022-10-21 15:27:45', '2022-10-21 15:27:45'),
(403, 1, '2022-10-21', 11, 184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 185, NULL, NULL, 1, '2022-10-21 15:27:46', '2022-10-21 15:27:46'),
(404, 1, '2022-10-21', 11, 185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 186, NULL, NULL, 1, '2022-10-21 15:27:46', '2022-10-21 15:27:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot_intention`
--

CREATE TABLE `bot_intention` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bot_intention`
--

INSERT INTO `bot_intention` (`id`, `date_created`, `name`, `description`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, '2022-05-16', 'Ingresar Opciones', 'Con esta intención, vas a crear distintas opciones las cuales el usuario puede elegir y redirigir a distintas intenciones que consideres', 'OP', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(2, '2022-05-16', 'API mostrar Respuesta', 'Esta intención vamos a seleccionar una api de las ya creadas para poder mostrar contenido de las misma y de esa manera seleccionar una de las opciones', 'AP', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(3, '2022-05-16', 'Deshabilitado', 'Esta intencion no realiza ninguna accion solamente pasa a la siguiente intencion una vez respondido.', 'DE', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(4, '2022-05-16', 'Ubicación Guardar', 'Con esta intención vamos a guardar la ubicaccin del cliente latitud y logintud, para que se vinvule con la empresa mas cercana a su residencia', 'LO', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(5, '2022-05-16', 'Actualización Datos', 'Con las apis asignadas vamos a poder actualizar un registro del cliente como nombres, correos telefonos, etc', 'RE', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(6, '2022-05-16', 'Agregar Localización', 'Con esta opcion vamos a agregar un nombre a una ubicacion nueva que hayamos creado', 'LOD', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(7, '2022-05-16', 'Respueta Personalizada', 'Texto Opciones 7', 'APRE', 0, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(8, '2022-05-16', 'Datos del MSP', 'Consultar datos del cliente si existen caso contrario debera llenarlos a mano. consulta MSP', 'APR', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(9, '2022-05-16', 'Campos API', 'Texto Opciones 9', 'GUCAM', 0, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(10, '2022-05-16', 'Guardar Información', 'Texto Opciones 10', 'GU', 0, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(11, '2022-05-16', 'SmartLink Pagos', 'Esta Proporciona un link de pago en kushki pero tener en cuenta haber llenado mas campos como precios de producto y los datos del cliente', 'SL', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(12, '2022-05-16', 'Fecha de Agendamiento', 'Nos permite almacenar una fecha par un futuro agendamiento.', 'FA', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(13, '2022-05-16', 'Inmediato', 'Texto Opciones 13', 'IM', 0, '2022-05-17 08:30:54', '2022-05-17 08:30:54'),
(14, '2022-05-16', 'Estado Pago KUSHKI', 'Nos devuelve una respueta de si el pago se hizo efectivo seguido del LINK del ride si se finalizo la factura', 'PAKU', 1, '2022-05-17 08:30:54', '2022-05-17 08:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campania`
--

CREATE TABLE `campania` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `code_intel` int(11) DEFAULT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hour_created` time DEFAULT NULL,
  `date_send` date DEFAULT NULL,
  `hour_send` time DEFAULT NULL,
  `immediately` tinyint(1) NOT NULL DEFAULT 0,
  `programmed` tinyint(1) NOT NULL DEFAULT 0,
  `repeat` tinyint(1) NOT NULL DEFAULT 0,
  `reminder` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_valor` int(11) DEFAULT NULL,
  `recurrence` tinyint(1) NOT NULL DEFAULT 0,
  `recurrence_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_valor` int(11) DEFAULT NULL,
  `lapsos` int(11) DEFAULT NULL,
  `observation` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type` int(11) NOT NULL DEFAULT 0,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opcion1` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opcion2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opcion3` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `company_id`, `title`, `description`, `type`, `type_name`, `sub_type`, `photo`, `opcion1`, `opcion2`, `opcion3`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'ONIX', 'SISTEMA DE FACTURACION', 1, 'ONIX', 0, NULL, NULL, NULL, NULL, 1, '2020-05-17 19:05:42', '2020-05-17 19:05:42'),
(2, 1, 'COMIDA EXPRESS', 'Deliciosa comida a la puerta de tu casa con los mejores estándares de limpieza y seguridad.', 2, 'LAYAPA', 0, '1601934269.jpg', NULL, NULL, NULL, 1, '2020-10-06 02:44:29', '2020-10-06 02:44:29'),
(92, 1, 'UNIDAD', NULL, 3, 'UNIDAD PARA CUANTIFICAR PRODUCTOS', 0, NULL, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_message`
--

CREATE TABLE `category_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_bot_detail`
--

CREATE TABLE `chat_bot_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `chat_bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bot_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `api_header_id` bigint(20) DEFAULT NULL,
  `first_message` tinyint(1) NOT NULL DEFAULT 0,
  `last_message` tinyint(1) NOT NULL DEFAULT 0,
  `bot_question` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bot_historial_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_address_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_answer` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bot` tinyint(1) NOT NULL DEFAULT 1,
  `date_format` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_real` date DEFAULT NULL,
  `time_real` time DEFAULT NULL,
  `messagenumber` int(11) DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `action` tinyint(1) NOT NULL DEFAULT 0,
  `user_write_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chat_bot_detail`
--

INSERT INTO `chat_bot_detail` (`id`, `company_id`, `date_created`, `chat_bot_header_id`, `bot_detail_id`, `api_header_id`, `first_message`, `last_message`, `bot_question`, `bot_historial_id`, `customer_address_id`, `customer_answer`, `description`, `bot`, `date_format`, `date_real`, `time_real`, `messagenumber`, `viewed`, `action`, `user_write_id`, `status`, `created_at`, `updated_at`) VALUES
(37, 1, '2022-10-21', 5, NULL, NULL, 1, 0, NULL, NULL, NULL, 'HOLA', 'Primer Mensaje Paciente', 0, '2022-10-21 16:00:15', NULL, NULL, NULL, 0, 0, NULL, 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(38, 1, '2022-10-21', 5, 178, NULL, 0, 1, '1', NULL, NULL, NULL, 'Interaccion desde el Cliente con el BOT', 1, '2022-10-21 16:00:16', NULL, NULL, NULL, 0, 0, NULL, 1, '2022-10-21 16:00:16', '2022-10-21 16:00:16'),
(39, 1, '2022-10-21', 5, NULL, NULL, 0, 1, 'hola', NULL, NULL, NULL, 'Mensaje Envia Agente', 1, '2022-10-21 16:00:30', NULL, NULL, 0, 0, 0, NULL, 0, '2022-10-21 16:00:30', '2022-10-21 16:00:30'),
(40, 1, '2022-10-21', 5, NULL, NULL, 0, 0, NULL, NULL, NULL, 'bien', 'Primer Mensaje Paciente', 0, '2022-10-21 16:00:37', NULL, NULL, NULL, 0, 0, NULL, 1, '2022-10-21 16:00:37', '2022-10-21 16:00:37'),
(41, 1, '2022-10-21', 5, NULL, NULL, 0, 1, 'genial', NULL, NULL, NULL, 'Mensaje Envia Agente', 1, '2022-10-21 16:00:48', NULL, NULL, 0, 0, 0, NULL, 0, '2022-10-21 16:00:48', '2022-10-21 16:00:48'),
(42, 1, '2022-10-21', 5, 178, NULL, 0, 0, NULL, NULL, NULL, '2', 'Mensaje Paciente', 0, '2022-10-21 16:06:04', NULL, NULL, NULL, 0, 0, NULL, 1, '2022-10-21 16:06:04', '2022-10-21 16:06:04'),
(43, 1, '2022-10-21', 5, 179, NULL, 0, 1, '2', NULL, NULL, NULL, 'Interaccion desde el Cliente con el BOT', 1, '2022-10-21 16:06:04', NULL, NULL, NULL, 0, 0, NULL, 1, '2022-10-21 16:06:04', '2022-10-21 16:06:04'),
(44, 1, '2022-10-21', 5, NULL, NULL, 0, 1, 'hola john', NULL, NULL, NULL, 'Mensaje Envia Agente', 1, '2022-10-21 17:15:24', NULL, NULL, 0, 0, 0, NULL, 0, '2022-10-21 17:15:24', '2022-10-21 17:15:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_bot_header`
--

CREATE TABLE `chat_bot_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_factura_id` int(11) DEFAULT NULL,
  `bot_conection_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chatId` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_smart_link_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_smart_link` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_payment_method` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_ticket_number` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_status` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_ruc` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_nombres` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_apellidos` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_nacimiento` date DEFAULT NULL,
  `factura_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_celular` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_direccion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agente` tinyint(1) NOT NULL DEFAULT 0,
  `status_venta` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `user_assigned_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FINALIZADO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chat_bot_header`
--

INSERT INTO `chat_bot_header` (`id`, `company_id`, `sede_id`, `date_created`, `bot_header_id`, `customer_id`, `customer_factura_id`, `bot_conection_id`, `name`, `description`, `chatId`, `pay_smart_link_url`, `pay_smart_link`, `pay_payment_method`, `pay_ticket_number`, `pay_status`, `factura_ruc`, `factura_nombres`, `factura_apellidos`, `factura_nacimiento`, `factura_email`, `factura_celular`, `factura_direccion`, `agente`, `status_venta`, `user_assigned_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, NULL, '2022-10-21', 11, 15, NULL, NULL, 'whatsapp:+14155238886', 'Menssage Default', 'SM77e9a7517af5e01261c9078d7b7171df', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'PENDIENTE', NULL, '1', '2022-10-21 16:00:15', '2022-10-21 17:15:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_header_category_message`
--

CREATE TABLE `chat_header_category_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `category_message_id` int(11) DEFAULT NULL,
  `chat_bot_header_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`id`, `name`, `code`, `country_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'QUITO', '1015', '231', 1, '2021-09-13 18:48:25', '2021-09-28 16:06:43'),
(2, 'CUENCA', '17', '231', 1, '2021-09-14 21:38:06', '2021-09-14 21:38:06'),
(5, 'GUAYAQUIL', '486', '231', 1, '2021-12-23 10:12:25', '2021-12-23 10:12:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0,
  `code_intel` int(11) DEFAULT NULL,
  `ruc` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_color` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3274b1',
  `comercial_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_representative` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conexion` tinyint(1) NOT NULL DEFAULT 1,
  `imprimir_comprobantes` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electronica` tinyint(1) NOT NULL DEFAULT 0,
  `contribuyente_especial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obligado_contabilidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_inicio` time NOT NULL DEFAULT '09:00:00',
  `hora_fin` time NOT NULL DEFAULT '23:00:00',
  `twilio_principal` tinyint(1) NOT NULL DEFAULT 1,
  `instancia_interno` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_interno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chat_api` tinyint(1) NOT NULL DEFAULT 0,
  `instancia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_chatapi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `plan_status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVO',
  `whatsapp_conexion` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `principal`, `code_intel`, `ruc`, `company_name`, `company_color`, `comercial_name`, `company_description`, `legal_representative`, `address`, `phone`, `email`, `photo`, `url`, `conexion`, `imprimir_comprobantes`, `ip`, `latitud`, `longitud`, `electronica`, `contribuyente_especial`, `obligado_contabilidad`, `hora_inicio`, `hora_fin`, `twilio_principal`, `instancia_interno`, `token_interno`, `chat_api`, `instancia`, `token_chatapi`, `plan_id`, `plan_status`, `whatsapp_conexion`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 99, '1700000000001', 'SIGCRM', '#3274b1', 'SIGCRM', NULL, 'CRISTIAN', 'AV. PORTUGAL Y SHIRYS', '0996432301', 'john-hy@hotmail.fr', NULL, 'https://sigcrm.pro', 1, 'S', NULL, NULL, NULL, 1, NULL, NULL, '09:00:00', '23:00:00', 1, NULL, NULL, 1, '328730', '95yo4qmlodpheo40', NULL, 'INACTIVO', 0, 1, '2020-05-16 04:25:28', '2022-10-24 21:08:32'),
(3, 0, 99, '0914301635001', 'UCIMEDIC', '#91c41e', 'UCIMEDIC', NULL, 'UCIMEDIC', 'CDLA BOLIVARIANA MZ D VILLA  6', '042295583', 'laboratorio@ucimedic.com.ec', NULL, 'https://ucimedic.ddns.net:8085', 1, 'S', NULL, '-0.161243', '-78.485066', 1, NULL, NULL, '09:00:00', '23:00:00', 1, NULL, NULL, 0, NULL, '', NULL, 'INACTIVO', 0, 1, NULL, '2022-10-21 09:19:02'),
(18, 0, 5, '1717151201001', 'INTELHO PROD', '', 'INTELHO', NULL, NULL, NULL, '0223340392/0998', 'tecnico@intelho.com', NULL, 'https://sigcenter.com', 1, 'S', NULL, '-0.09663057683770108', '-78.51731071740657', 0, NULL, NULL, '09:00:00', '23:00:00', 1, NULL, NULL, 0, NULL, NULL, NULL, 'INACTIVO', 0, 1, '2022-09-22 17:48:08', '2022-10-21 09:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_services`
--

CREATE TABLE `company_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`, `iso`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', NULL, 1, NULL, '2021-09-07 14:19:27'),
(2, 'Albania', 'AL', NULL, 1, NULL, NULL),
(3, 'Algeria', 'DZ', NULL, 1, NULL, NULL),
(4, 'American Samoa', 'AS', NULL, 1, NULL, NULL),
(5, 'Andorra', 'AD', NULL, 1, NULL, NULL),
(6, 'Angola', 'AO', NULL, 1, NULL, NULL),
(7, 'Anguilla', 'AI', NULL, 1, NULL, NULL),
(8, 'Antarctica', 'AQ', NULL, 1, NULL, NULL),
(9, 'Antigua and Barbuda', 'AG', NULL, 1, NULL, NULL),
(10, 'Argentina', 'AR', NULL, 1, NULL, NULL),
(11, 'Armenia', 'AM', NULL, 1, NULL, NULL),
(12, 'Aruba', 'AW', NULL, 1, NULL, NULL),
(13, 'Australia', 'AU', NULL, 1, NULL, NULL),
(14, 'Austria', 'AT', NULL, 1, NULL, NULL),
(15, 'Azerbaijan', 'AZ', NULL, 1, NULL, NULL),
(16, 'Bahamas', 'BS', NULL, 1, NULL, NULL),
(17, 'Bahrain', 'BH', NULL, 1, NULL, NULL),
(18, 'Bangladesh', 'BD', NULL, 1, NULL, NULL),
(19, 'Barbados', 'BB', NULL, 1, NULL, NULL),
(20, 'Belarus', 'BY', NULL, 1, NULL, NULL),
(21, 'Belgium', 'BE', NULL, 1, NULL, NULL),
(22, 'Belize', 'BZ', NULL, 1, NULL, NULL),
(23, 'Benin', 'BJ', NULL, 1, NULL, NULL),
(24, 'Bermuda', 'BM', NULL, 1, NULL, NULL),
(25, 'Bhutan', 'BT', NULL, 1, NULL, NULL),
(26, 'Bosnia and Herzegovina', 'BA', NULL, 1, NULL, NULL),
(27, 'Botswana', 'BW', NULL, 1, NULL, NULL),
(28, 'Bouvet Island', 'BV', NULL, 1, NULL, NULL),
(29, 'Brazil', 'BR', NULL, 1, NULL, NULL),
(30, 'British Indian Ocean Territory', 'IO', NULL, 1, NULL, NULL),
(31, 'Brunei Darussalam', 'BN', NULL, 1, NULL, NULL),
(32, 'Bulgaria', 'BG', NULL, 1, NULL, NULL),
(33, 'Burkina Faso', 'BF', NULL, 1, NULL, NULL),
(34, 'Burundi', 'BI', NULL, 1, NULL, NULL),
(35, 'Cambodia', 'KH', NULL, 1, NULL, NULL),
(36, 'Cameroon', 'CM', NULL, 1, NULL, NULL),
(37, 'Canada', 'CA', NULL, 1, NULL, NULL),
(38, 'Cape Verde', 'CV', NULL, 1, NULL, NULL),
(39, 'Cayman Islands', 'KY', NULL, 1, NULL, NULL),
(40, 'Central African Republic', 'CF', NULL, 1, NULL, NULL),
(41, 'Chad', 'TD', NULL, 1, NULL, NULL),
(42, 'Chile', 'CL', NULL, 1, NULL, NULL),
(43, 'China', 'CN', NULL, 1, NULL, NULL),
(44, 'Christmas Island', 'CX', NULL, 1, NULL, NULL),
(45, 'Cocos (Keeling) Islands', 'CC', NULL, 1, NULL, NULL),
(46, 'Colombia', 'CO', NULL, 1, NULL, NULL),
(47, 'Comoros', 'KM', NULL, 1, NULL, NULL),
(48, 'Congo', 'CG', NULL, 1, NULL, NULL),
(49, 'Cook Islands', 'CK', NULL, 1, NULL, NULL),
(50, 'Costa Rica', 'CR', NULL, 1, NULL, NULL),
(51, 'Croatia', 'HR', NULL, 1, NULL, NULL),
(52, 'Cuba', 'CU', NULL, 1, NULL, NULL),
(53, 'Cyprus', 'CY', NULL, 1, NULL, NULL),
(54, 'Czech Republic', 'CZ', NULL, 1, NULL, NULL),
(55, 'Denmark', 'DK', NULL, 1, NULL, NULL),
(56, 'Djibouti', 'DJ', NULL, 1, NULL, NULL),
(57, 'Dominica', 'DM', NULL, 1, NULL, NULL),
(58, 'Dominican Republic', 'DO', NULL, 1, NULL, NULL),
(59, 'Ecuador', 'EC', '593', 1, NULL, '2021-09-07 14:19:38'),
(60, 'Egypt', 'EG', NULL, 1, NULL, NULL),
(61, 'El Salvador', 'SV', NULL, 1, NULL, NULL),
(62, 'Equatorial Guinea', 'GQ', NULL, 1, NULL, NULL),
(63, 'Eritrea', 'ER', NULL, 1, NULL, NULL),
(64, 'Estonia', 'EE', NULL, 1, NULL, NULL),
(65, 'Ethiopia', 'ET', NULL, 1, NULL, NULL),
(66, 'Falkland Islands (Malvinas)', 'FK', NULL, 1, NULL, NULL),
(67, 'Faroe Islands', 'FO', NULL, 1, NULL, NULL),
(68, 'Fiji', 'FJ', NULL, 1, NULL, NULL),
(69, 'Finland', 'FI', NULL, 1, NULL, NULL),
(70, 'France', 'FR', NULL, 1, NULL, NULL),
(71, 'French Guiana', 'GF', NULL, 1, NULL, NULL),
(72, 'French Polynesia', 'PF', NULL, 1, NULL, NULL),
(73, 'French Southern Territories', 'TF', NULL, 1, NULL, NULL),
(74, 'Gabon', 'GA', NULL, 1, NULL, NULL),
(75, 'Gambia', 'GM', NULL, 1, NULL, NULL),
(76, 'Georgia', 'GE', NULL, 1, NULL, NULL),
(77, 'Germany', 'DE', NULL, 1, NULL, NULL),
(78, 'Ghana', 'GH', NULL, 1, NULL, NULL),
(79, 'Gibraltar', 'GI', NULL, 1, NULL, NULL),
(80, 'Greece', 'GR', NULL, 1, NULL, NULL),
(81, 'Greenland', 'GL', NULL, 1, NULL, NULL),
(82, 'Grenada', 'GD', NULL, 1, NULL, NULL),
(83, 'Guadeloupe', 'GP', NULL, 1, NULL, NULL),
(84, 'Guam', 'GU', NULL, 1, NULL, NULL),
(85, 'Guatemala', 'GT', NULL, 1, NULL, NULL),
(86, 'Guernsey', 'GG', NULL, 1, NULL, NULL),
(87, 'Guinea', 'GN', NULL, 1, NULL, NULL),
(88, 'Guinea-Bissau', 'GW', NULL, 1, NULL, NULL),
(89, 'Guyana', 'GY', NULL, 1, NULL, NULL),
(90, 'Haiti', 'HT', NULL, 1, NULL, NULL),
(91, 'Heard Island and McDonald Islands', 'HM', NULL, 1, NULL, NULL),
(92, 'Holy See (Vatican City State)', 'VA', NULL, 1, NULL, NULL),
(93, 'Honduras', 'HN', NULL, 1, NULL, NULL),
(94, 'Hong Kong', 'HK', NULL, 1, NULL, NULL),
(95, 'Hungary', 'HU', NULL, 1, NULL, NULL),
(96, 'Iceland', 'IS', NULL, 1, NULL, NULL),
(97, 'India', 'IN', NULL, 1, NULL, NULL),
(98, 'Indonesia', 'ID', NULL, 1, NULL, NULL),
(99, 'Iraq', 'IQ', NULL, 1, NULL, NULL),
(100, 'Ireland', 'IE', NULL, 1, NULL, NULL),
(101, 'Isle of Man', 'IM', NULL, 1, NULL, NULL),
(102, 'Israel', 'IL', NULL, 1, NULL, NULL),
(103, 'Italy', 'IT', NULL, 1, NULL, NULL),
(104, 'Jamaica', 'JM', NULL, 1, NULL, NULL),
(105, 'Japan', 'JP', NULL, 1, NULL, NULL),
(106, 'Jersey', 'JE', NULL, 1, NULL, NULL),
(107, 'Jordan', 'JO', NULL, 1, NULL, NULL),
(108, 'Kazakhstan', 'KZ', NULL, 1, NULL, NULL),
(109, 'Kenya', 'KE', NULL, 1, NULL, NULL),
(110, 'Kiribati', 'KI', NULL, 1, NULL, NULL),
(111, 'Kuwait', 'KW', NULL, 1, NULL, NULL),
(112, 'Kyrgyzstan', 'KG', NULL, 1, NULL, NULL),
(113, 'Lao Peoples Democratic Republic', 'LA', NULL, 1, NULL, NULL),
(114, 'Latvia', 'LV', NULL, 1, NULL, NULL),
(115, 'Lebanon', 'LB', NULL, 1, NULL, NULL),
(116, 'Lesotho', 'LS', NULL, 1, NULL, NULL),
(117, 'Liberia', 'LR', NULL, 1, NULL, NULL),
(118, 'Libya', 'LY', NULL, 1, NULL, NULL),
(119, 'Liechtenstein', 'LI', NULL, 1, NULL, NULL),
(120, 'Lithuania', 'LT', NULL, 1, NULL, NULL),
(121, 'Luxembourg', 'LU', NULL, 1, NULL, NULL),
(122, 'Macao', 'MO', NULL, 1, NULL, NULL),
(123, 'Madagascar', 'MG', NULL, 1, NULL, NULL),
(124, 'Malawi', 'MW', NULL, 1, NULL, NULL),
(125, 'Malaysia', 'MY', NULL, 1, NULL, NULL),
(126, 'Maldives', 'MV', NULL, 1, NULL, NULL),
(127, 'Mali', 'ML', NULL, 1, NULL, NULL),
(128, 'Malta', 'MT', NULL, 1, NULL, NULL),
(129, 'Marshall Islands', 'MH', NULL, 1, NULL, NULL),
(130, 'Martinique', 'MQ', NULL, 1, NULL, NULL),
(131, 'Mauritania', 'MR', NULL, 1, NULL, NULL),
(132, 'Mauritius', 'MU', NULL, 1, NULL, NULL),
(133, 'Mayotte', 'YT', NULL, 1, NULL, NULL),
(134, 'Mexico', 'MX', NULL, 1, NULL, NULL),
(135, 'Monaco', 'MC', NULL, 1, NULL, NULL),
(136, 'Mongolia', 'MN', NULL, 1, NULL, NULL),
(137, 'Montenegro', 'ME', NULL, 1, NULL, NULL),
(138, 'Montserrat', 'MS', NULL, 1, NULL, NULL),
(139, 'Morocco', 'MA', NULL, 1, NULL, NULL),
(140, 'Mozambique', 'MZ', NULL, 1, NULL, NULL),
(141, 'Myanmar', 'MM', NULL, 1, NULL, NULL),
(142, 'Namibia', 'NA', NULL, 1, NULL, NULL),
(143, 'Nauru', 'NR', NULL, 1, NULL, NULL),
(144, 'Nepal', 'NP', NULL, 1, NULL, NULL),
(145, 'Netherlands', 'NL', NULL, 1, NULL, NULL),
(146, 'New Caledonia', 'NC', NULL, 1, NULL, NULL),
(147, 'New Zealand', 'NZ', NULL, 1, NULL, NULL),
(148, 'Nicaragua', 'NI', NULL, 1, NULL, NULL),
(149, 'Niger', 'NE', NULL, 1, NULL, NULL),
(150, 'Nigeria', 'NG', NULL, 1, NULL, NULL),
(151, 'Niue', 'NU', NULL, 1, NULL, NULL),
(152, 'Norfolk Island', 'NF', NULL, 1, NULL, NULL),
(153, 'Northern Mariana Islands', 'MP', NULL, 1, NULL, NULL),
(154, 'Norway', 'NO', NULL, 1, NULL, NULL),
(155, 'Oman', 'OM', NULL, 1, NULL, NULL),
(156, 'Pakistan', 'PK', NULL, 1, NULL, NULL),
(157, 'Palau', 'PW', NULL, 1, NULL, NULL),
(158, 'Panama', 'PA', NULL, 1, NULL, NULL),
(159, 'Papua New Guinea', 'PG', NULL, 1, NULL, NULL),
(160, 'Paraguay', 'PY', NULL, 1, NULL, NULL),
(161, 'Peru', 'PE', NULL, 1, NULL, NULL),
(162, 'Philippines', 'PH', NULL, 1, NULL, NULL),
(163, 'Pitcairn', 'PN', NULL, 1, NULL, NULL),
(164, 'Poland', 'PL', NULL, 1, NULL, NULL),
(165, 'Portugal', 'PT', NULL, 1, NULL, NULL),
(166, 'Puerto Rico', 'PR', NULL, 1, NULL, NULL),
(167, 'Qatar', 'QA', NULL, 1, NULL, NULL),
(168, 'Romania', 'RO', NULL, 1, NULL, NULL),
(169, 'Russian Federation', 'RU', NULL, 1, NULL, NULL),
(170, 'Rwanda', 'RW', NULL, 1, NULL, NULL),
(171, 'Saint Kitts and Nevis', 'KN', NULL, 1, NULL, NULL),
(172, 'Saint Lucia', 'LC', NULL, 1, NULL, NULL),
(173, 'Saint Martin (French part)', 'MF', NULL, 1, NULL, NULL),
(174, 'Saint Pierre and Miquelon', 'PM', NULL, 1, NULL, NULL),
(175, 'Saint Vincent and the Grenadines', 'VC', NULL, 1, NULL, NULL),
(176, 'Samoa', 'WS', NULL, 1, NULL, NULL),
(177, 'San Marino', 'SM', NULL, 1, NULL, NULL),
(178, 'Sao Tome and Principe', 'ST', NULL, 1, NULL, NULL),
(179, 'Saudi Arabia', 'SA', NULL, 1, NULL, NULL),
(180, 'Senegal', 'SN', NULL, 1, NULL, NULL),
(181, 'Serbia', 'RS', NULL, 1, NULL, NULL),
(182, 'Seychelles', 'SC', NULL, 1, NULL, NULL),
(183, 'Sierra Leone', 'SL', NULL, 1, NULL, NULL),
(184, 'Singapore', 'SG', NULL, 1, NULL, NULL),
(185, 'Sint Maarten (Dutch part)', 'SX', NULL, 1, NULL, NULL),
(186, 'Slovakia', 'SK', NULL, 1, NULL, NULL),
(187, 'Slovenia', 'SI', NULL, 1, NULL, NULL),
(188, 'Solomon Islands', 'SB', NULL, 1, NULL, NULL),
(189, 'Somalia', 'SO', NULL, 1, NULL, NULL),
(190, 'South Africa', 'ZA', NULL, 1, NULL, NULL),
(191, 'South Georgia and the South Sandwich Islands', 'GS', NULL, 1, NULL, NULL),
(192, 'South Sudan', 'SS', NULL, 1, NULL, NULL),
(193, 'Spain', 'ES', NULL, 1, NULL, NULL),
(194, 'Sri Lanka', 'LK', NULL, 1, NULL, NULL),
(195, 'Sudan', 'SD', NULL, 1, NULL, NULL),
(196, 'Suriname', 'SR', NULL, 1, NULL, NULL),
(197, 'Svalbard and Jan Mayen', 'SJ', NULL, 1, NULL, NULL),
(198, 'Swaziland', 'SZ', NULL, 1, NULL, NULL),
(199, 'Sweden', 'SE', NULL, 1, NULL, NULL),
(200, 'Switzerland', 'CH', NULL, 1, NULL, NULL),
(201, 'Syrian Arab Republic', 'SY', NULL, 1, NULL, NULL),
(202, 'Tajikistan', 'TJ', NULL, 1, NULL, NULL),
(203, 'Thailand', 'TH', NULL, 1, NULL, NULL),
(204, 'Timor-Leste', 'TL', NULL, 1, NULL, NULL),
(205, 'Togo', 'TG', NULL, 1, NULL, NULL),
(206, 'Tokelau', 'TK', NULL, 1, NULL, NULL),
(207, 'Tonga', 'TO', NULL, 1, NULL, NULL),
(208, 'Trinidad and Tobago', 'TT', NULL, 1, NULL, NULL),
(209, 'Tunisia', 'TN', NULL, 1, NULL, NULL),
(210, 'Turkey', 'TR', NULL, 1, NULL, NULL),
(211, 'Turkmenistan', 'TM', NULL, 1, NULL, NULL),
(212, 'Turks and Caicos Islands', 'TC', NULL, 1, NULL, NULL),
(213, 'Tuvalu', 'TV', NULL, 1, NULL, NULL),
(214, 'Uganda', 'UG', NULL, 1, NULL, NULL),
(215, 'Ukraine', 'UA', NULL, 1, NULL, NULL),
(216, 'United Arab Emirates', 'AE', NULL, 1, NULL, NULL),
(217, 'United Kingdom', 'GB', NULL, 1, NULL, NULL),
(218, 'United States', 'US', NULL, 1, NULL, NULL),
(219, 'United States Minor Outlying Islands', 'UM', NULL, 1, NULL, NULL),
(220, 'Uruguay', 'UY', NULL, 1, NULL, NULL),
(221, 'Uzbekistan', 'UZ', NULL, 1, NULL, NULL),
(222, 'Vanuatu', 'VU', NULL, 1, NULL, NULL),
(223, 'Viet Nam', 'VN', NULL, 1, NULL, NULL),
(224, 'Wallis and Futuna', 'WF', NULL, 1, NULL, NULL),
(225, 'Western Sahara', 'EH', NULL, 1, NULL, NULL),
(226, 'Yemen', 'YE', NULL, 1, NULL, NULL),
(227, 'Zambia', 'ZM', NULL, 1, NULL, NULL),
(228, 'Zimbabwe', 'ZW', NULL, 1, NULL, NULL),
(231, 'ECUADOR', '', '241', 1, '2021-09-13 18:48:25', '2021-09-13 18:48:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `company_assigned_id` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_document` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_documento` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentesco_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_parentesco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_identificacion_parentesco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_1` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_3` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `customer_address_id` int(11) DEFAULT NULL,
  `nationality` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `company_id`, `sede_id`, `company_assigned_id`, `name`, `nombres`, `apellidos`, `type_document`, `numero_documento`, `direccion`, `parentesco_customer`, `name_parentesco`, `numero_identificacion_parentesco`, `latitud`, `longitud`, `telefono`, `celular_1`, `celular_2`, `celular_3`, `correo`, `birth_date`, `customer_address_id`, `nationality`, `sex`, `status`, `created_at`, `updated_at`) VALUES
(15, 1, NULL, NULL, 'JOHN', 'JOHN FABRICIO', 'TELLO CULQUI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '593996432301', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_address`
--

CREATE TABLE `customer_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer_address`
--

INSERT INTO `customer_address` (`id`, `company_id`, `customer_id`, `text`, `country_id`, `region_id`, `city_id`, `latitud`, `longitud`, `status`, `created_at`, `updated_at`) VALUES
(8, NULL, 1, 'La Planada n76 y oE17a', NULL, NULL, NULL, '-0.0971014', '-78.5169816', 1, NULL, NULL),
(9, NULL, 1, 'Carcelen Alto frente a las canchas\r\n', NULL, NULL, NULL, '-0.10737185071722712', '-78.45679438527564', 1, NULL, NULL),
(11, NULL, 1, 'ubicasion temporal', NULL, NULL, NULL, '-0.0970976', '-78.5169768', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date_send_massive`
--

CREATE TABLE `date_send_massive` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_header` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `massive_header_id` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hour_created` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departament`
--

CREATE TABLE `departament` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor_especialidad`
--

CREATE TABLE `doctor_especialidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `especialidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hour_start` time DEFAULT NULL,
  `hour_end` time DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `date_total` int(11) DEFAULT NULL,
  `interval` int(11) DEFAULT NULL,
  `sede_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departament_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departament_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_detail`
--

CREATE TABLE `envios_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `envios_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensaje` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_envio` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_enviado` date DEFAULT NULL,
  `time_enviado` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `envios_detail`
--

INSERT INTO `envios_detail` (`id`, `date_created`, `company_id`, `customer_id`, `envios_header_id`, `phone`, `mensaje`, `estado_envio`, `date_enviado`, `time_enviado`, `status`, `created_at`, `updated_at`) VALUES
(12, '2022-10-20', 18, 12, 8, '0996432301', 'hola desde campanias segmentadas', 'ENVIADO', '2022-10-20', '16:05:06', 1, '2022-10-20 16:04:40', '2022-10-20 16:05:06'),
(13, '2022-10-20', 18, 13, 9, '0996432301', 'hola debe ser enviado a las 16:08', 'ENVIADO', '2022-10-20', '16:08:11', 1, '2022-10-20 16:06:42', '2022-10-20 16:08:11'),
(14, '2022-10-20', 18, 14, 10, '0996432301', 'Hola John Hermoso', 'ENVIADO', '2022-10-20', '16:11:18', 1, '2022-10-20 16:11:14', '2022-10-20 16:11:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_header`
--

CREATE TABLE `envios_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `envio_ahora` tinyint(1) NOT NULL DEFAULT 0,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_intel` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_envio` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad_destinos` int(11) DEFAULT NULL,
  `mensaje_defecto` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `envio_inmediato` tinyint(1) NOT NULL DEFAULT 0,
  `envio_programado` tinyint(1) NOT NULL DEFAULT 0,
  `date_programado` date DEFAULT NULL,
  `time_programado` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `envios_header`
--

INSERT INTO `envios_header` (`id`, `envio_ahora`, `company_id`, `code_intel`, `date_created`, `description`, `tipo`, `estado_envio`, `cantidad_destinos`, `mensaje_defecto`, `envio_inmediato`, `envio_programado`, `date_programado`, `time_programado`, `status`, `created_at`, `updated_at`) VALUES
(8, 0, 18, 5, '2022-10-20', 'ENVIO MASIVO NUEVO', 'CAMPANIA', 'ENVIADO', 1, NULL, 1, 0, NULL, NULL, 1, '2022-10-20 16:04:40', '2022-10-20 16:05:06'),
(9, 0, 18, 5, '2022-10-20', 'ENVIO MASIVO NUEVO', 'CAMPANIA', 'ENVIADO', 1, NULL, 0, 1, '2022-10-20', '16:08:00', 1, '2022-10-20 16:06:42', '2022-10-20 16:08:11'),
(10, 0, 18, 5, '2022-10-20', 'ENVIO MASIVO NUEVO', 'MASIVO', 'ENVIADO', 1, NULL, 1, 0, NULL, NULL, 1, '2022-10-20 16:11:14', '2022-10-20 16:11:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `machine_mindray`
--

CREATE TABLE `machine_mindray` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(8000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `massive_detail`
--

CREATE TABLE `massive_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_header` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `massive_header_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship_type` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citizenship_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `envios` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `massive_header`
--

CREATE TABLE `massive_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bot_header_id` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hour_created` time DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicine`
--

CREATE TABLE `medicine` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `icono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `menu_id`, `nombre`, `url`, `orden`, `icono`, `created_at`, `updated_at`) VALUES
(4, 0, 'Productos', '/productos', 0, 'fa-fa productos', '2026-05-31 16:55:31', '2026-05-31 16:55:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_rol`
--

CREATE TABLE `menu_rol` (
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `menu_rol`
--

INSERT INTO `menu_rol` (`rol_id`, `menu_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_004341_create_company_table', 21),
(2, '2014_10_12_000000_create_users_table', 18),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_02_16_114729_create_permiso_table', 1),
(7, '2020_02_16_114819_create_usuario_rol_table', 1),
(8, '2020_02_16_114933_create_permiso_rol_table', 1),
(9, '2020_02_16_115013_create_menu_table', 1),
(10, '2020_02_16_115645_create_menu_rol_table', 1),
(16, '2020_05_14_024935_create_product_table', 19),
(20, '2020_04_27_130454_create_customer_table', 3),
(45, '2020_02_16_114643_create_rol_table', 16),
(56, '2020_05_14_020000_create_category_table', 22),
(115, '2021_06_03_154903_create_services_table', 23),
(116, '2021_06_03_154936_create_company_services_table', 23),
(117, '2021_06_04_165742_create_send_header_table', 23),
(118, '2021_06_04_165808_create_send_detail_table', 23),
(119, '2016_06_01_000001_create_oauth_auth_codes_table', 24),
(120, '2016_06_01_000002_create_oauth_access_tokens_table', 24),
(121, '2016_06_01_000003_create_oauth_refresh_tokens_table', 24),
(122, '2016_06_01_000004_create_oauth_clients_table', 24),
(123, '2016_06_01_000005_create_oauth_personal_access_clients_table', 24),
(124, '2021_06_16_095641_create_plan_table', 25),
(125, '2021_06_16_095717_create_suscription_table', 25),
(126, '2021_06_17_112439_create_plan_services_table', 26),
(127, '2021_06_18_094409_create_campania_table', 27),
(128, '2021_06_23_174139_create_machine_mindray_table', 28),
(129, '2021_09_06_141344_create_customer_address_table', 29),
(130, '2021_09_06_141824_create_country_table', 29),
(131, '2021_09_06_141835_create_city_table', 29),
(132, '2021_09_06_141846_create_region_table', 29),
(133, '2021_09_09_111152_create_type_affiliation_table', 30),
(134, '2021_09_09_111206_create_affiliation_table', 30),
(160, '2021_09_09_111307_create_procedures_table', 31),
(161, '2021_09_09_111324_create_doctor_table', 31),
(162, '2021_09_09_111333_create_sede_table', 31),
(163, '2021_09_09_111344_create_departament_table', 31),
(164, '2021_09_09_111357_create_atention_header_table', 31),
(165, '2021_09_09_111407_create_atention_detail_table', 31),
(166, '2021_11_10_165010_create_doctor_schedule_table', 31),
(167, '2021_11_12_143355_create_especialidad_table', 31),
(168, '2021_11_12_143617_create_doctor_especialidad_table', 31),
(169, '2021_11_18_151222_create_bot_header_table', 31),
(174, '2021_12_28_060103_create_medicine_table', 31),
(176, '2021_12_28_060111_create_atention_medicine_table', 32),
(179, '2022_01_12_081343_create_api_header_table', 35),
(180, '2022_01_12_081457_create_api_detail_table', 35),
(181, '2021_11_18_151356_create_bot_detail_table', 36),
(182, '2021_11_18_151415_create_bot_historial_table', 36),
(183, '2021_11_18_151436_create_chat_bot_header_table', 37),
(184, '2021_11_18_151454_create_chat_bot_detail_table', 37),
(185, '2022_01_14_123154_create_api_parameters_table', 38),
(186, '2022_03_23_113108_add_first_message_to_bot_detail', 39),
(187, '2022_03_23_143659_add_first_message_to_chat_bot_detail', 40),
(188, '2022_04_08_115647_add_pay_to_bot_detail', 41),
(189, '2022_04_08_120357_add_smart_link_pay_to_bot_detail', 42),
(190, '2022_04_13_085233_add_need_table_to_api_header', 43),
(191, '2022_04_13_153121_add_api_header_id_to_chat_bot_detail', 44),
(192, '2022_05_09_170108_add_chat_api_to_company', 45),
(193, '2022_05_09_224517_add_company_assigned_id_to_chat_bot_header', 46),
(194, '2022_05_11_102638_add_principal_to_sede', 46),
(195, '2022_05_11_102839_add_latitud_to_sede', 46),
(196, '2022_05_11_102900_add_longitud_to_sede', 46),
(197, '2022_05_11_115502_add_instancia_to_sede', 46),
(198, '2022_05_11_115519_add_token_to_sede', 46),
(199, '2022_05_12_162148_create_bot_customer_response_table', 47),
(200, '2022_05_12_165833_change_company_assigned_id_to_chat_bot_header', 47),
(201, '2022_05_12_170044_add_company_assigned_id_to_customer', 47),
(202, '2022_05_12_173141_add_chat_bot_header_id_to_bot_customer_response', 47),
(203, '2022_05_16_105650_add_pay_smart_link_url_to_chat_bot_header', 48),
(204, '2022_05_16_105805_add_pay_smart_link_to_chat_bot_header', 48),
(205, '2022_05_16_105902_add_pay_payment_method_to_chat_bot_header', 48),
(206, '2022_05_16_105958_add_pay_ticket_number_to_chat_bot_header', 48),
(207, '2022_05_16_110037_add_pay_status_to_chat_bot_header', 48),
(208, '2022_05_16_221240_create_bot_intention_table', 49),
(209, '2022_05_16_222035_create_api_intention_table', 49),
(210, '2022_05_18_152636_add_close_chat_to_bot_detail', 50),
(211, '2022_05_19_102251_add_alias_to_api_detail', 51),
(212, '2022_06_14_184216_add_path_file_to_bot_detail', 52),
(213, '2022_06_14_184348_add_name_file_to_bot_detail', 52),
(214, '2022_06_14_213043_create_massive_header_table', 53),
(215, '2022_06_14_213151_create_massive_detail_table', 53),
(216, '2022_06_14_213318_create_date_send_massive_table', 53),
(217, '2022_06_15_133827_add_json_response_to_bot_customer_response', 54),
(218, '2022_06_15_133834_add_index_response_to_bot_customer_response', 54),
(219, '2022_06_16_190534_add_fecha_agenda_to_bot_detail', 55),
(220, '2022_06_17_154052_add_pago_kushki_to_bot_detail', 55),
(221, '2022_06_20_153904_add_customer_factura_id_to_chat_bot_header', 55),
(222, '2022_06_20_162859_add_factura_ruc_to_chat_bot_header', 55),
(223, '2022_06_20_162915_add_factura_nombres_to_chat_bot_header', 55),
(224, '2022_06_20_162925_add_factura_apellidos_to_chat_bot_header', 55),
(225, '2022_06_20_163000_add_factura_nacimiento_to_chat_bot_header', 55),
(226, '2022_06_20_163031_add_factura_email_to_chat_bot_header', 55),
(227, '2022_06_20_163040_add_factura_celular_to_chat_bot_header', 55),
(228, '2022_06_20_164429_add_factura_direccion_to_chat_bot_header', 55),
(229, '2022_08_24_184836_create_msp_cookies_table', 55),
(230, '2022_09_08_172556_create_pagos_header_table', 56),
(231, '2022_09_08_172638_create_pagos_detail_table', 56),
(232, '2022_09_13_110337_add_intention_id_to_bot_detail', 57),
(233, '2022_09_14_120538_add_citrix_ns_id_to_msp_cookies', 58),
(234, '2022_09_14_120552_add_citrix_wat_to_msp_cookies', 58),
(235, '2022_09_14_120602_add_citrix_wlf_to_msp_cookies', 58),
(236, '2022_09_14_212847_add_home_to_bot_detail', 59),
(237, '2022_09_14_212859_add_back_to_bot_detail', 59),
(238, '2022_09_15_090125_add_home_codigo_to_bot_header', 60),
(239, '2022_09_15_090133_add_home_texto_to_bot_header', 60),
(240, '2022_09_15_090159_add_back_codigo_to_bot_header', 60),
(241, '2022_09_15_090210_add_back_texto_to_bot_header', 60),
(242, '2022_09_15_094508_add_home_principal_to_bot_detail', 61),
(243, '2022_09_15_173959_change_pay_status_to_pagos_header', 62),
(244, '2022_09_15_174231_change_pay_status_to_pagos_detail', 62),
(245, '2022_09_15_174424_add_code_kushki_to_pagos_detail', 62),
(246, '2022_09_22_205409_add_sede_id_to_chat_bot_header', 63),
(247, '2022_09_22_205959_add_sede_id_to_customer', 64),
(248, '2022_09_27_114942_create_twilio_credenciales_table', 65),
(249, '2022_09_27_115657_add_twilio_principal_to_company', 65),
(250, '2022_09_27_165029_add_file_extention_to_bot_detail', 66),
(251, '2022_09_28_174239_add_kushki_id_to_pagos_detail', 67),
(252, '2022_09_29_231009_create_bot_conection_table', 68),
(253, '2022_09_29_231857_add_bot_conection_id_to_chat_bot_header', 68),
(254, '2022_09_29_232002_add_calcular_sede_proxima_to_bot_header', 68),
(255, '2022_09_29_233420_add_bot_conection_id_to_bot_historial', 69),
(256, '2022_09_29_234305_add_bot_conection_id_to_bot_header', 70),
(257, '2022_09_29_234558_add_bot_conection_id_to_chat_bot_header', 70),
(258, '2022_09_30_080238_add_city_id_to_sede', 71),
(259, '2022_10_07_091842_create_envios_header_table', 72),
(260, '2022_10_07_091849_create_envios_detail_table', 72),
(261, '2022_10_20_173954_add_whatsapp_conexion_to_company', 73),
(262, '2022_10_21_155225_add_agente_to_chat_bot_header', 74),
(263, '2022_10_24_142503_add_status_venta_to_chat_bot_header', 75),
(264, '2022_10_24_190637_add_user_write_id_to_chat_bot_detail', 75),
(265, '2022_10_24_190913_add_user_assigned_id_to_chat_bot_header', 75),
(266, '2022_10_25_093154_add_menu_type_to_rol', 75),
(267, '2022_10_25_140554_create_category_message_table', 75),
(268, '2022_10_25_140641_create_chat_header_category_message_table', 75),
(269, '2022_10_26_161435_add_action_to_chat_bot_detail', 75),
(270, '2022_10_26_170643_add_agent_start_to_bot_detail', 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msp_cookies`
--

CREATE TABLE `msp_cookies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `sesion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookie` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citrix_ns_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citrix_wat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `citrix_wlf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `msp_cookies`
--

INSERT INTO `msp_cookies` (`id`, `date_created`, `sesion`, `cookie`, `citrix_ns_id`, `citrix_wat`, `citrix_wlf`, `date_expired`, `created_at`, `updated_at`) VALUES
(153, '2022-10-24', '6cnq83e2igo9k4r7moboloia41', 'ffffffff09487a0545525d5f4f58455e445a4a423660', '', '', '', '2022-10-24 14:01:07', '2022-10-24 08:01:08', '2022-10-24 08:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_detail`
--

CREATE TABLE `pagos_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `chat_bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pagos_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_kushki` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kushki_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_header`
--

CREATE TABLE `pagos_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `chat_bot_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_smart_link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_smart_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `permiso_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `year_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `color_1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#EF5A5C',
  `color_2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#EF5A5C',
  `color_3` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#EF5A5C',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `name`, `month_price`, `year_price`, `color_1`, `color_2`, `color_3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BASICO', '15.00', '125.00', '#3d0af5', '#7478e7', '#270bf9', 1, '2021-06-16 15:22:47', '2021-06-22 16:17:02'),
(2, 'MEDIO', '20.00', '175.00', '#608BB4', '#78AEE1', '#78AEE1', 1, '2021-06-16 15:22:47', '2021-06-16 15:22:47'),
(3, 'PRO', '30.00', '300.00', '#57AC57', '#71DF71', '#71DF71', 1, '2021-06-16 15:22:47', '2021-06-16 15:22:47'),
(4, 'PREMIUN', '45.00', '375.00', '#6d6d6d', '#b7b7b7', '#b7b7b7', 1, '2021-06-16 15:22:47', '2021-06-18 17:45:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_services`
--

CREATE TABLE `plan_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_services`
--

INSERT INTO `plan_services` (`id`, `plan_id`, `service_id`, `name`, `cantidad`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'WHATSAPP', 500, 1, '2021-06-22 16:17:02', '2021-06-22 16:17:02'),
(5, 1, 2, 'SMS', 500, 1, '2021-06-22 16:17:02', '2021-06-22 16:17:02'),
(6, 1, 3, 'EMAIL', 1000, 1, '2021-06-22 16:17:02', '2021-06-22 16:17:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('forge', '[{\"db\":\"sigcrmprod\",\"table\":\"chat_bot_detail\"},{\"db\":\"sigcrmprod\",\"table\":\"chat_bot_header\"},{\"db\":\"sigcrmprod\",\"table\":\"customer\"},{\"db\":\"sigcrmprod\",\"table\":\"pagos_header\"},{\"db\":\"sigcrmprod\",\"table\":\"pagos_detail\"},{\"db\":\"sigcrmprod\",\"table\":\"users\"},{\"db\":\"sigcrmprod\",\"table\":\"rol\"},{\"db\":\"sigcrmprod\",\"table\":\"company\"},{\"db\":\"sigcrmprod\",\"table\":\"envios_header\"},{\"db\":\"sigcrmprod\",\"table\":\"envios_detail\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('forge', 'sigcrmprod', 'chat_bot_detail', '{\"CREATE_TIME\":\"2022-09-06 15:15:48\",\"col_order\":[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21],\"col_visib\":[1,1,0,1,1,1,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,0]}', '2022-09-28 17:59:54'),
('forge', 'sigcrmprod', 'customer_address', '{\"sorted_col\":\"`customer_address`.`customer_id` ASC\"}', '2022-09-28 19:33:14'),
('forge', 'sigcrmprod', 'migrations', '{\"sorted_col\":\"`migrations`.`id` DESC\"}', '2022-09-22 03:08:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('forge', '2022-10-24 18:01:58', '{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedures`
--

CREATE TABLE `procedures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_larga` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_measure_id` bigint(20) UNSIGNED NOT NULL,
  `unidad_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_iva` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `costo` double(8,2) NOT NULL DEFAULT 0.00,
  `precio_a` double(8,2) NOT NULL DEFAULT 0.00,
  `precio_b` double(8,2) NOT NULL DEFAULT 0.00,
  `precio_c` double(8,2) NOT NULL DEFAULT 0.00,
  `tipo` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photoVenta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion` tinyint(1) NOT NULL DEFAULT 0,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `stock_minimo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lotes` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id`, `name`, `code`, `country_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'opcion: DE', NULL, NULL, 1, '2022-10-12 21:14:44', '2022-10-12 21:14:44'),
(2, 'opcion: OP', NULL, NULL, 1, '2022-10-12 21:16:02', '2022-10-12 21:16:02'),
(3, 'opcion: OP', NULL, NULL, 1, '2022-10-12 21:16:06', '2022-10-12 21:16:06'),
(4, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:10', '2022-10-12 21:16:10'),
(5, 'fase 1', NULL, NULL, 1, '2022-10-12 21:16:13', '2022-10-12 21:16:13'),
(6, 'opcion: DE', NULL, NULL, 1, '2022-10-12 21:16:13', '2022-10-12 21:16:13'),
(7, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:17', '2022-10-12 21:16:17'),
(8, 'fase 1', NULL, NULL, 1, '2022-10-12 21:16:22', '2022-10-12 21:16:22'),
(9, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:22', '2022-10-12 21:16:22'),
(10, 'fase 1', NULL, NULL, 1, '2022-10-12 21:16:26', '2022-10-12 21:16:26'),
(11, 'opcion: FA', NULL, NULL, 1, '2022-10-12 21:16:26', '2022-10-12 21:16:26'),
(12, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:33', '2022-10-12 21:16:33'),
(13, 'fase 1', NULL, NULL, 1, '2022-10-12 21:16:43', '2022-10-12 21:16:43'),
(14, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:43', '2022-10-12 21:16:43'),
(15, 'fase 1', NULL, NULL, 1, '2022-10-12 21:16:56', '2022-10-12 21:16:56'),
(16, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:16:56', '2022-10-12 21:16:56'),
(17, 'fase 1', NULL, NULL, 1, '2022-10-12 21:17:08', '2022-10-12 21:17:08'),
(18, 'opcion: AP', NULL, NULL, 1, '2022-10-12 21:17:08', '2022-10-12 21:17:08'),
(19, 'fase 1', NULL, NULL, 1, '2022-10-12 21:17:19', '2022-10-12 21:17:19'),
(20, 'opcion: OP', NULL, NULL, 1, '2022-10-12 21:17:19', '2022-10-12 21:17:19'),
(21, 'opcion: SL', NULL, NULL, 1, '2022-10-12 21:17:23', '2022-10-12 21:17:23'),
(22, 'opcion: PAKU', NULL, NULL, 1, '2022-10-12 21:19:12', '2022-10-12 21:19:12'),
(23, 'CREAR PACIENTE', NULL, NULL, 1, '2022-10-12 21:19:12', '2022-10-12 21:19:12'),
(24, 'PACIENTE210', NULL, NULL, 1, '2022-10-12 21:19:13', '2022-10-12 21:19:13'),
(25, 'CREAR ATENCION', NULL, NULL, 1, '2022-10-12 21:19:13', '2022-10-12 21:19:13'),
(26, 'CREAR PREFACTURA64', NULL, NULL, 1, '2022-10-12 21:19:13', '2022-10-12 21:19:13'),
(27, 'CREAR FORMA PAGO:976', NULL, NULL, 1, '2022-10-12 21:19:13', '2022-10-12 21:19:13'),
(28, 'CREAR AGENDAMIENTO64', NULL, NULL, 1, '2022-10-12 21:19:13', '2022-10-12 21:19:13'),
(29, 'msg200', NULL, NULL, 1, '2022-10-12 21:19:14', '2022-10-12 21:19:14'),
(30, '*****FIN*****', NULL, NULL, 1, '2022-10-12 21:19:14', '2022-10-12 21:19:14'),
(31, 'opcion: DE', NULL, NULL, 1, '2022-10-21 15:28:19', '2022-10-21 15:28:19'),
(32, 'opcion: DE', NULL, NULL, 1, '2022-10-21 15:31:21', '2022-10-21 15:31:21'),
(33, 'opcion: DE', NULL, NULL, 1, '2022-10-21 16:00:15', '2022-10-21 16:00:15'),
(34, 'opcion: DE', NULL, NULL, 1, '2022-10-21 16:06:04', '2022-10-21 16:06:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `menu_type` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'DEFAULT',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `user_create`, `nombre`, `observation`, `menu_type`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'SUPERADMINISTRADOR', NULL, 'DEFAULT', 1, '2020-04-13 04:19:58', '2021-05-15 23:32:56'),
(6, 1, 'ADMINISTRADOR', 'ADMINISTRADOR DE EMPRESA', 'DEFAULT', 1, '2022-10-21 10:56:51', '2022-10-21 10:56:51'),
(7, 1, 'AGENTE', 'AGENTE CRM', 'DEFAULT', 1, '2022-10-21 10:57:04', '2022-10-21 10:57:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `latitud` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instancia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id`, `company_id`, `principal`, `date_created`, `name`, `code_intel`, `city_id`, `latitud`, `longitud`, `instancia`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-05-11', 'PRINCIPAL', NULL, NULL, '-0.161243', '-78.485065', '328730', '95yo4qmlodpheo40', 1, '2022-05-11 15:41:14', '2022-05-23 20:34:59'),
(3, 3, 1, '2022-05-11', 'PRINCIPAL', NULL, NULL, '-0.161243', '-78.485066', NULL, '', 1, '2022-05-11 15:41:18', '2022-05-19 09:44:32'),
(20, 18, 1, '2022-09-30', 'QUITO', '1', 1, '-0.09663057683770108', '-78.51731071740657', NULL, NULL, 1, '2022-09-22 17:49:08', '2022-09-30 17:20:21'),
(21, 18, 0, '2022-09-30', 'QUITO EJEMPLO', '2', 5, '-2.1712019405009686', '-79.73994776126096', NULL, NULL, 1, '2022-09-22 17:49:15', '2022-09-30 19:43:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `send_detail`
--

CREATE TABLE `send_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `send_header_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campania` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hour_created` time DEFAULT NULL,
  `date_send` date DEFAULT NULL,
  `hour_send` time DEFAULT NULL,
  `immediately` tinyint(1) NOT NULL DEFAULT 0,
  `programmed` tinyint(1) NOT NULL DEFAULT 0,
  `repeat` tinyint(1) NOT NULL DEFAULT 0,
  `reminder` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_valor` int(11) DEFAULT NULL,
  `recurrence` tinyint(1) NOT NULL DEFAULT 0,
  `recurrence_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_valor` int(11) DEFAULT NULL,
  `lapsos` int(11) DEFAULT NULL,
  `file` tinyint(4) NOT NULL DEFAULT 0,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `send_header`
--

CREATE TABLE `send_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `campania` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hour_created` time DEFAULT NULL,
  `observation` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `photo`, `icon`, `class`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WHATSAPP', 'MENSAJES DE WHATSAPP', NULL, 'fab fa-whatsapp', 'green', 1, NULL, NULL),
(2, 'SMS', 'MENSAJES DE SMS', NULL, 'fas fa-sms', 'info', 1, NULL, NULL),
(3, 'EMAIL', 'ENVIO DE CORREOS ELECTRONICOS', NULL, 'fas fa-envelope-open', 'warning', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscription`
--

CREATE TABLE `suscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `date_finished` date DEFAULT NULL,
  `renewall` tinyint(1) NOT NULL DEFAULT 1,
  `date_renewall` date DEFAULT NULL,
  `date_cancel_renewall` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `twilio_credenciales`
--

CREATE TABLE `twilio_credenciales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 1,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sid` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `twilio_credenciales`
--

INSERT INTO `twilio_credenciales` (`id`, `principal`, `company_id`, `sede_id`, `date_created`, `phone_number`, `sid`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2022-09-27', '14155238886', 'AC0c0f751b0d0e14c0b121802d047e3b6a', 'c1efdb47a0825dd70620d6e9187efd8e', 1, '2022-09-27 17:10:10', '2022-09-27 17:10:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_affiliation`
--

CREATE TABLE `type_affiliation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publico` tinyint(1) NOT NULL DEFAULT 1,
  `code_intel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `type_affiliation`
--

INSERT INTO `type_affiliation` (`id`, `company_id`, `date_created`, `name`, `publico`, `code_intel`, `status`, `created_at`, `updated_at`) VALUES
(1, 34, '2021-10-23', 'PRIVADO', 0, '3', 1, '2021-10-23 14:39:28', '2022-01-06 07:50:41'),
(2, 36, '2021-12-08', 'PRIVADO', 0, '112', 1, '2021-12-08 17:04:42', '2022-01-29 12:19:17'),
(3, 35, '2021-12-10', 'PUBLICO', 1, '4', 1, '2021-12-10 15:54:28', '2021-12-20 12:37:27'),
(4, 33, '2021-12-20', 'PRIVADO', 0, '92', 1, '2021-12-20 16:57:43', '2022-02-04 11:30:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `company_varias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `company_id`, `company_varias`, `firstname`, `lastname`, `photo`, `username`, `ruc`, `email`, `email_verified_at`, `password`, `remember_token`, `token`, `status`, `admin`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'JOHN', 'TELLO', NULL, 'jtello', '1721749974', 'john-hy@hotmail.fr', NULL, '$2y$10$vVLYRqe7flgg7bv9TD18cuRgYlXO.vsdVrIG3Zmw101dxPx4ls4Ze', 'Xt0tJE8RhfeWpgUB960h63u0NZqnslVlPC3JIKqKzwRR0W801J3ZCqRkbDGY', '22feb1992', 1, 1, '2020-04-14 22:49:19', '2021-01-19 05:04:28'),
(5, 1, NULL, 'VICTOR', 'CABEZAS', NULL, 'vcabezas', '1234567890', 'victro@gmail.com', NULL, '$2y$10$j44/JJ69FKYD2HtkQFyWA.MEecPIboNs2EW16RqtUwZORvs5nVwZC', '$2y$10$MRM2xd86cln6kAbUNTlGAe1V8PAciU8UZUJc2adTLyOacezuwqo82', 'vcabezas', 1, 1, '2020-06-25 13:35:49', '2020-06-25 13:35:49'),
(6, 1, '', 'MARIO', 'CASEMIRO', NULL, 'mcasemiro', '0500672837', 'hernan@hotmail.com', NULL, '$2y$10$nfiMsY3/kgZtXkLurQs2.uC6kosAPwLCu4m.SfozZt2L7.rvEYMO2', '$2y$10$fkmt3O/N.T8pNgLYKLtfDuuQm4g/MHqaxhwFZhDblQXql9YOpL.QC', 'mcasemiro', 0, 0, '2021-08-16 15:23:42', '2021-08-31 09:20:30'),
(7, 1, '', 'HILARY', 'TELLO', '1629761084.jpg', 'htello', '1721749975', 'hilary@gmail.com', NULL, '$2y$10$LcA6p0ct3cTPLbdNJd3IbO7Af4KEKO.P0ioQ75.3oaXI/B2hNLquC', '$2y$10$UbU1cZcgVflSRdmZBrQjjOtu6L0zyFlZ0O20jotmL9b/Td3coSsI6', 'htello', 0, 0, '2021-08-23 18:24:44', '2021-08-31 09:20:32'),
(8, 1, '', 'CRISTIAN', 'GUERRA', NULL, 'cguerra', '1717151201', 'cguerra@intelho.com', NULL, '$2y$10$5yoFR.VxnBtijoMif2l6l.UP3KYfEfTWAzq.wpsjx6yO3fAHgYpc.', '$2y$10$ufB3ElXab9l0fomiT6Wjc.of7dAj3qGt3J6aSmbdlKjSb6vaOIPgu', 'cguerra', 1, 0, '2021-08-31 11:27:00', '2021-08-31 11:27:00'),
(9, 18, '', 'AGENTE', 'UNO', NULL, 'auno', '1721749971', 'auno@gmail.com', NULL, '$2y$10$ek7hN689vL2.o6xy9Kvcl.TFrfZ1.vAsTlN3yEzeCGNLuMhSO6OPy', 'sCbbAfk7i0uVIS4nZTFMepaT7HxTWg34GKnQiAraXgqALVI1oHDTmV9J4cGD', 'auno', 1, 0, '2022-10-21 11:07:00', '2022-10-21 11:07:00'),
(10, 18, '', 'AGENTE', 'DOS', NULL, 'ados', '1721749972', 'ados@gmail.com', NULL, '$2y$10$NQs1EIIGd6uoZ6KoqW1iyeqMG1nICflf7.mUhND1u7t7taO8yVFAq', 'mygSkOBpnAV0nAzz4lYpNIonIlr9edp3tvI3oxl3kEMsgCh422FoCqI1eHX5', 'ados', 1, 0, '2022-10-21 11:08:16', '2022-10-24 21:17:42'),
(11, 1, '', 'NICOLE', 'CHIGUANO', NULL, 'nchiguano', '1722695556001', 'nico@mail.com', NULL, '$2y$10$kFE49zCkKQHpAY6fGftEsO8FlX1JWFPtWmMinxqemllYD2Qswjql2', '$2y$10$DZpdcanNUD5sPvyHyvuOCuobXPc5m51B1KLHwalIHgXxH/uabGRX.', 'nchiguano', 1, 0, '2022-10-24 21:24:13', '2022-10-24 21:24:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id`, `rol_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2020-04-16 17:27:47', '2020-04-16 17:27:47'),
(2, 1, 5, '1', '2020-06-25 08:35:49', '2020-06-25 08:35:49'),
(3, 2, 6, '1', '2021-08-16 15:23:42', '2021-08-16 15:23:42'),
(4, 2, 7, '1', '2021-08-23 18:24:44', '2021-08-23 18:24:44'),
(5, 1, 8, '1', '2021-08-31 11:27:00', '2021-08-31 11:27:00'),
(6, 7, 9, '1', '2022-10-21 11:07:00', '2022-10-21 11:07:00'),
(7, 7, 10, '1', '2022-10-21 11:08:16', '2022-10-21 11:08:16'),
(8, 7, 11, '1', '2022-10-24 21:24:13', '2022-10-24 21:24:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `affiliation`
--
ALTER TABLE `affiliation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliation_company_id_foreign` (`company_id`),
  ADD KEY `affiliation_type_affiliation_id_foreign` (`type_affiliation_id`);

--
-- Indices de la tabla `api_detail`
--
ALTER TABLE `api_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_detail_company_id_foreign` (`company_id`),
  ADD KEY `api_detail_api_header_id_foreign` (`api_header_id`);

--
-- Indices de la tabla `api_header`
--
ALTER TABLE `api_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_header_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `api_intention`
--
ALTER TABLE `api_intention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_intention_company_id_foreign` (`company_id`),
  ADD KEY `api_intention_api_header_id_foreign` (`api_header_id`),
  ADD KEY `api_intention_bot_intention_id_foreign` (`bot_intention_id`);

--
-- Indices de la tabla `api_parameters`
--
ALTER TABLE `api_parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `api_parameters_company_id_foreign` (`company_id`),
  ADD KEY `api_parameters_api_header_id_foreign` (`api_header_id`);

--
-- Indices de la tabla `atention_detail`
--
ALTER TABLE `atention_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atention_detail_company_id_foreign` (`company_id`),
  ADD KEY `atention_detail_atention_header_id_foreign` (`atention_header_id`),
  ADD KEY `atention_detail_procedures_id_foreign` (`procedures_id`);

--
-- Indices de la tabla `atention_header`
--
ALTER TABLE `atention_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atention_header_company_id_foreign` (`company_id`),
  ADD KEY `atention_header_customer_id_foreign` (`customer_id`),
  ADD KEY `atention_header_sede_id_foreign` (`sede_id`),
  ADD KEY `atention_header_departament_id_foreign` (`departament_id`),
  ADD KEY `atention_header_doctor_id_foreign` (`doctor_id`);

--
-- Indices de la tabla `atention_medicine`
--
ALTER TABLE `atention_medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atention_medicine_company_id_foreign` (`company_id`),
  ADD KEY `atention_medicine_atention_header_id_foreign` (`atention_header_id`),
  ADD KEY `atention_medicine_medicine_id_foreign` (`medicine_id`);

--
-- Indices de la tabla `bot_conection`
--
ALTER TABLE `bot_conection`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bot_customer_response`
--
ALTER TABLE `bot_customer_response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_customer_response_api_header_id_foreign` (`api_header_id`);

--
-- Indices de la tabla `bot_detail`
--
ALTER TABLE `bot_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_detail_company_id_foreign` (`company_id`),
  ADD KEY `bot_detail_bot_header_id_foreign` (`bot_header_id`);

--
-- Indices de la tabla `bot_header`
--
ALTER TABLE `bot_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_header_company_id_foreign` (`company_id`),
  ADD KEY `bot_header_user_created_id_foreign` (`user_created_id`);

--
-- Indices de la tabla `bot_historial`
--
ALTER TABLE `bot_historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_historial_company_id_foreign` (`company_id`),
  ADD KEY `bot_historial_bot_header_id_foreign` (`bot_header_id`),
  ADD KEY `bot_historial_bot_detail_id_foreign` (`bot_detail_id`),
  ADD KEY `bot_historial_api_header_id_foreign` (`api_header_id`),
  ADD KEY `bot_historial_main_answer_id_foreign` (`main_answer_id`);

--
-- Indices de la tabla `bot_intention`
--
ALTER TABLE `bot_intention`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `campania`
--
ALTER TABLE `campania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campania_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `category_message`
--
ALTER TABLE `category_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_message_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `chat_bot_detail`
--
ALTER TABLE `chat_bot_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_bot_detail_company_id_foreign` (`company_id`),
  ADD KEY `chat_bot_detail_chat_bot_header_id_foreign` (`chat_bot_header_id`),
  ADD KEY `chat_bot_detail_bot_detail_id_foreign` (`bot_detail_id`),
  ADD KEY `chat_bot_detail_bot_historial_id_foreign` (`bot_historial_id`);

--
-- Indices de la tabla `chat_bot_header`
--
ALTER TABLE `chat_bot_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_bot_header_company_id_foreign` (`company_id`),
  ADD KEY `chat_bot_header_bot_header_id_foreign` (`bot_header_id`),
  ADD KEY `chat_bot_header_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `chat_header_category_message`
--
ALTER TABLE `chat_header_category_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_header_category_message_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_ruc_unique` (`ruc`);

--
-- Indices de la tabla `company_services`
--
ALTER TABLE `company_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_services_company_id_foreign` (`company_id`),
  ADD KEY `company_services_service_id_foreign` (`service_id`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address_company_id_foreign` (`company_id`),
  ADD KEY `customer_address_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `date_send_massive`
--
ALTER TABLE `date_send_massive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_send_massive_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departament_company_id_foreign` (`company_id`),
  ADD KEY `departament_sede_id_foreign` (`sede_id`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `doctor_especialidad`
--
ALTER TABLE `doctor_especialidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_especialidad_company_id_foreign` (`company_id`),
  ADD KEY `doctor_especialidad_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_especialidad_especialidad_id_foreign` (`especialidad_id`);

--
-- Indices de la tabla `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_schedule_company_id_foreign` (`company_id`),
  ADD KEY `doctor_schedule_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_schedule_sede_id_foreign` (`sede_id`),
  ADD KEY `doctor_schedule_departament_id_foreign` (`departament_id`);

--
-- Indices de la tabla `envios_detail`
--
ALTER TABLE `envios_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `envios_detail_company_id_foreign` (`company_id`),
  ADD KEY `envios_detail_customer_id_foreign` (`customer_id`),
  ADD KEY `envios_detail_envios_header_id_foreign` (`envios_header_id`);

--
-- Indices de la tabla `envios_header`
--
ALTER TABLE `envios_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `envios_header_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especialidad_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `machine_mindray`
--
ALTER TABLE `machine_mindray`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `massive_detail`
--
ALTER TABLE `massive_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `massive_detail_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `massive_header`
--
ALTER TABLE `massive_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `massive_header_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_rol`
--
ALTER TABLE `menu_rol`
  ADD KEY `fk_menurol_rol` (`rol_id`),
  ADD KEY `fk_menurol_menu` (`menu_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `msp_cookies`
--
ALTER TABLE `msp_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `pagos_detail`
--
ALTER TABLE `pagos_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_detail_company_id_foreign` (`company_id`),
  ADD KEY `pagos_detail_chat_bot_header_id_foreign` (`chat_bot_header_id`),
  ADD KEY `pagos_detail_pagos_header_id_foreign` (`pagos_header_id`);

--
-- Indices de la tabla `pagos_header`
--
ALTER TABLE `pagos_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_header_company_id_foreign` (`company_id`),
  ADD KEY `pagos_header_chat_bot_header_id_foreign` (`chat_bot_header_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD KEY `fk_permisorol_rol` (`rol_id`),
  ADD KEY `fk_permisorol_permiso` (`permiso_id`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plan_services`
--
ALTER TABLE `plan_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_services_plan_id_foreign` (`plan_id`),
  ADD KEY `plan_services_service_id_foreign` (`service_id`);

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indices de la tabla `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedures_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_barcode_unique` (`barcode`),
  ADD KEY `product_company_id_foreign` (`company_id`),
  ADD KEY `product_category_product_id_foreign` (`category_product_id`),
  ADD KEY `product_unit_measure_id_foreign` (`unit_measure_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rol_nombre_unique` (`nombre`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `send_detail`
--
ALTER TABLE `send_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_detail_company_id_foreign` (`company_id`),
  ADD KEY `send_detail_send_header_id_foreign` (`send_header_id`),
  ADD KEY `send_detail_service_id_foreign` (`service_id`),
  ADD KEY `send_detail_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `send_header`
--
ALTER TABLE `send_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_header_company_id_foreign` (`company_id`),
  ADD KEY `send_header_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscription`
--
ALTER TABLE `suscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suscription_company_id_foreign` (`company_id`),
  ADD KEY `suscription_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `twilio_credenciales`
--
ALTER TABLE `twilio_credenciales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `twilio_credenciales_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `type_affiliation`
--
ALTER TABLE `type_affiliation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_affiliation_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_ruc_unique` (`ruc`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuariorol_rol` (`rol_id`),
  ADD KEY `fk_usuariorol_users` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `affiliation`
--
ALTER TABLE `affiliation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_detail`
--
ALTER TABLE `api_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `api_header`
--
ALTER TABLE `api_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `api_intention`
--
ALTER TABLE `api_intention`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `api_parameters`
--
ALTER TABLE `api_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `atention_detail`
--
ALTER TABLE `atention_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `atention_header`
--
ALTER TABLE `atention_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `atention_medicine`
--
ALTER TABLE `atention_medicine`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bot_conection`
--
ALTER TABLE `bot_conection`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bot_customer_response`
--
ALTER TABLE `bot_customer_response`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `bot_detail`
--
ALTER TABLE `bot_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de la tabla `bot_header`
--
ALTER TABLE `bot_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `bot_historial`
--
ALTER TABLE `bot_historial`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT de la tabla `bot_intention`
--
ALTER TABLE `bot_intention`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `campania`
--
ALTER TABLE `campania`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `category_message`
--
ALTER TABLE `category_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_bot_detail`
--
ALTER TABLE `chat_bot_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `chat_bot_header`
--
ALTER TABLE `chat_bot_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `chat_header_category_message`
--
ALTER TABLE `chat_header_category_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `company_services`
--
ALTER TABLE `company_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `date_send_massive`
--
ALTER TABLE `date_send_massive`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departament`
--
ALTER TABLE `departament`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctor_especialidad`
--
ALTER TABLE `doctor_especialidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envios_detail`
--
ALTER TABLE `envios_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `envios_header`
--
ALTER TABLE `envios_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `machine_mindray`
--
ALTER TABLE `machine_mindray`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `massive_detail`
--
ALTER TABLE `massive_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `massive_header`
--
ALTER TABLE `massive_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de la tabla `msp_cookies`
--
ALTER TABLE `msp_cookies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_detail`
--
ALTER TABLE `pagos_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos_header`
--
ALTER TABLE `pagos_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `plan_services`
--
ALTER TABLE `plan_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `send_detail`
--
ALTER TABLE `send_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `send_header`
--
ALTER TABLE `send_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `suscription`
--
ALTER TABLE `suscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `twilio_credenciales`
--
ALTER TABLE `twilio_credenciales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `type_affiliation`
--
ALTER TABLE `type_affiliation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `affiliation`
--
ALTER TABLE `affiliation`
  ADD CONSTRAINT `affiliation_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `affiliation_type_affiliation_id_foreign` FOREIGN KEY (`type_affiliation_id`) REFERENCES `type_affiliation` (`id`);

--
-- Filtros para la tabla `api_detail`
--
ALTER TABLE `api_detail`
  ADD CONSTRAINT `api_detail_api_header_id_foreign` FOREIGN KEY (`api_header_id`) REFERENCES `api_header` (`id`),
  ADD CONSTRAINT `api_detail_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `api_header`
--
ALTER TABLE `api_header`
  ADD CONSTRAINT `api_header_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `api_intention`
--
ALTER TABLE `api_intention`
  ADD CONSTRAINT `api_intention_api_header_id_foreign` FOREIGN KEY (`api_header_id`) REFERENCES `api_header` (`id`),
  ADD CONSTRAINT `api_intention_bot_intention_id_foreign` FOREIGN KEY (`bot_intention_id`) REFERENCES `bot_intention` (`id`),
  ADD CONSTRAINT `api_intention_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `api_parameters`
--
ALTER TABLE `api_parameters`
  ADD CONSTRAINT `api_parameters_api_header_id_foreign` FOREIGN KEY (`api_header_id`) REFERENCES `api_header` (`id`),
  ADD CONSTRAINT `api_parameters_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `atention_detail`
--
ALTER TABLE `atention_detail`
  ADD CONSTRAINT `atention_detail_atention_header_id_foreign` FOREIGN KEY (`atention_header_id`) REFERENCES `atention_header` (`id`),
  ADD CONSTRAINT `atention_detail_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `atention_detail_procedures_id_foreign` FOREIGN KEY (`procedures_id`) REFERENCES `procedures` (`id`);

--
-- Filtros para la tabla `atention_medicine`
--
ALTER TABLE `atention_medicine`
  ADD CONSTRAINT `atention_medicine_atention_header_id_foreign` FOREIGN KEY (`atention_header_id`) REFERENCES `atention_header` (`id`),
  ADD CONSTRAINT `atention_medicine_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `atention_medicine_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`);

--
-- Filtros para la tabla `bot_customer_response`
--
ALTER TABLE `bot_customer_response`
  ADD CONSTRAINT `bot_customer_response_api_header_id_foreign` FOREIGN KEY (`api_header_id`) REFERENCES `api_header` (`id`);

--
-- Filtros para la tabla `category_message`
--
ALTER TABLE `category_message`
  ADD CONSTRAINT `category_message_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `chat_header_category_message`
--
ALTER TABLE `chat_header_category_message`
  ADD CONSTRAINT `chat_header_category_message_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `date_send_massive`
--
ALTER TABLE `date_send_massive`
  ADD CONSTRAINT `date_send_massive_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `envios_header`
--
ALTER TABLE `envios_header`
  ADD CONSTRAINT `envios_header_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
