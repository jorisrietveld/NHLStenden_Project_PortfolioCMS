-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
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
-- Table structure for table `GuestBookMessage`
--
SET FOREIGN_KEY_CHECKS = 0;
USE `DigitalPortfolio`;

DROP TABLE IF EXISTS `GuestBookMessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GuestBookMessage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `title` varchar(50) DEFAULT 'Reactie op portfolio',
  `message` text NOT NULL,
  `sendAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `studentId` int(10) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_guestBookMessage_student` (`studentId`),
  CONSTRAINT `fk_guestBookMessage_student` FOREIGN KEY (`studentId`) REFERENCES `Student` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GuestBookMessage`
--

LOCK TABLES `GuestBookMessage` WRITE;
/*!40000 ALTER TABLE `GuestBookMessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `GuestBookMessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Hobby`
--

DROP TABLE IF EXISTS `Hobby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Hobby` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_hobby_portfolio` (`portfolioId`),
  CONSTRAINT `fk_hobby_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Hobby`
--

LOCK TABLES `Hobby` WRITE;
/*!40000 ALTER TABLE `Hobby` DISABLE KEYS */;
INSERT INTO `Hobby` VALUES (1,'Basketbal',5),(2,'Muziek ',5),(3,'Gamen',1),(4,'Muziek',1),(5,'Boogschieten',1),(6,'Programeren',3),(7,'Fietsen',3),(8,'Festivals Organizeren',3),(9,'Tuinieren',3),(10,'Leren over AI',3),(11,'Kali Linux',3);
/*!40000 ALTER TABLE `Hobby` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Image` (
  `uploadedFileId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('GALLERY_IMAGE','PROFILE_IMAGE','PROJECT_IMAGE') NOT NULL DEFAULT 'GALLERY_IMAGE',
  `order` tinyint(2) unsigned DEFAULT '0',
  PRIMARY KEY (`uploadedFileId`),
  UNIQUE KEY `uploadedFileId` (`uploadedFileId`),
  CONSTRAINT `fk_image_uploadedFile` FOREIGN KEY (`uploadedFileId`) REFERENCES `UploadedFile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
INSERT INTO `Image` VALUES (12,'Galerij','Galerij foto','GALLERY_IMAGE',0),(13,'Profiel foto','Dit is mijn profiel foto','PROFILE_IMAGE',0);
/*!40000 ALTER TABLE `Image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `JobExperience`
--

DROP TABLE IF EXISTS `JobExperience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JobExperience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(100) NOT NULL,
  `startedAt` date DEFAULT NULL,
  `endedAt` date DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `isInternship` tinyint(1) NOT NULL DEFAULT '0',
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_jobExperience_portfolio` (`portfolioId`),
  CONSTRAINT `fk_jobExperience_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JobExperience`
--

LOCK TABLES `JobExperience` WRITE;
/*!40000 ALTER TABLE `JobExperience` DISABLE KEYS */;
INSERT INTO `JobExperience` VALUES (1,'Vanboeijen','2013-02-08','2013-06-30','Stage als financieel administrator.',1,5),(2,'Landbouwbedrijf Bruins\r\n','2014-06-01','2016-08-01','Agrarisch medewerker',0,1),(4,'Coop van der Haar','2015-09-15','2025-09-15','Vakkenvuller',0,1),(5,'J.E Tijen boomkwekerij','2011-06-01','2012-08-01','Bij J.E. Tijen boomkwekerij heb ik me bezig\r\ngehouden met het onderhoud en aanleg van\r\ntuinen en parken. Ook heb ik planten\r\nvermeerderd en verzorgd op de kwekerij',1,3),(6,'Bamboe Biesbosch','2008-01-01','2011-07-01','Bij Bamboe Biesbosch heb ik me bezig\r\ngehouden met het verzorgen, kweken en\r\naanplanten van bamboe en met het\r\nadviseren van klanten.',0,3),(7,'iMedialab','2016-02-01','2016-07-01','Tijdens deze stage heb ik een aantal mobiele\r\napplicatie ontwikkeld met Phonegap &\r\nAppmachine.',1,3),(8,'Virol','2014-08-01','2015-02-01','Tijdens mijn stage bij Virol heb ik een grote\r\napplicatie ontwikkeld voor de directie van\r\nVirol ook heb ik me bezig gehouden met het\r\nleveren van ondersteuning aan medewerkers\r\nen het onderhouden van de website van Virol\r\nen Reiswolf.',1,3),(9,'Tuincenterum Avri ','2011-06-01','2012-06-01','Tijdens deze stage heb ik meegelopen op de\r\nkwekerij van een tuincentrum Avri.',1,3),(10,'PGB Begelijder','2016-06-01','2017-01-02','Op deze werkplaats begeleid ik iemand met een persoonlijk gebonde buget om tot meer actie te komen in het huis houden en in de tuin.',0,3),(11,'App developer Schavuit media','2016-02-01','2017-01-02','De stage begeleider van iMedialab is tijdens mijn stage op zich zelf begonen maar hij had een programeur nodig die mobiele applicaties kon ontwikkelen en voeg of ik met hem samen wou gaan werken hiervoor heb ik meerdere mobiele applicaties ontwikkeld.',0,3),(12,'Nieuw-Amsterdam','2017-01-30','2017-01-30','Kassamedewerker',0,4),(13,'Uit huis','2017-01-30','2017-01-30','Volder bezorger',0,4);
/*!40000 ALTER TABLE `JobExperience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Language`
--

DROP TABLE IF EXISTS `Language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(50) NOT NULL,
  `level` tinyint(2) unsigned NOT NULL DEFAULT '10',
  `isNative` tinyint(1) NOT NULL DEFAULT '0',
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_language_portfolio` (`portfolioId`),
  CONSTRAINT `fk_language_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Language`
--

LOCK TABLES `Language` WRITE;
/*!40000 ALTER TABLE `Language` DISABLE KEYS */;
INSERT INTO `Language` VALUES (1,'Nederlands',10,1,5),(2,'Engels',8,0,5),(3,'Duits',6,0,5),(4,'Nederlands',10,1,1),(5,'Engels',8,0,1),(6,'Nederlands',8,1,3),(7,'Engels',7,0,3),(8,'Duits',4,0,3),(9,'Nederlands',10,1,4),(10,'Engels',8,0,4);
/*!40000 ALTER TABLE `Language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Page`
--

DROP TABLE IF EXISTS `Page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `themeId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_page_theme` (`themeId`),
  CONSTRAINT `fk_page_theme` FOREIGN KEY (`themeId`) REFERENCES `Theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Page`
--

LOCK TABLES `Page` WRITE;
/*!40000 ALTER TABLE `Page` DISABLE KEYS */;
INSERT INTO `Page` VALUES (1,'home','index.php','De portefolio pagina','/index',1),(2,'home','index.php','De portefolio pagina','/index',2),(3,'home','index.php','De portefolio pagina','/index',3),(4,'projecten','projecten.php','De projecten pagina','/projects',3),(5,'gastenboek','guestbook.php','De gastenboek pagina','/guestbook',3),(6,'slb opdrachten','slbOpdrachten.php','De slbOpdrachten pagina','/slb_assignments',3),(7,'home','index.php','De portefolio pagina','/index',4),(8,'home','index.php','De portefolio pagina','/index',5),(9,'home','index.php','De portefolio pagina','/index',6),(10,'home','index.php','De portefolio pagina','/index',7);
/*!40000 ALTER TABLE `Page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Portfolio`
--

DROP TABLE IF EXISTS `Portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Portfolio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themeId` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `grade` decimal(2,1) DEFAULT NULL,
  `userId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_portfolio_user` (`userId`),
  KEY `fk_portfolio_theme` (`themeId`),
  CONSTRAINT `fk_portfolio_theme` FOREIGN KEY (`themeId`) REFERENCES `Theme` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_portfolio_user` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Portfolio`
--

LOCK TABLES `Portfolio` WRITE;
/*!40000 ALTER TABLE `Portfolio` DISABLE KEYS */;
INSERT INTO `Portfolio` VALUES (1,1,'Anouk van der Veen','anouk_van_der_veen',NULL,3),(2,2,'Aron Soppe','aron_soppe',NULL,2),(3,3,'Joris Rietveld','joris_rietveld',0.0,1),(4,4,'Kevin Tabak','kevin_tabak',NULL,5),(5,5,'Marco Brink','marco_brink',NULL,6),(6,6,'Kevin Veldman','kevin_veldman',NULL,4),(7,7,'Esmee Lunenborg','esmee_lunenborg',NULL,7);
/*!40000 ALTER TABLE `Portfolio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `imageId` int(10) unsigned NOT NULL,
  `portfolioId` int(10) unsigned NOT NULL,
  `grade` decimal(2,1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_project_portfolio` (`portfolioId`),
  CONSTRAINT `fk_project_image` FOREIGN KEY (`portfolioId`) REFERENCES `Image` (`uploadedFileId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SLBAssignment`
--

DROP TABLE IF EXISTS `SLBAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SLBAssignment` (
  `uploadedFileId` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`uploadedFileId`),
  UNIQUE KEY `uploadedFileId` (`uploadedFileId`),
  CONSTRAINT `fk_slbAssignment_uploadedFile` FOREIGN KEY (`uploadedFileId`) REFERENCES `UploadedFile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SLBAssignment`
--

LOCK TABLES `SLBAssignment` WRITE;
/*!40000 ALTER TABLE `SLBAssignment` DISABLE KEYS */;
INSERT INTO `SLBAssignment` VALUES (4,'CV Joris Rietveld',''),(5,'Belbin uitslag',''),(6,'Belbin Reflectie',''),(7,'Uitdraai Progress',''),(8,'Vakatures opdracht',''),(9,'Vakatures Reflectie',''),(10,'Planning Periode 1',''),(11,'Planning Periode 2',''),(14,'Startgesprek',''),(15,'Belbin 1',''),(16,'Curriculumv Vtae',''),(17,'Belbin 2',''),(18,'studiekeuze en studievaardigheden',''),(19,'Blokplanning periode 1',''),(20,'Belbin opdracht',''),(21,'Logboek',''),(22,'Informatievaardigheden',''),(23,'Blokplanning periode 2','');
/*!40000 ALTER TABLE `SLBAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Skill`
--

DROP TABLE IF EXISTS `Skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Skill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `levelOfExperience` tinyint(2) NOT NULL DEFAULT '0',
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_skill_portfolio` (`portfolioId`),
  CONSTRAINT `fk_skill_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Skill`
--

LOCK TABLES `Skill` WRITE;
/*!40000 ALTER TABLE `Skill` DISABLE KEYS */;
INSERT INTO `Skill` VALUES (3,'PHP',10,3),(5,'Java/C#',6,3),(6,'Javascript',5,3),(7,'HTML/CSS/XML',10,3),(8,'C/C++',3,3),(9,'Linux (Ubuntu, Kali, Debian, Arch)',8,3);
/*!40000 ALTER TABLE `Skill` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `Student` VALUES (1,'Lageweg 50','9698BR','Wedde','30-06-1995','551473','0629300582'),(2,'Modem 19','7741MA','Coevorden','01-10-1997','498467','0632141288'),(3,'Munnekemoer oost 19','9561NN','Ter Apel','21-06-1999','521795','0629766229'),(4,'Lottinglaan 3','9451KL','Rolde','29-07-1996','555827','0642448330'),(5,'Wijkstraat 132','7833EH','Nieuw-Amsterdam','30-07-1998','533270','0646723554'),(6,'Burgemeester Jollesstraat 7','9401LD','Assen','10-05-1996','535672','0646500174'),(7,'Langedijk 15','7913VG',' Hollandscheveld','12-08-1995','550035','');
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Teacher`
--

DROP TABLE IF EXISTS `Teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Teacher` (
  `userId` int(10) unsigned NOT NULL,
  `isSLBer` tinyint(1) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`),
  CONSTRAINT `fk_teacher_user` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Teacher`
--

LOCK TABLES `Teacher` WRITE;
/*!40000 ALTER TABLE `Teacher` DISABLE KEYS */;
INSERT INTO `Teacher` VALUES (8,1),(9,0),(10,0);
/*!40000 ALTER TABLE `Teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Theme`
--

DROP TABLE IF EXISTS `Theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `directoryName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Theme`
--

LOCK TABLES `Theme` WRITE;
/*!40000 ALTER TABLE `Theme` DISABLE KEYS */;
INSERT INTO `Theme` VALUES (1,'Anouk\'s thema','Anouk van der Veen','Het thema gemaakt door Anouk van der Veen','Theme_anouk'),(2,'Aron\'s thema','Aron Soppe','Het thema gemaakt door Aron Soppe','Theme_aron'),(3,'joris\'s thema','Joris Rietveld','Het thema gemaakt door Joris Rietveld','Theme_joris'),(4,'Kevin Tabak\'s thema','Kevin Tabak','Het thema gemaakt door Kevin Tabak','Theme_kevinTabak'),(5,'Marco\'s thema','Marco Brink','Het thema gemaakt door Marco Brink','Theme_marco'),(6,'generics','Kevin Veldman','Het thema gemaakt door Kevin Veldman','kevin_theme'),(7,'Esmee\'s thema','Esmee Lunenborg','Het thema gemaakt door Esmee Lunenborg','Theme_Esmee');
/*!40000 ALTER TABLE `Theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Training`
--

DROP TABLE IF EXISTS `Training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Training` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `startedAt` date DEFAULT NULL,
  `finishedAt` date DEFAULT NULL,
  `description` text NOT NULL,
  `obtainedCertificate` tinyint(1) NOT NULL DEFAULT '0',
  `currentTraining` tinyint(1) NOT NULL DEFAULT '0',
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_training_portfolio` (`portfolioId`),
  CONSTRAINT `fk_training_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Training`
--

LOCK TABLES `Training` WRITE;
/*!40000 ALTER TABLE `Training` DISABLE KEYS */;
INSERT INTO `Training` VALUES (1,'VMBO-TL','Dr. Nassau College Penta','Assen','2008-07-26','2012-05-30','Het Voortgezet middelbaar onderwijs',1,0,5),(2,'Assistent-Accountancy ','Drenthe College Cicero','Assen','2012-07-26','2014-03-30','',0,0,5),(3,'Sprinthavo','Drenthe College VAVO','Assen','2014-07-26','2016-05-26','',1,0,5),(4,'General English Course(B2)','European School of English','Malta','2014-06-09','2014-06-27','20 lessons per week',1,0,5),(5,'Intensive English Course(B2)','International House Belfast','Belfast','2016-07-25','2016-08-19','100 uur aan les ',1,0,5),(6,'Cambridge English: First','International House Belfast','Belfast','2016-07-25','2016-08-19','Score:178',1,0,5),(7,'HAVO','RSG','Ter Apel','2011-09-01','2016-06-01','Voortgezet Onderwijs',1,0,1),(14,'VMBO, Landbouw en natuurlijke omgevingen','welland college','Gorinchem','2008-07-01','2011-06-15','Op deze opleiding heb ik me voorbereid op het beroep Hovenier/Kweker. Ik heb hier veel geleerd over het ontwerpen van tuinen, parken en vijvers. Ook moesten we veel planten leren te herkennen, onderhouden en vermeerderen.',1,0,3),(15,'MBO, Aankomend Hovenier','AOC Terra','Emmen','2012-06-01','2013-02-01','De opleiding is een verdieping in het beroep hovenier. Hier leerde we meer over Latijnse planten namen en de aanleg van tuinen en parken. Ik ben gestopt op deze opleiding omdat ik het werk niet uitdagend genoeg vond en ik het leuker vond om het tuinieren als hobby te houden.',0,0,3),(16,'MBO, Applicatie ontwikkelaar','Campus Winschoten','Winschoten','2014-07-01','2016-05-20','Deze opleiding leer je voor het beroep Applicatie ontwikkelaar. Ik heb deze opleiding gekozen omdat ik altijd al een passie had voor computers en ik graag een website wou kunnen ontwikkelen voor mijn palmen, bamboe en andere exoten kwekerij. Tijdens deze opleiding het ik geleerd te programmeren in PHP, Javascript en Java. Ook heb ik geleerd hoe je HTML, CSS, XML en MySQL databases moet gebruiken en hoe het ontwikkel proces binnen een bedrijf gaat.',1,0,3),(17,'HBO, Technische informatica','Stenden Hogeschool','Emmen','2016-07-20','2017-01-28','Op deze opleiding leer ik meer over het ontwikkelen van software. Na mijn opleiding Applicatie ontwikkelaar heb ik een passie gevonden voor het programmeren en ik wil er graag meer over leren. Vooral over het professioneel werken binnen de ICT zoals het schrijven van goede Functionele en Technische ontwerpen en over het ontwerpen van goede object hiërarchieën. ',0,1,3),(18,'Manager Groene Retail','Terra','Emmen','2017-01-30','2017-01-30','MBO-4',1,0,4),(19,'Het Groene LYceum','Terra','Emmen','2017-01-30','2017-01-30','GL diploma + HAVO Cijfers',1,0,4),(20,'Informatica','Stenden','Emmen','2017-01-30','2017-01-30','HBO Bachelor',0,1,4);
/*!40000 ALTER TABLE `Training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UploadedFile`
--

DROP TABLE IF EXISTS `UploadedFile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UploadedFile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileName` varchar(100) NOT NULL,
  `mimeType` varchar(20) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `portfolioId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_uploadedFile_portfolio` (`portfolioId`),
  CONSTRAINT `fk_uploadedFile_portfolio` FOREIGN KEY (`portfolioId`) REFERENCES `Portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UploadedFile`
--

LOCK TABLES `UploadedFile` WRITE;
/*!40000 ALTER TABLE `UploadedFile` DISABLE KEYS */;
INSERT INTO `UploadedFile` VALUES (3,'95fd73e0e276b76eef8bc78219bd77ed.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',5),(4,'b4cd9723d90bcf99f35ff43feb7b0df2.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(5,'7ba389581bb5c84851d425b7e281e06b.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(6,'f3747ba9248db0907077960d158628f2.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(7,'ece51584be75ae2b7739f3fcb1395e92.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(8,'96518a44271cc93b09828e461ad8b588.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(9,'cdbeaf7376ab779e803ef19435e6d306.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(10,'b47a8338ae26a351fbde6a36455af896.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(11,'97991aa28fc5a769a1d1d19b78daa009.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',3),(12,'3655bb1e7b1d21fc3726bfc700a065aa.jpg','image/jpeg','/var/www/PortefolioCMS/web/images/',1),(13,'8be3c2a9d85bec262231adac63cf99e0.jpg','image/jpeg','/var/www/PortefolioCMS/web/images/',3),(14,'d3be7176589c08be78cdf90954a733cd.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(15,'eb3e10e5bf71f2e6d4cf1275c1f08152.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',1),(16,'01f5d306ae006c336f15578460032ece.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(17,'f2b7080ac05a00c0ad3156da41a11254.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',1),(18,'a13bb93b883abe9b3e433155a9f81b70.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(19,'39e812086090e6e4200c50ded05b76d0.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(20,'a5f1dfad353de9c7cd0ea1df196cb7c9.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(21,'6cea3ff65405482a31c5289807217673.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(22,'97e81bd6455af861254016499843682b.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4),(23,'8aa032e3896719cae797fb931b51ece5.pdf','application/pdf','/var/www/PortefolioCMS/web/slbAssignments/',4);
/*!40000 ALTER TABLE `UploadedFile` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `User` VALUES (1,'$2y$10$VpJl/sTxAUXbgWk50cqHuuUbgFY2osyVdDclQE9Z2xoao2VAZGo7G','2017-01-14 19:46:26','2017-01-14 19:46:26','jorisrietveld@gmail.com','127.0.0.1','Joris','Rietveld',0,1),(2,'$2y$10$FGohL.QH3cfu4K8THi/JjeSOiWdZnyqEYZRt2JhonrM4rQWX0LHFK','2017-01-14 19:46:26','2017-01-14 19:46:26','aron.soppe@student.stenden.com','127.0.0.1','Aron','Soppe',0,1),(3,'$2y$10$Ry2BbyJ0zG0yU/VwZ/cV/eOxG6OQaLUyTCJQre1k3BBpSrISj9H5C','2017-01-14 19:46:27','2017-01-27 16:12:13','anouk.van.der.veen@student.stenden.com','127.0.0.1','Anouk','van der Veen',0,1),(4,'$2y$10$e1i2mE43Fh/i5uwzicYiKefjikN2lOh1rMsj821cw24ZxRqaXtWsa','2017-01-14 19:46:27','2017-01-14 19:46:27','kevin.veldman@student.stenden.com','127.0.0.1','Kevin','Veldman',0,1),(5,'$2y$10$79eT8EehK1zqTDC9AOQU.OaRJ9.opjD9GlqGdfdSL4nD4LC/EoE3i','2017-01-14 19:46:27','2017-01-30 12:24:09','kevin.tabak@student.stenden.com','127.0.0.1','Kevin','Tabak',0,1),(6,'$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W','2017-01-14 19:46:28','2017-01-14 19:46:28','marco.brink@student.stenden.com','127.0.0.1','Marco','Brink',0,1),(7,'$2y$10$AcVISNdt9GcEbBfI8VYB6uwPdZwNZRdl3FeuPBSVB6b8TwEX65p4W','2017-01-14 19:46:28','2017-01-14 19:46:28','esmee.lunenborg@student.stenden.com','127.0.0.1','Esmée','Lunenborg',0,1),(8,'$2y$10$D6f6h9SONNL8y9zqG0NMhODDV.O3lrD2H8jzklusX6NQPvWcW.4e.','2017-01-14 19:46:28','2017-01-14 19:46:28','albert.de.jonge@stenden.com','127.0.0.1','Albert','de Jonge',0,1),(9,'$2y$10$jl2.wwI6n1kqa3bfDjDZgOeIbejpl9xik6JlL3fH0xVqOGBSRHJVy','2017-01-14 19:46:28','2017-01-14 19:46:28','raymond.blankestijn@stenden.com','127.0.0.1','Raymond','Blankenstijn',0,1),(10,'$2y$10$TRCRY/29WS8.vhhjir89COsVvL422TyKRyio6/wLBb4JXx0H0eLZW','2017-01-14 19:46:28','2017-01-14 20:43:43','admin@portfoliocms.com','127.0.0.1','Root','@146.185.141.142',1,1);
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

-- Dump completed on 2017-01-30 21:53:22
SET FOREIGN_KEY_CHECKS = 1;