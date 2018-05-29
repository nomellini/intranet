<?php


function getSqlTempoPorConsultor_037($de, $ate, $id_chamado)
{
	$sql = "
select 
       u.nome,
       sum(TIME_TO_SEC(horae) - TIME_TO_SEC(horaa)) segundos, 
       SEC_TO_TIME(sum(TIME_TO_SEC(horae) - TIME_TO_SEC(horaa))) horas,
       count(1) as contatos
from 
     contato          
       inner join usuario u on u.id_usuario = contato.consultor_id       

where
dataa >= '$de' and
dataa <= '$ate' 
";

if ($id_chamado) {
	$sql .= " and chamado_id in
	(
		select id_chamado from chamado where id_chamado = $id_chamado or chamado_pai_id = $id_chamado
	)
";

}

$sql .= "group by nome";


//echo $sql;
	return $sql;

}

function getSqlTempoPorConsultor_034_b($chamado_id)
{
	$sql = "";
	$sql .= "select
  u.nome,
  SEC_TO_TIME(sum(  time_to_sec(co.horae) - time_to_sec(co.horaa))) as tempo,  
  count(1) as qtde
from contato co
  inner join usuario u on u.id_usuario = co.consultor_id  
where
  co.chamado_id = $chamado_id
group by u.nome
order by 2 desc	";
	return $sql;
}


function getSqlTempoToralPorClienteRel_034($de, $ate, $tipo, $id_cliente, $id_status)
{
	
	if ($tipo == "p") { $t = "and ca.pos_venda = 1 "; } 
    if ($tipo == "c") { $t = "and ca.conversao = 1 "; } 
//    if ($tipo == "a") { $t = "(ca.conversao = 1 or ca.pos_venda = 1)"; } 	
    if ($tipo == "a") { $t = " "; } 	


	$sql = "";
	$sql .= "select
      cl.id_cliente,
      cl.cliente,            
      sec_to_time(      sum( time_to_sec(co.horae) - time_to_sec(co.horaa) )) tempo
from 
     contato co     
             inner join chamado ch on ch.id_chamado = co.chamado_id             
             inner join cliente cl on cl.id_cliente = ch.cliente_id             
             inner join categoria ca on ca.id_categoria = ch.categoria_id                                        
where 
      ch.dataa >= '$de'       
      and ch.dataa <= '$ate'
	  
	  $t  ";

	if ($id_cliente) { 
		$sql .= "and cliente_id = '$id_cliente' " ; 
	} 	  
	if ($id_status) { 
		$sql .= "and ch.status = '$id_status' " ; 
	} 

$sql .= "

group by
      cl.id_cliente,
      cl.cliente,      
      ca.pos_venda      
ORDER BY 3 DESC	  
	  ";


//	$sql .= " order by cliente_id, id_chamado";
  

  	return $sql;
	
}


function getSqlTempoToralRel_034($de, $ate, $tipo, $id_cliente, $id_status)
{
	
	if ($tipo == "p") { $t = "ca.pos_venda = 1 "; } 
    if ($tipo == "c") { $t = "ca.conversao = 1 "; } 
//    if ($tipo == "a") { $t = "(ca.conversao = 1 or ca.pos_venda = 1)"; } 	
    if ($tipo == "a") { $t = " 1 = 1 "; } 	


	$sql = "";
	$sql .= "select
  ch.cliente_id,
  ch.dataa, 
  ch.id_chamado,  
  ca.categoria,  
  si.sistema,    
  (select (sum(  time_to_sec(co.horae) - time_to_sec(co.horaa))) from contato co where co.chamado_id = ch.id_chamado) as tempo_sec,  
  (select SEC_TO_TIME(sum(  time_to_sec(co.horae) - time_to_sec(co.horaa))) from contato co where co.chamado_id = ch.id_chamado) as tempo,  
  (select count(1) from contato co where co.chamado_id = ch.id_chamado) as contatos  ,
  (select 1+datediff(max(dataa),min(dataa)) from contato where chamado_id = ch.id_chamado) as dias,
  status.status
from chamado ch
  inner join categoria ca on ca.id_categoria = ch.categoria_id  
  inner join sistema si on si.id_sistema = ch.sistema_id
  inner join status on status.id_status = ch.status
where
  cliente_id <> '' and 
  ( $t ) and
  dataa >= '$de' and dataa <= '$ate' ";

	if ($id_cliente) { 
		$sql .= "and cliente_id = '$id_cliente' " ; 
	} 

	if ($id_status) { 
		$sql .= "and ch.status = $id_status " ; 
	} 

	$sql .= " order by 6 desc";
  

  	return $sql;
	
}

function getSqlTreinados($basedados, $de, $ate, $campo, $ordem, $tipotre){

	if ($basedados == 1){
	
		$sql .= "SELECT DISTINCT CT.empnome as cliente, t.data, s.sistema, t.conceito, t.nome FROM treinados as t" .
				"  inner join sad.sistema s on s.id_sistema = t.sistema " .
				"  inner join treinamento.tre_usuario as TU on TU.rg = t.rg ".
					" and TU.tipotre = $tipotre".
				"  inner join treinamento.cadastrotreinamento as CT on CT.rg = TU.rg ";
		$sql .= "where ";
		$sql .= "  t.data >= '$de' and ";
		$sql .= "  t.data <= '$ate' ";
		$sql .= "order by $campo $ordem";
		
	}elseif ($basedados == 2){
	
		$sql .= "SELECT CT.empnome as cliente, TU.data, S.sistema, ".
				" case TU.descricao ".
					"when 1 then ".
						"'APROVADO' ".
					"when 2 then " .
						"'REPROVADO' " .
					"when 3 then " .
						"'NÃO SE APLICA'" .
					" end as conceito, " .
				" CT.nome FROM treinamento.tre_usuario as TU" .
				"  inner join sad.sistema as S on S.id_sistema = TU.modulo " .
				"  inner join treinamento.cadastrotreinamento as CT on CT.rg = TU.rg ";
		$sql .= "where ".
				"  TU.tipotre = $tipotre and";
		$sql .= "  TU.data >= '$de' and ";
		$sql .= "  TU.data <= '$ate' ";
		$sql .= "order by $campo $ordem";
		
	}else{
	
		return "Base $basedados inválida";
		
	}
	return $sql;

}


function __getSqlTreinados($de, $ate, $campo, $ordem)
{
	$sql = "";
	$sql .= "select distinct ";
	$sql .= "  sc.cliente, ";
	$sql .= "  tu.data, ";
	$sql .= "  ss.sistema, ";
	$sql .= "  tm.descricao modulo, ";
	$sql .= "  ct.nome participante ";
	$sql .= "from ";
	$sql .= "	treinamento.cadastrotreinamento ct ";
	$sql .= "    inner join sad.cliente sc on sc.id_cliente = ct.empnome ";
	$sql .= "    left join sad.treinados st on st.rg = ct.rg ";
	$sql .= "    inner join sad.sistema ss on ss.id_sistema = st.sistema ";
	$sql .= "    inner join treinamento.tre_usuario tu on tu.rg = ct.rg ";
	$sql .= "    inner join treinamento.modulos tm on tm.cod_modulo = tu.modulo ";
	$sql .= "where ";
	$sql .= "  tu.data >= '$de' and ";
	$sql .= "  tu.data <= '$ate' ";
//	$sql .= "  and sc.id_cliente <> 'DATAMACE' ";
//	$sql .= "order by ct.nome, tu.data desc ";
	$sql .= "order by $campo $ordem";
	return $sql;
}
	
?>