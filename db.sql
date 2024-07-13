-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ukk-galeri
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `komentarfoto`
--

DROP TABLE IF EXISTS `komentarfoto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentarfoto` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`komentar_id`),
  KEY `foto_id` (`foto_id`,`user_id`),
  CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `tb_image` (`image_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentarfoto`
--

LOCK TABLES `komentarfoto` WRITE;
/*!40000 ALTER TABLE `komentarfoto` DISABLE KEYS */;
INSERT INTO `komentarfoto` VALUES
(9,48,2,'asdhasud','2024-03-05 12:18:34');
/*!40000 ALTER TABLE `komentarfoto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likefoto`
--

DROP TABLE IF EXISTS `likefoto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likefoto` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal like` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`like_id`),
  KEY `foto_id` (`image_id`,`user_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tb_image` (`image_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likefoto`
--

LOCK TABLES `likefoto` WRITE;
/*!40000 ALTER TABLE `likefoto` DISABLE KEYS */;
INSERT INTO `likefoto` VALUES
(3,47,2,'2024-03-05 16:21:58');
/*!40000 ALTER TABLE `likefoto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_admin`
--

DROP TABLE IF EXISTS `tb_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin`
--

LOCK TABLES `tb_admin` WRITE;
/*!40000 ALTER TABLE `tb_admin` DISABLE KEYS */;
INSERT INTO `tb_admin` VALUES
(2,'Okky','okky','okky','085703020654','muhammadokky580@gmail.com','Cirebon'),
(3,'Diana','diana','1234','085788992919','Diana@gmail.com','Bekasi'),
(4,'Yanti','yanti','123','085787778811','yanti@gmail.com','Cikeusik Pandeglang'),
(5,'2','2','2','0865994589','',''),
(6,'Aris','aris1','aris1','0873622122','aris123@gmail.com','ciperna'),
(7,'Bayu','bayu','bayu','0863232321`1','',''),
(8,'Ferdiansyah','ferdi','ferdi123','8938294','','');
/*!40000 ALTER TABLE `tb_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_category`
--

DROP TABLE IF EXISTS `tb_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(25) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_category`
--

LOCK TABLES `tb_category` WRITE;
/*!40000 ALTER TABLE `tb_category` DISABLE KEYS */;
INSERT INTO `tb_category` VALUES
(1,'Member JKT48'),
(17,'Satwa Liar'),
(18,'Makanan');
/*!40000 ALTER TABLE `tb_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_image`
--

DROP TABLE IF EXISTS `tb_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `image_description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`image_id`),
  KEY `category_id` (`category_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `tb_image_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tb_admin` (`admin_id`),
  CONSTRAINT `tb_image_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_image`
--

LOCK TABLES `tb_image` WRITE;
/*!40000 ALTER TABLE `tb_image` DISABLE KEYS */;
INSERT INTO `tb_image` VALUES
(1,1,'Member JKT48',2,'Okky','Freya JKT48','Member JKT48','freyajkt48.jpg',1,'2024-03-04 03:08:39'),
(43,17,'Satwa Liar',2,'Okky','HARIMAU','Harimau adalah Satwa liar yang dilindungi','foto1709524424.jpg',1,'2024-03-04 06:26:23'),
(44,1,'Member JKT48',5,'2','SHANI JKT48','member jkt48','foto1709523781.jpg',1,'2024-03-04 06:23:01'),
(46,17,'Satwa Liar',6,'Aris','Paket ayam goreng','Paketan Ayam goreng plus nasi','foto1709533335.jpg',1,'2024-03-04 06:22:23'),
(47,1,'Member JKT48',2,'Okky','ZEE JKT48','Member JKT48','foto1709537113.jpg',1,'2024-03-04 07:25:48'),
(48,1,'Member JKT48',7,'Bayu','Freya123','ff','foto1709541421.jpg',1,'2024-03-04 08:37:01'),
(49,17,'Satwa Liar',8,'Ferdiansyah','Halo bang','none','foto1709554406.png',1,'2024-03-04 12:21:10');
/*!40000 ALTER TABLE `tb_image` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-04  6:16:27
