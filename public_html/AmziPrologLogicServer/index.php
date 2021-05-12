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
      

        <h1>Amzi! Prolog + Logic Server<span class="style1">&#8482;</span></h1>
        <hr />
      <p>Amzi! Prolog + Logic Server is an embeddable, extendable, portable implementation of ISO standard Prolog, with a full professional interactive development environment (IDE) implemented as an Eclipse plug-in.</p>
        <p>This makes Amzi! an ideal choice for either students learning  Prolog, or for individuals and organizations interested in developing and deploying knowledge-based applications.</p>
      <p>See <a href="white_papers/amzi_overview.php">overview</a> for a detailed description of the full product.</p>
        <p><a href="store.php">Download and purchase</a></p>
      <h2>Architecture</h2>
        <p>Amzi! Prolog + Logic Server uses a virtual machine architecture similar to that of Java. Prolog code can be either interpreted or compiled. Both the interpreted source code and the compiled binary code are machine independent and just require an Amzi! virtual machine to run on any supported platform.</p>
      <p>The Amzi! virtual machine is written in  C++  and has been ported to numerous different environments. A runtime port simply requires recompiling the C++ code for the new target machine.</p>
        <h2>Logic Server API</h2>
        <p>The Amzi! Logic Server API (LSAPI) is a  full application program interface (API) allowing for the integration of Prolog with a host language development environment. The core LSAPI is a collection of C functions that access the Prolog virtual machine. Amzi! provides a number of wrappers for other languages, including C++, Java, Delphi, VB and .NET.</p>
        <p>The LSAPI enables the host language to query Prolog logic bases, and also allows Prolog to call extended predicates implemented in the host language. So, the host language can call Prolog for it's reasoning capabilities, and the Prolog code can reason over information taken directly from the host language.</p>
      <h2>Eclipse IDE</h2>
      <p>The Amzi! plug-in for Eclipse lets the Prolog developer have all of the power of Eclipse project management and editing customized for the unique pattern-matching and search execution of Prolog. The cross reference and index for files is based on the fundamental Prolog code unit of a predicate, and the debugger displays the call stack, variable bindings and backtracking search execution of Prolog color-coded and tied directly to the source code.</p>
      <p>This totally transparent display of Prolog execution makes it much easier for students to master the language.</p>
      <p>The Eclipse support for remote and compiled code debugging provides powerful tools for developing commercial grade applications.</p>
      <p>The Amzi! plug-in comes either packaged with a full version of Eclipse for developing Prolog applications, or it can be used as a plug-in for an existing Eclipse installation enabling the development of multi-language applications, integrating say Java, or the Eclipse Modelling Foundation with Prolog.
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
