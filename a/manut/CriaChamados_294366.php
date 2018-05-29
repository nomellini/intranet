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

//$temp[$c++] = "CONVERSAO FUJITSU - Competencias - DIV/TESTES";

$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA10H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA11H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAA13A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAD01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAD02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAD03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE10B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE11B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE12B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE12C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE12D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE13H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAE14A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAF01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAF02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAF03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAF04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAF05B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DESEMPENHO E CARREIRA - RAS010.CBL";

$SistemaId = 19; 
$CategoriaId = 1285;
$MotivoId = 47;
$ChamadoPaiId = 294366;
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