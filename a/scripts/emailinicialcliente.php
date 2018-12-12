<?
	$Empresa = pegacliente($objChamado->cliente_id);
	$msg="
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Caro(a) <b>$objChamado->nomecliente</b> - $Empresa </FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial
size=2></FONT></SPAN>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>O chamado que você encaminhou ao suporte será analisado e em breve você terá um retorno do status do atendimento.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>A Partir desse
momento ele é conhecido pelo código abaixo.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Caso você queira interagir no chamado ou saber sobre o andamento, acesse novamente o Portal e selecione a pasta Acompanhar Chamados.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial
size=2></FONT></SPAN>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>
Código :  $objChamado->id_chamado </FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>
Abertura :  $objChamado->dataaf - $objChamado->horaa </FONT></SPAN></DIV><SPAN class=592124918-13032009>
<DIV><FONT face=Arial size=2></FONT>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Suporte ao
Cliente</FONT></SPAN></SPAN></DIV>";

 $recipient = "$objChamado->email";
 $subject = "Chamado $objChamado->id_chamado - Aberto pelo cliente";
 $remetente = "Suporte Datamace";
 $headers = $remetente;

 mail2($recipient, $subject, $msg, $headers);

?>