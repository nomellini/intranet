<?
//Autor: Lucas Oliveria Silva
//Data: 06/10/09
//Local: Datamace
//Função: Relatório de Módulos

$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

if ($id_opc == '2') {

	if ($tipoRel == 'T'){
		$sql = "Select nome as nome ".
				" ,cargo ".
				" ,substr(empnome,1,26) as empnome ".
				" ,email ".
				" ,MD.descricao as modulo ".
				" ,date_format(data,'%d/%m/%Y') as data".
				" from treinamento.tre_usuario as TR".
				" inner join treinamento.cadastrotreinamento as CT on TR.rg = CT.rg ".
				" inner join treinamento.modulos as MD on TR.modulo = MD.id ";
		$dataNome = "data";
	}else{
		$sql = "Select nome, cargo, substr(empnome,1,26) as empnome, email from treinamento.cadastrotreinamento";
		$dataNome = "hoje";
	}
	$condicoes[] = (($cargo) ? "cargo like '%$cargo%'" : "");
	$condicoes[] = (($empNome) ? "empnome like '%$empNome%'" : "");
	if ($data_de && $data_ate){
		$condicoes[] = "$dataNome between '".resolveData($data_de)."' and '".resolveData($data_ate) ."'";
	}elseif ($data_de){
		$condicoes[] = "$dataNome = '".resolveData($data_de)."'";
	}elseif ($data_ate){
		$condicoes[] = "$dataNome = '".resolveData($data_ate)."'";
	}
	$condicoes[] = (($filtradesenv != "S") ? "empnome <> 'DESENVOLVIMENTO PROFISSIONAL'" : "");
	$sql .= montaWhere($condicoes) . " order by $ordenar $tipoordem";
	mysql_set_charset("latin1", $link);
	$resultado = mysql_query($sql);

	if (mysql_num_rows($resultado) > 0){

		// Começa o PDF ==============================================================================================================
		$pdf = new REL_PDF_DTM();
		$pdf->Open();
		$pdf->FPDF("L","mm","A4");

		// começa o relatório ========================================================================================================

		$pdf->fun_Vlin($pdf->Vlin_ini);

		$pdf->fun_Vsistema('Treinamento');

		$str = 'Relatório de '.(($tipoRel == 'T') ? 'treinamentos realizados' : 'treinados');
		$pdf->fun_Vtitulo($str);
		$pdf->fun_Vusuario($USRNOME);
		$pdf->fun_Vprogrel($PAGINA);
		$pdf->fun_cabecalho();

		$pdf->SetFont('Arial','B',9);

		if ($cargo){
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(100, $pdf->Vlin_alt,"Filtro: $cargo", 0, "L", 0);
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt*2);
		}

		$x1 = 6;
		$col1 = (($tipoRel == 'T') ? 70 : 77);

		$x2 = $x1 + $col1;
		$col2 = 47;

		$x3 = $x2 + $col2;
		$col3 = (($tipoRel == 'T') ? 52 : 82);

		$x4 = $x3 + $col3;
		$col4 = (($tipoRel == 'T') ? 58 : 76);

		$x5 = $x4 + $col4;
		$col5 = 40;

		$x6 = $x5 + $col5;
		$col6 = 18;

		$vArrayWidth	= array($col1,$col2,$col3,$col4);
		if ($tipoRel == 'T'){
			$vArrayWidth[]	= $col5;
			$vArrayWidth[]	= $col6;
		}

		$pdf->SetXY($x1,$pdf->Vlin);
		$pdf->MultiCell($col1, $pdf->Vlin_alt,"NOME", 1, "C", 0);

		$pdf->SetXY($x2,$pdf->Vlin);
		$pdf->MultiCell($col2, $pdf->Vlin_alt,"EMPRESA", 1, "C", 0);

		$pdf->SetXY($x3,$pdf->Vlin);
		$pdf->MultiCell($col3, $pdf->Vlin_alt,"CARGO", 1, "C", 0);

		$pdf->SetXY($x4,$pdf->Vlin);
		$pdf->MultiCell($col4, $pdf->Vlin_alt,"EMAIL", 1, "C", 0);

		if ($tipoRel == 'T'){
			$pdf->SetXY($x5,$pdf->Vlin);
			$pdf->MultiCell($col5, $pdf->Vlin_alt,"MÓDULO", 1, "C", 0);

			$pdf->SetXY($x6,$pdf->Vlin);
			$pdf->MultiCell($col6, $pdf->Vlin_alt,"DATA", 1, "C", 0);
		}

		$pdf->fun_ADD_Vlin($pdf->Vlin_alt);

		while ($linha = mysql_fetch_object($resultado)){

			if ($filtraemail){
				$emailVal = validateMail($linha->email);
				if ((($emailVal) && ($filtraemail == 'I')) ||
					((!$emailVal) && ($filtraemail == 'V'))){
					continue;
				}
			}

			$pdf->SetFont('Arial','',8);

			$vArrayDados	= array($linha->nome,$linha->empnome,$linha->cargo,$linha->email);
			if ($tipoRel == 'T'){
				$vArrayDados[] = $linha->modulo;
				$vArrayDados[] = $linha->data;
			}
			$vLins = $pdf->Vlin_alt * $pdf->checkNumLinhas($vArrayWidth, $vArrayDados);

			$pdf->MultiCellHeight($x1,$pdf->Vlin, $col1, $vLins,$linha->nome, 1, "L", 0);
			$pdf->MultiCellHeight($x2,$pdf->Vlin, $col2, $vLins,$linha->empnome, 1, "L", 0);
			$pdf->MultiCellHeight($x3,$pdf->Vlin, $col3, $vLins,$linha->cargo, 1, "L", 0);
			$pdf->MultiCellHeight($x4,$pdf->Vlin, $col4, $vLins,$linha->email, 1, "L", 0);
			if ($tipoRel == 'T'){
				$pdf->MultiCellHeight($x5,$pdf->Vlin, $col5, $vLins,$linha->modulo, 1, "L", 0);
				$pdf->MultiCellHeight($x6,$pdf->Vlin, $col6, $vLins,$linha->data, 1, "C", 0);
			}
			$pdf->fun_ADD_Vlin($vLins);

			$cont++;

		}

		$pdf->SetFont('Arial','B',9);

		if ($totaliza == 'S'){
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt);
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(100, $pdf->Vlin_alt,"Total de Registro(s): $cont", 0, "L", 0);
		}

		$arquivo_pdf = "temp/". str_replace('.php','',$PAGINA).$v_id_usuario.date('dmsB').".pdf";
		$linkRel = "<script>AbreRelatorio('".$pdf->Vtitulo."');</script><a href='#' onclick='AbreRelatorio(\"".$pdf->Vtitulo."\")'>Clique aqui para abrir o relatório</a>";
		$pdf->Output("$arquivo_pdf","F");
		$pdf->close();
	}

}

$seltipoordem[$tipoordem]		= 'selected';
$seltotaliza[$totaliza]			= 'selected';
$selfiltraemail[$filtraemail]	= 'selected';
$seltipoRel[$tipoRel]			= 'selected';

?>

<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<link rel="stylesheet" href="../scripts/jquery.autocomplete.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" src="../scripts/jquery.autocomplete.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script>

	var a_fields = {
		'cargo':{'r':false}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		$("#ordem option").each(function(i){
			$("#ordenar")[0].value = $("#ordenar")[0].value + (($("#ordenar")[0].value) ? ", " : "") + $(this).val();
		});
		return true;
	}

$(document).ready(function () {
	$('#down').live('click', function (event) {
		var selectedOption = $('#ordem > option:selected');
		var nextOption = $('#ordem > option:selected').next("option");
		if ($(nextOption).text() != "") {
			$(selectedOption).remove();
			$(nextOption).after($(selectedOption));
		}
	});

	$('#up').live('click', function (event) {
		var selectedOption = $('#ordem option:selected');
		var prevOption = $('#ordem option:selected').prev("option");
		if ($(prevOption).text() != "") {
			$(selectedOption).remove();
			$(prevOption).before($(selectedOption));
		}
	});
});

</script>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 18px; font-weight: normal; font-family: Verdana, Arial, Helvetica, sans-serif;color: #FFFFFF;}
.style3 {color: #000099}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
  <table width="100%" border="0">
    <tr>
      <td>
        <table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC38" class="bgTabela" bordercolor="#FF0000">
          <tr align="center" valign="middle">
            <td width="17%"> <div align="center" class="style1">
              <div align="left"><a href="http://www.datamace.com.br"><img src="../imagens/novologo.jpg" width="155" height="41" border="0">
                </a></div>
            </div></td>
            <td width="60%" valign="middle"> <p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet
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
								<input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>">
								<input type="hidden" name="id_opc" id="id_opc">
								<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
								<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
								<input type="hidden" name="ordenar" id="ordenar">
								<input type="hidden" name="arquivo_pdf" id="arquivo_pdf" value="<?=$arquivo_pdf ?>">
								<table width="100%" border="0">
									<tr>
										<td width="100%" align="center">&nbsp;</td>
									</tr>
									<tr>
										<td align="center" class="TituloTreino">Gerar Relat&oacute;rio de Treinados</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><table width="100%" border="0" align="center">
												<tr>
													<td colspan="3" class="thTreinamento">Filtro</td>
												</tr>
												<tr>
													<td>Empresa:</td>
													<td colspan="2"><input name="empNome" type="text" id="empNome" value="<?=$empNome ?>" size="50" /></td>
												</tr>
												<tr>
													<td width="32%" id="e_cargo">Cargo :</td>
													<td colspan="2"><input name="cargo" type="text" id="cargo" value="<?=$cargo ?>" size="50" /></td>
												</tr>
												<tr>
													<td id="e_filtraemail">Email :</td>
													<td colspan="2"><select name="filtraemail" id="filtraemail">
															<option value="" <?=$selfiltraemail[""] ?>>Todos</option>
															<option value="V" <?=$selfiltraemail["V"] ?>>Válidos</option>
															<option value="I" <?=$selfiltraemail["I"] ?>>Inválidos</option>
														</select></td>
												</tr>
												<tr>
													<td id="e_filtraemail">Per&iacute;odo :</td>
													<td colspan="2"><input type="text" name="data_de" id="data_de" value="<?=$data_de ?>" class="TXTDATE" calendario="S">
														at&eacute;
														<input type="text" name="data_ate" id="data_ate" value="<?=$data_ate ?>" class="TXTDATE" calendario="S"></td>
												</tr>
												<tr>
													<td id="e_filtradesenv">Desenvolvimento Profissional?</td>
													<td colspan="2"><? fun_select($aSN,$filtradesenv,'filtradesenv') ?></td>
												</tr>
												<tr>
													<td colspan="3" class="thTreinamento">Op&ccedil;&otilde;es</td>
												</tr>
												<tr>
													<td>Orderna&ccedil;&atilde;o : </td>
													<td width="11%"><select id="ordem" name="ordem" multiple="multiple" style="height:70px" >
															<option value="empnome">Empresa</option>
															<option value="nome">Nome</option>
															<option value="cargo">Cargo</option>
															<option value="email">Email</option>
														</select></td>
													<td width="57%" valign="top"><table>
															<tr>
																<td><input type="button" id="up" value="Up"></td>
															</tr>
															<tr>
																<td><input type="button" id="down" value="Down"></td>
															</tr>
														</table></td>
												</tr>
												<tr>
													<td>Ordem : </td>
													<td colspan="2"><select name="tipoordem" id="tipoordem">
															<option value="asc" <?=$seltipoordem["asc"] ?>>Crescente</option>
															<option value="desc" <?=$seltipoordem["desc"] ?>>Decrescente</option>
														</select></td>
												</tr>
												<tr>
													<td>Totaliza&ccedil;&atilde;o :</td>
													<td colspan="2"><select name="totaliza" id="totaliza">
															<option value="S" <?=$seltotaliza["S"] ?>>Sim</option>
															<option value="N" <?=$seltotaliza["N"] ?>>Não</option>
														</select></td>
												</tr>
												<tr>
													<td>Tipo de Relat&oacute;rio ?</td>
													<td colspan="2"><select name="tipoRel" id="tipoRel">
														<option value="" <?=$seltipoRel[""] ?>>Treinandos</option>
														<option value="T" <?=$seltipoRel["T"] ?>>Treinamentos</option>
													</select></td>
												</tr>
											</table></td>
									</tr>
									<? if ($arquivo_pdf){ ?>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><?=$linkRel ?></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<? } ?>
									<tr>
										<td><input name="BTNGravar" id="BTNGravar" type="button" value="Gerar" />
											&nbsp;
											<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/></td>
									</tr>
								</table>
							</form>
							<!-- #EndEditable --></td>
            <td align="right" width="23%" valign="top" >
              <table width="100%" border="0" class="bgTabela">
                <tr bgcolor="#FFCC33" valign="top">
                  <td colspan="2" class="bgTabela">
                    <table width="90%" border="0" align="center">
                      <tr valign="top">
                        <td valign="top">
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td valign="top">
                                <table width="100%" border="0" class="bgTabela">
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
                                    <td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a>                                    </td>
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
                               </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td>
                                <table width="100%" border="0" class="bgTabela">
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
                                </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                           <tr valign="top">
                             <td> <table width="100%" border="0" class="bgTabela">
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
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a>
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999">
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
      </td>
    </tr>
  </table>
</div>
</body>
<!-- #EndTemplate --></html>
