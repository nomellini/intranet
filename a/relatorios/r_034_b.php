<?	
	require("../scripts/conn.php");
	require("sql.php");
	

if (true)  {

	
	$sql		= getSqlTempoPorConsultor_034_b($id_chamado);


	$resultado	= mysql_query($sql) or die ( $sql);
	
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

function fun_submit(){
	if (!document.getElementById('datai').value || !document.getElementById('dataf').value){
		alert('Período: Preenchimento obrigatório')
		return false;
	}
	document.form1.submit();
}
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#data").fixedHeader({
			width: 950,height: 380
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
	overflow: auto;	
}

.Header {
	font-style: normal;
	font-weight: bold;
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	background-image: url(imagens/FundoTituloGride.jpg);
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
.header_2 {
	font-size: 16px;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">Tempo gasto por consultor</div>
  <form name="form1" method="post" action="" >
  <fieldset class="header_2">
  
  <table border="0" cellspacing="1" cellpadding="1" >
  <tr class="header_2">
    <td align="right">Chamado :</td>
    <td><a href="/a/historicochamado.php?id_chamado=<?=$id_chamado;?>" target="_blank" ><?= $id_chamado ?></a></td>
  </tr>
  <tr class="header_2">
    <td align="right">Cliente :</td>
    <td><strong><?= $cliente_id ?></strong></td>
  </tr>

  <tr class="header_2">
    <td align="right">Tempo total :</td>
	<td><strong><?=$tempototal;?></strong></td>    
  </tr>

</table>

  </fieldset><br>
<?
if (TRUE)  { 

	$resultA = mysql_query($sql) or die (mysql_error());
	$c = mysql_affected_rows();
?>
<fieldset>
<legend>Registros: <?=$c;?></legend>
<div class="_tableContainer">
  <table width="50%" border="0" cellpadding="1" cellspacing="1"  id="_data">
 <thead>
    <tr>
          <th>Nome</th>
          <th>Tempo</th>
          <th>Contatos</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$qtde = $linhaA->qtde;
		$nome = $linhaA->nome;
		$tempo = $linhaA->tempo;
?>
    <tr>
          <td><?=$nome;?></td>                    
          <td><?=$tempo;?></td>
          <td><?=$qtde;?></td>
    </tr>
<?php
  } 
 ?>
    <tr>
      <td><strong>Totais</strong></td>
      <td><strong><?=$tempototal;?></strong></td>
      <td><strong><?=$qtdetotal;?></strong></td>
    </tr>

   <tbody>
  </table>
  </div>  
  </fieldset>
 <a href="javascript:history.go(-1)">Voltar</a> 
</form>    
  <p>
    <?php
  } 
?>
    
<script>
function impressao() {
	document.form1.action = "r_030i.php";
	document.form1.submit();
}


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
