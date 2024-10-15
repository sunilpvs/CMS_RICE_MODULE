<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once ("class/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Status
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addStatus($code, $status, $module, $createdBy) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{
                $query = "INSERT INTO tbl_status (code,status,module,createdBy) VALUES (?, ?, ?, ?)";
                $paramType = "sssi";
                $paramValue = array(
                    $code,
                    $status,
                    $module,
                    $createdBy
                );
                $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
                $activity = "New Status is added with ID: $insertId";
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
    
    function editStatus($code, $status, $module, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
       
        $query = "UPDATE tbl_status SET code = ?,status = ?,module=?, last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "sssssi";
        $paramValue = array(
            $code,
            $status,
            $module,
            $last_updated,
            $last_updatedDateTime,
            $id
        );        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Status details for Status ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function validateDuplicates_Add($code, $status, $module) 
    {
        $sql = "SELECT * FROM tbl_status WHERE module = '$module' AND (code = '$code' OR status = '$status');";
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
        
    function getStatusById($id) {
        $query = "SELECT * FROM tbl_status WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllStatus() {
        $sql = "SELECT * FROM tbl_status ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>