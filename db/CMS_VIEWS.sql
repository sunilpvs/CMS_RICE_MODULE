################################################################################################
# SQL FOR ALL VIEWS CREATION OR REPLACE
################################################################################################
# Stock Management
################################################################################################
#Inward Stock View List 
CREATE OR REPLACE VIEW  `vw_inwardstock` AS 
	SELECT a.id,a.received_date,a.invoice_no,a.invoice_date,b.miller_name,c.commodity,e.transport_mode as source_transport,d.warehouse_name, f.compartment_name,f.compartment_id,
			a.vehicle_no,a.inward_bags_stock,a.inward_gross_wt,a.inward_net_wt,a.inward_wb_gross_wt, a.inward_wb_net_wt,a.inward_diff_gross,a.inward_diff_net,a.current_bags_stock,a.remarks
	FROM tbl_inwardstock a, tbl_miller b, vw_commodities c, tbl_warehouse d, tbl_transport_mode e, tbl_compartment f 
	WHERE a.miller_id = b.id AND a.commodity_id = c.id AND a.compartment_id = f.id AND f.warehouse_id = d .id AND a.mod_transport = e.id;
    

CREATE OR REPLACE VIEW  `vw_inwardstock_combo` AS     
    SELECT a.id as comp_id,  concat(d.customer_name,' :: ',c.warehouse_name,' :: ',a.compartment_name) as godown 
	FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d
	WHERE a.outwardlease_id = b. id AND a.warehouse_id = c.id AND b.customer_id = d.id AND
		DATE_FORMAT(b.lease_end,'%Y-%m-%d') >= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d')
        ORDER BY comp_id;
 
 #Outward Stock View List 
CREATE OR REPLACE VIEW  `vw_outwardstock_list` AS 
	SELECT a.id, a.outward_date as transaction_date, b.commodity, d.warehouse_name, c.compartment_name,a.vehicle_no,a.bags_out,a.outward_net_wt,e.delivery_name
	FROM tbl_outwardstock a, tbl_commodity b, tbl_compartment c, tbl_warehouse d, tbl_delivery e
	WHERE a.commodity_id = b.id AND a.compartment_id = c.id AND c.warehouse_id = d.id AND e.id = a.delivery_dtl;
       
CREATE OR REPLACE VIEW  `vw_outwardstock_combo` AS     
    SELECT a.id as comp_id,  d.customer_name,c.warehouse_name,a.compartment_name,f.mod_transport,
         sum(e.inward_bags_stock) as inward_bags_count, sum(e.current_bags_stock) as current_bags_stock, sum(outward_bags_stock) as outward_bags_count
	FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d, tbl_inwardstock e, tbl_mod_transport f
	WHERE a.outwardlease_id = b.id AND a.warehouse_id = c.id AND b.customer_id = d.id AND  e.compartment_id = a.id AND e.mod_transport = f.id
		AND DATE_FORMAT(b.lease_end,'%Y-%m-%d') >= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d') AND e.current_bags_stock >0 
        ORDER BY comp_id;
     
#View to fetch Inward Stock based on Commodity and compartment select in Outward Stock Add entry.
CREATE OR REPLACE VIEW  `vw_inwardstock_dtable` AS 
	SELECT id, commodity_id, compartment_id, inward_bags_stock, current_bags_stock, outward_bags_stock 
		FROM tbl_inwardstock WHERE current_bags_stock >0 ORDER BY id ASC;
        
################################################################################################
# Lease Management
################################################################################################
# Compartments
CREATE OR REPLACE VIEW `vw_compartments` AS
	SELECT a.id, c.lease_contract_id as outward_lease, d.customer_name, b.warehouse_name, date_format(c.lease_end,'%d-%b-%Y') as lease_end,a.compartment_id, 
			a.compartment_name, a.capacity_sqft as comp_capacity_sqft, a.capacity_mton as comp_capacity_mton, a.status
	FROM tbl_compartment a, tbl_warehouse b, tbl_outwardlease c, tbl_customer d
	WHERE a.outwardlease_id = c.id AND a.warehouse_id = b.id AND c.warehouse_id = b.id AND c.customer_id = d.id;

# Outward Lease
#Outward Lease List
	CREATE OR REPLACE VIEW  `vw_outwardleases` AS 
		SELECT a.id, a.lease_contract_id, c.customer_name, b.warehouse_name as warehouse, a.lease_capacity_sqft, a.lease_capacity_mton, 
				d.lease_model, a.lease_start, a.lease_end, e.Status as lease_status
		FROM tbl_outwardlease a, tbl_warehouse b, tbl_customer c, tbl_lease_model d, tbl_status e, tbl_inwardlease f 
		WHERE a.warehouse_id = b.id AND a.customer_id = c.id AND a.lease_model = d.id AND a.lease_status = e.ID  
		AND b.id = f.warehouse_id ;
        
#Outward Lease Combo 
	CREATE OR REPLACE VIEW `vw_outwardlease_combo` AS
		SELECT a.id, a.lease_contract_id, c.customer_name, d.lease_model, a.lease_start, a.lease_end, a.lease_days, a.warehouse_id, b.warehouse_name, 
			a.lease_capacity_sqft, a.lease_capacity_mton, a.daily_rate_sqft, a.daily_rate_mton, a.cost_sqft, a.cost_mton, a.total_cost, a.lease_status
		FROM tbl_outwardlease a, tbl_warehouse b, tbl_customer c, tbl_lease_model d
		WHERE a.warehouse_id = b.id AND a.customer_id = c.id AND a.lease_model = d.id AND a.lease_status = 'A';

#Commodities List
	CREATE OR REPLACE VIEW `vw_commodities` AS 
		SELECT a.id, concat(b.name,'-',a.commodity_name,'-',a.brand,'-',a.marking) as commodity, a.commodity_name, b.name as cargo_type, a. brand, a.marking, a.empty_bag_wt, a.bag_wt, a.status
		FROM tbl_commodity a, tbl_cargo_types b
		WHERE a.cargo_type = b.id ORDER BY a.id;
        
# 	Inward Lease page:
	CREATE OR REPLACE VIEW `vw_inwardleases` AS 
	SELECT a.id,concat(a.prefix,a.id) as contract_id, b.warehouse_name,c.ltype, date_format(a.start_date,'%d-%b-%Y') as start_date, 
			date_format(a.expiry_date,'%d-%b-%Y') as expiry_date, d.status
	FROM tbl_inwardlease a, tbl_warehouse b, tbl_leasetype c, tbl_mod_status d
	WHERE a.warehouse_id = b.id AND c.id = a.lease_type AND a.status = d.id
	ORDER BY a.id;

# 	Warehouse Master page:
	CREATE OR REPLACE VIEW `vw_warehouse` AS 
		SELECT a.id, concat(a.prefix,a.id) as w_code, a.warehouse_name, a.code, b.lessor_name, c.ltype, a.capacity_sqft,a.capacity_mton,d.city, e.state, concat(g.f_name,' ', g.l_name) as contact, g.email, g. mobile, a.status
		FROM tbl_warehouse a, tbl_lessor b, tbl_lessortype c, tbl_city d, tbl_state e, tbl_country f, tbl_contact g
		WHERE a.lessor_id = b.id AND b.ltype = c.id AND a.city = d.id AND a.state = e.id AND a.country = f.id AND a.primary_contact = g.id 
		ORDER BY a.id;

#OutwardLease Page: Warehouse Combo Info 
	CREATE OR REPLACE VIEW  `vw_warehouse_leases` AS 
		SELECT a.id, a.warehouse_name, a.code, b.lessor_name, c.ltype, a.capacity_sqft,a.capacity_mton, h.contract_id, DATE_FORMAT(h.start_date,'%d-%b-%Y') as start_date, 
				DATE_FORMAT(h.expiry_date,'%d-%b-%Y') as expiry_date,a.avl_sqft,a.avl_mton,d.city, e.state, concat(g.f_name,' ', g.l_name) as contact, g.email, g. mobile, a.status
		FROM tbl_warehouse a, tbl_lessor b, tbl_lessortype c, tbl_city d, tbl_state e, tbl_country f, tbl_contact g, tbl_inwardlease h
		WHERE a.lessor_id = b.id AND b.ltype = c.id AND a.city = d.id AND a.state = e.id AND a.country = f.id AND a.primary_contact = g.id AND a.id = h.warehouse_id
		AND a.status = 'A' AND a.avl_sqft > 0 AND DATE_FORMAT(h.expiry_date,'%d-%b-%Y') >= DATE_FORMAT(CURRENT_DATE(),'%d-%b-%Y') 
        ORDER BY a.id;
	

#Lessor Master Dats --> Main Page View
CREATE OR REPLACE VIEW `vw_lessor` AS
	SELECT a.id, a.lessor_name, e.ltype, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, a.status
	FROM tbl_lessor a, tbl_city b, tbl_state c, tbl_contact d, tbl_lessortype e
	WHERE a.ltype = e.id AND a.city = b.id AND a.state = c.id AND a.primary_contact = d.id
	ORDER BY a.id;

################################################################################################
# Configurations --> Customer Page Main View
	CREATE OR REPLACE VIEW `vw_customer` AS
	SELECT a.id, a.customer_name, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, a.status
	FROM tbl_customer a, tbl_city b, tbl_state c, tbl_contact d
	WHERE a.city = b.id AND a.state = c.id AND a.primary_contact = d. id
	ORDER BY a.id;

# Configurations --> Vendor Page Main View
	CREATE OR REPLACE VIEW `vw_vendor` AS
	SELECT a.id, a.vendor_name, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, a.status
	FROM tbl_vendor a, tbl_city b, tbl_state c, tbl_contact d
	WHERE a.city = b.id AND a.state = c.id AND a.primary_contact = d. id
	ORDER BY a.id;

# Configursys_configations --> Entity Page
	CREATE OR REPLACE VIEW `vw_entity` AS
	SELECT a.id, a.entity_name, a.cin, date_format(a.incorp_date,'%d-%b-%Y') as incorp_date, b.city, c.state, a.status 
	FROM tbl_entity a, tbl_city b, tbl_state c
    WHERE a.city = b.id AND a.state = c.id
    ORDER BY a.id;

# Profile --> Activity Log
	CREATE OR REPLACE VIEW `vw_activitylog` AS
	SELECT datetime,activity,log,action_user_id AS id 
    FROM tbl_transaction_log 
    ORDER BY datetime;

#Create/Edit Users Page Views
# View for Users List in Create/Edit User default
	CREATE OR REPLACE VIEW `vw_userlist` AS 
    SELECT `b`.`id` AS `id`,`b`.`user_name` AS `user_name`,`a`.`f_name` AS `f_name`,`a`.`l_name` AS `l_name`,`a`.`email` AS `email`,`a`.`mobile` AS `mobile`,
			`c`.`Name` AS `ContactType`,`b`.`user_status` AS `user_status`,`d`.`user_role` AS `user_role` 
    FROM (((`tbl_contact` `a` join `tbl_users` `b`) join `tbl_contacttype` `c`) join `tbl_user_role` `d`) 
    WHERE ((`a`.`id` = `b`.`contact_id`) AND (`a`.`ContactType_Id` = `c`.`ID`) AND (`b`.`user_role_id` = `d`.`id`) AND (`b`.`id` <> 1));
    
#User page: Add User, Contact List Combo (Select contact to Create user:)
	CREATE OR REPLACE VIEW `vw_user_create_list` AS 
	SELECT a.id,a.f_name,a.l_name,a.email,a.mobile,b.Name as ctype 
	FROM tbl_contact a, tbl_contacttype b 
	WHERE a.ContactType_Id = b.ID AND b.id = 2 AND a.id NOT IN (SELECT contact_id FROM tbl_users)  ORDER BY a.id;
    
#View for Validating OTP Code and Validating Password Reset OTP Code/Validating Email
	CREATE OR REPLACE VIEW `vw_user_validation` AS 
		SELECT id,user_name,email,code FROM tbl_users;

#Contact Page: Contact View
	CREATE OR REPLACE VIEW `vw_contact_list` AS 
    SELECT a.id,a.f_name,a.l_name,DATE_FORMAT(a.dob,'%d-%b-%Y') as dob,a.email,a.mobile,c.state,b.Name as ContactType 
    FROM tbl_contact a, tbl_contacttype b, tbl_state c 
    WHERE a.contacttype_id = b.id AND a.state = c.id  AND b.id != 1 ORDER BY a.id;
    
#Validate Login
	CREATE OR REPLACE VIEW `vw_validateLogin` AS 
    SELECT a.id, a.user_name, a.password, a.code, a.status, b.f_name , b.l_name, a.email, b.mobile, c.Name as ctype,a.user_role_id, d.user_role 
	FROM tbl_users a, tbl_contact b, tbl_contacttype c, tbl_user_role d 
	WHERE a.contact_Id = b.Id AND b.contacttype_Id = c.Id AND a.user_role_id = d.id AND a.User_Status = 'A';

# GET USER ROLE BY USER ID
	CREATE OR REPLACE VIEW `vw_userrole` AS 
    SELECT a.id, b.user_role 
    FROM tbl_users a, tbl_user_role b WHERE a.user_role_id = b.id;

################################################################################################
#		Bulk Operations - 
#		Lease Management pages
################################################################################################
      


#Cargo Types List
	CREATE OR REPLACE VIEW `vw_cargo_types` AS 
    SELECT `tbl_cargo_types`.`id` AS `id`,`tbl_cargo_types`.`name` AS `name` 
    FROM `tbl_cargo_types` ORDER BY `tbl_cargo_types`.`id`;

#Costcenter Page:
	CREATE OR REPLACE VIEW  `vw_costcenter_list` AS 
    SELECT b.entity_name , a.cc_code, a.cc_type, DATE_FORMAT(a.incorp_date,'%d-%b-%Y') as incorp_date, a.gst_no, d.city, e.state, c.f_name, c.l_name, a.status 
    FROM tbl_costcenter a, tbl_entity b, tbl_contact c, tbl_city d, tbl_state e
    WHERE a.entity_Id = b.id AND a.primary_Contact = c.id AND a.city = d.id AND a.state = e.id
    ORDER BY cc_code;
    
## Vendor View
	CREATE OR REPLACE VIEW `vw_vendorlist` AS
	SELECT a.id, a.vendor_name, a.state,(b.f_name||' '||b.l_name) as primary_contact, b.email, b.mobile, a.status 
	FROM tbl_vendor a, tbl_contact b 
    WHERE a.primary_contact = b.id ORDER BY a.id;

###Employee View
	CREATE OR REPLACE VIEW `vw_employeelist` AS 
	SELECT a.id, a.f_name, a.l_name, c.name as dept, d.name as designation, date_format(a.join_date,'%d-%b-%Y') as join_date, a.email, a.mobile, a.emp_status,b.Name as ctype
	FROM tbl_contact a, tbl_contacttype b, tbl_department c, tbl_designation d
	WHERE a.ContactType_Id = b.ID AND b.id in (2,5) AND a.department = c.id AND a.designation = d.id ORDER BY a.id;
  
###COMBO LOADINGS
# COUNTRY LIST 
	CREATE OR REPLACE VIEW `vw_country` AS
		SELECT id, country FROM tbl_country ORDER BY id;

# STATE LIST VIEW
	CREATE OR REPLACE VIEW `vw_state` AS
		SELECT id, state FROM tbl_state WHERE COUNTRY = 1 ORDER BY id;
    
# CITY LIST VIEW
	CREATE OR REPLACE VIEW `vw_city` AS
		SELECT id, city FROM tbl_city WHERE COUNTRY = 1 ORDER BY name;
    
#USER ROLES EXCLUDING SURE USER ROLE
	CREATE OR REPLACE VIEW `vw_user_roles` AS 
    SELECT * FROM tbl_user_role WHERE id != 1 ORDER BY id;
    
#AVAILABLE STATUS VIEW
	CREATE OR REPLACE VIEW `vw_status` AS 
    SELECT * FROM tbl_status ORDER BY ID;

#AVAILABLE STATUS VIEW BASED ON MODULE
	CREATE OR REPLACE VIEW `vw_mod_status` AS 
	SELECT id,concat(code,' - ',status) as status, module 
	FROM tbl_mod_status ORDER BY id;

#DEPARTMENT LIST VIEW
	CREATE OR REPLACE VIEW `vw_deptlist` AS 
	SELECT id,name as dept 
    FROM tbl_department 
    WHERE status = 'A' ORDER BY id;

#DESIGNATION LIST VIEW
	CREATE OR REPLACE VIEW `vw_desiglist` AS 
		SELECT id,name as desig 
        FROM tbl_designation 
        WHERE status = 'A' ORDER BY id;

# CONTACT TYPE LIST
	CREATE OR REPLACE VIEW `vw_ctype` AS 
    SELECT ID as id,Name as ctype 
    FROM tbl_contacttype 
    WHERE Status ='A';
    
# CONTACT LIST
	CREATE OR REPLACE VIEW `vw_contact` AS 
    SELECT id, concat(f_name,' ',l_name) as contact, ContactType_Id as ctype 
    FROM tbl_contact 
    ORDER BY id;
    
# CONTACT LIST
	CREATE OR REPLACE VIEW `vw_warehouselist` AS 
   	SELECT id,concat(code,' - ',warehouse_name) as warehouse_name 
	FROM tbl_warehouse 
	WHERE status = 'A' AND id not in (SELECT warehouse_id FROM tbl_inwardlease WHERE expiry_date >= CURDATE())
	ORDER BY id;  
