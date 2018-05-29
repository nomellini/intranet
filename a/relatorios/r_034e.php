<?	
 header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=relatorio.xls");
 header("Pragma: no-cache");
 
	require("../scripts/conn.php");
	require("sql.php");
	

{



	$sql		= getSqlTempoToralRel_034($di, $df, $tipo);
	

	$resultado	= mysql_query($sql) or die ( $sql);

	
	if (mysql_num_rows($resultado) > 0){

	/*
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
		
		*/

	}

}

{ 

	$resultA = mysql_query($sql) or die (mysql_error());
	$c = mysql_affected_rows();
?>
<table  border="1" cellpadding="1" cellspacing="1"  id="_data">
 <thead>
    <tr>
          <th>Data</th>
          <th>Chamado</th>
          <th>Cliente</th>
          <th>Sistema</th>           
          <th>Categoria</th>                              
          <th>Tempo Total</th>
          <th>Contatos</th>
          <th>Dias</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$quando = explode("-", $linhaA->dataa);
		$data = "$quando[2]/$quando[1]/$quando[0]";
		$id_chamado = $linhaA->id_chamado;
		$sistema = $linhaA->sistema;
		$tempo = $linhaA->tempo;
		$qtde = $linhaA->contatos;
		$dias = $linhaA->dias;
		$cliente = $linhaA->cliente_id;
		$categoria = $linhaA->categoria;		
?>
    <tr>
          <td><?=$data;?></td>
          <td><?=$id_chamado;?></td>
          <td><?=$cliente;?></td>          
          <td><?=$sistema;?></td>    
          <td><?=$categoria;?></td>                    
          <td><?=$tempo;?></td>
          <td><?=$qtde;?></td>
          <td><?=$dias;?></td>
    </tr>
<?php
  } 
 ?>
   <tbody>
  </table>
<?php
  } 
?>
