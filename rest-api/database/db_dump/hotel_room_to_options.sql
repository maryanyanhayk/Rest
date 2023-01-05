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
-- Table structure for table `room_to_options`
--

DROP TABLE IF EXISTS `room_to_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `room_to_options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `option_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id_idx` (`room_id`),
  KEY `option_id_idx` (`option_id`),
  CONSTRAINT `option_id` FOREIGN KEY (`option_id`) REFERENCES `room_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_to_options`
--

LOCK TABLES `room_to_options` WRITE;
/*!40000 ALTER TABLE `room_to_options` DISABLE KEYS */;
INSERT INTO `room_to_options` VALUES (1,1,2),(2,3,1),(3,5,5),(4,7,2),(5,9,4),(6,2,3),(7,4,1),(8,6,1),(9,8,2),(10,20,2),(11,19,6),(12,18,1),(13,17,5),(14,16,2),(15,15,4),(16,14,3),(17,13,1),(18,12,1),(19,11,2),(20,10,2),(23,28,5),(24,27,2),(25,26,4),(26,25,3),(27,24,1),(28,23,1),(29,22,2),(30,21,2),(31,7,4);
/*!40000 ALTER TABLE `room_to_options` ENABLE KEYS */;
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
