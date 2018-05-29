<?php require_once('../../Connections/sad.php'); ?>
<?
/*

	Fernando Nomellini 29.06.2010
	Objetivo - Clonar um chamado de um numero para outro

	$chamado_origem  
	$chamado_destino
		
*/

	mysql_select_db(sad) or die(mysql_error());
	
	$sql = "select count(1) q from chamado where id_chamado = $chamado_destino";
	$result = mysql_query($sql) or die ( mysql_error() . "<br>Sql: " . $sql);
	$linha = mysql_fetch_object($result);
	if ($linha->q > 0) {
		die("Nao posso  pois $chamado_destino já existe");
	}
	
	
	$sql = "select * from chamado where id_chamado = $chamado_origem";
	$result = mysql_query($sql) or die ( mysql_error() . "<br>Sql: " . $sql);
	$linha = mysql_fetch_object($result);
	
	$sql_insert = "insert into chamado set ";
	$sql_insert .= 	"id_chamado = $chamado_destino, ";
	$sql_insert .= 	"consultor_id = $linha->consultor_id, ";
	$sql_insert .= 	"cliente_id = '$linha->cliente_id', ";
	$sql_insert .= 	"sistema_id = $linha->sistema_id, ";
	$sql_insert .= 	"categoria_id = $linha->categoria_id, ";
	$sql_insert .= 	"prioridade_id = $linha->prioridade_id, ";
	$sql_insert .= 	"motivo_id = $linha->motivo_id, ";
	$sql_insert .= 	"descricao = '$linha->descricao', ";	
	$sql_insert .= 	"dataa = '$linha->dataa', ";		
	$sql_insert .= 	"status = $linha->status, ";		
	$sql_insert .= 	"horaa = '$linha->horaa', ";		
	$sql_insert .= 	"destinatario_id = $linha->destinatario_id, ";
	$sql_insert .= 	"remetente_id = $linha->remetente_id, ";
	$sql_insert .= 	"diagnostico_id = $linha->diagnostico_id, ";
	$sql_insert .= 	"externo = $linha->externo, ";
	$sql_insert .= 	"email = '$linha->email', ";
	$sql_insert .= 	"lido = $linha->lido, ";
	$sql_insert .= 	"lidodono = $linha->lidodono, ";
	$sql_insert .= 	"datalidodestinatario = '$linha->datalidodestinatario', ";	
	$sql_insert .= 	"horalidodestinatario = '$linha->horalidodestinatario', ";		
	$sql_insert .= 	"nomecliente = '$linha->nomecliente', ";			
	$sql_insert .= 	"rnc = $linha->rnc, ";	
	$sql_insert .= 	"datauc = '$linha->datauc', ";		
	$sql_insert .= 	"horauc = '$linha->horauc', ";		
	$sql_insert .= 	"rnc_depto_responsavel = '$linha->rnc_depto_responsavel', ";
	$sql_insert .= 	"rnc_prazo = '$linha->rnc_prazo', ";	
	$sql_insert .= 	"rnc_acao_responsavel = '$linha->rnc_acao_responsavel', ";
	$sql_insert .= 	"rnc_acao_data = '$linha->rnc_acao_data', ";		
	$sql_insert .= 	"rnc_verif_responsavel = '$linha->rnc_verif_responsavel', ";		
	$sql_insert .= 	"rnc_verif_data = '$linha->rnc_verif_data', ";		
	$sql_insert .= 	"rnc_data = '$linha->rnc_data', ";		
	$sql_insert .= 	"projeto = '$linha->projeto', ";		
	$sql_insert .= 	"dataprevistaliberacao = '$linha->dataprevistaliberacao', ";		
	$sql_insert .= 	"liberado = $linha->liberado, ";		
	$sql_insert .= 	"obsliberacao = '$linha->obsliberacao', ";		
	$sql_insert .= 	"dataliberacao = '$linha->dataliberacao', ";		
	$sql_insert .= 	"obs = '$linha->obs', ";		
	$sql_insert .= 	"fl_reaberto = $linha->fl_reaberto, ";
	$sql_insert .= 	"Atualizado = '$linha->Atualizado', ";		
	$sql_insert .= 	"classificacao_id = $linha->classificacao_id, ";		
	$sql_insert .= 	"observacao = '$linha->observacao', ";		
	$sql_insert .= 	"arquivo = '$linha->arquivo', ";		
	$sql_insert .= 	"assunto = '$linha->assunto', ";		
	$sql_insert .= 	"pos_venda = $linha->pos_venda, ";		
	$sql_insert .= 	"Id_chamado_espera = $linha->Id_chamado_espera, ";		
	$sql_insert .= 	"visible = $linha->visible, ";		
	$sql_insert .= 	"fl_cobranca = $linha->fl_cobranca, ";		
	$sql_insert .= 	"usuario_id_uc = $linha->usuario_id_uc, ";		
	$sql_insert .= 	"data_limite_1 = '$linha->data_limite_1', ";		
	$sql_insert .= 	"data_limite_2 = '$linha->data_limite_2', ";		
	$sql_insert .= 	"data_limite_3 = '$linha->data_limite_3', ";		
	$sql_insert .= 	"data_limite_4 = '$linha->data_limite_4' ";			
	
    mysql_query($sql_insert) or die ( mysql_error() . "<br>Sql: " . $sql_insert);		

	
	$sql = "select * from contato where chamado_id = $chamado_origem";
	$result = mysql_query($sql) or die ( mysql_error() . "<br>Sql: " . $sql);
	while ($linha = mysql_fetch_object($result)) 
	{
		//
		$p = $linha->publicar;
		if (!$p) {
			$p = 0;
		}
		$sql_insert = "insert into contato set ";
		$sql_insert .= 	"chamado_id = $chamado_destino, ";		
		$sql_insert .= 	"pessoacontatada = '$linha->pessoacontatada', ";		
		$sql_insert .= 	"origem_id = $linha->origem_id, ";		
		$sql_insert .= 	"historico = '$linha->historico', ";		
		$sql_insert .= 	"consultor_id = $linha->consultor_id, ";		
		$sql_insert .= 	"destinatario_id = $linha->destinatario_id, ";		
		$sql_insert .= 	"status_id = $linha->status_id, ";		
		$sql_insert .= 	"dataa = '$linha->dataa', ";		
		$sql_insert .= 	"datae = '$linha->datae', ";		
		$sql_insert .= 	"horaa = '$linha->horaa', ";		
		$sql_insert .= 	"horae = '$linha->horae', ";		
		$sql_insert .= 	"publicar = $p, ";		
		$sql_insert .= 	"rnc = $linha->rnc, ";		
		$sql_insert .= 	"tipo_rnc = $linha->tipo_rnc, ";		
		$sql_insert .= 	"idc = $linha->idc, ";		
		$sql_insert .= 	"fl_ativo = $linha->fl_ativo ";		
	    mysql_query($sql_insert) or die ( mysql_error() . "<br>Sql: " . $sql_insert);				
		
		echo "<br>";
		echo $linha->historico;
				
	}
	


?>