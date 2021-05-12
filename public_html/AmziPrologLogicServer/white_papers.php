<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. White Papers</title>
<meta name="description" content="Amzi! inc. white papers providing overviews of Amzi! technology,
logic programming, rule-based technology and domain specific languages.">

<meta name="keywords" content="Amzi, Amzi! Prolog, logic programming, rule engines, artificial intelligence,
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
        <h1>Amzi! White Papers</h1>
        <hr />
        <h3><a href="white_papers/amzi_overview.php">Amzi! Prolog + Logic Server Overview</a></h3>
        <p>Details on the Amzi! architecture with examples
        showing how the Amzi! Logic Server is used to integrate Amzi! Prolog with conventional
        programming languages.</p>
        <h3><a href="white_papers/prolog_whitepaper.php">Rules and Prolog and Amzi!</a></h3>
        <p>Rules and how they related to application logic and
        how Prolog makes it easy to implement rule-based applications.</p>
        <h3><a href="white_papers/logical_knowledge.php">Logical Knowledge Overview</a></h3>
        <p>A discussion of the relationship between procedural, factual,
        and logical knowledge, and how virtual machines have been the key to implementing logical
        knowledge applications.</p>
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
