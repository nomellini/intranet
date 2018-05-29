<!DOCTYPE html>
<?
	session_start();
	if ($logout = true)
	{
		session_unregister(v_id_usuario);
		setcookie("lembralogin", "true", time()-172900);
		setcookie("cookieEmailUsuario", $email, time()-172900);
		setcookie("cookieSenhamd5", md5($senha), time() -172900);
		setcookie("id_usuario", $ok, time() -172900);
	}
	else
	{
		session_register(v_id_usuario);
	}

	require("a/scripts/conn.php");	
	if ($novologin)
	{
		setcookie("cookieEmailUsuario");
		setcookie("cookieSenhamd5");
		setcookie("id_usuario");
		setcookie("lembralogin");
		unset($cookieEmailUsuario);
		unset($cookieSenhamd5);
		unset($novologin);
		unset($lembralogin);
	}
	
	if (isset($lembralogin))
	{
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok==$id_usuario){
			header("Location: index.php"); 
		} 
	}
	
	$msg= ""; 
	if ($acao == "login")
	{
		session_register(v_id_usuario);	
		$ok = verificasenha($email, md5($senha));
		if ($ok)
		{
			if ($lembrar) {
				setcookie("lembralogin", "true", time()+172900);
			}
			else
			{
				setcookie("lembralogin");
			}
			setcookie("cookieEmailUsuario", $email, time()+ 172900);
			setcookie("cookieSenhamd5", md5($senha), time() + 172900);
			$v_id_usuario=$ok;
			setcookie("id_usuario", $ok, time() + 172900);
			if (strpos($pageRequested, 'treinamento/treinamento.php') !== false)
			{
				header("Location: treinamento/treinamento.php");
			}
			else
			{
				header("Location: index.php");
			}
			exit;
		}
		else
		{
			//$msg = "Dados incorretos - $ok - $email - $senha";
			$msg = "Dados incorretos.<br>Verifique seu usuário e sua senha!";
		}
	}
	if (!isset($pageRequested))
	{
		$pageRequested = $_SERVER['REQUEST_URI'];
	}
?>
<html lang="en">
<head>
<title>Login no sistema</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Login, registration forms">
<meta name="author" content="Seong Lee">
<link href="../a/css/bootstrap.css" rel="stylesheet">
<link href="../a/css/animation.css" rel="stylesheet">
<link href="../a/css/checkbox/orange.css" rel="stylesheet">
<link href="../a/css/preview.css" rel="stylesheet">
<link href="../a/css/authenty.css" rel="stylesheet">
<!-- Font Awesome CDN -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body >
<form name="form" method="post" action="login.php">
  <section id="authenty_preview">
    <section id="signin_main" class="authenty signin-main">
      <div class="section-content">
        <div class="wrap">
          <div class="container">
            <div class="form-wrap">
              <div class="row">
                <div class="title" data-animation="fadeInDown" data-animation-delay=".8s">
                  <h1>SAD</h1>
                  <h5>Sistema de Atendimento Datamace</h5>
                  <?=$msg?>
                </div>
                <div id="form_1" data-animation="bounceIn">
                  <div class="form-header"> <i class="fa fa-user"></i> </div>
                  <div class="form-main">
                    <div class="form-group">
                      <input name="pageRequested" type="hidden" id="pageRequested" value="<?=$pageRequested?>">
                      <input type="text" 
													name="email" 
													id="un_1" 
													class="form-control" 
													placeholder="Usuário" 
													required="required" 
													value="<?=$cookieEmailUsuario?>">
                      <input type="password" 
											 		name="senha" 
													id="pw_1" 
													class="form-control" 
													placeholder="Senha" 
													required="required">
                      <input type="hidden" name="acao" value="login">
                    </div>
                    <button id="signIn_1" type="submit" class="btn btn-block signin">Entrar</button>
                  </div>
                  <div class="form-footer">
                    <div class="row">
                      <div class="col-xs-12"> <i class="fa fa-check"></i> <a href="../../index.php" id="signup_from_1">Intranet</a> </div>
                    </div>
                  </div>
                  
                  <!--										<div class="form-footer">
											<div class="row">
												<div class="col-xs-7">
													<i class="fa fa-unlock-alt"></i>
													<a href="#password_recovery" id="forgot_from_1">Forgot password?</a>
												</div>
												<div class="col-xs-5">
													<i class="fa fa-check"></i>
													<a href="#signup_window" id="signup_from_1">Sign Up</a>
												</div>
											</div>
										</div>		
--> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</form>

<!-- js library --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script> 
<script src="../a/js/bootstrap.min.js"></script> 
<script src="../a/js/jquery.icheck.min.js"></script> 
<script src="../a/js/waypoints.min.js"></script> 
<!-- authenty js --> 
<script src="../a/js/authenty.js"></script> 
<!-- preview scripts --> 
<script src="../a/js/preview/jquery.malihu.PageScroll2id.js"></script> 
<script src="../a/js/preview/jquery.address-1.6.min.js"></script> 
<script src="../a/js/preview/scrollTo.min.js"></script> 
<script src="../a/js/preview/init.js"></script> 
<!-- preview scripts --> 
<script>
			(function($) {
				
				// get full window size
				$(window).on('load resize', function(){
				    var w = $(window).width();
				    var h = $(window).height();

				    $('section').height(h);
				});		

				// scrollTo plugin
				$('#signup_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
				$('#forgot_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
				$('#signup_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
				$('#forgot_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
				$('#forgot_from_3').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
				
				
				// set focus on input
				var firstInput = $('section').find('input[type=text], input[type=password]').filter(':visible:first');        
				if (firstInput != null) {
		            firstInput.focus();
        		}
				
				$('section').waypoint(function (direction) {
					var target = $(this).find('input[type=text], input[type=password]').filter(':visible:first');
					target.focus();
				}, {
	          offset: 300
	      }).waypoint(function (direction) {
					var target = $(this).find('input[type=text], input[type=password]').filter(':visible:first');
					//target.focus();
	      }, {
	          offset: -400
	      });
				
				
				// animation handler
				$('[data-animation-delay]').each(function () {
	          var animationDelay = $(this).data("animation-delay");
	          $(this).css({
	              "-webkit-animation-delay": animationDelay,
	              "-moz-animation-delay": animationDelay,
	              "-o-animation-delay": animationDelay,
	              "-ms-animation-delay": animationDelay,
	              "animation-delay": animationDelay
	          });
	      });
				
	      $('[data-animation]').waypoint(function (direction) {
	          if (direction == "down") {
	              $(this).addClass("animated " + $(this).data("animation"));
	          }
	      }, {
	          offset: '90%'
	      }).waypoint(function (direction) {
	          if (direction == "up") {
	              $(this).removeClass("animated " + $(this).data("animation"));
	          }
	      }, {
	          offset: '100%'
	      });
			
			})(jQuery);
		</script>
</body>
</html>
<?

die();
	session_start();
	if ($logout = true)
	{
		session_unregister(v_id_usuario);
		setcookie("lembralogin", "true", time()-172900);
		setcookie("cookieEmailUsuario", $email, time()-172900);
		setcookie("cookieSenhamd5", md5($senha), time() -172900);
		setcookie("id_usuario", $ok, time() -172900);
	}
	else
	{
		session_register(v_id_usuario);
	}

	require("a/scripts/conn.php");	
	if ($novologin)
	{
		setcookie("cookieEmailUsuario");
		setcookie("cookieSenhamd5");
		setcookie("id_usuario");
		setcookie("lembralogin");
		unset($cookieEmailUsuario);
		unset($cookieSenhamd5);
		unset($novologin);
		unset($lembralogin);
	}
	
	if (isset($lembralogin))
	{
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok==$id_usuario){
			header("Location: index.php"); 
		} 
	}
	
	$msg= ""; 
	if ($acao == "login")
	{
		session_register(v_id_usuario);	
		$ok = verificasenha($email, md5($senha));
		if ($ok)
		{
			if ($lembrar) {
				setcookie("lembralogin", "true", time()+172900);
			}
			else
			{
				setcookie("lembralogin");
			}
			setcookie("cookieEmailUsuario", $email, time()+ 172900);
			setcookie("cookieSenhamd5", md5($senha), time() + 172900);
			$v_id_usuario=$ok;
			setcookie("id_usuario", $ok, time() + 172900);
			if (strpos($pageRequested, 'treinamento/treinamento.php') !== false)
			{
				header("Location: treinamento/treinamento.php");
			}
			else
			{
				header("Location: index.php");
			}
			exit;
		}
		else
		{
			//$msg = "Dados incorretos - $ok - $email - $senha";
			$msg = "Dados incorretos.<br>Verifique seu usuário e sua senha!";
		}
	}
	if (!isset($pageRequested))
	{
		$pageRequested = $_SERVER['REQUEST_URI'];
	}
?>
<html>
<head>
<title>Login na Intranet</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="a/stilos.css" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="600" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <td valign="top" ><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="50%"><img src="imagens/logotipo%20datamace.gif" width="155" height="41"></td>
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
      <div align="center">
        <form action="<?=$script_name?>" method="post" name="form" style="margin-bottom: 0">
          <input name="pageRequested" type="hidden" id="pageRequested" value="<?=$pageRequested?>">
          <p><b><font color="#FF0000" size="4">
            <?=$msg?>
            </font></b></p>
          <table width="60%" border="0" cellspacing="1" cellpadding="1" align="center">
            <tr>
              <td width="23%"><input type="hidden" name="acao" value="login"></td>
              <td width="77%"><p><font size="3">Login na Intranet</font></p></td>
            </tr>
            <tr>
              <td width="23%" height="29"><font size="2">Login</font></td>
              <td width="77%"><span id="sprytextfield1"> <span class="textfieldRequiredMsg">Campo Login obrigat&oacute;rio<br>
                </span>
                <input name="email" type="text" class="unnamed1" id="email" accesskey="L" tabindex="1" value="<?=$email?>" size="50" maxlength="150">
                </span></td>
            </tr>
            <tr>
              <td width="23%"><font size="2">Senha</font></td>
              <td width="77%"><span id="sprytextfield2"> <span class="textfieldRequiredMsg">Campo senha obrigat&oacute;rio.<br>
                </span>
                <input name="senha" type="password" class="unnamed1" id="senha" accesskey="S" tabindex="2" size="15" maxlength="12">
                </span></td>
            </tr>
            <tr>
              <td width="23%">&nbsp;</td>
              <td width="77%"><label>
                  <input type="submit" name="button" id="button" value="Login">
                </label></td>
            </tr>
          </table>
          <br>
        </form>
      </div></td>
  </tr>
</table>
<div align="center"> 
  <script>
  document.form.email.focus();  
  function teclado() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    document.form.submit();   
  }
  }
  
 </script> 
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none");
//-->
</script>
</body>
</html>
