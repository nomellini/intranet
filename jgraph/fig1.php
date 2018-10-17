<?php
require ("./src/jpgraph.php"); 
require ("./src/jpgraph_bar.php");

$graph = new Graph( 540, 250,"auto");   
$graph->SetScale("textlin");
$graph->img->SetMargin(40, 150,20,40);

$datay =array(12,8, 19,3,10 ,5); 
$bplot = new BarPlot($datay); 
$graph->Add( $bplot); 
?>