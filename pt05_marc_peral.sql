-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 18:21:41
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
(484, 'Dioses y monstruos en modo aún más épico y espectacular', 'Tras una larga espera, llega a nuestras consolas de Sony la continuación de la historia de Kratos y Atreus en tierras nórdicas, siguiendo por el camino que ya se veía venir con el epílogo del juego anterior.\r\n<br><br>\r\nEn una primera toma de contacto, la sensación que da el juego es de que no hay una gran diferencia técnica con el original. De hecho, ha terminado teniendo un lanzamiento intergeneracional de plataformas. Los gráficos son absolutamente espectaculares, pero ya lo eran en el juego de 2018 y no hay, en apariencia, un gran salto.\r\n<br><br>\r\nLo mismo parece pasar en mecánicas y jugabilidad. Pero esto no tiene nada de malo, de todas formas. Con todo, una vez que empezamos a adentrarnos en la aventura un poco más, es fácil darse cuenta de que sí que han incorporado nuevas habilidades, enemigos, personajes, tipos de misiones secundarias y posibilidades de exploración. Y es que, aunque parezca mentira, el mapa que nos ofrece “Ragnarök” es mucho más grande. Al que le apetezca hacerlo y buscarlo todo, que vaya reservando una buena cantidad de horas.\r\n<br><br>\r\nAdemás, el juego es bueno tanto en devolvernos a reinos conocidos como en el diseño de los nuevos. Y encuentro también un muy buen equilibrio entre la exploración, los puzzles y el combate, que además, como es de mundo abierto, cada jugador podrá decidir hasta dónde quiere llegar.\r\n<br><br>\r\nLa historia nos lleva a la famosa guerra de dioses que según la mitología vikinga tendría lugar en el fin del mundo, y para evitarlo Kratos tendrá que tomar partido en contra de Odín, tarea que no le va a ser nada fácil. Es un guion muy bien trabajado y atractivo, que enriquece mucho más todo el universo del que ya se sentaron las bases en el título anterior.\r\n<br><br>\r\nSi el primero era grandioso, este lo es aún más, aunque no innove demasiado (todo hay que decirlo), pero solo por el hecho de ser más largo.\r\n<br><br>\r\nSe disfruta de principio a fin, siendo un juego que hay que tener, y sin duda candidato al mejor lanzamiento de 2022, en dura pugna con “Horizon: Forbidden west”. Lo siento por “A plague tale: Requiem”, que es buenísimo, pero se quedaría el tercero en mi ranking personal.', 19, '2022-11-25', 29),
(485, 'Cómicos, película muy infravalorada y ópera prima cómo director unico de Juan Antonio Bardem', 'En ésta película Juan Antonio Bardem nos hace una radiografía del mundo teatral de la posguerra, donde se destaca la “apenada” vida de los actores y actrices, siempre viajando en incómodos trayectos en tren, necesidad de pedir adelantos de dinero al no llegar a fin de mes, siempre durmiendo en pensiones inmundas, y tristemente sabiendo que la vida de estos actores y actrices secundarios difícilmente cambiará, salvo milagro, accidente de la actriz principal, o cómo en la película que nos ocupa que un empresario de teatro se encapriche de la actriz y ésta acceda a sus favores por un papel principal en la siguiente obra de teatro..\r\nJuan Antonio Bardem hace gala de un cine social, comprometido con su profesión, mundillo que conocía muy bien al ser hijo de actores. Me parece una película infravalorada en nuestro país, y animo a la gente a que vea menos cine de Hollywood y más éste tipo de cine, que aún siendo antiguo, es cine de autor de altos quilates.', 20, '2022-11-28', 31),
(486, 'Vegetarianos', 'Pensaba que había visto los peores truños de la historia del cine, me equivocaba.\r\nPude pensar que sería más desagradable que la anterior, pero creo que ya en el comienzo pensaron que había que hacer un film para desechar, más simpático, rozando lo patético.\r\n\r\nEn fin, valioso tiempo perdido.', 20, '2022-11-28', 33),
(487, 'Solo ante el peligro', 'Un western gallego en donde se repiten muchos de los tópicos del género, conversaciones en el Salón, madres vengativas, familias unidas, autoridades ineficaces, belllos paisajes... Tiene también toques de modernidad con el uso de vídeos o de ordenadores por los protagonistas.\r\n\r\nMarina Fois hace un papel extraordinario, dando hondura a su personaje, probablemente el menos esterotipado de todos.\r\n\r\nNo acabo de ver por qué la película no logra en ningún momento transmitirme credibilidad y autenticidad, pero nunca dejo de sentirme como un espectador viendo una película con escenas que me parecen a ratos excesivas. Luis Zahera me parece sobreactuado, plano, sin matices, que sin embargo sí tiene el guión.\r\n\r\nSí me quedaré con el recuerdo de como a un hombre se le puede deshumanizar y convertirle en nada más que una \"besta\".', 20, '2022-11-28', 32);

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
(1, 19, 'Logo IAM.cat', 'Logo de IAM', 'logo_iam.png'),
(5, 20, 'Bosc', NULL, 'img-bosc-131723.jpeg'),
(6, 20, 'Bosc', NULL, 'img-bosc-132428.jpeg'),
(7, 20, 'Bosc', NULL, 'img-bosc-142497.jpeg'),
(8, 20, 'Bosc', NULL, 'img-bosc-167698.jpeg'),
(9, 20, 'Bosc', NULL, 'img-bosc-418831.jpeg'),
(10, 20, 'Bosc', NULL, 'img-bosc-775201.jpeg'),
(11, 20, 'Bosc', NULL, 'img-bosc-1112186.jpeg'),
(12, 20, 'Bosc', NULL, 'img-bosc-1179229.jpeg'),
(13, 20, 'Bosc', NULL, 'img-bosc-1423600.jpeg'),
(14, 20, 'Bosc', NULL, 'img-bosc-1563604.jpeg'),
(27, 19, 'Black Panther: Wakanda Forever', 'Portada de Black Panther: Wakanda Forever', 'black_panther_wakanda_forever.jpg'),
(28, 19, 'Escape Room: La película', 'Portada de Escape Room: La película', 'escape_room.jpg'),
(29, 19, 'God of War Ragnarök', 'Portada de God of War Ragnarök', 'god_of_war_ragnarok.jpg'),
(31, 20, 'Portada Comicos', '', 'comicos-529430073-large.jpg'),
(32, 20, 'Portada As Bestias', '', 'as_bestas-275688233-large.jpg'),
(33, 20, 'Portada Holocausto caníbal 2', '', 'natura_contro-649165363-large.jpg');

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
(19, 'Marc Jesús', 'Peral Cajidos', 'm.peral@sapalomera.cat', 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342', NULL, NULL, '2022-11-23 15:24:29'),
(20, 'Marc', 'Peral', 'admin@mperalsapa.cf', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'd9f7b95dbf6138ad37a1146138708d55c4de2249b06f19135b39d9110f5fa6ae', '2022-11-28 17:25:06', '2022-11-28 17:10:06'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=488;

--
-- AUTO_INCREMENT de la tabla `imatge`
--
ALTER TABLE `imatge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
