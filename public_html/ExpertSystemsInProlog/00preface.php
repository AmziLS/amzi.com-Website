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
<td><h1>Preface</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />



<p> 
  When I compare the books on expert systems in my library with the production 
  expert systems I know of, I note that there are few good books on building expert 
  systems in Prolog. Of course, the set of actual production systems is a little 
  small for a valid statistical sample, at least at the time and place of this 
  wrining--here in Germany, and in the first days of 1989. But there are at least 
  some systems I have seen running in real life commercial and industrial environments, 
  and not only at trade shows.</p>
<p>I 
  can observe the most impressive one in my immediate neighborhood. It is installed 
  in the Telephone Shop of the German Federal PTT near the Munich National Theater, 
  and helps configure telephone systems and small PBXs for mostly private customers. 
  It has a neat, graphical interface, and constructs and prices an individual 
  telephone installation interactively before the very eyes of the customer.</p>
<p>The 
  hidden features of the system are even more impressive. It is part of an expert 
  system network with a distributed knowledge base that will grow to about 150 
  installations in every Telephone Shop throughout Germany. Each of them can be 
  updated individually overnight via Teletex to present special offers or to adapt 
  the seleciton process to the hardware supplies currently available at the local 
  warehouses.</p>
<p>Another 
  of these industrial systems supervises and controls in &quot;soft&quot; real 
  time the excavators currently used in Tokyo for subway construction. It was 
  developed on a Unix workstation and downloaded to a single board computer using 
  a real time operating system. The production computer runs exactly the same 
  Prolog implementation that was used for programming, too.</p>
<p>And 
  there are two or three other systems that are perhaps not as showy, but do useful 
  work for real applications, such as oil drilling in the North Sea, or estimating 
  the risks of life insurance for one of the largest insurance companies in the 
  world. What all these systems have in common is their implementation language: 
  Prolog, and they run on &quot;real life&quot; computers like Unix workstations 
  or minis like VAXs. Certainly this is one reason for the preference of Prolog 
  in commercial applications.</p>
<p>Buter 
  there is one other, probably even more important advantage: prolog is a programmer's 
  and software engineer's dream. It is compact, highly readable, and arguably 
  the &quot;most strucutred&quot; languae of them all. Not only has it done away 
  with virtually all control flow statements, but even explicit variable assignment, 
  too!</p>
<p>These 
  virtues are certainly reason enough to base not only systems, but textbooks, 
  on this language. Dennis Merritt has done this in an admirable manner. he explains 
  the basic principles, as well as the specialized knowledge representation and 
  processing techniques that are indispensable for the implementation of industrial 
  software such as those mentioned above. This is important because the foremost 
  reason for the relative neglect of Prolog in expert system literature is probably 
  the prejudice that &quot;it can be used only for backward chaining rules.&quot; 
  Nothing is farther from the truth. Its relational data base model and its underlying 
  unification mechanism adapt easily and naturally to virtually any programming 
  paradigm one cares to use. Merritt shows how this works using a copious variety 
  of examples. His book will certainly be of particular value for the professional 
  developer of industrial knowledge-based applications, as well as for the student 
  or programmer interested in learning about or building expert systems. I am, 
  therefore, happy to have served as his editor.</p>
<p>Peter 
  H. Schnupp<br>
  Munich, January 
  1989 </p>
<h1><b><a name="acknowledgements"></a>Acknowledgements 
  </b></h1>
<p> 
  A number of people have helped make this book possible. The include Dave Litwack 
  and Bill Linn of Cullinet who provided the opportunity and encouragement to 
  explore these ideas. Further thanks goes to Park Gerald and the Boston Computer 
  Society, sounding boards for many of the programs in the book. Without the excellent 
  Prolog products from Cogent (now Amzi!), AAIS, Arity, and Logic Programming 
  Associates none of the code would have been developed. A special thanks goes 
  to Peter Gable and Paul Weiss of Arity for their early help and Allan Littleford, 
  provider of both Cogent Prolog and feedback on the book. Jim Humphreys of Suffolk 
  University gave the most careful reading of the book, and advice based on years 
  of experience. And finally without both the technical and emotional 
  support of Mary Kroening the book would not have been started or finished.</p>
<p><i><font size=-1>Copyright &copy;2017 Dennis Merritt All Rights 
  Reserved.</font></i></p>
<p>&nbsp;</p>



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
