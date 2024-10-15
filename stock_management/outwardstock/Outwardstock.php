<?php 
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

class Outwardstock
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    //function addOutwardstock($outward_date, $dc_no, $dc_date, $commodity_id, $compartment_id, $vehicle_no, $current_bags_stock, $bags_out, $delivery_dtl,$outward_gross_wt,$outward_net_wt,$outward_wb_gross_wt, $outward_wb_net_wt, $outward_diff_gross, $outward_diff_net,$remarks,$created_by)
    function addOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $transport_id, $outward_date, $dc_no, $dc_date, 
                                    $bags_out, $vehicle_no, $current_bags_stock, $delivery_dtl, $outward_gross_wt, $outward_net_wt, $outward_wb_gross_wt, 
                                    $outward_wb_net_wt, $outward_diff_gross, $outward_diff_net,$remarks,$created_by)
    {
        // Below are the transation details to be performed.
        // Collected information from function calling.
        //  1. Insert into tbl_outwardstock
        //  2. Update tbl_commodity_stock --> Current stock = current_stock - bags_count
        //  3. Reducce tbl_inward stock based on line item
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{
        //  1. Insert into tbl_outwardstock
        //Inserting entry into Outward Stock Table and get the insertId
        $query = "INSERT INTO tbl_outwardstock (customer_id,warehouse_id,compartment_id,inward_transport,commodity_id,current_bags_stock,outward_date,dc_no,dc_date,";
        $query .= "bags_out,vehicle_no,delivery_dtl,gross_wt,wb_gross_wt,gross_diff,net_wt,wb_net_wt,net_diff,remarks,created_by) ";
        $query .= "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $paramType = "iiiiiisssisiiiiiiisi";
        //$query = "INSERT INTO tbl_outwardstock (customer_id, outward_date, dc_no, dc_date, commodity_id, compartment_id, vehicle_no, current_bags_stock, bags_out, ";
        //$query .= " delivery_dtl, outward_gross_wt, outward_net_wt, outward_wb_gross_wt, outward_wb_net_wt, outward_diff_gross, outward_diff_net, remarks, created_by) ";
        //$query .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramValue = array(
                $customer_id, $warehouse_id, $compartment_id, $transport_id, $commodity_id, $current_bags_stock, $outward_date, $dc_no, $dc_date, 
                $bags_out, $vehicle_no, $delivery_dtl, $outward_gross_wt, $outward_wb_gross_wt, $outward_diff_gross, $outward_net_wt,  
                $outward_wb_net_wt, $outward_diff_net, $remarks, $created_by
                );
        $outwardInsertId = $this->db_handle->insert($query, $paramType, $paramValue);

        //  2. Update tbl_commodity_stock --> Current stock = current_stock - bags_count
            //Checking if Customer, Warehouse, Compartment, Transport_Mod and Commodity already existing in Commodity Stock Table
            $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND ";
            $sql .= "mod_transport = $transport_id AND commodity_id = $commodity_id LIMIT 1;";
            $result = $this->db_handle->runBaseQuery($sql);
            $count=mysqli_num_rows($result);
            if($count >0)
            {
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $bags_stock = 0;
                $bags_stock = $current_bags_stock - $bags_out;
                $gross_wt= $rows['gross_wt'];
                $gross_wt = $gross_wt - $outward_gross_wt;
                $net_wt = $rows['net_wt'];
                $net_wt = $net_wt - $outward_net_wt;
                $sql = "UPDATE tbl_commodity_stock SET bags_stock = $bags_stock, gross_wt = $gross_wt, net_wt = $net_wt, last_updated = $created_by, last_updateddatetime = '$last_UpdatedDateTime' ";
                $sql .= " WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $transport_id;";
                $stk = $this->db_handle->runBaseQuery($sql);    
            }   

        //  3. Reducce tbl_inward stock based on line item
        //$bags_out
            $sql = "SELECT * FROM tbl_inwardstock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $transport_id;";
            $result = $this->db_handle->runBaseQuery($sql);
            if (!empty($result)) 
            {
                $cur_stk = 0;
                $out_stk = 0;
                $id = 0 ;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {   
                    if ($bags_out > 0)
                    {
                        //Rows from inward Stock to update current bags out from each entry based on total.
                        $id = $row['id'];
                        $cur_stk = $row['current_bags_stock'];
                        $out_stk = $row['outward_bags_stock'];
                        //Check if cur_stk is greater than bags_out entered in form.
                        //If yes , then all bags will be accomodated from this line item only.
                        //  loop       1   2
                        //bags_out =  250  150
                        //cur_stk =   100  250
                        if($cur_stk>=$bags_out)
                        {
                            $sql = "UPDATE tbl_inwardstock SET outward_bags_stock = outward_bags_stock + $bags_out, current_bags_stock = current_bags_stock - $bags_out WHERE id = $id;";
                            $result1 = $this->db_handle->runBaseQuery($sql);
                            $bags_out = 0;
                        } 
                        else
                        {
                            $sql = "UPDATE tbl_inwardstock SET outward_bags_stock = outward_bags_stock + $cur_stk, current_bags_stock = current_bags_stock - $cur_stk WHERE id = $id;";
                            $result2 = $this->db_handle->runBaseQuery($sql);
                            $bags_out = $bags_out - $cur_stk;
                        }
                    }
                }
            }
            //Adding Transaction Log
            $activity = "New Outward Stock updated. OutwardStockID: $outwardInsertId.";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
            $paramType = "sii";
            $paramValue = array(
                $activity,
                $created_by,
                $outwardInsertId
            );
            $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
            $this->db_handle->commitTrans();
            return $outwardInsertId;
        }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
    }
    
    function editOutwardstock($outward_date, $dc_no, $dc_date, $commodity_id, $comp_id, $vehicle_no,$bags_out, $net_wtg,$wbridge_wtg,$wbridge_diff,$delivery_dtl,$remarks, $id) {
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_outwardstock SET outward_date = ?,dc_no = ?,dc_date = ?,commodity_id= ?, comp_id = ?,vehicle_no=?, bags_out= ?,  net_wtg=?,wbridge_wtg=?,wbridge_diff=?,delivery_dtl=?, last_pudated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
        $paramType = "sssiisisisisisi";
        $paramValue = array(
            $outward_date, 
            $dc_no, 
            $dc_date, 
            $commodity_id, 
            $comp_id, 
            $vehicle_no,
            $bags_out, 
            $net_wtg,
            $wbridge_wtg,
            $wbridge_diff,
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

    
    function getCompartmentList() 
    {
        $sql = "SELECT * FROm vw_outwardstock_combo;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getBagsStockInfo($comp_id,$comm_id)
    {
        $sql = "SELECT * FROM tbl_commodity_stock WHERE comp_id = $comp_id AND comm_id = $comm_id LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

     
    function getDeliveryList() 
    {
        $sql = "SELECT id,delivery_name from tbl_delivery where status ='A';";
        //$sql = "SELECT a.id as warehouse_id, a.warehouse_name, c.compartment_name FROM tbl_warehouse a, tbl_outwardlease b, tbl_compartment c";
        //$sql .= " WHERE a.id = b.warehouse_id AND a.id = c.warehouse_id AND DATE_FORMAT(b.lease_end,'%d-%b-%Y') >= DATE_FORMAT(Now(),'%d-%b-%Y');";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

     function Avlbagsout($bags_out,$comp_id) 
    {
        $sql = "SELECT a.comp_id,b.bags_out as avbl_capacity";
        $sql .= " FROM tbl_inwardstock a, tbl_outwardstock b  WHERE a.wcomp_id = b.id AND DATE_FORMAT(a.lease_end,'%Y-%m-%d') >= DATE_FORMAT(current_date,'%Y-%m-%d')";
        $sql .= " AND a.comp_id = $comp_id";
        $result = $this->db_handle->runBaseQuery($sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $bags_out = $row["bags_out"]; 
        if($bags_out > 0 AND $current_bags_stock <= $bags_out) // Check if the capacity entered is less than available capacity
        {   //Record Exists, existing outward lease active with remaining balance.
            return TRUE;            
        }
        else if ($avl_capacity == NULL) //No active outward lease for the warehouse.
        {
            $sql = " SELECT a.warehouse_id, b.capacity_mton as avbl_capacity FROM tbl_inwardlease a, tbl_warehouse b WHERE a.warehouse_id = b.id AND";
            $sql .= " DATE_FORMAT(a.expiry_date,'%Y-%m-%d') >= DATE_FORMAT(current_date,'%Y-%m-%d') AND a.warehouse_id = $warehouse_id";
            $result = $this->db_handle->runBaseQuery($sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $avl_capacity = $row["avbl_capacity"];     
            if($avl_capacity > 0 AND $lease_capacity_mton <= $avl_capacity) // Check if the capacity entered is less than available capacity
            {
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            return FALSE; 
        }
    }

    

    function getOutwardstockcommodityList() 
    {
        $sql = "SELECT id,concat(cargo_type,'-',commodity_name,'-',brand,'-',marking) as commodity,empty_bag_wt,bag_wt FROM vw_commodities WHERE status ='A';";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getStockList($customer_id,$warehouse_id,$compartment_id,$commodity_id,$transport_id) 
    {
       $sql = "SELECT * FROM vw_inwardstock_dtable ";
       $sql .= "WHERE customer_id =$customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND ";
       $sql .= "commodity_id = $commodity_id AND mod_transport = $transport_id;";
        $result = $this->db_handle->runBaseQuery($sql);
       return $result;
    } 

    function getTransportTypeList() 
    {
        $sql = "SELECT id,transport_mode FROM tbl_transport_mode  ORDER BY id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 
 
  
     
    function getAllOutwardstock($dt) {
        //$sql = "SELECT * FROM vw_outwardstock_list ORDER BY id";
        $sql = "SELECT * FROM vw_outwardstock_list WHERE date_format(transaction_date,'%d-%b-%Y') = '$dt' ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    //function getstockInfo($warehouse_id)
    //{
        //$sql = "SELECT compartment_name,capacity_sqft,capacity_mton, status FROM tbl_compartment WHERE warehouse_id = $warehouse_id";
        //$result = $this->db_handle->runBaseQuery($sql);
        //return $result;
   // }

}
?>