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
<td><h1>10 Hybrids</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>This 
  chapter describes two similar expert systems which were developed at Cullinet 
  Software, a large software vendor for IBM mainframes, VAXes, and PCs. The systems 
  illustrate some of the difficulties in knowledge base design and show the different 
  features needed in two seemingly very similar systems.</P>
<P>Both 
  expert systems were designed to set parameters for the mainframe database, IDMS/R, 
  at a new user site. The parameters varied from installation to installation, 
  and it was necessary to have an experienced field support person set them at 
  the site. Since field support people are expensive, the expert systems were 
  written to allow the customer to set the parameters, thus freeing the support 
  person for more demanding tasks.</P>
<P>The 
  first, CVGEN, set the system generation (sysgen) parameters for the run time 
  behavior of the system. This included such parameters as storage pool sizes, 
  logging behavior, and restart procedures. These parameters had a serious effect 
  on the performance of the system, and needed to be set correctly based on each 
  site's machine configuration and application mix.</P>
<P>The 
  second, AIJMP, set all of the parameters which ran an automated installation 
  procedure. This included parameters which determined which modules to include 
  and how to build installation libraries. These parameters determined how the 
  software would reside at the customer's site.</P>
<P>The 
  systems were built using a variation of the pure Prolog approach described earlier 
  in the book. The inferencing parts of the system were separated from the knowledge 
  base. It was surprising to find that even with two systems as similar as these, 
  they both set parameters, the shell for one was not completely adequate for 
  the other.</P>
<h1><B> <a name="cvgen"></a>10.1 
  CVGEN </B></h1>
<P>Various 
  shells available on the PC were examined when CVGEN was built, yet none seemed 
  particularly well suited for this application. The main difficulty centered 
  around the nature of the dialog with the user. To a large degree, the expertise 
  a field support person brought to a site was the ability to ask the right questions 
  to get information from the systems programmers at the site, and the ability 
  to judge whether the answers were realistic.</P>
<P>To 
  capture this expertise, the knowledge base had to be rich in its ability to 
  represent the dialog with the user. In particular:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;The 
      system was designed to be used by systems programmers who were technically 
      sophisticated, but not necessarily familiar with the parameters for IDMS/R. 
      This meant fairly lengthy prompts were needed in the dialog with the user.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      input data had to be subjected to fairly complex validation criteria, which 
      was often best expressed in additional sets of rules. A large portion of 
      the field person's expertise was knowing what values made sense in a particular 
      situation.</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;The 
      output of the system had to be statements which were syntactically correct 
      for IDMS/R. This meant the rules not only found values for parameters but 
      built the statements as well.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  first objective of the system was to gather the data necessary to set the parameters 
  by asking meaningful questions of the systems programmer. This meant providing 
  prompts with a fair amount of text.</P>
<P>The 
  next objective of the system was to validate the user's input data. The answers 
  to the questions needed to be checked for realistic values. For example when 
  asking for the desired number of simultaneous batch users, the answer had to 
  be checked for reasonableness based on the size of machine.</P>
<P>A 
  similar objective was to provide reasonable default answers for most of the 
  questions. As were the edit checks, the defaults were often based on the particular 
  situation and required calculation using rules.</P>
<P>Given 
  these objectives, the questioning facility needs to have the ability to call 
  rule sets to compute the default before asking a question, and another rule 
  set to validate the user's response. It also needs to be able to store questions 
  which are up to a full paragraph of text.</P>
<P>The 
  knowledge base needs to be designed to make it easy for the experts to view 
  the dialog, and the edit and default rules. The knowledge base also needs some 
  pure factual information.</P>
<P>The 
  actual rules for inferencing were relatively simple. The system had a large 
  number of shallow rules (the inference chains were not very deep) which were 
  best expressed in backward chaining rules. The backward chaining was natural 
  since the experts also tackled the problem by working backward from the goals 
  of setting individual parameter values.</P>
<P>Also, 
  since the system was setting parameters, uncertainty was not an issue. The parameter 
  was either set to a value or it wasn't. For this reason pure Prolog was used 
  for the main rule base.</P>
<P>Pure 
  Prolog had the additional advantage of making it easy for the rules to generate 
  IDMS/R syntax. The arguments to the parameter setting rules were lists of words 
  in the correct syntax, with variables in the positions where the actual value 
  of the parameter was placed. The rules then sought those values and plugged 
  them into the correct syntax.</P>
<h1><B> <a name="theknowledgebase"></a>10.2 
  The Knowledge Base </B></h1>
<P>The 
  knowledge base is divided into six parts, designed to make it easy for the expert 
  to examine and maintain it. These are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>•&#9;main 
      rules for the parameters;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;rules 
      for derived information;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;questions 
      for the user;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;rules 
      for complex validation;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;rules 
      for complex default calculations;</P>
    <P> 
     
    <P> </P>
     
    <P>•&#9;static 
      information.</P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="ruleforparameters"></a>Rule 
  for parameters</B></h2>
<P>The 
  rules for each parameter are stored in the knowledge base with the parameter 
  name as the functor. Thus each parameter is represented by a predicate. The 
  argument to the predicate is a list with the actual IDMS/R syntax used to set 
  the parameter. Variables in the list are set by the body of the predicate. A 
  separate predicate, <B>parm</B>, is used to hold the predicate names which represent 
  parameters.</P>
<P>Most 
  knowledge bases are designed with askable information listed separately from 
  the rules, as in the earlier examples in the book. In this case however, the 
  experts wanted the relationship between user dialog and rules to be more explicit. 
  Therefor the <B>ask</B> predicate is embedded in the body of a rule whenever 
  it is appropriate. </P>
<P>In 
  the following example the parameter is <B>ina</B> which when set will result 
  in a text string of the form INACTIVE INTERVAL IS X, where X is some time value. 
  Some of the sub-goals which are derived from other rules are <B>online_components</B> 
  and <B>small_shop</B>, whereas <B>int_time_out_problems</B> is obtained from 
  the user.</P>
<DIR> 
  <DIR> 
    <P><B>parm(ina).</B></P>
    <P><B>ina( ['INACTIVE 
      INTERVAL IS', 60]):-<BR>
      online_components, <BR>
      small_shop.</B></P>
    <P><B>ina( ['INACTIVE 
      INTERVAL IS', 60]):-<BR>
      online_components, <BR>
      heavily_loaded.</B></P>
    <P><B>ina( ['INACTIVE 
      INTERVAL IS', 60]):-<BR>
      ask(initial_install, no), <BR>
      online_components, <BR>
      ask(int_time_out_problems, yes).</B></P>
    <P><B>ina( ['INACTIVE 
      INTERVAL IS', 30]):-<BR>
      online_components.</B></P>
  </DIR>
</DIR>
<P>Some 
  parameters also have subparameters which must be set. The structure of the knowledge 
  base reflects this situation:</P>
<DIR> 
  <DIR> 
    <P><B>parm(sys).</B></P>
    <P><B>sys( ['SYSCTL 
      IS', 'NO']):-<BR>
      never.</B></P>
    <P><B>sys( ['SYSCTL 
      IS', 'SYSCTL']):-<BR>
      os_class(os).</B></P>
    <P><B>subprm(sys, 
      dbn, [' DBNAME IS', 'NULL']):-<BR>
      ask(initial_install, no), &#9; <BR>
      ask(multiple_dictionaries, yes), <BR>
      ask(db_name, null).</B></P>
    <P><B>subprm(sys, 
      dbn, [' DBNAME IS', V1]):-<BR>
      ask(initial_install, no), &#9; <BR>
      ask(multiple_dictionaries, yes), <BR>
      ask(db_name, V1), <BR>
      V1 \== null.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="rulesforderivedinformation"></a>Rules 
  for derived information</B></h2>
<P>The 
  next part of the knowledge base contains the level of rules below the parameter 
  / subparameter level. These rules represent derived information. They read as 
  standard Prolog. Here are a few examples:</P>
<DIR> 
  <DIR> 
    <P><B>heavily_loaded:-<BR>
      ask(heavy_cpu_utilization, yes), !.</B></P>
    <P><B>heavily_loaded:-<BR>
      ask(heavy_channel_utilization, yes), !.</B></P>
    <P><B>mvs_xa:-&#9; 
      <BR>
      ask(operating_system, mvs), <BR>
      ask(xa_installed, yes), !.</B></P>
    <P><B>online_components:-<BR>
      dc_ucf, !.</B></P>
    <P><B>online_components:-<BR>
      ask(cv_online_components, yes), !.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="questionsfortheuser"></a>Questions 
  for the user</B></h2>
<P>The 
  next portion of the knowledge base describes the user interaction. Standard 
  Prolog rules do not cover this case, so special structures are used to hold 
  the information. Operator definitions are used to make it easy to work with 
  the structure.</P>
<P>The 
  first two examples show some of the default and edit rules which are simple 
  enough to keep directly in the question definition.</P>
<DIR> 
  <DIR> 
    <P><B>quest &#9;abend_storage_size</B></P>
    <P><B>default &#9;200</B></P>
    <P><B>edit &#9;between( 
      0, 32767)</B></P>
    <P><B>prompt<BR>
      ['Enter the amount of storage, in fullwords, available', <BR>
      'to the system for processing abends in the event', <BR>
      'of a task control element (TCE) stack overflow.', <BR>
      'Note that this resource is single threaded.'].</B></P>
    <P><B>quest &#9;abru_value</B></P>
    <P><B>default&#9;no</B></P>
    <P><B>edit&#9;member( 
      [yes, no])</B></P>
    <P><B>prompt<BR>
      ['Do you want the system to write a snap dump to the', <BR>
      'log file when an external run unit terminates', <BR>
      'abnormally?'].</B></P>
  </DIR>
</DIR>
<P>The 
  next two rules require more complex edit and default rule sets to be called. 
  The square brackets in the default field indicate there is a rule set to be 
  consulted. In these examples, <B>ed_batch_user</B> will be called to check the 
  answer to <B>allowed_batch_users</B>, and <B>def_storage_cushion</B> is used 
  to calculate a default value for <B>storage_cushion_size</B>.</P>
<DIR> 
  <DIR> 
    <P><B>quest&#9;allowed_batch_users</B></P>
    <P><B>default&#9;0</B></P>
    <P><B>edit&#9;ed_batch_user</B></P>
    <P><B>prompt<BR>
      ['How many concurrent batch jobs may access', <BR>
      'the CV at one time?'].</B></P>
    <P><B>quest&#9;storage_cushion_size</B></P>
    <P><B>default&#9;[def_storage_cushion]</B></P>
    <P><B>edit&#9;between( 
      0, 16384)</B></P>
    <P><B>prompt<BR>
      ['How many bytes of storage cushion would', <BR>
      'you like? When available storage is less than the', <BR>
      'cushion no new tasks are started. A recommended', <BR>
      'value has been calculated for you.'].</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="defaultrules"></a>Default 
  rules</B></h2>
<P>The 
  next two sections contain the rules which are used for edit and default calculations. 
  For example, the following rules are used to calculate a default value for the 
  storage cushion parameter. Notice that it in turn asks other questions and refers 
  to the settings of another parameter, in this case the storage pool (<B>stopoo</B>).</P>
<DIR> 
  <DIR> 
    <P><B>def_storage_cushion(CUS):-<BR>
      ask(initial_install, yes), <BR>
      stopoo([_, SP]), <BR>
      PSP is SP / 10, <BR>
      min(PSP, 100, CUS), !.</B></P>
    <P><B>def_storage_cushion(V1):-<BR>
      ask(total_buffer_pools, V2), <BR>
      stopoo([_, V3]), <BR>
      ask(maximum_tasks, V4), <BR>
      V1 is (V2 + V3 + 3) / (3 * V4), !.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="rulesforedits"></a>Rules 
  for edits</B></h2>
<P>Here 
  are the rules which are used to edit the response to the number of batch users. 
  The user's response is passed as the argument and rules succeed or fail in standard 
  Prolog fashion depending on the user's response.</P>
<DIR> 
  <DIR> 
    <P><B>ed_batch_user(V1):-<BR>
      V1 =&lt; 2, !.</B></P>
    <P><B>ed_batch_user(V1):-<BR>
      machine_size(large), <BR>
      V1 =&lt; 10, !.</B></P>
    <P><B>ed_batch_user(V1):-<BR>
      machine_size(medium), <BR>
      V1 =&lt; 5, !.</B></P>
    <P><B>ed_batch_user(V1):-<BR>
      machine_size(small), <BR>
      V1 =&lt; 3, !.</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="staticinformation"></a>Static 
  information</B></h2>
<P>The 
  final section contains factual information. For example, here is a table of 
  the MIPS ratings for various machines, and the rules used to broadly classify 
  machines into sizes.</P>
<DIR><B></b> 
  <DIR> 
    <P><B>mac_mips('4381-1', 
      1.7).</B></P>
    <P><B>mac_mips('4381-2', 
      2.3).</B></P>
    <P><B>mac_mips('3083EX', 
      3.7).</B></P>
    <P><B>mac_mips('3083BX', 
      6.0).</B></P>
    <P><B>mac_mips('3081GX', 
      12.2).</B></P>
    <P><B>mac_mips('3081KX', 
      15.5).</B></P>
    <P><B>mac_mips('3084QX', 
      28.5).</B></P>
      
    <P><B>mips_size(M, 
      tiny):-<BR>
      M &lt; 0.5, !.</B></P>
    <P><B>mips_size(M, 
      small):-<BR>
      M &gt;= 0.5, <BR>
      M &lt; 1.5, !.</B></P>
    <P><B>mips_size(M, 
      medium):-<BR>
      M &gt;= 1.5, <BR>
      M &lt; 10, !.</B></P>
    <P><B>mips_size(M, 
      large):-<BR>
      M &gt;= 10. </B></P>
  </DIR>
</DIR>
<P>The 
  knowledge base is designed to reduce the semantic gap between it and the way 
  in which the experts view the knowledge. The main parameter setting rules are 
  organized by parameter and subparameter as the expert expects. The secondary 
  rules for deriving information, and the queries to the user are kept in separate 
  sections.</P>
<P>The 
  dialog with the user is defined by data structures which act as specialized 
  frames with slots for default routines and edit routines. Their definition is 
  relatively simple since the frames are not general purpose, but designed specifically 
  to represent knowledge as the expert describes it.</P>
<P>The 
  standard Prolog rule format is used to define the edit and default rules. In 
  the knowledge base the rules are simple, so Prolog's native syntax is not unreasonable 
  to use. It would of course be possible to utilize a different syntax, but the 
  Prolog syntax captures the semantics of these rules exactly. The experts working 
  with the knowledge base are technically oriented and easily understand the Prolog 
  syntax. Finally, supporting data used by the system is stored directly in the 
  knowledge base.</P>
<P>It 
  is up to the inference engine to make sense of this knowledge base.</P>
<h1><B> <a name="inferenceengine"></a>10.3 
  Inference Engine </B></h1>
<P>The 
  inference is organized around the specialized knowledge base. The highest level 

  predicates are set up to look for values for all of the parameters. The basic 
  predicate <B>set_parms</B> accomplishes this. It uses the parm predicate to 
  get parameter names and then uses the <B>univ</B> (<B>=..</B>) built-in function 
  to build a call to a parameter setting predicate.</P>
<DIR> 
  <DIR> 
    <P><B>set_parms:-<BR>
      parm(Parm), <BR>
      set_parm(Parm), <BR>
      fail.</B></P>
    <P><B>set_parms:-<BR>
      write('no more parms'), nl.</B></P>
    <P><B>set_parm(Parm):-<BR>
      get_parm(Parm, Syntax), <BR>
      write(Parm), write(': '), <BR>
      print_line(Syntax), nl, <BR>
      subs(Parm).</B></P>
    <P><B>get_parm(Parm, 
      Syntax):-<BR>
      PS =.. [Parm, Syntax], <BR>
      call(PS), !. </B></P>
    <P><B>subs(Parm):-<BR>
      subprm(Parm, Sub, Syntax), <BR>
      write(Parm), write('/'), write(Sub), write(':'), <BR>
      print_line(Syntax), nl, <BR>
      subs(Sub), <BR>
      fail.</B></P>
    <P><B>subs(Parm):-true.</B></P>
  </DIR>
</DIR>
<P>The 
  next portion of the inference engine deals with the questions to the user. The 
  following operator definitions are used to define the data structure for questions.</P>
<DIR><B></b> 
  <DIR> 
    <P><B>:-op(250, 
      fx, quest).</B></P>
    <P><B>:-op(240, 
      yfx, default).</B></P>
    <P><B>:-op(240, 
      yfx, edit).</B></P>
    <P><B>:-op(240, 
      yfx, prompt).</B></P>
  </DIR>
</DIR>
<P>The 
  basic <B>ask</B> predicate follows the patterns used earlier, but is more complex 
  due to the fact that it handles both attribute-value pairs and object-attribute-value 
  triples. The implementation of triples is relatively straight-forward and not 
  worth repeating. The interesting portions of <B>ask</B> have to do with handling 
  defaults and edits.</P>
<P>The 
  following code is used by the <B>ask</B> predicate to perform edits on a user 
  response. It is called after the user enters a value. If the edit fails, the 
  user is presented with an explanation for why the edit failed, and is reprompted 
  for the answer.</P>
<P>The 
  third argument to <B>edit</B> is the edit criterion. It could be a simple edit 
  such as <B>member</B> or <B>less_than</B>, or one of the more complex edit rules. 
  The built-in <B>univ</B> (<B>=..</B>) is used to construct the goal which is 
  called for the edit process. The actual code is slightly more complex due to 
  additional arguments holding trace information for explanations.</P>
<DIR> 
  <DIR><B>  </b> 
    <P><B>edit(X, X, 
      none):-!.&#9;&#9;</b>% 
      passes, no edit criteria.</P>
    <P><B>edit(X, X, 
      Ed) :-<BR>
      Ed =.. [Pred | Args], <BR>
      Edx =.. [Pred, X | Args], <BR>
      call(Edx), <BR>
      !.</B></P>
    <P><B>edit(X, X, 
      not(Ed)):-<BR>
      Ed =.. [Pred | Args], </b><BR>
      <B>Edx =.. [Pred, X | Args], </B> <B><BR>
      notcall(Edx), </B><BR>
      <B>!.</b></P>
  </DIR>
</DIR>
<P>The 
  default is handled in a similar fashion. It is calculated before the prompt 
  to the user, and is displayed in the answer window. Just hitting enter allows 
  the user to take the default rather than entering a new value.</P>
<DIR> 
  <DIR>   
    <P><B>default([], 
      []):-!.</B></P>
    <P><B>default(D, 
      D):-<BR>
      atomic(D), !.</B></P>
    <P><B>default([D], 
      X):-<BR>
      P =.. [D, X],<BR>
      call(P).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="explanations"></a>10.4 
  Explanations </B></h1>
<P>Explanations 
  become a bit more difficult with the <B>ask</B> predicate. The how questions 
  are handled pretty much as in the Clam and Native systems described earlier 
  in the book. Since why traces require overhead during the inference process, 
  and performance is a key issue for a system with a long dialog such as this 
  one, the why trace implementation is different from that in Native. The basic 
  strategy is to use pure Prolog as indicated for most of the inferencing, but 
  to redo the inference using a Prolog in Prolog inference engine to answer why 
  questions.</P>
<P>In 
  order to do this the system must in fact restart the inference, but since the 
  parameters are all basically independent, the why trace need only restart from 
  the last call to set a parameter. For this reason, the <B>set_parm</B> predicate 
  writes a record to the database indicating which parameter is currently being 
  set.</P>
<P>Once 
  the why trace gets into <B>ask</B>, the Prolog in Prolog must stop. In fact, 
  the question might have arisen from setting a parameter, or calculating a default 
  value, or specifying an edit criteria. Again, for these cases a flag is kept 
  in the database so that trace knows the current situation.</P>
<P>The 
  why trace then starts at the beginning, traces pure Prolog inferencing until 
  it encounters <B>ask</B>. The why explanation then notes that it is in <B>ask</B>, 
  and finds out from the database if <B>ask</B> has gone into either <B>default</B> 
  or <B>edit</B>. If so it proceeds to trace the <B>default</B> or <B>edit</B> 
  code. The final explanation to the user has the Prolog traces interspersed with 
  the various junctions caused by <B>edit</B> and <B>default</B> in ask.</P>
<P>This 
  system is a perfect example of one in which the explanations are of more use 
  in diagnosing the system than in shedding light on an answer for the user. Many 
  of the rules are based solely on empirical evidence, and reflect no understanding 
  of underlying principles. For this reason a separate explanation facility was 
  added to the knowledge base that would explain in English the rationale behind 
  the setting of a particular parameter.</P>
<P>For 
  example, the setting of the <B>maxeru</B> parameter is relatively complex. The 
  rule, while correct in figuring a value for the parameter, does not give much 
  insight into it. The separate <B>exp</B> predicate in the knowledge base is 
  displayed in addition to the rule if the user asks how a value of <B>maxeru</B> 
  was derived.</P>
<DIR> 
  <DIR> 
    <P><B>parm(maxeru).</B></P>
    <P><B>maxeru( ['MAXIMUM 
      ERUS IS', MAXERU]):-<BR>
      maxeru_potential(PMERU), <BR>
      max_eru_tas(F), <BR>
      MAXERUF is PMERU * F, <BR>
      MAXERU is integer(MAXERUF), <BR>
      explain(maxerutas01).</B></P>
    <P><B>exp(maxerutas01, 
      <BR>
      ['MAXERUS and MAXTASKS are set together. They are ', <BR>
      'both potentially set to values which are dictated by the size ', <BR>
      'of the terminal network. The total tasks for both is then ', <BR>
      'compared to the maximum realistic number for the ', <BR>
      'machine size. If the total tasks is too high, both ', <BR>
      'MAXERUS and MAXTASKS are scaled down ', <BR>
      'accordingly.']).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="environment"></a>10.5 
  Environment </B></h1>
<P>CVGEN 
  is also designed to handle many of the details necessary in a commercially deployed 
  system. These details include the ability to change an answer to a question, 
  save a consultation session and restore it, build and save test runs of the 
  system, and the ability to list and examine the cache and the knowledge base 
  from within a consultation. The system also includes a tutorial which teaches 
  how to use the system.</P>
<P>Most 
  of these features are straight-forward to implement, however changing a response 
  is a bit tricky. When the user changes an answer to a question, it is almost 
  impossible to predict what effects that will have on the results. Whole new 
  chains of inferencing might be triggered. The safest way to incorporate the 
  change is to rerun the inference. By saving the user's responses to questions, 
  the system avoids asking any questions previously asked. New questions might 
  be asked due to the new sequence of rules fired after the change.</P>
<P>The 
  facts which are stored are not necessarily the same as the user's response. 
  In particular, the user response of "take the default" is different from the 
  actual answer which is the default value itself. For this reason, both the facts 
  and the user responses to questions are cached. Thus when the user asks to change 
  a response, the response can be edited and the inference rerun without reprompting 
  for all of the answers.</P>
<P>This 
  list of responses can also be used for building test cases which are rerun as 
  the knowledge base is modified.</P>
<h1><B> <a name="aijmp"></a>10.6 
  AIJMP </B></h1>
<P>The 
  AIJMP system seemed on the surface to be identical to the CVGEN system. Both 
  set parameters. It was initially assumed that the shell used for CVGEN could 
  be applied to AIJMP as well. While this was in general true, there were still 
  key areas which needed to be changed.</P>
<P>The 
  differences have much to do with the nature of the user interaction. The CVGEN 
  system fits very nicely into the classic expert system dialog as first defined 
  in the MYCIN system. The system tries to reach goals and asks questions as it 
  goes. However for AIJMP there is often the need for large amounts of tabular 
  data on various pieces of hardware and software. For these cases a question 
  and answer format becomes very tedious for the user and a form-based front end 
  to gather information is much more appropriate.</P>
<P>AIJMP 
  uses forms to capture some data, and dialogs to ask for other data as needed. 
  This led to the need to expand the basic inferencing to handle these cases.</P>
<P>Another 
  difficulty became evident in the nature of the expertise. Much of what was needed 
  was purely algorithmic expertise. For example, part of the system uses formulas 
  to compute library sizes based on different storage media. Many of the parameters 
  required both rules of thumb and algorithmic calculations. </P>
<P>The 
  best solution to the problem, for the knowledge engineer, was to build into 
  the inference engine the various predicates which performed calculations. This 
  way they could be referred to easily from within the rules.</P>
<P>Some 
  of the declarative knowledge required for AIJMP could not be easily represented 
  in rules. For example, many products depend on the existence of co-requisite 
  products. When the user enters a list of products to be installed, it must be 
  checked to make sure all product dependencies are satisfied. The clearest way 
  to represent this knowledge was with specialized data structures. Operators 
  are used to make the structures easy to work with.</P>
<DIR> 
  <DIR> 
    <P><B>product 'ads 
      batch 10.1'<BR>
      psw [adsb]<BR>
      coreqs ['idms db', 'i data dict'].</B></P>
    <P><B>product 'ads 
      batch 10.2'<BR>
      psw [adsb]<BR>
      coreqs ['idms db', 'i data dict'].</B></P>
    <P><B>product 'ads 
      online'<BR>
      psw [adso, nlin]<BR>
      coreqs ['idms db', 'idms cv', 'i data dict', 'idms dc' / 'idms ucf'].</B></P>
    <P><B>product auditor<BR>
      psw [audi, culp]<BR>
      coreqs [].</B></P>
    <P><B>product autofile<BR>
      psw [auto] <BR>
      coreqs [].</B></P>
  </DIR>
</DIR>
<P>The 
  inference engine was enhanced to use this structure for co-requisite checking. 
  The design goal is to make the knowledge base look as familiar as possible to 
  the experts. With Prolog, it is not difficult to define specialized structures 
  that minimize semantic gap and to modify the inference engine to use them.</P>
<P>One 
  simple example of how the custom approach makes life easier for the expert and 
  knowledge engineer is in the syntax for default specifications in the questions 
  for the user. The manual on setting these parameters used the "@" symbol to 
  indicate that a parameter had as its default the value of another parameter. 
  This was a shorthand syntax well understood by the experts. In many cases the 
  same value (for example a volume id on a disk) would be used for many parameters 
  by default. Only a slight modification to the code allowed the knowledge to 
  be expressed using this familiar syntax:</P>
<DIR> 
  <DIR> 
    <P><B>quest&#9;loadunit</B></P>
    <P><B>default&#9;@ 
      diskunit</B></P>
    <P><B>edit&#9;none</B></P>
    <P><B>prompt<BR>
      ['What is the unit for the load library?'].</B></P>
  </DIR>
</DIR>
<P>One 
  of the major bottlenecks in expert system development is knowledge engineering. 
  By customizing the knowledge base so it more closely matches the expert's view 
  of the knowledge domain, the task becomes that much simpler. A simple change 
  such as this one makes it easier for the expert and the knowledge base to interact.</P>
<h1><B> <a name="summary"></a>10.7 
  Summary </B></h1>
<P>These 
  two systems show how some of the techniques in this book can be used to build 
  real systems. The examples also show some of the difficulties with shells, and 
  the advantages of customized systems in reducing semantic gap.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>10.1 
  - Incorporate data structures for user queries with edits and defaults for the 
  Clam shell.</P>
<P> 
 
<P> </P>
 
<P>10.2 
  - The CVGEN user query behavior can be built into Foops when a value is sought 
  from the frame instances. If there is no other way to get the value, the user 
  should be queried. Additional facets can be used for prompt, default, and edit 
  criteria which the inference engine uses just like in CVGEN.</P>
<P> 
 
<P> </P>
 
<P>10.3 - Add features 
  of CVGEN to the shells which are needed for real world applications. These include 
  the ability to save user responses, allow editting of responses, saving a consultation, 
  and rerunning a consultation. The last feature is essential for testing and 
  debugging systems. Old test runs can be saved and rerun as the knowledge base 
  changes. Hopefully the changes will not adversely affect the old runs.</P>


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
