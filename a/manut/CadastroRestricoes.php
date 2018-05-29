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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO restricoes (Ds_Descricao, Ic_ImpedeEncerramentoChamado, Fl_Especial) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Ds_Descricao'], "text"),
                       GetSQLValueString(isset($_POST['Ic_ImpedeEncerramentoChamado']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['Fl_Especial'], "text"));

  mysql_select_db($database_sad, $sad);
  $Result1 = mysql_query($insertSQL, $sad) or die(mysql_error());

  $insertGoTo = "CadastroRestricoes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_sad, $sad);
$query_rsRestricoes = "SELECT * FROM restricoes ORDER BY Ds_Descricao ASC";
$rsRestricoes = mysql_query($query_rsRestricoes, $sad) or die(mysql_error());
$row_rsRestricoes = mysql_fetch_assoc($rsRestricoes);
$totalRows_rsRestricoes = mysql_num_rows($rsRestricoes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Cadastro de restrições para o SAD</p>
<form id="form1" name="form1" method="post" action="">
<table width="65%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="12%">Id</td>
    <td width="52%">Restrição</td>
    <td width="26%"><p>Impede Encerramento</p></td>
    <td width="10%"><p>Tipo</p></td>
  </tr>
    <?php do { ?>
      <tr>
      <td><a href="EditarRestricao.php?id=<?php echo $row_rsRestricoes['Id']; ?>"><?php echo $row_rsRestricoes['Id']; ?></a></td>
      <td><?php echo $row_rsRestricoes['Ds_Descricao']; ?></td>
      <td>
        <input <?php if (!(strcmp($row_rsRestricoes['Ic_ImpedeEncerramentoChamado'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="checkbox" id="checkbox" />
        <label for="checkbox"></label>
      </td>
      <td><?php echo $row_rsRestricoes['Fl_Especial']; ?></td>
  </tr>      
      <?php } while ($row_rsRestricoes = mysql_fetch_assoc($rsRestricoes)); ?>
</table>
    </form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr />
<form id="form2" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>Nova Restrição</p>
  <table width="65%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="35%">Restrição</td>
      <td width="65%"><label for="Ds_Descricao"></label>
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
  </p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsRestricoes);
?>
