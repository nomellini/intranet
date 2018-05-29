<?	
	require("../scripts/conn.php");
	require("sql.php");
	
	if (!isset($datai)) {
		$ano = date("Y", time()-( 86400*30*1 ) );  
		$mes = date("m", time()-( 86400*30*1 ) );
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);		
		$di = date("d/m/Y", $DataInicio);		
		$df = date("d/m/Y", $DataFim);
	}else{
		$di = $datai;	
		$df = $dataf;
	}
	
	if (!isset($campo)) {
		$campo = "cliente";
	}
	if (!isset($ordem)) {
		$ordem = "ASC";
	}

if ($action == "pesquisar")  {

	$quando		= explode("/", $di);
	$de			= "$quando[2]-$quando[1]-$quando[0]";
	$quando		= explode("/", $df);
	$ate		= "$quando[2]-$quando[1]-$quando[0]";
	
	$sql		= getSqlTreinados($basedados, $de, $ate, $campo, $ordem, $tipotre);

	$resultado	= mysql_query($sql);
	if (mysql_num_rows($resultado) > 0){

		// Começa o PDF ==============================================================================================================
		define('FPDF_FONTPATH','font/');
		require('../../fpdf/rel_pdf_dtm.php');
		
		$pdf = new REL_PDF_DTM();
		$pdf->Open();
		$pdf->FPDF("P","mm","A4");
		
		// começa o relatório ========================================================================================================
		
		$pdf->fun_Vlin($pdf->Vlin_ini);
		$pdf->fun_Vsistema('SAD');
		$pdf->fun_Vtitulo('Registros de Solicitação de Treinamento');
		$pdf->fun_Vusuario($USRNOME);
		$pdf->fun_Vprogrel($PAGINA);
		$pdf->fun_cabecalho();

		$pdf->SetFont('Arial','B',9);

		$pdf->SetXY(6,$pdf->Vlin);
		$pdf->MultiCell(100, $pdf->Vlin_alt,"Ordenado por: $campo", 0, "L", 0);
		$pdf->fun_ADD_Vlin($pdf->Vlin_alt);

		$pdf->SetXY(6,$pdf->Vlin);
		$pdf->MultiCell(100, $pdf->Vlin_alt,"Período: $datai à $dataf", 0, "L", 0);
		$pdf->fun_ADD_Vlin($pdf->Vlin_alt*2);

		$pdf->SetXY(6,$pdf->Vlin);
		$pdf->MultiCell(60, $pdf->Vlin_alt,"Cliente", 1, "C", 0);
		$pdf->SetXY(66,$pdf->Vlin);
		$pdf->MultiCell(18, $pdf->Vlin_alt,"Data", 1, "C", 0);
		$pdf->SetXY(84,$pdf->Vlin);
		$pdf->MultiCell(50, $pdf->Vlin_alt,"Sistema", 1, "C", 0);
		$pdf->SetXY(134,$pdf->Vlin);
		$pdf->MultiCell(25, $pdf->Vlin_alt,"Conceito", 1, "C", 0);
		$pdf->SetXY(159,$pdf->Vlin);
		$pdf->MultiCell(45, $pdf->Vlin_alt,"Participante", 1, "C", 0);

		$pdf->fun_ADD_Vlin($pdf->Vlin_alt);

		while ($linha = mysql_fetch_object($resultado)){
		
			$pdf->SetFont('Arial','',7);
	
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(60, $pdf->Vlin_alt,substr($linha->cliente,0,32), 1, "L", 0);
			$pdf->SetXY(66,$pdf->Vlin);
			$pdf->MultiCell(18, $pdf->Vlin_alt,$linha->data, 1, "C", 0);
			$pdf->SetXY(84,$pdf->Vlin);
			$pdf->MultiCell(50, $pdf->Vlin_alt,$linha->sistema, 1, "L", 0);
			$pdf->SetXY(134,$pdf->Vlin);
			$pdf->MultiCell(25, $pdf->Vlin_alt,$linha->conceito, 1, "L", 0);
			$pdf->SetXY(159,$pdf->Vlin);
			$pdf->MultiCell(45, $pdf->Vlin_alt,substr($linha->nome,0,27), 1, "L", 0);
		
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt);
	
			$cont++;

		}
		
		$pdf->SetFont('Arial','B',9);

		if ($totaliza == 'S'){
			$pdf->fun_ADD_Vlin($pdf->Vlin_alt);
			$pdf->SetXY(6,$pdf->Vlin);
			$pdf->MultiCell(100, $pdf->Vlin_alt,"Total de Registro(s): $cont", 0, "L", 0);
		}
		
		$arquivo_pdf = "../../temp/". str_replace('.php','',$PAGINA).trim($USRNOME).date('dmsB').".pdf";
		$pdf->Output("$arquivo_pdf","F");
		$pdf->close();

	}

}

$seltipotre[$tipotre]		= "selected";
$selbasedados[$basedados]	= "selected";
?>
<html>
<head>
<script type="text/javascript" src="../../scripts/jquery-1.3.2.min.js"> </script>
<script type="text/javascript" src="../../scripts/jquery.fixedheader.js"> </script>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}

function fun_submit(){
	if (!document.getElementById('datai').value || !document.getElementById('dataf').value){
		alert('Período: Preenchimento obrigatório')
		return false;
	}
	document.form1.submit();
}
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#data").fixedHeader({
			width: 950,height: 380
		});
	})
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
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

.Header {
	font-style: normal;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	background-image: url(imagens/FundoTituloGride.jpg);
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">Registros de solicita&ccedil;&atilde;o de treinamento </div>
  <form name="form1" method="post" action="" >
  <fieldset>
  <legend>Parâmetros de pesquisa</legend>
<table width="619" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="139">Per&iacute;odo de consulta </td>
        <td width="464">De 
          <label>
          <input name="datai" type="text" class="bordaTexto" id="datai" onKeyPress="fdata(this)" value="<?=$di?>" size="12" maxlength="10">
		  
        at&eacute; 
        <input name="dataf" type="text" class="bordaTexto" id="dataf" onKeyPress="fdata(this)" value="<?=$df?>" size="12" maxlength="10">
        <input name="action" type="hidden" id="action" value="pesquisar">
        </label></td>
      </tr>
      <tr>
        <td>Ordena&ccedil;&atilde;o</td>
        <td><label> Campo
<select name="campo" class="bordaTexto" id="campo">
  <option value="cliente" <?php if (!(strcmp("cliente", $_POST['campo']))) {echo "selected=\"selected\"";} ?>>Cliente</option>
  <option value="data" <?php if (!(strcmp("data", $_POST['campo']))) {echo "selected=\"selected\"";} ?>>Data</option>
  <option value="sistema" <?php if (!(strcmp("sistema", $_POST['campo']))) {echo "selected=\"selected\"";} ?>>Sistema</option>
  <option value="conceito" <?php if (!(strcmp("conceito", $_POST['campo']))) {echo "selected=\"selected\"";} ?>>Conceito</option>
  <option value="nome" <?php if (!(strcmp("nome", $_POST['campo']))) {echo "selected=\"selected\"";} ?>>Participante</option>
        </select>
        <input <?php if (!(strcmp($ordem,"ASC"))) {echo "checked=\"checked\"";} ?> name="ordem" type="radio" value="ASC">
        Natural
        
        <input <?php if (!(strcmp($ordem,"DESC"))) {echo "checked=\"checked\"";} ?> name="ordem" type="radio" value="DESC">
        Inversa 
        
        
        </label></td>
      </tr>
      <tr>
      	<td>Tipo de Treinando: </td>
      	<td><select name="tipotre" class="bordaTexto" id="tipotre">
			<option value="1" <?=$seltipotre[1] ?>>Interno</option>
			<option value="2" <?=$seltipotre[2] ?>>Externo / Cliente</option>
		</select></td>
      	</tr>
      <tr>
      	<td>Base de Dados: </td>
      	<td><select name="basedados" class="bordaTexto" id="basedados">
			<option value="1" <?=$selbasedados[1] ?>>SAD</option>
			<option value="2" <?=$selbasedados[2] ?>>Treinamento</option>
		</select></td>
      	</tr>
      <tr>
      	<td>Totaliza (Relat&oacute;rio):</td>
      	<td><select name="totaliza" class="bordaTexto" id="totaliza">
			<option value="S" <?=$seltotaliza["S"] ?>>Sim</option>
			<option value="N" <?=$seltotaliza["N"] ?>>N&atilde;o</option>
		</select></td>
      	</tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="btnPesquisar" type="button" class="bordaTexto" id="btnPesquisar" value="Pesquisar" onClick="fun_submit()"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</fieldset>
<?
if ($action == "pesquisar")  { 

	$resultA = mysql_query($sql) or die (mysql_error());
	$c = mysql_affected_rows();
?>
<fieldset>
<legend>Registros: <?=$c;?></legend>
<div class="tableContainer">
  <a target="_blank" href="<?=$arquivo_pdf ?>">Versão para impressão</a>
<table width="100%" border="0" cellpadding="1" cellspacing="1"  id="data">
 <thead>
    <tr>
          <th>Cliente</th>
          <th>Data</th>
          <th>Sistema</th>
          <th>Conceito</th>
          <th>Participante</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$quando = explode("-", $linhaA->data);
		$dataa = "$quando[2]/$quando[1]/$quando[0]";
		$id = $linhaA->id;
		$cliente = $linhaA->cliente;
		$sistema = $linhaA->sistema;
		$nome = $linhaA->nome;
		$cargo = $linhaA->cargo;
		$conceito = $linhaA->conceito;
		$data = $linhaA->data;
		$rg = $linhaA->rg;	
?>
    <tr>
          <td><?=$cliente;?></td>
          <td><?=$dataa;?></td>
          <td><?=$sistema;?></td>
          <td><?=$conceito?></td>
          <td><?=$nome;?></td>
    </tr>
<?php
  } 
 ?>
   <tbody>
  </table>
  </div>
  </fieldset>
  </form>    
  <p>
    <?php
  } 
?>
    
<script>
function impressao() {
	document.form1.action = "r_030i.php";
	document.form1.submit();
}


$(function() {
	$("div table tr:nth-child(even)").addClass("LinhasPares");
	$("div table tr:nth-child(odd)").addClass("LinhasImpares");
	$("div table tr:first").addClass("Header");	
});

$(function() {   
	$('div table tr').mouseover(function() {   
		$(this).addClass('selectedRow');   
	}).mouseout(function() {   
	$(this).removeClass('selectedRow');   
	});   
}); 
  </script>  
</p>

</body>
</html>
