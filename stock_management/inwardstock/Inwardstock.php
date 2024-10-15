<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

    class Inwardstock
    {
        private $db_handle;
    
        function __construct() 
        {
            $this->db_handle = new DBController();
        }
    							
//        function addInwardstock($received_date, $invoice_date, $invoice_no, $miller_id, $commodity_id, $mod_transport,
  //           $compartment_id, $vehicle_no, $inward_bags_stock, $inward_gross_wt, $inward_net_wt, $inward_wb_gross_wt, 
    //         $inward_wb_net_wt, $inward_diff_gross, $inward_diff_net, $current_bags_stock, $remarks, $created_by)

        function addInwardstock($customer, $warehouse, $compartment_id, $commodity_id, $mod_transport,
                $vehicle_no, $received_date, $invoice_date, $invoice_no, $miller_id, $inward_bags_stock,
                $inward_gross_wt, $inward_net_wt, $inward_wb_gross_wt, $inward_wb_net_wt, $inward_diff_gross,  
                $inward_diff_net, $current_bags_stock, $remarks, $created_by)
        {
            $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
            $query =    "INSERT INTO tbl_inwardstock (customer_id, warehouse_id, received_date, invoice_date, invoice_no, ";  
            $query .=   " miller_id, commodity_id, mod_transport, compartment_id, vehicle_no, inward_bags_stock, ";
            $query .=   " inward_gross_wt, inward_net_wt, inward_wb_gross_wt, inward_wb_net_wt, inward_diff_gross, ";
            $query .=   " inward_diff_net, current_bags_stock, remarks, created_by)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)"; 
            $paramType = "iisssiiiisissssssisi";
            $paramValue = array(
                $customer,
                $warehouse,
                $received_date, 
                $invoice_date,
                $invoice_no,

                $miller_id,  
                $commodity_id,
                $mod_transport,
                $compartment_id, 
                $vehicle_no,
                
                $inward_bags_stock,
                $inward_gross_wt,
                $inward_net_wt,
                $inward_wb_gross_wt,
                $inward_wb_net_wt,
                
                $inward_diff_gross, 
                $inward_diff_net,
                $inward_bags_stock, //$current_bags_stock,
                $remarks,                
                $created_by
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
            //Checking if Compartment and Commodity already existing in Commodity Stock Table
            $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer AND warehouse_id = $warehouse AND ";
            $sql .= "compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $mod_transport LIMIT 1;";
            $result = $this->db_handle->runBaseQuery($sql);
            $count=mysqli_num_rows($result);
            $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //Update bags/stock for new Inserted Row on basis of customer,warehouse,compartment,commodity,transport_mode
            if($count>0)
            { //Compartment + Commodity Exists
                $bags_stock = $rows['bags_stock'];
                $gross_wt = $rows['gross_wt'];
                $net_wt = $rows['net_wt'];
                $bags_stock = $bags_stock + $inward_bags_stock;
                $gross_wt = $gross_wt + $inward_gross_wt;                
                $net_wt = $net_wt + $inward_net_wt;
                $sql = "UPDATE tbl_commodity_stock SET bags_stock = $bags_stock, gross_wt = $gross_wt, net_wt = $net_wt, last_updated = $created_by, last_updateddatetime = '$last_UpdatedDateTime' ";
                $sql .= " WHERE customer_id = $customer AND warehouse_id = $warehouse AND compartment_id = $compartment_id AND ";
                $sql .= " commodity_id = $commodity_id AND mod_transport = $mod_transport;";
                $stk = $this->db_handle->runBaseQuery($sql);
            }
            else 
            {
                # code...
                $sql = "INSERT INTO tbl_commodity_stock (customer_id, warehouse_id, compartment_id, commodity_id, mod_transport, bags_stock, gross_wt, net_wt, created_by) ";
                $sql .= " VALUES ($customer, $warehouse, $compartment_id, $commodity_id, $mod_transport, $inward_bags_stock, $inward_gross_wt, $inward_net_wt, $created_by);";
                $stk = $this->db_handle->runBaseQuery($sql);
            }   

            //Adding Transaction Log
            $activity = "New Commodity/Compartment based incoming stock updated. InwardStockID: $insertId for compartment_id: $compartment_id";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
            $paramType = "sii";
            $paramValue = array(
                $activity,
                $created_by,
                $compartment_id
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
    
    function getComp_CommodityStock($customer_id,$warehouse_id,$compartment_id,$commodity_id,$mod_transport)
    {
        //Checking if Compartment and Commodity already existing in Commodity Stock Table
        $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND ";
        $sql .= "commodity_id = $commodity_id AND mod_transport = $mod_transport LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
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
    
    
    function getInwardstockmillerList() 
    {
        $sql = "SELECT id,miller_name,gst_num,place FROM tbl_miller WHERE status = 'A';";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getCompartmentList() 
    {
        $sql = "SELECT * FROM vw_inwardstock_combo;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getInwardstockCompartmentList() 
    {
        $sql = "SELECT id,warehouse_id,compartment_name FROM tbl_compartment WHERE status = 'A';";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    
    function getInwardstockcommodityList() 
    {
        $sql = "SELECT id,concat(cargo_type,'-',commodity_name,'-',brand,'-',marking) as commodity,empty_bag_wt,bag_wt FROM vw_commodities WHERE status ='A';";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 
 
    function getTransportTypeList() 
    {
        $sql = "SELECT id,transport_mode FROM tbl_transport_mode  ORDER BY id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 
    

    function getAllInwardstock($dt) {
        //$sql = "SELECT * FROM vw_inwardstock ORDER BY id";
        $sql = "SELECT * FROM vw_inwardstock WHERE date_format(received_date,'%d-%b-%Y') = '$dt' ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

}
?>