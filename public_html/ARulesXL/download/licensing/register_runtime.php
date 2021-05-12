<?php
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
$fkey = trim(mysql_real_escape_string($_REQUEST['key']));  
$fruntimeid = trim(mysql_real_escape_string($_REQUEST['runtimeid']));  
$ffingerprint = trim(mysql_real_escape_string($_REQUEST['fingerprint']));
$fusername = trim(mysql_real_escape_string($_REQUEST['username']));

// Get today's date
$today = getdate();

// See if this author exists
$query = sprintf("SELECT referenceNumber FROM users, akeys WHERE users.userNumber=akeys.userNumber and akeys.licenseKey='%s'", $fkey);
$result = mysql_query($query);
if (!$result) {
	$msg = 'NOTFOUND: Unable to get sales record for license key ' . $fkey . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// There should only be one record
if (mysql_num_rows($result) != 1) {
	$msg = 'NOTFOUND: Invalid author license key for ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['REMOTE_HOST'];
	$msg .= ' -- Contact the person who purchased the software license in your organization.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n", '');
	mysql_close($link);
	die($msg);
}

// Save the reference number
$row = mysql_fetch_assoc($result);
$referenceNumber = $row['referenceNumber'];

// See if there are any keys left. First find out how many keys there are.
$query = sprintf("SELECT rtusers.runtimeId, contractId, quantity FROM rtusers, rtsales WHERE rtsales.referenceNumber='%s' and rtsales.runtimeId=rtusers.runtimeId", $referenceNumber);
$result = mysql_query($query);
if (!$result) {
	$msg = 'NOTFOUND: Unable to get sales record for license key ' . $fkey . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// There should only be one record
if (mysql_num_rows($result) != 1) {
	$msg = 'NOTFOUND: Invalid reference number -- Contact the person who purchased the software license in your organization.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n", '');
	mysql_close($link);
	die($msg);
}

// Save more information
// runtimeId and contractId are unique pair; cannot have different contractIds for the same runtimeId
$row = mysql_fetch_assoc($result);
$runtimeId = $row['runtimeId'];
$contractId = $row['contractId'];
$quantity = $row['quantity'];

// Count the number of licenses used
$query = sprintf("SELECT COUNT(*) FROM rtkeys WHERE rtkeys.runtimeId='%s'", $runtimeId);
$result = mysql_query($query);
if (!$result) {
	$msg = 'NOTFOUND: Unable to count rtkeys records for runtimeId ' . $runtimeId . ' -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

$row = mysql_fetch_assoc($result);
$used_count = $row['COUNT(*)'];

// Return error if there are no more licenses
if ($used_count >= $quantity) {
	$msg = 'OVERLIMIT: Contact the author of this software.';
	mail('mary.kroening@amzi.com', $msg, $query . "\nQuantity=" . $quantity . " Used=" . $usedCount . "\n", '');
	mysql_close($link);
	die($msg);
}

// Username is "ARulesXL Runtime"
$cmd = '/amzi/bin/keymaker2 /30  1670128 ""  "" ';
$cmd .= '"' . $fusername . '" "';
$cmd .= $ffingerprint . '" ';
$cmd .= $today['year'] . ' ' . $today['mon'] . ' ' . $today['mday'];

$newkey = shell_exec($cmd);
$newkey = trim($newkey);

$msg = $runtimeId . ' author key=' . $fkey . "\n";
$msg .= 'Issued runtime key=' . $newkey . ' for ' . $ffingerprint . ', user=' . $fusername;
mail('mary.kroening@amzi.com', 'Register Runtime', $msg, '');

// Check if the key check and generate worked
if (strlen($newkey) == 0 || strcasecmp($newkey, 'ERROR') == 0) {
    $msg = 'ERROR: Unable to create new license key -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $cmd, '');
	mysql_close($link);
	die($msg);
}

// Add a new rtkeys record
// Save the transaction date/time for the possible new user and definite new akeys records
$date = sprintf("%4d-%02d-%02d", $today['year'], $today['mon'], $today['mday']);
$time = sprintf("%02d:%02d", $today['hours'], $today['minutes']);
$query = 'INSERT INTO rtkeys (transactionDate, transactionTime, runtimeId, remoteAddress, ';
$query .= 'authorLicenseKey, authorUserId, username, hardwareId, licenseKey) ';
$query .= "VALUES('" .  $date . "', '" . $time . "', '" . $runtimeId . "', '" . $_SERVER['REMOTE_ADDR'] . "', '";
$query .= $fkey . "', '" . $fruntimeid . "', '" . $fusername . "', '";
$query .= $ffingerprint . "', '" . $newkey . "')";

$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to add new rtkeys record -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

echo 'REGISTERED ' . $newkey;

mysql_close($link);
?>
