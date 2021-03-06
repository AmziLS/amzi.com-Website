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
<td><h1>2 Using Prolog's Inference Engine</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />


<P>Prolog 
  has a built-in backward chaining inference engine which can be used to partially 
  implement some expert systems. Prolog rules are used for the knowledge representation, 
  and the Prolog inference engine is used to derive conclusions. Other portions 
  of the system, such as the user interface, must be coded using Prolog as a programming 
  language.</P>
<P>The 
  Prolog inference engine does simple backward chaining. Each rule has a goal 
  and a number of sub-goals. The Prolog inference engine either proves or disproves 
  each goal. There is no uncertainty associated with the results.</P>
<P>This 
  rule structure and inference strategy is adequate for many expert system applications. 
  Only the dialog with the user needs to be improved to create a simple expert 
  system. These features are used in this chapter to build a sample application 
  called, "Birds, " which identifies birds.</P>
<P>In 
  the later portion of this chapter the Birds system is split into two modules. 
  One contains the knowledge for bird identification, and the other becomes "Native, 
  " the first expert system shell developed in the book. Native can then be used 
  to implement other similar expert systems.</P>
<h1><B> <a name="thebirdidentificationsystem"></a>2.1 
  The Bird Identification System </B></h1>
<P>A 
  system which identifies birds will be used to illustrate a native Prolog expert 
  system. The expertise in the system is a small subset of that contained in <I>Birds 
  of North America</I> by Robbins, Bruum, Zim, and Singer. The rules of the system 
  were designed to illustrate how to represent various types of knowledge, rather 
  than to provide accurate identification.</P>
<h2 ALIGN="JUSTIFY"><B><a name="ruleformats"></a>Rule 
  formats</B></h2>
<P>The 
  rules for expert systems are usually written in the form:</P>
<DIR> 
  <DIR> 
    <P><B>IF<BR>
      first premise, and<BR>
      second premise, and<BR>
      ...</B></P>
    <P><B>THEN<BR>
      conclusion</B></P>
  </DIR>
</DIR>
<P>The 
  IF side of the rule is referred to as the left hand side (LHS), and the THEN 
  side is referred to as the right hand side (RHS). This is semantically the same 
  as a Prolog rule:</P>
<DIR> 
  <DIR> 
    <P><B>conclusion 
      :-<BR>
      first_premise, <BR>
      second_premise, <BR>
      ...</B></P>
  </DIR>
</DIR>
<P>Note 
  that this is a bit confusing since the syntax of Prolog is really THEN IF, and 
  the normal RHS and LHS appear on opposite sides.</P>
<h2 ALIGN="JUSTIFY"><B><a name="rulesaboutbirds"></a>Rules 
  about birds</B></h2>
<P>The 
  most fundamental rules in the system identify the various species of birds. 
  We can begin to build the system immediately by writing some rules. Using the 
  normal IF THEN format, a rule for identifying a particular albatross is:</P>
<DIR> 
  <DIR> 
    <P><B>IF<BR>
      family is albatross and<BR>
      color is white</B></P>
    <P><B>THEN<BR>
      bird is laysan_albatross</B></P>
  </DIR>
</DIR>
<P>In 
  Prolog the same rule is:</P>
<DIR> 
  <DIR> 
    <P><B>bird(laysan_albatross) 
      :-<BR>
      family(albatross), <BR>
      color(white).</B></P>
  </DIR>
</DIR>
<P>The 
  following rules distinguish between two types of albatross and swan. They are 
  clauses of the predicate <B>bird/1</B>:</P>
<DIR> 
  <DIR> 
    <P><B>bird(laysan_albatross):-<BR>
      family(albatross), <BR>
      color(white).</B></P>
    <P><B>bird(black_footed_albatross):-<BR>
      family(albatross), <BR>
      color(dark).</B></P>
    <P><B>bird(whistling_swan) 
      :-<BR>
      family(swan), <BR>
      voice(muffled_musical_whistle).</B></P>
    <P><B>bird(trumpeter_swan) 
      :-<BR>
      family(swan), <BR>
      voice(loud_trumpeting).</B></P>
  </DIR>
</DIR>
<P>In 
  order for these rules to succeed in distinguishing the two birds, we would have 
  to store facts about a particular bird that needed identification in the program. 
  For example if we added the following facts to the program:</P>
<DIR> 
  <DIR> 
    <P><B>family(albatross).</B></P>
    <P><B>color(dark).</B></P>
  </DIR>
</DIR>
<P>then 
  the following query could be used to identify the bird:</P>
<DIR> 
  <DIR> 
    <P><B>?- bird(X).</B></P>
    <P><B>X = black_footed_albatross</B></P>
  </DIR>
</DIR>
<P>Note 
  that at this very early stage there is a complete working Prolog program which 
  functions as an expert system to distinguish between these four birds. The user 
  interface is the Prolog interpreter's interface, and the input data is stored 
  directly in the program.</P>
<h2 ALIGN="JUSTIFY"><B><a name="rulesforhierarchicalrelationships"></a>Rules 
  for hierarchical relationships</B></h2>
<P>The 
  next step in building the system would be to represent the natural hierarchy 
  of a bird classification system. These would include rules for identifying the 
  family and the order of a bird. Continuing with the albatross and swan lines, 
  the predicates for <B>order</B> and <B>family</B> are:</P>
<DIR> 
  <DIR> 
    <P><B>order(tubenose) 
      :-<BR>
      nostrils(external_tubular), <BR>
      live(at_sea), <BR>
      bill(hooked).</B></P>
    <P><B>order(waterfowl) 
      :-<BR>
      feet(webbed), <BR>
      bill(flat).</B></P>
    <P><B>family(albatross) 
      :-<BR>
      order(tubenose), <BR>
      size(large), <BR>
      wings(long_narrow).</B></P>
    <P><B>family(swan) 
      :-<BR>
      order(waterfowl), <BR>
      neck(long), <BR>
      color(white), <BR>
      flight(ponderous).</B></P>
  </DIR>
</DIR>
<P>Now 
  the expert system will identify an albatross from more fundamental observations 
  about the bird. In the first version, the predicate for <B>family</B> was implemented 
  as a simple fact. Now <B>family</B> is implemented as a rule. The facts in the 
  system can now reflect more primitive data:</P>
<DIR> 
  <DIR> 
    <P><B>nostrils(external_tubular).</B></P>
    <P><B>live(at_sea).</B></P>
    <P><B>bill(hooked).</B></P>
    <P><B>size(large).</B></P>
    <P><B>wings(long_narrow).</B></P>
    <P><B>color(dark).</B></P>
  </DIR>
</DIR>
<P>The 
  same query still identifies the bird:</P>
<DIR> 
  <DIR> 
    <P><B>?- bird(X).</B></P>
    <P><B>X = black_footed_albatross</B></P>
  </DIR>
</DIR>
<P>So 
  far the rules for birds just reflect the attributes of various birds, and the 
  hierarchical classification system. This type of organization could also be 
  handled in more conventional languages as well as in Prolog or some other rule-based 
  language. Expert systems begin to give advantages over other approaches when 
  there is no clear hierarchy, and the organization of the information is more 
  chaotic.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="usingprolog2-1.gif" WIDTH=427 HEIGHT=296><BR>
  </P>
<P>Figure 
  2.1. Relationships between some of the rules in the Bird identification system</P>
<h2 ALIGN="JUSTIFY"><B><a name="rulesforotherrelationships"></a>Rules 
  for other relationships</B></h2>
<P>The 
  Canada goose can be used to add some complexity to the system. Since it spends 
  its summers in Canada, and its winters in the United States, its identification 
  includes where it was seen and in what season. Two different rules would be 
  needed to cover these two situations:</P>
<DIR> 
  <DIR> 
    <P><B>bird(canada_goose):-<BR>
      family(goose), <BR>
      season(winter), <BR>
      country(united_states), <BR>
      head(black), <BR>
      cheek(white).</B></P>
    <P><B>bird(canada_goose):-<BR>
      family(goose), <BR>
      season(summer), <BR>
      country(canada), <BR>
      head(black), <BR>
      cheek(white).</B></P>
  </DIR>
</DIR>
<P>These 
  goals can refer to other predicates in a different hierarchy:</P>
<DIR> 
  <DIR> 
    <P><B>country(united_states):- 
      region(mid_west).</B></P>
    <P><B>country(united_states):- 
      region(south_west).</B></P>
    <P><B>country(united_states):- 
      region(north_west).</B></P>
    <P><B>country(united_states):- 
      region(mid_atlantic).</B></P>
    <P><B>country(canada):- 
      province(ontario).</B></P>
    <P><B>country(canada):- 
      province(quebec).</B></P>
    <P><B>region(new_england):-<BR>
      state(X), <BR>
      member(X, [massachusetts, vermont, </b>....<B>]).</b></P>
    <P> <B>region(south_east):-<BR>
      state(X), <BR>
      member(X, [florida, mississippi, </b>....<B>]).</b></P>
  </DIR>
</DIR>
<P>There 
  are other birds that require multiple rules for the different characteristics 
  of the male and female. For example the male mallard has a green head, and the 
  female is mottled brown.</P>
<DIR> 
  <DIR> 
    <P><B>bird(mallard):-<BR>
      family(duck), <BR>
      voice(quack), <BR>
      head(green).</B></P>
    <P><B>bird(mallard):-<BR>
      family(duck), <BR>
      voice(quack), <BR>
      color(mottled_brown).</B></P>
  </DIR>
</DIR>
<P>Figure 
  2.1 shows some of the relationships between the rules to identify birds.</P>
<P>Basically, 
  any kind of identification situation from a bird book can be easily expressed 
  in Prolog rules. These rules form the knowledge base of an expert system. The 
  only drawback to the program is the user interface, which requires the data 
  to be entered into the system as facts.</P>
<h1><B> <a name="userinterface"></a>2.2 
  User Interface </B></h1>
<P>The 
  system can be dramatically improved by providing a user interface which prompts 
  for information when it is needed, rather than forcing the user to enter it 
  beforehand. The predicate <B>ask</B> will provide this function.</P>
<h2 ALIGN="JUSTIFY"><B><a name="attributevaluepairs"></a>Attribute 
  Value pairs</B></h2>
<P>Before 
  looking at <B>ask</B>, it is necessary to understand the structure of the data 
  which will be asked about. All of the data has been of the form: "attribute-value". 
  For example, a bird is a mallard if it has the following values for these selected 
  bird attributes:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <DIR> 
      <P><B>Attribute</b>&#9;<B>Value</b></P>
      <P> 
       
      <P> </P>
       
      <P>family&#9;duck</P>
      <P>voice&#9;quack</P>
      <P>head&#9;green</P>
      <P> 
       
      <P> </P>
       </DIR>
  </DIR>
</DIR>
<P>This 
  is one of the simplest forms of representing data in an expert system, but is 
  sufficient for many applications. More complex representations can have "object-attribute-value" 
  triples, where the attribute-values are tied to various objects in the system. 
  Still more complex information can be associated with an object and this will 
  be covered in the chapter on frames. For now the simple attribute-value data 
  model will suffice.</P>
<P>This 
  data structure has been represented in Prolog by predicates which use the predicate 
  name to represent the attribute, and a single argument to represent the value. 
  The rules refer to attribute-value pairs as conditions to be tested in the normal 
  Prolog fashion. For example, the rule for mallard had the condition <B>head(green) 
  </B> in the rule.</P>
<P>Of 
  course since we are using Prolog, the full richness of Prolog's data structures 
  could be used, as in fact list membership was used in the rules for <B>region</B>. 
  The final chapter discusses a system which makes full use of Prolog throughout 
  the system. However, the basic attribute-value concept goes a long way for many 
  expert systems, and using it consistantly makes the implementation of features 
  such as the user interface easier.</P>
<h2 ALIGN="JUSTIFY"><B><a name="askingtheuser"></a>Asking 
  the user</B></h2>
<P>The 
  <B>ask</B> predicate will have to determine from the user whether or not a given 
  attribute-value pair is true. The program needs to be modified to specify which 
  attributes are askable. This is easily done by making rules for those attributes 
  which call <B>ask</B>.</P>
<DIR> 
  <DIR> 
    <P><B>eats(X):- 
      ask(eats, X).</B></P>
    <P><B>feet(X):- 
      ask(feet, X).</B></P>
    <P><B>wings(X):- 
      ask(wings, X).</B></P>
    <P><B>neck(X):- 
      ask(neck, X).</B></P>
    <P><B>color(X):- 
      ask(color, X).</B></P>
  </DIR>
</DIR>
<P>Now 
  if the system has the goal of finding <B>color(white)</B> it will call <B>ask</B>, 
  rather than look in the program. If <B>ask(color, white)</B> succeeds, <B>color(white)</B> 
  succeeds.</P>
<P>The 
  simplest version of <B>ask</B> prompts the user with the requested attribute 
  and value and seeks confirmation or denial of the proposed information. The 
  code is:</P>
<DIR> 
  <DIR> 
    <P><B>ask(Attr, 
      Val):-<BR>
      write(Attr:Val), <BR>
      write('? '), <BR>
      read(yes).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>read</B> will succeed if the user answers "yes", and fail if the user types 
  anything else. Now the program can be run without having the data built into 
  the program. The same query to <B>bird</B> starts the program, but now the user 
  is responsible for determining whether some of the attribute-values are true. 
  The following dialog shows how the system runs:</P>
<DIR> 
  <DIR> 
    <P><B>?- bird(X).</B></P>
    <P>nostrils : external_tubular? 
      <B> yes.</b></P>
    <P>live : at_sea? 
      <B>yes.</b></P>
    <P>bill : hooked? 
      <B>yes.</b></P>
    <P>size : large? 
      <B>yes.</b></P>
    <P>wings : long_narrow? 
      <B>yes.</b></P>
    <P>color : white? 
      <B>yes.</b></P>
    <P><B>X = laysan_albatross</B></P>
  </DIR>
</DIR>
<P>There 
  is a problem with this approach. If the user answered "no" to the last question, 
  then the rule for <B>bird(laysan_albatross)</B> would have failed and backtracking 
  would have caused the next rule for <B>bird(black_footed_albatross)</B> to be 
  tried. The first subgoal of the new rule causes Prolog to try to prove <B>family(albatross)</B> 
  again, and ask the same questions it already asked. It would be better if the 
  system remembered the answers to questions and did not ask again.</P>
<h2 ALIGN="JUSTIFY"><B><a name="rememberingtheanswer"></a>Remembering 
  the answer</B></h2>
<P>A 
  new predicate, <B>known/3</B> is used to remember the user's answers to questions. 
  It is not specified directly in the program, but rather is dynamically <B>assert</B>ed 
  whenever <B>ask</B> gets new information from the user.</P>
<P>Every 
  time <B>ask</B> is called it first checks to see if the answer is already <B>known</B> 
  to be yes or no. If it is not already <B>known</B>, then <B>ask</B> will <B>assert</B> 
  it after it gets a response from the user. The three arguments to <B>known</B> 
  are: yes/no, attribute, and value. The new version of <B>ask</B> looks like:</P>
<DIR> 
  <DIR> 
    <P> <B>ask(A, V):-<BR>
      known(yes, A, V), &#9;&#9;</b>% succeed if true<BR>
      <B>!.&#9;&#9;&#9;&#9;</B>% stop looking </P>
    <P> <B>ask(A, V):-<BR>
      known(_, A, V), &#9;&#9;</b>% fail if false<BR>
      <B>!, fail.</b></P>
    <P> <B>ask(A, V):-<BR>
      write(A:V), &#9;&#9;&#9;</b>% ask user<B><BR>
      write('? : '), <BR>
      read(Y), &#9;&#9;&#9;</B>% get the answer<B><BR>
      asserta(known(Y, A, V)), &#9;</B>% remember it<BR>
      <B>Y == yes.&#9;&#9;&#9;</B>% succeed or fail</P>
  </DIR>
</DIR>
<P>The 
  cuts in the first two rules prevent <B>ask</B> from backtracking after it has 
  already determined the answer.</P>
<h2 ALIGN="JUSTIFY"><B><a name="multivaluedanswers"></a>Multi-valued 
  answers</B></h2>
<P>There 
  is another level of subtlety in the approach to <B>known</B>. The <B>ask</B> 
  predicate now assumes that each particular attribute value pair is either true 
  or false. This means that the user could respond with a "yes" to both color:white 
  and color:black. In effect, we are letting the attributes be multi-valued. This 
  might make sense for some attributes such as <B>voice</B> but not others such 
  as <B>bill</B>, which only take a single value.</P>
<P>The 
  best way to handle this is to add an additional predicate to the program which 
  specifies which attributes are multi-valued: </P>
<DIR> 
  <DIR> 
    <P><B> multivalued(voice).<BR>
      multivalued(feed).</B></P>
  </DIR>
</DIR>
<P>A 
  new clause is now added to <B>ask</B> to cover the case where the attribute 
  is not multi-valued (therefor single-valued) and already has a different value 
  from the one asked for. In this case <B>ask</B> should fail. For example, if 
  the user has already answered yes to <B>size - large</B> then <B>ask</B> should 
  automatically fail a request for <B>size - small</B> without asking the user. 
  The new clause goes before the clause which actually asks the user:</P>
<DIR> 
  <DIR> 
    <P><B> ask(A, V):-<BR>
      &#9;not multivalued(A), <BR>
      &#9;known(yes, A, V2), <BR>
      &#9;V \== V2, <BR>
      &#9;!, fail.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="menusfortheuser"></a>Menus 
  for the user</B></h2>
<P>The 
  user interface can further be improved by adding a menu capability which gives 
  the user a list of possible values for an attribute. It can further enforce 
  that the user enter a value on the menu.</P>
<P>This 
  can be implemented with a new predicate, <B>menuask</B>. It is similar to <B>ask</B>, 
  but has an additional argument which contains a list of possible values for 
  the attribute. It would be used in the program in an analogous fashion to <B>ask</B>:</P>
<DIR> 
  <DIR> 
    <P><B>size(X):- 
      menuask(size, X, [large, plump, medium, small]).</B></P>
    <P><B>flight(X):- 
      menuask(flight, X, [ponderous, agile, flap_glide]).</B></P>
  </DIR>
</DIR>
<P>The<B> 
  menuask</B> predicate can be implemented using either a sophisticated windowing 
  interface, or by simply listing the menu choices on the screen for the user. 
  When the user returns a value it can be verified, and the user reprompted if 
  it is not a legal value.</P>
<P>A 
  simple implementation would have initial clauses as in <B>ask</B>, and have 
  a slightly different clause for actually asking the user. That last clause of 
  <B>menuask</B> might look like:</P>
<DIR> 
  <DIR> 
    <P><B>menuask(A, 
      V, MenuList) :-<BR>
      write('What is the value for'), write(A), write('?'), nl, <BR>
      write(MenuList), nl, <BR>
      read(X), <BR>
      check_val(X, A, V, MenuList), <BR>
      asserta( known(yes, A, X) ), <BR>
      X == V.</B></P>
    <P><B>check_val(X, 
      A, V, MenuList) :-<BR>
      member(X, MenuList), !.</B></P>
    <P><B>check_val(X, 
      A, V, MenuList) :-<BR>
      write(X), write(' is not a legal value, try again.'), nl, <BR>
      menuask(A, V, MenuList).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>check_val</B> predicate validates the user's input. In this case the test 
  ensures the user entered a value on the list. If not, it retries the <B>menuask</B> 
  predicate.</P>
<h2 ALIGN="JUSTIFY"><B><a name="otherenhancements"></a>Other 
  enhancements</B></h2>
<P>Other 
  enhancements can also be made to allow for more detailed prompts to the user, 
  and other types of input validation. These can be included as other arguments 
  to <B>ask</B>, or embodied in other versions of the <B>ask</B> predicate. Chapter 
  10 gives other examples along these lines.</P>
<h1><B> <a name="asimpleshell"></a>2.3 
  A Simple Shell </B></h1>
<P>The 
  bird identification program has two distinct parts: the knowledge base, which 
  contains the specific information about bird identification; and the predicates 
  which control the user interface.</P>
<P>By 
  separating the two parts, a shell can be created which can be used with any 
  other knowledge base. For example, a new expert system could be written which 
  identified fish. It could be used with the same user interface code developed 
  for the bird identification system.</P>
<P>The 
  minimal change needed to break the two parts into two modules is a high level 
  predicate which starts the identification process. Since in general it is not 
  known what is being identified, the shell will seek to solve a generic predicate 
  called <B>top_goal</B>. Each knowledge base will have to have a <B>top_goal</B> 
  which calls the goal to be satisfied. For example:</P>
<DIR> 
  <DIR> 
    <P><B> top_goal(X) 
      :- bird(X).</B></P>
  </DIR>
</DIR>
<P>This 
  is now the first predicate in the knowledge base about birds.</P>
<P>The 
  shell has a predicate called <B>solve</B>, which does some housekeeping and 
  then solves for the <B>top_goal</B>. It looks like:</P>
<DIR> 
  <DIR> 
    <P><B>solve :-<BR>
      abolish(known, 3), <BR>
      define(known, 3), <BR>
      top_goal(X), <BR>
      write('The answer is '), write(X), nl.</B></P>
    <P><B>solve :-<BR>
      write('No answer found.'), nl.</B></P>
  </DIR>
</DIR>
<P>The 
  built-in <B>abolish</B> predicate is used to remove any previous <B>known</B>s 
  from the system when a new consultation is started. This allows the user to 
  call <B>solve</B> multiple times in a single session.</P>
<P>The 
  <B>abolish</B> and <B>define</B> predicates are built-in predicates which respectively 
  remove previous <B>known</B>s for a new consultation, and ensure that <B>known</B> 
  is defined to the system so no error condition is raised the first time it is 
  referenced. Different dialects of Prolog might require different built-in predicate 
  calls.</P>
<P>In 
  summary, the predicates of the bird identification system have been divided 
  into two modules. The predicates which are in the shell called Native, are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>solve</b> 
      - starts the consultation;</P>
    <P> 
     
    <P> </P>
     
    <P><B>ask</b> 
      - poses simple questions to the users and remembers the answers;</P>
    <P> 
     
    <P> </P>
     
    <P><B>menuask</b> 
      - presents the user with a menu of choices;</P>
    <P> 
     
    <P> </P>
     
    <P>supporting 
      predicates for the above three predicates.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  predicates which are in the knowledge base are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>top_goal</b> 
      - specifies the top goal in the knowledge base;</P>
    <P> 
     
    <P> </P>
     
    <P>rules 
      for identifying or selecting whatever it is the knowledge base was built 
      for (for example <B>bird</B>, <B>order</B>, <B>family</B>, and <B>region)</B>;</P>
    <P> 
     
    <P> </P>
     
    <P>rules 
      for attributes which must be user supplied (for example <B>size</B>, <B>color</B>, 
      <B>eats</B>, and <B>wings);</b></P>
    <P> 
     
    <P> </P>
     
    <P><B>multivalued</b> 
      - defines which attributes might have multiple values.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>To 
  use this shell with a Prolog interpreter, both the shell and the birds knowledge 
  base must be consulted. Then the query for <B>solve</B> is started.</P>
<DIR> 
  <DIR> 
    <P><B>?- consult(native).</B></P>
    <P>yes</P>
    <P><B>?- consult('birds.kb').</B></P>
    <P>yes</P>
    <P><B>?- solve.</B></P>
    <P>nostrils : external_tubular? 
      </P>
    <P>...</P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="commandloop"></a>Command 
  loop</B></h2>
<P>The 
  shell can be further enhanced to have a top level command loop called <B>go</B>. 
  To begin with, <B>go</B> should recognize three commands:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>load</b> 
      - Load a knowledge base.</P>
    <P> 
     
    <P> </P>
     
    <P><B>consult</b> 
      - Consult the knowledge base by satisfying the top goal of the knowledge 
      base.</P>
    <P> 
     
    <P> </P>
     
    <P><B>quit</b> 
      - Exit from the shell.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  <B>go</B> predicate will also display a greeting and give the user a prompt 
  for a command. After reading a command, <B>do</B> is called to execute the command. 
  This allows the command names to be different from the actual Prolog predicates 
  which execute the command. For example, the common command for starting an inference 
  is <B>consult</B>, however <B>consult</B> is the name of a built-in predicate 
  in Prolog. This is the code:</P>
<DIR> 
  <DIR> 
    <P><B>go :-<BR>
      greeting, <BR>
      repeat, <BR>
      write('&gt; '), <BR>
      read(X), <BR>
      do(X), <BR>
      X == quit.</B></P>
    <P><B>greeting :-<BR>
      write('This is the Native Prolog shell.'), nl, <BR>
      write('Enter load, consult, or quit at the prompt.'), nl.</B></P>
    <P><B>do(load) :- 
      load_kb, !.</B></P>
    <P><B>do(consult) 
      :- solve, !.</B></P>
    <P><B>do(quit).</B></P>
    <P><B>do(X) :-<BR>
      write(X), <BR>
      write('is not a legal command.'), nl, <BR>
      fail.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>go</B> predicate uses a repeat fail loop to continue until the user enters 
  the command <B>quit</B>. The <B>do</B> predicate provides an easy mechanism 
  for linking the user's commands to the predicates which do the work in the program. 
  The only new predicate is <B>load_kb</B> which reconsults a knowledge base. 
  It looks like:</P>
<DIR> 
  <DIR> 
    <P><B>load_kb :-<BR>
      write('Enter file name: '), <BR>
      read(F), <BR>
      reconsult(F).</B></P>
  </DIR>
</DIR>
<P>Two 
  other commands which could be added at this point are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>help</b> 
      - provide a list of legal commands;</P>
    <P> 
     
    <P> </P>
     
    <P><B>list</b> 
      - list all of the <B>known</B>s derived during the consultation (useful 
      for debugging).</P>
  </DIR>
</DIR>
<P ALIGN="CENTER"><BR>
  <IMG SRC="usingprolog2-2.gif" WIDTH=344 HEIGHT=393><BR>
  </P>
<P>Figure 
  2.2. Major predicates of Native Prolog shell</P>
<P>This 
  new version of the shell can either be run from the interpreter as before, or 
  compiled and executed. The load command is used to load the knowledge base for 
  use with the compiled shell. The exact interaction between compiled and interpreted 
  Prolog varies from implementation to implementation. Figure 2.2 shows the architecture 
  of the Native shell.</P>
<P>Using 
  an interpreter the system would run as follows:</P>
<DIR> 
  <DIR> 
    <P><B>?- consult(native).</B></P>
    <P>yes</P>
    <P><B>?- go.</B></P>
    <P>This is the native 
      Prolog shell.</P>
    <P>Enter load, consult, 
      or quit at the prompt.</P>
    <P><B>&gt;load.</B></P>
    <P>Enter file name:<B> 
      'birds.kb'.</b></P>
    <P><B>&gt;consult.</B></P>
    <P>nostrils : external_tubular 
      ?<B> yes.</b></P>
    <P><B>...</B></P>
    <P>The answer is 
      black_footed_albatross</P>
    <P><B>&gt;quit.</B></P>
    <P><B>?-</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="atoolfornonprogrammers"></a>A 
  tool for non-programmers</B></h2>
<P>There 
  are really two levels of Prolog, one which is very easy to work with, and one 
  which is a little more complex.</P>
<P>The 
  first level is Prolog as a purely declarative rule based language. This level 
  of Prolog is easy to learn and use. The rules for bird identification are all 
  formulated with this simple level of understanding of Prolog.</P>
<P>The 
  second level of Prolog requires a deeper understanding of backtracking, unification, 
  and built-in predicates. This level of understanding is needed for the shell.</P>
<P>By 
  breaking the shell apart from the knowledge base, the code has also been divided 
  along these two levels. Even though the knowledge base is in Prolog, it only 
  requires the high level understanding of Prolog. The more difficult parts are 
  hidden in the shell.</P>
<P>This 
  means the knowledge base can be understood with only a little training by an 
  individual who is not a Prolog programmer. In other words, once the shell is 
  hidden from the user, this becomes an expert system tool that can be used with 
  very little training.</P>
<h1><B> <a name="summary"></a>2.4 
  Summary </B></h1>
<P>The 
  example shows that Prolog's native syntax can be used as a declarative language 
  for the knowledge representation of an expert system. The rules lend themselves 
  to solving identification and other types of selection problems that do not 
  require dealing with uncertainty.</P>
<P>The 
  example has also shown that Prolog can be used as a development language for 
  building the user interface of an expert system shell. In this case Prolog is 
  being used as a full programming language.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>2.1 
  - In Native, implement commands to provide help and to list the current "known"s.</P>
<P> 
 
<P> </P>
 
<P>2.2 
  - Have <B>menuask</B> print a numbered list of items and let the user just enter 
  the number of the chosen item.</P>
<P> 
 
<P> </P>
 
<P>2.3 
  - Modify both <B>ask</B> and <B>menuask</B> to recognize input from the user 
  which is a command, execute the command, and then re-ask the question.</P>
<P> 
 
<P> </P>
 
<P>2.4 
  - Add a prompt field to <B>ask</B> which allows for a longer question for an 
  attribute.</P>
<P> 
 
<P> </P>
 
<P>2.5 
  - Modify the system to handle attribute-object-value triples as well as attribute-value 
  pairs. For example, rules might have goals such as <B>color(head, green)</B>, 
  <B>color(body, green)</B>, <B>length(wings, long)</B>, and <B>length(tail, short)</B>. 
  Now <B>ask</B> will prompt with both the object and the attribute as in "head 
  color?". This change will lead to a more natural representation of some of the 
  knowledge in a system as well as reducing the number of attributes.</P>
<P> 
 
<P> </P>
 
<P>2.6 
  - Use the Native shell to build a different expert system. Note any difficulties 
  in implementing the system and features which would have made it easier.</P>

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
