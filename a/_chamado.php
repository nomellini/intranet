<script src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/javascript" src="../scripts/formataData.js"></script>
<script type="text/javascript" charset="utf-8">
 $(function() {
  var fieldCount = 0;
  $("#addFieldButton").click(function() {
   fieldCount++;
   if(fieldCount <= 50)
   {
    var fieldID = "recipient_email_" + fieldCount;
    $("#additionalEmails").append("<input id = "+fieldID+" type='file'  multiple='multiple' name='userfile[]' class='borda_fina' size='50'><br />" );
	$("#"+fieldID).hide().fadeIn("slow");
   }
   else
   {
    alert("Maximum email fields reached.");
   }
  });
 });
</script>
<?
	require("scripts/conn.php");
	require("scripts/classes.php");
	require_once("scripts/funcoes.php");
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}

    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$id_cliente = $tmp["id_cliente"];
    $cliente = strtoupper($tmp["cliente"]);

   // 13.03.2003 Permite definir como RNC somente se cliente for DATAMCE
	$rnc = strpos( $cliente, "ATAMACE", 0);

    $gerente = pegaGerente($ok);
	$gestor = pegaGestor($ok);
	$bl = $tmp["bloqueio"];

	$objChamado = new chamado();
	//$objContato = new contato();




    $chamado = $objChamado->novoChamado($ok, $id_cliente, $ok);
	//$chamado = 1;
    $objChamado->lerChamado($chamado);
	$dataa = $objChamado->dataa;
	$horaa = $objChamado->horaa;


	// Estas duas vari�veis ser�o passadas via hidden field.
	$dataAbertura = $dataa;
	$horaAbertura = $horaa;

	//$contato = $objContato->novocontato($chamado, $ok, $ok, $dataa, $horaa);
	$dataa = $objChamado->dataaf;
    loga_online($ok, $REMOTE_ADDR, 'Novo CHAMADO : ' . $id_cliente . " : " . $chamado);

	if ($id_ligacao) {
		$sql = "update satligacao set id_chamado = $chamado where id = $id_ligacao";
		mysql_query($sql);
	}

	$Dt_EncerramentoAutomatico = AMD2DMA(obterDataEncerramento());

	$Usuario_Area = funcoes_obterArea($id_usuario); // 1 = consultoria.
	$AreaDesenvolvimento = ( ($Usuario_Area == 2) || ($Usuario_Area == 3) || ($Usuario_Area == 12))

?>
<html>
<script src="coolbuttons.js"></script>
<head>
<title>Novo chamado</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="scripts/stilos.css" type="text/css">
<link rel="stylesheet" href="stilos.css" type="text/css">

</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">

<img src="figuras/topo_sad_e_900.jpg" width="900" height="79" >
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

<table width="98%" border="0" align="center" bgcolor="#FFFFFF" cellpadding="1" cellspacing="1">
  <tr bgcolor="#FFFFFF">
    <td width="26%">
      <div align="left"><font size="2">N&uacute;mero do Chamado</font></div>
    </td>
    <td width="53%"><font size="2"><b>
      <?=$chamado?>
      </b></font></td>
    <td width="21%">
      <div align="left"><font size="2">Data :
        <?=$dataa?>
        </font></div>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="26%" height="2">
      <div align="left"><font size="2">Cliente </font></div>
    </td>
    <td width="53%" height="2"><font size="2"><b>
      <?
		 $msg = "$cliente [$id_cliente]";
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
         echo $msg
		?>
      </b></font> </td>
    <td width="21%" height="2">
      <div align="left"><font size="2">Hora :
        <?=$horaa?>
        </font></div>
    </td>
  </tr>
</table>
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

<form name="form" enctype="multipart/form-data"  method="post" action="gravachamado.php" onSubmit="return false;">
  <table width="98%" border="0" bgcolor="#CCCCCC" cellpadding="1" cellspacing="1" align="center">
    <tr>
      <td bgcolor="#FFFFFF">
        <table width="98%" border="0" align="center">
          <tr valign="top">
            <td width="27%" height="2">Sistema / vers&atilde;o - data </td>
            <td width="20%" height="2">Prioridade</td>
            <td width="53%" height="2">Tipo de Contato</td>
          </tr>
          <tr align="left" valign="middle">
            <td width="27%" valign="top">
              <select name="sistema" class="unnamed1" onChange="alteraCombo();">
                <option value=0></option>
    <OPTGROUP LABEL="Sistemas do cliente">
<?
	$sistema = pegaSistemas($ok, $id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
//	  $ve = $tmp["versao"];
//	  if ($tmp["32bit"]) { $si="$si 32 bit";}
	  echo "<option value='$id'>$si</option>";
	}
	if (!$qtde) {
      echo "<option value=-1>Sistema n�o cadastrado:: $ok :: $id_cliente</option>";
	}
?>
    </OPTGROUP>
    <OPTGROUP LABEL="Outros sistemas">
<?
	$sistema = pegaSistemas($ok, $id_cliente, 1);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  echo "<option value=$id>$si</option>";
	}
	if (!$qtde) {
      echo "<option value=-1>Sistema n�o cadastrado</option>";
	}


  ?>
      </OPTGROUP>
              </select>
              <br>
              <br>
              Vers&atilde;o / Data release
<br>
              <input name="Ds_Versao" type="text" class="bordaTexto" id="Ds_Versao" size="13" maxlength="12">
              -
              <label for="Dt_Release"></label>
            <input name="Dt_Release" type="text" class="bordaTexto" id="Dt_Release" size="12" maxlength="10" onKeyPress="fdata(this)" ></td>
            <td width="20%" valign="top">
              <select name="prioridade" class="unnamed1" onChange="mudouPrioridade()">
                <?
	$sistema = pegaPrioridades_g($gestor);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_prioridade"];
	  $si = $tmp["prioridade"];
	  echo "<option value=$id>$si</option>";
	}

  ?>
              </select><span id="SpanChamadoDepende" style="display: none">
              <input name="idchamadodepende" type="text" class="borda_fina" id="idchamadodepende" size="10" maxlength="7" onKeyUp="SaiDoChamadoEmEspera()"></span>

                  <span id="sp_encerra" style="Display: none">
	    <input type="text" name="Dt_EncerramentoAutomatico" class="unnamed1" size="11" maxlength="10" value="<?=$Dt_EncerramentoAutomatico?>">
    </span>

              </td>
            <td width="53%" valign="top">
              <p>
  <select name="origem" class="unnamed1" onBlur="selecionapessoa('<?=$id_cliente?>')">
    <option value=0>Selecione uma op��o</option>
    <?
    $s = 0;
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
  <br>
  <br>
            Pessoa Contatada[<a href="javascript:selecionapessoa('<?=$id_cliente?>');">CLIQUE PARA SELECIONAR</a>] <br>
            <input type="text" name="pessoacontatada" class="unnamed1" size="40" maxlength="100" onKeyPress="teclado();">
            </p></td>
          </tr>
          <tr align="left" valign="middle">
            <td height="2" valign="top">Treinados em <span id='s'></span></td>
            <td height="2" valign="top"><span id="TituloChamadoEspera"></span></td>
            <td width="53%" height="2" valign="top"> Email </td>
          </tr>
          <tr align="left" valign="middle">
            <td colspan="2" valign="top"> <span id="tre"></span> </td>
            <td width="53%" align="left"><label>
              <input name="emailcontatado" type="text" class="unnamed1" id="emailcontatado" size="60" maxlength="200" >
            </label></td>
          </tr>
          <tr>
            <td colspan="2" height="10"><span id=cat>Sele��o de categoria</span></td>
            <td width="53%" height="10">Motivo<br>
              <select name="motivo" class="unnamed1" >
                <option value=0></option>
                <?
	$sistema = pegaMotivos();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_motivo"];
	  $si = $tmp["motivo"];
	  echo "<option value=$id>$si</option>";
	}

  ?>
              </select>            </td>
          </tr>
          <tr>

			<?
				if ($AreaDesenvolvimento) {

					$ListaDeProjetos = FuncoesObterListaDeProjetosParaDropdownList();

			?>
                <td colspan="3">
                	<label>Projeto </label>
                    <select name="id_projeto_pai" class="unnamed1" id="id_projeto_pai">

                        <option value="0" selected>Selecione apenas se este chamado far� parte de um projeto</option>
                        <?
                            while ( list($id, $linha) = each ( $ListaDeProjetos ) )
                            {
                                $id = $linha["id"];
                                $descricao = $linha["descricao"];
                        ?>
                        <option value="<?=$id?>"><?=$descricao?></option>
						<? } ?>

                    </select>
                </td>
			<? } ?>

          </tr>
          <tr>
            <td colspan="3"><p><br>
              Descri&ccedil;&atilde;o do Problema [ <a href="javascript:toLower( document.form.descricao ); ">Min&uacute;sculas</a>
              ]<br>
              <textarea id="ta1" name="descricao" cols="120" rows="10" class="unnamed1"></textarea>
            </p>
            <p>
<?
  $restricoes = conn_obterListaRestricoes($ok, 0);
?>
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>&nbsp;</td>
    <td><b>Selecione as restri&ccedil;&otilde;es para este chamado</b></td>
  </tr>
<?
	foreach ($restricoes as $linha) {
?>
  <tr>
    <td><input name="id_restricao[]" type="checkbox" id="id_restricao" value="<?=$linha["id"]?>"></td>
    <td><p>
      <?=$linha["descricao"]?>
    </p></td>
  </tr>
<?
	}
?>
</table>

            </p></td>
          </tr>
          <tr>
            <td colspan="3"> <font size="1">procurar por uma palavra (chamados
              anteriores e base conhecimento WEB)</font>
              <input type="text" name="palavra"  class="unnamed1" onKeyPress="teclado2();">
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

</script>            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br>
  <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center">
    <tr>
      <td bgcolor="#FFFFFF">
        <table width="98%" border="0" align="center">
          <tr>
            <td colspan="3">
              <p>Descri&ccedil;&atilde;o da Solu&ccedil;&atilde;o ou Encaminhamento
                [ <a href="javascript:minusculas(); ">Min&uacute;sculas</a>
                ]<br>
                <textarea name="historico" cols="120" rows="10" class="unnamed1"></textarea>
                <br>
                <strong>Anexar arquivo a este contato:&nbsp;<br>
                </strong>
               <input name="userfile[]" type="file"  multiple='multiple' class="borda_fina" size="50">
               <br>
		      <div id="additionalEmails"></div>
              <input name="button" type="button" class="borda_fina" id="addFieldButton"  value="Anexar + Arquivo" >
              <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
			  <br>
<?
	if ($ok == 12) {
		$Dt_EncerramentoAutomativco = AMD2DMA(obterDataEncerramento());
?>
              <input name="Ic_ImpedeEncerramentoAutomatico" type="checkbox" id="Ic_ImpedeEncerramentoAutomatico" value="1" onClick="alterna(sp_encerra)">
              IMPEDIR ENCERRAMENTO AUTOM&Aacute;TICO<br>
<?
	}

?>

              <input name="anexar" type="checkbox" id="anexar" value="1">Pretendo ver o chamado posteriormente<br>
				<input name="lembrete" type="checkbox" id="lembrete" value="1">Incluir lembrete<br>

              <p><a href="javascript:novolembrete();"><img src="figuras/lembrete.jpg" width="22" height="22" align="absmiddle" border="0">clique
                aqui para criar um novo lembrete para esse chamado</a><br>
                <?
	if ($gerente and $rnc) {
?>
                <br>
                <input type="checkbox" name="rnc" value="1" >
                RNC (Seleciona esta op&ccedil;&atilde;o caso o contato deva ir
                para o Relat&oacute;rio de N&atilde;o Conformidade)
                <?
    }
?>
                <?
    /*
	  Este c�digo � repetido em novocontato.php
	*/
    require("_email.htm");

    $pode = pegaDiagnosticoUsuario($ok);
	if($pode) {
?>
                <br>
                <input type="checkbox" name="base" value="X" onClick="alterna(sp_base)">
                BASE DE CONHECIMENTO (Selecione esta op��o se este contato deve
                constar na base de conhecimento)<br>
                <br>
              </p>
              <span id=sp_base style="Display: none">
              <table width="60%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFFFFF">
                    <table width="95%" border="0" cellspacing="1" cellpadding="1">
                      <tr>
                        <td width="23%">Programa</td>
                        <td width="77%">
                          <input type="text" name="base_programa" class="unnamed1" size="30" maxlength="30">                        </td>
                      </tr>
                      <tr>
                        <td width="23%">Descri&ccedil;&atilde;o </td>
                        <td width="77%">
                          <textarea name="base_desc" cols="60" class="unnamed1"></textarea>                        </td>
                      </tr>
                      <tr>
                        <td width="23%">&nbsp;</td>
                        <td width="77%">
                          <input type="checkbox" name="base_cliente" value="1">
                          DOCUMENTA&Ccedil;&Atilde;O INTERNET</td>
                      </tr>
                    </table>                  </td>
                </tr>
              </table>
              </span> <br>
              Diagn&oacute;stico
              <select name="diagnostico" class="unnamed1">
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
              </span>
              <?} else { ?>
              <input type="hidden" name="diagnostico" value="<?=$objChamado->diagnostico_id?>">
              <?}?>
              <br><span id=botoes>
              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td>
                    <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr>
                        <td><input type="button" name="Button" value="Encerrar" class="unnamed1" onClick="document.form.action.value='encerrar';vai();">

                          <input type="button" name="Submit2" value="Manter Pendente" class="unnamed1" onClick="document.form.action.value='manter';vai();"></td>
                        <td>
                          <input type="button" name="Submit3" value="Encaminhar p/" class="unnamed1" onClick="document.form.destinatario.value = document.form.dest.value; document.form.action.value='encaminhar';vai();">
                          <select name="dest">
                            <option value="0"></option>
                            <?
	$sistema = pegaEncaminhaPara($chamado, $id_usuario);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"];
	  echo "<option value=$id>$si</option>";
	}

  ?>
                          </select>                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><input type="button" name="Button2" value="CANCELAR" class="unnamed1" onClick="document.form.action.value='cancelar';vai();"></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>                  </td>
                </tr>
              </table></span>            </td>
          </tr>
        </table>
        <br>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id_chamado" value="<?=$chamado?>">
  <input type="hidden" name="action">
  <input type="hidden" name="destinatario">
  <input type="hidden" name="dataAbertura" value="<?=$dataAbertura?>">
  <input type="hidden" name="horaAbertura" value="<?=$horaAbertura?>">
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
</form>
<script>
  function alteraCombo() {
  <?
	$sistema = pegaCategorias();
	$qtde    = count($sistema);
  ?>

     id_sistema = new Array(<?=$qtde?>);
     id_categoria = new Array(<?=$qtde?>);
	 categoria = new Array(<?=$qtde?>);
	 var strAux;
<?
    $conta = 0;
	while ( list($tmp1, $tmp) = each($sistema) ) {
   	  $conta++;
      $ids = $tmp["id_sistema"];
      $idc = $tmp["id_categoria"];
      $cat = $tmp["categoria"];
	  echo "id_sistema[$conta] = $ids;\n";
   	  echo "id_categoria[$conta] = $idc;\n";
	  echo "categoria[$conta] = '$cat';\n";

	}

  ?>

   sistema  = document.form.sistema.value;
   strAux = 'Categoria<br><select name="categoria" class="unnamed1">\n';
   strAux +=  '<option value=0></optiont>\n';
   for(laco=1; laco <= <?=$qtde?>; laco++) {
     if ( id_sistema[laco] == sistema) {
       strAux = strAux +  '<option value = ' + id_categoria[laco] + '>' + categoria[laco]+'</option>\n';
     }
   }
   strAux += '</select>';

   cat.innerHTML = strAux;
   alteraTreinados();
   //document.form.pessoacontatada.value = '';
  }


  function alteraTreinados() {
  <?
	$treinados = pegaTreinados($id_cliente);
	$qtde    = count($treinados);
  ?>

     id_sistema1 = new Array(<?=$qtde?>);
     nome = new Array(<?=$qtde?>);
     conceito = new Array(<?=$qtde?>);
     dataMes = new Array(<?=$qtde?>);
     parcial = new Array(<?=$qtde?>);
	 var strAux;
<?
    $conta = 0;
	while ( list($tmp1, $tmp) = each($treinados) ) {
   	  $conta++;
      $ids = $tmp["sistema"];
      $cat = $tmp["nome"];
	  $conceito = $tmp["conceito"];
	  $dataMes = $tmp["dataMes"];
	  $parcial = $tmp["parcial"];
	  echo "id_sistema1[$conta] = '$ids';\n";
	  echo "nome[$conta] = '$cat';\n";
	  echo "conceito[$conta] = '$conceito';\n";
	  echo "dataMes[$conta] = '$dataMes';\n";
	  echo "parcial[$conta] = '$parcial';\n";
	}

  ?>

   var qtre = 0;
   sistema1 = document.form.sistema.value;
   s.innerHTML = document.form.sistema.options[ document.form.sistema.selectedIndex ].text;
   strAux = '<select name="treinados" class="unnamed1" onClick="t();">\n';
   strAux +=  '<option value=0></optiont>\n';
   for(laco=1; laco <= <?=$qtde?>; laco++) {
     if ( id_sistema1[laco] == sistema1) {
       qtre++;
	   if (dataMes[laco].length >= 6)
	   {
	   data = " - " + dataMes[laco].substring(0, 2) + "/" + dataMes[laco].substring(2, 6);
	   }
	   else
	   {
		    data = "";
	   }
       strAux = strAux +  '<option value = "' + nome[laco] + '">' + nome[laco] + data + parcial[laco] + conceito[laco]+'</option>\n';
     }
   }
   strAux += '</select>';
   if (qtre==0) {
     tre.innerHTML = "<i>Nenhum treinado nesse sistema</i>";
   } else {
     tre.innerHTML = strAux;
   }
  }

  function t() {
     document.form.pessoacontatada.value = document.form.treinados.options[ document.form.treinados.selectedIndex ].value;
  }

  function vai() {

  	if (document.form.action.value == 'cancelar')
	{
		var confirma = confirm("CANCELAR a abertura deste chamado ?\nIsto ir� apagar todo o registro feito at� o momento");
		if (!confirma) {
			return false;
		} else {
			document.form.submit();
			return true;
		}

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

    if (document.form.sistema.value==0) {
	  window.alert( 'Selecione um sistema');
	  document.form.sistema.focus();
	  return false;
	}


	<?
//		if ($rnc === false) {
		if (true) {
	?>
	if (document.form.Ds_Versao.value=='') {
		window.alert( 'Favor fornecer o n�mero da vers�o');
		document.form.Ds_Versao.focus();
		return false;
	}
	<?
		}
	?>


	// Conforme chamado 107299
	if (document.form.action.value == 'encerrar') {
		if (document.form.origem.value == 0) {
			document.form.origem.value = 20;
		}
	}



    if (document.form.origem.value==0) {
	  window.alert( 'Por favor, selecione um tipo de contato');
	  document.form.origem.focus();
	  return false;
	}





	if (document.form.origem.value == 39) {
		var confirma = confirm("O relat�rio de visita j� est� anexado ?");
		if (!confirma) {
			return false;
		}
	}



	// Implementado em 29/09/2003 - Fernando Nomellini
    if (document.form.pessoacontatada.value=='') {
	  window.alert( 'campo "Pessoa contatada" obrigat�rio. Vide chamado # 42180');
	  document.form.pessoacontatada.focus();
	  return false;
	}



    if (document.form.categoria.value==0) {
	  window.alert( 'Selecione uma categoria');
	  document.form.categoria.focus();
	  return false;
	}

    if (document.form.motivo.value==0) {
	  window.alert( 'Selecione um motivo');
	  document.form.motivo.focus();
	  return  false;
	}

    if (document.form.descricao.value=='') {
	  window.alert( 'Digite a descri��o do problema');
	  document.form.descricao.focus();
	  return false;
	}


    var editor_data = CKEDITOR.instances.historico.getData();
    if (editor_data == '') {
		window.alert( 'Digite a descri��o da solu��o ou encaminhamento');
		document.form.historico.focus();
		return false;
	}

	/*
	if (document.form.historico.value=='') {
		window.alert( 'Digite a descri��o da solu��o ou encaminhamento');
		document.form.historico.focus();
		return false;
	}
	*/

	if (document.form.action.value == "encaminhar") {
		if (document.form.destinatario.value==0) {
		  window.alert( 'Selecione para quem ser� encaminhado o contato');
		  document.form.destinatario.focus();
		  return false;
		}
	}


		/*
		  Atendendo ao pedido do Edson por telefone (n�o documentado)
		  no dia 01/08/2004
		*/
	if (document.form.action.value == "encerrar") {
		if (document.form.prioridade.value==4) {
			window.alert( 'Nao se pode encerrar um chamado que esta Aguardando Cliente\nver chamado 60074');
			document.form.prioridade.focus();
			return false;
		}
	}

	if ("1" == "<?=$Usuario_Area?>")
	{
		if (!validateEmail(document.form.emailcontatado.value))
		{
			window.alert( 'Email inv�lido');
			document.form.emailcontatado.focus();
			return false;
		}
	}

    document.form.descricao.value = document.form.descricao.value + '<br>' + document.form.sistema.options[ document.form.sistema.selectedIndex ].text;
    botoes.innerHTML = "<font size=5>AGUARDE...</font>";
  	document.form.submit();
  }

  alteraCombo();

  function teclado() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    vai();
	return false;
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


function selecionapessoa(AClienteId) {
	window.open('selecionapessoa.php?cliente_id='+AClienteId,'','width=536, height=450');
}


function novolembrete() {
  var newWindow;
  newWindow = window.open( 'lembrete/novolembrete.php?id_chamado=<?=$chamado?>&id_usuario=<?=$ok?>', '', 'width=500, height=300');
}

function toLower( texto ) {
  texto.value = texto.value.toLowerCase();
}

function validaEmail()
{
	return validateEmail(document.form.emailcontatado.value);
}

function testaemail() {
	if (		document.form.emailcontatado.value == "")
	{
		alert("Favor preencher o email");

				return false;
	} else  if (!validaEmail()) {
		alert('Aten��o. Email inv�lido');
		return false;
	  }
}

function mudouPrioridade()
{
	var esp = document.getElementById("idchamadodepende");
	var sesp = document.getElementById("SpanChamadoDepende");
	var sEncerra = document.getElementById("sp_encerra");
	div = document.getElementById('TituloChamadoEspera');

	if (document.form.prioridade.value==4) {

		sEncerra.style.display = '';

		esp.readOnly = true;
		esp.disabled = "disabled";
		esp.value = "";
		sesp.style.display = 'none';
		div.innerHTML = '';


	} else if (document.form.prioridade.value==7) {

		sesp.style.display = '';
		esp.readOnly = false;
		esp.disabled = "";
		sEncerra.style.display = 'none';
		esp.focus();

	} else {

		esp.readOnly = true;
		esp.disabled = "disabled";
		esp.value = "";
		sesp.style.display = 'none';
		sEncerra.style.display = 'none';
		div.innerHTML = '';

	}
}

document.form.idchamadodepende.readOnly = true;
document.form.idchamadodepende.disabled = "disabled";

function SaiDoChamadoEmEspera(ChamadoId) {
	var sesp = document.getElementById("SpanChamadoDepende");
	var Chamado = document.form.idchamadodepende.value

	if (sesp.style.display != 'none') {
		procura(Chamado);
	}
	//document.form.origem.focus();
}

url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);

function ajax_do (url) {
        // Does URL begin with http?

        if (url.substring(0, 4) != 'http') {
                url = base_url + url;
        }

        // Create new JS element
        var jsel = document.createElement('SCRIPT');
        jsel.type = 'text/javascript';
        jsel.src = url;

        // Append JS element (therefore executing the 'AJAX' call)
        document.body.appendChild (jsel);
}

function procura(ChamadoId) {
	ajax_do ('ajax_PegaDescChamado.php?id_chamado='+ChamadoId);
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


	editor_data = "<?=$Texto_Novo_Contato?>";
	CKEDITOR.instances.historico.setData(editor_data);


function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


</script>


</body>
</html>