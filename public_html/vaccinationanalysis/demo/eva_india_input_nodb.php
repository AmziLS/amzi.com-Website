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
 
<!--
<form id="form1" name="form1" method="post" action="">
<table border="4" cellpadding="2" cellspacing="2" bordercolor="#CC0000" bordercolorlight="#FF6666" bordercolordark="#990000">
<tr>
        <td width="234"><font size="-1" face="Arial, Helvetica, sans-serif">Either select a case, or enter your own data.  You can modify the information after selecting one of the cases.</font></td>
      <td width="465">
        
	    <table border="4" cellpadding="2" cellspacing="2" bordercolor="#0066FF" bordercolorlight="#33CCFF" bordercolordark="#0033CC">
       	  <tr><td><h4>Stored Cases</h4></td></tr>
				<tr>
                  <td><select name="case" type="text" width=400><option < ?php if ($_POST['case'] == 'New Case') echo 'selected'; ?>>New Case</option>

                    < ?php /*
                    $link = mysql_connect('localhost', 'root', 'galax');
                    //echo "<p>did connect, link = $link </p>";
                    if (!$link) {
                        $msg = 'Could not connect to Amzi! databases: ' . mysql_error();
                        echo "<p> $msg </p>";
                        die;
                    }
                    $db = mysql_select_db('EVA', $link);
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
                    */ ?>
                    
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
-->

<h3>Fill in the form, selecting the vaccines and the dates they were give.<br/>
Use YYYY-MM-DD for the dates.  You will then see the retrospective analysis of the vaccines given and the forecast of the next vaccines needed and when.</h3>

<?php
/*
if ($_POST['get_case'] == 'Select' && $_POST['case'] != 'New Case') {
	$query = "SELECT id, birthdate, visitdate, gender, vaccines, comment FROM cases WHERE ";
	$query .= "comment = '" . $_POST['case'] . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$vquery = "SELECT vaccination, vaccinationdate FROM vaccinations WHERE id = " . $row['id'];
	$vresult = mysql_query($vquery);
	$vcount = mysql_num_rows($vresult);
	}
else {
	*/
	$row['birthdate'] = 'YYYY-MM-DD';
	$row['visitdate'] = 'YYYY-MM-DD';
	$row['gender'] = 'male';
	$row['vaccines'] = 'all';
	$row['comment'] = '';
	
	$vcount = 0;
	//}
?>

<p><font color=green>Enter dates in the format <b>YYYY-MM-DD</b>.</font></p>
<form id="form1" name="form1" method="post" action="/cgi-bin/eva_cgi">
    <table>
    <tr><td>Birth Date: </td>
    	<td><input name="BirthDate" type="text" value=<?php echo "'".$row['birthdate']."'"; ?> /></td></tr>
    <tr><td>Office Visit Date: </td>
    	<td><input name="TestDate" type="text" value=<?php echo "'".$row['visitdate']."'"; ?>/></td></tr>
    <tr><td>Gender: </td>
    	<td><select name="Gender">
        	<option <?php if ($row['gender'] == 'male') echo 'selected';?>>male</option>
        	<option <?php if ($row['gender'] == 'female') echo 'selected';?>>female</option>
		</select></td></tr>
    <tr><td>Vaccines: </td><td><select name="Vaccines" value=<?php echo "'".$row['vaccines']."'"; ?>>
    		<option <?php if ($row['vaccines'] == 'all') echo 'selected';?>>all</option>
        	<option <?php if ($row['vaccines'] == "['DTP']") echo 'selected';?>>['DTP']</option>
        	<OPTION <?php if ($row['vaccines'] == "['BCG']") echo 'selected';?>>['BCG']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['DTP']") echo 'selected';?>>['DTP']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['HepatitisB']") echo 'selected';?>>['HepatitisB']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['Hib']") echo 'selected';?>>['Hib']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['HPV']") echo 'selected';?>>['HPV']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['IPV, OPV']") echo 'selected';?>>['IPV, OPV']</OPTION>
        	<OPTION <?php if ($row['vaccines'] == "['MMR']") echo 'selected';?>>['MMR']</OPTION>
            <OPTION <?php if ($row['vaccines'] == "['Typhoid']") echo 'selected';?>>['Typhoid']</OPTION></SELECT></td></tr>
	<tr><td>Comment: </td>
    	<td><textarea name="Comment" rows="2" cols="40"> <?php echo $row['comment']; ?></textarea></td></tr>
    </table>
    
    
    <table>
    <tr><th>Vaccine</th><th>Vaccination Date</th>
    	<th>Vaccine</th><th>Vaccination Date</th></tr>
    <?php $j = 0; for ($i = 0; $i<10; $i++) { ?>
    <tr>
    	<td>
        <?php if ($j < $vcount) { $vrow = mysql_fetch_array($vresult); ?>
			<SELECT name="Vaccination">
        	<OPTION></OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'BCG') echo 'selected';?>>BCG</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTP') echo 'selected';?>>DTP</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPa') echo 'selected';?>>DTPa</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPw') echo 'selected';?>>DTPw</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPa booster') echo 'selected';?>>DTPa booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPw booster') echo 'selected';?>>DTPw booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'HepatitisB') echo 'selected';?>>HepatitisB</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Hib') echo 'selected';?>>Hib</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Hib booster') echo 'selected';?>>Hib booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'HPV') echo 'selected';?>>HPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'IPV') echo 'selected';?>>IPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Measles') echo 'selected';?>>Measles</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'MMR') echo 'selected';?>>MMR</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Mumps') echo 'selected';?>>Mumps</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'OPV') echo 'selected';?>>OPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Rubella') echo 'selected';?>>Rubella</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Tdap') echo 'selected';?>>Tdap</OPTION>
            <OPTION <?php if ($vrow['vaccination'] == 'Typhoid') echo 'selected';?>>Typhoid</OPTION></SELECT> 
		<?php } else { ?>
		<SELECT name="Vaccination">
        	<OPTION></OPTION>
        	<OPTION>BCG</OPTION>
        	<OPTION>DTP</OPTION>
        	<OPTION>DTPa</OPTION>
        	<OPTION>DTPw</OPTION>
        	<OPTION>DTPa booster</OPTION>
        	<OPTION>DTPw booster</OPTION>
        	<OPTION>HepatitisB</OPTION>
        	<OPTION>Hib</OPTION>
        	<OPTION>Hib booster</OPTION>
        	<OPTION>HPV</OPTION>
        	<OPTION>IPV</OPTION>
        	<OPTION>Measles</OPTION>
        	<OPTION>MMR</OPTION>
        	<OPTION>Mumps</OPTION>
        	<OPTION>OPV</OPTION>
        	<OPTION>Rubella</OPTION>
        	<OPTION>Tdap</OPTION>
            <OPTION>Typhoid</OPTION></SELECT> <?php } ?></td>
    	<td><input name="VaccinationDate" type="text" 
        	 <?php if ($j < $vcount) { echo "value='".$vrow['vaccinationdate']."'"; $j++; } ?>/></td>
             
    	<td>
        <?php if ($j < $vcount) { $vrow = mysql_fetch_array($vresult); ?>
			<SELECT name="Vaccination">
        	<OPTION></OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'BCG') echo 'selected';?>>BCG</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTP') echo 'selected';?>>DTP</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPa') echo 'selected';?>>DTPa</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPw') echo 'selected';?>>DTPw</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPa booster') echo 'selected';?>>DTPa booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'DTPw booster') echo 'selected';?>>DTPw booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'HepatitisB') echo 'selected';?>>HepatitisB</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Hib') echo 'selected';?>>Hib</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Hib booster') echo 'selected';?>>Hib booster</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'HPV') echo 'selected';?>>HPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'IPV') echo 'selected';?>>IPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Measles') echo 'selected';?>>Measles</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'MMR') echo 'selected';?>>MMR</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Mumps') echo 'selected';?>>Mumps</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'OPV') echo 'selected';?>>OPV</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Rubella') echo 'selected';?>>Rubella</OPTION>
        	<OPTION <?php if ($vrow['vaccination'] == 'Tdap') echo 'selected';?>>Tdap</OPTION>
            <OPTION <?php if ($vrow['vaccination'] == 'Typhoid') echo 'selected';?>>Typhoid</OPTION></SELECT> 
		<?php } else { ?>
		<SELECT name="Vaccination">
        	<OPTION></OPTION>
        	<OPTION>BCG</OPTION>
        	<OPTION>DTP</OPTION>
        	<OPTION>DTPa</OPTION>
        	<OPTION>DTPw</OPTION>
        	<OPTION>DTPa booster</OPTION>
        	<OPTION>DTPw booster</OPTION>
        	<OPTION>HepatitisB</OPTION>
        	<OPTION>Hib</OPTION>
        	<OPTION>Hib booster</OPTION>
        	<OPTION>HPV</OPTION>
        	<OPTION>IPV</OPTION>
        	<OPTION>Measles</OPTION>
        	<OPTION>MMR</OPTION>
        	<OPTION>Mumps</OPTION>
        	<OPTION>OPV</OPTION>
        	<OPTION>Rubella</OPTION>
        	<OPTION>Tdap</OPTION>
            <OPTION>Typhoid</OPTION></SELECT> <?php } ?></td>
    	<td><input name="VaccinationDate" type="text" 
        	 <?php if ($j < $vcount) { echo "value='".$vrow['vaccinationdate']."'"; $j++; } ?>/></td>
    	</tr>
    <?php } ?>
    </table>
	<input type="submit" name="button" value="Submit" />
</form>
<p>&nbsp;</p>

<?php
/*
$button = $_REQUEST['button'];
if ($button == 'Submit') {
	echo "<p><font color = blue>" . $_SERVER['QUERY_STRING'] . "</font></p>";
	virtual("/cgi-bin/eva_cgi?" . $_SERVER['QUERY_STRING']);
	}
*/
?>
</body>
</html>