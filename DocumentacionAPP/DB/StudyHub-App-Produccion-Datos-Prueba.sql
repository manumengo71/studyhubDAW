-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mi-mysql:3306
-- Tiempo de generación: 06-06-2024 a las 09:43:10
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `StudyHub-App`
--
CREATE DATABASE IF NOT EXISTS `StudyHub-App` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `StudyHub-App`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing_histories`
--

DROP TABLE IF EXISTS `billing_histories`;
CREATE TABLE `billing_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `buyer_id` bigint UNSIGNED NOT NULL,
  `billing_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing_information`
--

DROP TABLE IF EXISTS `billing_information`;
CREATE TABLE `billing_information` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `owner_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_surname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_second_surname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_card_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvv` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `billing_information`
--

INSERT INTO `billing_information` (`id`, `user_id`, `owner_name`, `owner_surname`, `owner_second_surname`, `credit_card_number`, `expiration_date`, `cvv`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'StudyHub-App-AdminName', 'AdminSurname', 'AdminSecondSurname', '1234567890123456', '12/99', '123', 4, '2024-06-05 12:15:47', '2024-06-05 12:15:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `courses_categories_id` bigint UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `validated` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `owner_id`, `courses_categories_id`, `name`, `short_description`, `description`, `language`, `price`, `validated`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 1, 'Laravel en 5 min.', 'Pequeño curso de Laravel para iniciarse en este framework de PHP.', 'En este curso GRATUITO aprenderás lo más básico de este framework de php. ¡Consulta mis otros cursos para aprender más!', 'Español', 0.00, 1, '2024-06-05 12:51:38', '2024-06-06 05:42:47', NULL),
(6, 1, 6, 'Las recetas de la abuela.', 'Curso donde encontrarás las recetas más famosa al estilo abuela.', 'En este curso aprenderás a realizar diversas recetas.', 'Español', 10.00, 1, '2024-06-06 05:44:18', '2024-06-06 05:55:54', NULL),
(7, 1, 8, 'Fotografía para principiantes.', 'Lo básico en el mundo de la fotografía.', 'Aprenderás como iniciarte en este mundo y lo necesario para ello. Incluye sorteo camara Nikon 6II.', 'Español', 28.00, 1, '2024-06-06 06:11:56', '2024-06-06 06:13:06', NULL),
(8, 1, 25, 'Verschiedene Sportkurse', 'Sie erfahren, wie man die berühmtesten Sportarten ausübt. Perfekt für Studenten dieser Karriere.', 'In diesem Kurs lernen die Studierenden, wie man die bekanntesten und beliebtesten Sportarten der Welt ausübt und unterrichtet. Das Programm ist darauf ausgelegt, sowohl theoretisches Wissen als auch praktische Fähigkeiten zu vermitteln. Es behandelt alles von den Grundregeln und der Geschichte jeder Sportart bis hin zu fortgeschrittenen Techniken und Trainingsstrategien.', 'Alemán', 0.00, 1, '2024-06-06 06:15:11', '2024-06-06 06:24:38', NULL),
(9, 1, 16, 'Desarrollo de Videojuegos Interactivo', 'Crea videojuegos desde cero con Unity y C#.', 'Aprende a desarrollar videojuegos utilizando Unity y C#, desde conceptos básicos hasta técnicas avanzadas de programación y diseño. Este curso te guía a través del proceso completo de diseño y desarrollo de videojuegos. Aprenderás sobre motores gráficos, programación, diseño de niveles, y mecánicas de juego, todo mientras creas tus propios proyectos jugables.', 'Español', 120.00, 1, '2024-06-06 07:42:52', '2024-06-06 07:44:34', NULL),
(10, 1, 1, 'Maestría en Tailwind CSS', 'Domina Tailwind CSS para crear interfaces web modernas.', 'Este curso ofrece una inmersión completa en Tailwind CSS, el framework de CSS utilitario. Aprende a construir diseños web responsivos y eficientes con clases predefinidas que facilitan el proceso de estilización. Ideal para desarrolladores web que buscan mejorar la rapidez y la coherencia en sus proyectos.', 'Español', 25.00, 1, '2024-06-06 07:54:46', '2024-06-06 07:59:11', NULL),
(11, 1, 1, 'Programación en Java desde Cero', 'omina Java y sus aplicaciones desde lo básico a lo avanzado.', 'En este curso aprenderás los fundamentos de Java, uno de los lenguajes de programación más populares y versátiles. Abarca desde conceptos básicos hasta programación orientada a objetos, estructuras de datos y aplicaciones avanzadas. De 0 a Senior en 5h.', 'Español', 180.00, 1, '2024-06-06 08:00:59', '2024-06-06 08:55:46', NULL),
(12, 1, 23, 'Fundamentos de Medicina: De la Teoría a la Práctica', 'Aprende los principios esenciales para la práctica médica.', 'Sumérgete en los conceptos fundamentales de la medicina, desde anatomía y fisiología hasta diagnóstico y tratamiento. Este curso proporciona una base sólida para estudiantes de medicina y profesionales de la salud, abordando tanto los aspectos teóricos como su aplicación práctica en el cuidado de pacientes.', 'Español', 99.99, 1, '2024-06-06 08:03:15', '2024-06-06 08:55:45', NULL),
(13, 1, 1, 'Dominando Python: De Novato a Experto', 'Conviértete en un maestro de Python y desbloquea su potencial.', 'Este curso te lleva desde los conceptos básicos hasta las técnicas avanzadas de programación en Python. Aprenderás sobre estructuras de datos, programación orientada a objetos, manipulación de archivos, y mucho más. Ideal para principiantes y programadores intermedios que deseen mejorar sus habilidades en uno de los lenguajes de programación más populares del mundo.', 'Español', 148.25, 1, '2024-06-06 08:05:02', '2024-06-06 08:55:42', NULL),
(14, 1, 17, 'Explorando el Mundo de las Matemáticas', 'Descubre la belleza y utilidad de las matemáticas en la vida cotidiana.', 'Este curso te sumerge en el fascinante universo de las matemáticas, desde los conceptos fundamentales hasta sus aplicaciones en el mundo real. Explora temas como álgebra, geometría, cálculo y estadísticas, y aprende a resolver problemas prácticos con confianza y precisión.', 'Español', 65.99, 1, '2024-06-06 08:09:01', '2024-06-06 08:55:44', NULL),
(15, 1, 9, 'Inglés rápido, fácil y eficaz.', 'Domina el inglés con confianza y fluidez en todas las situaciones.', 'Este curso te guía desde los fundamentos del inglés hasta el dominio fluido del idioma. Aprende gramática, vocabulario y habilidades de conversación y escritura, todo respaldado por ejercicios prácticos y situaciones del mundo real.', 'Inglés', 42.00, 1, '2024-06-06 08:12:19', '2024-06-06 08:55:35', NULL),
(16, 1, 1, 'Programación: Desde los Fundamentos hasta la Excelencia', 'Domina la programación desde cero y alcanza la excelencia en el desarrollo de software.', 'Este curso te lleva desde los conceptos básicos de la programación hasta técnicas avanzadas de desarrollo de software, preparándote para enfrentar desafíos en el mundo real. Aprenderás sobre algoritmos, estructuras de datos, paradigmas de programación y prácticas de codificación eficientes. Con ejercicios prácticos y proyectos guiados, estarás listo para sobresalir en cualquier entorno de programación. Ideal para principiantes y aquellos que buscan perfeccionar sus habilidades en programación.', 'Español', 114.50, 1, '2024-06-06 09:02:28', '2024-06-06 09:05:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses_categories`
--

DROP TABLE IF EXISTS `courses_categories`;
CREATE TABLE `courses_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `courses_categories`
--

INSERT INTO `courses_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Programación', 'Quo perferendis et reprehenderit enim.', '2024-06-05 12:12:37', '2024-06-05 12:12:37', NULL),
(3, 'Marketing', 'Culpa quo iure distinctio animi consequuntur itaque nihil.', '2024-06-05 12:12:39', '2024-06-05 12:12:39', NULL),
(4, 'Finanzas', 'Amet voluptas nisi sit ipsam qui eaque.', '2024-06-05 12:12:42', '2024-06-05 12:12:42', NULL),
(5, 'Inglés', 'Nulla animi dolorem est asperiores.', '2024-06-05 12:12:43', '2024-06-05 12:12:43', NULL),
(6, 'Cocina', 'Inventore ipsum laborum est praesentium quae quis id.', '2024-06-05 12:12:44', '2024-06-05 12:12:44', NULL),
(7, 'Música', 'Nostrum cupiditate maiores unde esse voluptas ipsum quo fugit.', '2024-06-05 12:12:44', '2024-06-05 12:12:44', NULL),
(8, 'Fotografía', 'Est modi vitae hic nam.', '2024-06-05 12:12:46', '2024-06-05 12:12:46', NULL),
(9, 'Idiomas', 'Cumque esse voluptatibus autem fugiat libero.', '2024-06-05 12:12:48', '2024-06-05 12:12:48', NULL),
(10, 'Negocios', 'Rerum magni repellendus cumque.', '2024-06-05 12:12:48', '2024-06-05 12:12:48', NULL),
(11, 'Desarrollo Personal', 'Quo vero nostrum ea quod atque voluptatem.', '2024-06-05 12:12:48', '2024-06-05 12:12:48', NULL),
(13, 'Diseño Web', 'Vitae accusantium eos atque.', '2024-06-05 12:12:50', '2024-06-05 12:12:50', NULL),
(14, 'Desarrollo Web', 'Itaque maxime sint eum suscipit beatae aut vero suscipit.', '2024-06-05 12:12:51', '2024-06-05 12:12:51', NULL),
(15, 'Desarrollo Móvil', 'Veniam quo nobis numquam aut et labore.', '2024-06-05 12:12:51', '2024-06-05 12:12:51', NULL),
(16, 'Videojuegos', 'Quasi rem laborum eos porro cumque a nihil.', '2024-06-05 12:12:51', '2024-06-05 12:12:51', NULL),
(17, 'Matemáticas', 'Qui iste inventore consequatur.', '2024-06-05 12:12:53', '2024-06-05 12:12:53', NULL),
(18, 'Ciencias', 'Aperiam repudiandae repellat delectus id eos atque eos.', '2024-06-05 12:12:53', '2024-06-05 12:12:53', NULL),
(19, 'Humanidades', 'Dolor omnis pariatur temporibus ut et.', '2024-06-05 12:12:53', '2024-06-05 12:12:53', NULL),
(20, 'Ciencias Sociales', 'Et sint perspiciatis consectetur consequuntur.', '2024-06-05 12:12:54', '2024-06-05 12:12:54', NULL),
(21, 'Estilo de Vida', 'Qui enim porro fuga accusantium.', '2024-06-05 12:12:54', '2024-06-05 12:12:54', NULL),
(22, 'Belleza', 'Distinctio magni nihil est.', '2024-06-05 12:12:54', '2024-06-05 12:12:54', NULL),
(23, 'Salud', 'Veniam ut aut quisquam assumenda.', '2024-06-05 12:12:54', '2024-06-05 12:12:54', NULL),
(24, 'Fitness', 'Qui aut error sunt expedita excepturi molestiae quis.', '2024-06-05 12:12:55', '2024-06-05 12:12:55', NULL),
(25, 'Deportes', 'Ut dolorum non id eos voluptatibus rerum cum.', '2024-06-05 12:12:55', '2024-06-05 12:12:55', NULL),
(26, 'Otros', 'Sunt et magni et dolorem.', '2024-06-05 12:12:55', '2024-06-05 12:12:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_card_types`
--

DROP TABLE IF EXISTS `credit_card_types`;
CREATE TABLE `credit_card_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `credit_card_types`
--

INSERT INTO `credit_card_types` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Visa', '4', '2024-06-05 12:12:36', '2024-06-05 12:12:37'),
(2, 'MasterCard', '5', '2024-06-05 12:12:36', '2024-06-05 12:12:37'),
(3, 'American Express', '3', '2024-06-05 12:12:36', '2024-06-05 12:12:37'),
(4, 'Otro', '0', '2024-06-05 12:12:36', '2024-06-05 12:12:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE `lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `courses_id` bigint UNSIGNED NOT NULL,
  `lessons_types_id` bigint UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lessons`
--

INSERT INTO `lessons` (`id`, `courses_id`, `lessons_types_id`, `title`, `subtitle`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 4, 'Logo Laravel 11', 'Foto del logo de Laravel.', NULL, '2024-06-06 05:29:15', '2024-06-06 05:29:24', NULL),
(2, 5, 3, 'Laravel en 5 min', 'Video para aprender lo mas básico de este framework.', NULL, '2024-06-06 05:31:09', '2024-06-06 05:31:17', NULL),
(3, 5, 5, 'Novedades de Laravel 11', 'Aquí se redactan las novedades de Laravel 11.', '{\"time\":1717652522222,\"blocks\":[{\"id\":\"6j2YmFVMme\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/36/laravel-11-novedades-nuevas-caracteristicas.webp\"},\"caption\":\"Novedades Laravel 11.\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"Ek8g4s3WKt\",\"type\":\"paragraph\",\"data\":{\"text\":\"Documentación oficial de Laravel -&gt; <a href=\\\"https://laravel.com/docs/11.x/readme\\\">pinchar aquí</a>\"}},{\"id\":\"s1mXTnATgM\",\"type\":\"header\",\"data\":{\"text\":\"<mark>¡Laravel 11 fue liberado el martes 12 de marzo de 2024 junto con Laravel Reverb!</mark>\",\"level\":4}},{\"id\":\"Ck30ZodaZJ\",\"type\":\"paragraph\",\"data\":{\"text\":\"Laravel 11 continúa las mejoras realizadas en Laravel 10.x al introducir una estructura de directorios optimizada, limitación de peticiones (<code>rate limit</code>) por segundo, nueva ruta&nbsp;<code>health check</code>, rotación de claves de encriptación, mejoras en las pruebas de queue,&nbsp;<a target=\\\"_blank\\\" rel=\\\"nofollow\\\" href=\\\"https://resend.com/home\\\"><u>Resend</u></a>&nbsp;como email transport, añadido el sistema de validación de Laravel a los&nbsp;<code>prompts</code>, nuevos comandos Artisan y más. Además, se ha introducido&nbsp;<a target=\\\"_blank\\\" href=\\\"https://laravel.com/docs/11.x/reverb\\\">Laravel Reverb</a>, un servidor WebSocket escalable el cual podemos gestionar nosotros mismos para proporcionar capacidades sólidas en tiempo real para nuestras aplicaciones.\"}},{\"id\":\"pQiJUBnIQT\",\"type\":\"header\",\"data\":{\"text\":\"PHP 8.2, versión mínima en Laravel 11\",\"level\":3}},{\"id\":\"TfsZKCq_PM\",\"type\":\"list\",\"data\":{\"style\":\"ordered\",\"items\":[\"PHP 8.2, Version mínima en Laravel 11.\",\"Estructira en directorios optimizada.\",\"Context como novedad.\"]}},{\"id\":\"ZtPVlEZQAE\",\"type\":\"header\",\"data\":{\"text\":\"<b>Estructura de directorios optimizada</b>\",\"level\":3}},{\"id\":\"P-kMsSPRh1\",\"type\":\"paragraph\",\"data\":{\"text\":\"Laravel 11 introduce una estructura de directorios y archivos optimizada para&nbsp;nuevas&nbsp;aplicaciones Laravel, sin requerir ningún cambio en las aplicaciones existentes. La nueva estructura tiene como objetivo proporcionar una experiencia más ágil y moderna, manteniendo al mismo tiempo muchos de los conceptos con los que los desarrolladores de Laravel ya estamos familiarizados. Aquí tienes un&nbsp;<a target=\\\"_blank\\\" href=\\\"https://www.cursosdesarrolloweb.es/blog/sumergete-en-la-estructura-de-directorios-en-laravel-11\\\">tutorial completo</a>&nbsp;acerca de la nueva estructura de directorios en Laravel 11.\"}},{\"id\":\"V6Fw6UxXsJ\",\"type\":\"header\",\"data\":{\"text\":\"<b>Service Providers</b>\",\"level\":3}},{\"id\":\"qEXmpIcD7g\",\"type\":\"paragraph\",\"data\":{\"text\":\"En versiones anteriores de Laravel, por defecto teníamos cinco Service Providers, Laravel 11 incluye un único Service Provider, el&nbsp;<code>AppServiceProvider</code>. La funcionalidad de los Service Providers anteriores se ha incorporado al archivo&nbsp;<code>bootstrap/app.php</code>&nbsp;y ahora es Laravel quien maneja esto automáticamente.\"}},{\"id\":\"0UXdna49l-\",\"type\":\"paragraph\",\"data\":{\"text\":\"Por ejemplo, el&nbsp;<code>auto discovery</code>&nbsp;de eventos ahora está habilitado de forma predeterminada, lo que elimina en gran medida la necesidad de registrar manualmente los&nbsp;<a target=\\\"_blank\\\" href=\\\"https://www.cursosdesarrolloweb.es/blog/eventos-y-listeners-en-laravel\\\">eventos y sus listeners</a>. Sin embargo, si necesitas registrar eventos manualmente, simplemente puedes hacerlo en el archivo&nbsp;<code>AppServiceProvider</code>.\"}},{\"id\":\"3NtldWu6kO\",\"type\":\"header\",\"data\":{\"text\":\"<b>Nuevo Context</b>\",\"level\":3}},{\"id\":\"NIGellfejr\",\"type\":\"paragraph\",\"data\":{\"text\":\"Laravel 11 nos ofrece una nueva&nbsp;<a target=\\\"_blank\\\" href=\\\"https://laravel.com/docs/11.x/context\\\">Fachada&nbsp;</a><code>Context&nbsp;</code>la cual permiten capturar, recuperar y compartir información a través de solicitudes, jobs y comandos que se ejecutan dentro de nuestra aplicación. Esta información capturada también se incluye en los logs de nuestra aplicación, lo que nos puede dar una visión más profunda del historial de ejecución del código circundante que ocurrió antes de que se escribiera una entrada de registro y nos permite rastrear los flujos de ejecución en todo un sistema distribuido.\"}},{\"id\":\"4hLtE9R8Sr\",\"type\":\"paragraph\",\"data\":{\"text\":\"Puedes ver que añadimos dos entradas al contexto y después llamamos a un job para que procese este Podcast. Gracias a esto, el job Podcast podrá acceder a ese par de entradas de la siguiente forma.\"}},{\"id\":\"tbPg135lym\",\"type\":\"paragraph\",\"data\":{\"text\":\"<code class=\\\"inline-code\\\">&lt;phpuseIlluminate\\\\Support\\\\Facades\\\\Context;classProcessPodcastimplementsShouldQueue{useDispatchable, InteractsWithQueue, Queueable, SerializesModels;// .../**     * Execute the job.     */publicfunctionhandle(): void    {$contextUrl = Context::get(\'url\');$contextTraceId = Context::get(\'trace_id\');Log::info(\'Processing podcast.\', [\'podcast_id\' =&gt; $this-&gt;podcast-&gt;id,        ]);    }}</code>\"}},{\"id\":\"N0ixb4NV8I\",\"type\":\"paragraph\",\"data\":{\"text\":\"Y como hemos realizado un Log::info, en los logs también podremos ver ese contexto.\"}},{\"id\":\"x38w6ebHDj\",\"type\":\"paragraph\",\"data\":{\"text\":\"Processing podcast. <code class=\\\"inline-code\\\">{\\\"podcast_id\\\":95} {\\\"url\\\":\\\"https://example.com/login\\\",\\\"trace_id\\\":\\\"e04e1a11-e75c-4db3-b5b5-cfef4ef56697\\\"}</code>\"}},{\"id\":\"PBgbvt5Pzu\",\"type\":\"header\",\"data\":{\"text\":\"Rutas opcionales: API y Broadcast\",\"level\":3}},{\"id\":\"qwE_O1lK06\",\"type\":\"paragraph\",\"data\":{\"text\":\"Los archivos de ruta&nbsp;<code>api.php&nbsp;</code>y&nbsp;<code>channels.php&nbsp;</code>ya no están presentes de forma predeterminada, ya que muchas aplicaciones no los requieren. Sin embargo, se pueden crear usando comandos simples de&nbsp;<code>Artisan</code>:\"}},{\"id\":\"WInbSs6v_6\",\"type\":\"code\",\"data\":{\"code\":\"php artisan install:apiphp artisan install:broadcastingview rawartisan.sh \"}},{\"id\":\"cz4We1uVVj\",\"type\":\"header\",\"data\":{\"text\":\"<b>Middlewares</b>\",\"level\":3}},{\"id\":\"2pTiask3dR\",\"type\":\"paragraph\",\"data\":{\"text\":\"Anteriormente, las nuevas aplicaciones de Laravel incluían nueve middlewares. Estos middlewares realizan una gran variedad de tareas, como autenticar solicitudes, recortar cadenas de entrada y validación&nbsp;<code>CSRF</code>.\"}},{\"id\":\"bX-2hx08Ix\",\"type\":\"paragraph\",\"data\":{\"text\":\"En Laravel 11, estos middlewares se han movido al core del framework, para que no agreguen volumen a la estructura de nuestra aplicación. Además, se han agregado al framework nuevos métodos para personalizar el manejo de los middlewares y se pueden invocar desde el archivo&nbsp;<code>bootstrap/app.php</code>&nbsp;de nuestra aplicación:\"}},{\"id\":\"cFD5VE-1E2\",\"type\":\"code\",\"data\":{\"code\":\"<?php->withMiddleware(function (Middleware$middleware) {$middleware->validateCsrfTokens( except: [\'stripe/*\'] );$middleware->web(append: [EnsureUserIsSubscribed::class, ]);})\"}},{\"id\":\"0blSlgFIh5\",\"type\":\"paragraph\",\"data\":{\"text\":\"Dado que todo Middleware se puede personalizar fácilmente a través del archivo&nbsp;<code>bootstrap/app.php</code>, se ha eliminado el Kernel Http.\"}},{\"id\":\"9_1D8ywuJC\",\"type\":\"header\",\"data\":{\"text\":\"<b>Scheduling</b>\",\"level\":3}},{\"id\":\"p_kf4hLleY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Usando una nueva Facade&nbsp;<code>Schedule</code>, las tareas programadas ahora se pueden definir directamente en el archivo&nbsp;<code>routes/console.php</code>, por este motivo, el&nbsp;<code>Kernel&nbsp;</code>de Consola ha sido eliminado:\"}},{\"id\":\"TwFmJIhBWs\",\"type\":\"paragraph\",\"data\":{\"text\":\"<code class=\\\"inline-code\\\">&lt;?phpuseIlluminate\\\\Support\\\\Facades\\\\Schedule;Schedule::command(\'emails:send\')-&gt;daily();</code>\"}},{\"id\":\"PGOLWXo0yo\",\"type\":\"header\",\"data\":{\"text\":\"<b>Manejo de excepciones</b>\",\"level\":3}},{\"id\":\"eOM67ZqVtH\",\"type\":\"paragraph\",\"data\":{\"text\":\"Al igual que ocurre con la gestión de rutas y middlewares, el manejo de excepciones ahora se puede personalizar desde el archivo&nbsp;<code>bootstrap/app.php</code>&nbsp;en lugar de hacer uso de una clase de excepciones separada, por este motivo, la clase Exceptions/Handler.php ha sido eliminada:\"}},{\"id\":\"EMjoEVrihv\",\"type\":\"paragraph\",\"data\":{\"text\":\"<code class=\\\"inline-code\\\">&lt;?php-&gt;withExceptions(function (Exceptions$exceptions) {$exceptions-&gt;dontReport(MissedFlightException::class);$exceptions-&gt;reportable(function (InvalidOrderException$e) {// ...     });})</code>\"}}],\"version\":\"2.29.1\"}', '2024-06-06 05:34:41', '2024-06-06 05:42:02', NULL),
(4, 5, 2, 'Resumen general de todo Laravel.', 'Resumen en formato PDF.', NULL, '2024-06-06 05:42:32', '2024-06-06 05:42:38', NULL),
(5, 6, 3, 'Recetas mas famosas y su elaboración', 'Video para aprender.', NULL, '2024-06-06 05:45:12', '2024-06-06 05:45:21', NULL),
(6, 6, 5, 'Otras recetas y conclusiones', 'Ahora por escrito, vamos a ver algunas otras menos famosas pero igual de buenas.', '{\"time\":1717653302037,\"blocks\":[{\"id\":\"0rdKF3CAES\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/40/abuelalogo.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"4ybMyD9-9D\",\"type\":\"header\",\"data\":{\"text\":\"<b>OTRAS RECETAS DE LA ABUELA</b>\",\"level\":2}},{\"id\":\"uTKspI-SBa\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/41/otrasrecetaabuela.jpg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"bMAa_8FbaG\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/torrijas\\\">Torrijas</a>\"}},{\"id\":\"UJ8qX9HbTt\",\"type\":\"paragraph\",\"data\":{\"text\":\"Más allá de las múltiples versiones y reinterpretaciones de este popular dulce tradicional de Semana Santa, con la receta que presentamos a…\"}},{\"id\":\"uam9P_c1ZO\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/42/torrijasabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"pGvnW8q7bX\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/tarta-de-la-abuela\\\">Tarta de la abuela</a>\"}},{\"id\":\"f3Hbj0w72_\",\"type\":\"paragraph\",\"data\":{\"text\":\"Esta es una de las recetas más famosas y fáciles de preparar y además, de las más ricas. La máxima complicación será preparar la crema, el resto es…\"}},{\"id\":\"NhoXyiCz1-\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/44/tartadelaabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"MBlpL1hRLI\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/arroz-con-leche-casero\\\">Arroz con leche</a>\"}},{\"id\":\"Q5qQNV0l5o\",\"type\":\"paragraph\",\"data\":{\"text\":\"El arroz con leche es un postre tradicional muy fácil de preparar y al que pocos pueden resistirse. Podemos tomarlo templado recién hecho o frío. Si…\"}},{\"id\":\"fVc4FE9oGP\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/45/arrozconlecheabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"LoACznV28Z\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/albondigas-en-salsa\\\">Albóndigas en salsa</a>\"}},{\"id\":\"MX668oyJpD\",\"type\":\"paragraph\",\"data\":{\"text\":\"Lo importante de esta receta es conseguir unas albóndigas en salsa tiernas y sabrosas. Para ello, pocharemos primero un poco de cebolla antes de…\"}},{\"id\":\"aUfLu0CBgR\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/46/albondigasabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"7LNDeUV65d\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/pollo-en-salsa-de-la-abuela\\\">Pollo en salsa de la abuela</a>\"}},{\"id\":\"IRFNvlLEcK\",\"type\":\"paragraph\",\"data\":{\"text\":\"En nuestra gastronomía existen recetas tradicionales con tantas versiones como abuelas hay en España y, en la receta que vamos a preparar hoy, esto…\"}},{\"id\":\"p543hj7MQh\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/47/polloensalsaabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"x_aI49va2z\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/lentejas-chorizo\\\">Lentejas con chorizo</a>\"}},{\"id\":\"G0bXJIcVKS\",\"type\":\"paragraph\",\"data\":{\"text\":\"Puedo afirmar con total seguridad que mis legumbres favoritas, desde que tengo uso de razón, son las lentejas, especialmente si quien las prepara es…\"}},{\"id\":\"8IuD00Piox\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/48/lentejaschorizoabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"11ZD-YAPyl\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/tarta-de-galletas-chocolate\\\">Tarta de galletas y chocolate de la abuela</a>\"}},{\"id\":\"KRhbGhrUHS\",\"type\":\"paragraph\",\"data\":{\"text\":\"Bajo el nombre de tarta de la abuela podemos encontrar diferentes versiones, siempre con galleta, pero con distintos rellenos; con crema, con…\"}},{\"id\":\"Vxj3v4czh2\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/49/tartachcolateygalletaabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"2dvvcG8bjd\",\"type\":\"paragraph\",\"data\":{\"text\":\"<a href=\\\"https://www.bonviveur.es/recetas/cordero-guisado-de-la-abuela\\\">Cordero guisado de la abuela</a>\"}},{\"id\":\"LkCA3wCRVn\",\"type\":\"paragraph\",\"data\":{\"text\":\"El cordero es una de las carnes nobles de nuestra gastronomía. Hay infinidad de maneras de cocinarlo como al horno, estofado o la famosa caldereta de…\"}},{\"id\":\"GFlB8yy2-n\",\"type\":\"image\",\"data\":{\"file\":{\"url\":\"http://localhost:8000/storage/43/corderoguisadoabuelaabuela.jpeg\"},\"caption\":\"\",\"withBorder\":false,\"stretched\":false,\"withBackground\":false}},{\"id\":\"jBnObyex_Z\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b><i><u class=\\\"cdx-underline\\\">A continuación, en la siguiente lección adjunto un PDF de un libro muy antiguo el cual me inspiro a mi a apasionarme por la cocina de la abuela y realizar este curso. Muchas gracias!</u></i></b>\"}}],\"version\":\"2.29.1\"}', '2024-06-06 05:47:05', '2024-06-06 05:55:02', NULL),
(7, 6, 2, 'Libro Recetas de la Abuela antiguo PDF', 'Libro que me inspiro a apasionarme por la cocina.', NULL, '2024-06-06 05:55:36', '2024-06-06 05:55:45', NULL),
(8, 7, 1, 'Kit de principiante', 'Vamos a crear un pequeño kit para empezar en este mundo.', NULL, '2024-06-06 06:12:53', '2024-06-06 06:12:53', NULL),
(9, 8, 1, 'Techniken und Taktiken im modernen Fußball.', 'In dieser Lektion lernen die Studierenden die grundlegenden und fortgeschrittenen Techniken.', NULL, '2024-06-06 06:24:25', '2024-06-06 06:24:25', NULL),
(10, 9, 1, 'Introducción', 'Introducción a C#', NULL, '2024-06-06 07:44:26', '2024-06-06 07:44:26', NULL),
(11, 10, 1, 'Tailwind css a fondo', 'Todo lo que debes saber sobre tailwind Css en una sola lección.', NULL, '2024-06-06 07:58:55', '2024-06-06 07:58:55', NULL),
(12, 11, 1, 'De 0 a senior', 'Introducción de todo lo que debes saber para adentrarte en esta aventura.', NULL, '2024-06-06 08:01:51', '2024-06-06 08:01:51', NULL),
(13, 12, 1, '¿Porqué la carrera no es rentable?', 'Introducción al curso.', NULL, '2024-06-06 08:03:45', '2024-06-06 08:03:45', NULL),
(14, 13, 1, 'Manipulación de Datos con Pandas', 'Descubre cómo utilizar la potente biblioteca Pandas en Python.', NULL, '2024-06-06 08:07:16', '2024-06-06 08:07:16', NULL),
(15, 14, 1, 'Matemáticas y todo su potencial.', 'Aprende la historia de las matemáticas.', NULL, '2024-06-06 08:09:23', '2024-06-06 08:09:23', NULL),
(16, 15, 1, 'Tipos de pronunciación', 'Explicación de los tipos de pronunciación del inglés.', NULL, '2024-06-06 08:55:15', '2024-06-06 08:55:15', NULL),
(17, 16, 1, 'Todo lo que debes saber', 'Adquirirás todo lo necesario para ser un excelente programador en cualquier lenguaje.', NULL, '2024-06-06 09:03:21', '2024-06-06 09:03:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lessons_types`
--

DROP TABLE IF EXISTS `lessons_types`;
CREATE TABLE `lessons_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lessons_types`
--

INSERT INTO `lessons_types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Default', 'Sin asignar', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL),
(2, 'PDF', 'Archivo PDF', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL),
(3, 'Video', 'Archivo de video', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL),
(4, 'Imagen', 'Archivo de imagen', '2024-06-05 12:12:57', '2024-06-05 12:12:58', NULL),
(5, 'Personalizado', 'Archivo personalizado', '2024-06-05 12:12:57', '2024-06-05 12:12:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\CourseCategory', 1, '8c1498e9-d631-443e-9e8f-82489a44f39f', 'images_categories', 'lohp-category-business-v2', 'lohp-category-business-v2.jpg', 'image/jpeg', 'public', 'public', 9942, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:38', '2024-06-05 12:12:38'),
(3, 'App\\Models\\CourseCategory', 3, '3b383b58-2acb-402b-aaec-ea0731bbf99b', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:39', '2024-06-05 12:12:39'),
(4, 'App\\Models\\CourseCategory', 4, 'aa3b4c07-c0b0-4961-91c8-4459eeed75fc', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:43', '2024-06-05 12:12:43'),
(5, 'App\\Models\\CourseCategory', 5, '75faf7fc-bf1e-4342-a59d-5b961421f287', 'images_categories', 'lohp-category-music-v2', 'lohp-category-music-v2.jpg', 'image/jpeg', 'public', 'public', 11514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:43', '2024-06-05 12:12:43'),
(6, 'App\\Models\\CourseCategory', 6, '48d97dd6-cfa8-446c-94f0-e2a033cf5ec3', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:44', '2024-06-05 12:12:44'),
(7, 'App\\Models\\CourseCategory', 7, 'f556a788-094e-4463-aa50-9201cc62f640', 'images_categories', 'desarrollo', 'desarrollo.jpg', 'image/jpeg', 'public', 'public', 9616, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:45', '2024-06-05 12:12:45'),
(8, 'App\\Models\\CourseCategory', 8, '45f927b4-0863-4b54-acee-95b4358003ab', 'images_categories', 'lohp-category-personal-development-v2', 'lohp-category-personal-development-v2.jpg', 'image/jpeg', 'public', 'public', 10514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:48', '2024-06-05 12:12:48'),
(9, 'App\\Models\\CourseCategory', 9, 'fd96a22f-ad3c-4eb5-937d-0ba23dd8ac6c', 'images_categories', 'desarrollo', 'desarrollo.jpg', 'image/jpeg', 'public', 'public', 9616, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:48', '2024-06-05 12:12:48'),
(10, 'App\\Models\\CourseCategory', 10, '29abbe37-846b-48f3-9392-5f9fe12d6c7e', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:48', '2024-06-05 12:12:48'),
(11, 'App\\Models\\CourseCategory', 11, '7aefa110-2c52-43d8-9844-91ac6497ad21', 'images_categories', 'lohp-category-marketing-v2', 'lohp-category-marketing-v2.jpg', 'image/jpeg', 'public', 'public', 10282, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:48', '2024-06-05 12:12:48'),
(13, 'App\\Models\\CourseCategory', 13, 'c28b5601-802b-4675-81fe-dd517691b97a', 'images_categories', 'lohp-category-business-v2', 'lohp-category-business-v2.jpg', 'image/jpeg', 'public', 'public', 9942, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:51', '2024-06-05 12:12:51'),
(14, 'App\\Models\\CourseCategory', 14, '918787b6-cf6d-46bd-bcf1-7bd443071dff', 'images_categories', 'desarrollo', 'desarrollo.jpg', 'image/jpeg', 'public', 'public', 9616, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:51', '2024-06-05 12:12:51'),
(15, 'App\\Models\\CourseCategory', 15, '10b7cb59-d09d-4026-8d7f-61923a106d6a', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:51', '2024-06-05 12:12:51'),
(16, 'App\\Models\\CourseCategory', 16, '5bcdfd0f-70d7-4b9c-9c36-927f76e6a559', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:52', '2024-06-05 12:12:52'),
(17, 'App\\Models\\CourseCategory', 17, '3ccfb1ff-6aec-4c83-994c-238fc4fa6e83', 'images_categories', 'lohp-category-music-v2', 'lohp-category-music-v2.jpg', 'image/jpeg', 'public', 'public', 11514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:53', '2024-06-05 12:12:53'),
(18, 'App\\Models\\CourseCategory', 18, 'd4dbd768-efdd-4f5d-b8d7-0e6e3e7dafc7', 'images_categories', 'lohp-category-photography-v2', 'lohp-category-photography-v2.jpg', 'image/jpeg', 'public', 'public', 10356, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:53', '2024-06-05 12:12:53'),
(19, 'App\\Models\\CourseCategory', 19, 'e4f38ce7-3819-44b3-a131-0fa8681a89fc', 'images_categories', 'lohp-category-personal-development-v2', 'lohp-category-personal-development-v2.jpg', 'image/jpeg', 'public', 'public', 10514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:54', '2024-06-05 12:12:54'),
(20, 'App\\Models\\CourseCategory', 20, '2b64466d-93cf-4ae6-848c-a7b17ce266b2', 'images_categories', 'lohp-category-personal-development-v2', 'lohp-category-personal-development-v2.jpg', 'image/jpeg', 'public', 'public', 10514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:54', '2024-06-05 12:12:54'),
(21, 'App\\Models\\CourseCategory', 21, '6d86e64e-c988-490d-b89e-0627f219b0b1', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:54', '2024-06-05 12:12:54'),
(22, 'App\\Models\\CourseCategory', 22, 'f78e62e2-13e5-43c2-b5ab-f84efda0848b', 'images_categories', 'lohp-category-design-v2', 'lohp-category-design-v2.jpg', 'image/jpeg', 'public', 'public', 10600, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:54', '2024-06-05 12:12:54'),
(23, 'App\\Models\\CourseCategory', 23, 'a23bde50-4a30-4a85-9eea-6f052b5f019e', 'images_categories', 'lohp-category-personal-development-v2', 'lohp-category-personal-development-v2.jpg', 'image/jpeg', 'public', 'public', 10514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:54', '2024-06-05 12:12:54'),
(24, 'App\\Models\\CourseCategory', 24, '539d2056-1590-4ca6-b5ac-77ff5e90574d', 'images_categories', 'lohp-category-marketing-v2', 'lohp-category-marketing-v2.jpg', 'image/jpeg', 'public', 'public', 10282, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:55', '2024-06-05 12:12:55'),
(25, 'App\\Models\\CourseCategory', 25, 'e1c2a4d2-5f17-40d0-aff1-51ac9352342e', 'images_categories', 'lohp-category-it-and-software-v2', 'lohp-category-it-and-software-v2.jpg', 'image/jpeg', 'public', 'public', 10391, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:55', '2024-06-05 12:12:55'),
(26, 'App\\Models\\CourseCategory', 26, 'b8807317-f60d-47e3-9bf5-07066324c3af', 'images_categories', 'lohp-category-personal-development-v2', 'lohp-category-personal-development-v2.jpg', 'image/jpeg', 'public', 'public', 10514, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:12:56', '2024-06-05 12:12:56'),
(32, 'App\\Models\\Course', 5, 'f5718f93-b3da-46ba-9421-c3c32f9c2605', 'courses_images', 'laravel11', 'laravel11.jpg', 'image/jpeg', 'public', 'public', 26993, '[]', '[]', '[]', '[]', 1, '2024-06-05 12:51:38', '2024-06-05 12:51:38'),
(33, 'App\\Models\\Lesson', 1, 'b52e448a-353d-42c8-8d0f-ccaa3ef5ebd0', 'lesson_content', 'laravel11', 'laravel11.jpg', 'image/jpeg', 'public', 'public', 26993, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:29:24', '2024-06-06 05:29:24'),
(35, 'App\\Models\\Lesson', 2, '74067cba-9f1f-4afc-8c94-e7501aa3e394', 'lesson_content', 'Laravel en 5 minutos', 'Laravel-en-5-minutos.mp4', 'video/mp4', 'public', 'public', 40775949, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:31:24', '2024-06-06 05:31:24'),
(36, 'App\\Models\\Lesson', 3, '245e2fb7-681a-46ba-aec6-b0624d62a2c9', 'lesson_content', 'laravel-11-novedades-nuevas-caracteristicas', 'laravel-11-novedades-nuevas-caracteristicas.webp', 'image/webp', 'public', 'public', 29292, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:34:50', '2024-06-06 05:34:50'),
(37, 'App\\Models\\Lesson', 4, 'dfedc019-1c3d-408a-9cea-45c017728b88', 'lesson_content', 'pdfLaravel11', 'pdfLaravel11.pdf', 'application/pdf', 'public', 'public', 364184, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:42:38', '2024-06-06 05:42:38'),
(38, 'App\\Models\\Course', 6, '8372bfa1-8ffc-4777-9666-ac9802610388', 'courses_images', 'recetasdelaabuela', 'recetasdelaabuela.jpg', 'image/jpeg', 'public', 'public', 65777, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:44:18', '2024-06-06 05:44:18'),
(39, 'App\\Models\\Lesson', 5, '88959882-f007-42bf-a628-a09815caa10a', 'lesson_content', 'RecetasAbuelaVideo', 'RecetasAbuelaVideo.mp4', 'video/mp4', 'public', 'public', 41039237, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:45:21', '2024-06-06 05:45:21'),
(40, 'App\\Models\\Lesson', 6, '7546bdba-e4a3-4e00-a647-ce339d067ec6', 'lesson_content', 'abuelalogo', 'abuelalogo.jpeg', 'image/jpeg', 'public', 'public', 7458, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:47:13', '2024-06-06 05:47:13'),
(41, 'App\\Models\\Lesson', 6, 'd9231b7c-587d-400e-a6c2-499ccd48161e', 'lesson_content', 'otrasrecetaabuela', 'otrasrecetaabuela.jpg', 'image/jpeg', 'public', 'public', 55433, '[]', '[]', '[]', '[]', 2, '2024-06-06 05:48:59', '2024-06-06 05:48:59'),
(42, 'App\\Models\\Lesson', 6, '136fd6fa-7724-4b3f-8a5e-a7f8c0b4083a', 'lesson_content', 'torrijasabuela', 'torrijasabuela.jpeg', 'image/jpeg', 'public', 'public', 7976, '[]', '[]', '[]', '[]', 3, '2024-06-06 05:52:25', '2024-06-06 05:52:25'),
(43, 'App\\Models\\Lesson', 6, '3be905fe-81b4-4a1e-9010-1dad6d2d41a2', 'lesson_content', 'corderoguisadoabuelaabuela', 'corderoguisadoabuelaabuela.jpeg', 'image/jpeg', 'public', 'public', 10690, '[]', '[]', '[]', '[]', 4, '2024-06-06 05:52:45', '2024-06-06 05:52:45'),
(44, 'App\\Models\\Lesson', 6, '2983f0d6-7d59-4762-a555-f6844d8ff701', 'lesson_content', 'tartadelaabuela', 'tartadelaabuela.jpeg', 'image/jpeg', 'public', 'public', 7482, '[]', '[]', '[]', '[]', 5, '2024-06-06 05:52:55', '2024-06-06 05:52:55'),
(45, 'App\\Models\\Lesson', 6, '471cb672-0d15-46c8-8b48-dd6b50952220', 'lesson_content', 'arrozconlecheabuela', 'arrozconlecheabuela.jpeg', 'image/jpeg', 'public', 'public', 7156, '[]', '[]', '[]', '[]', 6, '2024-06-06 05:53:03', '2024-06-06 05:53:03'),
(46, 'App\\Models\\Lesson', 6, 'a5c114e0-2b66-4b65-ad12-2d2bd93b0bb3', 'lesson_content', 'albondigasabuela', 'albondigasabuela.jpeg', 'image/jpeg', 'public', 'public', 11152, '[]', '[]', '[]', '[]', 7, '2024-06-06 05:53:09', '2024-06-06 05:53:09'),
(47, 'App\\Models\\Lesson', 6, 'ac45fa48-0572-430c-a5ca-9d8f8f03080f', 'lesson_content', 'polloensalsaabuela', 'polloensalsaabuela.jpeg', 'image/jpeg', 'public', 'public', 9714, '[]', '[]', '[]', '[]', 8, '2024-06-06 05:53:17', '2024-06-06 05:53:17'),
(48, 'App\\Models\\Lesson', 6, '95c1dd27-1f9e-46ed-b783-9fd30c462bd8', 'lesson_content', 'lentejaschorizoabuela', 'lentejaschorizoabuela.jpeg', 'image/jpeg', 'public', 'public', 11173, '[]', '[]', '[]', '[]', 9, '2024-06-06 05:53:34', '2024-06-06 05:53:34'),
(49, 'App\\Models\\Lesson', 6, 'f0e08706-a925-4961-92b5-0730ab3b66fc', 'lesson_content', 'tartachcolateygalletaabuela', 'tartachcolateygalletaabuela.jpeg', 'image/jpeg', 'public', 'public', 7091, '[]', '[]', '[]', '[]', 10, '2024-06-06 05:53:45', '2024-06-06 05:53:45'),
(50, 'App\\Models\\Lesson', 7, '02d89c94-873b-4573-9a07-66b0ddafba57', 'lesson_content', 'Las Recetas de la Abuela ( PDFDrive )', 'Las-Recetas-de-la-Abuela-(-PDFDrive-).pdf', 'application/pdf', 'public', 'public', 53634414, '[]', '[]', '[]', '[]', 1, '2024-06-06 05:55:45', '2024-06-06 05:55:45'),
(51, 'App\\Models\\Course', 7, '0b63479e-a937-4d22-bb71-ba79848c3712', 'courses_images', 'cursofotografia', 'cursofotografia.jpeg', 'image/jpeg', 'public', 'public', 9767, '[]', '[]', '[]', '[]', 1, '2024-06-06 06:11:56', '2024-06-06 06:11:56'),
(52, 'App\\Models\\Course', 8, '0285ff07-e668-42b5-a2c1-9d1fd7bf12bf', 'courses_images', 'cursodeportes', 'cursodeportes.jpeg', 'image/jpeg', 'public', 'public', 12622, '[]', '[]', '[]', '[]', 1, '2024-06-06 06:15:11', '2024-06-06 06:15:11'),
(53, 'App\\Models\\Course', 9, '67e5f2fe-e8e0-4f4f-a3a2-06a2363e5e8e', 'courses_images', 'cursovideojuegos', 'cursovideojuegos.jpeg', 'image/jpeg', 'public', 'public', 12169, '[]', '[]', '[]', '[]', 1, '2024-06-06 07:42:52', '2024-06-06 07:42:52'),
(54, 'App\\Models\\Course', 10, '0668499a-104b-4b34-a1bb-2dc1548b0209', 'courses_images', 'cursotailwindcss', 'cursotailwindcss.jpg', 'image/jpeg', 'public', 'public', 49820, '[]', '[]', '[]', '[]', 1, '2024-06-06 07:54:46', '2024-06-06 07:54:46'),
(55, 'App\\Models\\Course', 11, 'cc219daa-2724-4862-86d2-e230e3815100', 'courses_images', 'cursojava', 'cursojava.png', 'image/png', 'public', 'public', 10660, '[]', '[]', '[]', '[]', 1, '2024-06-06 08:00:59', '2024-06-06 08:00:59'),
(56, 'App\\Models\\Course', 12, 'd67daf71-c1fb-41d4-bbdb-f9c28116cde4', 'courses_images', 'cursosalud', 'cursosalud.jpg', 'image/jpeg', 'public', 'public', 111808, '[]', '[]', '[]', '[]', 1, '2024-06-06 08:03:15', '2024-06-06 08:03:15'),
(57, 'App\\Models\\Course', 13, 'ac495f9f-12a0-4ccc-9dec-b56c32c3c73a', 'courses_images', 'cursopython', 'cursopython.png', 'image/png', 'public', 'public', 73042, '[]', '[]', '[]', '[]', 1, '2024-06-06 08:05:02', '2024-06-06 08:05:02'),
(58, 'App\\Models\\Course', 14, '749f4c0f-bb1d-4db8-848a-ae2a5fe814c3', 'courses_images', 'cursomatematicas', 'cursomatematicas.jpg', 'image/jpeg', 'public', 'public', 118967, '[]', '[]', '[]', '[]', 1, '2024-06-06 08:09:01', '2024-06-06 08:09:01'),
(59, 'App\\Models\\Course', 15, '9c8ac2e4-35ea-43e9-aef4-809e0e1bbb1c', 'courses_images', 'cursoingles', 'cursoingles.jpeg', 'image/jpeg', 'public', 'public', 15178, '[]', '[]', '[]', '[]', 1, '2024-06-06 08:12:19', '2024-06-06 08:12:19'),
(60, 'App\\Models\\Course', 16, 'af7595a4-e7f2-4313-91ad-a69bcbed2c6a', 'courses_images', 'cursoprogramaciondesdecero', 'cursoprogramaciondesdecero.jpeg', 'image/jpeg', 'public', 'public', 8371, '[]', '[]', '[]', '[]', 1, '2024-06-06 09:02:28', '2024-06-06 09:02:28'),
(61, 'App\\Models\\CourseCategory', 1, '2695aba9-18ba-4dd5-b9ab-83cc13bf2fbf', 'images_categories', 'desarrollo (1)', 'desarrollo-(1).jpg', 'image/jpeg', 'public', 'public', 9616, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:07:55', '2024-06-06 09:07:55'),
(62, 'App\\Models\\CourseCategory', 6, 'b244018d-ad36-4f24-9e51-e8134395225d', 'images_categories', 'cooking', 'cooking.png', 'image/png', 'public', 'public', 24421, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:10:20', '2024-06-06 09:10:20'),
(63, 'App\\Models\\CourseCategory', 8, 'd2a5a341-b72b-41f5-8c44-f32b8418ad00', 'images_categories', 'lohp-category-photography-v2 (1)', 'lohp-category-photography-v2-(1).jpg', 'image/jpeg', 'public', 'public', 10356, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:10:51', '2024-06-06 09:10:51'),
(64, 'App\\Models\\CourseCategory', 9, '25e72e7a-ce49-4f0c-9878-c0bf68cebdc4', 'images_categories', 'idiomas', 'idiomas.png', 'image/png', 'public', 'public', 3867, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:11:48', '2024-06-06 09:11:48'),
(65, 'App\\Models\\CourseCategory', 25, '7004b105-6b02-402b-8877-36332784915b', 'images_categories', 'sports', 'sports.jpg', 'image/jpeg', 'public', 'public', 90449, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:14:28', '2024-06-06 09:14:28'),
(66, 'App\\Models\\CourseCategory', 23, '9066f7c9-a79d-405f-8785-421b4474e278', 'images_categories', 'salud', 'salud.png', 'image/png', 'public', 'public', 15433, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:15:32', '2024-06-06 09:15:32'),
(67, 'App\\Models\\CourseCategory', 16, 'dcf5306f-61b8-4fdb-98be-a527c8700b4f', 'images_categories', 'lohp-category-business-v2 (1)', 'lohp-category-business-v2-(1).jpg', 'image/jpeg', 'public', 'public', 9942, '[]', '[]', '[]', '[]', 2, '2024-06-06 09:15:58', '2024-06-06 09:15:58'),
(68, 'App\\Models\\CourseCategory', 25, '5d288c4e-79bd-4dea-9d19-2fd5dd5ae407', 'images_categories', 'sports-modified', 'sports-modified.png', 'image/png', 'public', 'public', 65677, '[]', '[]', '[]', '[]', 3, '2024-06-06 09:17:12', '2024-06-06 09:17:12'),
(69, 'App\\Models\\CourseCategory', 25, 'cd88fa22-215a-4401-b2b9-6490f52591f0', 'images_categories', 'sports-modified', 'sports-modified.jpg', 'image/jpeg', 'public', 'public', 12293, '[]', '[]', '[]', '[]', 4, '2024-06-06 09:18:04', '2024-06-06 09:18:04'),
(70, 'App\\Models\\CourseCategory', 25, 'c9257ba3-1dc9-4f1c-99a5-f7968a505f52', 'images_categories', 'sports-modified', 'sports-modified.jpg', 'image/jpeg', 'public', 'public', 9016, '[]', '[]', '[]', '[]', 5, '2024-06-06 09:20:48', '2024-06-06 09:20:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_21_123355_create_users_profiles_table', 1),
(6, '2024_01_10_120511_create_lessons_types_table', 1),
(7, '2024_01_10_120618_create_courses_categories_table', 1),
(8, '2024_01_10_120726_create_users_courses_status_table', 1),
(9, '2024_01_10_120842_create_courses_table', 1),
(10, '2024_01_10_121011_create_lessons_table', 1),
(11, '2024_01_10_121012_create_user_course_progresses_table', 1),
(12, '2024_01_10_121014_create_users_courses_table', 1),
(13, '2024_01_10_121126_create_users_lessons_table', 1),
(14, '2024_01_10_124946_create_media_table', 1),
(15, '2024_01_11_073822_create_permission_tables', 1),
(16, '2024_04_24_072923_create_credit_card_types_table', 1),
(17, '2024_04_24_085219_create_billing_information_table', 1),
(18, '2024_04_24_092558_create_billing_histories_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-06-05 12:12:33', '2024-06-05 12:12:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'web', '2024-06-05 12:12:33', '2024-06-05 12:12:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'studyhub-app-admin', 'hola.studyhubapp@gmail.com', '2024-06-05 12:16:14', '$2y$12$usN05Wuusik.ne86ENuNduOfHwUbN8AE2CLsgOcInTH2Z/Cboual2', NULL, '2024-06-05 12:15:47', '2024-06-05 12:16:14', NULL),
(2, 'studyhub-app', 'studyhub-app@admin.com', '2024-06-05 12:15:47', '$2y$12$kKgdu7LyLDjwlioLMQ4NNuGeBVtQGApvDOsWPx6rw0VtaP.euDZlq', NULL, '2024-06-05 12:15:47', '2024-06-05 12:15:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_courses`
--

DROP TABLE IF EXISTS `users_courses`;
CREATE TABLE `users_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `courses_id` bigint UNSIGNED NOT NULL,
  `user_course_progresses_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_courses_status`
--

DROP TABLE IF EXISTS `users_courses_status`;
CREATE TABLE `users_courses_status` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_courses_status`
--

INSERT INTO `users_courses_status` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '¡Estréname!', 'El usuario no ha comenzado el curso.', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL),
(2, 'En progreso', 'El usuario está actualmente realizando el curso.', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL),
(3, 'Completado', 'El usuario ha completado el curso.', '2024-06-05 12:12:57', '2024-06-05 12:12:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_lessons`
--

DROP TABLE IF EXISTS `users_lessons`;
CREATE TABLE `users_lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` int NOT NULL,
  `lessons_id` bigint UNSIGNED NOT NULL,
  `users_courses_id` bigint UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_profiles`
--

DROP TABLE IF EXISTS `users_profiles`;
CREATE TABLE `users_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_surname` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `biological_gender` enum('Masculino','Femenino','Otro') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_profiles`
--

INSERT INTO `users_profiles` (`id`, `user_id`, `name`, `surname`, `second_surname`, `birthdate`, `biological_gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'StudyHub-App-AdminName', 'AdminSurname', 'AdminSecondSurname', '2024-06-05', 'Otro', '2024-06-05 12:15:47', '2024-06-05 12:15:47', NULL),
(2, 2, 'StudyHub-App', 'AcademySurname', 'AcademySecondSurname', '2024-01-01', 'Masculino', '2024-06-05 12:15:47', '2024-06-05 12:15:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_course_progresses`
--

DROP TABLE IF EXISTS `user_course_progresses`;
CREATE TABLE `user_course_progresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED DEFAULT NULL,
  `users_courses_statuses_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `billing_histories`
--
ALTER TABLE `billing_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_histories_buyer_id_foreign` (`buyer_id`),
  ADD KEY `billing_histories_billing_id_foreign` (`billing_id`),
  ADD KEY `billing_histories_course_id_foreign` (`course_id`);

--
-- Indices de la tabla `billing_information`
--
ALTER TABLE `billing_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_information_user_id_foreign` (`user_id`),
  ADD KEY `billing_information_type_id_foreign` (`type_id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_owner_id_foreign` (`owner_id`),
  ADD KEY `courses_courses_categories_id_foreign` (`courses_categories_id`);

--
-- Indices de la tabla `courses_categories`
--
ALTER TABLE `courses_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credit_card_types`
--
ALTER TABLE `credit_card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_courses_id_foreign` (`courses_id`),
  ADD KEY `lessons_lessons_types_id_foreign` (`lessons_types_id`);

--
-- Indices de la tabla `lessons_types`
--
ALTER TABLE `lessons_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_courses_users_id_foreign` (`users_id`),
  ADD KEY `users_courses_courses_id_foreign` (`courses_id`),
  ADD KEY `users_courses_user_course_progresses_id_foreign` (`user_course_progresses_id`);

--
-- Indices de la tabla `users_courses_status`
--
ALTER TABLE `users_courses_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_lessons`
--
ALTER TABLE `users_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_lessons_lessons_id_foreign` (`lessons_id`),
  ADD KEY `users_lessons_users_courses_id_foreign` (`users_courses_id`);

--
-- Indices de la tabla `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_profiles_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `user_course_progresses`
--
ALTER TABLE `user_course_progresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_course_progresses_user_id_foreign` (`user_id`),
  ADD KEY `user_course_progresses_course_id_foreign` (`course_id`),
  ADD KEY `user_course_progresses_lesson_id_foreign` (`lesson_id`),
  ADD KEY `user_course_progresses_users_courses_statuses_id_foreign` (`users_courses_statuses_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `billing_histories`
--
ALTER TABLE `billing_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `billing_information`
--
ALTER TABLE `billing_information`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `courses_categories`
--
ALTER TABLE `courses_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `credit_card_types`
--
ALTER TABLE `credit_card_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `lessons_types`
--
ALTER TABLE `lessons_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users_courses_status`
--
ALTER TABLE `users_courses_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users_lessons`
--
ALTER TABLE `users_lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users_profiles`
--
ALTER TABLE `users_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_course_progresses`
--
ALTER TABLE `user_course_progresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `billing_histories`
--
ALTER TABLE `billing_histories`
  ADD CONSTRAINT `billing_histories_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billing_information` (`id`),
  ADD CONSTRAINT `billing_histories_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billing_histories_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `billing_information`
--
ALTER TABLE `billing_information`
  ADD CONSTRAINT `billing_information_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `credit_card_types` (`id`),
  ADD CONSTRAINT `billing_information_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_courses_categories_id_foreign` FOREIGN KEY (`courses_categories_id`) REFERENCES `courses_categories` (`id`),
  ADD CONSTRAINT `courses_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_lessons_types_id_foreign` FOREIGN KEY (`lessons_types_id`) REFERENCES `lessons_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_courses`
--
ALTER TABLE `users_courses`
  ADD CONSTRAINT `users_courses_courses_id_foreign` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_courses_user_course_progresses_id_foreign` FOREIGN KEY (`user_course_progresses_id`) REFERENCES `user_course_progresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_courses_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users_lessons`
--
ALTER TABLE `users_lessons`
  ADD CONSTRAINT `users_lessons_lessons_id_foreign` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_lessons_users_courses_id_foreign` FOREIGN KEY (`users_courses_id`) REFERENCES `users_courses` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD CONSTRAINT `users_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_course_progresses`
--
ALTER TABLE `user_course_progresses`
  ADD CONSTRAINT `user_course_progresses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_course_progresses_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_course_progresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_course_progresses_users_courses_statuses_id_foreign` FOREIGN KEY (`users_courses_statuses_id`) REFERENCES `users_courses_status` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
