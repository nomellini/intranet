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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuario_empresa WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($deleteSQL, $sad) or die(mysql_error());

  $deleteGoTo = "parceiro_empresa.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_dsUsuario = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_dsUsuario = (get_magic_quotes_gpc()) ? $_GET['id_usuario'] : addslashes($_GET['id_usuario']);
}
mysql_select_db($database_sad, $sad);
$query_dsUsuario = sprintf("SELECT id_usuario, nome FROM usuario WHERE id_usuario = %s", GetSQLValueString($colname_dsUsuario, "int"));
$dsUsuario = mysql_query($query_dsUsuario, $sad) or die(mysql_error());
$row_dsUsuario = mysql_fetch_assoc($dsUsuario);
$totalRows_dsUsuario = mysql_num_rows($dsUsuario);

$colname_dsCliente = "-1";
if (isset($_GET['id'])) {
  $colname_dsCliente = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_sad, $sad);
$query_dsCliente = sprintf("SELECT id_cliente, cliente FROM cliente WHERE id_cliente = %s", GetSQLValueString($colname_dsCliente, "text"));
$dsCliente = mysql_query($query_dsCliente, $sad) or die(mysql_error());
$row_dsCliente = mysql_fetch_assoc($dsCliente);
$totalRows_dsCliente = mysql_num_rows($dsCliente);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Deletar Empresa Parceiro</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>Confirme para deletar o Cliente <?php echo $row_dsCliente['cliente']; ?> do usu&aacute;rio <?php echo $row_dsUsuario['id_usuario']; ?></p>
  <p>
    <input name="id_cliente" type="hidden" id="id_cliente" value="<?php echo $_GET['id']; ?>" />
    <input name="id_usuario" type="hidden" id="id_usuario" value="<?php echo $_GET['id_usuario']; ?>" />
    <label>
    <input type="submit" name="Submit" value="Confirmar" />
    </label>
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($dsUsuario);

mysql_free_result($dsCliente);
?>
