DROP PROCEDURE IF EXISTS `sp_SetInwardLeaseExpiredStatus`;
DELIMITER //
CREATE PROCEDURE `sp_SetInwardLeaseExpiredStatus` ()
BEGIN
	DECLARE done INT DEFAULT FALSE;
	DECLARE in_id INT;
	DECLARE cur1 CURSOR FOR SELECT id FROM tbl_inwardlease WHERE DATE_FORMAT(expiry_date,'%Y-%m-%d') <= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d');
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	SET SQL_SAFE_UPDATES = 0;
  OPEN cur1;
  read_loop: LOOP
    FETCH cur1 INTO in_id;
    IF done THEN
      LEAVE read_loop;
    END IF;
	UPDATE tbl_inwardlease SET status = 6 WHERE id = in_id;
  END LOOP;
  CLOSE cur1;
  
END //
DELIMITER ;
