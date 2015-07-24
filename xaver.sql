-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `xaver`;
CREATE DATABASE `xaver` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `xaver`;

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` tinyint(2) NOT NULL,
  `seller_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `allow_mails` tinyint(1) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `city` varchar(30) NOT NULL,
  `metro` varchar(30) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` mediumint(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `adverts` (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `city`, `metro`, `category_id`, `title`, `description`, `price`) VALUES
(220,	0,	'asdf',	'asdf@asdf.asdf',	0,	'123',	'',	'0',	'',	'321',	'321',	321),
(222,	0,	'52354',	'',	0,	'52354',	'',	'0',	'',	'444',	'444',	444),
(281,	1,	'Tree humble',	'gdsg@aeg.asdf',	1,	'325',	'',	'',	'',	'shikshashtaka 3',	'trinad api sunuchena',	3),
(282,	0,	'',	'',	0,	'',	'',	'',	'',	'',	'',	0);

DROP TABLE IF EXISTS `select_meta`;
CREATE TABLE `select_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `label` varchar(20) NOT NULL,
  `options` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `select_meta` (`id`, `name`, `label`, `options`) VALUES
(1,	'city',	'Город',	'{\"\":\"Выберите город\",\"64\":\"Маяпур\", \"16108\":\"Пури\", \"108\":\"Вриндаван\"}'),
(2,	'metro',	'Метро',	'[\"Выберите станцию\",\"Deli-Aeropor\", \"Jabo\", \"Haribo\"]'),
(3,	'Categorys',	'Категории',	'{\"\":\"Выберите категорию\",\"Спорт\":{\"6\":\"Гольф\",\"9\":\"Крикет\",\"7\":\"Плавание\"},\"Отдых\":{\"3\":\"Сауна\",\"1\":\"Массаж\"}}');

-- 2015-07-24 14:49:04
