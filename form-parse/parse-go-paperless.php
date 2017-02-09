<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'go-paperless/';
header('HTTP/1.1 303 See Other');

//trim post
function trim_value($value){
  $value = trim($value);
}
array_filter($_POST, 'trim_value');









	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("<h2>Go Paperless form submission:</h2>\n");
		$body .= sprintf("<hr />");
		$body .= sprintf("\nCompany: <b>%s</b><br />\n",$_POST['company']);
		$body .= sprintf("\nName: <b>%s %s</b><br />\n",$_POST['fname'],$_POST['lname']);
		$body .= sprintf("\nPhone #: <b>%s</b><br />\n",$_POST['phone']);
		$body .= sprintf("\nEmail: <b>%s</b><br />\n",$_POST['email']);
		$body .= sprintf("<br />");
		$body .= sprintf("<br /><hr />");
		$body .= sprintf("For internal use:<br />\n");
		$body .= sprintf("<br />-----------------<br />\n");
		$body .= sprintf("\nSender's IP: %s<br />\n", $_SERVER['REMOTE_ADDR']);
		$body .= sprintf("\nReceived: %s<br />\n",date("Y-m-d H:i:s"));
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('paperless@htslabs.com', 'Go paperless');
			$mail->addReplyTo($_POST['email'], $_POST['firstName']." ".$_POST['lastName']);
			$mail->addAddress('paperless@htslabs.com', 'Go paperless');
			$mail->Subject = $_POST['company'] . " Wants to go Paperless!";
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/go-paperless-error.txt";
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