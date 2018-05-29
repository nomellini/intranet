<?php



	function slack_publish($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente) {	
		slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, "Recebimento de chamado");	
	}
	
	function slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, $Fallback)
	{
		$Ds_Descricao = "[$Ds_Cliente] - " . $Ds_Descricao;
		
		$Ds_Descricao = str_replace("\\", "_", $Ds_Descricao);
		
		$sad_link = "http://192.168.0.14/a/historicochamado.php?&id_chamado=$Id_Chamado";
		// Create the context for the request
		$context = stream_context_create(array(
			'http' => array(
				// http://www.php.net/manual/en/context.http.php
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n",
				'content' => '{"channel":"'.$UserId.'","attachments": [{"fallback": "'. $Fallback .' : '.$Id_Chamado.'","color": "#36a64f","title": "Chamado '.$Id_Chamado.'","title_link": "'.$sad_link.'","text": "'.$Ds_Descricao.'"}]}'
			)
		));
	
	
		// Send the request
		$error_Level = error_reporting();
		error_reporting(0);
		$response = file_get_contents('https://hooks.slack.com/services/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', FALSE, $context);
		error_reporting($error_Level);		
				
		// Check for errors
//		if($response === FALSE){
//			die('Error');
//		}
	}

?>