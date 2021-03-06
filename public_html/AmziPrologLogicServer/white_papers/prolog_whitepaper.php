<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. White Paper on Prolog</title>
<meta name="description" content="Amzi! inc. white paper on the nature of rules and how to encode them.">

<meta name="keywords" content="Prolog, rules, rule-based programming, logic programming, rule engines, artificial intelligence,
domain specific language, logic server, embeddable, extendable, knowledge engineering">

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
    require ("../sidebar.php");
    ?>
    <!--End Side Navigation-->

    <div id="beef">
    
        <!--Start content-->

<H1>White Paper on Rules, Prolog and Logic Server Technology</H1>
<HR>
<P>

<H2><IMG SRC="../../articles/bullet.gif" ALIGN="TOP"> What are Rules?</H2>
<P>
Rules occupy a hazy area between data and procedure. Like data, each rule in a rule-base is independent, and can be linked to other rules dynamically based on common values. Like procedures, each rule has multiple sub-statements specifying conditions and/or actions related to the execution or firing of the rule.
<P>
Looking at it another way, both databases and procedures can be thought of as degenerate cases of rule-bases. A database is a collection of rules that have no action statements and only one set of conditions. A procedure is one big rule with many statements. Figure 1 illustrates the relationship between data, procedure and rules.
<P> <IMG SRC="../../articles/dataprocrules.gif" ALIGN="TOP"> 
<P>
Figure 1--The relationship between data, procedures and rules
<P>
Because most programming tools are designed for either data or procedures, when confronted with a specification written as a collection of rules, the developer faces a tricky problem. The rules cannot be expressed in data, and coding them procedurally leads to spaghetti-like code for even the best of programmers. Further the original rules get lost in the code, become difficult to debug, and almost impossible to update when necessary.
<P>
Ironically, this difficult part of an application is often its heart, and, to make matters worse, the piece most likely to change.
<P>
<H2><IMG SRC="../../articles/bullet.gif" ALIGN="TOP"> Rules are the Heart of the Application</H2>
<P>
Consider a billing application for a phone company. Most of the application is cleanly coded using data for calls and customers, and procedures for processing the data. But pricing the call is the tricky part, based on a collection of rules derived from marketing concerns, local regulations, various sub-carriers, and special arrangements with large customers, all on top of the expected rules based on time-of-day, physical distance of call, length of call, and whether it was a credit card, collect or directly billed call.
<P>
All you need to do to understand the importance of phone call pricing is listen to the large phone company???s ads. Each claims to have better pricing rules. The volatility of the rules derives from the competitive environment, evolving technology and changing government regulations.
<P>
The phenomena of a difficult rule-based component being the heart and soul of an otherwise straight-forward application occurs over and over. Consider the underwriting rules for insurance companies, the scheduling rules for an airline, the configuration rules for manufacturing, the diagnostic rules in a help desk, the loan approval rules in banking, and the exception handling rules in process control.
<P>
So what is a programmer to do? What???s needed is a language that allows you to specify rules declaratively, (like they are described when a system is specified), and the means to integrate them with the procedures and data that comprise the majority of the application. Prolog is such a language.
<P>
<H2><IMG SRC="../../articles/bullet.gif" ALIGN="TOP"> What is Prolog?</H2>
<P> Prolog is a full, industry-standard programming language, ideally suited to 
  writing rules. Because it is a full language, Prolog can be used for almost 
  any application, but, like any language, it has its strengths and weaknesses. 
  However, Prolog???s strengths are the weaknesses of conventional languages (like 
  C/C++, Basic, Java) and vice versa. Although it can be, and often is, used by 
  itself, Prolog complements traditional languages when used together in the same 
  application. 
<P>
At its simplest, a Prolog program is just a collection of facts and rules.  For example, a technical support application for video monitors might have these rules.
<P>
<PRE>hypothesis(loose_plug) :-
   symptom(screen, dark),
   symptom(video_led, off).
<P>
hypothesis(blank_screen_saver) :-
   symptom(screen, dark),
   symptom(video_led, on).
<P>
action(push_plug_in) :-
   hypothesis(loose_plug).
<P>
action(move_mouse) :-
   hypothesis(blank_screen_saver).
</PRE>

<P>The first rule can be read as &quothypothesis is loose_plug if symptom screen is dark and symptom video_led is off.&quot  An interaction with a user who's screen has gone dark might yield these facts.
<P>
<PRE>symptom(screen, dark).
symptom(video_led, on).
</PRE>

<P>Querying these Prolog rules and facts with the query 'action(X)' will yield the result 'action = move_mouse.'
<P>
Prolog is not a difficult language to learn, but it includes features that are not commonly found in other languages. These features take some getting used to, but they make it an exceptional language for solving certain classes of difficult problems.
<P>
For example, the Atlantic Coast Conference (ACC) college basketball season is very difficult to schedule, due to the fact that college basketball is big business in the United States and each team is vying for a schedule that provides good opportunity for valuable television coverage.  Past year's schedules were always compromises, as neither hand methods nor conventional programming methods could generate schedules that met every team's individual constraints as well as the desire for overall fairness.
<P>
This is the first year they have a schedule that meets all of the constraints, and it was generated by a Prolog program.  Prolog proved to be both a very expressive language for coding the problem, and an efficient language for finding a solution.  The following paragraphs highlight the features of Prolog that make it well-suited to this type of application, using the ACC scheduling problem as an example.
<P>
<H3>Symbolic Programming</H3>
<P>
First, Prolog is a symbolic language, meaning it is designed to manipulate symbols. For example 4 - 2 is a complex symbol in Prolog made up of three primitive symbols, in this case two integers and an operator. If asked, Prolog can evaluate this particular expression arithmetically, but in general it is just a symbol used exactly as it's written. The scheduling program makes use of this particular pattern to represent games, so 4 - 2 is used to mean team 4 plays team 2 at team 2???s home. Similarly, the pattern team(2, 'Duke') is used to associate the name Duke with team number 2.
<P>
<H3>Logical Variables</H3>
<P>
Second, Prolog uses logical variables, which, unlike conventional programming variables, take on values based on pattern matching with symbols. Notationally, variables are indicated by an initial upper case letter. For example, in the scheduling program the variable X in the pattern X - 2 can be used to identify all of the teams that play team 2 at team 2???s home. Similarly, team(N, Name) can be used to find team names associated with team numbers.
<P>
<H3>Powerful Search and Pattern Matching</H3>
<P>
Third, Prolog has a built-in backtracking search mechanism, so, unlike in conventional languages, execution can go both forward and back. When it goes backward, logical variables become unbound from their previous values, and when execution starts forward again, they can become bound to new values. For example, the pattern X - Y can be used to pick games from a list of games, where the list of games looks like [1 - 2, 1 - 3, ... 2 - 1, 2 - 3, ...]. If the game causes a constraint violation, backtracking will automatically lead to new values of X and Y as another possible game is selected.
<P>
<H3>Recursion</H3>
<P>
Fourth, Prolog uses recursion. Many languages support recursion, but in Prolog recursion plays an important role for many applications. It is used extensively in the scheduling program, from the highest level loop which recursively selects games from the possible game list, building an output schedule as it goes, to the lowest level predicates that walk various intermediate lists looking for games and patterns as they ensure the constraints of the problem are met.
<P>
For example, this rule recursively walks a list of a team's games, looking to see if there are three away games in a row, which is a constraint violation.  It says &quotaway_triple is true if there are three consecutive away games in a team's schedule.&quot
<P>
<PRE>away_triple([a-_, a-_, a-_|Z]) :- !.
away_triple([_|Z]) :-
  away_triple(Z).
</PRE>
<P>
<H3>Efficient, Portable Architecture</H3>
<P>
Fifth, Prolog is implemented using the Warren Abstract Machine (WAM). A naive implementation of Prolog can be tedious, as the features mentioned above do not naturally map to the underlying architecture of today's computers. (By contrast, the flow of control and variable representation of conventional programming languages map very cleanly to basic computer architecture, which is why they are designed the way they are.) David Warren designed an abstract computer with specialized heaps and stacks and its own assembly language that is highly optimized for executing compiled Prolog programs. It is used in one form or another by most serious Prolog implementations.
<P>
While the first four features make Prolog an exceptional language for expressing the solution to problems such as the basketball scheduling problem, it is the fifth feature that makes it a practical language for implementing the solution.
<P>
<H2><IMG SRC="../../articles/bullet.gif" ALIGN="TOP"> Why Amzi! Prolog + Logic Server?</H2>
<P>
Amzi! Prolog is a powerful implementation of the Prolog language.  Its integrated development environment (IDE) includes an editor, interpreter (listener) and debugger for developing Prolog modules, and a compiler, projects and linker for deploying them.
<P>
But the real potential of Amzi! is realized in the Logic Server.  This is the piece that makes it easy to integrate Prolog rule-based components with conventional programming languages, databases and other development tools and libraries, such as GUI  or networking tools.
<P> <IMG SRC="../../articles/prologarc.gif" ALIGN="TOP" width="436" height="448"> 
<P>
Figure 2--The Amzi! Architecture
<P> The Logic Server encapsulates the Amzi! Prolog engine in a shared library 
  (.so or .dll), with its own well-behaved memory management, and includes a full 
  application program interface (LSAPI) that makes it readily accessible to any 
  other language, both for call-in and call-out. 
<P> While the Logic Server API can be called directly by any system that can call 
  a shared library, covering functions are provided for popular languages such 
  as C++, Java, Delphi and Visual Basic. The C++ and Java wrappers encapsulates 
  the LSAPI in a class, the Delphi wrapper makes it a component, and the Visual 
  Basic wrapper provides simple functions that automatically deal with error recovery 
  and the conversion of strings. 
<P>
The call-out facilities allow anyone to connect Prolog to anything, but the product includes libraries of pre-built functions, such as a connection to ODBC databases for any application, and a connection to Delphi graphics functions for Delphi users.
<P> Amzi! is an extremely portable tool, with compatible command-line versions 
  running under Windows, Linux, Solaris and HP-UX. The core implementation is 
  in C++ and the system ports easily to any platform with a C++ compiler.
<P>
In any environment, Amzi! Prolog + Logic Server provides a clean and elegant solution for the modules that are difficult to implement with conventional tools, and yet, a solution that integrates easily and naturally with these tools.
<P>
<H2><IMG SRC="../../articles/bullet.gif" ALIGN="TOP"> How is Amzi! Prolog and Prolog in General Used?</H2>
<P>
<H3>Process Control</H3>
<P>
Indra Systems is building a quality control system for Sweden???s largest cheese maker using Amzi! Prolog and Delphi. This system monitors output sensors from the manufacturing equipment. When a change in quality is detected, the operator is alerted and a rule-base makes recommendations on how to adjust the manufacturing process.
<P>
Hewlett-Packard uses a Prolog rule-base to test and repair their personal computer boards.
<P>
<H3>Business Advisors</H3>
<P>
A major computer manufacturer is using a sales advisor built by the Learning Edge using Toolbook and Amzi!. The advisor asks questions about the prospects site and then applies a rule-base of about 175 rules to recommend products that would be most suitable for that customer.
<P>
Pig farmers in the U.S., Europe and Australia use Prolog to adjust diet, housing and other factors to improve herd profitability. Boeing uses Prolog to advises its engineers, manufacturing and field personnel how to properly assemble electric connectors that require special tools.
<P>
<H3>Scheduling &amp; Evaluation</H3>
<P>
York University is implementing enrollment rules using Visual Basic and Amzi! The department heads use the VB graphical user interface to conceptualize and test the rules for their department. Then, the rules are ???black-boxed??? and run on a server that applies them to the individual students. The Atlantic Coast Conference uses an Amzi! Prolog rule-base to schedule their basketball games for the season.
<P>
Prolog is used in the Netherlands to schedule tennis matches, do seeding, resolve rain delays, etc. Rotisserie/Fantasy Basketball uses Prolog to compute weekly standings and predict performance.
<P>
<H3>Configuration &amp; Tuning</H3>
<P>
Xircom uses C/C++ and Amzi! for installing their network and modem cards. The installation program examines the resources available and configuration of the laptop computer. An Amzi! rule- base is used to determine which configurations will work best for the new card. Microsoft uses a Prolog component in their NT network installation program to configure the network.
<P>
<H3>Parsing &amp; Natural Language</H3>
<P>
Amzi! uses a Prolog component alongside its Access database to parse and input scanned-in sales leads from a variety of magazines.
<P>
Amzi!, Hewlett-Packard, Boeing and many others use Prolog to build their own custom rule languages.
<P>


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
