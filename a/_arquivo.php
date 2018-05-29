<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="cdc/stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<?

  if(  !$fileEmail=fopen('_email.txt', "r") ) {
    echo "Não foi possível abrir o arquivo";
  } else {
    $textEmail = fread( $fileEmail, 10000);
  }

  if (($action) == "gravar") {
    $fileEmail=fopen('_email.txt', "w");
    $textEmail = $email;
	fputs($fileEmail, $textEmail, 10000);	
  }

?>
<form name="form" action="_arquivo.php" method="post">
Texto a ser enviado por email, no momento da aberture de um Canal do Cliente<br>
<textarea name="email" cols="100" rows="30" class="bordaTexto" id="email">
<?=$textEmail?>
</textarea>
<br>
  <br>
  <br>
  <input type="submit" name="Submit" value="Gravar">
    <input name="action" type="hidden" id="action" value="gravar">
  </form>

</body>
</html>
<?
	//fernando
	// Teste Opa !
	fclose($fileEmail);
?>