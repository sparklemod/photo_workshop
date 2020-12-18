-- MySQL dump 10.11
--
-- Host: localhost    Database: id15099272_photo_workshop
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt

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
-- Table structure for table `order_types`
--

DROP TABLE IF EXISTS `order_types`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `order_types` (
  `name` tinytext,
  `price` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `order_types`
--

LOCK TABLES `order_types` WRITE;
/*!40000 ALTER TABLE `order_types` DISABLE KEYS */;
INSERT INTO `order_types` VALUES ('Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°',5000),('Ð”ÐµÐ»Ð¾Ð²Ñ‹Ðµ Ð¿Ð¾Ñ€Ñ‚Ñ€ÐµÑ‚Ñ‹',3000),('ÐŸÑ€ÐµÐ´Ð¼ÐµÑ‚Ð½Ð°Ñ Ñ„Ð¾Ñ‚Ð¾ÑÑŠÐµÐ¼ÐºÐ°',2000),('Ð ÐµÐºÐ»Ð°Ð¼Ð½Ð°Ñ Ñ„Ð¾Ñ‚Ð¾ÑÑŠÐµÐ¼ÐºÐ°',8000),('Ð¤Ð¾Ñ‚Ð¾ÑÑŠÐµÐ¼ÐºÐ° Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´ÑÑ‚Ð²ÐµÐ½Ð½Ñ‹Ñ… Ð¿Ñ€Ð¾Ñ†ÐµÑÑÐ¾Ð²',4000),('Ð¡Ð²Ð°Ð´ÐµÐ±Ð½Ñ‹Ðµ Ñ„Ð¾Ñ‚Ð¾ÑÑŠÐµÐ¼ÐºÐ¸',6000),('Ð‘ÐµÑ€ÐµÐ¼ÐµÐ½Ð½Ñ‹Ðµ Ñ„Ð¾Ñ‚Ð¾ÑÐµÑÑÐ¸Ð¸',4000),('Ð˜Ð½Ð´Ð¸Ð²Ð¸Ð´ÑƒÐ°Ð»ÑŒÐ½Ñ‹Ðµ Ñ„Ð¾Ñ‚Ð¾ÑÐµÑÑÐ¸Ð¸',2000);
/*!40000 ALTER TABLE `order_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) default NULL,
  `order_date` date default NULL,
  `price` float default NULL,
  `price_paid` tinyint(1) default NULL,
  `photosession_date` date default NULL,
  `photosession_address` tinytext,
  `photosession_time` time default NULL,
  `photosession_timelength` float default NULL,
  `type` tinytext,
  `task_file` tinytext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (10,11,'2020-12-18',10000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',2,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°','order10-4.docx'),(11,11,'2020-12-18',5000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',1,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°',''),(12,11,'2020-12-18',5000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',1,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°',''),(13,11,'2020-12-18',5000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',1,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°',''),(14,11,'2020-12-18',5000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',1,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°',''),(15,11,'2020-12-18',5000,0,'2000-01-01','ÑƒÐ». ÐŸÑƒÑˆÐºÐ¸Ð½Ð°','12:00:00',1,'Ð ÐµÐ¿Ð¾Ñ€Ñ‚Ð°Ð¶Ð½Ð°Ñ ÑÑŠÐµÐ¼ÐºÐ°','order15-4.docx');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_login` varchar(30) default NULL,
  `user_password` varchar(32) default NULL,
  `user_hash` varchar(32) default NULL,
  `user_ip` int(11) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'Ð˜Ð²Ð°Ð½','Ð˜Ð²Ð°Ð½Ð¾Ð²','admin@gg.gg','1f32aa4c9a1d2ea010adcf2348166a04','',NULL),(12,'Ð•ÐºÐ°Ñ‚ÐµÑ€Ð¸Ð½Ð°','Ð­Ð¼','katerina5314@mail.ru','5918080e8dd9bc3cd09bd23762fc52d9','',NULL),(13,'ÐÐ½Ð°ÑÑ‚Ð°ÑÐ¸Ñ','Ð”ÐµÐ¼Ð¸Ð½Ð°','demina@mail.ru','6636de5b56e349923068dcaa767e2c7d','',NULL);
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

-- Dump completed on 2020-12-18 18:15:37
