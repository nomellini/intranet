<?
  require("../scripts/conn.php");		
  $txtSQL = "UPDATE i_boletimDsv SET existe = 1,";
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
	 EnviarEmail($id_conjunto, $id_usuario, 19);
  }  
  
  header("Location: index.php");  
?>
