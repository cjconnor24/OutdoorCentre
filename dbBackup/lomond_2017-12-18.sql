# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.18)
# Database: lomond
# Generation Time: 2017-12-18 00:06:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `name`)
VALUES
	(5,'Canoeing'),
	(6,'Kayaking'),
	(7,'Climbing'),
	(8,'Hill Walking');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table enquiry
# ------------------------------------------------------------

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `telephone` varchar(20) DEFAULT NULL,
  `activity` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `activity` (`activity`),
  CONSTRAINT `enquiry_ibfk_1` FOREIGN KEY (`activity`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

LOCK TABLES `enquiry` WRITE;
/*!40000 ALTER TABLE `enquiry` DISABLE KEYS */;

INSERT INTO `enquiry` (`id`, `name`, `email`, `telephone`, `activity`, `message`, `created_at`)
VALUES
	(31,'Chris Connor','chris@connor.com','0141 123 1234',8,'asdasdasd','2017-12-17 20:00:29'),
	(32,'Peter Parker','peter@parker.com','',5,'asdasdasd','2017-12-17 20:00:43'),
	(33,'Francine O\'Rourke','frankieo@gmail.com','01236 731260',7,'Hi there,\r\n\r\nI hope this email finds you well.\r\n\r\nI just wanted to check if you had any availability for the next two weeks.\r\n\r\nIf so, please do let me know.\r\n\r\nKind Regards,\r\nFrankie O\'Rourke','2017-12-17 20:28:55'),
	(34,'Tommy Berry','tommyberry@hotmail.com','0141 1234567',8,'Hi There,\r\n\r\nCan you tell me about hill walking.\r\n\r\nThanks,\r\nChris','2017-12-17 23:52:56');

/*!40000 ALTER TABLE `enquiry` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table newsletter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE `newsletter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;

INSERT INTO `newsletter` (`id`, `email`, `datetime`)
VALUES
	(35,'michelleconnor227@gmail.com','2017-12-17 13:36:10'),
	(36,'asdasd@asdasda.com','2017-12-17 13:38:29'),
	(37,'anewone.cjconnor24@gmail.com','2017-12-17 13:38:41'),
	(38,'sadasdas@asdasd.com','2017-12-17 13:38:57'),
	(39,'asdasd@asdoiashdoi.com','2017-12-17 14:16:25'),
	(40,'chris@chrisconnor.co.uk','2017-12-17 19:40:31'),
	(41,'chris@connor.com','2017-12-17 20:00:29'),
	(42,'frankieo@gmail.com','2017-12-17 20:28:55'),
	(43,'tommyberry@hotmail.com','2017-12-17 23:52:25');

/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table response
# ------------------------------------------------------------

DROP TABLE IF EXISTS `response`;

CREATE TABLE `response` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `enquiry` int(11) unsigned NOT NULL,
  `user` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `enquiry` (`enquiry`),
  CONSTRAINT `response_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  CONSTRAINT `response_ibfk_2` FOREIGN KEY (`enquiry`) REFERENCES `enquiry` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `response` WRITE;
/*!40000 ALTER TABLE `response` DISABLE KEYS */;

INSERT INTO `response` (`id`, `message`, `enquiry`, `user`, `created_at`)
VALUES
	(13,'How would that work, actually?',32,1,'2017-12-17 23:23:48'),
	(14,'Hi Chris,\r\n\r\nThank you for that enquiry - mcuh appreciated.\r\n\r\nKind Regards,\r\nChris COnnor',31,1,'2017-12-17 23:34:49'),
	(15,'Hi Francie,\r\n\r\nYes, we do have climbing availability - if you would like to check that, you can do so here.\r\n\r\nKind Regards,\r\nChris Connor',33,1,'2017-12-17 23:35:41'),
	(16,'Thanks for your message tommy.\r\n\r\nBlah blah hill walking.',34,1,'2017-12-17 23:53:24');

/*!40000 ALTER TABLE `response` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(65) NOT NULL DEFAULT '',
  `lname` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `last_signin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `last_signin`)
VALUES
	(1,'Chris','Connor','chris@chrisconnor.co.uk','password',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
