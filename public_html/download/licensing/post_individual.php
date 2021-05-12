<?php
// called when an individual license is ordered.
// database is individuals

$mailee = 'dennis.merritt@amzi.com';

//mail($mailee, 'amzi2 post_individual', $_SERVER['QUERY_STRING']);

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


// Plimus will always call this from XXXX.plimus.com (where XXXX could be corp,
// app1sc1,app2sd1,app1ny1,etc.) and the ip address will be 209.128.93.XXX
// where XXX could be any valid number.
$addr = $_SERVER['REMOTE_ADDR'];
$subaddr = substr($addr, 0, 11);
//if (strcasecmp($subaddr, '209.128.93.') != 0) {
//	header("HTTP/1.0 404 Not Found");
//    die($addr);
//}

$host = gethostbyaddr($addr);
$transactionType = $_REQUEST['transactionType'];
$referenceNumber = $_REQUEST['referenceNumber'];
$lastName = $_REQUEST['lastName'];

/*
mail($mailee, 'In post_individual', 'Getting Started: '
		. $transactionType . ' '
		. $referenceNumber . ' '
		. $lastName . ' '
		. $addr . ' '
		. $host . ' ');
*/

if ( strcasecmp($transactionType, 'CHARGE') != 0 and
	 strcasecmp($transactionType, 'RECURRING') != 0 ) {
	$msg = 'Non purchasing transaction: ' . $transactionType;
	//mail($mailee, 'post_individual error', $msg);
	die($msg);
	}

$dbuser = "amzitwoc_dennis";
$dbpass = "?-izmA!";
$dbname = "amzitwoc_subscriptions";

//mail($mailee, 'amzi2 mysql_connect', 'about to');

$link = mysql_connect('localhost', $dbuser, $dbpass);
if (!$link) {
//	header("HTTP/1.0 404 Not Found");
	$msg = 'Could not connect to amzi database: ' . mysql_error();
	mail($mailee, 'post_individual error', $msg);
    die($msg);
}

//mail($mailee, 'amzi2 mysql_select_db', 'about to');

// Make subscriptions the current db
$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
	mysql_close($link);
//	header("HTTP/1.0 404 Not Found");
	$msg = 'Cannot use subscriptions database : ' . mysql_error();
	mail($mailee, 'post_individual error', $msg);
    die($msg);
}

$contractName = mysql_real_escape_string($_REQUEST['contractName']);

//mail($mailee, 'After contract name', 'the name is ' . $contractName);

// Don't check for renewal validity, just let them upgrade no problem.  Who's
// going to cheat anyway?  And how much money is it?  Remove the XX and then
// make sure Plimus has an OldReferenceNumber field added as a custom field
// to renewal contracts for this to work.
if ( strpos($contractName, 'RenewXX') !== false ) {
	// It's a renewal contract, so look up the old stuff
//mail($mailee, 'A renewal', 'so it appears');

	$query = sprintf('SELECT * FROM individuals WHERE reference = %d',
			mysql_real_escape_string($_REQUEST['OldReferenceNumber']) );
	
	$result = mysql_query($query);
	if (!$result) {
		mail($mailee, 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
		die('Invalid query: ' . mysql_error());
	}
	// Here's how to get stuff if we want sometime.
	//$row = mysql_fetch_assoc($result);
	//$keyDate = $row['keyDate'];
	//$priorReference = $row['referenceNumber'];
	//$purchaseDate = $row['transactionDate'];
	
	// For now, we don't care if someone is cheating on this, it's not big bucks
	// and how many people would try it anyway?
	if (mysql_num_rows($result) > 0) {
		// It's an Amzi! 8 renewal!
		
		$query =
			sprintf('UPDATE individuals SET renewReference = %d WHERE reference = %d',
				mysql_real_escape_string($_REQUEST['referenceNumber']),
				mysql_real_escape_string($_REQUEST['OldReferenceNumber']) );
				
		$result = mysql_query($query);
		if (!$result) {
			mail($mailee, 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
			die('Invalid query: ' . mysql_error());
		}
	}
	else {  // look in the old licenses db for the previous sale
//mail($mailee, 'In the else for old stuff', 'should we be here?');
		$db_selected = mysql_select_db('licenses', $link);
		if (!$db_selected) {
			mysql_close($link);
			$msg = 'Cannot use licenses database : ' . mysql_error();
			mail($mailee, 'post_individual error', $msg);
			die($msg);
		}
		$query = sprintf("SELECT * FROM sales WHERE referenceNumber = '%s'",
				mysql_real_escape_string($_REQUEST['OldReferenceNumber']) );
		
		$result = mysql_query($query);
		if (!$result) {
			mail($mailee, 'Error in Post Sale Upgrade', $query . "\n" . mysql_error());
			die('Invalid query: ' . mysql_error());
		}
		
		if (mysql_num_rows($result) == 0) {
			$msg = 'Error is sale upgrade: No previous sale found for reference: ' .
				mysql_real_escape_string($_REQUEST['OldReferenceNumber']);
			mail($mailee, 'Renewal Error', $msg);
			die($msg);
		}
		// go back to the subscriptions database
		$db_selected = mysql_select_db('subscriptions', $link);
		if (!$db_selected) {
			mysql_close($link);
			$msg = 'Cannot use subscriptions database : ' . mysql_error();
			mail($mailee, 'post_individual error', $msg);
			die($msg);
		}
	}
//mail($mailee, 'end of renewal', 'end of renewal big if');

}  // end of renewal digression


// Check testMode != 'Y'
//if (strcasecmp(mysql_real_escape_string($_REQUEST['testMode']), 'Y') == 0) {
//	mysql_close($link);
//    die ('Test Record');
//}

//print_r($_REQUEST);

//mail($mailee, 'Past renewal', 'moving on to final update');


$f = '(reference, name, email, ';
$f .= 'productName, productID, contractName, contractID, ';
$f .= 'transactionDate, subscriptionStartDate)';

$q = 'VALUES(';
$q .= "'" . mysql_real_escape_string($_REQUEST['referenceNumber']) . "', ";

$name = mysql_real_escape_string($_REQUEST['firstName']) . " " . mysql_real_escape_string($_REQUEST['lastName']);
$q .= "'" . $name . "', ";
$q .= "'" . mysql_real_escape_string($_REQUEST['email']) . "', ";

$q .= "'" . mysql_real_escape_string($_REQUEST['productName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['productId']) . ', ';
$q .= "'" . mysql_real_escape_string($_REQUEST['contractName']) . "', ";
$q .= mysql_real_escape_string($_REQUEST['contractId']) . ', ';

$dt = mysql_real_escape_string($_REQUEST['transactionDate']);
// parse transaction date/time `11/04/2003 01:21 PM` into YYYY-MM-DD, HH:MM
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

// and the subscription start is the same as the transaction date
$q .= "'" . $yyyy . '-' . $mo . '-' . $dd . "' ";  // note lack of comma on last field...
$q .= ")";

// Add the sales record
$insert = 'INSERT INTO individuals ' . $f . ' ' . $q;
$result = mysql_query($insert);
if (!$result) {
//		header("HTTP/1.0 404 Not Found");
	mail($mailee, 'Error in Post Individual', $insert . "\n" . mysql_error());
	die('Invalid query: ' . mysql_error());
}

mail($mailee,
	"Individual Sale: " . $name,
	$insert . "\n",
	'');


	//Update our mailing list
	$femail = mysql_real_escape_string($_REQUEST['email']);
	$fusername = mysql_real_escape_string($_REQUEST['firstName']) . " " . mysql_real_escape_string($_REQUEST['lastName']);
	$cmresult = $cm->subscriberAdd($femail, $fusername);
	if($cmresult['Result']['Code'] != 0)
		mail($mailee, 'Error: CM Activation Add', $femail . ' ' . $fusername, '');

mysql_close($link);

?> 

