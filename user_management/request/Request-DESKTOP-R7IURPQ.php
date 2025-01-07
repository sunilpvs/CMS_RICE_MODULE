<?php 
    #require_once ("class/DBController.php");
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/email/Email.php");

class Request
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addAccessRequest($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $contacttype_id, $join_date, 
                    $exit_date, $entity_id, $department, $designation, $emp_status, $approver_id, $approver_name, $approver_email, $message, $status) 
    {
        //$last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            $query = "INSERT INTO tbl_reqaccess (f_name, l_name, dob, email, personal_email, mobile, add1, add2, city, state, pin, country, ";
            $query .= "contactType_Id, join_date, exit_date, entity_id, department, designation, emp_status, approver_id, approver_name, approver_email, message, status) ";
            $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $paramType = "ssssssssiisiissiiiiissss";
            $paramValue = array(
                $f_name, $l_name, $dob, $email, $personal_email,
                $mobile, $add1, $add2, $city, $state, $pin, $country,
                $contacttype_id, $join_date, $exit_date, $entity_id, $department, $designation, 
                $emp_status, $approver_id, $approver_name, $approver_email, $message, $status
            );
            $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
            // Send Email Notification to  Requester and Approver.
            $subject = "CMS - New Access Approval Request";
            $message = "Your have a new access request received for approval, with below details <br><br>";
            $message .= "<table>";
            $message .= "<tr><td>User Name:</td><td>$f_name $l_name </td></tr>";
            $message .= "<tr><td>Email:</td><td>$email</td></tr>";
            $message .= "<tr><td>Login to CMS Portal and approve from pending requests under User Management.</td><td></td></tr>";
            $message .= "</table><br>";

            $mail = new Email();
            if($mail->sendEmailNotification($subject, $approver_email, "Dear $approver_name,","Warm Regards,<br>PVS Team", $message))
            {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['reset_email'] = $email;
                header("Location:../../home");
            }    
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