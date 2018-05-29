<?
include_once ('cabeca.inc.php');

	$join = " left join instrutor on ins_id = ava_ins_id";
	$sSQL = "SELECT  *, date_format(data,'%d/%m/%Y') as data FROM avaliatre $join where id = $id;";
	$result = mysql_query($sSQL);   
	$linha = mysql_fetch_object($result);

	$aTipo = array('1','2');
	
?>
<html>
<!-- DW6 -->
<head>
<title>Datamace Informática</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style16 {
	font-size: 10px;
 .style26 {
font-size: 10pt
}
.style27 {
	font-size: 10px;
	font-weight: bold;
	color: #FFFFFF;
}
.style28 {
	color: #006699;
	font-weight: bold;
}
.style30 {
	font-size: 10px;
	font-weight: bold;
}
.style31 {
	font-size: 10pt
}
.style38 {
	font-size: 9px
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
	<input type="hidden" name="id_opc" id="id_opc">
	<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
	<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
	<table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
		<tr>
			<td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><div align="center" class="style28">Avalia&ccedil;&atilde;o do Treinamento <br />
				</div>
				<table width="80%" border="0" align="center" cellpadding="0">
					<tr>
						<td width="100%"><table border="0" cellpadding="0" width="100%">
								<tr>
									<td width="100%"></td>
								</tr>
							</table></td>
					</tr>
				</table>
				<table width="70%" border="0" align="center">
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline" bgcolor="#006699"><span class="style16 style1"><strong>Dados do evento realizado:</strong></span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style30"> Evento</span></td>
						<td><span class="style16">
							<?=$linha->evento ?>
							</span></td>
					</tr>
					<tr bgcolor="#FBFBFB">
						<td valign="baseline"><span class="style16"><strong> Tipo</strong></span></td>
						<td><span class="style16">
							<?=$linha->tipo?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style16"><strong> Consultor / Instrutor / Palestrante</strong></span></td>
						<td><span class="style16">
							<?=$linha->ins_nome?>
							</span></td>
					</tr>
					<tr bgcolor="#FBFBFB">
						<td valign="baseline" bgcolor="#FBFBFB"><span class="style16"><strong> Local de realiza&ccedil;&atilde;o</strong></span></td>
						<td><span class="style16">
							<?=$linha->local?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style16"><strong> Per&iacute;odo / Data</strong></span></td>
						<td><span class="style16">
							<?=$linha->data?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style27">
							<?=++$Cont ?>
							. Avalia&ccedil;&atilde;o do Consultor / Instrutor / Palesttrante quanto a(ao): </span></td>
					</tr>
					<tr>
						<td width="50%" valign="baseline"><span class="style30"> Postura</span></td>
						<td><span class="style16">
							<?=$linha->a1?>
							</span></td>
					</tr>
					<tr bgcolor="#FBFBFB">
						<td width="50%" valign="baseline"><span class="style30">Dom&iacute;nio do assunto</span></td>
						<td><span class="style16">
							<?=$linha->b1?>
							</span></td>
					</tr>
					<tr>
						<td width="50%" valign="baseline"><span class="style30">Clareza na Exposi&ccedil;&atilde;o</span></td>
						<td><span class="style16">
							<?=$linha->c1?>
							</span></td>
					</tr>
					<tr bgcolor="#FBFBFB">
						<td valign="baseline"><span class="style30">Esclarecimento de D&uacute;vidas</span></td>
						<td><span class="style16">
							<?=$linha->d1?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style27"><strong>
							<?=++$Cont ?>
							. Qualidade do material did&aacute;tico utilizado: </strong></span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style30">Apostilas, v&iacute;deos, transpar&ecirc;ncias, exerc&iacute;cios e cases <br>
							(quando utilizados)</span></td>
						<td valign="baseline"><span class="style16">
							<?=$linha->a2?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline">&nbsp;</td>
						<td valign="baseline">&nbsp;</td>
					</tr>
					<? if (in_array($flagTipo, $aTipo)){ ?>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Organiza&ccedil;&atilde;o:</strong></span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style30">Sala.</span></td>
						<td><span class="style16">
							<?=$linha->a3?>
							</span></td>
					</tr>
					<tr bgcolor="#FBFBFB">
						<td valign="baseline"><span class="style30">Recursos Audiovisuais:<br>
							retroprojetor, TV, v&iacute;deo, dvd, data-show ou VNC <br>
							(quando utilizados)</span></td>
						<td><span class="style16">
							<?=$linha->b3?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline"><span class="style30">Atendimento (Informa&ccedil;&atilde;o, Inscri&ccedil;&otilde;es e recep&ccedil;&atilde;o)</span></td>
						<td><span class="style16">
							<?=$linha->c3?>
							</span></td>
					</tr>
					<tr>
						<td valign="baseline">&nbsp;</td>
						<td><span class="style12"></span></td>
					</tr>
					<? } ?>
					<tr bgcolor="#006699">
						<td colspan="2"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Geral:</strong></span></td>
					</tr>
					<tr>
						<td><span class="style30">Curso/Palestra/Semin&aacute;rio/Assessoria</span></td>
						<td valign="baseline"><span class="style16">
							<?=$linha->a4?>
							</span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td valign="baseline">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=$Cont ?>
							a. Observa&ccedil;&atilde;o</strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style16">
							<?=$linha->observacao?>
							</span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Sugest&atilde;o</strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style16">
							<?=$linha->sugestao?>
							</span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Elogio</strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style16">
							<?=$linha->elogio?>
							</span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Reclama&ccedil;&atilde;o</strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style16">
							<?=$linha->reclamacao?>
							</span></td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style1 style38"><strong>
							<?=++$Cont ?>
							. Nome </strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style38">
							<?=$linha->nome?>
							</span></td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline" bgcolor="#FFFFFF">&nbsp;</td>
					</tr>
					<tr bgcolor="#006699">
						<td colspan="2" valign="baseline"><span class="style16 style1"><strong>
							<?=++$Cont ?>
							. Registros complementares: </strong></span></td>
					</tr>
					<tr>
						<td colspan="2" valign="baseline"><span class="style16">
							<?=$linha->complemento?>
							</span></td>
					</tr>
				</table>
				<br>
				<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/>
				<br>
				<hr align="center">
				<p align="center"><span class="style31"> <span class="style38"><font face="Verdana, Arial, Helvetica, sans-serif" color="#999999">Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></span></span></p></td>
		</tr>
	</table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>