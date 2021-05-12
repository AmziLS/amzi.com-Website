<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- #BeginTemplate "/Templates/ar_download_1col.dwt" --><!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" --> 
<title>Lookup License</title>
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
	      <td width="100%" align="center" valign="middle" bgcolor="#D1EFFF"><h1><!-- #BeginEditable "Title" --><font color="#666666">Lookup 
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
$femail = trim(mysql_real_escape_string($_REQUEST['femail'])); 
$freferencenumber = trim(mysql_real_escape_string($_REQUEST['freferencenumber']));

if ((strlen($femail) == 0 && strlen($freferencenumber) == 0) || (strlen($femail) > 0 && strlen($freferencenumber) > 0)) {
	mysql_close($link);
	die('Please enter an email address or sales reference number (not both).');
}

// Filter out bad emails
if (strlen($femail) > 0) {
	list($userName, $mailDomain) = split("@", $femail); 
	$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
	if (!eregi($exp, $femail)) {
		mysql_close($link);
		die('ERROR: Invalid email format');
	}
}
//if (!checkdnsrr($mailDomain, "MX")) {
//	mysql_close($link);
//	die('ERROR: Invalid Email Address');
//}

// Get today's year
date_default_timezone_set("UTC");

$today = getdate();

// Get the sales records by email
if (strlen($femail) > 0) 
	$query = sprintf("SELECT keyDate, sales.referenceNumber, hardwareId, akeys.licenseKey, users.email, sales.email as buyeremail, username, contractName, productName, quantity, usedCount FROM users,akeys,sales WHERE users.referenceNumber=sales.referenceNumber and users.userNumber=akeys.userNumber and users.status='CUR' and akeys.status='CUR' and (users.email='%s' or sales.email='%s') GROUP BY sales.referenceNumber ORDER BY keyDate", $femail, $femail);
else
	$query = sprintf("SELECT keyDate, sales.referenceNumber, hardwareId, akeys.licenseKey, users.email, sales.email as buyeremail, username, contractName, productName, quantity, usedCount FROM users,akeys,sales WHERE users.referenceNumber=sales.referenceNumber and users.userNumber=akeys.userNumber and users.status='CUR' and akeys.status='CUR' and users.referenceNumber='%s' ORDER BY users.referenceNumber,users.email", $freferencenumber);
	
$result = mysql_query($query);
if (!$result || mysql_num_rows($result) == 0) {
		$msg = 'License Lookup Failed!<br>No licenses found.';
		mysql_close($link);
		die($msg);
}

$emsg = "These are your existing license keys:\n\n";

// Walk each sales record and look for all current licenses
$lastReference = '';
while ($row = mysql_fetch_assoc($result)) {
    $referenceNumber = $row['referenceNumber'];
    $email = $row['email'];
	$buyeremail = $row['buyeremail'];
    $contractName = $row['contractName'];
    $productName = $row['productName'];
    $quantity = $row['quantity'];
	$usedCount = $row['usedCount'];
   	$hardwareId = $row['hardwareId'];
   	$licenseKey = $row['licenseKey'];
    $keyDate = $row['keyDate'];
	$username = $row['username'];
	
	if (strcasecmp($lastReference, $referenceNumber) != 0) {
		// Count the transfers    
		$query2 = sprintf("SELECT COUNT(*) from users,akeys where referenceNumber='%s' and users.userNumber=akeys.userNumber and akeys.transactionDate > '%d-%d-%d'", 
		$referenceNumber, $today[year]-1, $today[mon], $today[mday]);
		$result2 = mysql_query($query2);
		if (!$result2) {
			$msg = 'ERROR: Unable to count license transfers for reference number ' . $referenceNumber . ' -- Please contact Amzi! tech support.';
			mail('mary.kroening@amzi.com', $msg, $query . "\n" . mysql_error(), '');
			mysql_close($link);
			die($msg);
		}
		$row2 = mysql_fetch_assoc($result2);
		$license_count = $row2['COUNT(*)'];
	}	
	$emsg .= "Product: " . $productName . " - " . $contractName . "\n";
	$emsg .= "User Name: " . $username . "\n";
	$emsg .= "User Email: " . $email . "\n";
	$emsg .= "License Key: " . $licenseKey . "\n";
	$emsg .= "Hardware Fingerprint: " . $hardwareId . "\n";
	$emsg .= "Sales Reference Number: " . $referenceNumber . "\n";
	$emsg .= "Purchase Date: " . $keyDate . "\n";
	$emsg .= "License Transfers Used: " . $license_count . "\n";
	// YYYY-MM-DD 0,4 5,2 8,2
	$license_date = mktime(0, 0, 0, substr($keyDate,5,2), substr($keyDate,8,2), substr($keyDate,0,4));
	if ((time() - $license_date)/86400 > 365)
		$emsg .= "WARNING: Software maintenance has expired. This key can only be used with software versions dated within 1 year of purchase.\n";
	$emsg .= "\n";
	
	$lastReference = $referenceNumber;
}

// Email the user their current license details
$emsg .= "If you have removed your license key, there is a file named 'amzi_license_uninstall.txt' in ";
$emsg .= "the root directory of your hard disk. That file contains all your license information and ";
$emsg .= "your license key uninstall code.\n\n";
$emsg .= "Software maintenance expires 1 year from date of purchase.\n\n";
$emsg = wordwrap($emsg, 70);

$subj = 'Amzi! License Information';
$headers .= 'Bcc: mary.kroening@amzi.com, dennis.merritt@amzi.com' . "\r\n";
if (strlen($femail) > 0) $to = $email;
else $to = $buyeremail;
if (mail($to, $subj, $emsg, $headers) == FALSE) {
	echo 'Unable to send email. Please contact Amzi! tech support.';
	mysql_close($link);
	die();
}

echo 'License Lookup Successful!<br>Your current license information has been emailed to you at ' . $to;

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
