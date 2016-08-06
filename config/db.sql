-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.13 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица bj.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы bj.comments: ~3 rows (приблизительно)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `author`, `content`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Иван Иванов', 'Повседневная практика показывает, что реализация намеченных плановых заданий требуют от нас анализа новых предложений. Задача организации, в особенности же начало повседневной работы по формированию позиции требуют определения и уточнения новых предложений. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности требуют определения и уточнения форм развития. Задача организации, в особенности же укрепление и развитие структуры требуют определения и уточнения систем массового участия. С другой стороны рамки и место обучения кадров требуют от нас анализа дальнейших направлений развития.', NULL, NULL, NULL, NULL),
	(2, 'Сергей Сергеев', 'Идейные соображения высшего порядка, а также консультация с широким активом способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям. С другой стороны начало повседневной работы по формированию позиции влечет за собой процесс внедрения и модернизации соответствующий условий активизации.', NULL, NULL, NULL, NULL),
	(3, 'Борис Борисов', 'Равным образом консультация с широким активом обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития. Равным образом начало повседневной работы по формированию позиции позволяет оценить значение новых предложений. Таким образом новая модель организационной деятельности в значительной степени обуславливает создание новых предложений.', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
