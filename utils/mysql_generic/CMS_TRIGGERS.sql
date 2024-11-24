##Warehouse table Triggers
CREATE TRIGGER insert_warehouse_capacity BEFORE INSERT ON tbl_warehouse 
FOR EACH ROW SET NEW.avl_sqft = NEW.capacity_sqft, NEW.avl_mton = (NEW.capacity_sqft/4) ;
##Warehouse table update SQFT Triggers
CREATE TRIGGER update_warehouse_capacity BEFORE UPDATE ON tbl_warehouse 
FOR EACH ROW SET NEW.avl_sqft = (NEW.capacity_sqft - NEW.used_sqft) , NEW.avl_mton = (NEW.capacity_mton - NEW.used_mton) ;

#Outward Lease table Triggers
CREATE TRIGGER  insert_outwardlease_days  BEFORE INSERT ON tbl_outwardlease 
FOR EACH ROW SET NEW.lease_days = DATEDIFF(NEW.lease_end, NEW.lease_start);

CREATE TRIGGER  update_outwardlease_days  BEFORE UPDATE ON tbl_outwardlease 
FOR EACH ROW SET NEW.lease_days = DATEDIFF(NEW.lease_end, NEW.lease_start);

##### tbl_inwardlease trigger (after)
DELIMITER $$
CREATE TRIGGER after_insert_inwardlease
AFTER INSERT ON `tbl_inwardlease` FOR EACH ROW
begin
	DECLARE contract VARCHAR(15);
	SET @contract := concat(NEW.prefix,NEW.id);  
    UPDATE tbl_warehouse SET inward_contractid = @contract,     inward_leasetype = NEW.lease_type, 
		inward_start = NEW.start_date, inward_expiry = NEW.expiry_date
	WHERE id = NEW.warehouse_id;
END;
$$
DELIMITER ;
