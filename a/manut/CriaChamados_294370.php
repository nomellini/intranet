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

$temp[$c++] = "CONVERSAO FUJITSU - Medicina - DIV/TESTES";

//$temp[$c++] = "CONVERSAO FUJITSU - Recrutamento e Selecaoo - 
/*
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA13F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA14A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA15A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA16A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFA17A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB08L.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFB11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06L.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC06M.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC12B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFC12C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFD01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFD02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFD03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFE02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFE03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFE04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFE05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFF01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFF02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG04B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFG08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Medicina - RFS005.CBL";
*/


$SistemaId = 24; 
$CategoriaId = 1306;
$MotivoId = 47;
$ChamadoPaiId = 294370;
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