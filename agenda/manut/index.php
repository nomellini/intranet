<?
/*
   Manutenção de datas.
   Autor : Fernando Nomellini
   Data  : 05/2005
*/
 require("../../a/scripts/conn.php");		


 if ($_POST["acao"] != 'novo') {
	if (  ($acao != "editar_1") and ($acao != "editar_2")  and ($acao != "deletar")  ) {
		$acao = "novo";
	}
 }

 if ($acao=="deletar") {
   $sql = "delete from datas where id = $id";
   mysql_query($sql) or die($sql);
 }



 if ($acao=="novo") {
   if ( 
        ($dia != "") and
		($mes != "") and
		($descricao != "")
	  ) {
	   $sql = "insert into datas (dia, mes, tipo, descricao) values ";
	   $sql .= "($dia, $mes, '$tipo', '$descricao')";
	   mysql_query($sql) or die(mysql_error());
	   echo ($sql);
   }
 }
 
 if ($acao=="editar_2") {
   if ( 
        ($dia != "") and
		($mes != "") and
		($descricao != "")
	  ) {
	   $sql = "update datas set dia = $dia,  mes=$mes, tipo='$tipo', descricao = '$descricao' where id = $id";
	   mysql_query($sql) or die($sql);
   }
   $dia = ""; $mes = ""; $descricao ="";
   $acao="novo";
 } 
 

 if ($acao=="editar_1") {
   $sql = "select * from datas where id = $id";
   $result = mysql_query($sql);
   $linha=mysql_fetch_object($result);
   $dia = $linha->dia;   
   $mes = $linha->mes;   
   $tipo = $linha->tipo;   
   $descricao = $linha->descricao;   
   $acao = "editar_2";
 }
 
 
?>
<html>
<head>
<title>Datas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../a/stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>Manuten&ccedil;&atilde;o de feriados, datas especiais e comemorativas<br>
  Obs. os feriados m&oacute;veis devem ser alterados todos os anos nesta p&aacute;gina.</p>
<p>Nova Data</p>
<form name="form1" method="post" action="">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="3%">Dia</td>
      <td width="97%"><input name="dia" type="text" class="borda_fina" id="dia" value="<?=$dia?>" size="3" maxlength="2"></td>
    </tr>
    <tr>
      <td>Mes</td>
      <td><input name="mes" type="text" class="borda_fina" id="mes" value="<?=$mes?>" size="3" maxlength="2"></td>
    </tr>
    <tr>
      <td>Tipo</td>
      <td>        <select name="tipo" size="1" class="borda_fina" id="tipo">
          <option value="F" selected>Feriado</option>
          <option value="E">Especial</option>
          <option value="C">Comemorativa</option>
                </select></td>
    </tr>
    <tr>
      <td>Descri&ccedil;&atilde;o</td>
      <td><input name="descricao" type="text" class="borda_fina" id="descricao" value="<?=$descricao?>" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Button" type="button" class="borda_fina" value="Incluir" onClick="vai()">
        <label>
        <input name="Button" type="button" class="borda_fina" value="Editar" onClick="editar()">
        </label>
      <input name="acao" type="hidden" id="acao" value="<?=$acao?>">
      <input name="id" type="hidden" id="id" value="<?=$id?>"></td>
    </tr>
  </table>
</form>
<table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#FFFFFF">
    <td width="5%">Editar</td>
    <td width="3%">Dia</td>
    <td width="4%">Mes</td>
    <td width="4%">Tipo</td>
    <td width="20%">Descri&ccedil;&atilde;o</td>
    <td width="64%">&nbsp;</td>
  </tr>
  <?
   $sql = "select * from datas order by mes, dia, tipo";
   $result = mysql_query($sql);
   while ($linha=mysql_fetch_object($result)) {
	  if ($linha->tipo == "F") { $linha->descricao = "<font color=#ff0000>".$linha->descricao."</font>" ;} 	  	  
	  if ($linha->tipo == "E") { $linha->descricao = "<font color=#0000FF>".$linha->descricao."</font>" ;} 	  	  	  
	  if ($linha->tipo == "C") { $linha->descricao = "<font color=#006699>".$linha->descricao."</font>" ;} 	  	  	  	     
  ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><a href="index.php?acao=editar_1&id=<?=$linha->id?>">Editar</a></td>
    <td align="center"><?=$linha->dia?></td>
    <td align="center"><?=$linha->mes?></td>
    <td align="center"><?=$linha->tipo?></td>
    <td><?=$linha->descricao?></td>
    <td> [<a href="index.php?acao=deletar&id=<?=$linha->id?>">deletar esta data </a>]</td>
  </tr>
  <?
  }
  ?>
</table>
<p>F = Feriado<br>
  E = Data Especial<br>
  C = Data Comemorativa</p>
  
  <script>
  function vai()
  {
  	document.form1.acao.value = 'novo';
	document.form1.submit();
  }

  function editar()
  {
  	document.form1.acao.value = 'editar_1';
	document.form1.submit();
  }
  
  </script>
</body>
</html>
