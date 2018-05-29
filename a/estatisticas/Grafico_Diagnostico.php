<?php 
	require("../scripts/conn.php");	
	require("sql.php");	
	require ("../../jgraph/src/jpgraph.php"); 
	require ("../../jgraph/src/jpgraph_bar.php");
	require ("../../jgraph/src/jpgraph_pie.php");
	require ("../../jgraph/src/jpgraph_pie3d.php");
	
	$graph  = new PieGraph ( 600, 400, "auto"); 
	$graph->SetShadow(); 
	$graph->title-> Set( "Diagnósticos por sistema"); 


	$sql = getSqlDiagnosticos($de, $ate, $id);

	$result = mysql_query($sql) or die (mysql_error());		
	$soma = 0;	$i=0;
	while ($linha = mysql_fetch_object($result)) {
		$Descricao = $linha->descricao;
		$D = substr($Descricao, 0, 12);
		$Qtde = $linha->soma;
		$soma += $Qtde;
		$legends[$i] = "$D... : $Qtde (%.1f %%)" ;
		$data[$i++] = $Qtde;
	}			
	$p1 = new PiePlot( $data); 
	$p1->SetCenter(0.3, 0.5);
	$p1->SetGuideLines( false );
	$p1->SetLegends($legends);
	$graph->Add( $p1); 	
		
	$graph->Stroke();
?>