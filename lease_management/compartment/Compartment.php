<?php 
#require_once ("class/DBController.php");
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');


class Compartment
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCompartment($outwardlease_id, $compartment_name, $warehouse_id, $capacity_sqft, $capacity_mton, $created_by) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $status ="A";
        $query = "INSERT INTO tbl_compartment (outwardlease_id,compartment_name,warehouse_id,capacity_sqft,capacity_mton,status,created_by) VALUES (?,?,?, ?, ?, ?, ?)";
        $paramType = "isisssi";
        $paramValue = array(
            $outwardlease_id,
            $compartment_name,
            $warehouse_id,
            $capacity_sqft,
            $capacity_mton,
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        //Update Compartment_Id of Compartments for new Inserted Row
        $result = $this->getCompartmentById($insertId);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $prefix = $row['prefix'];
        $id = $row['id'];
        $comp_id = $prefix . $id;
        $query = "UPDATE tbl_compartment SET compartment_id = '$comp_id' WHERE id = $id;";
        $this->db_handle->runBaseQuery($query);
        //Adding Transaction Log
        $activity = "New Compartment created with ID: $insertId for WarehouseID: $warehouse_id";
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

    
    function editCompartment($compartment_id, $warehouse_id,  $capacity_sqft,  $capacity_mton,$status, $id) {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");        
        $query = "UPDATE tbl_compartment SET compartment_id = ?,warehouse_id = ?, capacity_sqft = ?, capacity_mton = ?, status = ?,last_updated = ?, last_updateddatetime = ? WHERE id = ?";
        $paramType = "sisssisi";
        $paramValue = array(
            $compartment_id,
            $warehouse_id,
            $capacity_sqft,
            $capacity_mton,
            $status,
            $last_updated,
            $last_updatedDateTime,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteCompartment($id) {
        $query = "DELETE FROM tbl_compartment WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getCompartInfo($outwardlease_id, $warehouse_id)
    {
        $sql = "SELECT compartment_name,capacity_sqft,capacity_mton, status FROM tbl_compartment WHERE status = 'A' AND outwardlease_id = $outwardlease_id AND warehouse_id = $warehouse_id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getCompartmentById($id) {
        $query = "SELECT * FROM tbl_compartment WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllCompartment() {
        $sql = "SELECT * FROM vw_compartments ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
     function getCompartmentTypesList() {
        $sql = "SELECT * FROM tbl_compartmenttype  ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
      function getCustomerList() {
        $sql = "Select ID, Name from tbl_customer ORDER BY ID";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
     function getWarehouseList() {
        $sql = "Select id, warehouse_name from vw_warehouselist ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
    function getInwardleaseList() {
        $sql = "Select ltype, start_date,expiry_date from vw_inwardleases ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>