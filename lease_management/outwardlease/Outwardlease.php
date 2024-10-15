<?php 
date_default_timezone_set('Asia/Kolkata');
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
 

class Outwardlease
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
   								
    function addOutwardlease($warehouse_id, $customer_id, $lease_model, $lease_start, $lease_end, 
                $lease_capacity_sqft, $lease_capacity_mton, $daily_rate_sqft, $daily_rate_mton, $lease_status, $lease_days, $cost_sqft, $cost_mton, $total_cost, $created_By) 
    {   
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $sql = "SELECT used_sqft,used_mton,avl_sqft,avl_mton FROM tbl_warehouse WHERE id = $warehouse_id;";
        $result = $this->db_handle->runBaseQuery($sql);
        if (!empty($result))
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        $used_sqft = $row['used_sqft'];
        $used_mton = $row['used_mton'];
        $avl_sqft = $row['avl_sqft'];
        $avl_mton = $row['avl_mton'];

        if ($lease_model == 1) //Dedicated
        {
            $before_capacity_sqft = $avl_sqft; 
            $before_capacity_mton = $avl_mton;
            $tmp_sqft = $lease_capacity_sqft;
            $lease_capacity_mton = $tmp_sqft /=4; 
            $used_sqft = $used_sqft + $lease_capacity_sqft; 
            $tmp_sqft = $used_sqft;
            $used_mton = $tmp_sqft /=4; 
            $avl_sqft = $avl_sqft - $lease_capacity_sqft;
            $tmp_sqft = $avl_sqft;
            $avl_mton = $tmp_sqft /=4;
        }
        elseif($lease_model == 2) //Common)
        {
            $before_capacity_sqft = $avl_sqft; 
            $before_capacity_mton = $avl_mton;
            $tmp_mton = $lease_capacity_mton;
            $lease_capacity_sqft = ($tmp_mton*4);
            $used_mton = $used_mton + $lease_capacity_mton; 
            $tmp_mton = $used_mton;
            $used_sqft = ($tmp_mton*4);
            $avl_mton = $avl_mton - $lease_capacity_mton;
            $tmp_mton = $avl_mton;
            $avl_sqft = ($tmp_mton*4);
        }

        $query = "INSERT INTO tbl_outwardlease (warehouse_id, customer_id, lease_model, lease_start, lease_end,";
        $query .= " before_capacity_sqft,lease_capacity_sqft,after_capacity_sqft,before_capacity_mton,lease_capacity_mton,after_capacity_mton,";
        $query .= " daily_rate_sqft, daily_rate_mton, lease_status, lease_days,cost_sqft, cost_mton,total_cost, created_by)";
        $query .= " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $paramType = "iiisssssssssssisssi";
        $paramValue = array(
            $warehouse_id,
            $customer_id,
            $lease_model,
            $lease_start,
            $lease_end,
            $before_capacity_sqft,
            $lease_capacity_sqft,
            $avl_sqft,
            $before_capacity_mton,
            $lease_capacity_mton,
            $avl_mton,
            $daily_rate_sqft,
            $daily_rate_mton,
            $lease_status,
            $lease_days,
            $cost_sqft, 
            $cost_mton,
            $total_cost,
            $created_By
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        //Updating Capacities in Warehouse table
        $sql = "UPDATE tbl_warehouse SET used_sqft = $used_sqft, used_mton = $used_mton, avl_sqft = $avl_sqft, avl_mton = $avl_mton  WHERE id = $warehouse_id;"; 
        $result = $this->db_handle->runBaseQuery($sql);
        //Update Contract_Id of Inward Lease for  new Inserted Row
        $query = "SELECT id,prefix FROM tbl_outwardlease WHERE id =?;";
        $paramType = "i";
        $paramValue = array(
            $insertId
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $prefix = $row['prefix'];
        $id = $row['id'];
        $contract = $prefix . $id;
        $query = "UPDATE tbl_outwardlease SET lease_contract_id = '$contract' WHERE id = $id;";
        $this->db_handle->runBaseQuery($query);
        //Updating Transaction Audit
        $activity = "New Outward Lease is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $created_By,
			$insertId
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

    
    
    function editOutwardlease($warehouse_id, $customer_id, $lease_contract_id, $lease_model, $compartment_code, $lease_start, $lease_end, 
    $lease_capacity_sqft, $lease_capacity_mton, $daily_rate_sqft, $daily_rate_mton, $lease_status, $id) {
        $last_updated=$_SESSION['id'];
        $last_updateddatetime =  date("Y-m-d H:i:s");
        
        $query = "UPDATE tbl_outwardlease SET warehouse_id = ?,customer_id = ?,lease_contract_id = ?,lease_model= ?, compartment_code = ?, lease_start = ?, lease_end = ?, lease_capacity_sqft=?, lease_capacity_mton = ?, daily_rate_sqft = ?, daily_rate_mton = ?, lease_status = ?, lease_days =?,cost_sqft = ?, cost_mton = ?,total_cost = ?,last_updated = ? ,last_updateddatetime = ? WHERE id = ?";
        
        $paramType = "iisisssssssiiiiiisi";
        $paramValue = array(
            $warehouse_id,
            $customer_id,
            $lease_contract_id,
            $lease_model,
            $compartment_code,
            $lease_start,
            $lease_end,
            $lease_capacity_sqft,
            $lease_capacity_mton,
            $daily_rate_sqft,
            $daily_rate_mton,
            $lease_status, 
            $lease_days,
            $cost_sqft, 
            $cost_mton,
            $total_cost,
            $last_updated,
            $last_updateddatetime,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getOutwardleaseById($id) 
    {
        $query = "SELECT * FROM tbl_outwardlease WHERE id = ?";
        $paramType = "s";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllOutwardlease() {
        $sql = "SELECT * FROM vw_outwardleases ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    //Check and Validate Available Capacity before leasing.
    function validateCapacity($warehouse_id) 
    {
        $sql = "SELECT warehouse_id,sum(lease_capacity_sqft) as sqft, sum(lease_capacity_mton) as mton FROM tbl_outwardlease ";
        $sql .= " WHERE DATE_FORMAT(lease_end,'%d-%b-%Y') >= DATE_FORMAT(CURRENT_TIMESTAMP,'%d-%b-%Y') AND warehouse_id = $warehouse_id;";

        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function validateLeasecapacitysqft($lease_capacity_sqft,$warehouse_id) 
    {
        $sql = "SELECT a.warehouse_id,(b.capacity_sqft-sum(a.lease_capacity_sqft)) as avbl_capacity";
        $sql .= " FROM tbl_outwardlease a, tbl_warehouse b  WHERE a.warehouse_id = b.id AND DATE_FORMAT(a.lease_end,'%Y-%m-%d') >= DATE_FORMAT(current_date,'%Y-%m-%d')";
        $sql .= " AND a.warehouse_id = $warehouse_id"; 
        $result = $this->db_handle->runBaseQuery($sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $avl_capacity = $row["avbl_capacity"]; 
        if($avl_capacity > 0 AND $lease_capacity_sqft <= $avl_capacity) // Check if the capacity entered is less than available capacity
        {   //Record Exists, existing outward lease active with remaining balance.
            return TRUE;            
        }
        else if ($avl_capacity == NULL) //No active outward lease for the warehouse.
        {
            $sql = " SELECT a.warehouse_id, b.capacity_sqft as avbl_capacity FROM tbl_inwardlease a, tbl_warehouse b WHERE a.warehouse_id = b.id AND";
            $sql .= " DATE_FORMAT(a.expiry_date,'%Y-%m-%d') >= DATE_FORMAT(current_date,'%Y-%m-%d') AND a.warehouse_id = $warehouse_id";
            $result = $this->db_handle->runBaseQuery($sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $avl_capacity = $row["avbl_capacity"];     
            if($avl_capacity > 0 AND $lease_capacity_sqft <= $avl_capacity) // Check if the capacity entered is less than available capacity
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
    

    function validateLeasecapacitymton($lease_capacity_mton,$warehouse_id) 
    {
        $sql = "SELECT a.warehouse_id,(b.capacity_mton-sum(a.lease_capacity_mton)) as avbl_capacity";
        $sql .= " FROM tbl_outwardlease a, tbl_warehouse b  WHERE a.warehouse_id = b.id AND DATE_FORMAT(a.lease_end,'%Y-%m-%d') >= DATE_FORMAT(current_date,'%Y-%m-%d')";
        $sql .= " AND a.warehouse_id = $warehouse_id";
        $result = $this->db_handle->runBaseQuery($sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $avl_capacity = $row["avbl_capacity"]; 
        if($avl_capacity > 0 AND $lease_capacity_mton <= $avl_capacity) // Check if the capacity entered is less than available capacity
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
    
    function validateClientstartdate($lease_start,$warehouse_id) 
    {
        $sql = " SELECT warehouse_id,start_date,expiry_date FROM tbl_inwardlease WHERE warehouse_id = $warehouse_id AND";
        $sql .= " '$lease_start' >= DATE_FORMAT(start_date,'%Y-%m-%d') AND";
        $sql .= " '$lease_start' <= DATE_FORMAT(expiry_date,'%Y-%m-%d')";

        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0)
        {   //Record Exists
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function validateClientenddate($lease_end,$warehouse_id) 
    {

        $sql = " SELECT warehouse_id,start_date,expiry_date FROM tbl_inwardlease WHERE warehouse_id = $warehouse_id AND";
        $sql .= " '$lease_end' >= DATE_FORMAT(start_date,'%Y-%m-%d') AND";
        $sql .= " '$lease_end' <= DATE_FORMAT(expiry_date,'%Y-%m-%d')";

        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0)
        { //Record Exists
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
?>