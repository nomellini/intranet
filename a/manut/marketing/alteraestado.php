<?
  mysql_connect(localhost, sad, data1371) or die ("nao conectou");
  mysql_select_db(sad) or die ("nao selecionou");
  $sql = "update clisis set ativo = not ativo  where cliente='$id_cliente' and sistema = $id_sistema;";
  mysql_query($sql) or die ("nao deu certo sql : $sql");
  Header("Location: clientes02.php?id_cliente=$id_cliente");
?>