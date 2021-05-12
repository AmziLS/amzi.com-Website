<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! Open Source</title>
<meta name="description" content="Amzi! Install Instructions">

<meta name="keywords" content="Prolog, open source, logic programming, rule engines, artificial intelligence,
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
        <h1>Amzi! Prolog + Logic Server Installation Instructions</h1>
<hr />



<h2>Amzi! Prolog + Logic Server Installation Instructions</h2>

<h3>Command Line Tools</h3>

<p>Uncompress the distribution files into a directory, say *amzi*.  That will create an *apls* sub directory.  For example:</p>

<pre>
amzi
  apls
    bin
    abin
    . . .
</pre>

<p>The listener is in the bin directory, called *alis(.exe)*.  You can run it from there.</p>

<p>Alternatively, to use the command line tools, you might want to create an environment variable AMZI_DIR that points to the *apls* directory of the installation.  (Don’t point it elsewhere, some internal functions use it if it’s defined and expect it to point to the *apls* directory.)</p>

<p>And put the AMZI_DIR/bin directory on the PATH.</p>

<h3>IDE</h3>

<p>Download the amzi_eclipse_plugin.</p>

<p>If you created an *amzi* directory, as above, then create an *amzi/ide* directory, and in it download and install a copy of Eclipse, such as the one for Java development.</p>

<p>Use the Eclipse tools to add the plug-in.  It’s in the help menu, under install new software.  You’ll need to point it to the directory where you unzipped the plug-in.</p>

<p>NOTE that it is important, especially on a Unix environments, that the relative position of the directories be as follows.  This is how the Eclipse plugin finds Amzi! if it can’t access an AMZI_DIR environment variable.  (Which it often can’t, for example, on the Mac.)</p>

<pre>
amzi
  ide
    eclipse(.app/.exe)
  apls
    bin
    . . .
</pre>
<p>If you are using an existing copy of Eclipse on your machine, then you should move the *apls* directory next to it in the same relative position as above.</p>

<p>NOTE that the uninstall may not work as expected.  While, on the one hand, it works, you can uninstall, and then install a new version, on the other hand it leaves the old amzi plug-ins (5 of them) still in the Eclipse.app plugin directory, although it does remove the feature.  It also leaves them in the artifact.xml file.  ISSUE — if someone wants to work on this, that would be great.</p>


        

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
