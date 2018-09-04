<?php

class Poll {

  var $pid, $ident, $question, $tstamp, $status, $options, $highcid;

  function Poll($pid) {
    ////////////////////////
    // -1 = random poll   //
    // -2 = latest poll   //
    // >0 = that poll id  //
    ////////////////////////

    GLOBAL $dbhost, $dbuser, $dbpass, $dbname;

    MYSQL_CONNECT($dbhost,$dbuser,$dbpass) OR DIE("Unable to connect.");
    MYSQL_SELECT_DB("$dbname") OR DIE("Unable to select database");

    // random poll
    if($pid == -1) {
      $query = "SELECT pollID from sympoll_list WHERE(status!=0)";
      $result = MYSQL_QUERY($query);
      $rows = MYSQL_NUMROWS($result);
      srand((double) microtime() * 1000000);
      $pollnum = (rand() / getrandmax()) * $rows;
      $pid = MYSQL_RESULT($result,$pollnum,"pollID");
    }
    // latest poll
    elseif($pid == -2) {
      $query = "SELECT pollID from sympoll_list WHERE(status!=0) ORDER BY timeStamp DESC LIMIT 1";
      $result = MYSQL_QUERY($query);
      $pid = MYSQL_RESULT($result,0,"pollID");
    } 
    $query = "SELECT * from sympoll_list WHERE pollid=$pid";
    $result_l = MYSQL_QUERY($query);
    $query = "SELECT choiceID,choice from sympoll_data WHERE pollid=$pid ORDER BY choiceID";
    $result_d = MYSQL_QUERY($query);
    MYSQL_CLOSE();

    if(MYSQL_NUMROWS($result_l) <= 0)
      { $this->pid = -1; }

    else {
      $this->pid = $pid;
      $this->ident = htmlspecialchars(stripslashes(MYSQL_RESULT($result_l,0,"identifier")));
      $this->question = htmlspecialchars(stripslashes(MYSQL_RESULT($result_l,0,"question")));
      $this->tstamp = MYSQL_RESULT($result_l,0,"timeStamp");
      $this->status = MYSQL_RESULT($result_l,0,"status");
      $rows = MYSQL_NUMROWS($result_d);
      for($i = 0; $i < $rows; $i++) {
        $cid = MYSQL_RESULT($result_d,$i,"choiceID");
        $this->options[$cid] = htmlspecialchars(stripslashes(MYSQL_RESULT($result_d,$i,"choice")));
      } //for
    } //else
  } //constructor

} //end class Poll

?>
