<?
function CriarPesquisa($id_chamado, $id_contato, $Email)
{
	$Data_Hora_Atual = date("Y-m-d H:i:s");
	$guid = GUID();	
	$Sql = "insert into chamado_pesquisa (guid, id_chamado, id_contato, dt_criacao, Ds_Email) ";
	$Sql .= " values ('$guid', $id_chamado, $id_contato, '$Data_Hora_Atual', '$Email')";	
	mysql_query($Sql);				
	
		
	$headers = "Suporte Datamace";
	$subject = "Pesquisa Chamado $id_chamado";
	$msg = "<a href=\"http://intranet.datamace.com.br/sad/r.php?id=$guid\">Responder Pesquisa</a> - $Email";

/*		
	$recipient = "fernando.nomellini@datamace.com.br";
	mail2($recipient, $subject, $msg, $headers); 
	
	$recipient = "helio@datamace.com.br";
	mail2($recipient, $subject, $msg, $headers); 
	*/
	
}	

function GravarPesquisa($Guid, $Solucionado, $Nota, $Texto)
{
	
		
	$Hoje = date("Y-m-d H:i:s");
	
	$Texto = mysql_real_escape_string($Texto);
	
	$sql = "update chamado_pesquisa set ";
	$sql .= " dt_resposta='$Hoje', ";	
	$sql .= " Ds_Justificativa = '$Texto', ";
	$sql .= " ic_solucionado='$Solucionado', ";		
	$sql .= " vl_nota=$Nota ";		
	$sql .= " where guid = '$Guid' and dt_resposta is null";
		
	
	mysql_query($sql) or die(mysql_error());
}

function obterPesquisaPorGuid($Guid)
{
	$sql = "select
			  date(cp.dt_criacao) dt_criacao,
			  time(cp.dt_criacao) hr_criacao,			  			  
			  date(cp.dt_resposta) dt_resposta,
			  time(cp.dt_resposta) hr_resposta,			  
			  cp.ic_solucionado,
			  cp.vl_nota,
			  cp.id_chamado,
			  ch.descricao descricao,
			  ct.historico historico,
			  u.nome
			  
			from
			  chamado_pesquisa cp 
				inner join chamado ch on cp.id_chamado = ch.id_chamado
				inner join contato ct on ct.id_contato = cp.id_contato
				left join usuario u on u.id_usuario = ct.consultor_id
			where cp.guid = '$Guid'";
			
	$result = mysql_query($sql);
	
	$linha = mysql_fetch_object($result);
	return $linha;	
}




?>