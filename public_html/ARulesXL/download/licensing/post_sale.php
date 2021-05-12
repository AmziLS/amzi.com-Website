<?php

// Plimus will always call this from XXXX.plimus.com (where XXXX could be corp,
// app1sc1,app2sd1,app1ny1,etc.) and the ip address will be 209.128.93.XXX
// where XXX could be any valid number.
$addr = $_SERVER['REMOTE_ADDR'];
$subaddr = substr($addr, 0, 11);
if (strcasecmp($subaddr, '209.128.93.') != 0 && strcasecmp($addr, '68.213.41.52') != 0) {
	header("HTTP/1.0 404 Not Found");
    die($addr);
}

$link = mysql_connect('localhost', 'root', 'galax');
date_default_timezone_set("UTC");

if (!$link) {
//	header("HTTP/1.0 404 Not Found");
    die('Could not connect to license database: ' . mysql_error());
}

// Make licenses the current db
$db_selected = mysql_select_db('licenses', $link);
if (!$db_selected) {
	mysql_close($link);
//	header("HTTP/1.0 404 Not Found");
    die ('Cannot use licenses database : ' . mysql_error());
}

// Check testMode != 'Y'
if (strcasecmp(mysql_real_escape_string($_REQUEST['testMode']), 'Y') == 0) {
	mysql_close($link);
    die ('Test Record');
}

//print_r($_REQUEST);

$f = '(transactionDate, transactionTime, remoteAddress, referrer, ';
$f .= 'referenceNumber, productName, productId, contractName, ';
$f .= 'contractId, accountId, transactionType, quantity, contractPrice, ';
$f .= 'currency, coupon, couponCode, couponValue, addCD,  email, ';  // armadilloHardwareId, licenseKey, were before email
$f .= 'title, company, firstName, lastName, address1, address2, city, ';
$f .= 'state, zipCode, country, shippingFirstName, shippingLastName, ';
$f .= 'shippingAddress1, shippingAddress2, shippingCity, shippingState, ';
$f .= 'shippingZipCode, shippingCountry, workPhone, extension, faxNumber, ';
$f .= 'mobilePhone, homePhone, keyDate, usedCount, allowDomain, upgraded, priorPurchase)'; // status was before keyDate

$q = 'VALUES(';
// parse transaction date/time `11/04/2003 01:21 PM` into YYYY-MM-DD, HH:MM
$dt = mysql_real_escape_string($_REQUEST['transactionDate']);
//	$n = sscanf($dt, "%u/%u/%u %u:%u %s", $mm, $dd, $yyyy, $hh, $mm, $ampm);
$mo = strtok($dt, "/");
$dd = strtok("/");
$yyyy = strtok(" ");
$hh = strtok(":");
$mm = strtok(" ");
$ampm = strtok(" ");
$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "', ";
if (strcasecmp($ampm, 'PM') == 0)
	$hh = $hh + 12;
$q .= "'" . $hh . ':' . $mm . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['remoteAddress']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['referer']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['referenceNumber']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['productName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['productId']) . ', ';
$q .= "'" . mysql_real_escape_string($_REQUEST['contractName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['contractId']) . ', ';
$q .= mysql_real_escape_string($_REQUEST['accountId']) . ', ';
$q .= "'" . mysql_real_escape_string($_REQUEST['transactionType']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['quantity']) . ', ';
$q .= "'" . mysql_real_escape_string($_REQUEST['contractPrice']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['currency']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['coupon']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['couponCode']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['couponValue']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['addCD']) . "', ";
//$q .= "'" . mysql_real_escape_string($_REQUEST['armadilloHardwareId']) . "', ";
//$q .= "'" . mysql_real_escape_string($_REQUEST['licenseKey']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['email']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['title']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['company']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['firstName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['lastName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['address1']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['address2']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['city']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['state']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['zipCode']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['country']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingFirstName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingLastName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingAddress1']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingAddress2']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingCity']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingState']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingZipCode']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['shippingCountry']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['workPhone']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['extension']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['faxNumber']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['mobilePhone']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['homePhone']) . "', ";
//$q .= "'CUR', ";
$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "', ";
// usedCount
if (strlen(mysql_real_escape_string($_REQUEST['licenseKey'])) > 0)
	$q .= "1, ";
else
	$q .= "0, ";
//echo 'Allow_Any_Email_in_Domain=' . mysql_real_escape_string($_REQUEST['Allow_Any_Email_in_Domain']);
if (strcasecmp(mysql_real_escape_string($_REQUEST['Allow_Any_Email_in_Domain']), "Yes") == 0)
	$q .= "'Y', ";
else
	$q .= "'N', ";
$q .= "'N', ";	// upgraded
// priorPurchase
$contractId = mysql_real_escape_string($_REQUEST['contractId']);
// priorPurchase = NEW if its a new sale for Windows, otherwise it is blank
if ($contractId == 1629529 || $contractId == 1629571 || $contractId == 1629572 ||
$contractId == 1643585 || $contractId == 1656295 || $contractId == 1670247)
	$q .= "'NEW' ";
else
	$q .= "''";
$q .= ")";

// Add the sales record
$insert = 'INSERT INTO sales ' . $f . ' ' . $q;
$result = mysql_query($insert);
if (!$result) {
//		header("HTTP/1.0 404 Not Found");
	mail('mary.kroening@amzi.com', 'Error in Post Sale', $insert . "\n" . mysql_error());
	die('Invalid query: ' . mysql_error());
}

// If there's a license key, add user and key records too
if (strlen(mysql_real_escape_string($_REQUEST['licenseKey'])) > 0) {
	// Add a new user
	$f = '(transactionDate, transactionTime, userNumber, referenceNumber, username, ';
	$f .= 'email, keysAllowed, status, reason)';
	
	$q = 'VALUES(';
	$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "', ";
	$q .= "'" . $hh . ':' . $mm . "', ";
	$q .= "NULL, ";
	$q .= "'" .  mysql_real_escape_string($_REQUEST['referenceNumber']) . "', ";
	if (strlen(trim(mysql_real_escape_string($_REQUEST['title']))) > 0) 
		$username = mysql_real_escape_string($_REQUEST['title'] . ' ');
	$username .= mysql_real_escape_string($_REQUEST['firstName']) . ' ' . mysql_real_escape_string($_REQUEST['lastName']);
	$q .= "'" . $username . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['email']) . "', ";
	if ($contractId == 1629571 || $contractId == 1629572 || $contractId == 1629574 || $contractId == 1629575)
		$q .= "2, ";
	else
		$q .= "1, ";
	$q .= "'CUR', 'NEW')";

	$uinsert = 'INSERT INTO users ' . $f . ' ' . $q;
	$uresult = mysql_query($uinsert);
	if (!$uresult) {
		mail('mary.kroening@amzi.com', 'Error in Post Sale', $uinsert . "\n" . mysql_error());
		die('Invalid query: ' . mysql_error());
	}	
	
	// Add a new key
	$f = '(transactionDate, transactionTime, userNumber, licenseKey, hardwareId, ';
	$f .= 'uninstallCode, status, reason)';
		
	$q = 'VALUES(';
	$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "', ";
	$q .= "'" . $hh . ':' . $mm . "', ";
	$q .= "LAST_INSERT_ID(), ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['licenseKey']) . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['armadilloHardwareId']) . "', ";
	$q .= "'', 'CUR', 'NEW')";

	$kinsert = 'INSERT INTO akeys ' . $f . ' ' . $q;
	$kresult = mysql_query($kinsert);
	if (!$kresult) {
		mail('mary.kroening@amzi.com', 'Error in Post Sale', $kinsert . "\n" . mysql_error());
		die('Invalid query: ' . mysql_error());
	}

/*	$f = '(transactionDate, transactionTime, referenceNumber, username, licenseKey, ';
	$f .= 'armadilloHardwareId, email, uninstallCode, allowNameChange, status, reason)';
	
	$q = 'VALUES(';
	$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "', ";
	$q .= "'" . $hh . ':' . $mm . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['referenceNumber']) . "', ";
	if (strlen(trim(mysql_real_escape_string($_REQUEST['title']))) > 0) 
		$username = mysql_real_escape_string($_REQUEST['title'] . ' ');
	$username .= mysql_real_escape_string($_REQUEST['firstName']) . ' ' . mysql_real_escape_string($_REQUEST['lastName']);
	$q .= "'" . $username . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['licenseKey']) . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['armadilloHardwareId']) . "', ";
	$q .= "'" . mysql_real_escape_string($_REQUEST['email']) . "', ";
	$q .= "'', 'N', 'CUR', 'NEW')";

	$insert = 'INSERT INTO licenses ' . $f . ' ' . $q;
	$result = mysql_query($insert);
	if (!$result) {
	//		header("HTTP/1.0 404 Not Found");
		mail('mary.kroening@amzi.com', 'Error in Post Sale', $insert . "\n" . mysql_error());
		die('Invalid query: ' . mysql_error());
	}
*/
}

// Add the purchaser onto the news mailing list
$headers = "From: " . mysql_real_escape_string($_REQUEST['firstName']) . " " . mysql_real_escape_string($_REQUEST['lastName']) . "<" . mysql_real_escape_string($_REQUEST['email']) . ">\nX-Mailer: PHP\nBcc: mary.kroening@amzi.com\n";
if (strcasecmp(mysql_real_escape_string($_REQUEST['productId']), '27017') == 0)
	mail("list_arules_news@amzi.com", "Subscribe", "Subscribe", $headers, "-f " . mysql_real_escape_string($_REQUEST['email']));
else
	mail("list_amzi_news@amzi.com", "Subscribe", "Subscribe", $headers, "-f " . mysql_real_escape_string($_REQUEST['email']));

// Table of upgrade purchases and contracts that are legal original sales
$product[1670247] = ' (contractId=1670247 or contractId=1670248) ';							// ARulesXL Professional
$product[1656418] = ' (contractId=1643585 or contractId=1656295 or contractId=1656418) ';	// ARulesXL Developer single
$product[1653585] = ' (contractId=1643585 or contractId=1656295 or contractId=1653585) ';	// ARulesXL Developer multiple
$product[1629574] = ' (contractId=1629571 or contractId=1629574) ';							// Amzi! Developer
$product[1629575] = ' (contractId=1629572 or contractId=1629575) '; 						// Amzi! Professional

// If it is an upgrade purchase, try to find the matching original sale to verify it
if (strlen($product[$contractId]) == 0) {
	mysql_close($link);
	exit(0);
}

// Select all sales with the matching product, email, quantity and the keyDate is 335 to 395 days ago.
// keyDate <= DATE_SUB(CURDATE(),INTERVAL 335 DAY) and keyDate >= DATE_SUB(CURDATE(),INTERVAL 395 DAY)
$query = sprintf("SELECT transactionDate, referenceNumber, contractName, productName, keyDate FROM sales WHERE %s and email='%s' and upgraded='N' and quantity=%d and keyDate <= DATE_SUB(CURDATE(),INTERVAL 335 DAY) and keyDate >= DATE_SUB(CURDATE(),INTERVAL 395 DAY) FOR UPDATE", $product[$contractId], mysql_real_escape_string($_REQUEST['email']), mysql_real_escape_string($_REQUEST['quantity']));
$result = mysql_query($query);
if (!$result) {
	mail('mary.kroening@amzi.com', 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
	die('Invalid query: ' . mysql_error());
}
$row = mysql_fetch_assoc($result);
$keyDate = $row['keyDate'];
$priorReference = $row['referenceNumber'];
$purchaseDate = $row['transactionDate'];

// If we found one, then mark it as upgraded
if (mysql_num_rows($result) == 1) {
	$query = sprintf("UPDATE sales SET upgraded='Y' WHERE %s and email='%s' and upgraded='N' and quantity=%d and keyDate <= DATE_SUB(CURDATE(),INTERVAL 335 DAY) and keyDate >= DATE_SUB(CURDATE(),INTERVAL 395 DAY)", $product[$contractId], mysql_real_escape_string($_REQUEST['email']), mysql_real_escape_string($_REQUEST['quantity']));
	$result = mysql_query($query);
	if (!$result) {
		mail('mary.kroening@amzi.com', 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
		die('Invalid update: ' . mysql_error());
	}

	// And set our priorPurchase and set the keyDate to a year after the prior one
	$kyear = strtok($keyDate, "-");
	$kmon = strtok("-");
	$kday = strtok(" ");
	$keyDateP1 = $kyear+1 . '-' . $kmon . '-' . $kday;

	$query = sprintf("UPDATE sales SET priorPurchase='%s', keyDate='%s' WHERE referenceNumber='%s'", $priorReference, $keyDateP1, mysql_real_escape_string($_REQUEST['referenceNumber']));
	$result = mysql_query($query);
	if (!$result) {
		mail('mary.kroening@amzi.com', 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
		die('Invalid update: ' . mysql_error());
	}	
	
	//Email the user about our choice
	$msg = "Our ecommerce system has found this prior purchase for your upgrade purchase " . mysql_real_escape_string($_REQUEST['productName']) . "-" . mysql_real_escape_string($_REQUEST['contractName']) . ":\n\n";
	$msg .= "Reference Number: " . $priorReference . "\n";
	$msg .= "Purchase Date: " . $purchaseDate . "\n";
	$msg .= "Old License Key Date: " . $keyDate . "\n";
	$msg .= "New License Key Date: " . $keyDateP1 . "\n\n";
	$msg .= "All new license keys issued for the above reference number will allow updates for 1 year from the new license key date.\n\n";
	$msg .= "If you believe this is incorrect please contact Amzi! Sales immediately, and before requesting any new license keys.\n\n";
	$msg = wordwrap($msg, 70);
	
	$subj = 'Found Prior Sale to Upgrade for ' . mysql_real_escape_string($_REQUEST['productName']) . ' ' . mysql_real_escape_string($_REQUEST['contractName']);
	// bcc me
	$headers = 'Bcc: mary.kroening@amzi.com' . "\r\n";
	if (mail(mysql_real_escape_string($_REQUEST['email']), $subj, $msg, $headers) == FALSE) {
		$msg = 'ERROR: Unable to send email -- Please contact Amzi! Tech Support.';
		mail('mary.kroening@amzi.com', 'ERROR Sending Update Found Email', $msg, '');
		mysql_close($link);
		die($msg);
	}
}
else {
	// Email the user that we couldn't find a sale to upgrade
	$msg = "Our ecommerce system could not find a valid prior purchase for your upgrade purchase " . mysql_real_escape_string($_REQUEST['productName']) . "-" . mysql_real_escape_string($_REQUEST['contractName']) . ".\n\n";
	$msg .= "New license keys cannot be issued for the upgrade purchase until a valid prior purchase has been identified.\n\n";
	$msg .= "Please email Amzi! Sales with your new reference number, " . mysql_real_escape_string($_REQUEST['referenceNumber']) . ", and ";
	$msg .= "the prior sales reference or invoice number(s) you want to upgrade.\n\n";
	$msg .= "Upgrade purchases are generally made between 11 and 13 months after the original (or prior upgrade) purchase. ";
	$msg .= "They extend software maintenance for one year from the anniversary of the original purchase.\n\n";
	$msg = wordwrap($msg, 70);
	
	$subj = 'Unable to Find Prior Sale to Upgrade for ' . mysql_real_escape_string($_REQUEST['productName']) . ' ' . mysql_real_escape_string($_REQUEST['contractName']);
	// bcc me
	$headers = 'Bcc: mary.kroening@amzi.com' . "\r\n";
	if (mail(mysql_real_escape_string($_REQUEST['email']), $subj, $msg, $headers) == FALSE) {
		$msg = 'ERROR: Unable to send email -- Please contact Amzi! Tech Support.';
		mail('mary.kroening@amzi.com', 'ERROR Sending Update Not Found Email', $msg, '');
		mysql_close($link);
		die($msg);
	}
}

mysql_close($link);

?> 

