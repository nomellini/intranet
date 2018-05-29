<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	
	$sql = "delete from baseweb where id = $id_base";
	mysql_query($sql);
	
	header("Location: relatbaseweb.php");
?>