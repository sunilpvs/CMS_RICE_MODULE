CREATE DATABASE  IF NOT EXISTS `pvscoqq5_devsc_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pvscoqq5_devsc_cms`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pvscoqq5_devsc_cms
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `tbl_bagmark`
--

DROP TABLE IF EXISTS `tbl_bagmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_bagmark` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bagmark`
--

LOCK TABLES `tbl_bagmark` WRITE;
/*!40000 ALTER TABLE `tbl_bagmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bagmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cargo_types`
--

DROP TABLE IF EXISTS `tbl_cargo_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cargo_types` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cargo_types`
--

LOCK TABLES `tbl_cargo_types` WRITE;
/*!40000 ALTER TABLE `tbl_cargo_types` DISABLE KEYS */;
INSERT INTO `tbl_cargo_types` VALUES (1,'Bulk'),(2,'Break Bulk'),(3,'Liquid Bulk'),(4,'Project Cargo'),(5,'Containers');
/*!40000 ALTER TABLE `tbl_cargo_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_city`
--

DROP TABLE IF EXISTS `tbl_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_city` (
  `id` int NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_city`
--

LOCK TABLES `tbl_city` WRITE;
/*!40000 ALTER TABLE `tbl_city` DISABLE KEYS */;
INSERT INTO `tbl_city` VALUES (1,'Kakinada',1),(2,'Benguluru',1),(3,'Chennai',1),(4,'Delhi',1),(5,'Guntur',1),(6,'Hyderabad',1),(7,'Mumbai',1),(8,'Nellore',1),(9,'Surat',1),(10,'Visakhapatnam',1);
/*!40000 ALTER TABLE `tbl_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_commodity`
--

DROP TABLE IF EXISTS `tbl_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_commodity` (
  `id` int NOT NULL,
  `commodity` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cargo_type` int NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `marking` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Created_By` int NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_Updated` int DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_commodity`
--

LOCK TABLES `tbl_commodity` WRITE;
/*!40000 ALTER TABLE `tbl_commodity` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_compartment`
--

DROP TABLE IF EXISTS `tbl_compartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_compartment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Ccode` varchar(10) NOT NULL,
  `Ctype` varchar(50) NOT NULL,
  `wh_id` int NOT NULL,
  `Capacity_Sft` int NOT NULL,
  `Capacity_Mton` int NOT NULL,
  `Rate_SftDay` varchar(20) NOT NULL,
  `Primary_Contact` int NOT NULL,
  `Created_By` int NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_Updated` int DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compartment`
--

LOCK TABLES `tbl_compartment` WRITE;
/*!40000 ALTER TABLE `tbl_compartment` DISABLE KEYS */;
INSERT INTO `tbl_compartment` VALUES (1,'12345','one',1,2000,20000,'4',8,1,'2023-07-05 14:05:35',1,'2023-07-05 14:12:02');
/*!40000 ALTER TABLE `tbl_compartment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `personal_email` varchar(55) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int NOT NULL,
  `state` int NOT NULL,
  `pin` int NOT NULL,
  `country` int NOT NULL,
  `ContactType_Id` int NOT NULL,
  `join_date` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `emp_status` varchar(2) DEFAULT NULL,
  `department` int DEFAULT NULL,
  `designation` int DEFAULT NULL,
  `createdBy` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkey_contact_type` (`ContactType_Id`),
  CONSTRAINT `fkey_contact_type` FOREIGN KEY (`ContactType_Id`) REFERENCES `tbl_contacttype` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contact`
--

LOCK TABLES `tbl_contact` WRITE;
/*!40000 ALTER TABLE `tbl_contact` DISABLE KEYS */;
INSERT INTO `tbl_contact` VALUES (1,'Super','User','2013-03-14','donotreply@pvs-consultancy.com',NULL,'8886800090','Hyderabad','Hyd',6,24,500008,1,1,NULL,NULL,'A',1,1,1,'2023-06-10 21:32:59',1,'2023-07-01 22:05:57'),(3,'SCBC','Admin','2013-06-12','harithadevi963@gmail.com','harithadevi963@gmail.com','08008655236','Add1','Add2',6,24,500008,1,2,'2023-07-27','1900-01-01','A',5,11,1,'2023-06-21 14:02:47',1,'2023-07-28 06:29:02'),(4,'Haritha','Reddy','2013-06-12','pallalaharithareddy@gmail.com','pallalaharithareddy@gmail.com','8008655236','Manikonda','Flat',6,24,500008,1,2,'2023-12-03','1900-01-01','A',6,12,1,'2023-06-21 14:03:12',1,'2023-07-28 06:28:01'),(5,'Mana','Samskriti','2013-06-12','harithadevi5575@gmail.com','harithadevi5575@gmail.com','08008655236','A3044','Aditya',6,24,500008,1,5,'2009-01-05','1900-01-01','A',6,12,1,'2023-06-21 14:03:48',1,'2023-07-28 06:28:37'),(6,'Sekhar','Reddy','2013-06-12','ryenimireddy@gmail.com',NULL,'08008655236','Hyderabad','Address2',2,5,500008,1,3,NULL,NULL,'A',1,1,1,'2023-06-21 14:04:02',1,'2023-07-28 07:05:48'),(7,'Sunil Babu','PVS','1981-05-20','sunil_pvs@hotmail.com',NULL,'9885300090','Shaikpet','Tolichowki',6,24,500008,1,3,NULL,NULL,'A',1,1,1,'2023-07-02 15:02:14',1,'2023-07-28 06:55:05'),(9,'PVS','Sunil','1981-05-20','pvssunil@gmail.com','pvssunil@gmail.com','9885300090','Add1','Add2',6,24,5000015,1,2,'2020-01-14','1900-01-01','A',6,11,1,'2023-07-05 15:48:35',1,'2023-07-28 06:29:28'),(10,'Haritha','Devi','2023-07-22','pallalaharithareddy@gmail.com','pallalaharithareddy@gmail.com','9848299524','F124','Brodipet',5,1,522005,1,2,'2021-01-03','1900-01-01','A',5,11,1,'2023-07-05 22:39:07',1,'2023-07-28 06:28:13'),(11,'Sunil','PVS','1981-05-20','sunil_pvs@hotmail.com','pvssunil@gmail.com','8886800090','A1503','Shaikpet',6,24,500008,1,2,'2023-03-10','2050-03-10','A',6,6,1,'2023-07-26 14:37:59',1,'2023-07-28 06:28:43'),(12,'Sunil','PVS','1981-05-20','sunil_pvs@hotmail.com','sunil_pvs@hotmail.com','8886800090','A1503','Shaikpet',6,24,500008,1,2,'2023-01-01','1900-01-01','A',-1,-1,1,'2023-07-27 21:31:24',NULL,NULL),(13,'Kshemu','Lakshmi','1986-05-07','kshemu.lakshmi@gmail.com','kshemu.lakshmi@hotmail.com','9848350446','A1503','Shaikpet',6,24,500008,1,2,'2023-01-05','1900-01-01','A',2,4,1,'2023-07-27 21:34:40',1,'2023-07-28 06:28:24'),(14,'Ramji','Internal','1987-03-22','ramji@gmail.com',NULL,'8794556465','Add1','Add2',6,24,500008,1,3,NULL,NULL,NULL,NULL,NULL,1,'2023-07-28 07:08:10',1,'2023-07-28 12:31:03');
/*!40000 ALTER TABLE `tbl_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contacttype`
--

DROP TABLE IF EXISTS `tbl_contacttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_contacttype` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) NOT NULL,
  `Status` varchar(3) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contacttype`
--

LOCK TABLES `tbl_contacttype` WRITE;
/*!40000 ALTER TABLE `tbl_contacttype` DISABLE KEYS */;
INSERT INTO `tbl_contacttype` VALUES (1,'Super User','A'),(2,'Employee','A'),(3,'Customer','A'),(4,'Vendor/Supplier','A'),(5,'Consultant','A'),(6,'Lessor','A');
/*!40000 ALTER TABLE `tbl_contacttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_costcenter`
--

DROP TABLE IF EXISTS `tbl_costcenter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_costcenter` (
  `cc_code` varchar(5) NOT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `entity_id` int DEFAULT NULL,
  `incorp_date` date DEFAULT NULL,
  `gst_no` varchar(25) DEFAULT NULL,
  `add1` varchar(100) DEFAULT NULL,
  `add2` varchar(100) DEFAULT NULL,
  `city` int DEFAULT NULL,
  `state` int DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `country` int DEFAULT NULL,
  `primary_contact` int DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`cc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_costcenter`
--

LOCK TABLES `tbl_costcenter` WRITE;
/*!40000 ALTER TABLE `tbl_costcenter` DISABLE KEYS */;
INSERT INTO `tbl_costcenter` VALUES ('KKDHO','Head Office',1,'2009-08-21','37AAECR9430L1ZX','70-7-62/A, 1ST Floor, Ramya Royale','Ramanayya Peta',1,1,'533003',1,3,'A',14,'2023-06-28 06:38:05',1,'2023-08-01 05:11:50');
/*!40000 ALTER TABLE `tbl_costcenter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_country`
--

DROP TABLE IF EXISTS `tbl_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_country` (
  `id` int NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_country`
--

LOCK TABLES `tbl_country` WRITE;
/*!40000 ALTER TABLE `tbl_country` DISABLE KEYS */;
INSERT INTO `tbl_country` VALUES (1,'India');
/*!40000 ALTER TABLE `tbl_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int DEFAULT NULL,
  `state` int NOT NULL,
  `pin` int NOT NULL,
  `country` int NOT NULL,
  `status` varchar(3) NOT NULL,
  `primary_contact` int NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer`
--

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` VALUES (1,'OLM','add1','add2',1,1,533034,1,'A',6,1,'2023-07-25 07:53:59',NULL,NULL),(2,'OLM2','Tolichowki','Shaikpet',1,1,500008,1,'D',6,1,'2023-07-25 12:23:50',1,'2023-07-25 09:09:43');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  `status` varchar(2) NOT NULL,
  `createdBy` int NOT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int NOT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'Human Resources','HR','A',1,'2023-06-04 16:19:04',1,'2023-07-04 19:32:08'),(2,'Finance','FIN','A',1,'2023-06-04 16:26:34',1,'0000-00-00 00:00:00'),(4,'Engineering','ENG','A',1,'2023-06-04 16:37:41',1,'2023-08-01 04:00:52'),(5,'Operations','OPS','A',1,'2023-06-08 21:31:19',1,'2023-06-08 18:01:29'),(6,'Information Technology','IT','A',1,'2023-06-09 21:12:46',0,NULL);
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_designation`
--

DROP TABLE IF EXISTS `tbl_designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_designation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  `status` varchar(5) NOT NULL,
  `createdBy` int NOT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_designation`
--

LOCK TABLES `tbl_designation` WRITE;
/*!40000 ALTER TABLE `tbl_designation` DISABLE KEYS */;
INSERT INTO `tbl_designation` VALUES (1,'Chief Executive Officer','CEO','A',1,'2023-06-09 21:33:18',1,'2023-08-01 04:03:17'),(2,'Managing Director','MD','A',1,'2023-06-08 18:34:29',1,'2023-07-28 06:18:37'),(3,'HOD - Human Resources','HHR','A',1,'2023-07-28 06:20:33',NULL,NULL),(4,'HOD - Finance','HF','A',1,'2023-07-28 06:21:12',1,'2023-07-28 06:21:48'),(5,'HOD - Operations','HOP','A',1,'2023-07-28 06:21:33',NULL,NULL),(6,'HOD - Technology','HT','A',1,'2023-07-28 06:22:21',NULL,NULL),(7,'HOD - Sales','HS','A',1,'2023-07-28 06:25:15',NULL,NULL),(8,'Senior Manager','SM','A',1,'2023-07-28 06:25:47',NULL,NULL),(9,'Manager','M','A',1,'2023-07-28 06:25:55',NULL,NULL),(10,'Director','D','A',1,'2023-07-28 06:26:07',NULL,NULL),(11,'Senior Executive','SE','A',1,'2023-07-28 06:26:28',NULL,NULL),(12,'Executive','E','A',1,'2023-07-28 06:26:37',NULL,NULL);
/*!40000 ALTER TABLE `tbl_designation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_entity`
--

DROP TABLE IF EXISTS `tbl_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_entity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(100) NOT NULL,
  `cin` varchar(30) NOT NULL,
  `incorp_date` date NOT NULL,
  `add1` varchar(150) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int DEFAULT NULL,
  `state` int NOT NULL,
  `pin` int NOT NULL,
  `country` int NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_entity`
--

LOCK TABLES `tbl_entity` WRITE;
/*!40000 ALTER TABLE `tbl_entity` DISABLE KEYS */;
INSERT INTO `tbl_entity` VALUES (1,'SHRI CHANDRA BULK CARGO SERVICES PRIVATE LIMITED','U74900AP2009PTC064815','2009-08-21','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta',1,1,533003,1,'A',14,'2023-06-27 13:32:03',1,'2023-08-01 03:40:08'),(2,'SHRI CHANDRA GLOBAL EXIM PRIVATE LIMITED','U51220AP2022PTC121013','2022-03-09','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta',1,1,533003,1,'A',1,'2023-07-04 18:20:51',1,'2023-08-01 03:50:48'),(3,'TANMAYEE LOGISTICS AND SERVICES','267 of 2017','2017-04-26','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta',1,1,533003,1,'A',1,'2023-07-24 20:50:13',1,'2023-08-01 03:25:26');
/*!40000 ALTER TABLE `tbl_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inwardlease`
--

DROP TABLE IF EXISTS `tbl_inwardlease`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_inwardlease` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lessor_id` int NOT NULL,
  `commencement_date` date NOT NULL,
  `lease_expiry_date` date NOT NULL,
  `lease_type` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdated_by` int NOT NULL,
  `lastupdated_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inwardlease`
--

LOCK TABLES `tbl_inwardlease` WRITE;
/*!40000 ALTER TABLE `tbl_inwardlease` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_inwardlease` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_leases`
--

DROP TABLE IF EXISTS `tbl_leases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_leases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Lease_obj` int NOT NULL,
  `Contract_id` int NOT NULL,
  `Customer_id` int NOT NULL,
  `Commenced_Date` date NOT NULL,
  `Complete_Date` date NOT NULL,
  `Capacity_Mton` int NOT NULL,
  `RateDay` int NOT NULL,
  `Commodity_Type` int NOT NULL,
  `Contact_Days` int NOT NULL,
  `Total_Cost` int NOT NULL,
  `Created_By` int NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_Updated` int DEFAULT NULL,
  `Last_UpdatedDateTime` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_leases`
--

LOCK TABLES `tbl_leases` WRITE;
/*!40000 ALTER TABLE `tbl_leases` DISABLE KEYS */;
INSERT INTO `tbl_leases` VALUES (1,1,2,3,'2023-07-07','2023-07-19',2000,30003,50,400,50000,0,'2023-07-05 13:34:27',1,'2023-07-05'),(2,2,1,9,'2023-07-13','2023-07-29',1000,500,3000000,500,20000,1,'2023-07-05 14:13:07',1,'2023-07-05');
/*!40000 ALTER TABLE `tbl_leases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_leasetype`
--

DROP TABLE IF EXISTS `tbl_leasetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_leasetype` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Status` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_leasetype`
--

LOCK TABLES `tbl_leasetype` WRITE;
/*!40000 ALTER TABLE `tbl_leasetype` DISABLE KEYS */;
INSERT INTO `tbl_leasetype` VALUES (1,'Government','A'),(2,'Private','A');
/*!40000 ALTER TABLE `tbl_leasetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lessormaster`
--

DROP TABLE IF EXISTS `tbl_lessormaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_lessormaster` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int DEFAULT NULL,
  `add1` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `add2` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pin` int NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `primary_contact` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdated_by` int NOT NULL,
  `lastupdated_datetime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lessormaster`
--

LOCK TABLES `tbl_lessormaster` WRITE;
/*!40000 ALTER TABLE `tbl_lessormaster` DISABLE KEYS */;
INSERT INTO `tbl_lessormaster` VALUES (1,'OLM GODOWNS',1,'guntur','guntur','Andra Pradesh',522005,'india',10,3,'2023-07-18 23:06:42',0,'0000-00-00');
/*!40000 ALTER TABLE `tbl_lessormaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lessortype`
--

DROP TABLE IF EXISTS `tbl_lessortype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_lessortype` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lessortype`
--

LOCK TABLES `tbl_lessortype` WRITE;
/*!40000 ALTER TABLE `tbl_lessortype` DISABLE KEYS */;
INSERT INTO `tbl_lessortype` VALUES (1,'Government'),(2,'Private');
/*!40000 ALTER TABLE `tbl_lessortype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_state`
--

DROP TABLE IF EXISTS `tbl_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_state` (
  `id` int NOT NULL,
  `state` varchar(75) DEFAULT NULL,
  `country` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_state`
--

LOCK TABLES `tbl_state` WRITE;
/*!40000 ALTER TABLE `tbl_state` DISABLE KEYS */;
INSERT INTO `tbl_state` VALUES (1,'Andhra Pradesh',1),(2,'Arunachal Pradesh',1),(3,'Assam',1),(4,'Bihar',1),(5,'Chhattisgarh',1),(6,'Goa',1),(7,'Gujarat',1),(8,'Haryana',1),(9,'Himachal Pradesh',1),(10,'Jharkhand',1),(11,'Karnataka',1),(12,'Kerala',1),(13,'Madhya Pradesh',1),(14,'Maharashtra',1),(15,'Manipur',1),(16,'Meghalaya',1),(17,'Mizoram',1),(18,'Nagaland',1),(19,'Odisha',1),(20,'Punjab',1),(21,'Rajasthan',1),(22,'Sikkim',1),(23,'Tamil Nadu',1),(24,'Telangana',1),(25,'Tripura',1),(26,'Uttarakhand',1),(27,'Uttar Pradesh',1),(28,'West Bengal',1);
/*!40000 ALTER TABLE `tbl_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_status` (
  `ID` varchar(3) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_status`
--

LOCK TABLES `tbl_status` WRITE;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
INSERT INTO `tbl_status` VALUES ('A','Active'),('D','Deactive'),('S','Suspended');
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaction_log`
--

DROP TABLE IF EXISTS `tbl_transaction_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_transaction_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity` varchar(100) NOT NULL,
  `log` varchar(100) DEFAULT NULL,
  `action_user_id` int NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_trans_user_id_idx` (`action_user_id`),
  CONSTRAINT `fk_trans_user_id` FOREIGN KEY (`action_user_id`) REFERENCES `tbl_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_log`
--

LOCK TABLES `tbl_transaction_log` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_log` DISABLE KEYS */;
INSERT INTO `tbl_transaction_log` VALUES (1,'Password reset performed for user id : 6',NULL,1,'2023-07-23 15:35:59'),(2,'Password reset performed for user id : 6',NULL,1,'2023-07-23 15:45:56'),(3,'User status and role updated for : 6',NULL,1,'2023-07-23 21:21:04'),(4,'Password reset performed for user id : 6',NULL,1,'2023-07-24 14:58:10'),(5,'Password reset performed for user id : 6',NULL,1,'2023-07-24 19:38:10'),(6,'Password reset performed for user id : 6',NULL,1,'2023-07-24 20:08:38'),(7,'Password reset performed for user id : 6',NULL,1,'2023-07-24 20:12:24'),(8,'Password reset performed for user id : 6',NULL,1,'2023-07-27 18:56:37'),(9,'Updated entity details for Entity ID: 2',NULL,1,'2023-08-01 03:50:48'),(10,'Updated department details for Department ID: 4',NULL,1,'2023-08-01 04:00:04'),(11,'Updated department details for Department ID: 4',NULL,1,'2023-08-01 04:00:44'),(12,'Updated department details for Department ID: 4',NULL,1,'2023-08-01 04:00:52'),(13,'Updated Designation details for Designation ID: 1',NULL,1,'2023-08-01 04:03:17'),(14,'Updated Branch/CostCenter details for CostCenter Code: ',NULL,1,'2023-08-01 04:54:02'),(15,'Updated Branch/CostCenter details for CostCenter Code:',NULL,1,'2023-08-01 04:56:10'),(16,'Updated Branch/CostCenter details for CostCenter Code:KKDHO',NULL,1,'2023-08-01 05:06:53'),(17,'Updated Branch/CostCenter details for CostCenter Code:KKDHO',NULL,1,'2023-08-01 05:09:53'),(18,'Updated Branch/CostCenter details for CostCenter Code:KKDHO',NULL,1,'2023-08-01 05:11:50');
/*!40000 ALTER TABLE `tbl_transaction_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_role`
--

DROP TABLE IF EXISTS `tbl_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_role`
--

LOCK TABLES `tbl_user_role` WRITE;
/*!40000 ALTER TABLE `tbl_user_role` DISABLE KEYS */;
INSERT INTO `tbl_user_role` VALUES (1,'SUPER USER'),(2,'IT ADMIN'),(3,'MOD_RICE_ADMIN'),(4,'MOD_RICE_USER'),(5,'BASE_EMPLOYEE');
/*!40000 ALTER TABLE `tbl_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role_id` int DEFAULT NULL,
  `user_status` varchar(3) DEFAULT NULL,
  `contact_id` int DEFAULT NULL,
  `code` mediumint NOT NULL,
  `status` text NOT NULL,
  `createdBy` int DEFAULT NULL,
  `createdDateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `Last_UpdatedBy` int DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'root','donotreply@pvs-consultancy.com','$2y$10$K8erDeTeJj7XMuE3uQtt8O8I5exRsH7y.bcGxs.QrT6ZhzhwpSU1G',1,'A',1,0,'verified',1,'2023-06-21 13:44:33',NULL,NULL),(2,'scbc1','harithadevi963@gmail.com','$2y$10$aut4egkoMHPaRzHqKnYWOebRV7JPW1KSoisaYbnkPmKK05wsqNDL2',2,'A',3,0,'verified',1,'2023-06-21 13:40:54',NULL,NULL),(3,'haritha','pallalaharithareddy@gmail.com','$2y$10$xzA53B0SL/TONROACen9nu/TkkCbhqKf1bPpPCZjehG4EYFxK0pF2',3,'A',4,747881,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(4,'manasamskriti2','harithadevi5575@gmail.com','$2y$10$v7Aj5qE3.kh9pfH4letpQ.hckym2jumlYdSwcJOUePB5dPUen8yie',4,'A',5,395034,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(5,'sekhar','ryenimireddy@gmail.com','$2y$10$EQbY4NN5LTG/tVOx4Z7ZieETyI/AyxRFpBk6tVec7va9vCf94W37C',4,'A',6,867476,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(6,'sunilpvs','pvssunil@gmail.com','$2y$10$eqZwY5SqvLv2VB32i1holuM/.IjpTd1jra7c5qOZy7ceFAYjnwUz2',3,'A',9,0,'verified',1,'2023-07-23 07:57:44',1,'2023-07-27 18:56:37');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_vendor`
--

DROP TABLE IF EXISTS `tbl_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_vendor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(100) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pin` int NOT NULL,
  `country` varchar(15) NOT NULL,
  `primary_contact` int NOT NULL,
  `status` varchar(3) NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vendor`
--

LOCK TABLES `tbl_vendor` WRITE;
/*!40000 ALTER TABLE `tbl_vendor` DISABLE KEYS */;
INSERT INTO `tbl_vendor` VALUES (1,'OLM PVS ','Shaikpet','Tolichowki','Telangana',5000008,'India',0,'7',1,'2023-07-25 14:54:47',NULL,NULL);
/*!40000 ALTER TABLE `tbl_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_warehouse`
--

DROP TABLE IF EXISTS `tbl_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `add1` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `add2` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `add3` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `pin` int NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `capacity_sqft` int NOT NULL,
  `capacity_mton` int NOT NULL,
  `lessor_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_warehouse`
--

LOCK TABLES `tbl_warehouse` WRITE;
/*!40000 ALTER TABLE `tbl_warehouse` DISABLE KEYS */;
INSERT INTO `tbl_warehouse` VALUES (3,'haritha','525','guntur','guntur','hyderabad','Andra Pradesh',522005,'india',50000,20000,1,3,'2023-07-18 20:08:05',NULL,NULL),(4,'haritha','525','Hyderabada','guntur','hyderabad','Andra Pradesh',522005,'india',50000,20000,1,3,'2023-07-18 21:35:37',NULL,NULL),(5,'manasamskriti2','525','guntur','guntur','hyderabad','Andra Pradesh',522005,'india',50000,20000,1,3,'2023-07-18 21:42:23',NULL,NULL),(6,'devi','scbc','Hyderabada','guntur','hyderabad','Andra Pradesh',522005,'india',2000,3000,1,3,'2023-07-18 21:49:43',NULL,NULL),(7,'scbc','525','guntur','guntur','hyderabad','Andra Pradesh',522005,'india',20000,30000,1,3,'2023-07-18 21:53:20',NULL,NULL),(8,'testing','525','Hyderabada','guntur','hyderabad','Andra Pradesh',522005,'india',200,500,1,3,'2023-07-18 22:25:51',NULL,NULL),(9,'haritha','525','Hyderabada','guntur','hyderabad','Andra Pradesh',522005,'india',50000,10000,1,3,'2023-07-19 11:56:18',NULL,NULL);
/*!40000 ALTER TABLE `tbl_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_activitylog`
--

DROP TABLE IF EXISTS `vw_activitylog`;
/*!50001 DROP VIEW IF EXISTS `vw_activitylog`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_activitylog` AS SELECT 
 1 AS `datetime`,
 1 AS `activity`,
 1 AS `log`,
 1 AS `id`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_cargo_types`
--

DROP TABLE IF EXISTS `vw_cargo_types`;
/*!50001 DROP VIEW IF EXISTS `vw_cargo_types`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_cargo_types` AS SELECT 
 1 AS `id`,
 1 AS `name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_city`
--

DROP TABLE IF EXISTS `vw_city`;
/*!50001 DROP VIEW IF EXISTS `vw_city`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_city` AS SELECT 
 1 AS `id`,
 1 AS `city`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_commodities`
--

DROP TABLE IF EXISTS `vw_commodities`;
/*!50001 DROP VIEW IF EXISTS `vw_commodities`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_commodities` AS SELECT 
 1 AS `id`,
 1 AS `cargo_type`,
 1 AS `commodity`,
 1 AS `brand`,
 1 AS `marking`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_contact_list`
--

DROP TABLE IF EXISTS `vw_contact_list`;
/*!50001 DROP VIEW IF EXISTS `vw_contact_list`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_contact_list` AS SELECT 
 1 AS `id`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `dob`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `state`,
 1 AS `ContactType`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_costcenter_list`
--

DROP TABLE IF EXISTS `vw_costcenter_list`;
/*!50001 DROP VIEW IF EXISTS `vw_costcenter_list`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_costcenter_list` AS SELECT 
 1 AS `entity_name`,
 1 AS `cc_code`,
 1 AS `cc_type`,
 1 AS `incorp_date`,
 1 AS `gst_no`,
 1 AS `city`,
 1 AS `state`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_country`
--

DROP TABLE IF EXISTS `vw_country`;
/*!50001 DROP VIEW IF EXISTS `vw_country`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_country` AS SELECT 
 1 AS `id`,
 1 AS `country`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_ctype`
--

DROP TABLE IF EXISTS `vw_ctype`;
/*!50001 DROP VIEW IF EXISTS `vw_ctype`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_ctype` AS SELECT 
 1 AS `id`,
 1 AS `ctype`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_customer`
--

DROP TABLE IF EXISTS `vw_customer`;
/*!50001 DROP VIEW IF EXISTS `vw_customer`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_customer` AS SELECT 
 1 AS `id`,
 1 AS `customer_name`,
 1 AS `city`,
 1 AS `state`,
 1 AS `contact`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_deptlist`
--

DROP TABLE IF EXISTS `vw_deptlist`;
/*!50001 DROP VIEW IF EXISTS `vw_deptlist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_deptlist` AS SELECT 
 1 AS `id`,
 1 AS `dept`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_desiglist`
--

DROP TABLE IF EXISTS `vw_desiglist`;
/*!50001 DROP VIEW IF EXISTS `vw_desiglist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_desiglist` AS SELECT 
 1 AS `id`,
 1 AS `desig`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_employeelist`
--

DROP TABLE IF EXISTS `vw_employeelist`;
/*!50001 DROP VIEW IF EXISTS `vw_employeelist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_employeelist` AS SELECT 
 1 AS `id`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `dept`,
 1 AS `designation`,
 1 AS `join_date`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `emp_status`,
 1 AS `ctype`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_entity`
--

DROP TABLE IF EXISTS `vw_entity`;
/*!50001 DROP VIEW IF EXISTS `vw_entity`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_entity` AS SELECT 
 1 AS `id`,
 1 AS `entity_name`,
 1 AS `cin`,
 1 AS `incorp_date`,
 1 AS `city`,
 1 AS `state`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_state`
--

DROP TABLE IF EXISTS `vw_state`;
/*!50001 DROP VIEW IF EXISTS `vw_state`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_state` AS SELECT 
 1 AS `id`,
 1 AS `state`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_status`
--

DROP TABLE IF EXISTS `vw_status`;
/*!50001 DROP VIEW IF EXISTS `vw_status`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_status` AS SELECT 
 1 AS `ID`,
 1 AS `Status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_create_list`
--

DROP TABLE IF EXISTS `vw_user_create_list`;
/*!50001 DROP VIEW IF EXISTS `vw_user_create_list`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_create_list` AS SELECT 
 1 AS `id`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `ctype`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_profile`
--

DROP TABLE IF EXISTS `vw_user_profile`;
/*!50001 DROP VIEW IF EXISTS `vw_user_profile`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_profile` AS SELECT 
 1 AS `id`,
 1 AS `user_name`,
 1 AS `user_role`,
 1 AS `status`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `dob`,
 1 AS `email`,
 1 AS `personal_email`,
 1 AS `mobile`,
 1 AS `add1`,
 1 AS `add2`,
 1 AS `city`,
 1 AS `state`,
 1 AS `country`,
 1 AS `join_date`,
 1 AS `exit_date`,
 1 AS `dept`,
 1 AS `desig`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_roles`
--

DROP TABLE IF EXISTS `vw_user_roles`;
/*!50001 DROP VIEW IF EXISTS `vw_user_roles`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_roles` AS SELECT 
 1 AS `id`,
 1 AS `user_role`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_validation`
--

DROP TABLE IF EXISTS `vw_user_validation`;
/*!50001 DROP VIEW IF EXISTS `vw_user_validation`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_validation` AS SELECT 
 1 AS `id`,
 1 AS `user_name`,
 1 AS `email`,
 1 AS `code`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_userlist`
--

DROP TABLE IF EXISTS `vw_userlist`;
/*!50001 DROP VIEW IF EXISTS `vw_userlist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_userlist` AS SELECT 
 1 AS `id`,
 1 AS `user_name`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `ContactType`,
 1 AS `user_status`,
 1 AS `user_role`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_userrole`
--

DROP TABLE IF EXISTS `vw_userrole`;
/*!50001 DROP VIEW IF EXISTS `vw_userrole`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_userrole` AS SELECT 
 1 AS `id`,
 1 AS `user_role`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_validatelogin`
--

DROP TABLE IF EXISTS `vw_validatelogin`;
/*!50001 DROP VIEW IF EXISTS `vw_validatelogin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_validatelogin` AS SELECT 
 1 AS `id`,
 1 AS `user_name`,
 1 AS `password`,
 1 AS `code`,
 1 AS `status`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `ctype`,
 1 AS `user_role_id`,
 1 AS `user_role`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_vendorlist`
--

DROP TABLE IF EXISTS `vw_vendorlist`;
/*!50001 DROP VIEW IF EXISTS `vw_vendorlist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_vendorlist` AS SELECT 
 1 AS `id`,
 1 AS `vendor_name`,
 1 AS `state`,
 1 AS `primary_contact`,
 1 AS `email`,
 1 AS `mobile`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_warehouselist`
--

DROP TABLE IF EXISTS `vw_warehouselist`;
/*!50001 DROP VIEW IF EXISTS `vw_warehouselist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_warehouselist` AS SELECT 
 1 AS `id`,
 1 AS `warehouse`,
 1 AS `code`,
 1 AS `state`,
 1 AS `capacity_sqft`,
 1 AS `capacity_mton`,
 1 AS `lessor`,
 1 AS `contact`,
 1 AS `email`,
 1 AS `mobile`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_activitylog`
--

/*!50001 DROP VIEW IF EXISTS `vw_activitylog`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_activitylog` AS select `tbl_transaction_log`.`datetime` AS `datetime`,`tbl_transaction_log`.`activity` AS `activity`,`tbl_transaction_log`.`log` AS `log`,`tbl_transaction_log`.`action_user_id` AS `id` from `tbl_transaction_log` order by `tbl_transaction_log`.`datetime` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_cargo_types`
--

/*!50001 DROP VIEW IF EXISTS `vw_cargo_types`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_cargo_types` AS select `tbl_cargo_types`.`id` AS `id`,`tbl_cargo_types`.`name` AS `name` from `tbl_cargo_types` order by `tbl_cargo_types`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_city`
--

/*!50001 DROP VIEW IF EXISTS `vw_city`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_city` AS select `tbl_city`.`id` AS `id`,`tbl_city`.`city` AS `city` from `tbl_city` where (`tbl_city`.`country` = 1) order by `tbl_city`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_commodities`
--

/*!50001 DROP VIEW IF EXISTS `vw_commodities`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_commodities` AS select `a`.`id` AS `id`,`b`.`name` AS `cargo_type`,`a`.`commodity` AS `commodity`,`a`.`brand` AS `brand`,`a`.`marking` AS `marking` from (`tbl_commodity` `a` join `tbl_cargo_types` `b`) where (`a`.`cargo_type` = `b`.`id`) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_contact_list`
--

/*!50001 DROP VIEW IF EXISTS `vw_contact_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_contact_list` AS select `a`.`id` AS `id`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,date_format(`a`.`dob`,'%d-%b-%Y') AS `dob`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`c`.`state` AS `state`,`b`.`Name` AS `ContactType` from ((`tbl_contact` `a` join `tbl_contacttype` `b`) join `tbl_state` `c`) where ((`a`.`ContactType_Id` = `b`.`ID`) and (`a`.`state` = `c`.`id`) and (`b`.`ID` <> 1)) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_costcenter_list`
--

/*!50001 DROP VIEW IF EXISTS `vw_costcenter_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_costcenter_list` AS select `b`.`entity_name` AS `entity_name`,`a`.`cc_code` AS `cc_code`,`a`.`cc_type` AS `cc_type`,date_format(`a`.`incorp_date`,'%d-%b-%Y') AS `incorp_date`,`a`.`gst_no` AS `gst_no`,`d`.`city` AS `city`,`e`.`state` AS `state`,`c`.`f_name` AS `f_name`,`c`.`l_name` AS `l_name`,`a`.`status` AS `status` from ((((`tbl_costcenter` `a` join `tbl_entity` `b`) join `tbl_contact` `c`) join `tbl_city` `d`) join `tbl_state` `e`) where ((`a`.`entity_id` = `b`.`id`) and (`a`.`primary_contact` = `c`.`id`) and (`a`.`city` = `d`.`id`) and (`a`.`state` = `e`.`id`)) order by `a`.`cc_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_country`
--

/*!50001 DROP VIEW IF EXISTS `vw_country`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_country` AS select `tbl_country`.`id` AS `id`,`tbl_country`.`country` AS `country` from `tbl_country` order by `tbl_country`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_ctype`
--

/*!50001 DROP VIEW IF EXISTS `vw_ctype`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_ctype` AS select `tbl_contacttype`.`ID` AS `id`,`tbl_contacttype`.`Name` AS `ctype` from `tbl_contacttype` where (`tbl_contacttype`.`Status` = 'A') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_customer`
--

/*!50001 DROP VIEW IF EXISTS `vw_customer`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_customer` AS select `a`.`id` AS `id`,`a`.`customer_name` AS `customer_name`,`b`.`city` AS `city`,`c`.`state` AS `state`,concat(`d`.`f_name`,' ',`d`.`l_name`) AS `contact`,`d`.`email` AS `email`,`d`.`mobile` AS `mobile`,`a`.`status` AS `status` from (((`tbl_customer` `a` join `tbl_city` `b`) join `tbl_state` `c`) join `tbl_contact` `d`) where ((`a`.`city` = `b`.`id`) and (`a`.`state` = `c`.`id`) and (`a`.`primary_contact` = `d`.`id`)) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_deptlist`
--

/*!50001 DROP VIEW IF EXISTS `vw_deptlist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_deptlist` AS select `tbl_department`.`id` AS `id`,`tbl_department`.`name` AS `dept` from `tbl_department` where (`tbl_department`.`status` = 'A') order by `tbl_department`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_desiglist`
--

/*!50001 DROP VIEW IF EXISTS `vw_desiglist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_desiglist` AS select `tbl_designation`.`id` AS `id`,`tbl_designation`.`name` AS `desig` from `tbl_designation` where (`tbl_designation`.`status` = 'A') order by `tbl_designation`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_employeelist`
--

/*!50001 DROP VIEW IF EXISTS `vw_employeelist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_employeelist` AS select `a`.`id` AS `id`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,`c`.`name` AS `dept`,`d`.`name` AS `designation`,date_format(`a`.`join_date`,'%d-%b-%Y') AS `join_date`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`a`.`emp_status` AS `emp_status`,`b`.`Name` AS `ctype` from (((`tbl_contact` `a` join `tbl_contacttype` `b`) join `tbl_department` `c`) join `tbl_designation` `d`) where ((`a`.`ContactType_Id` = `b`.`ID`) and (`b`.`ID` in (2,5)) and (`a`.`department` = `c`.`id`) and (`a`.`designation` = `d`.`id`)) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_entity`
--

/*!50001 DROP VIEW IF EXISTS `vw_entity`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_entity` AS select `a`.`id` AS `id`,`a`.`entity_name` AS `entity_name`,`a`.`cin` AS `cin`,date_format(`a`.`incorp_date`,'%d-%b-%Y') AS `incorp_date`,`b`.`city` AS `city`,`c`.`state` AS `state`,`a`.`status` AS `status` from ((`tbl_entity` `a` join `tbl_city` `b`) join `tbl_state` `c`) where ((`a`.`city` = `b`.`id`) and (`a`.`state` = `c`.`id`)) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_state`
--

/*!50001 DROP VIEW IF EXISTS `vw_state`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_state` AS select `tbl_state`.`id` AS `id`,`tbl_state`.`state` AS `state` from `tbl_state` where (`tbl_state`.`country` = 1) order by `tbl_state`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_status`
--

/*!50001 DROP VIEW IF EXISTS `vw_status`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_status` AS select `tbl_status`.`ID` AS `ID`,`tbl_status`.`Status` AS `Status` from `tbl_status` order by `tbl_status`.`ID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_create_list`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_create_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_create_list` AS select `a`.`id` AS `id`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`b`.`Name` AS `ctype` from (`tbl_contact` `a` join `tbl_contacttype` `b`) where ((`a`.`ContactType_Id` = `b`.`ID`) and (`b`.`ID` = 2) and `a`.`id` in (select `tbl_users`.`contact_id` from `tbl_users`) is false) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_profile`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_profile`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_profile` AS select `a`.`id` AS `id`,`a`.`user_name` AS `user_name`,`b`.`user_role` AS `user_role`,`c`.`Status` AS `status`,`d`.`f_name` AS `f_name`,`d`.`l_name` AS `l_name`,date_format(`d`.`dob`,'%d-%b-%Y') AS `dob`,`d`.`email` AS `email`,`d`.`personal_email` AS `personal_email`,`d`.`mobile` AS `mobile`,`d`.`add1` AS `add1`,`d`.`add2` AS `add2`,`f`.`city` AS `city`,`g`.`state` AS `state`,`h`.`country` AS `country`,date_format(`d`.`join_date`,'%d-%b-%Y') AS `join_date`,date_format(`d`.`exit_date`,'%d-%b-%Y') AS `exit_date`,concat(`i`.`code`,' - ',`i`.`name`) AS `dept`,concat(`j`.`code`,' - ',`j`.`name`) AS `desig` from (((((((((`tbl_users` `a` join `tbl_user_role` `b`) join `tbl_status` `c`) join `tbl_contact` `d`) join `tbl_contacttype` `e`) join `tbl_city` `f`) join `tbl_state` `g`) join `tbl_country` `h`) join `tbl_department` `i`) join `tbl_designation` `j`) where ((`a`.`user_role_id` = `b`.`id`) and (`a`.`user_status` = `c`.`ID`) and (`a`.`contact_id` = `d`.`id`) and (`d`.`ContactType_Id` = `e`.`ID`) and (`d`.`city` = `f`.`id`) and (`d`.`state` = `g`.`id`) and (`d`.`country` = `h`.`id`) and (`d`.`department` = `i`.`id`) and (`d`.`designation` = `j`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_roles`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_roles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_roles` AS select `tbl_user_role`.`id` AS `id`,`tbl_user_role`.`user_role` AS `user_role` from `tbl_user_role` where (`tbl_user_role`.`id` <> 1) order by `tbl_user_role`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_validation`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_validation`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_validation` AS select `tbl_users`.`id` AS `id`,`tbl_users`.`user_name` AS `user_name`,`tbl_users`.`email` AS `email`,`tbl_users`.`code` AS `code` from `tbl_users` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_userlist`
--

/*!50001 DROP VIEW IF EXISTS `vw_userlist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_userlist` AS select `b`.`id` AS `id`,`b`.`user_name` AS `user_name`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`c`.`Name` AS `ContactType`,`b`.`user_status` AS `user_status`,`d`.`user_role` AS `user_role` from (((`tbl_contact` `a` join `tbl_users` `b`) join `tbl_contacttype` `c`) join `tbl_user_role` `d`) where ((`a`.`id` = `b`.`contact_id`) and (`a`.`ContactType_Id` = `c`.`ID`) and (`b`.`user_role_id` = `d`.`id`) and (`b`.`id` <> 1)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_userrole`
--

/*!50001 DROP VIEW IF EXISTS `vw_userrole`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_userrole` AS select `a`.`id` AS `id`,`b`.`user_role` AS `user_role` from (`tbl_users` `a` join `tbl_user_role` `b`) where (`a`.`user_role_id` = `b`.`id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_validatelogin`
--

/*!50001 DROP VIEW IF EXISTS `vw_validatelogin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_validatelogin` AS select `a`.`id` AS `id`,`a`.`user_name` AS `user_name`,`a`.`password` AS `password`,`a`.`code` AS `code`,`a`.`status` AS `status`,`b`.`f_name` AS `f_name`,`b`.`l_name` AS `l_name`,`a`.`email` AS `email`,`b`.`mobile` AS `mobile`,`c`.`Name` AS `ctype`,`a`.`user_role_id` AS `user_role_id`,`d`.`user_role` AS `user_role` from (((`tbl_users` `a` join `tbl_contact` `b`) join `tbl_contacttype` `c`) join `tbl_user_role` `d`) where ((`a`.`contact_id` = `b`.`id`) and (`b`.`ContactType_Id` = `c`.`ID`) and (`a`.`user_role_id` = `d`.`id`) and (`a`.`user_status` = 'A')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vendorlist`
--

/*!50001 DROP VIEW IF EXISTS `vw_vendorlist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vendorlist` AS select `a`.`id` AS `id`,`a`.`vendor_name` AS `vendor_name`,`a`.`state` AS `state`,((0 <> `b`.`f_name`) or (0 <> ' ') or (0 <> `b`.`l_name`)) AS `primary_contact`,`b`.`email` AS `email`,`b`.`mobile` AS `mobile`,`a`.`status` AS `status` from (`tbl_vendor` `a` join `tbl_contact` `b`) where (`a`.`primary_contact` = `b`.`id`) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_warehouselist`
--

/*!50001 DROP VIEW IF EXISTS `vw_warehouselist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_warehouselist` AS select `a`.`id` AS `id`,`a`.`name` AS `warehouse`,`a`.`code` AS `code`,`a`.`state` AS `state`,`a`.`capacity_sqft` AS `capacity_sqft`,`a`.`capacity_mton` AS `capacity_mton`,`b`.`name` AS `lessor`,concat(`c`.`f_name`,' ',`c`.`l_name`) AS `contact`,`c`.`email` AS `email`,`c`.`mobile` AS `mobile` from ((`tbl_warehouse` `a` join `tbl_lessormaster` `b`) join `tbl_contact` `c`) where ((`a`.`lessor_id` = `b`.`id`) and (`b`.`primary_contact` = `c`.`id`)) order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-01 19:56:28
