<?php 
require("../../scripts/conn.php");

	if ($grupo == "nada") {
		$grupo = "ZZ";
    }

function getBarraContatos($datai, $dataf, $origem) {
	
	$diai = explode("/", $datai);
	$diai = "$diai[2]-$diai[1]-$diai[0]";
	$diaf = explode("/", $dataf);
	$diaf = "$diaf[2]-$diaf[1]-$diaf[0]";	
	
$sql = "select 
       nome, count(*) as contatos
from 
     contato, usuario 
where 
      (usuario.id_usuario=contato.consultor_id) and 
      (   (contato.origem_id=$origem) or ($origem=0)) and 
      (area = 1)  and 
      (contato.historico is not null) and (contato.historico<>'') and 
      (contato.dataa between '$diai' and '$diaf') 
group by 
       contato.consultor_id order by count(1) desc"	;
	   

	$c = 0;
	


  
	$result = mysql_query($sql) or die(mysql_error());
	
	while ($linha = mysql_fetch_object($result)) {
		
		
		$ydata[$c] = $linha->contatos;		
		$xdata[$c] = $linha->nome;					
		$percentual[$c] = 1000;					
		$c++;
	}
  
 
 		
 
	$resultado[0] = $xdata;
	$resultado[1] = $ydata;	
	$resultado[2] = $percentual;
	
	return $resultado;	
  
}


function getBarra($datai, $dataf, $id_sistema, $grupo) {

	define ("LIMITEINFERIOR", 0);
	define ("LIMITESUPERIOR", 1);
	$faixa[1][LIMITEINFERIOR] = 0;
	$faixa[1][LIMITESUPERIOR] = 60 * 2;
	$faixa[2][LIMITEINFERIOR] = 60 * 2; // 2 minutos
	$faixa[2][LIMITESUPERIOR] = 60 * 4;
	$faixa[3][LIMITEINFERIOR] = 60 * 4; // 4 minutos
	$faixa[3][LIMITESUPERIOR] = 60 * 8;
	$faixa[4][LIMITEINFERIOR] = 60 * 8; 
	$faixa[4][LIMITESUPERIOR] = 60 * 15;
	$faixa[5][LIMITEINFERIOR] = 60 * 15; 
	$faixa[5][LIMITESUPERIOR] = 60 * 20;
	$faixa[6][LIMITEINFERIOR] = 60 * 20; 
	$faixa[6][LIMITESUPERIOR] = 60 * 25;
	$faixa[7][LIMITEINFERIOR] = 60 * 25; 
	$faixa[7][LIMITESUPERIOR] = 60 * 30;
	$faixa[8][LIMITEINFERIOR] = 60 * 30; 
	$faixa[8][LIMITESUPERIOR] = 60 * 1440;
	
	$soma = 0;
	
	$diai = explode("/", $datai);
	$diai = "$diai[2]-$diai[1]-$diai[0]";
	$diaf = explode("/", $dataf);
	$diaf = "$diaf[2]-$diaf[1]-$diaf[0]";
	
	$sql  = "select ((time_to_sec(hora_fim)-time_to_sec(hora_inicio)) ) as minutos  ";
	$sql .= "from  satligacao where (FL_ATIVO = 1) and (id_satstatus = 3 ) and ";
	$sql .= "data >= '$diai' and  data <= '$diaf'";
	
	$sql  = "select ";
	$sql .= "  (time_to_sec(hora_fim)-time_to_sec(hora_inicio))  as minutos   ";
	$sql .= "from   ";
	$sql .= "  satligacao    ";
	$sql .= "    left  join cliente c on c.id_cliente = satligacao.id_cliente ";
	$sql .= "where  ";
	$sql .= "      (FL_ATIVO = 1)        ";
	if ($grupo != "todos") {
		$sql .= "  and c.grau = '$grupo' ";
    }
	$sql .= "  and (id_satstatus = 3 )  ";
	$sql .= "  and data >= '$diai'  ";
	$sql .= "  and  data <= '$diaf' ";
	
	
	if ($id_sistema!=0) {
		$sql .= " and id_produto = $id_sistema";
	}
	
	$qtdefaixas = count($faixa); 
	for ($i=0;$i<$qtdefaixas;$i++) {
	  $ydata[$i] = 0;
	  $percentual[$i] = 0;
	}

	$soma = 0;
	$result = mysql_query($sql) or die($sql);
	while ($linha=mysql_fetch_object($result)) {
		$i = 0;
		$qtde = $linha->qtde;
		$valor = $linha->minutos;	
		$soma += 1;
		foreach ($faixa as $par) {	
			$linfer = $par[LIMITEINFERIOR];
			$lsuper = $par[LIMITESUPERIOR];  
			if ( ($valor >= $linfer) && ($valor < $lsuper) ) {
				$ydata[$i] += 1; 
			}
			$i++;
		}
	}
	
	for ($i=0;$i<=$qtdefaixas;$i++) {
	  if ($ydata[$i] != 0) {
		  $percentual[$i+1] =  $ydata[$i] / $soma * 100 ;
	  	  $percentual[$i+1] = number_format($percentual[$i+1], 1, ',', '.');
	  } else {
		  $percentual[$i+1] = 0;
	  }
	}
	

	for ($i=0;$i<=$qtdefaixas;$i++) {
	  if ($i==$qtdefaixas) {
		$xdata[$i-1] = ">" . $faixa[$i][LIMITEINFERIOR]/60;
	  } else {
		$xdata[$i-1] = ($faixa[$i][LIMITEINFERIOR]/60) . "-" . ($faixa[$i][LIMITESUPERIOR]/60);
	  } 
	  // $xdata[$i-1] .= ":" . $percentual[$i] . "%"; 
	}
	
		
	$resultado[0] = $xdata;
	$resultado[1] = $ydata;	
	$resultado[2] = $percentual;
	return $resultado;
}

function getMedias($datai, $dataf, $id_sistema) {

	$diai = explode("/", $datai);
	$diai = "$diai[2]-$diai[1]-$diai[0]";
	$diaf = explode("/", $dataf);
	$diaf = "$diaf[2]-$diaf[1]-$diaf[0]";

	$sql  = "select hour(hora_inicio) as hora, (avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))/60) as minutos_medio, ";
	$sql .= "sec_to_time(avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))) as tempo_medio ";
	$sql .= "from satligacao where data >= '$diai' and  data <= '$diaf' and ";
	$sql .= "(id_satstatus = 3 or id_satstatus=4) ";
	if ($id_sistema!=0) {
      $sql .= " and id_produto = $id_sistema";
	}	
	$sql .= " group by hour(hora_inicio)";
	
   
	$qtdefaixas = count($faixa); 
	for ($i=0; $i<12;$i++) {
	  $xdata[$i] = $i+7;	
	  $ydata[$i] = 0;
	}  
   
	$result = mysql_query($sql);

//	$i = 0;
//	while ($linha=mysql_fetch_object($result)) {
//	  $xdata[$i] = $linha->hora;
//	  $ydata[$i++] = $linha->minutos_medio;
//	}
	
	while ($linha=mysql_fetch_object($result)) {
	  $xdata[$linha->hora-7] = $linha->hora;
	  $ydata[$linha->hora-7] = $linha->minutos_medio;
	}
	
	
	$resultado[0] = $xdata;
	$resultado[1] = $ydata;	
	return $resultado;	
}

function getMax($valores) {
  $m = 0;
  $c = count($valores);
  for ($i=0; $i<=$c; $i++) {
    if ($valores[$i] > $m) {
	  $m = $valores[$i];
	}
  }
  return $m;
}


    function pad($s, $n){    
	   $r = $s;
       while (strlen($r) < $n) {
	     $r = "0".$r;
	   }
	   return $r;
	}
	


	function funcoesGetSelectContatosPorConsultor($de, $ate)
	{
		$sql = "select 
       nome, 
       count(*) as contatos,               
       count(*) / (select count(*) as contatos from contato, usuario where (usuario.id_usuario=contato.consultor_id) and (area = 1) and (contato.historico is not null) and (contato.historico<>'') and (contato.dataa between '$de' and '$ate')) * 100 as P,
       SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo_total,              
       SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) / (select SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) from contato, usuario where (usuario.id_usuario=contato.consultor_id) and (area = 1) and (contato.historico is not null) and (contato.historico<>'') and (contato.dataa between '$de' and '$ate')) * 100 as P_t,
       SEC_TO_TIME( ( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) / count(*)) AS tempo_contato

from contato, usuario 
where (usuario.id_usuario=contato.consultor_id) and (area = 1) and (contato.historico is not null) and (contato.historico<>'') and (contato.dataa between '$de' and '$ate') 
group by contato.consultor_id
order by contatos ;
";
		return $sql;
	}

?>