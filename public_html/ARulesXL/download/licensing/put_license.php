<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>License Manager</title>
</head>
<body>
<?php
// NOTE! The spacing above is very important as it returns newlines around the response.
// Do not change the case of '<body>'

/*
This program checks if a license key has been properly uninstalled, and, if so, decrements
the usedCount so it can be reissued.
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
// The alternate names are for compatibility with the transfer.php URL in older unlock programs
$funinstallcode = trim(mysql_real_escape_string($_REQUEST['uninstallcode']));  
if (strlen($funinstallcode) == 0)
	$funinstallcode = trim(mysql_real_escape_string($_REQUEST['funinstallcode']));  
$fusername = trim(mysql_real_escape_string($_REQUEST['username']));
if (strlen($fusername) == 0)
	$fusername = trim(mysql_real_escape_string($_REQUEST['fusername']));
$ffingerprint = trim(mysql_real_escape_string($_REQUEST['fingerprint'])); 
if (strlen($ffingerprint) == 0)
	$ffingerprint = trim(mysql_real_escape_string($_REQUEST['foldfingerprint'])); 
$flicensekey = trim(mysql_real_escape_string($_REQUEST['licensekey']));
if (strlen($flicensekey) == 0)
	$flicensekey = trim(mysql_real_escape_string($_REQUEST['flicense']));

$finteractive = trim(mysql_real_escape_string($_REQUEST['interactive']));

// Info (warnings)
$info = '';

// Check format of fingerprint
if (strlen($ffingerprint) != 9 || strcmp(substr($ffingerprint, 4, 1), '-') <> 0) {
	mysql_close($link);
	$msg = 'ERROR: Invalid format for new hardware fingerprint. Must be XXXX-XXXX.';
	die($msg);
}

// Check format of uninstallcode
if (strlen($funinstallcode) != 9 || strcmp(substr($funinstallcode, 4, 1), '-') <> 0) {
	mysql_close($link);
	$msg = 'ERROR: Invalid format for uninstall code. Must be XXXX-XXXX.';
	die($msg);
}

// Get today's year
$today = getdate();

// If you want to make this thread-safe,
// Lock the table for write first using LOCK TABLES xx WRITE and then execute the SELECT ... FOR UPDATE statement

// Find the license record from users and akeys
$query = sprintf("SELECT referenceNumber, users.userNumber, hardwareId, licenseKey, username, email, akeys.status FROM users,akeys WHERE users.userNumber=akeys.userNumber and licenseKey='%s' FOR UPDATE", $flicensekey);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to get license record for ' . $flicensekey . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

if (mysql_num_rows($result) == 0) {
	$msg = 'ERROR: Invalid license key -- See the amzi_license_uninstall.txt file in the root directory of your hard disk.';
	mysql_close($link);
	die($msg);
}
if ($row = mysql_fetch_assoc($result)) {
	$referenceNumber = $row['referenceNumber'];
	$userNumber = $row['userNumber'];
	$username = $row['username'];
	$licenseKey = $row['licenseKey'];
	$hardwareId = $row['hardwareId'];
	$email = $row['email'];
	$status = $row['status'];
}
	
// Get the corresponding sales record
$query = sprintf("SELECT transactionDate, referenceNumber, title, firstName, lastName, email, contractId, contractName, productName, productId, quantity, usedCount, keyDate, allowDomain FROM sales WHERE referenceNumber='%s' FOR UPDATE", $referenceNumber);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to find sales record for reference number ' . $referenceNumber . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

if (mysql_num_rows($result) > 1) {
	$msg = 'ERROR: Wrong number of sales records found for reference number ' . $referenceNumber . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $query + "\n" + $lquery, '');
	mysql_close($link);
	die($msg);
}

// Save a bunch of information from the sales record for key checking and generation
if ($row = mysql_fetch_assoc($result)) {
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
}

// See if this license key is a current one
if ($status != 'CUR') {
    $msg = 'ERROR: This license key has already been disabled ' . $licenseKey . ' -- Contact ' . $buyername . ' in your organization.';
	mysql_close($link);
	die($msg);
}

// See if this is for Windows products
if ($contractId == 1633685 || $contractId == 1633726 || $contractId == 1633727 || 
$contractId == 1656404 || $contractId == 1656405) {
	$msg = 'ERROR: This system only supports Windows license keys at this time -- Contact Amzi! Tech Support.';
	mysql_close($link);
	die($msg);
}

// See if the rest matches up
if ($fusername != $username || $ffingerprint != $hardwareId) {
    $msg = 'ERROR: User name and/or fingerprint do not match ' . $licenseKey . ' -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', $msg, $fusername + "=" + $username + "\n" + $ffingerprint + "=" + $hardwareId, '');
	mysql_close($link);
	die($msg);
}

// keymaker2 parameters:
// level contract_id uninstall licensekey username fingerprint year month day otherinfo0..4
// if uninstall is blank a new key is issued
// otherwise we just check if uninstall code is valid
$keyyear = strtok($keyDate, "-");
$keymonth = strtok("-");
$keyday = strtok(" ");

$cmd = '/amzi/bin/keymaker2 /30  '. $contractId . ' "';
$cmd .= $funinstallcode . '"  "';
$cmd .= $flicensekey . '" "';
$cmd .= $fusername . '" "';
$cmd .= $ffingerprint . '" ';
$cmd .= $keyyear . ' ' . $keymonth . ' ' . $keyday;

$check = shell_exec($cmd);
$check = trim($check);

// Check if the key check and generate worked
if (strlen($check) == 0 || strcasecmp($check, 'ERROR') == 0 || strcasecmp($check, 'VALID') != 0) {
	$msg = 'ERROR: Invalid uninstall code -- See the amzi_license_uninstall.txt file in the root directory of your hard disk.';
	mysql_close($link);
	die($msg);
}

// Update the akeys record
$query = sprintf("UPDATE akeys SET status='OLD', reason='MOV', uninstallCode='%s' where licenseKey='%s'", $funinstallcode, $flicensekey);
$result = mysql_query($query);
if (!$result) {
	$msg = 'ERROR: Unable to update key record -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// See if this user has uninstalled all its keys, if so increase the usedCount
// and update the user to OLD
$tquery = sprintf("SELECT COUNT(*) FROM akeys WHERE status='CUR' and userNumber=%d", $userNumber);
$tresult = mysql_query($tquery);
if (!$tresult) {
	$msg = 'ERROR: Unable to count key records -- Please contact Amzi! tech support.';
	mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
	mysql_close($link);
	die($msg);
}

// Limit message to 1000 characters!
$trow = mysql_fetch_assoc($tresult);
if ($trow['COUNT(*)'] != 0) {
	$info = "WARNING: This user still has active license keys for sales reference " . $referenceNumber . ". "; 
	$info .= "Additional keys may be issued to user name " . $username . " email " . $email . " only. ";
	$info .= "This license cannot be transferred to another user name or email until all active license keys have been uninstalled. ";
	$info .= "See the Licensing FAQ on our website, or contact " . $buyername . " in your organization for more information.";
}
else {
	// Update the user record to mark as old
	$query = sprintf("UPDATE users SET status='OLD', reason='MOV' where referenceNumber = '%s'", $referenceNumber);
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'ERROR: Unable to update sales record -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
		mysql_close($link);
		die($msg);
	}
	
	// If the used count is going to go negative we have a problem Houston
	if ($usedCount < 1) {
		$msg = 'ERROR: Invalid used count for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', 'ERROR adjusting usedCount', $msg, '');
		mysql_close($link);
		die($msg);
	}
	
	// Update the sales record to increase the usedCount
	$query = sprintf("UPDATE sales SET usedCount=usedCount-1 where referenceNumber = '%s'", $referenceNumber);
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'ERROR: Unable to update sales record for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
		mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
		mysql_close($link);
		die($msg);
	}
}

// Email the user confirmation
$msg = "You have removed your license key for " . $productName . "-" . $contractName . ":\n\n";
$msg .= "Reference Number: " . $referenceNumber . "\n";
$msg .= "User Name: " . $fusername . "\n";
$msg .= "License Key: " . $flicensekey . "\n";
$msg .= "License Key Date: " . $keyDate . "\n\n";
$msg .= $info . "\n";
$msg .= "You may get a new license key on another (or the same) PC by using the License Manager.\n\n";
$msg .= "Use the reference number above and the user name and email address exactly as shown above.\n\n";

// YYYY-MM-DD 0,4 5,2 8,2
$license_date = mktime(0, 0, 0, substr($keyDate,5,2), substr($keyDate,8,2), substr($keyDate,0,4));
if ((time() - $license_date)/86400 > 365)
	$msg .= "WARNING: Software maintenance has expired. New keys can only be used with software versions dated within 1 year of purchase.\n\n";

$msg .= "Software maintenance expires 1 year from date of purchase.\n\n";
$msg .= "Please send us this information if you have any questions about or problems with your license.";
$msg = wordwrap($msg, 70);

$subj = 'Removed License Key for ' . $contractName . ' ' . $productName;
// bcc me, and cc buyer if not license requester
$headers = 'Bcc: mary.kroening@amzi.com' . "\r\n";
if (strcasecmp($buyeremail, $email) != 0)
	$headers .= 'Cc: ' . $buyeremail . "\r\n";
if (mail($email, $subj, $msg, $headers) == FALSE) {
	$msg = 'ERROR: Unable to send email -- Please contact Amzi! Tech Support.';
	mail('mary.kroening@amzi.com', 'ERROR Sending Remove License Key Email', $msg, '');
	mysql_close($link);
	die($msg);
}

// If we're interactive give a nice message
if ($finteractive == 'Y') {
	echo 'Confirmation has been emailed to you at ' . $email;
	echo '<p><pre>' . $info . '</pre></p>';
	mysql_close($link);
	die();
}

// Send back the reference number
echo $referenceNumber . "\n";
echo $info . "\n";

mysql_close($link);

// NOTE! The spacing below is very important as it returns newlines around the key
?>

</body>
</html>
