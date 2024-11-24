<?php
    use Email\PHPMailer\PHPMailer\PHPMailer;
    use Email\PHPMailer\PHPMailer\Exception;
    
    require_once($_SERVER['DOCUMENT_ROOT'] ."/email/sendEmail.php");
    
    $subject = "Welcome PVS";
    $toAddress = "sunil_pvs@hotmail.com";
    $greetings = "Dear Candidate,<br> <br> Greetings from PVS! <br><p>";
    $salutation = "</p><br>Warm Regards, <br> PVS Team<br><br>";
    $message = "This is a test message from PVS.";
       
    $myEmail = new Email();    
    $res = $myEmail->sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message);

   if (!$res) 
   {
        echo 'Mailer Error: ' . $myEmail->ErrorInfo;
   } else 
   {
       echo 'The email message was sent.';
   }


?>