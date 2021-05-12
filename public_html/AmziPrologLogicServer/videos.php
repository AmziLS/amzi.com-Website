<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Tutorial Videos</title>
<meta name="description" content="Videos of the Amzi! Eclipse development environment.">

<meta name="keywords" content="Amzi!, Amzi! Prolog, Eclipse plug-in, Prolog IDE, ">

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
      <h2 align="left">Amzi! Tutorial Videos</h2>
      <p align="left"><a href="/videos/eclipse_first_use/eclipse_first_use.html">Getting Started in Eclipse</a> - A first look at work flow in Eclipse, how to create a project, a prolog file in that project, how to run it in the listener, edit and save it.</p>
      <p align="left"><a href="/videos/eclipse_project_debug/Eclipse_project_debug.html">Projects and Debugging in Eclipse</a> - A look at a multi-file project, using the predicate index, cross reference, and source code debugger.</p>        <!--end content-->
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
