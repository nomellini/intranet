<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	

    if (!isset($limite)) {
	  $limite = 25;
	}
	
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../relatorios/stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<SCRIPT LANGUAGE="JavaScript" SRC="../relatorios/../overlib.js"></SCRIPT>
<script src="../relatorios/coolbuttons.js"></script></head>
<body bgcolor="#FFFFFF" text="#000000"> 
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" ><table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
