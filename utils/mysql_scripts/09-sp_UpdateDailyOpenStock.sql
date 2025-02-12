DROP PROCEDURE IF EXISTS `sp_UpdateDailyOpenStock`;
DELIMITER //
CREATE PROCEDURE `sp_UpdateDailyOpenStock` ()
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE out_id INT;
	DECLARE cur1 CURSOR FOR SELECT id FROM tbl_outwardlease WHERE DATE_FORMAT(lease_end,'%Y-%m-%d') <= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d');
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
 
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