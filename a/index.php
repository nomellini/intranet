<!DOCTYPE html><?
	require("scripts/conn.php");

    $ok = $id_usuario;

	if ($novologin) {
	  if ($ok) {
        loga_online($ok, $REMOTE_ADDR, 'Logout');
        $sql = "delete from online where id_usuario = $ok";
        mysql_query($sql) or die ($sql);
	  }
  	  session_unregister(v_id_usuario);
	  setcookie("cookieSenhamd5", "",0, "/");
	  setcookie("id_usuario", "", 0, "/");
	  setcookie("lembralogin", "", 0 , "/");
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
	    loga_login($ok);
	    header("Location: inicio.php");
	  }
	}

	if ($acao == "login") {
	  setcookie("cookieEmailUsuario", $email, time()+ 1729000, "/");
      setcookie("cookieSenhamd5", md5($senha), time() + 1729000, "/");
	  $ok = verificasenha($email, md5($senha));
	  if ($ok) {
	    if ($lembrar) {
          setcookie("lembralogin", "true", time()+1729000, "/");
		} else {
		  setcookie("lembralogin", "",  0, "/");
		}
		$v_id_usuario = $ok;
		setcookie("id_usuario", $ok, time() + 1729000, "/");
	    loga_login($ok);
	    header("Location: inicio.php");
	  } else { $msg = "<br><h4>Dados incorretos</h4>"; }
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


<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/animation.css" rel="stylesheet">
<link href="css/checkbox/orange.css" rel="stylesheet">
<link href="css/preview.css" rel="stylesheet">
<link href="css/authenty.css" rel="stylesheet">
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
<form name="form" method="post" action="index.php">
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
										<div class="form-header">
										  <i class="fa fa-user"></i>
									  </div>
									  <div class="form-main">
										  <div class="form-group">
								  			<input type="text"
													name="email"
													id="un_1"
													class="form-control"
													placeholder="Usu�rio"
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
												<div class="col-xs-12">
													<i class="fa fa-check"></i>
													<a href="../index.php" id="signup_from_1">Intranet</a>
												</div>
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
-->								  </div>
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
	    <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.icheck.min.js"></script>
		<script src="js/waypoints.min.js"></script>
		<!-- authenty js -->
		<script src="js/authenty.js"></script>
		<!-- preview scripts -->
		<script src="js/preview/jquery.malihu.PageScroll2id.js"></script>
		<script src="js/preview/jquery.address-1.6.min.js"></script>
		<script src="js/preview/scrollTo.min.js"></script>
		<script src="js/preview/init.js"></script>
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
