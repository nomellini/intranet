<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  $p = explode("-", $linha->dataupload);
  $dataupload = "$p[2]/$p[1]/$p[0]";
  $horaupload = $linha->horaupload;
  if ($linha->fl_versao) {
    $fl_versao = "Sim";
  } else {
    $fl_versao = "Não";  
  }  

  if ($linha->fl_descricao) {
    $fl_descricao = "Sim";
  } else {
    $fl_descricao = "Não";  
  }    
?>