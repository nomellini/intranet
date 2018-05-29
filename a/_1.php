<?
	require("scripts/conn.php");
	require("scripts/funcoes.php");	
	require("scripts/classes.php");	
	
	if ( isset($id_usuario)) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
	    if (!isset($ok)) {
			header("Location: index.php");
		}
	}
	
	$is_god = conn_IsGod($ok);
	
	// Usuários em férias não tem acesso ao SAD.
	$dayofweek = date('w'); // 0 = Domingo, 6 = Sábado
	
	$_Datamace = substr($REMOTE_ADDR,0,9) == "192.168.0";
	$_Inter = substr($REMOTE_ADDR,0,13) == "189.55.193.78";
	$GrupoDatamace = $_Datamace || $_Inter;
	

	if (($ok != 1) && ($ok != 7) && ($ok != 18) && ($ok != 12) && ($ok != 3) && ($ok != 248) && ($ok != 63)  )
		
		if ( !$GrupoDatamace ) {	
	
			$headers = "Suporte Datamace";
						
			$Nome = pegaNomeUsuario($ok);
	
			// Verifica Fim de semana	
			if ( ($dayofweek == 6) || ($dayofweek == 0)) {				
				$_Corpo = "<b>$Nome</b> tentou acesso ao SAD em final de semana no dia $Data_Atual $Hora_Atual";
				mail2("fernando.nomellini@datamace.com.br", "Acesso negado FDS", $_Corpo, $headers);
				loga_online_plus($ok, 'NEGADO FIM DE SEMANA', LOG_OUTROS, 0 ); 
				header("Location: /a/AcessoNegado.php?IdMsg=1");
			}
			
			if (!podeAcessarNosHorarios(8, 18))
			{
				$_Corpo = "<b>$Nome</b> tentou acesso ao SAD em horario indevido (06:00 a 20:00) no dia $Data_Atual $Hora_Atual";
				mail2("fernando.nomellini@datamace.com.br", "Acesso negado horário", $_Corpo, $headers);								
				loga_online_plus($ok, 'NEGADO HORARIO (06:00 ~ 20:00)', LOG_OUTROS, 0 ); 				
				header("Location: /a/AcessoNegado.php?IdMsg=3");
			}

	
			// Verifica férias
			$_sql = "Select count(cu.fl_ferias) f from  compromisso c
						inner join compromissousuario cu on cu.id_compromisso = c.id
						where 
						c.excluido = 0 and
						cu.fl_ferias = 1 and 
						c.data = '$Data_Atual' and 
						cu.id_usuario = $ok";
						
			$_result = mysql_query($_sql);
			$linha = mysql_fetch_object($_result);
			$ferias = $linha->f;	
				
			if($ferias == 1) {
				$_Corpo = "<b>$Nome</b> tentou acesso ao SAD em ferias no dia $Data_Atual $Hora_Atual";
				mail2("fernando.nomellini@datamace.com.br", "Acesso negado Ferias", $_Corpo, $headers);								
				loga_online_plus($ok, 'NEGADO FERIAS', LOG_OUTROS, 0 );
				header("Location: /a/AcessoNegado.php?IdMsg=2");			
			}
		}
	
	
?>