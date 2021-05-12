<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Embeddable Extendable Prolog, Logic Server, Knowledge Engineering, Rule Engines, Artificial Intelligence</title>
<meta name="description" content="Amzi! inc. provides software and services for
 embedding intelligent components that apply busines rules, diagnose problems, recommend configurations, 
give advice, schedule events, monitor processes and more.">

<meta name="keywords" content="Prolog, logic programming, rule engines, artificial intelligence,
domain specific language, logic server, embeddable, extendable, knowledge engineering">

<meta name="author" content="Amzi! inc." />

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/header_links.php';
require $_SERVER['DOCUMENT_ROOT'] . '/google.php';
?>
</head>

<body>
<div id="big_picture">
<?php   //topbar is the same for whole site, and lives at the top directory
require $_SERVER['DOCUMENT_ROOT'] . '/masthead.php';
?>

<div id="content">

    <!--Side Navigation-->
    <?php
    //Sidebar lives in same directory as page 
    require ("sidebar.php");
    ?>
    <!--End Side Navigation-->

    <div id="beef">
    
        <!--Start content-->
      <table>
        <form action="/company/dispatch_contact.php" method="POST">
          <tr> 
          	<td></td>
            <td>Contact us for any reason.</td>
                </tr>
        <tr>
            <td width=25% valign="top"> <strong>Point of Contact:</strong> </td>
            <td width=75%> 
                 
                <SELECT NAME='Contact'>
                <option>Support</option>
                <option>Training</option>
                <option>Consulting</option>
                <option>Licensing</option>
                <option>Other</option>
                </SELECT>
                
            </td>
        </tr>
        <tr>
            <td width=25% valign="top"> <strong>Product:</strong> </td>
            <td width=75%> 
                 
                <SELECT NAME='Product'>
                <option>Amzi! Prolog + Logic Server</option>
                <option>ARulesXL</option>
                <option>EVA -- Vaccination Analysis</option>
                <option>Other</option>
                </SELECT>
                
            </td>
        </tr>

          <tr> 
            <td width=25%> <strong>Name:</strong> </td>
            <td width=75%> 
              <input type="text" name="Name" size=40 maxlength=50>            </td>
          </tr>
          <tr> 
            <td width=25%> <strong>Email:</strong> </td>
            <td width=75%> 
              <input type="text" name="Email" size=40 maxlength=50>            </td>
          </tr>
          <tr> 
            <td width=25%> <strong>Subject:</strong> </td>
            <td width=75%> 
              <input type="text" name="Subject" size=40 maxlength=50><br>            </td>
          </tr>
          <tr> 
            <td width=25% valign="top"> <strong>Message:</strong> </td>
            <td width=75%> 
              Please do not include any URLs in your message. Due to the large amount of spam, such messages will be automatically deleted.               
              
                <TEXTAREA NAME="Comments" COLS=60 ROWS=20></TEXTAREA>
                </td>
          </tr>
          <tr> 
            <td width=25%></td>
            <td width=75%> 
              <center>
                <input type=submit value="Contact Us">
              </center>            </td>
          </tr>
        </form>
      </table>
      
      <!--end content-->
    </div>
<div style="clear:both;"></div>
<?php
//Places copyright statement at end of page
require $_SERVER['DOCUMENT_ROOT'] . '/copyright.php';
?>
</div>  <!-- content container -->
</div>  <!-- big_picture -->

</body>
</html>
