/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: prms
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

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
-- Table structure for table `acts`
--

DROP TABLE IF EXISTS `acts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `document` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acts`
--

LOCK TABLES `acts` WRITE;
/*!40000 ALTER TABLE `acts` DISABLE KEYS */;
/*!40000 ALTER TABLE `acts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencies`
--

LOCK TABLES `agencies` WRITE;
/*!40000 ALTER TABLE `agencies` DISABLE KEYS */;
INSERT INTO `agencies` VALUES (1,'GovTech',NULL,NULL,'2024-08-22 08:49:08','2024-08-22 08:49:08'),(2,'Ministry of Finance',NULL,NULL,'2024-08-24 21:09:36','2024-08-24 21:09:36');
/*!40000 ALTER TABLE `agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `shortCode` text NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_logs`
--

DROP TABLE IF EXISTS `attendance_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agency_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `timeIn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `leave_category_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `dated` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_logs`
--

LOCK TABLES `attendance_logs` WRITE;
/*!40000 ALTER TABLE `attendance_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_statuses`
--

DROP TABLE IF EXISTS `attendance_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'In-Office',
  `shortCode` varchar(255) DEFAULT NULL,
  `author` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_statuses`
--

LOCK TABLES `attendance_statuses` WRITE;
/*!40000 ALTER TABLE `attendance_statuses` DISABLE KEYS */;
INSERT INTO `attendance_statuses` VALUES (1,'In Office','01',1,'2023-06-10 11:22:48','2023-06-10 11:22:48'),(2,'Meeting','02',1,'2023-06-10 11:22:48','2023-06-10 11:22:48'),(3,'Holiday','03',1,'2023-06-10 11:22:48','2023-06-10 11:22:48'),(4,'Tour','04',1,'2023-06-10 11:22:48','2023-06-10 11:22:48'),(5,'Seminer','05',1,'2023-06-10 11:22:48','2023-06-10 11:22:48'),(6,'Training','06',1,'2023-06-10 11:22:48','2023-06-10 11:22:48');
/*!40000 ALTER TABLE `attendance_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `checkIn` int(11) NOT NULL,
  `inStatus` varchar(255) NOT NULL,
  `outStatus` varchar(255) DEFAULT NULL,
  `checkOut` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(255) NOT NULL,
  `inNotes` varchar(255) DEFAULT NULL,
  `outNotes` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,1724339001,'Late','Early',1724339057,0,'172.16.166.99','test att','sfgs',1,2,249,'2024-08-22 09:03:21','2024-08-22 09:04:17'),(2,1724339014,'Late',NULL,NULL,1,'172.16.166.94','t',NULL,2,6,254,'2024-08-22 09:03:34','2024-08-22 09:03:34'),(3,1724339053,'Late','Early',1724339492,0,'172.16.166.146','','',1,1,252,'2024-08-22 09:04:13','2024-08-22 09:11:32'),(4,1724339722,'Late',NULL,NULL,1,'172.16.166.146','',NULL,1,1,250,'2024-08-22 09:15:22','2024-08-22 09:15:22'),(5,1724576263,'On Time',NULL,NULL,1,'10.255.113.13','',NULL,1,2,249,'2024-08-24 20:57:43','2024-08-24 20:57:43'),(6,1724576929,'Late','Early',1724591635,0,'10.255.113.13','','',1,1,255,'2024-08-24 21:08:49','2024-08-25 01:13:55'),(7,1724577475,'Late',NULL,NULL,1,'10.255.113.12','',NULL,4,13,257,'2024-08-24 21:17:55','2024-08-24 21:17:55'),(8,1724577529,'Late',NULL,NULL,1,'10.255.113.12','',NULL,4,14,258,'2024-08-24 21:18:49','2024-08-24 21:18:49'),(9,1724580338,'Late',NULL,NULL,1,'119.2.118.131','',NULL,1,2,253,'2024-08-24 22:05:38','2024-08-24 22:05:38'),(10,1724580389,'Late',NULL,NULL,1,'119.2.118.110','',NULL,1,1,250,'2024-08-24 22:06:29','2024-08-24 22:06:29'),(11,1725357676,'Late',NULL,NULL,1,'10.255.113.53','Initial attendance',NULL,1,1,307,'2024-09-02 22:01:16','2024-09-02 22:01:16'),(12,1725357777,'Late',NULL,NULL,1,'192.168.123.49','test',NULL,1,1,327,'2024-09-02 22:02:57','2024-09-02 22:02:57'),(13,1725461457,'Late','Early',1725468946,0,'157.10.138.2','','',1,1,337,'2024-09-04 02:50:57','2024-09-04 04:55:46'),(14,1725461563,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,322,'2024-09-04 02:52:43','2024-09-04 02:52:43'),(15,1725462284,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-04 03:04:44','2024-09-04 03:04:44'),(16,1725463082,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,316,'2024-09-04 03:18:02','2024-09-04 03:18:02'),(17,1725463351,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-04 03:22:31','2024-09-04 03:22:31'),(18,1725463666,'Late',NULL,NULL,1,'10.255.113.62','',NULL,1,1,343,'2024-09-04 03:27:46','2024-09-04 03:27:46'),(19,1725465637,'Late',NULL,NULL,1,'119.2.118.127','',NULL,1,1,391,'2024-09-04 04:00:37','2024-09-04 04:00:37'),(20,1725465804,'Late','Over Time',1725473384,0,'119.2.118.128','in','Out',1,1,408,'2024-09-04 04:03:24','2024-09-04 06:09:44'),(21,1725465901,'Late',NULL,NULL,1,'157.10.138.2','in',NULL,1,1,321,'2024-09-04 04:05:01','2024-09-04 04:05:01'),(22,1725469771,'Late',NULL,NULL,1,'119.2.118.126','',NULL,1,1,407,'2024-09-04 05:09:31','2024-09-04 05:09:31'),(23,1725470526,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-04 05:22:06','2024-09-04 05:22:06'),(24,1725525307,'On Time',NULL,NULL,1,'119.2.118.1','In',NULL,1,1,408,'2024-09-04 20:35:07','2024-09-04 20:35:07'),(25,1725525654,'On Time','Over Time',1725567504,0,'119.2.125.154','','',1,1,316,'2024-09-04 20:40:54','2024-09-05 08:18:24'),(26,1725525708,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-04 20:41:48','2024-09-04 20:41:48'),(27,1725525716,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-04 20:41:56','2024-09-04 20:41:56'),(28,1725526226,'On Time','Early',1725554036,0,'157.10.138.2','','',1,1,337,'2024-09-04 20:50:26','2024-09-05 04:33:56'),(29,1725526413,'On Time','Early',1725527788,0,'157.10.138.2','','',1,1,395,'2024-09-04 20:53:33','2024-09-04 21:16:28'),(30,1725526888,'Late',NULL,NULL,1,'119.2.118.139','',NULL,1,1,343,'2024-09-04 21:01:28','2024-09-04 21:01:28'),(31,1725526984,'Late','Over Time',1725562700,0,'157.10.138.8','','',1,1,322,'2024-09-04 21:03:04','2024-09-05 06:58:20'),(32,1725527192,'Late','Over Time',1725556473,0,'157.10.138.2','','',1,1,321,'2024-09-04 21:06:32','2024-09-05 05:14:33'),(33,1725528794,'Late',NULL,NULL,1,'157.10.138.8','',NULL,1,1,345,'2024-09-04 21:33:14','2024-09-04 21:33:14'),(34,1725529151,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,429,'2024-09-04 21:39:11','2024-09-04 21:39:11'),(35,1725529239,'Late','Early',1725529777,0,'157.10.138.2','','',1,1,398,'2024-09-04 21:40:39','2024-09-04 21:49:37'),(36,1725529465,'Late',NULL,NULL,1,'157.10.138.2','September 5',NULL,2,8,266,'2024-09-04 21:44:25','2024-09-04 21:44:25'),(37,1725529701,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-04 21:48:21','2024-09-04 21:48:21'),(38,1725529765,'Late',NULL,NULL,1,'157.10.138.2','Kiran',NULL,3,11,271,'2024-09-04 21:49:25','2024-09-04 21:49:25'),(39,1725529904,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,3,323,'2024-09-04 21:51:44','2024-09-04 21:51:44'),(40,1725530013,'Late',NULL,NULL,1,'157.10.138.2','dechen',NULL,3,10,274,'2024-09-04 21:53:33','2024-09-04 21:53:33'),(41,1725531290,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,2,374,'2024-09-04 22:14:50','2024-09-04 22:14:50'),(42,1725531371,'Late',NULL,NULL,1,'157.10.138.2','test karma',NULL,2,6,378,'2024-09-04 22:16:11','2024-09-04 22:16:11'),(43,1725531663,'Late',NULL,NULL,1,'157.10.138.2','pema test',NULL,2,6,262,'2024-09-04 22:21:03','2024-09-04 22:21:03'),(44,1725531835,'Late',NULL,NULL,1,'157.10.138.2','karma jamyang test',NULL,2,6,272,'2024-09-04 22:23:55','2024-09-04 22:23:55'),(45,1725531890,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,303,'2024-09-04 22:24:50','2024-09-04 22:24:50'),(46,1725532116,'Late',NULL,NULL,1,'157.10.138.2','ganga test',NULL,2,8,278,'2024-09-04 22:28:36','2024-09-04 22:28:36'),(47,1725532123,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-04 22:28:43','2024-09-04 22:28:43'),(48,1725533402,'Late',NULL,NULL,1,'10.255.113.65','tidd',NULL,1,5,281,'2024-09-04 22:50:02','2024-09-04 22:50:02'),(49,1725547719,'Late',NULL,NULL,1,'157.10.138.2','test checkin',NULL,1,5,298,'2024-09-05 02:48:39','2024-09-05 02:48:39'),(50,1725548086,'Late',NULL,NULL,1,'157.10.138.2','Mon test',NULL,2,6,283,'2024-09-05 02:54:46','2024-09-05 02:54:46'),(51,1725548985,'Late',NULL,NULL,1,'157.10.138.2','sonam test',NULL,1,3,297,'2024-09-05 03:09:45','2024-09-05 03:09:45'),(52,1725556559,'Late','Over Time',1725556564,0,'10.255.113.75','','',1,1,417,'2024-09-05 05:15:59','2024-09-05 05:16:04'),(53,1725611561,'On Time',NULL,NULL,1,'119.2.118.136','',NULL,1,1,316,'2024-09-05 20:32:41','2024-09-05 20:32:41'),(54,1725612138,'On Time',NULL,NULL,1,'119.2.118.105','',NULL,1,1,322,'2024-09-05 20:42:18','2024-09-05 20:42:18'),(55,1725613303,'Late',NULL,NULL,1,'118.103.138.100','',NULL,1,1,343,'2024-09-05 21:01:43','2024-09-05 21:01:43'),(56,1725613305,'Late','Early',1725613314,0,'157.10.138.2','','',1,1,395,'2024-09-05 21:01:45','2024-09-05 21:01:54'),(57,1725613325,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-05 21:02:05','2024-09-05 21:02:05'),(58,1725613337,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,408,'2024-09-05 21:02:17','2024-09-05 21:02:17'),(59,1725613352,'Late','Early',1725616122,0,'157.10.138.2','','',1,1,345,'2024-09-05 21:02:32','2024-09-05 21:48:42'),(60,1725613426,'Late','Over Time',1725652868,0,'119.2.104.109','','',1,1,337,'2024-09-05 21:03:46','2024-09-06 08:01:08'),(61,1725614149,'Late',NULL,NULL,1,'119.2.118.21','',NULL,1,5,304,'2024-09-05 21:15:49','2024-09-05 21:15:49'),(62,1725614471,'Late','Early',1725641993,0,'119.2.118.121','','',1,1,321,'2024-09-05 21:21:11','2024-09-06 04:59:53'),(63,1725614530,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-05 21:22:10','2024-09-05 21:22:10'),(64,1725614548,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-05 21:22:28','2024-09-05 21:22:28'),(65,1725614655,'Late','Over Time',1725642249,0,'157.10.138.2','','',1,1,417,'2024-09-05 21:24:15','2024-09-06 05:04:09'),(66,1725614784,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-05 21:26:24','2024-09-05 21:26:24'),(67,1725615688,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,429,'2024-09-05 21:41:28','2024-09-05 21:41:28'),(68,1725894711,'Late',NULL,NULL,1,'157.10.138.2','test monday',NULL,1,1,345,'2024-09-09 03:11:51','2024-09-09 03:11:51'),(69,1725894884,'Late',NULL,NULL,1,'119.2.125.168','Kiran test',NULL,3,11,271,'2024-09-09 03:14:44','2024-09-09 03:14:44'),(70,1725895845,'Late','Early',1725896097,0,'157.10.138.4','test ugyen','test ugyen',1,4,326,'2024-09-09 03:30:45','2024-09-09 03:34:57'),(71,1725957447,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-09 20:37:27','2024-09-09 20:37:27'),(72,1725957710,'On Time','Over Time',1725998097,0,'157.10.138.2','','',1,1,316,'2024-09-09 20:41:50','2024-09-10 07:54:57'),(73,1725958491,'On Time','Over Time',1725990177,0,'157.10.138.2','','',1,1,321,'2024-09-09 20:54:51','2024-09-10 05:42:57'),(74,1725958544,'On Time','Over Time',1725990043,0,'172.16.166.165','','',1,1,337,'2024-09-09 20:55:44','2024-09-10 05:40:43'),(75,1725958595,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-09 20:56:35','2024-09-09 20:56:35'),(76,1725958753,'On Time',NULL,NULL,1,'157.10.138.8','',NULL,1,1,408,'2024-09-09 20:59:13','2024-09-09 20:59:13'),(77,1725959117,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-09 21:05:17','2024-09-09 21:05:17'),(78,1725959173,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-09 21:06:13','2024-09-09 21:06:13'),(79,1725959192,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,343,'2024-09-09 21:06:32','2024-09-09 21:06:32'),(80,1725959222,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,322,'2024-09-09 21:07:02','2024-09-09 21:07:02'),(81,1725959297,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-09 21:08:17','2024-09-09 21:08:17'),(82,1725959546,'Late','Over Time',1725990375,0,'157.10.138.2','','House',1,1,429,'2024-09-09 21:12:26','2024-09-10 05:46:15'),(83,1725961438,'Late','Over Time',1725992443,0,'157.10.138.2','','home',1,1,345,'2024-09-09 21:43:58','2024-09-10 06:20:43'),(84,1726044172,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-10 20:42:52','2024-09-10 20:42:52'),(85,1726044194,'On Time',NULL,NULL,1,'119.2.118.128','',NULL,1,1,316,'2024-09-10 20:43:14','2024-09-10 20:43:14'),(86,1726044476,'On Time',NULL,NULL,1,'157.10.138.8','',NULL,1,1,345,'2024-09-10 20:47:56','2024-09-10 20:47:56'),(87,1726044483,'On Time',NULL,NULL,1,'157.10.138.8','',NULL,1,1,307,'2024-09-10 20:48:03','2024-09-10 20:48:03'),(88,1726044996,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-10 20:56:36','2024-09-10 20:56:36'),(89,1726045468,'Late','Over Time',1726074858,0,'157.10.138.4','','',1,1,408,'2024-09-10 21:04:28','2024-09-11 05:14:18'),(90,1726045550,'Late',NULL,NULL,1,'119.2.104.36','',NULL,1,1,337,'2024-09-10 21:05:50','2024-09-10 21:05:50'),(91,1726046386,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-10 21:19:46','2024-09-10 21:19:46'),(92,1726046386,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-10 21:19:46','2024-09-10 21:19:46'),(93,1726046602,'Late',NULL,NULL,1,'157.10.138.8','',NULL,1,1,343,'2024-09-10 21:23:22','2024-09-10 21:23:22'),(94,1726046660,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,322,'2024-09-10 21:24:20','2024-09-10 21:24:20'),(95,1726051023,'Late',NULL,NULL,1,'119.2.104.36','',NULL,1,1,429,'2024-09-10 22:37:03','2024-09-10 22:37:03'),(96,1726130526,'On Time',NULL,NULL,1,'119.2.118.120','',NULL,1,1,316,'2024-09-11 20:42:06','2024-09-11 20:42:06'),(97,1726131093,'On Time',NULL,NULL,1,'119.2.118.142','',NULL,1,1,307,'2024-09-11 20:51:33','2024-09-11 20:51:33'),(98,1726131172,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,337,'2024-09-11 20:52:52','2024-09-11 20:52:52'),(99,1726131445,'On Time',NULL,NULL,1,'119.2.118.130','',NULL,1,1,345,'2024-09-11 20:57:25','2024-09-11 20:57:25'),(100,1726131496,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,343,'2024-09-11 20:58:16','2024-09-11 20:58:16'),(101,1726131499,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,322,'2024-09-11 20:58:19','2024-09-11 20:58:19'),(102,1726131530,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-11 20:58:50','2024-09-11 20:58:50'),(103,1726131617,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-11 21:00:17','2024-09-11 21:00:17'),(104,1726131915,'Late',NULL,NULL,1,'119.2.118.125','',NULL,1,1,408,'2024-09-11 21:05:15','2024-09-11 21:05:15'),(105,1726132498,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,321,'2024-09-11 21:14:58','2024-09-11 21:14:58'),(106,1726132886,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-11 21:21:26','2024-09-11 21:21:26'),(107,1726134035,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-11 21:40:35','2024-09-11 21:40:35'),(108,1726140642,'Late',NULL,NULL,1,'119.2.104.36','',NULL,1,1,429,'2024-09-11 23:30:42','2024-09-11 23:30:42'),(109,1726475846,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-15 20:37:26','2024-09-15 20:37:26'),(110,1726476088,'On Time',NULL,NULL,1,'119.2.118.140','',NULL,1,1,316,'2024-09-15 20:41:28','2024-09-15 20:41:28'),(111,1726476966,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,408,'2024-09-15 20:56:06','2024-09-15 20:56:06'),(112,1726477127,'On Time',NULL,NULL,1,'172.16.166.116','',NULL,1,1,337,'2024-09-15 20:58:47','2024-09-15 20:58:47'),(113,1726477324,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-15 21:02:04','2024-09-15 21:02:04'),(114,1726477333,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,345,'2024-09-15 21:02:13','2024-09-15 21:02:13'),(115,1726477406,'Late','Over Time',1726507712,0,'157.10.138.2','','',1,1,417,'2024-09-15 21:03:26','2024-09-16 05:28:32'),(116,1726477676,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-15 21:07:56','2024-09-15 21:07:56'),(117,1726477904,'Late','Over Time',1726508703,0,'157.10.138.2','','',1,1,322,'2024-09-15 21:11:44','2024-09-16 05:45:03'),(118,1726477923,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,398,'2024-09-15 21:12:03','2024-09-15 21:12:03'),(119,1726477983,'Late',NULL,NULL,1,'119.2.118.8','',NULL,1,1,343,'2024-09-15 21:13:03','2024-09-15 21:13:03'),(120,1726478009,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-15 21:13:29','2024-09-15 21:13:29'),(121,1726478632,'Late',NULL,NULL,1,'119.2.118.145','',NULL,1,1,429,'2024-09-15 21:23:52','2024-09-15 21:23:52'),(122,1726479249,'Late','Over Time',1726511779,0,'157.10.138.2','','',1,1,321,'2024-09-15 21:34:09','2024-09-16 06:36:19'),(123,1726480343,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-15 21:52:23','2024-09-15 21:52:23'),(124,1726498613,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,317,'2024-09-16 02:56:53','2024-09-16 02:56:53'),(125,1726559821,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,395,'2024-09-16 19:57:01','2024-09-16 19:57:01'),(126,1726562497,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,391,'2024-09-16 20:41:37','2024-09-16 20:41:37'),(127,1726562704,'On Time',NULL,NULL,1,'119.2.118.148','',NULL,1,1,316,'2024-09-16 20:45:04','2024-09-16 20:45:04'),(128,1726562790,'On Time',NULL,NULL,1,'172.16.166.241','',NULL,1,1,337,'2024-09-16 20:46:30','2024-09-16 20:46:30'),(129,1726562903,'On Time','Over Time',1726594268,0,'157.10.138.2','','',1,1,321,'2024-09-16 20:48:23','2024-09-17 05:31:08'),(130,1726563181,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,307,'2024-09-16 20:53:01','2024-09-16 20:53:01'),(131,1726563523,'On Time',NULL,NULL,1,'172.16.163.111','',NULL,1,1,345,'2024-09-16 20:58:43','2024-09-16 20:58:43'),(132,1726563591,'On Time',NULL,NULL,1,'157.10.138.2','',NULL,1,1,398,'2024-09-16 20:59:51','2024-09-16 20:59:51'),(133,1726563721,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,408,'2024-09-16 21:02:01','2024-09-16 21:02:01'),(134,1726564232,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,327,'2024-09-16 21:10:32','2024-09-16 21:10:32'),(135,1726564305,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,343,'2024-09-16 21:11:45','2024-09-16 21:11:45'),(136,1726564366,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,429,'2024-09-16 21:12:46','2024-09-16 21:12:46'),(137,1726564462,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,412,'2024-09-16 21:14:22','2024-09-16 21:14:22'),(138,1726564494,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,317,'2024-09-16 21:14:54','2024-09-16 21:14:54'),(139,1726564730,'Late','Over Time',1726594214,0,'157.10.138.2','','',1,1,417,'2024-09-16 21:18:50','2024-09-17 05:30:14'),(140,1726565348,'Late',NULL,NULL,1,'157.10.138.2','',NULL,1,1,322,'2024-09-16 21:29:08','2024-09-16 21:29:08');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committeedocuments`
--

DROP TABLE IF EXISTS `committeedocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `committeedocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `committee_id` bigint(20) NOT NULL,
  `sub_cat_id` bigint(20) NOT NULL,
  `parliament_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committeedocuments`
--

LOCK TABLES `committeedocuments` WRITE;
/*!40000 ALTER TABLE `committeedocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `committeedocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committeemembers`
--

DROP TABLE IF EXISTS `committeemembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `committeemembers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `committee_id` bigint(20) NOT NULL,
  `parliament_id` bigint(20) NOT NULL,
  `committee_member_from` varchar(255) NOT NULL,
  `comm_designation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committeemembers`
--

LOCK TABLES `committeemembers` WRITE;
/*!40000 ALTER TABLE `committeemembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `committeemembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committees`
--

DROP TABLE IF EXISTS `committees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `committees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committees`
--

LOCK TABLES `committees` WRITE;
/*!40000 ALTER TABLE `committees` DISABLE KEYS */;
/*!40000 ALTER TABLE `committees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committeesubfolderdocuments`
--

DROP TABLE IF EXISTS `committeesubfolderdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `committeesubfolderdocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` varchar(255) NOT NULL,
  `committee_id` bigint(20) NOT NULL,
  `sub_folder_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committeesubfolderdocuments`
--

LOCK TABLES `committeesubfolderdocuments` WRITE;
/*!40000 ALTER TABLE `committeesubfolderdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `committeesubfolderdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committeesubfolders`
--

DROP TABLE IF EXISTS `committeesubfolders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `committeesubfolders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `committee_id` bigint(20) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committeesubfolders`
--

LOCK TABLES `committeesubfolders` WRITE;
/*!40000 ALTER TABLE `committeesubfolders` DISABLE KEYS */;
/*!40000 ALTER TABLE `committeesubfolders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferencehallbookings`
--

DROP TABLE IF EXISTS `conferencehallbookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conferencehallbookings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferencehallbookings`
--

LOCK TABLES `conferencehallbookings` WRITE;
/*!40000 ALTER TABLE `conferencehallbookings` DISABLE KEYS */;
INSERT INTO `conferencehallbookings` VALUES (168,7,395,'2024-09-13 03:00:00','2024-09-13 11:00:00','Discussion on Trade Facilitation EA','2024-09-05 09:16:27','2024-09-05 09:16:27');
/*!40000 ALTER TABLE `conferencehallbookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferencehalls`
--

DROP TABLE IF EXISTS `conferencehalls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conferencehalls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferencehalls`
--

LOCK TABLES `conferencehalls` WRITE;
/*!40000 ALTER TABLE `conferencehalls` DISABLE KEYS */;
INSERT INTO `conferencehalls` VALUES (1,'GovTech Conference Hall A','2023-05-05 03:21:58','2024-08-06 05:02:42'),(2,'GovTech Conference Hall B','2023-05-05 03:21:58','2024-08-06 05:02:48'),(7,'GovTech Conference Hall C','2024-08-05 09:18:51','2024-08-06 05:02:53');
/*!40000 ALTER TABLE `conferencehalls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constituencies`
--

DROP TABLE IF EXISTS `constituencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `constituencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'Khar-Yurung',
  `shortCode` varchar(255) DEFAULT NULL,
  `author` bigint(20) NOT NULL,
  `dzongkhag_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constituencies`
--

LOCK TABLES `constituencies` WRITE;
/*!40000 ALTER TABLE `constituencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `constituencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `agency_id` bigint(20) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Department of Digital Transformation',1,NULL,'1','2024-08-22 08:49:38','2024-09-01 22:07:35'),(2,'Department of Digital Infrastructure',1,NULL,'1','2024-08-22 08:50:48','2024-09-01 22:07:52'),(3,'Secretariat',1,NULL,'1','2024-08-22 08:51:51','2024-08-22 08:51:51'),(4,'DTA',2,NULL,'1','2024-08-24 21:09:45','2024-08-24 21:09:45'),(6,'DPP',2,NULL,'1','2024-08-24 21:11:21','2024-08-24 21:11:21');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatch_receive_numbers`
--

DROP TABLE IF EXISTS `dispatch_receive_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispatch_receive_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dORr` bigint(20) NOT NULL,
  `dr_num` bigint(20) NOT NULL,
  `year` varchar(255) NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispatch_receive_numbers`
--

LOCK TABLES `dispatch_receive_numbers` WRITE;
/*!40000 ALTER TABLE `dispatch_receive_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispatch_receive_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatchletters`
--

DROP TABLE IF EXISTS `dispatchletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispatchletters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `from_agency_id` bigint(20) DEFAULT NULL,
  `from_department_id` bigint(20) DEFAULT NULL,
  `from_division_id` bigint(20) DEFAULT NULL,
  `dispatch_number` varchar(255) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `to_adressed` varchar(255) DEFAULT NULL,
  `to_agency` varchar(255) DEFAULT NULL,
  `to_department` varchar(255) DEFAULT NULL,
  `to_division` varchar(255) DEFAULT NULL,
  `to_place` varchar(255) DEFAULT NULL,
  `to_subject` varchar(255) DEFAULT NULL,
  `file_index` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispatchletters`
--

LOCK TABLES `dispatchletters` WRITE;
/*!40000 ALTER TABLE `dispatchletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispatchletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `status` bigint(20) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'DSOM',1,NULL,1,NULL,'2024-08-22 08:49:54','2024-08-22 08:49:54'),(2,'DSD',1,NULL,1,NULL,'2024-08-22 08:50:04','2024-08-22 08:50:04'),(3,'DST',1,NULL,1,NULL,'2024-08-22 08:50:10','2024-08-22 08:50:10'),(4,'ETD',1,NULL,1,NULL,'2024-08-22 08:50:19','2024-08-22 08:50:19'),(5,'TIDD',1,NULL,1,NULL,'2024-08-22 08:50:29','2024-08-22 08:50:29'),(6,'GovNet',2,NULL,1,NULL,'2024-08-22 08:51:02','2024-08-22 08:51:02'),(7,'CSD',2,NULL,1,NULL,'2024-08-22 08:51:11','2024-08-22 08:51:11'),(8,'WOG',2,NULL,1,NULL,'2024-08-22 08:51:18','2024-08-22 08:51:18'),(9,'SSS',3,NULL,1,NULL,'2024-08-22 08:52:00','2024-08-22 08:52:00'),(10,'Cyber',3,NULL,1,NULL,'2024-08-22 08:52:08','2024-08-22 08:52:08'),(11,'DOTS',3,NULL,1,NULL,'2024-08-22 08:52:16','2024-08-22 08:52:16'),(12,'DSAI',3,NULL,1,NULL,'2024-08-22 08:52:22','2024-08-22 08:52:22'),(13,'PA',4,NULL,1,NULL,'2024-08-24 21:10:54','2024-08-24 21:10:54'),(14,'AC',4,NULL,1,NULL,'2024-08-24 21:11:06','2024-08-24 21:11:06'),(15,'PROC',6,NULL,1,NULL,'2024-08-24 21:11:32','2024-08-24 21:11:32'),(16,'ACS',6,NULL,1,NULL,'2024-08-24 21:11:39','2024-08-24 21:11:39'),(17,'Office of Secretary',3,NULL,1,NULL,'2024-09-01 22:02:54','2024-09-01 22:02:54'),(18,'Office of Director(DTT)',1,NULL,1,NULL,'2024-09-05 21:21:37','2024-09-05 21:21:37'),(19,'Office of Director(DDI)',2,NULL,1,NULL,'2024-09-05 21:21:58','2024-09-05 21:21:58');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisionsubfolders`
--

DROP TABLE IF EXISTS `divisionsubfolders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisionsubfolders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `division_id` bigint(20) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisionsubfolders`
--

LOCK TABLES `divisionsubfolders` WRITE;
/*!40000 ALTER TABLE `divisionsubfolders` DISABLE KEYS */;
/*!40000 ALTER TABLE `divisionsubfolders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dzongkhags`
--

DROP TABLE IF EXISTS `dzongkhags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dzongkhags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'Bumthang',
  `shortCode` varchar(255) DEFAULT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dzongkhags`
--

LOCK TABLES `dzongkhags` WRITE;
/*!40000 ALTER TABLE `dzongkhags` DISABLE KEYS */;
INSERT INTO `dzongkhags` VALUES (1,'Bumthang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(2,'Chukha','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(3,'Dagana','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(4,'Gasa','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(5,'Haa','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(6,'Lhuentse','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(7,'Mongar','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(8,'Paro','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(9,'Pemagatshel','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(10,'Punakha','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(11,'Samdrup Jongkhar','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(12,'Samtse','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(13,'Sarpang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(14,'Thimphu','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(15,'Trashigang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(16,'Trashiyangtse','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(17,'Trongsa','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(18,'Tsirang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(19,'Wangdue Phodrang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47'),(20,'Zhemgang','Desc',1,'2023-06-10 11:22:47','2023-06-10 11:22:47');
/*!40000 ALTER TABLE `dzongkhags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fileindices`
--

DROP TABLE IF EXISTS `fileindices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fileindices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileindices`
--

LOCK TABLES `fileindices` WRITE;
/*!40000 ALTER TABLE `fileindices` DISABLE KEYS */;
INSERT INTO `fileindices` VALUES (1,'GovTech/DSOM','2024-09-04 04:05:13','2024-09-04 04:05:13');
/*!40000 ALTER TABLE `fileindices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filemanagers`
--

DROP TABLE IF EXISTS `filemanagers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filemanagers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filemanagers`
--

LOCK TABLES `filemanagers` WRITE;
/*!40000 ALTER TABLE `filemanagers` DISABLE KEYS */;
/*!40000 ALTER TABLE `filemanagers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `year` varchar(255) NOT NULL,
  `shortCode` text NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,'2024-09-09','Mon ','Thimphu Drubchoe(Thimphu Only)',1,'2024-09-06 23:58:46','2024-09-06 23:58:46'),(6,'2024-09-13','Fri ','Thimphu Tshechu(Thimphu Only)',307,'2024-09-09 20:42:33','2024-09-09 20:42:33'),(7,'2024-09-14','Sat ','Thimphu Tshechu(Thimphu Only)',307,'2024-09-09 20:43:51','2024-09-09 20:43:51'),(8,'2024-09-15','Sun ','Thimphu Tshechu(Thimphu Only)',307,'2024-09-09 20:44:01','2024-09-09 20:44:01');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ipranges`
--

DROP TABLE IF EXISTS `ipranges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ipranges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `start_ip` varchar(255) NOT NULL,
  `end_ip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipranges`
--

LOCK TABLES `ipranges` WRITE;
/*!40000 ALTER TABLE `ipranges` DISABLE KEYS */;
INSERT INTO `ipranges` VALUES (1,'172.16.166.1','172.16.166.97','2024-08-22 09:22:31','2024-08-22 09:22:31');
/*!40000 ALTER TABLE `ipranges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joinsittingdocumentdirectories`
--

DROP TABLE IF EXISTS `joinsittingdocumentdirectories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joinsittingdocumentdirectories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joinsittingdocumentdirectories`
--

LOCK TABLES `joinsittingdocumentdirectories` WRITE;
/*!40000 ALTER TABLE `joinsittingdocumentdirectories` DISABLE KEYS */;
/*!40000 ALTER TABLE `joinsittingdocumentdirectories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joinsittingdocuments`
--

DROP TABLE IF EXISTS `joinsittingdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joinsittingdocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `directory_id` bigint(20) NOT NULL,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joinsittingdocuments`
--

LOCK TABLES `joinsittingdocuments` WRITE;
/*!40000 ALTER TABLE `joinsittingdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `joinsittingdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jointsittingdocumentsubdirectories`
--

DROP TABLE IF EXISTS `jointsittingdocumentsubdirectories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jointsittingdocumentsubdirectories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `directory_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jointsittingdocumentsubdirectories`
--

LOCK TABLES `jointsittingdocumentsubdirectories` WRITE;
/*!40000 ALTER TABLE `jointsittingdocumentsubdirectories` DISABLE KEYS */;
/*!40000 ALTER TABLE `jointsittingdocumentsubdirectories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jointsittingsubdocuments`
--

DROP TABLE IF EXISTS `jointsittingsubdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jointsittingsubdocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `directory_id` bigint(20) NOT NULL,
  `sub_directory_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jointsittingsubdocuments`
--

LOCK TABLES `jointsittingsubdocuments` WRITE;
/*!40000 ALTER TABLE `jointsittingsubdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `jointsittingsubdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_balances`
--

DROP TABLE IF EXISTS `leave_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_balances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `earn_leave` bigint(20) NOT NULL,
  `casual_leave` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_balances`
--

LOCK TABLES `leave_balances` WRITE;
/*!40000 ALTER TABLE `leave_balances` DISABLE KEYS */;
INSERT INTO `leave_balances` VALUES (1,249,0,0,'',1,'2024-08-22 08:54:55','2024-08-22 08:54:55'),(2,250,0,0,'',1,'2024-08-22 08:55:00','2024-08-22 08:55:00'),(3,251,0,0,'',1,'2024-08-22 08:55:05','2024-08-22 08:55:05'),(4,252,0,0,'',1,'2024-08-22 08:56:00','2024-08-22 08:56:00'),(5,253,0,0,'',1,'2024-08-22 08:56:07','2024-08-22 08:56:07'),(6,254,0,0,'',1,'2024-08-22 08:56:22','2024-08-22 08:56:22'),(7,255,0,0,'',1,'2024-08-22 08:56:41','2024-08-22 08:56:41'),(8,256,0,0,'',1,'2024-08-22 09:02:41','2024-08-22 09:02:41'),(9,257,0,0,'',1,'2024-08-24 21:15:32','2024-08-24 21:15:32'),(10,258,0,0,'',1,'2024-08-24 21:16:49','2024-08-24 21:16:49'),(11,289,21,10,'leave bal',266,'2024-09-12 02:04:58','2024-09-12 03:26:15'),(12,436,0,0,'',1,'2024-09-15 22:11:18','2024-09-15 22:11:18');
/*!40000 ALTER TABLE `leave_balances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_categories`
--

DROP TABLE IF EXISTS `leave_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `leaveCode` varchar(255) NOT NULL,
  `shortCode` varchar(255) NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_categories`
--

LOCK TABLES `leave_categories` WRITE;
/*!40000 ALTER TABLE `leave_categories` DISABLE KEYS */;
INSERT INTO `leave_categories` VALUES (1,'Maternity Leave','ML','',1,'2024-09-04 03:24:40','2024-09-12 03:21:16'),(2,'Paternity Leave','PL','',1,'2024-09-04 03:25:53','2024-09-12 03:21:30'),(3,'Casual Leave','CL','',1,'2024-09-04 03:26:10','2024-09-12 03:21:41'),(4,'Earned Leave','EL','',1,'2024-09-04 03:26:26','2024-09-12 03:22:15'),(5,'EoL','EO','',1,'2024-09-04 03:26:36','2024-09-12 03:22:41'),(6,'Medical Leave','MD','',1,'2024-09-04 03:26:46','2024-09-12 03:23:00'),(7,'Bereavement Leave','BL','',1,'2024-09-04 03:26:57','2024-09-12 03:23:17'),(8,'Study Leave','SL','',1,'2024-09-04 03:27:06','2024-09-12 03:23:30'),(9,'Training','TR','',1,'2024-09-04 03:27:16','2024-09-12 03:23:38'),(10,'Tour','TO','',1,'2024-09-04 03:27:26','2024-09-12 03:23:48'),(11,'Meeting','ME','',1,'2024-09-04 03:27:34','2024-09-12 03:23:55'),(12,'Seminar','SE','',1,'2024-09-04 03:27:43','2024-09-12 03:24:03'),(13,'Workshop','WO','',1,'2024-09-04 03:27:52','2024-09-12 03:24:09'),(14,'Deputation','DE','',1,'2024-09-04 03:28:03','2024-09-12 03:24:16'),(15,'Work From Home','WH','',1,'2024-09-04 03:28:12','2024-09-12 03:24:37'),(18,'Annual Leave','AL','',1,'2024-09-12 03:25:18','2024-09-12 03:25:18');
/*!40000 ALTER TABLE `leave_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_logs`
--

DROP TABLE IF EXISTS `leave_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agency_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `timeIn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `leave_category_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_logs`
--

LOCK TABLES `leave_logs` WRITE;
/*!40000 ALTER TABLE `leave_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_statuses`
--

DROP TABLE IF EXISTS `leave_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_statuses`
--

LOCK TABLES `leave_statuses` WRITE;
/*!40000 ALTER TABLE `leave_statuses` DISABLE KEYS */;
INSERT INTO `leave_statuses` VALUES (1,'Approved','Approved','2023-06-10 11:22:47','2023-06-10 11:22:47'),(2,'Rejected','Rejected','2023-06-10 11:22:47','2023-06-10 11:22:47'),(3,'Pending','Pending','2023-06-10 11:22:47','2023-06-10 11:22:47');
/*!40000 ALTER TABLE `leave_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `status` bigint(20) NOT NULL DEFAULT 0,
  `leave_category_id` bigint(20) NOT NULL,
  `employeeRemarks` varchar(255) DEFAULT NULL,
  `headRemarks` varchar(255) DEFAULT NULL,
  `agency_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `actionby` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves`
--

LOCK TABLES `leaves` WRITE;
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
INSERT INTO `leaves` VALUES (1,398,'','2024-09-10','2024-09-12',1,10,'UAT of GIMS-eGP Integration ',NULL,1,1,1,398,'2024-09-10 04:40:32','2024-09-10 04:40:32'),(2,321,'','2024-09-11','2024-09-11',1,15,'Personal Issues',NULL,1,1,1,321,'2024-09-10 05:44:05','2024-09-10 05:44:05'),(3,307,'','2024-09-13','2024-09-13',1,15,'test',NULL,1,1,1,307,'2024-09-12 02:03:22','2024-09-12 02:03:22'),(4,289,'','2024-09-13','2024-09-13',1,15,'test',NULL,1,2,8,289,'2024-09-12 02:05:58','2024-09-12 02:05:58'),(5,289,'','2024-09-12','2024-09-12',1,15,'test',NULL,1,2,8,289,'2024-09-12 02:09:01','2024-09-12 02:09:01'),(6,289,'','2024-09-20','2024-09-20',1,15,'kkk',NULL,1,2,8,289,'2024-09-12 03:08:05','2024-09-12 03:08:05'),(7,345,'','2024-09-13','2024-09-13',1,15,'hi',NULL,1,1,1,345,'2024-09-12 03:08:52','2024-09-12 03:08:52'),(8,289,'','2024-09-16','2024-09-17',3,18,'AL',NULL,1,2,8,0,'2024-09-12 03:27:22','2024-09-12 03:27:22'),(9,289,'','2024-09-17','2024-09-17',3,18,'t',NULL,1,2,8,0,'2024-09-12 03:28:59','2024-09-12 03:28:59');
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (119,'2014_10_12_000000_create_users_table',1),(120,'2014_10_12_100000_create_password_resets_table',1),(121,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(122,'2019_08_19_000000_create_failed_jobs_table',1),(123,'2019_12_14_000001_create_personal_access_tokens_table',1),(124,'2022_10_16_000_create_agency_categories_table',1),(125,'2022_10_17_000_create_department_categories_table',1),(126,'2022_10_19_000_create_division_categories_table',1),(127,'2022_10_20_000_create_leave_categories_table',1),(128,'2022_10_20_152902_create_leaves_table',1),(129,'2022_10_21_085554_create_sessions_table',1),(130,'2022_10_25_170613_create_roles_table',1),(131,'2022_10_27_080931_create_permissions_table',1),(132,'2022_10_27_081119_create_users_permissions_table',1),(133,'2022_10_27_082212_create_users_roles_table',1),(134,'2022_10_27_082301_create_roles_permissions_table',1),(135,'2022_11_22_000_create_parliaments_table',1),(136,'2022_11_27_095402_create_parliamentsessions_table',1),(137,'2022_11_27_104801_create_conferencehalls_table',1),(138,'2022_11_27_114010_create_conferencehallbookings_table',1),(139,'2022_11_28_064845_create_weblinks_table',1),(140,'2022_11_30_075702_create_weblinkcategories_table',1),(141,'2022_12_03_110008_create_leave_status_table',1),(142,'2022_12_03_112354_create_attendances_table',1),(143,'2022_12_03_232552_create_notifications_table',1),(144,'2022_12_04_112747_create_leave_balances_table',1),(145,'2022_12_04_144821_create_dispatchletters_table',1),(146,'2022_12_06_103559_create_dispatch_receive_numbers_table',1),(147,'2022_12_07_042505_create_receiveletters_table',1),(148,'2022_12_07_122008_create_workflows_table',1),(149,'2022_12_09_120035_create_filemanagers_table',1),(150,'2022_12_13_025820_create_holidays_table',1),(151,'2022_12_13_123716_create_agendas_table',1),(152,'2022_12_14_064553_create_attendance_logs_table',1),(153,'2022_12_14_110813_create_position_titles_table',1),(154,'2022_12_14_110819_create_position_levels_table',1),(155,'2022_12_15_132105_create_sessiondocument_categories_table',1),(156,'2022_12_15_132126_create_committees_table',1),(157,'2022_12_16_130153_create_committeedocuments_table',1),(158,'2022_12_16_130154_create_sessiondocuments_table',1),(159,'2022_12_19_113028_create_committeemembers_table',1),(160,'2023_01_30_144857_create_secretariatdocuments_table',1),(161,'2023_01_30_173627_create_fileindices_table',1),(162,'2023_02_04_051332_create_supervisor_updated_logs_table',1),(163,'2023_02_04_170116_create_constituencies_table',1),(164,'2023_02_05_044208_create_dzongkhags_table',1),(165,'2023_02_06_104021_create_ipranges_table',1),(166,'2023_02_09_112743_create_attendance_statuses_table',1),(167,'2023_02_18_080619_create_joinsittingdocuments_table',1),(168,'2023_02_18_080726_create_joinsittingdocumentdirectories_table',1),(169,'2023_02_20_030158_create_leave_logs_table',1),(170,'2023_05_23_065813_create_sessiondocument_subcategory_table',1),(171,'2023_05_23_090003_create_sessiondocumentsubfolders_table',1),(172,'2023_05_26_172418_create_jointsittingdocumentsubdirectories_table',1),(173,'2023_05_26_172418_create_jointsittingsubdocument_table',1),(174,'2023_05_31_181032_create_divisionsubfolders_table',1),(175,'2023_05_31_190548_create_secretariatsubfolderdocuments_table',1),(176,'2023_06_01_081926_create_committeesubfolders_table',1),(177,'2023_06_01_113416_create_committeesubfolderdocuments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fid` bigint(20) NOT NULL,
  `forward_to` bigint(20) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `author` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,8,267,0,289,'AL','notifications.leave-notifications','2024-09-12 03:27:22','2024-09-12 03:27:22'),(2,9,267,0,289,'t','notifications.leave-notifications','2024-09-12 03:28:59','2024-09-12 03:28:59');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parliaments`
--

DROP TABLE IF EXISTS `parliaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parliaments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parliaments`
--

LOCK TABLES `parliaments` WRITE;
/*!40000 ALTER TABLE `parliaments` DISABLE KEYS */;
INSERT INTO `parliaments` VALUES (1,'2024-2025','2024-2025',NULL,NULL);
/*!40000 ALTER TABLE `parliaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parliamentsessions`
--

DROP TABLE IF EXISTS `parliamentsessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parliamentsessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parliamentsessions`
--

LOCK TABLES `parliamentsessions` WRITE;
/*!40000 ALTER TABLE `parliamentsessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `parliamentsessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Attendance','attendance','2023-06-10 11:22:47','2023-06-10 11:22:47'),(2,'Members Attendance Report','members.attendance.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(3,'Secretariat Attendance Report','secretariat.attendance.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(4,'Leave','leave','2023-06-10 11:22:47','2023-06-10 11:22:47'),(5,'Leave Report','leave.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(6,'Manage Holidays','manage.holiday','2023-06-10 11:22:47','2023-06-10 11:22:47'),(7,'Manage Leave Balance','manage.leave.balance','2023-06-10 11:22:47','2023-06-10 11:22:47'),(8,'Dispatch Letter','dispatch.letter','2023-06-10 11:22:47','2023-06-10 11:22:47'),(9,'Receive Letter','receive.letter','2023-06-10 11:22:47','2023-06-10 11:22:47'),(10,'Dispatched Report','dispatched.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(11,'Received Report','received.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(12,'Delete Dispatch Letter','dispatch.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(13,'Delete Receive Letter','receive.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(14,'Workflows','workflow','2023-06-10 11:22:47','2023-06-10 11:22:47'),(15,'Workflow Report','workflow.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(16,'Conference hall booking','conference.hall.booking','2023-06-10 11:22:47','2023-06-10 11:22:47'),(17,'Conference hall booking Report','conference.hall.booking.report','2023-06-10 11:22:47','2023-06-10 11:22:47'),(18,'Session Document','session.documents','2023-06-10 11:22:47','2023-06-10 11:22:47'),(19,'NA Session Document','na.session.documents','2023-06-10 11:22:47','2023-06-10 11:22:47'),(20,'NA Session Document Upload','na.session.document.upload','2023-06-10 11:22:47','2023-06-10 11:22:47'),(21,'NA Session Document Delete','na.session.document.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(22,'Committee Document','committee.documents','2023-06-10 11:22:47','2023-06-10 11:22:47'),(23,'Committee Document Upload','committee.document.upload','2023-06-10 11:22:47','2023-06-10 11:22:47'),(24,'Committee Document Delete','committee.document.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(25,'Secretariat Document','secretariat.documents','2023-06-10 11:22:47','2023-06-10 11:22:47'),(26,'Secretariat Document Upload','secretariat.document.upload','2023-06-10 11:22:47','2023-06-10 11:22:47'),(27,'Secretariat Document Delete','secretariat.document.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(28,'Joint Sitting Document','joint.sitting.documents','2023-06-10 11:22:47','2023-06-10 11:22:47'),(29,'Joint Sitting Document Upload','joint.sitting.document.upload','2023-06-10 11:22:47','2023-06-10 11:22:47'),(30,'Joint Sitting Document Delete','joint.sitting.document.delete','2023-06-10 11:22:47','2023-06-10 11:22:47'),(31,'View Archive','archive.view','2023-06-10 11:22:47','2023-06-10 11:22:47'),(32,'Session Document Archive','session.document.archives','2023-06-10 11:22:47','2023-06-10 11:22:47'),(33,'Committee Document Archive','committee.document.archives','2023-06-10 11:22:47','2023-06-10 11:22:47'),(34,'Secretariat Document Archive','secretariat.document.archives','2023-06-10 11:22:47','2023-06-10 11:22:47'),(35,'Joint Sitting Document Archive','joint.sitting.document.archives','2023-06-10 11:22:47','2023-06-10 11:22:47'),(36,'Daily Secretariat Attendance Report','secretariat.dailyattendancereport','2023-06-10 16:32:02','2023-06-10 16:32:02'),(37,'Act Upload','act.upload','2023-12-09 11:50:04','2023-12-09 11:50:04'),(38,'Act Delete','act.delete','2023-12-09 11:50:04','2023-12-09 11:50:04');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position_levels`
--

DROP TABLE IF EXISTS `position_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position_levels`
--

LOCK TABLES `position_levels` WRITE;
/*!40000 ALTER TABLE `position_levels` DISABLE KEYS */;
INSERT INTO `position_levels` VALUES (1,'EX1','Executive','1','2023-05-05 03:21:58','2023-05-05 03:21:58'),(2,'P1','Management Group','1','2023-05-05 03:21:58','2023-05-05 03:21:58'),(3,'P2/SS1','P2/SS1','1',NULL,'2023-05-17 04:18:24'),(4,'P3/SS2','P3/SS2',NULL,'2023-05-16 05:49:07','2023-05-17 04:18:06'),(5,'P4/SS3','P4/SS3',NULL,'2023-05-16 05:49:07','2023-05-17 04:17:56'),(6,'P5/SS4','P5/SS4',NULL,'2023-05-16 05:49:07','2023-05-17 04:17:44'),(7,'S1','S1',NULL,'2023-05-16 05:49:07','2023-05-16 05:49:07'),(8,'S2','S2',NULL,'2023-05-16 05:49:07','2023-05-16 05:49:07'),(9,'S3','S3',NULL,'2023-05-16 05:49:07','2023-05-16 05:49:07'),(10,'S4','S4',NULL,'2023-05-16 05:49:07','2023-05-16 05:49:07'),(11,'S5','S5',NULL,'2023-05-16 05:49:07','2023-05-17 04:18:53'),(12,'O1','O1',NULL,'2023-05-16 05:49:07','2023-05-17 04:19:03'),(13,'O2','O2',NULL,'2023-05-16 05:49:07','2023-05-17 04:21:02'),(14,'O3','O3',NULL,'2023-05-16 05:49:07','2023-05-17 04:21:11'),(15,'O4','O4',NULL,'2023-05-17 04:21:22','2023-05-17 04:21:22'),(16,'Speaker','Speaker',NULL,'2023-05-23 03:38:30','2023-05-23 03:38:30'),(17,'Dy.Speaker','Dy.Speaker',NULL,'2023-05-23 03:38:46','2023-05-23 03:38:46'),(18,'Prime Minister','Prime Minister',NULL,'2023-05-23 03:38:57','2023-05-23 03:38:57'),(19,'Minister','Minister',NULL,'2023-05-23 03:39:21','2023-05-23 03:39:21'),(20,'Opposition Leader','Opposition Leader',NULL,'2023-05-23 03:39:33','2023-05-23 03:39:33'),(21,'Member of Parliament','MP',NULL,'2023-05-23 03:39:58','2023-05-23 03:39:58'),(23,'EX3 A','EX3 A',NULL,'2024-09-05 21:53:44','2024-09-05 21:53:44');
/*!40000 ALTER TABLE `position_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position_titles`
--

DROP TABLE IF EXISTS `position_titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position_titles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `shortCode` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position_titles`
--

LOCK TABLES `position_titles` WRITE;
/*!40000 ALTER TABLE `position_titles` DISABLE KEYS */;
INSERT INTO `position_titles` VALUES (1,'Secretary General','Secretary','1','2023-05-05 03:21:58','2024-01-01 00:52:54'),(2,'Director','Director','1','2023-05-05 03:21:58','2023-05-05 03:21:58'),(3,'Administrative Assistant','Adm. Assistant','1','2023-05-05 03:21:58','2023-05-18 03:03:02'),(4,'Chief Information and Media Officer','Chief Information and Media Officer','1','2023-05-16 05:53:38','2023-05-17 04:05:34'),(5,'Deputy Chief Research Officer','Dy. Chief Research Officer','1','2023-05-16 05:53:38','2023-05-18 03:03:23'),(6,'Language Specialist','Language Specialist','1','2023-05-16 05:53:38','2023-05-17 04:06:05'),(7,'Deputy Chief Human Resource Officer','Dy. Chief HRO','1','2023-05-16 05:55:33','2023-05-18 03:03:51'),(8,'Legislative Officer','Legislative Officer','1','2023-05-17 04:07:53','2023-05-17 04:07:53'),(9,'Legal Officer','Legal Officer','1','2023-05-17 04:08:03','2023-05-17 04:08:03'),(10,'Committee Secretary','Committee Secretary','1','2023-05-17 04:08:18','2023-05-17 04:08:18'),(11,'Assistant Information and Media Officer','Asst. Media Officer','1','2023-05-17 04:09:31','2023-05-18 03:01:45'),(12,'Assistant Human Resource Officer','Asst. HR Officer','1','2023-05-17 04:09:50','2023-05-18 03:04:17'),(13,'Administrative Assistant I','Admin. Asst. I','1','2023-05-17 04:10:09','2023-05-18 03:04:51'),(14,'Administrative Assistant II','Admin. Asst. II','1','2023-05-17 04:10:14','2023-05-18 03:05:00'),(15,'Administrative Assistant III','Admin. Asst. III','1','2023-05-17 04:10:25','2023-05-18 03:05:07'),(16,'Personal Assistant I','Personal Asst. I','1','2023-05-17 04:10:47','2023-05-18 03:05:22'),(17,'Personal Assistant II','Personal Asst. II','1','2023-05-17 04:10:51','2023-05-18 03:05:33'),(18,'Senior Personal Secretary III','Sr. Personal Secretary III','1','2023-05-17 04:11:07','2023-05-18 03:05:55'),(19,'Asst. ICT Officer','Asst ICTO','1','2023-05-17 04:11:20','2024-09-05 21:47:23'),(20,'ICT Officer','ICT Officer','1','2023-05-17 04:11:28','2024-09-05 21:47:33'),(21,'Sr. Legislative Officer','Sr. Legislative Officer','1','2023-05-17 04:11:51','2023-05-17 04:11:51'),(22,'Asst. Research Officer','Asst. Research Officer','1','2023-05-17 04:12:05','2023-05-17 04:12:05'),(23,'Technician I','Technician I','1','2023-05-17 04:12:19','2023-05-17 04:12:19'),(24,'Technician II','Technician II','1','2023-05-17 04:12:27','2023-05-17 04:12:27'),(25,'Driver','Driver','1','2023-05-17 04:12:49','2023-05-17 04:12:49'),(26,'Driver I','Driver I','1','2023-05-17 04:12:56','2023-05-17 04:12:56'),(27,'Driver II','Driver II','1','2023-05-17 04:13:03','2023-05-17 04:13:03'),(28,'Driver III','Driver III','1','2023-05-17 04:13:06','2023-05-17 04:13:06'),(29,'Sr. ICT Technical Associate II','Sr. ICT Technical Associate II','1','2023-05-17 04:13:32','2023-05-17 04:13:32'),(30,'Sr. ICT Technical Associate I','Sr. ICT Technical Associate I','1','2023-05-17 04:13:38','2023-05-17 04:13:38'),(31,'Sr. Store Keeper ','Sr. Store Keeper ','1','2023-05-17 04:13:52','2023-05-17 04:13:52'),(32,'Sr. Store Keeper I','Sr. Store Keeper I','1','2023-05-17 04:13:59','2023-05-17 04:13:59'),(33,'Sr. Store Keeper II','Sr. Store Keeper II','1','2023-05-17 04:14:05','2023-05-17 04:14:05'),(34,'Sr. Store Keeper III','Sr. Store Keeper III','1','2023-05-17 04:14:12','2023-05-17 04:14:12'),(35,'Finance Officer','Finance Officer','1','2023-05-17 04:14:34','2023-05-17 04:14:34'),(36,'Sr. Finance Officer','Sr. Finance Officer','1','2023-05-17 04:14:37','2023-05-17 04:14:37'),(37,'Accountant','Accountant','1','2023-05-17 04:14:48','2023-05-17 04:14:48'),(38,'Sr. Accountant','Sr. Accountant','1','2023-05-17 04:14:57','2023-05-17 04:14:57'),(39,'Dispatcher ','Dispatcher ','1','2023-05-17 04:15:24','2023-05-17 04:15:24'),(40,'Dispatcher I','Dispatcher I','1','2023-05-17 04:15:31','2023-05-17 04:15:31'),(41,'Dispatcher II','Dispatcher II','1','2023-05-17 04:15:38','2023-05-17 04:15:38'),(42,'Dispatcher III','Dispatcher III','1','2023-05-17 04:15:41','2023-05-17 04:15:41'),(43,'Accounts Asst. ','Accounts Asst. ','1','2023-05-17 04:16:03','2023-05-17 04:16:03'),(44,'Accounts Asst. II','Accounts Asst. II','1','2023-05-17 04:16:12','2023-05-17 04:16:12'),(45,'Accounts Asst. III','Accounts Asst. III','1','2023-05-17 04:16:15','2023-05-17 04:16:15'),(46,'Research Asst.1','Research Asst.1','1','2023-05-22 04:38:27','2023-05-22 04:38:27'),(47,'Research Asst. II','Research Asst. II','1','2023-05-22 04:38:38','2023-05-22 04:38:38'),(48,'Sr. Personal Asst. I','Sr. Personal Asst. I','1','2023-05-22 04:44:58','2023-05-22 04:44:58'),(49,'Sr. Personal Asst. IV','Sr. Personal Asst. IV','1','2023-05-22 04:47:20','2023-05-22 04:47:20'),(50,'Sr. Personal Asst. I','Sr. Personal Asst. I','1','2023-05-22 04:50:02','2023-05-22 04:50:27'),(51,'Sr. Personal Asst. II','Sr. Personal Asst. II','1','2023-05-22 04:50:11','2023-05-22 04:50:11'),(52,'Sr. Personal Asst. III','Sr. Personal Asst. III','1','2023-05-22 04:50:38','2023-05-22 04:50:38'),(53,'Sr. Personal Asst. V','Sr. Personal Asst. V','1','2023-05-22 04:50:47','2023-05-22 04:50:47'),(54,'Committee Secretary I','Committee Secretary I','1','2023-05-22 04:55:27','2023-05-22 04:55:27'),(55,'Committee Secretary II','Committee Secretary II','1','2023-05-22 04:55:34','2023-05-22 04:55:34'),(56,'Committee Secretary III','Committee Secretary III','1','2023-05-22 04:55:42','2023-05-22 04:55:42'),(57,'Committee Secretary IV','Committee Secretary IV','1','2023-05-22 04:56:47','2023-05-22 04:56:47'),(58,'Committee Secretary V','Committee Secretary V','1','2023-05-22 04:56:58','2023-05-22 04:56:58'),(59,'Dispatcher I','Dispatcher I','1','2023-05-22 21:21:08','2023-05-22 21:21:08'),(60,'Dispatcher II','Dispatcher II','1','2023-05-22 21:21:17','2023-05-22 21:21:17'),(61,'Dispatcher III','Dispatcher III','1','2023-05-22 21:21:48','2023-05-22 21:22:26'),(62,'Sr. Store Keeper III','Sr. Store Keeper III','1','2023-05-22 21:25:59','2023-05-22 21:25:59'),(63,'Speaker','Speaker','1','2023-05-23 03:41:37','2023-05-23 03:41:37'),(64,'Prime Minister','Prime Minister','1','2023-05-23 03:42:12','2023-05-23 03:42:12'),(65,'Chairperson','Chairperson','1','2023-05-23 03:42:27','2023-05-23 03:42:27'),(66,'Dy.Speaker','Dy.Speaker','1','2023-05-23 03:42:37','2023-05-23 03:42:37'),(67,'Minister','Minister','1','2023-05-23 03:42:46','2023-05-23 03:42:46'),(68,'Dy. Chairperson','Dy. Chairperson','1','2023-05-23 03:43:00','2023-05-23 03:43:00'),(69,'Member of Parliament','Member of Parliament','1','2023-05-23 03:43:12','2023-05-23 03:43:12'),(74,'Deputy Chief Legislative Officer (Offtg. Chief LPD)','Deputy Chief Legislative Officer','1','2024-03-15 04:15:17','2024-03-15 04:15:17'),(75,'Chief ICT Officer','Chief ICT Officer','1','2024-08-12 04:30:31','2024-08-12 04:30:54'),(76,'Dy. Chief ICT Officer','Dy. Chief ICT Officer','1','2024-08-12 04:36:46','2024-08-12 04:36:46'),(77,'Sr. ICT Officer','Sr. ICT Officer','1','2024-08-12 04:37:02','2024-08-12 04:37:02'),(78,'ICT Technical Associate I','ICT Technical Associate I','1','2024-08-12 04:37:24','2024-08-12 04:37:24'),(79,'ICT Technical Associate II','ICT Technical Associate II','1','2024-08-12 04:37:35','2024-08-12 04:37:35'),(80,'ICT Analyst','ICT Analyst','1','2024-08-12 04:37:51','2024-08-12 04:37:51'),(81,'Sr. Technical Associate I','Sr. Technical Associate I','1','2024-08-12 04:38:29','2024-08-12 04:38:29'),(82,'Sr. Technical Associate II','Sr. Technical Associate II','1','2024-08-12 04:38:39','2024-08-12 04:38:39'),(83,'Sr. Technical Associate ','Sr. Technical Associate ','1','2024-08-12 04:38:45','2024-08-12 04:39:30'),(84,'Sr. Technical Associate III','Sr. Technical Associate III','1','2024-08-12 04:38:54','2024-08-12 04:38:54'),(85,'Secretary','Secretary','1','2024-09-01 22:03:28','2024-09-01 22:03:28'),(86,'Dy. Chief Language Dev. Officer','Dy. Chief Language Dev. Officer','1','2024-09-01 22:58:11','2024-09-01 22:58:11'),(87,'Engineer','Engineer','1','2024-09-01 23:00:01','2024-09-01 23:00:01'),(88,'Security Guard','Security Guard','1','2024-09-01 23:03:39','2024-09-01 23:03:39'),(89,'ICT Officer','ICTO','1','2024-09-01 23:52:14','2024-09-01 23:52:14'),(90,'Asst Program Officer','Asst Program Officer','1','2024-09-02 00:11:55','2024-09-02 00:11:55'),(91,'Sr. Communication Technician V','Sr. Communication Technician V','1','2024-09-02 00:21:20','2024-09-02 00:21:20'),(92,'Asst Procurement Officer','Asst Procurement Officer','1','2024-09-02 21:35:23','2024-09-02 21:35:23'),(93,'Communication Officer','Communication Officer','1','2024-09-02 21:40:58','2024-09-02 21:40:58'),(94,'Executive Engineer','executive engineer','1','2024-09-05 21:38:53','2024-09-05 21:38:53'),(95,'Chief Program Officer','Chief Program Officer','1','2024-09-05 21:47:05','2024-09-05 21:47:05'),(96,'Sr. Personal Asst. III','Sr. Personal Asst. III','1','2024-09-05 22:14:40','2024-09-05 22:14:40'),(97,'Sr. Admin. Asst. V','Sr. Admin. Asst. V','1','2024-09-05 22:18:05','2024-09-05 22:18:05'),(98,'Sr. Store Keeper V','Sr. Store Keeper V','1','2024-09-05 22:19:54','2024-09-05 22:19:54'),(99,'Dy. Executive Engineer','Dy. Executive Engineer','1','2024-09-05 22:27:21','2024-09-05 22:27:21'),(100,'Asst. Program Officer','Asst. Program Officer','1','2024-09-05 22:38:30','2024-09-05 22:38:30'),(101,'Sr. Personal Asst. IV','Sr. Personal Asst. IV','1','2024-09-05 22:47:57','2024-09-05 22:47:57'),(102,'Dy. Chief Planning Officer','Dy. Chief Planning Officer','1','2024-09-05 22:49:54','2024-09-05 22:49:54'),(103,'HR Officer','HR Officer','1','2024-09-05 22:52:44','2024-09-05 22:52:44'),(104,'Sr. Program Officer','Sr. Program Officer','1','2024-09-06 03:39:55','2024-09-06 03:39:55'),(105,'Planning Officer','Planning Officer','1','2024-09-06 03:42:18','2024-09-06 03:42:18'),(106,'Sr. ICT Technical Associate III','Sr. ICT Technical Associate III','1','2024-09-06 04:43:59','2024-09-06 04:43:59');
/*!40000 ALTER TABLE `position_titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receiveletters`
--

DROP TABLE IF EXISTS `receiveletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiveletters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(255) NOT NULL,
  `from_agency` varchar(255) DEFAULT NULL,
  `from_department` varchar(255) DEFAULT NULL,
  `from_division` varchar(255) DEFAULT NULL,
  `dak_number` varchar(255) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `to_adressed` varchar(255) DEFAULT NULL,
  `to_agency_id` bigint(20) DEFAULT NULL,
  `to_department_id` bigint(20) DEFAULT NULL,
  `to_division_id` bigint(20) DEFAULT NULL,
  `to_subject` varchar(255) DEFAULT NULL,
  `file_index` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receiveletters`
--

LOCK TABLES `receiveletters` WRITE;
/*!40000 ALTER TABLE `receiveletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiveletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','admin','2023-05-05 21:21:58','2023-05-05 21:21:58'),(2,'member','member','2023-05-05 21:21:58','2024-08-12 05:25:42'),(5,'document-uploader','document-uploader','2023-05-29 16:51:21','2023-05-29 16:51:21'),(6,'HR Manager','HR Manager','2023-05-29 17:14:36','2023-05-29 17:14:36'),(8,'AttendanceManager','AttendanceManager','2023-05-30 20:22:52','2023-05-30 20:22:52'),(9,'ICT ','ICT ','2023-05-30 23:48:25','2023-05-30 23:48:25'),(10,'secretariat','secretariat','2023-06-10 15:20:19','2023-06-10 15:20:19'),(13,'RHD','RHD','2024-01-19 00:50:02','2024-01-19 00:50:02'),(15,'Division Head','Division Head','2024-08-12 04:33:30','2024-08-12 04:33:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_permissions`
--

DROP TABLE IF EXISTS `roles_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_permissions` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_permissions`
--

LOCK TABLES `roles_permissions` WRITE;
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
INSERT INTO `roles_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,38),(2,1),(2,4),(2,5),(2,8),(2,9),(2,12),(2,13),(2,14),(2,16),(2,17),(2,18),(2,19),(2,22),(5,1),(5,2),(5,3),(5,4),(5,5),(5,8),(5,9),(5,10),(5,11),(5,12),(5,13),(5,14),(5,15),(5,16),(6,1),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,13),(6,14),(6,15),(6,16),(6,17),(6,18),(6,19),(6,22),(6,25),(6,28),(6,31),(6,32),(6,33),(6,34),(6,35),(6,36),(8,1),(8,2),(8,3),(8,4),(8,5),(8,8),(8,9),(8,10),(8,11),(8,14),(8,15),(8,16),(8,17),(8,18),(8,19),(8,22),(8,25),(8,28),(8,31),(8,32),(8,33),(8,34),(8,35),(9,1),(9,2),(9,3),(9,4),(9,5),(9,6),(9,8),(9,9),(9,10),(9,11),(9,12),(9,13),(9,14),(9,15),(9,16),(9,17),(9,18),(9,19),(9,20),(9,21),(9,22),(9,23),(9,24),(9,25),(9,26),(9,27),(9,28),(9,29),(9,30),(9,31),(9,32),(9,33),(9,34),(9,35),(9,36),(9,37),(9,38),(10,1),(10,3),(10,4),(10,5),(10,8),(10,9),(10,10),(10,11),(10,14),(10,16),(10,17),(10,18),(10,19),(10,22),(10,25),(10,26),(10,28),(10,31),(10,32),(10,33),(10,34),(10,35),(10,36),(13,1),(13,2),(13,3),(13,4),(13,5),(13,8),(13,9),(13,10),(13,11),(13,14),(13,15),(13,16),(13,17),(13,18),(13,19),(13,20),(13,22),(13,23),(13,25),(13,26),(13,27),(13,28),(13,29),(13,31),(13,32),(13,33),(13,34),(13,35),(13,36),(15,1),(15,4),(15,5),(15,8),(15,9),(15,10),(15,11),(15,12),(15,13),(15,14),(15,15),(15,16),(15,17),(15,36);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretariatdocuments`
--

DROP TABLE IF EXISTS `secretariatdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretariatdocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `file_index` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretariatdocuments`
--

LOCK TABLES `secretariatdocuments` WRITE;
/*!40000 ALTER TABLE `secretariatdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretariatdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretariatsubfolderdocuments`
--

DROP TABLE IF EXISTS `secretariatsubfolderdocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretariatsubfolderdocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `sub_folder_id` bigint(20) NOT NULL,
  `file_index` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretariatsubfolderdocuments`
--

LOCK TABLES `secretariatsubfolderdocuments` WRITE;
/*!40000 ALTER TABLE `secretariatsubfolderdocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretariatsubfolderdocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessiondoc_categories`
--

DROP TABLE IF EXISTS `sessiondoc_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessiondoc_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessiondoc_categories`
--

LOCK TABLES `sessiondoc_categories` WRITE;
/*!40000 ALTER TABLE `sessiondoc_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessiondoc_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessiondocuments`
--

DROP TABLE IF EXISTS `sessiondocuments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessiondocuments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessiondocuments`
--

LOCK TABLES `sessiondocuments` WRITE;
/*!40000 ALTER TABLE `sessiondocuments` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessiondocuments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessiondocumentsubcategories`
--

DROP TABLE IF EXISTS `sessiondocumentsubcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessiondocumentsubcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessiondocumentsubcategories`
--

LOCK TABLES `sessiondocumentsubcategories` WRITE;
/*!40000 ALTER TABLE `sessiondocumentsubcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessiondocumentsubcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessiondocumentsubfolders`
--

DROP TABLE IF EXISTS `sessiondocumentsubfolders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessiondocumentsubfolders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parliament_id` bigint(20) NOT NULL,
  `session_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keyword` text NOT NULL,
  `document` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessiondocumentsubfolders`
--

LOCK TABLES `sessiondocumentsubfolders` WRITE;
/*!40000 ALTER TABLE `sessiondocumentsubfolders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessiondocumentsubfolders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('EACoQhLypcGMZv6yGQEvG1FdzJhdLXZKRA738t8s',321,'157.10.138.2','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVWdnM2NhMWpORXRMaUNidWo0OG9IM1VwamJid3dqWktvb3owNnlZYiI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMyMTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NToiaHR0cHM6Ly9nb3ZhY3Quc3lzdGVtcy5nb3YuYnQvdGVjaC9hdHRlbmRhbmNlIjt9czoxMDoiZGl2aXNpb25JZCI7Tjt9',1726572668),('Gx6BO1yaCBXrliHsIWAiYIcZObH97UjjTYO7LEhZ',NULL,'172.16.157.153','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMkRwS205QWVEYzR3Mld0b3BvbTJUb1J5VGRxS0dnYk9JNmczMERXYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cHM6Ly9nb3ZhY3Quc3lzdGVtcy5nb3YuYnQvdGVjaC9hdHRlbmRhbmNlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vZ292YWN0LnN5c3RlbXMuZ292LmJ0L3RlY2gvYXR0ZW5kYW5jZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1726569879),('hOWC7P8ndGdQC8NxHzmwjMSDj0sxJg6GaAgDMlVB',NULL,'157.10.138.2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXdwUzgycVNURzFwcHVvdlFOQVVKQ3hFQ1l1emNpenhQazYyZjhVQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vZ292YWN0LnN5c3RlbXMuZ292LmJ0Ijt9fQ==',1726572626),('ifTg6gN1dnzfiBao5lzuKjPsEIv681Oksbxi9vWJ',NULL,'119.2.118.134','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWG5tYUpCM0dMekpra2VleUFPNDlFaHJUMWlEM3hianlVRDlKSXZOQSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cHM6Ly9nb3ZhY3Quc3lzdGVtcy5nb3YuYnQvdXNlci9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cHM6Ly9nb3ZhY3Quc3lzdGVtcy5nb3YuYnQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1726573259),('qa4TxRjhbLuA42j2iCIjXZbT74zRJGIrvaoL25lv',NULL,'216.218.206.67','Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.156 Not(A:Brand/24 YaBrowser/24.4.1.901 Yowser/2.5  Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTAwdUFxWUNmSXQ5TzdrWnR1UG9jaER0M1ZIbGNmcGVsVVRtOFhrUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vMTAzLjI1Mi44NC45NiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1726572650),('YziafJdODi3HpNm7P0FsPWGnP9czuTizNTrhRSIF',NULL,'119.2.118.17','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/128.0.6613.98 Mobile/15E148 Safari/604.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejJMSURQTEQ5R1ZRMGlQajJWdUNSd3Iyc0EzWFp4alNjclVIOHhDZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cHM6Ly9nb3ZhY3Quc3lzdGVtcy5nb3YuYnQvdGVjaC9hdHRlbmRhbmNlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vZ292YWN0LnN5c3RlbXMuZ292LmJ0L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1726571945);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisor_updated_logs`
--

DROP TABLE IF EXISTS `supervisor_updated_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisor_updated_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `old_headId` bigint(20) DEFAULT NULL,
  `new_headId` bigint(20) DEFAULT NULL,
  `user_id` text DEFAULT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisor_updated_logs`
--

LOCK TABLES `supervisor_updated_logs` WRITE;
/*!40000 ALTER TABLE `supervisor_updated_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `supervisor_updated_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `agency_id` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `division_id` bigint(20) DEFAULT NULL,
  `dzongkhag_id` bigint(20) DEFAULT NULL,
  `constituency_id` bigint(20) DEFAULT NULL,
  `users_ids` text DEFAULT NULL,
  `users_ids_array` text DEFAULT NULL,
  `serializeHeadId` varchar(255) DEFAULT NULL,
  `headId` bigint(20) DEFAULT NULL,
  `status` bigint(20) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `empid` varchar(255) DEFAULT NULL,
  `cid` varchar(255) DEFAULT NULL,
  `positiontitle` bigint(20) DEFAULT NULL,
  `positionlevel` bigint(20) DEFAULT NULL,
  `gender` bigint(20) DEFAULT NULL,
  `display_order` bigint(20) DEFAULT 10,
  `userstatus_id` bigint(20) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=437 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','test@tech.gov.bt','admin',NULL,'$2a$12$.74Q8wo3Tu22v5h2MinhNOiMiAdmJXt4kwKIEOB.SeQzR.4GSsLdK',NULL,NULL,'Tg1Ym2vX8bpPwfhQ5dMC8DqIcums8cqa6emx8nd5CCCF9GgY4iepZmdeBvfy',NULL,NULL,1,4,7,NULL,NULL,NULL,NULL,NULL,NULL,1,'17170000','20041232','101231233213',1,1,1,1,1,'2023-05-05 09:21:58','2024-09-04 04:36:59'),(259,'San Bdr Rai','sanbdrrai@gmail.com','11808001255',NULL,'$2y$10$IjuHi11ELUwjUeji5SAbmOpdR7gZNp9zKujNQ5FMfzHyPpcz8pQjq',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17119474','200804008','11808001255',25,12,1,10,1,NULL,'2024-09-05 22:02:43'),(260,'Karma  Tenzin','ktenzin@tech.gov.bt','11504003059',NULL,'$2y$10$3EgMobZwZc1ymrdaL7e0oeFoujYJSaMUQyv6sQEnL5qwct6zbwXQe',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17385683','200801089','11504003059',80,2,1,10,1,NULL,'2024-09-05 22:06:01'),(261,'Damchen  Zangmo','dzangmo@tech.gov.bt','10709002890',NULL,'$2y$10$a9rk2CqVfdQvp5OVyA96HOt0Fg46A5H0QCPAWnAWMTqlic.th3IKW',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17677901','200901157','10709002890',76,3,2,10,1,NULL,'2024-09-02 22:09:43'),(262,'Pema  Dhendup','pdhendup@tech.gov.bt','11512004337',NULL,'$2y$10$A5Kh7gQLkfSdHK142RHzWuKz9VLrvuQ2PcU92s77jxNRyO2e8gtQe',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17858580','200801096','11512004337',76,3,1,10,1,NULL,'2024-09-05 22:08:13'),(263,'Radhika  Orari','rorari@dit.gov.bt','10311001164',NULL,'$2y$10$r5W6G/l7tVoVxfOkjf1iluVT8OPhPwrLVlzvLror0yb2Kp1k3BFbS',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17858205','20150105104','10311001164',77,4,2,10,1,NULL,'2024-09-05 22:10:36'),(264,'Tshering  Wangchuk','twangchuk@tech.gov.bt','10706000154',NULL,'$2y$10$sPLhnHuxUomfy6o3aR290u3aRn1OOGCLAOPIGfkS6fccl.MbCSIlG',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,NULL,NULL,1,'17663272','9401066','10706000154',30,4,1,10,1,NULL,'2024-09-05 22:12:22'),(265,'Jigme  Tenzing','jtenzing@tech.gov.bt','11410007114',NULL,'$2y$10$/w0VGubUlnrxubG8poCwH.3VSQZ6nU40HeHCyt9O3CJnKz4i46iqy',NULL,NULL,NULL,NULL,NULL,1,3,17,NULL,NULL,'a:2:{i:270;b:1;i:299;b:1;}','270,299',NULL,NULL,1,'17110770','200301045','11410007114',85,1,1,1,1,NULL,'2024-09-02 21:53:17'),(266,'Lobzang  Jamtsho','ljamtsho@tech.gov.bt','11105002816',NULL,'$2y$10$Ck/2tponeAiJFn.L.oBBR.vyfhM8CM4AedpukYPebp6oCJV4EL112',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,'a:20:{i:259;b:1;i:267;b:1;i:278;b:1;i:279;b:1;i:282;b:1;i:289;b:1;i:302;b:1;i:319;b:1;i:370;b:1;i:371;b:1;i:372;b:1;i:373;b:1;i:376;b:1;i:379;b:1;i:384;b:1;i:400;b:1;i:401;b:1;i:402;b:1;i:403;b:1;i:418;b:1;}','259,267,278,279,282,289,302,319,370,371,372,373,376,379,384,400,401,402,403,418',NULL,NULL,1,'17858586','200901153','11105002816',75,2,1,1,1,NULL,'2024-09-05 21:35:51'),(267,'Tshewang  Chojay','tchojay@plantech.gov.bt','11107006300',NULL,'$2y$10$dGhR2Sp04h52EX.U8u5EDOeoxJMKq842GDVeceFVTiaF1ZC9VLmOu',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,'a:20:{i:259;b:1;i:266;b:1;i:278;b:1;i:279;b:1;i:282;b:1;i:289;b:1;i:302;b:1;i:319;b:1;i:370;b:1;i:371;b:1;i:372;b:1;i:373;b:1;i:376;b:1;i:379;b:1;i:384;b:1;i:400;b:1;i:401;b:1;i:402;b:1;i:403;b:1;i:418;b:1;}','259,266,278,279,282,289,302,319,370,371,372,373,376,379,384,400,401,402,403,418',NULL,NULL,1,'17806616','200901139','11107006300',76,3,1,2,1,NULL,'2024-09-05 21:58:37'),(268,'Pratima  Pradhan','ppradhan@tech.gov.bt','10313001140',NULL,'$2y$10$Ebdu8BDXZIfUQlEcpm7q4uHzOg8vXIdd0fSzHx28kEvxuCjiEUCFG',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17627062','201201128','10313001140',76,3,2,10,1,NULL,'2024-09-05 22:13:16'),(270,'Tenzin  Yuden','tyuden@tech.gov.bt','11009000398',NULL,'$2y$10$ur3rrY0bUnxfUN347FY.beiacidg10A10DmptFpjdZPSBgChkLefO',NULL,NULL,NULL,NULL,NULL,1,3,17,NULL,NULL,NULL,NULL,NULL,NULL,1,'17618424','8602001','11009000398',96,6,2,10,1,NULL,'2024-09-05 22:15:04'),(271,'Kiran Kumar Pradhan','kkpradhan@tech.gov.bt','10313000665',NULL,'$2y$10$QZXcsE5QLQnxMeuw6W83eeQk2WJp91yVT0njsmsEADE56QJBlOKwu',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,'a:18:{i:273;b:1;i:285;b:1;i:291;b:1;i:292;b:1;i:300;b:1;i:311;b:1;i:312;b:1;i:313;b:1;i:315;b:1;i:318;b:1;i:351;b:1;i:377;b:1;i:397;b:1;i:399;b:1;i:405;b:1;i:425;b:1;i:426;b:1;i:427;b:1;}','273,285,291,292,300,311,312,313,315,318,351,377,397,399,405,425,426,427','a:1:{i:265;s:2:\"on\";}',265,1,'77121990','20130101209','10313000665',94,3,1,1,1,NULL,'2024-09-05 22:08:48'),(272,'Karma  Jamyang','kjamyang@tech.gov.bt','10202001032',NULL,'$2y$10$5wEmaVgrL8TjBlZm5owlveXCRMP4GSXZvKQr1VzDT1us8sjx61l/S',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17171988','201201047','10202001032',76,3,1,10,1,NULL,'2024-09-05 22:16:04'),(273,'Karma Yuden Dorjee','kydorjee@dit.gov.bt','11513003141',NULL,'$2y$10$RfjecU8V2TRM4e65etLQueCZLTna8pd5gnTI/bbzOV8jrAZ1kaPKi',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17775077','20160106528','11513003141',77,4,2,10,1,NULL,'2024-09-02 22:33:19'),(274,'Dechen  Chhoeden','dchhoeden@plantech.gov.bt','11512004182',NULL,'$2y$10$nLEDHOnZ34LukLG.QY4lg.VQw2rPKJYFu8s7Po/zfCYdBEy72/Y96',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,'a:9:{i:263;b:1;i:268;b:1;i:309;b:1;i:320;b:1;i:330;b:1;i:331;b:1;i:346;b:1;i:347;b:1;i:428;b:1;}','263,268,309,320,330,331,346,347,428',NULL,NULL,1,'17651405','200701052','11512004182',80,2,2,1,1,NULL,'2024-09-05 21:40:50'),(275,'Karma  Thinley','kthinley@tech.gov.bt','10710001137',NULL,'$2y$10$QLJhy7YHfgxHCUbvXvPvtu5.c7Q52Lu5YF3h61/Mn2eGhdwh.cnsi',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'0','201002038','10710001137',97,8,1,10,1,NULL,'2024-09-05 22:18:31'),(276,'Lhamchu  ','lham@tech.gov.bt','11807000315',NULL,'$2y$10$duQkVbfDJsp271hfwWaFzu8DMbuJgYRbMBWI3HqoXvDi.tVP16soO',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17664749','200711014','11807000315',13,9,2,10,1,NULL,'2024-09-05 22:19:18'),(277,'Lungten  Tshering','ltshering@tech.gov.bt','10708001664',NULL,'$2y$10$AHwS4LmtaaEOQjFvw0XUcuz6tHVIBBlpb4DOTt4kSEPlalbkCpXX6',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17739537','200806003','10708001664',98,8,1,10,1,NULL,'2024-09-05 22:20:33'),(278,'Ganga Ram Thapa','Gaganleo@yahoo.com','11301002639',NULL,'$2y$10$EWgRw9EP.LmEBePe.3.dDulyZBoDT3KNmoV6ogHYOhPl.taGa4.j6',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17816188','201005100','11301002639',25,12,1,10,1,NULL,'2024-09-05 22:22:17'),(279,'Bhim Raj Gurung','p.dukpa2013@gmail.com','11308003597',NULL,'$2y$10$Qqxs8mcSb94uyknQSp5Wf.vzgHfYRJtRpA4KHMF1Tc.srw9B4XLXa',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17891681','201010013','11308003597',25,12,1,10,1,NULL,'2024-09-05 22:23:42'),(280,'Jamyang  Sonam','jsonam@plantech.gov.bt','10903000783',NULL,'$2y$10$M/ZTgOWWaWO1Rf38zSf0e.fqG0XBfIdWpS3ZZNpCV1VkyLTL0qo7m',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,NULL,NULL,NULL,NULL,1,'17852415','200901132','10903000783',76,3,1,10,1,NULL,'2024-09-05 22:23:02'),(281,'Deepika  Rai','drai@tech.gov.bt','11203003778',NULL,'$2y$10$TZSe.D6cO/sR/9uPtaFuCORfLXC1bxfgELEn.469Otohg8zNdX53O',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,'a:5:{i:280;b:1;i:298;b:1;i:304;b:1;i:363;b:1;i:394;b:1;}','280,298,304,363,394',NULL,NULL,1,'17651405','200801097','11203003778',75,2,2,1,1,NULL,'2024-09-05 21:43:35'),(282,'Phurpa  Wangchuk','phurpawang3337@gmail.com','10905000425',NULL,'$2y$10$OHWW4/8TAO5Txp0F6CoSIOwb6jlP8VnueRRTlg/qP8RRyKUlxz2Fu',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17618539','200311041','10905000425',25,12,1,10,1,NULL,'2024-09-05 22:24:15'),(283,'Mohan Kumar Pradhan','mkpradhan@moic.gov.bt','10212000217',NULL,'$2y$10$1cpfNYNJUAguCblv9WyYm.QlLXlwx7wwyp8dO4xZ96A8vB6v15OEW',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17601824','9808107','10212000217',30,4,1,10,1,NULL,'2024-09-05 22:25:27'),(284,'Mon Maya Rai','monmaya202@gmail.com','21202000024',NULL,'$2y$10$qVCnO6dbgcjJHV8UV/KP.ONRJiXMKYi9LGOMFO7tcm.IngTRm5gKq',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17729272','21202000024','21202000024',NULL,NULL,2,10,1,NULL,'2024-09-01 22:51:00'),(285,'Thuenzang  Choephel','tchoephel@tech.gov.bt','11107001897',NULL,'$2y$10$Ms0Tu2Mxsj22HvHAHRNmi.qBWlu6WhrqJ5j2/PP8vHcQL4rpX3c.m',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,NULL,NULL,1,'17868363','20170107951','11107001897',99,4,1,10,1,NULL,'2024-09-05 22:27:55'),(286,'Jigme  Choeda','jigmec@tech.gov.bt','11508003932',NULL,'$2y$10$39crdMAfA4bC1pA4KNNtRe4GIgOdUpmcv8BWxaXs72PwfhUiwecS6',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17909710','2107128','11508003932',30,4,1,10,1,NULL,'2024-09-05 22:28:52'),(287,'Rinchen  Khando','rkhando@tech.gov.bt','11107003320',NULL,'$2y$10$IEvAD713hTKUki/zShA4HuScqzOfveaa4elCfuFPWeCUKSYIzG7Bq',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17751134','20180111311','11107003320',99,4,1,10,1,NULL,'2024-09-05 22:30:04'),(289,'Menlam  Choden','mchoden@tech.gov.bt','11603005434',NULL,'$2y$10$V3UNykwTDYBGCcQj3Zsx.OTm3CmMcI9bWH690bznE5/hueuVgEuRK',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17834560','20200116604','11603005434',19,6,2,10,1,NULL,'2024-09-05 22:30:45'),(290,'Kunzang  Dorji','kunzangdorji@tech.gov.bt','11008001835',NULL,'$2y$10$ebirjbP9tPy1A4At/VHEbuJFEikRQeIv35OcQ7Jx3LoKGsA/S1LIW',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'1','200901239','11008001835',86,3,1,10,1,NULL,'2024-09-05 22:32:06'),(291,'Cheki  Dorji','chekidorji@dit.gov.bt','11512001429',NULL,'$2y$10$OaEpoVdIEbfj3RzAuzdxWe.XjSNMLOCusx5DrAOWe2dsZF0h4Jgcu',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17563360','20150105024','11512001429',99,4,1,10,1,NULL,'2024-09-05 22:33:34'),(292,'Yeshey  Choden','ychoden@tech.gov.bt','11410000543',NULL,'$2y$10$mVWCXAAb/GlT8dbPcbJM0ehNOy/cI.Ma3QWBBK9UcwBI6ijltVvF.',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'77223767','20160106545','11410000543',99,4,2,10,1,NULL,'2024-09-05 22:34:33'),(293,'Chandra  Alley','123@gmail.com','11810000349',NULL,'$2a$12$H19DZEknYuhAf2q6BQMbaeHINIr2bloLLzoWN06Y7lO1bXmlIIUZ47',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17747475','11810000349','11810000349',NULL,NULL,2,10,1,NULL,'2024-09-01 23:07:57'),(295,'Thuley Prasad Dahal','Thule@gmail.com','11205001802',NULL,'$2y$10$zfylaomudN0edZgbm24wuupL4q2ouPH57DuhtDT2GHQj1WW8CFxu6',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'77315611','11205001802','11205001802',88,15,1,10,1,NULL,'2024-09-01 23:08:27'),(296,'Aita Raj Subba','12@12.com','10311002341',NULL,'$2y$10$qQOSp8uJ7dBGMTmNxASlXufpdyeD.BBNjlCwr9xyNY1EfAu2xBIqe',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17891073','10311002341','10311002341',88,15,1,10,1,NULL,'2024-09-01 23:08:55'),(297,'Sonam  Lhamo','slhamo@dit.gov.bt','10101002824',NULL,'$2y$10$8U50UpJVOVwu3P4KbV98quK57ErM.ETRbxGh6biAqELSaZ6hS6yy.',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'77297030','200901145','10101002824',76,3,2,10,1,NULL,'2024-09-01 23:09:38'),(298,'Tshering Namgyay Wangchuk','tnwangchuk@tech.gov.bt','11502001908',NULL,'$2y$10$POnFp3VOCM1aS6fWvvAZK.SJ3C8uvPYaintY1bHh/SDX.prw6BNMG',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,NULL,NULL,NULL,NULL,1,'77490949','202105918619','11502001908',100,6,1,10,1,NULL,'2024-09-05 22:39:10'),(299,'Gyeltshen  ','shagyeltshen2015@gmail.com','11910000253',NULL,'$2y$10$q8fW2tNAn25eCg8RZhhFj.KIqdh535Q8qcQg7818//xNd8vvy2N/K',NULL,NULL,NULL,NULL,NULL,1,3,17,NULL,NULL,NULL,NULL,NULL,NULL,1,'77874975','202107919373','11910000253',28,15,1,10,1,NULL,'2024-09-05 22:40:28'),(300,'Kinley  Dorji','kdorji@tech.gov.bt','11107003082',NULL,'$2y$10$JAL0jCZDAQtW1ainqVJ9Sewqs4lTzfOBhZ0uJCcrXsZsVTotyGCKO',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17571994','202107918795','11107003082',87,5,1,10,1,NULL,'2024-09-05 22:42:27'),(301,'Pema  Selden','pselden@dit.gov.bt','11410009189',NULL,'$2y$10$YKjsUgwu3JUd9JiVVQ62le8ty1t/f1xysAFx/0BTls/4xGGB.msE.',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17388493','202107918944','11410009189',19,6,2,10,1,NULL,'2024-09-05 22:43:19'),(302,'Kinley  Dema','kdema@tech.gov.bt','10203003301',NULL,'$2y$10$LWGkLNFmKHCX2xJpHC/zPObJhr3OUNn7rrKTb9aHRRCYem475ydWG',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17739984','202107918942','10203003301',19,6,2,10,1,NULL,'2024-09-05 22:44:32'),(303,'Tshering  Wangchuk','tsheringwangchuk@tech.gov.bt','10601002433',NULL,'$2y$10$1GR7GNVPOKsRNf5M51BzeOKbZ3Bag.X8YbbskMpojQnWlxU/Ohbge',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17755548','20170107952','10601002433',89,5,1,10,1,NULL,'2024-09-05 22:45:43'),(304,'Tshokey  Lhamo','tlhamo@plantech.gov.bt','10903003137',NULL,'$2y$10$L4u1TCEluGdmqQ60rNwwxO0thZSJUrcC9hslCt1modA0SSj/yHUIC',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,NULL,NULL,NULL,NULL,1,'17411496','202107918945','10903003137',100,6,2,10,1,NULL,'2024-09-05 22:47:01'),(305,'Sonam  Lhazom','slhazom@tech.gov.bt','11410002290',NULL,'$2y$10$bvXsQUFuIcgHCE5urZgutOYtWLtj2eC/.BFm2pXiRbL/cLR3O97nG',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17609756','9101088','11410002290',16,7,2,10,1,NULL,'2024-09-05 22:48:57'),(306,'Chedup  Dorji','chedupd@tech.gov.bt','11104001019',NULL,'$2y$10$pHqgyTBuUJ3PnK5IzBsIiufUv5NlR366IbDCfVGK6.4Ru00C50Izy',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17696879','200701167','11104001019',102,3,1,10,1,NULL,'2024-09-05 22:50:26'),(307,'Kinley  Yoezer','kyoezer@tech.gov.bt','11508003516','2024-09-04 03:18:21','$2a$12$PCNAEKD.5aNdUHfXx1pngOGfAIgKZvFN9AUO4Wav4dhIhzlHxGhn.',NULL,NULL,'wg8sEfDaoBvwsNG2wHsY6eEUpsx5rDd69KR4911tXsCw5ynKq53TbkpUWksI',NULL,'profile-photos/kR8ECsiRiYCTPZExvSBKQZAA7aPl2wvrtnWdlAb1.png',1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17622962','202201920473','11508003516',19,6,1,10,1,NULL,'2024-09-05 22:51:36'),(308,'Jigme  Wangdi','jwangdi@moic.gov.bt','11807000767',NULL,'$2y$10$gUDOBFpfCio0oj6BVzPkce1TB3MCsVLsWnlr.bZ2xDU9JALOxtQ3a',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17392870','20170107817','11807000767',103,5,1,10,1,NULL,'2024-09-05 22:53:27'),(309,'Sonam  Dorji','sdorji@tech.gov.bt','11908000518',NULL,'$2y$10$Bj0axxQgw4DSRcWUtCDv9uhNUCDCkGkChKVOxI7men0n.XEIS42tC',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17571923','202201920472','11908000518',19,6,1,10,1,NULL,'2024-09-05 22:54:34'),(310,'Praneesha  Acharya','pacharya@tech.gov.bt','11805001462',NULL,'$2y$10$rKHXPnda/E/P/rYcSCN5tOfErdsIH1fwLRkXV4QgQeAqOkwMW/t.O',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17996354','202201920469','11805001462',19,6,1,10,1,NULL,'2024-09-05 22:55:45'),(311,'Migma  Tshering','mtshering@tech.gov.bt','11807000109',NULL,'$2y$10$atEC3GOeyoO5d8bGsrM4K.tgLFbxVVDiy7HAhUj1RF8rBZ6Rop7c6',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17400635','202201920471','11807000109',19,6,1,10,1,NULL,'2024-09-05 22:56:54'),(312,'Tenzin  Jamtsho','tjamtsho@tech.gov.bt','11306001514',NULL,'$2y$10$GUBhzVaQsOD3UHax7.JUbuddlCXGuG0NmeEWXwHp4vRWwczRNE9cW',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17749451','202201920427','11306001514',87,5,1,10,1,NULL,'2024-09-05 22:59:15'),(313,'Niraj  Koirala','nkoirala@tech.gov.bt','11805003616',NULL,'$2y$10$eclkuj2suIRsugEYiMQZiezwp5jwmDaDkqwbk/LtjptAhHTIupFIW',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17772115','202201920438','11805003616',87,5,1,10,1,NULL,'2024-09-05 23:00:07'),(314,'Tashi  Choden','tashic@tech.gov.bt','11812002003',NULL,'$2y$10$N5lAsnH3B/F2yVgWnm8xEOREikynnLFkAbV5/EwbBH9MKw0MJDLLG',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,NULL,NULL,1,'17765065','20150105101','11812002003',77,4,2,10,1,NULL,'2024-09-05 23:01:02'),(315,'Sangay  Pelzang','spelzang@tech.gov.bt','11504000516',NULL,'$2y$10$q.kbPSIb7nEH/tWh4mdF8emzHy3wgWkLmeBgUXD6HmpDEuk8MyFaS',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17919197','20130101217','11504000516',76,3,1,10,1,NULL,'2024-09-05 23:02:20'),(316,'Ugyen  Namgay','unamgay@tech.gov.bt','11302000754',NULL,'$2y$10$JNJj1As9VZGVy5pqjTiq0OHuCaa4PskHbgJn3BeZ5EqZfkCLHu60a',NULL,NULL,'XgEoFRmEWcoXiJ8HcC4Q18KFSBUUHzTrYdgYrJTJsLZwEJX4mqHRSDAoM1HM',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17970026','202201920477','11302000754',19,6,1,10,1,NULL,'2024-09-10 20:43:14'),(317,'Choney  Wangmo','cwangmo@tech.gov.bt','11512004308',NULL,'$2y$10$Xp9u5gv5iiYdCWxkk9ouPOO4LUSNVzZneDyab9MnriGhu5arHdYtq',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'77336215','202107919052','11512004308',19,6,2,10,1,NULL,'2024-09-05 23:03:40'),(318,'Thakur  Timsina','ttsina@tech.gov.bt','11206006175',NULL,'$2y$10$oPyXiOBs4lLyCWl.DcO8pu8n/SZN38sxBu3P6iKLyFCAwqpl4ahbu',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'77298430','202211922114','11206006175',19,6,1,10,1,NULL,'2024-09-05 23:05:16'),(319,'Tshering  Penjor','tpenjor@tech.gov.bt','11104002712',NULL,'$2y$10$AKsljoMpAHY29H1DBQuvZuB8hcn6CgQLUawpKwm6gEfZcGy90UCey',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'77201488','200207039','11104002712',30,6,1,10,1,NULL,'2024-09-05 23:06:33'),(320,'Mohan  Subba','msubba@tech.gov.bt','11811003226',NULL,'$2y$10$oCgUweEVEqL305XFhDmFpeFSOHiPkSfJjz2xWBv2ZUOvts3i2x8wm',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17947527','20180111374','11811003226',89,5,1,10,1,NULL,'2024-09-05 23:07:28'),(321,'Tashi  Wangmo','twangmo@tech.gov.bt','11704003427',NULL,'$2y$10$lNtnMYR/EzdtQ8opGPaBDOznZ2md/TjXcsAOaascl4ohOXMhY.7ta',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17800856','202301922976','11704003427',19,6,2,10,NULL,NULL,'2024-09-17 05:31:08'),(322,'Chimi  Dema','cdema@tech.gov.bt','10101004997',NULL,'$2y$10$kn9Z9zvYpbnaNF9F25nfqOR898kq1WH2rer5Nt/lZZBf1o0qyy38q',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17919441','202301922834','10101004997',19,6,2,10,1,NULL,'2024-09-16 21:29:08'),(323,'Tshering  Pema','tpema@tech.gov.bt','11102007577',NULL,'$2y$10$al2U0r3oiYhueTlnm6TTeeZrX3It2oEiHGe4Y7..A8OW7u9NcIkzS',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17359479','202301922850','11102007577',19,6,2,10,1,NULL,'2024-09-06 03:29:05'),(324,'Dorji  Tshering','dtshering@tech.gov.bt','11504001986',NULL,'$2y$10$T6PrG6xHSnpNq.u7VWpUeuaJVm5dXYwuF6ZAk8jWns/qfvRz5Ryre',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17368512','202301922978','11504001986',19,6,1,10,1,NULL,'2024-09-06 03:31:13'),(325,'Sonam  Dorji','sonamd@tech.gov.bt','10502000646',NULL,'$2y$10$lUr4ZnPBUVksGiqwuUmK6.jzLg.5kNNoygUvKuHZA1p6ySGHFp/9O',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17460023','202301922847','10502000646',19,6,1,10,1,NULL,'2024-09-06 03:32:07'),(326,'Ugyen  Dorji','udorji@tech.gov.bt','10208000315',NULL,'$2y$10$kWNZPAge6b26g/SXRISrgu7uljkEjnIEeXWkquALV4lsXwIamr4kS',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17348644','202301922793','10208000315',19,6,1,10,NULL,NULL,'2024-09-09 03:34:57'),(327,'Choney  Lhamo','clhamo@plantech.gov.bt','10901001561',NULL,'$2y$10$stVSy.rVMkEDsLUuwCu4YeyOECqdlS09KutUy8Zt9DWNtdQWKCp0W',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17826480','202301922795','10901001561',19,6,2,10,1,NULL,'2024-09-05 23:04:23'),(328,'Pema  Namgay','pnamgay@tech.gov.bt','11608002721',NULL,'$2y$10$HUC9H1QcPxA.I.xAxOwXFerwybikETH4Y.KQsYJNlEoMEeqlTP2Iu',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17364182','202301922800','11608002721',19,6,1,10,1,NULL,'2024-09-06 03:33:36'),(329,'Pema  Wangchuk','pwangchuk@tech.gov.bt','11005000661',NULL,'$2y$10$57PGygJZPF5bmjVJ2MP77uuShx/AOar32Hp.yP6cezS1yAdbi2gcG',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17253255','202301922791','11005000661',19,6,1,10,1,NULL,'2024-09-06 03:34:12'),(330,'Thinley  Phuntsho','tphuntsho@tech.gov.bt','11603000359',NULL,'$2y$10$DmwWvWPWYINEQ1U/dXoeveIx2usJKUKRypruQAckVbJOvDVD0joIS',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'77471330','202301922853','11603000359',19,6,1,10,1,NULL,'2024-09-06 03:35:08'),(331,'Deki  Wangmo','dwangmo@tech.gov.bt','10705001787',NULL,'$2y$10$JZ976b5szShV1Lmd8gmIpudmKbMqHZBlv2IO1Ro75FwLpjLB31ERS',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17461844','202301922797','10705001787',19,6,2,10,1,NULL,'2024-09-06 03:35:55'),(332,'Nima  Wangchuk','nwangchuk@tech.gov.bt','11514003611',NULL,'$2y$10$pM7RuKWH9ft0idCN/olnF.WnVB/DtPXBQFB7iOUbNNXQO1pvhMMr.',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'17846649','202301922792','11514003611',19,6,1,10,1,NULL,'2024-09-06 03:37:21'),(333,'Ugyen  Tenzin','utenzin@tech.gov.bt','11405001240',NULL,'$2y$10$Yc9N2CZBCyxzGNNLTonyP.2QLib3irXbKlktaLhhDekJjcXuqAhCu',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,'a:8:{i:314;b:1;i:332;b:1;i:334;b:1;i:335;b:1;i:336;b:1;i:338;b:1;i:381;b:1;i:419;b:1;}','314,332,334,335,336,338,381,419',NULL,NULL,1,'1','200801121','11405001240',95,2,1,1,1,NULL,'2024-09-05 21:47:19'),(334,'Tandin  Dorji','tandindorji@tech.gov.bt','11410004494',NULL,'$2y$10$Vla39JEvMC0dqeZE35Zj0eU7SWDdCifaAik2QGa68hI9R45psXD32',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'1','200407046','11410004494',29,5,1,10,1,NULL,'2024-09-06 03:38:40'),(335,'Deki  Dema','ddema@tech.gov.bt','11105002071',NULL,'$2y$10$RWM8GCduyZoM4AEMpzzlruMFEmZnDqlOJMJ50757wq6tZGNQorbBy',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'77483564','202301922848','11105002071',19,6,2,10,1,NULL,'2024-09-06 03:36:38'),(336,'Dechen  Dema','dechendema@tech.gov.bt','11504001283',NULL,'$2y$10$/TZqFNiLGLlgcF4K/53zEe2XKV2snfD/UgAhhPrEdQGZKpz1wtSRm',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'17618144','20140103331','11504001283',104,3,2,10,1,NULL,'2024-09-06 03:40:24'),(337,'Younten  Jamtsho','yjamtsho@tech.gov.bt','10904002389',NULL,'$2y$10$XjlmHVHZiqdx5pJ5m7PJMedI3qwXBl1Q.8F2v0e0IakUy0SBjlS2i',NULL,NULL,'iIpEnPZUJWKEfAXjykuArQ2CUHwuKX4YlAHehGAcB9DNsPQkzuoQLHRwwpsj',NULL,'profile-photos/wdkVa6TnE78No9NYSt5JQBpNe5zqzVBzhk9P6Ywi.jpg',1,1,1,NULL,NULL,'a:21:{i:303;b:1;i:307;b:1;i:310;b:1;i:316;b:1;i:317;b:1;i:321;b:1;i:322;b:1;i:327;b:1;i:343;b:1;i:345;b:1;i:382;b:1;i:391;b:1;i:395;b:1;i:398;b:1;i:406;b:1;i:407;b:1;i:408;b:1;i:412;b:1;i:417;b:1;i:429;b:1;i:432;b:1;}','303,307,310,316,317,321,322,327,343,345,382,391,395,398,406,407,408,412,417,429,432','a:1:{i:352;s:2:\"on\";}',352,1,'77230307','200801094','77230307',75,2,1,1,1,NULL,'2024-09-11 20:52:52'),(338,'Sonam Zam Lhagyel','slhagyel@tech.gov.bt','10502001346',NULL,'$2y$10$purRSyZnlrIcPLz.S.0vCeVOoKOxpPD9h9wL2Gg4JiX00IEbGH1sm',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'17246182','20170107784','10502001346',105,6,2,10,1,NULL,'2024-09-06 03:42:33'),(339,'Gayden  Lhendup','gaydenlhendup@tech.gov.bt','11606000253',NULL,'$2y$10$mygyH7wU6.HPud2kHUTjX.ifmLAJGTE.3RdevIGzQiTNoEmwIks1q',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17485839','20200116187','11606000253',19,6,1,10,1,NULL,'2024-09-06 03:43:16'),(340,'Tshering  Wangchuk','tsheringwangchuk1@tech.gov.bt','10204000116',NULL,'$2y$10$zaEvSvosKuqHpas7E6yFfuESvLAo3g.lnEyCCyz62aiv0f6.jNGGa',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17413597','20180111301','10204000116',89,5,1,10,1,NULL,'2024-09-06 03:44:19'),(341,'Tshewang  Dema','tshewangd@tech.gov.bt','11904000862',NULL,'$2y$10$c8cjjn0AM2AtvyDVezNWCu36wOVbrctX0kBgOwKU2FqUNVn8iFYhq',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'77797619','202107918947','11904000862',89,5,2,10,1,NULL,'2024-09-02 22:12:47'),(343,'Dil Bdr Basnet','dbbasnet@tech.gov.bt','10205003338',NULL,'$2y$10$HHsc3hRFywYy5f/UUTjCweVh33qc/RX0EpRCw6A0KVpfB3QD.2bBS',NULL,NULL,'Jk66uzvKRxuu7gLjbh1DMqNlLzh51h9OckTKqaLVZSN6lzvY51QDhM44aDWj',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17291339','202201920824','10205003338',19,6,1,10,1,NULL,'2024-09-02 21:57:54'),(344,'Ram Lal Poudel','ramlalpoudel@tech.gov.bt','200507043',NULL,'$2y$10$g/z.OBvFg85XKFFWENcGH.x9M4U1ew/omumvUFQsI0/ZlMrmpYae2',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'1','200507043','200507043',30,4,1,10,1,NULL,'2024-09-02 22:12:41'),(345,'Sangay  Wangchuk','swangchuk@tech.gov.bt','11504002437',NULL,'$2y$10$LnZnduE4AODjK91HQh.vKe2x37UtVwntPMdOELjX8503RX9GO4ksS',NULL,NULL,'aaCGX0lGLb3uaTKyPQo8CGPrRVI8KInWf8d5ETZhgPOMTrn9MAucoXzCZmWp',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17614102','202201920474','11504002437',19,6,1,10,1,NULL,'2024-09-15 21:02:13'),(346,'Tshering  Dorji','tsheringd@tech.gov.bt','10709003924',NULL,'$2y$10$MwsOuowAKThhjWuyV0znV.WmQlrJMjcxIxDdMiK.NrsHTenTE/sCW',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17609150','2107130','10709003924',76,3,1,10,1,NULL,'2024-09-02 22:29:55'),(347,'Tashi  Tshering','ttshering@tech.gov.bt','11508003671',NULL,'$2y$10$yxPZWEbWPoyLYKbCBWJEgu3gRTrGWb2U9HXT42.ZaUIyDY9awT8CO',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'17646786','2107138','11508003671',76,3,1,10,1,NULL,'2024-09-06 03:48:55'),(348,'Karma  Sonam','ksonam@tech.gov.bt','10811002339',NULL,'$2y$10$utiZq4pO2RN4hpt4rMqEv.rDHt52j3BRc1.uW3VRcY5eVOa7UQsAq',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,'a:10:{i:1;b:1;i:261;b:1;i:349;b:1;i:350;b:1;i:385;b:1;i:386;b:1;i:388;b:1;i:411;b:1;i:416;b:1;i:435;b:1;}','1,261,349,350,385,386,388,411,416,435',NULL,NULL,1,'17620109','200501146','10811002339',75,2,1,1,1,NULL,'2024-09-02 21:55:02'),(349,'Dema  ','dema@tech.gov.bt','10805001428',NULL,'$2y$10$Vch0gB87gRGme9WPbDUkv.mZYGP9dDTyIphPqjz0H2yPbfyQTIe5K',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17635323','202301922794','10805001428',19,6,2,10,1,NULL,'2024-09-02 22:10:09'),(350,'Kinga  Dorji','kingad@tech.gov.bt','10905000888',NULL,'$2y$10$A66UqiMtn4JpSFyco9EVPOduscM0eDb3IoKcByUefZyZHpPJz49g6',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17880849','202301922798','10905000888',19,6,1,10,1,NULL,'2024-09-02 22:10:03'),(351,'Pooja  Lepcha','plepcha@tech.gov.bt','11214002488',NULL,'$2y$10$tQ28WVGoTvZAcLSuvZBBpeJwACDjB64kRWopyLDMMW07CRUYzB1qq',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17546198','20160106502','11214002488',99,4,2,10,1,NULL,'2024-09-06 03:51:58'),(352,'Kuenga  Zam','kzam@tech.gov.bt','11410007521',NULL,'$2y$10$aZNb1iMp7NarO73MagpKhuNJ0UNtmWN46wnIC8w3rIHSWFIhcOshu',NULL,NULL,NULL,NULL,NULL,1,1,18,NULL,NULL,NULL,NULL,NULL,NULL,1,'17986397','20601066','11410007521',2,23,2,1,1,NULL,'2024-09-05 22:06:55'),(353,'Jigme  Choden','jigmechoden@moe.gov.bt','11501002220',NULL,'$2y$10$UpYB38Lx4.jkJGYpgMeAW.C.Qctsp0yJ6Tik6PHuitTlEvv4gUjV.',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17831006','200701060','11501002220',76,3,2,10,1,NULL,'2024-09-05 22:14:10'),(354,'Peldon  ','peldon@tech.gov.bt','11312002655',NULL,'$2y$10$W0EiZiLcO3cLxaqBgPNDF.F99o4l/gZ/miP7X8P2ycWDBU.dZIkna',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17798668','200701058','11312002655',80,2,2,10,1,NULL,'2024-09-05 22:15:45'),(358,'Tshewang  Yuenden','tshewangy@tech.gov.bt','201201041',NULL,'$2y$10$v3CTWL4mNEFQ6ti1O9eFIu.dPzL0SCSjNIP1hFjMplZUROpaGAEW2',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'1','201201041','201201041',89,5,2,10,1,NULL,'2024-09-02 00:08:42'),(360,'Tshering  Tobgay','tt@gmail.com','2107139',NULL,'$2y$10$qM6S1yrN/aNcT1CezD2L0ebO6q6Nx8kWzuVKkY5WIC6fcx5jJw6Iu',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'1','2107139','2107139',19,6,1,10,1,NULL,'2024-09-02 00:09:48'),(361,'Oma Pati Luitel','opluitel@tech.gov.bt','201001122',NULL,'$2y$10$CBgsj9rELJxKufe36cXqZuFQ6fs1r7tYIBgDl9nZbG7V.TOK7h/ju',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'1','201001122','201001122',19,6,1,10,1,NULL,'2024-09-02 00:10:55'),(362,'Pema  Gyeltshen','pgyeltshen@tech.gov.bt','11410009086',NULL,'$2y$10$4miM.TnvkCYfktVi.QnjCuJ/ZnnAiaLJrrjk5tJQ68jtoEoJgzPdC',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'77377676','200701063','11410009086',80,2,1,10,1,NULL,'2024-09-05 22:12:33'),(363,'Yangku  Dorji','yangkud@tech.gov.bt','11506002781',NULL,'$2y$10$X6.YTfqNxqV1y8OOsitfteJTlKORN3drpGdRsMhR6wnmCK7LiPLp.',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,NULL,NULL,NULL,NULL,1,'17354522','202301922973','11506002781',90,6,1,10,1,NULL,'2024-09-02 00:12:12'),(364,'Thinley  Dorji','thinleydorji@tech.gov.bt','10604000309',NULL,'$2y$10$fMm/UtDXxrEzrWEQLqGk2OhDadHDt5XTloXZ5LyYUCagULvvTdfKa',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'77286229','201005085','10604000309',106,6,1,10,1,NULL,'2024-09-06 04:44:16'),(365,'Garab  Dorji','gdorji@plantech.gov.bt','10604000948',NULL,'$2y$10$AqjYki1ItCIwziYi51IGduxpPdz4bj9QtMK6aRIBlbnjxXjppELUS',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,'a:11:{i:326;b:1;i:364;b:1;i:366;b:1;i:367;b:1;i:368;b:1;i:369;b:1;i:383;b:1;i:396;b:1;i:413;b:1;i:415;b:1;i:434;b:1;}','326,364,366,367,368,369,383,396,413,415,434',NULL,NULL,1,'17114345','200601070','10604000948',75,2,1,1,1,NULL,'2024-09-05 21:54:52'),(367,'Sonam  Tshering','sonamt@tech.gov.bt','10716002957',NULL,'$2y$10$lUfSUSsz7yI5CMiNU4BTaeOIN5djOg4kTg9WgFr0hMiMMx/TJgzCq',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17359393','200701059','10716002957',76,3,1,10,1,NULL,'2024-09-02 22:17:17'),(368,'Sherab  Gocha','sgocha@tech.gov.bt','11106004143',NULL,'$2y$10$N/gNVXmBziemw8A3a8XReuyVfluGMkspWBcX41c6gHny9F6O1FYMC',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17990549','202107919310','11106004143',19,6,1,10,1,NULL,'2024-09-02 22:17:12'),(369,'Kinley  Wangmo','kinleywangmo@tech.gov.bt','11705001556',NULL,'$2y$10$X/gTRDcgoVDpVPHVNibSmOBuGCd5qEXtS/YWgtAAZbCm0ZY.yivDy',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17761052','201207918941','11705001556',19,6,2,10,1,NULL,'2024-09-02 22:17:05'),(370,'Tashi  Choden','tashichoden@tech.gov.bt','11604001358',NULL,'$2y$10$2on6tg0AAhaIPaKxqAO2guFVtp9VSVzTeIXpERZzAv8FbIR36W7ZW',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17512568','20200116182','11604001358',19,6,2,10,1,NULL,'2024-09-05 22:24:29'),(371,'Tashi  Younten','tyonten@tech.gov.bt','200507040',NULL,'$2y$10$ZRmIKBbSAP73pzE37rTJp.xZw0NV77dy6mN42EPj3PjPjipPL8luy',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17786824','200507040','200507040',84,5,1,10,1,NULL,'2024-09-02 22:05:49'),(372,'Thrichen  Khentse','tkhentshe@tech.gov.bt','11106001523',NULL,'$2y$10$20pzd.WT2KCenhWNfzpMr.qELQd3xfKFqmiU0CvmRJo5ySgXCSZRK',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'111','202201920476','11106001523',19,6,1,10,1,NULL,'2024-09-05 22:25:30'),(373,'Phuntsho  Wangdi','pwangdi@moea.gov.bt','11510000237',NULL,'$2y$10$frUzx4Ncl6yZ2zdjF7KM5O/ojRNt51fWp9ys7O5MLXXRNQViZSN.W',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17883358','20121201070','11510000237',79,6,1,10,1,NULL,'2024-09-05 22:26:37'),(374,'Ngawang  Sherpa','nsherpa@tech.gov.bt','11411001077',NULL,'$2y$10$JiWv8SRpBHCNBzb.FOnG5.qUPg6K5RxQxOIb/mfuqkAWct03O/mzm',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,'a:14:{i:328;b:1;i:329;b:1;i:339;b:1;i:340;b:1;i:341;b:1;i:344;b:1;i:393;b:1;i:409;b:1;i:410;b:1;i:414;b:1;i:420;b:1;i:422;b:1;i:431;b:1;i:433;b:1;}','328,329,339,340,341,344,393,409,410,414,420,422,431,433',NULL,NULL,1,'17604108','200501143','11411001077',75,2,1,1,1,NULL,'2024-09-02 21:55:44'),(376,'Sonam  Choden','schoden@tech.gov.bt','10102000035',NULL,'$2y$10$oWk1gsbZUt4WxpUGPmtWd.NG8lXXF3sAoeiRNPoLmiSt3nZbrqV2S',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17425172','202301922836','10102000035',19,6,2,10,1,NULL,'2024-09-05 22:27:32'),(377,'Jamyang  Chimi','jchimi@tech.gov.bt','11102006601',NULL,'$2y$10$1a3PBDd1C.kSmCKJ8Xz9muD56uuJAv0vqSL5CotmFTytxAzBNBCtG',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17917872','202307924084','11102006601',91,8,2,10,1,NULL,'2024-09-02 22:31:53'),(378,'Karma  ','karma@tech.gov.bt','11914001581',NULL,'$2y$10$s4xWKflpFxpMtTo/XJ6FA.KvcrbcpHocOjfVpsGZjMb8pd3qjGhI.',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,'a:15:{i:260;b:1;i:262;b:1;i:264;b:1;i:272;b:1;i:283;b:1;i:286;b:1;i:287;b:1;i:380;b:1;i:387;b:1;i:389;b:1;i:390;b:1;i:392;b:1;i:404;b:1;i:423;b:1;i:424;b:1;}','260,262,264,272,283,286,287,380,387,389,390,392,404,423,424',NULL,NULL,1,'17343018','200801072','11914001581',75,2,1,1,1,NULL,'2024-09-05 21:56:26'),(379,'Tashi  Wangmo','tashiw@tech.gov.bt','11602000757',NULL,'$2y$10$qvDvnV4i8WxnBOAjqIYyh.LDzxaAKua5WfSBZbUQnivV7qmBvEtwK',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17833657','202301922975','11602000757',19,6,2,10,1,NULL,'2024-09-02 22:06:12'),(380,'Ugyen  Tshomo','utshomo@tech.gov.bt','11603002815',NULL,'$2y$10$bE3HhQbC4r9ggC98Gax4P.k.gcrZGLBaP.1KJC.hSPXunI4w5w/FO',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17817754','202301922802','11603002815',19,6,2,10,1,NULL,'2024-09-02 22:36:53'),(381,'Tshering  ','tshering@tech.gov.bt','12007003297',NULL,'$2y$10$a5xPv3XD43CV4EcZp6RqqeDAeRNd4bXfbw5lZxy034yAF5q0g3uGm',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'17524715','200901150','12007003297',76,3,1,10,1,NULL,'2024-09-05 22:28:27'),(382,'Ugyen  Dema','ugyendema@tech.gov.bt','10203002051',NULL,'$2y$10$VFSOEd57TRRQFJY25X72.ux8RfyvyCPloDWIkzUTDhyhxZbqp42yy',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'16911437','202105918622','10203002051',19,6,2,10,1,NULL,'2024-09-02 21:59:45'),(383,'Kunzang  Dorji','kunzangd@tech.gov.bt','11509002217',NULL,'$2y$10$NGa918GVoLXBqSFY5CgQKOJ.oJUjgE4OjgGoVVmdMveXQpb3y5fWa',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'77753232','11509002217','11509002217',19,6,1,10,1,NULL,'2024-09-02 22:16:58'),(384,'Tenzin  ','ttenzi71@gmail.com','11504003915',NULL,'$2y$10$ZAJGTzpoBVv7MGheBY7of.VXiEcZ6yGtKXkEjZAR21jpTr03BEtwC',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17803753','9501037','11504003915',25,12,1,10,1,NULL,'2024-09-06 04:35:37'),(385,'Pema  Choden','pemac@tech.gov.bt','11107001466',NULL,'$2y$10$/X4B7duWrNnlbNDZ702zx.CiOA7Om4wSh0f7DXCAc.iGgedBG6A.q',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17678755','202401926440','11107001466',79,8,2,10,1,NULL,'2024-09-06 04:34:50'),(386,'Basundhara  Giri','basundharag@tech.gov.bt','11202004678',NULL,'$2y$10$98PzB3G2/HIrJb465byDhu.BTM4GY7GDpMdN0T8KEq9rPbVf6WliS',NULL,NULL,NULL,NULL,NULL,1,2,19,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17621223','8909002','11202004678',53,8,2,10,1,NULL,'2024-09-06 04:33:52'),(387,'Sonam  Dorji','sdorji123@tech.gov.bt','11106000277',NULL,'$2y$10$Pt8/iXNuUOl4OrDW6ZWENOSWUgoBJoZhuzlK.DzhlfqHuu5nOvS8O',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17457252','202401926439','11106000277',79,8,1,10,1,NULL,'2024-09-06 04:32:05'),(388,'Tashi  Lhamo','tashil@tech.gov.bt','10705003005',NULL,'$2y$10$G5PeQW7cAqCicRyMnIMTmuWzEbhUStIa535327tLy6Uh/2Dy15rZW',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17716889','202401925919','10705003005',19,6,1,10,1,NULL,'2024-09-02 22:10:39'),(389,'Dendup  Pema','dpema@tech.gov.bt','11504004072',NULL,'$2y$10$LRXBA7gu/ck3FsTcVDX5su7CbjxmIS8BE5ZpgtWAmboSP02/nU9mC',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17861261','202401926444','11504004072',79,6,2,10,1,NULL,'2024-09-06 04:30:41'),(390,'Sonam  Choden','sonamchoden@tech.gov.bt','10706000254',NULL,'$2y$10$V.5ocMZb6DLrZE3vkGSQxu1wNyYJHUJrp07vg4NDHLdBmroo2fjGK',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17414797','202401925920','10706000254',19,6,2,10,1,NULL,'2024-09-06 04:29:58'),(391,'Norbu  Wangchuk','norbuwangchuk@tech.gov.bt','11106001047',NULL,'$2y$10$2ATg4xvKlGWsQSYAa1sD..Vzt1YOurgX4dZLfK6YQAcbL7YRYMWUC',NULL,NULL,'Bq803FhglWWGTm0MkbuzjUu65s0jNirREaT4SmVHcc69qlKJZagFBHSVACsl',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,1,'17285325','202309924852','11106001047',19,6,1,10,1,NULL,'2024-09-02 21:21:34'),(392,'Tshering  Dekar','tdekar@tech.gov.bt','11107005502',NULL,'$2y$10$/v7qL6xSXg7vPbwkiBaCHefu8OjWvTHVzaVZWrrpMVPFReettTr1m',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17480526','202401925914','11107005502',19,6,2,10,1,NULL,'2024-09-06 04:28:40'),(393,'Choki  Wangmo','chokiwangmo@tech.gov.bt','11106000283',NULL,'$2y$10$p8vhZ.n7FPr6sTeN6M2tRePctzXNI.UgyLMRgargJG96S6Tjnbrzy',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17824568','202309924850','11106000283',19,6,1,10,1,NULL,'2024-09-02 22:12:16'),(394,'Jambay  Lhamo','jambayl@tech.gov.bt','11701000290',NULL,'$2y$10$z4yqpgNedQHldkolkFty3O3Fk0sZK7EaWmcsczT4Zj5Y6.jaDnzmS',NULL,NULL,NULL,NULL,NULL,1,1,5,NULL,NULL,NULL,NULL,NULL,NULL,1,'17901127','202401925912','11701000290',19,6,2,10,1,NULL,'2024-09-02 21:22:58'),(395,'Rinzin  Wangdi','rinzinw@tech.gov.bt','11601000855',NULL,'$2y$10$TmLEgdE0seTQqeAvdDdfO.2JthIIFsOBivV/FBuvLe6C3OchAt7Mu',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17332460','20170107926','11601000855',89,5,1,10,1,NULL,'2024-09-09 22:31:54'),(396,'Ugyen  Zangmo','uzangmo@tech.gov.bt','11509000041',NULL,'$2y$10$tKVWdbpQKw8Z16uAKWaGme4lk156KLxx3z1PzOGYxnuvH31E/Cs1S',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'16919219','20200116605','11509000041',19,6,2,10,1,NULL,'2024-09-02 22:16:51'),(397,'Samten  Gyeltshen','sgyeltshen@tech.gov.bt','11504003870',NULL,'$2y$10$lWtK/xJ9sPyROpcR6rAGQeIl8xvsBUFNtyH9Mh6HsQETB1YRTqjky',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17708849','202309924848','11504003870',19,6,1,10,1,NULL,'2024-09-02 22:32:03'),(398,'Lam  Dorji','ldorji@tech.gov.bt','11111002676',NULL,'$2y$10$88BMwFEcorirQW8DI7lf0Oqs..plu1yyZyyxHpiEZXorY4cOA9kg2',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17440458','202201920810','11111002676',19,6,1,10,1,NULL,'2024-09-15 21:11:45'),(399,'Dechen  Wangmo','dechenw@tech.gov.bt','10608001683',NULL,'$2y$10$GlM9WapIhOIn9KD8IQf9Bu6aa5vd3BNYafD9IclFf9w7AmyUswijO',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17546103','202310925258','10608001683',91,6,2,10,1,NULL,'2024-09-02 22:32:09'),(400,'Nima  Yoezer','yoeser7@gmail.com','10713000051',NULL,'$2y$10$efkSSG8P/GIRS9.SiOuvHeeLb5KpcnZ4ZPZEDkjHqGphiN/KqBTxC',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'77851384','202309924854','10713000051',28,15,1,10,1,NULL,'2024-09-06 04:24:21'),(401,'Thinley  Phuntsho','thinleyphuntsho23@gmail.com','11812000653',NULL,'$2y$10$E.nNEJL3VVdu9WtahIxG0.2tn9OLPyJ.0zIV8hzONde8K68.rHu6.',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17509135','202309924855','11812000653',28,15,1,10,1,NULL,'2024-09-06 04:23:35'),(402,'Rinchen  Dorji','rinchendorjee1984@gmail.com','10705002278',NULL,'$2y$10$H3WOxTsZbJPWurLwyj33nucDg5poCaeJP2WrM8iAA4qUr1yPLDx1C',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'17883209','202309924853','10705002278',28,15,1,10,1,NULL,'2024-09-06 04:22:47'),(403,'Dawa  Penjor','dawapenjor280@gmail.com','10711000781',NULL,'$2y$10$tUt.0hQ9sXamVSbGvwCVJuochbwt86lEp1p9Wjdqw2mbKZjp51cXK',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,'a:1:{i:267;s:2:\"on\";}',267,1,'173666002','202309924856','10711000781',28,15,1,10,1,NULL,'2024-09-06 04:22:00'),(404,'Tashi  Delek','tdelek@tech.gov.bt','10905003592',NULL,'$2y$10$.1yhb8U73iSNoBNBY6B.Z.y/chNrOgpvM4KzdM0HA0on6lWfg0eGq',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17366826','20180111302','10905003592',89,5,1,10,1,NULL,'2024-09-02 22:36:09'),(405,'Kinley  Norbu','knorbu@plantech.gov.bt','11102005468',NULL,'$2y$10$T1781W5d55KJYvqf6zbOGeJYr9m1Ayo51muB2G8fUmwk8AOhWtqjy',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17399994','20200116279','11102005468',87,5,1,10,1,NULL,'2024-09-06 04:20:57'),(406,'Neten  Dema','Ndema@tech.gov.bt','11605000895',NULL,'$2y$10$fF2kP1zl9zfkDdOvHPfmQ.3CklB1AwG9z8aN2L78GuamUfXIrq79K',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'77851865','202401926409','11605000895',79,8,2,10,1,NULL,'2024-09-06 04:20:17'),(407,'Nima  Lhamo','nlhamo@tech.gov.bt','11812000407','2024-09-04 05:06:01','$2y$10$v9l.p5ONEAhwsHiKZVHZZ./uP5vZ7NqjakgTeroOaC2BfVjTEFGaO',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'77712172','202401926415','11812000407',79,8,2,10,1,NULL,'2024-09-06 04:19:38'),(408,'Sangay  Pelzang','sangayp@tech.gov.bt','11504003845',NULL,'$2y$10$Ks9Vc2FvfcwTBtyunzqHRecAY7AThTudEZLSI5MhRP5F1QgGJlBhm',NULL,NULL,'8dt9H6WY0pLI9Av6EmwfSQa1KjRIuPRTGjwLsQH13j1hm0fa9CgmBZfEcwOr',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'77350081','202401926416','11504003845',79,8,2,10,1,NULL,'2024-09-11 21:05:15'),(409,'Tshering  Yangden','tyangden@tech.gov.bt','11505006436',NULL,'$2y$10$7bOv/3r32FjIxFV3Uc3wKe45O5yR30k/s.FIEdpJw4FAxTN1GRk2e',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'77391409','202401926413','11505006436',79,8,2,10,1,NULL,'2024-09-06 04:17:51'),(410,'Sangay  Jamtsho','sangayj@tech.gov.bt','10713003094',NULL,'$2y$10$eZuBIsCz0cY/khkGXHyO0OGPzJLOGn6ku/9ycJJu9TbssfkEF/PXm',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17926919','202312925484','10713003094',79,8,1,10,1,NULL,'2024-09-06 04:16:43'),(411,'Sangay  Wangmo','sangayw@tech.gov.bt','11513002795',NULL,'$2y$10$h8dofWWaTqshIRgGe/1nue1WgIJWC96Ub3OUk5q5hem7hM6FnI1ES',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'77849090','202401926422','11513002795',78,8,2,10,1,NULL,'2024-09-06 03:58:16'),(412,'Kuenzang  Namgay','knamgay@tech.gov.bt','11703001002',NULL,'$2y$10$T.FKu40xdQ6IO0nDP/fouuopyBKMt02ooHdLrrXNpiHv8V3F5N8uC',NULL,NULL,'6F4h5eX8JIpjQnlDcaRquaRHOz0sIVnPRgHifhEfTJMMH5GmnIksY7xaPhwL',NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17271466','11703001002','11703001002',19,6,1,10,1,NULL,'2024-09-02 22:00:18'),(413,'Lotoey  Pem','lpem@tech.gov.bt','11811002615',NULL,'$2y$10$LnO.sHpgRaH.b0kltb6rpOUlgUOHaoJZt1bBYV1CZ7.hnJR/evU7.',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17659684','200801101','11811002615',76,3,2,10,1,NULL,'2024-09-02 22:17:53'),(414,'Sonam  Jamtsho','sonamj@tech.gov.bt','11514001021',NULL,'$2y$10$dUjAaEXjgDpEtArJ0hnqf.QgNEeV9ZHEPkGBk0j45Oc1UD.RjutoW',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'16919326','20170107931','11514001021',89,5,1,10,1,NULL,'2024-09-02 22:11:55'),(415,'Tashi  Phuntsho','taship@tech.gov.bt','10101004625',NULL,'$2y$10$IljtigRp9rjluoHHXIjAOOIxre3pn1Hjox7MviYjIbvOlw3K0ECVC',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'77334451','202401925573','10101004625',19,6,1,10,1,NULL,'2024-09-02 22:17:48'),(416,'Dodrup Wangchuk Sherpa','dwsherpa@tech.gov.bt','11309001797',NULL,'$2y$10$tAUAPuiAXoJ1ORf6cjcU3e1A8VkV.gQS2JvcShFY7YQo.kjkU2wg.',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'77324679','202401925711','11309001797',19,6,1,10,1,NULL,'2024-09-02 22:11:07'),(417,'Tseten  Lhamo','tsetenl@tech.gov.bt','10708000191',NULL,'$2y$10$VDzzSx3qOibHIqIE1LvKBei1IIUhfeFHkI/zjeLHP1oHwowtI6T.S',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17819973','202401925812','10708000191',19,6,2,10,NULL,NULL,'2024-09-17 05:30:14'),(418,'Ugyen  Tenzin','ugyent@tech.gov.bt','10705000241',NULL,'$2y$10$M4AWIHj5BqgOjzYBScSoae4r9wUKh6ccPcOMpwOVnQ5pYiqu9SSsu',NULL,NULL,NULL,NULL,NULL,1,2,8,NULL,NULL,NULL,NULL,NULL,NULL,1,'17460019','202401925666','10705000241',19,6,1,10,1,NULL,'2024-09-02 21:52:10'),(419,'Sherab  Wangchuk','sherabw@tech.gov.bt','11407000217',NULL,'$2y$10$AIjprUdtHqfc43nJP0qpt./YvLGHzYPI15ESbaB1KVPz1YBbw2qSq',NULL,NULL,NULL,NULL,NULL,1,3,12,NULL,NULL,NULL,NULL,'a:1:{i:333;s:2:\"on\";}',333,1,'17407445','202401925586','11407000217',19,6,1,10,1,NULL,'2024-09-02 22:18:08'),(420,'Tandin  Wangmo','tandinw@tech.gov.bt','10706002847',NULL,'$2y$10$RVQ011KOk.ZXP0u1t65U0.0RNrAFWjMCgjuWtk/99FXYvTHj65WV2',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17550117','202401925783','10706002847',19,6,1,10,1,NULL,'2024-09-02 22:11:50'),(421,'Kencho  Pem','kpem@tech.gov.bt','11406000356',NULL,'$2y$10$pbsUr.xJTGbYtqgBbJ/Ude.BQQ3WZRSXTzLOp5OAQ9viCDoLSKxFW',NULL,NULL,NULL,NULL,NULL,1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,1,'17280992','202401925602','11406000356',19,6,2,10,1,NULL,'2024-09-02 21:49:28'),(422,'Nar Maya Tamang','nmtamang@tech.gov.bt','11109002104',NULL,'$2y$10$xzkOzeVU7S8WbnmuRlOE4uBShZqpMd7mDQocamkOQ0EwQL3EQtsY.',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17899665','202401925834','11109002104',19,6,2,10,1,NULL,'2024-09-02 22:11:44'),(423,'Sonam  Choki','schoki@tech.gov.bt','11104003199',NULL,'$2y$10$DzM6g.V./wHq/oMdzm7Vg.FlKdw7WURovrT6UqwX5Qe5qLZ1aNKz2',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'17429476','202401925900','11104003199',19,6,2,10,1,NULL,'2024-09-02 22:37:11'),(424,'Sonam  Tshering','stshering@tech.gov.bt','10713000969',NULL,'$2y$10$w1HeDvk3kezsiO9yinP2tOGBRTANeuDx/M0NaYNTbUPLJJ/KaQpQO',NULL,NULL,NULL,NULL,NULL,1,2,6,NULL,NULL,NULL,NULL,'a:1:{i:378;s:2:\"on\";}',378,1,'77363650','200607026','10713000969',89,5,1,10,1,NULL,'2024-09-02 22:37:06'),(425,'Prasant  Pradhan','prasantp@tech.gov.bt','10205007418',NULL,'$2y$10$GFVPvRhag7PtVFlpHD6qIuo91/CLdTuM7Af6B0XJhyBdHSCp3/jcq',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'77605192','202401925735','10205007418',87,5,1,10,1,NULL,'2024-09-02 22:31:39'),(426,'Sonam  Chophel','sonamchophel@tech.gov.bt','10605002815',NULL,'$2y$10$xVUxEWAoF9TyHbNUEdMvA.vEf3MX.gu5fjDzLR7fjfjcWco0eB1P.',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'17270688','202401925605','10605002815',87,5,1,10,1,NULL,'2024-09-02 22:31:34'),(427,'Dawa  ','dawa@tech.gov.bt','11004001088',NULL,'$2y$10$ZP0IQozPOq5Rmzm0T9bddeExcck2BY.iRVu7iHo9p1XW8cZnu1waC',NULL,NULL,NULL,NULL,NULL,1,3,11,NULL,NULL,NULL,NULL,'a:1:{i:271;s:2:\"on\";}',271,1,'77259256','202401925774','11004001088',93,5,1,10,1,NULL,'2024-09-02 22:31:28'),(428,'Tshering  Dorji','tdorji@tech.gov.bt','11410005400',NULL,'$2y$10$2YIzE1Gs.qpjLnm9RKBuiefVgQgp358x5/D3FSfKhq09wVPRMpZgW',NULL,NULL,NULL,NULL,NULL,1,3,10,NULL,NULL,NULL,NULL,'a:1:{i:274;s:2:\"on\";}',274,1,'77281325','202401925581','11410005400',19,6,1,10,1,NULL,'2024-09-02 22:30:52'),(429,'Dema  ','demakagatey@plantech.gov.bt','10711000054',NULL,'$2y$10$7Ye8TzyBTJuxaqM71i/6RekCmnYX4fB2Gh2hYDMx71cIWSrzhBmQe',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'17890526','200901142','10711000054',76,3,2,10,1,NULL,'2024-09-15 21:23:52'),(430,'Tshering  Cheki','tcheki@tech.gov.bt','10608000894',NULL,'$2y$10$2MbZ4EBbN.tp1kuZaEcFk.UXNS8Rs/1Kp2pqRCAFsN9Y0qwcrb59K',NULL,NULL,NULL,NULL,NULL,1,3,9,NULL,NULL,NULL,NULL,NULL,NULL,1,'17757906','202406927974','10608000894',92,6,2,10,1,NULL,'2024-09-02 21:36:08'),(431,'Sonam  Youden','youdensonam1@gmail.com','11704000463',NULL,'$2y$10$8fwdNLL9pP7v4RtVOKjt6.8dK2q/DtmLKn0hD9M.CmprAziuWXh5O',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'17649059','20200116180','11704000463',19,6,2,10,1,NULL,'2024-09-02 22:11:37'),(432,'Tshering  Dorji','tsheringdorji@moesd.gov.bt','11504000774',NULL,'$2y$10$wWXz3Vt/TBjI7FBGA47WaevsEqA8EJu4h6MIZ3X/gBGRD477DmbN.',NULL,NULL,NULL,NULL,NULL,1,1,1,NULL,NULL,NULL,NULL,'a:1:{i:337;s:2:\"on\";}',337,1,'77635090','202105918625','11504000774',19,6,1,10,1,NULL,'2024-09-05 21:37:24'),(433,'Tej Prased Nepal','tejprasadnepal@bcsea.bt','11206000526',NULL,'$2y$10$qfRdLKJvMhoS22e4VkivauuFJrLV5TtKBLIQF.avFLrgQkcqha5P6',NULL,NULL,NULL,NULL,NULL,1,1,2,NULL,NULL,NULL,NULL,'a:1:{i:374;s:2:\"on\";}',374,1,'77833996','202107919053','11206000526',19,6,1,10,1,NULL,'2024-09-05 21:36:07'),(434,'Norbu  Tseten','ntsheten@tech.gov.bt','11306002354',NULL,'$2y$10$9TU5.hetYBgH7fuiXy2Rc.x4HLHiGj7aSNf8RlsONOpTnb7Aoz0Je',NULL,NULL,NULL,NULL,NULL,1,1,4,NULL,NULL,NULL,NULL,'a:1:{i:365;s:2:\"on\";}',365,1,'17611341','2007058','11306002354',30,4,1,8,1,NULL,'2024-09-02 22:13:41'),(435,'Tashi  Dorji','tashidorji@tech.gov.bt','11915000300',NULL,'$2y$10$o7S2Yepd8AbbO0FCL2.ZO./eQgdM.3EMzP51cy/il2MnO1DAGtQX.',NULL,NULL,NULL,NULL,NULL,1,2,7,NULL,NULL,NULL,NULL,'a:1:{i:348;s:2:\"on\";}',348,1,'17522217','200601059','11915000300',76,3,1,2,1,NULL,'2024-09-02 22:09:37'),(436,'Kinzang Lham','erqwer@gmail.com','klham',NULL,'$2y$10$X8mhYRmQp3f.lrJCJoE5feJaYxndn/wMjwe7U0to8qUs817Z.cekS',NULL,NULL,NULL,NULL,NULL,1,4,13,NULL,NULL,NULL,NULL,NULL,NULL,1,'12','23423','4234234',59,1,2,NULL,1,'2024-09-15 22:11:18','2024-09-15 22:11:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_permissions` (
  `user_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,1),(259,2),(260,2),(261,2),(262,2),(263,2),(264,2),(265,15),(266,15),(267,15),(268,2),(270,2),(271,15),(272,2),(273,2),(274,15),(275,6),(276,2),(277,2),(278,2),(279,2),(280,2),(281,15),(282,2),(283,2),(284,2),(285,2),(286,2),(287,2),(289,2),(290,2),(291,2),(292,2),(293,2),(295,2),(296,2),(297,2),(298,2),(299,2),(300,2),(301,2),(302,2),(303,2),(304,2),(305,2),(306,2),(307,6),(308,2),(309,2),(310,2),(311,2),(312,2),(313,2),(314,2),(315,2),(316,2),(317,2),(318,2),(319,2),(320,2),(321,2),(322,2),(323,2),(324,2),(325,2),(326,2),(327,2),(328,2),(329,2),(330,2),(331,2),(332,2),(333,15),(334,2),(335,2),(336,2),(337,15),(338,2),(339,2),(340,2),(341,2),(343,2),(344,2),(345,2),(346,2),(347,2),(348,15),(349,2),(350,2),(351,2),(352,15),(353,2),(354,2),(358,2),(360,2),(361,2),(362,2),(363,2),(364,2),(365,15),(367,2),(368,2),(369,2),(370,2),(371,2),(372,2),(373,2),(374,15),(376,2),(377,2),(378,15),(379,2),(380,2),(381,2),(382,2),(383,2),(384,2),(385,2),(386,2),(387,2),(388,2),(389,2),(390,2),(391,2),(392,2),(393,2),(394,2),(395,2),(396,2),(397,2),(398,2),(399,2),(400,2),(401,2),(402,2),(403,2),(404,2),(405,2),(406,2),(407,2),(408,2),(409,2),(410,2),(411,2),(412,2),(413,2),(414,2),(415,2),(416,2),(417,2),(418,2),(419,2),(420,2),(421,2),(422,2),(423,2),(424,2),(425,2),(426,2),(427,2),(428,2),(429,2),(430,2),(431,2),(432,2),(433,2),(434,2),(435,2),(436,2);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weblinkcategories`
--

DROP TABLE IF EXISTS `weblinkcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weblinkcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weblinkcategories`
--

LOCK TABLES `weblinkcategories` WRITE;
/*!40000 ALTER TABLE `weblinkcategories` DISABLE KEYS */;
INSERT INTO `weblinkcategories` VALUES (2,'ICT Help Desk','2023-05-18 03:15:04','2023-05-20 13:22:26'),(3,'Grievance Redressal System','2023-05-18 03:15:16','2024-08-05 09:19:44'),(4,'Vehicle Pool Request','2023-05-18 03:15:33','2024-08-07 03:20:57'),(5,'GovTech Live Directory','2023-05-18 03:19:56','2024-08-20 10:19:20');
/*!40000 ALTER TABLE `weblinkcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weblinks`
--

DROP TABLE IF EXISTS `weblinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weblinks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weblinkcategory_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weblinks`
--

LOCK TABLES `weblinks` WRITE;
/*!40000 ALTER TABLE `weblinks` DISABLE KEYS */;
INSERT INTO `weblinks` VALUES (2,3,'Grievance Redressal Form ','https://docs.google.com/forms/d/e/1FAIpQLSdWusa8RNoLm4LmbOHjTrkHPackTlYLAuU-nYjSTq5PcRbCyQ/viewform','2023-05-18 03:18:36','2024-08-08 03:07:48'),(3,4,'Pool Vehicle Request','https://docs.google.com/forms/d/e/1FAIpQLScJq7_CsjGnhraMESGT4nJk6ju5zSOGM9D2NQro06JLnh5kNQ/viewform','2023-05-18 03:19:22','2024-08-07 03:21:37'),(4,5,'GovTech Live Directory','https://docs.google.com/spreadsheets/d/1CYdoUtDaWDl3JdcHeopqPVxAMi1X_yv6SsVDjir6gs8/edit?gid=342743855#gid=342743855','2023-05-18 03:20:48','2024-08-20 10:19:02');
/*!40000 ALTER TABLE `weblinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflows`
--

DROP TABLE IF EXISTS `workflows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` date NOT NULL,
  `author` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflows`
--

LOCK TABLES `workflows` WRITE;
/*!40000 ALTER TABLE `workflows` DISABLE KEYS */;
INSERT INTO `workflows` VALUES (1,'Test GovTech','<p>asdfasdf. sdaf&nbsp;</p>\n<p>&nbsp;asdfas&nbsp;</p>\n<p>sdfafds&nbsp; no&nbsp;</p>\n<p>akndfasdf</p>','2024-09-04',307,'2024-09-04 04:03:20','2024-09-04 04:03:20');
/*!40000 ALTER TABLE `workflows` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-17 20:09:03
