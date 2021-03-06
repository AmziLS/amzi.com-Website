<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Expert Systems in Prolog</title>
<meta name="description" content="Amzi! inc. provides software and services for
 embedding intelligent components that apply busines rules, diagnose problems, recommend configurations, 
give advice, schedule events, monitor processes and more.">

<meta name="keywords" content="Prolog, logic programming, expert systems, ai, rule engines, artificial intelligence,
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
    require ("sidebar.php");
    ?>
    <!--End Side Navigation-->

    <div id="beef">
    
        <!--Start content-->
<table style="width:100%;"><tr>
<td><h1>4 Explanation</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>It 
  is often claimed that an important aspect of expert systems is the ability to 
  explain their behavior. This means the user can ask the system for justification 
  of conclusions or questions at any point in a consultation with an expert system. 
  The system usually responds with the rules that were used for the conclusion, 
  or the rules being considered which led to a question to the user.</P>
<h2><B><a name="valueofexplanationstotheuser"></a>Value 
  of Explanations to the User</B></h2>
<P>The 
  importance of this feature is probably overestimated for the user. Typically 
  the user just wants the answer. Furthermore, when the user does want an explanation, 
  the explanation is not always useful. This is due to the nature of the "intelligence" 
  in an expert system.</P>
<P>The 
  rules typically reflect empirical, or "compiled" knowledge. They are codifications 
  of an expert's rules of thumb, not the expert's deeper understanding which led 
  to the rules of thumb. For example, consider the following dialog with an expert 
  system designed to give advice on car problems:</P>
<DIR> 
  <DIR> <B> </b> 
    <P>Does the car 
      start?<B> no.</b></P>
    <P>Does the engine 
      turn over?<B> yes.</b></P>
    <P>Do you smell 
      gas?<B> yes.</b></P>
    <P>Recommendation 
      - Wait 5 minutes and try again.</P>
    <P><B>why?</B></P>
    <P>I used the rule:<BR>
      If&#9;not start, and<BR>
      &#9;engine_turn_over, and<BR>
      &#9;smell_gas<BR>
      Then&#9;recommend is 'Wait 5 minutes and try again.'.</P>
  </DIR>
</DIR>
<P>The 
  rule gives the correct advice for a flooded car, and knows the questions to 
  ask to determine if the car is flooded, but it does not contain the knowledge 
  of what a flooded car is and why waiting will help. If the user really wanted 
  to understand what was happening, he/she would need a short dissertation on 
  carburetors, how they behave, and their relationship to the gas pedal.</P>
<P>For 
  a system such as this to have useful explanations, it would need to do more 
  than parrot the rules used. One approach is to annotate the rules with deeper 
  explanations. This is illustrated in chapter 10. Another approach being actively 
  researched is to encode the deeper knowledge into the system and use it to drive 
  both the inference and the explanations.</P>
<P>On 
  the other hand, there are some systems in which the expert's knowledge is just 
  empirical knowledge. In this case, the system's explanation is useful to the 
  user. Classification systems such as the bird identification system fall in 
  this category. The Bird system would explain an identification of a laysan albatross 
  with the rule used to identify it. There is no underlying theory as to why a 
  white albatross is a laysan albatross and a dark one is a black footed albatross. 
  That is simply the rule used to classify them.</P>
<h2 ALIGN="JUSTIFY"><B><a name="valueofexplanationstothedeveloper"></a>Value 
  of Explanations to the Developer</B></h2>
<P>While 
  an explanation feature might be of questionable value to the user of the system, 
  it is invaluable to the developer of the system. It serves the same diagnostic 
  purpose as program tracing for conventional programs. When the system is not 
  behaving correctly, the expert can use the explanations to find the rules which 
  are in error. The knowledge engineer uses the explanations to better tune the 
  knowledge base to have more realistic dialogs with the user.</P>
<h2 ALIGN="JUSTIFY"><B><a name="typesofexplanations"></a>Types 
  of Explanation</B></h2>
<P>There 
  are four types of explanations commonly used in expert systems. We will implement 
  most of these in both the Clam shell and the Native shell:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;a 
      rule trace which reports on the progress of a consultation;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;explanation 
      of <B>how</B> the system reached a given conclusion;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;explanation 
      of <B>why</B> the system is asking a question;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;explanation 
      of <B>why not</B> a given conclusion.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Since 
  we wrote the inference engine for Clam it will not be difficult to modify it 
  to include these features. The Native system currently uses Prolog's inference 
  engine. In order to add explanation it will be necessary to write our own Prolog 
  inference engine. Fortunately it is not difficult to write Prolog in Prolog.</P>
<h1><B> <a name="explanationinclam"></a>4.1 
  Explanation in Clam </B></h1>
<P>First, 
  let's look at some examples of the explanation features of Clam using the Car 
  system. Here is how the user turns on tracing for the consultation, and the 
  results. The new trace information is in bold. It shows the sequence of rule 
  firings as they are expected. Notice in particular that it reports correctly 
  on the nesting of rules 2 and 3 within rule 1.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>consult, restart, 
      load, list, trace, how, exit</P>
    <P><B>:trace on</B></P>
    <P>consult, restart, 
      load, list, trace, how, exit</P>
    <P>:consult</P>
    <P><B>call rule 
      1 </B></P>
    <P>Does the engine 
      turn over?</P>
    <P>: no</P>
    <P><B>call rule 
      2 </B></P>
    <P>Are the lights 
      weak?</P>
    <P>: yes</P>
    <P><B>exit rule 
      2 </B></P>
    <P><B>call rule 
      3 </B></P>
    <P>Is the radio 
      weak?</P>
    <P>: yes</P>
    <P><B>exit rule 
      3 </B></P>
    <P><B>exit rule 
      1 </B></P>
    <P><B>call rule 
      4 </B></P>
    <P><B>fail rule 
      4</B></P>
    <P><B>call rule 
      5 </B></P>
    <P><B>fail rule 
      5</B></P>
    <P><B>call rule 
      6 </B></P>
    <P><B>fail rule 
      6</B></P>
    <P>problem-battery-cf-75</P>
    <P>done with problem</P>
  </DIR>
</DIR>
<P>Next 
  we can look at the use of why explanations. The user would ask why and get the 
  inference chain that led to the question. For example:</P>
<DIR> 
  <DIR> <B> </b> 
    <P>...</P>
    <P>Is the radio 
      weak?</P>
    <P><B>: why</B></P>
    <P>rule 3 </P>
    <P>If </P>
    <P> radio_weak </P>
    <P>Then </P>
    <P> battery_bad 
      50 </P>
    <P>rule 1 </P>
    <P>If </P>
    <P> not turn_over 
      </P>
    <P> battery_bad 
      </P>
    <P>Then </P>
    <P> problem is battery 
      100 </P>
    <P>goal problem 
      </P>
    <P>...</P>
  </DIR>
</DIR>
<P>Notice 
  that the why explanation gives the chain of rules, in reverse order, that led 
  to the question. In this case the <B>goal</B> <B>problem</B> led to rule 1 which 
  led to rule 3.</P>
<P>The 
  how explanations start with answers. For example, the system has just reported 
  that the problem is the battery. The user wants to know how this result was 
  derived.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>...</P>
    <P>problem-battery-cf-75</P>
    <P>done with problem</P>
    <P>consult, restart, 
      load, list, trace, how, exit</P>
    <P><B>:how</B></P>
    <P>Goal?<B> problem 
      is battery</b></P>
    <P>problem is battery 
      was derived from rules: 1 </P>
    <P>rule 1 </P>
    <P>If </P>
    <P> not turn_over 
      </P>
    <P> battery_bad 
      </P>
    <P>Then </P>
    <P> problem is battery 
      100 </P>
  </DIR>
</DIR>
<P>In 
  this case the rule(s) which directly supported the result are listed. Next the 
  user wants to know how <B>battery_bad</B> was derived.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>consult, restart, 
      load, list, trace, how, exit</P>
    <P><B>:how</B></P>
    <P>Goal?<B> battery_bad</b></P>
    <P>battery_bad was 
      derived from rules: 3 2 </P>
    <P>rule 3 </P>
    <P>If </P>
    <P> radio_weak </P>
    <P>Then </P>
    <P> battery_bad 
      50 </P>
    <P>rule 2 </P>
    <P>If </P>
    <P> lights_weak 
      </P>
    <P>Then </P>
    <P> battery_bad 
      50 </P>
  </DIR>
</DIR>
<P>In 
  this case there were two rules which supported the goal, and the system lists 
  them both.</P>
<P>Figure 
  4.1 shows the difference between how and why questions. The why questions occur 
  at the bottom of an inference chain, and the how questions occur at the top.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="explanation4-1.gif" WIDTH=364 HEIGHT=257><BR>
  </P>
<P>Figure 
  4.1. Difference between how and why questions</P>
<h2 ALIGN="JUSTIFY"><B><a name="tracing"></a>Tracing</B></h2>
<P>The 
  first explanation addition to Clam will be the rule tracing facility. It will 
  behave similarly to the Prolog box model traces, and inform the user when a 
  rule is "call"ed, "exit"ed, or "fail"ed. It will use a special predicate <B>bugdisp</B> 
  to communicate trace information with the user. It will take as an argument 
  a list of terms to be written on a line.</P>
<TABLE CELLSPACING=0 BORDER=0 WIDTH=430>
  <TR> 
    <TD VALIGN="TOP"> 
      <P>To 
        make it a user option, <B>bugdisp</B> will only write if <B>ruletrace</B> 
        is true. The user will have a new high level command to turn tracing on 
        or off which will assert or retract <B>ruletrace</B>. We can then use 
        <B>bugdisp</B> to add any diagnostics printout we like to the program. 
    </TD>
  </TR>
</TABLE>
<DIR> 
  <DIR> 
    <P><B>bugdisp(L) 
      :-<BR>
      ruletrace, <BR>
      write_line(L), !.</B></P>
    <P><B>bugdisp(_).</B></P>
    <P><B>write_line([]) 
      :- nl.</B></P>
    <P><B>write_line([H|T]) 
      :-<BR>
      write(H), <BR>
      tab(1), <BR>
      write_line(T).</B></P>
  </DIR>
</DIR>
<P>Here 
  is the new command added to the <B>do</B> predicate called by the command loop 
  predicate, <B>go</B>. It allows the user to turn tracing on or off by issuing 
  the command <B>trace(on)</B> or <B>trace(off)</B>.</P>
<DIR><B></b> 
  <DIR> 
    <P><B>do( trace(X) 
      ) :- set_trace(X), !.</B></P>
    <P><B>set_trace(off) 
      :-<BR>
      ruletrace, <BR>
      retract( ruletrace ).</B></P>
    <P><B>set_trace(on) 
      :-<BR>
      not ruletrace, <BR>
      asserta( ruletrace ).</B></P>
    <P><B>set_trace(_).</B></P>
  </DIR>
</DIR>
<P>Now 
  that we have the tools for displaying trace information, we need to add <B>bugdisp</B> 
  calls in the predicate which recursively tries rules, <B>fg</B>. It is easy 
  to determine in <B>fg</B> when a rule is called and when it has been successful. 
  After the call to <B>rule</B> succeeds, the rule has been called. After the 
  call to <B>prove</B>, the rule has been successfully fired. The new code for 
  the predicate is added in bold. <BR>
  </P>
<DIR> 
  <DIR> 
    <P>fg(Goal, CurCF) 
      :-<BR>
      rule(N, lhs(IfList), rhs(Goal, CF)), <BR>
      <B>bugdisp(['call rule', N]), <BR>
      </B>prove(N, IfList, Tally), <BR>
      <B>bugdisp(['exit rule', N]), <BR>
      </B>adjust(CF, Tally, NewCF), <BR>
      update(Goal, NewCF, CurCF, N), <BR>
      CurCF == 100, !.</P>
    <P>fg(Goal, CF) 
      :- fact(Goal, CF).</P>
  </DIR>
</DIR>
<P>All 
  that remains is to capture rules that fail after being called. The place to 
  do this is in a second clause to <B>prove, </B>which is called when the first 
  clause fails. The second clause informs the user of the failure, and continues 
  to fail.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>prove(N, IfList, 
      Tally) :-<BR>
      prov(IfList, 100, Tally), !.</P>
    <P><B>prove(N, _, 
      _) :-<BR>
      bugdisp(['fail rule', N]), <BR>
      fail.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="howexplanations"></a>How 
  Explanations</B></h2>
<P>The 
  next explanation feature to implement is how. The how question is asked by the 
  user to see the proof of some conclusion the system has reached. The proof can 
  be generated by either rederiving the result with extra tracing, or by having 
  the original derivation stored in working storage. Clam uses the second option 
  and stores derivation information with the <B>fact</B> in working storage. Each 
  fact might have been derived from multiple rules, all concluding the same attribute 
  value pair and combining certainty factors. For this reason, a list of rule 
  numbers is stored as the third argument to <B>fact</B>. This is not the entire 
  proof tree, but just those rules which conclude the fact directly.</P>
<DIR> 
  <DIR> 
    <P><B>fact(AV, CF, 
      RuleList)</B></P>
  </DIR>
</DIR>
<P>A 
  <B>fact</B> is updated by <B>update</B>, so this is where the derivation is 
  captured. A new argument is added to <B>update</B> which is the rule number 
  that caused the update. Note that the first clause of <B>update</B> adds the 
  new rule number to the list of existing derivation rule numbers for the <B>fact</B>. 
  The second clause merely creates a new list with a single element. </P>
<DIR> 
  <DIR> 
    <P>update(Goal, 
      NewCF, CF<B>, RuleN</B>) :-<BR>
      fact(Goal, OldCF<B>, _</B>), <BR>
      combine(NewCF, OldCF, CF), <BR>
      retract( fact(Goal, OldCF<B>, OldRules</B>) ), <BR>
      asserta( fact(Goal, CF<B>, [RuleN | OldRules]</B>) ), !.</P>
    <P>update(Goal, 
      CF, CF<B>, RuleN</B>) :-<BR>
      asserta( fact(Goal, CF<B>, [RuleN]</B>) ).</P>
  </DIR>
</DIR>
<P>The 
  call to update from fg is modified to fill in the new argument with a rule number:</P>
<DIR> 
  <DIR> 
    <P>fg(Goal, CurCF) 
      :-<BR>
      rule(N, lhs(IfList), rhs(Goal, CF)), <BR>
      ...<BR>
      update(Goal, NewCF, CurCF<B>, N</B>), <BR>
      ...</P>
  </DIR>
</DIR>
<P>Now 
  that the supporting rules for each derived fact are in working storage we can 
  answer a user's question about how a fact was derived. The simplest thing to 
  do is to have <B>how</B> simply write the list of rules used. It is probably 
  of more interest to the user to actually display the rules as well. The predicate 
  <B>list_rules</B> does that.</P>
<DIR> 
  <DIR> 
    <P><B>how(Goal) 
      :-<BR>
      fact(Goal, CF, Rules), <BR>
      CF &gt; 20, <BR>
      pretty(Goal, PG), <BR>
      write_line([PG, was, derived, from, 'rules: '|Rules]), <BR>
      nl, <BR>
      list_rules(Rules), <BR>
      fail.</B></P>
    <P><B>how(_).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>how</B> predicate for negated goals is similar and uses the fact that negation 
  is represented by a negative CF.</P>
<DIR> 
  <DIR> 
    <P><B>how(not Goal) 
      :-<BR>
      fact(Goal, CF, Rules), <BR>
      CF &lt; -20, <BR>
      pretty(not Goal, PG), <BR>
      write_line([PG, was, derived, from, 'rules: '|Rules]), <BR>
      nl, <BR>
      list_rules(Rules), <BR>
      fail.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>pretty</B> predicate is used to convert <B>av</B> structures into a more 
  readable list and visa versa.</P>
<DIR> 
  <DIR> 
    <P><B>pretty(av(A, 
      yes), [A]) :- !.</B></P>
    <P><B>pretty(not 
      av(A, yes), [not, A]) :- !.</B></P>
    <P><B>pretty(av(A, 
      no), [not, A]) :- !.</B></P>
    <P><B>pretty(not 
      av(A, V), [not, A, is, V]).</B></P>
    <P><B>pretty(av(A, 
      V), [A, is, V]).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>list_rules</B> predicate writes a formatted listing of each rule used in 
  deriving a given fact.</P>
<DIR> 
  <DIR> 
    <P><B>list_rules([]).</B></P>
    <P><B>list_rules([R|X]) 
      :-<BR>
      list_rule(R), <BR>
      list_rules(X).</B></P>
    <P><B>list_rule(N) 
      :-<BR>
      rule(N, lhs(Iflist), rhs(Goal, CF)), <BR>
      write_line(['rule ', N]), <BR>
      write_line(['If']), <BR>
      write_ifs(Iflist), <BR>
      write_line(['Then']), <BR>
      pretty(Goal, PG), <BR>
      write_line([' ', PG, CF]), nl.</B></P>
    <P><B>write_ifs([]).</B></P>
    <P><B>write_ifs([H|T]) 
      :-<BR>
      pretty(H, HP), <BR>
      tab(5), write_line(HP), <BR>
      write_ifs(T).</B></P>
  </DIR>
</DIR>
<P>We 
  can use <B>pretty</B> in reverse, along with a predicate that reads a list of 
  tokens from a line to provide a nicer interface to the user for how questions. 
  In this way the user doesn't have to specify the internal form of the fact.</P>
<DIR> 
  <DIR> 
    <P><B>how :-<BR>
      write('Goal? '), read_line(X), nl, <BR>
      pretty(Goal, X), <BR>
      how(Goal).</B></P>
  </DIR>
</DIR>
<P>The 
  how command can now be added as part of the top level user interface:</P>
<DIR> 
  <DIR> 
    <P><B>do(how) :- 
      how, !.</B></P>
  </DIR>
</DIR>
<P>The 
  full <B>how</B> command as coded above just displays for the user the rules 
  directly responsible for a fact. These rules themselves are likely based on 
  other facts which were derived as well. There are two ways of presenting this 
  information:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;let 
      the user ask further <B>how</B>s of the various rules' left hand side goals 
      to delve deeper into the proof tree;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;have 
      <B>how</B> automatically display the entire proof tree.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>So 
  far we have chosen the first. In order to implement the second choice, a predicate 
  <B>how_lhs</B> needs to be written which will trace the full tree by recursively 
  calling <B>how</B> for each of the goals in the <B>Iflist</B> of the rule.</P>
<DIR> 
  <DIR> 
    <P>list_rules([]).</P>
    <P>list_rules([R|X]) 
      :-<BR>
      list_rule(R), <BR>
      <B>how_lhs(R), <BR>
      </B>list_rules(X).</P>
    <P><B>how_lhs(N) 
      :-<BR>
      rule(N, lhs(Iflist), _), <BR>
      !, how_ifs(Iflist).<BR>
      </B></P>
    <P><B>how_ifs([]).</B></P>
    <P><B>how_ifs([Goal|X]) 
      :-<BR>
      how(Goal), <BR>
      how_ifs(X).</B></P>
  </DIR>
</DIR>
<P>The 
  three choices of user interface for hows (just rule numbers, listings of direct 
  rules, list of full proof tree) shows some of the problems with shells and the 
  advantages of a toolbox approach. In a customized expert system, the options 
  which makes the most sense for the application can be used. In a generalized 
  system the designer is faced with two unpleasant choices. One is to keep the 
  system easy to use and pick one option for all users. The other is to give the 
  flexibility to the user and provide all three, thus making the product more 
  complex for the user to learn.</P>
<h2 ALIGN="JUSTIFY"><B><a name="whyquestions"></a>Why 
  Questions</B></h2>
<P>The 
  <B>how</B> question is asked from the top level of an inference, after the inference 
  has been completed. The <B>why</B> question is asked at the bottom of a chain 
  of rules when there are no more rules and it is time to ask the user. The user 
  wants to know <B>why</B> the question is being asked.</P>
<TABLE CELLSPACING=0 BORDER=0 WIDTH=430>
  <TR> 
    <TD VALIGN="TOP"> 
      <P>In 
        order to be able to answer this type of question, we must keep track of 
        the inference chain that led to the question to the user. One way to do 
        this is to keep an extra argument in the inference predicates that contains 
        the chain of rules above it in the inference. This is done in <B>findgoal</B> 
        and <B>prove</B>. Each keeps a separate argument <B>Hist</B> which is 
        the desired list of rules. The list is initially the empty list at the 
        top call to <B>findgoal</B>. 
    </TD>
  </TR>
</TABLE>
<B></B> 
<DIR> 
  <DIR> <B> </b> 
    <P>findgoal(Goal, 
      CurCF<B>, Hist</B>) :-<BR>
      fg(Goal, CurCF<B>, Hist</B>).<BR>
      </P>
    <P>fg(Goal, CurCF<B>, 
      Hist</B>) :-<BR>
      ...<BR>
      prove(N, IfList, Tally<B>, Hist</B>), <BR>
      ...</P>
  </DIR>
</DIR>
<P>The 
  <B>prove</B> predicate maintains the list by adding the current rule number 
  on the head of the list before a recursive call to <B>findgoal</B>. The calls 
  further down the recursion have this new rule number available for answers to 
  <B>why</B> questions. Notice that both Prolog's recursive behavior and backtracking 
  assure that the history is correct at any level of call.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>prove(N, IfList, 
      Tally<B>, Hist</B>) :-<BR>
      prov(IfList, 100, Tally, <B>[N|Hist]</B>), !.</P>
    <P>prove(N, _<B>, 
      _</B>) :-<BR>
      bugdisp(['fail rule', N]), <BR>
      fail.</P>
    <P>prov([], Tally, 
      Tally<B>, Hist</B>).</P>
    <P>prov([H|T], CurTal, 
      Tally<B>, Hist</B>) :-<BR>
      findgoal(H, CF<B>, Hist</B>), <BR>
      min(CurTal, CF, Tal), <BR>
      Tal &gt;= 20, <BR>
      prov(T, Tal, Tally<B>, Hist</B>).</P>
  </DIR>
</DIR>
<P>Finally, 
  we need to give the user the ability to ask the why question without disturbing 
  the dialog. This means replacing the old <B>read</B>s of user input with a new 
  predicate, <B>get_user</B> which gets an answer from the user and processes 
  it as a <B>why</B> command if necessary. <B>Hist</B> is of course passed down 
  as an argument and is available for <B>get_user</B> to process. Also, rather 
  than just displaying rule numbers, we can list the rules for the user as well.</P>
<P>The 
  <B>process_ans</B> predicate first looks for command patterns and behaves accordingly. 
  If it is a command, the command is executed and then failure is invoked causing 
  the system to backtrack and reask the user for an answer.</P>
<P>Note 
  that now that we are capturing and interpreting the user's response with more 
  intelligence, we can give the user more options. For example, at the question 
  level he/she can turn tracing on or off for the duration of the session, ask 
  a how question, or request help. These are all easily added options for the 
  implementer.</P>
<DIR> 
  <DIR> 
    <P><B>get_user(X, 
      Hist) :-<BR>
      repeat, <BR>
      write(': '), <BR>
      read_line(X), <BR>
      process_ans(X, Hist).</B></P>
    <P><B>process_ans([why], 
      Hist) :- nl, write_hist(Hist), !, fail.</B></P>
    <P><B>process_ans([trace, 
      X], _) :- set_trace(X), !, fail.</B></P>
    <P><B>process_ans([help], 
      _) :- help, !, fail.</B></P>
    <P><B>process_ans(X, 
      _).&#9;</b>% just return user's answer</P>
    <P><B>write_hist([]) 
      :- nl.</B></P>
    <P><B>write_hist([goal(X)|T]) 
      :-<BR>
      write_line([goal, X]), <BR>
      !, write_hist(T).</B></P>
    <P><B>write_hist([N|T]) 
      :-<BR>
      list_rule(N), <BR>
      !, write_hist(T).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="nativeprologsystems"></a>4.2 
  Native Prolog Systems </B></h1>
<P>Since 
  we wrote the inference engine for Clam, it was easy to modify it to add the 
  code for explanations. However, when we use pure Prolog, we don't have access 
  to the inference engine.</P>
<P>This 
  problem is easily solved. We simply write a Prolog inference engine in Prolog. 
  Then, having written the inference engine, we can modify it to handle explanations.</P>
<P>An 
  inference engine has to have access to the rules. In Prolog, the clauses are 
  themselves just Prolog terms. The built-in predicate <B>clause</B> gives us 
  access to the rules. It has two arguments which unify with the head of a clause 
  and its body. A fact has a body with just the goal true.</P>
<P>Predicates 
  which manipulate Prolog clauses are confusing to read due to the ambiguous use 
  of the comma in Prolog. It can be either: an operator used to separate the subgoals 
  in a clause; or a syntactic separator of functor arguments. Prolog clauses are 
  just Prolog terms with functors of ":-" and ",". Just for now, pretend Prolog 
  used an "&amp;" operator to separate goals rather than a "," operator. Then 
  a clause would look like:</P>
<DIR> 
  <DIR> 
    <P><B>a :- b &amp; 
      c &amp; d.</B></P>
  </DIR>
</DIR>
<P>Without 
  the operator definitions it would look like:</P>
<DIR> 
  <DIR> 
    <P><B>:-(a, &amp;(b, 
      &amp;(c, d))).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>clause</B> built-in predicate picks up the first and second arguments of 
  the ":-" functor. It will find the entire Prolog database on backtracking. If 
  patterns are specified in either argument, then only clauses which unify with 
  the patterns are found. For the above clause:</P>
<DIR> 
  <DIR> 
    <P><B>?- clause(Head, 
      Body).</B></P>
    <P><B>Head = a</B></P>
    <P><B>Body = b &amp; 
      c &amp; d</B></P>
  </DIR>
</DIR>
<P>A 
  recursive predicate working through the goals in <B>Body</B> would look like:</P>
<DIR> 
  <DIR> 
    <P><B>recurse(FirstGoal 
      &amp; RemainingGoals) :-<BR>
      process(FirstGoal),<BR>
      recurse(RemainingGoals).</B></P>
    <P><B>recurse(SingleGoal) 
      :-<BR>
      process(SingleGoal).</B></P>
  </DIR>
</DIR>
<P>The 
  use of "&amp;" was just to distinguish between the two commas in Prolog. To 
  resolve ambiguous references to commas as in the first line of the above code, 
  parenthesis are used. The first line should really be written:</P>
<DIR> 
  <DIR> 
    <P><B>recurse( (FirstGoal, 
      RemainingGoals) ) :-<BR>
      ...</B></P>
  </DIR>
</DIR>
<P>See 
  Clocksin &amp; Mellish Section 2.3, <I>Operators</I> for a full discussion of 
  operators.</P>
<P> 
  Given the means to access and manipulate the Prolog database of facts and rules, 
  a simple Prolog interpreter that proves a list of goals (goals separated by 
  the "," operator) would look like:</P>
<DIR> 
  <DIR> 
    <P><B>prove(true) 
      :- !.</B></P>
    <P><B>prove((Goal, 
      Rest)) :-<BR>
      clause(Goal, Body), <BR>
      prove(Body), <BR>
      prove(Rest).</B></P>
    <P><B>prove(Goal) 
      :-<BR>
      clause(Goal, Body),<BR>
      prove(Body).</B></P>
  </DIR>
</DIR>
<P>Notice 
  that <B>prove</B> mimics precisely Prolog's behavior. First it finds a clause 
  whose head matches the first goal. Then it proves the list of goals in the <B>Body</B> 
  of the clause. Notice that unification automatically occurs between the <B>Goal</B> 
  for the head of the clause and the <B>Body</B>. This is because the Prolog clause 
  is just a Prolog term. If it succeeds, it continues with the rest of the goals 
  in the list. It it fails, it backtracks and finds the next clause whose head 
  unifies with the <B>Goal</B>.</P>
<P>This 
  interpreter will only handle pure Prolog whose clauses are asserted in the database. 
  It has no provisions for built-in predicates. These could be included by adding 
  a final catchall clause:</P>
<DIR> 
  <DIR> 
    <P><B>prove(X) :- 
      call(X).</B></P>
  </DIR>
</DIR>
<P>For 
  Native we do not intend to have Prolog built-in predicates, but we do intend 
  to call <B>ask</B> and <B>menuask</B>. For the Native shell these are our own 
  built-in predicates.</P>
<P>We 
  will make some basic modifications to our Prolog interpreter to allow it to 
  handle our own built-in predicates and record information for explanations. 
  First, we write an intermediate predicate <B>prov</B> that calls <B>clause</B>. 
  It can also check for built-in predicates such as <B>ask</B> and <B>menuask</B> 
  in the system. If the goal is either of these, they are just called with real 
  Prolog.</P>
<P>Next 
  we add an extra argument, just as we did for Clam. The extra argument keeps 
  track of the level of nesting of a particular goal. By passing this history 
  along to the <B>ask</B> predicates, the <B>ask</B> predicates can now respond 
  to <B>why</B> questions.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>prove(true, _) 
      :- !.</P>
    <P>prove((Goal, 
      Rest)<B>, Hist</B>) :-<BR>
      prov(Goal<B>, (Goal, Rest)</B>), <BR>
      prove(Rest<B>, Hist</B>).</P>
    <P><B>prov(true, 
      _) :- !.</B></P>
    <P><B>prov(menuask(X, 
      Y, Z), Hist) :- menuask(X, Y, Z, Hist), !.</B></P>
    <P><B>prov(ask(X, 
      Y), Hist) :- ask(X, Y, Hist), !.</B></P>
    <P><B>prov(Goal, 
      Hist) :-<BR>
      clause(Goal, List), <BR>
      prove(List, [Goal|Hist]).</B></P>
  </DIR>
</DIR>
<P>Notice 
  that the history is a list of goals, and not the full rules as saved in Clam.</P>
<P>The 
  next step is to modify the top level predicate which looks for birds. First 
  add an empty history list as an argument to the top call of prove:</P>
<DIR> 
  <DIR> <B> </b> 
    <P>solve :-<BR>
      abolish(known, 3), <BR>
      define(known, 3), <BR>
      <B>prove(top_goal(X), []), <BR>
      </B>write('The answer is '), write(X), nl.</P>
    <P>solve :-<BR>
      write('No answer found'), nl.</P>
  </DIR>
</DIR>
<P>The 
  processing of <B>why</B> questions is the same as in Clam.</P>
<DIR> 
  <DIR> 
    <P><B>get_user(X, 
      Hist) :-<BR>
      repeat, <BR>
      read(X), <BR>
      process_ans(X, Hist), !.</B></P>
    <P><B>process_ans(why, 
      Hist) :-<BR>
      write(Hist), !, fail.</B></P>
    <P><B>process_ans(X, 
      _).&#9;</B></P>
  </DIR>
</DIR>
<P>The 
  dialog with the user would look like:</P>
<DIR> 
  <DIR> 
    <P><B>?- identify.</B></P>
    <P>nostrils : external_tubular?<B> 
      why.</b></P>
    <P>[nostrils(external_tubular), 
      order(tubenose), family(albatross), bird(laysan_albatross)]</P>
    <P>nostrils : external_tubular?</P>
  </DIR>
</DIR>
<P>We 
  can further use <B>clause</B> to answer <B>how</B> questions. In Clam we chose 
  to save the derivations in the database. For native Prolog it is easier just 
  to rederive the answer.</P>
<DIR> 
  <DIR> 
    <P><B>how(Goal) 
      :-<BR>
      clause(Goal, List), <BR>
      prove(List, []), <BR>
      write(List).</B></P>
  </DIR>
</DIR>
<P>It 
  is also possible to ask <B>whynot</B> questions which determine why an expected 
  result was not reached. This also uses <B>clause</B> to find the clauses which 
  might have proved the goals, and goes through the list of goals looking for 
  the first one that failed. It is reported, and then backtracking causes any 
  other clauses which might have helped to be explained as well.</P>
<DIR> 
  <DIR> 
    <P><B>whynot(Goal) 
      :-<BR>
      clause(Goal, List), <BR>
      write_line([Goal, 'fails because: ']), <BR>
      explain(List).</B></P>
    <P><B>whynot(_).</B></P>
    <P><B>explain( (H, 
      T) ) :-<BR>
      check(H), <BR>
      explain(T).</B></P>
    <P><B>explain(H) 
      :-<BR>
      check(H).</B></P>
    <P><B>check(H) :- 
      prove(H, _), write_line([H, succeeds]), !.</B></P>
    <P><B>check(H) :- 
      write_line([H, fails]), fail.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>whynot</B> predicate has the same design problems as <B>how</B>. Do we automatically 
  recurse through a whole failure tree, or do we let the user ask successive <B>whynot</B>'s 
  to delve deeper into the mystery. This version just gives the first level. By 
  adding a recursive call to <B>whynot</B> in the second clause of check, it would 
  print the whole story.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>4.1 
  - Implement whynot for Clam.</P>
<P> 
 
<P> </P>
 
<P>4.2 
  - Have whynot give a full failure history.</P>
<P> 
 
<P> </P>
 
<P>4.3 
  - Make sure the explanation facility can handle attribute object value triples 
  in both Clam and Native.</P>
<P> 
 
<P> </P>
 
<P>4.4 
  - Decide whether you like the full rules presented in answer to why questions 
  as in Clam, or just the goals as in Native. Make both systems behave the same 
  way.</P>
<P> 
 
<P> </P>
 
<P>4.5 
  - Enhance the trace function so it displays the goals currently being sought 
  by the system. Have various levels of trace information that can be controlled 
  by the trace command.</P>
<P> 
 
<P> </P>
 
<P>4.6 
  - Using <B>prove</B>, implement a Prolog trace function.</P>
<P> 
 
<P> </P>
 
<P>4.7 - Add a pretty 
  printing predicate for Native to use when displaying Prolog rules.</P>


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
