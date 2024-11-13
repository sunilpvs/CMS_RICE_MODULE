<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Userpermissions
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addUserpermissions($user_id, $page_id, $access_type, $createdBy) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_userpermissions (user_id,page_id,access_type, createdBy) VALUES (?, ?, ?, ?)";
        $paramType = "iiii";
        $paramValue = array(
            $user_id,
            $page_id,
            $access_type,
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Userpermissions is added with ID: $insertId";
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
    
    function editUserpermissions($user_id, $page_id, $access_type, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
       
        $query = "UPDATE tbl_userpermissions SET user_id = ?,page_id=?, access_type=?, last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "iiiisi";
        $paramValue = array(
            $user_id,
            $page_id,
            $access_type,
            $last_updated,
            $last_updatedDateTime,
            $id
        );        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Userpermissions details for State ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function deleteUserpermissions($id) {
        $query = "UPDATE tbl_userpermissions SET state = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($name, $code) 
    {
        $sql = "SELECT name FROM tbl_userpermissions WHERE code = '$code' OR name = '$name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateDuplicates_Edit($id, $name, $code) 
    {
        $sql = "SELECT name FROM tbl_userpermissions WHERE id != $id AND (code = '$code' OR name = '$name');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getUserpermissionsById($id) {
        $query = "SELECT * FROM tbl_userpermissions WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAlluserpermissions() {
        $sql = "SELECT * FROM tbl_userpermissions ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>