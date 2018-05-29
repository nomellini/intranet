<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

if ($id_opc == '2') {

		$result			= mysql_query("select * from perguntas where id = $per_id"); 
		$prova_ok		= mysql_num_rows($result);
		
		$per_descricao	= strtoupper($per_descricao);
		$per_opcao_a    = strtoupper($per_opcao_a);
		$per_opcao_b    = strtoupper($per_opcao_b);
		$per_opcao_c    = strtoupper($per_opcao_c);
		$per_opcao_d    = strtoupper($per_opcao_d);
		$per_resp		= strtoupper($per_resp);
		$per_sistema	= strtoupper($per_sistema);  	
		
		if ($prova_ok > 0){
			$msgok = 'U';
			$sSQL = "UPDATE perguntas set descricao='$per_descricao', opcao_a='$per_opcao_a', opcao_b='$per_opcao_b', opcao_c='$per_opcao_c', opcao_d='$per_opcao_d', resp='$per_resp', sistema='$per_sistema' where id = $per_id;";
		}else{
			$msgok = 'I';
			$sSQL = "INSERT into perguntas  (id, descricao, opcao_a , opcao_b, opcao_c, opcao_d, resp, sistema) VALUES ('$per_id', '$per_descricao','$per_opcao_a', '$per_opcao_b', '$per_opcao_c', '$per_opcao_d', '$per_resp', '$per_sistema');";
		}
		mysql_query($sSQL);

		$id_opc = '1';

}elseif ($id_opc == '3') {
	$result		= mysql_query("delete from perguntas where id = $per_id");
	$msgok		= 'E';
	$per_id		= '';
}elseif ($id_opc == '99') {
	$per_id		= '';
}

if ($id_opc == '1') {
	$result				= mysql_query("select * from perguntas where id = $per_id"); 
	if (mysql_num_rows($result) > 0){
		$linha			= mysql_fetch_object($result);
		$per_descricao	= $linha->descricao; 
		$per_opcao_a	= $linha->opcao_a;
		$per_opcao_b	= $linha->opcao_b;
		$per_opcao_c	= $linha->opcao_c;
		$per_opcao_d	= $linha->opcao_d;
		$per_resp		= $linha->resp;
		$per_sistema	= $linha->sistema;
	}else{
		$per_id			= '';
	}
}

if (!$per_id){
	$result			= mysql_query("select (max(id) + 1) as novo from perguntas");
	$linha			= mysql_fetch_object($result);
	$per_id			= $linha->novo;
	$per_descricao	= '';
	$per_opcao_a    = '';
	$per_opcao_b    = '';
	$per_opcao_c    = '';
	$per_opcao_d    = '';
	$per_resp		= '';
	$per_sistema	= '';
}

$SistemasID = array();
$SistemasID[''] = "Selecione";
$result	= mysql_query("select id, descricao from provas");
while ($linha = mysql_fetch_object($result)){
	$SistemasID[$linha->id] = $linha->descricao;
}

$check_resp[$per_resp] = "checked";
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
		'per_id':{'r':true},
		'per_descricao':{'r':true},
		'per_opcao_a':{'r':true},
		'per_opcao_b':{'r':true},
		'per_opcao_c':{'r':false},
		'per_opcao_d':{'r':false},
		'per_resp':{'r':true},
		'per_sistema':{'r':true,'f':'integer'}
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
.TituloTreino {
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
								<p class="TituloTreino" align="center">Cadastro de Perguntas</p>
								<table width="100%" border="0" align="center">
									<tr>
										<td width="86" id="e_per_id">C&oacute;digo:</td>
										<td><input name="per_id" type="text" id="per_id" value="<? echo $per_id ?>" size="10" maxlength="10" class="TXTINT TXTLOAD" help="perguntas" helpid_opc="1" pri_focu="S"></td>
										<td id="e_per_resp">Resposta Correta</td>
									</tr>
									<tr>
										<td width="86" id="e_per_descricao">Pergunta:</td>
										<td width="425"><input name="per_descricao" type="text" id="per_descricao" value="<? echo $per_descricao ?>" size="70" ></td>
										<td width="425">&nbsp;</td>
									</tr>
									<tr>
										<td width="86" id="e_per_opcao_a">Op&ccedil;&atilde;o A :</td>
										<td><input name="per_opcao_a" type="text" id="per_opcao_a" value="<? echo $per_opcao_a ?>" size="70" /></td>
										<td><input type="radio" name="per_resp" id="per_resp" value="A" <?=$check_resp['A'] ?>></td>
									</tr>
									<tr>
										<td width="86" id="e_per_opcao_b">Op&ccedil;&atilde;o B :</td>
										<td><input name="per_opcao_b" type="text" id="per_opcao_b" value="<? echo $per_opcao_b ?>" size="70" /></td>
										<td><input type="radio" name="per_resp" id="per_resp" value="B" <?=$check_resp['B'] ?>></td>
									</tr>
									<tr>
										<td width="86" id="e_per_opcao_c">Op&ccedil;&atilde;o C :</td>
										<td><input name="per_opcao_c" type="text" id="per_opcao_c" value="<? echo $per_opcao_c ?>" size="70" /></td>
										<td><input type="radio" name="per_resp" id="per_resp" value="C" <?=$check_resp['C'] ?>></td>
									</tr>
									<tr>
										<td width="86" id="e_per_opcao_d">Op&ccedil;&atilde;o D :</td>
										<td><input name="per_opcao_d" type="text" id="per_opcao_d" value="<? echo $per_opcao_d ?>" size="70" /></td>
										<td><input type="radio" name="per_resp" id="per_resp" value="D" <?=$check_resp['D'] ?>></td>
									</tr>
									<tr>
										<td id="e_per_sistema">Sistema:</td>
										<td colspan="2"><?=fun_select($SistemasID,$per_sistema,'per_sistema') ?></td>
									</tr>
									<tr>
										<td colspan="3" valign="bottom">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3" valign="bottom"><input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
											&nbsp;
											<input name="BTNExcluir" type="button" id="BTNExcluir" value="Excluir" />
											&nbsp;
											<input name="BTNNovo" type="button" id="BTNNovo" value="Novo" />
											&nbsp;
											<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/></td>
									</tr>
								</table>
							</form>
<hr>
							<table width="100%" border="0">
								<tr>
									<td width="86%"><span class="style45">Datamace Inform&aacute;tica Ltda. </span></td>
									<td width="14%"><span class="style4">
										<?=FORMULARIO_10 ?>
										</span></td>
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
