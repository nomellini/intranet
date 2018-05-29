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

$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTMENU";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTREMP";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTREMPDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRBEM";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRBEMDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRCAN";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRCANDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRCCT";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRCCTDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRDEM";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRDEMDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRDIA";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRETC";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRETCDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRGEA";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRGEADB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRHIS";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRHISDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRLAN";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRLANDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRMVB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRMVBDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTROCC";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTROCCDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRORC";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRPLA";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRPLADB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRRTC";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRRTCDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTAB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTABDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTER";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTERDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTRB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRTRBDB";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS002";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS003";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS004";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS005";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS007";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS008";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS009";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS010";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS011";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS012";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS013";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS014";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS015";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS016";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTS017";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA02B";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA06B";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA08A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA09A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA10A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTA11A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTB07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTC08A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTD06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE08A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE09A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTE10A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF02A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF08A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF09A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF10A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF11A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTF12A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG01A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG03A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG04A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG05A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG06A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG07A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG08A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG09A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG10A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTG11A";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTRIMP";
$temp[$c++] = "CONVERSÃO FUJITSU - CT - Contabilidade - CTV700A";


$SistemaId = 2; // CONTABILIDADE
$CategoriaId = 1260;
$MotivoId = 47;
$ChamadoPaiId = 286652;
$ChamadoPaiMotivo = "P";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [286.652]";


	
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
	

	echo $id_chamado . "<br>";
	
	
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