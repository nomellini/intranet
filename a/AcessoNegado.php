<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
p {
	font-weight: bold;
}
</style>
<?
	$Id = $_GET["IdMsg"];
	if ($Id == 1)
		$Msg = "ACESSO NEGADO AOS SÁBADOS E DOMINGOS";
	if ($Id == 2)
		$Msg = "ACESSO NEGADO PARA USUÁRIOS EM FÉRIAS";		
	if ($Id == 3)
		$Msg = "ACESSO NEGADO FORA DO HORÁRIO COMERCIAL";		
		
?>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="text-align: center; color: #F00;"><?=$Msg?></p>
</body>
</html>
