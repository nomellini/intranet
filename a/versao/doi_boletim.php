<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_boletim SET existe=";
  if ($existe) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " caminho = '$caminho', ";
  $txtSQL .= " descricao = '$descricao', ";
  $txtSQL .= " nome = '$nome', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  
  if ($enviar) {
    $txtSQL .= "enviar = 1, ";   
  } else {
    $txtSQL .= "enviar = 0, "; 
  }  
  if ($ok) {
    $txtSQL .= "ok = 1, ";
	$data = date("Y-m-d");
	$hora = date("H:i:s");
	$txtSQL .=" data='$data', hora='$hora' ";
  } else {
    $txtSQL .= "ok = 0, ";
	$txtSQL .=" data='0000-00-00', hora='00:00:00'  ";
	
  }
  $txtSQL .= "WHERE id_conjunto = $id_conjunto;";
 
  mysql_query($txtSQL);
  
  if ($ok) {	  
	  require("EnvioEmail.php");
	  //EnviarEmail($id_conjunto, $id_usuario, "Boletim", "Elaboração de email para envio aos clientes");
	  //EnviarEmail($id_conjunto, $id_usuario, "Boletim", "Instalador");
  	  EnviarEmail($id_conjunto, $id_usuario, 5);
  }
    
  
  header("Location: index.php");  
?>
