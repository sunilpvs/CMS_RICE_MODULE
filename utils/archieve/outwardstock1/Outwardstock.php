<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');

class Outwardstock
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
   								
    function addOutwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $Created_By) {
        $query = "INSERT INTO tbl_outwardstock (Lease_obj, Contract_id, Customer_id, Commenced_Date, Complete_Date, Capacity_Mton, RateDay, Commodity_Type, Contact_Days, Total_Cost, Created_By)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
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
    
    function editOutwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $id) {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_outwardstock SET Lease_obj = ?,Contract_id = ?,Customer_id = ?,Commenced_Date= ?, Complete_Date = ?, Capacity_Mton = ?, RateDay = ?, Commodity_Type=?, Contact_Days = ?, Total_Cost=?, Last_Updated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
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
    
    
    function deleteOutwardstock($id) {
        $query = "DELETE FROM tbl_outwardstock WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getOutwardstockById($id) {
        $query = "SELECT * FROM tbl_loutwardstock WHERE id = ?";
        $paramType = "s";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
     
    function getAllOutwardstock() {
        $sql = "SELECT * FROM tbl_outwardstock ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

}
?>