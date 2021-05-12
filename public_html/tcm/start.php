<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TCM Diagnostic Assistant</title>
</head>

<body>
<?php
/*
echo "<p>" . phpversion() . "</p>";
echo "<p> Incoming: </p>";
foreach( $_GET as $key => $value ) {
	echo "<p>" . $key . " = " . $value . "</p>";
	}
*/
?>
<hr/>

<h2>Traditional Chinese Medicine Diagnostic Assistant</br>
Prototype for testing only.</h2>
<hr/>
<?php
$tcm_service = "http://www.amzi.com/cgi-bin/tcm.sh";
//$tcm_service = "/cgi-bin/hellocgi";

if ($_GET['diagnostic_state'] == "begin") {
	echo "<h4>Version: " . $_GET['version'] . "</h4>";
?>
	<p>Press start to begin a diagnostic session.</p>
    <p>You will be asked for some initial signs,
    and based on the answers will be presented with the patterns that best fit the signs.  You will then
    be able to 'continue', presenting more sign data, and seeing a more exact list of the best fitting
    patterns.</p>
    <form id='signs' name='signs' method='post' action='<?php echo $tcm_service;?>' >
    <input type='radio' id='language' name='language' value='english' checked /> English
    <input type='radio' id='language' name='language' value='chinese' /> Chinese
    <input type='radio' id='language' name='language' value='spanish' /> Spanish
    <br/>
    <p>Select a test case to run, or none to enter your own data.</p>
    <select name='test_case' id='test_case'>
       <option>none</option>
       <?php
	   // This function only works in PHP 5.3 and greater 
	   /* $menu = str_getcsv($_GET['test_cases'], ",");
	   $num = count($menu);
	   for ($i = 0; $i < $num; $i++) {
	      echo "<option>" . $menu[$i] . "</option>";
		  } */
		$menu = $_GET['test_cases'];
		$comma = strpos($menu, ',');
		while($comma) {
			$item = substr($menu, 0, $comma);
			echo "<option>" . $item . "</option>";
			$menu = substr($menu, $comma + 1);
			//echo "<option>" . $menu . "</option>";
			$comma = strpos($menu, ',');
			//echo "<option>" . $comma . "</option>";
			if (! $comma) echo "<option>" . $menu . "</option>";
		}
	   ?>
    </select>
    <br/>
    <input type='submit' id='submit' name='submit' value='start' />
    </form>
<?php
	}
elseif ($_GET['diagnostic_state'] == "ask" && count($_GET) <= 3) {
	echo "<h4>No more information to be gathered.  Use the back button to see the final results.</h4>";
	}
elseif ($_GET['diagnostic_state'] == "ask" || $_GET['diagnostic_state'] == "init") {
	echo "<h4>Select none or more answers for each of the questions below.</h4>";
	echo "<form id='signs' name='signs' method='post' action='" . $tcm_service . "' >";
	//echo "<form id='signs' name='signs' method='get' action='dummy.php' >";
	echo "<table>";
	// The Query String is of the form ?stage=ask&token=text,tok,txt,tok,txt...&token=text,tok,txt...
	foreach( $_GET as $key => $value ) {
		if ($key == 'diagnostic_state' || $key == 'option') {
			continue;
		}
		elseif ($key == 'state_file') {
			echo "<input type='hidden' name='state_file' value='" . $value . "'>";
		}
		elseif ($key == 'language') {
			echo "<input type='hidden' name='language' value='" . $value . "'>";
		}
		elseif ($key == 'test_case') {
			echo "<input type='hidden' name='test_case' value='" . $value . "'>";
		}
		elseif ($key == 'first_ask') {
			echo "<input type='hidden' name='first_ask' value='" . $value . "'>";
		}
		else {
			echo "<tr>";
				/*  str_getcsv not supported before 5.3, Hostmonster is running 5.2
				$menu = str_getcsv($value, ",");
				echo "<td>" . stripslashes($menu[0]) . "</td>";
				echo "<td>";
				//echo "<input type='text' name='" . $key . "' size='20' />";
				$num = count($menu);
				for ($i = 1; $i < $num; $i+=2) {
					//echo "<input type='checkbox' name='" . $menu[0] . "[]' value='" . $menu[i] . "'/>";
					$colon = strpos($menu[$i+1], ':');
					if ($colon === false) {
						echo "<input type='checkbox' name='" . $key . "' value='" . stripslashes($menu[$i]) . "'/>";
						echo $menu[$i+1];
						}
					else {
						$item = substr($menu[$i+1], $colon+1);
						echo "<input type='checkbox' name='" . $key . "' value='" . stripslashes($menu[$i]) . "' checked />";
						echo $item;
						}
				}			
				echo "</td>";
				*/
				
				$menu = $value;
				$comma = strpos($menu, ',');
				$item = substr($menu, 0, $comma);
				$menu = substr($menu, $comma + 1);
				echo "<td>" . $item . "</td>";
				echo "<td>";
				//echo "<input type='text' name='" . $key . "' size='20' />";
				$comma = strpos($menu, ',');

				
				while ($comma) {
					//echo "<input type='checkbox' name='" . $menu[0] . "[]' value='" . $menu[i] . "'/>";
					$item = substr($menu, 0, $comma);
					$menu = substr($menu, $comma + 1);
					$comma = strpos($menu, ',');
					if (! $comma) $item2 = $menu;
					else {
						$item2 = substr($menu, 0, $comma);
						$menu = substr($menu, $comma + 1);
					}
					$colon = strpos($item2, ':');
					if ($colon === false) {
						echo "<input type='checkbox' name='" . $key . "' value='" . stripslashes($item) . "'/>";
						echo $item2;
						}
					else {
						$item2 = substr($item2, $colon+1);
						echo "<input type='checkbox' name='" . $key . "' value='" . stripslashes($item) . "' checked />";
						echo $item2;
						}
					$comma = strpos($menu, ',');
				}			
				echo "</td>";
				
			echo "</tr>";
		}
	}
	echo "<tr><td></td>";
	if ($_GET['diagnostic_state'] == "ask") { $button_value = 'analyze'; } else { $button_value = 'next'; }
	echo "<td><input type='submit' name='submit' id='submit' value='". $button_value . "' /></td></tr>";
	echo "</table></form>";
}
elseif ($_GET['diagnostic_state'] == "tell") {
?>
	<p>These are the patterns that best fit the known signs.</p>
    <p>The score is a simple algorithm where the
    signs that match a pattern's conditions are +1 and the signs that do not match are -1.  In the list of
    negative signs below, the sign that was expected is listed.  For example, if it lists as a negative
    sputum=little, that means the pattern requires sputum=little, but sputum is known to have a different
    value.</p>
    <p>Click 'continue' to proceed with further analysis.</p>
    <p>You can hit the back button on your browser to change the answers entered on the previous screen.</p>
<?php
	echo "<table>";
	foreach( $_GET as $key => $value ) {
		if ($key == 'diagnostic_state' || $key == 'option') {
			continue;
		}
		elseif ($key == 'state_file') {
			continue;
		}
		elseif ($key == 'language') {
			continue;
		}
		elseif ($key == 'test_case') {
			continue;
		}
		elseif ($key == 'first_ask') {
			continue;
		}
		else {
			/* $items = str_getcsv($value, '^');
			echo "<tr><td>" . "<b>" . $key . "</b>" . " (" . $items[1] . ") score = " . $items[0] . "</td></tr>";
			echo "<tr><td>" . "Confirming signs: " . $items[2] . "</td></tr>";
			echo "<tr><td>" . "Negating signs: " . $items[3] . "</td></tr>";
			//echo "<tr><td>" . "Treatment: " . $items[4] . "</td></tr>";
			//echo "<tr><td>" . $key . " = " . $value . "</td></tr>";
			echo "<tr></tr>"; */
			
			$menu = $value;
			$comma = strpos($menu, '^');
			$i = 0;
			$items = array();
			while ($comma) {
				$items[$i] = substr($menu, 0, $comma);
				$menu = substr($menu, $comma + 1);
				$i++;
				$comma = strpos($menu, '^');
				if (! $comma) $items[$i] = $menu;
			}
				
			
			echo "<tr><td>" . "<b>" . $key . "</b>" . " (" . $items[1] . ") score = " . $items[0] . "</td></tr>";
			echo "<tr><td>" . "Confirming signs: " . $items[2] . "</td></tr>";
			echo "<tr><td>" . "Negating signs: " . $items[3] . "</td></tr>";
			echo "<tr></tr>";
		}
	}
	echo "</table>";

    echo "<form id='signs' name='signs' method='post' action='" . $tcm_service . "' >";
    //echo "<form id='signs' name='signs' method='get' action='dummy.php' >";
	if (isset($_GET['state_file'])) echo "<input type='hidden' name='state_file' value='" . $_GET['state_file'] . "'>";
    echo "<input type='submit' id='submit' name='submit' value='continue' />";
    echo "<input type='submit' id='submit' name='submit' value='finish' />";
    echo "</form>";
}
elseif ($_GET['diagnostic_state'] == "done") {
?>
	<p>These are the patterns that best fit the known signs.</p>
    <p>The score is a simple algorithm where the
    signs that match a pattern's conditions are +1 and the signs that do not match are -1.  In the list of
    negative signs below, the sign that was expected is listed.  For example, if it lists as a negative
    sputum=little, that means the pattern requires sputum=little, but sputum is known to have a different
    value.</p>
    <p>Click 'continue' to proceed with further analysis.</p>
    <p>You can hit the back button on your browser to change the answers entered on the previous screen.</p>
<?php
	echo "<table>";
	foreach( $_GET as $key => $value ) {
		if ($key == 'diagnostic_state' || $key == 'option') {
			continue;
		}
		elseif ($key == 'state_file') {
			continue;
		}
		elseif ($key == 'language') {
			continue;
		}
		elseif ($key == 'test_case') {
			continue;
		}
		elseif ($key == 'first_ask') {
			continue;
		}
		else {
			//$items = str_getcsv($value, '^');
			$menu = $value;
			$comma = strpos($menu, '^');
			$i = 0;
			$items = array();
			while ($comma) {
				$items[$i] = substr($menu, 0, $comma);
				$menu = substr($menu, $comma + 1);
				$i++;
				$comma = strpos($menu, '^');
				if (! $comma) $items[$i] = $menu;
			}
			echo "<tr><td>" . "<b>" . $key . "</b>" . " (" . $items[1] . ") score = " . $items[0] . "</td></tr>";
			echo "<tr><td>" . "Confirming signs: " . $items[2] . "</td></tr>";
			echo "<tr><td>" . "Negating signs: " . $items[3] . "</td></tr>";
			echo "<tr><td>" . "Treatment: " . stripslashes(urldecode($items[4])) . "</td></tr>";
	"<a href='http://www.amzi.com/tcm/treatment.php?language=english&treatment=herbal&diagnosis=wind_cold_cough'>herbal* - wind_cold_cough*</a>*" . "</td></tr>";
			//echo "<tr><td>" . $key . " = " . $value . "</td></tr>";
			echo "<tr></tr>";
	}
	}
	echo "</table>";

    echo "<form id='signs' name='signs' method='post' action='" . $tcm_service . "' >";
    //echo "<form id='signs' name='signs' method='get' action='dummy.php' >";
		if (isset($_GET['state_file'])) echo "<input type='hidden' name='state_file' value='" . $_GET['state_file'] . "'>";
    echo "<input type='submit' id='submit' name='submit' value='continue' />";
    //echo "<input type='submit' id='submit' name='submit' value='finish' />";
    echo "<input type='submit' id='submit' name='submit' value='begin' />";
    echo "</form>";
}
else {
?>
	<p>Press begin to begin a diagnostic session.</p>
    <p>You will be asked for some initial signs,
    and based on the answers will be presented with the patterns that best fit the signs.  You will then
    be able to 'continue', presenting more sign data, and seeing a more exact list of the best fitting
    patterns.</p>
    <form id='begin' name='begin' method='post' action='<?php echo $tcm_service;?>' >
    <br/>
    <input type='submit' id='submit' name='submit' value='begin' />
    </form>
<?php } ?>

<p>&nbsp; </p>
<?php include "footer.php"; ?>
</body>
</html>

