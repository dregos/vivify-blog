-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: vivify_oglasnik
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'POST 1','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500','2017-06-26 19:18:49',NULL,2,1),(2,'POST 2','Standard dummy text ever since the 1500. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500','2017-06-26 19:18:49',NULL,1,2),(3,'POST 3','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500','2017-06-26 19:18:49',NULL,2,1),(4,'POST 4','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:22:17',NULL,2,NULL),(5,'POST 5','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:22:17',NULL,2,NULL),(7,'POST 7','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:22:17',NULL,3,NULL),(8,'POST 8','Lorem Ipsum has been the industry\'s standard dummy text ev___ Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:22:17',NULL,3,NULL),(10,'POST 10','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:23:29',NULL,2,NULL),(11,'POST 11','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:23:29',NULL,4,NULL),(12,'POST 12','Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:23:29',NULL,3,NULL),(13,'POST 13','Lorem Ipsum has been the industry\'s standard dummy text ev___ Ipsum has been the industry\'s standard dummy text ever since the 1500.','2017-06-27 17:23:29',NULL,4,NULL),(38,'POST 14','hrana njam','2017-06-29 19:21:23',NULL,1,1),(41,'POST YAAAAAAY!!!','wrum wrum','2017-06-30 19:00:20',NULL,16,2),(42,'DOUBLE YAAAAAY!!!!!','njam njam','2017-06-30 19:02:41',NULL,16,1),(43,'TRIPLE YAAAAAY!!!!!','ql looking chap!','2017-06-30 19:04:01',NULL,16,3),(45,'QUADRUPLE YAAAAAY!!!!','hmhmhmhmh','2017-06-30 19:33:09',NULL,16,1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Food'),(2,'Automobile'),(3,'Lifestyle');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (2,'Ovo je jako super',2,1,'2017-06-27 20:54:16'),(3,'Ma nemaš pojma',3,1,'2017-06-27 20:54:16'),(34,'Super je ovo odrađeno',1,1,'2017-06-28 19:07:43'),(35,'Ajde da probamo sa ctrl i enter da te upišemo',1,1,'2017-06-28 19:10:12'),(36,'dddd\ndd\nd',1,1,'2017-06-28 19:10:29'),(37,'test',1,2,'2017-06-28 19:20:52'),(38,'ti nemaš pojma',1,1,'2017-06-30 17:18:47'),(39,'test',16,1,'2017-06-30 18:36:51'),(40,'dasdasdads',16,1,'2017-06-30 19:27:27'),(41,'dsadsd\n',16,1,'2017-06-30 19:27:33'),(42,'sss',16,1,'2017-06-30 19:27:37');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,1,'Pera','Perić'),(2,2,'Mika','Mikić'),(3,3,'Žika','Žikić'),(4,4,'Marko','Marković'),(6,16,'test','test'),(7,17,'test','test');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pera@example.com','pera'),(2,'mika@example.com','mika'),(3,'zika@example.com','zika'),(4,'marko@example.com','marko'),(16,'test','test'),(17,'test2','test');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-30 19:56:35
