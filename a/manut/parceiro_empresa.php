<?php require_once('../../Connections/sad.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario_empresa (id_usuario, id_cliente) VALUES (%s, %s)",
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['id_empresa'], "text"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($insertSQL, $sad) or die(mysql_error());

  $insertGoTo = "parceiro_empresa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$idcliente_rsEmpresas = "-1";
if (isset($_GET['id_usuario'])) {
  $idcliente_rsEmpresas = (get_magic_quotes_gpc()) ? $_GET['id_usuario'] : addslashes($_GET['id_usuario']);
}
mysql_select_db($database_sad, $sad);
$query_rsEmpresas = sprintf("SELECT ue.id, c.id_cliente, c.cliente, c.senha FROM usuario u     inner join usuario_empresa ue on ue.id_usuario = u.id_usuario     inner join cliente c on c.id_cliente = ue.id_cliente WHERE u.id_usuario = %s", GetSQLValueString($idcliente_rsEmpresas, "int"));
$rsEmpresas = mysql_query($query_rsEmpresas, $sad) or die(mysql_error());
$row_rsEmpresas = mysql_fetch_assoc($rsEmpresas);
$totalRows_rsEmpresas = mysql_num_rows($rsEmpresas);

mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, senha, cliente, id_cliente, ' - ', cliente as nome FROM cliente ORDER BY cliente";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);

$colname_rsUsuario = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_rsUsuario = (get_magic_quotes_gpc()) ? $_GET['id_usuario'] : addslashes($_GET['id_usuario']);
}
mysql_select_db($database_sad, $sad);
$query_rsUsuario = sprintf("SELECT id_usuario, nome, ativo, login FROM usuario WHERE id_usuario = %s", GetSQLValueString($colname_rsUsuario, "int"));
$rsUsuario = mysql_query($query_rsUsuario, $sad) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista clientes</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="menu">
  <a href="parceiros.php">Voltar ao início</a></div>
<p>Lista de empresas cadastradas para o usu&aacute;rio <strong><?php echo $row_rsUsuario['nome']; ?></strong> ( 
  <?php echo $row_rsUsuario['login']; ?>)</p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <?php do { ?>
    <tr>
      <td><a href="parceiro_deletar.php?id_usuario=<?php echo $row_rsUsuario['id_usuario']; ?>&id=<?php echo $row_rsEmpresas['id']; ?>">XXX</a> <?php echo $row_rsEmpresas['id_cliente']; ?> / <?php echo $row_rsEmpresas['cliente']; ?> (<?php echo $row_rsEmpresas['senha']; ?>) </td>
    </tr>
    <?php } while ($row_rsEmpresas = mysql_fetch_assoc($rsEmpresas)); ?>
</table>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>Inserir uma empresa para este usu&aacute;rio:<br />
    <label>
        <select name="id_empresa" id="id_empresa">
          <?php
do {  
?>
          <option value="<?php echo $row_rsClientes['id_cliente']?>"><?php echo $row_rsClientes['cliente']?></option>
          <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
    </select>
    </label>
      <label>
      <input type="submit" name="Submit" value="Adicionar" />
      </label>
    <br />  
    <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $row_rsUsuario['id_usuario']; ?>" />
</p>
    <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEmpresas);

mysql_free_result($rsClientes);

mysql_free_result($rsUsuario);
?>
