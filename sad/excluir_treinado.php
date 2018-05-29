<?
require("scripts/conn.php");
  session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
$id=$_GET['id'];
$textfield=$_GET['textfield'];
$select2=$_GET['select2'];

$sql=mysql_query("DELETE FROM treinados WHERE id=".$id);

header("Location: http://intranet.datamace.com.br/sad/usuarios_treinados.php?textfield=$textfield&select2=$select2");

?>