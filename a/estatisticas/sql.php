<?
function getSql_001($de, $ate, $id)
{
	$sql_001 = "SELECT nome, count(*)  AS soma ";
	$sql_001 .= "FROM contato, usuario, chamado c ";
	$sql_001 .= "WHERE contato.destinatario_id = $id and c.id_chamado = contato.chamado_id and c.visible = 1 ";
	$sql_001 .= "AND usuario.id_usuario = contato.consultor_id  ";
	$sql_001 .= "AND contato.dataa >=  '$de' AND contato.dataa <=  '$ate' ";
	$sql_001 .= "GROUP  BY contato.consultor_id ";
	$sql_001 .= "ORDER  BY soma DESC, nome ";

	return $sql_001;
}


function getSql_002($de, $ate, $id)
{
	$sql_002 = "SELECT id_sistema, sistema, count(  *  )  AS soma ";
	$sql_002 .= "FROM contato, chamado, sistema ";
	$sql_002 .= "WHERE contato.destinatario_id = $id ";
	/*
	$sql_002 .= "AND contato.consultor_id <> 39 ";
	$sql_002 .= "AND contato.consultor_id <> 85 ";
	$sql_002 .= "AND contato.consultor_id <> 14 ";
	$sql_002 .= "AND contato.consultor_id <> 90 ";
	$sql_002 .= "AND contato.consultor_id <> 98 ";
	$sql_002 .= "AND contato.consultor_id <> 172 ";
	$sql_002 .= "AND contato.consultor_id <> 173 ";
	$sql_002 .= "AND contato.consultor_id <> 12 ";
	$sql_002 .= "AND contato.consultor_id <> 43 ";
	$sql_002 .= "AND contato.consultor_id <> 169 ";
	$sql_002 .= "AND contato.consultor_id <> 170 ";
	$sql_002 .= "AND contato.consultor_id <> 171 ";
	$sql_002 .= "AND contato.consultor_id <> 178 ";
	$sql_002 .= "AND contato.consultor_id <> 08 ";
	*/
	$sql_002 .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql_002 .= "AND sistema.id_sistema = chamado.sistema_id   and chamado.visible = 1 ";
	$sql_002 .= "AND contato.dataa >=  '$de'  ";
	$sql_002 .= "AND contato.dataa <=  '$ate' ";
	$sql_002 .= "GROUP  BY sistema.sistema ";
	$sql_002 .= "ORDER  BY soma DESC, sistema.sistema ";

	return $sql_002;
}


function getSqlContatosPorSistema($de, $ate, $id)
{
	$sql_003 = "create temporary table tmpContatosPorSistema ";
	$sql_003 .= "SELECT contato.chamado_id, sistema,  count(*) AS soma ";
	$sql_003 .= "FROM contato, chamado, sistema  ";
	$sql_003 .= "WHERE contato.destinatario_id = $id ";
	$sql_003 .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql_003 .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql_003 .= "AND contato.dataa >=  '$de'  ";
	$sql_003 .= "AND contato.dataa <=  '$ate' ";
	$sql_003 .= "GROUP  BY contato.chamado_id ";
	$sql_003 .= "ORDER  BY sistema, contato.chamado_id";
	mysql_query("DROP TABLE IF EXISTS tmpContatosPorSistema;");
    mysql_query($sql_003);
	$sql_003 = "select sistema, count(1) as soma from tmpContatosPorSistema group by sistema order by count(1) desc";
	return $sql_003;
}

function getSqlDiagnosticos_com($de, $ate, $id)
{

	$sql = "create temporary table tmpDiagnostico ";
	$sql .= "SELECT contato.chamado_id, sistema,  ";
	$sql .= "coalesce(diagnostico.diagnostico, 'Em análise') diagnostico, count(  *  )  AS soma ";
	$sql .= "FROM ";
	$sql .= "	contato ";
	$sql .= "	inner join chamado on contato.chamado_id = chamado.id_chamado ";
	$sql .= "	inner join sistema on sistema.id_sistema = chamado.sistema_id ";
	$sql .= "	left join diagnostico on diagnostico.id_diagnostico = chamado.diagnostico_id  ";

	$sql .= "WHERE contato.destinatario_id = $id and chamado.visible = 1 ";

	$sql .= "AND contato.consultor_id <> 39 ";
	$sql .= "AND contato.consultor_id <> 85 ";
	$sql .= "AND contato.consultor_id <> 14 ";
	$sql .= "AND contato.consultor_id <> 215 ";
	$sql .= "AND contato.consultor_id <> 90 ";
	$sql .= "AND contato.consultor_id <> 98 ";
	$sql .= "AND contato.consultor_id <> 172 ";
	$sql .= "AND contato.consultor_id <> 173 ";
	$sql .= "AND contato.consultor_id <> 12 ";
	$sql .= "AND contato.consultor_id <> 43 ";
	$sql .= "AND contato.consultor_id <> 169 ";
	$sql .= "AND contato.consultor_id <> 170 ";
	$sql .= "AND contato.consultor_id <> 171 ";
	$sql .= "AND contato.consultor_id <> 178 ";
	$sql .= "AND contato.consultor_id <> 08 ";

	$sql .= "AND contato.dataa >=  '$de'  ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY sistema, contato.chamado_id ";

	mysql_query("DROP TABLE IF EXISTS tmpDiagnostico;");
    mysql_query($sql);

	$sql = "select diagnostico descricao, count(1) as soma from tmpDiagnostico group by diagnostico order by count(1) desc";
	return $sql;


}


function getSqlDiagnosticos($de, $ate, $id)
{

	$sql = "create temporary table tmpDiagnostico ";
	$sql .= "SELECT contato.chamado_id, sistema,  ";
	$sql .= "coalesce(diagnostico.diagnostico, 'Em analise') diagnostico, count(  *  )  AS soma ";
	$sql .= "FROM ";
	$sql .= "	contato ";
	$sql .= "	inner join chamado on contato.chamado_id = chamado.id_chamado ";
	$sql .= "	inner join sistema on sistema.id_sistema = chamado.sistema_id ";
	$sql .= "	left join diagnostico on diagnostico.id_diagnostico = chamado.diagnostico_id  ";

	$sql .= "WHERE contato.destinatario_id = $id and chamado.visible = 1 ";
	/*
	$sql .= "AND contato.consultor_id <> 39 ";
	$sql .= "AND contato.consultor_id <> 85 ";
	$sql .= "AND contato.consultor_id <> 14 ";
	$sql .= "AND contato.consultor_id <> 90 ";
	$sql .= "AND contato.consultor_id <> 98 ";
	$sql .= "AND contato.consultor_id <> 172 ";
	$sql .= "AND contato.consultor_id <> 173 ";
	$sql .= "AND contato.consultor_id <> 12 ";
	$sql .= "AND contato.consultor_id <> 43 ";
	$sql .= "AND contato.consultor_id <> 169 ";
	$sql .= "AND contato.consultor_id <> 170 ";
	$sql .= "AND contato.consultor_id <> 171 ";
	$sql .= "AND contato.consultor_id <> 178 ";
	$sql .= "AND contato.consultor_id <> 08 ";
	*/
	$sql .= "AND contato.dataa >=  '$de'  ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY sistema, contato.chamado_id ";

	//echo($sql);

	mysql_query("DROP TABLE IF EXISTS tmpDiagnostico;");
    mysql_query($sql);

	$sql = "select diagnostico descricao, count(1) as soma from tmpDiagnostico group by diagnostico order by count(1) desc";
	return $sql;


}


function getSqlGraficoContatosSistema($sistema_id, $de, $ate, $id)
{
	$sql= "";
	$sql .= "SELECT Month(contato.dataa) mes, Year(contato.Dataa) ano, count(  *  )  AS soma ";
	$sql .= "FROM contato, chamado, sistema ";
	$sql .= "WHERE contato.destinatario_id = $id and chamado.visible = 1 ";
	$sql .= "AND contato.consultor_id not in (39, 85, 14, 215, 90, 98, 172, 173, 12, 43, 169) ";
	$sql .= "AND contato.consultor_id not in (170, 171, 178, 08) ";
	$sql .= "AND contato.chamado_id = chamado.id_chamado ";
	$sql .= "AND sistema.id_sistema = chamado.sistema_id ";
	$sql .= "and sistema.id_sistema = $sistema_id ";
	$sql .= "AND contato.dataa >=  '$de' ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY Year(contato.Dataa), Month(contato.dataa) ";

	return $sql;
}

function getSqlMaioresInteracoesConsultoria($de, $ate, $id)
{
	$sql = "";
	$sql .= "SELECT ";
	$sql .= "	contato.chamado_id, sistema,  ";
	$sql .= "	diagnostico.diagnostico,  ";
	$sql .= "   count(  *  )  AS soma ";
	$sql .= "FROM  ";
	$sql .= "	contato, usuario, chamado, sistema, diagnostico ";
	$sql .= "WHERE  ";
	$sql .= "	contato.destinatario_id = $id  and chamado.visible = 1 ";
	$sql .= "AND contato.consultor_id = 54  ";
	$sql .= "AND usuario.id_usuario = contato.consultor_id  ";
	$sql .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql .= "AND diagnostico.id_diagnostico = chamado.diagnostico_id  ";
	$sql .= "AND contato.dataa >=  '$de'  ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY contato.chamado_id ";
	$sql .= "ORDER  BY soma desc, contato.chamado_id ";
	$sql .= "LIMIT 30 ";
	return $sql;
}



function getSqlContatosPorPessoaQualidade($de, $ate, $id)
{
	$sql = "";
	$sql .= "SELECT nome, count(  *  )  AS soma ";
	$sql .= "FROM contato, usuario ";
	$sql .= "WHERE destinatario_id in (14, 215) ";
	$sql .= "AND usuario.id_usuario = consultor_id  ";
	$sql .= "AND dataa >=  '$de' AND dataa <=  '$ate' ";
	$sql .= "GROUP  BY consultor_id ";
	$sql .= "ORDER  BY soma DESC, nome ";
	return $sql;
}

function getSqlContatosPorSistemaQualidade($de, $ate, $id)
{
	$sql = " ";
	$sql .= "SELECT sistema, count(  *  )  AS soma ";
	$sql .= "FROM contato, chamado, sistema ";
	$sql .= "WHERE contato.destinatario_id in (14, 215) ";
	$sql .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql .= "AND contato.dataa >=  '$de'  ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY sistema.sistema ";
	$sql .= "ORDER  BY soma DESC, sistema.sistema ";
	return $sql;
}

function getSqlChamadosPorSistemaQualidade($de, $ate, $id)
{
	$sql = "create temporary table tmpQuery ";
	$sql .= "SELECT contato.chamado_id, sistema,  count(  *  )  AS soma ";
	$sql .= "FROM contato, chamado, sistema  ";
	$sql .= "WHERE contato.destinatario_id in (14, 215)  and chamado.visible = 1  ";
	$sql .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql .= "AND contato.dataa >=  '$de'  ";
	$sql .= "AND contato.dataa <=  '$ate' ";
	$sql .= "GROUP  BY contato.chamado_id ";
	mysql_query("DROP TABLE IF EXISTS tmpQuery;");
    mysql_query($sql);
	$sql = "select sistema, count(1) as soma from tmpQuery group by sistema order by count(1) desc";
	return $sql;
}
?>