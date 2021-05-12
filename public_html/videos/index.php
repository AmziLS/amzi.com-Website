<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Adventure in Prolog</title>
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
    require $_SERVER['DOCUMENT_ROOT'] . "/sidebar.php";
    ?>
    <!--End Side Navigation-->

    <div id="beef">
    
        <!--Start content-->
        <h1>Video Training Materials</h1>
        <hr />

<HR />

      <p align="left"><a href="eclipse_first_use/eclipse_first_use.html">Getting Started in Eclipse</a> - A first look at work flow in Eclipse, how to create a project, a prolog file in that project, how to run it in the listener, edit and save it.</p>
      <p align="left"><a href="eclipse_project_debug/Eclipse_project_debug.html">Projects and Debugging in Eclipse</a> - A look at a multifile project, the predicate index and cross reference, and using the source code debugger.</p>
      <p align="left"><a href="eva_india_01/eva_india_01.html">EVA Electronic Vaccination Analysis, India 01</a> - EVA is an application built on ARulesXL (which is built on Amzi! Prolog + Logic Server) for the development, testing and deployment of vaccination knowledge. This video introduces EVA with a very simple knowledge base of one vaccine that has only one dose given at birth.</p>
      <p align="left"><a href="eva_india_02/eva_india_02.html">EVA Electronic Vaccination Analysis, India 02</a> - Building on the previous video, this video demonstrates how EVA can be used to implement the vaccination guidelines as specified by the Indian Academy of Pediatrics.</p>
  <!--end content-->
</P>
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
