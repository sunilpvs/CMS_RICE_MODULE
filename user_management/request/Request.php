<?php 
    #require_once ("class/DBController.php");
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/user/User.php");
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
            // Send Email Notification to  Approver.
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
                $info = "We've sent new access request approval email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['reset_email'] = $email;
            }    
            // Send Email Notification to  Approver.
            $subject = "CMS - New Access Approval Request Submitted";
            $message = "Your request for access request is submitted , with below details <br><br>";
            $message .= "<table>";
            $message .= "<tr><td>User Name:</td><td>$f_name $l_name </td></tr>";
            $message .= "<tr><td>Email:</td><td>$email</td></tr>";
            $message .= "<tr><td>Approver Name:</td><td>$approver_name</td></tr>";
            $message .= "<tr><td>Approver Email:</td><td>$approver_email</td></tr>";
            $message .= "</table><br>";

            $mail = new Email();
            $resp = $mail->sendEmailNotification($subject, $email, "Dear $f_name $l_name,","Warm Regards,<br>PVS Team", $message);
            if($resp == FALSE){
                  //Error  
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

    function updateAccessRequest($req_id, $uname, $role, $app_status)
    {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
        $this->db_handle->beginTrans();
        try
        {
            if($app_status == "Approved")
            {
                //Request Approved by User
                //Create Employee from Request 
                $id = $_SESSION['id'];
                $query = "INSERT INTO tbl_contact (f_name, l_name, dob, email, personal_email, mobile, add1, add2, city, state, pin, country, contacttype_id, join_date, exit_date, ";
                $query .= "emp_status, entity_id, department, designation, createdBy) ";
                $query .= "SELECT  f_name, l_name, dob, email, personal_email, mobile, add1, add2, city, state, pin, country, contacttype_id, join_date, exit_date, emp_status,";
                $query .= "entity_id, department, designation, ".$id." as createdBy ";
                $query .= "FROM tbl_reqaccess WHERE id = ?;";
                $paramType = "i";
                $paramValue = array(
                                    $req_id
                                    );
                $contactId = $this->db_handle->insert($query, $paramType, $paramValue);
                //Get Employee Details for newly created Employee
                $sql = "SELECT * FROM vw_userlist WHERE id = $contactId;";
                $result = $this->db_handle->runBaseQuery($sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $email = $row['email'];
                $entity_id = $row['entity_id'];
                //Create user based on Employee Id inserted and send email notification
                $code = rand(999999, 111111);
                $usr = new User();
                $insertId = $usr->createUser($uname, $email, $role, $contactId, $code, $entity_id);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    $subject = "CMS - First-time Login.";
                    $message = "Your login is been created in CMS portal, with below details <br><br>";
                    $message .= "<table>";
                    $message .= "<tr><td>User Name:</td><td>$uname</td></tr>";
                    $message .= "<tr><td>Email:</td><td>$email</td></tr>";
                    $message .= "<tr><td>Link to create password:</td><td><a href='".$_SESSION['FirstLogin_Link']."'>Link </a></td></tr>";
                    $message .= "</table><br>";
                    $message .= "Your password needs to be generated for first time login. Use code to set password: $code";
                    $mail = new Email();
                    if($mail->sendEmailNotification($subject, $email, "Dear User,","Warm Regards,<br>PVS Team", $message))
                    {
                        $info = "We've sent a passwrod reset otp to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                    }
                    else
                    {
                        $errors['otp-error'] = "Failed while sending code!";
                    }    
                }
        
                //Update Access request to completed
                $query = "UPDATE tbl_reqaccess SET status = ? WHERE id = ?;";
                $paramType = "si";
                $paramValue = array(
                                    $app_status,
                                    $req_id
                                    );
                $updateId = $this->db_handle->update($query, $paramType, $paramValue);
            }
            elseif($app_status == "Rejected")
            {
                $query = "UPDATE tbl_reqaccess SET status = ? WHERE id = ?;";
                $paramType = "si";
                $paramValue = array(
                                    $app_status,
                                    $req_id
                                    );
                $updateId = $this->db_handle->update($query, $paramType, $paramValue);
            }

            $this->db_handle->commitTrans();
            return $updateId;
        }catch (\Throwable $e)
        {
            // An exception has been thrown, We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
    }
        
    function getPendingRequests() {
        $sql = "SELECT * FROM vw_acces_request;";
        $result = $this->db_handle->runBaseQuery($sql);
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