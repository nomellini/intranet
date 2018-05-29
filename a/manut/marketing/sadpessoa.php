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
?>
<html>
<head>
<title>Cadastro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><img src="../../figuras/intro.gif" width="321" height="21"> <br>
  cadastro de pessoas<br>
</p>
<p>Cliente : 
  <?="$cliente [$id_cliente]"?>
</p>
<form name="form" method="post" action="dopessoa.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="11%">Nome</td>
      <td width="89%"> 
        <input type="text" name="nome" class="unnamed1" size="50" maxlength="50">
      </td>
    </tr>
    <tr> 
      <td width="11%">Cargo</td>
      <td width="89%"> 
        <select name="cargo_id" class="unnamed1" >
          <?
    echo "<option value=0>Cargo não catastrado</option>";				
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
        [<a href="cargos.php">cadastrar novo cargo</a>]</td>
    </tr>
    <tr> 
      <td width="11%">Telefone</td>
      <td width="89%"> 
        <input type="text" name="telefone" class="unnamed1" size="20" maxlength="20">
      </td>
    </tr>
    <tr> 
      <td width="11%">Fax</td>
      <td width="89%"> 
        <input type="text" name="fax" class="unnamed1" size="20" maxlength="20">
      </td>
    </tr>
    <tr> 
      <td width="11%">e-mail</td>
      <td width="89%"> 
        <input type="text" name="email" class="unnamed1" size="50" maxlength="70">
      </td>
    </tr>
    <tr> 
      <td width="11%">Obs</td>
      <td width="89%"> 
        <textarea name="obs" class="unnamed1" cols="30" rows="5"></textarea>
      </td>
    </tr>
    <tr>
      <td width="11%">&nbsp;</td>
      <td width="89%"> 
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
        <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
      </td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="cargos.php">
  <input type="hidden" name="tela" value="<?=$SCRIPT_NAME?>">
</form>
<p>&nbsp; </p>
</body>
</html>
<?
}
?>