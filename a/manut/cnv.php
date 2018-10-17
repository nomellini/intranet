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

mysql_select_db($database_sad, $sad);
$query_rsChamadosNaoVisiveis = "SELECT c.id_chamado, sis.sistema,  	Left(c.descricao, 80) descricao,  c.dataa,  	cat.categoria FROM chamado c 		left join categoria cat on cat.id_categoria = c.categoria_id 		left join sistema sis on sis.id_sistema = c.sistema_id WHERE visible = 0 ORDER BY sis.sistema, c.id_chamado ";
$rsChamadosNaoVisiveis = mysql_query($query_rsChamadosNaoVisiveis, $sad) or die(mysql_error());
$row_rsChamadosNaoVisiveis = mysql_fetch_assoc($rsChamadosNaoVisiveis);
$totalRows_rsChamadosNaoVisiveis = mysql_num_rows($rsChamadosNaoVisiveis);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../cssSAD.css" rel="stylesheet" type="text/css" />
</head>

<body>

<fieldset class="FieldSetChamados">
<legend>Chamados invisíveis</legend>
<div class="ListaChamados">
<form action="cnv.php" method="post" name="form1">
  <table width="97%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td bgcolor="#FFFFFF">Ch</td>
      <td bgcolor="#FFFFFF">Id</td>
      <td bgcolor="#FFFFFF">Chamado</td>
      <td bgcolor="#FFFFFF">Descri&ccedil;&atilde;o</td>
    </tr>
    <?php do { ?>
      <tr>
        <td height="16" bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><?php echo $row_rsChamadosNaoVisiveis['sistema']; ?></td>
        <td bgcolor="#FFFFFF"><a href="ec.php?acao=ver&id=<?php echo $row_rsChamadosNaoVisiveis['id_chamado']; ?>"> <?php echo $row_rsChamadosNaoVisiveis['id_chamado']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_rsChamadosNaoVisiveis['descricao']; ?></td>
      </tr>
      <?php } while ($row_rsChamadosNaoVisiveis = mysql_fetch_assoc($rsChamadosNaoVisiveis)); ?>
  </table>
</form>
</div>
</fieldset>

</body>
</html>
<?php
mysql_free_result($rsChamadosNaoVisiveis);
?>
