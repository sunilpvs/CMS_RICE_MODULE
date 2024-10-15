CREATE DATABASE  IF NOT EXISTS `pvscoqq5_devsc_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `mobile` varchar(15) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `State` varchar(20) NOT NULL,
  `pin` int NOT NULL,
  `Country` varchar(15) NOT NULL,
  `ContactType_Id` int NOT NULL,
  `department` int DEFAULT NULL,
  `designation` int DEFAULT NULL,
  `createdBy` int NOT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkey_contact_type` (`ContactType_Id`),
  CONSTRAINT `fkey_contact_type` FOREIGN KEY (`ContactType_Id`) REFERENCES `tbl_contacttype` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contact`
--

LOCK TABLES `tbl_contact` WRITE;
/*!40000 ALTER TABLE `tbl_contact` DISABLE KEYS */;
INSERT INTO `tbl_contact` VALUES (1,'Super','User','2013-03-14','donotreply@pvs-consultancy.com','8886800090','Hyderabad','Hyd','Telangana',500008,'India',1,NULL,NULL,1,'2023-06-10 21:32:59',1,'2023-07-01 22:05:57'),(3,'SCBC','Admin','2013-06-12','harithadevi963@gmail.com','08008655236','Add1','Add2','Telangana',500008,'India',2,NULL,NULL,1,'2023-06-21 14:02:47',1,'2023-07-02 06:58:24'),(4,'haritha','user','2013-06-12','pallalaharithareddy@gmail.com','08008655236','Hyderabad','Add2','Telangana',500008,'India',2,NULL,NULL,1,'2023-06-21 14:03:12',1,'2023-07-02 15:01:10'),(5,'manasamskriti2','user','2013-06-12','harithadevi5575@gmail.com','08008655236','Hyderabad','Address22','Telangana',500008,'India',2,NULL,NULL,1,'2023-06-21 14:03:48',1,'2023-07-02 14:39:55'),(6,'Sekhar','Reddy','2013-06-12','ryenimireddy@gmail.com','08008655236','Hyderabad','Address2','Telangana',500008,'India',3,NULL,NULL,1,'2023-06-21 14:04:02',1,'2023-07-05 08:21:40'),(7,'Sunil Babu','PVS','1981-05-20','sunil_pvs@hotmail.com','9885300090','Shaikpet','Tolichowki','Telangana',500008,'India',4,NULL,NULL,1,'2023-07-02 15:02:14',NULL,NULL),(9,'PVS','Sunil','1981-05-20','pvssunil@gmail.com','9885300090','Add1','Add2','TG',5000015,'India',2,NULL,NULL,1,'2023-07-05 15:48:35',1,'2023-07-21 16:58:13'),(10,'haritha','devi','2023-07-22','pallalaharithareddy@gmail.com','9848299524','guntur','guntur','ap',522005,'india',2,NULL,NULL,1,'2023-07-05 22:39:07',1,'2023-07-21 16:57:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `CC_Code` varchar(5) NOT NULL,
  `CC_Type` varchar(20) DEFAULT NULL,
  `Entity_Id` int DEFAULT NULL,
  `Incorp_Date` date DEFAULT NULL,
  `GST_No` varchar(25) DEFAULT NULL,
  `Add1` varchar(100) DEFAULT NULL,
  `Add2` varchar(100) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Pin` varchar(10) DEFAULT NULL,
  `Country` varchar(25) DEFAULT NULL,
  `Primary_ContactId` int DEFAULT NULL,
  `Status` varchar(3) DEFAULT NULL,
  `Created_By` int DEFAULT NULL,
  `Created_DateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `Last_Updated` int DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`CC_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_costcenter`
--

LOCK TABLES `tbl_costcenter` WRITE;
/*!40000 ALTER TABLE `tbl_costcenter` DISABLE KEYS */;
INSERT INTO `tbl_costcenter` VALUES ('KKDHO','Branch',1,'2009-08-21','37AAECR9430L1ZX','70-7-62/A, 1ST Floor, Ramya Royale','Ramanayya Peta, Kakinada','Andhra Pradesh','533003','India',3,'A',14,'2023-06-28 06:38:05',1,'2023-07-05 08:22:57');
/*!40000 ALTER TABLE `tbl_costcenter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_customer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Add1` varchar(100) NOT NULL,
  `Add2` varchar(100) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Pin` int NOT NULL,
  `Country` varchar(15) NOT NULL,
  `Status` varchar(3) NOT NULL,
  `Primary_ContactId` int NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` int NOT NULL,
  `Last_Updated` int NOT NULL,
  `Last_UpdatedDateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer`
--

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'Human Resources','HR','A',1,'2023-06-04 16:19:04',1,'2023-07-04 19:32:08'),(2,'Finance','FIN','A',1,'2023-06-04 16:26:34',1,'0000-00-00 00:00:00'),(4,'Engineering','ENG','A',1,'2023-06-04 16:37:41',1,'2023-06-04 14:04:31'),(5,'Operations','OPS','A',1,'2023-06-08 21:31:19',1,'2023-06-08 18:01:29'),(6,'Information Technology','IT','A',1,'2023-06-09 21:12:46',0,NULL);
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
  `status` varchar(2) NOT NULL,
  `createdBy` int NOT NULL,
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_updated` int NOT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_designation`
--

LOCK TABLES `tbl_designation` WRITE;
/*!40000 ALTER TABLE `tbl_designation` DISABLE KEYS */;
INSERT INTO `tbl_designation` VALUES (1,'Head of Accounts','HA','D',1,'2023-06-08 18:34:29',1,'2023-07-04 19:10:04'),(2,'Chief Executive Officer','CEO','A',1,'2023-06-09 21:33:18',1,'2023-07-04 19:10:19');
/*!40000 ALTER TABLE `tbl_designation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_entity`
--

DROP TABLE IF EXISTS `tbl_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_entity` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Cin` varchar(30) NOT NULL,
  `Incorp_Date` date NOT NULL,
  `Add1` varchar(150) NOT NULL,
  `Add2` varchar(100) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Pin` int NOT NULL,
  `Country` varchar(15) NOT NULL,
  `Status` varchar(2) NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` int NOT NULL,
  `Last_Updated` int DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_entity`
--

LOCK TABLES `tbl_entity` WRITE;
/*!40000 ALTER TABLE `tbl_entity` DISABLE KEYS */;
INSERT INTO `tbl_entity` VALUES (1,'SHRI CHANDRA BULK CARGO SERVICES PRIVATE LIMITED','U74900AP2009PTC064815','2009-08-21','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta, Kakinada','Andhra Pradesh',533003,'India','A','2023-06-27 13:32:03',14,1,'2023-07-05 21:42:10'),(2,'SHRI CHANDRA GLOBAL EXIM PRIVATE LIMITED','U51220AP2022PTC121013','2022-03-09','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta, Kakinada','Andhra Pradesh',533003,'India','A','2023-07-04 18:20:51',1,1,'2023-07-24 20:51:23'),(3,'TANMAYEE LOGISTICS AND SERVICES','267 of 2017','2017-04-26','Dr.No.70-7-62/A, 1st Floor Ramya Royale, Revenue Ward-30','Ramanayya Peta, Kakinada','Andhra Pradesh',533003,'India','A','2023-07-24 20:50:13',1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_status` (
  `ID` varchar(3) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `activity` varchar(100) DEFAULT NULL,
  `log` varchar(100) DEFAULT NULL,
  `action_user_id` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trans_user_id_idx` (`action_user_id`),
  CONSTRAINT `fk_trans_user_id` FOREIGN KEY (`action_user_id`) REFERENCES `tbl_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_log`
--

LOCK TABLES `tbl_transaction_log` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_log` DISABLE KEYS */;
INSERT INTO `tbl_transaction_log` VALUES (1,'Password reset performed for user id : 6',NULL,1,'2023-07-23 15:35:59'),(2,'Password reset performed for user id : 6',NULL,1,'2023-07-23 15:45:56'),(3,'User status and role updated for : 6',NULL,1,'2023-07-23 21:21:04'),(4,'Password reset performed for user id : 6',NULL,1,'2023-07-24 14:58:10'),(5,'Password reset performed for user id : 6',NULL,1,'2023-07-24 19:38:10'),(6,'Password reset performed for user id : 6',NULL,1,'2023-07-24 20:08:38'),(7,'Password reset performed for user id : 6',NULL,1,'2023-07-24 20:12:24');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'root','donotreply@pvs-consultancy.com','$2y$10$K8erDeTeJj7XMuE3uQtt8O8I5exRsH7y.bcGxs.QrT6ZhzhwpSU1G',1,'A',1,0,'verified',1,'2023-06-21 13:44:33',NULL,NULL),(2,'scbc1','harithadevi963@gmail.com','$2y$10$aut4egkoMHPaRzHqKnYWOebRV7JPW1KSoisaYbnkPmKK05wsqNDL2',2,'A',3,0,'verified',1,'2023-06-21 13:40:54',NULL,NULL),(3,'haritha','pallalaharithareddy@gmail.com','$2y$10$xzA53B0SL/TONROACen9nu/TkkCbhqKf1bPpPCZjehG4EYFxK0pF2',3,'A',4,747881,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(4,'manasamskriti2','harithadevi5575@gmail.com','$2y$10$v7Aj5qE3.kh9pfH4letpQ.hckym2jumlYdSwcJOUePB5dPUen8yie',4,'A',5,395034,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(5,'sekhar','ryenimireddy@gmail.com','$2y$10$EQbY4NN5LTG/tVOx4Z7ZieETyI/AyxRFpBk6tVec7va9vCf94W37C',4,'A',6,867476,'notverified',1,'2023-06-21 13:40:54',NULL,NULL),(6,'sunilpvs','pvssunil@gmail.com','$2y$10$4C7VU32IOKZnXJutzNq0BOibQ3cXh426nOs85UbXLQQMlJnLlEJ/6',3,'A',9,344172,'notverified',1,'2023-07-23 07:57:44',1,'2023-07-24 20:12:24');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_vendor`
--

DROP TABLE IF EXISTS `tbl_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_vendor` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Add1` varchar(100) NOT NULL,
  `Add2` varchar(100) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Pin` int NOT NULL,
  `Country` varchar(15) NOT NULL,
  `Entity_ID` int NOT NULL,
  `Status` varchar(3) NOT NULL,
  `Created_By` int NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_Updated` int NOT NULL,
  `Last_UpdatedDateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fkey_Vendor` (`Entity_ID`),
  CONSTRAINT `fkey_Vendor` FOREIGN KEY (`Entity_ID`) REFERENCES `tbl_entity` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vendor`
--

LOCK TABLES `tbl_vendor` WRITE;
/*!40000 ALTER TABLE `tbl_vendor` DISABLE KEYS */;
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
 1 AS `Entity`,
 1 AS `CC_Code`,
 1 AS `CC_Type`,
 1 AS `Incorp_Date`,
 1 AS `GST_No`,
 1 AS `State`,
 1 AS `f_name`,
 1 AS `l_name`,
 1 AS `Status`*/;
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
-- Final view structure for view `vw_cargo_types`
--

/*!50001 DROP VIEW IF EXISTS `vw_cargo_types`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_cargo_types` AS select `tbl_cargo_types`.`id` AS `id`,`tbl_cargo_types`.`name` AS `name` from `tbl_cargo_types` order by `tbl_cargo_types`.`id` */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_contact_list` AS select `a`.`id` AS `id`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,date_format(`a`.`dob`,'%d-%b-%Y') AS `dob`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`a`.`State` AS `state`,`b`.`Name` AS `ContactType` from (`tbl_contact` `a` join `tbl_contacttype` `b`) where ((`a`.`ContactType_Id` = `b`.`ID`) and (`b`.`Status` = 'A') and (`b`.`ID` <> 1)) order by `a`.`id` */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_costcenter_list` AS select `b`.`Name` AS `Entity`,`a`.`CC_Code` AS `CC_Code`,`a`.`CC_Type` AS `CC_Type`,date_format(`a`.`Incorp_Date`,'%d-%b-%Y') AS `Incorp_Date`,`a`.`GST_No` AS `GST_No`,`a`.`State` AS `State`,`c`.`f_name` AS `f_name`,`c`.`l_name` AS `l_name`,`a`.`Status` AS `Status` from ((`tbl_costcenter` `a` join `tbl_entity` `b`) join `tbl_contact` `c`) where ((`a`.`Entity_Id` = `b`.`ID`) and (`a`.`Primary_ContactId` = `c`.`id`)) order by `a`.`CC_Code` */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_create_list` AS select `a`.`id` AS `id`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,`b`.`Name` AS `ctype` from (`tbl_contact` `a` join `tbl_contacttype` `b`) where ((`a`.`ContactType_Id` = `b`.`ID`) and (`b`.`ID` = 2) and `a`.`id` in (select `tbl_users`.`contact_id` from `tbl_users`) is false) order by `a`.`id` */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_validatelogin` AS select `a`.`id` AS `id`,`a`.`user_name` AS `user_name`,`a`.`password` AS `password`,`a`.`code` AS `code`,`a`.`status` AS `status`,`b`.`f_name` AS `f_name`,`b`.`l_name` AS `l_name`,`a`.`email` AS `email`,`b`.`mobile` AS `mobile`,`c`.`Name` AS `ctype`,`a`.`user_role_id` AS `user_role_id`,`d`.`user_role` AS `user_role` from (((`tbl_users` `a` join `tbl_contact` `b`) join `tbl_contacttype` `c`) join `tbl_user_role` `d`) where ((`a`.`contact_id` = `b`.`id`) and (`b`.`ContactType_Id` = `c`.`ID`) and (`a`.`user_role_id` = `d`.`id`) and (`a`.`user_status` = 'A')) */;
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
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
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

-- Dump completed on 2023-07-24 21:16:50
