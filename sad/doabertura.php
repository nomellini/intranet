<?
  //require("../a/scripts/conn.php");
 // session_start();
					require("scripts/conn.php");
					session_start(); 
					
					
					$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  

if ($v_id_cliente=="") {
	header("Location: doindex.php");
}

//echo $nome  . $email . "<br>" . $produto . "<br>" . $modulo . "<br>" . $versao . "<br>" . $assunto . "<br>" . $classificacao . "<br>" . $descricao;

									$nome=$_POST['textfield'];
									$email=$_POST['textfield2']; 
									$produto=$_POST['select2']; 
									$modulo=$_POST['select']; 	
									$versao=$_POST['textfield222'];
									$assunto=$_POST['textarea']; 
									$classificacao=$_POST['select4']; 
									$select=$_POST['select'];
									$descricao=$_POST['textarea2'];
                                    $dataa=date("Y/m/d"); 
								    $horaa = date("H:i:s");
									$destinatario = 0;   

$classificacao_id = $classificacao;
$sql_c = "SELECT descricao c1 FROM classificacao where id = $classificacao";
$query_c = mysql_query($sql_c) or die ($sql_c);
$result_c = mysql_fetch_object($query_c);
$classificacao =  $result_c->c1;


$email = mysql_real_escape_string ($email);	
$assunto = mysql_real_escape_string ($assunto);
$descricao = nl2br($descricao);
$classificacao = mysql_real_escape_string ($classificacao);
$versao = mysql_real_escape_string ($versao);
$produto = mysql_real_escape_string ($produto);
$versao = mysql_real_escape_string ($versao);
$nome = mysql_real_escape_string ($nome);
$assunto = mysql_real_escape_string ($assunto);
$modulo = mysql_real_escape_string ($modulo);



//"\nDescrição: $descricao"

$sql = "INSERT INTO chamado (consultor_id, email, status, cliente_id, descricao, sistema_id, dataa, horaa, ";
$sql .= "destinatario_id, externo, nomecliente, assunto, classificacao_id, categoria_id) VALUES ";
$sql .= "(56, '$email', 2, '$v_id_cliente', 
          '$assunto\n\nClassificação:$classificacao\n\nversão:$versao', 
		   $produto, '$dataa', '$horaa', $destinatario, 1, '$nome', '$assunto', $classificacao_id, $modulo);";


	mysql_query($sql) or die ($sql . " - " . mysql_error());
		
	
	$sql7 = mysql_query("select max(id_chamado) as novo from chamado where externo = 1 and cliente_id = '$v_id_cliente'");
	$reg=mysql_fetch_assoc($sql7);
	$chamado=$reg['novo'];

	require("../a/scripts/classes.php");
	insere_contato($chamado, 56, $descricao);
	
	$ano=substr("$dataa",0, 4);
	$mes=substr("$dataa",5, 2);
	$dia=substr("$dataa",8, 2); 
	$datas=$dia . "-". $mes . "-". $ano;
	
$to = $email;
$from = "suporte@datamace.com.br";
$subject = "Suporte Datamace";
$html = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Caro, '. $nome.'</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial 
size=2></FONT></SPAN>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>O chamado que você 
encaminhou ao suporte será&nbsp;analisado e em breve você terá um retorno do 
status do atendimento.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>A Partir desse 
momento ele é conhecido pelo código abaixo.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Caso você queira 
interagir no chamado ou&nbsp;saber&nbsp;sobre o andamento, acesse novamente o 
Portal e selecione a pasta Acompanhar Chamados.</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial 
size=2></FONT></SPAN>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>
Código : '.$chamado.'</FONT></SPAN></DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>
Abertura :  '. $datas .' -'. $horaa.'</FONT></SPAN></DIV><SPAN class=592124918-13032009>
<DIV><FONT face=Arial size=2></FONT>&nbsp;</DIV>
<DIV><SPAN class=592124918-13032009><FONT face=Arial size=2>Suporte ao 
Cliente</FONT></SPAN></SPAN></DIV>



</body>
</html>';
$remetente = "suporte@datamace.com.br";
$headers = "From: ".$remetente."\nContent-type: text/html"; # o ‘text/html’ é o tipo mime da mensagem 

if (mail($to, $subject, $html, $headers)) {

echo '';
} else {
echo "Ocorreu um erro durante o envio do email.";
}

//	die ($sql); 
?>

<script>
alert ("E-mail enviado com sucesso");
window.location='acompanhar_chamado.php?pagina=1&pag=1';
</script>
<?

  function insere_contato($id_chamado, $id_usuario, $texto)
  {
    
//  		$IdUsuarioOuvidoria = 279;
  		$IdUsuarioOuvidoria = $id_usuario;
		$datae = date("Y-m-d");
		$horae = date("H:i:s");					
		$objChamado = new chamado();
		$objContato = new contato();		
		$objChamado->lerChamado($id_chamado);	
		$id_destinatario = $objChamado->destinatario_id;			
		$id_contato_cliente = $objContato->novocontato($id_chamado, $IdUsuarioOuvidoria, $id_usuario, $datae, $horae);
		$objContato->lerContato($id_contato_cliente);		
		$objContato->origem_id = 15;
		$objContato->datae = $datae;
		$objContato->horae = $horae;				
    	$objContato->Ic_Atencao = 0;		
		$objContato->historico = $texto;	
		$objContato->publicar = 1;
		$objContato->gravaContato();			  

  }

?>