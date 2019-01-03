<?

	require_once("cabeca.php");
	require_once("scripts/classes.php");	

		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	

	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	$EncerraAutomatico = $objChamado->prioridade_id==4;
	$Ic_ImpedeEncerramentoAutomatico = $objChamado->Ic_ImpedeEncerramentoAutomatico;

	
	$SqlProjetoPendente = "select count(1) qtde from chamado c1 where chamado_pai_id = $id_chamado and (status = 2 or status = 3) and Chamado_pai_motivo = 'P'";
	$QtdeProjetoPendente = conn_ExecuteScalar($SqlProjetoPendente);
	$ProjetoPendente = $QtdeProjetoPendente > 0;
	

	$Dt_EncerramentoAutomatico = AMD2DMA(obterDataEncerramento());		
	$Ds_Versao = $objChamado->Ds_Versao;
	$Dt_Release = $objChamado->Dt_Release;	
	$fl_PodeEncerrar = $objChamado->fl_PodeEncerrar;
	$Ds_MotivoNaoEncerrar = $objChamado->Ds_MotivoNaoEncerrar;	
	$fl_ProgramaEspecial = $objChamado->fl_ProgramaEspecial;
	$Ds_ProgramaEspecial = $objChamado->Ds_ProgramaEspecial;
	$id_cliente = $objChamado->cliente_id;
	
	if ($ProjetoPendente) {
		$fl_PodeEncerrar = false;
		$Ds_MotivoNaoEncerrar = "Este projeto tem $QtdeProjetoPendente chamados pendentes e não pode ser encerrado";
	}

    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$cliente = strtoupper($tmp["cliente"]);
	$grau = $tmp["grau"];
	$grau = $grau == "ZZ" ? ""  : "[$grau]";
	$cliente = "$cliente $grau";


    // Banco de dados, tabela origem - Id = 20
    define(ORIGEM_ENCERRAMENTO_DE_CHAMADO, 20);  	
    define(ORIGEM_OUTROS, 11);  		
	
	/*
		Flags indicativos de gerente e gestor.	
	*/
    $gerente = pegaGerente($ok);	
    $gestor = pegaGestor($ok);		
    
	
	// 13.03.2003 Permite definir como RNC somente se cliente for DATAMCE
	$rnc = strpos( $cliente, "ATAMACE", 0);
	
	
	$telefone = $tmp["telefone"];
	$id_cliente = $tmp["id_cliente"];
	
    list($tmp1, $chamado) = each(pegaChamado($id_chamado));
	$encaminhado = $chamado["encaminhado"];
	$chStatus = $chamado["status_id"];
    $chDestinatario = $chamado["destinatario_id"];
	$chConsultor = $chamado["consultor_id"];
	$externo = $chamado["externo"];
	
	$DocumentacaoInternet = $chamado["fl_DocumentacaoInternet"];

	
    $contatos = historicoChamado($id_chamado, 'desc');
    $UltimoContato =count($contatos);
	$Ccontador = $UltimoContato + 1;
	$ContatoAtual = $Ccontador;
	$NumeroDoContatoAtual = sprintf("%03d", $Ccontador);
		
    $total_pendentes = count($chamadosemaberto);

	
	
	
	$espero = $objChamado->dependo_de;
	if (!$espero) {
		$espero = "";
	}
	
	$QtdeDependentes = conn_TemChamadosAguardando($id_chamado);
	
	$sistema_id = $objChamado->sistema;	
	$SistemaNome = pegaSistema($sistema_id);
	$LinkGrhNet = obterLinkGrhNetTeste($SistemaNome);

	
	$status = pegaStatus( $objChamado->status );
	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}	

	$god = conn_IsGod($ok);
	
    list($tmp1, $tmp) = each(pegaUsuario($objChamado->destinatario_id));
	$destinatario = $tmp["nome"];
    $superiord_id = $tmp["superior_id"];
	
    list($tmp1, $tmp) = each(pegaUsuario($objChamado->consultor_id));
	$AbertoPor = $tmp["nome"];
    $superior_id = $tmp["superior_id"];
	
	
	$Id_Usuario_Remetente = $objChamado->remetente_id;
	$Id_Usuario_Logado = $ok;
		
    list($tmp1, $tmp) = each(pegaUsuario($Id_Usuario_Remetente));
	$Remetente = $tmp["nome"];
		
    if
	(
	   ($id_usuario == $objChamado->destinatario_id ) or
	   ($id_usuario == $superiord_id)
	)
	{
      $chManter = 0; 
    } else {
      $chManter = 1;
    }		


	/*
    if (
	      ( ($id_usuario == $superior_id) or 
		    ($id_usuario == $objChamado->consultor_id ) 
		  )  and (
		     $id_usuario == $objChamado->destinatario_id 
		  ) 
	   )
	 {
         $chEncaminhado = 0;  //Posso encerrar
	 } else {
         $chEncaminhado = 1; //Nao posso
	 }
	 */
	 
	 
	 $PodeEncerrarQualquerChamado = $god; ;//($ok==12  || $ok==141 || $ok == 54);
	 
     $chEncaminhado = 1; //Nao posso encerrar, pois é um chamado encaminhado	 	 
	 
	 
	 
	 if ( ($id_usuario == $objChamado->destinatario_id ) and ($id_usuario == $objChamado->consultor_id ) )	 
	    $chEncaminhado = 0;  //Posso encerrar se sou o destinatário	e dono do chamado
	 else if ( ($id_usuario == $superior_id) and ( $objChamado->consultor_id == $objChamado->destinatario_id ))
	    $chEncaminhado = 0;  //Posso encerrar se sou o superior do dono do chamado e o chamado está com quem o abriu
	 else if ( ($id_usuario == $superior_id) and ( $id_usuario == $objChamado->destinatario_id ))
	    $chEncaminhado = 0;  //Posso encerrar se sou o superior do dono do chamado e o chamado está com o superior
	 else if ( ($id_usuario == $superior_id) and ( $id_usuario == conn_obterSuperior($objChamado->destinatario_id)) )
	    $chEncaminhado = 0;  //Posso encerrar se sou o superior do dono do chamado e o chamado está com um subordinado meu
	 else if ( ($id_usuario == $objChamado->consultor_id) and ( $id_usuario == conn_obterSuperior($objChamado->destinatario_id)) )	
	    $chEncaminhado = 0;  //Posso encerrar se sou o  dono do chamado e o chamado está com um subordinado meu	 
	 else  if ($PodeEncerrarQualquerChamado) 
    	 $chEncaminhado = 0; // Indica quem pode encerrar qualquer chamado
	 
	 	 
	   
	 if ($chStatus ==1 ) {
	   $chEncaminhado = 0;
	   $chManter = 0;
	 }



	if ($id_ligacao) {
		$sql = "update satligacao set id_chamado = $id_chamado where id = $id_ligacao";
		mysql_query($sql);
	}		
	
	 
	 // Armazeno em uma tabela temporária a data e hora da abertura do novo contato para este funcionario	
	if (!isset($horae)) {
		$horae = date("H:i:s");
	}
	$Hora_Novo_Contato = $horae;
	$Hora_Inicio_Leitura = $horae;
	$Hora_Atual = date("H:i:s");
	$Data_Novo_Contato = date("Y-m-d");
	$Texto_Novo_Contato = "";
	$Id_Usuario = $ok;
	$resultado = conn_InsereControleNovoContato($id_chamado, $Id_Usuario, $Data_Novo_Contato, $Hora_Novo_Contato);	 
	if ($resultado["status"] == 0) 
	{
		$Texto_Novo_Contato = $resultado["contato"];
			
		if ($Data_Novo_Contato == $resultado["data"]) {		   

			// Se houver texto gravado, mantenho a hora do texto gravado.		
			//if ($Texto_Novo_Contato != "") {			
				$Hora_Novo_Contato = $resultado["hora"];      
			//}
			
		}

	}	 

  	$restricoes = funcoesObterStatusRestricao($id_chamado);

	
	$projeto_desc = FuncoesObterDescricaoChamadoPai( $id_chamado );			
	$Usuario_Area = funcoes_obterArea($ok); // 1 = consultoria.	
	
	$ver_chamado_checked = "";
	$ver_chamado = conn_ExecuteScalar("select Ic_VerChamado from mydesktop where id_usuario = $ok");
	if ($ver_chamado) {
		$ver_chamado_checked = "checked='checked'";
	}
	
    loga_online($ok, $REMOTE_ADDR, 'Novo Contato : ' . $id_cliente . " :  " . $id_chamado);
	
	loga_novoContato($ok, $id_chamado) ;
	
	
	$ClienteDatacenter = '';
	$ClienteIntersystem = '';
	$sql = "select Ic_Intersystem, Ic_Datacenter, Ic_SLA, Ic_PosVenda from clienteplus where id_cliente = '$id_cliente'";		
	$result = mysql_query($sql) ;	
	$linha=mysql_fetch_object($result);
	$ClienteIntersystem = $linha->Ic_Intersystem ? "<BR/><BR/><B><FONT COLOR=ff0000>INTERSYSTEM SERVIÇOS</font></b><BR/>" : "" ;	
	$ClienteDatacenter = $linha->Ic_Datacenter ? "<BR/><B><FONT COLOR=ff0000>---> USA DATACENTER <---</font></b><BR/>" : "" ;
	$inter = $linha->Ic_Intersystem == 1;	
	$ClienteSLA = '';
	$ClienteSLA = $linha->Ic_SLA ? "<BR/><B><FONT COLOR=ff00000>---> cliente com SLA diferenciado: 348640  <---</font></b><BR/>" : "" ;
	$ClientePosVenda = '';
	$ClientePosVenda = $linha->Ic_PosVenda ? "<BR/><B><FONT COLOR=ff00000>---> ! PÓS VENDA ! <---</font></b><BR/>" : "" ;	
	
	$tem_documentacao = conn_temDocumentacao($id_chamado);	
	$JaFoiParaBase = connChamadoJaEstaNaBaseWeb($id_chamado);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/formataData.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<script type="text/javascript" >	
 $(function() {
  var fieldCount = 0;
  $("#addFieldButton").click(function() {
   fieldCount++;
   if(fieldCount <= 50)
   {    
    var fieldID = "recipient_email_" + fieldCount;
    $("#additionalEmails").append("<input id = "+fieldID+" type='file' name='userfile[]' class='borda_fina' size='50' multiple='multiple'><br />" );	
	$("#"+fieldID).hide().fadeIn("slow");
   }
   else
   {
    alert("Maximum email fields reached.");
   }
  });
 });
</script>

    <script>
		function AdicionarAjuda() {
			
			$.ajax({
				method: "POST",
				url: "InsereFilaRetaguarda.php",
				data: { IdConsultor: "<?=$ok?>",  IdChamado: "<?=$id_chamado?>"} 
			}).done(function() {
				$('#ajuda').html("Ajuda Solicitada");
				$("#btnAjuda").prop('disabled', 'true');
			});
			

		}
	</script>  

<script src="coolbuttons.js"></script>

<script>
	//carrega a function divFlutua na página
	$(document).ready(function () { divFlutua(); });
	//executa o a function divFlutua sempre que a página é rolada
	$(document).scroll(function () { divFlutua(); });
	//function responsavel por fazer a div flutuar na pagina
	function divFlutua() {
		// aplica animação na div toda fez que o scroll da janela é usado
		$(window).scroll(function () {
			$(".flutua").css('margin-top', $(window).scrollTop()-13);
		});
	}
</script>

<style>
	.flutua {
		position: absolute;
		width:100%;
		float: left;
	}
</style>

<html>
<head>
<title>Hist&oacute;rico</title>
	

    <meta charset="utf-8">    


    
    

<link rel="stylesheet" href="stilos.css" type="text/css">

<style type="text/css">
<!--
.dragTest {
			background-color:#e0f0e0;
			width: 85px;
			text-align:center;
			float:left;
		}
#drag_me{
    -webkit-user-drag: element;
}


.style1 {
	color: #FF0000;
	font-weight: bold;
}
.style2 {
	font-size: 10;
	font-weight: bold;
}
-->
</style>
<link href="attendere.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<div class="flutua"><br>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td class="coolButton"><a href="inicio.php" target="_blank"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">Desktop</a></td>
    <td class="coolButton"><a href="/agenda/" target="_blank">Agenda</a></td>
    <td class="coolButton"><a href="../index.php" target="_blank">Intranet</a></td>
  </tr>
</table>
</div>
<br>
<br>
<br>

<hr size="1" noshade="noshade">
<div align="center"> 
  <table width="98%" border="0">
    <tr> 
      <td width="48%"><font size="2">Sistema de Atendimento Datamace</font></td>
      <td width="52%"> 
        <div align="right"><font size="2">Usu&aacute;rio <font color="#FF0000">:<b> 
          <?=$nomeusuario?>
          </b></font></font></div>
      </td>
    </tr>
  </table>
  <table width="98%" border="0" bgcolor="#000000" cellpadding="1" cellspacing="1">
    <tr bgcolor="#FCE9BC"> 
      <td width="12%" valign="middle" align="center"><font size="2">Chamado </font></td>
      <td width="11%" valign="middle" align="center"> <font size="2">Data </font></td>
      <td width="13%" valign="middle" align="center"><font size="2">Hora</font></td>
      <td width="53%"> <font size="2">Cliente </font></td>
      <td width="11%"> 
        <div align="center"><font size="2">Status</font></div>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="12%" align="center"> 
        <div align="center"><font color="#FF0000"><b><font size="3"> 
          <?=$id_chamado?>
          </font></b></font></div>
      </td>
      <td width="11%" align="center"> 
        <div align="center"> 
          <?=$objChamado->dataaf?>
        </div>
      </td>
      <td width="13%" align="center"> 
        <div align="center"> 
          <?=$objChamado->horaa?>
        </div>
      </td>
      <td width="53%" valign="top"> <font color="#FF0000"><b><font size="3"> 
        <?="$cliente<br>$telefone"?>
        </font></b></font> </td>
      <td width="11%"> 
        <div align="center"><b><font size="3"> 
          <?=$status?>
          </font></b></div>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="5"> 
        <p><font size="3"><i>&nbsp;Descri&ccedil;&atilde;o</i></font></p>
        <blockquote> 
          <p><font size="3"><font color="#0000FF"> 
<?		  
	$descricao = $chamado["descricao"];
	$descricao = eregi_replace("\r\n", "<br>",$descricao);
	$descricao = eregi_replace("\"", "`", $descricao);	
	
	$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
	$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\,)([\s])?([0]{0,3})([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4#c_$8" target="_blank">$2$3$4 [$7$8]</a>', $descricao);											    
?>			
		  
            <?=$descricao?>
            <?= $projeto_desc; ?>
            <br>
            </font></font></p>
        </blockquote>
      </td>
    </tr>
  </table>
</div>
<p align="center"><a name="Inicio"></a>NOVO CONTATO - Contatos Estabelecidos - <a href="#Contato">[Clique para pular para o fim</a>]</p>

<? $NovoContato = true; ?>
<? include("_historicochamadoPartial.php"); ?>

 <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center">
 <tr>
<form action="historico.php" method="post" name="formx" target="_blank" id="formx">
 <td>

                <input type="hidden" name="action2">
                Digite o n&uacute;mero de um chamado ou Cliente para abrir em outra janela. 
                <font color="#0000FF"><b>
                  <input name="id_cliente" type="text" class="borda_fina" id="id_cliente" title="Digite o n&uacute;mero do chamado ou o cliente e tecle enter">
                  </b>
                  <input name="hist" type="submit" class="borda_fina" id="hist" title="Digite o n&uacute;mero do chamado ou do cliente na caixa de texto ao lado." value="Ver hist&oacute;rico" >
        </font></div>
</td>
            </form>
</tr>
</table>
<form name="form" enctype="multipart/form-data" method="post" action="novocontatochamado.php" >
  <input type="hidden" name="chamado_id" value="<?=$id_chamado?>">
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
  <input type="hidden" name="id_ligacao" value="<?=$id_ligacao?>">  
  <input type="hidden" name="action">
  <input type="hidden" name="horaa" value="<?=$Hora_Novo_Contato?>">
  <input type="hidden" name="destinatario" value="0">
  <input type="hidden" name="sistema_id" value="<?=$sistema_id?>">

  <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center" id="conteudo">
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <div align="center"> 
          <p><a name="Contato"></a>Novo Contato [<a href="#Inicio">navegar para o inicio</a>]<br>
          </p>
        </div>
        <table width="98%" border="0" align="center">
          <tr valign="bottom">
            <td height="2" colspan="3"><strong>HORA INICIO: <span id="Hora_Inicio"><?=$Hora_Novo_Contato?></div> <? if ($Hora_Novo_Contato != $Hora_Atual) { ?>
			  [<a href="javascript:reverter('<?=$Hora_Atual?>');">Reverter para a hora atual (
			  <?=$Hora_Atual?>
			  )</a>]
			  <? } ?>
            </strong></td>
          </tr>
          <tr valign="bottom"> 
            <td width="29%" height="2">Tipo de Contato<br>
            </td>
            <td colspan="2" height="2">Alterar Prioridade do chamado<a name="inicio" id="inicio"></a></td>
          </tr>
          <tr valign="bottom"> 
            <td width="29%"> 
              <select name="origem" class="bordagrafite02">
<option value="0">Selecione uma opção</option>			  
<?
    $s = 0;
	/*
	  Atenção à linha abaixo.
	  Quando o usuário foi 1 (Edson) SEMPRE será Origem = 7 (Encaminhamento Interno)
	*/
	if ($ok == 1) { $s=7; }  
	$sistema = pegaOrigens();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_origem"];	  
	  $si = $tmp["origem"];
	  if ($id == $s) { $se="Selected"; } else { $se="";}
	  echo "<option value=$id $se>$si</option>\n";	  
	}
?>
              </select>
            </td>
            <td colspan="2"><span id="tre"> 
              <select name="prioridade" class="bordagrafite02" onChange="mudouPrioridade();">
<?
	///$sistema = pegaPrioridades_g($gestor);
	$sistema = pegaPrioridades();
	
	$PrioridadeChamado = $objChamado->prioridade_id;
	if ($PrioridadeChamado == 4) {
		$PrioridadeChamado = 1;
	}
	
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_prioridade"];
	  $si = $tmp["prioridade"];
	  $se= "";	  
	  if ($id == $PrioridadeChamado) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  
	}
	
  ?>
              </select>
</span> 

<span id="SpanChamadoDepende" style="display: none">
    	<input 
		    name="idchamadodepende" 
			type="text" class="borda_fina" id="idchamadodepende" size="10" maxlength="7" value="<?=$espero?>"  ><br><span id="idchamadodependeretorno"></span>
</span><br>

<span id="sp_encerra" style="Display: none">
	    <input type="text" id="Dt_EncerramentoAutomatico" name="Dt_EncerramentoAutomatico" class="unnamed1" size="11" maxlength="10" value="<?=$Dt_EncerramentoAutomatico?>">
    </span>
<span id="listaReleases">
	<select name="Id_Release" class="botao_fino">
		<option selected="selected" value="0" >Selecione</option>
		<? 
        $Id_Release = $objChamado->Id_Release;		
		$releases = Release::obterReleasesEmAndamento($Id_Release);
		foreach($releases as $r) { 	
			$select = "";	
			if ($r["id"]==$Id_Release) {
				$select = "selected";
			}
			?>
			<option value="<?=$r["id"] ?>" <?=$select?>><?=$r["descricao"]?></option>
			<? 	
		} 	
		?>        
	</select>
</span>    
    </td>
          </tr>
          <tr valign="bottom"> 
            <td width="29%">Pessoa Contatada</td>
            <td colspan="2">Alterar motivo do chamado</td>
          </tr>
          <tr valign="bottom"> 
            <td width="29%"> 
              <input type="text" name="pessoacontatada" class="unnamed1" size="40" maxlength="100" value='<?=$objChamado->nomecliente?>'>
              <input name="emailcontatado" type="text" class="unnamed1" id="emailcontatado" size="60" maxlength="200" value='<?=$objChamado->email?>'>
              <br></td>
            <td colspan="2"><span id="tre"> 
              <select name="motivo" class="bordagrafite02">
<?
	$sistema = pegaMotivos();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_motivo"];
	  $si = $tmp["motivo"];
	  $se= "";
	  if ($id == $objChamado->motivo_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  
	}
	
?>
              </select>
              </span></td>
          </tr>
          <tr valign="top"> 
            <td colspan="3"> 
              <p>Descri&ccedil;&atilde;o da Solu&ccedil;&atilde;o ou Encaminhamento [ <a href="javascript:minusculas();">Min&uacute;sculas</a> ]<br>

              
			 <span class="style1">Para indicar um n&uacute;mero de chamado, coloque-o entre colchetes []</span><a name="NovoContato"></a>                       

			<div id="gravando" style="border:solid 1px; display:none; z-index:2; position:absolute; background-color:#FFF"></div>

			<- Arraste o link do contato atual
			<? echo "<div class=\"dragTest\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado, $ContatoAtual);return OnDragStart(event)\">[$id_chamado, $NumeroDoContatoAtual]</div>"; ?>
			<? echo "<div class=\"dragTest\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado, $ContatoAtual);return OnDragStart3(event)\">Completo</div>"; ?>            


            <p>
				<div style="font-size:16px" ><?= $ClienteSLA ?></div>
				<div style="font-size:16px" ><?= $ClientePosVenda ?></div>
              <textarea name="historico" cols="120" rows="10" class="NovoContato"><?=$texto?>
                </textarea> 
              </p>


<br>
<?php if ($ok==12  || ($Usuario_Area==1)) { ?>
<button id="btnAjuda" onClick="javascript:AdicionarAjuda('<?=$ok?>','<?=$id_chamado?>');" type="button" class="btn btn-primary btn-sm">Ajuda</button>  <span id="ajuda"></span>   / <a href="retaguarda/index.php" target="_blank">Ver fila retaguarda</a><br><br>

<?php } ?>

<?
	$restricoesUsuario = funcoesObterRestricaoChamadoUsuario($ok, $id_chamado);
	if (count($restricoesUsuario)>0) {
?>              


            <table border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td>&nbsp;</td>
                <td><b>Selecione as restri&ccedil;&otilde;es para este chamado</b></td>
              </tr>
<?	
	foreach ($restricoesUsuario as $linha) {
?>
              <tr>
                <td>
                <input <?php if (!(strcmp($linha["ok"],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="IdsRestricoes[]" id="IdsRestricoes[]" value="<?=$linha["id"]?>"></td>
                <td><p>	
                  <?=$linha["descricao"]?> 
                </p></td>
              </tr>
              <?
	}
?>
            </table>
              <?
	}
?>

<a href="javascript:NovaJanelaSolucao();">Base de Solu&ccedil;&otilde;es</a>  / <a href="javascript:novolembrete();"> <!--<img src="figuras/lembrete.jpg" width="22" height="22" align="absmiddle" border="0">-->
Criar novo lembrete</a> / <font size="1">procurar palavra </font> <input type="text" name="palavra"  class="borda_fina" onKeyPress="teclado2();">
                <script>
  function teclado2() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    teste  = "/a/baseweb/index.php?palavra=" + document.form.palavra.value;	
    window.open(teste, "Base", "width=700, hight=400, toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,maximized=no,minimized=no");
	return;
  }
  }
</script>

<br>

              <strong>Anexar arquivo a este contato:&nbsp;</strong><br>
              <input name="userfile[]" type="file" class="borda_fina" size="50" multiple >              
              <div id="additionalEmails"></div>			  
              <input name="button" type="button" class="borda_fina" id="addFieldButton"  value="Anexar + Arquivo" > <input type="hidden" name="MAX_FILE_SIZE" value="99999999">	
<input type="button" name="button2" id="button2" value="DOCUMENTAÇÃO" onClick="Documentacao()"><br>
			  <br>
              
<?
	if (funcoes_possoComunicar($Id_Usuario))
	{
						
?>
        <input type="checkbox" value="1" onClick="alterna(comunica)"> Comunicar outras áreas: <br>
        <span id="comunica" style="Display : none "> 
        <hr size="1">                
        <?
	
            $lista = funcoes_obterAreasComUsuarios($id_chamado);
            foreach ( $lista as $item) 	{
                $checked = "";
                $disabled = "";
                $Item_Id_Chamado = $item["Id_Chamado"];
                $Item_Id_Usuario = $item["Id_Usuario"];		
                $Item_area = $item["area"];
                if ($Item_Id_Chamado <> "") {
                    $checked = 'checked = "checked"';
                    $disabled = 'disabled = "disabled"';
                }
                echo '<input  type="checkbox" '.$checked.' '.$disabled.' value="' . $Item_Id_Usuario .'"> ' . $Item_area .  "<br>";
            }		
        ?>
        <hr size="1">
        </span>
<?
	}
?>              
              
              
<br>			  
              <input name="Ic_Atencao" type="checkbox" id="Ic_Atencao" value="1" <?=$chamado_atencao_checked?>><strong><font color="#ff0000">Aten&ccedil;&atilde;o</font></strong> (marque este campo sempre que um contato precisar de uma analise posterior pela consultoria)<br>
              <? 
			    $checked = "";
			  	if ($objChamado->Ic_ImpedeEncerramentoAutomatico) {
					$checked = "checked = \"checked\"";
				}
			  ?>
<input name="Ic_ImpedeEncerramentoAutomatico" type="checkbox" id="Ic_ImpedeEncerramentoAutomatico" value="1" <?=$checked?>>IMPEDIR ENCERRAMENTO AUTOM&Aacute;TICO<br>
<input name="anexar" type="checkbox" id="anexar" value="1" <?=$ver_chamado_checked?>>Pretendo ver o chamado posteriormente<br>
<input name="lembrete" type="checkbox" id="lembrete" value="1">Incluir lembrete<br>
               
<? if ($externo) {?>
	Atenção ! Este chamado foi aberto pelo cliente.<br>
<? } ?>				
                <input type="checkbox" name="publicar" value="1">
                Publicar para o cliente

<?
	if ($gerente and $rnc) {
?><br>
                <input type="checkbox" name="rnc" value="1" >
                RNC (Seleciona esta op&ccedil;&atilde;o caso 
                o contato deva ir para o Relat&oacute;rio de N&atilde;o Conformidade) 
<?
    }
	require("_email.htm");				
    $pode = pegaDiagnosticoUsuario($ok);
	
	
	if(true) {
?>
                <input type="checkbox" name="base" value="1" onClick="alterna(sp_base)">
				<? 
					if ($JaFoiParaBase) {echo "<font color=#FF0000>Este chamado já está na base.</font> - ";}
                ?>                
                BASE DE CONHECIMENTO (Selecione esta opção se este contato deve constar na base de conhecimento)
				<? 
					if ($JaFoiParaBase) {echo "<font color=#FF0000> - Tenha certeza de que a documentação mudou antes de inserir novamente</font>";}					
                ?>
                <br>
              <span id="sp_base" style="Display : none "> 
              <table width="60%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
                <tr> 
                  <td bgcolor="#FFFFFF"> 
                    <table width="95%" border="0" cellspacing="1" cellpadding="1">
                      <tr> 
                        <td width="23%">Programa / Evento eSocial</td>
                        <td width="77%"> 
                          <input type="text" name="base_programa" class="NovoContato" size="30" maxlength="30">
                        </td>
                      </tr>
                      <tr> 
                        <td width="23%">Descri&ccedil;&atilde;o / Codigo da resposta eSocial</td>
                        <td width="77%"> 
                          <input type="text" name="base_desc" size="60" class="NovoContato" maxlength="100">
                        </td>
                      </tr>
                      <?
						if ($pode)	{
                      ?>                      
                      <tr> 
                        <td width="23%">&nbsp;</td>
                        <td width="77%"> 
                          <input type="checkbox" name="base_cliente" value="1">
                          DOCUMENTA&Ccedil;&Atilde;O INTERNET</td>
                      </tr>
                      <?
							}
                      ?>                      
                    </table>
                  </td>
                </tr>
              </table>
              </span>
<?
	}
	if ($pode) {
?>                                    
                
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Programa Especial</td>
    <td><input name="Ds_ProgramaEspecial" type="text" class="botao_fino" id="textfield" size="50" maxlength="200" value="<?=$Ds_ProgramaEspecial?>"></td>
  </tr>
  <tr>
    <td>Diagn&oacute;stico</td>
    <td>
        <select name="diagnostico" class="bordagrafite02">
        <?
        if( !$objChamado->diagnostico_id ) {
        echo "<option value=0 selected>Não colocar diagnóstico</option>";
        }				  
        $sistema = pegaDiagnosticos();
        while ( list($tmp1, $tmp) = each($sistema) ) {
        $id = $tmp["id_diagnostico"];
        $si = $tmp["diagnostico"];
        $se= "";
        if ($id == $objChamado->diagnostico_id) {
        $se = "selected";
        }
        echo "<option value=$id $se>$si</option>\n";	  
        }
        
        ?>
        </select>    
    </td>    
  </tr>
  <tr>
    <td>Status</td>
    <td>
        <select name="pendente" class="bordagrafite02">
        <?
        $sistema = listaStatus();
        while ( list($tmp1, $tmp) = each($sistema) ) {
        $id = $tmp["id_status"];
        $si = $tmp["status"];
        $comp = $objChamado->status;
        if($comp==1) {
        $comp =2 ;
        }
        $se= "";
        if ($id == $comp) {
        $se = "selected";
        }
        echo "<option value=$id $se>$si</option>\n";	  
        }
        
		
			if ($objChamado->Dt_Release == '0')
				$objChamado->Dt_Release = '';

        ?>
        </select>    
    </td>
  </tr>
  <tr>
    <td>Vers&atilde;o</td>
    <td><input name="Ds_Versao" type="text" class="bordagrafite02" id="Ds_Versao" size="13" maxlength="12" value="<?=$Ds_Versao?>" >
-
  <label for="Dt_Release"></label>
  <input name="Dt_Release" type="text" class="bordagrafite02" id="Dt_Release" size="12" maxlength="10" onKeyPress="fdata(this)" value="<?=$Dt_Release?>"></td>
  </tr>  
</table>

    
    

              <?} else { ?>
			     <input type="hidden" name="pendente" value="<?= $objChamado->status?>"> 
    	          <input type="hidden" name="diagnostico" value="<?= $objChamado->diagnostico_id?>">
              <?}?>
            </td>
          </tr>
          <tr> 
            <td colspan="3">
              <span id="botoes"> 
              <table width="95%" border="0" cellspacing="1" cellpadding="1">
                <tr> 
                  <td>
                  
                    <p>
                      <input type="button" name="btnCancelar" value="Cancelar contato" class="bordagrafite02" onClick="cancelar();">
                      <br><br>                  
  <?

						// Nem sempre o dono do chamado faz parte da lista de contatos do usuário atual....
						$BloquearDiretoParaDono = "";
						$DonoDoChamado = connPegaDonoDoChamado($id_chamado);
				  		$DonoEmFerias = $DonoDoChamado["Ferias"];
						$NomeDoDono = $DonoDoChamado["Nome"];
						$Id_Usuario_Dono = $DonoDoChamado["Id_Usuario_Dono"];

						
						if ($DonoEmFerias) 
						{
							$NomeDoDono .= " - Ausente ";
							$BloquearDiretoParaDono = "disabled = 'disabled'";
						}
				  
					   if ( ($ok != $objChamado->consultor_id) and ($ok == $objChamado->destinatario_id)) {
?>
                                            
                      <input type="button" name="Button" value="Encaminhar para o dono (<?=$NomeDoDono;?>)" class="bordagrafite02" onClick="document.form.action.value='encaminhar';document.form.destinatario.value = '<?=$objChamado->consultor_id?>';vai();" <?= $BloquearDiretoParaDono ?> >
                      
                      <?
					   }
		  if (
		  		(($Id_Usuario_Logado == 12) || ($Id_Usuario_Logado == 7) || ($Id_Usuario_Logado == 1)) &&
				($Id_Usuario_Remetente != $Id_Usuario_Logado) &&
			 	($Id_Usuario_Remetente != $objChamado->consultor_id) ) 
		  {
          ?>
	  <input type="button" name="Button" value="Devolver para <?= peganomeusuario($Id_Usuario_Remetente);?>" class="bordagrafite02" onClick="document.form.action.value='encaminhar';document.form.destinatario.value = '<?=$objChamado->remetente_id?>';vai();">
<?
			}
?>
<br><br>                                            
                      
                      
                      
                      <? if ($chEncaminhado != 1) { ?>						
                      <input type="button" name="Button2" value="Encerrar" class="bordagrafite02" onClick="document.form.action.value='encerrar';vai();">
                      <? } ?>
                      
                      <? if ($chManter != 1) { ?>	
                      <input type="button" name="Submit22" value="Manter Pendente" class="bordagrafite02" onClick="document.form.action.value='manter';vai();">
                      <? } ?>
                      
                      <input type="button" name="Submit32" value="Encaminhar para" class="bordagrafite02" onClick="document.form.destinatario.value = document.form.dest.value; document.form.action.value='encaminhar';vai();">
                      <select name="dest" class="bordagrafite02" >
                        <option value="0"></option>
                        <?
    $conta=1;
	$ListaDeEncaminhamentos = pegaEncaminhaPara($id_chamado, $id_usuario);
	while ( list($tmp1, $tmp) = each($ListaDeEncaminhamentos) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"];	  
	  $ferias = $tmp["f"];
		

	  if ($objChamado->destinatario_id == $id) 
	  {
		  $ferias = 0;
	  }


	  $se = '';	  
	  if ($ferias) 
	  {
		  echo "<OPTGROUP LABEL='$si'>";
	  } else 
	  {
	  	  if ($id != $ok) 
			  if ( $objChamado->destinatario_id == $id ) {		
				$se = 'selected="selected"';
				$conta=0;
			  }
		  echo "<option value=$id $se >$si</option>";	  
	  }
	}
	
?>
                      </select>

                  		  		
<? if (($Id_Usuario_Logado == 12) || ($Id_Usuario_Logado == 7) || ($Id_Usuario_Logado == 98) ) {?>
<br>Encaminhar para outro usu&aacute;rio<br>
<?
		
/*		$sql = "select distinct u.id_usuario, u.nome 
					from contato c inner join usuario u on u.id_usuario = c.consultor_id
					where 
					u.ativo = 1 and 
					u.id_usuario <> $Id_Usuario_Dono and 
					u.id_usuario <> $Id_Usuario_Logado and 
					u.id_usuario <> $Id_Usuario_Remetente and 
					chamado_id = $id_chamado order by nome";*/
					
		$sql = "select distinct u.id_usuario, u.nome 
					from contato c inner join usuario u on u.id_usuario = c.consultor_id
					where 
					u.ativo = 1 and 
					u.id_usuario <> $Id_Usuario_Logado and 
					chamado_id = $id_chamado order by nome";
					
					
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result)) {
?>

			<input type="button" name="Button" value="Encaminhar <?=$linha->nome;?>" class="bordagrafite02" onClick="document.form.action.value='encaminhar';document.form.destinatario.value = '<?=$linha->id_usuario?>';vai();">
                        
<?
		}
	}
                    
?>
    </td>
                </tr>
              </table>
              </span> </td>
          </tr>
        </table>
        <font color="#990033">Aten&ccedil;&atilde;o ! ****</font><font color="#666666"><br>
        Aperte apenas uma vez o bot&atilde;o e aguarde. <br>
        Se o processamento demorar &eacute; porque um email est&aacute; sendo 
        gerado, <br>
        n&atilde;o aperte nenhum bot&atilde;o mais de uma vez !</font><br>
      </td>
    </tr>
  </table>
</form>
<div align="center"><br>
</div>
<p>
  <script>

	function cancelar()
	{		
		var confirma = confirm("Cancelar irá apagar o rascunho deste contato. Confirma esta operação ?");	
		if (confirma) {
			document.form.action.value = "cancelar";
			document.form.submit();
		}
	}

  function vai(item) {

	if (document.form.action.value == "cancelar")
	{
		var confirma = confirm("Cancelar irá apagar o rascunho deste contato. Confirma ?");	
		if (confirma) {
			document.form.submit();
			return false;
		} else {
			return false;
		}
	}


	if ("1" == "<?=$Usuario_Area?>")
	{
		if (!validateEmail(document.form.emailcontatado.value))
		{
			window.alert( 'Email inválido');
			document.form.emailcontatado.focus();
			return false;			
		}		
	}


	if (document.form.prioridade.value==7) {				
		if (document.form.idchamadodepende.value == "") {
			window.alert( 'Digite o número do chamado o qual este chamado espera, ou altere a prioridade');
			document.form.idchamadodepende.focus();
			return false;
		}
	}
	
	if (document.form.origem.value == 39) {
		var confirma = confirm("O relatório de visita já está anexado ?");	
		if (!confirma) {
			return false;			
		}
	}	

	/*
		Chamado 186.261.
		Consultores não podem alterar para urgente ou urgentíssomo.
		Consultores não podem alterar prioridade, caso a mesma já estejam
			como urgente ou urgentíssimo
	*/
	if ( '-1' != '-<?=$gestor?>' ) {
		var pAtual =  document.form.prioridade.value;
		var pAnterior = <?=$objChamado->prioridade_id?>;				
		
		if ((pAnterior==2) | (pAnterior==3)) {
			if ((pAtual!=4)&(pAtual!=2)&(pAtual!=3)&(pAtual!=9)) {
					window.alert( 'Você não pode alterar uma prioridade que é Urgente ou Urgentissimo');
					document.form.prioridade.value = pAnterior;
					return false;
			}
		} else {		
			if ((pAtual==2)|(pAtual==3)) {
					window.alert( 'Você não pode alterar a prioridade para Urgente ou Urgentissimo');
					document.form.prioridade.focus();
					return false;
			}
		}
	}

	

    /*
	  Implementado dia 30/09/2003
	  Ver chamado 44210
	  Mudo tipo de contato para encaminhamento interno se tiver encaminhado
	  e nao tiver tipo de contato.
	*/
	if (document.form.action.value == 'encaminhar') 
	{
		if (document.form.origem.value == 0) {
			document.form.origem.value = 7;
		}
	} else {
		// Conforme chamado 107299
		if (document.form.action.value == 'encerrar') 
		{						
							
			if (document.form.origem.value == 0) {
				document.form.origem.value = <?=ORIGEM_ENCERRAMENTO_DE_CHAMADO?>;
			}
		} else {
				if (document.form.origem.value == 0) 
				{					
					if (document.form.pendente.value > 3) 
					{
						document.form.origem.value = 7;
					}
				}		
			}
		}  
		
		if (document.form.action.value == 'manter') 	
			if (document.form.origem.value==0) 
				document.form.origem.value = <?=ORIGEM_OUTROS?>;
					 
		if (document.form.origem.value==0) {		
		  window.alert( 'Por favor, selecione um tipo de contato');
		  document.form.origem.focus();
		  return false;
		}
	
	
	 
	if('-<?=$pode?>'=='-1') {   
		if (document.form.base.checked) {
		
			if (document.form.base_desc.value=='') {
				window.alert( 'Digite a descrição para BASE DE CONHECIMENTO');
				document.form.base_desc.focus();
				return;
			}
						
			if (document.form.diagnostico.value==0) {
				window.alert( 'Entre com o diagnóstico' );
				document.form.diagnostico.focus();
				return;
			}  
		}  
	}
   
	if ( document.form.action.value == 'manter' ) {		
	  if ( '-<?=$chManter?>'=='-1' ) {
	    window.alert('Você nao pode manter aberto um contato que foi aberto por <?=$AbertoPor?>\nVoce deve encaminhar'); 
		return;
	  }
	}
   
   
	if ( document.form.action.value == 'encerrar' ) 
	{
					
		
		if ( '-<?=$chEncaminhado?>'=='-1' ) {
			window.alert('Você nao pode encerrar um contato que foi aberto por <?=$AbertoPor?>\nVoce deve encaminhar'); 
			return;
		}
		
		if ( document.form.idchamadodepende.value != '') {
			if ( !window.confirm('Este chamado depende de outro para ser encerrado. Confirma ?') ) {
				return false;
			}
		}
		
		// verifica se pode encerrar
		if ('<?=$fl_PodeEncerrar?>' != '1')
		{
			window.alert('<?=$Ds_MotivoNaoEncerrar?>');
			return false;
		}


		if ('<?=$fl_ProgramaEspecial?>' == '1') {
			if ( !window.confirm('Este chamado tem programa especial. Confirma ?') ) {
				return false;
			}
		}		
		
		/*
		Atendendo ao pedido do Edson por telefone (não documentado)
		no dia 01/08/2004
		*/
		if (document.form.prioridade.value==4) {
			window.alert( 'Nao se pode encerrar um chamado que esta Aguardando Cliente\nver chamado 60074');
			document.form.prioridade.focus();
			return false;
		}
		
		
		if (<?=$externo?>) {
			document.form.publicar.checked = 1;
		} 	  
		
		// Problemas....		


		if('-<?=$pode?>'=='-1') {   
			<?		
			if ($tem_documentacao && !$JaFoiParaBase) {		
				$base_desc = 'ver documentação';
				$_comando = "document.form.base.checked = true;sp_base.style.display='';document.form.base_programa.value='.';document.form.base_desc.value='$base_desc';document.form.base_cliente.checked=true;";
				echo $_comando;
			}
			
			

					/*			
					$str = "select id_diagnostico from diagnostico where fl_DocumentacaoInternet = 1";
					$resultado = mysql_query($str);
					$_primeiro = 2;
					$_comando .= "		if ( ( '1' != '$DocumentacaoInternet' ) && (!document.form.base.checked) && ( "	;
					while ($_linha = mysql_fetch_object($resultado)) {
					if ($_primeiro == 1) 			
						$_comando .= " || ";
					$_primeiro = 1;
					$_comando .= " (document.form.diagnostico.value == '" . $_linha->id_diagnostico .  "') ";
					
					}
					$_comando .=  " )) { ";
					if ($_primeiro == 2)
						$_comando = "		if (false) {";			
					echo $_comando;
					*/
			?>		
				//window.alert("Este chamado precisa ser inserido na Base de conhecimento / Documentação Internet");						
				//return false;
		}
		
		if (validaRestricoes() == false)
			return false;


	/*
		if ('<?=$restricoes["mensagemRestricoes"]?>' != '')
		{
			if ('<?=$restricoes["impedeEncerrer"]?>' == '1') {
				window.alert('Chamado com restrições pendentes (<?=$restricoes["mensagemRestricoes"]?>) e não pode ser encerrado'); 
				return;				
			} else {
				if ( !window.confirm('Chamado com restrições pendentes (<?=$restricoes["mensagemRestricoes"]?>). Confirma encerramento ?') ) {
					return false;
				}
			}
		
		}		
		*/

		
		//Se chegou até aqui,pode encerrar, setamos a prioridade para normal (1)
		document.form.prioridade.value = 1;
		
	} // End if Encerrar
	
	

	if ( document.form.action.value == 'manter' ) {		
	  if ( '-<?=$chManter?>'=='-1' ) {
	    window.alert('Você nao pode manter aberto um contato que foi aberto por <?=$AbertoPor?>\nVoce deve encaminhar'); 
		return;
	  }
	}

	

    var editor_data = CKEDITOR.instances.historico.getData();		
    if (editor_data == '') {
	  window.alert( 'Digite a descrição da solução ou encaminhamento');
	  document.form.historico.focus();
	  return;
	}
	
	
	if (document.form.action.value == "encaminhar") {
		if (document.form.destinatario.value==0) {
		  window.alert( 'Selecione para quem será encaminhado o contato');
		  document.form.dest.focus();
		  return;
		}
	}
	

	  if (document.form.publicar.checked) {
	     if ( window.confirm('Este contato será visivel para o cliente, confirma o texto ?') ) {
            botoes.innerHTML = "<font size=5>AGUARDE...</font>";
            document.form.submit();
		 }
	  } else {
	   botoes.innerHTML = "<font size=5>AGUARDE...</font>";
       document.form.submit();        
	  }

	
  }
  
  
function alterna(item){
 if (item.style.display=='none'){
   item.style.display='';
   document.form.base_programa.focus();
 } else {
   item.style.display='none'
 }
}  

function novolembrete() {
  var newWindow;
  newWindow = window.open( 'lembrete/novolembrete.php?id_chamado=<?=$id_chamado?>&id_usuario=<?=$ok?>', '', 'width=500, height=300');
}  


function NovaJanelaSolucao() {
  var newWindow;
  newWindow = window.open( '/suporte/index.php', '', 'width=500, height=300, scrollbars=yes');
}  

function online() {
   window.open( 'ONLINE.PHP', '', 'scrollbars=yes, width=500, height=300');
}  

function toLower( texto ) {
  texto.value = texto.value.toLowerCase();
}  

/*function mudouPrioridade()
{
	var esp = document.getElementById("espera");
	
	if (document.form.prioridade.value==7) {
		document.form.espera.readOnly = false;
		document.form.espera.focus();		
	} else {
		document.form.espera.readOnly = true;
		document.form.espera.value = "";		
	}
	

}
*/
//var divRelease = document.getElementById("listaReleases");	
//divRelease.style.display='none';   
   
function mudouPrioridade()
{

	var esp = document.getElementById("idchamadodepende");
	var sesp = document.getElementById("SpanChamadoDepende");
	var sEncerra = document.getElementById("sp_encerra");	
	div = document.getElementById('TituloChamadoEspera');		

	var divRelease = document.getElementById("listaReleases");	


	if (document.form.prioridade.value==4) {
		
		if ( <?=$Ic_ImpedeEncerramentoAutomatico?> == "1" ) {
			alert("Este chamado não pode ser encerrado automaticamente");
			document.form.prioridade.value = 9;
			esp.readOnly = true;
			esp.disabled = "disabled";
			esp.value = "";		
			sesp.style.display = 'none';
			sEncerra.style.display = 'none';
			divRelease.style.display='none';      			
			return;
		}
		
		sEncerra.style.display = '';
		esp.readOnly = true;
		esp.disabled = "disabled";
		esp.value = "";		
		sesp.style.display = 'none';
		divRelease.style.display='none';      				
		
	} else if (document.form.prioridade.value==7) {	
	
		sesp.style.display = '';
		esp.readOnly = false;
		esp.disabled = "";
		sEncerra.style.display = 'none';
		divRelease.style.display='none';      		
		esp.focus();		
		
	} else 	if (document.form.prioridade.value==8) {
		
		divRelease.style.display='';      
		sesp.style.display = 'none';		
		sEncerra.style.display = 'none';		
	} else {		
	
		esp.readOnly = true;
		esp.disabled = "disabled";
		esp.value = "";		
		sesp.style.display = 'none';
		sEncerra.style.display = 'none';
		divRelease.style.display='none';      								
	}
}
  
  
if (document.form.prioridade.value==7) {
	document.form.espera.readOnly = false;
}

  
  </script>
  <script type="text/javascript">

	function minusculas() 
	{
		//window.alert("opa");
        var editor_data = CKEDITOR.instances.historico.getData();
		editor_data = editor_data.toLowerCase();
		CKEDITOR.instances.historico.setData(editor_data);
	}

//<![CDATA[

	// Replace the <textarea id="historico"> with an CKEditor
	// instance, using default configurations.
	document.form.historico.focus();		


	CKEDITOR.replace( 'historico',
		{
			extraPlugins: 'colorbutton,justify,smiley,horizontalrule,autogrow',			
			on: { 'instanceReady': function(evt) {
				CKEDITOR.instances.historico.focus();			
			   }
			},
			language: 'pt-br',
			setFocusOnStartup : true,			
			enterMode		: 2,            
			toolbar : 
			[	
				{ name: 'clipboard', items: ['Cut', 'Copy', 'Paste'] },
				{ name: 'text', items: ['Bold', 'Italic', 'Underline' ]} ,
				{ name: 'colors', items: ['TextColor','BGColor']} ,				

				[ 'Table', '-', 
				  'JustifyLeft','JustifyCenter','JustifyRight', 'HorizontalRule', '-',
				  'Smiley', '-', 
				  'NumberedList', 'BulletedList', '-', 
				  'Link', 'Unlink']
			]

		});
	
//]]>


  </script>
  
  
  <script type="text/javascript">
	


	setInterval(saveDraft, 5000);
	
	// The magic happens here...
	var CKEDITOR_T = ''; 
	var CKEDITOR_H = '';
	function saveDraft() {
		
		if ( (document.form.horaa.value != CKEDITOR_H) || 
		     (CKEDITOR.instances.historico.getData() != CKEDITOR_T)){
		
			CKEDITOR_T = CKEDITOR.instances.historico.getData();
			CKEDITOR_H = document.form.horaa.value;

			$("#gravando").show();		
			$("#gravando").text("Gravando...");
			
			$.ajax({
				type: "POST",
				url: "SaveDraft.php",
				data: ({
					contato:  CKEDITOR.instances.historico.getData(),
					id_chamado: <?=$id_chamado?>,
					id_usuario: <?=$ok?>,
					hora_inicio: document.form.horaa.value
				}),
				success: function (response) {
					//$("#gravando").text("");
					$("#gravando").fadeOut("Slow");
				}
			});
		}
	}	

	editor_data = "<?=$Texto_Novo_Contato?>";
	CKEDITOR.instances.historico.setData(editor_data);

		
    </script>
  
  <script>
	<? 
	  if ($ok == 12) {
//	  if (true) {	  
		$sql = "select
  u.nome, c.hora
from
  contato_temp c
    inner join usuario u on c.id_usuario = u.id_usuario        
where 
      c.id_usuario <> $ok and
      data = '$Data_Novo_Contato'
      and id_chamado = $id_chamado
order by hora ";
	  

	  $msg = "Usuários trabalhando neste chamado\\n\\n";
	  $temMsg = 'n';	  
	  $result = mysql_query($sql);
	  while ($linha = mysql_fetch_object($result)) {
		$temMsg = 's';	  
	  	$msg .= "$linha->nome, desde às $linha->hora\\n";
	  }
	  
	  mysql_free_result($result);	  
	?>
	
	if ( 's' == '<?=$temMsg?>' ) {
//		window.alert( '<?=$msg?>' );
	}
	
<?	
	}
?>
	
	
	function reverter(HoraInicio)
	{
		campo = document.getElementById('Hora_Inicio');		
		campo.innerHTML = HoraInicio;
		document.form.horaa.value = HoraInicio;
	}


	mudouPrioridade();

	//$('#idchamadodepende').keyup(function () { buscaChamadoADependerDe(); });
	$('#idchamadodepende').blur(function () { buscaChamadoADependerDe(); });

	function buscaChamadoADependerDe()
	{		

		var chamado = $("#idchamadodepende").val();		
		if (chamado == ''){	return false; }
		
		$("#idchamadodependeretorno").show();		
		$("#idchamadodependeretorno").text("Analisando.....");		
	
		if (chamado == <?=$id_chamado?>) {
			alert('Não pode usar o próprio chamado para depender dele');
			limpaChamadoDependete();
			return false;			
		}
	
		$.ajax({
			type: "POST",
			url: "ajax_chamado.php",
			success: success,
			dataType: "json",
			data: { id_chamado: $("#idchamadodepende").val() } 
		});
		
		function success(data)
		{		
		
			Status = data.Status;
			Mensagem = data.Mensagem;
			chamado = data.Chamado;

			if (Status <= 1)
			{
				alert(Mensagem);
				limpaChamadoDependete();
			} 			
			$("#idchamadodependeretorno").text(Mensagem);
		}
		
		function limpaChamadoDependete()
		{		
			$("#idchamadodepende").val('');
			$("#idchamadodependeretorno").fadeOut("Slow");	
			$("#idchamadodepende").focus();
		}			
						
	}

	

	
	
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 	

function Documentacao()
{
    window.open('documentacao.php?id_chamado=<?=$id_chamado?>', "Seleção", "scrollbars=yes, height=600, width=800");	
}



<?
    $r = funcoesObterStatusRestricao($id_chamado);
	$ok = $r["ok"];	
	$r = $r["impede"];		
?>
function validaRestricoes()
{
	
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};	
	
	
	var lista = new Array();	
	<? foreach ($r as $linha) { ?>lista["<?=$linha["id"]?>"] = "<?=$linha["descricao"]?>";<? }?>
	
	var listaok = new Array();
	<? foreach ($ok as $linha) { ?>listaok["<?=$linha["id"]?>"] = "<?=$linha["descricao"]?>";<? }?>
	
	
	var validacao = new Array();
	var chk_arr =  document.getElementsByName("IdsRestricoes[]");
	var chklength = chk_arr.length;
	var tenho = 0;
	
	
	
	var mensagem = "";
	

    for (key in listaok) {		
		var encontrei = false;
		for(k=0;k< chklength;k++)
		{
			if (chk_arr[k].value == key)
			{	
				encontrei = true;
				index = k;
			}		
		}									
		if (encontrei) {
			if (chk_arr[index].checked == false)
			{							
				mensagem = mensagem + listaok[key] + "\n";
			}
		}		
    }	





    for (key in lista) {		
		var encontrei = false;
		for(k=0;k< chklength;k++)
		{
			if (chk_arr[k].value == key)
			{	
				if (chk_arr[k].checked == true)
				{							
					encontrei = true;
				}
			}		
		}							
		
		if (!encontrei) {
			mensagem = mensagem + lista[key] + "\n";
		}		
    }	
	
	if (mensagem!="")
	{
		alert("Restricoes pendentes: \n\n" + mensagem);
		return false;
	} else {
		return true;		
	}
}
	
    </script>
    <script type="text/javascript" src="js/dragEngine.js"></script>   
    
  
  
</p>
  
</body>
<form name="drag1"> 
	<input type="hidden" name="id_chamado">
   	<input type="hidden" name="id_contato">
</form>
</html>
