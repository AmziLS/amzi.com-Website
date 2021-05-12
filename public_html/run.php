<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vamobi AbelTest Platform</title>
</head>

<body>
<?php

// This is a single page of code that has the forms, and when
// the form is submitted, it comes back to this same page of code.
// Each time is like the first time, so the current question id ($QID)
// is passed in the URL each time so the next question can be found.
//
// Note that the form checks to see if it's already been submitted, and
// if so remembers the answer chosen to the checked box remains checked.

// page was loaded with question ID and results of last post

$QNum = htmlspecialchars($_GET["qnum"]);
if ($_POST["next"]) $QNum++;
if ($_POST["quit"]) die ("Thanks for taking the test!");

$dbuser = "amzitwoc_abel";
$dbpass = "Mozambique";
$dbname = "amzitwoc_vamobi";

$link = mysql_connect('localhost', $dbuser, $dbpass);

if (!$link) {
   $msg = 'Could not connect to MySQL: ' . mysql_error();
   die($msg);
   }

$db_selected = mysql_select_db($dbname, $link);
if (!$db_selected) {
   $msg = 'Could not open the Vamobi database: ' . mysql_error();
   die($msg);
   }

$result = mysql_query("SELECT COUNT(*) AS total FROM Questions");
$row = mysql_fetch_array($result);
$count = $row['total'];
if ($QNum >= $count) die("That''s the end of test.");

$query = "SELECT * FROM Questions ORDER BY 'SeqNum' LIMIT 1 OFFSET " . $QNum;
$result = mysql_query($query);
if (!$result) {
	$msg = 'Vamobi query error: ' . mysql_error();
	die($msg); }
$row = mysql_fetch_array($result);
$prompt = $row['Question'];
$qid = $row['Qid'];

$choices = array();
$comments = array();
$i = 0;
$query2 = "SELECT * FROM Choices WHERE Qid = " . $qid;
$result2 = mysql_query($query2);
if (!$result2) {
	$msg = 'Vamobi query error: ' . mysql_error();
	die($msg); }
while ($row2 = mysql_fetch_array($result2)) {
	$choices[$i] = $row2['Choice'];
	$comments[$i] = $row2['Status'];
	$i++;
	}

$A = $choices[0];
$B = $choices[1];
$C = $choices[2];
$D = $choices[3];
$E = $choices[4];

$X = htmlspecialchars($_POST["choice"]);

?>

<form id="quest" name="quest" method="post" action="run.php?qnum=<?php echo $QNum;?>">
	<?php echo $prompt;?><br/>
	A <input type="radio" name="choice" value="<?php echo $A;?>" <?php if ($X == $A) echo "checked";?>> <?php echo $A?><br/>
	B <input type="radio" name="choice" value="<?php echo $B;?>" <?php if ($X == $B) echo "checked";?>> <?php echo $B?><br/>
	C <input type="radio" name="choice" value="<?php echo $C;?>" <?php if ($X == $C) echo "checked";?>> <?php echo $C?><br/>
	D <input type="radio" name="choice" value="<?php echo $D;?>" <?php if ($X == $D) echo "checked";?>> <?php echo $D?><br/>
	E <input type="radio" name="choice" value="<?php echo $E;?>" <?php if ($X == $E) echo "checked";?>> <?php echo $E?><br/>
    <input type="submit" name="go" value="go" />
</form>
<br/>
<br/>

<?php
if($_POST["go"]) {
	$Choice = htmlspecialchars($_POST["choice"]);
	$Answer = $questions[$QID]["Answer"];
	
	$i = 0;
	while ($Choice != $choices[$i] && $i < 4) $i++;
	
	echo $Choice . " -- " . $comments[$i] . "<br/>";
	?>
    
<form id="next" name="next" method="post" action="run.php?qnum=<?php echo $QNum;?>">
	<input type="submit" name="retry" value="retry" />
	<input type="submit" name="next" value="next" />
	<input type="submit" name="quit" value="quit" />
</form>

<?php
}
?>
</body>
</html>
