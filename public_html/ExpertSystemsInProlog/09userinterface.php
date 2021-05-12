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
<td><h1>9 User Interface</h1></td>
<td style="text-align:right;">

</td>
</tr>
</table>        <hr />

<P>The 
  user interface issues for expert system shells can be divided between two classes 
  of users and two different levels. The two users are the developer and the end-user 
  of the application. The levels are the external interface and the internal function.</P>
<P>For 
  the developer, the internal function must be adequate before the external interface 
  becomes a factor. To build a configuration application, an easy-to-use backward 
  chaining system is not as good as a hard-to-use forward chaining system. To 
  build a large configuration system, an easy-to-use, low performance forward 
  chaining system is not as good as a hard-to-use, high performance forward chaining 
  system.</P>
<P>The 
  same is true for the end-user. While there is increasing awareness of the need 
  for good external interfaces, it should not be forgotten that the internal function 
  is still the heart of an application. If a doctor wants a diagnostic system 
  to act as an intelligent assistant and instead it acts as an all knowing guru, 
  then it doesn't matter how well the external interface is designed. The system 
  will be a failure. If a system can save a company millions of dollars by more 
  accurately configuring computers, then the system will be used no matter how 
  poor the external interface is.</P>
<P>Given 
  a system meets the needs of both the developer and the end-user, then the external 
  interface becomes an essential ingredient in the satisfaction with the system. 
  The systems developed so far have used a command driven, dialog type user interface. 
  Increasingly windows, menus, and forms are being used to make interfaces easier 
  to understand and work with. This chapter describes how to build the tools necessary 
  for developing good user interfaces.</P>
<h1><B> <a name="objectorientedwindowinterface"></a>9.1 
  Object Oriented Window Interface </B></h1>
<P>One 
  of the major difficulties with computer languages in general, and Prolog in 
  particular, is the lack of standards for user interface features. There are 
  emerging standards, but there is still a long way to go. The windowing system 
  described here includes a high-level, object oriented interface for performing 
  common window, menu, and form operations which can be used with any Prolog or 
  computer. The low level implementation will vary from Prolog to Prolog, and 
  computer to computer.</P>
<P>The 
  interface is object oriented in that each window, menu, and form in the system 
  is considered to be a "window-object" which responds to messages requesting 
  various behaviors. For example, a display window would respond to "write" messages, 
  and both a menu and prompt window would respond to a "read" message.</P>
<P>The 
  developer using the system defines window-objects to be used in an application 
  and then uses a single predicate, <B>window</B>, to send messages to them. The 
  system can be easily extended to include new messages, and window-objects. For 
  example, graphics can be included for systems which support it.</P>
<h1><B> <a name="developersinterfacetowindows"></a>9.2 
  Developer's Interface to Windows </B></h1>
<P>The 
  windows module provides for overlapping windows of four basic flavors.</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>display</b> 
      &#9;An output only window. The user may scroll the window up and down using 
      the cursor keys.</P>
    <P> 
     
    <P> </P>
     
    <P><B>menu</b> 
      &#9;A pop-up vertical menu.</P>
    <P> 
     
    <P> </P>
     
    <P><B>form</b> 
      &#9;A fill in the blanks form.</P>
    <P> 
     
    <P> </P>
     
    <P><B>prompt</b> 
      &#9;A one line input window.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  programmer creates the various windows by specifying their attributes with a 
  create message. Other window messages are used to open, close, read, or write 
  the window.</P>
<P>All 
  of the window operations are performed with the predicate <B>window</B>. It 
  can either be specified with two or three arguments depending on whether the 
  message requires an argument list. The arguments are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P>the 
      window-object name or description, </P>
    <P> 
     
    <P> </P>
     
    <P>the 
      operation to be performed (message), </P>
    <P> 
     
    <P> </P>
     
    <P>the 
      arguments for the operation (optional).</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>For 
  example, the following Prolog goals cause: a value to be selected from a main 
  menu, a value to be written to a display window, and a useless window to be 
  closed:</P>
<DIR> 
  <DIR> 
    <P><B>window(main_menu, 
      read, X).</B></P>
    <P><B>window(listing, 
      write, 'Hello').</B></P>
    <P><B>window(useless, 
      close).</B></P>
  </DIR>
</DIR>
<P>A 
  window description is a list of terms. The functors describe the attribute, 
  and the arguments are the value(s). Some of the attributes used to define a 
  window are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>type(T)</b> 
      - type of window (display, prompt, menu, or form), </P>
    <P> 
     
    <P> </P>
     
    <P><B>coord(R1, 
      C1, R2, C2) </b> - the upper left and lower right coordinates of useable 
      window space, </P>
    <P> 
     
    <P> </P>
     
    <P><B>border(Color)</b> 
      - the border color, </P>
    <P> 
     
    <P> </P>
     
    <P><B>contents(Color)</b> 
      - the color of the contents of the window.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>The 
  following two attributes are used to initialize menus and forms:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>menu(List)</b> 
      - List is a list of menu items. </P>
    <P> 
     
    <P> </P>
     
    <P><B>form(Field_List)</b> 
      - Field_List defines the fields in the form. The field may be either a literal 
      or a variable. The two formats are:</P>
    <P>&#9;&#9;&#9;lit(Row:Col, 
      Literal), </P>
    <P>&#9;&#9;&#9;var(FieldName, 
      Row:Col, Length, InitialValue).</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>Some 
  examples of window descriptions are:</P>
<DIR> 
  <DIR> 
    <P><B>[type(display), 
      coord(2, 3, 10, 42), border(white:blue), contents(white:blue)]</B></P>
    <P><B>[type(menu), 
      coord(10, 50, 12, 70), border(bright:green), <BR>
      menu(['first choice', <BR>
      &#9;'second choice', <BR>
      &#9;'third choice', <BR>
      &#9;'fourth choice'])]</B></P>
    <P><B>[type(form), 
      coord(15, 34, 22, 76), border(blue), <BR>
      form([lit(2:2, 'Field One'), <BR>
      &#9;var(one, 2:12, 5, ''), <BR>
      &#9;lit(4:2, 'Field Two'), <BR>
      &#9;var(two, 4:12, 5, 'init')])]</B></P>
  </DIR>
</DIR>
<P>The 
  first argument of each window command refers to a window-object. It may either 
  be the name of a created window, or a window description. If a description is 
  used, the window is created and used only for the duration of the command. This 
  is useful for pop up menus, prompts and forms. Created windows are more permanent.</P>
<P>Some 
  of the messages which can be sent to windows are:</P>
<P> 
 
<P> </P>
 
<DIR> 
  <DIR> 
    <P><B>window(W, 
      create, Description)</b> - stores the Description with the name W;</P>
    <P> 
     
    <P> </P>
     
    <P><B>window(W, 
      open)</b> - opens a window by displaying it as the current top window (usually 
      not necessary since most messages open a window first);</P>
    <P> 
     
    <P> </P>
     
    <P><B>window(W, 
      close)</b> - closes the window by removing the viewport from the screen 
      while preserving the contents (for later re-opening);</P>
    <P> 
     
    <P> </P>
     
    <P><B>window(W, 
      erase)</b> - closes the window, and erases the contents as well;</P>
    <P> 
     
    <P> </P>
     
    <P><B>window(W, 
      display, X)</b> - writes the term X to the window.</P>
    <P> 
     
    <P> </P>
     </DIR>
</DIR>
<P>To 
  use the windows to improve the user interface of a simple expert system shell, 
  the main menu can be made a pop-up menu. The text for questions to the user 
  can appear in one window, and the user can respond using pop-up menus or prompt 
  windows. The advice from the system can appear in another window.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="userinterface9-1.gif" WIDTH=375 HEIGHT=239><BR>
  </P>
<P>Figure 
  9.1. Main menu</P>
<P>First, 
  the permanent windows are created during the initialization phase. The descriptions 
  are stored in Prolog's database with the window name for use when the window 
  is referenced. The windows for a simple interface include the main menu, the 
  window for advice, and the window for questions to the user:</P>
<DIR> 
  <DIR> 
    <P><B>window_init:-<BR>
      window(wmain, create, <BR>
      &#9;[type(menu), coord(14, 25, 21, 40), <BR>
      &#9;border(blue), contents(yellow), <BR>
      &#9;menu(['Load', <BR>
      &#9;&#9;'Consult', <BR>
      &#9;&#9;'Explain', <BR>
      &#9;&#9;'Trace', <BR>
      &#9;&#9;'Quit'])]), <BR>
      window(advice, create, [type(display), coord(1, 1, 10, 78), <BR>
      &#9;border(blue:white), contents(blue:white)]), <BR>
      window(quest, create, [type(display), coord(13, 10, 13, 70), <BR>
      &#9;border(blue:white), contents(blue:white)]).</B></P>
  </DIR>
</DIR>
<P>The 
  main loop then uses the main menu:</P>
<DIR> 
  <DIR> 
    <P><B>go :-<BR>
      repeat, <BR>
      window(wmain, read, X), <BR>
      do(X), <BR>
      fail.</B></P>
  </DIR>
</DIR>
<P>The 
  user sees a menu as in figure 9.1. The cursor keys move the highlighting bar, 
  and the enter key selects a menu item. The <B>ask</B> and <B>menuask</B> predicates 
  in the system use the windows to get information from the user. First <B>ask</B> 
  writes the text of the question to the quest window, and then generates a pop-up 
  prompt:</P>
<DIR> 
  <DIR> 
    <P><B>ask(A, V) 
      :-<BR>
      window(quest, write, A), <BR>
      window([type(prompt), coord(16, 10, 16, 70), border(white:blue), <BR>
      &#9;contents(white:blue)], <BR>
      &#9;read, ['', Y]), <BR>
      asserta(known(A, Y)), <BR>
      ...</B></P>
  </DIR>
</DIR>
<P>The 
  <B>menuask</B> predicate also writes the text of the question to the quest window, 
  but then dynamically builds a pop-up menu, computing the size of the menu from 
  the length of the menu list:</P>
<DIR> 
  <DIR> 
    <P><B>menuask(Attribute, 
      AskValue, Menu):-<BR>
      length(Menu, L), <BR>
      R1 = 16, <BR>
      R2 is R1 + L - 1, <BR>
      window(quest, write, Attribute), <BR>
      window([type(menu), coord(R1, 10, R2, 40), border(white:blue), <BR>
      &#9;contents(white:blue), menu(Menu)], <BR>
      &#9;read, Value), <BR>
      asserta(known(Attribute, Value)), <BR>
      ...</B></P>
  </DIR>
</DIR>
<P>Figure 
  9.2 shows how a simple window interface would look with the Birds expert system.</P>
<P ALIGN="CENTER"><BR>
  <IMG SRC="userinterface9-2.gif" WIDTH=375 HEIGHT=239><BR>
  </P>
<P>Figure 
  9.2. Window interface for dialog with Birds system</P>
<h1><B> <a name="highlevelwindowimplementation"></a>9.3 
  High-Level Window Implementation </B></h1>
<P>The 
  window module is constructed in layers. The top layer can be used with any Prolog. 
  The lower layers have the actual implementations of the windows and vary from 
  system to system. The detailed examples will come from a Macintosh based Prolog 
  (AAIS) using a rich user interface toolbox, and a PC based Prolog (Arity) using 
  simple screen primitives.</P>
<h2 ALIGN="JUSTIFY"><B><a name="messagepassing"></a>Message 
  Passing</B></h2>
<P>At 
  the top level, the interface is object oriented. This means messages are sent 
  to the individual windows. One feature of object oriented systems is messages 
  are dispatched at run time based on the class of object. For example, the read 
  message applies to both the prompt windows and the menu windows, but the implementation 
  is different in each case. The implementations are called methods. The window 
  predicate must determine what type of window is receiving the message, and what 
  the correct method to call is:</P>
<DIR> 
  <DIR> 
    <P><B>window(W, 
      Op, Args):-<BR>
      get_type(W, T), <BR>
      find_proc(T, Op, Proc), <BR>
      P =.. [Proc, W, Args], <BR>
      call(P), !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>get_type</B> predicate finds the type of the window, <B>find_proc</B> gets 
  the correct method to call, and univ (<B>=..</B>) is used to call it.</P>
<P>When 
  <B>window</B> is called with a window description as the first argument, it 
  creates a temporary window, sends the message to it, and then deletes it. A 
  two argument version of window is used to capture calls with no arguments.</P>
<DIR> 
  <DIR> 
    <P><B>window([H|T], 
      Op, Args):-<BR>
      window(temp_w, create, [H|T]), <BR>
      window(temp_w, Op, Args), <BR>
      window(temp_w, delete), !.</B></P>
    <P><B>window(W, 
      Op) :- window(W, Op, []).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>get_type</B> predicate uses <B>select_parm</B> to find the value for the 
  type attribute of the window. It uses the stored window definition.</P>
<DIR> 
  <DIR> 
    <P><B>get_type(W, 
      X):- select_parm(W, [type(X)]), !.</B></P>
  </DIR>
</DIR>
<P>Window 
  definitions are stored in structures of the form:</P>
<DIR> 
  <DIR> 
    <P><B>wd(W, AttributeList).</B></P>
  </DIR>
</DIR>
<h2 ALIGN="JUSTIFY"><B><a name="inheritance"></a>Inheritance</B></h2>
<P>Another 
  feature of object oriented systems is inheritance of methods. The objects are 
  arranged in a class hierarchy, and lower level objects only have methods defined 
  for them which are different from the higher level methods. In the window program, 
  <B>type(window)</B> is the highest class, and the other types are subclasses 
  of it. A predicate such as <B>close</B> is only defined for the window superclass 
  and not redefined for the subclasses.</P>
<P>This 
  makes it easy to add new window types to the system. The new types can inherit 
  many of the methods of the existing types. </P>
<P>The 
  classes are represented in Prolog using a subclass predicate:</P>
<DIR> 
  <DIR> 
    <P><B>subclass(window, 
      display).</B></P>
    <P><B>subclass(window, 
      menu).</B></P>
    <P><B>subclass(window, 
      form).</B></P>
    <P><B>subclass(window, 
      prompt).</B></P>
  </DIR>
</DIR>
<P>The 
  methods are associated with classes by a method predicate. Some of the defined 
  methods are:</P>
<DIR> 
  <DIR> 
    <P><B>method(window, 
      open, open_w).</B></P>
    <P><B>method(window, 
      close, close_w).</B></P>
    <P><B>method(window, 
      create, create_w).</B></P>
    <P><B>method(window, 
      display, display_w).</B></P>
    <P><B>method(window, 
      delete, delete_w).</B></P>
    <P><B>method(display, 
      write, write_d).</B></P>
    <P><B>method(display, 
      writeline, writeline_d).</B></P>
    <P><B>method(menu, 
      read, read_m).</B></P>
    <P><B>method(form, 
      read, read_f).</B></P>
    <P><B>method(prompt, 
      read, read_p).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>find_proc</B> predicate is the one that looks for the correct method to call 
  for a given message and a given window type. </P>
<DIR> 
  <DIR> 
    <P><B>find_proc(T, 
      Op, Proc):- find_p(T, Op, Proc), !.</B></P>
    <P><B>find_proc(T, 
      Op, Proc):-<BR>
      error([Op, 'is illegal operation for a window of type', T]).</B></P>
    <P><B>find_p(T, 
      Op, Proc):- method(T, Op, Proc), !.</B></P>
    <P><B>find_p(T, 
      Op, Proc):-<BR>
      subclass(Super, T), <BR>
      !, find_p(Super, Op, Proc).</B></P>
  </DIR>
</DIR>
<P>This 
  completes the definition of the high level interface, with the exception of 
  the one utility predicate, <B>select_parm</B>. It is used by <B>get_type</B> 
  to find the value of the type attribute, but is also heavily used by the rest 
  of the system to find attributes of windows, such as coordinates. It has the 
  logic built into it to allow for calculated attributes, such as height, and 
  attribute defaults. It is called with a request list of the desired attributes. 
  For example, to get a window's coordinates, height, and color:</P>
<DIR> 
  <DIR> 
    <P><B>select_parm(W, 
      [coord(R1, C1, R2, C2), height(H), color(C)]).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>select_parm</B> predicate gets the windows attribute list, and calls the 
  <B>fulfill</B> predicate to unify the variables in the request list with the 
  values of the same attributes in the window definition.</P>
<DIR> 
  <DIR> 
    <P><B>select_parm(W, 
      RequestList):-<BR>
      wd(W, AttrList), <BR>
      fulfill(RequestList, AttrList), !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>fulfill</B> predicate recurses through the request list, calling <B>w_attr</B> 
  each time to get the value for a particular attribute.</P>
<DIR> 
  <DIR> 
    <P><B>fulfill([], 
      _):-!.</B></P>
    <P><B>fulfill([Req|T], 
      AttrList):-<BR>
      w_attr(Req, AttrList), <BR>
      !, fulfill(T, AttrList).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>w_attr</B> predicate deals with three cases. The first is the simple case 
  that the requested attribute is on the list of defined attributes. The second 
  is for attributes that are calculated from defined attributes. The third sets 
  defaults when the first two fail. Here are some of the <B>w_attr</B> clauses:</P>
<DIR> 
  <DIR> 
    <P><B>w_attr(A, 
      AttrList):-<BR>
      member(A, AttrList), !.</B></P>
    <P>% calculated 
      attributes</P>
    <P><B>w_attr(height(H), 
      AttrList):-<BR>
      w_attr(coord(R1, _, R2, _), AttrList), <BR>
      H is R2 - R1 + 1, !.</B></P>
    <P><B>w_attr(width(W), 
      AttrList):-<BR>
      w_attr(coord(_, C1, _, C2), AttrList), <BR>
      W is C2 - C1 + 1, !.</B></P>
    <P>% default attributes</P>
    <P><B>w_attr(title(''), 
      _).</B></P>
    <P><B>w_attr(border(white), 
      _).</B></P>
    <P><B>w_attr(contents(white), 
      _).</B></P>
    <P><B>w_attr(type(display), 
      _).</B></P>
  </DIR>
</DIR>
<h1><B> <a name="lowlevelwindowimplementation"></a>9.4 
  Low-Level Window Implementation </B></h1>
<P>In 
  addition to being a powerful language for artificial intelligence applications, 
  Prolog is good at implementing more standard types of programs as well. Since 
  most programs can be specified logically, Prolog is a very efficient tool. While 
  we will not look at all the details in this chapter, a few samples from the 
  low-level implementation should demonstrate this point. An entire overlapping 
  window system with reasonable response time was implemented 100% in Prolog using 
  just low-level screen manipulation predicates.</P>
<P>The 
  first example shows predicates which give the user control over a menu. They 
  follow very closely the logical specification of a menu driver. A main loop, 
  <B>menu_select</B>, captures keystrokes, and then there are a number of rules, 
  <B>m_cur</B>, governing what to do when various keys are hit. Here is the main 
  loop for the Arity Prolog PC implementation:</P>
<DIR> 
  <DIR> 
    <P> <B>menu_select(W, 
      X):-<BR>
      select_parm(W, [coord(R1, C1, R2, _), width(L), attr(A)]), <BR>
      tmove(R1, C1), &#9;</b>% move the cursor to first item<BR>
      <B>revideo(L, A), &#9;&#9;</B>% reverse video first item<BR>
      <B>repeat, <BR>
      keyb(_, S), &#9;&#9;</B>% read the keyboard<BR>
      <B>m_cur(S, Z, w(W, R1, R2, C1, L, A)), &#9;</B>%usually fails<BR>
      <B>!, Z = X.</b></P>
  </DIR>
</DIR>
<P>Here 
  are four of the menu rules covering the cases where: the down arrow (scan code 
  of 80) is hit (highlight the next selection); the down arrow is hit at the bottom 
  of the menu (scroll the menu); the home key (scan code of 71) is hit (go to 
  the top); and the enter key (scan code of 28) is hit (finally succeed and select 
  the item).</P>
<DIR> 
  <DIR> 
    <P> <B>m_cur(80, 
      _, w(W, R1, R2, C1, L, A)):-&#9;</b>% down arrow<BR>
      <B>tget(R, _), <BR>
      R &lt; R2, <BR>
      normvideo(L, A), <BR>
      RR is R + 1, <BR>
      tmove(RR, C1), <BR>
      revideo(L, A), <BR>
      !, fail.</b></P>
    <P> <B>m_cur(80, 
      _, w(W, R1, R2, C1, L, A)):-&#9;</b>% bottom down arrow<BR>
      <B>tget(R, _), <BR>
      R &gt;= R2, <BR>
      normvideo(L, A), <BR>
      scroll_window(W, 1), <BR>
      tmove(R2, C1), <BR>
      revideo(L, A), <BR>
      !, fail.</b></P>
    <P> <B>m_cur(71, 
      _, w(W, R1, R2, C1, L, A)):-&#9;</b>% home key<BR>
      <B>normvideo(L, A), <BR>
      scroll_window(W, top), <BR>
      tmove(R1, C1), <BR>
      revideo(L, A), <BR>
      !, fail.</b></P>
    <P> <B>m_cur(28, 
      X, w(W, R1, R2, C1, L, A)):-&#9;</b>% enter key<B><BR>
      tget(R, _), <BR>
      select_stat(W, curline, Line), &#9;</B>% current line<BR>
      <B>Nth is Line + R - R1, <BR>
      getnth(W, Nth, X), <BR>
      normvideo(L, A), !.</b></P>
  </DIR>
</DIR>
<P>Here 
  is some of the code that deals with overlapping windows. When a window is opened, 
  the viewport, which is the section of the screen it appears in, is initialized. 
  The system maintains a list of active windows, where the list is ordered from 
  the top window to the bottom. In the case covered here, the window to be opened 
  is already on the active list, but not on the top.</P>
<DIR> 
  <DIR> 
    <P><B>make_viewport(W):- 
      <BR>
      retract(active([H|T])), <BR>
      save_image(H), <BR>
      split(W, [H|T], L1, L2), <BR>
      w_chkover(W, L1, _), <BR>
      append([W|L1], L2, NL), <BR>
      assert(active(NL)).</B></P>
  </DIR>
</DIR>
<P>The 
  <B>save_image</B> predicate stores the image of the top window for redisplay 
  if necessary. The <B>split</B> predicate is a list utility which splits the 
  active list at the desired window name. Next, <B>w_chkover</B> decides if the 
  window needs to be redrawn due to overlapping windows on top of it, and then 
  a new active list is constructed with the requested window on top.</P>
<P>The 
  <B>w_chkover</B> predicate recurses through the list of windows on top of the 
  requested window, checking each one for the overlap condition. If any window 
  is overlapping, then the requested window is redrawn. Otherwise nothing needs 
  to be done.</P>
<DIR> 
  <DIR> 
    <P><B>w_chkover(W, 
      [], no).</B></P>
    <P><B>w_chkover(W, 
      [H|T], Stat):-<BR>
      w_nooverlap(W, H), <BR>
      w_chkover(W, T, Stat).</B></P>
    <P><B>w_chkover(W, 
      _, yes):-<BR>
      restore_image(W), !.</B></P>
  </DIR>
</DIR>
<P>An 
  overlap is detected by simply comparing the coordinates of the two windows.</P>
<DIR> 
  <DIR> 
    <P><B>w_nooverlap(Wa, 
      Wb):-<BR>
      select_parm(Wa, [coord(R1a, C1a, R2a, C2a)]), <BR>
      select_parm(Wb, [coord(R1b, C1b, R2b, C2b)]), <BR>
      (R1a &gt; R2b + 2;<BR>
      R2a &lt; R1b - 2;<BR>
      C1a &gt; C2b + 2;<BR>
      C2a &lt; C1b - 2), !.</B></P>
  </DIR>
</DIR>
<P>As 
  opposed to the PC implementation which requires coding to the detail level, 
  the Macintosh implementation uses a rich toolbox of primitive building blocks. 
  However, the complexity of the toolbox sometimes makes it more difficult to 
  perform simple operations. For example, the make a new window in the PC version, 
  all that is necessary is to save the window definition:</P>
<DIR> 
  <DIR> 
    <P><B>make_window(W, 
      Def):-<BR>
      asserta( wd(W, Def)).</B></P>
  </DIR>
</DIR>
<P>In 
  the Macintosh version, a number of parameters and attributes must be set up 
  to interface with the Macintosh environment. The code to create a new window 
  draws heavily on a number of built-in AAIS Prolog predicates which access the 
  Macintosh toolbox.</P>
<DIR> 
  <DIR> 
    <P><B>make_window(W, 
      L) :-<BR>
      define(wd, 2), <BR>
      include([window, quickdraw, types, memory]), <BR>
      fulfill([coord(R1, C1, R2, C2), title(T), visible(V), <BR>
      &#9;procid(Pid), behind(B), goaway(G), <BR>
      &#9;refcon(RC)], L), <BR>
      new_record(rect, R), <BR>
      new_record(windowptr, WP), <BR>
      setrect(R, C1, R1, C2, R2), <BR>
      pname(T, Tp), <BR>
      newwindow(WP, R, Tp, V, Pid, B, G, RC, WPtr), <BR>
      asserta( wd(W, [wptr(WPtr)|L]) ).</B></P>
  </DIR>
</DIR>
<P>Notice 
  that the special Macintosh window parameters are easily represented using the 
  window attribute lists of the generic windows. The example above has attributes 
  for <B>goaway</B>, a box the user can click to make a window go away, and <B>refcon</B> 
  for attaching more sophisticated functions to windows. The <B>select_parm</B> 
  predicate has intelligent defaults set for each of these parameters so the user 
  does not have to worry about specifying them.</P>
<DIR> 
  <DIR> 
    <P><B>w_attr(goaway(false), 
      _).</B></P>
    <P><B>w_attr(refcon(0), 
      _).</B></P>
  </DIR>
</DIR>
<P>The 
  generic window interface we developed recognizes a few fundamental types of 
  window. The Macintosh also has numerous window types. The <B>w_attr</B> predicate 
  is used to calculate values for the Macintosh parameters based on the generic 
  parameters. The user only sees the generic parameters. Internally, the Macintosh 
  parameters are used. Here is how the internal routines get a value for the Macintosh 
  based parameter <B>wproc</B> which controls the type of box the window is drawn 
  in: </P>
<DIR> 
  <DIR> 
    <P><B>w_attr(wproc(documentproc), 
      L) :-</B></P>
    <P><B>&#9;akindof(text, 
      L), !.</B></P>
    <P><B>w_attr(wproc(dboxproc), 
      L) :-</B></P>
    <P><B>&#9;akindof(dialog, 
      L), !.</B></P>
    <P><B>w_attr(wproc(plaindbox), 
      L) :-</B></P>
    <P><B>&#9;akindof(graph, 
      L), !.</B></P>
  </DIR>
</DIR>
<P>The 
  <B>akindof</B> predicate checks type against the inheritance specified by the 
  <B>subclass</B> predicate defined earlier.</P>
<DIR><B></b> 
  <DIR> 
    <P><B>akindof(ST, 
      L) :-</B></P>
    <P><B>&#9;w_attr(type(T), 
      L), </B></P>
    <P><B>&#9;subsub(ST, 
      T), !.</B></P>
    <P><B>subsub(X, 
      X).</B></P>
    <P><B>subsub(Y, 
      X) :-</B></P>
    <P><B>&#9;subclass(C, 
      X), </B></P>
    <P><B>&#9;subsub(Y, 
      C).</B></P>
  </DIR>
</DIR>
<P>As 
  more toolboxes for user interface functions become available, such as Presentation 
  Manager, the low level portions of this window package can be modified to take 
  advantage of them. At the same time the simple object oriented high level interface 
  described earlier can be maintained for easy application development and portability.</P>
<h1><B> <a name="exercises"></a>Exercises 
  </B></h1>
<P>9.1 
  - Implement object oriented windows on the Prolog system you use.</P>
<P> 
 
<P> </P>
 
<P>9.2 
  - Add windowing interfaces to all of the expert system shells developed so far.</P>
<P> 
 
<P> </P>
 
<P>9.3 
  - Add controls as a window type. These are display windows that use a graphical 
  image to represent a number. The easiest graphical control to implement is a 
  thermometer in a text based system (such as the IBM PC in text mode). The controls 
  can also contain digital readouts which is of course even easier to implement.</P>
<P> 
 
<P> </P>
 
<P>9.4 
  - Active images are controls which automatically display the contents of some 
  variable in a system. For example, in the furniture placement system it would 
  be interesting to have four controls which indicate the available space on each 
  of the four walls. They can be elegantly implemented using the attached procedure 
  in the <B>add</B> slot of the frames. Whenever a new value is added, the procedure 
  sends it to the control window. (Note that add is called during update of the 
  slot in this implementation.)</P>
<P> 
 
<P> </P>
 
<P>9.5 
  - In the windowing interface for the various shells, have trace information 
  appear in a separate window.</P>
<P> 
 
<P> </P>
 
<P>9.6 
  - Add graphics windows to the system if your version of Prolog can support it.</P>
<P> 
 
<P> </P>
 
<P>9.7 
  - In the main control loop, recognize certain user actions as a desire to manipulate 
  the windows. For example function keys might allow the user to pop various windows 
  to the top. This would enable the system to keep trace information in one window 
  which is overlapped by the main window. The user could access the other windows 
  by taking the appropriate actions.</P>


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
