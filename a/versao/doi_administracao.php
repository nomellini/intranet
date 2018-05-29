<?
  require("../scripts/conn.php");		
  $data = "$ano-$mes-$dia";
  $txtSQL = "UPDATE i_administracao SET existe=";
  if ($texto or ($diapostagem!=00)) {
    $txtSQL .= "1, ";
  } else {
    $txtSQL .= "0, ";
  }
  $txtSQL .= " texto = '$texto', ";
  $txtSQL .= " id_usuario = $id_usuario, ";	  
  
  $txtSQL .= " datapostagem = '$anopostagem-$mespostagem-$diapostagem', ";
  
  if ($enviar) {
    $txtSQL .= "enviar = 1, ";   
  } else {
    $txtSQL .= "enviar = 0, "; 
  }  
  
  if ($ok) {
    $txtSQL .= "ok = 1, ";
	$data = date("Y-m-d");
	$hora = date("H:i:s");
	$txtSQL .=" data='$data', hora='$hora' ";
  } else {
    $txtSQL .= "ok = 0, ";
	$txtSQL .=" data='0000-00-00', hora='00:00:00'  ";
	
  }
  $txtSQL .= "WHERE id_conjunto = $id_conjunto;";

 
  mysql_query($txtSQL);
  
  if (!$ok ) { $ok = '0'; } else { $ok = '1';}
  $txtSQL = "UPDATE i_conjunto set ok = $ok WHERE id = $id_conjunto";
  mysql_query($txtSQL) or die ($txtSQL);
  
  
  if ($ok) {
    // Email Encerramento
	$fileEmail=fopen('emailencerrarelease.htm', "r");
	$textEmail = fread( $fileEmail, 10000);	
	
    $email = 'dtmrelease@datamace.com.br';	
	//$email = 'fernando@datamace.com.br';
	$subject = "Release encerrado";
	$headers .= "SAD - Sistema de Atendimento Datamace";
	
	$sql = "select * from i_conjunto where id = $id_conjunto";  
	$result2 = mysql_query($sql);  
	$linha = mysql_fetch_object($result2);  
	
	$textEmail = str_replace("[abertura]", $linha->data, $textEmail);
	$textEmail = str_replace("[sistema]", pegaSistema($linha->id_sistema), $textEmail);
    $textEmail = str_replace("[versao]", $linha->versao, $textEmail);	
	$textEmail = str_replace("[liberacao]", $data_prev_liberacao, $textEmail);	
	$textEmail = str_replace("[descricao]", $linha->descricao, $textEmail);	
	$textEmail = str_replace("[datafim]", date("d/m/Y"), $textEmail);		
	
	mail2($email, $subject, $textEmail, $headers); 	    			
  }
  
  header("Location: index.php");  
?>
