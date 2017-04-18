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
$url = filter_var($_POST['tweetURL'], FILTER_SANITIZE_URL);
$why   = filter_var($_POST['why'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

//for body and sending email

	if (is_array($_POST)){
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		
		$body .= sprintf("<h2>Tweet Suggestion from sales:</h2>\n");
		$body .= sprintf("<hr />");
		$body .= sprintf("\nEmail: <b>%s</b><br />\n",$email);
		$body .= sprintf("\nTweet URL: <b>%s</b><br />\n",$url);
		$body .= sprintf("\nWhy Tweet this: <b>%s</b><br />\n",$why);
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");

		if (trim($_POST['important-input']) == ''){
			$mail = new PHPMailer;
			$mail->setFrom('dan@htslabs.com', 'Tweet Suggestion');
			$mail->addReplyTo($email);
			$mail->addAddress('dan@htslabs.com', 'Dan in Marketing');
			$mail->Subject = "Suggested Tweet from Sales";
			$mail->msgHTML($body);
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . " | suggest a tweet | " . $mail_error . "\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
			  $success_ip = $_SERVER['REMOTE_ADDR'];
				$success_date = date('m\-d\-Y\-h:iA');
				$success_message = $success_date . " | suggest a tweet | " . $success_ip . " | " . $email;
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