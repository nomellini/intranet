<?



	require ("../cabeca.php");		
	
	if ($action == "retirar") {
		$sql = "update retaguarda_fila set Dt_Atendimento = now(), ic_status = 2, Id_Retaguarda = $ok where Id = $idfila";
		mysql_query($sql) or die(mysql_error());
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">         
	<meta http-equiv="refresh" content="5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<script src="../js/toastr.min.js"></script>
	<link href="../css/toastr.css" rel="stylesheet" />
    <title>Fila retaguarda</title>
</head>

<body>


    <div class="container-fluid">

        <div class="comandos">
        <form method="post" name="form" >
        	<input type="hidden" name="action" value="">
            <input type="hidden" name="idfila" value="0">

        </form>                
        </div>

        <div class="filaespera">

        
        <div class="display-4">Aguardando</div>
        
<table class="table table-striped table-sm"  >
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Chamado</th>
      <th scope="col">Cliente</th>      
      <th scope="col">Sistema</th>
      <th scope="col">Resumo</th>
      <th scope="col">Tempo</th>
      <th scope="col">Ação</th>      
    </tr>
  </thead>
  <tbody>
        
        
        
        <?
			$sql = "select rf.*, u.nome, c.cliente_id, c.id_chamado, left(c.descricao, 20) descricao, s.sistema,
sec_to_time(time_to_sec(now()) - time_to_sec(Dt_Solicitacao)) tempo
from  retaguarda_fila rf
inner join usuario u on u.id_usuario = rf.Id_Consultor
left join chamado c on c.id_chamado = rf.Id_Chamado
left join sistema s on c.sistema_id = s.id_sistema
where ic_status = 1";
			$c = 0;
			$query = mysql_query($sql) or die (mysql_error());
			while ($linha = mysql_fetch_object($query))
			{
				$c++;
        ?>
        
    <tr>
      <td><?=$linha->nome?></td>
      <td><?=$linha->id_chamado?></td>
      <td><?=$linha->cliente_id?></td>      
      <td><?=$linha->sistema?></td>
      <td><?=$linha->descricao?></td>      
      <td><?=$linha->tempo?></td>
      <td>
      	<? if ($c < 100000) { ?>
      	<button class="btn btn-primary  btn-sm" onClick="javascript:deleta('<?=$linha->Id?>', '<?=$linha->nome?>')">Atendido</button>
      	<? } ?>        
      </td>      
    </tr>
        
                    	
        <?
			}
        ?>
  </tbody>
</table>               


<hr>
<p>
	Ultimos atendimentos
</p>

        <div class="filaespera">

        
        
<table class="table table-striped table-sm">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Chamado</th>
      <th scope="col">Sistema</th>
      <th scope="col">Resumo</th>
      <th scope="col">Consultor</th>
    </tr>
  </thead>
  <tbody>
        
        
        
        <?
			$sql = "select rf.*, u.nome, r.nome retaguarda, c.id_chamado, left(c.descricao, 20) descricao, s.sistema,
sec_to_time(time_to_sec(now()) - time_to_sec(Dt_Solicitacao)) tempo
from  retaguarda_fila rf
inner join usuario u on u.id_usuario = rf.Id_Consultor
left join usuario r on r.id_usuario = rf.Id_Retaguarda
left join chamado c on c.id_chamado = rf.Id_Chamado
left join sistema s on c.sistema_id = s.id_sistema
where u.area = 1 and u.ativo=1 and ic_status = 2 order by Dt_Atendimento desc limit 20";
			$query = mysql_query($sql) or die (mysql_error());
			while ($linha = mysql_fetch_object($query))
			{
        ?>
        
    <tr>
      <td><?=$linha->nome?></td>
      <td><?=$linha->id_chamado?></td>
      <td><?=$linha->sistema?></td>
      <td><?=$linha->descricao?></td>      
      <td><?=$linha->retaguarda ?></td>            

    </tr>
        
                    	
        <?
			}
        ?>
  </tbody>
</table>               




        

        </div>


    </div>


</body>

</html>
<script>
	function deleta(Id, Nome) {
		if (window.confirm("Deseja retirar '" + Nome + "' da fila  ?")) {
			document.form.idfila.value = Id;
			document.form.action.value = "retirar";
			document.form.submit();
		}
	}	
	

	
</script>