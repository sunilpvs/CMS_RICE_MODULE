DROP PROCEDURE IF EXISTS `sp_ReleaseExpiredOutwardLeaseCapacity`;
DELIMITER //
CREATE PROCEDURE `sp_ReleaseExpiredOutwardLeaseCapacity` ()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE cid, clease_model, cwarehouse_id INT;
  DECLARE clease_capacity_sqft, clease_capacity_mton, cap_sft, cap_mton FLOAT;
  DECLARE cur1 CURSOR FOR SELECT id, warehouse_id, lease_model,lease_capacity_sqft,lease_capacity_mton 
							FROM tbl_outwardlease WHERE DATE_FORMAT(lease_end,'%Y-%m-%d') <= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d') AND release_capacity = 0;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  OPEN cur1;
  read_loop: LOOP
    FETCH cur1 INTO cid, cwarehouse_id, clease_model, clease_capacity_sqft, clease_capacity_mton;
    IF done THEN
      LEAVE read_loop;
    END IF;
    
    IF clease_model = 1 THEN
		SET cap_mton = TRUNCATE((clease_capacity_sqft / 4),0);
        UPDATE tbl_warehouse SET used_sqft = used_sqft - clease_capacity_sqft, avl_sqft = avl_sqft + clease_capacity_sqft, 
						used_mton = used_mton - cap_mton, avl_mton = avl_mton + cap_mton
			WHERE id = cwarehouse_id;
        UPDATE tbl_outwardlease SET lease_status = 'E', release_capacity = 1 WHERE id = cid;
        UPDATE tbl_compartment SET status = 'E' WHERE outwardlease_id = cid;
    END IF;
    
    IF clease_model = 2 THEN
		SET cap_sft = TRUNCATE((clease_capacity_mton * 4),0);
        UPDATE tbl_warehouse SET used_sqft = used_sqft - cap_sft, avl_sqft = avl_sqft + cap_sft, 
						used_mton = used_mton - clease_capacity_mton, avl_mton = avl_mton + clease_capacity_mton
			WHERE id = cwarehouse_id;
        UPDATE tbl_outwardlease SET lease_status = 'E' , release_capacity = 1 WHERE id = cid;
        UPDATE tbl_compartment SET status = 'E' WHERE outwardlease_id = cid;
    END IF;
    
  END LOOP;
  CLOSE cur1;
END //
DELIMITER ;