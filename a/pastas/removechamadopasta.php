<?
	require("../scripts/conn.php");
	$sql = "delete from chamado_pasta where id_chamado=$id_chamado and id_pasta=$id_pasta;";
	mysql_query($sql);
	header("Location: ../inicio.php");
?>