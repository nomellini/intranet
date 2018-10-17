<?
  require("../scripts/conn.php");		  
  require("../scripts/funcoes.php");
  
  $sql = "select historico from  contato where id_contato = " . $id_contato;

  $result = mysql_query($sql) or die (mysql_error());
  $linha = mysql_fetch_object($result);

	$Historico = $linha->historico;  
?>
<html>
<head>
<title>Data Prevista</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form action="doInsereTexto.php" method="post" name="form1" id="form1">
<?= $Historico?>
</form>
</body>
</html>
