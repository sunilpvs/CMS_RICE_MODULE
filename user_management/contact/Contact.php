<?php 
#require_once ("class/DBController.php");
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");


class Contact
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addContact($f_name, $l_name, $dob, $email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, $createdBy) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_contact (f_name,l_name,dob,email,mobile,add1,add2,city,state,pin,country,ContactType_Id,createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssiisiii";
        $paramValue = array(
            $f_name,
            $l_name,
            $dob,
            $email,
            $mobile,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $ctype,
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        $this->db_handle->commitTrans();
            return $insertId;
            }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
        }
    
    function editContact($f_name, $l_name, $dob, $email, $mobile,  $add1, $add2, $city, $state, $pin, $country, $ctype, $id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");        
        $query = "UPDATE tbl_contact SET f_name = ?,l_name = ?,dob = ?, email = ?, mobile = ?, add1 = ?, add2 = ?, city = ?, state = ?, pin = ?, country=?, ";
        $query .= " ContactType_Id = ?, last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "sssssssiisiiisi";
        $paramValue = array(
            $f_name,
            $l_name,
            $dob,
            $email,
            $mobile,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $ctype,
            $last_updated,
            $last_updatedDateTime,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteContact($id) {
        $query = "DELETE FROM tbl_contact WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getContactById($id) {
        $query = "SELECT * FROM tbl_contact WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateEmail($email) {
        $sql = "SELECT email FROM vw_contact_list WHERE email = '$email'"; 
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //email Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    
    function validateEmailEdit($email,$contact_id) {
        $sql = "SELECT email FROM vw_contact_list WHERE id != $contact_id  AND email = '$email'"; 
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //email Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function getContactTypesList() {
        $sql = "SELECT * FROM tbl_contacttype WHERE (id != 1 AND id != 3 AND id != 5) ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllContact() {
        $sql="SELECT * FROM vw_contact_list WHERE (ContactType != 'Employee' AND ContactType != 'Consultant')";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
    
}
?>