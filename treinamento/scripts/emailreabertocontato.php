<?
  list($tmp1, $tmp) = each( pegaClientePorCodigo($objChamado->cliente_id) );
  $Cliente = $tmp["cliente"];
  
  list($tmp1, $tmp) = each( pegaUsuario($id_usuario) );
  $emailUsuario = $tmp["email"];
  $novoDono = $tmp["nome"];
  $emailsn = $tmp["emailsn"];
  
  list($tmp1, $tmp) = each( pegaUsuario($objChamado->consultor_id) );
  $antigoDono = $tmp["nome"];   
  $emailAntigoDono = $tmp["email"]; 
  
  $sistema = pegaSistema( $objChamado->sistema_id );

  $msg = "<img src=\"http://$host/a/figuras/intro.gif\" width=\"321\" height=\"21\"><br><br>";
  $msg.="O Chamado <a href=\"http://10.98.0.5/a/historicochamado.php?id_chamado=$objChamado->id_chamado\">$objChamado->id_chamado</a> foi reaberto por $novoDono<br>
<br>
Chamado   : $objChamado->id_chamado<br>
Aberto em : $objChamado->dataaf - $objChamado->horaa<br>
Codigo    : $objChamado->cliente_id<br>
Cliente   : $Cliente<br>
Sistema   : $sistema<br>
<br>
Descrição do chamado:<br>
---------------------<br>
$objChamado->descricao<br>
<br>
Descrição do Contato:<br>
---------------------<br>
$historico<br>
<br>Para saber mais detalhes sobre esse chamado, <a href=\"http://10.98.0.5/a/historicochamado.php?id_chamado=$objChamado->id_chamado\"><b>Clique aqui</b></a><br><br>
";

  $recipient = "$emailAntigoDono"; 
  $subject = "S.A.D. - Reabertura de Chamado";
  $headers = "";
  $headers .= "From: $novoDono <$emailUsuario>\n";
  $headers .= "Content-Type: text/html; charset=iso-8859-1\n"; // Mime type
  
  mail2($recipient, $subject, $msg, $headers);
?>