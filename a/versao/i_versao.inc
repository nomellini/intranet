<?
  $causa=$linha->causa;
  $hora = $linha->hora;
  $enviar = $linha->enviar ? "<b>Enviar para clientes</b> + atualiza��o no site" :  "Somente atualiza��o no Site" ;
  $p = explode("-", $linha->previsao);
  $previsao = "$p[2]/$p[1]/$p[0]";
   
  if ($linha->fl_producao) {
    $fl_producao = "Sim";
  } else {
    $fl_producao = "N�o";  
  }  

  if ($linha->fl_licenca) {
    $fl_licenca = "Sim";
  } else {
    $fl_licenca = "N�o";  
  }  

?>