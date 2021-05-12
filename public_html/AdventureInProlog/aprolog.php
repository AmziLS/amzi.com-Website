<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Adventure in Prolog tutorial</title>
<meta name="description" content="Tutorial explains Prolog concepts with text, diagrams and 
specialized diagrams for illustrating flow-of-control. Uses 
full program examples to lead you step-by-step 
through writing: an adventure game, an intelligent data-base, 
an expert system and an order entry program.">
<meta name="keywords" content="Prolog, Prolog language, Prolog tutorial,
Prolog programming, Prolog examples, free Prolog, Prolog interpreter, 
logic, logic programming, 
AI, artificial intelligence, rules, business rules, process rules, rule-based systems, 
expert systems,  
reasoning, inferencing, inference engines, intelligent software, 
sample code, source code, 
Amzi! Prolog, Amzi!, Amzi, Adventure in Prolog, Logic Explorer
">

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

        <div style="margin-right: 5px; float:right; width:430px">
        <p class="caption"><img src="/images/debugger_nanisrch.jpg" alt="Amzi! Prolog Source Code Debugger" />
        <br/>Amzi! Prolog Source Code Debugger</p>
        </div>

<div>

<H1 align="center">Prolog Tools</H1><hr />
<p>For either learning or deploying Prolog we recommend:</p>
<h3 align="center">
<a href="../AmziPrologLogicServer/index.php">Amzi! Prolog + Logic Server</a>
<br />
FREE (IDE only)
</h3>
<p>The Amzi! Prolog IDE, with it's source code debugger, is an excellent tool
for getting a solid understanding of Prolog's dynamic variable binding and built-in search.</p>



<P>The Amzi! Logic Server provides the tools for deploying Prolog with other development tools.</P>
<p>  The full Amzi! Prolog + Logic Server package is available on either:</P>
<ul>
<li>an individual basis or</li>
<li>an institutional site license.</li>
</ul>
<h3 align="center"><a href="/AmziPrologLogicServer/store.php">Download</a></h3>

</div>
<div style="clear:both"></div>
<div>

        <div style="margin-left: 5px; float:left; width:430px">
        <p class="caption">
        Amzi! Prolog IDE<br/><img src="/images/ide_nanisrch.jpg" alt="Amzi! Prolog IDE" /></p>
        </div>


<p>
<br />
<br />
<br />
</p>
<h3 align="center">Other resources for learning Prolog</h3>
<P>Checkout the numerous articles on Prolog:</P>
<h3 align="center"><a href="/articles/index.htm">Prolog Articles</a></h3>

<p>and the archives from the years when Amzi! was editor of the AI Expert magazine.  Many of the AI techniques are illustrated with Prolog code.</p>
<h3 align="center"><a href="http://www.ainewsletter.com">AI Newsletter</a></h3>
</div>



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
