<?php require_once('../scripts/conn.php'); ?>
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

$query_rcCliente = sprintf("SELECT cliente_id FROM chamado WHERE cliente_id = %s limit 1", GetSQLValueString($colname_rcCliente, "text"));
$rcCliente = mysql_query($query_rcCliente) or die(mysql_error());
$row_rcCliente = mysql_fetch_assoc($rcCliente);
$totalRows_rcCliente = mysql_num_rows($rcCliente);

if ($totalRows_rcCliente==0) {
  $html = $id_cliente . ' não encontrado - Tudo OK ';
} else  {
  $html = $row_rcCliente['cliente_id'] . ' Já existe. Seleciono outro ID';
} 

if ($totalRows_rcCliente>0) {
?>
  document.form1.novo_id.value='';
<?
}
?>


div = document.getElementById('nome2');
div.innerHTML = '<?php echo $html; ?>';


<?php
mysql_free_result($rcCliente);
?>
