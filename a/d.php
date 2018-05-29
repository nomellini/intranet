<?
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	require("scripts/conn.php");
	require("scripts/funcoes.php");	
	require("scripts/classes.php");	

	$atendimento = FuncoesUsuarioAtendimento($id_usuario);
	
	echo $atendimento;
	
?>