<?
  $sql = "SELECT enviar from i_versao where id_conjunto = $id_conjunto and ok";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  $conta = mysql_affected_rows();
  $abre = 0;
  if ($conta) {
    if ($linha->enviar) {
	  $msg = "Enviar para todos os clientes";
	  $abre = 1;
	} else {
	  $msg = "Somente atualização no site ";
	}
	
  } else {
    $msg = "Ainda não definido pelo desenvolvimento";
  }


  $sql = "SELECT * from i_administracao where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  $datap = explode("-", $linha->datapostagem);
  
     if ($linha->ok) {
	   $ok = "checked";
	 }
     if ($linha->enviar) {
	   $enviar = "checked";
	 }
	 
	 
?><br><br>
<b>Aten&ccedil;&atilde;o : 
<?=$msg?>
. </b> 
<form name="form1" method="post" action="doi_administracao.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr> 
            <td>Observa&ccedil;&atilde;o</td>
          </tr>
          <tr> 
            <td> 
              <textarea name="texto" cols="50" rows="5" class="unnamed1"><?=$linha->texto?></textarea>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <? if ($abre) {?>
      <td> 
        <input type="checkbox" name="enviar" value="1" <?=$enviar?>>
        Selecione esta op&ccedil;&atilde;o quando estiver ciente das tarefas relativas 
        ao correio.</td>
    </tr>
    <?}?>
    <tr> 
      <td> 
        <input type="checkbox" name="ok" value="1" <?=$ok?>>
        OK( <font color="#FF0000">ATEN&Ccedil;&Atilde;O </font>Quando der o OK. 
        o conjunto todo ser&aacute; dado como OK ! )</td>
    </tr>
    
    <tr> 
      <td> 
        <input type="button" name="Button" value="Enviar" onClick = "testa()";>
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">
      </td>
    </tr>
  </table>
</form>
<SCRIPT>
  function testa() {
  
   if( <?=$abre?> ) {
    if (document.form1.ok.checked) {
	  if (!document.form1.enviar.checked) {
	    window.alert('Você NÃO confirmou ainda a tarefa de correio');
	  } else {
	    document.form1.submit();
	  }
	} else {
	  document.form1.submit();
	}
   } else {
     document.form1.submit();
   }	
  }
</SCRIPT>