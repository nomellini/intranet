<?

function Log_Email($_recipient, $_subject, $_msg, $_headers, $_ReplyMail, $_ReplyName)
{

	$Hoje = date("Y-m-d H:i:s");

	$sql = "insert into Emails (";
		$sql .= "Dt_Cadastro, ";
		$sql .= "Nm_De, ";		
		$sql .= "Nm_Email_De, ";	
		$sql .= "Nm_Email_Para, ";
		$sql .= "Ds_Assunto, ";	
		$sql .= "Tx_Mensagem ";		
	$sql .= ") ";	
	
	$sql .= " values ";
		
	$sql .= "(";	
		$sql .= "'$Hoje', ";		
		$sql .= "'$_ReplyName', ";			
		$sql .= "'$_ReplyMail', ";		
		$sql .= "'$_recipient', ";	
		$sql .= "'$_subject', ";	
		$sql .= "'$_msg'";
	$sql .= ") ";	
	
	mysql_query($sql) ;
	
	
	return;	
}




function mail2($_recipient, $_subject, $_msg, $_headers) {
	
	$recipients = $_recipient;
	
	$_ReplyName = "";
	$_ReplyMail = "";

	$_split = explode("+",$_headers);  			
	if ( count($_split) > 1 ) {
		$_reply = explode( ":", $_split[1] );
		$_ReplyMail = $_reply[0];
		$_ReplyName = $_reply[1];
		$_headers = $_split[0];
	} 

		
	$headers["Content-type"] = "text/html; charset=iso-8859-1";
	
	if (!$_headers) {
		$headers["From"]    = "suporte@datamace.com.br";
		$headers["To"]      = "SAD";
	} else {
		$headers["From"]    = $_headers;
		$headers["To"]      = "";
	}
	
	$headers["Subject"] = $_subject;
	$body = $_msg;
	$params["host"] = "pop.datamace.com.br";
	$params["port"] = "587";
	$params["auth"] = true;
	$params["username"] = "sad@datamace.com.br";
	$params["password"] = "datamace123";
	
	
	
	global $site;  // se for dentro de funcao	
	
	$_smtp_host = "pop.datamace.com.br";
	$_smtp_port = '587';
	$_smtp_autentica = 'enabled';
	$_smtp_usuario = "sad@datamace.com.br";
	$_smtp_senha = "datamace123";	
	$_confirma_recebimento = 'S';
	

	if (!$_headers) {	
		$site['from_name'] = "SAD"; 
	} else {
		$site['from_name'] = $_headers; 
	}

	
	$site['from_email'] = "suporte@datamace.com.br"; 
	$site['smtp_mode'] = "$_smtp_autentica"; // enabled or disabled 
	$site['smtp_host'] = "$_smtp_host"; 
	$site['smtp_port'] = $_smtp_port; 
	$site['smtp_username'] = "$_smtp_usuario";
	$site['smtp_password'] = "$_smtp_senha";



	if ($_ReplyMail != "")
	{
		$site['from_email'] = $_ReplyMail;
		$site['from_name'] = $_ReplyName; 		
	}


	
	
	require_once('mailclass.inc.php'); 	
	$cc_email = '';
	$cc_nome = '';
	$retorno = '';
	$mailer = new FreakMailer(); 
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br','../a/scripts/language/');
	$mailer->Subject = $_subject; 
	$mensagem = $_msg;
	//$mensagem = rteSafe($_msg);
	$mailer->Body = $mensagem; 
	$mensagem_txt = strip_tags($mensagem);
	//$mailer->AltBody = unhtmlentities($mensagem_txt); 
	
	$mailer->AddAddress("$_recipient", "$_recipient"); 
	
	if ($_ReplyName) {
		$mailer->AddReplyTo($_ReplyMail,$_ReplyName);
	}
	
	//$mailer->AddAttachment("$diretorio_documentos/$arquivo", "$arquivo");  // para anexar documentos no email
	//$mailer->AddAttachment("$diretorio_documentos/$arquivo", "$arquivo");  // para anexar documentos no email
	
	if (trim($cc_email)) {
		$mailer->AddCC("$cc_email", "$cc_nome"); 
	} 
	
	Log_Email($_recipient, $_subject, $_msg, $_headers, $_ReplyMail, $_ReplyName);	
	
 	//return -1; // Retirar comentário no início desta linha para não mandar email
	
	if (!$mailer->Send()) { 
		$retorno .= 'Problemas no envio do email para: '. $_recipient . ' \n';
		$retorno .= '\tErro: '. $mailer->ErrorInfo .'\n';
		$ok = 'n';
	} else { 
		$ok = 's';
	}
	
	/*
	$mailer->ClearAddresses(); 	
	$mailer->AddAddress("fernando@datamace.com.br", "fernando@datamace.com.br"); 	 
	$mailer->Send();
	*/
	
	$mailer->ClearAddresses(); 
	$mailer->ClearAttachments();   
	
	
}
?>