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
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `accountCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varbinary(255) NOT NULL,
  `lastIpAddress` varbinary(50) DEFAULT NULL,
  `firstName` varbinary(255) NOT NULL,
  `lastName` varbinary(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'$2y$10$VpJl/sTxAUXbgWk50cqHuuUbgFY2osyVdDclQE9Z2xoao2VAZGo7G','2017-01-14 19:46:26','2017-01-14 19:46:26','jorisrietveld@gmail.com','127.0.0.1','Joris','Rietveld',0,1),(2,'$2y$10$FGohL.QH3cfu4K8THi/JjeSOiWdZnyqEYZRt2JhonrM4rQWX0LHFK','2017-01-14 19:46:26','2017-01-14 19:46:26','aron.soppe@student.stenden.com','127.0.0.1','Aron','Soppe',0,1),(3,'$2y$10$Bf5zkOKBFXrBpBGBW8SHkeElNWy5Z.sT0cdLcgFTTLwQ7KyrhgK8i','2017-01-14 19:46:27','2017-01-14 19:46:27','anouk.van.der.veen@student.stenden.com','127.0.0.1','Anouk','van der Veen',0,1),(4,'$2y$10$e1i2mE43Fh/i5uwzicYiKefjikN2lOh1rMsj821cw24ZxRqaXtWsa','2017-01-14 19:46:27','2017-01-14 19:46:27','kevin.veldman@student.stenden.com','127.0.0.1','Kevin','Veldman',0,1),(5,' $2y$10$WR6xWodYkmsos9nYzhyJBuyfQsOmuY1H7aF1GKPh3Px5ePQlSFSTi','2017-01-14 19:46:27','2017-01-14 19:46:27','kevin.tabak@student.stenden.com','127.0.0.1','Kevin','Tabak',0,1),(6,'$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W','2017-01-14 19:46:28','2017-01-14 19:46:28','marco.brink@student.stenden.com','127.0.0.1','Marco','Brink',0,1),(7,'$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W','2017-01-14 19:46:28','2017-01-14 19:46:28','esmee.lunenborg@student.stenden.com','127.0.0.1','Esmée','Lunenborg',0,1),(8,'$2y$10$D6f6h9SONNL8y9zqG0NMhODDV.O3lrD2H8jzklusX6NQPvWcW.4e.','2017-01-14 19:46:28','2017-01-14 19:46:28','albert.de.jonge@stenden.com','127.0.0.1','Albert','de Jonge',0,1),(9,'$2y$10$jl2.wwI6n1kqa3bfDjDZgOeIbejpl9xik6JlL3fH0xVqOGBSRHJVy','2017-01-14 19:46:28','2017-01-14 19:46:28','raymond.blankestijn@stenden.com','127.0.0.1','Raymond','Blankenstijn',0,1),(10,'$2y$10$TRCRY/29WS8.vhhjir89COsVvL422TyKRyio6/wLBb4JXx0H0eLZW','2017-01-14 19:46:28','2017-01-14 20:43:43','admin@portfoliocms.com','127.0.0.1','Root','@146.185.141.142',1,1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-18 19:03:50
