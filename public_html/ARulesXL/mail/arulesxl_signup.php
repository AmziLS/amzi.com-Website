<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=/mail/thankyou.php">
<?php
// some local variables
$headers = "From: " . $Name . "<" . $Email . ">\nX-Mailer: PHP\nBcc: mary.kroening@amzi.com\n";
if (isset($_POST['Unsubscribe']))
	$action = "Unsubscribe";
else
	$action = "Subscribe";
	
// this ends the message part
$message .= $action . " to ARulesXL Mailing List.\n";

// Do not allow line separators for additional headers
$Email = urldecode($Email);
if (eregi("\r",$Email) || eregi("\n",$Email) || strlen($Email) > 100
   || preg_match("/(%0A|%0D|\\n+|\\r+)(content-type:|to:|cc:|bcc:)/i", $Email) ) {
   die("Invalid Address");
}

// send the message :-)
mail("list_arules_news@amzi.com", $action, $message, $headers, "-f " . $Email);

// send a confirmation
if ($action == "Subscribe") {
	$message = "Thanks for subscribing to the ARulesXL mailing list. ";
	$message .= "The current edition can be found at http://www.arulesxl.com/news/current.htm.\n\n";
	$message .= "Please do not reply to this email. To contact us, visit http://www.arulesxl.com/contact";
	$message = wordwrap($message, 70);
	mail($Email, "ARulesXL Mailing List", $message, "From: donotreply@arulesxl.com");
}
else {
	$message = "You have been removed the ARulesXL mailing list. ";
	$message .= "If this is in error, please visit http://www.arulesxl.com/mail/mailinglist.htm to subscribe.\n\n";
	$message .= "Please do not reply to this email. To contact us, visit http://www.arulesxl.com/contact";
	$message = wordwrap($message, 70);
	mail($Email, "ARulesXL Mailing List", $message, "From: donotreply@arulesxl.com");
}
?>

