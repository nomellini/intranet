<?php

REQUIRE 'includes/config.php3';
REQUIRE 'classes/result.php3';
REQUIRE 'classes/poll.php3';

$p = new Poll($pid);
$r = new Result($pid);

$urlpath;
if(empty($urlpath)) {
  $urlpath = trim(dirname(str_replace($DOCUMENT_ROOT, "", __FILE__)));
  if(ereg("^[^/]", $urlpath))
    $urlpath = "/".$urlpath;
  $urlpath = "http://${HTTP_HOST}${urlpath}";
}
if(ereg("[^/]$", $urlpath))
  $urlpath = $urlpath.'/';

$reference;
if(isset($HTTP_REFERER))
  { $reference = $HTTP_REFERER; }
else
  { $reference = $urlpath.'polllist.php3'; }


$cookiename = 'symp'.$p->tstamp;
$cookie = $$cookiename;

// tried to vote without selecting an option or option can't 
// be verified as valid or already voted.  attempt to just
// return them to the previous page.
if(isset($cookie) || !isset($cid) || !isset($p->options[$cid])) {
  header("Location: $reference"); 
  exit(0);
}

// the hostname field in a cookie must have at least two dots by
// netscape's universal cookie specification
$date = gmdate("l, d-M-y H:i:s", (time()+($cookie_expire*86400))).' GMT';
if(strpos($HTTP_HOST,'.')==strrpos($HTTP_HOST,'.'))
  header("Set-Cookie: $cookiename=$cid; expires=$date; path=/; domain=.$HTTP_HOST");
else
  header("Set-Cookie: $cookiename=$cid; expires=$date; path=/; domain=$HTTP_HOST");

// increment vote
$r->inc_vote($cid); 

// check to see if they support cookies, then display results
header("Location: ${urlpath}fwdcheck.php3?pid=${pid}&cid=${cid}&ref=${reference}");

?>
