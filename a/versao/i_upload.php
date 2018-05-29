
<?
  $sql = "SELECT * from i_upload where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
     $p = explode("-", $linha->dataupload);  
     if ($linha->existe) {
	   $existe = "checked";
	   $dia = $p[2];
	   $mes = $p[1];
	   $ano = $p[0];
	   $hora = $linha->horaupload;
	   $disp = "";
	 } else {
       $mes = date("m");
	   $dia = date("d");
	   $ano = date("Y");
	   $hora = date("h:m:t");
	 }	 
     if ($linha->ok) {
	   $ok = "checked";
	 }
	 $fl_versao = $linha->fl_versao;
	 $fl_descricao = $linha->fl_descricao;		 
	 
	 
?>
<form name="form1" method="post" action="doi_upload.php">
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
      <td>Data 
        <input type="text" name="dia" size="2" maxlength="2" value="<?=$dia?>" class="unnamed1" />
        /
        <input type="text" name="mes" size="2" maxlength="2" value="<?=$mes?>" class="unnamed1" />
        /
        <input type="text" name="ano" size="4" maxlength="4" value="<?=$ano?>" class="unnamed1" /> 
         Hora 
         <label>
         <input name="horaupload" type="text" id="horaupload" value="<?=$hora?>" />
         </label></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td bgcolor="#FFFFFF"><label>
        <input <?php if (!(strcmp("$fl_versao",1))) {echo "checked=\"checked\"";} ?> name="fl_versao" type="checkbox" id="fl_versao" value="1" />
Atualizada vers&atilde;o no site </label></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td bgcolor="#FFFFFF"><label>
        <input <?php if (!(strcmp("$fl_descricao",1))) {echo "checked=\"checked\"";} ?> name="fl_descricao" type="checkbox" id="fl_descricao" value="1" />
Atualizado o campo da descri&ccedil;&atilde;o de vers&atilde;o no site </label></td>
    </tr>
    <tr> 
      <td> 
        <input type="checkbox" name="ok" value="checkbox" <?=$ok?>>
        OK </td>
    </tr>
    <tr> 
      <td> 
        <input type="submit" name="Submit" value="Submit">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">      </td>
    </tr>
  </table>
</form>
