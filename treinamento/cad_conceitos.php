<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

if ($id_opc == '2') {

		$result			= mysql_query("select * from conceitos where con_id = $con_id"); 
		$prova_ok		= mysql_num_rows($result);
		
		if ($prova_ok > 0){
			$msgok = 'U';
			$sSQL = "UPDATE conceitos set con_descricao='$con_descricao' ".
					" ,con_desc_administrador = '$con_desc_administrador'".
					" ,con_administrador = $con_administrador".
					" ,con_desc_operador = '$con_desc_operador'".
					" ,con_operador = $con_operador".
					" ,con_desc_basico = '$con_desc_basico'".
					" ,con_basico = $con_basico".
					" where con_id = $con_id";
		}else{
			$msgok = 'I';
			$sSQL = "INSERT into conceitos (con_id, con_descricao, con_desc_administrador, con_administrador, con_desc_operador, con_operador, con_desc_basico, con_basico) ".
					" VALUES ".
					" ('$con_id', '$con_descricao', '$con_desc_administrador', $con_administrador, '$con_desc_operador', $con_operador, '$con_desc_basico', $con_basico)";
		}
		mysql_query($sSQL);

		$id_opc = '1';

}elseif ($id_opc == '3') {
	$result		= mysql_query("delete from conceitos where con_id = $con_id");
	$msgok		= 'E';
	$con_id		= '';
}elseif ($id_opc == '99') {
	$con_id		= '';
}

if ($id_opc == '1') {
	$result				= mysql_query("select * from conceitos where con_id = $con_id"); 
	if (mysql_num_rows($result) > 0){
		$linha					= mysql_fetch_object($result);
		$con_id					= $linha->con_id;   
		$con_descricao			= $linha->con_descricao;
		$con_desc_administrador	= $linha->con_desc_administrador;
		$con_administrador		= $linha->con_administrador;
		$con_desc_operador		= $linha->con_desc_operador;
		$con_operador			= $linha->con_operador;
		$con_desc_basico		= $linha->con_desc_basico;
		$con_basico				= $linha->con_basico;
	}else{
		$con_id					= '';
	}
}

if (!$con_id){
	$result					= mysql_query("select (max(con_id) + 1) as novo from conceitos");
	$linha					= mysql_fetch_object($result);
	$con_id					= $linha->novo;
	$con_descricao			= '';
	$con_desc_administrador	= 'Adm';
	$con_administrador		= '';
	$con_desc_operador		= 'Operador';
	$con_operador			= '';
	$con_desc_basico		= 'Básico';
	$con_basico				= '';
}

$selcod_prova[$tre_cod_prova] = "selected";

?>
<html>
<!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Datamace Informática</title>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script>

	var a_fields = {
		'con_id':{'r':true,'f':'integer'},
		'con_descricao':{'r':true},
		'con_desc_administrador':{'r':true,'t':'e_con_administrador'},
		'con_administrador':{'r':true},
		'con_desc_operador':{'r':true,'t':'e_con_operador'},
		'con_operador':{'r':true},
		'con_desc_basico':{'r':true,'t':'e_con_basico'},
		'con_basico':{'r':true}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		return true;
	}

</script>
<style type="text/css">
<!--
body {
	color: #454545;
	font: 62.5% Verdana, Arial, Helvetica, sans-serif;
}
a:link, body_alink, a:visited, body_avisited {
	text-decoration:none;
}
a:hover, a:active, body_ahover {
	text-decoration:none;
}
input, td, th, p, li, select, body, option, optgroup {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	font-weight:normal;
	text-decoration:none;
	color: #000066;
}
.Tituloconceitos {
	font-weight: bold;
	color: #4A93B6;
	font-size:16px;
}
.style6 {
	color: #FFFFFF;
	font-weight: bold;
}
.tfvHighlight {
	color:#F00;
	font-weight:bold;
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
							<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form" id="form" >
								<input type="hidden" name="id_opc" id="id_opc">
								<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
								<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
								<p>&nbsp;</p>
								<p class="Tituloconceitos" align="center">Cadastro de Conceitos</p>
								<table width="100%" border="0" align="center">
									<tr>
										<td width="124" id="e_con_id">C&oacute;digo :</td>
										<td colspan="2" id="e_con_id"><input name="con_id" type="text" id="con_id" value="<?=$con_id ?>" size="11" maxlength="10" class="TXTINT TXTLOAD" help="conceitos" helpid_opc="1"></td>
									</tr>
									<tr>
										<td id="e_con_descricao">Treinamento :</td>
										<td colspan="2" id="e_con_descricao"><input name="con_descricao" type="text" id="con_descricao" value="<? echo $con_descricao ?>" size="50" maxlength="50" pri_focu="S"></td>
									</tr>
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">Conceito de Notas</td>
									</tr>
									<tr>
										<td id="e_con_administrador2">&nbsp;</td>
										<td>T&iacute;tulo</td>
										<td>Nota</td>
									</tr>
									<tr>
										<td id="e_con_administrador">Administrador:</td>
										<td width="50"><input name="con_desc_administrador" type="text" id="con_desc_administrador" value="<?=$con_desc_administrador ?>" size="10" maxlength="10"></td>
										<td width="531"><input name="con_administrador" type="text" id="con_administrador" value="<?=$con_administrador ?>" size="3" maxlength="2" class="TXTINT"></td>
									</tr>
									<tr>
										<td id="e_con_operador">Operador:</td>
										<td><input name="con_desc_operador" type="text" id="con_desc_operador" value="<?=$con_desc_operador ?>" size="10" maxlength="10"></td>
										<td><input name="con_operador" type="text" id="con_operador" value="<?=$con_operador ?>" size="3" maxlength="2" class="TXTINT"></td>
									</tr>
									<tr>
										<td id="e_con_basico">B&aacute;sico:</td>
										<td><input name="con_desc_basico" type="text" id="con_desc_basico" value="<?=$con_desc_basico ?>" size="10" maxlength="10"></td>
										<td><input name="con_basico" type="text" id="con_basico" value="<?=$con_basico ?>" size="3" maxlength="2" class="TXTINT"></td>
									</tr>
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">Obs: Se nota menor que &quot;B&aacute;sico&quot; ser&aacute; reprovado</td>
									</tr>
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3"><input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
											&nbsp;
											<input name="BTNExcluir" type="button" id="BTNExcluir" value="Excluir" />
											&nbsp;
											<input name="BTNNovo" type="button" id="BTNNovo" value="Novo" />
											&nbsp;
											<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/></td>
									</tr>
								</table>
							</form>
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
