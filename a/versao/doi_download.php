<?
  require("../scripts/conn.php");		
  $datadownload = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_download SET existe=";
  if ($texto) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "1, ";
  }
  $txtSQL .= " texto = '$texto', datadownload = '$datadownload', horadownload='$horadownload', ";  
  $txtSQL .= " id_usuario = $id_usuario, ";	
  
  if ($fl_teste) {
    $txtSQL .= "fl_teste = 1, ";    
  } else {
    $txtSQL .= "fl_teste = 0, ";    
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
  
  //die($txtSQL);
  
  mysql_query($txtSQL);
 
  if ($ok) {	  
	  require("EnvioEmail.php");
	  //EnviarEmail($id_conjunto, $id_usuario, "Download", "Comunica&ccedil;&atilde;o ao cliente");
	  EnviarEmail($id_conjunto, $id_usuario, 10);	  
  }  
 
 
  header("Location: index.php");  
?>
