<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Delivery
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addDelivery($delivery_name, $particulars,  $status, $created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_delivery(delivery_name, particulars,status,created_by)  VALUES (?, ?, ?, ?);";
        $paramType = "sssi";
        $paramValue = array(
            $delivery_name, 
            $particulars, 
            "A",
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
         $this->db_handle->commitTrans();
            return $insertId;
            }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
        }

    
    
    function editDelivery($delivery_name, $particulars,$status, $delivery_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_delivery SET delivery_name=?, particulars=?,  status=?, last_updated=? ,last_updateddatetime=? WHERE id=?";
        
        $paramType = "sssisi";
        $paramValue = array(
            $delivery_name, 
            $particulars, 
            $status,
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
    
    function deleteDelivery($delivery_id) 
    {
        $query = "UPDATE tbl_delivery SET status ='D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $delivery_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getDeliveryById($delivery_id) {
        $query = "SELECT * FROM tbl_delivery WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $delivery_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateDeliveryname($delivery_name) {
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

    function validateDeliverynameEdit($delivery_name,$delivery_id) {
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

     
    function getAllDelivery() {
        $sql = "SELECT * FROM tbl_delivery";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>