<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class States
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addStates($state, $country) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_state (state,country) VALUES (?, ?)";
        $paramType = "ss";
        $paramValue = array(
            $state,
            $country,
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New State is added with ID: $insertId";
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
    
    function editStates($state, $country, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        
        try{
        $query = "UPDATE tbl_state SET state = ?,country=? WHERE id = ?";
        $paramType = "ssi";
        $paramValue = array(
            $state,
            $country,
            $id
        );        
        $updatedId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated State details for State ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        $this->db_handle->commitTrans();
        return $updatedId;
        }catch (\Throwable $e){
        // An exception has been thrown
        // We must rollback the transaction
        $this->db_handle->rollbackTrans();
        throw $e; // but the error must be handled anyway
    }
    
    }
    
    function deleteState($id) {
        $query = "UPDATE tbl_state SET state = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($state, $country) 
    {
         $sql = "SELECT * FROM tbl_state WHERE state = '$state' AND country = '$country';";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateDuplicates_Edit($state, $country, $id) 
    {
        $sql = "SELECT * FROM tbl_city WHERE id != $id AND state = '$state' AND country = '$country');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getStatesById($id) {
        $query = "SELECT * FROM tbl_state WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllstates() {
        $sql = "SELECT * FROM tbl_state ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>