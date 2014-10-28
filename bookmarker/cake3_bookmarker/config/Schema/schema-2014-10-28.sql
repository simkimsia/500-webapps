# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.38-0ubuntu0.14.04.1)
# Database: cake3_bookmarker
# Generation Time: 2014-10-28 09:39:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bookmarks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookmarks`;

CREATE TABLE `bookmarks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `url` text,
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_key` (`user_id`),
  CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;

INSERT INTO `bookmarks` (`id`, `user_id`, `title`, `description`, `url`, `public`, `created`, `updated`)
VALUES
	(2,1,'test','test','test',1,'2014-10-24 04:31:27',NULL),
	(3,1,'test again','','',1,'2014-10-24 04:34:58',NULL),
	(4,1,'test','','',1,'2014-10-24 04:36:28',NULL),
	(5,1,'a','','',1,'2014-10-24 04:38:17',NULL),
	(6,1,'a','','',1,'2014-10-24 04:43:28',NULL),
	(7,1,'test','','',1,'2014-10-25 08:27:59',NULL),
	(8,1,'test','test','1',1,'2014-10-25 08:29:28',NULL);

/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bookmarks_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookmarks_tags`;

CREATE TABLE `bookmarks_tags` (
  `bookmark_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bookmark_id`,`tag_id`),
  KEY `tag_idx` (`bookmark_id`,`tag_id`),
  KEY `tag_key` (`tag_id`),
  CONSTRAINT `bookmark_key` FOREIGN KEY (`bookmark_id`) REFERENCES `bookmarks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tag_key` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bookmarks_tags` WRITE;
/*!40000 ALTER TABLE `bookmarks_tags` DISABLE KEYS */;

INSERT INTO `bookmarks_tags` (`bookmark_id`, `tag_id`)
VALUES
	(8,1),
	(8,2),
	(8,3);

/*!40000 ALTER TABLE `bookmarks_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table phinxlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `phinxlog`;

CREATE TABLE `phinxlog` (
  `version` bigint(14) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;

INSERT INTO `phinxlog` (`version`, `start_time`, `end_time`)
VALUES
	(20141028090710,'2014-10-28 09:14:54','2014-10-28 09:14:54');

/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `title`, `created`, `updated`)
VALUES
	(1,'1','2014-10-25 08:29:28',NULL),
	(2,'2','2014-10-25 08:29:28',NULL),
	(3,'abc','2014-10-25 08:29:28',NULL);

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created`, `modified`)
VALUES
	(1,'admin','admin@500webapps.com','$2y$10$RxaW7HEch.mk9DNuOg6ljuui8HzoJibx55YKAsKEEVg4Ogdet0kha','admin','2014-10-19 14:35:14','2014-10-19 14:35:14'),
	(2,'Timmy','Timmy@500webapps.com','$2y$10$/Qm1DSmaL9h9sB5.V/fAU.LZgFMc1u3wrxKmdnq/K5D9UpTGiWzBu','author','2014-10-19 15:04:22','2014-10-19 15:05:42'),
	(3,'Sally','Sally@500webapps.com','$2y$10$kiJJ1g6gSa8lVSS/bY14u.NNhZdf88v3LIc1ME9A8us.P44KkeMKS','author','2014-10-19 15:05:23','2014-10-19 15:05:23');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
