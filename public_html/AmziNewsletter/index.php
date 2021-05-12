<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! News</title>
<meta name="description" content="Amzi! inc. newsletter providing articles on Prolog, logic programming and it's applications.">

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
        <h1>Amzi! Newsletter</h1>
        <hr />

<h3>The Amzi! Newsletter contains periodic articles about Prolog programming, expert systems and AI, as well as product news and information.</h3>

<p><a href="amzinews_2012-03-29.html">2012-03-29</a> -- Mac 64-bit OS X version now available, Linux runtimes available and new faster downloads.</p>
<p><a href="amzinews_2012-01-20.html">2012-01-20</a> -- 64-Bit Windows version now available.</p>
<p><a href="amzinews_2011-11-02.html">2011-11-02</a> -- New 9-5-2 release.  Reintroducing the retro Amzi! IDE.  UTF-8 support makes it easy to deploy national language applications.</p>
<p><a href="amzinews_2011-01-20.html">2011-01-20</a> -- The reasoning engine for the decision tree domain specific language (DSL), and notes on Amzi! consulting, training, legacy code support and source code services.</p>
<p><a href="amzinews_2010-12-12.html">2010-12-12</a> -- Knowledge representation for a bank's decision tree application, forum notes on representing chess moves.</p>
<p><a href="amzinews_2010-11-07.html">2010-11-07</a> -- Introduction to domain specific languages (DSL), and new Amzi! products and pricing.</p>


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
