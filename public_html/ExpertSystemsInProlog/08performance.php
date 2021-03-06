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
<td><h1>8 Performance</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>As 
  the size of a knowledge base grows, performance becomes more problematic. The 
  inference engines we have looked at so far use a simple pattern matching algorithm 
  to find the rules to fire. Various indexing schemes can be used to speed up 
  that pattern matching process.</P>
<P>The 
  indexing problem is different for forward and backward chaining systems. Backward 
  chaining systems need to be accessed by the goal pattern in the right hand side 
  of the rule. Forward chaining systems need to be indexed by the more complex 
  patterns on the left hand side. Backward chaining issues will be discussed briefly 
  in this chapter, followed by more in depth treatment of a simplified Rete match 
  algorithm for the Foops forward chaining system.</P>
<h1><B> <a name="backwardchainingindexes"></a>8.1 
  Backward Chaining Indexes </B></h1>
<P>For 
  performance in backward chaining systems, the rules are indexed by goal patterns 
  on the right hand side. In particular, if the goal is to find a value for a 
  given attribute, then the rules should be indexed by the attribute set in the 
  RHS of the rule. This happens automatically for the pure Prolog rules in the 
  bird identification program since the attributes are Prolog predicate names 
  which are generally accessed through hashing algorithms. The indices, if desired, 
  must be built into the backward chaining engine used in Clam. Some Prologs provide 
  automatic indexing on the first argument of a predicate. This feature could 
  be used to provide the required performance.</P>
<P>Given 
  indexing by the first argument, the rules in Clam would be represented:</P>
<DIR> 
  <DIR> 
    <P><B>rule(Attribute, 
      Val, CF, Name, LHS).</B></P>
  </DIR>
</DIR>
<P>This 
  way, a search for rules providing values for a given attribute would quickly 
  find the appropriate rules.</P>
<P>Without 
  this, each rule could be represented with a functor based on the goal pattern 
  and accessed using the univ (=..) predicate rather than the pattern matching 
  currently used in Clam. The predicates which initially read the rules can store 
  them using this scheme. For example, the internal format of the Clam rules would 
  be:</P>
<DIR> 
  <DIR> 
    <P><B>Attribute(Val, 
      CF, Name, LHS).</B></P>
  </DIR>
</DIR>
<P>In 
  particular, some rules from the car diagnostic system would be:</P>
<DIR> 
  <DIR> 
    <P><B>problem(battery, 
      100, 'rule 1', <BR>
      [av(turn_over, no), av(battery_bad, yes)]).</B></P>
    <P><B>problem(flooded, 
      80, 'rule 4', <BR>
      [av(turn_over, yes), av(smell_gas, yes)]).</B></P>
    <P><B>battery_bad(yes, 
      50, 'rule 3', [av(radio_weak, yes)]).</B></P>
  </DIR>
</DIR>
<P>When 
  the inference is looking for rules to establish values for an attribute - value 
  pattern, <B>av(A, V)</B>, the following code would be used:</P>
<DIR> 
  <DIR> 
    <P><B>Rule =.. [A, 
      V, CF, ID, LHS], </B></P>
    <P><B>call(Rule), 
      </B></P>
    <P><B>...</B></P>
  </DIR>
</DIR>
<P>This 
  structure would allow Clam to take advantage of the hashing algorithms built 
  into Prolog for accessing predicates.</P>
<h1><B> <a name="retematchalgorithm"></a>8.2 
  Rete Match Algorithm </B></h1>
<P>OPS5 
  and some high-end expert system shells use the Rete match algorithm to optimize 
  performance. It is an indexing scheme which allows for rapid matching of changes 
  in working memory with the rules. Previous match information is saved on each 
  cycle, so the system avoids redundant calculations. We will implement a simplified 
  version of the Rete algorithm for Foops.</P>
<P>The 
  Rete algorithm is designed for matching left hand side rule patterns against 
  working storage elements. Let's look at two similar rules from the room placement 
  expert system.</P>
<DIR> 
  <DIR> 
    <P><B>rule f3#<BR>
      [couch - C with [position-wall/W], <BR>
      wall - W with [opposite-OW], <BR>
      tv - TV with [position-none, place_on-floor]]<BR>
      ==&gt;<BR>
      [update(tv - TV with [position-wall/OW])].</B></P>
    <P><B>rule f4#<BR>
      [couch - C with [position-wall/W], <BR>
      wall - W with [opposite-OW], <BR>
      tv - TV with [position-none, place_on-table], <BR>
      end_table - T with [position-none]]<BR>
      ==&gt;<BR>
      [update(end_table - T with [position-wall/OW]), <BR>
      update(tv - TV with [position-end_table/T])].</B></P>
  </DIR>
</DIR>
<P>First 
  let's define some terms. Each LHS is composed of one or more frame patterns. 
  An example of a frame pattern is:</P>
<DIR> 
  <DIR> 
    <P><B>tv-TV with 
      [position-none, place_on-table]</B></P>
  </DIR>
</DIR>
<P>The 
  frame pattern will be the basic unit of indexing in the simplified Rete match 
  algorithm. In a full implementation, indexing is carried down to the individual 
  attribute-value pairs within the frame pattern, such as <B>place_on-table</B>.</P>
<P>The 
  match algorithm used in the first implementation of Foops takes every rule and 
  compares it to all the frame instances on each cycle. In particular, both of 
  the example rules above would be compared against working storage on each cycle. 
  Not only is redundant matching being done on each cycle, within each cycle the 
  same frame patterns are being matched twice, once for each rule. Since working 
  memory generally has few changes on each cycle, and since many of the rules 
  have redundant patterns, this approach is very inefficient.</P>
<P>With 
  the Rete algorithm, the status of the match information from one cycle is remembered 
  for the next. The indexing allows the algorithm to update only that match information 
  which is changed due to working memory changes.</P>
<P>The 
  rules are compiled into a network structure where the nodes correspond to the 
  frame patterns in the LHS of the rules. There are three basic types of node 
  which serve as: the entry to the network; the internals of the network; and 
  the exit from the network. These are called root nodes, two-input nodes, and 
  rule nodes respectively.</P>
<P><IMG SRC="performance8-1.gif" WIDTH=436 HEIGHT=679></P>
<P>Figure 
  8.1. The nodes of the Rete network for two sample rules</P>
<P> 
 
<P> </P>
 
<P>The 
  network has links which run from single frame patterns in the root nodes, through 
  the two-input nodes, to full LHS patterns in the rule nodes. Figure 8.1 shows 
  the nodes and links generated from the two sample rules.</P>
<h2 ALIGN="JUSTIFY"><B><a name="networknodes"></a> 
  Network Nodes</B></h2>
<P>The 
  root nodes serve as entry points to the Rete network. They are the simplest 
  patterns recognized by the network, in this case the frame patterns that appear 
  in the various rules. A frame pattern only appears once in a root node even 
  if it is referenced in multiple rules. Each root node has pointers to two-input 
  nodes which are used to combine the patterns into full LHS patterns.</P>
<P>Two-input 
  nodes represent partially completed LHS patterns. The left input has a pattern 
  which has one or more frame patterns as they appear in one or more rules. The 
  right input has a single frame pattern, which when appended to the left input 
  pattern completes more of a full LHS pattern. The two-input node is linked to 
  other two-input or rule nodes whose left input matches the larger pattern. </P>
<P>The 
  rule nodes are the exit points of the Rete network. They have full LHS patterns 
  and RHS patterns.</P>
<h2 ALIGN="JUSTIFY"><B><a name="networkpropogation"></a>Network 
  Propagation</B></h2>
<P>Associated 
  with each two-input node, are copies of working storage elements which have 
  already matched either side of the node. These are called the left and right 
  memories of the node. In effect, this means working memory is stored in the 
  network itself.</P>
<P>Whenever 
  a frame instance is added, deleted, or updated it is converted to a "token". 
  A token is formed by comparing the frame instance to the root patterns. A root 
  pattern which is unified with the frame instance is a token. The token has an 
  additional element which indicates whether it is to be added to or deleted from 
  the network.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="performance8-2.gif" WIDTH=407 HEIGHT=629><BR>
  </P>
<P>Figure 
  8.2. The relationship between frame patterns, instances, tokens, and nodes</P>
<P>The 
  token is sent from the root node to its successor nodes. If the token matches 
  a left or right pattern of a two-input successor node, it is added (or deleted) 
  from the the appropriate memory for that node. The token is then combined with 
  each token from the memory on the other side (right or left) and compared with 
  the pattern formed by combining the left and right patterns of the two input 
  node. If there is a match, the new combined token is sent to the successor nodes. 
  This process continues until either a rule is instantiated or there are no more 
  matches.</P>
<P>Figure 
  8.2 shows the relationships between rules, frame patterns, frame instances, 
  nodes, and tokens. It shows the top portion of the network as shown in Figure 
  8.1. It assumes that couch-1 with [position-wall/north] already exists in the 
  left memory of two-input node #1. Then the frame instance wall-north with [opposite-south, 
  left-west, right-east] is added, causing the generation of the token wall-north 
  with [opposite-south]. The token updates the right memory of node #1 as shown, 
  and causes a new token to be generated which is sent to node #2, causing an 
  update to its left memory.</P>
<h2 ALIGN="JUSTIFY"><B><a name="exampleofnetworkpropagation"></a>Example 
  of Network Propagation</B></h2>
<P>Lets 
  trace what happens in the network during selected phases of a run of the room 
  configuration system.</P>
<P>First 
  the walls are placed during initialization. There are four wall frame instances 
  asserted which define opposites and are therefor recognized by the portion of 
  the system we are looking at. They are used to build add-tokens which are sent 
  to the network.</P>
<DIR> 
  <DIR> 
    <P><B>wall-north 
      with [opposite-south].</B></P>
    <P><B>wall-south 
      with [opposite-north].</B></P>
    <P><B>wall-east 
      with [opposite-west].</B></P>
    <P><B>wall-west 
      with [opposite-east].</B></P>
  </DIR>
</DIR>
<P>Each 
  of these tokens matches the following root pattern, binding <B>OW</B> to the 
  various directions:</P>
<DIR> 
  <DIR> 
    <P><B>wall-W with 
      [opposite-OW].</B></P>
  </DIR>
</DIR>
<P ALIGN="CENTER"><BR>
  <IMG SRC="performance8-3.gif" WIDTH=415 HEIGHT=452><BR>
  </P>
<P>Figure 
  8.3. The sample network after initialization</P>
<P> 
 
<P> </P>
 
<P>Therefore, 
  each token is passed on to the right side of two-input node #1 as indicated 
  by the list of links associated with that root pattern. Each of these terms 
  is stored in the right memory of node #1. Since there is nothing in the left 
  memory of node #1, network processing stops until the next input is received.</P>
<P>Next, 
  the furniture is initialized, with the couch, tv, and end_table placed with 
  <B>position-none</B>. They will be internally numbered 1, 2, and 3. Since the 
  root pattern for couch in the segment we are looking at has a <B>position-wall/W</B>, 
  the couch does not show up in it at this time. However, node #2 and node #4 
  have their right memories updated respectively with the tokens:</P>
<DIR> 
  <DIR> 
    <P><B>tv-2 with 
      [position-none, place_on-floor].</B></P>
    <P><B>end_table-3 
      with [position-none].</B></P>
  </DIR>
</DIR>
<P>At 
  this point the system looks like figure 8.3. The shaded boxes correspond to 
  the two-input nodes of figure 8.1.</P>
<P>After 
  initialization, the system starts to fire rules. One of the early rules in the 
  system will lead to the placing of the couch against a wall, for example the 
  north wall. This update will cause the removal of the token <B>couch-1 with 
  [position-none]</B> from parts of the network not shown in the diagrams, and 
  the addition of the token <B>couch-1 with [position-wall/north]</B> to the left 
  memory of node #1 as shown in figure 8.4. This causes a cascading update of 
  various left memories as shown in the rest of figure 8.4 and described below.</P>
<P>Node 
  #1 now has both left and right memories filled in, so the system tries to combine 
  the one new memory term with the four right memory terms. There is one successful 
  combination with the <B>wall-north</B> token, so a new token is built from the 
  two and passed to the two successor nodes of node #1. The new token is:</P>
<DIR> 
  <DIR> 
    <P><B>[couch-1 with 
      [position-wall/north], </B></P>
    <P><B>wall-north 
      with [opposite-south] ]</B></P>
  </DIR>
</DIR>
<P>This 
  token is stored in the left memories of both successors, node #2 and node #3. 
  There is no right memory in node #3, so nothing more happens there, but there 
  is right memory in node #2 which does match the input token. Therefor a new 
  token is constructed and sent to the successor of node #2. The new token is:</P>
<DIR> 
  <DIR> 
    <P><B>[couch-1 with 
      [position-wall/north], </B></P>
    <P><B>wall-north 
      with [opposite-south], </B></P>
    <P><B>tv-2 with 
      [position-none, place_on-floor] ]</B></P>
  </DIR>
</DIR>
<P>The 
  token is sent to the successor which is rule #f3. The token is the binding of 
  the left side of the rule, and leads to variable bindings on the right side 
  of the rule. This is a full instantiation of the rule and is added to the conflict 
  set. When the rule is fired, the action on the right side causes the position 
  of the tv to be updated.</P>
<DIR> 
  <DIR> 
    <P><B>update ( tv-2 
      with [position-wall/south] )</B></P>
  </DIR>
</DIR>
<P><IMG SRC="performance8-4.gif" WIDTH=436 HEIGHT=663></P>
<P>Figure 
  8.4. The cascading effect of positioning the couch</P>
<P> 
 
<P> </P>
 
<P>This 
  update causes two tokens to be sent through the network. One is a delete token 
  for <B>tv-2 with [position-none]</B>, and the other is an add token for <B>tv-2 
  with [position-wall/south]</B>. The delete causes the removal of the token from 
  the right memory of node#2. The add would not match any patterns in this segment 
  of the network.</P>
<h2 ALIGN="JUSTIFY"><B><a name="performanceimprovements"></a>Performance 
  Improvements</B></h2>
<P>The 
  Rete network provides a number of performance improvements over a simple matching 
  of rules to working memory:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;The 
      root nodes act as indices into the network. Only those nodes which are affected 
      by an update to working memory are processed.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      patterns which have been successfully matched are saved in the node left 
      and right memories. They do not have to be reprocessed.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;When 
      rules share common sequences of patterns, that information is stored only 
      once in the network, meaning it only has to be processed once.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      output of the network is full rule instantiations. Once an instantiation 
      is removed from the conflict set (due to a rule firing) it will not reappear 
      on the conflict set, thus preventing multiple firings of the rule.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Next, 
  let's look at the code to build a Rete pattern matcher. First we will look at 
  the data structures used to define the Rete network, then the pattern matcher 
  which propagates tokens through the network, and finally the rule compiler which 
  builds the network from the rules.</P>
<h1><B> <a name="theretegraphdatastructures"></a>8.3 
  The Rete Graph Data Structures </B></h1>
<P>The 
  roots of the network are based on the frame patterns from the rules. The root 
  nodes are represented as:</P>
<DIR> 
  <DIR> 
    <P><B>root(NID, 
      Pattern, NextList).</B></P>
  </DIR>
</DIR>
<P><B>NID</b> 
  is a generated identification for the node, <B>Pattern</B> is the frame pattern, 
  and <B>NextList</B> is the list of succesor nodes which use the <B>Pattern</B>. 
  <B>NextList</B> serves as the pointers connecting the network together.</P>
<P>For 
  example:</P>
<DIR> 
  <DIR> 
    <P><B>root(2, wall-W 
      with [opposite-OW], [1-r]).</B></P>
  </DIR>
</DIR>
<P>The 
  two-input nodes of the network have terms representing the patterns which are 
  matched from the left and right inputs to the node. Together they form the template 
  which determines if particular tokens will be successfully combined into rule 
  instantiations. The format of this structure is:</P>
<DIR> 
  <DIR> 
    <P><B>bi(NID, LeftPattern, 
      RightPattern, NextList).</B></P>
  </DIR>
</DIR>
<P ALIGN="CENTER"><BR>
  <IMG SRC="performance8-5.gif" WIDTH=344 HEIGHT=272><BR>
  </P>
<P>Figure 
  8.5 Major predicates which propagate a token through the network</P>
<B></B> 
<P> <B>NID</b> 
  again is an identification. <B>LeftPattern</B> is the list of frame patterns 
  that have been matched in nodes previous to this one. <B>RightPattern</B> is 
  the new frame pattern which will be appended to the <B>LeftPattern</B>. <B>NextList</B> 
  contains a list of successor nodes.</P>
<P>For 
  example:</P>
<DIR> 
  <DIR> 
    <P><B>bi(1, [couch-C 
      with [position-wall/W]], <BR>
      [wall-W with [opposite-OW], <BR>
      [2-l, 3-l]).</B></P>
    <P><B>bi(2, [couch-C 
      with [position-wall/W], <BR>
      &#9;wall-W with [opposite-OW]], <BR>
      [tv-TV with [position-none, place_on-floor]], <BR>
      [rule(f3)]).</B></P>
  </DIR>
</DIR>
<P>The 
  end of the network is rules. The rules are stored as:</P>
<DIR> 
  <DIR> 
    <P><B>rul(N, LHS, 
      RHS).</B></P>
  </DIR>
</DIR>
<P><B>N</b> 
  is the identification of the rule. <B>LHS</B> is the list of frame patterns 
  which represent the full left hand side of the rule. <B>RHS</B> is the actions 
  to be taken when the rule is instantiated.</P>
<h1><B> <a name="propagatingtokens"></a>8.4 
  Propagating Tokens </B></h1>
<P>Tokens 
  are generated from the updates to frame instances. There are only two update 
  predicates for the network, <B>addrete</B> which adds tokens, and <B>delrete</B> 
  which deletes them. Both take as input the <B>Class</B>, <B>Name</B>, and <B>TimeStamp</B> 
  of the frame instance. Both are called from the Foops predicates which update 
  working memory: <B>assert_ws</B>, <B>retract_ws</B>, and <B>update_ws</B>. The 
  major predicates of <B>addrete</B> are shown in figure 8.5.</P>
<P> 
 
<P> </P>
 
<P> 
 
<P>The 
  <B>addrete</B> predicate uses a simple repeat - fail loop to match the frame 
  instance against each of the root nodes. It looks like:</P>

<DIR> 
  <DIR> 
    <P><B>addrete(Class, 
      Name, TimeStamp) :-<BR>
      root(ID, Class-Name with ReqList, NextList), <BR>
      ffsend(Class, Name, ReqList, TimeStamp, NextList), <BR>
      fail.</B></P>
    <P><B>addrete(_, 
      _, _).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>ffsend</B> predicate fullfills the request pattern in the <B>root</B> by 
  a call to the frame system predicate, <B>getf</B>. This fills in the values 
  for the pattern thus creating a token. Next, <B>send</B> is called with an add 
  token.</P>
<DIR> 
  <DIR> 
    <P><B>ffsend(Class, 
      Name, ReqList, TimeStamp, NextList) :-<BR>
      getf(Class, Name, ReqList), <BR>
      send(tok(add, [(Class-Name with ReqList)/TimeStamp]), &#9;NextList), <BR>
      !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>delrete</B> predicate is analagous, the only difference being it <B>send</B>s 
  a delete token through the network.</P>
<DIR> 
  <DIR> 
    <P><B>delrete(Class, 
      Name, TimeStamp) :-<BR>
      root(ID, Class-Name with ReqList, NextList), <BR>
      delr(Class, Name, ReqList, TimeStamp), <BR>
      fail.</B></P>
    <P><B>delrete(_, 
      _, _).</B></P>
    <P><B>delr(Class, 
      Name, ReqList, TimeStamp) :-<BR>
      getf(Class, Name, ReqList), <BR>
      !, send(tok(del, [(Class-Name with ReqList)/TimeStamp]), NextList).</B></P>
    <P><B>delr(Class, 
      Name, ReqList, TimeStamp).</B></P>
  </DIR>
</DIR>
<P>Predicate 
  <B>send</B> passes the token to each of the successor nodes in the list:</P>
<DIR> 
  <DIR> 
    <P><B>send(_, []).</B></P>
    <P><B>send(Token, 
      [Node|Rest]) :-<BR>
      sen(Node, Token), <BR>
      send(Token, Rest).</B></P>
  </DIR>
</DIR>
<P>The 
  real work is done by <B>sen</B>. It has to recognize three cases:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;The 
      token is being sent to a rule. In this case, the rule must be added to or 
      deleted from the conflict set.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      token is being sent to the left side of a two-input node. In this case, 
      the token is added to or deleted from the left memory of the node. The list 
      is then matched against the right memory elements to see if a larger token 
      can be built and passed through the network.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      token is being sent to the right side of a node. In this case, the token 
      is added to or deleted from the right memory of the node. It is then compared 
      against the left memory elements to see if a larger token can be built and 
      passed through the network.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>In 
  Prolog:</P>
<DIR> 
  <DIR> 
    <P><B>sen(rule-N, 
      tok(AD, Token)) :-<BR>
      rul(N, Token, Actions), <BR>
      (AD = add, add_conflict_set(N, Token, Actions);<BR>
      AD = del, del_conflict_set(N, Token, Actions)), <BR>
      !.</B></P>
    <P><B>sen(Node-l, 
      tok(AD, Token)) :-<BR>
      bi(Node, Token, Right, NextList), <BR>
      (AD = add, asserta( memory(Node-l, Token) );<BR>
      AD = del, retract( memory(Node-l, Token) )), <BR>
      !, matchRight(Node, AD, Token, Right, NextList).</B></P>
    <P><B>sen(Node-r, 
      tok(AD, Token)) :-<BR>
      bi(Node, Left, Token, NextList), <BR>
      (AD = add, asserta( memory(Node-r, Token) );<BR>
      AD = del, retract( memory(Node-r, Token) )), <BR>
      !, matchLeft(Node, AD, Token, Left, NextList).</B></P>
  </DIR>
</DIR>
<P>Note 
  how Prolog's unification automatically takes care of variable bindings between 
  the patterns in the node memory, and the instance in the token. In <B>sen</B>, 
  the instance in <B>Token</B> is unified with one of the right or left patterns 
  in <B>bi</B>, automatically causing the opposite pattern to become instantiated 
  as well (or else the call to <B>bi</B> fails and the next <B>bi</B> is tried). 
  This instantiated <B>Right</B> or <B>Left</B> is then sent to <B>matchRight</B> 
  or <B>matchLeft</B> respectively.</P>
<P>Both 
  <B>matchRight</B> and <B>matchLeft</B> take the instantiated <B>Right</B> or 
  <B>Left</B> and compare it with the tokens stored in the right or left working 
  memory associated with that node. If unification is successful, a new token 
  is built by appending the right or left from the memory with the original token. 
  The new token is then passed further with another call to <B>send</B>.</P>
<DIR> 
  <DIR> 
    <P><B>matchRight(Node, 
      AD, Token, Right, NextList) :-<BR>
      memory(Node-r, Right), <BR>
      append(Token, Right, NewTok), <BR>
      send(tok(AD, NewTok), NextList), <BR>
      fail.</B></P>
    <P><B>matchRight(_, 
      _, _, _, _).<BR>
      </B></P>
    <P><B>matchLeft(Node, 
      AD, Token, Left, NextList) :-<BR>
      memory(Node-l, Left), <BR>
      append(Left, Token, NewTok), <BR>
      send(tok(AD, NewTok), NextList), <BR>
      fail.</B></P>
    <P><B>matchLeft(_, 
      _, _, _, _).</B></P>
  </DIR>
</DIR>
<P>Another 
  type of node which is useful for the system handles the cases where the condition 
  on the LHS of the rule is a test such as <B>L &gt; R</B>, or <B>member(X, Y)</B>, 
  rather than a pattern to be matched against working memory. The test nodes just 
  perform the test and pass the tokens through if they succeed. There is no memory 
  associated with them.</P>
<P>A 
  final node to make the system more useful is one to handle negated patterns 
  in rules. It works as a normal node, keeping instances in its memory which match 
  the pattern in the rule, however it only passes on tokens which do not match.</P>
<h1><B> <a name="therulecompiler"></a>8.5 
  The Rule Compiler </B></h1>
<P>The 
  rule compiler builds the Rete network from the rules. The compiler predicates 
  are not as straight forward as the predicates which propagate tokens through 
  the network. This is one of the rare cases where the power of Prolog's pattern 
  matching actually gets in the way, and code needs to be written to overcome 
  it.</P>
<P>The 
  very unification which makes the pattern matching propagation predicates easy 
  to code gets in the way of the rule compiler. We allow variables in the rules, 
  which behave as normal Prolog variables, but when the network is built, we need 
  to know which rules are matching variables and which are matching atoms. For 
  example, one rule might have the pattern <B>wall/W</B> and another might have 
  <B>wall/east</B>. These should generate two different indices when building 
  the network, but Prolog would not distinguish between them since they unify 
  with each other.</P>
<P>In 
  order to distinguish between the variables and atoms in the frame patterns, 
  we must pick the pattern apart first, binding the variables to special atoms 
  as we go. Once all of the variables have been instantiated in this fashion, 
  the patterns can be compared.</P>
<P>But 
  first, let's look at the bigger picture. Each rule is compared, frame pattern 
  by frame pattern, against the network which has been developed from the rules 
  previously processed. The frame patterns of the rule are sent through the network 
  in a similar fashion to the propagation of tokens. If the frame patterns in 
  the rule are accounted for in the network, nothing is done. If a pattern is 
  not in the network, then the network is updated to include it.</P>
<P> 
 
<P> </P>
 
<P> 
 
<P>The 
  top level predicate for compiling rules into a Rete net, reads each rule and 
  compiles it. The major predicates involved in compiling rules into a Rete network 
  are shown in figure 8.6.</P>

<DIR> 
  <DIR> 
    <P><B>rete_compil 
      :-<BR>
      rule N# LHS ==&gt; RHS, <BR>
      rete_comp(N, LHS, RHS), <BR>
      fail.</B></P>
    <P><B>rete_compil.</B></P>
  </DIR>
</DIR>
<P ALIGN="CENTER"><BR>
  <IMG SRC="performance8-6.gif" WIDTH=400 HEIGHT=183><BR>
  </P>
<P>Figure 
  8.6 The major predicates for compiling rules into a Rete network</P>
<P> 
 
<P> </P>
 
<P>The 
  next predicate, <B>rete_comp</B>, looks at the first frame pattern in the rule 
  and determines if it should build a new root node or if one already exists. 
  It then passes the information from the root node and the rest of the rule left 
  hand side to <B>retcom</B> which continues traversing and/or building the network.</P>
<DIR> 
  <DIR> 
    <P><B>rete_comp(N, 
      [H|T], RHS) :-<BR>
      term(H, Hw), <BR>
      check_root(RN, Hw, HList), <BR>
      retcom(root(RN), [Hw/_], HList, T, N, RHS), <BR>
      !.</B></P>
    <P><B>rete_comp(N, 
      _, _) .</B></P>
  </DIR>
</DIR>
<P>The 
  <B>term</B> predicate merely checks for shorthand terms of the form <B>Class-Name</B> 
  and replaces them with the full form <B>Class-Name with []</B>. Terms already 
  in full form are left unchanged.</P>
<DIR> 
  <DIR> 
    <P><B>term(Class-Name, 
      Class-Name with []).</B></P>
    <P><B>term(Class-Name 
      with List, Class-Name with List).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>check_root</B> predicate determines if there is already a root node for the 
  term, and if not creates one. It will be described in detail a little later. 
  The third argument from <B>check_root</B> is the current list of nodes linked 
  to this root.</P>
<P>The 
  last goal is to call <B>retcom</B>, which is the main recursive predicate of 
  the compilation process. It has six arguments, as follows:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>PNID</b> 
      &#9;the id of the previous node</P>
    <P> 
     
    <P> </P>
     
    <P><B>OutPat</b> 
      &#9;pattern from previous node</P>
    <P> 
     
    <P> </P>
     
    <P><B>PrevList</b> 
      &#9;successor list from previous node </P>
    <P> 
     
    <P> </P>
     
    <P><B>[H|T]</b> 
      &#9;list of remaining frame patterns in rule</P>
    <P> 
     
    <P> </P>
     
    <P><B>N</b> 
      &#9;&#9;&#9;rule ID, for building the rule at the end</P>
    <P> 
     
    <P> </P>
     
    <P><B>RHS</b> 
      &#9;RHS of the rule, for building the rule at the end</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>There 
  are two cases recognized by <B>retcom</B>:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;All 
      of the frame patterns in the rule have been compiled into the network, and 
      all that is left is to link the full form of the rule to the network.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      rule frame patterns processed so far match an existing two-input node, or 
      a new one is created. </P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>In 
  Prolog, the first case is recognized by having the empty list as the list of 
  remaining frame patterns. The rule is built, and <B>update_node</B> is called 
  to link the previous node to the rule.</P>
<DIR> 
  <DIR> 
    <P><B>retcom(PNID, 
      OutPat, PrevList, [], N, RHS) :-<BR>
      build_rule(OutPat, PrevList, N, RHS), <BR>
      update_node(PNID, PrevList, rule-N), <BR>
      !.</B></P>
  </DIR>
</DIR>
<P>In 
  the second case, the frame pattern being worked on (<B>H</B>) is first checked 
  to see if it has a root node. Then the network is checked to see if a two-input 
  node exists whose left input pattern matches the rule patterns processed so 
  far (<B>PrevNode</B>). Either node might have been found or added, and then 
  linked to the rest of the network.</P>
<DIR> 
  <DIR> 
    <P><B>retcom(PNID, 
      PrevNode, PrevList, [H|T], N, RHS) :-<BR>
      term(H, Hw), <BR>
      check_root(RN, Hw, HList), <BR>
      check_node(PrevNode, PrevList, [Hw/_], HList, NID, OutPat, NList), <BR>
      update_node(PNID, PrevList, NID-l), <BR>
      update_root(RN, HList, NID-r), <BR>
      !, <BR>
      retcom(NID, OutPat, NList, T, N, RHS).</B></P>
  </DIR>
</DIR>
<P>Building 
  rules is simply accomplished by writing a new rule structure:</P>
<DIR> 
  <DIR> 
    <P><B>build_rule(OutPat, 
      PrevList, N, RHS) :-<BR>
      assertz( rul(N, OutPat, RHS) ).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>check_root</B> predicate is the first one that must deal with the pattern 
  matching problem mentioned earlier. It covers three cases:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;There 
      is no existing root which matches the term using Prolog's pattern matching. 
      In this case a new root is added.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;There 
      is an existing root which matches the term, atom for atom, variable for 
      variable. In this case no new root is needed.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;There 
      is no precise match and a new root is created.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>In 
  Prolog:</P>
<DIR> 
  <DIR> 
    <P><B>check_root(NID, 
      Pattern, []) :-<BR>
      not(root(_, Pattern, _)), <BR>
      gen_nid(NID), <BR>
      assertz( root(NID, Pattern, []) ), !.</B></P>
    <P><B>check_root(N, 
      Pattern, List) :-<BR>
      asserta(temp(Pattern)), <BR>
      retract(temp(T1)), <BR>
      root(N, Pattern, List), <BR>
      root(N, T2, _), <BR>
      comp_devar(T1, T2), !.</B></P>
    <P><B>check_root(NID, 
      Pattern, []) :-<BR>
      gen_nid(NID), <BR>
      assertz( root(NID, Pattern, []) ).</B></P>
  </DIR>
</DIR>
<P>The 
  first clause is straight forward. The <B>gen_nid</B> predicate is used to generate 
  unique numbers for identifying nodes in the Rete network.</P>
<P>The 
  second clause is the difficult one. The first problem is to make a copy of <B>Pattern</B> 
  which Prolog will not unify with the original term. The easiest way is to assert 
  the term and then retract it using a different variable name, as the first two 
  goals of the second clause do. We now have both <B>Pattern</B> and <B>T1</B> 
  as identical terms, but Prolog doesn't know they are the same and will not bind 
  the variables in one when they are bound in the other.</P>
<P>We 
  can now use <B>Pattern</B> to find the root which matches it, using Prolog's 
  match. Again, not wishing to unify the variables, we call the root again using 
  just the root identification. This gives us <B>T2</B>, the exact pattern in 
  the root before unification with <B>Pattern</B>.</P>
<P>Now 
  we have <B>T1</B> and <B>T2</B>, two terms which we know will unify in Prolog. 
  The problem is to see if they are also identical in their placement of variables. 
  For this we call <B>comp_devar</B> which compares two terms after unifying all 
  of the variables with generated strings.</P>
<P>A 
  very similar procedure is used for <B>check_node</B>. It is a little more complex 
  in that it needs to build and return the tokens that are the two inputs to a 
  node. The arguments to <B>check_node</B> are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>PNode</b> 
      &#9;token list from previous node</P>
    <P> 
     
    <P> </P>
     
    <P><B>PList</b> 
      &#9;list of successor nodes from previous node</P>
    <P> 
     
    <P> </P>
     
    <P><B>H</b> 
      &#9;&#9;&#9;new token being added</P>
    <P> 
     
    <P> </P>
     
    <P><B>HList</b> 
      &#9;successor nodes from root for token H</P>
    <P> 
     
    <P> </P>
     
    <P><B>NID</b> 
      &#9;returned ID of the node</P>
    <P> 
     
    <P> </P>
     
    <P><B>OutPat</b> 
      &#9;returned tokenlist from the node</P>
    <P> 
     
    <P> </P>
     
    <P><B>NList</b> 
      &#9;returned list of successor nodes from the node</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  clauses for <B>check_node</B> are:</P>
<DIR> 
  <DIR> 
    <P><B>check_node(PNode, 
      PList, H, HList, NID, OutPat, []) :-<BR>
      not (bi(_, PNode, H, _)), <BR>
      append(PNode, H, OutPat), <BR>
      gen_nid(NID), <BR>
      assertz( bi(NID, PNode, H, []) ), <BR>
      !.</B></P>
    <P><B>check_node(PNode, 
      PList, H, HList, NID, OutPat, NList) :-<BR>
      append(PNode, H, OutPat), <BR>
      asserta(temp(OutPat)), <BR>
      retract(temp(Tot1)), <BR>
      bi(NID, PNode, H, NList), <BR>
      bi(NID, T2, T3, _), <BR>
      append(T2, T3, Tot2), <BR>
      comp_devar(Tot1, Tot2), </B></P>
    <P><B>check_node(PNode, 
      PList, H, HList, NID, OutPat, []) :-<BR>
      append(PNode, H, OutPat), <BR>
      gen_nid(NID), <BR>
      assertz( bi(NID, PNode, H, []) ).</B></P>
  </DIR>
</DIR>
<P>The 
  update predicates check to see if the new node is on the list of links from 
  the old node. If so, nothing is done. Otherwise a new link is added by putting 
  the new node id on the list.</P>
<DIR> 
  <DIR> 
    <P><B>update_root(RN, 
      HList, NID) :-<BR>
      member(NID, HList), !.</B></P>
    <P><B>update_root(RN, 
      HList, NID) :-<BR>
      retract( root(RN, H, HList) ), <BR>
      asserta( root(RN, H, [NID|HList]) ).</B></P>
    <P><B>update_node(root(RN), 
      HList, NID) :-<BR>
      update_root(RN, HList, NID), !.</B></P>
    <P><B>update_node(X, 
      PrevList, NID) :-<BR>
      member(NID, PrevList), !.</B></P>
    <P><B>update_node(PNID, 
      PrevList, NID) :-<BR>
      retract( bi(PNID, L, R, _) ), <BR>
      asserta( bi(PNID, L, R, [NID|PrevList]) ).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>comp_devar</B> predicate takes each term it is comparing, and binds all the 
  variables to generated terms.</P>
<DIR> 
  <DIR> 
    <P><B>comp_devar(T1, 
      T2) :-<BR>
      del_variables(T1), <BR>
      del_variables(T2), <BR>
      T1=T2.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>del_variables</B> predicate is used to bind the variables. The function which 
  generates atoms to replace the variables is initialized the same way each time 
  it is called, so if <B>T1</B> and <B>T2</B> have the same pattern of variables, 
  they will be replaced with the same generated atoms and the terms will be identical.</P>
<DIR> 
  <DIR> 
    <P><B>del_variables(T) 
      :-<BR>
      init_vargen, <BR>
      de_vari(T).</B></P>
  </DIR>
</DIR>
<P>The 
  basic strategy is to recognize the various types of structures and break them 
  into smaller components. When a component is identified as a variable, it is 
  unified with a generated atom.</P>
<P>First, 
  <B>de_vari</B> looks at the case where the terms are lists. This is used for 
  comparing token lists in <B>check_node</B>. It is a standard recursive predicate 
  which removes the variables from the head of the list, and recursively calls 
  itself with the tail. Note that unification will cause all occurances of a variable 
  in the head of the list to be bound to the same generated atom. The third clause 
  covers the case where the term was not a list.</P>
<DIR> 
  <DIR> 
    <P><B>de_vari([]).</B></P>
    <P><B>de_vari([H|T]) 
      :-<BR>
      de_var(H), <BR>
      de_vari(T).</B></P>
    <P><B>de_vari(X) 
      :- de_var(X).</B></P>
  </DIR>
</DIR>
<P>The 
  first clause of <B>de_var</B> removes the time stamps from consideration. The 
  next two clauses recognize the full frame pattern structure, and the attribute-value 
  pair structure respectively.</P>
<DIR> 
  <DIR> 
    <P><B>de_var(X/_) 
      :- de_var(X).</B></P>
    <P><B>de_var(X-Y 
      with List) :-<BR>
      de_v(X-Y), <BR>
      de_vl(List), !.</B></P>
    <P><B>de_var(X-Y) 
      :-<BR>
      de_v(X-Y), !.</B></P>
  </DIR>
</DIR>
<P>The 
  next predicates continue to break the structures apart until finally <B>d_v</B> 
  is given an elementary term as an argument. If the term is a variable, an atom 
  is generated to replace it. Otherwise the term is left alone. Due to Prolog's 
  unification, once one instance of a variable is unified to a generated term, 
  all other instances of that variable are automatically unified to the same generated 
  term. Thus, the generated atoms follow the same pattern as the variables in 
  the full term.</P>
<DIR> 
  <DIR> 
    <P><B>de_vl([]).</B></P>
    <P><B>de_vl([H|T]) 
      :-<BR>
      de_v(H), <BR>
      de_vl(T).</B></P>
    <P><B>de_v(X-Y) 
      :-<BR>
      d_v(X), <BR>
      d_v(Y).</B></P>
    <P><B>d_v(V) :-<BR>
      var(V), <BR>
      var_gen(V), !.</B></P>
    <P><B>d_v(_).</B></P>
  </DIR>
</DIR>
<P>The 
  next two predicates are used to generate the variable replacements. They are 
  of the form <B>'#VAR_N'</B>, where N is a generated integer. In this case two 
  built-in predicates of AAIS Prolog are used to convert the integer to a string 
  and concatenate it to the rest of the form of the variable. The same effect 
  could be achieved with the standard built-in, <B>name</B>, and a list of ASCII 
  characters representing the string.</P>
<DIR> 
  <DIR> 
    <P><B>init_vargen 
      :-<BR>
      abolish(varg, 1), <BR>
      asserta(varg(1)).<BR>
      </B></P>
    <P><B>var_gen(V) 
      :-<BR>
      retract(varg(N)), <BR>
      NN is N+1, <BR>
      asserta(varg(NN)), <BR>
      int2string(N, NS), <BR>
      stringconcat("#VAR_", NS, X), <BR>
      name(V, X).</B></P>
  </DIR>
</DIR>
<P>The 
  system only handles simple rules so far, and does not take into account either 
  negations or terms which are tests, such as comparing variables or other Prolog 
  predicate calls.</P>
<P>Nodes 
  to cover tests are easily added. They are very similar to the normal two-input 
  nodes, but do not have memory associated with them. The left side is a token 
  list just as in the two-input nodes. The right side has the test pattern. If 
  a token passes the test, a new token with the test added is passed through the 
  network.</P>
<P>The 
  negated patterns store a count with each pattern in the left memory. That count 
  reflects the number of right memory terms which match the left memory term. 
  Only when the count is zero, is a token allowed to pass through the node.</P>
<h1><B> <a name="integrationwithfoops"></a>8.6 
  Integration with Foops </B></h1>
<P>Only 
  a few changes have to be to Foops to incorporate the Rete network developed 
  here.</P>
<P>A 
  compile command is added to the main menu that builds the Rete network. It is 
  called after the load command.</P>
<P>The 
  commands to update working memory are modified to propagate tokens through the 
  Rete network. This means calls to <B>addrete</B> and <B>delrete</B> as appropriate.</P>
<P>The 
  refraction logic, which ensured the same instantiation would not be fired twice, 
  is removed since it is no longer necessary.</P>
<P>The 
  predicate which builds the conflict set is removed since the conflict set is 
  maintained by the predicates which process the network. The predicates which 
  sort the conflict set are still used to select a rule to fire.</P>
<h1><B> <a name="designtradeoffs"></a>8.7 
  Design Tradeoffs </B></h1>
<P>There 
  are a number of design tradeoffs made in this version. The first is the classic 
  space versus speed tradeoff. At each Rete memory, a full copy of each token 
  is saved. This allows it to be retrieved and matched quickly during execution. 
  Much space could be saved by only storing pointers to the working memory elements. 
  These would have to be retrieved and the token reconstructed when needed.</P>
<P>The 
  other tradeoff is with the flexibility of the frame system. With the frames 
  in the original Foops, the frame patterns in the rules could take advantage 
  of inheritance and general classes as in the rules which determined a need for 
  electrical plugs in a room. Since Rete-Foops instantiates the patterns before 
  propagating tokens through the network, this does not work. This feature could 
  be incorporated but would add to the burden and complexity of maintaining the 
  network.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>8.1 
  - Implement nodes which support rules which have tests such as X &gt; Y, and 
  negated frame patterns.</P>
<P> 
 
<P> </P>
 
<P>8.2 
  - The implementation described in this chapter makes heavy use of memory by 
  storing the full tokens in left and right memories. Build a new system in which 
  space is saved by storing a single copy of the token and having pointers to 
  it in left and right memory. The stored tokens just match single frame patterns. 
  The complex tokens in the middle of the network contain lists of pointers to 
  the simple tokens.</P>
<P> 
 
<P> </P>
 
<P>8.3 
  - Experiment with various size systems to see the performance gains of the Rete 
  version of Foops.</P>
<P> 
 
<P> </P>
 
<P>8.4 
  - Figure out a way to allow Rete-Foops to use inheritance in frame patterns. 
  That is, fix it so the rule which finds electric plugs works.</P>
<P> 
 
<P> </P>
 
<P>8.5 - Build an indexed 
  version of Clam and make performance experiments with it.</P>


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
