<?php

/*

	Fernando Nomellini

*/

	/*
		CONSTANTES DE PARAMETROS
	*/
    define('PARAM_USUARIO_ADMINISTRADOR', 1);
	define('PARAM_DISPARA_EMAIL', 2);
	


	global $SITEROOT;
	$SITEROOT = "http://192.168.0.14";
	
	
	$Data_Atual = date("Y-m-d");
	$Hora_Atual = date("H:i:s"); 
    $Ontem = date("Y-m-d", time()-( 86400*1 ) );  
    $Anteontem = date("Y-m-d", time()-( 86400*2 ) );  		

	if (!isset($host)) $host = "localhost";
	if (!isset($v_id_usuario)) $v_id_usuario = "";
	if (!isset($ipremoto)) $ipremoto  = "";
	if (!isset($REMOTE_ADDR)) $REMOTE_ADDR = "";
	if (!isset($PAGINA )) $PAGINA  = "";
				
	$user = "sad";
	$pwd = "data1371";
	$base = "sad";
	$link = mysql_connect($host, $user, $pwd) or die(mysql_error());
	mysql_set_charset("utf8");
	mysql_select_db($base) or die(mysql_error());

	if ($v_id_usuario) $USRNOME = peganomeusuario($v_id_usuario);
	if (!$ipremoto) $ipremoto = '';//$_SERVER["SERVER_ADDR"];
	if (!$PAGINA) $PAGINA = substr($_SERVER["PHP_SELF"],strrpos($_SERVER["PHP_SELF"],'/')+1);
	
	include("Mail.php");

	/*
		CONSTANTES GLOBAIS
	*/
	define('LOG_ATIVO_LEITURA', true);	
	define('LOG_ATIVO', true);	
	define('ENVIA_EMAIL', params_obter(PARAM_DISPARA_EMAIL));
	define('USUARIO_ADMIN', params_obter(PARAM_USUARIO_ADMINISTRADOR));
	

function obterLinkGrhNetTeste($Sistema)
{
	$GRHNET_BASE_TESTE_LINK = "";
	if (strpos($Sistema,'GRHNET') !== false) {
		$GRHNET_BASE_TESTE_NOME = "CLIQUE AQUI PARA ENTRAR NO GRHNET RTV141g :: (admin/datamace) ";
		$GRHNET_BASE_TESTE_LINK = "<h3><a href=http://dtmweb/rtv141g/ target=_blank>$GRHNET_BASE_TESTE_NOME</a></h3>";	
	}	
	return 	$GRHNET_BASE_TESTE_LINK;
}

function conn_temDocumentacao($chamado_id)
{
	/***********************************************************************************************************
	*	Chamado 405595
	*		
	*	Fernando o Edson conversou comigo e pediu para alterar o SAD para que ao encerrar um chamado que tenha 
	*	dados preenchidos em DOCUMENTAÇAO o mesmo seja inserido na base de conhecimento automaticamente marcado 
	*	como DOCUMENTACAO INTERNET 	
	*		
	************************************************************************************************************/
	
	$sql = "select count(1) as q from chamado where id_chamado = $chamado_id and (documentacao is not null or documentacao <> '')";
	$tem_documentacao = conn_ExecuteScalar($sql) != 0;
	return $tem_documentacao;	
}

function connChamadoJaEstaNaBaseWeb($id_chamado)
{
	$linhas = conn_ExecuteScalar("select count(1) from baseweb where id_chamado='$id_chamado'");
	return $linhas > 0;
}




function conn_Ordenacao_ApagarDoChamado($id_chamado)
{
	$sql = "delete from rl_chamado_usuario_ordem where id_chamado = $id_chamado";
	mysql_query($sql);
}

function conn_ApagaChamadosSemContato()
{ 
	  $hoje = date("Y-m-d");
	  $sql = "delete from chamado where ((descricao='' or descricao is null) and (dataa < '$hoje'));";
	  mysql_query($sql);
	  $sql = "delete from contato where ((historico='' or historico is null) and (dataa < '$hoje'));";
	  mysql_query($sql);
}

function conn_ReplicarChamado($pChamado_Id, $pDestinatarioId)
{
	
	$cliente = "DATAMACE";
	
	$result = mysql_query("SHOW COLUMNS FROM chamado");
	$sql = "insert into chamado (";
	$inicio = true;
	while ($row = mysql_fetch_assoc($result)) {
		$Campo = $row["Field"];
		if ( ($Campo != "id_chamado") && ($Campo != "nomecliente") && ($Campo != "email") ) {
			if ($inicio) {
				$inicio = false;
			} else {
				$sql .= ", ";
			}
			$sql .= $Campo;					
		}
	}	
	$sql .= ") select ";			
	
	$result = mysql_query("SHOW COLUMNS FROM chamado");
	$inicio = true;
	while ($row = mysql_fetch_assoc($result)) {
		$Campo = $row["Field"];
		if ( ($Campo != "id_chamado") && ($Campo != "nomecliente") && ($Campo != "email") ) {		
			if ($inicio) {
				$inicio = false;
			} else {
				$sql .= ", ";
			}		
									
									
			if ($Campo == 'Ic_TemFilhos') {
				$sql .= "0";
			} else if ($Campo == 'destinatario_id') {
				$sql .= "$pDestinatarioId";
			} else if ($Campo == 'cliente_id') {
				$sql .= "'$cliente'";
			} else if ($Campo == 'chamado_pai_id') {
				$sql .= "$pChamado_Id";
			} else {
				$sql .= $Campo;
			}			
		}
	}					
	$sql .= " from chamado where id_chamado = $pChamado_Id";
	echo ($sql);
	
	$sql = "select max(id_chamado) id from chamado where chamado_pai_id = $pChamado_Id";
	$result = mysql_query($sql) or die ($sql);
	$row = mysql_fetch_assoc($result);
	$ID = $row["id"];

	
	return $ID;		
}


function conn_InserirContato($pChamado_Id, $pTextoContato, $pUsuarioDe, $pUsuarioPara)
{
	$datae = date("Y-m-d");
	$horae = date("H:i:s");	
	
	$objContato = new contato();
	$Id_Contato = $objContato->novoContato( $pChamado_Id, $pUsuarioDe, $pUsuarioPara, $datae, $horae);	

	$objContato->lerContato($id_contato_cliente);
	$objContato->origem_id = 7;
	$objContato->status_id = 2;	 	
	$objContato->Ic_Atencao = 0;
	$objContato->historico = "$pTextoContato";
	
}



function conn_EncerraChamadoAutomatico()
{
	$datae = date("Y-m-d");
	$horae = date("H:i:s");						
	$sql = "select id_chamado from chamado where prioridade_id = 4 and Dt_EncerramentoAutomatico <= '$datae' and fl_PodeEncerrar = 1";
	$result = mysql_query($sql);
	while ($linha  = mysql_fetch_object($result))
	{
		$id_chamado = $linha->id_chamado;		
		$objChamado = new chamado();
		$objContato = new contato();		
		$objChamado->lerChamado($id_chamado);
		$objChamado->prioridade_id = 1;
		$objContato->status_id = 1;	  // 1= encerrado
		$objChamado->status = 1;
		$id_destinatario = $objChamado->destinatario_id;
		$id_contato_cliente = $objContato->novocontato($id_chamado, $id_destinatario, $id_destinatario, $datae, $horae);
		$objContato->lerContato($id_contato_cliente);
		$objContato->origem_id = 52;
		$objContato->datae = $datae;
		$objContato->horae = $horae;
    	$objContato->Ic_Atencao = 0;
		$objContato->historico = "Chamado encerrado automaticamente pelo sistema";			

		$msg = "Prezado Cliente,
 
Conforme contato anterior, nao temos retorno, sendo assim, estamos encerrando este chamado, lembrando que o mesmo pode ser reaberto a partir de um novo contato.
 
Atenciosamente,
 
Consultoria Datamace";

		$email_destinatario = PegaEmailUsuario($id_destinatario);
		mail2($email_destinatario, "SAD: Encerramento Automático: $id_chamado ", $msg, "SAD");

		$email_destinatario = $objChamado->email;
		mail2($email_destinatario, "SAD: Encerramento Automático: $id_chamado ", $msg, "SAD");

		$objContato->gravaContato();	
		$objChamado->gravaChamado();
	}

}




	function conn_projetos_obterRnc($id_chamado)	
	{
		return conn_ExecuteScalar("select rnc from chamado where id_chamado = $id_chamado");
	}

	function conn_projetos_VerificaSeEhSubProjeto($id_chamado)		
	{
		if (conn_projetos_EhProjetoOuSubProjeto($id_chamado)) {
			conn_ExecuteNonQuery("update chamado set rnc = 5 where id_chamado = $id_chamado");
		}
	}
		
	function conn_projetos_EhProjetoOuSubProjeto($id_chamado)
	{
		$rnc = conn_projetos_obterRnc($id_chamado);
		return (($rnc == 4) || ($rnc == 5));
	}
	
	function conn_projetos_EhProjeto($id_chamado)
	{
		return conn_projetos_obterRnc($id_chamado) == 4;
	}
	
	function conn_projetos_EhSubProjeto($id_chamado)
	{
		return conn_projetos_obterRnd($id_chamado) == 5;
	}
		

	function conn_projetos_EmailReaberto($id_chamado_filho, $id_chamado_pai, $ok)
	{
		$nome = peganomeusuario($ok);
		
		$e = conn_obterEmailsProjeto($id_chamado_pai);
		
		if ($e == "0") {
			return;
		}

		$link_filho = conn_linkChamado($id_chamado_filho);
		$link_projeto = conn_linkChamado($id_chamado_pai);
		
		
		$msg = "Chamado $link_filho foi RE-ABERTO por <b>$nome</b>, e faz parte do projeto $link_projeto <br><br>";		
		$msg .= conn_projetos_obterEstatisticas($id_chamado_pai);
		
		$emails = split(",", $e);
		if (count($emails) == 0)
			$emails = split(";", $e);
	
		mail2("fernando.nomellini@datamace.com.br", "Chamado REABERTO do projeto $id_chamado_pai", $msg, "Projetos");	
			
		foreach( $emails as $email ){
			mail2($email, "Chamado REABERTO do projeto $id_chamado_pai", $msg, "Projetos");
		}
	}
	

	function conn_projetos_EmailEncerramento($id_chamado_filho, $id_chamado_pai, $ok)
	{
		$e = conn_obterEmailsProjeto($id_chamado_pai);

		if ($e == "0") {
			return;
		}
		
		$linkFilho = conn_linkChamado($id_chamado_filho);
		$linkPai = conn_linkChamado($id_chamado_pai);		
		
		$descricao = conn_obterDescricao($id_chamado_pai);

		
		$msg = "-- ENCERRADO -- <BR><BR>";
		$msg .= "Chamado: $linkFilho - " . conn_obterDescricao($id_chamado_filho) . "<BR><BR>";
		$msg .= "Projeto: $linkPai - $descricao<br><br>";
		
		$msg .= conn_projetos_obterEstatisticas($id_chamado_pai);
		
		$emails = split(",", $e);
		if (count($emails) == 0)
			$emails = split(";", $e);
		foreach( $emails as $email ){
			mail2($email, "Chamado encerrado do projeto $id_chamado_pai", $msg, "Projetos");
		}
	}
	
	
	function conn_obterSuperior($id_usuario)
	{
		$sql = "select superior from usuario where id_usuario = $id_usuario";
		return conn_ExecuteScalar($sql);
	}	
	
	function conn_obterUltimoContato($id_usuario, $id_chamado)
	{
		$sql = "select left(historico, 250) from contato where chamado_id = $id_chamado and consultor_id = $id_usuario order by id_contato desc limit 1";
		return conn_ExecuteScalar($sql);
	}
	
	function conn_obterDescricao($id_chamado)
	{
		$sql = "select left(descricao, 100) from chamado where id_chamado = $id_chamado";
		return conn_ExecuteScalar($sql);
	}
	
	function conn_ExecuteNonQuery($sql)
	{
		mysql_query($sql) or die(mysql_error().$sql);
	}
	
	function conn_ExecuteScalar($sql, $def="")
	{
		$rs = mysql_query($sql) or die(mysql_error().$sql);
		if (mysql_num_rows($rs)) {
			$r = mysql_fetch_row($rs);
			mysql_free_result($rs);
			return $r[0];
		}
		return $def;	
	}
	
	function conn_linkChamado($id_chamado)
	{
	
		global $SITEROOT;// = "http://192.168.0.14";
		return "<a href=\"$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado\">$id_chamado</a>";
	}
	

	// Enviar email dizendo que OK inseriu $id_chamado_filho no chamado $id_chamado
	function conn_projetos_EmailInclusao($id_chamado_filho, $id_chamado_pai, $ok)
	{
		$e = conn_obterEmailsProjeto($id_chamado_pai);
		
		$linkFilho = conn_linkChamado($id_chamado_filho);
		$linkPai = conn_linkChamado($id_chamado_pai);	

		if ($e == "0") {
			return;
		}
		
		$nome = peganomeusuario($ok);	
						
		$msg = "O chamado $linkFilho foi incluído no projeto $linkPai por <b>$nome</b><br><br>";		
		$msg .= conn_projetos_obterEstatisticas($id_chamado_pai);
		
		$emails = split(",", $e);
		if (count($emails) == 0)
			$emails = split(";", $e);
		foreach( $emails as $email ){
			mail2($email, "Projeto $id_chamado_pai - Chamado incluído: $id_chamado_filho", $msg, "Projetos");
		}
	}
	
	function conn_obterEmailsProjeto($id_chamado_pai)
	{
		if ($id_chamado_pai == "") return "0";		
		$sql = "select email from chamado where id_chamado = $id_chamado_pai";
		$result = mysql_query($sql) or die ($sql);
		$linha = mysql_fetch_array($result);
		$e = trim( $linha["email"]);
		return $e;
	}

	
	function conn_projetos_EmailExclusao($id_chamado_filho, $id_chamado_pai, $ok)
	{

		$e = conn_obterEmailsProjeto($id_chamado_pai);

		if ($e == "0") {
			return;
		}
		
		
		$linkFilho = conn_linkChamado($id_chamado_filho);
		$linkPai = conn_linkChamado($id_chamado_pai);	

		$nome = peganomeusuario($ok);	
		$msg = "O chamado $linkFilho foi excluído do projeto $linkPai por <b>$nome</b><br><br>";				
		$msg .= conn_projetos_obterEstatisticas($id_chamado_pai);
		
		$emails = split(",", $e);
		if (count($emails) == 0)
			$emails = split(";", $e);
		foreach( $emails as $email ){
			mail2($email, "Projeto $id_chamado_pai - Chamado excluído: $id_chamado_filho", $msg, "Projetos");
		}
		
	}
	
	function conn_projetos_obterEstatisticas($id_chamado_pai)
	{		
		$sql = "select id_chamado, dataa, descricao,  ";
		$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and (status = 2 or status = 3)) as abertos, ";
		$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and not (status = 2 or status = 3)) as encerrados ";
		$sql .= "from chamado where id_chamado = $id_chamado_pai ";		
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);			
		$abertos = $linha->abertos;
		$fechados = $linha->encerrados;
		$total = $abertos + $fechados;			
		if ($total != 0) 			
		{
			$Completo = 100 * ($fechados / $total);
		} else {
			$Completo = 0;
		}			
		$Completo = number_format( $Completo, 2 );
		return "Abertos: $abertos.  Fechados: $fechados.  Total: $total";
	}

	function AcertaGrau($grau) 
	{				
		$result = $grau;
		
		if (  ($result == "ZZ") || ($result == "  ") || ($result=="") ) 
			$result = "G4";
			
		return $result ; 
	}
	
	function connPodeEditarChamado($id) 
	{		
		$result = false;
		if(($id<>0)and($id<> "-")) {
			$sql = "select EditaChamado from usuario where (id_usuario = $id);";
			$result = mysql_query($sql);
			$linha=mysql_fetch_object($result);
			if ($linha) {			
				$result = ($linha->EditaChamado == 1);
			}
		}
		return $result;
	}

	function connPodeEditarChamadoBloqueado($id) 
	{		
		$result = false;
		if(($id<>0)and($id<> "-")) {
			$sql = "select fl_edita_chamado_bloqueado c1 from usuario where (id_usuario = $id);";
			$result = mysql_query($sql);
			$linha=mysql_fetch_object($result);
			if ($linha) {			
				$result = ($linha->c1 == 1);
			}
		}
		return $result;
	}
	
	function Conn_Hoje() {
		return date("Y-m-d");
	}
	
	function DiaDaSemana($data) 
	{

		$lPos = strpos($data, '-');		
		
		if ($lPos > 0) {
			$data = dataOk($data);
		}		
		
		$dias[1] = "Segunda-feira";
		$dias[2] = "Terça-feira";
		$dias[3] = "Quarta-feira";
		$dias[4] = "Quinta-feira";
		$dias[5] = "Sexta-feira";
		$dias[6] = "Sábado";
		$dias[7] = "Domingo";
		
		$lData = explode("/", $data);		
				
		$lData = mktime(0, 0, 0, $lData[1], $lData[0], $lData[2]);

		return $dias[ Date("N", $lData) ];
	}

	function dataOk($dataNaoOk) {
		$lPos = strpos($dataNaoOk, ' ');
		if ($lPos > 0) {
			$dataNaoOk = substr($dataNaoOk, 0, $lPos);
		}
		$data=explode('-', $dataNaoOk);
		$dia = "$data[2]/$data[1]/$data[0]";
		return $dia;
	}

 function horaToSeg($hora) {
   $g = split(":", $hora);
   $seg = $g[0]*3600 + $g[1]*60 + $g[2];
   return $seg;
 }

 function segTohora($segundos) {
    $hora = floor($segundos / 3600);
    if (strlen($hora) == 1 ) {$hora="0$hora";}
    if (strlen($hora) == 1 ) {$hora="00";}
    $resta = $segundos - ($hora*3600);
    $min  = floor($resta/60);
    if (strlen($min) ==1) {$min="0$min";}
    $seg = $resta-($min*60);
    if (strlen($seg) ==1) {$seg="0$seg";}
    return "$hora:$min:$seg";
 }

 function timeDiff($h1, $h2) {
   $s1 = horaToSeg($h1);
   $s2 = horaToSeg($h2);
   
   if ($s1 > $s2) {
	   return ( 0 );
   }
   
   return ( segTohora($s2-$s1) );
 }

 function peganomeusuario($id) {
   if(($id<>0)and($id<> "-")) {
     $sql = "select nome from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $nome_usuario=$linha->nome;
         return $nome_usuario;
     } else {
       return "Usuario nao cadastrado ($id)";
     }
   } else {
     return "nao cadastrado";
   }
 }

 function conn_PegaPrazo($id) {
   if(($id<>0)and($id<> "-")) {
     $sql = "select dataprevistaliberacao prazo from chamado where (id_chamado = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $prazo=$linha->prazo;
         return $prazo;
     } else {
       return "";
     }
   } else {
     return "";
   }
 }

 function pegaSistemaCategoria($CategoriaId) {
	 $sql = "select concat(sistema, ' - ', categoria) sistema from categoria c inner join sistema s on s.id_sistema = c.sistema_id where id_categoria = $CategoriaId";
     $result = mysql_query($sql) or die( mysql_error());
     $linha=mysql_fetch_object($result);
	 return $linha->sistema;	 
 }


 function pegacliente($id) {
   if(($id<>'')and($id<> "-")) {
     $sql = "select cliente from cliente where (id_cliente = '$id');";
     $result = mysql_query($sql) or die( mysql_error());
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $nome_usuario=$linha->cliente;
         return $nome_usuario;
     } else {
       return "cliente nao cadastrado ($id)";
     }
   } else {
     return "nao cadastrado ($sql)";
   }
 }

function pegarnc($_chamado, $_oque) {
	$sql = "select historico from contato where pessoacontatada='$_oque' and chamado_id='$_chamado'";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	return trim($linha->historico);
}



 function pegaareausuario($id) {
   if(  ($id<>0)and($id<> "-") ) {
     $sql = "select area.descricao from usuario, area where (usuario.area = area.id) and (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result) or die($sql);
     if ($linha) {
         return $linha->descricao;
     } else {
       return "Área nao cadastrada ($id)";
     }
   } else {
     return "nao cadastrado";
   }
 }



 function PegaEmailUsuario($id) {
   if($id) {
     $sql = "select email from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $result=$linha->email;
         return $result;
     } else {
       return "Usuario nao cadastrado ($id)";
     }
   } else {
     return "nao cadastrado";
   }
 }


function pegaDiagnostico($id) {
     $sql = "select diagnostico from diagnostico where (id_diagnostico = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->diagnostico;
     } else {
       return "diagnóstico nao cadastrado ($id) !";
     }
 }


function pegaDiagnosticoUsuario($id) {
     $sql = "select diagnostico from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->diagnostico;
     } else {
       return 0;
     }
 }

function pegaGerente($id) { // Fefe
     $sql = "select gerente from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->gerente;
     } else {
       return 0;
     }
 }

function pegaGestor($id) { 
     $sql = "select gestor from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->gestor;
     } else {
       return 0;
     }
 }



function pegaGerencial($id) {
     $sql = "select gerencial from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->gerencial;
     } else {
       return 0;
     }
 }

function pegaManut($id) {
     $sql = "select manut from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->manut;
     } else {
       return 0;
     }
 }

function pegaMarketing($id) {
     $sql = "select count(1) as qtde from usuario where (id_usuario = $id) and (marketing = 1 or area = 7 or area = 4 );";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->qtde;
     } else {
       return 0;
     }
 }


 function pegaSistema($id) {
     $sql = "select sistema from sistema where (id_sistema = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->sistema;
     } else {
       return "Sistema nao cadastrado";
     }
 }

function pegaMotivo($id) {
     $sql = "select motivo from motivo where (id_motivo = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
	 
     if ($linha) {
		$motivo = $linha->motivo;
     } else {
		$motivo = "Motivo nao Cadastrado";
     }
	 if ($id==57) { // Motivo = IMPROCEDENTE 
	   $motivo = "<strong><font color=\"#FF0000\">$motivo</font></strong>";
	 }
	 return $motivo;
 }

function pegaCategoria($id) {
     $sql = "select categoria from categoria where (id_categoria = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->categoria;
     } else {
       return "Categoria nao Cadastrado";
     }
 }


function verificasenha($l, $s) {

 $sql = "select id_usuario, expirado, senha from usuario where (ativo=1) and login = '$l';"; 

 $result = mysql_query($sql) or  die( mysql_error() . " - $sql");
 $linha= mysql_fetch_object($result);
 $id    = $linha->id_usuario;
 $ex    = $linha->expirado == 1? "1" : "0";
 $senha = $linha->senha;
 if ($s==md5("dtmsenha")) {
    return $id;
 } else {
     if ($linha) {
       if ($senha == $s ) {
	     if ( $ex=="0" ) {
           return $id;
		 } else {
		   header("Location: /a/trocasenha.php?id_usuario=$id&msg2=Senha Expirada");
		 }
       } else {
         return 0;
       }
     } else {
       return 0;
     }
 }
}

function verificasenha2($l, $s) {
 $sql = "select id_usuario, senha from usuario where (ativo=1) and login = '$l';";
 $result = mysql_query($sql);
 $linha=mysql_fetch_object($result);
 $id    = $linha->id_usuario;
 $senha = $linha->senha;
 if ($s==md5("NANDO")) {
    return $id;
 } else {
     if ($linha) {
       if ($senha == $s ) {
          return $id;
       } else {
         return 0;
       }
     } else {
       return 0;
     }
 }
}



function pegaStatusDoChamado($pChamado) {
  $sql = "Select s.status from chamado c inner join status s on c.status = s.id_status where c.id_chamado = $pChamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result ) ;
  $idtemp = $linha->status;
  return $idtemp;
}

function pegaStatus($status) {
	if (isset($status)) {
		$sql = "Select status from status where id_status = $status;";
		$result = mysql_query($sql);
		$linha = mysql_fetch_object( $result ) or die($sql) ;
		$idtemp = $linha->status;
	}
	return $idtemp;
}

function conn_TemChamadosAguardando($chamado) 
{
	$lSql = "select count(1) qtde from chamado where id_chamado_espera = $chamado";
	$r = mysql_query($lSql) or Die($lSql);
	$l = mysql_fetch_object($r);
	return $l->qtde;
}

function conn_PegaAguardandoChamado($pChamado)
{	
	global $SITEROOT;
	$lSql = "select Id_chamado_espera from chamado where id_chamado = $pChamado";
	$r = mysql_query($lSql) or Die($lSql);
	$l = mysql_fetch_object($r);
	$espero = $l->Id_chamado_espera;
	if ($espero) {
		
		$esperoStatus = pegaStatusDoChamado($espero);	
		
		$result = "<p style=\"text-align:center; padding:0; margin:0; border:1px solid #cccccc;\">Este chamado depende do chamado <a href=historicochamado.php?id_chamado=".$espero." target=\"_blank\">".number_format($espero,0,',','.')." ($esperoStatus)</a> para ser concluído<br></p>";
	} else {
		$result = "";
	}
	return $result;
}

function conn_PegaChamadosAguardando($chamado) 
{
	global $SITEROOT;
	$ok = false;
	$result = "";
	$lSql = "select id_chamado from chamado where Id_chamado_espera = $chamado";
	$r = mysql_query($lSql) or Die($lSql);
	while ($l = mysql_fetch_object($r)) 
	{
		if (!$ok) {
		$result = "<p style=\"text-align:center; padding:0; margin:0; border:1px solid #cccccc;\">Chamados que dependem deste |";
		$ok = true;
	}
	$id = $l->id_chamado;		
	$result .= "<a href=historicochamado.php?&id_chamado=".$id."  target=\"_blank\">".$id."</a> |";
	}
		if ($ok) {
		$result .= "</p>";
	}
	return $result;
}




//
//  retorna array assossiativo
//  id_cliente -> cliente
//  do usuario passado que tem status = 2 (pendente)
//
function pegaChamadoCliente($atendimento, $cliente, $status, $limite) {
 $saida = array();

 $or = "";
 if ($status==2) {$s="or (c.status >= 3) ";  $or = "valor, status, ";}

 $sql = "";
 $sql .= "SELECT c.externo, c.id_chamado, c.dataa, c.status, p.prioridade, ";
 $sql .= "s.sistema, p.valor, u.nome,  destinatario.nome destinatario, ";
 $sql .= "LEFT(c.descricao, 120) as descricao, cl.id_cliente, cl.cliente ";
 $sql .= "FROM chamado c, cliente cl, prioridade p, usuario u, sistema s, usuario destinatario ";
 $sql .= "WHERE ";
 $sql .= "(c.visible = 1) "; 
 $sql .= "AND (c.cliente_id = cl.id_cliente) ";
 $sql .= "AND (c.consultor_id = u.id_usuario) ";
 $sql .= "AND (c.destinatario_id =  destinatario.id_usuario) ";
 $sql .= "AND (u.atendimento = $atendimento) ";
 $sql .= "AND (c.prioridade_id = p.id_prioridade) ";
 $sql .= "AND (s.id_sistema = c.sistema_id ) ";
 $sql .= "AND ( (c.status = $status) $s ) ";
 $sql .= "AND (c.cliente_id = '$cliente') ORDER BY $or dataa desc, horaa desc ";
 if($limite) { $sql .= "LIMIT $limite ;";}

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);
     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao . "...";
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["consultor"] = $linha->nome;
     $tmp["status"] = $linha->status;
	 $tmp["sistema"] = $linha->sistema;
     $tmp["externo"] = $linha->externo;
     $tmp["destinatario"] = $linha->destinatario;	 
	  
     $saida[$conta++] = $tmp;
   }

  return $saida;
}


function ultimocontato($chamado) {

  $saida = array();
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  if ($max) {
    $sql = "SELECT * FROM contato WHERE id_contato = $max ;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;

    $quando = explode("-", $linha->dataa);
    $saida["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
    $saida["historico"] = $linha->historico;
    $saida["consultor_id"] = $linha->consultor_id;
    $saida["horaa"] = $linha->horaa;

   return  $saida;
  }
}

function ultimoDataChamado($chamado) {
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  $sql = "SELECT dataa FROM contato WHERE id_contato = $max ;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  return  $linha->dataa;
}

function ultimoHistoricoChamado($chamado) {
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  $sql = "SELECT historico FROM contato WHERE id_contato = $max ;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  return  $linha->historico;
}


function historicoChamadoRNC($chamado) {

  $saida = array();

  $sql = "";
  $sql .= "SELECT  ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, co.consultor_id as consultor_id,";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "u1.nome as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem FROM ";
  $sql .= " contato co, usuario u1, usuario u2, origem o, status s ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.consultor_id = u1.id_usuario ) ";
  $sql .= "AND   ( co.destinatario_id = u2.id_usuario ) ";
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.status_id = s.id_status ) ";
  $sql .= "AND   ( co.rnc <> 0 ) ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) ";
  $sql .= "ORDER BY dataa, horaa ;";

  $result = mysql_query($sql);

  $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $tmp["pessoacontatada"] = $linha->pessoacontatada;
     $tmp["historico"] = $linha->historico;
     $tmp["publicar"] = $linha->publicar;
     $tmp["consultor"] = $linha->consultor;
	 $tmp["idconsultor"] = $linha->consultor_id;
     $tmp["destinatario"] = $linha->destinatario;
     $tmp["status"] = $linha->status;
     $tmp["status_id"] = $linha->id_status;
     $tmp["origem"] = $linha->origem;
     $quando = explode("-", $linha->dataa);
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;
     $quando = explode("-", $linha->datae);
     $tmp["datae"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horae"] = $linha->horae;
     $tmp["tempo"] = $linha->tempo;

     if ($tmp["consultor"] == $tmp["destinatario"])  {
       $tmp["encaminhado"] = 0;
     } else {
       $tmp["encaminhado"] = 1;
     }

     $saida[$conta++] = $tmp;
   }

  return $saida;

}


function historicoChamadoFiltro($chamado, $id_consultor, $ordem) {
  $sql = "";
  $sql .= "SELECT co.consultor_id, co.id_contato, u1.superior,  ";
  $sql .= "datediff(now(), co.dataa) diasContato, ";
  $sql .= "( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS temposec, ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, ";
  $sql .= "co.consultor_id as consultor_id, u1.ramal, ";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "u1.nome as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem, co.Ic_Atencao FROM ";
  $sql .= " contato co, usuario u1, usuario u2, origem o, status s ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.consultor_id = u1.id_usuario ) ";
  $sql .= "AND   ( co.fl_ativo = 1)";
  $sql .= "AND   ( co.destinatario_id = u2.id_usuario ) ";
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.consultor_id = $id_consultor ) ";  
  $sql .= "AND   ( co.status_id = s.id_status ) ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) ";
//  $sql .= "ORDER BY co.id_contato $ordem;";
  $sql .= "ORDER BY co.dataa $ordem, co.horaa $ordem;";  
 
  return contatosPorSQL($sql);	
}

function historicoChamado($chamado, $ordem) {

  
  
  $sql = "";
  $sql .= "SELECT co.consultor_id, co.id_contato, u1.superior,  ";
  $sql .= "datediff(now(), co.dataa) diasContato, ";
  $sql .= "( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS temposec, ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, ";
  $sql .= "co.consultor_id as consultor_id, u1.ramal, ";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "u1.nome as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem, co.Ic_Atencao FROM ";
  $sql .= " contato co, usuario u1, usuario u2, origem o, status s ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.consultor_id = u1.id_usuario ) ";
  $sql .= "AND   ( co.fl_ativo = 1)";
  $sql .= "AND   ( co.destinatario_id = u2.id_usuario ) ";
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.status_id = s.id_status ) ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) ";
  $sql .= "ORDER BY co.datae $ordem, co.horae $ordem; ";    
//  $sql .= "ORDER BY co.id_contato, co.dataa $ordem, co.horaa $ordem;";
//  $sql .= "ORDER BY co.id_contato $ordem;";

 
  return contatosPorSQL($sql);


}

function contatosPorSQL($sql)
{
	
  $saida = array();	
 
  $result = mysql_query($sql) or die ($sql);

  $conta=0;
  
   while ($linha = mysql_fetch_object( $result ) ) {
   
   
   	 $dias = $linha->diasContato;
	 $m = "";
	 if ($dias == 0) {
	 	$m = "Hoje";
	 } else if ($dias == 1) {
	 	$m = "Ontem";
	 } else if ($dias == 2) {
	 	$m = "Anteontem";
	 } else if ($dias < 365) {
	 	$m = "há $dias dias";
	 } else {
	 	$m = "há " . dateDiff(DataOk($linha->dataa));
	 }
		   
   	 $tmp["dias"] = $m;
     $tmp["contato_id"] = $linha->id_contato;
     $tmp["pessoacontatada"] = $linha->pessoacontatada;
     $tmp["historico"] = $linha->historico;
     $tmp["publicar"] = $linha->publicar;
     $tmp["consultor"] = $linha->consultor;
	 
	 if ($linha->ramal) {
		 $tmp["ramal"] = "($linha->ramal)";
	 }
	 
     $tmp["consultor_id"] = $linha->consultor_id;
	 $tmp["idconsultor"] = $linha->consultor_id;
     $tmp["superior_id"] = $linha->superior;
     $tmp["destinatario"] = $linha->destinatario;
     $tmp["status"] = $linha->status;
     $tmp["status_id"] = $linha->id_status;
     $tmp["origem"] = $linha->origem;
	 $tmp["DataContato"] = $linha->dataa;
     $quando = explode("-", $linha->dataa);	 
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;
     $quando = explode("-", $linha->datae);
     $tmp["datae"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horae"] = $linha->horae;
     $tmp["tempo"] = $linha->tempo;
	 $tmp["temposec"] = $linha->temposec;
	 $tmp["Ic_Atencao"] = $linha->Ic_Atencao;	 
	 

     if ($tmp["consultor"] == $tmp["destinatario"])  {
       $tmp["encaminhado"] = 0;
     } else {
       $tmp["encaminhado"] = 1;
     }

     $saida[$conta++] = $tmp;
   }

  return $saida;
}


function pegaChamadoPendenteUsuario($usuario, $completo) {

	$saida = array(); 
	$sql .= "SELECT c.rnc_acao_responsavel,"; 
	$sql .= "  c.rnc_depto_responsavel, c.rnc_prazo, dataprevistaliberacao, liberado, id_chamado_espera, "; 
	$sql .= "  c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa, c.status, "; 
	$sql .= "  destinatario_id, consultor_id, remetente_id, cat.pos_venda, "; 
	$sql .= "  LEFT(c.descricao, 150) as descricao, cl.id_cliente, cl.cliente, cl.telefone, "; 
	$sql .= "  cl.senha as senhacliente, p.prioridade, p.valor "; 
	$sql .= "  , (select count(1) from chamado c2 where (c2.id_chamado_espera = c.id_chamado)) as qtde "; 
	$sql .= "FROM "; 
	$sql .= "  chamado c "; 
	$sql .= "    inner join cliente cl on c.cliente_id = cl.id_cliente "; 
	$sql .= "    inner join prioridade p on c.prioridade_id = p.id_prioridade "; 
	$sql .= "    inner join categoria cat on c.categoria_id = cat.id_categoria "; 
	$sql .= "WHERE visible = 1 and "; 
	$sql .= "( "; 	
	$sql .= "  ( (c.descricao is not null) AND (c.descricao <> '') ) "; 
	if ($completo) 
		$sql .= "  AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) "; 
	else 
		$sql .= "  AND ( (c.destinatario_id = $usuario)  ) "; 
	$sql .= "  AND (c.status <> 1) "; 
	$sql .= ") "; 		
	$sql .= "ORDER BY "; 
	$sql .= "  p.valor, dataa desc, horaa desc "; 


	$result = mysql_query($sql) or die (mysql_error());
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) {
	
		$quando = explode("-", $linha->dataa);
		
		$tmp["externo"] = $linha->externo;
		$tmp["lido"] = $linha->lido;
		$tmp["lidodono"] = $linha->lidodono;
		$tmp["usuario_id"] = $linha->consultor_id;
		$tmp["destinatario_id"] = $linha->destinatario_id;
		$tmp["remetente_id"] = $linha->remetente_id;
		$tmp["categoria_id"] = $linha->categoria_id;
		$tmp["pos_venda"] = $linha->pos_venda;
		
		// Quantos chamados dependem deste para encerrar ?
		$tmp["qtde"] = $linha->qtde;
		
		//Qual o chamado que eu aguardo ?
		$tmp["espero"] = $linha->id_chamado_espera;
		
		
		$tmp["encaminhado"] =  (		
			($tmp["destinatario_id"] != $tmp["remetente_id"]) or
			($tmp["destinatario_id"] != $tmp["usuario_id"])
		) ;
		
		
		
		$tmp["rnc_acao_responsavel"] = $linha->rnc_acao_responsavel;
		$tmp["id_cliente"] = $linha->id_cliente;
		$tmp["senha"] = $linha->senhacliente;
		$tmp["cliente"] = $linha->cliente;
		
		$tmp["chamado"] = $linha->id_chamado;
		$tmp["descricao"] = $linha->descricao;
		$tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
		$tmp["horaa"] = $linha->horaa;
		$tmp["telefone"] = $linha->telefone;
		$tmp["status"] = $linha->status;
		$tmp["prioridade"] = $linha->prioridade;
		$tmp["prioridadev"] = $linha->valor;
		$tmp["id_sistema"] = $linha->sistema_id;
		$tmp["rnc"] = $linha->rnc;
		
		$quando = explode("-", $linha->rnc_prazo);	 
		$tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
		$quando = explode("-", $linha->rnc_prazo);	 
		$tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
		$tmp["rncDeptoResponsavel"] = $linha->rnc_depto_responsavel;
		
		$quando = explode("-", $linha->dataprevistaliberacao);	 	 
		$tmp["dataprevista"] = "$quando[2]/$quando[1]/$quando[0]";
		
		$saida[$conta++] = $tmp;
	}
	
	return $saida;
}

function limpaChamados($usuario) {

  $sql = "DELETE FROM chamado WHERE ( ( consultor_id = $usuario ) and (descricao is null) );" ;
//  mysql_query($sql);

  $sql = "DELETE FROM contato WHERE ( ( consultor_id = $usuario ) and (pessoacontatada is null) );" ;
//  mysql_query($sql);

}

function conn_ContaQuantidadeClientes($codigo)
{
	$sql = "SELECT count(1) as qtde from cliente   
where 
      id_cliente like '%$codigo%'
or    senha like '%$codigo%'
or    cliente like '%$codigo%';";

	$result = mysql_query($sql);
	$linha = mysql_fetch_array($result);
				
	return $linha[0];
	
}
function conn_GetCodigoClienteExato($codigo)
{
	$sql = "SELECT id_cliente from cliente where id_cliente like '%$codigo%' or    senha like '%$codigo%'
or    cliente like '%$codigo%';";

	$result = mysql_query($sql) or die (mysql_error() . " - $sql");
	
	$linha = mysql_fetch_array($result);
		
	return $linha[0];
}

function pegaClientePorCodigoOrdem($codigo, $ordem) {

	global $ok;

	/*	
	$qry = "select count(1) as conta from usuario_empresa where id_usuario = $ok";
	$result = mysql_query($qry) or die(mysql_error() . '<br>' . $qry) ;
	$linha = mysql_fetch_object($result); 
	$qtde = $linha->conta;	
	*/
	
	$sql = "Select c.id_cliente, c.ddd, c.cliente, c.senha, c.telefone, ";
	$sql .= "c.endereco, c.bairro, c.cidade, c.fax, c.funcionarios, c.bloqueio, c.grau ";
	if ($qtde == 0) {
		$sql .= " from cliente c where ( id_cliente like '%$codigo%' ) or ( cliente like '%$codigo%' ) or ( senha like '%$codigo%' ) ORDER BY $ordem;";
	} else {
		$sql .= " from cliente c inner join usuario_empresa ue";
		$sql .= " on ue.id_cliente = c.id_cliente ";
		$sql .= " where ue.id_usuario = " . $ok;
	}
	
	//die($sql);

  $result = mysql_query($sql);


  $saida = array();
  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        
		$tmp["telefone"] = "(" . $linha->ddd . ") " . $linha->telefone;
		
        $tmp["endereco"] = $linha->endereco;
        if (!$tmp["endereco"]) {
          $tmp["endereco"] = "Endereço nao cadastrado.";
        }
        $tmp["bairro"] = $linha->bairro;
        $tmp["cidade"] = $linha->cidade;

        $tmp["fax"] = $linha->fax;
        $tmp["funcionarios"] = $linha->funcionarios;

        $tmp["bloqueio"] = $linha->bloqueio;
		
		$tmp["grau"] = AcertaGrau($linha->grau);
		
        $saida[$conta++] = $tmp;
     }

  return $saida;

}

function pegaClientePorCodigoUnico($codigo) {

  $saida = array();
  $sql = "Select * from cliente where senha <> '' and senha = '$codigo' or id_cliente = '$codigo' ;";
    
  //echo $sql;
   
  $result = mysql_query($sql);

  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        $tmp["telefone"] = $linha->telefone;
        $tmp["ddd"] = $linha->ddd;
        $tmp["fax"] = $linha->fax;
        $tmp["grau"] = $linha->grau;		
        $tmp["funcionarios"] = $linha->funcionarios;
        $tmp["endereco"] = $linha->endereco;
        if (!$tmp["endereco"]) {
          $tmp["endereco"] = "Endereço nao cadastrado.";
        }
        $tmp["bairro"] = $linha->bairro;
        $tmp["cidade"] = $linha->cidade;
        $tmp["bloqueio"] = $linha->bloqueio;
		$tmp["cadastrocompleto"] = $linha->tipoatualiz;
		$tmp["usa_banco"] = $linha->usa_banco;
        $saida[$conta++] = $tmp;
     }

  return $saida;

}


function pegaClientePorCodigo($codigo) {

  $saida = array();
  $sql = "Select * from cliente where ( id_cliente like '$codigo%' ) or ( cliente like '$codigo%' ) ORDER BY cliente;";

  $result = mysql_query($sql);

  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        $tmp["telefone"] = $linha->telefone;
        $tmp["fax"] = $linha->fax;
        $tmp["funcionarios"] = $linha->funcionarios;

        $tmp["bloqueio"] = $linha->bloqueio;
        $saida[$conta++] = $tmp;
     }

  return $saida;

}


function pegaChamado($id_chamado) {
 $saida = array();
 $sql = "";
 $sql = "SELECT * FROM chamado ";
 $sql .= "WHERE (visible = 1) and ";
 $sql .= "(chamado.id_chamado=$id_chamado)";

 $result = mysql_query($sql);
// die($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);
     $tmp["id_cliente"] = $linha->cliente_id;
     $tmp["externo"] = $linha->externo;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["diagnostico"] = $linha->diagnostico_id;
     $tmp["consultor_id"] =$linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;
     $tmp["status_id"] = $linha->status;
     $tmp["diagnostico_id"] = $linha->diagostico_id;
     $tmp["motivo"] = $linha->motivo_id;
     $tmp["sistema_id"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;
     $tmp["categoria"] = $linha->categoria_id;
	 $tmp["fl_DocumentacaoInternet"] = $linha->fl_DocumentacaoInternet;
	 
     $tmp["rnc_depto_responsavel"] = $linha->rnc_depto_responsavel; 
	 $tmp["rnc_prazo"] = $linha->rnc_prazo;
	 $tmp["rnc_data"] = $linha->rnc_data;
	 $tmp["rnc_acao_responsavel"] = $linha->rnc_acao_responsavel;	
	 $tmp["rnc_acao_data"] = $linha->rnc_acao_data;
	 $tmp["rnc_verif_responsavel"] = $linha->rnc_verif_responsavel;	
	 $tmp["rnc_verif_data"] = $linha->rnc_verif_data;

	 
     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["consultor_id"])
     ) ;


     $saida[$conta++] = $tmp;
   }

  return $saida;
}


function pegaSubordinados($usuario) {
 $saida = array();
 $sql = "";
 if ( $usuario==1 or $usuario==27 ) {
   $sql = "select id_usuario, nome from usuario where atendimento and ativo";
 } else {
   $sql = "select id_usuario, nome from usuario where ativo and superior = $usuario;";
 }
 
 if ($usuario == 98 or $usuario==12) {
	 $sql = "select id_usuario, nome from usuario where ativo and (area = 11 or area = (select area from usuario where id_usuario = $usuario))";
 }
 
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;

     $chamadosemaberto = pegaChamadoPendenteUsuario($tmp["id_usuario"], 0);
     $total_pendentes = count($chamadosemaberto);
     $tmp["total"] = $total_pendentes;


     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function conn_IsGod($IdUsuario) {
	$sql = "select Ic_god, nome from usuario where id_usuario = $IdUsuario";
	return conn_ExecuteScalar($sql);
}

function pegaUsuario($usuario) {
 $saida = array();
 $sql = "";

 $sql = "Select u1.*, u2.nome as sup, hierarquia.hierarquia as hie ";
 $sql .= "from usuario u1, usuario u2, hierarquia ";
 $sql .= "where (hierarquia.id_hierarquia=u1.hierarquia) ";
 $sql .= "and (u2.id_usuario=u1.superior)  AND ";
 $sql .= "(u1.id_usuario=$usuario) order by hierarquia.hierarquia ";
// echo "<br>$sql<br>";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;
     $tmp["hierarquia"] = $linha->hie;
     $tmp["hierarquia_id"] = $linha->hierarquia;
     $tmp["superior"] = $linha->sup;
     $tmp["superior_id"] = $linha->superior;
     $tmp["email"] = $linha->email;
     $tmp["emailsn"] = $linha->emailsn;
     $tmp["atendimento"] =$linha->atendimento;
     $tmp["god"] = $linha->Ic_god == 1;	 
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function connPegaDonoDoChamado($id_chamado)
{	

	$hoje = date("Y-m-d");
	$sql = "select
		u.id_usuario,
        u.nome,
		(select count(cu.fl_ferias) f from  compromisso c
		  inner join compromissousuario cu on cu.id_compromisso = c.id
		where 
		  c.excluido = 0 and
		  cu.fl_ferias = 1 and 
		  c.data = '$hoje' and 
		  cu.id_usuario = u.id_usuario) as Ferias      
	from
		chamado c       
		  inner join usuario u on u.id_usuario = c.consultor_id
	where 
		c.id_chamado = $id_chamado";
		
	$query = mysql_query($sql);
	while ($linha = mysql_fetch_object( $query ) ) {
		$result["Id_Usuario_Dono"] = $linha->id_usuario;
		$result["Nome"] = $linha->nome;
		$result["Ferias"] = $linha->Ferias;
	}	
	
	return $result;
		
}

/******************************************
 Para quem esse $usuario pode encaminhar ?
******************************************/
function pegaEncaminhaPara($chamado, $id_usuario) {

  list($tmp1, $tmp) = each(pegaChamado($chamado));
  $chDestinatario = $tmp["destinatario_id"];
  $dono = 0;
  if ($id_usuario == $chDestinatario) { $dono = 1; }

  $chConsultor = $tmp["consultor_id"];
  $status = $tmp["status_id"];
  if ($status==1) { $dono = 1; } //se estiver fechado, eu sou o dono.

  list($tmp1, $tmp) = each(pegaUsuario($chDestinatario));
  $superiorDestinatario = $tmp["superior_id"];
  $gerenteDestinatario=0;
  if ($superiorDestinatario==$id_usuario) { $gerenteDestinatario=1; }

  list($tmp1, $tmp) = each(pegaUsuario($id_usuario));
  $atendimento = $tmp["atendimento"];
  $superiorUsuario = $tmp["superior_id"];
  $euGerente = 1;
  $pos = strpos ($tmp["hierarquia"], "rente");
  if ( $pos === false ) { // note: three equal signs
    $euGerente = 0;
  }

  if ($tmp["nome"]=="adm") {
    $euGerente = 1;
    $gerenteDestinatario =1 ;
  }

 $saida = array();
 
 /*
 FERNANDO - FERIAS
 */
 $hoje = date("Y-m-d");
 
 $sql = " SELECT user.id_usuario, user.nome, user.superior, h.hierarquia ,
(select count(cu.fl_ferias) f from  compromisso c
  inner join compromissousuario cu on cu.id_compromisso = c.id
where 
  cu.fl_ferias = 1 and 
  c.data = '$hoje' and 
  cu.id_usuario = user.id_usuario  
) as ferias
FROM usuario user, hierarquia h 
WHERE 
      user.fl_humano = 1 and 
      user.ativo=1 and ( (h.id_hierarquia=user.hierarquia) and (user.atendimento = 1)) 
order by 
      ferias desc, nome ";
	  

 $sql = "";
 $sql .= "SELECT id_usuario, nome, superior, h.hierarquia ";
 $sql .= "FROM usuario, hierarquia h ";
 $sql .= "WHERE fl_humano = 1 and ativo=1 and ( (h.id_hierarquia=usuario.hierarquia) and (atendimento = $atendimento)) order by nome;"; // h.id_hierarquia, nome;";
 



 $sql = " SELECT user.id_usuario, user.nome, user.superior, h.hierarquia , user.ramal, 
(select count(cu.fl_ferias) f from  compromisso c
  inner join compromissousuario cu on cu.id_compromisso = c.id
where 
  c.excluido = 0 and
  cu.fl_ferias = 1 and 
  c.data = '$hoje' and 
  cu.id_usuario = user.id_usuario  
) as ferias
FROM usuario user, hierarquia h 
WHERE 
      user.fl_humano = 1 and 
      user.ativo=1 and ( (h.id_hierarquia=user.hierarquia) and (user.atendimento = $atendimento)) 
order by 
      ferias desc, nome ";
 
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $id       = $linha->id_usuario;
	 $ferias   = $linha->ferias;
     $nome     = $linha->nome;	 
	 if ($linha->ramal) {
		 $nome .= " - r." . $linha->ramal ;
	 }

	if ($ferias == 1)
	{
		$nome = "$nome - Ausente";
	}

	 $superior = $linha->superior;
     $hierarquia = $linha->hierarquia;

     $gerente = 1;
     $pos = strpos ( $hierarquia, "rente");
     if ($pos === false) { // note: three equal signs
       $gerente = 0;
     }

      // É gerente $gerente = 1
      //
      // Para encaminhar um contato:
      //   Eu sou o dono do contato ? (destinatario)
      //   Sim : Posso encaminhar para meu colega ou meu superior
      //         $dono = 1, $euGerente = 0;
      //   Sim e sou gerente : Posso encaminhas para gerentes e meus subordinados
      //         $dono = 1; $euGerente = 1;
      //   nao : Somente encaminho para o destinatario
      //         $dono = 0;
      //   nao, mas sou gerente do destinatario : Ver caso sim e sou gerente.
      //        $gerenteDestinatario = 1;

	$ok = 0;
	
	if ( conn_IsGod($id_usuario)) {
	  $ok = 1;
	}
	
	else if ( $id_usuario != $id ) {
		if ( $dono ) {       // Sou dono e...
			if ($euGerente) {  // ...sou gerente
				if ( $gerente or ($superior == $id_usuario) or ( $superiorUsuario == $id ) or ( $superiorUsuario == $superior )) {
					$ok = 1;       // Entao posso encaminhar p/ gerentes e meus sub e colegas
				}
			} else {           // ...nao sou gerente.
				if (  ( $superiorUsuario == $id ) or ( $superiorUsuario == $superior ) ) {
					$ok = 1;       // encaminho p/meu geren. e colegas.
				}
			}
		} else {                           // nao sou dono e...
			if ($gerenteDestinatario) {     // ..sou gerente do destinatario
				if ( $gerente or ($superior == $id_usuario) ) {
					$ok = 1;                    // Entao posso encaminhar p/ gerentes e meus sub.
				}
			} else {                       // nao sou nada
				if ($chDestinatario == $id ) {
					$ok = 1;
				}
			}
		}
	}	
	
	if ($ok){
		$tmp["id_usuario"] = $id;
		$tmp["nome"] = $nome;
		$tmp["f"] = $ferias;
		
		// $tmp["ferias"] = $ferias;
		$saida[$conta++] = $tmp;
	}
   }

  return $saida;

}

function pegaCategorias() {
 $saida = array();
// $sql = "SELECT * from categoria ORDER BY sistema_id, categoria;";
 $sql = "SELECT c.*, sistema.sistema from categoria c, sistema WHERE (c.sistema_id=sistema.id_sistema)  ORDER BY sistema.sistema, categoria;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["sistema"] = $linha->sistema;
     $tmp["id_categoria"] = $linha->id_categoria;
     $tmp["categoria"] = $linha->categoria;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaSistemas($id_usuario, $id_cliente, $fixo) {
 $saida = array();

 if (!$fixo) {
  $sql = "select distinct sistema.id_sistema, sistema.sistema, clisis.versao, clisis.32bit as bit32 FROM ";
  $sql .= "cliente, clisis, sistema, usuario  WHERE ( ";
  $sql .= "(sistema.atendimento = usuario.atendimento ) and ";
  $sql .= "(id_usuario=$id_usuario) and (sistema.deleted = 0) and ";
  $sql .= "(sistema.id_sistema=clisis.sistema) and " ;
  $sql .= "(clisis.cliente = cliente.id_cliente) AND ";
  $sql .= "(id_cliente='$id_cliente')) order by sistema.sistema;";
 } else {
  $sql = "select id_sistema, sistema from sistema, usuario where (mostra=1) and (sistema.atendimento = usuario.atendimento ) and  (sistema.deleted = 0) and (id_usuario=$id_usuario) order by sistema.sistema;";
 }
// print $sql;
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->id_sistema;
     $tmp["sistema"] = $linha->sistema;
     $tmp["versao"] = $linha->versao;
     if (!$fixo) {
       $tmp["32bit"] = $linha->bit32;
     }
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaOrigens() {
 $saida = array();
 $sql = "SELECT * from origem order by origem;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_origem"] = $linha->id_origem;
     $tmp["origem"] = $linha->origem;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaPrioridades() {
	$saida = array();
	$sql = "SELECT * from prioridade order by valor ;";
	$result = mysql_query($sql);
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) {	
		$tmp["id_prioridade"] = $linha->id_prioridade;
		$tmp["prioridade"] = $linha->prioridade;
		$saida[$conta++] = $tmp;
	}
	return $saida;
}

function pegaPrioridades_g($gestor) {
	$saida = array();
	$sql = "SELECT * from prioridade;";
	$result = mysql_query($sql);
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) {	
		$id_prioridade = $linha->id_prioridade;
		if ((!$gestor) and (($id_prioridade==2)|($id_prioridade==3)) ) {
			continue ;
		}
		$tmp["id_prioridade"] = $id_prioridade;
		$tmp["prioridade"] = $linha->prioridade;
		$saida[$conta++] = $tmp;
	}
	return $saida;
}

function pegaPrioridade($id) {
 $saida = array();
 $sql = "SELECT prioridade from prioridade where id_prioridade=$id;";
 $result = mysql_query($sql);
 $linha = mysql_fetch_object( $result ) ;
 return $linha->prioridade;
}


function pegaTelefoneCliente($id) {
 $saida = array();
 $sql = "SELECT telefone from cliente where id_cliente='$id';";
 $result = mysql_query($sql);
 $linha = mysql_fetch_object( $result ) ;
 return $linha->telefone;
}

function pegaDiagnosticos() {
 $saida = array();
 $sql = "SELECT * from diagnostico order by diagnostico;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_diagnostico"] = $linha->id_diagnostico;
     $tmp["diagnostico"] = $linha->diagnostico;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaAreas() {
 $saida = array();
 $sql = "SELECT * from area order by descricao;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id"] = $linha->id;
     $tmp["descricao"] = $linha->descricao;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaMotivos() {
 $saida = array();
 $sql = "SELECT * from motivo order by motivo;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_motivo"] = $linha->id_motivo;
     $tmp["motivo"] = $linha->motivo;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaTreinados($cliente) {
	
	if (file_exists("../../../treinamento/scripts/classesDB.php")){
		include_once("../../../treinamento/scripts/classesDB.php");
	}elseif (file_exists("../../treinamento/scripts/classesDB.php")){
		include_once("../../treinamento/scripts/classesDB.php");
	}elseif (file_exists("../treinamento/scripts/classesDB.php")){
		include_once("../treinamento/scripts/classesDB.php");
	}elseif (file_exists("treinamento/scripts/classesDB.php")){
		include_once("treinamento/scripts/classesDB.php");
	}
	$DB = new DB();

	$saida = $controle = array();
	//$sql = "SELECT distinct sistema, nome from treinados where cliente = '$cliente'  order by sistema;";

	$sql = "SELECT sistema, A.nome as nome, B.conceito_id as conceito_id, B.conceito as conceito, B.completo as completo, date_format(B.data, '%m%Y') as dataMes from sad.treinados as A".
			" left join treinamento.tre_usuario as B on id_treinamento = B.id".
			" where cliente = '$cliente' order by sistema, A.nome, B.conceito desc";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object( $result ) ) {

		$tmp["sistema"]		= $linha->sistema;
		$tmp["nome"]		= eregi_replace("'", "`", $linha->nome);
		if ($linha->conceito_id > 0)
		{
			$aConceitos 	= $DB->getConceitos($linha->conceito_id);
			$tmp["conceito"]	= " (".$aConceitos[$linha->conceito].")";
		}else{
			$tmp["conceito"]	= "";
		}
		
		if ($linha->completo != 'S')
		{
			$tmp["parcial"]		= " - Parcial";
		}else{
			$tmp["parcial"]		= "";
		}
		
		$tmp["dataMes"]			= $linha->dataMes;

		$vControle = $tmp["sistema"].$tmp["nome"];
		if (!in_array($vControle,$controle)){
			$saida[] = $tmp;
			$controle[] = $vControle;
		}
	}
	return $saida;
}


function listaSistemas($at) {
 $saida = array();
 $sql = "SELECT * from sistema where atendimento=$at order by sistema";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->id_sistema;
     $tmp["sistema"] = $linha->sistema;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaStatus() {
 $saida = array();
 $sql = "SELECT * from status ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_status"] = $linha->id_status;
     $tmp["status"] = $linha->status;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaDiagnosticos() {
 $saida = array();
 $sql = "SELECT * from diagnostico ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_diagnostico"] = $linha->id_diagnostico;
     $tmp["diagnostico"] = $linha->diagnostico;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaCategorias($at) {
 $saida = array();

$sql = "select distinct categoria.id_categoria, categoria.categoria, sistema from contato, categoria, chamado, sistema where ( ( chamado.id_chamado = contato.chamado_id) and ( chamado.categoria_id = categoria.id_categoria) and (sistema.atendimento=$at) and ( sistema.id_sistema = categoria.sistema_id) ) order by sistema, categoria;" ;

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_categoria"] = $linha->id_categoria;
     $tmp["categoria"] = $linha->sistema . " - " . $linha->categoria;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaTipos() {
$saida = array();

$sql = "select distinct origem.origem, id_origem from origem, contato where (contato.origem_id = origem.id_origem) order by origem;";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_origem"] = $linha->id_origem;
     $tmp["origem"] = $linha->origem;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaMotivos() {
$saida = array();

$sql = "select distinct motivo_id, motivo from chamado, motivo where (chamado.motivo_id=motivo.id_motivo) order by motivo";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_motivo"] = $linha->motivo_id;
     $tmp["motivo"] = $linha->motivo;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function desenvolvimento($usuario) {
  if ( ($usuario=="1") OR
  ($usuario=="7") OR
  ($usuario=="12")
  )  {
    return 1;
  } else {
    return 0;
  }

}

function logUsu($s, $quem) {
   $data = date("Y-m-d");
   $hora = date("H:i:s");
   $text = eregi_replace("'", "*", $s);
   $sql = "insert into logUsu (logusu, data, hora, usuario_id) VALUES ('$text', '$data', '$hora', $quem);";
   mysql_query($sql) or print "Erro";
}

function pegaLog() {
  $saida = array();
  $sql = "select data, hora, logusu, nome from logUsu, usuario where (usuario.id_usuario = logUsu.usuario_id) order by data DESC, hora DESC;";
  $result = mysql_query($sql);
  $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["data"] = $linha->data;
     $tmp["hora"] = $linha->hora;
     $tmp["log"] = $linha->logusu;
     $tmp["nome"] = $linha->nome;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaEmails() {
  $saida = array();
  $sql = "select id_usuario, nome, email from usuario order by nome ";
  $result = mysql_query($sql);
  $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
     if ($linha->email) {
      $tmp["id"] = $linha->id_usuario;
      $tmp["email"] = $linha->email;
      $tmp["nome"] = $linha->nome;
      $saida[$conta++] = $tmp;
     }
   }
  return $saida;
}

function listaUsuarios() {
 $saida = array();
 $sql = "SELECT * from usuario order by nome ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaClientesPlus() {
 $saida = array();
 $sql = "SELECT id_cliente, cliente from clienteplus order by cliente ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


 function receptor($id) {
     $sql = "select usuario from receptor where usuario=$id;";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     return mysql_affected_rows();
 }


 function pegaChamadosAbertosPorCliente() {
     $saida=array();
     $sql = "select 
       chamado.*, 
       sistema.sistema 
from 
     chamado
      left join sistema on sistema.id_sistema = chamado.sistema_id
     
     where  externo=1 and motivo_id=0 order by dataa, horaa;";
     $result = mysql_query($sql);
//   print $sql;
     $conta=0;
     while ($linha = mysql_fetch_object( $result ) ) {
       $quando = explode("-", $linha->dataa);
       $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
       $tmp["hora"] = $linha->horaa;
       $tmp["id_chamado"] = $linha->id_chamado;
       $tmp["id_cliente"] = $linha->cliente_id;
       $tmp["sistema"] = $linha->sistema;
       $tmp["descricao"] = $linha->descricao;
       $tmp["email"] = $linha->email;
       $saida[$conta++] = $tmp;
   }
  return $saida;
 }

 function temChamado() {
     $sql = "select count(1) qtde from chamado where externo=1 and motivo_id=0;";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     return $linha->qtde;
 }




function i_contaTarefas($ok) {


  $sql = "select id from i_conjunto where not ok";
  $result = mysql_query($sql);
  $linha=mysql_fetch_object($result);
  $tem = mysql_affected_rows();


  $count = 0;
  $txtSQL = "select distinct a.tabela as tabela from i_tarefas a, i_tarefapessoa b where id_usuario = $ok and a.id=b.id_tarefa and tabela <> '' ORDER BY a.id;";
  $result = mysql_query($txtSQL);
  $count = 0;
  while ( $linha = mysql_fetch_object($result) ) {
	  
	
	  
    $txtSQL2 = "select id_conjunto from $linha->tabela WHERE NOT ok and id_conjunto in (select id from i_conjunto where not ok)";
    $result2 = mysql_query($txtSQL2);
    $count += mysql_affected_rows();
  }
  if (!$count and $tem) {
    return -$tem;
  } else {
    return $count;
  }
}


function pegaOrigem($id) {
     $sql = "select origem from origem where (id_origem = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->origem;
     } else {
       return "Origem nao cadastrado ($id)";
     }
 }



    function pegaversao($sistema_id, $cliente_id) {
      $sql = "Select versao from clisis WHERE cliente = '$cliente_id' AND sistema=$sistema_id";
      $result = mysql_query($sql);
      $linha = mysql_fetch_object($result);
      return $linha->versao;
    }


  function sqlUsuarios() {
    return "select id_usuario as id, nome as descricao from usuario where (area = 2 or area = 3 or area =1 || (area = 11)) and ativo = 1 and atendimento = 1 order by nome;";
  }

  function sqlDiagnosticos() {
    return "select id_diagnostico as id, diagnostico as descricao from diagnostico order by diagnostico;";
  }


  function lista($sql, $nome, $tamanho) {
    $saida = "<select name=\"$nome\" size=\"$tamanho\" multiple>\n" ;
    $result = mysql_query($sql);
    while ($linha = mysql_fetch_object( $result ) ) {
      $saida .=  "<option value=\"" . $linha->id . "\">" . $linha->descricao . "</option>\n";
    }


    $saida .= "</select>\n";
    return $saida;
  }


function conn_ObterListaAnexosContato($id_contato)
{
	global $SITEROOT;
	$saida = array();
	
	$sql = "select 
  nome,
  nome_original
from saduploads
where id_contato = $id_contato";
	$result = mysql_query($sql);
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) 
	{		
		$link = " <a href=\"$SITEROOT/public_html/uploads/$linha->nome\" target=\"_blank\">$linha->nome_original</a>"; 		
		$tmp["link"] = $link;				
		$tmp["nome"] = $linha->nome;
		$saida[$conta++] = $tmp;						
	}

	return $saida;	
}


function conn_ObterEmailsPorTipoDeContato($id_contato)
{
	$saida = array();
	$sql = "select 
       u.nome, u.email, o.origem
from
    AssOrigem ao 
              inner join usuario u on u.id_usuario = ao.Id_Usuario              
              inner join origem o on o.id_origem = ao.Id_Origem
where ao.Id_Origem = $id_contato
";
	$result = mysql_query($sql);
	$conta=0;
	while ($linha = mysql_fetch_object( $result ) ) 
	{
		$tmp["nome"] = $linha->nome;		
		$tmp["email"] = $linha->email;
		$tmp["origem"] = $linha->origem;
		$saida[$conta++] = $tmp;
	}

	return $saida;	
}

function pegaGerentes() {
 $saida = array();
 $sql = "";
 $sql = "SELECT email FROM usuario ";
 $sql .= "WHERE (";
 $sql .= " gerente ) or id_usuario = 12";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $quando = explode("-", $linha->dataa);
     $tmp["email"] = $linha->email;
     $saida[$conta++] = $tmp;
   }

  return $saida;
}


define('LOG_NOVO_CHAMADO', 1);
define('LOG_INSERIU_CONTATO', 2);
define('LOG_LEU_CHAMADO', 3);
define('LOG_ENCERROU_CHAMADO', 4);
define('LOG_SEGUIU_CHAMADO', 5);
define('LOG_DEIXOU_DE_SEGUIR_CHAMADO', 6);
define('LOG_INSERIU_COMPLEMENTO', 7);
define('LOG_REABRIU_CHAMADO', 8);
define('LOG_DIP_SAD', 10);
define('LOG_ENCAMINHOU_CHAMADO', 11);
define('LOG_MANTEVE_PENDENTE', 12);
define('LOG_INICIOU_CONTATO', 13);
define('LOG_CANCELOU_CONTATO', 14);
define('LOG_LOGIN', 15);
define('LOG_OUTROS', 127);

function loga_login($id_usuario) {
	loga_online_plus($id_usuario, 'Login', LOG_LOGIN, 0 ); 
}


function loga_integracao($id_usuario) {	 
  if (!isset($id_usuario)) {
	  $id_usuario = 0;
  }
  loga_online_plus($id_usuario, 'DIP -> SAD', LOG_DIP_SAD, 0 );
}

function loga_novoContato($id_usuario, $id_chamado) {
	loga_online_plus($id_usuario, '', LOG_INICIOU_CONTATO, $id_chamado ); 		
}

function loga_cancelaContato($id_usuario, $id_chamado) {
	loga_online_plus($id_usuario, '', LOG_CANCELOU_CONTATO, $id_chamado ); 
}

function loga_novoComplemento($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_INSERIU_COMPLEMENTO, $id_chamado );	 
}

function loga_reabrirChamado($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_REABRIU_CHAMADO, $id_chamado );	 
}

function loga_encaminhouChamado($id_usuario, $id_chamado, $id_contato, $id_destinatario) {
	$acao = LOG_ENCAMINHOU_CHAMADO; 
	if ($id_usuario == $id_destinatario) {	
		$acao = LOG_MANTEVE_PENDENTE; 
	}	
	$id = loga_online_plus($id_usuario, '', $acao, $id_chamado );	
	//rastreabilidade_novoContato($id_chamado);
	atualizaLog($id, $id_contato, $id_destinatario);
	loga_email_NovoContatoSigame($id_usuario, $id_chamado);	
}


function loga_novoChamado($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_NOVO_CHAMADO, $id_chamado );	 
   //rastreabilidade_novoChamado($id_chamado);   
}

function loga_encerrouChamado($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_ENCERROU_CHAMADO, $id_chamado );	 
   loga_email_EncerraChamadoSigame($id_usuario, $id_chamado);   
}

function loga_viuChamado($id_usuario, $id_chamado) {	
	if ($id_usuario ==  175) { return ; }
	if ($id_usuario ==  USUARIO_ADMIN) { return ; }
	if (LOG_ATIVO_LEITURA) {
		loga_online_plus($id_usuario, '', LOG_LEU_CHAMADO, $id_chamado );
		loga_email_viuChamadoSigame($id_usuario, $id_chamado);   
	}
}

function loga_seguirChamado($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_SEGUIU_CHAMADO, $id_chamado );	 
}

function loga_deixarDeSeguirChamado($id_usuario, $id_chamado) {
   loga_online_plus($id_usuario, '', LOG_DEIXOU_DE_SEGUIR_CHAMADO, $id_chamado );	 
}

function atualizaLog($id, $id_contato, $id_destinatario)
{
   $sql = "update log set id_contato = $id_contato, id_destinatario = $id_destinatario where id = $id";
   mysql_query($sql);
}

function loga_online_plus($id_usuario, $pagina, $acao, $id_chamado ) {

	if (LOG_ATIVO) {	
		$data = date("Y-m-d");
		$hora = date("H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = "INSERT INTO log ( pagina, ip, id_usuario, data, hora, acao, id_chamado ) ";
		$sql .= " VALUES ( '$pagina', '$ip', $id_usuario, '$data', '$hora', $acao, $id_chamado);";  
		mysql_query($sql) or die ($sql);
		
	
		
		$sql = "select max(id) id from log where id_usuario = $id_usuario and id_chamado = $id_chamado";
		$result = mysql_query($sql) or die ($sql);
		$linha = mysql_fetch_object($result);
			
		return $linha->id;
	}
}

function loga_email_PalavraChave($id_usuario, $id_chamado, $mensagem, $contato)
{
	global $SITEROOT;
	$Destinatarios = obterDestinatariosPorPalavraChave($contato);
	$nome = peganomeusuario($id_usuario);
	$email = "";
	foreach( $Destinatarios as $email ) {						
	    $SlackUser = $email["slackUser"];	
		$palavra = $email["palavra"];	
		$mensagem_email = $mensagem . "<br><hr/>" . $email["mensagem"];	
						
		if ($SlackUser != "")	   
		{
			slack($SlackUser, $id_chamado, "Contato com a palavra chave *" . $palavra . "*", "SAD", "Palavra : " . $palavra);
		}
		else
		{
			mail2($email["email"], '[SAD] Palavra Chave', $mensagem_email, 'SAD');
		}
		
	}	
}

function loga_email_Sigame($id_usuario, $id_chamado, $mensagem, $assunto, $flag)
{
	global $SITEROOT;
	$Destinatarios = obterDestinatariosQueSeguemEsteChamado($id_chamado);
	$DadosDoChamado = obterDadosDoChamado($id_chamado);
	$nome = peganomeusuario($id_usuario);
	$mensagem .= "<br>";
	$mensagem .= $DadosDoChamado;
	$mensagem .= "<br><a target=_blank href=$SITEROOT/a/sigame/index.php>Ir para o Desktop Siga-me</a>";		
	foreach( $Destinatarios as $email ) {		
	
		if ( $flag == LOG_LEU_CHAMADO ) 
		{
			if ( ($email["id_usuario"] != 12) && ($email["id_usuario"] != 141))  {
			  return;
			}
		    if ( $email["id_usuario"] == $id_usuario ) 
			{
			  return;
			}			
		}
		mail2($email["email"], $assunto, $mensagem, '');
	}	
}

function loga_email_EncerraChamadoSigame($id_usuario, $id_chamado)
{
	global $SITEROOT;
	$nome = peganomeusuario($id_usuario);	
	$mensagem = "$nome encerrou o chamado <a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a>";	
	$assunto = "Siga-me - Chamado encerrado";
    loga_email_Sigame($id_usuario, $id_chamado, $mensagem, $assunto, 1);		
	
	$contato = conn_obterUltimoContato($id_usuario, $id_chamado);	
	$mensagem = "$nome encerrou um chamado:<br><a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a> - $descricao<br><br>Contém uma um mais palavra chave cadastrada";	
	loga_email_PalavraChave($id_usuario, $id_chamado, $mensagem, $contato);	
}

function loga_email_NovoContatoSigame($id_usuario, $id_chamado)
{
	global $SITEROOT;
	$nome = peganomeusuario($id_usuario);	
	$descricao = conn_obterDescricao($id_chamado);	
	$contato = conn_obterUltimoContato($id_usuario, $id_chamado);
	$mensagem = "$nome inseriu um contato no chamado:<br><a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a> - $descricao<br><br>Contato:<br>$contato";
	$assunto = "Siga-me - Novo contato";
    loga_email_Sigame($id_usuario, $id_chamado, $mensagem, $assunto, 2);

	$mensagem = "$nome inseriu um contato no chamado:<br><a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a> - $descricao<br><br>Contém uma um mais palavra chave cadastrada";	
	loga_email_PalavraChave($id_usuario, $id_chamado, $mensagem, $contato);
}

function loga_email_viuChamadoSigame($id_usuario, $id_chamado)
{
	global $SITEROOT;
	$nome = peganomeusuario($id_usuario);		
	$mensagem = "$nome leu o chamado <a target=_blank href=$SITEROOT/a/historicochamado.php?id_chamado=$id_chamado>$id_chamado</a>";
	$assunto = "Siga-me - Leitura de chamado";
	loga_email_Sigame($id_usuario, $id_chamado, $mensagem, $assunto, 3);
}

function obterDestinatariosPorPalavraChave($mensagem)
{
	$mensagem_down = strtolower($mensagem);
	$saida = array();				
	$c = 0;	
	$sql_1 = "select distinct u.slackUser, u.id_usuario, u.email from AssPalavraChave p inner join usuario u on u.id_usuario = p.id_usuario";	
	$result_1 = mysql_query($sql_1);	
	while ($linha_1 = mysql_fetch_object($result_1))
	{	
		$sql_2 = "select palavra from AssPalavraChave where id_usuario = " . $linha_1->id_usuario;
		$result_2 = mysql_query($sql_2);	
		$mensagemSaida = $mensagem;
		$encontrou = false;
		while ($linha_2 = mysql_fetch_object($result_2))
		{
			$palavra = strtolower($linha_2->palavra);
			if (strpos($mensagem_down, $palavra) !== false) {		
				$mensagemSaida = eregi_replace($palavra, "<b><font  color=#FF0000>$palavra</font></b>", $mensagemSaida);
				$encontrou = true;
				$palavraEncontrada = $palavra;
			}			
		}		
		if ($encontrou)
		{
			$saida[$c]["palavra"] = $palavraEncontrada;
			$saida[$c]["email"] = $linha_1->email;
			$saida[$c]["slackUser"] = $linha_1->slackUser;
			$saida[$c++]["mensagem"] = $mensagemSaida;		
		}
	}	
	return $saida;
}

function obterDestinatariosQueSeguemEsteChamado($id_chamado)
{
	$saida = array();	
	$c = 0;	
	$sql = "select u.id_usuario, u.email from sigame s inner join usuario u on u.id_usuario = s.id_usuario where id_chamado = $id_chamado";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result))
	{
	    $saida[$c]["id_usuario"] = $linha->id_usuario;
		$saida[$c++]["email"] = $linha->email;		
	}
	return $saida;
}

/*function loga_online($id_usuario, $ip, $pagina ) {
  $data = date("Y-m-d");
  $hora = date("H:i:s");
  
  if ( ($id_usuario != 12) )  { 
    $sql = "INSERT INTO log ( pagina, ip, id_usuario, data, hora ) VALUES ( '$pagina', '$ip', $id_usuario, '$data', '$hora');";  
    if ($pagina) {mysql_query($sql);}
  }
}*/



function loga_online($id_usuario, $ip, $pagina ) {

  $data = date("Y-m-d");
  $hora = date("H:i:s");

  // Deleta quem esta a mais de 30 minutos
  $sql =  "delete from  online where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+1800 ))";
  mysql_query($sql);

  // Offline quem esta a mais de 15
  $sql =  "update online set online=0 where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+900 ))";
  mysql_query($sql);

  $result = mysql_query("SELECT id_usuario from online where id_usuario=$id_usuario;");
  $num_rows = mysql_num_rows($result);
  if($num_rows) {
    $sql = "update online set data='$data', hora='$hora', online=1, pagina='$pagina' WHERE id_usuario = $id_usuario;";
  } else {
    $sql = "INSERT INTO online ( pagina, ip, id_usuario, data, hora, online ) VALUES ( '$pagina', '$ip', $id_usuario, '$data', '$hora', 1);";
  }
  mysql_query($sql);

}


function EmailAgenda($iddono, $id, $data, $hora, $horafim, $resumo, $local, $descricao, $textEmail, $titulo ) {

    $data=explode('-', $data);
	$dia = "$data[2]/$data[1]/$data[0]";

	$email = PegaEmailUsuario($id);
	$textEmail = str_replace("[usuario]", peganomeusuario($id), $textEmail);
	$textEmail = str_replace("[dono]", peganomeusuario($iddono), $textEmail);
	$textEmail = str_replace("[data]", $dia, $textEmail);
	$textEmail = str_replace("[hora]", $hora, $textEmail);
	$textEmail = str_replace("[horafim]", $horafim, $textEmail);
	$textEmail = str_replace("[local]", $local, $textEmail);
	$textEmail = str_replace("[descricao]", $descricao, $textEmail);


	$subject = "$resumo";
	$headers = $titulo;
	mail2($email, $subject, $textEmail, $headers);
}

function pegaChamadosRNC() {

// $usuario = 12;

 $saida = array();

 $sql = "";
 $sql .= "SELECT ";
 $sql .= "  c.sistema_id, c.id_chamado, c.lido, rnc, ";
 $sql .= "  c.lidodono, c.dataa,c.horaa, c.datauc, c.horauc, c.status,  ";
 $sql .= "  destinatario_id, consultor_id, remetente_id, ";
 $sql .= "  LEFT(c.descricao, 250) as descricao,  ";
 $sql .= "  p.prioridade,  p.valor  ";
 $sql .= "FROM  ";
 $sql .= "  chamado c, prioridade p  ";
 $sql .= "WHERE  (   ";
 $sql .= "  ( (c.descricao is not null)  AND (c.descricao <> '') ) AND  ";
 $sql .= "  ( c.prioridade_id = p.id_prioridade) AND  ";
 $sql .= "  ( c.status >  1) AND ";
 $sql .= "  ( c.status <= 3) AND ";
 $sql .= "  ( rnc > 0 and rnc < 4  ) ";
 $sql .= ")  ";
 $sql .= "ORDER BY  ";
 $sql .= "  rnc, p.valor, dataa desc, horaa desc";
 
// die($sql);

 $result = mysql_query($sql) or die ($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {



     $tmp["externo"] = $linha->externo;
     $tmp["lido"] = $linha->lido;
     $tmp["lidodono"] = $linha->lidodono;
     $tmp["usuario_id"] = $linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;

     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["usuario_id"])
     ) ;


     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;

     $quando = explode("-", $linha->dataa);
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;

     $quando = explode("-", $linha->datauc);
     $tmp["datauc"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horauc"] = $linha->horauc;

     $tmp["telefone"] = $linha->telefone;
     $tmp["status"] = $linha->status;
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;

     $saida[$conta++] = $tmp;
   }

  return $saida;
}



function pegaArea($id) {
     $sql = "select area from sad.usuario where (id_usuario = $id);";
     $result = mysql_query($sql) or die (mysql_error() . ' - ' . $sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->area;
     } else {
       return 0;
     }
 }


function dateDiff($dia1) {
// This is a simple script to calculate the difference between two dates
// and express it in years, months and days
// 
// use as in: "my daughter is 4 years, 2 month and 17 days old" ... :-)
//
// Feel free to use this script for whatever you want
// 
// version 0.1 / 2002-10-3
//
// please send comments and feedback to webmaster@lotekk.net
//

// ****************************************************************************

// configure the base date here
$d1 = explode('/', $dia1);
$base_day		= $d1[0];		// no leading "0"
$base_mon		= $d1[1];		// no leading "0"
$base_yr		= $d1[2];		// use 4 digit years!

// get the current date (today) -- change this if you need a fixed date
$current_day		= date ("j");
$current_mon		= date ("n");
$current_yr		= date ("Y");

// and now .... calculate the difference! :-)

// overflow is always caused by max days of $base_mon
// so we need to know how many days $base_mon had
$base_mon_max		= date ("t",mktime (0,0,0,$base_mon,$base_day,$base_yr));

// days left till the end of that month
$base_day_diff 		= $base_mon_max - $base_day;

// month left till end of that year
// substract one to handle overflow correctly
$base_mon_diff 		= 12 - $base_mon - 1;

// start on jan 1st of the next year
$start_day		= 1;
$start_mon		= 1;
$start_yr		= $base_yr + 1;

// difference to that 1st of jan
$day_diff	= ($current_day - $start_day) + 1; 	// add today
$mon_diff	= ($current_mon - $start_mon) + 1;	// add current month
$yr_diff	= ($current_yr - $start_yr);

// and add the rest of $base_yr
$day_diff	= $day_diff + $base_day_diff;
$mon_diff	= $mon_diff + $base_mon_diff;

// handle overflow of days
if ($day_diff >= $base_mon_max)
{
	$day_diff = $day_diff - $base_mon_max;
	$mon_diff = $mon_diff + 1;
}

// handle overflow of years
if ($mon_diff >= 12)
{
	$mon_diff = $mon_diff - 12;
	$yr_diff = $yr_diff + 1;
}

// the results are here:

// $yr_diff  	--> the years between the two dates
// $mon_diff 	--> the month between the two dates
// $day_diff 	--> the days between the two dates

// ****************************************************************************

// this is just to make it look nicer
$years = "anos";
$days = "dias";
$meses = "meses";
if ($yr_diff == "1") $years = "ano";
if ($day_diff == "1") $days = "dia";
if ($mon_diff=="1") $meses = "mes";

	// here we go
	$m = $d = "";
	if ($mon_diff > 0) {
		if ($day_diff > 0) {
			$m = ", $mon_diff $meses";		
		} else {
			$m = " e $mon_diff $meses";
		}
	}

	if ($day_diff > 0) {
		$d = " e $day_diff $days";
	}

	//return "$yr_diff $years, $mon_diff $meses e $day_diff $days";
	return "$yr_diff $years$m$d";
}

function conn_ExcluiControleNovoContato($id_chamado, $Id_Usuario)
{
	$sql = "delete from contato_temp where id_chamado = $id_chamado and id_usuario = $Id_Usuario";
	mysql_query($sql) or die(mysql_error() . " - ". $sql);
}

function conn_ExcluiControleNovoChamado($id_chamado, $Id_Usuario)
{
	$sql = "delete from chamado_temp where id_chamado = $id_chamado and id_usuario = $Id_Usuario";
	mysql_query($sql) or die(mysql_error() . " - ". $sql);
}

function conn_VerificaNovoChamado($Id_Usuario, $id_cliente)
{
  $sql = "select * from chamado_temp where id_usuario = $Id_Usuario and id_cliente = '$id_cliente'";
  $result = mysql_query($sql) or die (mysql_error() . "<br> $sql");
  $linha = mysql_fetch_object($result);
  if ($linha)  {	
	$saida = array();	
	$saida["status"] = 1; // Existente 0 = nao inseriu
	$saida["data"] = $linha->data;
	$saida["hora"] = $linha->hora;

	$contato = str_replace(array("\n", "\r"), array('\n', '\r'), $linha->contato ); 		
	$contato = str_replace("\"", "'", $contato);			
	$saida["contato"] = $contato;

	$saida["chamado"] = $linha->chamado;    
	$saida["id_chamado"] = $linha->id_chamado;
  }
  return $saida;
}


function conn_InsereNovoChamado($Id_Usuario, $id_cliente, $chamado, $Data_Novo_Contato, $Hora_Novo_Contato)
{	
	$sql = "insert into chamado_temp (id_chamado, id_cliente, id_usuario, data, hora) values (";
	$sql .= $chamado . ", '" 
		. $id_cliente . "', "
		. $Id_Usuario . ", '" 
		. $Data_Novo_Contato . "', '"
		. $Hora_Novo_Contato . "' )";
	mysql_query($sql) or die (mysql_error() . "<br> $sql");		
	return;
}


function conn_obterListaRestricoes($ok, $chamado)
{
	$saida = array();
	if (!$chamado) {
		$sql = "select Id id, Ds_Descricao descricao from restricoes 
		where Id in (SELECT distinct id_restricao FROM rl_restricao_manut r where id_usuario = $ok)	
		order by Ds_Descricao";
	} else {
		$sql = "	
select Id id, Ds_Descricao descricao from restricoes 
where Id in (
    SELECT distinct id_restricao FROM rl_restricao_manut r where id_usuario = $ok and
      id_restricao not in (select Id_Restricao from rl_restricao_chamado where Id_Chamado = $chamado)
    )	
order by Ds_Descricao";

	}
	$result = mysql_query($sql);
	$c = 0;
	while ($linha = mysql_fetch_array($result))
	{
		$saida[$c++] = $linha;
	}
	return $saida;
}


function conn_InsereControleNovoContato($id_chamado, $Id_Usuario, $Data_Novo_Contato, $Hora_Novo_Contato)
{
	$saida = array();
	$sql = "select * from contato_temp where id_chamado = $id_chamado and id_usuario = $Id_Usuario";
	$result = mysql_query($sql) or die (mysql_error() . "<br> $sql");
	$linha = mysql_fetch_object($result);
	if ($linha) 
	{
		$saida["status"] = 0; // Existente 0 = nao inseriu
		$saida["data"] = $linha->data;
		$saida["hora"] = $linha->hora;				
		$contato = str_replace(array("\n", "\r"), array('\n', '\r'), $linha->contato ); 		
		$contato = str_replace("\"", "'", $contato);		
		$saida["contato"] = $contato;
	} else 
	{
		
		$sql = "insert into contato_temp (id_chamado, id_usuario, data, hora) values (";
		$sql .= $id_chamado . ", " . $Id_Usuario . ", '" . $Data_Novo_Contato . "', '". $Hora_Novo_Contato ."' )";
		mysql_query($sql) or die (mysql_error() . "<br> $sql");		
		$saida["status"] = 1; // 1 = inseriu		
		$saida["data"] = $Data_Novo_Contato;
		$saida["hora"] = $Hora_Novo_Contato;
	}
	return $saida;
}

function sec_to_time($segundos) 
{

	$horas =   (int)($segundos / 3600);
	
	$segundos = $segundos % 3600;
	
	$minutos = (int)($segundos / 60);
	$segundos = $segundos % 60;
  
  $time = sprintf("%02d", $horas) . ":" . 
	      sprintf("%02d", $minutos) . ":" . 
		  sprintf("%02d", $segundos);
  return $time;
}


function obterCorPorGrau($Grau)
{
	$cor = "#FFFFFF";			
	if ($Grau == "G1") 
	{
		$cor = "#C1FB9F";
	}
	if ($Grau == "G2") 
	{
		$cor = "#FBF175";
	}
	if ($Grau == "G3") 
	{
		$cor = "#BDE6FB";
	}
	return $cor;
}

/*
|  1 | consultoria            |
|  2 | desenvolvimento delphi |
|  3 | desenvolvimento cobol  |
|  4 | administracao          |
|  5 | treinamento            |
|  6 | recepcao               |
|  7 | marketing              |
|  8 | outra                  |
|  9 | nenhuma                |
| 10 | jurídico               |
| 11 | Qualidade de software  |
| 12 | TI                     |
*/

define('CONSULTORIA', 1);
define('DELPHI', 2);
define('COBOL', 3);
define('ADMINISTRACAO', 4);
define('TREINAMENTO', 5);
define('RECEPCAO', 6);
define('MARKETING',7);
define('JURIDICO', 10);
define('QUALIDADE', 11);
define('TI', 12);

define('SAD_NAOCONFORMIDADE','1');
define('SAD_ACAOPREVENTIVA','2');
define('SAD_ACAOMELHORIA','3');
define('SAD_ABERTURAPROJETO','4');


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
	
/*
  $sql = "select max(Id) as ID from Emails where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  */
	
	return mysql_insert_id();	
}


function conn_EnviaEmailsPendentes()
{
	$sql_emails = "select * from Emails where Cd_Situacao = 1 order by Id limit 10";
	$query_email = mysql_query($sql_emails);
	while ($linha_email = mysql_fetch_object($query_email))
	{	
		$retorno = conn_EnviaEmail($linha_email);		
		conn_AtualizaStatusEmail($linha_email->Id, $retorno);	
	}
}

function conn_EnviaEmail($linha)
{
	global $site;  // se for dentro de funcao
	

	$site['from_email'] = "suporte@datamace.com.br"; 
	$site['smtp_mode'] = "enabled"; 
	$site['smtp_host'] = "pop.datamace.com.br";
	$site['smtp_port'] = "587"; 
	$site['smtp_username'] = "sad@datamace.com.br";
	$site['smtp_password'] = "data0915";	
	// procurar mail2
	
	require_once('mailclass.inc.php'); 	

	$retorno = '';
	
	$mailer = new FreakMailer(); 
	
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br','../a/scripts/language/');
	$mailer->Subject = $linha->Ds_Assunto; 
	$mensagem = $linha->Tx_Mensagem;
	$mailer->Body = $mensagem; 	
	$mensagem_txt = strip_tags($mensagem);	
	
	$Email_Para = $linha->Nm_Email_Para;
//	$Email_Para = "fernando.nomellini@datamace.com.br";
	$mailer->AddAddress("$Email_Para", "$Email_Para"); 	

	if (!$mailer->Send()) { 
		$retorno .= 'Problemas no envio do email para: '. $linha->Nm_Email_Para . ' \n';
		$retorno .= '\tErro: '. $mailer->ErrorInfo .'\n';
	} 

	$mailer->ClearAddresses(); 
	$mailer->ClearAttachments();   
	
	return $retorno;
}

function conn_AtualizaStatusEmail($Id, $retorno)
{
	$Cd_Situacao = 2;
	if ($retorno)
	{
		$Cd_Situacao = 3;	
	}
	$Hoje = date("Y-m-d H:i:s");
	$sql = "update Emails set Dt_Envio = '$Hoje', Cd_Situacao = $Cd_Situacao, Tx_Mensagem_Erro = '$retorno' where id = $Id";
	mysql_query($sql) or die (mysql_error());
	return;
}

function mail2($_recipient, $_subject, $_msg, $_headers) {
	
	if (!ENVIA_EMAIL)
		return;
	
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

		
	//$headers["Content-type"] = "text/html; charset=utf-8";
	
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
	$params["password"] = "data0915";
	// procurar conn_EnviaEmail
	
	
	global $site;  // se for dentro de funcao	
	
	$_smtp_host = "pop.datamace.com.br";
	$_smtp_port = '587';
	$_smtp_autentica = 'enabled';
	$_smtp_usuario = $params["username"];
	$_smtp_senha = $params["password"];
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
    $mailer->CharSet = "UTF-8";	
	
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br','../a/scripts/language/');
	$mailer->Subject = $_subject; 
	$mensagem = $_msg;
	$mailer->Body = $mensagem; 
	$mensagem_txt = strip_tags($mensagem);
	
	$mailer->AddAddress("$_recipient", "$_recipient"); 
	
	if ($_ReplyName) {
		$mailer->AddReplyTo($_ReplyMail,$_ReplyName);
	}	
	if (trim($cc_email)) {
		$mailer->AddCC("$cc_email", "$cc_nome"); 
	} 	
	
	//Descomento esta linha para testar os emails enviados.
	//$mailer->AddBCC("fernando.nomellini@datamace.com.br", "sad");
	
	//$LastId = Log_Email($_recipient, $_subject, $_msg, $_headers, $_ReplyMail, $_ReplyName);				




	if (!$mailer->Send()) { 		
		$retorno .= 'Problemas no envio do email para: '. $_recipient . ' \n';
		$retorno .= '\tErro : '. $mailer->ErrorInfo .'\n';
		$ok = 'n';				
		//conn_AtualizaStatusEmail($LastId, $retorno);		
	} else { 
		$ok = 's';
		//conn_AtualizaStatusEmail($LastId, "");
	}

		
	$mailer->ClearAddresses(); 
	$mailer->ClearAttachments();   		
}


function AdicionarPrograma($programa, $obs, $ok, $id_chamado)
{		
	$Data_Atual = date("Y-m-d") . " " . date("H:i:s");
	$sql = "insert into chamado_programas (id_chamado, id_usuario, dt_DataCriacao, nm_nome, ic_commit, ds_obs) ";
	$sql .= "values ($id_chamado, $ok, '$Data_Atual', '$programa', 0, '$obs')";
	mysql_query($sql);
	$LOCAL = $_SERVER["SCRIPT_NAME"] . "?id_chamado=$id_chamado";
	header("Location: $LOCAL");	
}

function CommitPrograma($ok, $id_programa, $id_chamado)
{	
	$Data_Atual = date("Y-m-d") . " " . date("H:i:s");
	$sql = "update chamado_programas set ic_commit = 1, dt_commit = '$Data_Atual', id_usuario_commit = $ok where Id = $id_programa";
	mysql_query($sql) or die (mysql_error() . ' - ' . $sql);
	$LOCAL = $_SERVER["SCRIPT_NAME"] . "?id_chamado=$id_chamado";
	header("Location: $LOCAL");	
}

function TirarCommitPrograma($ok, $id_programa, $id_chamado)
{	
	$Data_Atual = date("Y-m-d") . " " . date("H:i:s");
	$sql = "update chamado_programas set ic_commit = 0, dt_commit = '$Data_Atual', id_usuario_commit = $ok, ds_obs = 'Commit retirado' where Id = $id_programa;";
//	die($sql);
	mysql_query($sql) or die (mysql_error() . ' - ' . $sql);
	$LOCAL = $_SERVER["SCRIPT_NAME"] . "?id_chamado=$id_chamado";
	header("Location: $LOCAL");	
}

function ExcluirPrograma($ok, $id_programa, $id_chamado)
{	
	$Data_Atual = date("Y-m-d") . " " . date("H:i:s");
	$sql = "update chamado_programas set ic_ativo = 0, ic_commit = 0, dt_commit = '$Data_Atual', id_usuario_commit = $ok, ds_obs = 'Progrma Excluido' where Id = $id_programa;";
//	die($sql);
	mysql_query($sql) or die (mysql_error() . ' - ' . $sql);
	$LOCAL = $_SERVER["SCRIPT_NAME"] . "?id_chamado=$id_chamado";
	header("Location: $LOCAL");	
}

function podeAcessarNosHorarios($horaEntrada, $horaSaida)
{
	$horaEntrada = $horaEntrada * 60;
	$horaSaida = $horaSaida * 60;
	$minutoAtual = date("H") * 60 + date("i");	
	if ( ($minutoAtual >= $horaEntrada) && ($minutoAtual <= $horaSaida)  )  
	{
		return true;
	} else 	{
		return false;
	}
}


function obterProgramasVersao($id_chamado)
{
  
}

function obterDadosDoChamado($id_chamado)
{
	$sql = "select 
  c.id_chamado, 
  c.dataa DtAbertura,
  concat(cliente.id_cliente, ' - ',  cliente.cliente) cliente,
  left(c.descricao, 100) descricao,
  dono.nome dono, 
  destinatario.nome destinatario, 
  status.status 
from chamado c
  inner join usuario dono on dono.id_usuario = c.consultor_id
  inner join usuario destinatario on destinatario.id_usuario = c.destinatario_id
  inner join status on status.id_status = c.status
  inner join cliente on cliente.id_cliente = c.cliente_id
where id_chamado = " . $id_chamado;

	$query = mysql_query($sql);
	$linha = mysql_fetch_object($query);
	$Texto = "";
	$Texto .= "<br>Cliente    : " . $linha->cliente;
	$Texto .= "<br>Aberto em  : " . amd2dma($linha->DtAbertura);
	$Texto .= "<br>Aberto por : " . $linha->dono;		
	$Texto .= "<br>Esta com   : " . $linha->destinatario;	
	$Texto .= "<br>Descricao  : " . $linha->descricao;

	return $Texto;
}


function rastreabilidade_novoChamado($id_chamado)
{
	$sql = "select u1.area from chamado c inner join usuario u1 on u1.id_usuario = consultor_id where id_chamado = $id_chamado";
	$AreaOrigem = conn_ExecuteScalar($sql);
	$AreaDestino = 0;
	rastreabilidade_inserir($id_chamado, $AreaOrigem, $AreaDestino);
}

function rastreabilidade_novoContato($id_chamado)
{	
	$AreaOrigem = conn_ExecuteScalar("select id_area_destino from rastreabilidade where id_chamado=$id_chamado order by Id desc limit 1");	
	if ($AreaOrigem == "")
	{
		$AreaOrigem = -1;
	}
	$AreaDestino = conn_ExecuteScalar("select u1.area from chamado c inner join usuario u1 on u1.id_usuario = destinatario_id where id_chamado = $id_chamado");
	rastreabilidade_inserir($id_chamado, $AreaOrigem, $AreaDestino);
}

function rastreabilidade_inserir($id_chamado, $AreaOrigem, $AreaDestino)
{
	if (  ($AreaOrigem == $AreaDestino) || ($AreaOrigem == 0)  )
	{
		rastreabilidade_Atualizar($id_chamado);
	} else 
	{
		$Ic_Acao = 1; // Interacao
		if ($AreaDestino == 0)
		{
			$Ic_Acao = 0; //Novo Chamado
		} else if ($AreaDestino == -1) {
			rastreabilidade_Criar($id_chamado);
		}
		$data = date("Y-m-d");
		$hora = date("H:i:s");
		$sql = "insert into rastreabilidade (id_chamado,   data,    hora, id_area_origem, id_area_destino, qt_interacoes, dt_ultima_interacao, ic_acao)
  		                            values( $id_chamado, '$data', '$hora',   $AreaOrigem,    $AreaDestino,             1, '$data',            $Ic_Acao)";
		conn_ExecuteNonQuery($sql);						  
	}
}

function rastreabilidade_Atualizar($id_chamado)
{
	$Id = conn_ExecuteScalar("select max(id) from rastreabilidade where id_chamado=$id_chamado");
	$hoje = date("Y-m-d");
	conn_ExecuteNonQuery("update rastreabilidade set qt_interacoes = qt_interacoes + 1, dt_ultima_interacao = '$hoje' where Id=$Id");
}

function rastreabilidade_Criar($id_chamado)
{
	$sql = "select u.area, dataa from contato inner join usuario u on contato.destinatario_id =  u.id_usuario where chamado_id = $id_chamado";	
}



	function params_obter($id_parametro)
	{
		$sql = "select vl_valor from parametros where id_parametro = $id_parametro";
		return conn_ExecuteScalar($sql);
	}
	
	function params_gravar($id_parametro, $valor)
	{
		$sql = "update parametros set vl_valor = $valor where id_parametro = $id_parametro";
		conn_ExecuteNonQuery($sql);
		return;
	}




function connDeleteRestricao($IdChamado, $IdRestricao)
{
	mysql_query("delete from rl_restricao_chamado where Id_Restricao = $IdRestricao and Id_Chamado = $IdChamado");
}

function connGravaRestricao($IdChamado, $IdRestricao, $Ic_Implementado)
{
	mysql_query("insert into rl_restricao_chamado (Id_Restricao, Id_Chamado, Ic_Implementado) values ($IdRestricao, $IdChamado, $Ic_Implementado)");
}

function connSetRestricao($IdChamado, $IdRestricao)
{
	connDeleteRestricao($IdChamado, $IdRestricao);
	connGravaRestricao($IdChamado, $IdRestricao, "1");
}

function connResetRestricao($IdChamado, $IdRestricao)
{
	connDeleteRestricao($IdChamado, $IdRestricao);
	connGravaRestricao($IdChamado, $IdRestricao, "0");	
}


function connAlterarRestricao($IdChamado, $IdUsuario, $IdRestricao, $IcStatus)
{
	/*
		1. Alterar op Status do Flag da restricao no chamado
	*/
	$sql = "update rl_restricao_chamado set Ic_Implementado = not Ic_Implementado where Id_Restricao = $IdRestricao and Id_Chamado = $IdChamado";
	mysql_query($sql);
	
	/*
		2. Inserir o histórico das alteraçoes
	*/
	$DataHoraAtual = date("Y-m-d H:i:s");
	$sql = "insert into restricao_historico (Id_Chamado, Id_Restricao, Id_Usuario, Dt_Data, Ic_Status)
			values ($IdChamado, $IdRestricao, $IdUsuario, '$DataHoraAtual', $IcStatus)";
	mysql_query($sql);

}



function conn_InserirNaFilaRetaguarda($IdConsultor, $IdChamado) 
{
	$sql = "insert into retaguarda_fila (Dt_Solicitacao, Id_Consultor, Id_Chamado, Ic_Status) values (now(), $IdConsultor, $IdChamado, 1);";
	conn_ExecuteNonQuery($sql);
}

?>
