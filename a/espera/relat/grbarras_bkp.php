<?php 
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_bar.php");
require ("./funcoes.php");

$dados = getBarra($datai, $datai, $id_sistema);
$xdata = $dados[0];
$ydata = $dados[1];

$graph = new Graph(450,250,"auto");    
$graph->SetScale("textlin");

// Add a drop shadow


// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(40,30,20,40);

// Create a bar pot
$bplot = new BarPlot($ydata);
$graph->Add($bplot);


$bplot->value ->Show();

$graph ->yaxis->scale-> SetGrace(20);

// Setup the titles
$graph->title->Set("Quantidade de atendimentos por faixa");
$graph->xaxis->title->Set("Faixas de tempo em minutos");
$graph->yaxis->title->Set("Quantidade de ligações");
$graph->xaxis->SetTickLabels($xdata);

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?> 
