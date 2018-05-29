<?
	require("../scripts/conn.php");	
	$Id = $_GET["id"];
	$Texto = $_GET["v"];	
	$sql = "select count(1) from clienteplus where id_cliente = '" . $Id . "'";
	$TemClientePlus = conn_ExecuteScalar($sql) > 0;
	if ($TemClientePlus)	{
		$sql = "update clienteplus set UltimaVersao = '" . $Texto . "'";
	}
	else {
		$sql = "insert into clienteplus (id_cliente, UltimaVersao) values ('" . $Id . "', '" . $Texto . "')";		
	}
	mysql_query($sql) or die ($sql);
?>