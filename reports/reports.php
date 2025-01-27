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

        function getCurrentStock() 
        {
            $id = $_SESSION['id'] ; 
            $sql = "SELECT * FROM vw_rpt_currentstock;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 

        function getInwardLeaseReport() 
        {
           
            $sql = "SELECT * FROM rpt_vwinward_leases;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 

        function getOutwardLeaseReport() 
        {
            $sql = "SELECT * FROM rpt_vwoutward_leases;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCustomerInwardStock($cust, $rpt_date)
        {
            $sql = "SELECT * FROM vw_rpt_daily_customer_inwardstock WHERE customer_id = $cust AND received_date= '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCustomerOutwardStock($cust, $rpt_date)
        {
            $sql = "SELECT * FROM vw_rpt_daily_customer_outwardstock WHERE customer_id = $cust AND outward_date= '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
        
    }

?>