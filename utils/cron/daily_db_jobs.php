<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');
    try 
    {
        $db_handle = new DBController();
        $sql = 'CALL sp_ReleaseExpiredOutwardLeaseCapacity();';
        $db_handle->runBaseQuery($sql);
        $sql = "UPDATE tbl_inwardlease SET status = 5 WHERE expiry_date < now();";
        $db_handle->runBaseQuery($sql);
    } catch (Exception $e) {
        die("Error occurred:" . $e->getMessage());
    }


?>