<?php 
 require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

class Commodity
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCommodity($commodity_name,$cargo_type, $brand,$marking,$empty_bag_wt,$inwardmode,$bag_wt,$created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_commodity (commodity_name,cargo_type,brand,marking,empty_bag_wt, bag_wt , status, created_by) VALUES (?,?,?,?,?,?,?,?)";
        $paramType = "sisssisi";
        $paramValue = array(
            $commodity_name,
            $cargo_type,
            $brand,
            $marking,
            $empty_bag_wt,
            $bag_wt,
            "A",
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        //Update Commodity for  new Inserted Row
        $query = "SELECT id,commodity FROM vw_commodities WHERE id =?;";
        $paramType = "i";
        $paramValue = array(
            $insertId
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $comm = $row['commodity'];
        $query = "UPDATE tbl_commodity SET commodity = '$comm' WHERE id = $insertId;";
        $this->db_handle->runBaseQuery($query);
        
        //Transaction Log update
        $activity = "New Commodity is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,log) VALUES(? ,?, ?);";
        $paramType = "sii";
        $paramValue = array(
            $activity,
            $created_by,
			$$insertId
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

      
    function editCommodity($commodity_name,$cargo_type,$brand,$marking,$empty_bag_wt,$bag_wt,$status,$id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updateddatetime =  date("Y-m-d H:i:s");        
        $query = "UPDATE tbl_commodity SET commodity_name = ?, cargo_type = ?, brand = ?, marking = ?, empty_bag_wt = ?, bag_wt=?, status=?, last_updated = ?, last_updateddatetime = ?  WHERE id = ?;";
        $paramType = "sisssssisi";
        $paramValue = array(
            $commodity_name,
            $cargo_type,
            $brand,
            $marking, 
            $empty_bag_wt,
            $bag_wt,
            $status,
            $last_updated,
            $last_updateddatetime,
            $id
        );    
        $this->db_handle->update($query, $paramType, $paramValue);
        //Update Commodity for  new Inserted Row
        $query = "SELECT id,commodity FROM vw_commodities WHERE id =?;";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $comm = $row['commodity'];
        $query = "UPDATE tbl_commodity SET commodity = '$comm' WHERE id = $id;";
        $this->db_handle->runBaseQuery($query);
        //Transaction log update
        $activity = "Updated commodity details for Commodity ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
    }


    function deleteCommodity($id) 
    {
        $query = "UPDATE tbl_commodity SET status = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function validateCommodityEdit($commodity_id, $commodity_name, $brand, $marking)
    {
        $sql = "SELECT commodity_name FROM vw_commodities WHERE id != $commodity_id  AND commodity_name = '$commodity_name' AND brand = '$brand' AND marking = '$marking';";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateCommodity($commodity_name, $brand, $marking) 
    {
        $sql = "SELECT commodity_name FROM vw_commodities WHERE commodity_name = '$commodity_name' AND brand = '$brand' AND marking = '$marking';";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    } 
   
    function getCommodityById($id) 
    {
        $query = "SELECT * FROM tbl_commodity WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );    
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllCommodity() 
    {
        $sql = "SELECT * FROM vw_commodities";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>