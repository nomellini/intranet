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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE restricoes SET Ds_Descricao=%s, Ic_ImpedeEncerramentoChamado=%s, Fl_Especial=%s WHERE Id=%s",
                       GetSQLValueString($_POST['Ds_Descricao'], "text"),
                       GetSQLValueString(isset($_POST['Ic_ImpedeEncerramentoChamado']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['Fl_Especial'], "text"),
                       GetSQLValueString($_POST['Id'], "int"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($updateSQL, $sad) or die(mysql_error());

  $updateGoTo = "CadastroRestricoes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM restricoes WHERE Id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($deleteSQL, $sad) or die(mysql_error());

  $deleteGoTo = "CadastroRestricoes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsRestricao = "-1";
if (isset($_GET['id'])) {
  $colname_rsRestricao = $_GET['id'];
}
mysql_select_db($database_sad, $sad);
$query_rsRestricao = sprintf("SELECT * FROM restricoes WHERE Id = %s", GetSQLValueString($colname_rsRestricao, "int"));
$rsRestricao = mysql_query($query_rsRestricao, $sad) or die(mysql_error());
$row_rsRestricao = mysql_fetch_assoc($rsRestricao);
$totalRows_rsRestricao = mysql_num_rows($rsRestricao);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>	
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<p>Editar</p>
<table width="65%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="35%">Id</td>
    <td width="65%"><?php echo $row_rsRestricao['Id']; ?></td>
  </tr>
  <tr>
    <td>Restrição</td>
    <td><label for="Ds_Descricao"></label>
    <input name="Ds_Descricao" type="text" id="Ds_Descricao" value="<?php echo $row_rsRestricao['Ds_Descricao']; ?>" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td>Impede Encerramento de chamado</td>
    <td><input <?php if (!(strcmp($row_rsRestricao['Ic_ImpedeEncerramentoChamado'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="Ic_ImpedeEncerramentoChamado" id="Ic_ImpedeEncerramentoChamado" />
      <label for="Ic_ImpedeEncerramentoChamado"></label></td>
  </tr>
  <tr>
    <td>Especial</td>
    <td><label for="Fl_Especial"></label>
      <input name="Fl_Especial" type="text" id="Fl_Especial" value="<?php echo $row_rsRestricao['Fl_Especial']; ?>" /></td>
  </tr>
</table>
<p>
  <input type="submit" name="button" id="button" value="Gravar" />
  <input name="Id" type="hidden" id="Id" value="<?php echo $row_rsRestricao['Id']; ?>" />
</p>
<input type="hidden" name="MM_update" value="form1" />
</form>
<p>&nbsp;</p>
<p>Excluir</p>
<form id="form2" name="form2" method="post" action="">
  <input type="submit" name="button2" id="button2" value="Submit" />
  <input name="id" type="hidden" id="id" value="<?php echo $row_rsRestricao['Id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsRestricao);
?>
