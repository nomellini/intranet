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
  
  $sistema = pegaSistema( $objChamado->sistema_id );

  $msg="<p>
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
      $objChamado->descricao
    </font>
    </p>
</blockquote>
<p>
  <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
    <font color=\"#666666\">
      <em><strong>Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa</strong></em>
    </font>
  </font>
</p>
<blockquote>
  <p>
    <font color=\"#003366\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">
      $objContato->historico
    </font>
  </p>
</blockquote>
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
";

  $recipient = "$emailDestinatario"; 
  $subject = "SAD - Chamado $objChamado->id_chamado";
  $headers = "";
  $headers .= "From: $Usuario <$email_from_email>\n";
  if ($emailsn) {
   mail2($recipient, $subject, $msg, $headers);
  }
  
 ?>