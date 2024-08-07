<?php 
    date_default_timezone_set('Asia/Kolkata');
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Miller
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addMiller($miller_name, $gst_num, $place, $add1, $status, $created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_miller(miller_name, gst_num, place, add1,status,created_by)  VALUES (?, ?, ?, ?, ?, ?);";
        $paramType = "sssssi";
        $paramValue = array(
            $miller_name, 
            $gst_num, 
            $place, 
            $add1,
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "New Miller-Name added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $created_by,
			$insertId
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

    
    
    function editMiller($miller_name, $gst_num, $place, $add1,$status, $miller_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_miller SET miller_name=?, gst_num=?, place=?, add1=?, status=?, last_updated=? ,last_updateddatetime=? WHERE id=?";
        
        $paramType = "sssssisi";
        $paramValue = array(
            $miller_name, 
            $gst_num, 
            $place, 
            $add1,
            $status,
            $last_updated,
            $last_UpdatedDateTime,
            $miller_id
        );
        $updateid = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "Miller-Name details updated Lessor ID: $miller_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $last_updated,
			$miller_id
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);

        return $updateid;

    }
    
    function deleteMiller($miller_id) 
    {
        $query = "UPDATE tbl_miller SET status ='D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $miller_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getMillerById($miller_id) {
        $query = "SELECT * FROM tbl_miller WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $miller_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateMillername($miller_name) {
        $sql = "SELECT miller_name FROM tbl_miller WHERE miller_name = '$miller_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateMillernameEdit($miller_name,$miller_id) {
        $sql = "SELECT miller_name FROM tbl_miller WHERE id!= $miller_id AND miller_name = '$miller_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
     
    function getAllMiller() {
        $sql = "SELECT * FROM tbl_miller";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>