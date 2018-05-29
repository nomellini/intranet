<?
	require("../a/scripts/conn.php");
	
    $ok = $id_usuario;	
	
	if ($novologin) {
	  if ($ok) {
        loga_online($ok, $REMOTE_ADDR, 'Logout');		  
        $sql = "delete from online where id_usuario = $ok";
        mysql_query($sql) or die ($sql . "<br>deletando usuario linha 21");		
	  }
  	  session_unregister(v_id_usuario);
	  setcookie("cookieSenhamd5");
	  setcookie("id_usuario");
	  setcookie("lembralogin");
	  unset($cookieSenhamd5);
	  unset($novologin);
	  unset($lembralogin); 
	  unset($id_usuario);	  
	} else {
	  if ($v_id_usuario) {
       header("Location: inicio.php"); 
	  }	
      session_register($v_id_usuario);	
	}
	
	if (isset($lembralogin) && $ok ) {
	  $ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	  if ($ok==$id_usuario) { 
	    header("Location: inicio.php"); 
	  } 
	}

	if ($acao == "login") {
	  setcookie("cookieEmailUsuario", $email, time()+ 1729000);
      setcookie("cookieSenhamd5", md5($senha), time() + 1729000);	
	  $ok = verificasenha($email, md5($senha));
	  if ($ok) {	  
	    if ($lembrar) {
          setcookie("lembralogin", "true", time()+1729000);
		} else {
		  setcookie("lembralogin");
		}
		$v_id_usuario = $ok; 
		setcookie("id_usuario", $ok, time() + 1729000);
	    header("Location: inicio.php");
	  } else { $msg = "Dados incorretos"; }	 
    } 
	
?>
 
<html>
<head>
<title>Login no sistema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #000099;
}
a:active {
	color: #000099;
}
.style1 {color: #FFFFFF}
-->
</style></head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr> 
    <td valign="top" > 
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td colspan="3" bordercolor="#045F98" bgcolor="#045F98"><div align="center" class="style1"><span class="Titulo style38">
              SAD</span></div></td> 
        </tr>
        <tr>
          <td width="16%" colspan="2" valign="bottom" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><p><a href="http://www.datamace.com.br" target="_blank"><img src="../nova/logomini.jpg" width="155" height="41" border="0"></a></p></td>
          <td valign="baseline" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><span class="style31"><a href="novo1.php">Home</a> | <a href="#">Corporativo</a> | <a href="#">Projetos</a>| <a href="#">Estrutura</a> | <a href="#">Apoio</a> | <a href="#">Entretenimento</a> | <a href="#">Treinamento</a> | <a href="#">Intersystem</a></span>
              <hr></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td colspan="2" valign="top" bordercolor="#CCCCCC" bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="top" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="center"><img src="figuras/intro.gif" width="321" height="21"> </div></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="../agenda/index.php">Agenda</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
          <td rowspan="10" valign="top" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><form name="form" method="post" action="index.php">
            <p><b><font color="#FF0000" size="4">
              <?=$msg?>
            </font></b></p>
            <table width="60%" border="0" cellspacing="1" cellpadding="1" align="center">
              <tr>
                <td width="23%"><input type="hidden" name="acao" value="login">                </td>
                <td width="77%">&nbsp;</td>
              </tr>
              <tr>
                <td width="23%"><div align="right"><font size="2">Login</font></div></td>
                <td width="77%"><font size="2">
                  <input type="text" name="email" size="50" maxlength="150" value="<?=$cookieEmailUsuario?>" class="unnamed1" >
                </font></td>
              </tr>
              <tr>
                <td width="23%"><div align="right"><font size="2">Senha</font></div></td>
                <td width="77%"><font size="2">
                  <input type="password" name="senha" maxlength="12" size="15" onKeyPress="teclado();" class="unnamed1">
                </font></td>
              </tr>
              <tr>
                <td width="23%"><div align="right"></div></td>
                <td width="77%"><input type="checkbox" name="lembrar" value="checkbox">
                  Lembrar nome e senha ?</td>
              </tr>
              <tr>
                <td width="23%">&nbsp;</td>
                <td width="77%"> [<a href="javascript:document.form.acao.value='login'; document.form.submit();">Efetuar 
                  login</a>]</td>
              </tr>
            </table>
            <br>
            <br>
            <br>
          </form></td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">Eventos</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">GRHNet</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">ISO9000</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">Projeto Estrela </a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">RH Studio</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="sad.php">SAD</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF"><div align="right"><a href="#">Treinamento</a></div></td>
          <td valign="top" bordercolor="#000000" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" valign="bottom" bordercolor="#FFFFFF" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
      <hr size="1" noshade>
      <div align="center"></div>
    </td>
  </tr>
</table>
<div align="center">
  <script>
  document.form.senha.focus();
  function teclado() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    document.form.submit();   
  }
  }
  
 </script>
  [<a href="doc/readme.htm">Ler o arquivo de explica&ccedil;&atilde;o do sistema</a>] 
  [<a href="novo1.php">intranet</a>]</div>
</body>
</html>
