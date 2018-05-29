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

//$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - 
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA05B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REA13A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB13A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14L.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB14M.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB15L.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB16A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REB17A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC09B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC10B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC10C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC10D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REC11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RED10B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REE02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REE03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REE04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REE05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REF01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REF02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REF03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REG12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REH07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REI01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REI02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - REI03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES029.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES030.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES050.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES051.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES052.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Seguranca do Trabalho - RES054.CBL";



$SistemaId = 23; 
$CategoriaId = 1305;
$MotivoId = 47;
$ChamadoPaiId = 294376;
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