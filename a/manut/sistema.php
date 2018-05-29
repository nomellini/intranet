<html>
<head>
<title>sistemas</title>
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
   $sql1 = "INSERT INTO sistema ( ";
   $sql2 = ") VALUES ( ";

   if ($sistema) {
     $sql1 .= "sistema";
     $sql2 .= "'$sistema'";
     $ok=1;
   }

   if ($codigo) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "id_sistema";
     $sql2 .= "$codigo";
     $ok=1;
   }


   if (!$atendimento) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "atendimento";
     $sql2 .= "0";
     $ok=1;	 	 
   } else {
		if($ok) {
		$sql1 .= ", ";
		$sql2 .= ", ";
		}
		$sql1 .= "mostra";
		$sql2 .= "1";
		$ok=1;
	   
   }

   $sSQL = $sql1.$sql2.");";    
   
  // die ($sSQL);
  
   mysql_query($sSQL);   
 } else if ($acao=="deletar") {
   $sSQL = "DELETE FROM sistema where id_sistema = $id_sistema;";
   mysql_query($sSQL);
 } else if ($acao=="alterar") {
    $ok = 0; 
   $sql1 = "UPDATE sistema set ";
   if ($sistema) {
     $sql1 .= "sistema = '$sistema'";
	 $ok = 1;
   }   

   if ($atendimento) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "atendimento = not atendimento ";
	 $ok=1;
   }


   if ($ok) {
     $sSQL = $sql1 . " where id_sistema=$id_sistema;";
     mysql_query($sSQL);
   }


 }
 
?>


</font> 
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">sistemas:</font></p>
<form name="form" method="post" action="sistema.php">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Caso queira alterar 
    alguma, escreva aqui o novo texto e clique em Altera, <br>
    Para inserir, digita o texto e aperte em Inserir:<br>
    </font></p>
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="10%">C&oacute;digo</td>
      <td width="90%"><input name="codigo" type="text" class="borda_fina" id="codigo" size="6" maxlength="6"></td>
    </tr>
    <tr>
      <td>Descri&ccedil;&atilde;o</td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
        <input type="text" name="sistema" size="100" maxlength="150" class="borda_fina">
      </font>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="checkbox" name="atendimento" value="checkbox">
Atendimento [Cheque esta op&ccedil;&atilde;o se o sistema deve aparecer no sistema de atendimento] </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>[
        <a href="javascript:document.form.acao.value='inserir'; document.form.submit();">
          Inserir
        </a>
] </td>
    </tr>
  </table>
  
      <br>
      <br>
  
  <table width="576" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="7%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">ID</font></i></div>
      </td>
      <td width="41%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">sistema</font></i></div>
      </td>
      <td width="16%"> 
        <div align="center">Atendimento</div>
      </td>
      <td width="36%"> 
        <div align="center"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">A&Ccedil;&Atilde;O</font></i></div>
      </td>
    </tr>
    <?	
 $sSQL = "Select * from sistema order by id_sistema;";
 $result = mysql_query($sSQL);
 while( $linha =mysql_fetch_object($result)) {    
	$id = $linha->id_sistema;
	$nome = $linha->sistema; 
	$at = $linha->atendimento;
	if($at) { $at="sim"; } else {$at="nao";}
 ?>
    <tr bgcolor="#FFFFFF"> 
      <td width="7%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
          <?=$id?>
          </font></div>
      </td>
      <td width="41%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        &nbsp; 
        <?=$nome?>
        </font></td>
      <td width="16%"> 
        
        <div align="center"><?=$at?></div>
      </td>
      <td width="36%"> 
        <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.acao.value='deletar'; document.form.id_sistema.value=<?=$id?>;deleta('<?=$nome?>');">deleta</a> 
          / <a href="javascript:document.form.acao.value='alterar'; document.form.id_sistema.value=<?=$id?>;document.form.submit();">Altera</a></font></div>
      </td>
    </tr>
    <?}?>
  </table>
  <p> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
    <input type="hidden" name="acao">
    <input type="hidden" name="id_sistema">
    [<a href="javascript:document.form.acao.value='';document.form.submit();">Reload</a>] 
    [<a href="index.php">Voltar</a>]</font></p>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
  </font></p>
<p>&nbsp; </p>
</body>
</html>