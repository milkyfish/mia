-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 16 2016 г., 05:45
-- Версия сервера: 5.6.26
-- Версия PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mia_build`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mia_errors`
--

CREATE TABLE IF NOT EXISTS `mia_errors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `time_created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mia_modules`
--

CREATE TABLE IF NOT EXISTS `mia_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `version` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `mia_settings`
--

CREATE TABLE IF NOT EXISTS `mia_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `mia_settings`
--

INSERT INTO `mia_settings` (`id`, `group_id`, `name`, `value`) VALUES
(1, 0, 'projectName', 'MiA'),
(2, 0, 'projectDescription', ''),
(3, 0, 'projectRobots', 'all'),
(4, 0, 'projectCharset', 'utf-8'),
(5, 0, 'cssLibraries', 'style.css'),
(6, 1, 'isActive', '1'),
(7, 1, 'inActiveMessage', 'Сайт в данный момент отключен. Пожалуйста, загляните позже.'),
(8, 0, 'jQueryLibrary', '1'),
(9, 999, 'coreVersion', '1.0.0 - Alpha1'),
(10, 999, 'notes', 'Это доска заметок, но она пока не работает :(');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
