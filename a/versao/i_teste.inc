<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  if ($linha->fl_boletim) {
   $fl_boletim = "Sim";
  } else {
   $fl_boletim = "N�o";  
  }
  if ($linha->fl_manual) {
   $fl_manual = "Sim";
  } else {
   $fl_manual = "N�o";  
  }
  if ($linha->fl_conversor) {
   $fl_conversor = "Sim";
  } else {
   $fl_conversor = "N�o";  
  }   
  if ($linha->fl_database) {
   $fl_database = "Sim";
  } else {
   $fl_database = "N�o";  
  }   
?>