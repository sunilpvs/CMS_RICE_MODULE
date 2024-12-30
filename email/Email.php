<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Email
    {
        private $logo;
        private $app_rights;
        private $email_host;
        private $email_port;
        private $email_name;
        private $smtp_auth;
        private $email_user;
        private $app_pwd;
        private $url_home;
        private $url_about;
        private $url_buss;
        private $url_contact;
        private $app_contact;
        //Address Variables
        private $app_hadd1;
        private $app_hadd2;
        private $app_hadd3;
        private $app_hadd4;
        private $app_cadd1;
        private $app_cadd2;
        private $app_cadd3;
        private $app_cadd4;


        function __construct() 
        {
            $ini_file_path = $_SERVER['DOCUMENT_ROOT'] ."/email/email.ini";
            $ini_file = parse_ini_file($ini_file_path);
            $this->logo = $ini_file["logo"];
            $this->app_rights = $ini_file["app_rights"];
            $this->email_host = $ini_file["email_host"];
            $this->email_port = $ini_file["email_port"];
            $this->email_name = $ini_file["email_name"];
            $this->smtp_auth = $ini_file["smtp_auth"];
            $this->email_user = $ini_file["email_user"];
            $this->app_pwd = $ini_file["app_pwd"];
            $this->url_home = $ini_file["url_home"];
            $this->url_about = $ini_file["url_about"];
            $this->url_buss = $ini_file["url_buss"];
            $this->url_contact = $ini_file["url_contact"];
            $this->app_contact = $ini_file["app_contact"];
            //
            $this->app_hadd1 = $ini_file["app_hadd1"];
            $this->app_hadd2 = $ini_file["app_hadd2"];
            $this->app_hadd3 = $ini_file["app_hadd3"];
            $this->app_hadd4 = $ini_file["app_hadd4"];
            $this->app_cadd1 = $ini_file["app_cadd1"];
            $this->app_cadd2 = $ini_file["app_cadd2"];
            $this->app_cadd3 = $ini_file["app_cadd3"];
            $this->app_cadd4 = $ini_file["app_cadd4"];
        }

        function sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message)
        {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try 
            {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;             //Enable verbose debug output
                $mail->isSMTP();                                     //Send using SMTP
                $mail->Host       = $this->email_host;               //Set the SMTP server to send through
                $mail->SMTPAuth   = $this->smtp_auth;                //Enable SMTP authentication
                $mail->Username   = $this->email_user;               //SMTP username
                $mail->Password   = $this->app_pwd;;                 //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  //Enable implicit TLS encryption For SSL : ENCRYPTION_SMTPS
                $mail->Port       = $this->email_port;               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($this->email_user, $this->email_name);
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
                $mail->AddEmbeddedImage(dirname(__FILE__).$this->logo,'logo');
                $body = $this->createBody($greetings, $salutation, $message);
                $mail->Body = $body;
                $mail->send();
                return true;
                //echo 'Message has been sent';
            } catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
                            <img src="cid:'.$this->logo.'"><br>
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
                            <td><img src="cid:'.$this->logo.'">
                            <h3>Call us / WhatsApp<br>'.$this->app_contact.'</h3>
                            </td>
                            <td>
                                <h3>Head Office:</h3>
                                <p>'.$this->app_hadd1.'<br>'.$this->app_hadd2.'<br>'.$this->app_hadd3.'<br>'.$this->app_hadd4.'</p>
                            </td>
                            <td>
                                <h3>Corporate Office:</h3>
                                <p>'.$this->app_cadd1.'<br>'.$this->app_cadd2.'<br>'.$this->app_cadd3.'<br>'.$this->app_cadd4.'</p><br><br>
                            </td>
                            <td>
                            <h3>About Us</h3> 
                            <p><a href="'.$this->url_home.'" style="text-decoration: none;">Home</a></p>
                            <p><a href="'.$this->url_about.'" style="text-decoration: none;">About</a></p>
                            <p><a href="'.$this->url_buss.'" style="text-decoration: none;">Our Business</a></p>
                            <p><a href="'.$this->url_contact.'" style="text-decoration: none;">Contact Us</a></p>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <center> <table>
                <tr>
                    <td><p>&#169;'.$this->app_rights.'</p></td>
                </tr>
                </table></center>
                </body>
                </html>';
                return $body;
        }    
    }
?>