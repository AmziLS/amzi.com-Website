<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=thankyou.php">
<?php
// some local variables
$subj = "ARulesXL Contact Form";

//$headers = "From: Contact <info@amzi.com>\nX-Mailer: PHP";
$headers = "From: " . $Email . "\nX-Mailer: PHP";
//$headers = "From: Contact <jmiller@jcmco.com>\nX-Mailer: PHP";

//$message = "\n";
//$message .= "\n";
//$message .= "\n";
//$message .= "\n";

// your text goes here
$message .= "Contact    :              $contact\n";
$message .= "First Name :              $FirstName\n";
$message .= "Last Name  :              $LastName\n";
$message .= "Email      :              $Email\n";
$message .= "Subject    :              $Subject\n";
$message .= "Info       :            \n$Comments\n";;

// this ends the message part
$message .= "\n";

// filter out silly people
/*
list($userName, $mailDomain) = split("@", $Email); 
$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
if (!eregi($exp, $Email))
	die('Invalid email format');
if (!checkdnsrr($mailDomain, "MX")) 
	die('Invalid Email Address');

if (strcasecmp($mailDomain, 'arulesxl.com') == 0 || strcasecmp($mailDomain, 'amzi.com') == 0)
	exit;
if (strcasecmp($Email, 'dresses@gmail.com') == 0)
	exit;
if (stristr($message, 'http://') != false || stristr($message, 'https://') != false)
	exit;
*/

// send the message :-)
mail("dennis.merritt@amzi.com", $subj, $message, $headers, "-f " . $Email);
mail("amzi.dennis@gmail.com", $subj, $message, $headers, "-f " . $Email);

////mail("info@amzi.com", $subject, $message, $from_email);
//mail("info@amzi.com", $subject, $message, $headers, "-f " . $Email);
//mail("jmiller@jcmco.com", $subject, $message, $headers, "-f ". $Email);
?>

