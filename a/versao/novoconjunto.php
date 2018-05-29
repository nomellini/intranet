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
	// Quem pode dar start no conjunto.
	$txtSQL = "select a.id_usuario from i_tarefas c, i_tarefapessoa a where (a.id_tarefa=c.id) and c.nome = 'start' and id_usuario=$ok;";
    $result = mysql_query($txtSQL);
    $start = mysql_affected_rows();
	if ($start) {
?>
<html>
<head>
<title>Novo Conjunto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css"></head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="/a/figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="/a/index.php?novologin=true"><img src="/a/figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="/a/figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="/a/trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="/a/inicio.php"><img src="/a/figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
<?=$nomeusuario?>
</b></font></font> 
<p align="center"><font size="1" color="#FF0000"><b><img src="../figuras/intro.gif" width="321" height="21"></b></font></p>
<p>&nbsp;</p>
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr> 
    <td>Aqui voc&ecirc; pode iniciar um conjunto para atualiza&ccedil;&atilde;o 
      na internet. Cada conjunto criado ser&aacute; notificado a todos os involvidos 
      na libera&ccedil;&atilde;o. Cada envolvido dever&aacute; dar o seu OK, antes 
      do conjunto ser liberado no site.</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>Nessa tela poder&atilde;o ser criados at&eacute; 4 conjuntos de uma vez. 
      Se precisar mais, basta entrar nessa tela novamente. Caso contr&aacute;rio, 
      basta selecionar um ou mais conjuntos e monta-lo.</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> 
      <form name="form1" method="post" action="donovoconjunto.php">
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="borda_fina">
          <tr bgcolor="#000099"> 
            <td width="4%" height="16" align="center" valign="middle" bgcolor="#FFFFFF"><b><font color="#FF0000" size="3"><span id=asterisco></span></font></b></td>
            <td width="17%" height="16"><b><font color="#FFFFFF">Sistema</font></b></td>
            <td width="11%" height="16"><b><font color="#FFFFFF">Vers&atilde;o</font></b></td>
            <td width="17%" height="16"><b><font color="#FFFFFF">Plataforma</font></b></td>
            <td width="51%" height="16"><font color="#FFFFFF"><b>Descri&ccedil;&atilde;o</b></font></td>
            <td width="51%"><strong><font color="#FFFFFF">Data prevista para libera&ccedil;&atilde;o </font></strong></td>
          </tr>
          <tr bgcolor="#D8F4FF"> 
            <td width="4%" align="center" valign="middle"> 
              <input type="checkbox" name="chCj1" value="1">            </td>
            <td width="17%" valign="middle"> 
              <select name="sistema1" class="unnamed1" onClick="altera(1)">
                <option value="0" selected>Selecione</option>
                <? 
			     $txtSQL = "Select id_sistema, sistema from sistema where atendimento Order by sistema;";
				 $result = mysql_query($txtSQL);
				 while ( $linha=mysql_fetch_object($result) ) {
				   echo  "<option value=" . $linha->id_sistema .">". $linha->sistema . "</option>";
				 }
			  ?>
              </select>            </td>
            <td width="11%" valign="middle"> 
              <input type="text" name="versao1" size="10" maxlength="10" class="unnamed1">            </td>
            <td width="17%" valign="middle"> 
              <select name="plataforma1" class="unnamed1">
                <option value="0" selected>Selecione</option>
                <option value="16 Bits">16 Bits</option>
                <option value="32 Bits">32 Bits</option>
                <option value="Windows">Windows</option>
                <option value="Não Aplicável">Não Aplicável</option>
              </select>            </td>
            <td width="51%" valign="middle">
              <textarea name="desc1" cols="40" rows="2"></textarea>            </td>
            <td width="51%" valign="middle"><label>
              <input name="data1" type="text" id="data1" size="12" maxlength="12">
            </label></td>
          </tr>
          <tr bgcolor="#D8F4FF"> 
            <td width="4%" align="center" valign="middle"> 
              <input type="checkbox" name="chCj2" value="1">            </td>
            <td width="17%" valign="middle"> 
              <select name="sistema2" class="unnamed1" onClick="altera(2)">
                <option value="0" selected>Selecione</option>
                <? 
			     $txtSQL = "Select id_sistema, sistema from sistema where atendimento Order by sistema;";
				 $result = mysql_query($txtSQL);
				 while ( $linha=mysql_fetch_object($result) ) {
				   echo  "<option value=" . $linha->id_sistema .">". $linha->sistema . "</option>";
				 }
			  ?>
              </select>            </td>
            <td width="11%" valign="middle"> 
              <input type="text" name="versao2" size="10" maxlength="10" class="unnamed1">            </td>
            <td width="17%" valign="middle"> 
              <select name="plataforma2" class="unnamed1">
                <option value="0" selected>Selecione</option>
                <option value="16 Bits">16 Bits</option>
                <option value="32 Bits">32 Bits</option>
                <option value="Windows">Windows</option>
                <option value="Não Aplicável">Não Aplicável</option>				
              </select>            </td>
            <td width="51%" valign="middle">
              <textarea name="desc2" cols="40" rows="2"></textarea>            </td>
            <td width="51%" valign="middle"><input name="data2" type="text" id="data2" size="12" maxlength="12"></td>
          </tr>
          <tr bgcolor="#D8F4FF"> 
            <td width="4%" align="center" valign="middle"> 
              <input type="checkbox" name="chCj3" value="1">            </td>
            <td width="17%" valign="middle"> 
              <select name="sistema3" class="unnamed1" onClick="altera(3)">
                <option value="0" selected>Selecione</option>
                <? 
			     $txtSQL = "Select id_sistema, sistema from sistema where atendimento Order by sistema;";
				 $result = mysql_query($txtSQL);
				 while ( $linha=mysql_fetch_object($result) ) {
				   echo  "<option value=" . $linha->id_sistema .">". $linha->sistema . "</option>";
				 }
			  ?>
              </select>            </td>
            <td width="11%" valign="middle"> 
              <input type="text" name="versao3" size="10" maxlength="10" class="unnamed1">            </td>
            <td width="17%" valign="middle"> 
              <select name="plataforma3" class="unnamed1">
                <option value="0" selected>Selecione</option>
                <option value="16 Bits">16 Bits</option>
                <option value="32 Bits">32 Bits</option>
                <option value="Windows">Windows</option>
                <option value="Não Aplicável">Não Aplicável</option>				
              </select>            </td>
            <td width="51%" valign="middle">
              <textarea name="desc3" cols="40" rows="2"></textarea>            </td>
            <td width="51%" valign="middle"><input name="data3" type="text" id="data3" size="12" maxlength="12"></td>
          </tr>
          <tr bgcolor="#D8F4FF"> 
            <td width="4%" align="center" valign="middle"> 
              <input type="checkbox" name="chCj4" value="1">            </td>
            <td width="17%" valign="middle"> 
              <select name="sistema4" class="unnamed1" onClick="altera(4)">
                <option value="0" selected>Selecione</option>
                <? 
			     $txtSQL = "Select id_sistema, sistema from sistema where atendimento Order by sistema;";
				 $result = mysql_query($txtSQL);
				 while ( $linha=mysql_fetch_object($result) ) {
				   echo  "<option value=" . $linha->id_sistema .">". $linha->sistema . "</option>";
				 }
			  ?>
              </select>            </td>
            <td width="11%" valign="middle"> 
              <input type="text" name="versao4" size="10" maxlength="10" class="unnamed1">            </td>
            <td width="17%" valign="middle"> 
              <select name="plataforma4" class="unnamed1">
                <option value="0" selected>Selecione</option>
                <option value="16 Bits">16 Bits</option>
                <option value="32 Bits">32 Bits</option>
                <option value="Windows">Windows</option>
                <option value="Não Aplicável">Não Aplicável</option>				
              </select>            </td>
            <td width="51%" valign="middle">
              <textarea name="desc4" cols="40" rows="2"></textarea>            </td>
            <td width="51%" valign="middle"><input name="data4" type="text" id="data4" size="12" maxlength="12"></td>
          </tr>
        </table>
        <br>
        <br>
        <input type="button" name="Button" value="Criar conjunto" class="unnamed1" onClick="vai();">
      </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp; </td>
  </tr>
</table>

<script>
  function vai() {
    if (!document.form1.chCj1.checked & !document.form1.chCj2.checked & !document.form1.chCj3.checked & !document.form1.chCj4.checked) {
	  window.alert('Você deve selecionar qual conjunto deseja criar');
	  asterisco.innerHTML = '*';
	  return;
	}
	
	if ( document.form1.chCj1.checked ) {
	  if (document.form1.versao1.value == '') {
	    window.alert('Preencha o número da versão');
		document.form1.versao1.focus();
		return
	  }
	  if (document.form1.plataforma1.value=='0') {
	    window.alert('Preencha a plataforma');
		document.form1.plataforma1.focus();
		return
	  }
	  
	  if (document.form1.desc1.value=="") {
	    window.alert("Digite uma descrição resumida para o release 1");
		document.form1.desc1.focus();
		return
	  }
	}

	if ( document.form1.chCj2.checked ) {
	  if (document.form1.versao2.value == '') {
	    window.alert('Preencha o número da versão');
		document.form1.versao2.focus();
		return
	  }
	  if (document.form1.plataforma2.value=='0') {
	    window.alert('Preencha a plataforma');
		document.form1.plataforma2.focus();
		return
	  }
	  if (document.form1.desc2.value=="") {
	    window.alert("Digite uma descrição resumida para o release 2");
		document.form1.desc2.focus();
		return
	  }
	  
	}

	if ( document.form1.chCj3.checked ) {
	  if (document.form1.versao3.value == '') {
	    window.alert('Preencha o número da versão');
		document.form1.versao3.focus();
		return
	  }
	  if (document.form1.plataforma3.value=='0') {
	    window.alert('Preencha a plataforma');
		document.form1.plataforma3.focus();
		return
	  }
	  if (document.form1.desc3.value=="") {
	    window.alert("Digite uma descrição resumida para o release 3");
		document.form1.desc3.focus();
		return
	  }	  
	}

	if ( document.form1.chCj4.checked ) {
	  if (document.form1.versao4.value == '') {
	    window.alert('Preencha o número da versão');
		document.form1.versao4.focus();
		return
	  }
	  if (document.form1.plataforma4.value=='0') {
	    window.alert('Preencha a plataforma');
		document.form1.plataforma4.focus();
		return
	  }
	  if (document.form1.desc4.value=="") {
	    window.alert("Digite uma descrição resumida para o release 4");
		document.form1.desc4.focus();
		return
	  }
	  
	}

	document.form1.submit();
  }
  
  function altera(value) {
     if (value==1) {
	   document.form1.chCj1.checked = true;
	 }
     if (value==2) {
	   document.form1.chCj2.checked = true;
	 }	 
     if (value==3) {
	   document.form1.chCj3.checked = true;
	 }
     if (value==4) {
	   document.form1.chCj4.checked = true;
	 }
	 
  }
  
</script>
</body>
</html>
<?
}
?>