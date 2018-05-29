<?php 
require("../scripts/conn.php");	
require("sql.php");	
require ("../../jgraph/src/jpgraph.php"); 
require ("../../jgraph/src/jpgraph_bar.php");
require ("../../jgraph/src/jpgraph_pie.php");
require ("../../jgraph/src/jpgraph_pie3d.php");

$graph  = new PieGraph ( 600, 400, "auto"); 
$graph->SetShadow(); 
$graph->title-> Set( "Contatos por sistema"); 

	$sql = getSql_002($de, $ate, $id);
	
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0; $i=0;
	while ($linha = mysql_fetch_object($result)) {
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		
		$legends[$i] = "$Sistema : $Qtde (%.1f %%)" ;
		$data[$i++] = $Qtde;
		$soma += $Qtde;
	}

	$p1 = new PiePlot( $data); 
	$p1->SetCenter(0.3, 0.5);
	$p1-> SetGuideLines( false );
	//$p1->ExplodeSlice(0) ;
	$p1->SetLegends($legends);
	$graph->Add( $p1); 	
	$graph->Stroke();
?>