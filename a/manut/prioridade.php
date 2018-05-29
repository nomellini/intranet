<html>
<head>
<title>prioridades</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
 
 if ($acao=="inserir") {
 
    $ok = 0; 
   $sql1 = "INSERT INTO prioridade ( ";
   $sql2 = ") VALUES ( ";

   if ($prioridade) {
     $sql1 .= "prioridade";
     $sql2 .= "'$prioridade'";
     $ok=1;
   }

   if ($valor) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "valor";
     $sql2 .= "$valor";
     $ok=1;
   }
   $sSQL = $sql1.$sql2.");";    
   mysql_query($sSQL);   
 } else if ($acao=="deletar") {
   $sSQL = "DELETE FROM prioridade where id_prioridade = $id_prioridade;";
   mysql_query($sSQL);
 } else if ($acao=="alterar") {

   $ok = 0; 
   $sql1 = "UPDATE prioridade set ";
   if ($prioridade) {
     $sql1 .= "prioridade = '$prioridade'";
	 $ok = 1;
   }   

   if ($valor) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "valor = $valor ";
	 $ok=1;
   }

   if ($ok) {
     $sSQL = $sql1 . " where id_prioridade=$id_prioridade;";
     mysql_query($sSQL);
	 print $sSQL;
   }
   
     
 }
 
?>


</font> 
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">prioridades:</font></p>
<form name="form" method="post" action="prioridade.php">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Caso queira alterar 
    alguma, escreva aqui o novo texto e clique em Altera, <br>
    Para inserir, digita o texto e aperte em Inserir:<br>
    <br>
    </font></p>
  <table width="44%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Prioridade</font></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <input type="text" name="prioridade" size="30" maxlength="150" class="bordaTexto">
        </font></td>
    </tr>
    <tr> 
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Valor</font></td>
      <td> 
        <input type="text" name="valor" size="3" maxlength="3" class="bordaTexto">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">[<a href="javascript:document.form.acao.value='inserir'; document.form.submit();">Inserir</a>]</font></td>
    </tr>
  </table>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
    </font></p>
  <table width="500" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="7%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">ID</font></i></div>
      </td>
      <td width="44%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">prioridade</font></i></div>
      </td>
      <td width="18%" align="center">valor</td>
      <td width="31%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">A&Ccedil;&Atilde;O</font></i></div>
      </td>
    </tr>
    <?	
 $sSQL = "Select * from prioridade order by valor;";
 $result = mysql_query($sSQL);
 while( $linha =mysql_fetch_object($result)) {    
	$id = $linha->id_prioridade;
	$nome = $linha->prioridade; 
	$valor = $linha->valor;
 ?>
    <tr bgcolor="#FFFFFF"> 
      <td width="7%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
          <?=$id?>
          </font></div>
      </td>
      <td width="44%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        &nbsp; 
        <?=$nome?>
        </font></td>
      <td width="18%" align="center"> 
        <?=$valor?>
      </td>
      <td width="31%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.acao.value='deletar'; document.form.id_prioridade.value=<?=$id?>;deleta('<?=$nome?>');">deleta</a> 
          / <a href="javascript:document.form.acao.value='alterar'; document.form.id_prioridade.value=<?=$id?>;document.form.submit();">Altera</a></font></div>
      </td>
    </tr>
    <?}?>
  </table>
  <p> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
    <input type="hidden" name="acao">
    <input type="hidden" name="id_prioridade">
    [<a href="javascript:document.form.acao.value='';document.form.submit();">Reload</a>] 
    [<a href="index.php">Voltar</a>]</font></p>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
  </font></p>
<p>&nbsp; </p>
</body>
</html>
