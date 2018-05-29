<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_versao SET existe=";
  if ($existe) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "1, ";
  }
  $txtSQL .= " causa = '$causa', ";
  $txtSQL .= " previsao = '$data', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  
  if ($enviar) {
    $txtSQL .= "enviar = 1, ";    
	$txtX = "Update i_conjunto set enviar = 1 where id = $id_conjunto;";
  } else {
    $txtSQL .= "enviar = 0, ";  
	$txtX = "Update i_conjunto set enviar = 0 where id = $id_conjunto;";	
  }
  if ($fl_producao) {
    $txtSQL .= "fl_producao = 1, ";    
  } else {
    $txtSQL .= "fl_producao = 0, ";    
  }
  if ($fl_licenca) {
    $txtSQL .= "fl_licenca = 1, ";    
  } else {
    $txtSQL .= "fl_licenca = 0, ";    
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
 
//  die($txtSQL);
  mysql_query($txtSQL);
  mysql_query($txtX);
  
  
  if ($ok) {	  
	  require("EnvioEmail.php");
  	  EnviarEmail($id_conjunto, $id_usuario, 2);
//	  EnviarEmail($id_conjunto, $id_usuario, "Vers&atilde;o", "Boletim");
  }
  
  
  header("Location: index.php");  
  
  /*
    -- 26.06.2006
	alter table i_versao add
	  fl_producao bit;
	  
	alter table i_versao add	  
	  fl_licenca bit;
  */
  
?>
