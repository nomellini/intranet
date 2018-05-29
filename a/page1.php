<?
  require("scripts/conn.php");
  require("scripts/classes.php");	

  $html = 'Nome do usuario : <b>' . pegaNomeUsuario($id) . '</b>';

?>
div = document.getElementById('contentdiv');
div.innerHTML = '<?php echo $html; ?>';
