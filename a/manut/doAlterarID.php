<? require("../scripts/conn.php"); ?>
<?
  $n = strtoupper($novo_id);
  $v = strtoupper($id_cliente);
  $sql = "update chamado set cliente_id='$n' where cliente_id='$v'";
  mysql_query($sql);
  header("Location: AlterarID.php?msg=Chamados de $v agora são de $n");
?>
