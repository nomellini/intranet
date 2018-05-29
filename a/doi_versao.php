<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_versao SET existe=";
  if ($existe) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " causa = '$causa', ";
  $txtSQL .= " previsao = '$data', "
  if ($ok) {
    $txtSQL .= "ok = 1;";
  } else {
    $txtSQL .= "ok = 0;";
  }
  echo $txtSQL;
  
?>
