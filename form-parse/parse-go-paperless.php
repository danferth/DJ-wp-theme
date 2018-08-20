<?php
session_start();
require_once("PHPMailer/PHPMailerAutoload.php");
require_once("form-functions.php");
date_default_timezone_set('America/Los_Angeles');
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'go-paperless/';
header('HTTP/1.1 303 See Other');

//trim post
array_walk($_POST, 'trim_value');

//form variables
$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$fname   = filter_var($_POST['fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$lname   = filter_var($_POST['lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone   = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
//Honeypot variables
$honeypotCSS = filter_var($_POST['your-name925htj'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$honeypotJS = filter_var($_POST['your-email247htj'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//for body and sending email
$query_string = '?first_name=' . $fname;

//==========================================================
//Let's check for a few things and then go forward shall we
//==========================================================

//CHECK form completion time=====================================
//first variable passed to function should be seconds for minimum completion
formTimeCheck(3, $server_dir, $next_page, $query_string);

//CHECK required inputs=====================================
//put required variables into array
$required = array($company, $fname, $lname, $email, $phone);
checkRequired($required,  $server_dir, $next_page, $query_string);

//Validate email===========================================
//put any emails that need to be validated into an array
$checkTheseEmails = array($email);
checkEmailValid($checkTheseEmails,  $server_dir, $next_page, $query_string);
  
//check the honeypots======================================
//put honeypots into array
$honeypots = array($honeypotCSS, $honeypotJS);
checkHoneypot($honeypots,  $server_dir, $next_page, $query_string);

//all must be good, lets send a few emails=================


if (is_array($_POST)){
	$body  = sprintf("<html>"); 
	$body .= sprintf("<body>");
	
	$body .= sprintf("<h2>Go Paperless form submission:</h2>\n");
	$body .= sprintf("<hr />");
	$body .= sprintf("\nCompany: <b>%s</b><br />\n",$company);
	$body .= sprintf("\nName: <b>%s %s</b><br />\n",$fname, $lname);
	$body .= sprintf("\nPhone #: <b>%s</b><br />\n",$phone);
	$body .= sprintf("\nEmail: <b>%s</b><br />\n",$email);
	$body .= sprintf("</body>");
	$body .= sprintf("</html>");


	$mail = new PHPMailer;
	$mail->setFrom('paperless@htslabs.com', 'Go paperless');
	$mail->addReplyTo($email, $fname." ".$lname);
	//$mail->addAddress('paperless@htslabs.com', 'Go paperless');
	$mail->addAddress('dan@htslabs.com', 'Go paperless');
	$mail->Subject = $company . " Wants to go Paperless!";
	$mail->msgHTML($body);
	if (!$mail->send()){
		$mail_error = $mail->ErrorInfo;
		$error_date = date('m\-d\-Y\-h:iA');
		$log = "logs/error.txt";
		$fp = fopen($log,"a+");
		fwrite($fp,$error_date . " | go-paperless | " . $mail_error . "\n");
			fclose($fp);
			$query_string = '?success=false';
			header('Location: https://' . $server_dir . $next_page . $query_string);
			exit();
		}else{
		  $success_ip = $_SERVER['REMOTE_ADDR'];
			$success_date = date('m\-d\-Y\-h:iA');
			$success_message = $success_date . " | go-paperless | " . $success_ip . " | " . $email;
			$log = "logs/success.txt";
			$fp = fopen($log,"a+");
			fwrite($fp,$success_message . "\n");
			fclose($fp);
			$query_string .= '&success=true';
				header('Location: https://' . $server_dir . $next_page . $query_string);
	}
}

?>