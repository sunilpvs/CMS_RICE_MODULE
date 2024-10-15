<?php 
    date_default_timezone_set('Asia/Kolkata');
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Inwardlease
{
    private $db_handle;
    
    function __construct() 
    {
        $this->db_handle = new DBController();
    }
    
   								
    function addInwardlease($warehouse_id, $lease_type, $start_date, $expiry_date, $status, $created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_inwardlease (warehouse_id, lease_type, start_date, expiry_date, status, created_by)  VALUES (?, ?, ?, ?, ?,?)";
        $paramType = "iissii";
        $paramValue = array(
            $warehouse_id,
            $lease_type,
            $start_date,
            $expiry_date,    
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        //Update Contract_Id of Inward Lease for  new Inserted Row
        $result = $this->getInwardleaseById($insertId);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $prefix = $row['prefix'];
        $id = $row['id'];
        $contract = $prefix . $id;
        $query = "UPDATE tbl_inwardlease SET contract_id = '$contract' WHERE id = $id;";
        $this->db_handle->runBaseQuery($query);
        //Adding Transaction Log
        $activity = "New Inward lease entry created for Contract ID: $insertId and WarehouseID: $warehouse_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $created_by,
            $warehouse_id
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

    
    
    function editInwardlease($warehouse_id, $lease_type, $start_date, $expiry_date, $status, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_inwardlease SET warehouse_id = ?,lease_type = ?,start_date= ?, expiry_date = ?, status = ?, last_updated = ? ,last_updateddatetime = ? WHERE id = ?";
        $paramType = "iissiisi";
        $paramValue = array(
            $warehouse_id,
            $lease_type,
            $start_date,
            $expiry_date,
            $status,
            $last_updated,
            $last_UpdatedDateTime,
            $id
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //Adding Transaction Log
        $activity = "Inward lease entry updated for Contract ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $last_updated,
            $warehouse_id
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
       
    function validateLeasecontact($contract_id) {
        $sql = "SELECT contract_id FROM vw_inwardleases WHERE contract_id = '$contract_id'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateLeasecontactedit($contract_id) {
        $sql = "SELECT contract_id FROM vw_inwardleases WHERE contract_id = '$contract_id'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function getInwardleaseById($id) {
        $query = "SELECT * FROM tbl_inwardlease WHERE id = ?";
        $paramType = "s";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllWareHouseList() {
        $sql = "SELECT id,concat(code,' - ',warehouse_name) as warehouse_name FROM tbl_warehouse 	WHERE status = 'A' ORDER BY id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
     
    function getAllInwardlease() {
        $sql = "SELECT * FROM vw_inwardleases";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>