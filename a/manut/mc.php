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
    $pode = pegaManut($ok);   
	
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {


	if ($acao=='deletar') {
	  $sql = "delete from chamado where id_chamado = $idchamado";
	  mysql_query($sql);
	  $sql = "delete from contato where chamado_id = $idchamado";
	  mysql_query($sql);
	  $acao='ver';
	  $id=$idchamado;
	}	
	
	if (isset($id)) 
	{
		$acao='ver';
	}
	
	if ($acao=='ver') {
	  $sql = "select descricao, dataa, horaa from chamado where id_chamado = $id";
	  $result = mysql_query($sql);
	  if ($linha = mysql_fetch_object($result)) {
		  $dataa = $linha->dataa;
		  $horaa = $linha->horaa;
		  $descricao = "ID:$id<br> Descrição:$linha->descricao<br>Dataa:$dataa<br>Horaa:$horaa";
	  } else {
  		  $descricao = "Chamado não $id existe";
	  }
	}
	

?><html>
<head>
<title>usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
<img src="../figuras/intro.gif" width="321" height="21"></font> </div>
<form name="form" method="post" >
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="11%">Chamado</td>
      <td width="89%"><input name="id" type="text" id="id" value="<?=$id?>">
        <input name="acao" type="hidden" id="acao" value="ver">
        <input type="submit" name="Submit" value="ok"></td>
    </tr>
    
  </table>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Resumo do chamado:</font><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
  </font></p>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr valign="top"> 
      <td width="10%">Descri&ccedil;&atilde;o</td>
      <td width="90%"> 
        <?=$descricao?>
      </td>
    </tr>
    <tr valign="top"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="top"> 
      <td>&nbsp;</td>
      <td> 
        <input name="acao" type="hidden" id="acao" value="deletar">
        <input name="idchamado" type="hidden" id="idchamado" value="<?=$id?>"> 
        <input type="button" name="Submit2" value="Confirme" onClick="vai();"></td>
    </tr>
  </table>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> </font></p>
<? if ($ok==12) {?>
<p><a href="cnv.php"><br>
  Listar chamados n&atilde;o vis&iacute;veis</a> </p>
<? } ?>
</body>
</html>
<script>
  function vai() {
    if ( window.confirm('Quer deletar mesmo este chamado ?') ) {
	  document.form1.submit();
	}
  }
</script>
<?
}
?>
