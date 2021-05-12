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
<td><h1>3 Backward Chaining with Uncertainty</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>
        <hr />


<P>As 
  we have seen in the previous chapter, backward chaining systems are good for 
  solving structured selection types of problems. The Birds system was a good 
  example; however it made the assumption that all information was either absolutely 
  true, or absolutely false. In the real world, there is often uncertainty associated 
  with the rules of thumb an expert uses, as well as the data supplied by the 
  user.</P>
<P>For 
  example, in the Birds system the user might have spotted an albatross at dusk 
  and not been able to clearly tell if it was white or dark colored. An expert 
  system should be able to handle this situation and report that the bird might 
  have been either a laysan or black footed albatross.</P>
<P>The 
  rules too might have uncertainty associated with them. For example a mottled 
  brown duck might only identify a mallard with 80% certainty.</P>
<P>This 
  chapter will describe an expert system shell called Clam which supports backward 
  chaining with uncertainty. The use of uncertainty changes the inference process 
  from that provided by pure Prolog, so Clam has its own rule format and inference 
  engine.</P>
<h1><B> <a name="certaintyfactors"></a>3.1 
  Certainty Factors </B></h1>
<P>The 
  most common scheme for dealing with uncertainty is to assign a certainty factor 
  to each piece of information in the system. The inference engine automatically 
  updates and maintains the certainty factors as the inference proceeds.</P>
<h2 ALIGN="JUSTIFY"><B><a name="anexample"></a>An 
  Example</B></h2>
<P>Let's 
  first look at an example using Clam. The certainty factors (preceded by cf) 
  are integers from -100 for definitely false, to +100 for definitely true.</P>
<P>The 
  following is a small knowledge base in Clam which is designed to diagnose a 
  car which will not start. It illustrates some of the behavior of one scheme 
  for handling uncertainty.</P>
<DIR> 
  <DIR> 
    <P><B>goal problem.</B></P>
    <P><B>rule 1</B></P>
    <P><B>if&#9;&#9;not 
      turn_over and<BR>
      &#9;battery_bad</B></P>
    <P><B>then&#9;problem 
      is battery.</B></P>
    <P><B>rule 2</B></P>
    <P><B>if&#9;&#9;lights_weak</B></P>
    <P><B>then&#9;battery_bad 
      cf 50.</B></P>
    <P><B>rule 3</B></P>
    <P><B>if&#9;&#9;radio_weak</B></P>
    <P><B>then&#9;battery_bad 
      cf 50.</B></P>
    <P><B>rule 4</B></P>
    <P><B>if&#9;&#9;turn_over 
      and<BR>
      &#9;smell_gas</B></P>
    <P><B>then&#9;problem 
      is flooded cf 80.</B></P>
    <P><B>rule 5</B></P>
    <P><B>if&#9;&#9;turn_over 
      and<BR>
      &#9;gas_gauge is empty</B></P>
    <P><B>then&#9;problem 
      is out_of_gas cf 90.</B></P>
    <P><B>rule 6</B></P>
    <P><B>if&#9;&#9;turn_over 
      and<BR>
      &#9;gas_gauge is low</B></P>
    <P><B>then &#9;problem 
      is out_of_gas cf 30.</B></P>
    <P><B>&nbsp;</B></P>
    <P><B>ask&#9;turn_over</B></P>
    <P><B>menu&#9;(yes 
      no)</B></P>
    <P><B>prompt &#9;'Does 
      the engine turn over?'.</B></P>
    <P><B>ask&#9;lights_weak</B></P>
    <P><B>menu&#9;(yes 
      no)</B></P>
    <P><B>prompt &#9;'Are 
      the lights weak?'.</B></P>
    <P><B>ask&#9;radio_weak</B></P>
    <P><B>menu&#9;(yes 
      no)</B></P>
    <P><B>prompt &#9;'Is 
      the radio weak?'.</B></P>
    <P><B>ask&#9;smell_gas</B></P>
    <P><B>menu&#9;(yes 
      no)</B></P>
    <P><B>prompt &#9;'Do 
      you smell gas?'.</B></P>
    <P><B>ask&#9;gas_gauge</B></P>
    <P><B>menu&#9;(empty 
      low full)</B></P>
    <P><B>prompt &#9;'What 
      does the gas gauge say?'.</B></P>
  </DIR>
</DIR>
<P>The 
  inference uses backward chaining similar to pure Prolog. The goal states that 
  a value for the attribute <B>problem</B> is to be found. Rule 1 will cause the 
  sub-goal of <B>bad_battery</B> to be pursued, just as in Prolog.</P>
<P>The 
  rule format also allows for the addition of certainty factors. For example rules 
  5 and 6 reflect the varying degrees of certainty with which one can conclude 
  that the car is out of gas. The uncertainty arises from the inherent uncertainty 
  in gas gauges. Rules 2 and 3 both provide evidence that the battery is bad, 
  but neither one is conclusive.</P>
<h2 ALIGN="JUSTIFY"><B><a name="ruleuncertainty"></a>Rule 
  Uncertainty</B></h2>
<P>What 
  follows is a sample dialog of a consultation with the Car expert system.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>consult, restart, 
      load, list, trace, how, exit</P>
    <P>:<B>consult</b></P>
    <P>Does the engine 
      turn over?</P>
    <P>: <B>yes</b></P>
    <P>Do you smell 
      gas?</P>
    <P>: <B>yes</b></P>
    <P>What does the 
      gas gauge say?</P>
    <P> empty</P>
    <P> low</P>
    <P> full</P>
    <P>: <B>empty</b></P>
    <P>problem-out_of_gas-cf-90</P>
    <P>problem-flooded-cf-80</P>
    <P>done with problem</P>
  </DIR>
</DIR>
<P>Notice, 
  that unlike Prolog, the inference does not stop after having found one possible 
  value for problem. It finds all of the reasonable problems and reports the certainty 
  to which they are known. As can be seen, these certainty factors are not probability 
  values, but simply give some degree of weight to each answer.</P>
<h2 ALIGN="JUSTIFY"><B><a name="useruncertainty"></a>User 
  Uncertainty</B></h2>
<P>The 
  following dialog shows how the user's uncertainty might be entered into the 
  system. The differences from the previous dialog are shown in bold.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>:consult</P>
    <P>Does the engine 
      turn over?</P>
    <P>: yes</P>
    <P>Do you smell 
      gas?</P>
    <P><B>: yes cf 50</B></P>
    <P>What does the 
      gas gauge say?</P>
    <P> empty</P>
    <P> low</P>
    <P> full</P>
    <P>: empty</P>
    <P>problem-out_of_gas-cf-90</P>
    <P><B>problem-flooded-cf-40</B></P>
    <P>done with problem</P>
  </DIR>
</DIR>
<P>Notice 
  in this case that the user was only certain to a degree of 50 that there was 
  a gas smell. This results in the system only being half as sure that the <B>problem</B> 
  is <B>flooded</B>.</P>
<h2 ALIGN="JUSTIFY"><B><a name="combiningcertainties"></a>Combining 
  Certainties</B></h2>
<P>Finally 
  consider the following consultation which shows how the system combines evidence 
  for a bad battery. Remember that there were two rules which both concluded the 
  battery was weak with a certainty factor of 50.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>:consult</P>
    <P>Does the engine 
      turn over?</P>
    <P>:<B> no</b></P>
    <P>Are the lights 
      weak?</P>
    <P>: <B>yes</b></P>
    <P>Is the radio 
      weak?</P>
    <P>: <B>yes</b></P>
    <P>problem-battery-cf-75</P>
    <P>done with problem</P>
  </DIR>
</DIR>
<P>In 
  this case the system combined the two rules to determine that the battery was 
  weak with certainty factor 75. This propagated straight through rule 1 and became 
  the certainty factor for <B>problem</B> <B>battery</B>.</P>
<h2 ALIGN="JUSTIFY"><B><a name="propertiesofcertaintyfactors"></a>Properties 
  of Certainty Factors</B></h2>
<P>There 
  are various ways in which the certainty factors can be implemented, and how 
  they are propagated through the system, but they all have to deal with the same 
  basic situations:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;rules 
      whose conclusions are uncertain;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;rules 
      whose premises are uncertain;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;user 
      entered data which is uncertain;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;combining 
      uncertain premises with uncertain conclusions;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;updating 
      uncertain working storage data with new, also uncertain information;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;establishing 
      a threshold of uncertainty for when a premise is considered known.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Clam 
  uses the certainty factor scheme which was developed for MYCIN, one of the earliest 
  expert systems used to diagnose bacterial infections. Many commercial expert 
  system shells today use this same scheme.</P>
<h1><B> <a name="mycinscertaintyfactors"></a>3.2 
  MYCINs Certainty Factors </B></h1>
<P>The 
  basic MYCIN certainty factors (CFs) were designed to produce results that seemed 
  intuitively correct to the experts. Others have argued for factors that are 
  based more on probability theory and still others have experimented with more 
  complex schemes designed to better model the real world. The MYCIN factors, 
  however, do a reasonable job of modeling for many applications with uncertain 
  information.</P>
<P>We 
  have seen from the example how certainty information is added to the rules in 
  the <B>then</B> clause. We have also seen how the user can specify CFs with 
  input data. These are the only two ways uncertainty gets into the system.</P>
<P>Uncertainty 
  associated with a particular run of the system is kept in working storage. Every 
  time a value for an attribute is determined by a rule or a user interaction, 
  the system saves that attribute value pair and associated CF in working storage.</P>
<P>The 
  CFs in the conclusion of the rule are based on the assumption that the premise 
  is known with a CF of 100. That is, if the conclusion has a CF of 80 and the 
  premise is known to CF 100, then the fact which is stored in working storage 
  has a CF of 80. For example, if working storage contained:</P>
<DIR> 
  <DIR> 
    <P><B>turn_over 
      cf 100</B></P>
    <P><B>smell_gas 
      cf 100</B></P>
  </DIR>
</DIR>
<P>then 
  a firing of rule 4 </P>
<DIR> 
  <DIR> 
    <P><B>rule 4</B></P>
    <P><B>if&#9;&#9;turn_over 
      and</B></P>
    <P><B>&#9;&#9;smell_gas</B></P>
    <P><B>then&#9;problem 
      is flooded cf 80</B></P>
  </DIR>
</DIR>
<P>would 
  result in the following fact being added to working storage:</P>
<DIR> 
  <DIR> 
    <P><B>problem flooded 
      cf 80</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="determiningpremisecf"></a>Determining 
  Premise CF</B></h2>
<P>However, 
  it is unlikely that a premise is perfectly known. The system needs a means for 
  determining the CF of the premise. The algorithm used is a simple one. The CF 
  for the premise is equal to the minimum CF of the individual sub goals in the 
  premise. If working storage contained:</P>
<DIR> 
  <DIR> 
    <P><B>turn_over 
      cf 80</B></P>
    <P><B>smell_gas 
      cf 50</B></P>
  </DIR>
</DIR>
<P>then 
  the premise of rule 4 would be known with CF 50, the minimum of the two.</P>
<h2 ALIGN="JUSTIFY"><B><a name="combiningpremisecfandconclusioncf"></a>Combining 
  Premise CF and Conclusion CF</B></h2>
<P>When 
  the premise of a rule is uncertain due to uncertain facts, and the conclusion 
  is uncertain due to the specification in the rule, then the following formula 
  is used to compute the adjusted certainty factor of the conclusion:</P>
<DIR> 
  <DIR> 
    <P>CF = RuleCF * 
      PremiseCF / 100.</P>
  </DIR>
</DIR>
<P>Given 
  the above working storage and this formula, the result of a firing of rule 4 
  would be:</P>
<DIR> 
  <DIR> 
    <P><B>problem is 
      flooded cf 40</B></P>
  </DIR>
</DIR>
<P>The 
  resulting CF has been appropriately reduced by the uncertain premise. The premise 
  had a certainty factor of 50, and the conclusion a certainty factor of 80, thus 
  yielding an adjusted conclusion CF of 40.</P>
<h2 ALIGN="JUSTIFY"><B><a name="premisethresholdcf"></a>Premise 
  Threshold CF</B></h2>
<P>A 
  threshold value for a premise is needed to prevent all of the rules from firing. 
  The number 20 is used as a minimum CF necessary to consider a rule for firing. 
  This means if working storage had:</P>
<DIR> 
  <DIR> 
    <P><B>turn_over 
      cf 80</B></P>
    <P><B>smell_gas 
      cf 15</B></P>
  </DIR>
</DIR>
<P>Then 
  rule 4 would not fire due to the low CF associated with the premise.</P>
<h2 ALIGN="JUSTIFY"><B><a name="combiningcfs"></a>Combining 
  CFs</B></h2>
<P>Next 
  consider the case where there is more than one rule which supports a given conclusion. 
  In this case each of the rules might fire and contribute to the CF of the resulting 
  fact. If a rule fires supporting a conclusion, and that conclusion is already 
  represented in working memory by a fact, then the following formulae are used 
  to compute the new CF associated with the fact. X and Y are the CFs of the existing 
  fact and rule conclusion.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>CF(X, Y) = X 
      + Y(100 - X)/100.&#9;&#9;&#9;X, Y both &gt; 0</P>
    <P>CF(X, Y) = X 
      + Y/1 - min(|X|, |Y|).&#9;&#9;one of X, Y &lt; 0</P>
    <P>CF(X, Y) = -CF(-X, 
      -Y).&#9;&#9;&#9;&#9;X, Y both &lt; 0</P>
  </DIR>
</DIR>
<P>For 
  example, both rules 2 and 3 provide evidence for <B>battery_bad</B>.</P>
<DIR> 
  <DIR> 
    <P><B>rule 2</B></P>
    <P><B>if&#9;&#9;lights_weak</B></P>
    <P><B>then&#9;battery_bad 
      cf 50.</B></P>
    <P><B>rule 3</B></P>
    <P><B>if&#9;&#9;radio_weak</B></P>
    <P><B>then&#9;battery_bad 
      cf 50.</B></P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Assume 
  the following facts are in working storage:</P>
<DIR> 
  <DIR> 
    <P><B>lights_weak 
      cf 100</B></P>
    <P><B>radio_weak 
      cf 100</B></P>
  </DIR>
</DIR>
<P>A 
  firing of rule 2 would then add the following fact:</P>
<DIR> 
  <DIR> 
    <P><B>battery_bad 
      cf 50</B></P>
  </DIR>
</DIR>
<P>Next 
  rule 3 would fire, also concluding <B>battery_bad</B> cf 50. However there already 
  is a <B>battery_bad</B> fact in working storage so rule 3 updates the existing 
  fact with the new conclusion using the formulae above. This results in working 
  storage being changed to:</P>
<DIR> 
  <DIR> 
    <P><B>battery_bad 
      cf 75</B></P>
  </DIR>
</DIR>
<P>This 
  case most clearly shows why a new inference engine was needed for Clam. When 
  trying to prove a conclusion for which the CF is less than 100, we want to gather 
  all of the evidence both for and against that conclusion and combine it. Prolog's 
  inference engine will only look at a single rule at a time, and succeed or fail 
  based on it.</P>
<h1><B> <a name="ruleformat"></a>3.3 
  Rule Format </B></h1>
<P>Since 
  we are writing our own inference engine, we can design our own internal rule 
  format as well. (We will use something easier to read for the user.) It has 
  at least two arguments, one for the IF or left hand side (LHS) which contains 
  the premises, and one for the THEN or right hand side (RHS) which contains the 
  conclusion. It is also useful to keep a third argument for a rule number or 
  name. The overall structure looks like:</P>
<DIR> 
  <DIR> 
    <P><B>rule(Name, 
      LHS, RHS).</B></P>
  </DIR>
</DIR>
<P>The 
  name will be a simple atom identifying the rule. The <B>LHS</B> and <B>RHS</B> 
  must hold the rest of the rule. Typically in expert systems, a rule is read 
  LHS implies RHS. This is backwards from a Prolog rule which can be thought of 
  as being written RHS :- LHS, or RHS is implied by LHS. That is the RHS (conclusion) 
  is written on the left of the rule, and the LHS (premises) is written on the 
  right.</P>
<P>Since 
  we will be backward chaining, and each rule will be used to prove or disprove 
  some bit of information, the <B>RHS</B> contains one goal pattern, and its associated 
  CF. This is:</P>
<DIR> 
  <DIR> 
    <P><B>rhs(Goal, 
      CF)</B></P>
  </DIR>
</DIR>
<P>The 
  <B>LHS</B> can have many sub-goals which are used to prove or disprove the <B>RHS</B> 
  :</P>
<DIR> 
  <DIR> 
    <P><B>lhs(GoalList)</B></P>
  </DIR>
</DIR>
<P>where 
  <B>GoalList</B> is a list of goals.</P>
<P>The 
  next bit of design has to do with the actual format of the goals themselves. 
  Various levels of sophistication can be added to these goals, but for now we 
  will use the simplest form, which is attribute-value pairs. For example, <B>gas_gauge</B> 
  is an attribute, and <B>low</B> is a value. Other attributes have simple yes-no 
  values, such as <B>smell_gas</B>. An attribute-value pair will look like:</P>
<DIR> 
  <DIR> 
    <P><B>av(Attribute, 
      Value)</B></P>
  </DIR>
</DIR>
<P>where 
  Attribute and Value are simple atoms. The entire rule structure looks like:</P>
<DIR> 
  <DIR> 
    <P><B>rule(Name, 
      <BR>
      lhs( [av(A1, V1), av(A2, V2), ....] ), <BR>
      rhs( av(Attr, Val), CF) ).</B></P>
  </DIR>
</DIR>
<P>Internally, 
  rule 5 looks like:</P>
<DIR> 
  <DIR> 
    <P><B>rule(5, <BR>
      lhs( [av(turns_over, yes), av(gas_gauge, empty)] ), <BR>
      rhs( av(problem, flooded), 80) ).</B></P>
  </DIR>
</DIR>
<P>This 
  rule format is certainly not easy to read, but it makes the structure clear 
  for programming the inference engine. There are two ways to generate more readable 
  rules for the user. One is to use operator definitions. The other is to use 
  Prolog's language handling ability to parse our own rule format. The built-in 
  definite clause grammar (DCG) of most Prologs is excellent for this purpose. 
  Later in this chapter we will use DCG to create a clean user interface to the 
  rules. The forward chaining system in a later chapter uses the operator definition 
  approach.</P>
<h1><B> <a name="theinferenceengine"></a>3.4 
  The Inference Engine </B></h1>
<P>Now 
  that we have a format for rules, we can write our own inference engine to deal 
  with those rules. Let's summarize the desired behavior:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;combine 
      certainty factors as indicated previously;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;maintain 
      working storage information that is updated as new evidence is acquired;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;find 
      all information about a particular attribute when it is asked for, and put 
      that information in working storage.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  major predicates of the inference engine are shown in figure 3.1. They are described 
  in detail in the rest of this section. </P>
 
<P ALIGN="CENTER"><BR>
  <IMG SRC="backwarduncertainty3-1.gif" WIDTH=391 HEIGHT=211><BR>
  </P>
<P>Figure 
  3.1 Major predicates of Clam inference engine</P>
<h2 ALIGN="JUSTIFY"><B><a name="workingstorage"></a>Working 
  Storage</B></h2>
<P>Let's 
  first decide on the working storage format. It will simply contain the known 
  facts about attribute-value pairs. We will use the Prolog database for them 
  and store them as:</P>
<DIR> 
  <DIR> 
    <P><B>fact (av(A, 
      V), CF).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><b><a name="findavalueforanattribute"></a></b>Find 
  a Value for an Attribute</B></h2>
<P>We 
  want to start the inference by asking for the value of a goal. In the case of 
  the Car expert system we want to find the value of the attribute <B>problem</B>. 
  The main predicate that does inferencing will be <B>findgoal/2</B>. In the Car 
  expert system it could be called from an interpreter with the following query:</P>
<DIR> 
  <DIR> 
    <P><B>?- findgoal( 
      av(problem, X), CF).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>findgoal/2</B> predicate has to deal with three distinct cases:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;the 
      attribute -value is already known;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;there 
      are rules to deduce the attribute -value;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;we 
      must ask the user.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  system can be designed to automatically ask the user if there are no rules, 
  or it can be designed to force the knowledge engineer to declare which attribute 
  values will be supplied by the user. The latter approach makes the knowledge 
  base for the expert system more explicit, and also provides the opportunity 
  to add more information controlling the dialog with the user. This might be 
  in the form of clearer prompts, and/or input validation criteria.</P>
<P>We 
  can define a new predicate <B>askable/2</B> that tells which attributes should 
  be retrieved from the user, and the prompt to use. For example:</P>
<DIR> 
  <DIR> 
    <P><B>askable(live, 
      'Where does it live?').</B></P>
  </DIR>
</DIR>
<P>With 
  this new information we can now write <B>findgoal</B>.</P>
<h2 ALIGN="JUSTIFY"><B><a name="attributevaluealreadyknown"></a>Attribute 
  Value Already Known</B></h2>
<P> 
  The first rule covers the case where the information is in working storage. 
  It was asserted so we know all known values of the attribute have been found. 
  Therefor we cut so no other clauses are tried. </P>
<DIR> 
  <DIR> 
    <P><B>findgoal( 
      av(Attr, Val), CF) :-<BR>
      fact( av(Attr, Val), CF), <BR>
      !.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="askuserforattributevalue"></a>Ask 
  User for Attribute Value</B></h2>
<P>The 
  next rule covers the case where there is no known information, and the attribute 
  is askable. In this case we simply ask.</P>
<DIR> 
  <DIR> 
    <P><B>findgoal(av(Attr, 
      Val), CF) :-<BR>
      not fact(av(Attr, _), _), <BR>
      askable(Attr, Prompt), <BR>
      query_user(Attr, Prompt), <BR>
      !, <BR>
      findgoal(av(Attr, Val), CF).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>query_user</B> predicate prompts the user for a value and CF and then asserts 
  it as a <B>fact</B>. The recursive call to <B>findgoal</B> will now pick up 
  this <B>fact</B>.</P>
<DIR> 
  <DIR> 
    <P><B>query_user(Attr, 
      Prompt) :-<BR>
      write(Prompt), <BR>
      read(Val), <BR>
      read(CF), <BR>
      asserta( fact(av(Attr, Val), CF)).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="deduceattributevaluefromrules"></a>Deduce 
  Attribute Value from Rules</B></h2>
<P>The 
  final rule of <B>findgoal</B> covers the interesting case of using other rules. 
  Remember that the inferencing is going to require looking for all rules which 
  provide support for values for the sought attribute, and combining the CFs from 
  them. This is done by calling <B>fg</B>, which uses a repeat fail loop to continue 
  to find rules whose RHS conclude a value for the attribute. The process stops 
  when the attribute is known with a CF of 100, or all the rules have been tried.</P>
<DIR> 
  <DIR> 
    <P><B>findgoal(Goal, 
      CurCF) :-<BR>
      fg(Goal, CurCF).<BR>
      </B></P>
    <P><B>fg(Goal, CurCF) 
      :-<BR>
      rule(N, lhs(IfList), rhs(Goal, CF)), <BR>
      prove(IfList, Tally), <BR>
      adjust(CF, Tally, NewCF), <BR>
      update(Goal, NewCF, CurCF), <BR>
      CurCF == 100, !.</B></P>
    <P><B>fg(Goal, CF) 
      :- fact(Goal, CF).</B></P>
  </DIR>
</DIR>
<P>The 
  three new predicates called in <B>fg</B> are as follows:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>prove</b> 
      - prove the LHS premise and find its CF;</P>
    <P> 
     
    <P> </P>
     
    <P><B>adjust</b> 
      - combine the LHS CF with the RHS CF;</P>
    <P> 
     
    <P> </P>
     
    <P><B>update</b> 
      - update existing working storage values with the new conclusion.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>This 
  is the guts of the inferencing process for the new inference engine. First it 
  finds a rule whose RHS matches the pattern of the goal. It then feeds the LHS 
  of that rule into <B>prove</B> which succeeds if the LHS can be proved. The 
  <B>prove</B> predicate returns the combined CF from the LHS. If <B>prove</B> 
  fails, backtracking is initiated causing the next rule which might match the 
  goal pattern to be tried.</P>
<DIR> 
  <DIR> 
    <P><B>prove(IfList, 
      Tally) :-<BR>
      prov(IfList, 100, Tally).</B></P>
    <P><B>prov([], Tally, 
      Tally).</B></P>
    <P><B>prov([H|T], 
      CurTal, Tally) :-<BR>
      findgoal(H, CF), <BR>
      min(CurTal, CF, Tal), <BR>
      Tal &gt;= 20, <BR>
      prov(T, Tal, Tally).</B></P>
    <P><B>min(X, Y, 
      X) :- X =&lt; Y, !.</B></P>
    <P><B>min(X, Y, 
      Y) :- Y =&lt; X.</B></P>
  </DIR>
</DIR>
<P>The 
  input argument to <B>prove</B> is the list of premises for the rule, and the 
  output is the <B>Tally</B>, or combined CF from the premises. The <B>prove</B> 
  predicate calls <B>prov</B> with an extra argument to keep track of <B>Tally</B>. 
  At each recursion the <B>Tally</B> is reset to the minimum up to that point. 
  Of course, <B>prov</B> recursively calls <B>findgoal</B> for each of the premises. 
  Notice the check to make sure the <B>Tally</B> stays above 20. This is the threshold 
  value for considering an attribute - value pair to be true.</P>
<P>After 
  <B>prove</B> succeeds, <B>adjust</B> computes the combined CF based on the RHS 
  CF and the <B>Tally</B> from the LHS.</P>
<DIR> 
  <DIR> 
    <P><B>adjust(CF1, 
      CF2, CF) :-<BR>
      X is CF1 * CF2 / 100, <BR>
      int_round(X, CF).</B></P>
    <P><B>int_round(X, 
      I) :-<BR>
      X &gt;= 0, <BR>
      I is integer(X + 0.5).</B></P>
    <P><B>int_round(X, 
      I) :-<BR>
      X &lt; 0, <BR>
      I is integer(X - 0.5).</B></P>
  </DIR>
</DIR>
<P>Then 
  <B>update</B> combines the new evidence for this attribute-value pair with any 
  existing known evidence. The first argument is the attribute - value pair just 
  deduced, and the second is its CF. The third argument is the returned value 
  for the CF when it is combined with existing facts for the attribute-value pair.</P>
<DIR> 
  <DIR> 
    <P><B>update(Goal, 
      NewCF, CF) :-<BR>
      fact(Goal, OldCF), <BR>
      combine(NewCF, OldCF, CF), <BR>
      retract( fact(Goal, OldCF) ), <BR>
      asserta( fact(Goal, CF) ), <BR>
      !.</B></P>
    <P><B>update(Goal, 
      CF, CF) :-<BR>
      asserta( fact(Goal, CF) ).</B></P>
    <P><B>combine(CF1, 
      CF2, CF) :-<BR>
      CF1 &gt;= 0, <BR>
      CF2 &gt;= 0, <BR>
      X is CF1 + CF2*(100 - CF1)/100, <BR>
      int_round(X, CF).</B></P>
    <P><B>combine(CF1, 
      CF2, CF) :-<BR>
      CF1 &lt; 0, <BR>
      CF2 &lt; 0, <BR>
      X is - ( -CF1 -CF2 * (100 + CF1)/100), <BR>
      int_round(X, CF).</B></P>
    <P><B>combine(CF1, 
      CF2, CF) :-<BR>
      (CF1 &lt; 0; CF2 &lt; 0), <BR>
      (CF1 &gt; 0; CF2 &gt; 0), <BR>
      abs_minimum(CF1, CF2, MCF), <BR>
      X is 100 * (CF1 + CF2) / (100 - MCF), <BR>
      int_round(X, CF).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>abs_minimum</B> predicate finds the minimum in terms of absolute value. The 
  code can be seen in the appendix.</P>
<P><B>Negation</B></P>
<P>One 
  last point is to deal with negation. The premises might also be of the form 
  <B>not goal</B>. In this case we call <B>findgoal</B> for the <B>goal</B>, and 
  complement the CF to find the degree of certainty of its negation. For example 
  if a fact has a CF of 70, then not fact has a certainty of -70.</P>
<DIR> 
  <DIR> 
    <P><B>findgoal(not 
      Goal, NCF) :-<BR>
      findgoal(Goal, CF), <BR>
      NCF is - CF, !.</B></P>
  </DIR>
</DIR>
<P>This 
  rule should become the first clause for <B>findgoal</B>.</P>
<h1><B> <a name="makingtheshell"></a>3.5 
  Making the Shell </B></h1>
<P>Now 
  that the inference engine is built, it can become part of a shell. The code 
  to build this first version of the Clam shell is the same as that used to build 
  the Native shell. It consists of a command loop with the commands <B>load</B>, 
  <B>consult</B>, and <B>exit</B>. Figure 3.2 shows the architecture of Clam.</P>
<DIR> 
  <DIR> 
    <P><B>super :-<BR>
      repeat, <BR>
      write('consult, load, exit'), nl, <BR>
      write(':'), <BR>
      read_line(X), <BR>
      doit(X), <BR>
      X == exit.</B></P>
    <P><B>doit(consult) 
      :- top_goals, !.</B></P>
    <P><B>doit(load) 
      :- load_rules, !.</B></P>
    <P><B>doit(exit).</B></P>
  </DIR>
</DIR>
<P ALIGN="CENTER"><BR>
  <IMG SRC="backwarduncertainty3-2.gif" WIDTH=344 HEIGHT=393><BR>
  </P>
<P>Figure 
  3.2 Major predicates of the Clam shell</P>
<h2 ALIGN="JUSTIFY"><B><a name="startingtheinference"></a>Starting 
  the Inference</B></h2>
<P>The 
  <B>consult</B> command does a little more than just call <B>findgoal</B>. It 
  calls <B>top_goals</B> which uses the <B>top_goal</B> facts to start the inference. 
  The system might have more than one <B>top_goal</B> to allow sequencing of the 
  consultation. For example a diagnostic system might have two goals, the first 
  diagnoses the problem, and the second recommends a solution.</P>
<P>After 
  <B>top_goals</B> satisfies a goal, it prints the values for the goal as seen 
  in the early examples of Car.</P>
<DIR> 
  <DIR> 
    <P><B>top_goals 
      :-<BR>
      top_goal(Attr), <BR>
      top(Attr), <BR>
      print_goal(Attr), <BR>
      fail.</B></P>
    <P><B>top_goals.</B></P>
    <P><B>top(Attr) 
      :-<BR>
      findgoal(av(Attr, Val), CF), !.</B></P>
    <P><B>top(_) :- 
      true.</B></P>
    <P><B>print_goal(Attr) 
      :-<BR>
      nl, <BR>
      fact(av(Attr, X), CF), <BR>
      CF &gt;= 20, <BR>
      outp(av(Attr, X), CF), nl, <BR>
      fail.</B></P>
    <P><B>print_goal(Attr) 
      :-write('done with '), write(Attr), nl, nl.</B></P>
    <P><B>outp(av(A, 
      V), CF) :-<BR>
      output(A, V, PrintList), <BR>
      write(A-'cf'-CF), <BR>
      printlist(PrintList), !.</B></P>
    <P><B>outp(av(A, 
      V), CF) :-<BR>
      write(A-V-'cf'-CF).</B></P>
    <P><B>printlist([]).</B></P>
    <P><B>printlist([H|T]) 
      :-<BR>
      write(H), <BR>
      printlist(T).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="englishlikerules"></a>3.6 
  English-like Rules </B></h1>
<P>The 
  <B>load</B> command for Clam does not simply read in Prolog terms as in Native, 
  but instead uses DCG to read in a knowledge base in the format shown earlier 
  in the chapter for the Car system. You might notice that the askable items have 
  the additional syntax to allow menu choices which was not included in the implementation 
  details above. It is coded similarly to the menu feature in Native.</P>
<P>The 
  <B>load_kb</B> predicate in the shell gets a file name as in Native, and then 
  calls <B>load_rules</B> with the file name.</P>
<DIR> 
  <DIR> 
    <P><B>load_rules(F) 
      :-<BR>
      clear_db, <BR>
      see(F), <BR>
      lod_ruls, <BR>
      write('rules loaded'), nl, <BR>
      seen, !.</B></P>
    <P><B>lod_ruls :-<BR>
      repeat, <BR>
      read_sentence(L), <BR>
      process(L), <BR>
      L == eof.</B></P>
    <P><B>process(eof) 
      :- !.</B></P>
    <P><B>process(L) 
      :-<BR>
      trans(R, L, []), <BR>
      assertz(R), !.</B></P>
    <P><B>process(L) 
      :-<BR>
      write('translate error on:'), nl, <BR>
      write(L), nl.</B></P>
    <P><B>clear_db :-<BR>
      abolish(top_goal, 1), <BR>
      abolish(askable, 4), <BR>
      abolish(rule, 3).</B></P>
  </DIR>
</DIR>
<P>This 
  section of code basically calls <B>read_sentence</B> to tokenize a sentence 
  (up to a ".") into a list. The token list is then processed by the DCG predicate 
  <B>trans</B>, and the resulting Prolog term, <B>R</B>, is asserted in the knowledge 
  base. For a good description of DCG, see Clocksin &amp; Mellish chapter 9, <I>Using 
  Grammar Rules</I>. The <B>clear_db</B> predicate removes all earlier <B>top_goal</B>, 
  <B>askable</B>, and <B>rule</B> predicates so that a new knowledge base can 
  be loaded over an existing one.</P>
<P>The 
  tokenizing predicate, <B>read_sentence</B>, varies from Prolog to Prolog based 
  on the implementation. If the implementation has built-in predicates which can 
  read tokens, then <B>read_sentence</B> is trivial. If not, it has to read the 
  input character by character and build the tokens. An example of this type of 
  sentence read predicate can be found in Clocksin &amp; Mellish section 5.3, 
  <I>Reading English Sentences</I>.</P>
<P>The 
  top level DCG predicate, <B>trans</B>, looks for the three types of statements 
  allowed in the knowledge base:</P>
<DIR> 
  <DIR> 
    <P><B>trans(top_goal(X))--&gt;[goal, 
      is, X].</B></P>
    <P><B>trans(top_goal(X))--&gt;[goal, 
      X].</B></P>
    <P><B>trans(askable(A, 
      M, P))--&gt;<BR>
      [ask, A], menux(M), prompt(A, P).</B></P>
    <P><B>trans(rule(N, 
      lhs(IF), rhs(THEN, CF)))--&gt; id(N), if(IF), then(THEN, CF).</B></P>
  </DIR>
</DIR>
<P>The 
  following predicates recognize the menu and prompt fields in the ask statement.</P>
<DIR> 
  <DIR> 
    <P><B>menux(M)--&gt; 
      [menu, '('], menuxlist(M).</B></P>
    <P><B>menuxlist([Item])--&gt; 
      [Item, ')'].</B></P>
    <P><B>menuxlist([Item|T])--&gt; 
      [Item], menuxlist(T).</B></P>
    <P><B>prompt(_, 
      P)--&gt; [prompt, P].</B></P>
    <P><B>prompt(P, 
      P)--&gt; [].</B></P>
  </DIR>
</DIR>
<P>Next 
  are the predicates used to parse the basic rule structure. Note the flexibility 
  that can be added into the system with DCG. Both <B>and</B> and <B>", "</B> 
  can be used as LHS separators. The attribute-value phrases can be expressed 
  in many different ways to allow the most natural expression in the rules.</P>
<DIR> 
  <DIR> 
    <P><B>id(N)--&gt;[rule, 
      N].</B></P>
    <P><B>if(IF)--&gt;[if], 
      iflist(IF).</B></P>
    <P><B>iflist([IF])--&gt;phrase(IF), 
      [then].</B></P>
    <P><B>iflist([Hif|Tif])--&gt;phrase(Hif), 
      [and], iflist(Tif).</B></P>
    <P><B>iflist([Hif|Tif])--&gt;phrase(Hif), 
      [', '], iflist(Tif).</B></P>
    <P><B>then(THEN, 
      CF)--&gt;phrase(THEN), [cf], [CF].</B></P>
    <P><B>then(THEN, 
      100)--&gt;phrase(THEN).</B></P>
    <P><B>phrase(not 
      av(Attr, yes))--&gt;[not, Attr].</B></P>
    <P><B>phrase(not 
      av(Attr, yes))--&gt;[not, a, Attr].</B></P>
    <P><B>phrase(not 
      av(Attr, yes))--&gt;[not, an, Attr].</B></P>
    <P><B>phrase(not 
      av(Attr, Val))--&gt;[not, Attr, is, Val].</B></P>
    <P><B>phrase(not 
      av(Attr, Val))--&gt;[not, Attr, are, Val].</B></P>
    <P><B>phrase(av(Attr, 
      Val))--&gt;[Attr, is, Val].</B></P>
    <P><B>phrase(av(Attr, 
      Val))--&gt;[Attr, are, Val].</B></P>
    <P><B>phrase(av(Attr, 
      yes))--&gt;[Attr].</B></P>
  </DIR>
</DIR>
<P>Using 
  DCG in this fashion, it is easy to implement as friendly a syntax for the knowledge 
  base as desired. The same approach could also be used for the Native system, 
  with DCG that translated English-like rules into Prolog syntax.</P>
<P>Now 
  that we have a customized knowledge base and inference engine, it is possible 
  to add other features to the system. The next chapter shows how to add explanations.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>3.1 
  - Add attribute object value triples to the knowledge representation of Clam.</P>
<P> 
 
<P> </P>
 
<P>3.2 
  - There are other ways of dealing with uncertainty in the literature which could 
  be used with Clam. A simple one would just use a few text modifiers such as 
  weak, very weak, or strong and have rules for combining them. Implement this 
  or some other scheme in Clam.</P>
<P> 
 
<P> </P>
 
<P>3.3 
  - Isolate the predicates which are used for calculating certainty factors so 
  it is easy to add additional methods. Implement them so the calling predicates 
  do not need to know the syntax of the certainty factor, since they might be 
  text, numbers, or more complex data structures.</P>
<P> 
 
<P> </P>
 
<P>3.4 
  - Allow rules to have optional threshold values associated with them which override 
  the default of 20. This would be an addition to the rule syntax as well as the 
  code.</P>
<P> 
 
<P> </P>
 
<P>3.5 
  - Have the inference engine automatically generate a prompt to the user when 
  there is no <B>askable</B> or <B>rule</B> which finds a value for an attribute.</P>
<P> 
 
<P> </P>
 
<P>3.6 
  - Add menus to the query user facility.</P>
<P> 
 
<P> </P>
 
<P>3.7 - Implement another 
  diagnostic application using Clam. Note any difficulties and features which 
  could be added to alleviate those difficulties.</P>


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
