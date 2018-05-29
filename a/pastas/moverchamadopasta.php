<?
  require("../scripts/conn.php");
  $sql = "delete from chamado_pasta where id_chamado = $id_chamado and id_pasta in (select id_pasta from pasta where id_usuario=$id_usuario)";
  $result = mysql_query($sql) or die($sql);
  $sql = "insert into chamado_pasta values ($id_chamado, $id_pasta);";
  mysql_query($sql);
  header("Location: ../inicio.php");
?>