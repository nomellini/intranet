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

    if (!$v_ativo) {
      $v_ativo = 0;
    }
	

   if ($acao=="alterar") {
     $sql = "update usuario set v_ativo = $v_ativo, v_mensagem = '$v_mensagem', v_assunto = '$v_assunto' ";
	 $sql .= " where id_usuario = $ok";
	 mysql_query($sql) or die ($sql);
   }


   $sql = "Select v_ativo, v_mensagem, v_assunto from usuario where id_usuario = $ok";
   $result = mysql_query($sql);
   $linha = mysql_fetch_object($result);
   $ativo = $linha->v_ativo;
   $mensagem = $linha->v_mensagem;
   $assunto = $linha->v_assunto;
	
?>
<html>
<head>
<title>ok</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<script src="coolbuttons.js"></script></head>
<body bgcolor="#FFFFFF" text="#000000"> 
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" ><table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<form name="form1" method="post" action="index.php">
  <table width="100%"  border="0" cellpadding="1" cellspacing="1">
    <tr valign="top">
      <td width="23%">Estado da mensagem autom&aacute;tica</td>
      <td width="77%"><input name="v_ativo" type="checkbox" id="v_ativo" value="1" <? echo $v_ativo ? "checked" : "" ?> >
        Ativar</td>
    </tr>
    <tr valign="top">
      <td>Assunto</td>
      <td><input name="v_assunto" type="text" class="borda_fina" id="v_assunto" value="<?=$assunto?>" size="60" maxlength="255"></td>
    </tr>
    <tr valign="top">
      <td>Mensagem</td>
      <td><textarea name="v_mensagem" cols="60" rows="10" class="borda_fina" id="v_mensagem"><?=$mensagem?></textarea></td>
    </tr>
    <tr valign="top">
      <td>&nbsp;</td>
      <td>      <input type="submit" name="Submit" value="Enviar">
      <input name="acao" type="hidden" id="acao" value="alterar"></td>
    </tr>
  </table>
</form>
</body>
</html>
