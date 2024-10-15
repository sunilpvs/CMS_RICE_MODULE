<?php 
date_default_timezone_set('Asia/Kolkata');
#require_once ("class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] .'\class\DBController.php');


class Branch
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addBranch($f_name, $l_name, $dob, $email, $mobile, $add_ref1, $add_ref2, $createdBy) {
        $query = "INSERT INTO tbl_branch (f_name,l_name,dob,email,mobile,add_ref1,add_ref2,createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssi";
        $paramValue = array(
            $f_name,
            $l_name,
            $dob,
            $email,
            $mobile,
            $add_ref1,
            $add_ref2,
            $createdBy
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editBranch($name, $code, $status, $id) {
        $last_updated=$_SESSION['uid'];
        //$last_updatedDateTime =  date("Y-m-d H:i:s", time());        
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        //$last_updatedDateTime =  "CURRENT_TIMESTAMP()";
        // date('dd-mmm-yyyy h:i:s a', time());
        //$last_updatedDateTime=datetime();
        
        $query = "UPDATE tbl_branch SET f_name = ?,l_name = ?,dob = ?, email = ?, mobile = ?, add_ref1 = ?, add_ref2 = ?,last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "sssssssi";
        $paramValue = array(
            $f_name,
            $l_name,
            $dob,
            $email,
            $mobile,
            $add_ref1,
            $add_ref2,
            $last_updated,
            $last_updatedDateTime,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteBranch($id) {
        $query = "DELETE FROM tbl_branch WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getBranchById($id) {
        $query = "SELECT * FROM tbl_branch WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllBranch() {
        $sql = "SELECT * FROM tbl_branch ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>