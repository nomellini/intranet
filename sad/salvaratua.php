<?

require("scripts/conn.php");
  session_start(); 

$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
$id=$_GET['id'];
$nome=$_GET['textfield22'];
$email=$_GET['textfield222'];
$fixa1=$_GET['fixa1'];
$fixa2=$_GET['fixa2'];
$sql=mysql_query("update treinados set	nome  = '$nome' , 	email  = '$email' where	id = '$id'");

header("Location: http://intranet.datamace.com.br/sad/usuarios_treinados.php?textfield=$fixa1&select2=$fixa2")
?>
