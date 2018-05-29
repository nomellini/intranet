<?
function GetLabelDescricao($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Descri��o de n�o conformidade";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Objetivo da a��o preventiva";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Descri��o da a��o de melhoria";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return "Descri��o do Projeto"	;  
	
}

function GetLabelCausa($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Causa raiz";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Potencial causa raiz";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "A��o de melhoria";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return ""	 ; 
}

function GetLabelProposta($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "A��o Corretiva";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Proposta de a��o preventiva";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Objetivos";
	if ($ATipo == SAD_ABERTURAPROJETO)
	  return ""	;  
}

function GetLabelTitulo($ATipo) {
	if ($ATipo == SAD_NAOCONFORMIDADE) 
	  return "Relat�rio de n�o conformidade <b>RNC</b>";
	if ($ATipo == SAD_ACAOPREVENTIVA) 
	  return "Relat�rio de A��o Preventiva <b>RAP</b>";
	if ($ATipo == SAD_ACAOMELHORIA)
	  return "Registro de A��es de Melhoria <b>ACM</b>" ;
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