
<?
  $sql = "SELECT * from i_datacenter where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
     if ($linha->ok) {
	   $ok = "checked";
	 }
	 $fl_email = $linha->fl_email;
	 $fl_versao = $linha->fl_versao;

?>
<form name="form1" method="post" action="doi_datacenter.php">
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
        <input <?php if (!(strcmp("$fl_email",1))) {echo "checked=\"checked\"";} ?> name="fl_email" type="checkbox" id="fl_email" value="1" />
      Disparado email do per�odo de atualiza��o no datacenter</label></td>
    </tr>
    <tr>
      <td><label>
        <input <?php if (!(strcmp("$fl_versao",1))) {echo "checked=\"checked\"";} ?> name="fl_versao" type="checkbox" id="fl_versao" value="1" />
      Atualizada vers�o no servidor de acesso via terminal</label></td>
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
