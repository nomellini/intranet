<?php 
define("TTF_DIR","/dados/ftp/sites/sad/htdocs/");
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_bar.php");
require ("./funcoes.php");


/*
  Acao pode ser faixa, de ate, pode ser somente início ou comparativo
  $acao = "deate", "unico", "comparativo"
  
  se for deate, devo colocar comente um gráfico com o  intervalo de datas
  se for comparativo, são dois gráficos 
  se for unico, somente um gráfico com a data 1
*/

$legenda = "$datai";

if ($acao == "comparativo") {
	$datai1 = $datai;
	$dataf1 = $datai;  
	$datai2 = $dataf;
	$dataf2 = $dataf;    
	$graficos = 2;
	$titulo = "Gráfico comparativo entre duas datas";
	$legenda = "";
} else {
 	$graficos = 1;
	if ($acao=="deate") {
		$datai1 = $datai;
		$dataf1 = $dataf;  
		$titulo = "Gráfico de uma faixa de datas";
		$legenda = "Entre $datai e $dataf";
	}  else { // Gráfico somente do dia 1
		$datai1 = $datai;
		$dataf1 = $datai;  	
		$titulo = "Gráfico do dia $datai";		
	}
}

if (isset($origem))
{	
	$titulo = "Contatos";
	$titulo = $titulo . ' / ' . $legenda;	
	$legenda = '';	
	$dados = getBarraContatos($datai1, $dataf1, $origem);		
} else {
	$titulo = $titulo . ' / ' . $legenda;
	$titulo .= " - $grupo";
	$legenda = '';
	$dados = getBarra($datai1, $dataf1, $id_sistema, $grupo);	
}


if (isset($origem)) {
	$graph = new Graph( 700, 400, "auto");    
	$graph->img->SetMargin( 40, 150, 20, 150);	
} else {
	$graph = new Graph( 700, 250, "auto");    	
	$graph->img->SetMargin(40, 150, 20,40);	
}


$graph->SetScale("textlin");



$xdata = $dados[0];
$ydata = $dados[1];

$bplot = new BarPlot($ydata);
$bplot->SetLegend($legenda);

$bplot ->SetFillColor ("orange"); 
if ($grupo == "G1") {
	$bplot ->SetFillColor ("darkseagreen"); 
}
if ($grupo == "G2") {
	$bplot ->SetFillColor ("khaki"); 
}
if ($grupo == "G3") {
	$bplot ->SetFillColor ("darkcyan"); 
}

if ($grupo == "ZZ") {
	$bplot ->SetFillColor ("lightcyan"); 
}

if ($grupo == "todos") {
	$bplot ->SetFillColor ("lightskyblue"); 
}


if (!isset($origem)) {
	/* A mais */
	$dados = getBarra($datai2, $dataf2, $id_sistema, $grupo);	
	$xdata = $dados[0];
	$ydata = $dados[1];
}


$bplot2 = new BarPlot($ydata);
$bplot2 ->SetFillColor ("blue"); 
$bplot2->SetLegend($dataf);
$bplot->value ->Show();
$bplot2->value ->Show();

// Create the grouped bar plot 
$gbplot = new GroupBarPlot (array($bplot ,$bplot2)); 

if ($graficos == 1) {
  $graph->Add($bplot);
} else {
  $graph->Add($gbplot);
}

$graph ->yaxis->scale-> SetGrace(20);

// Setup the titles
$graph->title->Set($titulo);

$graph->xaxis->title->Set("Faixas de tempo em minutos");
$graph->yaxis->title->Set("Quantidade de ligações");
if (isset($origem))
{	

	// Change this defines to where Your fonts are stored 
	  		
	$graph->xaxis->title->Set("");
	$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL, 8); 
    $graph->xaxis->SetLabelAngle(65);	
	if ($origem==1) {
		$graph->yaxis->title->Set("Contatos - Telefonico");
	} else {
		$graph->yaxis->title->Set("Contatos - Geral");		
	}
}

$graph->xaxis->SetTickLabels($xdata);
//$graph->xaxis->SetLabelAngle(45);


$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();

?>