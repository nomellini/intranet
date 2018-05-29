<?
	require("../scripts/conn.php");	
	require("../scripts/funcoes.php");
	
	$sql = "select l.id_chamado, date(dt_data) data, time(dt_data) hora, s.sistema, st.status
	from log_tramitacoes l 
		inner join chamado c on c.id_chamado = l.id_chamado
		inner join sistema s on s.id_sistema = c.sistema_id
		inner join status st on st.id_status = c.status
	where id_cliente = '$id_cliente' and date(l.dt_data) between '$de' and '$ate' order by dt_data desc";
	$result= mysql_query($sql) or die(mysql_error());

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tramitações <?=$_GET["id_cliente"]?></title>
</head>

<body>

<div class="col-md-12">
<h3>Tramitações visualizadas por <?=$id_cliente?> no período de <?=amd2dma($de)?> a <?=amd2dma($ate)?></h3>
</div>

<div class="col-md-9">
<table class="table table-condensed table-striped table-hover">
<thead>
    <tr>
      <th>Chamado</th>
      <th>Sistema</th>
      <th align="center">Data/hora da visualização</th>
    </tr>
</thead>  
<tbody>
<?
	while($linha = mysql_fetch_object($result))
	{
		$sistema = $linha->sistema;
		$chamado = $linha->id_chamado;
		$link = "../historicochamado.php?id_chamado=$chamado";
?>
    <tr>
      <td><a href="<?=$link?>" target="new"><?=$chamado?></a></td>          
      <td><?=$sistema?> <span class="label label-success"><?=$linha->status?></span></td>            
      <td><?=amd2dma($linha->data)?> <?=$linha->hora?></td>            
    </tr>
<?
	}
?>
  </tbody>
</table>
</div>
<div class="col-md-12">
	<hr />
	<a href="javascript:window.history.go(-1);">Voltar</a>
</div>
</body>
</html>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>


