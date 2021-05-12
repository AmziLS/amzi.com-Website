<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Logical Knowledge White Paper</title>
<meta name="description" content="Amzi! inc. white paper on the differences between logical, procedural and factual knowledge, and the unique problems in encoding logical knowledge.">

<meta name="keywords" content="Prolog, logic programming, logical knowledge, factual knowledge, procedural knowedge, rule engines, artificial intelligence,
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
    require ("../sidebar.php");
    ?>
    <!--End Side Navigation-->

    <div id="beef">
    
        <!--Start content-->

<h1>Amzi! Technology, <br> Products and Services Overview</h1>
<hr/>
<p>Amzi! 
specializes in products and services for developing and deploying integrated application 
components that apply <b>logical knowledge</b>, such as pricing rules, configuration 
logic, insurance regulations, diagnostic and advisory knowledge, grammar rules, 
message translation rules, and semantic relationships.</p><p>Unlike factual and 
procedural knowledge that are naturally deployed using conventional software tools, 
logical knowledge is difficult to deploy without specialize tools.</p><table width="100%" border="0" cellpadding="10"> 
<tr align="left" valign="top"> <td> <ul> <li><a href=#factual_procedural_knowledge>Factual 
and Procedural Knowledge</a><br> <br> </li><li><a href=#logical_knowledge>Logical 
Knowledge</a><br> <br> </li><li><a href=#traditional_tools>Using Traditional Tools 
for Logical Knowledge</a><br> <br> </li><li><a href=#virtual_machines>Virtual 
Machines for Logical Knowledge</a><br> <br> </li><li><a href=#different_tools>Different 
Tools for Different Applications</a></li><ul> <li><a href=#spreadsheets>Spreadsheets</a></li><li><a href=#knowledgebases>Knowledgebases</a></li><li><a href=#logicbases>Logicbases</a></li><li><a href=#hybrid_logicbases>Hybrid 
Logicbases</a></li><li><a href=#application_specific_knowledgebases>Application-specfic 
Knowledgebase</a></li></ul></ul></td><td> <ul> <li><a href=#amzi_products_services>Amzi! 
Products and Services</a></li>
        <ul>
          <li><a href=#amzi_logicbase>Logicbase</a></li>
          <li><a href=#amzi_logic_programming>Logic Programming</a></li>
          <li><a href=#amzi_custom>Custom Solutions</a><br>
            <br>
          </li>
        </ul>
        <li><a href=#examples_of_use>Sample Customer 
Applications</a><br> <br> </li><li><a href=#benefits_features>Summary of Benefits</a><br> 
<br> </li><li><a href=#about_amzi>About Amzi!</a></li></ul></td></tr> </table><h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="factual_procedural_knowledge"></a><font color="#333333">Factual and Procedural 
Knowledge</font></h2><p>Traditional software tools provide two ways of encoding 
knowledge: one is as <b>facts</b>, or data, in memory; the other is as sequences 
of instructions coded in a <b>procedural</b> programming language such as Java, 
C++, Visual Basic, Delphi or C#.</p><p>These two types of knowledge, factual and 
procedural, are natural for a computer because a computer is engineered from memory 
(facts/data) and a processing unit that executes a sequence of instructions (procedures). 
It is no accident that database tools and procedural programming languages have 
been with computers since the earliest days. It is no accident that early commercial 
use of computers was called 'data processing.'</p><p>Consider an airline reservation 
system. It has factual knowledge about passengers, flights, and bookings stored 
in a database. It has procedures that manipulate that data, for example to book 
a passenger on a flight.</p><p>This type of automation is well suited to a computer's 
design.</p><h2><img src="../../images/bullet.gif" width="36" height="36"> <a name="logical_knowledge"></a><font color="#333333">Logical 
Knowledge</font></h2><p>Logical knowledge is <b>relationships</b>. On paper, logical 
knowledge might be expressed as rules, or in tables showing conditions and implied 
results, or as graphs showing connections, or in formats that are particular to 
a given application area.</p><p>In an airline reservation system, pricing knowledge 
would be logical. It is a <b>complex set of rules and tables</b> describing relationships 
between air fare and dates, places, connections, durations, class, frequent flier 
miles, weekends, holidays, discounts, promotions and who knows what else.</p><p>Logical 
knowledge, unless relatively simple, <b>does not lend itself to easy encoding</b> 
in a computer.</p><p>It doesn't fit well in a database, because the relationships 
expressed are more complex than the simple factual relationships databases can 
encode.</p><p>It doesn't fit well in procedural code because the programmer is 
forced to artificially express the independent logical relationships as a sequence 
of instructions with well-defined flow of control.</p><table width="85%" border="1" cellpadding="10" bgcolor="#EBFFFF" align="center" bordercolor="#000080" cellspacing="2"> 
<tr> <td> <h3 align="center"><font color="#000080">Examples of Logical Knowledge</font></h3><p><b><i>Pricing</i></b> 
&#151; the relationships between price and the factors affecting it, for almost 
any product of even modest complexity;</p><p><b><i>Regulations</i></b> &#151; 
government's and private organization's rules and regulations, such as tax codes, 
insurance rules, legal requirements, benefits, purchasing, and work flow;</p><p><b><i>Configuration</i></b> 
&#151; the complex relationships between customer needs and products and components;</p><p><b><i>Support</i></b> 
&#151; the relationships between faults and symptoms in diagnostic technical support 
solutions, or between customer needs, and appropriate products and services;</p><p><b><i>Scheduling</i></b> 
&#151; the rules governing broadcast scheduling, radio and TV music scheduling, 
work scheduling, resource allocation, sports events;</p><p><b><i>Grammars</i></b> 
&#151; translation rules between data transfer protocols, program inputs, or natural 
languages;</p><p><b><i>Scientific</i></b> &#151; geologic relationships between 
surface observations and oil below, electric circuit behavior, network modeling, 
medical diagnosis, and economic modeling.</p></td></tr> </table><h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="traditional_tools"></a><font color="#333333">Using Traditional Tools 
for Logical Knowledge</font></h2><p><img src="../../products/overview_traditional.gif" width="330" height="220" align="right" border="0">While 
not well suited for the task, traditional tools are often used to encode logical 
knowledge.</p><p>In a few cases, the traditional tools are workable. For example, 
if the relationships are simple enough to be expressed in tables with the same 
columns, then a database can be used effectively. If the rules fit readily in 
a decision tree, then that tree can be represented by procedural branching statements.</p><p>But 
logical knowledge of any significance has a <b>variety of factors</b> in the relationships, 
making them ill-suited for database; and no implied sequence of execution, making 
them awkward to code procedurally. Different combinations of rules in different 
sequences are required depending on the input data.</p><p>The <b>advantage</b> 
of using traditional tools is, well, that they are traditional tools. There are 
a large number of programmers who are skilled in using them.</p><p>The <b>disadvantage</b> 
of using traditional tools is the procedural code and/or fragmented collections 
of data tables needed to express the interrelated logical relationships winds 
up being a rat's nest of unwieldy, difficult to maintain and highly error prone 
code.</p><p>For some application areas, this might not be a factor. But if the 
logical knowledge is changing, and it is important to keep up with the changes, 
then the <b>costs of maintaining </b>the encoding of the logical knowledge becomes 
prohibitive.<span style="mso-spacerun: yes">  </span>More importantly, due to 
the time consuming and error prone nature of that approach, competitive advantage 
could well be lost.</p><table width="85%" border="1" cellpadding="10" cellspacing="2" align="center" bgcolor="#EBFFFF" bordercolor="#000080"> 
<tr valign="top"> <td colspan="3"> <h3><font color="#000080">There's If-Then and 
then there's If-Then</font></h3><p class=MsoNormal>The term 'if-then' for rules 
is sometimes confusing because it is used both to describe branching instructions 
in a procedure, and certain logical relationships. In procedural code, if-then 
statements steer the flow of control. As logical relationships, if-then rules 
have no implied order of execution.</p></td></tr> <tr> <td valign="top"> <h3><font color="#000080">Object-Oriented 
Programming</font></h3><p>What about object-oriented programming? An 'object,' 
in computer science terms, is an encapsulation, in a single entity, of data and 
the procedures that work on that data. Object-oriented programming is a powerful 
tool, making the programmer's job of developing and maintaining procedural code 
that manipulates data much easier.</p><p>But object-oriented programming does 
not address the problems created by logical relationship knowledge, because it 
still only provides semantics for data and procedure.</p></td><td valign="top"> 
<h3><font color="#000080">Internet Tools</font></h3><p>What about scripting languages? 
HTML? Java Beans? Active Server Pages? and all the other Internet tools? These, 
too, are all tools for generating sequences of instructions for a CPU.</p></td></tr> 
</table><h2><img src="../../images/bullet.gif" width="36" height="36"> <a name="virtual_machines"></a><font color="#333333">Virtual<span style="mso-spacerun: yes">  
</span>Machines for Logical Knowledge</font></h2><p><img src="../../products/overview_reasoning_engine.gif" width="350" height="300" border="0" align="right">If 
the problem with encoding logical knowledge is the underlying machine, then what's 
needed to do the job right is a machine designed to handle logical knowledge. 
Building a hardware machine is not very practical, but software can be used to 
build a wide variety of <b>virtual machines</b>.</p><p>This is exactly what is 
done in all of the tools available for expert systems, business rule systems, 
knowledge base systems, logicbase systems, case base systems and others.</p><p>Each 
of these tools has a virtual machine architecture with two key components:</p><ul> 
<li>a "<b>knowledge representation</b>" syntax and interface for entering and 
maintaining logical relationships in a file called a "<b>knowledge base</b>," 
and</li><li>a "<b>reasoning engine</b>" that takes input data and, using the knowledge 
base, produces answers.</li></ul><p>For example:</p><ul> <li>A pricing application 
has a knowledge base of pricing rules and regulations; takes as input particulars 
of a given flight; and produces as output a fare.</li><li>A support application 
has a knowledge base of diagnostic rules; takes as input symptoms of a given problem; 
and produces as output a solution.</li><li>A configuration application has a knowledge 
base of related components; takes as input customer requirements; and produces 
as output a configured assembly.</li></ul><p>This architecture provides the major 
benefit that the logical knowledge no longer has to be forced into a format that 
is ill-served for coding it. Because the logical knowledge is more <b>naturally 
expressed</b> in a knowledge representation language, it is <b>easier to create 
and maintain</b>. Because it is easier to maintain, it is less error-prone, more 
reliable, and changes can be incorporated in production software much more rapidly.</p><p>In 
some cases the logical relations can be maintained directly by those with the 
knowledge, avoiding the translation step through an intermediate programmer. This 
further magnifies the benefits.</p><table width="75%" border="1" cellpadding="10" bgcolor="#EBFFFF" align="center" bordercolor="#000080" cellspacing="2"> 
<tr> <td> <h3 align="center"><font color="#000080">Artificial Intelligence</font></h3><p class=MsoNormal>The 
science of Artificial Intelligence (AI) concerns itself with the engineering and 
use of virtual machines that work with knowledge that cannot be easily expressed 
either factually or procedurally. Working with logical knowledge is a large part 
of AI. The term AI might be somewhat justified considering that human brains, 
unlike computers, are naturally good at processing logical relationships. </p></td></tr> 
</table><h2><img src="../../images/bullet.gif" width="36" height="36"> <a name="different_tools"></a><font color="#333333">Different 
Tools for Different Applications</font></h2><p>Unfortunately, there is tremendous 
variety in the forms of logical knowledge required for different application domains, 
and accordingly, there are a number of different tools and approaches.</p><p><b>How 
well a given tool fits a particular application depends on how close the knowledge 
representation language and reasoning engine match the way the application logic 
is naturally expressed and used.</b></p><p>For example, pricing knowledge is usually 
formal and precise, whereas knowledge about technical support has more vagaries 
in it, and also requires support for textual or HTML questions and answers.<span style="mso-spacerun:
yes">  </span>Configuration knowledge includes rules for how components are combined 
and also needs to express the logical relationships of hierarchies of parts.</p><p>Both 
pricing and technical support would have reasoning engines intent on finding a 
specific solution, but the knowledge for configuring complex products needs to 
be applied in a building block manner, creating a complex structure as output.</p><p>There 
are numerous <b>general-purpose tools</b> that might fit a given application, 
or an organization might decide to build a customized tool for their particular 
application.</p><p>A <b>customized tool</b> has the huge benefit that the knowledge 
representation can be designed to specifically match the way knowledge for that 
application is expressed. This often means those with the knowledge can directly 
maintain the knowledge base without programmer intervention.</p><p>A general-purpose 
tool can be purchased off-the-shelf and might provide a good enough fit for the 
application.</p><h3><a name="spreadsheets"></a>Spreadsheets, the First Logicbase 
Tools</h3><p>Spreadsheets are a perfect example of a specialized tool for a specific 
type of logical knowledge. In this case the logical relationships are arithmetic 
formulas linking the contents of the various cells.</p><p>The designers of a spreadsheet 
program first create the pattern of cells and allowable formulas users can use 
to express relationships.<span style="mso-spacerun:
yes">  </span>That is the knowledge representation.</p><p>They then write a program 
that knows how to compute the required cells in a spreadsheet. That is the reasoning 
engine.</p><p>The logical relationships defined in the spreadsheet, such as this 
cell is equal to the sum of those cells, are then used to compute values for different 
inputs. The result is financial users can directly enter the types of relationships 
they deal with in a familiar manner, without requiring a programmer. The underlying 
spreadsheet engine does the computation for them.</p><p>As we all know, spreadsheets 
are tremendously popular because they let non-programmers encode logical relationships 
that are executed by the spreadsheet reasoning engine. Of course, they are limited 
to expressing the sorts of things you can express in an array of related cells 
and formulae.</p><h3><a name="knowledgebases"></a>Knowledgebases, the Next Logicbase 
Tools</h3><p><img src="../../products/overview_logicbase.gif" width="330" height="180" align="right" border="0">There 
are many general purpose expert system tools and business rule products that follow 
the same architecture. They provide a knowledge representation for entering logical 
relationships as rules, and a reasoning engine that knows how to execute those 
rules.</p><p>These tools are powerful and are often used to solve the problem 
of encoding logical relationships.</p><p>The degree to which they are successful 
is related to how closely the semantics of the particular logical relationships 
are to the given tool. When the tool does not fit particularly well, then often, 
programmers are still needed to code the relationships for the tool.</p><p>This 
means those with the know-how don't maintain the logicbase directly.<span style="mso-spacerun: yes">  
</span>On the other hand, this is a better solution than using traditional tools 
because the programmer is now working with declarative specifications of the logical 
relationships rather than forcing them into procedural code.</p><p>The result 
is faster, more reliable response to changing conditions.</p><h3><a name="logicbases"></a>Prolog, 
Pure Logic</h3><p><img src="../../products/overview_prologbase.gif" width="330" height="180" align="right" border="0">Prolog 
is a tool that has a reasoning engine that takes as input formal logical assertions 
of facts and relationships. It's knowledge representation is ideal for precise 
sorts of relationships, such as those found in regulations and definitive business 
rules.</p><p>Prolog logic can be compiled for fast execution, and the Prolog reasoning 
engine is well suited for access from other applications, making it easy to access 
a logicbase in an application.</p><p>Prolog has the advantage over most tools 
in that it is an ISO standard language with many vendors providing compatible 
implementations.<span
style="mso-spacerun: yes">  </span>While not as widespread as Java or C++, many 
programmers have had some exposure to Prolog.</p><h3><a name="hybrid_logicbases"></a>Hybrid 
Logic System</h3><p><img src="../../products/overview_hybrid.gif" width="330" height="240" border="0" align="left">For 
application areas where those with the know-how prefer less formal syntax for 
representing logical relationships, it is not difficult to create front-end maintenance 
tools that translate a more informal representation into high performance Prolog 
syntax.</p><p>For example, developers might provide a spreadsheet or database 
front-end that allows those with know-how to enter rules and relationships. </p><p>That 
is then translated into a back-end Prolog logicbase for production.</p><p>The 
result is a hybrid system that provides many of the advantages of an application-specific 
logicbase, with a reliable, high-performance, general purpose logic reasoning 
engine for deployment.</p><h3><a name="application_specific_knowledgebases"></a>Application-Specific 
Knowledgebases</h3><p>Application-specific knowledgebases have tremendous advantages 
for those cases where they are cost-effective. They provide a very powerful tool 
for those with the know-how to use, and deployment without requiring programmer 
intervention.</p><p><img src="../../products/overview_logicprogram.gif" width="330" height="180" border="0" align="right">The 
result is fast reliable turn around of the business logical knowledge in response 
to changing business environments. The trade-off is development cost, as it takes 
time and money to design and build a custom knowledge representation and reasoning 
engine.</p><p>Prolog can greatly reduce the cost of building these custom tools. 
In addition to its easily learned and used formal logicbase capabilities, Prolog 
supports more advanced logic programming. </p><p>Logic programming is an extremely 
powerful programming technology ideally suited for implementing custom tools for 
maintaining and deploying logical knowledge.</p><p>While Prolog's easily learned 
pure logic is limited in its application to knowledge that is formal in nature, 
using logic programming, it is almost trivial to design knowledge representation 
formats for an infinite variety logical knowledge.</p><p>In a fraction of the 
time and code it would take using traditional programming technologies, logic 
programming can be used to implement reasoning engines that provide any sort behavior 
a particular application requires.</p><table width="85%" border="1" cellpadding="10" bgcolor="#EBFFFF" align="center" cellspacing="2" bordercolor="#000080"> 
<tr> <td> <h3 align="center"><font color="#000080">Logic Programming</font></h3><p class=MsoNormal> 
<p>Logic programming makes use of Prolog's built-in pattern-matching and search 
algorithms.<span style="mso-spacerun: yes">  </span>It might be called meta logic, 
because with logic programming it is easy to create a wide variety of ways to 
represent and reason over knowledge.</p><p>It takes some learning for a programmer 
to become skilled at logic programming, but once learned, allows for very rapid 
development of specialized knowledge-base tools.</p><p>The advantages to this 
approach are immense. It allows for the customization of knowledge representation 
to exactly the form that is easiest to work with for those that matter most, the 
people with the know how that is being encoded.</p><p>The result is responsibility 
for the knowledge lies with those that have the knowledge.</p></td></tr> </table><h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="amzi_products_services"></a><font color="#333333">Amzi! Products and 
Services</font></h2><p>Amzi! offers a variety of products and services all aimed 
at deploying application components that make use of logical knowledge.</p><p>The 
resulting applications can be deployed on Windows or Unix operating systems and 
be integrated into a variety of Web-based or stand-alone environments.</p><h3><a name="amzi_logicbase"></a>Logicbase</h3><p><b><i>Product: 
<a href="../../products/amzi_prolog_logic_server.htm"><img src="../../images/amzi_prolog_logic_server_name_small.gif" width="320" height="20" align="absmiddle" border="0"></a></i></b></p><p>A 
subset of Amzi! Prolog provides an easily learned and used syntax for expressing 
logical relationships directly as pure <b>logical assertions</b>. Together these 
assertions form a logicbase that can be queried much as a database can.</p><p>Because 
such a logicbase is &quot;pure&quot; logic it is best suited for application areas 
where the rules and relationships are crisp and <b>well defined</b>. Examples 
include regulations, such as for taxes or insurance forms, and business rules, 
such as for pricing, underwriting or workflow.</p><p>The Amzi! Logic Server allows 
the logicbase to be deployed on the Web or as part of a stand-alone application. 
It can run on Windows or Unix operating systems and connect directly to software 
written in languages such as Java, C++, VB, C# and Delphi.</p><p><img src="../../images/amzisquirrel.gif" width="120" height="120" align="right">Prolog 
syntax can also be generated from other forms of logical knowledge. If those with 
the knowledge have their own way of recording that knowledge, say in a spreadsheet 
or a database, then that form can be <b>translated into executable Prolog</b> 
for all of the deployment advantages of the Amzi! Logic Server.</p><h3><a name="amzi_logic_programming"></a>Logic 
Programming</h3><p><b><i>Product: <a href="../../products/amzi_prolog_logic_server.htm"><img src="../../images/amzi_prolog_logic_server_name_small.gif" width="320" height="20" align="absmiddle" border="0"></a></i></b></p><p>In 
addition to supporting logicbases for directly representing logical relationships, 
Amzi! Prolog supports full logic programming capabilities.</p><p>Logic programming 
is ideal for <b>modelling any sort of knowledge and its use</b>. Logic programming 
might be called meta logic, because it uses logical statements to describe general 
properties and behaviors of the domain being modelled.</p><p>Because logic programming 
is an extension of Prolog logicbase capabilities, it can be used to enhance logicbases 
with extra functionality. It can also be used to create entirely new applications 
for representing and reasoning over specific types of knowledge.</p><p>Some examples 
of logic programming applications are intelligent tutorials, broadcast scheduling, 
product configuration, pattern-matching for customers/suppliers, pattern-matching 
for mines and output, natural language, and grammar rules for message translation.</p><p>For 
applications involving knowledge representation and reasoning, logic programming 
often yields greater than a <b>ten to one improvement in productivity</b> when 
compared to procedural programming tools. The trade off is logic programming can 
take one to two weeks to learn.</p><p>Logic programs developed with Amzi! Prolog 
can be deployed using the Logic Server, providing all the advantages of embeddability 
and extendability that the Logic Server offers for logicbases.</p>
<h3><a name="amzi_custom"></a>Custom Solutions</h3>
<p><b><i>Product: <font size="+2"><a href="../../products/services.htm"><font size="+1">Amzi! 
Consulting</font></a></font></i></b></p><p>Amzi! provides custom solutions in 
a variety of ways:</p><ul> <li>Building custom rule engines and knowledgebase 
tools.</li>
  <li>Prototyping  applications and 
technology transfer.</li><li>Providing custom extensions to the Prolog environment.</li>
<li>Providing ports to different environments.</li>
<li>Licensing distribution 
of Amzi! products under other brand names.</li><li>Training professionals in the 
use of Prolog.</li></ul>
<h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="examples_of_use"></a><font color="#333333">Examples of Amzi! Products 
and Services in Use</font></h2><p><a href="../../customers/weathershield.htm">Weather 
Shield</a> provides <b>configuration and pricing</b> information for doors and 
windows (the glass type) using a hybrid logicbase. The knowledge is maintained 
by sales and manufacturing experts in a database format, which is translated into 
a Prolog logicbase for download and deployment on customer computers. This makes 
it very easy to do business with Weather Shield.</p><p><a href="../../customers/digxpr_satellite.htm">DigitalXPress</a> 
schedules real-time streaming video, multicasts and large data transfers via satellites. 
Their high-performance scheduler, a logic program, creates the <b>schedule in 
real-time</b> as prioritized requests are entered.</p><p><a href="../../customers/eotek.htm">eoTek</a>, 
a supplier of mortgage services for Nexstar, maintains separate knowledgebases 
of <b>pricing and underwriting</b> rules. They switched from a pure Java approach 
to a hybrid logicbase approach, gaining faster turnaround of pricing/underwriting 
changes, shorter test cycles, increased reliability, and high performance. This 
gives Nexstar a competitive edge in mortgage services.</p><p><a href="../../articles/youbet.htm">Youbet.com</a> 
supplies <b>dynamic Web content</b> for the horse racing enthusiast. It has separate 
logic program and logicbase that describe how content is extracted from a large 
and changing set of suppliers, for example various race tracks around the World. 
This lets them quickly provide the latest services for their customers.</p><p><a href="../../articles/cchlis_formspub.pdf">CCH</a> 
uses a hybrid logicbase approach for use by applications that fill out <b>insurance 
forms</b>. Changing regulations and forms are maintained by those that know the 
regulations and forms without need for program modification.</p><p><a href="http://www.georeferenceonline.com">GeoReference 
Online</a> uses logic programming to implement a sophisticated ontological and 
semantic net tool used to build applications that <b>aid geologic exploration</b>.</p><p><a href="../../articles/bcpath_pcai.htm">U.S. 
Army</a> uses a custom knowledgebase from Amzi! that uses Arden medical expertise 
syntax for knowledge representation. The domain is <b>breast cancer information</b> 
and the knowledge is maintained directly by non-programmers with breast cancer 
expertise. </p><p>CST hired Amzi! for the development of <b>technical support 
knowledgebase</b> tools as part of a start-up venture.</p><p><a href="../../articles/amkes_pajava99.htm">SAIC</a> 
subcontracted Amzi! for the development of a custom knowledge archiving and reasoning 
system that would allow collaborative development and use of knowledge from government 
funded medical research. This was a three-tiered 100% pure Java application.</p><p>A 
major computer manufacturer hired Amzi! for custom extensions to the Prolog engine 
to support proprietary <b>high-performance Web applications</b>. (Those extensions 
are part of the latest Amzi! release.)</p><p>A provider of equipment design and 
cost modelling software for the chemical and refinery industries hired Amzi! to 
<b>port its Prolog engine</b> to VMS, and to Alphas utilizing full 64-bit addressing.</p><p><a href="../../articles/assessment_testing.htm">Pacific 
AI</a> hired Amzi! to design and build a knowledge representation and reasoning 
engine to be used for creating <b>intelligent tutorials</b> in a variety of subject 
areas. </p><p>Fitcentric hired Amzi! to implement a customer jig for KnowledgeWright 
that allowed the easy encoding and deployment of physiological logical knowledge 
specific to providing coaching advice for endurance athletes.</p><p>A human resources 
specialist is using the KnowledgeWright Guide Jig to implement a knowledgebase 
providing advice on available employee benefits.</p><p>A software applications 
development company hired Amzi! to <b>train developers</b> in the use of Prolog 
for the implementation of an airline pricing system.</p><p>Two major software 
vendors license Amzi! products for inclusion in <b>workflow products</b>.</p><h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="benefits_features"></a><font color="#333333">Summary of Benefits</font></h2><p>These 
are the primary benefits of the Amzi! approach to deploying logical knowledge, 
helped with some metrics from a customer that kept good statistics.</p><ul> <li><b>Automate 
'difficult' components</b> - Logicbases can easily implement application components 
that are 'difficult' using conventional tools. Typically they are difficult because 
they are specified as sets of interrelated rules and relations that are too complex 
for database, yet are not easily expressed in procedural languages. Because a 
logicbase is composed of non-procedural logical relations and rules, this type 
of application is very easy in Prolog. For example, one user replaced 5000 lines 
of Java code that implemented complex pricing rules, with 500 lines of Prolog 
logic.</li><li><b>Bring business logic closer to those who know it best</b> - 
Logicbases can often be maintained directly by those who maintain the business 
rules. This is sometimes due to the declarative nature of Prolog, and sometimes 
to the ease with which Prolog can represent various types of knowledge. For example, 
the pricing component used to require Java programmers to implement changes, now 
a hybrid front-end allows those changes to be directly handled by pricing experts.</li><li><b>Greater 
Reliability</b> - Logicbases can be independently tested and debugged, before 
integration, making for quicker, more error-free implementation. Also the often 
factor of ten reduction in code means there is simply less code to go wrong. The 
pricing component has been virtually error-free.</li><li><b>High Performance</b> 
- Logicbases execute extremely fast. This is because the declarative Prolog logic 
is compiled to run on a specialized Prolog virtual machine. Dynamic Prolog logic 
is indexed for high performance. The pricing component takes up an insignificant 
portion of a total pricing transaction.</li><li><b>High Volume Use</b> - Logicbases 
are ideal for Web deployment. Multiple simultaneous logicbase engines can be run 
in multiple threads. The pricing application maintains a pool of Logic Servers, 
serving online demand.</li><li><b>Rapid Development</b> - Components are developed 
in a fraction of the time required using procedural languages and database. Developers 
don't worry about procedural flow-of-control or memory allocation issues, concentrating 
instead on pure application logic. The pricing application took two years to develop 
in Java, but less than two months in Prolog.</li><li><b>Easy Integration</b> - 
Logicbase components can be deployed as part of any application context. The Amzi! 
Logic Server API provides interfaces for popular languages and environments. The 
pricing component is part of a Java real-time Internet service.</li><li><b>Highly 
Portable</b> - Amzi! logicbases can be run on most any computing environment. 
Compiled logicbases are machine independent, running on a Prolog virtual machine. 
The pricing component was moved without change between Solaris and Windows NT 
servers.</li><li><b>International Applications</b> - Logic-bases can be deployed 
in any national language, using either Unicode or locale-specific multi-byte character 
sets. The pricing application is in English. An erosion advisor was developed 
and deployed in Chinese.</li></ul><h2><img src="../../images/bullet.gif" width="36" height="36"> 
<a name="about_amzi"></a><font color="#333333">About Amzi! inc.</font></h2><p>Amzi! 
inc. is a small privately-owned business that specializes in products and services 
for maintaining and deploying knowledge that is best stored as logical relationships. 
It has been in business since 1991, servicing a wide range of commercial and government 
customers with a level of support that only a small, focused company can provide.</p>



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
