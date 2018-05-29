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

    $dataa = date("Y-m-d");
	$horaa = date("H:i:s");		
	$datae = $dataa;
	$horae = $horaa;


	if  (($destinatario == 0) || (!isset($destinatario)))
	{
		$destinatario = $ok;
	}

	

	$objChamado->lerChamado($id_chamado);
		
 	if ( !($objChamado->motivo_id == 0) ) {
       header("Location: chegoutarde.php");
	} else {
		$objChamado->sistema_id = $sistema;
		$objChamado->categoria_id = $categoria;
		$objChamado->prioridade_id = $prioridade;
		$objChamado->motivo_id = $motivo;
		$objChamado->consultor_id = $destinatario;
		$objChamado->remetente_id = $ok;
		$objChamado->destinatario_id = $destinatario;
		$descricao = eregi_replace("\"", "`", $descricao);
		$descricao = eregi_replace("'", "`", $descricao);		
		$objChamado->descricao = "$descricao";	

		if ( $action != "encerrar") {
							
			// Contato somente se for encaminhar ou manter pendente
			$id_contato = $objContato->novocontato($id_chamado, $destinatario, $ok, $dataa, $horaa);			
			$objContato->lerContato($id_contato);
			$objContato->origem_id = $origem;
			$objContato->pessoacontatada = $pessoacontatada;
			$objContato->publicar=1;	
			$objContato->status_id = 2;
			$objChamado->status = 2;
			if ($action == "encaminhar" ) {
			  $objContato->destinatario_id = $destinatario;
			} else {
			  $objContato->destinatario_id = $ok;
			}
			$objChamado->destinatario_id = $objContato->destinatario_id;	  
			$objContato->datae = $datae;
			$objContato->horae = $horae;	
			$frasepadrao = eregi_replace("\"", "`", $frasepadrao);
			$frasepadrao = eregi_replace("'", "`", $frasepadrao);	
			$objContato->historico = "$frasepadrao";
			$objContato->Ic_Atencao = 0;
			
			
			$objContato->gravaContato();
			require("scripts/emailinicialcliente.php");			
		}		
	
		// Contato padrão
		$id_contato = $objContato->novocontato($id_chamado, $destinatario, $ok, $dataa, $horaa);		
		$objContato->lerContato($id_contato);
		$objContato->origem_id = $origem;
		$objContato->pessoacontatada = $pessoacontatada;
		$objContato->publicar=0;
		if ($action == "encaminhar" ) {
			$objContato->destinatario_id = $destinatario;
		} else {
			$objContato->destinatario_id = $ok;
		}
		$objChamado->destinatario_id = $objContato->destinatario_id;	  
		$objContato->datae = $datae;
		$objContato->horae = $horae;	
		$historico = eregi_replace("\"", "`", $historico);
		$historico = eregi_replace("'", "`", $historico);	
		$objContato->historico = "$historico";
		if ($action == "encerrar") {
			$objContato->status_id = 1;	  
			$objContato->publicar = 1;
			$objChamado->status = 1;   
			require("scripts/emailinicialcliente.php");						
		} else {
			$objContato->status_id = 2;
			$objChamado->status = 2;	
		}
		
		$objChamado->datauc = $dataa;
		$objChamado->horauc = $horaa;
		
		$objContato->gravaContato();		
		$objChamado->gravaChamado();
		
		$result = mysql_query("update chamado set lido=0 where id_chamado = $id_chamado;");	
	
		if ( $action == "encaminhar" ) {  
		   require("scripts/email.php");
		}		
		
		header("Location: inicio.php");
	}
?>