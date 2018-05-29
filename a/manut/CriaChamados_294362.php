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

$temp[$c++] = "CONVERSAO FUJITSU - Competencias - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA01I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA02B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA02C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA02D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA02E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA03B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA03C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA03D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA04B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA04C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA04D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA04E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA05I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06L.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA06M.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA07K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA08G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA09K.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA10B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA10C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA10D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA10E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA11B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA12A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCA12B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB10A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCB11A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC09A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCC09B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCD08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCE08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCF01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCF02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCF03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCF04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG06B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCG08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCS009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCZ001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Competencias - RCZ002.CBL";


$SistemaId = 21; 
$CategoriaId = 1309;
$MotivoId = 47;
$ChamadoPaiId = 294362;
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