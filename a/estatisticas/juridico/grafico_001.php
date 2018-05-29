<?php 
require("../../scripts/conn.php");	
require("sql.php");	
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_bar.php");
require ("../../../jgraph/src/jpgraph_pie.php");
require ("../../../jgraph/src/jpgraph_pie3d.php");

$graph = new Graph( 400, 200,"auto");   
$graph->SetScale("textlin");
$graph->SetShadow(); 
$graph->title-> Set( "Quantidade de Chamados por  número de interações"); 

	$sql = getSqlQuantidadeInteracoes($de, $ate, $tipo, $diagnostico);
	
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0; $i=0;
	while ($linha = mysql_fetch_object($result)) {	
		$Interacoes = $linha->interacoes;
		$Qtde = $linha->soma;
		$soma += $Qtde;
		$legends[$i] = "$Interacoes" ;
		$data[$i++] = $Qtde;
	}
	
	// Setup the titles
	$graph->title->Set($titulo);
	$graph->xaxis->title->Set("Interações");
	$graph->yaxis->title->Set("Quantidade de chamados");
	$graph->xaxis->SetTickLabels($legends);
	
	
	$p1 = new BarPlot( $data); 
	$p1->value ->Show();	

	$graph->Add( $p1); 	
	$graph->Stroke();
?>