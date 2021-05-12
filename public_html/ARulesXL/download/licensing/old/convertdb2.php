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

// Get the licenses records
$query = "SELECT transactionDate, transactionTime, referenceNumber, username, armadilloHardwareId, licenseKey, uninstallCode, email, status, reason FROM licenses";
$result = mysql_query($query);
if (mysql_num_rows($result) == 0) {
		$msg = 'No licenses records found.';
		mysql_close($link);
		die($msg);
}

echo 'Found ' . mysql_num_rows($result) . ' rows';
$i = 0;

// Walk each sales record and create a licenses record
while ($row = mysql_fetch_assoc($result)) {
	// Get the sale
	$squery = sprintf("SELECT contractId FROM sales where referenceNumber='%s'", $row['referenceNumber']);
	$sresult = mysql_query($squery);
	if (mysql_num_rows($sresult) == 0) {
		$msg = 'No matching sales record found.';
		mysql_close($link);
		die($msg);
	}
	$srow = mysql_fetch_assoc($sresult);
	
	// See if the user already exists
	$tquery = sprintf("SELECT userNumber FROM users where referenceNumber='%s' and username='%s'", $row['referenceNumber'], $row['username']);
	$tresult = mysql_query($tquery);
	$trow = mysql_fetch_assoc($tresult);
	
	// If no user, add it
	if (mysql_num_rows($tresult) == 0) {
		$i = $i + 1;
		$f = '(transactionDate, transactionTime, userNumber, referenceNumber, username, ';
		$f .= 'email, keysAllowed, status, reason)';
		
		$q = 'VALUES(';
		$q .= "'" . $row['transactionDate'] . "', ";
		$q .= "'" . $row['transactionTime'] . "', NULL, ";
		$q .= "'" . $row['referenceNumber'] . "', ";
		$q .= "'" . $row['username'] . "', ";
		$q .= "'" . $row['email'] . "', ";
		if ($srow['contractId'] == 1629571 || $srow['contractId'] == 1629572 || $srow['contractId'] == 1629574 || $srow['contractId'] == 1629575)
			$q .= "2, ";
		else
			$q .= "1, ";
		$q .= "'CUR', 'NEW')";
	
		$uinsert = 'INSERT INTO users ' . $f . ' ' . $q;
		echo '<p>' . $i . '   ' . $uinsert . '</p>';
	
		$uresult = mysql_query($uinsert);
		if (!$uresult) {
			echo '*** USER INSERT FAILED ***' . mysql_error();
		}
	}	
	
	$f = '(transactionDate, transactionTime, userNumber, licenseKey, hardwareId, ';
	$f .= 'uninstallCode, status, reason)';
		
	$q = 'VALUES(';
	$q .= "'" . $row['transactionDate'] . "', ";
	$q .= "'" . $row['transactionTime'] . "', ";
	// If we added a user get that id
	if (mysql_num_rows($tresult) == 0) 
		$q .= "LAST_INSERT_ID(), ";
	else
		$q .= $trow['userNumber'] . ", ";
	$q .= "'" . $row['licenseKey'] . "', ";
	$q .= "'" . $row['armadilloHardwareId'] . "', ";
	$q .= "'" . $row['uninstallCode'] . "', ";
	$q .= "'" . $row['status'] . "', ";
	$q .= "'" . $row['reason'] . "')";

	$kinsert = 'INSERT INTO akeys ' . $f . ' ' . $q;
	echo '<p>' . $i . '   ' . $kinsert . '</p>';

	$kresult = mysql_query($kinsert);
	if (!$kresult) {
		echo '*** LICENSEKEY INSERT FAILED ***' . mysql_error() . ' ';
	}

}

mysql_close($link);

?>
