<?
$msg="DATAMACE INFORM�TICA
--------------------
$objChamado->nomecliente,

  Encerramento do chamado: $objChamado->id_chamado
  A divis�o de Suporte concluiu seu chamado, consulte o site, caso n�o concorde com a solu��o, abra um novo chamado.


Descri��o do chamado:
---------------------
$objChamado->descricao

Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa
----------------------------
$objContato->historico

Para saber tudo sobre esse chamado, consulte o Atendimento On Line no site.
http://www.datamace.com.br -> Comunidade -> Apoio ao cliente -> Atendimento On line";
	
	$recipient = "$objChamado->email"; 
	$subject = "Chamado $objChamado->id_chamado - Encerramento";
	$headers = "Suporte Datamace";
	
	if ($objChamado->externo) { 
		mail2($recipient, $subject, $msg, $headers); 
	}
	
	$recipient = "fernando.nomellini@datamace.com.br"; // Deletar	
	mail2($recipient, $subject, $msg, $headers); 	  // Deletar
?>