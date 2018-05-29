
<?
  $sql = "SELECT * from i_pontocorte where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  
     $p = explode("-", $linha->datacorte);  
     if ($linha->existe) {
	   $existe = "checked";
	   $dia = $p[2];
	   $mes = $p[1];
	   $ano = $p[0];
	   $hora = $linha->horacorte;
	   $disp = "";
	 } else {
       $mes = date("m");
	   $dia = date("d");
	   $ano = date("Y");
	   $hora = date("h:m:t");
	 }	 
  
  $fl_ok = $linha->ok;
  $fl_teste = $linha->fl_teste; 
?>
<form name="form1" method="post" action="doi_pontocorte.php">
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
          <input name="horadownload" type="text" id="horadownload" value="<?=$hora?>" />
        do download </label></td>
    </tr>
    <tr> 
      <td> 
        <input <?php if (!(strcmp("$fl_ok",1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="ok" value="1" <?=$ok?>>
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
