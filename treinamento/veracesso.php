<?
//if ( substr($REMOTE_ADDR,0,9) != "192.168.0") {
//  header('Location: ../../index_externo.php');
//}

if (!isset($pageRequested))
{
	$pageRequested = $_SERVER['REQUEST_URI'];
}

$USRACESSO = array(
	"Helio",
	"Lucas",
	"Debora",
	"Flavia Cristina","flavia","Antônio","Edson","Janaina Queiroga","Leandro",
	 12, 240, 343, 334);

mysql_select_db(sad);

if($v_id_usuario){
	if ($v_id_usuario){
		if (!in_array($v_id_usuario,$USRACESSO))
		{

			if (!in_array($USRNOME,$USRACESSO)){
				require ('negado1.php');
				die;
			}
		}
	}
}else{
	if (!in_array($USRNOME,$USRACESSO)){
		{
			header("Location: ../login.php?pageRequested=$pageRequested");
		}
		die;
	}

	if ( isset($id_usuario) ) {
		if (verificasenha($cookieEmailUsuario, $cookieSenhamd5 ) <> $id_usuario){
			header("Location: login.php?pageRequested=$pageRequested");
		}
		setcookie("loginok");
	}
}

mysql_select_db(treinamento);
?>
