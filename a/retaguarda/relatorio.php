<?
	require_once("../cabeca.php");


    $ultimos30Dias = date("Y-m-d", time()-( 86400*7 ) );
    $Ontem = date("Y-m-d", time()-( 86400*1 ) );	
	$Hoje = date("Y-m-d");	
	
	
	
    if(!$datai) {
       $datai = $ultimos30Dias;
	}
	
	
	if(!$dataf) {
      $dataf = $Hoje;
	}	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

	<!-- Bootstrap com Jquery -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- ---------- -->


</head>
<body>




<div class="container-fluid">

<div class="row m-1 pt-1">
<div class="col-12">
<form method="POST">
<div class="form-group">
	<label for="datai">De</label>
    <input type="date" id="datai" name="datai" value="<?=$datai?>" class="form-control">    
</div>
<div class="form-group">
	<label for="dataf">Até</label>
	<input type="date" id="dataf" name="dataf" value="<?=$dataf?>" class="form-control">
   </div>
	<button type="submit" class="btn btn-primary">Filtrar</button>
</form>
</div>
</div>



<div class="row m-1 pt-1">
<div class="col-12">
<p>Top 10 Solicitações de ajuda</p>

<table class="table table-sm table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th>Consultor</th>
      <th>Quantidade</th>
    </tr>
    </thead>
    <tbody>
    <?
	
//		$datai = dma2amd($datai);	
//		$dataf = dma2amd($dataf);

	
		$sql = "select u.nome, count(1) qtde
		from  retaguarda_fila rf
			inner join usuario u on u.id_usuario = rf.Id_Consultor
		where u.area = 1 and u.ativo=1 and ic_status = 2 and (date(Dt_Solicitacao) between '$datai' and  '$dataf')
		group by u.nome
		order by count(1) desc, u.nome limit 10 ";

        $result = mysql_query($sql);
        $c=1;
        while ($linha = mysql_fetch_object($result)) {
    ?>
    <tr>
      <th scope="row"><?= $c++; ?></th>
      <td><?=$linha->nome?></td>
      <td><?=$linha->qtde?></td>
    </tr>
    <?
        }
    ?>
  </tbody>
</table>
</div>
</div>


<div class="row m-1 pt-1">
<div class="col-12">
<p>Top 10 Ajudas prestadas</p>

<table class="table table-sm table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>    
      <th>Retaguarda</th>
      <th>Quantidade</th>
    </tr>
    </thead>
    <tbody>
    <?
		$sql = "select r.nome, count(1) qtde
from  retaguarda_fila rf
	inner join usuario r on r.id_usuario = rf.Id_Retaguarda
where r.area = 1 and r.ativo=1 and ic_status = 2 and (date(Dt_Solicitacao) between '$datai' and  '$dataf')
group by r.nome
order by count(1) desc limit 10";
        $result = mysql_query($sql);
        $c=1;
        while ($linha = mysql_fetch_object($result)) {
    ?>
    <tr>
      <th scope="row"><?= $c++; ?></th>    
      <td><?=$linha->nome?></td>
      <td><?=$linha->qtde?></td>
    </tr>
    <?
        }
    ?>
  </tbody>
</table>
</div>
</div>



<div class="row m-1 pt-1">
<div class="col-12">
<p>Top 10 Clientes</p>

<table class="table table-sm table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>    
      <th>Cliente</th>
      <th>Quantidade</th>
    </tr>
    </thead>
    <tbody>
    <?
		$sql = "select c.cliente_id nome, count(1) qtde
from  retaguarda_fila rf
left join chamado c on c.id_chamado = rf.Id_Chamado
where (cliente_id is not null) and (cliente_id <> 'DATAMACE') and (date(Dt_Solicitacao) between '$datai' and  '$dataf')
group by cliente_id
order by count(1) desc limit 10 ";
        $result = mysql_query($sql);
        $c=1;		
        while ($linha = mysql_fetch_object($result)) {
    ?>
    <tr>
      <th scope="row"><?= $c++; ?></th>    
      <td><?=$linha->nome?></td>
      <td><?=$linha->qtde?></td>
    </tr>
    <?
        }
    ?>
  </tbody>
</table>
</div>
</div>



<a href="index.php">Ver a fila</a>
</body>
</html>