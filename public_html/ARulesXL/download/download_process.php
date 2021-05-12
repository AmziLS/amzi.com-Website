<?php
// some local variables
$subj = "ARulesXL Download Form";

$email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
if (!$email) die("Invalid email it was: " . $_POST['Email']);


//$headers = "From: Contact <info@amzi.com>\nX-Mailer: PHP";
$headers = "From: " . $email . "\nX-Mailer: PHP\nBcc: dennis.merritt@amzi.com\n";
//$headers = "From: Contact <jmiller@jcmco.com>\nX-Mailer: PHP";

$name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
$contact = filter_input(INPUT_POST, 'Contact', FILTER_SANITIZE_STRING);
$mailinglist = filter_input(INPUT_POST, 'MailingList', FILTER_SANITIZE_STRING);
$application = filter_input(INPUT_POST, 'Comments', FILTER_SANITIZE_STRING);


// your text goes here
$message .= "Name         :   $name\n";
$message .= "Title        :   $title\n";
$message .= "Email        :   $email\n";
$message .= "Contact      :   $contact\n";
$message .= "Mailing List :   $mailinglist\n";
$message .= "Application  :   \n$application\n";;

// this ends the message part
$message .= "\n";

if (stripos($message, "http")) die("no links");

// send the message :-)
mail("amzi.dennis@gmail.com", $subj, $message, $headers, "-f " . $Email);

// optionally add to mailing list
if ($MailingList == "yes") {
   $headers = "From: " . $Name . "<" . $Email . ">\nX-Mailer: PHP\nBcc: dennis.merritt@amzi.com\n";
   mail("list_arules_news@amzi.com", "Subscribe", "Subscribe", $headers, "-f " . $Email);
}


$usermsg = "Welcome to the ARulesXL world of integrated rule processing and spreadsheet calculation. If you have any problems with the installation contact us (see below).\n\n";

$usermsg .= "Here are some resources for getting started with ARulesXL:\n\n";

$usermsg .= "Decision Tables.xls sample:  You can open the samples from the ARulesXL menu that should appear in Excel after you have installed ARulesXL.  (If the ARulesXL menu item isn't there, contact us.)  The decision table sample shows the easiest and quickest way to enter and use rules in ARulesXL.\n\n";

$usermsg .= "Techniques Basic.xls sample: This sample contains a step-by-step series of worksheets that introduce the concepts and capabilities of ARulesXL  It illustrates a variety of application ideas as well.\n\n";

$usermsg .= "Introduction document: Select 'Documentation' from the ARulesXL menu, and click on 'Introduction' at the top of the page.  The introduction covers the basics of rules and rule engines, and the ARulesXL integration of rules and spreadsheet calculation.\n\n";

$usermsg .= "Designing Rule Sets tutorial: The tutorials are available from the ARulesXL menu. This tutorial walks you through the process of designing rules for an application.\n\n";

$usermsg .= "Learning ARulesXL tutorial: This tutorial is a step-by-step walk through the capabilities of ARulesXL rules and rule sets.\n\n";

$usermsg .= "Any questions or comments, please contact us directly at www.arulesxl.com/company/contact.htm or use the support forum at forum.arulesxl.com.\n\n";

$usermsg .= "Thanks,\nDennis Merritt\nwww.arulesxl.com\n\n";

$headers = "From: \"ARulesXL Sales\" <dennis.merritt@amzi.com>\nX-Mailer: PHP\n";
mail($Email, "ARulesXL Download", $usermsg, $headers, "-f" . "dennis.merritt@amzi.com");

header("Location: http://www.arulesxl.com/download/download_sites.php");
exit;

//mail("info@amzi.com", $subject, $message, $from_email);
//mail("info@amzi.com", $subject, $message, $headers, "-f " . $Email);
//mail("jmiller@jcmco.com", $subject, $message, $headers, "-f ". $Email);
?>

