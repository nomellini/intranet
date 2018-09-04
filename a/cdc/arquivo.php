<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<?

  if(  !$fileAbertura=fopen('abertura.txt', "r")  or !$fileEmail=fopen('email.txt', "r") ) {
    echo "N�o foi poss�vel abrir o arquivo";
  } else {
    $textEmail = fread( $fileEmail, 10000);
    $textAbertura = fread( $fileAbertura, 10000);
  }

  if (($action) == "gravar") {
    $fileEmail=fopen('email.txt', "w");
	$fileAbertura = fopen('abertura.txt', "w");
    $textEmail = $email;
	$textAbertura = $abertura;
	fputs($fileEmail, $textEmail, 10000);
    fputs($fileAbertura, $textAbertura, 10000);
  }

?>
<form name="form" action="arquivo.php" method="post">
Texto a ser enviado por email, no momento da aberture de um Canal do Cliente<br>
<textarea name="email" cols="100" rows="10" class="bordaTexto" id="email">
<?=$textEmail?>
</textarea>
<br>
Texto a ser exibido na tela inicial<br>
  <textarea name="abertura" cols="100" rows="10" class="bordaTexto" id="abertura">
<?=$textAbertura?>
</textarea>
  <br>
  <input type="submit" name="Submit" value="Gravar">
    <input name="action" type="hidden" id="action" value="gravar">
  </form>

</body>
</html>
<?
  fclose($fileEmail);
  fclose($fileAbertura);
?>