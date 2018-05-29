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
<title>tarefa</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

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
<p align="center"><font size="1"><font color="#FF0000"><b></b></font><font size="1"><font color="#FF0000"><b><img src="../figuras/intro.gif" width="321" height="21"></b></font></font></font></p>
<p>&nbsp;</p>
<p>Lote de atualiza&ccedil;&atilde;o : 
  <?=$id_conjunto?><br>
  <?
    $result = mysql_query("SELECT id, sistema.sistema, versao, plataforma, data, hora FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND i_conjunto.id = $id_conjunto AND NOT ok ORDER BY data;");
    $linha = mysql_fetch_object($result);
	echo "$linha->sistema $linha->versao $linha->plataforma - $linha->data<br>";
    require( $tabela.".php");	
  ?>
</p>

  <script>
function mostra(item){
 if (item.style.display=='none'){
   item.style.display='';
 } else {
   item.style.display='none'
 }
}
</script>
</body>
</html>
