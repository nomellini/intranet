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

$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFA009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFB008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFC013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFD001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFD002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFD003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFD004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFD005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFE007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFF001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFF002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFF003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFG001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFG002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFH001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFRANT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFREST.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFRIMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFRMER.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFRMOD.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFCALT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFHELP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Estatutario - EFV500A.CBL";



$SistemaId = 8; // ESTATUTARIO
$CategoriaId = 1290;
$MotivoId = 47;
$ChamadoPaiId = 294356;
$ChamadoPaiMotivo = "P";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [294.356]";


	
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