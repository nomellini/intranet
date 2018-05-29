<?
  $sql = "SELECT * from i_pacote where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
     $p = explode("-", $linha->previsao);
     $disp = "none";
     if ($linha->existe) {
	   $existe = "checked";
	   $dia = $p[2];
	   $mes = $p[1];
	   $ano = $p[0];
	   $disp = "";
	 } else {
       $mes = date("m");
	   $dia = date("d");
	   $ano = date("Y");
	 }
     if ($linha->ok) {
	   $ok = "checked";
	 }
	 $fl_manual = $linha->fl_manual;
	 $fl_boletim = $linha->fl_boletim;
	 $fl_conversor = $linha->fl_conversor;	 
	 
?>
<form name="form1" method="post" action="doi_pacote.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td> 
        <input type="checkbox" name="existe" value="checkbox" onClick = "mostra(t_versao)" <?=$existe?> >
        Existe pacote para esse lote ? (selecione se tiver)</td>
    </tr>
    <tr> 
      <td><span id=t_versao style="DISPLAY: <?=$disp?>"> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr>
            <td>Descri&ccedil;&atilde;o</td>
          </tr>
          <tr> 
            <td>
              <input type="text" name="descricao" size="100" class="unnamed1" value="<?=$linha->descricao?>">            </td>
          </tr>
          <tr> 
            <td>Caminho / nome</td>
          </tr>
          <tr> 
            <td> 
              <input type="text" name="caminho" size="40" class="unnamed1" value="<?=$linha->caminho?>">
              / 
              <input type="text" name="nome" size="30"  class="unnamed1" value="<?=$linha->nome?>">            </td>
          </tr>
          <tr> 
            <td>Previs&atilde;o (quando a vers&atilde;o fica pronta ?)</td>
          </tr>
          <tr> 
            <td> 
              <input type="text" name="dia" size="2" maxlength="2" value="<?=$dia?>" class="unnamed1">
              / 
              <input type="text" name="mes" size="2" maxlength="2" value="<?=$mes?>" class="unnamed1">
              / 
              <input type="text" name="ano" size="4" maxlength="4" value="<?=$ano?>" class="unnamed1">            </td>
          </tr>
        </table>
        </span></td>
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
      Conversor e demais programas estão no instalador</label></td>
    </tr>
    <tr> 
      <td> 
        <input type="checkbox" name="ok" value="checkbox" <?=$ok?>>
        OK (selecione OK se esse lote n&atilde;o tem pacote ou se o pacote j&aacute; 
        est&aacute; pronto)</td>
    </tr>
    <tr> 
      <td> 
        <input type="submit" name="Submit" value="Submit">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">      </td>
    </tr>
  </table>
</form>
