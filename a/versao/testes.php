<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?
$teste="Fernando Nomellini";
$a='';
$fp = fopen ("i_versao.htm", "r");
while (!feof($fp)) {
  $buffer = fgets($fp, 4096);
  $a .= $buffer;
}
fclose($fp);
$a = eregi_replace("\"", "", $a);	
eval ("\$a = \"$a\";");
echo $a;

?>
</body>
</html>
