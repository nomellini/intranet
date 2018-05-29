<?
$ExternoPermitido = "S";
require_once('cabeca.inc.php');

if ($ajaxDTM == "confirmaCRC")
{
	$db = new DB();
	$prova = new treinamento($adm);
	echo $prova->checkCRC(3, $conf_crc);
}

?>