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
<td><h1>7 Integration</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />


<P>Many 
  real problems cannot be solved by the simple application of a single expert 
  system technique. Problems often require multiple knowledge representation techniques 
  as well as conventional programming techniques.</P>
<P>Often 
  times it is necessary to either have the expert system embedded in a conventional 
  application, or to have other applications callable from the expert system. 
  For example, a financial expert system might need a tight integration with a 
  spread sheet, or an engineering expert system might need access to programs 
  which perform engineering calculations.</P>
<P>The 
  degree to which the systems in this book can be integrated with other environments 
  depends on the flexibility of the Prolog used, and the application which needs 
  to be accessed. The systems can be designed with the hooks in place for this 
  integration. In the examples presented in this chapter, the knowledge base tools 
  will have hooks to Prolog.</P>
<P>Often 
  times the Prolog code can be used to implement features of the system that do 
  not fit neatly in the knowledge tools. This is often the case in the area of 
  user interface, but applies to other portions as well. In the example in this 
  chapter, we will see Prolog used to smooth over a number of the rough edges 
  of the application.</P>
<P>The 
  degree of integration needed between knowledge tools also depends somewhat on 
  the application. In this chapter, the forward chaining system and frame based 
  knowledge representation will be tightly integrated. By having control over 
  the tools, the degree of integration can be implemented to suit the individual 
  application.</P>
<P>The 
  example used in this chapter is the same room furniture placement used in the 
  chapter on forward chaining. While the application was developed with the pure 
  Oops system, a much more elegant solution can be implemented by integrating 
  frames, Oops, and Prolog. In particular, there is a lot of knowledge about the 
  types of furniture which could be better stored in a frame system. Also the 
  awkward input and output sections of the system could be better written in Prolog.</P>
<h1><B> <a name="foops"></a>7.1 
  Foops (Frames and Oops) </B></h1>
<P>The 
  first step is to integrate the frame based knowledge representation with the 
  Oops forward chaining inference engine. The integration occurs in two places:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;The 
      concept of a frame instance needs to be implemented.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      rules must be able to reference the frame instances.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  instances are needed for an integrated system to distinguish between the frame 
  data definition in the knowledge base, and the instances of frames in working 
  storage. The rules will be matching and manipulating instances of frames, rather 
  than the frame definitions themselves. For example, there will be a frame describing 
  the attributes of chairs, but there might be multiple instances of chairs in 
  working storage.</P>
<h2 ALIGN="JUSTIFY"><B><a name="instances"></a>Instances</B></h2>
<P>In 
  the frame system as it is currently written, the frames are the data. Particular 
  instances of a frame, such as person, are just additional frames. For use in 
  the expert system it is cleaner to distinguish between frame definitions and 
  instances of frames.</P>
<P>The 
  definitions specify the slots for a frame, and the instances provide specific 
  values for the slots. The frame instances will be updated in working storage 
  and accessed by the rules. For example, <B>person</B> would be a frame definition, 
  and <B>mary</B> would be an instance of <B>person</B>.</P>
<P>The 
  inheritance still works as before. That is, a <B>person</B> frame could be defined 
  as well as <B>man</B> and <B>woman</B> frames which inherit from <B>person</B>. 
  In this case then <B>mary</B> would be an instance of <B>woman</B>, inheriting 
  from both the <B>woman</B> frame and the <B>person</B> frame.</P>
<P>The 
  <B>frame</B> definitions will be considered to define <B>class</B>es of things. 
  So, <B>person</B>, <B>man</B>, and <B>woman</B> are classes defined in <B>frame</B> 
  relations. Individuals, such as <B>mary</B>, <B>dennis</B>, <B>michael</B>, 
  and <B>diana</B> are stored as instances of these classes.</P>
<P>To 
  implement the instances, we need a data structure, and predicates to manipulate 
  the data structure. An instance of a frame looks a lot like a frame, and will 
  be stored in the relation <B>frinst/4</B>. The four arguments will be:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;the 
      class name;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;the 
      instance name;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;the 
      list of slot attribute-value pairs associated with the instance;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;a 
      time stamp indicating when the instance was last updated.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>For 
  example:</P>
<DIR> 
  <DIR> 
    <P><B>frinst(woman, 
      mary, [ako-woman, hair-brown, hobby-rugby], 32).</B></P>
    <P><B>frinst(man, 
      dennis, [ako-man, hair-blond, hobby-go], 33).</B></P>
  </DIR>
</DIR>
<P>The 
  predicates which manipulate <B>frinst</B>s are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;<B>getf</B> 
      - retrieve attribute values for a <B>frinst</B>;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;<B>addf</B> 
      - add a new <B>frinst</B>;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;<B>uptf</B> 
      - update an existing <B>frinst</B>;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;<B>delf</B> 
      - delete a <B>frinst</B>, or attribute values for a <B>frinst</B>;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;<B>printf</B> 
      - print information about a <B>frinst</B>.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  code for <B>getf</B> is almost identical for that of <B>get_frame</B>. It just 
  uses the <B>frinst</B> structure to get data rather than the <B>frame</B> structure. 
  The <B>ako</B> slot of a <B>frinst</B> is automatically set to the <B>class</B> 
  name, so if it is necessary to inherit values, the appropriate frames will be 
  called just as they were for <B>get_frame</B>. The only other change is the 
  additional argument for retrieving the time stamp as well.</P>
<DIR> 
  <DIR> 
    <P><B>getf(Class, 
      Name, ReqList) :-<BR>
      getf(Class, Name, ReqList, _).<BR>
      </B></P>
    <P><B>getf(Class, 
      Name, ReqList, TimeStamp) :-<BR>
      frinst(Class, Name, SlotList, TimeStamp), <BR>
      slot_vals(Class, Name, ReqList, SlotList).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>addf</B> predicate is similar to <B>add_frame</B>, however it has two new 
  features. First, it will generate a unique name for the <B>frinst</B> if none 
  was given, and second it adds a time stamp. The generated name is simply a number 
  in sequence. The time stamp is generated the same way, and uses the predicate 
  <B>getchron</B> which was already implemented for Oops. Note that <B>addf</B> 
  also sets the <B>ako</B> slot to the value of the <B>Class</B>.</P>
<DIR> 
  <DIR> 
    <P><B>addf(Class, 
      Nm, UList) :-<BR>
      (var(Nm), genid(Name);Name=Nm), <BR>
      add_slots(Class, Name, <BR>
      &#9;[ako-Class|UList], SlotList, NewList), <BR>
      getchron(TimeStamp), <BR>
      asserta( frinst(Class, Name, NewList, TimeStamp) ), <BR>
      !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>uptf</B> predicate is distinct from <B>addf</B> in that it only updates existing 
  <B>frinst</B>s and does not create new ones. It puts a new time stamp on the 
  <B>frinst</B> as part of the update.</P>
<DIR> 
  <DIR> 
    <P><B>uptf(Class, 
      Name, UList) :-<BR>
      frinst(Class, Name, SlotList, _), <BR>
      add_slots(Class, Name, UList, SlotList, NewList), <BR>
      retract( frinst(Class, Name, _, _) ), <BR>
      getchron(TimeStamp), <BR>
      asserta( frinst(Class, Name, NewList, TimeStamp) ), <BR>
      !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>delf</B> and <B>printf</B> predicates are similarly based on <B>del_frame</B> 
  and <B>print_frame</B>. Both offer options for accessing large numbers of instances. 
  For example <B>delf(Class)</B> deletes all <B>frinst</B>s in <B>Class</B>, whereas 
  <B>delf(Class, Name, DList)</B> deletes the attribute values in <B>DList</B> 
  from the specified instance.</P>
<h2 ALIGN="JUSTIFY"><B><a name="rulesforfrints"></a>Rules 
  for frinsts</B></h2>
<P>Now 
  that there is a mechanism for handling instances of frames, the next step is 
  to revise the Oops rule structure to use those instances. In Oops, each of the 
  <B>LHS</B> conditions was a Prolog term held in a <B>fact</B> relation. For 
  Foops, the <B>LHS</B> conditions will be <B>frinst</B>s.</P>
<P>In 
  keeping with the Oops design of using operators to make the rules more readable, 
  the <B>frinst</B>s will be presented differently in the rules. The form will 
  be:</P>
<DIR> 
  <DIR> 
    <P><B>Class - Name 
      with [Attr - Val, ...]</B></P>
  </DIR>
</DIR>
<P>For 
  example, the rule in the furniture configuration which puts table lamps on end 
  tables is:</P>
<DIR> 
  <DIR> 
    <P><B>rule f11:<BR>
      [table_lamp - TL with [position-none], <BR>
      end_table - ET with [position-wall/W]]<BR>
      ==&gt;<BR>
      [update( table_lamp - TL with [position-end_table/ET] )].</B></P>
  </DIR>
</DIR>
<P>Note 
  that the RHS actions also use the same syntax for the instance.</P>
<P>The 
  change is easy to implement due to the interchangeability of facts and rules 
  in Prolog. Oops refers to <B>fact</B>s, expecting to find data. Foops uses the 
  same code, but implements the relation <B>fact</B> as a rule which calls <B>getf</B>.</P>
<P>Following 
  is the code which matches the premises from the <B>LHS</B>. It is the the same 
  as in the previous version except that the definition of <B>fact</B> has been 
  changed to reflect the new nature of each individual premise.</P>
<DIR> 
  <DIR> 
    <P><B>match([], 
      []).</B></P>
    <P><B>match([Prem|Rest], 
      [Prem/Time|InstRest]) :-<BR>
      mat(Prem, Time), <BR>
      match(Rest, InstRest).</B></P>
    <P><B>mat(N:Prem, 
      Time) :-<BR>
      !, fact(Prem, Time).</B></P>
    <P><B>mat(Prem, 
      Time) :-<BR>
      fact(Prem, Time).</B></P>
    <P><B>mat(Test, 
      0) :-<BR>
      test(Test).<BR>
      </B></P>
    <P><B>fact(Prem, 
      Time) :-<BR>
      conv(Prem, Class, Name, ReqList), <BR>
      getf(Class, Name, ReqList, Time).</B></P>
    <P><B>conv(Class-Name 
      with List, Class, Name, List).</B></P>
    <P><B>conv(Class-Name, 
      Class, Name, []).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>conv</B> relation is used to allow the user to specify instances in an abbreviated 
  form if there is no attribute value list. For example, the following rule uses 
  an instance of the class <B>goal</B> where the name is the only important bit 
  of information:</P>
<DIR> 
  <DIR> 
    <P><B>rule f1:<BR>
      [goal - couch_first, <BR>
      couch - C with [position-none, length-LenC], <BR>
      door - D with [position-wall/W], <BR>
      ...</B></P>
  </DIR>
</DIR>
<P>The 
  only other change which has to be made is in the implementation of the action 
  commands which manipulate working storage. These now manipulate <B>frinst</B> 
  structures instead of the pure facts as they did in Oops. They simply call the 
  appropriate frame instance predicates.</P>
<DIR> 
  <DIR> 
    <P><B>assert_ws( 
      fact(Prem, Time) ) :-<BR>
      conv(Prem, Class, Name, UList), <BR>
      addf(Class, Name, UList).</B></P>
    <P><B>update_ws( 
      fact(Prem, Time) ) :-<BR>
      conv(Prem, Class, Name, UList), <BR>
      uptf(Class, Name, UList).</B></P>
    <P><B>retract_ws( 
      fact(Prem, Time) ) :-<BR>
      conv(Prem, Class, Name, UList), <BR>
      delf(Class, Name, UList).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="addingprologtofoops"></a>Adding 
  Prolog to Foops</B></h2>
<P>Now 
  that frames and Oops have been integrated into a new system, Foops, the next 
  step is to integrate Prolog as well. This has already been done for the frame 
  based system with the various demons that can be associated with frame slots. 
  The Prolog predicates referred to in the demon slots can simply be added directly 
  to the knowledge base.</P>
<P>Adding 
  Prolog to the rules is done by simply adding support for a call statement in 
  both the <B>test</B> (for the LHS) and <B>take</B> (for the RHS) predicates.</P>
<DIR> 
  <DIR> 
    <P><B>...</B></P>
    <P><B>test(call(X)) 
      :- call(X).</B></P>
    <P><B>...</B></P>
    <P><B>...</B></P>
    <P><B>take(call(X)) 
      :- call(X).</B></P>
    <P><B>...</B></P>
  </DIR>
</DIR>
<P>Calls 
  to Prolog predicates can now be added on either side of a rule. The Prolog can 
  be simple predicates performing some function right in the knowledge base, or 
  they can initiate more complex processing, including accessing other applications.</P>
<P>Figure 
  7.1 shows the major components of the Foops shell. Frames and Prolog code have 
  been added to the knowledge base. Working storage is composed of frame instances, 
  and the inference engine includes the frame manipulation predicates.</P>
<h1><B> <a name="roomconfiguration"></a>7.2 
  Room Configuration </B></h1>
<P>Now 
  that Foops is built, let's use it to attack the room configuration problem again. 
  Many of the aspects of the original system were handled clumsily in the original 
  version. In particular:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;The 
      initial data gathering was awkward using rules which triggered other data 
      gathering rules.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;The 
      wall space calculations were done in the rules.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;Each 
      rule was responsible for maintaining the consistency of the wall space and 
      the furniture against the wall.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  new system will allow for a much cleaner expression of most of the system, and 
  use Prolog to keep the rough edges out of the rule and frame knowledge structures.</P>
<P>Much 
  of the knowledge about the furniture in the room is better stored in frames. 
  This knowledge is then automatically applied by the rules accessing instances 
  of furniture. The rules then become simpler, and just deal with the IF THEN 
  situations and not data relationships.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="integration7-1.gif" WIDTH=343 HEIGHT=393><BR>
  </P>
<P>Figure 
  7.1. Major predicates of Foops shell</P>
<h2 ALIGN="JUSTIFY"><B><a name="furnitureframes"></a>Furniture 
  frames</B></h2>
<P>The 
  knowledge base contains the basic frame definitions, which will be used by the 
  instances of furniture. The frames act as sophisticated data definition statements 
  for the system.</P>
<P>The 
  highest frame defines the class furniture. It establishes defaults and demons 
  that apply to all furniture.</P>
<DIR> 
  <DIR> 
    <P><B>frame(furniture, 
      [<BR>
      legal_types - <BR>
      &#9;[val [couch, chair, coffee_table, end_table, &#9;standing_lamp, table_lamp, 
      tv, knickknack]], <BR>
      position - [def none, add pos_add], <BR>
      length - [def 3], <BR>
      place_on - [def floor]]).</B></P>
  </DIR>
</DIR>
<P>The 
  most interesting slot is position. Each piece of furniture has the default of 
  having the <B>position</B> <B>none</B>, meaning it has not been placed in the 
  room. This means the programmer need not add this value for each piece of furniture 
  initially. As it is positioned, the instance acquires a value which is used 
  instead of the inherited default.</P>
<P>Also 
  note that there is a demon which is called when a <B>position</B> is added for 
  a piece of furniture. This is the demon which will automatically maintain the 
  relation between wall space and furniture position. It will be described in 
  detail a little later.</P>
<P>Next 
  in the knowledge base are some classes of furniture. Note that the default length 
  for a couch will override the general default length of 3 for any piece of furniture 
  without a length specified.</P>
<DIR> 
  <DIR> 
    <P><B>frame(couch, 
      [<BR>
      ako - [val furniture], <BR>
      length - [def 6]]).</B></P>
    <P><B>frame(chair, 
      [<BR>
      ako - [val furniture]]).</B></P>
  </DIR>
</DIR>
<P>A 
  table is another class of furniture which is a bit different from other furniture 
  in that things can be placed on a table. It has additional slots for available 
  space, the list of items it is holding (things placed on the table), and the 
  slot indicating that it can support other items.</P>
<DIR> 
  <DIR> 
    <P><B>frame(table, 
      [<BR>
      ako - [val furniture], <BR>
      space - [def 4], <BR>
      length - [def 4], <BR>
      can_support - [def yes], <BR>
      holding - [def []]]).</B></P>
  </DIR>
</DIR>
<P>There 
  are two types of tables which are recognized in the system:</P>
<DIR> 
  <DIR> 
    <P><B>frame(end_table, 
      [<BR>
      ako - [val table], <BR>
      length - [def 2]]).</B></P>
    <P><B>frame(coffee_table, 
      [<BR>
      ako - [val table], <BR>
      length - [def 4]]).</B></P>
  </DIR>
</DIR>
<P>Remember 
  that frames can have multiple inheritance paths. This feature can be used to 
  establish other classes which define attributes shared by certain types of furniture. 
  For example the class <B>electric</B> is defined which describes the properties 
  of items which require electricity.</P>
<DIR> 
  <DIR> 
    <P><B>frame(electric, 
      [<BR>
      needs_outlet - [def yes]]).</B></P>
  </DIR>
</DIR>
<P>Lamps 
  are electric items included in the knowledge base. Note that lamps are further 
  divided between two types of lamps. A table lamp is different because it must 
  be placed on a table.</P>
<DIR> 
  <DIR> 
    <P><B>frame(lamp, 
      [<BR>
      ako - [val [furniture, electric]]]).</B></P>
    <P><B>frame(standing_lamp, 
      [<BR>
      ako - [val lamp]]).</B></P>
    <P><B>frame(table_lamp, 
      [<BR>
      ako - [val lamp], <BR>
      place_on - [def table]]).</B></P>
  </DIR>
</DIR>
<P>A 
  knickknack is another item which should be placed on a table.</P>
<DIR> 
  <DIR> 
    <P><B>frame(knickknack, 
      [<BR>
      ako - [val furniture], <BR>
      length - [def 1], <BR>
      place_on - [def table]]).</B></P>
  </DIR>
</DIR>
<P>The 
  television frame shows another use of calculated values. A television might 
  be free standing or it might have to be placed on a table. This ambiguity is 
  resolved by a calculate routine which asks the user for a value. When a rule 
  needs to know what to place the television on, the user will be asked. This 
  creates the same kind of dialog effect seen in the backward chaining systems 
  earlier in the book.</P>
<P>Note 
  also that the television uses multiple inheritance, both as a piece of furniture 
  and an electrical item.</P>
<DIR> 
  <DIR> 
    <P><B>frame(tv, 
      [<BR>
      ako - [val [furniture, electric]], <BR>
      place_on - [calc tv_support]]).</B></P>
  </DIR>
</DIR>
<P>Another 
  frame defines walls. There is a slot for the number of outlets on the wall, 
  and the available space. If no space is defined, it is calculated. The holding 
  slot is used to list the furniture placed against the wall.</P>
<DIR> 
  <DIR> 
    <P><B>frame(wall, 
      [<BR>
      length - [def 10], <BR>
      outlets - [def 0], <BR>
      space - [calc space_calc], <BR>
      holding - [def []]]).</B></P>
  </DIR>
</DIR>
<P>Doors, 
  goals, and recommendations are other types of data that are used in the system.</P>
<DIR> 
  <DIR> 
    <P><B>frame(door, 
      [<BR>
      ako - [val furniture], <BR>
      length - [def 4]]).</B></P>
    <P><B>frame(goal, 
      []).</B></P>
    <P><B>frame(recommend, 
      []).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="framedemons"></a>Frame 
  Demons</B></h2>
<P>Next 
  in the knowledge base are the Prolog predicates used in the various frame demons.</P>
<P>Here 
  is the predicate which is called to calculate a value for the <B>place_on</B> 
  slot for a television. It asks the user, and uses the answer to update the television 
  <B>frinst</B> so that the user will not be asked again.</P>
<DIR> 
  <DIR> 
    <P><B>tv_support(tv, 
      N, place_on-table) :-<BR>
      nl, <BR>
      write('Should the TV go on a table? '), <BR>
      read(yes), <BR>
      uptf(tv, N, [place_on-table]).</B></P>
    <P><B>tv_support(tv, 
      N, place_on-floor) :-<BR>
      uptf(tv, N, [place_on-floor]).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>pos_add</B> demon is called whenever the <B>position</B> of a piece of furniture 
  is updated. It illustrates how demons and frames can be used to create a database 
  which maintains its own semantic integrity. In this case, whenever the position 
  of a piece of furniture is changed, the available space of the wall it is placed 
  next to, or the table it is placed on, is automatically updated. Also the holding 
  list of the wall or table is also updated.</P>
<P>This 
  means that the single update of a furniture position results in the simultaneous 
  update of the wall or table space and wall or table holding list. Note the use 
  of variables for the class and name make it possible to use the same predicate 
  for both tables and walls.</P>
<DIR> 
  <DIR> 
    <P><B>pos_add(C, 
      N, position-CP/P) :-<BR>
      getf(CP, P, [space-OldS]), <BR>
      getf(C, N, [length-L]), <BR>
      NewS is OldS - L, <BR>
      NewS &gt;= 0, <BR>
      uptf(CP, P, [holding-[C/N], space-NewS]).</B></P>
    <P><B>pos_add(C, 
      N, position-CP/P) :-<BR>
      nl, write_line(['Not enough room on', CP, P, for, C, N]), <BR>
      !, fail.</B></P>
  </DIR>
</DIR>
<P>This 
  predicate also holds the pure arithmetic needed to maintain the available space. 
  This used to be included in the bodies of the rules in Oops. Now it is only 
  specified once, and is part of a demon defined in the highest frame, <B>furniture</B>. 
  It never has to be worried about in any other frame definition or rules.</P>
<P>The 
  <B>pos_add</B> demon also is designed to fail and report an error if something 
  doesn't fit. The original <B>uptf</B> predicate which was called to update the 
  <B>position</B> also fails, and no part of the update takes place. This insures 
  the integrity of the database.</P>
<P>Initially, 
  there is no space included in the wall and table <B>frinst</B>s. The following 
  demon will calculate it based on the holding list. This could also have been 
  used instead of the above predicate, but it is more efficient to calculate and 
  store the number than to recalculate it each time.</P>
<DIR> 
  <DIR> 
    <P><B>space_calc(C, 
      N, space-S) :-<BR>
      getf(C, N, [length-L, holding-HList]), <BR>
      sum_lengths(HList, 0, HLen), <BR>
      S is L - HLen.</B></P>
    <P><B>sum_lengths([], 
      L, L).</B></P>
    <P><B>sum_lengths([C/N|T], 
      X, L) :-<BR>
      getf(C, N, [length-HL]), <BR>
      XX is X + HL, <BR>
      sum_lengths(T, XX, L).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="initialdata"></a>Initial 
  Data</B></h2>
<P>Now 
  let's look at the data initialization for the system. It establishes other slots 
  for the wall frames giving spatial relationships between them, and establishes 
  the <B>goal</B> <B>gather_data</B>.</P>
<DIR> 
  <DIR> 
    <P><B>initial_data([goal 
      - gather_data, <BR>
      wall - north with [opposite-south, right-west, left-east], <BR>
      wall - south with [opposite-north, right-east, left-west], <BR>
      wall - east with [opposite-west, right-north, left-south], <BR>
      wall - west with [opposite-east, right-south, left-north] ]).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="inputdata"></a>Input 
  Data</B></h2>
<P>The 
  first rule uses the call feature to call a Prolog predicate to perform the data 
  gathering operations which used to be done with rules in Oops. Foops uses the 
  Lex rule selection, but this rule will fire first because no other rules have 
  any furniture to work with. It then asserts the <B>goal</B> <B>couch_first</B> 
  after gathering the other data. Because Lex gives priority to rules accessing 
  recently updated elements in working storage, the rules which have as a <B>goal</B> 
  <B>couch_first</B> will fire next.</P>
<DIR> 
  <DIR> 
    <P><B>rule 1:<BR>
      [goal - gather_data]<BR>
      ==&gt;<BR>
      [call(gather_data), <BR>
      assert( goal - couch_first )].</B></P>
  </DIR>
</DIR>
<P>The 
  Prolog predicate proceeds with prompts to the user, and calls to frame predicates 
  to populate working storage.</P>
<DIR> 
  <DIR> 
    <P><B>gather_data 
      :-<BR>
      read_furniture, <BR>
      read_walls.</B></P>
    <P><B>read_furniture 
      :-<BR>
      get_frame(furniture, [legal_types-LT]), <BR>
      write('Enter name of furniture at the prompt. It must be one of:'), nl, 
      <BR>
      write(LT), nl, <BR>
      write('Enter end to stop input.'), nl, <BR>
      write('At the length prompt enter y or a new number.'), nl, <BR>
      repeat, <BR>
      write('&gt;'), read(X), <BR>
      process_furn(X), !.</B></P>
  </DIR>
</DIR>
<P>Note 
  that this predicate has the additional intelligence of finding the default value 
  for the length of a piece of furniture and allowing the user to accept the default, 
  or choose a new value.</P>
<DIR> 
  <DIR> 
    <P><B>process_furn(end).</B></P>
    <P><B>process_furn(X) 
      :-<BR>
      get_frame(X, [length-DL]), <BR>
      write(length-DL), write('&gt;'), <BR>
      read(NL), <BR>
      get_length(NL, DL, L), <BR>
      addf(X, _, [length-L]), fail.</B></P>
    <P><B>get_length(y, 
      L, L) :- !.</B></P>
    <P><B>get_length(L, 
      _, L).</B></P>
  </DIR>
</DIR>
<P>The 
  dialog to get the empty room layout is straight-forward Prolog.</P>
<DIR> 
  <DIR> 
    <P><B>read_walls 
      :-<BR>
      nl, write('Enter data for the walls.'), nl, <BR>
      write('What is the length of the north &amp; south walls? '), <BR>
      read(NSL), <BR>
      uptf(wall, north, [length-NSL]), <BR>
      uptf(wall, south, [length-NSL]), <BR>
      write('What is the length of the east &amp; west walls? '), <BR>
      read(EWL), <BR>
      uptf(wall, east, [length-EWL]), <BR>
      uptf(wall, west, [length-EWL]), <BR>
      write('Which wall has the door? '), <BR>
      read(DoorWall), <BR>
      write('What is its length? '), <BR>
      read(DoorLength), <BR>
      addf(door, D, [length-DoorLength]), <BR>
      uptf(door, D, [position-wall/DoorWall]), <BR>
      write('Which walls have outlets? (a list)'), <BR>
      read(PlugWalls), <BR>
      process_plugs(PlugWalls).</B></P>
    <P><B>process_plugs([]) 
      :- !.</B></P>
    <P><B>process_plugs([H|T]) 
      :-<BR>
      uptf(wall, H, [outlets-1]), <BR>
      !, process_plugs(T).</B></P>
    <P><B>process_plugs(X) 
      :-<BR>
      uptf(wall, X, [outlets-1]).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="therules"></a>The 
  Rules</B></h2>
<P>With 
  the data definition, initial data, and input taken care of, we can proceed to 
  the body of rules. They are much simpler than the original versions.</P>
<P>The 
  first rules place the couch either opposite the door or to its right, depending 
  on which wall has more space. Note that the update of the couch position is 
  done with a single action. The frame demons take care of the rest of the update.</P>
<DIR> 
  <DIR> 
    <P><B>rule f1:<BR>
      [goal - couch_first, <BR>
      couch - C with [position-none, length-LenC], <BR>
      door - D with [position-wall/W], <BR>
      wall - W with [opposite-OW, right-RW], <BR>
      wall - OW with [space-SpOW], <BR>
      wall - RW with [space-SpRW], <BR>
      SpOW &gt;= SpRW, <BR>
      LenC =&lt; SpOW]<BR>
      ==&gt;<BR>
      [update(couch - C with [position-wall/OW])].</B></P>
    <P><B>rule f2:<BR>
      [goal - couch_first, <BR>
      couch - C with [position-none, length-LenC], <BR>
      door - D with [position-wall/W], <BR>
      wall - W with [opposite-OW, right-RW], <BR>
      wall - OW with [space-SpOW], <BR>
      wall - RW with [space-SpRW], <BR>
      SpRW &gt;= SpOW, <BR>
      LenC =&lt; SpRW]<BR>
      ==&gt;<BR>
      [update(couch - C with [position-wall/RW])].</B></P>
  </DIR>
</DIR>
<P>The 
  next rules position the television opposite the couch. They cover the two cases 
  of a free standing television and one which must be placed on a table. If the 
  television needs to be placed on a table, and there is no table big enough, 
  then a recommendation to buy an end table for the television is added. Because 
  of specificity in Lex (the more specific rule has priority), rule f4 will fire 
  before f4a. If f4 was successful, then f4a will no longer apply. If f4 failed, 
  then f4a will fire the next time.</P>
<P>The 
  rule to position the television puts the end table on the wall opposite the 
  couch, and the television on the end table.</P>
<DIR> 
  <DIR> 
    <P><B>rule f3:<BR>
      [couch - C with [position-wall/W], <BR>
      wall - W with [opposite-OW], <BR>
      tv - TV with [position-none, place_on-floor]]<BR>
      ==&gt;<BR>
      [update(tv - TV with [position-wall/OW])].</B></P>
    <P><B>rule f4:<BR>
      [couch - C with [position-wall/W], <BR>
      wall - W with [opposite-OW], <BR>
      tv - TV with [position-none, place_on-table], <BR>
      end_table - T with [position-none]]<BR>
      ==&gt;<BR>
      [update(end_table - T with [position-wall/OW]), <BR>
      update(tv - TV with [position-end_table/T])].</B></P>
    <P><B>rule f4a:<BR>
      [tv - TV with [position-none, place_on-table]]<BR>
      ==&gt;<BR>
      [assert(recommend - R with [buy-['table for tv']])].</B></P>
  </DIR>
</DIR>
<P>The 
  coffee table should be placed in front of the couch, no matter where it is.&#9; 
  </P>
<DIR> 
  <DIR> 
    <P><B>rule f5:<BR>
      [coffee_table - CT with [position-none], <BR>
      couch - C]<BR>
      ==&gt;<BR>
      [update(coffee_table - CT with [position-frontof(couch/C)])].</B></P>
  </DIR>
</DIR>
<P>The 
  chairs go on adjacent walls to the couch.</P>
<DIR> 
  <DIR> 
    <P><B>rule f6:<BR>
      [chair - Ch with [position-none], <BR>
      couch - C with [position-wall/W], <BR>
      wall - W with [right-RW, left-LW], <BR>
      wall - RW with [space-SpR], <BR>
      wall - LW with [space-SpL], <BR>
      SpR &gt; SpL]<BR>
      ==&gt;<BR>
      [update(chair - Ch with [position-wall/RW])].<BR>
      </B></P>
    <P><B>rule f7:<BR>
      [chair - Ch with [position-none], <BR>
      couch - C with [position-wall/W], <BR>
      wall - W with [right-RW, left-LW], <BR>
      wall - RW with [space-SpR], <BR>
      wall - LW with [space-SpL], <BR>
      SpL &gt; SpR]<BR>
      ==&gt;<BR>
      [update(chair - Ch with [position-wall/LW])].<BR>
      </B></P>
  </DIR>
</DIR>
<P>The 
  end tables go next to the couch if there are no other end tables there. Otherwise 
  they go next to the chairs. Note that the rule first checks to make sure there 
  isn't an unplaced television that needs an end table for support. The television 
  rule will position the end table for holding the television.</P>
<DIR> 
  <DIR> 
    <P><B>rule f9:<BR>
      [end_table - ET with [position-none], <BR>
      not tv - TV with [position-none, place_on-table], <BR>
      couch - C with [position-wall/W], <BR>
      not end_table - ET2 with [position-wall/W]]<BR>
      ==&gt;<BR>
      [update(end_table - ET with [position-wall/W])].</B></P>
    <P><B>rule f10:<BR>
      [end_table - ET with [position-none], <BR>
      not tv - TV with [position-none, place_on-table], <BR>
      chair - C with [position-wall/W], <BR>
      not end_table - ET2 with [position-wall/W]]<BR>
      ==&gt;<BR>
      [update(end_table - ET with [position-wall/W])].</B></P>
  </DIR>
</DIR>
<P>Table 
  lamps go on end tables.</P>
<DIR> 
  <DIR> 
    <P><B>rule f11:<BR>
      [table_lamp - TL with [position-none], <BR>
      end_table - ET with [position-wall/W]]<BR>
      ==&gt;<BR>
      [update( table_lamp - TL with [position-end_table/ET] )].</B></P>
  </DIR>
</DIR>
<P>Knickknacks 
  go on anything which will hold them. Note the use of variables in the class 
  and name positions. The query to the slot <B>can_support</B> will cause this 
  rule to find anything which has the attribute value <B>can_support - yes</B>. 
  This slot is set in the table frame, so both end tables and coffee tables will 
  be available to hold the knickknack.</P>
<DIR> 
  <DIR> 
    <P><B>rule f11a:<BR>
      [knickknack - KK with [position-none], <BR>
      Table - T with [can_support-yes, position-wall/W]]<BR>
      ==&gt;<BR>
      [update( knickknack - KK with [position-Table/T] )].</B></P>
  </DIR>
</DIR>
<P>The 
  rules for determining if extensions cords are necessary are simplified by the 
  use of variables and frame inheritance. The rule looks for anything which needs 
  an outlet. This will be true of any items which need an outlet, which is a property 
  inherited from frame <B>electric</B>. It is not necessary to write separate 
  rules for each case.</P>
<P>It 
  is necessary to write a separate rule to cover those things which are positioned 
  on other things. The wall can only be found from the supporting item. This is 
  the case where a television or table lamp is placed on a table. While this is 
  handled in rules here, it would also have been possible to use frame demons 
  to cover this case instead.</P>
<DIR> 
  <DIR> 
    <P><B>rule f12:<BR>
      [Thing - X with [needs_outlet-yes, position-wall/W], <BR>
      wall - W with [outlets-0]]<BR>
      ==&gt;<BR>
      [assert(recommend - R with [buy-['extension cord'-W]])].</B></P>
    <P><B>rule f13:<BR>
      [Thing - X with [needs_outlet-yes, position-C/N], <BR>
      C - N with [position-wall/W], <BR>
      wall - W with [outlets-0]]<BR>
      ==&gt;<BR>
      [assert(recommend - R with [buy-['extension cord'-Thing/W]])].</B></P>
  </DIR>
</DIR>
<P>Due 
  to specificity priorities in Lex, the following rule will fire last. It calls 
  a Prolog predicate to output the results of the session.</P>
<DIR> 
  <DIR> 
    <P><B>rule f14:<BR>
      []<BR>
      ==&gt;<BR>
      [call(output_data)].</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="outputdata"></a>Output 
  Data</B></h2>
<P>The 
  <B>output_data</B> predicate is again straight forward Prolog which gets the 
  relevant information and displays it.</P>
<DIR> 
  <DIR> 
    <P><B>output_data 
      :-<BR>
      write('The final results are:'), nl, <BR>
      output_walls, <BR>
      output_tables, <BR>
      output_recommends, <BR>
      output_unplaced.</B></P>
    <P><B>output_walls 
      :-<BR>
      getf(wall, W, [holding-HL]), <BR>
      write_line([W, wall, holding|HL]), <BR>
      fail.</B></P>
    <P><B>output_walls.</B></P>
    <P><B>output_tables 
      :-<BR>
      getf(C, N, [holding-HL]), <BR>
      not C = wall, <BR>
      write_line([C, N, holding|HL]), <BR>
      fail.</B></P>
    <P><B>output_tables.</B></P>
    <P><B>output_recommends 
      :-<BR>
      getf(recommend, _, [buy-BL]), <BR>
      write_line([purchase|BL]), <BR>
      fail.</B></P>
    <P><B>output_recommends.</B></P>
    <P><B>output_unplaced 
      :-<BR>
      write('Unplaced furniture:'), nl, <BR>
      getf(T, N, [position-none]), <BR>
      write(T-N), nl, <BR>
      fail.</B></P>
    <P><B>output_unplaced.</B></P>
  </DIR>
</DIR>
<P>Figure 
  7.2 summarizes how the tools in Foops are applied to the furniture layout program. 
  Frames are used for objects and relationships, rules are used to define situations 
  and responses, and Prolog is used for odds and ends like I/O and calculations.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="integration7-2.gif" WIDTH=361 HEIGHT=199><BR>
  </P>
<P>Figure 
  7.2. Summary of knowledge representation tools used in Foops</P>
<h1><B> <a name="asamplerun"></a>7.3 
  A Sample Run </B></h1>
<P>Here 
  is a portion of a sample run of the furniture placement system.</P>
<P>The 
  system starts in the Foops command loop, and then begins the initial data gathering.</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>=&gt;go.</B></P>
    <P><B>Enter name 
      of furniture at the prompt. It must be one of:</B></P>
    <P><B>[couch, chair, 
      coffee_table, end_table, standing_lamp, table_lamp, tv, knickknack]</B></P>
    <P><B>Enter end 
      to stop input.</B></P>
    <P><B>At the length 
      prompt enter y or a new number.</B></P>
    <P><B>&gt;couch.</B></P>
    <P><B>length-6&gt;y.</B></P>
    <P><B>&gt;chair.</B></P>
    <P><B>length-3&gt;5.</B></P>
    <P><B>...</B></P>
    <P><B>&gt;end.</B></P>
    <P><B>Enter data 
      for the walls.</B></P>
    <P><B>What is the 
      length of the north &amp; south walls? 12.</B></P>
    <P><B>What is the 
      length of the east &amp; west walls? 9.</B></P>
    <P><B>Which wall 
      has the door? east.</B></P>
    <P><B>What is its 
      length? 3.</B></P>
    <P><B>Which walls 
      have outlets? (a list)[east].</B></P>
    <P><B>adding-(goal-couch_first)</B></P>
    <P><B>Rule fired 
      1</B></P>
  </DIR>
</DIR>
<P>One 
  of the rules accessing the television causes this prompt to appear.</P>
<DIR> 
  <DIR> 
    <P><B>Should the 
      TV go on a table? yes.</B></P>
  </DIR>
</DIR>
<P>The 
  system has informational messages regarding which rules are firing and what 
  data is being updated.</P>
<DIR> 
  <DIR> 
    <P><B>updating-(couch-110 
      with [position-wall/north])</B></P>
    <P><B>Rule fired 
      f2</B></P>
    <P><B>updating-(end_table-116 
      with [position-wall/south])</B></P>
    <P><B>updating-(tv-117 
      with [position-end_table/116])</B></P>
    <P><B>Rule fired 
      f4</B></P>
    <P><B>...</B></P>
  </DIR>
</DIR>
<P>Here 
  is a message that appeared when a knickknack was unsuccessfully placed on an 
  end table. A different knickknack was then found to fit on the same table.</P>
<DIR> 
  <DIR> 
    <P><B>Not enough 
      room on end_table 116 for knickknack 121 </B></P>
    <P><B>Rule fired 
      f11a</B></P>
    <P><B>updating-(knickknack-120 
      with [position-end_table/116])</B></P>
    <P><B>Rule fired 
      f11a</B></P>
  </DIR>
</DIR>
<P>Here 
  is one of the extension cord recommendations:</P>
<DIR> 
  <DIR> 
    <P><B>adding-(recommend-_3888 
      with [buy-[extension cord-table_lamp/north]])</B></P>
    <P><B>Rule fired 
      f13</B></P>
  </DIR>
</DIR>
<P>The 
  last rule to fire provides the final results.</P>
<DIR> 
  <DIR> 
    <P><B>The final 
      results are:</B></P>
    <P><B>north wall 
      holding end_table/114 couch/110 </B></P>
    <P><B>east wall 
      holding chair/112 door/122 </B></P>
    <P><B>west wall 
      holding end_table/115 chair/113 </B></P>
    <P><B>south wall 
      holding end_table/116 </B></P>
    <P><B>end_table 
      114 holding table_lamp/119 </B></P>
    <P><B>end_table 
      115 holding knickknack/121 </B></P>
    <P><B>end_table 
      116 holding knickknack/120 tv/117 </B></P>
    <P><B>purchase extension 
      cord-table_lamp/north </B></P>
    <P><B>purchase extension 
      cord-tv/south </B></P>
    <P><B>Unplaced furniture:</B></P>
    <P><B>table_lamp-118</B></P>
    <P><B>chair-111</B></P>
  </DIR>
</DIR>
<h1><B> <a name="summary"></a>7.4 
  Summary </B></h1>
<P>A 
  combination of techniques can lead to a much cleaner representation of knowledge 
  for a particular problem. The Prolog code for each of the techniques can be 
  integrated relatively easily to provide a more complex system.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>7.1 
  - Integrate Clam with frames.</P>
<P> 
 
<P> </P>
 
<P>7.2 
  - Implement multiple rule sets as described in the chapter five exercises. Let 
  each rule set be either forward or backward chaining, and use the appropriate 
  inference engine for both.</P>
<P> 
 
<P> </P>
 
<P>7.3 
  - Build another expert system using Foops.</P>

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
