<?php 
#require_once ("class/DBController.php");
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");

class Employee
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addEmployee($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, $join_date, $exit_date, 
                $emp_status, $department, $designation, $img_des, $createdby) 
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_contact (f_name, l_name, dob, email, personal_email, mobile, add1, add2, city, state, pin, country, ";
        $query .= "ContactType_Id, join_date, exit_date, emp_status, department, designation, image, createdBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "ssssssssiisiisssiisi";
        $paramValue = array(
            $f_name, $l_name, $dob, $email, $personal_email,
            $mobile, $add1, $add2, $city, $state, $pin, $country,
            $ctype, $join_date, $exit_date, $emp_status, $department, $designation, $img_des, $createdby
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Employee/Consultanct is added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $createdby
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
    
    function editEmployee($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, 
                    $join_date, $exit_date, $emp_status, $department, $designation, $img_des, $emp_id) 
    {
        $last_updated=$_SESSION['id'];
        $last_updatedDateTime =  date("Y-m-d H:i:s");
        $query = "UPDATE tbl_contact SET f_name = ?,l_name = ?,dob = ?, email = ?, personal_email = ?, mobile = ?, add1 = ?, add2 = ?, city = ?, state = ?, pin = ?, country= ?, ";
        $query .= " ContactType_Id = ?, join_date = ?, exit_date = ?, emp_status= ?, department = ?, designation = ?, image = ?, last_updated = ?, last_updatedDateTime = ? WHERE id = ?";
        $paramType = "ssssssssiisiisssiisisi";
        $paramValue = array(
            $f_name, $l_name, $dob, $email, $personal_email,
            $mobile, $add1, $add2, $city, $state, $pin, $country,
            $ctype, $join_date, $exit_date, $emp_status, $department,
            $designation, $img_des, $last_updated, $last_updatedDateTime, 
            $emp_id
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "Updated Employee/Consultant details for ID: $emp_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
        return $insertId;
    }
    
    function disableEmployee($id) {
        $query = "DELETE FROM tbl_contact WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function validateEmail($email) {
        $sql = "SELECT email FROM vw_employeelist WHERE email = '$email'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //email Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    
    function validateEmailEdit($email,$employee_id) {
        $sql = "SELECT email FROM vw_employeelist WHERE id != $employee_id AND email = '$email'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //email Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    function getEmployeeById($id) {
        $query = "SELECT * FROM tbl_contact WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllEmployee() 
    {
        $sql="SELECT * FROM vw_employeelist";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    } 


}
?>