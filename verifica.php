<?
if ( substr($REMOTE_ADDR,0,9) != "192.168.0") {
  header('Location: /index_externo.php');
}


/*
  A id�ia � barrar quem está de fora da datamace

if ( (substr($REMOTE_ADDR,0,12) != "192.168.0.5") and
     (substr($REMOTE_ADDR,0,15) != "200.153.222.207")  ) {
  header("Location: bloqueado.php");
} else {
  if ( isset($id_usuario) ) {
    $ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
	if ($ok<>$id_usuario) {
	  header("Location: login.php");
    }
	setcookie("loginok");
  } else {
     header("Location: login.php");
  }
}
*/
?>
