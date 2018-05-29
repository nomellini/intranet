<?
require("scripts/conn.php");
$link = mysql_connect(localhost, sad, data1371);
mysql_select_db(sad);
session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
  $sqll = mysql_query("select * from chamado where id_chamado=$numero");
  while($reg=mysql_fetch_assoc($sqll)){
	$nomecliente=$reg['nomecliente'];
  }
  
  $data=date("Y/m/d");
$horaa = date("H:i:s");
$numero=$_POST['numero'];
$descricao=$_POST['textarea'];
$status=$_POST['status'];
   if ($v_id_cliente) {
  
    $sql1 = "select destinatario_id from chamado where id_chamado=$numero";
	$result = mysql_query($sql1);
	$linha = mysql_fetch_object($result);
//	$destinatario_id = $linha->consultor_id;
	$destinatario_id = $linha->destinatario_id;
	


$sql = "INSERT INTO contato (chamado_id, origem_id, historico, consultor_id, ";
$sql .= "destinatario_id, status_id, dataa, datae, horaa, horae, publicar,pessoacontatada) ";
$sql .= "VALUES ($numero, 12, '$descricao', 56, ";
$sql .= "$destinatario_id, 2, '$data', '$data', '$horaa', '$horaa', 1, '$nomecliente');";

mysql_query($sql) or die ($sql);


$sql2=mysql_query("UPDATE chamado SET status=1, externo=0 WHERE id_chamado=". $numero);



}

header("Location: http://intranet.datamace.com.br/sad/detalhes_chamado.php?numero=". $numero);
?>
