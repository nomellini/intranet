<? require("scripts/conn.php"); ?><?php virtual('/Connections/sad.php'); ?>
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
$query_rsUsuarios = "SELECT nome, email, ramal FROM usuario WHERE ativo and ramal is not null ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<title>Ramais</title>
<script type="text/javascript" src="../scripts/jquery-1.3.2.min.js"> </script>
<script type="text/javascript" src="../scripts/jquery.fixedheader.js"> </script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#data").fixedHeader({
			width: 950,height: 380
		});
	})
</script>


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
	color: #000;
	font-family: Arial;
	font-size: 12px;
	background-image: url(imagens/FundoTituloGride.jpg);
}
.style4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px;}


a:hover {	
	color: #F00
}

a {
	text-decoration: none;
}


-->
</style>

</head>
<body>

<p>Lista de Nomes, E-Mails e Ramais</p>
  Pesquisar:
  <label for="textfield"></label>
  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, '_data', 1)" />
<div class="_tableContainer">
<table width="550" border="0" cellspacing="1" cellpadding="1" id="_data" >
<thead>
  <tr>
    <th>Nome</th>
    <th align="center" valign="middle">Ramal</th>
    <th>Email</th>
  </tr>
</thead>
<tbody>  
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsUsuarios['nome']; ?></td>
      <td align="center" valign="middle"><?php echo $row_rsUsuarios['ramal']; ?></td>
      <td><a href="MAILTO:<?php echo $row_rsUsuarios['email']; ?>"><?php echo $row_rsUsuarios['email']; ?></a></td>
    </tr>
    <?php } while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios)); ?>
    
</tbody>
</table>
</div>
<hr />

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
  
<select name="select" id="select">
  
<?
	$sql = "SELECT nome, email, ramal FROM usuario WHERE ativo and ramal is not null ORDER BY nome ASC";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result))
	{
		$display = "$linha->nome - $linha->ramal";
		$value = $linha->ramal;
		 echo "<option value=\"$value\">$display</option>";
	}
?>
</select>


<script type="text/javascript">
function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  
  
</script>
</body>
</html>
<?php
mysql_free_result($rsUsuarios);
?>
