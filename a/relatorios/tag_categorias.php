<?php require_once('../../Connections/sad.php'); ?>
<?php 
	if (!isset($sistema)) $sistema=1; 
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	$sistemas = array();
	
	function random_color(){
		mt_srand((double)microtime()*1000000);
		$c = '';
		while(strlen($c)<6){
			$c .= sprintf("%02X", mt_rand(0, 255));
		}
		//return $c;
		return "000000";
	}	

	
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
$query_rsSistemas = "SELECT id_sistema, sistema FROM sistema ORDER BY sistema ASC";
$rsSistemas = mysql_query($query_rsSistemas, $sad) or die(mysql_error());
$row_rsSistemas = mysql_fetch_assoc($rsSistemas);
$totalRows_rsSistemas = mysql_num_rows($rsSistemas);

mysql_select_db($database_sad, $sad);
$query_rsStatus = "SELECT * FROM status";
$rsStatus = mysql_query($query_rsStatus, $sad) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);
?><?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*2 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!isset($orderby)) {
		$orderby = " id_chamado desc";
	}
	
	$orderby .= ", id_chamado";	
		
?>
<html>
<head>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>
<title>Categorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<form action="" method="post" name="form1" id="form1">
Sistema: 
  <select name="sistema" class="bordaTexto" id="sistema">
    <option value="0" <?php if (!(strcmp(0, $sistema))) {echo "selected=\"selected\"";} ?>>Todos</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsSistemas['id_sistema']?>"<?php if (!(strcmp($row_rsSistemas['id_sistema'], $sistema))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSistemas['sistema']?></option>
    <?php
} while ($row_rsSistemas = mysql_fetch_assoc($rsSistemas));
  $rows = mysql_num_rows($rsSistemas);
  if($rows > 0) {
      mysql_data_seek($rsSistemas, 0);
	  $row_rsSistemas = mysql_fetch_assoc($rsSistemas);
  }
?>
  </select>
  <br>
  Status
<select name="status" class="bordaTexto" id="status">
    <option value="0" <?php if (!(strcmp(0, "$status"))) {echo "selected=\"selected\"";} ?>>Todos</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], "$status"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
    <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
  </select>
  <br>
  Per&iacute;odo: de 
  <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)"> 
  &agrave;
  <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>" onKeyPress="fdata(this)">
  <br>
  <input name="Submit" type="submit" class="unnamed1" value="Submit">
</form>
Categorias do sistema selecionado. Pare o mouse sobre uma categoria para mais informações<br>
<br>
<?php	
$quando = explode("/", $datai);
$datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$dataf = "$quando[2]-$quando[1]-$quando[0]";
$sql = "
select 
	s.sistema, 
    cat.categoria,	
	count(1) c
from 
  chamado c inner join sistema s on s.id_sistema = c.sistema_id
            inner join categoria cat on cat.id_categoria = c.categoria_id 
";		

$sql .= "	where 	dataa >= '$datai' and dataa <= '$dataf' ";	

if ($sistema) $sql .= "	and c.sistema_id = $sistema ";
if ($status) $sql .= "	and c.status = $status ";

$sql .=  " group by c.sistema_id, categoria ";

//echo $sql;

  $s = 0;
  $cMax = 0;
  $cMin = 900000;
  $resultA = mysql_query($sql) or die ($sql);
  while ($linhaA = mysql_fetch_object($resultA)) {
  
	$sistema  = $linhaA->sistema;
 	$sistemas[$sistema] = random_color();
  
  	$c = $linhaA->c;
	$s += $c;
	if ($c > $cMax) $cMax = $c;
	if ($c < $cMin) $cMin = $c; 
	
  }
 
  
  $fMax = 350;
  $fMin = 100;
  $delta = $cMax - $cMin;
  if ($delta == 0) $delta = 1;
  $passo = ($fMax - $fMin) / $delta;
  
  $resultA = mysql_query($sql) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
  
  	
 	$sistema = $linhaA->sistema;
	$categoria = $linhaA->categoria;
  	$c = $linhaA->c;
	$fontSize = $fMin + (( $c - $cMin ) * $passo );
	
	$p = ( $c/$s ) * 100;

	$bold = "";
  	if ($p>80) {
		$bold = "font-weight:bold;";
	}

	
	$p =  number_format($p, 2, ',', ' ');

  
  	if ($c == $cMax) {
		$categoria	= "<i>$categoria</i>";
	}
	
	echo '<a href="#" style="'.$bold.'text-transform:lowercase;font-size: '.$fontSize.'%;color:' . $sistemas[$sistema] .  '";" title="'.$c.' ocorrências: ' . $p . ' % - '. $sistema .'">';
	print "'$categoria'";	
	echo '</a> ';
  }
  
  
    
?>



<br/><br/><br/>
Total de chamados: <?=  number_format($s, 0, ',', '.'); ?><br>


<br>
Mapa de Cores<br>

<?
	foreach ($sistemas as $i => $values) {
		print "<a href=\"#\" style=\"color: " . $sistemas[$i] . " \">" . $i . "</a></br>";
	}		
?>

</body>

</html>
<?php
mysql_free_result($rsSistemas);

mysql_free_result($rsStatus);
?>
<script type="text/javascript">
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>