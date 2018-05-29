<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><img src="../../figuras/intro.gif" width="321" height="21"> </p>
<?
  mysql_connect('localhost', 'sad', 'data1371');
  mysql_select_db(sad);
  $sql = "SELECT * from cliente;";
  $result = mysql_query($sql);
  while ( $linha = mysql_fetch_object($result) ) {
    $sql2 = "UPDATE clienteplus set ";
	$sql2 .= "endereco = '$linha->endereco', ";
    $sql2 .= "bairro = '$linha->bairro', ";
	$sql2 .= "cidade = '$linha->cidade', ";
	$sql2 .= "uf = '$linha->uf', ";
	$sql2 .= "cep = '$linha->cep', ";
	$sql2 .= "telefone = '$linha->telefone', ";
	$sql2 .= "funcionarios = '$linha->funcionarios' ";
	$sql2 .= "WHERE id_cliente = '$linha->id_cliente';";
	$r = mysql_query($sql2);
  }
?>
  <br>
  Os dados foram convertidos com sucesso.<br>
  [<a href="../../inicio.php">voltar ao in&iacute;cio</a>] [<a href="../marketing.php">voltar 
  marketing</a>]
</body>
</html>
