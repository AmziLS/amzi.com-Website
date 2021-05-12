<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h2>Generic Treatment Page</h2>
<?php

echo "<p> Incoming data: </p>";
foreach( $_GET as $key => $value ) {
	echo "<p>" . $key . " = " . $value . "</p>";
	}

?>
</body>
</html>
