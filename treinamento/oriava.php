<?
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
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
.style12 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #CCCCCC;
}
.style13 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style14 {font-size: 12px}
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
<p align="center"><span class="style1">AVALIAÇÕES DE TREINAMENTO</span></p>
<p align="center" class="style5">AVALIA&Ccedil;&Atilde;O DE PR&Eacute;-REQUISITOS</p>
<p align="center" class="style5"> ROTINAS DE DEPTO PESSOAL</p>
<p align="center" class="style5"> EXERC&Iacute;CIOS DE FIXA&Ccedil;&Atilde;O DE TREINAMENTO</p>
<p align="center" class="style6">&nbsp;</p>
<p align="center" class="style6"><u>Orienta&ccedil;&atilde;o para o Preenchimento </u> </p>
<table width="80%" border="0" align="center">
  <tr>
    <td class="style13"><ol>
      <li class="style14">Leia as quest&otilde;es com aten&ccedil;&atilde;o.</li>
      <li class="style14">Clique na resposta que voc&ecirc; achar ser a certa, ela ir&aacute; para o gabarito automaticamente. </li>
      <li class="style14">Clique apenas uma vez em gravar, somente ap&oacute;s responder todas as quest&otilde;es. </li>
      <li class="style14">Todas questões são obrigatórias. </li>
    </ol>    </td>
  </tr>
</table>
<p align="center" class="style4">&nbsp;</p>
<?
$prova = new treinamento($adm);
$result = $prova->resultProvaDisponivel($tipo);
if (mysql_num_rows($result) > 0){
?>
<p align="center" class="style5">Boa Sorte! </p>
<?
	while ($linha = mysql_fetch_object($result)) {
		if ($tipo){
			$tipoLocal = $tipo;
		}else{
			$tipoLocal = $linha->conf_tipo;
		}
?>
		<p align="center" class="style7"><a href="aval_rotdp.php?id=<?=$linha->id ?>&tipo=<?=$tipoLocal ?>&adm=<?=$adm ?>&linkPagina=<?=$linkPagina ?>&provanro=<?=$linha->provanro ?>"><?=$linha->descricao ?></a></p>
<?
	}
}else{
?>
	<p align="center" class="style5">Nenhuma prova disponível! </p>
<?
}?>
<p>&nbsp;</p>
<p><input type="button" onclick="window.location = '<?=$linkPagina?>'" value="Voltar" /></p>
<hr />
<span class="style12"> Datamace Inform&aacute;tica Ltda. </span>
<p align="center" class="style7">&nbsp;</p>
</body>
</html>
