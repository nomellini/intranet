<?php require_once('../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE (hierarquia = 2 and ativo = 1) or (id_usuario=281) or (id_usuario=12) ORDER BY nome";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><?
	require("scripts/conn.php");
	require("scripts/classes.php");	
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
	$bl = $tmp["bloqueio"];
	
	$objChamado = new chamado();	
	$chamado = $id_chamado;
    $objChamado->lerChamado($chamado);	
	
	$nomecliente = $objChamado->nomecliente;
    $nomecliente = eregi_replace("\"", "`", $nomecliente);
    $nomecliente = eregi_replace("'", "`", $nomecliente);	
    $objChamado->nomecliente = $nomecliente;
	
    $dataa = date("Y-m-d");
    $horaa = date("H:i:s");
	
	
    if ( !($objChamado->motivo_id == 0) ) {
	  header("Location: chegoutarde.php");
	}

    loga_online($ok, $REMOTE_ADDR, 'Chamado de Cliente : ' . $chamado);
	
	$con = $objChamado->consultor_id;
	$rem = $objChamado->remetente_id;
	$des = $objChamado->destinatario_id;	
	
	$objChamado->consultor_id=$ok;
	$objChamado->remetente_id=$ok;	
	$objChamado->destinatario_id=$ok;
	$objChamado->gravaChamado();
		
	$destinatarios = pegaEncaminhaPara($chamado, $id_usuario);	

	$objChamado->consultor_id=$con;
	$objChamado->remetente_id = $rem;	
	$objChamado->destinatario_id=$des;		
	$objChamado->gravaChamado();	
	
	$dataa = $objChamado->dataaf;

	$contatos = historicoChamado($chamado, "");		
	

?>
<html>
<script src="coolbuttons.js"></script>
<head>
<title>Chamado <?=$id_chamado?> do cliente <?=$id_cliente?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="scripts/stilos.css" type="text/css">
<link rel="stylesheet" href="stilos.css" type="text/css">
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
    <td width="259" class="coolButton">&nbsp;</td>
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
		 $msg = $cliente;
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
         echo $msg
		?>
		</b></font>
   </td>
      <td width="21%" height="2"> 
        <div align="left"><font size="2">Hora : 
          <?=$horaa?>
          </font></div>
      </td>
    </tr>
  </table>

<form name="form" method="post" action="dochamadoabertoporcliente.php" onSubmit="return false;">
  <table width="98%" border="0" bgcolor="#CCCCCC" cellpadding="1" cellspacing="1" align="center">
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <table width="98%" border="0" align="center">
          <tr valign="top"> 
            <td width="19%" height="2">Sistema</td>
            <td width="28%" height="2">Prioridade</td>
            <td width="53%" height="2">Tipo de Contato<br>            </td>
          </tr>
          <tr align="left" valign="middle"> 
            <td width="19%"> 
              <select name="sistema" class="unnamed1" onClick="alteraCombo();">
                <option value=0></option>
                <?
	$sistema = pegaSistemas(1, $id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  $ve = $tmp["versao"];
	  $se = "";
	  if ($objChamado->sistema_id == $id) {
	    $se = "selected";
	  }
	  if ($tmp["32bit"]) { $si="$si 32 bit";} 
	  echo "<option value=$id $se>$si - $ve</option>";
	}
	if (!$qtde) {
      echo "<option value=-1>Sistema não cadastrado</option>";	  
	}
	$sistema = pegaSistemas(1, $id_cliente, 1);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  $se = "";
	  if ($objChamado->sistema_id == $id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>";
	}
	if (!$qtde) {
      echo "<option value=-1>Sistema não cadastrado</option>";	  
	}
	
	
  ?>
              </select>            </td>
            <td width="28%"> 
              <select name="prioridade" class="unnamed1" >
                <?
	$sistema = pegaPrioridades();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_prioridade"];
	  $si = $tmp["prioridade"];
	  $se= "";
	  if ($id == 1) {
	    $se = "selected";
	  }	  
	  echo "<option value=$id $se>$si</option>";	  
	}
	
  ?>
              </select>            </td>
            <td width="53%"> 
              <select name="origem" class="unnamed1">
                <?
	$sistema = pegaOrigens();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_origem"];
	  $si = $tmp["origem"];
	  $se= "";
	  if ($id == 12) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  
	}
	
  ?>
              </select>            </td>
          </tr>
          <tr align="left" valign="middle"> 
            <td height="2" valign="top" colspan="2">Treinados em <span id='s'></span></td>
            <td width="53%" height="2" valign="top">Pessoa Contatada</td>
          </tr>
          <tr align="left" valign="middle"> 
            <td colspan="2"> <span id="tre"></span> </td>
            <td width="53%"> 
              <input type="text" name="pessoacontatada" class="unnamed1" size="40" maxlength="100" onKeyPress="teclado();" >            </td>
          </tr>
          <tr> 
            <td colspan="2" height="10"><span id=cat>Seleção de categoria</span></td>
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
  	<script>
			document.form.motivo.value = 9;
    </script>
    
              </select>            </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="3"><br>Assunto<br />
              <textarea name="descricao" cols="100" rows="10" class="unnamed1"><?=$objChamado->descricao?></textarea>
              <br>
              <br>
              <br></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<br/><hr/><br/>
<div style="with=50%">
  <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center">
    <tr> 
      <td bgcolor="#FFFFFF"> <h3>Descrição do problema</h3>
<h4>Texto abaixo inserido pelo cliente está no contato número 1</h4>
<?	
    foreach ($contatos as $contato) {
		echo( nl2br($contato["historico"]));
	}?></td>
</tr>
</table>
<br/><hr/><br/>
</div>  
  <table width="98%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" align="center">
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <table width="98%" border="0" align="center">
          <tr> 
            <td colspan="3"> Descri&ccedil;&atilde;o da Solu&ccedil;&atilde;o 
              ou Encaminhamento <br>
              <textarea name="historico" cols="100" rows="15" class="unnamed1">Em análise</textarea>
              <br>
              <font size="1">procurar por uma palavra (chamados anteriores e base 
              conhecimento WEB)</font> 
              <input type="text" name="palavra"  class="unnamed1" onKeyPress="teclado2();">
              <font size="1">(tecle ENTER)</font> 
              <script>
  function teclado2() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    teste  = "/a/baseweb/index.php?palavra=" + document.form.palavra.value;	
    window.open(teste, "Base", "width=640, hight=300, toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,maximized=no,minimized=no");
	return;
  }
  }
function NovaJanelaSolucao() {
  var newWindow;
  newWindow = window.open( '/suporte/index.php', '', 'width=500, height=300, scrollbars=yes');
}  
  
  
</script>
              <br>
              <a href="javascript:NovaJanelaSolucao();"><font size="2" color="#FF0000"><b>Base 
              de Solu&ccedil;&otilde;es</b></font></a> </td>
          </tr>
          <tr> 
            <td colspan="2"> 
              <p><br>
                <input type="button" name="Button" value="Encerrar" class="unnamed1" onClick="document.form.action.value='encerrar';vai();">
                <input type="button" name="Submit2" value="Manter Pendente" class="unnamed1" onClick="document.form.action.value='manter';vai();">
              </p>
            </td>
            <td width="53%"> 
              <input type="button" name="Submit3" value="Encaminhar p/" class="unnamed1" onClick="document.form.action.value='encaminhar';vai();">
              <select name="destinatario">
                <option value="0"></option>
                <?
	while ( list($tmp1, $tmp) = each($destinatarios) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"];
	  echo "<option value=$id>$si</option>";	  
	}
	
  ?>
              </select>
            </td>
          </tr>
        </table>
        <br>
      </td>
    </tr>
  </table>
  <br>
  <input type="hidden" name="id_chamado" value="<?=$chamado?>">
  <input type="hidden" name="id_contato" value="<?=$contato?>">
  <input type="hidden" name="action">
  <input type="hidden" name="frasepadrao" value="Seu chamado foi recebido em nosso Data Center">
</form><script>



  function alteraCombo() {

  <?
	$sistema = pegaCategorias();
	$qtde    = count($sistema) ;
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
    document.form.pessoacontatada.value = '';
   }


  function alteraTreinados() {
  <?
//  	echo "OPA";
	$treinados = pegaTreinados($id_cliente);
	$qtde    = count($treinados);
  ?>
  
     id_sistema1 = new Array(<?=$qtde?>);
     nome = new Array(<?=$qtde?>);	 	 
	 var strAux;
<? 
    $conta = 0;
	while ( list($tmp1, $tmp) = each($treinados) ) {
   	  $conta++;
      $ids = $tmp["sistema"];
	  if ($ids != "") {
      $cat = $tmp["nome"];
	  echo "id_sistema1[$conta] = $ids;\n";
	  echo "nome[$conta] = '$cat';\n";	  
	  }

	}
	
//	$qtde = 1;
	
  ?>
   
   var qtre = 0;
   sistema1 = document.form.sistema.value;
   s.innerHTML = document.form.sistema.options[ document.form.sistema.selectedIndex ].text;
   strAux = '<select name="treinados" class="unnamed1" onClick="t();">\n';
   strAux +=  '<option value=0></optiont>\n';
   for(laco=1; laco <= <?=$qtde?>; laco++) {	   
	   
     if ( id_sistema1[laco] == sistema1) {
       qtre++;
       strAux = strAux +  '<option value = ' + nome[laco] + '>' + nome[laco]+'</option>\n';
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
     document.form.pessoacontatada.value = document.form.treinados.options[ document.form.treinados.selectedIndex ].text;
  }
  
  function vai() {




    if (document.form.sistema.value==0) {
	  window.alert( 'Selecione um sistema');
	  document.form.sistema.focus();
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
	  window.alert( 'Digite a descrição do problema');
	  document.form.descricao.focus();
	  return false;
	}
	
    if (document.form.historico.value=='') {
	  window.alert( 'Digite a descricao da solucao ou encaminhamento.');
	  document.form.historico.focus();
	  return false;
	}
	
	if (document.form.action.value == "encaminhar") {
		if (document.form.destinatario.value==0) {
		  window.alert( 'Selecione para quem será encaminhado o contato');
		  document.form.destinatario.focus();
		  return false;
		}
	}

  	document.form.submit();
	
  }
  
  alteraCombo();

  document.form.pessoacontatada.value = '<?=$objChamado->nomecliente?>';
  
  function teclado() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    vai();
	return false;
  }
  }
  
  
  document.form.categoria.value =  <?= $objChamado->categoria_id ?>;
  
</script>
</body>
</html>
<?php
mysql_free_result($rsUsuarios);
?>
