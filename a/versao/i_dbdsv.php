<?
  $sql = "SELECT * from i_dbdsv where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);  
  $fl_ok = $linha->ok;
?>
<form name="form1" method="post" action="doi_dbdsv.php">
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
      <td> 
        <input <?php if (!(strcmp("$fl_ok",1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="ok" value="1"> OK </td>
    </tr>
    <tr> 
      <td> 
        <input type="submit" name="Submit" value="Submit">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">      </td>
    </tr>
  </table>
</form>
