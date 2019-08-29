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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-03 22:56:32
