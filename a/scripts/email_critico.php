<?

  list($tmp1, $tmp) = each( pegaClientePorCodigoUnico($objChamado->cliente_id) );
/*	require("conn.php");
	require("classes.php");	

  $objChamado = new chamado();	
	$objContato = new contato();
	
	$objChamado->lerChamado(84497);
	$objContato->lerContato(217085);

  list($tmp1, $tmp) = each( pegaClientePorCodigoUnico('DATAMACE'));
*/
  $Cliente = $tmp["cliente"];
  $Telefone = $tmp["telefone"];
  $Pessoa = $objContato->pessoacontatada;
  
  list($tmp1, $tmp) = each( pegaUsuario($id_usuario) );
  $emailUsuario = $tmp["email"];
  $Usuario = $tmp["nome"];
  
  
   
  $emailDestinatario = $tmp["email"];
  $Destinatario = $tmp["nome"];    
  $emailsn = $tmp["emailsn"];

  
  
  $sistema = pegaSistema( $objChamado->sistema_id );

$msg="Chamado com diagnóstico Critico !<br>
<br>
Chamado   : $objChamado->id_chamado<br>
Aberto em : $objChamado->dataaf - $objChamado->horaa<br>
Sistema   : $sistema<br>
<br>
<br>
Descrição do chamado:<br>
---------------------<br>
$objChamado->descricao<br>
<br>
Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa<br>
----------------------------<br>
$objContato->historico<br>
<br>
Informações sobre o Cliente:<br>
----------------------------<br>
Cliente			 : $Cliente<br>
Telefone         : $Telefone<br>
Pessoa Contatada : $Pessoa
";

  $subject = "SAD CRITICO";
  $headers = "";
  $headers .= "From: $Usuario <$email_from_email>\n";



  $gerentes = pegaGerentes();
  
  $recipient = "";
  
  $msg = eregi_replace("\r\n", "<br>",$msg);
  
  while (list($tmp1, $tmp) = each( $gerentes ) ) {
    $recipient = $tmp["email"];
	mail2($recipient, $subject, $msg, $headers);
  } 

?>