<?php 
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_line.php"); 
require ("./funcoes.php");

/*
  Acao pode ser faixa, de ate, pode ser somente início ou comparativo
  $acao = "deate", "unico", "comparativo"
  
  se for deate, devo colocar comente um gráfico com o  intervalo de datas
  se for comparativo, são dois gráficos 
  se for unico, somente um gráfico com a data 1
*/

//$acao = "deate";
$legenda = "$datai";		
if ($acao == "comparativo") {
	$datai1 = $datai;
	$dataf1 = $datai;  
	$datai2 = $dataf;
	$dataf2 = $dataf;    
	$graficos = 2;
	$titulo = "comparativo de tempo médio entre duas datas";
} else {
 	$graficos = 1;
	if ($acao=="deate") {
		$datai1 = $datai;
		$dataf1 = $dataf;  
		$titulo = "Tempo médio de uma faixa de datas";
		$legenda = "Entre $datai e $dataf";
	}  else { // Gráfico somente do dia 1
		$datai1 = $datai;
		$dataf1 = $datai;  	
		$titulo = "Tempo médio do dia $datai";		
	}
}

$titulo = $titulo . ' / ' . $legenda;
$legenda = '';


$dados = getMedias($datai1, $dataf1, $id_sistema);
$xdata = $dados[0];
$ydata = $dados[1];
$LimiteSuperior = u;
$maximo = getMax($ydata);
if ($LimiteSuperior < $maximo) {
  $LimiteSuperior = $maximo;
}

// Create the graph. These two calls are always required 

$graph = new Graph( 540, 400,"auto");    
$graph->SetScale("textlin", 0, $LimiteSuperior);
$graph->img->SetMargin(40, 150,20,40);
$graph->title-> Set($titulo); 
$graph->xaxis->SetTickLabels($xdata);
$graph->yaxis->title->Set("Tempo em minutos");
$graph ->ygrid->Show( true, false	);
$graph ->xgrid->Show( true, true);
$graph ->yaxis->scale-> SetGrace(10);

// Create the linear plot 

$lineplot =new LinePlot($ydata); 
$lineplot ->SetColor("orange"); 
$lineplot->SetLegend($legenda);	
$lineplot->value ->Show();


$graph->xaxis-> title->Set("Hora" ); 


/* A mais */
$dados = getMedias($datai2, $dataf2, $id_sistema);
$ydata = $dados[1];
$lineplot2 =new LinePlot($ydata); 
$lineplot2 ->SetColor("blue"); 
//$lineplot2->SetLegend($dataf);
$lineplot2->value ->Show();

// Create the grouped bar plot 
//$gbplot = new GroupBarPlot (array($lineplot, $lineplot2)); 

$graph->Add($lineplot);
if ($graficos == 2) {
  $graph->Add($lineplot2);
}

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph 
$graph->Stroke(); 
?> 