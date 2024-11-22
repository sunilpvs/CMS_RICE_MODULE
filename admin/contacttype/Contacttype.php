<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Contacttype
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addContacttype ( $name, $status) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_contacttype (name,status) VALUES (?, ?)";
        $paramType = "ss";
        $paramValue = array(
            $name, 
            $status
          
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Contacttype  is added with ID: $insertId";
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
    
    function editContacttype($name, $status,  $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
       try{
        $query = "UPDATE tbl_contacttype SET name = ?,status=? WHERE id = ?";
        $paramType = "ssi";
        $paramValue = array(
            $name, 
            $status, 
            $id
        );        
        $updatedId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Contacttype details for City ID: $id";
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
    
    function deleteContacttype($id) {
        $query = "UPDATE tbl_contacttype  SET city = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($name, $status) 
    {
        $sql = "SELECT name FROM tbl_contacttype  WHERE name = '$name' AND status = '$status'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateDuplicates_Edit( $name, $status,$id) 
    {
        $sql = "SELECT name FROM tbl_contacttype  WHERE id != $id AND name = '$name' AND status = '$status';";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getContacttypeById($id) {
        $query = "SELECT * FROM tbl_contacttype  WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllContacttype () {
        $sql = "SELECT a.id,a.name,b.status FROM tbl_contacttype a, tbl_status b ";
        $sql .= "WHERE a.status = b.id ORDER BY id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>