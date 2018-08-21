<?php
session_start();
require_once("PHPMailer/PHPMailerAutoload.php");
require_once("form-functions.php");
date_default_timezone_set('America/Los_Angeles');
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = $_POST['path'];
header('HTTP/1.1 303 See Other');

//trim post
array_walk($_POST, 'trim_value');

//form variables
$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$fname   = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$lname   = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone   = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
if(isset($_POST['address'])){
  $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
}
if(isset($_POST['building'])){
  $building = filter_var($_POST['building'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
}
$city    = filter_var($_POST['city'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$state   = filter_var($_POST['state'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$zipcode = filter_var($_POST['zip-code'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//Honeypot variables
$honeypotCSS = filter_var($_POST['your-name925htj'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

//for body and sending email
$form_type    = filter_var($_POST['form'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$product_type = filter_var($_POST['product'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$query_string = '?first_name='.$fname.'&form_type='.$form_type.'&product='.$product_type;

//==========================================================
//Let's check for a few things and then go forward shall we
//==========================================================

//CHECK form completion time=====================================
//first variable passed to function should be seconds for minimum completion
formTimeCheck(3, $server_dir, $next_page, $query_string);

//CHECK required inputs=====================================
//put required variables into array
$required_contact_quote = array($company, $fname, $lname, $email, $phone, $city, $state, $zipcode);
$required_sample = array($company, $fname, $lname, $email, $phone, $address, $city, $state, $zipcode);
if($form_type == 'Contact' || $form_type == 'Quote'){
  checkRequired($required_contact_quote,  $server_dir, $next_page, $query_string);
}elseif($form_type == 'Sample'){
  checkRequired($required_sample,  $server_dir, $next_page, $query_string);
}
//Validate email===========================================
//put any emails that need to be validated into an array
$checkTheseEmails = array($email);
checkEmailValid($checkTheseEmails,  $server_dir, $next_page, $query_string);
  
//check the honeypots======================================
//put honeypots into array
$honeypots = array($honeypotCSS);
checkHoneypot($honeypots,  $server_dir, $next_page, $query_string);

//all must be good, lets send a few emails=================




	if (is_array($_POST)){
		if($form_type == 'Contact' || $form_type == 'Quote'){
		  $body  = sprintf("<html>"); 
		  $body .= sprintf("<body>");
		  $body .= sprintf("Inquiry type: <b>%s</b><br/>\n",$form_type);
		  $body .= sprintf("Product: <b>%s</b><br/>\n",$product_type);
		  $body .= sprintf("<hr />");
		  $body .= sprintf("Company: <b>%s</b><br/>\n", $company);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$fname,$lname);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$email);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$phone);
		  $body .= sprintf("City State, Zip: <b>%s %s, %s</b>\n",$city,$state,$zipcode);
		  $body .= sprintf("</body>");
		  $body .= sprintf("</html>");
		}elseif($form_type == 'Sample'){
		  $body  = sprintf("<html>"); 
		  $body .= sprintf("<body>");
		  $body .= sprintf("Inquiry type: <b>%s</b><br/>\n",$form_type);
		  $body .= sprintf("Product: <b>%s</b><br/>\n",$product_type);
		  $body .= sprintf("<hr />");
		  $body .= sprintf("Company: <b>%s</b><br/>\n", $company);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$fname,$lname);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$email);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$phone);
		  $body .= sprintf("Address: <b>%s</b><br/>\n", $address);
		  $body .= sprintf("Building: <b>%s</b><br/>\n",$building);
		  $body .= sprintf("City/State/Zip: <b>%s, %s %s</b><br/>\n",$city,$state,$zipcode);

		  $body .= sprintf("</body>");
		  $body .= sprintf("</html>");
		}


		$mail = new PHPMailer;
		$mail->setFrom('product_inq@htslabs.com', 'Product Inquiry');
		$mail->addReplyTo($email, $fname." ".$lname);
		$mail->addAddress('product_inq@htslabs.com', 'Product Inquiry');
		//$mail->addAddress('dan@htslabs.com', 'Product Inquiry');
		$mail->Subject = $form_type . " | " . $company . " | " . $product_type;
		$mail->msgHTML($body);
		if (!$mail->send()){
			$mail_error = $mail->ErrorInfo;
			$error_date = date('m\-d\-Y\-h:iA');
			$log = "logs/error.txt";
			$fp = fopen($log,"a+");
			fwrite($fp,$error_date . " | ". $form_type . " inquiry | " . $mail_error . "\n");
			fclose($fp);
			$query_string = '?success=false';
			header('Location: https://' . $server_dir . $next_page . $query_string);
		}else{
		  $success_ip = $_SERVER['REMOTE_ADDR'];
			$success_date = date('m\-d\-Y\-h:iA');
			$success_message = $success_date . " | ". $form_type . " inquiry | " . $success_ip . " | " . $email;
			$log = "logs/success.txt";
			$fp = fopen($log,"a+");
			fwrite($fp,$success_message . "\n");
			fclose($fp);
			$query_string .= '&success=true';
			header('Location: https://' . $server_dir . $next_page . $query_string);
		}
	}
	
?>