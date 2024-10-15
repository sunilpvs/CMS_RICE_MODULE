<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');

class Userpermissions
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addUserpermissions($user_id, $page_id,  $access_type, $created_by) 
    {
        $query = "INSERT INTO tbl_userpermissions(user_id, page_id,access_type,created_by)  VALUES (?, ?, ?, ?);";
        $paramType = "iiii";
        $paramValue = array(
            $user_id, 
            $page_id, 
            $access_type,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "New Delivery_name added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $created_by,
			$insertId
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editUserpermissions($user_id, $page_id,  $access_type, $userpermissions_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_userpermissions SET user_id=?, page_id=?,  access_type=?, last_updated=? ,last_updateddatetime=? WHERE id=?";
        
        $paramType = "iiiisi";
        $paramValue = array(
           $user_id, 
           $page_id,  
           $access_type,
            $last_updated,
            $last_UpdatedDateTime,
            $delivery_id
        );
        $updateid = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "Delivery details updated Lessor ID: $delivery_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $last_updated,
			$delivery_id
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);

        return $updateid;

    }
    
    function deleteUserpermissions($userpermissions_id) 
    {
        $query = "UPDATE tbl_userpermissions SET status ='D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $userpermissions_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getUserpermissionsById($userpermissions_id) {
        $query = "SELECT * FROM tbl_userpermissions WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $delivery_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateUserpermissionsname($delivery_name) {
        $sql = "SELECT delivery_name FROM tbl_delivery WHERE delivery_name = '$delivery_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateUserpermissionsnameEdit($delivery_name,$delivery_id) {
        $sql = "SELECT delivery_name FROM tbl_delivery WHERE id!= $delivery_id AND delivery_name = '$delivery_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

     
    function getAllUserpermissions() {
        $sql = "SELECT * FROM tbl_userpermissions";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>