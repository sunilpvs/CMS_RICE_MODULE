<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Citi
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCiti( $city, $state, $country) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            $query = "INSERT INTO tbl_city (city,state,country) VALUES (?, ?, ?)";
            $paramType = "sii";
            $paramValue = array(
                $city, 
                $state, 
                $country
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

            $createdBy = $_SESSION['id'];
            $activity = "New City is added with ID: $insertId";
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
    
    function editCiti($city, $state, $country, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try{  
            $query = "UPDATE tbl_city SET city = ?,state=?,country=? WHERE id = ?";
            $paramType = "siii";
            $paramValue = array(
                $city, 
                $state, 
                $country,            
                $id
            );        
            $updateid = $this->db_handle->insert($query, $paramType, $paramValue);

            $activity = "Updated City details for City ID: $id";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
            $paramType = "si";
            $paramValue = array(
                $activity,
                $last_updated
            );
            $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
            $this->db_handle->commitTrans();
            return $updateid;
        }catch (\Throwable $e){
        // An exception has been thrown
        // We must rollback the transaction
        $this->db_handle->rollbackTrans();
        throw $e; // but the error must be handled anyway
        }
    }
    
    function deleteCiti($id) {
        $query = "UPDATE tbl_city SET city = 'D' WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateDuplicates_Add($city, $state, $country) 
    {
        $sql = "SELECT * FROM tbl_city WHERE city = '$city' AND (state = '$state' OR country = '$country');";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateDuplicates_Edit($city, $state, $country, $id) 
    {
        $sql = "SELECT * FROM tbl_city WHERE id != $id AND city = '$city' AND state = '$state' AND country = '$country'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //Record Exists with same Name or Code
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        
    function getCitiById($id) {
        $query = "SELECT * FROM tbl_city WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllCiti() {
        $sql = "SELECT a.id, a.city, b.state, c.country FROM tbl_city a, tbl_state b, tbl_country c WHERE a.state = b.id AND a.country = c.id ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>
