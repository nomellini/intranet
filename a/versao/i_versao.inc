<?
  $causa=$linha->causa;
  $hora = $linha->hora;
  $enviar = $linha->enviar ? "<b>Enviar para clientes</b> + atualização no site" :  "Somente atualização no Site" ;
  $p = explode("-", $linha->previsao);
  $previsao = "$p[2]/$p[1]/$p[0]";
   
  if ($linha->fl_producao) {
    $fl_producao = "Sim";
  } else {
    $fl_producao = "Não";  
  }  

  if ($linha->fl_licenca) {
    $fl_licenca = "Sim";
  } else {
    $fl_licenca = "Não";  
  }  

?>