<?
	require("scripts/conn.php");	
	$documentacao = str_replace("\r", "", $documentacao);
	$documentacao = mysql_real_escape_string ($documentacao);
	$sql = "update chamado set rascunho = '$documentacao' where id_chamado = $id_chamado";
	mysql_query($sql);
?>