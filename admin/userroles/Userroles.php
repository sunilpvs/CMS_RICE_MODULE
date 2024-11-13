<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Userroles
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addUserroles($page, $access, $createdBy) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_userroles (page,access,created_by) VALUES (?, ?, ?)";
        $paramType = "iii";
        $paramValue = array(
            $page,
            $access,
            $createdBy
            
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Userroles is added with ID: $insertId";
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
    
    function editUserroles($page, $access, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
       
        $query = "UPDATE tbl_userroles SET page = ?,access=?,  lastupdated_by = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "iiisi";
        $paramValue = array(
            $page,
            $access,
            $lastupdated_by,
            $last_updatedDateTime,
            $id
        );        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Userroles details for State ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function deleteUserroles($id) {
        $query = "UPDATE tbl_userroles SET state = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($name, $code) 
    {
        $sql = "SELECT name FROM tbl_userroles WHERE code = '$code' OR name = '$name'";
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
        $sql = "SELECT name FROM tbl_userroles WHERE id != $id AND (code = '$code' OR name = '$name');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getUserrolesById($id) {
        $query = "SELECT * FROM tbl_userroles WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAlluserroles() {
        $sql = "SELECT * FROM tbl_userroles ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>