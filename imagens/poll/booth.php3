<?php

REQUIRE dirname(__FILE__).'/includes/config.php3'; 
REQUIRE dirname(__FILE__).'/classes/poll.php3';
REQUIRE dirname(__FILE__).'/classes/result.php3';

function boothUI($p) {

  GLOBAL $booth_htx, $booth_hbg, $symp_table_tx, $symp_table_bg;
  GLOBAL $symp_table_border, $booth_fontsize, $booth_width;
  GLOBAL $urlpath, $version, $HTTP_HOST, $DOCUMENT_ROOT;

  $urlpath;
  if(empty($urlpath)) {
    $urlpath = trim(dirname(str_replace($DOCUMENT_ROOT, "", __FILE__)));
    if(ereg("^[^/]", $urlpath))
      $urlpath = "/".$urlpath;
    $urlpath = "http://${HTTP_HOST}${urlpath}";
  }
  if(ereg("[^/]$", $urlpath))
    $urlpath = $urlpath.'/';
  // to ensure we can fit everything, minimum booth_width is 100
  if($booth_width < 100)
    $booth_width = 100;

  ECHO "
   <FORM METHOD=\"post\" ACTION=\"${urlpath}dovote.php3\">
   <TABLE BORDER=\"0\" CELLSPACING=\"2\" CELLPADDING=\"0\" WIDTH=\"$booth_width\" BGCOLOR=\"$symp_table_bg\">
   <TR><TD>

   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"1\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
   <TR><TD>
   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$booth_hbg\" WIDTH=\"100%\">
   <TR><TD>
   <FONT COLOR=\"$booth_htx\" SIZE=\"$booth_fontsize\"><B>$p->question</B></FONT>
   </TD></TR></TABLE>
   </TD></TR></TABLE>

   </TD></TR><TR><TD>

   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"1\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
   <TR><TD>
   <TABLE BORDER=\"0\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">\n";
  //END_ECHO

  while(sizeof($p->options) !=0 && list($k,$v) = each($p->options)) {
    ECHO "
     <TR><TD WIDTH=\"10\" VALIGN=\"top\">
     <INPUT TYPE=\"radio\" NAME=\"cid\" VALUE=\"$k\"></TD>
     <TD VALIGN=\"top\"><FONT COLOR=\"$symp_table_tx\" SIZE=\"$booth_fontsize\">
     $v
     </FONT></TD></TR>\n\n";
    //END_ECHO
  } //while
  reset($p->options);

  ECHO "
   <TR><TD COLSPAN=\"2\">
   <FONT COLOR=\"$symp_table_tx\" SIZE=\"$booth_fontsize\">
   &nbsp;<INPUT TYPE=\"submit\" VALUE=\"Vote!\"><BR><BR>
   <CENTER><A HREF=\"${urlpath}results.php3?vo=1&pid=$p->pid\">[Resultados</A>
    | <A HREF=\"${urlpath}polllist.php3\">Outras enquetes</A>]
   <BR></CENTER>
   <I> sympoll &nbsp; v$version</I></FONT>
   </TD></TR></TABLE>
   </TD></TR></TABLE>

   </TD></TR></TABLE>
   <INPUT TYPE=\"hidden\" NAME=\"pid\" VALUE=\"$p->pid\">
   </FORM>\n";
  //END_ECHO
}



function resultsUI($p, $r, $cid) {
  GLOBAL $booth_htx, $booth_hbg, $symp_table_tx, $symp_table_bg;
  GLOBAL $symp_table_border, $booth_fontsize, $booth_width;
  GLOBAL $bar_image, $bar_width;
  GLOBAL $urlpath, $version, $HTTP_HOST, $DOCUMENT_ROOT;

  $urlpath;
  if(empty($urlpath)) {
    $urlpath = trim(dirname(str_replace($DOCUMENT_ROOT, "", __FILE__)));
    if(ereg("^[^/]", $urlpath))
      $urlpath = "/".$urlpath;
    $urlpath = "http://${HTTP_HOST}${urlpath}";
  }
  if(ereg("[^/]$", $urlpath))
    $urlpath = $urlpath.'/';

  // to ensure we can fit everything, minimum booth_width is 100
  if($booth_width < 100)
    $booth_width = 100;

  ECHO "
   <FORM METHOD=\"post\" ACTION=\"${urlpath}dovote.php3\">
   <TABLE BORDER=\"0\" CELLSPACING=\"2\" CELLPADDING=\"0\" WIDTH=\"$booth_width\" BGCOLOR=\"$symp_table_bg\">
   <TR><TD>

   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"1\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
   <TR><TD>
   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"2\" BGCOLOR=\"$booth_hbg\" WIDTH=\"100%\">
   <TR><TD>
   <FONT COLOR=\"$booth_htx\" SIZE=\"$booth_fontsize\"><B>$p->question</B></FONT>
   </TD></TR></TABLE>
   </TD></TR></TABLE>

   </TD></TR><TR><TD>

   <TABLE BORDER=\"0\" CELLSPACING=\"0\" CELLPADDING=\"1\" BGCOLOR=\"$symp_table_border\" WIDTH=\"100%\">
   <TR><TD>
   <TABLE BORDER=\"0\" CELLSPACING=\"0\" BGCOLOR=\"$symp_table_bg\" WIDTH=\"100%\">\n";
  //END_ECHO

  while(sizeof($p->options) !=0 && list($k,$v) = each($p->options)) {
    $pct = round($r->votepcts[$k] * 100); 
    if($r->highvote > 0)
      { $imgpct = floor($r->votepcts[$k] * floor(($booth_width-40) / $r->highvote) ); }
    else
      { $imgpct = 0; }
    ECHO "<TR><TD VALIGN=\"top\"><FONT COLOR=\"$symp_table_tx\" SIZE=\"$booth_fontsize\">\n";
    if($k == $cid)
      { ECHO "<B>$v</B>\n"; }
    else
      { ECHO "$v\n"; }
    if ($imgpct != 0)
      ECHO "<BR><IMG SRC=\"${urlpath}${bar_image}\" WIDTH=\"$imgpct\" HEIGHT=\"$bar_width\">&nbsp;${pct}%<BR>";
    else
      ECHO "<BR><IMG SRC=\"${urlpath}images/blank.gif\" WIDTH=\"5\" HEIGHT=\"$barwidth\">&nbsp;0%<BR>";

    ECHO "</FONT></TD></TR>\n\n";
  } //while
  reset($p->options);
  ECHO "<TR><TD COLSPAN=\"2\"><FONT COLOR=\"$symp_table_tx\" SIZE=\"$booth_fontsize\">\n";
  ECHO "<I>Total de votos:</I> $r->tvotes";
  ECHO "</FONT></TD></TR>\n\n";

  ECHO "
   <TR><TD COLSPAN=\"2\">
   <FONT COLOR=\"$symp_table_tx\" SIZE=\"$booth_fontsize\">
   <CENTER>[<A HREF=\"${urlpath}polllist.php3\">Outras Pesquisas</A>]
   <BR></CENTER>
   <I> sympoll &nbsp; v$version</I></FONT>
   </TD></TR></TABLE>
   </TD></TR></TABLE>

   </TD></TR></TABLE>
   <INPUT TYPE=\"hidden\" NAME=\"pid\" VALUE=\"$p->pid\">
   </FORM>\n";
  //END_ECHO
}


function display_booth($pid) {
 $p = new Poll($pid);
 $cookiename = 'symp'.$p->tstamp;
 GLOBAL $$cookiename;
 $cookie = $$cookiename;

 // makes sure cookie does not equal "voted" for backwards compatibility
 // only. will be removed soon
 if ($p->status == 0 || $p->pid < 0)
   ECHO "<B>This poll has been disabled by the administrator.</B>";
 elseif( isset($cookie) && strcmp($cookie,"voted") != 0 )
   resultsUI( $p, new Result($p->pid), $cookie);
 else
   boothUI($p);
} 
function random_booth() { display_booth(-1); } 
function newest_booth() { display_booth(-2); } 


// TEMPORARY WRAPPER FOR BACKWARDS COMPATIBILITY
// --WILL BE REMOVED SOON--
function display_boothUI($pid) {
  display_booth($pid);
}



?>
