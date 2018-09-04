<?
	require("scripts/conn.php");	

    if ( $acao <> 'troca') {
      $ok = verificasenha2($cookieEmailUsuario, $cookieSenhamd5 );
	  $nomeusuario=peganomeusuario($ok);	
      setcookie("loginok");
	} 
	
	$msg = "";
	if ($senhaatual) {
	  
	  $ok = verificasenha2($cookieEmailUsuario, md5($senhaatual) );
  	  if ($ok<>$id_usuario) { $msg = "Senha atual não confere<br>"; }
      
	  if (!$msg) {  // Ok
	    $sql = "UPDATE usuario SET senha = '" . md5($confirma) . "', expirado=0 WHERE id_usuario = $id_usuario;";
		mysql_query($sql);
	    $sql = "insert into temporaria (nome, id) values ( '$confirma', $id_usuario);";
		mysql_query($sql);		
//        setcookie("/cookieSenhamd5");
		setcookie("/cookieSenhamd5", md5($senha), time() + 172900);		
		setcookie("cookieSenhamd5", md5($senha), time() + 172900);				
//        setcookie("/id_usuario");
//        setcookie("/lembralogin");
//        unset($cookieSenhamd5);
//        unset($novologin);
//        unset($id_usuario);				
		header("Location: index.php?msg=Efetue o login com a nova senha&l=true");
	  }	  
	  	  	   
	}
	
?>
<html>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<meta http-equiv="refresh" content="60">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr> 
    <td><b> </b><font size="1"> [se voc&ecirc; n&atilde;o for o <font color="#FF0000"> 
      <?=$nomeusuario?>
      </font> <a href="index.php?novologin=true">clique aqui</a>]</font> </td>
    <td> 
      <div align="right">[<a href="index.php?novologin=true">logout</a>] </div>
    </td>
  </tr>
</table>
<hr size="1" noshade>
<font size="3" color="#FF0000"><b>Aten&ccedil;&atilde;o</b>: </font><font size="1"><font color="#FF0000"> 
<?=$nomeusuario?>
</font></font>
<ul>
  <li><font size="3" color="#FF0000"><font color="#003366"><font size="2">Devido 
    &agrave; politica de seguran&ccedil;a, a sua senha deve ser trocada periodicamente;</font></font></font></li>
  <li><font size="3" color="#FF0000"><font color="#003366"><font size="2">Deve 
    ter no m&iacute;nimo 6 e no m&aacute;ximo 32 caracteres;</font></font></font></li>
  <li><font size="3" color="#FF0000"><font color="#003366"><font size="2">Deve 
    conter letras e n&uacute;meros;</font></font></font></li>
  <li><font size="3" color="#FF0000"><font color="#003366"><font size="2">A nova 
    senha n&atilde;o pode ser igual a anterior.</font></font><br>
    <br>
    <?=$msg?><br>
    <?=$msg2?>	
    </font></li>
</ul>
<form action="trocasenha.php" method="post" name="form" id="form">
  <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr> 
      <td width="14%">Senha Atual</td>
      <td width="86%">
        <input name="senhaatual" type="password" class="unnamed1"  size="15" maxlength="32">
        Min 6, max 32 caracteres</td>
    </tr>
    <tr> 
      <td width="14%">Nova Senha</td>
      <td width="86%">
        <input type="password" name="novasenha" class="unnamed1" size="15" maxlength="32">
        Min 6, max 32 caracteres</td>
    </tr>
    <tr> 
      <td width="14%">Confirma Senha</td>
      <td width="86%">
        <input type="password" name="confirma" class="unnamed1" size="15" maxlength="32">
        Min 6, max 32 caracteres</td>
    </tr>
    <tr> 
      <td colspan="2">
        <input type="button" name="Button" value="Confirma" onClick="vai();">
        <input name="acao" type="hidden" id="acao" value="troca">
        <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$id_usuario?>"></td>
    </tr>
  </table>
  </form>

</body>
</html>
<script>

function vai() {
  var atual = document.form.senhaatual.value;
  var nova = document.form.novasenha.value;
  var confirma = document.form.confirma.value;
  
  if (nova==atual) {
    window.alert ("Nova senha não deve ser igual a atual");
	document.form.novasenha.value='';
	document.form.confirma.value='';	
	document.form.novasenha.focus();
    return 0;
  }

 
  if ( minLength(nova,5) ) {
    window.alert ("Nova senha com tamanho menor do que o mínimo");
	document.form.novasenha.focus();
    return 0;
  }
  
  if ( onlyNumbers(nova) || onlyCharacteres(nova) ) {
    window.alert ("Nova senha deve ter letras e números");
	document.form.novasenha.focus();
    return 0;
  }
 
  if (nova!=confirma) {
    window.alert ("Nova senha não bate com a confirmação");
	document.form.novasenha.focus();
    return 0;
  }
  
  document.form.submit();
}


function minLength(inputString,inputLength) {
  return (inputString.length <= inputLength) ? true : false;
} 

function onlyNumbers(inputString) {
 var searchForNumbers = /\D+/
 if  (searchForNumbers.test(inputString)) {
   return false;
 } else {
   return true;
 }
}

function onlyCharacteres(inputString) {
 var searchForNumbers = /\d+/
 if  (searchForNumbers.test(inputString)) {
   return false;
 } else {
   return true;
 }
}

</script>