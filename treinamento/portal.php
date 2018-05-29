<?
include_once ('cabeca.inc.php');

?>
<html>
<head>
<title>Datamace ISO 9001:2000</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style47 {
	font-size: 11px;
	font-weight: bold;
	color: #000000;
}
.style49 {
	font-size: 10
}
.style53 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
	<tr>
		<td><p>&nbsp;</p>
			<p class="TituloTreino">Portal do Treinando</p>
			<table width="80%" border="0" align="center">
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><span class="style47">Menu Principal </span>
						<table cellspacing="0" cellpadding="0" width="160" border="0">
							<tbody>
								<tr>
									<td bgcolor="#ff0000"><img height="1" alt="." src="themes/Imagic2/imatges/comuns/espai.gif" width="1" border="0" /></td>
								</tr>
							</tbody>
						</table>
						</div></td>
				</tr>
				<tr>
					<td colspan="2"><ul>
							<li><span class="style49"><a href="cadtre.php?flagTipo=2&tipo=2&tipotre=2&linkPagina=portal.php">Cadastro do Treinando</a></span></li>
							<li><span class="style49"><a href="avatre.php?flagTipo=2&tipo=2&linkPagina=portal.php">Avalia&ccedil;&atilde;o do Treinamento</a></span></li>
							<li><span class="style49"><a href="oriava.php?flagTipo=2&tipo=2&linkPagina=portal.php">Avalia&ccedil;&atilde;o de Aprendizagem </a></span></li>
							<li><span class="style49"><a href="javascript:window.close()" >Sair</a></span></li>
						</ul></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td width="17%"><img src="imagens/novologo.jpg" width="155" height="41" alt="teste" /></td>
					<td class="style53" align="right"><?php 
$ipremoto = $_SERVER["REMOTE_ADDR"];
echo $ipremoto;

?></td>
				</tr>
			</table></td>
	</tr>
</table>
<p align="center" class="style50"><strong><br>
	</strong></p>
</body>
</html>
