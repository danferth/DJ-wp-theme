<?php
require_once("PHPMailer/PHPMailerAutoload.php");
date_default_timezone_set('America/Los_Angeles');
header('HTTP/1.1 303 See Other');

//trim post
array_walk($_POST, 'trim_value');
//================================
//======VARIABLES=================
//================================

//Company Info
$companyName = filter_var($_POST['companyName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//Credit Card
$nameOnCard = filter_var($_POST['nameOnCard'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$creditNumber = filter_var($_POST['creditNumber'], FILTER_SANITIZE_NUMBER_INT);
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
$ccPo = filter_var($_POST['ccPo'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$poNumber = filter_var($_POST['poNumber'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$realPo = "";

if($ccPo === "" && $poNumber === ""){
  $realPo = "";
}elseif($ccPo != "" && $ccPo === $poNumber){
  $realPo = $poNumber;
}elseif($ccPo != $poNumber){
  if($ccPo === "" && $poNumber != ""){
    $realPo = $poNumber;
  }elseif($poNumber === "" && $ccPo != ""){
    $realPo = $ccPo;
  }
}

$ExpMo          = filter_var($_POST['ExpMo'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$ExpYr          = filter_var($_POST['ExpYr'], FILTER_SANITIZE_NUMBER_INT);
$secCode        = filter_var($_POST['secCode'], FILTER_SANITIZE_NUMBER_INT);
$CCbillingAdd   = filter_var($_POST['CCbillingAdd'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$CCbillingCity  = filter_var($_POST['CCbillingCity'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$CCbillingState = filter_var($_POST['CCbillingState'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$CCbillingZip   = filter_var($_POST['CCbillingZip'], FILTER_SANITIZE_NUMBER_INT);
//is is a cc order? (this is because we changed the form and parsing code is uneditable for the CSV)
$ccOrder = '';
if(isset($_POST['creditNumber']) && $_POST['creditNumber'] != ""){
  $ccOrder = "Yes";
}else{
  $ccOrder = "No";
}
//Purchaseing
$purchEmail     = filter_var($_POST['purchEmail'], FILTER_SANITIZE_EMAIL);
$purchFname     = filter_var($_POST['purchFname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$purchLname     = filter_var($_POST['purchLname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$purchPhone     = filter_var($_POST['purchPhone'], FILTER_SANITIZE_NUMBER_INT);
$purchExt       = filter_var($_POST['purchExt'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$purchFax       = filter_var($_POST['purchFax'], FILTER_SANITIZE_NUMBER_INT);
//user
$userEmail      = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);
$userFname      = filter_var($_POST['userFname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$userLname      = filter_var($_POST['userLname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$userPhone      = filter_var($_POST['userPhone'], FILTER_SANITIZE_NUMBER_INT);
//shipping
$shipAdd1       = filter_var($_POST['shipAdd'][0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipAdd2       = filter_var($_POST['shipAdd'][1], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipAdd3       = filter_var($_POST['shipAdd'][2], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipCity       = filter_var($_POST['shipCity'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipState      = filter_var($_POST['shipState'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipZip        = filter_var($_POST['shipZip'], FILTER_SANITIZE_NUMBER_INT);
$shipCountry    = filter_var($_POST['shipCountry'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$shipAttn       = filter_var($_POST['shipAttn'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//billing
$billEmail      = filter_var($_POST['billEmail'], FILTER_SANITIZE_EMAIL);
$billFname      = filter_var($_POST['billFname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billLname      = filter_var($_POST['billLname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billPhone      = filter_var($_POST['billPhone'], FILTER_SANITIZE_NUMBER_INT);
$billAdd1       = filter_var($_POST['billAdd'][0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billAdd2       = filter_var($_POST['billAdd'][1], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billAdd3       = filter_var($_POST['billAdd'][2], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billCity       = filter_var($_POST['billCity'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billState      = filter_var($_POST['billState'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billZip        = filter_var($_POST['billZip'], FILTER_SANITIZE_NUMBER_INT);
$billCountry    = filter_var($_POST['billCountry'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
$billAttn       = filter_var($_POST['billAttn'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
//order
function sanitize_int(&$value){
  $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
}
function sanitize_str(&$value){
  $value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
}
array_walk($_POST['Qty'], 'sanitize_int');
$Qty1           = $_POST['Qty'][0];
$Qty2           = $_POST['Qty'][1];
$Qty3           = $_POST['Qty'][2];
$Qty4           = $_POST['Qty'][3];
$Qty5           = $_POST['Qty'][4];
$Qty6           = $_POST['Qty'][5];
$Qty7           = $_POST['Qty'][6];
$Qty8           = $_POST['Qty'][7];
$Qty9           = $_POST['Qty'][8];
$Qty10          = $_POST['Qty'][9];
array_walk($_POST['Pno'], 'sanitize_str');
$Pno1           = $_POST['Pno'][0];
$Pno2           = $_POST['Pno'][1];
$Pno3           = $_POST['Pno'][2];
$Pno4           = $_POST['Pno'][3];
$Pno5           = $_POST['Pno'][4];
$Pno6           = $_POST['Pno'][5];
$Pno7           = $_POST['Pno'][6];
$Pno8           = $_POST['Pno'][7];
$Pno9           = $_POST['Pno'][8];
$Pno10          = $_POST['Pno'][9];
array_walk($_POST['price'], 'sanitize_str');
$price1         = $_POST['price'][0];
$price2         = $_POST['price'][1];
$price3         = $_POST['price'][2];
$price4         = $_POST['price'][3];
$price5         = $_POST['price'][4];
$price6         = $_POST['price'][5];
$price7         = $_POST['price'][6];
$price8         = $_POST['price'][7];
$price9         = $_POST['price'][8];
$price10        = $_POST['price'][9];
array_walk($_POST['quoteNo'], 'sanitize_int');
$quoteNo1       = $_POST['quoteNo'][0];
$quoteNo2       = $_POST['quoteNo'][1];
$quoteNo3       = $_POST['quoteNo'][2];
$quoteNo4       = $_POST['quoteNo'][3];
$quoteNo5       = $_POST['quoteNo'][4];
$quoteNo6       = $_POST['quoteNo'][5];
$quoteNo7       = $_POST['quoteNo'][6];
$quoteNo8       = $_POST['quoteNo'][7];
$quoteNo9       = $_POST['quoteNo'][8];
$quoteNo10      = $_POST['quoteNo'][9];
// $shipping1      = filter_var($_POST['shipping'][0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping2      = filter_var($_POST['shipping'][1], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping3      = filter_var($_POST['shipping'][2], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping4      = filter_var($_POST['shipping'][3], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping5      = filter_var($_POST['shipping'][4], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping6      = filter_var($_POST['shipping'][5], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping7      = filter_var($_POST['shipping'][6], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping8      = filter_var($_POST['shipping'][7], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping9      = filter_var($_POST['shipping'][8], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
// $shipping10     = filter_var($_POST['shipping'][9], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);
array_walk($_POST['dateReq'], 'sanitize_str');
$dateReq1       = $_POST['dateReq'][0];
$dateReq2       = $_POST['dateReq'][1];
$dateReq3       = $_POST['dateReq'][2];
$dateReq4       = $_POST['dateReq'][3];
$dateReq5       = $_POST['dateReq'][4];
$dateReq6       = $_POST['dateReq'][5];
$dateReq7       = $_POST['dateReq'][6];
$dateReq8       = $_POST['dateReq'][7];
$dateReq9       = $_POST['dateReq'][8];
$dateReq10      = $_POST['dateReq'][9];
//comments
$comments       = filter_var($_POST['comments'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_ENCODE_HIGH);

//for redirect and query
$first_name = $purchFname;
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

		// $order1 = array("$Qty1","$Pno1","$price1","$quoteNo1","$shipping1","$dateReq1");
		// $order2 = array("$Qty2","$Pno2","$price2","$quoteNo2","$shipping2","$dateReq2");
		// $order3 = array("$Qty3","$Pno3","$price3","$quoteNo3","$shipping3","$dateReq3");
		// $order4 = array("$Qty4","$Pno4","$price4","$quoteNo4","$shipping4","$dateReq4");
		// $order5 = array("$Qty5","$Pno5","$price5","$quoteNo5","$shipping5","$dateReq5");
		// $order6 = array("$Qty6","$Pno6","$price6","$quoteNo6","$shipping6","$dateReq6");
		// $order7 = array("$Qty7","$Pno7","$price7","$quoteNo7","$shipping7","$dateReq7");
		// $order8 = array("$Qty8","$Pno8","$price8","$quoteNo8","$shipping8","$dateReq8");
		// $order9 = array("$Qty9","$Pno9","$price9","$quoteNo9","$shipping9","$dateReq9");
		// $order10 = array("$Qty10","$Pno10","$price10","$quoteNo10","$shipping10","$dateReq10");

    $order1 = array("$Qty1","$Pno1","$price1","$quoteNo1","$dateReq1");
		$order2 = array("$Qty2","$Pno2","$price2","$quoteNo2","$dateReq2");
		$order3 = array("$Qty3","$Pno3","$price3","$quoteNo3","$dateReq3");
		$order4 = array("$Qty4","$Pno4","$price4","$quoteNo4","$dateReq4");
		$order5 = array("$Qty5","$Pno5","$price5","$quoteNo5","$dateReq5");
		$order6 = array("$Qty6","$Pno6","$price6","$quoteNo6","$dateReq6");
		$order7 = array("$Qty7","$Pno7","$price7","$quoteNo7","$dateReq7");
		$order8 = array("$Qty8","$Pno8","$price8","$quoteNo8","$dateReq8");
		$order9 = array("$Qty9","$Pno9","$price9","$quoteNo9","$dateReq9");
		$order10 = array("$Qty10","$Pno10","$price10","$quoteNo10","$dateReq10");

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
		$body .= sprintf("<hr /><h3>Company: %s</h3>",$companyName);
		$body .= sprintf("PO #: <b>%s</b>\n",$realPo);
		$body .= sprintf("<br />Credit Card Order: <b>%s</b>\n",$ccOrder);

		$body .= sprintf("<hr /><h3>Purchasing Information</h3>");
		$body .= sprintf("Purchasing Agent Email: <b>%s</b>\n",$purchEmail);
		$body .= sprintf("<br />Purchasing Agent Name: <b>%s %s</b>\n",$purchFname,$purchLname);
		$body .= sprintf("<br />Purchasing Agent Telephone: <b>%s</b>\n",$purchPhone);
		$body .= sprintf("<br />Purchasing Agent Ext: <b>%s</b>\n",$purchExt);
		$body .= sprintf("<br />Purchasing Agent Fax: <b>%s</b>\n",$purchFax);

		$body .= sprintf("<hr /><h3>End User Information</h3>");
		$body .= sprintf("End User Email: <b>%s</b>\n",$userEmail);
		$body .= sprintf("<br />End User Name: <b>%s %s</b>\n",$userFname,$userLname);
		$body .= sprintf("<br />End User Telephone: <b>%s</b>\n",$userPhone);

		$body .= sprintf("<hr /><h3>Billing Information</h3>");
		$body .= sprintf("Email: <b>%s</b>\n",$billEmail);
		$body .= sprintf("<br />Name: <b>%s %s</b>\n",$billFname,$billLname);
		$body .= sprintf("<br />Telephone: <b>%s</b><br />\n",$billPhone);


		$body .= sprintf("Address: <b>%s</b><br />\n",$billAdd1);
		$body .= sprintf("Address: <b>%s</b><br />\n",$billAdd2);
		$body .= sprintf("Address: <b>%s</b><br />\n",$billAdd3);

		$body .= sprintf("City: <b>%s</b>\n",$billCity);
		$body .= sprintf("<br />State: <b>%s</b>\n",$billState);
		$body .= sprintf("<br />Zip: <b>%s</b>\n",$billZip);
		$body .= sprintf("<br />Country: <b>%s</b>\n",$billCountry);
		$body .= sprintf("<br />Attention: <b>%s</b>\n",$billAttn);

		$body .= sprintf("<hr /><h3>Shipping Information</h3>");


		$body .= sprintf("Address: <b>%s</b><br />\n",$shipAdd1);
		$body .= sprintf("Address: <b>%s</b><br />\n",$shipAdd2);
		$body .= sprintf("Address: <b>%s</b><br />\n",$shipAdd3);


		$body .= sprintf("City: <b>%s</b>\n",$shipCity);
		$body .= sprintf("<br />State: <b>%s</b>\n",$shipState);
		$body .= sprintf("<br />Zip: <b>%s</b>\n",$shipZip);
		$body .= sprintf("<br />Country: <b>%s</b>\n",$shipCountry);
		$body .= sprintf("<br />Attention: <b>%s</b>\n",$shipAttn);

		$body .= sprintf("<hr /><h3>Items Ordered</h3>");
		$body .= sprintf("<table cellpadding=\"5\" border=\"1\" pa>\n");
		$body .= sprintf("\n<tr><th>Qty</th><th>Product No.</th><th>Price</th><th>Quote#</th><th>Requested Delivery Date</th></tr>\n");

		foreach($_POST['Qty'] as $i => $q){
			if ($q){
				$body .= sprintf("\n<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",str_pad($q,5),str_pad($_POST['Pno'][$i],8),$_POST['price'][$i],$_POST['quoteNo'][$i],$_POST['dateReq'][$i]);
			}
		}

		$body .= sprintf("</table>");
		$body .= sprintf("<hr /><h3>Comments</h3>");
		$body .= sprintf("%s",wordwrap($comments,60,"<br />"));
		$body .= sprintf("</body>");
		$body .= sprintf("</html>");


		//body for email to customer
		$custEmail  = sprintf("<html>"); 
		$custEmail .= sprintf("<body>");
		$custEmail .= sprintf("<h2>Copy of your Thomson Quick Order</h2>\n");
		$custEmail .= sprintf("<p>Thank you for your order, below is a copy of your submittal. Please contact Customer Service with any changes or additions. Customer Service will send an additional confirm once processed.</p>\n");
		$custEmail .= sprintf("<p>Customer Service<br>\n");
		$custEmail .= sprintf("Thomson Instrument Company<br>\n");
		$custEmail .= sprintf("customerservice@htslabs.com<br>\n");
		$custEmail .= sprintf("P: 760.757.8080<br>\n");
		$custEmail .= sprintf("F: 760.757.9367</p>\n");
		$custEmail .= sprintf("<hr /><h3>Company: %s</h3>\n",$companyName);
		$custEmail .= sprintf("PO #: <b>%s</b>\n",$realPo);
		$custEmail .= sprintf("<br />Credit Card Order: <b>%s</b>\n",$ccOrder);

		$custEmail .= sprintf("<hr /><h3>Purchasing Information</h3>");
		$custEmail .= sprintf("Purchasing Agent Email: <b>%s</b>\n",$purchEmail);
		$custEmail .= sprintf("<br />Purchasing Agent Name: <b>%s %s</b>\n",$purchFname,$purchLname);
		$custEmail .= sprintf("<br />Purchasing Agent Telephone: <b>%s</b>\n",$purchPhone);
		$custEmail .= sprintf("<br />Purchasing Agent Ext: <b>%s</b>\n",$purchExt);
		$custEmail .= sprintf("<br />Purchasing Agent Fax: <b>%s</b>\n",$purchFax);

		$custEmail .= sprintf("<hr /><h3>End User Information</h3>");
		$custEmail .= sprintf("End User Email: <b>%s</b>\n",$userEmail);
		$custEmail .= sprintf("<br />End User Name: <b>%s %s</b>\n",$userFname,$userLname);
		$custEmail .= sprintf("<br />End User Telephone: <b>%s</b>\n",$userPhone);

		$custEmail .= sprintf("<hr /><h3>Billing Information</h3>");
		$custEmail .= sprintf("Email: <b>%s</b>\n",$billEmail);
		$custEmail .= sprintf("<br />Name: <b>%s %s</b>\n",$billFname,$billLname);
		$custEmail .= sprintf("<br />Telephone: <b>%s</b><br />\n",$billPhone);

		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$billAdd1);
		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$billAdd2);
		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$billAdd3);

		$custEmail .= sprintf("City: <b>%s</b>\n",$billCity);
		$custEmail .= sprintf("<br />State: <b>%s</b>\n",$billState);
		$custEmail .= sprintf("<br />Zip: <b>%s</b>\n",$billZip);
		$custEmail .= sprintf("<br />Country: <b>%s</b>\n",$billCountry);
		$custEmail .= sprintf("<br />Attention: <b>%s</b>\n",$billAttn);

		$custEmail .= sprintf("<hr /><h3>Shipping Information</h3>");


		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$shipAdd1);
		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$shipAdd2);
		$custEmail .= sprintf("Address: <b>%s</b><br />\n",$shipAdd3);


		$custEmail .= sprintf("City: <b>%s</b>\n",$shipCity);
		$custEmail .= sprintf("<br />State: <b>%s</b>\n",$shipState);
		$custEmail .= sprintf("<br />Zip: <b>%s</b>\n",$shipZip);
		$custEmail .= sprintf("<br />Country: <b>%s</b>\n",$shipCountry);
		$custEmail .= sprintf("<br />Attention: <b>%s</b>\n",$shipAttn);

		$custEmail .= sprintf("<hr /><h3>Items Ordered</h3>");
		$custEmail .= sprintf("<table cellpadding=\"5\" border=\"1\" pa>\n");
		$custEmail .= sprintf("\n<tr><th>Qty</th><th>Product No.</th><th>Price</th><th>Quote#</th><th>Requested Delivery Date</th></tr>\n");

		foreach($_POST['Qty'] as $i => $q){
			if ($q){
				$custEmail .= sprintf("\n<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",str_pad($q,5),str_pad($_POST['Pno'][$i],8),$_POST['price'][$i],$_POST['quoteNo'][$i],$_POST['dateReq'][$i]);
			}
		}

		$custEmail .= sprintf("</table>");
		$custEmail .= sprintf("<hr /><h3>Comments</h3>");
		$custEmail .= sprintf("%s",wordwrap($comments,60,"<br />"));
		$custEmail .= sprintf("</body>");
		$custEmail .= sprintf("</html>");

		//lets send some emails!

		if (trim($_POST['important-input']) == ''){
			$Custmail = new PHPMailer;
			$Custmail->setFrom('customerservice@htslabs.com', "Thomson Instrument Company");
			$Custmail->addReplyTo('customerservice@htslabs.com', "Thomson Instrument Company");
			$Custmail->addAddress($purchEmail, 'Thomson Quick Order Form');
			$Custmail->Subject = "Confirmation of Thomson Quick Order for - " . $companyName;
			$Custmail->msgHTML($custEmail);
			$Custmail->send();

			//to Thomson
			$mail = new PHPMailer;
			$mail->setFrom('website_order@htslabs.com', 'New Order Form');
			$mail->addReplyTo($purchEmail, $purchFname." ".$purchLname);
			$mail->addAddress('website_order@htslabs.com', 'New Order Form');
			$mail->Subject = "New website Order from - " . $companyName;
			$mail->msgHTML($body);
			$mail->addAttachment($file);
			//unlink($file); uncomment to delete file
			if (!$mail->send()){
				$mail_error = $mail->ErrorInfo;
				$error_date = date('m\-d\-Y\-h:iA');
				$log = "logs/error.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$error_date . " | new order | " . $mail_error . "\n");
				fclose($fp);
				$query_string = '?success=false';
				header('Location: http://' . $server_dir . $next_page . $query_string);
			}else{
			  $success_ip = $_SERVER['REMOTE_ADDR'];
				$success_date = date('m\-d\-Y\-h:iA');
				$success_message = $success_date . " | new order | " . $success_ip . " | " . $purchEmail;
				$log = "logs/success.txt";
				$fp = fopen($log,"a+");
				fwrite($fp,$success_message . "\n");
				fclose($fp);
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