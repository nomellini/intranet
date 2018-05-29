<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  $datap = explode("-", $linha->datapostagem);
  if ($linha->fl_impacto) {
    $Impacto = "Sim";
  } else {
    $Impacto = "Não";  
  }
  $impacto = $linha->impacto;
?>