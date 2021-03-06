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
<td><h1>11</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Lists</H2>

<P>Lists<!AMZI_INDEX=  Lists> are powerful data structures for holding
and manipulating groups of things. </P>

<P>In Prolog, a list is simply a collection of terms. The terms can be
any Prolog data types, including structures and other lists. Syntactically,
a list<!AMZI_INDEX=Lists, syntax> is denoted by square brackets with the
terms separated by commas. For example, a list of things in the kitchen
is represented as </P>

<UL>
<PRE><FONT COLOR="#000080"> [apple, broccoli, refrigerator]</FONT></PRE>
</UL>

<P>This gives us an alternative way of representing the locations of things.
Rather than having separate location predicates for each thing, we can
have one location predicate per container, with a list of things in the
container. </P>

<UL>
<PRE><FONT COLOR="#000080">loc_list([apple, broccoli, crackers], kitchen).<!AMZI_INDEX= loc_list/2>
loc_list([desk, computer], office).
loc_list([flashlight, envelope], desk).
loc_list([stamp, key], envelope).
loc_list(['washing machine'], cellar).
loc_list([nani], 'washing machine').</FONT></PRE>
</UL>

<P>There is a special list, called the empty list, which is represented
by a set of empty brackets ([]). It is also referred to as <B>nil</B>.
It can describe the lack of contents of a place or thing. </P>

<UL>
<PRE><FONT COLOR="#000080">loc_list([], hall)</FONT></PRE>
</UL>

<P>Unification works on lists<!AMZI_INDEX=   Unification, lists> just as
it works on other data structures. With what we now know about lists we
can ask </P>

<UL>
<PRE><FONT COLOR="#000080">?- loc_list(X, kitchen).
X = [apple, broccoli, crackers] 

?- [_,X,_] = [apples, broccoli, crackers].
X = broccoli </FONT></PRE>
</UL>

<P>This last example is an impractical method of getting at list elements,
since the patterns won't unify unless both lists have the same number of
elements. </P>

<P>For lists to be useful, there must be easy ways to access, add, and
delete list elements. Moreover, we should not have to concern ourselves
about the number of list items, or their order. </P>

<P>Two Prolog features enable us to accomplish this easy access. One is
a special notation that allows reference to the first element of a list
and the list of remaining elements, and the other is recursion. </P>

<P>These two features allow us to write list utility predicates, such as
member/2, which finds members of a list, and append/3, which joins two
lists together. List predicates all follow a similar strategy--try something
with the first element of a list, then recursively repeat the process on
the rest of the list. </P>

<P>First, the special notation for list structures. </P>

<UL>
<PRE><FONT COLOR="#000080"> [X | Y]</FONT></PRE>
</UL>

<P>When this structure is unified with a list, X is bound to the first
element of the list, called the <B>head<!AMZI_INDEX= Lists, head></B>.
Y is bound to the list of remaining elements, called the <B>tail<!AMZI_INDEX= Lists, tail></B>.
</P>

<P>We will now look at some examples of unification using lists. The following
example successfully unifies because the two structures are syntactically
equivalent. Note that the tail is a list. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [a|[b,c,d]] = [a,b,c,d].<!AMZI_INDEX= =/2>
yes</FONT></PRE>
</UL>

<P>This next example fails because of misuse of the bar (|) symbol. What
follows the bar must be a single term, which for all practical purposes
must be a list. The example incorrectly has three terms after the bar.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- [a|b,c,d] = [a,b,c,d].
no</FONT></PRE>
</UL>

<P>Here are some more examples. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [H|T] = [apple, broccoli, refrigerator].
H = apple
T = [broccoli, refrigerator] 

?- [H|T] = [a, b, c, d, e].
H = a
T = [b, c, d, e] 

?- [H|T] = [apples, bananas].
H = apples
T = [bananas] </FONT></PRE>
</UL>

<P>In the previous and following examples, the tail is a list with one
element. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [H|T] = [a, [b,c,d]].
H = a
T = [[b, c, d]] </FONT></PRE>
</UL>

<P>In the next case, the tail is the empty list. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [H|T] = [apples].
H = apples
T = [] </FONT></PRE>
</UL>

<P>The empty list<!AMZI_INDEX= Lists, empty> does not unify with the standard
list syntax because it has no head. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [H|T] = [].
no</FONT></PRE>
</UL>

<P>NOTE: This last failure is important, because it is often used to test
for the boundary condition<!AMZI_INDEX= Boundary condition> in a recursive
routine. That is, as long as there are elements in the list, a unification
with the [X|Y] pattern will succeed. When there are no elements in the
list, that unification fails, indicating that the boundary condition applies.
</P>

<P>We can specify more than just the first element before the bar (|).
In fact, the only rule is that what follows it should be a list. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [One, Two | T] = [apple, sprouts, fridge, milk].
One = apple
Two = sprouts
T = [fridge, milk] </FONT></PRE>
</UL>

<P>Notice in the next examples how each of the variables is bound to a
structure that shows the relationships between the variables. The internal
variable numbers indicate how the variables are related. In the first example
Z, the tail of the right-hand list, is unified with [Y|T]. In the second
example T, the tail of the left-hand list is unified with [Z]. In both
cases, Prolog looks for the most general way to relate or bind the variables.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- [X,Y|T] = [a|Z].
X = a
Y = _01
T = _03
Z = [_01 | _03] 

?- [H|T] = [apple, Z].
H = apple
T = [_01]
Z = _01 </FONT></PRE>
</UL>

<P>Study these last two examples carefully, because list unification is
critical in building list utility predicates. </P>

<P>A list can be thought of as a head and a tail list, whose head is the
second element and whose tail is a list whose head is the third element,
and so on. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [a|[b|[c|[d|[]]]]] = [a,b,c,d].
yes</FONT></PRE>
</UL>

<P>We have said a list is a special kind of structure. In a sense it is,
but in another sense it is just like any other Prolog term. The last example
gives us some insight into the true nature of the list. It is really an
ordinary two-argument predicate. The first argument is the head and the
second is the tail. If we called it dot/2, then the list [a,b,c,d] would
be </P>

<UL>
<PRE><FONT COLOR="#000080">dot(a,dot(b,dot(c,dot(d,[]))))</FONT><!AMZI_INDEX= dot/2></PRE>
</UL>

<P>In fact, the predicate does exist, at least conceptually, and it is
called dot, but it is represented by a period (.) instead of dot. </P>

<P>To see the dot notation<!AMZI_INDEX=  Lists, dot notation>, we use the
built-in predicate display/1<!AMZI_INDEX= display/1>, which is similar
to write/1, except it always uses the dot syntax for lists when it writes
to the console. </P>

<UL>
<PRE><FONT COLOR="#000080">?- X = [a,b,c,d], write(X), nl, display(X), nl.
 [a,b,c,d]
.(a,.(b,.(c,.d(,[]))))

?- X = [Head|Tail], write(X), nl, display(X), nl.
 [_01, _02]
.(_01,_02)

?- X = [a,b,[c,d],e], write(X), nl, display(X), nl.
 [a,b,[c,d],e]
.(a,.(b,.(.(c,.(d,[])),.(e,[]))))</FONT></PRE>
</UL>

<P>From these examples it should be clear why there is a different syntax
for lists. The easier syntax makes for easier reading, but sometimes obscures
the behavior of the predicate. It helps to keep this &quot;real&quot; structure
of lists in mind when working with predicates that manipulate lists. </P>

<P>This structure of lists<!AMZI_INDEX= Lists, and recursion> is well-suited
for the writing of recursive routines. The first one we will look at is
member/2, which determines whether or not a term is a member of a list.
</P>

<P>As with most recursive predicates, we will start with the boundary condition,
or the simple case. An element is a member of a list if it is the head
of the list. </P>

<UL>
<PRE><FONT COLOR="#000080">member(H,[H|T]).</FONT></PRE>
</UL>

<P>This clause also illustrates how a fact with variable arguments acts
as a rule. </P>

<P>The second clause of member/2<!AMZI_INDEX=  member/2> is the recursive
rule. It says an element is a member of a list if it is a member of the
tail of the list. </P>

<UL>
<PRE><FONT COLOR="#000080">member(X,[H|T]) :- member(X,T).</FONT></PRE>
</UL>

<P>The full predicate is </P>

<UL>
<PRE><FONT COLOR="#000080">member(H,[H|T]).
member(X,[H|T]) :- member(X,T).</FONT></PRE>
</UL>

<P>Note that both clauses of member/2 expect a list as the second argument.
Since T in [H|T] in the second clause is itself a list, the recursive call
to member/2 works. </P>

<UL>
<PRE><FONT COLOR="#000080">?- member(apple, [apple, broccoli, crackers]).
yes

?- member(broccoli, [apple, broccoli, crackers]).
yes

?- member(banana, [apple, broccoli, crackers]).
no</FONT></PRE>
</UL>

<P>Figure 11.1 has a full annotated trace of member/2<!AMZI_INDEX= member/2, example trace of>.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- member(b, [a,b,c]).

1-1 CALL member(b,[a,b,c])</FONT></PRE>

<P>The goal pattern fails to unify with the head of the first clause of
member/2, because the pattern in the head of the first clause calls for
the head of the list and first argument to be identical. The goal pattern
can unify with the head of the second clause.</P>

<PRE><FONT COLOR="#000080">1-1 try (2) member(b,[a,b,c])</FONT></PRE>

<P>The second clause recursively calls another copy of member/2.</P>

<PRE><FONT COLOR="#000080">    2-1 CALL member(b,[b,c])</FONT></PRE>

<P>It succeeds because the call pattern unifies with the head of the first
clause.</P>

<PRE><FONT COLOR="#000080">    2-1 EXIT (1) member(b,[b,c]) </FONT></PRE>

<P>The success ripples back to the outer level.</P>

<PRE><FONT COLOR="#000080">1-1 EXIT (2) member(b,[a,b,c]) 
     yes</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 11.1. Trace of member/2 </P>

<P>As with many Prolog predicates, member/2 can be used in multiple ways.
If the first argument is a variable, member/2 will, on backtracking, generate
all of the terms in a given list. </P>

<UL>
<PRE><FONT COLOR="#000080">?- member(X, [apple, broccoli, crackers]).
X = apple ;
X = broccoli ;
X = crackers ;
no</FONT></PRE>
</UL>

<P>We will now trace this use of member/2 using the internal variables.
Remember that each level has its own unique variables, but that they are
tied together based on the unification patterns between the goal at one
level and the head of the clause on the next level. </P>

<P>In this case the pattern is simple in the recursive clause of member.
The head of the clause unifies X with the first argument of the original
goal, represented by _0 in the following trace. The body has a call to
member/2 in which the first argument is also X, therefore causing the next
level to unify with the same _0. </P>

<P>Figure 11.2 has the trace<!AMZI_INDEX= member/2, example trace of>.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- member(X,[a,b,c]).</FONT></PRE>

<P>The goal succeeds by unification with the head of the first clause,
if X = a.</P>

<PRE><FONT COLOR="#000080">1-1 CALL member(_0,[a,b,c]) 
1-1 EXIT (1) member(a,[a,b,c]) 
    X = a ;</FONT></PRE>

<P>Backtracking unbinds the variable and the second clause is tried.</P>

<PRE><FONT COLOR="#000080">1-1 REDO member(_0,[a,b,c]) 
1-1 try (2) member(_0,[a,b,c])</FONT></PRE>

<P>It succeeds on the second level, just as on the first level.</P>

<PRE><FONT COLOR="#000080">    2-1 CALL member(_0,[b,c]) 
    2-1 EXIT (1) member(b,[b,c]) 
1-1 EXIT  member(b,[a,b,c]) 
    X = b ;</FONT></PRE>

<P>Backtracking continues onto the third level, with similar results.</P>

<PRE><FONT COLOR="#000080">    2-1 REDO member(_0,[b,c]) 
    2-1 try (2) member(_0,[b,c])
        3-1 CALL member(_0,[c]) 
        3-1 EXIT (1) member(c,[c]) 
    2-1 EXIT (2) member(c,[b,c]) 
1-1 EXIT (2) member(c,[a,b,c]) 
    X = c ;</FONT></PRE>

<P>Further backtracking causes an attempt to find a member of the empty
list. The empty list does not unify with either of the list patterns in
the member/2 clauses, so the query fails back to the beginning.</P>

<PRE><FONT COLOR="#000080">        3-1 REDO member(_0,[c]) 
        3-1 try (2) member(_0,[c])
            4-1 CALL member(_0,[])
            4-1 FAIL member(_0,[])
        3-1 FAIL member(_0,[c])
    2-1 FAIL member(_0,[b,c])
1-1 FAIL member(_0,[a,b,c])
     no</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 11.2. Trace of member/2 generating elements of a list </P>

<P>Another very useful list predicate builds lists from other lists or
alternatively splits lists into separate pieces. This predicate is usually
called append/3<!AMZI_INDEX= append/3>. In this predicate the second argument
is appended to the first argument to yield the third argument. For example
</P>

<UL>
<PRE><FONT COLOR="#000080">?- append([a,b,c],[d,e,f],X).
X = [a,b,c,d,e,f]</FONT></PRE>
</UL>

<P>It is a little more difficult to follow, since the basic strategy of
working from the head of the list does not fit nicely with the problem
of adding something to the end of a list. append/3 solves this problem
by reducing the first list recursively. </P>

<P>The boundary condition states that if a list X is appended to the empty
list, the resulting list is also X. </P>

<UL>
<PRE><FONT COLOR="#000080">append([],X,X).</FONT></PRE>
</UL>

<P>The recursive condition states that if list X is appended to list [H|T1],
then the head of the new list is also H, and the tail of the new list is
the result of appending X to the tail of the first list. </P>

<UL>
<PRE><FONT COLOR="#000080">append([H|T1],X,[H|T2]) :-
  append(T1,X,T2).</FONT></PRE>
</UL>

<P>The full predicate is </P>

<UL>
<PRE><FONT COLOR="#000080">append([],X,X).
append([H|T1],X,[H|T2]) :-
  append(T1,X,T2).</FONT></PRE>
</UL>

<P>Real Prolog magic is at work here, which the trace alone does not reveal.
At each level, new variable bindings are built, that are unified with the
variables of the previous level. Specifically, the third argument in the
recursive call to append/3 is the tail of the third argument in the head
of the clause. These variable relationships are included at each step in
the annotated trace shown in Figure 11.3<!AMZI_INDEX= append/3, example trace of>.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- append([a,b,c],[d,e,f],X).</FONT></PRE>

<PRE><FONT COLOR="#000080">1-1 CALL append([a,b,c],[d,e,f],_0)
    X = _0
    2-1 CALL append([b,c],[d,e,f],_5)
        _0 = [a|_5]
        3-1 CALL append([c],[d,e,f],_9)
            _5 = [b|_9]
            4-1 CALL append([],[d,e,f],_14)
                _9 = [c|_14]</FONT></PRE>

<P>By making all the substitutions of the variable relationships, we can
see that at this point X is bound as follows (thinking in terms of the
dot notation for lists might make append/3 easier to understand).</P>

<UL>
<PRE><FONT COLOR="#000080">X = [a|[b|[c|_14]]]</FONT></PRE>
</UL>

<P>We are about to hit the boundary condition, as the first argument has
been reduced to the empty list. Unifying with the first clause of append/3
will bind _14 to a value, namely [d,e,f], thus giving us the desired result
for X, as well as all the other intermediate variables. Notice the bound
third arguments at each level, and compare them to the variables in the
call ports above.</P>

<PRE><FONT COLOR="#000080">            4-1 EXIT (1) append([],[d,e,f],[d,e,f])
        3-1 EXIT (2) append([c],[d,e,f],[c,d,e,f])
    2-1 EXIT (2) append([b,c],[d,e,f],[b,c,d,e,f])
1-1 EXIT (2)append([a,b,c],[d,e,f],[a,b,c,d,e,f])
    X = [a,b,c,d,e,f] </FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 11.3. Trace of append/3 </P>

<P>Like member/2, append/3 can also be used in other ways, for example,
to break lists apart as follows. </P>

<UL>
<PRE><FONT COLOR="#000080">?- append(X,Y,[a,b,c]).<!AMZI_INDEX= append/3 >
X = []
Y = [a,b,c] ;

X = [a]
Y = [b,c] ;

X = [a,b]
Y = [c] ;

X = [a,b,c]
Y = [] ;
no</FONT></PRE>
</UL>

<H3><A NAME="UsingTheListUtilities"></A>Using the
List Utilities</H3>

<P>Now that we have tools for manipulating lists, we can use them. For
example, if we choose to use loc_list/2 instead of location/2 for storing
things, we can write a new location/2 that behaves exactly like the old
one, except that it computes the answer rather than looking it up. This
illustrates the sometimes fuzzy line between data and procedure. The rest
of the program cannot tell how location/2 gets its results, whether as
data or by computation. In either case it behaves the same, even on backtracking.
</P>

<UL>
<PRE><FONT COLOR="#000080">location(X,Y):-<!AMZI_INDEX= location/2>  
  loc_list(List, Y),
  member(X, List).</FONT></PRE>
</UL>

<P>In the game, it will be necessary to add things to the loc_lists whenever
something is put down in a room. We can write add_thing/3 which uses append/3.
If we call it with NewThing and Container, it will provide us with the
NewList. </P>

<UL>
<PRE><FONT COLOR="#000080">add_thing(NewThing, Container, NewList):-<!AMZI_INDEX= add_thing/3>  
  loc_list(OldList, Container),
  append([NewThing],OldList, NewList).</FONT></PRE>
</UL>

<P>Testing it gives </P>

<UL>
<PRE><FONT COLOR="#000080">?- add_thing(plum, kitchen, X).
X = [plum, apple, broccoli, crackers]</FONT></PRE>
</UL>

<P>However, this is a case where the same effect can be achieved through
unification and the [Head|Tail] list notation. </P>

<UL>
<PRE><FONT COLOR="#000080">add_thing2(NewThing, Container, NewList):-<!AMZI_INDEX= add_thing2/3> 
  loc_list(OldList, Container),
  NewList = [NewThing | OldList].</FONT></PRE>
</UL>

<P>It works the same as the other one. </P>

<UL>
<PRE><FONT COLOR="#000080">?- add_thing2(plum, kitchen, X).
X = [plum, apple, broccoli, crackers]</FONT></PRE>
</UL>

<P>We can simplify it one step further by removing the explicit unification<!AMZI_INDEX= Unification, explicit>,
and using the implicit unification<!AMZI_INDEX= Unification, implicit>
that occurs at the head of a clause, which is the preferred form for this
type of predicate. </P>

<UL>
<PRE><FONT COLOR="#000080">add_thing3(NewTh, Container,[NewTh|OldList]) :-
  loc_list(OldList, Container).</FONT></PRE>
</UL>

<P>It also works the same. </P>

<UL>
<PRE><FONT COLOR="#000080">?- add_thing3(plum, kitchen, X).
X = [plum, apple, broccoli, crackers]</FONT></PRE>
</UL>

<P>In practice, we might write put_thing/2 directly without using the separate
add_thing/3 predicate to build a new list for us. </P>

<UL>
<PRE><FONT COLOR="#000080">put_thing(Thing,Place) :-
  retract(loc_list(List, Place)),
  asserta(loc_list([Thing|List],Place)).</FONT></PRE>
</UL>

<P>Whether you use multiple logicbase entries or lists for situations, such
as we have with locations of things, is largely a matter of style. Your
experience will lead you to one or the other in different situations. Sometimes
backtracking over multiple predicates is a more natural solution to a problem
and sometimes recursively dealing with a list is more natural.<!AMZI_INDEX= Backtracking, versus recursion; Recursion, versus backtracking>
</P>

<P>You might find that some parts of a particular application fit better
with multiple facts in the logicbase and other parts fit better with lists.
In these cases it is useful to know how to go from one format to the other.
</P>

<P>Going from a list to multiple facts is simple<!AMZI_INDEX= Lists, converting to facts>.
You write a recursive routine that continually asserts the head of the
list. In this example we create individual facts in the predicate stuff/1.
</P>

<UL>
<PRE><FONT COLOR="#000080">break_out([]).<!AMZI_INDEX= break_out/1>
break_out([Head | Tail]):-
  assertz(stuff(Head)),
  break_out(Tail).</FONT></PRE>
</UL>

<P>Here's how it works. </P>

<UL>
<PRE><FONT COLOR="#000080">?- break_out([pencil, cookie, snow]).
yes

?- stuff(X).
X = pencil ;
X = cookie ;
X = snow ;
no</FONT></PRE>
</UL>

<P>Transforming multiple facts into a list is more difficult. For this
reason most Prologs provide built-in predicates that do the job. The most
common one is findall/3. The arguments are </P>

<DL>
<DL>
<DT>arg1 </DT>

<DD>A pattern for the terms in the resulting list </DD>

<DT>arg2</DT>

<DD>A goal pattern </DD>

<DT>arg3 </DT>

<DD>The resulting list </DD>
</DL>
</DL>

<P>findall/3<!AMZI_INDEX= findall/3> automatically does a full backtracking
search of the goal pattern and stores each result in the list. It can recover
our stuff/1 back into a list. </P>

<UL>
<PRE><FONT COLOR="#000080">?- findall(X, stuff(X), L).
L = [pencil, cookie, snow]</FONT></PRE>
</UL>

<P>Fancier patterns are available. This is how to get a list of all the
rooms connecting to the kitchen. </P>

<UL>
<PRE><FONT COLOR="#000080">?- findall(X, connect(kitchen, X), L).
L = [office, cellar, 'dining room']</FONT></PRE>
</UL>

<P>The pattern in the first argument can be even fancier and the second
argument can be a conjunction of goals. Parentheses are used to group the
conjunction of goals in the second argument, thus avoiding the potential
ambiguity. Here findall/3 builds a list of structures that locates the
edible things. </P>

<UL>
<PRE><FONT COLOR="#000080">?- findall(foodat(X,Y), (location(X,Y) , edible(X)), L).
L = [foodat(apple, kitchen), foodat(crackers, kitchen)]</FONT></PRE>
</UL>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>List Utilities</H4>

<P>1- Write list utilities that perform the following functions. </P>

<UL>
<LI>Remove a given element from a list </LI>

<LI>Find the element after a given element </LI>

<LI>Split a list into two lists at a given element (Hint - append/3 is
close.) </LI>

<LI>Get the last element of a list </LI>

<LI>Count the elements in a list (Hint - the length of the empty list is
0, the length a non-empty list is 1 + the length of its tail.) </LI>
</UL>

<P>2- Because write/1 only takes a single argument, multiple 'writes' are
necessary for writing a mixed string of text and variables. Write a list
utility respond/1 which takes as its single argument a list of terms to
be written. This can be used in the game to communicate with the player.
For example </P>

<UL>
<PRE><FONT COLOR="#000080">respond(['You can''t get to the', Room, 'from here'])</FONT></PRE>
</UL>

<P>3- Lists with a variable tail are called open lists. They have some
interesting properties. For example, member/2 can be used to add items
to an open list. Experiment with and trace the following queries. </P>

<UL>
<PRE><FONT COLOR="#000080">?- member(a,X).
?- member(b, [a,b,c|X]).
?- member(d, [a,b,c|X]).
?- OpenL = [a,b,c|X], member(d, OpenL), write(OpenL).</FONT></PRE>
</UL>

<H4>Nonsense Prolog</H4>

<P>4- Predict the results of the following queries. </P>

<UL>
<PRE><FONT COLOR="#000080">?- [a,b,c,d] = [H|T].
?- [a,[b,c,d]] = [H|T].
?- [] = [H|T].
?- [a] = [H|T].
?- [apple,3,X,'What?'] = [A,B|Z].
?- [[a,b,c],[d,e,f],[g,h,i]] = [H|T].
?- [a(X,c(d,Y)), b(2,3), c(d,Y)] = [H|T].</FONT></PRE>
</UL>

<H4>Genealogical Logicbase</H4>

<P>5- Consider the following Prolog program </P>

<UL>
<PRE><FONT COLOR="#000080">parent(p1,p2).
parent(p2,p3).
parent(p3,p4).
parent(p4,p5).

ancestor(A,D,[A]) :- parent(A,D).
ancestor(A,D,[X|Z]) :-
        parent(X,D),
        ancestor(A,X,Z).</FONT></PRE>
</UL>

<P>6- What is the purpose of the third argument to ancestor? </P>

<P>7- Predict the response to the following queries. Check by tracing in
Prolog. </P>

<UL>
<PRE><FONT COLOR="#000080">?- ancestor(a2,a3,X).
?- ancestor(a1,a5,X).
?- ancestor(a5,a1,X).
?- ancestor(X,a5,Z).</FONT></PRE>
</UL>

<H4>Expert System</H4>

<P>8- Lists provide a convenient way to provide a simple menu capability
to our expert system. We can replace the 'ask' predicate with menuask/3
where appropriate. menuask/3 will ask the player to select an item from
a menu. The format is </P>

<UL>
<PRE><FONT COLOR="#000080">menuask(Attribute, Value, List_of_Choices).</FONT></PRE>
</UL>

<P>For example </P>

<UL>
<PRE><FONT COLOR="#000080">size(X):- menuask(size, X, [large, medium, small]).</FONT></PRE>
</UL>

<P>This requires two intermediate predicates, menu_display/2 and menu_select/2.
The first writes each choice on a separate line preceded by a unique number.
The second uses a number entered by the user to return the &quot;nth&quot;
element of the list. </P>


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
