
<?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad); 
 $sql = "SELECT * from lembrete WHERE id=$id";
 $result = mysql_query($sql);
 $linha  = mysql_fetch_object($result);
 $datae = explode('-', $linha->data);
 
 $dia = $datae[2];
 $mes = $datae[1];
 $ano = $datae[0];
 $data = "$dia/$mes/$ano"; 
 
?>
<html>
<head>
<title>Mostra Lembrete</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p><img src="../figuras/intro.gif" width="321" height="21"> </p>
<form name="form1" method="post" action="domostralembrete.php">
  <p>Lembrete para o chamado : 
    <?=$linha->id_chamado?>
    <br>
  </p>
  <table width="46%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Data</td>
      <td width="71%"> 
        <?=$data?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Lembrete </td>
      <td width="71%"> 
        <?=$linha->obs?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">&nbsp;</td>
      <td width="71%"> 
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="button" name="Submit2" value="Voltar" class="unnamed1" onClick="javascript:history.go(-1);">
        <input type="button" name="Button" value="Ok - Lido" class="unnamed1" onClick="javascript:document.form1.submit();">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
