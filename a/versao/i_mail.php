<?
  $sql = "SELECT * from i_mail where id_conjunto = $id_conjunto";
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
	 
?>
<form name="form1" method="post" action="doi_mail.php">
  <table width="90%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td> 
        <input type="checkbox" name="existe" value="checkbox" onClick = "mostra(t_versao)" <?=$existe?> >
        Existe correio para esse lote ? (selecione se tiver)</td>
    </tr>
    <tr> 
      <td><span id=t_versao style="DISPLAY: <?=$disp?>"> 
        <table width="90%" border="0" cellspacing="1" cellpadding="1" >
          <tr> 
            <td>Texto </td>
          </tr>
          <tr>
            <td>
              <textarea name="texto" cols="100" rows="10" class="unnamed1"><?=$linha->texto?>	</textarea>
            </td>
          </tr>
        </table>
        </span></td>
    </tr>
    <tr> 
      <td> 
        <input type="checkbox" name="ok" value="checkbox" <?=$ok?>>
        OK</td>
    </tr>
    <tr> 
      <td> 
        <input type="button" name="Button" value="Button" onclick="javascript:troca('\r\n', '<br>\n');	document.form1.submit();">
        <input type="hidden" name="id_conjunto" value="<?=$id_conjunto?>">
        <input type="hidden" name="id_usuario" value="<?=$ok?>">
      </td>
    </tr>
  </table>
</form>
<Script>
troca('<br>', '');

function Replace(Expression, Find, Replace){
var temp = Expression;
var a = 0;
for (var i = 0; i < Expression.length; i++) 
	{
    	a = temp.indexOf(Find);
		if (a == -1)
			break
		else
			temp = temp.substring(0, a) + Replace + temp.substring((a + Find.length));
	}
	return temp;
}

  function troca(value1, value2) {
    aux = Replace(document.form1.texto.value, value1, value2);
	document.form1.texto.value = aux;	
  }
</script>