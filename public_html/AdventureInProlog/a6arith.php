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


<table style="width:100%;"><tr>
<td><h1>6</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Arithmetic</H2>

<P>Prolog must be able to handle arithmetic in order to be a useful general
purpose programming language. However, arithmetic does not fit nicely into
the logical scheme of things. </P>

<P>That is, the concept of evaluating an arithmetic expression is in contrast
to the straight pattern matching we have seen so far. For this reason,
Prolog provides the built-in predicate 'is' that evaluates arithmetic expressions.
Its syntax calls for the use of operators, which will be described in more
detail in chapter 12. </P>

<UL>
<PRE><FONT COLOR="#000080">X is &lt;arithmetic expression&gt;</FONT></PRE>
</UL>

<P>The variable X is set to the value of the arithmetic<!AMZI_INDEX=Arithmetic, affect on backtracking>
expression. On backtracking it is unassigned. </P>

<P>The arithmetic expression<!AMZI_INDEX= Arithmetic, expressions> looks
like an arithmetic expression in any other programming language. </P>

<P>Here is how to use Prolog as a calculator. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X is 2 + 2.<!AMZI_INDEX= is/2
>
X = 4

?- X is 3 * 4 + 2.
X = 14</FONT></PRE>
</UL>

<P>Parentheses clarify precedence. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X is 3 * (4 + 2).
X = 18

?- X is (8 / 4) / 2.
X = 1</FONT></PRE>
</UL>

<P>In addition to 'is,' Prolog provides a number of operators<!AMZI_INDEX= Operators; Arithmetic, operators>
that compare two numbers. These include 'greater than', 'less than', 'greater
or equal than', and 'less or equal than.' They behave more logically, and
succeed or fail according to whether the comparison is true or false. Notice
the order of the symbols in the greater or equal than and less than or
equal operators. They are specifically constructed not to look like an
arrow, so that you can use arrow symbols in your programs without confusion.
</P>

<UL>
<PRE><FONT COLOR="#000080">X &gt; Y
X &lt; Y
X &gt;= Y
X =&lt; Y</FONT></PRE>
</UL>

<P>Here are a few examples of their use. </P>

<UL>
<PRE><FONT COLOR="#000080">?- 4 &gt; 3.
yes

?- 4 &lt; 3.
no

?- X is 2 + 2, X &gt; 3.
X = 4

?- X is 2 + 2, 3 &gt;= X.
no

?- 3+4 &gt; 3*2.
yes</FONT></PRE>
</UL>

<P>They can be used in rules as well. Here are two example predicates.
One converts centigrade temperatures to Fahrenheit, the other checks if
a temperature is below freezing. </P>

<UL>
<PRE><FONT COLOR="#000080">c_to_f(C,F) :-
  F is C * 9 / 5 + 32.

freezing(F) :-
  F =&lt; 32.</FONT></PRE>
</UL>

<P>Here are some examples of their use. </P>

<UL>
<PRE><FONT COLOR="#000080">?- c_to_f(100,X).
X = 212
yes

?- freezing(15).
yes

?- freezing(45).
no</FONT></PRE>
</UL>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Customer Order Entry</H4>

<P>1- Write a predicate valid_order/3 that checks whether a customer order
is valid. The arguments should be customer, item, and quantity. The predicate
should succeed only if the customer is a valid customer with a good credit
rating, the item is in stock, and the quantity ordered is less than the
quantity in stock. </P>

<P>2- Write a reorder/1 predicate which checks inventory levels in the
inventory record against the reorder quantity in the item record. It should
write a message indicating whether or not it's time to reorder. </P>

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
