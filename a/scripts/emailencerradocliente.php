<?
$msg="DATAMACE INFORMСTICA
--------------------
$objChamado->nomecliente,

  Encerramento do chamado: $objChamado->id_chamado
  A divisуo de Suporte concluiu seu chamado, consulte o site, caso nуo concorde com a soluчуo, abra um novo chamado.


Descriчуo do chamado:
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