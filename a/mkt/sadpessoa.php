<?
	require("../scripts/conn.php");	
	require("../scripts/connm.php");		
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
<title>Cadastro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p>Cliente : 
  <?="$cliente [$id_cliente]"?>
</p>
<form name="form" method="post" action="../manut/marketing/dopessoa.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="11%">Nome</td>
      <td width="89%"> 
        <input type="text" name="nome" class="unnamed1" size="50" maxlength="50">      </td>
    </tr>
    <tr> 
      <td width="11%">Telefone</td>
      <td width="89%"> 
        <input type="text" name="telefone" class="unnamed1" size="20" maxlength="20">      </td>
    </tr>
    <tr> 
      <td width="11%">e-mail</td>
      <td width="89%"> 
        <input type="text" name="email" class="unnamed1" size="50" maxlength="70">      </td>
    </tr>
    <tr>
      <td width="11%">&nbsp;</td>
      <td width="89%"> 
        <input type="submit" name="Submit" value="Gravar" class="unnamed1">
        <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">      </td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="../manut/marketing/cargos.php">
  <input type="hidden" name="tela" value="<?=$SCRIPT_NAME?>">
</form>
</body>
</html>
