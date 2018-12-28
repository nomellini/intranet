<?
require("../a/cabeca.php");		


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
  $para = $linha->email;
  
  
}



if (!isset($id_usuario)) {
  $id_usuario = 0;
}
$msg = "insert into tmp_teste (mensagem, id_de, para) values ('$campo1', $id_usuario, '$para')";
mysql_query($msg) or die($msg);

$sql = "select max(id) as id from tmp_teste where id_de = $id_usuario";
$result = mysql_query($sql) or die ($sql);
$linha = mysql_fetch_object($result) or die($sql);
$id_msg = $linha->id;



$codigo1 = $id_msg;//($id_usuario * 100) + 1234;


if(!$assunto) { $assunto="Sem assunto"; }

if (!$de) { $de="Anonimo";}
$body="<br>
$campo1<br>
-------------------<br>
<i>$mensagem</i><br>
-------------------------------------------------------------<br>
Esta mensagem foi enviada pela Intranet DATAMACE, no link abaixo:<br>
<a href=http://192.168.0.14/corporativo/qt/equipesincera/index.php?codigo=$codigo1>Para Responder este email, Clique aqui</a>
<br>
<a href=http://192.168.0.14/corporativo/qt/equipesincera/index.php>Para enviar um email, clique aqui.</a>
<br>
De: $de<br>
Para: $para
";
mail2($para, $assunto, $body, $de);
//mail2("fernando.nomellini@datamace.com.br", $assunto . " - $id - $codigo1", $body, $de);
Header("Location: ../corporativo/qt/equipesincera/index.php?msg=OK");
?>
