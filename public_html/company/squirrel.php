<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Logo</title>
<meta name="description" content="Amzi! inc. flying squirrel logo was inspired by some baby
flying squirrels that made their home in the Amzi! offices.  The logo photo itself was taken by 
Joe McDonald.">

<meta name="keywords" content="Amzi! amzi logo flying squirrel joe mcdonald photography">

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

      <h1> The Amzi! Logo</h1>
          <hr />
        <p>The Amzi! Logo was inspired by some baby flying squirrels that
        made a home in the Amzi! offices.</p>
        <p>Thinking about it, flying squirrels are amazing creatures with abilities to do things
        normal squirrels can't do.  Yet they're not often seen and not as common as regular squirrels.</p>
        <p>It's sort of like the relationship between Prolog and conventional programming languages...</p>
      <P><IMG SRC="/company/twosqrls.gif" ALT="Flying Squirrel Photo" HEIGHT=265 WIDTH=574> </P>
      <P>To learn more about these wonderful animals see <a href="http://www.isidore-of-seville.com/flyingsquirrel/">Flying 
        Squirrel Central</a></P>
        <p>The spectacular picture of a flying squirrel in flight
        that is the logo was taken by <a href="http://www.hoothollow.com/Original%20website%20folders/default.htm">Joe McDonald</a>.</p>
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
