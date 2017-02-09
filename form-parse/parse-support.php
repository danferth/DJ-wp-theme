<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$first_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
 // 1) form slug for redirect
$next_page = 'a5rfd61c/';
header('HTTP/1.1 303 See Other');

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("<b>Issue:</b> %s<br/>\n", $_POST['issue']);
		$body .= sprintf("<b>Name:</b> %s<br/>\n", $_POST['name']);
		$body .= sprintf("<b>Email:</b> %s<br/>\n", $_POST['email']);
		$body .= sprintf("<hr/>\n");
		$body .= sprintf("<b>Platform:</b> %s<br/>\n", $_POST['platform']);
		$body .= sprintf("<b>page:</b> %s<br/>\n", $_POST['page']);

		if ($_POST['comment'] == "So what is the actual problem, issue or bug?"){
			$commentSafe = "Woops! the customer didn't leave a message, odd since it was required";
		}else{$comment = $_POST['comment'];}
		$commentSafe = strip_tags($comment);

		$body .= wordwrap(sprintf("\n<b>Message:</b><br/>\n".$commentSafe."<br />",75,"\n"));

		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('dan@htslabs.com', 'Support Form');
			$mail->addReplyTo($_POST['email'], $_POST['name']);
			$mail->addAddress('dan@htslabs.com', 'Support Form');
			$mail->Subject = "WEBSITE ISSUE - " . $_POST['issue'];
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