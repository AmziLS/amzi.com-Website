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

<A NAME="Chapter15"></A>

<table style="width:100%;"><tr>
<td><h1>15</h1></td>
<td style="text-align:right;">

</td>
</tr></table>
<hr />

<H2>Natural Language</H2>

<P>Prolog is especially well-suited for developing natural language<!AMZI_INDEX= Natural language>
systems. In this chapter we will create an English front end for Nani Search.
</P>

<P>But before moving to Nani Search, we will develop a natural language
parser for a simple subset of English. Once that is understood, we will
use the same technology for Nani Search. </P>

<P>The simple subset of English will include sentences such as </P>

<UL>
<LI>The dog ate the bone. </LI>

<LI>The big brown mouse chases a lazy cat. </LI>
</UL>

<P>This grammar<!AMZI_INDEX= Grammar> can be described with the following
grammar rules. (The first rule says a sentence is made up of a noun phrase
followed by a verb phrase. The last rule says an adjective is either 'big',
or 'brown', or 'lazy.' The '|' means 'or.') </P>

<DL>
<DL>
<DT>sentence :</DT>

<DD>nounphrase, verbphrase. </DD>

<DT>nounphrase : </DT>

<DD>determiner, nounexpression. </DD>

<DT>nounphrase : </DT>

<DD>nounexpression. </DD>

<DT>nounexpression : </DT>

<DD>noun. </DD>

<DT>nounexpression :</DT>

<DD>adjective, nounexpression. </DD>

<DT>verbphrase :</DT>

<DD>verb, nounphrase. </DD>

<DT>determiner : </DT>

<DD>the | a. </DD>

<DT>noun : </DT>

<DD>dog | bone | mouse | cat. </DD>

<DT>verb : </DT>

<DD>ate | chases. </DD>

<DT>adjective :</DT>

<DD>big | brown | lazy. </DD>
</DL>
</DL>

<P>To begin with, we will simply determine if a sentence is a legal sentence.
In other words, we will write a predicate sentence/1, which will determine
if its argument is a sentence. </P>

<P>The sentence will be represented as a list of words. Our two examples
are </P>

<UL>
<PRE><FONT COLOR="#000080">[the,dog,ate,the,bone]
[the,big,brown,mouse,chases,a,lazy,cat]</FONT></PRE>
</UL>

<P>There are two basic strategies for solving a parsing problem like this.
The first is a generate-and-test strategy, where the list to be parsed
is split in different ways, with the splittings tested to see if they are
components of a legal sentence. We have already seen that we can use append/3
to generate the splittings of a list. With this approach, the top-level
rule would be </P>

<UL>
<PRE><FONT COLOR="#000080">sentence(L) :-
  append(NP, VP, L),
  nounphrase(NP),
  verbphrase(VP).</FONT></PRE>
</UL>

<P>The append/3 predicate will generate possible values for the variables
NP and VP, by splitting the original list L. The next two goals test each
of the portions of the list to see if they are grammatically correct. If
not, backtracking into append/3 causes another possible splitting to be
generated. </P>

<P>The clauses for nounphrase/1 and verbphrase/1 are similar to sentence/1,
and call further predicates that deal with smaller units of a sentence,
until the word definitions are met, such as </P>

<UL>
<PRE><FONT COLOR="#000080">verb([ate]).
verb([chases]).

noun([mouse]).
noun([dog]).</FONT></PRE>
</UL>

<H3><A NAME="DifferenceLists"></A>Difference Lists
</H3>

<P>The above strategy, however, is extremely slow because of the constant
generation and testing of trial solutions that do not work. Furthermore,
the generating and testing is happening at multiple levels. </P>

<P>The more efficient strategy is to skip the generation step and pass
the entire list to the lower level predicates, which in turn will take
the grammatical portion of the sentence they are looking for from the front
of the list and return the remainder of the list. </P>

<P>To do this, we use a structure called a <B>difference list<!AMZI_INDEX= Lists, difference; Difference lists></B>. It
is two related lists, in which the first list is the full list and the
second list is the remainder. The two lists can be two arguments in a predicate,
but they are more readable if represented as a single argument with the
minus sign (-) operator, like X-Y. </P>

<P>Here then is the first grammar rule using difference lists. A list S
is a sentence if we can extract a nounphrase from the beginning of it,
with a remainder list of S1, and if we can extract a verb phrase from S1
with the empty list as the remainder. </P>

<UL>
<PRE><FONT COLOR="#000080">sentence(S) :-
  nounphrase(S-S1),
  verbphrase(S1-[]).</FONT></PRE>
</UL>

<P>Before filling in nounphrase/1 and verbphrase/1, we will jump to the
lowest level predicates that define the actual words. They too must be
difference lists. They are simple. If the head of the first list is the
word, the remainder list is simply the tail. </P>

<UL>
<PRE><FONT COLOR="#000080">noun([dog|X]-X).
noun([cat|X]-X).
noun([mouse|X]-X).

verb([ate|X]-X).
verb([chases|X]-X).

adjective([big|X]-X).
adjective([brown|X]-X).
adjective([lazy|X]-X).

determiner([the|X]-X).
determiner([a|X]-X).</FONT></PRE>
</UL>

<P>Testing shows how the difference lists work. </P>

<UL>
<PRE><FONT COLOR="#000080">?- noun([dog,ate,the,bone]-X).
X = [ate,the,bone] 

?- verb([dog,ate,the,bone]-X).
no</FONT></PRE>
</UL>

<P>Continuing with the new grammar rules we have </P>

<UL>
<PRE><FONT COLOR="#000080">nounphrase(NP-X):-
  determiner(NP-S1),
  nounexpression(S1-X).
nounphrase(NP-X):-
  nounexpression(NP-X).

nounexpression(NE-X):-
  noun(NE-X).
nounexpression(NE-X):-
  adjective(NE-S1),
  nounexpression(S1-X).

verbphrase(VP-X):-
  verb(VP-S1),
  nounphrase(S1-X).</FONT></PRE>
</UL>

<P>NOTE: The recursive call in the definition of nounexpression/1. It allows
sentences to have any number of adjectives before a noun. </P>

<P>These rules can now be used to test sentences. </P>

<UL>
<PRE><FONT COLOR="#000080">?- sentence([the,lazy,mouse,ate,a,dog]).
yes

?- sentence([the,dog,ate]).
no

?- sentence([a,big,brown,cat,chases,a,lazy,brown,dog]).
yes

?- sentence([the,cat,jumps,the,mouse]).
no</FONT></PRE>
</UL>

<P>Figure 15.1 contains a trace of the sentence/1 predicate for a simple
sentence<!AMZI_INDEX= Difference lists, example trace of>. </P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>The query is 
<PRE><FONT COLOR="#000080">?- sentence([dog,chases,cat]).

1-1 CALL sentence([dog,chases,cat])
    2-1 CALL nounphrase([dog,chases,cat]-_0)
        3-1 CALL determiner([dog,chases,cat]-_0)
        3-1 FAIL determiner([dog,chases,cat]-_0)
    2-1 REDO nounphrase([dog,chases,cat]-_0)
        3-1 CALL nounexpression([dog,chases,cat]- _0)
            4-1 CALL noun([dog,chases,cat]-_0)
            4-1 EXIT noun([dog,chases,cat]-  
            [chases,cat])</FONT></PRE>

<P>Notice how the binding of the variable representing the remainder list
has been deferred until the lowest level is called. Each level unifies
its remainder with the level before it, so when the vocabulary level is
reached, the binding of the remainder to the tail of the list is propagated
back up through the nested calls. </P>

<PRE><FONT COLOR="#000080">        3-1 EXIT nounexpression([dog,chases,cat]-
                        [chases,cat])
    2-1 EXIT nounphrase([dog,chases,cat]-
                    [chases,cat])</FONT></PRE>

<P>Now that we have the noun phrase, we can see if the remainder is a verb
phrase.</P>

<PRE><FONT COLOR="#000080">    2-2 CALL verbphrase([chases,cat]-[])
        3-1 CALL verb([chases,cat]-_4)
        3-1 EXIT verb([chases,cat]-[cat])</FONT></PRE>

<P>Finding the verb was easy, now for the final noun phrase.</P>

<PRE><FONT COLOR="#000080">        3-2 CALL nounphrase([cat]-[])
            4-1 CALL determiner([cat]-[])
            4-1 FAIL determiner([cat]-[])
        3-2 REDO nounphrase([cat]-[])
            4-1 CALL nounexpression([cat]-[])
                5-1 CALL noun([cat]-[])
                5-1 EXIT noun([cat]-[])
            4-1 EXIT nounexpression([cat]-[])
        3-2 EXIT nounphrase([cat]-[])
    2-2 EXIT verbphrase([chases,cat]-[])
1-1 EXIT sentence([dog,chases,cat])
      yes</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 15.1. Trace of sentence/1 </P>

<H3><A NAME="NaturalLanguageFrontEnd"></A>Natural
Language Front End</H3>

<P>We will now use this sentence-parsing technique to build a simple English
language front end for Nani Search. </P>

<P>For the time being we will make two assumptions. The first is that we
can get the user's input sentence in list form. The second is that we can
represent our commands in list form. For example, we can express goto(office)
as [goto, office], and look as [look]. </P>

<P>With these assumptions, the task of our natural language front end is
to translate a user's natural sentence list into an acceptable command
list. For example, we would want to translate [go,to,the,office] into [goto,
office]. </P>

<P>We will write a high-level predicate, called command/2, that performs
this translation. Its format will be </P>

<UL>
<PRE><FONT COLOR="#000080">command(OutputList, InputList).</FONT></PRE>
</UL>

<P>The simplest commands are the ones that are made up of a verb with no
object, such as look, list_possessions, and end. We can define this situation
as follows. </P>

<UL>
<PRE><FONT COLOR="#000080">command([V], InList):- verb(V, InList-[]).</FONT></PRE>
</UL>

<P>We will define verbs as in the earlier example, only this time we will
include an extra argument, which identifies the command for use in building
the output list. We can also allow as many different ways of expressing
a command as we feel like as in the two ways to say 'look' and the three
ways to say 'end.' </P>

<UL>
<PRE><FONT COLOR="#000080">verb(look, [look|X]-X).
verb(look, [look,around|X]-X).
verb(list_possessions, [inventory|X]-X).
verb(end, [end|X]-X).
verb(end, [quit|X]-X).
verb(end, [good,bye|X]-X).</FONT></PRE>
</UL>

<P>We can now test what we've got. </P>

<UL>
<PRE><FONT COLOR="#000080">?- command(X,[look]).
X = [look]

?- command(X,[look,around]).
X = [look]

?- command(X,[inventory]).
X = [list_possessions]

?- command(X,[good,bye]).
X = [end]</FONT></PRE>
</UL>

<P>We now move to the more complicated case of a command composed of a
verb and an object. Using the grammatical constructs we saw in the beginning
of this chapter, we could easily construct this grammar. However, we would
like to have our interface recognize the semantics of the sentence as well
as the formal grammar. </P>

<P>For example, we would like to make sure that 'goto' verbs have a place
as an object, and that the other verbs have a thing as an object. We can
include this knowledge in our natural language routine with another argument.
</P>

<P>Here is how the extra argument is used to ensure the object type required
by the verb matches the object type of the noun. </P>

<UL>
<PRE><FONT COLOR="#000080">command([V,O], InList) :-
  verb(Object_Type, V, InList-S1),
  object(Object_Type, O, S1-[]).</FONT></PRE>
</UL>

<P>Here is how we specify the new verbs. </P>

<UL>
<PRE><FONT COLOR="#000080">verb(place, goto, [go,to|X]-X).
verb(place, goto, [go|X]-X).
verb(place, goto, [move,to|X]-X).</FONT></PRE>
</UL>

<P>We can even recognize the case where the 'goto' verb was implied, that
is if the user just typed in a room name without a preceding verb. In this
case the list and its remainder are the same. The existing room/1 predicate
is used to check if the list element is a room except when the room name
is made up of two words. </P>

<P>The rule states &quot;If we are looking for a verb at the beginning
of a list, and the list begins with a room, then assume a 'goto' verb was
found and return the full list for processing as the object of the 'goto'
verb.&quot; </P>

<UL>
<PRE><FONT COLOR="#000080">verb(place, goto, [X|Y]-[X|Y]):- room(X).
verb(place, goto, [dining,room|Y]-[dining,room|Y]).</FONT></PRE>
</UL>

<P>Some of the verbs for things are </P>

<UL>
<PRE><FONT COLOR="#000080">verb(thing, take, [take|X]-X).
verb(thing, drop, [drop|X]-X).
verb(thing, drop, [put|X]-X).
verb(thing, turn_on, [turn,on|X]-X).</FONT></PRE>
</UL>

<P>Optionally, an 'object' may be preceded by a determiner. Here are the
two rules for 'object,' which cover both cases. </P>

<UL>
<PRE><FONT COLOR="#000080">object(Type, N, S1-S3) :-
  det(S1-S2),
  noun(Type, N, S2-S3).
object(Type, N, S1-S2) :-
  noun(Type, N, S1-S2).</FONT></PRE>
</UL>

<P>Since we are just going to throw the determiner away, we don't need
to carry extra arguments. </P>

<UL>
<PRE><FONT COLOR="#000080">det([the|X]- X).
det([a|X]-X).
det([an|X]-X).</FONT></PRE>
</UL>

<P>We define nouns like verbs, but use their occurrence in the game to
define most of them. Only those names that are made up of two or more words
require special treatment. Nouns of place are defined in the game as rooms.
</P>

<UL>
<PRE><FONT COLOR="#000080">noun(place, R, [R|X]-X):- room(R).
noun(place, 'dining room', [dining,room|X]-X).</FONT></PRE>
</UL>

<P>Things are distinguished by appearing in a 'location' or 'have' predicate.
Again, we make exceptions for cases where the thing name has two words.
</P>

<UL>
<PRE><FONT COLOR="#000080">noun(thing, T, [T|X]-X):- location(T,_).
noun(thing, T, [T|X]-X):- have(T).
noun(thing, 'washing machine', [washing,machine|X]-X).</FONT></PRE>
</UL>

<P>We can build into the grammar an awareness of the current game situation,
and have the parser respond accordingly. For example, we might provide
a command that allows the player to turn the room lights on or off. This
command might be turn_on(light) as opposed to turn_on(flashlight). If the
user types in 'turn on the light' we would like to determine which light
was meant. </P>

<P>We can assume the room light was always meant, unless the player has
the flashlight. In that case we will assume the flashlight was meant. </P>

<UL>
<PRE><FONT COLOR="#000080">noun(thing, flashlight, [light|X], X):- have(flashlight).
noun(thing, light, [light|X], X).</FONT></PRE>
</UL>

<P>We can now try it out. </P>

<UL>
<PRE><FONT COLOR="#000080">?- command(X,[go,to,the,office]).
X = [goto, office]

?- command(X,[go,dining,room]).
X = [goto, 'dining room']

?- command(X,[kitchen]).
X = [goto, kitchen]

?- command(X,[take,the,apple]).
X = [take, apple]

?- command(X,[turn,on,the,light]).
X = [turn_on, light]

?- asserta(have(flashlight)), command(X,[turn,on,the,light]).
X = [turn_on, flashlight]</FONT></PRE>
</UL>

<P>It should fail in the following situations that don't conform to our
grammar or semantics. </P>

<UL>
<PRE><FONT COLOR="#000080">?- command(X,[go,to,the,desk]).
no

?- command(X,[go,attic]).
no

?- command(X,[drop,an,office]).
no</FONT></PRE>
</UL>

<H3><A NAME="DefiniteClauseGrammar"></A>Definite
Clause Grammar</H3>

<P>The use of difference lists for parsing is so common in Prolog, that
most Prologs contain additional syntactic sugaring that simplifies the
syntax by hiding the difference lists from view. This syntax is called
<B>Definite Clause Grammar<!AMZI_INDEX= DCG (Definite Clause Grammar)></B>
(DCG), and looks like normal Prolog, only the neck symbol (:-) is replaced
with an arrow (--&gt;). The DCG representation is parsed and translated
to normal Prolog with difference lists. </P>

<P>Using DCG, the 'sentence' predicate developed earlier would be phrased
</P>

<UL>
<PRE><FONT COLOR="#000080">sentence --&gt; nounphrase, verbphrase.</FONT></PRE>
</UL>

<P>This would be translated into normal Prolog, with difference lists,
but represented as separate arguments rather than as single arguments separated
by a minus (-) as we implemented them. The above example would be translated
into the following equivalent Prolog. </P>

<UL>
<PRE><FONT COLOR="#000080">sentence(S1, S2):-
  nounphrase(S1, S3),
  verbphrase(S3, S2).</FONT></PRE>
</UL>

<P>Thus, if we define 'sentence' using DCG we still must call it with two
arguments, even though the arguments were not explicitly stated in the
DCG representation. </P>

<UL>
<PRE><FONT COLOR="#000080">?- sentence([dog,chases,cat], []).</FONT></PRE>
</UL>

<P>The DCG vocabulary is represented by simple lists. </P>

<UL>
<PRE><FONT COLOR="#000080">noun --&gt; [dog].
verb --&gt; [chases].</FONT></PRE>
</UL>

<P>These are translated into Prolog as difference lists. </P>

<UL>
<PRE><FONT COLOR="#000080">noun([dog|X], X).
verb([chases|X], X).</FONT></PRE>
</UL>

<P>As with the natural language front end for Nani Search, we often want
to mix pure Prolog with the grammar and include extra arguments to carry
semantic information. The arguments are simply added as normal arguments
and the pure Prolog is enclosed in curly brackets ({}) to prevent the DCG
parser from translating it. Some of the complex rules in our game grammar
would then be </P>

<UL>
<PRE><FONT COLOR="#000080">command([V,O]) --&gt; 
  verb(Object_Type, V), 
  object(Object_Type, O).

verb(place, goto) --&gt; [go, to].
verb(thing, take) --&gt; [take].

object(Type, N) --&gt; det, noun(Type, N).
object(Type, N) --&gt; noun(Type, N).

det --&gt; [the].
det --&gt; [a].

noun(place,X) --&gt; [X], {room(X)}.
noun(place,'dining room') --&gt; [dining, room].
noun(thing,X) --&gt; [X], {location(X,_)}.</FONT></PRE>
</UL>

<P>Because the DCG automatically takes off the first argument, we cannot
examine it and send it along as we did in testing for a 'goto' verb when
only the room name was given in the command. We can recognize this case
with an additional 'command' clause. </P>

<UL>
<PRE><FONT COLOR="#000080">command([goto, Place]) --&gt; noun(place, Place).</FONT></PRE>
</UL>

<H3><A NAME="ReadingSentences"></A>Reading Sentences
</H3>

<P>Now for the missing pieces. We must include a predicate that reads a
normal sentence from the user and puts it into a list. Figure 15.2 contains
a program to perform the task. It is composed of two parts. The first part
reads a line of ASCII characters from the user, using the built-in predicate
get0/1, which reads a single ASCII character. The line is assumed terminated
by an ASCII 13, which is a carriage return. The second part uses DCG to
parse the list of characters into a list of words, using another built-in
predicate name/2, which converts a list of ASCII characters into an atom.
</P>

<TABLE BORDER=1 CELLPADDING=3 >
<TR>
<TD>
<PRE><FONT COLOR="#000080">% read a line of words from the user

read_list(L) :-
  write('&gt; '),
  read_line(CL),
  wordlist(L,CL,[]), !.

read_line(L) :-
  get0(C),
  buildlist(C,L).

buildlist(13,[]) :- !.
buildlist(C,[C|X]) :-
  get0(C2),
  buildlist(C2,X).
 
wordlist([X|Y]) --&gt; word(X), whitespace, wordlist(Y).
wordlist([X]) --&gt; whitespace, wordlist(X).
wordlist([X]) --&gt; word(X).
wordlist([X]) --&gt; word(X), whitespace.

word(W) --&gt; charlist(X), {name(W,X)}.

charlist([X|Y]) --&gt; chr(X), charlist(Y).
charlist([X]) --&gt; chr(X).

chr(X) --&gt; [X],{X&gt;=48}.

whitespace --&gt; whsp, whitespace.
whitespace --&gt; whsp.

whsp --&gt; [X], {X&lt;48}.</FONT></PRE>
</TD>
</TR>
</TABLE>

<P>Figure 15.2. Program to read input sentences </P>

<P>The other missing piece converts a command in the format [goto,office]
to a normal-looking command goto(office). This is done with a standard
built-in predicate called 'univ', which is represented by an equal sign
and two periods (=..). It translates a predicate and its arguments into
a list whose first element is the predicate name and whose remaining elements
are the arguments. It works in reverse as well, which is how we will want
to use it. For example </P>

<UL>
<PRE><FONT COLOR="#000080">?- pred(arg1,arg2) =..  X.
X = [pred, arg1, arg2] 

?- pred =..  X.
X = [pred] 

?- X =..  [pred,arg1,arg1].
X = pred(arg1, arg2) 

?- X =..  [pred].
X = pred </FONT></PRE>
</UL>

<P>We can now use these two predicates, along with command/2 to write get_command/1,
which reads a sentence from the user and returns a command to command_loop/0.
</P>

<UL>
<PRE><FONT COLOR="#000080">get_command(C) :-
  read_list(L),
  command(CL,L),
  C =..  CL, !.
get_command(_) :-
  write('I don''t understand'), nl, fail.</FONT></PRE>
</UL>

<P>We have now gone from writing the simple facts in the early chapters
to a full adventure game with a natural language front end. You have also
written an expert system, an intelligent genealogical logicbase and a standard
business application. Use these as a basis for continued learning by experimentation.
</P>

<H3><A NAME="Exercises"></A>Exercises</H3>

<H4>Adventure Game</H4>

<P>1- Expand the natural language capabilities to handle all of the commands
of Nani Search. </P>

<P>2- Expand the natural language front end to allow for compound sentences,
such as &quot;go to the kitchen and take the apple,&quot; or &quot;take
the apple and the broccoli.&quot; </P>

<P>3- Expand the natural language to allow for pronouns. To do this the
'noun' predicate must save the last noun and its type. When the word 'it'
is encountered pick up that last noun. Then 'take the apple' followed by
'eat it' will work. (You will probably have to go directly to the difference
list notation to make sentences such as &quot;turn it on&quot; work.) </P>

<H4>Genealogical Logicbase</H4>

<P>4- Build a natural language query system that responds to queries such
as &quot;Who are dennis' children?&quot; and &quot;How many nephews does
jay have?&quot; Assuming you write a predicate get_query/1 that returns
a Prolog query, you can call the Prolog query with the call/1 built-in
predicate. For example, </P>

<UL>
<PRE><FONT COLOR="#000080">main_loop :-
  repeat,
  get_query(X),
  call(X),
  X = end.</FONT></PRE>
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
