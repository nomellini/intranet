<? 
	require("../scripts/conn.php");
	
	if ($email) {
        newsletter($corpo, $assunto, $email, 0);
	} else {
		$sql = "Select id_usuario, nome, email from usuario";
        $result = mysql_query($sql);  
		while ($linha = mysql_fetch_object($result)) {				
			newsletter($corpo, $assunto, $linha->email, $linha->id_usuario);
		}
	}			

	function newsletter($textEmail, $assunto, $email, $id) {  
		$data = date("Y-m-d");
		$hora = date("H:i:s");
		$data = explode("-", $data);
		$dia = "$data[2]/$data[1]/$data[0]";
		if ($id) {
 			$textEmail = str_replace("[usuario]", peganomeusuario($id), $textEmail);
		} else {
			$textEmail = str_replace("[usuario]", "", $textEmail);
		}
		$textEmail = str_replace("[data]", $dia, $textEmail);
		$textEmail = str_replace("[hora]", $hora, $textEmail);
		
		$textEmail .= "
		--
		O colaborador não pode se desligar do recebimento desse email.
		--
		Recomendado uso de fonte monoespaçada para ler o e-newsletter
		--
		Copyright 2003 Datamace Informática.";
		
		$subject = "$assunto";
		$headers = "From: e-Newsletter Datamace <enewletter@datamace.com.br>";
		mail($email, $subject, $textEmail, $headers); 
	}  
?>
Ok ! email enviado !