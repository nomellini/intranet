<?php 
require ("../../../jgraph/src/jpgraph.php"); 
require ("../../../jgraph/src/jpgraph_line.php"); 
require("../../scripts/conn.php");

$dia = explode("/", $data);
$dia = "$dia[2]-$dia[1]-$dia[0]";


// Create the graph. These two calls are always required 
$graph = new Graph(450, 250,"auto");     
//$graph->SetScale( "textlin"); 
$graph->SetScale("textlin", 0, 30);
$graph->img-> SetMargin(40,30 ,20,40); 
$graph->title-> Set("Tempo médio para o dia $data. GIP"); 
$graph->xaxis->SetTickLabels($xdata);
$graph ->ygrid->Show( true, false	);
$graph ->xgrid->Show( true, true);

// Create the linear plot 

$sql  = "select hour(hora_inicio) as hora, (avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))/60) as minutos_medio, ";
$sql .= "sec_to_time(avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))) as tempo_medio ";
$sql .= "from satligacao where id_produto = 1 and  data >= '2004-02-20' and  data <= '2004-02-20' and ";
$sql .= "id_satstatus = 3 group by hour(hora_inicio)";
$result = mysql_query($sql);
$i = 0;
while ($linha=mysql_fetch_object($result)) {
  $ydata[$i++] = $linha->minutos_medio;
}
$lineplot =new LinePlot($ydata); 
$lineplot ->SetColor("blue"); 
$lineplot->value ->Show();
$graph->xaxis-> title->Set("Hora" ); 
$graph->Add( $lineplot); 


$sql  = "select hour(hora_inicio) as hora, (avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))/60) as minutos_medio, ";
$sql .= "sec_to_time(avg(time_to_sec(hora_fim) - time_to_sec(hora_inicio))) as tempo_medio ";
$sql .= "from satligacao where id_produto = 1 and  data >= '2004-02-19' and  data <= '2004-02-19' and ";
$sql .= "id_satstatus = 3 group by hour(hora_inicio)";
$result = mysql_query($sql);
$i = 0;
while ($linha=mysql_fetch_object($result)) {
  $xdata[$i] = $linha->hora;
  $ydata2[$i++] = $linha->minutos_medio;
}
$lineplot2 =new LinePlot($ydata2); 
$lineplot2 ->SetColor("red"); 
$lineplot2->value ->Show();
$graph->Add( $lineplot2); 
$graph->xaxis->SetTickLabels($xdata);
// Display the graph 
$graph->Stroke(); 
?> 