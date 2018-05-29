<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_datacenter SET existe=";
  if ($texto) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " texto = '$texto', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  
  if ($fl_email) {
    $txtSQL .= "fl_email = 1, ";    
  } else {
    $txtSQL .= "fl_email = 0, ";    
  }
  if ($fl_versao) {
    $txtSQL .= "fl_versao = 1, ";    
  } else {
    $txtSQL .= "fl_versao = 0, ";    
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
	  //EnviarEmail($id_conjunto, $id_usuario, "Data Center", "Encerrar vers&atilde;o");
  	  EnviarEmail($id_conjunto, $id_usuario, 13);
  }  
  
  
  header("Location: index.php");  
?>
