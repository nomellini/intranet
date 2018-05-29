<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_email SET existe=";
  if ($existe) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " texto = '$texto', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  
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
	  //EnviarEmail($id_conjunto, $id_usuario, "Email", "Geração do Instalador");
  	  EnviarEmail($id_conjunto, $id_usuario, 6);
  }  
  
  header("Location: index.php");  
?>
