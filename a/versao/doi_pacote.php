<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_pacote SET existe=";
  if ($existe) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "1, ";
  }
  $txtSQL .= " caminho = '$caminho', ";
  $txtSQL .= " descricao = '$descricao', ";
  $txtSQL .= " nome = '$nome', ";
  $txtSQL .= " previsao = '$data', ";
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
		//EnviarEmail($id_conjunto, $id_usuario, "Instalador", "Testes do Instalador");	  
        EnviarEmail($id_conjunto, $id_usuario, 3);
	}  
  
  header("Location: index.php");  
?>
