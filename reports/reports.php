<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php'); 

    class AllReports
    {
        private $db_handle;
        
        function __construct() {
            $this->db_handle = new DBController();
        }


        //Get Stock Report
        function getStockReport() 
        {
            $sql = "SELECT * FROM rpt_vwstock_report;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getInwardLeaseReport() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM rpt_vwinward_leases;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 

        function getOutwardLeaseReport() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM rpt_vwoutward_leases;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }


    }

?>