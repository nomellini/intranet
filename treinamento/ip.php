<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

if ($checkbox) {
	$tam = count($checkbox);
	
	for ($x = 0; $x <= $tam; $x++ ){
		$sql = "delete from relacaoip where id = '$checkbox[$x]' ";
	    $result = mysql_query($sql);  
	}	
}

$sSQL = "SELECT *, date_format(data, '%d/%m/%Y') as data FROM relacaoip where year(data) = $ano and month(data) = $mes";
if ($evento){
	" and evento like '%$ip%'";
}
$sSQL .= " order by ip, tipo";
$result = mysql_query($sSQL);   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Treinamento</title>
<title>Datamace Inform&aacute;tica Ltda.</title>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script language="JavaScript" src="numero.js" type="text/javascript"></script>
<script>
	var a_fields = {
		'evento':{'r':true}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		return true;
	}

function seleciona(opcao){
	if (opcao==1){
		var x= true ;
	}else{
		var x= false;
	}
x = $('#Marca')[0].checked;
	for (a=0; a<document.form.length;a++){
		if (document.form.elements[a].type=="checkbox" &&
			!document.form.elements[a].disabled){
			document.form.elements[a].checked=x;
		}
	}
}
</script>
<style type="text/css">
<!--
.style4 {
	font-weight: bold
}
.style5 {
	font-size: 9px
}
.style1 {
	color: #FFFFFF
}
.style2 {
	font-size: 18px;
	font-weight: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style3 {
	color: #000099
}
-->
</style>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style2 {
	font-size: 18px;
	font-weight: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.style3 {
	color: #000099
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
	<table width="100%" border="0">
		<tr>
			<td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC38" class="bgTabela" bordercolor="#FF0000">
					<tr align="center" valign="middle">
						<td width="17%"><div align="center" class="style1">
								<div align="left"><a href="http://www.datamace.com.br"><img src="../imagens/novologo.jpg" width="155" height="41" border="0"> </a></div>
							</div></td>
						<td width="60%" valign="middle"><p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet 
								DATAMACE</font></p></td>
						<td width="23%" valign="bottom" align="right"><span class="style1"><font size="1"> <font class="unnamed1"> 
							<script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;   
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[0] = "Domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   
     document.write (diasemana[diaindex] + '<br>' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);

              </script> 
							</font> </font></span></td>
					</tr>
				</table>
				<table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
					<tr>
						<td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><!-- #BeginEditable "Centro" -->
							<p>&nbsp;</p>
							<p class="TituloTreino" align="center">IP que realizaram Avaliações / Prova</p>
							<table width="80%" border="0" align="center">
								<tr>
									<td><form action="<?=$PAGINA ?>" method="post" name="form" id="form">
											<input type="hidden" name="id_opc" id="id_opc">
											<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
											<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
											<input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>">
											<input type="hidden" name="arquivo_pdf" id="arquivo_pdf" value="<?=$arquivo_pdf ?>">
											<table border="0" cellpadding="0" width="100%">
												<tr>
													<td><table border="1" cellpadding="1" width="100%" cellspacing="1">
															<tr>
																<td class="thTreinamento">Filtros</td>
															</tr>
															<tr>
																<td>M&ecirc;s :
																	<select name="mes" id="mes" class="TXTLOAD">
																		<?
					$selx = array();
					$selx[$mes] = 'selected';
					for ($x=1; $x<13; $x++){
						echo "<option value='$x' ".$selx[$x].">".$mesescrito[$x]."</option>";
					}
				?>
																	</select>
Ano :
<select name="ano" id="ano" class="TXTLOAD">
	<?
																		$selx = array();
																		$selx[$ano] = 'selected';
																		for ($x=COMBOANOINI; $x<COMBOANOFIM; $x++){
																			echo "<option value='$x' ".$selx[$x].">$x</option>";
																		}
																	?>
</select></td>
															</tr>
															</table>
															<br>
															<table border="1" cellpadding="1" width="100%" cellspacing="1">
															<tr>
																<td colspan="6" class="thTreinamento">N&uacute;mero do IP</td>
															</tr>
															<tr>
																<td class="thTreinamento">ID</td>
																<td class="thTreinamento">IP</td>
																<td class="thTreinamento">Tipo de Avalia&ccedil;&atilde;o</td>
																<td class="thTreinamento">Data</td>
																<td class="thTreinamento">Prova</td>
																<td class="thTreinamento"><input type="checkbox" name="Marca" id="Marca" onclick="seleciona(1)" /></td>
															</tr>
<? while ($linha = mysql_fetch_object($result)) { ?>
															<tr>
																<td width="15%" align="right"><?=$linha->id ?>&nbsp;</td>
																<td width="20%"><?=$linha->ip ?></td>
																<td width="33%"><?=$aTipoIp[$linha->tipo] ?></td>
																<td width="15%"><?=$linha->data ?></td>
																<td width="8%" align="right"><?=$linha->codProva ?></td>
																<td width="9%" align="center"><input type="checkbox" name="checkbox[]" value="<?=$linha->id ?>" <?=(($linha->tipo == "P") ? "disabled" : "") ?>/></td>
															</tr>
<? } ?>
														</table></td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>														<input name="Excluir" type="submit" id="excluir" value="Excluir" />
														<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarpara=<?=$linkPagina ?>/></td>
												</tr>
											</table>
										</form></td>
								</tr>
							</table>
							<!-- #EndEditable --></td>
						<td align="right" width="23%" valign="top" ><table width="100%" border="0" class="bgTabela">
								<tr bgcolor="#FFCC33" valign="top">
									<td colspan="2" class="bgTabela"><table width="90%" border="0" align="center">
											<tr valign="top">
												<td valign="top"><table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
														<tr valign="top">
															<td valign="top"><table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaRotulo" height="12"><a href="/corporativo/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Corporativo</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Home</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/a/"><font face="Verdana, Arial, Helvetica, sans-serif">S.A.D</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../corporativo/mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa 
																			do site</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia 
																			M&eacute;dica</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/corporativo/dadosdaempresa.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Dados 
																			da Empresa</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/corporativo/aniversarios/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Anivers&aacute;rios</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes 
																			e Feriados</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/corporativo/fome.htm"><font face="Verdana, Arial, Helvetica, sans-serif">T&ocirc; 
																			com fome</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es 
																			sobre v&iacute;rus</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../colaboradores/index.htm">Colaboradores</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../eventos.htm">Eventos Datamace</a></td>
																	</tr>
																</table></td>
														</tr>
													</table>
													<table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
														<tr valign="top">
															<td><table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="../estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm; 
																			micros</font></a></td>
																	</tr>
																</table></td>
														</tr>
													</table>
													<table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
														<tr valign="top">
															<td><table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaRotulo" valign="top"><a href="../Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" valign="top"><a href="../Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" valign="top"><a href="../Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="/corporativo/ramais.php">Ramais</a></font></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" valign="top"><a href="/corporativo/telefones2.php"><font face="Verdana, Arial, Helvetica, sans-serif">Telefones 
																			&uacute;teis</font></a></td>
																	</tr>
																</table></td>
														</tr>
														<tr valign="top">
															<td><table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaRotulo"><a href="../entretenimento/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Entretenimento</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../entretenimento/filmes/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Videoteca</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../entretenimento/livros/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Biblioteca</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="/entretenimento/enquetes.php"><font face="Verdana, Arial, Helvetica, sans-serif">Enquetes</font></a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../entretenimento/mural.htm">Mural 
																			de an&uacute;ncios</a></td>
																	</tr>
																</table>
																<table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="treinamento.php">Treinamento</a></font></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao" valign="top"><a href="../treinamento">Portal</a></td>
																	</tr>
																</table></td>
														</tr>
														<tr valign="top">
															<td><table width="100%" border="0" class="bgTabela">
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaRotulo"><a href="../Intersystem/index.htm">Intersystem</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../Intersystem/compromisso.htm">Compromisso</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../Intersystem/dadosintersystem.htm">Dados 
																			da empresa</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../Intersystem/missao.htm">Miss&atilde;o</a></td>
																	</tr>
																	<tr bgcolor="#CC9900" bordercolor="#CC9900">
																		<td class="TabelaPadrao"><a href="../Intersystem/servicosclientes.htm">Servi&ccedil;os</a></td>
																	</tr>
																</table></td>
														</tr>
													</table></td>
											</tr>
										</table></td>
								</tr>
							</table></td>
					</tr>
				</table>
				<br>
				<a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> <br>
				<hr align="center">
				<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p></td>
		</tr>
	</table>
</div>
<p align="center">&nbsp;</p>
</body>
<!-- #EndTemplate -->
</html>
