<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Designation
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addDesignation($name, $code, $status, $createdBy) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            $query = "INSERT INTO tbl_designation (name,code,status,createdBy) VALUES (?, ?, ?, ?)";
            $paramType = "sssi";
            $paramValue = array(
                $name,
                $code,
                $status,
                $createdBy
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

            $activity = "New Designation is added with ID: $insertId";
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
    
    function editDesignation($name, $code, $status, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");

        try{
        $query = "UPDATE tbl_designation SET name = ?,code = ?,status = ?,last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "sssssi";
        $paramValue = array(
            $name,
            $code,
            $status,
            $last_updated,
            $last_updatedDateTime,
            $id
        );        
        $updatedId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Designation details for Designation ID: $id";
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
    
    function deleteDesignation($id) {
        $query = "UPDATE tbl_designation SET status = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($name, $code) 
    {
        $sql = "SELECT name FROM tbl_designation WHERE code = '$code' AND name = '$name'";
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
        $sql = "SELECT name FROM tbl_designation WHERE id != $id AND (code = '$code' OR name = '$name');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getDesignationById($id) {
        $query = "SELECT * FROM tbl_designation WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllDesignation() {
        $sql = "SELECT a.id, a.name, a.code, b.status FROM tbl_designation a, tbl_status b WHERE a.status = b.id ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>