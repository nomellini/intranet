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

$Destinatario = 98;
$Consultor = 98;

	$Email = PegaEmailUsuario($Destinatario);
	$NomeCliente = peganomeusuario($Destinatario);


$c = 1;
$temp = array();

$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTV200A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTA008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTB010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTC008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Sistema Interno - DTS002.CBL";

$SistemaId = 102; 
$CategoriaId = 1325;
$MotivoId = 47;
$ChamadoPaiId = 299011;
$ChamadoPaiMotivo = "P";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [$ChamadoPaiId]";
	
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
	

	echo "[" . $id_chamado . "]<br>";
	
	
	$sql = "insert into contato ( ";
	$sql .= " chamado_id, pessoacontatada, origem_id, "; 
	$sql .= " historico, consultor_id, destinatario_id, status_id, "; 
	$sql .= " dataa, datae, horaa, horae, idc, publicar, fl_ativo ) "; 	
	$sql .= " values ( ";	
	$sql .= " $id_chamado, '$NomeCliente', 8, "; 
	$sql .= " '$Contato', 12, $Destinatario, 2, "; 
	$sql .= " '$datae', '$datae', '$horae', '$horae', $id_chamado, 0, 1"; 
	$sql .= " )";	
	
	mysql_query($sql) or die (mysql_error());
	
	
	
}
	
	
?>



</body>
</html>