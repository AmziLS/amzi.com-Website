<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=/AINewsletter/thankyou.php">
<?php
// some local variables
$subject = "AI Newsletter Contact Form";

//$headers = "From: Contact <info@amzi.com>\nX-Mailer: PHP";
$headers = "From: " . $Email . "\nX-Mailer: PHP";
//$headers = "From: Contact <jmiller@jcmco.com>\nX-Mailer: PHP";

//$message = "\n";
//$message .= "\n";
//$message .= "\n";
//$message .= "\n";

// your text goes here
$message .= "Contact:                 $contact\n";
$message .= "First Name:              $FirstName\n";
$message .= "Last Name :              $LastName\n";
$message .= "Email     :              $Email\n";
$message .= "Subject   :              $Subject\n";
$message .= "Info      :            \n$Comments\n";;

// this ends the message part
$message .= "\n";

// send the message :-)
////mail("info@amzi.com", $subject, $message, $from_email);
mail("dennis.merritt@amzi.com", $subject, $message, $headers, "-f " . $Email);
mail("amzi.dennis@gmail.com", $subject, $message, $headers, "-f " . $Email);
//mail("jmiller@jcmco.com", $subject, $message, $headers, "-f ". $Email);
?>

