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
<td><h1>11 Prototyping</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>Whether 
  or not one is going to use Prolog to build a finished application, Prolog is 
  still a powerful tool for prototyping the application. The problem might fit 
  nicely into Clam or Foops in which case those systems should be used for the 
  prototype, otherwise pure Prolog can be used to model the application.</P>
<P>In 
  an expert system prototype it is important to model all of the different types 
  of knowledge that will be used in the application. Initial knowledge engineering 
  should be focused on what types of information the expert uses and how it is 
  used. The full range of expertise should be modelled, but not to the depth required 
  for a real system.</P>
<P>The 
  Prolog rules used in a prototype can be quickly molded to get the desired effects 
  in the application. The clean break between the inference engine and the knowledge 
  base can be somewhat ignored to allow more rapid development of the prototype. 
  Explanations, traces, and many of the other features of an expert system are 
  left out of the prototype. The I/O is implemented simply to just give a feeling 
  for the user interaction with the system. The full system can be more elegantly 
  designed once the prototype has been reviewed by the potential users.</P>
<h1><B> <a name="theproblem"></a>11.1 
  The Problem </B></h1>
<P>This 
  section describes the building of a prototype system which acts as an advisor 
  for a mainframe software salesperson. A good sales person must not only be congenial 
  and buy lunches, but must also have good product knowledge and know how to map 
  that knowledge onto a potential customer's needs. The type of knowledge needed 
  by the sales person is different from that typically held by a technical person.</P>
<P>The 
  technical person thinks of a product in terms of its features, and implementation 
  details. The sales person must think of the prospect's real and perceived needs 
  and be able to map those to benefits provided by the features in the product. 
  That is, the sales person must understand the prospect's objectives and be able 
  to present the benefits and features of the product that help meet those objectives.</P>
<P>The 
  salesperson must also have similar product knowledge about the competitor's 
  products and know which benefits to stress that will show up the weaknesses 
  in the competitor's product for the particular prospect.</P>
<P>In 
  addition to this product knowledge, the sales person also has rules for deciding 
  whether or not the prospect is likely to buy, and recognizing various typical 
  sales situations.</P>
<P>With 
  a large workload, it is often difficult for a sales person to keep up on product 
  knowledge. An expert system which helps the sales person position the products 
  for the prospect would be a big asset for a high tech sales person. The Sales 
  Advisor system is a prototype of such a system, designed to help in the early 
  stages of the sales cycle.</P>
<h1><B> <a name="thesalesadvisorknowledgebase"></a>11.2 
  The Sales Advisor Knowledge Base </B></h1>
<P>The 
  ways in which sales people mentally organize product knowledge are fairly consistent. 
  The knowledge base for the sales advisor should be organized in a format which 
  is as close to the sales person's organization of the knowledge as possible. 
  This way the semantic gap will be reduced and the knowledge base will be more 
  easily maintained by a domain expert.</P>
<P>The 
  main types of knowledge used by the salesperson fall into the following categories:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>???&#9;Qualification 
      - the way in which the salesperson determines if the prospect is a good 
      potential customer and worth pursuing;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;Objective 
      Benefit Feature (OBF) analysis - the way a salesperson matches the customer's 
      objectives with the benefits and features of the product;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;Competitive 
      analysis - the way a salesperson decides which benefits and features to 
      stress based on the competitor's weaknesses;</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;Situation 
      analysis - the way a salesperson determines if the products will run in 
      the prospect's shop.</P>
    <P> 
     
    <P> </P>
     
    <P>???&#9;Miscellaneous 
      advice - various rules covering different situations which do not fall neatly 
      in the above categories.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Having 
  this overall organization, we can now begin to prototype the system. The first 
  step is to design the knowledge base. Simple Prolog rules can be used wherever 
  possible. The knowledge for each area will be considered separately. The example 
  uses the products sold for mainframe computers by Cullinet Software.</P>
<h2 ALIGN="JUSTIFY"><B><a name="qualifying"></a>Qualifying</B></h2>
<P>First 
  we implement the knowledge for qualifying the prospect. This type of knowledge 
  falls easily into a rule format. The final version will probably need some uncertainty 
  handling as in Clam, but it is also important for this system to provide more 
  text output than Clam provides. The quickest way to build the prototype is to 
  use pure Prolog syntax rules with I/O statements included directly in the body 
  of the rule. Clam can be used later with modifications for better text display.</P>
<P>Two 
  examples of qualifying rules are: the prospect must have an IBM mainframe, and 
  the prospect's revenues must be at least $30 million. They are written as <B>unqualified</B> 
  since if the prospect fails a test then it is unqualified.</P>
<DIR> 
  <DIR> 
    <P><B>unqualified:-<BR>
      not computer('IBM'),<BR>
      advise('Prospect must have an IBM computer'),<BR>
      nl.</B></P>
    <P><B>unqualified:-<BR>
      revenues(X),<BR>
      X &lt; 30,<BR>
      advise('Prospect is unlikely to buy IDMS with revenues &#9;under $30 million'),<BR>
      nl.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="objectivesbenefitsfeatures"></a>Objectives 
  - Benefits - Features</B></h2>
<P>Sales 
  people typically store product knowledge in a tabular form called an objective-benefit-feature 
  chart, or OBF chart. It categorizes product knowledge so that for each objective 
  of the customer, the benefits of the product for meeting that objective, and 
  the features of the product are detailed.</P>
<P>For 
  the prototype we can simplify the prospect objectives by considering three main 
  ones: development of applications, building an information center, and building 
  efficient production systems. Each prospect might have a different one of these 
  objectives. The benefits of each product in the product line varies for each 
  of these objectives. This information is stored in Prolog structures of three 
  arguments called <B>obf</B>. The first argument is the feature (or product), 
  the second is the customer objective, and the third is the benefit which is 
  stressed to the prospect.</P>
<DIR> 
  <DIR> 
    <P><B>obf('IDMS/R',<BR>
      development,<BR>
      'IDMS/R separates programs from data, simplifying development.').</B></P>
    <P><B>obf('IDMS/R',<BR>
      information,<BR>
      'IDMS/R maintains corporate information for shared access.').</B></P>
    <P><B>obf('IDMS/R',<BR>
      production,<BR>
      'IDMS/R allows finely tuned data access for optimal performance.').</B></P>
    <P><B>obf('ADS',<BR>
      development,<BR>
      'ADS automates many programming tasks thus increasing productivity.').</B></P>
    <P><B>obf('ADS',<BR>
      production,<BR>
      'ADS generates high performance compiled code.').</B></P>
    <P><B>obf('OLQ',<BR>
      development,<BR>
      'OLQ allows easy validation of the database during development.').</B></P>
    <P><B>obf('OLQ',<BR>
      information, <BR>
      'OLQ lets end users access corporate data easily.').</B></P>
    <P><B>obf('OLE',<BR>
      information,<BR>
      'OLE lets users get information with English language queries.').</B></P>
  </DIR>
</DIR>
<P>By 
  using a chart such as this, the salesperson can stress only those features and 
  benefits which meet the prospect's objectives. For example, OLE (OnLine English 
  - a natural language query) would only be mentioned for an information center. 
  OLQ (OnLine Query - a structured query language) would be presented as a data 
  validation tool to a development shop, and as an end user query tool to an information 
  center.</P>
<P>This 
  knowledge could have been stored as rules of the form:</P>
<DIR> 
  <DIR> 
    <P><B>obf( 'OLE', 
      'OLE lets users get information in English') :-<BR>
      objective(information).</B></P>
  </DIR>
</DIR>
<P>This 
  type of rule is further away from the way in which the expert's understand the 
  knowledge. The structures are more natural to deal with, and the inference engine 
  can be easily modified to deal with what is really just a different format of 
  a rule.</P>
<h2 ALIGN="JUSTIFY"><B><a name="situationanalysis"></a>Situation 
  Analysis</B></h2>
<P>The 
  next key area is making sure that the products are compatible with the customer's 
  configuration. We wouldn't want to sell something that doesn't work. For example, 
  OLE would not run at the time on a small machine or under a DOS operating system.</P>
<DIR> 
  <DIR> 
    <P><B>unsuitable('OLE'):-<BR>
      operating_system(dos).</B></P>
    <P><B>unsuitable('OLE'):-<BR>
      machine_size(small).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="competitiveanalysis"></a>Competitive 
  Analysis</B></h2>
<P>A 
  good sales person will not directly attack the competition, but will use the 
  competition's weakness to advantage. This is done by stressing those aspects 
  of a product which highlight the competitor's weakness. That is, how can our 
  product be differentiated from the competitor's. For example, two of Cullinet's 
  main competitors were IBM and ADR. Both IBM and Cullinet provided systems that 
  performed well, but Cullinet's was easy to use, so ease of use was stressed 
  when the competitor was IBM. ADR's system was also easy to use, but did not 
  perform as well as Cullinet's, so against ADR performance was stressed.</P>
<DIR> 
  <DIR> 
    <P><B>prod_dif('IDMS/R', 
      'ADR',<BR>
      'IDMS/R allows specification of linked lists for high performance.').</B></P>
    <P><B>prod_dif('IDMS/R', 
      'IBM',<BR>
      'IDMS/R allows specification of indexed lists for easy access.').</B></P>
    <P><B>prod_dif('ADS', 
      'ADR',<BR>
      'ADS generates high performance code.').</B></P>
    <P><B>prod_dif('ADS', 
      'IBM',<BR>
      'ADS is very easy to use.').</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="miscellaneousadvice"></a>Miscellaneous 
  Advice</B></h2>
<P>Besides 
  this tabular data, there are also collections of miscellaneous rules for different 
  situations. For example, there were two TP monitors, UCF, and DC. One allowed 
  the user to use CICS for terminal networks, and the other provided direct control 
  of terminals. The recommendation would depend on the situation. Another example 
  is dealing with federal government prospects, which required help with the Washington 
  office as well. Another rule recommends a technical sales approach, rather than 
  the business oriented sell, for small shops that are not responding well.</P>
<DIR> 
  <DIR> 
    <P><B>advice:-<BR>
      not objective(production),<BR>
      tp_monitor('CICS'),<BR>
      online_applications(many),<BR>
      nl,<BR>
      advise(<BR>
      'Since there are many existing online applications and'), nl,<BR>
      advise(<BR>
      'performance isn''t an issue suggest UCF instead of DC'), nl.</B></P>
    <P><B>advice:-<BR>
      industry(government),<BR>
      government(federal),<BR>
      nl,<BR>
      advise(<BR>
      'If it's the federal government, make sure you work'),nl,<BR>
      advise(<BR>
      ' with our federal government office on the account'),nl.</B></P>
    <P><B>advice:-<BR>
      competition('ADR'),<BR>
      revenues(X),<BR>
      X &lt; 100,<BR>
      friendly_account(no),<BR>
      nl,<BR>
      advise(' Market database technical issues'),nl,<BR>
      advise(' Show simple solutions in shirt sleeve sessions' ), nl.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="userqueries"></a>User 
  Queries</B></h2>
<P>Finally, 
  the knowledge base contains a list of those items which will be obtained from 
  the user.</P>
<DIR> 
  <DIR> 
    <P><B>competition(X):-<BR>
      menuask('Who is the competition?',<BR>
      X, ['ADR', 'IBM', 'other']).</B></P>
    <P><B>computer(X):-<BR>
      menuask('What type of computer are they using?',<BR>
      X, ['IBM', 'other']).</B></P>
    <P><B>friendly_account(X):-<BR>
      menuask('Has the account been friendly?',<BR>
      X, [yes, no]).</B></P>
    <P><B>government(X):-<BR>
      menuask('What type of government account is it?',<BR>
      X, [federal, state, local]).</B></P>
    <P><B>industry(X):-<BR>
      menuask('What industry segment?',<BR>
      X, ['manufacturing', 'government', 'other']).</B></P>
    <P><B>machine_size(X):-<BR>
      menuask('What size machine are they using?',<BR>
      X, [small, medium, large]).</B></P>
    <P><B>objective(X):- 
      <BR>
      menuask('What is the main objective for looking at DBMS?',<BR>
      X, ['development', 'information', 'production']).</B></P>
    <P><B>online_applications(X):-<BR>
      menuask('Are there many existing online applications?',<BR>
      X, [many, few]).</B></P>
    <P><B>operating_system(X):-<BR>
      menuask('What operation system are they using?',<BR>
      X, ['OS', 'DOS']).</B></P>
    <P><B>revenues(X):-<BR>
      ask('What are their revenues (in millions)?',X).</B></P>
    <P><B>tp_monitor(X):-<BR>
      menuask('What is their current TP monitor?',<BR>
      X, ['CICS', 'other']).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="theinferenceengine"></a>11.3 
  The Inference Engine </B></h1>
<P>Now 
  that a knowledge base has been designed, which has a reasonably small semantic 
  gap with the expert's knowledge, the inference engine can be written. For the 
  prototype, some of the knowledge is more easily stored in the inference engine. 
  The high level order of goals to seek is stored in the main predicate, <B>recommend</B>.</P>
<DIR> 
  <DIR> 
    <P><B>recommend:-<BR>
      qualify,<BR>
      objective_products,<BR>
      product_differentiation,<BR>
      other_advice, !.</B></P>
    <P><B>recommend.</B></P>
  </DIR>
</DIR>
<P>First, 
  the prospect is qualified. The <B>qualify</B> predicate checks to make sure 
  there are no unqualified rules which fire.</P>
<DIR> 
  <DIR> 
    <P><B>qualify:-<BR>
      unqualified, <BR>
      !, fail.</B></P>
    <P><B>qualify.</B></P>
  </DIR>
</DIR>
<P>The<B> 
  objective_products</B> predicate uses the user's objectives and the OBF chart 
  to recommend which products to sell and which benefits to present. It makes 
  use of the <B>unsuitable</B> rules to ensure no products are recommended which 
  will not work in the customer's shop.</P>
<DIR> 
  <DIR> 
    <P><B>objective_products:-<BR>
      objective(X), <BR>
      advise('The following products meet objective'), <BR>
      advise(X),nl,nl,<BR>
      obf(Product, X, Benefit),<BR>
      not unsuitable(Product),<BR>
      advise(Product:Benefit),nl,<BR>
      fail.</B></P>
    <P><B>objective_products.</B></P>
  </DIR>
</DIR>
<P>Next, 
  the product differentiation table is used in a similar fashion.</P>
<DIR> 
  <DIR> 
    <P> <B>product_differentiation:-<BR>
      competition(X),<BR>
      prod_dif(_,X,_), </b><BR>
      <B>advise('Since the competition is '), advise(X),<BR>
      advise(', stress:'),nl,nl,<BR>
      product_diff(X), !.</b></P>
    <P><B>product_differentiation.</B></P>
    <P><B>product_diff(X):-<BR>
      prod_dif(Prod, X, Advice),<BR>
      tab(5), advise(Advice), nl,<BR>
      fail.</B></P>
    <P><B>product_diff(_).</B></P>
  </DIR>
</DIR>
<P>Finally, 
  the other advice rules are all tried.</P>
<DIR> 
  <DIR> 
    <P><B>other_advice:-<BR>
      advice,<BR>
      fail.</B></P>
    <P><B>other_advice.</B></P>
  </DIR>
</DIR>
<h1><B> <a name="userinterface"></a>11.4 
  User Interface </B></h1>
<P>For 
  a prototype, the user interface is still a key point. The system will be looking 
  for supporters inside an organization, and it must be easy for people to understand 
  the system. The windowing environment makes it relatively easy to put together 
  a reasonable interface.</P>
<P> 
 
<P> </P>
 
<P ALIGN="CENTER"><BR>
  <IMG SRC="prototyping11-1.gif" WIDTH=375 HEIGHT=239><BR>
  </P>
<P>Figure 
  11.1. User interface of sales advisor prototype</P>
<P>For 
  this example, one display window is used for advice near the top of the screen, 
  and a smaller window near the bottom is used for questions to the user. Pop-up 
  menus and prompter windows are used to gather information from the user. Figure 
  11.1 shows the user interface.</P>
<P>The 
  two display windows are defined at the beginning of the session.</P>
<DIR> 
  <DIR> 
    <P><B>window_init:-<BR>
      window(advice, create, [type(display), coord(1,1,10,78),</B></P>
    <P><B> border(blue:white), 
      contents(blue:white)]),<BR>
      window(quest, create, [type(display), coord(13,10,13,70),</B></P>
    <P><B> border(blue:white), 
      contents(blue:white)]).</B></P>
  </DIR>
</DIR>
<P>The 
  prompt and pop-up menu windows are defined dynamically as they are needed. The 
  <B>ask</B> and <B>menuask</B> predicates work as in other examples. Here are 
  the clauses that interface with the user.</P>
<DIR> 
  <DIR> 
    <P><B>ask(A,V):-<BR>
      window(quest,write,A),<BR>
      window([type(prompt),coord(16,10,16,70),border(white:blue),<BR>
      contents(white:blue)], read, ['', Y]), <BR>
      asserta(known(A,Y)), <BR>
      Y = V.</B></P>
    <P><B>menuask(Attribute,AskValue,Menu):-<BR>
      length(Menu,L),<BR>
      R1 = 16,<BR>
      R2 is R1 + L - 1,<BR>
      window(quest,write,Attribute),<BR>
      window([type(menu),coord(R1,10,R2,40),border(white:blue),<BR>
      contents(white:blue),menu(Menu)], read, AnswerValue),<BR>
      asserta(known(Attribute,AnswerValue)),<BR>
      AskValue = AnswerValue.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>advise</B> predicate uses the predefined display window, <B>advice</B>.</P>
<DIR> 
  <DIR> 
    <P><B>advise([H|T]):- 
      window(advice,writeline,[H|T]),!.</B></P>
    <P><B>advise(X):- 
      window(advice,write,X).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="summary"></a>11.5 
  Summary </B></h1>
<P>One 
  can model a fairly complex domain relatively quickly in Prolog, using the tools 
  available. A small semantic gap on the knowledge base, and good user interface 
  are two very important points in the prototype.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>11.1 - Prototype 
  an expert system which plays poker or some similar game. It will need to be 
  specialized to understand the particular knowledge of the game. Experiment with 
  the prototype to find the best type of user interface and dialog with the system.</P>


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
