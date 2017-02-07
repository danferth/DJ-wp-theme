<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = trim($_POST['firstName']);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
 // 1) form slug for redirect
$next_page = 'form-slug/';
header('HTTP/1.1 303 See Other');

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		// 2) body of email DOUBLE CHECK ALL $_POST[] ITEMS

		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			$mail->addReplyTo($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			// 3) dont forget to change this to proper reciever and uncomment for production use
			//$mail->addAddress('web_submissions@htslabs.com', 'Contact Form');
			$mail->addAddress('dan@htslabs.com', 'Contact Form');	//uncoment for testing to dan@htslabs.com
			// 4) Make sure to double check subject
			$mail->Subject = "Contact From - " . $_POST['company'];
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				// 5) error file name
				$log = "logs/form-error.txt";
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