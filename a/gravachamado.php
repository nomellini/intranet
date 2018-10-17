<?
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	require("scripts/conn.php");
	require("scripts/funcoes.php");
	require("scripts/classes.php");
	require("scripts/chamado_pesquisa.php");

	require("slack.php");

	if ($action == "cancelar") {
		$sql = "delete from chamado where id_chamado = $id_chamado";
		mysql_query($sql) or die (mysql_error() . " <br> " . $sql);

		$sql = "delete from contato where chamado_id = $id_chamado";
		mysql_query($sql)  or die (mysql_error() . " <br> " . $sql);

		header("Location: inicio.php");
	}

	if (isset($idchamadodepende)) {
		$semPontoNemEspaco = str_replace(".", "", $idchamadodepende);
		$semPontoNemEspaco = str_replace(" ", "", $semPontoNemEspaco);
		$espera = $semPontoNemEspaco;
	} else {
		$espera = 0;
	}

	$fl_PodeEncerrar = 1; //padr�o = permite enderrar<br />
	$Ds_MotivoNaoEncerrar = "";
	if ($origem == 44) // Proposta envio
	{
		$fl_PodeEncerrar = 0; // N�o permite
		$Ds_MotivoNaoEncerrar = "Proposta n�o aprovada ou n�o cancelada";
	}

	$ok = $id_usuario;
	$atendimento = FuncoesUsuarioAtendimento($id_usuario);

    $datae = date("Y-m-d");
    $horae = date("H:i:s");

    loga_novoChamado($ok, $id_chamado);


/*	foreach($id_restricao as $IdRestricao)
	{
		$sql = "insert into rl_restricao_chamado (Id_Restricao, Id_Chamado) values ($IdRestricao, $id_chamado)";
		mysql_query($sql);
	}*/



	$objChamado = new chamado();
	$objContato = new contato();




	$objChamado->lerChamado($id_chamado);


	/**********************************************************************************
		Contato autom�tico inserido pelo sistema (P�blico)

		07/10/2009 - Chamado 186.230
 		Cria��o do contato padr�o para o chamado, pois todo chamado dever� ser OnLine !

		N�o deve ser gerado com cliente DATAMACE, e se Sistema = (Qualidade = 1024)
	 **********************************************************************************/


			// Contato somente se for encaminhar ou manter pendente
			// Novo Contato

  			// function novoContato( $chamadoId, $consultorId, $destinatarioId, $data, $hora)

			$GeraCobranca = 0;
			if ( ($atendimento==1) & ($cliente_id != 'DATAMACE') & ($sistema != 1024)  ) {
//				if (true) {

				$GeraCobranca = 1;


				$id_contato_cliente = $objContato->novocontato(
					$id_chamado, $id_usuario, $id_usuario, $objChamado->dataa, '00:00:00');
				$objContato->lerContato($id_contato_cliente);
				$objContato->origem_id = $origem;
				$objContato->pessoacontatada = $pessoacontatada;
				$objChamado->nomecliente = $pessoacontatada;
				$objContato->publicar = 1;
				$objContato->status_id = 2;
				$objContato->datae = $objChamado->dataa;
				$objContato->horae = '00:00:00';
				$frasepadrao = "Registro de novo chamado";
				$frasepadrao = eregi_replace("\"", "`", $frasepadrao);
				$frasepadrao = eregi_replace("'", "`", $frasepadrao);
				$objContato->historico = "$frasepadrao";
				$objContato->gravaContato();
				$Empresa = pegacliente($objChamado->cliente_id);
				$SistemaCategoria = pegaSistemaCategoria($categoria);


	if ($action == "encerrar") {
				$msg = "<style type=\"text/css\">
<!--
.style1 {color: #CCCCCC}
-->
</style>
<body>
<p>Caro(a) <strong>$objChamado->nomecliente</strong> - $Empresa</p>
<p>Um chamado foi aberto em seu nome pela Consultoria Datamace</p>
<p>O chamado foi considerado solucionado e encerrado no primeiro contato pela consultoria, caso voc� queira reabrir o chamado, acesse o Portal do cliente <a href=\"https://www.datamace.com.br/PortalCliente\">clicando aqui</a>
<br><br>
C&oacute;digo: <strong>$id_chamado</strong><br>
Abertura :  $objChamado->dataaf - $objChamado->horaa</p>
Sistema / Categoria :<b>$SistemaCategoria</b><br />
<p class=\"style1\">Consultoria Datamace</p>
</body>
</html>";
				$subject = "Chamado $objChamado->id_chamado - Abertura/Encerramento";
	}
	else
	{
				$msg = "<style type=\"text/css\">
<!--
.style1 {color: #CCCCCC}
-->
</style>
<body>
<p>Caro(a) <strong>$objChamado->nomecliente</strong> - $Empresa</p>

<p>Para agilizar o atendimento às suas solicitações comunicamos a abertura do chamado em seu nome pela Consultoria Datamace.</p>


<p>A partir desse momento ele é conhecido pelo código: <strong>$id_chamado</strong> - Abertura : $objChamado->dataaf - $objChamado->horaa<br>
Sistema / Categoria :<b>$SistemaCategoria</b><br />
Descrição : <b>$descricao</b>
<br />
Caso você queira interagir no chamado ou&nbsp;saber&nbsp;sobre o andamento, acesse o Portal do cliente <a href=\"https://www.datamace.com.br/PortalCliente\">clicando aqui</a>
<br>
<br>
<p>O SAD \"Sistema de Atendimento Datamace\", é um serviço de suporte no qual nossos clientes tem acesso através da web a um atendimento de qualidade, mais ágil e personalizado.</p>

<br />

<p class=\"style1\">Consultoria Datamace</p>

</body>
</html>";
				$subject = "Chamado $objChamado->id_chamado - Abertura";
	}

				$recipient = "$emailcontatado";
				$headers = "Suporte Datamace";

				//$recipient = "fernando.nomellini@datamace.com.br";
				mail2($recipient, $subject, $msg, $headers);
				//mail2("fernando.nomellini@datamace.com.br", $subject . "<br>" . $recipient, $msg, $headers);

	}

	/****************************************************************
		Contato do Consultor
	 ****************************************************************/


	/*
	 O Chamado j� foi criado no in�cio da p�gina chamado.php
	 Ao criar o chamado, j� foi definido o dono do chamado, as linhas
	 abaixo apenas le os dados gravados do chamado.
	*/


	$id_contato =  $objContato->novocontato(
		$id_chamado, $id_usuario, $id_usuario, $dataAbertura, $horaAbertura);

	$objContato->lerContato($id_contato);

    $sistema_id = $sistema;
	$objChamado->sistema_id = $sistema;
	$objChamado->categoria_id = $categoria;
	$objChamado->prioridade_id = $prioridade;
	$objChamado->motivo_id = $motivo;
	$objChamado->datauc = $datae;
    $objChamado->horauc = $horae;
	$objChamado->descricao = "$descricao";
	$objChamado->email = $emailcontatado;
	$objChamado->nomecliente = $pessoacontatada;
	$objChamado->fl_PodeEncerrar = $fl_PodeEncerrar;
	$objChamado->Ds_MotivoNaoEncerrar = $Ds_MotivoNaoEncerrar;
	$objChamado->Ds_Versao = $Ds_Versao;
	$objChamado->Dt_Release = $Dt_Release;



	if ($prioridade == 4) { // Aguardando cliente
		$objChamado->Fl_EncerramentoAutomatico = 1;
		$objChamado->Dt_EncerramentoAutomatico = DMA2AMD($Dt_EncerramentoAutomatico);
	}


	$objContato->origem_id = $origem;
	$objContato->pessoacontatada = $pessoacontatada;



 	if ($GeraCobranca == 1) {
		$limite1 = SomaDiasUteis($datae, 3);
		$limite2 = SomaDiasUteis($limite1, 1);
		$limite3 = SomaDiasUteis($limite2, 1);
		$limite4 = SomaDiasUteis($limite3, 1);
		$objChamado->limite1 = $limite1;
		$objChamado->limite2 = $limite2;
		$objChamado->limite3 = $limite3;
		$objChamado->limite4 = $limite4;
	}




	if ($action == "encerrar") {
      $objContato->status_id = 1;
	  $objChamado->status = 1;
	} else {
      $objContato->status_id = 2;
	  $objChamado->status = 2;
	}


	if ($action == "encaminhar" ) {

		$objContato->destinatario_id = $destinatario;
		$SlackUser = funcoes_slackUser($destinatario);
		if ($SlackUser != "")
			slack_publish($SlackUser, $id_chamado, $objChamado->descricao, $objChamado->cliente_id);
		$objChamado->lido = 0;

		if($ic_dono) {
			$objChamado->consultor_id = $destinatario;
		}


	} else {
      $objContato->destinatario_id = $id_usuario;
	}
    $objChamado->destinatario_id = $objContato->destinatario_id;

	$objContato->datae = $datae;
	$objContato->horae = $horae;
	$objContato->historico = "$historico";

	if ($diagnostico) {
	  $objChamado->diagnostico_id = $diagnostico;
	  $historico = "$historico<br><b>-></b><font color=#666666>Diagn�stico : \"<b>" . pegaDiagnostico($diagnostico)."</b>\".</font>";
	}

	if($rnc) {
	  $objContato->rnc = 1;
	  $objChamado->rnc = 1;
	}


	$objContato->Ic_Atencao = 0;



	if ($prioridade == 7) {  // Aguardando outro chamado
		$Texto = "O chamado rec�m criado <b>$id_chamado</b> foi priorizado como 'Aguardando outro chamado' e est� aguardando o chamado <b>$espera</b>, que se encontra em seu desktop.";
		$ch_espera = new chamado();
		$ch_espera->lerChamado($espera);
		$id_destinatario = $ch_espera->destinatario_id;
		$email_Remetente = PegaEmailUsuario($objChamado->consultor_id);
		$nome_Remetente = peganomeusuario($objChamado->consultor_id);
		$email_Destinatario = PegaEmailUsuario($id_destinatario);
		$ReplyTo = "$email_Remetente:$nome_Remetente [Via SAD]";
		$recipient = "$email_Destinatario";
		$subject = "Chamado com depend�ncia";
		$headers = "$nome_Remetente [Via SAD]". "+" . $ReplyTo;
		mail2($recipient, $subject, $Texto, $headers);
	}



	/*
		Ap�s atribuir a classe, gravo o chamado e o contato.
		Falta criar o contato online, caso cliente seja <> Datamace.
	*/
	$objChamado->dependo_de = $espera;

    $objChamado->gravaChamado();
	$objContato->gravaContato();


	$chamado_id = $objChamado->id_chamado;
	$contato_id = $objContato->id_contato;
	$_pesquise = ($origem == 1)|| ($origem == 14) || ($origem == 17);
	if ($_pesquise)
		CriarPesquisa($chamado_id, $contato_id, $emailcontatado);



	if ( $id_projeto_pai != 0 ) {
		$update = "update chamado set chamado_pai_motivo = 'P', chamado_pai_id = $id_projeto_pai where id_chamado = $id_chamado";
		mysql_query($update) or die (mysql_error() . " <br> " . $update);



    	conn_projetos_EmailInclusao($id_chamado, $id_projeto_pai, $ok);
	}


	if ($Ic_ImpedeEncerramentoAutomatico == 1)
	{
		$update = "update chamado set Ic_ImpedeEncerramentoAutomatico = 1 where id_chamado = $id_chamado";
		mysql_query( $update) or die (mysql_error() . " <br> " . $update);
	}

//	$sql = "update chamado set fl_PodeEncerrar=$fl_PodeEncerrar, Ds_MotivoNaoEncerrar = '$Ds_MotivoNaoEncerrar'  where id_chamado = $id_chamado";
//	mysql_query($sql);

	if ($diagnostico == 3) {
	  require("scripts/email_critico.php");
	}

   if ( $action == "encaminhar" ) {
     require("scripts/email.php");
   }

	$contato = "Descri��o do chamado: $descricao <br><br>Contato: $historico";
	$mensagem = "$nome abriu um chamado :<br><a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a> que Cont�m uma um mais palavra chave cadastrada";
	loga_email_PalavraChave($id_usuario, $id_chamado, $mensagem, $contato);


	if(($base) && ($base_desc != '')) { // Chamado foi para base de conhecimento

		$_msg = "Contato inserido na base de conhecimento";
		if ($base_cliente)
		{
			$_msg .= " - BOLETIM";
		}
		$_msg .= "<br>Programa: $base_programa";
		$_msg .= "<br>Descri��o: $base_desc";
		$historico = "$historico<br><hr size=1px><font color=#666666>$_msg</font>";

      $somenteDesenvolvimento = 1;
	  if (!$base_cliente) {
	    $base_cliente = "0";
		$somenteDesenvolvimento = 0;
	  }
	  $versao = pegaversao($sistema_id, $cliente_id);
	  $_historico = mysql_real_escape_string($historico, $link);
	  $SQL = "insert into baseweb (id_sistema, id_usuario, id_diagnostico, id_chamado, programa, data, hora, descricao, resumo, versao, cliente, somenteDesenvolvimento) ";
	  $SQL .= "VALUES ($sistema_id, $id_usuario, $diagnostico, $id_chamado, '$base_programa', '$datae', '$horae', '$base_desc', '$_historico', '$versao', $base_cliente, $somenteDesenvolvimento);";
      mysql_query($SQL) or DIE ( mysql_error() . " - GravaChamado Linha 98 ");
	}



	/*
	 Isto aqui torna o consultor dispon�vel se o consultor est� com estado ATENDENDO
	*/
	// COMENTADO.... VER CHAMADO 235.637
    // $sql = "update usuario set estado = 1 where id_usuario = $id_usuario";
	//$sql = "update usuario set estado = 1 where id_usuario = $ok";
	//mysql_query($sql);

    /*
	  Envia uma carta padr�o caso seja detectada necessidade de treinamento !!

	  o arquivo com a carta padr�o � o _email.txt
	  e o arquivo que deve ser colocado na pagina a ser chamada
	  � o _email.htm, o arquivo _email.php verifica se o usuario
	  deseja mandar email e o envia caso positivo.
	  Este c�digo � repetido em gravachamado.php

	  PS. Esta funcionalidade n�o mais envia email ao cliente, e sim para
	  usuarios do sad cujo flag recebeemailtreinamento seja = 1, e normalmente
	  e o pessoal da �rea de treinamento.
	*/
	$chamado_id = $id_chamado;
    require("_email.php");




	/*
		Rotina abaixo inclui o contato (Pessoa contatada + Email) na lista
		de pessoas para contato da empresa.
	*/
	if ( $emailcontatado != '' ) {

		$sql = "select count(*) as qtde from pessoa where cliente_id = '$cliente_id' and	email = '$emailcontatado'";
		$result = mysql_query($sql) or die (mysql_error() . " <br> " . $sql);;
		$linha = mysql_fetch_object($result);
		$qtde = $linha->qtde;
		mysql_free_result($result);

		if ($qtde == 0) {
		  $sql = "insert into pessoa (cliente_id, nome, email) values ('$cliente_id', '$pessoacontatada', '$emailcontatado')";
		  mysql_query($sql) or die (mysql_error() . " <br> " . $sql);
		}

	}

  $contato_id = $id_contato;



	fixFilesArray($_FILES['userfile']);


	$uploaddir = "/dados/ftp/sites/sad/htdocs/public_html/uploads/";

	foreach ($_FILES['userfile'] as $position => $file)
    {
		$uploadfile = $file['name'];
		if ($uploadfile) {
			$nome = $uploadfile;
			$uploadfile = MakeUploadName($uploadfile,$uploadfile) ;
			$uploadfile = eregi_replace(" ", "", $uploadfile);
			$uploadfile = "$contato_id-" .$uploadfile;
			$datae = date("Y-m-d");
			$horae = date("H:i:s");
			$sql = "insert into saduploads (id_consultor, id_chamado, id_contato, nome, nome_original, data) ";
			$sql .= "values ($id_usuario, $chamado_id, $contato_id, '$uploadfile', '$nome', '$datae $horae')";
			$uploadfile = $uploaddir . $uploadfile;
			move_uploaded_file( $file['tmp_name'], $uploadfile) ;
			mysql_query($sql) or die (mysql_error() . " <br> " . $sql);
		}
	}

  function MakeUploadName($pagename,$x) {
    $x = preg_replace('/[^-\\w. ]/', '', $x);
    $x = preg_replace('/^[^[:alnum:]]+/', '', $x);
    return preg_replace('/[^[:alnum:]]+$/', '', $x);
  }





	if ($anexar == 1)
		header("Location: historicochamado.php?&id_chamado=$id_chamado&anexo=true#c_ultimo");
	else if ($lembrete == 1)
		header("Location: inicio.php?&id_chamado=$id_chamado&lembrete=true");
	else
		header("Location: inicio.php");






	function fixFilesArray(&$files)
	{
		$names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

		foreach ($files as $key => $part) {
			// only deal with valid keys and multiple files
			$key = (string) $key;
			if (isset($names[$key]) && is_array($part)) {
				foreach ($part as $position => $value) {
					$files[$position][$key] = $value;
				}
				// remove old key reference
				unset($files[$key]);
			}
		}
	}


/*

		$objChamado->datauc = $datae;
    	$objChamado->horauc = $horaa;

		$limite1 = SomaDiasUteis($datae, 3);
		$limite2 = SomaDiasUteis($limite1, 1);
		$limite3 = SomaDiasUteis($limite2, 1);
		$limite4 = SomaDiasUteis($limite3, 1);

		$objChamado->limite1 = $limite1;
		$objChamado->limite2 = $limite2;
		$objChamado->limite3 = $limite3;
		$objChamado->limite4 = $limite4;

*/

?>




