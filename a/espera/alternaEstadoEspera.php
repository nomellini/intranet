<?	
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $nomeusuario=peganomeusuario($ok);		
	
    $sql = "SELECT * from satligacao where id = $id;";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$id_cliente = $linha->id_cliente;
	$estado = $linha->FL_ATIVO;	
	if ($estado==1) {
	  $statusAtual = 'ativo ';
	  $statusFuturo = 'desativa-lo';
	} else {
	  $statusAtual = 'desativado ';
	  $statusFuturo = 'ativa-lo';
	}
	
	if ($acao=='alternar') {	
      $sql  = "update satligacao set motivo_status = '$motivo_status', FL_ATIVO = not FL_ATIVO where id = $id";
	  mysql_query($sql);	
      header("Location: consulta.php"); 	  
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SAT</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<link href="../stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(../../agenda/figuras/fundo.gif);
}
.style2 {font-size: 9px}
-->
</style></head>

<body>
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79">
<br>
<br>
<blockquote>
<strong>
<?= $nomeusuario?></strong>, vc está pestes a alterar o Estado do cliente <strong><?= $id_cliente?></strong>.<br>
O estado atual deste cliente é <strong><?= $statusAtual?></strong>. Para<span class="style1"><strong>
<?= $statusFuturo?>
</strong></span>, digite o motivo e aperte o botão<br>

<form name="form1" method="post" action="">
  Cliente: <?= $id_cliente?>
  <br>
Explique o motivo para
<?= $statusFuturo?>
  .  <span class="style2">(obs. limite: 255 caracteres)</span><br>
  <textarea name="motivo_status" cols="100" rows="5" class="borda_fina" id="motivo_status"><?=$linha->motivo_status?>
</textarea>
  <input name="id_cliente" type="hidden" id="id_cliente">
  <input name="acao" type="hidden" id="acao" value="alternar">
  <br>
  <input type="submit" name="Submit" value="Clique aqui para <?= $statusFuturo?>">
</form> 
</blockquote>
</body>
</html>
