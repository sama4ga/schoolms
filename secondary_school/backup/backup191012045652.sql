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
-- Table structure for table `arm`
--

DROP TABLE IF EXISTS `arm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arm` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `arm` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arm`
--

LOCK TABLES `arm` WRITE;
/*!40000 ALTER TABLE `arm` DISABLE KEYS */;
INSERT INTO `arm` VALUES (1,'a'),(2,'b'),(3,'c');
/*!40000 ALTER TABLE `arm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atd_staff_2019_2020_first`
--

DROP TABLE IF EXISTS `atd_staff_2019_2020_first`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_staff_2019_2020_first` (
  `date` date NOT NULL,
  `2` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `3` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `4` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_staff_2019_2020_first`
--

LOCK TABLES `atd_staff_2019_2020_first` WRITE;
/*!40000 ALTER TABLE `atd_staff_2019_2020_first` DISABLE KEYS */;
INSERT INTO `atd_staff_2019_2020_first` VALUES ('2019-05-06','2019-05-06 20:37:46','0000-00-00 00:00:00','0000-00-00 00:00:00'),('2019-05-07','2019-05-10 15:38:36','2019-05-07 06:00:00','2019-05-07 06:00:00'),('2019-05-08','2019-05-10 15:39:07','2019-05-08 06:06:00','2019-05-08 06:08:00'),('2019-05-09','2019-05-10 15:39:32','2019-05-09 06:05:00','2019-05-09 06:10:00'),('2019-05-10','2019-05-10 15:38:07','2019-05-10 06:00:00','2019-05-10 06:00:00');
/*!40000 ALTER TABLE `atd_staff_2019_2020_first` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atd_student_2019_2020_first_jss 1_a`
--

DROP TABLE IF EXISTS `atd_student_2019_2020_first_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_student_2019_2020_first_jss 1_a` (
  `dd` date NOT NULL,
  `1` varchar(3) NOT NULL DEFAULT '0',
  `2` varchar(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `dd` (`dd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_student_2019_2020_first_jss 1_a`
--

LOCK TABLES `atd_student_2019_2020_first_jss 1_a` WRITE;
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 1_a` DISABLE KEYS */;
INSERT INTO `atd_student_2019_2020_first_jss 1_a` VALUES ('2019-05-06','1','1'),('2019-05-07','1','1');
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atd_student_2019_2020_second_jss 1_a`
--

DROP TABLE IF EXISTS `atd_student_2019_2020_second_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_student_2019_2020_second_jss 1_a` (
  `dd` date NOT NULL,
  `1` varchar(3) NOT NULL DEFAULT '0',
  `2` varchar(3) NOT NULL DEFAULT '0',
  `3` varchar(3) NOT NULL DEFAULT '0',
  `4` varchar(3) NOT NULL DEFAULT '0',
  UNIQUE KEY `dd` (`dd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_student_2019_2020_second_jss 1_a`
--

LOCK TABLES `atd_student_2019_2020_second_jss 1_a` WRITE;
/*!40000 ALTER TABLE `atd_student_2019_2020_second_jss 1_a` DISABLE KEYS */;
INSERT INTO `atd_student_2019_2020_second_jss 1_a` VALUES ('2019-05-06','1','1','1','1'),('2019-05-07','1','1','1','1'),('2019-05-08','1','1','1','0'),('2019-05-09','1','1','1','1'),('2019-05-10','1','1','1','1'),('2019-05-13','0','1','1','1'),('2019-05-14','1','1','1','1'),('2019-05-15','1','1','1','1'),('2019-05-16','1','1','1','1'),('2019-05-17','1','1','1','1'),('2019-05-20','1','1','1','1'),('2019-05-21','1','1','1','1'),('2019-05-22','1','1','1','1'),('2019-05-23','1','1','1','1'),('2019-05-24','1','1','1','1'),('2019-05-27','PHD','PHD','PHD','PHD'),('2019-05-28','1','0','1','1'),('2019-05-29','1','1','0','1'),('2019-05-30','1','0','1','0'),('2019-05-31','1','1','1','1'),('2019-06-03','1','1','1','1'),('2019-06-04','1','1','1','1'),('2019-06-05','1','1','1','1'),('2019-06-06','1','1','1','1'),('2019-06-07','1','1','1','1'),('2019-06-10','1','1','1','1'),('2019-06-11','1','1','1','1'),('2019-06-12','PHD','PHD','PHD','PHD'),('2019-06-13','1','1','1','1'),('2019-06-14','1','1','1','1'),('2019-06-17','1','1','1','1'),('2019-06-18','1','1','0','1'),('2019-06-19','1','1','1','1'),('2019-06-20','1','1','1','1'),('2019-06-21','1','1','1','1'),('2019-06-24','1','1','1','1'),('2019-06-25','1','1','1','1'),('2019-06-26','1','1','1','1'),('2019-06-27','MTB','MTB','MTB','MTB'),('2019-06-28','MTB','MTB','MTB','MTB'),('2019-07-01','1','1','1','1'),('2019-07-02','1','1','1','1'),('2019-07-03','1','1','1','1'),('2019-07-04','1','1','1','1'),('2019-07-05','1','1','1','1'),('2019-07-08','1','1','1','0'),('2019-07-09','0','0','1','1'),('2019-07-10','1','0','1','1'),('2019-07-11','1','1','0','1'),('2019-07-12','1','1','1','0'),('2019-07-15','1','1','1','0'),('2019-07-16','1','1','1','1'),('2019-07-17','1','1','1','1'),('2019-07-18','1','1','1','1'),('2019-07-19','1','1','1','1');
/*!40000 ALTER TABLE `atd_student_2019_2020_second_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `baa_orig`
--

DROP TABLE IF EXISTS `baa_orig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baa_orig` (
  `behaviour` varchar(200) DEFAULT NULL,
  `grp` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baa_orig`
--

LOCK TABLES `baa_orig` WRITE;
/*!40000 ALTER TABLE `baa_orig` DISABLE KEYS */;
INSERT INTO `baa_orig` VALUES ('Attendance','A'),('Attentiveness','A'),('Cooperation','A'),('Creativity','A'),('Curiousity','A'),('Diligence','A'),('Honesty','A'),('Initiative','A'),('Neatness','A'),('Organization','A'),('Perseverance','A'),('Punctuality','A'),('Reliability','A'),('Responsibility','A'),('Self Control','A');
/*!40000 ALTER TABLE `baa_orig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `existing_result_sheets`
--

DROP TABLE IF EXISTS `existing_result_sheets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `existing_result_sheets` (
  `result_id` varchar(100) NOT NULL,
  `class` varchar(5) NOT NULL,
  `term` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term_began` date NOT NULL,
  `term_ends` date NOT NULL,
  `next_term_begins` date NOT NULL,
  `next_term_ends` date NOT NULL,
  `max_atd` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  UNIQUE KEY `result_id` (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `existing_result_sheets`
--

LOCK TABLES `existing_result_sheets` WRITE;
/*!40000 ALTER TABLE `existing_result_sheets` DISABLE KEYS */;
INSERT INTO `existing_result_sheets` VALUES ('res_id_2019_2020_first_jss 1_a','jss 1','first','2019_2020','a','2019-09-16','2019-12-20','2020-01-13','2020-04-10','0',''),('res_id_2019_2020_second_jss 1_a','jss 1','second','2019_2020','a','2019-05-06','2019-07-26','2019-07-26','2019-07-26','0','');
/*!40000 ALTER TABLE `existing_result_sheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_2019_2020_may`
--

DROP TABLE IF EXISTS `expenses_2019_2020_may`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_2019_2020_may` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(200) NOT NULL,
  `supplier` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_2019_2020_may`
--

LOCK TABLES `expenses_2019_2020_may` WRITE;
/*!40000 ALTER TABLE `expenses_2019_2020_may` DISABLE KEYS */;
INSERT INTO `expenses_2019_2020_may` VALUES (1,'0000-00-00 00:00:00','Bought White Board Markers','',12,1000,0,0),(2,'2019-05-05 23:00:00','Bought White Board markers','Local store',12,1200,1200,0);
/*!40000 ALTER TABLE `expenses_2019_2020_may` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `fees_id` int(11) NOT NULL AUTO_INCREMENT,
  `ss 1` int(7) NOT NULL,
  `ss 2` int(7) NOT NULL,
  `ss 3` int(7) NOT NULL,
  `jss 1` int(7) NOT NULL,
  `jss 2` int(7) NOT NULL,
  `jss 3` int(7) NOT NULL,
  `term` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (1,20000,20000,20000,20000,20000,20000,'first','2019/2020'),(2,20000,20000,20000,20000,20000,20000,'second','2019/2020');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_2019_2020_first`
--

DROP TABLE IF EXISTS `fees_2019_2020_first`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_2019_2020_first` (
  `fees_id` int(10) NOT NULL AUTO_INCREMENT,
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `class` varchar(6) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term` varchar(10) NOT NULL,
  `fees` varchar(6) NOT NULL,
  `amount_due` varchar(6) NOT NULL,
  `amount_paid` varchar(6) NOT NULL,
  `balance` varchar(6) NOT NULL,
  `teller_no` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_2019_2020_first`
--

LOCK TABLES `fees_2019_2020_first` WRITE;
/*!40000 ALTER TABLE `fees_2019_2020_first` DISABLE KEYS */;
INSERT INTO `fees_2019_2020_first` VALUES (1,1,'Afiakinye','Maurice Oscar','JSS 1','A','','','','15000','','5145756465RJP','First Bank Nig. Plc.','2019-05-06','2019-05-06 22:06:20'),(2,1,'Afiakinye','Maurice Oscar','JSS 1','A','','','','5000','','5145756465RJP','Keystone Bank','2019-05-21','2019-05-21 16:21:58');
/*!40000 ALTER TABLE `fees_2019_2020_first` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_2019_2020_second`
--

DROP TABLE IF EXISTS `fees_2019_2020_second`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_2019_2020_second` (
  `fees_id` int(10) NOT NULL AUTO_INCREMENT,
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `class` varchar(6) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term` varchar(10) NOT NULL,
  `fees` varchar(6) NOT NULL,
  `amount_due` varchar(6) NOT NULL,
  `amount_paid` varchar(6) NOT NULL,
  `balance` varchar(6) NOT NULL,
  `teller_no` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_2019_2020_second`
--

LOCK TABLES `fees_2019_2020_second` WRITE;
/*!40000 ALTER TABLE `fees_2019_2020_second` DISABLE KEYS */;
INSERT INTO `fees_2019_2020_second` VALUES (1,4,'Asuquo','Jeremiah Augustine','JSS 1','A','','','','20000','','2541587hu','Keystone Bank','2019-05-21','2019-05-21 16:13:36'),(2,1,'Afiakinye','Maurice Oscar','JSS 1','A','','','','20000','','5145756465RJO','Keystone Bank','2019-05-21','2019-05-21 16:22:46');
/*!40000 ALTER TABLE `fees_2019_2020_second` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_debtors`
--

DROP TABLE IF EXISTS `fees_debtors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_debtors` (
  `fees_id` int(10) NOT NULL AUTO_INCREMENT,
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `class` varchar(6) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `fees` varchar(6) NOT NULL,
  `amount_paid` varchar(6) NOT NULL,
  `balance` varchar(6) NOT NULL,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_debtors`
--

LOCK TABLES `fees_debtors` WRITE;
/*!40000 ALTER TABLE `fees_debtors` DISABLE KEYS */;
INSERT INTO `fees_debtors` VALUES (2,2,'Oluwole','Taiwo Bami','jss 1','a','first','2019/2020','20000','0','20000'),(4,2,'Oluwole','Taiwo Bami','jss 1','a','second','2019/2020','20000','0','20000'),(5,3,'Asuquo','Janelle Augustine','jss 1','a','second','2019/2020','20000','0','20000');
/*!40000 ALTER TABLE `fees_debtors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jss 1`
--

DROP TABLE IF EXISTS `jss 1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jss 1` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jss 1`
--

LOCK TABLES `jss 1` WRITE;
/*!40000 ALTER TABLE `jss 1` DISABLE KEYS */;
INSERT INTO `jss 1` VALUES (1,'ENGLISH LANGUAGE','general'),(2,'MATHEMATICS','general'),(3,'SOCIAL STUDIES','general'),(4,'BUSINESS STUDIES','general'),(5,'HOME ECONOMICS','general'),(6,'CHRISTIAN REL. KNOWLEDGE','general'),(7,'AGRICULTURAL SCIENCE','general'),(9,'BASIC TECHNOLOGY','general'),(11,'CIVIC EDUCATION','general'),(12,'BASIC SCIENCE','general'),(13,'CREATIVE ARTS','general'),(14,'INFORMATION & COMM. TECH.','general'),(15,'MUSIC','general'),(16,'PHYSICAL & HEALTH EDUCATION','general'),(17,'FRENCH','general'),(19,'YORUBA','general'),(20,'LIT. IN ENGLISH','general');
/*!40000 ALTER TABLE `jss 1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jss 2`
--

DROP TABLE IF EXISTS `jss 2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jss 2` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jss 2`
--

LOCK TABLES `jss 2` WRITE;
/*!40000 ALTER TABLE `jss 2` DISABLE KEYS */;
INSERT INTO `jss 2` VALUES (1,'ENGLISH LANGUAGE','general'),(2,'MATHEMATICS','general'),(3,'SOCIAL STUDIES','general'),(4,'BUSINESS STUDIES','general'),(5,'HOME ECONOMICS','general'),(6,'CHRISTIAN REL. KNOWLEDGE','general'),(7,'AGRICULTURAL SCIENCE','general'),(8,'BASIC TECHNOLOGY','general'),(16,'FRENCH','general'),(17,'MUSIC','general'),(19,'PHYSICAL & HEALTH EDUCATION','general'),(21,'BASIC SCIENCE','general'),(22,'CREATIVE ARTS','general'),(23,'INFORMATION & COMM. TECH.','general'),(24,'CIVIC EDUCATION','general'),(25,'YORUBA','general'),(26,'LIT. IN ENGLISH','general');
/*!40000 ALTER TABLE `jss 2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jss 3`
--

DROP TABLE IF EXISTS `jss 3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jss 3` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jss 3`
--

LOCK TABLES `jss 3` WRITE;
/*!40000 ALTER TABLE `jss 3` DISABLE KEYS */;
INSERT INTO `jss 3` VALUES (1,'ENGLISH LANGUAGE','general'),(2,'MATHEMATICS','general'),(3,'SOCIAL STUDIES','general'),(4,'BUSINESS STUDIES','general'),(5,'HOME ECONOMICS','general'),(6,'CHRISTIAN REL. KNOWLEDGE','general'),(7,'AGRICULTURAL SCIENCE','general'),(8,'FRENCH','general'),(9,'MUSIC','general'),(10,'BASIC TECHNOLOGY','general'),(11,'PHYSICAL & HEALTH EDUCATION','general'),(12,'CIVIC EDUCATION','general'),(13,'BASIC SCIENCE','general'),(14,'CREATIVE ARTS','general'),(15,'INFORMATION & COMM. TECH.','general'),(16,'YORUBA','general'),(17,'LIT. IN ENGLISH','general');
/*!40000 ALTER TABLE `jss 3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_with_discount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'White Board Marker',4,110,110,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psychomotor`
--

DROP TABLE IF EXISTS `psychomotor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psychomotor` (
  `behaviour` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psychomotor`
--

LOCK TABLES `psychomotor` WRITE;
/*!40000 ALTER TABLE `psychomotor` DISABLE KEYS */;
INSERT INTO `psychomotor` VALUES ('LEGIBILITY'),('DEXTERITY'),('DRAWING AND PAINTING'),('MUSICAL SKILLS'),('SPORTS AND GAMES'),('ACCURACY');
/*!40000 ALTER TABLE `psychomotor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `res_id_2019_2020_first_jss 1_a`
--

DROP TABLE IF EXISTS `res_id_2019_2020_first_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `res_id_2019_2020_first_jss 1_a` (
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `english_language` varchar(50) NOT NULL,
  `english_language_ca_1` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_2` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_3` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_4` int(2) NOT NULL DEFAULT '0',
  `english_language_exam` int(3) NOT NULL DEFAULT '0',
  `english_language_total` int(4) NOT NULL DEFAULT '0',
  `english_language_average` double NOT NULL DEFAULT '0',
  `english_language_position` varchar(4) NOT NULL,
  `mathematics` varchar(50) NOT NULL,
  `mathematics_ca_1` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_2` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_3` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_4` int(2) NOT NULL DEFAULT '0',
  `mathematics_exam` int(3) NOT NULL DEFAULT '0',
  `mathematics_total` int(4) NOT NULL DEFAULT '0',
  `mathematics_average` double NOT NULL DEFAULT '0',
  `mathematics_position` varchar(4) NOT NULL,
  `social_studies` varchar(50) NOT NULL,
  `social_studies_ca_1` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_2` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_3` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_4` int(2) NOT NULL DEFAULT '0',
  `social_studies_exam` int(3) NOT NULL DEFAULT '0',
  `social_studies_total` int(4) NOT NULL DEFAULT '0',
  `social_studies_average` double NOT NULL DEFAULT '0',
  `social_studies_position` varchar(4) NOT NULL,
  `business_studies` varchar(50) NOT NULL,
  `business_studies_ca_1` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_2` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_3` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_4` int(2) NOT NULL DEFAULT '0',
  `business_studies_exam` int(3) NOT NULL DEFAULT '0',
  `business_studies_total` int(4) NOT NULL DEFAULT '0',
  `business_studies_average` double NOT NULL DEFAULT '0',
  `business_studies_position` varchar(4) NOT NULL,
  `home_economics` varchar(50) NOT NULL,
  `home_economics_ca_1` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_2` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_3` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_4` int(2) NOT NULL DEFAULT '0',
  `home_economics_exam` int(3) NOT NULL DEFAULT '0',
  `home_economics_total` int(4) NOT NULL DEFAULT '0',
  `home_economics_average` double NOT NULL DEFAULT '0',
  `home_economics_position` varchar(4) NOT NULL,
  `christian_rel__knowledge` varchar(50) NOT NULL,
  `christian_rel__knowledge_ca_1` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_2` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_3` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_4` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_exam` int(3) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_total` int(4) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_average` double NOT NULL DEFAULT '0',
  `christian_rel__knowledge_position` varchar(4) NOT NULL,
  `agricultural_science` varchar(50) NOT NULL,
  `agricultural_science_ca_1` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_2` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_3` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_4` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_exam` int(3) NOT NULL DEFAULT '0',
  `agricultural_science_total` int(4) NOT NULL DEFAULT '0',
  `agricultural_science_average` double NOT NULL DEFAULT '0',
  `agricultural_science_position` varchar(4) NOT NULL,
  `basic_technology` varchar(50) NOT NULL,
  `basic_technology_ca_1` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_2` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_3` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_4` int(2) NOT NULL DEFAULT '0',
  `basic_technology_exam` int(3) NOT NULL DEFAULT '0',
  `basic_technology_total` int(4) NOT NULL DEFAULT '0',
  `basic_technology_average` double NOT NULL DEFAULT '0',
  `basic_technology_position` varchar(4) NOT NULL,
  `civic_education` varchar(50) NOT NULL,
  `civic_education_ca_1` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_2` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_3` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_4` int(2) NOT NULL DEFAULT '0',
  `civic_education_exam` int(3) NOT NULL DEFAULT '0',
  `civic_education_total` int(4) NOT NULL DEFAULT '0',
  `civic_education_average` double NOT NULL DEFAULT '0',
  `civic_education_position` varchar(4) NOT NULL,
  `basic_science` varchar(50) NOT NULL,
  `basic_science_ca_1` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_2` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_3` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_4` int(2) NOT NULL DEFAULT '0',
  `basic_science_exam` int(3) NOT NULL DEFAULT '0',
  `basic_science_total` int(4) NOT NULL DEFAULT '0',
  `basic_science_average` double NOT NULL DEFAULT '0',
  `basic_science_position` varchar(4) NOT NULL,
  `creative_arts` varchar(50) NOT NULL,
  `creative_arts_ca_1` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_2` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_3` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_4` int(2) NOT NULL DEFAULT '0',
  `creative_arts_exam` int(3) NOT NULL DEFAULT '0',
  `creative_arts_total` int(4) NOT NULL DEFAULT '0',
  `creative_arts_average` double NOT NULL DEFAULT '0',
  `creative_arts_position` varchar(4) NOT NULL,
  `information___comm__tech_` varchar(50) NOT NULL,
  `information___comm__tech__ca_1` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_2` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_3` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_4` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__exam` int(3) NOT NULL DEFAULT '0',
  `information___comm__tech__total` int(4) NOT NULL DEFAULT '0',
  `information___comm__tech__average` double NOT NULL DEFAULT '0',
  `information___comm__tech__position` varchar(4) NOT NULL,
  `music` varchar(50) NOT NULL,
  `music_ca_1` int(2) NOT NULL DEFAULT '0',
  `music_ca_2` int(2) NOT NULL DEFAULT '0',
  `music_ca_3` int(2) NOT NULL DEFAULT '0',
  `music_ca_4` int(2) NOT NULL DEFAULT '0',
  `music_exam` int(3) NOT NULL DEFAULT '0',
  `music_total` int(4) NOT NULL DEFAULT '0',
  `music_average` double NOT NULL DEFAULT '0',
  `music_position` varchar(4) NOT NULL,
  `physical___health_education` varchar(50) NOT NULL,
  `physical___health_education_ca_1` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_2` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_3` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_4` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_exam` int(3) NOT NULL DEFAULT '0',
  `physical___health_education_total` int(4) NOT NULL DEFAULT '0',
  `physical___health_education_average` double NOT NULL DEFAULT '0',
  `physical___health_education_position` varchar(4) NOT NULL,
  `french` varchar(50) NOT NULL,
  `french_ca_1` int(2) NOT NULL DEFAULT '0',
  `french_ca_2` int(2) NOT NULL DEFAULT '0',
  `french_ca_3` int(2) NOT NULL DEFAULT '0',
  `french_ca_4` int(2) NOT NULL DEFAULT '0',
  `french_exam` int(3) NOT NULL DEFAULT '0',
  `french_total` int(4) NOT NULL DEFAULT '0',
  `french_average` double NOT NULL DEFAULT '0',
  `french_position` varchar(4) NOT NULL,
  `yoruba` varchar(50) NOT NULL,
  `yoruba_ca_1` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_2` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_3` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_4` int(2) NOT NULL DEFAULT '0',
  `yoruba_exam` int(3) NOT NULL DEFAULT '0',
  `yoruba_total` int(4) NOT NULL DEFAULT '0',
  `yoruba_average` double NOT NULL DEFAULT '0',
  `yoruba_position` varchar(4) NOT NULL,
  `lit__in_english` varchar(50) NOT NULL,
  `lit__in_english_ca_1` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_2` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_3` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_4` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_exam` int(3) NOT NULL DEFAULT '0',
  `lit__in_english_total` int(4) NOT NULL DEFAULT '0',
  `lit__in_english_average` double NOT NULL DEFAULT '0',
  `lit__in_english_position` varchar(4) NOT NULL,
  `attendance` varchar(3) NOT NULL,
  `attentiveness` varchar(3) NOT NULL,
  `cooperation` varchar(3) NOT NULL,
  `creativity` varchar(3) NOT NULL,
  `curiousity` varchar(3) NOT NULL,
  `diligence` varchar(3) NOT NULL,
  `honesty` varchar(3) NOT NULL,
  `initiative` varchar(3) NOT NULL,
  `neatness` varchar(3) NOT NULL,
  `organization` varchar(3) NOT NULL,
  `perseverance` varchar(3) NOT NULL,
  `punctuality` varchar(3) NOT NULL,
  `reliability` varchar(3) NOT NULL,
  `responsibility` varchar(3) NOT NULL,
  `self_control` varchar(3) NOT NULL,
  `legibility` varchar(4) NOT NULL,
  `dexterity` varchar(4) NOT NULL,
  `drawing_and_painting` varchar(4) NOT NULL,
  `musical_skills` varchar(4) NOT NULL,
  `sports_and_games` varchar(4) NOT NULL,
  `accuracy` varchar(4) NOT NULL,
  `total_score` double NOT NULL DEFAULT '0',
  `position` varchar(5) NOT NULL,
  `average` double NOT NULL,
  `class_average` double NOT NULL,
  `age` varchar(4) NOT NULL,
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `phone_no` varchar(26) NOT NULL,
  `reg_no` varchar(26) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `atd` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `std_id` (`std_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `res_id_2019_2020_first_jss 1_a`
--

LOCK TABLES `res_id_2019_2020_first_jss 1_a` WRITE;
/*!40000 ALTER TABLE `res_id_2019_2020_first_jss 1_a` DISABLE KEYS */;
INSERT INTO `res_id_2019_2020_first_jss 1_a` VALUES (1,'Afiakinye','Maurice Oscar','',6,6,7,8,58,85,85,'1st','mathematics',2,5,4,6,39,56,56,'1st','',5,4,6,5,39,59,59,'1st','',7,8,4,6,41,66,66,'1st','',5,7,8,8,49,77,77,'1st','',3,5,1,6,25,40,40,'1st','',5,4,7,8,50,74,74,'1st','',5,2,6,4,55,72,72,'1st','',5,4,6,3,35,53,53,'1st','',5,8,7,9,46,75,75,'1st','',2,5,4,7,48,66,66,'1st','',5,7,7,8,52,79,79,'1st','',6,3,4,8,57,78,78,'1st','',3,3,4,5,32,47,47,'1st','',2,5,8,6,49,70,70,'1st','',5,7,5,6,37,60,60,'1st','',6,3,5,8,46,68,68,'1st','A','B','A','B','C','D','C','A','B','C','B','A','C','B','A','B','B','B','A','A','B',1125,'1st',66.2,66.2,'13',1,'09035451968','student1/27717','data/passport/student1_27717.jpg',0,'pass'),(2,'Oluwole','Taiwo Bami','',0,0,0,0,0,0,0,'','mathematics',5,2,6,4,40,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,'','A','A','C','B','E','D','C','E','A','A','D','A','B','B','B','C','B','A','A','A','A',0,'',0,0,'',2,'','','',0,'');
/*!40000 ALTER TABLE `res_id_2019_2020_first_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `res_id_2019_2020_second_jss 1_a`
--

DROP TABLE IF EXISTS `res_id_2019_2020_second_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `res_id_2019_2020_second_jss 1_a` (
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `english_language` varchar(50) NOT NULL,
  `english_language_ca_1` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_2` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_3` int(2) NOT NULL DEFAULT '0',
  `english_language_ca_4` int(2) NOT NULL DEFAULT '0',
  `english_language_exam` int(3) NOT NULL DEFAULT '0',
  `english_language_total` int(4) NOT NULL DEFAULT '0',
  `english_language_average` double NOT NULL DEFAULT '0',
  `english_language_position` varchar(4) NOT NULL,
  `mathematics` varchar(50) NOT NULL,
  `mathematics_ca_1` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_2` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_3` int(2) NOT NULL DEFAULT '0',
  `mathematics_ca_4` int(2) NOT NULL DEFAULT '0',
  `mathematics_exam` int(3) NOT NULL DEFAULT '0',
  `mathematics_total` int(4) NOT NULL DEFAULT '0',
  `mathematics_average` double NOT NULL DEFAULT '0',
  `mathematics_position` varchar(4) NOT NULL,
  `social_studies` varchar(50) NOT NULL,
  `social_studies_ca_1` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_2` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_3` int(2) NOT NULL DEFAULT '0',
  `social_studies_ca_4` int(2) NOT NULL DEFAULT '0',
  `social_studies_exam` int(3) NOT NULL DEFAULT '0',
  `social_studies_total` int(4) NOT NULL DEFAULT '0',
  `social_studies_average` double NOT NULL DEFAULT '0',
  `social_studies_position` varchar(4) NOT NULL,
  `business_studies` varchar(50) NOT NULL,
  `business_studies_ca_1` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_2` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_3` int(2) NOT NULL DEFAULT '0',
  `business_studies_ca_4` int(2) NOT NULL DEFAULT '0',
  `business_studies_exam` int(3) NOT NULL DEFAULT '0',
  `business_studies_total` int(4) NOT NULL DEFAULT '0',
  `business_studies_average` double NOT NULL DEFAULT '0',
  `business_studies_position` varchar(4) NOT NULL,
  `home_economics` varchar(50) NOT NULL,
  `home_economics_ca_1` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_2` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_3` int(2) NOT NULL DEFAULT '0',
  `home_economics_ca_4` int(2) NOT NULL DEFAULT '0',
  `home_economics_exam` int(3) NOT NULL DEFAULT '0',
  `home_economics_total` int(4) NOT NULL DEFAULT '0',
  `home_economics_average` double NOT NULL DEFAULT '0',
  `home_economics_position` varchar(4) NOT NULL,
  `christian_rel__knowledge` varchar(50) NOT NULL,
  `christian_rel__knowledge_ca_1` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_2` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_3` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_ca_4` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_exam` int(3) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_total` int(4) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_average` double NOT NULL DEFAULT '0',
  `christian_rel__knowledge_position` varchar(4) NOT NULL,
  `agricultural_science` varchar(50) NOT NULL,
  `agricultural_science_ca_1` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_2` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_3` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_ca_4` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_exam` int(3) NOT NULL DEFAULT '0',
  `agricultural_science_total` int(4) NOT NULL DEFAULT '0',
  `agricultural_science_average` double NOT NULL DEFAULT '0',
  `agricultural_science_position` varchar(4) NOT NULL,
  `basic_technology` varchar(50) NOT NULL,
  `basic_technology_ca_1` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_2` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_3` int(2) NOT NULL DEFAULT '0',
  `basic_technology_ca_4` int(2) NOT NULL DEFAULT '0',
  `basic_technology_exam` int(3) NOT NULL DEFAULT '0',
  `basic_technology_total` int(4) NOT NULL DEFAULT '0',
  `basic_technology_average` double NOT NULL DEFAULT '0',
  `basic_technology_position` varchar(4) NOT NULL,
  `civic_education` varchar(50) NOT NULL,
  `civic_education_ca_1` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_2` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_3` int(2) NOT NULL DEFAULT '0',
  `civic_education_ca_4` int(2) NOT NULL DEFAULT '0',
  `civic_education_exam` int(3) NOT NULL DEFAULT '0',
  `civic_education_total` int(4) NOT NULL DEFAULT '0',
  `civic_education_average` double NOT NULL DEFAULT '0',
  `civic_education_position` varchar(4) NOT NULL,
  `basic_science` varchar(50) NOT NULL,
  `basic_science_ca_1` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_2` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_3` int(2) NOT NULL DEFAULT '0',
  `basic_science_ca_4` int(2) NOT NULL DEFAULT '0',
  `basic_science_exam` int(3) NOT NULL DEFAULT '0',
  `basic_science_total` int(4) NOT NULL DEFAULT '0',
  `basic_science_average` double NOT NULL DEFAULT '0',
  `basic_science_position` varchar(4) NOT NULL,
  `creative_arts` varchar(50) NOT NULL,
  `creative_arts_ca_1` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_2` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_3` int(2) NOT NULL DEFAULT '0',
  `creative_arts_ca_4` int(2) NOT NULL DEFAULT '0',
  `creative_arts_exam` int(3) NOT NULL DEFAULT '0',
  `creative_arts_total` int(4) NOT NULL DEFAULT '0',
  `creative_arts_average` double NOT NULL DEFAULT '0',
  `creative_arts_position` varchar(4) NOT NULL,
  `information___comm__tech_` varchar(50) NOT NULL,
  `information___comm__tech__ca_1` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_2` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_3` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__ca_4` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__exam` int(3) NOT NULL DEFAULT '0',
  `information___comm__tech__total` int(4) NOT NULL DEFAULT '0',
  `information___comm__tech__average` double NOT NULL DEFAULT '0',
  `information___comm__tech__position` varchar(4) NOT NULL,
  `music` varchar(50) NOT NULL,
  `music_ca_1` int(2) NOT NULL DEFAULT '0',
  `music_ca_2` int(2) NOT NULL DEFAULT '0',
  `music_ca_3` int(2) NOT NULL DEFAULT '0',
  `music_ca_4` int(2) NOT NULL DEFAULT '0',
  `music_exam` int(3) NOT NULL DEFAULT '0',
  `music_total` int(4) NOT NULL DEFAULT '0',
  `music_average` double NOT NULL DEFAULT '0',
  `music_position` varchar(4) NOT NULL,
  `physical___health_education` varchar(50) NOT NULL,
  `physical___health_education_ca_1` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_2` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_3` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_ca_4` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_exam` int(3) NOT NULL DEFAULT '0',
  `physical___health_education_total` int(4) NOT NULL DEFAULT '0',
  `physical___health_education_average` double NOT NULL DEFAULT '0',
  `physical___health_education_position` varchar(4) NOT NULL,
  `french` varchar(50) NOT NULL,
  `french_ca_1` int(2) NOT NULL DEFAULT '0',
  `french_ca_2` int(2) NOT NULL DEFAULT '0',
  `french_ca_3` int(2) NOT NULL DEFAULT '0',
  `french_ca_4` int(2) NOT NULL DEFAULT '0',
  `french_exam` int(3) NOT NULL DEFAULT '0',
  `french_total` int(4) NOT NULL DEFAULT '0',
  `french_average` double NOT NULL DEFAULT '0',
  `french_position` varchar(4) NOT NULL,
  `yoruba` varchar(50) NOT NULL,
  `yoruba_ca_1` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_2` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_3` int(2) NOT NULL DEFAULT '0',
  `yoruba_ca_4` int(2) NOT NULL DEFAULT '0',
  `yoruba_exam` int(3) NOT NULL DEFAULT '0',
  `yoruba_total` int(4) NOT NULL DEFAULT '0',
  `yoruba_average` double NOT NULL DEFAULT '0',
  `yoruba_position` varchar(4) NOT NULL,
  `lit__in_english` varchar(50) NOT NULL,
  `lit__in_english_ca_1` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_2` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_3` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_ca_4` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_exam` int(3) NOT NULL DEFAULT '0',
  `lit__in_english_total` int(4) NOT NULL DEFAULT '0',
  `lit__in_english_average` double NOT NULL DEFAULT '0',
  `lit__in_english_position` varchar(4) NOT NULL,
  `attendance` varchar(3) NOT NULL,
  `attentiveness` varchar(3) NOT NULL,
  `cooperation` varchar(3) NOT NULL,
  `creativity` varchar(3) NOT NULL,
  `curiousity` varchar(3) NOT NULL,
  `diligence` varchar(3) NOT NULL,
  `honesty` varchar(3) NOT NULL,
  `initiative` varchar(3) NOT NULL,
  `neatness` varchar(3) NOT NULL,
  `organization` varchar(3) NOT NULL,
  `perseverance` varchar(3) NOT NULL,
  `punctuality` varchar(3) NOT NULL,
  `reliability` varchar(3) NOT NULL,
  `responsibility` varchar(3) NOT NULL,
  `self_control` varchar(3) NOT NULL,
  `legibility` varchar(4) NOT NULL,
  `dexterity` varchar(4) NOT NULL,
  `drawing_and_painting` varchar(4) NOT NULL,
  `musical_skills` varchar(4) NOT NULL,
  `sports_and_games` varchar(4) NOT NULL,
  `accuracy` varchar(4) NOT NULL,
  `total_score` double NOT NULL DEFAULT '0',
  `position` varchar(5) NOT NULL,
  `average` double NOT NULL,
  `class_average` double NOT NULL,
  `age` varchar(4) NOT NULL,
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `phone_no` varchar(26) NOT NULL,
  `reg_no` varchar(26) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `atd` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `std_id` (`std_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `res_id_2019_2020_second_jss 1_a`
--

LOCK TABLES `res_id_2019_2020_second_jss 1_a` WRITE;
/*!40000 ALTER TABLE `res_id_2019_2020_second_jss 1_a` DISABLE KEYS */;
INSERT INTO `res_id_2019_2020_second_jss 1_a` VALUES (1,'Afiakinye','Maurice Oscar','',5,6,4,7,39,61,68.5,'4th','',5,4,3,5,29,46,55.3,'4th','',7,5,6,5,42,65,61.3,'1st','',5,8,4,5,57,79,76.5,'2nd','',6,7,5,8,53,79,69.3,'2nd','',2,5,3,6,40,56,68,'4th','',8,5,4,8,55,80,75.8,'1st','',5,6,8,6,35,60,58,'3rd','',5,5,4,6,45,65,73,'3rd','',1,5,7,8,47,68,56.8,'2nd','',4,3,3,5,32,47,65.8,'4th','',5,4,2,6,38,55,65.8,'3rd','',3,6,5,4,35,53,64,'4th','',5,4,2,6,41,58,66.5,'4th','',2,3,5,4,51,65,59.3,'1st','',5,4,8,7,45,69,72.3,'4th','',4,5,4,7,47,67,67.8,'3rd','','','','','','','','','','','','','','','','','','','','','',1073,'4th',63.1,66.1,'14',1,'09035451968','student1/27717','data/passport/student1_27717.jpg',0,'pass'),(2,'Oluwole','Taiwo Bami','',5,6,4,8,49,72,68.5,'2nd','',4,8,7,6,42,67,55.3,'1st','',7,5,2,3,41,58,61.3,'4th','',5,7,8,4,45,69,76.5,'4th','',5,8,4,5,58,80,69.3,'1st','',2,5,8,7,47,69,68,'2nd','',5,7,8,4,50,74,75.8,'3rd','',2,5,4,3,32,46,58,'4th','',5,7,4,6,55,77,73,'2nd','',5,2,4,6,18,35,56.8,'4th','',5,5,6,7,54,77,65.8,'2nd','',5,6,8,8,57,84,65.8,'1st','',4,7,8,5,35,59,64,'3rd','',4,7,8,2,42,63,66.5,'3rd','',7,5,8,4,23,47,59.3,'4th','',5,6,4,2,55,72,72.3,'2nd','',8,7,9,8,53,85,67.8,'1st','','','','','','','','','','','','','','','','','','','','','',1134,'3rd',66.7,66.1,'13',2,'08131321343','student2/57185','data/passport/student2_57185.jpg',0,'pass'),(3,'Asuquo','Janelle Augustine','',7,5,3,3,47,65,68.5,'3rd','',4,4,5,5,42,60,55.3,'2nd','',8,6,0,7,40,61,61.3,'3rd','',5,7,9,5,48,74,76.5,'3rd','',5,8,7,5,38,63,69.3,'3rd','',4,3,5,4,40,56,68,'3rd','',7,8,9,5,50,79,75.8,'2nd','',5,3,6,1,45,60,58,'2nd','',8,9,9,9,58,93,73,'1st','',2,6,4,5,29,46,56.8,'3rd','',8,7,5,8,49,77,65.8,'1st','',4,6,5,4,35,54,65.8,'4th','',5,5,5,6,54,75,64,'1st','',9,0,8,7,50,74,66.5,'1st','',4,7,5,4,44,64,59.3,'2nd','',7,5,4,6,48,70,72.3,'3rd','',5,8,4,6,49,72,67.8,'2nd','','','','','','','','','','','','','','','','','','','','','',1143,'2nd',67.2,66.1,'4',3,'09035451968','student3/84141','',0,'pass'),(4,'Asuquo','Jeremiah Augustine','',5,9,8,7,47,76,68.5,'1st','',5,2,4,6,31,48,55.3,'3rd','',2,7,5,4,43,61,61.3,'2nd','',5,8,7,9,55,84,76.5,'1st','',8,7,6,4,30,55,69.3,'4th','',8,7,9,9,58,91,68,'1st','',8,5,4,7,46,70,75.8,'4th','',7,5,8,6,40,66,58,'1st','',3,4,5,2,43,57,73,'4th','',4,7,8,9,50,78,56.8,'1st','',3,8,6,4,41,62,65.8,'3rd','',8,7,5,6,44,70,65.8,'2nd','',8,4,5,6,46,69,64,'2nd','',5,7,4,6,49,71,66.5,'2nd','',5,7,5,5,39,61,59.3,'3rd','',5,8,7,9,49,78,72.3,'1st','',5,2,1,4,35,47,67.8,'4th','','','','','','','','','','','','','','','','','','','','','',1144,'1st',67.3,66.1,'5',4,'09035451968','student4/45135','',0,'pass');
/*!40000 ALTER TABLE `res_id_2019_2020_second_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_2019_2020_may`
--

DROP TABLE IF EXISTS `sales_2019_2020_may`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_2019_2020_may` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(200) NOT NULL,
  `client` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price_with_discount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_2019_2020_may`
--

LOCK TABLES `sales_2019_2020_may` WRITE;
/*!40000 ALTER TABLE `sales_2019_2020_may` DISABLE KEYS */;
INSERT INTO `sales_2019_2020_may` VALUES (1,'2019-05-06 20:44:15','White Board Marker','Taiwo Taiwo',1,110,0,110,110),(2,'2019-05-06 20:45:03','White Board Marker','Mama Taiwo',1,110,0,110,90),(3,'2019-05-06 20:46:40','Debt payment for White Board Marker','Mama Taiwo',0,0,0,0,20),(4,'2019-05-05 23:00:00','first term 2019/2020 school fees','Afiakinye, Maurice Oscar',0,0,0,0,20000),(5,'2019-05-05 23:00:00','first term 2019/2020 school fees','Afiakinye, Maurice Oscar',0,0,0,0,15000),(6,'2019-05-12 20:34:30','White Board Marker','Aishat Rufus',1,110,0,110,110),(7,'2019-05-12 20:36:11','White Board Marker','Aishat Rufus',3,110,0,330,330),(8,'2019-05-12 20:41:11','White Board Marker','Silva Effiong',2,110,0,220,220),(9,'2019-05-20 23:00:00','second term 2019/2020 school fees','Asuquo, Jeremiah Augustine',0,0,0,0,20000),(10,'2019-05-20 23:00:00','first term 2019/2020 school fees','Afiakinye, Maurice Oscar',0,0,0,0,5000),(11,'2019-05-20 23:00:00','second term 2019/2020 school fees','Afiakinye, Maurice Oscar',0,0,0,0,20000);
/*!40000 ALTER TABLE `sales_2019_2020_may` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_debtors`
--

DROP TABLE IF EXISTS `sales_debtors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_debtors` (
  `debtors_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(200) NOT NULL,
  `client` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`debtors_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_debtors`
--

LOCK TABLES `sales_debtors` WRITE;
/*!40000 ALTER TABLE `sales_debtors` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_debtors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_info`
--

DROP TABLE IF EXISTS `school_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(200) DEFAULT NULL,
  `code_name` varchar(20) DEFAULT NULL,
  `school_address` varchar(100) DEFAULT NULL,
  `motto` varchar(100) DEFAULT NULL,
  `license_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `license_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `setup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(40) DEFAULT NULL,
  `no_of_ca` int(2) DEFAULT NULL,
  `no_of_std_per_class` int(2) DEFAULT NULL,
  `ca_score` int(2) DEFAULT NULL,
  `exam_score` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_info`
--

LOCK TABLES `school_info` WRITE;
/*!40000 ALTER TABLE `school_info` DISABLE KEYS */;
INSERT INTO `school_info` VALUES (1,'Detip Model College','dmc','Agueri, Atan, Ota, Ogun State, Nigeria','learning is key','0000-00-00 00:00:00','2020-09-05 23:00:00','2019-05-05 15:55:48','detipcollege',4,30,40,60);
/*!40000 ALTER TABLE `school_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_info`
--

DROP TABLE IF EXISTS `session_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_info` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `session` varchar(10) NOT NULL DEFAULT '2018/2019',
  `term` varchar(10) NOT NULL DEFAULT 'First',
  `term_began` date NOT NULL,
  `term_ends` date NOT NULL,
  `next_term_begins` date NOT NULL,
  `next_term_ends` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_info`
--

LOCK TABLES `session_info` WRITE;
/*!40000 ALTER TABLE `session_info` DISABLE KEYS */;
INSERT INTO `session_info` VALUES (2,'2019/2020','first','2019-09-16','2019-12-20','2020-01-13','2020-04-10');
/*!40000 ALTER TABLE `session_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss 1`
--

DROP TABLE IF EXISTS `ss 1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss 1` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss 1`
--

LOCK TABLES `ss 1` WRITE;
/*!40000 ALTER TABLE `ss 1` DISABLE KEYS */;
INSERT INTO `ss 1` VALUES (1,'ENGLISH LANGUAGE','general'),(2,'MATHEMATICS','general'),(3,'LIT. IN ENGLISH','art'),(4,'ECONOMICS','general'),(5,'DATA PROCESSING','general'),(6,'CHRISTIAN REL. STUDIES','art'),(7,'AGRICULTURAL SCIENCE','science'),(8,'FRENCH','art'),(9,'MUSIC','art'),(10,'PHYSICS','science'),(11,'CHEMISTRY','science'),(12,'CIVIC EDUCATION','general'),(13,'BIOLOGY','general'),(14,'GOVERNMENT','art & comm'),(15,'COMMERCE','commercial'),(16,'ACCOUNTING','commercial'),(17,'ANIMAL HUSBANDRY','general'),(18,'FURTHER MATHEMATICS','science'),(20,'GEOGRAPHY','science'),(21,'HISTORY','art'),(22,'BOOK KEEPING','commercial'),(23,'EFIK','GENERAL');
/*!40000 ALTER TABLE `ss 1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss 2`
--

DROP TABLE IF EXISTS `ss 2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss 2` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss 2`
--

LOCK TABLES `ss 2` WRITE;
/*!40000 ALTER TABLE `ss 2` DISABLE KEYS */;
INSERT INTO `ss 2` VALUES (1,'ENGLISH LANGUAGE','general'),(3,'LIT. IN ENGLISH','art'),(4,'ECONOMICS','general'),(5,'DATA PROCESSING','general'),(6,'CHRISTIAN REL. STUDIES','art'),(7,'AGRICULTURAL SCIENCE','science'),(8,'FRENCH','art'),(9,'MUSIC','art'),(10,'PHYSICS','science'),(11,'CHEMISTRY','science'),(12,'CIVIC EDUCATION','general'),(13,'BIOLOGY','general'),(14,'GOVERNMENT','art & comm'),(15,'COMMERCE','commercial'),(16,'ACCOUNTING','commercial'),(17,'ANIMAL HUSBANDRY','general'),(18,'YORUBA','general'),(19,'FURTHER MATHEMATICS','science'),(20,'GEOGRAPHY','science'),(21,'BOOK KEEPING','commercial'),(22,'HISTORY','art'),(23,'MATHEMATICS','general');
/*!40000 ALTER TABLE `ss 2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ss 3`
--

DROP TABLE IF EXISTS `ss 3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ss 3` (
  `subject_id` int(3) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'general',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss 3`
--

LOCK TABLES `ss 3` WRITE;
/*!40000 ALTER TABLE `ss 3` DISABLE KEYS */;
INSERT INTO `ss 3` VALUES (10,'CHRISTIAN REL. STUDIES','art'),(11,'AGRICULTURAL SCIENCE','science'),(13,'MUSIC','art'),(16,'CIVIC EDUCATION','general'),(18,'GOVERNMENT','art & commercial'),(19,'COMMERCE','commercial'),(22,'MATHEMATICS','general'),(23,'BIOLOGY','general'),(24,'PHYSICS','science'),(25,'CHEMISTRY','science'),(26,'ACCOUNTING','commercial'),(27,'ANIMAL HUSBANDRY','general'),(28,'YORUBA','general'),(29,'FURTHER MATHEMATICS','science'),(30,'GEOGRAPHY','science'),(31,'BOOK KEEPING','commercial'),(32,'HISTORY','art'),(33,'ENGLISH LANGUAGE','general'),(34,'DATA PROCESSING','general'),(35,'FRENCH','art'),(36,'LIT. IN ENGLISH','art'),(37,'ECONOMICS','general');
/*!40000 ALTER TABLE `ss 3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL AUTO_INCREMENT,
  `surname` varchar(20) NOT NULL,
  `othernames` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `state_of_origin` varchar(40) NOT NULL,
  `lga_of_origin` varchar(40) NOT NULL,
  `name_of_nextofkin` varchar(60) NOT NULL,
  `relationship_with_nextofkin` varchar(20) NOT NULL,
  `phone 1` varchar(14) NOT NULL,
  `phone 2` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `residential_address` varchar(100) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `genotype` varchar(2) NOT NULL,
  `blood_group` varchar(2) NOT NULL,
  `disability` varchar(40) NOT NULL,
  `health_issue` varchar(60) NOT NULL,
  `health_issue_descr` text NOT NULL,
  `medical_fitness` varchar(60) NOT NULL,
  `medical_report` varchar(60) NOT NULL,
  `birth_certificate` varchar(60) NOT NULL,
  `certificate_of_origin` varchar(60) NOT NULL,
  `qualification` varchar(60) NOT NULL,
  `cv` varchar(60) NOT NULL,
  `status` varchar(15) NOT NULL,
  `priviledge` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL,
  `date_employed` date NOT NULL,
  `bank` varchar(60) NOT NULL,
  `account_no` varchar(11) NOT NULL,
  `account_name` varchar(60) NOT NULL,
  `salary` varchar(10) NOT NULL,
  `staff_reg_no` varchar(20) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  `passport` varchar(40) NOT NULL,
  `class` varchar(10) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'System','Administrator','M','2019-01-18','Nigerian','Akwa Ibom','Mbo','','','09035451968','08080350144','mauriceoscar58@gmail.com','Atan, Otta','','','','','','','','','','','','','','admin','','0000-00-00','','','','','admin','$2y$12$Qoq8i1Ojq9w3nI0BhyxpLeLWUerw7nkDXXx96Ftd8IM/Hrc3nbrCC','',''),(2,'Afiakinye','Maurice Oscar','Male','2000-09-09','Nigerian','Akwa Ibom','Mbo','Anne Oscar Afiakinye','Sister','09035451968','08080350144','mauriceoscar58@gmail.com','Atan, Ota','Afiakinye\'s House, Osu-Ebughu, Mbo LGA, Akwa Ibom State, Nigeria','AA','B+','None','None','','','','','','B. Eng (Petroleum Engineering)','','active','class_teacher','secretary','2019-05-05','Keystone Bank','6017326317','Afiakinye, Maurice Oscar','100000','staff2/73517','$2y$12$ieW4vHuJ7CgaMQj2i6UBj.KHxqDvOYAnIgL3Ivqze08aGXhdCGLLO','data/passport/staff2_73517.jpg','jss 1_a'),(3,'polol','Kehinde Ayo','Female','1990-06-12','Nigerian','Osun','Osun','','','08022276110','','antoniopuyol43@yahoo.com','Osun','','de','de','','','','','','','','','','active','teaching_staff','cashier','2019-05-10','','','','50000','staff3/00705','$2y$12$B6zZavqMhoAh1KAhq/aw3ekieQ7A7nuZvHJ6rIkOpPDjLee1TDEee','data/passport/staff3_00705.jpg','default_de'),(4,'Etim','Peace Asukwo','Female','1995-09-19','Nigerian','Akwa Ibom','Oron','','','09094915917','','peaceetim90@gmail.com','10 Akilo street, Oron','','de','de','','','','','','','','','','active','teaching_staff','vp_admin','2019-05-10','','','','100000','staff4/72241','$2y$12$nb210ZjAtn6NXRMYyO6F0uWQ154t29OXKp3Xgza6TpSr.OI1cpReO','','default_de');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_class`
--

DROP TABLE IF EXISTS `staff_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `arm` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_class`
--

LOCK TABLES `staff_class` WRITE;
/*!40000 ALTER TABLE `staff_class` DISABLE KEYS */;
INSERT INTO `staff_class` VALUES (1,2,'jss 1','MATHEMATICS','a'),(2,2,'ss 1','MATHEMATICS','a'),(3,2,'ss 2','PHYSICS','a'),(4,2,'ss 3','MATHEMATICS','a'),(5,2,'jss 2','MATHEMATICS','a'),(6,2,'jss 3','MATHEMATICS','a'),(7,2,'ss 2','MATHEMATICS','A'),(8,3,'jss 1','BASIC TECHNOLOGY','a'),(9,4,'jss 1','BUSINESS STUDIES','a');
/*!40000 ALTER TABLE `staff_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount_bought` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price_with_discount` int(11) NOT NULL,
  `amount_expected` int(11) NOT NULL,
  `profit_expected` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,'2019-05-06 20:43:34','White Board Marker',12,1200,110,0,110,1320,120);
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `std_id` int(10) NOT NULL AUTO_INCREMENT,
  `surname` varchar(20) NOT NULL,
  `othernames` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `state_of_origin` varchar(60) NOT NULL,
  `lga_of_origin` varchar(60) NOT NULL,
  `passport` varchar(60) NOT NULL,
  `Parent/Guardian` varchar(60) NOT NULL,
  `Phone 1` varchar(14) NOT NULL,
  `phone 2` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `residential_address` varchar(100) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `genotype` varchar(2) NOT NULL,
  `blood_group` varchar(2) NOT NULL,
  `disability` varchar(10) NOT NULL,
  `health_issue` varchar(20) NOT NULL,
  `health_issue_descr` text NOT NULL,
  `birth_certificate` varchar(60) NOT NULL,
  `medical_fitness` varchar(60) NOT NULL,
  `medical_report` varchar(60) NOT NULL,
  `certificate_of_origin` varchar(60) NOT NULL,
  `family_doctor` varchar(60) NOT NULL,
  `family_hospital` varchar(100) NOT NULL,
  `family_hospital_address` varchar(100) NOT NULL,
  `family_doctor_no` varchar(14) NOT NULL,
  `date_admitted` date NOT NULL,
  `student_reg_no` varchar(20) NOT NULL,
  `specialization` varchar(20) NOT NULL,
  `previous_school` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`std_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Afiakinye','Maurice Oscar','Male','2005-06-06','Nigerian','Ogun','Ota','data/passport/student1_27717.jpg','Mrs./Mrs. Oscar Asuquo Afiakinye','09035451968','','mauriceoscar58@gmail.com','Atan, Ota','','de','de','','','','','','','','','','','','2019-05-05','student1/27717','science','','active'),(2,'Oluwole','Taiwo Bami','Male','2006-02-14','Nigerian','Ogun','Abeokuta','data/passport/student2_57185.jpg','Mr./Mrs. Oluwole Bami','08131321343','','','Atan, Ota','','AA','B-','','','','','','','','','','','','2019-05-06','student2/57185','science','','active'),(3,'Asuquo','Janelle Augustine','Female','2015-02-15','Nigerian','Akwa Ibom','Mbo','','Mrs./Mrs. Augustine Asuquo','09035451968','','mauriceoscar58@gmail.com','Estate Road, Oron','','de','de','','','','','','','','','','','','2019-05-21','student3/84141','science','','active'),(4,'Asuquo','Jeremiah Augustine','Male','2014-02-15','Nigerian','Akwa Ibom','Mbo','','Mrs./Mrs. Augustine Asuquo','09035451968','','mauriceoscar58@gmail.com','Estate Road, Oron','','de','de','','','','','','','','','','','','2019-05-21','student4/45135','science','','active');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_class`
--

DROP TABLE IF EXISTS `student_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_class` (
  `std_id` int(10) NOT NULL AUTO_INCREMENT,
  `class_admitted` varchar(5) NOT NULL,
  `session_admitted` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `class` varchar(5) NOT NULL,
  `arm` varchar(1) NOT NULL,
  `sport_group` varchar(10) NOT NULL,
  PRIMARY KEY (`std_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_class`
--

LOCK TABLES `student_class` WRITE;
/*!40000 ALTER TABLE `student_class` DISABLE KEYS */;
INSERT INTO `student_class` VALUES (1,'jss 1','2019/2020','2019/2020','first','jss 1','a','Blue'),(2,'jss 1','2019/2020','2019/2020','first','jss 1','a','Blue'),(3,'jss 1','2019/2020','2019/2020','first','jss 1','a','Blue'),(4,'jss 1','2019/2020','2019/2020','first','jss 1','a','Blue');
/*!40000 ALTER TABLE `student_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp`
--

DROP TABLE IF EXISTS `tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp` (
  `product_name` varchar(200) NOT NULL,
  `client` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `receipt_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp`
--

LOCK TABLES `tmp` WRITE;
/*!40000 ALTER TABLE `tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-12 15:56:54
