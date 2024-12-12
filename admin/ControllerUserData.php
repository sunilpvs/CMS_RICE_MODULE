<?php 
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] .'/email/Email.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/admin/AdminLogin.php');

    $uname = "";
    $name = "";
    $entity= "";
    $errors = array();
    
    if (isset($_SESSION['id'])) 
    {
        header('Location: ../admin');   
        exit;
    }

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
                //Login Successful
                header('location: ../admhome');
                exit;            
            }
            else if($status == "notverified" && $code == 0)
            {
                header('Location: ../resetcode');
            }
            else if($status == "notverified" && $code != 0 )
            {
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                header('location: ../usrotp');
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
        $email = $_POST['email'];
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
                    header('location: ../resetcode');
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
            header('location: ../newpwd');
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
                header('Location: ../pwdchanged');
            }else
            {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: ../admin');
    }
?>