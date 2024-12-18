/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.6.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: database
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `accommodations`
--

DROP TABLE IF EXISTS `accommodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accommodations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_id` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `id_type` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `description` text NOT NULL,
  `beds` int(2) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `id_type` (`id_type`),
  KEY `adresse_id` (`adresse_id`),
  CONSTRAINT `accommodations_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types_accommodations` (`id`),
  CONSTRAINT `accommodations_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `accommodations_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  CONSTRAINT `accommodations_ibfk_4` FOREIGN KEY (`id_type`) REFERENCES `types_accommodations` (`id`),
  CONSTRAINT `accommodations_ibfk_5` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accommodations`
--

LOCK TABLES `accommodations` WRITE;
/*!40000 ALTER TABLE `accommodations` DISABLE KEYS */;
INSERT INTO `accommodations` VALUES
(147,248,525.00,4,500,'Belle villa moderne 4 faces avec piscine',12,12,'6762aabc67c06_maison-contemporaine_onyx-version-nuit.webp'),
(148,249,350.00,1,120,'Jolie appartement haussmannien',4,12,'6762ac284f5b7_cuisine-ouverte-sur-le-salon-15_6163222.webp'),
(149,250,145.00,3,90,'Jolie Maison architecte',4,12,'6762acde562a6_oa.jpeg');
/*!40000 ALTER TABLE `accommodations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accommodations_equipments`
--

DROP TABLE IF EXISTS `accommodations_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accommodations_equipments` (
  `accommodation_id` int(11) NOT NULL,
  `equipments_id` int(11) NOT NULL,
  PRIMARY KEY (`accommodation_id`,`equipments_id`),
  KEY `equipments_id` (`equipments_id`),
  CONSTRAINT `accommodations_equipments_ibfk_1` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`),
  CONSTRAINT `accommodations_equipments_ibfk_2` FOREIGN KEY (`equipments_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `accommodations_equipments_ibfk_3` FOREIGN KEY (`equipments_id`) REFERENCES `equipments` (`id`),
  CONSTRAINT `accommodations_equipments_ibfk_4` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accommodations_equipments`
--

LOCK TABLES `accommodations_equipments` WRITE;
/*!40000 ALTER TABLE `accommodations_equipments` DISABLE KEYS */;
INSERT INTO `accommodations_equipments` VALUES
(147,1),
(148,1),
(149,1),
(147,2),
(148,2),
(149,2);
/*!40000 ALTER TABLE `accommodations_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `postal_code` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresses`
--

LOCK TABLES `adresses` WRITE;
/*!40000 ALTER TABLE `adresses` DISABLE KEYS */;
INSERT INTO `adresses` VALUES
(246,'France','Paris','3 Rue de la Tour Eiffel',75000),
(247,'France','Paris','3 Rue de la Tour Eiffel',75000),
(248,'France','Paris','13 Rue de la Tour Eiffel',75000),
(249,'France','Paris','256 Avenue des Champs Elysées',75108),
(250,'France','Vincennes','12 Rue du bois',94304);
/*!40000 ALTER TABLE `adresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipments`
--

DROP TABLE IF EXISTS `equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipments`
--

LOCK TABLES `equipments` WRITE;
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;
INSERT INTO `equipments` VALUES
(1,'Wifi'),
(2,'Grille Pain'),
(3,'Réfrigérateur'),
(4,'Plaques de cuisson ou cuisinière'),
(5,'Four'),
(6,'Micro-ondes'),
(7,'Lave-vaisselle'),
(8,'Bouilloire'),
(9,'Serviettes'),
(10,'Télévision'),
(11,'Aspirateur ou balai'),
(12,'Climatisation ou ventilateur'),
(13,'Piscine ou jacuzzi');
/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rentals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `accommodation_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accommodation_id` (`accommodation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`),
  CONSTRAINT `rentals_ibfk_3` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`),
  CONSTRAINT `rentals_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rentals`
--

LOCK TABLES `rentals` WRITE;
/*!40000 ALTER TABLE `rentals` DISABLE KEYS */;
/*!40000 ALTER TABLE `rentals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types_accommodations`
--

DROP TABLE IF EXISTS `types_accommodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types_accommodations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_accommodation` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types_accommodations`
--

LOCK TABLES `types_accommodations` WRITE;
/*!40000 ALTER TABLE `types_accommodations` DISABLE KEYS */;
INSERT INTO `types_accommodations` VALUES
(1,'Appartement'),
(2,'Chambre d\'hôte'),
(3,'Maison'),
(4,'Villa');
/*!40000 ALTER TABLE `types_accommodations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(12,'jean@pierre.com','$2y$10$0hSe4RF2EhnpFMHH8recYub.psDBzWGe/M5iVjC/49fGNMI/uFbuy','Jean','Pierre','0750145658',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-12-18 12:17:28
