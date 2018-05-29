<?
  $sql = "SELECT * from i_teste where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
     if ($linha->ok) {
	   $ok = "checked";
	 }
	 $fl_manual = $linha->fl_manual;
	 $fl_boletim = $linha->fl_boletim;
	 $fl_conversor = $linha->fl_conversor;	 
	 $fl_database =  $linha->fl_database;	 
?>


<form name="form1" method="post" action="doi_teste.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr> 
            <td>Observa&ccedil;&atilde;o</td>
          </tr>
          <tr> 
            <td> 
              <textarea name="texto" cols="40" rows="5" class="unnamed1"><?=$linha->texto?></textarea>            </td>
          </tr>
        </table>      </td>
    </tr>
    <tr>
      <td><label>
        <input <?php if (!(strcmp("$fl_boletim",1))) {echo "checked=\"checked\"";} ?> name="fl_boletim" type="checkbox" id="fl_boletim" value="1" />
        Boletim atualizado no instalador</label></td>
    </tr>
    <tr>
      <td><label>
        <input <?php if (!(strcmp("$fl_manual",1))) {echo "checked=\"checked\"";} ?> name="fl_manual" type="checkbox" id="fl_manual" value="1" />
        Manual atualizado no instalador</label></td>
    </tr>
    <tr>
      <td><label>
        <input <?php if (!(strcmp("$fl_conversor",1))) {echo "checked=\"checked\"";} ?> name="fl_conversor" type="checkbox" id="fl_conversor" value="1" />
        Conversor e demais programas est&atilde;o no instalador</label></td>
    </tr>
    <tr>
      <td><input <?php if (!(strcmp("$fl_database",1))) {echo "checked=\"checked\"";} ?> name="fl_database" type="checkbox" id="fl_database" value="1" />
        Banco de dados</td>
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
        <input type="hidden" name="id_usuario" value="<?=$ok?>">      </td>
    </tr>
  </table>
</form>
