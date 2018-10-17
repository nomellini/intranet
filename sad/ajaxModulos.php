<?
require("scripts/conn.php");
mysql_set_charset("latin1", $sad);

$sistema_id = $_POST['produto'];

$sql_cat = "select id_categoria, categoria from categoria where sistema_id = $sistema_id order by categoria";
//die ($sql_cat);
$result = mysql_query($sql_cat);
while($reg=mysql_fetch_assoc($result)){
	$descricao = $reg['categoria'];
	$id = $reg['id_categoria'];
	echo "<option value=$id>". htmlentities($descricao) ."</option>";
}
?>