<?php 
require("a/scripts/conn.php");	
require ("jgraph/src/jpgraph.php"); 
require ("jgraph/src/jpgraph_bar.php");
require ("jgraph/src/jpgraph_pie.php");
require ("jgraph/src/jpgraph_pie3d.php");

$graph  = new PieGraph ( 600, 400, "auto"); 
$graph->SetShadow(); 
$graph->title-> Set( "Contatos por sistema"); 

	$sql_002 = "SELECT sistema, count(  *  )  AS soma ";
	$sql_002 .= "FROM contato, chamado, sistema ";
	$sql_002 .= "WHERE contato.destinatario_id =7  "; 
	$sql_002 .= "AND contato.consultor_id <> 39 ";
	$sql_002 .= "AND contato.consultor_id <> 85 ";
	$sql_002 .= "AND contato.consultor_id <> 14 ";
	$sql_002 .= "AND contato.consultor_id <> 90 ";
	$sql_002 .= "AND contato.consultor_id <> 98 ";
	$sql_002 .= "AND contato.consultor_id <> 172 ";
	$sql_002 .= "AND contato.consultor_id <> 173 ";
	$sql_002 .= "AND contato.consultor_id <> 12 ";
	$sql_002 .= "AND contato.consultor_id <> 43 ";
	$sql_002 .= "AND contato.consultor_id <> 169 ";
	$sql_002 .= "AND contato.consultor_id <> 170 ";
	$sql_002 .= "AND contato.consultor_id <> 171 ";
	$sql_002 .= "AND contato.consultor_id <> 178 ";
	$sql_002 .= "AND contato.consultor_id <> 08 ";
	$sql_002 .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql_002 .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql_002 .= "AND contato.dataa >=  '$de'  ";
	$sql_002 .= "AND contato.dataa <=  '$ate' ";
	$sql_002 .= "GROUP  BY sistema.sistema ";
	$sql_002 .= "ORDER  BY soma DESC, sistema.sistema ";

	$result = mysql_query($sql_002) or die (mysql_error());	
	$soma = 0; $i=0;
	while ($linha = mysql_fetch_object($result)) {
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		
		$legends[$i] = "$Sistema : $Qtde (%.1f %%)" ;
		$data[$i++] = $Qtde;
		$soma += $Qtde;
	}

	$p1 = new PiePlot( $data); 
	$p1->SetCenter(0.27, 0.5);
	$p1-> SetGuideLines( false );
	$p1->ExplodeSlice(0) ;
	$p1->SetLegends($legends);
	$graph->Add( $p1); 
	$graph->Stroke();
?>