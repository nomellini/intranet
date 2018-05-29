<?
  require("classes.php");	
  require("conn.php");

  $objChamado = new chamado();
  $objContato = new contato();  	
  $objChamado->lerChamado($chamado_id);  
  $objContato->lerContato($contato);		  
  
  list($tmp1, $tmp) = each( pegaClientePorCodigoUnico($objChamado->cliente_id) );
  $Cliente = $tmp["cliente"];
  $Telefone = $tmp["telefone"];
  
  list($tmp1, $tmp) = each( pegaUsuario($id_usuario) );
  $emailUsuario = $tmp["email"];
  $Usuario = $tmp["nome"];
   
  $emailDestinatario = $tmp["email"];
  $Destinatario = $tmp["nome"];    
  $emailsn = $tmp["emailsn"];

  
  
  $sistema = pegaSistema( $objChamado->sistema_id );

$msg="Chamado com diagn�stico Critico !

Chamado   : $objChamado->id_chamado
Aberto em : $objChamado->dataaf - $objChamado->horaa
Sistema   : $sistema


Descri��o do chamado:
---------------------
$objChamado->descricao


Ultimo contato estabelecido: $objContato->dataaf - $objContato->horaa
----------------------------
$objContato->historico

Informa��es sobre o Cliente:
----------------------------
Cliente			 : $Cliente
Telefone         : $Telefone
Pessoa Contatada : $Pessoa
";

  $subject = "SAD CRITICO";
  $headers = "";
  $headers .= "From: $Usuario <$email_from_email>\n";

  $gerentes = pegaGerentes();
  $recipient = "";
  while (list($tmp1, $tmp) = each( $gerentes ) ) {
    $recipient = $tmp["email"];
    if ( ! mail($recipient, $subject, $msg, $headers)){
     echo "$recipient<br>$subject<br>$msg<br><br>$headers"; stop;
    }
  } 
   
  
  
  
 ?>