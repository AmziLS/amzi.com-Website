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
<td><h1>12</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Operators</H2>

<P>We have seen that the form of a Prolog data structure is </P>

<UL>
<PRE><FONT COLOR="#000080">functor(arg1,arg2,...,argN).</FONT></PRE>
</UL>

<P>This is the ONLY data structure in Prolog. However, Prolog allows for
other ways to syntactically represent the same data structure. These other
representations are sometimes called syntactic sugaring. The equivalence
between list syntax and the dot (.) functor is one example. Operator syntax
is another. </P>

<P>Chapter 6 introduced arithmetic operators<!AMZI_INDEX= Operators>. In
this chapter we will equate them to the standard Prolog data structures,
and learn how to define any functor to be an operator. </P>

<P>Each arithmetic operator is an ordinary Prolog functor<!AMZI_INDEX= Functors,as operators>,
such as -/2, +/2, and -/1. The display/1 predicate can be used to see the
standard syntax. </P>

<UL>
<PRE><FONT COLOR="#000080">?- display(2 + 2).<!AMZI_INDEX= display/1>
+(2,2)

?- display(3 * 4 + 6).
+(*(3,4),6)

?- display(3 * (4 + 6)).
*(3,+(4,6))</FONT></PRE>
</UL>

<P>You can define any functor to be an operator, in which case the Prolog
listener will be able to read the structure in a different format. For
example, if location/2 was an operator we could write </P>

<UL>
<PRE><FONT COLOR="#000080">apple location kitchen.</FONT></PRE>
</UL>

<P>instead of </P>

<UL>
<PRE><FONT COLOR="#000080">location(apple, kitchen).</FONT></PRE>
</UL>

<P>NOTE: The fact that location is an operator<!AMZI_INDEX= Unification, operators>
is of NO significance to Prolog's pattern matching. It simply means there
is an alternative way of writing the same term. </P>

<P>Operators are of three types. </P>

<DL>
<DL>
<DT>infix<!AMZI_INDEX= Operators, infix> </DT>

<DD>Example: 3 + 4 </DD>

<DT>prefix<!AMZI_INDEX= Operators, prefix> </DT>

<DD>Example: -7 </DD>

<DT>postfix<!AMZI_INDEX= Operators, postfix> </DT>

<DD>Example: 8 factorial </DD>
</DL>
</DL>

<P>They have a number representing precedence<!AMZI_INDEX= Precedence; Operators, precedence>
which runs from 1 to 1200. When a term with multiple operators is converted
to pure syntax, the operators with higher precedences are converted first.
A high precedence is indicated by a low number. </P>

<P>Operators are defined with the built-in predicate op/3<!AMZI_INDEX= op/3>,
whose three arguments are precedence, associativity, and the operator name.
</P>

<P>Associativity<!AMZI_INDEX= Associativity; Operators, associativity>
in the second argument is represented by a pattern that defines the type
of operator. The first example we will see is the definition of an infix
operator which uses the associativity pattern 'xfx.' The 'f' indicates
the position of the operator in respect to its arguments. We will see other
patterns as we proceed. </P>

<P>For our current purposes, we will again rework the location/2 predicate
and rename it is_in/2 to go with its new look, and we will represent rooms
in the structure room/1. </P>

<UL>
<PRE><FONT COLOR="#000080">is_in(apple, room(kitchen)).</FONT><!AMZI_INDEX= is_in/2 ></PRE>
</UL>

<P>We will now make is_in/2 an infix<!AMZI_INDEX= Operators, infix> operator
of arbitrary precedence 35. </P>

<UL>
<PRE><FONT COLOR="#000080">?- op(35,xfx,is_in).</FONT><!AMZI_INDEX= op/3></PRE>
</UL>

<P>Now we can ask </P>

<UL>
<PRE><FONT COLOR="#000080">?- apple is_in X.
X = room(kitchen)</FONT></PRE>
</UL>

<P>or </P>

<UL>
<PRE><FONT COLOR="#000080">?- X is_in room(kitchen).
X = apple</FONT></PRE>
</UL>

<P>We can add facts to the program in operator syntax. </P>

<UL>
<PRE><FONT COLOR="#000080">banana is_in room(kitchen).</FONT></PRE>
</UL>

<P>To verify that Prolog treats both syntaxes the same we can attempt to
unify them. </P>

<UL>
<PRE><FONT COLOR="#000080">?- is_in(banana, room(kitchen)) = banana is_in room(kitchen).
yes</FONT></PRE>
</UL>

<P>And we can use display/1 to look at the new syntax. </P>

<UL>
<PRE><FONT COLOR="#000080">?- display(banana is_in room(kitchen)).
is_in(banana, room(kitchen))</FONT></PRE>
</UL>

<P>Let's now make room/1 a prefix<!AMZI_INDEX= Operators, prefix> operator.
Note that in this case the associativity pattern fx is used to indicate
the functor comes before the argument. Also we chose a precedence (33)
higher (higher precedence has lower number) than that used for is_in (35)
in order to nest the room structure inside the is_in structure. </P>

<UL>
<PRE><FONT COLOR="#000080">?- op(33,fx,room).</FONT></PRE>
</UL>

<P>Now room/1 is displayed in operator syntax. </P>

<UL>
<PRE><FONT COLOR="#000080">?- room kitchen = room(kitchen).
yes

?- apple is_in X.
X = room kitchen\</FONT></PRE>
</UL>

<P>The operator syntax can be used to add facts to the program. </P>

<UL>
<PRE><FONT COLOR="#000080">pear is_in room kitchen.

?- is_in(pear, room(kitchen)) = pear is_in room kitchen.
yes

?- display(pear is_in room kitchen).
is_in(pear, room(kitchen))</FONT></PRE>
</UL>

<P>CAUTION: If you mix up the precedence (easy to do) you will get strange
bugs. If room/1 had a lower precedence<!AMZI_INDEX= Precedence, problems with>
(higher number) than is_in/2, then the structure would be </P>

<UL>
<PRE><FONT COLOR="#000080">room(is_in(apple, kitchen))</FONT></PRE>
</UL>

<P>Not only doesn't this capture the information as intended, it also will
not unify the way we want. </P>

<P>For completeness, an example of a candidate for a postfix<!AMZI_INDEX= Operators, postfix >
operator would be turned_on. Again note that the 'xf' pattern says that
the functor comes after the argument. </P>

<UL>
<PRE><FONT COLOR="#000080">?- op(33,xf,turned_on).</FONT></PRE>
</UL>

<P>We can now say </P>

<UL>
<PRE><FONT COLOR="#000080">flashlight turned_on.</FONT></PRE>
</UL>

<P>and </P>

<UL>
<PRE><FONT COLOR="#000080">?- turned_on(flashlight) = flashlight turned_on.
yes</FONT></PRE>
</UL>

<P>Operators are useful for making more readable data structures in a program
and for making quick and easy user interfaces. </P>

<P>In our command-driven Nani Search, we use a simple natural language
front end, which will be described in the last chapter. We could have alternatively
made the commands operators so that </P>

<DL>
<DL>
<DT>goto(kitchen) </DT>

<DD>becomes goto kitchen. </DD>

<DT>turn_on(flashlight) </DT>

<DD>becomes turn_on flashlight. </DD>

<DT>take(apple) </DT>

<DD>becomes take apple. </DD>
</DL>
</DL>

<P>It's not natural language, but it's a lot better than parentheses and
commas. </P>

<P>We have seen how the precedence<!AMZI_INDEX= Operators, precedence>
of operators affects their translation into structures. When operators
are of equal precedence, the Prolog reader must decide whether to work
from left to right, or right to left. This is the difference between right
and left associativity. </P>

<P>An operator can also be non-associative<!AMZI_INDEX= Operators, nonassociative>,
which means an error is generated if you try to string two together. </P>

<P>The same pattern used for precedence is used for associativity with
the additional character y. The options are </P>

<DL>
<DL>
<DT>Infix: </DT>

<DD>xfx non-associative</DD>

<DD>xfy right to left</DD>

<DD>yfx left to right </DD>

<DT>Prefix </DT>

<DD>fx non-associative</DD>

<DD>fy left to right </DD>

<DT>Postfix: </DT>

<DD>xf non-associative</DD>

<DD>yf right to left </DD>
</DL>
</DL>

<P>The is_in/2 predicate is currently non-associative so this gets an error.
</P>

<UL>
<PRE><FONT COLOR="#000080">key is_in desk is_in office.</FONT></PRE>
</UL>

<P>To represent nesting, we would want this to be evaluated from right
to left. </P>

<UL>
<PRE><FONT COLOR="#000080">?- op(35,xfy,is_in).
yes

?- display(key is_in desk is_in office).
is_in(key, is_in(desk, office))</FONT></PRE>
</UL>

<P>If we set it left to right the arguments would be different. </P>

<UL>
<PRE><FONT COLOR="#000080">?- op(35,yfx,is_in).
yes

?- display(key is_in desk is_in office).
is_in(is_in(key, desk), office)</FONT></PRE>
</UL>

<P>We can override operator associativity<!AMZI_INDEX= Associativity, overriding>
and precedence<!AMZI_INDEX= Precedence, overriding> with parentheses. Thus
we can get our left to right is_in to behave right to left like so. </P>

<UL>
<PRE><FONT COLOR="#000080">?- display(key is_in (desk is_in office)).
is_in(key, is_in(desk, office))</FONT></PRE>
</UL>

<P>Many built-in predicates<!AMZI_INDEX= Built-in predicates, as operators>
are actually defined as infix operators. That means that rather than following
the standard predicate(arg1,arg2) format, the predicate can appear between
the arguments as </P>

<UL>
<PRE><FONT COLOR="#000080">arg1 predicate arg2.</FONT></PRE>
</UL>

<P>The arithmetic operators we have seen already illustrate this. For example
+, -, *, and / are used as you would expect. However, it is important to
understand that these arithmetic structures are just structures like any
others, and do not imply arithmetic evaluation. 3 + 4 is not the same as
7 any more than plus(3,4) is or likes(3,4). It is just +(3,4). </P>

<P>Only special built-in predicates, like is/2, actually perform an arithmetic
evaluation of an arithmetic expression. As we have seen, is/2 causes the
right side to be evaluated and the left side is unified with the evaluated
result. </P>

<P>This is in contrast to the unification (=) predicate, which just unifies
terms without evaluating them. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X is 3 + 4.
X = 7

?- X = 3 + 4.
X = 3 + 4

?- 10 is 5 * 2.
yes

?- 10 = 5 * 2.
no</FONT></PRE>
</UL>

<P>Arithmetic expressions can be as arbitrarily complex as other structures.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- X is 3 * 4 + (6 / 2).
X = 15</FONT></PRE>
</UL>

<P>Even if they are not evaluated. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X = 3 * 4 + (6 / 2).
X = 3 * 4 + (6 / 2)</FONT></PRE>
</UL>

<P>The operator predicates can also be written in standard notation. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X is +(*(3,4) , /(6,2)).
X = 15

?- 3 * 4 + (6 / 2) = +(*(3,4),/(6,2)).
yes</FONT></PRE>
</UL>

<P>To underscore that these arithmetic operators are really ordinary predicates
with no special meaning unless being evaluated by is/2<!AMZI_INDEX= is/2>,
consider </P>

<UL>
<PRE><FONT COLOR="#000080">?- X = 3 * 4 + likes(john, 6/2).
X = 3 * 4 + likes(john, 6/2).

?- X is 3 * 4 + likes(john, 6/2).
error</FONT></PRE>
</UL>

<P>We have seen that Prolog programs are composed of clauses. These clauses
are simply Prolog data structures written with operator syntax. The functor
is the neck<!AMZI_INDEX= Neck symbol > (:-) which is defined as an infix
operator. There are two arguments. </P>

<UL>
<PRE><FONT COLOR="#000080">:-(Head, Body).</FONT></PRE>
</UL>

<P>The body is a data structure with the functor<!AMZI_INDEX= Functors>
'and' represented by a comma (,). The body looks like </P>

<UL>
<PRE><FONT COLOR="#000080">,(goal1, ,(goal2,,goal3))</FONT></PRE>
</UL>

<P>Note the ambiguous use of the comma (,) as a conjunctive operator and
as a separator of arguments in a Prolog structure. This can cause confusion
in Prolog programs that manipulate Prolog clauses. It might have been clearer
if an ampersand (&amp;) was used instead of a comma for separating goals.
Then the above pattern would be </P>

<UL>
<PRE><FONT COLOR="#000080">&amp;(goal1, &amp;(goal2, &amp; goal3))</FONT></PRE>
</UL>

<P>and the following would be equivalent. </P>

<UL>
<PRE><FONT COLOR="#000080">head :- goal1 &amp; goal2 &amp; goal3.
:-(head, &amp;(goal1, &amp;(goal2, &amp; goal3))).</FONT></PRE>
</UL>

<P>But that is not how it was done, so the two forms are </P>

<UL>
<PRE><FONT COLOR="#000080">head :- goal1 , goal2 , goal3.
:-(head, ,(goal1, ,(goal2, , goal3))).</FONT></PRE>
</UL>

<P>Every other comma has a different meaning. </P>

<P>The arithmetic operators are often used by Prolog programmers to syntactically
join related terms. For example, the write/1 predicate takes only one argument,
but operators give an easy way around this restriction. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X = one, Y = two, write(X-Y).
one - two </FONT></PRE>
</UL>

<P>The slash (/) can be used the same way. In addition, some Prologs define
the colon (:) as an operator just for this purpose. It can improve readability
by removing some parentheses. For example, the complex structures for defining
things in the game can be syntactically represented with the colon as well.
</P>

<UL>
<PRE><FONT COLOR="#000080">object(apple, size:small, color:red, weight:1).</FONT></PRE>
</UL>

<P>A query looking for small things would be expressed </P>

<UL>
<PRE><FONT COLOR="#000080">?- object(X, size:small, color:C, weight:W).
X = apple
C = red
W = 1 </FONT></PRE>
</UL>

<P>The pattern matching is the same as always, but instead of size(small)
we use the pattern size:small, which is really :(size,small). </P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Adventure Game</H4>

<P>1- Define all of the Nani Search commands as operators so the current
version of the game can be played without parentheses or commas. </P>

<H4>Genealogical Logicbase</H4>

<P>2- Define the various relationships in the genealogical logicbase as
operators. </P>



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
