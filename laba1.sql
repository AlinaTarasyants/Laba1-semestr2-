-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 24 2021 г., 18:10
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laba1`
--
CREATE DATABASE IF NOT EXISTS `laba1` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_cs;
USE `laba1`;

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `game` (
  `Id` int(11) NOT NULL,
  `DAT` date DEFAULT NULL,
  `PLACE` varchar(35) COLLATE cp1251_general_cs DEFAULT NULL,
  `SCORE` varchar(10) COLLATE cp1251_general_cs DEFAULT NULL,
  `FID_TEAM1` int(11) DEFAULT NULL,
  `FID_TEAM2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`Id`, `DAT`, `PLACE`, `SCORE`, `FID_TEAM1`, `FID_TEAM2`) VALUES
(1, '2020-12-14', 'Мадрид', '3:1', 1, 2),
(2, '2020-12-15', 'Мадрид', '1:1', 2, 3),
(3, '2020-12-21', 'Барселона', '0:2', 1, 3),
(4, '2020-12-07', 'Турин', '5:1', 4, 6),
(5, '2020-12-16', 'Милан', '0:1', 5, 6),
(6, '2021-03-28', 'Турин', NULL, 4, 5),
(7, '2020-12-26', 'Лондон', '3:3', 7, 8),
(8, '2021-02-15', 'Манчестер', '1:2', 7, 8),
(9, '2021-04-01', 'Лондон', NULL, 7, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `player`
--

CREATE TABLE `player` (
  `Id` int(11) NOT NULL,
  `NAME` varchar(35) COLLATE cp1251_general_cs DEFAULT NULL,
  `FID_TEAM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs;

--
-- Дамп данных таблицы `player`
--

INSERT INTO `player` (`Id`, `NAME`, `FID_TEAM`) VALUES
(1, 'Лионель Месси', 1),
(2, 'Карим Бензема', 2),
(3, 'Коке', 3),
(4, 'Криштиану Роналду', 4),
(5, 'Ромелу Лукаку', 5),
(6, 'Златан Ибрагимович', 6),
(7, 'Серхио Агуэро', 7),
(8, 'Рахим Стерлинг', 7),
(9, 'Оливье Жиру', 8),
(10, 'Марио Манджукич', 6),
(11, 'Тео Эрнандес', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `team`
--

CREATE TABLE `team` (
  `Id` int(11) NOT NULL,
  `TNAME` varchar(35) COLLATE cp1251_general_cs DEFAULT NULL,
  `LEAGUE` varchar(35) COLLATE cp1251_general_cs DEFAULT NULL,
  `COACH` varchar(35) COLLATE cp1251_general_cs DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251 COLLATE=cp1251_general_cs;

--
-- Дамп данных таблицы `team`
--

INSERT INTO `team` (`Id`, `TNAME`, `LEAGUE`, `COACH`) VALUES
(1, 'Барселона', 'Ла Лига', 'Рональд Куман'),
(2, 'Реал Мадрид', 'Ла Лига', 'Зинедин Зидан'),
(3, 'Атлетико Мадрид', 'Ла Лига', 'Диего Симеоне'),
(4, 'Ювентус', 'Серия А', 'Андреа Пирло'),
(5, 'Интер', 'Серия А', 'Антонио Конте'),
(6, 'Милан', 'Серия А', 'Стефано Пиоли'),
(7, 'Манчестер Сити', 'АПЛ', 'Хосеп Гвардиола'),
(8, 'Челси', 'АПЛ', 'Томас Тухель');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_TM1` (`FID_TEAM1`),
  ADD KEY `FK_TM2` (`FID_TEAM2`);

--
-- Индексы таблицы `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_TM` (`FID_TEAM`);

--
-- Индексы таблицы `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `player`
--
ALTER TABLE `player`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `team`
--
ALTER TABLE `team`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `FK_TM1` FOREIGN KEY (`FID_TEAM1`) REFERENCES `team` (`Id`),
  ADD CONSTRAINT `FK_TM2` FOREIGN KEY (`FID_TEAM2`) REFERENCES `team` (`Id`);

--
-- Ограничения внешнего ключа таблицы `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `FK_TM` FOREIGN KEY (`FID_TEAM`) REFERENCES `team` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
