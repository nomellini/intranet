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
    $pode = pegaMarketing($ok);
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
?>
<html>
<head>
<title>Cargos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
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
 
 if ($acao=="inserir") {
   $sSQL = "INSERT INTO cargos (cargo) VALUES ('$cargo');";
   mysql_query($sSQL);   
 } else if ($acao=="deletar") {
   $sSQL = "DELETE FROM cargos where id_cargo = $id_cargo;";
   mysql_query($sSQL);
 } else if ($acao=="alterar") {
   $sSQL = "UPDATE cargos SET cargo = '$cargo' where id_cargo=$id_cargo;";
   mysql_query($sSQL);
 }
 
?>
  </font></p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Cargos:</font></p>
<form name="form" method="post" action="cargos.php">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Caso queira alterar 
    alguma, escreva aqui o novo texto e clique em Altera, <br>
    Para inserir, digita o texto e aperte em Inserir:<br>
    <br>
    <input type="text" name="cargo" size="30" maxlength="150" class="unnamed1">
    [<a href="javascript:document.form.acao.value='inserir'; document.form.submit();">Inserir</a>]<br>
    </font></p>
  <table width="500" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="10%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">ID</font></i></div>
      </td>
      <td width="62%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">Cargo</font></i></div>
      </td>
      <td width="28%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">A&Ccedil;&Atilde;O</font></i></div>
      </td>
    </tr>
    <?	
 $sSQL = "Select * from cargos;";
 $result = mysql_query($sSQL);
 while( $linha =mysql_fetch_object($result)) {    
	$id = $linha->id_cargo;
	$nome = $linha->cargo; 
 ?>
    <tr bgcolor="#FFFFFF"> 
      <td width="10%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
          <?=$id?>
          </font></div>
      </td>
      <td width="62%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        &nbsp;
        <?=$nome?>
        </font></td>
      <td width="28%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.acao.value='deletar'; document.form.id_cargo.value=<?=$id?>;deleta('<?=$nome?>');">deleta</a> 
          / <a href="javascript:document.form.acao.value='alterar'; document.form.id_cargo.value=<?=$id?>;document.form.submit();">Altera</a></font></div>
      </td>
    </tr>
    <?}?>
  </table>
  <p> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
    <input type="hidden" name="acao">
    <input type="hidden" name="id_cargo">
    [<a href="../inicio.php">In&iacute;cio</a>] [<a href="marketing.php">Voltar</a>]</font></p>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
  </font></p>
<p>&nbsp; </p>
</body>
</html>
<?
}
?>
