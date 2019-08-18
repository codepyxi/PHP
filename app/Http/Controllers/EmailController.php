<?php		
namespace App\Http\Controllers;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailController extends Controller
{
    public function index(){
 
			$message="
			<!DOCTYPE html>
				<html lang='en'>
				  <head>
					<meta charset='utf-8'>
				   </head>
				   <body> 
				<br />
				This is a test email.<br />
				<br>
					</body>
				</html>";

$mail = new PHPMailer(true);

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'hostname';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'user@emailaddress.com';                 // SMTP username
			$mail->Password = 'password';                           // SMTP password
			$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = '465';  
			
			$mail->CharSet = "UTF-8";
			$mail->From = 'from@emailaddress.com'; 
			$mail->FromName = 'Email name';
			$mail->addReplyTo('reply@emailaddress.com');
			$mail->addAddress('to@emailaddress.com');
			
			$mail->isHTML(true);                                  // Set email format to HTML
			
			$mail->Subject = 'Test email';
			$mail->Body    = $message;
			
			if(!$mail->send()) {
			    return "Message could not be sent !";
								
			  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			   	return "Message was sent!";
			}
	
    }
}