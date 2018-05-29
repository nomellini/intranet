<?php 
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_line.php"); 
require ("./funcoes.php");

$dados = getMedias($datai, $datai, $id_sistema);
$xdata = $dados[0];
$ydata = $dados[1];

$LimiteSuperior = 30;

$maximo = getMax($ydata);

if ($LimiteSuperior < $maximo) {
  $LimiteSuperior = $maximo;
}

// Create the graph. These two calls are always required 
$graph = new Graph(450, 250,"auto");     
//$graph->SetScale( "textlin"); 
$graph->SetScale("textlin", 0, $LimiteSuperior);
$graph->img-> SetMargin(40,30 ,20,40); 
$graph->title-> Set("Tempo médio para o dia $datai"); 
$graph->xaxis->SetTickLabels($xdata);
$graph ->ygrid->Show( true, false	);
$graph ->xgrid->Show( true, true);
$graph ->yaxis->scale-> SetGrace(10);

// Create the linear plot 

$lineplot =new LinePlot($ydata); 
$lineplot ->SetColor("blue"); 
$lineplot->value ->Show();

$graph->xaxis-> title->Set("Hora" ); 

// Add the plot to the graph 
$graph->Add( $lineplot); 

// Display the graph 
$graph->Stroke(); 
?> 