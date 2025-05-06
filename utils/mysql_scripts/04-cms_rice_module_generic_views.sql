###############################################################################################
# SQL SCRIPT FOR CMS - RICE MODULE - GENERIC VIEW CREATIONS
################################################################################################

#View for Miller List
CREATE OR REPLACE VIEW `vw_millers` AS 
	SELECT a.id, a.miller_name, a.gst_num, a.place, a.add1, a.entity_id, b.status
		FROM tbl_miller a, tbl_status b
		WHERE a.status = b.id;

#Cargo Types List
	CREATE OR REPLACE VIEW `vw_cargo_types` AS 
		SELECT id , name
			FROM tbl_cargo_types ORDER BY id;
            
#Commodities List
	CREATE OR REPLACE VIEW `vw_commodities` AS 
		SELECT a.id, concat(b.name,'-',a.commodity_name,'-',a.brand,'-',a.marking) as commodity, a.commodity_name, b.name as cargo_type, a. brand, a.marking, a.empty_bag_wt, a.bag_wt, c.status
			FROM tbl_commodity a, tbl_cargo_types b, tbl_status c
				WHERE a.cargo_type = b.id AND a.status = c.id ORDER BY a.id;

#Lessor Master Dats --> Main Page View
	CREATE OR REPLACE VIEW `vw_lessor` AS
		SELECT a.id, a.lessor_name, e.ltype, b.city, c.state, concat(d.f_name,' ',d.l_name) as contact, d.email, d. mobile, f.status
			FROM tbl_lessor a, tbl_city b, tbl_state c, tbl_contact d, tbl_lessortype e, tbl_status f
				WHERE a.ltype = e.id AND a.city = b.id AND a.state = c.id AND a.primary_contact = d.id AND a.status = f.id
				ORDER BY a.id;

# 	Warehouse Master page:
	CREATE OR REPLACE VIEW `vw_warehouse` AS 
		SELECT a.id, concat('SCBC-WH',a.id) as w_code, a.warehouse_name, a.code, b.lessor_name, c.ltype, a.capacity_sqft,a.capacity_mton,d.city, e.state, concat(g.f_name,' ', g.l_name) as contact, 
			g.email, g. mobile, h.status
		FROM tbl_warehouse a, tbl_lessor b, tbl_lessortype c, tbl_city d, tbl_state e, tbl_country f, tbl_contact g, tbl_status h
		WHERE a.lessor_id = b.id AND b.ltype = c.id AND a.city = d.id AND a.state = e.id AND a.country = f.id AND a.primary_contact = g.id AND a.status = h.id
		ORDER BY a.id;
	
# Compartments
CREATE OR REPLACE VIEW `vw_compartments` AS
	SELECT a.id, c.lease_contract_id as outward_lease, d.customer_name, b.warehouse_name, date_format(c.lease_end,'%d-%b-%Y') as lease_end,a.compartment_id, 
			a.compartment_name, a.capacity_sqft as comp_capacity_sqft, a.capacity_mton as comp_capacity_mton, e.status
	FROM tbl_compartment a, tbl_warehouse b, tbl_outwardlease c, tbl_customer d, tbl_status e
	WHERE a.outwardlease_id = c.id AND a.warehouse_id = b.id AND c.warehouse_id = b.id AND c.customer_id = d.id AND a.status = e.id;

# 	Inward Lease page:
	CREATE OR REPLACE VIEW `vw_inwardleases` AS 
	SELECT a.id, a.contract_id, b.warehouse_name,c.ltype, date_format(e.start_date,'%d-%b-%Y') as start_date, 
			date_format(e.end_date,'%d-%b-%Y') as expiry_date, d.status
		FROM tbl_inwardlease a, tbl_warehouse b, tbl_leasetype c, tbl_status d, tbl_inwarddates e
			WHERE a.warehouse_id = b.id AND c.id = e.lease_type AND a.status = d.id AND e.lease_ref = a.id 
				AND e.id in (SELECT max(id) FROM tbl_inwarddates WHERE lease_ref = a.id)
		ORDER BY a.id;

# Outward Lease
#Outward Lease List
	CREATE OR REPLACE VIEW  `vw_outwardleases` AS 
		SELECT a.id, a.lease_contract_id, a.warehouse_id, c.warehouse_name, a.customer_id, d.customer_name, e.lease_model, 
				b.start_date as start_date , b.end_date as end_date,
				a.lease_capacity_sqft, a.lease_capacity_mton, f.status
			FROM tbl_outwardlease a, tbl_outwarddates b, tbl_warehouse c, tbl_customer d, tbl_lease_model e, tbl_status f
			WHERE b.lease_ref = a.id AND b.id in (SELECT max(id) FROM tbl_outwarddates WHERE lease_ref = a.id)
				AND a.warehouse_id = c.id AND a.customer_id = d.id AND a.lease_model = e.id AND a.lease_status = f.id;
############### COMBO FILLING
#Outward Lease Combo 
	CREATE OR REPLACE VIEW `vw_outwardlease_combo` AS
		SELECT a.id, a.lease_contract_id, c.customer_name, d.lease_model, a.lease_start, a.lease_end, a.lease_days, a.warehouse_id, b.warehouse_name, 
			a.lease_capacity_sqft, a.lease_capacity_mton, a.daily_rate_sqft, a.daily_rate_mton, a.cost_sqft, a.cost_mton, a.total_cost, a.lease_status
		FROM tbl_outwardlease a, tbl_warehouse b, tbl_customer c, tbl_lease_model d
		WHERE a.warehouse_id = b.id AND a.customer_id = c.id AND a.lease_model = d.id AND a.lease_status = 5;
        
#OutwardLease Page: Warehouse Combo Info 
	CREATE OR REPLACE VIEW  `vw_warehouse_leases` AS 
		SELECT a.id, a.warehouse_name, a.code, b.lessor_name, c.ltype, a.capacity_sqft,a.capacity_mton, h.contract_id, DATE_FORMAT(h.start_date,'%d-%b-%Y') as start_date, 
				DATE_FORMAT(h.expiry_date,'%d-%b-%Y') as expiry_date,a.avl_sqft,a.avl_mton,d.city, e.state, concat(g.f_name,' ', g.l_name) as contact, g.email, g. mobile, a.status
		FROM tbl_warehouse a, tbl_lessor b, tbl_lessortype c, tbl_city d, tbl_state e, tbl_country f, tbl_contact g, tbl_inwardlease h
		WHERE a.lessor_id = b.id AND b.ltype = c.id AND a.city = d.id AND a.state = e.id AND a.country = f.id AND a.primary_contact = g.id AND a.id = h.warehouse_id
		AND a.status = 1 AND a.avl_sqft > 0 AND DATE_FORMAT(h.expiry_date,'%d-%b-%Y') >= DATE_FORMAT(CURRENT_DATE(),'%d-%b-%Y') 
        ORDER BY a.id;
        
# Warehouse List 
	CREATE OR REPLACE VIEW `vw_warehouselist` AS 
   	SELECT id,concat(code,' - ',warehouse_name) as warehouse_name 
		FROM tbl_warehouse 
			WHERE status = 1 AND id not in (SELECT warehouse_id FROM tbl_inwardlease WHERE expiry_date >= CURDATE())
			ORDER BY id;  

 #Outward Stock View List 
CREATE OR REPLACE VIEW  `vw_outwardstock_list` AS 
	SELECT a.id, date_format(a.trans_date,'%d-%b-%Y') as transaction_date,b.customer_name,c.warehouse_name,d.compartment_name,f.commodity,e.transport_mode,a.vehicle_no, 
		a.bags_stock,g.name as delivery_name,b.id as customer_id,c.id as warehouse_id, d.id as compartment_id, e.id as transport_id, f.id as commodity_id, g.id as delivery_id
    FROM tbl_outwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_transport_mode e, tbl_commodity f, tbl_delivery_details g
    WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.mod_transport = e.id AND a.commodity_id = f.id
    AND a.delivery_to = g.id;

#Inward Stock View List 
CREATE OR REPLACE VIEW  `vw_inwardstock` AS 
	SELECT a.id, a.customer_id, a.warehouse_id, a.compartment_id, a.commodity_id, a.mod_transport, a.trans_date, a.invoice_no, a.invoice_date, b.miller_name, c.commodity,
			e.transport_mode as source_transport, d.warehouse_name, f.compartment_name, a.vehicle_no, a.bags_stock, a.wb_gross_wt, a.gross_wt, a.gross_diff,
            a.wb_net_wt, a.net_wt, a.net_diff, a.remarks
	FROM tbl_inwardstock a, tbl_miller b, vw_commodities c, tbl_warehouse d, tbl_transport_mode e, tbl_compartment f 
	WHERE a.miller_id = b.id AND a.commodity_id = c.id AND a.compartment_id = f.id AND f.warehouse_id = d .id AND a.mod_transport = e.id;

#Inward Stock ComboView List 
CREATE OR REPLACE VIEW  `vw_inwardstock_combo` AS     
    SELECT a.id as comp_id,  concat(d.customer_name,' :: ',c.warehouse_name,' :: ',a.compartment_name) as godown 
	FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d
	WHERE a.outwardlease_id = b. id AND a.warehouse_id = c.id AND b.customer_id = d.id AND
		DATE_FORMAT(b.lease_end,'%Y-%m-%d') >= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d')
        ORDER BY comp_id;

CREATE OR REPLACE VIEW  `vw_outwardstock_combo` AS     
    SELECT d.id as customer_id, c.id as warehouse_id, a.id as compartment_id, e.commodity_id, f.id as mod_transport,
			 f.transport_mode, d.customer_name, c.warehouse_name, a.compartment_name, 
         sum(e.bags_stock) as inward_bags_count 
	FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d, tbl_inwardstock e, tbl_transport_mode f
	WHERE a.outwardlease_id = b.id AND a.warehouse_id = c.id AND b.customer_id = d.id AND  e.compartment_id = a.id AND e.mod_transport = f.id
        GROUP BY d.id, c.id, a.id, e.commodity_id, f.id
        ORDER BY compartment_id;
