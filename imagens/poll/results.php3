<?php

REQUIRE 'includes/config.php3';

/////////////////////////////////////////////////////////////
// PRINTS RESULTS
/////////////////////////////////////////////////////////////
function display_results($p, $r, $cid) {

 GLOBAL $symp_table_tx, $symp_table_bg;
 GLOBAL $symp_table_inner_bg, $symp_table_border;
 GLOBAL $bar_image, $bar_width;
 GLOBAL $urlpath, $version, $HTTP_HOST, $DOCUMENT_ROOT, $PHP_SELF;


  $urlpath;
  if(empty($urlpath)) {
    $urlpath = trim(dirname(str_replace($DOCUMENT_ROOT, "", __FILE__)));
    if(ereg("^[^/]", $urlpath))
      $urlpath = "/".$urlpath;
    $urlpath = "http://${HTTP_HOST}${urlpath}";
  }
  if(ereg("[^/]$", $urlpath))
    $urlpath = $urlpath.'/';


 //////////////////////////////////
 // BEGIN OUTPUT OF MAIN TABLE
 //////////////////////////////////
 $title = "Results for: ".$p->question;
 REQUIRE 'includes/header.php3';
 ECHO "
  <TABLE BORDER=\"0\" CELLSPACING=\"10\" CELLPADDING=\"0\" ALIGN=\"center\">
  <TR><TD>

  <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
  <TR><TD>
  <TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">
  <TR><TD ALIGN=\"center\">
  <FONT COLOR=\"$symp_table_tx\"><B>".$p->question."</B></FONT>
  </TD></TR></TABLE>
  </TD></TR></TABLE>

  </TD></TR><TR><TD>

  <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
  <TR><TD>
  <TABLE BORDER=\"0\" CELLPADDING=\"12\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">
  <TR><TD VALIGN=\"bottom\">\n";
 //END_ECHO

 ////////////////////////////////////
 // BEGIN OUTPUT OF BAR GRAPH
 ////////////////////////////////////
 // which normalizer to use?
 $normalizer;
 if($r->highvote <= .20) { $normalizer = 850; }
 elseif($r->highvote <= .40) { $normalizer = 420; }
 elseif($r->highvote <= .60) { $normalizer = 280; }
 elseif($r->highvote <= .80) { $normalizer = 210; }
 else { $normalizer = 170; }

 // normalize percentages
 while(sizeof($r->votepcts) != 0 && list($k,$v) = each($r->votepcts))
  $r->votepcts[$k] = floor($v * $normalizer);
 reset($r->votepcts);

 // print out bar graph 
 ECHO "<TABLE BORDER=\"0\" CELLPADDING=\"3\" CELLSPACING=\"2\" bgcolor=\"$symp_table_inner_bg\"><TR>\n";

 while(sizeof($r->votepcts) != 0 && list($k,$v) = each($r->votepcts)) {
  ECHO "<TD ALIGN=\"center\" VALIGN=\"bottom\">\n";
  if ($v != 0) 
   ECHO "<IMG SRC=\"$bar_image\" WIDTH=\"$bar_width\" HEIGHT=\"$v\">";
  else 
   ECHO "<IMG SRC=\"images/blank.gif\" WIDTH=\"$bar_width\" HEIGHT=\"10\">";
  ECHO "</TD>\n";
 }
 reset($r->votepcts);
 ECHO "</TR><TR>\n";

 // print out numbers
 for ($x = 0; $x < sizeof($r->votes); $x++) {
  ECHO "<TD ALIGN=\"center\" VALIGN=\"top\"><FONT COLOR=\"$symp_table_tx\"><B>".($x+1)."</B></FONT></TD>\n";
 }
 ECHO "</TR></TABLE>\n\n";
 ////////////////////////////////////
 // END OUTPUT OF BAR GRAPH
 ////////////////////////////////////

 ECHO "</TD><TD VALIGN=\"bottom\">\n\n";

 ///////////////////////////////////
 // BEGIN OUTPUT OF PERCENTAGES
 ///////////////////////////////////
 ECHO "<TABLE BORDER=\"0\" CELLPADDING=\"3\" CELLSPACING=\"2\" bgcolor=\"$symp_table_inner_bg\">\n";
 $x = 0;
 while(sizeof($p->options) != 0 && list($k,$v) = each($p->options)) {
  ECHO "<TR><TD><FONT COLOR=\"$symp_table_tx\">\n";
  PRINTF ("<B>%d: </B>%s, <B>%d votes</B>", ++$x, $v, $r->votes[$k]);
  ECHO "</FONT></TD></TR>\n\n";
 }
 reset($p->options);
 ECHO "
  <TR><TD><FONT COLOR=\"$symp_table_tx\">
  <B>Total Votes: $r->tvotes</B>
  </FONT></TD></TR></TABLE>\n";
 //END_ECHO
 ///////////////////////////////////
 // END OUTPUT OF PERCENTAGES
 ///////////////////////////////////

 ECHO "
  </TD></TR><TR><TD>&nbsp;</TD><TD VALIGN=\"top\">
  [<A HREF=\"${urlpath}polllist.php3\">More Polls</A>]
  </TD></TR></TABLE>
  </TD></TR></TABLE>

  </TD></TR><TR><TD>

  <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
  <TR><TD>
  <TABLE BORDER=\"0\" CELLPADDING=\"5\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">
  <TR><TD VALIGN=\"top\" ALIGN=\"center\">
  <FONT COLOR=\"$symp_table_tx\">\n";
 //END_ECHO

 if($cid == -1)
  ECHO "<B>Results Only -- You did not vote.</B></FONT>\n";
 else
  PRINTF ("<B>You voted for \"%s\"</B></FONT>\n", $p->options[$cid]);

 ECHO "
  </TD></TR></TABLE>
  </TD></TR></TABLE>

  </TD></TR></TABLE>

  <TABLE BORDER=\"0\" CELLSPACING=\"10\" CELLPADDING=\"0\" ALIGN=\"center\" WIDTH=75%><TR><TD VALIGN=\"top\">

  <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
  <TR><TD VALIGN=\"top\">
  <TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">
  <TR><TD VALIGN=\"top\">
  <FONT COLOR=\"$symp_table_tx\">
  <B><U>Important Note</U>:</B>
  Do not depend on the accuracy of these results for any important number crunching.  
  Please understand that this poll is definitely <B>not</B> tamper-proof.
  </TD></TR><TR><TD>
  <FONT COLOR=\"$symp_table_tx\" SIZE=\"2\">
  sympoll &nbsp; v$version</FONT>
  </TD></TR></TABLE>
  </TD></TR></TABLE>

  </TD></TR></TABLE>\n";
 //END_ECHO

 REQUIRE 'includes/footer.php3';
}

///////////////////////////////////////////
// VIEW RESULTS ONLY, $cid == -1
///////////////////////////////////////////
if(isset($vo) && $vo == 1) {
  REQUIRE 'classes/result.php3';
  REQUIRE 'classes/poll.php3';
  $p = new Poll($pid);
  $r = new Result($pid);
  display_results($p, $r, -1);
}

?>
