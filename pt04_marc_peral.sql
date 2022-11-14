-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2022 a las 18:34:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+01:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de datos: `pt04_marc_peral`
--
CREATE DATABASE IF NOT EXISTS `pt04_marc_peral` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_marc_peral`;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `article`
--
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `article` varchar(1000) NOT NULL,
  `autor` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `article`
--
INSERT INTO `article` (`id`, `article`, `autor`, `data`)
VALUES (397, 'Autor 20 - Article 01', 20, '2022-10-01'),
  (398, 'Autor 19 - Article 02', 19, '2022-10-02'),
  (399, 'Autor 20 - Article 03', 20, '2022-10-03'),
  (400, 'Autor 19 - Article 04', 19, '2022-10-04'),
  (401, 'Autor 20 - Article 05', 20, '2022-10-05'),
  (402, 'Autor 19 - Article 06', 19, '2022-10-06'),
  (403, 'Autor 20 - Article 07', 20, '2022-10-07'),
  (404, 'Autor 19 - Article 08', 19, '2022-10-08'),
  (405, 'Autor 20 - Article 09', 20, '2022-10-09'),
  (406, 'Autor 19 - Article 10', 19, '2022-10-10'),
  (407, 'Autor 20 - Article 11', 20, '2022-10-11'),
  (408, 'Autor 19 - Article 12', 19, '2022-10-12'),
  (409, 'Autor 20 - Article 13', 20, '2022-10-13'),
  (410, 'Autor 19 - Article 14', 19, '2022-10-14'),
  (411, 'Autor 20 - Article 15', 20, '2022-10-15'),
  (412, 'Autor 19 - Article 16', 19, '2022-10-16'),
  (413, 'Autor 20 - Article 17', 20, '2022-10-17'),
  (414, 'Autor 19 - Article 18', 19, '2022-10-18'),
  (415, 'Autor 20 - Article 19', 20, '2022-10-19'),
  (416, 'Autor 19 - Article 20', 19, '2022-10-20'),
  (417, 'Autor 20 - Article 21', 20, '2022-10-21'),
  (418, 'Autor 19 - Article 22', 19, '2022-10-22'),
  (419, 'Autor 20 - Article 23', 20, '2022-10-23'),
  (420, 'Autor 19 - Article 24', 19, '2022-10-24'),
  (421, 'Autor 20 - Article 25', 20, '2022-10-25'),
  (422, 'Autor 19 - Article 26', 19, '2022-10-26'),
  (423, 'Autor 20 - Article 27', 20, '2022-10-27'),
  (424, 'Autor 19 - Article 28', 19, '2022-10-28'),
  (425, 'Autor 20 - Article 29', 20, '2022-10-29'),
  (426, 'Autor 19 - Article 30', 19, '2022-10-30'),
  (427, 'Autor 20 - Article 31', 20, '2022-10-31'),
  (428, 'Autor 19 - Article 32', 19, '2022-11-01'),
  (429, 'Autor 20 - Article 33', 20, '2022-11-02'),
  (430, 'Autor 19 - Article 34', 19, '2022-11-03'),
  (431, 'Autor 20 - Article 35', 20, '2022-11-04'),
  (432, 'Autor 19 - Article 36', 19, '2022-11-05'),
  (433, 'Autor 20 - Article 37', 20, '2022-11-06'),
  (434, 'Autor 19 - Article 38', 19, '2022-11-07'),
  (435, 'Autor 20 - Article 39', 20, '2022-11-08'),
  (436, 'Autor 19 - Article 40', 19, '2022-11-09'),
  (437, 'Autor 20 - Article 41', 20, '2022-11-10'),
  (438, 'Autor 19 - Article 42', 19, '2022-11-11'),
  (439, 'Autor 20 - Article 43', 20, '2022-11-12'),
  (440, 'Autor 19 - Article 44', 19, '2022-11-13'),
  (441, 'Autor 20 - Article 45', 20, '2022-11-14'),
  (442, 'Autor 19 - Article 46', 19, '2022-11-15'),
  (443, 'Autor 20 - Article 47', 20, '2022-11-16'),
  (444, 'Autor 19 - Article 48', 19, '2022-11-17'),
  (445, 'Autor 20 - Article 49', 20, '2022-11-18'),
  (446, 'Autor 19 - Article 50', 19, '2022-11-19'),
  (447, 'Autor 20 - Article 51', 20, '2022-11-20'),
  (448, 'Autor 19 - Article 52', 19, '2022-11-21'),
  (449, 'Autor 20 - Article 53', 20, '2022-11-22'),
  (450, 'Autor 19 - Article 54', 19, '2022-11-23'),
  (451, 'Autor 20 - Article 55', 20, '2022-11-24'),
  (452, 'Autor 19 - Article 56', 19, '2022-11-25'),
  (453, 'Autor 20 - Article 57', 20, '2022-11-26'),
  (454, 'Autor 19 - Article 58', 19, '2022-11-27'),
  (455, 'Autor 20 - Article 59', 20, '2022-11-28'),
  (456, 'Autor 19 - Article 60', 19, '2022-11-29'),
  (457, 'Autor 20 - Article 61', 20, '2022-11-30'),
  (458, 'Autor 19 - Article 62', 19, '2022-12-01'),
  (459, 'Autor 20 - Article 63', 20, '2022-12-02'),
  (460, 'Autor 19 - Article 64', 19, '2022-12-03'),
  (461, 'Autor 20 - Article 65', 20, '2022-12-04'),
  (462, 'Autor 19 - Article 66', 19, '2022-12-05'),
  (463, 'Autor 20 - Article 67', 20, '2022-12-06'),
  (464, 'Autor 19 - Article 68', 19, '2022-12-07'),
  (465, 'Autor 20 - Article 69', 20, '2022-12-08'),
  (466, 'Autor 19 - Article 70', 19, '2022-12-09'),
  (467, 'Autor 20 - Article 71', 20, '2022-12-10'),
  (468, 'Autor 19 - Article 72', 19, '2022-12-11'),
  (469, 'Autor 20 - Article 73', 20, '2022-12-12'),
  (470, 'Autor 19 - Article 74', 19, '2022-12-13'),
  (471, 'Autor 20 - Article 75', 20, '2022-12-14'),
  (472, 'Autor 19 - Article 76', 19, '2022-12-15'),
  (473, 'Autor 20 - Article 77', 20, '2022-12-16'),
  (474, 'Autor 19 - Article 78', 19, '2022-12-17'),
  (475, 'Autor 20 - Article 79', 20, '2022-12-18');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuari`
--
DROP TABLE IF EXISTS `usuari`;
CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `cognoms` varchar(20) DEFAULT NULL,
  `correu` varchar(50) NOT NULL,
  `contrasenya` char(64) DEFAULT NULL,
  `reset_token` char(64) DEFAULT NULL,
  `caducitat_token` timestamp NULL DEFAULT NULL,
  `ultima_solicitud_token` timestamp NULL DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `usuari`
--
INSERT INTO `usuari` (
    `id`,
    `nom`,
    `cognoms`,
    `correu`,
    `contrasenya`,
    `reset_token`,
    `caducitat_token`,
    `ultima_solicitud_token`
  )
VALUES (
    19,
    'Marc Jesús',
    'Peral Cajidos',
    'm.peral@sapalomera.cat',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    NULL,
    NULL,
    '2022-11-10 17:41:57'
  ),
  (
    20,
    'Marc',
    'Peral',
    'admin@mperalsapa.cf',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',
    NULL,
    NULL,
    '2022-11-03 18:01:38'
  );
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `article`
--
ALTER TABLE `article`
ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`);
--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 111;
--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 26;
--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `article`
--
ALTER TABLE `article`
ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;