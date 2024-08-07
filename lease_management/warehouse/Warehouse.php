<?php 
    date_default_timezone_set('Asia/Kolkata');
     require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Warehouse
{
    private $db_handle;
    
        function __construct() 
        {
            $this->db_handle = new DBController();
        }
    
        function addWarehouse($warehouse_name, $code, $lessor_id, $add1, $add2, $city, $state, $pin, $country, $capacity_sqft, $capacity_mton, $primary_contact, $status, $created_by) 
        {
            $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
            $query = "INSERT INTO tbl_warehouse (warehouse_name, code, lessor_id, add1 , add2, city, state, pin, country, capacity_sqft, capacity_mton,avl_sqft,avl_mton, primary_contact, status, created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "ssissiiiiiiiiisi";
            $paramValue = array(
                $warehouse_name,
                $code,
                $lessor_id,
                $add1,
                $add2,
                $city,
                $state,
                $pin,
                $country,
                $capacity_sqft,
                $capacity_mton,
                $capacity_sqft, //avl_sqft
                $capacity_mton, //avl_mton
                $primary_contact,
                $status,
                $created_by
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

            //Adding Transaction Log
            $activity = "New Warehouse details added with Warehouse ID: $insertId";
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

        
    
        function editWarehouse($warehouse_name, $code, $lessor_id, $add1, $add2, $city, $state, $pin, $country, $capacity_sqft, $capacity_mton, $primary_contact, $status, $warehouse_id)
        {
            $last_updated=$_SESSION['id'];
            $last_updatedDateTime =  date("Y-m-d H:i:s");

            $query = "UPDATE tbl_warehouse SET warehouse_name=?, code=?, lessor_id=?, add1=?, add2=?, city=?, state=?, pin=?, country=?, capacity_sqft=?, capacity_mton=?, ";
            $query .= "primary_contact=?, status=?, last_updated=?, last_updateddatetime=? WHERE id = ?";
            $paramType = "ssissiiiiiiisisi";
            $paramValue = array(
                $warehouse_name,
                $code,
                $lessor_id,
                $add1,
                $add2,
                $city,
                $state,
                $pin,
                $country,
                $capacity_sqft,
                $capacity_mton,
                $primary_contact,
                $status,
                $last_updated,
                $last_updatedDateTime,
                $warehouse_id
            );
            
            $this->db_handle->update($query, $paramType, $paramValue);

            //Adding Transaction Log
            $activity = "Warehouse details updated for Warehouse ID: $warehouse_id";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
            $paramType = "sii";
            $paramValue = array(
                $activity,
                $last_updated,
                $warehouse_id
            );
            $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);        
        }
    
        function deletewarehouse($warehouse_id) 
        {
            $query = "UPDATE tbl_warehouse SET status = 'D' WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $warehouse_id
            );
            $this->db_handle->update($query, $paramType, $paramValue);
        }
    
        function getWarehousById($warehouse_id) 
        {
            $query = "SELECT * FROM tbl_warehouse WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $warehouse_id
            );
            
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }

           
    function validateWarehousename($warehouse_name) {
        $sql = "SELECT warehouse_name FROM vw_warehouse WHERE warehouse_name = '$warehouse_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

             
    function validateWarehousenameEdit($warehouse_name,$warehouse_id ) 
    {
        $sql = "SELECT warehouse_name FROM vw_warehouse WHERE id != $warehouse_id AND warehouse_name = '$warehouse_name'";
        //$result = $this->db_handle->runBaseQuery($sql);
        //$count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return true;
        }
        else{
            return false;
        }
    }

    function validateWarehousecode($code) {
        $sql = "SELECT code FROM vw_warehouse WHERE code = '$code'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateWarehousecodeEdit($code,$warehouse_id ) {
        $sql = "SELECT code FROM vw_warehouse WHERE id!= $warehouse_id AND code = '$code'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
        function getAllWarehouse() 
        {
            $sql = "SELECT * FROM vw_warehouse";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
}
?>