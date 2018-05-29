<?php virtual('/Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, cliente FROM cliente ORDER BY cliente ASC";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);

mysql_select_db($database_sad, $sad);
$query_rsStatus = "SELECT * FROM status ORDER BY status ASC";
$rsStatus = mysql_query($query_rsStatus, $sad) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);
?>
<?	
	require("../scripts/conn.php");
	require("sql.php");
	
	if (!isset($tipo)) { $tipo = 'p' ; } 
	
	if (!isset($datai)) {
		$ano = date("Y", time()-( 86400*30*1 ) );  
		$mes = date("m", time()-( 86400*30*1 ) );
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);		
		$di = date("d/m/Y", $DataInicio);		
		$df = date("d/m/Y", $DataFim);
	}else{
		$di = $datai;	
		$df = $dataf;
	}
	
	if (!isset($campo)) {
		$campo = "cliente";
	}
	if (!isset($ordem)) {
		$ordem = "ASC";
	}

if ($action == "pesquisar")  {

	$quando		= explode("/", $di);
	$de			= "$quando[2]-$quando[1]-$quando[0]";
	$quando		= explode("/", $df);
	$ate		= "$quando[2]-$quando[1]-$quando[0]";
	


}

$seltipotre[$tipotre]		= "selected";
$selbasedados[$basedados]	= "selected";
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
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">Tempo total</div>
  <form name="form1" method="post" action="" >
  <fieldset>
  <legend>Parâmetros de pesquisa</legend>
<table width="619" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="139">Per&iacute;odo de consulta </td>
        <td width="464">De 
          <label>
          <input name="datai" type="text" class="bordaTexto" id="datai" onKeyPress="fdata(this)" value="<?=$di?>" size="12" maxlength="10">
		  
        at&eacute; 
        <input name="dataf" type="text" class="bordaTexto" id="dataf" onKeyPress="fdata(this)" value="<?=$df?>" size="12" maxlength="10">
        <input name="action" type="hidden" id="action" value="pesquisar">
        </label></td>
      </tr>
      <tr>
        <td>Tipo</td>
        <td><label>
          <input <?php if (!(strcmp($tipo,"p"))) {echo "checked=\"checked\"";} ?> name="tipo" type="radio" value="p">
        P&oacute;s Venda
        
        <input <?php if (!(strcmp($tipo,"c"))) {echo "checked=\"checked\"";} ?> name="tipo" type="radio" value="c">
        Convers&atilde;o 
        

        <input <?php if (!(strcmp($tipo,"a"))) {echo "checked=\"checked\"";} ?> name="tipo" type="radio" value="a">
        Qualquer um
                
        
        </label></td>
      </tr>
      <tr>
        <td valign="middle">Cliente</td>
        <td valign="middle"><select name="id_cliente" class="bordaTexto" id="id_cliente">
          <option value="0" <?php if (!(strcmp(0, $id_cliente))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsClientes['id_cliente']?>"<?php if (!(strcmp($row_rsClientes['id_cliente'], $id_cliente))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsClientes['cliente']?></option>
          <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
        </select></td>
      </tr>
      <tr>
        <td>Status</td>
        <td><label for="id_status"></label>
          <select name="id_status" class="bordaTexto" id="id_status">
            <option value="0" <?php if (!(strcmp(0, $_POST['id_status']))) {echo "selected=\"selected\"";} ?>>Todos</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], $id_status))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
            <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="btnPesquisar" type="button" class="bordaTexto" id="btnPesquisar" value="Pesquisar" onClick="fun_submit()"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</fieldset>
<?
if ($action == "pesquisar")  { 

	$sql		= getSqlTempoToralRel_034($de, $ate, $tipo, $id_cliente, $id_status);		
	//$resultado	= mysql_query($sql) or die ( $sql);	
	
	$resultA = mysql_query($sql) or die (mysql_error());
	
	$c = mysql_affected_rows();
?>
<fieldset>
<legend>Registros: <?=$c;?></legend>
<div class="_tableContainer">
  <a target="_blank" href="r_034e.php?di=<?=$de?>&df=<?=$ate?>&tipo=<?=$tipo?>">Exportar para Excel</a>
  <table border="0" cellpadding="1" cellspacing="1"  id="_data">
 <thead>
    <tr>
          <th>Data</th>
          <th>Chamado</th>
          <th>Status</th>
          <th>Cliente</th>
          <th>Sistema</th>           
          <th>Categoria</th>                              
          <th>Tempo Total</th>
          <th>Contatos</th>
          <th>Dias</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$quando = explode("-", $linhaA->dataa);
		$data = "$quando[2]/$quando[1]/$quando[0]";
		$id_chamado = $linhaA->id_chamado;
		$sistema = $linhaA->sistema;
		$tempo = $linhaA->tempo;
		$qtde = $linhaA->contatos;
		$dias = $linhaA->dias;
		$cliente = $linhaA->cliente_id;
		$categoria = $linhaA->categoria;		
		
		$link = "datai=$datai&dataf=$dataf&id_status=$id_status&id_cliente=$cliente&action=pesquisar&tipo=$tipo";		
?>
    <tr>
          <td><?=$data;?></td>
          <td>
          <!-- <a href="/a/historicochamado.php?id_chamado=<?=$id_chamado;?>" target="_blank" > -->
		<a href="r_034_b.php?id_chamado=<?=$id_chamado;?>&tempototal=<?=$tempo;?>&qtdetotal=<?=$qtde;?>&cliente_id=<?=$cliente;?>" >          
		  <?=$id_chamado;?>
          </a>
          </td>
          <td><?=$linhaA->status;?></td>          
          <td><a href="r_034.php?<?=$link?>" ><?=$cliente;?></a></td>          
          <td><?=$sistema;?></td>    
          <td><?=$categoria;?></td>                    
          <td><?=$tempo;?></td>
          <td><?=$qtde;?></td>
          <td><?=$dias;?></td>
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

<? 
if ($action == "pesquisar")  { 

	$sql		= getSqlTempoToralPorClienteRel_034($de, $ate, $tipo, $id_cliente, $id_status);		
	//$resultado	= mysql_query($sql) or die ( $sql);	
	
	$resultA = mysql_query($sql) or die (mysql_error());
	
	$c = mysql_affected_rows();
?>
<fieldset>
<legend>Registros: <?=$c;?></legend>
<div class="_tableContainer">

  <table border="0" cellpadding="1" cellspacing="1"  id="_data">
 <thead>
    <tr>
          <th>Id_Cliente</th>
          <th>Cliente</th>
          <th>Tempo Total</th>
    </tr>
  </thead>
  <tbody>
<?
	while ($linhaA = mysql_fetch_object($resultA)) {
		$tempo = $linhaA->tempo;
		$id_cliente = $linhaA->id_cliente;		
		$cliente = $linhaA->cliente;
		$link = "datai=$datai&dataf=$dataf&id_status=$id_status&id_cliente=$id_cliente&action=pesquisar&tipo=$tipo";
?>
    <tr>
          <td> <a href="r_034.php?<?=$link?>" ><?=$id_cliente?></a></td>
          <td><?=$cliente;?></td>
          <td><?=$tempo;?></td>
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
<?php
mysql_free_result($rsClientes);

mysql_free_result($rsStatus);
?>
