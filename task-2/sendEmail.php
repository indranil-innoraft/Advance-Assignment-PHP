<?php 

session_start();

//Load Composer's autoloader
require './vendor/autoload.php';

//Provides admin details.
require './confidential.php';

//Provides email class.
require './verifyEmail.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = new Email();

//Using verify method check email is valid or not.
if(!$email->verify($_POST['email'])) {
  $_SESSION['Msg'] = "Invalid email address.";
  header('Location: index.php');
}

$mail = new PHPMailer(true);

//Server settings 

//Send using SMTP
$mail->isSMTP(); 

//Set the SMTP server to send through.                                              
$mail->Host = 'smtp.gmail.com'; 

//Enable SMTP authentication.
$mail->SMTPAuth = true;

//SMTP username.
$mail->Username = $userName;     

//SMTP password.
$mail->Password = $password;        

$mail->Port = 465;                                    
$mail->SMTPSecure = "ssl";

//Recipients.
$mail->setFrom($userName);
$mail->addAddress($_POST['email']);

//Set email format to HTML.
$mail->isHTML(true);
$mail->Subject = 'Innoraft Welcome email.';
$mail->Body = 'Thank you for your submission.';

//Send email.
$mail->send();

//Returning to index page if the execution.
$_SESSION['Msg'] = "Thank you,check your mail box";
header('location: index.php');
