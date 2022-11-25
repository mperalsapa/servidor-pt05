-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2022 a las 19:44:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt05_marc_peral`
--
CREATE DATABASE IF NOT EXISTS `pt05_marc_peral` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt05_marc_peral`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `article` varchar(10000) NOT NULL,
  `autor` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `imatge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `article`
--

TRUNCATE TABLE `article`;
--
-- Volcado de datos para la tabla `article`
--

INSERT INTO `article` (`id`, `titol`, `article`, `autor`, `data`, `imatge`) VALUES
(482, 'Wakanda Forever, reloaded, rebirth, reincarnated, más Grande, más larga y sin cortes', 'No contentos con adormecer a media población en la ampliamente olvidable Eternals y entregarse sin rumbo al fenómeno fan, Marvel decide patentizar aún más su prolongada fatiga durante 161 minutos dominados, de nuevo, por las imprecisiones generales de una fórmula explotada.<br>\r\nLa presencia de Namor o la gracia de personajes como Okoye y Shuri son detalles salvables que maquillan ligeramente una triste involución técnica y creativa. El desorden se torna evidente en su composición cinematográfica, desastrosa, indisciplinada e incluso difícil de mirar.<br>\r\nSu potencial condición de emotivo homenaje se anula tan pronto como su perspectiva del duelo obedece a lo rutinario y lo trivial. Otra gran noticia es que siguen con sus alarmantes problemas de ritmo y sus desesperadas introducciones de personajes vacuos y repelentes. Y seguirán.', 19, '2022-11-23', 27),
(483, 'Divertidíssima!!', 'Pues lo que dice el título de esta crítica es lo real y lo importante de esta película catalana.\r\n<br><br>\r\nTe ríes, sueltas carcajadas y además, estas en tensión todo el rato, porque es una película ambivalente, con dos caras. La comedia, magnífica y la película de terror, tensión, un thriller.\r\n<br><br>\r\nJuega en el terreno de Mel Brooks y su Jovencito Frankestein, mezclando dos tipos de cine, el de la comedia y el de terror, saliendo este cocktail tan fácil y agradable de paladear. También, en el terreno de Berlanga, sabe reirse de y con los catalanes, como Berlanga sabía reirse de y con los españoles. Esto en los momentos actuales no es muy fácil, ni común.\r\n<br><br>\r\nAunque el guion viene de una obra de teatro, esto no supone ningún lastre para esta película, que tiene también sus momentos de exteriores.', 19, '2022-11-24', 28),
(484, 'Dioses y monstruos en modo aún más épico y espectacular', 'Tras una larga espera, llega a nuestras consolas de Sony la continuación de la historia de Kratos y Atreus en tierras nórdicas, siguiendo por el camino que ya se veía venir con el epílogo del juego anterior.\r\n<br><br>\r\nEn una primera toma de contacto, la sensación que da el juego es de que no hay una gran diferencia técnica con el original. De hecho, ha terminado teniendo un lanzamiento intergeneracional de plataformas. Los gráficos son absolutamente espectaculares, pero ya lo eran en el juego de 2018 y no hay, en apariencia, un gran salto.\r\n<br><br>\r\nLo mismo parece pasar en mecánicas y jugabilidad. Pero esto no tiene nada de malo, de todas formas. Con todo, una vez que empezamos a adentrarnos en la aventura un poco más, es fácil darse cuenta de que sí que han incorporado nuevas habilidades, enemigos, personajes, tipos de misiones secundarias y posibilidades de exploración. Y es que, aunque parezca mentira, el mapa que nos ofrece “Ragnarök” es mucho más grande. Al que le apetezca hacerlo y buscarlo todo, que vaya reservando una buena cantidad de horas.\r\n<br><br>\r\nAdemás, el juego es bueno tanto en devolvernos a reinos conocidos como en el diseño de los nuevos. Y encuentro también un muy buen equilibrio entre la exploración, los puzzles y el combate, que además, como es de mundo abierto, cada jugador podrá decidir hasta dónde quiere llegar.\r\n<br><br>\r\nLa historia nos lleva a la famosa guerra de dioses que según la mitología vikinga tendría lugar en el fin del mundo, y para evitarlo Kratos tendrá que tomar partido en contra de Odín, tarea que no le va a ser nada fácil. Es un guion muy bien trabajado y atractivo, que enriquece mucho más todo el universo del que ya se sentaron las bases en el título anterior.\r\n<br><br>\r\nSi el primero era grandioso, este lo es aún más, aunque no innove demasiado (todo hay que decirlo), pero solo por el hecho de ser más largo.\r\n<br><br>\r\nSe disfruta de principio a fin, siendo un juego que hay que tener, y sin duda candidato al mejor lanzamiento de 2022, en dura pugna con “Horizon: Forbidden west”. Lo siento por “A plague tale: Requiem”, que es buenísimo, pero se quedaría el tercero en mi ranking personal.', 19, '2022-11-25', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imatge`
--

DROP TABLE IF EXISTS `imatge`;
CREATE TABLE `imatge` (
  `id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `titol` varchar(128) NOT NULL,
  `descripcio` varchar(100) DEFAULT NULL,
  `fitxer` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `imatge`
--

TRUNCATE TABLE `imatge`;
--
-- Volcado de datos para la tabla `imatge`
--

INSERT INTO `imatge` (`id`, `autor`, `titol`, `descripcio`, `fitxer`) VALUES
(1, 19, 'Logo IAM.cat', NULL, 'logo.png'),
(5, 20, 'Bosc', NULL, 'pexels-photo-131723.jpeg'),
(6, 20, 'Bosc', NULL, 'pexels-photo-132428.jpeg'),
(7, 20, 'Bosc', NULL, 'pexels-photo-142497.jpeg'),
(8, 20, 'Bosc', NULL, 'pexels-photo-167698.jpeg'),
(9, 20, 'Bosc', NULL, 'pexels-photo-418831.jpeg'),
(10, 20, 'Bosc', NULL, 'pexels-photo-775201.jpeg'),
(11, 20, 'Bosc', NULL, 'pexels-photo-1112186.jpeg'),
(12, 20, 'Bosc', NULL, 'pexels-photo-1179229.jpeg'),
(13, 20, 'Bosc', NULL, 'pexels-photo-1423600.jpeg'),
(14, 20, 'Bosc', NULL, 'pexels-photo-1563604.jpeg'),
(27, 19, 'Black Panther: Wakanda Forever', 'Portada de Black Panther: Wakanda Forever', 'black_panther_wakanda_forever.jpg'),
(28, 19, 'Escape Room: La película', 'Portada de Escape Room: La película', 'escape_room.jpg'),
(29, 19, 'God of War Ragnarök', 'Portada de God of War Ragnarök', 'god_of_war_ragnarok.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `usuari`
--

TRUNCATE TABLE `usuari`;
--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id`, `nom`, `cognoms`, `correu`, `contrasenya`, `reset_token`, `caducitat_token`, `ultima_solicitud_token`) VALUES
(19, 'Marc Jesús', 'Peral Cajidos', 'm.peral@sapalomera.cat', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'b3f738bf93d79d83e649ae969f1317dcd1d7cbd2a529dc8c84df32a998c507d1', '2022-11-23 15:39:29', '2022-11-23 15:24:29'),
(20, 'Marc', 'Peral', 'admin@mperalsapa.cf', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, NULL, '2022-11-03 17:01:38'),
(26, 'Marc', 'Peral Cajidos', 'marcperal23@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`),
  ADD KEY `fk_imatge_id` (`imatge`);

--
-- Indices de la tabla `imatge`
--
ALTER TABLE `imatge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_autor_usuari_id` (`autor`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT de la tabla `imatge`
--
ALTER TABLE `imatge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_imatge_id` FOREIGN KEY (`imatge`) REFERENCES `imatge` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imatge`
--
ALTER TABLE `imatge`
  ADD CONSTRAINT `fk_autor_usuari_id` FOREIGN KEY (`autor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
