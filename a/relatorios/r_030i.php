<?	
	require("../scripts/conn.php");
	require("sql.php");
	
	if (!isset($datai)) {
		$ano = date("Y", time()-( 86400*30*1 ) );  
		$mes = date("m", time()-( 86400*30*1 ) );
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);		
		$di = date("d/m/Y", $DataInicio);		
		$df = date("d/m/Y", $DataFim);
	} else 
	{
		$di = $datai;	
		$df = $dataf;
	}
	
	if (!isset($campo)) {
		$campo = "cliente";
	}
	if (!isset($ordem)) {
		$ordem = "ASC";
	}
	
		
?>
<html>
<head>
<script type="text/javascript" src="../../scripts/jquery-1.3.2.min.js"> </script>
<script type="text/javascript" src="../../scripts/jquery.fixedheader.js"> </script>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#data").fixedHeader({
			width: 950,height: 320
		});
	})
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.LinhasPares {
	background-color: #FFFFEC;
}
.LinhasImpares {
	background-color: #E8EEFF;
}

.selectedRow {
	background-color: #FDDBDC;
}


.tableContainer {
}

.Header {
	font-style: normal;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	background-image: url(imagens/FundoTituloGride.jpg);
}
-->
</style>

</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">Registros de solicita&ccedil;&atilde;o de treinamento </div>
  <form name="form1" method="post" action="" >
    <?php	

  if ($action == "pesquisar")  {


	$quando = explode("/", $di);
	$de = "$quando[2]-$quando[1]-$quando[0]";
	$quando = explode("/", $df);
	$ate = "$quando[2]-$quando[1]-$quando[0]";

	$sql = getSqlTreinados($de, $ate, $campo, $ordem);
	$resultA = mysql_query($sql) or die (mysql_error());
	$c = mysql_affected_rows();
	
	//echo $sql;

?>
<fieldset>
<legend>Registros: <?=$c;?></legend>
<div class="tableContainer">
  <table width="100%" border="0" cellpadding="1" cellspacing="1"  id="data">
 <thead>
    <tr>
          <th>Cliente</th>
          <th>Data</th>
          <th>Sistema</th>
          <th>Conceito</th>
          <th>Participante</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$quando = explode("-", $linhaA->data);
		$dataa = "$quando[2]/$quando[1]/$quando[0]";
		$id = $linhaA->id;
		$cliente = $linhaA->cliente;
		$sistema = $linhaA->sistema;
		$nome = $linhaA->nome;
		$cargo = $linhaA->cargo;
		$conceito = $linhaA->conceito;
		$data = $linhaA->data;
		$rg = $linhaA->rg;	
?>
    <tr>
          <td><?=$cliente;?></td>
          <td><?=$dataa;?></td>
          <td><?=$sistema;?></td>
          <td><?=$conceito?></td>
          <td><?=$nome;?></td>
    </tr>
<?php
  } 
 ?>
   <tbody>
  </table>
  </div>
  </fieldset>
  </form>    
  <p>
    <?php
  } 
?>
    
    <script>

$(function() {
	$("div table tr:nth-child(even)").addClass("LinhasPares");
	$("div table tr:nth-child(odd)").addClass("LinhasImpares");
	$("div table tr:first").addClass("Header");	
});

$(function() {   
	$('div table tr').mouseover(function() {   
		$(this).addClass('selectedRow');   
	}).mouseout(function() {   
	$(this).removeClass('selectedRow');   
	});   
}); 
  </script>  
</p>

</body>
</html>
