<?php
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
	header("HTTP/1.0 400 Bad Request");
    die($msg);
}

// Make licenses the current db
$db_selected = mysql_select_db('licenses', $link);
if (!$db_selected) {
	$msg = 'ERROR: Cannot use licenses database : ' . mysql_error() . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', 'ERROR: mysql_selectdb', $msg, '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
    die($msg);
}

// Clean up all the parameters up-front
$flicensekey = trim(mysql_real_escape_string($_REQUEST['licensekey']));
$fnewusername = trim(mysql_real_escape_string($_REQUEST['username']));
$fnewfingerprint = trim(mysql_real_escape_string($_REQUEST['fingerprint'])); 

// Get the reference number
$query = sprintf("SELECT referenceNumber from users,akeys where users.userNumber=akeys.userNumber and licenseKey='%s'", $flicensekey);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to get reference number for license key ' . $flicensekey . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

$trow = mysql_fetch_assoc($result);
$referenceNumber = $trow['referenceNumber'];

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
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

// There should only be one record
if (mysql_num_rows($result) == 0) {
	$msg = 'ERROR: Invalid reference number -- Contact the person who purchased the software license in your organization.';
	mail('mary.kroening@amzi.com', $msg, $query, '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}
if (mysql_num_rows($result) > 1) {
	$msg = 'ERROR: Wrong number of sales records found for ' . $referenceNumber . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $query, '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

// Save a bunch of information from the sales record for key checking and generation
while ($row = mysql_fetch_assoc($result)) {
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
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

// See if this is for Windows products
if ($contractId == 1633685 || $contractId == 1633726 || $contractId == 1633727 || 
$contractId == 1656404 || $contractId == 1656405) {
	$msg = 'ERROR: This system only supports Windows license keys at this time -- Contact Amzi! Tech Support.';
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

// See if this license has exceeded the transfer limit for the past year
$query = sprintf("SELECT COUNT(*) from users,akeys where referenceNumber='%s' and users.userNumber=akeys.userNumber and akeys.transactionDate > '%d-%d-%d'", $referenceNumber, $today[year]-1, $today[mon], $today[mday]);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to count keys for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

$trow = mysql_fetch_assoc($result);
$license_count = $trow['COUNT(*)'];
if ($license_count > $quantity * 4) {
    $msg = 'ERROR: Too many license transfers for reference number ' . $referenceNumber . ': ';
	$msg .= $license_count . '>' . $quantity*4 . ' -- Contact ' . $buyername . ' in your organization.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . $license_count . '>' $quantity*4, '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

// Count the transfers in the last 30 days
$query = sprintf("SELECT COUNT(*) from users,akeys where referenceNumber='%s' and users.userNumber=akeys.userNumber and akeys.transactionDate + INTERVAL 30 DAY > CURDATE()", $referenceNumber);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to count 30 day keys for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

$trow = mysql_fetch_assoc($result);
$day30_count = $trow['COUNT(*)'];
if ($day30_count >= $quantity+1) {
    $msg = 'ERROR: Invalid license transfer in past 30 days for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . $day30_count, '');
	mysql_close($link);
	header("HTTP/1.0 400 Bad Request");
	die($msg);
}

mysql_close($link);

// NOTE! The spacing below is very important as it returns newlines around the key
?>
