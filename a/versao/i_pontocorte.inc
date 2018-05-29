<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  $p = explode("-", $linha->datacorte);
  $datacorte = "$p[2]/$p[1]/$p[0]";
  $horacorte = $linha->horacorte;  
?>