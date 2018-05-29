<?
$msg="DATAMACE INFORMÁTICA
--------------------
$objChamado->nomecliente,

A Divisão de Suporte inseriu conteúdo em seu chamado [$objChamado->id_chamado]
e você poderá visualizar o andamento e até inserir um novo comentário.


Descrição do chamado:
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