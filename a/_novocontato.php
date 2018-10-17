<script src="../scripts/jquery-1.4.2.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" charset="utf-8">

 $(function() {
  var fieldCount = 0;
  $("#addFieldButton").click(function() {
   fieldCount++;
   if(fieldCount <= 50)
   {
    var fieldID = "recipient_email_" + fieldCount;
    $("#additionalEmails").append("<input id = "+fieldID+" type='file' name='userfile[]' class='borda_fina' size='50'><br />" );
	$("#"+fieldID).hide().fadeIn("slow");
   }
   else
   {
    alert("Maximum email fields reached.");
   }
  });
 });
</script><?
	require("scripts/conn.php");
	require("scripts/classes.php");
	include("fckeditor/fckeditor.php") ;

	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}

    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$cliente = strtoupper($tmp["cliente"]);
	$grau = $tmp["grau"];
	$grau = $grau == "ZZ" ? ""  : "[$grau]";
	$cliente = "$cliente $grau";


    // Banco de dados, tabela origem - Id = 20
    define(ORIGEM_ENCERRAMENTO_DE_CHAMADO, 20);

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


    $contatos = historicoChamado($id_chamado, 'desc');
    $UltimoContato =count($contatos);
	$Ccontador = $UltimoContato + 1;

    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);

	$espero = $objChamado->dependo_de;
	if (!$espero) {
		$espero = "";
	}

	$QtdeDependentes = conn_TemChamadosAguardando($id_chamado);

	$sistema_id = $objChamado->sistema;
	$status = pegaStatus( $objChamado->status );
	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}

    list($tmp1, $tmp) = each(pegaUsuario($objChamado->destinatario_id));
	$destinatario = $tmp["nome"];
    $superiord_id = $tmp["superior_id"];

    list($tmp1, $tmp) = each(pegaUsuario($objChamado->consultor_id));
	$AbertoPor = $tmp["nome"];
    $superior_id = $tmp["superior_id"];

    list($tmp1, $tmp) = each(pegaUsuario($objChamado->remetente_id));
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

     $chEncaminhado = 1; //Nao posso encerrar, pois � um chamado encaminhado

	 if ( ($id_usuario == $objChamado->destinatario_id ) and ($id_usuario == $objChamado->consultor_id ) )
	    $chEncaminhado = 0;  //Posso encerrar se sou o destinat�rio	e dono do chamado
	 else if ( ($id_usuario == $superior_id) and ( $objChamado->consultor_id == $objChamado->destinatario_id ))
	    $chEncaminhado = 0;  //Posso encerrar se sou o superior do dono do chamado e o chamado est� com quem o abriu
	 else if ( ($id_usuario == $superior_id) and ( $id_usuario == $objChamado->destinatario_id ))
	    $chEncaminhado = 0;  //Posso encerrar se sou o superior do dono do chamado e o chamado est� com o superior
	 else  if ($ok==12  || $ok==141)
    	 $chEncaminhado = 0; // Indica quem pode encerrar qualquer chamado



	 if ($chStatus ==1 ) {
	   $chEncaminhado = 0;
	   $chManter = 0;
	 }



	if ($id_ligacao) {
		$sql = "update satligacao set id_chamado = $id_chamado where id = $id_ligacao";
		mysql_query($sql);
	}


	 // Armazeno em uma tabela tempor�ria a data e hora da abertura do novo contato para este funcionario
	$Hora_Novo_Contato = date("H:i:s");
	$Data_Novo_Contato = date("Y-m-d");
	$Texto_Novo_Contato = "";
	$Id_Usuario = $ok;
	$resultado = conn_InsereControleNovoContato($id_chamado, $Id_Usuario, $Data_Novo_Contato, $Hora_Novo_Contato);

	 if ($Data_Novo_Contato == $resultado["data"]) {
	   if ($resultado["status"] == 0)
	   {
		   $Hora_Novo_Contato = $resultado["hora"];
           $Texto_Novo_Contato = $resultado["contato"];
	   }
	 }



    loga_online($ok, $REMOTE_ADDR, 'Novo Contato : ' . $id_cliente . " :  " . $id_chamado);
?>
<script src="coolbuttons.js"></script>
<html>
<head>
<title>Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
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
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton"><a href="/agenda/" target="_blank">Agenda
      Corporativa Datamace</a></td>
  </tr>
</table>
<hr size="1" noshade>
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
?>

            <?=$descricao?>
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
  <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center">
    <tr>
      <td bgcolor="#FFFFFF">
        <div align="center">
          <p><a name="Contato"></a>Novo Contato [<a href="#Inicio">navegar para o inicio</a>]<br>
          </p>
        </div>
        <table width="98%" border="0" align="center">
          <tr valign="bottom">
            <td height="2" colspan="3"><strong>HORA INICIO:
              <?=$Hora_Novo_Contato?>
            </strong></td>
          </tr>
          <tr valign="bottom">
            <td width="29%" height="2">Tipo de Contato<br>
            </td>
            <td colspan="2" height="2">Alterar Prioridade do chamado<a name="inicio" id="inicio"></a></td>
          </tr>
          <tr valign="bottom">
            <td width="29%">
              <select name="origem" class="NovoContato">
<option value=0>Selecione uma op��o</option>
<?
    $s = 0;
	/*
	  Atenção linha abaixo.
	  Quando o usuúrio foi 1 (Edson) SEMPRE será Origem = 7 (Encaminhamento Interno)
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
              <select name="prioridade" class="NovoContato" onChange="mudouPrioridade();">
<?
	///$sistema = pegaPrioridades_g($gestor);
	$sistema = pegaPrioridades();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_prioridade"];
	  $si = $tmp["prioridade"];
	  $se= "";
	  if ($id == $objChamado->prioridade_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";
	}

  ?>
              </select>
              </span> <label>
              <input id="espera" name="espera" type="text" class="bordaTexto" value="<?= $espero?>" readonly="readonly" >
              </label></td>
          </tr>
          <tr valign="bottom">
            <td width="29%">Pessoa Contatada</td>
            <td colspan="2">Alterar motivo do chamado</td>
          </tr>
          <tr valign="bottom">
            <td width="29%">
              <input type="text" name="pessoacontatada" class="NovoContato" size="40" maxlength="100" value='<?=$objChamado->nomecliente?>'>
            </td>
            <td colspan="2"><span id="tre">
              <select name="motivo" class="NovoContato">
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
                      <span class="style1">Para indicar um n&uacute;mero de chamado, coloque-o entre colchetes []</span><a name="NovoContato"></a><br>
            <textarea name="historico" cols="120" rows="10" class="NovoContato"><?=$texto?></textarea>
                <br>
                <strong>Anexar arquivo a este contato:&nbsp;<br>
                </strong>
               <input name="userfile[]" type="file" class="borda_fina" size="50">
               <br>
		      <div id="additionalEmails"></div>
              <input name="button" type="button" class="borda_fina" id="addFieldButton"  value="Anexar + Arquivo" >
              <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
			  <br>
<?
	if ($ok == 12) {
		$Dt_EncerramentoAutomativco = AMD2DMA(obterDataEncerramento());
?>
              <input name="Fl_EncecerrarAutomaticamente" type="checkbox" id="Fl_EncecerrarAutomaticamente" value="1" onClick="alterna(sp_encerra)">Encerrar automaticamente este chamado (aviso de 3 dias)
              <span id=sp_encerra style="Display: none"> :: Encerrar em <input type="text" name="Dt_EncerramentoAutomatico" class="unnamed1" size="11" maxlength="10" value="<?=$Dt_EncerramentoAutomativco?>">
              </span>
			 <br>
<?
	}

?>
              <input name="anexar" type="checkbox" id="anexar" value="1">Pretendo ver o chamado posteriormente<br>
                <font size="1">procurar por uma palavra (chamados anteriores e
                base conhecimento WEB)</font>
                <input type="text" name="palavra"  class="NovoContato" onKeyPress="teclado2();">
                <font size="1">(tecle ENTER)</font>
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
                <a href="javascript:NovaJanelaSolucao();"><font size="2" color="#FF0000"><b>Base
                de Solu&ccedil;&otilde;es</b></font></a> <br>
                <a href="javascript:novolembrete();"> <img src="figuras/lembrete.jpg" width="22" height="22" align="absmiddle" border="0">clique
                aqui para criar um novo lembrete para esse chamado</a></p>
              <p>

<? if ($externo) {?>
	Aten��o ! Este chamado foi aberto pelo cliente.<br>
<? } ?>
                <input type="checkbox" name="publicar" value="1">
                Publicar para o cliente
<br>
<?
	if ($gerente and $rnc) {
?><br>
                <input type="checkbox" name="rnc" value="1" >
                RNC (Seleciona esta op&ccedil;&atilde;o caso
                o contato deva ir para o Relat&oacute;rio de N&atilde;o Conformidade)
                <?
    }
?>
                <br>
                <?
	require("_email.htm");
    $pode = pegaDiagnosticoUsuario($ok);

	if($pode) {
?>
                <input type="checkbox" name="base" value="1" onClick="alterna(sp_base)">
                BASE DE CONHECIMENTO (Selecione esta op��o se este contato deve
                constar na base de conhecimento)<br>              <span id=sp_base style="Display : none ">
              <table width="60%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFFFFF">
                    <table width="95%" border="0" cellspacing="1" cellpadding="1">
                      <tr>
                        <td width="23%">Programa</td>
                        <td width="77%">
                          <input type="text" name="base_programa" class="NovoContato" size="30" maxlength="30">
                        </td>
                      </tr>
                      <tr>
                        <td width="23%">Descri&ccedil;&atilde;o </td>
                        <td width="77%">
                          <input type="text" name="base_desc" size="60" class="NovoContato" maxlength="100">
                        </td>
                      </tr>
                      <tr>
                        <td width="23%">&nbsp;</td>
                        <td width="77%">
                          <input type="checkbox" name="base_cliente" value="1">
                          DOCUMENTA&Ccedil;&Atilde;O INTERNET</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              </span> <br>
              Diagn&oacute;stico <span id="tre">
              <select name="diagnostico" class="NovoContato">
                <?
    if( !$objChamado->diagnostico_id ) {
	  echo "<option value=0 selected>N�o colocar diagn�stico</option>";
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
              <br>
              Manter Pendente com o seguinte Status<span id="tre">
              <select name="pendente" class="NovoContato">
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

  ?>
              </select>
              </span> </span>
              <?} else { ?>
			<!--  <input type="hidden" name="pendente" value="<?= $objChamado->status?>"> -->
              <input type="hidden" name="diagnostico" value="<?= $objChamado->diagnostico_id?>">
              <?}?>
            </td>
          </tr>
          <tr>
            <td colspan="3"><br>
              <span id=botoes>
              <table width="95%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td>
<?

						// Nem sempre o dono do chamado faz parte da lista de contatos do usuário atual....
						$BloquearDiretoParaDono = "";
						$DonoDoChamado = connPegaDonoDoChamado($id_chamado);
				  		$DonoEmFerias = $DonoDoChamado["Ferias"];
						$NomeDoDono = $DonoDoChamado["Nome"];

						if ($DonoEmFerias)
						{
							$NomeDoDono .= " - Em f�rias ";
							$BloquearDiretoParaDono = "disabled = 'disabled'";
						}

					   if ( ($ok != $objChamado->consultor_id) and ($ok == $objChamado->destinatario_id)) {
?>

                    <input type="button" name="Button" value="Encaminhar para o dono (<?=$NomeDoDono;?>)" class="NovoContato" onClick="document.form.action.value='encaminhar';document.form.destinatario.value = '<?=$objChamado->consultor_id?>';vai();" <?= $BloquearDiretoParaDono ?> >

          <?
		  if (
		  		($ok == 12) &&
				($objChamado->remetente_id != $ok) &&
			 	($objChamado->remetente_id != $objChamado->consultor_id) )
		  {
          ?>
<input type="button" name="Button" value="Devolver para <?= $NomeDoDono;?>" class="NovoContato" onClick="document.form.action.value='encaminhar';document.form.destinatario.value = '<?=$objChamado->remetente_id?>';vai();">
          <?
			}
          ?>

                    <br>
                    <?
				     	}
					?>
                    <br>


					<? if ($chEncaminhado != 1) { ?>
                    <input type="button" name="Button2" value="Encerrar" class="NovoContato" onClick="document.form.action.value='encerrar';vai();">
					<? } ?>

					<? if ($chManter != 1) { ?>
                    <input type="button" name="Submit22" value="Manter Pendente" class="NovoContato" onClick="document.form.action.value='manter';vai();">
     				<? } ?>

                    <input type="button" name="Submit32" value="Encaminhar para" class="NovoContato" onClick="document.form.destinatario.value = document.form.dest.value; document.form.action.value='encaminhar';vai();">
                    <select name="dest" class="NovoContato" >
                      <option value="0"></option>
<?
    $conta=1;
	$ListaDeEncaminhamentos = pegaEncaminhaPara($id_chamado, $id_usuario);
	while ( list($tmp1, $tmp) = each($ListaDeEncaminhamentos) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"];
	  $ferias = $tmp["f"];


	  $se = '';
	  if ($ferias)
	  {
		  echo "<OPTGROUP LABEL='$si'>";
	  } else
	  {
		  if ( $objChamado->destinatario_id == $id ) {
		  // if  ( ($conta==1) and ($chManter==1)){
			$se = 'selected="selected"';
			$conta=0;
		  }
		  echo "<option value=$id $se >$si</option>";
	  }
	}

?>
                    </select>
                  <a href="javascript:online();"></a></td>
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
<script>
  function vai(item) {


	if (document.form.prioridade.value==7) {
		if (document.form.espera.value == "") {
			window.alert( 'Digite o n�mero do chamado o qual este chamado espera, ou altere a prioridade');
			document.form.espera.focus();
			return false;
		}
	}

	/*
		Chamado 186.261.
		Consultores n�o podem alterar para urgente ou urgent�ssomo.
		Consultores n�o podem alterar prioridade, caso a mesma j� estejam
			como urgente ou urgent�ssimo
	*/
	if ( '-1' != '-<?=$gestor?>' ) {
		var pAtual =  document.form.prioridade.value;
		var pAnterior = <?=$objChamado->prioridade_id?>;

		if ((pAnterior==2) | (pAnterior==3)) {
			if ((pAtual!=4)&(pAtual!=2)&(pAtual!=3)) {
					window.alert( 'Voc� n�o pode alterar uma prioridade que � Urgente ou Urgentissimo');
					document.form.prioridade.value = pAnterior;
					return false;
			}
		} else {
			if ((pAtual==2)|(pAtual==3)) {
					window.alert( 'Voc� n�o pode alterar a prioridade para Urgente ou Urgentissimo');
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
    if (document.form.action.value == 'encaminhar') {
		if (document.form.origem.value == 0) {
			document.form.origem.value = 7;
		}
	} else {
		// Conforme chamado 107299
		if (document.form.action.value == 'encerrar') {
			if (document.form.origem.value == 0) {
				document.form.origem.value = <?=ORIGEM_ENCERRAMENTO_DE_CHAMADO?>;
			}
		} else {
			if (document.form.origem.value == 0) {
				if (document.form.pendente.value > 3) {
					document.form.origem.value = 7;
				}
			}

		}
	}


    if (document.form.origem.value==0) {

	  window.alert( 'Por favor, selecione um tipo de contato');
	  document.form.origem.focus();
	  return false;
	}




   if('-<?=$pode?>'=='-1') {
	   if (document.form.base.checked) {

			if (document.form.base_desc.value=='') {
			  window.alert( 'Digite a descri��o para BASE DE CONHECIMENTO');
			  document.form.base_desc.focus();
			  return;
			}


			if (document.form.diagnostico.value==0) {
			  window.alert( 'Entre com o diagn�stico' );
			  document.form.diagnostico.focus();
			  return;
			}
	   }
  }

	if ( document.form.action.value == 'encerrar' ) {
		if ( '-<?=$chEncaminhado?>'=='-1' ) {
			window.alert('Voc� nao pode encerrar um contato que foi aberto por <?=$AbertoPor?>\nVoce deve encaminhar');
			return;
		}

		if ( document.form.espera.value != '') {
	     if ( !window.confirm('Este chamado depende de outro para ser encerrado. Confirma ?') ) {
		 	return false;
		 }
		}




		/*
		  Atendendo ao pedido do Edson por telefone (n�o documentado)
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
	}

	if ( document.form.action.value == 'manter' ) {
	  if ( '-<?=$chManter?>'=='-1' ) {
	    window.alert('Voc� nao pode manter aberto um contato que foi aberto por <?=$AbertoPor?>\nVoce deve encaminhar');
		return;
	  }
	}



    var editor_data = CKEDITOR.instances.historico.getData();
    if (editor_data == '') {
	  window.alert( 'Digite a descri��o da solu��o ou encaminhamento');
	  document.form.historico.focus();
	  return;
	}


	if (document.form.action.value == "encaminhar") {
		if (document.form.destinatario.value==0) {
		  window.alert( 'Selecione para quem ser� encaminhado o contato');
		  document.form.dest.focus();
		  return;
		}
	}


	  if (document.form.publicar.checked) {
	     if ( window.confirm('Este contato ser� visivel para o cliente, confirma o texto ?') ) {
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

function mudouPrioridade()
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

			on: { 'instanceReady': function(evt) {
				CKEDITOR.instances.historico.focus();
			   }
			},

			setFocusOnStartup : true,
			enterMode		: 2,
			toolbar :
			[
				[ 'Bold', 'Italic', 'Underline', 'Table', '-',
				  'JustifyLeft','JustifyCenter','JustifyRight', 'JustifyFull', '-',
				  'TextColor','BGColor', '-',
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
	function saveDraft() {
		//alert('o');
		$.ajax({
			type: "POST",
			url: "SaveDraft.php",
			data: ({
				contato:  CKEDITOR.instances.historico.getData(),
				id_chamado: <?=$id_chamado?>,
				id_usuario: <?=$ok?>
			}),
			success: function (response) {
				//alert('saved draft');
			}
		});
	}


	editor_data = "<?=$Texto_Novo_Contato?>";
	CKEDITOR.instances.historico.setData(editor_data);


    </script>


</body>
</html>
<?
	//echo "$ok - $objChamado->destinatario_id - $objChamado->consultor_id - $chDestinatario" ;
?>