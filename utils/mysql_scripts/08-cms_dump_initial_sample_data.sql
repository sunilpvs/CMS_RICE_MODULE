-- Dumping data for table `tbl_customer`
INSERT INTO `tbl_customer` (`id`, `customer_name`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `primary_contact`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'OLAM AGRI INDIA PVT LTD', 'SAI TOWERS, GROUND FLOOR', 'ROAD NO-1', 1, 1, 533003, 1, 1, 1, 1, 1, '2023-10-21 11:00:57', NULL, NULL),
(2, 'TRIDIENT SERVICES', 'F302', 'Add2', 1, 1, 535446, 1, 1, 1, 1, 1, '2024-04-19 16:56:10', NULL, NULL),
(3, 'OLAM HYDRO SERVICES', 'HYD', 'DHY', 6, 1, 535446, 1, 1, 1, 1, 1, '2024-04-19 17:09:05', NULL, NULL),
(4, 'MICROS ERVICES', 'F203', 'GYJD', 1, 1, 535448, 1, 1, 1, 1, 1, '2024-04-19 17:11:48', NULL, NULL),
(5, 'BEBO', 'BEBO-KKD', 'KD', 1, 1, 535447, 1, 1, 1, 1, 1, '2024-04-20 12:51:12', NULL, NULL);
-- Dumping data for table `tbl_lessor`
INSERT INTO `tbl_lessor` (`id`, `lessor_name`, `ltype`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `primary_contact`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'SATHVIK LOGISTICS', 2, 'NEAR MARINE POLICE STATION', 'PORT ADREA', 1, 1, 533005, 1, 1, 1, 1, 1, '2023-08-08 17:55:22', NULL, NULL),
(2, 'MMTC', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-08-14 09:51:09', NULL, NULL),
(3, 'MMTC1', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:45:58', 1, '2024-07-16'),
(4, 'MMTC2', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:46:58', 1, '2024-07-16'),
(5, 'TRANSITSHED-H', 1, 'ANCHORAGE PORT', 'NEAR ANCOHRAGE PORT MAIN ENTARANCE', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:51:31', 1, '2024-07-16'),
(6, 'SUNDARAMA ENTERPRISES', 2, 'D-NO:', 'BESIDE RUCHI INDUSTRIES,DUMMULAPETA', 1, 1, 533005, 1, 1, 1, 1, 3, '2023-09-01 12:55:51', NULL, NULL),
(7, 'MMTC3', 1, 'Add1', '2', 1, 1, 533046, 1, 1, 1, 1, 1, '2024-07-16 21:33:33', NULL, NULL);
-- Dumping data for table `tbl_miller`
INSERT INTO `tbl_miller` (`id`, `miller_name`, `gst_num`, `place`, `add1`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'SAMEERA AGRO INDUSTRIES', '37ACQFS0082C1Z3', 'RAJANAGARAM', 'NARENDRAPURAM', 1, 1, 3, '2023-10-16 12:18:44', NULL, NULL),
(2, 'PADMASRI RICE MILL', '37AALFP0579Q1ZC', 'DUPPAPUDI', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:23:54', NULL, NULL),
(3, 'SURYASRI RICE MILL', '37AAYFS8716M1Z1', 'KOPPAVARAM', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:25:17', NULL, NULL),
(4, 'SRI AYYAPPA RICE INDUSTRIES', '37ABIFS4435L1ZP', 'POLAMURU', 'ANAPARTHI', 1, 1, 3, '2023-10-16 12:26:34', NULL, NULL),
(5, 'RAJU RANI', '37ACQFS0082C1Z3', 'KAKINADA', 'KAKINADA', 1, 1, 3, '2023-11-11 12:40:45', NULL, NULL),
(6, 'MKR', '37AAYFS8716M1Z1', 'KAKINADA', 'KAKINADA', 1, 1, 3, '2023-11-11 12:41:43', NULL, NULL);
-- Dumping data for table `tbl_commodity`
INSERT INTO `tbl_commodity` (`id`, `commodity`, `commodity_name`, `cargo_type`, `brand`, `marking`, `empty_bag_wt`, `bag_wt`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
(1, 'Bulk-SORTEX BOILED RICE-LIZA GREEN-50KG', 'SORTEX BOILED RICE', 1, 'LIZA GREEN', '50KG', 0.16, 50, 1, 1, 1, '2023-10-16 12:28:44', NULL, NULL),
(2, 'Bulk- SORTEX BOILED RICE-LIZA GREEN-26KG', ' SORTEX BOILED RICE', 1, 'LIZA GREEN', '26KG', 0.16, 26, 1, 1, 1, '2024-03-30 19:22:19', 1, '2024-03-30 14:53:44');

-- Dumping data for table `tbl_warehouse`
INSERT INTO `tbl_warehouse` (`prefix`, `id`, `warehouse_name`, `code`, `lessor_id`, `add1`, `add2`, `city`, `state`, `pin`, `country`, `capacity_sqft`, `capacity_mton`, `used_sqft`, `used_mton`, `avl_sqft`, `avl_mton`, `primary_contact`, `inward_contractid`, `inward_leasetype`, `inward_start`, `inward_expiry`, `status`, `entity_id`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-WH-', 0001, 'SATHVIK WAREHOUSE', 'SAT-2', 1, 'NEAR MARINE POLICE S', 'PORT ADREA', 1, 1, 533005, 1, 64000, 16000, 0, 0, 64000, 16000, 1, 'SCBC-INW23-0008', 1, '2024-08-27', '2024-08-28', 1, 1, 1, '2023-08-08 18:01:25', 1, '2023-09-02 22:04:59'),
('SCBC-WH-', 0002, 'MMTC', 'G-02', 1, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 60000, 15000, 60000, 15000, 0, 0, 1, '', 0, NULL, NULL, 1, 1, 3, '2023-08-16 13:46:57', 1, '2023-09-02 21:36:12'),
('SCBC-WH-', 0003, 'TRANSITSHED-H', 'GOV-1', 5, 'OPPOSITE 3F TERMINAL', 'ANCHORAGE PORT', 1, 1, 533005, 1, 17190, 4297, 17190, 4298, 0, 0, 1, '', 0, NULL, NULL, 1, 1, 1, '2023-10-16 12:40:46', NULL, NULL),
('SCBC-WH-', 0004, 'MMTC2- WH1', 'WH2', 4, 'Add2', 'add2', 1, 1, 533046, 1, 12000, 3000, 0, 0, 12000, 3000, 1, '', 0, NULL, NULL, 1, 1, 1, '2024-07-16 21:34:47', NULL, NULL);

-- Dumping data for table `tbl_compartment`
INSERT INTO `tbl_compartment` (`prefix`, `id`, `compartment_id`, `compartment_name`, `outwardlease_id`, `warehouse_id`, `capacity_sqft`, `capacity_mton`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-COMP-', 00001, 'SCBC-COMP-00001', 'H-1', 2, 0003, 5500, 1375, 1, 3, 3, '2023-10-21 11:06:02', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00002, 'SCBC-COMP-00002', 'C2-24', 2, 0003, 5000, 1250, 1, 3, 1, '2024-03-30 19:19:48', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00003, 'SCBC-COMP-00003', 'OLAM - C1', 11, 0003, 2000, 500, 1, 1, 1, '2024-04-20 22:49:30', 0, '0000-00-00 00:00:00'),
('SCBC-COMP-', 00004, 'SCBC-COMP-00004', 'MS-TH1', 12, 0003, 5000, 1250, 1, 1, 1, '2024-05-22 19:53:09', 0, '0000-00-00 00:00:00');
-- --------------------------------------------------------

-- Dumping data for table `tbl_inwardlease`
INSERT INTO `tbl_inwardlease` (`prefix`, `id`, `contract_id`, `warehouse_id`, `lease_type`, `start_date`, `expiry_date`, `entity_id`, `status`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-INW24-', 0001, 'SCBC-INW24-0001', 0001, 1, '2023-07-01', '2023-12-31', 1, 6, 1, '2023-09-05 09:55:16', NULL, NULL),
('SCBC-INW24-', 0002, 'SCBC-INW24-0002', 0002, 1, '2023-04-26', '2025-05-25', 1, 5, 3, '2023-10-16 12:42:33', NULL, NULL),
('SCBC-INW24-', 0003, 'SCBC-INW24-0003', 0003, 1, '2024-04-02', '2024-07-31', 1, 6, 1, '2024-04-02 17:16:05', NULL, NULL),
('SCBC-INW24-', 0004, 'SCBC-INW24-0004', 0004, 1, '2024-08-27', '2024-12-28', 1, 5, 1, '2024-08-27 08:25:18', NULL, NULL);

-- Dumping data for table `tbl_lease_dates`
INSERT INTO `tbl_inwarddates` (`id`, `lease_type`, `start_date`, `end_date`, `lease_ref`) VALUES
(1, 1, '2023-07-01', '2023-12-31', 1),
(2, 1, '2023-04-26', '2025-05-25', 2),
(3, 1, '2024-04-02', '2024-07-31', 3),
(4, 1, '2024-08-27', '2024-12-28', 4);

-- Dumping data for table `tbl_outwardlease`
INSERT INTO `tbl_outwardlease` (`prefix`, `id`, `contract_id`, `warehouse_id`, `customer_id`, `lease_contract_id`, `lease_model`, `lease_start`, `lease_end`, `lease_days`, `before_capacity_sqft`, `lease_capacity_sqft`, `after_capacity_sqft`, `before_capacity_mton`, `lease_capacity_mton`, `after_capacity_mton`, `daily_rate_sqft`, `daily_rate_mton`, `cost_sqft`, `cost_mton`, `total_cost`, `lease_status`, `release_capacity`, `entity_id`, `created_by`, `created_datetime`, `last_updated`, `last_updateddatetime`) VALUES
('SCBC-OUT24-', 0001, '', 0001, 1, 'SCBC-OUT24-0001', 1, '2023-10-05', '2023-11-04', 30, 17190, 17190, 0, 4297, 4297, 0, 0.25, 0, 128925, 0, 128925, 6, 1, 1, 3, '2023-10-21 11:01:46', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0002, '', 0002, 4, 'SCBC-OUT24-0002', 1, '2024-04-20', '2024-05-04', 14, 60000, 60000, 0, 15000, 15000, 0, 0.75, NULL, 630000, NULL, 630000, 5, 0, 1, 1, '2024-04-20 21:46:40', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0003, '', 0003, 1, 'SCBC-OUT24-0003', 1, '2024-04-20', '2024-04-30', 10, 17190, 7190, 10000, 4297, 1797.5, 2500, 1.25, NULL, 89875, NULL, 89875, 5, 0, 1, 1, '2024-04-20 21:49:19', 0, '0000-00-00 00:00:00'),
('SCBC-OUT24-', 0004, '', 0004, 4, 'SCBC-OUT24-0004', 1, '2024-04-20', '2024-04-30', 10, 10000, 10000, 0, 2500, 2500, 0, 1.5, NULL, 150000, NULL, 150000, 5 , 0, 1, 1, '2024-04-20 21:49:47', 0, '0000-00-00 00:00:00');

-- Dumping data for table `tbl_lease_dates`
INSERT INTO `tbl_outwarddates` (`id`, `lease_type`, `start_date`, `end_date`, `lease_ref`) VALUES
(1, 1, '2023-10-05', '2023-11-04', 1),
(2, 1, '2024-04-20', '2024-05-04', 2),
(3, 1, '2024-04-20', '2024-04-30', 3),
(4, 1, '2024-04-20', '2024-04-30', 4);

