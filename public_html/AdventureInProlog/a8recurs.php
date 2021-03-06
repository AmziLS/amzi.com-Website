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
<td><h1>8</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Recursion</H2>

<P>Recursion in any language is the ability for a unit of code to call
itself, repeatedly, if necessary. Recursion<!AMZI_INDEX= Recursion> is
often a very powerful and convenient way of representing certain programming
constructs. </P>

<P>In Prolog, recursion occurs when a predicate contains a goal that refers
to itself. </P>

<P>As we have seen in earlier chapters, every time a rule is called, Prolog
uses the body of the rule to create a new query with new variables. Since
the query is a new copy each time, it makes no difference whether a rule
calls another rule or itself. </P>

<P>A recursive definition (in any language, not just Prolog) always has
at least two parts, a boundary condition and a recursive case. </P>

<P>The boundary condition<!AMZI_INDEX= Boundary, condition> defines a simple
case that we know to be true. The recursive case<!AMZI_INDEX=  Recursive case>
simplifies the problem by first removing a layer of complexity, and then
calling itself. At each level, the boundary condition is checked. If it
is reached the recursion ends. If not, the recursion continues. </P>

<P>We will illustrate recursion by writing a predicate that can detect
things which are nested within other things. </P>

<P>Currently our location/2 predicate tells us the flashlight is in the
desk and the desk is in the office, but it does not indicate that the flashlight
is in the office. </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(flashlight, office).
no</FONT></PRE>
</UL>

<P>Using recursion, we will write a new predicate, is_contained_in/2, which
will dig through layers of nested things, so that it will answer 'yes'
if asked if the flashlight is in the office. </P>

<P>To make the problem more interesting, we will first add some more nested
items to the game. We will continue to use the location predicate to put
things in the desk, which in turn can have other things inside them. </P>

<UL>
<PRE><FONT COLOR="#000080">location(envelope, desk).<!AMZI_INDEX=  location/2
>
location(stamp, envelope).
location(key, envelope).</FONT></PRE>
</UL>

<P>To list all of things in the office, we would first have to list those
things that are directly in the office, like the desk. We would then list
the things in the desk, and the things inside the things in the desk. </P>

<P>If we generalize a room into being just another thing, we can state
a two-part rule which can be used to deduce whether something is contained
in (nested in) something else. </P>

<UL>
<LI>A thing, T1, is contained in another thing, T2, if T1 is directly located
in T2. (This is the boundary condition.) </LI>

<LI>A thing, T1, is contained in another thing, T2, if some intermediate
thing, X, is located in T2 and T1 is contained in X. (This is where we
simplify and recurse.) </LI>
</UL>

<P>We will now express this in Prolog. The first rule translates into Prolog
in a straightforward manner. </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(T1,T2) :-<!AMZI_INDEX= is_contained_in/2
>  
  location(T1,T2).</FONT></PRE>
</UL>

<P>The recursive rule is also straightforward. Notice that it refers to
itself. </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(T1,T2) :-
  location(X,T2),
  is_contained_in(T1,X).</FONT></PRE>
</UL>

<P>Now we are ready to try it. </P>

<UL>
<PRE><FONT COLOR="#000080">?- is_contained_in(X, office).
X = desk ;
X = computer ;
X = flashlight ;
X = envelope ;
X = stamp ;
X = key ;
no

?- is_contained_in(envelope, office).
yes

?- is_contained_in(apple, office).
no</FONT></PRE>
</UL>

<H3><A NAME="HowRecursionWorks"></A>How Recursion
Works</H3>

<P>As in all calls to rules, the variables<!AMZI_INDEX= Variables, scope>
in a rule are unique, or scoped, to the rule. In the recursive case, this
means each call to the rule, at each level, has its own unique set of variables.
So the values of X, T1, and T2 at the first level of recursion are different
from those at the second level. </P>

<P>However, unification<!AMZI_INDEX= Unification, during recursion> between
a goal and the head of a clause forces a relationship between the variables
of different levels. Using subscripts to distinguish the variables, and
internal Prolog variables, we can trace the relationships for a couple
of levels of recursion. </P>

<P>First, the query goal is </P>

<UL>
<PRE><FONT COLOR="#000080">?- is_contained_in(XQ, office).</FONT></PRE>
</UL>

<P>The clause with variables for the first level of recursion is </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(T11, T21) :-
  location(X1, T21),
  is_contained_in(T11, X1).</FONT></PRE>
</UL>

<P>When the query is unified with the head of the clause, the variables
become bound. The bindings are </P>

<UL>
<PRE><FONT COLOR="#000080">XQ = _01
T11 = _01
T21 = office
X1 = _02</FONT></PRE>
</UL>

<P>Note particularly that XQ in the query becomes bound to T11 in the clause,
so when a value of _01 is found, both variables are found. </P>

<P>With these bindings, the clause can be rewritten as </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(_01, office) :-
  location(_02, office),
  is_contained_in(_01, _02).</FONT></PRE>
</UL>

<P>When the location/2 goal is satisfied, with _02 = desk, the recursive
call becomes </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(_01, desk)</FONT><!AMZI_INDEX=  is_contained_in/2></PRE>
</UL>

<P>That goal unifies with the head of a new copy of the clause, at the
next level of the recursion. After that unification the variables are </P>

<UL>
<PRE><FONT COLOR="#000080">XQ = _01        T11 = _01       T12 = _01
                T21 = office    T22 = desk
                X1 = desk       X2 = _03</FONT></PRE>
</UL>

<P>When the recursion finds a solution, such as 'envelope,' all of the
T1s and X0 immediately take on that value. Figure 8.1 contains a full annotated
trace of the query.<!AMZI_INDEX= Recursion, example, trace of></P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- is_contained_in(X, office).</FONT></PRE>

<P>Each level of the recursion will have its own unique variables, but
as in all calls to rules, the variables at a called level will be bound
in some relationship to the variables at the calling level. In the following
trace, we will use Prolog internal variables, so we can see which variables
are bound together and which are not. The items directly in the office
are found easily, as the variable _0 is bound to X in the query and T1
in the rule.</P>

<PRE><FONT COLOR="#000080">1-1 CALL is_contained_in(_0, office) 
1-1 try (1) is_contained_in(_0, office)
    2-1 CALL location(_0, office) 
    2-1 EXIT location(desk, office) 
1-1 EXIT is_contained_in(desk, office) 
      X = desk ;
    2-1 REDO location(_0, office) 
    2-1 EXIT location(computer, office) 
1-1 EXIT is_contained_in(computer, office) 
      X = computer ;
    2-1 REDO location(_0,office) 
    2-1 FAIL location(_0,office) </FONT></PRE>

<P>When there are no more location(X, office) clauses, the first clause
of is_contained_in/2 fails, and the second clause is tried. Notice that
the call to location does not have its first argument bound to the same
variable. It was X in the rule, and it gets a new internal value, _4. T1
stays bound to _0.</P>

<PRE><FONT COLOR="#000080">1-1 REDO is_contained_in(_0, office) 
1-1 try (2) is_contained_in(_0, office)
    2-1 CALL location(_4, office) 
    2-1 EXIT location(desk, office) </FONT></PRE>

<P>When it initiates a new call to is_contained_in/2, it behaves exactly
as if we had performed the query is_contained_in(X, desk) at the listener
prompt. It is, in effect, a completely new copy of is_contained_in/2. This
call will find all of the things in the desk, just as the first level found
all things in the office.</P>

<PRE><FONT COLOR="#000080">    2-2 CALL is_contained_in(_0, desk) 
    2-2 try (1) is_contained_in(_0, desk)
        3-1 CALL location(_0, desk) 
        3-1 EXIT location(flashlight, desk) </FONT></PRE>

<P>Having found the flashlight at the second-level is_contained_in/2, the
answer propagates back up to the first level copy of is_contained_in/2.</P>

<PRE><FONT COLOR="#000080">    2-2 EXIT is_contained_in(flashlight, desk) 
1-1 EXIT is_contained_in(flashlight, office) 
      X = flashlight ;</FONT></PRE>

<P>Similarly, it finds the envelope at the second level of recursion.</P>

<PRE><FONT COLOR="#000080">        3-1 REDO location(_0, desk) 
        3-1 EXIT location(envelope, desk) 
    2-2 EXIT is_contained_in(envelope, desk) 
1-1 EXIT is_contained_in(envelope, office) 
      X = envelope ;</FONT></PRE>

<P>Having exhausted the things located in the desk, it next begins to look
for things within things located in the desk.</P>

<PRE><FONT COLOR="#000080">        3-1 REDO location(_0, desk) 
        3-1 FAIL location(_0, desk) 
    2-2 REDO is_contained_in(_0, desk) 
    2-2 try (2) is_contained_in(_0, desk)
        3-1 CALL location(_7, desk) 
        3-1 EXIT location(flashlight, desk) </FONT></PRE>

<P>First, is there something in the flashlight? Both clauses of is_contained_in/2
fail because there is nothing located in the flashlight.</P>

<PRE><FONT COLOR="#000080">        3-2 CALL is_contained_in(_0, flashlight) 
            4-1 CALL location(_0, flashlight) 
            4-1 FAIL location(_0, flashlight) 
        3-2 REDO is_contained_in(_0, flashlight) 
        3-2 try (2) is_contained_in(_0, flashlight)
            4-1 CALL location(_11, flashlight) 
            4-1 FAIL location(_11, flashlight) 
        3-2 FAIL is_contained_in(_0, flashlight)</FONT></PRE>

<P>Next, it tries to find things in the envelope and comes up with the
stamp.</P>

<PRE><FONT COLOR="#000080">        3-1 REDO location(_7, desk) 
        3-1 EXIT location(envelope, desk) 
        3-2 CALL is_contained_in(_0, envelope) 
            4-1 CALL location(_0, envelope) 
            4-1 EXIT location(stamp, envelope) 
        3-2 EXIT is_contained_in(stamp, envelope) 
    2-2 EXIT is_contained_in(stamp, desk) 
1-1 EXIT is_contained_in(stamp, office) 
      X = stamp ;</FONT></PRE>

<P>And then the key.</P>

<PRE><FONT COLOR="#000080">            4-1 REDO location(_0,envelope) 
            4-1 EXIT location(key, envelope) 
        3-2 EXIT is_contained_in(key, envelope) 
    2-2 EXIT is_contained_in(key, desk) 
1-1 EXIT is_contained_in(key, office) 
      X = key ;</FONT></PRE>

<P>And then it fails its way back to the beginning.</P>

<PRE><FONT COLOR="#000080">        3-2 REDO is_contained_in(_0, envelope) 
        3-2 try (2) is_contained_in(_0, envelope)
            4-1 CALL location(_11, envelope) 
            4-1 EXIT location(stamp, envelope) 
            4-2 CALL is_contained_in(_0, stamp) 
                5-1 CALL location(_0, stamp) 
                5-1 FAIL location(_0, stamp) 
            4-2 REDO is_contained_in(_0, stamp) 
            4-2 try(2) is_contained_in(_0, stamp)
                5-1 CALL location(_14, stamp) 
                5-1 FAIL location(_14, stamp) 
            4-1 REDO location(_11, envelope) 
            4-1 EXIT location(key, envelope) 
            4-2 CALL is_contained_in(_0, key) 
            4-2 try (1) is_contained_in(_0, key)
                5-1 CALL location(_0, key) 
                5-1 FAIL location(_0, key) 
            4-2 REDO is_contained_in(_0, key) 
            4-2 try (2) is_contained_in(_0, key)
                5-1 CALL location(_14, key) 
                5-1 FAIL location(_14, key) 
            4-1 REDO location(_7, desk) 
            4-1 FAIL location(_7, desk) 
        3-1 REDO location(_4, office) 
        3-1 EXIT location(computer, office) 
        3-2 CALL is_contained_in(_0, computer) 
            4-1 CALL location(_0, computer) 
            4-1 FAIL location(_0, computer) 
        3-2 REDO is_contained_in(_0, computer) 
            4-1 CALL location(_7, computer) 
            4-1 FAIL location(_7, computer) 
        3-1 REDO location(_4, office) 
        3-1 FAIL location(_4, office) 
       no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 8.1. Trace of a recursive query </P>

<P>When writing a recursive predicate, it is essential to ensure that the
boundary condition is checked at each level . Otherwise, the program might
recurse forever. </P>

<P>The simplest way to do this is by always defining the boundary condition
first, ensuring that it is always tried first and that the recursive case
is only tried if the boundary condition fails. </P>

<H3><A NAME="Pragmatics"></A>Pragmatics</H3>

<P>We now come to some of the pragmatics of Prolog programming. First consider
that the goal location(X,Y) will be satisfied by every clause of location/2.
On the other hand, the goals location(X, office) or location(envelope,
X) will be satisfied by fewer clauses<!AMZI_INDEX=  Recursion, performance considerations>.
</P>

<P>Let's look again at the second rule for is_contained_in/2, and an equally
valid alternate coding. </P>

<UL>
<PRE><FONT COLOR="#000080">is_contained_in(T1,T2):-
  location(X,T2),
  is_contained_in(T1,X).

is_contained_in(T1,T2):-
  location(T1,X),
  is_contained_in(X,T2).</FONT></PRE>
</UL>

<P>Both will give correct answers, but the performance of each will depend
on the query. The query is_contained_in(X, office) will execute faster
with the first version. That is because T2 is bound, making the search
for location(X, T2) easier than if both variables were unbound. Similarly,
the second version is faster for queries such as is_contained_in(key, X).
</P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Adventure Game</H4>

<P>1- Trace the two versions of is_contained_in/2 presented at the end
of the chapter to understand the performance differences between them.
</P>

<P>2- Currently, the can_take/1 predicate only allows the player to take
things which are directly located in a room. Modify it so it uses the recursive
is_contained_in/2 so that a player can take anything in a room. </P>

<H4>Genealogical Logicbase</H4>

<P>3- Use recursion to write an ancestor/2 predicate. Then trace it to
understand its behavior. It is possible to write endless loops with recursive
predicates. The trace facility will help you debug ancestor/2 if it is
not working correctly. </P>

<P>4- Use ancestor/2 for finding all of a person's ancestors and all of
a person's descendants. Based on your experience with grandparent/2 and
grandchild/2, write a descendant/2 predicate optimized for descendants,
as opposed to ancestor/2, which is optimized for ancestors. </P>


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
