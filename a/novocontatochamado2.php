<script src="./scripts/dropzone.js"></script><?
require("scripts/funcoes.php");
require("scripts/classes.php");	
require("scripts/conn.php");

	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

$atendimento = FuncoesUsuarioAtendimento($ok);
$historico =  $_POST["historico"];

$ChamadoReabertoAgora = false;

function connAlterarRestricao($IdChamado, $IdUsuario, $IdRestricao, $IcStatus)
{
	/*
		1. Alterar op Status do Flah da restricao no chamado
	*/
	$sql = "update rl_restricao_chamado set Ic_Implementado = not Ic_Implementado where Id_Restricao = $IdRestricao and Id_Chamado = $IdChamado";
	mysql_query($sql);
	
	/*
		2. Inserir o hist�rico das altera��es
	*/
	$DataHoraAtual = date("Y-m-d H:i:s");
	$sql = "insert into restricao_historico (Id_Chamado, Id_Restricao, Id_Usuario, Dt_Data, Ic_Status)
			values ($IdChamado, $IdRestricao, $IdUsuario, '$DataHoraAtual', $IcStatus)";
	mysql_query($sql);

}

if (    ($_POST["action"] == "manter") || ($_POST["action"] == "encaminhar") ) {	


	$restricoesUsuario = funcoesObterRestricaoChamadoUsuario($ok, $chamado_id);

	foreach ($restricoesUsuario as $linha) {
				
		$Id_RestricaoDoUsuario = $linha["id"];		
		$Encontrei = false;		
		
		if (isset($_POST["IdsRestricoes"])) {
			foreach($_POST["IdsRestricoes"] as $IdRestricao) {
				if ($IdRestricao == $Id_RestricaoDoUsuario) 
				{
					$Encontrei = true;
					if ($linha["ok"] == 0)
						connAlterarRestricao($chamado_id, $ok, $IdRestricao, "1");											
				}
			}
		}
		
		if ( (!$Encontrei) && ($linha["ok"] == 1))		
    		connAlterarRestricao($chamado_id, $ok, $linha["id"], "0");		
		
	}

}



// Linha abaixo j� corrige aspas e barra 
//$historico = mysql_real_escape_string($historico, $link);

if ( $_POST["action"] == "cancelar") {
	$sql = "delete from contato_temp where id_chamado = $chamado_id and id_usuario = $ok";
	mysql_query($sql) or die ( mysql_error() + ' - SQL: ' - $sql);
	header("Location: inicio.php");	
	die(""); // coloquie o die aqui pq o PHP n�o interrompeu o programa neste ponto
}


	
if ($action=="contato") {
  // Se for novo contato chama oura pagina
  header("Location: novocontato.php?id_cliente=$cliente_id&id_chamado=$chamado_id&id_ligacao=$id_ligacao&horae=$horae");
} else if ($action=="chamado") {
  header("Location: chamado.php?id_cliente=$cliente_id&id_ligacao=$id_ligacao&horae=$horae");
} else  { //manter




    $datae = date("Y-m-d");
	$dataa = $datae;
	if (!isset($horae)) {
    	$horae = date("H:i:s");
	}

	$objChamado = new chamado();	
	$objContato = new contato();
	
	$objChamado->lerChamado($chamado_id);
	
	$destinatario_atual = $objChamado->destinatario_id;
	$souDono = $destinatario_atual == $id_usuario;	
	$priorantiga = $objChamado->prioridade_id;
	
	$Diagonostigo_Antigo = $objChamado->diagnostico_id;
	$Diagonostigo_Novo = $diagnostico;
	
	$TrocaVersao = "";
	if ($Dt_Relese == '0')
		$Dt_Relese == '';


	if ($prioridade==4){
		
		
		if ( ($action == "manter") || ($action == "encaminhar"))
		{
			if ($publicar)
			{
				$historico = "$historico<br><span style=\"color: #ff0000\"><strong><font size=2><em>Favor responder este chamado no prazo de 3&nbsp;&nbsp;dias, ap�s o que ser� considerado validado e automaticamente encerrado</em></font></strong></span>";  	  	  								
			}
		}
		
		
		if ($objChamado->Dt_EncerramentoAutomatico <> DMA2AMD($Dt_EncerramentoAutomatico))
		{		 	
			$historico = "$historico<br><b>-></b><font color=#666666>Data de encerramento automatico mudou de \"" . AMD2DMA($objChamado->Dt_EncerramentoAutomatico) . "\" para \"<b>$Dt_EncerramentoAutomatico</b>\".</font>";  	  	  				
			$objChamado->Ds_Versao = $Ds_Versao;		
		}
	}




	if ( ($objChamado->Ds_Versao <> $Ds_Versao) && ($Ds_Versao != '') )
	{		
		$historico = "$historico<br><b>-></b><font color=#666666>Vers�o mudou de \"$objChamado->Ds_Versao\" para \"<b>$Ds_Versao</b>\".</font>";  	  	  				
		$objChamado->Ds_Versao = $Ds_Versao;		
	}
	
	if ( ($objChamado->Dt_Release <> $Dt_Release) && ($Dt_Release != '') )
	{
		$historico = "$historico<br><b>-></b><font color=#666666>Data release mudou de \"$objChamado->Dt_Release\" para \"<b>$Dt_Release</b>\".</font>";  	  	  		
		$objChamado->Dt_Release = $Dt_Release;	  	  		
	}
		
	if(($base) && ($base_desc != '')) { // Chamado foi para base de conhecimento
		$_msg = "Contato inserido na base de conhecimento";		
		if ($base_cliente)
		{
			$_msg .= " - BOLETIM";
		}
		$historico = "$historico<br><b>-></b><font color=#666666>$_msg</font>";  	  	  					
	}



	
	if ($priorantiga <> $prioridade) {
		


		
		
		// 7 = Aguardando outro chamado.
		// Insito um link
		if ($prioridade == 7) {
			$_anexo = ": [$idchamadodepende]";
		}
		
	  $objChamado->prioridade_id = $prioridade;
	  $historico = "$historico<br><b>-></b><font color=#666666>Prioridade do chamado mudou de \"" . pegaPrioridade($priorantiga)  . "\" para \"<b>" . pegaPrioridade($prioridade) . $_anexo .  "</b>\".</font>";  	  	  
	}
	
	if (!$idchamadodepende) {
		$idchamadodepende = 0;
	} else {
		$semPontoNemEspaco = str_replace(".", "", $idchamadodepende);
		$semPontoNemEspaco = str_replace(" ", "", $semPontoNemEspaco);		
		$idchamadodepende = $semPontoNemEspaco;
	}
	$objChamado->dependo_de = $idchamadodepende;
	
	if ($priorantiga <> $prioridade) {
		
		if ($prioridade == 7) {  // Aguardando outro chamado
			$Texto = "O chamado <b>$chamado_id</b> foi priorizado como 'Aguardando outro chamado' e est� aguardando o chamado <b>$idchamadodepende</b>, que se encontra em seu desktop.";
			$ch_espera = new chamado();

			$ch_espera->lerChamado($idchamadodepende);
			
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
	}





	$motivoantigo = $objChamado->motivo_id;
	if ($motivoantigo <> $motivo) {
	  $objChamado->motivo_id = $motivo;
	  $historico = "$historico<br><b>-></b><font color=#666666>Motivo do chamado mudou de \"" . pegaMotivo($motivoantigo)  . "\" para \"<b>" . pegaMotivo($motivo)."</b>\".</font>";
	}
   
	if ($diagnostico AND ($diagnostico <> $objChamado->diagnostico_id) ) {
	  $objChamado->diagnostico_id = $diagnostico;
	  $objChamado->Dt_Ultimo_Diagnostico = $datae;
	  $objChamado->Id_Usuario_Diagnostico = $ok;
	  $historico = "$historico<br><b>-></b><font color=#666666>Diagn�stico .: \"<b>" . pegaDiagnostico($diagnostico)."</b>\".</font>";
	}
	
	if ($diagnostico == 3 AND ($diagnostico <> $objChamado->diagnostico_id) ) {
	  require("scripts/email_critico.php");
	}
	
	
	
	
	/* 	
		Aqui atualizamos a data do �ltimo contato, 
		inicialmente apenas se quem inseriu o contato foi o pr�prio dono.
		Agora, precisamos alterar para que se a prioridade era 'aguardando cliente' e mudou para qualquer outro, tamb�m
		deve alterar a data.
		
			From: Marcelo Chinaglia 
			Sent: Wednesday, August 04, 2010 10:37 AM
			To: Fernando Nomellini ; Marcelo Nunes 
			Cc: Ricardo Hudson 
			Subject: Re: COBRAN�A DE ANDAMENTO 3 - Diogo Nogueira			
			
			Isso.. exatamente....  obrigado..
			
			----- Original Message ----- 
				From: Fernando Nomellini 
				To: Marcelo Chinaglia ; Marcelo Nunes 
				Cc: Ricardo Hudson 
				Sent: Wednesday, August 04, 2010 10:35 AM
				Subject: Re: COBRAN�A DE ANDAMENTO 3 - Diogo Nogueira
				
				
				OK, eu posso verificar, quando insere um contato, e mudou de aguardando cliente para outro, ai sim eu considero a data deste contato para in�cio de contagem
			
	*/
	
	$AtualizaDataUltimoContato = $souDono;

	// N�o sou dono E a prioridade era 4 (aguardando cliente) E mudou a prioridade	
	if ( !$souDono and ( ($priorantiga == 4) || ($priorantiga == 9)  ) and ($priorantiga <> $prioridade) ) 
			$AtualizaDataUltimoContato = true;	
			
	// 15.09.2010 - Quando um chamado � reaberto, devo tamb�m atualizar....
	
	
	$objChamado->usuario_id_uc = $id_usuario;
	
	
	$contato = $objContato->novocontato($chamado_id, $id_usuario, $id_usuario, $dataa, $horaa);	
	$objContato->lerContato($contato);		
	
  
  $contato_id = $objContato->id_contato;
  $chamado_id = $objContato->chamado_id;
  $consultor_id = $objChamado->consultor_id;
  
//        
//	
//  $uploadfile = $_FILES['userfile']['name']; 
//  $nome = $uploadfile;        
//  $uploadfile = MakeUploadName($uploadfile,$uploadfile) ;
//  $uploadfile = eregi_replace(" ", "", $uploadfile);
//  $uploadfile = "$contato_id-" .$uploadfile;    
//  $datae = date("Y-m-d");
//  $horae = date("H:i:s");	    
//  $sql = "insert into saduploads (id_consultor, id_chamado, id_contato, nome, nome_original, data) ";
//  $sql .= "values ($consultor_id, $chamado_id, $contato_id, '$uploadfile', '$nome', '$datae $horae')"; 
//  $uploadfile = $uploaddir . $uploadfile;    
//  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
//  	mysql_query($sql);
//	header("Location: historicochamado.php?&id_chamado=$chamado_id#$contato_id");	  
//  } 
//  
//  /*
//  else {
//    print "ERRO NUMERO " . $_FILES['userfile']['error'] . " - $uploadfile - <br>";
//    print "1 e 2 - Arquivo muito grande <br>";	
//    print "3 - Upload feito parcialmente<br>";		
//    print "4 - Nome invalido<br>";			
//  }
//  */



	$objContato->origem_id = $origem;
	$objContato->pessoacontatada = $pessoacontatada;
	
	$objChamado->fl_ProgramaEspecial = 0;	
	if ($Ds_ProgramaEspecial != "")
	{
		$objChamado->fl_ProgramaEspecial = 1;
		$objChamado->Ds_ProgramaEspecial = $Ds_ProgramaEspecial;
	}
	
	
	
	
	if (($origem == 45) ||  ($origem == 46))
	{
		$objChamado->fl_PodeEncerrar = 1; // Permite sim
		$objChamado->Ds_MotivoNaoEncerrar = "";		
	}	
	if ($origem == 44)
	{
		$objChamado->fl_PodeEncerrar = 0; // permite n�o
		$objChamado->Ds_MotivoNaoEncerrar = "Proposta n�o aprovada ou n�o cancelada";
	}	
	

	if ($action == "encaminhar" ) {
      $objContato->destinatario_id = $destinatario;
	} else {
		$objContato->destinatario_id = $id_usuario;
		$objChamado->horalidodestinatario = $horae;
		$objChamado->datalidodestinatario = $datae;
	}
	
    $objChamado->destinatario_id = $objContato->destinatario_id;	  
	$objChamado->remetente_id = $id_usuario;





	  if ( $objChamado->status==1 ) {  // Caso status = encerrado
		$objContato->status_id = 3;    // Status = Reaberto.					
		$objChamado->status = 3;
	  
		
		// Fernando Nomellini - 11/04/2008 -----------------------------------
		$objChamado->reaberto = 1; 	// Indica que este chamado j� foi reaberto										
		// -------------------------------------------------------------------

/*		
		if($pendente) {
		  $objContato->status_id = $pendente;
		  $objChamado->status = $pendente;	
		}
		*/
		 
//		if ($ok == 245)	{				die ( "<h1> $objChamado->status  - $pendente<h1>");		}	
		 
		 
        require("scripts/emailreabertocontato.php"); 	
		$ChamadoReabertoAgora = true;
		
        $objChamado->consultor_id=$id_usuario;		  

	  } else {
		$objContato->status_id = 2;   // Se nao era encerrado
		$objChamado->status = 2;	  // vira aberto
		
		
		/*
		if($pendente) {
		  $objContato->status_id = $pendente;
		  $objChamado->status = $pendente;	
		} 
		*/		
		
      }
	
	if ($action == "encerrar") {	

		// se aberto pelo Cliente, tornar visivel o contato de encerramento
		if ($objChamado->externo) {
			$objContato->visivel=1;      
		}
		
		$objContato->status_id = 1;	  // 1= encerrado
		$objChamado->status = 1;
	} 
	   

	$objContato->datae = $datae;
	$objContato->horae = $horae;	
	

	$objContato->historico = "$historico";



     if ($id_usuario != $objChamado->consultor_id) {
       $objChamado->lidodono = 0; 
     }

	/*
		$publicar - Checkbox na tela, indica de publico ou n�o.
	*/
    if($publicar) {
		$objContato->publicar = 1;
		if ($action!="encerrar") {		
			// Email enviado ao cliente quando um contato � publicado
			require("scripts/emailcliente.php"); 	  
		}
	}
	
	
	if($rnc) {
	  $objContato->rnc = 1;
	  $objChamado->rnc = 1;	  
	}


	$AtualizaDataUltimoContato = $souDono;

	// N�o sou dono E a prioridade era 4 (aguardando cliente) E mudou a prioridade	
	if ( !$souDono and (($priorantiga == 4) || ($priorantiga == 9)) and ($priorantiga <> $prioridade) ) 
			$AtualizaDataUltimoContato = true;	
			
	// 15.09.2010 - Quando um chamado � reaberto, devo tamb�m atualizar....	
	if ($objChamado->reaberto == 1) 
		$AtualizaDataUltimoContato = true;
	
	if ($AtualizaDataUltimoContato) {
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
		
	}		
	
    $objChamado->email = $emailcontatado;
	$objChamado->nomecliente = $pessoacontatada;		


	if ( ($prioridade == 4)||($prioridade == 9) ) {
		$objChamado->Dt_EncerramentoAutomatico = DMA2AMD($Dt_EncerramentoAutomatico);
	} 

	$objChamado->Id_Release = 0;
	if ($prioridade == 8) {
		$objChamado->Id_Release = $Id_Release;
	}
		
    $objChamado->gravaChamado();	
    $objContato->gravaContato();
	
	if ($Ic_ImpedeEncerramentoAutomatico != $objChamado->Ic_ImpedeEncerramentoAutomatico) {
		if ($Ic_ImpedeEncerramentoAutomatico == 1)
			$update = "update chamado set Ic_ImpedeEncerramentoAutomatico = 1 where id_chamado = $chamado_id";	
		else		
			$update = "update chamado set Ic_ImpedeEncerramentoAutomatico = 0 where id_chamado = $chamado_id";								
		mysql_query( $update);					
	}
	
	if ($ChamadoReabertoAgora == true) {
		conn_projetos_EmailReaberto($chamado_id,$objChamado->chamado_pai_id, $ok);	
	}					
	
	
    if ( $action == "encaminhar" ) {  
	   if(!$pessoacontatada) {
         // $objContato->origem_id = 7;	   // Origem = TEncaminhamento Interno
	   }
	   if ($id_usuario != $objChamado->destinatario_id) {
	     $objChamado->lido = 0;
	   } 
       $objChamado->gravaChamado();	
       $objContato->gravaContato();
	   // Email enviado ao destinat�rio do contato
    }


//    require("scripts/email.php");


    /*
	  Envia uma carta padr�o ao cliente indicado
	  o arquivo com a carta padr�o � o _email.txt
	  e o arquivo que deve ser colocado na pagina a ser chamada 
	  � o _email.htm, o arquivo _email.php verifica se o usuario
	  deseja mandar email e o envia caso positivo.
	*/
	
    require("_email.php"); 	
	
	if ($action == "encerrar") {	
		conn_projetos_EmailEncerramento($chamado_id,$objChamado->chamado_pai_id, $ok);
		/* 
			Email enviado ao cliente para todos os chamados encerrados. 
			Mas quem � da administra��o n�o deve enviar email
		*/			
		if ($atendimento==1) {
			require("_EmailChamado.php"); 	
		} 
		else 
		{
			/*
				A N�o ser que explicitamente pediu para publicar.
				Poderia ter colocado toda a l�gica no if acima, mas 
				assim fica mais f�cil entender.
			*/			
		    if($publicar) {
				require("_EmailChamado.php"); 				
			}
		}
		
		/*
		   Devo mandar email se o existem chamados que est�o
		   aguardando a conclus�o deste aqui
		*/
		require("_EmailAguardando.php");
		
		
		// delete from rl_chamado_usuario_ordem where id_chamado = $id_chamado
		conn_Ordenacao_ApagarDoChamado($chamado_id);
	}
		
		
		
	if ($Diagonostigo_Antigo != $Diagonostigo_Novo)
	{	
		$sql = "update chamado set Dt_UltimoDiagnostico = '$Data_Atual', Id_Usuario_Diagnostico = $ok where id_chamado = $chamado_id";
		mysql_query($sql);								
	}
	
	
	if(($base) && ($base_desc != '')) {
		
		$sql = "update chamado set fl_DocumentacaoInternet = 1 where id_chamado = $chamado_id";
		mysql_query($sql);		
		
		
		$somenteDesenvolvimento = 1;
		if (!$base_cliente) {
			$base_cliente = "0"; // Base cliente = documenta��o web, vai para o boletim.
		} else {
			$somenteDesenvolvimento = 0;	   
		}
		$versao = pegaversao($sistema_id, $cliente_id);
	  
		$base_programa = mysql_real_escape_string ($base_programa);
		$base_desc = mysql_real_escape_string ($base_desc);
		$historico = mysql_real_escape_string ($historico);
		$versao = mysql_real_escape_string ($versao);
	  
		$SQL = "insert into baseweb (id_sistema, id_usuario, id_diagnostico, id_chamado, programa, data, hora, descricao, resumo, versao, cliente, somenteDesenvolvimento, id_contato) ";
		$SQL .= "VALUES ($sistema_id, $id_usuario, $diagnostico, $chamado_id, '$base_programa', '$datae', '$horae', '$base_desc', '$historico', '$versao', $base_cliente, $somenteDesenvolvimento, $contato_id);";
		mysql_query($SQL) or DIE ("<br><b>Erro no sql</b> : $SQL");
	}
	
	/*
	 Isto aqui torna o consultor dispon�vel se o consultor est� com estado ATENDENDO	 	 
	*/
	// TODO: 28.05.2010 - Necessidade de alterar o status apenas se o chamado a ser encerrado for o mesmo
	// da liga��o que foi recebida.
	
	// Chamado 235.637 - O consultor ser� respons�vel por mudar seu Status.
	//$sql = "update usuario set estado = 1 where id_usuario = $ok and estado = 4";
	//mysql_query($sql);		
		
	if ($id_ligacao) {
		$sql = "update satligacao set id_chamado = $chamado_id where id = $id_ligacao";
		mysql_query($sql);
	}			  

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
			$sql .= "values ($consultor_id, $chamado_id, $contato_id, '$uploadfile', '$nome', '$datae $horae')"; 
			$uploadfile = $uploaddir . $uploadfile;    
			move_uploaded_file( $file['tmp_name'], $uploadfile) ;
			mysql_query($sql) or die (mysql_error() . " <br> " . $sql);
		}
	}	
  	
    require("scripts/email.php");
	
	conn_ExcluiControleNovoContato($chamado_id, $ok);

		
	if ($anexar == 1)
		header("Location: historicochamado.php?&id_chamado=$chamado_id&anexo=true#c_ultimo");
	else
		header("Location: inicio.php");


}
  
	function MakeUploadName($pagename,$x) {
		$x = preg_replace('/[^-\\w. ]/', '', $x);
		$x = preg_replace('/^[^[:alnum:]]+/', '', $x);
		return preg_replace('/[^[:alnum:]]+$/', '', $x);
	}
	


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

?>