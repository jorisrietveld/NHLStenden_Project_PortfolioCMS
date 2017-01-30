-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: 85.144.187.81    Database: DigitalPortfolio
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.28-MariaDB-0+deb8u1

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
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `userId` int(10) unsigned NOT NULL,
  `address` varbinary(50) NOT NULL,
  `zipCode` varbinary(10) NOT NULL,
  `location` varbinary(100) NOT NULL,
  `dateOfBirth` varbinary(50) NOT NULL,
  `studentCode` varbinary(50) NOT NULL,
  `phoneNumber` varbinary(100) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`),
  UNIQUE KEY `studentCode` (`studentCode`),
  UNIQUE KEY `phoneNumber` (`phoneNumber`),
  CONSTRAINT `fk_student_user` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES (1,'Lageweg 50','9698BR','Wedde','30-06-1995','551473','0629300582'),(2,'Modem 19','7741MA','Coevorden','01-10-1997','498467','0632141288'),(3,'Munnekemoer oost 19','9561NN','Ter Apel','21-06-1999','521795','0629766229'),(4,'Lottinglaan 3','9451KL','Rolde','29-07-1996','555827','0642448330'),(5,'street 42','1415PI','127.0.0.1','30-07-1984','533270','0646723554'),(6,'Burgemeester Jollesstraat 7','9401LD','Assen','10-05-1996','535672','0646500174'),(7,'Langedijk 15','7913VG',' Hollandscheveld','12-08-1995','550035','');
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-18 19:03:51
