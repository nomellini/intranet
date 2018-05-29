<?
	/*
	Preparando o email para ser enviado ao cliente 
	*/

//    ini_set('error_reporting', 'E_ALL');
//    ini_set('display_errors', '1');	


	//mail2($Email, $subject, $textEmail, $headers);
	
		
	if ($NomeCliente=='') {
		$NomeCliente = 'Nome não cadastrado';
	}
	
	if ($EmailCliente=='') {
		$EmailCliente = 'marcelo.chinaglia@datamace.com.br';
	}
	

	
    $EmailCliente = 'fernando@datamace.com.br';	
	
	$Email = $EmailCliente;
	
	
	$fileEmail = fopen('_EmailChamado.htm', "r");
	
	$textEmail = fread( $fileEmail, 100000);
	
	$textEmail = str_replace("[nome]", "$NomeTreinando ($EmailCliente)", $textEmail);
	
	$textEmail = str_replace("[id_chamado]", number_format($chamado_id,0,',','.'), $textEmail);
	
	$textEmail = str_replace("[email]", $EmailCliente, $textEmail);	
	$textEmail = str_replace("[sistema]", 'oi'        , $textEmail);	
	$textEmail = str_replace("[sistema]", $NomeCliente, $textEmail);	
    $textEmail = str_replace("[descricao]", $descricao, $textEmail);	
	$textEmail = str_replace("[usuario]", 'Usuario', $textEmail);
	$textEmail = str_replace("[cliente]", $NomeCliente, $textEmail);				
	$textEmail = str_replace("[data_abertura]", $data, $textEmail);		
	
	echo $textEmail;
	
	//$textEmail = "oi";

	$subject = "Encerramento de chamado";
	$headers = "";
	$headers .= "Datamace Informática";
	

	

	//mail2('fernando@datamace.com.br', $subject, $textEmail, $headers);
		
	fclose($fileEmail);  
	  
?>
