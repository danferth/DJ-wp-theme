<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = trim($_POST['first-name']);
$form_type = trim($_POST['form']);
$product_type = trim($_POST['product']);
$path = trim($_POST['path']);
$query_string = '?first_name='.$first_name.'&form_type='.$form_type.'&product='.$product_type;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = $path;
header('HTTP/1.1 303 See Other');

	if (is_array($_POST)){
		if($form_type == 'contact' || $form_type == 'quote'){
		  $body  = sprintf("<html>"); 
		  $body .= sprintf("<body>");
		  $body .= sprintf("<h2>Product Inquiry-" . $_POST['form'] . " submission</h2>\n");
		  $body .= sprintf("<hr />");
		  $body .= sprintf("Company: <b>%s</b><br/>\n", $_POST['company']);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$_POST['first-name'],$_POST['last-name']);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$_POST['email']);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$_POST['phone']);
		  $body .= sprintf("City/State: <b>%s, %s</b>\n",$_POST['city'],$_POST['state']);
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
		  $body .= sprintf("CompNy: <b>%s</b><br/>\n", $_POST['company']);
		  $body .= sprintf("\nName: <b>%s %s</b><br/>\n",$_POST['first-name'],$_POST['last-name']);
  
		  $body .= sprintf("\nEmail: <b>%s</b><br/>\n",$_POST['email']);
		  $body .= sprintf("Phone: <b>%s</b><br/>\n",$_POST['phone']);
		  $body .= sprintf("<b>Address:</b><br/>\n");
		  $body .= sprintf("%s<br/>\n",$_POST['address']);
		  $body .= sprintf("%s<br/>\n",$_POST['building']);
		  $body .= sprintf("<b>%s, %s %s</b>\n",$_POST['city'],$_POST['state'],$_POST['zipCode']);
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
		}

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom($_POST['email'], $_POST['first-name']." ".$_POST['last-name']);
			$mail->addReplyTo($_POST['email'], $_POST['first-name']." ".$_POST['last-name']);
			//$mail->addAddress('web_submissions@htslabs.com', 'Product Inquiry');
			$mail->addAddress('web_test@htslabs.com', ' Product Inquiry');	//uncoment for testing to dan@htslabs.com
			$mail->Subject = $_POST['form'] . " Product Inquiry";
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