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
<td><h1>14</h1></td>
<td style="text-align:right;">

</td>
</tr></table><hr />

<H2>Control Structures</H2>

<P>We have examined the manner in which Prolog<!AMZI_INDEX= Prolog, flow of control; Backtracking>
interprets goals and have also seen examples of how to manipulate Prolog's
execution behavior. </P>

<P>In this chapter we will further explore the control structures you can
implement in Prolog and draw parallels between them and the control structures
found in more conventional programming languages. </P>

<P>You have already used the combination of fail and write/1 to generate
lists of things for the game. This control structure is similar to 'do
while' found in most languages. </P>

<P>We will now introduce another built-in predicate that allows us to capitalize
on failure. It is repeat/0<!AMZI_INDEX= repeat/0>. It always succeeds the
first time it is called, and it always succeeds on backtracking<!AMZI_INDEX= Backtracking, and repeat/0>.
In other words, you can not backtrack through a repeat/0. It always restarts
forward execution. </P>

<P><IMG SRC="advfig10.gif" HEIGHT=76 WIDTH=193></P>

<P>Figure 14.1. Flow of control in the repeat/0 built-in predicate </P>

<P>A clause body with a repeat/0 followed by fail/0 will go back and forth
forever. This is one way to write an endless loop<!AMZI_INDEX= Loops, endless>
in Prolog. </P>

<P>A repeat/0 followed by some intermediate goals followed by a test condition
will loop<!AMZI_INDEX= Loops> until the test condition is satisfied. It
is equivalent to a 'do until' in other languages. This is exactly the behavior
we want for the highest command loop in Nani Search. </P>

<P>Our first version of command_loop/0 will simply read commands and echo
them until end is entered. The built-in predicate read/1 reads a Prolog
term from the console. The term must be followed by a period. </P>

<UL>
<PRE><FONT COLOR="#000080">command_loop:-<!AMZI_INDEX= command_loop/0>  
  repeat,
  write('Enter command (end to exit): '),
  read(X),
  write(X), nl,
  X = end.</FONT></PRE>
</UL>

<P>The last goal will fail unless end is entered. The repeat/0 always succeeds
on backtracking and causes the intermediate goals to be re-executed. </P>

<P>We can execute it by entering this query. </P>

<UL>
<PRE><FONT COLOR="#000080">?- command_loop.</FONT></PRE>
</UL>

<P>Now that the control structure is in place, we can have it execute the
command, rather than just repeat it. </P>

<P>We will write a new predicate called do/1, which executes only the commands
we allow. Many other languages have 'do case' control structures that perform
this kind of function. Multiple clauses in a Prolog predicate behave similarly
to a 'do case.' </P>

<P>Here is do/1. Notice that it allows us to define synonyms for commands,
that is, the player can enter either goto(X) or go(X) to cause the goto/1
predicate to be executed. </P>

<UL>
<PRE><FONT COLOR="#000080">do(goto(X)):-goto(X),!.<!AMZI_INDEX= do/1>
do(go(X)):-goto(X),!.
do(inventory):-inventory,!.
do(look):-look,!.</FONT></PRE>
</UL>

<P>NOTE: The cut serves two purposes. First, it says once we have found
a 'do' clause to execute, don't bother looking for anymore. Second, it
prevents the backtracking initiated at the end of command_loop from entering
the other command predicates. </P>

<P>Here are some more do/1's. If do(end) did not always succeed, we would
never get to the' X = end' test and would fail forever. The last do/1 allows
us to tell the user there was something wrong with the command. </P>

<UL>
<PRE><FONT COLOR="#000080">do(take(X)) :- take(X), !.
do(end).
do(_) :-
  write('Invalid command').</FONT></PRE>
</UL>

<P>We can now rewrite command_loop/0 to use the new do/1 and incorporate
puzzle/1 in the command loop. We will also replace the old simple test
for end with a new predicate, end_condition/1, that will determine if the
game is over. </P>

<UL>
<PRE><FONT COLOR="#000080">command_loop:-<!AMZI_INDEX= command_loop/0> 
  write('Welcome to Nani Search'), nl,
  repeat,
  write('&gt;nani&gt; '),
  read(X),
  puzzle(X),
  do(X), nl,
  end_condition(X).</FONT></PRE>
</UL>

<P>Two conditions might end the game. The first is if the player types
'end.' The second is if the player has successfully taken the Nani. </P>

<UL>
<PRE><FONT COLOR="#000080">end_condition(end).
end_condition(_) :-
  have(nani),
  write('Congratulations').</FONT></PRE>
</UL>

<P>The game can now be played from the top. </P>

<UL>
<PRE><FONT COLOR="#000080">?- command_loop.

Welcome to ...</FONT></PRE>
</UL>

<H3><A NAME="RecursiveControlLoop"></A>Recursive
Control Loop</H3>

<P>As hinted at in chapter 7, the purity of logic programming is undermined
by the asserts and retracts of the logicbase. Just like global data in any
language, predicates that are dynamically asserted and retracted can make
for unpredictable code. That is, code in one part of the system that uses
a dynamic predicate is affected by code in an entirely different part that
changes that dynamic predicate. </P>

<P>For example, puzzle(goto(cellar)) succeeds or fails based on the existence
of turned_on(flashlight) which is asserted by the turn_on/1 predicate.
A bug in turn_on/1 will cause puzzle/1 to behave incorrectly. </P>

<P>The entire game can be reconstructed using arguments and no global data.
To do this, it helps to think of the game as a sequence of state transformations.
</P>

<P>In the current implementation, the state of the game is defined by the
dynamic predicates location/2, here/1, have/1, and turned_on/1 or turned_off/1
for the flashlight. These predicates define an initial state which is dynamically
changed, using assert and retract, as the player moves through the game
toward the winning state, which is defined by the existence of have(nani).
</P>

<P>We can get the same effect by defining a complex structure to hold the
state, implementing game commands that access that state as an argument,
rather than from dynamic facts in the logicbase. </P>

<P>Because logical variables cannot have their values changed by assignment,
the commands must take two arguments representing the old state and the
new state. The repeat-fail control structure will not let us repeatedly
change the state in this manner, so we need to write a recursive<!AMZI_INDEX= Loops, recursive>
control structure that recursively sends the new state to itself. The boundary
condition is reaching the ending state of the game. This control structure
is shown in figure 14.1, which contains an abbreviated version of Nani
Search. </P>

<P>The state is represented by a list of structures holding different types
of state information, as seen in initial_state/1. The various commands
in this type of game need to access and manipulate that state structure.
Rather than require each predicate that accesses the state to understand
its complex structure, the utility predicates get_state/3, add_state/4,
and del_state/4 are written to access it. This way any program changes
to the state structure only require changes to the utility predicates.
</P>

<P>This style of Prolog programming is logically purer, and lends itself
to certain types of applications. It also avoids the difficulties often
associated with global data. On the other hand, it requires more complexity
in dealing with state information in arguments, and the multiple lists
and recursive routines can be confusing to debug. You will have to decide
which approach to use for each application you write. </P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">/*      a nonassertive version of nani search */

nani :-
  write('Welcome to Nani Search'),
  nl,
  initial_state(State),
  control_loop(State).

control_loop(State) :-
  end_condition(State).
control_loop(State) :-
  repeat,
  write('&gt; '),
  read(X),
  constraint(State, X),
  do(State, NewState, X),
  control_loop(NewState).

/* initial dynamic state */

initial_state([
here(kitchen),
have([]),
location([
        kitchen/apple,
        kitchen/broccoli,
        office/desk,
        office/flashlight,
        cellar/nani ]),
status([
        flashlight/off,
        game/on]) ]).

/* static state */

rooms([office, kitchen, cellar]).

doors([office/kitchen, cellar/kitchen]).

connect(X,Y) :-
  doors(DoorList),
  member(X/Y, DoorList).
connect(X,Y) :-
  doors(DoorList),
  member(Y/X, DoorList).

/* list utilities */

member(X,[X|Y]).
member(X,[Y|Z]) :- member(X,Z).

delete(X, [], []).
delete(X, [X|T], T).
delete(X, [H|T], [H|Z]) :- delete(X, T, Z).

/* state manipulation utilities */

get_state(State, here, X) :-
  member(here(X), State).
get_state(State, have, X) :-
  member(have(Haves), State),
  member(X, Haves).
get_state(State, location, Loc/X) :-
  member(location(Locs), State),
  member(Loc/X, Locs).
get_state(State, status, Thing/Stat) :-
  member(status(Stats), State),
  member(Thing/Stat, Stats).

del_state(OldState, [location(NewLocs) | Temp], location, Loc/X):-
  delete(location(Locs), OldState, Temp),
  delete(Loc/X, Locs, NewLocs).

add_state(OldState, [here(X)|Temp], here, X) :-
  delete(here(_), OldState, Temp).
add_state(OldState, [have([X|Haves])|Temp], have, X) :-
  delete(have(Haves), OldState, Temp).
add_state(OldState, [status([Thing/Stat|TempStats])|Temp],
status, Thing/Stat) :-
  delete(status(Stats), OldState, Temp),
  delete(Thing/_, Stats, TempStats).

/* end condition */

end_condition(State) :-
  get_state(State, have, nani),
  write('You win').
end_condition(State) :-
  get_state(State, status, game/off),
  write('quitter').

/* constraints and puzzles together */

constraint(State, goto(cellar)) :-
  !, can_go_cellar(State).
constraint(State, goto(X)) :-
  !, can_go(State, X).
constraint(State, take(X)) :-
  !, can_take(State, X).
constraint(State, turn_on(X)) :-
  !, can_turn_on(State, X).
constraint(_, _).

can_go(State,X) :-
  get_state(State, here, H),
  connect(X,H).
can_go(_, X) :-
  write('You can''t get there from here'),
  nl, fail.

can_go_cellar(State) :-
  can_go(State, cellar),
  !, cellar_puzzle(State).

cellar_puzzle(State) :-
  get_state(State, have, flashlight),
  get_state(State, status, flashlight/on).
cellar_puzzle(_) :-
  write('It''s dark in the cellar'),
  nl, fail.

can_take(State, X) :-
  get_state(State, here, H),
  get_state(State, location, H/X).
can_take(State, X) :-
  write('it is not here'),
  nl, fail.

can_turn_on(State, X) :-
  get_state(State, have, X).
can_turn_on(_, X) :-
  write('You don''t have it'),
  nl, fail.

/* commands */ 

do(Old, New, goto(X)) :- goto(Old, New, X), !.
do(Old, New, take(X)) :- take(Old, New, X), !.
do(Old, New, turn_on(X)) :- turn_on(Old, New, X), !.
do(State, State, look) :- look(State), !.
do(Old, New, quit) :- quit(Old, New).
do(State, State, _) :-
  write('illegal command'), nl.

look(State) :-
  get_state(State, here, H),
  write('You are in '), write(H),
  nl,
  list_things(State, H), nl.

list_things(State, H) :-
  get_state(State, location, H/X),
  tab(2), write(X),
  fail.
list_things(_, _).

goto(Old, New, X) :-
  add_state(Old, New, here, X),
  look(New).

take(Old, New, X) :-
  get_state(Old, here, H),
  del_state(Old, Temp, location, H/X),
  add_state(Temp, New, have, X).

turn_on(Old, New, X) :-
  add_state(Old, New, status, X/on).

quit(Old, New) :-
  add_state(Old, New, status, game/off).</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 14.1. Nani Search without dynamic facts </P>

<P>There could be serious performance problems with this approach to the
game. Prolog uses a stack to keep track of the levels of predicate calls.
In the case of a recursive predicate, the stack grows at each recursive
call.<!AMZI_INDEX= Recursion, performance considerations> In this example,
with its complex arguments, the stack could easily be consumed in a shortperiod
of time by the recursive control structure. </P>

<P>Fortunately, there is a performance feature built into Prolog that makes
this example program, and ones similar to it, behave efficiently. </P>

<H3><A NAME="TailRecursion"></A>Tail Recursion<!AMZI_INDEX= Recursion, tail; Tail recursion></H3>

<P>There are actually two kinds of recursive routines. In a true recursive
routine, each level must wait for the information from the lower levels
in order to return an answer. This means that Prolog must build a stack
with a new entry for each level. </P>

<P>This is in contrast to iteration, which is more common in conventional
languages. Each pass through the iteration updates the variables and there
is no need for building a stack. </P>

<P>There is a type of recursion called <B>tail recursion</B> that, while
written recursively, behaves iteratively. In general, if the recursive
call is the last call, and there are no computations based on the information
from the lower levels, then a good Prolog can implement the predicate iteratively,
without growing the stack. </P>

<P>One classic example of tail recursion is the factorial predicate. First
we'll write it using normal recursion. Note that the variable FF, which
is returned from the lower level, is used in the top level. </P>

<UL>
<PRE><FONT COLOR="#000080">factorial_1(1,1).
factorial_1(N,F):-
  N &gt; 1,
  NN is N - 1,
  factorial_1(NN,FF),
  F is N * FF.</FONT></PRE>
</UL>

<P>It works as expected. </P>

<UL>
<PRE><FONT COLOR="#000080">?- factorial_1(5,X).
X = 120</FONT></PRE>
</UL>

<P>By introducing a new second argument to keep track of the result so
far, we can rewrite factorial/3 tail-recursively. The new argument is initially
set to 1. Each recursive call builds on the second argument. When the boundary
condition is reached, the third argument is bound to the second argument.
</P>

<UL>
<PRE><FONT COLOR="#000080">factorial_2(1,F,F).
factorial_2(N,T,F):-
  N &gt; 1,
  TT is N * T,
  NN is N - 1,
  factorial_2(NN,TT,F).</FONT></PRE>
</UL>

<P>It gives the same results as the previous version, but because the recursive
call is the last call in the second clause, its arguments are not needed
at each level. </P>

<UL>
<PRE><FONT COLOR="#000080">?- factorial_2(5,1,X).
X = 120</FONT></PRE>
</UL>

<P>Another classic example of tail recursion is the predicate to reverse
a list. The straightforward definition of 'reverse' would be </P>

<UL>
<PRE><FONT COLOR="#000080">naive_reverse([],[]).
naive_reverse([H|T],Rev):-
  naive_reverse(T,TR),
  append(TR,[H],Rev).</FONT></PRE>
</UL>

<P>The inefficiency of this definition is a feature taken advantage of
in Prolog benchmarks. It is called the <B>naive reverse</B>, and published
performance statistics often list the time required to reverse a list of
a certain size. </P>

<P>The result of the recursive call to naive_reverse/2<!AMZI_INDEX= naive_reverse/2>
is used in the last goal, so it is not tail recursive, but it gives the
right answers. </P>

<UL>
<PRE><FONT COLOR="#000080">?- naive_reverse([ants, mice, zebras], X).
X = [zebras, mice, ants]</FONT></PRE>
</UL>

<P>By again introducing a new second argument which will accumulate the
partial answer through levels of recursion, we can rewrite 'reverse.' It
turns out that the partial answer is already reversed when it reaches the
boundary condition. </P>

<UL>
<PRE><FONT COLOR="#000080">reverse([], Rev, Rev).
reverse([H|T], Temp, Rev) :-
  reverse(T, [H|Temp], Rev).</FONT></PRE>
</UL>

<P>We can now try the second reverse. </P>

<UL>
<PRE><FONT COLOR="#000080">?- reverse([ants, mice, zebras], [], X).
X = [zebras, mice, ants]</FONT></PRE>
</UL>

<H3><A NAME="Exercises"></A>Exercises</H3>

<P>1- Trace both versions of reverse to understand the performance differences.
</P>

<P>2- Write a tail recursive predicate that will compute the sum of the
numbers between two given numbers. Trace its behavior to see if it is tail
recursive. </P>

<H4>Adventure Game</H4>

<P>3- Add the remaining command predicates to do/1 so the game can be fully
played. </P>

<P>4- Add the concept of time to the game by putting a counter in the command
loop. Use an out-of-time condition as one way to end the game. Also add
a 'wait' command, which just waits for one time increment. </P>

<P>5- Add other individuals or creatures that move automatically through
the game rooms. Each cycle of the command loop will update their locations
based on whatever algorithm you choose. </P>

<H4>Customer Order Entry</H4>

<P>6- Write a command loop for the order entry inventory system. Write
a variation on menuask/3 that will present the user with a menu of choices,
one of which is to exit the system. Use this in the command loop instead
of just prompting for a command. Have each command prompt for the required
input, if any. </P>

<H4>Expert System</H4>

<P>7- Make a new version of the expert system that maintains the 'known'
information in arguments rather than in the logicbase. </P>


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
