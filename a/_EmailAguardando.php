<?

	$ChamadoEmQuestao = $objChamado->id_chamado;

	$temEmailDependente = conn_TemChamadosAguardando($ChamadoEmQuestao);
	
	if ($temEmailDependente) {			
	
		$lSql = "select id_chamado, destinatario_id from chamado where id_chamado_espera = $ChamadoEmQuestao";
		
		$r = mysql_query($lSql) or Die($lSql);
		while ($l = mysql_fetch_object($r)) 
		{
	
			list($tmp1, $tmp) = each( pegaUsuario($l->destinatario_id) );
			$emailDestinatario = $tmp["email"];
			$Destinatario = $tmp["nome"];    

			$textEmail = "\nVocê está recebendo este email pelo fato do chamado $l->id_chamado\n";
			$textEmail .= "que está com você estava dependendo do chamado $objChamado->id_chamado.\n\n";
			$textEmail .= "O Chamado " . $ChamadoEmQuestao . " foi encerrado";
			
			
			$subject = "Chamado encerrado: ". $ChamadoEmQuestao;
			$headers = "";
			$headers .= "Datamace Informática";				
			
			mail2($emailDestinatario, $subject, $textEmail, $headers);
			
			insere_contato($l->id_chamado, $l->destinatario_id, $ChamadoEmQuestao);
		}	
		
	}
	
  function insere_contato($id_chamado, $id_usuario, $chamado_espera)
  {  
		$datae = date("Y-m-d");
		$horae = date("H:i:s");					
		$_objChamado = new chamado();
		$_objContato = new contato();		
		
		$_objChamado->lerChamado($id_chamado);	
		$_objChamado->lido = 0;					
		$_objChamado->lidodono = 0;		
		$_objChamado->gravaChamado();	
			
		$id_contato_cliente = $_objContato->novocontato($id_chamado, $id_usuario, $id_usuario, $datae, $horae);
		$_objContato->lerContato($id_contato_cliente);		
		$_objContato->origem_id = 53;
		$_objContato->datae = $datae;
		$_objContato->horae = $horae;				
		$frasepadrao = "Este chamado estava aguardando o [$chamado_espera] que foi encerrado";
		$_objContato->historico = "$frasepadrao";			
		$_objContato->gravaContato();			  
  }

?>