<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = trim($_POST['fname']);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'terms-and-conditions-of-sale/';
header('HTTP/1.1 303 See Other');

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("<h2>Terms &amp; Conditions Acceptance:</h2>\n");
		$body .= sprintf("<hr />");
		$body .= sprintf("\nCompany: <strong>%s</strong><br />\n",$_POST['company']);
		$body .= sprintf("\nName: <strong>%s %s</strong><br />\n",$_POST['fname'],$_POST['lname']);
		if ($_POST['title'] == "title"){
			$title = "";
			}else{$title = $_POST['title'];}
		if ($title !=""){
		$body .= sprintf("\nTitle: <strong>".$title."</strong><br />\n");}
		$body .= sprintf("\nTelephone: <strong>%s</strong><br />\n",$_POST['phone']);
		$body .= sprintf("\nEmail: <strong>%s</strong><br />\n",$_POST['email']);
		$body .= sprintf("<br />");
		$body .= sprintf("<br /><hr />");
		$body .= sprintf("For internal use:<br />\n");
		$body .= sprintf("<br />-----------------<br />\n");
		$body .= sprintf("\nSender's IP: %s<br />\n", $_SERVER['REMOTE_ADDR']);
		$body .= sprintf("\nReceived: %s<br />\n",date("Y-m-d H:i:s"));

		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if ($_POST['email']){
			$mail = new PHPMailer;
			$mail->setFrom($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			$mail->addReplyTo($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			//$mail->addAddress('customerservice@htslabs.com', 'T&C Form');
			$mail->addAddress('dan@htslabs.com', 'Contact Form');	//uncoment for testing to dan@htslabs.com
			$mail->Subject = "Terms Acceptance - " . $_POST['company'];
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/terms-error.txt";
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