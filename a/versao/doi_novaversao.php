<?
  require("EnvioEmail.php");
  require("../scripts/conn.php");
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_novaversao SET existe=";
  if ( ($impacto) or ($texto) or ($diapostagem!=00)) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " texto = '$texto', ";
  $txtSQL .= " id_usuario = $id_usuario, ";
  
  if ($fl_impacto) {
    $txtSQL .= "fl_impacto = 1, ";
  } else {
    $txtSQL .= "fl_impacto = 0, ";  
  }

  $txtSQL .= "impacto = '$impacto', ";
 
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
	  //EnviarEmail($id_conjunto, $id_usuario, "Nova versao", "Valida&ccedil;&atilde;o");
	  EnviarEmail($id_conjunto, $id_usuario, 14);
  }
    
  
  header("Location: index.php");
?>
