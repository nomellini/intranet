<?
	/*
		As linhas abaixo encaminham para o email apenas o contato.
		Eliminando o texto de alteração de prioridade
	*/
	$_contato = $objContato->historico;
	$contato = split('->', $_contato);
	$contato = $contato[0];
	$Empresa = pegacliente($objChamado->cliente_id);
	$msg="<body>
<p>Caro(a) <strong>$objChamado->nomecliente</strong> - $Empresa<br><br>
A consultoria da Datamace inseriu conte&uacute;do em seu chamado <strong>$objChamado->id_chamado</strong>.<br>
  <br>
  Voc&ecirc; poder&aacute; visualizar o andamento deste chamado e at&eacute; inserir um novo coment&aacute;rio e/ou anexar um arquivo em um contato inserido por voc&ecirc;, bastando para isso, acessar o Portal do Cliente <a href=\"http://www.datamace.com.br/PortalCliente\">clicando aqui</a>.<br>
  <br>
  <strong>Descri&ccedil;&atilde;o do chamado</strong>:<br>
  $objChamado->descricao<br>
  <br>
  <strong>Ultimo contato estabelecido</strong>:<br>
  $contato<br>
  <br>
  Para saber tudo sobre esse chamado, consulte o Atendimento On Line no site, <a href=\"http://www.datamace.com.br/PortalCliente\">clicando aqui</a></p>
</body>
</html>";
 
 $recipient = "$objChamado->email"; 
 $subject = "Chamado $objChamado->id_chamado - Novo Contato";
 $headers = "Suporte Datamace";

 // Substituir aqui.
 mail2($recipient, $subject, $msg, $headers); 
 //$msg .= "<br>$headers";
 //mail2('fernando.nomellini@datamace.com.br', $subject, $msg, $headers); 
?>