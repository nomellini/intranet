<?
  require("../scripts/conn.php");
  $sql = "insert into pasta (id_usuario, descricao) values ($id_usuario,  '$nomepasta');";
  mysql_query($sql) or die($sql."<br>".mysql_error());
  if ($id_chamado<>"") {
    $sql = "select max(id_pasta) as id_pasta from pasta where id_usuario = $id_usuario";
	$result = mysql_query($sql) or die($sql."<br>".mysql_error());
	$linha = mysql_fetch_object($result);
    $sql = "insert into chamado_pasta values ($id_chamado, $linha->id_pasta);";    
	mysql_query($sql) or die($sql."<br>".mysql_error());
  }
  header("Location: ../inicio.php");
?>