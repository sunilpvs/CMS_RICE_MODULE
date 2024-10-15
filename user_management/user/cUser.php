<?php
session_start();
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/user/User.php");
#require_once($_SERVER['DOCUMENT_ROOT'] ."/email/Email.php");
include($_SERVER['DOCUMENT_ROOT'] ."/email/Email.php");
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {  

    case "user-add":
        if (isset($_POST['add'])) {
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $user_role_id = $_POST['role'];
            $contact_id = $_POST['ContactId'];         
            $code = rand(999999, 111111);
            $usr = new User();
            $insertId = $usr->createUser($uname, $email, $user_role_id, $contact_id, $code);
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
                    header("Location:../../user_management/user/cUser.php");
                    exit();    
                }
                else
                {
                    $errors['otp-error'] = "Failed while sending code!";
                }    
            }
        }
        require_once "../../user_management/user/user-add.php";
        break;
    
    case "user-edit":
        $user_id = $_GET["id"];
        $user = new User();
        if (isset($_POST['add']))
        {
            $user_status = $_POST['user_status'];
            $user_role = $_POST['user_role'];
            $returnVal = $user->editUser($user_status,$user_role, $user_id);
            header("Location: ../../user_management/user/cUser.php");
        }
        $result = $user->getUserById($user_id);
        require_once "../../user_management/user/user-edit.php";
        break;
    
    case "user-delete":
        $user_id = $_GET["id"];
        $user = new User();
        $user->deleteUser($user_id);
        $result = $user->getAllUser();
        require_once "../../user_management/user/vUser.php";
        break;
    
    case "initiate-pwd-reset":
                $user_id = $_GET["id"];
                $code = rand(999999, 111111);
                $usr = new User();
                $insertId = $usr->initiatePasswordReset($user_id,$code);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in updating password reset status for user id: $user_id",
                        "type" => "error"
                    );
                } 
                else
                {
                    //Password reset updated and sending email.
                    $result = $usr->getUserById($user_id);
                    $count=mysqli_num_rows($result);
                    if($count>0)
                    {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $uname = $row["user_name"];
                        $email = $row["email"];

                        $subject = "CMS - Password Reset";
                        $message = "Your login password is initiated for password reset on CMS portal, with below details <br><br>";
                        $message .= "<table>";
                        $message .= "<tr><td>User Name:</td><td>$uname</td></tr>";
                        $message .= "<tr><td>Email:</td><td>$email</td></tr>";
                        $message .= "<tr><td>Link to reset password:</td><td><a href='".$_SESSION['FirstLogin_Link']."'>Link </a></td></tr>";
                        $message .= "</table><br>";
                        $message .= "Use code to set password: $code";
                        $mail = new Email();
                        if($mail->sendEmailNotification($subject, $email, "Dear User,","Warm Regards,<br>PVS Team", $message))
                        {
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['reset_email'] = $email;
                            header("Location:../../user_management/user/cUser.php");
                            exit();    
                        }    
                    }
                }
                break;

        default:
                $user = new User();
                $result = $user->getAllUserList();
                require_once "../../user_management/user/vUser.php";
                break;
}
?>