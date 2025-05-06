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
                                
        function addInwardstock($customer, $warehouse, $compartment_id, $commodity_id, $mod_transport, $trans_date, 
                                $invoice_no, $invoice_date, $miller_id, $vehicle_no, $bags_stock, $wb_gross_wt, $gross_wt, $gross_diff,
                                $wb_net_wt, $net_wt, $net_diff, $remarks, $entity_id, $created_by)
        {
            $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
            $query =    "INSERT INTO tbl_inwardstock (customer_id, warehouse_id, compartment_id, commodity_id, mod_transport, trans_date, invoice_no, invoice_date, miller_id, ";
            $query .=   " vehicle_no, bags_stock, wb_gross_wt, gross_wt, gross_diff, wb_net_wt, net_wt, net_diff,";
            $query .=   " remarks, entity_id, created_by)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) "; 
            $paramType = "iiiiisssisisssssssii";
            $paramValue = array(
                $customer,
                $warehouse,
                $compartment_id, 
                $commodity_id,
                $mod_transport,

                $trans_date, 
                $invoice_no,
                $invoice_date,
                $miller_id, 
                $vehicle_no,
                
                $bags_stock,
                $wb_gross_wt,
                $gross_wt,
                $gross_diff,
                $wb_net_wt,
                $net_wt,
                $net_diff,

                $remarks,
                $entity_id,                
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
                $this->revalidateStock($customer, $warehouse, $commodity_id, $compartment_id, $mod_transport);
            }
            else 
            {
                # code...
                $sql = "INSERT INTO tbl_commodity_stock (customer_id, warehouse_id, compartment_id, commodity_id, mod_transport, bags_stock, gross_wt, net_wt, created_by) ";
                $sql .= " VALUES ($customer, $warehouse, $compartment_id, $commodity_id, $mod_transport, $bags_stock, $wb_gross_wt, $wb_net_wt, $created_by);";
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
    
     function editInwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, 
                                $trans_date, $invoice_no, $invoice_date, $vehicle_no, $miller_id, $wb_gross_wt, $gross_wt, $gross_diff,
                                $wb_net_wt, $net_wt, $net_diff, $remarks, $inwardstock_id)
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{                
            
                $sql = "SELECT * FROM tbl_inwardstock WHERE id = $inwardstock_id;"; 
                $result = $this->db_handle->runBaseQuery($sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $cust_old = $row['customer_id'];
                $wh_old = $row['warehouse_id'];
                $comp_old = $row['compartment_id'];
                $comm_old = $row['commodity_id'];
                $mod_old = $row['mod_transport'];
            
                $query = "UPDATE tbl_inwardstock SET customer_id = ?, warehouse_id = ?, compartment_id = ?, commodity_id = ?, mod_transport = ?, bags_stock = ?, trans_date = ?,"; 
                $query .= " invoice_no = ?, invoice_date = ?, vehicle_no = ?, miller_id = ?,";  
                $query .= " wb_gross_wt = ?, gross_wt = ?, gross_diff = ?, wb_net_wt = ?, net_wt = ?, net_diff = ?,";
                $query .= " remarks = ?, lastupdated_by=?, lastupdated_datetime = ? WHERE id = ?"; 
                $paramType = "iiiiiissssisssssssisi";
                $paramValue = array(
                    $customer_id,
                    $warehouse_id,
                    $compartment_id, 
                    $commodity_id,
                    $mod_transport,
                    $bags_stock,
                    $trans_date,
                    $invoice_no,
                    $invoice_date,
                    $vehicle_no,
                    $miller_id,  
                    $wb_gross_wt,
                    $gross_wt,
                    $gross_diff,
                    $wb_net_wt,
                    $net_wt,
                    $net_diff,
                    $remarks,
                    $last_updated,
                    $last_updatedDateTime,
                    $inwardstock_id                
                );
                $transId = $this->db_handle->update($query, $paramType, $paramValue);
                //Update tbl_Commodity_Stock table with revisions.
                //Revise Commodity stock based on old values and new values
                $this->revalidateStock($cust_old, $wh_old, $comm_old, $comp_old, $mod_old);
                //Get latest stock and wts.
                $this->revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport);
                //Adding Transaction Log
                $activity = "Edited inward stock. InwardStockID: $transId :";
                $log = "For customer_id: $customer_id, warehouse_id: $warehouse_id, compartment_id: $compartment_id, commodity_id: $commodity_id, mod_transport: $mod_transport";
                $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
                $paramType = "sis";
                $paramValue = array(
                    $activity,
                    $last_updated,
                    $log
                );
                $transId = $this->db_handle->insert($trans_query, $paramType, $paramValue);

                $this->db_handle->commitTrans();
                return $transId;
            }catch (\Throwable $e){
                // An exception has been thrown
                // We must rollback the transaction
                $this->db_handle->rollbackTrans();
                throw $e; // but the error must be handled anyway
            }
        }
    
    function revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport)
    {
        $sql = "CALL sp_updateCommodityStock(?, ?, ?, ?, ?)";
        $paramType = "iiiii";
        $paramValue = array(
            $customer_id,
            $warehouse_id, 
            $commodity_id, 
            $compartment_id, 
            $mod_transport
        );
        $result = $this->db_handle->executeQuery($sql, $paramType, $paramValue);
        return $result;
    }

    function deleteInwardstock($id) {
        $query = "DELETE FROM tbl_inwardstock WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        //$this->db_handle->update($query, $paramType, $paramValue);
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
        $sql = "SELECT id,miller_name,gst_num,place FROM tbl_miller WHERE status = 1;";
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
        $sql = "SELECT id,concat(cargo_type,'-',commodity_name,'-',brand,'-',marking) as commodity,empty_bag_wt,bag_wt FROM vw_commodities WHERE status = 'Active';";
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
        $sql = "SELECT * FROM vw_inwardstock WHERE date_format(trans_date,'%d-%b-%Y') = '$dt' ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

}
?>