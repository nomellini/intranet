<?php

class Result {

 var $pid, $votes, $tvotes, $highvote, $votepcts;

 function Result($pid) {
  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE("Unable to connect.");
  MYSQL_SELECT_DB("$dbname") OR DIE("Unable to select database");
  $query = "SELECT choiceID,votes from sympoll_data WHERE pollid=$pid ORDER BY choiceID";
  $result = MYSQL_QUERY($query);
  $rows = MYSQL_NUMROWS($result);
  MYSQL_CLOSE();

  $this->pid = $pid;
  $this->tvotes = 0;
  for($i = 0; $i < $rows; $i++) {
   $cid = MYSQL_RESULT($result,$i,"choiceID");
   $this->votes[$cid] = MYSQL_RESULT($result,$i,"votes");
   $this->tvotes += $this->votes[$cid];
  } //for
  $this->calc_pcts();
 } //end Result($pid) 


 function calc_pcts() {
  $this->highvote = -1;
  while(sizeof($this->votes) != 0 && list($k,$v) = each($this->votes)) {
   if($this->tvotes > 0)
    $this->votepcts[$k] = $v / $this->tvotes;
   else
    $this->votepcts[$k] = 0;
   if ($this->votepcts[$k] > $this->highvote)
    $this->highvote = $this->votepcts[$k];
  }
  reset($this->votes);
 } 

 function inc_vote($cid) {
  GLOBAL $dbhost, $dbuser, $dbpass, $dbname;
  MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE("Unable to connect.");
  MYSQL_SELECT_DB("$dbname") OR DIE("Unable to select database");
  MYSQL_QUERY("UPDATE sympoll_data SET votes=votes+1 WHERE(pollID=$this->pid AND choiceID=$cid)");
  MYSQL_CLOSE();
  $this->votes[$cid]++;
  $this->tvotes++;
  $this->calc_pcts();
 } //end inc_vote($cid)

} //end class Result 

?>
