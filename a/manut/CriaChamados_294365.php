<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?

require("../scripts/conn.php");

$Destinatario = 98;
$Consultor = 98;

	$Email = PegaEmailUsuario($Destinatario);
	$NomeCliente = peganomeusuario($Destinatario);


$c = 1;
$temp = array();

$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB01B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB01C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB03B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB03C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAB06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC01B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC04B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAC05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAD09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAF01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARAGE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARAGEDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARBLQ.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARBLQDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARCOL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARCOLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARDIG.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARDIGDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAREQP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAREQPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARGA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARGAGIP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARLHE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARLHEDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARLIB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARLIBDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARMAR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARMARDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAROCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAROCODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARPER.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARPERDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARPES.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARTAR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARTARDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARTBO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARVST.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CARVSTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Controle de Acesso - CAS009.CBL";



$SistemaId = 33; 
$CategoriaId = 1324;
$MotivoId = 47;
$ChamadoPaiId = 294365;
$ChamadoPaiMotivo = "P";

echo "<pre>";

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
	
echo "</pre>";	
?>



</body>
</html>