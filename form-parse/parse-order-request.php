<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
header('HTTP/1.1 303 See Other');

//variables form $_POST[]
//Company Info
$companyName = $_POST['companyName'];
//Credit Card
$nameOnCard = $_POST['nameOnCard'];
$creditNumber = $_POST['creditNumber'];
//check what type of card issued
$CCcheck = substr($creditNumber, 0, 1);
switch ($CCcheck) {
	case '3':
		$CC = "Amex";
		break;

	case '4':
		$CC = "VISA";
		break;

	case '5':
		$CC = "MC";
		break;
	
	default:
		$CC = "unknown card";
		break;
}
//the po number issue (mindware unable to be edited so ... this)
$ccPo = $_POST['ccPo'];
$poNumber = $_POST['poNumber'];
$realPo = "";
if($ccPo === "" && $poNumber === ""){
  $realPo = "";
}elseif($ccPo != $poNumber){
  if($ccPo === "" && $poNumber != ""){
    $realPo = $poNumber;
  }elseif($poNumber === "" && $ccPo != ""){
    $realPo = $ccPo;
  }
}

$ExpMo = $_POST['ExpMo'];
$ExpYr = $_POST['ExpYr'];
$secCode = $_POST['secCode'];
$CCbillingAdd = $_POST['CCbillingAdd'];
$CCbillingCity = $_POST['CCbillingCity'];
$CCbillingState = $_POST['CCbillingState'];
$CCbillingZip = $_POST['CCbillingZip'];
//is is a cc order? (this is because we changed the form and parsing code is uneditable for the CSV)
$ccOrder = $_POST['ccOrder'];


//Purchaseing
$purchEmail = $_POST['purchEmail'];
$purchFname = $_POST['purchFname'];
$purchLname = $_POST['purchLname'];
$purchPhone = $_POST['purchPhone'];
$purchExt = $_POST['purchExt'];
$purchFax = $_POST['purchFax'];
//user
$userEmail = $_POST['userEmail'];
$userFname = $_POST['userFname'];
$userLname = $_POST['userLname'];
$userPhone = $_POST['userPhone'];
//shipping
$shipAdd1 = $_POST['shipAdd'][0];
$shipAdd2 = $_POST['shipAdd'][1];
$shipAdd3 = $_POST['shipAdd'][2];
$shipCity = $_POST['shipCity'];
$shipState = $_POST['shipState'];
$shipZip = $_POST['shipZip'];
$shipCountry = $_POST['shipCountry'];
$shipAttn = $_POST['shipAttn'];
//billing
$billEmail = $_POST['billEmail'];
$billFname = $_POST['billFname'];
$billLname = $_POST['billLname'];
$billPhone = $_POST['billPhone'];
$billAdd1 = $_POST['billAdd'][0];
$billAdd2 = $_POST['billAdd'][1];
$billAdd3 = $_POST['billAdd'][2];
$billCity = $_POST['billCity'];
$billState = $_POST['billState'];
$billZip = $_POST['billZip'];
$billCountry = $_POST['billCountry'];
$billAttn = $_POST['billAttn'];
//order
$Qty1 = $_POST['Qty'][0];
$Qty2 = $_POST['Qty'][1];
$Qty3 = $_POST['Qty'][2];
$Qty4 = $_POST['Qty'][3];
$Qty5 = $_POST['Qty'][4];
$Qty6 = $_POST['Qty'][5];
$Qty7 = $_POST['Qty'][6];
$Qty8 = $_POST['Qty'][7];
$Qty9 = $_POST['Qty'][8];
$Qty10 = $_POST['Qty'][9];
$Pno1 = $_POST['Pno'][0];
$Pno2 = $_POST['Pno'][1];
$Pno3 = $_POST['Pno'][2];
$Pno4 = $_POST['Pno'][3];
$Pno5 = $_POST['Pno'][4];
$Pno6 = $_POST['Pno'][5];
$Pno7 = $_POST['Pno'][6];
$Pno8 = $_POST['Pno'][7];
$Pno9 = $_POST['Pno'][8];
$Pno10 = $_POST['Pno'][9];
$price1 = $_POST['price'][0];
$price2 = $_POST['price'][1];
$price3 = $_POST['price'][2];
$price4 = $_POST['price'][3];
$price5 = $_POST['price'][4];
$price6 = $_POST['price'][5];
$price7 = $_POST['price'][6];
$price8 = $_POST['price'][7];
$price9 = $_POST['price'][8];
$price10 = $_POST['price'][9];
$quoteNo1 = $_POST['quoteNo'][0];
$quoteNo2 = $_POST['quoteNo'][1];
$quoteNo3 = $_POST['quoteNo'][2];
$quoteNo4 = $_POST['quoteNo'][3];
$quoteNo5 = $_POST['quoteNo'][4];
$quoteNo6 = $_POST['quoteNo'][5];
$quoteNo7 = $_POST['quoteNo'][6];
$quoteNo8 = $_POST['quoteNo'][7];
$quoteNo9 = $_POST['quoteNo'][8];
$quoteNo10 = $_POST['quoteNo'][9];
$shipping1 = $_POST['shipping'][0];
$shipping2 = $_POST['shipping'][1];
$shipping3 = $_POST['shipping'][2];
$shipping4 = $_POST['shipping'][3];
$shipping5 = $_POST['shipping'][4];
$shipping6 = $_POST['shipping'][5];
$shipping7 = $_POST['shipping'][6];
$shipping8 = $_POST['shipping'][7];
$shipping9 = $_POST['shipping'][8];
$shipping10 = $_POST['shipping'][9];
$dateReq1 = $_POST['dateReq'][0];
$dateReq2 = $_POST['dateReq'][1];
$dateReq3 = $_POST['dateReq'][2];
$dateReq4 = $_POST['dateReq'][3];
$dateReq5 = $_POST['dateReq'][4];
$dateReq6 = $_POST['dateReq'][5];
$dateReq7 = $_POST['dateReq'][6];
$dateReq8 = $_POST['dateReq'][7];
$dateReq9 = $_POST['dateReq'][8];
$dateReq10 = $_POST['dateReq'][9];
//comments
$comments = $_POST['comments'];

//for redirect and query
$first_name = trim($_POST['purchFname']);
$query_string = '?first_name=' . $first_name;
$server_dir = $_SERVER['HTTP_HOST'] . '/';
$next_page = 'order/';

	if (is_array($_POST)){
		
		//for creation of CSV file
		$creditInfo = "$CC\",\"$ExpMo\",\"$ExpYr\",\"$secCode";
		$creditNumber = "$creditNumber";
		$creditName = "$nameOnCard";
		$creditAddress = "$CCbillingAdd";
		$creditCity = "$CCbillingCity";
		$creditState = "$CCbillingState";
		$creditZip = "$CCbillingZip";

		$fp = fopen("5150/public.pem","r");
		$pubKey = fread($fp,8192);
		fclose($fp);

		openssl_public_encrypt($creditInfo, $creditInfoLocked, $pubKey);
		$creditInfoUsable = base64_encode($creditInfoLocked);

		openssl_public_encrypt($creditNumber, $creditNumberLocked, $pubKey);
		$creditNumberUsable = base64_encode($creditNumberLocked);

		openssl_public_encrypt($creditName, $creditNameLocked, $pubKey);
		$creditNameUsable = base64_encode($creditNameLocked);

		openssl_public_encrypt($creditAddress, $creditAddressLocked, $pubKey);
		$creditAddressUsable = base64_encode($creditAddressLocked);

		openssl_public_encrypt($creditCity, $creditCityLocked, $pubKey);
		$creditCityUsable = base64_encode($creditCityLocked);

		openssl_public_encrypt($creditState, $creditStateLocked, $pubKey);
		$creditStateUsable = base64_encode($creditStateLocked);

		openssl_public_encrypt($creditZip, $creditZipLocked, $pubKey);
		$creditZipUsable = base64_encode($creditZipLocked);

		$companyInformation = array("$companyName","$realPo","$ccOrder","$creditInfoUsable","$creditNumberUsable","$creditNameUsable","$creditAddressUsable","$creditCityUsable","$creditStateUsable","$creditZipUsable","$purchFname","$purchLname","$purchPhone","$purchExt","$purchFax","$userEmail","$userFname","$userLname","$userPhone","$shipAdd1","$shipAdd2","$shipAdd3","$shipCity","$shipState","$shipZip","$shipCountry","$shipAttn","$billEmail","$billFname","$billLname","$billPhone","$billAdd1","$billAdd2","$billAdd3","$billCity","$billState","$billZip","$billCountry","$billAttn","$comments","$purchEmail");

		$order1 = array("$Qty1","$Pno1","$price1","$quoteNo1","$shipping1","$dateReq1");
		$order2 = array("$Qty2","$Pno2","$price2","$quoteNo2","$shipping2","$dateReq2");
		$order3 = array("$Qty3","$Pno3","$price3","$quoteNo3","$shipping3","$dateReq3");
		$order4 = array("$Qty4","$Pno4","$price4","$quoteNo4","$shipping4","$dateReq4");
		$order5 = array("$Qty5","$Pno5","$price5","$quoteNo5","$shipping5","$dateReq5");
		$order6 = array("$Qty6","$Pno6","$price6","$quoteNo6","$shipping6","$dateReq6");
		$order7 = array("$Qty7","$Pno7","$price7","$quoteNo7","$shipping7","$dateReq7");
		$order8 = array("$Qty8","$Pno8","$price8","$quoteNo8","$shipping8","$dateReq8");
		$order9 = array("$Qty9","$Pno9","$price9","$quoteNo9","$shipping9","$dateReq9");
		$order10 = array("$Qty10","$Pno10","$price10","$quoteNo10","$shipping10","$dateReq10");

		//creation of csv file
		$date = date('m\-d\-Y\-h:iA');
		$name = $companyName;
		$name = preg_replace("/[^a-zA-Z 0-9]+/", " ", $name);//strip all special characters from name
		$file = "orders/$name-$date.csv";
		$fp = fopen($file,"a+");
		fwrite($fp,"4EJ5JQo42t2P0eLoUpHh,");
		fwrite($fp,"\n");
		fputcsv($fp,$companyInformation);
		fputcsv($fp,$order1);
		fputcsv($fp,$order2);
		fputcsv($fp,$order3);
		fputcsv($fp,$order4);
		fputcsv($fp,$order5);
		fputcsv($fp,$order6);
		fputcsv($fp,$order7);
		fputcsv($fp,$order8);
		fputcsv($fp,$order9);
		fputcsv($fp,$order10);
		fwrite($fp,"Bl0RNZxBVnHKbxs50V5y");
		fclose($fp);
		
		//body variable for email to Thomson
		$body  = sprintf("<html>"); 
		$body .= sprintf("<body>");
		$body .= sprintf("<hr /><h3>Company: %s</h3>",$_POST['companyName']);
		$body .= sprintf("PO #: <strong>%s</strong>\n",$realPo);
		$body .= sprintf("<br />Credit Card Order: <strong>%s</strong>\n",$_POST['ccOrder']);

		$body .= sprintf("<hr /><h3>Purchasing Information</h3>");
		$body .= sprintf("Purchasing Agent Email: <strong>%s</strong>\n",$_POST['purchEmail']);
		$body .= sprintf("<br />Purchasing Agent Name: <strong>%s %s</strong>\n",$_POST['purchFname'],$_POST['purchLname']);
		$body .= sprintf("<br />Purchasing Agent Telephone: <strong>%s</strong>\n",$_POST['purchPhone']);
		$body .= sprintf("<br />Purchasing Agent Ext: <strong>%s</strong>\n",$_POST['purchExt']);
		$body .= sprintf("<br />Purchasing Agent Fax: <strong>%s</strong>\n",$_POST['purchFax']);

		$body .= sprintf("<hr /><h3>End User Information</h3>");
		$body .= sprintf("End User Email: <strong>%s</strong>\n",$_POST['userEmail']);
		$body .= sprintf("<br />End User Name: <strong>%s %s</strong>\n",$_POST['userFname'],$_POST['userLname']);
		$body .= sprintf("<br />End User Telephone: <strong>%s</strong>\n",$_POST['userPhone']);

		$body .= sprintf("<hr /><h3>Billing Information</h3>");
		$body .= sprintf("Email: <strong>%s</strong>\n",$_POST['billEmail']);
		$body .= sprintf("<br />Name: <strong>%s %s</strong>\n",$_POST['billFname'],$_POST['billLname']);
		$body .= sprintf("<br />Telephone: <strong>%s</strong><br />\n",$_POST['billPhone']);

		foreach ($_POST['billAdd'] as $address)
		{$body .= sprintf("Address: <strong>%s</strong><br />\n",$address);}

		$body .= sprintf("City: <strong>%s</strong>\n",$_POST['billCity']);
		$body .= sprintf("<br />State: <strong>%s</strong>\n",$_POST['billState']);
		$body .= sprintf("<br />Zip: <strong>%s</strong>\n",$_POST['billZip']);
		$body .= sprintf("<br />Country: <strong>%s</strong>\n",$_POST['billCountry']);
		$body .= sprintf("<br />Attention: <strong>%s</strong>\n",$_POST['billAttn']);

		$body .= sprintf("<hr /><h3>Shipping Information</h3>");

		foreach ($_POST['shipAdd'] as $address){
			$body .= sprintf("Address: <strong>%s</strong><br />\n",$address);
		}

		$body .= sprintf("City: <strong>%s</strong>\n",$_POST['shipCity']);
		$body .= sprintf("<br />State: <strong>%s</strong>\n",$_POST['shipState']);
		$body .= sprintf("<br />Zip: <strong>%s</strong>\n",$_POST['shipZip']);
		$body .= sprintf("<br />Country: <strong>%s</strong>\n",$_POST['shipCountry']);
		$body .= sprintf("<br />Attention: <strong>%s</strong>\n",$_POST['shipAttn']);

		$body .= sprintf("<hr /><h3>Items Ordered</h3>");
		$body .= sprintf("<table cellpadding=\"5\" border=\"1\" pa>\n");
		$body .= sprintf("\n<tr><th>Qty</th><th>Product No.</th><th>Price</th><th>Quote#</th><th>Shipping</th><th>Delivery Date</th></tr>\n");

		foreach($_POST['Qty'] as $i => $q){
			if ($q){
				$body .= sprintf("\n<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",str_pad($q,5),str_pad($_POST['Pno'][$i],8),$_POST['price'][$i],$_POST['quoteNo'][$i],$_POST['shipping'][$i],$_POST['dateReq'][$i]);
			}
		}

		$body .= sprintf("</table>");
		$body .= sprintf("<hr /><h3>Comments</h3>");
		$body .= sprintf("%s",wordwrap(strip_tags($_POST['comments']),60,"<br />"));
		$body .= sprintf("<hr />");
		$body .= sprintf("For internal use:");
		$body .= sprintf("<br />-----------------");
		$body .= sprintf("<br />Sender's IP: %s", $_SERVER['REMOTE_ADDR']);
		$body .= sprintf("<br />Received: %s",date("Y-m-d H:i:s"));
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");


		//body for email to customer
		$custEmail  = sprintf("<html>"); 
		$custEmail .= sprintf("<body>");
		$custEmail .= sprintf("<h2>Copy of your Thomson Quick Order</h2>\n");
		$custEmail .= sprintf("<p>Thank you for your order. Please see below for a copy of your submittal. Please contact Customer Service with any changes or additions. Customer Service will send an additional confirm once processed.</p>\n");
		$custEmail .= sprintf("<p>Customer Service<br>\n");
		$custEmail .= sprintf("Thomson Instrument Company<br>\n");
		$custEmail .= sprintf("customerservice@htslabs.com<br>\n");
		$custEmail .= sprintf("P: 760.757.8080<br>\n");
		$custEmail .= sprintf("F: 760.757.9367</p>\n");
		$custEmail .= sprintf("<hr /><h3>Company: %s</h3>\n",$_POST['companyName']);
		$custEmail .= sprintf("PO #: <strong>%s</strong>\n",$realPo);
		$custEmail .= sprintf("<br />Credit Card Order: <strong>%s</strong>\n",$_POST['ccOrder']);

		$custEmail .= sprintf("<hr /><h3>Purchasing Information</h3>");
		$custEmail .= sprintf("Purchasing Agent Email: <strong>%s</strong>\n",$_POST['purchEmail']);
		$custEmail .= sprintf("<br />Purchasing Agent Name: <strong>%s %s</strong>\n",$_POST['purchFname'],$_POST['purchLname']);
		$custEmail .= sprintf("<br />Purchasing Agent Telephone: <strong>%s</strong>\n",$_POST['purchPhone']);
		$custEmail .= sprintf("<br />Purchasing Agent Ext: <strong>%s</strong>\n",$_POST['purchExt']);
		$custEmail .= sprintf("<br />Purchasing Agent Fax: <strong>%s</strong>\n",$_POST['purchFax']);

		$custEmail .= sprintf("<hr /><h3>End User Information</h3>");
		$custEmail .= sprintf("End User Email: <strong>%s</strong>\n",$_POST['userEmail']);
		$custEmail .= sprintf("<br />End User Name: <strong>%s %s</strong>\n",$_POST['userFname'],$_POST['userLname']);
		$custEmail .= sprintf("<br />End User Telephone: <strong>%s</strong>\n",$_POST['userPhone']);

		$custEmail .= sprintf("<hr /><h3>Billing Information</h3>");
		$custEmail .= sprintf("Email: <strong>%s</strong>\n",$_POST['billEmail']);
		$custEmail .= sprintf("<br />Name: <strong>%s %s</strong>\n",$_POST['billFname'],$_POST['billLname']);
		$custEmail .= sprintf("<br />Telephone: <strong>%s</strong><br />\n",$_POST['billPhone']);

		foreach ($_POST['billAdd'] as $address)
		{$custEmail .= sprintf("Address: <strong>%s</strong><br />\n",$address);}

		$custEmail .= sprintf("City: <strong>%s</strong>\n",$_POST['billCity']);
		$custEmail .= sprintf("<br />State: <strong>%s</strong>\n",$_POST['billState']);
		$custEmail .= sprintf("<br />Zip: <strong>%s</strong>\n",$_POST['billZip']);
		$custEmail .= sprintf("<br />Country: <strong>%s</strong>\n",$_POST['billCountry']);
		$custEmail .= sprintf("<br />Attention: <strong>%s</strong>\n",$_POST['billAttn']);

		$custEmail .= sprintf("<hr /><h3>Shipping Information</h3>");

		foreach ($_POST['shipAdd'] as $address){
			$custEmail .= sprintf("Address: <strong>%s</strong><br />\n",$address);
		}

		$custEmail .= sprintf("City: <strong>%s</strong>\n",$_POST['shipCity']);
		$custEmail .= sprintf("<br />State: <strong>%s</strong>\n",$_POST['shipState']);
		$custEmail .= sprintf("<br />Zip: <strong>%s</strong>\n",$_POST['shipZip']);
		$custEmail .= sprintf("<br />Country: <strong>%s</strong>\n",$_POST['shipCountry']);
		$custEmail .= sprintf("<br />Attention: <strong>%s</strong>\n",$_POST['shipAttn']);

		$custEmail .= sprintf("<hr /><h3>Items Ordered</h3>");
		$custEmail .= sprintf("<table cellpadding=\"5\" border=\"1\" pa>\n");
		$custEmail .= sprintf("\n<tr><th>Qty</th><th>Product No.</th><th>Price</th><th>Quote#</th><th>Shipping</th><th>Delivery Date</th></tr>\n");

		foreach($_POST['Qty'] as $i => $q){
			if ($q){
				$custEmail .= sprintf("\n<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",str_pad($q,5),str_pad($_POST['Pno'][$i],8),$_POST['price'][$i],$_POST['quoteNo'][$i],$_POST['shipping'][$i],$_POST['dateReq'][$i]);
			}
		}

		$custEmail .= sprintf("</table>");
		$custEmail .= sprintf("<hr /><h3>Comments</h3>");
		$custEmail .= sprintf("%s",wordwrap(strip_tags($_POST['comments']),60,"<br />"));
		$custEmail .= sprintf("</body>");
		$custEmail .= sprintf("</html>");

		//lets send some emails!

		if (trim($_POST['important-input']) == ''){
			$Custmail = new PHPMailer;
			$Custmail->setFrom('customerservice@htslabs.com', "Thomson Instrument Company");
			$Custmail->addReplyTo('customerservice@htslabs.com', "Thomson Instrument Company");
			$Custmail->addAddress($_POST['purchEmail'], 'Thomson Quick Order Form');
			$Custmail->Subject = "Copy of Thomson Quick Order for – " . $_POST['companyName'];
			$Custmail->msgHTML($custEmail);
			$Custmail->send();

			//to Thomson
			$mail = new PHPMailer;
			$mail->setFrom($_POST['purchEmail'], $_POST['purchFname']." ".$_POST['purchLname']);
			$mail->addReplyTo($_POST['purchEmail'], $_POST['purchFname']." ".$_POST['purchLname']);
			//$mail->addAddress('customerservice@htslabs.com', 'Quick Order Form');
			$mail->addAddress('web_test@htslabs.com', 'Contact Form');	//uncoment for testing to dan@htslabs.com
			$mail->Subject = "ORDER - " . $_POST['companyName'];
			$mail->msgHTML($body);
			$mail->addAttachment($file);
			//unlink($file); uncomment to delete file
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/order-request-error.txt";
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