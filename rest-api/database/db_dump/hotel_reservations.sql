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
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb3_unicode_ci,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `room_id` int NOT NULL,
  `status` varchar(30) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `paid` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_reserv` (`room_id`),
  CONSTRAINT `fk_room_reserv_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (4,'Mr Semyonov','2022-12-05 12:00:00','2022-12-14 12:00:00',3,'New',0),(7,'Mr Maryanyan','2022-12-04 12:00:00','2022-12-20 00:00:00',4,'New',0),(8,'','2022-12-05 12:00:00','2022-12-20 00:00:00',5,'New',0),(9,'Anton Semyonov','2022-12-07 12:00:00','2022-12-30 00:00:00',14,'New',0),(10,'Jirayr Shirinyan','2022-12-20 12:00:00','2022-12-29 00:00:00',6,'New',0),(11,'Mr Maryanyan','2023-01-09 00:00:00','2023-01-13 00:00:00',22,'New',0),(12,'Mrs Baklachyan','2023-01-05 12:00:00','2023-01-09 00:00:00',24,'New',0),(13,'Mr Maryanyan','2023-01-07 00:00:00','2023-01-13 12:00:00',2,'New',0),(14,'Mr Maryanyan','2023-01-06 00:00:00','2023-01-09 00:00:00',22,'New',0),(19,'Mr Karen','2023-01-13 00:00:00','2023-01-20 00:00:00',4,'New',0);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-05 21:15:43
