<?
  mysql_connect(localhost, sad, data1371);
  mysql_select_db('datamace');
if ($excluir) {
	$sSQL = "DELETE FROM numequipamento Where id = $id;"; 
} else {			
	$sSQL = "UPDATE numequipamento set num = '$num', descri='$descri', andar='$andar' Where id = $id;"; 
}
$result = mysql_query($sSQL) or die ( "$sSQL");
?><title>N&uacute;mero de equipamentos Datamace</title>
<p><a href="numeroequip.php">Voltar ao número de equipamentos</a> <br /></p>
