<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Prolog + Logic Server Overview</title>
<meta name="description" content="Amzi! Prolog + Logic Server is an embeddable, extendable, highly portable implementation of ISO prolog with a professional IDE based on Eclipse.">

<meta name="keywords" content="Amzi, Amzi! Prolog, logic programming, Eclipse, rule engines, artificial intelligence,
domain specific language, logic server, embeddable, extendable, knowledge engineering, Amzi! overview">

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

        <h2 align="center"> Amzi! Prolog + Logic Server &#8482;</h2>
      <hr>
      <p>Amzi! Prolog + Logic Server makes it easy to integrate rule-based 
        components with Windows, Linux, Sun Solaris, HP/UX and other applications 
        (see list below). <br>
        &nbsp; 
      <center>
        <table BORDER CELLPADDING=3 BGCOLOR="#EBFFFF" >
          <tr> 
            <td> 
              <h3> Rule-Based Components&nbsp;</h3>
              <ul>
                <li>Configuration and pricing rules for products and services,</li>
                <li> Government regulations for industry,&nbsp;</li>
                <li>Legal and tax rules for forms filing,</li>
                <li>Workflow rules for optimal customer service,</li>
                <li>Diagnostic rules for problem solving&nbsp;</li>
                <li> Integrity-checking rules with databases,&nbsp;&nbsp;</li>
                <li> Parsing rules for documents,&nbsp;</li>
                <li> Tuning rules with performance-sensitive applications,&nbsp;</li>
                <li> Advisory rules with help systems,&nbsp;</li>
                <li> Business rules with any commercial application.</li>
              </ul>
            </td>
          </tr>
        </table>
      </center>
      <p><br>
        Amzi! offers plug-in, rule-based services for C, C++, Java, Web Servers 
        (via ASP.NET, JSP, Java Servlets, CGI), Delphi, VB.NET, C#.NET, PowerBuilder, 
        Access, Excel and many other tools. 
      <p>The integration is achieved through the Logic Server API which lets you 
        access a logic-base of rules as easily as you access a database today. 
        The result is a manageable and well-behaved interface that makes it possible 
        to utilize rule-based programming everywhere it is needed (see diagram). 
      <p align="center"><img src="/images/amziarch.gif" alt="Amzi! Architecture" height=330 width=260 align=TEXTTOP> 
      <center>
        <p align="left"><br>
          In addition to enabling embedded Prolog applications, the Logic Server 
          API (LSAPI) also lets you extend Amzi! Prolog so Prolog predicates can 
          access your data, call your code and link to your other libraries and 
          interfaces. </p>
      </center>
      <ul>
        <center>
          <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
            <tr> 
              <td><i>"I've been looking for a Prolog with this kind of API for 
                years ... it is designed to work equally well both ways (embed-dable 
                AND extendable), ... it is small yet seems very complete."&nbsp;</i> 
                <p><i>Jonas Beckman, MU Data&nbsp;</i> 
              </td>
            </tr>
          </table>
        </center>
      </ul>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        State-of-the-Art Interactive Development Environment</font></h2>
      <img src="../../images/eclipse_pos_logo_fc_sm.gif" width="130" height="60" align="right" border="0">Amzi! 
      provides the classic Prolog command-line tools, and a full Interactive Developer's 
      Environment (IDE), based on the open-source <a href="http://www.eclipse.org">Eclipse</a> 
      project, that integrates a code editor, listener, debugger, compiler, linker 
      and runtime engine in one intuitive GUI environment (see <a href="/products/amzi_ide.htm">screen 
      shots</a>). <br>
      &nbsp; 
      <center>
        <table BORDER CELLPADDING=3 BGCOLOR="#EBFFFF">
          <tr> 
            <td> 
              <h3> Amzi! Tools</h3>
              <ul>
                <li> Amzi! Eclipse IDE.&nbsp;</li>
                <li> Full on-line documentation and tutorials.</li>
                <li>Source Code Debugger.</li>
                <li> Standard ?- Listener runs both compiled and interpreted code.&nbsp;</li>
                <li> Box-Model Debugger (as defined by Clocksin &amp; Mellish).&nbsp;</li>
                <li> Compiler.</li>
                <li> Linker.&nbsp;</li>
                <li> Definite Clause Grammar (DCG) support for natural language 
                  work).&nbsp;</li>
                <li> Dynamic (DLL, SO format) Logic Server API Libraries</li>
              </ul>
            </td>
          </tr>
        </table>
      </center>
      <p>&nbsp;</p>
      <p>The Amzi! Eclipse IDE features:<br>
      </p>
      <ul>
        <li>Syntax coloring in the editor to highlight built-in predicates, strings, 
          comments, etc.</li>
        <li>Source file outliner and project cross referencer.</li>
        <li>Source code bookmarks to indicate the locations of errors, to-do items, 
          search text and more.</li>
        <li>Full source code debugging showing variable bindings at each level 
          in the call stack.</li>
        <li>Full source code debugging of compiled Prolog components embedded 
          in other languages and tools, and running on remote machines (e.g. Web 
          servers). </li>
        <li>Portable projects that can optionally include other projects.</li>
        <li>Automatic loading of libraries and lsx's in the Prolog listener, plus 
          input line recall and editing.</li>
      </ul>
      <p>Other standard features of the Eclipse IDE that may be useful to Amzi! 
        users are:</p>
      <ul>
        <li>Separately downloadable plugins for developing Java, C++, COBOL, C#, 
          PHP and other programs.</li>
        <li>Automatic file backup.</li>
        <li>Tools for modelling, graphical editing and testing.</li>
        <li>Seamless connection to source control systems like CVS, Perforce, 
          PVCS, MKS, ClearCase and more.</li>
        <li>Tight integration with the Apache's Ant build tool.</li>
      </ul>
      <h2> <img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        World Class Source Code Debugger</font></h2>
      <p>The real jewel of the Amzi! Eclipse IDE is the source code debugger. 
        It combines conventional debugging tools like breakpoints, pause, step-into 
        and step-over options, with extremely clear presentation of Prolog concepts 
        like backtracking, unification and cut.</p>
      <h4>Clarity for Learning</h4>
      <p>As a program executes, the line of source code is highlighted in different 
        colors depending on the state at that line, making it very clear how Prolog 
        backtracking works its way through Prolog source. A separate window has 
        the full call stack, and, at each level the variable bindings for the 
        clause being executed.</p>
      <p>For the beginning Prolog programmer this means that a difficult predicate, 
        like append/3, becomes transparent, de-mystifying the seeming magic of 
        the rippling effects of recursion and unification.</p>
      <h4>Embedded/Remote Debugging for Production Applications</h4>
      <p>For the professional, the debugger works equally well with compiled production 
        code, and it can be used to debug embedded Prolog components, either on 
        the developer's workstation or running remotely on a separate machine.</p>
      <p>This means it is no longer necessary to test and debug Prolog code separate 
        from an integrated application. A developer can have full source code 
        debugging at a workstation for a Prolog component running as part of a 
        remote server environment.<br>
      </p>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Embedding Logic Services</font></h2>
      The Logic Server is implemented as a class, and the LSAPI is a collection 
      of member functions for the class LogicServer. The LSAPI is also provided 
      as a pure functional API. You access the Logic Server similar to a database. 
      The LSAPI gives you the ability to load, query and update a Prolog logic-base 
      of rules and data from any language on any supported platform, and, under 
      Windows, from any tool that can call a DLL. 
      <p>The code boxes (below) illustrate a simple rule-based system that asks 
        the user for a sound, from which it identifies a pet. This same idea can 
        be used to identify problems based on symptoms, tuning parameters based 
        on system configuration, help based on user needs, etc. <br>
        <br>
      <center>
        <table BORDER CELLPADDING=3 BGCOLOR="#EBFFFF" >
          <tr> 
            <td colspan="2"> 
              <h3> Calling the Logic Server&nbsp;</h3>
              <pre><font color="#000080">The program examples below implement&nbsp;
these steps:
&nbsp;&nbsp; Initialize Logic Server
&nbsp;&nbsp; Load Pets program
&nbsp;&nbsp; Get sound from user
&nbsp;&nbsp; Assert sound to logic-base
&nbsp;&nbsp; Query pet(X) in logic-base
&nbsp;&nbsp; Get the value of X&nbsp;
&nbsp;&nbsp; Display results
&nbsp;&nbsp; Close Logic Server</font></pre>
            </td>
          </tr>
          <tr valign="top"> 
            <td> 
              <h3> . . . from Java and Servlets</h3>
              <pre><font color="#000080">ls.Init("");
ls.Load("pets.xpl");
Sound.append("sound('");
System.out.println("What sound?");
while ((c=System.in.read())!=-1)&nbsp;
&nbsp;&nbsp;&nbsp; Sound.append((char) c);
Sound.append("')");
System.out.println(Sound.toString());
ls.AssertaStr(Sound.toString());
Term = ls.ExecStr("pet(X)");
Pet = ls.GetStrArg(Term, 1);
System.out.println("Pet is a ");
System.out.println(Pet);
ls.Close();</font></pre>
            </td>
            <td> 
              <h3> . . . from VB.NET and ASP.NET&nbsp;</h3>
              <pre><font color="#000080">ls.Init("")
ls.Load("pets")
Sound = InputBox$("What sound?")
ls.AssertaStr("sound(" + Sound + ")")
Term = ls.CallStr("pet(X)")
Pet = ls.GetStrArg(Term, 1)
MsgBox "The pet is a " + Pet
Call ls.Close()</font></pre>
            </td>
          </tr>
          <tr valign="top"> 
            <td> 
              <h3> . . . from C++</h3>
              <pre><font color="#000080">Init("");
Load("pets");
puts("What sound?");
gets(Sound);
AssertaStr("sound(%s)",Sound);
CallStr(&amp;term, "pet(X)");
GetArg(term, 1, cSTR. &amp;Pet);
printf("The pet is a %s\n", Pet);
Close();</font></pre>
            </td>
            <td> 
              <h3> . . . from Delphi&nbsp;</h3>
              <pre><font color="#000080">ls.InitLS('');&nbsp;
ls.LoadXPL('pets');
Sound:=InputBox('','What sound?','');
ls.AssertaPStr('sound('+ Sound +')');
ls.CallPStr(t, 'pet(X)');
Pet := ls.GetPStrArg(t, 1);
ShowMessage('Pet is a ' + Pet);
ls.Close;</font></pre>
            </td>
          </tr>
        </table>
        <p> 
        <table border CELLPADDING=3 BGCOLOR="#EBFFFF" width="232">
          <tr valign="top"> 
            <td> 
              <h3>PETS.PRO&nbsp;</h3>
              <pre><font color="#000080">% 3 Prolog rules for&nbsp;
% identifying pets based&nbsp;
% on their sound

pet(dog) :- sound(woof).
pet(pig) :- sound(oink).
pet(duck) :- sound(quack).</font></pre>
            </td>
            <td> 
              <h3>PETS in the Listener&nbsp;</h3>
              <pre><font color="#000080">?- consult(pets).
yes
?- assert(sound(woof)).
yes
?- pet(X).
X = dog</font></pre>
            </td>
          </tr>
        </table>
        <br>
      </center>
      <p>The API has 50+ methods/functions that provide both high-level and detailed 
        access to Prolog rules, terms and data. The high-level functions use intuitive 
        string-mapping functions that simulate a Prolog listener (see code boxes 
        below). 
      <p>The detailed functions let you construct and/or decompose arbitrarily 
        complex Prolog terms and lists. For example, this C code pops all of the 
        elements off a Prolog list and prints them: 
      <ul>
        <pre><font color="#000080">while (PopList(&amp;Lst,cSTR,S)==OK)
&nbsp;&nbsp; printf("Popped %s\n", S);</font></pre>
      </ul>
      <ul>
        &nbsp; 
        <center>
          <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
            <tr> 
              <td><i>"I was convinced that Amzi!'s approach to interfacing Prolog 
                with procedural languages was the right one ... a Prolog program 
                is fundamentally closer to a database than it is to a sequential 
                program. As such, the API presents an interface that is similar 
                to database interfaces ... In my mind this is as intuitive as 
                one can get in an interface to Prolog ...</i> 
                <p><i>Amzi! moves you toward a unique view of its positioning 
                  in the Prolog market. It aims to be a component of an application 
                  written in other languages.</i> 
                <p><i>...Solid, commercial grade..ideal for embedding"&nbsp;</i> 
                <p><i>PC AI Review,&nbsp;</i> <br>
                  <i>Sep/Oct 95&nbsp;</i> 
              </td>
            </tr>
          </table>
        </center>
      </ul>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Extending Prolog</font></h2>
      The Logic Server API also makes it easy to implement custom extended predicates 
      for Prolog. These are predicates of your own design that are implemented 
      in a host language. Extended predicates look and behave exactly like the 
      built-in predicates, such as read/1 and write/1, that are part of the core 
      Prolog system. 
      <p>For example, a tuning application might have its user interface implemented 
        using C++ GUI, which loads and calls tuning rules written in Prolog. Those 
        rules make their decisions based on the state of the machine which is 
        determined by C functions that are called directly by the Prolog program. 
      <p>Or, you might want your Prolog code to access a network server. You can 
        use the Logic Server API to let Prolog directly access the network's API. 
      <p>Extended predicates can be implemented in any language that supports 
        the notion of call-back functions. Currently this means C/C++, Java, Delphi, 
        C# and Visual Basic can be used for implementing extended predicates. 
      <ul>
        <center>
          <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
            <tr> 
              <td><i>"I've been using Amzi! Prolog with an extensive C/C++ interface 
                and provisions for adding Prolog predicates using C(++) code. 
                It's wonderful."</i> 
                <p><i>Gregg Weismann, Manager of System Software Development, 
                  Xircom, Inc.</i> 
              </td>
            </tr>
          </table>
        </center>
      </ul>
      <h2> <img src="../../images/bullet.gif" height=36 width=36> <font color="#000080"> 
        Internet Support</font></h2>
      For building Internet applications, Amzi! includes these features: 
      <ul>
        <li> The Java class (described above) for use with JSP and Servlets (including 
          samples). </li>
        <li>A .NET Class for interfacing with Microsoft's ASP.NET.</li>
        <li>An XML library for use with a variety of internet technologies including 
          SOAP. </li>
        <li>The ability to load Prolog components from memory (thereby supporting 
          binary archives like JAR files).</li>
        <li>A Logic Server Extension for communicating with clients and servers 
          (e.g. mail, ftp, http) via Sockets.</li>
        <li> A CGI interface that lets you write Prolog scripts that run on web 
          servers.</li>
      </ul>
      
      
      <h2> <img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Multiple Session Support</font></h2>
      For building for the Internet, telephony, database and other server applications, 
      you can invoke multiple, simultaneous instances of the Amzi! Logic Server 
      (Prolog runtime). These instance can optionally run each in their own thread. 
      This allows you to create an instance for each user or process accessing 
      a server. 
      <h2> <img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Database Support</font></h2>
      Amzi! Prolog logic-bases can reason over records from any ODBC database 
      (under Windows). This is a two-level interface, with one part implemented 
      as an LSX (Logic Server eXtension) that implements extended predicates that 
      directly access ODBC services, and the other part implemented as a Prolog 
      wrapper around the ODBC predicates that allows natural Prolog pattern-matching 
      and backtracking to be used with an ODBC database. Since full source code 
      is provided, the ODBC interface can be readily adapted to other relational 
      databases. 
      <h2><img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Tcl/Tk Graphical Interface</font></h2>
      <img src="../../images/tcltk_logo.gif" width="70" height="105" align="right">Tcl/Tk, 
      a powerful, open-source, scripting and graphics toolkit, is supported as 
      an Amzi! LSX (Logic Server eXtension). It allows for Tcl/Tk commands to 
      be embedded in Prolog, and allows Tcl/Tk to query Prolog. The result is 
      a powerful combination for building intelligent graphical applications. 
      <h2><img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Unicode Support</font></h2>
      Internally, the Amzi! Logic Server is a pure UnicodeT Standard implementation. 
      Externally, it supports Unicode, ANSI and multi-byte applications. This 
      means you can write Prolog source code using the Unicode character set, 
      and call the Logic Server using Unicode strings. Hence, Amzi! Prolog can 
      communicate in any human language. 
      <h2><img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Object Oriented Programming</font></h2>
      The C++, Java, Delphi, C# and VB versions of the Logic Server API are delivered 
      as class with the LSAPI functions implemented as member functions. This 
      means you can use these classes to derive subclasses for your applications. 
      Those subclasses would then encapsulate the services your application expects 
      from the Prolog portion of the application, hiding the details of the Logic 
      Server inside the class. 
      <p>For example, the pet identification code example could be encapsulated 
        in a C++ object as illustrated in the box below. <br>
        &nbsp; 
      <center>
        <table BORDER CELLPADDING=3 BGCOLOR="#EBFFFF" >
          <tr> 
            <td> 
              <h3> Accessing a Prolog Logic- Base as a C++ Object&nbsp;</h3>
              <pre><font color="#000080">// derive class from Prolog engine
class CPets: public CLogicServer {
public:
&nbsp;&nbsp;&nbsp;&nbsp; Cpets();
&nbsp;&nbsp;&nbsp;&nbsp; ~Cpets();
&nbsp;&nbsp;&nbsp;&nbsp; void id(char *, char *);&nbsp;
};

// constructor initializes engine and loads rules
CPets::CPets { Init(""); Load("pets");}

// destructor frees Prolog resources
CPets::~CPets { Close(); }

// identify the pet
void CPets::id(char* Sound,char* Pet)&nbsp;
{
&nbsp;&nbsp;&nbsp;&nbsp; char&nbsp; buf[40];
&nbsp;&nbsp;&nbsp;&nbsp; TERM&nbsp; term;

&nbsp;&nbsp;&nbsp;&nbsp; sprintf(buf, "sound(%s)", Sound);
&nbsp;&nbsp;&nbsp;&nbsp; AssertaStr(buf);
&nbsp;&nbsp;&nbsp;&nbsp; CallStr(&amp;term, "pet(X)");
&nbsp;&nbsp;&nbsp;&nbsp; GetArg(term, 1, cSTR, Pet);&nbsp;
}


&nbsp;&nbsp;&nbsp;&nbsp; // sample code to use CPets object
&nbsp;&nbsp;&nbsp;&nbsp; ...&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp; CPets&nbsp;&nbsp;&nbsp; aPet;
&nbsp;&nbsp;&nbsp;&nbsp; cout&lt;&lt;"what sound?";
&nbsp;&nbsp;&nbsp;&nbsp; cin >> Sound;
&nbsp;&nbsp;&nbsp;&nbsp; aPet.id(Sound, Pet);
&nbsp;&nbsp;&nbsp;&nbsp; cout&lt;&lt;"The pet is a "&lt;&lt;Pet;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp; ...</font></pre>
            </td>
          </tr>
        </table>
        <br>
      </center>
      <ul>
        <center>
          <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
            <tr> 
              <td><i>"Combining Visual Basic and the Logic Server lets you create 
                programs that harness the power of Prolog while Visual Basic does 
                all the work of maintaining the interface ... creating and debugging 
                your Prolog programs is a piece of cake ... Since Amzi!'s version 
                is a standard implementation of Prolog, it works right out of 
                the box with most Prolog code."&nbsp;</i> 
                <p><i>VB Tech Journal Review</i> 
              </td>
            </tr>
          </table>
        </center>
      </ul>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Performance</font></h2>
      Performance is key in any application. Amzi! Prolog is a compiled Prolog, 
      so the logic-base you access will usually be compiled. But, Amzi! is flexible 
      as well, so you can intermix dynamically asserted (interpreted) code with 
      the compiled code. In the PETS example (above) the rules are compiled and 
      the sounds are asserted dynamically. 
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Open Architecture</font></h2>
      All Amzi!-written extensions to Prolog are implemented using the Logic Server 
      API and come with full source. You can use the LSAPI to design and write 
      your own extensions just as easily. You can add your own Prolog-database, 
      Prolog-GUI, Prolog-communications, etc. 
      <p>Your extensions can be packaged in a special type of dynamic library 
        (DLL/SO) called an LSX (Logic Server eXtension), or they can be part of 
        your program. LSX's are provided as part of the product for ODBC, Tcl/Tk 
        and Sockets. 
      <h2> <img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Memory Utilization</font></h2>
      To work as a component, Prolog is both compact and well-behaved. This makes 
      Amzi! ideal for 24/7 online operations.<br>
      &nbsp; 
      <center>
        <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
          <tr> 
            <td><i>"Amzi! offers so much flexibility and, to all intents and purposes, 
              allows mixing of numeric and symbolic computation in a way undreamt 
              of a few short years ago. Well done!"&nbsp;</i> 
              <p><i>Jim Morrison, Business Reasearch Associate, ZENECA Specialties&nbsp;</i> 
            </td>
          </tr>
        </table>
      </center>
      <h2> <br>
        <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Error Handling</font></h2>
      Professional applications require robust error recovery. Amzi! is designed 
      to recognize and come down gracefully in the case of errors. The host program 
      can check for errors at API calls retrieving the error code, message, call 
      stack, read buffer and other information. Programs can use catch/throw and 
      exception handlers to capture and report all errors and respond accordingly. 
      Hence errors can be thrown in your Prolog logic-base and caught and handled 
      in your Java, C++, VB, C# or Delphi program. 
      <h2><img src="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Portability</font></h2>
      <p>Prolog source and object code developed on one platform will run on any 
        other runtime or API platform (without recompiling or relinking). This 
        is because the Amzi! Logic Server is implemented with a virtual machine 
        architecture similar to Java and .NET called a WAM. The Amzi! compiler 
        and linker create binary byte-code files that can be executed by any implemention 
        of the Logic Server. </p>
      <center>
        <table border cellpadding=3 bgcolor="#EBFFFF" width="75%">
          <tr> 
            <td> 
              <h3> Prolog Technical Specs&nbsp;</h3>
              <ul>
                <li>ISO-standard `Module' capability for reusable code and `hidden' 
                  predicates to prevent name collisions across files.&nbsp;</li>
                <li> String, floating point, stream i/o and random access binary 
                  file support.</li>
                <li> Full control over the sizes of all heaps, stacks and various 
                  other dynamically allocated items.&nbsp;</li>
                <li> User-extensible error handling with catchable exceptions.&nbsp;</li>
                <li> Sorted and indexed dynamic database options for quicker access 
                  to terms.&nbsp;</li>
                <li> Last call optimization (a more general form of `tail recursion' 
                  elimination).</li>
                <li> First argument indexing for more efficient predicate access.&nbsp;</li>
                <li> Automatic garbage collection of heaps, stacks and string 
                  space for more efficient use of memory.&nbsp;</li>
              </ul>
            </td>
          </tr>
        </table>
      </center>
      <br>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Ease of Development</font></h2>
      Amzi! lets you build your applications a module at a time because compiled 
      and interpreted code can be intermixed in the same program. In fact, compiled 
      and interpreted modules are 100% source compatible and require no changes 
      to move from one to the other. This makes it easy to work on large multi-module 
      applications, with working code compiled and code still under development 
      interpreted. 
      <p>To get you started quickly, the package includes the <i><a href="../../AdventureInProlog/index.htm">Adventure 
        in Prolog</a></i> tutorial, the <a href="../../ExpertSystemsInProlog/index.htm"><i>Building 
        Expert Systems in Prolog</i></a> advanced tutorial and lots of samples 
        including: 
      <ul>
        <li> Hello programs for C, C++, Java, Delphi, Visual Basic, .NET, etc.</li>
        <li> A multi-threaded Rubik's Cube Solver.</li>
        <li> Clocksin &amp; Mellish's Predicate Calculus to Prolog translator 
          (using actual symbols for 'exists', etc.)</li>
        <li> A simple Japanese to English translator.</li>
        <li> A genealogical database implemented with ODBC.</li>
        <li>A general-purpose, forward-chaining expert system with a bird identification 
          logic-base.</li>
        <li> An information request form for a web server.</li>
      </ul>
      <ul>
        <center>
          <table cellpadding=3 width="75%" bgcolor="#FFFFEB" >
            <tr> 
              <td><i>"You guys rock... thanks for putting out excellent well-documented 
                software!"&nbsp;</i> 
                <p><i>Oliver Jones, DotClick Corporation&nbsp;</i> 
              </td>
            </tr>
          </table>
        </center>
      </ul>
      <h2> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
        Distribution</font></h2>
      <p>Amzi! is royalty free. </p>
      <center>
        <table CELLPADDING=3 BGCOLOR="#FFFFEB" >
          <tr> 
            <td><i>"Contact Amzi! Their Prolog products are `with-it'"&nbsp;</i> 
              <p><i>from the comp.lang.prolog newsgroup</i> 
            </td>
          </tr>
        </table>
        <h2 align="left"> <img SRC="../../images/bullet.gif" height=36 width=36><font color="#000080"> 
          Environments &amp; Packaging</font></h2>
          <p>Amzi! Prolog + Logic Server runs under Windows, Linux, Solaris and 
            HP/UX. (Contact us for other platforms). The product includes full 
            HTML documentation, lots of samples, plus the tutorial texts, <i>Adventure 
            in Prolog </i>and<i> Building Expert Systems in Prolog</i>.<br>
          </p>
          <center>
            <table CELLPADDING=3 WIDTH="75%" BGCOLOR="#FFFFEB" >
              <tr> 
                <td><a NAME="JoltAward"></a><img SRC="../../images/joltawds.gif" height=114 width=90 align=LEFT>Jolt 
                  Productivity Award for Components and Libraries&nbsp; 
                  <p><i>"Decision-making software is found in domains from securities 
                    trading to air traffic control, where choices are made based 
                    on complicated conditions, often in real time. Rule-based 
                    systems are a common solution to these types of problems. 
                    One of the best languages for creating rule-based applications 
                    has always been Prolog. However, in the past it's been difficult 
                    to create full-blown applications using it. Amzi! inc. has 
                    a solution in the Amzi! Logic Server, an embeddable Prolog 
                    rule-base and inference engine that is accessible from C++, 
                    Java, Visual Basic, Smalltalk, and other tools. With its Edinburgh-standard 
                    implementation of Prolog and cross-platform, royalty-free 
                    runtimes, the Amzi! Logic Server should make rule-based programing 
                    accessible to anyone who feels the need to make smarter software."</i> 
                  <p><i>Software Development</i> 
                </td>
              </tr>
            </table>
            <p>&nbsp;</p>
            <table cellpadding=3 width="75%" bgcolor="#FFFFEB" height="93" >
              <tr> 
                <td height="39"><a href="http://www.sdmagazine.com/jolts/"><img src="/images/eclipse_jolt_award.jpg" width="159" height="100" align="left" border="0"></a><i>The 
                  <a href="http://www.eclipse.org">Eclipse IDE</a>, included in 
                  Amzi!, won the 2004 Jolt Award for Language and Development 
                  Environments from <a href="http://www.sdmagazine.com/">Software 
                  Development</a> magazine. </i> </td>
              </tr>
            </table>


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
