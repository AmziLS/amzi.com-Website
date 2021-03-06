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

<A NAME="Chapter4"></A>

<table style="width:100%;"><tr>
<td><h1>4</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Compound Queries</H2>

<P>Simple goals can be combined to form compound queries<!AMZI_INDEX= Queries, compound; Compound queries; Goals, combining>.
For example, we might want to know if there is anything good to eat in
the kitchen. In Prolog we might ask </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(X, kitchen), edible(X).</FONT></PRE>
</UL>

<P>Whereas a simple query had a single goal, the compound query has a conjunction<!AMZI_INDEX= Conjunction>
of goals. The comma separating the goals is read as &quot;and.&quot; </P>

<P>Logically (declaratively) the example means &quot;Is there an X such
that X is located in the kitchen and X is edible?&quot; If the same variable
name appears more than once in a query, it must have the same value in
all places it appears. The query in the above example will only succeed
if there is a single value of X that can satisfy both goals. </P>

<P>However, the variable name has no significance to any other query, or
clause in the logicbase. If X appears in other queries or clauses, that
query or clause gets its own copy of the variable. We say the <B>scope</B>
of a logical variable is a query. </P>

<P>Trying the sample query we get </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(X, kitchen), edible(X).<!AMZI_INDEX= location/2; edible/1>
X = apple ;
X = crackers ;
no</FONT></PRE>
</UL>

<P>The 'broccoli' does not show up as an answer because we did not include
it in the edible/1 predicate. </P>

<P>This logical query can also be interpreted procedurally, using an understanding
of Prolog's execution strategy. The procedural interpretation is: &quot;First
find an X located in the kitchen, and then test to see if it is edible.
If it is not, go back and find another X in the kitchen and test it. Repeat
until successful, or until there are no more Xs in the kitchen.&quot; </P>

<P>To understand the execution of a compound query, think of the goals
as being arranged from left to right. Also think of a separate table which
is kept for the current variable bindings. The flow of control moves back
and forth through the goals as Prolog attempts to find variable bindings
that satisfy the query. </P>

<P>Each goal can be entered from either the left or the right, and can
be left from either the left or the right. These are the ports of the goal
as seen in the last chapter. </P>

<P>A compound query begins by calling the first goal on the left. If it
succeeds, the next goal is called with the variable bindings as set from
the previous goal. If the query finishes via the exit port of the rightmost
goal, it succeeds, and the listener prints the values in the variable table.
</P>

<P>If the user types semicolon (;) after an answer, the query is re-entered
at the redo port of the rightmost goal. Only the variable bindings that
were set in that goal are undone. </P>

<P>If the query finishes via the fail port of the leftmost goal, the query
fails. Figure 4.1 shows a compound query with the listener interaction
on the ending ports.</P>

<P><IMG SRC="advfig3.gif" HEIGHT=76 WIDTH=299></P>

<P>Figure 4.1. Compound queries </P>

<P>Figure 4.2 contains the annotated trace of the sample query. Make sure
you understand it before proceeding<!AMZI_INDEX= Compound query, example trace of>.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">?- location(X, kitchen), edible(X).</FONT></PRE>

<P>The trace has a new feature, which is a number in the first column that
indicates the goal being worked on.</P>

<P>First the goal location(X, kitchen) is called, and the trace indicates
that pattern matches the second clause of location.</P>

<PRE><FONT COLOR="#000080">1 CALL location(X, kitchen)</FONT></PRE>

<P>It succeeds, and results in the binding of X to apple.</P>

<PRE><FONT COLOR="#000080">1 EXIT (2)location(apple, kitchen)</FONT></PRE>

<P>Next, the second goal edible(X) is called. However, X is now bound to
apple, so it is called as edible(apple).</P>

<PRE><FONT COLOR="#000080">2 CALL edible(apple)</FONT></PRE>

<P>It succeeds on the first clause of edible/1, thus exiting the query
successfully.</P>

<PRE><FONT COLOR="#000080">2 EXIT (1) edible(apple)
    X = apple ;</FONT></PRE>

<P>Entering semicolon (;) causes the listener to backtrack into the rightmost
goal of the query.</P>

<PRE><FONT COLOR="#000080">2 REDO edible(apple)</FONT></PRE>

<P>There are no other clauses that match this pattern, so it fails.</P>

<PRE><FONT COLOR="#000080">2 FAIL edible(apple)</FONT></PRE>

<P>Leaving the fail port of the second goal causes the listener to enter
the redo port of the first goal. In so doing, the variable binding that
was established by that goal is undone, leaving X unbound.</P>

<PRE><FONT COLOR="#000080">1 REDO location(X, kitchen)</FONT></PRE>

<P>It now succeeds at the sixth clause, rebinding X to broccoli.</P>

<PRE><FONT COLOR="#000080">1 EXIT (6) location(broccoli, kitchen)</FONT></PRE>

<P>The second goal is called again with the new variable binding. This
is a fresh call, just as the first one was, and causes the search for a
match to begin at the first clause</P>

<PRE><FONT COLOR="#000080">2 CALL edible(broccoli)</FONT></PRE>

<P>There is no clause for edible(broccoli), so it fails.</P>

<PRE><FONT COLOR="#000080">2 FAIL edible(broccoli)</FONT></PRE>

<P>The first goal is then re-entered at the redo port, undoing the variable
binding.</P>

<PRE><FONT COLOR="#000080">1 REDO location(X, kitchen)</FONT></PRE>

<P>It succeeds with a new variable binding.</P>

<PRE><FONT COLOR="#000080">1 EXIT (7) location(crackers, kitchen)</FONT></PRE>

<P>This leads to the second solution to the query.</P>

<PRE><FONT COLOR="#000080">2 CALL edible(crackers)
2 EXIT (2) edible(crackers)
    X = crackers ;</FONT></PRE>

<P>Typing semicolon (;) initiates backtracking again, which fails through
both goals and leads to the ultimate failure of the query.</P>

<PRE><FONT COLOR="#000080">2 REDO edible(crackers)
2 FAIL edible(crackers)
1 REDO location(X, kitchen)
1 FAIL location(X, kitchen)
     no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 4.2. Annotated trace of compound query </P>

<P>In this example we had a single variable, which was bound (given a value)
by the first goal and tested in the second goal. We will now look at a
more general example with two variables. It is attempting to ask for all
the things located in rooms adjacent to the kitchen. </P>

<P>In logical terms, the query says &quot;Find a T and R such that there
is a door from the kitchen to R and T is located in R.&quot; In procedural
terms it says &quot;First find an R with a door from the kitchen to R.
Use that value of R to look for a T located in R.&quot; </P>

<UL>
<PRE><FONT COLOR="#000080">?- door(kitchen, R), location(T,R).<!AMZI_INDEX= door/2; location/2>
R = office
T = desk ;

R = office
T = computer ;

R = cellar
T = 'washing machine' ;
no</FONT></PRE>
</UL>

<P>In this query, the backtracking is more complex. Figure 4.3 shows its
trace. </P>

<P>Notice that the variable R is bound by the first goal and T is bound
by the second. Likewise, the two variables are unbound by entering the
redo port<!AMZI_INDEX= Ports, redo> of the goal that bound them. After
R is first bound to office, that binding sticks during backtracking through
the second goal. Only when the listener backtracks<!AMZI_INDEX= Backtracking>
into the first goal does R get unbound. </P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">Goal: door(kitchen, R), location(T,R)

1 CALL door(kitchen, R)
1 EXIT (2) door(kitchen, office)
2 CALL location(T, office)
2 EXIT (1) location(desk, office)
    R = office
    T = desk ;
2 REDO location(T, office)
2 EXIT (8) location(computer, office)
    R = office
    T = computer ;
2 REDO location(T, office)
2 FAIL location(T, office)
1 REDO door(kitchen, R)
1 EXIT (4) door(kitchen, cellar)
2 CALL location(T, cellar)
2 EXIT (4) location('washing machine', cellar)
    R = cellar
    T = 'washing machine' ;
2 REDO location(T, cellar)
2 FAIL location(T, cellar)
1 REDO door(kitchen, R)
1 FAIL door(kitchen, R)
     no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 4.3. Trace of a compound query </P>

<H3><A NAME="BuiltinPredicates"></A>Built-in Predicates
</H3>

<P>Up to this point we have been satisfied with the format Prolog uses
to give us answers. We will now see how to generate output that is customized
to our needs. The example will be a query that lists all of the items in
the kitchen. This will require performing I/O and forcing the listener
to automatically backtrack to find all solutions. </P>

<P>To do this, we need to understand the concept of the <B>built-in</B>
(evaluable) predicate. A built-in predicate<!AMZI_INDEX= Predicates, built-in; Built-in predicates>
is predefined by Prolog. There are no clauses in the logicbase for built-in
predicates. When the listener encounters a goal that matches a built-in
predicate, it calls a predefined procedure. </P>

<P>Built-in predicates are usually written in the language used to implement
the listener. They can perform functions that have nothing to do with logical
theorem proving, such as writing to the console. For this reason they are
sometimes called extra-logical predicates. </P>

<P>However, since they appear as Prolog goals they must be able to respond
to either a call from the left or a redo from the right. Its response in
the redo case is referred to as its behavior on backtracking. </P>

<P>We will introduce specific built-in predicates as we need them. Here
are the I/O predicates<!AMZI_INDEX= I/O predicates> that will let us control
the output of our query. </P>

<DL>
<DL>
<DT>write/1<!AMZI_INDEX= write/1> </DT>

<DD>This predicate always succeeds when called, and has the side effect
of writing its argument to the console.It always fails on backtracking.
Backtracking does not undo the side effect. </DD>

<DT>nl/0<!AMZI_INDEX= nl/0> </DT>

<DD>Succeeds, and starts a new line. Like write, it always succeeds when
called, and fails on backtracking. </DD>

<DT>tab/1<!AMZI_INDEX= tab/1> </DT>

<DD>It expects the argument to be an integer and tabs that number of spaces.
It succeeds when called and fails on backtracking. </DD>
</DL>
</DL>

<P>Figure 4.4 is a stylized picture of a goal showing its internal control
structure. We will compare this with the internal flow of control of various
built-in predicates.</P>

<P><IMG SRC="advfig4.gif" HEIGHT=76 WIDTH=173></P>

<P>Figure 4.4. Internal flow of control through a normal goal </P>

<P>In figure 4.4, the upper left diamond represents the decision point
after a call. Starting with the first clause of a predicate, unification
is attempted between the query pattern and each clause, until either unification
succeeds or there are no more clauses to try. If unification succeeded,
branch to exit, marking the clause that successfully unified, if it failed,
branch to fail. </P>

<P>The lower right diamond represents the decision point after a redo.
Starting with the most recent clause found in the predicate, unification
is again attempted between the query pattern and remaining clauses. If
it succeeds, branch to exit, if not, branch to fail. </P>

<P>The I/O<!AMZI_INDEX= I/O predicates, affect on backtracking> built-in
predicates differ from normal goals in that they never change the direction
of the flow of control. If they get control from the left, they pass control
to the right. If they get control from the right, they pass control to
the left as shown in figure 4.5.</P>

<P><IMG SRC="advfig5.gif" HEIGHT=76 WIDTH=193></P>

<P>Figure 4.5. Internal flow of control through an I/O predicate </P>

<P>The output I/O predicates do not affect the variable table; however,
they may output values from it. They simply leave their mark at the console
each time control passes through them from left to right. </P>

<P>There are built-in predicates that do affect backtracking, and we have
need of one of them for the first example. It is fail/0<!AMZI_INDEX= fail/0, affect on backtracking>,
and, as its name implies, it always fails. </P>

<P>If fail/0 gets control from the left, it immediately passes control
back to the redo port of the goal on the left. It will never get control
from the right, since it never allows control to pass to its right. Figure
4.6 shows its internal control structure.</P>

<P><IMG SRC="advfig6.gif" HEIGHT=76 WIDTH=132></P>

<P>Figure 4.6. Internal flow of control through the fail/0 predicate </P>

<P>Previously we relied on the listener to display variable bindings for
us, and used the semicolon (;) response to generate all of the possible
solutions. We can now use the I/O built-in predicates to display the variable
bindings, and the fail/0 predicate to force backtracking so all solutions
are displayed. </P>

<P>Here then is the query that lists everything in the kitchen. </P>

<UL>
<PRE><FONT COLOR="#000080">?- location(X, kitchen), write(X) ,nl, fail.<!AMZI_INDEX= location/2; write/1; fail/0; nl/0>
apple
broccoli
crackers
no</FONT></PRE>
</UL>

<P>The final 'no' means the query failed, as it was destined to, due to
the fail/0. </P>

<P>Figure 4.7 shows the control flow through this query. </P>

<P><IMG SRC="advfig7.gif" HEIGHT=93 WIDTH=299></P>

<P>Figure 4.7. Flow of control through query with built-in predicates </P>

<P>Figure 4.8 shows a trace of the query<!AMZI_INDEX= Built-in predicates, example trace of>.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">Goal: location(X, kitchen), write(X), nl, fail.

1 CALL location(X, kitchen)
1 EXIT (2) location(apple, kitchen)
2 CALL write(apple)
    apple
2 EXIT write(apple)
3 CALL nl

3 EXIT nl
4 CALL fail
4 FAIL fail
3 REDO nl
3 FAIL nl
2 REDO write(apple)
2 FAIL write(apple)
1 REDO location(X, kitchen)
1 EXIT (6) location(broccoli, kitchen)
2 CALL write(broccoli)
    broccoli
2 EXIT write(broccoli)
3 CALL nl

3 EXIT nl
4 CALL fail
4 FAIL fail
3 REDO nl
3 FAIL nl
2 REDO write(broccoli)
2 FAIL write(broccoli)
1 REDO location(X, kitchen)
1 EXIT (7) location(crackers, kitchen)
2 CALL write(crackers)
    crackers
2 EXIT write(crackers)
3 CALL nl

3 EXIT nl
4 CALL fail
4 FAIL fail
3 REDO nl
3 FAIL nl
2 REDO write(crackers)
2 FAIL write(crackers)
1 REDO location(X, kitchen)
1 FAIL location(X, kitchen)
    no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 4.8. Trace of query with built-in predicates </P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Nonsense Prolog</H4>

<P>1- Consider the following Prolog logicbase. </P>

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
gizmo(c,4).

harder(a,1).
harder(c,X).
harder(b,4).
harder(d,2).</FONT></PRE>
</UL>

<P>Predict the results of the following queries. Then try them and trace
them to see if you were correct. </P>

<UL>
<PRE><FONT COLOR="#000080">?- gizmo(a,X),easy(X).
?- gizmo(c,X),easy(X).
?- gizmo(d,Z),easy(Z).

?- easy(Y),gizmo(X,Y).

?- write('report'), nl, easy(T), write(T), gizmo(M,T), tab(2), write(M), fail.

?- write('buggy'), nl, easy(Z), write(X), gizmo(Z,X), tab(2), write(Z), fail.

?- easy(X),harder(Y,X).
?- harder(Y,X),easy(X).</FONT></PRE>
</UL>

<H4>Adventure Game</H4>

<P>2- Experiment with the queries you have seen in this chapter. </P>

<P>3- Predict the results of this query before you execute it. Then try
it. Trace it if you were wrong. </P>

<UL>
<PRE><FONT COLOR="#000080">?- door(kitchen, R), write(R), nl, location(T,R), tab(3), write(T), nl, fail.</FONT></PRE>
</UL>

<H4>Genealogical Logicbase</H4>

<P>4- Compound queries can be used to find family relationships in the
genealogical logicbase. For example, find someone's mother with </P>

<UL>
<PRE><FONT COLOR="#000080">?- parent(X, someone), female(X).</FONT></PRE>
</UL>

<P>Write similar queries for fathers, sons, and daughters. Trace these
queries to understand their behavior (or misbehavior if they are not working
right for you). </P>

<P>5- Experiment with the ordering of the goals. In particular, contrast
the queries. </P>

<UL>
<PRE><FONT COLOR="#000080">?- parent(X, someone), female(X).
?- female(X), parent(X, someone).</FONT></PRE>
</UL>

<P>Do they both give the same answer? Trace both queries and see which
takes more steps. </P>

<P>6- The same predicate can be used multiple times in the same query.
For example, we can find grandparents </P>

<UL>
<PRE><FONT COLOR="#000080">?- parent(X, someone), parent(GP, X).</FONT></PRE>
</UL>

<P>7- Write queries which find grandmothers, grandfathers, and great-great
grandparents. </P>

<H4>Customer Order Entry</H4>

<P>8- Write a query against the item and inventory records that returns
the inventory level for an item when you only know the item name. </P>




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
