################################################################################################
# SQL FOR ALL VIEWS CREATION OR REPLACE

# GENERIC VIEWS
################################################################################################
###VIEWS USED FOR GENERIC COMBO LOADINGS

#AVAILABLE ACCERSS REQUESTS VIEW
	CREATE OR REPLACE VIEW `vw_acces_request` AS 
		SELECT * FROM tbl_reqaccess	
			WHERE status = 'Requested' ORDER BY id;

#AVAILABLE STATUS VIEW
	CREATE OR REPLACE VIEW `vw_status` AS 
		SELECT id,concat(code,' - ',status) as status, module  
			FROM tbl_status ORDER BY id;

# COUNTRY LIST 
	CREATE OR REPLACE VIEW `vw_country` AS
		SELECT id, country, code, currency FROM tbl_country ORDER BY id;
        
# STATE LIST VIEW
	CREATE OR REPLACE VIEW `vw_state` AS
		SELECT id, state, country FROM tbl_state ORDER BY id;

# CITY LIST VIEW
	CREATE OR REPLACE VIEW `vw_city` AS
		SELECT id, city, state, country FROM tbl_city ORDER BY city;
    
# CONTACT TYPE LIST
	CREATE OR REPLACE VIEW `vw_ctype` AS 
		SELECT ID as id,Name as ctype 
			FROM tbl_contacttype 
			WHERE status = 1;
            
#DEPARTMENT LIST VIEW (COMBO LIST)
	CREATE OR REPLACE VIEW `vw_deptlist` AS 
		SELECT id, concat(code,' - ',name) as dept
			FROM tbl_department 
			WHERE status = 1 ORDER BY id;

#DESIGNATION LIST VIEW (COMBO LIST)
	CREATE OR REPLACE VIEW `vw_desiglist` AS 
		SELECT id,concat(code,' - ',name) as desig 
			FROM tbl_designation 
			WHERE status = 1 ORDER BY id;
            
# CONTACT LIST COMBO
	CREATE OR REPLACE VIEW `vw_contact` AS 
		SELECT id, concat(f_name,' ',l_name) as contact, contacttype_id as ctype 
			FROM tbl_contact 
				ORDER BY id;

#Contact Page: Contact View
	CREATE OR REPLACE VIEW `vw_contact_list` AS 
		SELECT a.id,a.f_name,a.l_name,DATE_FORMAT(a.dob,'%d-%b-%Y') as dob,a.email,a.personal_email,a.mobile,c.state,b.Name as contacttype 
			FROM tbl_contact a, tbl_contacttype b, tbl_state c 
			WHERE a.contacttype_id = b.id AND a.state = c.id  AND a.id != 1 ORDER BY a.id;
################################################################################################
# PROFILE --> Activity Log
################################################################################################
# Profile --> Activity Log
	CREATE OR REPLACE VIEW `vw_activitylog` AS
	SELECT id, datetime,activity,log,action_user_id AS user_id 
		FROM tbl_transaction_log 
    ORDER BY datetime;
################################################################################################    
#User page: Add User, Contact List Combo (Select contact to Create user:)
	CREATE OR REPLACE VIEW `vw_user_create_list` AS 
		SELECT a.id, a.f_name, a.l_name, a.email, a.mobile, b.Name as ctype 
			FROM tbl_contact a, tbl_contacttype b 
			WHERE a.contacttype_id = b.id AND b.id = 2 AND a.id NOT IN (SELECT contact_id FROM tbl_users)  ORDER BY a.id;

#View for Validating OTP Code and Validating Password Reset OTP Code/Validating Email
	CREATE OR REPLACE VIEW `vw_user_validation` AS 
		SELECT id,user_name,email,code FROM tbl_users;

#USER ROLES EXCLUDING SURE USER ROLE
	CREATE OR REPLACE VIEW `vw_user_roles` AS 
		SELECT * FROM tbl_user_role WHERE id != 1 ORDER BY id;

# GET USER ROLE BY USER ID
	CREATE OR REPLACE VIEW `vw_userrole` AS 
    SELECT a.id, b.user_role 
    FROM tbl_users a, tbl_user_role b WHERE a.user_role_id = b.id;
    
#Validate Login
	CREATE OR REPLACE VIEW `vw_validatelogin` AS 
    SELECT a.id, a.user_name, a.password, a.code, a.status, b.f_name , b.l_name, a.email, b.mobile, c.Name as ctype,a.user_role_id, d.user_role, a.entity_id 
	FROM tbl_users a, tbl_contact b, tbl_contacttype c, tbl_user_role d 
	WHERE a.contact_Id = b.Id AND b.contacttype_Id = c.id AND a.user_role_id = d.id AND a.user_status = 1;
    
#Create/Edit Users Page Views
# View for Users List in Create/Edit User default
	CREATE OR REPLACE VIEW `vw_userlist` AS 
		SELECT a.id, a.user_name, concat(c.f_name,' ' ,c.l_name) as name, c.email, c.mobile, d.name as contacttype,e.status as user_status,b.user_role
			FROM tbl_users a, tbl_user_role b, tbl_contact c, tbl_contacttype d, tbl_status e
			WHERE a.user_role_id = b.id AND a.contact_id = c.id AND c.contacttype_id = d.id AND a.user_status = e.id
			AND a.id <>1;

###Employee View
	CREATE OR REPLACE VIEW `vw_employeelist` AS 
	SELECT a.id, a.f_name, a.l_name, c.name as dept, d.name as designation, date_format(a.join_date,'%d-%b-%Y') as join_date, a.email, a.mobile, e.status, b.Name as ctype
	FROM tbl_contact a, tbl_contacttype b, tbl_department c, tbl_designation d, tbl_status e
	WHERE a.contacttype_id = b.ID AND b.id in (2,3) AND a.department = c.id AND a.designation = d.id AND a.emp_status = e.id
		ORDER BY a.id;
  
# Configursys_configations --> Entity Page
	CREATE OR REPLACE VIEW `vw_entity` AS
		SELECT a.id, a.entity_name, a.cin, date_format(a.incorp_date,'%d-%b-%Y') as incorp_date, c.city, d.state, e.status
			FROM tbl_entity a, tbl_costcenter b, tbl_city c, tbl_state d, tbl_status e
			WHERE b.entity_id = a.id AND b.city = c.id AND b.state = d.id AND a.status = e. id AND b.cc_type = 1
			ORDER BY a.id;

#Costcenter Page:
	CREATE OR REPLACE VIEW  `vw_costcenter_list` AS 
    SELECT a.id, b.entity_name , a.cc_code, f.cc_type, DATE_FORMAT(a.incorp_date,'%d-%b-%Y') as incorp_date, a.gst_no, d.city, e.state, c.f_name, c.l_name, g.status 
		FROM tbl_costcenter a, tbl_entity b, tbl_contact c, tbl_city d, tbl_state e, tbl_costcentertype f, tbl_status g
		WHERE a.entity_Id = b.id AND a.primary_Contact = c.id AND a.city = d.id AND a.state = e.id AND a.cc_type = f.id AND g.id = a.status
    ORDER BY cc_code;

# Configurations --> Vendor Page Main View
	CREATE OR REPLACE VIEW `vw_vendor` AS
		SELECT a.id, a.vendor_name, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, e.status
			FROM tbl_vendor a, tbl_city b, tbl_state c, tbl_contact d, tbl_status e
			WHERE a.city = b.id AND a.state = c.id AND a.primary_contact = d. id AND a.status = e.id
			ORDER BY a.id;

## Vendor View
	CREATE OR REPLACE VIEW `vw_vendorlist` AS
		SELECT a.id, a.vendor_name, a.state,(b.f_name||' '||b.l_name) as primary_contact, b.email, b.mobile, a.status 
			FROM tbl_vendor a, tbl_contact b 
			WHERE a.primary_contact = b.id ORDER BY a.id;

# Configurations --> Customer Page Main View
	CREATE OR REPLACE VIEW `vw_customer` AS
	SELECT a.id, a.customer_name, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, e.status
		FROM tbl_customer a, tbl_city b, tbl_state c, tbl_contact d,  tbl_status e
			WHERE a.city = b.id AND a.state = c.id AND a.primary_contact = d. id AND a.status = e.id
			ORDER BY a.id;

# Home --> profile Page Main View
CREATE OR REPLACE VIEW `vw_userprofile` AS 
	SELECT b.id, b.user_name, c.user_role, d.status as status, a.f_name, a.l_name, date_format(a.dob,'%d-%b-%Y') as dob, a.email, a.personal_email, a.mobile, a.add1, a.add2,
			date_format(a.join_date,'%d-%b-%Y') as join_date, date_format(a.exit_date,'%d-%b-%Y') as exit_date, 
			f.city, g.state, h.country, concat(i.code,' - ', i.name) as dept, concat(j.code,' - ', j.name) as desig 
		FROM tbl_contact a, tbl_users b, tbl_user_role c, tbl_status d, tbl_entity e, tbl_city f, tbl_state g, tbl_country h, tbl_department i, tbl_designation j
		WHERE a.id = b.contact_id AND c.id = b.user_role_id AND b.user_status = d.id AND b.entity_id = e.id
			AND a.city = f.id AND a.state = g.id AND a.country = h.id AND i.id = a.department AND a.designation = j.id;
