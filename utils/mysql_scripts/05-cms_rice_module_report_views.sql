################################################################################################
# SQL SCRIPT FOR CMS - RICE MODULE - REPORT VIEW CREATIONS
################################################################################################
#View for Inward leases Report
    CREATE OR REPLACE VIEW `rpt_vwinward_leases` AS
		SELECT a.id, contract_id, b.warehouse_name,c.ltype, date_format(a.start_date,'%d-%b-%Y') as start_date, 
			date_format(a.expiry_date,'%d-%b-%Y') as expiry_date, d.status
		FROM tbl_inwardlease a, tbl_warehouse b, tbl_leasetype c, tbl_status d
			WHERE a.warehouse_id = b.id AND c.id = a.lease_type AND a.status = d.id
			ORDER BY a.id;
         
#View for Outward leases Report
    CREATE OR REPLACE VIEW `rpt_vwoutward_leases` AS
		SELECT a.id,a.lease_contract_id,b.customer_name,c.warehouse_name,d.lease_model,
			date_format(a.lease_start,'%d-%b-%Y') as lease_start, date_format(a.lease_end,'%d-%b-%Y') as lease_end, 
			a.lease_capacity_sqft,a.lease_capacity_mton,a.daily_rate_sqft, a.daily_rate_mton,a.total_cost, e.status
		FROM tbl_outwardlease a, tbl_customer b, tbl_warehouse c, tbl_lease_model d, tbl_status e
		WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.lease_model = d.id AND a.lease_status = e.id;

#View for Inward Stock Report Based on Customer, Warehouse, Compartment, Miller, Commodity, Transport              
	CREATE OR REPLACE VIEW `rpt_vwinward_stock` AS
		SELECT b.id as customer_id, b.customer_name, c.id as warehouse_id, c.warehouse_name, d.id as comp_id, d.compartment_name, e.id as commodity_id, e.commodity, 
				f.id as transport_id, f.transport_mode as source_transport, g.id as miller_id, g.miller_name,   
                date_format(a.received_date ,'%d-%b-%Y') as transaction_date, a.inward_bags_stock,a.current_bags_stock, a.outward_bags_stock 
		FROM tbl_inwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f, tbl_miller g
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id AND a.miller_id = g.id
				ORDER BY customer_name,warehouse_name,compartment_name,commodity,source_transport;               

#View for Outward Stock Report Based on Customer, Warehouse, Compartment, Miller, Commodity, Transport
	CREATE OR REPLACE VIEW `rpt_vwoutward_stock` AS
		SELECT b.id as customer_id, b.customer_name, c.id as warehouse_id, c.warehouse_name, d.id as comp_id, d.compartment_name, e.id as commodity_id, e.commodity, 
				f.id as transport_id, f.transport_mode as source_transport, g.id as delivery_id, g.name as delivery, a.bags_out, a.gross_wt, a.net_wt,
                date_format(a.dc_date ,'%d-%b-%Y') as transaction_date 
		FROM tbl_outwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f, tbl_delivery_details g
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.inward_transport = f.id AND a.delivery_dtl = g.id
				ORDER BY customer_name,warehouse_name,compartment_name,commodity,source_transport;

#View for Current Stock Report
CREATE OR REPLACE VIEW `vw_rpt_currentstock` AS
	SELECT b.customer_name, c.warehouse_name, d.compartment_name, e.commodity, f.transport_mode , a.bags_stock, a.gross_wt, a.net_wt 
		FROM tbl_commodity_stock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f
			WHERE a.customer_id = b.id  AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id
				ORDER BY b.customer_name, c.warehouse_name, d.compartment_name, e.commodity, f.transport_mode;