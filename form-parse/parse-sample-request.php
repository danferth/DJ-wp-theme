<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = trim($_POST['firstName']);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'sample-request/';
header('HTTP/1.1 303 See Other');

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("Company: <b>".$_POST['company']."</b><br />\n");
		$body .= sprintf("Name: <b>".$_POST['firstName']." ".$_POST['lastName']."</b><br />\n");
		$body .= sprintf("Phone: <b>".$_POST['phone']."</b><br />\n");
		$body .= sprintf("Email: <b>".$_POST['email']."</b><br />\n");
		$body .= sprintf("Zipcode: <b>".$_POST['zipCode']."</b>br />\n");
		$body .= sprintf("Country: <b>".$_POST['country']."</b><br />\n");

		$body .= sprintf("<hr /><h4>Request Message</h4>");

			if($_POST['message'] == ""){
				$message = "Sorry, the customer did not leave a message";
			}else{$message = $_POST['message'];}
			$messageSafe = strip_tags($message);

			$body .= wordwrap(sprintf("<b>%s</b>",$messageSafe,75,"\n"));	
			$body .= sprintf("<hr />");
			$body .= sprintf("For internal use:");
			$body .= sprintf("<br />-----------------");
			$body .= sprintf("<br />Sender's IP: %s", $_SERVER['REMOTE_ADDR']);
			$body .= sprintf("<br />Received: %s",date("Y-m-d H:i:s"));

		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if ($_POST['email']){
			$mail = new PHPMailer;
			$mail->setFrom($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			$mail->addReplyTo($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			//$mail->addAddress('web_submissions@htslabs.com', 'Samples Form');
			$mail->addAddress('dan@htslabs.com', 'Contact Form');	//uncoment for testing to dan@htslabs.com
			$mail->Subject = "Sample Request - " . $_POST['company'];
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/sample-request-error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . "\n" . $mail_error . "\n\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
				$query_string .= '&success=true';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}
		}
	}
?>