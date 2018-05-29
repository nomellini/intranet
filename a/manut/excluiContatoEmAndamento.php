<?
	require ('../scripts/conn.php');
	$sql = "delete from contato_temp where id_chamado = $id_chamado and id_usuario = $id_user";
	mysql_query($sql) or die (mysql_error() + " <br> <b>$sql</b>");
	header("location: ec.php?acao=ver&id=$id_chamado");
?>