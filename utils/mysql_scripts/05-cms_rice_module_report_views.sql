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
                date_format(a.trans_date ,'%d-%b-%Y') as transaction_date, a.bags_stock
		FROM tbl_inwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f, tbl_miller g
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id AND a.miller_id = g.id
				ORDER BY customer_name,warehouse_name,compartment_name,commodity,source_transport;               

#View for Outward Stock Report Based on Customer, Warehouse, Compartment, Miller, Commodity, Transport
	CREATE OR REPLACE VIEW `rpt_vwoutward_stock` AS
		SELECT b.id as customer_id, b.customer_name, c.id as warehouse_id, c.warehouse_name, d.id as comp_id, d.compartment_name, e.id as commodity_id, e.commodity, 
				f.id as transport_id, f.transport_mode as source_transport, g.id as delivery_id, g.name as delivery, a.bags_stock, a.gross_wt, a.net_wt,
                date_format(a.trans_date ,'%d-%b-%Y') as transaction_date 
		FROM tbl_outwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f, tbl_delivery_details g
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id AND a.delivery_to = g.id
				ORDER BY customer_name,warehouse_name,compartment_name,commodity,source_transport;

#View for Current Stock Report
CREATE OR REPLACE VIEW `vw_rpt_currentstock` AS
	SELECT b.id as customer_id, b.customer_name, c.id as warehouse_id, c.warehouse_name, d.id as compartment_id, d.compartment_name, 
			e.id as commodity_id, e.commodity, f.id as mod_transport, f.transport_mode , a.bags_stock, a.gross_wt, a.net_wt 
		FROM tbl_commodity_stock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f
			WHERE a.customer_id = b.id  AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id
				ORDER BY b.customer_name, c.warehouse_name, d.compartment_name, e.commodity, f.transport_mode;

#View for Daily Customer Stock Report Starts here

#View for Daily Customer Stock Report - Inward Summary except for Wagon
CREATE OR REPLACE VIEW `vw_rpt_daily_customer_open_stock` AS
	SELECT b.id as customer_id, b.customer_name, c.id as warehouse_id, c.warehouse_name, e.id as commodity_id,  e.commodity, a.trans_date as received_date, 
		#round(SUM(a.inward_bags_stock),3) as bags, round(SUM(a.inward_wb_gross_wt),3) as gross_wt, round((SUM(a.inward_wb_gross_wt)-(e.empty_bag_wt*SUM(a.inward_bags_stock))),3) as net_wt //Revised Below
        round(SUM(a.bags_stock),3) as bags, round(SUM(a.wb_gross_wt),3) as gross_wt, round(SUM(a.wb_net_wt),3) as net_wt
		FROM tbl_inwardstock a, tbl_customer b, tbl_warehouse c, tbl_commodity e, tbl_transport_mode f
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.commodity_id = e.id AND a.mod_transport = f.id
				GROUP BY b.id, b.customer_name, c.warehouse_name, e.commodity;

CREATE OR REPLACE VIEW `vw_rpt_daily_customer_inwardstock` AS
	SELECT b.id as customer_id, b.customer_name, e.id as commodity_id, e.commodity, f.transport_mode, a.trans_date as received_date, 
		#round(SUM(a.inward_bags_stock),3) as bags, round(SUM(a.inward_wb_gross_wt),3) as gross_wt, round((SUM(a.inward_wb_gross_wt)-(e.empty_bag_wt*SUM(a.inward_bags_stock))),3) as net_wt //Revised Below
        round(SUM(a.bags_stock),3) as bags, round(SUM(a.wb_gross_wt),3) as gross_wt, round(SUM(a.wb_net_wt),3) as net_wt
		FROM tbl_inwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id
				AND f.transport_mode != 'Wagon'
				GROUP BY b.id, b.customer_name, e.commodity, f.transport_mode, a.trans_date;
                
#View for Daily Customer Stock Report - Inward Summary only Wagon
CREATE OR REPLACE VIEW `vw_rpt_daily_customer_wagon_inwardstock` AS
	SELECT b.id as customer_id, b.customer_name, e.id as commodity_id, e.commodity, f.transport_mode, a.trans_date as received_date, 
		#round(SUM(a.inward_bags_stock),3) as bags, round(SUM(a.inward_wb_gross_wt),3) as gross_wt, round((SUM(a.inward_wb_gross_wt)-(e.empty_bag_wt*SUM(a.inward_bags_stock))),3) as net_wt / Revised below
		round(SUM(a.bags_stock),3) as bags, round(SUM(a.wb_gross_wt),3) as gross_wt, round(SUM(a.wb_net_wt),3) as net_wt
		FROM tbl_inwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.mod_transport = f.id
				AND f.transport_mode = 'Wagon'
				GROUP BY b.id, b.customer_name, e.commodity, f.transport_mode, a.trans_date; 

#View for Daily Customer Stock Report - Outward Summary
CREATE OR REPLACE VIEW `vw_rpt_daily_customer_outwardstock` AS 
	SELECT b.id as customer_id, b.customer_name, e.id as commodity_id, e.commodity, g.name as delivery, a.trans_date, 
		#round(SUM(a.bags_out),3) as bags, round(SUM(a.wb_gross_wt),3) as gross_wt, round((SUM(a.wb_gross_wt)-(e.empty_bag_wt*SUM(a.bags_out))),3) as net_wt //Revised below
        round(SUM(a.bags_stock),3) as bags, round(SUM(a.wb_gross_wt),3) as gross_wt, round(SUM(a.wb_net_wt),3) as net_wt
		FROM tbl_outwardstock a, tbl_customer b, tbl_warehouse c, tbl_compartment d, tbl_commodity e, tbl_transport_mode f, tbl_delivery_details g
			WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.compartment_id = d.id AND a.commodity_id = e.id AND a.delivery_to = g.id 
				GROUP BY b.id, b.customer_name, e.commodity, g.name , a.trans_date; 

#View for Daily Customer Stock Report Ends here