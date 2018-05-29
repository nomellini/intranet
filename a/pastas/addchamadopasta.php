<?
  require("../scripts/conn.php");
  $sql = "select count(*) as quantidade from chamado_pasta where id_pasta = $id_pasta and id_chamado = $id_chamado";
  $result = mysql_query($sql) or die($sql);
  $linha = mysql_fetch_object($result);  
  if ($linha->quantidade==0) {
    $sql = "insert into chamado_pasta values ($id_chamado, $id_pasta);";
	mysql_query($sql);
  }
  header("Location: ../inicio.php");
?>