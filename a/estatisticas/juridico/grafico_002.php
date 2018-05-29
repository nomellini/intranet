<?php 
require("../../scripts/conn.php");	
require("sql.php");	
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_bar.php");
require ("../../../jgraph/src/jpgraph_line.php");
require ("../../../jgraph/src/jpgraph_pie.php");
require ("../../../jgraph/src/jpgraph_pie3d.php");


$Data_Ate = explode("-", $ate);
$Data = mktime(0,0,0, $Data_Ate[1], 1, $Data_Ate[0]);
$ano = date("Y", $Data - ( 86400*30*12 ) );  
$mes = date("m", $Data - ( 86400*30*12 ) );
$de = "$ano-$mes-01";

$graph = new Graph( 640, 280,"auto");   
$graph->SetScale("textlin");
$graph->SetShadow(); 
$graph->title-> Set( "Quantidade de Chamados por  número de interações"); 

	$sql = getMediaUltimos12Meses($de, $ate, $tipo, $diagnostico);

	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0; $i=0; $Soma = 0;
	while ($linha = mysql_fetch_object($result)) {	
		$Media = $linha->media;
		$Soma += $Media;
		$Ano = $linha->ano;
		$Mes = $linha->mes;
		$legends[$i] = "$Mes/$Ano";
		$data[$i++] = $Media;
	}
	//print_r($data);

	$MediasDasMedias = $Soma / $i;

	// Setup the titles
	$graph->title->Set($titulo);
	$graph->xaxis->title->Set("Últimos 12 meses [Média = $MediasDasMedias]");
	$graph->yaxis->title->Set("Média");
	$graph->xaxis->SetTickLabels($legends);	
	$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');

	
	$p1 = new LinePlot( $data); 
	$p1->mark->SetType(MARK_STAR );
	$p1->mark->SetFillColor("red");	
	$p1->value->SetFormat( "%0.2f"); 
	$p1->value ->Show();	
	$graph->Add( $p1); 	
	$graph->Stroke();
	
?>