<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');

class Inwardstock
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
   								
    function addInwardstock($received_date, $invoice_no, $invoice_date,$miller_name,  $gst_no, $place, $mode_transport, $godown_name, $compartment_name,$cargo_details, $vehicle_no,$bag_mark ,$bag_wtg,$bags_rec, $wbridge_wtg,$net_wtg,$remarks,  $created_by) {
        $query = "INSERT INTO tbl_inwardstock (received_date, invoice_no, invoice_date,miller_name, gst_no, place, mode_transport, godown_name, compartment_name,cargo_detaisl, vehicle_no, bag_mark ,bag_wtg, bags_rec, wbridge_wtg, net_wtg,remarks,created_by)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?)";
        $paramType = "ssssssissississssi";
        
        $paramValue = array(
            $received_date,
            $invoice_no, 
            $invoice_date,
            $miller_name,  
            $gst_no, 
            $place, 
            $mode_transport, 
            $godown_name, 
            $compartment_name,
            $cargo_details, 
            $vehicle_no,
            $bag_mark ,
            $bag_wtg,
            $bags_rec,
            $wbridge_wtg,
            $net_wtg,
            $remarks,    
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editInwardstock($received_date, $invoice_no, $invoice_date,$miller_name,  $gst_no, $place, $mode_transport, $godown_name, $compartment_name,$cargo_details, $vehicle_no,$bag_mark ,$bag_wtg,$bags_rec, $wbridge_wtg,$net_wtg,$remarks, $id) {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_inwardstock SET received_date = ?,invoice_no = ?,invoice_date = ?,miller_name= ?, gst_no = ?,place=?, mode_transport = ?, godown_name = ?, compartment_name=?,cargo_details=?, vehicle_no = ?, bag_mark=?, bag_wtg=?,bags_rec=?, wbridge_wtg=?,net_wtg=?,remarks=?,last_updated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
        $paramType = "ssssssissississssiisi";
        $paramValue = array(
            $received_date, 
            $invoice_no, 
            $invoice_date,
            $miller_name,  
            $gst_no, 
            $place, 
            $mode_transport, 
            $godown_name, 
            $compartment_name, 
            $cargo_details,
            $vehicle_no,
            $bag_mark,
            $bag_wtg,
            $bags_rec,
            $wbridge_wtg,
            $net_wtg,
            $remarks,  
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
        $sql = "SELECT * FROM vw_inwardstock ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

}
?>