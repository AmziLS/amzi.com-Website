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
<td><h1>Contents</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>
        <hr />


<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 >
<TR VALIGN=TOP>

    <TD VALIGN=TOP width="313"> 
      <DL> 
        <DT><A HREF="00preface.php#preface"> </A></DT>
        <pre>
 <a href="00preface.php#preface" >Preface</a>
 <a href="00preface.php#acknowledgements" >Acknowledgements</a>

1 Introduction
 <a href="01introduction.php#expertsystems" >1.1 Expert Systems</a>
 <a href="01introduction.php#expertsystemfeatures" >1.2 Expert System Features</a>
    <a href="01introduction.php#goaldrivenreasoning" >Goal-Driven Reasoning</a>
    <a href="01introduction.php#uncertainty" >Uncertainty</a>
    <a href="01introduction.php#datadrivenreasoning" >Data Driven Reasoning</a>
    <a href="01introduction.php#datarepresentation" >Data Representation</a>
    <a href="01introduction.php#userinterface" >User Interface</a>
    <a href="01introduction.php#explanations" >Explanations</a>
    <a href="01introduction.php#sampleapplications" >1.3 Sample Applications</a>
 <a href="01introduction.php#prolog" >1.4 Prolog</a>
 <a href="01introduction.php#assumptions" >1.5 Assumptions</a>

2 Using Prolog's Inference Engine&nbsp;&nbsp;&nbsp;
 <a href="02usingprolog.php#thebirdidentificationsystem" >2.1 The Bird Identification System</a>
    <a href="02usingprolog.php#ruleformats" >Rule formats</a>
    <a href="02usingprolog.php#rulesaboutbirds" >Rules about birds</a>
    <a href="02usingprolog.php#rulesforhierarchicalrelationships" >Rules for hierarchical relationships</a>
    <a href="02usingprolog.php#rulesforotherrelationships" >Rules for other relationships</a>
 <a href="02usingprolog.php#userinterface" >2.2 User Interface</a>
    <a href="02usingprolog.php#attributevaluepairs" >Attribute Value pairs</a>
    <a href="02usingprolog.php#askingtheuser" >Asking the user</a>
    <a href="02usingprolog.php#rememberingtheanswer" >Remembering the answer</a>
    <a href="02usingprolog.php#multivaluedanswers" >Multi-valued answers</a>
    <a href="02usingprolog.php#menusfortheuser" >Menus for the user</a>
    <a href="02usingprolog.php#otherenhancements" >Other enhancements</a>
 <a href="02usingprolog.php#asimpleshell" >2.3 A Simple Shell</a>
    <a href="02usingprolog.php#commandloop" >Command loop</a>
    <a href="02usingprolog.php#atoolfornonprogrammers" >A tool for non-programmers</a>
 <a href="02usingprolog.php#summary" >2.4 Summary</a>
 <a href="02usingprolog.php#exercises" >Exercises</a>

3 Backward Chaining with Uncertainty
 <a href="03backwarduncertainty.php#certaintyfactors" >3.1 Certainty Factors</a>
    <a href="03backwarduncertainty.php#anexample" >An Example</a>
    <a href="03backwarduncertainty.php#ruleuncertainty" >Rule Uncertainty</a>
    <a href="03backwarduncertainty.php#useruncertainty" >User Uncertainty</a>
    <a href="03backwarduncertainty.php#combiningcertainties" >Combining Certainties</a>
    <a href="03backwarduncertainty.php#propertiesofcertaintyfactors" >Properties of Certainty Factors</a>
 <a href="03backwarduncertainty.php#mycinscertaintyfactors" >3.2 MYCINs Certainty Factors</a>
    <a href="03backwarduncertainty.php#determiningpremisecf" >Determining Premise CF</a>
    <a href="03backwarduncertainty.php#combiningpremisecfandconclusioncf" >Combining Premise CF and Conclusion CF</a>
    <a href="03backwarduncertainty.php#premisethresholdcf" >Premise Threshold CF</a>
    <a href="03backwarduncertainty.php#combiningcfs" >Combining CFs</a>
 <a href="03backwarduncertainty.php#ruleformat" >3.3 Rule Format</a>
 <a href="03backwarduncertainty.php#theinferenceengine" >3.4 The Inference Engine</a>
    <a href="03backwarduncertainty.php#workingstorage" >Working Storage</a>
    <a href="03backwarduncertainty.php#findavalueforanattribute" >Find a Value for an Attribute</a>
    <a href="03backwarduncertainty.php#attributevaluealreadyknown" >Attribute Value Already Known</a>
    <a href="03backwarduncertainty.php#askuserforattributevalue" >Ask User for Attribute Value</a>
    <a href="03backwarduncertainty.php#deduceattributevaluefromrules" >Deduce Attribute Value from Rules</a>
 <a href="03backwarduncertainty.php#makingtheshell" >3.5 Making the Shell</a>
    <a href="03backwarduncertainty.php#startingtheinference" >Starting the Inference</a>
 <a href="03backwarduncertainty.php#englishlikerules" >3.6 English-like Rules</a>
 <a href="03backwarduncertainty.php#exercises" >Exercises</a>

4 Explanation
    <a href="04explanation.php#valueofexplanationstotheuser" >Value of Explanations to the User</a>
    <a href="04explanation.php#valueofexplanationstothedeveloper" >Value of Explanations to the Developer</a>
    <a href="04explanation.php#typesofexplanations" >Types of Explanation</a>
 <a href="04explanation.php#explanationinclam" >4.1 Explanation in Clam</a>
 <a href="04explanation.php#tracing" >Tracing</a>
    <a href="04explanation.php#howexplanations" >How Explanations</a>
    <a href="04explanation.php#whyquestions" >Why Questions</a>
 <a href="04explanation.php#nativeprologsystems" >4.2 Native Prolog Systems</a>
 <a href="04explanation.php#exercises" >Exercises</a>

5 Forward Chaining
 <a href="05forward.php#productionsystems" >5.1 Production Systems</a>
 <a href="05forward.php#usingoops" >5.2 Using Oops</a>
 <a href="05forward.php#implementation" >5.3 Implementation</a>
 <a href="05forward.php#explanationforoops" >5.4 Explanations for Oops</a>
 <a href="05forward.php#enhancements" >5.5 Enhancements</a>
 <a href="05forward.php#ruleselection" >5.6 Rule Selection</a>
    <a href="05forward.php#generatingtheconflictset" >Generating the conflict set</a>
    <a href="05forward.php#timestamps" >Time stamps</a>
 <a href="05forward.php#lex" >5.7 LEX</a>
    <a href="05forward.php#changesintherules" >Changes in the Rules</a>
    <a href="05forward.php#implementinglex" >Implementing LEX</a>
 <a href="05forward.php#MEA" >5.8 MEA</a>
 <a href="05forward.php#exercises" >Exercises</a>

6 Frames
 <a href="06frames.php#thecode" >6.1 The Code</a>
 <a href="06frames.php#datastructures" >6.2 Data Structure</a>
 <a href="06frames.php#themanipulationpredicates" >6.3 The Manipulation Predicates</a>
 <a href="06frames.php#usingframes" >6.4 Using Frames</a>
 <a href="06frames.php#summary" >6.5 Summary</a>
 <a href="06frames.php#exercises" >Exercises</a></pre>
      </DL>
</TD>

    <TD VALIGN=TOP width="139"> 
      <DL> 
        <DT><A HREF="../AdventureInProlog/a9struct.htm"> </A></DT>
        <pre>
7 Integration
 <a href="07integration.php#foops" >7.1 Foops (Frames and Oops)</a>
    <a href="07integration.php#instances" >Instances</a>
    <a href="07integration.php#rulesforfrints" >Rules for frinsts</a>
    <a href="07integration.php#addingprologtofoops" >Adding Prolog to Foops</a>
 <a href="07integration.php#roomconfiguration" >7.2 Room Configuration</a>
    <a href="07integration.php#furnitureframes" >Furniture frames</a>
    <a href="07integration.php#framedemons" >Frame Demons</a>
    <a href="07integration.php#initialdata" >Initial Data</a>
    <a href="07integration.php#inputdata" >Input Data</a>
    <a href="07integration.php#therules" >The Rules</a>
    <a href="07integration.php#outputdata" >Output Data</a>
 <a href="07integration.php#asamplerun" >7.3 A Sample Run</a>
 <a href="07integration.php#summary" >7.4 Summary</a>
 <a href="07integration.php#exercises" >Exercises</a>

8 Performance
 <a href="08performance.php#backwardchainingindexes" >8.1 Backward Chaining Indexes</a>
 <a href="08performance.php#retematchalgorithm" >8.2 Rete Match Algorithm</a>
    <a href="08performance.php#networknodes" >Network Nodes</a>
    <a href="08performance.php#networkpropogation" >Network Propagation</a>
    <a href="08performance.php#exampleofnetworkpropagation" >Example of Network Propagation</a>
    <a href="08performance.php#performanceimprovements" >Performance Improvements</a>
 <a href="08performance.php#theretegraphdatastructures" >8.3 The Rete Graph Data Structures</a>
 <a href="08performance.php#propagatingtokens" >8.4 Propagating Tokens</a>
 <a href="08performance.php#therulecompiler" >8.5 The Rule Compiler</a>
 <a href="08performance.php#integrationwithfoops" >8.6 Integration with Foops</a>
 <a href="08performance.php#designtradeoffs" >8.7 Design Tradeoffs</a>
 <a href="08performance.php#exercises" >Exercises</a>

9 User Interface
 <a href="09userinterface.php#objectorientedwindowinterface" >9.1 Object Oriented Window Interface</a>
 <a href="09userinterface.php#developersinterfacetowindows" >9.2 Developer's Interface to Windows</a>
 <a href="09userinterface.php#highlevelwindowimplementation" >9.3 High-Level Window Implementation</a>
    <a href="09userinterface.php#messagepassing" >Message Passing</a>
    <a href="09userinterface.php#inheritance" >Inheritance</a>
 <a href="09userinterface.php#lowlevelwindowimplementation" >9.4 Low-Level Window Implementation</a>
 <a href="09userinterface.php#exercises" >Exercises</a>

10 Two Hybrids
 <a href="10hybrids.php#cvgen" >10.1 CVGEN</a>
 <a href="10hybrids.php#theknowledgebase" >10.2 The Knowledge Base</a>
    <a href="10hybrids.php#ruleforparameters" >Rule for parameters</a>
    <a href="10hybrids.php#rulesforderivedinformation" >Rules for derived information</a>
    <a href="10hybrids.php#questionsfortheuser" >Questions for the user</a>
    <a href="10hybrids.php#defaultrules" >Default rules</a>
    <a href="10hybrids.php#rulesforedits" >Rules for edits</a>
    <a href="10hybrids.php#staticinformation" >Static information</a>
 <a href="10hybrids.php#inferenceengine" >10.3 Inference Engine</a>
 <a href="10hybrids.php#explanations" >10.4 Explanations</a>
 <a href="10hybrids.php#environment" >10.5 Environment</a>
 <a href="10hybrids.php#aijmp" >10.6 AIJMP</a>
 <a href="10hybrids.php#summary" >10.7 Summary</a>
 <a href="10hybrids.php#exercises" >Exercises</a>

11 Prototyping
 <a href="11prototyping.php#theproblem" >11.1 The Problem</a>
 <a href="11prototyping.php#thesalesadvisorknowledgebase" >11.2 The Sales Advisor Knowledge Base</a>
    <a href="11prototyping.php#qualifying" >Qualifying</a>
    <a href="11prototyping.php#objectivesbenefitsfeatures" >Objectives - Benefits - Features</a>
    <a href="11prototyping.php#situationanalysis" >Situation Analysis</a>
    <a href="11prototyping.php#competitiveanalysis" >Competitive Analysis</a>
    <a href="11prototyping.php#miscellaneousadvice" >Miscellaneous Advice</a>
    <a href="11prototyping.php#userqueries" >User Queries</a>
 <a href="11prototyping.php#theinferenceengine" >11.3 The Inference Engine</a>
 <a href="11prototyping.php#userinterface" >11.4 User Interface</a>
 <a href="11prototyping.php#summary" >11.5 Summary</a>
 <a href="11prototyping.php#exercises" >Exercises</a>

12 Rubik's Cube
 <a href="12rubikscube.php#theproblem" >12.1 The Problem</a>
 <a href="12rubikscube.php#thecube" >12.2 The Cube</a>
 <a href="12rubikscube.php#rotation" >12.3 Rotation</a>
 <a href="12rubikscube.php#highlevelrules" >12.4 High Level Rules</a>
 <a href="12rubikscube.php#improvingthestate" >12.5 Improving the State</a>
 <a href="12rubikscube.php#thesearch" >12.6 The Search</a>
 <a href="12rubikscube.php#moreheuristics" >12.7 More Heuristics</a>
 <a href="12rubikscube.php#userinterface" >12.8 User Interface</a>
 <a href="12rubikscube.php#onthelimitsofmachines" >12.9 On the Limits of Machines</a>
 <a href="12rubikscube.php#exercises" >Exercises</a>

Appendix - Full Source Code
 <a href="appendix.php#native" >Native</a>
 <a href="appendix.php#clam" >Clam</a>
 <a href="appendix.php#oops" >Oops</a>
 <a href="appendix.php#foops" >Foops</a>
 <a href="appendix.php#retefoops" >Rete-Foops</a>
 <a href="appendix.php#windows" >Windows</a>
 <a href="appendix.php#rubik" >Rubik</a>
 <a href="appendix.php#taxes" >Taxes (Bonus Code)</a>
     </pre>
      </DL>
</TD>
</TR>
</TABLE>

<UL></UL>










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
