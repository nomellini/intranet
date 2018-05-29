<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  if ($linha->fl_boletim) {
   $fl_boletim = "Sim";
  } else {
   $fl_boletim = "Não";  
  }
  if ($linha->fl_manual) {
   $fl_manual = "Sim";
  } else {
   $fl_manual = "Não";  
  }
  if ($linha->fl_conversor) {
   $fl_conversor = "Sim";
  } else {
   $fl_conversor = "Não";  
  }   
  if ($linha->fl_database) {
   $fl_database = "Sim";
  } else {
   $fl_database = "Não";  
  }   
?>