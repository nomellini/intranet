<?
  require("../scripts/conn.php");
?>
<form id="form1" name="form1" method="post" action="doexcluirpasta.php">
  <p>Excluir a pasta ? </p>
  <label>
  <input type="submit" name="Submit" value="Sim!" />
  </label>
  <input name="id_pasta" type="hidden" id="id_pasta" value="<?=$id_pasta?>" />
</form>
