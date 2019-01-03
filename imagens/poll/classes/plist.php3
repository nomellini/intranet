<?php

class PList {

 var $numpolls, $ident, $question, $tstamp, $status;

 function PList() {
  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE("Unable to connect.");
  MYSQL_SELECT_DB("$dbname") OR DIE("Unable to select database");
  $query = "SELECT * from sympoll_list ORDER BY pollid";
  $result = MYSQL_QUERY($query);
  MYSQL_CLOSE();

  $rows = MYSQL_NUMROWS($result);

  $numpolls = 0;
  for($i = 0; $i < $rows; $i++) {
   $this->numpolls = $this->numpolls + 1;
   $pid = MYSQL_RESULT($result,$i,"pollID");
   $this->ident[$pid] = htmlspecialchars(stripslashes(MYSQL_RESULT($result,$i,"identifier")));
   $this->question[$pid] = htmlspecialchars(stripslashes(MYSQL_RESULT($result,$i,"question")));
   $this->tstamp[$pid] = MYSQL_RESULT($result,$i,"timeStamp");
   $this->status[$pid] = MYSQL_RESULT($result,$i,"status");
  } //for
 } //end List 

} //end class List

?>
