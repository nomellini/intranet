<?
require("../a/scripts/conn.php");		
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}

$resposta = "";

//$para1 = "fernando.nomellini@datamace.com.br";
//$para2 = "fernando.nomellini@datamace.com.br";

if ($codigo) {
  //$id = ($codigo - 1234)/100;  
  //$sql = "select email from usuario where id_usuario = $id";
  $sql = "select para, mensagem, id_de from tmp_teste where id = $codigo";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  $mensagem = $linha->mensagem;
  $id = $linha->id_de;

	if ($id <= 0) {
	  $id=12;
	}

  
  $sql = "select email from usuario where id_usuario = $id";  
  $result2 = mysql_query($sql);  
  $linha = mysql_fetch_object($result2);  
  $resposta = $linha->email;
  $para1 = $resposta;
  $para2 = $resposta;
  
}

$nome = "Anonimo";
$id_usuario = $ok;
if (!isset($id_usuario)) {
  $id_usuario = 0;
} else {
	if ($quem == 'S') {
 		$sql = "select nome, email from usuario where id_usuario = $ok";  
	  	$result2 = mysql_query($sql) or die (mysql_error());  
  		$linha = mysql_fetch_object($result2) ;  
	  	$nome = $linha->nome;
		$email = $linha->email;
	}
}

$msg = "insert into tmp_teste (mensagem, id_de, para) values ('$campo1', $id_usuario, '$para1')";
mysql_query($msg) or die(mysql_error());

$sql = "select max(id) as id from tmp_teste where id_de = $id_usuario";
$result = mysql_query($sql) or die (mysql_error());
$linha = mysql_fetch_object($result) or die(mysql_error());
$id_msg = $linha->id;



$codigo1 = $id_msg;//($id_usuario * 100) + 1234;


if(!$assunto) { $assunto="Sem assunto"; }

if ($resposta != "") {
	$nome = "Gestão de Talentos";
}

$de=$nome;
$body="De: $de<br>
$campo1<br>

<a href=http://10.98.0.5/caixa/index.php?codigo=$codigo1>Para Responder este email, Clique aqui</a>";


$body=nl2br($body);


mail2($para1, $assunto, $body, $de);// or die ("1... $para1 - $assunto - $body - $de");
if ($resposta == "") {
	mail2($para2, $assunto, $body, $de);// or die ("2... $para2 - $assunto - $body - $de");
}
//mail2("fernando.nomellini@datamace.com.br", $assunto . " - $id - $codigo1", $body, $de);
Header("Location: ../caixa/index.php?msg=OK");
?>
