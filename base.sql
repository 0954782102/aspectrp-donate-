-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 03 2019 г., 19:40
-- Версия сервера: 5.6.38
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- База данных: `empirerp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_admin`
--

CREATE TABLE `ucp_admin` (
  `a_id` int(11) NOT NULL,
  `a_admin` varchar(24) NOT NULL,
  `a_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ucp_admin`
--

INSERT INTO `ucp_admin` (`a_id`, `a_admin`, `a_pass`) VALUES
(1, 'Admin', '123q123');

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_category_roulette`
--

CREATE TABLE `ucp_category_roulette` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ucp_category_roulette`
--

INSERT INTO `ucp_category_roulette` (`id`, `name`) VALUES
(1, 'Деньги'),
(2, 'Донат'),
(3, 'Авто'),
(4, 'Одежда'),
(5, 'Очки EXP'),
(6, 'Деньги x2');

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_drop_roulette`
--

CREATE TABLE `ucp_drop_roulette` (
  `p_number` int(11) NOT NULL,
  `p_user` varchar(24) NOT NULL DEFAULT '-',
  `p_data` varchar(50) NOT NULL DEFAULT '-',
  `p_value` int(11) NOT NULL DEFAULT '1',
  `p_id` int(11) NOT NULL DEFAULT '1',
  `p_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `ucp_drop_roulette`
--

INSERT INTO `ucp_drop_roulette` (`p_number`, `p_user`, `p_data`, `p_value`, `p_id`, `p_status`) VALUES
(1, 'Brandon_Ghost', '02.02.2019 03:00', 5, 5, 0),
(2, 'Brandon_Ghost', '02.02.2019 03:00', 76823, 1, 0),
(3, 'Brandon_Ghost', '02.02.2019 03:06', 297, 4, 0),
(4, 'Brandon_Ghost', '02.02.2019 03:07', 42924, 1, 0),
(5, 'Brandon_Ghost', '02.02.2019 03:07', 46, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_item_roulette`
--

CREATE TABLE `ucp_item_roulette` (
  `id` int(11) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_images` text NOT NULL,
  `i_category` int(11) NOT NULL,
  `i_change` int(11) NOT NULL,
  `i_start_rand` int(11) NOT NULL,
  `i_end_rand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ucp_item_roulette`
--

INSERT INTO `ucp_item_roulette` (`id`, `i_name`, `i_images`, `i_category`, `i_change`, `i_start_rand`, `i_end_rand`) VALUES
(1, 'Деньги', '/public/main/img/roulette/money.png', 1, 100, 10000, 100000),
(2, 'Infernus', '/public/main/img/roulette/car411.png', 3, 4, 411, 411),
(3, 'Скин #46', '/public/main/img/roulette/skin46.png', 4, 45, 46, 46),
(4, 'Донат', '/public/main/img/roulette/donate.png', 2, 50, 20, 100),
(5, 'Скин #294', '/public/main/img/roulette/skin294.png', 4, 40, 294, 294),
(6, 'Buffalo', '/public/main/img/roulette/car402.png', 3, 10, 402, 402),
(7, 'Скин #5', '/public/main/img/roulette/skin5.png', 4, 42, 5, 5),
(8, 'Очки EXP', '/public/main/img/roulette/time.png', 5, 70, 2, 5),
(9, 'Bobcat', '/public/main/img/roulette/car422.png', 3, 10, 422, 422),
(10, 'Скин #297', '/public/main/img/roulette/skin297.png', 4, 44, 297, 297),
(11, 'Cheetah', '/public/main/img/roulette/car415.png', 3, 8, 415, 415),
(12, 'Скин #299', '/public/main/img/roulette/skin299.png', 4, 39, 299, 299),
(13, 'Bullet', '/public/main/img/roulette/car541.png', 3, 5, 541, 541),
(14, 'BF Injection', '/public/main/img/roulette/car424.png', 3, 10, 424, 424),
(15, 'Super GT', '/public/main/img/roulette/car506.png', 3, 7, 506, 506);

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_news`
--

CREATE TABLE `ucp_news` (
  `n_id` int(11) NOT NULL,
  `n_title` varchar(150) NOT NULL,
  `n_text` text NOT NULL,
  `n_data` varchar(50) NOT NULL,
  `n_images` text NOT NULL,
  `n_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `ucp_settings`
--

CREATE TABLE `ucp_settings` (
  `s_title` text NOT NULL,
  `s_favicon` text NOT NULL,
  `s_logo` text NOT NULL,
  `s_md5` int(11) NOT NULL DEFAULT '0',
  `s_donate_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ucp_settings`
--

INSERT INTO `ucp_settings` (`s_title`, `s_favicon`, `s_logo`, `s_md5`, `s_donate_cost`) VALUES
('Name Project', '/public/main/img/logos.png', '/public/main/img/logo.png', 1, 200);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ucp_admin`
--
ALTER TABLE `ucp_admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Индексы таблицы `ucp_category_roulette`
--
ALTER TABLE `ucp_category_roulette`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ucp_drop_roulette`
--
ALTER TABLE `ucp_drop_roulette`
  ADD PRIMARY KEY (`p_number`);

--
-- Индексы таблицы `ucp_item_roulette`
--
ALTER TABLE `ucp_item_roulette`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ucp_news`
--
ALTER TABLE `ucp_news`
  ADD PRIMARY KEY (`n_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ucp_admin`
--
ALTER TABLE `ucp_admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ucp_category_roulette`
--
ALTER TABLE `ucp_category_roulette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `ucp_drop_roulette`
--
ALTER TABLE `ucp_drop_roulette`
  MODIFY `p_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `ucp_item_roulette`
--
ALTER TABLE `ucp_item_roulette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `ucp_news`
--
ALTER TABLE `ucp_news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
