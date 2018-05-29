<?

//
//	Autor     : Fernando Nomellini
//	Data      : 19.01.2005
//	Sistema   : Gestуo da qualidade
//  Descriчуo : Constantes de uso geral
//

/*
    Tipos de itens
	1 - Ocorrencia
	2 - Aчуo Melhoria
	3 - Aчуo preventiva
	4 - Nуo conformidade
*/

	define("TIPO_ITEM_OCORRENCIA",         001);
	define("TIPO_ITEM_ACAO_MELHORIA",      002);
	define("TIPO_ITEM_ACAO_PREVENTIVA",    003);
	define("TIPO_ITEM_NAO_CONFORMIDADE",   004);	

/*
	- Aчуo de melhoria
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