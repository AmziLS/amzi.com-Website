<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>License Manager</title>
</head>
<body>
<?php
// NOTE! The spacing above is very important as it returns newlines around the key.
// Do not change the case of '<body>'

/*
When purchasing ARulesXL, the user is either issued a key immediately (if a hardware fingerprint
is provided) or the user can trade in the sales reference number for a key.

The number of keys that can be issued is the same as the number of copies purchased. You can
also remove a license key and that decreases the copies used count (that is a separate program).

During activation, the user's details are submitted to this program. It checks if the reference number
is valid and there are keys remaining. If so, it issues a new hardware fingerprinted key in the user's
name and emails the key to them (the user must have the same domain as the original purchaser). 
It also emails a copy of the key to the original purchaser's email.

The user checks their email and copy/pastes the key and the program activates the new key for the user.

This ensures we have a valid email address for each key issued.
*/

// Connect to the licenses database
$link = mysql_connect('localhost', 'licenses', 'n0p1racy');
if (!$link) {
	$msg = 'ERROR: Cannot connect to license database: ' . mysql_error() . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', 'ERROR: mysql_connect', $msg, '');
    die($msg);
}

// Make licenses the current db
$db_selected = mysql_select_db('licenses', $link);
if (!$db_selected) {
	$msg = 'ERROR: Cannot use licenses database : ' . mysql_error() . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', 'ERROR: mysql_selectdb', $msg, '');
	mysql_close($link);
    die($msg);
}

// Clean up all the parameters up-front
$freference = trim(mysql_real_escape_string($_REQUEST['reference']));  
$fnewusername = trim(mysql_real_escape_string($_REQUEST['username']));
$fnewfingerprint = trim(mysql_real_escape_string($_REQUEST['fingerprint'])); 
$femail = trim(mysql_real_escape_string($_REQUEST['email']));
$finteractive = trim(mysql_real_escape_string($_REQUEST['interactive']));

// Filter out bad emails
list($userName, $mailDomain) = split("@", $femail); 
$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
if (!eregi($exp, $femail)) {
	mysql_close($link);
	die('ERROR: Invalid email format');
}
if (!checkdnsrr($mailDomain, "MX")) {
	mysql_close($link);
	die('ERROR: Invalid Email Address -- Contact Support: Your Email Domain Could Not Be Found');
}

$referenceNumber = $freference;

// Check format of newfingerprint
if (strlen($fnewfingerprint) != 9 || strcmp(substr($fnewfingerprint, 4, 1), '-') <> 0) {
	mysql_close($link);
	$msg = 'ERROR: Invalid format for new hardware fingerprint. Must be XXXX-XXXX.';
	die($msg);
}

// Check newusername
if (strlen($fnewusername) > 0) {
	if (strlen($fnewusername) < 6 || strpos($fnewusername, ' ') == FALSE ||
		strpos($fnewusername, '0') <> FALSE || strpos($fnewusername, '1') <> FALSE || 
		strpos($fnewusername, '2') <> FALSE || strpos($fnewusername, '3') <> FALSE || 
		strpos($fnewusername, '4') <> FALSE || strpos($fnewusername, '5') <> FALSE || 
		strpos($fnewusername, '6') <> FALSE || strpos($fnewusername, '7') <> FALSE ||
		strpos($fnewusername, '8') <> FALSE || strpos($fnewusername, '9') <> FALSE) {
		mysql_close($link);
		$msg = 'ERROR: New user name is not correct. Please enter the first and last name of the actual software user.';
		die($msg);
	}
}

// Get today's year
date_default_timezone_set("UTC");

$today = getdate();

// If you want to make this thread-safe,
// Lock the table for write first using LOCK TABLES xx WRITE and then execute the SELECT ... FOR UPDATE statement

// Get the sales record by reference number
$query = sprintf("SELECT transactionDate, referenceNumber, title, firstName, lastName, email, contractId, contractName, productName, productId, quantity, usedCount, keyDate, allowDomain, priorPurchase FROM sales WHERE referenceNumber='%s' FOR UPDATE", $referenceNumber);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to get sales record for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// There should only be one record
if (mysql_num_rows($result) == 0) {
	$msg = 'ERROR: Invalid reference number -- Contact the person who purchased the software license in your organization.';
	mysql_close($link);
	die($msg);
}
if (mysql_num_rows($result) > 1) {
	$msg = 'ERROR: Wrong number of sales records found for ' . $referenceNumber . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $query, '');
	mysql_close($link);
	die($msg);
}

// Save a bunch of information from the sales record for key checking and generation
while ($row = mysql_fetch_assoc($result)) {
    $referenceNumber = $row['referenceNumber'];
    $buyeremail = $row['email'];
    $contractId = $row['contractId'];
    $contractName = $row['contractName'];
    $productId = $row['productId'];
    $productName = $row['productName'];
    $quantity = $row['quantity'];
	$usedCount = $row['usedCount'];
	$keyDate = $row['keyDate'];
	$allowDomain = $row['allowDomain'];
    $transactionDate = $row['transactionDate'];
   	if (strlen(trim($row['title'])) > 0) $buyername = $row['title'] . ' ';
   	$buyername .= $row['firstName'] . ' ' . $row['lastName'];
	$priorPurchase = $row['priorPurchase'];
}

// Make sure the upgrade has been verified, new purchases are marked NEW
if (strlen($priorPurchase) == 0) {
    $msg = 'ERROR: Upgrade has not been verified for reference number ' . $referenceNumber . ' -- Please contact Amzi! Sales.';
	mysql_close($link);
	die($msg);
}

// See if this is for an ARulesXL product
if ($productId != 27017) {
	$msg = 'ERROR: This system only supports ARulesXL license keys -- Contact Amzi! Tech Support.';
	mysql_close($link);
	die($msg);
}

// See if this license has exceeded the transfer limit for the past year
$query = sprintf("SELECT COUNT(*) from users,akeys where referenceNumber='%s' and users.userNumber=akeys.userNumber and akeys.transactionDate > '%d-%d-%d'", $referenceNumber, $today[year]-1, $today[mon], $today[mday]);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to count keys for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

$trow = mysql_fetch_assoc($result);
$license_count = $trow['COUNT(*)'];
if ($license_count > $quantity * 4) {
    $msg = 'ERROR: Too many license transfers for reference number ' . $referenceNumber . ' -- Contact ' . $buyername . ' in your organization.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . $license_count, '');
	mysql_close($link);
	die($msg);
}

// Count the transfers in the last 30 days
$query = sprintf("SELECT COUNT(*) from users,akeys where referenceNumber='%s' and users.userNumber=akeys.userNumber and akeys.transactionDate + INTERVAL 30 DAY > CURDATE()", $referenceNumber);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to count 30 day keys for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

$trow = mysql_fetch_assoc($result);
$day30_count = $trow['COUNT(*)'];
if ($day30_count >= $quantity+1) {
    $msg = 'ERROR: Invalid license transfer in past 30 days for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . $day30_count . '>=' . $quantity+1, '');
	mysql_close($link);
	die($msg);
}

// Check the email and/or domain match
if ($allowDomain = 'N' && strcasecmp($femail, trim($email)) != 0) {
    $msg = 'ERROR: Email address does not match the original order -- Contact ' . $buyername . ' in your organization.';
	mysql_close($link);
	die($msg);
}
else {
	$at = strpos($femail, '@');
	$fdomain = substr($femail, $at+1);
	$at = strpos($buyeremail, '@');
	$domain = substr($buyeremail, $at+1);
	if (strcasecmp(trim($fdomain), trim($domain)) != 0) {
    	$msg = 'ERROR: Email address is not the same domain as the original order -- Contact ' . $buyername . ' in your organization.';
		mysql_close($link);
		die($msg);
	}
}
	
// keymaker2 parameters:
// level contract_id uninstall licensekey username fingerprint year month day otherinfo0..4
// if uninstall is blank a new key is issued
// otherwise we just check if uninstall code is valid
$keyyear = strtok($keyDate, "-");
$keymonth = strtok("-");
$keyday = strtok(" ");

// If we want to issue Amzi! pre 7.4 keys use /26 instead
$cmd = '/amzi/bin/keymaker2 /30  '. $contractId . ' ""  "" "';
$cmd .= $fnewusername . '" "';
$cmd .= $fnewfingerprint . '" ';
$cmd .= $keyyear . ' ' . $keymonth . ' ' . $keyday;

$newkey = shell_exec($cmd);
$newkey = trim($newkey);

// Save the transaction date/time for the possible new user and definite new akeys records
$date = sprintf("%4d-%02d-%02d", $today['year'], $today['mon'], $today['mday']);
$time = sprintf("%02d:%02d", $today['hours'], $today['minutes']);

// Check if the key check and generate worked
if (strlen($newkey) == 0 || strcasecmp($newkey, 'ERROR') == 0) {
    $msg = 'ERROR: Unable to create new license key -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $cmd, '');
	mysql_close($link);
	die($msg);
}

// See if this user already exists (and is active) for this sale, 
// Although we won't update, use FOR UPDATE to lock the record
$query = sprintf("SELECT keysAllowed, userNumber FROM users WHERE status='CUR' and referenceNumber='%s' and username='%s' and email='%s' FOR UPDATE", $referenceNumber, $fnewusername, $femail);
$result = mysql_query($query);
if (!$result) {
    $msg = 'ERROR: Unable to get user record for reference number ' . $referenceNumber . ' user name ' . $fnewusername . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

$trow = mysql_fetch_assoc($result);
if (mysql_num_rows($result) > 1) {
    $msg = 'ERROR: Too many user records for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query, '');
	mysql_close($link);
	die($msg);
}

// If this user exists, see if they can get a key by counting the CURrent ones
if (mysql_num_rows($result) == 1) {
	$userNumber = $trow['userNumber'];
	$keysAllowed = $trow['keysAllowed'];
	$query = sprintf("SELECT * FROM akeys WHERE status='CUR' and userNumber=%d", $userNumber);
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'ERROR: Unable to get keys for user number ' . $userNumber . ' -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
		mysql_close($link);
		die($msg);
	}
	if (mysql_num_rows($result) >= $keysAllowed) {
	    $msg = 'ERROR: User ' . $fnewusername . ' has no more licenses available to issue for reference number ' . $referenceNumber . ' -- Contact ' . $buyername . ' in your organization.';
		mysql_close($link);
		die($msg);
	}
}
// Otherwise create a new user record
else {
	// See if this sale has any licenses left to issue
	if ($usedCount >= $quantity) {
		$msg = 'ERROR: No license keys available for reference number ' . $referenceNumber . ' -- Contact ' . $buyername . ' in your organization.';
		mysql_close($link);
		die($msg);
	}

	// Update the sales record to increase the usedCount
	$query = sprintf("UPDATE sales SET usedCount = usedCount+1 where referenceNumber = '%s'", $referenceNumber);
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'ERROR: Unable to update sales record -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
		mysql_close($link);
		die($msg);
	}
	
	// Add a new user record, Amzi! Developer + Professional get 2 keys
	if ($contractId == 1629571 || $contractId == 1629572 || $contractId == 1629574 || $contractId == 1629575)
		$keysAllowed = 2;
	else
		$keysAllowed = 1;
	$query = 'INSERT INTO users (transactionDate, transactionTime, userNumber, referenceNumber, ';
	$query .= 'username, email, keysAllowed, status, reason) ';
	$query .= "VALUES('" .  $date . "', '" . $time . "', NULL, '";
	$query .= $referenceNumber . "', '" . $fnewusername . "', '";
	$query .= $femail . "', " . $keysAllowed . ", 'CUR', 'NEW')";
	
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'ERROR: Unable to add new user record -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
		mysql_close($link);
		die($msg);
	}
	
	$userNumber = mysql_insert_id($link);
}

// Add a new keys record
$query = 'INSERT INTO akeys (transactionDate, transactionTime, userNumber, licenseKey, ';
$query .= 'hardwareId, uninstallCode, status, reason) ';
$query .= "VALUES('" .  $date . "', '" . $time . "', " . $userNumber . ", '";
$query .= $newkey . "', '" . $fnewfingerprint . "', '', 'CUR', 'NEW')";
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to add new key record -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// Email the user the new key
$msg = "Here is your new license key for " . $productName . "-" . $contractName . ":\n\n";
$msg .= "Reference Number: " . $referenceNumber . "\n";
$msg .= "User Name: " . $fnewusername . "\n";
$msg .= "License Key: " . $newkey . "\n";
$msg .= "License Key Date: " . $keyDate . "\n\n";
// YYYY-MM-DD 0,4 5,2 8,2
$license_date = mktime(0, 0, 0, substr($keyDate,5,2), substr($keyDate,8,2), substr($keyDate,0,4));
if ((time() - $license_date)/86400 > 365)
	$msg .= "WARNING: Software maintenance has expired. This key can only be used with software versions dated within 1 year of the license key date.\n\n";
else
	$msg .= "Software maintenance expires 1 year from the license key date.\n\n";

$msg .= "This license key will work with any version of ARulesXL (production or beta test)";
$msg .= "for any new release dated within 1 year from the license key date.\n\n";
$msg .= "Please send us this information if you have any questions about or problems with your license.";
$msg = wordwrap($msg, 70);

$subj = 'New License Key for ' . $contractName . ' ' . $productName;
// bcc me, and cc buyer if not license requester
$headers = 'Bcc: mary.kroening@amzi.com' . "\r\n";
if (strcasecmp($buyeremail, $femail) != 0)
	$headers .= 'Cc: ' . $buyeremail . "\r\n";
if (mail($femail, $subj, $msg, $headers) == FALSE) {
	$msg = 'ERROR: Unable to send email -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', 'ERROR Sending New License Key Email', $msg, '');
	mysql_close($link);
	die($msg);
}

// If we're interactive give a nice message
if ($finteractive == 'Y') {
	echo 'Your license key has been emailed to you at ' . $femail;
	mysql_close($link);
	die();
}

// Send back the key if it's safe
if ($quantity <= 3)
	echo $newkey;
else
	echo 'KEYEMAILED';

mysql_close($link);

// NOTE! The spacing below is very important as it returns newlines around the key
?>

</body>
</html>
