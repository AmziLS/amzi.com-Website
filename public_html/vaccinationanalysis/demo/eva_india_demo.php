<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EVA India</title>
</head>

<body>
<h1>EVA India</h1>
<h2><font color=red>Demonstration Only, Not for Medical use</font></h2>
<p><a href='/vaccinationanalysis/index.html'>EVA</a> is a tool for the encoding, verification, testing, and deployment of vaccination knowledge.</p>
<p>
<a href='/vaccinationanalysis/eva_user_documentation.html'>Click here for an overview of the user interface.</a></p>
<p>
 Please <a href="../contact.html">Contact Us</a> with any questions, comments, observations.</p>
 
<?php
$addr = $_SERVER['REMOTE_ADDR'];
$subaddr = substr($addr, 0, 11);
if ($addr == "127.0.0.1")
{
	$host = 'localhost';
	$dbuser = 'root';
	$dbpass = 'katoollie';
	$dbname = 'EVA_India';
}
else
{
	$host = 'localhost';
	$dbuser = 'amzitwoc_dennis';
	$dbpass = '?-izmA!';
	$dbname = 'amzitwoc_eva_india';
}
?>
 
<form id="form1" name="form1" method="post" action="eva_india_input.php">
<table border="4" cellpadding="2" cellspacing="2" bordercolor="#CC0000" bordercolorlight="#FF6666" bordercolordark="#990000">
<tr>
        <td width="234"><font size="-1" face="Arial, Helvetica, sans-serif">Either select a case, or enter your own data.  You can modify the information after selecting one of the cases.</font></td>
      <td width="465">
        
	    <table border="4" cellpadding="2" cellspacing="2" bordercolor="#0066FF" bordercolorlight="#33CCFF" bordercolordark="#0033CC">
       	  <tr><td><h4>Stored Cases</h4></td></tr>
				<tr>
                  <td><select name="case" type="text" width=400><option selected>New Case</option>

                    <?php
                    $link = mysql_connect($host, $dbuser, $dbpass);
                    //echo "<p>did connect, link = $link </p>";
                    if (!$link) {
                        $msg = 'Could not connect to Amzi! databases: ' . mysql_error();
                        echo "<p> $msg </p>";
                        die;
                    }
                    $db = mysql_select_db($dbname, $link);
                    if (!$db) {
                        $msg = 'Could not connect to EVA: ' . mysql_error();
                        echo "<p> $msg </p>";
                        die;
                    }
                    
                    $query = "SELECT id, comment, visitdate - birthdate AS age FROM cases ORDER BY age";
                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        //echo "<p>" . $row['id'] . " " . $row['comment'] . "</p>";
                        echo "<option ";
                        if ($_POST['case'] == $row['comment']) echo 'selected>'; else echo '>';
                        echo $row['comment'] . "</option>";
                        }
                    ?>
                    
                  </select></td>
                </tr>
                <tr>
                    <td width><input type='submit' name='get_case' value='Select' /></td>
                </tr>
	    </table>
        </td>
    </tr>
</table>
</form>

</body>
</html>