<?php 
require("../scripts/conn.php");	
require ("../../jgraph/src/jpgraph.php"); 
require ("../../jgraph/src/jpgraph_bar.php");
require ("../../jgraph/src/jpgraph_line.php");
require ("../../jgraph/src/jpgraph_pie.php");
require ("../../jgraph/src/jpgraph_pie3d.php");


$Data_Ate = explode("-", $ate);
$Data = mktime(0,0,0, $Data_Ate[1], 1, $Data_Ate[0]);
$ano = date("Y", $Data - ( 86400*30*16 ) );  
$mes = date("m", $Data - ( 86400*30*16 ) );
$de = "$ano-$mes-01";

$graph = new Graph( 800, 280,"auto");   
$graph->SetScale("textlin");
$graph->SetShadow(); 
$graph->title-> Set( "Quantidade de Chamados por Mês, Ultimos 13 meses"); 




  $sql = "select month(dataa) as mes, year(dataa) as ano, count(*) as chamados from chamado, usuario where (chamado.cliente_id<>'DATAMACE') and (chamado.visible=1) and descricao is not null and descricao <> '' and (dataa >= '$de') and (dataa <= '$ate') and (usuario.id_usuario=chamado.consultor_id) and usuario.atendimento=1  group by ano, mes ";


	
	//http://192.168.0.5/a/relatorios/grChamadosMensal.php?ate=2009-07-31
	$i = 0;
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
		$Mes= $linha->mes;
		$Ano = $linha->ano;	  		
		$Chamados = $linha->chamados;
		$legends[$i] = "$Mes/$Ano";
		$Dados[$i++] = $Chamados;	  
	}
		
	// Setup the titles
	$graph->title->Set($titulo);
	$graph->xaxis->title->Set("Últimos 16 meses");
	$graph->yaxis->title->Set("Média");
	$graph->xaxis->SetTickLabels($legends);	
	$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');

	
	$p1 = new LinePlot( $Dados ); 
	$p1->mark->SetType(MARK_STAR );
	$p1->mark->SetFillColor("red");	
	$p1->value->SetFormat( "%0.0f"); 
	$p1->value ->Show();	
	$graph->Add( $p1); 	
	$graph->Stroke();
?>