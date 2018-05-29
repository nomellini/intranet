<?php require_once('../../../Connections/sad.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO sgq_itens (id_chamado, id_status, id_usuario, dataa, horaa, Resumo, txt_livre1, id_tipoitem, texto1, texto2, prazo1, prazo2, prazo3, prazo4, resp1, resp2, resp3, resp4, orcamento1, dataok1, id_cliente) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_chamado'], "int"),
                       GetSQLValueString($_POST['id_status'], "int"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['dataa'], "text"),
                       GetSQLValueString($_POST['horaa'], "date"),
                       GetSQLValueString($_POST['resumo'], "text"),
                       GetSQLValueString($_POST['auditoria'], "text"),
                       GetSQLValueString($_POST['id_tipoitem'], "int"),
                       GetSQLValueString($_POST['descricao'], "text"),
                       GetSQLValueString($_POST['objetivos'], "text"),
                       GetSQLValueString($_POST['data_acao'], "date"),
                       GetSQLValueString($_POST['data2'], "date"),
                       GetSQLValueString($_POST['data3'], "date"),
                       GetSQLValueString($_POST['data4'], "date"),
                       GetSQLValueString($_POST['resp_acao'], "int"),
                       GetSQLValueString($_POST['select2'], "int"),
                       GetSQLValueString($_POST['select3'], "int"),
                       GetSQLValueString($_POST['select4'], "int"),
                       GetSQLValueString($_POST['valor'], "double"),
                       GetSQLValueString($_POST['data_acao'], "date"),
                       GetSQLValueString($_POST['cliente'], "text"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($insertSQL, $sad) or die(mysql_error());

  $insertGoTo = "../index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

$colname_rsItenAcaoMelhoria = "-1";
if (isset($_GET['id'])) {
  $colname_rsItenAcaoMelhoria = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_sad, $sad);
$query_rsItenAcaoMelhoria = sprintf("SELECT * FROM sgq_itens WHERE id = %s", $colname_rsItenAcaoMelhoria);
$rsItenAcaoMelhoria = mysql_query($query_rsItenAcaoMelhoria, $sad) or die(mysql_error());
$row_rsItenAcaoMelhoria = mysql_fetch_assoc($rsItenAcaoMelhoria);
$totalRows_rsItenAcaoMelhoria = mysql_num_rows($rsItenAcaoMelhoria);

mysql_select_db($database_sad, $sad);
$query_rsCliente = "SELECT id_cliente, cliente FROM cliente ORDER BY cliente ASC";
$rsCliente = mysql_query($query_rsCliente, $sad) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);
$totalRows_rsCliente = mysql_num_rows($rsCliente);
?><?
	require("../scripts/dtmtypes.php");
    require("../../scripts/conn.php");			
				
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header(" ../../Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: ../../index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	
	$nomeusuario=peganomeusuario($ok);

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="../../../Templates/PortalQualidade.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Portal da qualidade</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<style type="text/css">
<!--
.style2 {font-size: 10px}
-->
</style>
<style type="text/css">
<!--
.style3 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
.style5 {font-size: 14px}
-->
</style>
<!-- InstanceEndEditable -->
<link href="../attendere.css" rel="stylesheet" type="text/css" />
</head>

<body background="../../../imagens/fundo.gif">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="72" background="../imagens/portalqualidade.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td height="32" align="left" valign="top"><!-- InstanceBeginEditable name="Central" -->
<form id="form1" name="form1" method="POST">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="50%">Usuário:<strong>
        <?=$nomeusuario?>
        </strong>        </td>
        <td width="50%">&nbsp;</td>
      </tr>
    </table>
	
	<span class="style1">Abertura de a&ccedil;&atilde;o de melhoria:<br />
        <span class="style2">Preencha os campos abaixo para abrir uma nova a&ccedil;&atilde;o de melhoria.</span></span>
    <table width="99%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="2" class="TituloSubitem"><span class="style5"><strong>Dados iniciais </strong></span></td>
        </tr>
      <tr>
        <td width="18%" class="Subitem style5">Cliente</td>
        <td width="82%" class="Subitem"><label>
        <select name="cliente" class="borda_fina" id="cliente">
          <option value="0">Selecione</option>
          <?php
do {  
?><option value="<?php echo $row_rsCliente['id_cliente']?>"><?php echo $row_rsCliente['cliente']?></option>
          <?php
} while ($row_rsCliente = mysql_fetch_assoc($rsCliente));
  $rows = mysql_num_rows($rsCliente);
  if($rows > 0) {
      mysql_data_seek($rsCliente, 0);
	  $row_rsCliente = mysql_fetch_assoc($rsCliente);
  }
?>
        </select>
        </label></td>
      </tr>
      <tr>
        <td class="Subitem style5">Chamado</td>
        <td class="Subitem"><label>
          <input name="id_chamado" type="text" class="bordaTexto" id="id_chamado" size="15" maxlength="15" />
        </label></td>
      </tr>
      <tr>
        <td class="Subitem style5">Auditoria</td>
        <td class="Subitem"><label>
          <input name="auditoria" type="text" class="bordaTexto" id="auditoria" size="20" maxlength="20" />
        </label></td>
      </tr>
      <tr>
        <td class="style5 Subitem"><strong>Resumo * </strong></td>
        <td class="Subitem"><label>
          <input name="resumo" type="text" class="bordaTexto" id="resumo" size="50" maxlength="50" />
        </label></td>
      </tr>
    </table>
    <table width="99%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="4" class="TituloSubitem"><span class="style3">Descri&ccedil;&atilde;o e objetivos </span></td>
        </tr>
      <tr>
        <td width="18%" valign="top" class="Subitem style5">Descri&ccedil;&atilde;o da a&ccedil;&atilde;o * </td>
        <td colspan="3" valign="top" class="Subitem"><label>
          <textarea name="descricao" cols="100" rows="6" class="bordaTexto" id="descricao"></textarea>
        </label></td>
        </tr>
      <tr>
        <td valign="top" class="Subitem style5">Objetivos * </td>
        <td colspan="3" valign="top" class="Subitem"><label>
          <textarea name="objetivos" cols="100" rows="6" class="bordaTexto" id="objetivos"></textarea>
        </label></td>
        </tr>
      <tr>
        <td colspan="4" class="TituloSubitem"><span class="style3">Responsabilidades</span></td>
        </tr>
      <tr>
        <td valign="top" class="Subitem style5">A&ccedil;&atilde;o</td>
        <td width="31%" valign="top" class="Subitem"><label></label>
          <label>
          <select name="resp_acao" class="bordaTexto" id="resp_acao">
            <option value="0">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsUsuarios['id_usuario']?>"><?php echo $row_rsUsuarios['nome']?></option>
<?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
          </select>
          *</label></td>
        <td width="9%" valign="top" class="Subitem style5">Data Limite </td>
        <td width="42%" valign="top" class="Subitem"><label>
          <input name="data_acao" type="text" class="bordaTexto" id="data_acao" />
        *</label></td>
      </tr>
      <tr>
        <td valign="top" class="Subitem style5">Aprova&ccedil;&atilde;o or&ccedil;amento </td>
        <td valign="top" class="Subitem"><label> Valor R$
            <input name="valor" type="text" class="bordaTexto" id="valor" />
            <br />
<select name="select2" class="bordaTexto">
            <option value="0">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsUsuarios['id_usuario']?>"><?php echo $row_rsUsuarios['nome']?></option>
<?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
          </select>
        </label></td>
        <td valign="top" class="Subitem style5">Data Limite </td>
        <td valign="top" class="Subitem"><label>
          <input name="data2" type="text" class="bordaTexto" id="data2" />
        </label></td>
      </tr>
      <tr>
        <td valign="top" class="Subitem style5">Verifica&ccedil;&atilde;o </td>
        <td valign="top" class="Subitem"><label>
          <select name="select3" class="bordaTexto">
            <option value="0">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsUsuarios['id_usuario']?>"><?php echo $row_rsUsuarios['nome']?></option>
<?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
          </select>
        </label></td>
        <td valign="top" class="Subitem style5">Data Limite </td>
        <td valign="top" class="Subitem"><label>
          <input name="data3" type="text" class="bordaTexto" id="data3" />
        </label></td>
      </tr>
      <tr>
        <td valign="top" class="Subitem style5">Encerramento</td>
        <td valign="top" class="Subitem"><label>
          <select name="select4" class="bordaTexto">
            <option value="0">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsUsuarios['id_usuario']?>"><?php echo $row_rsUsuarios['nome']?></option>
            <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
          </select>
        </label></td>
        <td valign="top" class="Subitem style5">Data Limite </td>
        <td valign="top" class="Subitem"><label>
          <input name="data4" type="text" class="bordaTexto" id="data4" />
        </label></td>
      </tr>

      <tr>
        <td valign="top" class="Subitem">&nbsp;</td>
        <td colspan="3" valign="top" class="Subitem"><input type="button" name="Button" value="Gravar" onclick="vai();" />
          <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$ok?>" />
          <input name="id_status" type="hidden" id="id_status" value="<?=constant('STATUS_MEL_ABERTO')?>" />
          <input name="id_tipoitem" type="hidden" id="id_tipoitem" value="<?=constant('TIPO_ITEM_ACAO_MELHORIA')?>" />
          <input value="<?=date('Y-m-d')?>" name="dataa" type="hidden" id="dataa" />
          <input value="<?=date('h:i:s')?>"  name="horaa" type="hidden" id="horaa" /></td>
        </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1">
</form>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="19" align="left" valign="top">
      <br />
      <a href="javascript:history.go(-1);">
        voltar      </a>
      <hr />
	<font color="#999999" size="1">Datamace Inform&aacute;tica 
    2006
    </font></td>
  </tr>
</table>
<blockquote>&nbsp;</blockquote>
</body><!-- InstanceEnd --></html>
<?php
mysql_free_result($rsUsuarios);

mysql_free_result($rsItenAcaoMelhoria);

mysql_free_result($rsCliente);
?>
<script>
  function vai() {
  
    var campo;
	var d;
	
	campo = document.form1.resumo;
	if (campo.value =='') {
	  window.alert("Campo resumo é obrigatório");
	  campo.focus();
	  return false;
	}


	campo = document.form1.descricao;
	if (campo.value =='') {
	  window.alert("A Descrição é obrigatória");
	  campo.focus();
	  return false;
	}

	campo = document.form1.objetivos;
	if (campo.value =='') {
	  window.alert("Objetivos deve ser preenchido");
	  campo.focus();
	  return false;
	}
	
    if (document.form1.resp_acao.value==0) {
	  window.alert("Selecine o responsável pela ação");
	  document.form1.resp_acao.focus();
	  return false;
	}

    if (document.form1.data_acao.value==0) {
	  window.alert("Digite a data limite");
	  document.form1.data_acao.focus();
	  return false;
	}
  
  	campo = document.form1.data_acao;
    d =  campo.value.split("/");
	campo.value = d[2] + "-" + d[1] + "-" + d[0];

  	campo = document.form1.data2;
    d =  campo.value.split("/");
	campo.value = d[2] + "-" + d[1] + "-" + d[0];
	
	
	
	document.form1.submit();
  }
</script>
