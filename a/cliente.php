<html>
<head>
<title>Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post" action="cliente.php">
  C&oacute;digo 
  <input type="text" name="codigo">
  <input type="submit" name="Submit" value="Submit">
</form>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCFFFF"> 
    <td width="18%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">C&oacute;digo</font></td>
    <td width="15%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Senha</font></td>
    <td width="67%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Cliente</font></td>
  </tr>
  <?
    require("scripts/conn.php");
	$sql = "select id_cliente, senha, cliente from cliente where id_cliente like '$codigo%';";
	$result = mysql_query($sql);
	while($linha=mysql_fetch_object($result)) {
	  $id = $linha->id_cliente;
	  $senha = $linha->senha;
	  $cliente = $linha->cliente;
	  
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td width="18%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$id?>
      </font></td>
    <td width="15%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$senha?>
      </font></td>
    <td width="67%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$cliente?>
      </font></td>
  </tr>
  <?
  }
  ?>
  
</table>
</body>
</html>
