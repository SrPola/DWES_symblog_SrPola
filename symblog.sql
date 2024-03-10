-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 03:43:30
-- Versión del servidor: 10.4.27-MariaDB-log
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symblog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `blog` longtext NOT NULL,
  `image` varchar(256) NOT NULL,
  `tags` longtext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id`, `title`, `author`, `blog`, `image`, `tags`, `created`, `updated`) VALUES
(17, 'A day with Symfony2', 'dsyph3r', 'Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.', 'beach.jpg', 'symfony2, php, paradise, symblog', '2024-02-25 12:02:35', '2024-02-25 12:02:35'),
(18, 'The pool on the roof must have a leak', 'Zero Cool', 'Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.', 'pool_leak.jpg', 'pool, leaky, hacked, movie, hacking, symblog', '2011-07-23 06:07:33', '2011-07-23 06:07:33'),
(19, 'Misdirection. What the eyes see and the ears hear, the mind believes', 'Gabriel', 'Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'misdirection.jpg', 'misdirection, magic, movie, hacking, symblog', '2011-07-16 16:07:06', '2011-07-16 16:07:06'),
(20, 'The grid - A digital frontier', 'Kevin Flynn', 'Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.', 'the_grid.jpg', 'grid, daftpunk, movie, symblog', '2011-06-02 18:06:12', '2011-06-02 18:06:12'),
(21, 'You\'re either a one or a zero. Alive or dead', 'Gary Winston', 'Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.', 'one_or_zero.jpg', 'binary, one, zero, alive, dead, !trusting, movie, symblog', '2011-04-25 15:04:18', '2011-04-25 15:04:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `comment` longtext NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `blog_id`, `user`, `comment`, `approved`, `created`, `updated`) VALUES
(1, 17, 'symfony', 'To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(2, 17, 'David', 'To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(3, 18, 'Dade', 'Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(4, 18, 'Kate', 'Are you challenging me? ', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(5, 18, 'Dade', 'Name your stakes.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(6, 18, 'Kate', 'If I win, you become my slave.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(7, 18, 'Dade', 'Your SLAVE?', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(8, 18, 'Kate', 'You wish! You\'ll do shitwork, scan, crack copyrights...', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(9, 18, 'Dade', 'And if I win?', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(10, 18, 'Kate', 'Make it my first-born!', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(11, 18, 'Dade', 'Make it our first-date!', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(12, 18, 'Kate', 'I don\'t DO dates. But I don\'t lose either, so you\'re on!', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(13, 19, 'Stanley', 'It\'s not gonna end like this.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(14, 19, 'Gabriel', 'Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(15, 21, 'Mile', 'Doesn\'t Bill Gates have something like that?', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26'),
(16, 21, 'Gary', 'Bill Who?', 1, '2024-02-25 13:02:26', '2024-02-25 13:02:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `profile` varchar(256) NOT NULL DEFAULT 'usuario',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `email`, `profile`, `created`, `updated`) VALUES
(16, 'srpola', '$2y$10$t53chFVzBQrdFRc7TDTobu8nhj4qqP9HWFbwwymwmhyN624RjXkxe', 'angelcuberoolivares@gmail.com', 'puto_amo', '2024-03-10 01:07:29', '2024-03-10 01:07:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`blog_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
