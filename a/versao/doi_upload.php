<?
  require("../scripts/conn.php");		
  $dataupload = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_upload SET existe=";
  if ($ok) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "1, ";
  }
  $txtSQL .= " texto = '$texto', dataupload = '$dataupload', horaupload='$horaupload', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  

  if ($fl_versao) {
    $txtSQL .= "fl_versao = 1, ";    
  } else {
    $txtSQL .= "fl_versao = 0, ";    
  }

  if ($fl_descricao) {
    $txtSQL .= "fl_descricao = 1, ";    
  } else {
    $txtSQL .= "fl_descricao = 0, ";    
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
	  //EnviarEmail($id_conjunto, $id_usuario, "Upload", "Download");
  	  EnviarEmail($id_conjunto, $id_usuario, 9);
  }

  header("Location: index.php");  
?>
