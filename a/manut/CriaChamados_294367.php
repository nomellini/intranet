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

$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIV800A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIMENU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIA016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIB012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIC014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DID017.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIE009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF017.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF018.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF019.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIF020.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIG013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIH012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001H.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001I.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII001J.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010B.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010C.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010D.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010E.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010F.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII010G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DII013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIJ008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIK006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIL011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIM001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIM002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIM003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIM004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIM005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN990.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN991.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN992.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIN993.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIP002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRAUT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRBCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRBIR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRCLI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRCON.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRCPG.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRCPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIREMA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIREMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIREMV.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIREST.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIREXT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRFAT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRFEC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRFIT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRFOR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRGER.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRHMA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRIMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRIPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRLIB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRMEM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRMVF.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRNFI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIROCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRORC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPAR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPEA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPED.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPES.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPOC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPRJ.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPRO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRPRP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRSIT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRTAB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRTIT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRTRF.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRVEN.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIRVPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS006.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS010G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS017.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS018.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS019.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS020.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS021.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS022.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS023.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS024.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS025.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS026.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS027.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS028.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS029.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS030.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS031.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS032.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS033.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS034.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS035.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS036.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS037.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIS039.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIT001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIT002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIZ001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIZ002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIZ003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIZ004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - DIP - DIZ005.CBL";


$SistemaId = 27; 
$CategoriaId = 1299;
$MotivoId = 47;
$ChamadoPaiId = 294367;
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