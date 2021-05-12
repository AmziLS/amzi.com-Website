<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=evathankyou.php">
<?php
// some local variables
$subject = "EVA Contact Form";

//$headers = "From: Contact <info@amzi.com>\nX-Mailer: PHP";
$headers = "From: " . $Email . "\nX-Mailer: PHP";
//$headers = "From: Contact <jmiller@jcmco.com>\nX-Mailer: PHP";

//$message = "\n";
//$message .= "\n";
//$message .= "\n";
//$message .= "\n";

// your text goes here

$message .= "Name:            $Name\n";
$message .= "Email:           $Email\n";
$message .= "Info:          \n$Message\n";

// this ends the message part
$message .= "\n";

// filter out silly people
//list($userName, $mailDomain) = split("@", $Email); 
//$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
//if (!eregi($exp, $Email))
//	die('Invalid email format');
//if (!checkdnsrr($mailDomain, "MX")) 
//	die('Invalid Email Address');

if (strcasecmp($mailDomain, 'arulesxl.com') == 0 || strcasecmp($mailDomain, 'amzi.com') == 0)
	exit;
//if (strcasecmp($Email, 'dresses@gmail.com') == 0)
//	exit;
if (stristr($message, 'http://') != false || stristr($message, 'https://') != false)
	exit;
if (strlen(trim($message)) == 0)
	exit;
	

   mail("dennis.merritt@amzi.com", $subject, $message, $headers, "-f " . $Email);
   mail("dennis.c.merritt@gmail.com", $subject, $message, $headers, "-f " . $Email);

?>