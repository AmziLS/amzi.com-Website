<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=/company/thankyou.php">
<?php

$email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
if (!$email) die("Please enter a valid email address");

$headers = "From: " . $email . "\nX-Mailer: PHP";

$subject = filter_input(INPUT_POST, 'Subject', FILTER_SANITIZE_STRING);
$subject = "Amzi! Inquiry: " . $subject;
$subject = substr($subject, 0, 80);

$message = "Contact:  " . $_POST['Contact'] . "\n";
$message .= "Product:  " . $_POST['Product'] . "\n";
$message .= "Name:     " . $_POST['Name'] . "\n";
$message .= "Email:     " . $email . "\n\n";
$message .= $_POST['Comments'] . "\n";


if (strcasecmp($mailDomain, 'arulesxl.com') == 0 || strcasecmp($mailDomain, 'amzi.com') == 0)
	exit;
if (stristr($message, 'http://') != false || stristr($message, 'https://') != false)
	exit;
if (strlen(trim($message)) == 0)
	exit;

//echo "<p>message before: $message </p>";

//$message = filter_var($message,	FILTER_SANITIZE_STRING);

//echo "<p>about to mail</p>";
//echo "<p>message after: $message <\p>";

mail("dennis.merritt@amzi.com", $subject, $message, $headers, "-f " . $email);
?>