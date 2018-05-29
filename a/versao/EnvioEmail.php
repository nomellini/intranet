<?

/*function EnviarEmail($id_conjunto, $id_usuario, $tarefa, $proxima)
{
	  
    // Email Encerramento
	$fileEmail=fopen('email_ok.htm', "r");
	$textEmail = fread( $fileEmail, 10000);	
	
    $email = 'dtmrelease@datamace.com.br';
	$subject = "Release com tarefa concluida";
	$headers .= "SAD - Sistema de Atendimento Datamace";
	
	$sql = "select * from i_conjunto where id = $id_conjunto";  
	$result2 = mysql_query($sql);  
	$linha = mysql_fetch_object($result2);  
	
	$abertura = implode("/", array_reverse( split("-", $linha->data)));
	$prevista = implode("/", array_reverse( split("-", substr($linha->data_prev_liberacao, 0, 10))));

	
	$textEmail = str_replace("[abertura]", $abertura, $textEmail);
	$textEmail = str_replace("[sistema]", pegaSistema($linha->id_sistema), $textEmail);
    $textEmail = str_replace("[versao]", $linha->versao, $textEmail);	
	$textEmail = str_replace("[liberacao]", $prevista, $textEmail);	
	$textEmail = str_replace("[descricao]", $linha->descricao, $textEmail);	
	
    $nomeusuario = peganomeusuario($id_usuario);	
	
	$textEmail = str_replace("[QUEM_DEU_OK]", $nomeusuario, $textEmail);	
	$textEmail = str_replace("[NOME_DA_TAREFA]", $tarefa, $textEmail);	
	$textEmail = str_replace("[PROXIMA]", $proxima, $textEmail);	

	mail2($email, $subject, $textEmail, $headers); 	    			

}
*/


function EnviarEmail($id_conjunto, $id_usuario, $IdTarefaAtual)
{


    // Email Encerramento
	$fileEmail=fopen('email_ok.htm', "r");
	$textEmail = fread( $fileEmail, 10000);	



	$sql = "select nome from i_tarefas where id = $IdTarefaAtual";	
	$result = mysql_query($sql);  
	$linha = mysql_fetch_object($result);  
	$tarefa = $linha->nome;
//	$textEmail .= " - $sql <br>";
	
	$sql = "select nome, descricao, area, id from i_tarefas where (ordem > (select ordem from i_tarefas where id = $IdTarefaAtual)) and (ativo = 1) order by ordem limit 1";	
	$result = mysql_query($sql);  
	$linha = mysql_fetch_object($result);  
	$proxima = "$linha->nome ($linha->descricao) pela area: $linha->area";
	$Id_Next = $linha->id;	  	  

  	$Dt_UltimoEmail = date("Y-m-d H:i:s");
	$Sql = "update i_conjunto set Dt_UltimoEmail = '$Dt_UltimoEmail', Id_Next = $Id_Next where id = $id_conjunto";
	$result = mysql_query($Sql) or die(mysql_error() . " - " . $Sql);  


	
    $email = 'dtmrelease@datamace.com.br';
	
	//$email = 'fernando@datamace.com.br';
	
	$subject = "Release com tarefa concluida";
	$headers .= "SAD - Sistema de Atendimento Datamace";
	
	$sql = "select * from i_conjunto where id = $id_conjunto";  
	$result2 = mysql_query($sql);  
	$linha = mysql_fetch_object($result2);  
	
	$abertura = implode("/", array_reverse( split("-", $linha->data)));
	$prevista = implode("/", array_reverse( split("-", substr($linha->data_prev_liberacao, 0, 10))));

	
	$textEmail = str_replace("[abertura]", $abertura, $textEmail);
	$textEmail = str_replace("[sistema]", pegaSistema($linha->id_sistema), $textEmail);
    $textEmail = str_replace("[versao]", $linha->versao, $textEmail);	
	$textEmail = str_replace("[liberacao]", $prevista, $textEmail);	
	$textEmail = str_replace("[descricao]", $linha->descricao, $textEmail);	
	
    $nomeusuario = peganomeusuario($id_usuario);	
	
	$textEmail = str_replace("[QUEM_DEU_OK]", $nomeusuario, $textEmail);	
	$textEmail = str_replace("[NOME_DA_TAREFA]", $tarefa, $textEmail);	
	$textEmail = str_replace("[PROXIMA]", $proxima, $textEmail);	

	mail2($email, $subject, $textEmail, $headers); 	    			

}

?>