<?
  /*
    Preparando o email para ser enviado ao cliente caso seja solicitado necessidade de treinamento
  */
  if ($enviaemail) {
  
    if ($NomeTreinando=='') {
    	$NomeTreinando = $pessoacontatada;
	}
	
	$consultor = peganomeusuario($ok);	

  
	$fileEmail=fopen('_email.txt', "r");
	$textEmail = fread( $fileEmail, 10000);	
	$textEmail = str_replace("[nome]", $NomeTreinando, $textEmail);
	$textEmail = str_replace("[chamado]", $chamado_id, $textEmail);
	$textEmail = str_replace("[email]", $emailpadrao, $textEmail);	
	$textEmail = str_replace("[id_cliente]", $cliente_id, $textEmail);	
	$textEmail = str_replace("[telefone]", pegaTelefoneCliente($cliente_id), $textEmail);	
	$textEmail = str_replace("[sistema]", pegaSistema($sistema_id), $textEmail);
	$textEmail = str_replace("[consultor]", $consultor, $textEmail);	
	$textEmail = str_replace("[contato]", $historico, $textEmail);		
	
	
	$textOriginal = $textEmail;
    
	
	$subject = "DATAMACE - Treinamento";
	$headers = "";
	$headers .= "From: Datamace Informсtica <treinamento@datamace.com.br>\n";
	/*
	 	Receberуo o email de solicitaчуo de treinamento
	 	as pessoas listadas na tabela usuario cujo flag recebeemailtreinamento = true
	 */
	$result = mysql_query("select nome, email from usuario where recebeemailtreinamento = 1");
	
	while ($linha =  mysql_fetch_object($result) ) {
      $textEmail = str_replace("[destinatario]", $linha->nome, $textOriginal);	
	  mail2($linha->email, $subject, $textEmail, $headers); 	    	
	}	
	mail2('treinamento@datamace.com.br', $subject, $textOriginal, $headers); 	    	
	mail2('fernando.nomellini@datamace.com.br', $subject, $textOriginal, $headers); 	    		
	
	
	fclose($fileEmail);  
	
    $_data = date("Y-m-d");	
    $sql = "";
	$sql .= "INSERT INTO clienteemail(tipo, email, pessoacontatada, chamado, cliente, data) ";
	$sql .= "VALUES ('T', '$emailpadrao', '$pessoacontatada', '$chamado_id', '$cliente_id', '$_data')";
	mysql_query($sql) or die ($sql);		
  }
?>