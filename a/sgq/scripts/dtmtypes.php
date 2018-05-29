<?

//
//	Autor     : Fernando Nomellini
//	Data      : 19.01.2005
//	Sistema   : Gest�o da qualidade
//  Descri��o : Constantes de uso geral
//

/*
    Tipos de itens
	1 - Ocorrencia
	2 - A��o Melhoria
	3 - A��o preventiva
	4 - N�o conformidade
*/

	define("TIPO_ITEM_OCORRENCIA",         001);
	define("TIPO_ITEM_ACAO_MELHORIA",      002);
	define("TIPO_ITEM_ACAO_PREVENTIVA",    003);
	define("TIPO_ITEM_NAO_CONFORMIDADE",   004);	

/*
	- A��o de melhoria
	- Constantes de Status

*/	
	define("STATUS_MEL_ABERTO",           2001);
	define("STATUS_MEL_AG_ORCAMENTO",     2002);
	define("STATUS_MEL_EM_ANDAMENTO",     2003);
	define("STATUS_MEL_AG_VERIFICACAO",   2004);
	define("STATUS_MEL_AG_ENCERRAMENTO",  2005);	
	define("STATUS_MEL_ENCERRADO",        0000); 
		
	
	function QuotedStr($AValue) {
	  return "'" . $AValue . "'";
	}
	
?>