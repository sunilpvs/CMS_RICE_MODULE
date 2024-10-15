<?php 
#require_once ("class/DBController.php");
date_default_timezone_set('Asia/Kolkata');
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");


class Vendor
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addVendor($vendor_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $created_by)
     {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_vendor (vendor_name, add1, add2, city, state, pin, country, primary_contact, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssiiiiisi";
        $paramValue = array(
            $vendor_name,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact,
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Vendor Details are added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $created_by
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);

         $this->db_handle->commitTrans();
            return $insertId;
            }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
        }
    function editVendor($vendor_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $vendor_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_updateddatetime =  date("Y-m-d H:i:s");

        $query = "UPDATE tbl_vendor SET vendor_name = ?, add1 = ?, add2 = ?, city = ?, state = ?, pin = ?, country = ?, status =?, primary_contact = ?, ";
        $query .= " last_updated = ?, last_updateddatetime = ? WHERE id = ?";
        $paramType = "sssiiiisiisi";
        $paramValue = array(
            $vendor_name,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $status,
            $primary_contact,
            $last_updated,
            $last_updateddatetime,
            $vendor_id
        );
        $updateId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        $activity = "Updated vendor details for Vendor ID: $vendor_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);        
        return $updateId;
    }
    
    function deleteVendor($id) {
        $query = "UPDATE tbl_vendor SET status ='D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateVendorname($vendor_name) {
        $sql = "SELECT vendor_name FROM vw_vendorlist WHERE vendor_name = '$vendor_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateVendornameEdit($vendor_id ,$vendor_name) {
        $sql = "SELECT vendor_name FROM vw_vendorlist WHERE id != $vendor_id AND  vendor_name = '$vendor_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    function getVendorById($id) {
        $query = "SELECT * FROM tbl_vendor WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllVendor() 
    {
        $sql = "SELECT * FROM vw_vendor";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }    
}
?>