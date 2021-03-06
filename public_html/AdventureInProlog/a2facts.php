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

<A NAME="Chapter2"></A>

<table style="width:100%;"><tr>
<td><h1>2</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Facts</H2>

<P>This chapter describes the basic Prolog facts. They are the simplest
form of Prolog predicates, and are similar to records in a relational database.
As we will see in the next chapter they can be queried like database records. </P>

<P>The syntax for a fact<!AMZI_INDEX= Facts> is </P>

<UL>
<PRE><FONT COLOR="#000080">pred(arg1, arg2, ...  argN).</FONT></PRE>
</UL>

<P>where </P>

<DL>
<DL>
<DT>pred </DT>

<DD>The name of the predicate </DD>

<DT>arg1, ...</DT>

<DD>The arguments </DD>

<DT>N </DT>

<DD>The arity </DD>

<DT>. </DT>

<DD>The syntactic end of all Prolog clauses </DD>
</DL>
</DL>

<P>A predicate<!AMZI_INDEX= Predicates, arity of 0> of arity 0 is simply
</P>

<UL>
<PRE><FONT COLOR="#000080">pred.</FONT></PRE>
</UL>

<P>The arguments can be any legal Prolog <B>term<!AMZI_INDEX= Terms></B>.
The basic Prolog terms are </P>

<DL>
<DL>
<DT>integer<!AMZI_INDEX= Integers> </DT>

<DD>A positive or negative number whose absolute value is less than some
implementation-specific power of 2 </DD>

<DT>atom<!AMZI_INDEX= Atoms> </DT>

<DD>A text constant beginning with a lowercase letter </DD>

<DT>variable<!AMZI_INDEX= Variables, syntax of> </DT>

<DD>Begins with an uppercase letter or underscore (_) </DD>

<DT>structure </DT>

<DD>Complex terms, which will be covered in chapter 9 </DD>
</DL>
</DL>

<P>Various Prolog implementations enhance this basic list with other data
types, such as floating point numbers, or strings. </P>

<P>The Prolog character set<!AMZI_INDEX= Prolog; Character set> is made
up of </P>

<UL>
  <LI>Uppercase letters, A-Z </LI>
  <LI>Lowercase letters, a-z </LI>
  <LI>Digits, 0-9 </LI>
  <LI>Symbols, + - * / \ ^ , . ~ : . ? @ # $ &amp; </LI>
</UL>

<P>Integers are made from digits. Other numerical types are allowed in
some Prolog implementations. </P>

<P>Atoms<!AMZI_INDEX= Atoms> are usually made from letters and digits with
the first character being a lowercase letter, such as </P>

<UL>
<PRE><FONT COLOR="#000080">hello
twoWordsTogether
x14</FONT></PRE>
</UL>

<P>For readability, the underscore (_), but not the hyphen (-), can be
used as a separator in longer names. So the following are legal. </P>

<UL>
<PRE><FONT COLOR="#000080">a_long_atom_name
z_23</FONT></PRE>
</UL>

<P>The following are not legal atoms<!AMZI_INDEX= Atoms, syntax of>. </P>

<UL>
<PRE><FONT COLOR="#000080">no-embedded-hyphens
123nodigitsatbeginning
_nounderscorefirst
Nocapsfirst</FONT></PRE>
</UL>

<P>Use single quotes to make any character combination a legal atom as
follows. </P>

<UL>
<PRE><FONT COLOR="#000080">'this-hyphen-is-ok'
'UpperCase'
'embedded blanks'</FONT></PRE>
</UL>

<P>Do not use double quotes (&quot;&quot;) to build atoms. This is a special
syntax that causes the character string to be treated as a list<!AMZI_INDEX= Lists, character>
of ASCII character codes. </P>

<P>Atoms can also be legally made from symbols, as follows. </P>

<UL>
<PRE><FONT COLOR="#000080">--&gt;
++</FONT></PRE>
</UL>

<P>Variables<!AMZI_INDEX= Variables> are similar to atoms, but are distinguished
by beginning with either an uppercase letter or the underscore (_). </P>

<UL>
<PRE><FONT COLOR="#000080">X
Input_List
_4th_argument
Z56</FONT></PRE>
</UL>

<P>Using these building blocks, we can start to code facts. The predicate
name follows the rules for atoms. The arguments can be any Prolog terms.
</P>

<P>Facts<!AMZI_INDEX= Facts> are often used to store the data a program
is using. For example, a business application might have customer/3. </P>

<UL>
<PRE><FONT COLOR="#000080">customer('John Jones', boston, good_credit).
customer('Sally Smith', chicago, good_credit).</FONT></PRE>
</UL>

<P>The single quotes are needed around the names because they begin with
uppercase letters and because they have embedded blanks. </P>

<P>Another example is a windowing system that uses facts to store data
about the various windows. In this example the arguments give the window
name and coordinates of the upper left and lower right corners. </P>

<UL>
<PRE><FONT COLOR="#000080">window(main, 2, 2, 20, 72).
window(errors, 15, 40, 20, 78).</FONT></PRE>
</UL>

<P>A medical diagnostic expert system might have disease/2. </P>

<UL>
<PRE><FONT COLOR="#000080">disease(plague, infectious).</FONT></PRE>
</UL>

<P>A Prolog<!AMZI_INDEX= Prolog listener> listener provides the means for
dynamically recording facts and rules in the logicbase, as well as the means
to <B>query</B> (call) them. The logicbase is updated by 'consult'ing or
'reconsult'ing program source. Predicates can also be typed directly into
the listener, but they are not saved between sessions. </P>

<H3><A NAME="NaniSearch"></A>Nani Search </H3>

<P>We will now begin to develop Nani Search by defining the basic facts<!AMZI_INDEX= Facts>
that are meaningful for the game. These include </P>

<UL>
<LI>The rooms and their connections </LI>

<LI>The things and their locations </LI>

<LI>The properties of various things </LI>

<LI>Where the player is at the beginning of the game </LI>
</UL>

<P><IMG SRC="advfig1.gif" HEIGHT=166 WIDTH=291></P>

<P>Figure 2.1. The rooms of Nani Search </P>

<P>Open a new source file and save it as 'myadven.pro', or whatever name you feel 
  is appropriate. You will make your changes to the program in that source file. 
  (A completed version of nanisrch.pro is in the Prolog samples directory, samples/prolog/misc_one_file.) 
</P>

<P>First we define the rooms with the predicate room/1, which has five
clauses, all of which are facts. They are based on the game map in figure
2.1. </P>

<UL>
<PRE><FONT COLOR="#000080">room(kitchen).<!AMZI_INDEX= room/1>
room(office).
room(hall).
room('dining room').
room(cellar).</FONT></PRE>
</UL>

<P>We define the locations of things with a two-argument predicate location/2.
The first argument will mean the thing and the second will mean its location.
To begin with, we will add the following things. </P>

<UL>
<PRE><FONT COLOR="#000080">location(desk, office).<!AMZI_INDEX= location/2>
location(apple, kitchen).
location(flashlight, desk).
location('washing machine', cellar).
location(nani, 'washing machine').
location(broccoli, kitchen).
location(crackers, kitchen).
location(computer, office).</FONT></PRE>
</UL>

<P>The symbols we have chosen, such as kitchen and desk have meaning to
us, but none to Prolog. The relationship between the arguments should also
accurately reflect our meaning. </P>

<P>For example, the meaning we attach to location/2 is &quot;The first
argument is located in the second argument.&quot; Fortunately Prolog considers
location(sink, kitchen) and location(kitchen, sink) to be different. Therefore,
as long as we are consistent in our use of arguments, we can accurately
represent our meaning and avoid the potentially ambiguous interpretation
of the kitchen being in the sink. </P>

<P>We are not as lucky when we try to represent the connections between
rooms. Let's start, however, with door/2, which will contain facts such
as </P>

<UL>
<PRE><FONT COLOR="#000080">door(office, hall).</FONT><!AMZI_INDEX= door/2></PRE>
</UL>

<P>We would like this to mean &quot;There is a connection from the office
to the hall, or from the hall to the office.&quot; </P>

<P>Unfortunately, Prolog considers door(office, hall) to be different from
door(hall, office). If we want to accurately represent a two-way connection,
we would have to define door/2 twice for each connection. </P>

<UL>
<PRE><FONT COLOR="#000080">door(office, hall).
door(hall, office).</FONT></PRE>
</UL>

<P>The strictness about order serves our purpose well for location, but
it creates this problem for connections between rooms. If the office is
connected to the hall, then we would like the reverse to be true as well.
</P>

<P>For now, we will just add one-way doors to the program; we will address
the symmetry problem again in the next chapter and resolve it in chapter
5. </P>

<UL>
<PRE><FONT COLOR="#000080">door(office, hall).
door(kitchen, office).
door(hall, 'dining room').
door(kitchen, cellar).
door('dining room', kitchen).</FONT></PRE>
</UL>

<P>Here are some other facts about properties of things the game player
might try to eat. </P>

<UL>
<PRE><FONT COLOR="#000080">edible(apple).<!AMZI_INDEX= edible/1; tastes_yucky/1>
edible(crackers).

tastes_yucky(broccoli).</FONT></PRE>
</UL>

<P>Finally we define the initial status of the flashlight, and the player's
location at the beginning of the game. </P>

<UL>
<PRE><FONT COLOR="#000080">turned_off(flashlight).
here(kitchen).</FONT></PRE>
</UL>

<P>We have now seen how to use basic facts to represent data in a Prolog
program. </P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<P>During the course of completing the exercises you will develop three Prolog 
  applications in addition to Nani Search. The exercises from each chapter will 
  build on the work of previous chapters. Suggested solutions to the exercises 
  are contained in the Prolog source files listed in the appendix, and are also 
  included in samples/prolog/misc_one_file. The files are </P>

<DL>
<DL>
    <DT>gene</DT>

<DD>A genealogical intelligent logicbase </DD>

<DT>custord</DT>

<DD>A customer order entry application </DD>

<DT>birds </DT>

<DD>An expert system that identifies birds </DD>
</DL>
</DL>

<P>Not all applications will be covered in each chapter. For example, the
expert system requires an understanding of rules and will not be started
until the end of chapter 5. </P>

<H4>Genealogical Logicbase</H4>

<P>1- First create a source file for the genealogical logicbase application.
Start by adding a few members of your family tree. It is important to be
accurate, since we will be exploring family relationships. Your own knowledge
of who your relatives are will verify the correctness of your Prolog programs.
</P>

<P>Start by recording the gender of the individuals. Use two separate predicates, 
  male/1 and female/1. For example</P>

<UL>
<PRE><FONT COLOR="#000080">male(dennis).
male(michael).

female(diana).</FONT></PRE>
</UL>

<P>Remember, if you want to include uppercase characters or embedded blanks
you must enclose the name in single (not double) quotes. For example </P>

<UL>
<PRE><FONT COLOR="#000080">male('Ghenghis Khan').</FONT></PRE>
</UL>

<P>2- Enter a two-argument predicate that records the parent-child relationship.
One argument represents the parent, and the other the child. It doesn't
matter in which order you enter the arguments, as long as you are consistent.
Often Prolog programmers adopt the convention that parent(A,B) is interpreted
&quot;A is the parent of B&quot;. For example </P>

<UL>
<PRE><FONT COLOR="#000080">parent(dennis, michael).
parent(dennis, diana).</FONT></PRE>
</UL>

<H4>Customer Order Entry</H4>

<P>3- Create a source file for the customer order entry program. We will
begin it with three record types (predicates). The first is customer/3
where the three arguments are </P>

<DL>
<DL>
<DT>arg1 </DT>

<DD>Customer name </DD>

<DT>arg2 </DT>

<DD>City </DD>

<DT>arg3 </DT>

<DD>Credit rating (aaa, bbb, etc) </DD>
</DL>
</DL>

<P>Add as many customers as you see fit. </P>

<P>4- Next add clauses that define the items that are for sale. It should
also have three arguments </P>

<DL>
<DL>
<DT>arg1 </DT>

<DD>Item identification number </DD>

<DT>arg2 </DT>

<DD>Item name </DD>

<DT>arg3 </DT>

<DD>The reorder point for inventory (when at or below this level, reorder)
</DD>
</DL>
</DL>

<P>5- Next add an inventory record for each item. It has two arguments.
</P>

<DL>
<DL>
<DT>arg1 </DT>

<DD>Item identification number (same as in the item record) </DD>

<DT>arg2 </DT>

<DD>Amount in stock </DD>
</DL>
</DL>




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
