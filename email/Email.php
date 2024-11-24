<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Email
    {
        function __construct() 
        {
        }

        function sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message)
        {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try 
            {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'donotreply@shrichandragroup.com';                     //SMTP username
                $mail->Password   = 'xxzmgnvhyfqxwpgw';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption For SSL : ENCRYPTION_SMTPS
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('donotreply@shrichandragroup.com', 'ShriChandraGroup');
                $mail->AddAddress($toAddress);
                //$mail->addAddress('sunil_pvs@hotmail.com', 'Sunil PVS');     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                // //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);        //Set email format to HTML
                $mail->Subject = $subject;
                $mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
                $body = $this->createBody($greetings, $salutation, $message);
                $mail->Body = $body;
                $mail->send();
                return true;
                //echo 'Message has been sent';
          		//if(!$mail->Send())
                //{
//			        echo $mail->ErrorInfo;
			        //return false;
		        //}else
                //{
		            //	echo 'Sent';
			      //  return true;
		        //}
            } catch (Exception $e) 
            {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false;
            }
        }

        function createBody($greetings, $salutation, $message)
        {
            $body = '<!DOCTYPE html>
                    <html>
                    <head>
    
                    </head>
                    <body style="background-color:white;">
                    <center> 
                        <div class="logo-details">
                            <img src="cid:logo"><br>
                        </div>
                        <div>
                            <h2><strong>Better collaboration leads to better business outcomes!!</strong></h2>
                        </div>
                    </center><br>
                    '.$greetings.'<br><br>
                    '.$message.'<br><br>
                    '.$salutation.'<br><br>
                    <table style = "width:100%">
                        <thead>
                        
                        </thead>
                        <tbody>
                
                    </tbody><hr>
                    <tfoot>
                        <tr>
                            <td>
                            </td>
                            <td><img src="cid:logo">
                            <h3>Call us / WhatsApp<br>0884-2361567,69</h3>
                            </td>
                            <td>
                                <h3>Head Office:</h3>
                                <p> 7-70-62/A, 1st Floor, <br>Ramya Royale, Ramanayya Peat,<br> Kakinada-533 003, A.P. INDIA,<br> GST: 37AAECR9430L1ZX.</p>
                            </td>
                            <td>
                                <h3>Corporate Office:</h3>
                                <p>Flat No: 904, 910, <br>Sagar Tech Plaza, B-Andheri Kurla Sakinaka,<br> Andheri East, Mumbai-400072,<br> Maharasta India.<br> GST: 27AAECR9430L1ZY. </p><br><br>
                            </td>
                            <td>
                            <h3>About Us</h3>
                            <p><a href="https://shrichandragroup.com/" style="text-decoration: none;">Home</a></p>
                            <p><a href="https://shrichandragroup.com/" style="text-decoration: none;">About</a></p>
                            <p><a href="https://shrichandragroup.com/" style="text-decoration: none;">Our Business</a></p>
                            <p><a href="https://shrichandragroup.com/" style="text-decoration: none;">Team</a></p>
                            <p><a href="https://shrichandragroup.com/" style="text-decoration: none;">Contact Us</a></p>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <center> <table>
                <tr>
                    <td>© 2024 Shrichandra Group. All Right Reserved.</td>
                </tr>
                </table></center>
                </body>
                </html>';
                return $body;
        }    
    }
?> 