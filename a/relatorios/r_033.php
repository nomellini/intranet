<?	require("../scripts/conn.php");	
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
		
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*2 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!isset($orderby)) {
		$orderby = " id_chamado desc";
	}
	
	$orderby .= ", id_chamado";	
		
?>
<html>
<head>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">

<div align="center"><br>
  Clientes com banco de dados<br>
  <br>
  <br>
</div>
  <div align="left">
<?php	

$sql_1 = "select * from cliente where usa_banco order by cliente ";

?>
  <table width="54%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr>
          <td width="21%" bgcolor="#FFFFFF" >id_cliente</td>
          <td width="79%" bgcolor="#FFFFFF" >Cliente</td>

    </tr>
  
<?
  $r = 0;
  $resultA = mysql_query($sql_1) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
  	$r++;
?>

    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->id_cliente;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->cliente;?></td>
    </tr>
	
<?php
  }
 ?>
  </table>
  </blockquote>
<a href="../inicio.php">SAD</a></div>
  </div>
</body>
</html>
