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

/*
$temp[$c++] = "CONVERSAO FUJITSU - GIP - GPRAFA.CBL";
*/
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - NETIMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012031.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012043.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012045.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012050.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012053.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012054.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012055.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012060.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012061.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012062.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012064.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012065.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012067.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012071.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012074.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012086.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012090.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012092.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012093.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012094.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012098.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012108.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN012111.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013017.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013018.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013022.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013023.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013052.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013063.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013064.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN013065.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN018004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN161010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014100.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014101.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014102.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014103.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014105.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014106.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014107.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014109.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014110.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014111.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014112.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014113.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014115.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014117.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014118.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014119.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014124.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014125.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014126.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014127.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014128.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014130.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014131.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014133.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014134.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014135.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014136.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014137.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014138.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014141.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014142.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014143.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014144.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014145.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014151.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014152.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014153.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014154.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014155.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014157.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014158.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014159.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014160.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014163.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014164.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GN014167.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS021.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS041.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS042.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS045.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS070.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Relatorios do GRHNET Novo - GNS076.CBL";


$SistemaId = 12; 
$CategoriaId = 1286;
$MotivoId = 47;
$ChamadoPaiId = 300998;
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