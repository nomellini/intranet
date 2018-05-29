<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

if (!$agrupamento) $agrupamento = 'P';
if (!$flagTipo) $flagTipo = 2;

$selOrdenaEmp['S'] = 'checked';
$selAgrupamento[$agrupamento] = 'selected';
$selflagTipo[$flagTipo] = 'selected';

$db = new DB();

?>
<html>
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
table {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style1 {
	color: #FFFFFF;
	background-color:#006699;
	vertical-align:middle;
}
</style>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<div align="center">
	<p>Comparativo de Assimila&ccedil;&atilde;o do Treinamento</p>
</div>
<form method="post" action="ver_gipte.php" name="form" id="form">
	<input type="hidden" name="id" value="<? echo $id ?>" />
	<input type="hidden" name="id_opc" id="id_opc">
	<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
	<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
	<table width="100%" border="1">
		<tr bgcolor="#D7FFFF">
			<th colspan="4" class="style1">Selecione os filtros para emiss&atilde;o das Avalia&ccedil;&otilde;es do treinamento</th>
		</tr>
		<tr>
			<td align="right">Prova :</td>
			<td colspan="3"><?=$db->comboBox("Select id, descricao from provas ", $prova, "prova","","Todas","onchange='document.form.submit()'") ?></td>
		</tr>
		<tr>
			<td align="right">Grupo :</td>
			<td colspan="3"><?=$db->comboBox("select id, descricao from provas where agrupamento_id = 0", $grupo, "grupo","","Todos","onchange='document.form.submit()'") ?></td>
		</tr>
		<tr>
			<td width="24%" align="right">M&ecirc;s :</td>
			<td width="19%"><select name="mes" id="mes"  onchange="document.form.submit()">
					<?
					$selx = array();
					$selx[$mes] = 'selected';
					for ($x=1; $x<13; $x++){
						echo "<option value='$x' ".$selx[$x].">".$mesescrito[$x]."</option>";
					}
				?>
				</select></td>
			<td width="20%" align="right">Ano :</td>
			<td width="37%"><select name="ano" id="ano" onChange="document.form.submit()">
					<?
																		$selx = array();
																		$selx[$ano] = 'selected';
																		for ($x=COMBOANOINI; $x<COMBOANOFIM; $x++){
																			echo "<option value='$x' ".$selx[$x].">$x</option>";
																		}
																	?>
				</select></td>
		</tr>
		<tr>
			<td align="right">Agrupamento:</td>
			<td><select name="agrupamento" id="agrupamento" onChange="document.form.submit()">
					<option value='P' <?=$selAgrupamento['P'] ?>>Prova</option>
					<option value='T' <?=$selAgrupamento['T'] ?>>Treinando</option>
				</select></td>
			<td align="right">Ordena por Empresa:</td>
			<td><input type="checkbox" name="ordenaEmp" <?=$selOrdenaEmp[$ordenaEmp] ?> value="S" onClick="document.form.submit();"></td>
		</tr>
		<tr>
		  <td align="right">Tipo :</td>
		  <td><select name="flagTipo" id="flagTipo" onChange="document.form.submit()">
		    <option value='2' <?=$selflagTipo['2'] ?>>Interno - Cliente</option>
		    <option value='3' <?=$selflagTipo['3'] ?>>Externo</option>
	      </select></td>
		  <td align="right">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="0">
		<tr>
			<td width="100%"><? if ($mes && $ano){ ?>
				<?
if ($ordenaEmp) $ordem = " empnome, ";

if ($agrupamento == 'P'){
	
	$sSQL = "Select id, descricao, conceito_id from provas";
	$condicoes[] = (($prova) ? "id = '$prova'" : "");
	$condicoes[] = (($grupo) ? "(agrupamento_id = '$grupo' or id = '$grupo')" : "");
	$sSQL .= montaWhere($condicoes);
	$resCodProva	= mysql_query($sSQL);
	
	while ($codProva = mysql_fetch_object($resCodProva)) {
	
		$data = new treinamento("");
		$data->tipo = $flagTipo; // externo
		$data->materia = $codProva->id;
		$data->mes = $mes;
		$data->ano = $ano;
		$data->dataAnoComp = false;
		$data->ver_data();

		$aConceito = $db->getConceitos($codProva->conceito_id);
		$aConceito[""] = "&nbsp;";

		if (!$data->data1_f && !$data->data2_f) continue;

		if ($x++ > 1){
			echo "</table><br>";
		}
?>
				<table border="1" width="100%">
					<tr class="style1">
						<th colspan="10"><?=$codProva->id . ' - ' . $codProva->descricao ?></th>
					</tr>
					<tr class="style1">
						<th>Qtd.</th>
						<th>Empresa</th>
						<th>Nome</th>
						<th width="6%">Quest&otilde;es</th>
						<th width="5%"><?=substr($data->data1_f,0,strrpos($data->data1_f,'/')) ?></th>
						<th width="7%">Conceito 1</th>
						<th width="5%"><?=substr($data->data2_f,0,strrpos($data->data2_f,'/')) ?></th>
						<th width="7%">Conceito 2</th>
						<th width="5%">%</th>
						<th width="4%">Obs.</th>
					</tr>
					<?

		$sSQL = "SELECT distinct respostas.rg as rg, cadastrotreinamento.empnome as empnome, cadastrotreinamento.nome as nome FROM respostas ";
		$sSQL .= " left join cadastrotreinamento on respostas.rg = cadastrotreinamento.rg ";
		$sSQL .= " where month(dataprova) = " . $mes;
		$sSQL .= " and year(dataprova) = " . $ano;
		$sSQL .= " and cod_prova = " . $codProva->id;
		$sSQL .= " and flagTipo = " . $flagTipo;
		$sSQL .= " order by $ordem nome, cod_prova ";
		$result = mysql_query($sSQL);
	
		$cont = 0;
	
		while ($aResp = mysql_fetch_object($result)) {
	
			$PTO = new treinamento("");
			$PTO->tipo = $flagTipo; // externo
			$PTO->rg = $aResp->rg;
			$PTO->materia = $codProva->id;
			$PTO->mes = $mes;
			$PTO->ano = $ano;
			$PTO->ver_resultados();
			$vConceito1 = $PTO->verifica_conceitoValor($PTO->id_prova_1, $PTO->aproveitamento1);
			$vConceito2 = $PTO->verifica_conceitoValor($PTO->id_prova_2, $PTO->aproveitamento2);

			$link_1 = ($PTO->id_prova_1 ? "<a href='result_gip.php?id_resp=" . $PTO->id_prova_1 ."&id=" . $codProva->id . "'>" . $PTO->qtd_acertos_1 . "</a>" : "&nbsp;");
			$link_2 = ($PTO->id_prova_2 ? "<a href='result_gip.php?id_resp=" . $PTO->id_prova_2 ."&id=" . $codProva->id . "'>" . $PTO->qtd_acertos_2 . "</a>" : "&nbsp;");

?>
					<tr>
						<td align="center"><?=++$cont ?></td>
						<td><?=$aResp->empnome ?></td>
						<td><?=$aResp->nome ?></td>
						<td align="center"><?=$PTO->qtd_perguntas ?></td>
						<td align="right"><?=$link_1 ?></td>
						<td><?=$aConceito[$vConceito1] ?></td>
						<td align="right"><?=$link_2 ?></td>
						<td><?=$aConceito[$vConceito2] ?></td>
						<td align="right"><?=number_format($PTO->aproveitamento2,2,',','.') ?></td>
						<td align="center"><?=(($PTO->obs != $PTO->obsNull) ? "<img src='imagens\Exclamation-32.png' width='16' height='16' title='".$PTO->obs."'" : $PTO->obs) ?></td>
					</tr>
					<?
		
			}

		}
?>
				</table>
				<?
	}elseif($agrupamento == 'T'){

		$sSQL = "SELECT distinct respostas.rg as rg, cadastrotreinamento.empnome as empnome, cadastrotreinamento.nome as nome FROM respostas ";
		$sSQL .= " left join cadastrotreinamento on respostas.rg = cadastrotreinamento.rg ";
		$sSQL .= " where month(dataprova) = " . $mes;
		$sSQL .= " and year(dataprova) = " . $ano;
		$sSQL .= " and flagTipo = " . $flagTipo;
		$sSQL .= " order by $ordem nome, cod_prova ";
		$result = mysql_query($sSQL);

		while ($aResp = mysql_fetch_object($result)) {
		
			if ($x++ > 1){
				echo "</table><br>";
			}
	
?>
				<table border="1" width="100%">
					<tr class="style1">
						<th width="20%" align="right">Nome:</th>
						<th colspan="11" align="left"><?=$aResp->nome ?></th>
					</tr>
					<tr class="style1">
						<th align="right">Empresa:</th>
						<th colspan="11" align="left"><?=$aResp->empnome ?></th>
					</tr>
					<?

		$sSQL	= "Select id, descricao, conceito_id from provas " . (($prova) ? "where id = " . $prova : "");
		$resCodProva = mysql_query($sSQL);
	
		$cont = 0;

		while ($codProva = mysql_fetch_object($resCodProva)) {

			$data = new treinamento("");
			$data->tipo = $flagTipo;
			$data->materia = $codProva->id;
			$data->mes = $mes;
			$data->ano = $ano;
			$data->dataAnoComp = false;
			$data->ver_data();

			$aConceito = $db->getConceitos($codProva->conceito_id);
			$aConceito[""] = "&nbsp;";

			if (!$data->data1_f && !$data->data2_f) continue;
	
			$PTO = new treinamento("");
			$PTO->rg = $aResp->rg;
			$PTO->materia = $codProva->id;
			$PTO->mes = $mes;
			$PTO->ano = $ano;
			$PTO->ver_resultados();
			$vConceito1 = $PTO->verifica_conceitoValor($PTO->id_prova_1, $PTO->aproveitamento1);
			$vConceito2 = $PTO->verifica_conceitoValor($PTO->id_prova_2, $PTO->aproveitamento2);

			$link_1 = ($PTO->id_prova_1 ? "<a href='result_gip.php?id_resp=" . $PTO->id_prova_1 ."&id=" . $codProva->id . "'>" . $PTO->qtd_acertos_1 . "</a>" : "&nbsp;");
			$link_2 = ($PTO->id_prova_2 ? "<a href='result_gip.php?id_resp=" . $PTO->id_prova_2 ."&id=" . $codProva->id . "'>" . $PTO->qtd_acertos_2 . "</a>" : "&nbsp;");

			if ($cont++ == 0){
?>
					<tr class="style1">
						<th colspan="3" align="center">Prova</th>
						<th width="8%" align="center">Perguntas</th>
						<th colspan="3" align="center">1&ordm; Prova</th>
						<th colspan="4" align="center">2&ordm; Prova</th>
						<th width="33%">Observação</th>
					</tr>
					<?
			}
?>
					<tr>
						<th colspan="3" class="style1" align="left"><?=$codProva->descricao ?></th>
						<td align="center"><?=$PTO->qtd_perguntas ?></td>
						<td width="8%" align="center"><?=substr($data->data1_f,0,strrpos($data->data1_f,'/')) ?></td>
						<td width="8%"><?=$aConceito[$vConceito1] ?></td>
						<td width="8%" align="center"><?=$link_1 ?></td>
						<td width="8%" align="center"><?=substr($data->data2_f,0,strrpos($data->data2_f,'/')) ?></td>
						<td width="8%"><?=$aConceito[$vConceito2] ?></td>
						<td width="8%" align="center"><?=$link_2 ?></td>
						<td width="8%" align="right"><?=number_format($PTO->aproveitamento2,2,',','.') ?></td>
						<td width="4%" align="center"><?=(($PTO->obs != $PTO->obsNull) ? "<img src='imagens\Exclamation-32.png' width='16' height='16' title='".$PTO->obs."'" : $PTO->obs) ?></td>
					</tr>
					<?
		
			}

		}
?>
				</table>
				<?
	}
}
?></td>
		</tr>
	</table>
	<br>
	<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/>
</form>
</html>