<?
  $hora = $linha->hora;
  $texto = $linha->texto;
 $p = explode("-", $linha->datadownload);
  $datadownload = "$p[2]/$p[1]/$p[0]";
  $horadownload = $linha->horadownload;
  if ($linha->fl_teste) {
    $fl_teste = "Sim";
  } else {
    $fl_teste = "Não";  
  }  
  
?>