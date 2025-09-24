-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2025 a las 07:28:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercado_libre`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin1`
--

CREATE TABLE `admin1` (
  `id_admin` int(11) NOT NULL,
  `nombre_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin1`
--

INSERT INTO `admin1` (`id_admin`, `nombre_admin`, `email_admin`, `password_admin`) VALUES
(2, 'Admin Principal', 'admin1@example.com', '$2y$10$8JeYncwKw27pbPgYZ/vN9eVKltMHIqm8Ewb/OiXGOeQwdQQCTr69O'),
(9, 'Admin Principal', 'admin0@gmail.com', '$2y$10$gW1K5/crm6VfFIi9ZhRMTOpxdHsO0XvUlu8wvD1waIhus.Fca2ocm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre_1` varchar(100) NOT NULL,
  `email_1` varchar(100) NOT NULL,
  `password_1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre_1`, `email_1`, `password_1`) VALUES
(1, 'admin', 'admin9@gmail.com', '$2y$10$oI4l8K7w2E7SG6STZLCNe.8KvF1dQ9VGjgxEgejCy1mldWw6Q2rxe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos_motos_y_otros`
--

CREATE TABLE `autos_motos_y_otros` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autos_motos_y_otros`
--

INSERT INTO `autos_motos_y_otros` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(10, 'gloss', 'k', 600.00, 4, 1, '1757567624_glss1.jpeg'),
(21, 'gjkhu', 'h', 22.00, 2, 1, '1758518698_2.3.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `usuario`, `id_producto`, `cantidad`) VALUES
(12, 'azteca', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Autos, Motos y otros'),
(2, 'Celulares y Telefonía'),
(3, 'Electrodomésticos'),
(4, 'Herramientas'),
(5, 'Ropa, bolsas y calzado'),
(6, 'Deportes y Fitness'),
(7, 'Computación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celulares_y_telefonia`
--

CREATE TABLE `celulares_y_telefonia` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `celulares_y_telefonia`
--

INSERT INTO `celulares_y_telefonia` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(11, 'prueba de tonos', 'hola', 1.00, 3, 2, '1758513954_HD-wallpaper-earth-north-america-south-america-continents-universe-earth-from-space-planet.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `computacion`
--

CREATE TABLE `computacion` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `computacion`
--

INSERT INTO `computacion` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(4, 'prueba suaves', '1', 1.00, 2, 7, '1758517642_vestuario.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes_y_fitness`
--

CREATE TABLE `deportes_y_fitness` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deportes_y_fitness`
--

INSERT INTO `deportes_y_fitness` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(4, 'prueba de brochas', '1111', 111.00, 4, 6, '1758516200_simple-background-simple-space-astronaut-wallpaper-preview.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `usuario`, `calle`, `numero`, `ciudad`, `codigo_postal`) VALUES
(1, 'gregorio', 'AV JOSE MARIA MORELOS', 'S/N', 'CHALCO', '56640'),
(2, 'azteca', 'AV JOSE MARIA MORELOS', 'S/N', 'CHALCO', '56640');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `electrodomesticos`
--

CREATE TABLE `electrodomesticos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `electrodomesticos`
--

INSERT INTO `electrodomesticos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(5, 'prueba de delineadores', '1', 1.00, 1, 3, '1758517374_vestuario 1.1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(7, 'prueba de colores', 'w', 1.00, 1, 4, '1758516728_3.1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa_bolsas_calzado`
--

CREATE TABLE `ropa_bolsas_calzado` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ropa_bolsas_calzado`
--

INSERT INTO `ropa_bolsas_calzado` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `cantidad`, `categoria_id`, `imagen`) VALUES
(3, 'prueba de kits', '1', 1.00, 2, 5, '1758517539_2.5.2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id_tarjeta` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `numero` varchar(16) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `vencimiento` varchar(5) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id_tarjeta`, `usuario`, `numero`, `nombre`, `vencimiento`, `cvv`) VALUES
(1, 'gregorio', '114', 'azteca', '12/22', '666');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'yordi uriel', 'yordiuriel9@gmail.com', '$2y$10$oI4l8K7w2E7SG6STZLCNe.8KvF1dQ9VGjgxEgejCy1mldWw6Q2rxe'),
(2, 'made', 'made@gmail.com', '$2y$10$dOjBEv/FP5tcK9rgMeBkBemYc8KSrRQrR.6voMQN7mJYC6roTlHB6'),
(4, 'geradine', 'gera@gmail.com', '$2y$10$SVdVwEwTTHc.b8yf9PNxwevvcYtmC4FF8kRIh8zpfbWt32GgP0TgO'),
(5, 'administrador', 'admin@gmail.com', '$2y$10$6oOxgB.Wwp5S9evKjYOI2eXbnAiUPPvgDeHY2pkVnEgRZCMF1BSd2'),
(8, 'gregorio', 'gregoriofloress5498@gmail.com', '$2y$10$iGYcNSehc6wE4Nv7QIDr..oDND4DnXvRs84lyDgTG9TJEV.AlmT7O'),
(9, 'Jimenita', 'jvillegas@gmail.com', '$2y$10$Upbw/6i/G.zxPof4sLDiTuLYR6GMOHRwfbxtOYp0V7f442Y5GH5LO'),
(10, 'gregorio', 'gregoriofloress@gmail.com', '$2y$10$iG8WKApewipI8LrF.UJ3bOAvbSDzu8WxFvZxy.ThgSaANPaVvn/ba'),
(11, 'ALE', 'ALE@GMAIL.COM', '$2y$10$iPu6q6BgLenRgvtTXk9Ngeb3KuVBdHyUI6h.9PhZM/DakKIMM9cSO'),
(13, 'gregorio', 'gregoriofloress123@gmail.com', '$2y$10$T1GpfwQIF0ignEF06IsqROgnXjaZwXkPWIUbU9JiZK0AWqRayCeZa'),
(14, 'azteca', 'gregoriofloress321@gmail.com', '$2y$10$3nG08Jz.kFXXlSdTnoukFuiihZoMrxDOQxYosXrK7EeF2.FS1VKTu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin1`
--
ALTER TABLE `admin1`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indices de la tabla `autos_motos_y_otros`
--
ALTER TABLE `autos_motos_y_otros`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `celulares_y_telefonia`
--
ALTER TABLE `celulares_y_telefonia`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `computacion`
--
ALTER TABLE `computacion`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `deportes_y_fitness`
--
ALTER TABLE `deportes_y_fitness`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `ropa_bolsas_calzado`
--
ALTER TABLE `ropa_bolsas_calzado`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id_tarjeta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin1`
--
ALTER TABLE `admin1`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `autos_motos_y_otros`
--
ALTER TABLE `autos_motos_y_otros`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `celulares_y_telefonia`
--
ALTER TABLE `celulares_y_telefonia`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `computacion`
--
ALTER TABLE `computacion`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `deportes_y_fitness`
--
ALTER TABLE `deportes_y_fitness`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ropa_bolsas_calzado`
--
ALTER TABLE `ropa_bolsas_calzado`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id_tarjeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autos_motos_y_otros`
--
ALTER TABLE `autos_motos_y_otros`
  ADD CONSTRAINT `autos_motos_y_otros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `celulares_y_telefonia`
--
ALTER TABLE `celulares_y_telefonia`
  ADD CONSTRAINT `celulares_y_telefonia_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `computacion`
--
ALTER TABLE `computacion`
  ADD CONSTRAINT `computacion_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `deportes_y_fitness`
--
ALTER TABLE `deportes_y_fitness`
  ADD CONSTRAINT `deportes_y_fitness_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  ADD CONSTRAINT `electrodomesticos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD CONSTRAINT `herramientas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ropa_bolsas_calzado`
--
ALTER TABLE `ropa_bolsas_calzado`
  ADD CONSTRAINT `ropa_bolsas_calzado_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
