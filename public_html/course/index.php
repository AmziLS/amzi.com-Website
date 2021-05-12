<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Prolog + Logic Server</title>
<meta name="description" content="Amzi! Prolog + Logic Server is an embeddable, extendable, highly portable implementation of ISO prolog with a professional IDE based on Eclipse.">

<meta name="keywords" content="Amzi! Prolog, prolog, learn prolog, logic programming, Eclipse, rule engines, artificial intelligence,
domain specific language, logic server, embeddable, extendable, knowledge engineering">

<meta name="author" content="Amzi! inc." />

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/header_links.php';
require $_SERVER['DOCUMENT_ROOT'] . '/google.php';
?>

<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
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
        

      <h2>Amzi! Prolog Course Materials  Beijing 2012</h2>
        <hr />
        
        <p>The course will be using the Win32 9-5-6 distribution of Amzi! Prolog + Logic Server which can be downloaded from the <a href="/AmziPrologLogicServer/store.php">download page</a>.</p>
        <p>Use the video link in the main menu bar above to see some videos for getting started with the Eclipse IDE used with Amzi! Prolog.</p>
        
        <p>The course notes, samples, slides are at:</p>
        
      <p><a href="/distribution/amzi2_download.php?file=amzi_prolog_course.zip">
   	  Beijing course materials</a></p>
        
      <p>

        <!--end content-->
    </p>
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
