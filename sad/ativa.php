		<? 
		require("scripts/conn.php");
				session_start(); 
		
		$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
		$acao=$_GET['acao'];
		
$sql=mysql_query("insert into home (usuario, desativa)	values	('$v_id_cliente', '$acao')");

header("Location: index.php");
		?>