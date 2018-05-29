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
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 and area=2 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><form name="form1" method="post" action="abreChamado.php">
  <p>Descri&ccedil;&atilde;o do Chamado<br>
    <textarea name="Chamado" cols="80" rows="5" id="Chamado"></textarea>
    </p>
  <p>Texto do Contato<br>
    <textarea name="Contato" cols="80" rows="5" id="Contato">Segue</textarea>
    <br>
    <br>
Destinat&aacute;ro<br>
<label>
  <select name="Destinatario" id="Destinatario">
    <?php
do {  
?>
    <option value="<?php echo $row_rsUsuarios['id_usuario']?>"><?php echo $row_rsUsuarios['nome']?></option>
    <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
  </select>
  </label>
  <label>
  <input type="submit" name="Submit" value="Submit">
  </label>
  </p>
</form>
<?php
mysql_free_result($rsUsuarios);
?>