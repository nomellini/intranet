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


//$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTAGEN";

$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTBARR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTBARM";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTCALEN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTEXCE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRCON";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTUSUA";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTFSCN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTCTRI";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTDATE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTDIGI";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTDTMSP2";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTINET";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTCALL";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTEDLGW";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTEDITW";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTHCID";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTHELG";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTINES";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTMUSU";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTPRIN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRAGN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRCID";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTCONNDB";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRDAT";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRDBF";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRDOC";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTREVIW";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTOPEN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRINI";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRLOG";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRMSRDB";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRMTP";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTRUSR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTSTAT";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTUSUM";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTMENUW";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTWORD";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - RTV100";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_CHANGE_DIR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_CHECK_FILE_EXIST";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_COMBINE_DIR_FILE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_COPY_FILE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_CREATE_DIR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_DELETE_FILE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_EXECUTE_PROGRAM";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_FILE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_GET_CURRENT_DIR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_GET_PROGRAMS_DIR";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_RENAME_FILE";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - CBL_SCREEN";
$temp[$c++] =  "CONVERSÃO FUJITSU - RTs - Rotinas Principais - FHRDRPWD";


$SistemaId = 9998;
$CategoriaId = 1320;
$MotivoId = 47;
$ChamadoPaiId = 286654;
$ChamadoPaiMotivo = "P";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [286.654]";


	
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