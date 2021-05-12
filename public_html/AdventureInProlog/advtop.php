<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Adventure in Prolog Tutorial
</title>
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

<table style="width:100%;"><tr>
<td><h1>Adventure in Prolog</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>

<HR>

<H2>Contents</H2>
<div style="margin-left:20px">
<TABLE "BORDER=0 CELLSPACING=0 CELLPADDING=0 >
<TR VALIGN=TOP>

<TD VALIGN=TOP>
      <DL> 
        <DT><A HREF="apreface.php"> Preface</A></DT>
        <DD> </DD>
        <DT>
          <P><A HREF="aprolog.php"> Prolog Tools</A>
        </DT>
        <DT> 
          <P><A HREF="a1start.php">1 Getting Started</A>
        </DT>
        <DD><A HREF="a1start.php#JumpingIn">Jumping In</A></DD>
        <DD><A HREF="a1start.php#LogicProgramming">Logic Programming</A></DD>
        <DD><A HREF="a1start.php#Jargon">Jargon</A></DD>
        <DT>
          <P><A HREF="a2facts.php"> 2 Facts</A>
        </DT>
        <DD><A HREF="a2facts.php#NaniSearch">Nani Search</A></DD>
        <DD><A HREF="a2facts.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a3simple.php"> 3 Simple Queries</A>
        </DT>
        <DD><A HREF="a3simple.php#HowQueriesWork">How Queries Work</A></DD>
        <DD><A HREF="a3simple.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a4comqry.php"> 4 Compound Queries</A>
        </DT>
        <DD><A HREF="a4comqry.php#BuiltinPredicates"> Built-in Predicates</A></DD>
        <DD><A HREF="a4comqry.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a5rules.php"> 5 Rules</A>
        </DT>
        <DD><A HREF="a5rules.php#HowRulesWork">How Rules Work</A></DD>
        <DD><A HREF="a5rules.php#UsingRules">Using Rules</A></DD>
        <DD><A HREF="a5rules.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a6arith.php"> 6 Arithmetic</A>
        </DT>
        <DD><A HREF="a6arith.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a7manage.php"> 7 Managing Data</A>
        </DT>
        <DD><A HREF="a7manage.php#Exercises">Exercises</A></DD>
        <DT>
          <P><A HREF="a8recurs.php"> 8 Recursion</A>
        </DT>
        <DD><A HREF="a8recurs.php#HowRecursionWorks">How Recursion Works</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>
        <DD><A HREF="a8recurs.php#Pragmatics">Pragmatics</A></DD>
        <DD><A HREF="a8recurs.php#Exercises">Exercises</A></DD>
      </DL>
</TD>

<TD VALIGN=TOP>
<DL>
<DT><A HREF="a9struct.php"> 9 Data Structures</A></DT>

<DD><A HREF="a9struct.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a10unif.php"> 10 Unification</A></DT>

<DD><A HREF="a10unif.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a11lists.php"> 11 Lists</A></DT>

<DD><A HREF="a11lists.php#UsingTheListUtilities">Using the List Utilities</A></DD>
<DD><A HREF="a11lists.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a12oper.php"> 12 Operators</A></DT>

<DD><A HREF="a12oper.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a13cut.php"> 13 Cut</A></DT>

<DD><A HREF="a13cut.php#UsingTheCut">Using the Cut</A></DD>
<DD><A HREF="a13cut.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a14cntrl.php"> 14 Control Structures</A></DT>

<DD><A HREF="a14cntrl.php#RecursiveControlLoop">Recursive Control Loop</A></DD>
<DD><A HREF="a14cntrl.php#TailRecursion">Tail Recursion</A></DD>
<DD><A HREF="a14cntrl.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="a15nlang.php"> 15 Natural Language</A></DT>

<DD><A HREF="a15nlang.php#DifferenceLists">Difference Lists</A></DD>
<DD><A HREF="a15nlang.php#NaturalLanguageFrontEnd">Natural Language Front End</A></DD>
<DD><A HREF="a15nlang.php#DefiniteClauseGrammar">Definite Clause Grammar</A></DD>
<DD><A HREF="a15nlang.php#ReadingSentences">Reading Sentences</A></DD>
<DD><A HREF="a15nlang.php#Exercises">Exercises</A></DD>

<DT><P><A HREF="appendix.php"> Appendix</A></DT>

<DD><A HREF="appendix.php#NaniSearch">Nani Search</A></DD>
<DD><A HREF="appendix.php#Family">Family</A></DD>
<DD><A HREF="appendix.php#Custord">Custord</A></DD>
<DD><A HREF="appendix.php#Birds">Birds</A></DD>

<DT><P><A HREF="advidx.php">Index </A></DT>
</DL>
</TD>
</TR>
</TABLE>

<UL></UL>


<P>

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
