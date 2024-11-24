################################################################################################
# SQL FOR ALL EVENTS CREATION OR REPLACE
################################################################################################
	SET GLOBAL event_scheduler = ON;
# Inward Lease Expiry Event
delimiter |
CREATE EVENT e_daily_update_lease_status
    ON SCHEDULE
      EVERY 1 DAY
    COMMENT 'Updates Lease Status to Expired for Leases Ended Day-1'
    DO
      BEGIN
		UPDATE tbl_outwardlease SET lease_status = 'E' 
        WHERE DATE_FORMAT(lease_end,'%d-%b-%Y') < DATE_FORMAT(Now(),'%d-%b-%Y');
      END |
delimiter ;
################################################################################################



DROP PROCEDURE IF EXISTS `delete_rows_links` 
GO

CREATE PROCEDURE delete_rows_links
BEGIN 

    DELETE activation_link
    FROM activation_link_password_reset
    WHERE  TIMESTAMPDIFF(DAY, `time`, NOW()) < 1 ; 

END 

GO


CREATE EVENT `exec`
  ON SCHEDULE EVERY 5 SECOND
  STARTS '2013-02-10 00:00:00'
  ENDS '2015-02-28 00:00:00'
  ON COMPLETION NOT PRESERVE ENABLE
DO 
  call delete_rows_links();


delimiter |

