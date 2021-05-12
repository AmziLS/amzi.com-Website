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
        <h1>Amzi! Prolog User-Contributed Software</h1>
        <hr />
          <p><a href="/customers/introduction_intelligent_services.pdf">Introduction to Intelligent Web Services with Java/Tomcat</a>  with
          <a href="/distribution/amzi2_download.php?file=intelliservice_demo_package.zip">Source Code Demo</a> by Thomas Steiner</p>
          <p><a href="/distribution/amzi2_download.php?file=genealogy_csdotnet.zip">C# .NET Genealogy Web Application</a> by Deraldo Messner da Silva</p>
          <p><a href="/distribution/amzi2_download.php?file=englishmalay_vbdotnet.zip">VB .NET English to Malay Translator</a> by Yogeeta Ghanshamdas</p>
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
