<?
$msg="DATAMACE INFORMÁTICA
--------------------
$objChamado->nomecliente,

  Encerramento do chamado: $objChamado->id_chamado
  A divisão de Suporte concluiu seu chamado, consulte o site, caso não concorde com a solução, abra um novo chamado.


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
 mail2($recipient, $subject, $msg, $headers); 
 
?>