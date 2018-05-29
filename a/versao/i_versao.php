<?
  $sql = "SELECT * from i_versao where id_conjunto = $id_conjunto";
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
     if ($linha->enviar) {
	   $enviar = "checked";
	 }
	 $fl_producao = $linha->fl_producao;
	 $fl_licenca = $linha->fl_licenca;		 
?>
<form name="form1" method="post" action="doi_versao.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
    <tr> 
      <td> 
        <input type="checkbox" name="existe" value="checkbox" onClick = "mostra(t_versao)" <?=$existe?> >
        Existe vers&atilde;o para esse lote ? (selecione se tiver)</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"><span id=t_versao style="DISPLAY: <?=$disp?>"> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr> 
            <td>Causa (Digite aqui tudo o que mudou da &uacute;ltima vers&atilde;o 
              pra essa)</td>
          </tr>
          <tr> 
            <td> 
              <textarea name="causa" cols="60" rows="6" class="unnamed1"><?=$linha->causa?></textarea>            </td>
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
      <td bgcolor="#FFFFFF"> 
        <input type="checkbox" name="enviar" value="1" <?=$enviar?>>
        Enviar para todos os clientes ? (deixe em branco se for somente atualizar 
        no site)<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>(SELECIONE SE A VERS&Atilde;O DEVER&Aacute; 
        SER&Aacute; ENVIADA PELO CORREIO)</b></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><label>
        <input <?php if (!(strcmp("$fl_producao",1))) {echo "checked=\"checked\"";} ?> name="fl_producao" type="checkbox" id="fl_producao" value="1" />
      Programas liberados na produção</label></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><label>
        <input <?php if (!(strcmp("$fl_licenca",1))) {echo "checked=\"checked\"";} ?> name="fl_licenca" type="checkbox" id="fl_licenca" value="1" />
      Atualizado o instalador das novas licenças</label></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <input type="checkbox" name="ok" value="checkbox" <?=$ok?>>
        OK (selecione OK se esse lote n&atilde;o tem vers&atilde;o ou se a vers&atilde;o 
        j&aacute; est&aacute; pronta) </td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <input type="submit" name="Submit" value="Gravar">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">      </td>
    </tr>
  </table>
</form>
