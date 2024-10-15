<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');

class Outwardstock
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
   								
    function addOutwardstock($outward_date, $dc_no, $dc_date, $godown_name, $compartment_name, $vehicle_no,$cargo_details,$bag_mark ,$bag_wtg,$bags_out, $wbridge_wtg,$net_wtg,$delivery_dtl,$remarks,$created_by) {
        $query = "INSERT INTO tbl_outwardstock (outward_date, dc_no, dc_date, godown_name, compartment_name, vehicle_no,cargo_details,bag_mark ,bag_wtg,bags_out, wbridge_wtg,net_wtg,delivery_dtl,remarks,created_by)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?)";
        $paramType = "ssssssisisssisi";
        
        $paramValue = array(
            $outward_date, 
            $dc_no, 
            $dc_date, 
            $godown_name, 
            $compartment_name, 
            $vehicle_no,
            $cargo_details,
            $bag_mark,
            $bag_wtg,
            $bags_out, 
            $wbridge_wtg,
            $net_wtg,
            $delivery_dtl,
            $remarks,    
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editOutwardstock($outward_date, $dc_no, $dc_date, $godown_name, $compartment_name, $vehicle_no,$cargo_details,$bag_mark ,$bag_wtg,$bags_out, $wbridge_wtg,$net_wtg,$delivery_dtl,$remarks, $id) {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_outwardstock SET outward_date = ?,dc_no = ?,dc_date = ?,godown_name= ?, compartment_name = ?,vehicle_no=?, cargo_details = ?, bag_mark = ?, bag_wtg=?, bags_out= ?, wbridge_wtg=?, net_wtg=?,delivery_dtl=?, last_pudated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
        $paramType = "ssssssisisssisiisi";
        $paramValue = array(
            $outward_date, 
            $dc_no, 
            $dc_date, 
            $godown_name, 
            $compartment_name, 
            $vehicle_no,
            $cargo_details,
            $bag_mark,
            $bag_wtg,
            $bags_out, 
            $wbridge_wtg,
            $net_wtg,
            $delivery_dtl,
            $remarks,
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
        $query = "SELECT * FROM tbl_outwardstock WHERE id = ?";
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