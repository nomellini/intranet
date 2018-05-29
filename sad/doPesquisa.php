<?php require_once('../Connections/sad.php'); ?>
<?php require_once('../a/scripts/classes.php'); ?>
<?php require_once('../a/scripts/conn.php'); ?>
<?php require_once('../a/scripts/chamado_pesquisa.php'); ?>
<?	
  GravarPesquisa($id, $Solucionado, $nota, $Texto);
  header("Location:r.php?id=$id");		
?>