# REPORTS 

#View for Inward Stock Report Based on Customer, Warehouse, Compartment, Miller, Commodity, Transport
	CREATE OR REPLACE VIEW `rpt_vwinward_stock` AS
		SELECT h.id as cust_id, h.customer_name, d.id as warehouse_id, d.warehouse_name, f.id as comp_id, f.compartment_name, b.id as miller_id, b.miller_name, c.id as commodity_id, c.commodity,
				e.id as transport_id, e.transport_mode as source_transport,date_format(g.lease_end,'%d-%b-%Y') lease_expiry, 			
				sum(a.inward_bags_stock) as inward_bags_count, sum(a.current_bags_stock) as current_bags_stock, sum(a.outward_bags_stock) as outward_bags_count
		FROM tbl_inwardstock a, tbl_miller b, vw_commodities c, tbl_warehouse d, tbl_transport_mode e, tbl_compartment f,tbl_outwardlease g, tbl_customer h
		WHERE a.miller_id = b.id AND a.commodity_id = c.id AND a.compartment_id = f.id AND f.warehouse_id = d .id AND a.mod_transport = e.id
			AND g.id = f.outwardlease_id AND h.id = g.customer_id
			GROUP BY h.customer_name, d.warehouse_name, f.compartment_name, b.miller_name, c.commodity,e.transport_mode;

	SELECT * FROM rpt_vwinward_stock
		WHERE cust_id = 1 
			AND warehouse_id = 3
			AND comp_id = 1
    
    SELECT * FROM rpt_vwinward_stock  WHERE cust_id = 1  AND warehouse_id = 0003  AND comp_id = 00001 
            AND miller_id = 1
            AND commodity_id = 1
            AND transport_id = 1

SELECT * FROM rpt_vwinward_stock  WHERE cust_id = 1  AND warehouse_id = 0003  AND comp_id = 00002  AND date_format(lease_expiry,'%d-%m-%Y') = 19-05-2024

            

		#AND date_format(g.lease_end,'%d-%b-%Y') >= date_format(current_date,'%d-%b-%Y')                 
		SELECT * FROM rpt_vwinward_stock;
        SELECT * FROM tbl_outwardlease 
        SELECT * FROM tbl_compartment
        SELECT * FROM tbl_warehouse
        SELECT * FROM tbl_customer
        
        SELECT DISTINCT d.id, d.compartment_name
			FROM tbl_warehouse a, tbl_outwardlease b, tbl_customer c, tbl_compartment d
			WHERE a.id = b.warehouse_id AND c.id = b.customer_id AND a.id = d.warehouse_id AND b.id = d.outwardlease_id
            AND c.id = 1 AND a.id = 3
            
            
            
        
        SELECT a.id, a.compartment_name, a.warehouse_id, b.customer_id FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d
        WHERE a.outwardlease_id = b.id AND a.warehouse_id = c.id AND b.customer_id = d.id AND b.warehouse_id = c.id 
        
        
        
#View for Inward leases Report    
    CREATE OR REPLACE VIEW `rpt_vwinward_leases` AS
	SELECT a.id, contract_id, b.warehouse_name,c.ltype, date_format(a.start_date,'%d-%b-%Y') as start_date, 
			date_format(a.expiry_date,'%d-%b-%Y') as expiry_date, d.status
	FROM tbl_inwardlease a, tbl_warehouse b, tbl_leasetype c, tbl_mod_status d
	WHERE a.warehouse_id = b.id AND c.id = a.lease_type AND a.status = d.id
	ORDER BY a.id;

#View for Outward leases Report
    CREATE OR REPLACE VIEW `rpt_vwoutward_leases` AS
		SELECT a.id,a.lease_contract_id,b.customer_name,c.warehouse_name,d.lease_model,
			date_format(a.lease_start,'%d-%b-%Y') as lease_start, date_format(a.lease_end,'%d-%b-%Y') as lease_end, 
			a.lease_capacity_sqft,a.lease_capacity_mton,a.daily_rate_sqft, a.daily_rate_mton,a.total_cost, f.compartment_name, e.status
		FROM tbl_outwardlease a, tbl_customer b, tbl_warehouse c, tbl_lease_model d, tbl_mod_status e, tbl_compartment f
		WHERE a.customer_id = b.id AND a.warehouse_id = c.id AND a.lease_model = d.id AND a.lease_status = e.code AND e.module = 'Lease'
              AND f.outwardlease_id = a.id AND f.warehouse_id = c.id

             
select * from tbl_outwardlease
select * from tbl_compartment
select * from tbl_customer
select * from tbl_inwardstock

select * from tbl_commodity_stock



select * from tbl_mod_status


CREATE OR REPLACE VIEW `vw_rpt_currentstock` AS
	SELECT d.warehouse_name, b.compartment_id, b.compartment_name, c.commodity, a.bags, a.net_wt 
	FROM tbl_commodity_stock a, tbl_compartment b, tbl_commodity c, tbl_warehouse d
	WHERE a.comp_id = b.id  AND a.comm_id = c.id AND b.warehouse_id = d.id;
    



      
    select * from tbl_inwardlease 
    where expiry_date < now();
    select * from tbl_mod_status
    
    update tbl_inwardlease set contract_id = 'SCBC-INW23-0001' where id = 0001