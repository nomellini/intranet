<?
require("scripts/conn.php");
require("../a/scripts/funcoes.php");  

  
  session_start(); 
  $msg=$_SESSION['msg'];
if($msg==""){

}else{
	header("Location: doindex.php");
}  

  $link = mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  session_start(); 
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
	$destinatario_id = $linha->destinatario_id;

	
	// Inserindo o contato
	
	
	$descricao = mysql_real_escape_string ($descricao);
	$descricao = str_replace('\r\n', "<br>", $descricao);
	
    $dataa = date("Y-m-d");    
	$sql = "INSERT INTO contato (chamado_id, origem_id, historico, consultor_id, ";
	$sql .= "destinatario_id, status_id, dataa, datae, horaa, horae, publicar,pessoacontatada) ";
	$sql .= "VALUES ($numero, 12, '$descricao', 56, ";
	$sql .= "$destinatario_id, 2, '$data', '$data', '$horaa', '$horaa', 1, '$nomecliente');";
	mysql_query($sql) or die ($sql);


	// Atualizando o chamado
	$limite1 = SomaDiasUteis($dataa, 3);
	$limite2 = SomaDiasUteis($limite1, 1);
	$limite3 = SomaDiasUteis($limite2, 1);	
	
	$sql = "UPDATE chamado set 
	data_limite_1 = '$limite1',
	data_limite_2 = '$limite2',
	data_limite_3 = '$limite3',		
	datauc = '$dataa',
	horauc = '$horaa', 
	lidodono=0, 
	lido=0, 
	status=2,";	
	$sql .= "remetente_id=56, 
	destinatario_id=$destinatario_id WHERE id_chamado=$numero;";		
	mysql_query($sql) or die (mysql_error() . " - " . $sql);


	$sql = "update chamado set prioridade_id = 1 where	(prioridade_id = 4 or prioridade_id = 9) and id_chamado=$numero";
	mysql_query($sql) or die (mysql_error() . " - " . $sql);
	
	conn_EnviarEmailAoDestinatatioDoChamado($numero, $descricao);



}
header("Location: /sad/detalhes_chamado.php?id_chamado=$numero&numero=". $numero);
//header("Location: http://intranet.datamace.com.br/sad/detalhes_chamado.php?id_chamado=$numero&numero=". $numero);
?>