<?php
require_once("PHPMailer/PHPMailerAutoload.php");
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
$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$building = filter_var($_POST['building'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$city    = filter_var($_POST['city'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$state   = filter_var($_POST['state'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$zipcode = filter_var($_POST['zip-code'], FILTER_SANITIZE_NUMBER_INT);


//for body and sending email
$form_type    = $_POST['form'];
$product_type = $_POST['product'];
$path         = $_POST['path'];
$query_string = '?first_name='.$fname.'&form_type='.$form_type.'&product='.$product_type;



	if (is_array($_POST)){
		if($form_type == 'contact' || $form_type == 'quote'){
		  $body  = sprintf("<html>"); 
		  $body .= sprintf("<body>");
		  $body .= sprintf("<h2>Product Inquiry-" . $_POST['form'] . " submission</h2>\n");
		  $body .= sprintf("<hr />");
		  $body .= sprintf("Company: <b>%s</b><br/>\n", $company);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$fname,$lname);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$email);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$phone);
		  $body .= sprintf("City State, Zip: <b>%s %s, %s</b>\n",$city,$state,$zipcode);
		  $body .= sprintf("<br /><br/>");
		  $body .= sprintf("Inquiry type: <b>%s</b><br/>\n",$_POST['form']);
		  $body .= sprintf("Product: <b>%s</b><br/>\n",$_POST['product']);
		  $body .= sprintf("Science path: <b>%s</b><br/>\n",$_POST['science']);
  
		  $body .= sprintf("<br /><hr />");
		  $body .= sprintf("For internal use:<br />\n");
		  $body .= sprintf("<br />-----------------<br />\n");
		  $body .= sprintf("\nSender's IP: %s<br />\n", $_SERVER['REMOTE_ADDR']);
		  $body .= sprintf("\nReceived: %s<br />\n",date("Y-m-d H:i:s"));
		  $body .= sprintf("</body>");
		  $body .= sprintf("</html>");
		}elseif($form_type == 'sample'){
		  $body  = sprintf("<html>"); 
		  $body .= sprintf("<body>");
		  $body .= sprintf("<h2>Product Inquiry-" . $_POST['form'] . " submission</h2>\n");
		  $body .= sprintf("<hr />");
		  $body .= sprintf("Company: <b>%s</b><br/>\n", $company);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$fname,$lname);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$email);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$phone);
		  $body .= sprintf("Address: <b>%s</b><br/>\n", $address);
		  $body .= sprintf("Building: <b>%s</b><br/>\n",$building);
		  $body .= sprintf("City/State/Zip: <b>%s, %s %s</b><br/>\n",$city,$state,$zipcode);
		  $body .= sprintf("<br/>");
		  $body .= sprintf("Inquiry type: <b>%s</b><br/>\n",$_POST['form']);
		  $body .= sprintf("Product: <b>%s</b><br/>\n",$_POST['product']);
		  $body .= sprintf("Science path: <b>%s</b><br/>\n",$_POST['science']);
  
		  $body .= sprintf("<br /><hr />");
		  $body .= sprintf("For internal use:<br />\n");
		  $body .= sprintf("<br />-----------------<br />\n");
		  $body .= sprintf("\nSender's IP: %s<br />\n", $_SERVER['REMOTE_ADDR']);
		  $body .= sprintf("\nReceived: %s<br />\n",date("Y-m-d H:i:s"));
		  $body .= sprintf("</body>");
		  $body .= sprintf("</html>");
		}

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('product_inq@htslabs.com', 'Product Inquiry');
			$mail->addReplyTo($email, $fname." ".$lname);
			$mail->addAddress('product_inq@htslabs.com', 'Product Inquiry');
			$mail->Subject = "Website " . $_POST['form'] . " inquiry from - " . $company;
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/product-inquiry-error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . "\n" . $mail_error . "\n\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
				$query_string .= '&success=true';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}
		}else{
			$query_string = '?first_name=Edward';
			$query_string .= '&success=true';
				header('Location: http://' . $server_dir . $next_page . $query_string);
		}
	}
?>