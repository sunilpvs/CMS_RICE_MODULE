################################################################################################
# SQL FOR DB CREATION WITH BASIC CONFIGURATIONS
################################################################################################
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 06:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

################################################################################################
#   RICE MODULE TABLE CREATIONS
# 	MASTER DATA TABLES FOR RICE MODULE: START
################################################################################################
DROP TABLE IF EXISTS `tbl_commodity_stock`;
DROP TABLE IF EXISTS `tbl_outwardstock`;
DROP TABLE IF EXISTS `tbl_inwardstock`;
DROP TABLE IF EXISTS `tbl_inwarddates`;
DROP TABLE IF EXISTS `tbl_outwarddates`;
DROP TABLE IF EXISTS `tbl_outwardlease`;
DROP TABLE IF EXISTS `tbl_inwardlease`;
DROP TABLE IF EXISTS `tbl_commodity`;
DROP TABLE IF EXISTS `tbl_compartment`;
DROP TABLE IF EXISTS `tbl_warehouse`;
DROP TABLE IF EXISTS `tbl_miller`;
DROP TABLE IF EXISTS `tbl_lessor`;

DROP TABLE IF EXISTS `tbl_cargo_details`;
DROP TABLE IF EXISTS `tbl_cargo_types`;
DROP TABLE IF EXISTS `tbl_inwardmode`;
DROP TABLE IF EXISTS `tbl_leasetype`;
DROP TABLE IF EXISTS `tbl_lease_model`;
DROP TABLE IF EXISTS `tbl_lessortype`;
DROP TABLE IF EXISTS `tbl_transport_mode`;
DROP TABLE IF EXISTS `tbl_delivery_details`;
-- --------------------------------------------------------
-- --------------------------------------------------------
-- Table structure for table `tbl_cargo_details`
CREATE TABLE `tbl_cargo_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_cargo_details`
INSERT INTO `tbl_cargo_details` (`id`, `name`) VALUES
(1, 'Boiled Rice'),
(2, 'Raw Rice'),
(3, 'Raw Broken');
-- --------------------------------------------------------
-- Table structure for table `tbl_cargo_types`
CREATE TABLE `tbl_cargo_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_cargo_types`
INSERT INTO `tbl_cargo_types` (`id`, `name`, `code`) VALUES
(1, 'Bulk', 'BLK'),
(2, 'Break Bulk', 'BBL'),
(3, 'Liquid Bulk', 'LBL'),
(4, 'Project Cargo', 'PC'),
(5, 'Containers', 'C');
-- --------------------------------------------------------
-- Table structure for table `tbl_inwardmode`
CREATE TABLE `tbl_inwardmode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- Dumping data for table `tbl_inwardmode`
INSERT INTO `tbl_inwardmode` (`id`, `name`) VALUES
(1, 'Wagon'),
(2, 'Long Vehicles'),
(3, 'Local - Miller'),
(4, 'Local - CHA');
-- --------------------------------------------------------
-- Table structure for table `tbl_leasetype`
CREATE TABLE `tbl_leasetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ltype` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_leasetype`
INSERT INTO `tbl_leasetype` (`id`, `ltype`) VALUES
(1, 'Initial'),
(2, 'Extension');
-- --------------------------------------------------------
-- Table structure for table `tbl_lease_model`
CREATE TABLE `tbl_lease_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_model` varchar(15) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_lease_model`
INSERT INTO `tbl_lease_model` (`id`, `lease_model`) VALUES
(1, 'Dedicated'),
(2, 'Common/Shared');
-- --------------------------------------------------------
-- Table structure for table `tbl_lessortype`
CREATE TABLE `tbl_lessortype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ltype` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_lessortype`
INSERT INTO `tbl_lessortype` (`id`, `ltype`) VALUES
(1, 'Government'),
(2, 'Private');
-- --------------------------------------------------------
-- Table structure for table `tbl_transport_mode`
CREATE TABLE `tbl_transport_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_mode` varchar(20) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_transport_mode`
INSERT INTO `tbl_transport_mode` (`id`, `transport_mode`, `priority`) VALUES
(1, 'Wagon', 1),
(2, 'Long Vehicle', 2),
(3, 'Long Delivery', 3),
(4, 'Other CHA', 4);
-- --------------------------------------------------------
-- Table structure for table `tbl_delivery_details`
CREATE TABLE `tbl_delivery_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_delivery_details`
INSERT INTO `tbl_delivery_details` (`id`, `name`) VALUES
(1, 'Delivery to Barge'),
(2, 'Other CHA'),
(3, 'Local Sale'),
(4, 'Others');
################################################################################################
# MASTER DATA TABLES FOR RICE MODULE: END
################################################################################################
################################################################################################
# TRANSACTION TABLES FOR RICE MODULE: START
################################################################################################
################################################################################################
-- Table structure for table `tbl_lessor`
CREATE TABLE `tbl_lessor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessor_name` varchar(50) NOT NULL,
  `ltype` int(11) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `primary_contact` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` date DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (city) REFERENCES tbl_city(id),
  FOREIGN KEY (state) REFERENCES tbl_state(id),
  FOREIGN KEY (country) REFERENCES tbl_country(id),
  FOREIGN KEY (primary_contact) REFERENCES tbl_contact(id),
  FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
  FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_lessor`
INSERT INTO `tbl_lessor` (`id`, `lessor_name`, `ltype`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `primary_contact`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'SATHVIK LOGISTICS', 2, 'NEAR MARINE POLICE STATION', 'PORT ADREA', 1, 1, 533005, 1, 1, 1, 1, 1, '2023-08-08 17:55:22', NULL, NULL),
(2, 'MMTC', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-08-14 09:51:09', NULL, NULL),
(3, 'MMTC1', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:45:58', 1, '2024-07-16'),
(4, 'MMTC2', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:46:58', 1, '2024-07-16'),
(5, 'TRANSITSHED-H', 1, 'ANCHORAGE PORT', 'NEAR ANCOHRAGE PORT MAIN ENTARANCE', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:51:31', 1, '2024-07-16'),
(6, 'SUNDARAMA ENTERPRISES', 2, 'D-NO:', 'BESIDE RUCHI INDUSTRIES,DUMMULAPETA', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:55:51', NULL, NULL),
(7, 'MMTC3', 1, 'Add1', '2', 1, 1, 533046, 1, 1, 1, 1, 1, '2024-07-16 21:33:33', NULL, NULL);
-- --------------------------------------------------------
-- Table structure for table `tbl_miller`
CREATE TABLE `tbl_miller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `miller_name` varchar(50) NOT NULL,
  `gst_num` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),    
	FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_miller`
INSERT INTO `tbl_miller` (`id`, `miller_name`, `gst_num`, `place`, `add1`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'SAMEERA AGRO INDUSTRIES', '37ACQFS0082C1Z3', 'RAJANAGARAM', 'NARENDRAPURAM', 1, 1, 3, '2023-10-16 12:18:44', NULL, NULL),
(2, 'PADMASRI RICE MILL', '37AALFP0579Q1ZC', 'DUPPAPUDI', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:23:54', NULL, NULL),
(3, 'SURYASRI RICE MILL', '37AAYFS8716M1Z1', 'KOPPAVARAM', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:25:17', NULL, NULL),
(4, 'SRI AYYAPPA RICE INDUSTRIES', '37ABIFS4435L1ZP', 'POLAMURU', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:26:34', NULL, NULL),
(5, 'RAJU RANI', '37ACQFS0082C1Z3', 'KAKINADA', 'KAKINADA', 1, 1, 3, '2023-11-11 12:40:45', NULL, NULL),
(6, 'MKR', '37AAYFS8716M1Z1', 'KAKINADA', 'KAKINADA', 1, 1, 3, '2023-11-11 12:41:43', NULL, NULL);
-- --------------------------------------------------------
-- Table structure for table `tbl_commodity`
CREATE TABLE `tbl_commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity` varchar(50) NOT NULL,
  `commodity_name` varchar(75) NOT NULL,
  `cargo_type` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `marking` varchar(50) NOT NULL,
  `empty_bag_wt` float NOT NULL,
  `bag_wt` float NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  	PRIMARY KEY (id),
	FOREIGN KEY (cargo_type) REFERENCES tbl_cargo_types(id),
    FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
    FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_commodity`
INSERT INTO `tbl_commodity` (`id`, `commodity`, `commodity_name`, `cargo_type`, `brand`, `marking`, `empty_bag_wt`, `bag_wt`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'Bulk-SORTEX BOILED RICE-LIZA GREEN-50KG', 'SORTEX BOILED RICE', 1, 'LIZA GREEN', '50KG', 0.16, 50, 1, 1, 1, '2023-10-16 12:28:44', NULL, NULL),
(2, 'Bulk- SORTEX BOILED RICE-LIZA GREEN-26KG', ' SORTEX BOILED RICE', 1, 'LIZA GREEN', '26KG', 0.16, 26, 1, 1, 1, '2024-03-30 19:22:19', 1, '2024-03-30 14:53:44');
-- --------------------------------------------------------
-- Table structure for table `tbl_warehouse`
CREATE TABLE `tbl_warehouse` (
  `prefix` varchar(8) NOT NULL DEFAULT 'SCBC-WH-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `lessor_id` int(11) NOT NULL,
  `add1` varchar(20) NOT NULL,
  `add2` varchar(20) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `capacity_sqft` int(11) NOT NULL DEFAULT 0,
  `capacity_mton` int(11) NOT NULL DEFAULT 0,
  `used_sqft` int(11) NOT NULL DEFAULT 0,
  `used_mton` int(11) NOT NULL DEFAULT 0,
  `avl_sqft` int(11) NOT NULL DEFAULT 0,
  `avl_mton` int(11) NOT NULL DEFAULT 0,
  `primary_contact` int(11) DEFAULT NULL,
  `inward_contractid` varchar(15) NOT NULL,
  `inward_leasetype` int(11) NOT NULL,
  `inward_start` date DEFAULT NULL,
  `inward_expiry` date DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY (id),
    FOREIGN KEY (lessor_id) REFERENCES tbl_lessor(id),
	FOREIGN KEY (city) REFERENCES tbl_city(id),
	FOREIGN KEY (state) REFERENCES tbl_state(id),
	FOREIGN KEY (country) REFERENCES tbl_country(id),
	FOREIGN KEY (primary_contact) REFERENCES tbl_contact(id),
    FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
	FOREIGN KEY (status) REFERENCES tbl_status(id)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_warehouse`
INSERT INTO `tbl_warehouse` (`prefix`, `id`, `warehouse_name`, `code`, `lessor_id`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `capacity_sqft`, `capacity_mton`, `used_sqft`, `used_mton`, `avl_sqft`, `avl_mton`, `primary_contact`, `inward_contractid`, `inward_leasetype`, `inward_start`, `inward_expiry`, `status`, `entity_id`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-WH-', 0001, 'SATHVIK WAREHOUSE', 'SAT-2', 1, 'NEAR MARINE POLICE S', 'PORT ADREA', 1, 1, 533005, 1, 64000, 16000, 0, 0, 64000, 16000, 1, 'SCBC-INW23-0008', 1, '2024-08-27', '2024-08-28', 1, 1, 1, '2023-08-08 18:01:25', 1, '2023-09-02 22:04:59'),
('SCBC-WH-', 0002, 'MMTC', 'G-02', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 60000, 15000, 60000, 15000, 0, 0, 1, '', 0, NULL, NULL, 1, 1, 3, '2023-08-16 13:46:57', 1, '2023-09-02 21:36:12'),
('SCBC-WH-', 0003, 'TRANSITSHED-H', 'GOV-1', 5, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 17190, 4297, 17190, 4298, 0, 0, 1, '', 0, NULL, NULL, 1, 1, 1, '2023-10-16 12:40:46', NULL, NULL),
('SCBC-WH-', 0004, 'MMTC2- WH1', 'WH2', 4, 'Add2', 'add2', 1, 1, 533046, 1, 12000, 3000, 0, 0, 12000, 3000, 1, '', 0, NULL, NULL, 1, 1, 1, '2024-07-16 21:34:47', NULL, NULL);
-- --------------------------------------------------------
-- Table structure for table `tbl_compartment`
CREATE TABLE `tbl_compartment` (
  `prefix` varchar(10) NOT NULL DEFAULT 'SCBC-COMP-',
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `compartment_id` varchar(15) NOT NULL,
  `compartment_name` varchar(10) DEFAULT NULL,
  `outwardlease_id` int(11) NOT NULL,
  `warehouse_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `capacity_sqft` float NOT NULL,
  `capacity_mton` float NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
  	PRIMARY KEY (id),
    
	FOREIGN KEY (warehouse_id) REFERENCES tbl_warehouse(id),
    FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
	FOREIGN KEY (status) REFERENCES tbl_status(id)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_compartment`
INSERT INTO `tbl_compartment` (`prefix`, `id`, `compartment_id`, `compartment_name`, `outwardlease_id`, `warehouse_id`, `capacity_sqft`, `capacity_mton`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-COMP-', 00001, 'SCBC-COMP-00001', 'H-1', 2, 0003, 5500, 1375, 1, 3, 3, '2023-10-21 11:06:02', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00002, 'SCBC-COMP-00002', 'C2-24', 2, 0003, 5000, 1250, 1, 3, 1, '2024-03-30 19:19:48', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00003, 'SCBC-COMP-00003', 'OLAM - C1', 11, 0003, 2000, 500, 1, 1, 1, '2024-04-20 22:49:30', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00004, 'SCBC-COMP-00004', 'MS-TH1', 12, 0003, 5000, 1250, 1, 1, 1, '2024-05-22 19:53:09', 0, '0000-00-00 00:00:00');
-- --------------------------------------------------------
-- Table structure for table `tbl_inwardlease`
CREATE TABLE `tbl_inwardlease` (
  `prefix` varchar(11) NOT NULL DEFAULT 'SCBC-INW24-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(15) NOT NULL,
  `warehouse_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `lease_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (warehouse_id) REFERENCES tbl_warehouse(id),
	FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
    FOREIGN KEY (status) REFERENCES tbl_status(id)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_inwardlease`
INSERT INTO `tbl_inwardlease` (`prefix`, `id`, `contract_id`, `warehouse_id`, `lease_type`, `start_date`, `expiry_date`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-INW24-', 0001, 'SCBC-INW24-0001', 0001, 1, '2023-07-01', '2023-12-31', 1, 6, 1, '2023-09-05 09:55:16', NULL, NULL),
('SCBC-INW24-', 0002, 'SCBC-INW24-0002', 0002, 1, '2023-04-26', '2025-05-25', 1, 5, 3, '2023-10-16 12:42:33', NULL, NULL),
('SCBC-INW24-', 0003, 'SCBC-INW24-0003', 0003, 1, '2024-04-02', '2024-07-31', 1, 6, 1, '2024-04-02 17:16:05', NULL, NULL),
('SCBC-INW24-', 0004, 'SCBC-INW24-0004', 0004, 1, '2024-08-27', '2024-12-28', 1, 5, 1, '2024-08-27 08:25:18', NULL, NULL);
-- Triggers `tbl_inwardlease`
DELIMITER $$
CREATE TRIGGER `after_insert_inwardlease` AFTER INSERT ON `tbl_inwardlease` FOR EACH ROW begin
	DECLARE contract VARCHAR(15);
	SET @contract := concat(NEW.prefix,NEW.id);    
    UPDATE tbl_warehouse SET inward_contractid = @contract,     inward_leasetype = NEW.lease_type, 
		inward_start = NEW.start_date, inward_expiry = NEW.expiry_date
	WHERE id = NEW.warehouse_id;
END
$$
DELIMITER ;
-- --------------------------------------------------------
-- Table structure for table `tbl_inwarddates`
CREATE TABLE `tbl_inwarddates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_type` int(11) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `lease_ref` int(11) NOT NULL,
  	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_lease_dates`
INSERT INTO `tbl_inwarddates` (`id`, `lease_type`, `start_date`, `end_date`, `lease_ref`) VALUES
(1, 1, '2023-07-01', '2023-12-31', 1),
(2, 1, '2023-04-26', '2025-05-25', 2),
(3, 1, '2024-04-02', '2024-07-31', 3),
(4, 1, '2024-08-27', '2024-12-28', 4);

-- --------------------------------------------------------
-- Table structure for table `tbl_outwardlease`
CREATE TABLE `tbl_outwardlease` (
  `prefix` varchar(11) NOT NULL DEFAULT 'SCBC-OUT24-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(15) NOT NULL,
  `warehouse_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `customer_id` int(11) NOT NULL,
  `lease_contract_id` varchar(15) NOT NULL,
  `lease_model` int(11) NOT NULL,
  `lease_start` date NOT NULL,
  `lease_end` date NOT NULL,
  `lease_days` int(11) NOT NULL,
  `before_capacity_sqft` float NOT NULL DEFAULT 0,
  `lease_capacity_sqft` float DEFAULT NULL,
  `after_capacity_sqft` float NOT NULL,
  `before_capacity_mton` float NOT NULL,
  `lease_capacity_mton` float DEFAULT NULL,
  `after_capacity_mton` float NOT NULL,
  `daily_rate_sqft` float DEFAULT 0,
  `daily_rate_mton` float DEFAULT 0,
  `cost_sqft` float DEFAULT 0,
  `cost_mton` float DEFAULT 0,
  `total_cost` float NOT NULL DEFAULT 0,
  `lease_status` int(11) NOT NULL,
  `release_capacity` tinyint(1) NOT NULL DEFAULT 0,
  `entity_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (warehouse_id) REFERENCES tbl_warehouse(id),
    FOREIGN KEY (customer_id) REFERENCES tbl_customer(id),
	FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
    FOREIGN KEY (lease_status) REFERENCES tbl_status(id)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_outwardlease`
INSERT INTO `tbl_outwardlease` (`prefix`, `id`, `contract_id`, `warehouse_id`, `customer_id`, `lease_contract_id`, `lease_model`, `lease_start`, `lease_end`, `lease_days`, `before_capacity_sqft`, `lease_capacity_sqft`, `after_capacity_sqft`, `before_capacity_mton`, `lease_capacity_mton`, `after_capacity_mton`, `daily_rate_sqft`, `daily_rate_mton`, `cost_sqft`, `cost_mton`, `total_cost`, `lease_status`, `release_capacity`, `entity_id`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-OUT24-', 0001, '', 0001, 1, 'SCBC-OUT24-0001', 1, '2023-10-05', '2023-11-04', 30, 17190, 17190, 0, 4297, 4297, 0, 0.25, 0, 128925, 0, 128925, 6, 1, 1, 3, '2023-10-21 11:01:46', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0002, '', 0002, 4, 'SCBC-OUT24-0002', 1, '2024-04-20', '2024-05-04', 14, 60000, 60000, 0, 15000, 15000, 0, 0.75, NULL, 630000, NULL, 630000, 5, 0, 1, 1, '2024-04-20 21:46:40', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0003, '', 0003, 1, 'SCBC-OUT24-0003', 1, '2024-04-20', '2024-04-30', 10, 17190, 7190, 10000, 4297, 1797.5, 2500, 1.25, NULL, 89875, NULL, 89875, 5, 0, 1, 1, '2024-04-20 21:49:19', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0004, '', 0004, 4, 'SCBC-OUT24-0004', 1, '2024-04-20', '2024-04-30', 10, 10000, 10000, 0, 2500, 2500, 0, 1.5, NULL, 150000, NULL, 150000, 5 , 0, 1, 1, '2024-04-20 21:49:47', 0, '0000-00-00 00:00:00');
-- --------------------------------------------------------
-- Table structure for table `tbl_inwarddates`
CREATE TABLE `tbl_outwarddates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_type` int(11) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `lease_ref` int(11) NOT NULL,
  	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_lease_dates`
INSERT INTO `tbl_outwarddates` (`id`, `lease_type`, `start_date`, `end_date`, `lease_ref`) VALUES
(1, 1, '2023-10-05', '2023-11-04', 1),
(2, 1, '2024-04-20', '2024-05-04', 2),
(3, 1, '2024-04-20', '2024-04-30', 3),
(4, 1, '2024-04-20', '2024-04-30', 4);
-- --------------------------------------------------------
-- Table structure for table `tbl_inwardstock`
CREATE TABLE `tbl_inwardstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `compartment_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `mod_transport` int(11) NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `inward_bags_stock` int(20) NOT NULL,
  `outward_bags_stock` int(11) NOT NULL DEFAULT 0,
  `current_bags_stock` int(11) NOT NULL,
  `received_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `miller_id` int(10) NOT NULL,
  `inward_gross_wt` float NOT NULL,
  `inward_net_wt` float NOT NULL,
  `inward_wb_gross_wt` float NOT NULL,
  `inward_wb_net_wt` float NOT NULL,
  `inward_diff_gross` float NOT NULL,
  `inward_diff_net` float NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `entity_id` int(11) NOT NULL, 
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `lastupdated_by` int(11) DEFAULT NULL,
  `lastupdated_datetime` datetime DEFAULT NULL,
  	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_outwardstock`
CREATE TABLE `tbl_outwardstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `compartment_id` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `inward_transport` int(11) NOT NULL,
  `current_bags_stock` int(11) NOT NULL DEFAULT 0,
  `outward_date` date NOT NULL,
  `dc_no` varchar(50) NOT NULL,
  `dc_date` date NOT NULL,
  `bags_out` int(11) NOT NULL DEFAULT 0,
  `vehicle_no` varchar(30) NOT NULL,
  `delivery_dtl` int(11) NOT NULL,
  `gross_wt` float NOT NULL DEFAULT 0,
  `wb_gross_wt` float NOT NULL DEFAULT 0,
  `gross_diff` float NOT NULL DEFAULT 0,
  `net_wt` float NOT NULL DEFAULT 0,
  `wb_net_wt` float NOT NULL DEFAULT 0,
  `net_diff` float NOT NULL DEFAULT 0,
  `remarks` varchar(100) NOT NULL,
  `entity_id` int(11) NOT NULL, 
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `Last_updateddatetime` datetime DEFAULT NULL,
  	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_commodity_stock`
CREATE TABLE `tbl_commodity_stock` (
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `compartment_id` int(5) NOT NULL,
  `commodity_id` int(5) NOT NULL,
  `mod_transport` int(11) NOT NULL DEFAULT 0,
  `bags_stock` int(11) NOT NULL,
  `gross_wt` int(11) NOT NULL,
  `net_wt` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL, 
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
	PRIMARY KEY(customer_id,warehouse_id,compartment_id,commodity_id,mod_transport)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

################################################################################################
# TRANSACTION TABLES FOR RICE MODULE: END
################################################################################################
-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;