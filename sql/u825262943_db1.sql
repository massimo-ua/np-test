
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Лис 03 2016 р., 21:21
-- Версія сервера: 10.0.20-MariaDB
-- Версія PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `u825262943_db1`
--

-- --------------------------------------------------------

--
-- Структура таблиці `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sda` date NOT NULL,
  `eda` date NOT NULL,
  `res` int(11) NOT NULL,
  `et` decimal(7,5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп даних таблиці `log`
--

INSERT INTO `log` (`id`, `ip`, `sda`, `eda`, `res`, `et`) VALUES
(1, '176.37.71.10', '2016-10-12', '2016-10-17', 5, '0.00013'),
(2, '176.37.71.10', '2016-10-12', '2016-10-17', 5, '0.00012'),
(3, '176.37.71.10', '2016-10-11', '2016-11-05', 25, '0.00018'),
(4, '176.37.71.10', '2016-10-11', '2016-10-15', 4, '0.00014'),
(5, '176.37.71.10', '2016-11-02', '2016-11-05', 3, '0.00012'),
(6, '176.37.71.10', '2016-10-11', '2016-10-15', 4, '0.00015'),
(7, '176.37.71.10', '2016-10-01', '2016-10-07', 6, '0.00012');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
