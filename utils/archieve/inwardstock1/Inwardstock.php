<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');

class Inwardstock
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
   								
    function addInwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $Created_By) {
        $query = "INSERT INTO tbl_inwardstock (Lease_obj, Contract_id, Customer_id, Commenced_Date, Complete_Date, Capacity_Mton, RateDay, Commodity_Type, Contact_Days, Total_Cost, Created_By)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $paramType = "iiissiiiiii";
        
        $paramValue = array(
            $Lease_obj,
            $Contract_id,
            $Customer_id,
            $Commenced_Date,
            $Complete_Date,
            $Capacity_Mton,
            $RateDay,
            $Commodity_Type,
            $Contact_Days,
            $Total_Cost,    
            $Created_By
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editInwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $id) {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_inwardstock SET Lease_obj = ?,Contract_id = ?,Customer_id = ?,Commenced_Date= ?, Complete_Date = ?, Capacity_Mton = ?, RateDay = ?, Commodity_Type=?, Contact_Days = ?, Total_Cost=?, Last_Updated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
        $paramType = "iiissiiiiiisi";
        $paramValue = array(
            $Lease_obj,
            $Contract_id,
            $Customer_id,
            $Commenced_Date,
            $Complete_Date,
            $Capacity_Mton,
            $RateDay,
            $Commodity_Type,
            $Contact_Days,
            $Total_Cost,   
            $last_updated,
            $last_UpdatedDateTime,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    
    function deleteInwardstock($id) {
        $query = "DELETE FROM tbl_inwardstock WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getInwardstockById($id) {
        $query = "SELECT * FROM tbl_inwardstock WHERE id = ?";
        $paramType = "s";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
     
    function getAllInwardstock() {
        $sql = "SELECT * FROM tbl_inwardstock ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

}
?>