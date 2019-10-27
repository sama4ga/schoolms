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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-12 16:20:07
