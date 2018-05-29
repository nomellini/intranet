<html>
<head>
<title>Daily Counter 1.1</title>
<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="refresh" content="300">
<style type="text/css">
<!--
td {  font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#FFCC66" vlink="#FFCC66" alink="#FFCC66" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" cellspacing="1" cellpadding="2" align="center" width="400" bgcolor="#000000">
  <tr bgcolor="#999999">
    <td width="50"><font size="2">Time</font></td>
    <td width="95"><font size="2">IP Address</font></td>
    <td width="230"><font size="2">Host</font></td>
  </tr>
<?php
//  Daily Counter 1.1
//  Copyright (c)2000 bp135
//  URL: http://bp135.cjb.net

//  - chmod this document to 755! -

$fpt_ip = "ip.txt"; // path to IP log file

// end configuration
if(file_exists("$fpt_ip")) {
  $ip_array = file($fpt_ip);
  for ($i=sizeof($ip_array)-1;$i>=0;$i--) {
    list($time_stamp,$ip_addr,$hostname) = split("\|",$ip_array[$i]);
    $host = chop($hostname);
    $time_format = strftime("%H:%M",$time_stamp);
    echo "  <tr bgcolor=\"#003399\">\n";
    echo "    <td width=\"50\"><font size=\"-2\">$time_format</font></td>\n";
    echo "    <td width=\"95\"><font size=\"-2\">$ip_addr</font></td>\n";
    echo "    <td width=\"230\"><font size=\"-2\">$host</font></td>\n  </tr>\n";
  }
}
?>
  <tr align="right" bgcolor="#006633"> 
    <td colspan="3"><font size="-2"><a href="http://bp135.cjb.net" target="_blank">Daily Counter 1.1</a></font></td>
  </tr>
</table>
</body>
</html>
