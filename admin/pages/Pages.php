<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Pages
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addPages($state, $country, $createdBy) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_pages (state,country,createdBy) VALUES (?, ?, ?)";
        $paramType = "ssi";
        $paramValue = array(
           
            $state,
            $country,
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Pages is added with ID: $insertId";
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
    
    function editPages($state, $country, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
       
        $query = "UPDATE tbl_pages SET state = ?,country=?, last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "ssssi";
        $paramValue = array(
           
            $state,
            $country,
            $last_updated,
            $last_updatedDateTime,
            $id
        );        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Pages details for State ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function deletePages($id) {
        $query = "UPDATE tbl_pages SET state = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($name, $code) 
    {
        $sql = "SELECT name FROM tbl_pages WHERE code = '$code' OR name = '$name'";
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
        $sql = "SELECT name FROM tbl_pages WHERE id != $id AND (code = '$code' OR name = '$name');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getPagesById($id) {
        $query = "SELECT * FROM tbl_pages WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllpages() {
        $sql = "SELECT * FROM tbl_pages ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>