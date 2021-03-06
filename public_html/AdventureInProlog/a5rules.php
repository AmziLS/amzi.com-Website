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

<A NAME="Chapter5"></A>

<table style="width:100%;"><tr>
<td><h1>5</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Rules</H2>

<P>We said earlier a predicate is defined by clauses, which may be facts
or rules<!AMZI_INDEX= Rules>. A rule is no more than a stored query. Its
syntax is </P>

<UL>
<PRE><FONT COLOR="#000080">head :- body.</FONT></PRE>
</UL>

<P>where </P>

<DL>
<DL>
<DT>head </DT>

<DD>a predicate definition (just like a fact) </DD>

<DT>:- </DT>

<DD>the <B>neck</B> symbol, sometimes read as &quot;if&quot; </DD>

<DT>body </DT>

<DD>one or more goals (a query) </DD>
</DL>
</DL>

<P>For example, the compound query that finds out where the good things
to eat are can be stored as a rule with the predicate name where_food/2.
</P>

<UL>
<PRE><FONT COLOR="#000080">where_food(X,Y) :-<!AMZI_INDEX=  where_food/2>  
  location(X,Y),
  edible(X).</FONT></PRE>
</UL>

<P>It states &quot;There is something X to eat in room Y if X is located
in Y, and X is edible.&quot; </P>

<P>We can now use the new rule directly in a query to find things to eat
in a room. As before, the semicolon (;) after an answer is used to find
all the answers. </P>

<UL>
<PRE><FONT COLOR="#000080">?- where_food(X, kitchen).
X = apple ;
X = crackers ;
no

?- where_food(Thing, 'dining room').
no</FONT></PRE>
</UL>

<P>Or it can check on specific things. </P>

<UL>
<PRE><FONT COLOR="#000080">?- where_food(apple, kitchen).
yes</FONT></PRE>
</UL>

<P>Or it can tell us everything. </P>

<UL>
<PRE><FONT COLOR="#000080">?- where_food(Thing, Room).
Thing = apple
Room = kitchen ;

Thing = crackers
Room = kitchen ;
no</FONT></PRE>
</UL>

<P>Just as we had multiple facts defining a predicate, we can have multiple
rules<!AMZI_INDEX=  Rules, multiple> for a predicate. For example, we might
want to have the broccoli included in where_food/2. (Prolog doesn't have
an opinion on whether or not broccoli is legitimate food. It just matches
patterns.) To do this we add another where_food/2 clause<!AMZI_INDEX= Clauses>
for things that 'taste_yucky.' </P>

<UL>
<PRE><FONT COLOR="#000080">where_food(X,Y) :-
  location(X,Y),
  edible(X).
where_food(X,Y) :-
  location(X,Y),
  tastes_yucky(X).</FONT></PRE>
</UL>

<P>Now the broccoli shows up when we use the semicolon (;) to ask for everything.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- where_food(X, kitchen).
X = apple ;
X = crackers ;
X = broccoli ;
no</FONT></PRE>
</UL>

<P>Until this point, when we have seen Prolog try to satisfy goals by searching
the clauses of a predicate, all of the clauses have been facts. </P>

<H3><A NAME="HowRulesWork"></A>How Rules Work</H3>

<P>With rules, Prolog unifies the goal pattern with the head of the clause.
If unification<!AMZI_INDEX=  Unification, rules; Rules, unification> succeeds,
then Prolog initiates a new query using the goals in the body of the clause.
</P>

<P>Rules, in effect, give us multiple levels of queries. The first level
is composed of the original goals. The next level is a new query composed
of goals found in the body of a clause from the first level. </P>

<P>Each level can create even deeper levels. Theoretically, this could
continue forever. In practice it can continue until the listener runs out
of space. </P>

<P>Figure 5.1 shows the control flow after the head of a rule has been
matched. Notice how backtracking from the third goal of the first level
now goes into the second level. </P>

<P><IMG SRC="advfig8.gif" HEIGHT=166 WIDTH=239></P>

<P>Figure 5.1. Control flow with rules </P>

<P>In this example, the middle goal on the first level succeeds or fails
if its body succeeds or fails. When entered from the right (redo) the goal
reenters its body query from the right (redo). When the query fails, the
next clause of the first-level goal is tried, and if the next clause is
also a rule, the process is repeated with the second clause's body. </P>

<P>As always with Prolog, these relationships become clearer by studying
a trace. Figure 5.2 contains the annotated trace of the where_food/2 query.
Notice the appearance of a two-part number. The first part of the number
indicates the query level. The second part indicates the number of the
goal within the query, as before. The parenthetical number is the clause
number<!AMZI_INDEX= Clauses, number>. For example </P>

<UL>
<PRE><FONT COLOR="#000080">2-1 EXIT (7) location(crackers, kitchen)</FONT></PRE>
</UL>

<P>means the exit occurred at the second level, first goal using clause
number seven.<!AMZI_INDEX= Rules, example, trace of> </P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- where_food(X, kitchen).</FONT></PRE>

<P>First the clauses of where_food/2 are searched.</P>

<PRE><FONT COLOR="#000080">1-1 CALL where_food(X, kitchen)</FONT></PRE>

<P>The pattern matches the head of the first clause, and while it is not
at a port, the trace could inform us of the clause it is working on.</P>

<PRE><FONT COLOR="#000080">1-1 try (1) where_food(X, kitchen)</FONT></PRE>

<P>The body of the first clause is then set up as a query, and the trace
continues.</P>

<PRE><FONT COLOR="#000080">    2-1 CALL location(X, kitchen)</FONT></PRE>

<P>From this point the trace proceeds exactly as it did for the compound
query in the previous chapter.</P>

<PRE><FONT COLOR="#000080">    2-1 EXIT (2) location(apple, kitchen)
    2-2 CALL edible(apple)
    2-2 EXIT (1) edible(apple)</FONT></PRE>

<P>Since the body has succeeded, the goal from the previous (first) level
succeeds.</P>

<PRE><FONT COLOR="#000080">1-1 EXIT (1) where_food(apple, kitchen)
      X = apple ;</FONT></PRE>

<P>Backtracking goes from the first-level goal, into the second level,
proceeding as before.</P>

<PRE><FONT COLOR="#000080">1-1 REDO where_food(X, kitchen)
    2-2 REDO edible(apple)
    2-2 FAIL edible(apple)
    2-1 REDO location(X, kitchen)
    2-1 EXIT (6) location(broccoli, kitchen)
    2-2 CALL edible(broccoli)
    2-2 FAIL edible(broccoli)
    2-1 REDO location(X, kitchen)
    2-1 EXIT (7) location(crackers, kitchen)
    2-2 CALL edible(crackers)
    2-2 EXIT (2) edible(crackers)
1-1 EXIT (1) where_food(crackers, kitchen)
      X = crackers ;</FONT></PRE>

<P>Now any attempt to backtrack into the query will result in no more answers,
and the query will fail.</P>

<PRE><FONT COLOR="#000080">    2-2 REDO edible(crackers)
    2-2 FAIL edible(crackers)
    2-1 REDO location(X, kitchen)
    2-1 FAIL location(X, kitchen)</FONT></PRE>

<P>This causes the listener to look for other clauses whose heads match
the query pattern. In our example, the second clause of where_food/2 also
matches the query pattern.</P>

<PRE><FONT COLOR="#000080">1-1 REDO where_food(X, kitchen)</FONT></PRE>

<P>Again, although traces usually don't tell us so, it is building a query
from the body of the second clause.</P>

<PRE><FONT COLOR="#000080">1-1 try (2) where_food(X, kitchen)</FONT></PRE>

<P>Now the second query proceeds as normal, finding the broccoli, which
tastes_yucky.</P>

<PRE><FONT COLOR="#000080">     2-1 CALL location(X, kitchen)
     2-1 EXIT (2) location(apple, kitchen)
     2-2 CALL tastes_yucky(apple)
     2-2 FAIL tastes_yucky(apple)
     2-1 REDO location(X, kitchen)
     2-1 EXIT (6) location(broccoli, kitchen)
     2-2 CALL tastes_yucky(broccoli)
     2-2 EXIT (1) tastes_yucky(broccoli)
1-1 EXIT (2) where_food(broccoli, kitchen)
      X = broccoli ;</FONT></PRE>

<P>Backtracking brings us to the ultimate no, as there are no more where_food/2
clauses to try.</P>

<PRE><FONT COLOR="#000080">     2-2 REDO tastes_yucky(broccoli)
     2-2 FAIL tastes_yucky(broccoli)
     2-1 REDO location(X,kitchen)
     2-1 EXIT (7) location(crackers, kitchen)
     2-2 CALL tastes_yucky(crackers)
     2-2 FAIL tastes_yucky(crackers)
     2-2 REDO location(X, kitchen)
     2-2 FAIL location(X, kitchen)
1-1 REDO where_food(X, kitchen)
1-1 FAIL where_food(X, kitchen)
      no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 5.2. Trace of a query with rules </P>

<P>It is important to understand the relationship between the first-level
and second-level variables in this query. These are independent variables,
that is, the X in the query is not the same as the X that shows up in the
body of the where_food/2 clauses, values for both happen to be equal due
to unification. </P>

<P>To better understand the relationship, we will slowly step through the
process of transferring control. Subscripts identify the variable levels.
</P>

<P>The goal in the query is </P>

<UL>
<PRE><FONT COLOR="#000080">?- where_food(X1, kitchen)</FONT><!AMZI_INDEX=  where_food/2></PRE>
</UL>

<P>The head of the first clause is </P>

<UL>
<PRE><FONT COLOR="#000080">where_food(X2, Y2)</FONT></PRE>
</UL>

<P>Remember the 'sleeps' example in chapter 3 where a query with a variable
was unified with a fact with a variable? Both variables were set to be
equal to each other. This is exactly what happens here. This might be implemented
by setting both variables to a common internal variable. If either one
takes on a new value, both take on a new value. </P>

<P>So, after unification between the goal and the head, the variable bindings
are </P>

<UL>
<PRE><FONT COLOR="#000080">X1 = _01
X2 = _01
Y2 = kitchen</FONT></PRE>
</UL>

<P>The second-level query is built from the body of the clause, using these
bindings. </P>

<UL>
<PRE><FONT COLOR="#000080">location(_01, kitchen), edible(_01).</FONT></PRE>
</UL>

<P>When internal variable _01 takes on a value, such as 'apple,' both X's
then take on the same value. This is fundamentally different from the assignment
statements that set variable values in most computer languages. </P>

<H3><A NAME="UsingRules"></A>Using Rules</H3>

<P>Using rules, we can solve the problem of the one-way doors. We can define
a new two-way predicate with two clauses, called connect/2. </P>

<UL>
<PRE><FONT COLOR="#000080">connect(X,Y) :- door(X,Y).
connect(X,Y) :- door(Y,X).</FONT></PRE>
</UL>

<P>It says &quot;Room X is connected to a room Y if there is a door from
X to Y, or if there is a door from Y to X.&quot; Note the implied 'or'
between clauses. Now connect/2 behaves the way we would like. </P>

<UL>
<PRE><FONT COLOR="#000080">?- connect(kitchen, office).<!AMZI_INDEX=  connect/2>
yes

?- connect(office, kitchen).
yes</FONT></PRE>
</UL>

<P>We can list all the connections (which is twice the number of doors)
with a general query. </P>

<UL>
<PRE><FONT COLOR="#000080">?- connect(X,Y).
X = office
Y = hall ;

X = kitchen
Y = office ;
...
X = hall
Y = office ;

X = office
Y = kitchen ;
...</FONT></PRE>
</UL>

<P>With our current understanding of rules and built-in predicates we can
now add more rules to Nani Search. We will start with look/0, which will
tell the game player where he or she is, what things are in the room, and
which rooms are adjacent. </P>

<P>To begin with, we will write list_things/1, which lists the things in
a room. It uses the technique developed at the end of chapter 4 to loop
through all the pertinent facts. </P>

<UL>
<PRE><FONT COLOR="#000080">list_things(Place) :-<!AMZI_INDEX= list_things/1>  
  location(X, Place),
  tab(2),
  write(X),
  nl,
  fail.</FONT></PRE>
</UL>

<P>We use it like this. </P>

<UL>
<PRE><FONT COLOR="#000080">?- list_things(kitchen).
  apple
  broccoli
  crackers
no</FONT></PRE>
</UL>

<P>There is one small problem with list_things/1. It gives us the list,
but it always fails. This is all right if we call it by itself, but we
won't be able to use it in conjunction with other rules that follow it
(to the right as illustrated in our diagrams). We can fix this problem
by adding a second list_things/1 clause which always succeeds. </P>

<UL>
<PRE><FONT COLOR="#000080">list_things(Place) :-
  location(X, Place),
  tab(2),
  write(X),
  nl,
  fail.
list_things(AnyPlace).</FONT></PRE>
</UL>

<P>Now when the first clause fails (because there are no more location/2s
to try) the second list_things/1 clause will be tried. Since its argument
is a variable it will successfully match with anything, causing list_things/1
to always succeed and leave through the 'exit' port. </P>

<P>As with the second clause of list_things/1, it is often the case that
we do not care what the value of a variable is, it is simply a place marker.
For these situations there is a special variable called the <B>anonymous
variable<!AMZI_INDEX= Anonymous variables; Variables, anonymous></B>, represented
as an underscore (_). For example </P>

<UL>
<PRE><FONT COLOR="#000080">list_things(_).</FONT></PRE>
</UL>

<P>Next we will write list_connections/1, which lists connecting rooms.
Since rules can refer to other rules, as well as to facts, we can write
list_connections/1 just like list_things/1 by using the connection/2 rule.
</P>

<UL>
<PRE><FONT COLOR="#000080">list_connections(Place) :-
  connect(Place, X),
  tab(2),
  write(X),
  nl,
  fail.
list_connections(_).</FONT></PRE>
</UL>

<P>Trying it gives us </P>

<UL>
<PRE><FONT COLOR="#000080">?- list_connections(hall).
  dining room
  office
yes</FONT></PRE>
</UL>

<P>Now we are ready to write look/0. The single fact here(kitchen) tells
us where we are in the game. (In chapter 7 we will see how to move about
the game by dynamically changing here/1.) We can use it with the two list
predicates to write the full look/0. </P>

<UL>
<PRE><FONT COLOR="#000080">look :-<!AMZI_INDEX=  look/0>
  here(Place),
  write('You are in the '), write(Place), nl,
  write('You can see:'), nl,
  list_things(Place),
  write('You can go to:'), nl,
  list_connections(Place).</FONT></PRE>
</UL>

<P>Given we are in the kitchen, this is how it works. </P>

<UL>
<PRE><FONT COLOR="#000080">?- look.
You are in the kitchen
You can see:
  apple
  broccoli
  crackers
You can go to:
  office
  cellar
  dining room
yes</FONT></PRE>
</UL>

<P>We now have an understanding of the fundamentals of Prolog, and it is
worth summarizing what we have learned so far. We have seen the following
about rules in Prolog. </P>

<UL>
<LI>A Prolog program is a logicbase of interrelated facts and rules. </LI>

<LI>The rules communicate with each other through unification, Prolog's
built-in pattern matcher. </LI>

<LI>The rules communicate with the user through built-in predicates such
as write/1. </LI>

<LI>The rules can be queried (called) individually from the listener. </LI>
</UL>

<P>We have seen the following about Prolog's control flow<!AMZI_INDEX=  Prolog, flow of control>.
</P>

<UL>
<LI>The execution behavior of the rules is controlled by Prolog's built-in
backtracking search mechanism. </LI>

<LI>We can force backtracking with the built-in predicate fail. </LI>

<LI>We can force success of a predicate by adding a final clause with dummy
variables as arguments and no body. </LI>
</UL>

<P>We now understand the following aspects of Prolog programming. </P>

<UL>
<LI>Facts in the logicbase (locations, doors, etc.) replace conventional
data definition. </LI>

<LI>The backtracking search (list_things/1) replaces the coding of many
looping constructs. </LI>

<LI>Passing of control through pattern matching (connect/2) replaces conditional
test and branch structures. </LI>

<LI>The rules can be tested individually, encouraging modular program development.
</LI>

<LI>Rules that call rules encourage the programming practices of procedure
abstraction and data abstraction. (For example, look/0 doesn't know how
list_things/1 works, or how the location data is stored.) </LI>
</UL>

<P>With this level of understanding, we can make a lot of progress on the
exercise applications. Take some time to work with the programs to consolidate
your understanding before moving on to the following chapters. </P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Nonsense Prolog</H4>

<P>1- Consider the following Prolog logicbase. </P>

<UL>
<PRE><FONT COLOR="#000080">a(a1,1).
a(A,2).
a(a3,N).        

b(1,b1).
b(2,B).
b(N,b3).

c(X,Y) :- a(X,N), b(N,Y).

d(X,Y) :- a(X,N), b(Y,N).
d(X,Y) :- a(N,X), b(N,Y).</FONT></PRE>
</UL>

<P>Predict the answers to the following queries, then check them with Prolog,
tracing. </P>

<UL>
<PRE><FONT COLOR="#000080">?- a(X,2).

?- b(X,kalamazoo).

?- c(X,b3).
?- c(X,Y).

?- d(X,Y).</FONT></PRE>
</UL>

<H4>Adventure Game</H4>

<P>2- Experiment with the various rules that were developed during this
chapter, tracing them all. </P>

<P>3- Write look_in/1 for Nani Search. It should list the things located
in its argument. For example, look_in(desk) should list the contents of
the desk. </P>

<H4>Genealogical Logicbase</H4>

<P>4- Build rules for the various family relationships that were developed
as queries in the last chapter. For example </P>

<UL>
<PRE><FONT COLOR="#000080">mother(M,C):-
  parent(M,C),
  female(M).</FONT></PRE>
</UL>

<P>5- Build a rule for siblings. You will probably find your rule lists
an individual as his/her own sibling. Use trace to figure out why. </P>

<P>6- We can fix the problem of individuals being their own siblings by
using the built-in predicate that succeeds if two values are unequal, and
fails if they are the same. The predicate is \=(X,Y). Jumping ahead a bit
(to operator definitions in chapter 12), we can also write it in the form
X \= Y. </P>

<P>7- Use the sibling predicate to define additional rules for brothers,
sisters, uncles, aunts, and cousins. </P>

<P>8- If we want to represent marriages in the family logicbase, we run
into the two-way door problem we encountered in Nani Search. Unlike parent/2,
which has two arguments with distinct meanings, married/2 can have the
arguments reversed without changing the meaning. </P>

<P>Using the Nani Search door/2 predicate as an example, add some basic
family data with a spouse/2 predicate. Then write the predicate married/2
using connect/2 as a model. </P>

<P>9- Use the new married predicate to add rules for uncles and aunts that
get uncles and aunts by marriage as well as by blood. You should have two
rules for each of these relationships, one for the blood case and one for
the marriage case. Use trace to follow their behavior. </P>

<P>10- Explore other relationships, such as those between in-laws. </P>

<P>11- Write a predicate for grandparent/2. Use it to find both a grandparent
and a grandchild. </P>

<UL>
<PRE><FONT COLOR="#000080">grandparent(someone, X).
grandparent(X, someone).</FONT></PRE>
</UL>

<P>Trace its behavior for both uses. Depending on how you wrote it, one
use will require many more steps than the other. Write two predicates,
one called grandparent/2 and one called grandchild/2. Order the goals in
each so that they are efficient for their intended uses. </P>

<H4>Customer Order Entry</H4>

<P>12- Write a rule item_quantity/2 that is used to find the inventory
level of a named item. This shields the user of this predicate from having
to deal with the item numbers. </P>

<P>13- Write a rule that produces an inventory report using the item_quantity/2
predicate. It should display the name of the item and the quantity on hand.
It should also always succeed. It will be similar to list_things/2. </P>

<P>14- Write a rule which defines a good customer. You might want to identify
different cases of a good customer. </P>

<H4>Expert Systems</H4>

<P>Expert systems are often called rule-based systems. The rules are &quot;rules
of thumb&quot; used by experts to solve certain problems. The expert system
includes an <B>inference engine</B>, which knows how to use the rules.
</P>

<P>There are many kinds of inference engines and knowledge representation
techniques that are used in expert systems. Prolog is an excellent language
for building any kind of expert system. However, certain types of expert
systems can be built directly using Prolog's native rules. These systems
are called <B>structured selection</B> systems. </P>

<P>The code listing for 'birds' in the appendix contains a sample system
that can be used to identify birds. You will be asked to build a similar
system in the exercises. It can identify anything, from animals to cars
to diseases. </P>

<P>15- Decide what kind of expert system you would like to build, and add
a few initial identification rules. For example, a system to identify house
pets might have these rules. </P>

<UL>
<PRE><FONT COLOR="#000080">pet(dog):- size(medium), noise(woof).
pet(cat):- size(medium), noise(meow).
pet(mouse):- size(small), noise(squeak).</FONT></PRE>
</UL>

<P>16- For now, we can use these rules by putting the known facts in the
logicbase. For example, if we add size(medium) and noise(meow) and then
pose the query pet(X) we will find X=cat. </P>

<P>Many Prologs allow clauses to be entered directly at the listener prompt,
which makes using this expert system a little easier. The presence of the
neck symbol (:-) signals to the listener that the input is a clause to
be added. So to add facts directly to the listener workspace, they must
be made into rules, as follows. </P>

<UL>
<PRE><FONT COLOR="#000080">?- size(medium) :- true.
recorded

?- noise(meow) :- true.
recorded</FONT></PRE>
</UL>

<P>Jumping ahead, you can also use assert/1 like this </P>

<UL>
<PRE><FONT COLOR="#000080">?- assert(size(medium)).
yes
?- assert(noise(meow)).
yes</FONT></PRE>
</UL>

<P>These examples use the predicates in the general form attribute(value).
In this simple example, the pet attribute is deduced. The size and noise
attributes must be given. </P>

<P>17- Improve the expert system by having it ask for the attribute/values
it can't deduce. We do this by first adding the rules </P>

<UL>
<PRE><FONT COLOR="#000080">size(X):- ask(size, X).
noise(X):- ask(noise, X).</FONT></PRE>
</UL>

<P>For now, ask/2 will simply check with the user to see if an attribute/value
pair is true or false. It will use the built-in predicate read/1 which
reads a Prolog term (ending in a period of course). </P>

<UL>
<PRE><FONT COLOR="#000080">ask(Attr, Val):-
  write(Attr),tab(1),write(Val),
  tab(1),write('(yes/no)'),write(?),
  read(X),
  X = yes.</FONT></PRE>
</UL>

<P>The last goal, X = yes, attempts to unify X and yes. If yes was read,
then it succeeds, otherwise, it fails. </P>


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
