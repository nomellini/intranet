<?
$msg="DATAMACE INFORM�TICA
--------------------
$objChamado->nomecliente,

A Divis�o de Suporte inseriu conte�do em seu chamado [$objChamado->id_chamado]
e voc� poder� visualizar o andamento e at� inserir um novo coment�rio.


Descri��o do chamado:
---------------------
$objChamado->descricao

Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa
----------------------------
$objContato->historico

Para saber tudo sobre esse chamado, consulte o Atendimento On Line no site.
http://www.datamace.com.br -> Comunidade -> Apoio ao cliente -> Atendimento On line";
 
 $recipient = "$objChamado->email"; 
 $subject = "SAD - Chamado $objChamado->id_chamado";
 $headers = "From: Suporte Datamace <suporte@datamace.com.br>\n";

// Substituir aqui.
 mail2($recipient, $subject, $msg, $headers); 

 
?>