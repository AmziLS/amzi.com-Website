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

// Get the sales records by email
$query = "SELECT transactionDate, transactionTime, referenceNumber, armadilloHardwareId, licenseKey, email, title, firstName, lastName, status FROM sales";
$result = mysql_query($query);
if (mysql_num_rows($result) == 0) {
		$msg = 'No sales records found.';
		mysql_close($link);
		die($msg);
}

echo 'Found ' . mysql_num_rows($result) . ' rows';
$i = 0;

// Walk each sales record and create a licenses record
while ($row = mysql_fetch_assoc($result)) {
	// If there's a license key, add a license record too
	if (strlen($row['licenseKey']) > 0) {
		$i = $i + 1;
		$f = '(transactionDate, transactionTime, referenceNumber, username, licenseKey, ';
		$f .= 'armadilloHardwareId, email, uninstallCode, allowNameChange, status, reason)';
		
		$q = 'VALUES(';
		$q .= "'" . $row['transactionDate'] . "', ";
		$q .= "'" . $row['transactionTime'] . "', ";
		$q .= "'" . $row['referenceNumber'] . "', ";
		$username = '';
		if (strlen(trim($row['title'])) > 0) 
			$username = $row['title'] . ' ';
		$username .= $row['firstName'] . ' ' . $row['lastName'];
		$q .= "'" . $username . "', ";
		$q .= "'" . $row['licenseKey'] . "', ";
		$q .= "'" . $row['armadilloHardwareId'] . "', ";
		$q .= "'" . $row['email'] . "', ";
		$q .= "'', 'N', '". $row['status'] . "', 'NEW')";
	
		$insert = 'INSERT INTO licenses ' . $f . ' ' . $q;
		echo '<p>' . $i . '   ' . $insert . '</p>';

		$result2 = mysql_query($insert);
		if (!$result2) {
			echo '*** FAILED ***' . mysql_error();
		}
	}
}

mysql_close($link);

?>
