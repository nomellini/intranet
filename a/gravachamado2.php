<?
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	require("scripts/conn.php");
	require("scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	$objChamado = new chamado();	
	$objContato = new contato();
	
	$objChamado->lerChamado($id_chamado);
	$objContato->lerContato($id_contato);
	
	$objChamado->sistema_id = $sistema;
	$objChamado->categoria_id = $categoria;
	$objChamado->prioridade_id = $prioridade;
	$objChamado->motivo_id = $motivo;
	
    $descricao = eregi_replace("\"", "`", $descricao);
    $descricao = eregi_replace("\'", "`", $descricao);		
	$objChamado->descricao = "$descricao";
			
	
	$objContato->origem_id = $origem;
	$objContato->pessoacontatada = $pessoacontatada;


	
	if ($action == "encerrar") {
      $objContato->status_id = 1;	  
	  $objChamado->status = 1;
//	  $objChamado->remetente_id=0;
//	  $objChamado->destinatario_id=0;
	} else {
      $objContato->status_id = 2;
	  $objChamado->status = 2;
	}
	
	if ($action == "encaminhar" ) {
      $objContato->destinatario_id = $destinatario;
      $objChamado->lido = 0;	  
	} else {
      $objContato->destinatario_id = $id_usuario;
	}
    $objChamado->destinatario_id = $objContato->destinatario_id;	  
   
    $datae = date("Y-m-d");
    $horae = date("H:i:s");	

	$objContato->datae = $datae;
	$objContato->horae = $horae;	
    $historico = eregi_replace("\"", "`", $historico);
    $historico = eregi_replace("\'", "`", $historico);	
	$objContato->historico = "$historico";
	
	
    $objChamado->gravaChamado();	
	$objContato->gravaContato();
	
   if ( $action == "encaminhar" ) {  
    // require("scripts/email.php");
   }   

	if($base) {
	  if (!$base_cliente) {
	    $base_cliente = "0";
	  }
	  $versao = pegaversao($sistema, $cliente_id);
	  $SQL = "insert into baseweb (id_sistema, id_usuario, id_diagnostico, id_chamado, programa, data, hora, descricao, resumo, versao, cliente) ";
	  $SQL .= "VALUES ($sistema, $id_usuario, $diagnostico, $id_chamado, '$base_programa', '$datae', '$horae', '$base_desc', '$historico', '$versao', $base_cliente);";
      mysql_query($SQL) or DIE ("<br><b>Erro no sql</b> : $SQL");
	}
    
 	    	
	header("Location: inicio.php");
	
?>