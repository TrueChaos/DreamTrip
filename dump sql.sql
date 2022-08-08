-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2022 г., 08:21
-- Версия сервера: 8.0.24
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dreamtrip`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `season_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `c_name`, `season_id`) VALUES
(1, 'ski', 1),
(2, 'alp', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(20) DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `tour_id`, `category_id`, `user_id`, `status`) VALUES
(1, 2, 1, 2, 'reject'),
(2, 2, NULL, 2, 'waiting'),
(3, 2, NULL, 2, 'accept'),
(4, 2, NULL, 2, 'accept'),
(5, 2, NULL, 1, 'reject'),
(6, 2, NULL, 1, 'accept'),
(7, 2, NULL, 1, 'waiting'),
(8, 2, NULL, 1, 'waiting'),
(9, 2, NULL, 1, 'waiting'),
(10, 2, NULL, 1, 'waiting'),
(11, 2, NULL, 1, 'waiting'),
(12, 2, NULL, 1, 'waiting'),
(13, 2, NULL, 1, 'waiting'),
(14, 1, NULL, 2, 'waiting'),
(15, 1, NULL, 2, 'waiting'),
(16, 1, NULL, 1, 'waiting'),
(17, 1, NULL, 1, 'waiting'),
(18, 3, NULL, 1, 'waiting'),
(19, 1, NULL, 3, 'waiting'),
(20, 1, NULL, 4, 'waiting'),
(21, 1, NULL, 1, 'waiting');

-- --------------------------------------------------------

--
-- Структура таблицы `seasons`
--

CREATE TABLE `seasons` (
  `id` int NOT NULL,
  `s_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `seasons`
--

INSERT INTO `seasons` (`id`, `s_name`) VALUES
(1, 'winter'),
(2, 'spring'),
(3, 'summer'),
(4, 'autumn');

-- --------------------------------------------------------

--
-- Структура таблицы `tours`
--

CREATE TABLE `tours` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `t_name` varchar(40) DEFAULT NULL,
  `date` varchar(60) DEFAULT NULL,
  `descr` mediumtext,
  `price` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tours`
--

INSERT INTO `tours` (`id`, `category_id`, `image`, `t_name`, `date`, `descr`, `price`) VALUES
(1, 1, 'images/xibini.jpg', 'Хибины', '9 - 13 февраля', 'Неделя за полярным кругом, в сопровождении<br>опытных организаторов<br>Северное сияние\n              Множество трасс и склонов<br>\n              И что то ещё интересное', '32000р'),
(2, 1, 'images/sher.jpg', 'Шерегеш', '14 - 20 февраля', 'Самые большие склоны в мире<br>Атмосфера Сибири<br>Красотища<br>И что то ещё интересное', '66000р'),
(3, 2, 'images/everest.jpg', 'Эверест', '20 - 29 февраля', '5000 метров над уровнем моря<br>Заберись на Эверест<br>Красотища<br>Постарайся не упасть', '22000р');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@mail.ru', '$2y$10$vyyQ6i/4JiCFMsjn6dcN9ew2zitwrnzHSXtqctxuQ3K2TJ5iQTWbq', 'admin'),
(2, 'Мага', 'maga@mail.ru', '$2y$10$bOTanWku8.9mHd9k8UUqSO6gjSyfmmhaQpydY16OD1mT9E7e2hwWu', 'guest'),
(3, 'anton', 'one@mail.ru', '$2y$10$06mSs4txZogj1pMKYrJ3OOtdfSKTaMFBgFVNJCKR7.J5hWwze3hQ6', 'guest'),
(4, 'jackt the ripper', 'jaja@gmail.com', '$2y$10$BkNAE2hLZ1xXV.aJWrHNcuF2HRqWzL1qSpARiUNrrS5sSs2WeABDm', 'guest');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
