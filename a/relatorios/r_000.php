<?

	require("../cabeca.php");	
	
//	require("../scripts/conn.php");	
//	require("../scripts/funcoes.php");	
		
    $Ontem = date("Y-m-d", time()-( 86400*1 ) );  
    $Anteontem = date("Y-m-d", time()-( 86400*2 ) );  	
	
	$DataReferencia = $Data_Atual;
	$DataReferenciaHuman = AMD2DMA($DataReferencia);
	
	
//	print_r (conn_linkEmail(2));
//	die('');
function obterTempo($id_usuario)
{	
	global $Data_Atual;
	$sql = "select nome, count(*) as contatos, ";
	$sql .= "sec_to_time(SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) )) AS tempo ";	
	$sql .= "from contato, usuario where (usuario.id_usuario=contato.consultor_id) ";			 
	$sql .= "and (contato.historico is not null) and (contato.historico<>'') ";
	$sql .= "and (contato.dataa =  '$Data_Atual' ) and contato.consultor_id = $id_usuario group by contato.consultor_id";

	$result = mysql_query($sql) or die(mysql_error() . ' - ' . $sql);
	$conta=0;
	$linha = mysql_fetch_object( $result ) ;
	$tmp["contatos"] = $linha->contatos; 
	$tmp["nome"] = $linha->nome;
	$tmp["tempo"] = $linha->tempo;	  
	$saida = $tmp;	
	return $saida;	
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=iso-8859-1>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Relat 0</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

  </head>

  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				Chamados que estamos trabalhando no momento
			</h3>
		</div>
	</div>
	
	
</div>
<div class="col-md-12">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>
							Nome 
						</th>
						<th>
							Chamado
						</th>
						<th>
							Descrição
						</th>
						<th>
							Tempo Hoje
						</th>
					</tr>
				</thead>
				<tbody>
				
<?

 
 $sql = "select sistema, c.data, u.id_usuario, u.area, u.nome, u.area, left(ch.descricao, 100) d, left(c.contato,100) con,c.* from 
       usuario u
         inner join contato_temp c on c.id_usuario = u.id_usuario
         inner join chamado ch on ch.id_chamado = c.id_chamado
		 inner join sistema on sistema.id_sistema = ch.sistema_id
where u.area in (2, 3, 11) and u.ativo = 1 and (c.data >= '$DataReferencia') order by  area desc, nome";

//	echo $sql;

  $result = mysql_query($sql) or die ($sql);
  while ($linha = mysql_fetch_object($result))
  {
  
  	  $tempoHoje = obterTempo($linha->id_usuario);
  
  	  $class = "";
	  
	  $Data = AMD2DMA($linha->data) . " " . $linha->hora;
	  
	  if ($linha->area == 2) {
	  	$class="class = success";	  
	  }
	  if ($linha->area == 1 ) {
	  	$class="class = success";
	  }
	  if ($linha->area == 3 ) {
	  	$class="class = warning";
	  }
	  
	$msg = $tempoHoje["tempo"];
	if ($linha->area <> 2) {
		$msg = "<a href=http://192.168.0.14/a/estatisticas/daniel/estatisticas.php?datai=hoje#$linha->id_usuario>$msg</a>";
	} else {
		$msg = "<a href=http://192.168.0.14/a/estatisticas/grhnet/estatisticas.php?datai=hoje#$linha->id_usuario>$msg</a>";
	}
	  
?>

					<tr <?=$class?>>
						<td>
							<? 
								echo $linha->nome;
								if ($linha->id_usuario == $ok)
								{
									echo " <span class=\"label label-warning\">você</span>";
								}
							?>
						</td>
						<td>
							<a href="http://192.168.0.14/a/historicochamado.php?&id_chamado=<?=$linha->id_chamado?>"><?=$linha->id_chamado?></a>
						</td>
						<td>
							<?=" <span class=\"label label-success\">$linha->sistema</span>";?>
							<?=$linha->d?>...
						</td>
						<td>
							<?= $msg ?>
						</td>
					</tr>
	
<?
  }
?>
								
				
		</tbody>
	</table>
</div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
  </body>


</body>
</html>