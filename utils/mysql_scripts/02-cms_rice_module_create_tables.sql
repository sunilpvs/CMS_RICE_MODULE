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
-- --------------------------------------------------------
-- Table structure for table `tbl_warehouse`
CREATE TABLE `tbl_warehouse` (
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
-- --------------------------------------------------------
-- Table structure for table `tbl_compartment`
CREATE TABLE `tbl_compartment` (
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
-- Table structure for table `tbl_inwardlease`
CREATE TABLE `tbl_inwardlease` (
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
-- --------------------------------------------------------
-- Table structure for table `tbl_outwardlease`
CREATE TABLE `tbl_outwardlease` (
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