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
?>
<html>
<head>
<title>Base Web - Inclus&atilde;o</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/a/stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<div id="overDiv" style="position:absolute; visibility:hide; z-index: 1;"></div>
<script language="JavaScript" src="../overlib.js"></script>
<script src="../relatorios/coolbuttons.js"></script>
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
<p align="center"><font size="1"><font color="#FF0000"><b><img src="../figuras/intro.gif" width="321" height="21"><br>
  </b></font></font><font size="2" color="#FF0000">Base de Conhecimento Web</font></p>
<p align="center"><font size="2" color="#FF0000">Inclus&atilde;o</font></p>
<form name="form" method="post" action="doinclusao.php">
  <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#FFFFFF" class="tabelaBorda">
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Sistema</td>
      <td width="85%" class="tabelaFundo"> 
        <select name="select" class="textoAzulSemBorda">
          <option value="e">teet</option>
          <option value="tetete">tets</option>
          <option value="eeeee">tetetete</option>
        </select>
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Tipo</td>
      <td width="85%" class="tabelaFundo"> 
        <select name="select2" class="textoAzulSemBorda">
        </select>
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Chamado</td>
      <td width="85%" class="tabelaFundo"> 
        <input type="text" name="textfield" class="textoAzulSemBorda">
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Programa</td>
      <td width="85%" class="tabelaFundo"> 
        <input type="text" name="textfield2" class="textoAzulSemBorda">
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Descri&ccedil;&atilde;o</td>
      <td width="85%" class="tabelaFundo"> 
        <input type="text" name="descricao" class="textoAzulSemBorda" size="60" maxlength="200">
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">Resumo</td>
      <td width="85%" class="tabelaFundo"> 
        <textarea name="resumo" class="textoAzulSemBorda" cols="60" rows="6"></textarea>
      </td>
    </tr>
    <tr valign="top"> 
      <td width="15%" class="tabelaFundo">&nbsp;</td>
      <td width="85%" class="tabelaFundo"> 
        <input type="submit" name="Submit" value="Enviar" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
