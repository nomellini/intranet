<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	require ("../../jgraph/src/jpgraph.php"); 	
	include ("../../jgraph/src/jpgraph_pie.php"); 
	require ("../../jgraph/src/jpgraph_bar.php");
	
	
	$graph = new Graph( 700, 400, "auto");    
	$graph->img->SetMargin(40, 150, 20,40);		
	$graph->SetScale("textlin");

	$ch = statCategoriaMotivo($datai, $dataf, $sistema, $categoria, $motivo, $o, $limite);

  $c = 0;	
  $data = Array();
  $Legendas = Array();
  while( list($tmp1, $tmp) = each($ch) ) {	  
	$sistema = $tmp["sistema"];			
	$categoria = $tmp["categoria"];
	$chamados = $tmp["chamados"];
	$motivo = $tmp["motivo"];
	
    if($total) {
	  $ct = $chamados/$total*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.1f", $ct);	
	
	
	$Legendas[$c] = "$sistema:$categoria:$motivo $ct %%";
	$data[$c++] = $chamados;
  }



$graph  = new PieGraph ( 1024, 550); 
$graph->img->SetMargin(40, 150, 20,40);	
$graph->SetShadow(); 

$graph->title-> Set( "Relatório agrupado por categorias e motivos - $datai ~ $dataf"); 

$p1 = new PiePlot( $data); 
$p1->SetLegends($Legendas);
$p1->SetGuideLines(true, false);
$p1->SetSize(0.3);
$p1->SetCenter( 250, 250);
$p1->ExplodeSlice(0, 10);


$graph->Add( $p1); 
$graph->Stroke();
?>