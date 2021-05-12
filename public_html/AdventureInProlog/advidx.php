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

<h1>Index</h1>
<hr />

<div style="margin-left:20px">

<h2><A HREF="#A">A</A> <A HREF="#B">B</A> <A HREF="#C">C</A> <A HREF="#D">D</A> <A HREF="#E">E</A> <A HREF="#F">F</A> <A HREF="#G">G</A> <A HREF="#H">H</A> <A HREF="#I">I</A> <A HREF="#J">J</A> <A HREF="#K">K</A> <A HREF="#L">L</A> <A HREF="#M">M</A> <A HREF="#N">N</A> <A HREF="#O">O</A> <A HREF="#P">P</A> <A HREF="#Q">Q</A> <A HREF="#R">R</A> <A HREF="#S">S</A> <A HREF="#T">T</A> <A HREF="#U">U</A> <A HREF="#V">V</A> <A HREF="#W">W</A> <A HREF="#X">X</A> <A HREF="#Y">Y</A> <A HREF="#Z">Z</A></h2>

<PRE>


<B>=/2</B>
  <A HREF="a10unif.php#Chapter10" TARGET="content">Unification</A>
  <A HREF="a11lists.php#Chapter11" TARGET="content">Lists</A>
<A HREF="a10unif.php#Chapter10" TARGET="content">=/2, affect on backtracking</A>

<h1><A NAME="A"></A>  A</h1>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">add_thing/3</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">add_thing2/3</A>
<B>Anonymous variables</B>
  <A HREF="a10unif.php#Chapter10" TARGET="content">Unification</A>
  <A HREF="a9struct.php#Chapter9" TARGET="content">Data Structures</A>
  <A HREF="a5rules.php#UsingRules" TARGET="content">Rules: Using Rules</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">append/3</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">append/3, example trace of</A>
<A HREF="a1start.php#Jargon" TARGET="content">Arguments</A>
<A HREF="a6arith.php#Chapter6" TARGET="content">Arithmetic, affect on backtracking</A>
<A HREF="a6arith.php#Chapter6" TARGET="content">Arithmetic, expressions</A>
<A HREF="a6arith.php#Chapter6" TARGET="content">Arithmetic, operators</A>
<A HREF="a1start.php#Jargon" TARGET="content">Arity</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">assert/1, and backtracking</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">asserta/1</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">assertz/1</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Associativity</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Associativity, overriding</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Atoms</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Atoms, syntax of</A>

<h1><A NAME="B"></A>  B</h1>
<B>Backtracking</B>
  <A HREF="a14cntrl.php#Chapter14" TARGET="content">Control Structures</A>
  <A HREF="a4comqry.php#Chapter4" TARGET="content">Compound Queries</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">Backtracking, and repeat/0</A>
<A HREF="a13cut.php#Chapter13" TARGET="content">Backtracking, cut</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Backtracking, versus recursion</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Boundary condition</A>
<A HREF="a8recurs.php#Chapter8" TARGET="content">Boundary, condition</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">break_out/1</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">Built-in predicates</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Built-in predicates, as operators</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">Built-in predicates, example trace of</A>

<h1><A NAME="C"></A>  C</h1>
<A HREF="a7manage.php#Chapter7" TARGET="content">can_go/1</A>
<A HREF="a9struct.php#Chapter9" TARGET="content">can_take_s/1</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Character set</A>
<B>Clauses</B>
  <A HREF="a5rules.php#Chapter5" TARGET="content">Rules</A>
  <A HREF="a1start.php#Jargon" TARGET="content">Getting Started: Jargon</A>
<A HREF="a5rules.php#HowRulesWork" TARGET="content">Clauses, number</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">command_loop/0</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Compound queries</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Compound query, example trace of</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Conjunction</A>
<A HREF="a5rules.php#UsingRules" TARGET="content">connect/2</A>
<A HREF="a1start.php#JumpingIn" TARGET="content">consult/1</A>
<B>Cut</B>
  <A HREF="a13cut.php#Chapter13" TARGET="content">Cut</A>
  <A HREF="a13cut.php#UsingTheCut" TARGET="content">Cut: Using the Cut</A>
<A HREF="a13cut.php#UsingTheCut" TARGET="content">Cut, and fail/0</A>
<A HREF="a13cut.php#Chapter13" TARGET="content">Cut, examples of</A>
<A HREF="a13cut.php#Chapter13" TARGET="content">Cut, performance considerations</A>

<h1><A NAME="D"></A>  D</h1>
<A HREF="a15nlang.php#DefiniteClauseGrammar" TARGET="content">DCG (Definite Clause Grammar)</A>
<A HREF="a15nlang.php#DifferenceLists" TARGET="content">Difference lists</A>
<A HREF="a15nlang.php#DifferenceLists" TARGET="content">Difference lists, example trace of</A>
<B>display/1</B>
  <A HREF="a11lists.php#Chapter11" TARGET="content">Lists</A>
  <A HREF="a12oper.php#Chapter12" TARGET="content">Operators</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">do/1</A>
<B>door/2</B>
  <A HREF="a4comqry.php#Chapter4" TARGET="content">Compound Queries</A>
  <A HREF="a2facts.php#NaniSearch" TARGET="content">Facts: Nani Search</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">dot/2</A>

<h1><A NAME="E"></A>  E</h1>
<B>edible/1</B>
  <A HREF="a4comqry.php#Chapter4" TARGET="content">Compound Queries</A>
  <A HREF="a2facts.php#NaniSearch" TARGET="content">Facts: Nani Search</A>

<h1><A NAME="F"></A>  F</h1>
<B>Facts</B>
  <A HREF="a2facts.php#Chapter2" TARGET="content">Facts</A>
  <A HREF="a1start.php#Jargon" TARGET="content">Getting Started: Jargon</A>
  <A HREF="a2facts.php#NaniSearch" TARGET="content">Facts: Nani Search</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">fail/0</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">fail/0, affect on backtracking</A>
<A HREF="a13cut.php#UsingTheCut" TARGET="content">fail/0, and cut</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">findall/3</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Functors</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Functors,as operators</A>

<h1><A NAME="G"></A>  G</h1>
<A HREF="a3simple.php#Chapter3" TARGET="content">Goals</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Goals, combining</A>
<A HREF="a3simple.php#HowQueriesWork" TARGET="content">Goals, ports of</A>
<A HREF="a3simple.php#Chapter3" TARGET="content">Goals, variables in</A>
<B>goto/1</B>
  <A HREF="a7manage.php#Chapter7" TARGET="content">Managing Data</A>
  <A HREF="a13cut.php#UsingTheCut" TARGET="content">Cut: Using the Cut</A>
<A HREF="a15nlang.php#Chapter15" TARGET="content">Grammar</A>

<h1><A NAME="I"></A>  I</h1>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">I/O predicates</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">I/O predicates, affect on backtracking</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Integers</A>
<B>is/2</B>
  <A HREF="a12oper.php#Chapter12" TARGET="content">Operators</A>
  <A HREF="a6arith.php#Chapter6" TARGET="content">Arithmetic</A>
<B>is_contained_in/2</B>
  <A HREF="a8recurs.php#Chapter8" TARGET="content">Recursion</A>
  <A HREF="a8recurs.php#HowRecursionWorks" TARGET="content">Recursion: How Recursion Works</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">is_in/2</A>

<h1><A NAME="L"></A>  L</h1>
<A HREF="a5rules.php#UsingRules" TARGET="content">list_things/1</A>
<A HREF="a9struct.php#Chapter9" TARGET="content">list_things_s/1</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, and recursion</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Lists, character</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Lists, converting to facts</A>
<A HREF="a15nlang.php#DifferenceLists" TARGET="content">Lists, difference</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, dot notation</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, empty</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, head</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, syntax</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Lists, tail</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">loc_list/2</A>
<B>location/2</B>
  <A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">Compound Queries: Built-in Predicates</A>
  <A HREF="a3simple.php#Chapter3" TARGET="content">Simple Queries</A>
  <A HREF="a4comqry.php#Chapter4" TARGET="content">Compound Queries</A>
  <A HREF="a8recurs.php#Chapter8" TARGET="content">Recursion</A>
  <A HREF="a3simple.php#HowQueriesWork" TARGET="content">Simple Queries: How Queries Work</A>
  <A HREF="a2facts.php#NaniSearch" TARGET="content">Facts: Nani Search</A>
  <A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Lists: Using the List Utilities</A>
<A HREF="a9struct.php#Chapter9" TARGET="content">location_s/2</A>
<A HREF="a3simple.php#Chapter3" TARGET="content">Logical variables</A>
<A HREF="a5rules.php#UsingRules" TARGET="content">look/0</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">Loops</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">Loops, endless</A>
<A HREF="a14cntrl.php#RecursiveControlLoop" TARGET="content">Loops, recursive</A>

<h1><A NAME="M"></A>  M</h1>
<A HREF="a11lists.php#Chapter11" TARGET="content">member/2</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">member/2, example trace of</A>
<B>mortal/1</B>
  <A HREF="a1start.php#JumpingIn" TARGET="content">Getting Started: Jumping In</A>
  <A HREF="a1start.php#LogicProgramming" TARGET="content">Getting Started: Logic Programming</A>
<A HREF="a1start.php#LogicProgramming" TARGET="content">mortal_report</A>

<h1><A NAME="N"></A>  N</h1>
<A HREF="a14cntrl.php#TailRecursion" TARGET="content">naive_reverse/2</A>
<A HREF="a1start.php#Chapter1" TARGET="content">Nani Search game</A>
<A HREF="a1start.php#Chapter1" TARGET="content">Nani Search game, example run of</A>
<A HREF="a1start.php#Chapter1" TARGET="content">Nani Search game, generally</A>
<A HREF="a15nlang.php#Chapter15" TARGET="content">Natural language</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Neck symbol</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">nl/0</A>
<A HREF="a13cut.php#UsingTheCut" TARGET="content">not/0, instead of</A>
<B>not/1</B>
  <A HREF="a9struct.php#Chapter9" TARGET="content">Data Structures</A>
  <A HREF="a13cut.php#UsingTheCut" TARGET="content">Cut: Using the Cut</A>

<h1><A NAME="O"></A>  O</h1>
<A HREF="a9struct.php#Chapter9" TARGET="content">object/4</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">op/3</A>
<B>Operators</B>
  <A HREF="a12oper.php#Chapter12" TARGET="content">Operators</A>
  <A HREF="a6arith.php#Chapter6" TARGET="content">Arithmetic</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, associativity</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, infix</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, nonassociative</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, postfix</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, precedence</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Operators, prefix</A>

<h1><A NAME="P"></A>  P</h1>
<B>person/1</B>
  <A HREF="a1start.php#JumpingIn" TARGET="content">Getting Started: Jumping In</A>
  <A HREF="a1start.php#LogicProgramming" TARGET="content">Getting Started: Logic Programming</A>
<A HREF="a3simple.php#HowQueriesWork" TARGET="content">Ports</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Ports, redo</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Precedence</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Precedence, overriding</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Precedence, problems with</A>
<B>Predicates</B>
  <A HREF="a1start.php#Chapter1" TARGET="content">Getting Started</A>
  <A HREF="a1start.php#Jargon" TARGET="content">Getting Started: Jargon</A>
<A HREF="a1start.php#Jargon" TARGET="content">Predicates, arity</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Predicates, arity of 0</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">Predicates, built-in</A>
<A HREF="a1start.php#Jargon" TARGET="content">Predicates, name of</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Prolog</A>
<A HREF="a1start.php#Jargon" TARGET="content">Prolog data vs. procedure</A>
<B>Prolog listener</B>
  <A HREF="a2facts.php#Chapter2" TARGET="content">Facts</A>
  <A HREF="a1start.php#JumpingIn" TARGET="content">Getting Started: Jumping In</A>
<B>Prolog, flow of control</B>
  <A HREF="a14cntrl.php#Chapter14" TARGET="content">Control Structures</A>
  <A HREF="a5rules.php#UsingRules" TARGET="content">Rules: Using Rules</A>
<A HREF="a1start.php#Chapter1" TARGET="content">Prolog, origins of</A>

<h1><A NAME="Q"></A>  Q</h1>
<A HREF="a3simple.php#Chapter3" TARGET="content">Queries</A>
<A HREF="a4comqry.php#Chapter4" TARGET="content">Queries, compound</A>
<A HREF="a1start.php#JumpingIn" TARGET="content">Queries, simple examples of</A>

<h1><A NAME="R"></A>  R</h1>
<A HREF="a8recurs.php#Chapter8" TARGET="content">Recursion</A>
<A HREF="a8recurs.php#HowRecursionWorks" TARGET="content">Recursion, example, trace of</A>
<B>Recursion, performance considerations</B>
  <A HREF="a8recurs.php#Pragmatics" TARGET="content">Recursion: Pragmatics</A>
  <A HREF="a14cntrl.php#RecursiveControlLoop" TARGET="content">Control Structures: Recursive Control Loop</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Recursion, versus backtracking</A>
<A HREF="a8recurs.php#Chapter8" TARGET="content">Recursive case</A>
<A HREF="a14cntrl.php#Chapter14" TARGET="content">repeat/0</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">retract/1</A>
<B>room/1</B>
  <A HREF="a3simple.php#Chapter3" TARGET="content">Simple Queries</A>
  <A HREF="a2facts.php#NaniSearch" TARGET="content">Facts: Nani Search</A>
<B>Rules</B>
  <A HREF="a5rules.php#Chapter5" TARGET="content">Rules</A>
  <A HREF="a1start.php#Jargon" TARGET="content">Getting Started: Jargon</A>
<A HREF="a5rules.php#HowRulesWork" TARGET="content">Rules, example, trace of</A>
<A HREF="a5rules.php#Chapter5" TARGET="content">Rules, multiple</A>
<A HREF="a5rules.php#HowRulesWork" TARGET="content">Rules, unification</A>

<h1><A NAME="S"></A>  S</h1>
<A HREF="a3simple.php#HowQueriesWork" TARGET="content">sleeps/1</A>
<A HREF="a1start.php#JumpingIn" TARGET="content">Source code loading</A>
<A HREF="a9struct.php#Chapter9" TARGET="content">Structures</A>
<A HREF="a9struct.php#Chapter9" TARGET="content">Structures, complex</A>
<A HREF="a10unif.php#Chapter10" TARGET="content">Structures, unification</A>

<h1><A NAME="T"></A>  T</h1>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">tab/1</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">take/1</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">take_object/1</A>
<A HREF="a2facts.php#NaniSearch" TARGET="content">tastes_yucky/1</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Terms</A>

<h1><A NAME="U"></A>  U</h1>
<A HREF="a3simple.php#HowQueriesWork" TARGET="content">unbound variables</A>
<B>Unification</B>
  <A HREF="a10unif.php#Chapter10" TARGET="content">Unification</A>
  <A HREF="a3simple.php#Chapter3" TARGET="content">Simple Queries</A>
  <A HREF="a3simple.php#HowQueriesWork" TARGET="content">Simple Queries: How Queries Work</A>
<A HREF="a8recurs.php#HowRecursionWorks" TARGET="content">Unification, during recursion</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Unification, explicit</A>
<A HREF="a11lists.php#UsingTheListUtilities" TARGET="content">Unification, implicit</A>
<A HREF="a11lists.php#Chapter11" TARGET="content">Unification, lists</A>
<A HREF="a12oper.php#Chapter12" TARGET="content">Unification, operators</A>
<A HREF="a5rules.php#HowRulesWork" TARGET="content">Unification, rules</A>
<B>Unification, structures</B>
  <A HREF="a10unif.php#Chapter10" TARGET="content">Unification</A>
  <A HREF="a9struct.php#Chapter9" TARGET="content">Data Structures</A>

<h1><A NAME="V"></A>  V</h1>
<A HREF="a2facts.php#Chapter2" TARGET="content">Variables</A>
<A HREF="a5rules.php#UsingRules" TARGET="content">Variables, anonymous</A>
<A HREF="a3simple.php#Chapter3" TARGET="content">Variables, binding</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">Variables, global</A>
<A HREF="a7manage.php#Chapter7" TARGET="content">Variables, global, eliminating</A>
<A HREF="a3simple.php#Chapter3" TARGET="content">Variables, in goals</A>
<B>Variables, scope</B>
  <A HREF="a7manage.php#Chapter7" TARGET="content">Managing Data</A>
  <A HREF="a8recurs.php#HowRecursionWorks" TARGET="content">Recursion: How Recursion Works</A>
<A HREF="a2facts.php#Chapter2" TARGET="content">Variables, syntax of</A>
<A HREF="a10unif.php#Chapter10" TARGET="content">Variables, unbound</A>

<h1><A NAME="W"></A>  W</h1>
<B>where_food/2</B>
  <A HREF="a5rules.php#Chapter5" TARGET="content">Rules</A>
  <A HREF="a5rules.php#HowRulesWork" TARGET="content">Rules: How Rules Work</A>
<A HREF="a4comqry.php#BuiltinPredicates" TARGET="content">write/1</A>
</PRE>

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
