<?
  $hora = $linha->hora;
  $texto = $linha->texto;
  $p = explode("-", $linha->datacorte);
  $datadownload = "$p[2]/$p[1]/$p[0]";
  $horadownload = $linha->horacorte;  
?>