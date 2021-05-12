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
<td><h1>5 Forward Chaining</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>This 
  chapter discusses a forward chaining rule based system and its expert system 
  applications. It shows how the forward chaining system works, how to use it, 
  and how to implement it quickly and easily using Prolog.</P>
<P>A 
  large number of expert systems require the use of forward chaining, or data 
  driven inference. The most famous of these is Digital Equipment Corporation's 
  XCON system. It configures computers. It starts with the data about the customer 
  order and works forward toward a configuration based on that data. The XCON 
  system was written in the OPS5 (forward chaining rule based) language.</P>
<P>Data 
  driven expert systems are different from the goal driven, or backward chaining 
  systems seen in the previous chapters.</P>
<P>The 
  goal driven approach is practical when there are a reasonable number of possible 
  final answers, as in the case of a diagnostic or identification system. The 
  system methodically tries to prove or disprove each possible answer, gathering 
  the needed information as it goes.</P>
<P>The 
  data driven approach is practical when combinatorial explosion creates a seemingly 
  infinite number of possible right answers, such as possible configurations of 
  a machine.</P>
<h1><B> <a name="productionsystems"></a>5.1 
  Production Systems </B></h1>
<P>Forward 
  chaining systems are often called "production" systems. Each of the rules is 
  actually a miniature procedure called a production. When the patterns in the 
  left hand side match working storage elements, then the actions on the right 
  hand side are taken. This chapter concentrates on building a production system 
  called Oops.</P>
<P>Production 
  systems are composed of three components. These are: </P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;the 
      rule set;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;a 
      working storage area which contains the current state of the system;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;an 
      inference engine which knows how to apply the rules. </P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  rules are of the form:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>left hand 
      side (LHS) ==&gt; right hand side (RHS).</B></P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  LHS is a collection of conditions which must be matched in working storage for 
  the rule to be executed. The RHS contains the actions to be taken if the LHS 
  conditions are met.</P>
<P>The 
  execution cycle is:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>1.&#9;Select 
      a rule whose left hand side conditions match the current state as stored 
      in the working storage.</P>
    <P> 
     
    <P> </P>
     
    <P>2.&#9;Execute 
      the right hand side of that rule, thus somehow changing the current state.</P>
    <P> 
     
    <P> </P>
     
    <P>3.&#9;Repeat 
      until there are no rules which apply.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Production 
  systems differ in the sophistication of the algorithm used to select a rule 
  (step 1). The first version of Oops will use the simplest algorithm of just 
  selecting the first rule whose conditions match working storage.</P>
<P>The 
  knowledge engineer programs in Oops by creating rules for the particular application. 
  The syntax of the rules is:</P>
<DIR> 
  <DIR> 
    <P><B>rule &lt;rule 
      id&gt;:<BR>
      [&lt;N&gt;: &lt;condition&gt;, .......] <BR>
      ==&gt; <BR>
      [&lt;action&gt;, ....].</B></P>
  </DIR>
</DIR>
<P>where:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>rule 
      id</b> - a unique identifier for the rule;</P>
    <P> 
     
    <P> </P>
     
    <P><B>N</b> 
      - optional identification for the condition;</P>
    <P> 
     
    <P> </P>
     
    <P><B>condition</b> 
      - a pattern to match against working storage;</P>
    <P> 
     
    <P> </P>
     
    <P><B>action</b> 
      - an action to take.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Each 
  <B>condition</B> is a legal Prolog data structure, including variables. Variables 
  are identified, as in Prolog, by an initial upper case letter, or underscore. 
  In general, the <B>condition</B> pattern is matched against those stored in 
  working storage. The comparison operators (&gt;, =&lt;, etc.) are also defined 
  for comparing variables which are bound during the pattern matching.</P>
<P>Note 
  that the data representation of Oops is richer than that used in Clam. In Clam 
  there were only attribute - value pairs, or object - attribute - value triples. 
  In Oops the data can be represented by any legal Prolog term including variables.</P>
<P>The 
  following RHS actions are supported:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>assert(X)</b> 
      - adds the term X to working storage;</P>
    <P> 
     
    <P> </P>
     
    <P><B>retract(all)</b> 
      - retracts all of the working storage terms which were matched in the LHS 
      of the rule being executed;</P>
    <P> 
     
    <P> </P>
     
    <P><B>retract(N)</b> 
      - retracts LHS condition number N from working storage;</P>
    <P> 
     
    <P> </P>
     
    <P><B>X 
      = &lt;arithmetic expression&gt;</b> - sets X to the value of the expression;</P>
    <P> 
     
    <P> </P>
     
    <P><B>X 
      # Y</b> - unifies the structures X and Y; </P>
    <P> 
     
    <P> </P>
     
    <P><B>write(X)</b> 
      - writes the term X to the terminal;</P>
    <P> 
     
    <P> </P>
     
    <P><B>nl</b> 
      - writes a new line at the terminal;</P>
    <P> 
     
    <P> </P>
     
    <P><B>read(X)</b> 
      - reads a term and unifies it to X;</P>
    <P> 
     
    <P> </P>
     
    <P><B>prompt(X, 
      Y)</b> - writes X and reads Y;</P>
  </DIR>
</DIR>
<h1><B> <a name="usingoops"></a>5.2 
  Using Oops </B></h1>
<P>In 
  the Winston &amp; Horn LISP book there is an example of a forward chaining animal 
  identification system. Some of those rules would be expressed in Oops like this:</P>
<DIR> 
  <DIR> 
    <P><B>rule id6:<BR>
      [1: has(X, pointed_teeth), <BR>
      2: has(X, claws), <BR>
      3: has(X, forward_eyes)]<BR>
      ==&gt;<BR>
      [retract(all), <BR>
      assert(isa(X, carnivore))].</B></P>
  </DIR>
</DIR>
<P>This 
  rule would fire if working storage contained the Prolog terms: </P>
<DIR> 
  <DIR> 
    <P><B>has(robie, 
      pointed_teeth)</B></P>
    <P><B>has(robie, 
      claws)</B></P>
    <P><B>has(robie, 
      forward_eyes)</B></P>
  </DIR>
</DIR>
<P>When 
  the rule fired, these three terms would be removed by the <B>retract(all)</B> 
  action on the RHS, and would be replaced with the term: </P>
<DIR> 
  <DIR> 
    <P><B>isa(robie, 
      carnivore)</B></P>
  </DIR>
</DIR>
<P>Since 
  the working storage elements which matched the conditions were removed, this 
  rule would not fire again. Instead, another rule such as this might fire next:</P>
<DIR> 
  <DIR> 
    <P><B>rule id10:<BR>
      [1: isa(X, mammal), <BR>
      2: isa(X, carnivore), <BR>
      3: has(X, black_stripes)]<BR>
      ==&gt;<BR>
      [retract(all), <BR>
      assert(isa(X, tiger))].</B></P>
  </DIR>
</DIR>
<P>Rules 
  about relationships are also easily coded. Again from Winston &amp; Horn's example 
  the rule which says children are the same type of animal as their parents is 
  expressed as follows: </P>
<DIR> 
  <DIR> 
    <P><B>rule id16:<BR>
      [1: isa(Animal, Type), <BR>
      2: parent(Animal, Child)]<BR>
      ==&gt;<BR>
      [retract(2), <BR>
      assert(isa(Child, Type))].</B></P>
  </DIR>
</DIR>
<P>This 
  would transform working storage terms like:</P>
<DIR> 
  <DIR> 
    <P><B>isa(robie, 
      tiger)</B></P>
    <P><B>parent(robie, 
      suzie)</B></P>
  </DIR>
</DIR>
<P>to:</P>
<DIR> 
  <DIR> 
    <P><B>isa(robie, 
      tiger)</B></P>
    <P><B>isa(suzie, 
      tiger)</B></P>
  </DIR>
</DIR>
<P>The 
  working storage is initialized with a statement of the form:</P>
<DIR> 
  <DIR> 
    <P><B>initial_data([&lt;term&gt;, 
      .......]).</B></P>
  </DIR>
</DIR>
<P>Each 
  term is a legal Prolog term which is asserted in working storage.</P>
<P>For 
  example:</P>
<DIR> 
  <DIR> 
    <P><B>initial_data([gives(robie, 
      milk), <BR>
      eats_meat(robie), <BR>
      has(robie, tawny_color), <BR>
      has(robie, dark_spots), <BR>
      parent(robie, suzie)].</B></P>
  </DIR>
</DIR>
<P>It 
  would be better if we could set up the system to ask the user for the initial 
  terms. In a conventional programming language we might set up a loop which repeatedly 
  asked for data until the user typed in "end".</P>
<P>To 
  do the same thing in a production system requires a bit of trickery, which goes 
  against the grain of rule based systems. Theoretically, the rules are independent 
  and don't communicate with each other, but by setting flags in working storage 
  the programmer can force a specific order of rule firings.</P>
<P>Here 
  is how to code the input loop in Oops. It violates another tenet of production 
  systems by making use of the known rule selection strategy. In the case of Oops, 
  it is known that rule 1 will be tried before rule 2.</P>
<DIR> 
  <DIR> 
    <P><B>initial_data([read_facts]).</B></P>
    <P><B>rule 1:&#9; 
      &#9;&#9;</b>% This is the end condition of<BR>
      <B>[1: end, &#9;&#9;</B>% the loop. If "end" and <BR>
      <B>2: read_facts]&#9;&#9;</B>% "read_facts" are both<BR>
      &#9;&#9;&#9;% in working storage, <BR>
      <B>==&gt;</B><BR>
      <B>[retract(all)].&#9;&#9;</B>% then remove them both.</P>
    <P> <B>rule 2:&#9; 
      &#9;&#9;</b>% This is the body of the loop.<BR>
      <B>[1: read_facts]&#9;</B>% If "read_facts" is in WS, <BR>
      <B>==&gt;&#9;&#9;&#9;</B>% then prompt for an attribute<BR>
      <B>[prompt('Attribute? ', X), &#9;</B>% and assert it. If X <BR>
      <B>assert(X)].&#9;&#9;</B>% is "end", rule 1 will fire next.</P>
  </DIR>
</DIR>
<P>The 
  animal identification problem is one that can be solved either in a data driven 
  (forward chaining) approach as illustrated here and in Winston &amp; Horn, or 
  in a goal driven (backward chaining) approach. In fact, where the list of possible 
  animals is known the backward chaining approach is probably a more natural one 
  for this problem.</P>
<P>A 
  more suitable problem for a forward chaining system is configuration. The Oops 
  sample program in the appendix shows such a system. It lays out furniture in 
  a living room.</P>
<P>The 
  program includes a number of rules for laying out furniture. For example:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;The 
      couch goes on the longer wall of the room, and is not on the same side as 
      the door.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      television goes opposite the couch.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;If 
      there is a lamp or television on a wall without a plug, buy an extension 
      cord.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Here 
  are those rules in Oops. They are more complex due to the need to work with 
  the amount of wall space available.</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>% f1 - the couch 
      goes opposite the door</P>
    <P> <B>rule f1:<BR>
      [1: furniture(couch, LenC), &#9;</b>% an unplaced couch<BR>
      <B> position(door, DoorWall), &#9;</B>% find the wall with the door<BR>
      <B> opposite(DoorWall, OW), &#9;</B>% the wall opposite the door<BR>
      <B> right(DoorWall, RW), &#9;</B>% the wall right of the door<B><BR>
      2: wall(OW, LenOW), &#9;</B>% available space opposite<BR>
      <B> wall(RW, LenRW), &#9;&#9;</B>% available space to the right<BR>
      <B> LenOW &gt;= LenRW, &#9;&#9;</B>% if opposite bigger than right<BR>
      <B> LenC =&lt; LenOW]&#9;&#9;</B>% length of couch less than <BR>
      &#9;&#9;&#9;&#9;% wall space</P>
    <P><B> ==&gt;<BR>
      [retract(1), &#9;&#9;&#9;</b>% remove the furniture term<BR>
      <B> assert(position(couch, OW)), &#9;</B>% assert new position<BR>
      <B> retract(2), &#9;&#9;&#9;</B>% remove the old wall, length<BR>
      <B> NewSpace = LenOW - LenC, &#9;</B>% calculate the space left<BR>
      <B> assert(wall(OW, NewSpace))].&#9;</B>% assert new space</P>
    <B> </B> 
    <P>% f3 - the tv 
      should be opposite the couch</P>
    <P><B>rule f3:<BR>
      [1: furniture(tv, LenTV), <BR>
      2: position(couch, CW), <BR>
      3: opposite(CW, W), <BR>
      4: wall(W, LenW), <BR>
      LenW &gt;= LenTV]</B></P>
    <P><B> ==&gt;<BR>
      [retract(1), <BR>
      assert(position(tv, W)), <BR>
      retract(4), <BR>
      NewSpace = LenW - LenTV, <BR>
      assert(wall(W, NewSpace))].</B></P>
    <P>% get extension 
      cords if needed</P>
    <P><B>rule f12:<BR>
      [1: position(tv, W), <BR>
      2: not(position(plug, W))]</B></P>
    <P><B> ==&gt;<BR>
      [assert(buy(extension_cord, W)), <BR>
      assert(position(plug, W))].</B></P>
    <P><B>rule f13:<BR>
      [1: position(table_lamp, W), <BR>
      2: not(position(plug, W))]</B></P>
    <P><B> ==&gt;<BR>
      [assert(buy(extension_cord, W)), <BR>
      assert(position(plug, W))].</B></P>
  </DIR>
</DIR>
<P>The 
  program also uses rules to control a dialog with the user to gather initial 
  data. It needs to know about room dimensions, furniture to be placed, plug locations, 
  etc. It does this by setting various data gathering goals. For example the initial 
  goal of the system is to <B>place_furniture</B>. It gives directions to the 
  user and sets up the goal <B>read_furniture</B>. Once <B>read_furniture</B> 
  is done (signified by the user entering end : end), it sets up the next goal 
  of <B>read_walls</B>. Here is the beginning code.</P>
<DIR> 
  <DIR> 
    <P> <B>rule 1:<BR>
      [1: goal(place_furniture), &#9;</b>% The initial goal causes a <BR>
      <B> 2: legal_furniture(LF)]&#9;</B>% rule to fire with <BR>
      &#9;&#9;&#9;&#9;% introductory info.</P>
    <P><B> ==&gt;&#9;&#9;&#9;&#9;</b>% 
      It will set a new goal.<BR>
      <B>[retract(1), <BR>
      cls, nl, <BR>
      write('Enter a single item of furniture at each prompt.'), nl, <BR>
      write('Include the width (in feet) of each item.'), nl, <BR>
      write('The format is Item:Length.'), nl, nl, <BR>
      write('The legal values are:'), nl, <BR>
      write(LF), nl, nl, <BR>
      write('When there is no more furniture, enter "end:end".'), nl, <BR>
      assert(goal(read_furniture))].</b></P>
    <P> <B>rule 2:<BR>
      [1: furniture(end, end), &#9;</b>% When the furniture is read<BR>
      <B> 2: goal(read_furniture)]&#9;</B>% set the new goal of reading</P>
    <P><B> ==&gt;&#9;&#9;&#9;&#9;</b>% 
      wall sizes<BR>
      <B>[retract(all), <BR>
      assert(goal(read_walls))].</b></P>
    <P> <B>rule 3:<BR>
      [1: goal(read_furniture), &#9;</b>% Loop to read furniture.<BR>
      <B> 2: legal_furniture(LF)]</b></P>
    <P><B> ==&gt;<BR>
      [prompt('furniture&gt; ', F:L), <BR>
      member(F, LF), <BR>
      assert(furniture(F, L))].</B></P>
    <P><B>rule 4:&#9;&#9;&#9;&#9;</b>% 
      If rule 3 matched and failed<BR>
      <B>[1: goal(read_furniture), &#9;</B>% the action, then member <BR>
      <B> 2: legal_furniture(LF)]&#9;</B>% must have failed.</P>
    <P><B> ==&gt;<BR>
      [write('Unknown piece of furniture, must be one of:'), nl, <BR>
      write(LF), nl].</B></P>
  </DIR>
</DIR>
<P>The 
  room configurer illustrates both the strengths and weaknesses of a pure production 
  system. The rules for laying out the furniture are very clear. New rules can 
  be added, and old ones deleted without affecting the system. It is much easier 
  to work with this program structure than it would be to understand procedural 
  code which attempted to do the same thing.</P>
<P>On 
  the other hand, the rules which interact with the user to collect data are difficult 
  to read and have interdependencies which make them hard to maintain. The flow 
  of control is obscured. This code would be better written procedurally, but 
  it is done using Oops to illustrate how these kinds of problems can be solved 
  with a production architecture.</P>
<P>An 
  ideal architecture would integrate the two approaches. It would be very simple 
  to let Oops drop back down to Prolog for those cases where Oops is inappropriate. 
  This architecture is covered in chapter 7.</P>
<h1><B> <a name="implementation"></a>5.3 
  Implementation </B></h1>
<P>The 
  implementation of Oops is both compact and readable due to the following features 
  of Prolog:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;Each 
      rule is represented as a single Prolog term (a relatively complex structure).</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      functors of the rule structure are defined as operators to allow the easy-to-read 
      syntax of the rule.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;Prolog's 
      built-in backtracking search makes rule selection easy.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;Prolog's 
      built-in pattern matching (unification) makes comparison with working storage 
      easy.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;Since 
      each rule is a single term, unification causes variables to be automatically 
      bound between LHS conditions and RHS actions.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      Prolog database provides an easy representation of working storage.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Each 
  rule is a single Prolog term, composed primarily of two lists: the right hand 
  side (RHS), and the left hand side (LHS). These are stored using Prolog's normal 
  data structures, with <B>rule</B> being the predicate and the various arguments 
  being lists.</P>
<P>In 
  Clam, DCG was used to allow a friendly, flexible rule format. In Oops, Prolog 
  operators are used. The operators allow for a syntax which is formal, but readable. 
  The operator syntax can also be used directly in the code.</P>
<P>Without 
  operator definitions, the rules would look like normal hierarchical Prolog data 
  structures:</P>
<DIR> 
  <DIR> 
    <P><B>rule(==&gt;(:(id4, 
      [:(1, flies(X)), :(2, lays_eggs(X))], [retract(all), assert(isa(X, bird))])).</B></P>
  </DIR>
</DIR>
<P>The 
  following operator definitions allow for the more readable format of the rules:</P>
<DIR> 
  <DIR> 
    <P><B>op(230, xfx, 
      ==&gt;).</B></P>
    <P><B>op(32, xfy, 
      :).</B></P>
    <P><B>op(250, fx, 
      rule).</B></P>
  </DIR>
</DIR>
<P>Working 
  storage is stored in the database under the key <B>fact</B>. So to add a term 
  to working storage:</P>
<DIR> 
  <DIR> 
    <P><B>asserta( fact(isa(robie, 
      carnivore)) ), </B></P>
  </DIR>
</DIR>
<P>and 
  to look for a term in working storage:</P>
<DIR> 
  <DIR> 
    <P><B>fact( isa(X, 
      carnivore) ).</B></P>
  </DIR>
</DIR>
<P>Figure 
  5.1 shows the major predicates in the Oops inference engine. The inference cycle 
  of recognize - act is coded in the predicate <B>go</B>. It searches for the 
  first rule which matches working storage, and executes it. Then it repeats the 
  process. If no rules match, then the second clause of <B>go</B> is executed 
  and the inference ends. Then the second clause prints out the current state 
  showing what was determined during the run. (Note that <B>LHS</B> and <B>RHS</B> 
  are bound to lists.)</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="forward5-1.gif" WIDTH=293 HEIGHT=165><BR>
  </P>
<P>Figure 
  5.1. Major predicates in Oops inference engine</P>
<DIR> 
  <DIR>   
    <P><B>go:-<BR>
      call(rule ID: LHS ==&gt; RHS), <BR>
      try(LHS, RHS), <BR>
      write('Rule fired '), write(ID), nl, <BR>
      !, go.</B></P>
    <P><B>go:-<BR>
      nl, write(done), nl, <BR>
      print_state.</B></P>
  </DIR>
</DIR>
<P>This 
  code illustrates the tremendous expressiveness of Prolog. The code is very tight 
  due to the built-in pattern matching and backtracking search. Especially note 
  that since the entire rule is a single Prolog term, the unification between 
  variables in the conditions and actions happens automatically. This leads to 
  a use of variables which is, in some senses, cleaner and more powerful than 
  that found in OPS5.</P>
<P>The<B> 
  try/2</B> predicate is very simple. If <B>match/2</B> fails, it forces <B>go</B> 
  to backtrack and find the next rule. The <B>LHS</B> is passed to <B>process</B> 
  so retract statements can find the facts to retract.</P>
<DIR> 
  <DIR> 
    <P><B>try(LHS, RHS):-<BR>
      match(LHS), <BR>
      process(RHS, LHS).</B></P>
  </DIR>
</DIR>
<P>The<B> 
  match/2</B> predicate recursively goes through the list of conditions, locating 
  them in working storage. If the condition is a comparison test, then the test 
  is tried, rather than searched for in the database.</P>
<DIR> 
  <DIR> 
    <P><B>match([]) 
      :- !.</B></P>
    <P><B>match([N:Prem|Rest]) 
      :-<BR>
      !, <BR>
      (fact(Prem);<BR>
      test(Prem)), &#9;</b>% a comparison test rather than a fact<BR>
      <B>match(Rest).</b></P>
    <P> <B>match([Prem|Rest]) 
      :-<BR>
      (fact(Prem);&#9;&#9;</b>% condition number not specified<BR>
      <B> test(Prem)), <BR>
      match(Rest).</b></P>
  </DIR>
</DIR>
<P>The<B> 
  test/1</B> predicate can be expanded to include any kind of test. Oops uses 
  most of the basic tests provided with Prolog, plus a few. For example:</P>
<DIR> 
  <DIR> 
    <P><B>test(X &gt;= 
      Y):- X &gt;= Y, !.</B></P>
    <P><B>test(X = Y):- 
      X is Y, !.&#9;&#9;</b>% use = for arithmetic</P>
    <P><B>test(X # Y):- 
      X = Y, !.&#9;&#9;</b>% use # for unification</P>
    <P><B>test(member(X, 
      Y)):- member(X, Y), !.</B></P>
    <P><B>test(not(X)):-<BR>
      fact(X), <BR>
      !, fail.</B></P>
  </DIR>
</DIR>
<P>If 
  <B>match/2</B> succeeds, then <B>process/2</B> is called. It executes the RHS 
  list of actions. It is equally straightforward.</P>
<DIR> 
  <DIR> 
    <P><B>process([], 
      _) :- !.</B></P>
    <P><B>process([Action|Rest], 
      LHS) :-<BR>
      take(Action, LHS), <BR>
      process(Rest, LHS).</B></P>
  </DIR>
</DIR>
<P>Only 
  the action <B>retract</B> needs the <B>LHS</B>. The <B>take/2</B> predicate 
  does a retract if that is what's called for, or else passes control to <B>take/1</B> 
  which enumerates the simpler actions. Some examples are given here.</P>
<DIR> 
  <DIR> 
    <P><B>take(retract(N), 
      LHS) :-<BR>
      (N == all; integer(N)), <BR>
      retr(N, LHS), !.</B></P>
    <P><B>take(A, _) 
      :-take(A), !.</B></P>
    <P><B>take(retract(X)) 
      :- retract(fact(X)), !.</B></P>
    <P><B>take(assert(X)) 
      :- asserta(fact(X)), write(adding-X), nl, !.</B></P>
    <P><B>take(X # Y) 
      :- X=Y, !.</B></P>
    <P><B>take(X = Y) 
      :- X is Y, !.</B></P>
    <P><B>take(write(X)) 
      :- write(X), !.</B></P>
    <P><B>take(nl) :- 
      nl, !.</B></P>
    <P><B>take(read(X)) 
      :- read(X), !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>retr</B> predicate searches for <B>LHS</B> conditions with the same identification 
  (<B>N</B>) and retracts them. If <B>all </B>was indicated, then it retracts 
  all of the <B>LHS</B> conditions.</P>
<DIR> 
  <DIR> 
    <P><B>retr(all, 
      LHS) :-retrall(LHS), !.</B></P>
    <P><B>retr(N, []) 
      :-write('retract error, no '-N), nl, !.</B></P>
    <P><B>retr(N, [N:Prem|_]) 
      :- retract(fact(Prem)), !.</B></P>
    <P><B>retr(N, [_|Rest]) 
      :- !, retr(N, Rest).</B></P>
    <P><B>retrall([]).</B></P>
    <P><B>retrall([N:Prem|Rest]) 
      :-<BR>
      retract(fact(Prem)), <BR>
      !, retrall(Rest).</B></P>
    <P><B>retrall([Prem|Rest]) 
      :-<BR>
      retract(fact(Prem)), <BR>
      !, retrall(Rest).</B></P>
    <P><B>retrall([_|Rest]) 
      :-&#9;&#9;</b>% must have been a test<BR>
      <B>retrall(Rest).</b></P>
  </DIR>
</DIR>
<P>Oops 
  can be made to look like the other shells by the addition of a command loop 
  predicate with commands similar to those in Clam and Native. Figure 5.2 shows 
  the architecture of Oops.</P>
<h1><B> <a name="explanationforoops"></a>5.4 
  Explanations for Oops </B></h1>
<P>Explanations 
  for forward chaining systems are more difficult to implement. This is because 
  each rule modifies working storage, thus covering its tracks. The most useful 
  information in debugging a forward chaining system is a trace facility. That 
  is, you want to know each rule that is fired and the effects it has on working 
  storage.</P>
<P>Each 
  fact can have associated with it the rule which posted it, and this would give 
  the immediate explanation of a fact. However, the facts which supported the 
  rules which led up to that fact might have been erased from working memory. 
  To give a full explanation, the system would have to keep time stamped copies 
  of old versions of facts.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="forward5-2.gif" WIDTH=343 HEIGHT=393><BR>
  </P>
<P>Figure 
  5.2. Major predicates of the Oops shell</P>
<P>The 
  trace option is added in Oops in a similar fashion to which it was added in 
  Clam. The inference engine informs the user of the rules which are firing as 
  they fire.</P>
<h1><B> <a name="enhancements"></a>5.5 
  Enhancements </B></h1>
<P>Oops 
  in its current state is a simple forward chaining system. More advanced forward 
  chaining systems differ in two main aspects.</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;more 
      sophisticated rule selection when many rules match the current working storage;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;performance.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  current rule selection strategy of Oops is simply to pick the first rule which 
  matches. If many rules match, there might be other optimal choosing strategies. 
  For example, we could pick the rule that matched the most recently asserted 
  facts, or the rule which had the most specific match. Either of these would 
  change the inference pattern of the system to give effects which might be more 
  natural.</P>
<P>Oops 
  is also inefficient in its pattern matching, since at each cycle of the system 
  it tries all of the rules against working memory. There are various indexing 
  schemes which can be used to allow for much faster picking of rules which match 
  working memory. These will be discussed in the chapter 8.</P>
<h1><B> <a name="ruleselection"></a>5.6 
  Rule Selection </B></h1>
<P>OPS5, 
  which is probably the most well known example of a forward chaining, or production, 
  system offers two different means of selecting rules. One is called LEX and 
  the other is MEA. Both make use of time stamped data to determine the best rule 
  to fire next. They differ slightly in the way in which they use the data. Both 
  of these strategies can be added to Oops as options.</P>
<h2 ALIGN="JUSTIFY"><B><a name="generatingtheconflictset"></a>Generating 
  the conflict set</B></h2>
<P>For 
  both, the first step is to collect all of the rules whose LHS match working 
  memory at a given cycle. This set of rules is called the conflict set. It is 
  not actually the rules, but rather instantiations of the rules. This means that 
  the same rule might have multiple instantiations if there are multiple facts 
  which match a LHS premise. This will often happen when there are variables in 
  the rules which are bound differently for different instantiations.</P>
<P>For 
  example, an expert system to identify animals might have the following condition 
  on the LHS:</P>
<DIR> 
  <DIR> 
    <P><B>rule 12:<BR>
      [...<BR>
      eats(X, meat), <BR>
      ...]<BR>
      ==&gt; ...</B></P>
  </DIR>
</DIR>
<P>In 
  working memory there might be the following two facts:</P>
<DIR> 
  <DIR> 
    <P><B>...</B></P>
    <P><B>eats(robie, 
      meat).</B></P>
    <P><B>eats(suzie, 
      meat).</B></P>
    <P><B>...</B></P>
  </DIR>
</DIR>
<P>Assuming 
  the other conditions on the LHS matched, this would lead to two different instantiations 
  of the same rule. One for <B>robie</B> and one for <B>suzie</B>.</P>
<P>The 
  simplest way to get the conflict set is to use <B>findall</B> or its equivalent. 
  (If your system does not have a findall, a description of how to write your 
  own can be found in Clocksin and Mellish section 7.8, <I>Assert and Retract: 
  Random, Gensym, Findall</I>.) It collects all of the instantiations of a term 
  in a list. The three arguments to <B>findall</B> are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;a 
      term which is used as a pattern to collect instantiations of variables;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;a 
      list of goals used as a query;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;an 
      output list whose elements match the pattern of the first argument, and 
      for which there is one element for each successful execution of the query 
      in the second argument.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  instantiations of the conflict set will be stored in a structure, <B>r/4</B>. 
  The last three arguments of <B>r/4</B> will be the <B>ID</B>, <B>LHS</B>, and 
  <B>RHS</B> of the rule which will be used later.</P>
<P>The 
  first argument of <B>r/4 </B>is the <B>LHS</B> with the variables instantiated 
  with the working storage elements that were matched. Each match of a LHS premise 
  and working storage element is also accompanied by a time stamp indicating when 
  the working storage element was last updated.</P>
<P>The 
  query to be executed repeatedly by <B>findall</B> will be similar to the one 
  currently used to find just the first matching rule:</P>
<DIR> 
  <DIR> 
    <P><B>?- rule ID 
      : LHS ==&gt; RHS, match(LHS, Inst)</B></P>
  </DIR>
</DIR>
<P>Note 
  that <B>match</B> now has a second argument to store the instantiation of the 
  rule which will be the first argument to <B>r/4</B>.</P>
<P>The 
  following predicate puts the above pieces together and uses <B>findall</B> to 
  build a list (<B>CS</B>) of <B>r/4</B>s representing all of the rules which 
  currently match working storage.</P>
<DIR> 
  <DIR> 
    <P><B>conflict_set(CS) 
      :-<BR>
      findall(r(Inst, ID, LHS, RHS), <BR>
      &#9;[rule ID: LHS ==&gt; RHS, match(LHS, Inst)], <BR>
      &#9;CS).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>match</B> predicate just needs to be changed to capture the instantiation 
  of the conditions. Notice there is an additional argument, <B>Time</B>, in the 
  <B>fact</B> predicate. This is a time stamp that will be used in the selection 
  process.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>match([], []) 
      :- !.</P>
    <P>match([N:Prem|Rest]<B>, 
      [Prem/Time|IRest]</B>) :-<BR>
      !, <BR>
      (fact(Prem<B>, Time</B>);<BR>
      test(Prem)<B>, Time = 0</B>), &#9;%comparison, not a fact<BR>
      match(Rest<B>, IRest</B>).</P>
    <P>match([Prem|Rest]<B>, 
      [Prem/Time|IRest]</B>) :-<BR>
      (fact(Prem<B>, Time</B>);&#9;&#9;% no condition number<BR>
      test(Prem)<B>, Time = 0</B>), <BR>
      match(Rest<B>, IRest</B>).</P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="timestamps"></a>Time 
  stamps</B></h2>
<P>The 
  timestamp is just a chronological counter that numbers the <B>fact</B>s in working 
  memory as they are added. All assertions of facts are now handled by the <B>assert_ws</B> 
  predicate as follows:</P>
<DIR> 
  <DIR> 
    <P><B>assert_ws(fact(X, 
      T)) :-<BR>
      getchron(T), <BR>
      asserta(fact(X, T)).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>getchron</B> predicate simply keeps adding to a counter.</P>
<DIR> 
  <DIR> 
    <P><B>getchron(N) 
      :-<BR>
      retract( chron(N) ), <BR>
      NN is N + 1, <BR>
      asserta( chron(NN) ), !.</B></P>
  </DIR>
</DIR>
<h1><B> <a name="lex"></a>5.7 
  LEX </B></h1>
<P>Now 
  that we have a list of possible rules and instantiations in the conflict set, 
  it is necessary to select one. First we will look at the OPS5 LEX method of 
  rule selection. It uses three criteria to select a rule.</P>
<P>The 
  first is refraction. This discards any instantiations which have already been 
  fired. Two instantiations are the same if the variable bindings and the time 
  stamps are the same. This prevents the same rule from firing over and over, 
  unless the programmer has caused working memory to be repeatedly updated with 
  the same fact.</P>
<P>The 
  second is recency. This choses the rules which use the most recent elements 
  in working memory. The conflict set rules are ordered with those rules with 
  the highest time stamps first. This is useful to give the system a sense of 
  focus as it works on a problem. Facts which are just asserted will most likely 
  be used next in a rule.</P>
<P>The 
  third is specificity. If there are still multiple rules in contention, the most 
  specific is used. The more conditions there are that apply in the LHS of the 
  rule, the more specific it is. For example, a rule with 4 conditions is more 
  specific than one with 3 conditions. This criteria ensures that general case 
  rules will fire after more specific case rules.</P>
<P>If 
  after these tests there are still multiple rules which apply, then one is chosen 
  at random.</P>
<h2 ALIGN="JUSTIFY"><B><a name="changesintherules"></a>Changes 
  in the Rules</B></h2>
<P>The 
  LEX strategy changes the way in which Oops rules are programmed. In the first 
  version of Oops, the knowledge engineer had to make sure that the working storage 
  elements which caused the rule to fire are changed. It was the knowledge engineer's 
  responsibility to ensure that a rule did not repeatedly fire.</P>
<P>The 
  opposite is also true. Where looping is required, the facts matching the LHS 
  must be continually reasserted.</P>
<P>In 
  the original version of Oops the knowledge engineer knew the order in which 
  rules would fire, and could use that information to control the inference. Using 
  LEX he/she can still control the inference, but it requires more work. For example, 
  if it is desirable to have the couch placed first by the system, then that rule 
  must be structured to fire first. This can be done by adding a goal to place 
  the couch first and asserting it after the data is gathered. For example:</P>
<DIR> 
  <DIR> 
    <P><B>rule gather_data</B></P>
    <P><B>...</B></P>
    <P><B>==&gt;</B></P>
    <P><B>[...</B></P>
    <P><B> assert( goal(couch_first) 
      ) ].</B></P>
    <P><B>rule couch</B></P>
    <P><B>[ goal(couch_first), 
      </B></P>
    <P><B> ...</B></P>
  </DIR>
</DIR>
<P>The 
  <B>gather_data</B> rule will assert the <B>couch_first</B> goal after all other 
  assertions. This means it is the most recent addition to working storage. The 
  Lex recency criteria will then ensure that the couch rule is fired next.</P>
<P>The 
  rule which is supposed to fire last in the system also needs to be handled specially. 
  The easiest way to ensure a rule will fire last is to give it an empty list 
  for the LHS. The specificity check will keep it from firing until all others 
  have fired.</P>
<h2 ALIGN="JUSTIFY"><B><a name="implementinglex"></a>Implementing 
  LEX</B></h2>
<P>To 
  implement the LEX strategy, we modify the <B>go</B> predicate to first get the 
  conflict set and then pass it to the predicate <B>select_rule</B> which picks 
  the rule to execute. After processing the rule, the instantiation associated 
  with the rule is saved to be used as a check that it is not reexecuted.</P>
<DIR> 
  <DIR> 
    <P>go :-<BR>
      <B>conflict_set(CS), <BR>
      select_rule(CS, r(Inst, ID, LHS, RHS)), <BR>
      </B>process(RHS, LHS), <BR>

      <B>asserta( instantiation(Inst) ), <BR>
      </B>write('Rule fired '), write(ID), nl, <BR>
      !, go.</P>
    <P>go.</P>
  </DIR>
</DIR>
<P>The 
  <B>select_rule</B> predicate applies the three criteria above to select the 
  appropriate rule. The <B>refract</B> predicate applies refraction, and <B>lex_sort</B> 
  applies both recency and specificity through a sorting mechanism.</P>
<DIR> 
  <DIR> 
    <P><B>select_rule(CS, 
      R) :-<BR>
      refract(CS, CS1), <BR>
      lex_sort(CSR, [R|_]).</B></P>
  </DIR>
</DIR>
<P>First 
  let's look at <B>refract</B>, which removes those rules which duplicate existing 
  instantiations. It relies on the fact that after each successful rule firing, 
  the instantiation is saved in the database.</P>
<DIR> 
  <DIR> 
    <P><B>refract([], 
      []).</B></P>
    <P><B>refract([r(Inst, 
      _, _, _)|T], TR) :-<BR>
      instantiation(Inst), <BR>
      !, refract(T, TR).</B></P>
    <P><B>refract([H|T], 
      [H|TR]) :-<BR>
      refract(T, TR).</B></P>
  </DIR>
</DIR>
<P>Once 
  <B>refract</B> is done processing the list, only those rules with new instantiations 
  are left on the list.</P>
<P>The 
  implementation of <B>lex_sort</B> doesn't filter the remaining rules, but sorts 
  them so that the first rule on the list is the desired rule. This is done by 
  creating a key for each rule which is used to sort the rules. The key is designed 
  to sort by recency and specificity. The sorting is done with a common built-in 
  predicate, <B>keysort</B>, which sorts a list by keys where the elements are 
  in the form: <B>key - term</B>. (If your Prolog does not have a <B>keysort</B>, 
  see Clocksin and Mellish section 7.7, <I>Sorting</I>.)</P>
<DIR> 
  <DIR> 
    <P><B>lex_sort(L, 
      R) :-<BR>
      build_keys(L, LK), <BR>
      keysort(LK, X), <BR>
      reverse(X, Y), <BR>
      strip_keys(Y, R).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>build_keys</B> predicate adds the keys to each term. The keyed list is then 
  sorted by <B>keysort</B>. It comes out backwards, so it is reversed, and finally 
  the keys are stripped from the list. In order for this to work, the right key 
  needs to be chosen.</P>
<P>The 
  key which gives the desired results is itself a list. The elements are the time 
  stamps of the various matched conditions in the instantiation of the rule. The 
  key (a list) is sorted so that the most recent (highest number) time stamps 
  are at the head of the list. These complex keys can themselves be sorted to 
  give the correct ordering of the rules. For example, consider the following 
  two rules, and working storage:</P>
<DIR> 
  <DIR> 
    <P><B>rule t1:<BR>
      [flies(X), <BR>
      lays_eggs(X)]<BR>
      ==&gt;<BR>
      [assert(bird(X))].</B></P>
    <P><B>rule t2:<BR>
      [mammal(X), <BR>
      long_ears(X), <BR>
      eats_carrots(X)]<BR>
      ==&gt;<BR>
      [assert(animal(X, rabbit))].</B></P>
    <P><B>fact( flies(lara), 
      9).</B></P>
    <P><B>fact( flies(zach), 
      6).</B></P>
    <P><B>fact( lays_eggs(lara), 
      7).</B></P>
    <P><B>fact( lays_eggs(zach), 
      8).</B></P>
    <P><B>fact( mammal(bonbon), 
      3).</B></P>
    <P><B>fact( long_ears(bonbon), 
      4).</B></P>
    <P><B>fact( eats_carrots(bonbon), 
      5).</B></P>
  </DIR>
</DIR>
<P>There 
  would be two instantiations of the first rule, one each for <B>lara</B> and 
  <B>zach</B>, and one instantiation of the second rule for <B>bonbon</B>. The 
  highest numbers are the most recent time stamps. The keys (in order) for these 
  three instantiations would be:</P>
<DIR> 
  <DIR> 
    <P><B>[9, 7]</B></P>
    <P><B>[8, 6]</B></P>
    <P><B>[5, 4, 3]</B></P>
  </DIR>
</DIR>
<P>In 
  order to get the desired sort, lists must be compared element by element starting 
  from the head of the list. This gives the <B>recency</B> sort. The sort must 
  also distinguish between two lists of different lengths with the same common 
  elements. This gives the <B>specificity</B> sort. For AAIS prolog the sort works 
  as desired with <B>recency</B> being more important than <B>specificity</B>. 
  It should be checked for other Prologs.</P>
<P>Here 
  is the code to build the keys:</P>
<DIR> 
  <DIR> 
    <P><B>build_keys([], 
      []).</B></P>
    <P><B>build_keys([r(Inst, 
      A, B, C)|T], [Key-r(Inst, A, B, C)|TR]) :-<BR>
      build_chlist(Inst, ChL), <BR>
      sort(ChL, X), <BR>
      reverse(X, Key), <BR>
      build_keys(T, TR).</B></P>
    <P><B>build_chlist([], 
      []).</B></P>
    <P><B>build_chlist([_/Chron|T], 
      [Chron|TC]) :-<BR>
      build_chlist(T, TC).&#9;</B></P>
  </DIR>
</DIR>
<P>The 
  <B>build_keys</B> predicate uses <B>build_chlist</B> to create a list of the 
  time stamps associated with the LHS instantiation. It then sorts those, and 
  reverses the result, so that the most recent time stamps are first in the list.</P>
<P>The 
  final predicate, <B>strip_keys</B>, simply removes the keys from the resulting 
  list.</P>
<DIR> 
  <DIR> 
    <P><B>strip_keys([], 
      []).</B></P>
    <P><B>strip_keys([Key-X|Y], 
      [X|Z]) :-<BR>
      strip_keys(Y, Z).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="MEA"></a>5.8 
  MEA </B></h1>
<P>The 
  other strategy offered with OPS5 is MEA. This is identical to LEX with one additional 
  filter added. After refraction, it finds the time stamp associated with the 
  first condition of the rule and picks the rule with the highest time stamp on 
  the first condition. If there is more than one, then the normal LEX algorithm 
  is used to pick which of them to use.</P>
<P>At 
  first this might seem like an arbitrary decision; however, it was designed to 
  make goal directed programming easier in OPS5. The flow of control of a forward 
  chaining system is often controlled by setting goal facts in working storage. 
  Rules might have goals in the conditions thus ensuring the rule will only fire 
  when that goal is being pursued.</P>
<P>By 
  making the goal condition the first condition on the LHS of each rule, and by 
  using MEA, the programmer can force the system to pursue goals in a specified 
  manor. In fact, using this technique it is possible to build backward chaining 
  systems using a forward chaining tool.</P>
<P>The 
  test for MEA is simply added to the system. First, the filter is added to the 
  <B>select_rule</B> predicate. It will simply return the same conflict set if 
  the current strategy is not MEA.</P>
<DIR> 
  <DIR> <B> </b> 
    <P>select_rule(R, 
      CS) :-<BR>
      refract(CS, CS1), <BR>
      <B>mea_filter(0, CS1, [], CSR), <BR>
      </B>lex_sort(CSR, [R|_]).</P>
  </DIR>
</DIR>
<P>The 
  actual filter predicates build the new list in an accumulator variable, <B>Temp</B>. 
  If the first time stamp for a given rule is less than the current maximum, it 
  is not included. If it equals the current maximum, it is added to the list of 
  rules. If it is greater than the maximum, that timestamp becomes the new maximum, 
  and the list is reinitialized to have just that single rule.</P>
<DIR> 
  <DIR> 
    <P><B>mea_filter(_, 
      X, _, X) :- not strategy(mea), !.</B></P>
    <P><B>mea_filter(_, 
      [], X, X).</B></P>
    <P><B>mea_filter(Max, 
      [r([A/T|Z], B, C, D)|X], Temp, ML) :-<BR>
      T &lt; Max, <BR>
      !, mea_filter(Max, X, Temp, ML).</B></P>
    <P><B>mea_filter(Max, 
      [r([A/T|Z], B, C, D)|X], Temp, ML) :-<BR>
      T = Max, <BR>
      !, mea_filter(Max, X, [r([A/T|Z], B, C, D)|Temp], ML).</B></P>
    <P><B>mea_filter(Max, 
      [r([A/T|Z], B, C, D)|X], Temp, ML) :-<BR>
      T &gt; Max, <BR>
      !, mea_filter(T, X, [r([A/T|Z], B, C, D)], ML).</B></P>
  </DIR>
</DIR>
<P>These 
  examples illustrate some of the difficulties with expert systems in general. 
  The OPS5 programmer must be intimately familiar with the nature of the inferencing 
  in order to get the performance desired from the system. He is only free to 
  use the tools available to him.</P>
<P>On 
  the other hand, if the programmer has access to the selection strategy code, 
  and knows the type of inferencing that will be required, the appropriate strategy 
  can be built into the system. Given the accessibility of the above code, it 
  is easy to experiment with different selection strategies.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>5.1 
  - Add full rule tracing to OOPS.</P>
<P> 
 
<P> </P>
 
<P>5.2 
  - Add a command loop which turns on and off tracing, MEA/LEX strategies, loads 
  rule files, consults the rules, lists working storage, etc.</P>
<P> 
 
<P> </P>
 
<P>5.3 
  - Add a feature that allows for the saving of test case data which can then 
  be run against the system. The test data and the results are used to debug the 
  system as it undergoes change.</P>
<P> 
 
<P> </P>
 
<P>5.4 
  - Allow each rule to optionally have a priority associated with it. Use the 
  user defined rule priorities as the first criteria for selecting rule instantiations 
  from the conflict set.</P>
<P> 
 
<P> </P>
 
<P>5.5 
  - Add features on the LHS and RHS that allow rules to be written which can access 
  the conflict set and dynamically change the rule priorities. Figure out an application 
  for this.</P>
<P> 
 
<P> </P>
 
<P>5.6 
  - Add new syntax to the knowledge base that allows rules to be clustered into 
  rule sets. Maintain separate conflict sets for each rule set and have the inference 
  engine process each rule set to completion. Have higher level rules which can 
  be used to decide which rule sets to execute. Alternatively, each rule set can 
  have an enabling pattern associated with it that allows it to fire just as individual 
  rules are fired.</P>
<P> 
 
<P> </P>
 
<P>5.7 - Each fact in 
  working storage can be thought of as being dependent on other facts. The other 
  facts are those which instantiated the LHS of a rule which udpated the fact. 
  By keeping track of these dependencies, a form of truth maintenance can be added 
  to the system. When a fact is then removed from working storage, the system 
  can find other facts which were dependent on it and remove them as well.</P>


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
