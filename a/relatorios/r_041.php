<?

	$anoAtual = date("Y");
	
	$subtrair = 86400*30*1;
	
	if (!isset($ano)) {	
	    $ano = date("Y", time() );  
	}
	if (!isset($mes))
	{
    	$mes = date("m", time() );  
	}


	if (isset($action)) {

		$user = "sad";
		$pwd = "data1371";
		$base = "sad";
		$link = mysql_connect($host, $user, $pwd) or die(mysql_error());
		mysql_select_db($base) or die(mysql_error());		

		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);    
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);  
		$de = date("Y-m-d", $DataInicio);
		$ate = date("Y-m-d", $DataFim);
	
	
		$sql = "select c.id_cliente, c.cliente, count(1) qtde 
		from log_tramitacoes l
		inner join cliente c on c.id_cliente = l.id_cliente
		where date(l.dt_data) between '$de' and '$ate'
		group by c.id_cliente, c.cliente order by count(1) desc, id_cliente";
		
		$result = mysql_query($sql) or die (mysql_error());	
		
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tramitações</title>


<style>
.highlight{
	padding: 14px;
	border: 1px solid #e1e1e8;
	-webkit-border-radius: 10px;
}

.bordaArredondada {
	padding: 1px;
	border: 1px solid #B0B0B0;
	background-color: #f7f7f9;
	-webkit-border-radius: 1px;
}

</style>

</head>


<body>



<br />

<div class="col-md-9">
<form id="form1" name="form1" method="post" action="">
<div class="highlight">
<h4>Selecione a refer&ecirc;ncia</h4>
  <select name="mes">
    <option value="1">Janeiro</option>
    <option value="2">Fevereiro</option>
    <option value="3">Mar&ccedil;o</option>
    <option value="4">Abril</option>
    <option value="5">Maio</option>
    <option value="6">Junho</option>
    <option value="7">Julho</option>
    <option value="8">Agosto</option>
    <option value="9">Setembro</option>
    <option value="10">Outubro</option>
    <option value="11">Novembro</option>
    <option value="12">Dezembro</option>
  </select>
  <select name="ano">
  <?
  	$inicio = $anoAtual - 5;
  	for($i=$inicio; $i<=$anoAtual; $i++)
	{
		print "<option value=$i>$i</option>";
	}
  ?>
  </select>
	<input type="submit" name="Submit" value="Gerar relatório" />
	<input type="hidden" name="action" value="gerar">
</div>
</form>

</div>
<br />
<br />

<?	if (isset($action)) { ?>




<div class="col-md-10">
	<h3>Visualizações de tramitações para <?="$mes/$ano"?></h3>
</div>

<div class="col-md-9">
<table class="table table-condensed table-striped table-hover">
<thead>
    <tr>
      <th>Cliente Id</th>
      <th>Cliente</th>
      <th>Quantidade</th>
    </tr>
</thead>  
<tbody>
<?
	while($linha = mysql_fetch_object($result))
	{
		$cliente = $linha->id_cliente;
		$link = "r_041b.php?id_cliente=$cliente&de=$de&ate=$ate";
?>
    <tr>
      <td><a href="<?=$link?>"><?=$linha->id_cliente?></a></td>
      <td><?=$linha->cliente?></td>
      <td align="left"><?=$linha->qtde?></td>
    </tr>
<?
	}
?>
  </tbody>
</table>
</div>


<?	} ?>
<div class="col-md-12">
	<hr />
	<a href="index.php">Voltar para Relatórios</a>
</div>
</body>
</html>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>