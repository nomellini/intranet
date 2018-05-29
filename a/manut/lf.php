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
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA03A.CBL";
*/


$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA07A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA09A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA10A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA11A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA12A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA13A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA14A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA15A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA16A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA17A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA18A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA19A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA20A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFA21A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB07A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFB09A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC07A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC09A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC10A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC11A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFC12A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD07A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD09A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD10A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD11A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD12A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD13A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFD14A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFE01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFE02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFF01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFF02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFF03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFF04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG02A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG07A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFG08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH01A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH03A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH04A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH05A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH06A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFH08A.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFINSTAL.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFMENU.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFREMP.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFREMPDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRGEA.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRGEADB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRGER.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRGERDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRIMP.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRIMPDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLAA.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLAADB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLAN.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLANDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLIA.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLIADB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLNI.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRLNIDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRREC.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRRECDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRTAB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRTABDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRTER.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFRTERDB.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS001.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS002.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS003.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS004.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS005.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS006.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS007.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS008.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS009.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS010.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS011.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS012.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS013.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS014.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS015.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS016.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS017.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS018.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS019.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS020.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS021.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS023.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS024.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS025.CBL";
$temp[$c++] =  "CONVERSAO FUJITSU - Livros Fiscais - LFS034.CBL";


$SistemaId = 5;
$CategoriaId = 1263;
$MotivoId = 47;
$ChamadoPaiId = 293437;
$ChamadoPaiMotivo = "P";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [293.437]";


	
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