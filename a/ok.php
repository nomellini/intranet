<?php
  require("scripts/conn.php");
  require("scripts/classes.php");	
  $sql = "delete from saduploads where id = $id" ;
  mysql_query($sql);
  header("Location: historicochamado.php?id_chamado=$id_chamado");	  
  //echo funcoes_ReplicarChamado(432260, 12);
?>