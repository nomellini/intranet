<?
    require("scripts/conn.php");		
    require("scripts/cores.php");				
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE mydesktop SET id_usuario=%s, tradicional=%s, novo=%s, exibirchamadosempastas=%s, prioridade=%s, sistema=%s, cliente=%s, encaminhados=%s, novidade=%s, pastas=%s, novoacima=%s, Ic_MeusChamadosDesktop=%s WHERE id=%s",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString(isset($_POST['tradicional']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['novo']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['chamadosempastas']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['prioridade']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['sistema']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['cliente']) ? "true" : "", "defined","1","0"),					   
                       GetSQLValueString(isset($_POST['encaminhados']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['novidades']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['pastas']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['novoacima']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['Ic_MeusChamadosDesktop']) ? "true" : "", "defined","1","0"),					   
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($updateSQL, $sad) or die(mysql_error());

  $updateGoTo = "inicio.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsMyDesktop = "-1";
if (isset($_GET['ok'])) {
  $colname_rsMyDesktop = (get_magic_quotes_gpc()) ? $_GET['ok'] : addslashes($_GET['ok']);
}
mysql_select_db($database_sad, $sad);
$query_rsMyDesktop = sprintf("SELECT * FROM mydesktop WHERE id_usuario = %s", GetSQLValueString($colname_rsMyDesktop, "int"));
$rsMyDesktop = mysql_query($query_rsMyDesktop, $sad) or die(mysql_error());
$row_rsMyDesktop = mysql_fetch_assoc($rsMyDesktop);
$totalRows_rsMyDesktop = mysql_num_rows($rsMyDesktop);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prefer&ecirc;ncias de Desktop</title>
<style type="text/css">
<!--
body {
	background-image: url(../agenda/figuras/fundo.gif);
}
-->
</style>
</head>
<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td><input <?php if (!(strcmp($row_rsMyDesktop['tradicional'],1))) {echo "checked=\"checked\"";} ?> name="tradicional" type="checkbox" id="tradicional" value="1" />
        Desktop tradicional </td>
    </tr>
    <tr>
      <td height="26"><input <?php if (!(strcmp($row_rsMyDesktop['exibirchamadosempastas'],1))) {echo "checked=\"checked\"";} ?> name="chamadosempastas" type="checkbox" id="chamadosempastas" value="checkbox"  />
        Excluir da exibi&ccedil;&atilde;o do desktop tradicional os chamados inclu&iacute;dos em pastas </td>
    </tr>
    <tr>
      <td><input <?php if (!(strcmp($row_rsMyDesktop['novo'],1))) {echo "checked=\"checked\"";} ?> name="novo" type="checkbox" id="novo" value="1" />
        Novo desktop categorizado </td>
    </tr>
    <tr>
      <td><blockquote>
          <input <?php if (!(strcmp($row_rsMyDesktop['prioridade'],1))) {echo "checked=\"checked\"";} ?> name="prioridade" type="checkbox" id="prioridade" value="1" />
          Por prioridade<br />
          <input <?php if (!(strcmp($row_rsMyDesktop['sistema'],1))) {echo "checked=\"checked\"";} ?> name="sistema" type="checkbox" id="sistema" value="1" />
          Por Sistema <br />
          <input <?php if (!(strcmp($row_rsMyDesktop['cliente'],1))) {echo "checked=\"checked\"";} ?> name="cliente" type="checkbox" id="sistema" value="1" />
          Por Cliente <img src="../imagens/novo.gif" width="45" height="15" align="absmiddle" /><br />		  
          <input <?php if (!(strcmp($row_rsMyDesktop['encaminhados'],1))) {echo "checked=\"checked\"";} ?> name="encaminhados" type="checkbox" id="encaminhados" value="1" />
          Encaminhados <br />
          <input <?php if (!(strcmp($row_rsMyDesktop['novidade'],1))) {echo "checked=\"checked\"";} ?> name="novidades" type="checkbox" id="novidades" value="1" />
          Com contatos não lidos<br />
          <input <?php if (!(strcmp($row_rsMyDesktop['pastas'],1))) {echo "checked=\"checked\"";} ?> name="pastas" type="checkbox" id="pastas" value="1" />
          Por pastas<br />
        </blockquote></td>
    </tr>
    <tr>
      <td height="26"><label>
        <input <?php if (!(strcmp($row_rsMyDesktop['novoacima'],1))) {echo "checked=\"checked\"";} ?> name="novoacima" type="checkbox" id="novoacima" value="1" disabled="disabled" />
        Quero o novo desktop acima do tradicional</label></td>
    </tr>
    <tr>
      <td height="26"><label>
        <input <?php if (!(strcmp($row_rsMyDesktop['Ic_MeusChamadosDesktop'],1))) {echo "checked=\"checked\"";} ?> name="Ic_MeusChamadosDesktop" type="checkbox" id="Ic_MeusChamadosDesktop" value="1"  />
        Exibir no meu desktop chamados que eu abri e não estão comigo</label></td>
    </tr>
    <tr>
      <td height="26"><label>
        <input type="submit" name="Submit" value="Submit" />
        <input name="id" type="hidden" id="id" value="<?php echo $row_rsMyDesktop['id']; ?>" />
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_rsMyDesktop['id_usuario']; ?>" />
        </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($rsMyDesktop);
?>
