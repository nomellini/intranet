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



  $sql = "SELECT * from i_boletim where id_conjunto = $id_conjunto";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);

     $disp = "none";
     if ($linha->existe) {
	   $existe = "checked";
	   $disp = "";
	 } 
     if ($linha->ok) {
	   $ok = "checked";
	 }
     if ($linha->enviar) {
	   $enviar = "checked";
	 }
	 
	 
?>
<form name="form1" method="post" action="doi_boletim.php">
  <b>Aten&ccedil;&atilde;o : 
  <?=$msg?>
  .</b><br>
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td> 
        <input type="checkbox" name="existe" value="checkbox" onClick = "mostra(t_versao)" <?=$existe?> >
        Existe boletim para esse lote ? (selecione se tiver)</td>
    </tr>
    <tr> 
      <td><span id=t_versao style="DISPLAY: <?=$disp?>"> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr> 
            <td>Descri&ccedil;&atilde;o</td>
          </tr>
          <tr> 
            <td> 
              <input type="text" name="descricao" size="100" class="unnamed1" value="<?=$linha->descricao?>">
            </td>
          </tr>
          <tr> 
            <td>Caminho / nome</td>
          </tr>
          <tr> 
            <td> 
              <input type="text" name="caminho" size="40" class="unnamed1" value="<?=$linha->caminho?>">
              \ 
              <input type="text" name="nome" size="50"  class="unnamed1" value="<?=$linha->nome?>">
            </td>
          </tr>
        </table>
        </span></td>
    </tr>
    <? if ($abre) {?>
<!--    <td> 
      <input type="checkbox" name="enviar" value="1" <?=$enviar?>>
        Selecione esta op&ccedil;&atilde;o quando estiver ciente das tarefas relativas 
        ao correio.</td>
    </tr>
-->    <?}?>
    <tr> 
      <td> 
        <input type="checkbox" name="ok" value="1" <?=$ok?>>
        OK</td>
    </tr>
    <tr> 
      <td> 
        <input type="button" name="Button" value="Enviar" class="unnamed1" onclick="testa()">
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
		document.form1.submit();
//	  if (!document.form1.enviar.checked) {
//	    window.alert('Você NÃO confirmou ainda a tarefa de correio');
//	  } else {
//	    document.form1.submit();
//	  }
	} else {
	  document.form1.submit();
	}
   } else {
     document.form1.submit();
   }	
  }
</SCRIPT>
