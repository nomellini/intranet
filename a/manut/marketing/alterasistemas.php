<?
	require("../../scripts/conn.php");	
	require("../../scripts/connm.php");		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
 
    $sql = "SELECT sistema from clisis WHERE cliente = '$id_cliente';";
	$result = mysql_query($sql);
	$strAux = "...";
	while ( $linha=mysql_fetch_object($result)) {
	  $strAux .= "+" . $linha->sistema;
	}
?>

<html>
<head>
<title>altera sistema :: <?=$id_cliente?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="">
  <p>Alterar os sistemas para o cliente de c&oacute;digo : 
    <?=$id_cliente?>
  </p>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="15%"> 
        <div align="right"></div>
      </td>
      <td width="85%">Sistema</td>
    </tr>
    <?
    $sql = "select sistema, id_sistema from sistema where atendimento and not mostra order by sistema";
	$result = mysql_query($sql);
	while ( $linha=mysql_fetch_object($result)) {
	  $se = "";
	  $si = $linha->sistema;
	  $strAux2 = "+" . $linha->id_sistema;
	  if (strpos( $strAux, $strAux2) ) {
	    $se = "checked";
		$si = "<b>$si</b>";
	  }
	  ?>
    <tr> 
      <td width="15%"> 
        <div align="right"> 
          <input type="checkbox" name="id_sistema[]" value="<?=$linha->id_sistema?>" <?=$se?> class="unnamed1">
        </div>
      </td>
      <td width="85%"> <font color="#0000FF"> 
        <?=$si?>
      </font></td>
    </tr>
    <?}?>
    <tr> 
      <td width="15%"></td>
      <td width="85%"> 
        <input type="submit" name="Submit" value="Ok" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
