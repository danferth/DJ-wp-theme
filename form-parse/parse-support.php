<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'a5rfd61c/';
header('HTTP/1.1 303 See Other');

//trim post
function trim_value($value){
  $value = trim($value);
}
array_filter($_POST, 'trim_value');

//form variables
$issue   = filter_var($_POST['issue'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$name   = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$page = filter_var($_POST['page'], FILTER_SANITIZE_URL);
$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

//for body and sending email
$query_string = '?first_name=' . $name;

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("<b>Issue:</b> %s<br/>\n", $issue);
		$body .= sprintf("<b>Name:</b> %s<br/>\n", $name);
		$body .= sprintf("<b>Email:</b> %s<br/>\n", $email);
		$body .= sprintf("<hr/>\n");
		$body .= sprintf("<b>Platform:</b> %s<br/>\n", $_POST['platform']);
		$body .= sprintf("<b>page:</b> %s<br/>\n", $page);

		$body .= wordwrap(sprintf("\n<b>Message:</b><br/>\n".$comment."<br />",75,"\n"));

		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('dan@htslabs.com', 'Support Form');
			$mail->addReplyTo($email, $name);
			$mail->addAddress('dan@htslabs.com', 'Support Form');
			$mail->Subject = "WEBSITE ISSUE - " . $issue;
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				// 5) error file name
				$log = "logs/support-error.txt";
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