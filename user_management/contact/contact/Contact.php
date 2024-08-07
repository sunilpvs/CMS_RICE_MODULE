<?php 
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] .'\class\DBController.php');


class Contact
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addContact($name, $code, $status, $createdBy) {
        $query = "INSERT INTO tbl_contact (name,code,status,createdBy) VALUES (?, ?, ?, ?)";
        $paramType = "sssi";
        $paramValue = array(
            $name,
            $code,
            $status,
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editContact($name, $code, $status, $id) {
        $last_updated=$_SESSION['uid'];
        //$last_updatedDateTime =  date("Y-m-d H:i:s", time());        
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        //$last_updatedDateTime =  "CURRENT_TIMESTAMP()";
        // date('dd-mmm-yyyy h:i:s a', time());
        //$last_updatedDateTime=datetime();
        
        $query = "UPDATE tbl_contact SET name = ?,code = ?,status = ?,last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "sssssi";
        $paramValue = array(
            $name,
            $code,
            $status,
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
    
    function getAllContact() {
        $sql = "SELECT * FROM tbl_contact ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>