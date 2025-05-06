<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

class Outwardstock
{
    private $db_handle;
    function __construct() 
    {
        $this->db_handle = new DBController();
    }
    
    function addOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, $trans_date, $dc_no, $dc_date, 
                                $vehicle_no, $delivery_to, $wb_gross_wt, $gross_wt, $gross_diff, $wb_net_wt, $net_wt, $net_diff, $remarks, $entity_id, $created_by)
    {
        // Below are the transation details to be performed.
        // Collected information from function calling.
        //  1. Insert into tbl_outwardstock
        //  2. Check if record exist in tbl_commodity_stock, if yes then Update tbl_commodity_stock by calling revalidateStockl method()
        //  3. Else make a new entry into tbl_commodity_stock
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{
                //  1. Insert into tbl_outwardstock
                //Inserting entry into Outward Stock Table and get the insertId
                $query = "INSERT INTO tbl_outwardstock (customer_id, warehouse_id, compartment_id, commodity_id, mod_transport, bags_stock, trans_date, dc_no, dc_date,";
                $query .= "vehicle_no, delivery_to, wb_gross_wt, gross_wt, gross_diff, wb_net_wt, net_wt, net_diff, remarks, entity_id, created_by) ";
                $query .= "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
                $paramType = "iiiiiissssiiiiiiisii";
                //$query = "INSERT INTO tbl_outwardstock (customer_id, outward_date, dc_no, dc_date, commodity_id, compartment_id, vehicle_no, current_bags_stock, bags_out, ";
                //$query .= " delivery_dtl, outward_gross_wt, outward_net_wt, outward_wb_gross_wt, outward_wb_net_wt, outward_diff_gross, outward_diff_net, remarks, created_by) ";
                //$query .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $paramValue = array(
                        $customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, 
                        $bags_stock, $trans_date, $dc_no, $dc_date, $vehicle_no,
                        $delivery_to, $wb_gross_wt, $gross_wt, $gross_diff, $wb_net_wt, $net_wt, $net_diff, 
                        $remarks, $entity_id, $created_by
                    );
                $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

                //2. Checking if Customer, Warehouse, Compartment, Transport_Mod and Commodity already existing in Commodity Stock Table
                $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND ";
                $sql .= "mod_transport = $mod_transport AND commodity_id = $commodity_id LIMIT 1;";
                
                $result = $this->db_handle->runBaseQuery($sql);
                $count=mysqli_num_rows($result);
                if($count >0)
                {
                    //Record Exists for outward stock for combination of customer, warehouse, compartment, transport and commodity.
                    //Call revalidate stock method.
                    $this->revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport);
                    //Adding Transaction Log
                    $activity = "New Outward Stock updated. OutwardStockID: $insertId.";
                    $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
                    $paramType = "sii";
                    $paramValue = array(
                        $activity,
                        $created_by,
                        $insertId
                    );
                    $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
                    $this->db_handle->commitTrans();
                    return $insertId;

                }
                else
                {
                    $insertId = -1;
                    $this->db_handle->rollbackTrans();
                    return $insertId;
                }

        }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
    }
    
    function editOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, $trans_date, 
                            $dc_no, $dc_date, $vehicle_no, $delivery_to, $wb_gross_wt, $gross_wt, $gross_diff, $wb_net_wt, $net_wt, 
                            $net_diff, $remarks, $entity_id, $outwardstock_id)
    {
        // Below are the transation details to be performed.
        // Collected information from function calling.
        //  1. Update into tbl_outwardstock
        //  2. Check if any changes in customer/warehouse/compartment/commodity/mod_transport if yes
        //  3. If 2 is yes, then call revalidateStock procedure for new and old values.
        //  4. Else call revalidateStock for new values only.   
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");

        $this->db_handle->beginTrans();
        try{
                //0. Get tbl_outwardstock details based on outwardstock_id
                $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND ";
                $sql .= "compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $mod_transport LIMIT 1;";
                $result = $this->db_handle->runBaseQuery($sql);
                $count=mysqli_num_rows($result);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                if($count >0)
                {
                    $cust_old = $row['customer_id'];
                    $wh_old = $row['warehouse_id'];
                    $comp_old = $row['compartment_id'];
                    $mod_old = $row['mod_transport'];
                    $comm_old = $row['commodity_id'];    
                }
                
                //1. Update tbl_outwardstock data based on id.
                //Update the record with new values
                $sql="";
                $sql="UPDATE tbl_outwardstock SET ";
                $sql .= "customer_id = $customer_id, warehouse_id = $warehouse_id, compartment_id = $compartment_id, ";
                $sql .= "commodity_id = $commodity_id, mod_transport = $mod_transport, bags_stock = $bags_stock,";
                $sql .= "trans_date = '$trans_date', dc_no = '$dc_no', dc_date = '$dc_date', vehicle_no = '$vehicle_no',";
                $sql .= "delivery_to = $delivery_to, wb_gross_wt = $wb_gross_wt, gross_wt = $gross_wt, gross_diff = $gross_diff,";
                $sql .= "wb_net_wt = $wb_net_wt, net_wt = $net_wt, net_diff = $net_diff, remarks = '$remarks', entity_id = $entity_id,";
                $sql .= "last_updated = $last_updated, last_updateddatetime = '$last_UpdatedDateTime'";
                $sql .= " WHERE id = $outwardstock_id";
                $editId = $this->db_handle->runBaseQuery($sql);    

                if($customer_id != $cust_old || $warehouse_id != $wh_old || $compartment_id != $comp_old || $mod_transport != $mod_old || $commodity_id != $comm_old)
                {
                    // If there are any changes in customer, warehouse, compartment, transport and commodity then we need to update the commodity stock table revering
                    // the previous entry and then update the new entry.
                        //Update tbl_Commodity_Stock table with revisions.
                    //Revise Commodity stock based on old values and new values
                    $this->revalidateStock($cust_old, $wh_old, $comm_old, $comp_old, $mod_old);
                    //Get latest stock and wts.
                    $this->revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport);
                }
                else
                {
                    //Get latest stock and wts.
                    $this->revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport);
                }
                $this->db_handle->commitTrans();
                return $editId;
            }catch (\Throwable $e){
                // An exception has been thrown
                // We must rollback the transaction
                $this->db_handle->rollbackTrans();
                throw $e; // but the error must be handled anyway
            }                         
    }       
    
    function editOutwardstock_old($customer_id, $warehouse_id, $compartment_id, $commodity_id, $transport_id, $outward_date, $dc_no, $dc_date, 
                        $bags_out, $vehicle_no, $delivery_dtl, $outward_gross_wt, $outward_wb_gross_wt, $outward_diff_gross, $outward_net_wt,
                        $outward_wb_net_wt, $outward_diff_net, $remarks, $outwardstock_id)
    {
        // Below are the transation details to be performed.
        // Collected information from function calling.
        //  1. Update into tbl_outwardstock
        //  2. Update tbl_commodity_stock --> Current stock = current_stock - bags_count
        //  3. Reducce tbl_inward stock based on line item
        $last_updated=$_SESSION['id'];
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{
                // 0. Get tbl_outwardstock details based on outwardstock_id
                $query = "SELECT * FROM tbl_outwardstock WHERE id = $outwardstock_id;";
                $result = $this->db_handle->runBaseQuery($query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $customer_ori = $row['customer_id'];
                $warehouse_ori = $row['warehouse_id'];
                $compartment_ori = $row['compartment_id'];
                $transport_ori = $row['inward_transport'];
                $commodity_ori = $row['commodity_id'];
                $bags_out_ori = $row['bags_out'];
                $current_bags_stock = $row['current_bags_stock'];

                if($customer_id != $customer_ori || $warehouse_id != $warehouse_ori || $compartment_id != $compartment_ori || $transport_id != $transport_ori || $commodity_id != $commodity_ori)
                {
                    // If there are any changes in customer, warehouse, compartment, transport and commodity then we need to update the commodity stock table revering
                    // the previous entry and then update the new entry.
                    $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_ori AND warehouse_id = $warehouse_ori AND compartment_id = $compartment_ori AND ";
                    $sql .= "mod_transport = $transport_ori AND commodity_id = $commodity_ori LIMIT 1;";
                    $result = $this->db_handle->runBaseQuery($sql);
                    $count=mysqli_num_rows($result);
                    if($count >0)
                    {
                        //Record Exists, existing outward lease active with remaining balance.
                        //Update the record with new values
                        $bags_stock = 0;
                        $bags_stock = $current_bags_stock - $bags_out_ori + $bags_out;
                        $sql = "UPDATE tbl_commodity_stock SET bags_stock = bags_stock - ($bags_out_ori - $bags_out), last_updated = $last_updated, last_updateddatetime = '$last_UpdatedDateTime' ";
                        $sql .= " WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $transport_id;";
                        $stk = $this->db_handle->runBaseQuery($sql);    
                    }
                }
                
                    // 1. Update tbl_commodity_stock --> Current stock = current_stock - bags_count
                    //Checking if Customer, Warehouse, Compartment, Transport_Mod and Commodity already existing in Commodity Stock Table
                    $sql = "SELECT * FROM tbl_commodity_stock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND ";
                    $sql .= "mod_transport = $transport_id AND commodity_id = $commodity_id LIMIT 1;";
                    $result = $this->db_handle->runBaseQuery($sql);
                    $count=mysqli_num_rows($result);
                    if($count >0)
                    {
                        //Record Exists, existing outward lease active with remaining balance.
                        //Update the record with new values

                        $query = "UPDATE tbl_outwardstock SET customer_id = ?, warehouse_id = ?, compartment_id = ?, inward_transport = ?, commodity_id = ?, ";
                        //  1. Update tbl_outwardstock
                        //Updating entry into Outward Stock Table and get the updateID
                        $query = "UPDATE tbl_outwardstock SET customer_id = ?, warehouse_id = ?, compartment_id = ?, inward_transport = ?, commodity_id = ?, ";
                        
                        $query .="current_bags_stock = ?, outward_date = ?, dc_no = ?, dc_date = ?,";
                        $query .="";
                        $query .="";
                        $query .="";
                        $query .="";
                    }
                    //$query = "UPDATE tbl_outwardstock SET outward_date = ?,dc_no = ?,dc_date = ?,commodity_id= ?, comp_id = ?,vehicle_no=?, bags_out= ?,  net_wtg=?,wbridge_wtg=?,wbridge_diff=?,delivery_dtl=?, last_pudated = ? ,Last_UpdatedDateTime = ? WHERE id = ?";
        
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
                }catch (\Throwable $e){
                    // An exception has been thrown
                    // We must rollback the transaction
                    $this->db_handle->rollbackTrans();
                    throw $e; // but the error must be handled anyway
                }        
    }
            
    function deleteOutwardstock($id) 
    {
        $query = "DELETE FROM tbl_outwardstock WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
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

    function getOutwardstockById($id) 
    {
        $query = "SELECT * FROM tbl_outwardstock WHERE id = ?";
        $paramType = "i";
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
        $sql = "SELECT id, name from tbl_delivery_details;";
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
        $sql = "SELECT id,concat(cargo_type,'-',commodity_name,'-',brand,'-',marking) as commodity,empty_bag_wt,bag_wt FROM vw_commodities WHERE status ='Active';";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getStockList($customer_id,$warehouse_id,$compartment_id,$commodity_id,$transport_id) 
    {
        $sql = "SELECT (SELECT sum(bags_stock) as bags_count FROM vw_inwardstock WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND commodity_id = $commodity_id AND mod_transport = $transport_id) - ";
        $sql .= "(SELECT SUM(bags_stock) as bags_count FROM vw_outwardstock_list WHERE customer_id = $customer_id AND warehouse_id = $warehouse_id AND compartment_id = $compartment_id AND commodity_id = $commodity_id AND transport_id = $transport_id) as bags_count";

        //$sql = "SELECT sum(inward_bags_stock) as inward_bags_count, sum(current_bags_stock) as current_bags_count, sum(outward_bags_stock) as outward_bags_count ";
        //$sql .= "FROM vw_inwardstock ";
        //$sql .= "WHERE customer_id =$customer_id AND warehouse_id = $warehouse_id AND comp_id = $compartment_id AND ";
        //$sql .= "commodity_id = $commodity_id AND transport_id = $transport_id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 

    function getTransportTypeList() 
    {
        $sql = "SELECT id,transport_mode FROM tbl_transport_mode  ORDER BY id;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 
 
    function getAllOutwardstock($customer,$warehouse,$compartment,$transport) {
        //$sql = "SELECT * FROM vw_outwardstock_list ORDER BY id";
        $sql = "SELECT * FROM vw_outwardstock_list WHERE customer_id = $customer AND warehouse_id = $warehouse AND compartment_id = $compartment AND transport_id = $transport ORDER BY  id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
  
     
    // function getAllOutwardstock($dt) {
    //     //$sql = "SELECT * FROM vw_outwardstock_list ORDER BY id";
    //     $sql = "SELECT * FROM vw_outwardstock_list WHERE date_format(transaction_date,'%d-%b-%Y') = '$dt' ORDER BY id";
    //     $result = $this->db_handle->runBaseQuery($sql);
    //     return $result;
    // }

    //function getstockInfo($warehouse_id)
    //{
        //$sql = "SELECT compartment_name,capacity_sqft,capacity_mton, status FROM tbl_compartment WHERE warehouse_id = $warehouse_id";
        //$result = $this->db_handle->runBaseQuery($sql);
        //return $result;
   // }


}

?>