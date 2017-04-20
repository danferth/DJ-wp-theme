<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'sales/';
header('HTTP/1.1 303 See Other');

//trim post
array_walk($_POST, 'trim_value');

//form variables
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$suggestion   = filter_var($_POST['suggestion'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

if(array_key_exists('suggested_file', $_FILES)){
  $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['suggested_file']['name']));
}

//for body and sending email

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		$body .= sprintf("\nEmail: <b>%s</b><br />\n",$email);
		$body .= sprintf("<hr />");
		$body .= sprintf("\n<b>%s</b><br/>\n",$title);
		$body .= wordwrap(sprintf($suggestion),75,"<br/>");
		if($_FILES['suggested_file']['name'] != ""){
		  $body .= sprintf("\n<br/>File uploaded: <i>%s</i>",$_FILES['suggested_file']['name']);
		}
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('dan@htslabs.com', 'Suggestion Box');
			$mail->addReplyTo($email, 'sales staff');
			$mail->addAddress('dan@htslabs.com', 'dan in marketing');
			$mail->Subject = "Sales Portal Suggestion";
			$mail->msgHTML($body);
			if (move_uploaded_file($_FILES['suggested_file']['tmp_name'], $uploadfile)) {
			  $attachmentName = date('m\-d\-Y\-h:iA')."-".$_FILES['suggested_file']['name'];
			  $mail->addAttachment($uploadfile, $attachmentName);
			}
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . " | sales sugestion form | " . $mail_error . "\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
			  $success_ip = $_SERVER['REMOTE_ADDR'];
				$success_date = date('m\-d\-Y\-h:iA');
				$success_message = $success_date . " | sales suggestion form | " . $success_ip . " | " . $email;
				$log = "logs/success.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$success_message . "\n");
				fclose($fp);
				$query_string = '?success=true';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}
		}else{
			$query_string = '?first_name=Edward';
			$query_string .= '&success=true';
				header('Location: http://' . $server_dir . $next_page . $query_string);
		}
	}
?>