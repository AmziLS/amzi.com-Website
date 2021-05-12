<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Embeddable Extendable Prolog, Logic Server, Knowledge Engineering, Rule Engines, Artificial Intelligence</title>
<meta name="description" content="Amzi! inc. provides software and services for
 embedding intelligent components that apply busines rules, diagnose problems, recommend configurations, 
give advice, schedule events, monitor processes and more.">

<meta name="keywords" content="Amzi, Amzi! Prolog, logic programming, learn prolog, prolog tutorial,
rule engines, artificial intelligence, windows, mac, osx, os x, prolog,
domain specific language, logic server, embeddable, extendable, knowledge engineering,
Clocksin, Mellish, Ivan, Bratko">

<meta name="author" content="Amzi! inc." />

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/header_links.php';
require $_SERVER['DOCUMENT_ROOT'] . '/google.php';
?>
<style type="text/css">
.style1 {font-size: smaller}
.style2 {
	font-size: large;
	font-weight: bold;
}
</style>
</head>

<body>
<div id="big_picture">
<?php   //topbar is the same for whole site, and lives at the top directory
require $_SERVER['DOCUMENT_ROOT'] . '/masthead.php';
?>

<div id="content">

    <div id="big_beef">
        

<!--Start content-->


<h2>Amzi! is now open source! and funded by sales of Dennis Merritt's books.</h2>


<hr />

      <table>
      <td><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=amzilogic-20&marketplace=amazon&region=US&placement=B06XTZC8X1&asins=B06XTZC8X1&linkId=915ed14065d4b75585b6a51f3296a469&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe></td>
      <td><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=tf_til&ad_type=product_link&tracking_id=amzilogic-20&marketplace=amazon&region=US&placement=B072LV387G&asins=B072LV387G&linkId=5520cddafbcea538c063419628cfb4d3&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe></td>
    <td><p style="text-align:center">Dennis Merritt's books are available for Kindle and in print.</p><p style="text-align:center">In addition to his two classic Prolog books, he's written two others, one an introduction to the theory of jazz chords using the baritone ukulele as an instrument, and the other about the similarities between life and quantum entanglement.</p></td>
    <td><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=qf_sp_asin_til&ad_type=product_link&tracking_id=amzilogic-20&marketplace=amazon&region=US&placement=B07S5BB8ZN&asins=B07S5BB8ZN&linkId=f91cb0e894bf973dd86521e68915bd0c&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe></td>
    <td><iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ac&ref=qf_sp_asin_til&ad_type=product_link&tracking_id=amzilogic-20&marketplace=amazon&region=US&placement=B0768MTPRR&asins=B0768MTPRR&linkId=2c1a5950e23318da3a7b8327271e1981&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
    </iframe></td>
      </table>


      
      <h1>Amzi!</h1>
        <hr  />
        <div style="margin-left: 5px; float:right; background:#FFFFFF; border:double black thick; padding:5px;">
<h4 align="center">Sign-up for the<br />Amzi! Newsletter</h4>
<form action="http://amziinc.createsend.com/t/r/s/bhrthi/" method="post" id="subForm">
<table width="200" cellspacing="2" cellpadding="2">
  <tr>
    <td><label for="name">Name: </label></td>
    <td><input type="text" name="cm-name" id="name" /></td>
  </tr>
  <tr>
    <td><label for="bhrthi-bhrthi">Email: </label></td>
    <td><input type="text" name="cm-bhrthi-bhrthi" id="bhrthi-bhrthi" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Subscribe" /></td>
  </tr>
</table>
</form>
</div>
        <p>Amzi! provides software and services for knowledge-based application development and deployment.</p>
        <ul>
        <li><a href="#opensource">Open Source Projects</a>&#8212; All Amzi! products are now open source projects.</li>
        <li><a href="#apls">Amzi! Prolog + Logic Server</a> <span class="style1">&#8482;</span> &#8212; Embeddable, Extendable, Portable Prolog Implementation</li>
        <li><a href="#arulesxl">ARulesXL</a><span class="style1">&#8482;</span> &#8212; Excel Rule Engine</li>
        <li><a href="#eva">EVA</a><span class="style1">&#8482;</span> &#8212; Vaccination Analysis and Forecast Software</li>
        <li><a href="#aip">Adventure in Prolog</a><span class="style1">&#8482; </span>&#8212; Prolog Tutorial</li>
        <li><a href="#xsip">Expert Systems in Prolog</a><span class="style1">&#8482;</span> &#8212; Applications of Prolog</li>
        <li><a href="#kw4">Knowledge Wright</a><span class="style1">&#8482;</span> &#8212; Customizable Knowledge-Based Tool</li>
        <li><a href="#consulting">Consulting & Training</a></li>
      </ul>
      
            <h2><a name="apls" id="opensource"></a><a href="AmziOpenSource/index.php">Amzi! Open Source Projects</a> <span class="style1">&#8482;</span></h2>
            <p>Amzi! is now 99 44/100% Open Source.  All of the products listed on this page are now open source projects distributed under the M.I.T. Open Source license.  This means they are free to be used as you see fit.  Basic versions of Amzi! products have always been free, but now the full commercial versions are as well.

      <div style="margin-left: 5px; float:right; width:280px">
        <p class="caption"><img src="/images/debugger_rubik_270.jpg" alt="Amzi! Prolog Eclipse plug-in source code debugger" /><br/>
        Amzi! Prolog source code debugger showing call stack, variable bindings, source code at a REDO port, index of predicates, and executing code.</p>
        </div>

      <h2><a name="apls" id="apls"></a><a href="AmziPrologLogicServer/index.php">Amzi! Prolog + Logic Server</a> <span class="style1">&#8482;</span></h2>
      <p>Amzi! Prolog + Logic Server<span class="style1">&#8482;</span> is an embeddable, extendable, highly portable implementation of ISO standard Prolog, including full support for ISO modules enabling large-scale application development. It is distinguished by:</p>
        <ul>
          <li><strong>Logic Server API</strong>: full interfaces for both calling in and calling out from Prolog from a wide variety of development environments including C, C++, Java, Delphi, .NET, VB.</li>
          <li><strong>Eclipse IDE</strong> featuring: source code debugger, cross reference, integrated listener, project support and all of the professional development features of Eclipse. Ideal for both learning Prolog and for building commercial grade applications.  Amzi!'s strong Java interface made it possible to integrate intelligent Prolog debuggers, cross reference, and other features in the Eclipse Prolog plug-in.</li>
          <li><strong>Virtual machine architecture</strong> allows binary code independence. Develop on Windows, deploy on Unix.</li>
        </ul>
        <p>Go straight to <a href="AmziPrologLogicServer/store.php">download</a>.</p>
        <h2><a name="arulesxl" id="arulesxl"></a><a href="ARulesXL">ARulesXL</a><span class="style1">&#8482;</span> &#8212; Excel Rule Engine</h2>
      <p>A rule language and reasoning engine that is embeded in Excel, allowing for the development of rule and pattern-matching applications integrated with Excel spreadsheet data. The applications can be exported and deployed in any of the environments supported by Amzi! Prolog + Logic Server.</p>
        <p>ARulesXL was made possible by the expressiveness of the Prolog language for the development of knowledge based languages and reasoning engines, and Amzi!'s Logic Server API which allowed for the seamless integration of the rules with Excel using VBA.</p>
        <h2><a name="eva" id="eva"></a><a href="vaccinationanalysis/index.html">EVA</a> <span class="style1">&#8482;</span> &#8212; Vaccination Analysis and Forecast Software</h2>
      <p>An ARulesXL application that allows for the encoding of vaccination knowledge in a spreadsheet, and the deployment of that knowledge into any other application context.</p>
      <p>EVA illustrates the power of developing knowledge based systems customized for a particular application domain. The knowledge in EVA can be maintained and vetted by doctors, not programmers.</p>
        <h2><a name="aip" id="aip"></a><a href="AdventureInProlog/index.php">Adventure in Prolog</a> <span class="style1">&#8482; </span>&#8212; Prolog Tutorial</h2>
      <p>A full tutorial for learning Prolog, using an interactive fiction game for it's basic example. In the course of the tutorial you will also build an expert system and a business application.</p>
        <h2><a name="xsip" id="xsip"></a><a href="ExpertSystemsInProlog/index.php">Expert Systems in Prolog</a> <span class="style1">&#8482; </span>&#8212; Applications of Prolog</h2>
      <p>A tutorial with many samples showing how to use Prolog to create rule languages and reasoning engines for a variety of different types of knowledge and application.</p>
        <h2><a name="consulting" id="consulting"></a><a href="services/index.php">Consulting & Training</a> </h2>
      <p>Amzi offers a variety of consulting services including on-site courses, custom training, prototype development, technology transfer, consulting and full application development.</p>
      
        <h2><a name="kw4" id="kw4"></a><a href="knowledgewright">Knowledge Wright</a><span class="style1">&#8482;</span> &#8212; Customizable Knowledge Base Tool</h2>
      <p>Knowledge Wright is a customizable platform for creating domain-specific application development tools</p>
        <p>Knowledge Wright was made possible by the expressiveness of the Prolog language for the development of knowledge based languages and reasoning engines, and Amzi!'s Logic Server API which allowed for the seamless integration with a Java-based development environment.</p>
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
