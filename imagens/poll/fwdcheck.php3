<?php

REQUIRE 'includes/config.php3';
REQUIRE 'classes/result.php3';
REQUIRE 'classes/poll.php3';

$p = new Poll($pid);

$cookiename = 'symp'.$p->tstamp;
$cookie = $$cookiename;

// they accepted the cookie, yippee!
if(isset($cookie)) {
  header("Location: $ref"); 
  exit();
}

// apparently at this point, client does not have cookie support
require 'results.php3';
$r = new Result($pid);
display_results($p, $r, $cid);

?>
