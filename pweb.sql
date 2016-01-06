-- Progettazione Web 
DROP DATABASE if exists pweb; 
CREATE DATABASE pweb; 
USE pweb; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: pweb
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `document` int(11) NOT NULL,
  `file` int(11) NOT NULL,
  KEY `DocumentRelation` (`document`),
  KEY `FileRelation` (`file`),
  CONSTRAINT `DocumentRelation` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FileRelation` FOREIGN KEY (`file`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (1,2),(2,4),(3,6),(4,8),(5,10);
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `DeletePropagation` AFTER DELETE ON `attachments` FOR EACH ROW BEGIN
	DELETE FROM file WHERE id = OLD.file;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `author` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `cover` int(50) DEFAULT NULL,
  `price` float NOT NULL,
  `score` float DEFAULT '0',
  `votings` int(11) DEFAULT '0',
  `available` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `DocumentAuthor` (`author`),
  KEY `document_ibfk_1` (`cover`),
  CONSTRAINT `DocumentAuthor` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `document_ibfk_1` FOREIGN KEY (`cover`) REFERENCES `file` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,'Integrazione Numerica','2015-12-29 21:32:42','2015-12-29 22:04:45',8,'<DIV class=\'description\' >Dispensa sull&#039;integrazione numerica del corso di Calcolo Numerico, UniversitÃ  di Pisa,<B > Scuola Di Ingegneria.</B><DIV ><BR ></BR></DIV></DIV>',1,3,0,0,1),(2,'Progetto di database','2015-12-29 21:37:09','2016-01-01 21:50:44',11,'<DIV class=\'description\' >Relazione sulla progettazione di una base di dati per la gestione informatizzata di un ristorante.<DIV >Vengono illustrate le procedure di <U >progettazione</U> concettuale e logica.</DIV></DIV>',3,9,4,1,1),(3,'Reti sequenziali asincrone','2015-12-29 21:55:13','2015-12-29 22:04:53',12,'<DIV class=\'description\' >Reti sequenziali asincrone.<DIV >Grafi e tabelle di flusso, descrizione e sintesi ad <I >elementi neutri di ritardo</I> o <B >Latch SR.</B></DIV><DIV ><B ><BR ></BR></B></DIV><DIV ><B ><BR ></BR></B></DIV><DIV ><B >Gratuito!</B></DIV></DIV>',5,0,0,0,1),(4,'Reti sequenziali sincronizzate','2015-12-29 22:04:21','2015-12-29 22:04:58',13,'<DIV class=\'description\' >Reti sequenziali sincronizzate.<DIV >Descrizione formale di reti sequenziali sincronizzate secondo i modelli di:</DIV><DIV ><B >Moore, Mealey, Mealey Ritardato.</B></DIV><DIV >Sintesti di reti sequenziali complesse.</DIV></DIV>',7,1,0,0,1),(5,'Dispensa Orale Elettrotecnica','2015-12-30 14:59:51','2015-12-30 15:00:15',8,'<DIV class=\'description\' >Dispensa per sostenere l&#039;orale dell&#039;esame di <B >elettrotecnica </B>nel corso di laurea di Ingegneria Informatica.</DIV>',9,10,0,0,1);
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EliminaCopertinaFiles` BEFORE DELETE ON `document` FOR EACH ROW BEGIN
	DELETE FROM file WHERE id = OLD.cover OR id IN ( SELECT file FROM attachments WHERE document = OLD.id);
    UPDATE tag SET count = count -1 WHERE id IN ( SELECT tag FROM tagship WHERE document = OLD.id);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `path` varchar(90) NOT NULL,
  `size` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'intnumerica20151229093242.jpg','./uploads/documentPictures/intnumerica20151229093242.jpg',35793,'2015-12-29 21:32:42',NULL,'image/jpeg'),(2,'intnumerica20151229093242.pdf','./uploads/documentFiles/intnumerica20151229093242.pdf',192213,'2015-12-29 21:32:42',NULL,'application/pdf'),(3,'relazioneProgetto20151229093709.jpg','./uploads/documentPictures/relazioneProgetto20151229093709.jpg',7399,'2015-12-29 21:37:09',NULL,'image/jpeg'),(4,'relazioneProgetto20151229093709.pdf','./uploads/documentFiles/relazioneProgetto20151229093709.pdf',540544,'2015-12-29 21:37:09',NULL,'application/pdf'),(5,'rsa20151229095513.gif','./uploads/documentPictures/rsa20151229095513.gif',3721,'2015-12-29 21:55:13',NULL,'image/gif'),(6,'rsa20151229095513.pdf','./uploads/documentFiles/rsa20151229095513.pdf',858201,'2015-12-29 21:55:13',NULL,'application/pdf'),(7,'rss20151229100421.GIF','./uploads/documentPictures/rss20151229100421.GIF',4507,'2015-12-29 22:04:21',NULL,'image/gif'),(8,'rss20151229100421.pdf','./uploads/documentFiles/rss20151229100421.pdf',948149,'2015-12-29 22:04:21',NULL,'application/pdf'),(9,'orale_elettrotecnica20151230025951.jpg','./uploads/documentPictures/orale_elettrotecnica20151230025951.jpg',16206,'2015-12-30 14:59:51',NULL,'image/jpeg'),(10,'orale_elettrotecnica20151230025951.pdf','./uploads/documentFiles/orale_elettrotecnica20151230025951.pdf',1234067,'2015-12-30 14:59:51',NULL,'application/pdf');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followship`
--

DROP TABLE IF EXISTS `followship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followship` (
  `follower` int(11) DEFAULT NULL,
  `followed` int(11) DEFAULT NULL,
  UNIQUE KEY `follower` (`follower`,`followed`),
  KEY `FollowerId` (`follower`),
  KEY `UserFollowed` (`followed`),
  CONSTRAINT `Friender` FOREIGN KEY (`follower`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `UserFollowed` FOREIGN KEY (`followed`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UserFollower` FOREIGN KEY (`follower`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followship`
--

LOCK TABLES `followship` WRITE;
/*!40000 ALTER TABLE `followship` DISABLE KEYS */;
INSERT INTO `followship` VALUES (8,13);
/*!40000 ALTER TABLE `followship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL,
  `purchaser` int(11) NOT NULL,
  `purchased` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `DocumentPurchased` (`document`),
  KEY `DocumentPurchaser` (`purchaser`),
  CONSTRAINT `DocumentBuyer` FOREIGN KEY (`purchaser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `DocumentPurchased` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (1,2,8,'2015-12-29 22:07:25');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `businessPurchasing` BEFORE INSERT ON `purchase` FOR EACH ROW BEGIN
    DECLARE availableCredits FLOAT;
    DECLARE purchaseCost FLOAT;
    SELECT price INTO purchaseCost FROM document
    WHERE id = NEW.document;
    
    SELECT credits INTO availableCredits FROM user
    WHERE id =NEW.purchaser;
    
    IF(availableCredits < purchaseCost) THEN 
        SIGNAL SQLSTATE '45000';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER afterPurchase
AFTER INSERT ON purchase
FOR EACH ROW
BEGIN
    DECLARE purchaseCost FLOAT;
    
    SELECT price INTO purchaseCost FROM document
    WHERE id = NEW.document;
    
    UPDATE user SET credits = credits - purchaseCost
    WHERE id = NEW.purchaser;
    
    UPDATE user SET credits = credits + purchaseCost
    WHERE id = ( SELECT d.author FROM document d WHERE d.id = NEW.document);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `document` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `score` int(45) NOT NULL,
  `opinion` text,
  KEY `Reviewer` (`user`),
  KEY `DocumentReviewed` (`document`),
  CONSTRAINT `DocumentReviewed` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Reviewer` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (2,8,4,'E\' molto bello questo documento qua. Il progetto e\' molto ben svolto.');
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ratingInsert
AFTER  INSERT ON rating
FOR EACH ROW
BEGIN
    UPDATE  document SET score = score + NEW.score,
                                                        votings = votings +1 
    WHERE id = NEW.document;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ratingUpdate
AFTER UPDATE ON rating
FOR EACH ROW
BEGIN
    UPDATE document SET score = score - OLD.score,
                                                      votings = votings - 1
    WHERE id = OLD.document;
    
    UPDATE document SET score = score + NEW.score,
                                                      votings = votings +1
    WHERE id = NEW.document;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER ratingDelete
AFTER DELETE ON rating
FOR EACH ROW
BEGIN
    UPDATE document SET score = score - OLD.score,
                                                      votings = votings - 1 
    WHERE id = OLD.document;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'cia',0),(2,'Tag1',0),(3,'tag2',0),(4,'tag3',0),(5,'aga',0),(6,'Ingegneria',5),(7,'Calcolo',1),(8,'Dma',1),(9,'Database',1),(10,'Progettazione',1),(11,'Reti',2),(12,'Logiche',2),(13,'Elettrotecnica',1),(14,'Orale',1);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagship`
--

DROP TABLE IF EXISTS `tagship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagship` (
  `document` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`document`,`tag`),
  KEY `DocumentTagged` (`document`),
  KEY `TagUsed` (`tag`),
  CONSTRAINT `TagEntity` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Tagged` FOREIGN KEY (`document`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagship`
--

LOCK TABLES `tagship` WRITE;
/*!40000 ALTER TABLE `tagship` DISABLE KEYS */;
INSERT INTO `tagship` VALUES (1,6),(1,7),(1,8),(2,6),(2,9),(2,10),(3,6),(3,11),(3,12),(4,6),(4,11),(4,12),(5,6),(5,13),(5,14);
/*!40000 ALTER TABLE `tagship` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TagCountInsert
AFTER INSERT ON tagship
FOR EACH ROW
BEGIN
    UPDATE tag SET count  = count +1
    WHERE id = NEW.tag;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TagCountUpdate
AFTER UPDATE ON tagship
FOR EACH ROW
BEGIN
    UPDATE tag SET count = count -1
    WHERE id = OLD.tag;
    
    UPDATE tag SET count= count+1
    WHERE id = NEW.tag;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TagCountDelete
AFTER DELETE ON tagship
FOR EACH ROW 
BEGIN
    UPDATE tag SET count = count -1
    WHERE id = old.tag;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `credits` float NOT NULL DEFAULT '10',
  `picture` varchar(255) NOT NULL DEFAULT './img/default.png',
  `role` varchar(45) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'Federico','$2y$10$Qi4reAuh4JBZ0NCSWXL7YeqeWOMcgpeYO4i2svBmwFUajbQ/lzRYO','federico.rossi15s95@gmail.com','Federico','Rossi','1995-09-15','Italia',18,'./uploads/profilePictures/12356787_10153210866706471_1155759432190083684_o20151219122241.png','admin'),(11,'Antoine','$2y$10$7zzL4kICtZY8kVLLajSFI.vqm9.tCF8KuY0tNfhx1oG9ka8jR9kBq','antoine@antoine.com','Antonio','Biacnhi','1990-10-12','Italia',19,'./img/default.png','user'),(12,'willy99','$2y$10$8Y96IKRpq6VTD5WUSYd5/.miVlremvaiqCsIVMl22y7dpbV./Vn2W','william.green@gmail.com','William','Green','1999-10-10','Inghilterra',10,'./img/default.png','user'),(13,'ragnar','$2y$10$XbVG.lzrl36FwPgtVn5G9O2naRETLD0B/BiK6NluS8hfMT0XjzNkW','nanna@monsters.com','BryndÃ¬s','HilmarsdottÃ¬r','1980-10-10','Islanda',10,'./img/default.png','user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EliminaFollow` BEFORE DELETE ON `user` FOR EACH ROW begin
	DELETE FROM followship WHERE follower = OLD.id OR followed = OLD.id;
    UPDATE document SET price = 0 WHERE author = OLD.id;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-05 19:44:16
