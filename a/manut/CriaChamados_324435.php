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

$c = 1;
$temp = array();

/*
$temp[$c++] = "CONVERSAO FUJITSU - GIP - GPRAFA.CBL";
*/
/*$temp[$c++] = "Remover o Par".utf8_decode("á")."grafo de criar diar e utilizar o PES051 - CA_B_Menu\CAB03A.CBL";
$temp[$c++] = "Remover o Par".utf8_decode("á")."grafo de criar diar e utilizar o PES051 - CA_B_Menu\CAB03B.CBL";
$temp[$c++] = "Remover o Par".utf8_decode("á")."grafo de criar diar e utilizar o PES051 - PE_B_Menu\PEB07Y.CBL";
*/

$Consultor = 175; // Lucas
//$Consultor = 173; // José Roberto

$Destinatario = 7; //Ricardo
//$Destinatario = 225; //Felipe
//$Destinatario = 85; //Altenier
//$Destinatario = 172; //Edilson
//$Destinatario = 175; // Lucas

//$SistemaId = 5;  //LF
//$CategoriaId = 934; //LF

//$SistemaId = 33;  //CA
//$CategoriaId = 1002; //CA

//$SistemaId = 9998;  //outros
//$CategoriaId = 1355; //outros

$SistemaId = 4;  //PE
$CategoriaId = 272; //TODOS MÓDULOS DO SISTEMA
//$CategoriaId = 872; //LOG

//$SistemaId = 6;  //RH
//$CategoriaId = 927; //RH

//$SistemaId = 1;  //GP
//$CategoriaId = 919; //GP

//$SistemaId = 2;  //CT
//$CategoriaId = 932; //CT

//$SistemaId = 16;  //OP
//$CategoriaId = 999; //OP

//$SistemaId = 103;  //GRHNET
//$CategoriaId = 1243; //GRHNET

// ----------- fixos
$Email = PegaEmailUsuario($Destinatario);
$NomeCliente = peganomeusuario($Destinatario);
$MotivoId = 47;
$ChamadoPaiId = 444539;
$ChamadoPaiMotivo = "P";
$ChamadoPai = 444539;

$c--;
for ($i = 1; $i <= $c; $i++)
{
	$Chamado = $temp[$i];
	$Contato = "Nova estrutura de horas extras do Ponto - PEPTOHE.CPY.<br>Chamado de origem [468866]";

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
	

	echo $temp[$i] . " [" . $id_chamado . "]<br>";
	
	
	$sql = "insert into contato ( ";
	$sql .= " chamado_id, pessoacontatada, origem_id, "; 
	$sql .= " historico, consultor_id, destinatario_id, status_id, "; 
	$sql .= " dataa, datae, horaa, horae, idc, publicar, fl_ativo ) "; 	
	$sql .= " values ( ";	
	$sql .= " $id_chamado, '$NomeCliente', 8, "; 
	$sql .= " '$Contato', $Consultor, $Destinatario, 2, "; 
	$sql .= " '$datae', '$datae', '$horae', '$horae', $id_chamado, 0, 1"; 
	$sql .= " )";	
	
	mysql_query($sql) or die (mysql_error());
	
	
	
}
	
	
?>



</body>
</html>