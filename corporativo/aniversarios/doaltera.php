<?
mysql_connect(localhost, sad, data1371);
mysql_select_db(datamace);	
if ($excluir) {
	$sSQL = "DELETE FROM funcionarios Where id = $id;"; 
} else {			
	$sSQL = "UPDATE funcionarios set nome = '$nome', mes='$mes', dia='$dia' Where id = $id;"; 
}
$result = mysql_query($sSQL) or die ( "$sSQL");
header("Location: index.php");
?>