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

?>	
<html>
<head>
<title>Categorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 

<script language="">
 function deleta(value) {
   if (window.confirm("Deseja apagar '" + value + "' ?")) {
     document.form.submit();
   }
 }

</script>

<?

 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad);   
 if (!$ordem) {
   $ordem = "sistema,categoria";
 }
 
 if ($acao=="inserir") {
     $sSQL = "INSERT INTO categoria (categoria, sistema_id) VALUES ('$categoria', $sistema);";
   
    mysql_query($sSQL);   
   
 } else if ($acao=="deletar") {
 
   $sSQL = "DELETE FROM categoria where id_categoria = $id_categoria;";         
   mysql_query($sSQL);   
 } else if ($acao=="alterar") {
 
   $ok = 0;
   $sSQL = "UPDATE categoria SET ";
   
   if ( $categoria ) {
     $sSQL .= "categoria = '$categoria'";
	 $ok = 1;
   }
   
   if ( $sistema ) {
      if ($ok) { $sSQL .= ", "; }
	  $sSQL .= "sistema_id = $sistema";
	  $ok=1;
   }		

   if ($ok) {
   $sSQL .= " WHERE id_categoria = $id_categoria;";
   mysql_query($sSQL);
}
}

?>


</font> 
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Categorias:</font></p>
<form name="form" method="post" action="categorias.php">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Caso queira alterar 
    alguma, escreva aqui o novo texto e clique em Altera, <br>
    Para inserir, digita o texto e aperte em Inserir:<br>
    <br>
    </font></p>
  <table width="98%" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <td width="13%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Categoria</font></td>
      <td width="87%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <input type="text" name="categoria" size="30" maxlength="150" class="unnamed1">
        </font></td>
    </tr>
    <tr>
      <td width="13%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Sistema</font></td>
      <td width="87%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <select name="sistema" class="unnamed1">
          <option value="0" selected>Selecione</option>
          <?	
	$sql = "select * from sistema";
	$result = mysql_query($sql);
	while( $linha =mysql_fetch_object($result)) {    
		$id = $linha->id_sistema;
		$nome = $linha->sistema; 
?>
          <option value="<?=$id?>"> 
          <?=$nome?>
          </option>
          <?
}
?>
        </select>
        </font></td>
    </tr>
  </table>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
    [<a href="javascript:document.form.acao.value='inserir';document.form.submit();">incluir</a>] 
    </font><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
    </font></p>
  <table width="500" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="8%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">A&Ccedil;&Atilde;O</font></i></div>
      </td>
      <td width="32%"> 
        <div align="center"><a href="categorias.php?ordem=sistema,categoria">Sistema</a></div>
      </td>
      <td width="60%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099"><a href="categorias.php?ordem=categoria">Categoria</a></font></i></div>
      </td>
    </tr>
    <?	
 $sSQL = "Select ca.*, si.sistema from categoria ca, sistema si where (ca.sistema_id=si.id_sistema) order by $ordem;";
 $result = mysql_query($sSQL);
 while( $linha = mysql_fetch_object($result)) {    
	$id = $linha->id_categoria;
	$cat = $linha->categoria;
	$sis = $linha->sistema;
 ?>
    <tr bgcolor="#FFFFFF"> 
      <td width="8%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><!--<a href="javascript:document.form.acao.value='deletar'; document.form.id_categoria.value=<?=$id?>;deleta('<?=$cat?>');">D</a> 
          / --><a href="javascript:document.form.acao.value='alterar'; document.form.id_categoria.value=<?=$id?>;document.form.submit();">A</a></font></div>
      </td>
      <td width="32%">
        <?=$sis?>
      </td>
      <td width="60%"> 
        <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#0000FF"> 
          &nbsp; 
          <?="$cat"?>
          </font></div>
      </td>
    </tr>
    <?
	}
?>
  </table>
  <p> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Mostrar somente 
    o sistema : <br>
    <input type="hidden" name="acao">
    <input type="hidden" name="id_categoria">
    [<a href="javascript:document.form.acao.value='';document.form.submit();">Reload</a>] 
    [<a href="index.php">Voltar</a>] 
    <input type="hidden" name="id_pai">
    </font></p>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
  </font></p>
<p>&nbsp; </p>
</body>
</html>
<?
}
?>