
<?
	$sql = "SELECT * from i_comunicacao where id_conjunto = $id_conjunto";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	if ($linha->ok) {
		$ok = "checked";
	}
	$fl_teste = $linha->fl_teste;
	$fl_oficial = $linha->fl_oficial;
	 
?>
<form name="form1" method="post" action="doi_comunicacao.php">
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
        <input <?php if (!(strcmp("$fl_teste",1))) {echo "checked=\"checked\"";} ?> name="fl_teste" type="checkbox" id="fl_teste" value="1" />
      Email de teste interno</label></td>
    </tr>
    <tr>
      <td><label>
        <input <?php if (!(strcmp("$fl_oficial",1))) {echo "checked=\"checked\"";} ?> name="fl_oficial" type="checkbox" id="fl_oficial" value="1" />
      Email oficial enviado com texto do assunto atualizado</label></td>
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
