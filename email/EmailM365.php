<?php
include('PHPMailer/PHPMailerAutoload.php');
include('PHPMailer/PHPMailerAutoload.php');
include('PHPMailer/PHPMailer.php');
include('PHPMailer/Exception.php');
include('PHPMailer/smtp.php');

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
//@see https://github.com/greew/oauth2-azure-provider
use Greew\OAuth2\Client\Provider\Azure;


//echo smtp_mailer('harithadevi5575@gmail.com','test form','hello');

class Email
{
    function __construct() 
	{
	}

	function sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message)
	{
		$email = getenv('AZURE_OFFICE365_EMAIL'); // your office365 email
		$clientId = getenv('AZURE_CLIENT_ID'); // Azure Client ID
		$tenantId = getenv('AZURE_TENANT_ID'); // Azure Tenant ID
		$clientSecret = getenv('AZURE_CLIENT_SECRET_VALUE'); // Optional. Azure Client Secret Value (Certificates & secrets)
		$refreshToken = getenv('AZURE_REFRESH_TOKEN');

		$mail = new PHPMailer(true);

		//sendMail($subject, $toAddress, $greetings, $message,$salutation) 	
		//$mail = new PHPMailer(); 
		try {
			// Configure PHPMailer for SMTP
			$mail->isSMTP();
			$mail->Host       = 'smtp-mail.outlook.com'; // instead of smtp.office365.com
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;
				
			// Set OAuth2 token
			$mail->AuthType = 'XOAUTH2';
			$mail->setOAuth(new OAuth([
				'provider' => new Azure([
					'clientId' => $clientId,
					'tenantId' => $tenantId,
					'clientSecret' => $clientSecret
				]),
				'clientId' => $clientId,
				'refreshToken' => $refreshToken,
				'clientSecret' => $clientSecret,
				'userName' => $email,
			]));
		 
			// Sender and recipient settings
			$mail->SetFrom("donotreply@shrichandragroup.com","ShriChandra Group");
			$mail->addAddress('recipient@domain.com', 'Recipient Name');
		 
			// Plain-text email content
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->SMTPOptions=array('ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
				'allow_self_signed'=>true
			));

			$mail->Subject = $subject;
			$mail->AddAddress($toAddress);
			//$mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
			$mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
			$body = $this->createBody($greetings, $salutation, $message);
			$mail->Body = $body;
			 
			// Send email
			$mail->send();
			echo 'Message has been sent successfully' . PHP_EOL;
		 } catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" . PHP_EOL;
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
						<p><a href="http://shrichandra.com/index.html" style="text-decoration: none;">Home</a></p>
						<p><a href="http://shrichandra.com/aboutus.html" style="text-decoration: none;">About</a></p>
						<p><a href="http://shrichandra.com/bulkcargoservices.html" style="text-decoration: none;">Our Business</a></p>
						<p><a href="http://shrichandra.com/team.html" style="text-decoration: none;">Team</a></p>
						<p><a href="http://shrichandra.com/contactus.html" style="text-decoration: none;">Contact Us</a></p>
						</td>
						<td>
						</td>
					</tr>
				</tfoot>
			</table>
			<center> <table>
			<tr>
						<td>
						© 2023 Shrichandra Group. All Right Reserved.
					</td>
					</tr>
				</table></center>
			</body>
			</html>';
			return $body;
	   }

}