<?php 
    require_once ("includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');

class UserLogin
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
            
    function changePassword($user_name,$password) {
        $code = 0;
        $status = "verified";
        $hash_pwd = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE tbl_users SET code = $code, status = '$status', password = '$hash_pwd' WHERE user_name = '$user_name'";
        $update_res = $this->db_handle->updateWithStatus($query);
        return $update_res;
    }

    function validateLogin($u_name,$pwd) 
    {
        $query = "SELECT * FROM vw_validatelogin WHERE (user_name = ? OR email = ? ) LIMIT 1";
        $paramType = "ss";
        $paramValue = array(
            $u_name,
            $u_name
        );
        $result = $this->db_handle->executeQuery($query, $paramType, $paramValue);
        $count=mysqli_num_rows($result);
        if($count>0){ //User_Id Exists
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $hash = $row["password"];
            // Verify the hash code against the unencrypted password entered 
            $verify = password_verify($pwd, $hash); 
            if ($verify) {
                //echo 'Correct Password!'; 
                
                $_SESSION['id'] = $row["id"];
                $_SESSION['user_name'] = $row["user_name"];
                $_SESSION['f_name'] = $row["f_name"];
                $_SESSION['l_name'] = $row["l_name"];
                $_SESSION['phone'] = $row["mobile"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['user_type'] = $row["ctype"];
                $_SESSION['code'] = $row["code"];
                $_SESSION['status'] = $row["status"];
                $_SESSION['FirstLogin_Link'] = "https://demo.shrichandragroup.com//user_management/reset-code.php";
                $_SESSION['user_role'] = $row["user_role"];
                $_SESSION['user_role_id'] = $row["user_role_id"];
                return TRUE;
            }
           else { 
               //echo 'Password is Incorrect';
               return FALSE;
            } 
        }
        else{ //Invalid User_Id 
            return FALSE;
        }
    } 

    function validateOtpCode($otp_code) 
    {
        $query = "SELECT * FROM vw_user_validation WHERE CODE = ? LIMIT 1;"; 
        $paramType = "i";
        $paramValue = array(
            $otp_code
        );
        $result = $this->db_handle->executeQuery($query, $paramType, $paramValue);
        $count=mysqli_num_rows($result);
        if($count>0){
            //Valid Code enterd for OTP Validation
            return TRUE;
        } else {
            return FALSE;
        }   
    }       
    
    function updateOtpCode($otp_code) 
    {
        $code = 0;
        $status = 'verified';
        $query = "UPDATE tbl_users SET code = $code, status = '$status' WHERE code = $otp_code";
        $update_res = $this->db_handle->updateWithStatus($query);
        if($update_res)
        {
            $_SESSION['code'] = $code;
            $_SESSION['status'] = $status;
            return TRUE;        
        } else{
                return FALSE;
            }            
    }

    function validateEmail($email) 
    {
        $query = "SELECT * FROM vw_user_validation WHERE email = ? LIMIT 1;";
        $paramType = "s";
        $paramValue = array(
            $email
        );
        $result = $this->db_handle->executeQuery($query, $paramType, $paramValue);
        $count=mysqli_num_rows($result);
        if($count>0){
            //Valid email entered for forgot password.
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $_SESSION['id'] = $row["id"];
            $_SESSION['user_name'] = $row["user_name"];
            return TRUE;
        } else {
            return FALSE;
        }   
    }   

    function setResetCode($email) 
    {
        $code = 0;
        $status = "notverified";
        $code = rand(999999, 111111);
        $id = $_SESSION['id'];
        $query = "UPDATE tbl_users SET code = $code , status = '$status'"; 
        $query .= " WHERE id = $id AND email = '$email'";
        $update_resp = $this->db_handle->updateWithStatus($query);
        if($update_resp)
        {
            return $code;        
        } 
        else
        {
                $code = 0;
                return $code;
        }            
    }    

    function validateResetPasswordOtp($otp_code) 
    {
        $query = "SELECT * FROM vw_user_validation WHERE code = ? LIMIT 1;";
        $paramType = "i";
        $paramValue = array(
            $otp_code
        );
        $result = $this->db_handle->executeQuery($query, $paramType, $paramValue);
        $count=mysqli_num_rows($result);
        if($count>0){
            //Valid otp for reset password is correct.
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $_SESSION['id'] = $row["id"];
            $_SESSION['user_name'] = $row["user_name"];
            $_SESSION['email'] = $row["email"];
            return TRUE;
        } else {
            return FALSE;
        }   
    }

    //Functions for fetching counts of Dashboard.
    
    function getEntityCount() 
    {
        $query = "SELECT COUNT(0) as count from tbl_entity LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
     function getCostcenterCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_costcenter_list LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
     function getWarehouseCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_warehouse LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
     function getLessorCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_lessor LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
     function getCommoditiesCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_commodities LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getInwardLeaseCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_inwardleases LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getOutwardLeaseCount() 
    {
        $query = "SELECT COUNT(0) as count from tbl_outwardlease LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getUsersCount() 
    {
        $query = "SELECT COUNT(0) as count from tbl_users LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getVendorCount() 
    {
        $query = "SELECT COUNT(0) as count from tbl_vendor LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getDepartmentCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_deptlist LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getDesignationCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_desiglist LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
      function getCustomerCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_customer LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
       function getContactCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_contact LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }
       function getEmployeeCount() 
    {
        $query = "SELECT COUNT(0) as count from vw_employeelist LIMIT 1;";
        $result = $this->db_handle->runBaseQuery($query);
        $cnt=mysqli_num_rows($result);  
        if($cnt>0)
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = $row['count'];
            return $count;
        }
        return $count;
    }

    // function getOutwardleaseCount() 
    // {
    //     $query = "SELECT COUNT(0) as count from vw_outwardleases LIMIT 1;";
    //     $result = $this->db_handle->runBaseQuery($query);
    //     $cnt=mysqli_num_rows($result);  
    //     if($cnt>0)
    //     {
    //         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    //         $count = $row['count'];
    //         return $count;
    //     }
    //     return $count;
    // }
    
    
 
}
?>