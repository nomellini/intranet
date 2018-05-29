<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<p>conversao</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<?

require("../scripts/conn.php");

$c = 1;
$temp = array();

/*
$temp[$c++] = "CONVERSAO FUJITSU - GIP - GPRAFA.CBL";
*/

/*
$temp[$c++] = "Criar log da tabela PETABPAE.CPY (Escala de Revezamento) e PETABPBJ.CPY e (Escala de revezamento detalhes)";
$temp[$c++] = "Criar log da tabela PETABPAX.CPY (HE Di".utf8_decode("á")."ria) e PETABPBI.CPY (2º Coluna)";
$temp[$c++] = "Criar log da tabela PETABPAA.CPY (HE Peri".utf8_decode("ó")."dica)";
$temp[$c++] = "Criar log da tabela PETABPAC.CPY (Contas Para o GIP)";
$temp[$c++] = "Criar log da tabela PETABPAD.CPY (Contas Externas)";
$temp[$c++] = "Criar log da tabela PETABPAB.CPY (Programa".utf8_decode("ç")."".utf8_decode("ã")."o de abonos)";
$temp[$c++] = "Criar log da tabela PETABPAN.CPY (Tabela de compensa".utf8_decode("ç")."".utf8_decode("ã")."o)";
$temp[$c++] = "Criar log da tabela PETABPAF.CPY (Tabela de Feriados)";
$temp[$c++] = "Criar log da tabela PETABPAM.CPY (Tabela de Motivo)";
$temp[$c++] = "Criar log da tabela PETABPAQ.CPY (Tabela de Aloca".utf8_decode("ç")."".utf8_decode("ã")."o de M".utf8_decode("ã")."o de Obra)";
$temp[$c++] = "Criar log da tabela PETABPAR.CPY (Tabela de Refei".utf8_decode("ç")."".utf8_decode("õ")."es)";
$temp[$c++] = "Criar log da tabela PETABPAG.CPY (Tabela de Refei".utf8_decode("ç")."".utf8_decode("õ")."es externas)";
$temp[$c++] = "Criar log da tabela PETABPBG.CPY (Cadastro de Locais)";
$temp[$c++] = "Criar log da tabela PETABPAW.CPY (Configura".utf8_decode("ç")."".utf8_decode("ã")."o da manuten".utf8_decode("ç")."".utf8_decode("ã")."o)";
$temp[$c++] = "Criar log da tabela PETABPAT.CPY (Tabela de terminais)";
$temp[$c++] = "Criar log da tabela PETABPAZ.CPY (Par".utf8_decode("â")."metros da classifica".utf8_decode("ç")."".utf8_decode("ã")."o autom".utf8_decode("á")."tica)";
$temp[$c++] = "Criar log da tabela PETABPAU.CPY (Par".utf8_decode("â")."metros da coleta e classifica".utf8_decode("ç")."".utf8_decode("ã")."o autom".utf8_decode("á")."tica de REPs)";
$temp[$c++] = "Criar log da tabela PETABPAY.CPY (Par".utf8_decode("â")."metros do FTP)";
$temp[$c++] = "Criar log da tabela PETABPBA.CPY (Regra de coleta de equipamentos) e PETABPBH.CPY (Equipamentos da regra de coleta)";
$temp[$c++] = "Criar log da tabela PETABPAS.CPY (Tabela de mensagens da classifica".utf8_decode("ç")."".utf8_decode("ã")."o) e PETABPAO.CPY (Mensagens)";
$temp[$c++] = "Criar log da tabela PETABPAK.CPY (Ocorr".utf8_decode("ê")."ncias do apontamento)";
$temp[$c++] = "Criar log da tabela PETABPBB.CPY (Ocorr".utf8_decode("ê")."ncias da classifica".utf8_decode("ç")."".utf8_decode("ã")."o)";
$temp[$c++] = "Criar log da tabela PETABPAJ.CPY (Exporta".utf8_decode("ç")."".utf8_decode("ã")."o da Folha)";
$temp[$c++] = "Criar log da tabela PETABPBF.CPY (Configura".utf8_decode("ç")."".utf8_decode("ã")."o do Controle de acesso)";
$temp[$c++] = "Criar log da tabela PETABPCA.CPY (Envio de e-mail a visitados)";
$temp[$c++] = "Criar log da tabela PETABPBC.CPY (Regra de coleta - Alertas)";
$temp[$c++] = "Criar log da tabela PETABPAL.CPY (Tabela de Linha de ".utf8_decode("Ô")."nibus)";
$temp[$c++] = "Criar log da tabela PETABPBD.CPY (Cadastro Nextel)";
$temp[$c++] = "Criar log da tabela PETABPBE.CPY (Agendamento Nextel)";*/

$Consultor = 175; // Lucas

$Destinatario = 7; //Ricardo
//$Destinatario = 225; //Felipe
//$Destinatario = 85; //Altenier
//$Destinatario = 172; //Edilson
//$Destinatario = 175; // Lucas

//$SistemaId = 5;  //LF
//$CategoriaId = 934; //LF

//$SistemaId = 33;  //CA
//$CategoriaId = 1002; //CA

//$SistemaId = 9998;  //outros
//$CategoriaId = 1355; //outros

$SistemaId = 4;  //PE
$CategoriaId = 872; //PE

//$SistemaId = 6;  //RH
//$CategoriaId = 927; //RH

//$SistemaId = 1;  //GP
//$CategoriaId = 919; //GP

//$SistemaId = 2;  //CT
//$CategoriaId = 932; //CT

//$SistemaId = 16;  //OP
//$CategoriaId = 999; //OP

//$SistemaId = 103;  //GRHNET
//$CategoriaId = 1243; //GRHNET

// ----------- fixos
$Email = PegaEmailUsuario($Destinatario);
$NomeCliente = peganomeusuario($Destinatario);
$MotivoId = 47;
$ChamadoPaiId = 0;
//$ChamadoPaiMotivo = "P";
$ChamadoPai = 380739;

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Conforme chamado de origem [$ChamadoPai]";
	
	$Chamado = mysql_real_escape_string ($Chamado);
	$Contato = mysql_real_escape_string ($Contato);	
    $datae = date("Y-m-d");
    $horae = date("H:i:s");	
	
		
	$sql = "insert into chamado ( ";
	$sql .= " consultor_id, cliente_id, sistema_id, categoria_id, ";
	$sql .= " prioridade_id, motivo_id, descricao, dataa, status, horaa, ";
	$sql .= " destinatario_id, remetente_id, diagnostico_id, email, lido, ";
	$sql .= " lidodono, nomecliente, datauc, horauc, visible, chamado_pai_id, chamado_pai_motivo  ) ";	
	$sql .= " values ( ";
	$sql .= " $Consultor, 'DATAMACE', $SistemaId, $CategoriaId, ";
	$sql .= " 1, $MotivoId, '$Chamado', '$datae', 2, '$horae', ";
	$sql .= " $Destinatario, $Consultor, 0, '$Email', 0, ";
	$sql .= " 1, '$NomeCliente', '$datae', '$horae', 1, $ChamadoPaiId, '$ChamadoPaiMotivo' )";
	
	mysql_query($sql) or die (mysql_error());			
	
	$sql = "select id_chamado from chamado where sistema_id = $SistemaId and remetente_id = $Consultor and destinatario_id = $Destinatario order by id_chamado desc limit 1";	
	
	$result = mysql_query($sql);
	
	$linha = mysql_fetch_object($result);
		
	$id_chamado = $linha->id_chamado;
	

	echo $temp[$i] . " [" . $id_chamado . "]<br>";
	
	
	$sql = "insert into contato ( ";
	$sql .= " chamado_id, pessoacontatada, origem_id, "; 
	$sql .= " historico, consultor_id, destinatario_id, status_id, "; 
	$sql .= " dataa, datae, horaa, horae, idc, publicar, fl_ativo ) "; 	
	$sql .= " values ( ";	
	$sql .= " $id_chamado, '$NomeCliente', 8, "; 
	$sql .= " '$Contato', $Consultor, $Destinatario, 2, "; 
	$sql .= " '$datae', '$datae', '$horae', '$horae', $id_chamado, 0, 1"; 
	$sql .= " )";	
	
	mysql_query($sql) or die (mysql_error());
	
	
	
}
	
	
?>



</body>
</html>