<?php

REQUIRE 'includes/config.php3';
REQUIRE 'classes/poll.php3';


function spit_header() { ?>
  <HTML><HEAD><TITLE>SymPoll Administration</TITLE></HEAD>
  <BODY BGCOLOR="#004444" TEXT="#bbbbbb" LINK="#ffffcc" ALINK="#555555" VLINK="#cccc00">
<?php }

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// !BEGIN! CODE REQUIRED FOR USER AUTHENTICATION
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
// ADMIN COOKIE DETECTED, CHECK MD5
///////////////////////////////////////////////////////////////////
function auth_cookie ($secret, $user) {
  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);
  $user = addslashes($user);

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");
  $query = "SELECT secret FROM sympoll_auth WHERE user='$user'";
  $result = MYSQL_QUERY($query);
  MYSQL_CLOSE();
  $rows = MYSQL_NUMROWS($result);
  if($rows > 0) 
    $md5 = MYSQL_RESULT($result,0,'secret');
  if($md5 == $secret)
    return true;
  else
    return false; 
}


///////////////////////////////////////////////////////////////////
// NO ADMIN COOKIE DETECTED, VERIFY LOGIN INFO
///////////////////////////////////////////////////////////////////
function auth_user( $user, $pass) {
  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  GLOBAL $HTTP_HOST, $PHP_SELF;
  $whoami = basename(__FILE__);

  $user = addslashes($user);
  $salt = substr($user, 0, 2);
  $pass = substr( crypt($pass, $salt), 0, 16);

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");
  $query = "SELECT * FROM sympoll_auth WHERE(user='$user' AND pass='$pass')";
  $result = MYSQL_QUERY($query);
  $rows = MYSQL_NUMROWS($result);
  if($rows > 0) {
    $md5 = md5( time() );
    $query = "UPDATE sympoll_auth SET secret='$md5' WHERE user='$user'";
    $result = MYSQL_QUERY($query); 
  }
  else {
    $query = "SELECT user FROM sympoll_auth";
    $result = MYSQL_QUERY($query);
    $rows = MYSQL_NUMROWS($result);
    // no admin users exist!  must create one
    if($rows <= 0) { 
      display_adduser(); 
      exit();
    }
  }
  MYSQL_CLOSE();

  if($rows > 0) {
    $path = dirname($PHP_SELF);
    $user = urlencode($user);
    if(strpos($HTTP_HOST,'.')==strrpos($HTTP_HOST,'.')) {
      header("Set-Cookie: sympauth1=$md5; path=/; domain=.$HTTP_HOST");
      header("Set-Cookie: sympauth2=$user; path=/; domain=.$HTTP_HOST");
    }
    else {
      header("Set-Cookie: sympauth1=$md5; path=/; domain=$HTTP_HOST");
      header("Set-Cookie: sympauth2=$user; path=/; domain=$HTTP_HOST");
    }
  }
  header("Location: http://${HTTP_HOST}${PHP_SELF}?t=1");
}


///////////////////////////////////////////////////////////////////
// DISPLAY LOGIN SCREEN-- MOSTLY HTML
///////////////////////////////////////////////////////////////////
function auth_display() { 
  GLOBAL $version, $HTTP_HOST, $t;
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll Administration</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?><BR>
  running at <?php echo $HTTP_HOST ?></B></FONT>
  <BR><BR><BR><BR>
  <?php if($t) { ?>
    <FONT COLOR="#ffffff" SIZE="+1"><I>Invalid Login</I></FONT><BR><BR> 
  <?php } ?>
  <FORM ACTION="<?php echo $whoami ?>" METHOD="post">
  <TABLE ALIGN="center" BORDER="0">
  <TR>
   <TD><B>Username:</B></TD>
   <TD><INPUT NAME="user" TYPE="text" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD><B>Password:</B></TD>
   <TD><INPUT NAME="pass" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD ALIGN="center">
    <BR><BR><INPUT TYPE="submit" VALUE="Authenticate">
   </TD>
  </TR></TABLE>
  <INPUT TYPE="hidden" NAME="action" VALUE="auth">
  </FORM></CENTER>
<?php }

///////////////////////////////////////////////////////////////////////////////
// !END! CODE REQUIRED FOR USER AUTHENTICATION
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// !BEGIN! CODE TO DISPLAY INTERACTIVE FORMS FOR THE VARIOUS FUNCTIONS
///////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////
// DISPLAYS MAIN OPENING UI
///////////////////////////////////////////////////////////////////
function display_opening() {

  REQUIRE 'classes/plist.php3';
  GLOBAL $version, $HTTP_HOST;

  $l = new PList();
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll Administration</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?>
  <BR>running at <?php echo $HTTP_HOST ?></B></FONT>
  <BR><BR><BR><BR>
  <FORM METHOD="post" ACTION="<?php echo $whoami ?>">
  <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="5" WIDTH="40%">
  <TR><TD><B>action:</B><BR>
  <SELECT NAME="action">

  <OPTION VALUE="create">create poll</OPTION>
  <?php if ($l->numpolls > 0) { ?>
    <OPTION VALUE="view">&lt;view poll&gt;</OPTION>
    <OPTION VALUE="edit">&lt;edit poll&gt;</OPTION>
    <OPTION VALUE="toggle">&lt;toggle poll&gt;</OPTION>
    <OPTION VALUE="reset">&lt;reset poll&gt;</OPTION>
    <OPTION VALUE="delete">&lt;delete poll&gt;</OPTION>
  <?php } ?>
  <OPTION>---------</OPTION>
  <OPTION VALUE="pass">change password</OPTION>
  <OPTION VALUE="logout">log out</OPTION>

  </SELECT></TD></TR>
  <TR>
  <TD><B>poll:</B><BR>

  <?php if ($l->numpolls == 0) {
    ECHO "There are no polls to modify.</TD></TR>\n";
  } else {
    ECHO "<SELECT NAME=\"pid\">\n";
    while(sizeof($l->ident) != 0 && list($k,$v) = each($l->ident)) {
      $pid = $k;
      $status = $l->status[$pid];
      ECHO "<OPTION VALUE=\"$pid\"> ";
      PRINTF("$pid: %s, ", $v);
      if($status == 0) { ECHO "OFF</OPTION>\n"; }
      else if($status == 1) { ECHO "ON</OPTION>\n"; }
      else { ECHO "!ERROR!</OPTION>\n"; }
    }
    reset($l->ident);
    ECHO "</SELECT></TD></TR>";
  } ?>

  <TR><TD><BR>
  <INPUT TYPE="submit" VALUE="Proceed">
  </TD></TR>
  <TR><TD>
  <BR><B>Note:</B><BR>
  * actions in &lt;wakas&gt; are performed on the poll.<BR>
  * the other actions do not care which poll is selected.
  </TD></TR></TABLE></FORM></CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAYS FORM USED TO ADD ADMIN USER
///////////////////////////////////////////////////////////////////
function display_adduser() {

  GLOBAL $version;
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: Create Admin User</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR>

  <FORM ACTION="<?php echo $whoami ?>" METHOD="post">
  <TABLE ALIGN="center" BORDER="0">
  <TR>
   <TD><B>Username:</B></TD>
   <TD><INPUT NAME="user" TYPE="text" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD><B>Password:</B></TD>
   <TD><INPUT NAME="pass1" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD><B>Password Again:</B></TD>
   <TD><INPUT NAME="pass2" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD ALIGN="center">
    <BR><BR><INPUT TYPE="submit" VALUE="Create User">
    <INPUT TYPE="reset" VALUE="Clear Values">
   </TD>
  </TR></TABLE>
  <INPUT TYPE="hidden" NAME="action" VALUE="p_adduser">
  </FORM></CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAYS POLL INFORMATION
///////////////////////////////////////////////////////////////////
function display_view($pid) {
 
  GLOBAL $version;

  $p = new Poll($pid);
  $whoami = basename(__FILE__);
  $whereami = dirname(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: Display Poll</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR></CENTER>
 
  <TABLE BORDER="0" WIDTH="70%" ALIGN="CENTER"><TR><TD>
  <FONT SIZE="+2" COLOR="#eeeeee"><U><?php echo $p->ident ?></U></FONT>
  <BR><BR><B>Question:</B><BR><?php echo $p->question ?>
  <BR><BR><B>Choices:</B><BR>

  <?php $num_options = 0;
  while(sizeof($p->options) != 0 && list($k,$v) = each($p->options)) {
    if(++$num_options < 10)
      { PRINTF("Option 0%d:&nbsp;&nbsp;", $num_options); }
    else
      { PRINTF("Option %d:&nbsp;&nbsp;", $num_options); }
    ECHO "$v<BR>";
  }
  if(sizeof($p->options) != 0)
    { reset($p->options); } ?>

  <BR><BR>To embed this poll into a webpage, insert this code:<BR><BR>
  <B>&lt;?PHP require '<?php echo $whereami ?>/booth.php3';<BR>
  display_booth(<?php echo $pid ?>); ?&gt;</B><BR><BR>
  Currently, it is very important to use the full pathname, as above.
  </TD></TR></TABLE>
  <BR><BR><BR><CENTER>[<A HREF="<?php echo $whoami ?>">admin home</A>].</CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAY CHANGE PASSWORD SCREEN
///////////////////////////////////////////////////////////////////
function display_pass() {

  GLOBAL $version, $sympauth2;
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: Change Password</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR>

  <FORM ACTION="<?php echo $whoami ?>" METHOD="post">
  <TABLE ALIGN="center" BORDER="0">
  <TR>
   <TD><B>Username:</B></TD>
   <TD><FONT SIZE="+1"><?php echo urldecode($sympauth2) ?></FONT></TD>
  </TR><TR>
   <TD><B>Old Password:</B></TD>
   <TD><INPUT NAME="oldpass" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD><B>New Password:</B></TD>
   <TD><INPUT NAME="newpass1" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD><B>New Password Again:</B></TD>
   <TD><INPUT NAME="newpass2" TYPE="password" SIZE="16" MAXLENGTH="16"></TD>
  </TR><TR>
   <TD ALIGN="center">
    <BR><BR><INPUT TYPE="submit" VALUE="Process Change">
    <INPUT TYPE="reset" VALUE="Clear Values">
   </TD>
  </TR></TABLE>
  <INPUT TYPE="hidden" NAME="action" VALUE="p_pass">
  </FORM></CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAYS FORM USED TO CREATE POLLS
///////////////////////////////////////////////////////////////////
function display_create() {

  GLOBAL $version, $max_options;
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: Create Poll</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR>
  <FORM METHOD="post" ACTION="<?php echo $whoami ?>">
  <INPUT TYPE="hidden" NAME="action" VALUE="p_create">
  <TABLE BORDER="0" WIDTH="80%">
  <TR><TD>
  <BR>Enter a short, unique identifier for the poll:<BR>
  (this will only be used in the admin page)<BR>
  <INPUT TYPE="text" MAXLENGTH="20" SIZE="20" NAME="ident"><BR>
  <BR>Enter the poll question you wish to be displayed:<BR>
  <INPUT TYPE="text" MAXLENGTH="150" SIZE="50" NAME="question"><BR><BR>
  <BR><B>Enter available voting options:</B><BR>

  <?php for($x=0; $x<$max_options; $x++) {
    if($x+1 < 10)
      PRINTF("Option 0%d:&nbsp;&nbsp;",$x+1);
    else
      PRINTF("Option %d:&nbsp;&nbsp;",$x+1);
    ECHO "<INPUT TYPE=\"text\" MAXLENGTH=\"100\" SIZE=\"20\" NAME=\"opt[$x]\"><BR>\n";
  } ?>

  <BR><INPUT TYPE="submit" VALUE="Create Poll">
  <INPUT TYPE="reset" VALUE="Clear Values">
  </TD></TR></TABLE></FORM></CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAYS FORM USED TO EDIT POLLS
///////////////////////////////////////////////////////////////////
function display_edit($pid) {

  GLOBAL $version, $max_options;

  $p = new Poll($pid);
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: Edit Poll</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR>
  <FORM METHOD="post" ACTION="<?php echo $whoami ?>">
  <INPUT TYPE="hidden" NAME="pid" VALUE="<?php echo $pid ?>">
  <INPUT TYPE="hidden" NAME="action" VALUE="p_edit">
  <FONT SIZE="+2" COLOR="#ffffff"><U>WARNING</U>:</FONT>
  <FONT COLOR="#ffffff"><B>Temporarily, editing a poll will reset it.</B></FONT><BR>
  <TABLE BORDER="0" WIDTH="80%">
  <TR><TD>
  <BR>Enter a short, unique identifier for the poll:<BR>
  (this will only be used in the admin page):<BR>
  <INPUT TYPE="text" MAXLENGTH="20" SIZE="20" NAME="ident" VALUE="<?php echo $p->ident ?>"><BR>
  <BR>Enter the poll question you wish to be displayed:<BR>
  <INPUT TYPE="text" MAXLENGTH="150" SIZE="50" NAME="question" VALUE="<?php echo $p->question ?>"><BR>
  <BR><B>Edit these options:</B><BR>

  <?php $num_options = 0;
  while(sizeof($p->options) != 0 && list($k,$v) = each($p->options)) {
    if(++$num_options < 10)
      PRINTF("Option 0%d:&nbsp;&nbsp;", $num_options); 
    else
      PRINTF("Option %d:&nbsp;&nbsp;", $num_options); 
    PRINTF("<INPUT TYPE=\"text\" NAME=\"updateo[%d]\" MAXLENGTH=\"100\" SIZE=\"20\" VALUE=\"%s\">\n", $k, $v);
    PRINTF("<INPUT TYPE=\"checkbox\" NAME=\"deleteo[%d]\" VALUE=\"poof\">&nbsp;delete<BR>\n", $k);
    $nextnum = $k; 
  }
  if( sizeof($p->options) != 0) 
    { reset($p->options); }

  $num_options++;
  ECHO "<BR><BR><B>Add these options:</B><BR>\n";
  for($x=0; $x<=($max_options-$num_options); $x++) {
    if($num_options+$x < 10)
      PRINTF("Option 0%d:&nbsp;&nbsp;", $num_options + $x);
    else
      PRINTF("Option %d:&nbsp;&nbsp;", $num_options + $x);
    PRINTF("<INPUT TYPE=\"text\" NAME=\"newo[%d]\" MAXLENGTH=\"100\" SIZE=\"20\"><BR>\n", ++$nextnum);
  } ?>

  <BR><INPUT TYPE="submit" VALUE="Process Changes">
  <INPUT TYPE="reset" VALUE="Undo Changes">
  </TD></TR></TABLE></FORM></CENTER>
<?php }


///////////////////////////////////////////////////////////////////
// DISPLAYS FORM USED FOR DELETE/RESET CONFIRMATION
///////////////////////////////////////////////////////////////////
function display_del_rs($pid, $action) {

  GLOBAL $version;

  $p = new Poll($pid);
  $whoami = basename(__FILE__);
  spit_header(); ?>

  <CENTER><FONT SIZE="6" COLOR="#ffffff">
  <B>Sympoll: <?php echo ucfirst($action) ?> Poll</B></FONT><BR>
  <FONT SIZE="+1"><B>version <?php echo $version ?></B></FONT>
  <HR SIZE="1" WIDTH="50%"><BR>
  <FORM METHOD="post" ACTION="<?php echo $whoami ?>">
  <INPUT TYPE="hidden" NAME="pid" VALUE="<?php echo $pid ?>">
  <INPUT TYPE="hidden" NAME="ident" VALUE="<?php echo $p->ident ?>">
  <INPUT TYPE="hidden" NAME="action" VALUE="<?php echo "p_"."$action" ?>">
  <TABLE BORDER="0" WIDTH="80%">
  <TR><TD><FONT SIZE="+1">
  <B>WARNING:  THIS CANNOT BE UNDONE. </B></FONT>
  <BR><BR><BR>
  Are you sure you wish to <B><?php echo "<U>$action</U> $p->ident" ?></B> ?
  <BR><BR>
  <INPUT TYPE="radio" NAME="confirmation" VALUE="no" CHECKED> nevermind!
  &nbsp;&nbsp;&nbsp;&nbsp;
  <INPUT TYPE="radio" NAME="confirmation" VALUE="<?php echo $action ?>"> yep!
  <BR><BR><INPUT TYPE="submit" VALUE="Alright!">
  </TD></TR></TABLE></FORM>
<?php }

///////////////////////////////////////////////////////////////////////////////
// !END! CODE TO DISPLAY INTERACTIVE FORMS FOR THE VARIOUS FUNCTIONS
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// !BEGIN! CODE TO PROCESS ACTIONS (DATABASE MANIPULATION)
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
// PROCESSES CREATE ACTION
///////////////////////////////////////////////////////////////////
function process_create($ident, $question, $opt) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);
  $time = time();

  // error checking for required fields
  if ($question == "" || $ident == "") { ?>
    <FONT SIZE="+2"><B>Poll NOT Created.</B></FONT><BR><BR>
    Hit your &quot;back&quot; button and double check to make sure that
    you have a question and an identifier.<BR><BR>
    Or return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
    <?php exit();
  }

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  $query = "INSERT INTO sympoll_list VALUES(NULL, '".addslashes($ident)."', '".addslashes($question)."',  '$time', 0)";
  $result = MYSQL_QUERY($query);
  $query = "SELECT pollID FROM sympoll_list WHERE timeStamp=$time";
  $result = MYSQL_QUERY($query);
  $pid = MYSQL_RESULT($result,0,"pollID");

  for($x=0; $x < sizeof($opt); $x++) {
    $query = "INSERT INTO sympoll_data VALUES('$pid', '$x', '".addslashes($opt[$x])."', 0)";
    $result = MYSQL_QUERY($query);
  }

  MYSQL_CLOSE();
  display_view($pid);
}


///////////////////////////////////////////////////////////////////
// PROCESSES PASSWORD CHANGE
///////////////////////////////////////////////////////////////////
function process_adduser($user, $pass1, $pass2) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);

  // error checking for new password
  if ($pass1 == "" || strcmp($pass1,$pass2) != 0) { ?>
    <FONT SIZE="+2"><B>Account NOT Created.</B></FONT><BR><BR>
    One or more of the following errors has occured:<BR>
    o You left your new password blank<BR>
    o The two fields for your new password do not match<BR><BR>
    Hit your &quot;back&quot; button to try again.
    <?php exit();
  }
  $user = addslashes($user);
  $salt = substr($user, 0, 2);
  $pass = substr( crypt($pass1, $salt), 0, 16);

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  $query = "INSERT INTO sympoll_auth (user,pass) VALUES('$user', '$pass')";
  $result = MYSQL_QUERY($query);
  $rows = MYSQL_AFFECTED_ROWS();
  MYSQL_CLOSE();

  if($rows <= 0) { ?> 
    <FONT SIZE="+2"><B>Account NOT Created.</B></FONT><BR><BR>
    An unknown error has occured while attempting to add this user name into the
    MySQL database.  It is possible that the table 'sympoll_auth' used
    to store account information has not been created.  This table is required
    as of version 0.1.97.  If you are using a previous version and have not properly
    followed the upgrade instructions, please do so.<BR><BR>
    It is also possible that the MySQL user this script connects with does not have
    access to modify the table 'sympoll_auth'.<BR><BR>
    There may also be other causes to this problem.  If you are completely uncertain
    as to how to advance, please contact Sympoll's author.
    <?php exit();
  }
}


///////////////////////////////////////////////////////////////////
// PROCESSES PASSWORD CHANGE
///////////////////////////////////////////////////////////////////
function process_pass($user, $oldpass, $newpass1, $newpass2) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  GLOBAL $sympauth1;
  $whoami = basename(__FILE__);

  // error checking for new password
  if ($newpass1 == "" || strcmp($newpass1,$newpass2) != 0 || strcmp($newpass1,$oldpass) == 0) { ?>
    <FONT SIZE="+2"><B>Password NOT Changed.</B></FONT><BR><BR>
    One or more of the following errors has occured:<BR>
    o You left your new password blank<BR>
    o The two fields for your new password do not match<BR>
    o Your new password is the same as your old password<BR><BR>
    Hit your &quot;back&quot; button to try again 
    or return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
    <?php exit();
  }
  $user = addslashes($user);
  $salt = substr($user, 0, 2);
  $oldpass = substr( crypt($oldpass, $salt), 0, 16);
  $newpass = substr( crypt($newpass1, $salt), 0, 16);



  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  $query = "SELECT secret FROM sympoll_auth WHERE(user='$user' AND pass='$oldpass')";
  $result = MYSQL_QUERY($query);
  $rows = MYSQL_NUMROWS($result);
  if($rows <= 0) { ?>
    <FONT SIZE="+2"><B>Password NOT Changed.</B></FONT><BR><BR>
    Unable to locate <B><?php echo $user ?></B> with the specified old password.
    Username or old password is incorrect.  Hit your &quot;back&quot; button to 
    try again.<BR><BR>
    Or return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
    <?php exit();
  }

  $query = "UPDATE sympoll_auth SET pass='$newpass' WHERE secret='$sympauth1'";
  $result = MYSQL_QUERY($query);
  $rows = MYSQL_AFFECTED_ROWS();
  MYSQL_CLOSE();

  if($rows > 0) { ?>
    <FONT SIZE="+2"><B>Password Changed.</B></FONT><BR><BR>
    The password for <B><?php echo $user ?></B> has been successfully changed.
    <BR><BR>Return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
  <?php }

  else { ?>
    <FONT SIZE="+2"><B>Password NOT Changed.</B></FONT><BR><BR>
    Unable to authenticate your cookie.  Please try closing your web browser
    and logging in again.  This error occurs when you have been logged in for
    over 3 hours or if you were not properly authenticated when entering the
    admin page.
    Or return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
  <?php }
}


///////////////////////////////////////////////////////////////////
// PROCESSES EDIT ACTION
///////////////////////////////////////////////////////////////////
function process_edit($pid, $ident, $question, $newo, $updateo, $deleteo) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);

  // error checking for required fields
  if ($question == "" || $ident == "") { ?>
    <FONT SIZE="+2"><B>Poll NOT Modified.</B></FONT><BR><BR>
    Hit your &quot;back&quot; button and double check to make sure that
    you have a question and an identifier.<BR><BR>
    Or return to [<A HREF="<?php echo $whoami ?>">admin home</A>].
    <?php exit();
  }

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  // update the question and ident
  $query = "UPDATE sympoll_list SET question='".addslashes($question)."' WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query);
  $query = "UPDATE sympoll_list SET identifier='".addslashes($ident)."' WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query);

  // add options
  while(sizeof($newo) != 0 && list($k,$v) = each($newo)) {
    $query = "INSERT INTO sympoll_data VALUES('$pid', '$k', '".addslashes($v)."', 0)";
    $result = MYSQL_QUERY($query);
  }
  if( sizeof($newo) != 0) 
    { reset($newo); }

  // update options
  while(sizeof($updateo) != 0 && list($k,$v) = each($updateo)) {
    $query = "UPDATE sympoll_data SET choice='".addslashes($v)."' WHERE(choiceID='$k' AND pollID='$pid')";
    $result = MYSQL_QUERY($query);
  }
  if( sizeof($updateo) != 0) 
    { reset($updateo); }

  // delete options
  for($x=0; $x < sizeof($deleteo); $x++) {
    $query = "DELETE FROM sympoll_data WHERE(choiceID='$deleteo[$x]' AND pollID='$pid')";
    $result = MYSQL_QUERY($query);
  }
  if( sizeof($deleteo) != 0) 
    { reset($deleteo); }

  //reset poll to avoid problems with cookies and dup cids.
  //future release will hopefully find a better way to deal with it.
  $time = time();
  $query = "UPDATE sympoll_list SET timeStamp='$time' WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query);
  $query = "UPDATE sympoll_data SET votes='0' WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query);

  MYSQL_CLOSE();
  display_view($pid);
}


/////////////////////////////////////////////////////////////////////
// PROCESSES DELETE/RESET ACTION
/////////////////////////////////////////////////////////////////////
function process_del_rs($pid, $ident, $confirmation) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  if ($confirmation == "delete") {
    $query = "DELETE FROM sympoll_list WHERE pollID='$pid'";
    $result = MYSQL_QUERY($query);
    $query = "DELETE FROM sympoll_data WHERE pollID='$pid'";
    $result = MYSQL_QUERY($query);
  }
  elseif($confirmation == "reset") {
    $time = time();
    $query = "UPDATE sympoll_list SET timeStamp='$time' WHERE pollID='$pid'";
    $result = MYSQL_QUERY($query);
    $query = "UPDATE sympoll_data SET votes='0' WHERE pollID='$pid'";
    $result = MYSQL_QUERY($query);
  }
  MYSQL_CLOSE();

  ECHO "<B><U>$ident</U></B> has been successfully ";
  if ($confirmation == "delete") {  ECHO "<B>deleted</B>.\n"; }
  if ($confirmation == "reset") {  ECHO "<B>reset</B>.\n"; }
  ECHO "<BR><BR><CENTER>[<A HREF=\"$whoami\">admin home</A>].</CENTER>";
}


/////////////////////////////////////////////////////////////////////
// PROCESSES TOGGLE ACTION
/////////////////////////////////////////////////////////////////////
function process_toggle($pid) {

  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  $whoami = basename(__FILE__);

  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE ("Unable to connect to database: $dbhost");
  MYSQL_SELECT_DB("$dbname") OR DIE ("Unable to select database: $dbname");

  $query = "SELECT status FROM sympoll_list WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query);
  $status = MYSQL_RESULT($result,$x,'status');

  // toggle and store it
  if($status == 1) { $status = 0; }
  else { $status = 1; }
  $query = "UPDATE sympoll_list SET status='$status' WHERE pollID='$pid'";
  $result = MYSQL_QUERY($query); 
  MYSQL_CLOSE();
}

///////////////////////////////////////////////////////////////////////////////
// !END! CODE TO PROCESS ACTIONS (DATABASE MANIPULATION)
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// !BEGIN! CODE EXECUTION-- NOTE THIS IS THE FIRST CODE ACTUALLY EXECUTED
///////////////////////////////////////////////////////////////////////////////
if($action == 'auth') {
  auth_user($user, $pass);
  exit();
}
elseif ($action == 'logout') {
  $path = dirname($PHP_SELF);
  if(strpos($HTTP_HOST,'.')==strrpos($HTTP_HOST,'.')) {
    header("Set-Cookie: sympauth1=0; path=/; domain=.$HTTP_HOST");
    header("Set-Cookie: sympauth2=0; path=/; domain=.$HTTP_HOST");
  }
  else {
    header("Set-Cookie: sympauth1=0; path=/; domain=$HTTP_HOST");
    header("Set-Cookie: sympauth2=0; path=/; domain=$HTTP_HOST");
  }
  auth_display();
  exit();
}
elseif ($action == 'p_adduser')
   { process_adduser($user, $pass1, $pass2); }

if($sympauth1 && $sympauth2) {
  if(!auth_cookie( $sympauth1, urldecode($sympauth2) )) {
    auth_display();
    exit();
  }
}
else {
  auth_display();
  exit();
}


if($action == 'create')
  { display_create(); }
elseif($action == 'view')
  { display_view($pid); }
elseif($action == 'edit')
  { display_edit($pid); }
elseif ($action == 'delete' || $action == 'reset')
  { display_del_rs($pid, $action); }
elseif($action == 'pass')
  { display_pass($pid); }


elseif($action == 'p_create') {
  $duh = 0;
  while(sizeof($opt) != 0 && list($k,$v) = each($opt)) {
    if(strlen(trim($v)) > 0)
      { $opts[$duh++] = $v; }
  }
  if( sizeof($opt) != 0) 
    { reset($opt); }
  process_create($ident, $question, $opts);
}


elseif ($action == 'p_edit') {
  $counter = 0;
  while(sizeof($deleteo) != 0 && list($k,$v) = each($deleteo)) {
    if($v == "poof")
      { $deleteoptions[$counter++] = $k; }
  }
  if( sizeof($deleteo) != 0) 
    { reset($deleteo); }

  while(sizeof($newo) != 0 && list($k,$v) = each($newo)) {
    if(strlen(trim($v)) > 0)
      { $newoptions[$k] = $v; }
  }
  if( sizeof($newo) != 0) 
    { reset($newo); }

  while(sizeof($updateo) != 0 && list($k,$v) = each($updateo)) {
    if(strlen(trim($v)) > 0)
      { $updateoptions[$k] = $v; }
  }
  if( sizeof($updateo) != 0) 
    { reset($updateo); }

  process_edit($pid, $ident, $question, $newoptions, $updateoptions, $deleteoptions);
}


elseif ($action == 'p_delete' || $action == 'p_reset') {
  if($confirmation == 'no')
    { display_opening(); } 
  else 
    { process_del_rs($pid, $ident, $confirmation); }
}


elseif ($action == 'p_pass')
  { process_pass(urldecode($sympauth2), $oldpass, $newpass1, $newpass2); }


elseif ($action == 'toggle') {
  process_toggle($pid);
  display_opening();
}


else 
  { display_opening(); }

///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// !END! CODE EXECUTION-- NOTE THIS IS THE FIRST CODE ACTUALLY EXECUTED
///////////////////////////////////////////////////////////////////////////////

?>

</BODY></HTML>
