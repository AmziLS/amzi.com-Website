<HTML>
<HEAD>
<jsp:useBean id="PetsJSPBeanId" scope="session" class="pets.PetsJSPBean" />
<jsp:setProperty name="PetsJSPBeanId" property="*" />
<TITLE>
Pets JSP
</TITLE>
</HEAD>
<BODY>
<H1>
Pets JSP
</H1>
<FORM method="post">
<P>What sound does the pet make : <INPUT NAME="sound"></P>
<INPUT TYPE="SUBMIT" NAME="Submit" VALUE="Submit">
<INPUT TYPE="RESET" VALUE="Reset">
<P>The pet is a : <jsp:getProperty name="PetsJSPBeanId" property="pet" /></P>
</FORM>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8213130-1");
pageTracker._trackPageview();
} catch(err) {}</script></BODY>
</HTML>
