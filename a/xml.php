<?

    require("scripts/conn.php");	
	
header("Content-type: text/xml");
print '<?xml version="1.0" encoding="iso-8859-1"?>';
echo "\n";

print '<sad>';
echo "\n";


$sql = "select cliente.satid_cliente, cliente.cliente from satligacao";

	

$result = mysql_query($sql) or die ($sql);

print "<consultores>\n";

  while($linha = mysql_fetch_object($result)) {   		
	
	$id_cliente = $linha->id_cliente;
	//$id_cliente = str_replace('&', "e", $id_cliente);
	$cliente =   $linha->cliente;
	$cliente = str_replace('&', "e", $cliente);	

	print "<consultor>\n";
		print "<estado>$cliente</estado>\n";
		print "<cliente>$id_cliente</cliente>\n";	
	print "</consultor>\n";
  
 }

print "</consultores>\n";

print '</sad>';
echo "\n";

mysql_close($link);
exit();
?>
