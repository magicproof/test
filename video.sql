-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных Video
CREATE DATABASE IF NOT EXISTS `video` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `Video`;


-- Дамп структуры для таблица Video.info
CREATE TABLE IF NOT EXISTS `info` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `subtitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы Video.info: ~71 rows (приблизительно)
/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` (`id`, `subtitle`) VALUES
	(1, 'newtagman'),
	(2, 'gfd'),
	(3, 'jhj'),
	(4, 'coll'),
	(5, 'man'),
	(6, '1'),
	(7, 'fuck'),
	(8, 'fy'),
	(9, 'matrix'),
	(10, 'ui'),
	(11, 'khj'),
	(12, 'hfg'),
	(13, 'lkl'),
	(14, 'kjhkh'),
	(15, 'jgh'),
	(16, 'ljkl;jkl'),
	(17, 'khjkh'),
	(18, 'ljklkj'),
	(19, 'khjkhj'),
	(20, 'jg'),
	(21, 'jgkjh'),
	(22, '\'ghh'),
	(23, 'ihji'),
	(24, 'jkhjkh'),
	(25, 'ljkl'),
	(26, '\'\'g'),
	(27, 'piopio'),
	(28, 'lg689j'),
	(29, 'lkjlkj'),
	(30, 'lf67jk'),
	(31, 'khjh'),
	(32, 'khjk'),
	(33, 'kjh'),
	(34, 'lkjlkjl;'),
	(35, 'iuyiuy'),
	(36, 'kldfy4y46h'),
	(37, 'ljkklh'),
	(38, 'kjhf'),
	(39, 'jhjfgd'),
	(40, 'hgfhf'),
	(41, 'l5'),
	(42, 'khjlh'),
	(43, 'lkj5'),
	(44, 'oki'),
	(45, '.vghg'),
	(46, 'iljkl'),
	(47, 'ljklj'),
	(48, 'tag'),
	(49, 'k5'),
	(50, 'iyu'),
	(51, 'khk'),
	(52, 'jghjg'),
	(53, 'bcvbcv'),
	(54, 'newtag'),
	(55, '6'),
	(57, '45'),
	(58, 'qqq'),
	(59, 'tg'),
	(60, 'zzzzzzzzzzzzz'),
	(61, 'wwwwwwww'),
	(64, 'newmaxtag'),
	(66, 'zzzzzzzzzzz'),
	(71, 'fsd'),
	(72, 'gfg'),
	(73, 'fgf'),
	(74, '111'),
	(76, '11'),
	(77, 'dsad'),
	(78, 'aaa'),
	(80, 'new'),
	(81, 'aaaaa');
/*!40000 ALTER TABLE `info` ENABLE KEYS */;


-- Дамп структуры для таблица Video.relations
CREATE TABLE IF NOT EXISTS `relations` (
  `info_id` int(4) unsigned DEFAULT NULL,
  `video_id` int(4) unsigned DEFAULT NULL,
  KEY `FK__users` (`info_id`),
  KEY `FK__tags` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы Video.relations: ~18 rows (приблизительно)
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
INSERT INTO `relations` (`info_id`, `video_id`) VALUES
	(31, 44),
	(31, 66),
	(1, 35),
	(26, 59),
	(58, 80),
	(58, 81),
	(31, 44),
	(31, 66),
	(31, 64),
	(26, 59),
	(58, 80),
	(58, 81),
	(31, 44),
	(31, 66),
	(31, 64),
	(26, 59),
	(58, 80),
	(58, 81);
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;


-- Дамп структуры для таблица Video.video
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы Video.video: ~37 rows (приблизительно)
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` (`id`, `name`) VALUES
	(16, 'lkjl'),
	(19, 'ljkl'),
	(23, 'jghjg'),
	(25, 'fdsf'),
	(26, 'klkl'),
	(31, 'maksim'),
	(32, 'hfghfg'),
	(33, 'jjj'),
	(35, 'lappo'),
	(38, 'roll'),
	(39, 'hfg'),
	(41, 'Vadim'),
	(57, 'alexman1'),
	(58, 'aaa'),
	(67, 'fdf'),
	(118, 'AndreySuper'),
	(150, 'AndreySuper'),
	(157, 'Andrey'),
	(160, 'AndreySuper'),
	(167, 'Andreys'),
	(170, 'AndreySuper'),
	(175, 'Andreys'),
	(176, 'Andreys'),
	(177, 'Andreys'),
	(181, 'magic'),
	(182, 'magicproof'),
	(183, 'magicproof'),
	(184, 'magicproof'),
	(185, 'Andreys'),
	(187, 'magicproof'),
	(188, '1111'),
	(189, '222'),
	(190, '33'),
	(191, '444'),
	(192, 're'),
	(193, '22'),
	(194, '3333');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
