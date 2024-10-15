<?php
include('PHPMailer/PHPMailerAutoload.php');
include('PHPMailer/PHPMailer.php');
include('PHPMailer/Exception.php');
include('PHPMailer/smtp.php');

use PHPMailer\PHPMailer\PHPMailerAutoload;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\smtp;
//echo smtp_mailer('harithadevi5575@gmail.com','test form','hello');

class Email
{
    function __construct() 
	{
	}

	function sendEmailNotification($subject,$toAddress,$greetings, $salutation, $message)
	{
		//sendMail($subject, $toAddress, $greetings, $message,$salutation) 	
		$mail = new PHPMailer(); 
		//SMTP Settings
		//$mail->SMTPDebug=3;
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'tls'; 
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));
		
		//Email Config.
		$mail->Host = "mail.pvs-consultancy.com";
		$mail->Port = "587"; //Port 465 for ssl and 587 for tls 
		$mail->Username = "donotreply@pvs-consultancy.com";
		$mail->Password = 'Blue1Bird2#@!';
		$mail->SetFrom("donotreply@pvs-consultancy.com","PVS Consultancy");
		$mail->Subject = $subject;
		$mail->AddAddress($toAddress);
		//$mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
		$mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
		$body = $this->createBody($greetings, $salutation, $message);
		$mail->Body = $body;
		if(!$mail->Send()){
			//echo $mail->ErrorInfo;
			return false;
		}else{
		//	echo 'Sent';
			return true;
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
			<p>PVS CONSULTANCY SERVICES SDN<br> BHD
			(1062045-W)<br>
			7-70-62/A, 1st Floor, <br>Ramya Royale, Ramanayya Peat,<br> Kakinada-533 003, A.P. INDIA,<br> GST: 37AAECR9430L1ZX.</p>
						</td>
						<td>
						<h3>Corporate Office:</h3>
			<p>Flat No: 904, 910, <br>Sagar Tech Plaza, B-Andheri Kurla Sakinaka,<br> Andheri East, Mumbai-400072,<br> Maharasta India.<br> GST: 27AAECR9430L1ZY. </p><br><br>
						</td>
						<td>
						<h3>About Us</h3>
						<p><a href="http://shrichandra.com/index.html" style="text-decoration: none;"> Home</a></p>
						<p><a href="hhttp://shrichandra.com/aboutus.html" style="text-decoration: none;"> About Us</a></p>
						<p><a href="http://shrichandra.com/bulkcargoservices.html" style="text-decoration: none;"> Our Business/a></p>
						<p><a href="http://shrichandra.com/team.html" style="text-decoration: none;"> Team</a></p>
						<p><a href="http://shrichandra.com/contactus.html" style="text-decoration: none;"> Contact Us</a></p>
						</td>
						<td>
						</td>
					</tr>
				</tfoot>
			</table>
			<center> <table>
			<tr>
						<td>
						© 2023 PVS Consultancy. All Right Reserved.
					</td>
					</tr>
				</table></center>
			</body>
			</html>';
			return $body;
	   }

}