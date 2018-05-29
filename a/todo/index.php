<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

 
	if ($acao == "deletar") {
	  $select = "delete from todo where id = " . $id;
	  mysql_query($select);
	}
	
			
	if ($acao == "alterachecked") {
	  $select = "update todo set checked = not checked where id = " . $id;
	  mysql_query($select);
	}
	
	$hoje = date("Y-m-d");	
	if(!$dataf) {
      $dataf = $hoje;
	}	
	
	$sql = "select * from todocategoria order by descricao";
	$result = mysql_query($sql);	
	$cat = "<option value=\"0\">Todas</option>";	
	while ($linha=mysql_fetch_object($result)) {
		$sel = "";
		if ($id_categoria == $linha->id) {
			$sel = "selected";
		}
			$cat .= "<option value=\"$linha->id\" $sel >$linha->descricao</option>\n";
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
	$sql .= "      ( todo.confidencial = 0 and todo.id_usuario <> $ok ) OR ";
	$sql .= "      ( todo.id_usuario = $ok ) ";
	$sql .= " ) "; 	
	$sql .= " ORDER BY ";
	$sql .= "  prioridade, data desc";
    $result = mysql_query($sql) or die($sql);	
?>
<html>
<head>
<title>ToDo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head> <body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000">
<p>TODO Coletivo Datamace RhStudio</p>
<form name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr> 
      <td valign="top">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td>&nbsp;</td>
            <td><a href="novotodo.php?novo=1">NOVO</a></td>
          </tr>
          <tr> 
            <td width="9%">Categoria</td>
            <td width="91%"><select name="id_categoria" class="bordaTexto" id="id_categoria" onChange="javascript:document.form1.submit();">
                <?=$cat?>
              </select> <input name="Submit" type="submit" class="borda_fina" value="Submit"> 
            </td>
          </tr>
        </table><br>

        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr valign="top"> 
            <td width="67%"> <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bordaTexto">
                <tr> 
                  <td width="6%" align="center" bgcolor="#999999"> <strong><font color="#FFFFFF"> 
                    <input name="che" type="checkbox" id="checked" value="id" onClick="mudou(self)">
                    </font></strong></td>
                  <td colspan="2" align="center" bgcolor="#999999"><font color="#FFFFFF"><strong>Edit</strong></font></td>
                  <td width="4%" align="right" bgcolor="#999999"><strong><font color="#FFFFFF">Pri</font></strong></td>
                  <td width="38%" bgcolor="#999999"><strong><font color="#FFFFFF">&nbsp;Descri&ccedil;&atilde;o</font></strong></td>
                  <td width="13%" align="center" bgcolor="#999999"><strong><font color="#FFFFFF">Data</font></strong></td>
                  <td width="33%" bgcolor="#999999"><strong><font color="#FFFFFF">categoria</font></strong></td>
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
	 

 	 if ($linha->confidencial) {
	     $cor = "bgcolor=\"#FFEACC\"";
     } 	
	 
?>
                <tr <?=$cor?>> 
                  <td align="center"> <input name="checked[]" type="checkbox" id="checked" value="<?=$linha->id?>"   onClick="mudou(this)" <?=$che?> ></td>
                  <td width="3%" align="center"><a href="javascript:document.form1.id.value='<?=$linha->id?>';deleta('<?=$linha->descricao?>')"><img src="../imagens/deletar.gif" width="15" height="15" border="0"></a></td>
                  <td width="3%" align="center"> <a href="novotodo.php?id=<?=$linha->id?>"><img src="../imagens/alterar.gif" width="15" height="15" border="0"></a></td>
                  <td align="right"> <strong> 
                    <?=$linha->prioridade?>
                    </strong> </td>
                  <td> <a href="javascript:dep(<?=$linha->id?>);">&nbsp; 
                    <?=$linha->descricao?>
                    </a> </td>
                  <td align="center"> 
                    <?=$data?>
                  </td>
                  <td> 
                    <?=$linha->categoria?>
                  </td>
                </tr>
                <?
 } 
?>
              </table></td>
          </tr>
        </table>
        <br>
        <table width="200" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr bgcolor="#FFFFFF"> 
            <td colspan="2">Legenda</td>
          </tr>
          <tr> 
            <td width="50%" bgcolor="FFFFCC">Atrasado</td>
            <td width="50%" bgcolor="FFEACC">Confidencial</td>
          </tr>
        </table>
        <p><font color="#CCCCCC"></font></p></td>
    </tr>
  </table>
  <input name="acao" type="hidden" id="acao">
  <input name="id" type="hidden" id="id">
</form>
</body>
</html>
<script>
  function mudou( valor ) {
    document.form1.acao.value = "alterachecked"
    document.form1.id.value = valor.value;
	document.form1.submit();
  }


  function deleta(value) {
    if ( window.confirm('Confirma deletar : ' + value +  ' ? ')) {
			document.form1.acao.value='deletar';
			document.form1.submit();
   	}
  }

  function dep(value) {
    window.open("memo.php?id="+value, "","scrollbars=yes, height=300, width=600");
  }


</script>