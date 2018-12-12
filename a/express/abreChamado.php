<?php
	require("../cabeca.php");
	require("../slack.php");

	
	$Chamado = mysql_real_escape_string ($Chamado);
	$Contato = mysql_real_escape_string ($Contato);	
    $datae = date("Y-m-d");
    $horae = date("H:i:s");	
	
	$Email = PegaEmailUsuario($Destinatario);
	$NomeCliente = peganomeusuario($Destinatario);
	
	

	if ($id_sistema == 0) {
		$id_sistema = 103;
	}

	
		
	$sql = "insert into chamado ( ";
	$sql .= " consultor_id, cliente_id, sistema_id, categoria_id, ";
	$sql .= " prioridade_id, motivo_id, descricao, dataa, status, horaa, ";
	$sql .= " destinatario_id, remetente_id, diagnostico_id, email, lido, ";
	$sql .= " lidodono, nomecliente, datauc, horauc, visible ) ";	
	$sql .= " values ( ";
	$sql .= " 12, 'DATAMACE', $id_sistema, 925, ";
	$sql .= " 1, 73, '$Chamado', '$datae', 2, '$horae', ";
	$sql .= " $Destinatario, 12, 13, '$Email', 0, ";
	$sql .= " 1, '$NomeCliente', '$datae', '$horae', 1 )";
	
	mysql_query($sql) or die (mysql_error());
	
	$sql = "select id_chamado from chamado where destinatario_id = $Destinatario order by id_chamado desc limit 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
		
	$id_chamado = $linha->id_chamado;
	
	$sql = "insert into contato ( ";
	$sql .= " chamado_id, pessoacontatada, origem_id, "; 
	$sql .= " historico, consultor_id, destinatario_id, status_id, "; 
	$sql .= " dataa, datae, horaa, horae, idc, publicar, fl_ativo ) "; 	
	$sql .= " values ( ";	
	$sql .= " $id_chamado, '$NomeCliente', 8, "; 
	$sql .= " '$Contato', 12, $Destinatario, 2, "; 
	$sql .= " '$datae', '$datae', '$horae', '$horae', $id_chamado, 0, 1"; 
	$sql .= " )";	
	
	mysql_query($sql) or die (mysql_error());
	
	slack_publish("@fnomellini", $id_chamado, $Chamado, "Datamace");
	
	
	// Mandar email:	
	$subject = "Mais um chamado pra você !";
	$headers = "Fernando Nomellini+fernando.nomellini@datamace.com.br:Fernando";		
	$msg = "<a href='http://192.168.0.14/a/historicochamado.php?id_chamado=$id_chamado'>Link direto [Chamado $id_chamado] </a><BR><BR>$Chamado";
	mail2($Email, $subject, $msg, $headers);	
	loga_novoChamado($ok, $id_chamado);		
	//header("location: /a/historicochamado.php?id_chamado=$id_chamado");	
	header("location: /a/manut/ec.php?userid=c20ad4d76fe97759aa27a0c99bff6710&acao=ver&id=$id_chamado");
?>