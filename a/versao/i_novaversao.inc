<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  $datap = explode("-", $linha->datapostagem);
  if ($linha->fl_impacto) {
    $Impacto = "Sim";
  } else {
    $Impacto = "N�o";  
  }
  $impacto = $linha->impacto;
?>