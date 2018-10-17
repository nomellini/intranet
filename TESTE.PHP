<?php



	include_once('./a/scripts/conn.php');
	include_once('./a/scripts/classes.php');
	include_once('./a/slack.php');
	
		$id_usuario = 12;
	$Id_Chamado = 421189;
	$objChamado = new chamado();
	$objChamado->LerChamado($Id_Chamado);

	$historico = "Não sei não";

	
	/*
	
	$user = "sad";
	$pwd = "data1371";
	$base = "sad";
	$link = mysql_connect($host, $user, $pwd) or die(mysql_error());
	mysql_set_charset("utf8", $link);
	mysql_select_db($base) or die(mysql_error());
	
	


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



	$links = "";

	$sistema = pegaSistema( $objChamado->sistema_id );
	$descricao = nl2br($objChamado->descricao);
	$Prioridade = pegaPrioridade($objChamado->prioridade_id);

  $msg="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><p>
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

	$recipient = "fernando@datamace.com.br";


	

	mail2($recipient, $subject, $msg, "");




die($msg);
*/












	//slack($UserId, $Id_Chamado, $Ds_Descricao, $Ds_Cliente, "Recebimento de chamado");
	$Fallback = "Recebimento de chamado";
	$UserId = "@U1Y9ZEQ58";
	$Ds_Descricao = "Descrição";
	$Ds_Cliente = "Cliente";


		$PrioridadeId = conn_ExecuteScalar("select prioridade_id from chamado where id_chamado = $Id_Chamado");
		$cores = array("good", "good", "warning", "danger", "danger", "good", "good", "good", "good", "good", "good", "good");
		$cor = $cores[$PrioridadeId];

		$Ds_Descricao = nl2br(conn_ExecuteScalar("select descricao  from chamado where id_chamado = $Id_Chamado"));
		echo $Ds_Descricao;
		
		
		$sql = "select u.nome,	historico from contato c inner join usuario u on u.id_usuario = c.consultor_id where chamado_id = $Id_Chamado order by id_contato desc  limit 1";
		$query = mysql_query($sql);
		$linha = mysql_fetch_object($query);
		$historico = $linha->historico;
		$usuario = $linha->nome;
			

		$historico =  html_entity_decode($historico, ENT_QUOTES, 'UTF-8');		

		$Ds_Descricao = "[$Ds_Cliente] - " . $Ds_Descricao;
		$Ds_Descricao = str_replace("\\", "_", $Ds_Descricao);
		$sad_link = "http://192.168.0.14/a/historicochamado.php?&id_chamado=$Id_Chamado";
		// Create the context for the request
	$context = stream_context_create(array(
			'http' => array(
				// http://www.php.net/manual/en/context.http.php
				'method' => 'POST',
				'header' => "Content-Type: application/json\r\n",
				'content' => '{"channel":"'.$UserId.'","attachments": [{"fallback": "'. $Fallback .' : '.$Id_Chamado.'","color": "'.$cor.'","title": "Chamado '.$Id_Chamado.'","title_link": "'.$sad_link.'","text": "'.$Ds_Descricao.'", "fields":[ {"title":"Último contato de '.$usuario.':", "value":"'.$historico.'"}, {"title":"Teste:", "value":"Teste"}] },]}'
			)
		));		


		// Send the request
		$error_Level = error_reporting();
		error_reporting(0);
		$response = file_get_contents('https://hooks.slack.com/services/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', FALSE, $context);
		error_reporting($error_Level);
		mysql_close($link);
?>
