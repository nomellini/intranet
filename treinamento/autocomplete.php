<?
//Autor: Lucas Oliveira Silva
//Data: 02/09/09
//Local: Datamace
//Funчуo: Retorna um array de "descriчѕes", de acordo com a opчуo que foi passada.
include_once('cabeca.inc.php');

switch($opcao){
	case "empresa":
		$consulta = mysql_query("SELECT distinct(id_cliente) as resultado from sad.cliente order by id_cliente");
		break;
	case "instrutor":
		$consulta = mysql_query("SELECT distinct(instrutor) as resultado from treinamento.tre_usuario order by instrutor");
		break;
//	case "evento":
//		$consulta = mysql_query("SELECT distinct(evento) as resultado from treinamento.avaliatre order by evento");
//		break;
	case "local":
		$consulta = mysql_query("SELECT distinct(local) as resultado from treinamento.avaliatre order by local");
		break;
	case "evento":
		$consulta = mysql_query("(SELECT distinct(conf_evento_padrao) as resultado from treinamento.config where conf_evento_padrao <> '' order by conf_evento_padrao)".
								" union ".
								"(SELECT distinct(evento) as resultado from treinamento.avaliatre order by evento)".
								" union ".
								" (SELECT distinct(descricao) as resultado from treinamento.sistemas order by descricao)".
								" union ".
								" (SELECT distinct(descricao) as resultado from treinamento.modulos order by descricao)".
								" order by resultado");
		break;
}
if ($opcao){
	$xx = 0;
	while ($linha = mysql_fetch_object($consulta)){
		if ($xx++ > 0){
			echo ',';
		}
		echo '"'.$linha->resultado.'"';
	}
}
?>