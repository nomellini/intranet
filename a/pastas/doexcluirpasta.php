<?
  require("../scripts/conn.php");
  $sql = "delete from pasta where id_pasta=$id_pasta";
  mysql_query($sql) or die($sql."<br>".mysql_error());
  header("Location: ../inicio.php");
?>