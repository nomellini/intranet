<html>
<head>
<title>Selecione Cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<?
  if (!$ordem) {
   $ordem = "id_cliente";
  }

?>
<p align="center"> 
  <script>  
  
  function vai(value) {
    //var picoles = window.open("","pai");
	//picoles.document.form.id_cliente.value = value ;
	//picoles.document.form.submit();
	
	opener.document.form.id_cliente.value = value ;
	opener.document.form.id_cliente_exato.value = value ;	
	opener.document.form.submit();
	
	window.close();
  }
</script>
  <font color="#0000FF" size="3">Selecione o cliente clicando no c&oacute;digo </font> <br>
  <br>
  
<?
  
  require("scripts/conn.php");
  require("scripts/classes.php");	
  
  $ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );  
  
  if ($qtde >= 0) {  
  	$cli = pegaClientePorCodigoOrdem($id_cliente, $ordem);
  } else {
  	die($qtde);
  }
 
 
  ?>
</p>
<div align="center">[<a href="javascript:window.close();">FECHAR</a>]<br>
  <br>
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC">
    <td width="8%">N&uacute;mero</td> 
    <td width="18%"><a href="selecionacliente.php?ordem=id_cliente&id_cliente=<?=$id_cliente?>">C&oacute;digo</a></td>
    <td width="17%"><a href="selecionacliente.php?ordem=senha&id_cliente=<?=$id_cliente?>">Contrato</a></td>
    <td width="57%"><a href="selecionacliente.php?ordem=cliente&id_cliente=<?=$id_cliente?>">Cliente</a></td>
  </tr>
  <?
   $conta = 0;
   while ( list($tmp1, $tmp) = each($cli) ) {
    $conta++;
	
	$numero = sprintf("%04d", $conta);
	
    $id = $tmp["id_cliente"];
	$cliente = $tmp["cliente"];
	$senha = $tmp["senha"];
	$endereco = $tmp["endereco"];
	$bairro = $tmp["bairro"];
	$cidade = $tmp["cidade"];	
	$telefone = $tmp["telefone"]; 
	$ddd = 	
	$bl = $tmp["bloqueio"];	
	$id_display = $id;	
	
	$palavra = strtoupper($id_cliente);
	if ($palavra) {
		$cliente = eregi_replace($palavra, "<b><font color=#FF00FF>$palavra</font></b>", $cliente);
		$id_display = eregi_replace($palavra, "<b><font color=#FF00FF>$palavra</font></b>", $id_display);
	}
	
	
  ?>
  <tr bgcolor="#FFFFFF">
    <td width="8%"><?=$numero?></td> 
    <td width="18%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <a href="javascript:vai('<?=$id?>');"> 
      <?=$id_display?>
      </a> </font></td>
    <td width="17%"> 
     <a href="javascript:vai('<?=$id?>');"> 
      <?=$senha?>
	  </a>    </td>
    <td width="57%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <A HREF="javascript:vai('<?=$id?>');" onMouseOver="return overlib('<?="$endereco<br>$bairro<br>$cidade<br>$telefone"?>', CAPTION, 'Endereço', WIDTH, 300)" onMouseOut="nd();">
      <?
	  $msg = "$cliente";
	  if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
	  echo $msg
	  ?>
      </a></font></td>
  </tr>
  <?}?>
</table>
<p align="center">[<a href="javascript:window.close();">FECHAR</a>]</p>
</body>
</html>

