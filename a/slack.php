<?php

	function slack_publish($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente) {	
		slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, "Recebimento de chamado");	
	}
	
	function slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, $Fallback)
	{

		$PrioridadeId = conn_ExecuteScalar("select prioridade_id from chamado where id_chamado = $Id_Chamado");
		$cores = array("good", "good", "warning", "danger", "danger", "good", "good", "good", "good", "good", "good", "good");						
		$cor = $cores[$PrioridadeId];
	
		$Ds_Descricao = "[$Ds_Cliente] - " . $Ds_Descricao;		
		$Ds_Descricao = str_replace("\\", "_", $Ds_Descricao);		
		$sad_link = "http://192.168.0.14/a/historicochamado.php?&id_chamado=$Id_Chamado";
		// Create the context for the request
		
				
		$sql = "select u.nome,	historico from contato c inner join usuario u on u.id_usuario = c.consultor_id where chamado_id = $Id_Chamado order by id_contato desc  limit 1";
		$query = mysql_query($sql);
		$linha = mysql_fetch_object($query);
		$historico = $linha->historico;
		$usuario = $linha->nome;
		$historico =  html_entity_decode($historico, ENT_QUOTES, 'UTF-8');		
	
/*
		if ($UserId	!= "@fnomellini")
		{
			$context = stream_context_create(array(
				'http' => array(
					// http://www.php.net/manual/en/context.http.php
					'method' => 'POST',
					'header' => "Content-Type: application/json\r\n",
					'content' => '{"channel":"@fnomellini","attachments": [{"fallback": "'. $Fallback .' : '.$Id_Chamado.'","color": "'.$cor.'","title": "Chamado '.$Id_Chamado.'","title_link": "'.$sad_link.'","text": "'.$Ds_Descricao.'", "fields":[ {"title":"Último contato de '.$usuario.':", "value":"'.$historico.'"}] },]}'
					)
				)
			);
			$response = file_get_contents('https://hooks.slack.com/services/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', FALSE, $context);			
		}
*/


		$context = stream_context_create(array(
			'http' => array(
				// http://www.php.net/manual/en/context.http.php
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n",
				'content' => '{"channel":"'.$UserId.'","attachments": [{"fallback": "'. $Fallback .' : '.$Id_Chamado.'","color": "'.$cor.'","title": "Chamado '.$Id_Chamado.'","title_link": "'.$sad_link.'","text": "'.$Ds_Descricao.'", "fields":[ {"title":"Último contato de '.$usuario.':", "value":"'.$historico.'"}] },]}'
			)
		));	
			
	
		// Send the request
		$error_Level = error_reporting();
		error_reporting(0);
		$response = file_get_contents('https://hooks.slack.com/services/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', FALSE, $context);


		error_reporting($error_Level);		
				
	}

?>