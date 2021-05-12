<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- #BeginTemplate "/Templates/ar_download_1col.dwt" --><!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" --> 
<title>Transfer License</title>
&nbsp;&nbsp;&nbsp;<!-- #EndEditable -->
<!-- #BeginEditable "head" -->
<!-- #EndEditable -->
<link href="/ARulesXL/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="150" height="117"><img src="/ARulesXL/images/logo_shiprock2.jpg" width="150" height="115" /></td>
    <td colspan="2" valign="top" bgcolor="#D1EFFF">
	  <table width="100%" height="115" border="0" cellspacing="5">
	    <!--DWLayoutTable-->
	    <tr>
	      <td width="100%" align="center" valign="middle" bgcolor="#D1EFFF"><h1><!-- #BeginEditable "Title" --><font color="#666666">Transfer 
        License</font><!-- #EndEditable --></h1></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="387" valign="top" bgcolor="#D1EFFF"><table width="150" border="0" id="nav">
      <tr>
        <td height="35"><a href="/ARulesXL/index.html">Home</a></td>
      </tr>
    </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/overview/index.htm">Overview &amp; Whitepapers</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/docs/index.htm">Documentation</a></td>
        </tr>
      </table>
      <table width="150" border="0" id="active">
        <tr>
          <td height="35"><a href="/ARulesXL/download/index.htm">Download &amp; Buy </a></td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/news/index.htm">Product News</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="http://forum.arulesxl.com">Support Forum</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/company/contact.htm">Contact Us</a> </td>
        </tr>
      </table>
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/mail/mailinglist.htm">Mailing List</a> </td>
        </tr>
      </table>    
      <table width="150" border="0" id="nav">
        <tr>
          <td height="35"><a href="/ARulesXL/resources/index.htm">Other Resources</a> </td>
        </tr>
      </table>	</td>
    <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td width="100%" valign="top"><!-- #BeginEditable "Contents" --> 
      <p>This system is for ARulesXL 1.0.3 and earlier users to transfer license keys. Later users can use the new License Manager that will connect directly to our website to install and remove license keys. </p>
      <p>In order to transfer your license key from one PC to another, you need to:</p>
      <ol>
        <li>Remove the license key from the first machine by filling in the form below. </li>
        <li>Request a new license key for the second machine from the ARulesXL License Manager running on the second machine (version 1.0.7 or later) or from the <a href="get.php">Request License Key</a> web form. You will need the reference number that is emailed to you, and you must use the same user name and email that you enter in the form below. </li>
      </ol>
      <p>If you do not have this information and you are the original purchaser, 
        you can have your current license information emailed to you via <a href="lookup.php">License 
        Lookup</a>.</p>
      <form action="put_license.php" method="post" name="transfer_form" id="transfer_form">
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr> 
            <td width="39%"><b>License User Name:</b></td>
            <td width="61%"> 
              <?php echo '<input type="text" name="fusername" size="75" value="' . trim($_GET['fusername']) . '">'; ?>            </td>
          </tr>
          <tr> 
            <td><b>License Key:</b></td>
            <td> 
              <?php echo '<input type="text" name="flicense" size="75" value="' . trim($_GET['flicense']) . '">'; ?>            </td>
          </tr>
          <tr> 
            <td><b> Hardware Fingerprint:</b></td>
            <td> 
              <?php echo '<input type="text" name="foldfingerprint" size="15" maxlength="9" value="' . trim($_GET['foldfingerprint']) . '">'; ?>            </td>
          </tr>
          <tr> 
            <td><b>Uninstall Code:</b></td>
            <td> 
              <?php echo '<input type="text" name="funinstallcode" size="75" value="' . trim($_GET['funinstallcode']) . '">'; ?>            </td>
          </tr>
        </table>
        <p> 
          <input type="hidden" name="interactive" value="Y"/>
		  <input type="submit" name="Submit" value="Return License Key" />
        </p>
        <h3>How to get your current license information:</h3>
        <p>Open 'License Manager' from the ARulesXL program menu on the Windows Start Menu.</p>
        <blockquote>
          <h4>How to get an uninstall code:</h4>
          <p>In the License Manager, click the 'Uninstall/Transfer License' button.</p>
          <h4>How to get the fingerprint for your new PC:</h4>
          <p>Install ARulesXL on the new PC, and run the License Manager as described 
            above.</p>
        </blockquote>
        <p><b></b></p>
      </form>
      <p>&nbsp;</p>
       
<meta name="Description" content="" />
<meta name="Keywords" content="" />
<!-- #EndEditable --></td>
       </tr>
    </table></td>
  </tr>
  <tr>
    <td height="1"></td>
    <td></td>
  </tr>
  <tr>
    <td height="28" colspan="3" bgcolor="#D1EFFF"><div align="center"><span class="footer">Copyright &copy; 2005-7 Amzi! inc. 
      Amzi! is a registered trademark and ARulesXL is a trademark of Amzi! 
      inc. <br />
    Microsoft, Excel and the Office logo are trademarks or registered trademarks of Microsoft Corporation in the United States and/or other countries. </span></div></td>
  </tr>
</table>
</body>
<!-- #EndTemplate --></html>
