<?php 
    date_default_timezone_set('Asia/Kolkata');
  require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Lessor
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addLessor($lessor_name, $ltype, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_lessor (lessor_name, ltype, add1, add2, city, state, pin, country, primary_contact, status, created_by)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $paramType = "sissiiiiisi";
        $paramValue = array(
            $lessor_name,
            $ltype,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact,
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "New Lessor added with ID: $insertId";
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

    
    
    function editLessor($lessor_name, $ltype, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $lessor_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_lessor SET lessor_name=?, ltype=?, add1=?, add2=?, city=?, state=?, pin=?, country=?, primary_contact=?, status=?, last_updated=? ,last_updateddatetime=? WHERE id=?";
        
        $paramType = "sissiiiiisisi";
        $paramValue = array(
            $lessor_name,
            $ltype,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact, 
            $status,
            $last_updated,
            $last_UpdatedDateTime,
            $lessor_id
        );
        $updateid = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "Lessor details updated Lessor ID: $lessor_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $last_updated,
			$$lessor_id
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);

        return $updateid;

    }
    
    function deleteLessor($lessor_id) 
    {
        $query = "UPDATE tbl_lessor SET status ='D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $lessor_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getLessorById($lessor_id) {
        $query = "SELECT * FROM tbl_lessor WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $lessor_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateLessorname($lessor_name) {
        $sql = "SELECT lessor_name FROM vw_lessor WHERE lessor_name = '$lessor_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateLessornameEdit($lessor_name,$lessor_id) {
        $sql = "SELECT lessor_name FROM vw_lessor WHERE id!= $lessor_id AND lessor_name = '$lessor_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
     
    function getAllLessor() {
        $sql = "SELECT * FROM vw_lessor";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>