# Ware House Table with Auto-Generation of Code.
CREATE OR REPLACE TABLE `tbl_warehouse` (
  `prefix` varchar(8) NOT NULL DEFAULT 'SCBC-WH-',
  `id` int(4) unsigned ZEROFILL NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `lessor_id` int(11) NOT NULL,
  `add1` varchar(20) NOT NULL,
  `add2` varchar(20) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `capacity_sqft` int(11) NOT NULL,
  `capacity_mton` int(11) NOT NULL,
  `used_sqft` int(11) NOT NULL DEFAULT 0,
  `used_mton` int(11) NOT NULL DEFAULT 0,
  `avl_sqft` int(11) NOT NULL,
  `avl_mton` int(11) NOT NULL,
  `primary_contact` int(11) DEFAULT NULL,
  `status` varchar(3) NOT NULL,
  `inward_contractid` varchar(20) DEFAULT NULL,
  `inward_leasetype` int(11) DEFAULT NULL,
  `inward_start` date DEFAULT NULL,
  `inward_expiry` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`prefix`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

# Inward Lease
CREATE OR REPLACE TABLE `tbl_inwardlease` (
  `prefix` varchar(11) NOT NULL DEFAULT 'SCBC-INW23-',
  `id` int(4) unsigned ZEROFILL NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(15) NOT NULL,
  `warehouse_id` int(4) unsigned ZEROFILL NOT NULL,
  `lease_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) DEFAULT NULL,
  `last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`prefix`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

# Outward Lease
CREATE OR REPLACE TABLE `tbl_outwardlease` (
  `prefix` varchar(11) NOT NULL DEFAULT 'SCBC-OUT23-',
  `id` int(4) unsigned ZEROFILL NOT NULL AUTO_INCREMENT,
  `contract_id` varchar(15) NOT NULL,
  `warehouse_id` int(4) unsigned ZEROFILL NOT NULL,
  `customer_id` int(11) NOT NULL,
  `lease_contract_id` varchar(15) NOT NULL,
  `lease_model` int(11) NOT NULL,
  `lease_start` date NOT NULL,
  `lease_end` date NOT NULL,
  `lease_days` int(11) NOT NULL,
  `lease_capacity_sqft` float NOT NULL,
  `lease_capacity_mton` float NOT NULL,
  `daily_rate_sqft` float NOT NULL,
  `daily_rate_mton` float NOT NULL,
  `cost_sqft` float NOT NULL,
  `cost_mton` float NOT NULL,
  `total_cost` float NOT NULL,
  `lease_status` varchar(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`prefix`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

# Compartment Table
CREATE OR REPLACE TABLE `tbl_compartment` (
  `prefix` varchar(10) NOT NULL DEFAULT 'SCBC-COMP-',
  `id` int(5) unsigned ZEROFILL NOT NULL AUTO_INCREMENT,
  `compartment_id` varchar(14) NOT NULL,
  `warehouse_id` int(4) unsigned ZEROFILL NOT NULL,
  `capacity_sqft` float NOT NULL,
  `capacity_mton` float NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`prefix`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

# CommodityStockTable
CREATE OR REPLACE TABLE `tbl_commodity_stock` (
  `comp_id` int(5) NOT NULL ,
  `comm_id` int(5) NOT NULL ,
  `bags` int(11) NOT NULL ,
  `net_wt` int(11) NOT NULL ,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
  PRIMARY KEY (`comp_id`,`comm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

# Delivery Master table
CREATE OR REPLACE TABLE `tbl_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_name` varchar(50) NOT NULL,
  `particulars` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated` int(11) NOT NULL,
  `last_updateddatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;

#Outward Stock Table

CREATE OR REPLACE TABLE `tbl_outwardstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outward_date` date NOT NULL,
  `dc_no` varchar(50) NOT NULL,
  `dc_date` date NOT NULL,
  `commodity_id` int(50) NOT NULL,
  `comp_id` int(50) NOT NULL,
  `vehicle_no` varchar(30) NOT NULL,
  `bags_out` int(30) NOT NULL,
  `net_wtg` float NOT NULL,
  `wbridge_wtg` float NOT NULL,
  `wbridge_diff` float NOT NULL,
  `delivery_dtl` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `last_updated` int(11) DEFAULT NULL,
  `Last_updateddatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=1;
