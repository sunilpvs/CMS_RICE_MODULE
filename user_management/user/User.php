<?php 
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class User
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function createUser ($user_name, $email, $user_role_id, $contact_id, $code) 
    {
        $user_status = "A";
        $status = "notverified";
        $createdBy = $_SESSION['id'];
        $hash_pwd = password_hash("PVS@123000", PASSWORD_BCRYPT);

        $query = "INSERT INTO tbl_users (user_name, email, user_role_id, user_status, contact_id, code, status, createdBy, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
        $paramType = "ssisiisis";
        $paramValue = array(
            $user_name,
            $email,
            $user_role_id,
            $user_status,
            $contact_id,
            $code,
            $status,
            $createdBy,
            $hash_pwd
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New User is created with user_id : $user_name";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $createdBy
        );
        return $insertId;
    }
    
    function editUser($user_status,$user_role, $user_id)
    {
        $activity = "User status and role updated for user_id : $user_id";
        $last_updatedby = $_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");

        $query = "UPDATE tbl_users SET user_status = ?, user_role_id = ?, Last_UpdatedBy = ?, Last_UpdatedDateTime = ? WHERE id = ?";
        $paramType = "siisi";
        $paramValue = array(
            $user_status,
            $user_role,
            $last_updatedby,
            $last_updatedDateTime,
            $user_id
        );
        $updateId = $this->db_handle->insert($query, $paramType, $paramValue);

        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES (? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updatedby
        );
        $insertId = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }

    function initiatePasswordReset($user_id, $code) 
    {       
        $activity = "Password reset performed for user id : $user_id";
        $last_updatedby = $_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        $status = "notverified";
        $query = "UPDATE tbl_users SET code = ?, status = ? , Last_UpdatedBy = ?, Last_UpdatedDateTime = ? WHERE id = ?"; 
        $paramType = "isisi";
        $paramValue = array(
            $code,
            $status,
            $last_updatedby,
            $last_updatedDateTime,
            $user_id
        );
        $updateId = $this->db_handle->insert($query, $paramType, $paramValue);

        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id,datetime) VALUES (? ,?, ?);";
        $paramType = "sis";
        $paramValue = array(
            $activity,
            $last_updatedby,
            $last_updatedDateTime
        );
        $insertId = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
   
    function getUserById($id) {
        $query = "SELECT * FROM vw_userlist WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function validateUName($uname) {
        $sql = "SELECT user_name FROM vw_user_validation WHERE user_name = '$uname'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //User_Id Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateUNameEdit($uname) {
        $sql = "SELECT user_name FROM vw_user_validation WHERE id!= $u_id AND user_name = '$uname'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //User_Id Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function getContactList() {
        $sql = "SELECT * FROM vw_user_create_list";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllUserList() {
        $sql = "SELECT * FROM vw_userlist ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>