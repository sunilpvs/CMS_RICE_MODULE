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

        function getCustomerOpeningStock($customer, $commodity, $rpt_date)
        {
            $customer_id = $customer;
            $customer_name = "";
            $warehouse_id =0;
            $warehouse_name ="";
            $commodity_id = $commodity;
            $commodity_name = "";
            $bags = 0;
            $gross_wt = 0;
            $net_wt = 0;
            //Check if there is entry in tbl_opening_stock for the Customer, Commodity, for the date.
            $sql = "SELECT * FROM tbl_opening_stock WHERE customer_id = $customer AND commodity_id = $commodity AND stock_date = '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            $row_count = mysqli_num_rows($result);
            if($row_count <= 0)
            {
                //Entry does not exist in tbl_opening_stock table
                // Make a new entry and return the result set.
                $sql = "";
                $sql = "SELECT * FROM vw_rpt_daily_customer_open_stock WHERE customer_id = $customer AND commodity_id = $commodity AND received_date < '$rpt_date'; ";
                $result = $this->db_handle->runBaseQuery($sql);
                $row_count = mysqli_num_rows($result);
                if($row_count > 0)
                {    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $customer_id = $row['customer_id'];
                    $customer_name = $row['customer_name'];
                    $warehouse_id = $row['warehouse_id'];
                    $warehouse_name = $row['warehouse_name'];
                    $commodity_id = $row['commodity_id'];
                    $commodity_name = $row['commodity'];
                    $bags = $row['bags'];
                    $gross_wt = $row['gross_wt'];
                    $net_wt = $row['net-wt'];
        
                    $sql = "INSERT INTO tbl_opening_stock (customer_id,customer_name,warehouse_id,warehouse_name,commodity_id,commodity,stock_date,bags,gross_wt,net_wt) VALUES ";
                    $sql .= "($customer_id, $customer_name, $warehouse_id, $warehouse_name, $commodity_id, $commodity_name,$rpt_date, $bags, $gross_wt, $net_wt); ";
                    $result = $this->db_handle->runBaseQuery($sql);    
                    //Fetch Result after insert
                    $sql = "SELECT * FROM tbl_opening_stock WHERE customer_id = $customer AND commodity_id = $commodity AND stock_date = '$rpt_date';";
                    $result = $this->db_handle->runBaseQuery($sql);    
                }
            }
            return $result;
        }

        function getCustomerInwardStock($customer, $commodity, $rpt_date)
        {
            $sql = "SELECT * FROM vw_rpt_daily_customer_inwardstock WHERE customer_id = $customer AND ";
            $sql .= "commodity_id = $commodity AND received_date= '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCustomerWagonInwardStock($customer, $commodity, $rpt_date)
        {
            $sql = "SELECT * FROM vw_rpt_daily_customer_wagon_inwardstock WHERE customer_id = $customer AND ";
            $sql .= "commodity_id = $commodity AND received_date= '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCustomerOutwardStock($customer, $commodity, $rpt_date)
        {
            $sql = "SELECT * FROM vw_rpt_daily_customer_outwardstock WHERE customer_id = $customer AND ";
            $sql .= "commodity_id = $commodity  AND outward_date= '$rpt_date';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
        
    }

?>