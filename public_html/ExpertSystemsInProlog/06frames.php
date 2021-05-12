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
<td><h1>6 Frames</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>Up 
  until this point in the book, we have worked with data structures that are simply 
  that, data structures. It is often times desirable to add some "intelligence" 
  to the data structures, such as default values, calculated values, and relationships 
  between data.</P>
<P>Of 
  the various schemes which evolved over the years, the <B>frame</B> based approach 
  has been one of the more popular. Information about an object in the system 
  is stored in a frame. The frame has multiple slots used to define the various 
  attributes of the object. The slots can have multiple facets for holding the 
  value for the attributes, or defaults, or procedures which are called to calculate 
  the value.</P>
<P>The 
  various frames are linked together in a hierarchy with a-kind-of (ako) links 
  that allow for inheritance. For example, rabbits and hamsters might be stored 
  in frames that have ako(mammal). In the frame for mammal are all of the standard 
  attribute-values for mammals, such as skin-fur and birth-live. These are inherited 
  by rabbits and hamsters and do not have to be specified in their frames. There 
  can also be defaults for attributes which might be overwritten by specific species. 
  Legs-4 applies to most mammals but monkeys would have legs-2 specified.</P>
<P>Another 
  feature of a frame based system is demons. These are procedures which are activated 
  by various updating procedures. For example a financial application might have 
  demons on various account balances that are triggered when the value is too 
  low. These could also have editing capabilities that made sure the data being 
  entered is consistent with existing data. Figure 6.1 shows some samples of frames 
  for animals.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="frames6-1.gif" WIDTH=413 HEIGHT=579><BR>
  </P>
<P>Figure 
  6.1. Examples of animal frames</P>
<h1><B> <a name="thecode"></a>6.1 
  The Code </B></h1>
<P>In 
  order to implement a frame system in Prolog, there are two initial decisions 
  to be made. The first is the design of the user interface, and the second is 
  the design of the internal data structure used to hold the frame information.</P>
<P>The 
  access to data in the frame system will be through three predicates.</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>get_frame</b> 
      - retrieves attribute values for a frame;</P>
    <P> 
     
    <P> </P>
     
    <P><B>add_frame</b> 
      - adds or updates attribute values for a frame;</P>
    <P> 
     
    <P> </P>
     
    <P><B>del_frame</b> 
      - deletes attribute values from a frame.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>From 
  the user's perspective, these operations will appear to be acting on structures 
  that are very similar to database records. Each frame is like a record, and 
  the slots in the frame correspond to the fields in the record. The intelligence 
  in the frame system, such as inheritance, defaults, and demons, happens automatically 
  for the user.</P>
<TABLE CELLSPACING=0 BORDER=0 WIDTH=430>
  <TR> 
    <TD VALIGN="TOP"> 
      <P>The 
        first argument of each of these predicates is the name of the frame. The 
        second argument has a list of the slots requested. Each slot is represented 
        by a term of the form <B>attribute - value</B>. For example to retrieve 
        values for the <B>height</B> and <B>weight</B> slots in the frame <B>dennis</B> 
        the following query would be used: 
    </TD>
  </TR>
</TABLE>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(dennis, 
      [weight-W, height-H]).</B></P>
    <P><B>W = 155</B></P>
    <P><B>H = 5-10</B></P>
  </DIR>
</DIR>
<P>To 
  add a new sport for <B>mary</B>:</P>
<DIR> 
  <DIR> 
    <P><B>?- add_frame(mary, 
      [sport-rugby]).</B></P>
  </DIR>
</DIR>
<P>To 
  delete a slot's value for <B>mynorca</B>'s computer:</P>
<DIR> 
  <DIR> 
    <P><B>?- del_frame(mynorca, 
      [computer-'PC AT']).</B></P>
  </DIR>
</DIR>
<P>These 
  three primitive frame access predicates can be used to build more complex frame 
  applications. For example the following query would find all of the women in 
  the frame database who are rugby players:</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(X, 
      [ako-woman, sport-rugby]).</B></P>
    <P><B>X = mary ;</B></P>
    <P><B>X = kelly;</B></P>
  </DIR>
</DIR>
<P>A 
  match-making system might have a predicate that looks for men and women who 
  have a hobby in common:</P>
<DIR> 
  <DIR> 
    <P><B>in_common(M, 
      W, H) :-<BR>
      get_frame(M, [ako-man, hobby-H]), <BR>
      get_frame(W, [ako-woman, hobby-H]).</B></P>
  </DIR>
</DIR>
<h1><B> <b><a name="datastructures"></a></b>6.2 
  Data Structure </B></h1>
<P>The 
  next decision is to chose a type of data structure for the frames. The frame 
  is a relatively complex structure. It has a name, and multiple slots. Each slot, 
  which corresponds to an attribute of the frame, can have a value. This is the 
  same as in a normal database. However in a frame system, the value is just one 
  possible facet for the slot. There might also be default values, predicates 
  which are used to calculate values, and demons which fire when the value in 
  the slot is updated.</P>
<P>Furthermore, 
  the frames can be organized in a hierarchy, where each frame has an a-kind-of 
  slot which has a list of the types of frames from which this frame inherits 
  values.</P>
<P>The 
  data structure chosen for this implementation has the predicate name <B>frame</B> 
  with two arguments. The first is the name of the frame, and the second is a 
  list of slots separated by a hyphen operator from their respective facet lists. 
  The facet list is composed of prefix operator facet names. The ones defined 
  in the system are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>val</b> 
      - the simple value of the slot;</P>
    <P> 
     
    <P> </P>
     
    <P><B>def</b> 
      - the default if no value is given;</P>
    <P> 
     
    <P> </P>
     
    <P><B>calc</b> 
      - the predicate to call to calculate a value for the slot;</P>
    <P> 
     
    <P> </P>
     
    <P><B>add</b> 
      - the predicate to call when a value is added for the slot;</P>
    <P> 
     
    <P> </P>
     
    <P><B>del</b> 
      - the predicate to call when the slot's value is deleted.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Here 
  is the format of a frame data structure:</P>
<DIR> 
  <DIR> 
    <P> <B>frame(</b>name<B>, 
      [<BR>
      </B>slotname1 <B>- [<BR>
      </B>&#9;facet1 val11, <BR>
      &#9;facet2 val12, <BR>
      &#9;<B>...], <BR>
      </B>slotname2 -<B> [<BR>
      </B>&#9;facet1 val21, <BR>
      &#9;facet2 val 22, <BR>
      <B>&#9;...], <BR>
      ...]).</b></P>
  </DIR>
</DIR>
<P>For 
  example:</P>
<DIR> 
  <DIR> 
    <P><B>frame(man, 
      [<BR>
      ako-[val [person]], <BR>
      hair-[def short, del bald], <BR>
      weight-[calc male_weight] ]).</B></P>
    <P><B>frame(woman, 
      [<BR>
      ako-[val [person]], <BR>
      hair-[def long], <BR>
      weight-[calc female_weight] ]).</B></P>
  </DIR>
</DIR>
<P>In 
  this case both <B>man</B> and <B>woman</B> have <B>ako</B> slots with the value 
  of <B>person</B>. The hair slot has default values of long and short hair for 
  women and men, but this would be overridden by the values in individual frames. 
  Both have facets that point to predicates that are to be used to calculate weight, 
  if none is given. The man's hair slot has a facet which points to a demon, <B>bald</B>, 
  to be called if the value for hair is deleted.</P>
<P>One 
  additional feature permits values to be either single-valued or multi-valued. 
  Single values are represented by terms, multiple values are stored in lists. 
  The <B>add_frame</B> and <B>del_frame</B> predicates take this into account 
  when updating the frame. For example <B>hair</B> has a single value but <B>hobbies</B> 
  and <B>ako</B> can have multiple values.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="frames6-2.gif" WIDTH=403 HEIGHT=265><BR>
  </P>
<P>Figure 
  6.2. Major predicates of get_frame</P>
<h1><B> <a name="themanipulationpredicates"></a>6.3 
  The Manipulation Predicates </B></h1>
<P>The 
  first predicate to look at is <B>get_frame</B>. It takes as input a query pattern, 
  which is a list of slots and requested values. This request list (<B>ReqList</B>) 
  is then compared against the <B>SlotList</B> associated with the frame. As each 
  request is compared against the slot list, Prolog's unification instantiates 
  the variables in the list. Figure 6.2 shows the major predicates used with <B>get_frame</B>.</P>
<DIR> 
  <DIR> 
    <P><B>get_frame(Thing, 
      ReqList) :-<BR>
      frame(Thing, SlotList), <BR>
      slot_vals(Thing, ReqList, SlotList).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>slot_vals</B> predicate takes care of matching the request list against the 
  slot list. It is a standard recursive list predicate, dealing with one item 
  from the request list at a time. That item is first converted from the more 
  free form style allowed in the input list to a more formal structure describing 
  the request. That structure is <B>req/4</B> where the arguments are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;name 
      of the frame;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;the 
      requested slot;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;the 
      requested facet;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;the 
      requested value.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  code for <B>slot_vals</B> recognizes request lists, and also single slot requests 
  not in list form. This means both of the following frame queries are legal:</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame( 
      dennis, hair-X ).</B></P>
    <P><B>...</B></P>
    <P><B>?- get_frame( 
      dennis, [hair-X, height-Y] ).</B></P>
    <P><B>...</B></P>
  </DIR>
</DIR>
<P>The 
  <B>slot_vals</B> predicate is a standard list recursion predicate that fulfills 
  each request on the list in turn. The real work is done by <B>find_slot</B> 
  which fulfills the request from the frame's slot list.</P>
<DIR> 
  <DIR> 
    <P><B>slot_vals(_, 
      [], _).</B></P>
    <P><B>slot_vals(T, 
      [Req|Rest], SlotList) :-<BR>
      prep_req(Req, req(T, S, F, V)), <BR>
      find_slot(req(T, S, F, V), SlotList), <BR>
      !, slot_vals(T, Rest, SlotList).</B></P>
    <P><B>slot_vals(T, 
      Req, SlotList) :-<BR>
      prep_req(Req, req(T, S, F, V)), <BR>
      find_slot(req(T, S, F, V), SlotList).</B></P>
  </DIR>
</DIR>
<P>The 
  request list is composed of items of the form <B>Slot - X</B>. The <B>prep_req</B> 
  predicate, which builds the formal query structure, must recognize three cases:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;<B>X</B> 
      is a variable, in which case the value of the slot is being sought.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;<B>X</B> 
      is of the form <B>Facet(Val)</B>, in which case a particular facet is being 
      sought.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;<B>X</B> 
      is a non-variable in which case the slot value is being sought for comparison 
      with the given value.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Here 
  is the code which prepares the formal query structure:</P>
<DIR> 
  <DIR> 
    <P><B>prep_req(Slot-X, 
      req(T, Slot, val, X)) :- var(X), !.</B></P>
    <P><B>prep_req(Slot-X, 
      req(T, Slot, Facet, Val)) :-<BR>
      nonvar(X), <BR>
      X =.. [Facet, Val], <BR>
      facet_list(FL), <BR>
      member(Facet, FL), !.</B></P>
    <P><B>prep_req(Slot-X, 
      req(T, Slot, val, X)).</B></P>
    <P><B>facet_list([val, 
      def, calc, add, del, edit]).</B></P>
  </DIR>
</DIR>
<P>For 
  example, the query</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(dennis, 
      [hair-X]).</B></P>

  </DIR>
</DIR>
<P>would 
  generate the more formal request for:</P>
<DIR> 
  <DIR> 
    <P><B>req(dennis, 
      hair, val, X)</B></P>
  </DIR>
</DIR>
<P>Having 
  now prepared a more formal request, and a slot list to fulfill it, <B>find_slot</B> 
  attempts to satisfy the request. The first clause handles the case where the 
  request is not for a variable, but really just a test to see if a certain value 
  exists. In this case another request with a different variable (<B>Val</B>) 
  is started, and the results compared with the original request. Two cases are 
  recognized: either the value was a single value, or the value was a member of 
  a list of values.</P>
<DIR> 
  <DIR> 
    <P><B>find_slot(req(T, 
      S, F, V), SlotList) :-<BR>
      nonvar(V), <BR>
      find_slot(req(T, S, F, Val), SlotList), <BR>
      !, <BR>
      (Val == V; member(V, Val)).</B></P>
  </DIR>
</DIR>
<P>The 
  next clause covers the most common case, in which the value is a variable, and 
  the slot is a member of the slot list. Notice that the call to <B>member</B> 
  both verifies that there is a structure of the form <B>Slot-FacetList</B> and 
  unifies <B>FacetList</B> with the list of facets associated with the slot. This 
  is because <B>S</B> is bound at the start of the call to <B>member</B>, and 
  <B>FacetList</B> is not. Next, <B>facet_val</B> is called which gets the value 
  from the facet list.</P>
<DIR> 
  <DIR> 
    <P><B>find_slot(req(T, 
      S, F, V), SlotList) :-<BR>
      member(S-FacetList, SlotList), <BR>
      !, facet_val(req(T, S, F, V), FacetList).</B></P>
  </DIR>
</DIR>
<P>If 
  the requested slot was not in the given slot list for the frame, then the next 
  clause uses the values in the <B>ako</B> (a-kind-of) slot to see if there is 
  a super class from which to inherit a value. The value in the <B>ako</B> slot 
  might be a list, or a single value. The higher frame's slot list is then used 
  in an attempt to satisfy the request. Note that this recurses up through the 
  hierarchy. Note also that a frame may have multiple values in the ako slot, 
  allowing for a more complex structure than a pure hierarchy. The system works 
  through the list in order, trying to satisfy a request from the first ako value 
  first. </P>
<DIR> 
  <DIR> 
    <P><B>find_slot(req(T, 
      S, F, V), SlotList) :-<BR>
      member(ako-FacetList, SlotList), <BR>
      facet_val(req(T, ako, val, Ako), FacetList), <BR>
      (member(X, Ako); X = Ako), <BR>
      frame(X, HigherSlots), <BR>
      find_slot(req(T, S, F, V), HigherSlots), !.</B></P>
  </DIR>
</DIR>
<P>The 
  final clause in <B>find_slot</B> calls the error handling routine. The error 
  handling routine should probably be set not to put up error messages in general, 
  since many times quiet failure is what is required. During debugging it is useful 
  to have it turned on.</P>
<DIR> 
  <DIR> 
    <P><B>find_slot(Req, 
      _) :-<BR>
      error(['frame error looking for:', Req]).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>facet_val</B> predicate is responsible for getting the value for the facet. 
  It deals with four possible cases:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;The 
      requested facet and value are on the facet list. This covers the <B>val</B> 
      facet as well as specific requests for other facets.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      requested facet is <B>val</B>, it is on the facet list, and its value is 
      a list. In this case <B>member</B> is used to get a value.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;There 
      is a default (<B>def</B>) facet which is used to get the value.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;There 
      is a predicate to call (<B>calc</B>) to get the value. It expects the formal 
      request as an argument.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>If 
  the facet has a direct value in the facet list, then there is no problem. If 

  there is not a direct value, and the facet being asked for is the <B>val</B> 
  facet, then, alternate ways of getting the value are used. First the default 
  is tried, and if there is no default, then a <B>calc</B> predicate is used to 
  compute the value. If a <B>calc</B> predicate is needed, then the call to it 
  is built using the <B>univ</B> (<B>=..</B>) built-in predicate, with the request 
  pattern as the first argument, and other arguments included in the <B>calc</B> 
  predicate following.</P>
<DIR> 
  <DIR> 
    <P><B>facet_val(req(T, 
      S, F, V), FacetList) :-<BR>
      FV =.. [F, V], <BR>
      member(FV, FacetList), !.</B></P>
    <P><B>facet_val(req(T, 
      S, val, V), FacetList) :-<BR>
      member(val ValList, FacetList), <BR>
      member(V, ValList), !.</B></P>
    <P><B>facet_val(req(T, 
      S, val, V), FacetList) :-<BR>
      member(def V, FacetList), !.</B></P>
    <P><B>facet_val(req(T, 
      S, val, V), FacetList) :-<BR>
      member(calc Pred, FacetList), <BR>
      Pred =.. [Functor | Args], <BR>
      CalcPred =.. [Functor, req(T, S, val, V) | Args], <BR>
      call(CalcPred).</B></P>
  </DIR>
</DIR>
<P>An 
  example of a predicate used to calculate values is the <B>female_weight</B> 
  predicate. It computes a default weight equal to twice the height of the individual.</P>
<DIR> 
  <DIR> 
    <P><B>female_weight(req(T, 
      S, F, V)) :-<BR>
      get_frame(T, [height-H]), <BR>
      V is H * 2.</B></P>
  </DIR>
</DIR>
<P>We 
  have now seen the code which gets values from a frame. It first sets up a list 
  of requested slot values and then processes them one at a time. For each slot 
  which is not defined for the frame, inheritance is used to find a parent frame 
  that defines the slot. For the slots that are defined, each of the facets is 
  tried in order to determine a value.</P>
<P>The 
  next major predicate in the frame system adds values to slots. For single valued 
  slots, this is a replace. For multi-valued slots, the new value is added to 
  the list of values.</P>
<P>The 
  <B>add_frame</B> predicate uses the same basic form as <B>get_frame</B>. For 
  updates, first the old slot list is retrieved from the existing frame. Then 
  the predicate <B>add_slots</B> is called with the old list (<B>SlotList</B>) 
  and the update list (<B>UList</B>). It returns the new list (<B>NewList</B>).</P>
<DIR> 
  <DIR> 
    <P><B>add_frame(Thing, 
      UList) :-<BR>
      old_slots(Thing, SlotList), <BR>
      add_slots(Thing, UList, SlotList, NewList), <BR>
      retract(frame(Thing, _)), <BR>
      asserta(frame(Thing, NewList)), !.&#9;</B></P>
  </DIR>
</DIR>
<P>The 
  <B>old_slots</B> predicate usually just retrieves the slot list, however if 
  the frame doesn't exist it creates a new frame with an empty slot list.</P>
<DIR> 
  <DIR> 
    <P><B>old_slots(Thing, 
      SlotList) :-<BR>
      frame(Thing, SlotList), !.</B></P>
    <P><B>old_slots(Thing, 
      []) :-<BR>
      asserta(frame(Thing, [])).</B></P>
  </DIR>
</DIR>
<P>Next, 
  comes <B>add_slots</B> which does analogous list matching to <B>slot_vals</B> 
  called by <B>get_frame</B>.</P>
<DIR> 
  <DIR> 
    <P><B>add_slots(_, 
      [], X, X).</B></P>
    <P><B>add_slots(T, 
      [U|Rest], SlotList, NewList) :-<BR>
      prep_req(U, req(T, S, F, V)), <BR>
      add_slot(req(T, S, F, V), SlotList, Z), <BR>
      add_slots(T, Rest, Z, NewList).</B></P>
    <P><B>add_slots(T, 
      X, SlotList, NewList) :-<BR>
      prep_req(X, req(T, S, F, V)), <BR>
      add_slot(req(T, S, F, V), SlotList, NewList).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>add_slot</B> predicate deletes the old slot and associated facet list from 
  the old slot list. It then adds the new facet and value to that facet list and 
  rebuilds the slot list. Note that <B>delete</B> unifies <B>FacetList</B> with 
  the old facet list. <B>FL2</B> is the new facet list returned from <B>add_facet</B>. 
  The new slot and facet list, <B>S-FL2</B> is then made the head of the <B>add_slot</B> 
  output list, with <B>SL2</B>, the slot list after deleting the old slot as the 
  tail.</P>
<DIR> 
  <DIR> 
    <P><B>add_slot(req(T, 
      S, F, V), SlotList, [S-FL2|SL2]) :-<BR>
      delete(S-FacetList, SlotList, SL2), <BR>
      add_facet(req(T, S, F, V), FacetList, FL2).</B></P>
  </DIR>
</DIR>
<P>The<B> 
  add_facet</B> predicate takes the request and deletes the old facet from the 
  list, builds a new facet and adds it to the facet list in the same manner as 
  <B>add_slot</B>. The main trickiness is <B>add_facet</B> makes a distinction 
  between a facet whose value is a list, and one whose value is a term. In the 
  case of a list, the new value is added to the list, whereas in the case of a 
  term, the old value is replaced. The <B>add_newval</B> predicate does this work, 
  taking the <B>OldVal</B>, the new value <B>V</B> and coming up with the <B>NewVal</B>.</P>
<DIR> 
  <DIR> 
    <P><B>add_facet(req(T, 
      S, F, V), FacetList, [FNew|FL2]) :-<BR>
      FX =.. [F, OldVal], <BR>
      delete(FX, FacetList, FL2), <BR>
      add_newval(OldVal, V, NewVal), <BR>
      !, check_add_demons(req(T, S, F, V), FacetList), <BR>
      FNew =.. [F, NewVal].</B></P>
    <P><B>add_newval(X, 
      Val, Val) :- var(X), !.</B></P>
    <P><B>add_newval(OldList, 
      ValList, NewList) :-<BR>
      list(OldList), <BR>
      list(ValList), <BR>
      append(ValList, OldList, NewList), !.</B></P>
    <P><B>add_newval([H|T], 
      Val, [Val, H|T]).</B></P>
    <P><B>add_newval(Val, 
      [H|T], [Val, H|T]).</B></P>
    <P><B>add_newval(_, 
      Val, Val).</B></P>
  </DIR>
</DIR>
<P>The 
  intelligence in the frame comes after the cut in <B>add_facet</B>. If a new 
  value has been successfully added, then <B>check_add_demons</B> looks for any 
  demon procedures which must be run before the update is completed.</P>
<P>In 
  <B>check_add_demons</B>, <B>get_frame</B> is called to retrieve any demon predicates 
  in the facet <B>add</B>. Note that since <B>get_frame</B> uses inheritance, 
  demons can be put in higher level frames that apply to all sub frames.</P>
<DIR> 
  <DIR> 
    <P><B>check_add_demons(req(T, 
      S, F, V), FacetList) :-<BR>
      get_frame(T, S-add(Add)), !, <BR>
      Add =.. [Functor | Args], <BR>
      AddFunc =.. [Functor, req(T, S, F, V) | Args], <BR>
      call(AddFunc).</B></P>
    <P><B>check_add_demons(_, 
      _).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>delete</B> predicate used in the add routines must simply return a list that 
  does not have the item to be deleted in it. If there was no item, then returning 
  the same list is the right thing to do. Therefor <B>delete</B> looks like:</P>
<DIR> 
  <DIR> 
    <P><B>delete(X, 
      [], []).</B></P>
    <P><B>delete(X, 
      [X|Y], Y) :- !.</B></P>
    <P><B>delete(X, 
      [Y|Z], [Y|W]) :- delete(X, Z, W).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>del_frame</B> predicate is similar to both <B>get_frame</B> and <B>add_frame</B>. 
  However, one major difference is in the way items are deleted from lists. When 
  <B>add_frame</B> was deleting things from lists (for later replacements with 
  updated values), the behavior of delete above was appropriate. For <B>del_frame</B>, 
  a failure should occur if there is nothing to delete from the list. For this 
  function we use <B>remove</B> which is similar to <B>delete</B>, but fails if 
  there was nothing to delete.</P>
<DIR> 
  <DIR> 
    <P><B>remove(X, 
      [X|Y], Y) :- !.</B></P>
    <P><B>remove(X, 
      [Y|Z], [Y|W]) :- remove(X, Z, W).</B></P>
  </DIR>
</DIR>
<P>The 
  rest of <B>del_frame</B> looks like:</P>
<DIR> 
  <DIR> 
    <P><B>del_frame(Thing) 
      :-<BR>
      retract(frame(Thing, _)).</B></P>
    <P><B>del_frame(Thing) 
      :-<BR>
      error(['No frame', Thing, 'to delete']).</B></P>
    <P><B>del_frame(Thing, 
      UList) :-<BR>
      old_slots(Thing, SlotList), <BR>
      del_slots(Thing, UList, SlotList, NewList), <BR>
      retract(frame(Thing, _)), <BR>
      asserta(frame(Thing, NewList)).&#9;</B></P>
    <P><B>del_slots([], 
      X, X, _).</B></P>
    <P><B>del_slots(T, 
      [U|Rest], SlotList, NewList) :-<BR>
      prep_req(U, req(T, S, F, V)), <BR>
      del_slot(req(T, S, F, V), SlotList, Z), <BR>
      del_slots(T, Rest, Z, NewList).</B></P>
    <P><B>del_slots(T, 
      X, SlotList, NewList) :-<BR>
      prep_req(X, req(T, S, F, V)), <BR>
      del_slot(req(T, S, F, V), SlotList, NewList).</B></P>
    <P><B>del_slot(req(T, 
      S, F, V), SlotList, [S-FL2|SL2]) :-<BR>
      remove(S-FacetList, SlotList, SL2), <BR>
      del_facet(req(T, S, F, V), FacetList, FL2).</B></P>
    <P><B>del_slot(Req, 
      _, _) :-<BR>
      error(['del_slot - unable to remove', Req]).</B></P>
    <P><B>del_facet(req(T, 
      S, F, V), FacetList, FL) :-<BR>
      FV =.. [F, V], <BR>
      remove(FV, FacetList, FL), <BR>
      !, check_del_demons(req(T, S, F, V), FacetList).</B></P>
    <P><B>del_facet(req(T, 
      S, F, V), FacetList, [FNew|FL]) :-<BR>
      FX =.. [F, OldVal], <BR>
      remove(FX, FacetList, FL), <BR>
      remove(V, OldVal, NewValList), <BR>
      FNew =.. [F, NewValList], &#9;<BR>
      !, check_del_demons(req(T, S, F, V), FacetList).</B></P>
    <P><B>del_facet(Req, 
      _, _) :-<BR>
      error(['del_facet - unable to remove', Req]).</B></P>
    <P><B>check_del_demons(req(T, 
      S, F, V), FacetList) :-<BR>
      get_frame(T, S-del(Del)), !, <BR>
      Del =.. [Functor|Args], <BR>
      DelFunc =.. [Functor, req(T, S, F, V)|Args], <BR>
      call(DelFunc).</B></P>
    <P><B>check_del_demons(_, 
      _).</B></P>
  </DIR>
</DIR>
<P>This 
  code is essentially the same as for the add function, except the new facet values 
  have elements deleted instead of replaced. Also, the <B>del</B> facet is checked 
  for demons instead of the <B>add </B>facet.</P>
<P>Here 
  is an example of a demon called when a man's hair is deleted. It checks with 
  the user before proceeding.</P>
<DIR> 
  <DIR> 
    <P><B>bald(req(T, 
      S, F, V)) :-<BR>
      write_line([T, 'will be bald, ok to proceed?']), <BR>
      read(yes).&#9;</B></P>
  </DIR>
</DIR>
<h1><B> <a name="usingframes"></a>6.4 
  Using Frames </B></h1>
<P>The 
  use of inheritance makes the frame based system an intelligent way of storing 
  data. For many expert systems, a large portion of the intelligence can be stored 
  in frames instead of in rules. Let's consider, for example, the bird identification 
  expert system.</P>
<P>In 
  the bird system there is a hierarchy of information about birds. The rules about 
  the order tubenose, family albatross, and particular albatrosses can all be 
  expressed in frames as follows:</P>
<DIR> 
  <DIR> 
    <P><B>frame(tubenose, 
      [<BR>
      level-[val order], <BR>
      nostrils-[val external_tubular], <BR>
      live-[val at_sea], <BR>
      bill-[val hooked] ]).</B></P>
    <P><B>frame(albatross, 
      [<BR>
      ako-[val tubenose], <BR>
      level-[val family], <BR>
      size-[val large], <BR>
      wings-[val long-narrow] ]).<BR>
      </B></P>
    <P><B>frame(laysan_albatross, 
      [<BR>
      ako-[val albatross], <BR>
      level-[val species], <BR>
      color-[val white] ]).</B></P>
    <P><B>frame(black_footed_albatross, 
      [<BR>
      ako-[val albatross], <BR>
      level-[val species], <BR>
      color-[val dark] ]).</B></P>
  </DIR>
</DIR>
<P>In 
  a forward chaining system, we would feed some facts to the system and the system 
  would identify the bird based on those facts. We can get the same behavior with 
  the frame system and the predicate <B>get_frame</B>.</P>
<P>For 
  example, if we know a bird has a dark color, and long narrow wings, we can ask 
  the query:</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(X, 
      [color-dark, wings-long_narrow]).</B></P>
    <P><B>X = black_footed_albatross 
      ;</B></P>
    <P><B>no</B></P>
  </DIR>
</DIR>
<P>Notice 
  that this will find all of the birds that have the asked for property. The <B>ako</B> 
  slots and inheritance will automatically apply the various slots from wherever 
  in the hierarchy they appear. In the above example the color attribute was filled 
  from the black footed albatross frame, and the wings attribute was filled from 
  the albatross frame. This feature can be used to find all birds with long narrow 
  wings:</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(X, 
      [wings-long_narrow]).</B></P>
    <P><B>X = albatross 
      ;</B></P>
    <P><B>X = black_footed_albatross 
      ;</B></P>
    <P><B>X = laysan_albatross 
      ;</B></P>
    <P><B>no</B></P>
  </DIR>
</DIR>
<P>The 
  queries in this case are more general than in the various expert systems used 
  so far. The query finds all frames that fit the given facts. The query could 
  specify a level, but the query can also be used to bind variables for various 
  fits. For example, to get the level in the hierarchy of the frames which have 
  long narrow wings:</P>
<DIR> 
  <DIR> 
    <P><B>?- get_frame(X, 
      [wings-long_narrow, level-L]).</B></P>
    <P><B>X = albatross, 
      L = family ;</B></P>
    <P><B>X = black_footed_albatross, 
      L = species;</B></P>
    <P><B>X = laysan_albatross, 
      L = species ;</B></P>
    <P><B>no</B></P>
  </DIR>
</DIR>
<h1><B> <a name="summary"></a>6.5 
  Summary </B></h1>
<P>For 
  the expert systems we have seen already, we have used the Prolog database to 
  store information. That database has been relatively simple. By writing special 
  access predicates it is possible to create a much more sophisticated database 
  using frame technology. These frames can then be used to store knowledge about 
  the particular environment.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>6.1 
  - Add other facets to the slots to allow for specification of things like explanation 
  of the slot, certainty factors, and constraints.</P>
<P> 
 
<P> </P>
 
<P>6.2 
  - Add an automatic query-the-user facility that is called whenever a slot value 
  is sought and there is no other frame to provide the answer. This will allow 
  the frame system to be used as a backward chaining expert system.</P>


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
