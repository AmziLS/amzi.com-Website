<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- #BeginTemplate "/Templates/ar_download_1col.dwt" --><!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" --> 
<title>Transfer License</title>
&nbsp;&nbsp;&nbsp;<!-- #EndEditable -->
<!-- #BeginEditable "head" -->
<!-- #EndEditable -->
<link href="/ARulesXL/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="150" height="117"><img src="/ARulesXL/images/logo_shiprock2.jpg" width="150" height="115" /></td>
    <td colspan="2" valign="top" bgcolor="#D1EFFF">
	  <table width="100%" height="115" border="0" cellspacing="5">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="100%" align="center" valign="middle" bgcolor="#D1EFFF"><h1><!-- #BeginEditable "Title" --><font color="#666666">Transfer 
        License </font><!-- #EndEditable --></h1></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="387" valign="top" bgcolor="#D1EFFF"><table width="150" border="0" id="nav">
      <tr>
        <td height="35"><a href="/ARulesXL/index.html">Home</a></td>
      </tr>
    </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/overview/index.htm">Overview &amp; Whitepapers</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/docs/index.htm">Documentation</a></td>
        </tr>
      </table>
      <table width="150" border="0" id="active">
        <tr>
          <td height="35"><a href="/ARulesXL/download/index.htm">Download &amp; Buy </a></td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/news/index.htm">Product News</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="http://forum.arulesxl.com">Support Forum</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/company/contact.htm">Contact Us</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/mail/mailinglist.htm">Mailing List</a> </td>
        </tr>
      </table>    
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/resources/index.htm">Other Resources</a> </td>
        </tr>
      </table>	</td>
    <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td width="100%" valign="top"><!-- #BeginEditable "Contents" --> 
<p><font size="+1">

<?php

// Connect to the licenses database
$link = mysql_connect('localhost', 'licenses', 'n0p1racy');
if (!$link) {
    die('Could not connect to license database: ' . mysql_error() . 'Please contact Amzi! Tech Support.');
}

// Make licenses the current db
$db_selected = mysql_select_db('licenses', $link);
if (!$db_selected) {
	mysql_close($link);
    die ('Cannot use licenses database : ' . mysql_error() . 'Please contact Amzi! Tech Support.');
}

// Clean up all the paramters up-front
$fusername = trim(mysql_real_escape_string($_POST['fusername']));
$flicense = trim(mysql_real_escape_string($_POST['flicense']));  
$femail = trim(mysql_real_escape_string($_POST['femail'])); 
$foldfingerprint = trim(mysql_real_escape_string($_POST['foldfingerprint'])); 
$fnewfingerprint = trim(mysql_real_escape_string($_POST['fnewfingerprint'])); 
$funinstallcode = trim(mysql_real_escape_string($_POST['funinstallcode'])); 
$fnewusername = trim(mysql_real_escape_string($_POST['fnewusername']));  

// Check format of newfingerprint
if (strlen($fnewfingerprint) != 9 || strcmp(substr($fnewfingerprint, 4, 1), '-') <> 0) {
	mysql_close($link);
	$msg = 'License Transfer Failed!<br>';
	$msg .= 'Invalid format for new hardware fingerprint. Must be XXXX-XXXX. ';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	die($msg);
}

// Check format of uninstallcode
if (strlen($funinstallcode) != 9 || strcmp(substr($funinstallcode, 4, 1), '-') <> 0) {
	mysql_close($link);
	$msg = 'License Transfer Failed!<br>';
	$msg .= 'Invalid format for new unregister code. Must be XXXX-XXXX. ';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
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
		$msg = 'License Transfer Failed!<br>';
		$msg .= 'New user name is not correct. Please enter the first and last name of the actual software user. ';
		$msg .= '(This is the person who is eligible to obtain technical support.)';
		$msg .= "<br>Press your browser's 'Back' button to try again.";
		die($msg);
	}
}

// Formulate Query to see if the user has a licenses record
// This is the best way to perform a SQL query
// For more examples, see mysql_real_escape_string()
$query = sprintf("SELECT referenceNumber, username, licenseKey, armadilloHardwareId, status, transactionDate FROM licenses WHERE licenseKey='%s'",
    $flicense);

// Perform Query
$result = mysql_query($query);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query . 'Please contact Amzi! Tech Support.';
	mysql_close($link);
    die($message);
}

// Set our global values for the old and new licenses
$referenceNumber = '';
$username = '';
$email = '';
$armadilloHardwareId = '';
$licenseKey = '';
$transactionDate = '';

// Get today's year
$today = getdate();

// There should only be one record
if (mysql_num_rows($result) > 1) {
	$msg = 'Wrong number of license records found for ' . $flicense . '. ';
	$msg .= 'Please contact Amzi! Tech Support.';
	mysql_close($link);
	die($msg);
}

// Use result if there are licenses
// Attempting to print $result won't allow access to information in the resource
// One of the mysql result functions must be used
// See also mysql_result(), mysql_fetch_array(), mysql_fetch_row(), etc.
while ($row = mysql_fetch_assoc($result)) {
    // If this is the current license, save our information
	if (strcmp($row['status'], 'CUR') == 0) {
	    $referenceNumber = $row['referenceNumber'];
	    $username = $row['username'];
	    $armadilloHardwareId = $row['armadilloHardwareId'];
	    $licenseKey = $row['licenseKey'];
	}
}

// Get the sales record either by reference number or license key
if (mysql_num_rows($result) == 0) {
    $license_record_found = FALSE;
    $query = sprintf("SELECT transactionDate, referenceNumber, armadilloHardwareId, licenseKey, email, title, firstName, lastName, contractId, contractName, productName, productId, quantity FROM sales WHERE licenseKey='%s'",
        $flicense);
}
else {
    $license_record_found = TRUE;
    $query = sprintf("SELECT transactionDate, referenceNumber, armadilloHardwareId, licenseKey, email, title, firstName, lastName, contractId, contractName, productName, productId, quantity FROM sales WHERE referenceNumber='%s'",
        $referenceNumber);
}
$result = mysql_query($query);

// There should only be one record
if (mysql_num_rows($result) == 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'Unable to find license key. Please check your installed software. ';
    $msg .= 'Either the key you entered is invalid, or it has been previously unregistered. ';
    $msg .= 'You need to enter your current license key.';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	mysql_close($link);
	die($msg);
}
if (mysql_num_rows($result) > 1) {
	$msg = 'Wrong number of sales records found for ' . $flicense;
	$msg .= ' or ' . $referenceNumber . '. Please contact Amzi! Tech Support.';
	mysql_close($link);
	die($msg);
}

// Save a bunch of information from the sales record for key checking and generation
while ($row = mysql_fetch_assoc($result)) {
    $referenceNumber = $row['referenceNumber'];
    $email = $row['email'];
    $contractId = $row['contractId'];
    $contractName = $row['contractName'];
    $productId = $row['productId'];
    $productName = $row['productName'];
    $quantity = $row['quantity'];
    $transactionDate = $row['transactionDate'];
    if (strlen($username) == 0) {
    	if (strlen(trim($row['title'])) > 0) $username = $row['title'] . ' ';
    	$username .= $row['firstName'] . ' ' . $row['lastName'];
	}
    if (strlen($armadilloHardwareId) == 0)
    	$armadilloHardwareId = $row['armadilloHardwareId'];
    if (strlen($licenseKey) == 0)
    	$licenseKey = $row['licenseKey'];
}

// See if this license has exceeded the transfer limit
$query = sprintf("SELECT COUNT(*) from licenses where referenceNumber='%s' and transactionDate like '%d%%'", 
	$referenceNumber, $today['year']);
$result = mysql_query($query);
$trow = mysql_fetch_assoc($result);
$license_count = $trow['COUNT(*)'];
if ($license_count > 24) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'This license has already been transferred 24 times this year. ';
	$msg .= 'It cannot be transferred again until next year.';
	mysql_close($link);
	die($msg);
}
if ($license_count > 1) {
	echo 'This license has been transferred ' . $license_count . ' times this year. ';
	echo 'You have ' . 12 - $license_count . ' transfers remaining. ';
	echo 'Do not unregister your software again this year if you have no transfers left.';
	echo '</p><p>';
}

// Now all the current license information is in local variables
// Compare it with the inputs and see if we can issue a new license
if (strcasecmp($fusername, trim($username)) != 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'User name does not match the current one. ';
	$msg .= "<br>There is a file named 'amzi_license_transfer.txt' in the root directory of the disk ";
	$msg .= 'you unregistered the software from. That file contains your username, license key, hardware fingerprint and unregister code.<br>';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	//echo $fusername . $username . '<br>';
	mysql_close($link);
	die($msg);
}
if (strcasecmp($femail, trim($email)) != 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'Email address does not match original order.';
	$msg .= "<br>There is a file named 'amzi_license_transfer.txt' in the root directory of the disk ";
	$msg .= 'you unregistered the software from. That file contains your username, license key, hardware fingerprint and unregister code.<br>';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	//echo $_femail . $email . '<br>';
	mysql_close($link);
	die($msg);
}
if (strcasecmp($flicense, trim($licenseKey)) != 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'License key does not match the current one.';
	$msg .= "<br>There is a file named 'amzi_license_transfer.txt' in the root directory of the disk ";
	$msg .= 'you unregistered the software from. That file contains your username, license key, hardware fingerprint and unregister code.<br>';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	//echo $flicense . $licenseKey . '<br>';
	mysql_close($link);
	die($msg);
}
if (strcasecmp($foldfingerprint, trim($armadilloHardwareId)) != 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'Hardware fingerprint does not match the current one.';
	$msg .= "<br>There is a file named 'amzi_license_transfer.txt' in the root directory of the disk ";
	$msg .= 'you unregistered the software from. That file contains your username, license key, hardware fingerprint and unregister code.<br>';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	//echo $foldfingerprint . $armadilloHardwareId . '<br>';
	mysql_close($link);
	die($msg);
}

// Check if the uninstall code is required!!!
if (($license_record_found == TRUE || $quantity == 1) && 
	strlen($funinstallcode) == 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'You need to provide an unregister code before transferring your license.<br>';
	$msg .= 'See the <a href="http://www.amzi.com/download/faq_download.htm">Download FAQ</a> for instructions.';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	mysql_close($link);
	die($msg);
}

// Check if the user wants to keep the same name
if (strlen($fnewusername) == 0)
	$fnewusername = $username;
	
// Determine the key level
if ($productId == 20340) $level = '26';
if ($productId == 27017) $level = '30';

// Keymaker uses the date from the original key to generate the new key
// keymaker parameters:
// level contract_id orig_username orig_fingerprint orig_key uninstall new_username new_fingerprint
$cmd = '/amzi/bin/keymaker /' . $level . ' '. $contractId . ' "';
$cmd .= $username . '" "' . $foldfingerprint . '" "';
$cmd .= $licenseKey . '" "' . $funinstallcode . '" "';
$cmd .= $fnewusername . '" "';
$cmd .= $fnewfingerprint . '"';

$newkey = shell_exec($cmd);
$newkey = trim($newkey);

if (strlen($newkey) == 0) {
	mysql_close($link);
	die('Unable to generate new license key. Please contact Amzi! tech support.');
}

// Check if the key check and generate worked
if (strcasecmp($newkey, 'ERROR') == 0) {
    $msg = 'License Transfer Failed!<br>';
	$msg .= 'Invalid unregister code. ';
	$msg .= "<br>There is a file named 'amzi_license_transfer.txt' in the root directory of the disk ";
	$msg .= 'you unregistered the software from. That file contains your username, license key, hardware fingerprint and unregister code.<br>';
	$msg .= "<br>Press your browser's 'Back' button to try again.";
	mysql_close($link);
	die($msg);
}

// Update the old license record
if ($license_record_found == TRUE) {
	$query = sprintf("UPDATE licenses SET status = 'OLD' where licenseKey = '%s'", $flicense);
	$result = mysql_query($query);
	if (!$result) {
		echo 'Unable to update existing license record. Please contact Amzi! tech support.';
		echo $query;
		mysql_close($link);
		die();
	}
}

// Add a new license record
$date = sprintf("%4d-%02d-%02d", $today['year'], $today['mon'], $today['mday']);
$time = sprintf("%02d:%02d", $today['hours'], $today['minutes']);
$query = 'INSERT INTO licenses (transactionDate, transactionTime, referenceNumber, ';
$query .= 'username, licenseKey, armadilloHardwareId, uninstallCode, status) ';
$query .= "VALUES('" .  $date . "', '" . $time . "', '";
$query .= $referenceNumber . "', '" . $fnewusername . "', '";
$query .= $newkey . "', '" . $fnewfingerprint . "', '";
$query .= $funinstallcode . "', 'CUR')";

$result = mysql_query($query);
if (!$result) {
	echo 'Unable to add new license record. Please contact Amzi! tech support.';
	echo $query;
	mysql_close($link);
	die();
}

// Email the user the new key
$msg = "Here is your new license key for " . $productName . "-" . $contractName . ":\n\n";
$msg .= "User Name: " . $fnewusername . "\n";
$msg .= "License Key: " . $newkey . "\n";
$msg .= "Hardware Fingerprint: " . $fnewfingerprint . "\n";
$msg .= "Purchase Date: " . $transactionDate . "\n\n";
$msg .= "License Transfers Used: " . $license_count . "\n";
// YYYY-MM-DD 0,4 5,2 8,2
$license_date = mktime(0, 0, 0, substr($transactionDate,5,2), substr($transactionDate,8,2), substr($transactionDate,0,4));
if ((time() - $license_date)/86400 > 365)
	$msg .= "WARNING: Software maintenance has expired. This key can only be used with software versions dated within 1 year of purchase.\n";
if ($license_count >= 10)
	$msg .= "WARNING: Only " . 12 - $license_count . " transfers remaining this year!\n\n";
else
	$msg .= "\n";

$msg .= "Software maintenance expires 1 year from date of purchase.\n\n";
$msg .= "Please save this information in case you need to transfer your license again.\n";
$msg = wordwrap($msg, 70);

$subj = 'New License Key for ' . $productName;
$headers .= 'Bcc: mary.kroening@amzi.com' . "\r\n";
if (mail($email, $subj, $msg, $headers) == FALSE) {
	echo 'Unable to send email. Please contact Amzi! tech support.';
	mysql_close($link);
	die();
}

echo 'License Transfer Successful!<br>Your new license key has been emailed to you at ' . $email;

mysql_close($link);
?>

</font></p>
       
<meta name="Description" content="" />
<meta name="Keywords" content="" />
<!-- #EndEditable --></td>
       </tr>
    </table></td>
  </tr>
  <tr>
    <td height="1"></td>
    <td></td>
  </tr>
  <tr>
    <td height="28" colspan="3" bgcolor="#D1EFFF"><div align="center"><span class="footer">Copyright &copy; 2005-7 Amzi! inc. 
      Amzi! is a registered trademark and ARulesXL is a trademark of Amzi! 
      inc. <br />
    Microsoft, Excel and the Office logo are trademarks or registered trademarks of Microsoft Corporation in the United States and/or other countries. </span></div></td>
  </tr>
</table>
</body>
<!-- #EndTemplate --></html>
