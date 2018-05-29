<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_sad = "localhost";
$database_sad = "SadBkp";
$username_sad = "sad";
$password_sad = "data1371";
$sad = mysql_connect($hostname_sad, $username_sad, $password_sad) or die(mysql_error());
?>