<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<?
  srand((double)microtime()*1000000);
  $session_id = md5(uniqid(rand()));
  echo $session_id;
?>


</body>
</html>
