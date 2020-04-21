-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 25 2018 г., 03:29
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tourcompany`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `idcart` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL,
  `tour_idtour` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`idcart`, `user_iduser`, `tour_idtour`, `status`) VALUES
(1, 1, 1, 'active'),
(2, 1, 2, 'active'),
(3, 1, 3, 'hidder'),
(4, 1, 4, 'hidder'),
(5, 2, 1, 'active'),
(6, 2, 3, 'active'),
(7, 2, 3, 'hidden'),
(8, 2, 3, 'hidden'),
(9, 2, 2, 'active'),
(10, 2, 1, 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `namecategory` varchar(45) DEFAULT NULL,
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`idcategory`, `namecategory`, `description`) VALUES
(1, 'Категория 1', 'Описание категории 1'),
(2, 'Категория 2', 'Описание категории 2'),
(3, 'Категория 4', 'Описание категории 4');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `idorder` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cart_idcart` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`idorder`, `date`, `cart_idcart`, `status`) VALUES
(1, '2018-04-25 11:19:17', 3, NULL),
(2, '2018-04-24 03:31:20', 1, NULL),
(3, '2018-04-24 21:38:13', 2, NULL),
(4, '2018-04-24 21:42:58', 4, NULL),
(5, '2018-04-24 22:13:20', 5, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`idrole`, `role`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `tour`
--

CREATE TABLE `tour` (
  `idtour` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` mediumtext,
  `category_idcategory` int(11) NOT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tour`
--

INSERT INTO `tour` (`idtour`, `name`, `description`, `category_idcategory`, `cost`, `img`) VALUES
(1, 'Тур 1', 'Описание тура 1', 1, '20000', NULL),
(2, 'Тур 2', 'Описание тура 2', 2, '15000', NULL),
(3, 'Тур 3', 'Описание тура 3', 2, '18000', NULL),
(4, 'Тур 4', 'Описание тура 4', 3, '17500', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `usersecondname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role_idrole` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`iduser`, `email`, `username`, `usersecondname`, `password`, `role_idrole`, `status`) VALUES
(1, 'superuser@mail.ru', 'SuperAdimn', 'Administrator', 'caf06c40d164c29db016e27f81524b04', 1, 1),
(2, 'user22@mail.ru', 'Иван', 'Иванов', '3b94f20934ca73fa9f558887161500f6', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD KEY `fk_cart_user1_idx` (`user_iduser`),
  ADD KEY `fk_cart_tour1_idx` (`tour_idtour`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `fk_order_cart1_idx` (`cart_idcart`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Индексы таблицы `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`idtour`),
  ADD KEY `fk_tour_category1_idx` (`category_idcategory`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_user_role1_idx` (`role_idrole`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tour`
--
ALTER TABLE `tour`
  MODIFY `idtour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_tour1` FOREIGN KEY (`tour_idtour`) REFERENCES `tour` (`idtour`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_cart1` FOREIGN KEY (`cart_idcart`) REFERENCES `cart` (`idcart`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `fk_tour_category1` FOREIGN KEY (`category_idcategory`) REFERENCES `category` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_idrole`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
