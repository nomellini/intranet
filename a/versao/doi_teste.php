<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_teste SET existe=";
  if ($texto) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "1, ";
  }
  $txtSQL .= " texto = '$texto', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	 
  if ($fl_boletim) {
    $txtSQL .= "fl_boletim = 1, ";    
  } else {
    $txtSQL .= "fl_boletim = 0, ";    
  }
  if ($fl_manual) {
    $txtSQL .= "fl_manual = 1, ";    
  } else {
    $txtSQL .= "fl_manual = 0, ";    
  }
  if ($fl_conversor) {
    $txtSQL .= "fl_conversor = 1, ";    
  } else {
    $txtSQL .= "fl_conversor = 0, ";    
  }     
  
  if ($fl_database) {
    $txtSQL .= "fl_database = 1, ";    
  } else {
    $txtSQL .= "fl_database = 0, ";    
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
		//EnviarEmail($id_conjunto, $id_usuario,  "Testes", "Email");
		//EnviarEmail($id_conjunto, $id_usuario,  "Testes", "Atualização da base (Pós venda)");	  
		EnviarEmail($id_conjunto, $id_usuario, 7);
	}  
  
  header("Location: index.php");  
?>
