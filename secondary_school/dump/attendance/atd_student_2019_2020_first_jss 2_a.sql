-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: managementsystem
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

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
-- Table structure for table `atd_student_2019_2020_first_jss 2_a`
--

DROP TABLE IF EXISTS `atd_student_2019_2020_first_jss 2_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_student_2019_2020_first_jss 2_a` (
  `dd` date NOT NULL,
  `1` varchar(3) NOT NULL DEFAULT '0',
  `2` varchar(3) NOT NULL DEFAULT '0',
  `3` varchar(3) NOT NULL DEFAULT '0',
  `4` varchar(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `dd` (`dd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_student_2019_2020_first_jss 2_a`
--

LOCK TABLES `atd_student_2019_2020_first_jss 2_a` WRITE;
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 2_a` DISABLE KEYS */;
INSERT INTO `atd_student_2019_2020_first_jss 2_a` VALUES ('2019-01-07','1','1','1','0'),('2019-01-08','1','0','1','0'),('2019-01-09','1','1','1','0'),('2019-03-04','1','1','1','0'),('2019-03-05','1','1','1','0'),('2019-03-06','PHD','PHD','PHD','0'),('2019-03-07','MTB','MTB','MTB','0'),('2019-03-08','MTB','MTB','MTB','0'),('2019-03-11','1','1','0','0'),('2019-03-12','1','0','1','0'),('2019-03-13','1','1','1','0'),('2019-03-14','1','1','1','0'),('2019-03-15','1','1','1','0');
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 2_a` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-08 13:29:40
