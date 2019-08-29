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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-08 13:29:42
