<?php
include ("/var/www/default/jgraph/src/jpgraph.php");
include ("/var/www/default/jgraph/src/jpgraph_bar.php");
require("../scripts/conn.php");	
 
  $quando = explode("/", $datai);
  $datair = "$quando[2]-$quando[1]-$quando[0]";
  $quando = explode("/", $dataf);
  $datafr = "$quando[2]-$quando[1]-$quando[0]";

  $sql  = "SELECT ";
  $sql .= "sistema.sistema, ";
  $sql .= "categoria.categoria, ";
  $sql .= "sum(time_to_sec(contato.horae) - time_to_sec(contato.horaa)) as tempo, ";
  $sql .= "sec_to_time(sum(time_to_sec(contato.horae) - time_to_sec(contato.horaa))) as t, ";
  $sql .= "count(*) as qtde ";
  $sql .= "from ";
  $sql .= "  chamado,"; 
  $sql .= "  contato, ";
  $sql .= "  categoria, ";
  $sql .= "  sistema ";
  $sql .= "where ";
  $sql .= "  contato.dataa >= '$datair' and contato.dataa <= '$datafr' and ";
  $sql .= "  chamado.sistema_id = sistema.id_sistema and ";
  $sql .= "  chamado.categoria_id = categoria.id_categoria and ";
  $sql .= "  chamado.id_chamado = contato.chamado_id and ";
  $sql .= "  chamado.descricao is not null  ";
  if ($sistema) {
    $sql .= "  and sistema.id_sistema = $sistema  ";
  } 
  $sql .= "group by ";
  $sql .= "  sistema, ";
  $sql .= " categoria ";
  $sql .= "order by ";
  $sql .= " tempo desc LIMIT 10"; 
  
  if($sistema) {
    $nomesistema = "do sistema " . pegaSistema($sistema);
  } else {
    $nomesistema = "de todos os sistemas";
  } 
//  $datay=array(12,8,19,3,10,5);
// Create the graph. These two calls are always required
$graph = new Graph(750,200,"auto");	
$graph->SetScale("textlin");

  $result = mysql_query($sql);
  $conta = 0;
  while ( $linha = mysql_fetch_object($result) ) {
    $datay[$conta++]= ($linha->tempo)/60;  
	
	if($text) { $text.="\n";}
	$text .= "$conta. ";
	if (!$sistema) {
      $text .= "[$linha->sistema]. ";
	}
	$text .= "$linha->categoria";
		
  } 
  
  $txt =new Text($text); 
  $txt->Pos( 415, 50 ); 
  $txt->SetColor( "blue"); 
  $txt->SetBox('yellow','blue'); 
  $graph->AddText($txt); 

// Add a drop shadow
//$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin( 60, 350,20,40);

// Create a bar pot
$bplot = new BarPlot($datay);

// Adjust fill color
$bplot->SetFillColor('red');
$graph->Add($bplot);

// Setup the titles
$graph->title->Set("Tempo de atendimento por categoria $nomesistema\nentre os dias $datai e $dataf\nMostrando os 10 primeiros");
$graph->xaxis->title->Set("Categorias");
$graph->yaxis->title->Set("Tempo em minutos");
$graph->yaxis->title->SetColor("blue:0.3");
$graph->yaxis->SetTitleMargin(45); 
//$graph->yaxis->SetTicklabelmargin(50); 

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$graph ->footer->left-> Set("(C) 2003 Datamace Informática"); 

//$graph->tabtitle->Set('Teste'); 


$graph->Stroke();
?>
