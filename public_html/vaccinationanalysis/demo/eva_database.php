<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EVA Database</title>
</head>

<body>


<h1>EVA Database</h1>
<h2><font color=red>Create Demo Test Cases</font></h2>
<p><font color=green>Enter dates in the format <b>YYYY-MM-DD</b>.</font></p>
<form id="form1" name="form1" method="post" action="eva_update.php">
    <table>
    <tr><td>Birth Date: </td><td><input name="BirthDate" type="text" /></td></tr>
    <tr><td>Office Visit Date: </td><td><input name="TestDate" type="text" /></td></tr>
    <tr><td>Gender: </td><td><select name="Gender"><option>male</option><option>female</option></select></td></tr>
    <tr><td>Vaccines: </td><td><select name="Vaccines">
    		<option>all</option>
        	<option>['DTP']</option>
        	<OPTION>['BCG']</OPTION>
        	<OPTION>['DTP']</OPTION>
        	<OPTION>['HepatitisB']</OPTION>
        	<OPTION>['Hib']</OPTION>
        	<OPTION>['HPV']</OPTION>
        	<OPTION>['IPV, OPV']</OPTION>
        	<OPTION>['MMR']</OPTION>
            <OPTION>['Typhoid']</OPTION></SELECT></td></tr>
	<tr><td>Comment: </td><td><textarea name="Comment" rows="2" cols="40"></textarea></td></tr>
    </table>
    <table>
    <tr><th>Vaccine</th><th>Vaccination Date</th>
    	<th>Vaccine</th><th>Vaccination Date</th></tr>
    <?php for ($i = 0; $i<10; $i++) { ?>
    <tr>
    	<td><SELECT name="Vaccination[]">
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
            <OPTION>Typhoid</OPTION></SELECT></td>
    	<td><input name="VaccinationDate[]" type="text" /></td>
    	<td><SELECT name="Vaccination[]">
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
            <OPTION>Typhoid</OPTION></SELECT></td>
    	<td><input name="VaccinationDate[]" type="text" /></td></tr>
    <?php } ?>
    </table>
	<input type="submit" name="button" value="Submit" />
</form>
<p>&nbsp;</p>


</body>
</html>