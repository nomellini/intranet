<?
 require("../scripts/conn.php");
 require("funcoes.php"); 
 require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	
	$sql = "select rnc, rnc_depto_responsavel, rnc_data, rnc_prazo, ";
	$sql .= "rnc_acao_responsavel, rnc_acao_data, ";
	$sql .= "rnc_verif_responsavel, rnc_verif_data ";			
	$sql .= " from chamado where id_chamado = $id_chamado";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result) or die($sql);				
	$tipo = $linha->rnc;
	$rnc_depto = $linha->rnc_depto_responsavel;
	$rnc_prazo = $linha->rnc_prazo;
	$rnc_data = $linha->rnc_data;
	$rnc_acao_data = $linha->rnc_acao_data;
	$rnc_verif_data = $linha->rnc_verif_data;

	
	$rnc_acao_responsavel = $linha->rnc_acao_responsavel;
	$rnc_verif_responsavel = $linha->rnc_verif_responsavel;			
	
	
	$_podeEditar = $_POST["podeEditar"];
	

 
	 if ( $_podeEditar == "SIM" ) {
	
		$_depto = $_POST["depto"];
		$_rnc_data = $_POST["rnc_data"];
		$_rnc_acao_resp = $_POST["rnc_acao_resp"];
		$_rnc_verif_resp = $_POST["rnc_verif_resp"];
		
		$data = explode("/", $_POST["rnc_prazo"]);
		$prazo = "$data[2]-$data[1]-$data[0]";
		
		$_acao_data = $_POST["rnc_acao_data"];
		$data = explode("/",$_acao_data);
		$acao_data = "$data[2]-$data[1]-$data[0]";
		
		$_rnc_verif_data = $_POST["rnc_verif_data"];
		$data = explode("/", $_rnc_verif_data); 
		$verif_data = "$data[2]-$data[1]-$data[0]"; 
		
		$data = explode("/", $_rnc_data);
		$data = "$data[2]-$data[1]-$data[0]";
		 
		$sql = "update chamado set rnc_depto_responsavel = '$depto' ";
		$sql .= ", rnc_acao_responsavel = '$rnc_acao_resp' ";
		$sql .= ", rnc_verif_responsavel = '$rnc_verif_resp' "; 
		$sql .= ", rnc_prazo = '$prazo' ";
		$sql .= ", rnc_data = '$data' "; 
		$sql .= ", rnc_acao_data = '$acao_data' "; 
		$sql .= ", rnc_verif_data = '$verif_data' "; 
		$sql .= ", categoria_id = " . GetCategoria($tipo);
		$sql .= " where id_chamado=$id_chamado ";
	
		EditaChamado($id_chamado, $chamado, $ok);  
		ExecuteNonQuery($sql);  	
	 }

  
       $objChamado = new chamado();	
	   
 if ($action =="novo") { 
 /*
   Se for um novo RNC devo criar os contatos.
 */
	InsereContato($id_chamado, 'disposicao', $disposicao, $ok);
//	if ($tipo <> SAD_ABERTURAPROJETO) {
	if (true) {
		InsereContato($id_chamado, 'causa', $causa, $ok);	
		InsereContato($id_chamado, 'acao', $acao, $ok); 			
		//InsereContato($id_chamado, 'proposta', $proposta, $ok);			
		InsereContato($id_chamado, 'verificacao', $verificacao, $ok); 
	}
 } else if ($action=="editar")  {
	 
		$objChamado->lerChamado($id_chamado);
		
		//$obs = $objChamado->obs;
		
		//$descricao = $objChamado->descricao;				
		$_disposicao = pegarnc($id_chamado, 'disposicao');
		$_causa = pegarnc($id_chamado, 'causa');
		$_acao = pegarnc($id_chamado, 'acao');
		$_verificacao = pegarnc($id_chamado, 'verificacao');	
		//$_proposta = pegarnc($id_chamado, 'proposta');	
			
		EditaContatoComHistorico($id_chamado, 'disposicao', $disposicao, $ok, $_disposicao, "", "");			
		EditaContatoComHistorico($id_chamado, 'causa', $causa, $ok, $_causa, "", "");		
		EditaContatoComHistorico($id_chamado, 'acao', $acao, $ok, $_acao, $rnc_acao_responsavel, $rnc_acao_data);		
		EditaContatoComHistorico($id_chamado, 'verificacao', $verificacao, $ok, $_verificacao, $rnc_verif_responsavel, $rnc_verif_data);						
 }
 
 header("Location: rnc.php?id_chamado=$id_chamado"); 
  
 function ExecuteNonQuery($sql) {
   $result =  mysql_query($sql);
   return mysql_affected_rows();
 } 
 
  function Existe($id, $pessoacontatada) {
	$sql = "SELECT count(*) as qtde from contato WHERE pessoacontatada = '" . $pessoacontatada. "' ";
	$sql .= "and chamado_id = '" . $id . "';";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	if ($linha->qtde == 1) {
	 return true;
	} else {
	 return false;
	}
  }
    
 function InsereContato($id, $pessoacontatada, $historico, $ok) {
   $historico = eregi_replace("\"", "`", $historico);
   $historico = eregi_replace("'", "`", $historico); 
   $datae = date("Y-m-d");
   $horae = date("H:i:s");
   $sql  = "INSERT INTO contato ";
   $sql .= "(chamado_id, pessoacontatada, origem_id, historico, consultor_id, destinatario_id, ";
   $sql .= " status_id, dataa, datae, horaa, horae, publicar, rnc ) VALUES (";
   $sql .= "'". $id . "', '$pessoacontatada', 7, '" . $historico . "', ".$ok.", ".$ok.", ";
   $sql .= "2, '$datae', '$datae', '$horae', '$horae', 0, 1)";
   ExecuteNonQuery($sql);
 }

 
 function EditaContatoComHistorico($id, $pessoacontatada, $TextoAtual, $ok, $TextoAnterior, $Responsavel, $Prazo) {

   $datae = date("Y-m-d");
   $horae = date("H:i:s");
   
   $TextoAtual = eregi_replace("\"", "`", $TextoAtual);
   $TextoAtual = eregi_replace("'", "`", $TextoAtual);	
   
   $TextoAnterior = eregi_replace("\"", "`", $TextoAnterior);
   $TextoAnterior = eregi_replace("'", "`", $TextoAnterior);	
   


   	 
   if  (Existe($id, $pessoacontatada)) {


	   if ($TextoAnterior != ""){
		   if ($TextoAnterior != $TextoAtual) {
			   
				// 1 pegar Data, hora e usuário que inserio o texto anterior
				$sql = "SELECT consultor_id, dataa, horaa from contato WHERE pessoacontatada = '" . $pessoacontatada. "' ";
				$sql .= "and chamado_id = '" . $id . "';";
				$result = mysql_query($sql) or die ($sql);
				$linha = mysql_fetch_object($result);
				$dataOriginal = $linha->dataa;
				$horaOriginal = $linha->horaa;
				$UsuarioOriginal = $linha->consultor_id;
				
			
				// Inserir isso no histórico				   
				$sql = "";
				$sql .= "insert into rnc_memory (id_chamado, data, hora, id_usuario, campo, texto_anterior, responsavel, prazo) ";
				$sql .= " values ( $id, '$dataOriginal', '$horaOriginal', $UsuarioOriginal, '$pessoacontatada', '$TextoAnterior', '$Responsavel', '$Prazo')";	
				ExecuteNonQuery($sql); 	   								
				
		   }
		   
	   }
	   
		if ($TextoAnterior != $TextoAtual) {
			// 3 atualiza o chamado com dados atuais
			$sql = "";
			$sql .= "UPDATE contato set consultor_id = $ok, dataa='$datae', ";
			$sql .= "historico = '" . $TextoAtual . "' where pessoacontatada = '" . $pessoacontatada. "' ";
			$sql .= "and chamado_id = '" . $id . "';";
			ExecuteNonQuery($sql); 
		}
				
	   	   	   
	   
   } else {
       //echo  "<br><br>Atencao False Insere : $pessoacontatada $historico<br>";
       InsereContato($id, $pessoacontatada, $historico, $ok);
   }
 }
 

 function EditaContato($id, $pessoacontatada, $historico, $ok) {
   $historico = eregi_replace("\"", "`", $historico);
   $historico = eregi_replace("'", "`", $historico);		 
   if  (Existe($id, $pessoacontatada)) {
	   $sql = "";
	   $sql .= "UPDATE contato set ";
	   $sql .= "historico = '" . $historico . "' where pessoacontatada = '" . $pessoacontatada. "' ";
	   $sql .= "and chamado_id = '" . $id . "';";
	   ExecuteNonQuery($sql); 
   } else {
       //echo  "<br><br>Atencao False Insere : $pessoacontatada $historico<br>";
       InsereContato($id, $pessoacontatada, $historico, $ok);
   }
 }
 
 function EditaChamado($id, $chamado, $ok) {
 
	global $_depto;
	global $_rnc_data;
	global $rnc_acao_resp;
	global $_rnc_acao_data;
	global $_rnc_verif_resp;
	global $_rnc_verif_data; 
	global $prazo;
	global $_acao_data;	
	global $verif_data;
	global $data;
	global $nomeusuario;
	global $_podeEditar;
 
 
   $chamado = eregi_replace("\"", "`", $chamado);
   $chamado = eregi_replace("'", "`", $chamado);		 

   $logdata = date("d/m/Y H:i:s ") . $nomeusuario ; 
   
   $sql = "select rnc_depto_responsavel,";
   $sql .= "obs,"      ;
   $sql .= "rnc_prazo  ,"   ;
   $sql .= "rnc_acao_responsavel  ,"   ;
   $sql .= "rnc_acao_data   ,"   ;
   $sql .= "rnc_verif_responsavel  ,"   ;
   $sql .= "rnc_verif_data "   ;
   $sql .= "from chamado where id_chamado='" . $id . "';";
   
   $result = mysql_query($sql);
   $linha = mysql_fetch_object($result);
   $obs = $linha->obs;
      
   if ($_podeEditar == "SIM") {
	  
	   if ( ($linha->rnc_depto_responsavel) != $_depto ) {
		   $obs .= "[$logdata] Departamento alterado de $linha->rnc_depto_responsavel para $_depto \n";
	   }
	
	   if ( ($linha->rnc_prazo) != $prazo ) {
		   $obs .= "[$logdata] Prazo alterado de $linha->rnc_prazo para $prazo \n";
	   }
	
	   if ( ($linha->rnc_acao_responsavel) != $rnc_acao_resp ) {
		   $obs .= "[$logdata] Resp. pela ação alterado de $linha->rnc_acao_responsavel para $rnc_acao_resp \n";
	   }
	
	   if ( ($linha->rnc_acao_data) != $_acao_data ) {
		   $obs .= "[$logdata] Data ação alterado de $linha->rnc_acao_data para $_acao_data \n";
	   }
	
	   if ( ($linha->rnc_verif_responsavel) != $_rnc_verif_resp ) {
		   $obs .= "[$logdata] Resp. pela verificação alterado de $linha->rnc_verif_responsavel para $_rnc_verif_resp \n";
	   }
	
	   if ( ($linha->rnc_verif_data) != $verif_data ) {
		   $obs .= "[$logdata] Data verificação alterado de $linha->rnc_verif_data para $verif_data \n";
	   }
	   
   }
   
   $sql = "UPDATE chamado set descricao='$chamado', obs='$obs' WHERE id_chamado='" . $id . "';" or die (mysql_error());
   ExecuteNonQuery($sql);  
   
   
 }
 

?>