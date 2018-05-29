<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	loga_online($ok, $REMOTE_ADDR, 'Tarefas');	

	$PodeEditarDataLiberacao = ($ok == 12) || ($ok == 8) || ($ok == 7) || ($ok == 1) ;

	if (!$PodeEditarDataLiberacao) {
		header("Location: index.php"); 
	}
	
	if ($action == "edit")
	{
		$sql = "update i_conjunto set data_prev_liberacao='$ano-$mes-$dia' where id = '$id'";
		mysql_query($sql);
		
		$Texto = "Alteração de data de liberação Release $id - $Sistema $versao <br>Alterada de $DataAnterior para $dia/$mes/$ano";
//		die ($Texto);
		
	
		$email = 'dtmrelease@datamace.com.br';
		//$email = 'fernando.nomellini@datamace.com.br';
		$subject = "Release $Sistema alterado";
		$headers .= "SAD - Sistema de Atendimento Datamace";
	
		mail2($email, $subject, $Texto, $headers); 	    			
		
			
		
		header("Location: index.php");		
	}
	
	$sql = "select data_prev_liberacao,versao, s.sistema from i_conjunto inner join sistema s on s.id_sistema = i_conjunto.id_sistema where id = $id";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	
	$data = substr(($linha->data_prev_liberacao),0,10);	
	$data = implode ("/",  array_reverse( explode("-", $data) ) );
	$sistema = $linha->sistema;
	$versao = $linha->versao;
	
	$data_array = explode("/", $data);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<title>Alterar data de liberação de release</title>
</head>
<body>

	Alterar data prevista para libera&ccedil;&atilde;o do release do sistema <b><?=$sistema?></b><br />
    
    <form action="" method="post">

		<p>Data prevista atual: <b>
		<?=$data?>
		</b><br /><br />

		Alterar para : <input name="dia" type="text" class="borda_fina" value="<?=$data_array[0]?>" size="2" maxlength="2" /> / <input name="mes" type="text" class="borda_fina" id="mes" value="<?=$data_array[1]?>" size="2" maxlength="2" /> / <input name="ano" type="text" class="borda_fina" value="<?=$data_array[2]?>" size="4" maxlength="4" />
        
    	<input name="id" type="hidden" value="<?=$id?>" />
		<input name="action" type="hidden" value="edit" />
		<input name="DataAnterior" type="hidden" value="<?=$data?>" />
		<input name="Sistema" type="hidden" value="<?="$sistema $versao"?>" />
                
        </p>
		<p>
		  <input name="button" type="submit" class="borda_fina" id="button" value="Gravar" />
		</p>
    </form>


</body>
</html>