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
$product = filter_var($_POST['product'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$title   = filter_var($_POST['tipTitle'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$tipBody   = filter_var($_POST['tipBody'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

if(array_key_exists('uploaded_file', $_FILES)){
  $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['uploaded_file']['name']));
}

//for body and sending email

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("\nProduct: <b>%s</b><br />\n",$product);
		$body .= sprintf("\nEmail: <b>%s</b><br />\n",$email);
		$body .= sprintf("<hr />");
		$body .= sprintf("\n<h3>%s</h3>\n",$title);
		$body .= sprintf("\n<br/><b>Sales Tip:</b><br/>\n");
		$body .= wordwrap(sprintf($tipBody."<br /><br/>",75,"\n"));
		$body .= sprintf("\nFile uploaded: <b>%s</b>",$_FILES['uploaded_file']['name']);
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('dan@htslabs.com', 'dan klotz');
			$mail->addReplyTo($email, 'sales staff');
			$mail->addAddress('dan@htslabs.com', 'dan in marketing');
			$mail->Subject = "NEW SALES TIP!";
			$mail->msgHTML($body);
			if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile)) {
			  $attachmentName = date('m\-d\-Y\-h:iA')."-".$_FILES['uploaded_file']['name'];
			  $mail->addAttachment($uploadfile, $attachmentName);
			}
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . " | sales tip form | " . $mail_error . "\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
			  $success_ip = $_SERVER['REMOTE_ADDR'];
				$success_date = date('m\-d\-Y\-h:iA');
				$success_message = $success_date . " | sales tip form | " . $success_ip . " | " . $email;
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