<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

class Costcenter
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCostcenter($cc_code, $cc_type, $entity_id, $incorp_date, $gst, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $createdBy) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_costcenter (cc_code, cc_type, entity_id, incorp_date, gst_no, add1, add2, city, state, pin, country, primary_contact, status, created_by) ";
        $query .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "ssissssiiiiisi";
        $status="A";
        $paramValue = array(
            $cc_code,
            $cc_type,
            $entity_id,
            $incorp_date,
            $gst,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact,
            $status,    
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Branch/Costcenter is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $createdBy
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
    
    function editCostcenter($cc_code, $cc_type, $entity_id, $incorp_date, $gst, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status)
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_costcenter SET cc_type = ?, entity_id = ?, incorp_date = ?, gst_no = ?, add1 = ?, add2 = ?, city = ?, state=?, pin = ?, ";
        $query .= " country = ?, primary_contact= ?, status = ? , last_updated = ? , last_updateddatetime = ? WHERE cc_code = ?";
        $paramType = "sissssiiiiisiss";
        $paramValue = array(
            $cc_type,
            $entity_id,
            $incorp_date,
            $gst,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact,
            $status,    
            $last_updated,
            $last_updatedDateTime,
            $cc_code
        );
        $this->db_handle->update($query, $paramType, $paramValue);

        $activity = "Updated Branch/CostCenter details for CostCenter Code:".$cc_code;
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
    }
    
    function deleteCostcenter($cc_code) {
        $query = "UPDATE tbl_costcenter SET status = 'D' WHERE cc_code = ?";
        $paramType = "S";
        $paramValue = array(
            $cc_code
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateCCCode($cc_code) {
        $sql = "SELECT cc_code FROM vw_costcenter_list WHERE cc_code = '$cc_code'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    
    function validateCCCodeEdit($cc_code, $costcenter_id) {
        $sql = "SELECT cc_code FROM vw_costcenter_list WHERE id != $costcenter_id  AND cc_code = '$cc_code'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    
    function getCostcenterById($id) {
        $query = "SELECT * FROM tbl_costcenter WHERE id = ?";
        $paramType = "s";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllcostcenter() {
        $sql = "SELECT * FROM vw_costcenter_list";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }



}
?>