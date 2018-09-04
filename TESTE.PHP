<head>
<title><?=$id_chamado?> - <?=$objChamado->descricao?> : Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
	$Id_Chamado = 420466;
		
	include_once('./a/scripts/conn.php');
	include_once('./a/scripts/classes.php');
	include_once('./a/slack.php');


	$objChamado = new chamado();	
	$objChamado->LerChamado($Id_Chamado);
	$descricao = nl2br($objChamado->descricao);
	echo($descricao);

	
	
	//slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, "Recebimento de chamado");
	$Fallback = "Recebimento de chamado";
	$UserId = "@fnomellini";
	$Ds_Descricao = "Descrição";
	$Ds_Cliente = "Cliente";
	



	
		$PrioridadeId = conn_ExecuteScalar("select prioridade_id from chamado where id_chamado = $Id_Chamado");	
		$cores = array("good", "good", "warning", "danger", "danger", "good", "good", "good", "good", "good", "good", "good");						
		$cor = $cores[$PrioridadeId];
		
		$Ds_Descricao = nl2br(conn_ExecuteScalar("select descricao  from chamado where id_chamado = $Id_Chamado"));
		echo $Ds_Descricao;
	
		$Ds_Descricao = "[$Ds_Cliente] - " . $Ds_Descricao;		
		$Ds_Descricao = str_replace("\\", "_", $Ds_Descricao);		
		$sad_link = "http://192.168.0.14/a/historicochamado.php?&id_chamado=$Id_Chamado";
		// Create the context for the request
		$context = stream_context_create(array(
			'http' => array(
				// http://www.php.net/manual/en/context.http.php
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n",
				'content' => '{"channel":"'.$UserId.'","attachments": [{"fallback": "'. $Fallback .' : '.$Id_Chamado.'","color": "'.$cor.'","title": "Chamado '.$Id_Chamado.'","title_link": "'.$sad_link.'","text": "'.$Ds_Descricao.'"}]}'
			)
		));
	
	
		// Send the request
		$error_Level = error_reporting();
		error_reporting(0);
		$response = file_get_contents('https://hooks.slack.com/services/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', FALSE, $context);
		error_reporting($error_Level);			
		mysql_close($link);	
?>
