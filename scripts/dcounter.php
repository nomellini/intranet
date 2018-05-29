<html>
<head>
<title>Daily Counter</title>
<script language="JavaScript">
<!--
function closeWin() {
	self.close();
}
function openWindow() {
  window.open('visitors.php','Visitors','scrollbars=yes,width=420,height=210');
}
//-->
</script>
<style type="text/css">
<!--
.links { color: #000000}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<center>
  <br>
  <br>
  <u><font face="Arial, Helvetica, sans-serif" size="4">Daily Counter - PHP Version</font></u><br>
  <br>
  <font size="2" face="Arial, Helvetica, sans-serif">- Hit Reload - <br>
  <br>
  </font> 

  <table border="0" cellspacing="1" cellpadding="2" align="center">
  <tr>
    <td>
    <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
<?php
//  Daily Counter 1.1
//  Copyright (c)2000 bp135
//  URL: http://bp135.cjb.net

//  - chmod this document to 755! -

$fpt = "daily.txt"; // path to counter log file - chmod it to 666

// optional configuration settings

$lock_ip =0; // IP locking and logging 1=yes 0=no
$ip_lock_timeout =30; // in minutes     
$fpt_ip = "ip.txt"; // IP log file - chmod it to 666

// end configuration

function checkIP($rem_addr) {
  global $fpt_ip,$ip_lock_timeout;
  $ip_array = @file($fpt_ip);
  $reload_dat = fopen($fpt_ip,"w");
  $this_time = time();
  for ($i=0; $i<sizeof($ip_array); $i++) {
    list($time_stamp,$ip_addr,$hostname) = split("\|",$ip_array[$i]);
    if ($this_time < ($time_stamp+60*$ip_lock_timeout)) {
      if ($ip_addr == $rem_addr) {
        $found=1;
      }
      else {
      	fwrite($reload_dat,"$time_stamp|$ip_addr|$hostname");
      }
    }
  }
  $host = gethostbyaddr($rem_addr);
  if (!$host) { $host = $rem_addr; }
  fwrite($reload_dat,"$this_time|$rem_addr|$host\n");
  fclose($reload_dat);
  return ($found==1) ? 1 : 0;
}

$this_day=(date("d-m-Y"));	
if (!file_exists($fpt)) {
  $count_dat = fopen($fpt,"w+");
  $count = 1;
  fwrite($count_dat,$count);
  fclose($count_dat);
}
else {
  $row = file($fpt);
  $test = chop($row[0]);
  $count = $row[1];
  if ($this_day == $test) {
    if ($lock_ip==0 || ($lock_ip==1 && checkIP($REMOTE_ADDR)==0)) {
      $count++;
    }
  }
  else {
    $count = 1;
  }
  $count_dat = fopen($fpt,"w+");
  fwrite($count_dat,"$this_day\n");
  fwrite($count_dat,$count);
  fclose($count_dat);
}
echo "$this_day<br>Visitantes de hoje: <font color=#CC0066>$count</font></b>";
      
?>
<!--Cut here -->



<!--Cut here -->
     </font>
    </td>
  </tr>
</table>


  <br>
  <br>
  <a href="javascript:closeWin()"><font face="Arial, Helvetica, sans-serif" size="2">Close 
  window</font></a> 
</center>
</body>
</html>
