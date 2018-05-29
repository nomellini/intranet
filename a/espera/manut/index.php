<?php require_once('../../../Connections/sad.php'); ?>
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

mysql_select_db($database_sad, $sad);
$query_rsTempos = "SELECT * FROM sattempos";
$rsTempos = mysql_query($query_rsTempos, $sad) or die(mysql_error());
$row_rsTempos = mysql_fetch_assoc($rsTempos);
$totalRows_rsTempos = mysql_num_rows($rsTempos);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LIstaGraus</title>
</head>

<body>
<p>Tempos m&aacute;ximos de espera e promo&ccedil;&atilde;o de grau;</p>
<table width="527" border="1">
  <tr>
    <td>Editar</td>
    <td>Grau</td>
    <td>Tempo M&aacute;ximo (minutos) </td>
    <td>Promo&ccedil;&atilde;o</td>
  </tr>
    <?php do { ?>
	  <tr>	
      <td><p><a href="EditarTempo.php?id=<?php echo $row_rsTempos['Id']; ?>">Editar</a></p></td>
      <td><?php echo $row_rsTempos['grau']; ?></td>
      <td><?php echo $row_rsTempos['tempo']; ?></td>
      <td><?php echo $row_rsTempos['grauDestino']; ?></td>
	  </tr>
      <?php } while ($row_rsTempos = mysql_fetch_assoc($rsTempos)); ?>
</table>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsTempos);
?>
