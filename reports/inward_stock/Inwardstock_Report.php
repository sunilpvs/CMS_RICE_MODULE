<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

class Inwardstock_Report
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function getInwardStockReport($customer_id,$warehouse_id,$compartment_id,$miller_id,$commodity_id,$transport_id,$mycheck_id,$dt)
    {
        $sql = "SELECT * FROM rpt_vwinward_stock ";
        $sql .= " WHERE cust_id = $customer_id ";
        $sql .= " AND warehouse_id = $warehouse_id ";
        $sql .= " AND comp_id = $compartment_id ";
        if ($miller_id>0) { $sql .= " AND miller_id = 1 "; }
        if ($commodity_id >0) {$sql .= " AND commodity_id = 1 ";}
        if ($transport_id >0) {$sql .= " AND transport_id = 1 ";}

        if (isset($_POST['myCheck']) && $_POST['myCheck'] == 'on') 
        {
            if (isset($_POST['yourDateField']) ) 
            {
                $new_date = date('d-m-Y', strtotime($_POST['yourDateField']));
                //echo $new_date;
                $sql .= " AND date_format(lease_expiry,'%d-%m-%Y') = $new_date";
            }

        }
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    
    
    function getDesignationById($id) {
        $query = "SELECT * FROM tbl_designation WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllDesignation() {
        $sql = "SELECT * FROM tbl_designation ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>