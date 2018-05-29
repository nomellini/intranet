<?
	require("../scripts/conn.php");	
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
	
	
	if (!isset($ordem)) {
	  $ordem = "sistema.sistema";
	  $desc  = "DESC";	  
	}  	

    if ($ordem == "sistema.sistema") {
	  $ordem2 = "cliente.cliente";
	} else {
	  $ordem2 = "sistema.sistema";	
	}
	$o = "$ordem $desc, $ordem2 $desc";
	
	
	$sql = "";
	$sql .= "SELECT  ";
	$sql .= "  cliente.cliente, cliente.id_cliente, sistema.sistema  ";
	$sql .= "FROM  ";
	$sql .= "  clisis  "; 
	$sql .= "   inner join cliente on clisis.cliente = cliente.id_cliente  ";
	$sql .= "   inner join sistema on clisis.sistema = sistema.id_sistema  ";
	$sql .= "WHERE  ";
	$sql .= "  32bit = 'S'  ";
	$sql .= "ORDER BY  ";
	$sql .= " $o";
	
	$result = mysql_query($sql) or die($sql);

	
	if ($desc) {
		$linkdesc = "";
	} else {
		$linkdesc = "DESC";	
	}
	
	
?>
<script src="coolbuttons.js"></script>
<link href="../sgq/attendere.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ relat&oacute;rios</a></td>
  </tr>
</table>
<p>
  Usuario: 
  <?=$nomeusuario?>
  <br>
  Data: 
  <?=date('d/m/Y h:i:s')?>
</p>
<p align="center">
  Treinamentos cobrados por cliente e sistema
</p>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC">
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#66CCFF">
      <tr>
        <td width="47%" height="14"><a href="javascript:vai('cliente.cliente', '<?=$linkdesc?>');">
          CLIENTE
        [C&oacute;digo]
        </a></td>
        <td width="53%"><p>
          <a href="javascript:vai('sistema.sistema', '<?=$linkdesc?>');">
            Treinamento Cobrado para o sistema abaixo
          </a>
          </p>
          </td>
      </tr>
    </table>
    </td>
  </tr>
  <?  
  while( $linha = mysql_fetch_object($result) ) {
 
    $cliente = $linha->cliente;
	$sistema = $linha->sistema;	
	$id_cliente = $linha->id_cliente;
?>
  <tr bgcolor="#CCCCCC">
    <td>
      <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFDF">
        <tr>
          <td width="47%" height="18">
            <?=$cliente?>
          [<?=$id_cliente?>]</td>
          <td width="53%">
                <?=$sistema?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
      <?
  } echo $sql;
?>
</table>
<script>
  function vai(valor, desc) {
    document.form.ordem.value = valor;
	document.form.desc.value = desc;
    document.form.submit();
  }
 </script>
<br>
<br>
<form name="form" method="post" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  </font>
  <br>
  <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF">
      <td width="100%"><p>
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        <input name="desc" type="hidden" id="desc">
      </p></td>
    </tr>
  </table>
</form>
