<?
  require("../scripts/conn.php");
  
  if (($idUsuario) and ($idRestricao) and ($action == 'ExcluirManut')) {
    $sql = "delete from rl_restricao_manut where id_usuario=$idUsuario and id_restricao=$idRestricao";
	mysql_query( $sql);
  }
  
  if (($idUsuario) and ($idRestricao) and ($action == 'addrm')) {
    $sql = "insert into rl_restricao_manut (id_usuario, id_restricao) values ($idUsuario, $idRestricao)";
	mysql_query( $sql);
  }
  
  if (($idUsuario2) and ($idRestricao2) and ($action == 'ExcluirMarcar')) {
    $sql = "delete from rl_restricao_marcar where id_Usuario=$idUsuario2 and id_Restricao=$idRestricao2";
	mysql_query( $sql);
	echo $sql;
  }  
  
  if (($idUsuario2) and ($idRestricao2) and ($action == 'addru')) {
    $sql = "insert into rl_restricao_marcar (id_Usuario, id_Restricao) values ($idUsuario2, $idRestricao2)";
	mysql_query( $sql);
  }

?>
<?php require_once('../../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
$query_rsUsuario = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuario = mysql_query($query_rsUsuario, $sad) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);

mysql_select_db($database_sad, $sad);
$query_rsListaRelManut = "SELECT distinct id_restricao, u.id_usuario, u.nome,  res.Ds_Descricao FROM rl_restricao_manut r inner join usuario u on u.id_usuario = r.Id_Usuario inner join restricoes res on res.Id = r.Id_Restricao ORDER BY u.nome, res.ds_descricao";
$rsListaRelManut = mysql_query($query_rsListaRelManut, $sad) or die(mysql_error());
$row_rsListaRelManut = mysql_fetch_assoc($rsListaRelManut);
$totalRows_rsListaRelManut = mysql_num_rows($rsListaRelManut);

mysql_select_db($database_sad, $sad);
$query_rsRestricoes = "SELECT Id, Ds_Descricao FROM restricoes ORDER BY Ds_Descricao ASC";
$rsRestricoes = mysql_query($query_rsRestricoes, $sad) or die(mysql_error());
$row_rsRestricoes = mysql_fetch_assoc($rsRestricoes);
$totalRows_rsRestricoes = mysql_num_rows($rsRestricoes);

mysql_select_db($database_sad, $sad);
$query_rsListaRelMarcar = "SELECT distinct id_Restricao, u.id_usuario, u.nome,  res.Ds_Descricao FROM rl_restricao_marcar r inner join usuario u on u.id_usuario = r.Id_Usuario inner join restricoes res on res.Id = r.Id_Restricao ORDER BY u.nome, res.ds_descricao";
$rsListaRelMarcar = mysql_query($query_rsListaRelMarcar, $sad) or die(mysql_error());
$row_rsListaRelMarcar = mysql_fetch_assoc($rsListaRelMarcar);
$totalRows_rsListaRelMarcar = mysql_num_rows($rsListaRelMarcar);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../attendere.css" rel="stylesheet" type="text/css" />
</head>

<body>
<label for="select2"></label>
<hr />
<form id="form1" name="form1" method="post" action="RelacionaRestricaoPessoa.php">
<p>Quem pode determinar restri&ccedil;&otilde;es em chamados:</p>
<table border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>Excluir</td>
    <td>Nome</td>
    <td>Restri&ccedil;&atilde;o</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><p><a href="javascript:;" onClick="document.form1.action.value='ExcluirManut';document.form1.idUsuario.value=<?php echo $row_rsListaRelManut['id_usuario']; ?>;document.form1.idRestricao.value=<?php echo $row_rsListaRelManut['id_restricao']; ?>;document.form1.submit();">Excluir</a></p></td>
      <td><?php echo $row_rsListaRelManut['nome']; ?></td>
      <td><?php echo $row_rsListaRelManut['Ds_Descricao']; ?></td>
    </tr>
    <?php } while ($row_rsListaRelManut = mysql_fetch_assoc($rsListaRelManut)); ?>
</table>
<p>Para adicionar, selecione um nome:
  <label for="idUsuario"></label>
  <select name="idUsuario" class="botao_fino" id="idUsuario">
    <option value="-">Selecione</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsUsuario['id_usuario']?>"><?php echo $row_rsUsuario['nome']?></option>
    <?php
} while ($row_rsUsuario = mysql_fetch_assoc($rsUsuario));
  $rows = mysql_num_rows($rsUsuario);
  if($rows > 0) {
      mysql_data_seek($rsUsuario, 0);
	  $row_rsUsuario = mysql_fetch_assoc($rsUsuario);
  }
?>
  </select>
, uma Retsri&ccedil;&atilde;o: 
<select name="idRestricao" class="botao_fino" id="idRestricao">
  <option value="0">Selecione</option>
  <?php
do {  
?>
  <option value="<?php echo $row_rsRestricoes['Id']?>"><?php echo $row_rsRestricoes['Ds_Descricao']?></option>
  <?php
} while ($row_rsRestricoes = mysql_fetch_assoc($rsRestricoes));
  $rows = mysql_num_rows($rsRestricoes);
  if($rows > 0) {
      mysql_data_seek($rsRestricoes, 0);
	  $row_rsRestricoes = mysql_fetch_assoc($rsRestricoes);
  }
?>
</select>
clique em
<input name="Button" type="button" class="botao_fino" id="button" value="Adicionar" onClick="document.form1.action.value='addrm';document.form1.submit();">
  <br>
  <input name="action" type="hidden" id="action" value="-">
  </p>
<hr>
<p>Relacionar quem pode indicar restri&ccedil;&atilde;o conclu&iacute;da:</p>
<table border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>Excluir</td>
    <td>Nome</td>
    <td>Restri&ccedil;&atilde;o</td>
  </tr>

  <?php do { ?>
    <tr>
      <td><p><a href="javascript:;" onClick="document.form1.action.value='ExcluirMarcar';document.form1.idUsuario2.value=<?php echo $row_rsListaRelMarcar['id_usuario']; ?>;document.form1.idRestricao2.value=<?php echo $row_rsListaRelMarcar['id_Restricao']; ?>;document.form1.submit();">Excluir</a></p></td>
      <td><?php echo $row_rsListaRelMarcar['nome']; ?></td>
      <td><?php echo $row_rsListaRelMarcar['Ds_Descricao']; ?></td>
    </tr>
    <?php } while ($row_rsListaRelMarcar = mysql_fetch_assoc($rsListaRelMarcar)); ?>
</table>
<br>
<table width="65%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Excluir</td>
    <td>Nome</td>
    <td><p>Restri&ccedil;&atilde;o</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>Para adicionar, selecione um nome:
  <label for="idUsuario2"></label>
  <select name="idUsuario2" class="botao_fino" id="idUsuario2">
    <option value="-">Selecione</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsUsuario['id_usuario']?>"><?php echo $row_rsUsuario['nome']?></option>
    <?php
} while ($row_rsUsuario = mysql_fetch_assoc($rsUsuario));
  $rows = mysql_num_rows($rsUsuario);
  if($rows > 0) {
      mysql_data_seek($rsUsuario, 0);
	  $row_rsUsuario = mysql_fetch_assoc($rsUsuario);
  }
?>
  </select>
, uma Retsri&ccedil;&atilde;o:
<select name="idRestricao2" class="botao_fino" id="idRestricao2">
  <option value="0">Selecione</option>
  <?php
do {  
?>
  <option value="<?php echo $row_rsRestricoes['Id']?>"><?php echo $row_rsRestricoes['Ds_Descricao']?></option>
  <?php
} while ($row_rsRestricoes = mysql_fetch_assoc($rsRestricoes));
  $rows = mysql_num_rows($rsRestricoes);
  if($rows > 0) {
      mysql_data_seek($rsRestricoes, 0);
	  $row_rsRestricoes = mysql_fetch_assoc($rsRestricoes);
  }
?>
</select>
clique em
<input name="button" type="button" class="botao_fino" id="button2" value="Adicionar" onClick="document.form1.action.value='addru';document.form1.submit();">
</p>
<p>&nbsp; </p>

</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsuario);
mysql_free_result($rsRestricoes);

mysql_free_result($rsListaRelMarcar);
mysql_free_result($rsListaRelManut);
?>
