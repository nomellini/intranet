<?php 
require("../scripts/conn.php");	
require("sql.php");	
require ("../../jgraph/src/jpgraph.php"); 
require ("../../jgraph/src/jpgraph_bar.php");
require ("../../jgraph/src/jpgraph_pie.php");
require ("../../jgraph/src/jpgraph_pie3d.php");

$Data_Ate = explode("-", $ate);
$Data = mktime(0,0,0, $Data_Ate[1], 1, $Data_Ate[0]);
$ano = date("Y", $Data - ( 86400*30*11 ) );  
$mes = date("m", $Data - ( 86400*30*11 ) );
$de = "$ano-$mes-01";


$graph = new Graph( 700, 300,"auto");   
$graph->SetScale("textlin");
$graph->SetShadow(); 
$graph->title-> Set( "Contatos por sistema"); 

	$sql = getSqlGraficoContatosSistema($sistema, $de, $ate, $id);
	
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0; $i=0;
	while ($linha = mysql_fetch_object($result)) {	
		$mes = $linha->mes;
		$ano = $linha->ano;	
		$Qtde = $linha->soma;		
		$legends[$i] = "$mes/$ano" ;
		$data[$i++] = $Qtde;
	}
	
	// Setup the titles
	$graph->title->Set($titulo);
	$graph->xaxis->title->Set("Últimos 12 meses");
	$graph->yaxis->title->Set("Quantidade de chamados");
	$graph->xaxis->SetTickLabels($legends);
	
	
	$p1 = new BarPlot( $data); 
	$p1->value ->Show();	

	$graph->Add( $p1); 	
	$graph->Stroke();
?>