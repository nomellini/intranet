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

$colname_rsUsuario = "-1";
if (isset($_GET['login'])) {
  $colname_rsUsuario = (get_magic_quotes_gpc()) ? $_GET['login'] : addslashes($_GET['login']);
}
mysql_select_db($database_sad, $sad);
$query_rsUsuario = sprintf("SELECT id_usuario, nome, senha FROM usuario WHERE login = %s", GetSQLValueString($colname_rsUsuario, "text"));
$rsUsuario = mysql_query($query_rsUsuario, $sad) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);
?>
<?	require("../scripts/conn.php"); ?>
<?php
$senhamd5 = md5($senha);

if ($totalRows_rsUsuario==1) {
  if ($row_rsUsuario['senha'] == $senhamd5) {
    $html = '<input type="button" name="Button" value="ok" onclick="vai()" />';  
  } else {
     $html = "Senha inválida";
  }
} else {
  $html = "Usuário $login Não Encontrado";
}


?>
div = document.getElementById('nome3');
div.innerHTML = '<?php echo $html; ?>';
<?php
mysql_free_result($rsUsuario);
?>
