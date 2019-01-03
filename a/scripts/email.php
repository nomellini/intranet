<?
	list($tmp1, $tmp) = each( pegaClientePorCodigoUnico($objChamado->cliente_id) );
	$Cliente = $tmp["cliente"];
	$Telefone = $tmp["telefone"];
	$Pessoa = $objContato->pessoacontatada;
	
	list($tmp1, $tmp) = each( pegaUsuario($id_usuario) );
	$emailUsuario = $tmp["email"];
	$Usuario = $tmp["nome"];
	
	list($tmp1, $tmp) = each( pegaUsuario($objChamado->destinatario_id) );
	$emailDestinatario = $tmp["email"];
	$Destinatario = $tmp["nome"];    
	$emailsn = $tmp["emailsn"];
	
	$DestinatatiosPorAssinatudaOrigem = conn_ObterEmailsPorTipoDeContato($objContato->origem_id);
	
	$Anexos = conn_ObterListaAnexosContato($objContato->id_contato);
	
	$links = "";
	
	if (count($Anexos) != 0) {
		$links = "Anexos<br>";
	}
	
	while ( list($tmp1, $tmp) = each($Anexos) ) {
		$links .= "<br>" . $tmp["link"];
	}
	
	$sistema = pegaSistema( $objChamado->sistema_id );  

	$descricao = nl2br(conn_executeScalar("select descricao from chamado where id_chamado=$objChamado->id_chamado"));
	
//	$descricao = nl2br($objChamado->descricao);	
	
	$Prioridade = pegaPrioridade($objChamado->prioridade_id);

  $msg="
  
  <head>
	<meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />
  </head>
  
  <p>
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
    
    Contato encaminhado por <em>$Usuario</em> para 
    <strong>
    <font color=\"#333333\">
      <em>$Destinatario      </em>
    </font>
    </strong>
  </font>
  <br />
  <br />
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Chamado   : <strong>$objChamado->id_chamado</strong><br />
    Aberto em : <strong>$objChamado->dataaf - $objChamado->horaa</strong><br />
    Sistema   : <strong>$sistema</strong><br />
  </font>
  <br />
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      <em><strong>
        <font color=\"#666666\">
          Descri&ccedil;&atilde;o do chamado
      </font>
      </strong></em>
  </font>
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
    <em><strong>
  <font color=\"#666666\">
        :
  </font>
    </strong></em>
  </font>
</p>
<blockquote>
  <p>  
    <font color=\"#003366\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      $descricao
    </font>
    </p>
</blockquote>
<p>
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
    <font color=\"#666666\">
      <em><strong>Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa</strong></em></font>
  </font>
</p>
<blockquote>
  <p>
    <font color=\"#003366\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      $historico
    </font>
  </p>
</blockquote>
$links
<p>
    <strong>
    <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      <font color=\"#666666\">
        <em>Informa&ccedil;&otilde;es sobre o Cliente:</em>
      </font>
    </font>
    </strong>
</p>
<blockquote>
  <p>
    <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      
      Cliente : <strong>$Cliente</strong><br />
      Telefone : <strong>$Telefone</strong><br />
      Pessoa Contatada : <strong>$Pessoa</strong>
    </font>
</p>
</blockquote>
	 <a href=\"http://192.168.0.14/a/historicochamado.php?&id_chamado=" . $objChamado->id_chamado . "\">Link direto para o chamado</a>";

	$ReplyTo = "$emailUsuario:$Usuario [Via SAD]";  
	$recipient = "$emailDestinatario"; 
	$subject = "Ch: $objChamado->id_chamado - [$Prioridade] - [$Cliente] Encaminhado";
	$headers = "$Usuario [Via SAD]". "+" . $ReplyTo;
	
	if ($action == "encaminhar")	
	{
		
		if ($emailsn) {
			mail2($recipient, $subject, $msg, $headers);
		}
	}


	$NomeCliente = pegacliente($objChamado->cliente_id);



	// Manda email para quem assina por tipo de contato
	while ( list($tmp1, $tmp) = each($DestinatatiosPorAssinatudaOrigem) ) {		
		
		$origem = $tmp["origem"];		
		$email = $tmp["email"];
		
//		if ( $emailDestinatario != $email) {		
			$ReplyTo = "$emailUsuario:$Usuario";  
			$recipient = "$email"; 
			$subject = "$origem. ($NomeCliente - $objChamado->cliente_id) - $sistema";
			$headers = "$Usuario". "+" . $ReplyTo;
			mail2($recipient, $subject, $msg, $headers);
//		}
	}
	
	
	
  
  
 ?>
