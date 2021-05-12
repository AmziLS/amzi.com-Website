<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EVA Database</title>
</head>

<body>
<?php
$button = $_POST['button'];
//echo "<p>button = $button </p>";
//echo "<p>about to connect</p>";
$link = mysql_connect('localhost', 'root', 'galax');
//echo "<p>did connect, link = $link </p>";
if (!$link) {
	$msg = 'Could not connect to Amzi! databases: ' . mysql_error();
    echo "<p> $msg </p>";
	die;
}
echo "<p>about to select</p>";
$db = mysql_select_db('EVA', $link);
echo "<p>did select, db = $db </p>";
if (!$db) {
	$msg = 'Could not connect to EVA: ' . mysql_error();
    echo "<p> $msg </p>";
	die;
}

if ($button == 'Submit') {
	$fields = "(birthdate, visitdate, gender, vaccines, comment) ";
	$values = " VALUES('" . $_REQUEST['BirthDate'] . "', ";
	$values .= "'" . $_REQUEST['TestDate'] . "', ";
	$values .= "'" . $_REQUEST['Gender'] . "', ";
	$values .= "'" . $_REQUEST['Vaccines'] . "', ";
	$values .= "'" . $_REQUEST['Comment'] . "') ";
	$query = "INSERT INTO cases $fields $values";
	echo "<p> $query </p>";
	$result = mysql_query($query);
	if (!$result) {
		$msg = 'Error updating cases: ' . mysql_error();
		echo "<p> $msg </p>";
		die;
	}
	
	// get the internal id of the last person added above
	$id = mysql_insert_id();
	if ($id == 0) {
	   $msg = "Unable to get internal ID of last update";
	   mail($mailee, 'OFB Database Error', $msg);
	   die($msg);
	}

	$fields = "(id, vaccination, vaccinationdate) ";
	$vaccinations = $_REQUEST['Vaccination'];
	$vaccinationdates = $_REQUEST['VaccinationDate'];
	echo "<p>vaccinations</p>";
	$count = count($vaccinations);
	for ($i = 0; $i < $count; $i++) {
		if ($vaccinations[$i] != '') {
			$values = " VALUES( $id, '$vaccinations[$i]', '$vaccinationdates[$i]' ) ";
			$query = "INSERT INTO vaccinations $fields $values";
			echo "<p> $query </p>";
			$result = mysql_query($query);
			if (!$result) {
				$msg = 'Error updating cases: ' . mysql_error();
				echo "<p> $msg </p>";
				die;
			}
		}
	}
	
}
?>
</body></html>