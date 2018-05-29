<?
    require("scripts/conn.php");	
	
	/*
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	*/
	
	
	$sql = "select cliente.id_cliente, "; 
	$sql .= " time_to_sec(curtime()) - time_to_sec(hora_inicio) segundos, ";
	$sql .= " sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as tempo from satligacao, cliente, sistema where ";
	$sql .= " data = curdate() and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
	$sql .= "  id_satstatus = 1 order by segundos desc limit 4; ";
		
header("Content-type: text/xml");
print '<?xml version="1.0" encoding="iso-8859-1"?>';
echo "\n";
print '<sad>';
echo "\n";
$result = mysql_query($sql) or die ($sql);

print "<espera>\n";

	while($linha = mysql_fetch_object($result)) {  
		$sat_idcliente = $linha->id_cliente;  
		$sat_idcliente = eregi_replace("&", "_e_", $sat_idcliente);
		$segundos = $linha->segundos;
		$tempo = $linha->tempo;     	
		print "<cliente>\n";
			print "<nome>$sat_idcliente\n$tempo</nome>\n";	
			print "<tempo>$tempo</tempo>\n";	
			print "<TempoEmSegundos>$segundos</TempoEmSegundos>\n";			
		print "</cliente>\n";
  	}
print "<cliente>\n";
	print "<nome>Amarelo</nome>\n";	
	print "<tempo>0</tempo>\n";	
	print "<TempoEmSegundos>480</TempoEmSegundos>\n";			
print "</cliente>\n";
print "<cliente>\n";
	print "<nome>Vermelho</nome>\n";	
	print "<tempo>0</tempo>\n";	
	print "<TempoEmSegundos>900</TempoEmSegundos>\n";			
print "</cliente>\n";

print "</espera>\n";
print '</sad>';
echo "\n";
mysql_close($link);
exit();
?>
