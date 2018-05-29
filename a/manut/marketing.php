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
    $pode = pegaMarketing($ok);
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
?>
<html>
<head>
<title>Manuten&ccedil;&atilde;o de Marketing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<img src="../figuras/intro.gif" width="321" height="21"><br>
Cadastros de Marketing: 
<p><a href="marketing/cargos.php"><font size="1">Cadastro de cargos</font></a><font size="1"><br>
  <a href="marketing/ramos.php">Cadastro de Ramos de Atividade</a><br>
  <a href="marketing/onde.php">Cadastro de Origens</a></font><font size="1"><br>
  Cadastro de Pessoas<br>
  <a href="marketing/listapessoas.php">Listagem de Pessoas</a><br>
  </font></p>
<p><font size="1"><a href="marketing/clientes01.php">Cadastro de Clientes</a></font></p>
<p><font size="1">[<a href="../inicio.php">voltar ao inicio</a>]</font></p>
</body>
</html>
<?}?>