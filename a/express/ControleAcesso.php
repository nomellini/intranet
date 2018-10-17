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
$query_rsUsuarios = "SELECT id_usuario, concat(nome, ' - ',            (select count(1) from chamado where destinatario_id  = id_usuario and status = 2 and visible = 1)) nome FROM usuario WHERE ativo = 1 and (area=3 or id_usuario=98 or id_usuario=14 or id_usuario = 85 or id_usuario = 208) ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());

$query_rsCategorias = "SELECT id_categoria, categoria FROM categoria where sistema_id = 33 ORDER BY categoria ASC";
$rsCategorias = mysql_query($query_rsCategorias, $sad) or die(mysql_error());


?>
<form name="form1" method="post" action="abreChamadoPonto.php">
  <p>Categoria
  <p>
    <label>
      <select name="Categoria" id="Categoria">
        <option value="0">Selecione</option>
        <?php while ($row_rsCategorias = mysql_fetch_assoc($rsCategorias))
	{
 ?>
        <option value="<?php echo $row_rsCategorias['id_categoria']?>"><?php echo $row_rsCategorias['categoria']?></option>
        <?php } ?>
      </select>
    </label>
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
while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios))
{
?>
        <option value="<?php echo $row_rsUsuarios['id_usuario']?>" <?=($row_rsUsuarios['id_usuario']==7?'selected':'')?>><?php echo $row_rsUsuarios['nome']?></option>
        <? } ?>
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
