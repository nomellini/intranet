<?
  $hora = $linha->hora;
  $nome = $linha->nome;
  $p=explode("-", $linha->previsao);
  $previsao = "$p[2]/$p[1]/$p[0]";
  $descricao = $linha->descricao;
  $caminho = $linha->caminho;
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
?>