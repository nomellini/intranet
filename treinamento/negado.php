<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
<!--
.style7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
a:link {
	color: #0000CC;
}
a:visited {
	color: #0000CC;
}
a:hover {
	color: #0000CC;
}
a:active {
	color: #0000CC;
}
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #CCCCCC;
}
.style13 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14pt;
}
.style15 {
	font-size: 14px
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
</table>
<p align="center">&nbsp;</p>
<form action="alteraavatre.php" method="post" name="form" id="form">
	<input type="hidden" name="id" value="1" />
	</p>
	<p>&nbsp;</p>
	<table width="80%" border="0" align="center">
		<tr>
			<td>
			<? if ((!$prova->avaliacaoLiberada) ||
				   (!$libera_avaltre_ext && $tipo == 2) ||
				   (!$libera_avaltre_int && $tipo == 1)){?>
				<div align="justify" class="style15">
					<div align="center" class="style13">Avaliação não liberada para preenchimento</div>
				</div>
			<? }else{ ?>
							<div align="justify" class="style15">
					<div align="center" class="style13">Voc&ecirc; s&oacute; tem direito de fazer uma  avalia&ccedil;&atilde;o </div>
				</div>
			<? } ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type=button onClick="window.location = '<?=$linkPagina ?>'" value="Voltar" /></td>
		</tr>
	</table>
	<p> <br />
	</p>
</form>
<hr />
<span class="style12"> Datamace Inform&aacute;tica Ltda. </span>
<p align="center" class="style7">&nbsp;</p>
</body>
</html>
