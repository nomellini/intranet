<?php require_once('../../Connections/sad.php'); ?>
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

$colname1_rsUsuario = "-1";
if (isset($_POST['pesquisa'])) {
  $colname1_rsUsuario = (get_magic_quotes_gpc()) ? $_POST['pesquisa'] : addslashes($_POST['pesquisa']);
}
$colname2_rsUsuario = "-1";
if (isset($_POST['pesquisa'])) {
  $colname2_rsUsuario = (get_magic_quotes_gpc()) ? $_POST['pesquisa'] : addslashes($_POST['pesquisa']);
}
mysql_select_db($database_sad, $sad);
$query_rsUsuario = sprintf("SELECT id_usuario, nome, login FROM usuario WHERE (nome like CONCAT('%%', %s, '%%') or   login like CONCAT('%%', %s, '%%')) ORDER BY nome ASC", GetSQLValueString($colname1_rsUsuario, "text"),GetSQLValueString($colname2_rsUsuario, "text"));
$rsUsuario = mysql_query($query_rsUsuario, $sad) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manuten&ccedil;&atilde;o parceiros</title>
<style type="text/css">
<!--
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }

-->
</style>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>


<form id="form1" name="form1" method="post" action="">
1. Pesquise pelo nome ou login do usu&aacute;rio do SAD e selecione o usu&aacute;rio desejado. <br />
  <label>Nome
  <input name="pesquisa" type="text" id="pesquisa" />
  </label> 
  <label>
  <input name="Pesquisar" type="submit" id="Pesquisar" value="Pesquisar" />
  </label>
  <input name="acao" type="hidden" id="acao" value="pesquisar" />
</form>
<table width="77%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="10%">ID</td>
    <td width="10%">Login</td>
    <td width="80%">Nome</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsUsuario['id_usuario']; ?></td>
      <td><?php echo $row_rsUsuario['login']; ?></td>
      <td><a href="parceiro_empresa.php?id_usuario=<?php echo $row_rsUsuario['id_usuario']; ?>"><?php echo $row_rsUsuario['nome']; ?></a></td>
    </tr>
    <?php } while ($row_rsUsuario = mysql_fetch_assoc($rsUsuario)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsuario);
?>
