-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: hotel
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb3_unicode_ci,
  `capacity` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hotel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hotel_id_idx` (`hotel_id`),
  CONSTRAINT `fk_hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'Room 1',2,'Ready',1),(2,'Room 2',2,'Cleanup',1),(3,'Room 3',2,'Ready',1),(4,'Room 4',4,'Ready',1),(5,'Room 5',1,'Ready',1),(6,'Room 6',2,'Ready',1),(7,'Room 7',4,'Ready',1),(8,'Room 8',2,'Ready',1),(9,'Room 9',2,'Ready',1),(10,'Room 10',2,'Ready',2),(11,'Room 11',2,'Dirty',2),(12,'Room 12',2,'Cleanup',2),(13,'Room 13',2,'Ready',2),(14,'Room 14',4,'Ready',2),(15,'Room 15',1,'Ready',2),(16,'Room 16',2,'Ready',2),(17,'Room 17',4,'Ready',2),(18,'Room 18',2,'Ready',2),(19,'Room 19',2,'Ready',2),(20,'Room 20',2,'Ready',2),(21,'Room 21',2,'Ready',3),(22,'Room 22',2,'Dirty',3),(23,'Room 23',2,'Cleanup',3),(24,'Room 24',2,'Ready',3),(25,'Room 25',4,'Ready',3),(26,'Room 26',1,'Ready',3),(27,'Room 27',2,'Ready',3),(28,'Room 28',4,'Ready',3),(31,'Room 20',2,'Ready',3);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-05 21:15:42
