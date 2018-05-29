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

$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRIMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPV200A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPA02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPB01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPB02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPB03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPB04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPB05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPC08A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPD01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPD04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRPAR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRPARDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRPOC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRPOCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRSIM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRSIMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRTBO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRTBODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRUSA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPRUSADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Orcamento de Pessoal - OPS003.CBL";



$SistemaId = 16; 
$CategoriaId = 1302;
$MotivoId = 47;
$ChamadoPaiId = 294372;
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