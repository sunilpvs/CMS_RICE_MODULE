<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/email/Email.php");
    
    $subject = "Welcome PVS";
    $toAddress = "harithadevi5575@hotmail.com";
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