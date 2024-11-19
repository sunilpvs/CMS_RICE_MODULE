<?php 
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Entity
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addEntity($entity_name, $cin, $incorp_date, $add1, $add2, $city, $state, $pin, $country, $status, $created_by) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_entity (entity_name,cin,incorp_date,add1,add2,city,state,pin,country,status,created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssiiiisi";
        $paramValue = array(
            $entity_name,
            $cin,
            $incorp_date,      
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $status,    
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Entity is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $created_by
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
    
    function editEntity($add1,$add2,$state,$city, $pin,$country,$status,$entity_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
   
        $query = "UPDATE tbl_entity SET add1 = ?, add2 = ?, city = ?, state= ?, pin = ?, country = ?, status = ? , last_Updated = ?, last_updateddatetime = ? WHERE id = ?";
        $paramType = "ssiiiisisi";
        $paramValue = array(
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $status,    
            $last_updated,
            $last_updatedDateTime,
            $entity_id
        );        
        $this->db_handle->update($query, $paramType, $paramValue);
    
        $activity = "Updated entity details for Entity ID: $entity_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
    }
    
    // function deleteEntity($id) {
    //     $query = "DELETE FROM tbl_entity  WHERE id = ?";
    //     $paramType = "i";
    //     $paramValue = array(
    //         $id
    //     );
    //     $this->db_handle->update($query, $paramType, $paramValue);
    // }

    function validateEntityname($entity_name) {
        $sql = "SELECT entity_name FROM vw_entity WHERE entity_name = '$entity_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //name Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateEntitynameEdit($entity_name) {
        $sql = "SELECT entity_name FROM vw_entity WHERE id!= $entity_id AND entity_name = '$entity_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //name Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateCin($cin) {
        $sql = "SELECT cin FROM vw_entity WHERE cin = '$cin'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cin Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    function validateCinEdit($cin) {
        $sql = "SELECT cin FROM vw_entity WHERE id!= $entity_id AND cin = '$cin'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //name Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function getEntityById($id) {
        $query = "SELECT * FROM tbl_entity WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllentity() {
        $sql = "SELECT * FROM vw_entity";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>
