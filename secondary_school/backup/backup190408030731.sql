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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
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
-- Table structure for table `atd_student_2018_2019_second_jss 1_a`
--

DROP TABLE IF EXISTS `atd_student_2018_2019_second_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_student_2018_2019_second_jss 1_a` (
  `dd` date NOT NULL,
  `1` varchar(2) NOT NULL DEFAULT '0',
  `2` varchar(2) NOT NULL DEFAULT '0',
  `3` varchar(2) NOT NULL DEFAULT '0',
  UNIQUE KEY `dd` (`dd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_student_2018_2019_second_jss 1_a`
--

LOCK TABLES `atd_student_2018_2019_second_jss 1_a` WRITE;
/*!40000 ALTER TABLE `atd_student_2018_2019_second_jss 1_a` DISABLE KEYS */;
/*!40000 ALTER TABLE `atd_student_2018_2019_second_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atd_student_2019_2020_first_jss 1_a`
--

DROP TABLE IF EXISTS `atd_student_2019_2020_first_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atd_student_2019_2020_first_jss 1_a` (
  `dd` date NOT NULL,
  UNIQUE KEY `dd` (`dd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atd_student_2019_2020_first_jss 1_a`
--

LOCK TABLES `atd_student_2019_2020_first_jss 1_a` WRITE;
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 1_a` DISABLE KEYS */;
/*!40000 ALTER TABLE `atd_student_2019_2020_first_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `existing_result_sheets` VALUES ('res_id_2018_2019_first_jss 1_a','jss 1','first','2018_2019','a','0000-00-00','0000-00-00','0000-00-00','0000-00-00','',''),('res_id_2018_2019_second_jss 1_a','jss 1','second','2018_2019','a','0000-00-00','0000-00-00','0000-00-00','0000-00-00','',''),('res_id_2018_2019_third_jss 1_a','jss 1','third','2018_2019','a','2019-05-06','2019-07-26','2019-09-09','2019-12-13','','');
/*!40000 ALTER TABLE `existing_result_sheets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses_2019_2020_feb`
--

DROP TABLE IF EXISTS `expenses_2019_2020_feb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses_2019_2020_feb` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(200) NOT NULL,
  `supplier` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses_2019_2020_feb`
--

LOCK TABLES `expenses_2019_2020_feb` WRITE;
/*!40000 ALTER TABLE `expenses_2019_2020_feb` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses_2019_2020_feb` ENABLE KEYS */;
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
INSERT INTO `fees` VALUES (1,20000,20000,20000,20000,20000,20000,'first','2018/2019'),(2,20000,20000,20000,20000,20000,20000,'first','2019/2020');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_2018_2019`
--

DROP TABLE IF EXISTS `fees_2018_2019`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_2018_2019` (
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
-- Dumping data for table `fees_2018_2019`
--

LOCK TABLES `fees_2018_2019` WRITE;
/*!40000 ALTER TABLE `fees_2018_2019` DISABLE KEYS */;
INSERT INTO `fees_2018_2019` VALUES (1,1,'Ojuola','Samuel Kehinde','JSS 2','A','first','20000','20000','10000','10000','5145756465JU','Access  Bank','2019-02-21','2019-02-20 23:34:18'),(2,2,'Anthony','Kehinde Ayo','JSS 2','A','first','20000','20000','15000','5000','EF56784','Keystone Bank','2019-03-22','2019-03-23 19:23:07');
/*!40000 ALTER TABLE `fees_2018_2019` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_2019_2020`
--

DROP TABLE IF EXISTS `fees_2019_2020`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_2019_2020` (
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
-- Dumping data for table `fees_2019_2020`
--

LOCK TABLES `fees_2019_2020` WRITE;
/*!40000 ALTER TABLE `fees_2019_2020` DISABLE KEYS */;
INSERT INTO `fees_2019_2020` VALUES (1,1,'Ojuola','Samuel Kehinde','JSS 2','A','first','20000','20000','1000','19000','5145756465JU','Access  Bank','2019-02-21','2019-02-21 00:59:09'),(2,1,'Ojuola','Samuel Kehinde','JSS 2','A','first','20000','20000','19000','0','5145756465RJP','Access  Bank','2019-02-21','2019-02-21 01:00:06');
/*!40000 ALTER TABLE `fees_2019_2020` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_debtors_2018_2019`
--

DROP TABLE IF EXISTS `fees_debtors_2018_2019`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_debtors_2018_2019` (
  `fees_id` int(10) NOT NULL AUTO_INCREMENT,
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `class` varchar(6) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term` varchar(10) NOT NULL,
  `fees` varchar(6) NOT NULL,
  `amount_due` varchar(6) NOT NULL,
  `balance` varchar(6) NOT NULL,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_debtors_2018_2019`
--

LOCK TABLES `fees_debtors_2018_2019` WRITE;
/*!40000 ALTER TABLE `fees_debtors_2018_2019` DISABLE KEYS */;
INSERT INTO `fees_debtors_2018_2019` VALUES (1,1,'Ojuola','Samuel Kehinde','jss 1','a','third','','',''),(2,2,'Anthony','Kehinde Ayo','jss 1','a','third','','',''),(3,3,'Oluwole','Taiwo Bami','jss 1','a','third','','',''),(4,1,'Ojuola','Samuel Kehinde','jss 1','a','third','','',''),(5,2,'Anthony','Kehinde Ayo','jss 1','a','third','','',''),(6,3,'Oluwole','Taiwo Bami','jss 1','a','third','','','');
/*!40000 ALTER TABLE `fees_debtors_2018_2019` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_debtors_2019_2020`
--

DROP TABLE IF EXISTS `fees_debtors_2019_2020`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_debtors_2019_2020` (
  `fees_id` int(10) NOT NULL AUTO_INCREMENT,
  `std_id` int(10) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `othernames` varchar(400) NOT NULL,
  `class` varchar(6) NOT NULL,
  `arm` varchar(2) NOT NULL,
  `term` varchar(10) NOT NULL,
  `fees` varchar(6) NOT NULL,
  `amount_due` varchar(6) NOT NULL,
  `balance` varchar(6) NOT NULL,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_debtors_2019_2020`
--

LOCK TABLES `fees_debtors_2019_2020` WRITE;
/*!40000 ALTER TABLE `fees_debtors_2019_2020` DISABLE KEYS */;
INSERT INTO `fees_debtors_2019_2020` VALUES (16,1,'Ojuola','Samuel Kehinde','jss 2','a','first','20000','20000','0'),(17,2,'Anthony','Kehinde Ayo','jss 2','a','first','20000','20000','20000'),(18,3,'Oluwole','Taiwo Bami','jss 2','a','first','20000','20000','20000');
/*!40000 ALTER TABLE `fees_debtors_2019_2020` ENABLE KEYS */;
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
INSERT INTO `products` VALUES (1,'New General Mathematics For Senior Secondary Schools 3',15,1700,1700,0);
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
-- Table structure for table `res_id_2018_2019_first_jss 1_a`
--

DROP TABLE IF EXISTS `res_id_2018_2019_first_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `res_id_2018_2019_first_jss 1_a` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `res_id_2018_2019_first_jss 1_a`
--

LOCK TABLES `res_id_2018_2019_first_jss 1_a` WRITE;
/*!40000 ALTER TABLE `res_id_2018_2019_first_jss 1_a` DISABLE KEYS */;
INSERT INTO `res_id_2018_2019_first_jss 1_a` VALUES (1,'Ojuola','Samuel Kehinde','',7,5,8,7,49,76,25.3,'2nd','',5,8,8,8,57,86,28.7,'3rd','',6,8,4,5,46,69,23,'3rd','',0,5,4,6,47,62,20.7,'3rd','',7,5,4,6,53,75,25,'3rd','',6,5,8,7,58,84,28,'3rd','',5,4,1,2,25,37,12.3,'3rd','',1,5,4,2,50,62,20.7,'3rd','',6,8,9,9,58,90,30,'3rd','',1,5,4,2,55,67,22.3,'3rd','',6,7,5,2,36,56,18.7,'3rd','',5,4,6,7,45,67,22.3,'3rd','',6,2,4,5,50,67,22.3,'3rd','',5,7,4,6,42,64,21.3,'3rd','',5,8,8,8,59,88,29.3,'3rd','',5,8,7,8,55,83,27.7,'3rd','',5,2,3,6,49,65,21.7,'3rd','A','B','A','C','D','C','B','C','E','E','D','E','D','D','E','E','D','B','A','A','C',1198,'2nd',70.5,23.5,'9',1,'09035451968','student1/54756','data/passport/student 81675.jpg',0,'fail'),(2,'Anthony','Kehinde Ayo','',5,5,8,7,49,74,24.7,'3rd','',5,8,8,8,57,86,28.7,'2nd','',6,8,4,5,46,69,23,'2nd','',0,5,4,6,47,62,20.7,'2nd','',7,5,4,6,53,75,25,'2nd','',6,5,8,7,58,84,28,'2nd','',5,4,1,2,25,37,12.3,'2nd','',1,5,4,2,50,62,20.7,'2nd','',6,8,9,9,58,90,30,'2nd','',1,5,4,2,55,67,22.3,'2nd','',6,7,5,2,36,56,18.7,'2nd','',5,4,6,7,45,67,22.3,'2nd','',6,2,4,5,50,67,22.3,'2nd','',5,7,4,6,42,64,21.3,'2nd','',5,8,8,8,59,88,29.3,'2nd','',5,8,7,8,55,83,27.7,'2nd','',5,2,3,6,49,65,21.7,'2nd','E','D','C','D','C','B','A','B','C','B','C','D','B','D','C','E','C','D','C','B','C',1196,'3rd',70.4,46.9,'25',2,'07060605782','student2/93216','data/passport/student 93031.jpg',0,'fail'),(3,'Oluwole','Taiwo Bami','',7,5,8,7,49,76,25.3,'1st','',5,8,8,8,57,86,28.7,'1st','',6,8,4,5,46,69,23,'1st','',0,5,4,6,47,62,20.7,'1st','',7,5,4,6,53,75,25,'1st','',6,5,8,7,58,84,28,'1st','',5,4,1,2,25,37,12.3,'1st','',1,5,4,2,50,62,20.7,'1st','',6,8,9,9,58,90,30,'1st','',1,5,4,2,55,67,22.3,'1st','',6,7,5,2,36,56,18.7,'1st','',5,4,6,7,45,67,22.3,'1st','',6,2,4,5,50,67,22.3,'1st','',5,7,4,6,42,64,21.3,'1st','',5,8,8,8,59,88,29.3,'1st','',5,8,7,8,55,83,27.7,'1st','',5,2,3,6,49,65,21.7,'1st','','','','','','','','','','','','','','','','','','','','','',1198,'1st',70.5,70.4,'21',3,'08022276110','student3/91875','data/passport/student3_91875.jpg',0,'fail');
/*!40000 ALTER TABLE `res_id_2018_2019_first_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `res_id_2018_2019_second_jss 1_a`
--

DROP TABLE IF EXISTS `res_id_2018_2019_second_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `res_id_2018_2019_second_jss 1_a` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `res_id_2018_2019_second_jss 1_a`
--

LOCK TABLES `res_id_2018_2019_second_jss 1_a` WRITE;
/*!40000 ALTER TABLE `res_id_2018_2019_second_jss 1_a` DISABLE KEYS */;
INSERT INTO `res_id_2018_2019_second_jss 1_a` VALUES (1,'Ojuola','Samuel Kehinde','applied',3,5,4,6,39,57,19,'3rd','applied',2,5,4,5,49,65,21.7,'3rd','applied',5,2,5,4,28,44,14.7,'3rd','applied',6,6,5,7,49,73,24.3,'3rd','applied',5,8,9,7,58,87,29,'3rd','applied',5,8,7,8,42,70,23.3,'3rd','applied',2,5,4,8,50,69,23,'3rd','applied',6,5,5,7,57,80,26.7,'3rd','applied',6,5,6,6,47,70,23.3,'3rd','applied',2,5,4,6,45,62,20.7,'3rd','applied',2,2,3,4,32,43,14.3,'3rd','applied',3,4,6,5,31,49,16.3,'3rd','applied',6,5,5,5,48,69,23,'3rd','applied',5,4,5,7,36,57,19,'3rd','applied',4,4,5,6,40,59,19.7,'3rd','applied',5,9,5,4,33,56,18.7,'3rd','applied',7,8,5,8,54,82,27.3,'3rd','','','','','','','','','','','','','','','','','','','','','',1092,'3rd',64.2,21.4,'9',1,'09035451968','student1/54756','data/passport/student 81675.jpg',0,'fail'),(3,'Oluwole','Taiwo Bami','applied',3,3,8,4,39,57,19,'2nd','applied',2,5,9,5,49,70,23.3,'2nd','applied',5,2,5,4,28,44,14.7,'2nd','applied',6,6,7,7,49,75,25,'2nd','applied',5,8,9,7,58,87,29,'2nd','applied',5,8,7,8,42,70,23.3,'2nd','applied',6,5,4,8,50,73,24.3,'2nd','applied',6,5,5,7,57,80,26.7,'2nd','applied',6,5,6,6,47,70,23.3,'2nd','applied',8,5,4,6,45,68,22.7,'2nd','applied',5,6,7,4,32,54,18,'2nd','applied',4,4,6,5,31,50,16.7,'2nd','applied',6,5,5,5,48,69,23,'2nd','applied',5,4,5,7,36,57,19,'2nd','applied',4,4,5,6,40,59,19.7,'2nd','applied',5,9,5,4,33,56,18.7,'2nd','applied',7,8,5,8,54,82,27.3,'2nd','','','','','','','','','','','','','','','','','','','','','',1121,'2nd',65.9,43.4,'21',5,'08022276110','student3/91875','data/passport/student3_91875.jpg',0,'fail'),(2,'Anthony','Kehinde Ayo','applied',3,5,8,6,39,61,20.3,'1st','applied',2,5,9,5,49,70,23.3,'1st','applied',5,2,5,4,28,44,14.7,'1st','applied',6,6,7,7,49,75,25,'1st','applied',5,8,9,7,58,87,29,'1st','applied',5,8,7,8,42,70,23.3,'1st','applied',6,5,4,8,50,73,24.3,'1st','applied',6,5,5,7,57,80,26.7,'1st','applied',6,5,6,6,47,70,23.3,'1st','applied',8,5,4,6,45,68,22.7,'1st','applied',5,6,7,4,32,54,18,'1st','applied',4,4,6,5,31,50,16.7,'1st','applied',6,5,5,5,48,69,23,'1st','applied',5,4,5,7,36,57,19,'1st','applied',4,4,5,6,40,59,19.7,'1st','applied',5,9,5,4,33,56,18.7,'1st','applied',7,8,5,8,54,82,27.3,'1st','','','','','','','','','','','','','','','','','','','','','',1125,'1st',66.2,65.5,'25',4,'07060605782','student2/93216','data/passport/student 93031.jpg',0,'fail');
/*!40000 ALTER TABLE `res_id_2018_2019_second_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `res_id_2018_2019_third_jss 1_a`
--

DROP TABLE IF EXISTS `res_id_2018_2019_third_jss 1_a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `res_id_2018_2019_third_jss 1_a` (
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
  `english_language_first_term` int(2) NOT NULL DEFAULT '0',
  `english_language_second_term` int(2) NOT NULL DEFAULT '0',
  `english_language_cumulative` int(2) NOT NULL DEFAULT '0',
  `mathematics_first_term` int(2) NOT NULL DEFAULT '0',
  `mathematics_second_term` int(2) NOT NULL DEFAULT '0',
  `mathematics_cumulative` int(2) NOT NULL DEFAULT '0',
  `social_studies_first_term` int(2) NOT NULL DEFAULT '0',
  `social_studies_second_term` int(2) NOT NULL DEFAULT '0',
  `social_studies_cumulative` int(2) NOT NULL DEFAULT '0',
  `business_studies_first_term` int(2) NOT NULL DEFAULT '0',
  `business_studies_second_term` int(2) NOT NULL DEFAULT '0',
  `business_studies_cumulative` int(2) NOT NULL DEFAULT '0',
  `home_economics_first_term` int(2) NOT NULL DEFAULT '0',
  `home_economics_second_term` int(2) NOT NULL DEFAULT '0',
  `home_economics_cumulative` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_first_term` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_second_term` int(2) NOT NULL DEFAULT '0',
  `christian_rel__knowledge_cumulative` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_first_term` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_second_term` int(2) NOT NULL DEFAULT '0',
  `agricultural_science_cumulative` int(2) NOT NULL DEFAULT '0',
  `basic_technology_first_term` int(2) NOT NULL DEFAULT '0',
  `basic_technology_second_term` int(2) NOT NULL DEFAULT '0',
  `basic_technology_cumulative` int(2) NOT NULL DEFAULT '0',
  `civic_education_first_term` int(2) NOT NULL DEFAULT '0',
  `civic_education_second_term` int(2) NOT NULL DEFAULT '0',
  `civic_education_cumulative` int(2) NOT NULL DEFAULT '0',
  `basic_science_first_term` int(2) NOT NULL DEFAULT '0',
  `basic_science_second_term` int(2) NOT NULL DEFAULT '0',
  `basic_science_cumulative` int(2) NOT NULL DEFAULT '0',
  `creative_arts_first_term` int(2) NOT NULL DEFAULT '0',
  `creative_arts_second_term` int(2) NOT NULL DEFAULT '0',
  `creative_arts_cumulative` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__first_term` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__second_term` int(2) NOT NULL DEFAULT '0',
  `information___comm__tech__cumulative` int(2) NOT NULL DEFAULT '0',
  `music_first_term` int(2) NOT NULL DEFAULT '0',
  `music_second_term` int(2) NOT NULL DEFAULT '0',
  `music_cumulative` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_first_term` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_second_term` int(2) NOT NULL DEFAULT '0',
  `physical___health_education_cumulative` int(2) NOT NULL DEFAULT '0',
  `french_first_term` int(2) NOT NULL DEFAULT '0',
  `french_second_term` int(2) NOT NULL DEFAULT '0',
  `french_cumulative` int(2) NOT NULL DEFAULT '0',
  `yoruba_first_term` int(2) NOT NULL DEFAULT '0',
  `yoruba_second_term` int(2) NOT NULL DEFAULT '0',
  `yoruba_cumulative` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_first_term` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_second_term` int(2) NOT NULL DEFAULT '0',
  `lit__in_english_cumulative` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `std_id` (`std_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `res_id_2018_2019_third_jss 1_a`
--

LOCK TABLES `res_id_2018_2019_third_jss 1_a` WRITE;
/*!40000 ALTER TABLE `res_id_2018_2019_third_jss 1_a` DISABLE KEYS */;
INSERT INTO `res_id_2018_2019_third_jss 1_a` VALUES (1,'Ojuola','Samuel Kehinde','applied',3,5,4,6,39,57,19,'3rd','applied',2,5,4,5,49,65,21.7,'3rd','applied',5,2,5,4,28,44,14.7,'3rd','applied',6,6,5,7,49,73,24.3,'3rd','applied',5,8,9,7,58,87,29,'3rd','applied',5,8,7,8,42,70,23.3,'3rd','applied',2,5,4,8,50,69,23,'3rd','applied',6,5,5,7,57,80,26.7,'3rd','applied',6,5,6,6,47,70,23.3,'3rd','applied',2,5,4,6,45,62,20.7,'3rd','applied',2,2,3,4,32,43,14.3,'3rd','applied',3,4,6,5,31,49,16.3,'3rd','applied',6,5,5,5,48,69,23,'3rd','applied',5,4,5,7,36,57,19,'3rd','applied',4,4,5,6,40,59,19.7,'3rd','applied',5,9,5,4,33,56,18.7,'3rd','applied',7,8,5,8,54,82,27.3,'3rd','','','','','','','','','','','','','','','','','','','','','',1092,'3rd',64.2,21.4,'9',1,'09035451968','student1/54756','data/passport/student 81675.jpg',0,'pass',76,57,63,86,65,72,69,44,52,62,73,69,75,87,83,84,70,75,37,69,58,62,80,74,90,70,77,67,62,64,56,43,47,67,49,55,67,69,68,64,57,59,88,59,69,83,56,65,65,82,76),(2,'Anthony','Kehinde Ayo','applied',3,5,4,6,39,57,19,'2nd','applied',2,5,4,5,49,65,21.7,'2nd','applied',5,2,5,4,28,44,14.7,'2nd','applied',6,6,5,7,49,73,24.3,'2nd','applied',5,8,9,7,58,87,29,'2nd','applied',5,8,7,8,42,70,23.3,'2nd','applied',2,5,4,8,50,69,23,'2nd','applied',6,5,5,7,57,80,26.7,'2nd','applied',6,5,6,6,47,70,23.3,'2nd','applied',2,5,4,6,45,62,20.7,'2nd','applied',2,2,3,4,32,43,14.3,'2nd','applied',3,4,6,5,31,49,16.3,'2nd','applied',6,5,5,5,48,69,23,'2nd','applied',5,4,5,7,36,57,19,'2nd','applied',4,4,5,6,40,59,19.7,'2nd','applied',5,9,5,4,33,56,18.7,'2nd','applied',7,8,5,8,54,82,27.3,'2nd','','','','','','','','','','','','','','','','','','','','','',1092,'2nd',64.2,42.8,'25',2,'07060605782','student2/93216','data/passport/student 93031.jpg',0,'pass',74,61,64,86,70,74,69,44,52,62,75,70,75,87,83,84,70,75,37,73,60,62,80,74,90,70,77,67,68,66,56,54,51,67,50,55,67,69,68,64,57,59,88,59,69,83,56,65,65,82,76),(3,'Oluwole','Taiwo Bami','applied',3,5,4,6,39,57,19,'1st','applied',2,5,4,5,49,65,21.7,'1st','applied',5,2,5,4,28,44,14.7,'1st','applied',6,6,5,7,49,73,24.3,'1st','applied',5,8,9,7,58,87,29,'1st','applied',5,8,7,8,42,70,23.3,'1st','applied',2,5,4,8,50,69,23,'1st','applied',6,5,5,7,57,80,26.7,'1st','applied',6,5,6,6,47,70,23.3,'1st','applied',2,5,4,6,45,62,20.7,'1st','applied',2,2,3,4,32,43,14.3,'1st','applied',3,4,6,5,31,49,16.3,'1st','applied',6,5,5,5,48,69,23,'1st','applied',5,4,5,7,36,57,19,'1st','applied',4,4,5,6,40,59,19.7,'1st','applied',5,9,5,4,33,56,18.7,'1st','applied',7,8,5,8,54,82,27.3,'1st','','','','','','','','','','','','','','','','','','','','','',1092,'1st',64.2,64.2,'21',3,'08022276110','student3/91875','data/passport/student3_91875.jpg',0,'pass',76,57,63,86,70,74,69,44,52,62,75,70,75,87,83,84,70,75,37,73,60,62,80,74,90,70,77,67,68,66,56,54,51,67,50,55,67,69,68,64,57,59,88,59,69,83,56,65,65,82,76);
/*!40000 ALTER TABLE `res_id_2018_2019_third_jss 1_a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_2019_2020_feb`
--

DROP TABLE IF EXISTS `sales_2019_2020_feb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_2019_2020_feb` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(200) NOT NULL,
  `client` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price_with_discount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_2019_2020_feb`
--

LOCK TABLES `sales_2019_2020_feb` WRITE;
/*!40000 ALTER TABLE `sales_2019_2020_feb` DISABLE KEYS */;
INSERT INTO `sales_2019_2020_feb` VALUES (1,'2019-02-20 20:59:37','New General Mathematics For Senior Secondary Schools 3','Afiakinye, Maurice Oscar',1,1700,0,1700,1700,0),(2,'2019-02-20 23:46:46','New General Mathematics For Senior Secondary Schools 3','Taiwo Taiwo',1,1700,0,1700,1700,0),(3,'2019-02-20 23:50:46','New General Mathematics For Senior Secondary Schools 3','Silva Effiong',1,1700,0,1700,1700,0),(4,'2019-02-20 23:55:11','New General Mathematics For Senior Secondary Schools 3','Silva Effiong',1,1700,0,1700,1700,0),(5,'2019-02-20 23:57:36','New General Mathematics For Senior Secondary Schools 3','Silva Effiong',1,1700,0,1700,1700,0),(6,'2019-02-21 00:01:46','New General Mathematics For Senior Secondary Schools 3','Silva Effiong',1,1700,0,1700,1700,0),(7,'2019-02-21 00:04:00','New General Mathematics For Senior Secondary Schools 3','Silva Effiong',1,1700,0,1700,1700,0),(8,'2019-02-21 00:06:17','New General Mathematics For Senior Secondary Schools 3','Mama Taiwo',1,1700,0,1700,1700,0),(9,'2019-02-20 23:00:00','first term 2019/2020 school fees','Ojuola, Samuel Kehinde',0,0,0,0,10000,0),(10,'2019-02-20 23:00:00','first term 2019/2020 school fees','Ojuola, Samuel Kehinde',0,0,0,0,1000,0),(11,'2019-02-20 23:00:00','first term 2019/2020 school fees','Ojuola, Samuel Kehinde',0,0,0,0,19000,0);
/*!40000 ALTER TABLE `sales_2019_2020_feb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_2019_2020_mar`
--

DROP TABLE IF EXISTS `sales_2019_2020_mar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_2019_2020_mar` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(200) NOT NULL,
  `client` varchar(400) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `price_with_discount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_2019_2020_mar`
--

LOCK TABLES `sales_2019_2020_mar` WRITE;
/*!40000 ALTER TABLE `sales_2019_2020_mar` DISABLE KEYS */;
INSERT INTO `sales_2019_2020_mar` VALUES (1,'2019-03-23 19:25:45','New General Mathematics For Senior Secondary Schools 3','Ojuola, Samuel Kehinde',1,1700,0,1700,1700,0);
/*!40000 ALTER TABLE `sales_2019_2020_mar` ENABLE KEYS */;
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
INSERT INTO `school_info` VALUES (1,'Detip Model School','dmc','Agueri, Atan, Ota, Ogun State, Nigeria','learning is key','detipcollege',4,30,40,60);
/*!40000 ALTER TABLE `school_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sent_messages`
--

DROP TABLE IF EXISTS `sent_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sent_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `to` varchar(100) DEFAULT NULL,
  `data` text,
  `body` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sent_messages`
--

LOCK TABLES `sent_messages` WRITE;
/*!40000 ALTER TABLE `sent_messages` DISABLE KEYS */;
INSERT INTO `sent_messages` VALUES (1,'email','Notice of Mid-Term break','some_parents','mauriceoscar58@gmail.com,mauriceafiakinye@gmail.com,,','This is to inform you of our mid-term break holding as follows:\r\nDate: Thursday 21st Feb. 2019 through Monday 25th Feb. 2019\r\n\r\n   You are expected to resume with your ward(s) fees if you are yet to do so.\r\nThanks.\r\n\r\n\r\nManagement.','2019-02-20 21:32:27','sent'),(2,'text_message','Notice of Mid-Term break','some_parents','','','2019-02-21 00:45:47','sent');
/*!40000 ALTER TABLE `sent_messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_info`
--

LOCK TABLES `session_info` WRITE;
/*!40000 ALTER TABLE `session_info` DISABLE KEYS */;
INSERT INTO `session_info` VALUES (1,'2019/2020','first','2019-01-07','2019-04-12','2019-04-29','2019-08-09');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ss 1`
--

LOCK TABLES `ss 1` WRITE;
/*!40000 ALTER TABLE `ss 1` DISABLE KEYS */;
INSERT INTO `ss 1` VALUES (1,'ENGLISH LANGUAGE','general'),(2,'MATHEMATICS','general'),(3,'LIT. IN ENGLISH','art'),(4,'ECONOMICS','general'),(5,'DATA PROCESSING','general'),(6,'CHRISTIAN REL. STUDIES','art'),(7,'AGRICULTURAL SCIENCE','science'),(8,'FRENCH','art'),(9,'MUSIC','art'),(10,'PHYSICS','science'),(11,'CHEMISTRY','science'),(12,'CIVIC EDUCATION','general'),(13,'BIOLOGY','general'),(14,'GOVERNMENT','art & comm'),(15,'COMMERCE','commercial'),(16,'ACCOUNTING','commercial'),(17,'ANIMAL HUSBANDRY','general'),(18,'FURTHER MATHEMATICS','science'),(19,'YORUBA','general'),(20,'GEOGRAPHY','science'),(21,'HISTORY','art'),(22,'BOOK KEEPING','commercial');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'System','Administrator','M','2019-01-18','Nigerian','Akwa Ibom','Mbo','','','09035451968','08080350144','mauriceoscar58@gmail.com','Atan, Otta','','','','','','','','','','','','','','admin','','0000-00-00','','','','','admin','$2y$12$Qoq8i1Ojq9w3nI0BhyxpLeLWUerw7nkDXXx96Ftd8IM/Hrc3nbrCC','',''),(2,'Etim','Edet Effiong','Male','1991-02-13','Nigerian','Akwa Ibom','Oron','','','09065390874','','edetetim34@gmail.com','Akilo street, oron','','AA','A+','','','','','','','','','','active','class_teacher','secretary','2019-03-15','','','','','staff2/03851','$2y$12$6HMdSpcgvG2vkk2lKbkU4OxuoIelM3QF7ZsFiZTZp4e4P39rlUQIi','data/passport/staff2_03851.jpg','jss 2_a');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_class`
--

LOCK TABLES `staff_class` WRITE;
/*!40000 ALTER TABLE `staff_class` DISABLE KEYS */;
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
INSERT INTO `stocks` VALUES (1,'2019-02-20 20:59:02','New General Mathematics For Senior Secondary Schools 3',20,30000,1700,0,1700,34000,4000);
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
INSERT INTO `student` VALUES (1,'Ojuola','Samuel Kehinde','Male','2009-02-18','Nigerian','Ogun','Ota','data/passport/student1_54756.jpg','Mr. Ojuola','09035451968','','mauriceoscar58@gmail.com','Ota','','de','de','','','','','','','','','','','','2019-02-10','student1/54756','science','','active'),(2,'Anthony','Kehinde Ayo','Male','1993-06-15','Nigerian','Ogun','Ota','data/passport/student2_93216.jpg','Mrs./Mrs. Anthony','07060605782','','mauriceafiakinye@gmail.com','Ota','','de','de','','','','','','','','','','','','2019-02-10','student2/93216','arts','','active'),(3,'Oluwole','Taiwo Bami','Female','1997-03-20','Nigerian','Kwara','Illorin','data/passport/student3_91875.jpg','Mrs./Mrs. Oluwole','08022276110','','taiwooluwole@gmail.com','Ota','','de','de','','','','','','','','','','','','2019-02-10','student3/91875','commercial','','active'),(4,'Oseni','Kehinde Olamide','Male','1999-04-21','Nigerian','Ogun','Ota','data/passport/student4_71054.jpg','Mr./ Mrs. Oseni','09035451968','','kehindeoseni45@gmail.com','ota','','de','de','','','','','','','','','','','','2019-04-08','student4/71054','science','','active');
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
INSERT INTO `student_class` VALUES (1,'jss 1','2018/2019','2019/2020','first','jss 2','a','default'),(2,'jss 1','2018/2019','2019/2020','first','jss 2','a','default'),(3,'jss 1','2018/2019','2019/2020','first','jss 2','a','default'),(4,'jss 2','2019/2020','2019/2020','first','jss 2','a','Blue');
/*!40000 ALTER TABLE `student_class` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-08  2:07:33
