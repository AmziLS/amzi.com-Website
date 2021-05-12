<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Open Source</title>
<meta name="description" content="Amzi! Install Instructions">

<meta name="keywords" content="Prolog, open source, logic programming, rule engines, artificial intelligence,
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
        <h1>ARulesXL Installation Instructions</h1>
<hr />

<p>
ARulesXL is a product that provides a rule language integrated with Excel, so that business or other rules can be included in speadsheet cells and can reason over the other cells in the spreadsheet. For example, a loan advisor can look at loan data on a spreadsheet and post in another cell whether the loan is approved or not and the reason behind the decision.</p>

<p>Unzip the file in a directory, say arules.  Open Excel and navigate to the place where you can manage Excel add-ins.  From there navigate to the arules/library directory and select the ARulesXL.XLA file.  It is the add-in.  The other files in the directory are needed to support it, but they will be found by reason of being in the same directory with the .XLA file.</p>

<p>To get started, open the 'techniques_basic.xls' file in the samples directory.  You might need to restart Excel if it has trouble finding the add-in functions, such as RQuery.</p>   


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
