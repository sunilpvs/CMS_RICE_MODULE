DROP PROCEDURE IF EXISTS `sp_UpdateDailyOpenStock`;
DELIMITER //
-- This Stored procedure is for updating Opening Stock for Entries missing in tbl_opening_stock or update existing data
-- How it works:
-- Based on customer, commodity and stock_date required, it will try to fetch open stock for the customer + commodity less than given date into cursor.
-- It will check if entry in tbl_opening_stock for the stock_date is available.
-- If available it will update the existing opening stock with Cursor output.
-- Else it will check if cursor returns rows or blank
-- if cursor returns rows it will insert cursor values into table else it will insert 0 for bags,gross_wt,net_wt.
CREATE PROCEDURE `sp_UpdateDailyOpenStock` (cust_id int(11), comm_id int(11), stock_date date)
BEGIN
	DECLARE stk_cur CURSOR FOR SELECT * FROM tbl_opening_stock WHERE customer_id = cust_id AND commodity_id = comm_id AND received_date = stock_date;
	DECLARE cur1 CURSOR FOR SELECT * FROM vw_rpt_daily_customer_open_stock WHERE customer_id = cust_id AND commodity_id = comm_id AND received_date < stock_date;
    -- DECLARE done INT DEFAULT FALSE;
	DECLARE has_rows1 BOOLEAN DEFAULT FALSE;
    DECLARE has_rows2 BOOLEAN DEFAULT FALSE;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    SET hasr_rows1 = stk_cur.with_rows;
    SET hasr_rows2 = cur1.with_rows;
    OPEN stk_cur;
    OPEN cur1;
    IF has_rows1 THEN
		-- tbl_opening_stock table already have entries for this date.
        -- update tbl_opening_stk with cur1 values 
	ELSE
		print("Number of affected rows: {}".format(result.rowcount));
    
 
  OPEN cur1;
  read_loop: LOOP
    FETCH cur1 INTO out_id;
    IF done THEN
      LEAVE read_loop;
    END IF;
	UPDATE tbl_outwardlease SET lease_status = 6 WHERE id = out_id;
	UPDATE tbl_compartment SET status = 6 WHERE outwardlease_id = out_id;    
  END LOOP;
  CLOSE cur1;
  
END //
DELIMITER ;