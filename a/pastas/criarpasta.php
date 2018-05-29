<?
  require("../scripts/conn.php");
?>
<form id="form1" name="form1" method="post" action="docriarpasta.php">
  Pasta 
  <input name="nomepasta" type="text" id="nomepasta" />
  <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$id_usuario?>" />
  <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$id_chamado?>" />
  <br />
  <label>
  <input type="submit" name="Submit" value="Criar pasta" />
  </label>
</form>
