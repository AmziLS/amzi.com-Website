<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Privacy Policy</title>
<meta name="description" content="Amzi! inc. privacy policy">

<meta name="keywords" content="Amzi! privacy, Plimus">

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
        <h1>Amzi! inc. Privacy Policy</h1>
        <hr />
      <h2>What personally identifiable information is collected </h2>
      <p>We collect IP addresses for statistical purposes and for resolving problems 
        with orders only. We save your e-mail address when you sign up for a mailing 
        list. </p>
      <p>Our e-commerce vendor, Plimus, also collects information when you place 
        an order. That information is shared with us. See <a href="http://www.plimus.com/jsp/privacy.htm">Plimus' 
        Privacy Policy</a>.</p>
      <h2>What organization is collecting the information </h2>
      <p>Amzi! inc. and Plimus, Inc. (for orders only).</p>
      <h2>How the information is used </h2>
      <p>We use the information for statistical purposes, and for fulfilling orders 
        and providing product maintenance and support. We do not share the information 
        with any third party without your prior consent.</p>
      <h2>With whom the information may be shared </h2>
      <p>Plimus shares its customer information for sales of Amzi! products with 
        us.</p>
      <h2>What choices are available to users regarding collection, use and distribution 
        of the information </h2>
      <p>It is your choice to sign-up for one of our mailing lists or to place 
        an order. You may also place orders by mail, fax or e-mail.</p>
      <h2>What kind of security procedures are in place to protect against the 
        loss, misuse or alteration of information under the company&#146;s control 
      </h2>
      <p>We secure all customer and order information with the same care we use 
        for all our company confidential information.</p>
      <h2>How users can correct any inaccuracies in the information</h2>
      <p>You may <a href="contact_form.php">contact us</a> and we will correct any 
        inaccuracies.</p>
      <p></p>
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
