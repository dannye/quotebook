-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: quotebook
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote` varchar(1000) NOT NULL,
  `character` varchar(50) DEFAULT NULL,
  `actor` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `medium` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,'Do you ever dream, Forrest, about who you\'re gonna be?','Jenny Curran','Robin Wright','Forrest Gump','http://www.wichitaorpheum.com/wp-content/uploads/2013/12/Forrest-Gump-Poster.jpg','movie'),(2,'You drop a pass, you run a mile. You miss a blocking assignment, you run a mile. You fumble the football and I will break my foot off in your John Brown hind parts...and then you will run a mile.','Herman Boone','Denzel Washington','Remember the Titans','http://www.gstatic.com/tv/thumb/dvdboxart/25848/p25848_d_v8_aa.jpg','movie'),(3,'Run, Forrest! Run!','Jenny Curran','Robin Wright','Forrest Gump','http://www.wichitaorpheum.com/wp-content/uploads/2013/12/Forrest-Gump-Poster.jpg','movie'),(4,'Look at us. I\'m frozen and you\'re dead, and I love you.','David Aames','Tom Cruise','Vanilla Sky','http://www.gstatic.com/tv/thumb/movieposters/28886/p28886_p_v8_aa.jpg','movie');
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-02 16:37:43
