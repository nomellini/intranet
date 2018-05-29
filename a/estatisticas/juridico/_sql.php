<?
function getSql_001($de, $ate, $tipo, $diagnostico)
{

	$sql = ""; 
	$sql .= "SELECT contato.chamado_id, sistema, diagnostico.diagnostico, usuario.nome, count(  *  )  AS soma ";
	$sql .= "FROM contato, usuario, chamado, sistema, diagnostico ";
	$sql .= "WHERE ";
	
	if ($tipo=='R') {
		$sql .= "contato.destinatario_id = 6 ";
		$sql .= "AND contato.consultor_id <>6  ";
	} else 	if ($tipo=='E') {
		$sql .= "contato.destinatario_id <> 6 ";
		$sql .= "AND contato.consultor_id = 6  ";	
	} else {
		$sql .= "(( contato.destinatario_id = 6 ";
		$sql .= "   AND contato.consultor_id <>6) OR  ";
		$sql .= "( contato.destinatario_id <> 6 ";
		$sql .= "  AND contato.consultor_id = 6))  ";	
	}
	
	$sql .= "AND usuario.id_usuario = contato.consultor_id  ";
	$sql .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql .= "AND diagnostico.id_diagnostico = chamado.diagnostico_id  ";
	$sql .= "AND contato.dataa >=  '$de' ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY contato.chamado_id ";
	$sql .= "ORDER  BY soma DESC, contato.chamado_id ";

//	die($sql);

	return $sql;
}



function getSqlQuantidadeInteracoes($de, $ate, $tipo, $diagnostico)
{
	$sql = "create temporary table tmpQuantidadeInteracoes ";
	$sql .= getSql_001($de, $ate, $tipo);

	mysql_query("DROP TABLE IF EXISTS tmpQuantidadeInteracoes;");	
    mysql_query($sql);	
	$sql = "select soma as interacoes, count(1) as soma from tmpQuantidadeInteracoes group by interacoes";	
	return $sql;
}


function getMediaUltimos12Meses($de, $ate, $tipo, $diagnostico)
{

	$sql = "create temporary table tmp_001 ";		
	$sql .= "	SELECT ";
	$sql .= "		Month(contato.dataa) mes, ";
	$sql .= "		Year(contato.dataa) ano, ";
	$sql .= "	count(  *  )  AS soma ";
	$sql .= "	FROM  ";
	$sql .= "		contato, usuario, chamado, sistema, diagnostico ";
	$sql .= "	WHERE  ";

	if ($tipo=='R') {
		$sql .= "contato.destinatario_id = 6 ";
		$sql .= "AND contato.consultor_id <>6  ";
	} else 	if ($tipo=='E') {
		$sql .= "contato.destinatario_id <> 6 ";
		$sql .= "AND contato.consultor_id = 6  ";	
	} else {
		$sql .= "(( contato.destinatario_id = 6 ";
		$sql .= "   AND contato.consultor_id <>6) OR  ";
		$sql .= "( contato.destinatario_id <> 6 ";
		$sql .= "  AND contato.consultor_id = 6))  ";	
	}

	$sql .= "		AND usuario.id_usuario = contato.consultor_id ";
	$sql .= "		AND contato.chamado_id = chamado.id_chamado ";
	$sql .= "		AND sistema.id_sistema = chamado.sistema_id ";
	$sql .= "		AND diagnostico.id_diagnostico = chamado.diagnostico_id ";
	$sql .= "		AND contato.dataa >=  '$de' ";
	$sql .= "		AND contato.dataa <=  '$ate' ";
	$sql .= "	GROUP  BY ";
	$sql .= "		Month(contato.dataa), ";
	$sql .= "		Year(contato.dataa), ";
	$sql .= "		contato.chamado_id ";
	$sql .= "	order by ";
	$sql .= "	Year(contato.dataa), ";
	$sql .= "	Month(contato.dataa), ";
	$sql .= "	soma desc ";
	mysql_query("DROP TABLE IF EXISTS tmp_001;");
    mysql_query($sql);	

	$sql = "create temporary table tmp_002 ";
	$sql .= "	select mes, ano, soma as interacoes,  ";
	$sql .= "	count(*) as soma, count(1) * soma total ";
	$sql .= "	from tmp_001 ";
	$sql .= "	group by mes, ano, soma; ";
	mysql_query("DROP TABLE IF EXISTS tmp_002;");	
    mysql_query($sql) or die (mysql_error());

	$sql =  "	select mes, ano, sum(total)/ sum(soma) media  from tmp_002 ";
	$sql .= "	group by ano, mes";
	return $sql;
}
  

?>