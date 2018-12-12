<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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


$query_rsUsuarios = "SELECT id_usuario, concat(nome, ' - ',            (select count(1) from chamado where destinatario_id  = id_usuario and status = 2 and visible = 1)) nome FROM usuario WHERE ativo = 1 and (area=2 or id_usuario=98 or id_usuario=14 or id_usuario = 85 or id_usuario = 208) ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><form name="form1" method="post" action="abreChamado.php">
  <p>Descri&ccedil;&atilde;o do Chamado<br>
    <textarea name="Chamado" cols="80" rows="5" id="Chamado"></textarea>
    </p>
  <p>Texto do Contato<br>
    <br>
    <textarea name="Contato" cols="80" rows="5" id="Contato">Segue</textarea>
  </p>
  <p>Sistema<br>
      <select name="id_sistema" id="id_sistema">
        <option value="0">Selecione</option>  
<?php
	$result = mysql_query("select id_sistema, sistema from sistema order by sistema");
	while ($linha = mysql_fetch_object($result)) 
	{  
?>
        <option value="<?php echo $linha->id_sistema ?>"><?php echo $linha->sistema ?></option>
<?php
	} 
?>
      </select>
  
    <br>
    <br>
    Destinat&aacute;ro<br>

      <select name="Destinatario" id="Destinatario">
        <option value="0">Selecione</option>
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

    <label>
      <input type="submit" name="Submit" value="Submit">
    </label>
  </p>
</form>
<?php
mysql_free_result($rsUsuarios);
?>