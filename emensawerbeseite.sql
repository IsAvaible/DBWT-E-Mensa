-- MariaDB dump 10.19-11.2.2-MariaDB, for osx10.19 (arm64)
--
-- Host: localhost    Database: emensawerbeseite
-- ------------------------------------------------------
-- Server version	11.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `allergen`
--

DROP TABLE IF EXISTS `allergen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allergen` (
  `code` char(4) NOT NULL,
  `name` varchar(300) NOT NULL,
  `typ` varchar(20) NOT NULL DEFAULT 'allergen',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allergen`
--

LOCK TABLES `allergen` WRITE;
/*!40000 ALTER TABLE `allergen` DISABLE KEYS */;
INSERT INTO `allergen` VALUES
('a','Getreideprodukte','Getreide (Gluten)'),
('a1','Weizen','Allergen'),
('a2','Roggen','Allergen'),
('a3','Gerste','Allergen'),
('a4','Dinkel','Allergen'),
('a5','Hafer','Allergen'),
('a6','Kamut','Allergen'),
('b','Fisch','Allergen'),
('c','Krebstiere','Allergen'),
('d','Schwefeldioxid/Sulfit','Allergen'),
('e','Sellerie','Allergen'),
('f','Milch und Laktose','Allergen'),
('f1','Butter','Allergen'),
('f2','K├ñse','Allergen'),
('f3','Margarine','Allergen'),
('g','Sesam','Allergen'),
('h','N├╝sse','Allergen'),
('h1','Mandeln','Allergen'),
('h2','Haseln├╝sse','Allergen'),
('h3','Waln├╝sse','Allergen'),
('i','Erdn├╝sse','Allergen');
/*!40000 ALTER TABLE `allergen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benutzer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `anzahlfehler` int(11) NOT NULL DEFAULT 0,
  `anzahlanmeldungen` int(11) NOT NULL,
  `letzteanmeldung` datetime DEFAULT NULL,
  `letzterfehler` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `besucher`
--

DROP TABLE IF EXISTS `besucher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `besucher` (
  `IP` varchar(39) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `besucher`
--

LOCK TABLES `besucher` WRITE;
/*!40000 ALTER TABLE `besucher` DISABLE KEYS */;
INSERT INTO `besucher` VALUES
('::1','2023-11-19'),
('::1','2023-11-22'),
('::1','2023-11-23'),
('::1','2023-11-24'),
('127.0.0.1','2023-12-01'),
('127.0.0.1','2023-12-04'),
('::1','2023-12-04'),
('127.0.0.1','2023-12-07');
/*!40000 ALTER TABLE `besucher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ersteller_in`
--

DROP TABLE IF EXISTS `ersteller_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ersteller_in` (
  `name` char(80) DEFAULT 'anonym',
  `email` char(80) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ersteller_in`
--

LOCK TABLES `ersteller_in` WRITE;
/*!40000 ALTER TABLE `ersteller_in` DISABLE KEYS */;
INSERT INTO `ersteller_in` VALUES
('anonym','adam@paradis.himmel'),
('asdf','asdf@movie.com'),
('Eva','eva@paradis.himmel'),
('Henning Schreiber','info@schr3iber.de'),
('anonym','mario@nintendo.jp'),
('anonym','p@eter.de');
/*!40000 ALTER TABLE `ersteller_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gericht`
--

DROP TABLE IF EXISTS `gericht`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gericht` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `beschreibung` varchar(800) NOT NULL,
  `erfasst_am` date NOT NULL,
  `vegetarisch` tinyint(1) NOT NULL DEFAULT 0,
  `vegan` tinyint(1) NOT NULL DEFAULT 0,
  `preisintern` double unsigned NOT NULL,
  `preisextern` double unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `gericht_name_idx` (`name`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`preisintern` <= `preisextern`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gericht`
--

LOCK TABLES `gericht` WRITE;
/*!40000 ALTER TABLE `gericht` DISABLE KEYS */;
INSERT INTO `gericht` VALUES
(1,'Bratkartoffeln mit Speck und Zwiebeln','Kartoffeln mit Zwiebeln und gut Speck','2020-08-25',0,0,2.3,4),
(3,'Bratkartoffeln mit Zwiebeln','Kartoffeln mit Zwiebeln und ohne Speck','2020-08-25',1,1,2.3,4),
(4,'Grilltofu','Fein gew├╝rzt und mariniert','2020-08-25',1,1,2.5,4.5),
(5,'Lasagne','Klassisch mit Bologneseso├ƒe und Creme Fraiche','2020-08-24',0,0,2.5,4.5),
(6,'Lasagne vegetarisch','Klassisch mit Sojagranulatso├ƒe und Creme Fraiche','2020-08-24',1,0,2.5,4.5),
(7,'Hackbraten','Nicht nur f├╝r Hacker','2020-08-25',0,0,2.5,4),
(8,'Gem├╝sepfanne','Gesundes aus der Region, deftig angebraten','2020-08-25',1,1,2.3,4),
(9,'H├╝hnersuppe','Suppenhuhn trifft Petersilie','2020-08-25',0,0,2,3.5),
(10,'Forellenfilet','mit Kartoffeln und Dilldip','2020-08-22',0,0,3.8,5),
(11,'Kartoffel-Lauch-Suppe','der klassische Bauchw├ñrmer mit frischen Kr├ñutern','2020-08-22',1,0,2,3),
(12,'Kassler mit Rosmarinkartoffeln','dazu Salat und Senf','2020-08-23',0,0,3.8,5.2),
(13,'Drei Reibekuchen mit Apfelmus','grob geriebene Kartoffeln aus der Region','2020-08-23',1,0,2.5,4.5),
(14,'Pilzpfanne','die legend├ñre Pfanne aus Pilzen der Saison','2020-08-23',1,0,3,5),
(15,'Pilzpfanne vegan','die legend├ñre Pfanne aus Pilzen der Saison ohne K├ñse','2020-08-24',1,1,3,5),
(16,'K├ñsebr├╢tchen','schmeckt vor und nach dem Essen','2020-08-24',1,0,1,1.5),
(17,'Schinkenbr├╢tchen','schmeckt auch ohne Hunger','2020-08-25',0,0,1.25,1.75),
(18,'Tomatenbr├╢tchen','mit Schnittlauch und Zwiebeln','2020-08-25',1,1,1,1.5),
(19,'Mousse au Chocolat','sahnige schweizer Schokolade rundet jedes Essen ab','2020-08-26',1,0,1.25,1.75),
(20,'Suppenkreation ├í la Chef','was verschafft werden muss, gut und g├╝nstig','2020-08-26',0,0,0.5,0.9),
(21,'Currywurst mit Pommes','W├╝rzige Wurst in s├╝├ƒer Sauce mit knusprigen Kartoffeln','2023-11-16',0,0,2.3,4);
/*!40000 ALTER TABLE `gericht` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gericht_hat_allergen`
--

DROP TABLE IF EXISTS `gericht_hat_allergen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gericht_hat_allergen` (
  `code` char(4) DEFAULT NULL,
  `gericht_id` int(11) NOT NULL,
  KEY `code` (`code`),
  KEY `gericht_id` (`gericht_id`),
  CONSTRAINT `fk_gericht_allergen_update_cascade` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`) ON UPDATE CASCADE,
  CONSTRAINT `fk_gericht_kategorie_cascade` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`) ON DELETE CASCADE,
  CONSTRAINT `gericht_hat_allergen_ibfk_1` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`),
  CONSTRAINT `gericht_hat_allergen_ibfk_2` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gericht_hat_allergen`
--

LOCK TABLES `gericht_hat_allergen` WRITE;
/*!40000 ALTER TABLE `gericht_hat_allergen` DISABLE KEYS */;
INSERT INTO `gericht_hat_allergen` VALUES
('h',1),
('a3',1),
('a4',1),
('f1',3),
('a6',3),
('i',3),
('a3',4),
('f1',4),
('a4',4),
('h3',4),
('d',6),
('h1',7),
('a2',7),
('h3',7),
('c',7),
('a3',8),
('h3',10),
('d',10),
('f',10),
('f2',12),
('h1',12),
('a5',12),
('c',1),
('a2',9),
('i',14),
('f1',1),
('a1',15),
('a4',15),
('i',15),
('f3',15),
('h3',15);
/*!40000 ALTER TABLE `gericht_hat_allergen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gericht_hat_kategorie`
--

DROP TABLE IF EXISTS `gericht_hat_kategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gericht_hat_kategorie` (
  `gericht_id` int(11) NOT NULL,
  `kategorie_id` int(11) NOT NULL,
  PRIMARY KEY (`gericht_id`,`kategorie_id`),
  UNIQUE KEY `gericht_kategorie_unique` (`gericht_id`,`kategorie_id`),
  KEY `gericht_id` (`gericht_id`),
  KEY `kategorie_id` (`kategorie_id`),
  CONSTRAINT `fk_kategorie_gericht_restrict` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`),
  CONSTRAINT `gericht_hat_kategorie_ibfk_1` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`),
  CONSTRAINT `gericht_hat_kategorie_ibfk_2` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gericht_hat_kategorie`
--

LOCK TABLES `gericht_hat_kategorie` WRITE;
/*!40000 ALTER TABLE `gericht_hat_kategorie` DISABLE KEYS */;
INSERT INTO `gericht_hat_kategorie` VALUES
(1,3),
(3,3),
(4,3),
(5,3),
(6,3),
(7,3),
(9,3),
(16,4),
(16,5),
(17,4),
(17,5),
(18,4),
(18,5),
(21,3);
/*!40000 ALTER TABLE `gericht_hat_kategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorie`
--

DROP TABLE IF EXISTS `kategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `eltern_id` int(11) DEFAULT NULL,
  `bildname` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kategorie_eltern_restrict` (`eltern_id`),
  CONSTRAINT `fk_kategorie_eltern_restrict` FOREIGN KEY (`eltern_id`) REFERENCES `kategorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorie`
--

LOCK TABLES `kategorie` WRITE;
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` VALUES
(1,'Aktionen',NULL,'kat_aktionen.png'),
(2,'Menus',NULL,'kat_menu.gif'),
(3,'Hauptspeisen',2,'kat_menu_haupt.bmp'),
(4,'Vorspeisen',2,'kat_menu_vor.svg'),
(5,'Desserts',2,'kat_menu_dessert.pic'),
(6,'Mensastars',1,'kat_stars.tif'),
(7,'Erstiewoche',1,'kat_erties.jpg');
/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wunschgericht`
--

DROP TABLE IF EXISTS `wunschgericht`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wunschgericht` (
  `name` char(80) NOT NULL,
  `beschreibung` varchar(800) NOT NULL,
  `erfasst_am` date NOT NULL DEFAULT current_timestamp(),
  `nummer` int(11) NOT NULL AUTO_INCREMENT,
  `ersteller_in` char(80) DEFAULT NULL,
  PRIMARY KEY (`nummer`),
  KEY `ersteller_in` (`ersteller_in`),
  CONSTRAINT `wunschgericht_ibfk_1` FOREIGN KEY (`ersteller_in`) REFERENCES `ersteller_in` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wunschgericht`
--

LOCK TABLES `wunschgericht` WRITE;
/*!40000 ALTER TABLE `wunschgericht` DISABLE KEYS */;
INSERT INTO `wunschgericht` VALUES
('Hnschen mit Reis','Ich muss Muskeln aufbauen!','2023-12-04',28,'info@schr3iber.de'),
('Spaghetti Bolognese','Die Spaghetti Bolognese in dieser traditionellen Trattoria in Bologna wird mit Rinderhackfleisch Zwiebeln Mhren Sellerie Tomatenmark und Rotwein zubereitet. Die Sauce wird etwa 2 Stunden bei niedriger Temperatur gegart und hat einen intensiven wrzigen Geschmack.','2023-12-04',29,'mario@nintendo.jp'),
('Apfel','An apple a day keeps the doctor away','2023-12-04',30,'eva@paradis.himmel'),
('Pizza','Welche ist egal','2023-12-04',31,'adam@paradis.himmel'),
('Kuchen','Mit Kuchengeschmack','2023-12-04',32,'asdf@movie.com'),
('Nudeln','Nudeln mit soe','2023-12-04',33,'info@schr3iber.de');
/*!40000 ALTER TABLE `wunschgericht` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-14 10:23:00
