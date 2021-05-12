<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Place meta tags here-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Amzi! inc. Company Information</title>
<meta name="description" content="Amzi! inc. company information.">

<meta name="keywords" content="Amzi! company, contact information">

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
        
      <h1>Company Information</h2>
      <hr>
      <h2><i>Company</i></h2>
      <p>Amzi! inc. has been in business since 1991. We are a small, self-funded 
        company that provides both products and services for knowledge-based applications.
         See our <a href="../AmziPrologLogicServer/white_papers/logical_knowledge.php">Technology, 
        Product and Service Overview</a> for details. </p>

      <ul>
        <table cellpadding=3 width="75%" bgcolor="#FFFFEB" >
          <tr> 
            <td><i>&quot;The company is very friendly, accessible and helpful. 
              Service and upgrades are excellent. I would definitely recommend 
              Amzi! Prolog both the company and the product.&quot; </i> 
              <p><i>D.W. Salt , University of Derby </i></p>
            </td>
          </tr>
        </table>
      </ul>
      <br>        
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
