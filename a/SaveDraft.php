<?
	require("scripts/conn.php");	
	$contato = str_replace("\r", "", $contato);
	$contato = mysql_real_escape_string ($contato);
	$Hora_Inicio = mysql_real_escape_string ($hora_inicio);
	$sql = "update contato_temp set contato = '$contato', hora = '$Hora_Inicio' where id_chamado = $id_chamado and id_usuario = $id_usuario";
	mysql_query($sql);
?>
