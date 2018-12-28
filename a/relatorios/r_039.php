<?	
	require("../cabeca.php");
    $UltimosDoisMeses = date("d/m/Y", time()-( 86400 * 2 * 31 ) );  	
	
    if(!$datai) {
       $datai = $UltimosDoisMeses;//date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" >



<title>Encaminhamentos</title>
<style type="text/css">


    /* Personalização da classe do DataTable */
	/* Deixa as caixinhas com a página selecionada na cor padrão*/ 
		.page-item.active .page-link {
			background-color: rgba(51,88,123,1) !important;
			border-color:  rgba(51,88,123,1) !important;  
		}
	/* ***************************** */

    /* Hover nas linhas das tabelas */
    .TableHover tr:hover td{
			background-color: rgba(200, 200, 200, 0.45) !important;
		}
	/* ***************************** */

	/* Desativa a ordenação do datatable em uma coluna  */
		.no-sort::after { 
			display: none!important;
		}

		.no-sort { 
			pointer-events: none!important; cursor: default!important; 
		}
	/* ***************************** */




<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<script>
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
</head>

<body >

      <div class="container-fluid" >

<h2>Meus encaminhamentos dos últimos meses</h2>
<p>
<?

$UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 2 * 31 ) );  	
if ($ok != 12000)
{
	$filtroAdicional = "and  ( (l.id_destinatario = $ok) or (l.id_usuario = $ok))";
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 4 * 31 ) );  	
}

$quando = explode("/", $datai);
$_datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$_dataf = "$quando[2]-$quando[1]-$quando[0]";


$sql = "select c.id_chamado, c.status,
  l.data, l.hora, u.nome, l.acao acaoId,
  case l.acao
    when 1 then 'Abriu este chamado'
    when 2 then 'Inseriu um contato'
    when 3 then 'Leu o chamado'
    when 4 then 'Encerrou o chamado'
    when 5 then 'Passou a seguir este chamado'
    when 6 then 'Deixou de seguir este chamado'
    when 7 then 'Complementou um contato'	
	when 8 then 'Reabriu o chamado'		
	when 11 then 'Encaminhou'		
	when 12 then 'Manteve pendente'			
  end acao,
  d.nome destinatario,
  id_contato,
  left(sistema.sistema, 20) as sistema,
  left(cliente.cliente,20) as Cliente
from 
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left  join usuario d on d.id_usuario = l.id_destinatario
	inner join chamado c on c.id_chamado = l.id_chamado
	inner join sistema on sistema.id_sistema = c.sistema_id
	inner join cliente on cliente.id_cliente = c.cliente_id	
where acao = 11 and 
	l.data >= '$_datai' and
	l.data <= '$_dataf'
$filtroAdicional
order by l.data desc, l.hora desc";
$query = mysql_query($sql) or die (mysql_error());
//echo ($sql);

?>
</p>
<form name="form" method="post" action="r_039.php">
<table width="100%%" border="0" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <td width="4%">De</td>
      <td width="96%"><input type="text" name="datai" class="bordaTexto"
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)"></td>
    </tr>
    <tr>
      <td>Até</td>
      <td><input type="text" name="dataf" class="bordaTexto"
  size="12" maxlength="10" value="<?=$dataf?>" onKeyPress="fdata(this)"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit"></td>
    </tr>
  </tbody>
</table>

<p>  
</p>
<table id="tabela" class="table TableHover table-sm">
<thead class="headerColor"> 
    <th bgcolor="#006699"><span class="style3">Chamado</span></th>  
    <th bgcolor="#006699" class="style3">Sistema</th>
    <th bgcolor="#006699" class="style3">Cliente</th>  
    <th bgcolor="#006699"><span class="style3">Data Hora </span></th>
    <th bgcolor="#006699"><span class="style3">De</span></th>
    <th bgcolor="#006699"><span class="style3">Para</span></th>
  </thead>
          <tbody>

<?
  while ($linha = mysql_fetch_object($query))
  {
    $data = AMD2DMA($linha->data) . "  " . $linha->hora;
	$nome = $linha->nome;
	$acao = $linha->acao;
	$IdContato = $linha->id_contato;
	if ($linha->acaoId == 11) {
		$destinatario = $linha->destinatario;
		if ($destinatario){
			$acao = "<a href=../historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . ">" . $destinatario . "</a>";
		}
	}
	
	$cor = '';
	if ($linha->status == 1)
	{
		$cor = 'class="table-danger"';
	} else if ($linha->status == 2)
	{
//		$cor = 'class="table-success"';		
	}

	
?>  
  <tr  <?=$cor;?> >
  
    <td bgcolor="#FFFFFF"  > <a href="http://192.168.0.14/a/historicochamado.php?id_chamado=<?=$linha->id_chamado?>" target="_blank"><?=$linha->id_chamado?></a></td>  
    <td bgcolor="#FFFFFF"><?=$linha->sistema?></td>
    <td bgcolor="#FFFFFF"><?=$linha->Cliente?></td>  
    <td bgcolor="#FFFFFF"><?=$data?></td>
    <td bgcolor="#FFFFFF"><?=$nome?></td>
    <td bgcolor="#FFFFFF"><?=$acao?></td>
  </tr>
<?
  }
?>  
          </tbody>
        </table>

<p>&nbsp;</p>
</form>
</div>
</body>
</html>

<script>
    /* Configuração das tabelas (padrão usado nas telas de manutenção) */
    $('document').ready(function() {
			$('#tabela').DataTable( {
				"searching" : true,
				"pageLength": 100,
				"order": [],
				"language": {
				"paginate": {
					"previous": 'Anterior',
					"next":     'Próximo'
				},
				"lengthMenu": "Mostrar _MENU_ por página",
				"zeroRecords": "Nenhum registro encontrado",
				"infoEmpty": "Nenhum registro disponível",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"next":     'Próximo'
				}
			});
		});
	/* *************************** */

</script>