<?php 
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_bar.php");
require ("./funcoes.php");

$graph = new Graph( 540, 250,"auto");   


$graph->SetScale("textlin");
$graph->img->SetMargin(40, 150,20,40);

$datay =array(12,8, 19,3,10 ,5); 
$bplot = new BarPlot($datay); 
$bplot->SetFillColor("orange@0.4");


$datay =array(1, 2, 3, 4, 5, 6); 
$bplot2 = new BarPlot($datay); 
$bplot2->SetFillColor("red@0.4");

$datay =array(6, 5, 4, 3, 2, 1); 
$bplot3 = new BarPlot($datay); 

$gbplot = new GroupBarPlot (array($bplot, $bplot2, $bplot3)); 

$graph->Add($gbplot); 

$graph->Stroke();
?>