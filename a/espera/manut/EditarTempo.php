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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE sattempos SET tempo=%s WHERE Id=%s",
                       GetSQLValueString($_POST['tampo'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($updateSQL, $sad) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsTempo = "-1";
if (isset($_GET['id'])) {
  $colname_rsTempo = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_sad, $sad);
$query_rsTempo = sprintf("SELECT * FROM sattempos WHERE Id = %s", GetSQLValueString($colname_rsTempo, "int"));
$rsTempo = mysql_query($query_rsTempo, $sad) or die(mysql_error());
$row_rsTempo = mysql_fetch_assoc($rsTempo);
$totalRows_rsTempo = mysql_num_rows($rsTempo);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<table width="342" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="49">Grau</td>
    <td width="286"><?php echo $row_rsTempo['grau']; ?></td>
  </tr>
  <tr>
    <td>Tempo</td>
    <td><label>
      <input name="tampo" type="text" id="tampo" value="<?php echo $row_rsTempo['tempo']; ?>" size="5" maxlength="5" />
    </label> 
      minutos    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Gravar" type="submit" id="Gravar" value="Gravar" /></td>
  </tr>
</table>
<br />
Um cliente grau <?php echo $row_rsTempo['grau']; ?>, ser&aacute; promovido para o grau <?php echo $row_rsTempo['grauDestino']; ?> ap&oacute;s <?php echo $row_rsTempo['tempo']; ?> minutos de espera. <br />
<input name="id" type="hidden" id="id" value="<?php echo $row_rsTempo['Id']; ?>" />
<input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($rsTempo);
?>
