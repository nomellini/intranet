<?
	require("scripts/dtmtypes.php");
    require("../scripts/conn.php");
	$id_item = $_GET["id"];
	$sql = "select id_status from sgq_itens where id = $id_item";
	$result = mysql_query($sql) or die (mysql_error());
	$linha = mysql_fetch_array($result) or die (mysql_error());
	$pagina = $linha[0] - 2000;	
	$location = "location: AcaoMelhoria/AcaoMelhoria_00$pagina.php?id=$id";
	//die($location);
	header($location);
?>