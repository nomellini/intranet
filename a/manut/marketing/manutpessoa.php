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
    $pode = pegaMarketing($ok);
	if(!$pode) {
	  require("../../sinto.htm");
	  exit;
	} else {	
	$sql = "Select * from pessoa where id_pessoa = $id_pessoa;";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
?>
<html>
<head>
<title>cadasstr</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

<body bgcolor="#FFCC66" text="#000000">
<p><img src="../../figuras/intro.gif" width="321" height="21"> <br>
  cadastro de pessoas<br>
</p>
<form name="form" method="post" action="domanutpessoa.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FF9900">
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Nome</td>
      <td width="89%"> 
        <input type="text" name="nome" class="unnamed1" size="50" maxlength="50" value="<?=$linha->nome?>">
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Cargo</td>
      <td width="89%"> 
        <select name="cargo_id" class="unnamed1" >
          <?
    echo "<option value=0>Cargo não cadastrado</option>";				
	$sistema = listaCargo();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_cargo"];
	  $si = $tmp["cargo"];
	  $se= "";
	  if ($id == $linha->cargo_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  	  
	}
	
  ?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Empresa</td>
      <td width="89%"> 
        <select name="cliente_id" class="unnamed1" >
          <?
	$sistema = listaClientesPlus();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_cliente"];
	  $si = $tmp["cliente"] . " (" . $tmp["id_cliente"] . ")";
	  $se= "";
	  if ($id == $linha->cliente_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  	  
	}
	
  ?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Telefone</td>
      <td width="89%"> 
        <input type="text" name="telefone" class="unnamed1" size="20" maxlength="20" value="<?=$linha->telefone?>">
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Fax</td>
      <td width="89%"> 
        <input type="text" name="fax" class="unnamed1" size="20" maxlength="20" value="<?=$linha->fax?>">
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">e-mail</td>
      <td width="89%"> 
        <input type="text" name="email" class="unnamed1" size="50" maxlength="70" value="<?=$linha->email?>">
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">Obs</td>
      <td width="89%"> 
        <textarea name="obs" class="unnamed1" cols="30" rows="5"><?=$linha->obs?></textarea>
      </td>
    </tr>
    <tr bgcolor="#FFCC99"> 
      <td width="11%">&nbsp;</td>
      <td width="89%"> 
        <input type="button" name="Submit" value="Enviar" class="unnamed1" onClick="vai('<?=$linha->nome?>');" >
        <input type="hidden" name="id_pessoa" value="<?=$id_pessoa?>">
        <input type="checkbox" name="deletar" value="1">
        Selecione aqui para apagar esse registro</td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<SCRIPT>
function vai(value) {
  if (document.form.deletar.checked) {
   if (window.confirm("Deseja apagar '" + value + "' ?")) {
       document.form.submit();
    }
  } else { 
   document.form.submit();
  }
}
</SCRIPT>

</body>
</html>
<?
}
?>