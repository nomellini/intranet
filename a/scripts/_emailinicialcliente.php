<?
$msg="DATAMACE INFORMÁTICA
--------------------
$objChamado->nomecliente,

O chamado que você encaminhou ao suporte já está sendo analisado.
A Partir desse momento ele é conhecido pelo código designado abaixo.

  Código   : $objChamado->id_chamado
  Abertura : $objChamado->dataaf - $objChamado->horaa

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