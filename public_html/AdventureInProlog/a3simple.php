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

<A NAME="Chapter3"></A>

<table style="width:100%;"><tr>
<td><h1>3</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Simple Queries</H2>

<P>Now that we have some facts in our Prolog program, we can consult the
program in the listener and query, or call, the facts. This chapter, and
the next, will assume the Prolog program contains only facts. Queries against
programs with rules will be covered in a later chapter. </P>

<P>Prolog queries<!AMZI_INDEX= Queries> work by pattern matching. The query
pattern is called a <B>goal<!AMZI_INDEX= Goals></B>. If there is a fact
that matches the goal, then the query succeeds and the listener responds
with 'yes.' If there is no matching fact, then the query fails and the
listener responds with 'no.' </P>

<P>Prolog's pattern matching is called <B>unification<!AMZI_INDEX= Unification></B>.
In the case where the logicbase contains only facts, unification succeeds
if the following three conditions hold. </P>

<UL>
<LI>The predicate named in the goal and logicbase are the same. </LI>

<LI>Both predicates have the same arity. </LI>

<LI>All of the arguments are the same. </LI>
</UL>

<P>Before proceeding, review figure 3.1, which has a listing of the program
so far. </P>

<P>The first query we will look at asks if the office is a room in the
game. To pose this, we would enter that goal followed by a period at the
listener prompt. </P>

<UL>
<PRE><FONT COLOR="#000080">?- room(office).<!AMZI_INDEX= room/1
>
yes</FONT></PRE>
</UL>

<P>Prolog will respond with a 'yes' if a match was found. If we wanted
to know if the attic was a room, we would enter that goal. </P>

<UL>
<PRE><FONT COLOR="#000080">?- room(attic).
no</FONT></PRE>
</UL>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">room(kitchen).
room(office).
room(hall).
room('dining room').
room(cellar).

door(office, hall).
door(kitchen, office).
door(hall, 'dining room').
door(kitchen, cellar).
door('dining room', kitchen).

location(desk, office).
location(apple, kitchen).
location(flashlight, desk).
location('washing machine', cellar).
location(nani, 'washing machine').
location(broccoli, kitchen).
location(crackers, kitchen).
location(computer, office).

edible(apple).
edible(crackers).

tastes_yucky(broccoli).

here(kitchen).</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 3.1. The listing of Nani Search entered at this point </P>

<P>Prolog will respond with a 'no' if no match was found. Likewise, we
can ask about the locations of things. </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(apple, kitchen).<!AMZI_INDEX= location/2
>
yes

?- location(kitchen, apple).
no</FONT></PRE>
</UL>

<P>Prolog responds to our location query patterns in a manner that makes
sense to us. That is, the kitchen is not located in the apple. </P>

<P>However, here is the problem with the one-way doors, which we still
haven't fixed. It is mentioned again to stress the importance of the order
of the arguments. </P>

<UL>
<PRE><FONT COLOR="#000080">?- door(office, hall).
yes

?- door(hall, office).
no</FONT></PRE>
</UL>

<P>Goals<!AMZI_INDEX= Goals, variables in> can be generalized by the use
of Prolog variables<!AMZI_INDEX= Variables, in goals>. They do not behave
like the variables in other languages, and are better called logical variables
(although Prolog does not precisely correspond to logic). The logical variables
replace one or more of the arguments in the goal. </P>

<P>Logical variables<!AMZI_INDEX= Logical variables> add a new dimension
to unification. As before, the predicate names and arity must be the same
for unification to succeed. However, when the corresponding arguments are
compared, a variable will successfully match any term. </P>

<P>After successful unification, the logical variable takes on the value
of the term it was matched with. This is called <B>binding</B> the variable.
When a goal with a variable successfully unifies with a fact in the logicbase,
Prolog returns the value of the newly bound variable. </P>

<P>Since there may be more than one value a variable<!AMZI_INDEX= Variables, binding; Unification>
can be bound to and still satisfy the goal, Prolog provides the means for
you to ask for alternate values. After an answer you can enter a semicolon
(;). It causes Prolog to look for alternative bindings for the variables.
Entering anything else at the prompt ends the query. </P>

<P>For example, we can use a logical variable to find all of the rooms.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- room(X).<!AMZI_INDEX= room/1
>
X = kitchen ;
X = office ;
X = hall ;
X = 'dining room' ;
X = cellar ;
no</FONT></PRE>
</UL>

<P>The last 'no' means there are no more answers. </P>

<P>Here's how to find all the things in the kitchen. (Remember, variables
begin with uppercase letters.) </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(Thing, kitchen).
Thing = apple ;
Thing = broccoli ;
Thing = crackers ;
no</FONT></PRE>
</UL>

<P>We can use two variables to see everything in every place. </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(Thing, Place).<!AMZI_INDEX= location/2
>
Thing = desk
Place = office ;

Thing = apple
Place = kitchen ;

Thing = flashlight
Place = desk ;

...
no</FONT></PRE>
</UL>

<P>Other applications might have the following queries. </P>

<P>What customers live in Boston, and what is their credit rating? </P>

<UL>
<PRE><FONT COLOR="#000080">?- customer(X, boston, Y).</FONT></PRE>
</UL>

<P>What is the title of chapter 2? </P>

<UL>
<PRE><FONT COLOR="#000080">?- chapter(2,Title).</FONT></PRE>
</UL>

<P>What are the coordinates of window main? </P>

<UL>
<PRE><FONT COLOR="#000080">?- window(main,Row1,Col1,Row2,Col2).</FONT></PRE>
</UL>

<H3><A NAME="HowQueriesWork"></A>How Queries Work<!AMZI_INDEX= Queries>
</H3>

<P>When Prolog tries to satisfy a goal about a predicate, such as location/2,
it searches through the clauses defining location/2. When it finds a match
for its variables, it marks the particular clause that was used to satisfy
the goal. Then, if the user asks for more answers, it resumes its search
of the clauses at that place marker. </P>

<P>Referring to the list of clauses in figure 3.1, let's look closer at
this process with the query location(X, kitchen). First, unification is
attempted between the query pattern and the first clause of location/2.
</P>

<UL>
<PRE><FONT COLOR="#000080">Pattern                           Clause #1 </FONT></PRE>

<PRE><FONT COLOR="#000080">location(X, kitchen)              location(desk, office) </FONT></PRE>
</UL>

<P>This unification<!AMZI_INDEX= Unification> fails. The predicate names
are the same, the number of arguments is the same, but the second argument
in the pattern, kitchen, is different from the second argument in the clause,
office. </P>

<P>Next, unification is attempted between the pattern and the second clause
of location/2. </P>

<UL>
<PRE><FONT COLOR="#000080">Pattern                           Clause #2 </FONT></PRE>

<PRE><FONT COLOR="#000080">location(X, kitchen)              location(apple, kitchen) </FONT></PRE>
</UL>

<P>This unification succeeds. The predicate names, arity (number of arguments),
and second arguments are the same. The first arguments can be made the
same if the variable X in the pattern takes the value 'apple.' </P>

<P>Now that unification succeeds, the Prolog listener reports its success,
and the binding of the variable X. </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(X, kitchen).<!AMZI_INDEX= location/2
>
X = apple</FONT></PRE>
</UL>

<P>If the user presses a key other than the semicolon (;) at this point,
the listener responds with 'yes' indicating the query ended successfully.
</P>

<P>If the user presses the semicolon (;) key, the listener looks for other
solutions. First it unbinds the variable X. Next it resumes the search
using the clause following the one that had just satisfied the query. This
is called <B>backtracking</B>. In the example that would be the third clause.
</P>

<UL>
<PRE><FONT COLOR="#000080">Pattern                           Clause #3 </FONT></PRE>

<PRE><FONT COLOR="#000080">location(X, kitchen)              location(flashlight, desk) </FONT></PRE>
</UL>

<P>This fails, and the search continues. Eventually the sixth clause succeeds.
</P>

<UL>
<PRE><FONT COLOR="#000080">Pattern                           Clause #6 </FONT></PRE>

<PRE><FONT COLOR="#000080">location(X, kitchen)              location(broccoli, kitchen) </FONT></PRE>
</UL>

<P>As a result, the variable X is now rebound to broccoli, and the listener
responds </P>

<UL>
<PRE><FONT COLOR="#000080">X = broccoli ;</FONT></PRE>
</UL>

<P>Again, entering a semicolon (;) causes X to be unbound and the search
to continue with the seventh clause, which also succeeds. </P>

<UL>
<PRE><FONT COLOR="#000080">X = crackers ;</FONT></PRE>
</UL>

<P>As before, entering anything except a semicolon (;) causes the listener
to respond 'yes,' indicating success. A semicolon (;) causes the unbinding
of X and the search to continue. But now, there are no more clauses that
successfully unify with the pattern, so the listener responds with 'no'
indicating the final attempt has failed. </P>

<UL>
<PRE><FONT COLOR="#000080">no </FONT></PRE>
</UL>

<P>The best way to understand Prolog execution is to trace its execution
in the debugger. But first it is necessary to have a deeper understanding
of goals. </P>

<P>A Prolog goal has four <B>ports<!AMZI_INDEX= Ports; Goals, ports of></B>
representing the flow of control through the goal: call, exit, redo, and
fail. First the goal is called. If successful it is exited. If not it fails.
If the goal is retried, by entering a semicolon (;) the redo port is entered.
Figure 3.2 shows the goal and its ports.</P>

<P><IMG SRC="advfig2.gif" HEIGHT=76 WIDTH=193></P>

<P>Figure 3.2. The ports of a Prolog goal </P>

<P>The behaviors at each port are </P>

<DL>
<DL>
<DT>call </DT>

<DD>Begins searching for clauses that unify with the goal </DD>

<DT>exit</DT>

<DD>Indicates the goal is satisfied, sets a place marker at the clause
and binds the variables appropriately </DD>

<DT>redo </DT>

<DD>Retries the goal, unbinds the variables and resumes search at the place
marker </DD>

<DT>fail </DT>

<DD>Indicates no more clauses match the goal </DD>
</DL>
</DL>

<P>Prolog debuggers use these ports to describe the state of a query. Figure
3.3 shows a trace of the location(X, kitchen) query. Study it carefully
because it is the key to your understanding of Prolog. The number in parentheses
indicates the current clause.</P>

        <div style="margin: 5px; float:right; background:#FFFFFF; border:double black thick; padding:5px; width: 250px;">
        <p align="center">
        If you haven't already, we recommend you download and use the Amzi! Prolog IDE.  It's full source
        code debugger let's you easily see the execution behavior of Prolog.<br />
		It's free!
        See <br/><a href="aprolog.php">Amzi! Prolog</a></p>
        </div>


<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">?- location(X, kitchen).
CALL: - location(X, kitchen)
EXIT:(2) location(apple, kitchen)
  X = apple ;
REDO: location(X, kitchen)
EXIT:(6) location(broccoli, kitchen)
  X = broccoli ;
REDO: location(X, kitchen)
EXIT:(7) location(crackers, kitchen)
  X = crackers ;
FAIL - location(X, kitchen)
  no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 3.3. Prolog trace of location(X, kitchen) </P>

<P>Because the trace information presented in this book is designed to teach Prolog 
  rather than debug it, the format is a little different from that used in the 
  actual debugger. Run the Amzi! Source Code Debugger on these queries to see 
  how they work for real.</P>
  <P>To start the Amzi! Debugger, highlight your project name or edit a source file 
  in your project, then select Run | Debug As | Interpreted Project from the main 
  menu.</P>
  
<P>You will see a separate perspective with multiple views that contain trace 
  information. Enter the query 'location(X, kitchen)' in the Debug Listener view. 
  You will see the trace start in the debugger view. </P>
  
<P>Use the 'Step Over' button in the debugger to creep from port to port. When 
  output appears in the listener view, enter semicolons (;) to continue the search. 
  See the help files for more details on the debugger.</P>

<P>Unification between goals and facts is actually more general than has
been presented. Variables can also occur in the facts of the Prolog logicbase
as well. </P>

<P>For example, the following fact could be added to the Prolog program.
It might mean everyone sleeps. </P>

<UL>
<PRE><FONT COLOR="#000080">sleeps(X).</FONT></PRE>
</UL>

<P>You can add it directly in the listener, to experiment with, like this.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- assert(sleeps(X)).
yes</FONT></PRE>
</UL>

<P>Queries against a logicbase with this fact give the following results.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- sleeps(jane).<!AMZI_INDEX= sleeps/1
>
yes

?- sleeps(tom).
yes</FONT></PRE>
</UL>

<P>Notice that the listener does not return the variable bindings of 'X=jane'
and 'X=tom.' While they are surely bound that way, the listener only lists
variables mentioned in the query, not those used in the program. </P>

<P>Prolog can also bind variables to variables. </P>

<UL>
<PRE><FONT COLOR="#000080">?- sleeps(Z).
Z = H116

?- sleeps(X).
X = H247</FONT></PRE>
</UL>

<P>When two unbound variables<!AMZI_INDEX= Unification; unbound variables>
match, they are both bound, but not to a value! They are bound together,
so that if either one takes a value, the other takes the same value. This
is usually implemented by binding both variables to a common internal variable.
In the first query above, both Z in the query and X in the fact are bound
to internal variable 'H116.' In this way Prolog remembers they have the
same value. If either one is bound to a value later on, both automatically
bind to that value. This feature of Prolog distinguishes it from other
languages and, as we will discover later, gives Prolog much of its power.
</P>

<P>The two queries above are the same, even though one uses the same character
X that is used in the fact sleeps(X). The variable in the fact is considered
different from the one in the query. </P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<P>The exercise sections will often contain nonsense Prolog questions.
These are queries against a meaningless logicbase to strengthen your understanding
of Prolog without the benefit of meaningful semantics. You are to predict
the answers to the query and then try them in Prolog to see if you are
correct. If you are not, trace the queries to better understand them. </P>

<H4>Nonsense Prolog</H4>

<P>1- Consider the following Prolog logicbase </P>

<UL>
<PRE><FONT COLOR="#000080">easy(1).
easy(2).
easy(3).

gizmo(a,1).
gizmo(b,3).
gizmo(a,2).
gizmo(d,5).
gizmo(c,3).
gizmo(a,3).
gizmo(c,4).</FONT></PRE>
</UL>

<P>and predict the answers to the queries below, including all alternatives
when the semicolon (;) is entered after an answer. </P>

<UL>
<PRE><FONT COLOR="#000080">?- easy(2).
?- easy(X).

?- gizmo(a,X).
?- gizmo(X,3).
?- gizmo(d,Y).
?- gizmo(X,X).</FONT></PRE>
</UL>

<P>2- Consider this logicbase, </P>

<UL>
<PRE><FONT COLOR="#000080">harder(a,1).
harder(c,X).
harder(b,4).
harder(d,2).</FONT></PRE>
</UL>

<P>and predict the answers to these queries. </P>

<UL>
<PRE><FONT COLOR="#000080">?- harder(a,X).
?- harder(c,X).
?- harder(X,1).
?- harder(X,4).</FONT></PRE>
</UL>

<H4>Adventure Game</H4>

<P>3- Enter the listener and reproduce some of the example queries you
have seen against location/2. List or print location/2 for reference if
you need it. Remember to respond with a semicolon (;) for multiple answers.
Trace the query. </P>

<H4>Genealogical Logicbase</H4>

<P>4- Pose queries against the genealogical logicbase that: </P>

<UL>
<LI>Confirm a parent relationship such as parent(dennis, diana) </LI>

<LI>Find someone's parent such as parent(X, diana) </LI>

<LI>Find someone's children such as parent(dennis, X) </LI>

<LI>List all parent-children such as parent(X,Y) </LI>
</UL>

<P>5- If parent/2 seems to be working, you can add additional family members
to get a larger logicbase. Remember to include the corresponding male/1
or female/1 predicate for each individual added. </P>

<H4>Customer Order Entry</H4>

<P>6- Pose queries against the customer order entry logicbase that </P>

<UL>
<LI>find customers in a given city </LI>

<LI>find customers with a given credit rating </LI>

<LI>confirm a given customer's credit rating </LI>

<LI>find the customers in a given city with a given credit rating </LI>

<LI>find the reorder quantity for a given item </LI>

<LI>find the item number for a given item name </LI>

<LI>find the inventory level for a given item number </LI>
</UL>



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
