<?	
	$hoje = date("Y-m-d");	
	if(!$dataf) {
      $dataf = $hoje;
	}		
    $sql  = "select  ";
	$sql .= "  todo.id, todo.checked, todo.prioridade, todo.data, todo.confidencial, ";
    $sql .= "  todo.descricao, todocategoria.descricao as categoria, ";
    $sql .= "  data <= now() as atrasado ";
    $sql .= "from ";
    $sql .= "  todo, todocategoria ";
    $sql .= "where  ";
    $sql .= " todo.id_categoria = todocategoria.id ";	
	if ($id_categoria) {
	  $sql .= "  and id_categoria =  " . $id_categoria;
	}	
	$sql .= "  AND ( ";
	$sql .= "      ( todo.confidencial = 1 and todo.id_usuario = $ok ) ";
	$sql .= " ) "; 	
	$sql .= " ORDER BY ";
	$sql .= "  prioridade, data desc";
    $result = mysql_query($sql) or die($sql);	
?>
<form name="formmemo" method="post" action="">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bordaTexto">
    <tr>
      <td height="15" align="right">ToDo</td>
      <td align="right"><a href="javascript:novo();">Novo</a></td>
    </tr>
    <tr> 
      <td width="5%" height="15" align="right" bgcolor="#999999"><strong><font color="#FFFFFF" size="1">Pri</font></strong></td>
      <td width="95%" bgcolor="#999999"><strong><font color="#FFFFFF" size="1">&nbsp;Descri&ccedil;&atilde;o</font></strong></td>
    </tr>
    <?
	while ($linha=mysql_fetch_object($result)) {
	 $che = "";
	 if ($linha->checked==1) {
	   $che = "checked";
	 }
	 $data1 = explode("-", $linha->data);	 	 
	 $data = "$data1[2]/$data1[1]/$data1[0]";
	 $atrasado = 0;
	 $cor = "";
	 if ($data=="00/00/0000") {
	   $data = "sem data";
	 } else {
	   $atrasado = $linha->atrasado;
	   if ($atrasado) {
	     $cor = "bgcolor=\"#FFFFCC\"";
		 $data = "<b>$data !</b>";
	   }	   
	 }
	 
?>
    <tr <?=$cor?>> 
      <td align="right"> <font size="1"><strong> 
        <?=$linha->prioridade?>
        </strong> </font></td>
      <td> <font size="1"><a href="javascript:dep(<?=$linha->id?>);">&nbsp; 
        <?=$linha->descricao?>
        </a> </font></td>
    </tr>
    <?
 } 
?>
  </table>
  <input name="acao" type="hidden" id="acao">
  <input name="id" type="hidden" id="id">
</form>
<script>

  function novo() {
    window.open("../a/todo/novotodo.php?novo=1&pagina=agenda", "","scrollbars=yes, height=300, width=650");
  }

  function dep(value) {
    window.open("../a/todo/novotodo.php?pagina=agenda&id="+value, "","scrollbars=yes, height=300, width=650");
  }
</script>