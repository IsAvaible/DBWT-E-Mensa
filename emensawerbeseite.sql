-- MariaDB dump 10.19-11.1.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: emensawerbeseite
-- ------------------------------------------------------
-- Server version	11.1.2-MariaDB

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
('f2', 'Käse', 'Allergen'),
('f3','Margarine','Allergen'),
('g','Sesam','Allergen'),
('h', 'Nüsse', 'Allergen'),
('h1','Mandeln','Allergen'),
('h2', 'Haselnüsse', 'Allergen'),
('h3', 'Walnüsse', 'Allergen'),
('i', 'Erdnüsse', 'Allergen');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer`
VALUES (1, 'Administrator', 'admin@emensa.example', '19c9449c1bd8008c83e5303231e0d06bf9a37869', 1, 0, 5,
        '2023-12-18 00:04:07', NULL);
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
('127.0.0.1', '2023-12-07'),
('::1', '2023-12-16'),
('::1', '2023-12-18'),
('::1', '2023-12-18'),
('::1', '2023-12-18');
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
  `bildname` varchar(200) DEFAULT NULL,
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
INSERT INTO `gericht`
VALUES (1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck',
        '01_bratkartoffeln_mit_speck_und_zwiebeln.jpg', '2020-08-25', 0, 0, 2.3, 4),
       (3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck',
        '02_bratkartoffeln_mit_zwiebeln.jpg', '2020-08-25', 1, 1, 2.3, 4),
       (4, 'Grilltofu', 'Fein gewürzt und mariniert', '04_grilltofu.jpg', '2020-08-25', 1, 1, 2.5, 4.5),
       (5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '05_lasagne.webp', '2020-08-24', 0, 0, 2.5, 4.5),
       (6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '06_lasagne_vegetarisch.jpg',
        '2020-08-24', 1, 0, 2.5, 4.5),
       (7, 'Hackbraten', 'Nicht nur für Hacker', '07_hackbraten.jpg', '2020-08-25', 0, 0, 2.5, 4),
       (8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '08_gemuesepfanne.webp', '2020-08-25', 1, 1,
        2.3, 4),
       (9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '09_huehnersuppe.jpg', '2020-08-25', 0, 0, 2, 3.5),
       (10, 'Forellenfilet', 'Mit Kartoffeln und Dilldip', '10_forellenfillet.jpg', '2020-08-22', 0, 0, 3.8, 5),
       (11, 'Kartoffel-Lauch-Suppe', 'Der klassische Bauchwärmer mit frischen Kräutern',
        '11_kartoffel_lauch_suppe.webp', '2020-08-22', 1, 0, 2, 3),
       (12, 'Kassler mit Rosmarinkartoffeln', 'Dazu Salat und Senf', '12_kassler_mit_rosmarinkartoffeln.jpg',
        '2020-08-23', 0, 0, 3.8, 5.2),
       (13, 'Drei Reibekuchen mit Apfelmus', 'Grob geriebene Kartoffeln aus der Region', '13_reibekuchen.jpg',
        '2020-08-23', 1, 0, 2.5, 4.5),
       (14, 'Pilzpfanne', 'Die legendäre Pfanne aus Pilzen der Saison', '14_pfilzpfanne.jpg', '2020-08-23', 1, 0, 3, 5),
       (15, 'Pilzpfanne vegan', 'Die legendäre Pfanne aus Pilzen der Saison ohne Käse', '15_pfilzpfanne_vegan.jpg',
        '2020-08-24', 1, 1, 3, 5),
       (16, 'Käsebrötchen', 'Schmeckt vor und nach dem Essen', '16_kaesebroetchen.jpg', '2020-08-24', 1, 0, 1, 1.5),
       (17, 'Schinkenbrötchen', 'Schmeckt auch ohne Hunger', '17_schinkenbroetchen.webp', '2020-08-25', 0, 0, 1.25,
        1.75),
       (18, 'Tomatenbrötchen', 'Mit Schnittlauch und Zwiebeln', '18_tomatenbroetchen.jpeg', '2020-08-25', 1, 1, 1, 1.5),
       (19, 'Mousse au Chocolat', 'Sahnige schweizer Schokolade rundet jedes Essen ab', '19_mousse_au_chocolat.jpg',
        '2020-08-26', 1, 0, 1.25, 1.75),
       (20, 'Suppenkreation à la Chef', 'Was verschafft werden muss, gut und günstig', '20_suppenkreation.jpg',
        '2020-08-26', 0, 0, 0.5, 0.9),
       (21, 'Currywurst mit Pommes', 'Würzige Wurst in süßer Sauce mit knusprigen Kartoffeln',
        '21_currywurst_mit_pommes.jpg', '2023-11-16', 0, 0, 2.3, 4);
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
-- Temporary table structure for view `view_anmeldungen`
--

DROP TABLE IF EXISTS `view_anmeldungen`;
/*!50001 DROP VIEW IF EXISTS `view_anmeldungen`*/;
SET @saved_cs_client = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_anmeldungen` AS
SELECT 1 AS `id`,
       1 AS `name`,
       1 AS `anzahlanmeldungen`
        */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_suppengericht`
--

DROP TABLE IF EXISTS `view_suppengericht`;
/*!50001 DROP VIEW IF EXISTS `view_suppengericht`*/;
SET @saved_cs_client = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_suppengericht` AS
SELECT 1 AS `id`,
       1 AS `name`,
       1 AS `beschreibung`,
       1 AS `bildname`,
       1 AS `erfasst_am`,
       1 AS `vegetarisch`,
       1 AS `vegan`,
       1 AS `preisintern`,
       1 AS `preisextern`
        */;
SET character_set_client = @saved_cs_client;

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

--
-- Final view structure for view `view_anmeldungen`
--

/*!50001 DROP VIEW IF EXISTS `view_anmeldungen`*/;
/*!50001 SET @saved_cs_client = @@character_set_client */;
/*!50001 SET @saved_cs_results = @@character_set_results */;
/*!50001 SET @saved_col_connection = @@collation_connection */;
/*!50001 SET character_set_client = utf8mb4 */;
/*!50001 SET character_set_results = utf8mb4 */;
/*!50001 SET collation_connection = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM = UNDEFINED */ /*!50013 DEFINER =`root`@`localhost` SQL SECURITY DEFINER */ /*!50001 VIEW `view_anmeldungen` AS
SELECT `benutzer`.`id` AS `id`, `benutzer`.`name` AS `name`, `benutzer`.`anzahlanmeldungen` AS `anzahlanmeldungen`
FROM `benutzer`
ORDER BY `benutzer`.`anzahlanmeldungen`
        */;
/*!50001 SET character_set_client = @saved_cs_client */;
/*!50001 SET character_set_results = @saved_cs_results */;
/*!50001 SET collation_connection = @saved_col_connection */;

--
-- Final view structure for view `view_suppengericht`
--

/*!50001 DROP VIEW IF EXISTS `view_suppengericht`*/;
/*!50001 SET @saved_cs_client = @@character_set_client */;
/*!50001 SET @saved_cs_results = @@character_set_results */;
/*!50001 SET @saved_col_connection = @@collation_connection */;
/*!50001 SET character_set_client = utf8mb4 */;
/*!50001 SET character_set_results = utf8mb4 */;
/*!50001 SET collation_connection = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM = UNDEFINED */ /*!50013 DEFINER =`root`@`localhost` SQL SECURITY DEFINER */ /*!50001 VIEW `view_suppengericht` AS
SELECT `gericht`.`id`           AS `id`,
       `gericht`.`name`         AS `name`,
       `gericht`.`beschreibung` AS `beschreibung`,
       `gericht`.`bildname`     AS `bildname`,
       `gericht`.`erfasst_am`   AS `erfasst_am`,
       `gericht`.`vegetarisch`  AS `vegetarisch`,
       `gericht`.`vegan`        AS `vegan`,
       `gericht`.`preisintern`  AS `preisintern`,
       `gericht`.`preisextern`  AS `preisextern`
FROM `gericht`
WHERE `gericht`.`name` LIKE '%suppe%'
        */;
/*!50001 SET character_set_client = @saved_cs_client */;
/*!50001 SET character_set_results = @saved_cs_results */;
/*!50001 SET collation_connection = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-18  0:04:33
