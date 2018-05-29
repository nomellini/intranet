#!/usr/bin/php -q

<?php
/*
	Tarefa para rodar a cada minuto em horário comercial.	
*/
	require("../scripts/conn.php");
	
	$hoje = date("Y-m-d");		
	
	$sql = "select satligacao.id,  sattempos.grauDestino ";
	$sql .= "from satligacao inner join sattempos on sattempos.grau = satligacao.grau ";
	$sql .= "where (time_to_sec(curtime()) - time_to_sec(horaEntrada)) / 60 >= tempo and ";
	$sql .= "satligacao.grau <> 'G1' and data = '$hoje' and id_satstatus = 1 ";
	$hora = date("H:i:s");	
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result))
	{	
		$novoGrau = $linha->grauDestino;
		$id = $linha->id;
		$sql = "update satligacao set grau = '$novoGrau', horaEntrada = '$hora' where id = $id";
		mysql_query($sql);
	}
	
?>
