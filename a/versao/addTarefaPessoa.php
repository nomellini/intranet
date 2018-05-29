<?
  require("../scripts/conn.php");
  $sql = "insert into i_tarefapessoa (id_usuario, id_tarefa) values ($pessoa, $tarefa)";
  mysql_query($sql);
  header("Location: tarefas.php");
?>