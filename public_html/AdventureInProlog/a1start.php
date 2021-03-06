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

<A NAME="Chapter1"></A>

<table style="width:100%;"><tr>
<td><h1>1</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Getting Started</H2>

<P>Prolog stands for PROgramming in LOGic. It was developed from a foundation
of logical theorem proving and originally used for research in natural
language processing. Although its popularity has sprung up mainly in the
artificial intelligence (AI) community, where it has been used for applications
such as expert systems, natural language, and intelligent databases, it
is also useful for more conventional types of applications. It allows for
more rapid development and prototyping than most languages because it is
semantically close to the logical specification of a program. As such,
it approaches the ideal of executable program specifications. </P>

<P>Programming in Prolog<!AMZI_INDEX= Prolog, origins of > is significantly different 
  from conventional procedural programming and requires a readjustment in the 
  way one thinks about programming. Logical relationships are asserted, and Prolog 
  is used to determine whether or not certain statements are true, and if true, 
  what variable bindings make them true. This leads to a very declarative style 
  of programming.</P>
<P>In fact, the term program does not accurately describe a Prolog collection 
  of executable facts, rules and logical relationships, so you will often see 
  term <b>logicbase</b> used in this book as well.</P>
<P>While Prolog is a fascinating language from a purely theoretical viewpoint, 
  this book will stress Prolog as a practical tool for application development. 
</P>
<P>Much of the book will be built around the writing of a short adventure
game. The adventure game is a good example since it contains mundane programming
constructs, symbolic reasoning, natural language, data, and logic.
</P>

<P>Through exercises you will also build a simple expert system, an intelligent 
  genealogical logicbase, and a mundane customer order entry application. </P>

<P>You should create a source file for the game, and enter the examples
from the book as you go. You should also create source files for the other
three programs covered in the exercises. Sample source code for each of
the programs is included in the appendix. </P>

<P>The adventure game is called Nani Search<!AMZI_INDEX= Nani Search game>.
Your persona as the adventurer is that of a three year old girl. The lost
treasure with magical powers is your nani (security blanket). The terrifying
obstacle between you and success is a dark room. It is getting late and
you're tired, but you can't go to sleep without your nani. Your mission
is to find the nani. </P>

<P>Nani Search is composed of </P>

<UL>
<LI>A read and execute command loop </LI>

<LI>A natural language input parser </LI>

  <LI>Dynamic facts/data describing the current environment </LI>

<LI>Commands that manipulate the environment </LI>

<LI>Puzzles that must be solved </LI>
</UL>

<P>You control the game by using simple English commands (at the angle
bracket (&gt;) prompt) expressing the action you wish to take. You can
go to other rooms, look at your surroundings, look in things, take things,
drop things, eat things, inventory the things you have, and turn things
on and off. </P>

<P>Figure 1.1 shows a run of a completed version of Nani Search<!AMZI_INDEX= Nani Search game, generally>.
As you develop your own version you can of course change the game to reflect
your own ideas of adventure. </P>

<P>The game will be implemented from the bottom up, because that fits better
with the order in which the topics will be introduced. Prolog is equally
adept at supporting top-down or inside-out program development. </P>

<P>A Prolog logicbase exists in the listener's workspace as a collection of small 
  modular units, called <B>predicates<!AMZI_INDEX= Predicates></B>. They are similar 
  to subroutines in conventional languages, but on a smaller scale. </P>

<P>The predicates can be added and tested separately in a Prolog program,
which makes it possible to incrementally develop the applications described
in the book. Each chapter will call for the addition of more and more predicates
to the game. Similarly, the exercises will ask you to add predicates to
each of the other applications. </P>

<P>We will start with the Nani Search logicbase and quickly move into the
commands that examine that logicbase. Then we will implement the commands
that manipulate the logicbase. </P>

<P>Along the way there will be diversions where the same commands are rewritten
using a different approach for comparison. Occasionally a topic will be
covered that is critical to Prolog but has little application in Nani Search.
</P>

<P>One of the final tasks will be putting together the top-level command
processor. We will finish with the natural language interface.<!AMZI_INDEX= Nani Search game, example run of>
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">You are in the kitchen.
You can see: apple, table, broccoli
You can go to: cellar, office, dining room

&gt; go to the cellar

You can't go to the cellar because it's dark in the cellar, and you're afraid of the dark.

&gt; turn on the light

You can't reach the switch and there's nothing to stand on.

&gt; go to the office

You are in the office.
You can see the following things: desk
You can go to the following rooms: hall, kitchen

&gt; open desk

The desk contains:
  flashlight
  crackers

&gt; take the flashlight

You now have the flashlight

&gt; kitchen

You are in the kitchen

&gt; turn on the light

flashlight turned on.
...</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 1.1. A sample run of Nani Search </P>

<P>The goal of this book is to make you feel comfortable with </P>

<UL>
  <LI>The Prolog logicbase of facts and rules </LI>

  <LI>The built-in theorem prover that allows Prolog to answer questions about 
    the logicbase (backtracking search) </LI>

<LI>How logical variables are used (They are different from the variables
in most languages.) </LI>

<LI>Unification, the built in pattern matcher </LI>

<LI>Extra-logical features (like read and write that make the language
practical) </LI>

<LI>How to control Prolog's execution behavior </LI>
</UL>

<H3><A NAME="JumpingIn"></A>Jumping In </H3>

<P>As with any language, the best way to learn Prolog is to use it. This
book is designed to be used with a Prolog listener, and will guide you
through the building of four applications. </P>

<UL>
<LI>Adventure game </LI>

  <LI>Intelligent genealogical logicbase </LI>

<LI>Expert system </LI>

<LI>Customer order entry business application </LI>
</UL>

<P>The adventure game will be covered in detail in the main body of the
text, and the others you will build yourself based on the exercises at
the end of each chapter. </P>

<P>There will be two types of example code throughout the book. One is
code, meant to be entered in a source file, and the other is interactions
with the listener. The listener<!AMZI_INDEX= Prolog listener> interactions
are distinguished by the presence of the question mark and dash (?-) listener
prompt. </P>

<P>Here is a two-line program, meant to help you learn the mechanics of
the editor and your listener. </P>

<UL>
<PRE><FONT COLOR="#000080">mortal(X) :- person(X).<!AMZI_INDEX= mortal/1; person/1 >
person(socrates).</FONT></PRE>
</UL>

<P>In the Amzi! Eclipse IDE, first create a project for your source files. Select 
  File | New | Project on the main menu, then click on 'Prolog' and 'Project', 
  and enter the name of your project, 'adventure'. Next, create a new source file. 
  Select File | New | File, and enter the name of your file, 'mortal.pro'. Enter 
  the pro-gram in the edit window, paying careful attention to upper and lowercase 
  letters and punctuation. Then select File | Save from the menu.</P>
  <P>Next, start the Prolog listener 
  <!AMZI_INDEX= Prolog listener>
  by selecting Run | Run As | Interpreted Project. Loading the source code in 
  the Listener is called consulting. You should see a message indicating that 
  your source file, 'mortal.pro', was consulted. This message is followed by the 
  typical listener prompt.</P>
<UL>
<PRE><FONT COLOR="#000080">?-</FONT></PRE>
</UL>

<P>Entering the source code<!AMZI_INDEX= Source code loading> in the Listener
is called <B>consulting</B>. Select Listener/Consult from the main menu,
and select 'mortal.pro' from the file menu. You can also consult a Prolog
source file directly from the listener prompt like this. </P>

<UL>
<PRE><FONT COLOR="#000080">?- consult(mortal).<!AMZI_INDEX= consult/1>
yes</FONT></PRE>
</UL>

<P>See the documentation and/or online help for details on the Amzi! listener 
  and Eclipse IDE. </P>

<P>In all the listener examples in this book, you enter the text after
the prompt (?&shy;), the rest is provided by Prolog. When working with
Prolog, it is important to remember to include the final period and to
press the 'return' key. If you forget the period (and you probably will),
you can enter it on the next line with a 'return.' </P>

<P>Once you've loaded the program, try the following Prolog queries<!AMZI_INDEX= Queries, simple examples of>.
</P>

<UL>
<PRE><FONT COLOR="#000080">?- mortal(socrates).
yes
?- mortal(X).
X = socrates.</FONT></PRE>
</UL>

<P>Now let's change the program. First type 'quit.' to end the listener. Go back 
  to the edit window and add the line</P>

<UL>
<PRE><FONT COLOR="#000080">person(plato).</FONT></PRE>
</UL>

<P>after the person(socrates) line. </P>

<P>Select Run | Run As | Interpreted Project to start the listener again with 
  your updated source file. And test it.</P>

<UL>
<PRE><FONT COLOR="#000080">?- mortal(plato).
yes</FONT></PRE>
</UL>

<P>One more test. Enter this query in the listener. </P>

<UL>
<PRE><FONT COLOR="#000080">?- write('Hello World').
Hello World
yes</FONT></PRE>
</UL>

<P>You are now ready to learn Prolog. </P>

<H3><A NAME="LogicProgramming"></A>Logic Programming
</H3>

<P>Let's look at the simple example in more detail. In classical logic
we might say &quot;All people are mortal,&quot; or, rephrased for Prolog,
&quot;For all X, X is mortal if X is a person.&quot; </P>

<UL>
<PRE><FONT COLOR="#000080">mortal(X) :- person(X).</FONT><!AMZI_INDEX= mortal/1; person/1></PRE>
</UL>

<P>Similarly, we can assert the simple fact that Socrates is a person.
</P>

<UL>
<PRE><FONT COLOR="#000080">person(socrates).</FONT></PRE>
</UL>

<P>From these two logical assertions, Prolog can now prove whether or not
Socrates is mortal. </P>

<UL>
<PRE><FONT COLOR="#000080">?- mortal(socrates).</FONT></PRE>
</UL>

<P>The listener responds </P>

<UL>
<PRE><FONT COLOR="#000080">yes</FONT></PRE>
</UL>

<P>We could also ask &quot;Who is mortal?&quot; like this </P>

<UL>
<PRE><FONT COLOR="#000080">?- mortal(X).</FONT></PRE>
</UL>

<P>and receive the response </P>

<UL>
<PRE><FONT COLOR="#000080">X = socrates</FONT></PRE>
</UL>

<P>This declarative style of programming is one of Prolog's major strengths.
It leads to code that is easier to write and easier to maintain. For the
most part, the programmer is freed from having to worry about control structures
and transfer of control mechanisms. This is done automatically by Prolog.
</P>

<P>By itself, however, a logical theorem prover is not a practical programming
tool. A programmer needs to do things that have nothing to do with logic,
such as read and write terms. A programmer also needs to manipulate the
built-in control structure of Prolog in order for the program to execute
as desired. </P>

<P>The following example illustrates a Prolog program that prints a report
of all the known mortals. It is a mixture of pure logic from before, extra-logical
I/O, and forced control of the Prolog execution behavior. The example is
illustrative only, and the concepts involved will be explained in later
chapters. </P>

<P>First add some more philosophers to the 'mortal' source in order to
make the report more interesting. Place them after 'person(plato).' </P>

<UL>
<PRE><FONT COLOR="#000080">person(zeno).
person(aristotle).</FONT></PRE>
</UL>

<P>Next add the report-writing code, again being careful with punctuation
and upper- and lowercase. Note that the format of this program is the same
as that used for the logical assertions. </P>

<UL>
<PRE><FONT COLOR="#000080">mortal_report:-<!AMZI_INDEX= mortal_report>  
  write('Known mortals are:'),nl,
  mortal(X),
  write(X),nl,
  fail.</FONT></PRE>
</UL>

<P>Figure 1.2 contains the full program, with some optional comments, indicated
by the percent sign (%) at the beginning of a line. Load the program in
the listener and try it. Note that the syntax of calling the report code
is the same as the syntax used for posing the purely logical queries. </P>

<UL>
<PRE><FONT COLOR="#000080">?- mortal_report.
Known mortals are:
socrates
plato
aristotle
no</FONT></PRE>
</UL>

<P>The final 'no' is from Prolog, and will be explained later. </P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">% This is the syntax for comments.
% MORTAL - The first illustrative Prolog program

mortal(X) :- person(X).

person(socrates).
person(plato).
person(aristotle).

mortal_report:-
  write('Known mortals are:'),nl,
  mortal(X),
  write(X),nl,
  fail.</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 1.2. Sample program </P>

<P>You should now be able to create and edit source files for Prolog, and
be able to load and use them from a Prolog listener. </P>

<P>You have had your first glimpse of Prolog and should understand that
it is fundamentally different from most languages, but can be used to accomplish
the same goals and more. </P>

<H3><A NAME="Jargon"></A>Jargon<!AMZI_INDEX= Prolog, jargon of></H3>

<P>With any field of knowledge, the critical concepts of the field are
embedded in the definitions of its technical terms. Prolog is no exception.
When you understand terms such as <B>predicate</B>, <B>clause</B>, <B>backtracking</B>,
and <B>unification</B> you will have a good grasp of Prolog. This section
defines the terms used to describe Prolog programs, such as predicate and
clause. Execution-related terms, such as backtracking and unification will
be introduced as needed throughout the rest of the text. </P>

<P>Prolog jargon is a mixture of programming terms, database terms, and
logic terms. You have probably heard most of the terms before, but in Prolog
they don't necessarily mean what you think they mean. </P>

<P>In Prolog<!AMZI_INDEX= Prolog data vs. procedure> the normally clear
distinction between data and procedure becomes blurred. This is evident
in the vocabulary of Prolog. Almost every concept in Prolog can be referred
to by synonymous terms. One of the terms has a procedural flavor, and the
other a data flavor. </P>

<P>We can illustrate this at the highest level. A Prolog <B>program</B> is a Prolog 
  <b>logicbase</b>. As we introduce the vocabulary of Prolog, synonyms (from Prolog 
  or other computer science areas) for a term will follow in parentheses. For 
  example, at the highest level we have a Prolog program (logicbase). </P>

<P>The Prolog program is composed of <B>predicates<!AMZI_INDEX= Predicates; Predicates, name of; Predicates, arity></B>
(procedures, record types, relations). Each is defined by its name and
a number called <B>arity</B>. The arity<!AMZI_INDEX= Arity> is the fixed
number of <B>arguments<!AMZI_INDEX= Arguments></B> (attributes, fields)
the predicate has. Two predicates with the same name and different arity
are considered to be different predicates. </P>

<P>In our sample program we saw three examples of predicates. They are:
person/1, mortal_report/0, and mortal/1. Each of these three predicates
has a distinctly different flavor. </P>

<DL>
<DL>
<DT>person/1</DT>

<DD>looks like multiple data records with one data field for each. </DD>

<DT>mortal_report/0</DT>

<DD>looks like a procedure with no arguments. </DD>

<DT>mortal/1 </DT>

<DD>a logical assertion or rule that is somewhere in between data and procedure.
</DD>
</DL>
</DL>

<P>Each predicate in a program is defined by the existence of one or more
<B>clauses<!AMZI_INDEX= Clauses></B> in the logicbase. In the example program,
the predicate person/1 has four clauses. The other predicates have only
one clause. </P>

<P>A clause can be either a <B>fact<!AMZI_INDEX= Facts></B> or a <B>rule<!AMZI_INDEX= Rules></B>.
The three clauses of the person/1 predicate are all facts. The single clauses
of mortal_report/0 and mortal/1 are both rules. </P>




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
