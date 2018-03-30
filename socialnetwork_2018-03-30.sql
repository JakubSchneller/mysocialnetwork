# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: socialnetwork
# Generation Time: 2018-03-30 17:16:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;

INSERT INTO `friends` (`id`, `user_id`, `friend_id`)
VALUES
	(26,53,56);

/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `post_id`, `user_id`)
VALUES
	(7,10,56),
	(8,47,56),
	(9,10,57),
	(10,11,60);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes_shared
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes_shared`;

CREATE TABLE `likes_shared` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shared_post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `likes_shared` WRITE;
/*!40000 ALTER TABLE `likes_shared` DISABLE KEYS */;

INSERT INTO `likes_shared` (`id`, `post_id`, `user_id`, `shared_post_id`)
VALUES
	(7,10,53,52),
	(8,10,53,51),
	(9,10,60,51),
	(10,11,53,52),
	(11,11,60,53);

/*!40000 ALTER TABLE `likes_shared` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_creator` varchar(100) NOT NULL DEFAULT '',
  `post_date` datetime NOT NULL,
  `post_content` varchar(9999) NOT NULL DEFAULT '',
  `post_creator_id` int(11) NOT NULL,
  `post_creator_image` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`post_id`, `post_creator`, `post_date`, `post_content`, `post_creator_id`, `post_creator_image`)
VALUES
	(10,'owner','2018-03-17 21:35:38','Ahoj, cítím se dobře co vy',53,'images/w12w235jarb4n3b.jpg'),
	(11,'petr','2018-03-18 10:00:39','Ahoj lidičky',56,'images/5fblkpkynl7z32s.png');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts_shared
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_shared`;

CREATE TABLE `posts_shared` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `post_creator` varchar(100) NOT NULL DEFAULT '',
  `post_sharer` varchar(100) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_shareddate` datetime NOT NULL,
  `post_content` varchar(9999) NOT NULL DEFAULT '',
  `post_creator_id` int(11) NOT NULL,
  `post_sharer_id` int(11) NOT NULL,
  `post_creator_image` varchar(128) NOT NULL DEFAULT '',
  `post_sharer_image` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts_shared` WRITE;
/*!40000 ALTER TABLE `posts_shared` DISABLE KEYS */;

INSERT INTO `posts_shared` (`id`, `post_id`, `post_creator`, `post_sharer`, `post_date`, `post_shareddate`, `post_content`, `post_creator_id`, `post_sharer_id`, `post_creator_image`, `post_sharer_image`)
VALUES
	(51,10,'owner','petr','2018-03-17 21:35:38','2018-03-17 22:15:36','Ahoj, cítím se dobře co vy',53,56,'images/w12w235jarb4n3b.jpg','images/5fblkpkynl7z32s.png'),
	(52,11,'petr','owner','2018-03-18 10:00:39','2018-03-19 11:12:04','Ahoj lidičky',56,53,'images/5fblkpkynl7z32s.png','images/w12w235jarb4n3b.jpg'),
	(53,11,'petr','petr1','2018-03-18 10:00:39','2018-03-19 11:51:36','Ahoj lidičky',56,60,'images/5fblkpkynl7z32s.png','images/3yszfe39x05krgu.jpg');

/*!40000 ALTER TABLE `posts_shared` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(70) NOT NULL DEFAULT '',
  `about_me` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(200) DEFAULT '',
  `role` varchar(128) NOT NULL DEFAULT '',
  `last_updated` datetime DEFAULT NULL,
  `header` varchar(200) DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `date_created`, `first_name`, `last_name`, `about_me`, `image`, `role`, `last_updated`, `header`)
VALUES
	(53,'owner','$2y$10$9wbw1id9HUdk.gOGTurjP.ltdPY0/W9FdvtyrOiWyqc5wKFyAeRx6','owner@gmail.com','2018-03-10 12:14:27','Jakub','Schneller','Nic moc dopíčí','images/s87vazwe5nhvawi.jpg','owner','2018-03-10 13:11:51','images/9a1n65wa80tediq.jpg'),
	(56,'petr','$2y$10$SMbjdN0MVJavfhZIId4db.A0kRjNb7.IBqS1UPiSO5ej8G04nGInW','petr@gmail.com','2018-03-17 21:36:49','Petr','Nováček','mám rád vlaky','images/5fblkpkynl7z32s.png','user',NULL,'images/default.jpg'),
	(57,'klarka','$2y$10$SouFzK.fkUyrGbOMXTr7HOs7bJK4Pnjz7iXnOdvr0cHklvSFbZX2m','klarka@gmail.com','2018-03-18 09:14:21','klarka','krizova','mam rada vlaky','images/zi2uxw8ogholj24.jpg','user',NULL,'images/default.jpg'),
	(60,'petr1','$2y$10$kj9S/LmsGU5gyDlrVZoVae5ayBrcMryE5jKFQAQb2Fi5ngJrd/sN.','petr1@gmail.com','2018-03-19 10:47:00','Petr','Pepino','sdvsfv','images/3yszfe39x05krgu.jpg','user',NULL,'images/default.jpg'),
	(61,'a','$2y$10$dA6u5uqXTd2IprwwlNXbhOyz73/nTNmndNMMN2gnrR1jEZDWJ7UKS','a@fna.com','2018-03-30 18:13:00','sdv','sdv','a','images/2r8p0c1k4biaux4.png','user',NULL,'images/default.jpg');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
