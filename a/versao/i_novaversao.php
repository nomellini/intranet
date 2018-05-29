
<?
  $sql = "SELECT * from i_novaversao where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
     if ($linha->ok) {
	   $ok = "checked";
	 }
	 $Impacto="$linha->fl_impacto";

?>
<form name="form1" method="post" action="doi_novaversao.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td>
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr>
            <td>Gera Impacto ? </td>
          </tr>
          <tr>
            <td><label>
              <input   <?php if (!(strcmp($Impacto,"1"))) {echo "checked=\"checked\"";} ?> name="fl_impacto" type="radio" value="1" />
            Sim 
            <input   <?php if (!(strcmp($Impacto,"0"))) {echo "checked=\"checked\"";} ?> name="fl_impacto" type="radio" value="0"  />
            Não</label></td>
          </tr>
          <tr>
            <td>Se sim, Qual imacto ? </td>
          </tr>
          <tr>
            <td><label>
              <textarea name="impacto" cols="40" id="impacto"><?=$linha->impacto?></textarea>
            </label></td>
          </tr>
          <tr>
            <td>Observa&ccedil;&atilde;o</td>
          </tr>
          <tr>
            <td>
              <textarea name="texto" cols="40" rows="5"><?=$linha->texto?></textarea>            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <input type="checkbox" name="ok" value="checkbox" <?=$ok?>>
        OK</td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="Submit" value="Submit">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">
      </td>
    </tr>
  </table>
</form>
