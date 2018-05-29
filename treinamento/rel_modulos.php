<?
//Autor: Lucas Oliveria Silva
//Data: 06/10/09
//Local: Datamace
//Função: Relatório de Módulos

$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

if ($id_opc == '2') {

	$sql = "Select modulos.id, modulos.descricao, sistemas.descricao as sistema from modulos left join sistemas on modulos.cod_sistema = sistemas.id";
	if ($descricao){
		$sql .= " where modulos.descricao like '%$descricao%'";
	}
	$sql .= " order by $ordenar $tipoordem";

	$resultado = mysql_query($sql);

	if (mysql_num_rows($resultado) > 0){

		// Começa o PDF ==============================================================================================================
		define('FPDF_FONTPATH','font/');
		require('../fpdf/rel_pdf_dtm.php');
		
		$pdf = new REL_PDF_DTM();
		$pdf->Open();
		$pdf->FPDF("P","mm","A4");
		
		// começa o relatório ========================================================================================================
		
		$pdf->fun_Vlin($pdf->Vlin_ini);
	
		$pdf->fun_Vsistema('Treinamento');
		$pdf->fun_Vtitulo('Relatório de Módulos');
		$pdf->fun_Vusuario($USRNOME);
		$pdf->fun_Vprogrel($PAGINA);
		$pdf->fun_cabecalho();

		$pdf->SetFont('Arial','B',9);

		if ($descricao){
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(100, $pdf->Vlin_alt,"Filtro: $descricao", 0, "L", 0);
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt*2);
		}

		$pdf->SetXY(6,$pdf->Vlin);
		$pdf->MultiCell(22, $pdf->Vlin_alt,"ID", 1, "C", 0);
		$pdf->SetXY(28,$pdf->Vlin);
		$pdf->MultiCell(87, $pdf->Vlin_alt,"DESCRIÇÃO", 1, "C", 0);
		$pdf->SetXY(115,$pdf->Vlin);
		$pdf->MultiCell(88, $pdf->Vlin_alt,"SISTEMA", 1, "C", 0);
		$pdf->fun_ADD_Vlin($pdf->Vlin_alt);

		while ($linha = mysql_fetch_object($resultado)){
		
			$pdf->SetFont('Arial','',9);
	
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(22, $pdf->Vlin_alt,$linha->id, 1, "R", 0);
			$pdf->SetXY(28,$pdf->Vlin);
			$pdf->MultiCell(87, $pdf->Vlin_alt,$linha->descricao, 1, "L", 0);
			$pdf->SetXY(115,$pdf->Vlin);
			$pdf->MultiCell(88, $pdf->Vlin_alt,$linha->sistema, 1, "L", 0);
	
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt);
	
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
$seltipoordem[$tipoordem]	= 'selected';
$selordenar[$ordenar]		= 'selected';
$seltotaliza[$totaliza]		= 'selected';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script language="JavaScript" src="numero.js" type="text/javascript"></script>
<script>
	var a_fields = {
		'descricao':{'r':false}
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
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif
}
.style43 {
	font-size: 10px
}
.style45 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #CCCCCC;
}
.style47 {
	color: #006699;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style48 {
	color: #006699;
	font-weight: bold;
}
.style52 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form action="<?=$PAGINA ?>" method="post" name="form" id="form">
	<input type="hidden" name="id_opc" id="id_opc">
	<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
	<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
	<input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>">
	<input type="hidden" name="arquivo_pdf" id="arquivo_pdf" value="<?=$arquivo_pdf ?>">
	<table width="100%" border="0">
		<tr>
			<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
		</tr>
		<tr>
			<td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><strong><span class="style8">Gerar Relat&oacute;rio de M&oacute;dulos </span></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table width="100%" border="1">
					<tr>
						<th align="left"><table width="100%" border="0" align="center">
								<tr>
									<th colspan="2" class="thTreinamento" class="style47">Filtro</th>
								</tr>
								<tr>
									<td width="15%" class="style4" id="e_descricao">Descri&ccedil;&atilde;o :</td>
									<td><input name="descricao" type="text" class="style4" id="descricao" value="<?=$descricao ?>" size="50" /></td>
								</tr>
								<tr>
									<th colspan="2" class="thTreinamento" class="style47">Op&ccedil;&otilde;es</th>
								</tr>
								<tr>
									<td class="style4">Ordernar por : </td>
									<td><select name="ordenar" class="style4" id="ordenar">
											<option value="modulos.id" <?=$selordenar["modulos.id"] ?>>ID</option>
											<option value="modulos.descricao" <?=$selordenar["modulos.descricao"] ?>>Descrição</option>
											<option value="sistemas.descricao" <?=$selordenar["sistemas.descricao"] ?>>Sistema</option>
										</select></td>
								</tr>
								<tr>
									<td class="style4">Ordem : </td>
									<td><select name="tipoordem" class="style4" id="tipoordem">
											<option value="asc" <?=$seltipoordem["asc"] ?>>Crescente</option>
											<option value="desc" <?=$seltipoordem["desc"] ?>>Decrescente</option>
										</select></td>
								</tr>
								<tr>
									<td class="style4">Totaliza&ccedil;&atilde;o :</td>
									<td><select name="totaliza" class="style4" id="totaliza">
											<option value="S" <?=$seltotaliza["S"] ?>>Sim</option>
											<option value="N" <?=$seltotaliza["N"] ?>>Não</option>
										</select></td>
								</tr>
							</table></th>
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
				<input name="BTNVoltarr" id="BTNVoltarr" type="button" onclick="window.location='<?=$linkPagina ?>'" value="Voltar" /></td>
		</tr>
		<tr>
			<td><hr /></td>
		</tr>
		<tr>
			<td><table width="100%" border="0">
					<tr>
						<td><span class="style45">Datamace Inform&aacute;tica Ltda. </span></td>
					</tr>
				</table></td>
		</tr>
	</table>
</form>
<? if ($msg) echo "<script>alert('$msg')</script>"; ?>
</body>
</html>
