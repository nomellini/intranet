<?php 
	require_once('../../Connections/sad.php'); 
	mysql_select_db(sad) or die(mysql_error());
?>	
<?

	$erro = "";

	$sql = "select count(1) q from chamado where id_chamado = $chamado_destino";
	$result = mysql_query($sql) or die (mysql_error());
	$linha = mysql_fetch_object($result);
	$destino = $linha->q;
		
	if ($destino != 0) {
		$erro .= "Chamado $chamado_destino já existe ";
	}

	$sql = "select count(1) q from chamado where id_chamado = $chamado_origem";
	$result = mysql_query($sql) or die (mysql_error());
	$linha = mysql_fetch_object($result);
	$destino = $linha->q;
		
	if ($destino == 0) {
		$erro .= "<br>Chamado $chamado_origem não existe ";
	}
				
	if ($erro) {
		die($erro);
	}

	$sql = "update chamado set id_chamado = $chamado_destino where id_chamado = $chamado_origem";	
	mysql_query($sql) or die(mysql_error());
	$sql = "update contato set chamado_id = $chamado_destino where chamado_id = $chamado_origem";	
	mysql_query($sql) or die(mysql_error());
	
	
	
	
?>