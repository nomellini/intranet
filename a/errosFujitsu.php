<?php 
    require_once('../Connections/sad.php');
	require("scripts/conn.php");
	require("scripts/funcoes.php");	

	$resultA = mysql_query("Select * from errosFujitsu order by Cd_codigo") or die (mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<script type="text/javascript" src="../scripts/jquery-1.3.2.min.js"> </script>
<script>

$(document).ready(function() {
	$('.baixo').slideUp(0);

	$('.cima').click(function() 
	{
		var iD = "#" + $(this)[0].id + "_";
		if ($(iD).is(":visible"))
		{
			$(this).removeClass("selecionado");
			$(iD).slideUp();
		}
		else
		{
			$(this).addClass("selecionado");
			$(iD).slideDown();
		}
		return false;
	});
});
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="relatorios/stilos.css" type="text/css">
<style type="text/css">
<!--
.LinhasPares {
	background-color: #FFFFEC;
}
.LinhasImpares {
	background-color: #E8EEFF;
}
.selectedRow {
	background-color: #FDDBDC;
}
.tableContainer {
	overflow: auto;
}
.selecionado, .thead {
	font-style: normal;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	background-color: #09F;
}
.selecionado {
	background-color: #6CF;
}
table tr, .selecionado {
	font-size: 14px;
}
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.tbDesc {
	text-align: right;
	width: 10%;
	color: #C00;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
    <tr align="center">
        <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
        <td width="35%" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
            ao in&iacute;cio</a></td>
        <td width="45%" class="coolButton"><a href="relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
            p/ relat&oacute;rios</a></td>
    </tr>
</table>
<hr color=#ff0000 noshade size="1">
<br>
<div align="center" style="font-size:14px;font-weight:bold;color:#09F">Lista de erros do Sistema - Versão FJ</div>
<form name="form" method="post" action="errosFujitsu.php">
    <table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
            <td colspan="2" style="font-size:10px">Para visualizar a descrição/ação, clique sobre o erro</td>
        </tr>
        <tr class="thead">
            <th>Código</th>
            <th>Erro</th>
        </tr>
        <tbody>
            <?
	while ($linhaA = mysql_fetch_object($resultA)) {
?>
            <tr class="cima" id="e<?=$linhaA->Cd_codigo ?>" style="cursor:pointer">
                <td valign="top"><?=$linhaA->Cd_codigo ?></td>
                <td><?=$linhaA->Tx_erro ?></td>
            </tr>
            <tr>
                <td colspan="2"><div class="baixo" id="e<?=$linhaA->Cd_codigo ?>_">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <? if ($linhaA->Tx_descricao) { ?>
                            <tr>
                                <td class="tbDesc">Descrição: </td>
                                <td><?=$linhaA->Tx_descricao ?></td>
                            </tr>
                            <?
							}
							if (trim($linhaA->Tx_acao))
							{
							?>
                            <tr>
                                <td class="tbDesc">Ação: </td>
                                <td><?=$linhaA->Tx_acao ?></td>
                            </tr>
                            <? } ?>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                    <hr color="#09F" noshade size=".5"></td>
            </tr>
            <?php
  } 
 ?>
        <tbody>
    </table>
    </div>
</form>
</body>
</html><?php mysql_free_result($resultA); ?>