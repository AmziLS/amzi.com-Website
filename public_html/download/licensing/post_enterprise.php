<?php
// Called for orders for Enterprise / Educational licenses.
// Data is entered in the enterprises table.

// Plimus will always call this from XXXX.plimus.com (where XXXX could be corp,
// app1sc1,app2sd1,app1ny1,etc.) and the ip address will be 209.128.93.XXX
// where XXX could be any valid number.

// Campaign Manager stuff for adding to our mailing lists
	//Relative path to CMBase.php. This example assumes the file is in the same folder
	require_once('CMBase.php');
	
	//Your API Key. Go to http://www.campaignmonitor.com/api/required/ to see where to find this and other required keys
	
	$api_key = 'bafb8a9c669a47592624cdca320c5c1a';
	$client_id = null;
	$campaign_id = null;
	//$list_id = 'a8eebb9f1c9acc01266327fb10979e61';   // Sample List
	$list_id = '2b08490fc6928a01c7345aecc70cd572';   // AmziNews
	$cm = new CampaignMonitor( $api_key, $client_id, $campaign_id, $list_id );
	
	//Optional statement to include debugging information in the result
	//$cm->debug_level = 1;

$mailee = "dennis.merritt@amzi.com";

$addr = $_SERVER['REMOTE_ADDR'];
$subaddr = substr($addr, 0, 11);
if (strcasecmp($subaddr, '209.128.93.') != 0) {
	header("HTTP/1.0 404 Not Found");
    die($addr);
}
$host = gethostbyaddr($addr);
$transactionType = $_REQUEST['transactionType'];
$referenceNumber = $_REQUEST['referenceNumber'];
$enterpriseName = $_REQUEST['enterpriseName'];


mail($mailee, 'In post_enterprise', 'Getting Started: '
		. $transactionType . ' '
		. $referenceNumber . ' '
		. $enterpriseName . ' '
		. $addr . ' '
		. $host . ' ');

if (strcasecmp($transactionType, 'CHARGE') != 0 and
	strcasecmp($transactionType, 'RECURRING') != 0) {
	$msg = 'Non purchasing transaction: ' . $transactionType;
	mail($mailee, 'post_subscribe error', $msg);
	die($msg);
	}

$dbuser = "amzitwoc_dennis";
$dbpass = "?-izmA!";
$dbname = "amzitwoc_subscriptions";

$link = mysql_connect('localhost', $dbuser, $dbpass);
if (!$link) {
//	header("HTTP/1.0 404 Not Found");
	$msg = 'Could not connect to amzi database: ' . mysql_error();
	mail($mailee, 'post_subscribe error', $msg);
    die($msg);
}

// Make subscriptions the current db
$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
	mysql_close($link);
//	header("HTTP/1.0 404 Not Found");
	$msg = 'Cannot use subscriptions database : ' . mysql_error();
    die ($msg);
}

//mail($mailee, 'post_enterprise', 'about to update database');
// Check testMode != 'Y'
//if (strcasecmp(mysql_real_escape_string($_REQUEST['testMode']), 'Y') == 0) {
//	mysql_close($link);
//    die ('Test Record');
//}

//print_r($_REQUEST);

$f = '(reference, transactionDate, ';
$f .= 'enterpriseName, enterpriseDomain, ';
$f .= 'productName, productID, contractName, contractID, ';
$f .= 'purchasingContactName, purchasingContactEmail, purchasingContactPhone, ';
$f .= 'subscriptionStartDate)';

$q = 'VALUES(';
$q .= "'" . mysql_real_escape_string($_REQUEST['referenceNumber']) . "', ";
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
//if (strcasecmp($ampm, 'PM') == 0)
//	$hh = $hh + 12;
//$q .= "'" . $hh . ':' . $mm . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['enterpriseName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['enterpriseDomain']) . "', ";

$q .= "'" . mysql_real_escape_string($_REQUEST['productName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['productId']) . ', ';
$q .= "'" . mysql_real_escape_string($_REQUEST['contractName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['contractId']) . ', ';

$q .= "'" . mysql_real_escape_string($_REQUEST['purchasingContactName']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['purchasingContactEmail']) . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['purchasingContactPhone']) . "', ";
// and the subscription start is the same as the transaction date

$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "' ";  // note lack of comma on last field...
$q .= ")";

// Add the sales record
$insert = 'INSERT INTO enterprises ' . $f . ' ' . $q;

//mail($mailee, 'really about to insert', $insert);

$result = mysql_query($insert);
if (!$result) {
//		header("HTTP/1.0 404 Not Found");
	mail($mailee, 'Error in Post Subscription', $insert . "\n" . mysql_error());
	die('Invalid query: ' . mysql_error());
}

$enterpriseName = mysql_real_escape_string($_REQUEST['enterpriseName']);
mail($mailee,
	"Enterprise Sale: " . $enterpriseName,
	$insert . "\n",
	'');


//mail($mailee, 'Inserted query', $insert);

	//Update our mailing list
	$femail = mysql_real_escape_string($_REQUEST['purchasingContactEmail']);
	$fusername = mysql_real_escape_string($_REQUEST['purchasingContactName']);
	$cmresult = $cm->subscriberAdd($femail, $fusername);
	if($cmresult['Result']['Code'] != 0)
		mail($mailee, 'Error: CM Activation Add', $femail . ' ' . $fusername, '');

mysql_close($link);

?> 

