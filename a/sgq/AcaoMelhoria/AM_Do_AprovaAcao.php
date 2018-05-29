<? require("../scripts/dtmtypes.php");?>
<? require("../../scripts/conn.php");?>
<?

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
	if ($ok  == $row_rsItem['resp1']) {
	  $podeAssinarAcao = true;
	}
?>
<?
  /*
    Data : 21/03/2006
	Autor: Fernando
	Objetivos: Este arquivo deve validar a senha do usuário que aprovou 
	           a ação de melhoria e colocar o item com status de aguardando
			   aprovação de orçamento.
  */
  
  $id_item = $_POST["id_item"];
  $Descricao = QuotedStr($_POST["texto1"]);
  $Objetivos = QuotedStr($_POST["texto2"]);
  $Status = constant('STATUS_MEL_AG_ORCAMENTO');
  $senha = QuotedStr(md5( $_POST["senha1"] ));
  
  $sql = "select count(*) from usuario where id_usuario = $ok and senha = $senha";
  $result = mysql_query($sql) or die (mysql_error());
  $linha = mysql_fetch_array($result) or die (mysql_error());
  if ($linha[0] == 0) {
    $mensagem = "Senha não confere. Volte e tente novamente";
  } else {
    $sql = "update sgq_itens set ";
	$sql .= "texto1 = $Descricao, ";
	$sql .= "texto2 = $Objetivos, ";
	$sql .= "id_status = $Status, ";
	$sql .= "aprovado1 = $ok, ";
	$sql .= "dataok1 = " . QuotedStr( date('Y-m-d h:i:s') );
	$sql .= " where id = $id_item";
	mysql_query ($sql) or die (mysql_error());	
	header('Location: ../index.php');
  }
  
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
.style1 {font-size: 16px}
-->
</style>
<style type="text/css">
<!--
.style2 {font-size: 16}
-->
</style>
<style type="text/css">
<!--
.style3 {color: #FF0000}
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
    <p><br /><br />
	  <span class="style2 style1 style3"><strong><?=$mensagem?>
	  </strong></span></p>
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
</body>
<!-- InstanceEnd --></html>
