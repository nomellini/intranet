<?php
class Release
{
	
	public static function obterReleasesPorId($Id_Release)
	{
		$sql = "SELECT id, concat(sistema.sistema, ' v', versao) sistema, date(data_prev_liberacao) liberacao, ok
		FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND (id = $Id_Release)
		ORDER BY data DESC, hora DESC;";
		$result = array();
		$query = mysql_query($sql) or die ("$sql - " . mysql_error());				
		while ($linha = mysql_fetch_object($query))
		{
			$result["id"] = $linha->id;
			$descricao = $linha->sistema . ' lib:' . AMD2DMA($linha->liberacao);
			$result["descricao"] = $descricao;
		}		
		return $result;		
	}
	
	public static function obterReleasesEmAndamento($Id_Release)
	{
		$sql = "SELECT id, concat(sistema.sistema, ' v', versao) sistema, date(data_prev_liberacao) liberacao, ok
		FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND (!ok or id = $Id_Release)
		ORDER BY data DESC, hora DESC;";
		$result = array();
		$query = mysql_query($sql) or die ("$sql - " . mysql_error());		
		$c=1;
		while ($linha = mysql_fetch_object($query))
		{
			$result[$c]["id"] = $linha->id;
			$descricao = $linha->sistema . ' lib:' . AMD2DMA($linha->liberacao);
			if ($linha->ok) {
				$descricao .= ' - ENCERRADO';
			}			
			$result[$c++]["descricao"] = $descricao;
		}		
		if (count($result) == 0)
		{
			$result[1]["id"] = 0;
			$result[1]["descricao"] = "Nenhum release em andamento";
		}
		return $result;		
	}
}

function obterDataEncerramento()
{			
	return SomaDiasUteis(date("Y-m-d"), 4);	
}

function AMD2DMA($data)
{
	return implode("/", array_reverse( explode ('-', $data)));
}

function DMA2AMD($data)
{
	return implode("-", array_reverse( explode ('/', $data)));
}

function funcoesArrayReleasesEmAndamento()
{
	$sql = "SELECT id, concat(sistema.sistema, ' v', versao) sistema, data_prev_liberacao data
FROM i_conjunto inner join sistema on sistema.id_sistema = i_conjunto.id_sistema
WHERE !ok  ORDER BY data DESC, hora DESC";
	$result = mysql_query($sql);
	$resultado = array();
	$c=1;
	while ($linha = mysql_fetch_array($result))
	{
		$resultado[$c++] = $linha;
	}
	return $resultado;
}

function FuncoesPegaDemaisRascunho($id_chamado, $ok)
{
	$saida = array();
	$sql = "select t.id_chamado, t.data, t.hora, left(c.descricao, 50) texto from  contato_temp t inner join chamado c on c.id_chamado = t.id_chamado 
	where  c.status <> 1 and id_usuario = $ok  and visible = 1 and t.data >= '2013-09-01'	order by t.data";
//	if ($ok == 12)
	{
		$conta=0;
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result))
		{
			$tmp["negrito"] = $id_chamado == $linha->id_chamado;
			$tmp["id_chamado"] = $linha->id_chamado;
			$tmp["data"] = $linha->data;
			$tmp["hora"] = $linha->hora;
			$tmp["texto"] =  str_replace("<br>", " ", $linha->texto) . "...";
			$saida[$conta++] = $tmp;
		}
	   
	}
	
	return $saida;
	
}

function FuncoesPegaRascunho($id_chamado, $ok)
{
	$sql = "select left(contato, 100) rascunho from contato_temp where id_chamado = $id_chamado  and id_usuario = $ok";
	$result = mysql_query($sql);
	if ($linha = mysql_fetch_object($result))
	{
		$Texto = $linha->rascunho;
		$Texto = str_replace("<br>", " ", $Texto );
		$Texto = str_replace("<p>", " ", $Texto );
		$Texto = str_replace("</p>", " ", $Texto );				
		return $Texto . "...";
	} else 
	{
		return "";
	}
	
}

function FuncoesObterDescricaoChamado( $id_chamado )
{
	
	$sql = "select id_chamado, concat(id_chamado, ' - ', left(descricao,100)) descricao from chamado where id_chamado = $id_chamado ";

	$result = mysql_query($sql);	
	$return = "";
	if ($linha = mysql_fetch_object($result))
	{
		$id = $linha->id_chamado;
		$descricao = "<br><br><i>Projeto: <a target=_blank href=/a/projetos/projeto.php?id_chamado=$id>" . $linha->descricao . "...</a></i>";
		if ($id != 0)
			$return = $descricao;
	}
	return $return;
		
}


function FuncoesObterDescricaoChamadoPai( $id_chamado )
{
	
	$sql = "select id_chamado, concat(id_chamado, ' - ', left(descricao,100)) descricao from chamado where id_chamado = (select chamado_pai_id from chamado where id_chamado = $id_chamado and chamado_pai_motivo <> '' )";

	$result = mysql_query($sql);	
	$return = "";
	if ($linha = mysql_fetch_object($result))
	{
		$id = $linha->id_chamado;
		$descricao = "<br><br><i>Projeto: <a target=_blank href=/a/projetos/projeto.php?id_chamado=$id>" . $linha->descricao . "...</a></i>";
		if ($id != 0)
			$return = $descricao;
	}
	return $return;
		
}

function FuncoesObterListaDeProjetosParaDropdownList()
{
	$saida = array();
	$sql = "select id_chamado as c, Concat(id_chamado, ' - ' , Left(descricao, 100)) as d from chamado where status = 2 and rnc = 4 and id_chamado > 0 order by dataa desc";
	
	$result = mysql_query($sql) or die ( mysql_error() );
		
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) {
	
		$tmp["id"] = $linha->c;
		$tmp["descricao"] = $linha->d;
		$saida[$conta++] = $tmp;
	}	
	return $saida;
}

function FuncoesPegaChamadoPendenteUsuario_ordem($usuario, $Campo) {
	
	$saida = array();	

	$sql .= "SELECT c.rnc_acao_responsavel, sis.sistema, c.datauc, c.horauc, c.Ds_Versao, c.Dt_Release,  "; 
	$sql .= "ct.id_usuario as Editando_Id, ue.nome as Editando_Nome, ";
	$sql .= " datediff(now(), dataa) diasAbertura, datediff(now(), datauc) diasUltimoContato, ";
	$sql .= "  c.rnc_depto_responsavel, c.rnc_prazo, dataprevistaliberacao, liberado, id_chamado_espera, "; 
	$sql .= "  c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa, c.status, "; 
	$sql .= "  destinatario_id, consultor_id, remetente_id, cat.pos_venda, "; 
	$sql .= "  LEFT(c.descricao, 150) as descricao, cl.id_cliente, cl.cliente, cl.telefone, "; 
	$sql .= "  cl.senha as senhacliente, p.prioridade, p.valor "; 
	$sql .= "  , cat.categoria "; 
	$sql .= "  , (select count(1) from chamado c2 where (c2.id_chamado_espera = c.id_chamado)) as qtde "; 
	$sql .= "FROM "; 
	$sql .= "  chamado c "; 
	$sql .= "    inner join cliente cl on c.cliente_id = cl.id_cliente "; 
	$sql .= "    inner join prioridade p on c.prioridade_id = p.id_prioridade "; 
	$sql .= "    left join categoria cat on c.categoria_id = cat.id_categoria "; 
	$sql .= "    inner join sistema sis on c.sistema_id = sis.id_sistema ";
	$sql .= "    left join contato_temp ct on (ct.id_chamado = c.id_chamado and date(now()) = ct.data and ct.id_usuario = $usuario) ";
	$sql .= "    left join usuario ue on ue.id_usuario = ct.id_usuario ";	
	$sql .= "WHERE visible = 1 and "; 
	$sql .= "( "; 	
	$sql .= "  ( (c.descricao is not null) AND (c.descricao <> '') ) "; 
	$sql .= "  AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) "; 
	$sql .= "  AND (c.status <> 1) "; 
	$sql .= ") "; 		
	$sql .= "ORDER BY "; 
	
	if ($Campo == "")
	{
		$sql .= "  p.valor, dataa desc, horaa desc "; 
	} else {
		$sql .= " $Campo $Ordem "; 	
	}

//	die($sql);

	$result = mysql_query($sql) or die ( mysql_error() );
	
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) {
	
		$tmp["Editando_Id"] = $linha->Editando_Id;
		$tmp["Editando_Nome"] = $linha->Editando_Nome;
		
		$tmp["externo"] = $linha->externo;
		$tmp["lido"] = $linha->lido;
		$tmp["lidodono"] = $linha->lidodono;
		$tmp["usuario_id"] = $linha->consultor_id;
		$tmp["destinatario_id"] = $linha->destinatario_id;
		$tmp["remetente_id"] = $linha->remetente_id;
		$tmp["categoria_id"] = $linha->categoria_id;
		$tmp["pos_venda"] = $linha->pos_venda;
		$tmp["sistema"] = $linha->sistema;
		$tmp["categoria"] = $linha->categoria;		
		
		// Quantos chamados dependem deste para encerrar ?
		$tmp["qtde"] = $linha->qtde;
		
		//Qual o chamado que eu aguardo ?
		$tmp["espero"] = $linha->id_chamado_espera;
		
		
		$tmp["encaminhado"] =  (		
		($tmp["destinatario_id"] != $tmp["remetente_id"]) or
		($tmp["destinatario_id"] != $tmp["usuario_id"])
		) ;
		
		
		
		$tmp["rnc_acao_responsavel"] = $linha->rnc_acao_responsavel;
		$tmp["id_cliente"] = $linha->id_cliente;
		$tmp["senha"] = $linha->senhacliente;
		$tmp["cliente"] = $linha->cliente;
		
		$tmp["chamado"] = $linha->id_chamado;
		$tmp["descricao"] = $linha->descricao;
		
		$quando = explode("-", $linha->dataa);		
		$tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
		$tmp["horaa"] = $linha->horaa;
		$tmp["diasAbertura"] = $linha->diasAbertura;
		
				
		$quando = explode("-", $linha->datauc);
		$tmp["datauc"] = "$quando[2]/$quando[1]/$quando[0]";
		$tmp["horauc"] = $linha->horauc;
		$tmp["diasUltimoContato"] = $linha->diasUltimoContato;
		
		$tmp["telefone"] = $linha->telefone;
		$tmp["status"] = $linha->status;
		$tmp["prioridade"] = $linha->prioridade;
		$tmp["prioridadev"] = $linha->valor;
		$tmp["id_sistema"] = $linha->sistema_id;
		$tmp["rnc"] = $linha->rnc;
		
		$quando = explode("-", $linha->rnc_prazo);	 
		$tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
		$quando = explode("-", $linha->rnc_prazo);	 
		$tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
		$tmp["rncDeptoResponsavel"] = $linha->rnc_depto_responsavel;
		
		$quando = explode("-", $linha->dataprevistaliberacao);	 	 
		$tmp["dataprevista"] = "$quando[2]/$quando[1]/$quando[0]";
		
		$tmp["Ds_Versao"] = $linha->Ds_Versao;
		$tmp["Dt_Release"] = $linha->Dt_Release;
		
		
		$saida[$conta++] = $tmp;
	}
	
	return $saida;
}


function FuncoesUsuarioAtendimento($id_usuario)
{
	$sql .= "select atendimento from usuario where id_usuario = $id_usuario"; 
	$result = mysql_query($sql) or die ( mysql_error() );	
	$conta=0;
	$linha = mysql_fetch_object( $result );
	//echo $sql;
	return $linha->atendimento;	
}


function IsFeriado($dia, $mes)
{
	$sql = "select count(1) q from datas where dia = $dia and mes = $mes and (tipo = 'F' or tipo = 'E')";
	$result = mysql_query($sql) or dir ($sql);
	$linha = mysql_fetch_object($result);
	if ($linha->q == 1) 
		$f = true;
	else
		$f = false;
	return $f;
}

function add_date($givendate,$day=0,$mth=0,$yr=0) {
	$cd = strtotime($givendate);
	$newdate = mktime(date('h',$cd),
	 date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
	 date('d',$cd)+$day, date('Y',$cd)+$yr);
	return $newdate;
}

function SomaDiasUteis($data, $dias)
{

	$dia = $data;
	for( $i=1; $i <= $dias; $i++)
	{
		$dia_mais_um = add_date($dia, 1);
		$dia_semana = date("w", $dia_mais_um);	
		$dia = date("d", $dia_mais_um);	
		$mes = date("m", $dia_mais_um);	
		$feriado = IsFeriado($dia, $mes); 
		while ( ($dia_semana == 6) || ($dia_semana == 0) || ($feriado == 1) ) 
		{
			$dia = date("Y-m-d", $dia_mais_um);				
			$dia_mais_um = add_date($dia, 1);
			$dia_semana = date("w", $dia_mais_um);		
			$dia = date("d", $dia_mais_um);	
			$mes = date("m", $dia_mais_um);				
			$feriado = IsFeriado($dia, $mes); 			
		}	
		$dia = date("Y-m-d", $dia_mais_um);	
	}
	return date("Y-m-d", $dia_mais_um);
}


function funcoesObterRestricaoChamadoUsuario($ok, $id_chamado)
{
	$result = array();
	$c=0;
	$sql = "select distinct
	 restricoes.Ds_Descricao descricao, 
	 restricoes.id, 
	 ic_Implementado ok
	from rl_restricao_chamado x
	  inner join rl_restricao_marcar r on r.id_restricao = x.id_Restricao
	  inner join restricoes on restricoes.Id = x.id_Restricao
	where x.id_Chamado = $id_chamado and (r.id_usuario = $ok  or $ok = 12 or $ok = 7)";

	$query = mysql_query($sql);
	while ($linha = mysql_fetch_array($query))	
		$result[$c++] = $linha;
	
	return $result;
}

function funcoesObterStatusRestricao($id_chamado) 
{
	/*
		Ideia do Daniel: Chamado : 317.965
	*/
	
	
	// Use display para exibir todas as restrções
	$tmp["display"] = "";
	
	// Veja se o flag abaixo = trure, se for, nao pode encerrar o chamado;
	$tmp["impedeEncerrer"] = false;
	
	// Se tiver mensagem aqui, ainda tem restrição incompletas
	// Se o flag acima for false, exibir as restrições mas nao impede encerrar.
	$tmp["mensagemRestricoes"] = "";
	
	
	$sql = "select r.Ds_Descricao restricao, rc.Ic_Implementado ok, r.Ic_ImpedeEncerramentoChamado impede
	from rl_restricao_chamado rc inner  join restricoes r on rc.id_restricao = r.id
	where id_chamado = $id_chamado order by rc.Ic_Implementado";	

	$result = mysql_query($sql) or die (mysql_error() . "<br>". $sql); 	
	$return = "";		
	
	while ($linha=mysql_fetch_object($result))
	{	
		if (!$linha->ok) {
			$tmp["mensagemRestricoes"] .= $linha->restricao . " | ";
            $tmp["impedeEncerrer"] = $tmp["impedeEncerrer"] | ($linha->impede==1);
		}

		$tmp["display"] .= "<div class=\"Restricao_$linha->ok\">$linha->restricao | </div>";
	}

	
	return $tmp;
}

function funcoes_obterArea($id_usuario)
{
     $sql = "select area from usuario where (id_usuario = $id_usuario);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->area;
     } 
}

?>