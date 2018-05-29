<?


	$site['from_email'] = "suporte@datamace.com.br"; 
	$site['smtp_mode'] = "enabled"; 
	$site['smtp_host'] = "pop.datamace.com.br";
	$site['smtp_port'] = "587"; 
	$site['smtp_username'] = "sad@datamace.com.br";
	$site['smtp_password'] = "data0915";	
	
	
	require_once('scripts/mailclass.inc.php'); 	

	$retorno = '';
	
	$mailer = new FreakMailer(); 
	
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br','scripts/language/');
	$mailer->Subject = $linha->Ds_Assunto; 
	$mensagem = $linha->Tx_Mensagem;
	$mailer->Body = $mensagem; 	
	$mensagem_txt = strip_tags($mensagem);	
	

	$Email_Para = "fernando.nomellini@datamace.com.br";
	
	$mailer->AddAddress("$Email_Para", "$Email_Para"); 	

	if (!$mailer->Send()) { 
		$retorno .= 'Problemas no envio do email para: '. $linha->Nm_Email_Para . ' \n';
		$retorno .= '\tErro: '. $mailer->ErrorInfo .'\n';
	}  else {
		echo "Pau";
	}

	$mailer->ClearAddresses(); 
	$mailer->ClearAttachments();   
	

?>