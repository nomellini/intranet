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

$colname_rcCliente = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_rcCliente = (get_magic_quotes_gpc()) ? $_GET['id_cliente'] : addslashes($_GET['id_cliente']);
}
mysql_select_db($database_sad, $sad);
$query_rcCliente = sprintf("SELECT cliente_id as cliente FROM chamado WHERE cliente_id = %s limit 1", GetSQLValueString($colname_rcCliente, "text"));
$rcCliente = mysql_query($query_rcCliente, $sad) or die(mysql_error());
$row_rcCliente = mysql_fetch_assoc($rcCliente);
$totalRows_rcCliente = mysql_num_rows($rcCliente);

$colname_rsChamados = "-1";
if (isset($_GET['id_cliente'])) {
  $colname_rsChamados = (get_magic_quotes_gpc()) ? $_GET['id_cliente'] : addslashes($_GET['id_cliente']);
}
mysql_select_db($database_sad, $sad);
$query_rsChamados = sprintf("SELECT count(*) as qtde FROM chamado WHERE cliente_id = %s", GetSQLValueString($colname_rsChamados, "text"));
$rsChamados = mysql_query($query_rsChamados, $sad) or die(mysql_error());
$row_rsChamados = mysql_fetch_assoc($rsChamados);
$totalRows_rsChamados = mysql_num_rows($rsChamados);

if ($totalRows_rcCliente==0) {
  $html = $id_cliente . ' não encontrado ';
} else  {
  $html = $row_rcCliente['cliente'] . ' - ' . $row_rsChamados['qtde'] . ' chamados';
} 

if ($totalRows_rcCliente==0) {
?>
  document.form1.id_cliente.value='';
<?
}
?>


div = document.getElementById('nome');
div.innerHTML = '<?php echo $html; ?>';


<?php
mysql_free_result($rcCliente);

mysql_free_result($rsChamados);
?>
