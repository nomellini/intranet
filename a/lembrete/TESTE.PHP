<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?
  $today=date("Y-m-d H:i:s"); 
  $date1=strtotime('2001-12-13 08:00:00');
  $date2=strtotime('2001-12-13 14:00:00');
  $agora=strtotime($today);

  echo "<br>";
  
  echo "Agora : $agora,  Data 1 : $date1   Data 2 : $date2 ";

  echo "<br> - ";
  
  echo $date1 < $agora;
  
  echo "<br> -  ";
  
  echo $date2 < $agora;
  
  echo "<br>";
  echo "<br>";
  echo "<br>";  
  
?>

</body>
</html>
