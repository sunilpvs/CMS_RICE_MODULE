<?php 
    session_start();
    include('email/Email.php');
    include('includes/UserLogin.php');
    $uname = "";
    $name = "";
    $errors = array();
//$con = mysqli_connect('localhost', 'pvscoqq5', 'Sunil@#2023', 'pvscoqq5_devsc_cms');

// //if user selects signup button
// if(isset($_POST['signup']))
// {
//     $uname = mysqli_real_escape_string($con, $_POST['uname']);
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $password = mysqli_real_escape_string($con, $_POST['password']);
//     $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
//     if($password !== $cpassword){
//         $errors['password'] = "Confirm password not matched!";
//     }
//     $email_check = "SELECT * FROM usertable WHERE email = '$email'";
//     $res = mysqli_query($con, $email_check);
//     if(mysqli_num_rows($res) > 0){
//         $errors['email'] = "Email that you have entered is already exist!";
//     }
//     if(count($errors) === 0){
//         $encpass = password_hash($password, PASSWORD_BCRYPT);
//         $code = rand(999999, 111111);
//         $status = "notverified";
//         $insert_data = "INSERT INTO usertable (name, email, password, code, status)
//                         values('$name', '$email', '$encpass', '$code', '$status')";
//         $data_check = mysqli_query($con, $insert_data);
//         if($data_check){
//             $subject = "Email Verification Code";
//             $message = "Your verification code is $code";
//             $sender = "From: pallalaharithareddy@gmail.com";
            
//             if(mail($email, $subject, $message, $sender)){
      
//                 $info = "We've sent a verification code to your email - $email";
//                 $_SESSION['info'] = $info;
//                 $_SESSION['email'] = $email;
//                 $_SESSION['password'] = $password;
//                 header('location: user-otp.php');
//                 exit();
//             }else{
//                 $errors['otp-error'] = "Failed while sending code!";
//             }
//         }else{
//             $errors['db-error'] = "Failed while inserting data into database!";
//         }
//     }

// }

//if user click verification code submit button
if(isset($_POST['check']))
{
    $_SESSION['info'] = "";
    $otp_code =  $_POST['otp'];
    $user = new UserLogin();
    $validate=$user->validateOtpCode($otp_code);
	if($validate)
    {
        $updateValid=$user->updateOtpCode($otp_code);
        if($updateValid){
            header('location: logout-user.php');
            exit();
        }else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
//if user click login button
if(isset($_POST['login']))
{
    $user = new UserLogin();
    $validate=$user->validateLogin($_POST["uname"],$_POST["password"]);
	if($validate)
    {
        $status = $_SESSION['status'];
        $code = $_SESSION['code']; 
        if($status == "verified")
        {    
			//	//Login Successful
            require_once "index.php";
			exit;            
        }
        else if($status == "notverified" && $code == 0)
        {
            header('Location: reset-code.php');
        }
        else if($status == "notverified" && $code != 0 )
        {
            $info = "It's look like you haven't still verify your email - $email";
            $_SESSION['info'] = $info;
            header('location: user-otp.php');
        }
        else 
        {
            $errors['uname'] = "Incorrect email or password!";
        }    
    }
}
//if user click continue button in forgot password form
if(isset($_POST['check-email']))
{
    $toAddress = $_POST['email'];
    $user = new UserLogin();
    $validate=$user->validateEmail($email);
	if($validate)
    {       // If email is valid and exist
        $code = 0;
        $code=$user->setResetCode($email);    
        if($code>0)
        {   //Reset code generated in DB and sharing over email
            $subject = "Password Reset Code";
            $greetings = "Dear User,";
            $salutation = "Warm Regards,<br>PVS Team";
            $message = "Your password reset code is $code";
            $mail = new Email();
            if($mail->sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message))
            {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location:reset-code.php');
                exit();
            }
            else
            {
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        else
        {
            $errors['db-error'] = "Something went wrong!";
        }
    }
    else
    {
        // If email is invalid and does not exist
        $errors['email'] = "This email address does not exist!";
    }
}
    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $user = new UserLogin();
        $validate=$user->validateResetPasswordOtp($otp_code);
        if($validate) 
        {
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $user_name = $_SESSION['user_name']; //getting this user name using session
            $user = new UserLogin();
            $run_query = $user->changePassword($user_name,$password);
            if($run_query)
            {
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else
            {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login.php');
    }

?>