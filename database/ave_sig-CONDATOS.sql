-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2015 a las 23:33:08
-- Versión del servidor: 5.6.17-log
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ave_sig`
--

DROP DATABASE IF EXISTS sigave;
CREATE DATABASE IF NOT EXISTS sigave DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE sigave;

-- --------------------------------------------------------

drop table if exists airlines;

drop table if exists branch_offices;

drop table if exists destinies;

drop table if exists etl_users;

drop table if exists fulfillment_branch_office_goals;

drop table if exists goal_airlines;

drop table if exists goal_branch_offices;

drop table if exists invoiced_services;

drop table if exists invoiced_tickets;

drop table if exists itinerary_invoiced_tickets;

drop table if exists operacionesexs;

drop table if exists operacionesrgs;

drop table if exists providers;

drop table if exists routes;

drop table if exists services_sales_providers;

drop table if exists services_sales_types;

drop table if exists tickets_sales_destinies;

drop table if exists tickets_sales_routes;

drop table if exists types;

drop table if exists users;

--
-- Estructura de tabla para la tabla `airlines`
--

CREATE TABLE IF NOT EXISTS `airlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `abrevia` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `abrevia`) VALUES
(1, 'AMERICAN AIRLINES             ', 'AA'),
(2, 'AIR FRANCE                    ', 'AF'),
(3, 'AEROMEXICO                    ', 'AM'),
(4, 'COPA AIRLINES                 ', 'CM'),
(5, 'DELTA AIRLINES                ', 'DL'),
(6, 'IBERIA                        ', 'IB'),
(7, 'JAPAN AIRLINES                ', 'JL'),
(8, 'LUFTHANSA                     ', 'LH'),
(9, 'LACSA                         ', 'LR'),
(10, 'TACA INTERNATIONAL            ', 'TA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_offices`
--

CREATE TABLE IF NOT EXISTS `branch_offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `abrevia` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `branch_offices`
--

INSERT INTO `branch_offices` (`id`, `name`, `abrevia`) VALUES
(1, 'CENTRAL', 'CT'),
(2, 'GALERIAS', 'GL'),
(3, 'MADERO', 'MD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinies`
--

CREATE TABLE IF NOT EXISTS `destinies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tickets_sales_destiny_id` int(11) DEFAULT NULL,
  `destino` varchar(3) DEFAULT NULL,
  `boletos_destino` int(11) DEFAULT NULL,
  `total_destino` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_24` (`tickets_sales_destiny_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etl_users`
--

CREATE TABLE IF NOT EXISTS `etl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `ingreso_desde` date NOT NULL,
  `ingreso_hasta` date NOT NULL,
  `cantidad_boletos` int(11) NOT NULL,
  `cantidad_servicios` int(11) NOT NULL,
  `total_boletos` float(8,2) NOT NULL,
  `total_servicios` float(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_25` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fulfillment_branch_office_goals`
--

CREATE TABLE IF NOT EXISTS `fulfillment_branch_office_goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_branch_office_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `cantidad_boletos` int(11) DEFAULT NULL,
  `total_boletos` float(8,2) DEFAULT NULL,
  `faltante_boletos` float(8,2) DEFAULT NULL,
  `porcentaje_boletos` float DEFAULT NULL,
  `cantidad_servicios` int(11) DEFAULT NULL,
  `total_servicios` float(8,2) DEFAULT NULL,
  `faltante_servicios` float(8,2) DEFAULT NULL,
  `porcentaje_servicios` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_19` (`goal_branch_office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goal_airlines`
--

CREATE TABLE IF NOT EXISTS `goal_airlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `airline_id` int(11) DEFAULT NULL,
  `periodo_bsp` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `boletos_periodo` int(11) DEFAULT '0',
  `total_periodo` float(8,2) DEFAULT '0.00',
  `meta_bsp` float(8,2) DEFAULT NULL,
  `faltante` float(8,2) DEFAULT '0.00',
  `porcentaje` float DEFAULT '0',
  `comision` float DEFAULT NULL,
  `ingreso_comision` float(8,2) DEFAULT '0.00',
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_26` (`airline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goal_branch_offices`
--

CREATE TABLE IF NOT EXISTS `goal_branch_offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_office_id` int(11) DEFAULT NULL,
  `mes` date NOT NULL,
  `meta_boletos` float(8,2) NOT NULL,
  `meta_servicios` float(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_22` (`branch_office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoiced_services`
--

CREATE TABLE IF NOT EXISTS `invoiced_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services_sales_provider_id` int(11) DEFAULT NULL,
  `services_sales_type_id` int(11) DEFAULT NULL,
  `fulfillment_branch_office_goal_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo_servicio` varchar(100) DEFAULT NULL,
  `proveedor_servicio` varchar(100) DEFAULT NULL,
  `tarifa` float(8,2) DEFAULT NULL,
  `iva` float(8,2) DEFAULT NULL,
  `pasajero` varchar(60) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `correlativo_comprobante` int(11) DEFAULT NULL,
  `tipo_documento` varchar(30) DEFAULT NULL,
  `sucursal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_17` (`services_sales_provider_id`),
  KEY `fk_reference_18` (`services_sales_type_id`),
  KEY `fk_reference_21` (`fulfillment_branch_office_goal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;

--
-- Volcado de datos para la tabla `invoiced_services`
--

INSERT INTO `invoiced_services` (`id`, `services_sales_provider_id`, `services_sales_type_id`, `fulfillment_branch_office_goal_id`, `numero`, `fecha`, `tipo_servicio`, `proveedor_servicio`, `tarifa`, `iva`, `pasajero`, `descripcion`, `correlativo_comprobante`, `tipo_documento`, `sucursal`) VALUES
(1, NULL, NULL, NULL, 0, '2015-01-08', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 114.00, 0.00, 'DOUGLAS ANTONIO CARDONA', '1 TRAVEL ACE CAT. EUROPA FAMILIAR', 6069, 'I ', '2'),
(2, NULL, NULL, NULL, 0, '2015-01-09', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 1292.04, 0.00, 'PAPANICOLAU ESTEBAN', 'RENTA DE AUTO EN HOUSTON CON HERTZ PAX: PAPANICOLAU ESTEBAN', 10950, 'C ', '2'),
(3, NULL, NULL, NULL, 0, '2015-01-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 370.52, 0.00, 'SALAZAR/VENANCIA DEL CARMEN', 'HOTEL ALBA DEL 16 AL 29 DE ENERO HAB. SENCILLA EN ROMA', 6070, 'I ', '2'),
(4, NULL, NULL, NULL, 1, '2015-01-08', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 82.00, 0.00, 'SALAZAR/VENANCIA DEL CARMEN', 'TRAVEL ACE EUROPA 16 DIAS', 6070, 'I ', '2'),
(5, NULL, NULL, NULL, 0, '2015-01-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 370.52, 0.00, 'SALAZAR/VENANCIA DEL CARMEN', 'HOTEL ALBA DEL 16 AL 29 ENERO EN ROMA', 27932, 'F ', '2'),
(6, NULL, NULL, NULL, 1, '2015-01-08', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 82.00, 0.00, 'SALAZAR/VENANCIA DEL CARMEN', 'SEGURO TRAVEL ACE EUROPA 16 DIAS', 27932, 'F ', '2'),
(7, NULL, NULL, NULL, 0, '2015-01-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 1180.00, 0.00, 'MARIA JOSE MELGAR', 'PAGO DE 1 HAB. DBL EN HOTEL CLARION INN & SUITES EN MIAMI DEL 23 AL 30 DE ENERO', 6074, 'I ', '2'),
(8, NULL, NULL, NULL, 0, '2015-01-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 719.00, 0.00, 'CARLOS FERNANDEZ', 'ALOJAMIENTO EN HOTEL REGAL PACIFIC DEL 14 AL 20 DE DICIEMBRE', 10955, 'C ', '2'),
(9, NULL, NULL, NULL, 0, '2015-01-09', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 82.00, 0.00, 'CHAMUL/JENNIE', 'TRAVEL ACE EUROPA 16 DIAS', 27945, 'F ', '2'),
(10, NULL, NULL, NULL, 0, '2015-01-10', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1600.00, 0.00, 'ANGELA CECILIA LOVO GUMERO', 'PAQUETE EL TRIANGULO MAGICO CAT CONFORT + PAQ PLUS HAB SENCILLA 15 DE MARZO 2015.', 6077, 'I ', '2'),
(11, NULL, NULL, NULL, 0, '2015-01-12', 'PAQUETES', 'RINSA TOURS                                                                                         ', 3522.00, 0.00, 'GUERRERO/GLENDA, HERNANDEZ/DAVID', 'PAQUETE A PARIS SOÑADO MAS TRAVEL ACE ESTADIA EN MADRID', 6078, 'I ', '2'),
(12, NULL, NULL, NULL, 0, '2015-01-13', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 39.00, 0.00, 'IRENE MARTI /LILIANA MARTI', 'ASISTENCIA DE VIAJE CLASE TURISTA DEL 02 AL 07 FEB.', 6080, 'I ', '2'),
(13, NULL, NULL, NULL, 0, '2015-01-13', 'HOTELES', 'RINSA TOURS                                                                                         ', 186.00, 0.00, 'VALDEZ/RENE', 'ALOJAMIENTO EN MEXICO DF', 10971, 'C ', '2'),
(14, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1308.00, 0.00, 'SAENZ MARINERO HUMBERTO /SAENZ DOMINGUEZ HUMBERTO', 'PAQUETE TURISTICO A BARCELONA DEL 07 AL 13 DE ABRIL 2015', 6081, 'I ', '2'),
(15, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 461.70, 0.00, 'GRACIELA JESUS ABELINA ROMERO DE CAMPOS', 'PAQUETE HABANA Y VARADERO 7 DIAS 6 NOCHES HAB. TRIPLE HTL. COPA CABANA OCCIDENTAL', 6085, 'I ', '2'),
(16, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 461.70, 0.00, 'MARGARITA LARA DE IBBOTT', 'PAQUETE HABANA Y VARADERO 7 DIAS 6 NOCHES HAB. TRIPLE HTL. COPA CABANA OCCIDENTAL', 6086, 'I ', '2'),
(17, NULL, NULL, NULL, 0, '2015-01-14', 'HOTELES', 'RINSA TOURS                                                                                         ', 100.00, 0.00, 'XXXXXXXXXXXXXXXXXXXXXXXXXX', 'HOTEL', 569, 'I ', '1'),
(18, NULL, NULL, NULL, 1, '2015-01-14', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 100.00, 0.00, NULL, 'TRAVEL ACE', 569, 'I ', '1'),
(19, NULL, NULL, NULL, 2, '2015-01-14', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 100.00, 0.00, NULL, 'XXXXXXXXXXXXXXXXXXXXXX', 569, 'I ', '1'),
(20, NULL, NULL, NULL, 0, '2015-01-15', 'PAQUETES', 'RINSA TOURS                                                                                         ', 438.00, 0.00, 'ANA ISABEL LARA', 'PAQUETE A CUBA HTL. DEUVILLE Y TORTUGA DEL 21 AL 28 FEB. HAB. DBL.', 6088, 'I ', '2'),
(21, NULL, NULL, NULL, 0, '2015-01-15', 'PAQUETES', 'RINSA TOURS                                                                                         ', 438.00, 0.00, 'ANA CARLOTA PLEITES CRISTALES', 'PAQUETE A CUBA HTL. DEUVILLE Y TORTUGA DEL 21 AL 28 FEB. HAB. DBL.', 6089, 'I ', '2'),
(22, NULL, NULL, NULL, 0, '2015-01-15', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1700.00, 0.00, NULL, 'CANCELACION PAQUETE A PUNTA CANA HTL. B LIVE COLLECTION PUNTA CANA', 6090, 'I ', '2'),
(23, NULL, NULL, NULL, 0, '2015-01-16', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 123.00, 0.00, 'SANTOS CASTELLANOS RIVERA', 'SEGURO DE ASISTENCIA', 6091, 'I ', '2'),
(24, NULL, NULL, NULL, 0, '2015-01-16', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 64.00, 0.00, 'ALVARO ANTONIO ROJAS CRUZ', 'SEGURO DE VIAJA', 6092, 'I ', '2'),
(25, NULL, NULL, NULL, 0, '2015-01-16', 'HOTELES', 'RINSA TOURS                                                                                         ', 127.00, 0.00, 'SEBASTIAN LEYTON', '1 NOCHE DE ALOJAMIENTO EN HOTEL BARCELO DEL 21 AL 22 DE ENERO', 443, 'E ', '2'),
(26, NULL, NULL, NULL, 0, '2015-01-20', 'HOTELES', 'RINSA TOURS                                                                                         ', 162.00, 0.00, 'WILFREDO RODRIGUEZ JIMENEZ', 'PAGO DE RESERVA DE HTL. EN SEGOVIA Y TOURS EN MADRID', 6108, 'I ', '2'),
(27, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 2647.32, 0.00, 'HO DE CHAN/YIN PING  Y HO/WAI KUEN SHIRLEY', 'PAQUETE TURISTICO ARGENTINA PATAGONIA', 6082, 'I ', '2'),
(28, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 940.50, 0.00, 'ANA SILVIA AYALA DE PALMA', 'PAQUETE HABANA Y VARADERO 7 DIAS 6 NOCHES HAB. DBL. HTL. COPA CABANA OCCIDENTAL ALEGRO VARADERO DEL ', 6083, 'I ', '2'),
(29, NULL, NULL, NULL, 0, '2015-01-13', 'PAQUETES', 'RINSA TOURS                                                                                         ', 461.70, 0.00, 'MARTA ALICIA HERNANDEZ DE AYALA', 'PAQUETE HABANA Y VARADERO 7 DIAS 6 NOCHES HAB. TRIPLE HTL. COPA CABANA OCCIDENTAL', 6084, 'I ', '2'),
(30, NULL, NULL, NULL, 0, '2015-01-14', 'PAQUETES', 'RINSA TOURS                                                                                         ', 100.00, 0.00, 'FLORES/NOHEMY', 'PAQUETE A BAHAMAS', 135781, 'C ', '1'),
(31, NULL, NULL, NULL, 0, '2015-01-14', 'HOTELES', 'RINSA TOURS                                                                                         ', 100.00, 0.00, NULL, 'HOTEL', 152078, 'F ', '1'),
(32, NULL, NULL, NULL, 1, '2015-01-14', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 100.00, 0.00, NULL, 'TRAVEL ACE', 152078, 'F ', '1'),
(33, NULL, NULL, NULL, 0, '2015-01-16', 'PAQUETES', 'RINSA TOURS                                                                                         ', 703.83, 0.00, 'YIN PING HO DE CHAN', 'PAQUETE TURISTICO A BUENOS AIRES', 6093, 'I ', '2'),
(34, NULL, NULL, NULL, 0, '2015-01-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 150.00, 0.00, NULL, 'Hotel en Phoenix, Francisco Quijano y Miguel Schettini', 8408, 'E ', '1'),
(35, NULL, NULL, NULL, 0, '2015-01-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 1966.00, 0.00, 'WALTER LEONARDO SALINAS', 'PAQUETE A ROATAN 3 PERSONAS HOTEL MAYA PRINCESS TODO INCLU.', 6122, 'I ', '2'),
(36, NULL, NULL, NULL, 0, '2015-01-27', 'PAQUETES', 'RINSA TOURS                                                                                         ', 790.00, 0.00, 'MARIO RAUL VAQUERO CASTANEDA', 'PAQUETE A PANAMA DEL 23 AL 27 DE FEBRERO ', 6123, 'I ', '2'),
(37, NULL, NULL, NULL, 0, '2015-01-29', 'PAQUETES', 'RINSA TOURS                                                                                         ', 730.99, 0.00, 'KEVIN ROBERTO CORPEÑO/DELIA CORPEÑO  ', 'PAQUETE  A COSTA RICA', 6127, 'I ', '2'),
(38, NULL, NULL, NULL, 0, '2015-01-30', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 136273, 'C ', '1'),
(39, NULL, NULL, NULL, 0, '2015-01-31', 'PAQUETES', 'RINSA TOURS                                                                                         ', 172.00, 0.00, 'BERTHA VIOLETA AMADOR DE FUENTES', '01 HAB. DOBLE EN DECAMERON SALINITAS, 30/31 JAN, 30/31 ENERO', 136308, 'C ', '1'),
(40, NULL, NULL, NULL, 0, '2015-01-31', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 136372, 'C ', '1'),
(41, NULL, NULL, NULL, 0, '2015-02-03', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 82.00, 0.00, 'MARTINEZ/WILBER GERMAN', 'ASISTENCIA DE VIAJE, TRAVEL ACE', 152931, 'F ', '1'),
(42, NULL, NULL, NULL, 0, '2015-02-03', 'HOTELES', 'RINSA TOURS                                                                                         ', 680.00, 0.00, 'ALLE/ALEJANDRO', 'ALOJAMIENTO EN HOTEL MAGNOLIA, HOUSTON, 28 AL 30 ENERO 2015', 136384, 'C ', '1'),
(43, NULL, NULL, NULL, 0, '2015-01-08', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 1292.04, 0.00, 'PAPANICOLAO ESTEBAN', 'RENTA DE AUTO EN HOUSTON CON HERTZ', 10948, 'C ', '2'),
(44, NULL, NULL, NULL, 0, '2015-01-08', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 1292.04, 0.00, 'PAPANICOLAU ESTEBAN', 'RENTA DE AUTO EN HOUSTON CON HERTZ PAX: PAPANICOLAU ESTEBAN', 10949, 'C ', '2'),
(45, NULL, NULL, NULL, 0, '2015-01-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 519.22, 0.00, 'CARLOS ROBERTO SORTO FERNANDEZ', '7 NOCHES DE HOTEL CISCUS CIRCUS LAS VEGAS DEL 13-20 ENERO', 6071, 'I ', '2'),
(46, NULL, NULL, NULL, 0, '2015-01-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 519.22, 0.00, 'CARLOS ROBERTO SORTO MELARA', '7 NOCHES DE HOTEL CIRCUS CIRCUS LAS VEGAS DEL 13-20 ENERO', 27933, 'F ', '2'),
(47, NULL, NULL, NULL, 0, '2015-01-09', 'TOURS', 'RINSA TOURS                                                                                         ', 1218.00, 0.00, 'MELVIN ERNESTO MELARA', 'PAGO DE PAQUETE A CUBA EN HAB. TRIPLE DEL 23 AL 28 ENERO', 6072, 'I ', '2'),
(48, NULL, NULL, NULL, 0, '2015-01-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 321.00, 0.00, 'ANA ESTER SANTAMARIA DE MIGUEL', 'PAGO DE HOTEL EN MEXICO', 6073, 'I ', '2'),
(49, NULL, NULL, NULL, 0, '2015-01-09', 'PAQUETES', 'RINSA TOURS                                                                                         ', 2184.00, 0.00, 'MARIA ELENA MENDEZ DE MONTERROSA', 'PAQUETE TURISTICO A PANAMA 6 PERSONAS HTL. SHERATON', 6075, 'I ', '2'),
(50, NULL, NULL, NULL, 0, '2015-01-09', 'TOURS', 'RINSA TOURS                                                                                         ', 2762.22, 0.00, 'GILDA ENEIDA MUÑOZ VELASQUEZ', 'TOUR DE SPECIAL TOUR EN ITALIA Y  FRANCIA, EXCURSION ADICIONAL DE 4 DIAS EN MADRID Y SEGURO TRAVEL A', 6076, 'I ', '2'),
(51, NULL, NULL, NULL, 0, '2015-01-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 128.00, 0.00, 'HECTOR CARIDAD', '1 NOCHE DE ALOJAMIENTO HOTEL HOLIDAY INN GUATEMALA DEL 12 AL 13 DE ENERO', 10959, 'C ', '2'),
(52, NULL, NULL, NULL, 0, '2015-01-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 369.00, 0.00, 'MILO SANCHEZ', 'RESERVA DE HOTEL EN SAN PEDRO ', 6079, 'I ', '2'),
(53, NULL, NULL, NULL, 0, '2015-01-15', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 215.00, 0.00, 'JOACHIN/KARLA', 'ASISTENCIA DE VIAJE TRAVEL ACE EUROPA POR 90 DIAS', 27983, 'F ', '2'),
(54, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, 'Jennifer Erazo', 'Asistencia de viajes Travel Ace, por 8 días.', 153084, 'F ', '1'),
(55, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 136540, 'C ', '1'),
(56, NULL, NULL, NULL, 0, '2015-02-09', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 21.00, 0.00, NULL, 'SEGURO DE VIAJE', 136557, 'C ', '1'),
(57, NULL, NULL, NULL, 0, '2015-02-09', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 70.00, 0.00, NULL, 'SEGURO DE VIAJE', 136578, 'C ', '1'),
(58, NULL, NULL, NULL, 0, '2015-02-10', 'PAQUETES', 'RINSA TOURS                                                                                         ', 21954.53, 0.00, NULL, 'PAGO DE 23 HAB. DOBLES, PANAMA COMBINADO, TOURS, TRASLADOS', 572, 'I ', '1'),
(59, NULL, NULL, NULL, 0, '2015-02-11', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 153222, 'F ', '1'),
(60, NULL, NULL, NULL, 0, '2015-02-11', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 153224, 'F ', '1'),
(61, NULL, NULL, NULL, 0, '2015-02-12', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 136668, 'C ', '1'),
(62, NULL, NULL, NULL, 0, '2015-02-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 403.00, 0.00, 'Dr. Luis Chavez y Tatiana Arqueros', '1 habitacion doble en hotel Luxor Buenos Aires y traslados, ', 136671, 'C ', '1'),
(63, NULL, NULL, NULL, 1, '2015-02-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'Asistentes al congreso SLAAI2015.', 136671, 'C ', '1'),
(64, NULL, NULL, NULL, 0, '2015-02-12', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 136674, 'C ', '1'),
(65, NULL, NULL, NULL, 0, '2015-02-12', 'PAQUETES', 'RINSA TOURS                                                                                         ', 2505.00, 0.00, 'Jorge Adalberto Martinez X 03 PAX.', 'Paquete a Roatán en 1 Habitación Triple, en Hotel Media Luna', 153262, 'F ', '1'),
(66, NULL, NULL, NULL, 0, '2015-02-18', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 63.00, 0.00, NULL, '2 TRAVEL ACE PLAN MASTER POR 8 DIAS HACIA PERU', 573, 'I ', '1'),
(67, NULL, NULL, NULL, 0, '2015-02-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 180.00, 0.00, 'Lic. Sigfredo Valle', 'Ingresando el 24 de Febrero, saliendo el 25 de Febrero', 136516, 'C ', '1'),
(68, NULL, NULL, NULL, 1, '2015-02-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 360.00, 0.00, 'Lic. Démar Campos', 'Ingresando el 24, saliendo el 26 de Febrero/15', 136516, 'C ', '1'),
(69, NULL, NULL, NULL, 2, '2015-02-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 180.00, 0.00, 'Lic. Victoria Gutierrez', 'Ingresando el 24, saliendo el 25 de Febrero/15  ', 136516, 'C ', '1'),
(70, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 136543, 'C ', '1'),
(71, NULL, NULL, NULL, 0, '2015-02-09', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1160.00, 0.00, NULL, 'PAQUETE A CUBA, DEL 01 AL 05 MAARZO 2015', 571, 'I ', '1'),
(72, NULL, NULL, NULL, 0, '2015-02-11', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 153223, 'F ', '1'),
(73, NULL, NULL, NULL, 0, '2015-02-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 654.00, 0.00, 'JUAN RICARDO MARIN AGUIRRE', '2 NOCHES DE HOTEL EN SDQ  Y  03 NOCHES EN PTY', 136677, 'C ', '1'),
(74, NULL, NULL, NULL, 0, '2015-02-19', 'HOTELES', 'RINSA TOURS                                                                                         ', 509.00, 0.00, 'Dr. Carlos Jose Alvayero ', 'Alojamiento en hotel Sheraton de San Jose Costa Rica ', 136922, 'C ', '1'),
(75, NULL, NULL, NULL, 1, '2015-02-19', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'del 26 de Febrero al 01 de Marzo, incluyendo Traslados', 136922, 'C ', '1'),
(76, NULL, NULL, NULL, 0, '2015-02-19', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1032.00, 0.00, 'JOSE MIGUEL BENITEZ RODRIGUEZ', 'PAQUETE A ROATAN CON BOLETO HOTEL FANTASY ISLAND', 6186, 'I ', '2'),
(77, NULL, NULL, NULL, 0, '2015-02-20', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 76.00, 0.00, 'GLORIA ELENA MIRANDA ANGEL', '01 Asistencia de viajes Travel Ace/Plan Valué X 11 días, ', 153571, 'F ', '1'),
(78, NULL, NULL, NULL, 0, '2015-02-23', 'HOTELES', 'RINSA TOURS                                                                                         ', 810.00, 0.00, 'D Anaya/Ana y Contreras/David', '2 Hab Sencillas hotel Holiday inn Managua 04 al 07Marzo', 153591, 'F ', '1'),
(79, NULL, NULL, NULL, 0, '2015-01-17', 'HOTELES', 'RINSA TOURS                                                                                         ', 720.00, 0.00, 'JOSE GUILLERMO HERNANDEZ REYES', 'PAGO PAQUETE EN PANAMA CIUDAD DEL 30 MAR AL 2 DE ABRIL/15 EN BASE HABITACION TRIPLE', 6096, 'I ', '2'),
(80, NULL, NULL, NULL, 0, '2015-01-23', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 90.00, 0.00, NULL, 'COMPEMENTO DE TRAVEL ACE PLAN VALUE', 11035, 'C ', '2'),
(81, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 136541, 'C ', '1'),
(82, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 136542, 'C ', '1'),
(83, NULL, NULL, NULL, 0, '2015-02-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 136545, 'C ', '1'),
(84, NULL, NULL, NULL, 0, '2015-02-10', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 136632, 'C ', '1'),
(85, NULL, NULL, NULL, 0, '2015-02-13', 'HOTELES', 'RINSA TOURS                                                                                         ', 590.00, 0.00, 'Dra Margarita Nuila de Villalobos', '4 noches de alojamiento en Praga en Hotel Golden Crown', 136728, 'C ', '1'),
(86, NULL, NULL, NULL, 0, '2015-02-24', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 74.00, 0.00, 'Yanira Valencia y Tomas Quintanilla', '05 TRAVEL ACE VALUE POR 05 DIAS', 137039, 'C ', '1'),
(87, NULL, NULL, NULL, 0, '2015-02-24', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 74.00, 0.00, 'Yanira Valencia y Tomas Quintanilla', '02 TRAVEL ACE VALUE POR 05 DIAS', 137040, 'C ', '1'),
(88, NULL, NULL, NULL, 0, '2015-02-25', 'HOTELES', 'RINSA TOURS                                                                                         ', 5446.00, 0.00, NULL, '02 Hab dobles + 1 Triple en Paradisus Varadero del 28 al 31 ', 574, 'I ', '1'),
(89, NULL, NULL, NULL, 1, '2015-02-25', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'de Marzo + Traslados Privados, Seguro de Viaje y Visas', 574, 'I ', '1'),
(90, NULL, NULL, NULL, 0, '2015-02-27', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1992.00, 0.00, 'BEATRIZ ISABEL MOLINA CAÑAS', 'PAQUETE EUROPA LONDRES PARIS CAPITALES IMP.HAB DOB 14 D+ SEG', 485, 'C ', '3'),
(91, NULL, NULL, NULL, 0, '2015-03-03', 'HOTELES', 'RINSA TOURS                                                                                         ', 1684.00, 0.00, 'ALLE/ALEJANDRO, ZABLAH/EDUARDO, BAHAIA/ELIAS', '03 Hab. Sencillas, Hotel Quinta Real Inn Suites Chicago,', 137194, 'C ', '1'),
(92, NULL, NULL, NULL, 1, '2015-03-03', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'del 25 al 27 de Febrero 2015', 137194, 'C ', '1'),
(93, NULL, NULL, NULL, 0, '2015-03-03', 'PAQUETES', 'RINSA TOURS                                                                                         ', 5280.00, 0.00, NULL, 'Paquete a Costa Rica, Htl. Best Western Irazú, Htl. Copa del', 577, 'I ', '1'),
(94, NULL, NULL, NULL, 1, '2015-03-03', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'Arbol y Htl. Magic Mountain.', 577, 'I ', '1'),
(95, NULL, NULL, NULL, 2, '2015-03-03', 'PAQUETES', 'RINSA TOURS                                                                                         ', 264.00, 0.00, NULL, 'Complemento de Paquete', 577, 'I ', '1'),
(96, NULL, NULL, NULL, 0, '2015-02-24', 'ENTRADAS A EVENTOS', 'RINSA TOURS                                                                                         ', 950.00, 0.00, 'Dr. Roberto Vides Casanova', 'Inscripcion a congreso ISAKOS 2015, 07 al 11 Junio 2015', 137027, 'C ', '1'),
(97, NULL, NULL, NULL, 0, '2015-02-26', 'HOTELES', 'RINSA TOURS                                                                                         ', 1684.00, 0.00, 'Alle/Alejandro, Eduardo Zablah y Bahaia/Elias ', '3 Hab Sencillas Hotel Quinta inn Suites Chicago 25 al 27Feb ', 137114, 'C ', '1'),
(98, NULL, NULL, NULL, 0, '2015-02-27', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 563.00, 0.00, 'VELASQUEZ/ANA MARIA', 'SEGURO DE VIAJE, PLAN VALUE', 576, 'I ', '1'),
(99, NULL, NULL, NULL, 0, '2015-03-05', 'HOTELES', 'RINSA TOURS                                                                                         ', 1457.34, 0.00, 'Claudia Arevalo y Guillermo Hasbun', 'Pago alojamiento en Hab. Doble, en Lima/Cuzco/Valle Sagrado.', 153980, 'F ', '1'),
(100, NULL, NULL, NULL, 0, '2015-03-06', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 137324, 'C ', '1'),
(101, NULL, NULL, NULL, 0, '2015-03-07', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 249.30, 0.00, ' Jelpi Larios', 'Alquiler de auto en Miami del 11 al 15 de Marzo con DOLLAR ', 137337, 'C ', '1'),
(102, NULL, NULL, NULL, 0, '2015-03-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 378.00, 0.00, 'ARCE/ANDRES', 'ALOJAMIENTO EN HOTEL RAMADA PLAZA PANAMA 09 AL 12 MAR', 154032, 'F ', '1'),
(103, NULL, NULL, NULL, 0, '2015-03-10', 'HOTELES', 'RINSA TOURS                                                                                         ', 930.00, 0.00, 'CARBALLOSA/VICTORIA ', 'ALOJAMIENTO EN HOTEL MARRISON 84 BOGOTA HAB SGL 22 AL 29MAR ', 154096, 'F ', '1'),
(104, NULL, NULL, NULL, 0, '2015-03-10', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 137452, 'C ', '1'),
(105, NULL, NULL, NULL, 0, '2015-03-10', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 137453, 'C ', '1'),
(106, NULL, NULL, NULL, 0, '2015-03-11', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 154161, 'F ', '1'),
(107, NULL, NULL, NULL, 0, '2015-03-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 850.00, 0.00, 'YU CHENG WO', 'PAGOD DE PAQUETE A CARTAGENA DEL 30 DE MARZO AL 3 DE ABRIL', 911, 'I ', '3'),
(108, NULL, NULL, NULL, 0, '2015-03-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 1339.00, 0.00, 'WEI CHIEH HUANG', 'PAGO DE PAQUETE A CARTAGENA HOTEL ALMIRANTE, HAB. DOBLE', 912, 'I ', '3'),
(109, NULL, NULL, NULL, 0, '2015-03-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 268.47, 0.00, 'Jesus orlando Duran', 'Hab. con desayuno en hotel NH-Mexico Refomra, 09/13 Feb.', 137518, 'C ', '1'),
(110, NULL, NULL, NULL, 0, '2015-02-12', 'HOTELES', 'RINSA TOURS                                                                                         ', 654.00, 0.00, 'JUAN RICARDO MARIN AGUIRRE', '2 NOCHES EN HOTEL EN SANTO DOMINGO', 136676, 'C ', '1'),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3 NOCHES DE HOTEL EN PAN', NULL, NULL, NULL),
(112, NULL, NULL, NULL, 0, '2015-02-27', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 316.00, 0.00, 'Jose Guillermo Rodriguez', 'ALQUILER DE AUTO EN MIAMI, DEL 03 AL 07 DE MARZO 2015', 137121, 'C ', '1'),
(113, NULL, NULL, NULL, 0, '2015-02-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 1120.00, 0.00, 'German de Jesus Dominguezy y Gerardo Raudales', '6 noches de Hotel en Cali, Habitacion Doble, 01 al 07 Marzo ', 137122, 'C ', '1'),
(114, NULL, NULL, NULL, 0, '2015-02-27', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 237.00, 0.00, ' Angel Amilcar Figueroa', 'Alquiler de auto con Hertz en Miami, del 4 al 7 de Marzo', 137139, 'C ', '1'),
(115, NULL, NULL, NULL, 0, '2015-03-13', 'TRASLADOS', 'RINSA TOURS                                                                                         ', 650.00, 0.00, NULL, 'TRASLADO TERRESTRE SAL/SAP/SAL, 15 AL 20 MARZO, 2015', 154260, 'F ', '1'),
(116, NULL, NULL, NULL, 0, '2015-03-13', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 290.61, 0.00, NULL, 'Renta de vehículo  Luxury (Grupo I) LCAR del 19 al 22 de Mar', 154288, 'F ', '1'),
(117, NULL, NULL, NULL, 0, '2015-03-17', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1312.00, 0.00, NULL, 'ALOJAMIENTO Y SALA DE CONFERENCIAS, EVENTO DE REUMATOLOGIA', 137668, 'C ', '1'),
(118, NULL, NULL, NULL, 1, '2015-03-17', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'EN HOTEL DECAMERON SALINITAS, 14 Y 15 DE MARZO 2015', 137668, 'C ', '1'),
(119, NULL, NULL, NULL, 0, '2015-03-17', 'PAQUETES', 'RINSA TOURS                                                                                         ', 657.67, 0.00, NULL, 'ALOJAMIENTO Y SALA DE CONFERENCIAS, EVENTO DE REUMATOLOGIA,', 154397, 'F ', '1'),
(120, NULL, NULL, NULL, 1, '2015-03-17', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'EN HOTEL DECAMERON SALINITAS, 14 Y 15 DE MARZO 2015', 154397, 'F ', '1'),
(121, NULL, NULL, NULL, 0, '2015-03-18', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 376.00, 0.00, NULL, '04 SEGUROS DE VIAJE, POR 18 DIAS', 154400, 'F ', '1'),
(122, NULL, NULL, NULL, 0, '2015-03-18', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 95.00, 0.00, 'SEGURO DE VIAJE', NULL, 154427, 'F ', '1'),
(123, NULL, NULL, NULL, 0, '2015-03-24', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 76.00, 0.00, NULL, 'TRAVEL ACE', 154617, 'F ', '1'),
(124, NULL, NULL, NULL, 0, '2015-03-25', 'HOTELES', 'RINSA TOURS                                                                                         ', 520.00, 0.00, 'PASAJEROS FLAMENCO, JUAREZ, LOPEZ Y GARCIA', 'SERVICIOS DE HOTEL EN SAN PEDRO SULA, 4 HABITACIONES SGL', 137873, 'C ', '1'),
(125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, NULL, NULL, NULL, 0, '2015-03-25', 'HOTELES', 'RINSA TOURS                                                                                         ', 213.21, 0.00, 'Emerson Benjamin Martinez', '1 habitacion sencilla en Hotel Tropico Inn San Miguel', 137874, 'C ', '1'),
(127, NULL, NULL, NULL, 0, '2015-03-25', 'PAQUETES', 'RINSA TOURS                                                                                         ', 14271.00, 0.00, 'Gradis de Peraza X 04 PAX.', 'PAQUETE A PERU + CRUCE TRASANDINO 27 MAR AL 08 APR 2015', 154675, 'F ', '1'),
(128, NULL, NULL, NULL, 0, '2015-02-18', 'ENTRADAS A EVENTOS', 'RINSA TOURS                                                                                         ', 450.00, 0.00, 'Dr. Luis Enrique Chavez Gomez', 'Inscripcion a XVIII Congreso Latinoamericano de Alergia Asma', 136879, 'C ', '1'),
(129, NULL, NULL, NULL, 1, '2015-02-18', 'ENTRADAS A EVENTOS', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'e Inmunologia en Buenos Aires SLAAI 2015, 14 al 16 Marzo', 136879, 'C ', '1'),
(130, NULL, NULL, NULL, 0, '2015-02-26', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1294.00, 0.00, 'SERPAS/NORA/CARLOS/ALFREDO/MORENA.', 'Pago de paquete a Panamá en Htl.  Hard Rock', 153750, 'F ', '1'),
(131, NULL, NULL, NULL, 0, '2015-02-27', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1992.00, 0.00, 'RENE ISAAC DIAZ AVENDAÑO', 'PAQUETE EUROPA LONDRES PARIS CAPITALES IMP.HAB DOB 14D+SEGUR', 887, 'I ', '3'),
(132, NULL, NULL, NULL, 0, '2015-03-03', 'HOTELES', 'RINSA TOURS                                                                                         ', 160.00, 0.00, 'PAPANICOLAU/ESTEBAN', 'ALOJAMIENTO HTL. HARD ROCK  CHICAGO25/26 FEBRERO', 137195, 'C ', '1'),
(133, NULL, NULL, NULL, 0, '2015-03-04', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 37.00, 0.00, NULL, 'SEGURO DE VIAJE', 153908, 'F ', '1'),
(134, NULL, NULL, NULL, 0, '2015-03-05', 'HOTELES', 'RINSA TOURS                                                                                         ', 530.00, 0.00, 'WILMER CANAS', '03 NOCHES DE ALOJAMIENTO EN HOTEL HENRY MORGAN DE ROATAN, ', 137286, 'C ', '1'),
(135, NULL, NULL, NULL, 0, '2015-03-05', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 135.00, 0.00, NULL, 'SEGURO DE VIAJE', 153959, 'F ', '1'),
(136, NULL, NULL, NULL, 0, '2015-03-09', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 49.00, 0.00, NULL, 'TRAVEL ACE, PLAN EUROPA, POR 8 DIAS', 578, 'I ', '1'),
(137, NULL, NULL, NULL, 0, '2015-03-10', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 154103, 'F ', '1'),
(138, NULL, NULL, NULL, 0, '2015-03-10', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 137431, 'C ', '1'),
(139, NULL, NULL, NULL, 0, '2015-03-11', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 154185, 'F ', '1'),
(140, NULL, NULL, NULL, 0, '2015-03-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 208.52, 0.00, 'Leonid Haroldo Deleon', 'Hab. con desayuno en hotel NH-Mexico Refomra, 09 al 12 Feb. ', 137512, 'C ', '1'),
(141, NULL, NULL, NULL, 0, '2015-03-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 208.52, 0.00, 'Morgan Ernesto Evora', 'Hab. con desayuno en hotel NH-Mexico Refomra, 09 / 12 Feb', 137517, 'C ', '1'),
(142, NULL, NULL, NULL, 0, '2015-03-13', 'TRASLADOS', 'RINSA TOURS                                                                                         ', 650.00, 0.00, NULL, 'TRASLADO TERRESTRE SAL/SAP/SAL, 15 AL 20 MARZO 2015', 154261, 'F ', '1'),
(143, NULL, NULL, NULL, 0, '2015-03-25', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 133.90, 0.00, 'Claudia Arevalo y Guillermo Hasbun. ', '02 Asistencias de Viajes Travel Ace / Plan Valué X 9 días', 154676, 'F ', '1'),
(144, NULL, NULL, NULL, 0, '2015-02-26', 'HOTELES', 'RINSA TOURS                                                                                         ', 4980.00, 0.00, 'ADRIANA LISSETTE SANTOS DE PEREZ', 'PAGO DE PAQUETE ORLANDO SEMANA SANTA 2015 HABITACION TRIPLE ', 883, 'I ', '3'),
(145, NULL, NULL, NULL, 0, '2015-02-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 210.00, 0.00, NULL, '01 HABITACION SENCILLA EN HOTEL RADISSON DE GUATEMALA', 575, 'I ', '1'),
(146, NULL, NULL, NULL, 1, '2015-02-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'DEL 2/3 DE MARZO', 575, 'I ', '1'),
(147, NULL, NULL, NULL, 0, '2015-02-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 210.00, 0.00, 'JORGE ZABLAH', '01 HABITACION SENCILLA EN HOTEL RADISSON DE GUATEMALA ', 137145, 'C ', '1'),
(148, NULL, NULL, NULL, 1, '2015-02-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'DEL 02 AL 03 MARZO', 137145, 'C ', '1'),
(149, NULL, NULL, NULL, 0, '2015-03-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 95.95, 0.00, ' Morgan Evora', '01 Hab. Sencilla, Htl. Hilton Garden Panama, 08 al 09 Marzo ', 137393, 'C ', '1'),
(150, NULL, NULL, NULL, 0, '2015-03-27', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 206.00, 0.00, 'David Ernesto Rodriguez', 'Alquiler de carro por dos dias en Miami, con Dollar ', 137902, 'C ', '1'),
(151, NULL, NULL, NULL, 0, '2015-03-27', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 206.00, 0.00, 'David Ernesto Rodriguez', 'Alquiler de carro por dos dias en Miami, con Dollar ', 137903, 'C ', '1'),
(152, NULL, NULL, NULL, 0, '2015-03-27', 'HOTELES', 'RINSA TOURS                                                                                         ', 121.00, 0.00, 'David Contreras ', 'Hotel DoubleTree by Hilton Panama 08Abril 1 Hab Sgl ', 137909, 'C ', '1'),
(153, NULL, NULL, NULL, 0, '2015-03-31', 'HOTELES', 'RINSA TOURS                                                                                         ', 142.14, 0.00, 'Emerson Martinez', 'Alojamiento en Hotel Tropico Inn de San Miguel, 30 MARZO AL ', 138024, 'C ', '1'),
(154, NULL, NULL, NULL, 1, '2015-03-31', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'al 01 de Abril 2015', 138024, 'C ', '1'),
(155, NULL, NULL, NULL, 0, '2015-04-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 355.35, 0.00, ' Emerson Martinez', '1 Habitacion en hotel Tropico Inn, 6 al 11 abril.', 138117, 'C ', '1'),
(156, NULL, NULL, NULL, 0, '2015-04-08', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1077.90, 0.00, 'ROBERTO NAPOLEON RAMIREZZ', 'PAQUETE A SAN JOSE COSTA RICA, 12 AL 15 APR 2015', 154908, 'F ', '1'),
(157, NULL, NULL, NULL, 0, '2015-04-09', 'HOTELES', 'RINSA TOURS                                                                                         ', 335.05, 0.00, 'Aquino/Vanessa', 'Alojamiento  hotel Sheraton panama 27-30abril 1hab sgl', 138288, 'C ', '1'),
(158, NULL, NULL, NULL, 0, '2015-04-15', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 235.00, 0.00, 'David Rodriguez', 'Semana de alquiler de auto con Dollar en Miami, 26/30 Abril ', 138505, 'C ', '1'),
(159, NULL, NULL, NULL, 0, '2015-04-15', 'HOTELES', 'RINSA TOURS                                                                                         ', 3185.00, 0.00, 'Dr. Nelson Vladimir Alvarenga', '1 Habitacion sencilla en hotel Grand Hyatt Washington, 15 al', 138506, 'C ', '1'),
(160, NULL, NULL, NULL, 1, '2015-04-15', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, '20 de Mayo, asistente a congreso medico DDW2015', 138506, 'C ', '1'),
(161, NULL, NULL, NULL, 0, '2015-04-16', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 734.03, 0.00, ' Rafael Escalón', 'Renta de vehículo en Savannah del 29 de Mayo al 04 de Junio', 138521, 'C ', '1'),
(162, NULL, NULL, NULL, 0, '2015-04-17', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, ' Dr. Roberto Vides Casanova', 'Travel Ace Europa, del 4 al 13 Junio en Lyon Francia', 138558, 'C ', '1'),
(163, NULL, NULL, NULL, 0, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1614.00, 0.00, NULL, ' 01 habitación doble en paquete Italia bella del 4/11 de oct', 580, 'I ', '1'),
(164, NULL, NULL, NULL, 1, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'con inicio en Milán y fin en Roma con seguro Travel Ace,', 580, 'I ', '1'),
(165, NULL, NULL, NULL, 2, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'plan Europa', 580, 'I ', '1');
INSERT INTO `invoiced_services` (`id`, `services_sales_provider_id`, `services_sales_type_id`, `fulfillment_branch_office_goal_id`, `numero`, `fecha`, `tipo_servicio`, `proveedor_servicio`, `tarifa`, `iva`, `pasajero`, `descripcion`, `correlativo_comprobante`, `tipo_documento`, `sucursal`) VALUES
(166, NULL, NULL, NULL, 0, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 1614.00, 0.00, NULL, '01 habitación doble en paquete Italia bella del 4/11 de oct.', 581, 'I ', '1'),
(167, NULL, NULL, NULL, 1, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'con inicio en Milán y fin en Roma con seguro Travel Ace,', 581, 'I ', '1'),
(168, NULL, NULL, NULL, 2, '2015-04-20', 'PAQUETES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'plan Europa', 581, 'I ', '1'),
(169, NULL, NULL, NULL, 0, '2015-04-20', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 54.00, 0.00, NULL, '3 TRAVEL ACE  Master a nombre de Yanira Valencia, ', 138607, 'C ', '1'),
(170, NULL, NULL, NULL, 1, '2015-04-20', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, ' Javier Turcios y Karina Rosa de Avila', 138607, 'C ', '1'),
(171, NULL, NULL, NULL, 0, '2015-04-20', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 138658, 'C ', '1'),
(172, NULL, NULL, NULL, 0, '2015-04-22', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 138751, 'C ', '1'),
(173, NULL, NULL, NULL, 0, '2015-03-18', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 58.00, 0.00, NULL, 'SEGURO DE VIAJE', 154401, 'F ', '1'),
(174, NULL, NULL, NULL, 0, '2015-03-23', 'HOTELES', 'RINSA TOURS                                                                                         ', 443.97, 0.00, ' Leonid Deleon', 'Habitacion sencilla en hotel Dann Carlton Quito, 18/20 Marzo', 137824, 'C ', '1'),
(175, NULL, NULL, NULL, 0, '2015-03-23', 'HOTELES', 'RINSA TOURS                                                                                         ', 483.56, 0.00, 'Salvador Argueta y Carlos Hernandez', 'Habitacion doble en hotel Dann Carlton Quito, 18/20 Marzo', 137826, 'C ', '1'),
(176, NULL, NULL, NULL, 0, '2015-04-16', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 74.00, 0.00, NULL, '02 SEGUROS DE VIAJE A CUBA', 155248, 'F ', '1'),
(177, NULL, NULL, NULL, 0, '2015-04-23', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 194.67, 0.00, 'Yesenia Ayala/ Blanco/Wendy/Horacio/Maria', '04 Asistencias de Viajes Travel Ace/Plan Value Anual', 582, 'I ', '1'),
(178, NULL, NULL, NULL, 0, '2015-04-25', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 220.00, 0.00, 'David Rodriguez', 'Semana de alquiler de auto con Dollar en Miami, del', 138904, 'C ', '1'),
(179, NULL, NULL, NULL, 1, '2015-04-25', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, '16 al 30 de Abril 2015', 138904, 'C ', '1'),
(180, NULL, NULL, NULL, 0, '2015-04-27', 'RENTA DE AUTOS', 'RINSA TOURS                                                                                         ', 195.00, 0.00, 'EDGAR MAURICIO AGUILAR', 'RENTA DE AUTO CON DOLLAR, ', 583, 'I ', '1'),
(181, NULL, NULL, NULL, 0, '2015-04-28', 'PAQUETES', 'RINSA TOURS                                                                                         ', 318.00, 0.00, NULL, 'HOTEL EN SAN SALVADOR, HILTON PRINCESS, 02 HABITACIONES', 155745, 'F ', '1'),
(182, NULL, NULL, NULL, 0, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 300.00, 0.00, NULL, 'HOTEL EN TEGUCIGALPA, 02 HABITACIONES', 155746, 'F ', '1'),
(183, NULL, NULL, NULL, 1, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 360.00, 0.00, NULL, 'HOTEL EN MANAGUA, 02 HABITACIONES', 155746, 'F ', '1'),
(184, NULL, NULL, NULL, 2, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 356.00, 0.00, NULL, 'HOTEL EN SAN SALVADOR, CROWNE PLAZA, 02 HABITACIONES', 155746, 'F ', '1'),
(185, NULL, NULL, NULL, 0, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 2340.00, 0.00, 'Dr. Jorge Sergio Hasbun', 'Habitacion doble en Hotel Hard Rock y Casino en Punta Cana, ', 138955, 'C ', '1'),
(186, NULL, NULL, NULL, 1, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'Para las fechas del 20 al 26 Septiembre 2015, XXIX CONGRESO ', 138955, 'C ', '1'),
(187, NULL, NULL, NULL, 2, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, NULL, 'CENTROAMERICANO Y DEL CARIBE DE DERMATOLOGIA 2015', 138955, 'C ', '1'),
(188, NULL, NULL, NULL, 0, '2015-04-24', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, NULL, 'SEGURO DE VIAJE', 138861, 'C ', '1'),
(189, NULL, NULL, NULL, 0, '2015-04-27', 'SEGUROS DE VIAJE', 'RINSA TOURS                                                                                         ', 8.40, 1.09, NULL, 'COMISION FACTURA 2527', 138921, 'C ', '1'),
(190, NULL, NULL, NULL, 0, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 300.00, 0.00, NULL, 'HOTEL EN TEGUCIGALPA, 2 HABITACIONES', 155744, 'F ', '1'),
(191, NULL, NULL, NULL, 1, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 360.00, 0.00, NULL, 'HOTEL EN MANAGUA, 02 HABITACIONES', 155744, 'F ', '1'),
(192, NULL, NULL, NULL, 2, '2015-04-28', 'HOTELES', 'RINSA TOURS                                                                                         ', 356.00, 0.00, NULL, 'HOTEL EN SAN SALVADOR, CROWNE PLAZA, 02 HABITACIONES', 155744, 'F ', '1'),
(193, NULL, NULL, NULL, 0, '2015-04-29', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 27.00, 0.00, 'Mario Adalberto Santacruz', 'Travel Ace Master  del 11 al 15 de mayo.', 139039, 'C ', '1'),
(194, NULL, NULL, NULL, 0, '2015-05-05', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 48.00, 0.00, 'BARBA ARUBUJA/LORENA', 'SEGURO DE VIAJES', 155988, 'F ', '1'),
(195, NULL, NULL, NULL, 0, '2015-05-05', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 116.00, 0.00, 'Jimmy Martinez y Carlos Perez ', '02 TRAVEL ACE, PLAN VALUE, POR 08 DIAS', 139254, 'C ', '1'),
(196, NULL, NULL, NULL, 0, '2015-05-05', 'TRAVEL ACE', 'RINSA TOURS                                                                                         ', 37.00, 0.00, 'DIAZ/NIDIA', 'Asistencia de Viajes Travel Ace/Plan Value', 156020, 'F ', '1'),
(197, NULL, NULL, NULL, 0, '2015-05-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 545.00, 0.00, 'Jose Humberto Flores', 'Traslados en Bus Platinun + 04 noches de alojamiento en ', 156048, 'F ', '1'),
(198, NULL, NULL, NULL, 1, '2015-05-06', 'HOTELES', 'RINSA TOURS                                                                                         ', 0.00, 0.00, '.', 'Hotel Plaza Florencia, Tegucigalpa', 156048, 'F ', '1'),
(199, NULL, NULL, NULL, 0, '2015-05-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 629.40, 0.00, 'JULIETA HIDALGO', 'PAQUETE A PANAMA 2 ADULTOS + UN INF DEL 01 AL 04 MAYO', 970, 'I ', '3'),
(200, NULL, NULL, NULL, 0, '2015-05-08', 'HOTELES', 'RINSA TOURS                                                                                         ', 629.40, 0.00, 'JULIETA HIDALGO', 'PAQUETE PANAMA 2 ADULTOS + UN INF DEL 01 AL 04 MAYO 2015', 971, 'I ', '3'),
(201, NULL, NULL, NULL, 0, '2015-05-08', 'PAQUETES', 'RINSA TOURS                                                                                         ', 980.00, 0.00, 'Atilio Maldonado y Marta Abrego', 'Paquete a Cuba en hoteles Melia del 3-7 de Junio', 156222, 'F ', '1'),
(202, NULL, NULL, NULL, 0, '2015-05-11', 'HOTELES', 'RINSA TOURS                                                                                         ', 48.00, 0.00, 'FRIDA MARINEE VASQUEZ DE CISNEROS', '2 POLIZAS DE TRAVEL ACE PLAN MASTER DEL 12 AL 17 DE MAYO/15 ', 973, 'I ', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoiced_tickets`
--

CREATE TABLE IF NOT EXISTS `invoiced_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `airline_id` int(11) DEFAULT NULL,
  `itinerary_invoiced_ticket_id` int(11) DEFAULT NULL,
  `tickets_sales_destiny_id` int(11) DEFAULT NULL,
  `tickets_sales_route_id` int(11) DEFAULT NULL,
  `fulfillment_branch_office_goal_id` int(11) DEFAULT NULL,
  `boleto` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `ruta` varchar(80) DEFAULT NULL,
  `destino` varchar(3) DEFAULT NULL,
  `pasajero` varchar(30) DEFAULT NULL,
  `tarifa` decimal(12,2) DEFAULT NULL,
  `fee` float(8,2) DEFAULT NULL,
  `complemento` float(8,2) DEFAULT NULL,
  `coorrelativo_comprobante` int(11) DEFAULT NULL,
  `tipo_documento` varchar(30) DEFAULT NULL,
  `sucursal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_14` (`itinerary_invoiced_ticket_id`),
  KEY `fk_reference_15` (`tickets_sales_destiny_id`),
  KEY `fk_reference_16` (`tickets_sales_route_id`),
  KEY `fk_reference_20` (`fulfillment_branch_office_goal_id`),
  KEY `fk_reference_8` (`airline_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=197 ;

--
-- Volcado de datos para la tabla `invoiced_tickets`
--

INSERT INTO `invoiced_tickets` (`id`, `airline_id`, `itinerary_invoiced_ticket_id`, `tickets_sales_destiny_id`, `tickets_sales_route_id`, `fulfillment_branch_office_goal_id`, `boleto`, `fecha`, `ruta`, `destino`, `pasajero`, `tarifa`, `fee`, `complemento`, `coorrelativo_comprobante`, `tipo_documento`, `sucursal`) VALUES
(1, 1, 54, NULL, NULL, NULL, '4751422248', '2015-01-22', '39906', 'ALH', 'CORTEZ/JOSE MAURICIO          ', '3778.00', 0.00, 0.00, 152456, 'F', '1'),
(2, 1, 24, NULL, NULL, NULL, '4762005391', '2015-01-29', '39963', 'AAT', 'GUZMAN/DE SANCHEZ NELLY       ', '884.00', 50.00, 0.00, 28164, 'F', '1'),
(3, 1, 24, NULL, NULL, NULL, '4762005388', '2015-01-29', '39963', 'AAT', 'FLORES/DE LOPEZ TERESA        ', '884.00', 50.00, 0.00, 28119, 'F', '1'),
(4, 1, 24, NULL, NULL, NULL, '4762006833', '2015-02-03', '40006', 'AAT', 'SALAZAR/DE MAGANA NORA        ', '1034.00', 50.00, 0.00, 28187, 'F', '1'),
(5, 1, 23, NULL, NULL, NULL, '8953293481', '2015-04-09', '33623', 'AAR', 'TORRES CHAVEZ/MARVIN ALEXANDER', '1335.00', 0.00, 0.00, 138313, 'C', '1'),
(6, 1, 23, NULL, NULL, NULL, '9226776968', '2015-05-12', '33623', 'AAR', 'GOMEZ/RAUL                    ', '1365.00', 0.00, 0.00, 156429, 'F', '1'),
(7, 1, 23, NULL, NULL, NULL, '9226783130', '2015-05-28', '33623', 'AAR', 'MEJIA/HENRY                   ', '1335.00', 0.00, 0.00, 157186, 'F', '1'),
(8, 1, 44, NULL, NULL, NULL, '9379086935', '2015-06-13', '10497', 'AJF', 'VENTURA/WALTER                ', '377.00', 25.00, 0.00, 29559, 'F', '1'),
(9, 1, 44, NULL, NULL, NULL, '9379086937', '2015-06-13', '10497', 'AJF', 'VALENCIA DE VENTURA/NORMA     ', '377.00', 25.00, 0.00, 29559, 'F', '1'),
(10, 1, 3, NULL, NULL, NULL, '2710838626', '2015-05-25', '12283', ' PO', 'TAMAYO/VICTORIA               ', '175.00', 0.00, 0.00, 156981, 'F', '1'),
(11, 1, 93, NULL, NULL, NULL, '4762011494', '2015-03-03', '40229', 'ASA', 'CHAVEZ/ALVARO                 ', '967.11', 25.00, 0.00, 28482, 'F', '1'),
(12, 1, 100, NULL, NULL, NULL, '4762010519', '2015-02-24', '40158', 'AST', 'AUGSPURG/ROBERTO              ', '4492.00', 35.00, 115.00, 137041, 'C', '1'),
(13, 1, 24, NULL, NULL, NULL, '9214800056', '2015-04-11', '40521', 'AAT', 'MONTALVO/CONSTANCE            ', '999.00', 0.00, 0.00, 138379, 'C', '1'),
(14, 1, 100, NULL, NULL, NULL, '9214806374', '2015-05-11', '40782', 'AST', 'NEUWALD/EDWARD                ', '3081.00', 0.00, 0.00, 29196, 'F', '1'),
(15, 1, 100, NULL, NULL, NULL, '9214806368', '2015-05-11', '40782', 'AST', '                              ', '94.97', 0.00, 0.00, 29196, 'F', '1'),
(16, 1, 100, NULL, NULL, NULL, '9214806369', '2015-05-11', '40782', 'AST', 'NEUWALD/EDWARD                ', '94.97', 0.00, 0.00, 29196, 'F', '1'),
(17, 1, 100, NULL, NULL, NULL, '9214806372', '2015-05-11', '40782', 'AST', '                              ', '3081.00', 0.00, 0.00, 29196, 'F', '1'),
(18, 1, 93, NULL, NULL, NULL, '9214808114', '2015-05-18', '40833', 'ASA', 'MIKLY/MARIA HELENA            ', '839.00', 20.00, 0.00, 11655, 'C', '1'),
(19, 1, 28, NULL, NULL, NULL, '9214810924', '2015-05-29', '40922', 'ADM', 'GLOWER/GUILLERMO              ', '1037.00', 100.00, 0.00, 11748, 'C', '1'),
(20, 2, 28, NULL, NULL, NULL, '9214810926', '2015-05-29', '40922', 'ADM', 'MENDOZA/MARCELA               ', '1037.00', 100.00, 0.00, 11748, 'C', '1'),
(21, 2, 26, NULL, NULL, NULL, '9379086563', '2015-06-11', '41019', 'ABR', 'ZABLAH/MARIA PILAR            ', '2142.00', 150.00, 0.00, 140891, 'C', '1'),
(22, 2, 64, NULL, NULL, NULL, '9379086616', '2015-06-11', '41028', 'AMI', 'PALA/SEBASTIAN                ', '885.00', 0.00, 0.00, 157845, 'F', '1'),
(23, 2, 64, NULL, NULL, NULL, '9379086618', '2015-06-11', '41028', 'AMI', 'PALA/ANA PAULA                ', '885.00', 0.00, 0.00, 157844, 'F', '1'),
(24, 2, 76, NULL, NULL, NULL, '4762006180', '2015-06-05', '40979', 'AMU', 'RODRIGUEZ/ELIAS               ', '4581.00', 0.00, 0.00, 140900, 'C', '1'),
(25, 2, 76, NULL, NULL, NULL, '4762006182', '2015-06-05', '40979', 'AMU', 'CALLEJAS/JUAN CARLOS          ', '4581.00', 0.00, 0.00, 140900, 'C', '1'),
(26, 2, 57, NULL, NULL, NULL, '9379086601', '2015-06-11', '41030', 'ALI', 'RIVERA/MIGUEL                 ', '580.41', 0.00, 0.00, 29545, 'F', '1'),
(27, 2, 57, NULL, NULL, NULL, '9379086604', '2015-06-11', '41030', 'ALI', 'MENDOZA/DE RIVERA ERIKA       ', '1929.00', 30.25, 0.00, 29546, 'F', '1'),
(28, 2, 77, NULL, NULL, NULL, '4762011133', '2015-03-02', '31804', 'AMX', 'ALVARADO/AQUINO WILVER MATEO  ', '885.00', 50.00, 0.00, 28456, 'F', '1'),
(29, 2, 77, NULL, NULL, NULL, '4762011135', '2015-03-02', '31804', 'AMX', 'ALVARADO/RIVAS CHRISTOPHE INF ', '89.00', 200.00, 0.00, 28456, 'F', '1'),
(30, 2, 77, NULL, NULL, NULL, '4762011137', '2015-03-02', '31804', 'AMX', 'RIVAS/ARAUJO CLAUDIA MARIA    ', '885.00', 50.00, 0.00, 28456, 'F', '1'),
(31, 2, 77, NULL, NULL, NULL, '4762011139', '2015-03-02', '31804', 'AMX', 'ALVARADO/RIVAS WILVER JOS CHD ', '664.00', 50.00, 0.00, 28456, 'F', '1'),
(32, 2, 51, NULL, NULL, NULL, '9214800169', '2015-04-13', '40538', 'AKR', 'LOPEZ/RODRIGUEZ NUBIA         ', '1064.00', 94.23, 0.00, 28875, 'F', '1'),
(33, 2, 93, NULL, NULL, NULL, '9214799153', '2015-04-08', '40486', 'ASA', 'GARDELLA/MARC                 ', '145.00', 170.43, 0.00, 154913, 'F', '1'),
(34, 2, 73, NULL, NULL, NULL, '9214802513', '2015-04-23', '30585', 'AMS', 'GEESINK/PETER                 ', '3781.00', 0.00, 0.00, 155617, 'F', '1'),
(35, 2, 44, NULL, NULL, NULL, '9214805273', '2015-05-11', '39207', 'AJF', 'GATTULLI/LISA                 ', '970.00', 0.00, 0.00, 156372, 'F', '1'),
(36, 2, 73, NULL, NULL, NULL, '9214806426', '2015-05-12', '40787', 'AMS', 'SAENZ/DOMINGO ARMANDO MR      ', '1470.31', 0.00, 0.00, 156367, 'F', '1'),
(37, 2, 73, NULL, NULL, NULL, '9214806427', '2015-05-12', '40787', 'AMS', 'CHAVEZ/MARVIN ANTONIO MR      ', '1470.31', 0.00, 0.00, 156366, 'F', '1'),
(38, 2, 29, NULL, NULL, NULL, '9214807860', '2015-05-16', '40824', 'ADZ', 'MENDEZ/RICARDO                ', '191.00', 26.55, 0.00, 29231, 'F', '1'),
(39, 2, 29, NULL, NULL, NULL, '9214807861', '2015-05-16', '40824', 'ADZ', 'GUARDADO/AMALY                ', '191.00', 26.55, 0.00, 29231, 'F', '1'),
(40, 3, 29, NULL, NULL, NULL, '9214807862', '2015-05-16', '40824', 'ADZ', '                              ', '19.00', 26.55, 0.00, 29231, 'F', '1'),
(41, 3, 93, NULL, NULL, NULL, '9214810891', '2015-06-05', '13024', 'ASA', 'MAHECHA/DIANA                 ', '726.00', 0.00, 0.00, 157547, 'F', '1'),
(42, 3, 84, NULL, NULL, NULL, '9214812627', '2015-06-04', '40967', 'APT', 'SALLABERRY/SYLVIA             ', '965.00', 36.18, 0.00, 140626, 'C', '1'),
(43, 3, 52, NULL, NULL, NULL, '9214812926', '2015-06-05', '31535', 'ALC', 'HERNANDEZ/CRISTINA            ', '904.00', 50.00, 0.00, 29454, 'F', '1'),
(44, 3, 29, NULL, NULL, NULL, '4762003818', '2015-01-23', '30413', 'ADZ', 'GALLEGO/CARLOS MARIO          ', '691.00', 0.00, 0.00, 152534, 'F', '1'),
(45, 3, 76, NULL, NULL, NULL, '4762004867', '2015-01-28', '37910', 'AMU', 'CHEVEZ/RENE SAMUEL            ', '986.00', 37.23, 0.00, 152838, 'F', '1'),
(46, 3, 76, NULL, NULL, NULL, '4762004869', '2015-01-28', '37910', 'AMU', 'HERNANDEZ/NINIVE YASMIN       ', '986.00', 37.23, 0.00, 152839, 'F', '1'),
(47, 3, 39, NULL, NULL, NULL, '4762006132', '2015-03-11', '9334', 'AHA', 'SOMOZA/CAROLINA               ', '3907.00', 0.00, 0.00, 138099, 'C', '1'),
(48, 3, 22, NULL, NULL, NULL, '8953281001', '2015-02-23', '35365', 'ACD', 'GIRON/ANA ELIZABETH           ', '699.00', 0.00, 0.00, 137014, 'C', '1'),
(49, 3, 22, NULL, NULL, NULL, '8953281003', '2015-02-23', '35365', 'ACD', 'JUAREZ/MARTIN                 ', '699.00', 0.00, 0.00, 137014, 'C', '1'),
(50, 3, 22, NULL, NULL, NULL, '8953281007', '2015-02-23', '35365', 'ACD', 'JUAREZ/ARIANNE(INF)           ', '30.00', 0.00, 0.00, 137014, 'C', '1'),
(51, 3, 22, NULL, NULL, NULL, '8953281010', '2015-02-23', '35365', 'ACD', 'MAGANA/LUICIANA MARIA(CHD)    ', '711.00', 0.00, 0.00, 137015, 'C', '1'),
(52, 3, 57, NULL, NULL, NULL, '8953286055', '2015-03-11', '40289', 'ALI', 'ARGUETA GAMEZ/EVELYN TATIANA  ', '1045.00', 0.00, 0.00, 137536, 'C', '1'),
(53, 3, 57, NULL, NULL, NULL, '8953286080', '2015-03-12', '40289', 'ALI', 'DOMINGUEZ SALVADOR/FRANCESCO M', '1045.00', 0.00, 0.00, 137562, 'C', '1'),
(54, 3, 23, NULL, NULL, NULL, '9214794939', '2015-03-16', '40343', 'ACT', 'PIOTRASZEWSKI/MARCO ANDRES    ', '807.00', 0.00, 0.00, 154410, 'F', '1'),
(55, 3, 100, NULL, NULL, NULL, '9214796061', '2015-03-18', '40360', 'AST', 'MONTERROSA/AMARIL             ', '462.00', 0.00, 0.00, 137702, 'C', '1'),
(56, 3, 78, NULL, NULL, NULL, '8953295902', '2015-04-14', '36719', 'ANA', 'MUNDO/FELIPE                  ', '790.00', 0.00, 0.00, 155218, 'F', '1'),
(57, 3, 78, NULL, NULL, NULL, '8953295904', '2015-04-14', '36719', 'ANA', 'MUNDO/SONIA MARLENE           ', '790.00', 0.00, 0.00, 155218, 'F', '1'),
(58, 3, 73, NULL, NULL, NULL, '9214794985', '2015-03-19', '30585', 'AMS', 'GEESINK/PETER                 ', '1299.00', 0.00, 0.00, 154567, 'F', '1'),
(59, 3, 100, NULL, NULL, NULL, '9214796063', '2015-03-18', '40360', 'AST', 'PALACIOS/MARCO ANTONIO        ', '462.00', 0.00, 0.00, 154448, 'F', '1'),
(60, 4, 3, NULL, NULL, NULL, '9226781962', '2015-05-26', '1007', 'LAX', 'GRIJALVA/CARMEN               ', '202.00', 0.00, 0.00, 157046, 'F', '1'),
(61, 4, 22, NULL, NULL, NULL, '9226781962', '2015-05-26', '1007', '8IA', 'GRIJALVA/CARMEN               ', '202.00', 0.00, 0.00, 157046, 'F', '1'),
(62, 4, 3, NULL, NULL, NULL, '9226781967', '2015-05-26', '1007', 'LAX', 'CUCUFATE/CARMEN               ', '202.00', 0.00, 0.00, 157049, 'F', '1'),
(63, 4, 22, NULL, NULL, NULL, '9226781967', '2015-05-26', '1007', '8IA', 'CUCUFATE/CARMEN               ', '202.00', 0.00, 0.00, 157049, 'F', '1'),
(64, 4, 73, NULL, NULL, NULL, '4762001319', '2015-01-06', '30702', 'AMS', 'FLORES/ROSA                   ', '729.00', 75.00, 0.00, 27906, 'F', '1'),
(65, 4, 57, NULL, NULL, NULL, '4762002582', '2015-01-15', '38932', 'ALI', 'ROJAS CRUZ/ ALVARO ANTONIO    ', '798.00', 94.81, 0.00, 27985, 'F', '1'),
(66, 4, 62, NULL, NULL, NULL, '9226790036', '2015-06-12', '36945', 'AMD', 'PITTA/MARIANO                 ', '850.00', 0.00, 0.00, 0, 27985, '1'),
(67, 4, 93, NULL, NULL, NULL, '9379086642', '2015-06-12', '41033', 'ASA', 'AGOSTINI/FEDERICO             ', '643.00', 0.00, 0.00, 0, 27985, '1'),
(68, 4, 52, NULL, NULL, NULL, '4751420879', '2015-01-20', '31535', 'ALC', 'PORTILLO SALAZAR/JOSE ERNESTO ', '1058.00', 0.00, 0.00, 135999, 'C', '1'),
(69, 4, 52, NULL, NULL, NULL, '4751420880', '2015-01-20', '31535', 'ALC', 'SALAZAR DE PORTILLO/BLANCA ROS', '1058.00', 0.00, 0.00, 136000, 'C', '1'),
(70, 4, 57, NULL, NULL, NULL, '93790866011', '2015-06-11', '41030', 'ALI', 'RIVERA/MIGUEL                 ', '1348.59', 30.25, 0.00, 11837, 'C', '1'),
(71, 4, 3, NULL, NULL, NULL, '4762003225', '2015-01-20', '10233', 'KIN', 'MENA/DAVID ERNESTO            ', '689.00', 35.00, 15.00, 135958, 'C', '1'),
(72, 4, 42, NULL, NULL, NULL, '4762003225', '2015-01-20', '10233', 'AIA', 'MENA/DAVID ERNESTO            ', '689.00', 35.00, 15.00, 135958, 'C', '1'),
(73, 4, 3, NULL, NULL, NULL, '4762003226', '2015-01-20', '10233', 'KIN', 'ROLDAN/GUILLERMO ERNESTO      ', '689.00', 35.00, 15.00, 135956, 'C', '1'),
(74, 4, 42, NULL, NULL, NULL, '4762003226', '2015-01-20', '10233', 'AIA', 'ROLDAN/GUILLERMO ERNESTO      ', '689.00', 35.00, 15.00, 135956, 'C', '1'),
(75, 4, 49, NULL, NULL, NULL, '9226773738', '2015-05-04', '40718', 'AKB', 'MARTINEZ TURCIOS/JOSE ATILIO  ', '1664.00', 0.00, 0.00, 139344, 'C', '1'),
(76, 4, 29, NULL, NULL, NULL, '9226784364', '2015-06-01', '40824', 'ADZ', 'HERNANDEZ/WENDY               ', '180.00', 0.00, 0.00, 140565, 'C', '1'),
(77, 4, 29, NULL, NULL, NULL, '9226784365', '2015-06-01', '40824', 'ADZ', 'KUNERT/BIVERLY                ', '180.00', 0.00, 0.00, 140566, 'C', '1'),
(78, 4, 73, NULL, NULL, NULL, '4762001503', '2015-01-07', '30702', 'AMS', 'ADEMA/JOKE                    ', '729.00', 75.00, 0.00, 151828, 'F', '1'),
(79, 4, 73, NULL, NULL, NULL, '4762001504', '2015-01-07', '30702', 'AMS', 'SIRI/JOHANNA                  ', '729.00', 75.00, 0.00, 151828, 'F', '1'),
(80, 5, 52, NULL, NULL, NULL, '9214809600', '2015-05-26', '31535', 'ALC', 'ALEMAN/MARIA YANIRA           ', '1102.00', 30.72, 0.00, 29282, 'F', '1'),
(81, 5, 3, NULL, NULL, NULL, '9214809695', '2015-05-27', '10115', 'SAL', 'RABUFFETTI/DOMENICO           ', '897.93', 35.00, 0.00, 140636, 'C', '1'),
(82, 5, 39, NULL, NULL, NULL, '9214809695', '2015-05-27', '10115', 'AHA', 'RABUFFETTI/DOMENICO           ', '897.93', 35.00, 0.00, 140636, 'C', '1'),
(83, 5, 29, NULL, NULL, NULL, '9214811857', '2015-06-02', '40949', 'ADZ', 'MARTINEZ/VICTOR MANUEL        ', '180.00', 0.00, 0.00, 157401, 'F', '1'),
(84, 5, 29, NULL, NULL, NULL, '92148094181', '2015-05-23', '3554', 'ADZ', 'ESCOBAR/JOSEMIGUEL            ', '174.96', 0.00, 0.00, 11701, 'C', '1'),
(85, 5, 85, NULL, NULL, NULL, '9214812995', '2015-06-05', '40560', 'AQP', 'BLANDON/HERBERTH              ', '412.00', 35.00, 0.00, 157624, 'F', '1'),
(86, 5, 85, NULL, NULL, NULL, '9214812996', '2015-06-05', '40560', 'AQP', 'ALFARO/MARIDA                 ', '412.00', 35.00, 0.00, 157623, 'F', '1'),
(87, 5, 3, NULL, NULL, NULL, '9214813680', '2015-06-09', '10138', 'LAX', 'SANDOVAL/DE GRIJALVA SANDRA   ', '334.00', 0.00, 0.00, 157724, 'F', '1'),
(88, 5, 93, NULL, NULL, NULL, '9214813680', '2015-06-09', '10138', 'ASA', 'SANDOVAL/DE GRIJALVA SANDRA   ', '334.00', 0.00, 0.00, 157724, 'F', '1'),
(89, 5, 29, NULL, NULL, NULL, '9226788341', '2015-06-09', '40929', 'ADZ', 'CORNEJO/ROSALINA              ', '180.00', 15.00, 0.00, 157784, 'F', '1'),
(90, 5, 29, NULL, NULL, NULL, '92148094182', '2015-05-23', '3554', 'ADZ', 'ESCOBAR/JOSEMIGUEL            ', '35.04', 0.00, 0.00, 29295, 'F', '1'),
(91, 5, 29, NULL, NULL, NULL, '2613510721', '2015-02-06', '3554', 'ADZ', 'VASQUEZ/ERICK                 ', '85.00', 20.00, 0.00, 475, 'C', '3'),
(92, 5, 29, NULL, NULL, NULL, '2613510722', '2015-02-06', '3554', 'ADZ', 'PALACIOS/CELSA                ', '85.00', 20.00, 0.00, 475, 'C', '1'),
(93, 5, 29, NULL, NULL, NULL, '2613510723', '2015-02-06', '3554', 'ADZ', 'MARROQUIN/ANDREA              ', '85.00', 20.00, 0.00, 476, 'C', '3'),
(94, 5, 29, NULL, NULL, NULL, '2613510724', '2015-02-06', '3554', 'ADZ', 'MARROQUIN/PATRICIA            ', '85.00', 20.00, 0.00, 476, 'C', '3'),
(95, 5, 29, NULL, NULL, NULL, '2613510725', '2015-02-06', '3554', 'ADZ', 'MONTECINO/CORINA              ', '85.00', 15.00, 0.00, 477, 'C', '3'),
(96, 5, 54, NULL, NULL, NULL, '4762003738', '2015-01-22', '39907', 'ALH', 'PORTILLO/CARLOS               ', '543.00', 200.00, 0.00, 28130, 'F', '1'),
(97, 5, 54, NULL, NULL, NULL, '4762003740', '2015-01-22', '39907', 'ALH', 'DUARTE/SUSANA                 ', '543.00', 200.00, 0.00, 28130, 'F', '1'),
(98, 5, 29, NULL, NULL, NULL, '4762006484', '2015-02-03', '3554', 'ADZ', 'VASQUEZ/ERICK                 ', '749.00', 71.68, 0.00, 469, 'C', '1'),
(99, 5, 29, NULL, NULL, NULL, '4762006485', '2015-02-03', '3554', 'ADZ', 'PALACIOS/CELSA                ', '749.00', 71.68, 0.00, 469, 'C', '1'),
(100, 6, 29, NULL, NULL, NULL, '4762006486', '2015-02-03', '3554', 'ADZ', 'MARROQUIN/ANDREA              ', '749.00', 71.68, 0.00, 469, 'C', '1'),
(101, 6, 29, NULL, NULL, NULL, '4762006487', '2015-02-03', '3554', 'ADZ', 'MARROQUIN/PATRICIA            ', '749.00', 71.68, 0.00, 469, 'C', '1'),
(102, 6, 29, NULL, NULL, NULL, '4762006488', '2015-02-03', '3554', 'ADZ', 'MONTECINO/CORINA              ', '749.00', 71.68, 0.00, 469, 'C', '1'),
(103, 6, 29, NULL, NULL, NULL, '4762007666', '2015-02-06', '3554', 'ADZ', 'VASQUEZ/ERICK                 ', '398.00', 20.00, 0.00, 475, 'C', '1'),
(104, 6, 29, NULL, NULL, NULL, '4762007675', '2015-02-06', '3554', 'ADZ', 'PALACIOS/CELSA                ', '207.00', 20.00, 0.00, 475, 'C', '1'),
(105, 6, 29, NULL, NULL, NULL, '4762007676', '2015-02-06', '3554', 'ADZ', 'MARROQUIN/ANDREA              ', '207.00', 20.00, 0.00, 476, 'C', '1'),
(106, 6, 29, NULL, NULL, NULL, '4762007677', '2015-02-06', '3554', 'ADZ', 'MARROQUIN/PATRICIA            ', '207.00', 0.00, 0.00, 476, 'C', '3'),
(107, 6, 29, NULL, NULL, NULL, '4762007678', '2015-02-06', '3554', 'ADZ', 'MONTECINO/CORINA              ', '207.00', 15.00, 0.00, 477, 'C', '3'),
(108, 6, 83, NULL, NULL, NULL, '9214794272', '2015-03-10', '40282', 'APR', 'LOPEZ/DE VENTURA OLINDA       ', '1165.00', 66.37, 0.00, 28542, 'F', '1'),
(109, 6, 24, NULL, NULL, NULL, '9214799391', '2015-04-09', '40497', 'AAT', 'HOFFMANN/ECKART               ', '3860.00', 200.00, 0.00, 154968, 'F', '1'),
(110, 6, 24, NULL, NULL, NULL, '9214799393', '2015-04-09', '40497', 'AAT', 'BORJA/AUGUSTO                 ', '3860.00', 200.00, 0.00, 154969, 'F', '1'),
(111, 6, 83, NULL, NULL, NULL, '9214800096', '2015-04-13', '40282', 'APR', 'VENTURA/DORYS GUADALUPE       ', '927.00', 66.37, 0.00, 28950, 'F', '1'),
(112, 6, 85, NULL, NULL, NULL, '9214800648', '2015-04-15', '40560', 'AQP', 'BLANDON/HERBERTH              ', '955.00', 25.00, 25.00, 155275, 'F', '1'),
(113, 6, 73, NULL, NULL, NULL, '9214805136', '2015-05-06', '40740', 'AMS', 'BUCARO/LEONEL                 ', '468.07', 0.00, 0.00, 139345, 'C', '1'),
(114, 6, 61, NULL, NULL, NULL, '9214805284', '2015-05-12', '39544', 'AMC', 'CHAVARRIA/JUAN CARLOS         ', '412.00', 0.00, 0.00, 156414, 'F', '1'),
(115, 6, 61, NULL, NULL, NULL, '9214805286', '2015-05-12', '39544', 'AMC', 'VARGAS/REBECA                 ', '412.00', 0.00, 0.00, 156415, 'F', '1'),
(116, 6, 61, NULL, NULL, NULL, '9214805288', '2015-05-12', '39544', 'AMC', 'CHAVARRIA/DIEGO CHD           ', '372.00', 0.00, 0.00, 156416, 'F', '1'),
(117, 6, 61, NULL, NULL, NULL, '9214805290', '2015-05-12', '39544', 'AMC', 'CHAVARRIA/JIMENA CHD          ', '372.00', 0.00, 0.00, 156417, 'F', '1'),
(118, 6, 80, NULL, NULL, NULL, '9214806100', '2015-05-08', '40769', 'AOP', 'RODRIGUEZ/GABRIEL             ', '440.00', 35.00, 0.00, 29180, 'F', '1'),
(119, 6, 29, NULL, NULL, NULL, '9214809417', '2015-05-23', '3554', 'ADZ', 'NUNEZ/RINA                    ', '296.00', 26.55, 0.00, 29289, 'F', '1'),
(120, 7, 29, NULL, NULL, NULL, '9214809418', '2015-05-23', '3554', 'ADZ', 'ESCOBAR/JOSE MIGUEL           ', '58.70', 26.55, 0.00, 29289, 'F', '1'),
(121, 7, 29, NULL, NULL, NULL, '9214811274', '2015-05-30', '40929', 'ADZ', 'MARTINEZ/JORGE                ', '180.00', 24.12, 0.00, 157223, 'F', '1'),
(122, 7, 29, NULL, NULL, NULL, '9214811275', '2015-05-30', '40929', 'ADZ', 'HERNANDEZ/MARIELA             ', '180.00', 24.12, 0.00, 157223, 'F', '1'),
(123, 7, 3, NULL, NULL, NULL, '4762001954', '2015-01-12', '10138', 'LAX', 'SANDOVAL D GRIJALLVA/SANDRA   ', '414.00', 0.00, 0.00, 151962, 'F', '1'),
(124, 7, 93, NULL, NULL, NULL, '4762001954', '2015-01-12', '10138', 'ASA', 'SANDOVAL D GRIJALLVA/SANDRA   ', '414.00', 0.00, 0.00, 151962, 'F', '1'),
(125, 7, 96, NULL, NULL, NULL, '4762001966', '2015-01-12', '39827', 'ASJ', 'MIKLY/MARIA HELENA            ', '589.00', 20.00, 0.00, 10969, 'C', '1'),
(126, 7, 96, NULL, NULL, NULL, '4762001968', '2015-01-12', '39827', 'ASJ', 'LOPEZ/MAURICIO                ', '589.00', 20.00, 0.00, 10969, 'C', '1'),
(127, 7, 96, NULL, NULL, NULL, '4762002494', '2015-01-14', '39827', 'ASJ', 'GARCIA/DE ORELLANA ALMA JEANE ', '594.00', 20.00, 0.00, 10981, 'C', '1'),
(128, 7, 96, NULL, NULL, NULL, '4762003210', '2015-01-19', '39827', 'ASJ', 'GRANADOS/JENNIFER             ', '649.00', 20.00, 25.00, 11017, 'C', '1'),
(129, 7, 64, NULL, NULL, NULL, '4762008560', '2015-02-13', '40076', 'AMI', 'MAHMOOD/NOELL ISAAC           ', '590.00', 0.00, 0.00, 153294, 'F', '1'),
(130, 7, 64, NULL, NULL, NULL, '4762008562', '2015-02-13', '40076', 'AMI', 'PERACAULA/NOGUER DANIEL       ', '590.00', 0.00, 0.00, 153294, 'F', '1'),
(131, 7, 44, NULL, NULL, NULL, '4762009060', '2015-02-17', '40099', 'AJF', 'VASQUEZ/GILMA PATRICIA        ', '600.00', 20.00, 24.00, 8452, 'E', '1'),
(132, 7, 100, NULL, NULL, NULL, '4762009960', '2015-02-21', '35874', 'AST', 'HERRERA/ULMA EVELYN           ', '885.00', 50.00, 0.00, 11184, 'C', '1'),
(133, 7, 27, NULL, NULL, NULL, '8953281971', '2015-03-02', '33312', 'ADL', 'MENDOZA/LETICIA               ', '422.00', 0.00, 0.00, 137213, 'C', '1'),
(134, 7, 49, NULL, NULL, NULL, '9226773736', '2015-05-04', '40717', 'AKB', 'RAMOS/JUAN CARLOS             ', '1804.00', 0.00, 0.00, 139343, 'C', '1'),
(135, 7, 25, NULL, NULL, NULL, '4762011577', '2015-03-11', '40291', 'ADF', 'SANCHEZ/CECILIA               ', '742.00', 0.00, 0.00, 154229, 'F', '1'),
(136, 7, 44, NULL, NULL, NULL, '9214813152', '2015-06-10', '41015', 'AJF', 'GATTULLI/LISA                 ', '256.00', 0.00, 0.00, 0, 'F', '1'),
(137, 7, 29, NULL, NULL, NULL, '9214811360', '2015-05-31', '40929', 'ADZ', 'AYALA/JOSE RUBEN              ', '180.00', 0.00, 0.00, 140939, 'C', '1'),
(138, 7, 29, NULL, NULL, NULL, '9214811361', '2015-05-31', '40929', 'ADZ', 'REYES DE AYALA/LIDIA          ', '180.00', 0.00, 0.00, 140939, 'C', '1'),
(139, 7, 25, NULL, NULL, NULL, '8953293445', '2015-04-08', '40491', 'ADF', 'GOMEZ DUARTE/OSCAR OLIVERIO   ', '1252.00', 0.00, 0.00, 138278, 'C', '1'),
(140, 8, 73, NULL, NULL, NULL, '9214803498', '2015-04-29', '40683', 'AMS', 'SHRIVASTAVA/NIDHI             ', '147.00', 20.00, 0.00, 156017, 'F', '1'),
(141, 8, 29, NULL, NULL, NULL, '9214807121', '2015-05-13', '3554', 'ADZ', 'SANTOS/DE MINERO JUDITH       ', '1002.00', 25.00, 0.00, 11629, 'C', '1'),
(142, 8, 29, NULL, NULL, NULL, '9214807122', '2015-05-13', '3554', 'ADZ', 'MINERO/SOSA JULIO             ', '1002.00', 25.00, 0.00, 11629, 'C', '1'),
(143, 8, 81, NULL, NULL, NULL, '47620081051', '2015-02-11', '40061', 'APA', 'PACHECO/JOSE GODOFREDO        ', '273.20', 0.00, 0.00, 153863, 'F', '1'),
(144, 8, 83, NULL, NULL, NULL, '92148061401', '2015-05-09', '40768', 'APR', 'MORATAYA/CLAUDIA              ', '148.44', 0.00, 50.00, 29135, 'F', '1'),
(145, 8, 94, NULL, NULL, NULL, '4762009485', '2015-02-20', '40121', 'ASF', 'AGUINADA/SERGIO               ', '600.00', 0.00, 0.00, 153679, 'F', '1'),
(146, 8, 94, NULL, NULL, NULL, '4762010500', '2015-02-24', '40121', 'ASF', 'JOSA/RENE                     ', '585.00', 26.74, 0.00, 28401, 'F', '1'),
(147, 8, 94, NULL, NULL, NULL, '4762010502', '2015-02-24', '40121', 'ASF', 'AYALA/DELMIRA                 ', '585.00', 26.74, 0.00, 28401, 'F', '1'),
(148, 8, 44, NULL, NULL, NULL, '9214800608', '2015-04-15', '40556', 'AJF', 'VILLAFUERTE/ARNOLD T          ', '2527.00', 377.77, 619.47, 11443, 'C', '1'),
(149, 8, 44, NULL, NULL, NULL, '9214800611', '2015-04-15', '40556', 'AJF', 'VILLAFUERTE/MARIA C           ', '2527.00', 377.77, 619.47, 11443, 'C', '1'),
(150, 8, 21, NULL, NULL, NULL, '9214800882', '2015-04-17', '565', 'ACA', 'SANCHEZ CLAUSEN DE OLMEDO/MARI', '257.00', 76.85, 0.00, 28908, 'F', '1'),
(151, 8, 73, NULL, NULL, NULL, '9214804933', '2015-05-05', '4690', 'AMS', 'DA/SILVA VALIM MARLENE        ', '770.00', 48.54, 0.00, 29084, 'F', '1'),
(152, 8, 73, NULL, NULL, NULL, '9214804935', '2015-05-05', '4690', 'AMS', 'VALIM/JOSE FERNANDO           ', '830.00', 445.20, 0.00, 29083, 'F', '1'),
(153, 8, 93, NULL, NULL, NULL, '9214812271', '2015-06-04', '40960', 'ASA', 'AYALA/ANA                     ', '687.89', 25.00, 0.00, 157476, 'F', '1'),
(154, 8, 93, NULL, NULL, NULL, '9214812273', '2015-06-04', '40960', 'ASA', 'MENDOZA/BRENDA                ', '636.00', 25.00, 0.00, 157608, 'F', '1'),
(155, 8, 93, NULL, NULL, NULL, '9214812275', '2015-06-04', '40960', 'ASA', 'MEDINA/FANNY                  ', '636.00', 25.00, 0.00, 157607, 'F', '1'),
(156, 8, 79, NULL, NULL, NULL, '9214810850', '2015-06-01', '40943', 'ANF', 'ALFARO/JENNIFER               ', '884.00', 0.00, 0.00, 157435, 'F', '1'),
(157, 8, 73, NULL, NULL, NULL, '9214811338', '2015-05-31', '39437', 'AMS', 'CACERES/ELFRIDA               ', '195.72', 5.56, 0.00, 29389, 'F', '1'),
(158, 8, 73, NULL, NULL, NULL, '9214811339', '2015-05-31', '39437', 'AMS', 'PORTILLO/CACERES ELFRIDA      ', '184.17', 15.78, 0.00, 29389, 'F', '1'),
(159, 8, 29, NULL, NULL, NULL, '9214811362', '2015-05-31', '40931', 'ADZ', 'AYALA/DE SANCHEZ CECILIA      ', '180.00', 0.00, 0.00, 140329, 'C', '1'),
(160, 9, 29, NULL, NULL, NULL, '9214811363', '2015-05-31', '40931', 'ADZ', 'SANCHEZ/ANGEL                 ', '180.00', 0.00, 0.00, 140329, 'C', '1'),
(161, 9, 29, NULL, NULL, NULL, '9214811364', '2015-05-31', '40931', 'ADZ', 'AYALA/JOSE RUBEN              ', '180.00', 0.00, 0.00, 140329, 'C', '1'),
(162, 9, 29, NULL, NULL, NULL, '9214811365', '2015-05-31', '40931', 'ADZ', 'REYES/DE AYALA LIDIA          ', '180.00', 0.00, 0.00, 140329, 'C', '1'),
(163, 9, 73, NULL, NULL, NULL, '9226772550', '2015-04-29', '40682', 'AMS', 'BROOIJMANS/CORNELIS           ', '173.00', 0.00, 0.00, 8600, 'E', '1'),
(164, 9, 96, NULL, NULL, NULL, '9226776958', '2015-05-12', '40788', 'ASJ', 'ZAPATA/JORGE MR               ', '297.00', 0.00, 0.00, 156425, 'F', '1'),
(165, 9, 25, NULL, NULL, NULL, '9226779252', '2015-05-18', '35679', 'ABC', 'CLIMACO/GERSON                ', '740.00', 0.00, 0.00, 140183, 'C', '1'),
(166, 9, 29, NULL, NULL, NULL, '9214813633', '2015-06-08', '40997', 'ADZ', 'RIVAS/JOSUE                   ', '180.00', 0.00, 0.00, 0, NULL, '1'),
(167, 9, 29, NULL, NULL, NULL, '9214813634', '2015-06-08', '40997', 'ADZ', 'SERVELLON/MARIA DEL CARMEN    ', '180.00', 0.00, 0.00, 0, NULL, '1'),
(168, 9, 83, NULL, NULL, NULL, '9214805591', '2015-05-08', '40768', 'APR', 'SEGOVIA/EDGAR                 ', '540.00', 18.25, 0.00, 139468, 'C', '1'),
(169, 9, 29, NULL, NULL, NULL, '9214811281', '2015-05-30', '40931', 'ADZ', 'CUBIAS/CARMEN                 ', '180.00', 0.00, 0.00, 140443, 'C', '1'),
(170, 9, 29, NULL, NULL, NULL, '9214811282', '2015-05-30', '40931', 'ADZ', 'VASQUEZ/ROSA                  ', '180.00', 0.00, 0.00, 140442, 'C', '1'),
(171, 9, 29, NULL, NULL, NULL, '9214811283', '2015-05-30', '40931', 'ADZ', 'GUZMAN/ELSY                   ', '180.00', 0.00, 0.00, 140441, 'C', '1'),
(172, 9, 29, NULL, NULL, NULL, '9214811372', '2015-06-01', '40931', 'ADZ', 'MORAN/MAYRA                   ', '180.00', 0.00, 0.00, 140486, 'C', '1'),
(173, 9, 29, NULL, NULL, NULL, '9214811373', '2015-06-01', '40931', 'ADZ', 'MANZUR/GABRIELA               ', '180.00', 0.00, 0.00, 140486, 'C', '1'),
(174, 9, 29, NULL, NULL, NULL, '9214811374', '2015-06-01', '40931', 'ADZ', 'RODRIGUEZ/BRENDA              ', '180.00', 0.00, 0.00, 140486, 'C', '1'),
(175, 9, 73, NULL, NULL, NULL, '4762001664', '2015-01-09', '4690', 'AMS', 'GARAY/RYNA ELIZABETH          ', '13.78', 296.27, 0.00, 152079, 'F', '1'),
(176, 9, 73, NULL, NULL, NULL, '4762004357', '2015-01-27', '4690', 'AMS', 'BROUWER/CATHARINA MARIA       ', '740.00', 0.00, 0.00, 8428, 'E', '1'),
(177, 9, 81, NULL, NULL, NULL, '4762008105', '2015-02-11', '40061', 'APA', 'PACHECO/JOSE GODOFREDO        ', '798.80', 50.00, 0.00, 153862, 'F', '1'),
(178, 9, 83, NULL, NULL, NULL, '9214806140', '2015-05-09', '40768', 'APR', 'MORATAYA/CLAUDIA              ', '346.51', 0.00, 0.00, 29133, 'F', '1'),
(179, 9, 24, NULL, NULL, NULL, '9214797603', '2015-03-31', '36586', 'ACU', 'HURTADO ARROYO/JORGE          ', '654.00', 0.00, 0.00, 154891, 'F', '1'),
(180, 10, 21, NULL, NULL, NULL, '9214801201', '2015-04-17', '565', 'ACA', 'OLMEDO/BARATTA RICARDO        ', '257.00', 25.00, 51.85, 138581, 'C', '1'),
(181, 10, 21, NULL, NULL, NULL, '9214801202', '2015-04-17', '565', 'ACA', 'OLMEDO/SANCHEZ RICARDO        ', '257.00', 25.00, 51.85, 138580, 'C', '1'),
(182, 10, 73, NULL, NULL, NULL, '9214805236', '2015-05-07', '8199', 'AMS', 'PARRALES/CORDOBA OSCAR        ', '600.00', 0.00, 0.00, 156211, 'F', '1'),
(183, 10, 24, NULL, NULL, NULL, '4762004988', '2015-03-13', '36586', 'ACU', 'LEON/ORTIZ SHARON             ', '800.00', 0.00, 0.00, 154304, 'F', '1'),
(184, 10, 39, NULL, NULL, NULL, '4762006139', '2015-03-12', '40307', 'AHA', 'ALARCON/ALEJANDRO             ', '3907.00', 0.00, 0.00, 138099, 'C', '1'),
(185, 10, 76, NULL, NULL, NULL, '4762006184', '2015-06-05', '40980', 'AMU', 'GALVEZ/HERBERT                ', '5052.00', 0.00, 0.00, 140900, 'C', '1'),
(186, 10, 61, NULL, NULL, NULL, '4762007794', '2015-02-09', '39016', 'AMC', 'CUELLAR/DINA                  ', '750.00', 0.00, 0.00, 136606, 'C', '1'),
(187, 10, 94, NULL, NULL, NULL, '4762009434', '2015-02-19', '40121', 'ASF', 'GUZMAN/VIDAL SILVIA LIZZET    ', '600.00', 0.00, 0.00, 153532, 'F', '1'),
(188, 10, 61, NULL, NULL, NULL, '9226769886', '2015-04-22', '40631', 'AMC', 'LANDAVERDE/HECTOR             ', '344.00', 0.00, 0.00, 156444, 'F', '1'),
(189, 10, 61, NULL, NULL, NULL, '9226769888', '2015-04-22', '40631', 'AMC', 'LANDAVERDE/MONICA             ', '344.00', 0.00, 0.00, 156444, 'F', '1'),
(190, 10, 61, NULL, NULL, NULL, '9226769890', '2015-04-22', '40631', 'AMC', 'LANDAVERDE/ANDREA             ', '344.00', 0.00, 0.00, 156444, 'F', '1'),
(191, 10, 61, NULL, NULL, NULL, '9226769892', '2015-04-22', '40631', 'AMC', 'LANDAVERDE/ALEXIA             ', '344.00', 0.00, 0.00, 156444, 'F', '1'),
(192, 10, 38, NULL, NULL, NULL, '4762009032', '2015-02-16', '2964', 'AGU', 'RODRIGUEZ/NASSIN              ', '230.00', 35.40, 0.00, 153394, 'F', '1'),
(193, 10, 38, NULL, NULL, NULL, '4762009033', '2015-02-16', '2964', 'AGU', 'RODRIGUEZ/JUAN CARLOS         ', '230.00', 35.40, 0.00, 153395, 'F', '1'),
(194, 10, 73, NULL, NULL, NULL, '8953277906', '2015-02-17', '4690', 'AMS', 'URQUILLA ZAMORA/JOSUE FRANCISC', '1309.00', 0.00, 0.00, 153447, 'F', '1'),
(195, 10, 21, NULL, NULL, NULL, '8953283428', '2015-03-04', '565', 'ACA', 'BONILLA/EDGAR                 ', '672.00', 0.00, 0.00, 153932, 'F', '1'),
(196, 10, 21, NULL, NULL, NULL, '8953283430', '2015-03-04', '565', 'ACA', 'BONILLA/MARITZA               ', '697.00', 0.00, 0.00, 153933, 'F', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerary_invoiced_tickets`
--

CREATE TABLE IF NOT EXISTS `itinerary_invoiced_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ciudad1` char(3) DEFAULT NULL,
  `nombre_ciudad1` varchar(17) DEFAULT NULL,
  `codigo_ciudad2` char(3) DEFAULT NULL,
  `nombre_ciudad2` varchar(17) DEFAULT NULL,
  `pais1` varchar(30) DEFAULT NULL,
  `pais2` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Volcado de datos para la tabla `itinerary_invoiced_tickets`
--

INSERT INTO `itinerary_invoiced_tickets` (`id`, `codigo_ciudad1`, `nombre_ciudad1`, `codigo_ciudad2`, `nombre_ciudad2`, `pais1`, `pais2`) VALUES
(1, 'CON', NULL, ' CA', NULL, NULL, NULL),
(2, 'SJU', NULL, ' CL', NULL, NULL, NULL),
(3, 'PEN', NULL, ' PO', NULL, NULL, NULL),
(4, 'PEN', NULL, ' PO', NULL, NULL, NULL),
(5, 'PEN', NULL, ' PO', NULL, NULL, NULL),
(6, 'ADM', NULL, ', T', NULL, NULL, NULL),
(7, 'SAL', NULL, '-LA', NULL, NULL, NULL),
(8, 'MAD', NULL, '-LI', NULL, NULL, NULL),
(9, 'FRA', NULL, '-MA', NULL, NULL, NULL),
(10, 'SAL', NULL, '-SJ', NULL, NULL, NULL),
(11, 'SAL', NULL, '/IA', NULL, NULL, NULL),
(12, 'SAL', NULL, '8IA', NULL, NULL, NULL),
(13, 'SAL', NULL, 'AAR', NULL, NULL, NULL),
(14, 'SAL', NULL, 'AAT', NULL, NULL, NULL),
(15, 'SAL', NULL, 'AAT', NULL, NULL, NULL),
(16, 'SAL', NULL, 'AAT', NULL, NULL, NULL),
(17, 'SAL', NULL, 'AAT', NULL, NULL, NULL),
(18, 'SAL', NULL, 'AAT', NULL, NULL, NULL),
(19, 'SAL', NULL, 'ABC', NULL, NULL, NULL),
(20, 'SAL', NULL, 'ABR', NULL, NULL, NULL),
(21, 'SAL', NULL, 'ACA', NULL, NULL, NULL),
(22, 'SAL', NULL, 'ACD', NULL, NULL, NULL),
(23, 'SJO', NULL, 'ACT', NULL, NULL, NULL),
(24, 'SJU', NULL, 'ACU', NULL, NULL, NULL),
(25, 'SJO', NULL, 'ADF', NULL, NULL, NULL),
(26, 'SAL', NULL, 'ADF', NULL, NULL, NULL),
(27, 'LAX', NULL, 'ADL', NULL, NULL, NULL),
(28, 'SAL', NULL, 'ADM', NULL, NULL, NULL),
(29, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(30, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(31, 'SJO', NULL, 'ADZ', NULL, NULL, NULL),
(32, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(33, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(34, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(35, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(36, 'SAL', NULL, 'ADZ', NULL, NULL, NULL),
(37, 'SAL', NULL, 'AFC', NULL, NULL, NULL),
(38, 'SAL', NULL, 'AGU', NULL, NULL, NULL),
(39, 'SAL', NULL, 'AHA', NULL, NULL, NULL),
(40, 'SAL', NULL, 'AHA', NULL, NULL, NULL),
(41, 'SAL', NULL, 'AHA', NULL, NULL, NULL),
(42, 'SAL', NULL, 'AIA', NULL, NULL, NULL),
(43, 'SAL', NULL, 'AID', NULL, NULL, NULL),
(44, 'SAL', NULL, 'AJF', NULL, NULL, NULL),
(45, 'SJO', NULL, 'AJF', NULL, NULL, NULL),
(46, 'SAL', NULL, 'AJF', NULL, NULL, NULL),
(47, 'SAL', NULL, 'AJF', NULL, NULL, NULL),
(48, 'SJO', NULL, 'AJF', NULL, NULL, NULL),
(49, 'SAL', NULL, 'AKB', NULL, NULL, NULL),
(50, 'SAL', NULL, 'AKB', NULL, NULL, NULL),
(51, 'SAL', NULL, 'AKR', NULL, NULL, NULL),
(52, 'SAL', NULL, 'ALC', NULL, NULL, NULL),
(53, 'SAL', NULL, 'ALH', NULL, NULL, NULL),
(54, 'SAL', NULL, 'ALH', NULL, NULL, NULL),
(55, 'SAL', NULL, 'ALI', NULL, NULL, NULL),
(56, 'SAL', NULL, 'ALI', NULL, NULL, NULL),
(57, 'SAL', NULL, 'ALI', NULL, NULL, NULL),
(58, 'SAL', NULL, 'AMC', NULL, NULL, NULL),
(59, 'SJO', NULL, 'AMC', NULL, NULL, NULL),
(60, 'SAL', NULL, 'AMC', NULL, NULL, NULL),
(61, 'SJO', NULL, 'AMC', NULL, NULL, NULL),
(62, 'SAL', NULL, 'AMD', NULL, NULL, NULL),
(63, 'BCN', NULL, 'AMI', NULL, NULL, NULL),
(64, 'LIM', NULL, 'AMI', NULL, NULL, NULL),
(65, 'SAL', NULL, 'AMS', NULL, NULL, NULL),
(66, 'SJO', NULL, 'AMS', NULL, NULL, NULL),
(67, 'SJO', NULL, 'AMS', NULL, NULL, NULL),
(68, 'SAL', NULL, 'AMS', NULL, NULL, NULL),
(69, 'MAD', NULL, 'AMS', NULL, NULL, NULL),
(70, 'ALC', NULL, 'AMS', NULL, NULL, NULL),
(71, 'SAL', NULL, 'AMS', NULL, NULL, NULL),
(72, 'GOT', NULL, 'AMS', NULL, NULL, NULL),
(73, 'SVO', NULL, 'AMS', NULL, NULL, NULL),
(74, 'SAL', NULL, 'AMU', NULL, NULL, NULL),
(75, 'SAL', NULL, 'AMU', NULL, NULL, NULL),
(76, 'SAL', NULL, 'AMU', NULL, NULL, NULL),
(77, 'SAL', NULL, 'AMX', NULL, NULL, NULL),
(78, 'SAL', NULL, 'ANA', NULL, NULL, NULL),
(79, 'SJO', NULL, 'ANF', NULL, NULL, NULL),
(80, 'SAL', NULL, 'AOP', NULL, NULL, NULL),
(81, 'SAL', NULL, 'APA', NULL, NULL, NULL),
(82, 'SAL', NULL, 'APR', NULL, NULL, NULL),
(83, 'SAL', NULL, 'APR', NULL, NULL, NULL),
(84, 'SJU', NULL, 'APT', NULL, NULL, NULL),
(85, 'SAL', NULL, 'AQP', NULL, NULL, NULL),
(86, 'MAD', NULL, 'ASA', NULL, NULL, NULL),
(87, 'SJO', NULL, 'ASA', NULL, NULL, NULL),
(88, 'DUS', NULL, 'ASA', NULL, NULL, NULL),
(89, 'YOW', NULL, 'ASA', NULL, NULL, NULL),
(90, 'BCN', NULL, 'ASA', NULL, NULL, NULL),
(91, 'SJO', NULL, 'ASA', NULL, NULL, NULL),
(92, 'SAL', NULL, 'ASA', NULL, NULL, NULL),
(93, 'VCE', NULL, 'ASA', NULL, NULL, NULL),
(94, 'SAL', NULL, 'ASF', NULL, NULL, NULL),
(95, 'SJO', NULL, 'ASJ', NULL, NULL, NULL),
(96, 'MDE', NULL, 'ASJ', NULL, NULL, NULL),
(97, 'SAL', NULL, 'AST', NULL, NULL, NULL),
(98, 'SAL', NULL, 'AST', NULL, NULL, NULL),
(99, 'SAL', NULL, 'AST', NULL, NULL, NULL),
(100, 'SAL', NULL, 'AST', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacionesexs`
--

CREATE TABLE IF NOT EXISTS `operacionesexs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `formcall` varchar(50) NOT NULL,
  `subcall` varchar(50) NOT NULL,
  `extostring` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_9` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacionesrgs`
--

CREATE TABLE IF NOT EXISTS `operacionesrgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(100) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_11` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services_sales_provider_id` int(11) DEFAULT NULL,
  `proveedor_servicio` varchar(100) DEFAULT NULL,
  `cantidad_servicios_proveedor` int(11) DEFAULT NULL,
  `total_servicios_proveedor` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_27` (`services_sales_provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tickets_sales_route_id` int(11) DEFAULT NULL,
  `ruta` varchar(80) DEFAULT NULL,
  `boletos_ruta` int(11) DEFAULT NULL,
  `total_ruta` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_23` (`tickets_sales_route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_sales_providers`
--

CREATE TABLE IF NOT EXISTS `services_sales_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio_proveedor` date NOT NULL,
  `fecha_fin_proveedor` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_sales_types`
--

CREATE TABLE IF NOT EXISTS `services_sales_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio_tipo` date NOT NULL,
  `fecha_fin_tipo` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_sales_destinies`
--

CREATE TABLE IF NOT EXISTS `tickets_sales_destinies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linea_aerea_destino` char(30) NOT NULL,
  `fecha_inicio_destino` date NOT NULL,
  `fecha_final_destino` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_sales_routes`
--

CREATE TABLE IF NOT EXISTS `tickets_sales_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linea_aerea_ruta` varchar(20) NOT NULL,
  `fecha_inicio_ruta` date NOT NULL,
  `fecha_final_ruta` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services_sales_type_id` int(11) DEFAULT NULL,
  `tipo_servicio` varchar(100) DEFAULT NULL,
  `cantidad_servicios_tipo` int(11) DEFAULT NULL,
  `total_servicios_tipo` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reference_28` (`services_sales_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`) VALUES
(3, 'mm10020', '$2a$10$oxSu0Zb5aUZ.ZMagcQF7kuUaIa/xPzR5/TTdPKVvx0NElf0G2dtMm', 'admin', '2015-06-02 04:35:01', '2015-06-03 06:52:07', 'Marlon Armando', 'Menjivar Martinez'),
(6, '5rtgt5rg', '$2a$10$WPuD2VW5905ziatHDAKLXed9s0fc/KkXM.y.CtFczp6sWp0zG6ICW', 'strategic', '2015-06-03 04:49:21', '2015-06-03 06:52:37', 'Alison Lucía', 'Menjívar Martínez');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destinies`
--
ALTER TABLE `destinies`
  ADD CONSTRAINT `fk_reference_24` FOREIGN KEY (`tickets_sales_destiny_id`) REFERENCES `tickets_sales_destinies` (`id`);

--
-- Filtros para la tabla `etl_users`
--
ALTER TABLE `etl_users`
  ADD CONSTRAINT `fk_reference_25` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `fulfillment_branch_office_goals`
--
ALTER TABLE `fulfillment_branch_office_goals`
  ADD CONSTRAINT `fk_reference_19` FOREIGN KEY (`goal_branch_office_id`) REFERENCES `goal_branch_offices` (`id`);

--
-- Filtros para la tabla `goal_airlines`
--
ALTER TABLE `goal_airlines`
  ADD CONSTRAINT `fk_reference_26` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`);

--
-- Filtros para la tabla `goal_branch_offices`
--
ALTER TABLE `goal_branch_offices`
  ADD CONSTRAINT `fk_reference_22` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_offices` (`id`);

--
-- Filtros para la tabla `invoiced_services`
--
ALTER TABLE `invoiced_services`
  ADD CONSTRAINT `fk_reference_21` FOREIGN KEY (`fulfillment_branch_office_goal_id`) REFERENCES `fulfillment_branch_office_goals` (`id`),
  ADD CONSTRAINT `fk_reference_17` FOREIGN KEY (`services_sales_provider_id`) REFERENCES `services_sales_providers` (`id`),
  ADD CONSTRAINT `fk_reference_18` FOREIGN KEY (`services_sales_type_id`) REFERENCES `services_sales_types` (`id`);

--
-- Filtros para la tabla `invoiced_tickets`
--
ALTER TABLE `invoiced_tickets`
  ADD CONSTRAINT `fk_reference_8` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`),
  ADD CONSTRAINT `fk_reference_14` FOREIGN KEY (`itinerary_invoiced_ticket_id`) REFERENCES `itinerary_invoiced_tickets` (`id`),
  ADD CONSTRAINT `fk_reference_15` FOREIGN KEY (`tickets_sales_destiny_id`) REFERENCES `tickets_sales_destinies` (`id`),
  ADD CONSTRAINT `fk_reference_16` FOREIGN KEY (`tickets_sales_route_id`) REFERENCES `tickets_sales_routes` (`id`),
  ADD CONSTRAINT `fk_reference_20` FOREIGN KEY (`fulfillment_branch_office_goal_id`) REFERENCES `fulfillment_branch_office_goals` (`id`);

--
-- Filtros para la tabla `operacionesexs`
--
ALTER TABLE `operacionesexs`
  ADD CONSTRAINT `fk_reference_9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `operacionesrgs`
--
ALTER TABLE `operacionesrgs`
  ADD CONSTRAINT `fk_reference_11` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `fk_reference_27` FOREIGN KEY (`services_sales_provider_id`) REFERENCES `services_sales_providers` (`id`);

--
-- Filtros para la tabla `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `fk_reference_23` FOREIGN KEY (`tickets_sales_route_id`) REFERENCES `tickets_sales_routes` (`id`);

--
-- Filtros para la tabla `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `fk_reference_28` FOREIGN KEY (`services_sales_type_id`) REFERENCES `services_sales_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
