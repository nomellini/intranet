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

//$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecaoo - 
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDA14A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB01G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB02B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB02C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB03B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB05F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB06B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB06C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB06D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB06E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB07B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDB07C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC02B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC02C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC03B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC03C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC03D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC04B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC04C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC04D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC06B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDC06C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDD04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDE02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDF03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS017.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS018.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS019.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS021.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecao - RDS022.CBL";



$SistemaId = 22; 
$CategoriaId = 1308;
$MotivoId = 47;
$ChamadoPaiId = 2943764;
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
	

	echo "[" . $id_chamado . "]<br>\n";
	
	
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