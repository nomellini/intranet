<?
  require("../../scripts/conn.php");	
  require("../../scripts/connm.php");
  $sql = "SELECT clienteplus.cliente, pessoa.* from pessoa, clienteplus WHERE (clienteplus.id_cliente = pessoa.cliente_id and pessoa.id_pessoa=$id_pessoa);";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);  
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

<body bgcolor="#FFCC66" text="#000000">
<p>Empresa :<b><font color="#000000"> 
  <?=$linha->cliente_id?>
  <br>
  <?=$linha->cliente?>
  </font></b><font color="#0000FF"> </font></p>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FF9966">
  <tr bgcolor="#FFCC99"> 
    <td width="19%">Nome</td>
    <td width="81%"><b><font color="#000000"> 
      <?=$linha->nome?>
      </font></b></td>
  </tr>
  <tr bgcolor="#FFCC99"> 
    <td width="19%">Cargo</td>
    <td width="81%"><b><font color="#000000"> 
      <?=pegaCargo($linha->cargo_id)?>
      </font></b></td>
  </tr>
  <tr bgcolor="#FFCC99"> 
    <td width="19%">Telefone</td>
    <td width="81%"><b><font color="#000000"> 
      <?=$linha->telefone?>
      </font></b></td>
  </tr>
  <tr bgcolor="#FFCC99"> 
    <td width="19%">Fax</td>
    <td width="81%"><b><font color="#000000"> 
      <?=$linha->fax?>
      </font></b></td>
  </tr>
  <tr bgcolor="#FFCC99"> 
    <td width="19%">E-mail</td>
    <td width="81%"><b><font color="#000000"> 
      <?=$linha->email?>
      </font></b></td>
  </tr>
  <tr bgcolor="#FFCC99"> 
    <td width="19%">Observa&ccedil;&atilde;o</td>
    <td width="81%"><b><font color="#000000"> 
      <?=$linha->obs?>
      </font></b></td>
  </tr>
</table>
<p align="center">[<a href="javascript:window.close();">fechar</a>] </p>
</body>
</html>
