<?
function GetLabelDescricao($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Descrição de não conformidade";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Objetivo da ação preventiva";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Descrição da ação de melhoria";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return "Descrição do Projeto"	;  
	
}

function GetLabelCausa($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Causa raiz";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Potencial causa raiz";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Ação de melhoria";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return ""	 ; 
}

function GetLabelProposta($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Ação Corretiva";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Proposta de ação preventiva";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Objetivos";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return ""	;  
}

function GetLabelTitulo($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Relatório de não conformidade <b>RNC</b>";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Relatório de Ação Preventiva <b>RAP</b>";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Registro de Ações de Melhoria <b>ACM</b>" ;
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return "<b>Abertura de projeto</b>";	  
}

function GetCategoria($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return 399;
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return 415;
	if ($ATipo == SAD_ACAOMELHORIA)
	  return 409;
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return  464;	  
}
?>