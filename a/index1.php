<?
	require("scripts/conn.php");
	
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
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr> 
    <td valign="top" > 
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr> 
          <td width="50%"><img src="../imagens/logotipo%20datamace.gif" width="155" height="41"></td>
          <td width="50%" valign="bottom" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
            <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[7] = "Domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   

     document.write (diasemana[diaindex] + '<br>' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
            </font></td>
        </tr>
      </table>
      <hr size="1" noshade>
      <div align="center"><img src="figuras/intro.gif" width="321" height="21"> 
        <form name="form" method="post" action="index.php">
          <p><b><font color="#FF0000" size="4"><?=$msg?></font></b></p>
          <table width="60%" border="0" cellspacing="1" cellpadding="1" align="center">
            <tr> 
              <td width="23%"> 
                <input type="hidden" name="acao" value="login">
              </td>
              <td width="77%"><font size="3">Login no sistema</font></td>
            </tr>
            <tr> 
              <td width="23%"><font size="2">Login</font></td>
              <td width="77%"> <font size="2"> 
                <input type="text" name="email" size="50" maxlength="150" value="<?=$cookieEmailUsuario?>" class="unnamed1" >
                </font></td>
            </tr>
            <tr> 
              <td width="23%"><font size="2">Senha</font></td>
              <td width="77%"> <font size="2"> 
                <input type="password" name="senha" maxlength="12" size="15" onKeyPress="teclado();" class="unnamed1">
                </font></td>
            </tr>
            <tr>
              <td width="23%">&nbsp;</td>
              <td width="77%">
                <input type="checkbox" name="lembrar" value="checkbox">
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
        </form>
      </div>
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
  [<a href="../index.php">intranet</a>]</div>
</body>
</html>
