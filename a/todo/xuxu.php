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
	
	if ($acao == "alterachecked") {
	  $select = "update todo set checked = not checked where id = " . $id;
	  mysql_query($select);
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
	
?>
<html>
<head>
<title>ToDo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head> <body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000">
<p>&nbsp;</p>
</body>
</html>
