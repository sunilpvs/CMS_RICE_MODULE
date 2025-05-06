-- This Stored procedure is for updating Commodity Stock table by re-validating the entire stock from Inward_Stock and Outward_Stock tables.
-- How it works:
-- Based on customer, warehouse, commodity, compartment and trasport_mode, it will try to fetch total bags count, gross_wt and net_wt from tbl_inwardstock, tbl_outwardstock into two cursors.
-- It will check if entry in tbl_opening_stock for the stock_date is available.
-- If available it will update the existing opening stock with Cursor output.
-- Else it will check if cursor returns rows or blank
-- if cursor returns rows it will insert cursor values into table else it will insert 0 for bags,gross_wt,net_wt.
DROP PROCEDURE IF EXISTS `sp_updateCommodityStock`;
DELIMITER //
CREATE PROCEDURE `sp_updateCommodityStock` (cust_id int(11), w_id int(11), comm_id int(11), comp_id int(11), trans_id int(11))
BEGIN
	DECLARE done INT DEFAULT 0;
    DECLARE in_bags INT DEFAULT 0;
    DECLARE out_bags INT DEFAULT 0;
    DECLARE bags INT DEFAULT 0;
    DECLARE in_gross FLOAT DEFAULT 0;
    DECLARE in_net FLOAT DEFAULT 0;
    DECLARE gross FLOAT DEFAULT 0;
    DECLARE net FLOAT DEFAULT 0;
    DECLARE out_gross FLOAT DEFAULT 0;
    DECLARE out_net FLOAT DEFAULT 0;
	DECLARE in_cur CURSOR FOR 
			SELECT round(sum(bags_stock),3) as bags, round(sum(wb_gross_wt),3) as gross_wt, round(sum(wb_net_wt),3) as net_wt 
				FROM tbl_inwardstock WHERE customer_id = cust_id AND warehouse_id = w_id AND commodity_id = comm_id AND compartment_id = comp_id AND mod_transport = trans_id;
	DECLARE out_cur CURSOR FOR 
			SELECT round(sum(bags_stock),3) as bags, round(sum(wb_gross_wt),3) as gross_wt, round(sum(wb_net_wt),3) as net_wt 
				FROM tbl_outwardstock WHERE customer_id = cust_id AND warehouse_id = w_id AND commodity_id = comm_id AND compartment_id = comp_id AND mod_transport = trans_id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
		OPEN in_cur;	
			label:LOOP
			FETCH in_cur INTO in_bags, in_gross, in_net;
			IF done = 1 THEN LEAVE label;
			END IF;
		END LOOP label;
        CLOSE in_cur;

		OPEN out_cur;    
			label1:LOOP
			FETCH out_cur INTO out_bags, out_gross, out_net;
			IF done = 1 THEN LEAVE label1;
			END IF;
		END LOOP label1;
        CLOSE out_cur;

		SET bags = in_bags-out_bags;
		SET gross = in_gross - out_gross;
		SET net = in_net - out_net;
    
		UPDATE tbl_commodity_stock SET bags_stock = bags, gross_wt = gross, net_wt = net 
			WHERE customer_id = cust_id AND warehouse_id = w_id AND commodity_id = comm_id AND compartment_id = comp_id AND mod_transport = trans_id;  
END //
DELIMITER ;