<?php 
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Entity
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addEntity($entity_name, $cc_code, $cin, $incorp_date, $gst_no, $add1, $add2, $city, $state, $country, $pin, $primary_contact, $status, $created_by)
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            //cc_code, cc_type, entity_id, incorp_date, gst_no, add1, add2, city, state, country, pin, primary_contact, status
            $cc_type = 1; // CostCenter Type during Entity Entry = 1 which is Head - Office
            //Create new Entity record
            $query = "INSERT INTO tbl_entity (entity_name, cin, incorp_date, status, created_by) VALUES (?,?,?,?,?)";
            $paramType = "sssii";
            $paramValue = array(
                $entity_name,
                $cin,
                $incorp_date,      
                $status,    
                $created_by
            );
            $entity_Id = $this->db_handle->insert($query, $paramType, $paramValue);
            //Entry into CostCenter - Head-Office Data for newly created entity data
            $query = "INSERT INTO tbl_costcenter (cc_code, cc_type, entity_id, incorp_date, gst_no, add1, add2, city, state, country, pin, primary_contact, status, created_by) ";
            $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $paramType = "siissssiiisiii";
            $paramValue = array(
                $cc_code,
                $cc_type,
                $entity_Id,
                $incorp_date,
                $gst_no,
                $add1,
                $add2,
                $city,
                $state,
                $country,
                $pin,
                $primary_contact,
                $status,    
                $created_by
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
            //Entry into Activity log
            $activity = "New Entity is added with ID: $entity_Id";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
            $paramType = "si";
            $paramValue = array(
                $activity,
                $created_by
            );
            $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
            $this->db_handle->commitTrans();
            return $insertId;
        }catch (\Throwable $e)
        {
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
    }
    
    function editEntity($entity_name, $cin, $incorp_date, $status, $entity_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            $query = "UPDATE tbl_entity SET entity_name = ?, cin = ?, incorp_date = ?, status= ?, last_Updated = ?, last_updateddatetime = ? WHERE id = ?";
            $paramType = "sssiisi";
            $paramValue = array(
                $entity_name,
                $cin,
                $incorp_date,
                $status,
                $last_updated,
                $last_updatedDateTime,
                $entity_id
            );        
            $updateId = $this->db_handle->update($query, $paramType, $paramValue);
            //Entry into Activity log
            $activity = "Updated entity details for Entity ID: $entity_id";
            $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
            $paramType = "si";
            $paramValue = array(
                $activity,
                $last_updated
            );
            $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
            $this->db_handle->commitTrans();
            return $updateId;
        }catch (\Throwable $e)
        {
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
    }
    
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
