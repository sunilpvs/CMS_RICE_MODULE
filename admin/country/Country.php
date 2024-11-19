<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Countri
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCountri($country, $code, $currency) {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_country (country,code,currency) VALUES (?, ?, ?)";
        $paramType = "sss";
        $paramValue = array(
            $country,
            $code,
            $currency,
           
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Country is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $createdBy
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
    
    function editCountri($country, $code, $currency, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        try{
        $query = "UPDATE tbl_country SET country = ?,code = ?,currency=? WHERE id = ?";
        $paramType = "sssi";
        $paramValue = array(
            
            $country,
            $code,
            $currency,
          
            $id
        );        
        $updatedId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated country details for country ID: $id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        $this->db_handle->commitTrans();
        return $updatedId;
        }catch (\Throwable $e){
        // An exception has been thrown
        // We must rollback the transaction
        $this->db_handle->rollbackTrans();
        throw $e; // but the error must be handled anyway
    }
    }
    
    //function deletecountry($id) {
        //$query = "UPDATE tbl_country SET country = 'D' WHERE id = ?";
        //$paramType = "i";
        //$paramValue = array(
            //$id
        //);
        //$this->db_handle->update($query, $paramType, $paramValue);
    //}

    function validateDuplicates_Add($country, $code, $currency)
    {
        $sql = "SELECT * FROM tbl_country WHERE (country = '$country' OR code = '$code' OR currency = '$currency')";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateDuplicates_Edit($country, $code, $currency, $id)
    {
        $sql = "SELECT * FROM tbl_country WHERE id != $id AND (country = '$country' OR code = '$code' OR currency = '$currency')";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getcountriById($id) {
        $query = "SELECT * FROM tbl_country WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllCountri() {
        $sql = "SELECT * FROM tbl_country ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>