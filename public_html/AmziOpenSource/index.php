<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Open Source</title>
<meta name="description" content="Amzi! Open Source Projects">

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
<div style="margin-left: 5px; float:right; background:#FFFFFF; border:double black thick; padding:5px;">
<h4 align="center">Sign-up for the<br />Amzi! Newsletter</h4>
<form action="http://amziinc.createsend.com/t/r/s/bhrthi/" method="post" id="subForm">
<table width="200" cellspacing="2" cellpadding="2">
  <tr>
    <td><label for="name">Name: </label></td>
    <td><input type="text" name="cm-name" id="name" /></td>
  </tr>
  <tr>
    <td><label for="bhrthi-bhrthi">Email: </label></td>
    <td><input type="text" name="cm-bhrthi-bhrthi" id="bhrthi-bhrthi" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Subscribe" /></td>
  </tr>
</table>
</form>
</div>
        <h1>Amzi! Open Source Projects</h1>
        <h3><a href="https://github.com/AmziLS" target="_blank">Source at GitHub/AmziLS</a></h3>
        <h3><a href="/index.php">Details on Projects</a></h3>
        <hr />
        <h2>Distribution</h2>
        <p>This repository contains the binary distributions for the projects.</p>
        <h2>Amzi! Prolog + Logic Server</h2>
        <p>This repository contains all the sources for rebuilding and maintaining Amzi! Prolog + Logic Server.
        <p>In addition to maintainance, thare are fun, relatively easy enhancements that can be made to the system. Amzi! uses a virtual machine architecture that is designed to be easily ported, and easily extended.  The engine is a C++ program that has run in literally a dozen computing environments.  The engine has a full C API that lets any external tools with a C interface connect to Amzi! and also implement extended predicates in that tool.</p>
        <ul>
        <li><b>Ports to other operating systems.</b>  All that's required is a C++ development environment for the platform, to build the Amzi! virtual machine (WAM) for that environment.  The Prolog code is all machine independent.  This work involves setting up the make files for that environment, and, maybe, if necessary, some changes to the internal module that works with environment specific I/O.  That last bit should not be necessary for ports to various Unix environments.</li>
        <li><b>Interfaces.</b> The Amzi! engine has a full C API included that is designed to make it easy to integrate Prolog with other software tools.  There are many that are supported, and are included, but these could be updated, and others could be added by following the templates of the existing interfaces.  These projects might either be language wrappers, such as for Java or .NET, or extensions.  Examples of extensions are the modules that implement extended predicates for allowing Prolog to access MySQL, ODBC, and TclTk.  These do not involve rebuilding any of the Amzi! core.</li>
        <ul>
        <li><b>Language Wrappers.</b> The C API has a rich set of functions for loading and querying Prolog code, and moving easily between the native language representation of variables and Prolog terms coming and going.  These C functions can be used to implement the same functions in other languages, using the native syntax of that language.  Some examples are the Java and .NET interfaces included with the system.</li>
        <li><b>Prolog Extensions.</b> The C API also has functions that support the creation of extended predicates in other languages.  These appear to the Prolog system as internal built-in predicates.  For example, the MySQL extended predicate library lets Prolog directly interact with MySQL databases using Prolog predicates that reflect the various MySQL functions.  The TclTk interface does the same for TclTk.</li>
        </ul>
        </ul>
        <p>The Amzi! Prolog + Logic Server project is composed of three sub-projects:</p>
        <ul>
        <li>APLS - The core system, engine, listener, compiler, runtime</li>
        <li>Interfaces - A project with subdirectories for various external interfaces, such as Java, .NET, MySql, TclTk...</li>
        <li>IDE - An Eclipse project for building the Eclipse plug-in for Amzi! Prolog, including the four-port graphical debugger.</li>
        </ul>
        <p>For details, see the devdocs directory in the apls project.</p>
        <h2>Prolog Course</h2>
        <p>Slides, exercises and sample code for a Prolog course taught by Amzi! in numerous commercial establishments.</p>
        <p>The courses were derived from the approach taken to teaching Prolog used in Adventure in Prolog. Over time the samples changed from an interactive fiction game to an airline reservation system. Somehow a boring business system seemed better than a fun game.</p>
        <p>And besides, the first company hiring me to teach Prolog was doing exactly that. Their system went on to be the basis of the scheduling software in a number of today's commercial airline sites, and as such was a great example of what can be done with Prolog.</p>
        <h2>ARulesXL</h2>
        <p>ARulesXL was supposed to be the the killer app for Amzi!  It easily allows executable business rules to be entered in spreadsheet cells, and for those rules to reason over data in some cells, and post results in others.  For example, a loan approval application might have all the rules for loans, which reason over the cells with client data, and then output to other cells the result and reason.</p>
        <p>It was inspired by a DoD research project to integrate reasoning with spreadsheets, and funded by a large accounting firm for building, successfully, a complex financial analysis application.  It was used to implement the best vaccination forecast/analysis system available for pediatric medical records software, allowing for all sorts of complex conditions like missing doses, late doses, interactions between vaccines, yet easily updateable by the medical experts directly in matters of minutes.</p>
        <p>Yet, despite many downloads, it never really took off.  I think the rule language needs another generation of refinement.  Maybe some of the logic programming control structures used in it are difficult for typical spreadsheet users to master.</p>
        <p>ARulesXL is a perfect example of the sort of application that can be built with Amzi! Prolog + Logic Server.  The rule language and reasoning engine are written in Prolog.  Prolog DCG provides a powerful tool for creating such a language. (It would not be difficult to create a totally different syntax/rule language and use it instead.)  Microsoft Visual Basic for Applications (VBA) is used to integrate the rule language with the spreadsheet.</p>
        <p>Give it a try and let us know what you think.  There are lots of samples that demonstrate what can be done with it.</p>
        <h2>EVA</h2>

<p>EVA is a tool for creating vaccination analysis and forecasting software. It has a complete framework that understands vaccines and all that's required to add/modify vaccination rules is to enter the specific information about a vaccine. It is designed to be maintained by people with pediatric knowledge, rather than programming knowledge.</p>

<p>The system is implemented using Amzi! ARulesXL software. All of the data and tables and rules are entered in spreadsheet cells. They can be developed and tested in the Excel environment, which supports a database of test cases that can be used for regression testing as rules change.</p>

<p>Once the knowledge is working as desired, the knowledge base can be exported into a format that can be easily integrated into any other application development environment, such as Java, .NET or Delphi.</p>

<p>EVA is the basis of the vaccination knowledge used in Office Practicum, pediatric software that consistently wins benchmark tests for having the best vaccination forecasting and analysis. This is because it can easily model missing schedules, complex interactions, and vaccine heirarchies.</p>






        <h2>KnowledgeWright</h2>
        <p>KnowledgeWright was one of my favorite Amzi! products.  It brought  together many of the features I felt made Prolog such a powerful tool  for knowledge engineering.  That is, Prolog is a fantastic language for  creating other languages and reasoning engines.</p>
        <p>There is discussion on the merits of domain specific languages.  The  advantage is you have a language for specifying knowledge that fits well  with the domain, making development and maintenance much easier.  The  down side is you have a specialized tool to maintain as well.</p>
        <p>With Prolog it is relatively easy to create domain specific  languages, so that the cost of doing so is much less than with other  tools.</p>
        <p>KnowledgeWright uses Prolog to create a framework for knowledge  engineering languages.  It includes a basic syntax for specifying  knowledge, and a reasoning engine for reasoning over that knowledge.   Both are highly customizable, and there are samples showing this.  A  customization is called a 'jig'.</p>
        <p>The naming of KnowledgeWright was part of it's appeal.  A 'wright' is  one who crafts things, like a wheel wright.  A jig is a specialized  tool for building a specific sort of thing.  So there can be jigs for  support applications, or sales, or whatever.</p>
        <p>For whatever reason, KnowledgeWright was never a huge commercial  success, but it continues to have users around the globe.  For those who  are interested in taking this tool further, or working with it more,  here it is.  If you have any questions about it, well it's been a long  time since this code was written, but feel free to ask.</p>
        <p>The current distribution of KnowledgeWright was developed on Windows, but the system is all Java and Prolog and not dependent on Windows.  The open source project could be easily modified to run on other platforms.</p>

        

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
