<?php
/*
  File Name: install.php, v 1.1
  Author: Paul Crinigan, AmazingFlash.com

  AFCommerce, Amazing Flash Commerce Solutions
  http://www.afcommerce.com

  Copyright (c) 2005 AFCommerce

  AFCommerce is Released under the GNU General Public License
*/

?>
<HTML><HEAD><TITLE>New AFCommerce Installation</TITLE></HEAD><style type='text/css'><!-- body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #330099; text-decoration: none}
a:visited { color: #330099; text-decoration: none}
a:active { color: #330099; text-decoration: underline}
a:hover { color: #ff0000; text-decoration: underline}
--></style><BODY TEXT="#000000"><TABLE WIDTH="100%" bgcolor='#ffffff'><TR ALIGN="CENTER" VALIGN="MIDDLE"><TD WIDTH="100%" ALIGN="CENTER" VALIGN="MIDDLE"><IMG SRC="../images/mainsite/mainlogo.gif" border='0'></TD></TR></TABLE><TABLE WIDTH="100%"><TR ALIGN="CENTER" VALIGN="MIDDLE"><TD WIDTH="20%" ALIGN="CENTER" VALIGN="top">
<BR><BR><BR><A HREF="../admin/index.php"><font size='1' face='arial'><b>Admin Home Page</b></font></A><BR><BR><BR><A HREF="/" target="_blank"><font size='1' face='arial'><b>Preview Your Store</b></font></A><BR><BR><BR><A HREF="http://www.afcommerce.com/carttutorial.php" target='_blank'><font size='1' face='arial'><b>Shopping Cart Tutorial</b></font></A><BR><BR><BR><A HREF="http://www.afcommerce.com/customizationguide.php" target='_blank'><font size='1' face='arial'><b>Customization Guide</b></font></A><BR><BR><BR>

<A HREF="http://amazingflash.com/forum/" target='_blank'><font size='1' face='arial'><b>Support Forums</b></font></A><BR><BR><BR>

<A HREF="http://amazingflash.com/signup.html" target='_blank'><font size='1' face='arial'><b>Free Enhanced Admin Area</b></font></A><BR><BR><BR>

<A HREF="http://amazingflash.com/cms.html" target='_blank'><font size='1' face='arial'><b>Free Content Management System</b></font></A><BR><BR><BR>

<!-- This is the copyright announcement for AFCommerce. You must keep this link in place to comply with our user agreement. It is a small link that gives credit to the hard work that went in to developing this software. Thank you. -->
<BR><BR><a href='http://www.afcommerce.com/' target='_blank'><font size='1' face='arial'><b>Powered by AFCommerce.com</b></font></a>
<BR><BR><BR>
</TD><td width='80%' align='center' valign='top'><BR>

<?php

if (file_exists("../web/dbinfo.php")) {
// already installed
echo "<BR><BR><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>The shopping cart configuration file has already been created. This generally means that your cart has already been installed. If your database files did not write the way they were supposed to, first drop all the tables in the database that you are using for the cart. Then delete the \"web/dbinfo.php\" file. Be careful, there are three files named dbinfo.php, make sure you only the delete the one in the \"web\" directory.<BR><BR>Once you delete that file, you can reinstall the cart database. Make Sure You Drop The Tables First ! </b></font></td></tr></table><BR><BR>";
exit;   }

$fp = @fopen ("../web/index.html", "w");
if (@fwrite ($fp, "test") == 0) {
echo "<BR><BR><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>Could not write to the \"web\" directory. Make sure you \"CHMOD 777\" the \"web\" and \"images\" directories in order for this cart to install itself properly. </b></font></td></tr></table><BR><BR>";
exit;   } 

$fp = @fopen ("../images/index.html", "w");
if (@fwrite ($fp, "test") == 0) {
echo "<BR><BR><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>Could not write to the \"images\" directory. Make sure you \"CHMOD 777\" the \"web\" and \"images\" directories in order for this cart to install itself properly. </b></font></td></tr></table><BR><BR>";
exit;   } 

if ($_POST[action] == "install")  {

$errorflag = 0;
$dbhost = $_POST[dbhost];
if ($dbhost == "") { $errorflag = 1;   }
$user_dbuser = $_POST[dbuser];
if ($user_dbuser == "") { $errorflag = 1;   }
$user_dbpass = $_POST[dbpass];
if ($user_dbpass == "") { $errorflag = 1;   }
$dbname = $_POST[dbname];
if ($dbname == "") { $errorflag = 1;   }
$domainname = $_POST[domainname];
if ($domainname == "") { $errorflag = 1;   }

if ($errorflag == "0") { 

$remoteconn = mysql_connect($dbhost, $user_dbuser, $user_dbpass);

// create sql for the database
if (!mysql_select_db($dbname,$remoteconn))   {
echo "<BR><BR><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>Could not connect to the database. Either the connection could not be made to the database server, or the database does not exist. </b></font></td></tr></table><BR><BR>";
exit;     }

else  {
$tempcontent = file_get_contents("afcommerce.sql"); 
$sqlarray = explode (";", $tempcontent);
while (list($key, $oneline) = each($sqlarray)) {
mysql_query($oneline, $remoteconn);      }

$update = "update config set varvalue = '$domainname' where varname = 'domainname'";
mysql_query($update, $remoteconn); 

$content = "<" . "?" . "php $" . "conn = mysql_connect('$dbhost', '$user_dbuser', '$user_dbpass');
mysql_select_db('$dbname',$" . "conn); ?" . ">";

$fp = fopen ("../web/dbinfo.php", "w");
fwrite ($fp, $content);

echo "<BR><BR><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>Your database has been installed. You can now delete this install directory and begin to use your new shopping cart. You can find more documentation and support forums at : </b></font><a href='http://www.afcommerce.com' target='_blank'><font size='3' face='arial'><b>AFCommerce.com</b></font></a> <font size='3' face='arial'><b><BR><BR>Thank you for using Amazing Flash Commerce Solutions.<BR></b></font></td></tr></table><BR><BR>";
exit;    }

} // ends errorflag = 0

else {
// all fields are not filled out
echo "<font size='4' face='arial' color='#ff0000'>All Fields Are Required To Install Database</font><BR>";    }

} // ends if action = install

else  {
// show form to install database
echo "<BR><H2>Install A New MYSQL Database</H2><table width='90%'><tr><td width='100%' align='left'><font size='3' face='arial'><b>You must create a new empty mysql database with a username and password. That user must have \"Select, Insert, Create, Delete, Update\" database permissions. </b></font></td></tr></table><BR><BR><form action='install.php' method='post'><input type='hidden' name='action' value='install'><table width='95%' border='1' cellspacing='4' cellpadding='4'><tr><td width='40%' align='left'>&nbsp; <font size='3' face='arial'><B>Database Host Address:</B></font></td><td width='60%' align='left'><input name='dbhost' value='$newdbhost' size='45'></td></tr><tr><td width='40%' align='left'>&nbsp; <font size='3' face='arial'><B>Database Username:</B></font></td><td width='60%' align='left'><input name='dbuser' value='$user_dbuser' size='45'></td></tr><tr><td width='40%' align='left'>&nbsp; <font size='3' face='arial'><B>Database Password:</B></font></td><td width='60%' align='left'><input name='dbpass' value='$user_dbpass' size='45'></td></tr><tr><td width='40%' align='left'>&nbsp; <font size='3' face='arial'><B>Database Name:</B></font></td><td width='60%' align='left'><input name='dbname' value='$dbname' size='45'></td></tr><tr><td width='40%' align='left'>&nbsp; <font size='3' face='arial'><B>Domain Name:</B></font></td><td width='60%' align='left'><input name='domainname' value='$domainname' size='45'></td></tr></table><BR><BR><BR><input type='submit' value='<< Install Database Files >>'><BR><BR><BR></form><BR><BR>";

echo "</td></tr></table>";

} // ends main else

?><!-- 
The link below is our copyright announcement. This software is completely free, however we do require that this link remain exactly the way it is. We have made it extremely small and out of the way so that it would be a reasonable request. Thank You. 
-->
<TABLE bgcolor='#ffffff' WIDTH='100%'><TR ALIGN='CENTER' VALIGN='TOP'><TD WIDTH='100%' ALIGN='right' VALIGN='middle'><a href='http://www.afcommerce.com/' target='_blank' alt='Shopping Cart Powered by AFCommerce.com'><font size='1' face='times new roman'><i>Powered by AFCommerce.com</i></font></a></TD></TR></TABLE>
