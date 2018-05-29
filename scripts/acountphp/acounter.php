<html>
<head>
<title>Animated Counter 1.1</title>
<script language="JavaScript">
<!--
function closeWin() {
	self.close();
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF">
<center>
<br>
<br>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Visitantes total 
  : </font><font size="2"><!--Cut here --> <?php
//  Simple Animated Counter PHP 1.1
//  Created by bp135
//  URL: http://bp135.cjb.net

//  - chmod this document to 755! -
		
// url to the digits
$img = "http://192.168.0.5/scripts/acountphp/";

// url to the animated digits
$animated_img = "http://192.168.0.5/scripts/acountphp/ani/";

// How many digits to show
$padding = 6;		          

// digit width and height
$width = 16;
$height = 22;

// path to the log file
$fpt = "/home/httpd/html/scripts/acountphp/acount.txt"; // log file - chmod it to 666

// optional configuration settings

$lock_ip =0; // IP locking to avoid reloading 1=yes 0=no
$ip_lock_timeout =30; // in minutes     
$fpt_ip = "ip.txt"; // IP log file - chmod it to 666

// end configuration

function checkIP($rem_addr) {
  global $fpt_ip,$ip_lock_timeout;
  $ip_array = file($fpt_ip);
  $reload_dat = fopen($fpt_ip,"w");
  $this_time = time();
  for ($i=0; $i<sizeof($ip_array); $i++) {
    list($ip_addr,$time_stamp) = split("\|",$ip_array[$i]);
    if ($this_time < ($time_stamp+60*$ip_lock_timeout)) {
      if ($ip_addr == $rem_addr) {
        $found=1;
      }
      else {
        fwrite($reload_dat,"$ip_addr|$time_stamp");
      }
    }
  }
  fwrite($reload_dat,"$rem_addr|$this_time\n");
  fclose($reload_dat);
  return ($found==1) ? 1 : 0;
}

if (!file_exists($fpt)) {
  $count_dat = fopen($fpt,"w+");
  $digits = 0;
  fwrite($count_dat,$digits);
  fclose($count_dat);
}
else {
  $line = file($fpt);
  $digits = $line[0];
  if ($lock_ip==0 || ($lock_ip==1 && checkIP($REMOTE_ADDR)==0)) {
    $count_dat = fopen($fpt,"r+");
    $digits++;
    fwrite($count_dat,$digits);
    fclose($count_dat);
  }
}
$digits = sprintf ("%0".$padding."d",$digits);
$ani_digits = sprintf ("%0".$padding."d",$digits+1);
echo "<table cellpadding=0 cellspacing=0 border=0><tr align=center>\n";
$length_digits = strlen($digits);
for ($i=0; $i < $length_digits; $i++) {
  if (substr("$digits",$i,1) == substr("$ani_digits",$i,1)) {
    $digit_pos = substr("$digits",$i,1);
    echo ("<td><img src=$img$digit_pos.gif width=$width height=$height></td>\n");
  }
  else {
    $digit_pos = substr("$ani_digits",$i,1);
    echo ("<td><img src=$animated_img$digit_pos.gif width=$width height=$height></td>\n");
  }
}
echo "</tr></table>\n";
?> <!--Cut here --> </font> 
</center>
</body>
</html>
