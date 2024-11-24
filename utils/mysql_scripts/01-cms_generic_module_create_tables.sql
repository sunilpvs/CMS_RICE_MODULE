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
# DATABASE NAME: CMS
# DROP TABLES BEFORE CREATION IF EXISTS
################################################################################################
DROP TABLE IF EXISTS `tbl_user_role`;
DROP TABLE IF EXISTS `tbl_userroles`;
DROP TABLE IF EXISTS `tbl_pagemaster`;
DROP TABLE IF EXISTS `tbl_userpermissions`;
DROP TABLE IF EXISTS `tbl_transaction_log`;
DROP TABLE IF EXISTS `tbl_vendor`;
DROP TABLE IF EXISTS `tbl_customer`;
DROP TABLE IF EXISTS `tbl_costcenter`;
DROP TABLE IF EXISTS `tbl_users`;
DROP TABLE IF EXISTS `tbl_city`;
DROP TABLE IF EXISTS `tbl_state`;
DROP TABLE IF EXISTS `tbl_country`; 
DROP TABLE IF EXISTS `tbl_contact`;
DROP TABLE IF EXISTS `tbl_designation`;
DROP TABLE IF EXISTS `tbl_department`;
DROP TABLE IF EXISTS `tbl_entity`;
DROP TABLE IF EXISTS `tbl_costcentertype`;
DROP TABLE IF EXISTS `tbl_contacttype`;
DROP TABLE IF EXISTS `tbl_status`;
################################################################################################
# GENERIC TABLE CREATION
################################################################################################
-- Table structure for table `tbl_status`
CREATE TABLE `tbl_status` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `status` varchar(25) NOT NULL,
  `module` varchar(15) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_mod_status`
INSERT INTO `tbl_status` (`id`, `code`, `status`, `module`) VALUES
(1, 'A', 'Active', 'GEN'),
(2, 'D', 'De-Active', 'GEN'),
(3, 'E', 'Expired', 'GEN'),
(4, 'S', 'Suspended', 'GEN'),
(5, 'A', 'Active', 'LEASE'),
(6, 'E', 'Expired', 'LEASE');
-- --------------------------------------------------------
-- Table structure for table `tbl_contacttype`
CREATE TABLE `tbl_contacttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_contacttype`
INSERT INTO `tbl_contacttype` (`id`, `Name`, `Status`) VALUES
(1, 'System User', 1),
(2, 'Employee', 1),
(3, 'Consultant', 1),
(4, 'Customer', 1),
(5, 'Vendor/Supplier', 1),
(6, 'Lessor', 1);
-- --------------------------------------------------------
-- Table structure for table `tbl_costcentertype`
CREATE TABLE `tbl_costcentertype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cc_type` varchar(15) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_mod_status`
INSERT INTO `tbl_costcentertype` (`id`, `cc_type`) VALUES
(1, 'Head-Office'),
(2, 'Branch-Office');
-- --------------------------------------------------------
-- Table structure for table `tbl_country`
CREATE TABLE `tbl_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_country`
INSERT INTO `tbl_country` (`id`, `country`,`code`,`currency`) VALUES
(1, 'India','IND','INR');
-- --------------------------------------------------------
-- Table structure for table `tbl_state`
CREATE TABLE `tbl_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(75) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
	PRIMARY KEY(id),
    FOREIGN KEY (country) REFERENCES tbl_country(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_state`
INSERT INTO `tbl_state` (`id`, `state`, `country`) VALUES
(1, 'Andhra Pradesh', 1),
(2, 'Arunachal Pradesh', 1),
(3, 'Assam', 1),
(4, 'Bihar', 1),
(5, 'Chhattisgarh', 1),
(6, 'Goa', 1),
(7, 'Gujarat', 1),
(8, 'Haryana', 1),
(9, 'Himachal Pradesh', 1),
(10, 'Jharkhand', 1),
(11, 'Karnataka', 1),
(12, 'Kerala', 1),
(13, 'Madhya Pradesh', 1),
(14, 'Maharashtra', 1),
(15, 'Manipur', 1),
(16, 'Meghalaya', 1),
(17, 'Mizoram', 1),
(18, 'Nagaland', 1),
(19, 'Odisha', 1),
(20, 'Punjab', 1),
(21, 'Rajasthan', 1),
(22, 'Sikkim', 1),
(23, 'Tamil Nadu', 1),
(24, 'Telangana', 1),
(25, 'Tripura', 1),
(26, 'Uttarakhand', 1),
(27, 'Uttar Pradesh', 1),
(28, 'West Bengal', 1);
-- --------------------------------------------------------
-- Table structure for table `tbl_city`
CREATE TABLE `tbl_city` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`city` varchar(50) DEFAULT NULL,
    `state` int(11) DEFAULT NULL,
	`country` int(11) DEFAULT NULL,
	PRIMARY KEY (id),
    FOREIGN KEY (state) REFERENCES tbl_state(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_city`
INSERT INTO `tbl_city` (`id`, `city`, `state`,`country`) VALUES
(1, 'Kakinada', 1,1),
(2, 'Benguluru', 11,1),
(3, 'Chennai', 23,1),
(4, 'Delhi', 8,1),
(5, 'Guntur', 1,1),
(6, 'Hyderabad', 24,1),
(7, 'Mumbai', 14,1),
(8, 'Nellore', 1,1),
(9, 'Surat', 7,1),
(10, 'Visakhapatnam', 1,1);
-- --------------------------------------------------------
-- Table structure for table `tbl_department`
CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  `status` int(3) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `created_datetime` datetime DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_department`
INSERT INTO `tbl_department` (`id`, `name`, `code`, `status`, `createdBy`, `created_datetime`, `last_updated`, `last_updatedDatetime`) VALUES
(1, 'HUMAN RESOURCES', 'HR', 1, 1, '2023-06-04 16:19:04', 1, '2023-07-04 19:32:08'),
(2, 'FINANCE', 'FIN', 1, 1, '2023-06-04 16:26:34', 1, '2024-03-30 18:57:54'),
(3, 'ENGINEERING', 'ENG', 1, 1, '2023-06-04 16:37:41', 1, '2023-08-01 04:00:52'),
(4, 'OPERATIONS', 'OPS', 1, 1, '2023-06-08 21:31:19', 1, '2023-06-08 18:01:29'),
(5, 'INFORMATION TECHNOLOGY', 'IT', 1, 1, '2023-06-09 21:12:46', 1, '2023-08-03 12:57:59'),
(6, 'INVENTORY', 'INV', 1, 1, '2023-08-03 13:00:21', 1, '2023-08-03 13:00:36'),
(7, 'ADMINISTRATION', 'ADM', 1, 2, '2023-08-07 11:50:34', NULL, NULL),
(8, 'ACCOUNTS', 'ACC', 1, 2, '2023-08-07 11:50:58', NULL, NULL),
(9, 'AGENCY', 'AGY', 1, 2, '2023-08-07 11:51:18', NULL, NULL),
(10, 'BILLING', 'BIL', 1, 2, '2023-08-07 11:51:43', NULL, NULL),
(11, 'CLEARING & FORWADING', 'C&F', 1, 2, '2023-08-07 11:52:27', NULL, NULL),
(12, 'CONTRACTS', 'CON', 1, 2, '2023-08-07 11:52:46', NULL, NULL),
(13, 'CREWING', 'CRE', 1, 2, '2023-08-07 11:54:02', NULL, NULL),
(14, 'CUSTOMS OPERATIONS', 'C-OPS', 1, 2, '2023-08-07 11:54:17', NULL, NULL),
(15, 'DOCUMENTATION', 'DOC', 1, 2, '2023-08-07 11:54:44', NULL, NULL),
(16, 'FIELD OPERATIONS', 'FIO', 1, 2, '2023-08-07 11:56:24', NULL, NULL),
(17, 'LOGISTICS', 'LOG', 1, 2, '2023-08-07 15:16:35', 2, '2023-08-07 15:17:24');
-- --------------------------------------------------------
-- Table structure for table `tbl_designation`
CREATE TABLE `tbl_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  `status` int(3) NOT NULL,  
  `createdBy` int(11) NOT NULL,
  `created_datetime` datetime DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_designation`
INSERT INTO `tbl_designation` (`id`, `name`, `code`, `status`, `createdBy`, `created_datetime`, `last_updated`, `last_updatedDatetime`) VALUES
(1, 'Chief Executive Officer', 'CEO', 1, 1, '2023-06-09 21:33:18', 1, '2023-08-01 04:03:17'),
(2, 'Managing Director', 'MD', 1, 1, '2023-06-08 18:34:29', 1, '2023-07-28 06:18:37'),
(3, 'HOD - Human Resources', 'HHR', 1, 1, '2023-07-28 06:20:33', NULL, NULL),
(4, 'HOD - Finance', 'HF', 1, 1, '2023-07-28 06:21:12', 1, '2023-07-28 06:21:48'),
(5, 'HOD - Operations', 'HOP', 1, 1, '2023-07-28 06:21:33', NULL, NULL),
(6, 'HOD - Technology', 'HT', 1, 1, '2023-07-28 06:22:21', NULL, NULL),
(7, 'HOD - Sales', 'HS', 1, 1, '2023-07-28 06:25:15', NULL, NULL),
(8, 'Senior Manager', 'SM', 1, 1, '2023-07-28 06:25:47', NULL, NULL),
(9, 'Manager', 'M', 1, 1, '2023-07-28 06:25:55', NULL, NULL),
(10, 'Director', 'D', 1, 1, '2023-07-28 06:26:07', NULL, NULL),
(11, 'Senior Executive', 'SE', 1, 1, '2023-07-28 06:26:28', NULL, NULL),
(12, 'Executive', 'E', 1, 1, '2023-07-28 06:26:37', NULL, NULL),
(13, 'On-Job Trainee', 'OJT', 1, 1, '2023-08-03 13:01:17', NULL, NULL);
-- --------------------------------------------------------
-- Table structure for table `tbl_contact`
CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `personal_email` varchar(55) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `contacttype_id` int(11) NOT NULL,
  `join_date` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `emp_status` int(3) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (contacttype_id) REFERENCES tbl_contacttype(id),
  FOREIGN KEY (emp_status) REFERENCES tbl_status(id),
  FOREIGN KEY (department) REFERENCES tbl_department(id),
  FOREIGN KEY (designation) REFERENCES tbl_designation(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_contact`
INSERT INTO `tbl_contact` (`id`, `f_name`, `l_name`, `dob`, `email`, `personal_email`, `mobile`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `contacttype_Id`, `join_date`, `exit_date`, `emp_status`, `department`, `designation`, `image`, `createdBy`, `created_datetime`, `last_updated`, `last_updatedDatetime`) VALUES
(1, 'Super', 'User', '2023-01-01', 'sunil.pvs@pvs-consultancy.com', 'sunil.pvs@pvs-consultancy.com', '9885300090', 'AT2-001, NCC Urban Gardenia', 'Hitech City Main Rd, Diamond Hills, Lumbini Avenue, Gachibowli, Hyderguda', 6, 24, 500032, 1, 1, '2023-01-01', '2030-01-01', 1, 6, 1, '', 1, '2023-06-10 21:32:59', 1, '2023-07-01 22:05:57');
-- --------------------------------------------------------
-- Table structure for table `tbl_entity`
CREATE TABLE `tbl_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(100) NOT NULL,
  `cin` varchar(30) NOT NULL,
  `incorp_date` date NOT NULL,
  `status` int(3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_costcenter`
CREATE TABLE `tbl_costcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_code` varchar(5) NOT NULL,
  `cc_type` int(3) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `incorp_date` date DEFAULT NULL,
  `gst_no` varchar(25) DEFAULT NULL,
  `add1` varchar(100) DEFAULT NULL,
  `add2` varchar(100) DEFAULT NULL,
  `city` int(3) DEFAULT NULL,
  `state` int(3) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `country` int(3) DEFAULT NULL,
  `primary_contact` int(3) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY(id),
    FOREIGN KEY (cc_type) REFERENCES tbl_costcentertype(id),
    FOREIGN KEY (entity_id) REFERENCES tbl_entity(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_customer`
CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int(11) DEFAULT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `primary_contact` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (primary_contact) REFERENCES tbl_contact(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_vendor`
CREATE TABLE `tbl_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(100) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` int(11) DEFAULT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `primary_contact` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (primary_contact) REFERENCES tbl_contact(id),
	FOREIGN KEY (status) REFERENCES tbl_status(id)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_transaction_log`
CREATE TABLE `tbl_transaction_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(100) NOT NULL,
  `log` int(11) DEFAULT NULL,
  `action_user_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
################################################################################################
# GENERIC TABLES CREATION COMPLETED
################################################################################################
################################################################################################
# SECURITY RELATED TABLES CREATION : START
################################################################################################
-- Table structure for table `tbl_user_role`
CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- Dumping data for table `tbl_user_role`
INSERT INTO `tbl_user_role` (`id`, `user_role`) VALUES
(1, 'SUPER USER'),
(2, 'IT ADMIN'),
(3, 'MOD_RICE_ADMIN'),
(4, 'MOD_RICE_USER'),
(5, 'BASE_EMPLOYEE');
-- --------------------------------------------------------
-- Table structure for table `tbl_pagemaster`
CREATE TABLE `tbl_pagemaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(15) NOT NULL,
  `page` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `status` int(3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (status) REFERENCES tbl_status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_userroles`
CREATE TABLE `tbl_userroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `lastupdated_by` int(11) NOT NULL,
  `lastupdated_datetime` datetime NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (page) REFERENCES tbl_pagemaster(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_userpermissions`
CREATE TABLE `tbl_userpermissions` (
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `access_type` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `lastupdated_by` int(11) NOT NULL,
  `lastupdated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
-- Table structure for table `tbl_users`
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `user_status` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `code` mediumint(9) NOT NULL,
  `status` text NOT NULL,
  `entity_id` int(11) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDateTime` datetime DEFAULT current_timestamp(),
  `Last_UpdatedBy` int(11) DEFAULT NULL,
  `Last_UpdatedDateTime` datetime DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (user_status) REFERENCES tbl_status(id),
  FOREIGN KEY (entity_id) REFERENCES tbl_entity(id),
  FOREIGN KEY (contact_id) REFERENCES tbl_contact(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- Dumping data for table `tbl_users`
INSERT INTO `tbl_users` (`id`, `user_name`, `email`, `password`, `user_role_id`, `user_status`, `contact_id`, `code`, `status`,`entity_id`, `createdBy`, `createdDateTime`, `Last_UpdatedBy`, `Last_UpdatedDateTime`) VALUES
(1, 'root', 'sunil.pvs@pvs-consultancy.com', '$2y$10$K8erDeTeJj7XMuE3uQtt8O8I5exRsH7y.bcGxs.QrT6ZhzhwpSU1G', 1, 1, 1, 0, 'verified', 1, 1, '2023-06-21 13:44:33', NULL, NULL);
################################################################################################
# SECURITY RELATED TABLES CREATION : END
################################################################################################
-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;