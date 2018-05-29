<?
    require("../scripts/conn.php");	   			
	mysql_select_db(atendimento);
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");		
	}
	
	if ($acao=="coloca") {
	 $ok = 0;
	 $sql = "insert into receptor values ";
     while (list($tmp1, $tmp) = each($disponiveis)) {
	   if ($ok) {
	     $sql .= ", ";
	   }
	   $sql .= "( $tmp )";
	   $ok = 1;
	 }
	 $sql .= ";";
     mysql_query($sql);	 
	}
	
	if ($acao == "tira") {
	 $ok = 0;
	 $sql = "delete from receptor where ";
     while (list($tmp1, $tmp) = each($selecionados)) {
	   if ($ok) {
	     $sql .= " or ";
	   }
	   $sql .= "usuario=$tmp ";
	   $ok = 1;
	 }
	 $sql .= ";";
     mysql_query($sql);	
	}
	
	
    $sql = "SELECT usuario from receptor";
	$result = mysql_query($sql);
	$strAux = "...";
	while ( $linha=mysql_fetch_object($result)) {
	  $strAux .= "+" . $linha->usuario;
	}	
?>
<html>
<head>
<title>manuten&ccedil;&atilde;o :: Atendimento externo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<SCRIPT>
  function acao(value) {
    document.form.acao.value = value;
	document.form.submit();
  }
</SCRIPT>
<p><br>
  Essa tela determina quem vai ver novos chamados abertos por cliente. </p>
<form name="form" method="post" action="">
  <table width="60%" border="0" cellspacing="1" cellpadding="1">
    <tr valign="middle" align="center"> 
      <td rowspan="4"> Nomes dispon&iacute;veis<br>
        <select name="disponiveis[]" size="10" multiple class="unnamed1">
<?
  $sql = "select usuario.nome, usuario.id_usuario from usuario WHERE atendimento ORDER BY nome;";		
  $result = mysql_query($sql);
  while ( $linha = mysql_fetch_object($result) ) {
    $strAux2 = "+" . $linha->id_usuario;
	if (!strpos( $strAux, $strAux2) ) {
      echo "<option value=" . $linha->id_usuario . ">" . $linha->nome . "</option>\n";
	}
}
?>				  
        </select>
      </td>
      <td> 
        <input type="button" name="Button" value="-&gt;" onclick = "document.form.acao.value='coloca';document.form.submit();">
      </td>
      <td rowspan="4"> Nomes selecionados<br>
        <select name="selecionados[]" size="10" multiple class="unnamed1">
<?
  $sql = "select usuario.nome, usuario.id_usuario from usuario, receptor WHERE receptor.usuario = usuario.id_usuario";		
  $result = mysql_query($sql);
  while ( $linha = mysql_fetch_object($result) ) {
    echo "<option value=" . $linha->id_usuario . ">" . $linha->nome . "</option>\n";
}
?>		
        </select>
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td> 
        <input type="button" name="Submit2" value="&lt;-" onclick = "document.form.acao.value='tira';document.form.submit();">
        <input type="hidden" name="acao">
      </td>
    </tr>
  </table>
</form>

</body>
</html>
